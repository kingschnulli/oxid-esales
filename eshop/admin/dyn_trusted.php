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
 * @package   admin
 * @copyright (C) OXID eSales AG 2003-2010
 * @version OXID eShop CE
 * @version   SVN: $Id: dyn_trusted.php 28362 2010-06-16 08:07:55Z vilma $
 */


/**
 * Admin dyn trusted manager.
 * @package admin
 * @subpackage dyn
 */
class dyn_trusted extends Shop_Config
{
    protected $_aTSPaymentIds = array('DIRECT_DEBIT','CREDIT_CARD','INVOICE','CASH_ON_DELIVERY','PREPAYMENT','CHEQUE','PAYBOX','PAYPAL','CASH_ON_PICKUP','FINANCING','LEASING','T_PAY','CLICKANDBUY','GIROPAY','GOOGLE_CHECKOUT','SHOP_CARD','DIRECT_E_BANKING','OTHER');

    /**
     * Creates shop object, passes shop data to Smarty engine and returns name of
     * template file "dyn_trusted.tpl".
     *
     * @return string
     */
    public function render()
    {
        parent::render();
        $this->_aViewData['oxid'] = $this->getConfig()->getShopId();
        $aConfStr = array();
        $aConfBool = array();
        $aIds     = $this->_aViewData["confaarrs"]['iShopID_TrustedShops'];
        // compability to old data
        if ( $aConfStrs = $this->_aViewData["str"]['iShopID_TrustedShops'] ) {
            $aIds = array( 0 => $aConfStrs );
        }

        $this->_aViewData["aShopID_TrustedShops"] = $aIds;
        $this->_aViewData['tsUser'] = $this->_aViewData["confstrs"]['tsUser'];
        $this->_aViewData['tsPassword'] = $this->_aViewData["confstrs"]['tsPassword'];
        $this->_aViewData['tsTestMode'] = $this->_aViewData["confbools"]['tsTestMode'];
        $this->_aViewData['tsSealActive'] = $this->_aViewData["confbools"]['tsSealActive'];
        $this->_aViewData["alllang"] = oxLang::getInstance()->getLanguageNames();
        $this->_aViewData["shoppaymenttypes"] = $this->getPaymentTypes();
        $this->_aViewData["tspaymenttypes"] = $this->_aTSPaymentIds;

        return "dyn_trusted.tpl";
    }

    /**
     * Saves changed shop configuration parameters.
     *
     * @return mixed
     */
    public function save()
    {
        $aConfStr = oxConfig::getParameter( "aShopID_TrustedShops" );
        $aPaymentIds = oxConfig::getParameter( "paymentids" );
        
        if ( $aPaymentIds ) {
            foreach ( $aPaymentIds as $sShopPayId => $sTsPayId ) {
                $aPayment = oxNew("oxpayment");
                if ( $aPayment->load($sShopPayId) ) {
                    $aPayment->oxpayments__oxtspaymentid = new oxField($sTsPayId);
                    $aPayment->save();
                }
            }
        }
        $blSave = true;
        $blNotEmpty = false;
        foreach ( $aConfStr as $sConfStrs ) {
            if ( $sConfStrs ) {
                $blNotEmpty = true;
                if ( strlen( $sConfStrs ) != 33 || substr( $sConfStrs, 0, 1 ) != 'X' ) {
                    $blSave = false;
                }
            }
        }

        $aTSIds = array_filter( $aConfStr );
        if ( $blNotEmpty && ( count( array_unique( $aTSIds ) ) < count( $aTSIds ) ) ) {
            $blSave = false;
        }

        if ( $blSave ) {
            $myConfig = $this->getConfig();
            $sShopId = $myConfig->getShopId();
            $myConfig->saveShopConfVar( "aarr", 'iShopID_TrustedShops', $aConfStr, $sShopId );
            $myConfig->saveShopConfVar( "str", 'tsUser', oxConfig::getParameter( "tsUser" ), $sShopId );
            $myConfig->saveShopConfVar( "str", 'tsPassword', oxConfig::getParameter( "tsPassword" ), $sShopId );
            $myConfig->saveShopConfVar( "bool", 'tsTestMode', oxConfig::getParameter( "tsTestMode" ), $sShopId );
            $myConfig->saveShopConfVar( "bool", 'tsSealActive', oxConfig::getParameter( "tsSealActive" ), $sShopId );
        } else {
            // displaying error..
            $this->_aViewData["errorsaving"] = 1;
            $this->_aViewData["aShopID_TrustedShops"] = null;
        }
    }

    /**
     * Returns view id ('dyn_interface')
     *
     * @return string
     */
    public function getViewId()
    {
        return 'dyn_interface';
    }

    /**
     * Returns selected Payment Id
     *
     * @return object
     */
    public function getPaymentTypes()
    {
        if ( $this->_oPaymentTypes == null ) {

            // all paymenttypes
            $this->_oPaymentTypes = oxNew( "oxlist" );
            $this->_oPaymentTypes->init( "oxpayment");
            $oListObject = $this->_oPaymentTypes->getBaseObject();
            $oListObject->setLanguage( oxLang::getInstance()->getObjectTplLanguage() );
            $this->_oPaymentTypes->getList();
        }
        return $this->_oPaymentTypes;
    }

}
