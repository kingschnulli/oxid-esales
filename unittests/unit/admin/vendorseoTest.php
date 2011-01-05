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
 * @version   SVN: $Id: vendorseoTest.php 28029 2010-05-31 12:21:51Z arvydas $
 */

require_once realpath( "." ).'/unit/OxidTestCase.php';
require_once realpath( "." ).'/unit/test_config.inc.php';

/**
 * Tests for Vendor_Seo class
 */
class Unit_Admin_VendorSeoTest extends OxidTestCase
{
    /**
     * Initialize the fixture.
     *
     * @return null
     */
    protected function setUp()
    {
        parent::setUp();
        oxTestModules::addFunction( 'oxSeoEncoderVendor', 'cleanup', '{ self::$_instance = null; }');
    }

    /**
     * Tear down the fixture.
     *
     * @return null
     */
    protected function tearDown()
    {
        oxSeoEncoderVendor::getInstance()->cleanup();
        parent::tearDown();
    }

    /**
     * Vendor_Seo::Render() test case
     *
     * @return null
     */
    public function testRender()
    {
        // testing..
        $oView = $this->getMock( "Vendor_Seo", array( "_getObject" ) );
        $oView->expects( $this->atLEastOnce() )->method( '_getObject');
        $this->assertEquals( 'object_seo.tpl', $oView->render() );
    }

    /**
     * Vendor_Seo::GetSeoDataSql() test case
     *
     * @return null
     */
    public function testGetSeoDataSql()
    {
        $sQ = "select * from oxseo
               left join oxobject2seodata on
                   oxobject2seodata.oxobjectid = oxseo.oxobjectid and
                   oxobject2seodata.oxshopid = oxseo.oxshopid and
                   oxobject2seodata.oxlang = oxseo.oxlang
               where
                   oxseo.oxobjectid = 'testId' and
                   oxseo.oxshopid = '1' and oxseo.oxlang = 1 and oxparams = '' ";

        $oObject = new oxBase();
        $oObject->setId( "testId" );

        // testing..
        $oView = new Vendor_Seo();
        $sResQ = $oView->UNITgetSeoDataSql( $oObject, 1, 1 );

        $this->assertEquals( str_replace( array( "\n", "\r", "\t", " " ), "", $sQ ), str_replace( array( "\n", "\r", "\t", " " ), "", $sResQ ) );
    }

    /**
     * Vendor_Seo::GetSeoUrl() test case
     *
     * @return null
     */
    public function testGetSeoUrl()
    {
        oxTestModules::addFunction( 'oxSeoEncoderVendor', 'getVendorUrl', '{ return true; }' );

        // testing..
        $oView = $this->getMock( "Vendor_Seo", array( "_getSeoUrlQuery" ) );
        $oView->expects( $this->once() )->method( '_getSeoUrlQuery' )->will( $this->returnValue( "select 1+1" ) );
        $this->assertEquals( "2", $oView->UNITgetSeoUrl( new oxVendor ) );
    }

    /**
     * Vendor_Seo::GetObject() test case
     *
     * @return null
     */
    public function testGetObject()
    {
        oxTestModules::addFunction( 'oxvendor', 'loadInLang', '{ return true; }' );

        // defining parameters
        $oView = new Vendor_Seo();
        $oObject = $oView->UNITgetObject( "testId" );
        $this->assertNotNull( $oObject );
        $this->assertTrue( $oObject instanceof oxvendor );
    }

    /**
     * Vendor_Seo::GetType() test case
     *
     * @return null
     */
    public function testGetType()
    {
        // testing..
        $oView = new Vendor_Seo();
        $this->assertEquals( "oxvendor", $oView->UNITgetType() );
    }

    /**
     * Vendor_Seo::Save() test case
     *
     * @return null
     */
    public function testSave()
    {
        modConfig::setParameter( 'oxid', "testId" );

        oxTestModules::addFunction( 'oxbase', 'save', '{ throw new Exception("save"); }' );
        oxTestModules::addFunction( 'oxbase', 'load', '{ return true; }' );

        // testing..
        try {
            $oView = new Vendor_Seo();
            $oView->save();
        } catch ( Exception $oExcp ) {
            $this->assertEquals( "save", $oExcp->getMessage(), "Error in Vendor_Seo::save()" );
            return;
        }
        $this->fail( "Error in Vendor_Seo::save()" );
    }
}
