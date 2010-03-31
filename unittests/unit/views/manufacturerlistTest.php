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
 * @version   SVN: $Id: manufacturerlistTest.php 26841 2010-03-25 13:58:15Z arvydas $
 */

require_once realpath( "." ).'/unit/OxidTestCase.php';
require_once realpath( "." ).'/unit/test_config.inc.php';

/**
 * Testing oxManufacturerlist class
 */
class Unit_Views_ManufacturerlistTest extends OxidTestCase
{
    /**
     * Initialize the fixture.
     *
     * @return null
     */
    protected function setUp()
    {
        parent::setUp();
        oxTestModules::addFunction('oxSeoEncoderManufacturer', '_saveToDb', '{return null;}');
    }

    /**
     * Tear down the fixture.
     *
     * @return null
     */
    protected function tearDown()
    {
        oxTestModules::addFunction('oxManufacturer', 'cleanRootManufacturer', '{oxManufacturer::$_aRootManufacturer = array();}');
        oxNew('oxManufacturer')->cleanRootManufacturer();
        parent::tearDown();
    }

    /**
     * manufacturerlist::render() test case
     *
     * @return null
     */
    public function testRender()
    {
        $oManufacturer = $this->getMock( "oxStdClass", array( "getId" ) );
        $oManufacturer->expects( $this->atLeastOnce() )->method( 'getId' )->will( $this->returnValue( "testId" ) );

        $oView = $this->getMock( "manufacturerlist", array( "getCatTreePath", "getManufacturerTree", "getActManufacturer", "getArticleList", "getPageNavigation", "_processListArticles", "setMetaDescription", "setMetaKeywords" ) );
        $oView->expects( $this->once() )->method( 'getManufacturerTree' )->will( $this->returnValue( true ) );
        $oView->expects( $this->atLeastOnce() )->method( 'getActManufacturer' )->will( $this->returnValue( $oManufacturer ) );
        $oView->expects( $this->atLeastOnce() )->method( 'getArticleList' );
        $oView->expects( $this->atLeastOnce() )->method( 'getCatTreePath' );
        $oView->expects( $this->once() )->method( 'getPageNavigation' );
        $oView->expects( $this->once() )->method( '_processListArticles' );
        $oView->expects( $this->once() )->method( 'setMetaDescription' );
        $oView->expects( $this->once() )->method( 'setMetaKeywords' );

        $this->assertEquals( "list.tpl", $oView->render() );
    }

    /**
     * manufacturerlist::setItemSorting() & getSorting() test case
     *
     * @return null
     */
    public function testSetItemSortingGetSorting()
    {
        modConfig::setParameter( 'mnid', "testMnId" );

        $oView = new manufacturerlist();
        $oView->setItemSorting( "testCnid", "testBy", "testDir" );
        $this->assertEquals( array( "sortby" => "testBy", "sortdir" => "testDir" ), $oView->getSorting( "testCnid" ) );
    }

    /**
     * manufacturerlist::generatePageNavigationUrl() test case
     *
     * @return null
     */
    public function testGeneratePageNavigationUrlSeoOn()
    {
        oxTestModules::addFunction( 'oxUtils', 'seoIsActive', '{ return true; }');

        $oManufacturer = $this->getMock( "oxStdClass", array( "getLink" ) );
        $oManufacturer->expects( $this->atLeastOnce() )->method( 'getLink' )->will( $this->returnValue( "testLink" ) );

        $oView = $this->getMock( "manufacturerlist", array( "getActManufacturer" ) );
        $oView->expects( $this->once() )->method( 'getActManufacturer')->will( $this->returnValue( $oManufacturer ) );
        $this->assertEquals( "testLink", $oView->generatePageNavigationUrl() );
    }

    /**
     * manufacturerlist::generatePageNavigationUrl() test case
     *
     * @return null
     */
    public function testGeneratePageNavigationUrl()
    {
        oxTestModules::addFunction( 'oxUtils', 'seoIsActive', '{ return false; }');

        $oView = $this->getMock( "manufacturerlist", array( "getActManufacturer" ) );
        $oView->expects( $this->never() )->method( 'getActManufacturer');
        $oView->generatePageNavigationUrl();
    }

    /**
     * manufacturerlist::_addPageNrParam() test case
     *
     * @return null
     */
    public function testAddPageNrParamSeoOn()
    {
        oxTestModules::addFunction( 'oxUtils', 'seoIsActive', '{ return true; }');
        oxTestModules::addFunction( 'oxSeoEncoderManufacturer', 'getManufacturerPageUrl', '{ return "testLink"; }');

        $oView = $this->getMock( "manufacturerlist", array( "getActManufacturer" ) );
        $oView->expects( $this->once() )->method( 'getActManufacturer')->will( $this->returnValue( true ) );
        $this->assertEquals( "testLink", $oView->UNITaddPageNrParam( "testUrl", 1 ) );
    }

    /**
     * manufacturerlist::_addPageNrParam() test case
     *
     * @return null
     */
    public function testAddPageNrParam()
    {
        oxTestModules::addFunction( 'oxUtils', 'seoIsActive', '{ return false; }');

        $oView = $this->getMock( "manufacturerlist", array( "getActManufacturer" ) );
        $oView->expects( $this->never() )->method( 'getActManufacturer');
        $oView->UNITaddPageNrParam( "testUrl", 1 );
    }

    /**
     * Test get additionall url parameters.
     *
     * @return null
     */
    public function testGetAddUrlParams()
    {
        $oManufacturer = new oxManufacturer();
        $oManufacturer->setId( "testManufacturerId" );

        $oView = $this->getMock( "manufacturerlist", array( "getActManufacturer" ) );
        $oView->expects( $this->once() )->method( 'getActManufacturer')->will( $this->returnValue( $oManufacturer ) );

        $oUBaseView = new oxUBase();
        $sTestParams = $oUBaseView->getAddUrlParams();
        $sTestParams .= ($sTestParams?'&amp;':'') . "listtype=manufacturer";
        $sTestParams .= "&amp;mnid=testManufacturerId";

        $this->assertEquals( $sTestParams, $oView->getAddUrlParams() );
    }

    /**
     * Test get path.
     *
     * @return null
     */
    public function testGetTreePath()
    {
        $oManufacturerList = $this->getMock( "oxmanufacturerlist", array( "getPath" ) );
        $oManufacturerList->expects( $this->once() )->method( 'getPath')->will( $this->returnValue( "testPath" ) );

        $oView = $this->getMock( "manufacturerlist", array( "getManufacturerTree" ) );
        $oView->expects( $this->once() )->method( 'getManufacturerTree')->will( $this->returnValue( $oManufacturerList ) );

        $this->assertEquals( "testPath", $oView->getTreePath() );
    }

    /**
     * Test get subject.
     *
     * @return null
     */
    public function testGetSubject()
    {
        $oView = $this->getMock( "manufacturerlist", array( "getActManufacturer" ) );
        $oView->expects( $this->once() )->method( 'getActManufacturer')->will( $this->returnValue( "testActManufacturer" ) );

        $this->assertEquals( "testActManufacturer", $oView->UNITgetSubject( 0 ) );
    }

    /**
     * Test process article urls.
     *
     * @return null
     */
    public function testProcessListArticles()
    {
        $oArticle = new oxArticle();

        $oListView = new manufacturerlist();
        $this->assertEquals( 2, $oListView->UNITgetProductLinkType() );
    }

    /**
     * Test get sub category list.
     *
     * @return null
     */
    public function testGetSubCatList()
    {
        modConfig::setParameter( 'mnid', 'root' );
        $oManufacturerTree = new oxManufacturerlist();
        $oManufacturerTree->buildManufacturerTree( 'manufacturerlist', 'root', oxConfig::getInstance()->getShopHomeURL() );

        $oManufacturer = new Manufacturerlist();
        $oManufacturer->setManufacturerTree( $oManufacturerTree );
        $oTree = $oManufacturer->getSubCatList();

        $this->assertEquals( $oManufacturerTree, $oTree );
    }

    /**
     * Test if there sub categories exist.
     *
     * @return null
     */
    public function testHasVisibleSubCats()
    {
        modConfig::setParameter( 'mnid', 'root' );
        $oManufacturerTree = new oxManufacturerlist();
        $oManufacturerTree->buildManufacturerTree( 'manufacturerlist', 'root', oxConfig::getInstance()->getShopHomeURL() );

        $oManufacturer = new Manufacturerlist();
        $oManufacturer->setManufacturerTree( $oManufacturerTree );

        $this->assertEquals( 4, $oManufacturer->hasVisibleSubCats() );
    }

    /**
     * Test get article list and count.
     *
     * @return null
     */
    public function testGetArticleListAndCount()
    {
        //testing over mock
            $sManufacturerId = 'fe07958b49de225bd1dbc7594fb9a6b0';


        modConfig::setParameter( 'cnid', $sManufacturerId );
        modConfig::getInstance()->setConfigParam( 'iNrofCatArticles', 20 );
        $oManufacturerTree = new oxManufacturerlist();
        $oManufacturerTree->buildManufacturerTree( 'Manufacturerlist', $sManufacturerId, oxConfig::getInstance()->getShopHomeURL() );

        $oManufacturer = new oxManufacturer();
        $oManufacturer->load($sManufacturerId);

        $oManufacturerList = $this->getProxyClass( "Manufacturerlist" );
        $oManufacturerList->setManufacturerTree( $oManufacturerTree );
        $oManufacturerList->setNonPublicVar( "_oActManufacturer", $oManufacturer );
        $oArtList = $oManufacturerList->getArticleList();

        $this->assertEquals(oxUtilsCount::getInstance()->getManufacturerArticleCount( $sManufacturerId ), count( $oArtList ));
    }

    /**
     * Test get page navigation.
     *
     * @return null
     */
    public function testGetPageNavigation()
    {
        $oManufacturer = $this->getMock( 'Manufacturerlist', array( 'generatePageNavigation' ));
        $oManufacturer->expects( $this->any() )->method( 'generatePageNavigation')->will($this->returnValue( "aaa" ) );
        $this->assertEquals( 'aaa', $oManufacturer->getPageNavigation() );
    }

    /**
     * Test get recomendation list.
     *
     * @return null
     */
    public function testGetRecommList()
    {
        oxTestModules::addFunction('oxRecommList', 'getRecommListsByIds', '{ return "testRecomm"; }');
        $oArtList = new oxarticlelist();

        $oManufacturer = $this->getProxyClass( "Manufacturerlist" );
        $oManufacturer->setNonPublicVar( "_aArticleList", $oArtList );
        $oManufacturer->setNonPublicVar( "_iArticleCnt", 1 );

        $this->assertEquals( "testRecomm", $oManufacturer->getSimilarRecommLists() );
    }

    /**
     * Test get list title.
     *
     * @return null
     */
    public function testGetCatTitle()
    {
            $sManufacturerId = 'fe07958b49de225bd1dbc7594fb9a6b0';

        $oManufacturer = new oxManufacturer();
        $oManufacturer->load($sManufacturerId);

        $oManufacturerList = $this->getProxyClass( "Manufacturerlist" );
        $oManufacturerList->setManufacturerTree( new oxManufacturerlist() );
        $oManufacturerList->setNonPublicVar( "_oActManufacturer", $oManufacturer );

        $this->assertEquals( $oManufacturer->oxmanufacturers__oxtitle->value, $oManufacturerList->getTitle() );
    }

    /**
     * Test get template location.
     *
     * @return null
     */
    public function testGetTemplateLocation()
    {
        modConfig::setParameter( 'cnid', 'v_root' );
        $oManufacturerTree = new oxManufacturerlist();
        $oManufacturerTree->buildManufacturerTree( 'Manufacturerlist', 'v_root', oxConfig::getInstance()->getShopHomeURL() );

        $oManufacturer = $this->getProxyClass( "Manufacturerlist" );
        $oManufacturer->setManufacturerTree( $oManufacturerTree );
        $oManufacturer->init();

        $this->assertEquals( $oManufacturerTree->getHtmlPath(), $oManufacturer->getTemplateLocation() );
    }

    /**
     * Test get active category.
     *
     * @return null
     */
    public function testGetActiveCategory()
    {
            $sManufacturerId = 'fe07958b49de225bd1dbc7594fb9a6b0';

        $oManufacturer = new oxManufacturer();
        $oManufacturer->load($sManufacturerId);

        $oManufacturerList = $this->getProxyClass( "Manufacturerlist" );
        $oManufacturerList->setManufacturerTree( new oxManufacturerlist() );
        $oManufacturerList->setNonPublicVar( "_oActManufacturer", $oManufacturer );

        $this->assertEquals( $oManufacturer, $oManufacturerList->getActiveCategory() );
    }

    /**
     * Test get category path.
     *
     * @return null
     */
    public function testgetCatTreePath()
    {
        modConfig::setParameter( 'cnid', 'v_root' );
        $oManufacturerTree = new oxManufacturerlist();
        $oManufacturerTree->buildManufacturerTree( 'Manufacturerlist', 'v_root', oxConfig::getInstance()->getShopHomeURL() );

        $oManufacturer = $this->getProxyClass( "Manufacturerlist" );
        $oManufacturer->setManufacturerTree( $oManufacturerTree );
        $oManufacturer->init();

        $this->assertEquals( $oManufacturerTree->getPath(), $oManufacturer->getCatTreePath() );
    }

    /**
     * Test noIndex property getter.
     *
     * @return null
     */
    public function testNoIndex()
    {
        $oManufacturer = new manufacturerlist();
        $this->assertTrue( 0 === $oManufacturer->noIndex() );
    }

    /**
     * Test get tile sufix.
     *
     * @return null
     */
    public function testGetTitleSuffix()
    {
            $sManufacturerId = 'fe07958b49de225bd1dbc7594fb9a6b0';

        $oManufacturer = new oxManufacturer();
        $oManufacturer->load($sManufacturerId);
        $oManufacturer->oxmanufacturer__oxshowsuffix = new oxField(1);

        $oManufacturerList = $this->getProxyClass( "Manufacturerlist" );
        $oManufacturerList->setManufacturerTree( new oxManufacturerlist() );
        $oManufacturerList->setNonPublicVar( "_oActManufacturer", $oManufacturer );

        $this->assertEquals( 'online kaufen', $oManufacturerList->getTitleSuffix() );
    }

}
