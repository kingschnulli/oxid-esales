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
 * @copyright (C) OXID eSales AG 2003-2012
 * @version OXID eShop CE
 * @version   SVN: $Id: usermainTest.php 33190 2011-02-10 15:56:27Z arvydas.vapsva $
 */

require_once realpath( "." ).'/unit/OxidTestCase.php';
require_once realpath( "." ).'/unit/test_config.inc.php';

/**
 * Tests for User_Main class
 */
class Unit_Admin_UserMainTest extends OxidTestCase
{
    /**
     * User_Main::Render() test case
     *
     * @return null
     */
    public function testRender()
    {
        oxTestModules::addFunction( 'oxuser', 'loadAdminUser', '{ $this->oxuser__oxrights = new oxField( "malladmin" ); return; }' );
        modConfig::setParameter( "oxid", "oxdefaultadmin" );

        // testing..
        $oView = new User_Main();
        $this->assertEquals( 'user_main.tpl', $oView->render() );

        $aViewData = $oView->getViewData();
        $this->assertTrue( isset( $aViewData['countrylist'] ) );
        $this->assertTrue( isset( $aViewData['rights'] ) );
        $this->assertTrue( isset( $aViewData['edit'] ) );
        $this->assertTrue( $aViewData['edit'] instanceof oxuser );
    }

    /**
     * UserGroup_Main::Render() test case
     *
     * @return null
     */
    public function testRenderNoRealObjectId()
    {
        oxTestModules::addFunction( 'oxuser', 'loadAdminUser', '{ $this->oxuser__oxrights = new oxField( "malladmin" ); return; }' );
        modConfig::setParameter( "oxid", "-1" );

        // testing..
        $oView = new User_Main();
        $this->assertEquals( 'user_main.tpl', $oView->render() );

        $aViewData = $oView->getViewData();
        $this->assertTrue( isset( $aViewData['oxid'] ) );
        $this->assertEquals( "-1", $aViewData['oxid'] );
    }

    /**
     * User_Main::Save() test case
     *
     * @return null
     */
    public function testSave()
    {
        modConfig::setParameter( "oxid", "-1" );

        oxTestModules::addFunction( 'oxuser', 'load', '{ return true; }' );
        oxTestModules::addFunction( 'oxuser', 'save', '{ return true; }' );
        oxTestModules::addFunction( 'oxuser', 'setPassword', '{ return true; }' );
        oxTestModules::addFunction( 'oxuser', 'checkIfEmailExists', '{ return false; }' );
        oxTestModules::addFunction( 'oxuser', 'assign', '{ return true; }' );
        oxTestModules::addFunction( 'oxuser', 'getId', '{ return "testId"; }' );

        $aTasks = array( "_allowAdminEdit" );

        $oView = $this->getMock( "User_Main", $aTasks );
        $oView->expects( $this->once() )->method( '_allowAdminEdit' )->will( $this->returnValue( true ) );
        $oView->save();

        $this->assertEquals( "1", $oView->getViewDataElement( "updatelist" ) );
    }

    /**
     * User_Main::Save() test case
     *
     * @return null
     */
    public function testSaveExceptionDuringSave()
    {
        modConfig::setParameter( "oxid", "-1" );

        oxTestModules::addFunction( 'oxuser', 'load', '{ return true; }' );
        oxTestModules::addFunction( 'oxuser', 'save', '{ throw new Exception("save"); }' );
        oxTestModules::addFunction( 'oxuser', 'setPassword', '{ return true; }' );
        oxTestModules::addFunction( 'oxuser', 'checkIfEmailExists', '{ return false; }' );
        oxTestModules::addFunction( 'oxuser', 'assign', '{ return true; }' );
        oxTestModules::addFunction( 'oxuser', 'getId', '{ return "testId"; }' );

        $aTasks = array( "_allowAdminEdit" );

        $oView = $this->getMock( "User_Main", $aTasks );
        $oView->expects( $this->atLeastOnce() )->method( '_allowAdminEdit' )->will( $this->returnValue( true ) );
        $oView->save();
        $oView->render();

        $this->assertEquals( "save", $oView->getViewDataElement( "sSaveError" ) );
    }

    /**
     * User_Main::Save() test case
     *
     * @return null
     */
    public function testSaveDublicatedLogin()
    {
        oxTestModules::addFunction( 'oxuser', 'load', '{ return true; }' );
        oxTestModules::addFunction( 'oxuser', 'save', '{ return true; }' );
        oxTestModules::addFunction( 'oxuser', 'setPassword', '{ return true; }' );
        oxTestModules::addFunction( 'oxuser', 'checkIfEmailExists', '{ return true; }' );

        $aTasks = array( "_allowAdminEdit" );

        $oView = $this->getMock( "User_Main", $aTasks );
        $oView->expects( $this->atLeastOnce() )->method( '_allowAdminEdit' )->will( $this->returnValue( true ) );
        $oView->save();
        $oView->render();

        $this->assertEquals( "EXCEPTION_USER_USEREXISTS", $oView->getViewDataElement( "sSaveError" ) );
    }
}
