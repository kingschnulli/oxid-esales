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
 * @copyright � OXID eSales AG 2003-2008
 * $Id: user_main.php 13619 2008-10-24 09:40:23Z sarunas $
 */

/**
 * Admin article main user manager.
 * Performs collection and updatind (on user submit) main item information.
 * Admin Menu: User Administration -> Users -> Main.
 * @package admin
 */
class User_main extends oxAdminDetails
{
    private $_sSaveError = null;

    /**
     * Executes parent method parent::render(), creates oxuser, oxshops and oxlist
     * objects, passes data to Smarty engine and returns name of template
     * file "user_main.tpl".
     *
     * @return string
     */
    public function render()
    {
        $myConfig = $this->getConfig();
        $soxId = oxConfig::getParameter( "oxid");

        parent::render();

        // malladmin stuff
        $oAuthUser = oxUser::getAdminUser();
        $blisMallAdmin = $oAuthUser->oxuser__oxrights->value == "malladmin";

            // all usergroups
            $oGroups = oxNew( "oxlist" );
            $oGroups->init( "oxgroups" );
            $oGroups->selectString( "select * from oxgroups order by oxgroups.oxtitle" );

        // User rights
        $aUserRights = array();

        $iPos = count( $aUserRights );
        $aUserRights[$iPos] = new OxstdClass();
        $aUserRights[$iPos]->name = oxLang::getInstance()->translateString( "user", oxLang::getInstance()->getTplLanguage() );
        $aUserRights[$iPos]->id   = "user";

        if ( $blisMallAdmin ) {
            $iPos = count( $aUserRights );
            $aUserRights[$iPos] = new OxstdClass();
            $aUserRights[$iPos]->id   = "malladmin";
            $aUserRights[$iPos]->name = oxLang::getInstance()->translateString( "Admin", oxLang::getInstance()->getTplLanguage() );
        }


        $soxId = oxConfig::getParameter( "oxid");
        // check if we right now saved a new entry
        $sSavedID = oxConfig::getParameter( "saved_oxid");
        if ( ( $soxId == "-1" || !isset( $soxId ) ) && isset( $sSavedID ) ) {
            $soxId = $sSavedID;
            oxSession::deleteVar( "saved_oxid");
            $this->_aViewData["oxid"] =  $soxId;
            // for reloading upper frame
            $this->_aViewData["updatelist"] =  "1";
        }

        if ( $soxId != "-1" && isset( $soxId ) ) {
            // load object
            $oUser = oxNew( "oxuser" );
            $oUser->load( $soxId);
            $this->_aViewData["edit"] =  $oUser;

            if ( !( $oUser->oxuser__oxrights->value == "malladmin" && !$blisMallAdmin ) ) {
                // generate selected right
                reset( $aUserRights );
                while ( list(, $val ) = each( $aUserRights ) ) {
                    if ( $val->id == $oUser->oxuser__oxrights->value) {
                        $val->selected = 1;
                        break;
                    }
                }
            }
        }

        // passing country list
        $oCountryList = oxNew( "oxCountryList" );
        $oCountryList->loadActiveCountries( oxLang::getInstance()->getTplLanguage() );

        $this->_aViewData["countrylist"] = $oCountryList;

            $this->_aViewData["allgroups"] =  $oGroups;

        $this->_aViewData["rights"] =  $aUserRights;

        if ($this->_sSaveError) {
            $this->_aViewData["sSaveError"] = $this->_sSaveError;
        }

        if (!$this->_allowAdminEdit($soxId))
            $this->_aViewData['readonly'] = true;
        if ( oxConfig::getParameter("aoc") ) {

            $aColumns = array();
            include_once 'inc/'.strtolower(__CLASS__).'.inc.php';
            $this->_aViewData['oxajax'] = $aColumns;

            return "popups/user_main.tpl";
        }
        return "user_main.tpl";
    }

    /**
     * Saves main user parameters.
     *
     * @return mixed
     */
    public function save()
    {
        $myConfig = $this->getConfig();


        $soxId      = oxConfig::getParameter( "oxid");
        $aParams    = oxConfig::getParameter( "editval");

        //allow admin information edit only for MALL admins
        if (!$this->_allowAdminEdit($soxId))
            return;

        // checkbox handling
        if ( !isset( $aParams['oxuser__oxactive']))
            $aParams['oxuser__oxactive'] = 0;

        //setting password
        if (oxConfig::getParameter("newPassword")) {
            $aParams['oxuser__oxpassword'] = oxConfig::getParameter("newPassword");
        }

        // #1899 (R)
        if ( isset($aParams['oxuser__oxcompany']))
            oxConfig::checkSpecialChars($aParams['oxuser__oxcompany']);

        $oUser = oxNew( "oxuser" );
        if ( $soxId != "-1")
            $oUser->load( $soxId);
        else
            $aParams['oxuser__oxid'] = null;

        //FS#2167 V checks for already used email
        if ( $oUser->checkIfEmailExists($aParams['oxuser__oxusername'])) {
            $this->_sSaveError = 'EXCEPTION_USER_USEREXISTS';
            return;
        }

        //#1006T
        //special treatment for newsletter fields
        /* $aParams["oxuser__oxdboptin"] = $oUser->oxuser__oxdboptin->value;
        $aParams["oxuser__oxemailfailed"] = $oUser->oxuser__oxemailfailed->value;*/

        //$aParams = $oUser->ConvertNameArray2Idx( $aParams);
        $oUser->assign( $aParams);

        $sRights = $oUser->oxuser__oxrights->value;


        // A. changing field type to save birth date correctly
        $oUser->oxuser__oxbirthdate->fldtype = 'char';

        try {
            $oUser->save();
            $this->_aViewData["updatelist"] = "1";

            // set oxid if inserted
            if ( $soxId == "-1")
                oxSession::setVar( "saved_oxid", $oUser->oxuser__oxid->value);

            return $this->autosave();
        } catch (Exception $e) {
            $this->_sSaveError = $e->getMessage();
        }
    }
}
