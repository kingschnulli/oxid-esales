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
 * @package core
 * @copyright (C) OXID eSales AG 2003-2009
 * @version OXID eShop CE
 * $Id: oxfunctions.php 20495 2009-06-26 14:35:38Z arvydas $
 */

/**
 * Includes $sClass class file
 *
 * @param string $sClass classname
 *
 * @return null
 */
function __autoload( $sClass )
{

    $sClass = basename( $sClass );

    static $sBasePath  = null;
    static $aClassDirs = null;

    // preventing infinite loop
    static $aTriedClasses = array();

    // initializing paths
    if ( $aClassDirs == null ) {
        $sBasePath = getShopBasePath();
        $aClassDirs = array( $sBasePath . 'core/',
                             $sBasePath . 'views/',
                             $sBasePath . 'core/exception/',
                             $sBasePath . 'core/interface/',
                             $sBasePath . 'admin/reports/',
                             $sBasePath . 'admin/',
                             $sBasePath . 'modules/',
                             $sBasePath
                            );
    }

    foreach ( $aClassDirs as $sDir ) {
        $sFilename = $sDir . strtolower( $sClass ) . '.php';
        if ( file_exists( $sFilename ) ) {
            require_once $sFilename;
            return;
        }
    }

    // in case module parent class (*_parent) is required
    $sClass = preg_replace( '/_parent$/i', '', $sClass );

    // special case
    if ( !in_array( $sClass, $aTriedClasses ) && is_array( $aModules = oxConfig::getInstance()->getConfigParam( 'aModules' ) ) ) {

        $myUtilsObject = oxUtilsObject::getInstance();
        foreach ( $aModules as $sParentName => $sModuleName ) {
            // looking for module parent class
            if ( stripos( $sModuleName, $sClass ) !== false ) {
                $myUtilsObject->getClassName( $sParentName );
                break;
            }
        }
        $aTriedClasses[] = $sClass;
    }
}

if ( !function_exists( 'error_404_handler' ) ) {
    /**
     * error_404_handler handler for 404 (page not found) error
     *
     * @param string $sUrl url wich was given, can be not specified in some cases
     *
     * @return void
     */
    function error_404_handler($sUrl = '')
    {
        $oUtils = oxUtils::getInstance();
        $oUtils->setHeader("HTTP/1.0 404 Not Found");
        $sReturn = "Page not found.";
        try {
            $oView = oxNew('oxubase');
            $oView->init();
            $oView->render();
            $oView->addTplParam('sUrl', $sUrl);
            if ($sRet = oxUtilsView::getInstance()->getTemplateOutput('err_404.tpl', $oView)) {
                $sReturn = $sRet;
            }
        } catch (Exception $e) {
        }
        $oUtils->showMessageAndExit( $sReturn );
    }
}

/**
 * Displays 'nice' HTML formatted user error.
 * Later this method is hooked as error handler by calling set_error_handler('warningHandler', E_USER_WARNING);
 * #T2008-07-22
 * Not used yet
 *
 * @param int    $iErrorNr   error number
 * @param string $sErrorText error message
 *
 * @return null
 */
function warningHandler($iErrorNr, $sErrorText)
{
    echo "<div class='error_box'>".oxLang::getInstance()->translateString('userError')."<code>[$iErrorNr] $sErrorText</code></div>";
}

/**
 * Dumps $mVar information to vardump.txt file. Used in debugging.
 *
 * @param mixed $mVar     variable
 * @param bool  $blToFile marker to write log info to file (must be true to log)
 *
 * @return null
 */
function dumpVar( $mVar, $blToFile = false )
{
    $myConfig = oxConfig::getInstance();
    if ( $blToFile ) {
        $out = var_export( $mVar, true );
        $f = fopen( $myConfig->getConfigParam( 'sCompileDir' )."/vardump.txt", "a" );
        fwrite( $f, $out );
        fclose( $f );
    } else {
        echo '<pre>';
        print_r( $mVar );
        echo '</pre>';
    }
}

if ( !function_exists( 'isAdmin' ) ) {
    /**
     * Returns false as function returning true is supposed to be defined in admin/index.php dir.
     * In OXID you can use isAdmin() to detect if code is executed in admin.
     * Note: It does not detect if admion is logged in just identifies the place where it is called from.
     *
     * @return bool
     */
    function isAdmin()
    {
        //additionally checking maybe oxConfig::blAdmin is already set
        if ( class_exists( 'oxConfig', false ) ) {
            $blAdmin = oxConfig::getInstance()->getConfigParam( 'blAdmin' );
            if ( isset( $blAdmin ) ) {
                stopProfile('isAdmin');
                return $blAdmin;
            }
        }
        return false;
    }
}

if ( !function_exists( 'isSearchEngineUrl' ) ) {

    /**
     * Returns search engine url status
     *
     * @return bool
     */
    function isSearchEngineUrl()
    {
        return false;
    }
}

/**
 * prints anything given into a file, for debugging
 *
 * @param mixed $mVar variable to debug
 *
 * @return null
 */
function debug( $mVar )
{
    $f = fopen( 'out.txt', 'a' );
    $sString = var_export( $mVar, true );
    fputs( $f, $sString."\n---------------------------------------------\n" );
    fclose( $f );
}

/**
 * Sorting for crossselling
 *
 * @param object $a first compare item
 * @param object $b second compre item
 *
 * @return integer
 */
function cmpart( $a, $b )
{
    // sorting for crossselling
    if ( $a->cnt == $b->cnt )
        return 0;
    return ( $a->cnt < $b->cnt ) ? -1 : 1;
}

/**
 * Start profiling
 *
 * @param string $sProfileName name of profile
 *
 * @return null
 */
function startProfile( $sProfileName )
{
    global $aStartTimes;
    global $aExecutionCounts;
    if (!isset($aExecutionCounts[$sProfileName])) {
        $aExecutionCounts[$sProfileName] = 0;
    }
    if (!isset($aStartTimes[$sProfileName])) {
        $aStartTimes[$sProfileName] = 0;
    }
    $aExecutionCounts[$sProfileName]++;
    $aStartTimes[$sProfileName] = microtime(true);
}

/**
 * Stop profiling
 *
 * @param string $sProfileName name of profile
 *
 * @return null
 */
function stopProfile( $sProfileName )
{
    global $aProfileTimes;
    global $aStartTimes;
    if (!isset($aProfileTimes[$sProfileName])) {
        $aProfileTimes[$sProfileName] = 0;
    }
    $aProfileTimes[$sProfileName] += microtime( true ) - $aStartTimes[$sProfileName];
}

/**
 * Creates and returns new object. If creation is not available, dies and outputs
 * error message.
 *
 * @param string $sClassName Name of class
 * @param string $sParams    Parameters to object
 *
 * @throws oxSystemComponentException in case that class does not exists
 *
 * @return object
 */
function oxNew( $sClassName, $sParams = null )
{
    startProfile( 'oxNew' );
    $oRes = oxUtilsObject::getInstance()->oxNew( $sClassName, $sParams );
    stopProfile( 'oxNew' );
    return $oRes;
}

/**
 * Creates, loads returns oxarticle object
 *
 * @param string $sArtId product id
 *
 * @return oxarticle
 */
function oxNewArticle( $sArtId )
{
    return oxUtilsObject::getInstance()->oxNewArticle( $sArtId );
}

/**
 * Returns current DB handler
 *
 * @param bool $blAssoc data fetch mode
 *
 * @return oxDb
 */
function getDb($blAssoc = true)
{
    return oxDb::getDb($blAssoc);
}

/**
 * Returns string handler
 *
 * @return oxStr
 */
function getStr()
{
    return oxStr::getStr();
}

/**
 * Sets template name to passed reference, returns true.
 *
 * @param string $sTplName    name of template
 * @param string &$sTplSource Template source
 * @param object $oSmarty     not used here
 *
 * @return bool
 */
function ox_get_template( $sTplName, &$sTplSource, $oSmarty )
{
    $sTplSource = $oSmarty->oxidcache->value;
    if ( oxConfig::getInstance()->isDemoShop() ) {
        $oSmarty->security = true;
    }

    return true;
}

/**
 * Sets timestamt to passed timestamp object, returns true.
 *
 * @param string $sTplName       name of template
 * @param string &$iTplTimestamp template timestamp referense
 * @param object $oSmarty        not used here
 *
 * @return bool
 */
function ox_get_timestamp( $sTplName, &$iTplTimestamp, $oSmarty )
{
    if ( isset( $oSmarty->oxidtimecache->value ) ) {
        // use stored timestamp
        $iTplTimestamp = $oSmarty->oxidtimecache->value;
    } else {
        // always compile
        $iTplTimestamp = time();
    }

    return true;
}

/**
 * Assumes all templates are secure, returns true.
 *
 * @param string $sTplName not used here
 * @param object $oSmarty  not used here
 *
 * @return bool
 */
function ox_get_secure( $sTplName, $oSmarty )
{
    // assume all templates are secure
    return true;
}

/**
 * Does nothing.
 *
 * @param string $sTplName not used here
 * @param object $oSmarty  not used here
 *
 * @return null
 */
function ox_get_trusted( $sTplName, $oSmarty )
{
    // not used for templates
}

if ( !function_exists( 'getViewName' ) ) {

    /**
     * return the view name of the given table if a view exists, otherwise the table name itself
     *
     * @param string $sTable  table name
     * @param string $sShopId optional the shop id, otherwise config->myshopid is used
     *
     * @return string
     */
    function getViewName( $sTable, $sShopId = null )
    {

        return $sTable;
    }
}

if ( !function_exists( 'getRequestUrl' ) ) {
    /**
     * Returns request url, which was executed to render current page view
     *
     * @param string $sParams     Parameters to object
     * @param bool   $blReturnUrl If return url
     *
     * @return string
     */
    function getRequestUrl( $sParams = '', $blReturnUrl = false )
    {
        if ($_SERVER["REQUEST_METHOD"] != "POST" ) {

            if ( isset( $_SERVER['REQUEST_URI'] ) && $_SERVER['REQUEST_URI'] ) {
                $sRequest = $_SERVER['REQUEST_URI'];
            } else {    // try something else
                $sRequest = $_SERVER['SCRIPT_URI'];
            }

            // trying to resolve controller file name
            if ( $sRequest && ( $iPos = stripos( $sRequest, '?' ) ) !== false ) {

                // formatting request url
                $sRequest = 'index.php' . getStr()->substr( $sRequest, $iPos );

                // removing possible session id
                $sRequest = preg_replace( '/((\&)?sid=[^&]*(&)?)/', '', $sRequest );
                return str_replace( '&', '&amp;', $sRequest );
            }
        }
    }
}
