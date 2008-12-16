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
 * @copyright � OXID eSales AG 2003-2008
 * $Id: oxorder.php 14542 2008-12-08 14:24:48Z vilma $
 */

/**
 * Inlcudes PDF class.
 */
require_once oxConfig::getInstance()->getConfigParam( 'sCoreDir' ) . 'fpdf/oxpdf.php';

/**
 * Order manager.
 * Performs creation assigning, updating, deleting and other order functions.
 * @package core
 */
class oxOrder extends oxBase
{

    /**
     * Skip update fields
     *
     * @var unknown_type
     */
    protected $_aSkipSaveFields = array( 'oxorderdate' );

    /**
     * oxList of oxarticle objects
     *
     * @var oxList
     */
    protected $_oArticles = null;

    /**
     * Oxdeliveryset object
     *
     * @var oxDeliverySet
     */
    protected $_oDelSet   = null;

    /**
     * Gift card
     *
     * @var oxWrapping
     */
    protected $_oGiftCard = null;

    /**
     * Payment type
     *
     * @var oxPayment
     */
    protected $_oPaymentType = null;

    /**
     * User payment
     *
     * @var oxPayment
     */
    protected $_oPayment = null;

    /**
     * Order vouchers marked as used
     *
     * @var array
     */
    protected $_aVoucherList = null;

    /**
     * Order delivery costs price object
     *
     * @var oxprice
     */
    protected $_oDelPrice = null;

    /**
     * Order user
     *
     * @var oxUser
     */
    protected $_oUser = null;

    /**
     * Order basket
     *
     * @var oxBasket
     */
    protected $_oBasket = null;

    /**
     * Order wrapping costs price object
     *
     * @var oxprice
     */
    protected $_oWrappingPrice = null;

    /**
     * Order payment costs price object
     *
     * @var oxprice
     */
    protected $_oPaymentPrice = null;

    /**
     * Current class name
     *
     * @var string
     */
    protected $_sClassName = 'oxorder';

    /**
     * Useage of seperate orders numbering for different shops
     *
     * @var bool
     */
    protected $_blSeparateNumbering = null;

    /**
     * Order language id
     *
     * @var int
     */
    protected $_iOrderLang = null;

    /**
     * Class constructor, initiates parent constructor (parent::oxBase()).
     */
    public function __construct()
    {
        parent::__construct();
        $this->init( 'oxorder' );

        // set usage of seperate orders numbering for different shops
        $this->setSeparateNumbering( $this->getConfig()->getConfigParam( 'blSeparateNumbering') );

    }

     /**
     * Getter made for order deliveryset object access
     *
     * @param string $sName parameter name
     *
     * @return mixed
     */
    public function __get( $sName )
    {
        if ( $sName == 'oDelSet' ) {
            return $this->getDelSet();
        }
    }

    /**
     * Assigns data, stored in DB to oxorder object
     *
     * @param mixed $dbRecord DB record
     *
     * @return null
     */
    public function assign( $dbRecord )
    {

        parent::assign( $dbRecord );

        // convert date's to international format
        $this->oxorder__oxorderdate = new oxField(oxUtilsDate::getInstance()->formatDBDate( $this->oxorder__oxorderdate->value ), oxField::T_RAW);
        $this->oxorder__oxsenddate  = new oxField(oxUtilsDate::getInstance()->formatDBDate( $this->oxorder__oxsenddate->value ), oxField::T_RAW);


        //get billing country name from billing country id
        if ( !$this->oxorder__oxbillcountry->value ) {
            $this->oxorder__oxbillcountry = new oxField($this->_getCountryTitle( $this->oxorder__oxbillcountryid->value ));
        }

        //get delivery country name from delivery country id
        if ( !$this->oxorder__oxdelcountry->value ) {
             $this->oxorder__oxdelcountry = new oxField($this->_getCountryTitle( $this->oxorder__oxdelcountryid->value ));
        }

        //settting deprecated template variables
        $this->_setDeprecatedValues();
    }

    /**
     * Gets country title by country id.
     *
     * @param string $sCountryId Cuntry ID
     *
     * @return string
     */
    protected function _getCountryTitle( $sCountryId )
    {
        $sTitle = null;
        if ( $sCountryId && $sCountryId != '-1' ) {
            $oCountry = oxNew( 'oxcountry' );
            $oCountry->load( $sCountryId );
            $sTitle = $oCountry->oxcountry__oxtitle->value;
        }

        return $sTitle;
    }

    /**
     * Assigns data, stored in oxorderarticles to oxorder object .
     *
     * @return null
     */
    public function getOrderArticles()
    {
        if ( $this->_oArticles == null ) {

            // order articles
            $this->_oArticles = oxNew( 'oxlist' );
            $this->_oArticles->init( 'oxorderarticle' );

            $sSelect = 'select oxorderarticles.* from oxorderarticles
                        where oxorderarticles.oxorderid="'.$this->getId().'"
                        order by oxorderarticles.oxartid';
            $this->_oArticles->selectString( $sSelect );
        }

        return $this->_oArticles;
    }

    /**
     * Returns order delivery expenses price object
     *
     * @return oxprice
     */
    public function getOrderDeliveryPrice()
    {
        if ( $this->_oDelPrice != null ) {
            return $this->_oDelPrice;
        }

        $this->_oDelPrice = oxNew( 'oxprice' );
        $this->_oDelPrice->setBruttoPriceMode();
        $this->_oDelPrice->setPrice( $this->oxorder__oxdelcost->value, $this->oxorder__oxdelvat->value );
        return $this->_oDelPrice;
    }

    /**
     * Returns order wrapping expenses price object
     *
     * @return oxprice
     */
    public function getOrderWrappingPrice()
    {
        if ( $this->_oWrappingPrice != null ) {
            return $this->_oWrappingPrice;
        }

        $this->_oWrappingPrice = oxNew( 'oxprice' );
        $this->_oWrappingPrice->setBruttoPriceMode();
        $this->_oWrappingPrice->setPrice( $this->oxorder__oxwrapcost->value, $this->oxorder__oxwrapvat->value );
        return $this->_oWrappingPrice;
    }

    /**
     * Returns order payment expenses price object
     *
     * @return oxprice
     */
    public function getOrderPaymentPrice()
    {
        if ( $this->_oPaymentPrice != null ) {
            return $this->_oPaymentPrice;
        }

        $this->_oPaymentPrice = oxNew( 'oxprice' );
        $this->_oPaymentPrice->setBruttoPriceMode();
        $this->_oPaymentPrice->setPrice( $this->oxorder__oxpaycost->value, $this->oxorder__oxpayvat->value );
        return $this->_oPaymentPrice;
    }

    /**
     * Returns order netto sum (total price, including delivery, payment etc - VAT)
     * (A. this is very unprecise :())
     *
     * @return double
     */
    public function getOrderNetSum()
    {
        $dTotalNetSum = 0;

        $dTotalNetSum += $this->oxorder__oxtotalnetsum->value;
        $dTotalNetSum += $this->getOrderDeliveryPrice()->getNettoPrice();
        $dTotalNetSum += $this->getOrderWrappingPrice()->getNettoPrice();
        $dTotalNetSum += $this->getOrderPaymentPrice()->getNettoPrice();

        return $dTotalNetSum;
    }

    /**
     * Order checking, processing and saving method.
     * Before saving performed checking if order is still not executed (checks in
     * database oxorder table for order with know ID), if yes - returns error code 3,
     * if not - loads payment data, assigns all info from basket to new oxorder object
     * and saves full order with error status. Then executes payment. On failure -
     * deletes order and returns error code 2. On success - saves order (oxorder::save()),
     * removes article from wishlist (oxorder::_updateWishlist()), updates voucher data
     * (oxorder::_markVouchers()). Finally sends order confirmation email to customer
     * (oxemail::SendOrderEMailToUser()) and shop owner (oxemail::SendOrderEMailToOwner()).
     * If this is order racalculation, skipping payment execution, marking vouchers as used
     * and sending order by email to shop owner and user
     * Mailing status (1 if OK, 0 on error) is returned.
     *
     * @param oxBasket $oBasket              Shopping basket object
     * @param object   $oUser                Current user object
     * @param bool     $blRecalculatingOrder Order recalculation
     *
     * @return integer
     */
    public function finalizeOrder( oxBasket $oBasket, $oUser, $blRecalculatingOrder = false )
    {
        // check if this order is already stored
        $sGetChallenge = oxSession::getVar( 'sess_challenge' );
        if ( $this->_checkOrderExist( $sGetChallenge ) ) {
            oxUtils::getInstance()->logger( 'BLOCKER' );
            // we might use this later, this means that somebody klicked like mad on order button
            return 3;
        }

        // if not recalculating order, use sess_challenge id, else leave old order id
        if ( !$blRecalculatingOrder ) {
            // use this ID
            $this->setId( $sGetChallenge );
        }

        // copies user info
        $this->_setUser( $oUser );

        // copies basket info
        $this->_loadFromBasket( $oBasket );

        // payment information
        $oUserPayment = $this->_setPayment( $oBasket->getPaymentId() );

        //saving all order data to DB
        $this->save();

        // executing payment (on failure deletes order and returns error code)
        // in case when recalcualting order, payment execution is skipped
        if ( !$blRecalculatingOrder ) {
            $blRet = $this->_executePayment( $oBasket, $oUserPayment );
            if ( $blRet !== true ) {
                return $blRet;
            }
        }

        // deleting remark info only when order is finished
        oxSession::deleteVar( 'ordrem' );

        // updating order trans status (success status)
        $this->_setOrderStatus( 'OK' );

        // store orderid
        $oBasket->setOrderId( $this->getId() );

        // updating bought items stock
        $this->_updateStock();

        // updating wish lists
        $this->_updateWishlist( $oBasket->getContents(), $oUser );

        // updating users notice list
        $this->_updateNoticeList( $oBasket->getContents(), $oUser );

        // marking vouchers as used and sets them to $this->_aVoucherList (will be used in order email)
        // skipping this action in case of order recalculation
        if ( !$blRecalculatingOrder ) {
            $this->_markVouchers( $oBasket, $oUser );
        }

        // send order by email to shop owner and current user
        // skipping this action in case of order recalculation
        if ( !$blRecalculatingOrder ) {
            $iRet = $this->_sendOrderByEmail( $oUser, $oBasket, $oUserPayment );
        } else {
            $iRet = 1;
        }

        return $iRet;
    }

    /**
     * Updates order transaction status. Faster than saving whole object
     *
     * @param string $sStatus order transaction status
     *
     * @return null
     */
    protected function _setOrderStatus( $sStatus )
    {
        $sQ = 'update oxorder set oxtransstatus="'.$sStatus.'" where oxid="'.$this->getId().'" ';
        oxDb::getDb()->execute( $sQ );
    }

    /**
     * Gathers and assigns to new oxorder object customer data, payment, delivery
     * and shipping info, customer odere remark, currency, voucher, language data.
     * Additionally stores general discount and wrapping. Sets order status to "error"
     * and creates oxorderarticle objects and assigns to them basket articles.
     *
     * @param oxBasket $oBasket Shopping basket object
     *
     * @return null
     */
    protected function _loadFromBasket( oxBasket $oBasket )
    {
        $myConfig = $this->getConfig();

        // store IP Adress - default must be FALSE as it is illegal to store
        if ( $myConfig->getConfigParam( 'blStoreIPs' ) ) {
            $this->oxorder__oxip = new oxField(oxUtilsServer::getInstance()->getRemoteAddress(), oxField::T_RAW);
        }

        // copying main price info
        $this->oxorder__oxtotalnetsum   = new oxField(oxUtils::getInstance()->fRound($oBasket->getProductsPrice()->getNettoSum()), oxField::T_RAW);
        $this->oxorder__oxtotalbrutsum  = new oxField($oBasket->getProductsPrice()->getBruttoSum(), oxField::T_RAW);
        $this->oxorder__oxtotalordersum = new oxField($oBasket->getPrice()->getBruttoPrice(), oxField::T_RAW);

        // payment costs if available
        if ( ( $oPaymentCost = $oBasket->getCosts( 'oxpayment' ) ) ) {
            $this->oxorder__oxpaycost = new oxField($oPaymentCost->getBruttoPrice(), oxField::T_RAW);
            $this->oxorder__oxpayvat  = new oxField($oPaymentCost->getVAT(), oxField::T_RAW);
        }

        // delivery info
        if ( ( $oDeliveryCost = $oBasket->getCosts( 'oxdelivery' ) ) ) {
            $this->oxorder__oxdelcost = new oxField($oDeliveryCost->getBruttoPrice(), oxField::T_RAW);
            //V #M382: Save VAT, not VAT value for delivery costs
            $this->oxorder__oxdelvat  = new oxField($oDeliveryCost->getVAT(), oxField::T_RAW); //V #M382
            $this->oxorder__oxdeltype = new oxField($oBasket->getShippingId(), oxField::T_RAW);
        }

        // user remark
        $this->oxorder__oxremark = new oxField(oxSession::getVar( 'ordrem' ), oxField::T_RAW);

        // currency
        $oCur = $myConfig->getActShopCurrencyObject();
        $this->oxorder__oxcurrency = new oxField($oCur->name);
        $this->oxorder__oxcurrate  = new oxField($oCur->rate, oxField::T_RAW);

        // store voucherdiscount
        if ( ( $oVoucherDiscount = $oBasket->getVoucherDiscount() ) ) {
            $this->oxorder__oxvoucherdiscount = new oxField($oVoucherDiscount->getBruttoPrice(), oxField::T_RAW);
        }

        // general discount
        if ( ( $oTotalDiscount = $oBasket->getTotalDiscount() ) ) {
            $this->oxorder__oxdiscount = new oxField($oTotalDiscount->getBruttoPrice(), oxField::T_RAW);
        }

        //order language
        $this->oxorder__oxlang = new oxField( $this->getOrderLanguage() );


        // initial status - 'ERROR'
        $this->oxorder__oxtransstatus = new oxField('ERROR', oxField::T_RAW);

        // copies basket product info ...
        $this->_setOrderArticles( $oBasket->getContents() );

        // copies wrapping info
        $this->_setWrapping( $oBasket );
    }

    /**
     * Returns language id of current order object. If order allready has
     * language defined - checks if this language is defined in shops config
     *
     * @return int
     */
    public function getOrderLanguage()
    {
        if ( $this->_iOrderLang === null ) {
            if ( isset( $this->oxorder__oxlang->value ) ) {
                $this->_iOrderLang = oxLang::getInstance()->validateLanguage( $this->oxorder__oxlang->value );
            } else {
                $this->_iOrderLang = oxLang::getInstance()->getBaseLanguage();
            }
        }
        return $this->_iOrderLang;
    }

    /**
     * Assigns to new oxorder object customer delivery and shipping info
     *
     * @param object $oUser user object
     *
     * @return null
     */
    protected function _setUser( $oUser )
    {

        $this->oxorder__oxuserid        = new oxField($oUser->getId());

        // bill address
        $this->oxorder__oxbillcompany     = clone $oUser->oxuser__oxcompany;
        $this->oxorder__oxbillemail       = clone $oUser->oxuser__oxusername;
        $this->oxorder__oxbillfname       = clone $oUser->oxuser__oxfname;
        $this->oxorder__oxbilllname       = clone $oUser->oxuser__oxlname;
        $this->oxorder__oxbillstreet      = clone $oUser->oxuser__oxstreet;
        $this->oxorder__oxbillstreetnr    = clone $oUser->oxuser__oxstreetnr;
        $this->oxorder__oxbilladdinfo     = clone $oUser->oxuser__oxaddinfo;
        $this->oxorder__oxbillustid       = clone $oUser->oxuser__oxustid;
        $this->oxorder__oxbillcity        = clone $oUser->oxuser__oxcity;
        $this->oxorder__oxbillcountryid   = clone $oUser->oxuser__oxcountryid;
        $this->oxorder__oxbillzip         = clone $oUser->oxuser__oxzip;
        $this->oxorder__oxbillfon         = clone $oUser->oxuser__oxfon;
        $this->oxorder__oxbillfax         = clone $oUser->oxuser__oxfax;
        $this->oxorder__oxbillsal         = clone $oUser->oxuser__oxsal;


        // delivery address
        if ( ( $oDelAdress = $this->getDelAddressInfo() ) ) {
            // set delivery address
            $this->oxorder__oxdelcompany   = clone $oDelAdress->oxaddress__oxcompany;
            $this->oxorder__oxdelfname     = clone $oDelAdress->oxaddress__oxfname;
            $this->oxorder__oxdellname     = clone $oDelAdress->oxaddress__oxlname;
            $this->oxorder__oxdelstreet    = clone $oDelAdress->oxaddress__oxstreet;
            $this->oxorder__oxdelstreetnr  = clone $oDelAdress->oxaddress__oxstreetnr;
            $this->oxorder__oxdeladdinfo   = clone $oDelAdress->oxaddress__oxaddinfo;
            $this->oxorder__oxdelcity      = clone $oDelAdress->oxaddress__oxcity;
            $this->oxorder__oxdelcountryid = clone $oDelAdress->oxaddress__oxcountryid;
            $this->oxorder__oxdelzip       = clone $oDelAdress->oxaddress__oxzip;
            $this->oxorder__oxdelfon       = clone $oDelAdress->oxaddress__oxfon;
            $this->oxorder__oxdelfax       = clone $oDelAdress->oxaddress__oxfax;
            $this->oxorder__oxdelsal       = clone $oDelAdress->oxaddress__oxsal;
        }
    }

    /**
     * Assigns wrapping VAT and card price + card message info
     *
     * @param oxBasket $oBasket basket object
     *
     * @return null
     */
    protected function _setWrapping( oxBasket $oBasket )
    {
        $myConfig = $this->getConfig();

        // wrapping price
        if ( ( $oWrappingCost = $oBasket->getCosts( 'oxwrapping' ) ) ) {
            $this->oxorder__oxwrapcost = new oxField($oWrappingCost->getBruttoPrice(), oxField::T_RAW);

            // wrapping VAT
            if ( $myConfig->getConfigParam( 'blCalcVatForWrapping' ) ) {
                $this->oxorder__oxwrapvat = new oxField($oWrappingCost->getVAT(), oxField::T_RAW);
            }
        }

        // greetings card
        $this->oxorder__oxcardid = new oxField($oBasket->getCardId(), oxField::T_RAW);

        // card text will be stored in database
        $this->oxorder__oxcardtext = new oxField($oBasket->getCardMessage(), oxField::T_RAW);
    }

    /**
     * Creates oxorderarticle objects and assigns to them basket articles.
     * Updates quantity of sold articles (oxarticle::updateSoldAmount()).
     *
     * @param array $aArticleList article list
     *
     * @return null
     */
    protected function _setOrderArticles( $aArticleList )
    {
        // reset articles list
        $this->_oArticles = oxNew( 'oxlist' );
        $iCurrLang = $this->getOrderLanguage();

        // add all the products we have on basket to the order
        foreach ( $aArticleList as $oContent ) {

            //$oContent->oProduct = $oContent->getArticle();
            $oProduct = $oContent->getArticle();

            // if order language doe not match product language - article must be reloaded in order language
            if ( $iCurrLang != $oProduct->getLanguage() ) {
                $oProduct->loadInLang( $iCurrLang, $oProduct->getId() );
            }

            $aSelList = array();
            // set chosen selectlist
            $sSelList = '';
            if ( count($oContent->getChosenSelList()) ) {
                foreach ( $oContent->getChosenSelList() as $oItem ) {
                    $aSelList[] = $oItem->name.' : '.$oItem->value;
                }
                $sSelList = implode( ', ', $aSelList );
            }

            $oOrderArticle = oxNew( 'oxorderarticle' );

            // copying additional data
            $oOrderArticle->copyThis( $oProduct );

            // ids, titles, numbers ...
            //$oOrderArticle->oxorderarticles__oxid->setValue($oOrderArticle->setId());
            $oOrderArticle->setId();
            $oOrderArticle->oxorderarticles__oxorderid = new oxField($this->getId());
            $oOrderArticle->oxorderarticles__oxartid   = new oxField($oContent->getProductId());
            $oOrderArticle->oxorderarticles__oxamount  = new oxField($oContent->getAmount());

            //$oOrderArticle->oxorderarticles__oxartnum->setValue($oContent->oProduct->oxarticles__oxartnum->value);
            $oOrderArticle->oxorderarticles__oxartnum  = clone $oProduct->oxarticles__oxartnum;

            //$oOrderArticle->oxorderarticles__oxselvariant->setValue(trim( $sSelList.' '.$oContent->oProduct->oxarticles__oxvarselect->value ));
            $oOrderArticle->oxorderarticles__oxselvariant = new oxField(trim( $sSelList.' '.$oProduct->oxarticles__oxvarselect->value ), oxField::T_RAW);

            //$oOrderArticle->oxorderarticles__oxtitle->setValue(trim( $oContent->oProduct->oxarticles__oxtitle->value.' '.$oOrderArticle->oxorderarticles__oxselvariant->value ));
            $oOrderArticle->oxorderarticles__oxtitle      = new oxField(trim( $oProduct->oxarticles__oxtitle->value.' '.$oOrderArticle->oxorderarticles__oxselvariant->value ), oxField::T_RAW);

            //$oOrderArticle->oxorderarticles__oxshortdesc->setValue($oContent->oProduct->oxarticles__oxshortdesc->value);
            $oOrderArticle->oxorderarticles__oxshortdesc  = new oxField( $oProduct->oxarticles__oxshortdesc->value, oxField::T_RAW);

            // prices
            $oOrderArticle->oxorderarticles__oxnetprice  = new oxField($oContent->getPrice()->getNettoPrice(), oxField::T_RAW);
            $oOrderArticle->oxorderarticles__oxvatprice  = new oxField($oContent->getPrice()->getVATValue(), oxField::T_RAW);
            $oOrderArticle->oxorderarticles__oxbrutprice = new oxField($oContent->getPrice()->getBruttoPrice(), oxField::T_RAW);
            $oOrderArticle->oxorderarticles__oxnprice    = new oxField($oContent->getUnitPrice()->getNettoPrice(), oxField::T_RAW);
            $oOrderArticle->oxorderarticles__oxbprice    = new oxField($oContent->getUnitPrice()->getBruttoPrice(), oxField::T_RAW);
            $oOrderArticle->oxorderarticles__oxvat       = new oxField($oContent->getPrice()->getVAT(), oxField::T_RAW);

            // wrap id
            $oOrderArticle->oxorderarticles__oxwrapid      = new oxField($oContent->getWrappingId(), oxField::T_RAW);

            // items shop id
            $oOrderArticle->oxorderarticles__oxordershopid = new oxField($oContent->getShopId(), oxField::T_RAW);

            // copying persistent parameters ...
            if ( count( $oProduct->getPersParams() ) ) {
                $oOrderArticle->oxorderarticles__oxpersparam = new oxField(serialize( $oProduct->getPersParams() ), oxField::T_RAW);
            } elseif ( count( $oContent->getPersParams() ) ) {
                $oOrderArticle->oxorderarticles__oxpersparam = new oxField(serialize( $oContent->getPersParams()), oxField::T_RAW);
            }

            // add information for eMail
            //P
            //TODO: check if this assign is needed at all
            $oOrderArticle->oProduct = $oProduct;

            // simulatin order article list
            $this->_oArticles->offsetSet( $oOrderArticle->getId(), $oOrderArticle );
        }
    }

    /**
     * Executes payment. Additionally loads oxPaymentGateway object, initiates
     * it by adding payment parameters (oxPaymentGateway::setPaymentParams())
     * and finally executes it (oxPaymentGateway::executePayment()). On failure -
     * deletes order and returns * error code 2.
     *
     * @param oxBasket $oBasket      basket object
     * @param object   $oUserpayment user payment object
     *
     * @return  integer 2 or an error code
     */
    protected function _executePayment( oxBasket $oBasket, $oUserpayment )
    {
        $oPayTransaction = $this->_getGateway();
        $oPayTransaction->setPaymentParams( $oUserpayment );

        if ( !$oPayTransaction->executePayment( $oBasket->getPrice()->getBruttoPrice(), $this ) ) {
            $this->delete();

            // checking for error messages
            if ( method_exists( $oPayTransaction, 'getLastError' ) ) {
                if ( ( $sLastError = $oPayTransaction->getLastError() ) ) {
                    return $sLastError;
                }
            }

            // checking for error codes
            if ( method_exists( $oPayTransaction, 'getLastErrorNo' ) ) {
                if ( ( $iLastErrorNo = $oPayTransaction->getLastErrorNo() ) ) {
                    return $iLastErrorNo;
                }
            }

            return 2; // means no authentication
        }
        return true; // everything fine
    }

    /**
     * Returns the correct gateway. At the moment only switch between default
     * and IPayment, can be extended later.
     *
     * @return object $oPayTransaction payment gateway object
     */
    protected function _getGateway()
    {
        return oxNew( 'oxPaymentGateway' );
    }

    /**
     * Creats and returns user payment.
     *
     * @param string $sPaymentid used payment id
     *
     * @return object $oUserpayment payment object
     */
    protected function _setPayment( $sPaymentid )
    {
        // copying payment info fields
        $aDynvalue = oxSession::getVar( 'dynvalue' );
        $aDynvalue = $aDynvalue ? $aDynvalue : oxConfig::getParameter( 'dynvalue' );

        // loading payment object
        $oPayment = oxNew( 'oxpayment' );

        if (!$oPayment->load( $sPaymentid )) {
            return null;
        }

        $oPayment->setDynValues( oxUtils::getInstance()->assignValuesFromText( $oPayment->oxpayments__oxvaldesc->value ) );

        // collecting dynamic values
        $aDynVal = array();

        $aPaymentDynValues = $oPayment->getDynValues();
        foreach ( $aPaymentDynValues  as $key => $oVal ) {
            if ( isset( $aDynvalue[$oVal->name] ) ) {
                $oVal->value = $aDynvalue[$oVal->name];
            }

            //$oPayment->setDynValue($key, $oVal);
            $aPaymentDynValues[$key] = $oVal;
            $aDynVal[$oVal->name] = $oVal->value;
        }

        // Store this payment information, we might allow users later to
        // reactivate already give payment informations

        $oUserpayment = oxNew( 'oxuserpayment' );
        $oUserpayment->oxuserpayments__oxuserid     = clone $this->oxorder__oxuserid;
        $oUserpayment->oxuserpayments__oxpaymentsid = new oxField($sPaymentid, oxField::T_RAW);
        $oUserpayment->oxuserpayments__oxvalue      = new oxField(oxUtils::getInstance()->assignValuesToText( $aDynVal ), oxField::T_RAW);
        $oUserpayment->oxpayments__oxdesc           = clone $oPayment->oxpayments__oxdesc;
        $oUserpayment->setDynValues( $aPaymentDynValues );
        $oUserpayment->save();

        // storing payment information to order
        $this->oxorder__oxpaymentid   = new oxField($oUserpayment->getId(), oxField::T_RAW);
        $this->oxorder__oxpaymenttype = clone $oUserpayment->oxuserpayments__oxpaymentsid;

        // returning user payment object which will be used later in code ...
        return $oUserpayment;
    }

    /**
     * aAdds/removes user chosen article to/from his noticelist
     * or wishlist (oxuserbasket::addItemToBasket()).
     *
     * @param array  $aArticleList basket products
     * @param object $oUser        user object
     *
     * @return null
     */
    protected function _updateWishlist( $aArticleList, $oUser )
    {

        foreach ( $aArticleList as $oContent) {
            if ( ( $sWishId = $oContent->getWishId() ) ) {

                // checking which wishlist user uses ..
                if ( $sWishId == $oUser->getId() ) {
                    $oUserBasket = $oUser->getBasket( 'wishlist' );
                } else {
                    $aWhere = array( 'oxuserbaskets.oxuserid' => $sWishId, 'oxuserbaskets.oxtitle' => 'wishlist' );
                    $oUserBasket = oxNew( 'oxuserbasket' );
                    $oUserBasket->assignRecord( $oUserBasket->buildSelectString( $aWhere ) );
                }

                // updating users wish list
                if ( $oUserBasket ) {
                    if ( !($sProdId = $oContent->getWishArticleId() )) {
                        $sProdId = $oContent->getProductId();
                    }
                    $oUserBasketItem = $oUserBasket->getItem( $sProdId, $oContent->getSelList() );
                    $dNewAmount = $oUserBasketItem->oxuserbasketitems__oxamount->value - $oContent->getAmount();
                    if ( $dNewAmount < 0) {
                        $dNewAmount = 0;
                    }
                    $oUserBasket->addItemToBasket( $sProdId, $dNewAmount, $oContent->getSelList(), true );
                }
            }
        }
    }

    /**
     * After order is finished this method cleans up users notice list, by
     * removing bought items from users notice list
     *
     * @param array  $aArticleList array of basket products
     * @param oxuser $oUser        basket user object
     *
     * @return null
     */
    protected function _updateNoticeList( $aArticleList, $oUser )
    {
        // loading users notice list ..
        if ( $oUserBasket = $oUser->getBasket( 'noticelist' ) ) {
            // only if wishlist is enabled
            foreach ( $aArticleList as $oContent) {
                $sProdId = $oContent->getProductId();

                // updating users notice list
                $oUserBasketItem = $oUserBasket->getItem( $sProdId, $oContent->getSelList() );
                $dNewAmount = $oUserBasketItem->oxuserbasketitems__oxamount->value - $oContent->getAmount();
                if ( $dNewAmount < 0) {
                    $dNewAmount = 0;
                }
                $oUserBasket->addItemToBasket( $sProdId, $dNewAmount, $oContent->getSelList(), true );
            }
        }
    }

    /**
     * Bought item stock updater
     *
     * @return null
     */
    protected function _updateStock()
    {
        $myConfig = $this->getConfig();
        $blUseStock = $myConfig->getConfigParam( 'blUseStock' );

        // ordered articles
        $oOrderArticles = $this->getOrderArticles();
        if ( $oOrderArticles && count( $oOrderArticles ) > 0 && $blUseStock ) {
            foreach ( $oOrderArticles as $oOrderArticle ) {
                $oOrderArticle->updateArticleStock( $oOrderArticle->oxorderarticles__oxamount->value * (-1), $myConfig->getConfigParam( 'blAllowNegativeStock' ) );
            }
        }
    }

    /**
     * Markes voucher as used (oxvoucher::markAsUsed())
     * and sets them to $this->_aVoucherList.
     *
     * @param oxBasket $oBasket basket object
     * @param oxUser   $oUser   user object
     *
     * @deprecated sets deprecated values for usage in mail templates
     *
     * @return null
     */
    protected function _markVouchers( $oBasket, $oUser )
    {
        $this->_aVoucherList = $oBasket->getVouchers();

        if ( is_array( $this->_aVoucherList ) ) {
            foreach ( array_keys( $this->_aVoucherList ) as $sVoucherId ) {
                $oVoucher = oxNew( 'oxvoucher' );
                $oVoucher->load( $sVoucherId );
                $oVoucher->markAsUsed( $this->oxorder__oxid->value, $oUser->oxuser__oxid->value );

                // -- set deprecated values for email templates
                $oVoucher->oxmodvouchers__oxvouchernr = $oVoucher->oxvouchers__oxvouchernr;
                $oVSerie = $oVoucher->getSerie();
                $oVoucher->oxmodvouchers__oxdiscount     = clone $oVSerie->oxvoucherseries__oxdiscount;
                $oVoucher->oxmodvouchers__oxdiscounttype = clone $oVSerie->oxvoucherseries__oxdiscounttype;
                // -- set deprecated values for email templates

                $this->_aVoucherList[$sVoucherId] = $oVoucher;
            }
        }
    }

    /**
     * Updates/inserts order object and related info to DB
     *
     * @return null
     */
    public function save()
    {
        if ( ( $blSave = parent::save() ) ) {

            // saving order articles
            $oOrderArticles = $this->getOrderArticles();
            if ( $oOrderArticles && count( $oOrderArticles ) > 0 ) {
                foreach ( $oOrderArticles as $oOrderArticle ) {
                    $oOrderArticle->save();
                }
            }
        }

        return $blSave;
    }

    /**
     * Loads and returns delivery adress object or null
     * if deladrid is not configured, or object was not loaded
     *
     * @return  object
     */
    public function getDelAddressInfo()
    {
        $oDelAdress = null;
        if ( ( $soxAddressId = oxConfig::getParameter( 'deladrid' ) ) ) {
            $oDelAdress = oxNew( 'oxbase' );
            $oDelAdress->init( 'oxaddress' );
            $oDelAdress->load( $soxAddressId );

            //get delivery country name from delivery country id
            if ( $oDelAdress->oxaddress__oxcountryid->value && $oDelAdress->oxaddress__oxcountryid->value != -1 ) {
                 $oCountry = oxNew( 'oxcountry' );
                 $oCountry->load( $oDelAdress->oxaddress__oxcountryid->value );
                 $oDelAdress->oxaddress__oxcountry = clone $oCountry->oxcountry__oxtitle;
            }
        }
        return $oDelAdress;
    }

    /**
     * Function whitch cheks if article stock is valid.
     * If not displays error and returns false.
     *
     * @param object $oBasket basket object
     *
     * @throws oxOutOfStockException exception
     *
     * @return null
     */
    public function validateStock( $oBasket )
    {
        foreach ( $oBasket->getContents() as $oContent ) {
            $oProd = $oContent->getArticle();

            // check if its still available
            $iOnStock = $oProd->checkForStock( $oContent->getAmount() );
            if ( $iOnStock !== true ) {
                $oEx = oxNew( 'oxOutOfStockException' );
                $oEx->setMessage( 'EXCEPTION_OUTOFSTOCK_OUTOFSTOCK' );
                $oEx->setArticleNr( $oProd->oxarticles__oxartnum->value );
                $oEx->setRemainingAmount( $oProd->oxarticles__oxstock->value );
                throw $oEx;
            }
        }
    }

    /**
     * Inserts order object information in DB. Returns true on success.
     *
     * @return bool
     */
    protected function _insert()
    {
        $myConfig = $this->getConfig();

        $this->oxorder__oxorderdate = new oxField(date( 'Y-m-d H:i:s', oxUtilsDate::getInstance()->getTime() ), oxField::T_RAW);
        $this->oxorder__oxshopid    = new oxField($myConfig->getShopId(), oxField::T_RAW);
        $this->oxorder__oxfolder    = new oxField(key( $myConfig->getShopConfVar(  'aOrderfolder', $myConfig->getShopId() ) ), oxField::T_RAW);

        if ( ( $blInsert = parent::_insert() ) ) {
            // setting order number
            if ( !$this->oxorder__oxordernr->value ) {
                $aWhere = '';
                // separate order numbers for shops ...
                if ( $this->_blSeparateNumbering ) {
                    $aWhere = array( 'oxshopid = "'.$myConfig->getShopId().'"' );
                }
                $this->_setRecordNumber( 'oxordernr', $aWhere );
            }
        }
        return $blInsert;
    }

    /**
     * Updates object parameters to DB.
     *
     * @return null
     */
    protected function _update()
    {
        $this->oxorder__oxsenddate = new oxField(oxUtilsDate::getInstance()->formatDBDate( $this->oxorder__oxsenddate->value, true ), oxField::T_RAW);
        return parent::_update();
    }

    /**
     * Updates stock information, deletes current ordering details from DB,
     * returns true on success.
     *
     * @param string $sOxId Ordering ID (default null)
     *
     * @return bool
     */
    public function delete( $sOxId = null )
    {
        if ( $sOxId ) {
            if ( !$this->load( $sOxId ) ) {
                // such order does not exist
                return false;
            }
        } elseif ( !$sOxId ) {
            $sOxId = $this->getId();
        }

        // no order id is passed
        if ( !$sOxId ) {
            return false;
        }


        // update article stock information and delete order articles
        $myConfig   = $this->getConfig();
        $blUseStock = $myConfig->getConfigParam( 'blUseStock' );

        $oOrderArticles = $this->getOrderArticles();
        foreach ( $oOrderArticles as $oOrderArticle ) {
            // updating amounts only on non canceled items
            if ( $blUseStock ) {
                if ( !$oOrderArticle->oxorderarticles__oxstorno->value ) {
                    $oOrderArticle->updateArticleStock( $oOrderArticle->oxorderarticles__oxamount->value, $myConfig->getConfigParam('blAllowNegativeStock') );
                }
            }
            $oOrderArticle->delete();
        }

        // #440 - deleting user payment info
        if ( $this->oxorder__oxpaymentid->value ) {
            $oDB = oxDb::getDb();
            $oDB->execute( 'delete from oxuserpayments where oxuserpayments.oxid = "'.$this->oxorder__oxpaymentid->value.'"' );
        }

        return parent::delete( $sOxId );
    }

    /**
     * Recalculates order. Starts transactions, deletes current order and order articles from DB,
     * adds current order articles to virtual basket and finaly recalculates order by calling oxorder::finalizeOrder()
     * If no errors, finishing transaction.
     *
     * @param array $aNewOrderArticles article list of new order
     * @param bool  $blChangeDelivery  if delivery was changed in admin
     *
     * @return null
     */
    public function recalculateOrder( $aNewOrderArticles = array(), $blChangeDelivery = false )
    {
        oxDb::startTransaction();

        try {
            // deleting old order with order articles
            //load order articles and delete order and order articles
            $this->delete();

            $oUser = oxNew( "oxuser" );
            $oUser->load( $this->oxorder__oxuserid->value );

            //creating virtual basket and initalizing additional parameters (user, stock, currency)
            $oBasket = oxNew( "oxBasket" );

            $aCanceledArticles = array();
            $aArticlesIds = array();

            // collect order articles ids's (oxarticles) and canceled order articles
            if ( $this->_oArticles = $this->getOrderArticles() ) {
                $this->_oArticles->rewind();
                while ( $oOrderArticle = $this->_oArticles->current() ) {
                    $sOrderArticleId = $this->_oArticles->key();

                    //articles id's
                    $aArticlesIds[$sOrderArticleId] = $oOrderArticle->oxorderarticles__oxartid->value;

                    // collect canceled order articles, they will not be included in recalculation articles list
                    // and will be saved back to order after recalculating and finalizieOrder()
                    if ( $oOrderArticle->oxorderarticles__oxstorno->value == '1') {
                        $aCanceledArticles[$sOrderArticleId] = $oOrderArticle;

                        // unset canceled article from recalcualtion list
                        //unset( $this->_oArticles[$sOrderArticleId] );
                        $this->_oArticles->offsetUnset( $sOrderArticleId );
                    } else {
                  	    $this->_oArticles->next();
                    }
                }
            }

            // add or remove newly added order articles to/from old articles list
            foreach ($aNewOrderArticles as $oNewOrderArticle) {

                $sNewOrderArtId = null;
                $blIsOldOrderArticle = false;

                //check, if added article already is in old order articles list
                if ( ( $sNewOrderArtId = array_search( $oNewOrderArticle->oxorderarticles__oxartid->value, $aArticlesIds ) ) !== false ) {
                    $blIsOldOrderArticle = true;
                }

                //check, if we are going to delete it
                if ( $oNewOrderArticle->oxorderarticles__oxamount->value == 0 ) {
                    // if it is in canceled articles list, remove it from canceled articles list,
                    // because they will be restored after recalcualtion
                    if ( array_key_exists( $sNewOrderArtId, $aCanceledArticles) ) {
                        // add it back to recalculation list from canceled articles list
                        // to delete it in finalizeOrder()
                        $this->_oArticles->offsetSet( $sNewOrderArtId, $aCanceledArticles[$sNewOrderArtId] );
                        //$this->_oArticles[$sNewOrderArtId] = $aCanceledArticles[$sNewOrderArtId];

                        // and remove it from canceled articles, because they will be restored after recalculation
                        unset($aCanceledArticles[$sNewOrderArtId]);
                    }
                }

                if ( $blIsOldOrderArticle ) {
                    //just update existing order article amount
                    $this->_oArticles->offsetGet( $sNewOrderArtId )->oxorderarticles__oxamount = clone $oNewOrderArticle->oxorderarticles__oxamount;
                    //$this->_oArticles[$sNewOrderArtId]->oxorderarticles__oxamount = clone $oNewOrderArticle->oxorderarticles__oxamount;
                } else {
                    //add new article to order articles
                    $this->_oArticles->offsetSet( $oNewOrderArticle->getId(), $oNewOrderArticle );
                    //$this->_oArticles[] = $oNewOrderArticle;
                }
            }

            // add this order articles to virtual basket and recalculates basket
            $oBasket = $this->_addOrderArticlesToBasket( $oUser, $this->_oArticles, $blChangeDelivery );

            //finalizing order (skipping payment execution, vouchers marking and mail sending)
            $iRet = $this->finalizeOrder( $oBasket, $oUser, true );

            //adding back canceled articles
            if ( count($aCanceledArticles) > 0 ) {
                foreach($aCanceledArticles as $oCanceledOrderArticle ) {
                    $oCanceledOrderArticle->save();
                }
            }

            //if finalizing order failed, rollback transaction
            if ( $iRet !== 1 ) {
                oxDb::rollbackTransaction();
            } else {
                oxDb::commitTransaction();
            }

        } catch( Exception $oE ) {
                // if exception, rollBack everything
                oxDb::rollbackTransaction();
        }
    }

    /**
     * Fake entries, pdf is generated in modules.. myorder.
     *
     * @param mixed $oPdf pdf object
     *
     * @return null
     */
    public function pdfFooter( $oPdf )
    {
    }

    /**
     * Fake entries, pdf is generated in modules.. myorder.
     *
     * @param mixed $oPdf pdf object
     *
     * @return null
     */
    public function pdfHeaderplus( $oPdf )
    {
    }

    /**
     * Fake entries, pdf is generated in modules.. myorder.
     *
     * @param mixed $oPdf pdf object
     *
     * @return null
     */
    public function pdfHeader( $oPdf )
    {
    }

    /**
     * Fake entries, pdf is generated in modules.. myorder.
     *
     * @param string $sFilename file name
     * @param int    $iSelLang  selected language
     *
     * @return null
     */
    public function genPdf( $sFilename, $iSelLang = 0 )
    {
    }

    /**
     * Returns order invoice number.
     *
     * @return integer
     */
    public function getInvoiceNum()
    {
        $sQ = 'select max(oxorder.oxinvoicenr) from oxorder where oxorder.oxshopid = "'.$this->getConfig()->getShopId().'" ';
        return ( ( int ) oxDb::getDb()->getOne( $sQ ) + 1 );
    }


    /**
     * Loads possible shipping sets for this order
     *
     * @return oxdeliverysetlist
     */
    public function getShippingSetList()
    {
        $myConfig = $this->getConfig();

        // in which country we deliver
        $sShipID = $this->oxorder__oxdelcountryid->value;

        if (!$sShipID) {
            $sShipID = $this->oxorder__oxbillcountryid->value;
        }

        $oUser = oxNew( "oxuser" );
        $oUser->load( $this->oxorder__oxuserid->value );

        // add this order articles to basket and recalculate basket
        $oBasket = $this->_addOrderArticlesToBasket( $oUser, $this->getOrderArticles() );

        $aOrderDelSetList = array();

        // load fitting deliveries list
        $oDleliveryList = oxNew( "oxDeliveryList", "core");
        $oDleliveryList->setCollectFittingDeliveriesSets( true );
        $aOrderDelSetList = $oDleliveryList->getDeliveryList( $oBasket, $oUser, $sShipID, null );

        return $aOrderDelSetList;
    }

    /**
     * Get vouchers numbers list which were used with this order
     *
     * @return array
     */
    public function getVoucherNrList()
    {
        $oDB = oxDb::getDb( true );
        $aVouchers = array();
        $sSelect =  "select oxvouchernr from oxvouchers where oxorderid = '".$this->oxorder__oxid->value."'";
        $rs = $oDB->execute( $sSelect);
        if ($rs != false && $rs->recordCount() > 0) {
            while (!$rs->EOF) {
                $aVouchers[] = $rs->fields['oxvouchernr'];
                $rs->moveNext();
            }
        }
        return $aVouchers;
    }

    /**
     * Returns orders total price
     *
     * @param bool $blToday if true calculates only current day orders
     *
     * @return int
     */
    public function getOrderSum( $blToday = false )
    {
        $sSelect  = 'select sum(oxtotalordersum / oxcurrate) from oxorder where ';
        $sSelect .= 'oxshopid = "'.$this->getConfig()->getShopId().'" and oxorder.oxstorno != "1" ';

        if ( $blToday ) {
            $sSelect .= 'and oxorderdate like "'.date( 'Y-m-d').'%" ';
        }

        return ( double ) oxDb::getDb()->getOne( $sSelect );
    }

    /**
     * Returns orders count
     *
     * @param bool $blToday if true calculates only current day orders
     *
     * @return int
     */
    public function getOrderCnt( $blToday = false )
    {
        $sSelect  = 'select count(*) from oxorder where ';
        $sSelect .= 'oxshopid = "'.$this->getConfig()->getShopId().'"  and oxorder.oxstorno != "1" ';

        if ( $blToday ) {
            $sSelect .= 'and oxorderdate like "'.date( 'Y-m-d').'%" ';
        }

        return ( int ) oxDb::getDb()->getOne( $sSelect );
    }


    /**
     * Checking if this order is already stored.
     *
     * @param string $sOxId order ID
     *
     * @return bool
     */
    protected function _checkOrderExist( $sOxId = null )
    {
        if ( !$sOxId) {
            return false;
        }

        if ( oxDb::getDb()->getOne( 'select oxid from oxorder where oxid = "'.$sOxId.'"' ) ) {
            return true;
        }

        return false;
    }

    /**
     * Send order to shop owner and user
     *
     * @param oxUser    $oUser    order user
     * @param oxBasket  $oBasket  current order basket
     * @param oxPayment $oPayment order payment
     *
     * @return bool
     */
    protected function _sendOrderByEmail( $oUser = null, $oBasket = null, $oPayment = null )
    {
        $iRet = 0;

        // add user, basket and payment to order
        $this->_oUser    = $oUser;
        $this->_oBasket  = $oBasket;
        $this->_oPayment = $oPayment;

        $oxEmail = oxNew( 'oxemail' );

        // send order email to user
        if ( $oxEmail->sendOrderEMailToUser( $this ) ) {
            // mail to user was successfully sent
            $iRet = 1;
        }

        // send order email to shop owner
        $oxEmail->sendOrderEMailToOwner( $this );

        return $iRet;
    }

    /**
     * Returns order user
     *
     * @return oxUser
     */
    public function getUser()
    {
        return $this->_oUser;
    }

    /**
     * Returns order basket
     *
     * @return oxBasket
     */
    public function getBasket()
    {
        return $this->_oBasket;
    }

    /**
     * Returns order payment
     *
     * @return oxBasket
     */
    public function getPayment()
    {
        return $this->_oPayment;
    }

    /**
     * Returns order vouchers marked as used
     *
     * @return array
     */
    public function getVoucherList()
    {
        return $this->_aVoucherList;
    }

    /**
     * Returns order deliveryset object
     *
     * @return oxDeliverySet
     */
    public function getDelSet()
    {
        if ( $this->_oDelSet == null ) {
            // load deliveryset info
            $this->_oDelSet = oxNew( 'oxdeliveryset' );
            $this->_oDelSet->load( $this->oxorder__oxdeltype->value );
        }

        return $this->_oDelSet;
    }

    /**
     * Get payment type
     *
     * @return oxPayment
     */
    public function getPaymentType()
    {
        if ( $this->oxorder__oxpaymentid->value && $this->_oPaymentType == null ) {
            $this->_oPaymentType = oxNew( 'oxuserpayment' );
            $this->_oPaymentType->load( $this->oxorder__oxpaymentid->value );
        }

        return $this->_oPaymentType;
    }

    /**
     * Get gift card
     *
     * @return oxWrapping
     */
    public function getGiftCard()
    {
        if ( $this->oxorder__oxcardid->value && $this->_oGiftCard == null ) {
            $this->_oGiftCard = oxNew( 'oxwrapping' );
            $this->_oGiftCard->load( $this->oxorder__oxcardid->value );
        }

        return $this->_oGiftCard;
    }

    /**
     * Set usage of seperate orders numbering for different shops
     *
     * @param bool $blSeparateNumbering use or not separate orders numbering
     *
     * @return bool
     */
    public function setSeparateNumbering( $blSeparateNumbering = null )
    {
        $this->_blSeparateNumbering = $blSeparateNumbering;
    }

    /**
     * Get users payment type from last order
     *
     * @param string $sUserId order user id
     *
     * @return string $sLastPaymentId payment id
     */
    public function getLastUserPaymentType( $sUserId)
    {
        $sQ = 'select oxorder.oxpaymenttype from oxorder where oxorder.oxshopid="'.$this->getConfig()->getShopId().'" and oxorder.oxuserid="'.$sUserId.'" order by oxorder.oxorderdate desc ';
        $sLastPaymentId = oxDb::getDb()->getOne( $sQ );
        return $sLastPaymentId;
    }

    /**
     * Make select list array from oxorderarticles__oxselvariant string.
     * This select list array is used when recalculating order and adding
     * items to basket (oxBasket::addToBaske())
     *
     * @param string $sArtId           order article ID
     * @param string $sOrderArtSelList select list string stored in oxorderarticles__oxselvariant
     *
     * @return array()
     */
    protected function _makeSelListArray( $sArtId = null, $sOrderArtSelList = null )
    {
        $aList = array();
        $aRet  = array();

        if ( $sArtId ) {
            $aList = explode( ",", $sOrderArtSelList );

            //$oArticle = oxNew( "oxArticle", "core" );
            $oArticle = oxNew( "oxArticle" );
            $oArticle->load( $sArtId );
            $aArticleSelList = $oArticle->getSelectLists();

            //formating temporary list array from string
            foreach ( $aList as $sList ) {
                if ( $sList ) {

                    $aVal = explode( ":", $sList );

                    if ( isset($aVal[0]) && isset($aVal[1])) {
                        $sOrderArtListTitle = strtolower( trim($aVal[0]) );
                        $sOrderArtSelValue  = strtolower( trim($aVal[1]) );

                        //checking article list for matches with article list stored in oxorderitem
                        $iSelListNum = 0;
                        if ( count($aArticleSelList) > 0 ) {
                            foreach ( $aArticleSelList as $aSelect ) {
                                //chek if selects titles are equal

                                if ( strtolower($aSelect['name']) == $sOrderArtListTitle ) {
                                    //try to find matching select items value
                                    $iSelValueNum = 0;
                                    foreach ( $aSelect as $oSel ) {
                                        if ( strtolower($oSel->name) == $sOrderArtSelValue ) {
                                            // found, adding tu return array
                                            $aRet[$iSelListNum] = $iSelValueNum;
                                        }
                                        //next article list item
                                        $iSelValueNum++;
                                    }
                                }
                                //next article list
                                $iSelListNum++;
                            }
                        }
                    }
                }
            }
        }

        return $aRet;
    }

    /**
     * Adds order articles back to virtual basket. Needed for recalculating order.
     *
     * @param oxUser $oUser            basket user object
     * @param array  $aOrderArticles   order articles
     * @param bool   $blChangeDelivery if delivery was changed in admin
     *
     * @return oxBasket
     */
    protected function _addOrderArticlesToBasket( $oUser = null, $aOrderArticles = null, $blChangeDelivery = false )
    {
        $myConfig = $this->getConfig();

        $oBasket = oxNew( "oxbasket" );

        // setting virtual basket user
        $oBasket->setBasketUser( $oUser );

        // setting basket currency order uses
        $aCurrencies = $myConfig->getCurrencyArray();
        foreach ($aCurrencies as $oCur) {
            if ($oCur->name == $this->oxorder__oxcurrency->value) {
                $oBasketCur = $oCur;
                break;
            }
        }

        $oBasket->setBasketCurrency( $oBasketCur );

        // if no order articles, return empty basket
        if (count($aOrderArticles) < 1) {
            return $oBasket;
        }

        //adding order articles to basket
        foreach ( $aOrderArticles as $oOrderArticle ) {
            $sArtId      = $oOrderArticle->oxorderarticles__oxartid->value;
            $dAmount     = $oOrderArticle->oxorderarticles__oxamount->value;
            $sSelVariant = $oOrderArticle->oxorderarticles__oxselvariant->value;

            if ( $oOrderArticle->oxorderarticles__oxpersparam->value ) {
                $aPersParam = unserialize($oOrderArticle->oxorderarticles__oxpersparam->value);
            } else {
                $aPersParam = null;
            }

            $aSel = $this->_makeSelListArray( $sArtId, $sSelVariant );

            $oBasketItem = $oBasket->addToBasket( $sArtId, $dAmount, $aSel, $aPersParam );
            if ( $oBasketItem ) {
                $oBasketItem->setWrapping( $oOrderArticle->oxorderarticles__oxwrapid->value );
            }
        }

        // set basket card id and message
        $oBasket->setCardId( $this->oxorder__oxcardid->value );
        $oBasket->setCardMessage( $this->oxorder__oxcardtext->value );

        // set skip vouchers availability checking
        $oBasket->setSkipVouchersChecking( true );

        // add previously used vouchers
        $sQ = 'select oxid from oxvouchers where oxorderid = "'.$this->getId().'"';
        $aVouchers = oxDb::getDb( true )->getAll( $sQ );
        foreach ( $aVouchers AS $aVoucher ) {
            $oBasket->addVoucher($aVoucher['oxid']);
        }

        //set shipping
        $oBasket->setShipping( $this->oxorder__oxdeltype->value );
        //V #M429: Shipping and total prices were not calculated correct 
        //when user changed delivery costs in admin 
        if ( $blChangeDelivery ) {
            $oBasket->setDeliveryPrice( $this->getOrderDeliveryPrice() );
        }
        //set basket payment
        $oBasket->setPayment( $this->oxorder__oxpaymenttype->value );

        // recalculating basket
        $oBasket->calculateBasket( true );

        return $oBasket;
    }

    /**
     * Sets deprecate values
     *
     * @deprecated This method as well as all deprecated class variables is deprecated
     *
     * @return null
     */
    protected function _setDeprecatedValues()
    {
        if ( $this->oxorder__oxstorno->value != 1 ) {
            $oCur = $this->getConfig()->getActShopCurrencyObject();

            $this->totalnetsum   = $this->oxorder__oxtotalnetsum->value;
            $this->totalbrutsum  = $this->oxorder__oxtotalbrutsum->value;
            $this->totalorder    = $this->oxorder__oxtotalordersum->value;
            $this->ftotalnetsum  = oxLang::getInstance()->formatCurrency( $this->oxorder__oxtotalnetsum->value, $oCur );
            $this->ftotalbrutsum = oxLang::getInstance()->formatCurrency( $this->oxorder__oxtotalbrutsum->value, $oCur );
            $this->fdelcost      = oxLang::getInstance()->formatCurrency( $this->oxorder__oxdelcost->value, $oCur );
            $this->fpaycost      = oxLang::getInstance()->formatCurrency( $this->oxorder__oxpaycost->value, $oCur );
            $this->fwrapcost     = oxLang::getInstance()->formatCurrency( $this->oxorder__oxwrapcost->value, $oCur );
            $this->ftotalorder   = $this->getTotalOrderSum();
            $this->totalvouchers = 0;

            if ( $this->oxorder__oxvoucherdiscount->value ) {
                $this->totalvouchers  = oxLang::getInstance()->formatCurrency( $this->oxorder__oxvoucherdiscount->value, $oCur );
            }

            if ( $this->oxorder__oxdiscount->value ) {
                $this->discount  = $this->oxorder__oxdiscount->value;
                $this->fdiscount = oxLang::getInstance()->formatCurrency( $this->oxorder__oxdiscount->value, $oCur );
            }
        }
    }

    /**
     * Get total sum from last order
     *
     * @return string
     */
    public function getTotalOrderSum()
    {
        $oCur = $this->getConfig()->getActShopCurrencyObject();
        return oxLang::getInstance()->formatCurrency( $this->oxorder__oxtotalordersum->value, $oCur );
    }

}
