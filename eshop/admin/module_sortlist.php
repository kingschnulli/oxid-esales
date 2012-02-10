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
class Module_Sortlist extends oxAdminDetails
{

    /**
     * Executes parent method parent::render(), creates deliveryset category tree,
     * passes data to Smarty engine and returns name of template file "deliveryset_main.tpl".
     *
     * @return string
     */
    public function render()
    {
        $sOxId = $this->getEditObjectId();

        $oConfig = $this->getConfig();

        parent::render();

        $oModule = oxNew( "oxModule" );

        $this->_aViewData["aExtClasses"] = $oModule->getAllModules();

        $this->_aViewData["aDisabledModules"] = $oModule->getDisabledModules();

        // checking if there are any deleted extensions
        if ( oxSession::getVar( "blSkipDeletedExtCheking" ) == false ) {
            $aDeletedExt = $oModule->getDeletedExtensions();
        }

        if ( !empty($aDeletedExt) ) {
            $this->_aViewData["aDeletedExt"] = $aDeletedExt;
        }

        return 'module_sortlist.tpl';
    }

    /**
     * Saves updated aModules config var
     *
     * @return null
     */
    public function save()
    {
        $oConfig = $this->getConfig();

        $aModules = json_decode( $oConfig->getParameter("aModules"), true );

        $oModule = oxNew( "oxModule" );
        $aModules = $oModule->buildModuleChains( $aModules );

        $oConfig->saveShopConfVar( "aarr", "aModules", $aModules );
    }

    /**
     * Removes extension metadata from eshop
     *
     * @return null
     */
    public function remove()
    {
        //if user selected not to update modules, skipping all updates
        if ( oxConfig::getParameter( "noButton" )) {
            oxSession::getInstance()->setVar( "blSkipDeletedExtCheking", true );
            return;
        }

        $oModule = oxNew( "oxModule" );
        $oModule->remove();
    }
}
