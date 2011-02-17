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
 * @package   tests
 * @copyright (C) OXID eSales AG 2003-2011
 * @version OXID eShop CE
 * @version   SVN: $Id: langFileIntegrityTest.php 26841 2010-03-25 13:58:15Z arvydas $
 */

require_once realpath( "." ).'/unit/OxidTestCase.php';
require_once realpath( "." ).'/unit/test_config.inc.php';

/**
 * Tests language files and templates for missing constants.
 */
class Unit_Maintenance_guiFileIntegrityTest extends OxidTestCase
{

    /**
     * Initialize the fixture.
     *
     * @return null
     */
    protected function setUp()
    {
        parent::setUp();

//        modConfig::getInstance()->sTheme = false;
        $this->_sOrigTheme = modConfig::getInstance()->getRealInstance()->getConfigParam('sTheme');
        modConfig::getInstance()->getRealInstance()->setConfigParam('sTheme', 'basic');
    }

    /**
     * Tear down the fixture.
     *
     * @return null
     */
    protected function tearDown()
    {
        modConfig::getInstance()->getRealInstance()->setConfigParam('sTheme', $this->_sOrigTheme);
    }

    /**
     * Test css files matches generated with gui.
     *
     * @return null
     */
    public function testCssIntegrity()
    {
        $sSrcCssPath = oxConfig::getInstance()->getResourcePath('oxid'.OXID_VERSION_SUFIX.'.css');
        $sSrcCss = file_get_contents($sSrcCssPath);
        $sSrcCss = str_replace("\r","",$sSrcCss);

        $sGuiCssPath = oxConfig::getInstance()->getResourcePath('gui/oxid.tpl.css');
        $sGuiCss = "/* OXID look&feel generated CSS */\n\n".file_get_contents($sGuiCssPath);
        $sGuiCss = str_replace("\r","",$sGuiCss);
        $sGuiCss = strtr($sGuiCss, $this->_getStyles());

        $this->assertEquals( $sGuiCss, $sSrcCss);
    }

    /**
     * Collect all needed style constants with values to replace in css template.
     *
     * @return array
     */
    protected function _getStyles()
    {


        $aColors = array("#ffffff","#e2e2e2","#555555","#000000","#fc6634");
        $sGifExt = '_ce_.gif';

        $aStyles = array();
        $aStyles["oxFauxColBg"] = 'bg/bd'.$sGifExt;
        $aStyles["oxSprite"]    = 'bg/oxid'.$sGifExt;
        $aStyles["oxButtons"]   = 'bg/buttons'.$sGifExt;
        $aStyles["oxSeparator"] = 'bg/sepatator'.$sGifExt;

        $sGuiXmlPath = oxConfig::getInstance()->getResourcePath('gui/gui.xml');

        $oGuiDom = new DomDocument();
        $oGuiDom->preserveWhiteSpace = false;
        $oGuiDom->load( $sGuiXmlPath );

        $oGuiXPath  = new DomXPath( $oGuiDom );
        $oStyleList = $oGuiXPath->query( "/gui/css//color" );
        foreach ( $oStyleList as $oStyle ) {
            $aStyles[$oStyle->getAttribute('const')] = $aColors[$oStyle->getAttribute('color')];
        }

        return $aStyles;
    }

}
