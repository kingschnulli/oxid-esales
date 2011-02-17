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
 * @copyright (C) OXID eSales AG 2003-2011
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
class Theme_Config extends Shop_Config
{
    protected $_sTheme = 'shop_config.tpl';

    /**
     * Executes parent method parent::render(), creates deliveryset category tree,
     * passes data to Smarty engine and returns name of template file "deliveryset_main.tpl".
     *
     * @return string
     */
    public function render()
    {
        $myConfig  = $this->getConfig();

        $sTheme  = $this->_sTheme = $this->getEditObjectId();
        $sShopId = $myConfig->getShopId();

        if (!isset( $sTheme ) ) {
            $sTheme = $this->_sTheme = $this->getConfig()->getConfigParam('sTheme');
        }

        try {
            oxLang::getInstance()->registerAdditionalLangFile(
                $this->_getTemplateOptionsLanguageFile()
            );
        } catch (oxException $oEx) {
            oxUtilsView::getInstance()->addErrorToDisplay( $oEx );
            $oEx->debugOut();
        }

        $oTheme = oxNew('oxTheme');
        $aTheme = $oTheme->load($sTheme);
        $this->_aViewData["aTheme"] =  $aTheme;

        $aDbVariables = $this->_loadConfVars($sShopId, $this->_getModuleForConfigVars());
        $this->_aViewData["var_constraints"] = $aDbVariables['constraints'];
        $this->_aViewData["var_grouping"]    = $aDbVariables['grouping'];
        foreach ($this->_aConfParams as $sType => $sParam) {
            $this->_aViewData[$sParam] = $aDbVariables['vars'][$sType];
        }

        return 'theme_config.tpl';
    }


    /**
     * Set theme
     *
     * @return null
     */
    public function setTheme()
    {
        $sTheme = $this->getEditObjectId();
        $oTheme = oxNew('oxtheme');
        $oTheme->setTheme($sTheme);
    }

    /**
     * return theme filter for config variables
     *
     * @return string
     */
    protected function _getModuleForConfigVars()
    {
        return oxConfig::OXMODULE_THEME_PREFIX.$this->_sTheme;
    }

    /**
     * return additional language file to load for theme options language constants
     *
     * @return string
     */
    protected function _getTemplateOptionsLanguageFile()
    {
        $sFile = $this->getConfig()->getLanguagePath(
            "theme_options.php",
            false,
            oxLang::getInstance()->getTplLanguage(),
            null,
            $this->_sTheme
        );
        if (!$sFile) {
            $oErr = new oxFileException('EXCEPTION_FILENOTFOUND');
            $oErr->setFileName('theme_options.php for the theme "'.$this->_sTheme.'"');
            throw $oErr;
        }
        return $sFile;
    }

    /**
     * Saves shop configuration variables
     *
     * @return null
     */
    public function saveConfVars()
    {
        $myConfig = $this->getConfig();


        $sTheme  = $this->_sTheme = $this->getEditObjectId();
        $sShopId = $myConfig->getShopId();

        $sModule = $this->_getModuleForConfigVars();

        foreach ($this->_aConfParams as $sType => $sParam) {
            $aConfVars = oxConfig::getParameter($sParam);
            if (is_array($aConfVars)) {
                foreach ( $aConfVars as $sName => $sValue ) {
                    $myConfig->saveShopConfVar(
                            $sType,
                            $sName,
                            $this->_serializeConfVar($sType, $sName, $sValue),
                            $sShopId,
                            $sModule
                    );
                }
            }
        }
    }
}
