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
    private $oConfig;
    /**
     * Initialize the fixture.
     */
    protected function setUp()
    {
        parent::setUp();
        $this->oConfig = oxRegistry::getConfig();
        $this->_hasArticleDump ? '': $this->_truncateTable( "oxarticles" );
        $this->_truncateTable( "oxdiscount" );
        $this->_truncateTable( "oxobject2discount" );
        $this->_truncateTable( "oxwrapping" );
        $this->_truncateTable( "oxdelivery" );
        $this->_truncateTable( "oxdel2delset" );
        $this->_truncateTable( "oxobject2payment" );
        $this->_truncateTable( "oxvouchers" );
        $this->_truncateTable( "oxvoucherseries" );
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
        // expectations
        $aExpected = $aTestCase['expected'];
        // actions
        $aActions = $aTestCase['actions'];
        
        // load calculated basket from provided data
        $oBasketConstruct = new BasketConstruct();
        $oBasket = $oBasketConstruct->calculateBasket( $aTestCase );
        
        $oBasket->setPayment( "oxidinvoice" );

        $oBasket->setShipping( "oxidstandard" );

        $oUser = $oBasket->getBasketUser();
        
        // Mocking _sendOrderByEmail, cause Jenkins return err, while mailing after saving order
        $oOrder = $this->getMock( 'oxOrder', array( '_sendOrderByEmail' ) );
        $oOrder->expects( $this->once() )->method( '_sendOrderByEmail' )->will( $this->returnValue( 0 ) );
        
        // if basket has products
        if ( $oBasket->getProductsCount() ) {
            // for delivery validation
            oxRegistry::getSession()->setVariable('sDeliveryAddressMD5','8da0901fb9d80154d0e33394f134fd4f');
            // finalizing ordering process (validating, storing order into DB, executing payment, setting status ...)
            $iSuccess = $oOrder->finalizeOrder( $oBasket, $oUser, $blRecalculatingOrder = false );
        }
        $this->assertEquals( 0, $iSuccess );
        
        // check order totals
        $this->_checkTotals( $aExpected, $oOrder, 1 );
        
        // mess with the order or change some settings
        foreach ( $aActions as $_sFunction => $aParams ) {
            $this->$_sFunction( $aParams );
        }
        // recalculate
        $oOrder->recalculateOrder();
        
        // check totals again
        $this->_checkTotals( $aExpected, $oOrder, 2 );
    }
    
    /**
     * Check totals of saved (recalculated) order
     * @param array $aExpected
     * @param object $oOrder
     * @param integer $iApproach number of order recalculate events starting at 1
     */
    protected function _checkTotals( $aExpected, $oOrder, $iApproach )
    {
        $aExpTotals = $aExpected[$iApproach]['totals'];
        $aArticles = $aExpected[$iApproach]['articles'];
        $blShowNetPrice = $this->oConfig->getConfigParam( "blShowNetPrice" );
        
        $aOrderArticles = $oOrder->getOrderArticles();

        foreach ( $aOrderArticles as $oArticle ) {
            $iArtId = $oArticle->oxorderarticles__oxartid->value;
            if ( $blShowNetPrice ) {
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
        // load oxarticles table data
        if ( is_file( "integration/price/'.$sDir.'/oxarticles.sql" ) ) {
            $this->_hasArticleDump = true;
            $sHost   = $this->getConfigParam( "dbHost" );
            $sUser   = $this->getConfigParam( "dbUser" );
            $sPass    = $this->getConfigParam( "dbPwd" );
            $sDb   = $this->getConfigParam( "dbName" );
            passthru('mysql -h'.$sHost.' -u'.$sUser.' -p'.$sPass.' '.$sDb.' < integration/price/'.$sDir.'/oxarticles.sql');
        }
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
     */
    protected function _changeConfigs( $aConfigOptions )
    {
        if ( !empty( $aConfigOptions ) ) {
            foreach ( $aConfigOptions as $sKey => $sValue ) {
                $this->oConfig->setConfigParam( $sKey, $sValue );
            }
        }
    }
}