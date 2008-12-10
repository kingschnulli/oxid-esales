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
 * @copyright � OXID eSales AG 2003-2008
 * $Id: efire_list.php 12555 2008-09-29 13:07:20Z tomas $
 */

/**
 * Admin eFire list manager.
 * Arranges controll tabs and sets title.
 *
 * @package admin
 */
class EFire_List extends oxAdminView
{
    /**
     * Executes marent method parent::render() and returns mane of template
     * file "efire_list.tpl".
     *
     * @return string
     */
    public function render()
    {
        parent::render();
        $this->_aViewData['menu'] = basename( oxConfig::getParameter( "menu" ) );

        return "efire_list.tpl";
    }
}
