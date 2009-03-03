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

/**
 * Class dealing with regular string handling
 *
 */
class oxStrRegular
{
    /**
     * PHP strlen() function wrapper
     *
     * @param string $sStr
     *
     * @return int
     */
    public function strlen($sStr)
    {
        return strlen($sStr);
    }

    /**
     * PHP substr() function wrapper
     *
     * @param string $sStr
     * @param int    $iStart
     * @param int    $iLength
     *
     * @return string
     */
    public function substr($sStr, $iStart, $iLength = null)
    {
        if (is_null($iLength)) {
            return substr($sStr, $iStart);
        } else {
            return substr($sStr, $iStart, $iLength);
        }
    }

    /**
     * PHP strpos() function wrapper
     *
     * @param string $sHaystack
     * @param string $sNeedle
     * @param int    $sOffset
     *
     * @return string
     */
    public function strpos($sHaystack, $sNeedle, $iOffset = null)
    {
        if (is_null($iOffset)) {
            return strpos($sHaystack, $sNeedle);
        } else {
            return strpos($sHaystack, $sNeedle, $iOffset);
        }
    }

    /**
     * PHP strstr() function wrapper
     *
     * @param string $sHaystack
     * @param string $sNeedle
     *
     * @return string
     */
    public function strstr($sHaystack, $sNeedle)
    {
        return strstr($sHaystack, $sNeedle);
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
        return strtolower($sString);
    }
}