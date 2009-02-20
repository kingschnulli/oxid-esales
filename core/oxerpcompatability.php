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
 * @copyright � OXID eSales AG 2003-2009
 * $Id: oxerpcompatability.php 16004 2009-01-28 15:33:50Z rimvydas.paskevicius $
 */

class OXERPCompatability
{
    /**
     * Returns build revision number or false on read error.
     *
     * @return int
     */
    public function getPkgRevision($sBasePath = null) {
        $sFile = (!$sBasePath?getShopBasePath():$sBasePath).'/pkg.rev';

        if(is_readable($sFile)) {
            return (int) trim(file_get_contents($sFile));
        }
        // TODO: return newest (HEAD)
        return 999999999; //13895;
    }

    /**
     * Returns build revision number or false on read error.
     *
     * @return int
     */
    public function getShopRevision()
    {
        $oConfig   = oxConfig::getInstance();

        if (method_exists($oConfig,'getRevision')) {
            $sRevision = $oConfig->getRevision();
            if ($sRevision !== false) {
                return $sRevision;
            }
        }

        return $this->getPkgRevision();
    }

    /**
     * Returns true or false depending on shop's user password salt support
     *
     * @param $iRev
     *
     * @return bool
     */
    public function isPasswordSaltSupported($iRev = null)
    {
        if (!$iRev) {
            $iRev = $this->getShopRevision();
        }
        return $iRev >= 14455;
    }

    /**
     * Returns true or false depending on shop's user password salt
     * is kept in oxuser table
     *
     * @param $iRev
     *
     * @return bool
     */
    public function isPasswordSaltInOxUser($iRev = null)
    {
        if (!$iRev) {
            $iRev = $this->getShopRevision();
        }
        return $iRev >= 14842;
    }

    /**
     * checks orderarticle oxstock field type
     *
     * @param $iRev
     *
     * @return bool
     */
    public function isOrderArticleStockAsDouble($iRev = null)
    {
        if (!$iRev) {
            $iRev = $this->getShopRevision();
        }
        return $iRev >= 14260;
    }

    /**
     * checks if articles multilanguage longdescriptions are handled corecly
     *
     * @param $iRev
     *
     * @return bool
     */
    public function isArticleNullLongDescComatable($iRev = null)
    {
        if (!$iRev) {
            $iRev = $this->getShopRevision();
        }
        return $iRev >= 14036;
    }

    /**
     * checks if min variant price is allways updated ( see bug #378 )
     *
     * @param $iRev
     *
     * @return bool
     */
    public function isArticleVariantMinPriceAllwaysUpdated($iRev = null)
    {
        if (!$iRev) {
            $iRev = $this->getShopRevision();
        }
        return $iRev < 14260;
    }

}