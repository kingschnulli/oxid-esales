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
 * $Id: oxerpgenimport.php 16303 2009-02-05 10:23:41Z rimvydas.paskevicius $
 */

class oxStrMb
{
    /**
     * The character encoding.
     *
     * @var string
     */
    protected $_sEncoding = 'UTF-8';

    /**
     * PHP  multibute compliant strlen() function wrapper
     *
     * @param string $sStr
     *
     * @return int
     */
    public function strlen($sStr)
    {
        return mb_strlen($sStr, $this->_sEncoding);
    }

    /**
     * PHP multibute compliant substr() function wrapper
     *
     * @param string $sStr
     * @param int    $iStart
     * @param int    $iLength
     *
     * @return string
     */
    public function substr( $sStr, $iStart, $iLength = null )
    {
        $iLength = is_null( $iLength ) ? $this->strlen( $sStr ) : $iLength;
        return mb_substr( $sStr, $iStart, $iLength, $this->_sEncoding );
    }

    /**
     * PHP multibute compliant strpos() function wrapper
     *
     * @param string $sHaystack
     * @param string $sNeedle
     * @param int    $sOffset
     *
     * @return string
     */
    public function strpos( $sHaystack, $sNeedle, $iOffset = null )
    {
        $iOffset = is_null( $iOffset ) ? 0 : $iOffset;
        return mb_strpos( $sHaystack, $sNeedle, $iOffset, $this->_sEncoding );
    }

    /**
     * PHP multibute compliant strstr() function wrapper
     *
     * @param string $sHaystack
     * @param string $sNeedle
     *
     * @return string
     */
    public function strstr($sHaystack, $sNeedle)
    {
        return mb_strstr($sHaystack, $sNeedle, false, $this->_sEncoding);
    }

    /**
     * PHP multibute compliant strtolower() function wrapper
     *
     * @param string $sString string being lowercased
     *
     * @return string
     */
    public function strtolower($sString)
    {
        return mb_strtolower($sString, $this->_sEncoding);
    }
}