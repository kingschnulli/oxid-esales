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
 * @package   core
 * @copyright (C) OXID eSales AG 2003-2010
 * @version OXID eShop CE
 * @version   SVN: $Id: oxactions.php 28344 2010-06-15 11:32:21Z sarunas $
 */

/**
 * TRusted shops protection product manager.
 * @package core
 */
class oxtsprotection extends oxSuperCfg
{
    /**
     * TS protection products
     *
     * @var array
     */
    protected $_aProductIds = array ('TS080501_500_30_EUR','TS080501_1500_30_EUR','TS080501_2500_30_EUR','TS080501_5000_30_EUR','TS080501_1000_30_EUR','TS080501_20000_30_EUR');

    /**
     * TS protection product nett prices
     *
     * @var array
     */
    protected $_aProductNettPrices = array (0.82,2.47,4.12,8.24,16.47,32.94);

    /**
     * TS protection product amounts
     *
     * @var array
     */
    protected $_aProductAmounts = array (500,1500,2500,5000,10000,20000);

    /**
     * Returns array of TS protection products according to order price
     *
     * @param double $dPrice order price
     *
     * @return array
     */
    public function getTsProducts( $dPrice )
    {
        $oProduct = $this->getProduct( 0 );
        $aTsProducts = array($oProduct);
        for ($i=0; $i<count($this->_aProductIds); $i++ ) {
            if ( $this->_aProductAmounts[$i] < $dPrice ) {
                $oProduct = $this->getProduct( $i+1 );
                $aTsProducts[] = $oProduct;
            } else {
                $i = count($this->_aProductIds);
            }
        }
        return $aTsProducts;
    }

    /**
     * Returns TS protection product by id
     *
     * @param string $sTsId TS protection product id
     *
     * @return object
     */
    public function getTsProduct( $sTsId )
    {
        $sKey = array_search( $sTsId, $this->_aProductIds );
        $oProduct = $this->getProduct( $sKey );
        return $oProduct;
    }

    /**
     * Creats and returns TS protection product by key
     *
     * @param string $sKey key
     *
     * @return object
     */
    public function getProduct( $sKey )
    {
        $oProduct = new oxStdClass();
        $oProduct->oPrice = oxNew( 'oxPrice' );
        $oProduct->oPrice->setNettoPriceMode();
        $oProduct->oPrice->setPrice( $this->_aProductNettPrices[$sKey], $this->getConfig()->getConfigParam( 'dDefaultVAT' ) );
        $oProduct->sTsId = $this->_aProductIds[$sKey];
        $oProduct->iAmount = $this->_aProductAmounts[$sKey];
        $oProduct->fPrice = $oProduct->oPrice->getBruttoPrice();
        return $oProduct;
    }

}
