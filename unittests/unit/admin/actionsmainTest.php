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
 * @version   SVN: $Id: actionsmainTest.php 26164 2010-03-02 09:29:44Z arvydas $
 */

require_once realpath( "." ).'/unit/OxidTestCase.php';
require_once realpath( "." ).'/unit/test_config.inc.php';

/**
 * Tests for Actions_Main class
 */
class Unit_Admin_ActionsMainTest extends OxidTestCase
{
    /**
     * Actions_Main::Render() test case
     *
     * @return null
     */
    public function testRender()
    {
        modConfig::setParameter( "oxid", -1 );
        modConfig::setParameter( "saved_oxid", -1 );

        // testing..
        $oView = new Actions_Main();
        $sTplName = $oView->render();

        // testing view data
        $aViewData = $oView->getViewData();
        $this->assertEquals( '-1', $aViewData["oxid"] );
        $this->assertEquals( '1', $aViewData["updatelist"] );
        $this->assertEquals( "actions_main.tpl", $sTplName );
    }

    /**
     * Actions_Main::Render() test case
     *
     * @return null
     */
    public function testRenderWithExistingAction()
    {
        modConfig::setParameter( "oxid", oxDb::getDb()->getOne( "select oxid from oxactions" ) );

        // testing..
        $oView = $this->getMock( "Actions_Main", array( "_getCategoryTree" ) );
        $oView->expects( $this->any() )->method( '_getCategoryTree' )->will( $this->returnValue( false ) );
        $sTplName = $oView->render();

        // testing view data
        $aViewData = $oView->getViewData();
        $this->assertNotNull( $aViewData["edit"] );
        $this->assertEquals( "actions_main.tpl", $sTplName );
    }

    /**
     * Actions_Main::Save() test case
     *
     * @return null
     */
    public function testSave()
    {
        oxTestModules::addFunction('oxactions', 'load', '{ return true; }');
        oxTestModules::addFunction('oxactions', 'save', '{ return true; }');

        modConfig::setParameter( "oxid", "xxx" );
        modConfig::setParameter( "editval", array( "xxx" ) );
        modConfig::getInstance()->setConfigParam( "blAllowSharedEdit", true );

        $oView = new Actions_Main();
        $oView->save();

        $aViewData = $oView->getViewData();
        $this->assertTrue( isset( $aViewData["updatelist"] ) );
        $this->assertEquals( 1, $aViewData["updatelist"] );

    }

    /**
     * Actions_Main::Saveinnlang() test case
     *
     * @return null
     */
    public function testSaveinnlang()
    {
        $oView = $this->getMock( "Actions_Main", array( "save" ) );
        $oView->expects( $this->once() )->method( "save" );
        $oView->saveinnlang();
    }

}