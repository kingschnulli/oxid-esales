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
 * @version   SVN: $Id: accountTest.php 25505 2010-02-02 02:12:13Z alfonsas $
 */

require_once realpath( "." ).'/unit/OxidTestCase.php';
require_once realpath( "." ).'/unit/test_config.inc.php';

/**
 * Tests for Account class
 */
class Unit_Views_accountUserTest extends OxidTestCase
{
    /**
     * Testing Account_User::render()
     *
     * @return null
     */
    public function testRenderNoUser()
    {
        $oView = $this->getMock( "Account_User", array( "getUser" ) );
        $oView->expects( $this->any() )->method( 'getUser')->will( $this->returnValue( false ) );
        $this->assertEquals( 'account_login.tpl', $oView->render() );
    }

    /**
     * Testing Account_User::render()
     *
     * @return null
     */
    public function testRender()
    {
        $oUser = new oxuser;
        $oUser->oxuser__oxpassword = new oxField( "testPassword" );

        $oView = $this->getMock( "Account_User", array( "getUser" ) );
        $oView->expects( $this->any() )->method( 'getUser')->will( $this->returnValue( $oUser ) );
        $this->assertEquals( 'account_user.tpl', $oView->render() );
    }

    /**
     * Testing Account_User::getCountryList()
     *
     * @return null
     */
    public function testGetCountryList()
    {
        $oView = new Account_User();
        $this->assertTrue( $oView->getCountryList() instanceof oxcountrylist );
    }

    /**
     * Testing Account_User::getDeliverAddress()
     *
     * @return null
     */
    public function testGetDeliverAddressNoUser()
    {
        $oView = $this->getMock( "Account_User", array( "getUser" ) );
        $oView->expects( $this->any() )->method( 'getUser')->will( $this->returnValue( false ) );
        $this->assertNull( $oView->getDeliverAddress() );
    }

    /**
     * Testing Account_User::getDeliverAddress()
     *
     * @return null
     */
    public function testGetDeliverAddressFoundSelectedAddress()
    {
        $oAddress1 = new oxAddress();
        $oAddress1->selected = 0;

        $oAddress2 = new oxAddress();
        $oAddress2->selected = 1;

        $oAddressList = new oxList();
        $oAddressList->offsetSet( "1", $oAddress1 );
        $oAddressList->offsetSet( "2", $oAddress2 );

        $oUser = $this->getMock( "oxStdClass", array( "getUserAddresses" ) );
        $oUser->expects( $this->once() )->method( 'getUserAddresses')->will( $this->returnValue( $oAddressList ) );

        $oView = $this->getMock( "Account_User", array( "getUser" ) );
        $oView->expects( $this->any() )->method( 'getUser')->will( $this->returnValue( $oUser ) );
        $this->assertEquals( $oAddress2, $oView->getDeliverAddress() );
    }

    /**
     * Testing Account_User::getDeliverAddress()
     *
     * @return null
     */
    public function testGetDeliverAddressTakingFirlsFromList()
    {
        $oAddress1 = new oxAddress();
        $oAddress1->selected = 0;

        $oAddress2 = new oxAddress();
        $oAddress2->selected = 0;

        $oAddressList = new oxList();
        $oAddressList->offsetSet( "1", $oAddress1 );
        $oAddressList->offsetSet( "2", $oAddress2 );

        $oUser = $this->getMock( "oxStdClass", array( "getUserAddresses" ) );
        $oUser->expects( $this->once() )->method( 'getUserAddresses')->will( $this->returnValue( $oAddressList ) );

        $oView = $this->getMock( "Account_User", array( "getUser" ) );
        $oView->expects( $this->any() )->method( 'getUser')->will( $this->returnValue( $oUser ) );
        $this->assertEquals( $oAddress1, $oView->getDeliverAddress() );
    }
}