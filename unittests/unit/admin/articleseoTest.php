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
 * @version   SVN: $Id: articleseoTest.php 26705 2010-03-20 13:20:46Z arvydas $
 */

require_once realpath( "." ).'/unit/OxidTestCase.php';
require_once realpath( "." ).'/unit/test_config.inc.php';

/**
 * Tests for Article_Seo class
 */
class Unit_Admin_ArticleSeoTest extends OxidTestCase
{
    /**
     * Sets up test
     *
     * @return null
     */
    protected function setUp()
    {
        parent::setUp();
        oxTestModules::addFunction( 'oxSeoEncoderArticle', 'cleanup', '{ self::$_instance = null; }');
    }

    /**
     * Tear down the fixture.
     *
     * @return null
     */
    protected function tearDown()
    {
        oxSeoEncoderArticle::getInstance()->cleanup();
        parent::tearDown();
    }

    /**
     * Article_Seo::Render() test case
     *
     * @return null
     */
    public function testRender()
    {
        oxTestModules::addFunction('oxarticle', 'isDerived', '{ return true; }');

        $oView = $this->getMock( "Article_Seo", array( "_getObject", "_getCategoryList", "_getVendorList", "_getManufacturerList", "_getTagList", "getSelectedCategoryId", "getActCategoryLang" ) );
        $oView->expects( $this->atLeastOnce() )->method( '_getObject' )->will( $this->returnValue( oxNew( "oxarticle" ) ));
        $oView->expects( $this->once() )->method( '_getCategoryList' );
        $oView->expects( $this->once() )->method( '_getVendorList' );
        $oView->expects( $this->once() )->method( '_getManufacturerList' );
        $oView->expects( $this->once() )->method( '_getTagList' );
        $oView->expects( $this->atLeastOnce() )->method( 'getSelectedCategoryId' );
        $oView->expects( $this->once() )->method( 'getActCategoryLang' );

        $this->assertEquals( "object_seo.tpl", $oView->render() );
    }

    /**
     * Article_Seo::_getSeoDataSql() test case (for tag)
     *
     * @return null
     */
    public function testGetSeoDataSqlForTag()
    {
        oxTestModules::addFunction( 'oxSeoEncoderArticle', 'getDynamicObjectId', '{ return "testDynObjectId"; }');
        modConfig::setParameter( "aSeoData", null );

        $iLang = 0;
        $iShopId = 1;
        $sObjectId = 'testObjectId';
        $oObject = $this->getMock( "OxStdClass", array( "getStdTagLink" ) );
        $oObject->expects( $this->once() )->method( 'getStdTagLink' );

        $sQ = "select * from oxseo where oxobjectid = 'testDynObjectId' and oxshopid = '{$iShopId}' and oxlang = $iLang";

        $oView = $this->getMock( "Article_Seo", array( "getActCategoryLang", "getTag", "_getCategoryList", "_getVendorList", "_getManufacturerList", "_getTagList" ) );
        $oView->expects( $this->once() )->method( 'getActCategoryLang' )->will( $this->returnValue( $iLang ) );
        $oView->expects( $this->once() )->method( 'getTag' );
        $oView->expects( $this->once() )->method( '_getCategoryList' )->will( $this->returnValue( false ));
        $oView->expects( $this->once() )->method( '_getVendorList' )->will( $this->returnValue( false ));
        $oView->expects( $this->once() )->method( '_getManufacturerList' )->will( $this->returnValue( false ));
        $oView->expects( $this->any() )->method( '_getTagList' )->will( $this->returnValue( array( 'testObjectId' => 'testObjectId' ) ) );

        $oView->getSelectedCategoryId();
        $this->assertEquals( $sQ, $oView->UNITgetSeoDataSql( $oObject, $iShopId, $iLang ) );
    }

    /**
     * Article_Seo::_getSeoDataSql() test case (regular)
     *
     * @return null
     */
    public function testGetSeoDataSql()
    {
        $iLang = 0;
        $iShopId = 1;
        $sObjectId = 'testObjectId';
        $oObject = $this->getMock( "OxStdClass", array( "getId" ) );
        $oObject->expects( $this->once() )->method( 'getId' )->will( $this->returnValue( "testObjectId" ) );

        $sQ = "select * from oxseo where oxobjectid = 'testObjectId' and
                   oxshopid = '{$iShopId}' and oxlang = {$iLang}  and oxparams = 'testCatId' ";

        $oView = $this->getMock( "Article_Seo", array( "getSelectedCategoryId" ) );
        $oView->expects( $this->once() )->method( 'getSelectedCategoryId' )->will( $this->returnValue( "testCatId" ) );
        $sRezQ = $oView->UNITgetSeoDataSql( $oObject, $iShopId, $iLang );

        $this->assertEquals( str_replace( array( "\t", "\n", "\r", " " ), "", $sQ ), str_replace( array( "\t", "\n", "\r", " " ), "", $sRezQ ) );
    }

    /**
     * Article_Seo::_setMainCategory() test case (regular)
     *
     * @return null
     */
    public function testSetMainCategory()
    {
        $oList = new oxList();
        $oProduct = $this->getMock( "oxarticle", array( "getCategory" ) );
        $oProduct->expects( $this->once() )->method( 'getCategory' )->will( $this->returnValue( false ) );

        $oView = new Article_Seo();
        $oView->UNITsetMainCategory( $oProduct, $oList );

        $oListItem = $oList->current();
        $this->assertEquals( 1, $oList->count() );
        $this->assertNotNull( $oListItem );
        $this->assertTrue( $oListItem instanceof oxCategory );
        $this->assertEquals( "__nonecatid", $oListItem->getId() );
    }

    /**
     * Article_Seo::_getVendorList() test case (regular)
     *
     * @return null
     */
    public function testGetVendorList()
    {
        oxTestModules::addFunction( 'oxvendor', 'loadInLang', '{ $this->setId( "testVendorId" ); return true; }');

        $oArticle = new oxArticle();
        $oArticle->oxarticles__oxvendorid = new oxField( "testVendorId" );

        $oView = new Article_Seo();
        $oList = $oView->UNITgetVendorList( $oArticle );

        $oListItem = $oList->current();
        $this->assertEquals( 1, $oList->count() );
        $this->assertNotNull( $oListItem );
        $this->assertTrue( $oListItem instanceof oxVendor );
        $this->assertEquals( "testVendorId", $oListItem->getId() );
    }

    /**
     * Article_Seo::_getManufacturerList() test case (regular)
     *
     * @return null
     */
    public function testGetManufacturerList()
    {
        oxTestModules::addFunction( 'oxmanufacturer', 'loadInLang', '{ $this->setId( "testManId" ); return true; }');

        $oArticle = new oxArticle();
        $oArticle->oxarticles__oxmanufacturerid = new oxField( "testManId" );

        $oView = new Article_Seo();
        $oList = $oView->UNITgetManufacturerList( $oArticle );

        $oListItem = $oList->current();
        $this->assertEquals( 1, $oList->count() );
        $this->assertNotNull( $oListItem );
        $this->assertTrue( $oListItem instanceof oxmanufacturer );
        $this->assertEquals( "testManId", $oListItem->getId() );
    }

    /**
     * Article_Seo::_getTagList() test case (regular)
     *
     * @return null
     */
    public function testGetTagList()
    {
        oxTestModules::addFunction( 'oxTagCloud', 'getTags', '{ return array( "tag1",  "tag2" ); }');

        $oArticle = $this->getMock( "oxArticle", array( 'getAvailableInLangs' ) );
        $oArticle->expects( $this->once() )->method( 'getAvailableInLangs' )->will( $this->returnValue( array( "1" => "de" ) ) );
        $oArticle->oxarticles__oxmanufacturerid = new oxField( "testManId" );

        $oView = new Article_Seo();
        $aList = $oView->UNITgetTagList( $oArticle );

        $this->assertEquals( 1, count( $aList ) );
        $this->assertEquals( array( 1 => array( "tag1",  "tag2" ) ), $aList );
    }

    /**
     * Article_Seo::getSelectedCategoryId() test case (regular)
     *
     * @return null
     */
    public function testGetSelectedCategoryIdFromPost()
    {
        modConfig::setParameter( "aSeoData", array( "oxparams" => '1#2#3#4#5#6' ) );

        $oView = new Article_Seo();
        $this->assertEquals( "2", $oView->getSelectedCategoryId() );
    }

    /**
     * Article_Seo::getSelectedCategoryId() test case (category)
     *
     * @return null
     */
    public function testGetSelectedCategoryIdCategory()
    {
        modConfig::setParameter( "aSeoData", null );

        $oProduct = new oxArticle();

        $oCategory = new oxCategory();
        $oCategory->setId( "testCatId" );

        $oList = new oxList();
        $oList->offsetSet( "testCatId", $oCategory );

        $oView = $this->getMock( "Article_Seo", array( "_getObject", "_getCategoryList" ) );
        $oView->expects( $this->once() )->method( '_getObject' )->will( $this->returnValue( $oProduct ) );
        $oView->expects( $this->once() )->method( '_getCategoryList' )->will( $this->returnValue( $oList ) );

        $this->assertEquals( "testCatId", $oView->getSelectedCategoryId() );
    }

    /**
     * Article_Seo::getSelectedCategoryId() test case (vendor)
     *
     * @return null
     */
    public function testGetSelectedCategoryIdVendor()
    {
        modConfig::setParameter( "aSeoData", null );

        $oProduct = new oxArticle();

        $oVendor = new oxVendor();
        $oVendor->setId( "testVndId" );

        $oList = new oxList();
        $oList->offsetSet( "testVndId", $oVendor );

        $oView = $this->getMock( "Article_Seo", array( "_getObject", "_getCategoryList", "_getVendorList" ) );
        $oView->expects( $this->once() )->method( '_getObject' )->will( $this->returnValue( $oProduct ) );
        $oView->expects( $this->once() )->method( '_getCategoryList' )->will( $this->returnValue( false ) );
        $oView->expects( $this->once() )->method( '_getVendorList' )->will( $this->returnValue( $oList ) );

        $this->assertEquals( "testVndId", $oView->getSelectedCategoryId() );
    }

    /**
     * Article_Seo::getSelectedCategoryId() test case (manufacturer)
     *
     * @return null
     */
    public function testGetSelectedCategoryIdManufacturer()
    {
        modConfig::setParameter( "aSeoData", null );

        $oProduct = new oxArticle();

        $oManufacturer = new oxManufacturer();
        $oManufacturer->setId( "testManId" );

        $oList = new oxList();
        $oList->offsetSet( "testManId", $oManufacturer );

        $oView = $this->getMock( "Article_Seo", array( "_getObject", "_getCategoryList", "_getVendorList", "_getManufacturerList" ) );
        $oView->expects( $this->once() )->method( '_getObject' )->will( $this->returnValue( $oProduct ) );
        $oView->expects( $this->once() )->method( '_getCategoryList' )->will( $this->returnValue( false ) );
        $oView->expects( $this->once() )->method( '_getVendorList' )->will( $this->returnValue( false ) );
        $oView->expects( $this->once() )->method( '_getManufacturerList' )->will( $this->returnValue( $oList ) );

        $this->assertEquals( "testManId", $oView->getSelectedCategoryId() );
    }

    /**
     * Article_Seo::_getSeoUrl() test case (vendor)
     *
     * @return null
     */
    public function testGetSeoUrlVendor()
    {
        oxTestModules::addFunction( 'oxSeoEncoderArticle', 'getArticleUrl', '{ $this->_iType = $aA[2]; }');
        oxTestModules::addFunction( 'oxSeoEncoderArticle', 'getTestData', '{ return $this->_iType; }');

        $oView = $this->getMock( "Article_Seo", array( "getSelectedCategoryId", "getActCatType", "getEditLang", "_getSeoUrlQuery" ) );
        $oView->expects( $this->once() )->method( 'getSelectedCategoryId' );
        $oView->expects( $this->once() )->method( 'getActCatType' )->will( $this->returnValue( "oxvendor" ) );
        $oView->expects( $this->once() )->method( 'getEditLang' )->will( $this->returnValue( 0 ) );
        $oView->expects( $this->once() )->method( '_getSeoUrlQuery' )->will( $this->returnValue( "select 1" ) );

        $this->assertEquals( "1", $oView->UNITgetSeoUrl( new oxArticle ) );

        $this->assertEquals( OXARTICLE_LINKTYPE_VENDOR, oxSeoEncoderArticle::getInstance()->getTestData() );
    }

    /**
     * Article_Seo::_getSeoUrl() test case (manufacturer)
     *
     * @return null
     */
    public function testGetSeoUrlManufacturer()
    {
        oxTestModules::addFunction( 'oxSeoEncoderArticle', 'getArticleUrl', '{ $this->_iType = $aA[2]; }');
        oxTestModules::addFunction( 'oxSeoEncoderArticle', 'getTestData', '{ return $this->_iType; }');

        $oView = $this->getMock( "Article_Seo", array( "getSelectedCategoryId", "getActCatType", "getEditLang", "_getSeoUrlQuery" ) );
        $oView->expects( $this->once() )->method( 'getSelectedCategoryId' );
        $oView->expects( $this->once() )->method( 'getActCatType' )->will( $this->returnValue( "oxmanufacturer" ) );
        $oView->expects( $this->once() )->method( 'getEditLang' )->will( $this->returnValue( 0 ) );
        $oView->expects( $this->once() )->method( '_getSeoUrlQuery' )->will( $this->returnValue( "select 1" ) );

        $this->assertEquals( "1", $oView->UNITgetSeoUrl( new oxArticle ) );

        $this->assertEquals( OXARTICLE_LINKTYPE_MANUFACTURER, oxSeoEncoderArticle::getInstance()->getTestData() );
    }

    /**
     * Article_Seo::_getSeoUrl() test case (tag)
     *
     * @return null
     */
    public function testGetSeoUrlTag()
    {
        oxTestModules::addFunction( 'oxSeoEncoderArticle', 'getArticleUrl', '{ $this->_iType = $aA[2]; }');
        oxTestModules::addFunction( 'oxSeoEncoderArticle', 'getTestData', '{ return $this->_iType; }');

        $oView = $this->getMock( "Article_Seo", array( "getSelectedCategoryId", "getActCatType", "getEditLang", "_getSeoUrlQuery" ) );
        $oView->expects( $this->once() )->method( 'getSelectedCategoryId' );
        $oView->expects( $this->once() )->method( 'getActCatType' )->will( $this->returnValue( "oxtag" ) );
        $oView->expects( $this->once() )->method( 'getEditLang' )->will( $this->returnValue( 0 ) );
        $oView->expects( $this->once() )->method( '_getSeoUrlQuery' )->will( $this->returnValue( "select 1" ) );

        $this->assertEquals( "1", $oView->UNITgetSeoUrl( new oxArticle ) );

        $this->assertEquals( OXARTICLE_LINKTYPE_TAG, oxSeoEncoderArticle::getInstance()->getTestData() );
    }

    /**
     * Article_Seo::_getSeoUrl() test case (category)
     *
     * @return null
     */
    public function testGetSeoUrlCategory()
    {
        oxTestModules::addFunction( 'oxSeoEncoderArticle', 'getArticleUrl', '{ $this->_iType = $aA[2]; }');
        oxTestModules::addFunction( 'oxSeoEncoderArticle', 'getTestData', '{ return $this->_iType; }');
        oxTestModules::addFunction( 'oxcategory', 'load', '{ return true; }');
        oxTestModules::addFunction( 'oxcategory', 'isPriceCategory', '{ return false; }');

        $oView = $this->getMock( "Article_Seo", array( "getSelectedCategoryId", "getActCatType", "getEditLang", "_getSeoUrlQuery" ) );
        $oView->expects( $this->once() )->method( 'getSelectedCategoryId' );
        $oView->expects( $this->once() )->method( 'getActCatType' )->will( $this->returnValue( "oxany" ) );
        $oView->expects( $this->once() )->method( 'getEditLang' )->will( $this->returnValue( 0 ) );
        $oView->expects( $this->once() )->method( '_getSeoUrlQuery' )->will( $this->returnValue( "select 1" ) );

        $this->assertEquals( "1", $oView->UNITgetSeoUrl( new oxArticle ) );

        $this->assertEquals( OXARTICLE_LINKTYPE_CATEGORY, oxSeoEncoderArticle::getInstance()->getTestData() );
    }

    /**
     * Article_Seo::_getSeoUrl() test case (price category)
     *
     * @return null
     */
    public function testGetSeoUrlPriceCategory()
    {
        oxTestModules::addFunction( 'oxSeoEncoderArticle', 'getArticleUrl', '{ $this->_iType = $aA[2]; }');
        oxTestModules::addFunction( 'oxSeoEncoderArticle', 'getTestData', '{ return $this->_iType; }');
        oxTestModules::addFunction( 'oxcategory', 'load', '{ return true; }');
        oxTestModules::addFunction( 'oxcategory', 'isPriceCategory', '{ return true; }');

        $oView = $this->getMock( "Article_Seo", array( "getSelectedCategoryId", "getActCatType", "getEditLang", "_getSeoUrlQuery" ) );
        $oView->expects( $this->once() )->method( 'getSelectedCategoryId' );
        $oView->expects( $this->once() )->method( 'getActCatType' )->will( $this->returnValue( "oxany" ) );
        $oView->expects( $this->once() )->method( 'getEditLang' )->will( $this->returnValue( 0 ) );
        $oView->expects( $this->once() )->method( '_getSeoUrlQuery' )->will( $this->returnValue( "select 1" ) );

        $this->assertEquals( "1", $oView->UNITgetSeoUrl( new oxArticle ) );

        $this->assertEquals( OXARTICLE_LINKTYPE_PRICECATEGORY, oxSeoEncoderArticle::getInstance()->getTestData() );
    }

    /**
     * Article_Seo::getActCategory() test case (category)
     *
     * @return null
     */
    public function testGetActCategory()
    {
        oxTestModules::addFunction( 'oxcategory', 'load', '{ return true; }');

        $oView = new Article_Seo();
        $this->assertTrue( $oView->getActCategory() instanceof oxcategory );
    }

    /**
     * Article_Seo::getTag() test case (manufacturer)
     *
     * @return null
     */
    public function testGetTag()
    {
        oxTestModules::addFunction( 'oxvendor', 'load', '{ return true; }');

        $oView = $this->getMock( "Article_Seo", array( "getActCatType", "getSelectedCategoryId" ) );
        $oView->expects( $this->any() )->method( 'getActCatType' )->will( $this->returnValue( "oxtag" ) );
        $oView->expects( $this->any() )->method( 'getSelectedCategoryId' )->will( $this->returnValue( "testTagId" ) );
        $this->assertEquals( "testTagId", $oView->getTag());
    }

    /**
     * Article_Seo::getActVendor() test case (manufacturer)
     *
     * @return null
     */
    public function testGetActVendor()
    {
        oxTestModules::addFunction( 'oxvendor', 'load', '{ return true; }');

        $oView = $this->getMock( "Article_Seo", array( "getActCatType" ) );
        $oView->expects( $this->any() )->method( 'getActCatType' )->will( $this->returnValue( "oxvendor" ) );
        $this->assertTrue( $oView->getActVendor() instanceof oxvendor );
    }

    /**
     * Article_Seo::getActManufacturer() test case (manufacturer)
     *
     * @return null
     */
    public function testGetActManufacturer()
    {
        oxTestModules::addFunction( 'oxmanufacturer', 'load', '{ return true; }');

        $oView = $this->getMock( "Article_Seo", array( "getActCatType" ) );
        $oView->expects( $this->any() )->method( 'getActCatType' )->will( $this->returnValue( "oxmanufacturer" ) );
        $this->assertTrue( $oView->getActManufacturer() instanceof oxmanufacturer );
    }

    /**
     * Article_Seo::getListType() test case
     *
     * @return null
     */
    public function testGetListType()
    {
        $oView = $this->getMock( "Article_Seo", array( "getActCatType" ) );
        $oView->expects( $this->any() )->method( 'getActCatType' )->will( $this->returnValue( "oxvendor" ) );
        $this->assertEquals( "vendor", $oView->getListType() );

        $oView = $this->getMock( "Article_Seo", array( "getActCatType" ) );
        $oView->expects( $this->any() )->method( 'getActCatType' )->will( $this->returnValue( "oxmanufacturer" ) );
        $this->assertEquals( "manufacturer", $oView->getListType() );

        $oView = $this->getMock( "Article_Seo", array( "getActCatType" ) );
        $oView->expects( $this->any() )->method( 'getActCatType' )->will( $this->returnValue( "oxtag" ) );
        $this->assertEquals( "tag", $oView->getListType() );

        $oView = $this->getMock( "Article_Seo", array( "getActCatType" ) );
        $oView->expects( $this->any() )->method( 'getActCatType' )->will( $this->returnValue( "oxany" ) );
        $this->assertEquals( "", $oView->getListType() );
    }

    /**
     * Article_Seo::_getSeoUrlQuery() test case (tag)
     *
     * @return null
     */
    public function testGetSeoUrlQueryTag()
    {
        $iShopId = "testShopId";

        $oObject = $this->getMock( "OxStdClass", array( "getId", "getShopId" ) );
        $oObject->expects( $this->once() )->method( 'getId' )->will( $this->returnValue( "testId" ) );
        $oObject->expects( $this->once() )->method( 'getShopId' )->will( $this->returnValue( $iShopId ) );

        $oView = $this->getMock( "Article_Seo", array( "getTag", "getActCategoryLang" ) );
        $oView->expects( $this->any() )->method( 'getTag' )->will( $this->returnValue( true ) );
        $oView->expects( $this->any() )->method( 'getActCategoryLang' )->will( $this->returnValue( 999 ) );
        //$this->assertEquals( 999, $oView->getEditLang() );

        $sStdUrl = "index.php?cl=details&amp;anid=testId&amp;listtype=tag&amp;searchtag=".rawurlencode( true );
        $sQ = "select oxseourl from oxseo where oxobjectid = '".md5( strtolower( $iShopId . $sStdUrl ) )."' and oxshopid = 'testShopId' and oxlang = 999";

        $this->assertEquals( $sQ, $oView->UNITgetSeoUrlQuery( $oObject, $iShopId ) );
    }

    /**
     * Article_Seo::_getSeoUrlQuery() test case (default)
     *
     * @return null
     */
    public function testGetSeoUrlQuery()
    {
        $iShopId = "testShopId";

        $oObject = $this->getMock( "OxStdClass", array( "getId", "getShopId" ) );
        $oObject->expects( $this->once() )->method( 'getId' )->will( $this->returnValue( "testId" ) );

        $oView = $this->getMock( "Article_Seo", array( "getTag" ) );
        $oView->expects( $this->any() )->method( 'getTag' )->will( $this->returnValue( false ) );
        //$this->assertEquals( 999, $oView->getEditLang() );

        $sQ = "select oxseourl from oxseo where oxobjectid = 'testId' and oxshopid = 'testShopId' and oxlang = 0 and oxparams = '' ";

        $this->assertEquals( $sQ, $oView->UNITgetSeoUrlQuery( $oObject, $iShopId ) );
    }

    /**
     * Article_Seo::getEditLang() test case
     *
     * @return null
     */
    public function testGetEditLang()
    {
        $oView = $this->getMock( "Article_Seo", array( "getTag", "getActCategoryLang" ) );
        $oView->expects( $this->once() )->method( 'getTag' )->will( $this->returnValue( true ) );
        $oView->expects( $this->once() )->method( 'getActCategoryLang' )->will( $this->returnValue( 999 ) );
        $this->assertEquals( 999, $oView->getEditLang() );
    }

    /**
     * Article_Seo::getActCategoryLang() test case
     *
     * @return null
     */
    public function testGetActCategoryLang()
    {
        $oView = $this->getProxyClass( "Article_Seo" );
        $oView->setNonPublicVar( "_iActCatLang", 999 );
        $this->assertEquals( 999, $oView->getActCategoryLang() );
    }

    /**
     * Article_Seo::_getSeoEntryId() test case
     *
     * @return null
     */
    public function testGetSeoEntryId()
    {
        $oObject = $this->getMock( "OxStdClass", array( "getShopId", "getId" ) );
        $oObject->expects( $this->once() )->method( 'getShopId' )->will( $this->returnValue( "testShopId" ) );
        $oObject->expects( $this->once() )->method( 'getId' )->will( $this->returnValue( "testId" ) );

        $oView = $this->getMock( "Article_Seo", array( "getTag", "_getObject", "_getStdUrl" ) );
        $oView->expects( $this->once() )->method( 'getTag' )->will( $this->returnValue( true ) );
        $oView->expects( $this->once() )->method( '_getObject' )->will( $this->returnValue( $oObject ) );
        $oView->expects( $this->once() )->method( '_getStdUrl' )->will( $this->returnValue( "testStdUrl" ) );
        $this->assertEquals( md5( strtolower( "testShopId" . "testStdUrl" ) ), $oView->UNITgetSeoEntryId() );
    }

    /**
     * Article_Seo::_getSeoEntryId() test case
     *
     * @return null
     */
    public function testGetSeoEntryIdNoTag()
    {
        modConfig::setParameter( 'oxid', 'testId' );

        $oView = $this->getMock( "Article_Seo", array( "getTag", "_getObject", "_getStdUrl" ) );
        $oView->expects( $this->once() )->method( 'getTag' )->will( $this->returnValue( false ) );
        $this->assertEquals( 'testId', $oView->UNITgetSeoEntryId() );
    }

    /**
     * Article_Seo::_getSeoEntryType() test case (tag)
     *
     * @return null
     */
    public function testGetSeoEntryTypeTag()
    {
        $oView = $this->getMock( "Article_Seo", array( "getTag" ) );
        $oView->expects( $this->once() )->method( 'getTag' )->will( $this->returnValue( true ) );
        $this->assertEquals( 'dynamic', $oView->UNITgetSeoEntryType() );
    }

    /**
     * Article_Seo::_getSeoEntryType() test case (default)
     *
     * @return null
     */
    public function testGetSeoEntryType()
    {
        $oView = $this->getMock( "Article_Seo", array( "getTag" ) );
        $oView->expects( $this->once() )->method( 'getTag' )->will( $this->returnValue( false ) );
        $this->assertEquals( 'oxarticle', $oView->UNITgetSeoEntryType() );
    }

    /**
     * Article_Seo::getType() test case (manufacturer)
     *
     * @return null
     */
    public function testGetType()
    {
        $oView = new Article_Seo();
        $this->assertEquals( 'oxarticle', $oView->UNITgetType() );
    }

    /**
     * Article_Seo::_getStdUrl() test case (vendor)
     *
     * @return null
     */
    public function testGetStdUrlVendor()
    {
        oxTestModules::addFunction( 'oxarticle', 'loadInLang', '{ return true; }');
        oxTestModules::addFunction( 'oxarticle', 'getBaseStdLink', '{ return "baseStdLink"; }');

        $oView = $this->getMock( "Article_Seo", array( "getListType", "getSelectedCategoryId", "getActCatType", "getTag" ) );
        $oView->expects( $this->once() )->method( "getActCatType" )->will( $this->returnValue( "oxvendor" ) );
        $oView->expects( $this->any() )->method( "getListType" )->will( $this->returnValue( "testListType" ) );
        $oView->expects( $this->any() )->method( "getSelectedCategoryId" )->will( $this->returnValue( "testCatId" ) );
        $oView->expects( $this->any() )->method( "getTag" )->will( $this->returnValue( "testTag" ) );

        $this->assertEquals( "baseStdLink&amp;listtype=testListType&amp;cnid=v_testCatId", $oView->UNITgetStdUrl( "testOxId" ) );
    }

    /**
     * Article_Seo::_getStdUrl() test case (manufacturer)
     *
     * @return null
     */
    public function testGetStdUrlManufacturer()
    {
        oxTestModules::addFunction( 'oxarticle', 'loadInLang', '{ return true; }');
        oxTestModules::addFunction( 'oxarticle', 'getBaseStdLink', '{ return "baseStdLink"; }');

        $oView = $this->getMock( "Article_Seo", array( "getListType", "getSelectedCategoryId", "getActCatType", "getTag" ) );
        $oView->expects( $this->once() )->method( "getActCatType" )->will( $this->returnValue( "oxmanufacturer" ) );
        $oView->expects( $this->any() )->method( "getListType" )->will( $this->returnValue( "testListType" ) );
        $oView->expects( $this->any() )->method( "getSelectedCategoryId" )->will( $this->returnValue( "testCatId" ) );
        $oView->expects( $this->any() )->method( "getTag" )->will( $this->returnValue( "testTag" ) );

        $this->assertEquals( "baseStdLink&amp;listtype=testListType&amp;mnid=testCatId", $oView->UNITgetStdUrl( "testOxId" ) );
    }

    /**
     * Article_Seo::_getStdUrl() test case (tag)
     *
     * @return null
     */
    public function testGetStdUrlTag()
    {
        oxTestModules::addFunction( 'oxarticle', 'loadInLang', '{ return true; }');
        oxTestModules::addFunction( 'oxarticle', 'getBaseStdLink', '{ return "baseStdLink"; }');

        $oView = $this->getMock( "Article_Seo", array( "getListType", "getSelectedCategoryId", "getActCatType", "getTag" ) );
        $oView->expects( $this->once() )->method( "getActCatType" )->will( $this->returnValue( "oxtag" ) );
        $oView->expects( $this->any() )->method( "getListType" )->will( $this->returnValue( "testListType" ) );
        $oView->expects( $this->any() )->method( "getSelectedCategoryId" )->will( $this->returnValue( "testCatId" ) );
        $oView->expects( $this->any() )->method( "getTag" )->will( $this->returnValue( "testTag" ) );

        $this->assertEquals( "baseStdLink&amp;listtype=testListType&amp;searchtag=testTag", $oView->UNITgetStdUrl( "testOxId" ) );
    }

    /**
     * Article_Seo::_getStdUrl() test case (default)
     *
     * @return null
     */
    public function testGetStdUrlDefault()
    {
        oxTestModules::addFunction( 'oxarticle', 'loadInLang', '{ return true; }');
        oxTestModules::addFunction( 'oxarticle', 'getBaseStdLink', '{ return "baseStdLink"; }');

        $oView = $this->getMock( "Article_Seo", array( "getListType", "getSelectedCategoryId", "getActCatType", "getTag" ) );
        $oView->expects( $this->once() )->method( "getActCatType" )->will( $this->returnValue( "oxany" ) );
        $oView->expects( $this->any() )->method( "getListType" )->will( $this->returnValue( "testListType" ) );
        $oView->expects( $this->any() )->method( "getSelectedCategoryId" )->will( $this->returnValue( "testCatId" ) );
        $oView->expects( $this->any() )->method( "getTag" )->will( $this->returnValue( "testTag" ) );

        $this->assertEquals( "baseStdLink&amp;listtype=testListType&amp;cnid=testCatId", $oView->UNITgetStdUrl( "testOxId" ) );
    }

    /**
     * Article_Seo::getActCatType() test case (manufacturer)
     *
     * @return null
     */
    public function testGetActCatType()
    {
        $oView = $this->getProxyClass( "Article_Seo" );
        $oView->setNonPublicVar( "_sActCatType", "testCatType" );
        $this->assertEquals( "testCatType", $oView->getActCatType() );
    }

    /**
     * Article_Seo::processParam() test case (tag)
     *
     * @return null
     */
    public function testProcessParamTag()
    {
        $oView = $this->getMock( "Article_Seo", array( "getTag" ) );
        $oView->expects( $this->once() )->method( "getTag" )->will( $this->returnValue( true ) );
        $this->assertEquals( "", $oView->processParam( "testParam" ) );
    }

    /**
     * Article_Seo::processParam() test case (any other than tag)
     *
     * @return null
     */
    public function testProcessParam()
    {
        $oView = $this->getMock( "Article_Seo", array( "getTag" ) );
        $oView->expects( $this->once() )->method( "getTag" )->will( $this->returnValue( false ) );
        $this->assertEquals( "testParam2", $oView->processParam( "testParam1#testParam2" ) );
    }

    /**
     * Article_Seo::getNoCatId() test case (manufacturer)
     *
     * @return null
     */
    public function testGetNoCatId()
    {
        $oView = new Article_Seo();
        $this->assertEquals( "__nonecatid", $oView->getNoCatId() );
    }

    /**
     * Article_Seo::_getCategoryList() test case (regular)
     *
     * @return null
     */
    public function testGetCategoryList()
    {
        $oArticle = new oxArticle();
        $oArticle->load( '1126' );

        $oView = $this->getMock( "Article_Seo", array( "getTag" ) );
        $oView->expects( $this->once() )->method( 'getTag' )->will( $this->returnValue( null ) );
        $oList = $oView->UNITgetCategoryList( $oArticle );

            $this->assertEquals( 2, $oList->count() );
            $this->assertTrue( $oList->offsetExists( "8a142c3e49b5a80c1.23676990" ) );
            $this->assertTrue( $oList->offsetExists( "8a142c3e4143562a5.46426637" ) );
    }
}
