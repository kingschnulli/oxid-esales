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
 * @version   SVN: $Id: manufacturerseoTest.php 25400 2010-01-27 22:42:50Z alfonsas $
 */

require_once realpath( "." ).'/unit/OxidTestCase.php';
require_once realpath( "." ).'/unit/test_config.inc.php';

/**
 * Tests for Manufacturer_Seo class
 */
class Unit_Admin_ManufacturerSeoTest extends OxidTestCase
{
    /**
     * Sets up test
     *
     * @return null
     */
    protected function setUp()
    {
        parent::setUp();
        oxTestModules::addFunction( 'oxSeoEncoderManufacturer', 'cleanup', '{ self::$_instance = null; }');
    }

    /**
     * Tear down the fixture.
     *
     * @return null
     */
    protected function tearDown()
    {
        oxSeoEncoderManufacturer::getInstance()->cleanup();
        parent::tearDown();
    }

    /**
     * Manufacturer_Seo::Render() test case
     *
     * @return null
     */
    public function testRender()
    {
        // testing..
        $oView = new Manufacturer_Seo();
        $sTplName = $oView->render();

        // testing view data
        $aViewData = $oView->getViewData();
        $this->assertNull( $aViewData["allowSharedEdit"] );
        $this->assertNull( $aViewData["malladmin"] );
        $this->assertTrue( $aViewData["blShowSuffixEdit"] );
        $this->assertNull( $aViewData["blShowSuffix"] );
        $this->assertNull( $aViewData["updatelist"] );

        $this->assertEquals( 'object_seo.tpl', $sTplName );
    }

    /**
     * Manufacturer_Seo::GetSeoDataSql() test case
     *
     * @return null
     */
    public function testGetSeoDataSql()
    {
        // defining parameters
        $oObject = new oxManufacturer();
        $oObject->setId( "testManId" );
        $iShopId = oxConfig::getInstance()->getBaseShopId();
        $iLang   = 0;

        $sQ = "select * from oxseo where oxobjectid = 'testManId' and
                oxshopid = '{$iShopId}' and oxlang = {$iLang}  and oxparams = '' ";

        $oView = new Manufacturer_Seo();
        $sResQ = $oView->UNITgetSeoDataSql( $oObject, $iShopId, $iLang );

        $this->assertEquals( str_replace( array("\n", "\r", "\t", " "), "", $sQ ), str_replace( array("\n", "\r", "\t", " "), "", $sResQ ) );
    }

    /**
     * Manufacturer_Seo::GetSeoUrl() test case
     *
     * @return null
     */
    public function testGetSeoUrl()
    {
        oxTestModules::addFunction( 'oxSeoEncoderManufacturer', 'getManufacturerUrl', '{ return true; }');

        // defining parameters
        $oCategory = new oxCategory();

        $oView = $this->getMock( "Manufacturer_Seo", array( "_getSeoUrlQuery" ) );
        $oView->expects( $this->once() )->method( '_getSeoUrlQuery' )->will( $this->returnValue( "select 1" ) );

        $this->assertEquals( "1", $oView->UNITgetSeoUrl( $oCategory ) );
    }

    /**
     * Manufacturer_Seo::GetType() test case
     *
     * @return null
     */
    public function testGetType()
    {
        // testing..
        $oView = new Manufacturer_Seo();
        $this->assertEquals( 'oxmanufacturer', $oView->UNITgetType() );
    }

    /**
     * Manufacturer_Seo::Save() test case
     *
     * @return null
     */
    public function testSave()
    {
        oxTestModules::addFunction( 'oxbase', 'load', '{ return true; }');
        oxTestModules::addFunction( 'oxbase', 'save', '{ return true; }');
        modConfig::setParameter( "oxid", "testId" );

        // testing..
        $oView = $this->getMock( "Manufacturer_Seo", array( "_getSeoEntryId" ) );
        $oView->expects( $this->once() )->method( '_getSeoEntryId' )->will( $this->returnValue( false ) );

        $this->assertNull( $oView->save() );
    }
}
