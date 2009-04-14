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
 * @copyright (C) OXID eSales AG 2003-2009
 * @version OXID eShop CE
 * $Id: oxubase.php 18043 2009-04-09 12:25:00Z arvydas $
 */

/**
 * Includes extended class.
 */
require_once getShopBasePath() . 'views/oxview.php' ;

// view indexing state for search engines:
define( 'VIEW_INDEXSTATE_INDEX', 0 );           //  index without limitations
define( 'VIEW_INDEXSTATE_NOINDEXNOFOLLOW', 1 ); //  no index / no follow
define( 'VIEW_INDEXSTATE_NOINDEXFOLLOW', 2 );   //  no index / follow

/**
 * Base view class.
 * Class is responsible for managing of components that must be
 * loaded and executed before any regular operation.
 */
class oxUBase extends oxView
{
    /**
     * Array of component objects.
     *
     * @var object
     */
    protected $_oaComponents = array();

    /**
     * Cache sign to enable/disable use of cache.
     *
     * @var bool
     */
    protected $_blIsCallForCache = false;

    /**
     * Flag if current view is an order view
     *
     * @var bool
     */
    protected $_blIsOrderStep = false;

    /**
     * List type
     *
     * @var string
     */
    protected $_sListType = null;

    /**
     * Active articles category object.
     *
     * @var oxcategory
     */
    protected $_oActCategory = null;

    /**
     * Active category object.
     * @var object
     */
    protected $_oClickCat = null;

    /**
     * Category ID
     *
     * @var string
     */
    protected $_sCategoryId = null;

    /**
     * Active Manufacturer object.
     *
     * @var oxManufacturer
     */
    protected $_oActManufacturer = null;

    /**
     * Active vendor object.
     *
     * @var oxvendor
     */
    protected $_oActVendor = null;

    /**
     * Active search object - Oxstdclass object which keeps navigation info
     *
     * @var oxstdclass
     */
    protected $_oActSearch = null;

    /**
     * Marked which defines if current view is sortable or not
     * @var bool
     */
    protected $_blShowSorting = false;

    /**
     * Show right basket
     * @var bool
     */
    protected $_blShowRightBasket = null;

    /**
     * Show top basket
     * @var bool
     */
    protected $_blShowTopBasket = null;

    /**
     * Show left basket
     * @var bool
     */
    protected $_blShowLeftBasket = null;

    /**
     * Load currency option
     * @var bool
     */
    protected $_blLoadCurrency = null;

    /**
     * Load vendors option
     * @var bool
     */
    protected $_blLoadVendorTree = null;

    /**
     * Load Manufacturers option
     * @var bool
     */
    protected $_blLoadManufacturerTree = null;

    /**
     * Dont show emty cats
     * @var bool
     */
    protected $_blDontShowEmptyCats = null;

    /**
     * Load language option
     * @var bool
     */
    protected $_blLoadLanguage = null;

    /**
     * Show category top navigation option
     * @var bool
     */
    protected $_blShowTopCatNav = null;

    /**
     * Item count in category top navigation
     * @var integer
     */
    protected $_iTopCatNavItmCnt = null;

    /**
     * Rss links
     * @var array
     */
    protected $_aRssLinks = null;

    /**
     * List's "order by"
     * @var string
     */
    protected $_sListOrderBy = null;

    /**
     * Order directio of list
     * @var string
     */
    protected $_sListOrderDir = null;

    /**
     * Meta description
     * @var string
     */
    protected $_sMetaDescription = null;

    /**
     * Meta keywords
     * @var string
     */
    protected $_sMetaKeywords = null;

    /**
     * Start page meta description CMS ident
     *
     * @var string
     */
    protected $_sMetaDescriptionIdent = null;

    /**
     * Start page meta keywords CMS ident
     *
     * @var string
     */
    protected $_sMetaKeywordsIdent = null;

    /**
     * Additional params for url.
     * @var string
     */
    protected $_sAdditionalParams = null;

    /**
     * Active currency object.
     * @var object
     */
    protected $_oActCurrency = null;

    /**
     * Sign if any new component is added. On this case will be
     * executed components stored in oxBaseView::_aComponentNames
     * plus oxBaseView::_aComponentNames.
     * @var bool
     */
    protected $_blCommonAdded = false;

    /**
     * Current view search engine indexing state:
     *     VIEW_INDEXSTATE_INDEX - index without limitations
     *     VIEW_INDEXSTATE_NOINDEXNOFOLLOW - no index / no follow
     *     VIEW_INDEXSTATE_NOINDEXFOLLOW - no index / follow
     */
    protected $_iViewIndexState = VIEW_INDEXSTATE_INDEX;

    /**
     * If true, forces oxUbase::noIndex returns VIEW_INDEXSTATE_NOINDEXFOLLOW
     * ( oxUbase::$_iViewIndexState = VIEW_INDEXSTATE_NOINDEXFOLLOW; index / follow)
     *
     * @var bool
     */
    protected $_blForceNoIndex = false;

    /**
     * Searched wishlist user name.
     * @var string
     */
    protected $_sWishlistName = null;

    /**
     * Number of products in comparelist.
     * @var integer
     */
    protected $_iCompItemsCnt = null;

    /**
     * Default content id
     *
     * @return string
     */
    protected $_sContentId = null;

    /**
     * Default content
     *
     * @return oxContent
     */
    protected $_oContent = null;

    /**
     * View id
     *
     * @var string
     */
    protected $_sViewResetID = null;

    /**
     * Display sorting in templates
     * @var bool
     */
    protected $_blActiveSorting = null;

    /**
     * Menue list
     * @var array
     */
    protected $_aMenueList = null;

    /**
     * Names of components (classes) that are initiated and executed
     * before any other regular operation.
     * @var array
     */
    protected $_aComponentNames = array(
                                    'oxcmp_user'       => 1, // 0 means dont init if cached
                                    'oxcmp_lang'       => 1,
                                    'oxcmp_cur'        => 1,
                                    'oxcmp_shop'       => 1,
                                    'oxcmp_categories' => 0,
                                    'oxcmp_utils'      => 1,
                                    'oxcmp_news'       => 0,
                                    'oxcmp_basket'     => 1
                                  );

    /**
     * Names of components (classes) that are initiated and executed
     * before any other regular operation. User may modify this himself.
     * @var array
     */
    protected $_aUserComponentNames = array();

    /**
     * Current view product object
     *
     * @var oxarticle
     */
    protected $_oProduct = null;

    /**
     * Number of current list page.
     * @var integer
     */
    protected $_iActPage = null;

    /**
     * A list of articles.
     * @var array
     */
    protected $_aArticleList = null;

    /**
     * Vendor list object.
     * @var object
     */
    protected $_oVendorTree  = null;

    /**
     * Manufacturer list object.
     * @var object
     */
    protected $_oManufacturerTree  = null;

    /**
     * Category tree object.
     * @var oxcategorylist
     */
    protected $_oCategoryTree  = null;

    /**
     * Top 5 article list.
     * @var array
     */
    protected $_aTop5ArticleList  = null;

    /**
     * Bargain article list.
     * @var array
     */
    protected $_aBargainArticleList  = null;

    /**
     * If order price to low
     * @var integer
     */
    protected $_iLowOrderPrice  = null;

    /**
     * Min order price
     * @var string
     */
    protected $_sMinOrderPrice  = null;

    /**
     * Real newsletter status
     * @var string
     */
    protected $_iNewsRealStatus  = null;

    /**
     * Url parameters which block redirection
     * @return null
     */
    protected $_aBlockRedirectParams = array( 'fnc' );

    /**
     * Vendorlist for search
     * @var array
     */
    protected $_aVendorlist = null;

    /**
     * Root vendor object
     * @var object
     */
    protected $_oRootVendor = null;

    /**
     * Vendor id
     * @var string
     */
    protected $_sVendorId = null;

    /**
     * Manufacturer list for search
     * @var array
     */
    protected $_aManufacturerlist = null;

    /**
     * Root manufacturer object
     * @var object
     */
    protected $_oRootManufacturer = null;

    /**
     * Manufacturer id
     * @var string
     */
    protected $_sManufacturerId = null;

    /**
     * Category tree for search
     * @var array
     */
    protected $_aSearchCatTree = null;

    /**
     * Category more
     * @var object
     */
    protected $_oCatMore = null;

    /**
     * Has user news subscribed
     * @var bool
     */
    protected $_blNewsSubscribed = null;

    /**
     * Show shipping address
     * @var bool
     */
    protected $_blShowShipAddress = null;

    /**
     * Delivery address
     * @var object
     */
    protected $_oDelAddress = null;

    /**
     * Category tree path
     * @var string
     */
    protected $_sCatTreePath = null;

    /**
     * Loaded contents array (cache)
     * @var array
     */
    protected $_aContents = array();

    /**
     * Sign if to load and show top5articles action
     * @var bool
     */
    protected $_blTop5Action = false;

    /**
     * Sign if to load and show bargain action
     * @var bool
     */
    protected $_blBargainAction = false;

    /**
     * In non admin mode checks if request was NOT processed by seo handler.
     * If NOT, then tries to load alternative SEO url and if url is available -
     * redirects to it. If no alternative path was found - 404 header is emitted
     * and page is rendered
     *
     * @return null
     */
    protected function _processRequest()
    {
        $myUtils = oxUtils::getInstance();

        // non admin, request is not empty and was not processed by seo engine
        if ( $myUtils->seoIsActive() && !isSearchEngineUrl() && ( $sStdUrl = getRequestUrl( '', true ) ) ) {

            // fetching standard url and looking for it in seo table
            if ( $this->_canRedirect() && ( $sRedirectUrl = oxSeoEncoder::getInstance()->fetchSeoUrl( $sStdUrl ) ) ) {
                $myUtils->redirect( $this->getConfig()->getShopURL() . $sRedirectUrl, false );
            } else {
                // forcing to set noindex/follow meta
                $this->_forceNoIndex();

                $sShopId = $this->getConfig()->getShopId();
                $sLangId = oxLang::getInstance()->getBaseLanguage();
                $sIdent  = md5( strtolower( $sStdUrl ) . $sShopId . $sLangId );

                // logging "not found" url
                $oDb = oxDb::getDb();
                $oDb->execute( "replace oxseologs ( oxstdurl, oxident, oxshopid, oxlang )
                                values ( " . $oDb->quote( $sStdUrl ) . ", '{$sIdent}', '{$sShopId}', '{$sLangId}' ) " );
            }
        }
    }

    /**
     * Calls self::_processRequest(), initializes components which needs to
     * be loaded, sets current list type, calls parent::init()
     *
     * @return null
     */
    public function init()
    {
        $this->_processRequest();

        if ( oxConfig::getParameter( '_force_no_basket_cmp' ) ) {
            unset( $this->_aComponentNames['oxcmp_basket'] );
        }

        // as the objects are cached by dispatcher we have to watch out, that we don't add these components twice
        if ( !$this->_blCommonAdded ) {
            $this->_aComponentNames = array_merge( $this->_aComponentNames, $this->_aUserComponentNames );
            $this->_blCommonAdded = true;
        }

        // setting list type if needed
        $this->_setListType();

        // storing current view
        $blInit = true;


        // init all components if there are any
        foreach ( $this->_aComponentNames as $sComponentName => $blNotCacheable ) {
            // do not override initiated components
            if ( !isset( $this->_oaComponents[$sComponentName] ) ) {
                // component objects MUST be created to support user called functions
                $oComponent = oxNew( $sComponentName );
                $oComponent->setParent( $this );
                $oComponent->setThisAction( $sComponentName );
                $this->_oaComponents[$sComponentName] = $oComponent;
            }

            // do we really need to initiate them ?
            if ( $blInit ) {
                $this->_oaComponents[$sComponentName]->init();

                // executing only is view does not have action method
                if ( !method_exists( $this, $this->getFncName() ) ) {
                    $this->_oaComponents[$sComponentName]->executeFunction( $this->getFncName() );
                }
            }
        }

        parent::init();

        // enable sorting ?
        if ( $this->showSorting() ) {
            $this->prepareSortColumns();
        }
        $this->_aViewData['showsorting']    = $this->isSortingActive();
        $this->_aViewData["allsortcolumns"] = $this->getSortColumns();
        $this->_aViewData['listorderby']    = $this->getListOrderBy();
        $this->_aViewData['listorder']      = $this->getListOrderDirection();
    }

    /**
     * If current view ID is not set - forms and returns view ID
     * according to language and currency.
     *
     * @return string $this->_sViewId
     */
    public function getViewId()
    {
        if ( $this->_sViewId ) {
            return $this->_sViewId;
        }

        $iLang = oxLang::getInstance()->getBaseLanguage();
        $iCur  = (int) oxConfig::getParameter( 'currency' );


            $this->_sViewId =  "ox|$iLang|$iCur";

        return $this->_sViewId;
    }


    /**
     * Template variable getter. Returns true if sorting is on
     *
     * @return bool
     */
    public function showSorting()
    {
        return $this->_blShowSorting && $this->getConfig()->getConfigParam( 'blShowSorting' );
    }

    /**
     * Set array of component objects
     *
     * @param array $aComponents array of components objects
     *
     * @return null
     */
    public function setComponents( $aComponents = null )
    {
        $this->_oaComponents = $aComponents;
    }

    /**
     * Get array of component objects
     *
     * @return array
     */
    public function getComponents()
    {
        return $this->_oaComponents;
    }

    /**
     * Set flag if current view is an order view
     *
     * @param bool $blIsOrderStep flag if current view is an order view
     *
     * @return null
     */
    public function setIsOrderStep( $blIsOrderStep = null )
    {
        $this->_blIsOrderStep = $blIsOrderStep;
    }

    /**
     * Get flag if current view is an order view
     *
     * @return bool
     */
    public function getIsOrderStep()
    {
        return $this->_blIsOrderStep;
    }


    /**
     * Active category setter
     *
     * @param oxcategory $oCategory active category
     *
     * @return null
     */
    public function setActiveCategory( $oCategory )
    {
        $this->_oActCategory = $oCategory;
    }

    /**
     * Returns active category
     *
     * @return null
     */
    public function getActiveCategory()
    {
        return $this->_oActCategory;
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
     * Get list type
     *
     * @return string list type
     */
    public function getListType()
    {
        if ( $this->_sListType == null && ( $sListType = oxConfig::getParameter( 'listtype' ) ) ) {
            $this->_sListType = $sListType;
        }
        return $this->_sListType;
    }

    /**
     * List type setter
     *
     * @param string $sType type of list
     *
     * @return null
     */
    public function setListType( $sType )
    {
        $this->_sListType = $sType;
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
     * Returns show right basket
     *
     * @return bool
     */
    public function showRightBasket()
    {
        if ( $this->_blShowRightBasket === null ) {
            if ( $blShowRightBasket = $this->getConfig()->getConfigParam( 'bl_perfShowRightBasket' ) ) {
                $this->_blShowRightBasket = $blShowRightBasket;
            }
        }
        return $this->_blShowRightBasket;
    }

    /**
     * Returns show right basket
     *
     * @param bool $blShowBasket if TRUE - right basket will be shown
     *
     * @return null
     */
    public function setShowRightBasket( $blShowBasket )
    {
        $this->_blShowRightBasket = $blShowBasket;
    }

    /**
     * Returns show left basket
     *
     * @return bool
     */
    public function showLeftBasket()
    {
        if ( $this->_blShowLeftBasket === null ) {
            if ( $blShowLeftBasket = $this->getConfig()->getConfigParam( 'bl_perfShowLeftBasket' ) ) {
                $this->_blShowLeftBasket = $blShowLeftBasket;
            }
        }
        return $this->_blShowLeftBasket;
    }

    /**
     * Returns show left basket
     *
     * @param bool $blShowBasket if TRUE - left basket will be shown
     *
     * @return null
     */
    public function setShowLeftBasket( $blShowBasket )
    {
        $this->_blShowLeftBasket = $blShowBasket;
    }

    /**
     * Returns show top basket
     *
     * @return bool
     */
    public function showTopBasket()
    {
        if ( $this->_blShowTopBasket === null ) {
            if ( $blShowTopBasket = $this->getConfig()->getConfigParam( 'bl_perfShowTopBasket' ) ) {
                $this->_blShowTopBasket = $blShowTopBasket;
            }
        }
        return $this->_blShowTopBasket;
    }

    /**
     * Returns show top basket
     *
     * @param bool $blShowBasket if TRUE - basket will be shown
     *
     * @return null
     */
    public function setShowTopBasket( $blShowBasket )
    {
        $this->_blShowTopBasket = $blShowBasket;
    }

    /**
     * Returns currency swiching option
     *
     * @return bool
     */
    public function loadCurrency()
    {
        if ( $this->_blLoadCurrency == null ) {
            $this->_blLoadCurrency = false;
            if ( $blLoadCurrency = $this->getConfig()->getConfigParam( 'bl_perfLoadCurrency' ) ) {
                $this->_blLoadCurrency = $blLoadCurrency;
            }
        }
        return $this->_blLoadCurrency;
    }

    /**
     * Returns if show/hide vendors
     *
     * @return bool
     */
    public function loadVendorTree()
    {
        if ( $this->_blLoadVendorTree == null ) {
            $this->_blLoadVendorTree = false;
            if ( $blLoadVendorTree = $this->getConfig()->getConfigParam( 'bl_perfLoadVendorTree' ) ) {
                $this->_blLoadVendorTree = $blLoadVendorTree;
            }
        }
        return $this->_blLoadVendorTree;
    }

    /**
     * Returns if show/hide Manufacturers
     *
     * @return bool
     */
    public function loadManufacturerTree()
    {
        if ( $this->_blLoadManufacturerTree == null ) {
            $this->_blLoadManufacturerTree = false;
            if ( $blLoadManufacturerTree = $this->getConfig()->getConfigParam( 'bl_perfLoadManufacturerTree' ) ) {
                $this->_blLoadManufacturerTree = $blLoadManufacturerTree;
            }
        }
        return $this->_blLoadManufacturerTree;
    }

    /**
     * Returns true if empty categories are not loaded
     *
     * @return bool
     */
    public function dontShowEmptyCategories()
    {
        if ( $this->_blDontShowEmptyCats == null ) {
            $this->_blDontShowEmptyCats = false;
            if ( $blDontShowEmptyCats = $this->getConfig()->getConfigParam( 'blDontShowEmptyCategories' ) ) {
                $this->_blDontShowEmptyCats = $blDontShowEmptyCats;
            }
        }
        return $this->_blDontShowEmptyCats;
    }

    /**
     * Returns if language should be loaded
     *
     * @return bool
     */
    public function isLanguageLoaded()
    {
        if ( $this->_blLoadLanguage == null ) {
            $this->_blLoadLanguage = false;
            if ( $blLoadLanguage = $this->getConfig()->getConfigParam( 'bl_perfLoadLanguages' ) ) {
                $this->_blLoadLanguage = $blLoadLanguage;
            }
        }
        return $this->_blLoadLanguage;
    }

    /**
     * Returns show/hide top navigation of categories
     *
     * @return bool
     */
    public function showTopCatNavigation()
    {
        if ( $this->_blShowTopCatNav == null ) {
            $this->_blShowTopCatNav = false;
            if ( $blShowTopCatNav = $this->getConfig()->getConfigParam( 'blTopNaviLayout' ) ) {
                $this->_blShowTopCatNav = $blShowTopCatNav;
            }
        }
        return $this->_blShowTopCatNav;
    }

    /**
     * Returns item count in top navigation of categories
     *
     * @return integer
     */
    public function getTopNavigationCatCnt()
    {
        if ( $this->_iTopCatNavItmCnt == null ) {
            $iTopCatNavItmCnt = $this->getConfig()->getConfigParam( 'iTopNaviCatCount' );
            $this->_iTopCatNavItmCnt = $iTopCatNavItmCnt ? $iTopCatNavItmCnt : 5;
        }
        return $this->_iTopCatNavItmCnt;
    }

    /**
     * addRssFeed adds link to rss
     *
     * @param string $sTitle feed page title
     * @param string $sUrl   feed url
     * @param int    $key    feed number
     *
     * @return null
     */
    public function addRssFeed($sTitle, $sUrl, $key = null)
    {
        if (!is_array($this->_aRssLinks)) {
            $this->_aRssLinks = array();
        }
        if ($key === null) {
            $this->_aRssLinks[] = array('title'=>$sTitle, 'link' => $sUrl);
        } else {
            $this->_aRssLinks[$key] = array('title'=>$sTitle, 'link' => $sUrl);
        }

        $this->_aViewData['rsslinks'] = $this->getRssLinks();
    }

    /**
     * Retrieves from session or gets new sorting parameters for
     * search and category lists. Sets new sorting parameters
     * (reverse or new column sort) to session.
     *
     * Template variables:
     * <b>showsorting</b>, <b>listorderby</b>, <b>listorder</b>,
     * <b>allsortcolumns</b>
     *
     * Session variables:
     * <b>listorderby</b>, <b>listorder</b>
     *
     * @return null
     */
    public function prepareSortColumns()
    {
        $aSortColumns = $this->getConfig()->getConfigParam( 'aSortCols' );
        if ( count( $aSortColumns ) > 0 ) {

            $this->_blActiveSorting = true;
            $this->_aSortColumns = $aSortColumns;

            $sCnid = oxConfig::getParameter( 'cnid' );

            $sSortBy  = oxConfig::getParameter( 'listorderby' );
            $sSortDir = oxConfig::getParameter( 'listorder' );

            if ( !$sSortBy && $aSorting = $this->getSorting( $sCnid ) ) {
                $sSortBy  = $aSorting['sortby'];
                $sSortDir = $aSorting['sortdir'];
            }

            if ( $sSortBy && oxDb::getInstance()->isValidFieldName( $sSortBy ) &&
                 $sSortDir && oxUtils::getInstance()->isValidAlpha( $sSortDir ) ) {

                $this->_sListOrderBy  = $sSortBy;
                $this->_sListOrderDir = $sSortDir;

                // caching sorting config
                $this->setItemSorting( $sCnid, $sSortBy, $sSortDir );
            }
        }
    }

    /**
     * Template variable getter. Returns string after the list is ordered by
     *
     * @return array
     */
    public function getListOrderBy()
    {
        return $this->_sListOrderBy;
    }

    /**
     * Template variable getter. Returns list order direction
     *
     * @return array
     */
    public function getListOrderDirection()
    {
        return $this->_sListOrderDir;
    }

    /**
     * Sets the view parameter "meta_description"
     *
     * @param string $sDescription prepared string for description
     *
     * @return null
     */
    public function setMetaDescription ( $sDescription )
    {
        return $this->_sMetaDescription = $sDescription;
    }

    /**
     * Sets the view parameter 'meta_keywords'
     *
     * @param string $sKeywords prepared string for meta keywords
     *
     * @return null
     */
    public function setMetaKeywords( $sKeywords )
    {
        return $this->_sMetaKeywords = $sKeywords;
    }

    /**
     * Template variable getter. Returns meta keywords
     *
     * @return string
     */
    public function getMetaKeywords()
    {
        if ( $this->_sMetaKeywords === null ) {
            $this->_sMetaKeywords = false;
            // set special meta keywords ?
            if ( oxUtils::getInstance()->seoIsActive() && ( $sOxid = $this->_getSeoObjectId() ) &&
                 ( $sKeywords = oxSeoEncoder::getInstance()->getMetaData( $sOxid, 'oxkeywords' ) ) ) {
                return $this->_sMetaKeywords = $sKeywords;
            } elseif ( $this->_sMetaKeywordsIdent ) {
                $oContent = oxNew( 'oxcontent' );
                if ( $oContent->loadByIdent( $this->_sMetaKeywordsIdent ) && $oContent->oxcontents__oxactive->value ) {
                    $this->_sMetaKeywords = strip_tags( $oContent->oxcontents__oxcontent->value );
                }
            }
            $this->_sMetaKeywords = $this->_prepareMetaKeyword( $this->_sMetaKeywords );
        }
        return $this->_sMetaKeywords;
    }

    /**
     * Template variable getter. Returns meta description
     *
     * @return string
     */
    public function getMetaDescription()
    {
        if ( $this->_sMetaDescription === null ) {
            $this->_sMetaDescription = false;
            // set special meta description ?
            if ( oxUtils::getInstance()->seoIsActive() && ( $sOxid = $this->_getSeoObjectId() ) &&
                 ( $sMeta = oxSeoEncoder::getInstance()->getMetaData( $sOxid, 'oxdescription' ) ) ) {
                return $this->_sMetaDescription = $sMeta;
            } elseif ( $this->_sMetaDescriptionIdent ) {
                $oContent = oxNew( 'oxcontent' );
                if ( $oContent->loadByIdent( $this->_sMetaDescriptionIdent ) && $oContent->oxcontents__oxactive->value ) {
                    $this->_sMetaDescription = strip_tags( $oContent->oxcontents__oxcontent->value );
                }
            }
            $this->_sMetaDescription = $this->_prepareMetaDescription( $this->_sMetaDescription );
        }
        return $this->_sMetaDescription;
    }

    /**
     * Get active language
     *
     * @return object
     */
    public function getActCurrency()
    {
        return $this->_oActCurrency;
    }

    /**
     * Active language setter
     *
     * @param object $oCur corrency object
     *
     * @return object
     */
    public function setActCurrency( $oCur )
    {
        $this->_oActCurrency = $oCur;
    }

    /**
     * Template variable getter. Returns article list count in comparison
     *
     * @return integer
     */
    public function getCompareItemsCnt()
    {
        return $this->_iCompItemsCnt;
    }

    /**
     * Articlelist count in comparison setter
     *
     * @param integer $iCount compare items count
     *
     * @return integer
     */
    public function setCompareItemsCnt( $iCount )
    {
        $this->_iCompItemsCnt = $iCount;
    }

    /**
     * Template variable getter. Returns user name of searched wishlist
     *
     * @return string
     */
    public function getWishlistName()
    {
        return $this->_sWishlistName;
    }

    /**
     * Sets user name of searched wishlist
     *
     * @param string $sName wishlist name
     *
     * @return null
     */
    public function setWishlistName( $sName )
    {
        $this->_sWishlistName = $sName;
    }

    /**
     * Forces output noindex meta data for current view
     *
     * @return null
     */
    protected function _forceNoIndex()
    {
        $this->_blForceNoIndex = true;
    }

    /**
     * Marks that current view is marked as noindex, nofollow and
     * article details links must contain nofollow tags
     *
     * @return int
     */
    public function noIndex()
    {
        if ( $this->_blForceNoIndex ) {
            $this->_iViewIndexState = VIEW_INDEXSTATE_NOINDEXFOLLOW;
        } elseif ( oxConfig::getParameter( 'cur' ) ) {
            $this->_iViewIndexState = VIEW_INDEXSTATE_NOINDEXNOFOLLOW;
        } else {
            switch ( oxConfig::getParameter( 'fnc' ) ) {
                case 'tocomparelist':
                case 'tobasket':
                    $this->_iViewIndexState = VIEW_INDEXSTATE_NOINDEXNOFOLLOW;
                    break;
            }
        }
        return $this->_iViewIndexState;
    }

    /**
     * Returns "impressum" content ID used by template engine.
     * Used, when no content id specified in template
     *
     * @return string
     */
    public function getContentId()
    {
        if ( $this->_sContentId === null) {
            $oContent = oxNew( 'oxcontent' );
            $oContent->loadByIdent( 'oximpressum' );
            $this->_sContentId = $oContent->getId();
        }

        return $this->_sContentId;
    }

    /**
     * Returns "impressum" content as default content when
     * no content id specified in template
     *
     * @return object
     */
    public function getContent()
    {
        if ( $this->_oContent === null) {
            $oContent = oxNew( 'oxcontent' );
            if ( $oContent->load( $this->getContentId() ) && $oContent->oxcontents__oxactive->value ) {
                $this->_oContent = $oContent;
            }
        }

        return $this->_oContent;
    }

    /**
     * Returns if sorting is active and can be displayed
     *
     * @return bool
     */
    public function isSortingActive()
    {
        return $this->_blActiveSorting;
    }

    /**
     * Template variable getter. Returns header menue list
     *
     * @return array
     */
    public function getMenueList()
    {
        return $this->_aMenueList;
    }

    /**
     * Header menue list setter
     *
     * @param array $aMenue menu list
     *
     * @return null
     */
    public function setMenueList( $aMenue )
    {
        $this->_aMenueList = $aMenue;
    }


    /**
     * Sets number of articles per page to config value
     *
     * @return null
     */
    protected function _setNrOfArtPerPage()
    {
        $myConfig  = $this->getConfig();
        $aViewData = array();

        //setting default values to avoid possible errors showing article list
        $iNrofCatArticles = $myConfig->getConfigParam( 'iNrofCatArticles' );
        $iNrofCatArticles = ( $iNrofCatArticles) ? $iNrofCatArticles : 10;

        // checking if all needed data is set
        $aNrofCatArticles = $myConfig->getConfigParam( 'aNrofCatArticles' );
        if ( !is_array( $aNrofCatArticles ) || !isset( $aNrofCatArticles[0] ) ) {
            $myConfig->setConfigParam( 'aNrofCatArticles', array( $iNrofCatArticles ) );
        } else {
            $iNrofCatArticles = $aNrofCatArticles[0];
        }

        $oViewConf = $this->getViewConfig();
        //value from user input
        if ( ( $iUserArtPerPage = (int) oxConfig::getParameter( '_artperpage' ) ) ) {
            // performing floor() to skip such variants as 7.5 etc
            $iNrofArticles = ( $iUserArtPerPage > 100 ) ? 10 : abs( $iUserArtPerPage );
            // M45 Possibility to push any "Show articles per page" number parameter
            $iNrofCatArticles = ( in_array( $iNrofArticles, $aNrofCatArticles ) ) ? $iNrofArticles : $iNrofCatArticles;
            $oViewConf->setViewConfigParam( 'iartPerPage', $iNrofCatArticles );
            oxSession::setVar( '_artperpage', $iNrofCatArticles );
        } elseif ( ( $iSessArtPerPage = oxSession::getVar( '_artperpage' ) )&& is_numeric( $iSessArtPerPage ) ) {
            // M45 Possibility to push any "Show articles per page" number parameter
            $iNrofCatArticles = ( in_array( $iSessArtPerPage, $aNrofCatArticles ) ) ? $iSessArtPerPage : $iNrofCatArticles;
            $oViewConf->setViewConfigParam( 'iartPerPage', $iSessArtPerPage );
            $iNrofCatArticles = $iSessArtPerPage;
        } else {
            $oViewConf->setViewConfigParam( 'iartPerPage', $iNrofCatArticles );
        }

        //setting number of articles per page to config value
        $myConfig->setConfigParam( 'iNrofCatArticles', $iNrofCatArticles );

        $this->_aViewData = array_merge( $this->_aViewData, $aViewData );
    }

    /**
     * Override this function to return object it which is used to identify its seo meta info
     *
     * @return null
     */
    protected function _getSeoObjectId()
    {
    }

    /**
     * Returns current view meta description data
     *
     * @param string $sMeta     category path
     * @param int    $iLength   max length of result, -1 for no truncation
     * @param bool   $blDescTag if true - performs additional dublicate cleaning
     *
     * @return  string  $sString    converted string
     */
    protected function _prepareMetaDescription( $sMeta, $iLength = 1024, $blDescTag = false )
    {
        if ( $sMeta ) {

            $oStr = getStr();
            if ( $iLength != -1 ) {
                /* *
                 * performance - we dont need a huge amount of initial text.
                 * assume that effective text may be double longer than $iLength
                 * and simple turncate it
                 */
                $iELength = ( $iLength * 2 );
                $sMeta = $oStr->substr( $sMeta, 0, $iELength );
            }

            // decoding html entities
            $sMeta = $oStr->html_entity_decode( $sMeta );
            // stripping HTML tags
            $sMeta = strip_tags( $sMeta );

            // removing some special chars
            $sMeta = $oStr->cleanStr( $sMeta );

            // removing duplicate words
            if ( !$blDescTag ) {
                $sMeta = $this->_removeDuplicatedWords( $sMeta );
            }

            // some special cases
            $sMeta = str_replace( ' ,', ',', $sMeta );
            $aPattern = array( "/,[\s\+\-\*]*,/", "/\s+,/" );
            $sMeta = preg_replace( $aPattern, ',', $sMeta );
            $sMeta = oxUtilsString::getInstance()->minimizeTruncateString( $sMeta, $iLength );

            return trim( $sMeta );
        }
    }

    /**
     * Returns current view keywords seperated by comma
     *
     * @param string $sKeywords data to use as keywords
     *
     * @return string of keywords seperated by comma
     */
    protected function _prepareMetaKeyword( $sKeywords )
    {
        $sString = $this->_prepareMetaDescription( $sKeywords, -1, true );
        $sString = $this->_removeDuplicatedWords( $sString );
        // removing in admin defined strings
        $aSkipTags = $this->getConfig()->getConfigParam( 'aSkipTags' );
        if ( is_array( $aSkipTags ) && $sString ) {
            $oStr = getStr();
            foreach ( $aSkipTags as $sSkip ) {
                //$aPattern = array( '/\W'.$sSkip.'\W/iu', '/^'.$sSkip.'\W/iu', '/\"'.$sSkip.'$/iu' );
                //$aPattern = array( '/\s+'.$sSkip.'\,/iu', '/^'.$sSkip.'\s+/iu', '/\"\s+'.$sSkip.'$/iu' );
                $aPattern = array( '/\s+'.$sSkip.'\,/i', '/^'.$sSkip.',\s+/i', '/\",\s+'.$sSkip.'$/i' );
                $sString  = $oStr->preg_replace( $aPattern, '', $sString );
            }
        }
        return trim( $sString );
    }

    /**
     * Removes duplicated words (not case sensitive)
     *
     * @param mixed $aInput array of string or string
     *
     * @return string of words seperated by comma
     */
    protected function _removeDuplicatedWords( $aInput )
    {
        $oStr = getStr();
        if ( is_array( $aInput ) ) {
            $aStrings = $aInput;
        } else {
            //is String
            $aStrings = $oStr->preg_split( "/[\s,]+/", $aInput );
        }

        foreach ( $aStrings as $iANum => $sAString ) {
            $sAString = $oStr->strtolower( $sAString );
            foreach ( $aStrings as $iBNum => $sBString ) {
                // duplicates
                $sBString = $oStr->strtolower( $sBString );
                if ( $sAString && $iANum != $iBNum && strcmp( $sAString, $sBString ) === 0 ) {
                    unset( $aStrings[$iANum] );
                }
            }
        }

        return implode( ', ', $aStrings );
    }

    /**
     * Returns array of params => values which are used in hidden forms and as additional url params.
     * NOTICE: this method SHOULD return raw (non encoded into entities) parameters, because values
     * are processed by htmlentities() to avoid security and brokent templates problems
     *
     * @return array
     */
    public function getNavigationParams()
    {
        $aParams['cnid'] = $this->getCategoryId();
        $aParams['mnid'] = oxConfig::getParameter( 'mnid' );

        $aParams['listtype'] = $this->getListType();
        $aParams['recommid'] = oxConfig::getParameter( 'recommid' );

        $aParams['searchrecomm'] = oxConfig::getParameter( 'searchrecomm', true );
        $aParams['searchparam']  = oxConfig::getParameter( 'searchparam', true );
        $aParams['searchtag']    = oxConfig::getParameter( 'searchtag', true );

        $aParams['searchvendor'] = oxConfig::getParameter( 'searchvendor' );
        $aParams['searchcnid']   = oxConfig::getParameter( 'searchcnid' );
        $aParams['searchmanufacturer'] = oxConfig::getParameter( 'searchmanufacturer' );

        return $aParams;
    }

    /**
     * Sets sorting item config
     *
     * @param string $sCnid    sortable item id
     * @param string $sSortBy  sort field
     * @param string $sSortDir sort direction (optional)
     *
     * @return null
     */
    public function setItemSorting( $sCnid, $sSortBy, $sSortDir = null )
    {
        $aSorting = oxSession::getVar( 'aSorting' );
        $aSorting[$sCnid]['sortby']  = $sSortBy;
        $aSorting[$sCnid]['sortdir'] = $sSortDir?$sSortDir:null;

        oxSession::setVar( 'aSorting', $aSorting );
    }

    /**
     * Returns sorting config for current item
     *
     * @param string $sCnid sortable item id
     *
     * @return string
     */
    public function getSorting( $sCnid )
    {
        $aSorting = oxSession::getVar( 'aSorting' );
        if ( isset( $aSorting[$sCnid] ) ) {
            return $aSorting[$sCnid];
        }
    }

    /**
     * Returns part of SQL query with sorting params
     *
     * @param string $sCnid sortable item id
     *
     * @return string
     */
    public function getSortingSql( $sCnid )
    {
        $aSorting = $this->getSorting( $sCnid );
        if ( is_array( $aSorting ) ) {
            return implode( " ", $aSorting );
        }
    }

    /**
     * Returns title suffix used in template
     *
     * @return string
     */
    public function getTitleSuffix()
    {
        return $this->getConfig()->getActiveShop()->oxshops__oxtitlesuffix->value;
    }

    /**
     * Returns title prefix used in template
     *
     * @return string
     *
     */
    public function getTitlePrefix()
    {
        return $this->getConfig()->getActiveShop()->oxshops__oxtitleprefix->value;
    }

    /**
     * returns object, assosiated with current view.
     * (the object that is shown in frontend)
     *
     * @return object
     */
    protected function _getSubject()
    {
        return null;
    }

    /**
     * returns additional url params for dynamic url building
     *
     * @return string
     */
    public function getDynUrlParams()
    {
        $sRet = '';
        $sListType = $this->getListType();

        switch ($sListType) {
            default:
                break;
            case 'search':
                $sRet .= "&amp;listtype={$sListType}";
                if ( $sSearchParamForLink = rawurlencode( oxConfig::getParameter( 'searchparam', true ) ) ) {
                    $sRet .= "&amp;searchparam={$sSearchParamForLink}";
                }

                if ( ( $sVar = oxConfig::getParameter( 'searchcnid' ) ) ) {
                    $sRet .= '&amp;searchcnid='.rawurlencode( rawurldecode( $sVar ) );
                }
                if ( ( $sVar = oxConfig::getParameter( 'searchvendor' ) ) ) {
                    $sRet .= '&amp;searchvendor='.rawurlencode( rawurldecode( $sVar ) );
                }
                if ( ( $sVar = oxConfig::getParameter( 'searchmanufacturer' ) ) ) {
                    $sRet .= '&amp;searchmanufacturer='.rawurlencode( rawurldecode( $sVar ) );
                }
                break;
            case 'tag':
                $sRet .= "&amp;listtype={$sListType}";
                if ( $sParam = rawurlencode( oxConfig::getParameter( 'searchtag', 1 ) ) ) {
                    $sRet .= "&amp;searchtag={$sParam}";
                }
                break;
        }

        return $sRet;
    }

    /**
     * get link of current view
     *
     * @param int $iLang requested language
     *
     * @return string
     */
    public function getLink( $iLang = null )
    {
        if ( !isset( $iLang ) ) {
            $iLang = oxLang::getInstance()->getBaseLanguage();
        }

        $oDisplayObj = null;
        if ( oxUtils::getInstance()->seoIsActive() ) {
            $blTrySeo = true;
            $oDisplayObj = $this->_getSubject();
        }
        $iActPageNr = $this->getActPage();

        if ( $oDisplayObj ) {

            // if languages do not match object must be reload, but reference to view object should be broken
            if ( $oDisplayObj->getLanguage() != $iLang ) {
                $sOxId = $oDisplayObj->getId();
                $oDisplayObj = oxNew( $oDisplayObj->getClassName() );
                $oDisplayObj->load( $sOxId );
            }

            return $this->_addPageNrParam( $oDisplayObj->getLink( $iLang ), $iActPageNr, $iLang );
        } else {
            $myConfig = $this->getConfig();

            if ( $blTrySeo ) {
                $oEncoder = oxSeoEncoder::getInstance();
                if ( ( $sSeoUrl = $oEncoder->getStaticUrl( $myConfig->getShopHomeURL( $iLang ) . $this->_getSeoRequestParams(), $iLang ) ) ) {
                    return $this->_addPageNrParam( $sSeoUrl, $iActPageNr, $iLang );
                }
            }

            $sForceLangChange = '';
            if ( oxLang::getInstance()->getBaseLanguage() != $iLang ) {
                $sForceLangChange = "&amp;lang={$iLang}";
            }

            // fallback to old non seo url
            return $this->_addPageNrParam( $myConfig->getShopCurrentURL( $iLang ) . $this->_getRequestParams() . $sForceLangChange, $iActPageNr, $iLang );
        }
    }

    /**
     * Returns similar recommendation list
     * So far this method is implemented in Details (details.php) view.
     *
     * @return null
     */
    public function getSimilarRecommLists()
    {
    }

    /**
     * collects _GET parameters used by eShop and returns uri
     *
     * @param bool $blAddPageNr if TRUE - page number will be added
     *
     * @return string
     */
    protected function _getRequestParams( $blAddPageNr  = true )
    {
        $sClass = $this->getClassName();
        $sFnc   = $this->getFncName();

        // #921 S
        $aFnc = array( 'tobasket', 'login_noredirect', 'addVoucher' );
        if ( in_array( $sFnc, $aFnc ) ) {
            $sFnc = '';
        }

        // #680
        $sURL = "cl={$sClass}";
        if ( $sFnc ) {
            $sURL .= "&amp;fnc={$sFnc}";
        }
        if ( $sVal = oxConfig::getParameter( 'cnid' ) ) {
            $sURL .= "&amp;cnid={$sVal}";
        }
        if ( $sVal = oxConfig::getParameter( 'mnid' ) ) {
            $sURL .= "&amp;mnid={$sVal}";
        }
        if ( $sVal= oxConfig::getParameter( 'anid' ) ) {
            $sURL .= "&amp;anid={$sVal}";
        }

        if ( $sVal = basename( oxConfig::getParameter( 'page' ) ) ) {
            $sURL .= "&amp;page={$sVal}";
        }

        if ( $sVal = basename( oxConfig::getParameter( 'tpl' ) ) ) {
            $sURL .= "&amp;tpl={$sVal}";
        }

        $iPgNr = (int) oxConfig::getParameter( 'pgNr' );
        // don't include page number for navigation
        // it will be done in oxubase::generatePageNavigation
        if ( $blAddPageNr && $iPgNr > 0 ) {
            $sURL .= "&amp;pgNr={$iPgNr}";
        }

        // #1184M - specialchar search
        if ( $sVal = rawurlencode( oxConfig::getParameter( 'searchparam', true ) ) ) {
            $sURL .= "&amp;searchparam={$sVal}";
        }

        if ( $sVal = oxConfig::getParameter( 'searchcnid' ) ) {
            $sURL .= "&amp;searchcnid={$sVal}";
        }

        if ( $sVal = oxConfig::getParameter( 'searchvendor' ) ) {
            $sURL .= "&amp;searchvendor={$sVal}";
        }

        if ( $sVal = oxConfig::getParameter( 'searchmanufacturer' ) ) {
            $sURL .= "&amp;searchmanufacturer={$sVal}";
        }

        if ( $sVal = oxConfig::getParameter( 'searchrecomm' ) ) {
            $sURL .= "&amp;searchrecomm={$sVal}";
        }

        if ( $sVal = oxConfig::getParameter( 'searchtag' ) ) {
            $sURL .= "&amp;searchtag={$sVal}";
        }

        if ( $sVal = oxConfig::getParameter( 'recommid' ) ) {
            $sURL .= "&amp;recommid={$sVal}";
        }

        return $sURL;
    }

    /**
     * collects _GET parameters used by eShop SEO and returns uri
     *
     * @return string
     */
    protected function _getSeoRequestParams()
    {
        $sClass = $this->getClassName();
        $sFnc   = $this->getFncName();

        // #921 S
        $aFnc = array( 'tobasket', 'login_noredirect', 'addVoucher' );
        if ( in_array( $sFnc, $aFnc ) ) {
            $sFnc = '';
        }

        // #680
        $sURL = "cl={$sClass}";
        if ( $sFnc ) {
            $sURL .= "&amp;fnc={$sFnc}";
        }
        if ( $sVal = basename( oxConfig::getParameter( 'page' ) ) ) {
            $sURL .= "&amp;page={$sVal}";
        }

        if ( $sVal = basename( oxConfig::getParameter( 'tpl' ) ) ) {
            $sURL .= "&amp;tpl={$sVal}";
        }

        $iPgNr = (int) oxConfig::getParameter( 'pgNr' );
        if ( $iPgNr > 0 ) {
            $sURL .= "&amp;pgNr={$iPgNr}";
        }

        return $sURL;
    }

    /**
     * Returns show category search
     *
     * @return bool
     */
    public function showSearch()
    {
        $blShow = true;
        if ( $this->getConfig()->getConfigParam( 'blDisableNavBars' ) && $this->getIsOrderStep() ) {
            $blShow = false;
        }
        return (int) $blShow;
    }

    /**
     * Returns RSS links
     *
     * @return array
     */
    public function getRssLinks()
    {
        return $this->_aRssLinks;
    }

    /**
     * Template variable getter. Returns sorting columns
     *
     * @return array
     */
    public function getSortColumns()
    {
        return $this->_aSortColumns;
    }

    /**
     * Returns if tags will be edit
     *
     * @return bool
     */
    public function getEditTags()
    {
    }

    /**
     * Template variable getter. Returns search string
     *
     * @return string
     */
    public function getRecommSearch()
    {
    }

    /**
     * Template variable getter. Returns review user id
     *
     * @return string
     */
    public function getReviewUserId()
    {
    }

    /**
     * Template variable getter. Returns payment id
     *
     * @return string
     */
    public function getPaymentList()
    {
    }

    /**
     * Template variable getter. Returns active recommendation lists
     *
     * @return string
     */
    public function getActiveRecommList()
    {
    }

    /**
     * Template variable getter. Returns accessoires of article
     *
     * @return object
     */
    public function getAccessoires()
    {
    }

    /**
     * Template variable getter. Returns crosssellings
     *
     * @return object
     */
    public function getCrossSelling()
    {
    }

    /**
     * Template variable getter. Returns similar article list
     *
     * @return object
     */
    public function getSimilarProducts()
    {
    }

    /**
     * Template variable getter. Returns list of customer also bought thies products
     *
     * @return object
     */
    public function getAlsoBoughtThiesProducts()
    {
    }

    /**
     * Return the active article id
     *
     * @return string | bool
     */
    public function getArticleId()
    {
    }

    /**
     * Should "More tags" link be visible.
     *
     * @return bool
     */
    public function isMoreTagsVisible()
    {
        return false;
    }

    /**
     * Returns current view title. Default is null
     *
     * @return null
     */
    public function getTitle()
    {
    }

    /**
     * Returns active lang suffix
     *
     * @return string
     */
    public function getActiveLangAbbr()
    {
        // Performance
        if ( !$this->getConfig()->getConfigParam( 'bl_perfLoadLanguages' ) ) {
            return;
        }

        if ( !isset($this->_sActiveLangAbbr ) ) {
            $aLanguages = oxLang::getInstance()->getLanguageArray();
            while ( list( $sKey, $oVal ) = each( $aLanguages ) ) {
                if ( $oVal->selected ) {
                    $this->_sActiveLangAbbr = $oVal->abbr;
                    break;
                }
            }
        }

        return $this->_sActiveLangAbbr;
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
        $myConfig = $this->getConfig();

        $oViewConf = parent::addGlobalParams( $oShop );

        $this->_aViewData['isfiltering'] = true;
        $this->_aViewData['isnewsletter'] = true;
        $this->_aViewData['isvarianten'] = true;
        $this->_aViewData['isreview'] = true;
        $this->_aViewData['isaddsales'] = true;
        $this->_aViewData['isvoucher'] = true;
        $this->_aViewData['ispricealarm'] = true;
        $this->_aViewData['iswishlist'] = true;
        $this->_aViewData['isipayment'] = true;
        $this->_aViewData['istrusted'] = true;
        $this->_aViewData['isfiltering'] = true;
        $this->_aViewData['isgooglestats'] = true;
        $this->_aViewData['iswishlist'] = true;


        // show baskets
        $this->_aViewData['bl_perfShowLeftBasket']  = $this->showLeftBasket();
        $this->_aViewData['bl_perfShowRightBasket'] = $this->showRightBasket();
        $this->_aViewData['bl_perfShowTopBasket']   = $this->showTopBasket();

        // allow currency swiching
        $this->_aViewData['bl_perfLoadCurrency'] = $this->loadCurrency();

        // show/hide vendors
        $this->_aViewData['bl_perfLoadVendorTree'] = $this->loadVendorTree();

        // show/hide Manufacturers
        $this->_aViewData['bl_perfLoadManufacturerTree'] = $this->loadManufacturerTree();

        // show/hide empty categories
        $this->_aViewData['blDontShowEmptyCategories'] = $this->dontShowEmptyCategories();

        $this->_aViewData['iShopID_TrustedShops'] = $this->getTrustedShopId();

        // used for compatibility with older templates
        $this->_aViewData['fixedwidth'] = $myConfig->getConfigParam( 'blFixedWidthLayout' );
        $this->_aViewData['urlsign']    = '&';
        $this->_aViewData['wishid']    = oxConfig::getParameter( 'wishid' );
        $this->_aViewData['shownewbasketmessage'] = oxUtils::getInstance()->isSearchEngine()?0:$myConfig->getConfigParam( 'iNewBasketItemMessage' );

        $this->_aViewData['sListType'] = $this->getListType();
        $this->_aViewData['bl_perfLoadLanguage'] = $this->isLanguageLoaded();

        // new navigation ?
        $this->_aViewData['showtopcatnavigation']   = $this->showTopCatNavigation();
        $this->_aViewData['topcatnavigationitmcnt'] = $this->getTopNavigationCatCnt();

        $this->_setNrOfArtPerPage();


        return $oViewConf;
    }

    /**
     * Template variable getter. Returns additional params for url
     *
     * @return string
     */
    public function getAdditionalParams()
    {
        if ( $this->_sAdditionalParams === null ) {
            // #1018A
            $this->_sAdditionalParams  = parent::getAdditionalParams();
            $this->_sAdditionalParams .= 'cl='.$this->getConfig()->getActiveView()->getClassName();

            // #1834M - specialchar search
            $sSearchParamForLink = rawurlencode( oxConfig::getParameter( 'searchparam', true ) );
            if ( isset( $sSearchParamForLink ) ) {
                $this->_sAdditionalParams .= "&amp;searchparam={$sSearchParamForLink}";
            }
            if ( ( $sVar = oxConfig::getParameter( 'searchtag' ) ) ) {
                $this->_sAdditionalParams .= '&amp;searchtag='.rawurlencode( rawurldecode( $sVar ) );
            }
            if ( ( $sVar = oxConfig::getParameter( 'searchcnid' ) ) ) {
                $this->_sAdditionalParams .= '&amp;searchcnid='.rawurlencode( rawurldecode( $sVar ) );
            }
            if ( ( $sVar = oxConfig::getParameter( 'searchvendor' ) ) ) {
                $this->_sAdditionalParams .= '&amp;searchvendor='.rawurlencode( rawurldecode( $sVar ) );
            }
            if ( ( $sVar = oxConfig::getParameter( 'searchmanufacturer' ) ) ) {
                $this->_sAdditionalParams .= '&amp;searchmanufacturer='.rawurlencode( rawurldecode( $sVar ) );
            }
            if ( ( $sVar = oxConfig::getParameter( 'cnid' ) ) ) {
                $this->_sAdditionalParams .= '&amp;cnid='.rawurlencode( rawurldecode( $sVar ) );
            }
            if ( ( $sVar = oxConfig::getParameter( 'mnid' ) ) ) {
                $this->_sAdditionalParams .= '&amp;mnid='.rawurlencode( rawurldecode( $sVar ) );
            }
        }

        return $this->_sAdditionalParams;
    }

    /**
     * Sets active list type if it was not set by request
     *
     * @return null
     */
    protected function _setListType()
    {
        if ( !oxConfig::getParameter( 'listtype' ) && isset( $this->_sListType ) ) {
            $this->getConfig()->setGlobalParameter( 'listtype', $this->_sListType );
        }
    }

    /**
     * Generates URL for page navigation
     *
     * @return string $sUrl String with working page url.
     */
    public function generatePageNavigationUrl()
    {
        // $sClass = $this->_sThisAction;
        return $this->getConfig()->getShopHomeURL().$this->_getRequestParams( false );
    }

    /**
     * Adds page number parameter to url and returns modified url
     *
     * @param string $sUrl  url to add page number
     * @param string $iPage active page number
     * @param int    $iLang language id
     *
     * @return string
     */
    protected function _addPageNrParam( $sUrl, $iPage, $iLang = null )
    {
        if ( $iPage ) {
            $sUrl .= ( ( strpos( $sUrl, '?' ) === false ) ? '?' : '&amp;' ) . 'pgNr='.$iPage;
        }
        return $sUrl;
    }

    /**
     * Generates variables for page navigation
     *
     * @return  stdClass    $pageNavigation Object with pagenavigation data
     */
    public function generatePageNavigation( )
    {
        startProfile('generatePageNavigation');
        // generate the page navigation
        $pageNavigation = new stdClass();
        $pageNavigation->NrOfPages = $this->_iCntPages;
        $pageNavigation->iArtCnt   = $this->_iAllArtCnt;
        $iActPage = $this->getActPage();
        $pageNavigation->actPage   = $iActPage + 1;

        $sUrl = $this->generatePageNavigationUrl( );

        if ( $iActPage > 0) {
            $pageNavigation->previousPage = $this->_addPageNrParam( $sUrl, $iActPage - 1 );
        }

        if ( $iActPage < $pageNavigation->NrOfPages - 1 ) {
            $pageNavigation->nextPage = $this->_addPageNrParam( $sUrl, $iActPage + 1 );
        }

        if ( $pageNavigation->NrOfPages > 1 ) {
            for ( $i=1; $i < $pageNavigation->NrOfPages + 1; $i++ ) {
                $page = new Oxstdclass();
                $page->url = $this->_addPageNrParam( $sUrl, $i - 1 );
                $page->selected = 0;
                if ( $i == $pageNavigation->actPage ) {
                    $page->selected = 1;
                }
                $pageNavigation->changePage[$i] = $page;
            }

            // first/last one
            $pageNavigation->firstpage = $this->_addPageNrParam( $sUrl, 0 );
            $pageNavigation->lastpage  = $this->_addPageNrParam( $sUrl, $pageNavigation->NrOfPages - 1 );
        }

        stopProfile('generatePageNavigation');

        return $pageNavigation;
    }

    /**
     * performs setup of aViewData according to iMinOrderPrice admin setting
     *
     * @return null
     */
    public function prepareMinimumOrderPrice4View()
    {
        $myConfig = $this->getConfig();
        $iMinOrderPrice = $myConfig->getConfigParam( 'iMinOrderPrice' );
        if ( isset( $iMinOrderPrice ) && $iMinOrderPrice) {
            $oBasket = $this->getSession()->getBasket();
            if ( !$oBasket || ( $oBasket && !$oBasket->getProductsCount() ) ) {
                return;
            }
            $oCur    = $myConfig->getActShopCurrencyObject();
            $dMinOrderPrice = $iMinOrderPrice * $oCur->rate;
            // Coupons and discounts should be considered in "Min order price" check
            if ( $dMinOrderPrice > ( $oBasket->getDiscountProductsPrice()->getBruttoSum() - $oBasket->getTotalDiscount()->getBruttoPrice() - $oBasket->getVoucherDiscount()->getBruttoPrice()) ) {
                $this->_iLowOrderPrice = 1;
                $this->_sMinOrderPrice = oxLang::getInstance()->formatCurrency( $dMinOrderPrice, $oCur );
            }
        }
    }

    /**
     * While ordering disables navigation controls if oxConfig::blDisableNavBars
     * is on and executes parent::render()
     *
     * @return null
     */
    public function render()
    {
        foreach ( array_keys( $this->_oaComponents ) as $sComponentName ) {
            $this->_aViewData[$sComponentName] = $this->_oaComponents[$sComponentName]->render();
        }

        parent::render();

        if ( $this->getIsOrderStep() ) {

            // min. order price check
            $this->prepareMinimumOrderPrice4View();

            // disabling navigation during order ...
            if ( $this->getConfig()->getConfigParam( 'blDisableNavBars' ) ) {
                $this->_iNewsRealStatus = 1;
                $this->setShowNewsletter( 0 );
                // for old tpl. will be removed later
                $this->_aViewData['isnewsletter'] = 0;
                $this->setShowRightBasket( 0 );
                $this->setShowLeftBasket( 0 );
                $this->setShowTopBasket( 0 );
            }
            $this->_aViewData['loworderprice'] = $this->isLowOrderPrice();
            $this->_aViewData['minorderprice'] = $this->getMinOrderPrice();
        }

        // meta data
        $this->_aViewData['meta_description'] = $this->getMetaDescription();
        $this->_aViewData['meta_keywords']    = $this->getMetaKeywords();

        // show baskets
        $this->_aViewData['bl_perfShowLeftBasket']  = $this->showLeftBasket();
        $this->_aViewData['bl_perfShowRightBasket'] = $this->showRightBasket();
        $this->_aViewData['bl_perfShowTopBasket']   = $this->showTopBasket();

        $this->_aViewData['isnewsletter_truth'] = $this->getNewsRealStatus();

        $this->_aViewData['noindex'] = $this->noIndex();

        return $this->_sThisTemplate;
    }

    /**
     * Returns current view product object (if it is loaded)
     *
     * @return oxarticle
     */
    public function getViewProduct()
    {
        return $this->getProduct();
    }

    /**
     * Sets view product
     *
     * @param oxarticle $oProduct view product object
     *
     * @return null
     */
    public function setViewProduct( $oProduct )
    {
        $this->_oProduct = $oProduct;
    }

    /**
     * Returns view product list
     *
     * @return array
     */
    public function getViewProductList()
    {
        return $this->_aArticleList;
    }

    /**
     * Active page getter
     *
     * @return int
     */
    public function getActPage()
    {
        if ( $this->_iActPage === null ) {
            $this->_iActPage = ( int ) oxConfig::getParameter( 'pgNr' );
            $this->_iActPage = ( $this->_iActPage < 0 ) ? 0 : $this->_iActPage;
        }
        return $this->_iActPage;
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
     * Active tag info object getter. Object properties:
     *  - sTag current tag
     *  - link link leading to tag article list
     *
     * @return oxstdclass
     */
    public function getActTag()
    {
        if ( $this->_oActTag === null ) {
            $this->_oActTag = new Oxstdclass();
            $this->_oActTag->sTag = oxConfig::getParameter("searchtag", 1);

            $sUrl = $this->getConfig()->getShopHomeURL();
            $this->_oActTag->link = "{$sUrl}cl=tag";
        }
        return $this->_oActTag;
    }

    /**
     * Returns active vendor set by categories component; if vendor is
     * not set by component - will create vendor object and will try to
     * load by id passed by request
     *
     * @return oxvendor
     */
    public function getActVendor()
    {
        // if active vendor is not set yet - trying to load it from request params
        // this may be usefull when category component was unable to load active vendor
        // and we still need some object to mount navigation info
        if ( $this->_oActVendor === null ) {
            $this->_oActVendor = false;
            $sVendorId = oxConfig::getParameter( 'cnid' );
            $sVendorId = $sVendorId ? str_replace( 'v_', '', $sVendorId ) : $sVendorId;
            if ( 'root' == $sVendorId ) {
                $this->_oActVendor = oxVendor::getRootVendor();
            } elseif ( $sVendorId ) {
                $oVendor = oxNew( 'oxvendor' );
                if ( $oVendor->load( $sVendorId ) ) {
                    $this->_oActVendor = $oVendor;
                }
            }
        }

        return $this->_oActVendor;
    }

    /**
     * Returns active Manufacturer set by categories component; if Manufacturer is
     * not set by component - will create Manufacturer object and will try to
     * load by id passed by request
     *
     * @return oxmanufacturer
     */
    public function getActManufacturer()
    {
        // if active Manufacturer is not set yet - trying to load it from request params
        // this may be usefull when category component was unable to load active Manufacturer
        // and we still need some object to mount navigation info
        if ( $this->_oActManufacturer === null ) {

            $this->_oActManufacturer = false;
            $sManufacturerId = oxConfig::getParameter( 'mnid' );
            if ( 'root' == $sManufacturerId ) {
                $this->_oActManufacturer = oxManufacturer::getRootManufacturer();
            } elseif ( $sManufacturerId ) {
                $oManufacturer = oxNew( 'oxmanufacturer' );
                if ( $oManufacturer->load( $sManufacturerId ) ) {
                    $this->_oActManufacturer = $oManufacturer;
                }
            }
        }

        return $this->_oActManufacturer;
    }

    /**
     * Active vendor setter
     *
     * @param oxvendor $oVendor active vendor
     *
     * @return null
     */
    public function setActVendor( $oVendor )
    {
        $this->_oActVendor = $oVendor;
    }

    /**
     * Active Manufacturer setter
     *
     * @param oxmanufacturer $oManufacturer active Manufacturer
     *
     * @return null
     */
    public function setActManufacturer( $oManufacturer )
    {
        $this->_oActManufacturer = $oManufacturer;
    }

    /**
     * Returns fake object which is used to mount navigation info
     *
     * @return oxstdclass
     */
    public function getActSearch()
    {
        if ( $this->_oActSearch === null ) {
            $this->_oActSearch = new oxStdClass();
            $sUrl = $this->getConfig()->getShopHomeURL();
            $this->_oActSearch->link = "{$sUrl}cl=search";
        }
        return $this->_oActSearch;
    }

    /**
     * Returns active recommlist object which is used to mount navigation info
     *
     * @return object
     */
    public function getActRecommList()
    {
        if ( $this->_oActRecomm === null ) {
            $this->_oActRecomm = false;
            $sRecommId = oxConfig::getParameter( 'recommid' );

            $oRecommList = oxNew( 'oxrecommlist' );

            if ( $oRecommList->load( $sRecommId ) ) {
                $this->_oActRecomm = $oRecommList;
            }
        }
        return $this->_oActRecomm;
    }

    /**
     * Returns category tree (if it is loaded)
     *
     * @return oxcategorylist
     */
    public function getCategoryTree()
    {
        return $this->_oCategoryTree;
    }

    /**
     * Category list setter
     *
     * @param oxcategorylist $oCatTree category tree
     *
     * @return null
     */
    public function setCategoryTree( $oCatTree )
    {
        $this->_oCategoryTree = $oCatTree;
    }

    /**
     * Returns vendor tree (if it is loaded0
     *
     * @return oxvendorlist
     */
    public function getVendorTree()
    {
        return $this->_oVendorTree;
    }

    /**
     * Vendor tree setter
     *
     * @param oxvendorlist $oVendorTree vendor tree
     *
     * @return null
     */
    public function setVendorTree( $oVendorTree )
    {
        $this->_oVendorTree = $oVendorTree;
    }

    /**
     * Returns Manufacturer tree (if it is loaded0
     *
     * @return oxManufacturerlist
     */
    public function getManufacturerTree()
    {
        return $this->_oManufacturerTree;
    }

    /**
     * Manufacturer tree setter
     *
     * @param oxManufacturerlist $oManufacturerTree Manufacturer tree
     *
     * @return null
     */
    public function setManufacturerTree( $oManufacturerTree )
    {
        $this->_oManufacturerTree = $oManufacturerTree;
    }
    /**
     * Loads article actions: top articles, bargain - right side and top 5 articles
     *
     * Template variables:
     *
     * <b>articlebargainlist</b>, <b>aTop5Articles</b>
     *
     * @return null
     */
    protected function _loadActions()
    {
        $this->_aViewData['articlebargainlist'] = $this->getBargainArticleList();
        $this->_aViewData['aTop5Articles']      = $this->getTop5ArticleList();
    }

    /**
     * Active category id tracker used when SEO is on to track active category and
     * keep correct navigation
     *
     * @param string $sCategoryId active category Id
     *
     * @return null
     */
    public function setSessionCategoryId( $sCategoryId )
    {
        oxSession::setVar( 'cnid', $sCategoryId );
    }

    /**
     * Active category id getter
     *
     * @return string
     */
    public function getSessionCategoryId()
    {
        return oxSession::getVar( 'cnid' );
    }

    /**
     * Iterates through list articles and performs list view specific tasks
     *
     * @return null
     */
    protected function _processListArticles()
    {
        $sAddParams = $this->getAddUrlParams();
        if ( $sAddParams && $this->_aArticleList ) {
            foreach ( $this->_aArticleList as $oArticle ) {
                $oArticle->appendLink( $sAddParams );
            }
        }
    }

    /**
     * Returns additional URL paramerets which must be added to list products urls
     *
     * @return string
     */
    public function getAddUrlParams()
    {
    }

    /**
     * Template variable getter. Returns Top 5 article list.
     * Parameter oxubase::$_blTop5Action must be set to true.
     *
     * @return array
     */
    public function getTop5ArticleList()
    {
        if ( !$this->_blTop5Action ) {
            return null;
        }

        if ( $this->_aTop5ArticleList === null ) {
            $this->_aTop5ArticleList = false;
            $myConfig = $this->getConfig();
            if ( $myConfig->getConfigParam( 'bl_perfLoadAktion' ) ) {
                // top 5 articles
                $oArtList = oxNew( 'oxarticlelist' );
                $oArtList->loadTop5Articles();
                if ( $oArtList->count() ) {
                    $this->_aTop5ArticleList = $oArtList;
                }
            }
        }
        return $this->_aTop5ArticleList;
    }

    /**
     * Template variable getter. Returns bargain article list
     * Parameter oxubase::$_blBargainAction must be set to true.
     *
     * @return array
     */
    public function getBargainArticleList()
    {
        if ( !$this->_blBargainAction ) {
            return null;
        }

        if ( $this->_aBargainArticleList === null ) {
            $this->_aBargainArticleList = array();
            if ( $this->getConfig()->getConfigParam( 'bl_perfLoadAktion' ) ) {
                $oArtList = oxNew( 'oxarticlelist' );
                $oArtList->loadAktionArticles( 'OXBARGAIN' );
                if ( $oArtList->count() ) {
                    $this->_aBargainArticleList = $oArtList;
                }
            }
        }
        return $this->_aBargainArticleList;
    }

    /**
     * Template variable getter. Returns if order price is to low
     *
     * @return integer
     */
    public function isLowOrderPrice()
    {
        return $this->_iLowOrderPrice;
    }

    /**
     * Template variable getter. Returns min order price
     *
     * @return string
     */
    public function getMinOrderPrice()
    {
        return $this->_sMinOrderPrice;
    }

    /**
     * Template variable getter. Returns if newsletter is realy active (for user.tpl)
     *
     * @return integer
     */
    public function getNewsRealStatus()
    {
        return $this->_iNewsRealStatus;
    }

    /**
     * Checks if current request parameters does not block SEO redirection process
     *
     * @return bool
     */
    protected function _canRedirect()
    {
        foreach ( $this->_aBlockRedirectParams as $sParam ) {
            if ( oxConfig::getParameter( $sParam ) !== null ) {
                return false;
            }
        }

        return true;
    }

    /**
     * Empty active product getter
     *
     * @return null
     */
    public function getProduct()
    {
    }

    /**
     * Template variable getter. Returns vendorlist for search
     *
     * @return array
     */
    public function getVendorlist()
    {
        return $this->_aVendorlist;
    }

    /**
     * Sets vendorlist for search
     *
     * @param array $aList vendor list
     *
     * @return null
     */
    public function setVendorlist( $aList )
    {
        $this->_aVendorlist = $aList;
    }

    /**
     * Template variable getter. Returns Manufacturerlist for search
     *
     * @return array
     */
    public function getManufacturerlist()
    {
        return $this->_aManufacturerlist;
    }

    /**
     * Sets Manufacturerlist for search
     *
     * @param array $aList manufacturer list
     *
     * @return null
     */
    public function setManufacturerlist( $aList )
    {
        $this->_aManufacturerlist = $aList;
    }

    /**
     * Sets root vendor
     *
     * @param object $oVendor vendor object
     *
     * @return null
     */
    public function setRootVendor( $oVendor )
    {
        $this->_oRootVendor = $oVendor;
    }

    /**
     * Template variable getter. Returns root vendor
     *
     * @return object
     */
    public function getRootVendor()
    {
        return $this->_oRootVendor;
    }

    /**
     * Sets root Manufacturer
     *
     * @param object $oManufacturer manufacturer object
     *
     * @return null
     */
    public function setRootManufacturer( $oManufacturer )
    {
        $this->_oRootManufacturer = $oManufacturer;
    }

    /**
     * Template variable getter. Returns root Manufacturer
     *
     * @return object
     */
    public function getRootManufacturer()
    {
        return $this->_oRootManufacturer;
    }

    /**
     * Template variable getter. Returns vendor id
     *
     * @return string
     */
    public function getVendorId()
    {
        if ( $this->_sVendorId === null ) {
            $this->_sVendorId = false;
            if ( ( $oVendor = $this->getActVendor() ) ) {
                $this->_sVendorId = $oVendor->getId();
            }
        }
        return $this->_sVendorId;
    }

    /**
     * Template variable getter. Returns Manufacturer id
     *
     * @return string
     */
    public function getManufacturerId()
    {
        if ( $this->_sManufacturerId === null ) {
            $this->_sManufacturerId = false;
            if ( ( $oManufacturer = $this->getActManufacturer() ) ) {
                $this->_sManufacturerId = $oManufacturer->getId();
            }
        }
        return $this->_sManufacturerId;
    }

    /**
     * Template variable getter. Returns category tree for search
     *
     * @return array
     */
    public function getSearchCatTree()
    {
        return $this->_aSearchCatTree;
    }

    /**
     * Sets category tree for search
     *
     * @param array $aTree category tree
     *
     * @return null
     */
    public function setSearchCatTree( $aTree )
    {
        $this->_aSearchCatTree = $aTree;
    }

    /**
     * Template variable getter. Returns more category
     *
     * @return object
     */
    public function getCatMore()
    {
        return $this->_oCatMore;
    }

    /**
     * Sets more category
     *
     * @param object $oCat category object
     *
     * @return null
     */
    public function setCatMore( $oCat )
    {
        $this->_oCatMore = $oCat;
    }

    /**
     * Template variable getter. Returns if user subscribed for newsletter
     *
     * @return bool
     */
    public function isNewsSubscribed()
    {
        return $this->_blNewsSubscribed;
    }

    /**
     * Sets if user subscribed for newsletter
     *
     * @param bool $blNewsSubscribed TRUE - news are subscribed
     *
     * @return null
     */
    public function setNewsSubscribed( $blNewsSubscribed )
    {
        $this->_blNewsSubscribed = $blNewsSubscribed;
    }

    /**
     * Template variable getter. Returns if show user shipping address
     *
     * @return bool
     */
    public function showShipAddress()
    {
        return $this->_blShowShipAddress;
    }

    /**
     * Sets if show user shipping address
     *
     * @param bool $blShowShipAddress TRUE - show shipping address
     *
     * @return null
     */
    public function setShowShipAddress( $blShowShipAddress )
    {
        $this->_blShowShipAddress = $blShowShipAddress;
    }

    /**
     * Template variable getter. Returns shipping address
     *
     * @return bool
     */
    public function getDelAddress()
    {
        return $this->_oDelAddress;
    }

    /**
     * Sets shipping address
     *
     * @param bool $oDelAddress delivery address
     *
     * @return null
     */
    public function setDelAddress( $oDelAddress )
    {
        $this->_oDelAddress = $oDelAddress;
    }

    /**
     * Template variable getter. Returns category path
     *
     * @return string
     */
    public function getCatTreePath()
    {
        return $this->_sCatTreePath;
    }

    /**
     * Loads and returns oxcontent object requested by its ident
     *
     * @param string $sIdent content identifier
     *
     * @return oxcontent
     */
    public function getContentByIdent( $sIdent )
    {
        if ( !isset( $this->_aContents[$sIdent] ) ) {
            $this->_aContents[$sIdent] = oxNew( 'oxcontent' );
            $this->_aContents[$sIdent]->loadByIdent( $sIdent );
        }
        return $this->_aContents[$sIdent];
    }

    /**
     * Default content category getter, returns FALSE by default
     *
     * @return bool
     */
    public function getContentCategory()
    {
        return false;
    }
}
