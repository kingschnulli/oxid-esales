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
 * @package views
 * @copyright � OXID eSales AG 2003-2009
 * $Id: tpl.php 13614 2008-10-24 09:36:52Z sarunas $
 */

/**
 * Template preparation class.
 * Used only in some specific cases (usually when you need to outpt just template
 * having text information).
 */
class Tpl extends oxUBase
{
    /**
     * Executes parent method parent::render(), returns name of template file.
     * 
     * @return  string  $sTplName   template file name
     */
    public function render()
    {
        parent::render();

        // security fix so that you cant access files from outside template dir
        $sTplName = basename(oxConfig::getParameter("tpl"));

        return $sTplName;
    }
}
