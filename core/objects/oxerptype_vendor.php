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
 * $Id: oxerptype_vendor.php 16000 2009-01-28 15:27:22Z rimvydas.paskevicius $
 */

require_once( 'oxerptype.php');

class oxERPType_Vendor extends oxERPType
{
    protected $_aFieldListVersions = array(
        '1' => array(
            'OXID'           => 'OXID',
            'OXSHOPID'       => 'OXSHOPID',
            'OXSHOPINCL'     => 'OXSHOPINCL',
            'OXSHOPEXCL'     => 'OXSHOPEXCL',
            'OXACTIV'        => 'OXACTIV',
            'OXICON'         => 'OXICON',
            'OXTITLE'        => 'OXTITLE',
            'OXSHORTDESC'    => 'OXSHORTDESC',
            'OXTITLE_1'     => 'OXTITLE_1',
            'OXSHORTDESC_1' => 'OXSHORTDESC_1',
            'OXTITLE_2'     => 'OXTITLE_2',
            'OXSHORTDESC_2' => 'OXSHORTDESC_2',
            'OXTITLE_3'     => 'OXTITLE_3',
            'OXSHORTDESC_3' => 'OXSHORTDESC_3',
            'OXSEOID'       => 'OXSEOID',
            'OXSEOID_1'     => 'OXSEOID_1',
            'OXSEOID_2'     => 'OXSEOID_2',
            'OXSEOID_3'     => 'OXSEOID_3'
        ),
        '2' => array(
            'OXID' => 'OXID',
            'OXSHOPID' => 'OXSHOPID',
            'OXSHOPINCL' => 'OXSHOPINCL',
            'OXSHOPEXCL' => 'OXSHOPEXCL',
            'OXACTIVE' => 'OXACTIVE',
            'OXICON' => 'OXICON',
            'OXTITLE' => 'OXTITLE',
            'OXSHORTDESC' => 'OXSHORTDESC',
            'OXTITLE_1' => 'OXTITLE_1',
            'OXSHORTDESC_1' => 'OXSHORTDESC_1',
            'OXTITLE_2' => 'OXTITLE_2',
            'OXSHORTDESC_2' => 'OXSHORTDESC_2',
            'OXTITLE_3' => 'OXTITLE_3',
            'OXSHORTDESC_3' => 'OXSHORTDESC_3',
            'OXSHOWSUFFIX' => 'OXSHOWSUFFIX',
        ),
    );


    public function __construct()
    {
        parent::__construct();

        $this->_sTableName = 'oxvendor';
        $this->_sShopObjectName = 'oxvendor';
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
                case 'OXSEOID':
                case 'OXSEOID_1':
                case 'OXSEOID_2':
                case 'OXSEOID_3':
                    return "'' as $sField";
                case 'OXACTIV':
                    return "OXACTIVE as OXACTIV";
            }
        }
        return parent::getSqlFieldName($sField, $iLanguage, $iShopID);
    }
}
