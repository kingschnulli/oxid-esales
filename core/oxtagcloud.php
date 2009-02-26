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
 * $Id: oxtagcloud.php 16658 2009-02-21 11:49:55Z vilma $
 */

if (!defined('OXTAGCLOUD_MINFONT')) {
    define('OXTAGCLOUD_MINFONT', 100);
    define('OXTAGCLOUD_MAXFONT', 400);
    define('OXTAGCLOUD_MINOCCURENCETOSHOW', 2);
    //depends on mysql server configuration
    define('OXTAGCLOUD_MINTAGLENGTH', 4);
    define('OXTAGCLOUD_STARTPAGECOUNT', 20);
    define('OXTAGCLOUD_EXTENDEDCOUNT', 200);
}

/**
 * Class dedicateg to tag cloud handling
 *
 */
class oxTagCloud extends oxSuperCfg
{
    /**
     * Cache key
     *
     * @var unknown_type
     */
    protected $_sCacheKey = "tagcloud_";

    /**
     * Returns tag array
     *
     * @param string $sArtId     article id
     * @param bool   $blExtended if can extend tags
     *
     * @return array
     */
    public function getTags($sArtId = null, $blExtended = false)
    {
        $oDb = oxDb::getDb(true);
        if ($blExtended) {
            $iAmount = OXTAGCLOUD_EXTENDEDCOUNT;
        } else {
            $iAmount = OXTAGCLOUD_STARTPAGECOUNT;
        }

        $sArticleSelect = " 1 ";
        if ( $sArtId ) {
            $sArtId = $oDb->quote( $sArtId );
            $sArticleSelect = " oxarticles.oxid = $sArtId ";
            $iAmount = 0;
        }

        $sField = "oxartextends.oxtags".oxLang::getInstance()->getLanguageTag();

        $sArtView = getViewName('oxarticles');
        $sQ = "select $sField as oxtags from $sArtView as oxarticles left join oxartextends on oxarticles.oxid=oxartextends.oxid where oxarticles.oxactive=1 AND $sArticleSelect";
        //$sQ = "select $sField from oxartextends where $sArticleSelect";
        $rs = $oDb->execute( $sQ );
        $aTags = array();
        while ( $rs && $rs->recordCount() && !$rs->EOF ) {
            $sTags = $this->trimTags( $rs->fields['oxtags'] );
            $aArticleTags = explode( ' ', $sTags );
            foreach ( $aArticleTags as $sTag ) {
                if ( trim( $sTag ) ) {
                    ++$aTags[$sTag];
                }
            }
            $rs->moveNext();
        }

        //taking only top tags
        if ( $iAmount ) {
            arsort($aTags);
            $aTags = array_slice($aTags, 0, $iAmount, true );
        }

        ksort($aTags);
        return $aTags;
    }

    /**
     * Returns HTML formated Tag Cloud
     *
     * @param string $sArtId     article id
     * @param bool   $blExtended if can extend tags
     *
     * @return string
     */
    public function getTagCloud($sArtId = null, $blExtended = false)
    {
        $sTagCloud = "";
        $sCacheKey = $this->_getCacheKey($blExtended);
        if ( $this->_sCacheKey && !$sArtId ) {
            $sTagCloud = oxUtils::getInstance()->fromFileCache( $sCacheKey );
        }

        if ( $sTagCloud ) {
            return $sTagCloud;
        }

        startProfile('trimTags');
        $aTags = $this->getTags($sArtId, $blExtended);
        stopProfile('trimTags');
        if (!count($aTags)) {
            return $sTagCloud;
        }

        $iMaxHit = max( $aTags);
        $blSeoIsActive = oxUtils::getInstance()->seoIsActive();
        if ( $blSeoIsActive) {
            $oSeoEncoder = oxSeoEncoder::getInstance();
        }

        $iLang = oxLang::getInstance()->getBaseLanguage();
        $sUrl = $this->getConfig()->getShopUrl();

        foreach ($aTags as $sTag => $sRelevance) {
            $sLink = $sUrl."index.php?cl=tag&amp;searchtag=".rawurlencode($sTag)."&amp;lang=".$iLang;
            if ( $blSeoIsActive) {
                $sLink = $oSeoEncoder->getDynamicUrl( "index.php?cl=tag&amp;searchtag=".rawurlencode($sTag), "tag/$sTag/", $iLang );
            }
            $sTagCloud .= "<a style='font-size:". $this->_getFontSize($sRelevance, $iMaxHit) ."%;' href='$sLink'>".htmlentities($sTag, ENT_QUOTES, 'UTF-8')."</a> ";
        }

        if ($this->_sCacheKey && !$sArtId) {
            oxUtils::getInstance()->toFileCache($sCacheKey, $sTagCloud);
        }

        return $sTagCloud;
    }

    /**
     * Returns font size value for current occurence depending on max occurence.
     *
     * @param int $iHit    hit count
     * @param int $iMaxHit max hits count
     *
     * @return int
     */
    protected function _getFontSize($iHit, $iMaxHit)
    {
        //handling special case
        if ($iMaxHit <= OXTAGCLOUD_MINOCCURENCETOSHOW || !$iMaxHit) {
            return OXTAGCLOUD_MINFONT;
        }

        $iFontDiff = OXTAGCLOUD_MAXFONT - OXTAGCLOUD_MINFONT;
        $iMaxHitDiff = $iMaxHit - OXTAGCLOUD_MINOCCURENCETOSHOW;
        $iHitDiff = $iHit - OXTAGCLOUD_MINOCCURENCETOSHOW;

        if ($iHitDiff < 0) {
            $iHitDiff = 0;
        }

        $iSize = round($iHitDiff * $iFontDiff / $iMaxHitDiff) + OXTAGCLOUD_MINFONT;

        return $iSize;
    }

    /**
     * Takes tag string and makes shorter tags longer by adding underscore.
     * This is needed for FULLTEXT index
     *
     * @param string $sTags given tag
     *
     * @return string
     */
    public function prepareTags( $sTags )
    {
        $aTags = explode( ' ', $sTags );
        $sRes = '';
        foreach ( $aTags as $sTag ) {
            if ( ( $iLen = getStr()->strlen( $sTag ) ) ) {
                if ( $iLen < OXTAGCLOUD_MINTAGLENGTH ) {
                    $sTag .= str_repeat( '_', OXTAGCLOUD_MINTAGLENGTH - $iLen );
                }

                $sRes .= getStr()->strtolower( $sTag ) . " ";
            }
        }

        return trim( $sRes );
    }

    /**
     * Trims underscores from tags.
     *
     * @param string $sTags given tag
     *
     * @return string
     */
    public function trimTags($sTags)
    {
        $aTags = explode(' ', $sTags);
        $sRes = '';
        foreach ( $aTags as $sTag ) {
            if ( getStr()->strlen( $sTag ) ) {
                $sRes .= rtrim( $sTag, '_' ) . " ";
            }
        }

        return trim( $sRes );
    }

    /**
     * Resets tag cache
     *
     * @return null
     */
    public function resetTagCache()
    {
        $sCacheKey1 = $this->_getCacheKey(true);
        oxUtils::getInstance()->toFileCache($sCacheKey1, null);

        $sCacheKey2 = $this->_getCacheKey(false);
        oxUtils::getInstance()->toFileCache($sCacheKey2, null);
    }

    /**
     * Returns tag cache key name.
     *
     * @param bool $blExtended Whether to display full list
     *
     * @return null
     */
    protected function _getCacheKey($blExtended)
    {
        return $this->_sCacheKey."_".$this->getConfig()->getShopId()."_".oxLang::getInstance()->getBaseLanguage()."_".$blExtended;
    }

}
