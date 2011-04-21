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
 * @version   SVN: $Id$
 */

require_once realpath( "." ).'/unit/OxidTestCase.php';
require_once realpath( "." ).'/unit/test_config.inc.php';

/**
 * Tests for Shop_Config class
 */
class Unit_Admin_ThemeConfigTest extends OxidTestCase
{
    /**
     * Shop_Config::Render() test case
     *
     * @return null
     */
    public function testRender()
    {
        $this->markTestIncomplete();
        // testing..
        $oView = new Theme_Config();
        $this->assertEquals( 'theme_config.tpl', $oView->render() );
    }


    public function testGetModuleForConfigVars()
    {
        $this->markTestIncomplete();
        $sCl = oxTestModules::publicize('Shop_Theme', '_getModuleForConfigVars');
        $oTest = new $sCl;
        $this->assertEquals('theme:azure', $oTest->p_getModuleForConfigVars());
    }

    public function testGetTemplateOptionsLanguageFile()
    {
        $this->markTestIncomplete();
        $oCfg = $this->getMock('oxconfig', array('getLanguagePath', 'getConfigParam'));
        $oCfg->expects($this->once())->method('getLanguagePath')
                ->with(
                    $this->equalTo("theme_options.php"),
                    $this->equalTo(false),
                    $this->equalTo(oxLang::getInstance()->getTplLanguage()),
                    $this->equalTo(null),
                    $this->equalTo('basicx')
                )
                ->will($this->returnValue('filenametoload'));
        $oCfg->expects($this->once())->method('getConfigParam')
                ->with($this->equalTo("sTheme"))
                ->will($this->returnValue('basicx'));

        $oT = $this->getMock('Shop_Theme', array('getConfig'), array(), '', false);
        $oT->expects($this->any())->method('getConfig')->will($this->returnValue($oCfg));

        $this->assertEquals('filenametoload', $oT->UNITgetTemplateOptionsLanguageFile());
    }

    public function testGetTemplateOptionsLanguageFileNoFile()
    {
        $this->markTestIncomplete();
        $oCfg = $this->getMock('oxconfig', array('getLanguagePath', 'getConfigParam'));
        $oCfg->expects($this->once())->method('getLanguagePath')
                ->will($this->returnValue(''));
        $oCfg->expects($this->any())->method('getConfigParam')
                ->with($this->equalTo("sTheme"))
                ->will($this->returnValue('basicx'));

        $oT = $this->getMock('Shop_Theme', array('getConfig'), array(), '', false);
        $oT->expects($this->any())->method('getConfig')->will($this->returnValue($oCfg));

        try {
            $oT->UNITgetTemplateOptionsLanguageFile();
            $this->fail('no exception');
        } catch (oxFileException $e) {
            $this->assertEquals('EXCEPTION_FILENOTFOUND', $e->getMessage());
            $this->assertEquals('theme_options.php for the theme "basicx"', $e->getFileName());
        }
    }
}
