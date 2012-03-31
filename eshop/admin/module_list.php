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
 * @package   admin
 * @copyright (C) OXID eSales AG 2003-2012
 * @version OXID eShop CE
 * @version   SVN: $Id: actions_list.php 28470 2010-06-19 12:49:59Z arvydas $
 */

/**
 * Admin actionss manager.
 * Sets list template, list object class ('oxactions') and default sorting
 * field ('oxactions.oxtitle').
 * Admin Menu: Manage Products -> Actions.
 * @package admin
 */
class Module_List extends oxAdminList
{

    /**
     * @var array Loaded modules array
     *
     */
    protected $_aModules = array();

    protected $_aSkipFiles = array( "functions.php", "vendormetadata.php" );


    /**
     * Calls parent::render() and returns name of template to render
     *
     * @return string
     */
    public function render()
    {
        $sModulesDir = $this->getConfig()->getModulesDir();

        $this->_loadModules( $sModulesDir );

        parent::render();

        // assign our list
        $this->_aViewData['mylist'] = $this->_aModules;

        return 'module_list.tpl';
    }

    /**
     * Loads modules from given path
     *
     * @param string $sModulesDir dir path
     * @param string $sVendorDir  vendor directory name
     *
     * @return null
     */
    protected function _loadModules( $sModulesDir, $sVendorDir = null )
    {
        $sModulesDir  = oxUtilsFile::getInstance()->normalizeDir( $sModulesDir );
        $oConfig      = $this->getConfig();

        foreach ( glob( $sModulesDir."*" ) as $sModuleDirPath ) {

            $sModuleDirPath .= ( is_dir( $sModuleDirPath ) ) ? "/" : "";
            $sModuleDirName  = basename( $sModuleDirPath );

            // skipping some file
            if ( in_array( $sModuleDirName, $this->_aSkipFiles ) ) {
                continue;
            }

            if ( $this->_isVendorDir( $sModuleDirPath ) ) {
                // scaning modules vendor directory
                $this->_loadModules( $sModuleDirPath, basename( $sModuleDirPath ) );
            } else {
                // loading module info
                $oModule = oxNew( "oxModule" );
                $sModuleDirName = ( !empty($sVendorDir) ) ? $sVendorDir."/".$sModuleDirName : $sModuleDirName;
                $oModule->loadByDir( $sModuleDirName );
                $this->_aModules[$oModule->getId()] = $oModule;

                //Updating aModulePaths config variable if needed
                $aModulePaths = $oConfig->getConfigParam('aModulePaths');

                if ( !is_array($aModulePaths) || !array_key_exists( $oModule->getId(), $aModulePaths ) ) {
                    $aModulePaths[$oModule->getId()] = $sModuleDirName;
                    $oConfig->saveShopConfVar( 'aarr', 'aModulePaths', $aModulePaths );

                    //checking if this is new module and if it extends any eshop class
                    if ( !$this->_extendsClasses( $sModuleDirName ) ) {
                        // if not - marking it as disabled by default
                        $aDisabledModules = $oConfig->getConfigParam( 'aDisabledModules' );
                        if ( !$aDisabledModules[$oModule->getId()] ) {
                            $aDisabledModules[] = $oModule->getId();
                            $oConfig->saveShopConfVar('arr', 'aDisabledModules', $aDisabledModules);
                        }
                    }
                }
            }
        }
    }

    /**
     * Checks if directory is vedor directory.
     *
     * @param string $sModuleDir dir path
     *
     * @return bool
     */
    protected function _isVendorDir( $sModuleDir )
    {
        if ( is_dir( $sModuleDir ) && file_exists( $sModuleDir . "vendormetadata.php" ) ) {
            return true;
        }

        return false;
    }

    /**
     * Checks if directory is vedor directory.
     *
     * @param string $sModuleDir dir path
     *
     * @return bool
     */
    protected function _extendsClasses ( $sModuleDir )
    {
        $aModules = $this->getConfig()->getConfigParam( "aModules" );
        if (is_array($aModules)) {
            $sModules = implode( "&", $aModules );

            if ( preg_match("@(^|&+)".$sModuleDir."\b@", $sModules ) ) {
                return true;
            }
        }

        return false;
    }


}
