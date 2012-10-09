<?php
require_once realpath(dirname(__FILE__).'/../../') . '/unit/OxidTestCase.php';
require_once realpath( dirname(__FILE__) ) . '/basketconstruct.php';

/**
 * Basket price calculation test
 * Check:
 * - Article unit & total price
 * - Discount amounts
 * - Vat amounts
 * - Additional fees (wrapping, payment, delivery)
 * - Vouchers
 * - Totals (grand, netto, brutto)
 */
class Integration_Price_BasketTest extends OxidTestCase
{
    /* Test case directory array */
    private $_aTestCaseDirs = array ( 
        "testcases/basket",
    );
    /* Specified test cases (optional) */
    private $_aTestCases = array(
        //"testCase.php",
    );

    /**
     * Initialize the fixture.
     */
    protected function setUp()
    {
        parent::setUp();
        $this->_reset();
    }
    
    /**
     * Tear down the fixture.
     */
    protected function tearDown()
    {
        parent::tearDown();
    }
    
    /**
     * Resets db tables, required configs
     */
    protected function _reset()
    {
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
        $this->_truncateTable( "oxobject2delivery" );
        $this->_truncateTable( "oxdeliveryset" );
        $this->_truncateTable( "oxuser" );
        oxRegistry::getConfig()->setConfigParam( "blShowVATForDelivery", true );
        oxRegistry::getConfig()->setConfigParam( "blShowVATForPayCharge", true );
    }
    
    /**
     * Tests special basket calculations
     *
     * @dataProvider _dpData
     */
    public function testBasketCalculation( $aTestCase )
    {
        // gathering data arrays
        $aExpected  = $aTestCase['expected'];
        
        //if not finished testing data skip test
        if ( empty( $aExpected ) ) {
            $this->markTestSkipped( "skipping test case due invalid data provided" );
        }
        
        // load calculated basket from provided data
        $oBasketConstruct = new BasketConstruct();
        $oBasket = $oBasketConstruct->calculateBasket( $aTestCase );

        // check basket item list
        $aExpArts = $aExpected['articles'];
        $aBasketItemList = $oBasket->getContents();

        $this->assertEquals( count( $aExpArts ), count( $aBasketItemList ), "Expected basket articles amount doesn't match actual" );

        if ( $aBasketItemList ) {
            foreach ( $aBasketItemList as $iKey => $oBasketItem ) {
                $iArtId = $oBasketItem->getArticle()->getID();
                $this->assertEquals( $aExpArts[$iArtId][0], $oBasketItem->getFUnitPrice(), "Unit price of article id {$iArtId}" );
                $this->assertEquals( $aExpArts[$iArtId][1], $oBasketItem->getFTotalPrice(), "Total price of article id {$iArtId}" );
            }
        }

        // Total discounts
        $aExpDisc = $aExpected['totals']['discounts'];
        $aProductDiscounts = $oBasket->getDiscounts();
        $this->assertEquals( count( $aExpDisc ), count( $aProductDiscounts ), "Expected basket discount amount doesn't match actual" );
        if ( !empty( $aExpDisc ) ) {
            foreach ( $aProductDiscounts as $oDiscount ) {
                $this->assertEquals( $aExpDisc[$oDiscount->sOXID], $oDiscount->fDiscount, "Total discount of {$oDiscount->sOXID}" );
            }
        }

        // Total vats
        $aExpVats = $aExpected['totals']['vats'];
        $aProductVats = $oBasket->getProductVats();
        $this->assertEquals( count( $aExpVats ), count( $aProductVats ), "Expected basket different vat amount doesn't match actual" );
        if ( !empty( $aExpVats ) ) {
            foreach ( $aProductVats as $sPercent => $sSum ) {
                $this->assertEquals( $aExpVats[$sPercent], $sSum, "Total Vat of {$sPercent}%" );
            }
        }

        // Wrapping costs
        $aExpWraps = $aExpected['totals']['wrapping'];
        if ( !empty( $aExpWraps ) ) {
            $this->assertEquals(
                    $aExpWraps['brutto'],
                    $oBasket->getFWrappingCosts(),
                    "Total wrappings brutto price"
            );
            $this->assertEquals(
                    $aExpWraps['netto'],
                    $oBasket->getWrappCostNet(),
                    "Total wrappings netto price"
            );
            $this->assertEquals(
                    $aExpWraps['vat'],
                    $oBasket->getWrappCostVat(),
                    "Total wrappings vat price"
            );
        }

        // Giftcard costs 
        $aExpCards = $aExpected['totals']['giftcard'];
        if ( !empty( $aExpCards ) ) {
            $this->assertEquals(
                    $aExpCards['brutto'],
                    $oBasket->getFGiftCardCosts(),
                    "Total giftcard brutto price"
            );
            $this->assertEquals(
                    $aExpCards['netto'],
                    $oBasket->getGiftCardCostNet(),
                    "Total giftcard netto price"
            );
            $this->assertEquals(
                    $aExpCards['vat'],
                    $oBasket->getGiftCardCostVat(),
                    "Total giftcard vat price"
            );
        }

        // Delivery costs
        $aExpDel = $aExpected['totals']['delivery'];
        if ( !empty( $aExpDel ) ) {
            $this->assertEquals(
                    $aExpDel['brutto'],
                    number_format( round( $oBasket->getDeliveryCosts(), 2 ) , 2, ',', '.'),
                    "Delivery total brutto price"
            );
            $this->assertEquals(
                    $aExpDel['netto'],
                    $oBasket->getDelCostNet(),
                    "Delivery total netto price"
            );
            $this->assertEquals(
                    $aExpDel['vat'],
                    $oBasket->getDelCostVat(),
                    "Delivery total vat price"
            );
        }

        // Payment costs 
        $aExpPay = $aExpected['totals']['payment'];
        if ( !empty( $aExpPay ) ) {
        $this->assertEquals(
                $aExpPay['brutto'],
                number_format( round( $oBasket->getPaymentCosts(), 2 ), 2, ',', '.'),
                "Payment total brutto price"
        );
        $this->assertEquals(
                $aExpPay['netto'],
                $oBasket->getPayCostNet(),
                "Payment total netto price"
        );
        $this->assertEquals(
                $aExpPay['vat'],
                $oBasket->getPayCostVat(),
                "Payment total vat price"
        );
        }

        // Vouchers
        $aExpVoucher = $aExpected['totals']['voucher'];
        if ( !empty( $aExpVoucher ) ) {
            $this->assertEquals(
                    $aExpVoucher['brutto'],
                    number_format( round( $oBasket->getVoucherDiscValue(), 2 ), 2, ',', '.'),
                    "Voucher total discount brutto"
            );
        }

        // Total netto & brutto, grand total
        $this->assertEquals( $aExpected['totals']['totalNetto'], $oBasket->getProductsNetPrice(), "Total Netto" );
        $this->assertEquals( $aExpected['totals']['totalBrutto'], $oBasket->getFProductsPrice(), "Total Brutto" );
        $this->assertEquals( $aExpected['totals']['grandTotal'], $oBasket->getFPrice(), "Grand Total");
    }
    
    /**
     * Truncates specified table
     * @param string $sTable table name
     */
    protected function _truncateTable( $sTable )
    {
        return oxDb::getDb()->execute( "TRUNCATE {$sTable}" );
    }
    
    /**
     * Basket startup data and expected calculations results
     */
    public function _dpData()
    {
        return $this->_getTestCases( $this->_aTestCaseDirs, $this->_aTestCases );
    }
    
    /**
     * Getting test cases from specified
     * @param array $aDir directory name
     * @param array $aTestCases of specified test cases
     */
    protected function _getTestCases( $aDir, $aTestCases = array() )
    {
        // load test cases
        $aGlobal = array();
        foreach ( $aDir as $sDir ) {
            $sPath = "integration/price/" . $sDir . "/";
            print( "Scanning dir {$sPath}\r\n" );
            if ( empty( $aTestCases ) ) {
                $aFiles = glob( $sPath . "*.php", GLOB_NOSORT );
                if ( empty( $aFiles ) ) {
                    $aSubDirs = scandir( $sPath );
                    foreach ( $aSubDirs as $sSubDir ) {
                        $sPath = "integration/price/" . $sDir . "/" . $sSubDir . "/";
                        $aFiles = array_merge( $aFiles, glob( $sPath . "*.php", GLOB_NOSORT ) );
                    }
                }
            } else {
                foreach ( $aTestCases as $sTestCase ) {
                    $aFiles[] = $sPath . $sTestCase;
                }
            }
            print( count( $aFiles) . " test cases found\r\n" );
            foreach ( $aFiles as $sFilename ) {
                include( $sFilename );
                $aGlobal["{$sFilename}"] = array($aData);
            }
        }
        return $aGlobal;
    }
}