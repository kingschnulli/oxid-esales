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
 * @copyright (C) OXID eSales AG 2003-2011
 * @version OXID eShop CE
 * @version   SVN: $Id: tags.php 35786 2011-06-03 07:59:07Z linas.kukulskis $
 */

/**
 * Shows bigger tag cloud
 */
class Tags extends oxUBase
{
    /**
     * Class template
     *
     * @var string
     */
    protected $_sThisTemplate = "page/tags/tags.tpl";

    /**
     * Returns tag cloud manager class
     *
     * @return oxTagCloud
     */
    public function getTagCloudManager()
    {
        $oManager = oxNew( "oxTagCloud" );
        $oManager->setExtendedMode( true );
        return $oManager;
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
     * Returns SEO suffix for page title
     *
     * @return string
     */
    public function getTitleSuffix()
    {
    }

    /**
     * Returns title page suffix used in template
     *
     * @return string
     */
    public function getTitlePageSuffix()
    {
        if ( ( $iPage = $this->getActPage() ) ) {
            return oxLang::getInstance()->translateString( 'INC_HEADER_TITLEPAGE' ). ( $iPage + 1 );
        }
    }

    /**
     * Returns Bread Crumb - you are here page1/page2/page3...
     *
     * @return array
     */
    public function getBreadCrumb()
    {
        $aPaths = array();
        $aCatPath = array();

        $aCatPath['title'] = oxLang::getInstance()->translateString( 'TAGS', oxLang::getInstance()->getBaseLanguage(), false );
        $aCatPath['link']  = $this->getLink();
        $aPaths[] = $aCatPath;

        return $aPaths;
    }

}
