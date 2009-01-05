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
 * @package admin
 * @copyright � OXID eSales AG 2003-2009
 * $Id: efire_downloader.php 12555 2008-09-29 13:07:20Z tomas $
 */

class EFire_Downloader extends oxAdminView
{
    /**
     * Template name
     *
     * @var string
     */
    protected $_sThisTemplate = "efire_downloader.tpl";

    public function render()
    {
        $this->_aViewData['sEfiUsername'] = htmlspecialchars($this->getConfig()->getConfigParam('sEfiUsername'));
        $this->_aViewData['sEfiPassword'] = htmlspecialchars($this->getConfig()->getConfigParam('sEfiPassword'));

        return parent::render();
    }

    /**
     * Returns list of admin users
     *
     * @return oxuserlist
     */
    public function getAdminList()
    {
        $oUserList = oxNew( "oxUserList" );
        $oUser = $oUserList->getBaseObject();

        $sQ  = "select ".$oUser->getSelectFields()." from oxuser ";
        $sQ .= "where oxuser.oxrights != 'user' ";

        $oUserList->selectString( $sQ );
        return $oUserList;
    }

    /**
     * Downloads connector, displays message on  success, error on failure.
     *
     * @return null
     */
    public function getConnector()
    {
        $oConfig = $this->getConfig();

        $sEtUsername = $this->getConfig()->getParameter("etUsername");
        $sEtPassword = $this->getConfig()->getParameter("etPassword");

        $oConnector = oxNew("oxefidownloader");

        $sShopVersion = $this->getConfig()->getEdition() . " " . $this->getConfig()->getVersion();

        $blSaveCredentials = $this->getConfig()->getParameter('blSaveCredentials');

        try {
            $oConnector->downloadConnector($sEtUsername, $sEtPassword, $sShopVersion, $blSaveCredentials);
            $this->_aViewData['message'] = oxLang::getInstance()->translateString('EFIRE_DOWNLOADER_SUCCESS');
        } catch (Exception $e) {
            oxUtilsView::getInstance()->addErrorToDisplay(sprintf(oxLang::getInstance()->translateString('EFIRE_DOWNLOADER_ERROR'), $e->getMessage()));
        }
    }
}