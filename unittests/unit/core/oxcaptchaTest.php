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
 * @version   SVN: $Id: oxcaptchaTest.php 36093 2011-06-08 14:59:33Z arvydas.vapsva $
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

    public function testGetText()
    {
        $this->assertNull($this->_oCaptcha->getNonPublicVar('_sText'));
        $sText = $this->_oCaptcha->getText();
        $this->assertEquals($sText, $this->_oCaptcha->getNonPublicVar('_sText'));
        $this->assertEquals(5, strlen($sText));
    }

    public function testGetTextHash()
    {
         $this->assertEquals('c4b961848aeff4d9b083fe15a56c9bd0', $this->_oCaptcha->getTextHash( "test1" ));
    }

    public function testGetHash()
    {
        $sHash = $this->_oCaptcha->getHash( 'test' );
        $this->assertEquals( oxDb::getDb()->getOne( "select LAST_INSERT_ID()" ), $sHash );
    }

    public function testGetImageUrl()
    {
        $this->_oCaptcha->setNonPublicVar('_sText', 'test1');
        $this->assertEquals(modConfig::getInstance()->getShopUrl()."core/utils/verificationimg.php?e_mac=ox_DRMOFldVAkJE", $this->_oCaptcha->getImageUrl());
    }

    public function testIsImageVisible()
    {
        $this->assertTrue($this->_oCaptcha->isImageVisible());
    }

    public function testIsImageVisibleLowGD()
    {
        modConfig::getInstance()->setConfigParam('iUseGDVersion', 0);
        $this->assertFalse($this->_oCaptcha->isImageVisible());
    }

    public function testPassCorrect()
    {
        $this->_oCaptcha->getHash( '3at8u' );
        $sHash = oxDb::getDb()->getOne( "select LAST_INSERT_ID()" );
        $this->assertTrue($this->_oCaptcha->pass('3at8u', $sHash ) );
    }

    public function testPassFail()
    {
        $this->assertFalse($this->_oCaptcha->pass('3at8v', 'd9a470912b222133fb913da36c0f50d0'));
    }
}
