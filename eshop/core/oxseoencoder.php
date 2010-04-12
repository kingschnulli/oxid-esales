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
 * @copyright (C) OXID eSales AG 2003-2010
 * @version OXID eShop CE
 * @version   SVN: $Id: oxseoencoder.php 27026 2010-04-06 07:00:32Z arvydas $
 */

/**
 * Seo encoder base
 *
 * @package core
 */
class oxSeoEncoder extends oxSuperCfg
{
    /**
     * Strings that cannot be used in SEO URLs as this may cause
     * compatability/access problems
     *
     * @var array
     */
    protected static $_aReservedWords = array( 'admin' );

    /**
     * cache for reserved path root node keys
     *
     * @var array
     */
    protected static $_aReservedEntryKeys = null;

    /**
     * SEO separator.
     *
     * @var string
     */
    protected static $_sSeparator = null;

    /**
     * SEO id length.
     *
     * @var integer
     */
    protected $_iIdLength = 255;

    /**
     * SEO prefix.
     *
     * @var string
     */
    protected static $_sPrefix = null;

    /**
     * Added parameters.
     *
     * @var string
     */
    protected $_sAddParams = null;

    /**
     * Singleton instance.
     *
     * @var oxseoencoder
     */
    protected static $_instance = null;

    /**
     * Seo Urls cache
     *
     * @var array
     */
    protected $_aSeoCache = array();

    /**
     * Url fixed state cache
     *
     * @return array
     */
    protected $_aFixedCache = array();

    /**
     * Singleton method
     *
     * @return oxseoencoder
     */
    public static function getInstance()
    {
        if ( defined( 'OXID_PHP_UNIT' ) ) {
            self::$_instance = modInstances::getMod( __CLASS__ );
        }

        if (!self::$_instance) {
            self::$_instance = oxNew("oxSeoEncoder");
            if ( defined( 'OXID_PHP_UNIT' ) ) {
                modInstances::addMod( __CLASS__, self::$_instance);
            }
        }

        if ( defined( 'OXID_PHP_UNIT' ) ) {
            // resetting cache
            self::$_instance->_aSeoCache = array();
        }

        return self::$_instance;

    }

    /**
     * Returns part of url defining active language
     *
     * @param string $sSeoUrl seo url
     * @param int    $iLang   language id
     *
     * @return string
     */
    public function addLanguageParam( $sSeoUrl, $iLang )
    {
        $iLang    = (int) $iLang;
        $iDefLang = (int) $this->getConfig()->getConfigParam( 'iDefSeoLang' );
        $aLangIds = oxLang::getInstance()->getLanguageIds();

        if ( $iLang != $iDefLang && isset( $aLangIds[$iLang] ) && getStr()->strpos( $sSeoUrl, $aLangIds[$iLang] . '/' ) !== 0 ) {
            $sSeoUrl = $aLangIds[$iLang] . '/'.$sSeoUrl;
        }

        return $sSeoUrl;
    }

    /**
     * Processes seo url before saving to db:
     *  - oxseoencoder::addLanguageParam();
     *  - oxseoencoder::_getUniqueSeoUrl().
     *
     * @param string $sSeoUrl   seo url to process
     * @param string $sObjectId seo object id [optional]
     * @param int    $iLang     active language id [optional]
     * @param bool   $blExclude exclude language prefix while building seo url
     *
     * @return string
     */
    protected function _processSeoUrl( $sSeoUrl, $sObjectId = null, $iLang = null, $blExclude = false )
    {
        return $this->_getUniqueSeoUrl( $blExclude ? $sSeoUrl : $this->addLanguageParam( $sSeoUrl, $iLang ), $sObjectId, $iLang );
    }

    /**
     * Resets seo cache (use in case you need forced reset)
     *
     * @return null
     */
    public function resetCache()
    {
        $this->_aSeoCache = array();
    }

    /**
     * SEO encoder constructor
     */
    public function __construct()
    {
        $myConfig = $this->getConfig();
        if (!self::$_sSeparator) {
            $this->setSeparator( $myConfig->getConfigParam( 'sSEOSeparator' ) );
        }
        if (!self::$_sPrefix) {
            $this->setPrefix( $myConfig->getConfigParam( 'sSEOuprefix' ) );
        }
        $this->setReservedWords( $myConfig->getConfigParam( 'aSEOReservedWords' ) );
    }

    /**
     * Moves current seo record to seo history table
     *
     * @param string $sId     object id
     * @param int    $iShopId active shop id
     * @param int    $iLang   object language
     * @param string $sType   object type (if you pass real object - type is not necessary)
     * @param string $sNewId  new object id, mostly used for static url updates (optional)
     *
     * @return null
     */
    protected function _copyToHistory( $sId, $iShopId, $iLang, $sType = null, $sNewId = null )
    {
        $oDb = oxDb::getDb();
        $sObjectid = $sNewId?$oDb->quote( $sNewId ):'oxobjectid';
        $sType     = $sType?"oxtype =".$oDb->quote( $sType )." and":'';
        $iLang     = (int) $iLang;

        // moving
        $sSub = "select $sObjectid, MD5( LOWER( oxseourl ) ), oxshopid, oxlang, now() from oxseo
                 where {$sType} oxobjectid = ".$oDb->quote( $sId )." and oxshopid = ".$oDb->quote( $iShopId )." and
                 oxlang = {$iLang} limit 1";
        $sQ   = "replace oxseohistory ( oxobjectid, oxident, oxshopid, oxlang, oxinsert ) {$sSub}";
        $oDb->execute( $sQ );
    }

    /**
     * Returns string for SEO url with specific parameters (language,
     * currency and active shop)
     *
     * @deprecated use oxUtilsUrl::getAddUrlParams()
     *
     * @return string
     */
    protected function _getAddParams()
    {
        // performance
        if ( $this->_sAddParams === null ) {
            $this->_sAddParams = $this->_getAddParamsFnc( oxConfig::getParameter('currency'), $this->getConfig()->getShopId() );
        }
        return $this->_sAddParams;
    }

    /**
     * Returns string for SEO url with specific parameters (language,
     * currency and active shop)
     *
     * @param integer $iCur     shop currency
     * @param mixed   $iActShop active shop id
     *
     * @deprecated use oxUtilsUrl::getAddUrlParams()
     *
     * @return string
     */
    protected function _getAddParamsFnc( $iCur, $iActShop )
    {
        $sParams = '';
        if ( count( $aParams = oxUtilsUrl::getInstance()->getAddUrlParams() ) ) {
            foreach ( $aParams as $sName => $sValue ) {
                if ( $sValue ) {
                    if ( $sParams ) {
                        $sParams .= "&amp;";
                    }
                    $sParams .= $sName . "=" . $sValue;
                }
            }
            if ( $sParams ) {
                $sParams = '?'.$sParams;
            }
        }
        return $sParams;
    }

    /**
     * Generates dynamic url object id (calls oxseoencoder::_getStaticObjectId)
     *
     * @param int    $iShopId shop id
     * @param string $sStdUrl standard (dynamic) url
     *
     * @deprecated user oxseoencoder::getDynamicObjectId() instead
     *
     * @return string
     */
    protected function _getDynamicObjectId( $iShopId, $sStdUrl )
    {
        return $this->getDynamicObjectId( $iShopId, $sStdUrl );
    }

    /**
     * Generates dynamic url object id (calls oxseoencoder::_getStaticObjectId)
     *
     * @param int    $iShopId shop id
     * @param string $sStdUrl standard (dynamic) url
     *
     * @return string
     */
    public function getDynamicObjectId( $iShopId, $sStdUrl )
    {
        return $this->_getStaticObjectId( $iShopId, $sStdUrl );
    }

    /**
     * Returns dynamic object SEO URI
     *
     * @param string $sStdUrl standart url
     * @param string $sSeoUrl seo uri
     * @param int    $iLang   active language
     *
     * @return string
     */
    protected function _getDynamicUri( $sStdUrl, $sSeoUrl, $iLang )
    {
        $iShopId = $this->getConfig()->getShopId();

        $sStdUrl   = $this->_trimUrl( $sStdUrl );
        $sObjectId = $this->getDynamicObjectId( $iShopId, $sStdUrl );
        $sSeoUrl   = $this->_prepareUri( $sSeoUrl );

        //load details link from DB
        $sOldSeoUrl = $this->_loadFromDb( 'dynamic', $sObjectId, $iLang );
        if ( $sOldSeoUrl === $sSeoUrl ) {
            $sSeoUrl = $sOldSeoUrl;
        } else {

            if ( $sOldSeoUrl ) {
                // old must be transferred to history
                $this->_copyToHistory( $sObjectId, $iShopId, $iLang, 'dynamic' );
            }

            // creating unique
            $sSeoUrl = $this->_processSeoUrl( $sSeoUrl, $sObjectId, $iLang );

            // inserting
            $this->_saveToDb( 'dynamic', $sObjectId, $sStdUrl, $sSeoUrl, $iLang, $iShopId );
        }

        return $sSeoUrl;
    }

    /**
     * Returns SEO url with shop's path + additional params ( oxseoencoder:: _getAddParams)
     *
     * @param string $sSeoUrl seo URL
     * @param int    $iLang   active language (deprecated - does nothing)
     * @param bool   $blSsl   forces to build ssl url
     *
     * @return string
     */
    protected function _getFullUrl( $sSeoUrl, $iLang = null, $blSsl = false )
    {
        $sFullUrl = ( $blSsl ? $this->getConfig()->getSslShopUrl( $iLang ) : $this->getConfig()->getShopUrl( $iLang ) ) . $sSeoUrl;
        return oxUtilsUrl::getInstance()->processSeoUrl( $sFullUrl );
    }

    /**
     * _getSeoIdent returns seo ident for db search
     *
     * @param string $sSeoUrl seo url
     * @param int    $iLang   active language (deprecated - does nothing)
     *
     * @access protected
     *
     * @return string
     */
    protected function _getSeoIdent( $sSeoUrl, $iLang = null )
    {
        return md5( strtolower( $sSeoUrl ) );
    }

    /**
     * Returns SEO static uri
     *
     * @param string $sStdUrl standard page url
     * @param int    $iShopId active shop id
     * @param int    $iLang   active language
     *
     * @return string
     */
    protected function _getStaticUri( $sStdUrl, $iShopId, $iLang )
    {
        $sStdUrl = $this->_trimUrl( $sStdUrl, $iLang );
        return $this->_loadFromDb( 'static', $this->_getStaticObjectId( $iShopId, $sStdUrl ), $iLang );
    }

    /**
     * Returns target "extension"
     *
     * @return null
     */
    protected function _getUrlExtension()
    {
        return;
    }

    /**
     * _getUniqueSeoUrl returns possibly modified url
     * for not to be same as already existing in db
     *
     * @param string $sSeoUrl     seo url
     * @param string $sObjectId   current object id, used to skip self in query
     * @param int    $iObjectLang object language id
     *
     * @access protected
     *
     * @return string
     */
    protected function _getUniqueSeoUrl( $sSeoUrl, $sObjectId = null, $iObjectLang = null )
    {
        $oStr = getStr();
        $sConstEnd = $this->_getUrlExtension();
        if ($sConstEnd === null) {
            $aMatched = array();
            if ( preg_match('/\.html?$/i', $sSeoUrl, $aMatched ) ) {
                $sConstEnd = $aMatched[0];
            } else {
                if ($sSeoUrl{$oStr->strlen($sSeoUrl)-1} != '/') {
                    $sSeoUrl .= '/';
                }
                $sConstEnd = '/';
            }
        }

        // fix for not having url, which executes through /other/ script then seo decoder
        $sAdd = ' ';
        if ('/' != self::$_sSeparator) {
            $sAdd = self::$_sSeparator . self::$_sPrefix;
        } else {
            $sAdd = '_' . self::$_sPrefix;
        }
        $sSeoUrl = preg_replace( "#^(/*)(".implode('|', $this->_getReservedEntryKeys()).")/#i", "\$1\$2$sAdd/", $sSeoUrl );

        $sBaseSeoUrl = $sSeoUrl;
        if ( $sConstEnd && $oStr->substr( $sSeoUrl, 0 - $oStr->strlen( $sConstEnd ) ) == $sConstEnd ) {
            $sBaseSeoUrl = $oStr->substr( $sSeoUrl, 0, $oStr->strlen( $sSeoUrl ) - $oStr->strlen( $sConstEnd ) );
        }

        $oDb = oxDb::getDb();
        $iShopId = $this->getConfig()->getShopId();
        $iCnt = 0;
        $sCheckSeoUrl = $this->_trimUrl( $sSeoUrl );
        $sQ = "select 1 from oxseo where oxshopid = '{$iShopId}'";

        // skipping self
        if ( $sObjectId && isset($iObjectLang) ) {
            $iObjectLang = (int) $iObjectLang;
            $sQ .= " and not (oxobjectid = " . $oDb->quote( $sObjectId ) . " and oxlang = $iObjectLang)";
        }

        while ( $oDb->getOne( $sQ ." and oxident= " . $oDb->quote( $this->_getSeoIdent( $sCheckSeoUrl ) ) ) ) {
            $sAdd = '';
            if ( self::$_sPrefix ) {
                $sAdd = self::$_sSeparator . self::$_sPrefix;
            }
            if ( $iCnt ) {
                $sAdd .= self::$_sSeparator . $iCnt;
            }
            ++$iCnt;

            $sSeoUrl = $sBaseSeoUrl . $sAdd . $sConstEnd;
            $sCheckSeoUrl = $this->_trimUrl( $sSeoUrl );
        }
        return $sSeoUrl;
    }

    /**
     * check if seo url exist and is fixed
     *
     * @param string $sType               object type
     * @param string $sId                 object identifier
     * @param int    $iLang               active language id
     * @param mixed  $iShopId             active shop id
     * @param string $sParams             additional seo params. optional (mostly used for db indexing)
     * @param bool   $blStrictParamsCheck strict parameters check
     *
     * @access protected
     *
     * @return bool
     */
    protected function _isFixed( $sType, $sId, $iLang, $iShopId = null, $sParams = null, $blStrictParamsCheck = true)
    {
        if ( $iShopId === null ) {
            $iShopId = $this->getConfig()->getShopId();
        }
        $iLang = (int) $iLang;

        if ( !isset( $this->_aFixedCache[$sType][$sShopId][$sId][$iLang] ) ) {
            $oDb = oxDb::getDb( true );

            $sQ = "select oxfixed from oxseo where oxtype = ".$oDb->quote( $sType )."
                   and oxobjectid = ".$oDb->quote( $sId ) ." and oxshopid = ".$oDb->quote( $iShopId )." and oxlang = '{$iLang}'";

            $sParams = $sParams ? $oDb->quote( $sParams ) : "''";
            if ( $sParams && $blStrictParamsCheck ) {
                $sQ .= " and oxparams = {$sParams}";
            } else {
                $sQ .= " order by oxparams = {$sParams} desc";
            }
            $sQ .= " limit 1";

            $this->_aFixedCache[$sType][$sShopId][$sId][$iLang] = (bool) $oDb->getOne( $sQ );
        }
        return $this->_aFixedCache[$sType][$sShopId][$sId][$iLang];
    }

    /**
     * _loadFromDb loads data from oxseo table if exists
     * returns oxseo url
     *
     * @param string $sType               object type
     * @param string $sId                 object identifier
     * @param int    $iLang               active language id
     * @param mixed  $iShopId             active shop id
     * @param string $sParams             additional seo params. optional (mostly used for db indexing)
     * @param bool   $blStrictParamsCheck strict parameters check
     *
     * @access protected
     *
     * @return string || false
     */
    protected function _loadFromDb( $sType, $sId, $iLang, $iShopId = null, $sParams = null, $blStrictParamsCheck = true)
    {
        $oDb = oxDb::getDb( true );
        if ( $iShopId === null ) {
            $iShopId = $this->getConfig()->getShopId();
        }

        $iLang = (int) $iLang;

        $sQ = "select oxfixed, oxseourl, oxexpired, oxtype from oxseo where oxtype = ".$oDb->quote( $sType )."
               and oxobjectid = ".$oDb->quote( $sId ) ." and oxshopid = ".$oDb->quote( $iShopId )." and oxlang = '{$iLang}'";

        $sParams = $sParams ? $sParams : '';
        if ( $sParams && $blStrictParamsCheck ) {
            $sQ .= " and oxparams = '{$sParams}'";
        } else {
            $sQ .= " order by oxparams = '{$sParams}' desc";
        }
        $sQ .= " limit 1";

        // caching to avoid same queries..
        $sIdent = md5($sQ);
        if ( isset( $this->_aSeoCache[$sIdent] ) ) {
            return $this->_aSeoCache[$sIdent];
        }

        $sSeoUrl = false;
        $oRs = $oDb->execute( $sQ );
        if ( $oRs && $oRs->recordCount() > 0 && !$oRs->EOF ) {
            // moving expired static urls to history ..
            if ( $oRs->fields['oxexpired'] && ( $oRs->fields['oxtype'] == 'static' || $oRs->fields['oxtype'] == 'dynamic' ) ) {
                // if expired - copying to history, marking as not expired
                $this->_copyToHistory( $sId, $iShopId, $iLang );
                $oDb->execute( "update oxseo set oxexpired = 0 where oxobjectid = ".$oDb->quote( $sId )." and oxlang = '{$iLang}'" );
                $sSeoUrl = $oRs->fields['oxseourl'];
            } elseif ( !$oRs->fields['oxexpired'] || $oRs->fields['oxfixed'] ) {
                // if seo url is available and is valid
                $sSeoUrl = $oRs->fields['oxseourl'];
            }

            // store cache
            $this->_aSeoCache[$sIdent] = $sSeoUrl;
        }
        return $sSeoUrl;
    }

    /**
     * cached getter: check root directory php file names for them not to be in 1st part of seo url
     * because then apache will execute that php file instead of url parser
     *
     * @return array
     */
    protected function _getReservedEntryKeys()
    {
        if (!isset(self::$_aReservedEntryKeys) && !is_array(self::$_aReservedEntryKeys)) {
            $sDir = getShopBasePath();
            self::$_aReservedEntryKeys = array();
            foreach (glob("$sDir/*") as $file) {
                if (preg_match('/^(.+)\.php[0-9]*$/i', basename($file), $m)) {
                    self::$_aReservedEntryKeys[] = $m[0];
                    self::$_aReservedEntryKeys[] = $m[1];
                } elseif (is_dir($file)) {
                    self::$_aReservedEntryKeys[] = basename($file);
                }
            }
        }
        return self::$_aReservedEntryKeys;
    }

    /**
     * Makes safe seo uri - removes unsupported/reserved characters
     *
     * @param string $sUri seo uri
     *
     * @return string
     */
    protected function _prepareUri( $sUri )
    {
        // decoding entities
        $sUri = $this->encodeString( $sUri );

        // basic string preparation
        $sUri = strip_tags( $sUri );

        $sSeparator = self::$_sSeparator;
        $sPrefix    = self::$_sPrefix;
        // 'fixing' reserved words
        foreach ( self::$_aReservedWords as $sWord ) {
            // this probably possible to do in one regexp
            $sUri = preg_replace( array( "/(\s$sWord)$/i", "/^($sWord\s)/i", "/(\s$sWord\s)/i", "/^($sWord)$/i",
                                         "/(\/$sWord)$/i", "/^($sWord\/)/i", "/(\/$sWord\/)/i"),
                                         " \$1{$sSeparator}{$sPrefix}{$sSeparator} ", $sUri );
        }

        // if found ".html" at the end - removing it temporary
        $sExt = '';
        $oStr = getStr();
        $aMatched = array();
        if ( preg_match( '/\.html?$/i', $sUri, $aMatched ) ) {
            $sExt   = $oStr->substr( $sUri, 0 - $oStr->strlen( $aMatched[0] ) );
            $sUri = $oStr->substr( $sUri, 0, $oStr->strlen( $sUri ) - $oStr->strlen( $aMatched[0] ) );
        }

        // removing any special characters
        $sRegExp = '/[^A-Za-z0-9'.preg_quote( self::$_sSeparator, '/').preg_quote( self::$_sPrefix, '/').'\/]+/';
        $sUri  = trim( $oStr->preg_replace( array( "/\W*\/\W*/", $sRegExp ), array( "/", self::$_sSeparator ), $sUri ), self::$_sSeparator );

        // SEO id is empty ?
        if ( !$sUri ) {
            $sUri = $this->_prepareUri( self::$_sPrefix );
        }

        // binding ".html" back
        $sUri .= $sExt;

        // cleaning
        return $oStr->preg_replace( array( '|//+|', '/' . preg_quote( self::$_sSeparator . self::$_sSeparator, '/' ) .'+/' ),
                             array( '/', self::$_sSeparator ), $sUri );
    }

    /**
     * Prepares and returns formatted object SEO id
     *
     * @param string $sTitle         Original object title
     * @param bool   $blSkipTruncate Truncate title into defined lenght or not
     *
     * @return string
     */
    protected function _prepareTitle( $sTitle, $blSkipTruncate = false )
    {
        $sTitle = $this->_prepareUri( str_replace( "/", self::$_sSeparator, $sTitle ) );

        $oStr = getStr();
        // smart truncate
        if ( !$blSkipTruncate && $oStr->strlen( $sTitle ) > $this->_iIdLength ) {
            if ( ( $iFirstSpace = $oStr->strstr( $oStr->substr( $sTitle, $this->_iIdLength ), self::$_sSeparator ) !== false ) ) {
                $sTitle = trim( $oStr->substr( $sTitle, 0, $this->_iIdLength + $iFirstSpace ), self::$_sSeparator );
            }
        }

        // cleaning
        return $sTitle;
    }


    /**
     * _saveToDb saves values to seo table
     *
     * @param string $sType        url type (static, dynamic, oxarticle etc)
     * @param string $sObjectId    object identifier
     * @param string $sStdUrl      standard url
     * @param string $sSeoUrl      seo url
     * @param int    $iLang        active object language
     * @param mixed  $iShopId      active object shop id
     * @param bool   $blFixed      seo entry marker. if true, entry should not be automatically changed
     * @param string $sKeywords    object keywords
     * @param string $sDescription object description
     * @param string $sParams      additional seo params. optional (mostly used for db indexing)
     *
     * @access protected
     *
     * @return void
     */
    protected function _saveToDb( $sType, $sObjectId, $sStdUrl, $sSeoUrl, $iLang, $iShopId = null, $blFixed = null, $sKeywords = false, $sDescription = false, $sParams = null )
    {
        $oDb = oxDb::getDb( true );
        if ( $iShopId === null ) {
            $iShopId = $this->getConfig()->getShopId();
        }

        $iLang = (int) $iLang;

        $sStdUrl = $this->_trimUrl( $sStdUrl );
        $sSeoUrl = $this->_trimUrl( $sSeoUrl );
        $sIdent  = $this->_getSeoIdent( $sSeoUrl );

        // transferring old url, thus current url will be regenerated
        $sQ  = "select oxfixed, oxexpired, ( oxstdurl like ".$oDb->quote( $sStdUrl )." ) as samestdurl,
                oxseourl like ".$oDb->quote( $sSeoUrl )." as sameseourl from oxseo where oxtype = ".$oDb->quote( $sType )." and
                oxobjectid = ".$oDb->quote( $sObjectId )." and oxshopid = ".$oDb->quote( $iShopId )."  and oxlang = {$iLang} ";

        $sQ .= $sParams ? " and oxparams = " . $oDb->quote( $sParams ) : '';
        $sQ .= ( $sKeywords !== false ) ? " and oxkeywords = " . $oDb->quote( $sKeywords ) . " " : '';
        $sQ .= ( $sDescription !== false ) ? " and oxdescription = " . $oDb->quote( $sDescription ) . " " : '';
        //$sQ .= isset( $blFixed ) ? " and oxfixed = " . ( (int) $blFixed ) . " " : '';
        $sQ .= "limit 1";

        $oRs = $oDb->execute( $sQ );
        if ( $oRs && $oRs->recordCount() > 0 && !$oRs->EOF ) {
            if ( $oRs->fields['samestdurl'] && $oRs->fields['sameseourl'] && $oRs->fields['oxexpired'] ) {
                // fixed state change
                $sFixed = isset( $blFixed ) ? ", oxfixed = " . ( (int) $blFixed ) . " " : '';
                // nothing was changed - setting expired status back to 0
                $sSql  = "update oxseo set oxexpired = 0 {$sFixed} where oxtype = ".$oDb->quote( $sType )." and
                          oxobjectid = ".$oDb->quote( $sObjectId )." and oxshopid = ".$oDb->quote( $iShopId ) ." and oxlang = {$iLang} ";
                $sSql .= $sParams ? " and oxparams = " . $oDb->quote( $sParams ) : '';
                $sSql .= " limit 1";

                return $oDb->execute( $sSql );
            } elseif ( $oRs->fields['oxexpired'] ) {
                // copy to history
                $this->_copyToHistory( $sObjectId, $iShopId, $iLang, $sType );
            }
        }
        $oStr = getStr();
        if ( $sKeywords !== false ) {
            $sKeywords = $oDb->quote( $oStr->htmlspecialchars( $this->encodeString( strip_tags( $sKeywords ), false ) ) );
        }

        if ( $sDescription !== false ) {
            $sDescription = $oDb->quote( $oStr->htmlspecialchars( strip_tags( $sDescription ) ) );
        }

        // inserting new or updating
        $sParams = $sParams ? $oDb->quote( $sParams ) :'""';
        $blFixed = (int) $blFixed;

        $sQ  = "insert into oxseo
                    (oxobjectid, oxident, oxshopid, oxlang, oxstdurl, oxseourl, oxtype, oxfixed, oxexpired, oxkeywords, oxdescription, oxparams)
                values
                    ( ".$oDb->quote( $sObjectId ).", ".$oDb->quote( $sIdent ).", ".$oDb->quote( $iShopId ).", {$iLang}, ".$oDb->quote( $sStdUrl ).", ".$oDb->quote( $sSeoUrl ).", ".$oDb->quote( $sType ).", '$blFixed', '0',
                    ".( $sKeywords ? $sKeywords : "''" ).", ".( $sDescription ? $sDescription : "''" ).", $sParams )
                on duplicate key update oxident = ".$oDb->quote( $sIdent ).", oxstdurl = ".$oDb->quote( $sStdUrl ).", oxseourl = ".$oDb->quote( $sSeoUrl ).", oxfixed = '$blFixed', oxexpired = '0',
                    oxkeywords = ".( $sKeywords ? $sKeywords : "oxkeywords" ).", oxdescription = ".( $sDescription ? $sDescription : "oxdescription" );

        return $oDb->execute( $sQ );
    }

    /**
     * Removes shop path part and session id from given url
     *
     * @param string $sUrl  url to clean bad chars
     * @param int    $iLang active language (deprecated - does nothing)
     *
     * @access protected
     *
     * @return string
     */
    protected function _trimUrl( $sUrl, $iLang = null )
    {
        $myConfig = $this->getConfig();
        $sUrl = str_replace( array( $myConfig->getShopUrl( $iLang ), $myConfig->getSslShopUrl( $iLang ) ), '', $sUrl );
        $sUrl = preg_replace( '/(\?|&(amp;)?)(force_)?(admin_)?sid=[a-z0-9\.]+&?(amp;)?/i', '\1', $sUrl );
        $sUrl = preg_replace( '/(\?|&(amp;)?)shp=[0-9]+&?(amp;)?/i', '\1', $sUrl );
        $sUrl = preg_replace( '/(\?|&(amp;)?)lang=[0-9]+&?(amp;)?/i', '\1', $sUrl );
        $sUrl = preg_replace( '/(\?|&(amp;)?)&(amp;)?/i', '\1', $sUrl );
        return $sUrl;
    }

    /**
     * Replaces special chars in text
     *
     * @param string $sString        string to encode
     * @param bool   $blReplaceChars is true, replaces user defined (oxconfig::aSeoReplaceChars) characters into alternative
     *
     * @return string
     */
    public function encodeString( $sString, $blReplaceChars = true )
    {
        // decoding entities
        $sString = getStr()->html_entity_decode( $sString );

        if ( $blReplaceChars ) {
            $aReplaceChars = $this->getConfig()->getConfigParam( 'aSeoReplaceChars' );
            $sString = str_replace( array_keys( $aReplaceChars ), array_values( $aReplaceChars ), $sString );
        }

        // special chars
        $aReplaceWhat = array( '&amp;', '&quot;', '&#039;', '&lt;', '&gt;' );
        return str_replace( $aReplaceWhat, '', $sString );
    }

    /**
     * Sets SEO separator
     *
     * @param string $sSeparator SEO seperator
     *
     * @return null
     */
    public function setSeparator( $sSeparator = null )
    {
        self::$_sSeparator = $sSeparator;
        if ( !self::$_sSeparator ) {
            self::$_sSeparator = '-';
        }
    }

    /**
     * Sets SEO prefix
     *
     * @param string $sPrefix SEO prefix
     *
     * @return null
     */
    public function setPrefix( $sPrefix )
    {
        if ($sPrefix) {
            self::$_sPrefix = $sPrefix;
        } else {
            self::$_sPrefix = 'oxid';
        }
    }

    /**
     * sets seo id length
     *
     * @param string $iIdlength id length
     *
     * @return null
     */
    public function setIdLength( $iIdlength = null )
    {
        if ( isset( $iIdlength ) ) {
            $this->_iIdLength = $iIdlength;
        }
    }

    /**
     * Sets array of words which must be checked before building seo url
     *
     * @param array $aReservedWords reserved words
     *
     * @return null
     */
    public function setReservedWords( $aReservedWords )
    {
        self::$_aReservedWords = array_merge( self::$_aReservedWords, $aReservedWords );
    }


    /**
     * Marks object seo records as expired
     *
     * @param string $sId      changed object id. If null is passed, object dependency is not checked
     * @param int    $iShopId  active shop id. Shop id must be passed uf you want to do shop level update (default null)
     * @param int    $iExpStat expiration status: 1 - standard expiration
     * @param int    $iLang    active language (optiona;)
     * @param string $sParams  additional params
     *
     * @return null
     */
    public function markAsExpired( $sId, $iShopId = null, $iExpStat = 1, $iLang = null, $sParams = null )
    {
        $oDb = oxDb::getDb();
        $sWhere  = $sId ? "where oxobjectid =  " . $oDb->quote( $sId ) : '';
        $sWhere .= isset( $iShopId ) ? ( $sWhere ? " and oxshopid = ". $oDb->quote( $iShopId ) : "where oxshopid = ". $oDb->quote( $iShopId ) ) : '';
        $sWhere .= $iLang ? ( $sWhere ? " and oxlang = '{$iLang}'" : "where oxlang = '{$iLang}'" ) : '';
        $sWhere .= $sParams ? ( $sWhere ? " and {$sParams}" : "where {$sParams}" ) : '';

        $sQ = "update oxseo set oxexpired =  " . $oDb->quote( $iExpStat ) . " $sWhere ";
        $oDb->execute( $sQ );
    }

    /**
     * Loads if exists or prepares and saves new seo url for passed object
     *
     * @param oxbase $oObject object to prepare seo data
     * @param string $sType   type of object (oxvendor/oxcategory)
     * @param string $sStdUrl stanradr url
     * @param string $sSeoUrl seo uri
     * @param string $sParams additional params, liek page number etc. mostly used by mysql for indexes
     * @param int    $iLang   language
     * @param bool   $blFixed fixed url marker (default is false)
     *
     * @return string
     */
    protected function _getPageUri( $oObject, $sType, $sStdUrl, $sSeoUrl, $sParams, $iLang = null, $blFixed = false )
    {
        if ( !isset( $iLang ) ) {
            $iLang = $oObject->getLanguage();
        }
        $iShopId = $this->getConfig()->getShopId();

        //load page link from DB
        $sOldSeoUrl = $this->_loadFromDb( $sType, $oObject->getId(), $iLang, $iShopId, $sParams );
        if ( !$sOldSeoUrl ) {
            // generating new..
            $sSeoUrl = $this->_processSeoUrl( $sSeoUrl, $oObject->getId(), $iLang );
            $this->_saveToDb( $sType, $oObject->getId(), $sStdUrl, $sSeoUrl, $iLang, $iShopId, (int) $blFixed, false, false, $sParams );
        } else {
            // using old
            $sSeoUrl = $sOldSeoUrl;
        }
        return $sSeoUrl;
    }

    /**
     * Generates static url object id
     *
     * @param int    $iShopId shop id
     * @param string $sStdUrl standard (dynamic) url
     *
     * @return string
     */
    protected function _getStaticObjectId( $iShopId, $sStdUrl )
    {
        return md5( strtolower ( $iShopId . $this->_trimUrl( $sStdUrl ) ) );
    }

    /**
     * Static url encoder
     *
     * @param array $aStaticUrl static url info (contains standard URL and urls for each language)
     * @param int   $iShopId    active shop id
     * @param int   $iLang      active language
     *
     * @return null
     */
    public function encodeStaticUrls( $aStaticUrl, $iShopId, $iLang )
    {
        $oDb = oxDb::getDb();
        $sValues = '';
        $sOldObjectId = null;

        // standard url
        $sStdUrl = $this->_trimUrl( trim( $aStaticUrl['oxseo__oxstdurl'] ) );
        $sObjectId = $aStaticUrl['oxseo__oxobjectid'];

        if ( !$sObjectId || $sObjectId == '-1' ) {
            $sObjectId = $this->_getStaticObjectId( $iShopId, $sStdUrl );
        } else {
            // marking entry as needs to move to history
            $sOldObjectId = $sObjectId;

            // if std url does not match old
            if ( $this->_getStaticObjectId( $iShopId, $sStdUrl ) != $sObjectId ) {
                $sObjectId = $this->_getStaticObjectId( $iShopId, $sStdUrl );
            }
        }

        foreach ( $aStaticUrl['oxseo__oxseourl'] as $iLang => $sSeoUrl ) {

            $iLang = (int) $iLang;

            // generating seo url
            if ( ( $sSeoUrl = trim( $sSeoUrl ) ) ) {
                $sSeoUrl = $this->_prepareUri( $this->_trimUrl( $sSeoUrl ) );
                $sSeoUrl = $this->_processSeoUrl( $sSeoUrl, $sObjectId, $iLang );
            }


            if ( $sOldObjectId ) {
                // move changed records to history
                if ( !$oDb->getOne( "select (" . $oDb->quote( $sSeoUrl ) . " like oxseourl) & (" . $oDb->quote( $sStdUrl ) . " like oxstdurl) from oxseo where oxobjectid = ".$oDb->quote( $sOldObjectId )." and oxshopid = '{$iShopId}' and oxlang = '{$iLang}' " ) ) {
                    $this->_copyToHistory( $sOldObjectId, $iShopId, $iLang, 'static', $sObjectId );
                }
            }

            if ( !$sSeoUrl || !$sStdUrl ) {
                continue;
            }

            $sIdent = $this->_getSeoIdent( $sSeoUrl );

            if ( $sValues ) {
                $sValues .= ', ';
            }

            $sValues .= "( " . $oDb->quote( $sObjectId ) . ", " . $oDb->quote( $sIdent ) . ", " . $oDb->quote( $iShopId ).", '{$iLang}', " . $oDb->quote( $sStdUrl ) . ", " . $oDb->quote( $sSeoUrl ) . ", 'static' )";
        }

        // must delete old before insert/update
        if ( $sOldObjectId ) {
            $oDb->execute( "delete from oxseo where oxobjectid in ( " . $oDb->quote( $sOldObjectId ) . ", " . $oDb->quote( $sObjectId ) . " )" );
        }

        // (re)inserting
        if ( $sValues ) {

            $sQ = "insert into oxseo ( oxobjectid, oxident, oxshopid, oxlang, oxstdurl, oxseourl, oxtype ) values {$sValues} ";
            $oDb->execute( $sQ );
        }

        return $sObjectId;
    }

    /**
     * Method copies static urls from base shop to newly created
     *
     * @param int $iShopId new created shop id
     *
     * @return null
     */
    public function copyStaticUrls( $iShopId )
    {
        $iBaseShopId = $this->getConfig()->getBaseShopId();
        if ( $iShopId != $iBaseShopId ) {
            $oDb = oxDb::getDb();
            foreach (array_keys(oxLang::getInstance()->getLanguageIds()) as $iLang) {
                $sQ = "insert into oxseo ( oxobjectid, oxident, oxshopid, oxlang, oxstdurl, oxseourl, oxtype )
                       select MD5( LOWER( CONCAT( " . $oDb->quote( $iShopId ) . ", oxstdurl ) ) ), MD5( LOWER( oxseourl ) ),
                       " . $oDb->quote( $iShopId ) . ", oxlang, oxstdurl, oxseourl, oxtype from oxseo where oxshopid = '{$iBaseShopId}' and oxtype = 'static' and oxlang='$iLang' ";
                $oDb->execute( $sQ );
            }
        }
    }

    /**
     * Returns static url for passed standard link (if available)
     *
     * @param string $sStdUrl standard Url
     * @param int    $iLang   active language (optional). default null
     * @param int    $iShopId active shop id (optional). default null
     *
     * @return string
     */
    public function getStaticUrl( $sStdUrl, $iLang = null, $iShopId = null )
    {
        if (!isset($iShopId)) {
            $iShopId = $this->getConfig()->getShopId();
        }
        if (!isset($iLang)) {
            $iLang   = oxLang::getInstance()->getEditLanguage();
        }

        $sFullUrl = '';
        if ( ( $sSeoUrl = $this->_getStaticUri( $sStdUrl, $iShopId, $iLang ) ) ) {
            $sFullUrl = $this->_getFullUrl( $sSeoUrl, $iLang, strpos( $sStdUrl, "https:" ) === 0 );
        }
        return $sFullUrl;
    }

    /**
     * Adds new seo entry to db
     *
     * @param string $sObjectId    objects id
     * @param int    $iShopId      shop id
     * @param int    $iLang        objects language
     * @param string $sStdUrl      default url
     * @param string $sSeoUrl      seo url
     * @param string $sType        object type
     * @param bool   $blFixed      marker to keep seo config unchangeable
     * @param string $sKeywords    seo keywords
     * @param string $sDescription seo description
     * @param string $sParams      additional seo params. optional (mostly used for db indexing)
     * @param bool   $blExclude    exclude language prefix while building seo url
     *
     * @return null
     */
    public function addSeoEntry( $sObjectId, $iShopId, $iLang, $sStdUrl, $sSeoUrl, $sType, $blFixed = 1, $sKeywords = '', $sDescription = '', $sParams = '', $blExclude = false )
    {
        $sSeoUrl = $this->_processSeoUrl( $this->_prepareUri( $this->_trimUrl( $sSeoUrl ) ), $sObjectId, $iLang, $blExclude );
        $this->_saveToDb( $sType, $sObjectId, $sStdUrl, $sSeoUrl, $iLang, $iShopId, $blFixed, $sKeywords, $sDescription, $sParams );
    }

    /**
     * Removes seo entry from db
     *
     * @param string $sObjectId objects id
     * @param int    $iShopId   shop id
     * @param int    $iLang     objects language
     * @param string $sType     object type
     *
     * @return null
     */
    public function deleteSeoEntry( $sObjectId, $iShopId, $iLang, $sType )
    {
        $oDb = oxDb::getDb();
        $sQ = "delete from oxseo where oxobjectid = " . $oDb->quote( $sObjectId ) . " and oxshopid = " . $oDb->quote( $iShopId ) . " and oxlang = " . $oDb->quote( $iLang ) . " and oxtype = " . $oDb->quote( $sType ) . " ";
        oxDb::getDb()->execute( $sQ );
    }

    /**
     * Returns meta information for preferred object
     *
     * @param string $sObjectId information object id
     * @param string $sMetaType metadata type - "oxkeywords", "oxdescription"
     * @param int    $iShopId   active shop id [optional]
     * @param int    $iLang     active language [optional]
     * @param string $sParams   parameters to filter data (like category id etc) [optional]
     *
     * @return string
     */
    public function getMetaData( $sObjectId, $sMetaType, $iShopId = null, $iLang = null, $sParams = null )
    {
        $oDb = oxDb::getDb();

        $iShopId = ( !isset( $iShopId ) ) ? $this->getConfig()->getShopId():$iShopId;
        $iLang   = ( !isset( $iLang ) ) ? oxLang::getInstance()->getObjectTplLanguage():((int) $iLang);
        $sParams = ( !isset( $sParams ) ) ? "order by oxparams" : "and oxparams=".$oDb->quote( $sParams );

        return $oDb->getOne( "select {$sMetaType} from oxseo where oxobjectid = " . $oDb->quote( $sObjectId ) . " and oxshopid = " . $oDb->quote( $iShopId )." and oxlang = '{$iLang}' {$sParams}" );
    }

    /**
     * getDynamicUrl acts similar to static urls,
     * except, that dynamic url are not shown in admin
     * and they can be reencoded by providing new seo url
     *
     * @param string $sStdUrl standard url
     * @param string $sSeoUrl part of URL query which will be attached to standard shop url
     * @param int    $iLang   active language
     *
     * @access public
     *
     * @return string
     */
    public function getDynamicUrl( $sStdUrl, $sSeoUrl, $iLang )
    {
        return $this->_getFullUrl( $this->_getDynamicUri( $sStdUrl, $sSeoUrl, $iLang ), strpos( $sStdUrl, "https:" ) === 0 );
    }

    /**
     * Searches for seo url in seo table. If not found - FALSE is returned
     *
     * @param string  $sStdUrl   standard url
     * @param integer $iLanguage language
     *
     * @return mixed
     */
    public function fetchSeoUrl( $sStdUrl, $iLanguage = null )
    {
        $oDb = oxDb::getDb( true );
        $iLanguage = isset( $iLanguage ) ? ( (int) $iLanguage ) : oxLang::getInstance()->getBaseLanguage();
        $sSeoUrl   = false;

        $sShopId = $this->getConfig()->getShopId();

        $sQ = "select oxseourl, oxlang from oxseo where oxstdurl = ".$oDb->quote( $sStdUrl )." and oxlang = '$iLanguage' and oxshopid = '$sShopId' limit 1";
        $oRs = $oDb->execute( $sQ );
        if ( !$oRs->EOF ) {
            $sSeoUrl = $oRs->fields['oxseourl'];
        }

        return $sSeoUrl;
    }
}