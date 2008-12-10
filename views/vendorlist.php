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
 * $Id: vendorlist.php 13770 2008-10-27 13:10:37Z arvydas $
 */

/**
 * List of articles for a selected vendor.
 * Collects list of articles, according to it generates links for list gallery,
 * metatags (for search engines). Result - "vendorlist.tpl" template.
 * OXID eShop -> (Any selected shop product category).
 */
class vendorlist extends aList
{
    /**
     * List type
     * @var string
     */
    protected $_sListType = 'vendor';

    /**
     * List type
     * @var string
     */
    protected $_blVisibleSubCats = null;

    /**
     * List type
     * @var string
     */
    protected $_oSubCatList = null;

    /**
     * List type
     * @var string
     */
    protected $_iArticleCnt = null;

    /**
     * Recommlist
     * @var object
     */
    protected $_oRecommList = null;

    /**
     * Template location
     *
     * @var string
     */
    protected $_sTplLocation = null;

    /**
     * Template location
     *
     * @var string
     */
    protected $_sCatTitle = null;

    /**
     * Template location
     *
     * @var string
     */
    protected $_sActCatPath= null;

    /**
     * Page navigation
     * @var object
     */
    protected $_oPageNavigation = null;

    /**
     * Marked which defines if current view is sortable or not
     * @var bool
     */
    protected $_blShowSorting = true;

    /**
     * Current view search engine indexing state:
     *     0 - index without limitations
     *     1 - no index / no follow
     *     2 - no index / follow
     */
    protected $_iViewIndexState = 2;

    /**
     * Executes parent::render(), loads active vendor, prepares article
     * list sorting rules. Loads list of articles which belong to this vendor
     * Generates page navigation data
     * such as previous/next window URL, number of available pages, generates
     * metatags info (oxview::_convertForMetaTags()) and returns name of
     * template to render.
     *
     * Template variables:
     * <b>articlelist</b>, <b>pageNavigation</b>, <b>subcatlist</b>,
     * <b>meta_keywords</b>, <b>meta_description</b>
     *
     * @return  string  $this->_sThisTemplate   current template file name
     */
    public function render()
    {
        oxUBase::render();

        $myConfig = $this->getConfig();

        // load vendor
        if ( ( $oVendorTree = $this->getVendorTree() ) ) {
            if ( ( $oVendor = $this->getActVendor() ) ) {
                if ( $oVendor->getId() != 'root' ) {
                    // load only articles which we show on screen
                    $iNrofCatArticles = (int) $this->getConfig()->getConfigParam( 'iNrofCatArticles' );
                    $iNrofCatArticles = $iNrofCatArticles ? $iNrofCatArticles : 1;

                    // load the articles
                    $this->_iAllArtCnt = $this->getArticleCnt();
                    $this->_iCntPages  = round( $this->_iAllArtCnt / $iNrofCatArticles + 0.49 );

                }
            }
        }
        $this->_aViewData['hasVisibleSubCats'] = $this->hasVisibleSubCats();
        $this->_aViewData['subcatlist']        = $this->getSubCatList();
        $this->_aViewData['articlelist']       = $this->getArticleList();
        $this->_aViewData['similarrecommlist'] = $this->getRecommList();

        $this->_aViewData['title']             = $this->getTitle();
        $this->_aViewData['template_location'] = $this->getTemplateLocation();
        $this->_aViewData['actCategory']       = $this->getActiveCategory();
        $this->_aViewData['actCatpath']        = $this->getTreeCatPath();

        $this->_aViewData['pageNavigation'] = $this->getPageNavigation();

        // processing list articles
        $this->_processListArticles();

        // generating meta info
        $this->setMetaDescription( null );
        $this->setMetaKeywords( null );

        return $this->_sThisTemplate;
    }

    /**
     * Iterates through list articles and performs list view specific tasks:
     *  - sets type of link whicn needs to be generated (vendor link)
     *  - appends link with vendor list specific parameters
     *
     * @return null
     */
    protected function _processListArticles()
    {
        if ( $aArtList = $this->getArticleList() ) {
            foreach ( $aArtList as $oArticle ) {
                // forcing to generate vendor URLs by getLink
                $oArticle->setLinkType( 1 );
            }
        }
    }

    /**
     * Sets vendor item sorting config
     *
     * @param string $sCnid    sortable vendor id
     * @param string $sSortBy  sort field
     * @param string $sSortDir sort direction (optional)
     *
     * @return null
     */
    public function setItemSorting( $sCnid, $sSortBy, $sSortDir = null )
    {
        parent::setItemSorting( str_replace( 'v_', '', $sCnid ).':vendor', $sSortBy, $sSortDir );
    }

    /**
     * Returns vendor sorting config
     *
     * @param string $sCnid sortable item id
     *
     * @return string
     */
    public function getSorting( $sCnid )
    {
        return parent::getSorting( str_replace( 'v_', '', $sCnid ).':vendor' );
    }

    /**
     * Loads and returns article list of active vendor.
     *
     * @param object $oVendor vendor object
     *
     * @return array
     */
    protected function _loadArticles( $oVendor )
    {
        $sVendorId = $oVendor->getId();

        // load only articles which we show on screen
        $iNrofCatArticles = (int) $this->getConfig()->getConfigParam( 'iNrofCatArticles' );
        $iNrofCatArticles = $iNrofCatArticles?$iNrofCatArticles:1;

        $oArtList = oxNew( 'oxarticlelist' );
        $oArtList->setSqlLimit( $iNrofCatArticles * $this->getActPage(), $iNrofCatArticles );
        $oArtList->setCustomSorting( $this->getSortingSql( $sVendorId ) );

        // load the articles
        $iArtCnt = $oArtList->loadVendorArticles( $sVendorId, $oVendor );

        return array( $oArtList, $iArtCnt );
    }

    /**
     * Returns active product id to load its seo meta info
     *
     * @return string
     */
    protected function _getSeoObjectId()
    {
        if ( ( $oVendor = $this->getActVendor() ) ) {
            return $oVendor->getId();
        }
    }

    /**
     * Modifies url by adding page parameters. When seo is on, url is additionally
     * formatted by SEO engine
     *
     * @param string $sUrl  current url
     * @param int    $iPage page number
     *
     * @return string
     */
    protected function _addPageNrParam( $sUrl, $iPage, $iLang = null)
    {
        if ( oxUtils::getInstance()->seoIsActive() && ( $oVendor = $this->getActVendor() ) ) {
            if ( $iPage ) { // only if page number > 0
                $sUrl = oxSeoEncoderVendor::getInstance()->getVendorPageUrl( $oVendor, $iPage, $iLang, $this->_isFixedUrl( $oVendor ) );
            }
        } else {
            $sUrl = parent::_addPageNrParam( $sUrl, $iPage, $iLang );
        }

        return $sUrl;
    }

    /**
     * Returns current view Url
     *
     * @return string
     */
    public function generatePageNavigationUrl( )
    {
        if ( ( oxUtils::getInstance()->seoIsActive() && ( $oVendor = $this->getActVendor() ) ) ) {
            return $oVendor->getLink();
        } else {
            return parent::generatePageNavigationUrl( );
        }
    }

    /**
     * Template variable getter. Returns active object's reviews
     *
     * @return array
     */
    public function hasVisibleSubCats()
    {
         if ( $this->_blVisibleSubCats === null ) {
             $this->_blVisibleSubCats = false;
             if ( ( $oVendorTree = $this->getVendorTree() ) ) {
                if ( ( $oVendor = $this->getActVendor() ) ) {
                    if ( $oVendor->getId() == 'root' ) {
                        $this->_blVisibleSubCats = $oVendorTree->count();
                        $this->_oSubCatList = $oVendorTree;
                    }
                }
            }
        }
        return $this->_blVisibleSubCats;
    }

    /**
     * Template variable getter. Returns active object's reviews
     *
     * @return array
     */
    public function getSubCatList()
    {
        if ( $this->_oSubCatList === null ) {
            $this->_oSubCatList = array();
            if ( $this->hasVisibleSubCats() ) {
                return $this->_oSubCatList;
            }
        }
        return $this->_oSubCatList;
    }

    /**
     * Template variable getter. Returns active object's reviews
     *
     * @return array
     */
    public function getArticleList()
    {
         if ( $this->_aArticleList === null ) {
             $this->_aArticleList = array();
             if ( ( $oVendorTree = $this->getVendorTree() ) ) {
                if ( ( $oVendor = $this->getActVendor() ) && ( $oVendor->getId() != 'root' ) ) {
                    list( $aArticleList, $iArticleCnt ) = $this->_loadArticles( $oVendor );
                    if ( $iArticleCnt ) {
                        $this->_aArticleList = $aArticleList;
                        $this->_iArticleCnt  = $iArticleCnt;
                    }
                }

            }
        }
        return $this->_aArticleList;
    }

    /**
     * Template variable getter. Returns active object's reviews
     *
     * @return array
     */
    public function getArticleCnt()
    {
         if ( $this->_iArticleCnt === null ) {
             $this->_iArticleCnt = 0;
             if ( $this->getArticleList() ) {
                return $this->_iArticleCnt;
            }
        }
        return $this->_iArticleCnt;
    }

    /**
     * Template variable getter. Returns recommlist's reviews
     *
     * @return array
     */
    public function getRecommList()
    {
        if ( $this->_oRecommList === null ) {
            $this->_oRecommList = false;
            if ( $this->getArticleCnt() ) {
                // loading recommlists
                $oRecommList = oxNew('oxrecommlist');
                $this->_oRecommList = $oRecommList->getRecommListsByIds( $this->_aArticleList->arrayKeys());
            }
        }
        return $this->_oRecommList;
    }

    /**
     * Template variable getter. Returns template location
     *
     * @return string
     */
    public function getTitle()
    {
        if ( $this->_sCatTitle === null ) {
            $this->_sCatTitle = '';
            if ( $oVendorTree = $this->getVendorTree() ) {
                if ( $oVendor = $this->getActVendor() ) {
                    $this->_sCatTitle = $oVendor->oxvendor__oxtitle->value;
                }
            }
        }
        return $this->_sCatTitle;
    }

    /**
     * Template variable getter. Returns template location
     *
     * @return string
     */
    public function getTemplateLocation()
    {
        if ( $this->_sTplLocation === null ) {
            $this->_sTplLocation = false;
            if ( ( $oVendorTree = $this->getVendorTree() ) ) {
                $this->_sTplLocation = $oVendorTree->getHtmlPath();
            }
        }
        return $this->_sTplLocation;
    }

    /**
     * Template variable getter. Returns active vendor
     *
     * @return object
     */
    public function getActiveCategory()
    {
        if ( $this->_oActCategory === null ) {
            $this->_oActCategory = false;
            if ( ( $oVendorTree = $this->getVendorTree() ) ) {
                if ( $oVendor = $this->getActVendor() ) {
                    $this->_oActCategory = $oVendor;
                }
            }
        }
        return $this->_oActCategory;
    }

    /**
     * Template variable getter. Returns template location
     *
     * @return string
     */
    public function getTreeCatPath()
    {
        if ( $this->_sActCatPath === null ) {
            $this->_sActCatPath = false;
            if ( ( $oVendorTree = $this->getVendorTree() ) ) {
                $this->_sActCatPath  = $oVendorTree->getPath();
            }
        }
        return $this->_sActCatPath;
    }

    /**
     * Template variable getter. Returns page navigation
     *
     * @return object
     */
    public function getPageNavigation()
    {
        if ( $this->_oPageNavigation === null ) {
            $this->_oPageNavigation = false;
            $this->_oPageNavigation = $this->generatePageNavigation();
        }
        return $this->_oPageNavigation;
    }

    /**
     * Returns title suffix used in template
     *
     * @return string
     */
    public function getTitleSuffix()
    {
        if ( $this->getActVendor()->oxvendor__oxshowsuffix->value ) {
           return $this->getConfig()->getActiveShop()->oxshops__oxtitlesuffix->value;
        }
    }

    /**
     * Calls and returns result of parent:: _collectMetaKeyword();
     *
     * @param mixed $aCatPath category path
     *
     * @return string
     */
    protected function _prepareMetaKeyword( $aCatPath )
    {
        return parent::_collectMetaKeyword( $aCatPath );
    }

    /**
     * Metatags - description and keywords - generator for search
     * engines. Uses string passed by parameters, cleans HTML tags,
     * string dublicates, special chars. Also removes strings defined
     * in $myConfig->aSkipTags (Admin area).
     *
     * @param mixed $aCatPath  category path
     * @param int   $iLength   max length of result, -1 for no truncation
     * @param bool  $blDescTag if true - performs additional dublicate cleaning
     *
     * @return  string  $sString    converted string
     */
    protected function _prepareMetaDescription( $aCatPath, $iLength = 1024, $blDescTag = false )
    {
        return parent::_collectMetaDescription( $aCatPath, $iLength, $blDescTag );
    }
}
