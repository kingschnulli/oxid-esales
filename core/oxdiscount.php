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
 * @copyright (C) OXID eSales AG 2003-2010
 * @version OXID eShop CE
 * $Id: oxdiscount.php 25340 2010-01-22 12:59:13Z tomas $
 */

/**
 * Discounts manager.
 * @package core
 */
class oxDiscount extends oxI18n
{
    /**
     * Current class name
     *
     * @var string
     */
    protected $_sClassName = 'oxdiscount';

    /**
     * Stores amount of articles which are applied for current discount
     *
     * @var double
     */
    protected $_dAmount = null;

    /**
     * Basket ident
     *
     * @var string
     */
    protected $_sBasketIdent = null;

    /**
     * Class constructor, initiates parent constructor (parent::oxBase()).
     */
    public function __construct()
    {
        parent::__construct();
        $this->init( 'oxdiscount' );
    }

    /**
     * Delete this object from the database, returns true on success.
     *
     * @param string $sOXID Object ID(default null)
     *
     * @return bool
     */
    public function delete( $sOXID = null )
    {
        if ( !$sOXID ) {
            $sOXID = $this->getId();
        }
        if ( !$sOXID ) {
            return false;
        }


        $oDB = oxDb::getDb();
        $oDB->execute( 'delete from oxobject2discount where oxobject2discount.oxdiscountid = '.$oDB->quote($sOXID) );

        return parent::delete( $sOXID );
    }

    /**
     * Checks if discount is setup for article
     *
     * @param oxarticle $oArticle article object
     *
     * @return bool
     */
    public function isForArticle( $oArticle )
    {
        // item discounts may only be applied for basket
        if ( $this->oxdiscount__oxaddsumtype->value == 'itm' ) {
            return false;
        }

        if ( $this->oxdiscount__oxamount->value || $this->oxdiscount__oxprice->value ) {
            return false;
        }

        if ( $this->oxdiscount__oxpriceto->value && ($this->oxdiscount__oxpriceto->value < $oArticle->getBasePrice()) ) {
            return false;
        }

        $myDB = oxDb::getDb();

        $sDiscountIdQuoted = $myDB->quote($this->oxdiscount__oxid->value);
        //check for global discount (no articles, no categories)
        $sQ = "select 1 from oxobject2discount where oxdiscountid = $sDiscountIdQuoted and ( oxtype = 'oxarticles' or oxtype = 'oxcategories')";
        $blOk = (bool) $myDB->getOne( $sQ );

        if ( !$blOk ) {
            return true;
        }

        // check if this article is assigned
        $sArticleId = "";
        if ( $sParentId = $oArticle->getProductParentId() ) {
            $sArticleId = "(oxobjectid = '".$oArticle->getProductId()."' or oxobjectid = ".$myDB->quote($sParentId).")";
        } else {
            $sArticleId = "oxobjectid = '".$oArticle->getProductId()."'";
        }

        $sQ = "select 1 from oxobject2discount where oxdiscountid = $sDiscountIdQuoted and {$sArticleId} and oxtype = 'oxarticles'";
        $blOk = (bool) $myDB->getOne( $sQ );
        if ( $blOk ) {
            return true;
        } else {
            // check if article is in some assigned category
            $aCatIds = $oArticle->getCategoryIds();
            if (!$aCatIds || !count($aCatIds)) {
                // no categories are set for article, so no discounts from categories..
                return false;
            }
            $sCatIds = "(".implode(",", oxDb::getInstance()->quoteArray($aCatIds)).")";
            // getOne appends limit 1, so this one should be fast enough
            $sQ = "select oxobjectid from oxobject2discount where oxdiscountid = $sDiscountIdQuoted and oxobjectid in $sCatIds and oxtype = 'oxcategories'";
            if ( ( bool ) $myDB->getOne( $sQ ) ) {
                return true;
            }
        }
        return false;
    }

    /**
     * Checks if discount is setup for some basket item
     *
     * @param object $oArticle basket item
     *
     * @return bool
     */
    public function isForBasketItem( $oArticle )
    {
        if ( $this->oxdiscount__oxamount->value == 0 && $this->oxdiscount__oxprice->value == 0 ) {
            return false;
        }

        // skipping bundle discounts
        if ( $this->oxdiscount__oxaddsumtype->value == 'itm' ) {
            return false;
        }

        $myDB = oxDb::getDb();
        // check if this article is assigned
        $sArticleId = "";
        if ( $sParentId = $oArticle->getProductParentId() ) {
            $sArticleId = "(oxobjectid = '".$oArticle->getProductId()."' or oxobjectid = '{$sParentId}')";
        } else {
            $sArticleId = "oxobjectid = '".$oArticle->getProductId()."'";
        }
        $sQ = "select 1 from oxobject2discount where oxdiscountid = '{$this->oxdiscount__oxid->value}' and ($sArticleId) and oxtype = 'oxarticles'";
        if ( !( $blOk = ( bool ) $myDB->getOne( $sQ ) ) ) {

            // checkin article cateogry
            $blOk = $this->_checkForArticleCategories( $oArticle );
        }

        return $blOk;
    }

    /**
     * Tests if total amount or price (price priority) of articles that can be applied to current discount fits to discount configuration
     *
     * @param oxbasket $oBasket basket
     *
     * @return bool
     */
    public function isForBasketAmount( $oBasket )
    {
        $dAmount = 0;
        $aBasketItems = $oBasket->getContents();
        foreach ( $aBasketItems as $oBasketItem ) {

            $oBasketArticle = $oBasketItem->getArticle(false);

            $blForBasketItem = false;
            if ( $this->oxdiscount__oxaddsumtype->value != 'itm' ) {
                $blForBasketItem = $this->isForBasketItem( $oBasketArticle );
            } else {
                $blForBasketItem = $this->isForBundleItem( $oBasketArticle );
            }

            if ( $blForBasketItem ) {
                $dRate = $oBasket->getBasketCurrency()->rate;
                if ( $this->oxdiscount__oxprice->value ) {
                    if ( ( $oPrice = $oBasketArticle->getPrice() ) ) {
                        $dAmount += ($oPrice->getBruttoPrice() * $oBasketItem->getAmount())/$dRate;
                    }
                } elseif ( $this->oxdiscount__oxamount->value ) {
                    $dAmount += $oBasketItem->getAmount();
                }
            }
        }

        return $this->isForAmount( $dAmount );
    }

    /**
     * Tests if passed amount or price fits current discount (price priority)
     *
     * @param double $dAmount amount or price to check (price priority)
     *
     * @return bool
     */
    public function isForAmount( $dAmount )
    {
        $blIs = true;

        if ( $this->oxdiscount__oxprice->value &&
            ( $dAmount < $this->oxdiscount__oxprice->value || $dAmount > $this->oxdiscount__oxpriceto->value ) ) {
            $blIs = false;
        } elseif ( $this->oxdiscount__oxamount->value &&
            ( $dAmount < $this->oxdiscount__oxamount->value || $dAmount > $this->oxdiscount__oxamountto->value ) ) {
            $blIs = false;
        }
        return $blIs;
    }

    /**
     * Checks if discount is setup for whole basket
     *
     * @param object $oBasket basket object
     *
     * @return bool
     */
    public function isForBasket( $oBasket )
    {
        // initial configuration check
        if ( $this->oxdiscount__oxamount->value == 0 && $this->oxdiscount__oxprice->value == 0 ) {
            return false;
        }

        $oSummary = $oBasket->getBasketSummary();
        // amounts check
        if ( $this->oxdiscount__oxamount->value && ( $oSummary->iArticleCount < $this->oxdiscount__oxamount->value || $oSummary->iArticleCount > $this->oxdiscount__oxamountto->value ) ) {
            return false;
            // price check
        } elseif ($this->oxdiscount__oxprice->value) {
            $dRate = $oBasket->getBasketCurrency()->rate;
            if ( $oSummary->dArticleDiscountablePrice < $this->oxdiscount__oxprice->value*$dRate || $oSummary->dArticleDiscountablePrice > $this->oxdiscount__oxpriceto->value*$dRate ) {
                return false;
            }
        }

        // oxobject2discount configuration check
        $sQ = 'select 1 from oxobject2discount where oxdiscountid = '.oxDb::getDb()->quote($this->oxdiscount__oxid->value).' and oxtype in ("oxarticles", "oxcategories" ) ';

        return !( (bool) oxDb::getDb()->getOne( $sQ ) );
    }

    /**
     * Checks if discount type is bundle discount
     *
     * @param object $oArticle article object
     *
     * @return bool
     */
    public function isForBundleItem( $oArticle )
    {
        if ( $this->oxdiscount__oxaddsumtype->value != 'itm' ) {
            return false;
        }

        $sSelect = "select 1 from oxobject2discount where oxdiscountid='".$this->getId()."' and oxobjectid='".$oArticle->getProductId()."' ";
        if ( !( $blOk = (bool) oxDb::getDb()->getOne( $sSelect ) ) ) {
            // additional checks for amounts and other dependencies
            $blOk = $this->_checkForArticleCategories( $oArticle );
        }
        return $blOk;
    }

    /**
     * Checks if discount type is whole basket bundle discount
     *
     * @param object $oBasket basket object
     *
     * @return bool
     */
    public function isForBundleBasket( $oBasket )
    {
        if ( $this->oxdiscount__oxaddsumtype->value != 'itm' ) {
            return false;
        }

        return $this->isForBasket( $oBasket );
    }

    /**
     * Returns absolute discount value
     *
     * @param float $dPrice  item price
     * @param float $dAmount item amount, interpretted only when discount is absolute (default 1)
     *
     * @return float
     */
    public function getAbsValue( $dPrice, $dAmount = 1 )
    {
        if ( $this->oxdiscount__oxaddsumtype->value == '%' ) {
            return $dPrice * ( $this->oxdiscount__oxaddsum->value / 100 );
        } else {
            $oCur = $this->getConfig()->getActShopCurrencyObject();
            return $this->oxdiscount__oxaddsum->value * $dAmount * $oCur->rate;
        }
    }

    /**
     * Applies discount for current price
     *
     * @param oxprice $oPrice  basket item price object
     * @param double  $dAmount basket item amount (default 1)
     *
     * @return null
     */
    public function applyDiscount( $oPrice, $dAmount = 1 )
    {
        if ( $this->oxdiscount__oxaddsumtype->value == 'abs' ) {

            $oCur = $this->getConfig()->getActShopCurrencyObject();

            $oDiscountPrice = oxNew( 'oxprice' );
            $oDiscountPrice->setBruttoPriceMode();
            $oDiscountPrice->setPrice( $this->oxdiscount__oxaddsum->value * $oCur->rate, $oPrice->getVat() );
        } else {

            $oDiscountPrice = oxNew( 'oxprice' );
            $oDiscountPrice->setBruttoPriceMode();
            $oDiscountPrice->setPrice( $oPrice->getBruttoPrice() / 100 * $this->oxdiscount__oxaddsum->value, $oPrice->getVat() );
        }

        $oDiscountPrice->multiply( $dAmount * -1 );
        $oPrice->addPrice( $oDiscountPrice );
    }

    /**
     * Returns amount of items to bundle
     *
     * @param double $dAmount item amount
     *
     * @return double
     */
    public function getBundleAmount( $dAmount )
    {
        $dItemAmount = $this->oxdiscount__oxitmamount->value;

        // Multiplying bundled articles count, if allowed
        if ( $this->oxdiscount__oxitmmultiple->value && $this->oxdiscount__oxamount->value > 0 ) {
            $dItemAmount = floor( $dAmount / $this->oxdiscount__oxamount->value ) * $this->oxdiscount__oxitmamount->value;
        }

        return $dItemAmount;
    }

    /**
     * Checks if discount may be applied according amounts info
     *
     * @param object $oArticle article object to chesk
     *
     * @return bool
     */
    protected function _checkForArticleCategories( $oArticle )
    {
        // check if article is in some assigned category
        $aCatIds = $oArticle->getCategoryIds();
        if (!$aCatIds || !count($aCatIds)) {
            // no categories are set for article, so no discounts from categories..
            return false;
        }

        $sCatIds = "(".implode(",", oxDb::getInstance()->quoteArray($aCatIds)).")";

        $oDb = oxDb::getDb();
        // getOne appends limit 1, so this one should be fast enough
        $sQ = "select oxobjectid from oxobject2discount where oxdiscountid = ".$oDb->quote($this->oxdiscount__oxid->value)." and oxobjectid in $sCatIds and oxtype = 'oxcategories'";

        return $oDb->getOne( $sQ );
    }

    /**
     * Returns compact discount object which is used in oxbasket
     *
     * @return oxstdclass
     */
    public function getSimpleDiscount()
    {
        $oDiscount = new OxStdClass();
        $oDiscount->sOXID     = $this->getId();
        $oDiscount->sDiscount = $this->oxdiscount__oxtitle->value;
        $oDiscount->sType     = $this->oxdiscount__oxaddsumtype->value;

        return $oDiscount;
    }

}
