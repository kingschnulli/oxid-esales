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
     * Module main path
     *
     * @var string
     */
    protected $_sModulePath   = null;

    /**
     * Load module info
     *
     * @param string $sModuleId Module ID
     *
     * @return bool
     */
    public function load( $sModuleId )
    {
        if ( $this->loadModule($sModuleId) ) return true;

        if ( $this->loadLegacyModule($sModuleId) ) return true;

        if ( $this->loadUnregisteredModule($sModuleId) ) return true;

        return false;
    }

    /**
     * Load module by dir name
     *
     * @param string $sModuleDir Module dir name
     *
     * @return bool
     */
    public function loadByDir( $sModuleDir )
    {
        $aModulePaths = $this->getModulePaths();

        if ( is_array($aModulePaths) ) {
            $sModuleId = array_search( $sModuleDir, $aModulePaths);
        }

        // if no module id defined, using module dir as id
        if ( !$sModuleId ) {
            $sModuleId = $sModuleDir;
        }

        return $this->load( $sModuleId );
    }

    /**
     * Load Extension from metadata
     *
     * @param string $sModuleId Module ID
     *
     * @return bool
     */
    public function loadModule( $sModuleId )
    {
        $sModuleDir = $this->getModulePath( $sModuleId );

        $sFilePath = $this->getConfig()->getModulesDir() . $sModuleDir . "/metadata.php";
        if ( file_exists( $sFilePath ) && is_readable( $sFilePath ) ) {
            $aModule = array();
            include $sFilePath;
            $this->_aModule = $aModule;
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
    public function loadLegacyModule( $sModuleId )
    {
        $aLegacyModules = $this->getLegacyModules();
        $sModuleDir = $this->getModulePath( $sModuleId );

        // registered legacy module
        if ( isset( $aLegacyModules[$sModuleId] ) ) {
            $this->_aModule = $aLegacyModules[$sModuleId];
            $this->_blLegacy      = true;
            $this->_blRegistered  = true;
            $this->_blMetadata    = false;
            $this->_blFile        = empty( $sModuleDir );
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
    public function loadUnregisteredModule( $sModuleId )
    {
        $aModules = $this->getAllModules();

        $sModuleDir = $this->getModulePath( $sModuleId );

        $sFilePath = $this->getConfig()->getModulesDir() . $sModuleDir ;
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
     * Check if extension is active
     *
     * @return bool
     */
    public function isActive()
    {
        $blActive = false;
        $sId = $this->getId();
        if (isset($sId)) {
            if (isset($this->_aModule['extend']) && is_array($this->_aModule['extend'])) {
                $aAddModules = $this->_aModule['extend'];
                $aInstalledModules = $this->getAllModules();
                $iClCount = count($aAddModules);
                $iActive  = 0;

                foreach ($aAddModules as $sClass => $sModule) {
                    if ( (isset($aInstalledModules[$sClass]) && in_array($sModule, $aInstalledModules[$sClass])) ) {
                        $iActive ++;
                    }
                }
                $blActive = $iClCount > 0 && $iActive == $iClCount;

                $aDisabledModules = $this->getDisabledModules();
                if ( $blActive && ( is_array($aDisabledModules) && in_array($sId, $aDisabledModules) ) ) {
                    $blActive = false;
                }
            }
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
            $oConfig     = $this->getConfig();
            $aAddModules = $this->_aModule['extend'];
            $sModuleId   = $this->getId();

            $aInstalledModules = $this->getAllModules();
            $aDisabledModules  = $this->getDisabledModules();

            $aModules = $this->mergeModuleArrays($aInstalledModules, $aAddModules);
            $aModules = $this->buildModuleChains($aModules);

            $oConfig->setConfigParam('aModules', $aModules);
            $oConfig->saveShopConfVar('aarr', 'aModules', $aModules);

            if ( isset($aDisabledModules) && is_array($aDisabledModules) ) {
                $aDisabledModules = array_diff($aDisabledModules, array($sModuleId));

                $oConfig->setConfigParam('aDisabledModules', $aDisabledModules);
                $oConfig->saveShopConfVar('arr', 'aDisabledModules', $aDisabledModules);
            }

            // checking if module has tpl blocks and they are installed
            if ( !$this->_hasInstalledTplBlocks($sModuleId) ) {
                // installing module blocks
                $this->_addTplBlocks( $this->getInfo("tplblocks") );
            } else {
                //activate oxblocks
                $this->_changeBlockStatus( $sModuleId, "1" );
            }
            
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
        $sModuleId = $this->getId();
        if (isset($sModuleId)) {
            $aDisabledModules = $this->getDisabledModules();

            if (!is_array($aDisabledModules)) {
                $aDisabledModules = array();
            }
            $aModules = array_merge($aDisabledModules, array($sModuleId));

            $this->getConfig()->setConfigParam('aDisabledModules', $aModules);
            $this->getConfig()->saveShopConfVar('arr', 'aDisabledModules', $aModules);

            //deactivate oxblocks too
            $this->_changeBlockStatus( $this->getId() );

            return true;
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

    /**
     * Get module dir
     *
     * @param array $sModuleId Module ID
     *
     * @return string
     */
    public function getModulePath( $sModuleId = null )
    {
        if ( $this->_sModulePath !== null ) {
            return $this->_sModulePath;
        }

        if ( !$sModuleId ) {
            $sModuleId = $this->getId();
        }

        $aModulePaths = $this->getModulePaths();

        $this->_sModulePath = $aModulePaths[$sModuleId];

        // if still no module dir, try using module ID as dir name
        if ( !$this->_sModulePath && is_dir($this->getConfig()->getModulesDir().$sModuleId) ) {
            $this->_sModulePath = $sModuleId;
        }

        return $this->_sModulePath;
    }

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
     * Checks if module has installed tpl blocks
     *
     * @param string $sModuleId Module ID
     *
     * @return bool
     */
    protected function _hasInstalledTplBlocks( $sModuleId )
    {
        $sShopId   = $this->getConfig()->getShopId();
        $blRes = oxDb::getInstance()->getOne( "select 1 from oxtplblocks where OXMODULE = '$sModuleId' and OXSHOPID = '$sShopId' limit 1 " );

        return (bool) $blRes;
    }

    /**
     * Add module templates to database.
     *
     * @param array $aModuleBlocks Module blocks array
     *
     * @return null
     */
    protected function _addTplBlocks( $aModuleBlocks )
    {
        $sShopId   = $this->getConfig()->getShopId();
        $sModuleId = $this->getId();
        $oDb       = oxDb::getDb();
        
        if ( is_array($aModuleBlocks) ) {

            foreach ( $aModuleBlocks as $aValue ) {
                $sOxId = oxUtilsObject::getInstance()->generateUId();

                $sSql = "INSERT INTO `oxtplblocks` (`OXID`, `OXACTIVE`, `OXSHOPID`, `OXTEMPLATE`, `OXBLOCKNAME`, `OXPOS`, `OXFILE`, `OXMODULE`)
                         VALUES ('$sOxId', 1, '$sShopId', '{$aValue["shopTpl"]}', '{$aValue["blockName"]}', '{$aValue["blockPos"]}', '{$aValue["blockTpl"]}', '$sModuleId')";

                $oDb->execute( $sSql );
            }
        }
    }
}