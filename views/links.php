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
 * @copyright (C) OXID eSales AG 2003-2010
 * @version OXID eShop CE
 * $Id: links.php 16306 2009-02-05 10:28:05Z rimvydas.paskevicius $
 */

/**
 * Interesting, useful links window.
 * Arranges interesting links window (contents may be changed in
 * administrator GUI) with short link description and URL. OXID
 * eShop -> LINKS.
 */
class Links extends oxUBase
{
    /**
     * Current class template name.
     * @var string
     */
    protected $_sThisTemplate = 'links.tpl';

    /**
     * Links list.
     * @var object
     */
    protected $_oLinksList = null;

    /**
     * Executes parent::render(), loads links list and passes it to
     * template engine. Returns name of template to render links::_sThisTemplate.
     *
     * Template variables:
     * <b>linkslist</b>
     *
     * @return  string  $this->_sThisTemplate   current template file name
     */
    public function render()
    {
        parent::render();

        $this->_aViewData['linkslist'] = $this->getLinksList();

        return $this->_sThisTemplate;
    }

    /**
     * Template variable getter. Returns links list
     *
     * @return object
     */
    public function getLinksList()
    {
        if ( $this->_oLinksList === null ) {
            $this->_oLinksList = false;
            // Load links
            $oLinksList = oxNew( "oxlist" );
            $oLinksList->init( "oxlinks" );
            $oLinksList->getList();
            $this->_oLinksList = $oLinksList;
        }
        return $this->_oLinksList;
    }

}