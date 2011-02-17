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
 * @copyright (C) OXID eSales AG 2003-2011
 * @version OXID eShop CE
 * @version   SVN: $Id: $
 */

/**
 * Class handling shop themes
 *
 */
class oxTheme extends oxSuperCfg
{
    /**
     * Theme info array
     * @var array
     */
    protected $_aTheme = array();

    /**
     * Theme info list
     * @var array
     */
    protected $_aThemeList = array();

    /**
     * Load theme info
     *
     * @param string $sOXID theme id
     *
     * @return array
     */
    public function load($sOXID)
    {
        $sFilePath = $this->getConfig()->getOutDir().$sOXID."/theme.php";
        if ( file_exists( $sFilePath ) && is_readable( $sFilePath ) ) {
            $aTheme = array();
            include $sFilePath;
            $this->_aTheme = $aTheme;
        }

        return $this->_aTheme;
    }

    /**
     * Set theme
     *
     * @param string $sOXID theme id
     *
     * @return null
     */
    public function setTheme($sOXID)
    {
        $this->getConfig()->saveShopConfVar("str", 'sTheme', $sOXID);
    }

    /**
     * Get theme
     *
     * @return string
     */
    public function getTheme()
    {
        return $this->getConfig()->getConfigParam( 'sTheme' );
    }

    /**
     * Load theme info list
     *
     * @return array
     */
    public function getList()
    {
        $sTheme = $this->getConfig()->getConfigParam('sTheme');

        $this->_aThemeList   = array();
        $sOutDir = $this->getConfig()->getOutDir();
        foreach ( glob( $sOutDir."*", GLOB_ONLYDIR ) as $sDir ) {
            $sFilePath = "{$sDir}/theme.php";
            if ( file_exists( $sFilePath ) && is_readable( $sFilePath ) ) {
                $aTheme = array();
                include $sFilePath;
                $aTheme['active'] = ($sTheme == $aTheme['id']);
                $this->_aThemeList[$sDir] = $aTheme;
            }
        }
        return $this->_aThemeList;
    }
}

