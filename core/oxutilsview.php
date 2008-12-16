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
 * @copyright � OXID eSales AG 2003-2008
 * $Id: oxutilsview.php 14484 2008-12-05 08:36:16Z arvydas $
 */

/**
 * View utility class
 */
class oxUtilsView extends oxSuperCfg
{
    /**
     * oxUtils class instance.
     *
     * @var oxutils* instance
     */
    private static $_instance = null;

    /**
     * Template processor object (smarty)
     *
     * @var smarty
     */
    protected static $_oSmarty = null;

    /**
     * Utility instance getter
     *
     * @return oxUtilsView
     */
    public static function getInstance()
    {
        // disable caching for test modules
        if ( defined( 'OXID_PHP_UNIT' ) ) {
            static $inst = array();
            self::$_instance = $inst[oxClassCacheKey()];
        }

        if ( !self::$_instance instanceof oxUtilsView ) {


            self::$_instance = oxNew( 'oxUtilsView' );

            if ( defined( 'OXID_PHP_UNIT' ) ) {
                $inst[oxClassCacheKey()] = self::$_instance;
            }
        }
        return self::$_instance;
    }

    /**
     * returns existing or creates smarty object
     * Returns smarty object. If object not yet initiated - creates it. Sets such
     * default parameters, like cache lifetime, cache/templates directory, etc.
     *
     * @param bool $blReload set true to force smarty reload
     *
     * @return smarty
     */
    public function getSmarty( $blReload = false )
    {
        if ( !self::$_oSmarty || $blReload ) {
            self::$_oSmarty = new Smarty;
            $this->_fillCommonSmartyProperties( self::$_oSmarty );
            $this->_smartyCompileCheck( self::$_oSmarty );
        }

        return self::$_oSmarty;
    }

    /**
     * Returns renderd template output. According to debug configuration outputs
     * debug information.
     *
     * @param string $sTemplate template file name
     * @param object $oObject   object, witch template we wish to output
     *
     * @return string
     */
    public function getTemplateOutput( $sTemplate, $oObject )
    {
        $oSmarty = $this->getSmarty();
        $iDebug  = $this->getConfig()->getConfigParam( 'iDebug' );

        // assign
        $aViewData = $oObject->getViewData();
        if ( is_array( $aViewData ) ) {
            foreach ( array_keys( $aViewData ) as $sViewName ) {
                // show debbuging information
                if ( $iDebug == 4 ) {
                    echo( "TemplateData[$sViewName] : \n");
                    print_r( $aViewData[$sViewName] );
                }
                $oSmarty->assign_by_ref( $sViewName, $aViewData[$sViewName] );
            }
        }

        return $oSmarty->fetch( $sTemplate );
    }

    /**
     * adds the given errors to the view array
     *
     * @param array &$aView  view data array
     * @param array $aErrors array of errors to pass to view
     *
     * @return null
     */
    public function passAllErrorsToView( &$aView, $aErrors )
    {
        if ( count( $aErrors ) > 0 ) {
            foreach ( $aErrors as $sLocation => $aEx2 ) {
                foreach ( $aEx2 as $sKey => $oEr ) {
                    $aView['Errors'][$sLocation][$sKey] = unserialize( $oEr );
                }
            }
        }
    }

    /**
     * adds a exception to the array of displayed exceptions for the view
     * by default is displayed in the inc_header, but with the custom destination set to true
     * the exception won't be displayed by default but can be displayed where ever wanted in the tpl
     *
     * @param exception $oEr                 a exception object or just a language local (string) which will be converted into a oxExceptionToDisplay object
     * @param bool      $blFull              if true the whole object is add to display (default false)
     * @param bool      $blCustomDestination true if the exception shouldn't be displayed at the default position (default false)
     * @param string    $sCustomDestination  defines a name of the view variable containing the messages, overrides Parameter 'CustomError' ("default")
     *
     * @return null
     */
    public function addErrorToDisplay( $oEr, $blFull = false, $blCustomDestination = false, $sCustomDestination = "" )
    {
        if ( $blCustomDestination && ( oxConfig::getParameter( 'CustomError' ) || $sCustomDestination!= '' ) ) {
            // check if the current request wants do display exceptions on its own
            $sDestination = oxConfig::getParameter( 'CustomError' );
            if ( $sCustomDestination != '' ) {
                $sDestination = $sCustomDestination;
            }
        } else {
            //default
            $sDestination = 'default';
        }

        $aEx = oxSession::getVar( 'Errors' );
        if ( $oEr instanceof oxException ) {
             $oEx = oxNew( 'oxExceptionToDisplay' );
             $oEx->setMessage( $oEr->getMessage() );
             $oEx->setExceptionType( get_class( $oEr ) );
             $oEx->setValues( $oEr->getValues() );
             $oEx->setStackTrace( $oEr->getTraceAsString() );
             $oEx->setDebug( $blFull );
             $oEr = $oEx;
        } elseif ( $oEr && ! ( $oEr instanceof oxDisplayErrorInterface ) ) {
            // assuming that a string was given
            $sTmp = $oEr;
            $oEr = oxNew( 'oxDisplayError' );
            $oEr->setMessage( $sTmp );
        } elseif ( $oEr instanceof oxDisplayErrorInterface ) {
            // take the object
        } else {
            $oEr = null;
        }

        if ( $oEr ) {
            $aEx[$sDestination][] = serialize( $oEr );
            oxSession::setVar( 'Errors', $aEx );
        }
    }

    /**
     * Runs long description through smarty
     *
     * @param string $sDesc long description
     * @param string $sOxid current object id
     *
     * @return string long description
     */
    public function parseThroughSmarty( $sDesc, $sOxid )
    {

        $sOxid .= oxLang::getInstance()->getTplLanguage();
        // now parse it through smarty
        $oSmarty = clone $this->getSmarty();

        $oActView = oxNew( 'oxubase' );
        $oActView->addGlobalParams();

        // save old tpl data
        $sTplVars = $oSmarty->_tpl_vars;

        $aViewData = $oActView->getViewData();
        $aActiveViewData = $this->getConfig()->getActiveView()->getViewData();
        foreach ( array_keys( $aViewData ) as $sViewName ) {
            if ( isset( $aActiveViewData[$sViewName] ) ) {
                $oSmarty->assign_by_ref( $sViewName, $aActiveViewData[$sViewName] );
            }
        }

        $oSmarty->oxidcache = new oxField($sDesc, oxField::T_RAW);
        $sRes = $oSmarty->fetch( "ox:$sOxid" );

        // restore tpl vars for continuing smarty processing if it is in one
        $oSmarty->_tpl_vars = $sTplVars;

        return $sRes;
    }

    /**
     * sets properties of smarty object
     *
     * @param object $oSmarty template processor object (smarty)
     *
     * @return null
     */
    protected function _fillCommonSmartyProperties( $oSmarty )
    {
        $myConfig = $this->getConfig();

        $oSmarty->php_handling = SMARTY_PHP_REMOVE;
        $oSmarty->security = $myConfig->isDemoShop()? true : false;

        $oSmarty->left_delimiter  = '[{';
        $oSmarty->right_delimiter = '}]';

        $oSmarty->register_resource( 'ox', array( 'ox_get_template',
                                                  'ox_get_timestamp',
                                                  'ox_get_secure',
                                                  'ox_get_trusted' ) );

        $oSmarty->register_modifier( 'truncate', 'smarty_modifier_oxtruncate' );

        // $myConfig->blTemplateCaching; // DODGER #655 : permanently switched off as it doesnt work good enough
        $oSmarty->caching      = false;
        $oSmarty->compile_dir  = $myConfig->getConfigParam( 'sCompileDir' );
        $oSmarty->cache_dir    = $myConfig->getConfigParam( 'sCompileDir' );
        $oSmarty->template_dir = $myConfig->getTemplateDir( $this->isAdmin() );
        $oSmarty->compile_id   = md5( $oSmarty->template_dir );

        $iDebug = $myConfig->getConfigParam( 'iDebug' );
        if (  $iDebug == 1 || $iDebug == 3 || $iDebug == 4 ) {
            $oSmarty->debugging = true;
        }
    }

    /**
     * sets compile check property to smarty object
     *
     * @param object $oSmarty template processor object (smarty)
     *
     * @return null
     */
    protected function _smartyCompileCheck( $oSmarty )
    {
        $myConfig = $this->getConfig();
        $oSmarty->compile_check  = $myConfig->getConfigParam( 'blCheckTemplates' );

    }
}
