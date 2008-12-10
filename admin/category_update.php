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
 * $Id: category_update.php 13619 2008-10-24 09:40:23Z sarunas $
 */

/**
 * Class for updating category tree structure in DB.
 * @package admin
 */
class Category_update extends oxAdminView
{
    /**
     * Loads category tree object, executes update and returns name of template
     * file "category_update.tpl".
     *
     * @return string
     */
    public function render()
    {
        parent::render();

        // parent categorie tree
        $oCatTree = oxNew( "oxCategoryList" );
        $oCatTree->updateCategoryTree();

        return "category_update.tpl";
    }
}
