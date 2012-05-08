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
 * @version   SVN: $Id: oxcaptchaTest.php 42936 2012-03-16 10:49:46Z linas.kukulskis $
 */

require_once realpath( "." ).'/unit/OxidTestCase.php';
require_once realpath( "." ).'/unit/test_config.inc.php';

class Unit_Core_oxcaptchaTest extends OxidTestCase
{

    protected $_oCaptcha = null;

    public function setup()
    {
        parent::setUp();

        $this->_oCaptcha = $this->getProxyClass('oxCaptcha');
    }

    /**
     * oxCaptcha::getText() test case
     *
     * @return null
     */
    public function testGetText()
    {
        $this->assertNull( $this->_oCaptcha->getNonPublicVar('_sText'));
        $sText = $this->_oCaptcha->getText();
        $this->assertEquals($sText, $this->_oCaptcha->getNonPublicVar('_sText'));
        $this->assertEquals(5, strlen($sText));
    }

    /**
     * oxCaptcha::getTextHash() test case
     *
     * @return null
     */
    public function testGetTextHash()
    {
         $this->assertEquals('c4b961848aeff4d9b083fe15a56c9bd0', $this->_oCaptcha->getTextHash( "test1" ));
    }

    /**
     * oxCaptcha::getHash() test case
     *
     * @return null
     */
    public function testGetHashNoSession()
    {
        $oSession = $this->getMock( "oxSession", array( "isSessionStarted" ) );
        $oSession->expects( $this->once() )->method( 'isSessionStarted' )->will( $this->returnValue( false ) );

        $oCaptcha = $this->getMock( "oxCaptcha", array( "getSession" ) );
        $oCaptcha->expects( $this->once() )->method( 'getSession' )->will( $this->returnValue( $oSession ) );

        $sHash = $oCaptcha->getHash( 'test' );
        $this->assertEquals( oxDb::getDb()->getOne( "select LAST_INSERT_ID()" ), $sHash );
    }

    /**
     * oxCaptcha::getHash() test case
     *
     * @return null
     */
    public function testGetHashSession()
    {
        $oSession = $this->getMock( "oxSession", array( "isSessionStarted" ) );
        $oSession->expects( $this->once() )->method( 'isSessionStarted' )->will( $this->returnValue( true ) );

        $oCaptcha = $this->getMock( "oxCaptcha", array( "getSession" ) );
        $oCaptcha->expects( $this->once() )->method( 'getSession' )->will( $this->returnValue( $oSession ) );
        $sHash = $oCaptcha->getHash( 'test' );

        $aCaptchaHash = oxSession::getVar( "aCaptchaHash" );
        $this->assertNotNull( $aCaptchaHash );
        $this->assertTrue( isset( $aCaptchaHash[$sHash] ) );
    }

    /**
     * oxCaptcha::getImageUrl() test case
     *
     * @return null
     */
    public function testGetImageUrl()
    {
        $this->_oCaptcha->setNonPublicVar('_sText', 'test1');
        $this->assertEquals(modConfig::getInstance()->getShopUrl()."core/utils/verificationimg.php?e_mac=ox_BBpTRzc0AU8u", $this->_oCaptcha->getImageUrl());
    }

    /**
     * oxCaptcha::isImageVisible() test case
     *
     * @return null
     */
    public function testIsImageVisible()
    {
        $this->assertTrue($this->_oCaptcha->isImageVisible());
    }

    /**
     * oxCaptcha::isImageVisible() test case
     *
     * @return null
     */
    public function testIsImageVisibleLowGD()
    {
        modConfig::getInstance()->setConfigParam('iUseGDVersion', 0);
        $this->assertFalse($this->_oCaptcha->isImageVisible());
    }

    /**
     * oxCaptcha::pass() test case
     *
     * @return null
     */
    public function testDbPassCorrect()
    {
        $oCaptcha = $this->getMock( "oxCaptcha", array( "_passFromSession" ) );
        $oCaptcha->expects( $this->once() )->method( '_passFromSession' )->will( $this->returnValue( null ) );

        $oCaptcha->getHash( '3at8u' );
        $sHash = oxDb::getDb()->getOne( "select LAST_INSERT_ID()" );
        $this->assertTrue( $oCaptcha->pass('3at8u', $sHash ) );
    }

    /**
     * oxCaptcha::pass() test case
     *
     * @return null
     */
    public function testDbPassFail()
    {
        $oCaptcha = $this->getMock( "oxCaptcha", array( "_passFromSession" ) );
        $oCaptcha->expects( $this->once() )->method( '_passFromSession' )->will( $this->returnValue( null ) );

        $this->assertFalse( $oCaptcha->pass('3at8v', 'd9a470912b222133fb913da36c0f50d0' ) );
    }

    /**
     * oxCaptcha::pass() test case
     *
     * @return null
     */
    public function testSessionPassCorrect()
    {
        $sMac = '3at8u';
        $sHash = 1234;

        $oCaptcha = new oxCaptcha();
        modSession::getInstance()->setVar( "aCaptchaHash", array( $sHash => array( $oCaptcha->getTextHash( $sMac ) => time() + 3600 ) ) );

        $oCaptcha = $this->getMock( "oxCaptcha", array( "_passFromDb" ) );
        $oCaptcha->expects( $this->never() )->method( '_passFromDb' );
        $this->assertTrue( $oCaptcha->pass( $sMac, $sHash ) );
    }

    /**
     * oxCaptcha::pass() test case
     *
     * @return null
     */
    public function testSessionPassFail()
    {
        modSession::getInstance()->setVar( "aCaptchaHash", array( "testHash" => array( "testTextHash" => 132 ) ) );

        $oCaptcha = $this->getMock( "oxCaptcha", array( "_passFromDb" ) );
        $oCaptcha->expects( $this->never() )->method( '_passFromDb' );

        $this->assertFalse( $oCaptcha->pass( '3at8v', 'd9a470912b222133fb913da36c0f50d0' ) );
    }
}
