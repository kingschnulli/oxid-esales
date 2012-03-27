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
 * @version   SVN: $Id: $
 */

/**
 * Class handling shop modules
 *
 */
class oxModule extends oxSuperCfg
{
    /**
     * Theme info array
     *
     * @var array
     */
    protected $_aModule = array();

    /**
     * Defines if module has metadata file or not
     *
     * @var bool
     */
    protected $_blMetadata   = false;

    /**
     * Defines if module is registered in metadata or legacy storage
     *
     * @var bool
     */
    protected $_blRegistered = false;

    /**
     * Defines if it is a single file legacy extension
     *
     * @var bool
     */
    protected $_blFile       = false;

    /**
     * Defines if it is a legacy extension
     *
     * @var bool
     */
    protected $_blLegacy     = false;

    /**
     * Load module info
     *
     * @param string $sModuleId Module ID
     *
     * @return bool
     */
    public function load( $sModuleId )
    {
        if ($this->loadModule($sModuleId)) return true;

        if ($this->loadLegacyModule($sModuleId)) return true;

        if ($this->loadUnregisteredModule($sModuleId)) return true;

        return false;
    }

    /**
     * Load Extension from metadata
     *
     * @param string $sModuleId Module ID
     *
     * @return bool
     */
    public function loadModule($sModuleId)
    {
        $sFilePath = $this->getConfig()->getModulesDir() . $sModuleId . "/metadata.php";
        if ( file_exists( $sFilePath ) && is_readable( $sFilePath ) ) {
            $aModule = array();
            include $sFilePath;
            $this->_aModule = $aModule;
            $this->_aModule['id'] = $sModuleId;
            $this->_blLegacy      = false;
            $this->_blRegistered  = true;
            $this->_blMetadata    = true;
            $this->_blFile        = false;
            $this->_aModule['active'] = $this->isActive() || !$this->isExtended();
            return true;
        }
        return false;
    }

    /**
     * Load Extension from legacy metadata
     *
     * @param string $sModuleId Module ID
     *
     * @return bool
     */
    public function loadLegacyModule($sModuleId)
    {
        $aLegacyModules = $this->getLegacyModules();

        // registered legacy module
        if ( isset( $aLegacyModules[$sModuleId] ) ) {
            $this->_aModule = $aLegacyModules[$sModuleId];
            $this->_aModule['id'] = $sModuleId;
            $this->_blLegacy      = true;
            $this->_blRegistered  = true;
            $this->_blMetadata    = false;
            $this->_blFile        = !is_dir($this->getConfig()->getModulesDir() . $sModuleId);
            $this->_aModule['active'] = $this->isActive();
            return true;
        }
        return false;
    }

    /**
     * Load extension without any metadata
     *
     * @param string $sModuleId Module ID
     *
     * @return bool
     */
    public function loadUnregisteredModule($sModuleId)
    {
        $aModules = $this->getAllModules();

        $sFilePath = $this->getConfig()->getModulesDir() . $sModuleId ;
        if ( file_exists( $sFilePath ) && is_readable( $sFilePath ) ) {
            $this->_aModule = array();
            $this->_aModule['id'] = $sModuleId;
            $this->_aModule['title'] = $sModuleId;
            $this->_aModule['extend'] = $this->buildModuleChains($this->filterModuleArray($aModules, $sModuleId));
            $this->_blLegacy      = true;
            $this->_blRegistered  = false;
            $this->_blMetadata    = false;
            $this->_blFile        = !is_dir($this->getConfig()->getModulesDir() . $sModuleId);
            $this->_aModule['active'] = $this->isActive();
            return true;
        }
        return false;
    }

    /**
     * Get module description
     *
     * @return string
     */
    public function getDescription()
    {
        $iLang = oxLang::getInstance()->getTplLanguage();

        return $this->getInfo( "description", $iLang );
    }

    /**
     * Get module title
     *
     * @return string
     */
    public function getTitle()
    {
        $iLang = oxLang::getInstance()->getTplLanguage();

        return $this->getInfo( "title", $iLang );
    }

    /**
     * Get module ID
     *
     * @return string
     */
    public function getId()
    {
        return $this->_aModule['id'];
    }

    /**
     * Get module info item. If second param is passed, will try
     * to get value according selected language.
     *
     * @param string $sName name of info item to retrieve
     * @param string $iLang language ID
     *
     * @return mixed
     */
    public function getInfo( $sName, $iLang = null )
    {
        if (isset($this->_aModule[$sName])) {

            if ( $iLang !== null && is_array($this->_aModule[$sName]) ) {
                $sValue = null;

                $sLang = oxLang::getInstance()->getLanguageAbbr( $iLang );

                if ( !empty($this->_aModule[$sName]) ) {
                    if ( !empty( $this->_aModule[$sName][$sLang] ) ) {
                        $sValue = $this->_aModule[$sName][$sLang];
                    } elseif ( !empty($this->_aModule['lang']) ) {
                        // trying to get value according default language
                        $sValue = $this->_aModule[$sName][$this->_aModule['lang']];
                    } else {
                        // returning first array value
                        $sValue = reset( $this->_aModule[$sName] );
                    }

                    return $sValue;
                }
            } else {
                return $this->_aModule[$sName];
            }
        }
    }

    /**
     * Get parsed modules
     *
     * @return array
     */
    public function getAllModules()
    {
        return $this->parseModuleChains($this->getConfig()->getConfigParam('aModules'));
    }

    /**
     * Get parsed active modules
     *
     * @return array
     */
    public function getActiveModules()
    {
        $aAllModules      = $this->parseModuleChains($this->getConfig()->getConfigParam('aModules'));
        $aDisabledModules = $this->parseModuleChains($this->getConfig()->getConfigParam('aDisabledModules'));

        return $this->diffModuleArrays($aAllModules, $aDisabledModules);
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
     * Get parsed disabled modules
     *
     * @return array
     */
    public function getDisabledModules()
    {
        return $this->parseModuleChains($this->getConfig()->getConfigParam('aDisabledModules'));
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
     * Check if extension is active
     *
     * @return bool
     */
    public function isActive()
    {
        $blActive = false;
        if (isset($this->_aModule['extend']) && is_array($this->_aModule['extend'])) {
            $aAddModules = $this->_aModule['extend'];
            $aInstalledModules = $this->parseModuleChains($this->getConfig()->getConfigParam('aModules'));
            $aDisabledModules  = $this->parseModuleChains($this->getConfig()->getConfigParam('aDisabledModules'));

            $iClCount = count($aAddModules);
            $iActive  = 0;

            foreach ($aAddModules as $sClass => $sModule) {
                if ( (isset($aInstalledModules[$sClass]) && in_array($sModule, $aInstalledModules[$sClass])) && !(isset($aDisabledModules[$sClass]) && in_array($sModule, $aDisabledModules[$sClass])) ) {
                    $iActive ++;
                }
            }
            $blActive = $iClCount > 0 && $iActive == $iClCount;
        }

        return $blActive;
    }

    /**
     * Check if extension das any extended classes
     *
     * @return bool
     */
    public function isExtended()
    {
        if ($this->hasMetadata() && !empty($this->_aModule['extend'])) {
            return true;
        }

        return false;
    }

    /**
     * Checks if module is defined as legacy module
     *
     * @return bool
     */
    public function isLegacy()
    {
        return $this->_blLegacy;
    }

    /**
     * Checks if module is registered in any way
     *
     * @return bool
     */
    public function isRegistered()
    {
        return $this->_blRegistered;
    }

    /**
     * Checks if module has metadata
     *
     * @return bool
     */
    public function hasMetadata()
    {
        return $this->_blMetadata;
    }

    /**
     * Checks if module is single file
     *
     * @return bool
     */
    public function isFile()
    {
        return $this->_blFile;
    }

    /**
     * Activate extension by merging module class inheritance information with shop module array
     *
     * @return bool
     */
    public function activate()
    {
        if (isset($this->_aModule['extend']) && is_array($this->_aModule['extend'])) {
            $aAddModules = $this->_aModule['extend'];

            $aInstalledModules = $this->parseModuleChains($this->getConfig()->getConfigParam('aModules'));
            $aDisabledModules  = $this->parseModuleChains($this->getConfig()->getConfigParam('aDisabledModules'));
            $aModulesPath      = $this->getConfig()->getConfigParam('aModulesPath');

            $aModules = $this->mergeModuleArrays($aInstalledModules, $aAddModules);
            $aModules = $this->buildModuleChains($aModules);

            $aDisabledModules = $this->diffModuleArrays($aDisabledModules, $aAddModules);
            $aDisabledModules = $this->buildModuleChains($aDisabledModules);

            $aModulesPath[$this->_aModule['id']] = $this->_aModule['id'];

            $this->getConfig()->setConfigParam('aModules', $aModules);
            $this->getConfig()->saveShopConfVar('aarr', 'aModules', $aModules);

            $this->getConfig()->setConfigParam('aDisabledModules', $aDisabledModules);
            $this->getConfig()->saveShopConfVar('aarr', 'aDisabledModules', $aDisabledModules);

            $this->getConfig()->setConfigParam('aModulesPath', $aModulesPath);
            $this->getConfig()->saveShopConfVar('aarr', 'aModulesPath', $aModulesPath);

            //activate oxblocks too
            $this->_changeBlockStatus( $this->getId(), "1" );

            return true;
        }
        return false;
    }

    /**
     * Deactivate extension by adding disable module class information to disabled module array
     *
     * @return bool
     */
    public function deactivate()
    {
        if (isset($this->_aModule['extend']) && is_array($this->_aModule['extend'])) {
            $aAddModules = $this->_aModule['extend'];
            $aDisabledModules = $this->parseModuleChains($this->getConfig()->getConfigParam('aDisabledModules'));

            $aModules = $this->mergeModuleArrays($aDisabledModules, $aAddModules);
            $aModules = $this->buildModuleChains($aModules);

            $this->getConfig()->setConfigParam('aDisabledModules', $aModules);
            $this->getConfig()->saveShopConfVar('aarr', 'aDisabledModules', $aModules);

            //deactivate oxblocks too
            $this->_changeBlockStatus( $this->getId() );
        }
        return false;
    }

    /**
     * Deactivates or activates oxblocks of a module
     *
     * @param string  $sModule Module name
     * @param integer $iStatus 0 or 1 to (de)activate blocks
     *
     * @return null
     */
    protected function _changeBlockStatus( $sModule, $iStatus = '0' )
    {
        $oDb = oxDb::getDb();
        $oDb->execute("UPDATE oxtplblocks SET oxactive = '".(int) $iStatus."' where oxmodule =". $oDb->quote($sModule));
        return true;
    }

    /**
     * Removes extension metadata from eshop
     *
     * @return null
     */
    public function remove()
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
        $this->_removeFromDisabledModulesArray( $aDeletedExt );

        // removing from aLegacyModules array
        $this->_removeFromLegacyModulesArray( $aDeletedExtIds );

        //removing from config tables and templates blocks table
        $this->_removeFromDatabase( $aDeletedExtIds );
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
     * @param array $aDeletedExt Deleated extendion array
     *
     * @return null
     */
    protected function _removeFromDisabledModulesArray( $aDeletedExt )
    {
        $aDisabledExt = $this->getDisabledModules();
        $aUpdatedExt  = $this->diffModuleArrays( $aDisabledExt, $aDeletedExt );
        $aUpdatedExt  = $this->buildModuleChains( $aUpdatedExt );
        $this->getConfig()->saveShopConfVar( 'aarr', 'aDisabledModules', $aUpdatedExt );
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

    /**
     * Parse array of module chains to nested array
     *
     * @param array $aModules Module array (config format)
     *
     * @return array
     */
    public function parseModuleChains($aModules)
    {
        $aModuleArray = array();

        if (is_array($aModules)) {
            foreach ($aModules as $sClass => $sModuleChain) {
                if (strstr($sModuleChain, '&')) {
                    $aModuleChain = explode('&', $sModuleChain);
                } else {
                    $aModuleChain = array($sModuleChain);
                }
                $aModuleArray[$sClass] = $aModuleChain;
            }
        }

        return $aModuleArray;
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
     * Merge two nested module arrays together so that the values of
     * $aAddModuleArray are appended to the end of the $aAllModuleArray
     *
     * @param array $aAllModuleArray All Module array (nested format)
     * @param array $aAddModuleArray Added Module array (nested format)
     *
     * @return array
     */
    public function mergeModuleArrays($aAllModuleArray, $aAddModuleArray)
    {
        if (is_array($aAllModuleArray) && is_array($aAddModuleArray)) {
            foreach ($aAddModuleArray as $sClass => $aModuleChain) {
                if (!is_array($aModuleChain)) {
                    $aModuleChain = array($aModuleChain);
                }
                if (isset($aAllModuleArray[$sClass])) {
                    foreach ($aModuleChain as $sModule) {
                        if (!in_array($sModule, $aAllModuleArray[$sClass])) {
                            $aAllModuleArray[$sClass][] = $sModule;
                        }
                    }
                } else {
                    $aAllModuleArray[$sClass] = $aModuleChain;
                }
            }
        }

        return $aAllModuleArray;
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
     * Filter module array using modue id
     *
     * @param array  $aModules  Module array (nested format)
     * @param string $sModuleId Module id/folder name
     *
     * @return array
     */
    public function filterModuleArray($aModules, $sModuleId)
    {
        $aFilteredModules = array();
        foreach ($aModules as $sClass => $aExtend) {
            foreach ($aExtend as $sExtendPath) {
                if (strstr($sExtendPath, $sModuleId.'/')) {
                    $aFilteredModules[$sClass][] = $sExtendPath;
                }
            }
        }
        return $aFilteredModules;
    }
}