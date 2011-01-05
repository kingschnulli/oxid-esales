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
 * @version   SVN: $Id: categoryseoTest.php 28027 2010-05-31 11:16:38Z arvydas $
 */

require_once realpath( "." ).'/unit/OxidTestCase.php';
require_once realpath( "." ).'/unit/test_config.inc.php';

/**
 * Tests for Category_Seo class
 */
class Unit_Admin_CategorySeoTest extends OxidTestCase
{
    /**
     * Sets up test
     *
     * @return null
     */
    protected function setUp()
    {
        parent::setUp();
        oxTestModules::addFunction( 'oxSeoEncoderCategory', 'cleanup', '{ self::$_instance = null; }');
    }

    /**
     * Tear down the fixture.
     *
     * @return null
     */
    protected function tearDown()
    {
        oxSeoEncoderCategory::getInstance()->cleanup();
        parent::tearDown();
    }

    /**
     * Category_Seo::Render() test case
     *
     * @return null
     */
    public function testRender()
    {
        // testing..
        $oView = new Category_Seo();
        $this->assertEquals( 'object_seo.tpl', $oView->render() );
    }

    /**
     * Category_Seo::GetSeoDataSql() test case
     *
     * @return null
     */
    public function testGetSeoDataSql()
    {
        // defining parameters
        $oObject = new oxCategory();
        $oObject->setId( "testCatId" );
        $iShopId = oxConfig::getInstance()->getBaseShopId();
        $iLang   = 0;

        $sQ = "select * from oxseo
               left join oxobject2seodata on
                   oxobject2seodata.oxobjectid = oxseo.oxobjectid and
                   oxobject2seodata.oxshopid = oxseo.oxshopid and
                   oxobject2seodata.oxlang = oxseo.oxlang
               where
                   oxseo.oxobjectid = 'testCatId' and
                   oxseo.oxshopid = '{$iShopId}' and oxseo.oxlang = {$iLang} and oxparams = '' ";

        $oView = new Category_Seo();
        $sResQ = $oView->UNITgetSeoDataSql( $oObject, $iShopId, $iLang );

        $this->assertEquals( str_replace( array("\n", "\r", "\t", " "), "", $sQ ), str_replace( array("\n", "\r", "\t", " "), "", $sResQ ) );
    }

    /**
     * Category_Seo::GetSeoUrl() test case
     *
     * @return null
     */
    public function testGetSeoUrl()
    {
        oxTestModules::addFunction( 'oxSeoEncoderCategory', 'getCategoryUrl', '{ return true; }');

        // defining parameters
        $oCategory = new oxCategory();

        $oView = $this->getMock( "Category_Seo", array( "_getSeoUrlQuery" ) );
        $oView->expects( $this->once() )->method( '_getSeoUrlQuery' )->will( $this->returnValue( "select 1" ) );

        $this->assertEquals( "1", $oView->UNITgetSeoUrl( $oCategory ) );
    }

    /**
     * Category_Seo::GetType() test case
     *
     * @return null
     */
    public function testGetType()
    {
        // testing..
        $oView = new Category_Seo();
        $this->assertEquals( 'oxcategory', $oView->UNITgetType() );
    }

    /**
     * Category_Seo::Save() test case
     *
     * @return null
     */
    public function testSave()
    {
        oxTestModules::addFunction( 'oxbase', 'load', '{ return true; }');
        oxTestModules::addFunction( 'oxbase', 'save', '{ return true; }');
        oxTestModules::addFunction( 'oxSeoEncoderCategory', 'markRelatedAsExpired', '{ throw new Exception( "markRelatedAsExpired" ); }');
        modConfig::setParameter( "oxid", "testId" );

        // testing..
        try {
            $oView = new Category_Seo();
            $oView->save();
        } catch ( Exception $oExcp ) {
            $this->assertEquals( "markRelatedAsExpired", $oExcp->getMessage(), "Error in Category_Seo::Save()" );
            return;
        }
        $this->fail( "Error in Category_Seo::Save()" );
    }

}
