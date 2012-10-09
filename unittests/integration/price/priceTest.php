<?php
require_once realpath(dirname(__FILE__).'/../../') . '/unit/OxidTestCase.php';
require_once realpath( dirname(__FILE__) ) . '/basketconstruct.php';

/**
 * Shop price calculation test
 * Check:
 * - Article brutto price
 */
class Integration_Price_PriceTest extends OxidTestCase
{
    /* Test case directory array */
    private $_aTestCaseDirs = array (
            "testcases/price",
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
        $this->_truncateTable( "oxarticles" );
        $this->_truncateTable( "oxdiscount" );
        $this->_truncateTable( "oxobject2discount" );
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
        return $this->_getTestCases( $this->_aTestCaseDirs, $this->_aTestCases );
    }
    
    /**
     * Tests price calculation
     * @dataProvider _dpData
     */
    public function testPrice( $aTestCase )
    {
        // getting config
        $oConfig = oxRegistry::getConfig();
        
        // gather data from test case
        $aExpected  = $aTestCase['expected'];
        
        // load calculated basket from provided data
        $oConstruct = new BasketConstruct();
        
        // setup options
        $oConstruct->setOptions( $aTestCase['options'] );
        
        // create articles
        $aArts = $oConstruct->getArticles( $aTestCase['articles'], $blGetIds = true );

        // apply discounts
        $oConstruct->setDiscounts( $aTestCase['discounts'] ); 
        
        // iteration through expectations
        foreach ( $aArts as $aArt ) {
            $oArt = new oxArticle();
            $oArt->load( $aArt['id'] );
            $oPrice = $oArt->getPrice();
            $aExp = $aExpected[ $aArt['id'] ];
            // checking brutto price of article
            $this->assertEquals( $aExp['brutto'], round( $oPrice->getBruttoPrice(), 2 ), "Brutto of article #{$aArt['id']}" );
            // other checkable prices
            /*$this->assertEquals( $aExp['netto'], round( $oPrice->getNettoPrice(), 2 ), "Netto" );
            $this->assertEquals( $aExp['vat'], $oPrice->getVat(), "Vat" );
            $this->assertEquals( $aExp['vatValue'], round( $oPrice->getVatValue(), 2 ), "Vat value" );
            $this->assertEquals( $aExp['discounts'], $oPrice->getDiscounts(), "Discounts" );*/
        }
    }
        
    /**
     * Getting test cases from specified
     * @param string $sDir directory name
     * @param array $aTestCases of specified test cases
     */
    protected function _getTestCases( $aDir, $aTestCases = array() )
    {
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
    
    /**
     * Truncates specified table
     * @param string $sTable table name
     */
    protected function _truncateTable( $sTable )
    {
        return oxDb::getDb()->execute( "TRUNCATE {$sTable}" );
    }
    
}