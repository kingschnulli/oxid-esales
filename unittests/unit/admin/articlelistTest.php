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
 * @version   SVN: $Id: articlelistTest.php 27094 2010-04-08 07:34:16Z arvydas $
 */

require_once realpath( "." ).'/unit/OxidTestCase.php';
require_once realpath( "." ).'/unit/test_config.inc.php';

/**
 * Tests for Article_List class
 */
class Unit_Admin_ArticleListTest extends OxidTestCase
{
    /**
     * Article_List::Render() test case
     *
     * @return null
     */
    public function testRenderSelectingProductCategory()
    {
        $sCatId = oxDb::getDb()->getOne( "select oxid from oxcategories" );
        modConfig::setParameter( "art_category", "cat@@".$sCatId );

        $oWhere = new oxStdClass();
        $oWhere->oxarticles__OXTITLE = "testValue";

        // testing..
        $oView = new Article_List();
        $oView->addTplParam( "where", $oWhere );

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
     * Article_List::Changeselect() test case
     *
     * @return null
     */
    public function testChangeselectCategory()
    {
        $sTable   = getViewName( "oxarticles" );
        $sO2CView = getViewName( "oxobject2category" );
        modConfig::setParameter( "art_category", "cat@@testCategory" );

        $oView = new Article_List();
        $this->assertEquals( "from $sTable left join $sO2CView on $sTable.oxid = $sO2CView.oxobjectid where $sO2CView.oxcatnid = 'testCategory' and ", $oView->UNITchangeselect( "from {$sTable} where" ) );
    }

    /**
     * Article_List::Changeselect() test case
     *
     * @return null
     */
    public function testChangeselectManufacturer()
    {
        $sTable   = getViewName( "oxarticles" );
        modConfig::setParameter( "art_category", "mnf@@testManufacturer" );

        $oView = new Article_List();
        $this->assertEquals( " and $sTable.oxmanufacturerid = 'testManufacturer'", $oView->UNITchangeselect( "" ) );
    }

    /**
     * Article_List::Changeselect() test case
     *
     * @return null
     */
    public function testChangeselectVendor()
    {
        $sTable   = getViewName( "oxarticles" );
        modConfig::setParameter( "art_category", "vnd@@testVendor" );

        $oView = new Article_List();
        $this->assertEquals( " and $sTable.oxvendorid = 'testVendor'", $oView->UNITchangeselect( "" ) );
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
     * Article_List::PrepareWhereQuery() test case
     *
     * @return null
     */
    public function testPrepareWhereQuery()
    {
        $oView = new Article_List();
        $this->assertEquals( " and ".getViewName( 'oxarticles' ).".oxparentid = '' ", $oView->UNITprepareWhereQuery( array(), "" ) );
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


}
