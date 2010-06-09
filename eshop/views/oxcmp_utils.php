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
 * @copyright (C) OXID eSales AG 2003-2010
 * @version OXID eShop CE
 * @version   SVN: $Id: oxcmp_utils.php 28214 2010-06-08 12:06:29Z sarunas $
 */

/**
 * Transparent shop utilities class.
 * Some specific utilities, such as fetching article info, etc. (Class may be used
 * for overriding).
 * @subpackage oxcmp
 */
class oxcmp_utils extends oxView
{
    /**
     * Marking object as component
     * @var bool
     */
    protected $_blIsComponent = true;

    /**
     * If passed article ID (by URL or posted form) - loads article,
     * otherwise - loads list of action articles oxarticlelist::loadAktionArticles().
     * In this case, the last list object will be used. Loaded article info
     * is serialized and outputted to client system.
     *
     * @return null
     */
    public function getArticle()
    {
        $myConfig = $this->getConfig();
        $myUtils  = oxUtils::getInstance();

        if (!$myConfig->getConfigParam("blAllowRemoteArticleInfo"))
            return false;


        $sOutput  = 'OXID__Problem : no valid oxid !';
        $oProduct = null;

        if ( ( $sId = oxConfig::getParameter( 'oxid' ) ) ) {
            $oProduct = oxNewArticle( $sId );
        } elseif ( $myConfig->getConfigParam( 'bl_perfLoadAktion' ) ) {
            $oArtList = oxNew( 'oxarticlelist');
            $oArtList->loadAktionArticles( 'OXAFFILIATE' );
            $oProduct = $oArtList->current();
        }

        if ( $oProduct ) {

            $aExport = array();

            $aClassVars = get_object_vars( $oProduct );
            $oStr = getStr();

            // add all database fields
            while ( list( $sFieldName, ) = each( $aClassVars ) ) {
                if ( $oStr->strstr( $sFieldName, 'oxarticles' ) ) {
                    $sName = str_replace( 'oxarticles__', '', $sFieldName );
                    $aExport[$sName] = $oProduct->$sFieldName->value;
                }
            }

            $oPrice  = $oProduct->getPrice();
            $oTPrice = $oProduct->getTPrice();

            $aExport['vatPercent'] = $oPrice->getVat();
            $aExport['netPrice']   = $myUtils->fRound( $oPrice->getNettoPrice() );
            $aExport['brutPrice']  = $myUtils->fRound( $oPrice->getBruttoPrice() );
            $aExport['vat']        = $oPrice->getVatValue();
            $aExport['fprice']     = $oProduct->getFPrice();
            $aExport['ftprice']    = oxLang::getInstance()->formatCurrency( $myUtils->fRound( $oTPrice->getBruttoPrice() ) );

            $aExport['oxdetaillink']     = $oProduct->getLink();
            $aExport['oxmoredetaillink'] = $oProduct->getMoreDetailLink();
            $aExport['tobasketlink']     = $oProduct->getToBasketLink();
            $aExport['thumbnaillink']    = $myConfig->getDynImageDir() ."/". $aExport['oxthumb'];
            $sOutput = serialize( $aExport );
        }

        // stop shop here
        $myUtils->showMessageAndExit( $sOutput );
    }

    /**
     * Adds/removes chosen article to/from article comparison list
     *
     * @param object $sProductId product id
     * @param double $dAmount    amount
     * @param array  $aSel       (default null)
     * @param bool   $blOverride allow override
     * @param bool   $blBundle   bundled
     *
     * @return  void
     */
    public function toCompareList( $sProductId = null, $dAmount = null, $aSel = null, $blOverride = false, $blBundle = false )
    {
        // only if enabled and not search engine..
        if ( $this->getViewConfig()->getShowCompareList() && !oxUtils::getInstance()->isSearchEngine() ) {

            // #657 special treatment if we want to put on comparelist
            $blAddCompare  = oxConfig::getParameter( 'addcompare' );
            $blRemoveCompare = oxConfig::getParameter( 'removecompare' );
            $sProductId = $sProductId ? $sProductId:oxConfig::getParameter( 'aid' );
            if ( ( $blAddCompare || $blRemoveCompare ) && $sProductId ) {

                // toggle state in session array
                $aItems = oxConfig::getParameter( 'aFiltcompproducts' );
                if ( $blAddCompare && !isset( $aItems[$sProductId] ) ) {
                    $aItems[$sProductId] = true;
                }

                if ( $blRemoveCompare ) {
                    unset( $aItems[$sProductId] );
                }

                oxSession::setVar( 'aFiltcompproducts', $aItems );
                $oParentView = $this->getParent();

                // #843C there was problem then field "blIsOnComparisonList" was not set to article object
                if ( ( $oProduct = $oParentView->getViewProduct() ) ) {
                    if ( isset( $aItems[$oProduct->getId()] ) ) {
                        $oProduct->setOnComparisonList( true );
                    } else {
                        $oProduct->setOnComparisonList( false );
                    }
                }

                $aViewProds = $oParentView->getViewProductList();
                if ( is_array( $aViewProds ) && count( $aViewProds ) ) {
                    foreach ( $aViewProds as $oProduct ) {
                        if ( isset( $aItems[$oProduct->getId()] ) ) {
                            $oProduct->setOnComparisonList( true );
                        } else {
                            $oProduct->setOnComparisonList( false );
                        }
                    }
                }
            }
        }
    }

    /**
     * If session user is set loads user noticelist (oxuser::GetBasket())
     * and adds article to it.
     *
     * @param string $sProductId Product/article ID (default null)
     * @param double $dAmount    amount of good (default null)
     * @param array  $aSel       product selection list (default null)
     *
     * @return bool
     */
    public function toNoticeList( $sProductId = null, $dAmount = null, $aSel = null)
    {
        $this->_toList( 'noticelist', $sProductId, $dAmount, $aSel );
    }

    /**
     * If session user is set loads user wishlist (oxuser::GetBasket()) and
     * adds article to it.
     *
     * @param string $sProductId Product/article ID (default null)
     * @param double $dAmount    amount of good (default null)
     * @param array  $aSel       product selection list (default null)
     *
     * @return false
     */
    public function toWishList( $sProductId = null, $dAmount = null, $aSel = null )
    {
        // only if enabled
        if ( $this->getViewConfig()->getShowWishlist() ) {
            $this->_toList( 'wishlist', $sProductId, $dAmount, $aSel );
        }
    }

    /**
     * Adds chosen product to defined user list. if amount is 0, item is removed from the list
     *
     * @param string $sListType  user product list type
     * @param string $sProductId product id
     * @param double $dAmount    product amount
     * @param array  $aSel       product selection list
     *
     * @return null
     */
    protected function _toList( $sListType, $sProductId, $dAmount, $aSel )
    {
        // only if user is logged in
        if ( $oUser = $this->getUser() ) {

            $sProductId = ($sProductId) ? $sProductId : oxConfig::getParameter( 'aid' );
            $sProductId = ($sProductId) ? $sProductId : oxConfig::getParameter( 'itmid' );
            $dAmount = isset( $dAmount ) ? $dAmount : oxConfig::getParameter( 'am' );
            $aSel    = $aSel ? $aSel : oxConfig::getParameter( 'sel' );

            // processing amounts
            $dAmount = str_replace( ',', '.', $dAmount );
            if ( !$this->getConfig()->getConfigParam( 'blAllowUnevenAmounts' ) ) {
                $dAmount = round( ( string ) $dAmount );
            }

            $oBasket = $oUser->getBasket( $sListType );
            $oBasket->addItemToBasket( $sProductId, abs( $dAmount ), $aSel, ($dAmount == 0) );

            // recalculate basket count
            $oBasket->getItemCount( true );
        }
    }

    /**
     *  Set viewdata, call parent::render
     *
     * @return null
     */
    public function render()
    {
        parent::render();

        $myConfig = $this->getConfig();
        $oParentView = $this->getParent();

        if ( ( $oUser = $this->getUser() ) ) {

            // calculating user friends wishlist item count
            if ( ( $sUserId = oxConfig::getParameter( 'wishid' ) ) ) {
                $oWishUser = oxNew( 'oxuser' );
                if ( $oWishUser->load( $sUserId ) ) {
                    $oParentView->setWishlistName( $oWishUser->oxuser__oxfname->value );
                    // Passing to view. Left for compatibility reasons for a while. Will be removed in future
                    $oParentView->addTplParam( 'ShowWishlistName', $oParentView->getWishlistName() );
                }
            }
        }

        // add content for mainmenu
        $oContentList = oxNew( 'oxcontentlist' );
        $oContentList->loadMainMenulist();
        $oParentView->setMenueList( $oContentList );

        // Passing to view. Left for compatibility reasons for a while. Will be removed in future
        $oParentView->addTplParam( 'aMenueList', $oParentView->getMenueList() );

        // Performance
        if ( !$myConfig->getConfigParam( 'bl_perfLoadCompare' ) ||
            ( $myConfig->getConfigParam( 'blDisableNavBars' ) && $myConfig->getActiveView()->getIsOrderStep() ) ) {
            $oParentView->addTplParam('isfiltering', false );
            return;
        }

        // load nr. of items which are currently shown in comparison
        $aItems = oxConfig::getParameter( 'aFiltcompproducts' );
        if ( is_array( $aItems ) && count( $aItems ) ) {

            $oArticle = oxNew( 'oxarticle' );

            // counts how many pages
            $sInSql   = implode( ",", oxDb::getInstance()->quoteArray( array_keys( $aItems ) ) );
            $sSelect  = "select count(oxid) from oxarticles where oxarticles.oxid in (".$sInSql.") ";
            $sSelect .= 'and '.$oArticle->getSqlActiveSnippet();

            $iCnt = (int) oxDb::getDb()->getOne( $sSelect );

            //add amount of compared items to view data
            $oParentView->setCompareItemsCnt( $iCnt );
            // Passing to view. Left for compatibility reasons for a while. Will be removed in future
            $oParentView->addTplParam( 'oxcmp_compare', $oParentView->getCompareItemsCnt() );

            // return amount of items
            return $iCnt;
        }
    }
}
