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
 * @version   SVN: $Id: wrappingmainTest.php 33190 2011-02-10 15:56:27Z arvydas.vapsva $
 */

require_once realpath( "." ).'/unit/OxidTestCase.php';
require_once realpath( "." ).'/unit/test_config.inc.php';

/**
 * Tests for Wrapping_Main class
 */
class Unit_Admin_WrappingMainTest extends OxidTestCase
{
    /**
     * Wrapping_Main::Render() test case
     *
     * @return null
     */
    public function testRender()
    {
        modConfig::setParameter( "oxid", oxDb::getDb()->getOne( "select oxid from oxwrapping" ) );
        oxTestModules::addFunction('oxarticle', 'isDerived', '{ return true; }');

        // testing..
        $oView = new Wrapping_Main();
        $this->assertEquals( 'wrapping_main.tpl', $oView->render() );

        $aViewData = $oView->getViewData();
        $this->assertTrue( isset( $aViewData['edit'] ) );
        $this->assertTrue( $aViewData['edit'] instanceof oxwrapping );
    }

    /**
     * Wrapping_Main::Render() test case
     *
     * @return null
     */
    public function testRenderNoRealObjectId()
    {
        modConfig::setParameter( "oxid", "-1" );

        // testing..
        $oView = new Wrapping_Main();
        $this->assertEquals( 'wrapping_main.tpl', $oView->render() );

        $aViewData = $oView->getViewData();
        $this->assertFalse( isset( $aViewData['edit'] ) );
        $this->assertEquals( "-1", $aViewData['oxid'] );
    }

    /**
     * Wrapping_Main::Save() test case
     *
     * @return null
     */
    public function testSave()
    {
        oxTestModules::addFunction( 'oxwrapping', 'save', '{ throw new Exception( "save" ); }');

        // testing..
        try {
            $oView = new Wrapping_Main();
            $oView->save();
        } catch ( Exception $oExcp ) {
            $this->assertEquals( "save", $oExcp->getMessage(), "error in Wrapping_Main::save()" );
            return;
        }
        $this->fail( "error in Wrapping_Main::save()" );
    }

    /**
     * Wrapping_Main::Saveinnlang() test case
     *
     * @return null
     */
    public function testSaveinnlang()
    {
        oxTestModules::addFunction( 'oxwrapping', 'save', '{ throw new Exception( "save" ); }');

        // testing..
        try {
            $oView = new Wrapping_Main();
            $oView->saveinnlang();
        } catch ( Exception $oExcp ) {
            $this->assertEquals( "save", $oExcp->getMessage(), "error in Wrapping_Main::save()" );
            return;
        }
        $this->fail( "error in Wrapping_Main::save()" );
    }
}
