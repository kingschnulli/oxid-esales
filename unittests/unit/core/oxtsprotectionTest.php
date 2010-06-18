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
 * @version   SVN: $Id: oxvatselectorTest.php 26841 2010-03-25 13:58:15Z arvydas $
 */

require_once realpath( "." ).'/unit/OxidTestCase.php';
require_once realpath( "." ).'/unit/test_config.inc.php';

/**
 * oxvatselector test
 */
class Unit_Core_oxtsprotectionTest extends OxidTestCase
{
    /**
     * Tests whether oxVatSelector::_getVatCountry() is correctly envoked
     *
     */
    public function testGetProduct()
    {
        $oTsProtection = oxNew('oxtsprotection');
        $oProduct = new oxStdClass();
        $oProduct->oPrice = oxNew( 'oxPrice' );
        $oProduct->oPrice->setNettoPriceMode();
        $oProduct->oPrice->setPrice( 0.82, 19 );
        $oProduct->sTsId = 'TS080501_500_30_EUR';
        $oProduct->iAmount = 500;
        $oProduct->fPrice = 0.98;

        $this->assertEquals( $oProduct, $oTsProtection->getProduct(0) );
    }

    /**
     * Tests whether oxVatSelector::_getVatCountry() is correctly envoked
     *
     */
    public function testGetTsProduct()
    {
        $oTsProtection = oxNew('oxtsprotection');
        $oProduct = new oxStdClass();
        $oProduct->oPrice = oxNew( 'oxPrice' );
        $oProduct->oPrice->setNettoPriceMode();
        $oProduct->oPrice->setPrice( 0.82, 19 );
        $oProduct->sTsId = 'TS080501_500_30_EUR';
        $oProduct->iAmount = 500;
        $oProduct->fPrice = 0.98;

        $this->assertEquals( $oProduct, $oTsProtection->getTsProduct('TS080501_500_30_EUR') );
    }

    /**
     * Tests whether oxVatSelector::_getVatCountry() is correctly envoked
     *
     */
    public function testGetTsProducts()
    {
        $oTsProtection = oxNew('oxtsprotection');
        $oProduct = new oxStdClass();
        $oProduct->oPrice = oxNew( 'oxPrice' );
        $oProduct->oPrice->setNettoPriceMode();
        $oProduct->oPrice->setPrice( 0.82, 19 );
        $oProduct->sTsId = 'TS080501_500_30_EUR';
        $oProduct->iAmount = 500;
        $oProduct->fPrice = 0.98;

        $this->assertEquals( array($oProduct), $oTsProtection->getTsProducts(50) );
    }

    /**
     * Tests whether oxVatSelector::_getVatCountry() is correctly envoked
     *
     */
    public function testGetTsProductsWithBiggerPrice()
    {
        $oTsProtection = oxNew('oxtsprotection');
        $oProduct = new oxStdClass();
        $oProduct->oPrice = oxNew( 'oxPrice' );
        $oProduct->oPrice->setNettoPriceMode();
        $oProduct->oPrice->setPrice( 0.82, 19 );
        $oProduct->sTsId = 'TS080501_500_30_EUR';
        $oProduct->iAmount = 500;
        $oProduct->fPrice = 0.98;
        $oProduct2 = new oxStdClass();
        $oProduct2->oPrice = oxNew( 'oxPrice' );
        $oProduct2->oPrice->setNettoPriceMode();
        $oProduct2->oPrice->setPrice( 2.47, 19 );
        $oProduct2->sTsId = 'TS080501_1500_30_EUR';
        $oProduct2->iAmount = 1500;
        $oProduct2->fPrice = 2.94;
        $oProduct3 = new oxStdClass();
        $oProduct3->oPrice = oxNew( 'oxPrice' );
        $oProduct3->oPrice->setNettoPriceMode();
        $oProduct3->oPrice->setPrice( 4.12, 19 );
        $oProduct3->sTsId = 'TS080501_2500_30_EUR';
        $oProduct3->iAmount = 2500;
        $oProduct3->fPrice = 4.9;

        $this->assertEquals( array($oProduct, $oProduct2, $oProduct3), $oTsProtection->getTsProducts(2000) );
    }

}
