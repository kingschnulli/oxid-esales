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
 * @copyright � OXID eSales AG 2003-2009
 * $Id: oxerptype_articlestock.php 16000 2009-01-28 15:27:22Z rimvydas.paskevicius $
 */

require_once( 'oxerptype.php');

class oxERPType_ArticleStock extends oxERPType
{

    public function __construct()
    {
        parent::__construct();

        $this->_sTableName      = 'oxarticles';
        $this->_sShopObjectName = 'oxarticle';
        $this->_blRestrictedByShopId = true;

        $this->_aFieldList = array(
            'OXID'           => 'OXID',
            'OXSTOCK'        => 'OXSTOCK',
        );
    }

    public function checkWriteAccess($sOxid)
    {
        //extend the write access to NOT write into nonexisting articles

        $myConfig = oxConfig::getInstance();

        $oDB = oxDb::getDb();

        $sSql = "select oxid from ". $this->getTableName($myConfig->getShopId()) ." where oxid = '". $sOxid ."'";
        $sRes = $oDB->getOne($sSql);

        if(!$sRes){
            throw new Exception( oxERPBase::$ERROR_OBJECT_NOT_EXISTING);
        }

        parent::checkWriteAccess($sOxid);
    }


    /**
     * issued before saving an object. Includes fix for multilanguage article long description saving
     * ( clone of same method in oxerptype_oxarticle.php )
     *
     * @param oxBase $oShopObject
     * @param array  $aData
     * @param bool   $blAllowCustomShopId
     *
     * @return array
     */
    protected function _preAssignObject($oShopObject, $aData, $blAllowCustomShopId)
    {
        $oCompat = oxNew('OXERPCompatability');
        if ( !$oCompat->isArticleNullLongDescComatable() ) {

            $aLongDescriptionFields = array('OXLONGDESC_1','OXLONGDESC_2','OXLONGDESC_3');

            foreach ($aLongDescriptionFields as $iKey => $sField){
                if( in_array($sField,$this->_aFieldList)){
                    unset($aLongDescriptionFields[$iKey]);
                }
            }

            if(count($aLongDescriptionFields)){
                $oArtExt = oxNew('oxbase');
                $oArtExt->init('oxartextends');

                if( $oArtExt->load($aData['OXID']) ) {
                    foreach ($aLongDescriptionFields as $sField) {
                        $sFieldName = $oArtExt->getCoreTableName()."__".strtolower( $sField );
                        $sLongDesc  = null;

                        if ($oArtExt->$sFieldName instanceof oxField) {
                            $sLongDesc = $oArtExt->$sFieldName->getRawValue();
                        } elseif (is_object($oArtExt->$sFieldName)) {
                            $sLongDesc = $oArtExt->$sFieldName->value;
                        }

                        if ( isset($sLongDesc) ) {
                            $aData[$sField] = $sLongDesc;
                        }
                    }
                }
            }
        }

        return parent::_preAssignObject($oShopObject, $aData, $blAllowCustomShopId);
    }

}