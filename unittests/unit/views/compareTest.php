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
 * @version   SVN: $Id: compareTest.php 26841 2010-03-25 13:58:15Z arvydas $
 */

require_once realpath( "." ).'/unit/OxidTestCase.php';
require_once realpath( "." ).'/unit/test_config.inc.php';

/**
 * Tests for compate class
 */
class Unit_Views_compareTest extends OxidTestCase
{
    /**
     * Initialize the fixture.
     *
     * @return null
     */
    protected function setUp()
    {
        parent::setUp();
        $myDB = oxDb::getDB();
        $sShopId = oxConfig::getInstance()->getShopId();
        // adding article to recommendlist
        $sQ = 'insert into oxrecommlists ( oxid, oxuserid, oxtitle, oxdesc, oxshopid ) values ( "testlist", "oxdefaultadmin", "oxtest", "oxtest", "'.$sShopId.'" ) ';
        $myDB->Execute( $sQ );
        $sQ = 'insert into oxobject2list ( oxid, oxobjectid, oxlistid, oxdesc ) values ( "testlist", "2000", "testlist", "test" ) ';
        $myDB->Execute( $sQ );
    }

    /**
     * Tear down the fixture.
     *
     * @return null
     */
    protected function tearDown()
    {
        $myDB = oxDb::getDB();
        $sDelete = 'delete from oxrecommlists where oxid like "testlist%" ';
        $myDB->execute( $sDelete );

        $sDelete = 'delete from oxobject2list where oxlistid like "testlist%" ';
        $myDB->execute( $sDelete );

        $this->cleanUpTable( 'oxreviews' );
        parent::tearDown();
    }

    /**
     * compare::moveLeft() test case
     *
     * @return null
     */
    public function testMoveLeft()
    {
        modConfig::setParameter( 'aid', "testId2" );
        $aItems  = array( "testId1" => "testVal1", "testId2" => "testVal2", "testId3" => "testVal3" );
        $aResult = array( "testId1" => true, "testId2" => true, "testId3" => true );

        $oView = $this->getMock( "compare", array( "getCompareItems", "setCompareItems" ) );
        $oView->expects( $this->once() )->method( 'getCompareItems')->will( $this->returnValue( $aItems ) );
        $oView->expects( $this->once() )->method( 'setCompareItems')->with( $this->equalTo( $aResult ) );
        $oView->moveLeft();
    }

    /**
     * compare::moveRight() test case
     *
     * @return null
     */
    public function testMoveRight()
    {
        modConfig::setParameter( 'aid', "testId2" );
        $aItems  = array( "testId1" => "testVal1", "testId2" => "testVal2", "testId3" => "testVal3" );
        $aResult = array( "testId1" => true, "testId2" => true, "testId3" => true );

        $oView = $this->getMock( "compare", array( "getCompareItems", "setCompareItems" ) );
        $oView->expects( $this->once() )->method( 'getCompareItems')->will( $this->returnValue( $aItems ) );
        $oView->expects( $this->once() )->method( 'setCompareItems')->with( $this->equalTo( $aResult ) );
        $oView->moveRight();
    }

    /**
     * compare::render() test case
     *
     * @return null
     */
    public function testRender()
    {
        $oView = $this->getMock( "compare", array( "getCompareItemsCnt", "getCompArtList", "getAttributeList", "getPageNavigation", "getActPage", "getSimilarRecommLists", "getOrderCnt", "_loadActions" ) );
        $oView->expects( $this->once() )->method( 'getCompareItemsCnt')->will( $this->returnValue( "getCompareItemsCnt" ) );
        $oView->expects( $this->atLeastOnce() )->method( 'getCompArtList')->will( $this->returnValue( "getCompArtList" ) );
        $oView->expects( $this->once() )->method( 'getAttributeList')->will( $this->returnValue( "getAttributeList" ) );
        $oView->expects( $this->once() )->method( 'getPageNavigation')->will( $this->returnValue( "getPageNavigation" ) );
        $oView->expects( $this->once() )->method( 'getActPage')->will( $this->returnValue( "getActPage" ) );
        $oView->expects( $this->once() )->method( 'getSimilarRecommLists')->will( $this->returnValue( "getSimilarRecommLists" ) );
        $oView->expects( $this->once() )->method( 'getOrderCnt')->will( $this->returnValue( "getOrderCnt" ) );
        $oView->expects( $this->once() )->method( '_loadActions');

        $this->assertEquals( "compare.tpl", $oView->render() );
        $aViewData = $oView->getViewData();
        $this->assertEquals( "getCompareItemsCnt", $aViewData["oxcmp_compare"] );
        $this->assertEquals( "getCompArtList", $aViewData["articlelist"] );
        $this->assertEquals( "getAttributeList", $aViewData["allartattr"] );
        $this->assertEquals( "getPageNavigation", $aViewData["pageNavigation"] );
        $this->assertEquals( "getActPage", $aViewData["pgNr"] );
        $this->assertEquals( "getSimilarRecommLists", $aViewData["similarrecommlist"] );
        $this->assertEquals( "getOrderCnt", $aViewData["iordersmade"] );
    }

    /**
     * compare::render() & compare::inPopup() test case
     *
     * @return null
     */
    public function testRenderInPopup()
    {
        $oView = $this->getMock( "compare", array( "getCompareItemsCnt", "getCompArtList", "getAttributeList", "getPageNavigation", "getActPage", "getSimilarRecommLists", "getOrderCnt", "_loadActions" ) );
        $oView->expects( $this->once() )->method( 'getCompareItemsCnt')->will( $this->returnValue( "getCompareItemsCnt" ) );
        $oView->expects( $this->atLeastOnce() )->method( 'getCompArtList')->will( $this->returnValue( "getCompArtList" ) );
        $oView->expects( $this->once() )->method( 'getAttributeList')->will( $this->returnValue( "getAttributeList" ) );
        $oView->expects( $this->once() )->method( 'getPageNavigation')->will( $this->returnValue( "getPageNavigation" ) );
        $oView->expects( $this->once() )->method( 'getActPage')->will( $this->returnValue( "getActPage" ) );
        $oView->expects( $this->once() )->method( 'getSimilarRecommLists')->will( $this->returnValue( "getSimilarRecommLists" ) );
        $oView->expects( $this->once() )->method( 'getOrderCnt')->will( $this->returnValue( "getOrderCnt" ) );
        $oView->expects( $this->once() )->method( '_loadActions');

        $oView->inPopup();
        $this->assertEquals( "compare_popup.tpl", $oView->render() );
        $aViewData = $oView->getViewData();
        $this->assertEquals( "getCompareItemsCnt", $aViewData["oxcmp_compare"] );
        $this->assertEquals( "getCompArtList", $aViewData["articlelist"] );
        $this->assertEquals( "getAttributeList", $aViewData["allartattr"] );
        $this->assertEquals( "getPageNavigation", $aViewData["pageNavigation"] );
        $this->assertEquals( "getActPage", $aViewData["pgNr"] );
        $this->assertEquals( "getSimilarRecommLists", $aViewData["similarrecommlist"] );
        $this->assertEquals( "getOrderCnt", $aViewData["iordersmade"] );
    }

    /**
     * compare::getOrderCnt() test case
     *
     * @return null
     */
    public function testGetOrderCnt()
    {
        $oUser = $this->getMock( "oxuser", array( "getOrderCount" ) );
        $oUser->expects( $this->once() )->method( 'getOrderCount')->will( $this->returnValue( 999 ) );

        $oView = $this->getMock( "compare", array( "getUser" ) );
        $oView->expects( $this->once() )->method( 'getUser')->will( $this->returnValue( $oUser ) );

        $this->assertEquals( 999, $oView->getOrderCnt() );
    }

    public function testSetCompareItemsgetCompareItems()
    {
        modConfig::setParameter( 'aFiltcompproducts', array( "testItems1" ) );
        $oView = new compare();
        $this->assertEquals( array( "testItems1" ), $oView->getCompareItems() );

        $oView = new compare();
        $oView->setCompareItems( array( "testItems2" ) );
        $this->assertEquals( array( "testItems2" ), $oView->getCompareItems() );
        $this->assertEquals( array( "testItems2" ), oxSession::getVar( 'aFiltcompproducts' ) );
    }

    /**
     * Test get compare article list.
     *
     * @return null
     */
    public function testGetCompArtList()
    {
        $oCompare = $this->getProxyClass( "compare" );
        $oArticle = oxNew("oxarticle");
        $oArticle->load('1672');
        $oCompare->setNonPublicVar( "_aCompItems", array ( '1672' => $oArticle) );
        $aArtList = $oCompare->getCompArtList();
        $this->assertEquals(  array('1672'), array_keys($aArtList));
    }

    /**
     * Test get compare article count.
     *
     * @return null
     */
    public function testGetCompareItemsCnt()
    {
        $oCompare = $this->getProxyClass( "compare" );
        $oArticle = oxNew("oxarticle");
        $oCompare->setNonPublicVar( "_aCompItems", array ( '1672' => $oArticle, '2000' => $oArticle) );
        $this->assertEquals(  2, $oCompare->getCompareItemsCnt());
    }

    /**
     * Test get attribute list.
     *
     * @return null
     */
    public function testGetAttributeList()
    {
        $oCompare = $this->getProxyClass( "compare" );
        $oArticle = oxNew("oxarticle");
        $oCompare->setNonPublicVar( "_oArtList", array ( '1672' => $oArticle) );
        $aAttributes = $oCompare->getAttributeList();

        $sSelect = "select oxattrid, oxvalue from oxobject2attribute where oxobjectid = '1672'";
        $rs = oxDb::getDB()->execute($sSelect);
        $sSelect = "select oxtitle from oxattribute where oxid = '".$rs->fields[0]."'";
        $sTitle = oxDb::getDB()->getOne($sSelect);
        $this->assertEquals( $rs->fields[1], $aAttributes[$rs->fields[0]]->aProd['1672']->value);
        $this->assertEquals( $sTitle, $aAttributes[$rs->fields[0]]->title);
    }

    /**
     * Test get similar recommendation lists.
     *
     * @return null
     */
    public function testGetSimilarRecommLists()
    {
        modConfig::setParameter( 'recommid', 'testlist' );
        $oCompare = $this->getProxyClass( "compare" );
        $oArticle = oxNew("oxarticle");
        $oCompare->setNonPublicVar( "_oArtList", array ( '2000' => $oArticle) );
        $aLists = $oCompare->getSimilarRecommLists();
        $this->assertTrue( $aLists instanceof oxList );
        $this->assertEquals( 1, $aLists->count() );
        $this->assertEquals( 'testlist', $aLists['testlist']->getId() );
        $this->assertTrue( in_array( $aLists['testlist']->getFirstArticle()->getId(), array('2000') ) );
    }

    /**
     * Test get page navigation.
     *
     * @return null
     */
    public function testGetPageNavigation()
    {
        $oCompare = $this->getMock( 'compare', array( 'generatePageNavigation' ));
        $oCompare->expects( $this->any() )->method( 'generatePageNavigation')->will($this->returnValue( "aaa" ) );
        $this->assertEquals( 'aaa', $oCompare->getPageNavigation() );
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

        $oRecomm = $this->getMock( "compare", array( "getViewConfig", 'getArticleList' ) );
        $oRecomm->expects( $this->once() )->method( 'getViewConfig')->will($this->returnValue( $oCfg ) );
        $oRecomm->expects( $this->never() )->method( 'getArticleList');

        $this->assertSame(false, $oRecomm->getSimilarRecommLists());
    }
}
