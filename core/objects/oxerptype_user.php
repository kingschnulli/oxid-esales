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
 * @version OXID eShop CE
 * $Id: oxerptype_user.php 16303 2009-02-05 10:23:41Z rimvydas.paskevicius $
 */

require_once( 'oxerptype.php');
require_once( realpath(dirname(__FILE__).'/../oxerpcompatability.php'));

class oxERPType_User extends oxERPType
{
    static $CAN_NOT_IMPORT_SALT = 'ERROR: Can not import user password salt to shop config.';
    protected $_aFieldListVersions = array(
        '1' => array(
            'OXID'           => 'OXID',
            'OXACTIV'        => 'OXACTIV',
            'OXRIGHTS'       => 'OXRIGHTS',
            'OXSHOPID'       => 'OXSHOPID',
            'OXUSERNAME'     => 'OXUSERNAME',
            'OXPASSWORD'     => 'OXPASSWORD',
            'OXCUSTNR'       => 'OXCUSTNR',
            'OXUSTID'        => 'OXUSTID',
            'OXCOMPANY'      => 'OXCOMPANY',
            'OXFNAME'        => 'OXFNAME',
            'OXLNAME'        => 'OXLNAME',
            'OXSTREET'       => 'OXSTREET',
            'OXSTREETNR'     => 'OXSTREETNR',
            'OXADDINFO'      => 'OXADDINFO',
            'OXCITY'         => 'OXCITY',
            'OXCOUNTRY'      => 'OXCOUNTRY',
            'OXCOUNTRYID'    => 'OXCOUNTRYID', //hard to obtain for external users, use getCountries ERP method, it should be correct countryid
            'OXZIP'          => 'OXZIP',
            'OXFON'          => 'OXFON',
            'OXFAX'          => 'OXFAX',
            'OXSAL'          => 'OXSAL',
            'OXBONI'         => 'OXBONI',
            'OXCREATE'       => 'OXCREATE', //always now
            'OXREGISTER'     => 'OXREGISTER',
            'OXPRIVFON'      => 'OXPRIVFON',
            'OXMOBFON'       => 'OXMOBFON',
            'OXBIRTHDATE'    => 'OXBIRTHDATE',
            'OXURL'          => 'OXURL',
            'OXBUERGELLASTCHECK'         => 'OXBUERGELLASTCHECK',
            'OXBUERGELTEXT'  => 'OXBUERGELTEXT',
            'OXBUERGELADRESSSTATUS'      => 'OXBUERGELADRESSSTATUS',
            'OXBUERGELADRESSTEXT'        => 'OXBUERGELADRESSTEXT',
            'OXDISABLEAUTOGRP'           => 'OXDISABLEAUTOGRP',
            'OXLDAPKEY'      => 'OXLDAPKEY',
            'OXWRONGLOGINS'  => 'OXWRONGLOGINS'
        ),
        '2' => array(
            'OXID' => 'OXID',
            'OXACTIVE' => 'OXACTIVE',
            'OXRIGHTS' => 'OXRIGHTS',
            'OXSHOPID' => 'OXSHOPID',
            'OXUSERNAME' => 'OXUSERNAME',
            'OXPASSWORD' => 'OXPASSWORD',
            'OXCUSTNR' => 'OXCUSTNR',
            'OXUSTID' => 'OXUSTID',
            'OXUSTIDSTATUS' => 'OXUSTIDSTATUS',
            'OXCOMPANY' => 'OXCOMPANY',
            'OXFNAME' => 'OXFNAME',
            'OXLNAME' => 'OXLNAME',
            'OXSTREET' => 'OXSTREET',
            'OXSTREETNR' => 'OXSTREETNR',
            'OXADDINFO' => 'OXADDINFO',
            'OXCITY' => 'OXCITY',
            'OXCOUNTRYID' => 'OXCOUNTRYID',
            'OXZIP' => 'OXZIP',
            'OXFON' => 'OXFON',
            'OXFAX' => 'OXFAX',
            'OXSAL' => 'OXSAL',
            'OXBONI' => 'OXBONI',
            'OXCREATE' => 'OXCREATE',
            'OXREGISTER' => 'OXREGISTER',
            'OXPRIVFON' => 'OXPRIVFON',
            'OXMOBFON' => 'OXMOBFON',
            'OXBIRTHDATE' => 'OXBIRTHDATE',
            'OXURL' => 'OXURL',
            'OXDISABLEAUTOGRP' => 'OXDISABLEAUTOGRP',
            'OXLDAPKEY' => 'OXLDAPKEY',
            'OXWRONGLOGINS' => 'OXWRONGLOGINS',
        ),
    );

    public function __construct()
    {
        parent::__construct();

        $oCompat = oxNew('OXERPCompatability');
        if ($oCompat->isPasswordSaltInOxUser() && (oxERPBase::getUsedDbFieldsVersion() < 3)) {
            // also read OXPASSSALT, which will be included into combo, but removed from output
            $this->_aFieldList['OXPASSSALT'] = 'OXPASSSALT';
        }

        $this->_sTableName      = 'oxuser';
        $this->_sShopObjectName = 'oxuser';
    }

    /**
     * returns SQL string for this type
     *
     * @param string $sWhere
     * @param integer $iLanguage
     * @return string
     */
    public function getSQL( $sWhere, $iLanguage = 0,$iShopID = 1)
    {
        $myConfig = oxConfig::getInstance();

        // add type 'user' for security reasons
        if( strstr( $sWhere, 'where'))
            $sWhere .= ' and ';
        else
            $sWhere .= ' where ';

        $sWhere .= ' oxrights = \'user\'';
        //MAFI also check for shopid to restrict access
        if(!$myConfig->getConfigParam('blMallUsers')){
            $sWhere .= ' AND oxshopid = \''.$iShopID.'\'';
        }

        return parent::getSQL( $sWhere, $iLanguage);;
    }

    public function checkWriteAccess($sOxid)
    {
        $myConfig = oxConfig::getInstance();

        if (!$myConfig->getConfigParam('blMallUsers')) {
            parent::checkWriteAccess($sOxid);
        }
    }

    public function getObjectForDeletion( $sId)
    {
        $myConfig = oxConfig::getInstance();

        if( !isset($sId))
            throw new Exception( "Missing ID!");

        $oUser = oxNew( $this->getShopObjectName(), "core");
        if(!$oUser->exists($sId)){
            throw new Exception( $this->getShopObjectName(). " " . $sId. " does not exists!");
        }

        //We must load the object here, to check shopid and return it for further checks
        $oUser->Load($sId);

        //if blMallUsers is true its possible to delete all users of all shops
        if($oUser->getShopId() != $myConfig->getShopId() && !$myConfig->getConfigParam('blMallUsers'))
            throw new Exception( "No right to delete object {$sId} !");

        //set to false, to allow a deletion, even if its normally not allowed
        $oUser->setIsDerived(false);
        return $oUser;
    }

    public function getFunctionSuffix()
    {
        return parent::getFunctionSuffix();
    }

    /**
     * return sql column name of given table column
     *
     * @param string $sField
     * @param int    $iLanguage
     *
     * @return string
     */
    protected function getSqlFieldName($sField, $iLanguage = 0, $iShopID = 1)
    {
        if ('1' == oxERPBase::getUsedDbFieldsVersion()) {
            switch ($sField) {
                case 'OXACTIV':
                    return "OXACTIVE as OXACTIV";
                case 'OXACTIVFROM':
                    return "OXACTIVEFROM as OXACTIVEFROM";
                case 'OXACTIVTO':
                    return "OXACTIVETO as OXACTIVTO";
                case 'OXCOUNTRY':
                    return "(select oxtitle from oxcountry where oxcountry.oxid=OXCOUNTRYID limit 1) as OXCOUNTRY";
                case 'OXBUERGELLASTCHECK':
                    return "'0000-00-00 00:00:00' as $sField";
                case 'OXBUERGELADRESSSTATUS':
                    return "'0' as $sField";
                case 'OXBUERGELTEXT':
                case 'OXBUERGELADRESSTEXT':
                    return "'' as $sField";
            }
        }

        return parent::getSqlFieldName($sField, $iLanguage, $iShopID);
    }


    /**
     * issued before saving an object. can modify aData for saving
     *
     * @param oxBase $oShopObject
     * @param array  $aData
     * @param bool   $blAllowCustomShopId
     *
     * @return array
     */
    protected function _preAssignObject($oShopObject, $aData, $blAllowCustomShopId)
    {
        $aData = parent::_preAssignObject($oShopObject, $aData, $blAllowCustomShopId);

        $oCompat = oxNew('OXERPCompatability');
        if ($oCompat->isPasswordSaltSupported() && (oxERPBase::getUsedDbFieldsVersion() < 3)) {
            // emulate passwd and salt with only passwd field: check if combined
            // combine rules: array(passwd, salt, md5(passwd+salt))
            $aCombo = @explode(':', $aData['OXPASSWORD']);
            if (is_array($aCombo) && (3 == count($aCombo)) && (md5($aCombo[0].$aCombo[1]) == $aCombo[2])) {
                // combo detected
                $aData['OXPASSWORD'] = $aCombo[0];
                if ($oCompat->isPasswordSaltInOxUser()) {
                    $aData['OXPASSSALT'] = $aCombo[1];
                } else {
                    $sConfigSalt = oxConfig::getInstance()->getConfigParam( 'sPasswdSalt' );
                    $sConfigSalt = unpack('H*', $sConfigSalt);
                    $sConfigSalt = $sConfigSalt[1];
                    if ($aCombo[1] != $sConfigSalt) {
                        // note: can not import config value here, since it will break other passwds
                        throw new Exception( self::$CAN_NOT_IMPORT_SALT );
                    }
                }
            }
        }
        return $aData;
    }

    /**
     * prepares object for saving in shop
     * returns true if save can proceed further
     *
     * @param $oShopObject
     * @param $aData
     *
     * @return boolean
     */
    protected function _preSaveObject($oShopObject, $aData)
    {
        $oCompat = oxNew('OXERPCompatability');
        if ($oCompat->isPasswordSaltSupported()) {
            if (method_exists($oShopObject, 'getPasswordHash')) {
                $oShopObject->getPasswordHash();
            } else {
                if ( $oShopObject->oxuser__oxpassword->value ) {
                    if ( strpos( $oShopObject->oxuser__oxpassword->value, 'ox_' ) === 0 ) {
                        // decodable pass ?
                        $oShopObject->setPassword( oxUtils::getInstance()->strRem( $oShopObject->oxuser__oxpassword->value ) );
                    } elseif ( ( strlen( $oShopObject->oxuser__oxpassword->value ) < 32 ) && ( strpos( $oShopObject->oxuser__oxpassword->value, 'openid_' ) !== 0 ) ) {
                        // plain pass ?
                        $oShopObject->setPassword( $oShopObject->oxuser__oxpassword->value );
                    }
                }
            }
        }
        return parent::_preSaveObject($oShopObject, $aData);
    }

    /**
     * We have the possibility to add some data
     *
     * @param array $aFields
     */
    public function addExportData( $aFields)
    {
        $oCompat = oxNew('OXERPCompatability');
        if ($oCompat->isPasswordSaltSupported() && (oxERPBase::getUsedDbFieldsVersion() < 3)) {
            $sSalt = '';
            if ($oCompat->isPasswordSaltInOxUser()) {
                $sSalt = $aFields['OXPASSSALT'];
                $aFields['OXPASSSALT'] = null;
                unset($aFields['OXPASSSALT']);
            } else {
                $sSalt = oxConfig::getInstance()->getConfigParam( 'sPasswdSalt' );
                $sSalt = unpack('H*', $sSalt);
                $sSalt = $sSalt[1];
            }
            $sCheckSum = md5($aFields['OXPASSWORD'].$sSalt);
            $aFields['OXPASSWORD'] = implode(':', array($aFields['OXPASSWORD'], $sSalt, $sCheckSum));
        }
        return $aFields;
    }

}
