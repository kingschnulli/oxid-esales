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
class Unit_Views_accountPasswordTest extends OxidTestCase
{
    /**
     * Testing Account_Newsletter::changePassword()
     *
     * @return null
     */
    public function testChangePasswordNoUser()
    {
        $oView = $this->getMock( "Account_Password", array( "getUser" ) );
        $oView->expects( $this->any() )->method( 'getUser')->will( $this->returnValue( false ) );
        $this->assertNull( $oView->changePassword() );
        $this->assertFalse( $oView->isPasswordChanged() );
        $this->assertFalse( $oView->isPasswordChanged() );
    }

    /**
     * Testing Account_Newsletter::changePassword()
     *
     * @return null
     */
    public function testChangePasswordEmptyNewPass()
    {
        oxTestModules::addFunction( 'oxUtilsView', 'addErrorToDisplay', '{ return "EXCEPTION_INPUT_EMPTYPASS"; }' );

        $oUser = $this->getMock( "oxStdClass", array( "checkPassword" ) );
        $oUser->expects( $this->any() )->method( 'checkPassword')->will( $this->throwException( new Exception( "EXCEPTION_INPUT_EMPTYPASS" ) ) );

        $oView = $this->getMock( "Account_Password", array( "getUser" ) );
        $oView->expects( $this->any() )->method( 'getUser')->will( $this->returnValue( $oUser ) );
        $this->assertEquals( "EXCEPTION_INPUT_EMPTYPASS", $oView->changePassword() );
        $this->assertFalse( $oView->isPasswordChanged() );
    }

    /**
     * Testing Account_Newsletter::changePassword()
     *
     * @return null
     */
    public function testChangePasswordTooShortNewPass()
    {
        oxTestModules::addFunction( 'oxUtilsView', 'addErrorToDisplay', '{ return "EXCEPTION_INPUT_PASSTOOSHORT"; }' );

        $oUser = $this->getMock( "oxStdClass", array( "checkPassword" ) );
        $oUser->expects( $this->any() )->method( 'checkPassword')->will( $this->throwException( new Exception( "EXCEPTION_INPUT_PASSTOOSHORT" ) ) );

        $oView = $this->getMock( "Account_Password", array( "getUser" ) );
        $oView->expects( $this->any() )->method( 'getUser')->will( $this->returnValue( $oUser ) );
        $this->assertEquals( "EXCEPTION_INPUT_PASSTOOSHORT", $oView->changePassword() );
        $this->assertFalse( $oView->isPasswordChanged() );
    }

    /**
     * Testing Account_Newsletter::changePassword()
     *
     * @return null
     */
    public function testChangePasswordPasswordsDoNotMatch()
    {
        oxTestModules::addFunction( 'oxUtilsView', 'addErrorToDisplay', '{ return "ACCOUNT_PASSWORD_ERRPASSWDONOTMATCH"; }' );

        $oUser = $this->getMock( "oxStdClass", array( "checkPassword" ) );
        $oUser->expects( $this->any() )->method( 'checkPassword')->will( $this->throwException( new Exception( "ACCOUNT_PASSWORD_ERRPASSWDONOTMATCH" ) ) );

        $oView = $this->getMock( "Account_Password", array( "getUser" ) );
        $oView->expects( $this->any() )->method( 'getUser')->will( $this->returnValue( $oUser ) );
        $this->assertEquals( "ACCOUNT_PASSWORD_ERRPASSWDONOTMATCH", $oView->changePassword() );
        $this->assertFalse( $oView->isPasswordChanged() );
    }

    /**
     * Testing Account_Newsletter::changePassword()
     *
     * @return null
     */
    public function testChangePasswordMissingOldPass()
    {
        modConfig::setParameter( 'password_old', null );
        oxTestModules::addFunction( 'oxUtilsView', 'addErrorToDisplay', '{ return "ACCOUNT_PASSWORD_ERRINCORRECTCURRENTPASSW"; }' );

        $oUser = $this->getMock( "oxStdClass", array( "checkPassword", "isSamePassword" ) );
        $oUser->expects( $this->any() )->method( 'checkPassword');
        $oUser->expects( $this->any() )->method( 'isSamePassword')->will( $this->returnValue( false ));

        $oView = $this->getMock( "Account_Password", array( "getUser" ) );
        $oView->expects( $this->any() )->method( 'getUser')->will( $this->returnValue( $oUser ) );
        $this->assertEquals( "ACCOUNT_PASSWORD_ERRINCORRECTCURRENTPASSW", $oView->changePassword() );
        $this->assertFalse( $oView->isPasswordChanged() );
    }

    /**
     * Testing Account_Newsletter::changePassword()
     *
     * @return null
     */
    public function testChangePassword()
    {
        modConfig::setParameter( 'password_old', "oldpassword" );
        modConfig::setParameter( 'password_new', "newpassword" );
        modConfig::setParameter( 'password_new_confirm', "newpassword" );

        $oUser = $this->getMock( "oxStdClass", array( "checkPassword", "isSamePassword", "setPassword", "save" ) );
        $oUser->expects( $this->any() )->method( 'checkPassword');
        $oUser->expects( $this->any() )->method( 'isSamePassword' )->with( $this->equalTo( "oldpassword" ) )->will( $this->returnValue( true ) ) ;
        $oUser->expects( $this->any() )->method( 'setPassword' )->with( $this->equalTo( "newpassword" ) );
        $oUser->expects( $this->any() )->method( 'save' )->will( $this->returnValue( true ) ) ;

        $oView = $this->getMock( "Account_Password", array( "getUser" ) );
        $oView->expects( $this->any() )->method( 'getUser')->will( $this->returnValue( $oUser ) );
        $this->assertNull( $oView->changePassword() );
        $this->assertTrue( $oView->isPasswordChanged() );
    }

    /**
     * Testing Account_Newsletter::isPasswordChanged()
     *
     * @return null
     */
    public function testIsPasswordChanged()
    {
        $oView = $this->getProxyClass( "Account_Password" );
        $this->assertFalse( $oView->isPasswordChanged() );

        $oView->setNonPublicVar( "_blPasswordChanged", true );
        $this->assertTrue( $oView->isPasswordChanged() );
    }

    /**
     * Testing Account_Newsletter::hasPassword()
     *
     * @return null
     */
    public function testHasPassword()
    {
        $oView = $this->getMock( "Account_Password", array( "getUser" ) );
        $oView->expects( $this->any() )->method( 'getUser')->will( $this->returnValue( false ) );
        $this->assertTrue( $oView->hasPassword() );

        $oUser = new oxStdClass();
        $oUser->oxuser__oxisopenid = new oxField( 1 );
        $oUser->oxuser__oxpassword = new oxField( "openid_something" );

        $oView = $this->getMock( "Account_Password", array( "getUser" ) );
        $oView->expects( $this->any() )->method( 'getUser')->will( $this->returnValue( $oUser ) );
        $this->assertFalse( $oView->hasPassword() );
    }

    /**
     * Testing Account_Newsletter::render()
     *
     * @return null
     */
    public function testRenderNoUser()
    {
        $oView = $this->getMock( "Account_Password", array( "getUser" ) );
        $oView->expects( $this->any() )->method( 'getUser')->will( $this->returnValue( false ) );
        $this->assertEquals( 'account_login.tpl', $oView->render() );
    }

    /**
     * Testing Account_Newsletter::render()
     *
     * @return null
     */
    public function testRender()
    {
        $oUser = new oxuser;
        $oUser->oxuser__oxpassword = new oxField( "testPassword" );

        $oView = $this->getMock( "Account_Password", array( "getUser" ) );
        $oView->expects( $this->any() )->method( 'getUser')->will( $this->returnValue( $oUser ) );
        $this->assertEquals( 'account_password.tpl', $oView->render() );
    }
}