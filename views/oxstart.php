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
 * @package views
 * @copyright � OXID eSales AG 2003-2008
 * $Id: oxstart.php 13614 2008-10-24 09:36:52Z sarunas $
 */

/**
 * Define class constants
 */
//an url used exclusively for checking if the shop is unlicensed
DEFINE( 'LICENSE_CHECK_URL', 'http://www.oxid-esales.com/checklicense.php' );
DEFINE( 'SHOP_ERROR_EMAIL', 'info@oxid-esales.com' );

/**
 * Encapsulates methods for application initialization.
 */
class oxStart extends oxView
{
    /**
     * Initializes globals and environment vars
     *
     * @return null
     */
    public function appInit()
    {
        $myConfig = $this->getConfig();
        $this->pageStart();

        if ( 'oxstart' == oxConfig::getParameter( 'cl' )  || $this->isAdmin() )
            return;


    }

    /**
     * Renders error screen
     *
     * @return unknown
     */
    public function render()
    {
        parent::render();

        $sErrorNo = oxConfig::getParameter( 'execerror' );
        $this->_aViewData[ 'errornr' ] = $this->getErrorNumber();

        $sTemplate = '';

        if ( $sErrorNo == 'unlicensed' )
            $sTemplate = 'err_unlicensed.tpl';
        if ( $sErrorNo == 'expireddemo' )
            $sTemplate = 'err_expired_days.tpl';
        if ( $sErrorNo == 'pro_exceeded' )
            $sTemplate = 'err_overloaded_articles.tpl';
        if ( $sErrorNo == 'unknown' )
            $sTemplate = 'err_unknown.tpl';
        if ( $sTemplate )
          return $sTemplate;
        else
          return 'start.tpl';
    }

    //this function should be called from outside
    /**
     * Shop check
     *
     * @return null
     */
    public function shopNotLicensed()
    {
        $myConfig  = $this->getConfig();
        $sResponse = oxUtilsFile::getInstance()->readRemoteFileAsString( LICENSE_CHECK_URL.'?selfurl='.rawurlencode( $myConfig->getShopURL() ) );

        $sMsg = '';
        if ( strpos( ' '.$sResponse, 'UNLICENSED' ) === 1 ) {
            //unlicensed shop
            $sMsg = 'Unlicensed';
            $myConfig->saveShopConfVar( 'str', 'sShopVar', 'unlc' );
        } else {
            //hack attempt?
            $sBody  = 'This is automated shop operation error report.'."\r\n\r\n";
            $sBody .= 'Error code: 0010 (Possible hack attempt).'."\r\n";
            $sBody .= 'Shop URL: '.$myConfig->getShopURL()."\r\n";
            $sBody .= 'Visitor IP: '.$_SERVER["REMOTE_ADDR"]."\r\n\r\n";
            $sBody .= 'Contact OXID-eSales for more information.'."\r\n";
            $sSubject = 'Shop error report';
            $oxEMail = oxNew( 'oxemail');
            $oxEMail->sendEmail( SHOP_ERROR_EMAIL, $sSubject, $sBody );
        }
        oxUtils::getInstance()->showMessageAndExit( $sMsg );
    }

    //this function should be called from outside
    /**
     * Shop check
     *
     * @return null
     */
    public function shopLicensed()
    {
        $myConfig  = $this->getConfig();
        $sResponse = oxUtilsFile::getInstance()->readRemoteFileAsString( LICENSE_CHECK_URL.'?selfurl='.rawurlencode( $myConfig->getShopURL() ) );

        $sMsg = '';
        if ( strpos( ' '.$sResponse, 'LICENSED' ) === 1 ) {
            //already licensed shop
            $sMsg = 'Licensed';
            $myConfig->saveShopConfVar( 'str', 'sShopVar', 'licns' );
        } else {
            //hack attempt?
            $sBody  = 'This is automated shop operation error report.'."\r\n\r\n";
            $sBody .= 'Error code: 0011 (Possible hack attempt).'."\r\n";
            $sBody .= 'Shop URL: '.$myConfig->getShopURL()."\r\n";
            $sBody .= 'Visitor IP: '.$_SERVER["REMOTE_ADDR"]."\r\n\r\n";
            $sBody .= 'Contact OXID-eSales for more information'."\r\n";
            $sSubject = 'Shop error report';
            $oxEMail = oxNew( 'oxemail');
            $oxEMail->sendEmail( SHOP_ERROR_EMAIL, $sSubject, $sBody );
        }
        oxUtils::getInstance()->showMessageAndExit( $sMsg );
    }

    /**
     * Creates and starts session object, sets default session language and currency.
     *
     * @return null
     */
    public function pageStart()
    {
        $myConfig  = $this->getConfig();

        // assign default values
        if ( !oxSession::hasVar( 'language') )
            oxSession::setVar( 'language', $myConfig->getConfigParam( 'sDefaultLang' ) );
        if ( !oxSession::hasVar('currency') )
            oxSession::setVar( 'currency', '0' );


        $myConfig->setConfigParam( 'iMaxMandates', $myConfig->getConfigParam( 'IMS' ) );
        $myConfig->setConfigParam( 'iMaxArticles', $myConfig->getConfigParam( 'IMA' ) );
    }

    /**
     * Unsets all session data.
     *
     * @return null
     */
    public function pageClose()
    {
        $mySession = $this->getSession();

        if ( isset( $mySession ) )
            $mySession->freeze();
    }

    /**
     * Prints out the OXID version and dies
     *
     * @return null
     */
    public function getVersion()
    {
        $oActShop = $this->getConfig()->getActiveShop();
        oxUtils::getInstance()->showMessageAndExit( 'ver:'.$oActShop->oxshops__oxversion->value );
    }

    /**
     * Return error number
     *
     * @return integer
     */
    public function getErrorNumber()
    {
        return oxConfig::getParameter( 'errornr' );
    }

}
