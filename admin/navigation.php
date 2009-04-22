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
 * @copyright (C) OXID eSales AG 2003-2009
 * @version OXID eShop CE
 * $Id: navigation.php 18346 2009-04-20 08:39:52Z rimvydas.paskevicius $
 */

/**
 * Administrator GUI navigation manager class.
 * @package admin
 */
class Navigation extends oxAdminView
{
    /**
     * Executes parent method parent::render(), generates menu HTML code,
     * passes data to Smarty engine, returns name of template file "nav_frame.tpl".
     *
     * @return string
     */
    public function render()
    {
        parent::render();
        $myUtilsServer = oxUtilsServer::getInstance();

        $sItem = oxConfig::getParameter( "item");
        if ( !isset( $sItem) || !$sItem ) {
            $sItem = "nav_frame.tpl";

            $aFavorites = oxConfig::getParameter( "favorites");
            if(is_array($aFavorites)) {
                $myUtilsServer->setOxCookie('oxidadminfavorites',implode('|',$aFavorites));
            }

        } else {
            // set menu structure
            $this->_aViewData["menustructure"] =  $this->getNavigation()->getDomXml()->documentElement->childNodes;

            // version patch strin
            $sVersion = str_replace( array("EE.","PE."), "", $this->_sShopVersion);
            $this->_aViewData["sVersion"] =  trim($sVersion);

            // #661 execute stuff we run each time when we start admin once
            $this->_aViewData['aMessage'] = $this->_doStartUpChecks();

            // favorite navigation
            $aFavorites = explode('|',$myUtilsServer->getOxCookie('oxidadminfavorites'));

            if(is_array($aFavorites) && count($aFavorites)) {
                 $this->_aViewData["menufavorites"] = $this->getNavigation()->getListNodes($aFavorites);
                 $this->_aViewData["aFavorites"]    = $aFavorites;
            }

            // history navigation
            $aHistory = explode('|',$myUtilsServer->getOxCookie('oxidadminhistory'));
            if(is_array($aHistory) && count($aHistory)) {
                $this->_aViewData["menuhistory"] = $this->getNavigation()->getListNodes($aHistory);
            }

            // open history node ?
            $this->_aViewData["blOpenHistory"] = oxConfig::getParameter( 'openHistory' );
        }

        $oShoplist = oxNew( 'oxshoplist' );
        $oBaseShop = $oShoplist->getBaseObject();

        $sWhere = '';
        $blisMallAdmin = oxSession::getVar( 'malladmin' );
        if ( !$blisMallAdmin) {
            // we only allow to see our shop
            $sShopID = oxSession::getVar( "actshop" );
            $sWhere = "where oxshops.oxid = '$sShopID'";
        }

        $oShoplist->selectString( "select ".$oBaseShop->getSelectFields()." from " . $oBaseShop->getViewName() . " $sWhere" );
        $this->_aViewData['shoplist'] = $oShoplist;

        return $sItem;
    }

    /**
     * Destroy session, redirects to admin login and clears cache
     *
     * @return null
     */
    public function logout()
    {
        $mySession = $this->getSession();
        $myConfig  = $this->getConfig();

        $oUser = oxNew( "oxuser" );
        $oUser->logout();

        // dodger - Task #1364 - Logout-Button
        // store
        $sSID = $mySession->getId();

        // kill session
        $mySession->destroy();

        // delete also, this is usually not needed but for security reasons we execute still
        if ( $myConfig->getConfigParam( 'blAdodbSessionHandler' ) ) {
            $sSQL = "delete from oxsessions where SessionID = '$sSID'";
            oxDb::getDb()->Execute( $sSQL);
        }

        //reseting content cache if needed
        $blDeleteCache = $this->getConfig()->getConfigParam( 'blClearCacheOnLogout' );
        if ( $blDeleteCache ) {
            $this->resetContentCache( $blDeleteCache );
        }

        oxUtils::getInstance()->redirect( 'index.php' );
    }

    /**
     * Every Time Admin starts we perform these checks
     * returns some messages if there is something to display
     *
     * @return string
     */
    protected function _doStartUpChecks()
    {   // #661
        $aMessage = array();
/*
            // check if there are any links in oxobject2category which are outdated or old
            $sSQL = "select oxobject2category.oxid from oxcategories, oxobject2category left join oxarticles on oxarticles.oxid = oxobject2category.oxobjectid  where oxcategories.oxid = oxobject2category.oxcatnid and oxarticles.oxid is null";
            $iCnt = 0;
            $sDel = "";
            $rs = oxDb::getDb()->Execute( $sSQL);
            if ($rs != false && $rs->recordCount() > 0) {
                while (!$rs->EOF) {
                    if ( $iCnt)
                        $sDel .= ",";
                    $sDel .= "'".$rs->fields[0]."'";
                    $iCnt++;
                    $rs->moveNext();
                }
                // delete it now
                oxDb::getDb()->Execute("delete from oxobject2category where oxid in ($sDel)");
                $aMessage['message'] = "- Deleted $iCnt old/outdated entries in table oxobject2category.<br>";
            }
*/
        // check if system reguirements are ok
        $oSysReq = new oxSysRequirements();
        if ( !$oSysReq->getSysReqStatus() ) {
            $aMessage['warning']  = oxLang::getInstance()->translateString('NAVIGATION_SYSREQ_MESSAGE');
            $aMessage['warning'] .= '<a href="?cl=sysreq" target="basefrm">';
            $aMessage['warning'] .= oxLang::getInstance()->translateString('NAVIGATION_SYSREQ_MESSAGE2').'</a>';
        }

        // version check
        if ( $sVersionNotice = $this->_checkVersion() ) {
            $aMessage['message'] .= $sVersionNotice;
        }

        return $aMessage;
    }

    /**
     * Checks if newer shop version available. If true - returns message
     *
     * @return string
     */
    protected function _checkVersion()
    {
            $sVersion = 'CE';

        $sQuery = 'http://admin.oxid-esales.com/'.$sVersion.'/onlinecheck.php?getlatestversion';
        if ( $sVersion = oxUtilsFile::getInstance()->readRemoteFileAsString( $sQuery ) ) {
            // current version is older ..
            if ( version_compare( $this->getConfig()->getVersion(), $sVersion ) == '-1' ) {
                return sprintf( oxLang::getInstance()->translateString( 'NAVIGATION_NEWVERSIONAVAILABLE' ), $sVersion );
            }
        }
    }
}