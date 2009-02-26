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
 * $Id: oxcountrylist.php 16365 2009-02-09 10:01:52Z vilma $
 */

/**
 * Article list manager.
 * Collects list of article according to collection rules (categories, etc.).
 * @package core
 */
class oxCountryList extends oxList
{
    /**
     * Call parent class constructor
     *
     * @param string $sObjectsInListName Associated list item object type
     *
     * @return null
     */
    public function __construct( $sObjectsInListName = 'oxcountry' )
    {
        parent::__construct( 'oxcountry' );
    }

    /**
     * Selects and loads all active countries
     *
     * @param integer $iLang language
     *
     * @return null;
     */
    public function loadActiveCountries( $iLang = null )
    {
        $sSufix = oxLang::getInstance()->getLanguageTag( $iLang );

        $sSelect = "SELECT oxid, oxtitle$sSufix as oxtitle FROM oxcountry WHERE oxactive = '1' ORDER BY oxorder, oxtitle$sSufix ";
        $this->selectString( $sSelect );
    }

}
