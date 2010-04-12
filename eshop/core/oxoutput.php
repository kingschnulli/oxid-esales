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
 * @version   SVN: $Id: oxoutput.php 25467 2010-02-01 14:14:26Z alfonsas $
 */

/**
 * class for output processing
 * @package core
 */
class oxOutput extends oxSuperCfg
{
    /**
     * Keels search engine status
     *
     * @var bool
     */
    protected $_blSearchEngine = false;

    /**
     * Class constructor. Sets search engine mode according to client info
     *
     * @return null
     */
    public function __construct()
    {
        $this->setIsSearchEngine( oxUtils::getInstance()->isSearchEngine() );
    }

    /**
     * Search engine mode setter
     *
     * @param bool $blOn search engine mode
     *
     * @return null
     */
    public function setIsSearchEngine( $blOn )
    {
        $this->_blSearchEngine = $blOn;
    }

    /**
     * function for front-end (normaly HTML) output processing
     * This function is called from index.php
     *
     * @param string $sValue     value
     * @param string $sClassName classname
     *
     * @return string
     */
    public function process( $sValue, $sClassName )
    {
        $myConfig = $this->getConfig();

        //fix for euro currency problem (it's invisible in some older browsers)
        if ( !$myConfig->getConfigParam( 'blSkipEuroReplace' ) && !$myConfig->isUtf() ) {
            $sValue = str_replace( '�', '&euro;', $sValue );
        }

        return $sValue;
    }

    /**
     * Add a version tag to a html page
     *
     * @param string $sOutput htmlheader
     *
     * @return string
     */
    final public function addVersionTags( $sOutput )
    {
        // DISPLAY IT
        $sVersion = $this->getConfig()->getVersion();
        $sEdition = $this->getConfig()->getFullEdition();
        $sCurYear = date("Y");

        // Replacing only once per page
        $sOutput = preg_replace("/<\/head>/i", "</head>\n  <!-- OXID eShop {$sEdition}, Version {$sVersion}, Shopping Cart System (c) OXID eSales AG 2003 - {$sCurYear} - http://www.oxid-esales.com -->", ltrim($sOutput), 1);

        return $sOutput;
    }

    /**
     * Abstract function for smarty tag processing
     * This function is called from index.php
     *
     * @param array  $aViewData  viewarray
     * @param string $sClassName classname
     *
     * @return array
     */
    public function processViewArray($aViewData, $sClassName)
    {
        return $aViewData;
    }

    /**
     * This function is called from index.php
     *
     * @param object &$oEmail email object
     *
     * @return null
     */
    public function processEmail( & $oEmail)
    {
        // #669 PHP5 claims that you cant pas full this but should instead pass reference what is anyway a much better idea
        // dodger: removed "return" as by reference you dont need any return

    }
}