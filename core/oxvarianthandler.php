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
 * $Id: oxvarianthandler.php 22524 2009-10-15 11:47:27Z tomas $
 */

/**
 * oxVariantHandler encapsulates methods dealing with multidimensional variant and variant names.
 *
 * @package core
 */
class oxVariantHandler
{
    /**
     * Variant names
     *
     * @var array
     */
    protected $_oArticles = null;

    /**
     * Multidimensional variant separator
     *
     * @var string
     */
    protected $_sMdSeparator = "|";

    /**
     * Multidimensional variant tree structure
     *
     * @var OxMdVariant
     */
    protected $_oMdVariants = null;

    /**
     * Sets internal variant name array from article list.
     *
     * @param oxList[string]oxArticle $oArticles Variant list as
     *
     * @return null
     */
    public function init($oArticles)
    {
        $this->_oArticles = $oArticles;
    }

    /**
     * Returns multidimensional variant structure
     *
     * @return OxMdVariants
     */
    public function getMdVariants()
    {
        if ($this->_oMdVariants)
            return $this->_oMdVariants;

        $oMdVariants = oxNew("OxMdVariants");
        $oMdVariants->setName("_parent_product_");
        foreach($this->_aVariants as $sKey => $oVariant) {
            $oMdVariants->addNames($sKey,
                                   explode($this->_sMdSeparator, $oVariant->oxarticles__oxvarselect->value),
                                   $oVariant->getPrice()->getBruttoPrice());
        }

        $this->_oMdVariants = $oMdVariants;
        return $this->_oMdVariants;
    }

    /**
     * Generate variants from selection lists
     *
     * @param string $sVarId      article id
     * @param string $sSellTitle  selection list title
     * @param string $sSellValue  selection list values
     *
     * @return null
     */
    public function assignVarToAttribute( $sVarId, $sSellTitle, $sSellValue )
    {
    	$sAttrId = $this->_getAttrId( $sSellTitle );
    	if ( !$sAttrId ) {
    		$sAttrId = $this->_createAttribute( $sSellTitle );
    	}
    	$oNewAssign = oxNew( "oxbase" );
        $oNewAssign->init( "oxobject2attribute" );
        $oNewAssign->oxobject2attribute__oxobjectid = new oxField($sVarId);
        $oNewAssign->oxobject2attribute__oxattrid   = new oxField($sAttrId);
        $oNewAssign->oxobject2attribute__oxvalue    = new oxField($sSellValue);
        $oNewAssign->save();
    }

    /**
     * Searches for attribute by oxtitle. If exists returns attribute id
     *
     * @param string $sSelTitle selection list title
     *
     * @return mixed attribute id or false
     */
    protected function _getAttrId( $sSelTitle )
    {
        $oDb = oxDb::getDB();
        $sAttViewName = getViewName('oxattribute');
        return $oDb->getOne("select oxid from $sAttViewName where LOWER(oxtitle) = " . $oDb->quote(getStr()->strtolower($sSelTitle)));
    }

    /**
     * Checks if attribute exists
     *
     * @param string $sSelTitle selection list title
     *
     * @return string attribute id
     */
    protected function _createAttribute( $sSelTitle )
    {
        $oAttr = oxNew( "oxattribute" );
        $oAttr->oxattribute__oxtitle = new oxField($sSelTitle);
        $oAttr->save();
        return $oAttr->getId();
    }

    /**
     * Check if variant is multidimensional
     *
     * @param oxArticle $oArticle Article object
     *
     * @return bool
     */
    public function isMdVariant( $oArticle )
    {
        if ( strpos( $oArticle->oxarticles__oxvarselect->value, $this->_sSeparator ) !== false ) {
            return true;
        }

        return false;
    }

    /**
     * Get multidimensional variant attribute value by it index number.
     * 0 - top, 1 - next and so on
     *
     * @param int    $iId        Index number
     * @param string $sVarValues Variant values separated by separator
     *
     * @return string
     */
    protected function _getMdVariantValue( $iId = 0, $sVarValue )
    {
        $aVarValues = explode( $this->_sSeparator, $sVarValue );

        return trim($aVarValues[$iId]);
    }


    /**
     * Get top variant attribute value.
     *
     * @param string $sVarValue Variant values
     *
     * @return string
     */
    protected function _getMdVariantTopValue( $sVarValue )
    {
        return $this->_getMdVariantValue( 0, $sVarValue );
    }

    /**
     * Parses all articles list and updates field "oxarticles__oxvarselect" to have
     * only one top attribute value. Also checks min price for this top attribute
     * and sets it to article object.
     *
     * @param object $oArticle Variants list
     *
     * @return bool
     */
    public function getTopMdVariants( $oArticles )
    {
        // Check if article list has multidimensional variants.
        // If first element is not MD variant, return null
        if ( $oArticles && !$this->isMdVariant( $oArticles->current() ) ) {
            return null;
        }

        $aMinPrices = array();

        if ( $oArticles && count( $oArticles ) > 0 ) {

            foreach ( $oArticles as $oArticle ) {

                $dPrice = 0;
                $sTopVarValue = $this->_getMdVariantTopValue( $oArticle->oxarticles__oxvarselect->value );

                //getting min price by attribute value
                if (  $dPrice < $oArticle->getPrice()->getNettoPrice() ) {
                    $dPrice = $oArticle->getPrice()->getNettoPrice();
                    $aMinPrices[$sTopVarValue] = $oArticle->getId();
                }

                $oArticle->oxarticles__oxvarselect->value = $sTopVarValue;
            }

            // formating new top variants list, where are only distinct var values
            // with min price
            $aNewArticles = array();
            foreach ( $aMinPrices as $sKey => $sArtId ) {
                $aNewArticles[$sArtId] = $oArticles[$sArtId];
            }
/*
            if ( $blUseSimpleVariants ) {
                $oTopArticles = oxNew( "oxsimplevariantlist" );
            } else {
                $oTopArticles = oxNew( "oxArticleList" );
            }


*/
            $oArticles->clear();
            $oArticles->assign( $aNewArticles );
        }

        return $oArticles;
    }

}
