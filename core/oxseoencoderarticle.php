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
 * $Id: oxseoencoderarticle.php 14388 2008-11-26 15:43:17Z vilma $
 */

/**
 * Seo encoder for articles
 *
 * @package core
 */
class oxSeoEncoderArticle extends oxSeoEncoder
{
    /**
     * Singleton instance.
     */
    protected static $_instance = null;

    /**
     * Singleton method
     *
     * @return oxseoencoder
     */
    public static function getInstance()
    {
        if (!self::$_instance) {
            self::$_instance = oxNew("oxSeoEncoderArticle");
        }
        return self::$_instance;
    }

    /**
     * Returns SEO uri for passed article
     *
     * @param oxarticle $oArticle article object
     * @param int       $iLang    language
     *
     * @return string
     */
    protected function _getArticleUri( $oArticle, $iLang = null)
    {
        startProfile(__FUNCTION__);
        if (!isset($iLang)) {
            $iLang = $oArticle->getLanguage();
        }

        $sActCatId = '';
        $oView = $this->getConfig()->getActiveView();
        $oActCat = null;

        if ( $oView instanceof oxUBase ) {
            $oActCat = $oView->getActCategory();
        }

        if ( $oActCat ) {
            $sActCatId = $oActCat->oxcategories__oxrootid->value;
        }

        //load details link from DB
        if ( !( $sSeoUrl = $this->_loadFromDb( 'oxarticle', $oArticle->getId(), $iLang, $iShopId, $sActCatId, false ) ) ) {

            if ($iLang != $oArticle->getLanguage()) {
                $sId = $oArticle->getId();
                $oArticle = oxNew('oxarticle');
                $oArticle->loadInLang($iLang, $sId);
            }

            // create title part for uri
            $sTitle = $this->_prepareArticleTitle( $oArticle );

            // create uri for all categories
            $oCategorys = $this->getSeoCategories( $oArticle, $iLang );
            if (!$oCategorys->count()) {
                $sSeoUrl = $this->_getUniqueSeoUrl( $sTitle, '.html', $oArticle->getId() );
                $this->_saveToDb( 'oxarticle', $oArticle->getId(), $oArticle->getStdLink(), $sSeoUrl, $iLang );
            } else {
                $sTmpSeoUrl = '';
                foreach ($oCategorys as $oCategory) {
                    // writing category path
                    $sTmpSeoUrl = oxSeoEncoderCategory::getInstance()->getCategoryUri( $oCategory );
                    $sTmpSeoUrl .= $sTitle;
                    $sTmpSeoUrl  = $this->_getUniqueSeoUrl( $sTmpSeoUrl, '.html', $oArticle->getId() );
                    $this->_saveToDb( 'oxarticle', $oArticle->getId(), $oArticle->getStdLink(), $sTmpSeoUrl, $iLang, null, 0, '', '', $oCategory->oxcategories__oxrootid->value);
                    if ($oCategory->oxcategories__oxrootid->value == $sActCatId) {
                        $sSeoUrl = $sTmpSeoUrl;
                    }
                }
                if (!$sSeoUrl) {
                    // seo url not found, use any
                    $sSeoUrl = $sTmpSeoUrl;
                }
            }
        }

        stopProfile(__FUNCTION__);

        return $sSeoUrl;
    }

    /**
     * Returns seo title for current article (if oxtitle field is empty, oxartnum is used).
     * Additionally - if oxvarselect is set - title is appended with its value
     *
     * @param oxarticle $oArticle article object
     *
     * @return string
     */
    protected function _prepareArticleTitle( $oArticle )
    {
        // create title part for uri
        if ( !( $sTitle = $oArticle->oxarticles__oxtitle->value ) ) {
            $sTitle = $oArticle->oxarticles__oxartnum->value;
        }

        // variant has varselect value
        if ( $oArticle->oxarticles__oxvarselect->value ) {
            $sTitle .= ' ' . $oArticle->oxarticles__oxvarselect->value;
        }
        return $this->_prepareTitle( $sTitle . '.html' );
    }

    /**
     * Returns vendor seo uri for current article
     *
     * @param oxarticle $oArticle article object
     * @param int       $iLang    language id (optional)
     *
     * @return string
     */
    protected function _getArticleVendorUri( $oArticle, $iLang = null )
    {
        startProfile(__FUNCTION__);
        if ( !isset( $iLang ) ) {
            $iLang = $oArticle->getLanguage();
        }

        $sActVendorId = $oArticle->oxarticles__oxvendorid->value;
        $oVendor = oxNew( 'oxvendor' );
        if ( !$sActVendorId || !$oVendor->load( $sActVendorId ) ) {
            $oVendor = null;
        }

        //load details link from DB
        if ( !( $sSeoUrl = $this->_loadFromDb( 'oxarticle', $oArticle->getId(), $iLang, $iShopId, $sActVendorId, true ) ) ) {

            if ( $iLang != $oArticle->getLanguage() ) {
                $sId = $oArticle->getId();
                $oArticle = oxNew('oxarticle');
                $oArticle->loadInLang( $iLang, $sId );
            }

            // create title part for uri
            $sTitle = $this->_prepareArticleTitle( $oArticle );

            // create uri for all categories
            if ( !$sActVendorId || !$oVendor ) {
                $sSeoUrl = $this->_getUniqueSeoUrl( $sTitle, '.html', $oArticle->getId() );
                $this->_saveToDb( 'oxarticle', $oArticle->getId(), $oArticle->getStdLink(), $sSeoUrl, $iLang );
            } else {
                $sSeoUrl = oxSeoEncoderVendor::getInstance()->getVendorUri( $oVendor, $iLang );
                $sSeoUrl = $this->_getUniqueSeoUrl( $sSeoUrl . $sTitle, '.html', $oArticle->getId() );

                $this->_saveToDb( 'oxarticle', $oArticle->getId(), $oArticle->getStdLink(), $sSeoUrl, $iLang, null, 0, '', '', $sActVendorId );
            }
        }

        stopProfile(__FUNCTION__);

        return $sSeoUrl;
    }

    /**
     * Encodes article URLs into SEO format
     *
     * @param oxArticle $oArticle Article object
     * @param int       $iLang    language
     * @param int       $iType    type
     *
     * @return string
     */
    public function getArticleUrl( $oArticle, $iLang = null, $iType = 0 )
    {
        if (!isset($iLang)) {
            $iLang = $oArticle->getLanguage();
        }

        switch ( $iType ) {
            case 1 :
                $sUri = $this->_getArticleVendorUri( $oArticle, $iLang );
                break;
            default:
                $sUri = $this->_getArticleUri( $oArticle, $iLang );
            }

        return $this->_getFullUrl( $sUri, $iLang );

    }

    /**
     * Returns array of suitable categories for given article
     *
     * @param oxArticle $oArticle article to search
     * @param int       $iLang    language
     *
     * @return oxList
     */
    public function getSeoCategories( $oArticle, $iLang = null)
    {
        if (!isset($iLang)) {
            $iLang = $oArticle->getLanguage();
        }
        $sArtId = $oArticle->getId();
        if ( isset( $oArticle->oxarticles__oxparentid->value ) && $oArticle->oxarticles__oxparentid->value ) {
            $sArtId = $oArticle->oxarticles__oxparentid->value;
        }

        // checking cache
        $oDb = oxDb::getDb( false );
        $sCatTable = getViewName('oxcategories');

        $sQ = "select distinct catroots.oxrootid
                from oxobject2category as o2c
                left join {$sCatTable} as catroots
                    on o2c.oxcatnid=catroots.oxid
                where o2c.oxobjectid = '$sArtId'";

        $aRoots = $oDb->getAll($sQ);

        $oList = oxNew('oxList', 'oxcategory');
        foreach ($aRoots as $aRootId) {
            $sQ = "select node.* _depth from
                    ( select oxcatnid from oxobject2category
                            where oxobjectid = '$sArtId' order by oxtime
                        ) as sub
                        left join {$sCatTable} as node
                            on sub.oxcatnid=node.oxid
                        join {$sCatTable} as parent
                            on node.oxrootid = parent.oxrootid
                    where node.oxrootid = '{$aRootId[0]}'
                        and node.oxleft between parent.oxleft and parent.oxright
                group by node.oxid order by (count( parent.oxid ) ) desc limit 1";

            $oCat = oxNew('oxcategory');
            $oCat->setLanguage($iLang);
            if ($oCat->assignRecord($sQ)) {
                $oList[] = $oCat;
            }
        }
        return $oList;
    }
}
