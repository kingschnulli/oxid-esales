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
 * @version   SVN: $Id: actionsmainTest.php 48555 2012-08-11 19:42:45Z vilma $
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
        $this->setRequestParam( "oxid", -1 );

        // testing..
        $oView = new Actions_Main();
        $sTplName = $oView->render();

        // testing view data
        $aViewData = $oView->getViewData();
        $this->assertEquals( '-1', $aViewData["oxid"] );
        $this->assertEquals( "actions_main.tpl", $sTplName );
    }

    /**
     * Actions_Main::Render() test case
     *
     * @return null
     */
    public function testRenderWithExistingAction()
    {
        $this->setRequestParam( "oxid", oxDb::getDb()->getOne( "select oxid from oxactions" ) );

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

        $this->setRequestParam( "oxid", "xxx" );
        $this->setRequestParam( "editval", array( "xxx" ) );
        $this->setConfigParam( "blAllowSharedEdit", true );

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

    /**
     * Actions_Main::Render() test case
     *
     * @return null
     */
    public function testPromotionsRender()
    {
        $this->setRequestParam( "oxid", -1 );
        $this->setRequestParam( "saved_oxid", -1 );

        $oPromotion = new oxActions();
        $oPromotion->oxactions__oxtype = new oxField( 2 );

        // testing..
        $oView = $this->getMock( "Actions_Main", array( "getViewDataElement", "_generateTextEditor" ) );
        $oView->expects( $this->once() )->method( 'getViewDataElement' )->with( $this->equalTo( "edit") )->will( $this->returnValue( $oPromotion ));
        $oView->expects( $this->once() )->method( '_generateTextEditor' )->with( $this->equalTo( "100%" ), $this->equalTo( 300 ), $this->equalTo( $oPromotion ), $this->equalTo( "oxactions__oxlongdesc" ), $this->equalTo( "details.tpl.css" ) );

        $sTplName = $oView->render();

        // testing view data
        $aViewData = $oView->getViewData();
        $this->assertEquals( '-1', $aViewData["oxid"] );
        $this->assertEquals( "actions_main.tpl", $sTplName );
    }

    /**
     * Actions_Main::Save() test case
     *
     * @return null
     */
    public function testPromotionsSave()
    {
        oxTestModules::addFunction('oxactions', 'load', '{ return true; }');
        oxTestModules::addFunction('oxactions', 'save', '{ return true; }');

        $this->setRequestParam( "oxid", "xxx" );
        $this->setRequestParam( "editval", array( "xxx" ) );
        $this->setConfigParam( "blAllowSharedEdit", true );

        $oView = new Actions_Main();
        $oView->save();

        $aViewData = $oView->getViewData();
        $this->assertTrue( isset( $aViewData["updatelist"] ) );
        $this->assertEquals( 1, $aViewData["updatelist"] );
        $this->assertNull( oxSession::getVar( "saved_oxid" ) );
    }

    /**
     * Actions_Main::Save() test case
     *
     * @return null
     */
    public function testSaveInsertingNewPromo()
    {
        oxTestModules::addFunction('oxactions', 'load', '{ return true; }');
        oxTestModules::addFunction('oxactions', 'save', '{ return true; }');
        oxTestModules::addFunction('oxactions', 'getId', '{ return "testId"; }');

        $this->setRequestParam( "oxid", "-1" );
        $this->setRequestParam( "editval", array( "xxx" ) );
        $this->setConfigParam( "blAllowSharedEdit", true );

        $oView = new Actions_Main();
        $oView->save();

        $aViewData = $oView->getViewData();
        $this->assertTrue( isset( $aViewData["updatelist"] ) );
        $this->assertEquals( 1, $aViewData["updatelist"] );
    }

}
