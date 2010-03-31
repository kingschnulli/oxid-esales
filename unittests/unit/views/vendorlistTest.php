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
 * @version   SVN: $Id: vendorlistTest.php 26841 2010-03-25 13:58:15Z arvydas $
 */

require_once realpath( "." ).'/unit/OxidTestCase.php';
require_once realpath( "." ).'/unit/test_config.inc.php';

/**
 * Testing oxvendorlist class
 */
class Unit_Views_vendorlistTest extends OxidTestCase
{
    /**
     * Tear down the fixture.
     *
     * @return null
     */
    protected function tearDown()
    {
        oxTestModules::addFunction('oxVendor', 'cleanRootVendor', '{oxVendor::$_aRootVendor = array();}');
        oxNew('oxvendor')->cleanRootVendor();

        parent::tearDown();
    }

    public function testGetAddUrlParams()
    {
        $oVendor = new oxVendor();
        $oVendor->setId( "testVendorId" );

        $oView = $this->getMock( "vendorlist", array( "getActVendor" ) );
        $oView->expects( $this->once() )->method( 'getActVendor')->will( $this->returnValue( $oVendor ) );

        $oUBaseView = new oxUBase();
        $sTestParams = $oUBaseView->getAddUrlParams();
        $sTestParams .= ($sTestParams?'&amp;':'') . "listtype=vendor";
        $sTestParams .= "&amp;cnid=v_testVendorId";

        $this->assertEquals( $sTestParams, $oView->getAddUrlParams() );
    }

    public function testGetTreePath()
    {
        $oVendorList = $this->getMock( "oxvendorlist", array( "getPath" ) );
        $oVendorList->expects( $this->once() )->method( 'getPath')->will( $this->returnValue( "testPath" ) );

        $oView = $this->getMock( "vendorlist", array( "getVendorTree" ) );
        $oView->expects( $this->once() )->method( 'getVendorTree')->will( $this->returnValue( $oVendorList ) );

        $this->assertEquals( "testPath", $oView->getTreePath() );
    }

    public function testGetSubject()
    {
        $oView = $this->getMock( "vendorlist", array( "getActVendor" ) );
        $oView->expects( $this->once() )->method( 'getActVendor')->will( $this->returnValue( "testActVendor" ) );

        $this->assertEquals( "testActVendor", $oView->UNITgetSubject( 0 ) );
    }

    public function testProcessListArticles()
    {
        $oArticle = new oxArticle();

        $oListView = new vendorlist();
        $this->assertEquals( 1, $oListView->UNITgetProductLinkType() );
    }

    public function testGetSubCatList()
    {
        oxTestModules::addFunction('oxUtilsServer', 'getServerVar', '{ if ( $aA[0] == "HTTP_HOST") { return "shop.com/"; } else { return "test.php";} }');

        modConfig::setParameter( 'cnid', 'v_root' );
        $oVendorTree = new oxvendorlist();
        $oVendorTree->buildVendorTree( 'vendorlist', 'v_root', oxConfig::getInstance()->getShopHomeURL() );

        $oVendor = new vendorlist();
        $oVendor->setVendorTree( $oVendorTree );
        $oTree = $oVendor->getSubCatList();


        $this->assertEquals( $oVendorTree, $oTree );
    }

    public function testHasVisibleSubCats()
    {
        oxTestModules::addFunction('oxUtilsServer', 'getServerVar', '{ if ( $aA[0] == "HTTP_HOST") { return "shop.com/"; } else { return "test.php";} }');

        modConfig::setParameter( 'cnid', 'v_root' );
        $oVendorTree = new oxvendorlist();
        $oVendorTree->buildVendorTree( 'vendorlist', 'v_root', oxConfig::getInstance()->getShopHomeURL() );

        $oVendor = new vendorlist();
        $oVendor->setVendorTree( $oVendorTree );

        $this->assertEquals( 3, $oVendor->hasVisibleSubCats() );
    }

    public function testGetArticleListAndCount()
    {
        oxTestModules::addFunction('oxUtilsServer', 'getServerVar', '{ if ( $aA[0] == "HTTP_HOST") { return "shop.com/"; } else { return "test.php";} }');

        //testing over mock
            $sVendorId = '68342e2955d7401e6.18967838';


        modConfig::setParameter( 'cnid', $sVendorId );
        modConfig::getInstance()->setConfigParam( 'iNrofCatArticles', 20 );
        $oVendorTree = new oxvendorlist();
        $oVendorTree->buildVendorTree( 'vendorlist', $sVendorId, oxConfig::getInstance()->getShopHomeURL() );

        $oVendor = new oxVendor();
        $oVendor->load($sVendorId);

        $oVendorList = $this->getProxyClass( "vendorlist" );
        $oVendorList->setVendorTree( $oVendorTree );
        $oVendorList->setNonPublicVar( "_oActVendor", $oVendor );
        $oArtList = $oVendorList->getArticleList();

        $this->assertEquals(oxUtilsCount::getInstance()->getVendorArticleCount( $sVendorId ), $oArtList->count());
    }

    // (buglist_322) if vendorlist view is opened vendortree must be opend too (aVendorlist)
    public function testLoadVendorTreeInVendorlistView()
    {
        oxTestModules::addFunction('oxUtilsServer', 'getServerVar', '{ if ( $aA[0] == "HTTP_HOST") { return "shop.com/"; } else { return "test.php";} }');
        modConfig::getInstance()->setConfigParam( 'bl_perfLoadVendorTree', 1 );

        modConfig::setParameter( 'cnid', 'v_root' );
        $oVendorTree = new oxvendorlist();
        $oVendorTree->buildVendorTree( 'vendorlist', 'v_root', oxConfig::getInstance()->getShopHomeURL() );

        $oVendor = $this->getProxyClass( "vendorlist" );
        $oVendor->setVendorTree( $oVendorTree );
        $oVendor->init();
        $oVendor->render();
        $aViewData = $oVendor->getNonPublicVar( '_aViewData' );

        $this->assertEquals( 3, count($aViewData['aVendorlist']) );
    }

    public function testGetPageNavigation()
    {
        $oVendor = $this->getMock( 'vendorlist', array( 'generatePageNavigation' ));
        $oVendor->expects( $this->any() )->method( 'generatePageNavigation')->will($this->returnValue( "aaa" ) );
        $this->assertEquals( 'aaa', $oVendor->getPageNavigation() );
    }

    public function testGeneratePageNavigationUrl()
    {
        $oVendor = $this->getMock( 'alist', array( 'generatePageNavigationUrl', 'getActVendor' ));
        $oVendor->expects( $this->any() )->method( 'generatePageNavigationUrl')->will($this->returnValue( "aaa" ) );
        $oVendor->expects( $this->any() )->method( 'getActVendor')->will($this->returnValue( false ) );
        $this->assertEquals( 'aaa', $oVendor->generatePageNavigationUrl() );
    }

    public function testGeneratePageNavigationUrlIfSeo()
    {
        oxTestModules::addFunction('oxUtilsServer', 'getServerVar', '{ if ( $aA[0] == "HTTP_HOST") { return "shop.com/"; } else { return "test.php";} }');

            $sVendorId = '68342e2955d7401e6.18967838';

        $oVendor = new oxVendor();
        $oVendor->load($sVendorId);

        $oVendorList = $this->getProxyClass( "vendorlist" );
        $oVendorList->setNonPublicVar( "_oActVendor", $oVendor );
        $this->assertEquals( $oVendor->getLink(), $oVendorList->generatePageNavigationUrl() );
    }

    public function testGetRecommList()
    {
        oxTestModules::addFunction('oxRecommList', 'getRecommListsByIds', '{ return "testRecomm"; }');
        $oArtList = new oxarticlelist();

        $oVendor = $this->getProxyClass( "vendorlist" );
        $oVendor->setNonPublicVar( "_aArticleList", $oArtList );
        $oVendor->setNonPublicVar( "_iArticleCnt", 1 );

        $this->assertEquals( "testRecomm", $oVendor->getSimilarRecommLists() );
    }

    public function testGetCatTitle()
    {
            $sVendorId = '68342e2955d7401e6.18967838';

        $oVendor = new oxVendor();
        $oVendor->load($sVendorId);

        $oVendorList = $this->getProxyClass( "vendorlist" );
        $oVendorList->setVendorTree( new oxvendorlist() );
        $oVendorList->setNonPublicVar( "_oActVendor", $oVendor );

        $this->assertEquals( $oVendor->oxvendor__oxtitle->value, $oVendorList->getTitle() );
    }

    public function testGetTemplateLocation()
    {
        oxTestModules::addFunction('oxUtilsServer', 'getServerVar', '{ if ( $aA[0] == "HTTP_HOST") { return "shop.com/"; } else { return "test.php";} }');
        modConfig::setParameter( 'cnid', 'v_root' );
        $oVendorTree = new oxvendorlist();
        $oVendorTree->buildVendorTree( 'vendorlist', 'v_root', oxConfig::getInstance()->getShopHomeURL() );

        $oVendor = $this->getProxyClass( "vendorlist" );
        $oVendor->setVendorTree( $oVendorTree );
        $oVendor->init();

        $this->assertEquals( $oVendorTree->getHtmlPath(), $oVendor->getTemplateLocation() );
    }

    public function testGetActiveCategory()
    {
            $sVendorId = '68342e2955d7401e6.18967838';

        $oVendor = new oxVendor();
        $oVendor->load($sVendorId);

        $oVendorList = $this->getProxyClass( "vendorlist" );
        $oVendorList->setVendorTree( new oxvendorlist() );
        $oVendorList->setNonPublicVar( "_oActVendor", $oVendor );

        $this->assertEquals( $oVendor, $oVendorList->getActiveCategory() );
    }

    public function testgetCatTreePath()
    {
        oxTestModules::addFunction('oxUtilsServer', 'getServerVar', '{ if ( $aA[0] == "HTTP_HOST") { return "shop.com/"; } else { return "test.php";} }');
        modConfig::setParameter( 'cnid', 'v_root' );
        $oVendorTree = new oxvendorlist();
        $oVendorTree->buildVendorTree( 'vendorlist', 'v_root', oxConfig::getInstance()->getShopHomeURL() );

        $oVendor = $this->getProxyClass( "vendorlist" );
        $oVendor->setVendorTree( $oVendorTree );
        $oVendor->init();

        $this->assertEquals( $oVendorTree->getPath(), $oVendor->getCatTreePath() );
    }

    public function testNoIndex()
    {
        $oVendor = new vendorlist();
        $this->assertTrue( 0 === $oVendor->noIndex() );
    }

    public function testGetTitleSuffix()
    {
            $sVendorId = '68342e2955d7401e6.18967838';

        $oVendor = new oxVendor();
        $oVendor->load($sVendorId);
        $oVendor->oxvendor__oxshowsuffix = new oxField(1);

        $oVendorList = $this->getProxyClass( "vendorlist" );
        $oVendorList->setVendorTree( new oxvendorlist() );
        $oVendorList->setNonPublicVar( "_oActVendor", $oVendor );

        $this->assertEquals( 'online kaufen', $oVendorList->getTitleSuffix() );
    }

    public function testGetMetaKeywords()
    {
            $sVendorId = '77442e37fdf34ccd3.94620745';
            $sRez = 'are, here, ein, authentisches, glanzst�ck, seiner, zeit, -, original, bush, beach, radio';


        $oVendor = new oxVendor();
        $oVendor->load($sVendorId);

        $oCat = new oxcategory();
        $oCat->oxcategories__oxtitle = new oxField( 'you are here' );

        $oListView = $this->getMock( "vendorlist", array( 'getActVendor', 'getVendorTree', 'getCatTreePath' ) );
        $oListView->expects( $this->atLeastOnce() )->method( 'getActVendor')->will( $this->returnValue( $oVendor ) );
        $oListView->expects( $this->atLeastOnce() )->method( 'getVendorTree' )->will( $this->returnValue( new oxvendorlist() ) );
        $oListView->expects( $this->atLeastOnce() )->method( 'getCatTreePath' )->will( $this->returnValue( array( $oCat ) ) );

        $this->assertEquals( $sRez, $oListView->getMetaKeywords() );
    }

    public function testSetMetaKeywordsIfPathNotSet()
    {
            $sVendorId = '77442e37fdf34ccd3.94620745';
            $sRez = 'by, distributor, ein, authentisches, glanzst�ck, seiner, zeit, -, original, bush, beach, radio';


        $oVendor = new oxVendor();
        $oVendor->load($sVendorId);

        $oCat = new oxcategory();
        $oCat->oxcategories__oxtitle = new oxField( 'By Distributor' );

        $oListView = $this->getMock( "vendorlist", array( 'getActVendor', 'getVendorTree', 'getCatTreePath' ) );
        $oListView->expects( $this->atLeastOnce() )->method( 'getActVendor')->will( $this->returnValue( $oVendor ) );
        $oListView->expects( $this->atLeastOnce() )->method( 'getVendorTree' )->will( $this->returnValue( new oxvendorlist() ) );
        $oListView->expects( $this->atLeastOnce() )->method( 'getCatTreePath' )->will( $this->returnValue( array( $oCat ) ) );

        $this->assertEquals( $sRez, $oListView->getMetaKeywords() );

    }

    public function testGetMetaDescription()
    {
            $sVendorId = '77442e37fdf34ccd3.94620745';
            $sRez = 'by distributor - Original BUSH Beach Radio';

        $oVendor = new oxVendor();
        $oVendor->load($sVendorId);

        $oCat = new oxcategory();
        $oCat->oxcategories__oxtitle = new oxField( 'By Distributor' );

        $oListView = $this->getMock( "vendorlist", array( 'getActVendor', 'getVendorTree', 'getCatTreePath' ) );
        $oListView->expects( $this->atLeastOnce() )->method( 'getActVendor')->will( $this->returnValue( $oVendor ) );
        $oListView->expects( $this->atLeastOnce() )->method( 'getVendorTree' )->will( $this->returnValue( new oxvendorlist() ) );
        $oListView->expects( $this->atLeastOnce() )->method( 'getCatTreePath' )->will( $this->returnValue( array( $oCat ) ) );

        $this->assertEquals( $sRez, $oListView->getMetaDescription() );
    }

    public function testSetMetaDescriptionIfPathNotSet()
    {
            $sVendorId = '68342e2955d7401e6.18967838';
            $sRez = 'By Distributor - Dolch Die gefl�gelte Kaiserin';

        $oVendor = new oxVendor();
        $oVendor->load($sVendorId);

        $oVendorList = $this->getProxyClass( "vendorlist" );
        $oVendorList->setVendorTree( new oxvendorlist() );
        $oVendorList->setNonPublicVar( "_oActVendor", $oVendor );
        $oVendorList->setNonPublicVar( "_sCatPathString", 'By Distributor' );
        $oVendorList->setMetaDescription( null );
        $this->assertEquals( $sRez, $oVendorList->getMetaDescription() );
    }

    public function testAddPageNrParamIfSeo()
    {
        oxTestModules::addFunction("oxutilsserver", "getServerVar", "{ \$aArgs = func_get_args(); if ( \$aArgs[0] === 'HTTP_HOST' ) { return '".oxConfig::getInstance()->getShopUrl()."'; } elseif ( \$aArgs[0] === 'SCRIPT_NAME' ) { return ''; } else { return \$_SERVER[\$aArgs[0]]; } }");
            $sVendorId = '68342e2955d7401e6.18967838';
            $sRez = oxConfig::getInstance()->getShopURL()."Nach-Lieferant/Haller-Stahlwaren/3/";

        $oVendor = new oxVendor();
        $oVendor->load($sVendorId);
        $oVendorList = $this->getProxyClass( "vendorlist" );
        $oVendorList->setNonPublicVar( "_oActVendor", $oVendor );
        $this->assertEquals( $sRez, $oVendorList->UNITaddPageNrParam('aa', 2) );
    }

    public function testAddPageNrParam()
    {
        oxTestModules::addFunction('oxUtils', 'seoIsActive', '{ return true; }');

        $oVendorList = $this->getMock( "vendorlist", array( "getActVendor" ) );
        $oVendorList->expects( $this->atLeastOnce() )->method( 'getActVendor')->will( $this->returnValue( null ) );

        $this->assertEquals( "aaaa?pgNr=2", $oVendorList->UNITaddPageNrParam('aaaa', 2) );
    }

    public function testSetGetItemSorting()
    {
        $oVendorList = $this->getProxyClass( "vendorlist" );
        $oVendorList->setItemSorting('v_aaa', 'oxprice', 'desc');
        $aSort = array("sortby"=>"oxprice","sortdir"=>"desc");
        $this->assertEquals( $aSort, $oVendorList->getSorting('v_aaa') );
    }

}
