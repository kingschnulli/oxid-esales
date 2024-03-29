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
 * @package   views
 * @copyright (C) OXID eSales AG 2003-2012
 * @version OXID eShop CE
 * @version   SVN: $Id: oxview.php 43803 2012-04-12 08:53:54Z tomas $
 */

/**
 * Base view class. Collects and passes data to template engine, sets some global
 * configuration parameters.
 */
class oxView extends oxSuperCfg
{
    /**
     * Array of data that is passed to template engine - array( "varName" => "varValue").
     *
     * @var array
     */
    protected $_aViewData = array();

    /**
     * Location of a executed class file.
     *
     * @var string
     */
    protected $_sClassLocation = null;

    /**
     * Name of running class method.
     *
     * @var string
     */
    protected $_sThisAction = null;

    /**
     * If this is a component we will have our parent view here.
     *
     * @var oxview
     */
    protected $_oParent = null;

    /**
     * Flag if this objcet is a component or not
     *
     * @var bool
     */
    protected $_blIsComponent = false;

    /**
     * Name of template file to render.
     *
     * @var string
     */
    protected $_sThisTemplate = null;

    /**
     * ID of current view - generated php file.
     *
     * @var string
     */
    protected $_sViewId = null;

    /**
     * Current view class name
     *
     * @var string
     */
    protected $_sClass = null;

    /**
     * Action function name
     *
     * @var string
     */
    protected $_sFnc = null;

    /**
     * Marker if user defined function was executed
     *
     * @var bool
     */
    protected static $_blExecuted = false;

    /**
     * Trunsted shop id
     * @var string
     */
    protected $_sTrustedShopId = null;

    /**
     * Trunsted shop id for excellence product
     * @var string
     */
    protected $_sTSExcellenceId = null;

    /**
     * Active charset
     * @var string
     */
    protected $_sCharSet = null;

    /**
     * Shop version
     * @var string
     */
    protected $_sVersion = null;

    /**
     * If current shop has demo version
     * @var bool
     */
    protected $_blDemoVersion = null;

    /**
     * If current shop has demo shop
     * @var bool
     */
    protected $_blDemoShop = null;

    /**
     * Display if newsletter must be displayed
     * @var bool
     */
    protected $_iNewsStatus = null;

    /**
     * Shop logo
     * @var string
     */
    protected $_sShopLogo = null;

    /**
     * Category ID
     *
     * @var string
     */
    protected $_sCategoryId = null;

    /**
     * Active category object.
     * @var object
     */
    protected $_oClickCat = null;

    /**
     * Cache sign to enable/disable use of cache.
     *
     * @var bool
     */
    protected $_blIsCallForCache = false;

    /**
     * oxViewConfig instance
     *
     * @var oxViewConfig
     */
    protected $_oViewConf = null;

    /**
     * Initiates all components stored, executes oxview::addGlobalParams.
     *
     * @return null
     */
    public function init()
    {
        // setting current view class name
        $this->_sThisAction = strtolower( get_class( $this ) );

        if ( !$this->_blIsComponent ) {
            // assume that cached components does not affect this method ...
            $this->addGlobalParams();
        }
    }

    /**
     * Set cache sign to enable/disable use of cache
     *
     * @param bool $blIsCallForCache cache sign to enable/disable use of cache
     *
     * @return null
     */
    public function setIsCallForCache( $blIsCallForCache = null )
    {
        $this->_blIsCallForCache = $blIsCallForCache;
    }

    /**
     * Get cache sign to enable/disable use of cache
     *
     * @return bool
     */
    public function getIsCallForCache()
    {
        return $this->_blIsCallForCache;
    }

    /**
     * Returns view ID (currently it returns NULL)
     *
     * @return string
     */
    public function getViewId()
    {
    }

    /**
     * Returns name of template to render
     *
     * @return string current view template file name
     */
    public function render()
    {
        return $this->getTemplateName();
    }

    /**
     * Sets and caches default parameters for shop object and returns it.
     *
     * Template variables:
     * <b>isdemoversion</b>, <b>shop</b>, <b>isdemoversion</b>,
     * <b>version</b>,
     * <b>iShopID_TrustedShops</b>,
     * <b>urlsign</b>
     *
     * @param oxShop $oShop current shop object
     *
     * @return object $oShop current shop object
     */
    public function addGlobalParams( $oShop = null)
    {
        // by default we allways display newsletter bar
        $this->_iNewsStatus = 1;

        // assigning shop to view config ..
        $oViewConf = $this->getViewConfig();
        if ( $oShop ) {
            $oViewConf->setViewShop( $oShop, $this->_aViewData );
        }

        //sending all view to smarty
        $this->_aViewData['oView'] = $this;
        $this->_aViewData['oViewConf'] = $this->getViewConfig();

        return $oViewConf;
    }

    /**
     * Sets value to parameter used by template engine.
     *
     * @param string $sPara  name of parameter to pass
     * @param string $sValue value of parameter
     *
     * @return null
     */
    public function addTplParam( $sPara, $sValue )
    {
        $this->_aViewData[$sPara] = $sValue;
    }

    /**
     * Sets additional parameters: cl, searchparam, searchcnid,
     * searchvendor, searchmanufacturer, cnid.
     *
     * @deprecated use oxView::getAdditionalParams()
     *
     * Template variables:
     * <b>additionalparams</b>
     *
     * @return null
     */
    protected function _setAdditionalParams()
    {
        $this->getAdditionalParams();
    }

    /**
     * Returns belboon parameter
     *
     * @return string $sBelboon
     */
    public function getBelboonParam()
    {
        if ( $sBelboon = oxSession::getVar( 'belboon' ) ) {
            return $sBelboon;
        }
        if ( ( $sBelboon = oxConfig::getParameter( 'belboon' ) ) ) {
            oxSession::setVar( 'belboon', $sBelboon );
        }

        return $sBelboon;
    }

    /**
     * Returns view config object
     *
     * @return oxviewconfig
     */
    public function getViewConfig()
    {
        if ( $this->_oViewConf === null ) {
            $this->_oViewConf = oxNew( 'oxViewConfig' );
        }

        return $this->_oViewConf;
    }

    /**
     * Returns current view template file name
     *
     * @return string
     */
    public function getTemplateName()
    {
        return $this->_sThisTemplate;
    }

    /**
     * Current view class name setter.
     *
     * @param string $sClassName current view class name
     *
     * @return null
     */
    public function setClassName( $sClassName )
    {
        $this->_sClass = $sClassName;
    }

    /**
     * Returns class name of current class
     *
     * @return string
     */
    public function getClassName()
    {
        return $this->_sClass;
    }

    /**
     * Set current view action function name
     *
     * @param string $sFncName action function name
     *
     * @return null
     */
    public function setFncName( $sFncName )
    {
        $this->_sFnc = $sFncName;
    }

    /**
     * Returns name of current action function
     *
     * @return string
     */
    public function getFncName()
    {
        return $this->_sFnc;
    }

    /**
     * Set array of data that is passed to template engine - array( "varName" => "varValue")
     *
     * @param array $aViewData array of data that is passed to template engine
     *
     * @return null
     */
    public function setViewData( $aViewData = null )
    {
        $this->_aViewData = $aViewData;
    }

    /**
     * Get view data
     *
     * @return array
     */
    public function getViewData()
    {
        return $this->_aViewData;
    }

    /**
     * Get view data single array element
     *
     * @param string $sParamId view data array key
     *
     * @return mixed
     */
    public function getViewDataElement( $sParamId = null )
    {
        if ( $sParamId && isset( $this->_aViewData[$sParamId] ) ) {
            return $this->_aViewData[$sParamId];
        }
    }

    /**
     * Set location of a executed class file
     *
     * @param string $sClassLocation location of a executed class file
     *
     * @return null
     */
    public function setClassLocation( $sClassLocation = null )
    {
        $this->_sClassLocation = $sClassLocation;
    }
    /**
     * Get location of a executed class file
     *
     * @return string
     */
    public function getClassLocation()
    {
        return $this->_sClassLocation;
    }

    /**
     * Set name of running class method
     *
     * @param string $sThisAction name of running class method
     *
     * @return null
     */
    public function setThisAction( $sThisAction = null )
    {
        $this->_sThisAction = $sThisAction;
    }

    /**
     * Get name of running class method
     *
     * @return string
     */
    public function getThisAction()
    {
        return $this->_sThisAction;
    }

    /**
     * Set parent object. If this is a component we will have our parent view here.
     *
     * @param object $oParent parent object
     *
     * @return null
     */
    public function setParent( $oParent = null )
    {
        $this->_oParent = $oParent;
    }

    /**
     * Get parent object
     *
     * @return null
     */
    public function getParent()
    {
        return $this->_oParent;
    }

    /**
     * Set flag if this object is a component or not
     *
     * @param bool $blIsComponent flag if this object is a component
     *
     * @return null
     */
    public function setIsComponent( $blIsComponent = null )
    {
        $this->_blIsComponent = $blIsComponent;
    }

    /**
     * Get flag if this objcet is a component
     *
     * @return bool
     */
    public function getIsComponent()
    {
        return $this->_blIsComponent;
    }

    /**
     * Executes method (creates class and then executes). Returns executed
     * function result.
     *
     * @param string $sFunction name of function to execute
     *
     * @throws oxSystemComponentException system component exception
     *
     * @return mixed
     */
    public function executeFunction( $sFunction )
    {
        // execute
        if ( $sFunction && !self::$_blExecuted ) {
            if ( method_exists( $this, $sFunction ) ) {


                $sNewAction = $this->$sFunction();
                self::$_blExecuted = true;

                if (isset($sNewAction)) {
                    $this->_executeNewAction( $sNewAction );
                }
            } else {
                // was not executed on any level ?
                if ( !$this->_blIsComponent ) {
                    $oEx = oxNew( 'oxSystemComponentException' );
                    $oEx->setMessage( 'ERROR_MESSAGE_SYSTEMCOMPONENT_FUNCTIONNOTFOUND' );
                    $oEx->setComponent( $sFunction );
                    throw $oEx;
                }
            }
        }
    }

    /**
     * Formats header for new controller action
     *
     * Input example: "view_name?param1=val1&param2=val2" => "cl=view_name&param1=val1&param2=val2"
     *
     * @param string $sNewAction new action params
     *
     * @return string
     */
    protected function _executeNewAction( $sNewAction )
    {
        if ( $sNewAction ) {
            $myConfig  = $this->getConfig();

            // page parameters is the part which goes after '?'
            $aParams = explode( '?', $sNewAction );

            // action parameters is the part before '?'
            $sPageParams = isset( $aParams[1] )?$aParams[1]:null;

            // looking for function name
            $aParams    = explode( '/', $aParams[0] );
            $sClassName = $aParams[0];

            // building redirect path ...
            $sHeader  = ( $sClassName )?"cl=$sClassName&":'';  // adding view name
            $sHeader .= ( $sPageParams )?"$sPageParams&":'';   // adding page params
            $sHeader .= $this->getSession()->sid();            // adding session Id

            $sUrl = $myConfig->getCurrentShopUrl($this->isAdmin());

            $sUrl = "{$sUrl}index.php?{$sHeader}";

            $sUrl = oxUtilsUrl::getInstance()->processUrl($sUrl);

            //#M341 do not add redirect parameter
            oxUtils::getInstance()->redirect( $sUrl, (bool) oxConfig::getParameter( 'redirected' ), 302 );
        }
    }

    /**
     * Template variable getter. Returns additional params for url
     *
     * @return string
     */
    public function getAdditionalParams()
    {
        return oxUtilsUrl::getInstance()->processUrl( '', false );
    }

    /**
     * Returns shop id in classic trusted shops
     *
     * @return string
     */
    public function getTrustedShopId()
    {
        if ( $this->_sTrustedShopId == null ) {
            $this->_sTrustedShopId = false;
            $oConfig = $this->getConfig();
            $aTsType   = $oConfig->getConfigParam( 'tsSealType' );
            $sTsActive = $oConfig->getConfigParam( 'tsSealActive' );
            $aTrustedShopIds = $oConfig->getConfigParam( 'iShopID_TrustedShops' );
            $iLangId = (int) oxLang::getInstance()->getBaseLanguage();
            if ( $sTsActive && $aTrustedShopIds && $aTsType[$iLangId] == 'CLASSIC' ) {
                // compatibility to old data
                if ( !is_array( $aTrustedShopIds ) && $iLangId == 0 ) {
                    $this->_sTrustedShopId = $aTrustedShopIds;
                }
                if ( is_array( $aTrustedShopIds ) ) {
                    $this->_sTrustedShopId = $aTrustedShopIds[$iLangId];
                }
                if ( strlen( $this->_sTrustedShopId ) != 33 || substr( $this->_sTrustedShopId, 0, 1 ) != 'X' ) {
                    $this->_sTrustedShopId = false;
                }
            }
        }
        return $this->_sTrustedShopId;
    }

    /**
     * Returns shop id in trusted shops if excellence product is ordered
     *
     * @return string
     */
    public function getTSExcellenceId()
    {
        if ( $this->_sTSExcellenceId == null ) {
            $this->_sTSExcellenceId = false;
            $oConfig   = $this->getConfig();
            $aTsType   = $oConfig->getConfigParam( 'tsSealType' );
            $sTsActive = $oConfig->getConfigParam( 'tsSealActive' );
            $aTrustedShopIds = $oConfig->getConfigParam( 'iShopID_TrustedShops' );
            $iLangId = (int) oxLang::getInstance()->getBaseLanguage();
            if ( $sTsActive && $aTrustedShopIds && $aTsType[$iLangId] == 'EXCELLENCE' ) {
                $this->_sTSExcellenceId = $aTrustedShopIds[$iLangId];
            }
        }
        return $this->_sTSExcellenceId;
    }

    /**
     * Returns active charset
     *
     * @return string
     */
    public function getCharSet()
    {
        if ( $this->_sCharSet == null ) {
            $this->_sCharSet = oxLang::getInstance()->translateString( 'charset' );
        }
        return $this->_sCharSet;
    }

    /**
     * Returns shop version
     *
     * @return string
     */
    public function getShopVersion()
    {
        if ( $this->_sVersion == null ) {
            $this->_sVersion = $this->getConfig()->getActiveShop()->oxshops__oxversion->value;
        }
        return $this->_sVersion;
    }

    /**
     * Returns shop edition
     *
     * @return string
     */
    public function getShopEdition()
    {
        return $this->getConfig()->getActiveShop()->oxshops__oxedition->value;
    }

    /**
     * Returns shop revision
     *
     * @return string
     */
    public function getRevision()
    {
        return $this->getConfig()->getRevision();
    }

    /**
     * Returns shop full edition
     *
     * @return string
     */
    public function getShopFullEdition()
    {
        $sEdition = $this->getShopEdition();
        $sFullEdition = "Community Edition";
        if ( $sEdition == "PE" ) {
            $sFullEdition = "Professional Edition";
        }

        if ( $sEdition == "EE" ) {
            $sFullEdition = "Enterprise Edition";
        }

        return $sFullEdition;
    }


    /**
     * Returns if current shop is demo version
     *
     * @return string
     */
    public function isDemoVersion()
    {
        if ( $this->_blDemoVersion == null ) {
            $this->_blDemoVersion = $this->getConfig()->detectVersion() == 1;
        }
        return $this->_blDemoVersion;
    }

    /**
     * Returns if current shop is demoshop
     *
     * @return string
     */
    public function isDemoShop()
    {
        if ( $this->_blDemoShop == null ) {
            $this->_blDemoShop = $this->getConfig()->isDemoShop();
        }
        return $this->_blDemoShop;
    }

    /**
     * Template variable getter. Returns if newsletter can be displayed (for _right.tpl)
     *
     * @return integer
     */
    public function showNewsletter()
    {
        if ( $this->_iNewsStatus === null) {
            return 1;
        }
        return $this->_iNewsStatus;
    }

    /**
     * Sets if to show newsletter
     *
     * @param bool $blShow if TRUE - newsletter subscription box will be shown
     *
     * @return null
     */
    public function setShowNewsletter( $blShow )
    {
        $this->_iNewsStatus = $blShow;
    }

    /**
     * Template variable getter. Returns shop logo
     *
     * @return string
     */
    public function getShopLogo()
    {
        return $this->_sShopLogo;
    }

    /**
     * Sets shop logo
     *
     * @param string $sLogo shop logo url
     *
     * @return null
     */
    public function setShopLogo( $sLogo )
    {
        $this->_sShopLogo = $sLogo;
    }

    /**
     * Returns active category set by categories component; if category is
     * not set by component - will create category object and will try to
     * load by id passed by request
     *
     * @return oxcategory
     */
    public function getActCategory()
    {
        // if active category is not set yet - trying to load it from request params
        // this may be usefull when category component was unable to load active category
        // and we still need some object to mount navigation info
        if ( $this->_oClickCat === null ) {

            $this->_oClickCat = false;
            $oCategory = oxNew( 'oxcategory' );
            if ( $oCategory->load( $this->getCategoryId() ) ) {
                $this->_oClickCat = $oCategory;
            }
        }

        return $this->_oClickCat;
    }

    /**
     * Active category setter
     *
     * @param oxcategory $oCategory active category
     *
     * @return null
     */
    public function setActCategory( $oCategory )
    {
        $this->_oClickCat = $oCategory;
    }

    /**
     * Get category ID
     *
     * @return string
     */
    public function getCategoryId()
    {
        if ( $this->_sCategoryId == null && ( $sCatId = oxConfig::getParameter( 'cnid' ) ) ) {
            $this->_sCategoryId = $sCatId;
        }

        return $this->_sCategoryId;
    }

    /**
     * Category ID setter
     *
     * @param string $sCategoryId Id of category to cache
     *
     * @return null
     */
    public function setCategoryId( $sCategoryId )
    {
        $this->_sCategoryId = $sCategoryId;
    }

    /**
     * Returns a name of the view variable containing the error/exception messages
     *
     * @return null
     */
    public function getErrorDestination()
    {
    }

    /**
     * Returns name of a view class, which will be active for an action
     * (given a generic fnc, e.g. logout)
     *
     * @return string
     */
    public function getActionClassName()
    {
        return $this->getClassName();
    }

    /**
     * Checks if user is connected via Facebook connect
     *
     * @return bool
     */
    public function isConnectedWithFb()
    {
        $myConfig = $this->getConfig();

        if ( $myConfig->getConfigParam( "bl_showFbConnect" ) ) {
            $oFb = oxFb::getInstance();
            return $oFb->isConnected();
        }

        return false;
    }

    /**
     * Gets get Facebook user id
     *
     * @return int
     */
    public function getFbUserId()
    {
        if ( $this->getConfig()->getConfigParam( "bl_showFbConnect" ) ) {
            $oFb = oxFb::getInstance();
            return $oFb->getUser();
        }
    }

    /**
     * Returns true if popup message about connecting your existing account
     * to Facebook account must be shown
     *
     * @return bool
     */
    public function showFbConnectToAccountMsg()
    {
        if ( $this->getConfig()->getParameter( "fblogin" ) ) {
            if ( !$this->getUser() || ($this->getUser() && oxSession::getVar( '_blFbUserIdUpdated' ) ) ) {
                return true;
            } else {
                return false;
            }
        }

        return false;
    }

    /**
     * Returns if shop is mall
     *
     * @return bool
     */
    public function isMall()
    {
            return false;
    }

}
