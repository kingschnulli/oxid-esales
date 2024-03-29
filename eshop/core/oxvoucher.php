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
 * @copyright (C) OXID eSales AG 2003-2012
 * @version OXID eShop CE
 * @version   SVN: $Id: oxvoucher.php 44095 2012-04-19 16:08:50Z saulius.stasiukaitis $
 */

/**
 * Voucher manager.
 * Performs deletion, generating, assigning to group and other voucher
 * managing functions.
 * @package core
 */
class oxVoucher extends oxBase
{

    protected $_oSerie = null;

    /**
     * Vouchers doesnt need shop id check as this couses problems with
     * inherider vouchers. Voucher validity check is made by oxvoucher::getVoucherByNr()
     * @var bool
     */
    protected $_blDisableShopCheck = true;

    /**
     * @var string Name of current class
     */
    protected $_sClassName = 'oxvoucher';

    /**
     * Class constructor, initiates parent constructor (parent::oxBase()).
     */
    public function __construct()
    {
        parent::__construct();
        $this->init( 'oxvouchers' );
    }

    /**
     * Gets voucher from db by given number.
     *
     * @param string $sVoucherNr         Voucher number
     * @param array  $aVouchers          Array of available vouchers (default array())
     * @param bool   $blCheckavalability check if voucher is still reserver od not
     *
     * @throws oxVoucherException exception
     *
     * @return mixed
     */
    public function getVoucherByNr( $sVoucherNr, $aVouchers = array(), $blCheckavalability = false )
    {
        $oRet = null;
        if ( !is_null( $sVoucherNr ) ) {

            $sViewName = $this->getViewName();
            $sSeriesViewName = getViewName( 'oxvoucherseries' );
            $myDB = oxDb::getDb();

            $sQ  = "select {$sViewName}.* from {$sViewName}, {$sSeriesViewName} where
                        {$sSeriesViewName}.oxid = {$sViewName}.oxvoucherserieid and
                        {$sViewName}.oxvouchernr = " . $myDB->quote( $sVoucherNr ) . " and ";

            if ( is_array( $aVouchers ) ) {
                foreach ( $aVouchers as $sVoucherId => $sSkipVoucherNr ) {
                    $sQ .= "{$sViewName}.oxid != " . $myDB->quote( $sVoucherId ) . " and ";
                }
            }
            $sQ .= "( {$sViewName}.oxorderid is NULL || {$sViewName}.oxorderid = '' ) ";
            $sQ .= " and ( {$sViewName}.oxdateused is NULL || {$sViewName}.oxdateused = 0 ) ";

            //voucher timeout for 3 hours
            if ( $blCheckavalability ) {
                $iTime = time() - 3600 * 3;
                $sQ .= " and {$sViewName}.oxreserved < '{$iTime}' ";
            }

            $sQ .= " limit 1";

            if ( ! ( $oRet = $this->assignRecord( $sQ ) ) ) {
                $oEx = oxNew( 'oxVoucherException' );
                $oEx->setMessage( 'EXCEPTION_VOUCHER_NOVOUCHER' );
                $oEx->setVoucherNr( $sVoucherNr );
                throw $oEx;
            }
        }

        return $oRet;
    }

    /**
     * marks voucher as used
     *
     * @param string $sOrderId  order id
     * @param string $sUserId   user id
     * @param double $dDiscount used discount
     *
     * @return null
     */
    public function markAsUsed( $sOrderId, $sUserId, $dDiscount )
    {
        //saving oxreserved field
        if ( $this->oxvouchers__oxid->value ) {
            $this->oxvouchers__oxorderid->setValue($sOrderId);
            $this->oxvouchers__oxuserid->setValue($sUserId);
            $this->oxvouchers__oxdiscount->setValue($dDiscount);
            $this->oxvouchers__oxdateused->setValue(date( "Y-m-d", oxUtilsDate::getInstance()->getTime() ));
            $this->save();
        }
    }

    /**
     * mark voucher as reserved
     *
     * @return null
     */
    public function markAsReserved()
    {
        //saving oxreserved field
        $sVoucherID = $this->oxvouchers__oxid->value;

        if ( $sVoucherID ) {
            $myDB = oxDb::getDb();
            $sQ = "update oxvouchers set oxreserved = " . time() . " where oxid = " . $myDB->quote( $sVoucherID );
            $myDB->Execute( $sQ );
        }
    }

    /**
     * unmark as reserved
     *
     * @return null
     */
    public function unMarkAsReserved()
    {
        //saving oxreserved field
        $sVoucherID = $this->oxvouchers__oxid->value;

        if ( $sVoucherID ) {
            $myDB = oxDb::getDb();
            $sQ = "update oxvouchers set oxreserved = 0 where oxid = " . $myDB->quote( $sVoucherID );
            $myDB->Execute($sQ);
        }
    }

    /**
     * Returns the discount value used.
     *
     * @param double $dPrice price to calculate discount on it
     *
     * @throws oxVoucherException exception
     *
     * @return double
     */
    public function getDiscountValue( $dPrice )
    {
        if ($this->_isProductVoucher()) {
            return $this->_getProductDiscoutValue( $dPrice );
        } elseif ($this->_isCategoryVoucher()) {
            return $this->_getCategoryDiscoutValue( $dPrice );
        } else {
            return $this->_getGenericDiscoutValue( $dPrice );
        }
    }

    // Checking General Availability
    /**
     * Checks availability without user logged in. Returns array with errors.
     *
     * @param array  $aVouchers array of vouchers
     * @param double $dPrice    current sum (price)
     *
     * @throws oxVoucherException exception
     *
     * @return array
     */
    public function checkVoucherAvailability( $aVouchers, $dPrice )
    {
        $this->_isAvailableWithSameSeries( $aVouchers );
        $this->_isAvailableWithOtherSeries( $aVouchers );
        $this->_isValidDate();
        $this->_isAvailablePrice( $dPrice );
        $this->_isNotReserved();

        // returning true - no exception was thrown
        return true;
    }

    /**
     * Performs basket level voucher availability check (no need to check if voucher
     * is reserved or so).
     *
     * @param array  $aVouchers array of vouchers
     * @param double $dPrice    current sum (price)
     *
     * @throws oxVoucherException exception
     *
     * @return array
     */
    public function checkBasketVoucherAvailability( $aVouchers, $dPrice )
    {
        $this->_isAvailableWithSameSeries( $aVouchers );
        $this->_isAvailableWithOtherSeries( $aVouchers );
        $this->_isValidDate();
        $this->_isAvailablePrice( $dPrice );

        // returning true - no exception was thrown
        return true;
    }

    /**
     * Checks availability about price. Returns error array.
     *
     * @param double $dPrice base article price
     *
     * @throws oxVoucherException exception
     *
     * @return array
     */
    protected function _isAvailablePrice( $dPrice )
    {
        if ( $this->getDiscountValue( $dPrice ) < 0 ) {
            $oEx = oxNew( 'oxVoucherException' );
            $oEx->setMessage('EXCEPTION_VOUCHER_TOTALBELOWZERO');
            $oEx->setVoucherNr($this->oxvouchers__oxvouchernr->value);
            throw $oEx;
        }
        $oSerie = $this->getSerie();
        $oCur = $this->getConfig()->getActShopCurrencyObject();
        if ( $oSerie->oxvoucherseries__oxminimumvalue->value && $dPrice < ($oSerie->oxvoucherseries__oxminimumvalue->value*$oCur->rate) ) {
            $oEx = oxNew( 'oxVoucherException' );
            $oEx->setMessage('EXCEPTION_VOUCHER_INCORRECTPRICE');
            $oEx->setVoucherNr($this->oxvouchers__oxvouchernr->value);
            throw $oEx;
        }

        return true;
    }

    /**
     * Checks if cumulation with vouchers of the same series possible. Returns
     * true on success.
     *
     * @param array $aVouchers array of vouchers
     *
     * @throws oxVoucherException exception
     *
     * @return bool
     *
     */
    protected function _isAvailableWithSameSeries( $aVouchers )
    {
        if ( is_array( $aVouchers ) ) {
            $sId = $this->getId();
            if (isset($aVouchers[$sId])) {
                unset($aVouchers[$sId]);
            }
            $oSerie = $this->getSerie();
            if (!$oSerie->oxvoucherseries__oxallowsameseries->value) {
                foreach ( $aVouchers as $voucherId => $voucherNr ) {
                    $oVoucher = oxNew( 'oxvoucher' );
                    $oVoucher->load($voucherId);
                    if ( $this->oxvouchers__oxvoucherserieid->value == $oVoucher->oxvouchers__oxvoucherserieid->value ) {
                            $oEx = oxNew( 'oxVoucherException' );
                            $oEx->setMessage('EXCEPTION_VOUCHER_NOTALLOWEDSAMESERIES');
                            $oEx->setVoucherNr( $this->oxvouchers__oxvouchernr->value );
                            throw $oEx;
                    }
                }
            }
        }

        return true;
    }

    /**
     * Checks if cumulation with vouchers from the other series possible.
     * Returns true on success.
     *
     * @param array $aVouchers array of vouchers
     *
     * @throws oxVoucherException exception
     *
     * @return bool
     */
    protected function _isAvailableWithOtherSeries( $aVouchers )
    {
        if ( is_array( $aVouchers ) && count($aVouchers) ) {
            $oSerie = $this->getSerie();
            $sIds = implode(',', oxDb::getInstance()->quoteArray( array_keys( $aVouchers ) ) );
            $blAvailable = true;
            $myDB = oxDb::getDb();
            if (!$oSerie->oxvoucherseries__oxallowotherseries->value) {
                // just search for vouchers with different series
                $sSql  = "select 1 from oxvouchers where oxvouchers.oxid in ($sIds) and ";
                $sSql .= "oxvouchers.oxvoucherserieid != " . $myDB->quote( $this->oxvouchers__oxvoucherserieid->value ) ;
                $blAvailable &= !$myDB->getOne($sSql);
            } else {
                // search for vouchers with different series and those vouchers do not allow other series
                $sSql  = "select 1 from oxvouchers left join oxvoucherseries on oxvouchers.oxvoucherserieid=oxvoucherseries.oxid ";
                $sSql .= "where oxvouchers.oxid in ($sIds) and oxvouchers.oxvoucherserieid != " . $myDB->quote( $this->oxvouchers__oxvoucherserieid->value );
                $sSql .= "and not oxvoucherseries.oxallowotherseries";
                $blAvailable &= !$myDB->getOne($sSql);
            }
            if ( !$blAvailable ) {
                    $oEx = oxNew( 'oxVoucherException' );
                    $oEx->setMessage('EXCEPTION_VOUCHER_NOTALLOWEDOTHERSERIES');
                    $oEx->setVoucherNr($this->oxvouchers__oxvouchernr->value);
                    throw $oEx;
            }
        }

        return true;
    }

    /**
     * Checks if voucher is in valid time period. Returns true on success.
     *
     * @throws oxVoucherException exception
     *
     * @return bool
     */
    protected function _isValidDate()
    {
        $oSerie = $this->getSerie();
        
        // If date is not set will add day before and day after to check if voucher valid today.
        $iTomorrow = mktime( 0, 0, 0, date( "m" ), date( "d" )+1, date( "Y" ) );
        $iYesterday = mktime( 0, 0, 0, date( "m" ), date( "d" )-1, date( "Y" ) );

        // Checks if beginning date is set, if not set $iFrom to yesterday so it will be valid.
        $iFrom = ( (int)$oSerie->oxvoucherseries__oxbegindate->value ) ?
                   strtotime( $oSerie->oxvoucherseries__oxbegindate->value ) : $iYesterday;

        // Checks if end date is set, if no set $iTo to tomorrow so it will be valid.
        $iTo = ( (int)$oSerie->oxvoucherseries__oxenddate->value ) ?
                   strtotime( $oSerie->oxvoucherseries__oxenddate->value ) : $iTomorrow;

        if ( $iFrom < time() && $iTo > time() ) {
            return true;
        }

        $oEx = oxNew( 'oxVoucherException' );
        $oEx->setMessage('EXCEPTION_VOUCHER_ISNOTVALIDDATE');
        $oEx->setVoucherNr( $this->oxvouchers__oxvouchernr->value );
        throw $oEx;
    }

    /**
     * Checks if voucher is not yet reserved before.
     *
     * @throws oxVoucherException exception
     *
     * @return bool
     */
    protected function _isNotReserved()
    {

        if ( $this->oxvouchers__oxreserved->value < time() - 3600 * 3 ) {
            return true;
        }

        $oEx = oxNew( 'oxVoucherException' );
        $oEx->setMessage('EXCEPTION_VOUCHER_ISRESERVED');
        $oEx->setVoucherNr( $this->oxvouchers__oxvouchernr->value );
        throw $oEx;
    }

    // Checking User Availability
    /**
     * Checks availability for the given user. Returns array with errors.
     *
     * @param object $oUser user object
     *
     * @throws oxVoucherException exception
     *
     * @return array
     */
    public function checkUserAvailability( $oUser )
    {

        $this->_isAvailableInOtherOrder( $oUser );
        $this->_isValidUserGroup( $oUser );

        // returning true if no exception was thrown
        return true;
    }

    /**
     * Checks if user already used vouchers from this series and can he use it again.
     *
     * @param object $oUser user object
     *
     * @throws oxVoucherException exception
     *
     * @return boolean
     */
    protected function _isAvailableInOtherOrder( $oUser )
    {
        $oSerie = $this->getSerie();
        if ( !$oSerie->oxvoucherseries__oxallowuseanother->value ) {

            $myDB = oxDb::getDb();
            $sSelect  = 'select count(*) from '.$this->getViewName().' where oxuserid = '. $myDB->quote( $oUser->oxuser__oxid->value ) . ' and ';
            $sSelect .= 'oxvoucherserieid = ' . $myDB->quote( $this->oxvouchers__oxvoucherserieid->value ) . ' and ';
            $sSelect .= '((oxorderid is not NULL and oxorderid != "") or (oxdateused is not NULL and oxdateused != 0)) ';

            if ( $myDB->getOne( $sSelect )) {
                $oEx = oxNew( 'oxVoucherException' );
                $oEx->setMessage('EXCEPTION_VOUCHER_NOTAVAILABLEINOTHERORDER');
                $oEx->setVoucherNr($this->oxvouchers__oxvouchernr->value);
                throw $oEx;
            }
        }

        return true;
    }

    /**
     * Checks if user belongs to the same group as the voucher. Returns true on sucess.
     *
     * @param object $oUser user object
     *
     * @throws oxVoucherException exception
     *
     * @return bool
     */
    protected function _isValidUserGroup( $oUser )
    {
        $oVoucherSerie = $this->getSerie();
        $oUserGroups = $oVoucherSerie->setUserGroups();

        // dodger Task #1555 R Voucher does not work for not logged user?
        if ( !$oUserGroups->count() ) {
            return true;
        }

        if ( $oUser ) {
            foreach ( $oUserGroups as $oGroup ) {
                if ( $oUser->inGroup( $oGroup->getId() ) ) {
                    return true;
                }
            }
        }

        $oEx = oxNew( 'oxVoucherException' );
        $oEx->setMessage( 'EXCEPTION_VOUCHER_NOTVALIDUSERGROUP' );
        $oEx->setVoucherNr( $this->oxvouchers__oxvouchernr->value );
        throw $oEx;
    }

    /**
     * Returns compact voucher object which is used in oxbasket
     *
     * @return oxStdClass
     */
    public function getSimpleVoucher()
    {
        $oVoucher = new oxStdClass();
        $oVoucher->sVoucherId = $this->getId();
        $oVoucher->sVoucherNr = $this->oxvouchers__oxvouchernr->value;
        // R. setted in oxbasket : $oVoucher->fVoucherdiscount = oxLang::getInstance()->formatCurrency( $this->oxvouchers__oxdiscount->value );

        return $oVoucher;
    }

    /**
     * create oxVoucherSerie object of this voucher
     *
     * @return oxVoucherSerie
     */
    public function getSerie()
    {
        if ($this->_oSerie !== null) {
            return $this->_oSerie;
        }
        $oSerie = oxNew('oxvoucherserie');
        if (!$oSerie->load($this->oxvouchers__oxvoucherserieid->value)) {
            throw oxNew( "oxObjectException" );
        }
        $this->_oSerie = $oSerie;
        return $oSerie;
    }

    /**
     * Returns true if voucher is product specific, otherwise false
     *
     * @return boolean
     */
    protected function _isProductVoucher()
    {
        $myDB    = oxDb::getDb();
        $oSerie  = $this->getSerie();
        $sSelect = "select 1 from oxobject2discount where oxdiscountid = ".$myDB->quote( $oSerie->getId() )." and oxtype = 'oxarticles'";
        $blOk    = ( bool ) $myDB->getOne( $sSelect );

        return $blOk;
    }

    /**
     * Returns true if voucher is category specific, otherwise false
     *
     * @return boolean
     */
    protected function _isCategoryVoucher()
    {
        $myDB    = oxDb::getDb();
        $oSerie  = $this->getSerie();
        $sSelect = "select 1 from oxobject2discount where oxdiscountid = ". $myDB->quote( $oSerie->getId() )." and oxtype = 'oxcategories'";
        $blOk    = ( bool ) $myDB->getOne( $sSelect );

        return $blOk;
    }

    /**
     * Returns the discount object created from voucher serie data
     *
     * @return object
     */
    protected function _getSerieDiscount( )
    {
        $oSerie    = $this->getSerie();
        $oDiscount = oxNew('oxDiscount');

        $oDiscount->setId($oSerie->getId());
        $oDiscount->oxdiscount__oxshopid      = new oxField($oSerie->oxvoucherseries__oxshopid->value);
        $oDiscount->oxdiscount__oxactive      = new oxField(true);
        $oDiscount->oxdiscount__oxactivefrom  = new oxField($oSerie->oxvoucherseries__oxbegindate->value);
        $oDiscount->oxdiscount__oxactiveto    = new oxField($oSerie->oxvoucherseries__oxenddate->value);
        $oDiscount->oxdiscount__oxtitle       = new oxField($oSerie->oxvoucherseries__oxserienr->value);
        $oDiscount->oxdiscount__oxamount      = new oxField(1);
        $oDiscount->oxdiscount__oxamountto    = new oxField(MAX_64BIT_INTEGER);
        $oDiscount->oxdiscount__oxprice       = new oxField(0);
        $oDiscount->oxdiscount__oxpriceto     = new oxField(MAX_64BIT_INTEGER);
        $oDiscount->oxdiscount__oxaddsumtype  = new oxField($oSerie->oxvoucherseries__oxdiscounttype->value=='percent'?'%':'abs');
        $oDiscount->oxdiscount__oxaddsum      = new oxField($oSerie->oxvoucherseries__oxdiscount->value);
        $oDiscount->oxdiscount__oxitmartid    = new oxField();
        $oDiscount->oxdiscount__oxitmamount   = new oxField();
        $oDiscount->oxdiscount__oxitmmultiple = new oxField();

        return $oDiscount;
    }

    /**
     * Returns basket item information array from session or order.
     *
     * @param oxDisvount $oDiscount discount object
     *
     * @return array
     */
    protected function _getBasketItems($oDiscount = null)
    {
        if ($this->oxvouchers__oxorderid->value) {
            return $this->_getOrderBasketItems($oDiscount);
        } elseif ( $this->getSession()->getBasket() ) {
            return $this->_getSessionBasketItems($oDiscount);
        } else {
            return array();
        }
    }

    /**
     * Returns basket item information (id,amount,price) array takig item list from order.
     *
     * @param oxDisvount $oDiscount discount object
     *
     * @return array
     */
    protected function _getOrderBasketItems($oDiscount = null)
    {
        if (is_null($oDiscount)) {
            $oDiscount = $this->_getSerieDiscount();
        }

        $oOrder = oxNew('oxorder');
        $oOrder->load($this->oxvouchers__oxorderid->value);

        $aItems  = array();
        $iCount  = 0;

        foreach ( $oOrder->getOrderArticles(true) as $oOrderArticle ) {
            if (!$oOrderArticle->skipDiscounts() && $oDiscount->isForBasketItem($oOrderArticle)) {
                $aItems[$iCount] = array(
                    'oxid'     => $oOrderArticle->getProductId(),
                    'price'    => $oOrderArticle->oxorderarticles__oxprice->value,
                    'discount' => $oDiscount->getAbsValue($oOrderArticle->oxorderarticles__oxprice->value),
                    'amount'   => $oOrderArticle->oxorderarticles__oxamount->value,
                );
                $iCount ++;
            }
        }

        return $aItems;
    }

    /**
     * Returns basket item information (id,amount,price) array takig item list from session.
     *
     * @param oxDisvount $oDiscount discount object
     *
     * @return array
     */
    protected function _getSessionBasketItems($oDiscount = null)
    {
        if (is_null($oDiscount)) {
            $oDiscount = $this->_getSerieDiscount();
        }

        $oBasket = $this->getSession()->getBasket();
        $aItems  = array();
        $iCount  = 0;

        foreach ( $oBasket->getContents() as $oBasketItem ) {
            if ( !$oBasketItem->isDiscountArticle() && ( $oArticle = $oBasketItem->getArticle() ) && !$oArticle->skipDiscounts() && $oDiscount->isForBasketItem($oArticle) ) {

                $aItems[$iCount] = array(
                    'oxid'     => $oArticle->getId(),
                    'price'    => $oArticle->getBasketPrice( $oBasketItem->getAmount(), $oBasketItem->getSelList(), $oBasket )->getBruttoPrice(),
                    'discount' => $oDiscount->getAbsValue($oArticle->getBasketPrice( $oBasketItem->getAmount(), $oBasketItem->getSelList(), $oBasket )->getBruttoPrice()),
                    'amount'   => $oBasketItem->getAmount(),
                );

                $iCount ++;
            }
        }

        return $aItems;
    }

    /**
     * Returns the discount value used.
     *
     * @param double $dPrice price to calculate discount on it
     *
     * @throws oxVoucherException exception
     *
     * @return double
     */
    protected function _getGenericDiscoutValue( $dPrice )
    {
        $oSerie = $this->getSerie();
        if ( $oSerie->oxvoucherseries__oxdiscounttype->value == 'absolute' ) {
            $oCur = $this->getConfig()->getActShopCurrencyObject();
            $dDiscount = $oSerie->oxvoucherseries__oxdiscount->value * $oCur->rate;
        } else {
            $dDiscount = $oSerie->oxvoucherseries__oxdiscount->value / 100 * $dPrice;
        }

        if ( $dDiscount > $dPrice ) {
            $oEx = oxNew( 'oxVoucherException' );
            $oEx->setMessage('EXCEPTION_VOUCHER_TOTALBELOWZERO');
            $oEx->setVoucherNr($this->oxvouchers__oxvouchernr->value);
            throw $oEx;
        }

        return $dDiscount;
    }

    /**
     * Returns the discount value used, if voucher is aplied only for specific products.
     *
     * @param double $dPrice price to calculate discount on it
     *
     * @throws oxVoucherException exception
     *
     * @return double
     */
    protected function _getProductDiscoutValue( $dPrice )
    {
        $oDiscount    = $this->_getSerieDiscount();
        $aBasketItems = $this->_getBasketItems($oDiscount);

        // Basket Item Count and isAdmin check (unble to access property $oOrder->_getOrderBasket()->_blSkipVouchersAvailabilityChecking)
        if (!count($aBasketItems) && !$this->isAdmin() ) {
            $oEx = oxNew( 'oxVoucherException' );
            $oEx->setMessage('EXCEPTION_VOUCHER_NOVOUCHER');
            $oEx->setVoucherNr($this->oxvouchers__oxvouchernr->value);
            throw $oEx;
        }

        $oSerie    = $this->getSerie();

        $oVoucherPrice  = oxNew('oxPrice');
        $oDiscountPrice = oxNew('oxPrice');
        $oProductPrice  = oxNew('oxPrice');
        $oProductTotal  = oxNew('oxPrice');

        foreach ( $aBasketItems as $aBasketItem ) {

            $oDiscountPrice->setPrice($aBasketItem['discount']);
            $oProductPrice->setPrice($aBasketItem['price']);

            // Individual voucher is not multiplied by article amount
            if (!$oSerie->oxvoucherseries__oxcalculateonce->value) {
                $oDiscountPrice->multiply($aBasketItem['amount']);
                $oProductPrice->multiply($aBasketItem['amount']);
            }

            $oVoucherPrice->add($oDiscountPrice->getBruttoPrice());
            $oProductTotal->add($oProductPrice->getBruttoPrice());
        }

        $dVoucher = $oVoucherPrice->getBruttoPrice();
        $dProduct = $oProductTotal->getBruttoPrice();

        if ( $dVoucher > $dProduct ) {
            return $dProduct;
        }

        return $dVoucher;
    }

    /**
     * Returns the discount value used, if voucher is aplied only for specific categories.
     *
     * @param double $dPrice price to calculate discount on it
     *
     * @throws oxVoucherException exception
     *
     * @return double
     */
    protected function _getCategoryDiscoutValue( $dPrice )
    {
        $oDiscount    = $this->_getSerieDiscount();
        $aBasketItems = $this->_getBasketItems( $oDiscount );

        // Basket Item Count and isAdmin check (unble to access property $oOrder->_getOrderBasket()->_blSkipVouchersAvailabilityChecking)
        if ( !count( $aBasketItems ) && !$this->isAdmin() ) {
            $oEx = oxNew( 'oxVoucherException' );
            $oEx->setMessage('EXCEPTION_VOUCHER_NOVOUCHER');
            $oEx->setVoucherNr($this->oxvouchers__oxvouchernr->value);
            throw $oEx;
        }

        $oProductPrice = oxNew('oxPrice');
        $oProductTotal = oxNew('oxPrice');

        foreach ( $aBasketItems as $aBasketItem ) {
            $oProductPrice->setPrice( $aBasketItem['price'] );
            $oProductPrice->multiply( $aBasketItem['amount'] );
            $oProductTotal->add( $oProductPrice->getBruttoPrice() );
        }

        $dProduct = $oProductTotal->getBruttoPrice();
        $dVoucher = $oDiscount->getAbsValue( $dProduct );
        return ( $dVoucher > $dProduct ) ? $dProduct : $dVoucher;
    }

    /**
     * Extra getter to guarantee compatibility with templates
     *
     * @param string $sName name of variable to get
     *
     * @return string
     */
    public function __get( $sName )
    {
        switch ( $sName ) {

            // simple voucher mapping
            case 'sVoucherId':
                return $this->getId();
                break;
            case 'sVoucherNr':
                return $this->oxvouchers__oxvouchernr;
                break;
            case 'fVoucherdiscount':
                return $this->oxvouchers__oxdiscount;
                break;
        }
        return parent::__get($sName);
    }
}
