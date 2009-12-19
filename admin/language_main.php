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
 * $Id: language_main.php 24709 2009-12-18 15:26:22Z rimvydas.paskevicius $
 */

/**
 * Admin article main selectlist manager.
 * Performs collection and updatind (on user submit) main item information.
 * @package admin
 */
class Language_Main extends oxAdminDetails
{

    /**
     * Current shop base languages
     *
     * @var arrray
     */
    protected $_aLangData = null;

    /**
     * Current shop base languages parameters
     *
     * @var array
     */
    protected $_aLangParams = null;

    /**
     * Current shop base languages base urls
     *
     * @var array
     */
    protected $_aLanguagesUrls = null;

    /**
     * Current shop base languages base ssl urls
     *
     * @var array
     */
    protected $_aLanguagesSslUrls = null;

    /**
     * Executes parent method parent::render(), creates oxCategoryList object,
     * passes it's data to Smarty engine and returns name of template file
     * "selectlist_main.tpl".
     *
     * @return string
     */
    public function render()
    {
        $myConfig = $this->getConfig();


        parent::render();

        $sOxId = oxConfig::getParameter( "oxid");
        // check if we right now saved a new entry
        $sSavedID = oxConfig::getParameter( "saved_oxid");
        if ( isset( $sSavedID) ) {
            $sOxId = $sSavedID;
            oxSession::deleteVar( "saved_oxid");
            $this->_aViewData["oxid"] =  $sOxId;
            // for reloading upper frame
            $this->_aViewData["updatelist"] =  "1";
        }

        //loading languages info from config
        $this->_loadLanguages();

        if ( $sOxId != -1 ) {
            //checking if translations files and DB multilanguage fields exists
            $this->_checkLangTranslations( $sOxId );
            $this->_checkMultiLangDbFields( $sOxId );
        }

        if ( $sOxId != "-1" && isset( $sOxId)) {
            $this->_aViewData["edit"] =  $this->_getLanguageInfo( $sOxId );
        }

        return "language_main.tpl";
    }

    /**
     * Saves selection list parameters changes.
     *
     * @return mixed
     */
    public function save()
    {
        $myConfig  = $this->getConfig();


        $sOxId   = oxConfig::getParameter( "oxid");
        $aParams = oxConfig::getParameter( "editval" );

        if ( !isset( $aParams['active'])) {
            $aParams['active'] = 0;
        }

        if ( !isset( $aParams['default'])) {
            $aParams['default'] = false;
        }

        if ( empty( $aParams['sort'])) {
            $aParams['sort'] = '99999';
        }

        //loading languages info from config
        $this->_loadLanguages();

        //checking input errors
        if ( !$this->_validateInput() ) {
            return;
        }

        // if changed language abbervation, updating it for all arrays related with languages
        if ( $sOxId != -1 && $sOxId  != $aParams['abbr'] ) {
            $this->_updateAbbervation( $sOxId, $aParams['abbr'] );
            $sOxId = $aParams['abbr'];
            oxSession::setVar( "saved_oxid", $sOxId);
        }

        // if adding new language, setting lang id to abbervation
        if ( $sOxId == -1 ) {
            $sOxId = $aParams['abbr'];
            $this->_aLangData['params'][$sOxId]['baseId'] = $this->_getAvailableLangBaseId();
            oxSession::setVar( "saved_oxid", $sOxId);
        }

        //updating language description
        $this->_aLangData['lang'][$sOxId]  = $aParams['desc'];

        //updating language parameters
        $this->_aLangData['params'][$sOxId]['active']  = $aParams['active'];
        $this->_aLangData['params'][$sOxId]['default'] = $aParams['default'];
        $this->_aLangData['params'][$sOxId]['sort']   = $aParams['sort'];

        //if setting lang as default
        if ( $aParams['default'] == '1' ) {
            $this->_setDefaultLang( $sOxId );
        }

        //updating language urls
        $iBaseId = $this->_aLangData['params'][$sOxId]['baseId'];
        $this->_aLangData['urls'][$iBaseId] = $aParams['baseurl'];
        $this->_aLangData['sslUrls'][$iBaseId] = $aParams['basesslurl'];

        //sort parameters, urls and languages arrays by language base id
        $this->_sortLangArraysByBaseId();

        $this->_aViewData["updatelist"] = "1";
return;
        //saving languages info
        $this->getConfig()->saveShopConfVar( 'aarr', 'aLanguageParams',  $this->_aLangData['params']  );
        $this->getConfig()->saveShopConfVar( 'aarr', 'aLanguages',       $this->_aLangData['lang']    );
        $this->getConfig()->saveShopConfVar( 'arr',  'aLanguageURLs',    $this->_aLangData['urls']    );
        $this->getConfig()->saveShopConfVar( 'arr',  'aLanguageSSLURLs', $this->_aLangData['sslUrls'] );
    }

    /**
     * Get selected language info
     *
     * @param string $sOxId language abbervation
     *
     * @return array
     */
    protected function _getLanguageInfo( $sOxId )
    {
        $sDefaultLang = $this->getConfig()->getConfigParam( 'sDefaultLang' );

        $aLangData               = $this->_aLangData['params'][$sOxId];
        $aLangData['abbr']       = $sOxId;
        $aLangData['desc']       = $this->_aLangData['lang'][$sOxId];
        $aLangData['baseurl']    = $this->_aLangData['urls'][$aLangData['baseId']];
        $aLangData['basesslurl'] = $this->_aLangData['sslUrls'][$aLangData['baseId']];
        $aLangData['default']    = ($this->_aLangData['params'][$sOxId]["baseId"] == $sDefaultLang) ? true : false;

        return $aLangData;
    }

    /**
     * Loads from config all data related with languages.
     * If no languages parameters array exists, sets default parameters values.
     *
     * @return null
     */
    protected function _loadLanguages()
    {
        $this->_aLangData['params']  = $this->getConfig()->getConfigParam( 'aLanguageParams' );
        $this->_aLangData['lang']    = $this->getConfig()->getConfigParam( 'aLanguages' );
        $this->_aLangData['urls']    = $this->getConfig()->getConfigParam( 'aLanguageURLs' );
        $this->_aLangData['sslUrls'] = $this->getConfig()->getConfigParam( 'aLanguageSSLURLs' );

        // empty languages parameters array - creating new one with default values
        if ( !is_array($this->_aLangData['params']) ) {
            $this->_aLangData['params'] = $this->_assignDefaultLangParams();
        }
    }

    /**
     * Replaces languages arrays keys by new value.
     *
     * @param string $sOldId old ID
     * @param string $sNewId new ID
     *
     * @return unknown_type
     */
    protected function _updateAbbervation( $sOldId, $sNewId )
    {
        foreach( array_keys($this->_aLangData) as $sTypeKey ) {

            if ( is_array($this->_aLangData[$sTypeKey]) && count($this->_aLangData[$sTypeKey]) > 0 ) {

                if ( $sTypeKey == 'urls' || $sTypeKey == 'sslUrls' ) {
                    continue;
                }

                $aKeys   = array_keys( $this->_aLangData[$sTypeKey] );
                $aValues = array_values( $this->_aLangData[$sTypeKey] );
                //find and replace key
                $iReplaceId = array_search( $sOldId, $aKeys );
                $aKeys[$iReplaceId] = $sNewId;

                $this->_aLangData[$sTypeKey] = array_combine( $aKeys, $aValues );
            }
        }
    }

    /**
     * Sort languages, languages parameters, urls, ssl urls arrays according
     * base land ID
     *
     * @return null
     */
    protected function _sortLangArraysByBaseId()
    {
        $aUrls      = array();
        $aSslUrls   = array();
        $aLanguages = array();

        uasort( $this->_aLangData['params'], array($this, '_sortLangParamsByBaseIdCallback') );

        foreach( $this->_aLangData['params'] as  $sAbbr => $aParams ) {
            $iId = (int)$aParams['baseId'];
            $aUrls[$iId]        = $this->_aLangData['urls'][$iId];
            $aSslUrls[$iId]     = $this->_aLangData['sslUrls'][$iId];
            $aLanguages[$sAbbr] = $this->_aLangData['lang'][$sAbbr];
        }

        $this->_aLangData['lang']    = $aLanguages;
        $this->_aLangData['urls']    = $aUrls;
        $this->_aLangData['sslUrls'] = $aSslUrls;
    }

    /**
     * Assign default values for eache language
     *
     * @return array
     */
    protected function _assignDefaultLangParams()
    {
        $aParams = array();
        $iBaseId = 0;

        foreach( array_keys($this->_aLangData['lang']) as $sOxId ) {
            $aParams[$sOxId]['baseId']  = $iBaseId;
            $aParams[$sOxId]['active']  = 1;
            $aParams[$sOxId]['sort']   = $iBaseId + 1;

            $iBaseId++;
        }

        return $aParams;
    }

    /**
     * Sets default language base ID to config var 'sDefaultLang'
     *
     * @param string $sOxId language abbervation
     *
     * @return null
     */
    protected function _setDefaultLang( $sOxId )
    {
        $sDefaultId = $this->_aLangData['params'][$sOxId]['baseId'];
        $this->getConfig()->saveShopConfVar( 'str',  'sDefaultLang', $sDefaultId );
    }

    /**
     * Get availabale language base ID
     *
     * @return int
     */
    protected function _getAvailableLangBaseId()
    {
        $aBaseId = array();
        foreach( $this->_aLangData['params'] as $aLang ) {
            $aBaseId[] = $aLang['baseId'];
        }

        $iNewId = 0;
        sort( $aBaseId );
        $iTotal = count($aBaseId);

        //getting first available id
        while( $iNewId <= $iTotal ) {
            if ( $iNewId !== $aBaseId[$iNewId] ) {
                break;
            }
            $iNewId++;
        }

        return $iNewId;
    }

    /**
     * Check selected language has translation file lang.php
     * If not - displays warning
     *
     * @param string $sOxId language abbervation

     * @return null
     */
    protected function _checkLangTranslations( $sOxId )
    {
        $myConfig = $this->getConfig();
        $iBaseId = $this->_aLangData['params'][$sOxId]['baseId'];

        $sDir = dirname( $myConfig->getLanguagePath( 'lang.php', 0, $iBaseId ) );
            if ( !$sDir ) {
                //additional check for former templates
                $sDir = dirname( $myConfig->getLanguagePath( 'lang.txt', 0, $iBaseId ) );
            }

        if ( empty($sDir) ) {
            $oEx = new oxExceptionToDisplay();
            $oEx->setMessage( 'LANGUAGE_NOTRANSLATIONS_WARNING' );
            oxUtilsView::getInstance()->addErrorToDisplay( $oEx );
        }
    }

    /**
     * Check if selected language has multilanguage fields in DB
     * If not - displays warning
     *
     * @param string $sOxId language abbervation

     * @return null
     */
    protected function _checkMultiLangDbFields( $sOxId )
    {
        $oDbMeta = oxNew( "oxDbMetaDataHandler" );
        $iBaseId = $this->_aLangData['params'][$sOxId]['baseId'];

        $sPrefix = oxLang::getInstance()->getLanguageTag( $iBaseId );
        $sMultiLangCol = 'OXTITLE' . $sPrefix;

        if ( !$oDbMeta->fieldExists( $sMultiLangCol, "oxarticles" ) ) {
            //creating new multilanguage fields with new id over whole DB
            oxDb::startTransaction();
            try {
                $oDbMeta->addNewLangToDb();
            } catch( Exception $oEx ) {
                // if exception, rollBack everything
                oxDb::rollbackTransaction();

                //show warning
                $oEx = new oxExceptionToDisplay();
                $oEx->setMessage( 'LANGUAGE_ERROR_ADDING_MULTILANG_FIELDS' );
                oxUtilsView::getInstance()->addErrorToDisplay( $oEx );

                return;
            }

            oxDb::commitTransaction();
        }
    }

    /**
     * Check if language already exists
     *
     * @param string $sAbbr language abbervation

     * @return bool
     */
    protected function _checkLangExists( $sAbbr )
    {
        $myConfig = $this->getConfig();
        $aAbbrs = array_keys($this->_aLangData['lang']);

        if ( in_array( $sAbbr, $aAbbrs ) ) {
            return true;
        }

        return false;
    }

    /**
     * Callback function for sorting languages arraty. Sorts array according
     * 'baseId' parameter
     *
     * @param object $oLang1 language array
     * @param object $oLang2 language array
     *
     * @return bool
     */
    protected function _sortLangParamsByBaseIdCallback( $oLang1, $oLang2 )
    {
        return ($oLang1['baseId'] < $oLang2['baseId']) ? -1 : 1;
    }

    /**
     * Check language input errors
     *
     * @return bool
     */
    protected function _validateInput()
    {
        $blResult = true;

        $sOxId   = oxConfig::getParameter( "oxid");
        $aParams = oxConfig::getParameter( "editval" );

        // if creating new language, checking if language already exists with
        // entered language abbervation
        if ( $sOxId == -1 ) {
            if ( $this->_checkLangExists( $aParams['abbr'] ) ) {
                $oEx = oxNew( 'oxExceptionToDisplay' );
                $oEx->setMessage( 'LANGUAGE_ALREADYEXISTS_ERROR' );
                oxUtilsView::getInstance()->addErrorToDisplay( $oEx );
                $blResult = false;
            }
        }

        // checking if language name is not empty
        if ( empty($aParams['desc']) ) {
            $oEx = oxNew( 'oxExceptionToDisplay' );
            $oEx->setMessage( 'LANGUAGE_EMPTYLANGUAGENAME_ERROR' );
            oxUtilsView::getInstance()->addErrorToDisplay( $oEx );
            $blResult = false;
        }

        return $blResult;
    }
}
