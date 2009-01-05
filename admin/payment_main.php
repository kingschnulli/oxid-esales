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
 * @package admin
 * @copyright � OXID eSales AG 2003-2009
 * $Id: payment_main.php 14023 2008-11-06 13:40:55Z arvydas $
 */

/**
 * Admin article main payment manager.
 * Performs collection and updatind (on user submit) main item information.
 * Admin Menu: Shop Settings -> Payment Methods -> Main.
 * @package admin
 */
class Payment_Main extends oxAdminDetails
{
    /**
     * Keeps all act. fields to store
     */
    protected $_aFieldArray = null;

    /**
     * Executes parent method parent::render(), creates oxlist object,
     * passes it's data to Smarty engine and retutns name of template
     * file "payment_main.tpl".
     *
     * @return string
     */
    public function render()
    {   $myConfig = $this->getConfig();

        parent::render();

        // remove itm from list
        unset( $this->_aViewData["sumtype"][2]);

            // all usergroups
            $oGroups = oxNew( "oxlist" );
            $oGroups->init( "oxgroups");
            $oGroups->selectString( "select * from oxgroups" );
        $soxId = oxConfig::getParameter( "oxid");
        // check if we right now saved a new entry
        $sSavedID = oxConfig::getParameter( "saved_oxid");
        if ( ($soxId == "-1" || !isset( $soxId)) && isset( $sSavedID) ) {
            $soxId = $sSavedID;
            oxSession::deleteVar( "saved_oxid");
            $this->_aViewData["oxid"] =  $soxId;
            // for reloading upper frame
            $this->_aViewData["updatelist"] =  "1";
        }

        if ( $soxId != "-1" && isset( $soxId)) {
            // load object
            $oPayment = oxNew( "oxpayment" );
            $oPayment->loadInLang( $this->_iEditLang, $soxId );

            $oOtherLang = $oPayment->getAvailableInLangs();
            if (!isset($oOtherLang[$this->_iEditLang])) {
                // echo "language entry doesn't exist! using: ".key($oOtherLang);
                $oPayment->loadInLang( key($oOtherLang), $soxId );
            }
            $this->_aViewData["edit"] =  $oPayment;

            // remove already created languages
            $aLang = array_diff ( oxLang::getInstance()->getLanguageNames(), $oOtherLang);
            if ( count( $aLang))
                $this->_aViewData["posslang"] = $aLang;

            foreach ( $oOtherLang as $id => $language) {
                $oLang = new oxStdClass();
                $oLang->sLangDesc = $language;
                $oLang->selected = ($id == $this->_iEditLang);
                $this->_aViewData["otherlang"][$id] = clone $oLang;
            }

            // #708
            $this->_aViewData['aFieldNames'] = oxUtils::getInstance()->assignValuesFromText( $oPayment->oxpayments__oxvaldesc->value );

        }

        if ( oxConfig::getParameter("aoc") ) {

            $aColumns = array();
            include_once 'inc/'.strtolower(__CLASS__).'.inc.php';
            $this->_aViewData['oxajax'] = $aColumns;

            return "popups/payment_main.tpl";
        }
        return "payment_main.tpl";
    }

    /**
     * Saves payment parameters changes.
     *
     * @return mixed
     */
    public function save()
    {
        $myConfig  = $this->getConfig();


        $soxId      = oxConfig::getParameter( "oxid");
        $aParams    = oxConfig::getParameter( "editval");
        // checkbox handling
        if ( !isset( $aParams['oxpayments__oxactive']))
            $aParams['oxpayments__oxactive'] = 0;
        if ( !isset( $aParams['oxpayments__oxchecked']))
            $aParams['oxpayments__oxchecked'] = 0;

        $oPayment = oxNew( "oxpayment" );

        if ( $soxId != "-1")
            $oPayment->loadInLang( $this->_iEditLang, $soxId );
        else
            $aParams['oxpayments__oxid'] = null;
        //$aParams = $oPayment->ConvertNameArray2Idx( $aParams);

        $oPayment->setLanguage(0);
        $oPayment->assign( $aParams);

        //#708
        if ( !is_array( $this->_aFieldArray))
            $this->_aFieldArray = oxUtils::getInstance()->assignValuesFromText( $oPayment->oxpayments__oxvaldesc->value );
        // build value
        $sValdesc = "";
        foreach ( $this->_aFieldArray as $oField)
            $sValdesc .= $oField->name . "__@@";

        $oPayment->oxpayments__oxvaldesc = new oxField( $sValdesc, oxField::T_RAW );
        $oPayment->setLanguage($this->_iEditLang);
        $oPayment->save();
        $this->_aViewData["updatelist"] = "1";

        // set oxid if inserted
        if ( $soxId == "-1")
            oxSession::setVar( "saved_oxid", $oPayment->oxpayments__oxid->value);

        return $this->autosave();
    }

    /**
     * Saves payment parameters data in dofferent language (eg. english).
     *
     * @return null
     */
    public function saveinnlang()
    {
        $myConfig  = $this->getConfig();


        $soxId      = oxConfig::getParameter( "oxid");
        $aParams    = oxConfig::getParameter( "editval");

            // shopid
            $sShopID = oxSession::getVar( "actshop");
            $aParams['oxpayments__oxshopid'] = $sShopID;
        $oObj = oxNew( "oxpayment" );

        if ( $soxId != "-1")
            $oObj->loadInLang( $this->_iEditLang, $soxId );
        else
            $aParams['oxpayments__oxid'] = null;
        //$aParams = $oObj->ConvertNameArray2Idx( $aParams);

        $oObj->setLanguage(0);
        $oObj->assign( $aParams);

        // apply new language
        $sNewLanguage = oxConfig::getParameter( "new_lang");
        $oObj->setLanguage( $sNewLanguage);
        $oObj->save();
        $this->_aViewData["updatelist"] = "1";

        // set for reload
        oxSession::setVar( "new_lang", $sNewLanguage);

        // set oxid if inserted
        if ( $soxId == "-1")
            oxSession::setVar( "saved_oxid", $oObj->oxpayments__oxid->value);
    }

    /**
     * Deletes field from field array and stores object
     *
     * @return null
     */
    public function delFields()
    {
        $myConfig = $this->getConfig();


        $soxId    = oxConfig::getParameter( "oxid");
        $oPayment = oxNew( "oxpayment" );
        $oPayment->loadInLang( $this->_iEditLang, $soxId );

        $aDelFields = oxConfig::getParameter("aFields");
        $this->_aFieldArray = oxUtils::getInstance()->assignValuesFromText( $oPayment->oxpayments__oxvaldesc->value );

        if ( isset( $aDelFields) && count( $aDelFields)) {
            foreach ( $aDelFields as $sDelField) {
                foreach ( $this->_aFieldArray as $key => $oField) {
                    if ( $oField->name == $sDelField) {
                        unset(  $this->_aFieldArray[$key]);
                        break;
                    }
                }
            }
            $this->save();
        }
    }

    /**
     * Adds a field to field array and stores object
     *
     * @return null
     */
    public function addField()
    {
        $myConfig = $this->getConfig();


        $soxId = oxConfig::getParameter( "oxid");
        $oPayment = oxNew( "oxpayment" );
        $oPayment->loadInLang( $this->_iEditLang, $soxId );

        $sAddField = oxConfig::getParameter("sAddField");
        $this->_aFieldArray = oxUtils::getInstance()->assignValuesFromText( $oPayment->oxpayments__oxvaldesc->value );

        $oField = new stdClass();
        $oField->name = $sAddField;

        $this->_aFieldArray[] = $oField;

        $this->save();
    }

}
