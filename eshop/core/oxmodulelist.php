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
 * @version   SVN: $Id: oxmodulelist.php 43312 2012-03-29 13:22:30Z alfonsas $
 */

/**
 * Class handling shop modules.
 *
 */
class oxModulelist extends oxSuperCfg
{
    /**
     * Get parsed modules
     *
     * @return array
     */
    public function getAllModules()
    {
        return $this->getConfig()->getAllModules();
    }

    /**
     * Get parsed active modules info
     *
     * @return array
     */
    public function getActiveModuleInfo()
    {
        $aModules       = $this->getAllModules();
        $aModulePaths   = $this->getModulePaths();

        if ( !is_array($aModulePaths) || count($aModulePaths) < 1 ) {
            if ( is_array($aModules) && count($aModules) > 0 ) {
                foreach ($aModules as $aModuleClasses) {
                    foreach ($aModuleClasses as $sModule) {
                        $sModuleId = substr( $sModule, 0, strpos( $sModule, "/" ) );
                        $aModulePaths[$sModuleId] = $sModuleId;
                    }
                }
            }
        }

        $aDisabledModules = $this->getDisabledModules();
        if ( is_array($aDisabledModules) && count($aDisabledModules) > 0 ) {
            $aModulePaths = array_diff_key($aModulePaths, array_flip($aDisabledModules));
        }
        return $aModulePaths;
    }

    /**
     * Get legacy modules list
     *
     * @return array
     */
    public function getLegacyModules()
    {
        return $this->getConfig()->getConfigParam('aLegacyModules');
    }

    /**
     * Get disabled module id's
     *
     * @return array
     */
    public function getDisabledModules()
    {
        return $this->getConfig()->getConfigParam('aDisabledModules');
    }

    /**
     * Get module id's with path
     *
     * @return array
     */
    public function getModulePaths()
    {
        return $this->getConfig()->getConfigParam('aModulePaths');
    }

    /**
     * Returns disabled module classes with path using config aModules
     * and aModulePaths.
     * aModules has all extended classes
     * aModulePaths has module id to main path array
     *
     * @return array
     */
    public function getDisabledModuleClasses()
    {
        $aDisabledModules = $this->getDisabledModules();
        $aModules         = $this->getAllModules();
        $aModulePaths     = $this->getModulePaths();

        $aDisabledModuleClasses = array();
        if (isset($aDisabledModules) && is_array($aDisabledModules)) {
            //get all disabled module paths
            foreach ($aDisabledModules as $sId) {
                $sPath = $aModulePaths[$sId];
                if (!isset($sPath)) {
                    $sPath = $sId;
                }
                foreach ( $aModules as $sClass => $aModuleClasses ) {
                    foreach ( $aModuleClasses as $sModuleClass ) {
                        if (strpos($sModuleClass, $sPath."/") === 0 ) {
                            $aDisabledModuleClasses[] = $sModuleClass;
                        }
                    }
                }
            }

        }

        return $aDisabledModuleClasses;
    }

    /**
     * Removes extension metadata from eshop
     *
     * @return null
     */
    public function cleanup()
    {
        $aDeletedExt = $this->getDeletedExtensions();

        //collectind deleted extensions ID's
        $aDeletedExtIds = array();
        if ( !empty($aDeletedExt) ) {
            foreach ( $aDeletedExt as $sOxClass => $aDeletedModules ) {
                foreach ( $aDeletedModules as $sModulePath ) {
                     $aDeletedExtIds[] = substr( $sModulePath, 0, strpos( $sModulePath, "/" ) );
                }
            }
        }

        if ( !empty( $aDeletedExtIds ) ) {
            $aDeletedExtIds = array_unique( $aDeletedExt );
        }

        // removing from aModules config varviable
        $this->_removeFromModulesArray( $aDeletedExt );

        // removing from aDisabledModules config varviable
        $this->_removeFromDisabledModulesArray( $aDeletedExtIds );

        // removing from aLegacyModules array
        $this->_removeFromLegacyModulesArray( $aDeletedExtIds );

        //removing from config tables and templates blocks table
        $this->_removeFromDatabase( $aDeletedExtIds );
    }

    /**
     * Checks moduels list - if there is extensions that are registered, but
     * extension directory is missing
     *
     * @return null
     */
    public function getDeletedExtensions()
    {
        $aModules = $this->getAllModules();

        foreach ( $aModules as $sOxClass => $aModulesList ) {
            foreach ( $aModulesList as $sModulePath ) {
                if (  strpos( $sModulePath, "/" ) ) {
                    $sExtDir = substr( $sModulePath, 0, strpos( $sModulePath, "/" ) );
                    $sExtPath = $this->getConfig()->getModulesDir() . $sExtDir;

                    if ( !is_dir( $sExtPath ) ) {
                        $aDeletedExt[$sOxClass][] = $sModulePath;
                    }
                }
            }
        }

        return $aDeletedExt;
    }

    /**
     * Diff two nested module arrays together so that the values of
     * $aRmModuleArray are removed from $aAllModuleArray
     *
     * @param array $aAllModuleArray All Module array (nested format)
     * @param array $aRemModuleArray Remove Module array (nested format)
     *
     * @return array
     */
    public function diffModuleArrays($aAllModuleArray, $aRemModuleArray)
    {
       if (is_array($aAllModuleArray) && is_array($aRemModuleArray)) {
            foreach ($aAllModuleArray as $sClass => $aModuleChain) {
                if (!is_array($aModuleChain)) {
                    $aModuleChain = array($aModuleChain);
                }
                if (isset($aRemModuleArray[$sClass])) {
                    if (!is_array($aRemModuleArray[$sClass])) {
                        $aRemModuleArray[$sClass] = array($aRemModuleArray[$sClass]);
                    }
                    $aAllModuleArray[$sClass] = array();
                    foreach ($aModuleChain as $sModule) {
                        if (!in_array($sModule, $aRemModuleArray[$sClass])) {
                            $aAllModuleArray[$sClass][] = $sModule;
                        }
                    }
                    if (!count($aAllModuleArray[$sClass])) {
                        unset ($aAllModuleArray[$sClass]);
                    }
                } else {
                    $aAllModuleArray[$sClass] = $aModuleChain;
                }
            }

       }

        return $aAllModuleArray;
    }

    /**
     * Build module chains from nested array
     *
     * @param array $aModuleArray Module array (nested format)
     *
     * @return array
     */
    public function buildModuleChains($aModuleArray)
    {
        $aModules = array();
        if (is_array($aModuleArray)) {
            foreach ($aModuleArray as $sClass => $aModuleChain) {
                $aModules[$sClass] = implode('&', $aModuleChain);
            }
        }
        return $aModules;
    }

    /**
     * Removes extension from modules array
     *
     * @param array $aDeletedExt Deleated extendion array
     *
     * @return null
     */
    protected function _removeFromModulesArray( $aDeletedExt )
    {
        $aExt = $this->getAllModules();

        $aUpdatedExt = $this->diffModuleArrays( $aExt, $aDeletedExt );
        $aUpdatedExt = $this->buildModuleChains( $aUpdatedExt );

        $this->getConfig()->saveShopConfVar( 'aarr', 'aModules', $aUpdatedExt );
    }

    /**
     * Removes extension from disabled modules array
     *
     * @param array $aDeletedExtIds Id's of deleated extendion array
     *
     * @return null
     */
    protected function _removeFromDisabledModulesArray( $aDeletedExtIds )
    {
        $oConfig = $this->getConfig();
        $aDisabledExtensionIds = $this->getDisabledModules();
        $aDisabledExtensionIds = array_diff($aDisabledExtensionIds, $aDeletedExtIds);
        $oConfig->saveShopConfVar( 'arr', 'aDisabledModules', $aDisabledExtensionIds );
    }

    /**
     * Removes extension from legacy modules array
     *
     * @param array $aDeletedExtIds deleted extensions ID's
     *
     * @return null
     */
    protected function _removeFromLegacyModulesArray( $aDeletedExtIds )
    {
        $aLegacyExt = $this->getLegacyModules();

        foreach ( $aDeletedExtIds as $sDeletedExtId ) {
            if ( isset($aLegacyExt[$sDeletedExtId]) ) {
                unset( $aLegacyExt[$sDeletedExtId] );
            }
        }

        $this->getConfig()->saveShopConfVar( 'aarr', 'aLegacyModules', $aLegacyExt );
    }

    /**
     * Removes extension from database - oxconfig, oxconfigdisplay and oxtplblocks tables
     *
     * @param array $aDeletedExtIds deleted extensions ID's
     *
     * @return null
     */
    protected function _removeFromDatabase( $aDeletedExtIds )
    {
        $sDelExtIds = array();

        foreach ( $aDeletedExtIds as $sDeletedExtId ) {
            $aConfigIds[] = "'module:" . $sDeletedExtId . "'";
            $sDelExtIds[] = "'" . $sDeletedExtId . "'";
        }

        $sConfigIds = implode( ", ", $aConfigIds );
        $sDelExtIds = implode( ", ", $sDelExtIds );

        $aSql[] = "DELETE FROM oxconfig where oxmodule IN ($sConfigIds)";
        $aSql[] = "DELETE FROM oxconfigdisplay where oxcfgmodule IN ($sConfigIds)";
        $aSql[] = "DELETE FROM oxtplblocks where oxmodule IN ($sDelExtIds)";

        $oDb = oxDb::getDb();
        foreach ( $aSql as $sQuery ) {
            $oDb->execute( $sQuery );
        }
    }
}