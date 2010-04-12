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
 * @link      http://www.oxid-esales.com
 * @package   admin
 * @copyright (C) OXID eSales AG 2003-2010
 * @version OXID eShop CE
 * @version   SVN: $Id: attribute_list.php 25466 2010-02-01 14:12:07Z alfonsas $
 */

/**
 * Admin attributes manager.
 * Collects attributes base information (Description), there is ability to filter
 * them by Description or delete them.
 * Admin Menu: Manage Products -> Attributes.
 * @package admin
 */
class Attribute_List extends oxAdminList
{
    /**
     * Current class template name.
     * @var string
     */
    protected $_sThisTemplate = 'attribute_list.tpl';

    /**
     * Name of chosen object class (default null).
     *
     * @var string
     */
    protected $_sListClass = 'oxattribute';

    /**
     * Sets SQL query parameters (sorting, etc),
     * executes parent method parent::Init().
     *
     * @return null
     */
    public function init()
    {
        $this->_sDefSort = getViewName( 'oxattribute' ).".oxtitle";
        parent::Init();
    }
}