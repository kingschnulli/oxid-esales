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
 * @package   core
 * @copyright (C) OXID eSales AG 2003-2010
 * @version OXID eShop CE
 * @version   SVN: $Id: oxshop.php 25467 2010-02-01 14:14:26Z alfonsas $
 */

/**
 * Including DTAUS builder class
 */
require_once getShopBasePath() . "core/phpdtaus/classes/dtausbuilder.class.php";

/**
 * DTAUS builder wrapper
 *
 * @package core
 */
class oxDtausBuilder extends dtausbuilder
{
    /**
     * Calls parent constructor and overrides
     *
     * @param string $sCompany   company
     * @param int    $sRoutingNr routing number
     * @param int    $sAccountNr account number
     *
     * @return null
     */
    public function __construct( $sCompany, $sRoutingNr, $sAccountNr )
    {
            parent::__construct( $sCompany, $sRoutingNr, $sAccountNr );

            $this->intBank    = $sRoutingNr;
            $this->intAccount = $sAccountNr;
    }
}
