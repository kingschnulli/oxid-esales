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
 * @copyright (C) OXID eSales AG 2003-2010
 * @version OXID eShop CE
 * $Id: oxshoplist.php 16303 2009-02-05 10:23:41Z rimvydas.paskevicius $
 */

/**
 * Shop list manager.
 * Organizes list of shop objects.
 * @package core
 */
class oxShopList extends oxList
{
    /**
     * Class constructor, sets callback so that Shopowner is able to add any information to the article.
     *
     * @param string $sObjectsInListName Object name (oxShop)
     *
     * @return null
     */
    public function __construct( $sObjectsInListName = 'oxshop')
    {
        return parent::__construct( 'oxshop');
    }
}