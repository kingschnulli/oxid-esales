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
 * @version   SVN: $Id: registerTest.php 26841 2010-03-25 13:58:15Z arvydas $
 */

require_once realpath( "." ).'/unit/OxidTestCase.php';
require_once realpath( "." ).'/unit/test_config.inc.php';

class Unit_Views_registerTest extends OxidTestCase
{
    public function testGetRegistrationError()
    {
        $oRegister = $this->getProxyClass( 'register' );
        modConfig::setParameter( 'newslettererror', 'testError' );

        $this->assertEquals( 'testError', $oRegister->getRegistrationError() );
    }

    public function testGetRegistrationStatus()
    {
        $oRegister = $this->getProxyClass( 'register' );
        modConfig::setParameter( 'success', 'success' );

        $this->assertEquals( 'success', $oRegister->getRegistrationStatus() );
    }

    /**
     * Testing if method returns correct value
     *
     * @return null
     */
    public function testIsFieldRequired()
    {
        $oRegister = $this->getMock( 'register', array( 'getMustFillFields' ) );
        $oRegister->expects( $this->any() )->method( 'getMustFillFields' )->will( $this->returnValue( array("testValue1"=>1, "testValue2"=>1) ) );

        $this->assertTrue( $oRegister->isFieldRequired("testValue1") );
        $this->assertFalse( $oRegister->isFieldRequired("testValue5") );
    }

    public function testRenderNoRStat()
    {
        $oRegister = $this->getMock( 'register', array( 'getRegistrationStatus', 'getMustFillFields' ) );
        $oRegister->expects( $this->once() )->method( 'getRegistrationStatus' )->will( $this->returnValue( false ) );
        $oRegister->expects( $this->any() )->method( 'getMustFillFields' )->will( $this->returnValue( 'xaMustFillFields' ) );

        $this->assertEquals('register.tpl', $oRegister->render() );
        $oVD = $oRegister->getViewData();
        $this->assertEquals('xaMustFillFields', $oVD['aMustFillFields'] );

    }

    public function testRenderRStat()
    {
        $oRegister = $this->getMock( 'register', array( 'getRegistrationStatus', 'getRegistrationError' ) );
        $oRegister->expects( $this->exactly(2) )->method( 'getRegistrationStatus' )->will( $this->returnValue( 'rst' ) );
        $oRegister->expects( $this->once() )->method( 'getRegistrationError' )->will( $this->returnValue( 'rer' ) );

        $this->assertEquals('register_success.tpl', $oRegister->render() );
        $oVD = $oRegister->getViewData();
        $this->assertEquals('rst', $oVD['success'] );
        $this->assertEquals('rer', $oVD['error'] );
    }

    public function testGetDelAddress()
    {

        $oDelAddr = $this->getMock( 'stdclass', array( 'load' ) );
        $oDelAddr->expects( $this->once() )->method( 'load' )->with( $this->equalTo( 'xsAddressId' ) );
        $oUser = $this->getMock( 'stdclass', array( 'getSelectedAddress' ) );
        $oUser->expects( $this->once() )->method( 'getSelectedAddress' )->will( $this->returnValue( 'xsAddressId' ) );
        $oRegister = $this->getMock( 'register', array( 'getUser' ) );
        $oRegister->expects( $this->once() )->method( 'getUser' )->will( $this->returnValue( $oUser ) );
        oxTestModules::addModuleObject('oxaddress', $oDelAddr);

        $this->assertSame($oDelAddr, $oRegister->getDelAddress() );
    }


    public function testAddFakeAddress()
    {
        $oRegister = new register;

        $this->assertSame(null, $oRegister->UNITaddFakeAddress('asd') );
    }
}