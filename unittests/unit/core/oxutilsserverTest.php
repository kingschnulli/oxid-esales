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
 * @version   SVN: $Id: oxutilsserverTest.php 26841 2010-03-25 13:58:15Z arvydas $
 */

require_once realpath( "." ).'/unit/OxidTestCase.php';
require_once realpath( "." ).'/unit/test_config.inc.php';

class Unit_Core_oxUtilsServerTest extends OxidTestCase
{
    /**
     * Tear down the fixture.
     *
     * @return null
     */
    protected function tearDown()
    {
        oxConfig::getInstance()->setConfigParam( "aTrustedIPs", array() );
        parent::tearDown();
    }
    public function testIsTrustedClientIp()
    {
        $oUtilsServer = new oxUtilsServer();
        $this->assertFalse( $oUtilsServer->isTrustedClientIp() );

        //
        oxConfig::getInstance()->setConfigParam( "aTrustedIPs", array( "xxx" ));
        $oUtilsServer = $this->getMock( "oxUtilsServer", array( "getRemoteAddress" ));
        $oUtilsServer->expects( $this->once() )->method( 'getRemoteAddress' )->will( $this->returnValue( "xxx" ) );
        $this->assertTrue( $oUtilsServer->isTrustedClientIp() );
    }

    public function testGetCookiePathWhenACookiePathsIsSetUp()
    {
        $sShopId = oxConfig::getInstance()->getShopId();
        modConfig::getInstance()->setConfigParam( "aCookiePaths", array( $sShopId => 'somepath' ) );

        $oUtilsServer = new oxUtilsServer();
        $this->assertEquals( 'somepath', $oUtilsServer->UNITgetCookiePath( "" )  );
    }

    public function testGetCookieDomainWhenACookieDomainsIsSetUp()
    {
        $sShopId = oxConfig::getInstance()->getShopId();
        modConfig::getInstance()->setConfigParam( "aCookieDomains", array( $sShopId => 'somedomain' ) );

        $oUtilsServer = new oxUtilsServer();
        $this->assertEquals( 'somedomain', $oUtilsServer->UNITgetCookieDomain( "" )  );
    }

    public function testGetCookiePath()
    {
        $oUtilsServer = new oxUtilsServer();
        $this->assertEquals( "xxx", $oUtilsServer->UNITgetCookiePath( "xxx" ) );
        $this->assertEquals( "", $oUtilsServer->UNITgetCookiePath( null ) );
    }

    public function testGetCookieDomain()
    {
        $oUtilsServer = new oxUtilsServer();
        $this->assertEquals( "xxx", $oUtilsServer->UNITgetCookieDomain( "xxx" ) );
        $this->assertEquals( "", $oUtilsServer->UNITgetCookieDomain( null ) );

        modConfig::getInstance()->setConfigParam( "sCookieDomain", "yyy" );
        $this->assertEquals( "yyy", $oUtilsServer->UNITgetCookieDomain( null ) );
    }

    public function testGetCookiePathUserDefinedPath()
    {
        $oUtilsServer = new oxUtilsServer();
        $this->assertEquals( 'xxxpath', $oUtilsServer->UNITgetCookiePath( 'xxxpath' ) );

        modConfig::getInstance()->setConfigParam( 'sCookiePath', 'yyypath' );
        $this->assertEquals( 'yyypath', $oUtilsServer->UNITgetCookiePath( 'xxxpath' ) );
    }

    /**
     * test is actually nonsense under unit testing
     * Reason: The testant immediately and explicitly returns on defined('OXID_PHP_UNIT')
     */
    public function testSetCookie()
    {
        $sName = "someName";
        $sValue = "someValue";
        $this->assertNull(oxUtilsServer::getInstance()->setOxCookie($sName, $sValue));
    }

    public function testGetCookie()
    {
        // $sName = null
      /*  $aCookie = oxUtilsServer::getInstance()->getOxCookie();
var_dump($_COOKIE);
var_dump($aCookie);
        $this->assertTrue((isset($aCookie) && ($aCookie[0] == null)));
        $this->assertNull(oxUtilsServer::getInstance()->getOxCookie('test'));*/

        $aC = $_COOKIE;
        $e = null;
        try {

            $_COOKIE['test'] = "asd'\"\000aa";
            $this->assertEquals("asd&#039;&quot;aa", oxUtilsServer::getInstance()->getOxCookie('test'));
        } catch (Exception $e) {
        }

        // restore data
        $_COOKIE = $aC;

        // check if exception has beed thrown
        if ($e) {
            throw $e;
        }
    }

    public function testGetRemoteAddress()
    {
        $sIP = '127.0.0.1';
        // in test mode, there are no remote adresses, thus null
        unset($_SERVER["HTTP_X_FORWARDED_FOR"]);
        unset($_SERVER["HTTP_CLIENT_IP"]);
        if (isset($_SERVER["REMOTE_ADDR"])) {
            $this->assertNull(oxUtilsServer::getInstance()->getRemoteAddress());
        } else {
            $_SERVER["REMOTE_ADDR"] = $sIP;
            $this->assertEquals(oxUtilsServer::getInstance()->getRemoteAddress(), $sIP);
        }

        $_SERVER["HTTP_X_FORWARDED_FOR"] = $sIP;
        $this->assertEquals(oxUtilsServer::getInstance()->getRemoteAddress(), $sIP);
        unset($_SERVER["HTTP_X_FORWARDED_FOR"]);
        $_SERVER["HTTP_CLIENT_IP"] = $sIP;
        $this->assertEquals(oxUtilsServer::getInstance()->getRemoteAddress(), $sIP);
        unset($_SERVER["HTTP_CLIENT_IP"]);
    }

    public function testGetRemoteAddressProxyUsage()
    {
        $sIP = '127.0.0.1';
        $sProxy = '127.5.4.4';
        // in test mode, there are no remote adresses, thus null
        $_SERVER["HTTP_X_FORWARDED_FOR"] = $sIP.','.$sProxy;
        $this->assertEquals(oxUtilsServer::getInstance()->getRemoteAddress(), $sIP);
        unset($_SERVER["HTTP_X_FORWARDED_FOR"]);
    }

    public function testGetServerVar()
    {
        $sName  = md5( uniqid() );
        $sValue = time();

        $_SERVER[$sName] = $sValue;;
        $this->assertEquals( $sValue, oxUtilsServer::getInstance()->getServerVar( $sName ) );
        $this->assertEquals( $_SERVER, oxUtilsServer::getInstance()->getServerVar() );
    }

    /**
     * Testing user cookie setter, getter and deletion functionality
     */
    public function testGetSetAndDeleteUserCookie()
    {
        oxTestModules::addFunction( "oxUtilsDate", "getTime", "{return 0;}" );

        $sCryptedVal = 'admin@@@' . crypt( 'admin', 'ox' );
        $oUtils = $this->getMock( 'oxutilsserver', array( 'setOxCookie', 'getOxCookie' ) );
        $oUtils->expects( $this->at( 1 ) )->method( 'setOxCookie' )->with( $this->equalTo( 'oxid_'.oxConfig::getInstance()->getShopId() ), $this->equalTo( $sCryptedVal ), $this->equalTo( 31536000 ), $this->equalTo( '/' ) );
        $oUtils->expects( $this->at( 2 ) )->method( 'setOxCookie' )->with( $this->equalTo( 'oxid_'.oxConfig::getInstance()->getShopId() ), $this->equalTo( '' ), $this->equalTo( - 3600 ), $this->equalTo( '/' ) );
        $oUtils->expects( $this->once() )->method( 'getOxCookie' )->with( $this->equalTo( 'oxid_'.oxConfig::getInstance()->getShopId() ) )->will( $this->returnValue( $sCryptedVal ) );

        $this->assertEquals( $sCryptedVal, $oUtils->getUserCookie() );
        $oUtils->setUserCookie( 'admin', 'admin' );
        $this->assertEquals( $sCryptedVal, $oUtils->getUserCookie() );
        $oUtils->deleteUserCookie();
        $this->assertNull( $oUtils->getUserCookie() );
    }
}
