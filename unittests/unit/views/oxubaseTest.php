<?php
/**
 *    This file is part of OXID eShop Community Edition.
 *
 *    OXID eShop Community Edition is free software: you can redistribute it and/or modify
 *    it under the terms of the GNU General Public License as published by
 *    the Free Software Foundation, either version 3 of the License, or
 *    (at your option) any later version.
 *
 *    OXID eShop Community Edition is distributed in the hope that it will be useful,
 *    but WITHOUT ANY WARRANTY; without even the implied warranty of
 *    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *    GNU General Public License for more details.
 *
 *    You should have received a copy of the GNU General Public License
 *    along with OXID eShop Community Edition.  If not, see <http://www.gnu.org/licenses/>.
 *
 * @link      http://www.oxid-esales.com
 * @package   tests
 * @copyright (C) OXID eSales AG 2003-2010
 * @version OXID eShop CE
 * @version   SVN: $Id: oxubaseTest.php 26841 2010-03-25 13:58:15Z arvydas $
 */

require_once realpath( "." ).'/unit/OxidTestCase.php';
require_once realpath( "." ).'/unit/test_config.inc.php';

if ( !function_exists( 'getSeoProcType' ) ) {
    function getSeoProcType()
    {
        return Unit_oxubaseTest::$iProcType;
    }
}

class testOxViewComponent extends oxUBase
{
    public $initWasCalled = false;
    public $setParentWasCalled = false;
    public $setThisActionWasCalled = false;

    public function init()
    {
        $this->initWasCalled = true;
    }

    public function setParent( $oParam = null )
    {
        $this->setParentWasCalled = true;
    }

    public function setThisAction( $oParam = null )
    {
        $this->setThisActionWasCalled = true;
    }
}


/**
 * Testing oxvendorlist class
 */
class Unit_Views_oxubaseTest extends OxidTestCase
{
    protected $_sRequestMethod = null;
    protected $_sRequestUri    = null;

    /**
     * Initialize the fixture.
     *
     * @return null
     */
    protected function setUp()
    {
        // adding article to recommendlist
        $sQ = 'insert into oxrecommlists ( oxid, oxuserid, oxtitle, oxdesc, oxshopid ) values ( "testlist", "oxdefaultadmin", "oxtest", "oxtest", "'.oxConfig::getInstance()->getShopId().'" ) ';
        oxDb::getDB()->Execute( $sQ );

        parent::setUp();

        // backuping
        $this->_sRequestMethod = $_SERVER["REQUEST_METHOD"];
        $this->_sRequestUri    = $_SERVER['REQUEST_URI'];
    }

    /**
     * Tear down the fixture.
     *
     * @return null
     */
    protected function tearDown()
    {
        // restoring
        $_SERVER["REQUEST_METHOD"] = $this->_sRequestMethod;
        $_SERVER['REQUEST_URI']    = $this->_sRequestUri;

        oxDb::getDb()->execute( 'delete from oxrecommlists where oxid like "testlist%" ');
        oxDb::getDb()->execute( 'delete from oxseologs ');
        oxDb::getDb()->execute( 'delete from oxseo where oxtype != "static"' );

        oxDb::getDb()->execute( 'delete from oxcontents where oxloadid = "_testKeywordsIdentId" ' );

        $oUBase = new oxUbase();
        $oUBase->getSession()->setBasket( null );

        parent::tearDown();
    }

    /**
     * Getting view values
     */
    public function testGetActiveRecommList()
    {
        modConfig::setParameter( 'recommid', 'testlist' );
        $oView = new oxUbase();
        $this->assertEquals( 'testlist', $oView->getActiveRecommList()->getId() );
    }

    public function testGetCanonicalUrl()
    {// just check if function exists and returns null
        $o = new oxUBase();
        $this->assertSame(null, $o->getCanonicalUrl());
    }

    public function testSetGetManufacturerTree()
    {
        $oUbase = new oxUBase();
        $oUbase->setManufacturerTree( 'oManufacturerTree' );
        $this->assertEquals( 'oManufacturerTree', $oUbase->getManufacturerTree() );
    }

    public function testLoadActions()
    {
        $oUbase = $this->getMock( 'oxubase', array( 'getBargainArticleList', 'getTop5ArticleList' ) );
        $oUbase->expects( $this->once() )->method( 'getBargainArticleList')->will( $this->returnValue( 'aBargainArticleList' ) );
        $oUbase->expects( $this->once() )->method( 'getTop5ArticleList')->will( $this->returnValue( 'aTop5ArticleList' ) );
        $oUbase->UNITloadActions();

        $aViewData = $oUbase->getViewData();
        $this->assertEquals( 'aBargainArticleList', $aViewData['articlebargainlist'] );
        $this->assertEquals( 'aTop5ArticleList', $aViewData['aTop5Articles'] );
    }

    public function testGetActSearch()
    {
        $oSearch = new oxStdClass();
        $oSearch->link = oxConfig::getInstance()->getShopHomeURL()."cl=search";

        $oUbase = new oxUBase();
        $this->assertEquals( $oSearch, $oUbase->getActSearch() );
    }

    public function testSetGetActManufacturer()
    {
        $oUbase = new oxUBase();
        $oUbase->setActManufacturer( 'oActManufacturer' );
        $this->assertEquals( 'oActManufacturer', $oUbase->getActManufacturer() );
    }

    public function testGetActTagSeo()
    {
        oxTestModules::addFunction("oxutils", "seoIsActive", "{return true;}");
        oxTestModules::addFunction("oxutilsserver", "getServerVar", "{ \$aArgs = func_get_args(); if ( \$aArgs[0] === 'HTTP_HOST' ) { return '".oxConfig::getInstance()->getShopUrl()."'; } elseif ( \$aArgs[0] === 'SCRIPT_NAME' ) { return ''; } else { return \$_SERVER[\$aArgs[0]]; } }");
        modConfig::setParameter( 'searchtag', 'someTag' );

        $oTag = new Oxstdclass();
        $oTag->sTag = 'someTag';
        $oTag->link = oxConfig::getInstance()->getShopUrl(). "tag/someTag/";

        $oUbase = new oxUBase();
        $this->assertEquals( $oTag, $oUbase->getActTag() );
    }

    public function testGetActTag()
    {
        oxTestModules::addFunction("oxutils", "seoIsActive", "{return false;}");
        modConfig::setParameter( 'searchtag', 'someTag' );

        $oTag = new Oxstdclass();
        $oTag->sTag = 'someTag';
        $oTag->link = oxConfig::getInstance()->getShopHomeURL(). "cl=tag&amp;searchtag=someTag";

        $oUbase = new oxUBase();
        $this->assertEquals( $oTag, $oUbase->getActTag() );
    }

    public function testSetGetViewProduct()
    {
        $oUbase = new oxUBase();
        $oUbase->setViewProduct( 'oProduct' );
        $this->assertNull( $oUbase->getViewProduct() );
    }

    public function testGetViewProductList()
    {
        $oUbase = $this->getProxyClass( 'oxUBase' );
        $oUbase->setNonPublicVar( '_aArticleList', 'aArticleList' );
        $this->assertEquals( 'aArticleList', $oUbase->getViewProductList() );
    }

    public function testIsMoreTagsVisible()
    {
        $oUbase = new oxUBase();
        $this->assertFalse( $oUbase->isMoreTagsVisible() );
    }

    public function testGetActManufacturerRoot()
    {
        modConfig::setParameter( 'mnid', 'root' );

        $oUbase = new oxUBase();
        $this->assertEquals( oxManufacturer::getRootManufacturer(), $oUbase->getActManufacturer() );
    }

    public function testGetActManufacturer()
    {
            $sId = 'fe07958b49de225bd1dbc7594fb9a6b0';
        modConfig::setParameter( 'mnid', $sId );

        $oUbase = new oxUBase();
        $oMan = $oUbase->getActManufacturer();
        $this->assertEquals( $sId, $oMan->getId() );
    }

    public function testGetActVendorRoot()
    {
        modConfig::setParameter( 'cnid', 'v_root' );

        $oUbase = new oxUBase();
        $this->assertEquals( oxVendor::getRootVendor(), $oUbase->getActVendor() );
    }

    public function testGetActVendor()
    {
            $sId = 'v_68342e2955d7401e6.18967838';
        modConfig::setParameter( 'cnid', $sId );

        $oUbase = new oxUBase();
        $oVnd = $oUbase->getActVendor();
        $this->assertEquals( str_replace( 'v_', '', $sId ), $oVnd->getId() );
    }

    public function testSetGetActVendor()
    {
        $oUbase = new oxUBase();
        $oUbase->setActVendor( 'oActVendor' );
        $this->assertEquals( 'oActVendor', $oUbase->getActVendor() );
    }

    public function testSetGetVendorTree()
    {
        $oUbase = new oxUBase();
        $oUbase->setVendorTree( 'oVendorTree' );
        $this->assertEquals( 'oVendorTree', $oUbase->getVendorTree() );
    }

    public function testSetGetCategoryTree()
    {
        $oUbase = new oxUBase();
        $oUbase->setCategoryTree( 'oCategoryTree' );
        $this->assertEquals( 'oCategoryTree', $oUbase->getCategoryTree() );
    }

    public function testGetCatTreePath()
    {
        $oUbase = $this->getProxyClass( 'oxubase' );
        $oUbase->setNonPublicVar( '_sCatTreePath', 'scattreepath' );

        $this->assertEquals( 'scattreepath', $oUbase->getCatTreePath() );
    }

    public function testGetManufacturerId()
    {
        // active manufacturer is not set
        $oUbase = $this->getMock( 'oxubase', array( 'getActManufacturer' ) );
        $oUbase->expects( $this->once() )->method( 'getActManufacturer')->will( $this->returnValue( null ) );
        $this->assertFalse( $oUbase->getManufacturerId() );

        // active manufacturer was set
        $oManufacturer = $this->getMock( 'oxmanufacturer', array( 'getId' ) );
        $oManufacturer->expects( $this->once() )->method( 'getId')->will( $this->returnValue( 'someid' ) );

        $oUbase = $this->getMock( 'oxubase', array( 'getActManufacturer' ) );
        $oUbase->expects( $this->once() )->method( 'getActManufacturer')->will( $this->returnValue( $oManufacturer ) );
        $this->assertEquals( 'someid', $oUbase->getManufacturerId() );
    }

    public function testGetSetRootManufacturer()
    {
        $oUbase = new oxubase();
        $oUbase->setRootManufacturer( 'sRootManufacturer' );
        $this->assertEquals( 'sRootManufacturer', $oUbase->getRootManufacturer() );
    }

    public function testGetSetManufacturerlist()
    {
        $oUbase = new oxubase();
        $oUbase->setManufacturerlist( 'aManufacturerlist' );
        $this->assertEquals( 'aManufacturerlist', $oUbase->getManufacturerlist() );
    }

    /*
     * Test getting view ID without some params
     */
    public function testGetViewId()
    {
        $myConfig = oxConfig::getInstance();
        $sShopURL = $myConfig->getShopUrl();
        $sShopID  = $myConfig->getShopId();



            $oView = new oxubase();
            $sId = $oView->getViewId();
            $this->assertEquals( "ox|0|0", $oView->getViewId() );

            // and caching
            oxLang::getInstance()->setBaseLanguage( 1 );
            $this->assertEquals( "ox|0|0", $oView->getViewId() );
    }


    /*
     * Test getting view ID with some additional params
     */
    public function testGetViewIdWithOtherParams()
    {
        $myConfig = oxConfig::getInstance();

        oxLang::getInstance()->setBaseLanguage( 1 );
        modConfig::setParameter( 'currency', '1' );
        modConfig::setParameter( 'cl', 'details' );
        modConfig::setParameter( 'fnc', 'dsd' );
        modSession::getInstance()->setVar( "usr", 'oxdefaultadmin' );

        $oView = new oxubase();
        $sId = $oView->getViewId();

        $sShopURL = $myConfig->getShopUrl();
        $sShopID  = $myConfig->getShopId();


            $this->assertEquals( "ox|1|1", $sId );
    }

    public function testGetMetaDescriptionForStartView()
    {
        $sVal = 'Witzige und originelle Geschenke. Online Versand f�r Trend-Produkte, Lifestyle-Artikel und Accessoires. Geschenkideen f�r alle Anl�sse g�nstig online kaufen.';
        $oView = new start();

        $this->assertEquals( $sVal, $oView->getMetaDescription() );
    }

    public function testGetMetaKeywordsForStartView()
    {
        $oContent = new oxcontent();
        $oContent->loadByIdent( 'oxstartmetakeywords' );

        $oView = new start();
        $this->assertEquals( strip_tags($oContent->oxcontents__oxcontent->value), $oView->getMetaKeywords() );
    }

    /*
     * Checking if method does not removes dublicated words if meta keywords
     * are loaded from oxcontent table by ident (M:844)
     */
    public function testGetMetaKeywordsDoesNotRemovesDublicatedWords()
    {
        $oContent = new oxcontent();
        $oContent->oxcontents__oxloadid  = new oxField( '_testKeywordsIdentId' );
        $oContent->oxcontents__oxcontent = new oxField( 'online shop, cool stuff, stuff, buy' );
        $oContent->oxcontents__oxactive  = new oxField( 1 );
        $oContent->save();

        $sKeywords = $oContent->oxcontents__oxcontent->value;

        $oView = $this->getProxyClass('oxubase');
        $oView->setNonPublicVar( '_sMetaKeywordsIdent', '_testKeywordsIdentId' );

        $this->assertEquals( $sKeywords, $oView->getMetaKeywords() );
    }

    /*
     * Testing initiating components
     */
    public function testInitComponents()
    {
        $myConfig = oxConfig::getInstance();
        $oView = $this->getProxyClass('oxubase');
        $oView->setNonPublicVar( '_aComponentNames', array( "oxcmp_lang" => false ) );
        $oView->init();

        $aComponents = $oView->getComponents();
        $this->assertEquals( 1, count( $aComponents ) );
        $this->assertEquals( "oxcmp_lang", $aComponents["oxcmp_lang"]->getThisAction() );
        $this->assertEquals( "oxubaseproxy", $aComponents["oxcmp_lang"]->getParent()->getThisAction() );
    }

    /*
     * Testing initiating components when view is component
     */
    public function testIniOfComponent()
    {
        $oView = $this->getMock( "oxview", array( 'addGlobalParams' ) );
        $oView->expects( $this->never() )->method( 'addGlobalParams' );
        $oView->setIsComponent( true );
        $oView->init();
    }

    /*
     * Test rendering components
     */
    public function testRender()
    {
        oxConfig::getInstance()->setConfigParam( 'blDisableNavBars', true );
        $oView = $this->getMock( 'oxubase', array( 'getIsOrderStep',
                                                   'setShowNewsletter', 'setShowRightBasket', 'setShowLeftBasket',
                                                   'setShowTopBasket', 'isLowOrderPrice', 'getMinOrderPrice',
                                                   'getMetaDescription', 'getMetaKeywords', 'showLeftBasket',
                                                   'showRightBasket', 'showTopBasket', 'getNewsRealStatus', 'noIndex' ) );

        $oView->expects( $this->once() )->method( 'getIsOrderStep' )->will( $this->returnValue( true ) );
        $oView->expects( $this->once() )->method( 'setShowNewsletter' )->with( $this->equalTo( 0 ) );
        $oView->expects( $this->once() )->method( 'setShowRightBasket' )->with( $this->equalTo( 0 ) );
        $oView->expects( $this->once() )->method( 'setShowLeftBasket' )->with( $this->equalTo( 0 ) );
        $oView->expects( $this->once() )->method( 'setShowTopBasket' )->with( $this->equalTo( 0 ) );
        $oView->expects( $this->once() )->method( 'isLowOrderPrice' );
        $oView->expects( $this->once() )->method( 'getMinOrderPrice' );
        $oView->expects( $this->once() )->method( 'getMetaDescription' );
        $oView->expects( $this->once() )->method( 'getMetaKeywords' );
        $oView->expects( $this->once() )->method( 'showLeftBasket' );
        $oView->expects( $this->once() )->method( 'showRightBasket' );
        $oView->expects( $this->once() )->method( 'showTopBasket' );
        $oView->expects( $this->once() )->method( 'getNewsRealStatus' );
        $oView->expects( $this->once() )->method( 'noIndex' );

        $oView->render();
    }

    /*
     * Test how prepareSortColumns() sets session and view data
     */
    public function testPrepareSortColumnsSettingViewAndSessionData()
    {
        $myConfig  = oxConfig::getInstance();

        modConfig::setParameter( 'cnid', 'xxx' );
        modConfig::getInstance()->setConfigParam( 'aSortCols', array('oxid', 'oxprice') );

        $oView = new  oxubase();
        $oView->setItemSorting( 'xxx', 'oxid', 'asc' );
        $oView->prepareSortColumns();

        //checking view data
        $this->assertEquals( true, $oView->isSortingActive() );
        $this->assertEquals( array('oxid', 'oxprice'), $oView->getSortColumns() );
        $this->assertEquals( 'oxid asc', $oView->getSortingSql( 'xxx' ) );
    }

    /*
     * Test _setNrOfArtPerPage()
     */
    public function testSetNrOfArtPerPage()
    {
        $myConfig  = oxConfig::getInstance();
        $myConfig->setConfigParam( 'iNrofCatArticles', 10 );
        $myConfig->setConfigParam( 'aNrofCatArticles', 'xxx' );

        $myConfig->setConfigParam( 'iNrofSearchArticles', 15 );
        $myConfig->setConfigParam( 'aNrofSearchArticles', 'xxx' );

        $oView = new oxubase();
        $oView->UNITsetNrOfArtPerPage();

        $oViewConf = $oView->getViewConfig();
        $this->assertEquals( 10, $oViewConf->getViewConfigParam( 'iartPerPage' ) );
        $this->assertEquals( 10, $myConfig->getConfigParam('iNrofCatArticles') );
        $this->assertEquals( array( 10 ), $myConfig->getConfigParam('aNrofCatArticles') );
    }

    /*
     * Test _setNrOfArtPerPage()
     */
    public function testSetNrOfArtPerPageSetToSessionWithWrongNumber()
    {
        $myConfig  = oxConfig::getInstance();
        modConfig::setParameter( '_artperpage', 200 );

        $oView = new oxubase();
        $oView->UNITsetNrOfArtPerPage();

        $iCnt = modSession::getInstance()->getVar( "_artperpage" );

        $oViewConf = $oView->getViewConfig();
        $this->assertEquals( 10, $oViewConf->getViewConfigParam( 'iartPerPage' ) );
        $this->assertEquals( 10, $myConfig->getConfigParam('iNrofCatArticles') );
        $this->assertEquals( 10, $iCnt );
    }

    /*
     * Test _setNrOfArtPerPage() sets articles per page in session
     */
    public function testSetNrOfArtPerPageToSession()
    {
        $myConfig  = oxConfig::getInstance();
        $myConfig->setConfigParam( 'aNrofCatArticles', array( 0 => 30 ) );
        modConfig::setParameter( '_artperpage', 30 );

        $oView = new oxubase();
        $oView->UNITsetNrOfArtPerPage();

        $iCnt = modSession::getInstance()->getVar( "_artperpage" );

        $oViewConf = $oView->getViewConfig();
        $this->assertEquals( 30, $oViewConf->getViewConfigParam( 'iartPerPage' ) );
        $this->assertEquals( 30, $myConfig->getConfigParam('iNrofCatArticles') );
        $this->assertEquals( 30, $iCnt );
    }

    /*
     * Test _setNrOfArtPerPage() for calucating uses value setted in session
     */
    public function testSetNrOfArtPerPageFromSession()
    {
        $myConfig  = oxConfig::getInstance();
        $myConfig->setConfigParam( 'aNrofCatArticles', array( 0 => 26 ) );
        modSession::getInstance()->setVar("_artperpage", 26);

        $oView = new oxubase();
        $oView->UNITsetNrOfArtPerPage();

        $iCnt = modSession::getInstance()->getVar( "_artperpage" );

        $oViewConf = $oView->getViewConfig();
        $this->assertEquals( 26, $oViewConf->getViewConfigParam( 'iartPerPage' ) );
        $this->assertEquals( 26, $myConfig->getConfigParam('iNrofCatArticles') );
        $this->assertEquals( 26, $iCnt );
    }

    /*
     * Test _setNrOfArtPerPage() without params
     */
    public function testSetNrOfArtPerPageWithoutParams()
    {
        $myConfig  = oxConfig::getInstance();

        $myConfig->setConfigParam( 'iNrofCatArticles', null );
        $myConfig->setConfigParam( 'aNrofCatArticles', null );

        $oView = new oxubase();
        $oView->UNITsetNrOfArtPerPage();

        $iCnt = modSession::getInstance()->getVar( "_artperpage" );

        $oViewConf = $oView->getViewConfig();
        $this->assertEquals( 10, $oViewConf->getViewConfigParam( 'iartPerPage' ) );
        $this->assertEquals( 10, $myConfig->getConfigParam('iNrofCatArticles') );
        $this->assertEquals( null, $iCnt );
    }

    /*
     * Test _setNrOfArtPerPage() without params
     */
    public function testSetNrOfArtPerPageWithFirstParam()
    {
        $myConfig  = oxConfig::getInstance();

        $myConfig->setConfigParam( 'iNrofCatArticles', null );
        $myConfig->setConfigParam( 'aNrofCatArticles', array( 0 => 2 ) );
        modSession::getInstance()->setVar("_artperpage", null);
        modConfig::setParameter( '_artperpage', null );

        $oView = new oxubase();
        $oView->UNITsetNrOfArtPerPage();

        $oViewConf = $oView->getViewConfig();
        $this->assertEquals( 2, $oViewConf->getViewConfigParam( 'iartPerPage' ) );
        $this->assertEquals( 2, $myConfig->getConfigParam('iNrofCatArticles') );
    }

    /*
     * Test _setNrOfArtPerPage() without params
     */
    public function testSetNrOfArtPerPageWithArtPerPage()
    {
        $myConfig  = oxConfig::getInstance();

        $myConfig->setConfigParam( 'iNrofCatArticles', null );
        $myConfig->setConfigParam( 'aNrofCatArticles', array( 0 => 2 ) );
        modSession::getInstance()->setVar("_artperpage", null);
        modConfig::setParameter( '_artperpage', 2 );

        $oView = new oxubase();
        $oView->UNITsetNrOfArtPerPage();

        $oViewConf = $oView->getViewConfig();
        $this->assertEquals( 2, $oViewConf->getViewConfigParam( 'iartPerPage' ) );
        $this->assertEquals( 2, $myConfig->getConfigParam('iNrofCatArticles') );
    }

    /*
     * M45: Possibility to push any "Show articles per page" number parameter
     */
    public function testSetNrOfArtPerPageWithWrongArtPerPage()
    {
        $myConfig  = oxConfig::getInstance();

        $myConfig->setConfigParam( 'iNrofCatArticles', null );
        $myConfig->setConfigParam( 'aNrofCatArticles', array( 0 => 10 ) );
        modSession::getInstance()->setVar("_artperpage", null);
        modConfig::setParameter( '_artperpage', 2 );

        $oView = new oxubase();
        $oView->UNITsetNrOfArtPerPage();

        $oViewConf = $oView->getViewConfig();
        $this->assertEquals( 10, $oViewConf->getViewConfigParam( 'iartPerPage' ) );
        $this->assertEquals( 10, $myConfig->getConfigParam('iNrofCatArticles') );
    }

    /*
     * Test setting meta description
     */
    public function testSetMetaDescription()
    {
        $sMeta = 'testValue';
        $oView = new oxubase();
        $oView->setMetaDescription( $sMeta );

        $this->assertEquals( $sMeta, $oView->getMetaDescription() );
    }

    public function testSetMetaDescriptionWhenSeoIsOn()
    {
        oxTestModules::addFunction("oxutils", "seoIsActive", "{return true;}");
        oxTestModules::addFunction("oxseoencoder", "unsetInstance", "{oxSeoEncoder::\$_instance = null;}");
        oxTestModules::addFunction("oxseoencoder", "getMetaData", '{return "xxx";}');

        $oE = oxNew('oxseoencoder');
        $oE->unsetInstance();

        $oView = $this->getMock( 'oxubase', array( '_prepareMetaDescription', '_getSeoObjectId' ) );
        $oView->expects( $this->never() )->method( '_prepareMetaDescription' );
        $oView->expects( $this->once() )->method( '_getSeoObjectId' )->will( $this->returnValue( 1 ) );
        $oView->setMetaDescription( null );

        $this->assertEquals( 'xxx', $oView->getMetaDescription() );
    }

    public function testSetMetaKeywordsWhenSeoIsOn()
    {
        oxTestModules::addFunction("oxutils", "seoIsActive", "{return true;}");
        oxTestModules::addFunction("oxseoencoder", "unsetInstance", "{oxSeoEncoder::\$_instance = null;}");
        oxTestModules::addFunction("oxseoencoder", "getMetaData", '{return "xxx";}');

        $oE = oxNew('oxseoencoder');
        $oE->unsetInstance();

        $oView = $this->getMock( 'oxubase', array( '_prepareMetaDescription', '_getSeoObjectId' ) );
        $oView->expects( $this->never() )->method( '_prepareMetaDescription' );
        $oView->expects( $this->once() )->method( '_getSeoObjectId' )->will( $this->returnValue( 1 ) );
        $oView->setMetaDescription( null );

        $this->assertEquals( 'xxx', $oView->getMetaKeywords() );
    }

    /*
     * Test prepearing meta description - stripping tags
     */
    public function testPrepareMetaDescriptionStripTags()
    {
        $sDesc = '<div>Test  <b>5er</b>  Edelstahl-Messerset.&nbsp;</div>';

        $oView = new oxubase();
        $sResult = $oView->UNITprepareMetaDescription( $sDesc );

        $this->assertEquals( "Test 5er Edelstahl-Messerset.", $sResult);
    }

    /*
     * Test prepearing meta description - truncating text
     */
    public function testPrepareMetaDescriptionWithLength()
    {
        $sDesc = '<div>Test  5er  Edelstahl-Messerset.&nbsp;';

        $oView = new oxubase();
        $sResult = $oView->UNITprepareMetaDescription( $sDesc, 12, false );

        $this->assertEquals( "Test 5er Ede", $sResult);
    }

    /*
     * Test prepearing meta description - removing spec. chars
     */
    public function testPrepareMetaDescriptionRemovesSpecChars()
    {
        $sDesc = "&nbsp; \" ".'\''." : ! ? \n \r \t \x95 \xA0 ;";

        $oView = new oxubase();
        $sResult = $oView->UNITprepareMetaDescription( $sDesc );

        $this->assertEquals( "", $sResult);
    }

    /*
     * Test prepearing meta description - removing spec. chars skips dots and commas
     * (M:844)
     */
    public function testPrepareMetaDescriptionDoesNotRemovesDotsAndCommas()
    {
        $sDesc = "Lady Gaga, Pokerface.";

        $oView = new oxubase();
        $sResult = $oView->UNITprepareMetaDescription( $sDesc );

        $this->assertEquals( "Lady Gaga, Pokerface.", $sResult);
    }

    /*
     * Test prepearing meta description - removing dublicates
     */
    public function testPrepareMetaDescriptionRemovesDublicates()
    {
        $sDesc = "aa bb aa cc aa";

        $oView = new oxubase();
        $sResult = $oView->UNITprepareMetaDescription( $sDesc, -1, true );

        $this->assertEquals( "aa, bb, cc", $sResult );
    }

    /*
     * Test prepearing meta description - not removing dublicates
     */
    public function testPrepareMetaDescriptionNotRemovesDublicates()
    {
        $sDesc = "aa bb aa cc aa";

        $oView = new oxubase();
        $sResult = $oView->UNITprepareMetaDescription( $sDesc, -1, false );

        $this->assertEquals( "aa bb aa cc aa", $sResult);
    }

    /*
     * Test setting meta keywords
     */
    public function testSetMetaKeywords()
    {
        $sKeywords = 'xxx';
        $oView = new oxubase();
        $oView->setMetaKeywords( $sKeywords );

        $this->assertEquals( $sKeywords, $oView->getMetaKeywords() );
    }

    /*
     * Test prepare meta keywords
     */
    public function testPrepareMetaKeywords()
    {
        $sDesc = '<div>aaa  <b>bbb</b> ,ccc.&nbsp;</div>';

        $oView = new oxubase();
        $sResult = $oView->UNITprepareMetaKeyword( $sDesc );

        $this->assertEquals( "aaa, bbb, ccc.", $sResult);
    }

    /*
     * Test prepare meta keywords - removing dublicated words
     */
    public function testPrepareMetaKeywordsRemovesDefinedStrings()
    {
        $myConfig  = oxConfig::getInstance();
        $myConfig->setConfigParam( 'aSkipTags', array('ccc') );

        $sDesc = 'aaa bbb ccc ddd';

        $oView = new oxubase();
        $sResult = $oView->UNITprepareMetaKeyword( $sDesc );

        $this->assertEquals( "aaa, bbb, ddd", $sResult);
    }

    /*
     * Test prepearing meta keywords - removing dublicated words and lowercase words
     * (M:844)
     */
    public function testPrepareMetaKeywordsRemovesDotsAndCommas()
    {
        $sDesc = "Lady Gaga, Gaga, Lady, Pokerface.";

        $oView = new oxubase();
        $sResult = $oView->UNITprepareMetaKeyword( $sDesc );

        $this->assertEquals( "lady, gaga, pokerface.", $sResult);
    }
        /*
     * Test prepearing meta keywords - removing spec. chars skips dots and commas
     * and dublicated words
     * (M:844)
     */
    public function testPrepareMetaKeywordsDoesNotRemovesDotsAndCommas()
    {
        $sDesc = "Lady Gaga, Pokerface realy realy...";

        $oView = new oxubase();
        $sResult = $oView->UNITprepareMetaKeyword( $sDesc, false );

        $this->assertEquals( "Lady Gaga, Pokerface realy realy...", $sResult);
    }

    /*
     * Test removing dublicated words from string
     */
    public function testsRemoveDuplicatedWords()
    {
        $sDesc = 'aaa ccc bbb ccc ddd ccc';

        $oView = new oxubase();
        $sResult = $oView->UNITremoveDuplicatedWords( $sDesc );

        $this->assertEquals( "aaa, ccc, bbb, ddd", $sResult);
    }

    /*
     * Test removing dublicated words from array
     */
    public function testsRemoveDuplicatedWordsFromArray()
    {
        $sDesc = array('aaa', 'ccc', 'bbb', 'ccc', 'ddd', 'ccc');

        $oView = new oxubase();
        $sResult = $oView->UNITremoveDuplicatedWords( $sDesc );

        $this->assertEquals( "aaa, ccc, bbb, ddd", $sResult);
    }

    /*
     * Test set/get components array
     */
    public function testSetGetComponents()
    {
        $oView = new oxUBase();
        $oView->setComponents( array('1a', '2b') );
        $this->assertEquals( array('1a', '2b'), $oView->getComponents() );
    }

    /*
     * Test set/get is an order step
     */
    public function testIsOrderStep()
    {
        $oView = new oxubase();
        $oView->setIsOrderStep( '123456789' );
        $this->assertEquals( '123456789', $oView->getIsOrderStep() );
    }

    /*
     * Test adding additional data to _viewData
     */
    public function testSetAdditionalParams()
    {
        modConfig::setParameter( 'cnid', 'testCnId' );
        modConfig::setParameter( 'lang', '1' );
        modConfig::setParameter( 'searchparam', 'aa' );
        modConfig::setParameter( 'searchtag', 'testtag' );
        modConfig::setParameter( 'searchcnid', 'testcat' );
        modConfig::setParameter( 'searchvendor', 'testvendor' );
        $oView = oxNew( 'oxubase' );
        $oView->setClassName( 'testClass' );
        $myConfig  = $this->getMock('oxconfig', array('getActiveView'));
        $myConfig->expects($this->once())
                 ->method('getActiveView')
                 ->will($this->returnValue($oView));
        $oView->setConfig( $myConfig );
        $oView->UNITsetAdditionalParams();

        $sAdditionalParams = '';
        if ( ( $sLang = oxLang::getInstance()->getUrlLang() ) ) {
            $sAdditionalParams = $sLang."&amp;";
        }
        $sAdditionalParams .= "cl=testClass&amp;searchparam=aa&amp;searchtag=testtag&amp;searchcnid=testcat&amp;searchvendor=testvendor&amp;cnid=testCnId";
        $this->assertEquals( $sAdditionalParams, $oView->getAdditionalParams() );
    }

    /*
     * Test AddGlobalParams() calls _setNrOfArtPerPage()
     */
    public function testAddGlobalParamsCallsSetNrOfArtPerPage()
    {
        $oView = $this->getMock('oxubase', array('_setNrOfArtPerPage'));

        $oView->expects($this->once())
              ->method('_setNrOfArtPerPage');

        $oView->addGlobalParams( new Oxstdclass );
    }

    /*
     * Test adding global params to view data
     */
    public function testAddGlobalParams()
    {
        $myConfig = oxConfig::getInstance();
        modConfig::setParameter( 'listorderby', 'oxprice' );
        modConfig::setParameter( 'listorder', 'asc' );

        $oView = oxNew( 'oxubase' );
        $oView->addGlobalParams();

        $aViewData = $oView->getViewData();

        //checking some view data values
        $this->assertEquals( $aViewData['bl_perfLoadCurrency'], $myConfig->getConfigParam( 'bl_perfLoadCurrency' ) );
        $this->assertEquals( $aViewData['bl_perfLoadVendorTree'], $myConfig->getConfigParam( 'bl_perfLoadVendorTree' ) );


        $this->assertEquals( $aViewData['oView'], $oView );
        $this->assertEquals( $aViewData['oViewConf'], $oView->getViewConfig() );
        $this->assertEquals( $aViewData['shop'], $oView->getViewConfig() );
    }

    public function testShowSearch()
    {
        $oView = new oxUbase();
        $this->assertEquals( 1, $oView->showSearch() );

        modConfig::getInstance()->setConfigParam( 'blDisableNavBars', true );

        $oView = new basket();
        $this->assertEquals( 0, $oView->showSearch() );
    }

    public function testgetTitleSuffix()
    {
        $oShop = new oxShop();
        $oShop->oxshops__oxtitlesuffix = $this->getMock( 'oxField', array( '__get' ) );
        $oShop->oxshops__oxtitlesuffix->expects( $this->once() )->method( '__get')->will( $this->returnValue( 'testsuffix' ) );

        $oConfig = $this->getMock( 'oxconfig', array( 'getActiveShop' ) );
        $oConfig->expects( $this->once() )->method( 'getActiveShop')->will( $this->returnValue( $oShop ) );

        $oView = $this->getMock( 'oxubase', array( 'getConfig' ) );
        $oView->expects( $this->once() )->method( 'getConfig')->will( $this->returnValue( $oConfig ) );
        $this->assertEquals( 'testsuffix', $oView->getTitleSuffix() );
    }


    public function testgetTitlePrefix()
    {
        $oShop = new oxShop();
        $oShop->oxshops__oxtitleprefix = $this->getMock( 'oxField', array( '__get' ) );
        $oShop->oxshops__oxtitleprefix->expects( $this->once() )->method( '__get')->will( $this->returnValue( 'testsuffix' ) );

        $oConfig = $this->getMock( 'oxconfig', array( 'getActiveShop' ) );
        $oConfig->expects( $this->once() )->method( 'getActiveShop')->will( $this->returnValue( $oShop ) );

        $oView = $this->getMock( 'oxubase', array( 'getConfig' ) );
        $oView->expects( $this->once() )->method( 'getConfig')->will( $this->returnValue( $oConfig ) );
        $this->assertEquals( 'testsuffix', $oView->getTitlePrefix() );
    }

    public function testGetSeoRequestParams()
    {
        $oView = $this->getMock( 'oxubase', array( 'getClassName', 'getFncName' ) );
        $oView->expects( $this->once() )->method( 'getClassName')->will( $this->returnValue( 'testclass' ) );
        $oView->expects( $this->once() )->method( 'getFncName')->will( $this->returnValue( 'testfnc' ) );

        modConfig::setParameter( 'page', 'testpage' );
        modConfig::setParameter( 'tpl', 'somedir/testtpl.tpl' );
        modConfig::setParameter( 'pgNr', 100 );

        $this->assertEquals( 'cl=testclass&amp;fnc=testfnc&amp;page=testpage&amp;tpl=testtpl.tpl&amp;pgNr=100', $oView->UNITgetSeoRequestParams() );
    }

    public function testGetSimilarRecommLists()
    {
        $oView = new oxubase();
        $this->assertNull( $oView->getSimilarRecommLists() );
    }

    /*
     * Test getting default content (impressum) id
     */
    public function testGetContentId()
    {
        $oView = $this->getProxyClass( 'oxubase' );
        $sContentId = oxDb::getDb( true )->getOne( "SELECT oxid FROM oxcontents WHERE oxloadid = 'oximpressum' " );
        $this->assertEquals( $sContentId, $oView->getContentId() );
    }

    /*
     * Test set/get sort by
     */
    public function testIsCallForCache()
    {
        $oView = new oxubase();
        $oView->setIsCallForCache( '123456789' );
        $this->assertEquals( '123456789', $oView->getIsCallForCache() );
    }

    /*
     * Test set/get sort by
     */
    public function testSetItemSortingGetSortingGetSortingSql()
    {
        $aSorting = array( 'sortby' => 'oxid', 'sortdir' => 'asc' );

        $oView = new oxubase();
        $oView->setItemSorting( 'xxx', 'oxid', 'asc' );

        $this->assertNull( $oView->getSorting( 'yyy' ) );

        $this->assertEquals( $aSorting, $oView->getSorting( 'xxx' ) );
        $this->assertEquals( implode( ' ', $aSorting ), $oView->getSortingSql( 'xxx' ) );
    }

    public function testGetListTypeAndSetListType()
    {
        $oView = new oxubase();
        $this->assertNull( $oView->getListType() );

        modConfig::setParameter( 'listtype', 'xxx' );
        $this->assertEquals('xxx', $oView->getListType() );

        modConfig::setParameter( 'listtype', null );
        $this->assertEquals('xxx', $oView->getListType() );

        $oView->setListType( 'yyy' );
        $this->assertEquals( 'yyy', $oView->getListType() );
    }


    public function testAddRssFeed()
    {
        $oView = new oxubase();
        $oView->addRssFeed('test', 'tt');
        $a = $oView->getRssLinks();
        $this->assertEquals(array(0=>array('title'=>'test', 'link'=>'tt')), $a);

        $oView->addRssFeed('testd', 'tta', 'iknowthiskey');
        $a = $oView->getRssLinks();
        $this->assertEquals(array(0=>array('title'=>'test', 'link'=>'tt'),
                        'iknowthiskey'=>array('title'=>'testd', 'link'=>'tta')), $a);
    }

    public function testGetDynUrlParams()
    {
        $oV = new oxubase();
        modConfig::setParameter('searchparam', 'sa"');
        modConfig::setParameter('searchcnid', 'sa"%22');
        modConfig::setParameter('searchvendor', 'sa%22"');
        $oV->setListType('lalala');
        $this->assertEquals('', $oV->getDynUrlParams());
        $oV->setListType('search');
        $sGot = $oV->getDynUrlParams();
        $this->assertEquals('&amp;listtype=search&amp;searchparam=sa%22&amp;searchcnid=sa%22%22&amp;searchvendor=sa%22%22', $sGot);
    }

    public function testGetDynUrlParamsInTaglist()
    {
        $oV = new oxubase();
        modConfig::setParameter('searchtag', 'testtag');
        $oV->setListType('tag');
        $sGot = $oV->getDynUrlParams();
        $this->assertEquals('&amp;listtype=tag&amp;searchtag=testtag', $sGot);
    }

    public function testGetLinkAfterMuchCodeWasTransferedFromOxViewToOxUbase()
    {
        oxTestModules::addFunction("oxutils", "seoIsActive", "{return false;}");
        $oCfg = oxConfig::getInstance();

        $oV = $this->getMock( 'oxubase', array( '_getRequestParams' , 'getActPage' ) );
        $oV->expects( $this->any() )->method( '_getRequestParams' )->will( $this->returnValue( 'req' ) );
        $oV->expects( $this->once() )->method( 'getActPage' )->will( $this->returnValue( false ) );

        $this->assertEquals( $oCfg->getShopCurrentURL( 0 ).'req', $oV->getLink() );

        $oV = $this->getMock( 'oxubase', array( '_getRequestParams' , 'getActPage', '_addPageNrParam') );
        $oV->expects( $this->any() )->method( '_getRequestParams' )->will( $this->returnValue( 'req' ) );
        $oV->expects( $this->once() )->method( 'getActPage' )->will( $this->returnValue( 16 ) );
        $oV->expects( $this->once() )->method( '_addPageNrParam' )->with($this->equalTo($oCfg->getShopCurrentURL( 0 ).'req&amp;lang=2', 16, 2))->will( $this->returnValue( 'linkas' ) );

        $this->assertEquals('linkas', $oV->getLink(2));
    }

    public function testGetLink()
    {
        oxTestModules::addFunction("oxutilsserver", "getServerVar", "{ \$aArgs = func_get_args(); if ( \$aArgs[0] === 'HTTP_HOST' ) { return '".oxConfig::getInstance()->getShopUrl()."'; } elseif ( \$aArgs[0] === 'SCRIPT_NAME' ) { return ''; } else { return \$_SERVER[\$aArgs[0]]; } }");

        $oCfg = oxConfig::getInstance();

        $oV = $this->getMock( 'oxubase', array( '_getRequestParams' ) );
        $oV->expects( $this->any() )->method( '_getRequestParams' )->will( $this->returnValue( 'req' ) );

        oxTestModules::addFunction("oxutils", "seoIsActive", "{return false;}");
        $this->assertEquals($oCfg->getShopCurrentURL( 0 ).'req', $oV->getLink());
        $this->assertEquals($oCfg->getShopCurrentURL( 0 ).'req', $oV->getLink(0));
        $this->assertEquals($oCfg->getShopCurrentURL( 1 ).'req&amp;lang=1', $oV->getLink(1));

        oxTestModules::addFunction("oxutils", "seoIsActive", "{return true;}");
        $this->assertEquals($oCfg->getShopCurrentURL( 0 ).'req', $oV->getLink());
        $this->assertEquals($oCfg->getShopCurrentURL( 0 ).'req', $oV->getLink(0));
        $this->assertEquals($oCfg->getShopCurrentURL( 1 ).'req&amp;lang=1', $oV->getLink(1));

        $oV = $this->getMock( 'oxubase', array( '_getRequestParams', '_getSeoRequestParams' ) );
        $oV->expects( $this->any() )->method( '_getRequestParams' )->will( $this->returnValue( 'cl=contact' ) );
        $oV->expects( $this->any() )->method( '_getSeoRequestParams' )->will( $this->returnValue( 'cl=contact' ) );

        $this->assertEquals($oCfg->getShopURL( ).'kontakt/', $oV->getLink());
        $this->assertEquals($oCfg->getShopURL( ).'kontakt/', $oV->getLink(0));
        $this->assertEquals($oCfg->getShopURL( ).'en/contact/', $oV->getLink(1));

        $oV = $this->getMock( 'oxubase', array( '_getRequestParams', '_getSubject' ) );
        $oV->expects( $this->any() )->method( '_getRequestParams' )->will( $this->returnValue( 'cl=contact' ) );
        $oArt = new oxArticle();
            $oArt->loadInLang( 1, '1126' );
            $sExp    = "Geschenke/Bar-Equipment/Bar-Set-ABSINTH.html";
            $sExpEng = "en/Gifts/Bar-Equipment/Bar-Set-ABSINTH.html";

        $oV->expects( $this->any() )->method( '_getSubject' )->will( $this->returnValue( $oArt ) );

        $this->assertEquals( $oCfg->getShopURL().$sExp, $oV->getLink());
        $this->assertEquals( $oCfg->getShopURL().$sExp, $oV->getLink(0));
        $this->assertEquals( $oCfg->getShopURL().$sExpEng, $oV->getLink(1));

        // set different link type, and check if it is preserved in both languages
        $oV = $this->getMock( 'oxubase', array( '_getRequestParams', '_getSubject' ) );
        $oV->expects( $this->any() )->method( '_getRequestParams' )->will( $this->returnValue( 'cl=contact' ) );
        $oArt = new oxArticle();
        $oArt->setLinkType(OXARTICLE_LINKTYPE_MANUFACTURER);
            $oArt->loadInLang( 1, '1964' );
            $sVndExp    = "Nach-Marke-Hersteller/Bush/Original-BUSH-Beach-Radio.html";
            $sVndExpEng = "en/By-Brand-Manufacturer/Bush/Original-BUSH-Beach-Radio.html";

        $oV->expects( $this->any() )->method( '_getSubject' )->will( $this->returnValue( $oArt ) );

        $this->assertEquals( $oCfg->getShopURL().$sVndExp, $oV->getLink());
        $this->assertEquals( $oCfg->getShopURL().$sVndExp, $oV->getLink(0));
        $this->assertEquals( $oCfg->getShopURL().$sVndExpEng, $oV->getLink(1));
    }

    public function testShowRightBasket()
    {
        $oView = $this->getProxyClass( 'oxubase' );
        modConfig::getInstance()->setConfigParam( 'bl_perfShowRightBasket', true );

        $this->assertTrue( $oView->showRightBasket() );
    }

    public function testSetShowRightBasket()
    {
        $oView = $this->getProxyClass( 'oxubase' );
        $oView->setShowRightBasket(0);

        $this->assertEquals( 0, $oView->showRightBasket() );
    }

    public function testShowLeftBasket()
    {
        $oView = $this->getProxyClass( 'oxubase' );
        modConfig::getInstance()->setConfigParam( 'bl_perfShowLeftBasket', true );

        $this->assertTrue( $oView->showLeftBasket() );
    }

    public function testSetShowLeftBasket()
    {
        $oView = $this->getProxyClass( 'oxubase' );
        $oView->setShowLeftBasket(0);

        $this->assertEquals( 0, $oView->showLeftBasket() );
    }

    public function testShowTopBasket()
    {
        $oView = $this->getProxyClass( 'oxubase' );
        modConfig::getInstance()->setConfigParam( 'bl_perfShowTopBasket', true );

        $this->assertTrue( $oView->showTopBasket() );
    }

    public function testSetShowTopBasket()
    {
        $oView = $this->getProxyClass( 'oxubase' );
        $oView->setShowTopBasket(0);

        $this->assertEquals( 0, $oView->showTopBasket() );
    }

    public function testLoadCurrency()
    {
        $oView = $this->getProxyClass( 'oxubase' );
        modConfig::getInstance()->setConfigParam( 'bl_perfLoadCurrency', true );

        $this->assertTrue( $oView->loadCurrency() );
    }

    public function testLoadVendorTree()
    {
        $oView = $this->getProxyClass( 'oxubase' );
        modConfig::getInstance()->setConfigParam( 'bl_perfLoadVendorTree', true );

        $this->assertTrue( $oView->loadVendorTree() );
    }

    public function testDontShowEmptyCategories()
    {
        $oView = $this->getProxyClass( 'oxubase' );
        modConfig::getInstance()->setConfigParam( 'blDontShowEmptyCategories', true );

        $this->assertTrue( $oView->dontShowEmptyCategories() );
    }

    public function testIsLanguageLoaded()
    {
        $oView = $this->getProxyClass( 'oxubase' );
        modConfig::getInstance()->setConfigParam( 'bl_perfLoadLanguages', true );

        $this->assertTrue( $oView->isLanguageLoaded() );
    }

    public function testShowTopCatNavigation()
    {
        $oView = $this->getProxyClass( 'oxubase' );
        modConfig::getInstance()->setConfigParam( 'blTopNaviLayout', true );

        $this->assertTrue( $oView->showTopCatNavigation() );
    }

    public function testGetTopNavigationCatCnt()
    {
        $oView = $this->getProxyClass( 'oxubase' );
        modConfig::getInstance()->setConfigParam( 'iTopNaviCatCount', 6 );

        $this->assertEquals( 6, $oView->getTopNavigationCatCnt() );
    }

    public function testGetRssLinks()
    {
        $oView = $this->getProxyClass( 'oxubase' );
        $oView->addRssFeed('testTitle', 'testUrl', 'test');
        $aRssLinks['test'] = array('title'=>'testTitle', 'link' => 'testUrl');
        $this->assertEquals( $aRssLinks, $oView->getRssLinks() );
    }

    public function testIsSortingActive()
    {
        $oView = $this->getProxyClass( 'oxubase' );
        $oView->prepareSortColumns();
        $this->assertTrue( $oView->isSortingActive() );
    }

    public function testGetSortColumns()
    {
        $oView = $this->getProxyClass( 'oxubase' );
        $oView->prepareSortColumns();
        $this->assertEquals( modConfig::getInstance()->getConfigParam( 'aSortCols' ), $oView->getSortColumns() );
    }

    public function testGetListOrderByAndListOrderDirection()
    {
        $oView = $this->getProxyClass( 'oxubase' );
        modConfig::setParameter( 'cnid', 'xxx' );
        modConfig::getInstance()->setConfigParam( 'aSortCols', array('oxid', 'oxprice') );

        $oView->setItemSorting( 'xxx', 'oxid', 'asc' );
        $oView->prepareSortColumns();
        $this->assertEquals( 'oxid', $oView->getListOrderBy() );
        $this->assertEquals( 'asc', $oView->getListOrderDirection() );
    }

    public function testGetSetCompareItemsCnt()
    {
        $oView = $this->getProxyClass( 'oxubase' );
        $oView->setCompareItemsCnt( 10 );
        $this->assertEquals( 10, $oView->getCompareItemsCnt() );
    }

    public function testGetSetWishlistName()
    {
        $oView = $this->getProxyClass( 'oxubase' );
        $oView->setWishlistName( 'testwishlist' );
        $this->assertEquals( 'testwishlist', $oView->getWishlistName() );
    }

    public function testGetSetMenueList()
    {
        $oView = $this->getProxyClass( 'oxubase' );
        $oView->setMenueList( 'testmenue' );
        $this->assertEquals( 'testmenue', $oView->getMenueList() );
    }

    public function testGetSetActiveCategory()
    {
        $oView = $this->getProxyClass( 'oxubase' );
        $oView->setActiveCategory( 'testcat' );
        $this->assertEquals( 'testcat', $oView->getActiveCategory() );
    }

    /**
     * Base view class title getter class
     */
    public function testGetTitle()
    {
        $oView = new oxubase();
        $this->assertNull( $oView->getTitle() );
    }

    /*
     * Testing actvile lang abbervation getter
     */
    public function testGetActiveLangAbbr()
    {
        oxLang::getInstance()->setBaseLanguage( 0 );

        $oView = new oxubase();
        $this->assertEquals( "de", $oView->getActiveLangAbbr() );

        oxLang::getInstance()->setBaseLanguage(1);

        $oView = new oxubase();
        $this->assertEquals( "en", $oView->getActiveLangAbbr() );

    }

    /*
     * Testing active lang abbervation getter when lang loading disabled in config
     */
    public function testGetActiveLangAbbrWhenDisabledInConfig()
    {
        modConfig::getInstance()->setConfigParam( 'bl_perfLoadLanguages', false );
        $oView = $this->getProxyClass( 'oxubase' );
        $this->assertNull( $oView->getActiveLangAbbr() );
    }

    public function testGetRequestParams()
    {
        $oView = $this->getMock( 'oxubase', array( 'getClassName', 'getFncName' ) );
        $oView->expects( $this->any() )->method( 'getClassName' )->will( $this->returnValue( 'testclass' ) );
        $oView->expects( $this->any() )->method( 'getFncName' )->will( $this->returnValue( 'testfunc' ) );
        modConfig::setParameter('cnid', 'catid');
        modConfig::setParameter('mnid', 'manId');
        modConfig::setParameter('anid', 'artid');
        modConfig::setParameter('page', '2');
        modConfig::setParameter('tpl', 'test');
        modConfig::setParameter('pgNr', '2');
        modConfig::setParameter('searchparam', 'test');
        modConfig::setParameter('searchcnid', 'searchcat');
        modConfig::setParameter('searchvendor', 'searchven');
        modConfig::setParameter('searchmanufacturer', 'searchman');
        modConfig::setParameter('searchrecomm', 'searchrec');
        modConfig::setParameter('searchtag', 'searchtag');
        modConfig::setParameter('recommid', 'recid');

        $sExpUrl = 'cl=testclass&amp;fnc=testfunc&amp;cnid=catid&amp;mnid=manId&amp;anid=artid&amp;page=2&amp;tpl=test&amp;pgNr=2' .
                   '&amp;searchparam=test&amp;searchcnid=searchcat&amp;searchvendor=searchven' .
                   '&amp;searchmanufacturer=searchman&amp;searchrecomm=searchrec&amp;searchtag=searchtag&amp;recommid=recid';
        $this->assertEquals( $sExpUrl, $oView->UNITgetRequestParams() );
    }

    public function testGetRequestParamsSkipFnc()
    {
        $oView = $this->getMock( 'oxubase', array( 'getClassName', 'getFncName' ) );
        $oView->expects( $this->any() )->method( 'getClassName' )->will( $this->returnValue( 'testclass' ) );
        $oView->expects( $this->any() )->method( 'getFncName' )->will( $this->returnValue( 'tobasket' ) );
        modConfig::setParameter('cnid', 'catid');
        modConfig::setParameter('mnid', 'manId');

        $sExpUrl = 'cl=testclass&amp;cnid=catid&amp;mnid=manId';
        $this->assertEquals( $sExpUrl, $oView->UNITgetRequestParams() );
    }

    public function testGetRequestParamsWithoutPageNr()
    {
        $oView = $this->getMock( 'oxubase', array( 'getClassName' ) );
        $oView->expects( $this->any() )->method( 'getClassName' )->will( $this->returnValue( 'testclass' ) );
        modConfig::setParameter('cnid', 'catid');
        modConfig::setParameter('pgNr', '2');

        $sExpUrl = 'cl=testclass&amp;cnid=catid';
        $this->assertEquals( $sExpUrl, $oView->UNITgetRequestParams( false ) );
    }

    /*
     * Test getting default content (impressum)
     */
    public function testGetContent()
    {
        $oView = $this->getProxyClass( 'oxubase' );
        $oContent = $oView->getContent();
        $this->assertNotNull( $oContent );
        $this->assertEquals( 'oximpressum', $oContent->oxcontents__oxloadid->value );
    }

    public function testNoIndex()
    {
        $oView = new oxubase();
        $this->assertEquals( 0, $oView->noIndex() );

        //
        modConfig::setParameter( 'fnc', 'blankfunction' );
        $oView = new oxubase();
        $this->assertEquals( 0, $oView->noIndex() );

        modConfig::setParameter( 'fnc', 'tocomparelist' );
        $oView = new oxubase();
        $this->assertEquals( 1, $oView->noIndex() );

        modConfig::setParameter( 'fnc', 'tobasket' );
        $oView = new oxubase();
        $this->assertEquals( 1, $oView->noIndex() );

        //
        modConfig::setParameter( 'fnc', 'blankfunction' );
        $oView = new oxubase();
        $this->assertEquals( 0, $oView->noIndex() );

        //
        modConfig::setParameter( 'cur', 'xxx' );
        $oView = new oxubase();
        $this->assertEquals( 1, $oView->noIndex() );
    }

    public function testSetActCurrencyGetActCurrency()
    {
        $oCurr = 'testcurr';

        $oView = new oxUbase();
        $oView->setActCurrency( $oCurr );
        $this->assertEquals( $oCurr, $oView->getActCurrency() );
    }

    public function testGetContentByIdent()
    {
        $oUBase = $this->getProxyClass( "oxubase" );

        $oContent = $oUBase->getContentByIdent( 'oxagb' );
        $this->assertNotNull( $oContent );
        $this->assertEquals( 'oxagb', $oContent->oxcontents__oxloadid->value );

        $aContents = $oUBase->getNonPublicVar( "_aContents" );
        $this->assertTrue( isset( $aContents['oxagb'] ) );
        $this->assertEquals( 'oxagb', $aContents['oxagb']->oxcontents__oxloadid->value );
    }

    public function testGetContentCategory()
    {
        $oUBase = new oxubase();
        $this->assertFalse( $oUBase->getContentCategory() );
    }

    public function testCanRedirectFalse()
    {
        modConfig::setParameter( 'fnc', 'something' );
        $oUBase = new oxubase();
        $this->assertFalse( $oUBase->UNITcanRedirect() );
    }

    public function testCanRedirectTrue()
    {
        modConfig::setParameter( 'cl', 'details' );
        $oUBase = new oxubase();
        $this->assertTrue( $oUBase->UNITcanRedirect() );
    }

    public function testProcessRequestCanRedirect()
    {
        $_SERVER["REQUEST_METHOD"] = 'GET';
        $_SERVER['REQUEST_URI']    = $sUri = 'index.php?cl=account_wishlist';

        oxTestModules::addFunction( "oxUtils", "redirect", "{ \$aArgs = func_get_args(); throw new exception( \$aArgs[0] ); }" );

        $oUbase = $this->getMock( 'oxubase', array( '_canRedirect', 'isAdmin' ) );
        $oUbase->expects( $this->any() )->method( '_canRedirect' )->will( $this->returnValue( true ) );
        $oUbase->expects( $this->any() )->method( 'isAdmin' )->will( $this->returnValue( false ) );

        try {
            $oUbase->UNITprocessRequest();
        } catch ( Exception $oEx ) {
            $this->assertEquals( oxConfig::getInstance()->getShopURL() . 'mein-wunschzettel/', $oEx->getMessage(), 'error executing "testProcessRequest" test' );
            return;
        }

        $this->fail( 'error executing "testProcessRequest" test' );
    }

    public function testForceNoIndex()
    {
        $oView = new oxubase();
        $oView->UNITforceNoIndex();
        $this->assertEquals( 2, $oView->noIndex() );
    }

    public function testProcessRequestCantRedirect()
    {
        $_SERVER["REQUEST_METHOD"] = 'GET';
        $_SERVER['REQUEST_URI']    = $sUri = 'index.php?param1=value1&param2=value2';

        oxTestModules::addFunction( "oxUtils", "redirect", "{ \$aArgs = func_get_args(); throw new exception( \$aArgs[0] ); }" );

        $oUbase = $this->getMock( 'oxubase', array( '_canRedirect', 'getLink', 'isAdmin', '_forceNoIndex' ) );
        $oUbase->expects( $this->any() )->method( '_canRedirect' )->will( $this->returnValue( false ) );
        $oUbase->expects( $this->any() )->method( 'isAdmin' )->will( $this->returnValue( false ) );
        $oUbase->expects( $this->once() )->method( '_forceNoIndex' );

        try {
            $oUbase->UNITprocessRequest();
        } catch ( Exception $oEx ) {
            // redirect must not be executed
            $this->fail( 'error executing "testProcessRequestCantRedirect" test' );
        }

        $sShopId = oxConfig::getInstance()->getShopId();
        $sLangId = oxLang::getInstance()->getBaseLanguage();
        $sIdent  = md5( strtolower( str_replace( '&', '&amp;', $sUri ) ) . $sShopId . $sLangId );

        // testing if request was written in seo log table
        $this->assertTrue( (bool) oxDb::getDb()->getOne( "select 1 from oxseologs where oxident='$sIdent'" ) );
    }

    // M71: Coupons should be considered in "Min order price" check
    public function testIsLowOrderPrice()
    {
        $oBasket = $this->getMock( 'oxBasket', array('isBelowMinOrderPrice' ) );
        $oBasket->expects( $this->once() )->method('isBelowMinOrderPrice')->will( $this->returnValue( true ) );

        $oUBase = new oxUBase();
        $oUBase->getSession()->setBasket( $oBasket );

        $oUBase->isLowOrderPrice();
        $this->assertTrue( $oUBase->isLowOrderPrice() );
    }

    public function testGetMinOrderPrice()
    {
        modConfig::getInstance()->setConfigParam( "iMinOrderPrice", 40 );
        $oCur = oxConfig::getInstance()->getActShopCurrencyObject();

        $sMinOrderPrice = oxLang::getInstance()->formatCurrency( 40 * $oCur->rate );

        $oUBase = $this->getMock( "oxUBase", array( "isLowOrderPrice" ) );
        $oUBase->expects( $this->once() )->method('isLowOrderPrice')->will( $this->returnValue( true ) );

        $this->assertEquals( $sMinOrderPrice, $oUBase->getMinOrderPrice() );
    }

    public function testGetActRecommList()
    {
        $myConfig = modConfig::getInstance();
        $myDB = oxDb::getDB();
        $sShopId = $myConfig->getShopId();
        // adding article to recommendlist
        modConfig::setParameter( 'recommid', 'testlist' );
        $oUBase = $this->getProxyClass( "oxubase" );
        $oRecommList = $oUBase->getActRecommList();
        $this->assertEquals( 'testlist', $oRecommList->getId() );
    }

    public function testGetTop5ArticleList()
    {
        $oUBase = $this->getProxyClass( 'oxubase' );

        $oUBase->setNonPublicVar( "_blTop5Action", true );
        $aList = $oUBase->getTop5ArticleList();
            $this->assertEquals(4, $aList->count());
    }

    public function testGetBargainArticleList()
    {
        $oUBase = $this->getProxyClass( 'oxubase' );

        $oUBase->setNonPublicVar( "_blBargainAction", true );
        $aList = $oUBase->getBargainArticleList();
            $this->assertEquals(4, $aList->count());
    }

    public function testGetNewsRealStatus()
    {
        $oUBase = $this->getProxyClass( 'oxubase' );
        modConfig::getInstance()->setConfigParam( 'blDisableNavBars', true );
        $oUBase->setNonPublicVar( "_blIsOrderStep", true );
        $oUBase->render();
        $this->assertEquals(0, $oUBase->showNewsletter());
        $this->assertEquals(1, $oUBase->getNewsRealStatus());
    }

    // do not add pgNr. It will be added later
    public function testGeneratePageNavigationUrl()
    {
        modConfig::setParameter( 'pgNr', '2' );
        modConfig::setParameter( 'lang', '1' );
        $oUBase = $this->getMock( 'oxubase', array( "getClassName", "getFncName" ) );
        $oUBase->expects( $this->any() )->method('getClassName')->will( $this->returnValue( "testclass" ) );
        $oUBase->expects( $this->any() )->method('getFncName')->will( $this->returnValue( "testfnc" ) );

        $this->assertEquals(modConfig::getInstance()->getShopHomeURL()."cl=testclass&amp;fnc=testfnc", $oUBase->generatePageNavigationUrl());
    }

    // If page number is zero
    public function testAddPageNrParamFirstPage()
    {
        $oUBase = $this->getProxyClass( 'oxubase' );
        $this->assertEquals("aaa", $oUBase->UNITaddPageNrParam("aaa", 0));
    }

    public function testAddPageNrParam()
    {
        $oUBase = $this->getProxyClass( 'oxubase' );
        $this->assertEquals("aaa?bb&amp;pgNr=2", $oUBase->UNITaddPageNrParam("aaa?bb", 2));
    }

    public function testSetGetRootVendor()
    {
        $oView = $this->getProxyClass( 'oxubase' );
        $oView->setRootVendor('rootvendor');

        $this->assertEquals( 'rootvendor', $oView->getRootVendor() );
    }

    public function testSetGetVendorlist()
    {
        $oView = $this->getProxyClass( 'oxubase' );
        $oView->setVendorlist( 'testvendorlist' );
        $this->assertEquals( 'testvendorlist', $oView->getVendorlist() );
    }

    public function testGetVendorId()
    {
        $oView = $this->getProxyClass( 'oxubase' );
        modConfig::setParameter( 'cnid', 'v_root' );
        $this->assertEquals( 'root', $oView->getVendorId() );
    }

    public function testGetSetSearchCatTree()
    {
        $oView = $this->getProxyClass( 'oxubase' );
        $oView->setSearchCatTree( 'testcattree' );
        $this->assertEquals( 'testcattree', $oView->getSearchCatTree() );
    }

    public function testSetGetCatMore()
    {
        $oView = $this->getProxyClass( 'oxubase' );
        $oView->setCatMore( 'testmore' );
        $this->assertEquals( 'testmore', $oView->getCatMore() );
    }

    /*
    public function testSetGetNewsSubscribed()
    {
        $oView = $this->getProxyClass( 'oxubase' );
        $oView->setNewsSubscribed( true );
        $this->assertTrue( $oView->isNewsSubscribed() );
    }

    public function testSetGetShowShipAddress()
    {
        $oView = $this->getProxyClass( 'oxubase' );
        $oView->setShowShipAddress( true );
        $this->assertTrue( $oView->showShipAddress() );
    }


    public function testSetGetDelAddress()
    {
        $oView = $this->getProxyClass( 'oxubase' );
        $oView->setDelAddress( "testaddress" );
        $this->assertEquals( "testaddress", $oView->getDelAddress() );
    }*/






}