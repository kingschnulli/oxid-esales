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
 * @version   SVN: $Id: userextendTest.php 26266 2010-03-04 08:26:07Z arvydas $
 */

require_once realpath( "." ).'/unit/OxidTestCase.php';
require_once realpath( "." ).'/unit/test_config.inc.php';

/**
 * Tests for User_Extend class
 */
class Unit_Admin_UserExtendTest extends OxidTestCase
{
    /**
     * User_Extend::Render() test case
     *
     * @return null
     */
    public function testRender()
    {
        modConfig::setParameter( "oxid", "oxdefaultadmin" );

        // testing..
        $oView = $this->getMock( "User_Extend", array( "_allowAdminEdit" ) );
        $oView->expects( $this->once() )->method( '_allowAdminEdit' )->will( $this->returnValue( false ) );
        $this->assertEquals( 'user_extend.tpl', $oView->render() );
        $aViewData = $oView->getViewData();
        $this->assertTrue( isset( $aViewData['edit'] ) );
        $this->assertTrue( $aViewData['edit'] instanceof oxuser );
        $this->assertTrue( isset( $aViewData['readonly'] ) );
        $this->assertTrue( $aViewData['readonly'] );
    }

    /**
     * User_Extend::Save() test case
     *
     * @return null
     */
    public function testSave()
    {
        // testing..
        oxTestModules::addFunction( 'oxuser', 'load', '{ return true; }');
        oxTestModules::addFunction( 'oxuser', 'assign', '{ return true; }');
        oxTestModules::addFunction( 'oxuser', 'save', '{ throw new Exception( "save" ); }');

        oxTestModules::addFunction( 'oxnewssubscribed', 'loadFromUserId', '{ return true; }');
        oxTestModules::addFunction( 'oxnewssubscribed', 'setOptInStatus', '{ return true; }');
        oxTestModules::addFunction( 'oxnewssubscribed', 'setOptInEmailStatus', '{ return true; }');

        modConfig::setParameter( "oxid", "testId" );
        modConfig::setParameter( "editnews", "1" );
        modConfig::setParameter( "editval", array( "oxaddress__oxid" => "testOxId" ) );

        // testing..
        try {
            $oView = $this->getMock( "User_Extend", array( "_allowAdminEdit") );
            $oView->expects( $this->at( 0 ) )->method( '_allowAdminEdit' )->with( $this->equalTo( "testId" ) )->will( $this->returnValue( true ) );
            $oView->save();
        } catch ( Exception $oExcp ) {
            $this->assertEquals( "save", $oExcp->getMessage(), "Error in User_Extend::save()");
            return;
        }
        $this->fail( "Error in User_Extend::save()");
    }
}
