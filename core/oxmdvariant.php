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
 * $Id: oxmdvariant.php 20503 2009-10-15 14:54:11Z tomas $
 */

/**
 * Defines an element of multidimensional variant name tree structure. Contains article id, variant name, URL, price, price text, and a subset of MD variants.
 *
 * @package core
 */
class oxMdVariant
{
    /**
     * Corresponding article id
     *
     * @var string
     */
    protected $_sArticleId;

    /**
     * Variant name
     *
     * @var string
     */
    protected $_sName;

    /**
     * Variant identifier
     *
     * @var string
     */
    protected $_sMd5;

    /**
     * Variant URL
     *
     * @var string
     */
    protected $_sUrl;

    /**
     * Variant price
     *
     * @var double
     */
    protected $_dPrice;

    /**
     * Variant Price text represenatation. Eg. "10,00 EUR" or "from 8,00 EUR"
     *
     * @var string
     */
    protected $_sPriceText;

    /**
     * Subvariant array
     *
     * @var array[string]oxMdVariant
     */
    protected $_aSubvariants = array();

    /**
     * Initializes oxMdVariant values
     *
     * @param string $sArticleId Corresponding article Id
     * @param string $sName      Name
     * @param string $sUrl       Article Url
     * @param double $dPrice     Price
     * @param string $sPriceText Full price as a string
     *
     * @return null
     */
    /*
    public function init($sArticleId, $sName, $sUrl, $dPrice)
    {
        $this->_sArticleId = $sArticleId;
        $this->_sName = $sName;
        $this->_sUrl = $sUrl;
        $this->_dPrice = $dPrice;
        $this->_sPriceText = $sPriceText;
    }*/

    /**
     * Inits MD variant by name. In case $aNames parameter has more than one element addNames recursively adds names for subvariants.
     *
     * @param array[int] $aNames Expected array of $sKey=>$sName pairs.
     * @param double     $dPrice Price as double
     */
    public function addNames($sArtId, $aNames, $dPrice)
    {
        $sName = array_shift($aNames);

        if (count($aNames)) {
            //get required subvariant
            $oVariant = $this->_getMdSubvariantByName($sName);
            //add remaining names
            $oVariant->addNames($aNames);
        } else {
            //means we have the deepest element and assign other attributes
            $this->_sArticleId = $sArtId;
            $his->_dPrice = $dPrice;
        }
    }

    /**
     * Sets MD subvariants
     *
     * @param array[string]OxMdVariant $aSubvariants Subvariants
     *
     * @return null
     */
    public function setMdSubvariants($aSubvariants)
    {
        $this->_aSubvariants = $aSubvariants;
    }

    /**
     * Adds one subvariant to subvariant set
     *
     * @param string      $sKey        Article id
     * @param OxMdVariant $oSubvariant Subvariant
     *
     * @return null
     */
    public function addMdSubvariant($sKey, $oSubvariant)
    {
        $this->_aSubvariants[$sKey] = $oSubvariant;
    }

    /**
     * Returns corresponding article id or recusively first variant id from subvariant set
     *
     * @return string
     */
    public function getArticleId()
    {
        $oFirstSubvariant = $this->getFirstMdSubvariant();
        if ($oFirstSubvariant)
            return $oFirstSubvariant->getArticleId();

        return $this->_sArticleId;
    }

    /**
     * Name setter
     *
     * @param string $sName New name
     */
    public function setName($sName)
    {
        $this->_sName = $sName;
        $this->_sMd5 = md5($sName);
    }

    /**
     * Returns MD variant name
     *
     * @return string
     */
    public function getName()
    {
        return $this->_sName;
    }

    /**
     * Returns corresponding article Url
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->_sUrl;
    }

    /**
     * Returns price
     *
     * @return double
     */
    public function getDoublePrice()
    {
        return $this->_dPrice;
    }

    /**
     * Returns MD variant price as a text
     *
     * @return unknown
     */
    public function getPriceText()
    {
        return $this->_sPriceText;
    }

    /**
     * Returns particular MD subvariant by Id
     *
     * @param string $sId Subvariant Id
     *
     * @return OxMdVariant
     */
    public function getMdSubvariant($sId)
    {
        if (isset($this->_aSubvariants[$sId])) {
            return $this->_aSubvariants[$sId];
        }
    }

    /**
     * Returns first MD subvariant from subvariant set or null in case variant has no subvariants.
     *
     * @return OxMdVariant
     */
    public function getFirstMdSubvariant()
    {
        $aMdSubvariants = $this->getMdSubvariants();
        if (count($aMdSubvariants))
            return reset($aMdSubvariants);

        return null;
    }

    /**
     * Returns full array of subvariants
     *
     * @return array[string]OxMdSubvariants
     */
    public function getMdSubvariants()
    {
        return $this->_aSubvariants;
    }

    /**
     * Checks for existing MD subvariant by name. Returns existing one or in case $sName has not been found creates an empty OxMdVariant instance.
     *
     * @param string $sName Subvariant name
     *
     * @return OxMdVariant
     */
    protected function _getMdSubvariantByName($sName)
    {
        $aSubvariants = $this->getMdSubvariants();
        foreach ($aSubvariants as $oMdSubvariant) {
            if (strcasecmp($oMdSubvariant->getName(), $sName) == 0)
                return $oMdSubvariant;
        }

        $oNewSubvariant = oxNew("oxMdVariant");
        $oNewSubvariant->setName($sName);
    }

}