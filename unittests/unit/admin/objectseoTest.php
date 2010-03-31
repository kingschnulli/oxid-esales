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
 * @version   SVN: $Id: objectseoTest.php 26311 2010-03-05 09:02:45Z arvydas $
 */

require_once realpath( "." ).'/unit/OxidTestCase.php';
require_once realpath( "." ).'/unit/test_config.inc.php';

/**
 * Tests for Object_Seo class
 */
class Unit_Admin_ObjectSeoTest extends OxidTestCase
{
    /**
     * Sets up test
     *
     * @return null
     */
    protected function setUp()
    {
        parent::setUp();
        oxTestModules::addFunction( 'oxSeoEncoder', 'cleanup', '{ self::$_instance = null; }');
    }

    /**
     * Tear down the fixture.
     *
     * @return null
     */
    protected function tearDown()
    {
        oxSeoEncoder::getInstance()->cleanup();
        parent::tearDown();
    }

    /**
     * Object_Seo::Render() test case
     *
     * @return null
     */
    public function testRender()
    {
        $oObject = $this->getMock( "oxbase", array( "getAvailableInLangs", "loadInLang" ) );
        $oObject->expects( $this->once() )->method( 'getAvailableInLangs' )->will( $this->returnValue( array( 1 => 1 ) ) );
        $oObject->expects( $this->once() )->method( 'loadInLang' );

        // testing..
        $oView = $this->getMock( "Object_Seo", array( "_getObject", "_getSeoDataSql", "_getSeoUrl" ) );
        $oView->expects( $this->once() )->method( '_getObject' )->will( $this->returnValue( $oObject ) );
        $oView->expects( $this->once() )->method( '_getSeoDataSql' )->will( $this->returnValue( "select 1 + 1" ) );
        $oView->expects( $this->once() )->method( '_getSeoUrl' );
        $this->assertEquals( 'object_seo.tpl', $oView->render() );
        $aViewData = $oView->getViewData();
        $this->assertTrue( isset( $aViewData['edit'] ) );
        $this->assertTrue( isset( $aViewData['aSeoData'] ) );
    }

    /**
     * Object_Seo::GetSeoDataSql() test case
     *
     * @return null
     */
    public function testGetSeoDataSql()
    {
        $sQ = "select * from oxseo where oxobjectid = 'testId' and
                oxshopid = '1' and oxlang = 1 ";

        // defining parameters
        $oObject = $this->getMock( "oxbase", array( "getId" ) );
        $oObject->expects( $this->once() )->method( 'getId' )->will( $this->returnValue( "testId" ) );

        $oView = new Object_Seo();
        $sResQ = $oView->UNITgetSeoDataSql( $oObject, 1, 1 );

        $this->assertEquals( str_replace( array( "\n", " ", "\r", "\t" ), "", $sQ ), str_replace( array( "\n", " ", "\r", "\t" ), "", $sResQ ) );
    }

    /**
     * Object_Seo::GetSeoUrl() test case
     *
     * @return null
     */
    public function testGetSeoUrl()
    {
        // testing..
        $oView = $this->getMock( "Object_Seo", array( "_getSeoUrlQuery" ) );
        $oView->expects( $this->once() )->method( '_getSeoUrlQuery' )->with( $this->equalTo( "testObject" ), $this->equalTo( oxConfig::getInstance()->getShopId() ) )->will( $this->returnValue( "select 1 + 1" ) );
        $this->assertEquals( "2", $oView->UNITgetSeoUrl( "testObject" ) );
    }

    /**
     * Object_Seo::GetSeoUrlQuery() test case
     *
     * @return null
     */
    public function testGetSeoUrlQuery()
    {
        $oObject = $this->getMock( "oxbase", array( "getId" ) );
        $oObject->expects( $this->once() )->method( 'getId' )->will( $this->returnValue( "testId" ) );

        $sQ = "select oxseourl from oxseo where oxobjectid = 'testId' and oxshopid = '999' and oxlang = testLang ";

        // testing..
        $oView = $this->getProxyClass( "Object_Seo" );
        $oView->setNonPublicVar( "_iEditLang", "testLang" );
        $oView->UNITgetSeoUrlQuery( $oObject, 999 );
    }

    /**
     * Object_Seo::GetObject() test case
     *
     * @return null
     */
    public function testGetObjectNoSuchObject()
    {
        // defining parameters
        $oView = $this->getMock( "Object_Seo", array( "_getType" ) );
        $oView->expects( $this->once() )->method( '_getType' )->will( $this->returnValue( "oxarticle" ) );
        $this->assertFalse( $oView->UNITgetObject( time() ) );
    }

    /**
     * Object_Seo::GetObject() test case
     *
     * @return null
     */
    public function testGetObject()
    {
        // defining parameters
        $oView = $this->getMock( "Object_Seo", array( "_getType" ) );
        $oView->expects( $this->once() )->method( '_getType' )->will( $this->returnValue( "oxarticle" ) );
        $this->assertTrue( $oView->UNITgetObject( "1126" ) instanceof oxarticle );
    }

    /**
     * Object_Seo::GetType() test case
     *
     * @return null
     */
    public function testGetType()
    {
        // testing..
        $oView = new Object_Seo();
        $this->assertNull( $oView->UNITgetType() );
    }

    /**
     * Object_Seo::GetStdUrl() test case
     *
     * @return null
     */
    public function testGetStdUrl()
    {
        // defining parameters
        $oObject = $this->getMock( "oxarticle", array( "getBaseStdLink" ) );
        $oObject->expects( $this->once() )->method( 'getBaseStdLink' )->with( $this->equalTo( 0 ), $this->equalTo( true ), $this->equalTo( false ) )->will( $this->returnValue( "stdLink" ) );

        $oView = $this->getMock( "Object_Seo", array( "_getObject" ) );
        $oView->expects( $this->once() )->method( '_getObject' )->will( $this->returnValue( $oObject ) );
        $this->assertEquals( "stdLink", $oView->UNITgetStdUrl( "testId" ) );
    }

    /**
     * Object_Seo::Save() test case
     *
     * @return null
     */
    public function testSave()
    {
        modConfig::setParameter( "aSeoData", array( "oxseourl" => "testSeoUrl", "oxkeywords" => " testKeywords ", "oxdescription" => " testDescription ", "oxparams" => "testParams" ) );
        oxTestModules::addFunction( 'oxSeoEncoder', 'addSeoEntry', '{ throw new Exception( serialize( $aA ) ); }');

        try {
            // testing..
            $oView = $this->getMock( "Object_Seo", array( "_getSeoEntryId", "getEditLang", "_getStdUrl", "_getSeoEntryType", "processParam" ) );
            $oView->expects( $this->once() )->method( '_getSeoEntryId' )->will( $this->returnValue( "testId" ) );
            $oView->expects( $this->any() )->method( 'getEditLang' )->will( $this->returnValue( 1 ) );
            $oView->expects( $this->once() )->method( '_getStdUrl' )->with( $this->equalTo( "testId" ) )->will( $this->returnValue( "testUrl" ) );
            $oView->expects( $this->once() )->method( '_getSeoEntryType' )->will( $this->returnValue( "testType" ) );
            $oView->expects( $this->once() )->method( 'processParam' )->with( $this->equalTo( "testParams" ))->will( $this->returnValue( "testParams" ) );
            $oView->save();
        } catch ( Exception $oExcp ) {
            $aMsg = @unserialize( $oExcp->getMessage() );

            $this->assertTrue( is_array( $aMsg ), "Error in Object_Seo::save()" );

            $this->assertEquals( "testId", $aMsg[0], "Error in Object_Seo::save()" );
            $this->assertEquals( oxConfig::getInstance()->getShopId(), $aMsg[1], "Error in Object_Seo::save()" );
            $this->assertEquals( 1, $aMsg[2], "Error in Object_Seo::save()" );
            $this->assertEquals( "testUrl", $aMsg[3], "Error in Object_Seo::save()" );
            $this->assertEquals( "testSeoUrl", $aMsg[4], "Error in Object_Seo::save()" );
            $this->assertEquals( "testType", $aMsg[5], "Error in Object_Seo::save()" );
            $this->assertEquals( 0, $aMsg[6], "Error in Object_Seo::save()" );
            $this->assertEquals( "testKeywords", $aMsg[7], "Error in Object_Seo::save()" );
            $this->assertEquals( "testDescription", $aMsg[8], "Error in Object_Seo::save()" );
            $this->assertEquals( "testParams", $aMsg[9], "Error in Object_Seo::save()" );
            $this->assertTrue( $aMsg[10], "Error in Object_Seo::save()" );
            return;
        }
        $this->fail( "Error in Object_Seo::save()" );
    }

    /**
     * Object_Seo::GetEditLang() test case
     *
     * @return null
     */
    public function testGetEditLang()
    {
        // testing..
        $oView = $this->getProxyClass( "Object_Seo" );
        $oView->setNonPublicVar( "_iEditLang", 999 );
        $this->assertEquals( 999, $oView->getEditLang() );
    }

    /**
     * Object_Seo::_getSeoEntryId() test case
     *
     * @return null
     */
    public function testGetSeoEntryId()
    {
        modConfig::setParameter( "oxid", "testId" );

        // testing..
        $oView = new Object_Seo();
        $this->assertEquals( "testId", $oView->UNITgetSeoEntryId() );
    }

    /**
     * Object_Seo::GetSeoEntryType() test case
     *
     * @return null
     */
    public function testGetSeoEntryType()
    {
        // testing..
        $oView = $this->getMock( "Object_Seo", array( "_getType" ) );
        $oView->expects( $this->once() )->method( '_getType' )->will( $this->returnValue( "testType" ) );
        $this->assertEquals( "testType", $oView->UNITgetSeoEntryType() );
    }

    /**
     * Object_Seo::ProcessParam() test case
     *
     * @return null
     */
    public function testProcessParam()
    {
        // testing
        $oView = new Object_Seo();
        $this->assertEquals( "param1", $oView->processParam( "param1" ) );
    }
}
