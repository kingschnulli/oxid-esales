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
 * @link http://www.oxid-esales.com
 * @package core
 * @copyright (C) OXID eSales AG 2003-2009
 * $Id: oxshoplist.php 16303 2009-02-05 10:23:41Z rimvydas.paskevicius $
 */

/**
 * Lightweight variant handler. Implemnets only absolutely needed oxArticle methods.
 *
 * @package core
 */
class oxSimpleVariant extends oxI18n
{

    /**
     * Use lazy loading for this item
     *
     * @var bool
     */
    protected $_blUseLazyLoading = true;

    /**
     * Variant VAT
     *
     * @var double
     */
    protected $_dVat = null;

    /**
     * Variant price
     *
     * @var oxPrice
     */
    protected $_oPrice = null;

    /**
     * Initializes instance
     *
     */
    public function __construct()
    {
        parent::__construct();
        $this->_sCacheKey = "simplevariants";
        $this->init( 'oxarticles' );
    }

    /**
     * Implementing (faking) performance friendly method from oxArticle
     *oxbase
     *
     * @return null
     */
    public function getSelectLists()
    {
        return null;
    }

    /**
     * Implementing (faking) performance friendly method from oxArticle
     *
     * @return oxPrice
     */
    public function getPrice()
    {
        if (!is_null($this->_oPrice)) {
            return $this->_oPrice;
        }

        $this->_oPrice = oxNew("oxPrice");
        $this->_oPrice->setPrice($this->oxarticles__oxprice->value, $this->_dVat);
        return $this->_oPrice;
    }

    /**
     * Returns formated product price.
     *
     * @return double
     */
    public function getFPrice()
    {
        if ( $oPrice = $this->getPrice() ) {
            return oxLang::getInstance()->formatCurrency( $oPrice->getBruttoPrice() );
        } else {
            return null;
        }
    }

    /**
     * Sets variant VAT
     *
     * @param double $dVat Custom VAT
     *
     * @return null
     */
    public function setVat($dVat)
    {
        $this->_dVat = $dVat;
    }
}