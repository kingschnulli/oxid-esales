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
 * @version   SVN: $Id: searchTest.php 44474 2012-04-27 12:26:32Z mindaugas.rimgaila $
 */

require_once realpath( "." ).'/unit/OxidTestCase.php';
require_once realpath( "." ).'/unit/test_config.inc.php';

class Unit_Views_searchTest extends OxidTestCase
{
    public function testIsEmptySearch()
    {
        oxTestModules::addFunction('oxUtilsServer', 'getServerVar', '{ if ( $aA[0] == "HTTP_HOST") { return "shop.com/"; } else { return "test.php";} }');

        $oSearch = $this->getProxyClass( 'search' );
        $oSearch->init();

        $this->assertTrue( $oSearch->isEmptySearch() );
    }

    /**
     * search::_processListArticles() when seo is off
     *
     * @return null
     */
    public function testProcessListArticlesSeoOff()
    {
        oxTestModules::addFunction('oxUtils', 'seoIsActive', '{ return false; }');

        $oArticle = $this->getMock( 'oxarticle', array( "appendStdLink", "appendLink" ) );
        $oArticle->expects( $this->once() )->method( 'appendStdLink')->with( $this->equalto( 'testStdParams' ) );
        $oArticle->expects( $this->once() )->method( 'appendLink')->with( $this->equalto( 'testStdParams' ) );
        $aArticleList[] = $oArticle;

        $oArticle = $this->getMock( 'oxarticle', array( "appendStdLink", "appendLink" ) );
        $oArticle->expects( $this->once() )->method( 'appendStdLink')->with( $this->equalto( 'testStdParams' ) );
        $oArticle->expects( $this->once() )->method( 'appendLink')->with( $this->equalto( 'testStdParams' ) );
        $aArticleList[] = $oArticle;

        $oSearchView = $this->getMock( 'search', array( 'getArticleList', "getAddUrlParams" ) );
        $oSearchView->expects( $this->once() )->method( 'getArticleList')->will( $this->returnValue( $aArticleList ) );
        $oSearchView->expects( $this->once() )->method( 'getAddUrlParams')->will( $this->returnValue( 'testStdParams' ) );

        $oSearchView->UNITprocessListArticles();
    }

    /**
     * search::_processListArticles() when seo is on
     *
     * @return null
     */
    public function testProcessListArticlesSeoOn()
    {
        oxTestModules::addFunction('oxUtils', 'seoIsActive', '{ return true; }');

        $oArticle = $this->getMock( 'oxarticle', array( "appendStdLink", "appendLink" ) );
        $oArticle->expects( $this->never() )->method( 'appendStdLink');
        $oArticle->expects( $this->once() )->method( 'appendLink')->with( $this->equalto( 'testStdParams' ) );
        $aArticleList[] = $oArticle;

        $oArticle = $this->getMock( 'oxarticle', array( "appendStdLink", "appendLink" ) );
        $oArticle->expects( $this->never() )->method( 'appendStdLink');
        $oArticle->expects( $this->once() )->method( 'appendLink')->with( $this->equalto( 'testStdParams' ) );
        $aArticleList[] = $oArticle;

        $oSearchView = $this->getMock( 'search', array( 'getArticleList', "getAddUrlParams" ) );
        $oSearchView->expects( $this->once() )->method( 'getArticleList')->will( $this->returnValue( $aArticleList ) );
        $oSearchView->expects( $this->once() )->method( 'getAddUrlParams')->will( $this->returnValue( 'testStdParams' ) );

        $oSearchView->UNITprocessListArticles();
    }

    public function testGetArticleList()
    {
        oxTestModules::addFunction('oxUtilsServer', 'getServerVar', '{ if ( $aA[0] == "HTTP_HOST") { return "shop.com/"; } else { return "test.php";} }');

        $oSearch = $this->getProxyClass( 'search' );
        modConfig::setParameter( 'searchparam', 'bar' );
        $oSearch->init();

            $this->assertEquals( 8, $oSearch->getArticleList()->count() );
    }

    public function testGetSimilarRecommLists()
    {
        oxTestModules::addFunction('oxUtilsServer', 'getServerVar', '{ if ( $aA[0] == "HTTP_HOST") { return "shop.com/"; } else { return "test.php";} }');
        oxTestModules::addFunction('oxRecommList', 'getRecommListsByIds', '{ return "testRecomm"; }');

        $oSearch = $this->getProxyClass( 'search' );
        modConfig::setParameter( 'searchparam', 'bar' );
        $oSearch->init();

        $this->assertEquals( "testRecomm", $oSearch->getSimilarRecommLists() );
    }

    public function testGetSearchParamForHtml()
    {
        $oSearch = $this->getProxyClass( 'search' );
        $oSearch->setNonPublicVar( "_blSearchClass", true );
        modConfig::setParameter( 'searchparam', '�  a' );

        $this->assertEquals( '�  a', $oSearch->getSearchParamForHtml() );
    }

    public function testGetSearchParam()
    {
        $oSearch = $this->getProxyClass( 'search' );
        $oSearch->setNonPublicVar( "_blSearchClass", true );
        modConfig::setParameter( 'searchparam', '�  a' );

        $this->assertEquals( '%FC%20%20a', $oSearch->getSearchParam() );
    }

    public function testGetSearchCatId()
    {
        $oSearch = $this->getProxyClass( 'search' );
        $oSearch->setNonPublicVar( "_blSearchClass", true );
        modConfig::setParameter( 'searchcnid', 'test' );

        $this->assertEquals( 'test', $oSearch->getSearchCatId() );
    }

    public function testGetSearchVendor()
    {
        $oSearch = $this->getProxyClass( 'search' );
        $oSearch->setNonPublicVar( "_blSearchClass", true );
        modConfig::setParameter( 'searchvendor', 'test' );

        $this->assertEquals( 'test', $oSearch->getSearchVendor() );
    }

    public function testGetPageNavigation()
    {
        $oSearch = $this->getMock( 'search', array( 'generatePageNavigation' ));
        $oSearch->expects( $this->any() )->method( 'generatePageNavigation')->will($this->returnValue( "aaa" ) );
        $this->assertEquals( 'aaa', $oSearch->getPageNavigation() );
    }

    public function testGetActiveCategory()
    {
        $oSearch = $this->getMock( 'search', array( 'getActSearch' ));
        $oSearch->expects( $this->any() )->method( 'getActSearch')->will($this->returnValue( "aaa" ) );
        $this->assertEquals( 'aaa', $oSearch->getActiveCategory() );
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

        $oSearch = $this->getMock( "search", array( "getViewConfig", 'getArticleList' ) );
        $oSearch->expects( $this->once() )->method( 'getViewConfig')->will($this->returnValue( $oCfg ) );
        $oSearch->expects( $this->never() )->method( 'getArticleList');

        $this->assertSame(false, $oSearch->getSimilarRecommLists());
    }

    public function testRender()
    {
        modConfig::getInstance()->setConfigParam('bl_rssSearch', false);
        $n = $this->getMock('search', array(
            '_processListArticles'
            )
        );
        $n->expects($this->once())->method('_processListArticles');

        $this->assertEquals('page/search/search.tpl', $n->render());
    }

    public function testRenderRss()
    {
        $oRss = $this->getMock('oxrssfeed', array('getSearchArticlesTitle', 'getSearchArticlesUrl'));
        $oRss->expects($this->once())->method('getSearchArticlesTitle')
                ->with(
                    $this->equalTo('ysearchparam'),
                    $this->equalTo('ysearchcnid'),
                    $this->equalTo('ysearchvendor'),
                    $this->equalTo('ysearchmanufacturer')
                )->will($this->returnValue('rss1title'));
        $oRss->expects($this->once())->method('getSearchArticlesUrl')
                ->with(
                    $this->equalTo('ysearchparam'),
                    $this->equalTo('ysearchcnid'),
                    $this->equalTo('ysearchvendor'),
                    $this->equalTo('ysearchmanufacturer')
                )->will($this->returnValue('rss1url'));
        oxTestModules::addModuleObject('oxrssfeed', $oRss);

        modConfig::getInstance()->setConfigParam('bl_rssSearch', 1);
        modConfig::setParameter('searchparam', 'ysearchparam');
        modConfig::setParameter('searchcnid', 'ysearchcnid');
        modConfig::setParameter('searchvendor', 'ysearchvendor');
        modConfig::setParameter('searchmanufacturer', 'ysearchmanufacturer');

        $n = $this->getMock('search', array(
            '_processListArticles',
            'addRssFeed'
            )
        );
        $n->expects($this->once())->method('_processListArticles');
        $n->expects($this->once())->method('addRssFeed')->with($this->equalTo('rss1title'), $this->equalTo('rss1url'), $this->equalTo('searchArticles'));

        $this->assertEquals('page/search/search.tpl', $n->render());
    }

    public function testGetAddUrlParams()
    {
        modConfig::setParameter('searchparam', 'ysearchparam');
        modConfig::setParameter('searchcnid', 'ysearchcnid');
        modConfig::setParameter('searchvendor', 'ysearchvendor');
        modConfig::setParameter('searchmanufacturer', 'ysearchmanufacturer');
        $this->assertEquals('listtype=search&amp;searchparam=ysearchparam&amp;searchcnid=ysearchcnid&amp;searchvendor=ysearchvendor&amp;searchmanufacturer=ysearchmanufacturer', oxNew('search')->getAddUrlParams());
    }

    public function testIsSearchClass()
    {
        modConfig::setParameter('cl', 'ysearchcnid');
        $this->assertEquals(false, oxNew('search')->UNITisSearchClass());
        modConfig::setParameter('cl', 'search');
        $this->assertEquals(true, oxNew('search')->UNITisSearchClass());

    }

    public function testGetSearchManufacturer()
    {
        $oSearch = $this->getMock( "search", array( "_isSearchClass" ) );
        $oSearch->expects( $this->once() )->method( '_isSearchClass')->will($this->returnValue( true ) );
        modConfig::setParameter('searchmanufacturer', 'gsearchmanufacturer&');
        $this->assertSame('gsearchmanufacturer&amp;', $oSearch->getSearchManufacturer());
    }

    public function testGetSearchManufacturerNotInSearch()
    {
        $oSearch = $this->getMock( "search", array( "_isSearchClass" ) );
        $oSearch->expects( $this->once() )->method( '_isSearchClass')->will($this->returnValue( false ) );
        modConfig::setParameter('searchmanufacturer', 'gsearchmanufacturer&');
        $this->assertSame(false, $oSearch->getSearchManufacturer());
    }

    public function testGetBreadCrumb()
    {
        $oSearch = new Search();

        $this->assertEquals(1, count($oSearch->getBreadCrumb()));
    }

    /**
     * Test can display type selector getter
     *
     * @return null
     */
    public function testCanSelectDisplayType()
    {
        $oConfig = $this->getMock( 'oxConfig', array( 'getConfigParam' ));
        $oConfig->expects( $this->once() )->method( 'getConfigParam' )->will( $this->returnValue( true ) );

        $oSubj = $this->getMock( 'alist', array( 'getConfig' ));
        $oSubj->expects( $this->once() )->method( 'getConfig' )->will( $this->returnValue( $oConfig ) );

        $this->assertEquals( true, $oSubj->canSelectDisplayType() );
    }


    public function testCanRedirect()
    {
        $oSearch = new search();
        $this->assertFalse($oSearch->UNITcanRedirect());
   }
}
