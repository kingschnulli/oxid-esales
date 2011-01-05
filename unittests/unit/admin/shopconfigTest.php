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
 * @version   SVN: $Id: shopconfigTest.php 25334 2010-01-22 07:14:37Z alfonsas $
 */

require_once realpath( "." ).'/unit/OxidTestCase.php';
require_once realpath( "." ).'/unit/test_config.inc.php';

/**
 * Tests for Shop_Config class
 */
class Unit_Admin_ShopConfigTest extends OxidTestCase
{
    /**
     * Shop_Config::Render() test case
     *
     * @return null
     */
    public function testRender()
    {
        // testing..
        $oView = new Shop_Config();
        $this->assertEquals( 'shop_config.tpl', $oView->render() );
    }

    /**
     * Shop_Config::SaveConfVars() test case
     *
     * @return null
     */
    public function testSaveConfVars()
    {
        modConfig::setParameter( "oxid", "testId" );
        modConfig::setParameter( "confbools", array( "bool" => true ) );
        modConfig::setParameter( "confstrs", array( "str" => "string" ) );
        modConfig::setParameter( "confarrs", array( "arr" => "a\nb\nc" ) );
        modConfig::setParameter( "confaarrs", array( "aarr" => "a => b\nc => d" ) );

        $aTasks[] = "getConfig";

        $oConfig = $this->getMock( "oxconfig", array( "saveShopConfVar" ) );
        $oConfig->expects( $this->at( 0 ) )->method( 'saveShopConfVar' )->with( $this->equalTo( "bool" ), $this->equalTo( "bool" ), $this->equalTo( true ), $this->equalTo( "testId" ) );
        $oConfig->expects( $this->at( 1 ) )->method( 'saveShopConfVar' )->with( $this->equalTo( "str" ), $this->equalTo( "str" ), $this->equalTo( "string" ), $this->equalTo( "testId" ) );
        $oConfig->expects( $this->at( 2 ) )->method( 'saveShopConfVar' )->with( $this->equalTo( "arr" ), $this->equalTo( "arr" ), $this->equalTo( array( "a", "b", "c" ) ), $this->equalTo( "testId" ) );
        $oConfig->expects( $this->at( 3 ) )->method( 'saveShopConfVar' )->with( $this->equalTo( "aarr" ), $this->equalTo( "aarr" ), $this->equalTo( array( "a" => "b", "c" => "d" ) ), $this->equalTo( "testId" ) );

        // testing..
        $oView = $this->getMock( "Shop_Config", $aTasks, array(), '', false );
        $oView->expects( $this->once() )->method( 'getConfig' )->will( $this->returnValue( $oConfig ) );
        $oView->saveConfVars();
    }

    /**
     * Shop_Config::Save() test case
     *
     * @return null
     */
    public function testSave()
    {
        oxTestModules::addFunction( 'oxshop', 'load', '{ return true; }');
        oxTestModules::addFunction( 'oxshop', 'assign', '{ return true; }');
        oxTestModules::addFunction( 'oxshop', 'save', '{ return true; }');
        oxTestModules::addFunction( 'oxUtils', 'rebuildCache', '{ throw new Exception( "rebuildCache" ); }');

        // testing..
        try {
            $oView = $this->getMock( "Shop_Config", array( "saveConfVars" ) );
            $oView->expects( $this->once() )->method( 'saveConfVars' );
            $oView->save();
        } catch ( Exception $oExcp ) {
            $this->assertEquals( "rebuildCache", $oExcp->getMEssage(), "Error in Shop_Config::save()" );
            return;
        }
        $this->fail( "Error in Shop_Config::save()" );
    }

    /**
     * Shop_Config::ArrayToMultiline() test case
     *
     * @return null
     */
    public function testArrayToMultiline()
    {
        // defining parameters
        $aInput = array( "a", "b", "c" );

        // testing..
        $oView = new Shop_Config();
        $this->assertEquals( "a\nb\nc", $oView->UNITarrayToMultiline( $aInput ) );
    }

    /**
     * Shop_Config::MultilineToArray() test case
     *
     * @return null
     */
    public function testMultilineToArray()
    {
        // defining parameters
        $sMultiline = "a\nb\n\nc";

        // testing..
        $oView = new Shop_Config();
        $this->assertEquals( array( 0 => "a", 1 => "b", 3=> "c" ), $oView->UNITmultilineToArray( $sMultiline ) );
    }

    /**
     * Shop_Config::AarrayToMultiline() test case
     *
     * @return null
     */
    public function testAarrayToMultiline()
    {
        // defining parameters
        $aInput = array( "a" => "b", "c" => "d" );

        // testing..
        $oView = new Shop_Config();
        $this->assertEquals( "a => b\nc => d", $oView->UNITaarrayToMultiline( $aInput ) );
    }

    /**
     * Shop_Config::MultilineToAarray() test case
     *
     * @return null
     */
    public function testMultilineToAarray()
    {
        // defining parameters
        $sMultiline = "a => b\nc => d";

        // testing..
        $oView = new Shop_Config();
        $this->assertEquals( array( "a" => "b", "c" => "d" ), $oView->UNITmultilineToAarray( $sMultiline ) );
    }
}
