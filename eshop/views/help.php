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
 * @version   SVN: $Id: help.php 28138 2010-06-03 13:20:44Z arvydas $
 */

/**
 * Shop help window.
 * Arranges shop help information window, with help texts. (Help
 * text may be changed in file (shop directory) -> help ->
 * default.inc.tpl ). OXID eShop -> HELP.
 */
class Help extends oxUBase
{
    /**
     * Current class template name.
     * @var string
     */
    protected $_sThisTemplate = 'help.tpl';

    /**
     * Help text
     * @var string
     */
    protected $_sHelpText = null;

    /**
     * Defautl help page name
     * @var string
     */
    protected $_sDefaultPage = 'default';

    /**
     * Help content ident
     *
     * @var string
     */
    protected $_sHelpContentId = null;

    /**
     * Current view search engine indexing state
     *
     * @var int
     */
    protected $_iViewIndexState = VIEW_INDEXSTATE_NOINDEXNOFOLLOW;

    /**
     * Loads help text, executes parent::render() and returns name
     * of template file to render help::_sThisTemplate.
     *
     * Template variables:
     * <b>helptext</b>
     *
     * @return  string  $this->_sThisTemplate   current template file name
     */
    public function render()
    {
        $this->_aViewData["helptext"] = $this->getHelpText();

        parent::render();

        return $this->_sThisTemplate;
    }

    /**
     * Reads and returns help file contents
     *
     * @param string $sHelpPage help page name
     * @param string $sLang     help language
     *
     * @deprecated should be used help::getContentId() instead
     *
     * @return string | false
     */
    protected function _getHelpPageContents( $sHelpPage, $sLang )
    {
        if ( $sHelpPage ) {
            $aHelpPages[] = basename( $sHelpPage );
        }
        $aHelpPages[] = $this->_sDefaultPage;

        $sContents = false;
        $sPath = getShopBasePath()."help/{$sLang}/";

        foreach ( $aHelpPages as $sPage ) {
            $sHelpPath = $sPath . $sPage . ".inc.tpl";
            if ( is_readable( $sHelpPath ) ) {
                $sContents = file_get_contents( $sHelpPath );
                break;
            }
        }

        return $sContents;
    }

    /**
     * Template variable getter. Returns help text
     *
     * @deprecated should be used help::getContentId() instead
     *
     * @return string
     */
    public function getHelpText()
    {
        if ( $this->_sHelpText === null ) {
            $sHelpPage = oxConfig::getParameter( 'tpl' );
            $sHelpPage = $sHelpPage ? $sHelpPage : oxConfig::getParameter( 'page' );
            $this->_sHelpText = $this->_getHelpPageContents( $sHelpPage, oxLang::getInstance()->getBaseLanguage() );
        }
        return $this->_sHelpText;
    }

    /**
     * Template variable getter. Returns active content id.
     * If no content id specified, uses "impressum" content id
     *
     * @return object
     */
    public function getContentId()
    {
        if ( $this->_sHelpContentId === null ) {
            $oDb = oxDb::getDb();

            $sQ = "";
            if ( $sIdent = oxConfig::getParameter( 'oxcid' ) ) {
                $sQ = "select oxid from oxcontents where oxactive = 1 and oxloadid = " . $oDb->quote( $sIdent ) . " union ";
            }
            $sQ .= "select oxid from oxcontents where oxactive = 1 and oxloadid = 'oxhelpdefault'";

            // checking if user defined content exists..
            $this->_sHelpContentId = $oDb->getOne( $sQ );
        }

        return $this->_sHelpContentId;
    }
}
