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
 * @copyright (C) OXID eSales AG 2003-2010
 * @version OXID eShop CE
 * $Id: deliveryset_list.php 16302 2009-02-05 10:18:49Z rimvydas.paskevicius $
 */

/**
 * Admin deliverysetset list manager.
 * Collects deliveryset base information (description), there is ability to
 * filter them by description, title or delete them.
 * Admin Menu: Shop Settings -> Shipping & Handling Sets.
 * @package admin
 */
class DeliverySet_List extends oxAdminList
{
    /**
     * Name of chosen object class (default null).
     *
     * @var string
     */
    protected $_sListClass = 'oxdeliveryset';

    /**
     * Type of list.
     *
     * @var string
     */
    protected $_sListType = 'oxdeliverysetlist';

    /**
     * Current class template name.
     * @var string
     */
    protected $_sThisTemplate = 'deliveryset_list.tpl';

    /**
     * Sets SQL query parameters (such as sorting),
     * executes parent method parent::Init().
     *
     * @return null
     */
    public function init()
    {
        $sViewName = getViewName('oxdeliveryset');
        $this->_sDefSort = "$sViewName.oxpos";
        parent::Init();
    }
}