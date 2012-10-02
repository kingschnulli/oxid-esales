<?php
require_once realpath(dirname(__FILE__).'/../../') . '/unit/OxidTestCase.php';
require_once realpath(dirname(__FILE__).'/../../') . '/integration/price/basketconstruct.php';

class DataGenerator extends OxidTestCase
{
    // Shop modes: brutto-brutto or netto-brutto
    private $blEnterNetPrice = false;
    private $blShowNetPrice = false;
    // Test case variants
    private $iVariants = 1;
    // Custom general name of test cases. Will produce files like RandomCase_x for each case.
    private $sCaseName = "nb_";
    // Databomb folder path
    private $sFilepath = "integration/price/databomb/netto_brutto/";
    // Price in cents
    private $dPriceFrom = 1; 
    private $dPriceTo = 100099;
    // Min basket positions
    private $iBasketPosMin = 2;
    // Max basket positions
    private $iBasketPosMax = 2;
    // Min diff vats
    private $iDiffVatCountMin = 1;
    // Max diff vats
    private $iDiffVatCountMax = 1;
    // Min article amount at one position
    private $iAmountMin = 1;
    // Max article amount at one position
    private $iAmountMax = 1000;
    // Active currency rate
    private $activeCurrencyRate = 1;
    
    // Discount params
    private $iDisVariants = 2;
    private $sDisName = "testDiscount";
    private $iDisMinAddsum = 1;
    private $iDisMaxAddsum = 100;
    private $aDisTypes = array( 
            "abs",
             "%",
            "itm" 
            );
    private $iDisAmount = 0;
    private $iDisAmountTo = 99999;
    private $iDisPrice = 1;
    private $iDisPriceTo = 99999;
    private $iDisMaxNrArtsApply = 10;
    
    // Wrapping params
    private $iWrapMinPrice = 0;
    private $iWrapMaxPrice = 10;
    private $iWrapMaxNrArtsApply = 2;
    private $aWrapTypes = array( "WRAP", "CARD" );

    // Delivery params
    private $iDelMinAddSum = 1;
    private $iDelMaxAddSum = 25;
    private $iDelAddSumTypes = array( "abs", "%" );
    private $iDelTypes = array( "a", "s", "w", "p" );
    //'oxfinalize' => 1,
    //'oxparamend' => 99999,
    // Payment params
    
    // Voucherseries params + voucher amount
    private $iVouNumber = 1;
    private $iVouSerieMinDiscount = 1.5;
    private $iVouSerieMaxDiscount = 13;
    private $aVouSerieTypes = array (
            'absolute',
            'percent'
            );
    // What additional costs to generate
    private $aGenCosts = array ( 
        array( "wrapping", 1 ), 
        array( "payment",  1 ), 
        array( "delivery", 1 )
    );
    private $blGenDiscounts = false;
    private $blGenVouchers = false;
    /**
     * Initialize the fixture.
     */
    protected function setUp()
    {
        parent::setUp();
        $this->_truncateTable( "oxarticles" );
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
        //$this->_generateSqlDump();
        parent::tearDown();
    }
    
    /**
     * Function to return vat set of world's vats
     * 
     * @return array of different vats
     */
    protected function _getVatSet()
    {
        return array(
            27, 25.5, 25, 24, 23, 22, 21, 21.2, 20,
            19.6, 19, 18, 17.5, 17, 16, 15, 14.5, 14, 13, 13.5, 12.5, 12, 11, 10.5, 10,
            9, 8.5, 8, 7, 6, 6.5, 5.6, 5.5, 5, 4.8, 4.5, 4, 3.8, 3, 2.5, 2.1, 2, 1, 0
        );
    }
    
    /**
     * Create test case file

     * @param string $sFilename test case filename
     * 
     * @return file resource
     */
    protected function _createFile( $sFilename )
    {
        return fopen($this->sFilepath . $sFilename, "w");
    }
    
    /**
     * Writes data array to file with provided handle
     * 
     * @param file resource to write $rHandle
     * @param array $aData of data needed to write
     * 
     * @return mixed
     */
    protected function _writeToFile( $rHandle, $aData )
    {
        $sStart = "<?php\r";
        $sStart .= "\$aData = ";
        $sData = var_export( $aData, true );
        $sEnd = ";";
        return fwrite( $rHandle, $sStart.$sData.$sEnd );
    }
    
    /**
     * Main generator startup function, calls other utilities
     * 
     * @test
     */
    public function generate() 
    {
        if ( !is_dir( $this->sFilepath ) ) {
            mkdir( $this->sFilepath, '0777' );
        }
        for ($i = 1; $i <= $this->iVariants; $i++) {
            $aData = $this->_generateData();
            /*$sFilename = "{$this->sCaseName}{$i}.php";
            $rHandle = $this->_createFile( $sFilename );
            $this->_writeToFile( $rHandle, $aData );
            print("o-");*/
            var_dump( $aData );
        }
    }
    
    /**
     * Data generator
     * 
     * @return array $aData of basket data and expectations 
     */
    protected function _generateData()
    {
        $oUtil = oxUtilsObject::getInstance();
        // init result array
        $aData = array();
        // get basket position count
        $iRandArtCount = rand( $this->iBasketPosMin, $this->iBasketPosMax );
        // get different vat count
        $iDiffVatCount = rand( $this->iDiffVatCountMin, $this->iDiffVatCountMax );
        // get $iDiffVatCount vats from vat set
        $aVats = array_rand( $this->_getVatSet(), $iDiffVatCount );
        // create articles array
        for ($i = 0; $i < $iRandArtCount; $i++ ) {
            $aArticle = array();
            $sUID = $oUtil->generateUId();
            $aArticle['oxid'] = $sUID;
            $aArticle['oxprice'] = mt_rand( $this->dPriceFrom, $this->dPriceTo ) / 100;
            
            // check if got any special vat
            if ( count( $aVats ) > 0 ) {
                // check if got vat set vs single vat
                if ( count( $aVats ) == 1 ) {
                    $aArticle['oxvat'] = $aVats;
                } else {
                    $aArticle['oxvat'] = $aVats[ array_rand( $aVats, 1 ) ];
                }
            }
            $aArticle['amount'] = rand( $this->iAmountMin, $this->iAmountMax );
            $aData['articles'][$i] = $aArticle; 
        }
        if ( $this->blGenDiscounts ) {
            // create discount array
            $this->_generateDiscounts( $aData );
        }
        if ( !empty( $this->aGenCosts ) ) {
            // create costs array
            $this->_generateCosts( $aData );
        }
        // create options array
        $aData['options'] = array();
        $aData['options']['config']['blEnterNetPrice'] = $this->blEnterNetPrice;
        $aData['options']['config']['blShowNetPrice'] = $this->blShowNetPrice;
        $aData['options']['activeCurrencyRate'] = $this->activeCurrencyRate;
        // create expected array
        $aData['expected'] = $this->_gatherExpectedData( $aData );
        return $aData;
    }
    
    protected function _generateCosts( &$aData )
    {
        // every cost one
        $aCosts = array();
        foreach ( $aGenCosts as $aCostData ) {
            
            switch( $aCostData[0] ) {
                case 'wrapping':
                    $aCosts['wrapping'] = array();
                    for ( $i = 0; $i < $aCostData[1]; $i++ ) {
                        $aCost = array();
                        $aCost['oxtype'] = array_rand( $this->aWrapTypes, 1 );
                        $aCost['oxprice'] = mt_rand( $this->iWrapMinPrice, $this->iWrapMaxPrice );
                        $aCost['oxactive'] = 1;
                        $aCosts['wrapping'][$i] = $aCost;
                    }
                    break;
                case 'payment':
                    $aCosts['payment'] = array();
                    // oxpayments DB fields
                    /*'oxaddsum' => 1,
                    'oxaddsumtype' => 'abs',
                    'oxfromamount' => 0,
                    'oxtoamount' => 1000000,
                    'oxchecked' => 1,*/
                    break;
                case 'delivery':
                    // oxdelivery DB fields
                    /*'oxactive' => 1,
                    'oxaddsum' => 1,
                    'oxaddsumtype' => 'abs',
                    'oxdeltype' => 'p',
                    'oxfinalize' => 1,
                    'oxparamend' => 99999,*/
                    break;
                default:
                    break;
            }
        }
        $aData['costs'] = $aCosts;
    }
    
    protected function _generateDiscounts( &$aData )
    {
        $aDiscounts = array();
        
        for( $i = 0; $i < $this->iDisVariants; $i++) {
            $aDiscounts[$i]['oxaddsum']     = mt_rand( $this->iDisMinAddsum, $this->iDisMaxAddsum );
            $aDiscounts[$i]['oxid']         = $this->sDisName . '_' . $i;
            $aDiscounts[$i]['oxaddsumtype'] = $this->aDisTypes[ array_rand( $this->aDisTypes, 1 ) ];
            $aDiscounts[$i]['oxamount']     = $this->iDisAmount;
            $aDiscounts[$i]['oxamountto']   = $this->iDisAmountTo;
            $aDiscounts[$i]['oxprice']      = $this->iDisPrice;
            $aDiscounts[$i]['oxpriceto']    = $this->iDisPriceTo;
            $aDiscounts[$i]['oxactive']     = 1;
            if ( $this->iDisMaxNrArtsApply > 0 ) {
                $aDiscounts[$i]['oxarticles'] = array();
                if ( $this->iDisMaxNrArtsApply <= count( $aData['articles'] ) ) {
                    $iRandCount = $this->iDisMaxNrArtsApply;
                } else {
                    $iRandCount = count( $aData['articles'] );
                }
                $mxRand = array_rand( $aData['articles'], $iRandCount );
                $iMxRandCount = count( $mxRand );
                for ( $j = 0; $j < $iMxRandCount; $j++ ) {
                    array_push( $aDiscounts[$i]['oxarticles'], $aData['articles'][ $j ]['oxid'] );
                }                                
            }
        }
        $aData['discounts'] = $aDiscounts;
    }
    
    /**
     * Gathering expectations
     * 
     * @param array's of articles, discounts, costs, options
     * 
     * @return array $aExpected of expected data
     */
    protected function _gatherExpectedData( $aTestCase )
    {
        // load calculated basket
        $oBasketConstruct = new BasketConstruct();
        $oBasket = $oBasketConstruct->calculateBasket( $aTestCase );
        // gathering data arrays
        $aExpected = array();
        // Basket item list
        $aBasketItemList = $oBasket->getContents();
        if ( $aBasketItemList ) {
            foreach ( $aBasketItemList as $iKey => $oBasketItem ) {
                $iArtId = $oBasketItem->getArticle()->getID();
                $aExpected['articles'][$iArtId] = array ( $oBasketItem->getFUnitPrice(), $oBasketItem->getFTotalPrice() );
            }
        }
        // Basket total discounts
        $aProductDiscounts = $oBasket->getDiscounts();
        if ( $aProductDiscounts ) {
            foreach ( $aProductDiscounts as $oDiscount ) {
                $aExpected['totals']['discounts'][$oDiscount->sOXID] = $oDiscount->fDiscount;
            }
        }
        // VAT's
        $aProductVats = $oBasket->getProductVats();
        if ( $aProductVats ) {
            foreach ( $aProductVats as $sPercent => $sSum ) {
                $aExpected['totals']['vats'][$sPercent] = $sSum;
            }
        }
        // Wrapping costs
        $aExpected['totals']['wrapping']['brutto'] = $oBasket->getFWrappingCosts();
        $aExpected['totals']['wrapping']['netto'] = $oBasket->getWrappCostNet();
        $aExpected['totals']['wrapping']['vat'] = $oBasket->getWrappCostVat();
        // Giftcard costs
        $aExpected['totals']['giftcard']['brutto'] = $oBasket->getFGiftCardCosts();
        $aExpected['totals']['giftcard']['netto'] = $oBasket->getGiftCardCostNet();
        $aExpected['totals']['giftcard']['vat'] = $oBasket->getGiftCardCostVat();
        // Delivery costs
        $aExpected['totals']['delivery']['brutto'] = number_format( round( $oBasket->getDeliveryCosts(), 2 ) , 2, ',', '.');
        $aExpected['totals']['delivery']['netto'] = $oBasket->getDelCostNet();
        $aExpected['totals']['delivery']['vat'] = $oBasket->getDelCostVat();
        // Payment costs
        $aExpected['totals']['payment']['brutto'] = number_format( round( $oBasket->getPaymentCosts(), 2 ), 2, ',', '.');
        $aExpected['totals']['payment']['netto'] = $oBasket->getPayCostNet();
        $aExpected['totals']['payment']['vat'] = $oBasket->getPayCostVat();
        // Vouchers
        $aExpected['totals']['voucher']['brutto'] = number_format( round( $oBasket->getVoucherDiscValue(), 2 ), 2, ',', '.');
        // Total netto & brutto, grand total
        $aExpected['totals']['totalNetto'] = $oBasket->getProductsNetPrice();
        $aExpected['totals']['totalBrutto'] = $oBasket->getFProductsPrice();
        $aExpected['totals']['grandTotal'] = $oBasket->getFPrice();
        // Finished generating expectations
        return $aExpected;
    }
    
    /**
     * Generating sql dump of required tables (oxarticles)
     */
    protected function _generateSqlDump()
    {
        $dbhost   = $this->getConfigParam( "dbHost" );
        $dbuser   = $this->getConfigParam( "dbUser" );
        $dbpwd    = $this->getConfigParam( "dbPwd" );
        $dbname   = $this->getConfigParam( "dbName" );
        $dumpfile = "oxarticles.sql";
        
        passthru("/usr/bin/mysqldump --opt --host=$dbhost --user=$dbuser --password=$dbpwd $dbname oxarticles > $this->sFilepath/$dumpfile");
        
        echo "$dumpfile "; passthru("tail -1 $this->sFilepath/$dumpfile");
    }
    
    
    /**
     * Truncates specified table
     * @param string $sTable table name
     */
    protected function _truncateTable( $sTable )
    {
        return oxDb::getDb()->execute( "TRUNCATE {$sTable}" );
    }
}