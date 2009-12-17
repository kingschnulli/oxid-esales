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
 * $Id: statistic_main.php 24610 2009-12-14 09:23:38Z arvydas $
 */

/**
 * Admin article main statistic manager.
 * Performs collection and updatind (on user submit) main item information.
 * Admin Menu: Statistics -> Show -> Main.
 * @package admin
 */
class Statistic_Main extends oxAdminDetails
{
    /**
     * Executes parent method parent::render(), cretes oxstatistic object,
     * passes it's data to Smarty engine and returns name of template file
     * "statistic_main.tpl".
     *
     * @return string
     */
    public function render()
    {
        $myConfig  = $this->getConfig();
        $oLang = oxLang::getInstance();

        parent::render();

        $soxId = oxConfig::getParameter( "oxid");
        if (!$soxId)
            $soxId = "-1";

        // check if we right now saved a new entry
        $sSavedID = oxConfig::getParameter( "saved_oxid");
        if ( ($soxId == "-1" || !isset( $soxId)) && isset( $sSavedID) ) {
            $soxId = $sSavedID;
            oxSession::deleteVar( "saved_oxid");
            $this->_aViewData["oxid"] =  $soxId;
            // for reloading upper frame
            $this->_aViewData["updatelist"] =  "1";
        }

        $aReports = array();
        if ( $soxId != "-1" && isset( $soxId)) {
            // load object
            $oStat = oxNew( "oxstatistic" );
            $oStat->load( $soxId);

            $aReports = $oStat->getReports();
            $this->_aViewData["edit"] =  $oStat;
        }

        // setting all reports data: check for reports and load them
        $sPath     = getShopBasePath().$myConfig->getConfigParam( 'sAdminDir' ) . "/reports";
        $iLanguage = (int) oxConfig::getParameter("editlanguage");
        $aAllreports = array();

        $aReportFiles = glob( $sPath."/*.php" );
        foreach ( $aReportFiles as $sFile ) {
            if ( is_file( $sFile ) && !is_dir( $sFile ) ) {

                $sConst = strtoupper( str_replace( '.php', '', basename( $sFile ) ) );

                // skipping base report class
                if ( $sConst == 'REPORT_BASE') {
                    continue;
                }

                include $sFile;

                $oItem = new oxStdClass();
                $oItem->filename = basename( $sFile );
                $oItem->name     = $oLang->translateString( $sConst, $iLanguage );
                $aAllreports[]   = $oItem;
            }
        }

        // setting reports data
        oxSession::setVar( "allstat_reports", $aAllreports);
        oxSession::setVar( "stat_reports_$soxId", $aReports);

        // passing assigned reports count
        $this->_aViewData['ireports'] = count($aReports);

         if ( oxConfig::getParameter("aoc") ) {

            $aColumns = array();
            include_once 'inc/'.strtolower(__CLASS__).'.inc.php';
            $this->_aViewData['oxajax'] = $aColumns;

            return "popups/statistic_main.tpl";
        }

        return "statistic_main.tpl";
    }

    /**
     * Saves statistic parameters changes.
     *
     * @return mixed
     */
    public function save()
    {
        $soxId   = oxConfig::getParameter( "oxid");
        $aParams = oxConfig::getParameter( "editval");

        // shopid
        $sShopID = oxSession::getVar( "actshop");

        $oStat = oxNew( "oxstatistic" );
        if ( $soxId != "-1")
            $oStat->load( $soxId);
        else
            $aParams['oxstatistics__oxid'] = null;

        $aAllreports = oxSession::getVar( "stat_reports_$soxId");

        $aParams['oxstatistics__oxshopid'] = $sShopID;
        $oStat->setReports($aAllreports);
        $oStat->assign($aParams);
        $oStat->save();
        $this->_aViewData["updatelist"] = "1";

        // set oxid if inserted
        if ( $soxId == "-1")
            oxSession::setVar( "saved_oxid", $oStat->oxstatistics__oxid->value);
    }

    /**
     * Performs report generation function (outputs Smarty generated HTML report).
     *
     * @return null
     */
    public function generate()
    {
        $myConfig  = $this->getConfig();

        $soxId = oxConfig::getParameter( "oxid" );

        // load object
        $oStat = oxNew( "oxstatistic" );
        $oStat->load( $soxId );

        $aAllreports = $oStat->getReports();

        $oShop = oxNew( "oxshop" );
        $oShop->load( $myConfig->getShopId());
        $oShop = $this->addGlobalParams( $oShop );

        $sTime_from = oxConfig::getParameter( "time_from" );
        $sTime_to   = oxConfig::getParameter( "time_to" );
        if ( $sTime_from && $sTime_to ) {
            $sTime_from = oxUtilsDate::getInstance()->formatDBDate( $sTime_from, true );
            $sTime_from = date( "Y-m-d", strtotime( $sTime_from ) );
            $sTime_to = oxUtilsDate::getInstance()->formatDBDate( $sTime_to, true );
            $sTime_to = date( "Y-m-d", strtotime( $sTime_to ) );
        } else {
            $dDays = oxConfig::getParameter( "timeframe" );
            $dNow  = time();
            $sTime_from = date( "Y-m-d", mktime( 0, 0, 0, date( "m", $dNow ), date( "d", $dNow ) - $dDays, date( "Y", $dNow ) ) );
            $sTime_to   = date( "Y-m-d", time() );
        }

        $oSmarty = oxUtilsView::getInstance()->getSmarty();
        $oSmarty->assign( "time_from", $sTime_from." 23:59:59" );
        $oSmarty->assign( "time_to", $sTime_to." 23:59:59" );
        $oSmarty->assign( "shop", $oShop );

        echo( $oSmarty->fetch( "report_pagehead.tpl" ) );
        foreach ( $aAllreports as $file ) {
            if ( ( $file = trim( $file ) ) ) {
                $sClassName = str_replace( ".php", "", strtolower( $file ) );

                $oReport = oxNew( $sClassName );
                $oReport->setSmarty( $oSmarty );

                $oSmarty->assign( "oView", $oReport );
                echo( $oSmarty->fetch( $oReport->render() ) );
            }
        }

        oxUtils::getInstance()->showMessageAndExit( $oSmarty->fetch( "report_bottomitem.tpl" ) );
    }
}
