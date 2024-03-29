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
 * @version   SVN: $Id: oxvatselectorTest.php 26841 2010-03-25 13:58:15Z arvydas $
 */

require_once realpath( "." ).'/unit/OxidTestCase.php';
require_once realpath( "." ).'/unit/test_config.inc.php';

/**
 * oxvatselector test
 */
class Unit_Core_oxtsproductTest extends OxidTestCase
{
    /**
     * Tests oxTsProduct::getAmount()
     *
     */
    public function testGetAmount()
    {
        $oSubj = $this->getProxyClass("oxTsProduct");
        $oSubj->setNonPublicVar('_sTsId', 'TS080501_500_30_EUR');
        $this->assertEquals( '500', $oSubj->getAmount() );
    }

    /**
     * Tests oxTsProduct::getFPrice()
     *
     */
    public function testGetFPrice()
    {
        modConfig::getInstance()->setConfigParam( 'blCalcVATForPayCharge', true );
        modConfig::getInstance()->setConfigParam( 'blEnterNetPrice', false );
        $oSubj = $this->getProxyClass("oxTsProduct");
        $oSubj->setNonPublicVar('_sTsId', 'TS080501_500_30_EUR');
        $this->assertEquals( '0,98', $oSubj->getFPrice() );
    }

    /**
     * Tests oxTsProduct::setTsId() and oxTsProduct::getTsId()
     *
     */
    public function testSetGetTsId()
    {
        $oSubj = $this->getMock( 'oxTsProduct', array( '_setDeprecatedValues' ) );
        $oSubj->expects( $this->once() )->method( '_setDeprecatedValues' );
        $oSubj->setTsId('TS080501_500_30_EUR');
        $this->assertEquals( 'TS080501_500_30_EUR', $oSubj->getTsId() );
    }

    /**
     * Tests oxTsProduct::testSetDeprecatedValues()
     *
     */
    public function testSetDeprecatedValues()
    {
        $oSubj = $this->getProxyClass("oxTsProduct");
        $oSubj->setNonPublicVar('_sTsId', 'TS080501_500_30_EUR');
        $oSubj->UNITsetDeprecatedValues();
        $this->assertEquals( $oSubj->getTsId(), $oSubj->sTsId );
        $this->assertEquals( $oSubj->getAmount(), $oSubj->iAmount );
        $this->assertEquals( $oSubj->getFPrice(), $oSubj->fPrice );
    }

    /**
     * Tests oxTsProduct::getAllTsProducts()
     *
     */
    public function testGetAllTsProducts()
    {
        $oSubj = $this->getProxyClass("oxTsProduct");
        $this->assertEquals( 6, count($oSubj->getAllTsProducts()) );
    }
}
