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
 * @copyright (C) OXID eSales AG 2003-2012
 * @version OXID eShop CE
 * @version   SVN: $Id: oxheader.php 46622 2012-06-25 10:55:42Z saulius.stasiukaitis $
 */

/**
 * HTTP headers formator.
 * Collects HTTP headers and form HTTP header.
 * @package core
 */
class oxHeader
{
    protected $_sHeader;

    /**
     * Sets header.
     *
     * @param string $sHeader header value.
     *
     * @return void
     */
    public function setHeader( $sHeader )
    {
        $this->_sHeader = (string) $sHeader."\r\n";
    }

    /**
     * Return header.
     *
     * @return string
     */
    public function getHeader()
    {
        return $this->_sHeader;
    }

    /**
     * Outputs HTTP header.
     *
     * @return void
     */
    public function sendHeader()
    {
        $sHeader = $this->_sHeader;
        if ( isset( $sHeader ) ) {
            header( $sHeader );
        }
    }
}
