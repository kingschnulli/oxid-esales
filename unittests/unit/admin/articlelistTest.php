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
 * @version   SVN: $Id: articlelistTest.php 38778 2011-09-15 13:39:47Z arvydas.vapsva $
 */

require_once realpath( "." ).'/unit/OxidTestCase.php';
require_once realpath( "." ).'/unit/test_config.inc.php';

/**
 * Tests for Article_List class
 */
class Unit_Admin_ArticleListTest extends OxidTestCase
{
    /**
     * Test building sql where with specified "folder" param
     *  for oxarticles, oxorder, oxcontents tables
     *
     * @return null
     */
    public function testBuildWhereWithSpecifiedFolderParam()
    {
        $sObjects = 'oxArticle';

        modConfig::setParameter( 'folder', $sObjects.'TestFolderName' );

        $oAdminList = $this->getMock( 'article_list', array( "getItemList" ) );
        $oAdminList->expects( $this->once() )->method( 'getItemList' )->will( $this->returnValue( null ) );
        $aBuildWhere = $oAdminList->buildWhere();
        $this->assertEquals( 'oxArticleTestFolderName', $aBuildWhere[getViewName('oxarticles').'.oxfolder'] );
    }

    /**
     * Article_List::Render() test case
     *
     * @return null
     */
    public function testRenderSelectingProductCategory()
    {
        modConfig::getInstance()->setParameter( "where", array( "oxarticles" => array( "oxtitle" => "testValue" ) ) );

        $sCatId = oxDb::getDb()->getOne( "select oxid from oxcategories" );
        modConfig::setParameter( "art_category", "cat@@".$sCatId );
        // testing..
        $oView = new Article_List();
        $this->assertEquals( 'article_list.tpl', $oView->render() );

        // testing view data
        $aViewData = $oView->getViewData();
        $this->assertTrue( $aViewData["cattree"] instanceof oxCategoryList );
        $this->assertTrue( $aViewData["cattree"]->offsetExists( $sCatId ) );
        $this->assertEquals( 1, $aViewData["cattree"]->offsetGet( $sCatId )->selected );
        $this->assertTrue( $aViewData["mnftree"] instanceof oxManufacturerList );
        $this->assertTrue( $aViewData["vndtree"] instanceof oxVendorList );
        $this->assertTrue( isset( $aViewData["pwrsearchinput"] ) );
        $this->assertEquals( "testValue", $aViewData["pwrsearchinput"] );
    }

    /**
     * Article_List::Render() test case
     *
     * @return null
     */
    public function testRenderSelectingProductManufacturer()
    {
        $sManId = oxDb::getDb()->getOne( "select oxid from oxmanufacturers" );
        modConfig::setParameter( "art_category", "mnf@@".$sManId );

        // testing..
        $oView = $this->getMock( "Article_List", array( "getItemList" ) );
        $oView->expects( $this->any() )->method( 'getItemList' )->will( $this->returnValue( new oxarticlelist ) );
        $this->assertEquals( 'article_list.tpl', $oView->render() );

        // testing view data
        $aViewData = $oView->getViewData();
        $this->assertTrue( $aViewData["cattree"] instanceof oxCategoryList );
        $this->assertTrue( $aViewData["mnftree"] instanceof oxManufacturerList );
        $this->assertTrue( $aViewData["mnftree"]->offsetExists( $sManId ) );
        $this->assertEquals( 1, $aViewData["mnftree"]->offsetGet( $sManId )->selected );
        $this->assertTrue( $aViewData["vndtree"] instanceof oxVendorList );
    }

    /**
     * Article_List::Render() test case
     *
     * @return null
     */
    public function testRenderSelectingProductVendor()
    {
        $sVndId = oxDb::getDb()->getOne( "select oxid from oxvendor" );
        modConfig::setParameter( "art_category", "vnd@@".$sVndId );
        modConfig::getInstance()->setConfigParam( "blSkipFormatConversion", false );

        $oArticle1 = new oxArticle();
        $oArticle1->oxarticles__oxtitle = new oxField( "title1" );
        $oArticle1->oxarticles__oxtitle->fldtype = "datetime";

        $oArticle2 = new oxArticle();
        $oArticle2->oxarticles__oxtitle = new oxField( "title2" );
        $oArticle2->oxarticles__oxtitle->fldtype = "timestamp";

        $oArticle3 = new oxArticle();
        $oArticle3->oxarticles__oxtitle = new oxField( "title3" );
        $oArticle3->oxarticles__oxtitle->fldtype = "date";

        $oList = new oxList();
        $oList->offsetSet( "1", $oArticle1 );
        $oList->offsetSet( "2", $oArticle2 );
        $oList->offsetSet( "3", $oArticle3 );

        // testing..
        $oView = $this->getMock( "Article_List", array( "getItemList" ) );
        $oView->expects( $this->any() )->method( 'getItemList' )->will( $this->returnValue( $oList ) );
        $this->assertEquals( 'article_list.tpl', $oView->render() );

        // testing view data
        $aViewData = $oView->getViewData();
        $this->assertTrue( $aViewData["cattree"] instanceof oxCategoryList );
        $this->assertTrue( $aViewData["mnftree"] instanceof oxManufacturerList );
        $this->assertTrue( $aViewData["vndtree"] instanceof oxVendorList );
        $this->assertTrue( $aViewData["vndtree"]->offsetExists( $sVndId ) );
        $this->assertEquals( 1, $aViewData["vndtree"]->offsetGet( $sVndId )->selected );
    }

    /**
     * Article_List::_buildSelectString() test case
     *
     * @return null
     */
    public function testBuildSelectStringCategory()
    {
        $sTable   = getViewName( "oxarticles" );
        $sO2CView = getViewName( "oxobject2category" );
        modConfig::setParameter( "art_category", "cat@@testCategory" );

        $oProduct = new oxArticle();
        $sQ = $oProduct->buildSelectString( null );
        $sQ = str_replace( " from $sTable where 1 ", " from $sTable left join $sO2CView on $sTable.oxid = $sO2CView.oxobjectid where $sO2CView.oxcatnid = 'testCategory' and  1  and $sTable.oxparentid = '' ", $sQ );

        $oView = new Article_List();
        $this->assertEquals( $sQ , $oView->UNITbuildSelectString( $oProduct ) );
    }

    /**
     * Article_List::_buildSelectString() test case
     *
     * @return null
     */
    public function testBuildSelectStringManufacturer()
    {
        $sTable   = getViewName( "oxarticles" );
        modConfig::setParameter( "art_category", "mnf@@testManufacturer" );

        $oProduct = new oxArticle();
        $sQ = $oProduct->buildSelectString( null );

        $oView = new Article_List();
        $this->assertEquals( $sQ . " and $sTable.oxparentid = ''  and $sTable.oxmanufacturerid = 'testManufacturer'", $oView->UNITbuildSelectString( $oProduct ) );
    }

    /**
     * Article_List::_buildSelectString() test case
     *
     * @return null
     */
    public function testBuildSelectStringVendor()
    {
        $sTable   = getViewName( "oxarticles" );
        modConfig::setParameter( "art_category", "vnd@@testVendor" );

        $oProduct = new oxArticle();
        $sQ = $oProduct->buildSelectString( null );

        $oView = new Article_List();
        $this->assertEquals( $sQ . " and $sTable.oxparentid = ''  and $sTable.oxvendorid = 'testVendor'", $oView->UNITbuildSelectString( $oProduct ) );
    }

    /**
     * Article_List::BuildWhere() test case
     *
     * @return null
     */
    public function testBuildWhere()
    {
        modConfig::setParameter( "folder", "testFolder" );
        $sViewName = getViewName( 'oxarticles' );

        $oView = new Article_List();
        $this->assertEquals( array( "$sViewName.oxfolder" => "testFolder" ), $oView->buildWhere() );
    }

    /**
     * Article_List::_buildSelectString() test case
     *
     * @return null
     */
    public function testBuildSelectString()
    {
        $oProduct = new oxArticle();
        $sQ = $oProduct->buildSelectString( null );

        $oView = new Article_List();
        $this->assertEquals( $sQ . " and ".getViewName( 'oxarticles' ).".oxparentid = '' ", $oView->UNITbuildSelectString( $oProduct ) );
    }

    /**
     * Article_List::DeleteEntry() test case
     *
     * @return null
     */
    public function testDeleteEntry()
    {
        oxTestModules::addFunction("oxUtilsServer", "getOxCookie", "{return array(1);}");
        oxTestModules::addFunction("oxUtils", "checkAccessRights", "{return true;}");
        oxTestModules::addFunction( 'oxarticle', 'load', '{ return true; }' );
        oxTestModules::addFunction( 'oxarticle', 'delete', '{ return true; }' );

        modConfig::setParameter( "oxid", "testId" );

        $oSess = $this->getMock('oxsession', array('checkSessionChallenge'));
        $oSess->expects( $this->any() )->method('checkSessionChallenge')->will($this->returnValue(true));

        $oView = $this->getMock( "Article_List", array( "_authorize", 'getSession' ) );
        $oView->expects( $this->any() )->method( '_authorize' )->will( $this->returnValue( true ) );
        $oView->expects( $this->any() )->method( 'getSession' )->will( $this->returnValue( $oSess ) );
        $oView->deleteEntry();
    }


    /**
     * Test case for Article_List::getSearchFields()() getter
     *
     * @return null
     */
    public function testGetSearchFields()
    {
        $aSkipFields = array("oxblfixedprice", "oxvarselect", "oxamitemid", "oxamtaskid", "oxpixiexport", "oxpixiexported") ;
        $oView = new Article_List();

        $oArticle = new oxArticle();
        $this->assertEquals( array_diff( $oArticle->getFieldNames(), $aSkipFields ), $oView->getSearchFields() );
    }
}
