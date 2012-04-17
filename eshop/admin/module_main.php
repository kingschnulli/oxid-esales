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
 * @version   SVN: $Id: deliveryset_main.php 25466 2010-02-01 14:12:07Z alfonsas $
 */

/**
 * Admin article main deliveryset manager.
 * There is possibility to change deliveryset name, article, user
 * and etc.
 * Admin Menu: Shop settings -> Shipping & Handling -> Main Sets.
 * @package admin
 */
class Module_Main extends oxAdminDetails
{

    /**
     * Executes parent method parent::render(), creates deliveryset category tree,
     * passes data to Smarty engine and returns name of template file "deliveryset_main.tpl".
     *
     * @return string
     */
    public function render()
    {
        if ( oxConfig::getParameter("moduleId") ) {
            $sModuleId = oxConfig::getParameter("moduleId");
        } else {
            $sModuleId = $this->getEditObjectId();
        }

        $oModule = oxNew('oxModule');

        if ( $sModuleId ) {
            if ( $oModule->load( $sModuleId ) ) {
                $this->_aViewData["oModule"]     =  $oModule;
                $this->_aViewData["sModuleName"] = basename( $oModule->getInfo('title') );
                $this->_aViewData["sModuleId"]   = str_replace( "/", "_", $oModule->getModulePath() );
            } else {
                oxUtilsView::getInstance()->addErrorToDisplay( new oxException('EXCEPTION_MODULE_NOT_LOADED') );
            }
        }

        parent::render();

        return 'module_main.tpl';
    }

    /**
     * Activate module
     *
     * @return null
     */
    public function activateModule()
    {
        $sModule = $this->getEditObjectId();
        $oModule = oxNew('oxModule');
        if (!$oModule->load($sModule)) {
            oxUtilsView::getInstance()->addErrorToDisplay( new oxException('EXCEPTION_MODULE_NOT_LOADED') );
            return;
        }
        try {
            $oModule->activate();
        } catch (oxException $oEx) {
            oxUtilsView::getInstance()->addErrorToDisplay( $oEx );
            $oEx->debugOut();
        }
    }

    /**
     * Deactivate module
     *
     * @return null
     */
    public function deactivateModule()
    {
        $sModule = $this->getEditObjectId();
        $oModule = oxNew('oxModule');
        if (!$oModule->load($sModule)) {
            oxUtilsView::getInstance()->addErrorToDisplay( new oxException('EXCEPTION_MODULE_NOT_LOADED') );
            return;
        }
        try {
            $oModule->deactivate();
        } catch (oxException $oEx) {
            oxUtilsView::getInstance()->addErrorToDisplay( $oEx );
            $oEx->debugOut();
        }
    }

    /**
     * Enables modules that dont have metadata file activation/deactivation by
     * writing to "aLegacyModules" config variable classes that current module
     * extedens
     *
     * @return bool
     */
    public function enableActivation()
    {
        $aLegacyModules = $this->getConfig()->getConfigParam( "aLegacyModules" );

        $aModuleInfo = explode( "\n", trim( oxConfig::getParameter("aExtendedClasses") ) );
        $sModuleLegacyId = trim( $this->getEditObjectId() );
        $sModuleId = trim( oxConfig::getParameter("moduleId") );
        $sModuleName = trim( oxConfig::getParameter("moduleName") );

        if ( !empty( $aModuleInfo ) ) {
            $aLegacyModules[$sModuleId]["id"] = $sModuleId;
            $aLegacyModules[$sModuleId]["title"] = ( $sModuleName ) ? $sModuleName : $sModuleId;

            foreach ( $aModuleInfo as $sKey => $sValue ) {
                if ( strpos( $sValue, "=>" ) > 1 ) {
                    $aClassInfo    = explode( "=>", $sValue );
                    $sClassName    = trim( $aClassInfo[0] );
                    $sExtendString = trim( $aClassInfo[1] );
                    $aLegacyModules[$sModuleId]['extend'][$sClassName] = $sExtendString;
                }
            }
        }

        if ( $sModuleLegacyId != $sModuleId ) {
            $this->_updateModuleConfigVars( $sModuleLegacyId, $sModuleId );
            $this->setEditObjectId($sModuleId);
        }
        if ( !empty( $aLegacyModules[$sModuleId]['extend'] ) ) {
            $this->getConfig()->saveShopConfVar( "aarr", "aLegacyModules", $aLegacyModules );
        }
    }

    /**
     * Update module ID in modules config variables aModulePaths and aDisabledModules.
     *
     * @param string $sModuleLegacyId Old module ID
     * @param string $sModuleId       New module ID
     *
     * @return null
     */
    protected function _updateModuleConfigVars( $sModuleLegacyId, $sModuleId )
    {
        $oConfig = $this->getConfig();

        // updating module ID in aModulePaths config var
        $aModulePaths = $oConfig->getConfigParam( 'aModulePaths' );
        $aModulePaths[$sModuleId] = $aModulePaths[$sModuleLegacyId];
        unset( $aModulePaths[$sModuleLegacyId] );

        $oConfig->saveShopConfVar( 'aarr', 'aModulePaths', $aModulePaths );

        if ( isset($aModulePaths[$sModuleLegacyId]) ) {
            $aModulePaths[$sModuleId] = $aModulePaths[$sModuleLegacyId];
            unset( $aModulePaths[$sModuleLegacyId] );
            $oConfig->saveShopConfVar( 'aarr', 'aModulePaths', $aModulePaths );
        }

        // updating module ID in aDisabledModules config var
        $aDisabledModules = $oConfig->getConfigParam( 'aDisabledModules' );

        if ( is_array($aDisabledModules) ) {
            $iOldKey = array_search( $sModuleLegacyId, $aDisabledModules );
            if ( $iOldKey !== false ) {
                unset( $aDisabledModules[$iOldKey] );
                $aDisabledModules[$iOldKey] = $sModuleId;
                $oConfig->saveShopConfVar( 'arr', 'aDisabledModules', $aDisabledModules );
            }
        }
    }
}