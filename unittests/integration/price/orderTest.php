<?php
require_once realpath(dirname(__FILE__).'/../../') . '/unit/OxidTestCase.php';
require_once realpath( dirname(__FILE__) ) . '/basketconstruct.php';

/**
 * Final order calculation test
 * Known action cycle to test:
 * 1.) Save basket
 * 2.) Proceed order
 * 3.) Change order in different ways
 *     a.) By articles quantity
 *     b.) By discount amount
 *     c.) By adding / removing articles
 * 4.) Recalculate
 */
class Integration_Price_OrderTest extends OxidTestCase
{
    /* Test case directory */
    private $_sTestCaseDir = "testcases/order";
    /* Specified test cases (optional) */
    private $_aTestCases = array( 
          //"testCase.php"
    );
    private $dPayment;
    private $oBasketConstruct;
    
    /**
     * Initialize the fixture.
     */
    protected function setUp()
    {
        parent::setUp();
        $this->_truncateTable( "oxarticles" );
        $this->_truncateTable( "oxcategories" );
        $this->_truncateTable( "oxdiscount" );
        $this->_truncateTable( "oxobject2discount" );
        $this->_truncateTable( "oxwrapping" );
        $this->_truncateTable( "oxdelivery" );
        $this->_truncateTable( "oxdel2delset" );
        $this->_truncateTable( "oxobject2payment" );
        $this->_truncateTable( "oxvouchers" );
        $this->_truncateTable( "oxvoucherseries" );
        $this->_truncateTable( "oxuser" );
    }
    
    /**
     * Tear down the fixture.
     */
    protected function tearDown()
    {
        parent::tearDown();
    }
    
    /**
     * Order startup data and expected calculations results
     */
    public function _dpData()
    {
        return $this->_getTestCases( $this->_sTestCaseDir, $this->_aTestCases );
    }
    
    /**
     * Tests order calculations
     *
     * @dataProvider _dpData
     */
    public function testOrderCalculation( $aTestCase )
    {
        if ( $aTestCase['template'] == 1 ) {
            $this->markTestSkipped( "template is skipped" );
        }
        // expectations
        $aExpected = $aTestCase['expected'];
        // actions
        $aActions = $aTestCase['actions'];
        
        // load calculated basket from provided data
        $this->oBasketConstruct = new BasketConstruct();
        $oBasket = $this->oBasketConstruct->calculateBasket( $aTestCase );
        
        $oBasket->setPayment( "oxidinvoice" );
        
        if ( $aTestCase['shipping'] ) {
            $oBasket->setShipping( $aTestCase['shipping'] );
        } else {
            $oBasket->setShipping( "oxidstandard" );
        }

        $oUser = $oBasket->getBasketUser();

        // Mocking _sendOrderByEmail, cause Jenkins return err, while mailing after saving order
        $oOrder = $this->getMock( 'oxOrder', array( '_sendOrderByEmail', 'validateDeliveryAddress', 'validateDelivery' ) );
        $oOrder->expects( $this->any() )->method( '_sendOrderByEmail' )->will( $this->returnValue( 0 ) );
        $oOrder->expects( $this->any() )->method( 'validateDeliveryAddress' )->will( $this->returnValue( null) );
        $oOrder->expects( $this->any() )->method( 'validateDelivery' )->will( $this->returnValue( null ) );
        
        if ( $aTestCase['payment'] ) {
            $oOrder->oxorder__oxpaymenttype = new oxField( $aTestCase['payment'] );
        }
        
        // if basket has products
        if ( $oBasket->getProductsCount() ) {
            $iSuccess = $oOrder->finalizeOrder( $oBasket, $oUser, $blRecalculatingOrder = false );
        }
        $this->assertEquals( 0, $iSuccess );
        
        $iExpCnt = count( $aExpected );
        // check order totals
        for ( $i = 1; $i < $iExpCnt; $i++ ) {
            $this->_checkTotals( $aExpected, $i, $oOrder );
            // mess with the order or change some settings
            if ( !empty( $aActions) ) {
                foreach ( $aActions as $_sFunction => $aParams ) {
                    $this->$_sFunction( $aParams, $oOrder );
                }
            }
            // recalculate
            $oOrder->recalculateOrder();
        }
    }
    
    /**
     * Check totals of saved (recalculated) order
     * @param array $aExpected
     * @param object $oOrder
     * @param integer $iApproach number of order recalculate events starting at 1
     */
    protected function _checkTotals( $aExpected, $iApproach, $oOrder )
    {
        $aExpTotals = $aExpected[$iApproach]['totals'];
        $aArticles = $aExpected[$iApproach]['articles'];
        $blIsNettoMode = $oOrder->isNettoMode();
        $aOrderArticles = $oOrder->getOrderArticles();

        foreach ( $aOrderArticles as $oArticle ) {
            $iArtId = $oArticle->oxorderarticles__oxartid->value;
            if ( $blIsNettoMode ) {
                $sUnitPrice = $oArticle->getNetPriceFormated();
                $sTotalPrice = $oArticle->getTotalNetPriceFormated();
            } else {
                $sUnitPrice = $oArticle->getBrutPriceFormated();
                $sTotalPrice = $oArticle->getTotalBrutPriceFormated();
            }
            $this->assertEquals( $aArticles[$iArtId][0], $sUnitPrice, "#{$iApproach} Unit price of order art no #{$iArtId}" );
            $this->assertEquals( $aArticles[$iArtId][1], $sTotalPrice, "#{$iApproach} Total price of order art no #{$iArtId}" );
        }
        
        $aProductVats = $oOrder->getProductVats( true );
        
        $this->assertEquals( $aExpTotals['totalNetto'], $oOrder->getFormattedTotalNetSum(), "Product Net Price #$iApproach" );
        $this->assertEquals( $aExpTotals['discount'], $oOrder->getFormattedDiscount(), "Discount #$iApproach" );
        
        if ( $aProductVats ) {
            foreach ( $aProductVats as $iVat => $dVatPrice ) {
                $this->assertEquals( $aExpTotals['vats'][$iVat], $dVatPrice, "Vat %{$iVat} total cost #$iApproach" );
            }
        }
        
        $this->assertEquals( $aExpTotals['totalBrutto'], $oOrder->getFormattedTotalBrutSum(), "Product Gross Price #$iApproach" );
        
        $aExpTotals['voucher']
        ? $this->assertEquals( $aExpTotals['voucher']['brutto'], $oOrder->getFormattedTotalVouchers(), "Voucher costs #$iApproach" )
        : '';
        
        $aExpTotals['delivery']
        ? $this->assertEquals( $aExpTotals['delivery']['brutto'], $oOrder->getFormattedeliveryCost(), "Shipping costs #$iApproach" )
        : '';
        
        $aExpTotals['wrapping']
        ? $this->assertEquals( $aExpTotals['wrapping']['brutto'], $oOrder->getFormattedWrapCost(), "Wrapping costs #$iApproach" )
        : '';
        
        $aExpTotals['giftcard']
        ? $this->assertEquals( $aExpTotals['giftcard']['brutto'], $oOrder->getFormattedGiftCardCost(), "Giftcard costs #$iApproach" )
        : '';
        
        if ( $iApproach == 1 ) {
            $sPayCost = $oOrder->getFormattedPayCost();
            $sGrandTotal = $oOrder->getFormattedTotalOrderSum();
            $this->dPayment = $oOrder->getOrderPaymentPrice()->getBruttoPrice();
        } else {
            $dGrandTotal = $oOrder->getTotalOrderSum();
            $sPayCost = number_format( round( $this->dPayment, 2 ) , 2, ',', '.');
            $dGrandTotal += $this->dPayment;
            $sGrandTotal = number_format( round( $dGrandTotal, 2 ) , 2, ',', '.');
        }
        
        $aExpTotals['payment']
            ? $this->assertEquals( $aExpTotals['payment']['brutto'], $sPayCost, "Charge Payment Method #$iApproach" )
            : '';
        $this->assertEquals( $aExpTotals['grandTotal'], $sGrandTotal, "Sum total #$iApproach" );
    }
    
    /**
     * Getting test cases from specified
     * @param string $sDir directory name
     * @param array $aTestCases of specified test cases
     */
    protected function _getTestCases( $sDir, $aTestCases = array() )
    {
        $sPath = "integration/price/" . $sDir . "/";
        // load test cases
        $aGlobal = array();
        if ( empty( $aTestCases ) ) {
            $aFiles = glob( $sPath . "*.php", GLOB_NOSORT );
        } else {
            foreach ( $aTestCases as $sTestCase ) {
                $aFiles[] = $sPath . $sTestCase;
            }
        }
        foreach ( $aFiles as $sFilename ) {
            include( $sFilename );
            $aGlobal["{$sFilename}"] = array($aData);
        }
        return $aGlobal;
    }
    
    /**
     * Truncates specified table
     * @param string $sTable table name
     */
    protected function _truncateTable( $sTable )
    {
        return oxDb::getDb()->execute( "TRUNCATE {$sTable}" );
    }
    
    /* --- Expected functions for changing saved order --- */
    
    /**
     * Change configs
     * @param array $aConfigOptions
     */
    protected function _changeConfigs( $aConfigOptions )
    {
        $oConfig = oxRegistry::getConfig();
        if ( !empty( $aConfigOptions ) ) {
            foreach ( $aConfigOptions as $sKey => $sValue ) {
                $oConfig->setConfigParam( $sKey, $sValue );
            }
        }
    }
    
    /**
     * Add articles
     * @param array $aArticles new articles to add
     * @param object $oOrder
     */
    protected function _addArticles( $aArticles, $oOrder )
    {
        $aArts = $this->oBasketConstruct->getArticles( $aArticles );
        foreach( $aArts as $aArt ) {
            $oProduct = new oxArticle();
            $oProduct->load( $aArt['id'] );
            $dAmount = $aArt['amount'];
            $oOrderArticle = oxNew( 'oxorderArticle' );
            $oOrderArticle->oxorderarticles__oxartid  = new oxField( $oProduct->getId() );
            $oOrderArticle->oxorderarticles__oxartnum = new oxField( $oProduct->oxarticles__oxartnum->value );
            $oOrderArticle->oxorderarticles__oxamount = new oxField( $dAmount );
            $oOrderArticle->oxorderarticles__oxselvariant = new oxField( oxConfig::getParameter( 'sel' ) );
            $oOrder->recalculateOrder( array( $oOrderArticle ) );
        }
    }
    
    /**
     * Removes articles
     * @param array $aArtIds article id's to remove
     * @param object $oOrder
     */
    protected function _removeArticles( $aArtIds, $oOrder )
    {
        $aArtIdsCount = count( $aArtIds );
        $aOrderArticles = $oOrder->getOrderArticles();
        foreach ( $aOrderArticles as $oOrderArticle ) {
            for ( $i = 0; $i < $aArtIdsCount; $i++ ) {
                if ( $oOrderArticle->oxorderarticles__oxartid->value == $aArtIds[$i] ) {
                    $oOrderArticle->delete();
                } 
            }
        }
    }
    
    /**
     * Change articles
     * @param array $aArtIdsAmounts
     * @param object $oOrder
     */
    protected function _changeArticles( $aArtIdsAmounts, $oOrder )
    {
        $sArtCount = count( $aArtIdsAmounts );
        $aOrderArticles = $oOrder->getOrderArticles();
        foreach ( $aOrderArticles as $oOrderArticle ) {
            for ( $i = 0; $i < $sArtCount; $i++ ) {
                if ( $oOrderArticle->oxorderarticles__oxartid->value == $aArtIdsAmounts[$i]['oxid'] ) {
                    $oOrderArticle->setNewAmount( $aArtIdsAmounts[$i]['amount'] );
                }
            }
        }
    }
}