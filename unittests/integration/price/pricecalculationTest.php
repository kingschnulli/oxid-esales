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
 * @version   SVN: $Id: categorytreeTest.php 26841 2010-03-25 13:58:15Z linas.kukulskis $
 */

require_once realpath(dirname(__FILE__).'/../../') . '/unit/OxidTestCase.php';

/**
 * Article price calculation tests, for details, list, start page etc. where article count is 1.
 *
 * Price stored mode:
 *  - NETTO
 *  - BRUTTO
 *
 * Prices:
 *  - Regular article price
 *  - Variant minimum price stored in as regular price
 *  - RRP price - T price
 *  - Price per Unit
 *  - Amount prices
 *
 * Dependencies:
 *  - Shop currency
 *  - subshop recalculation rule: abs, %
 *  - discounts: abs, %
 *  - user prices: A,B,C
 *
 */
class Integration_Price_PriceCalculationTest extends OxidTestCase
{
    /**
     * Initialize the fixture.
     *
     * @return null
     */
    protected function setUp()
    {
        parent::setUp();
    }

    /**
     * Article prices: price,
     *
     */
    public function _dpBruttoPrices()
    {
        return array(
            array( 9.90 ),
            array( 4.95 ),
            array( 1.99 ),
            array( 1.95 ),
            array( 1.49 ),
            array( 0.99 ),
            array( 0.78 ),
            array( 0.51 ),
            array( 0.40 ),
            array( 0.39 ),
            array( 0.25 ),
            array( 0.10 ),
            array( 0.07 ),
            array( 0.01 ),
        );
    }

    /**
     * Article prices: price, VAT
     *
     */
    protected function _dpVAT()
    {
        return array(
            27, 25.5, 25, 24, 23, 22, 21, 21.2, 20,
            19.6, 19, 18, 17.5, 17, 16, 15, 14.5, 14, 13, 13.5, 12.5, 12, 11, 10.5, 10,
            9, 8.5, 8, 7, 6, 6.5, 5.6, 5.5, 5, 4.8, 4.5, 4, 3.8, 3, 2.5, 2.1, 2, 1, 0
        );
    }

    /**
     * Article prices: price, VAT
     *
     */
    protected function _dpUnitQuntities()
    {
        return array(
            0.1, 0.25, 0.33, 0.75, 1, 1.5, 2
        );
    }



    /**
     * Test article prices when they setted in Brutto mode
     *
     * @dataProvider _dpBruttoPrices
     */
    public function testPriceModeBrutto( $dPrice )
    {
        $this->markTestSkipped( "concentrating on basket calc" );
           $this->getConfig()->setConfigParam('blEnterNetPrice', false);

           $aVAT = $this->_dpVAT();

           foreach ($aVAT as $dVAT){
               $oArticle = new oxArticle();
               $oArticle->oxarticles__oxprice = new oxField( $dPrice );
               $oArticle->oxarticles__oxvat = new oxField( $dVAT );
               $this->assertEquals( $dPrice, $oArticle->getPrice()->getBruttoPrice() );
           }
    }


    /**
     * Test article prices when they setted in Brutto mode
     *
     * @dataProvider _dpBruttoPrices
     */
    public function testPriceModeNetto( $dPrice )
    {
        $this->markTestSkipped( "concentrating on basket calc" );
           $this->getConfig()->setConfigParam('blEnterNetPrice', true);
           $aVAT = $this->_dpVAT();

           foreach ($aVAT as $dVAT){
               $oArticle = new oxArticle();
               $dNetto = $this->_getNetto($dPrice, $dVAT);
               $oArticle->oxarticles__oxprice = new oxField( $dNetto );
               $oArticle->oxarticles__oxvat = new oxField( $dVAT );

               $dBrutto = $this->_getBrutto( $dNetto, $dVAT );
               $dOxBrutto = $oArticle->getPrice()->getBruttoPrice();
               $this->assertEquals( $dBrutto, $dOxBrutto, $dNetto . '+'. $dVAT .'%=' . $dBrutto . ' | ' . $dOxBrutto);
           }
    }

    /**
     * Test article prices when they setted in Brutto mode
     *
     * @dataProvider _dpBruttoPrices
     */
    public function testUnitPriceInNettoMode( $dPrice )
    {
        $this->markTestSkipped( "concentrating on basket calc" );
           $this->getConfig()->setConfigParam('blEnterNetPrice', true);
           $dVAT = 17;
           $aUnitQuantities = $this->_dpUnitQuntities();

           foreach ($aUnitQuantities as $dUnitQuantity) {
               $oArticle = oxNew( 'oxArticle' );
               $dNetto = $this->_getNetto($dPrice, $dVAT);
               $oArticle->oxarticles__oxprice = new oxField( $dNetto );
               $oArticle->oxarticles__oxvat = new oxField( $dVAT );
               $oArticle->oxarticles__oxunitquantity = new oxField( $dUnitQuantity );
               $oArticle->oxarticles__oxunitname = new oxField( 'unitName' );

               $dUnitPrice = $this->_getUnitPrice( $this->_getBrutto($dNetto, $dVAT), $dUnitQuantity );
               //$dOxUnitPrice = $oArticle->getUnitPrice();
               //$this->assertEquals( $dUnitPrice, $dOxUnitPrice, $dPrice . ' ' . $dNetto. ' ' . $dVAT .  ' ' . $dOxUnitPrice );
           }
    }

    /**
     * Test article prices when they setted in Brutto mode
     *
     * @dataProvider _dpBruttoPrices
     */
    public function testUnitPriceInBruttoMode( $dPrice )
    {
        $this->markTestSkipped( "concentrating on basket calc" );
           $this->getConfig()->setConfigParam('blEnterNetPrice', false);
           $dVAT = 17;
           $aUnitQuantities = $this->_dpUnitQuntities();

           foreach ($aUnitQuantities as $dUnitQuantity) {
               $oArticle = oxNew( 'oxArticle' );
               $oArticle->oxarticles__oxprice = new oxField( $dPrice );
               $oArticle->oxarticles__oxvat = new oxField( $dVAT );
               $oArticle->oxarticles__oxunitquantity = new oxField( $dUnitQuantity );
               $oArticle->oxarticles__oxunitname = new oxField( 'unitName' );

               $dUnitPrice = $this->_getUnitPrice( $dPrice, $dUnitQuantity );
               //$dOxUnitPrice = $oArticle->getUnitPrice();
               //$this->assertEquals( $dUnitPrice, $dOxUnitPrice, $dPrice . ' ' . $dVAT .  ' ' . $dOxUnitPrice );
           }
    }


    protected function _getUnitPrice( $dPrice, $dUnitQuantity )
    {
        $dResult = $dPrice / $dUnitQuantity;
        $dResult = round($dResult, 2);
        return $dResult;
    }




    protected function _getNetto( $dBruttoPrice, $dVAT )
    {
        $dResult = 100*$dBruttoPrice/(100+$dVAT);
        $dResult = round($dResult, 2);
        return $dResult;
    }

    protected function _getBrutto( $dNettoPrice, $dVAT )
    {
        $dResult = $dNettoPrice*(100+$dVAT)/100;
        $dResult = round($dResult, 2);
        return $dResult;
    }

    /**
     * Test article prices when they setted in Brutto mode
     *
     * @dataProvider _dpBruttoPrices
     */
   /* public function testPriceFromNettoOxPrice( $dPrice )
    {
           $this->getConfig()->setConfigParam('blEnterNetPrice', true);

           $oPrice = new oxPrice();
           $aVAT = $this->_dpVAT();

           $dNetto = $this->_getNetto($dPrice, $dVAT);
           $oPrice->setPrice($dNetto);


           foreach ($aVAT as $dVAT){
               $oPrice->setVat($dVAT);
               $dBrutto = $this->_getBrutto( $dNetto, $dVAT );
               $dOxBrutto = $oPrice->getBruttoPrice();
               $this->assertEquals( $dBrutto, $dOxBrutto, $dNetto . '+'. $dVAT .'%=' . $dBrutto . ' | ' . $dOxBrutto);
           }
    }*/
}