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
 * @copyright (C) OXID eSales AG 2003-2011
 * @version OXID eShop CE
 * @version   SVN: $Id: alistTest.php 27199 2010-04-14 07:59:38Z arvydas $
 */

require_once realpath( "." ).'/unit/OxidTestCase.php';
require_once realpath( "." ).'/unit/test_config.inc.php';

/**
 * Tests for aList class
 */
class Unit_Views_alistTest extends OxidTestCase
{
    /**
     * Tear down the fixture.
     *
     * @return null
     */
    protected function tearDown()
    {
        // deleting test data
        oxDb::getDb()->execute( "delete from oxseo where oxtype != 'static' " );

        parent::tearDown();
    }

    /**
     * Test get added url parameters.
     *
     * @return null
     */
    public function testGetAddUrlParams()
    {
        modConfig::setParameter( "pgNr", 999 );
        oxTestModules::addFunction( "oxUtils", "seoIsActive", "{ return false; }" );

        $oView = new alist();

        $oUBaseView = new oxUBase();
        $sTestParams  = $oUBaseView->getAddUrlParams();
        $sTestParams .= ($sTestParams?'&amp;':'') . "pgNr=999";

        $this->assertEquals( $sTestParams, $oView->getAddUrlParams() );
    }

    /**
     * Test get added seo url parameters.
     *
     * @return null
     */
    public function testGetAddSeoUrlParams()
    {
        $oView = new alist();
        $this->assertNull( $oView->getAddSeoUrlParams() );
    }

    /**
     * Test get page title sufix.
     *
     * @return null
     */
    public function testGetTitlePageSuffix()
    {
        $oView = $this->getMock( "alist", array( "getActPage" ) );
        $oView->expects( $this->once() )->method( 'getActPage')->will( $this->returnValue( 0 ) );

        $this->assertNull( $oView->getTitlePageSuffix() );

        $oView = $this->getMock( "alist", array( "getActPage" ) );
        $oView->expects( $this->once() )->method( 'getActPage')->will( $this->returnValue( 1 ) );

        $this->assertEquals( oxLang::getInstance()->translateString( 'INC_HEADER_TITLEPAGE' ). 2, $oView->getTitlePageSuffix() );
    }

    /**
     * Test get page meta description sufix.
     *
     * @return null
     */
    public function testGetMetaDescription()
    {
        $sCatId  = '8a142c3e60a535f16.78077188';
        $sPrefix = "Sie sind hier  Wohnen - Uhren. Originelle, witzige Geschenkideen - Lifestyle, Trends, Accessoires";

        $oCategory = new oxCategory();
        $oCategory->load( $sCatId );

        $oView = $this->getMock( "alist", array( "getActPage", "_getCategory" ) );
        $oView->expects( $this->once() )->method( 'getActPage')->will( $this->returnValue( 1 ) );
        $oView->expects( $this->once() )->method( '_getCategory')->will( $this->returnValue( $oCategory ) );

        $this->assertEquals( $sPrefix.", ".oxLang::getInstance()->translateString( 'INC_HEADER_TITLEPAGE' ). 2, $oView->getMetaDescription() );
    }

    /**
     * Test get category path.
     *
     * @return null
     */
    public function testGetTreePath()
    {
        $oCategoryList = $this->getMock( "oxcategorylist", array( "getPath" ) );
        $oCategoryList->expects( $this->once() )->method( 'getPath')->will( $this->returnValue( "testPath" ) );

        $oView = $this->getMock( "alist", array( "getCategoryTree" ) );
        $oView->expects( $this->once() )->method( 'getCategoryTree')->will( $this->returnValue( $oCategoryList ) );

        $this->assertEquals( "testPath", $oView->getTreePath() );
    }

    /**
     * Test get canonical url with seo on.
     *
     * @return null
     */
    public function testGetCanonicalUrlSeoOn()
    {
        oxTestModules::addFunction( "oxUtils", "seoIsActive", "{ return true; }" );

        $oCategory = $this->getMock( "oxcategory", array( "getBaseSeoLink", "getBaseStdLink", "getLanguage" ) );
        $oCategory->expects( $this->once() )->method( 'getBaseSeoLink')->will( $this->returnValue( "testSeoUrl" ) );
        $oCategory->expects( $this->never() )->method( 'getBaseStdLink');
        $oCategory->expects( $this->once() )->method( 'getLanguage')->will( $this->returnValue( 1 ) );

        $oListView = $this->getMock( "alist", array( "getActPage", "getActiveCategory" ) );
        $oListView->expects( $this->once() )->method( 'getActPage')->will( $this->returnValue( 1 ) );
        $oListView->expects( $this->once() )->method( 'getActiveCategory')->will( $this->returnValue( $oCategory ) );

        $this->assertEquals( "testSeoUrl", $oListView->getCanonicalUrl() );
    }

    /**
     * Test get canonical url with seo off.
     *
     * @return null
     */
    public function testGetCanonicalUrlSeoOff()
    {
        oxTestModules::addFunction( "oxUtils", "seoIsActive", "{ return false; }" );

        $oCategory = $this->getMock( "oxcategory", array( "getBaseSeoLink", "getBaseStdLink", "getLanguage" ) );
        $oCategory->expects( $this->never() )->method( 'getBaseSeoLink');
        $oCategory->expects( $this->once() )->method( 'getBaseStdLink')->will( $this->returnValue( "testStdUrl" ) );
        $oCategory->expects( $this->once() )->method( 'getLanguage')->will( $this->returnValue( 1 ) );

        $oListView = $this->getMock( "alist", array( "getActPage", "getActiveCategory" ) );
        $oListView->expects( $this->once() )->method( 'getActPage')->will( $this->returnValue( 1 ) );
        $oListView->expects( $this->once() )->method( 'getActiveCategory')->will( $this->returnValue( $oCategory ) );

        $this->assertEquals( "testStdUrl", $oListView->getCanonicalUrl() );
    }

    /**
     * Test get noIndex property.
     *
     * @return null
     */
    public function testNoIndex()
    {
        // regular category
        $oListView = new alist();
        $this->assertEquals( 0, $oListView->noIndex() );
    }

    /**
     * Test list article url processing.
     *
     * @return null
     */
    public function testProcessListArticles()
    {
        $oArticle = $this->getMock( 'oxarticle', array( 'setLinkType', "appendStdLink", "appendLink" ) );
        $oArticle->expects( $this->once() )->method( 'setLinkType')->with( $this->equalto( 'xxx' ) );
        $oArticle->expects( $this->once() )->method( 'appendStdLink')->with( $this->equalto( 'testStdParams' ) );
        $oArticle->expects( $this->once() )->method( 'appendLink')->with( $this->equalto( 'testSeoParams' ) );
        $aArticleList[] = $oArticle;

        $oArticle = $this->getMock( 'oxarticle', array( 'setLinkType', "appendStdLink", "appendLink" ) );
        $oArticle->expects( $this->once() )->method( 'setLinkType')->with( $this->equalto( 'xxx' ) );
        $oArticle->expects( $this->once() )->method( 'appendStdLink')->with( $this->equalto( 'testStdParams' ) );
        $oArticle->expects( $this->once() )->method( 'appendLink')->with( $this->equalto( 'testSeoParams' ) );
        $aArticleList[] = $oArticle;

        $oListView = $this->getMock( 'alist', array( 'getArticleList', '_getProductLinkType', "getAddUrlParams", "getAddSeoUrlParams" ) );
        $oListView->expects( $this->once() )->method( 'getArticleList')->will( $this->returnValue( $aArticleList ) );
        $oListView->expects( $this->once() )->method( '_getProductLinkType')->will( $this->returnValue( 'xxx' ) );
        $oListView->expects( $this->once() )->method( 'getAddUrlParams')->will( $this->returnValue( 'testStdParams' ) );
        $oListView->expects( $this->once() )->method( 'getAddSeoUrlParams')->will( $this->returnValue( 'testSeoParams' ) );

        $oListView->UNITprocessListArticles();
    }

    /**
     * Test get product link type.
     *
     * @return null
     */
    public function testGetProductLinkType()
    {
        $oCategory = $this->getMock( 'oxcategory', array( 'isPriceCategory' ) );
        $oCategory->expects( $this->once() )->method( 'isPriceCategory')->will( $this->returnValue( true ) );

        $oListView = $this->getMock( 'alist', array( 'getActCategory' ) );
        $oListView->expects( $this->once() )->method( 'getActCategory')->will( $this->returnValue( $oCategory ) );
        $this->assertEquals( 3, $oListView->UNITgetProductLinkType() );


        $oCategory = $this->getMock( 'oxcategory', array( 'isPriceCategory' ) );
        $oCategory->expects( $this->once() )->method( 'isPriceCategory')->will( $this->returnValue( false ) );

        $oListView = $this->getMock( 'alist', array( 'getActCategory' ) );
        $oListView->expects( $this->once() )->method( 'getActCategory')->will( $this->returnValue( $oCategory ) );
        $this->assertEquals( 0, $oListView->UNITgetProductLinkType() );
    }

    /**
     * Test render more categoty list page.
     *
     * @return null
     */
    public function testRenderForMoreCategory()
    {
        modConfig::getInstance()->setConfigParam( 'blTopNaviLayout', true );
        modConfig::setParameter( 'cnid', 'oxmore' );

        $oMoreCat = oxNew( 'oxcategory' );
        $oMoreCat->oxcategories__oxactive = new oxField( 1, oxField::T_RAW );

        $oListView = $this->getMock( "aList", array( 'setActCategory' ) );
        $oListView->expects( $this->once() )->method( 'setActCategory')->with( $this->equalto( $oMoreCat ) );
        $this->assertEquals( 'list_more.tpl', $oListView->render() );
    }

    /**
     * Test load price category articles.
     *
     * @return null
     */
    public function testLoadArticlesForPriceCategory()
    {
        oxTestModules::addFunction( "oxarticlelist", "loadPriceArticles", "{ throw new Exception( \$aA[0] . \$aA[1] ); }" );

        $oCategory = new oxcategory();
        $oCategory->oxcategories__oxpricefrom = $this->getMock( 'oxField', array( '__get' ) );
        $oCategory->oxcategories__oxpricefrom->expects( $this->exactly( 2 ) )->method( '__get')->will( $this->returnValue( 10 ) );
        $oCategory->oxcategories__oxpriceto = $this->getMock( 'oxField', array( '__get' ) );
        $oCategory->oxcategories__oxpriceto->expects( $this->once() )->method( '__get')->will( $this->returnValue( 100 ) );

        try {
            $oListView = new aList();
            $oListView->UNITloadArticles( $oCategory );
        } catch ( Exception $oExcp ) {
            $this->assertEquals( '10100', $oExcp->getMessage() );
            return;
        }
        $this->fail( 'failed testLoadArticlesForPriceCategory' );
    }

    /**
     * Test render inactive category page.
     *
     * @return null
     */
    public function testRenderInactiveCategory()
    {
        oxTestModules::addFunction( "oxUtils", "redirect", "{ throw new Exception('OK'); }" );

        $oCat = oxNew( 'oxcategory' );
        $oCat->oxcategories__oxactive = new oxField( 0, oxField::T_RAW );

        $oListView = $this->getMock( "aList", array( 'getActCategory' ) );
        $oListView->expects( $this->atLeastOnce() )->method( 'getActCategory')->will( $this->returnValue( $oCat ) );

        try {
            $oListView->render();
        } catch ( Exception $oExcp ) {
            $this->assertEquals( 'OK', $oExcp->getMessage(), 'failed redirect on inactive category' );
            return;
        }

        $this->fail( 'failed redirect on inactive category' );
    }

    /**
     * Test execute article filter.
     *
     * @return null
     */
    public function testExecutefilter()
    {
        modConfig::setParameter( 'attrfilter', 'somefilter' );
        modConfig::setParameter( 'cnid', 'somecategory' );
        modSession::getInstance()->setVar( 'session_attrfilter', null );

        $oListView = new aList();
        $oListView->executefilter();

        $this->assertEquals( array( 'somecategory' => 'somefilter' ), oxSession::getVar( 'session_attrfilter' ) );
    }

    /**
     * Test get category subject.
     *
     * @return null
     */
    public function testGetSubject()
    {
        $oListView = $this->getMock( 'alist', array( 'getActCategory' ) );
        $oListView->expects( $this->once() )->method( 'getActCategory')->will( $this->returnValue( 'getActCategory' ) );

        $this->assertEquals( 'getActCategory', $oListView->UNITgetSubject( oxLang::getInstance()->getBaseLanguage() ) );
    }

    /**
     * Test get list title sufix.
     *
     * @return null
     */
    public function testGetTitleSuffix()
    {
        $oCat = new oxcategory();
        $oCat->oxcategories__oxshowsuffix = $this->getMock( 'oxfield', array( '__get' ) );
        $oCat->oxcategories__oxshowsuffix->expects( $this->once() )->method( '__get')->will( $this->returnValue( true ) );

        $oShop = new oxshop();
        $oShop->oxshops__oxtitlesuffix = $this->getMock( 'oxfield', array( '__get' ) );
        $oShop->oxshops__oxtitlesuffix->expects( $this->once() )->method( '__get')->will( $this->returnValue( 'testsuffix' ) );

        $oConfig = $this->getMock( 'oxconfig', array( 'getActiveShop' ) );
        $oConfig->expects( $this->once() )->method( 'getActiveShop')->will( $this->returnValue( $oShop ) );

        $oListView = $this->getMock( 'alist', array( 'getActCategory', 'getConfig' ) );
        $oListView->expects( $this->once() )->method( 'getActCategory')->will( $this->returnValue( $oCat ) );
        $oListView->expects( $this->once() )->method( 'getConfig')->will( $this->returnValue( $oConfig ) );

        $this->assertEquals( 'testsuffix', $oListView->getTitleSuffix() );
    }

    /**
     * Test get list sorting info.
     *
     * @return null
     */
    public function testGetSorting()
    {
        $oCat = new oxcategory();
        $oCat->oxcategories__oxdefsort = $this->getMock( 'oxfield', array( '__get' ) );
        $oCat->oxcategories__oxdefsort->expects( $this->exactly( 2 ) )->method( '__get')->will( $this->returnValue( 'testsort' ) );
        $oCat->oxcategories__oxdefsortmode = $this->getMock( 'oxfield', array( '__get' ) );
        $oCat->oxcategories__oxdefsortmode->expects( $this->once() )->method( '__get')->will( $this->returnValue( true ) );

        $oListView = $this->getMock( 'alist', array( 'getActCategory' ) );
        $oListView->expects( $this->once() )->method( 'getActCategory')->will( $this->returnValue( $oCat ) );
        $this->assertEquals( array( 'sortby' => getViewName( 'oxarticles' ).'.testsort', 'sortdir' => "desc" ), $oListView->getSorting( '999' ) );
    }

    /**
     * Test list page navigation and seo url generation.
     *
     * @return null
     */
    public function testGeneratePageNavigationUrlForCategoryPlusSeo()
    {
        $sTestLink = 'testLink';

        $oCat = $this->getMock( 'oxcategory', array( 'getLink' ) );
        $oCat->expects( $this->once() )->method( 'getLink')->will( $this->returnValue( $sTestLink ) );

        $oListView = $this->getMock( 'alist', array( 'getActCategory' ) );
        $oListView->expects( $this->once() )->method( 'getActCategory')->will( $this->returnValue( $oCat ) );

        $this->assertEquals( $sTestLink, $oListView->generatePageNavigationUrl() );
    }

    /**
     * Test list page navigation url generation.
     *
     * @return null
     */
    public function testGeneratePageNavigationUrl()
    {
        $oListView = $this->getMock( 'alist', array( 'getActCategory' ) );
        $oListView->expects( $this->once() )->method( 'getActCategory')->will( $this->returnValue( null ) );

        $oView = new oxubase();
        $this->assertEquals( $oView->generatePageNavigationUrl(), $oListView->generatePageNavigationUrl() );
    }

    /**
     * Test PE view id getter.
     *
     * @return null
     */
    public function testGetViewIdPE()
    {

        modConfig::setParameter( 'cnid', 'xxx' );
        modConfig::setParameter( '_artperpage', '100' );

        $oView = new oxUBase();
        $sViewId = md5( $oView->getViewId().'|xxx|999|100' );

        $oListView = $this->getMock( 'alist', array( 'getActPage' ) );
        $oListView->expects( $this->any() )->method( 'getActPage')->will( $this->returnValue( '999' ) );
        $this->assertEquals( $sViewId, $oListView->getViewId() );
    }


    /**
     * Test get category path as string.
     *
     * @return null
     */
    public function testGetCatPathString()
    {
        $oCategory = new oxcategory();
        $oCategory->oxcategories__oxtitle = $this->getMock( 'oxField', array( '__get' ) );
        $oCategory->oxcategories__oxtitle->expects( $this->any() )->method( '__get')->will( $this->returnValue( 'testTitle' ) );

        $aPath = array( $oCategory, $oCategory );

        $oListView = $this->getMock( 'alist', array( 'getCatTreePath' ) );
        $oListView->expects( $this->any() )->method( 'getCatTreePath')->will( $this->returnValue( $aPath ) );

        $this->assertEquals( strtolower( 'testTitle, testTitle' ), $oListView->UNITgetCatPathString());
    }

    /**
     * Test prapare list meta description info.
     *
     * @return null
     */
    public function testCollectMetaDescription()
    {
        $oActCat = new oxcategory();
        $oActCat->oxcategories__oxlongdesc = $this->getMock( 'oxField', array( '__get' ) );
        $oActCat->oxcategories__oxlongdesc->expects( $this->once() )->method( '__get')->will( $this->returnValue( '' ) );

        $oArticle = new oxArticle();
        $oArticle->oxarticles__oxtitle = $this->getMock( 'oxField', array( '__get' ) );
        $oArticle->oxarticles__oxtitle->expects( $this->exactly( 2 ) )->method( '__get')->will( $this->returnValue( 'testtitle' ) );

        $oArtList = new oxlist();
        $oArtList->offsetSet( 0, $oArticle );
        $oArtList->offsetSet( 1, $oArticle );

        $sCatPathString = 'sCatPathString';

        $oListView = $this->getMock( 'alist', array( 'getActCategory', 'getArticleList', '_getCatPathString' ) );
        $oListView->expects( $this->any() )->method( 'getActCategory')->will( $this->returnValue( $oActCat ) );
        $oListView->expects( $this->any() )->method( 'getArticleList')->will( $this->returnValue( $oArtList ) );
        $oListView->expects( $this->any() )->method( '_getCatPathString')->will( $this->returnValue( $sCatPathString ) );

        $sMeta = 'sCatPathString - testtitle, testtitle';

        $oView = new oxubase();
        $this->assertEquals( $oView->UNITprepareMetaDescription( $sMeta ), $oListView->UNITcollectMetaDescription( false ) );
    }

    /**
     * Test prapare list meta keyword info.
     *
     * @return null
     */
    public function testCollectMetaKeyword()
    {
        $oLongDesc = new oxField('testtitle');
        $oArticle = $this->getMock( 'oxarticle', array( 'getArticleLongDesc' ) );
        $oArticle->expects( $this->exactly( 2 ) )->method( 'getArticleLongDesc')->will( $this->returnValue( $oLongDesc ) );

        $oArtList = new oxlist();
        $oArtList->offsetSet( 0, $oArticle );
        $oArtList->offsetSet( 1, $oArticle );

        $sCatPathString = 'sCatPathString';

        $oListView = $this->getMock( 'alist', array( 'getArticleList', '_getCatPathString', '_prepareMetaDescription' ) );
        $oListView->expects( $this->any() )->method( '_prepareMetaDescription')->with( $this->equalTo( 'sCatPathString, testtitle, testtitle' ) )->will( $this->returnValue( 'test' ) );
        $oListView->expects( $this->any() )->method( 'getArticleList')->will( $this->returnValue( $oArtList ) );
        $oListView->expects( $this->any() )->method( '_getCatPathString')->will( $this->returnValue( $sCatPathString ) );

        $this->assertEquals( 'test', $oListView->UNITcollectMetaKeyword( null ) );
    }

    /**
     * Test prapare list meta keyword info longer then 60 symbols.
     *
     * @return null
     */
    public function testCollectMetaKeywordLongerThen60()
    {
        $oLongDesc = new oxField('testtitle Originelle, witzige Geschenkideen - Lifestyle, Trends, Accessoires');
        $oArticle = $this->getMock( 'oxarticle', array( 'getArticleLongDesc' ) );
        $oArticle->expects( $this->exactly( 1 ) )->method( 'getArticleLongDesc')->will( $this->returnValue( $oLongDesc ) );

        $oArtList = new oxlist();
        $oArtList->offsetSet( 0, $oArticle );

        $sCatPathString = 'sCatPathString';

        $oListView = $this->getMock( 'alist', array( 'getArticleList', '_getCatPathString', '_prepareMetaDescription' ) );
        $oListView->expects( $this->any() )->method( '_prepareMetaDescription')->with( $this->equalTo( 'sCatPathString, testtitle originelle, witzige geschenkideen - lifestyle, ' ) )->will( $this->returnValue( 'test' ) );
        $oListView->expects( $this->any() )->method( 'getArticleList')->will( $this->returnValue( $oArtList ) );
        $oListView->expects( $this->any() )->method( '_getCatPathString')->will( $this->returnValue( $sCatPathString ) );

        $this->assertEquals( 'test', $oListView->UNITcollectMetaKeyword( null ) );
    }

    /**
     * Test list view template name getter
     *
     * @return null
     */
    public function testGetTemplateName()
    {
        $oCategory = new oxcategory();
        $oCategory->oxcategories__oxtemplate = new oxfield( 'test.tpl' );

        // default template name
        $oListView = $this->getMock( 'alist', array( 'getActCategory' ) );
        $this->assertEquals( 'list.tpl', $oListView->getTemplateName() );

        $oListView = $this->getMock( 'alist', array( 'getActCategory' ) );
        $oListView->expects( $this->any() )->method( 'getActCategory')->will( $this->returnValue( $oCategory ) );

        // category template name
        $this->assertEquals( 'test.tpl', $oListView->getTemplateName() );

        modConfig::setParameter( 'tpl', 'http://www.shop.com/somepath/test2.tpl' );

        // template name passed by request param
        $this->assertEquals( 'test2.tpl', $oListView->getTemplateName() );
    }

    /**
     * Test do not add page nr to list seo url for first page.
     *
     * @return null
     */
    public function testAddPageNrParamSeoOnFirstPage()
    {
        oxTestModules::addFunction( "oxUtils", "seoIsActive", "{ return true; }" );

        $oCategory = new oxcategory();
            $oCategory->load( '30e44ab83159266c7.83602558' );
        $sUrl = $oCategory->getLink();

        $oListView = $this->getMock( 'alist', array( 'getActCategory' ) );
        $oListView->expects( $this->any() )->method( 'getActCategory')->will( $this->returnValue( $oCategory ) );
        $this->assertEquals( $sUrl, $oListView->UNITaddPageNrParam( $sUrl, 0, 0 ) );
    }

    /**
     * Test add page nr to list seo url for second page.
     *
     * @return null
     */
    public function testAddPageNrParamSeoOnSecondPage()
    {
        oxTestModules::addFunction("oxutilsserver", "getServerVar", "{ \$aArgs = func_get_args(); if ( \$aArgs[0] === 'HTTP_HOST' ) { return '".oxConfig::getInstance()->getShopUrl()."'; } elseif ( \$aArgs[0] === 'SCRIPT_NAME' ) { return ''; } else { return \$_SERVER[\$aArgs[0]]; } }");

        $oCategory = new oxcategory();
            $oCategory->load( '30e44ab83159266c7.83602558' );
        $sUrl = $oCategory->getLink();

        $oListView = $this->getMock( 'alist', array( 'getActCategory' ) );
        $oListView->expects( $this->any() )->method( 'getActCategory')->will( $this->returnValue( $oCategory ) );
        $this->assertEquals( $sUrl."2/", $oListView->UNITaddPageNrParam( $sUrl, 1, 0 ) );
    }

    /**
     * Test add page nr to list url when seo is off.
     *
     * @return null
     */
    public function testAddPageNrParamSeoOff()
    {
        $oCategory = new oxcategory();
            $oCategory->load( '30e44ab83159266c7.83602558' );
        $sUrl = $oCategory->getStdLink();

        $oListView = $this->getMock( 'alist', array( 'getActCategory' ) );
        $oListView->expects( $this->any() )->method( 'getActCategory')->will( $this->returnValue( null ) );

        $this->assertEquals( $sUrl."&amp;pgNr=10", $oListView->UNITaddPageNrParam( $sUrl, 10, 0 ) );
    }

    /**
     * Test if url is marked as fixed.
     *
     * @return null
     */
    public function testIsFixedUrl()
    {
        $oCat1 = new oxcategory();
        $oCat1->setId( 'cat1' );

        $oCat2 = new oxcategory();
        $oCat2->setId( 'cat2' );

        $sId = $oCat1->getId();
        $iLang = $oCat1->getLanguage();
        $sShopId = oxConfig::getInstance()->getShopId();

        // inserting test data
        oxDb::getDb()->execute( "insert into oxseo ( `oxobjectid`, `oxident`, `oxshopid`, `oxlang`, `oxstdurl`, `oxseourl`, `oxtype`, `oxfixed` ) values ( '{$sId}', 'cat1ident', '{$sShopId}', '{$iLang}', 'cat1stdurl', 'cat1seourl', 'oxcategory', '1' ) " );

        $oListView = new alist();
        $this->assertTrue( (bool) $oListView->UNITisFixedUrl( $oCat1 ) );

        $oListView = new alist();
        $this->assertFalse( (bool) $oListView->UNITisFixedUrl( $oCat2 ) );
    }


    /**
     * Test prepare meta keywords.
     *
     * @return null
     */
    public function testPrepareMetaKeyword()
    {
        $aSubCats[0] = new oxcategory();
        $aSubCats[0]->oxcategories__oxtitle = new oxField( 'sub_category_1' );

        $aSubCats[1] = new oxcategory();
        $aSubCats[1]->oxcategories__oxtitle = new oxField( 'Nada fedia nada' );

        $oParentCategory = new oxcategory();
        $oParentCategory->oxcategories__oxtitle = new oxField( 'parent_category' );

        $oCategory = new oxcategory();
        $oCategory->oxcategories__oxtitle = new oxField( 'current_category' );
        $oCategory->oxcategories__oxparentid = new oxField( 'parentCategoryId' );

        $oCategory->setSubCats( $aSubCats );
        $oCategory->setParentCategory( $oParentCategory );

        $aCatTree[] = $oParentCategory;
        $aCatTree[] = $oCategory;

        $oCategoryTree = $this->getMock( 'oxcategorylist', array( 'getPath' ) );
        $oCategoryTree->expects( $this->any() )->method( 'getPath')->will( $this->returnValue( $aCatTree ) );

        $oListView = $this->getMock( 'alist', array( 'getActCategory', 'getCategoryTree' ) );
        $oListView->expects( $this->any() )->method( 'getActCategory')->will($this->returnValue( $oCategory ) );
        $oListView->expects( $this->any() )->method( 'getCategoryTree')->will( $this->returnValue( $oCategoryTree ) );

        $this->assertEquals( 'parent_category, current_category, sub_category_1, nada, fedia', $oListView->UNITprepareMetaKeyword( null ) );
    }

    /**
     * Test prepare meta description.
     *
     * @return null
     */
    public function testPrepareMetaDescription()
    {
        $oParentCategory = new oxcategory();
        $oParentCategory->oxcategories__oxtitle = new oxField( 'parent category' );

        $oCategory = new oxcategory();
        $oCategory->oxcategories__oxtitle = new oxField( 'category' );
        $oCategory->oxcategories__oxparentid = new oxField( 'parentcategory' );

        $oCategory->setParentCategory( $oParentCategory );

        $oListView = $this->getMock( "alist", array( 'getActCategory' ) );
        $oListView->expects( $this->any() )->method( 'getActCategory')->will($this->returnValue( $oCategory ) );

        $this->assertEquals(
            'Sie sind hier  parent category - category. Originelle, witzige Geschenkideen - Lifestyle, Trends, Accessoires',
            $oListView->UNITprepareMetaDescription( $aCatPath, 1024, false )
        );
    }

    /**
     * Test get category attributes.
     *
     * @return null
     */
    public function testGetAttributes()
    {
        $oCategory = $this->getMock( 'oxcategory', array( 'getAttributes' ));
        $oCategory->expects( $this->any() )->method( 'getAttributes')->will($this->returnValue( array("testattr") ) );

        $oListView = $this->getMock( "alist", array( 'getActCategory' ) );
        $oListView->expects( $this->any() )->method( 'getActCategory')->will($this->returnValue( $oCategory ) );
        $this->assertEquals( array("testattr"), $oListView->getAttributes() );
    }

    /**
     * Test get simmilar recommendation lists.
     *
     * @return null
     */
    public function testGetSimilarRecommLists()
    {
        oxTestModules::addFunction('oxRecommList', 'getRecommListsByIds', '{ return "testRecomm"; }');

        $oObj = $this->getProxyClass( "alist" );
        $oArticle = oxNew("oxarticle");
        $oArticleList = $this->getProxyClass( "oxarticlelist");
        $oArticleList->setNonPublicVar( "_aArray", array ( '2000' => $oArticle) );
        $oObj->setNonPublicVar( "_aArticleList", $oArticleList );

        $this->assertEquals( "testRecomm", $oObj->getSimilarRecommLists() );
    }

    /**
     * Test oxViewConfig::getShowListmania() affection
     *
     * @return null
     */
    public function testgetSimilarRecommListsIfOff()
    {
        $oCfg = $this->getMock( "stdClass", array( "getShowListmania" ) );
        $oCfg->expects( $this->once() )->method( 'getShowListmania')->will($this->returnValue( false ) );

        $oRecomm = $this->getMock( "alist", array( "getViewConfig", 'getArticleList' ) );
        $oRecomm->expects( $this->once() )->method( 'getViewConfig')->will($this->returnValue( $oCfg ) );
        $oRecomm->expects( $this->never() )->method( 'getArticleList');

        $this->assertSame(false, $oRecomm->getSimilarRecommLists());
    }

    /**
     * Test get list page navigation.
     *
     * @return null
     */
    public function testGetPageNavigation()
    {
        $oObj = $this->getMock( 'alist', array( 'generatePageNavigation' ));
        $oObj->expects( $this->any() )->method( 'generatePageNavigation')->will($this->returnValue( "aaa" ) );
        $this->assertEquals( 'aaa', $oObj->getPageNavigation() );
    }

    /**
     * Test get article list.
     *
     * @return null
     */
    public function testGetArticleList()
    {
        $sCatId = '30e44ab83b6e585c9.63147165';
        $iExptCount = 4;
            $sCatId = '8a142c3e49b5a80c1.23676990';
            $iExptCount = 10;

        $oObj = $this->getProxyClass( "alist" );
        modConfig::setParameter( 'cnid', $sCatId );
        modConfig::getInstance()->setConfigParam( 'iNrofCatArticles', 10 );
        $oObj->render();

            $this->assertEquals( $iExptCount, $oObj->getArticleList()->count() );
    }

    /**
     * Test get categoty path.
     *
     * @return null
     */
    public function testGetCatTreePath()
    {
        $oCatTree = $this->getMock( 'oxcategorylist', array( 'getPath' ));
        $oCatTree->expects( $this->any() )->method( 'getPath')->will($this->returnValue( "aaa" ) );
        $oObj = $this->getProxyClass( "alist" );
        $oObj->setCategoryTree( $oCatTree );
        $this->assertEquals( 'aaa', $oObj->getCatTreePath() );
    }

    /**
     * Test get template location.
     *
     * @return null
     */
    public function testGetTemplateLocation()
    {
        $oCatTree = $this->getMock( 'oxcategorylist', array( 'getHtmlPath' ));
        $oCatTree->expects( $this->any() )->method( 'getHtmlPath')->will($this->returnValue( "aaa" ) );
        $oObj = $this->getProxyClass( "alist" );
        $oObj->setCategoryTree( $oCatTree );
        $this->assertEquals( 'aaa', $oObj->getTemplateLocation() );
    }

    /**
     * Test if active category has visible subcategories.
     *
     * @return null
     */
    public function testHasVisibleSubCats()
    {
        $oCat = $this->getMock( 'oxcategory', array( 'getHasVisibleSubCats' ));
        $oCat->expects( $this->any() )->method( 'getHasVisibleSubCats')->will($this->returnValue( true ) );
        $oObj = $this->getProxyClass( "alist" );
        $oObj->setNonPublicVar( "_oClickCat", $oCat );
        $this->assertTrue( $oObj->hasVisibleSubCats() );
    }

    /**
     * Test if subcategory list of active category.
     *
     * @return null
     */
    public function testGetSubCatList()
    {
        $oCat = $this->getMock( 'oxcategory', array( 'getSubCats' ));
        $oCat->expects( $this->any() )->method( 'getSubCats')->will($this->returnValue( 'aaa' ) );
        $oObj = $this->getProxyClass( "alist" );
        $oObj->setNonPublicVar( "_oClickCat", $oCat );
        $this->assertEquals( 'aaa', $oObj->getSubCatList() );
    }

    /**
     * Test get list title.
     *
     * @return null
     */
    public function testGetTitle()
    {
        $sCatId = '30e44ab83b6e585c9.63147165';
        $iExptName = 'Wohnen';
            $sCatId = '8a142c3e49b5a80c1.23676990';
            $iExptName = 'Bar-Equipment';

        $oCat = new oxcategory();
        $oCat->load( $sCatId );

        $oListView = $this->getMock( "alist", array( 'getActCategory' ) );
        $oListView->expects( $this->any() )->method( 'getActCategory')->will($this->returnValue( $oCat ) );

        $this->assertEquals( $iExptName, $oListView->getTitle() );

    }

    /**
     * Test get top5 article list.
     *
     * @return null
     */
    public function testGetTop5ArticleList()
    {
        $oObj = $this->getProxyClass( "alist" );
        $oObj->setNonPublicVar( "_blIsCat", true );

        $aList = $oObj->getTop5ArticleList();
            $this->assertEquals(4, $aList->count());
    }

    /**
     * Test get bargain article list.
     *
     * @return null
     */
    public function testGetBargainArticleList()
    {
        $oObj = $this->getProxyClass( "alist" );
        $oObj->setNonPublicVar( "_blIsCat", true );

        $aList = $oObj->getBargainArticleList();
            $this->assertEquals(4, $aList->count());
    }

    /**
     * Test meta keywords getter.
     *
     * @return null
     */
    public function testMetaKeywordsGetter()
    {


            $sCatId = '8a142c3e44ea4e714.31136811';

        $oSubj = $this->getMock( 'alist', array( '_prepareMetaKeyword' ) );
        $oSubj->expects( $this->any() )->method( '_prepareMetaKeyword')->will($this->returnValue( "aaa" ) );

        $oSubj->setCategoryId($sCatId);
        $oSubj->render();

        $oSubj->render();
        $sMetaKeywords = $oSubj->getMetaKeywords();
        $this->assertEquals( "aaa", $sMetaKeywords );
    }

    /**
     * Test meta keywords set to view data.
     *
     * @return null
     */
    public function testViewMetaKeywords()
    {

            $sCatId = '8a142c3e44ea4e714.31136811';

        $oSubj = $this->getMock( 'alist', array( '_prepareMetaKeyword' ) );
        $oSubj->expects( $this->any() )->method( '_prepareMetaKeyword')->will($this->returnValue( "aaa" ) );

        $oSubj->setCategoryId($sCatId);
        $oSubj->render();

        $oSubj->render();
        $sMetaKeywords = $oSubj->getMetaKeywords();

        $aViewData = $oSubj->getViewData();
        $sViewMetaKeywords = $aViewData['meta_keywords'];
        $this->assertEquals( "aaa", $sViewMetaKeywords );
    }

    /**
     * Test get active category getter.
     *
     * @return null
     */
    public function testGetActiveCategory()
    {
        $oSubj = $this->getMock( 'alist', array( 'getActCategory' ));
        $oSubj->expects( $this->any() )->method( 'getActCategory')->will($this->returnValue( "aaa" ) );
        $this->assertEquals( 'aaa', $oSubj->getActiveCategory() );
    }

}
