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
 * $Id: oxvarianthandler.php 22524 2009-09-22 11:47:27Z tomas $
 */

/**
 * oxVariantHandler encapsulates methods dealing with multidimensional variant names.
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
    protected $_aVariants = array();

    /**
     * Multidimensional variant separator
     *
     * @var string
     */
    protected $_sSeparator = "|";

    /**
     * Sets internal variant name array from article list.
     *
     * @param oxArticleList $oArticles Article list
     * 
     * @return null
     */
    public function init(oxArticleList $oArticles)
    {
        $this->_aVariants = array();
        foreach ($oArticles as $sId => $oArticle) {
            $this->_aVariants[$sId] = $oArticle->oxarticles__oxvarselect->value;
        }
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
        if ( $oArticle->isVariant() ) {
           if ( strpos( $oArticle->oxarticles__oxtitle->value, $this->_sSeparator ) !== false )
               return true;
        }

        return false;
    }

    /**
     * Get top variant attribute value. Extracts first variant value from values
     * strings separated by separator.
     *
     * @param string $sVarValue Variant values
     *
     * @return double
     */
    protected function _getMdVariantTopValue( $sVarValue )
    {
        $sTopVarValue = trim( preg_replace("/([^|]+)|.+$/", "$1", $sVarValue ) );

        return $sTopVarValue;
    }

    /**
     * Get min price of selected top level variants by given var value
     * e.g. get lowest price of top variants with attribute "green".
     *
     * @param string        $sVarValue Variant value
     * @param oxArticleList $oArticles Articles list
     *
     * @return double
     */
    protected function _getMdVariantsMinPrice( $sVarValue, $oArticles )
    {
        $dPrice = 0;
        foreach ( $oArticles as $oArticle ) {

            $sTopVarValue = $this->_getMdVariantTopValue( $oArticle->oxarticles__oxvarselect->value );
            if ( $sVarValue == $sTopVarValue ) {
                if (  $dPrice < $oArticle->oxarticles__oxvarselect->value ) {
                    $dPrice = $oArticle->oxarticles__oxvarselect->value;
                }
            }
        }

        return $dPrice;
    }

    /**
     * Parses all articles list and updates field "oxarticles__oxvarselect" to have
     * only one top attribute value. Also checks min price for this top attribute
     * and sets it to article object.
     *
     * @param oxArticle $oArticle Article object
     *
     * @return bool
     */
    public function getTopMdVariants( $oArticles )
    {
        $aMinPrices = array();

        if ( $oArticles && count( $oArticles ) > 0 ) {

            foreach ( $oArticles as $oArticle ) {

                // reik idet loop reset



                $sTopVarValue = $this->_getMdVariantTopValue( $oArticle->oxarticles__oxvarselect->value );

                if ( !in_array( $sTopVarValue, $aMinPrices ) ) {
                    //getting min price by attribute value
                    $dPrice = $this->_getMdVariantsMinPrice( $sTopVarValue, $oArticles );

                    //adding to already searched array to skip checking when
                    //article with same value will apier again
                    $aMinPrices[] = $sTopVarValue;

                    $oArticle->oxarticles__oxvarselect->value = $sTopVarValue;
                }

            }
        }

        return $oArticles;
    }    
}
