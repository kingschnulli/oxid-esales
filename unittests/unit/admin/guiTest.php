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
 * @version   SVN: $Id: guiTest.php 28257 2010-06-09 14:46:17Z michael.keiluweit $
 */

require_once realpath( "." ).'/unit/OxidTestCase.php';
require_once realpath( "." ).'/unit/test_config.inc.php';

/**
 * Test Gui module
 */
class _Gui extends Gui
{
    /**
     * class constructor, do nothing
     * 
     * @return null
     */
    public function __construct()
    {
    }

    /**
     * Overriding this method helps to skip additional of deeper functions
     *
     * @return bool
     */
    public function _authorize()
    {
        return true;
    }

    /*
    public function _loadGuiFiles()
    {
        $this->_blLoaded = true;
    }
    */
    
    /**
     * Get private field value.
     *
     * @param string $sName Field name
     *
     * @return mixed
     */
    public function getVar( $sName )
    {
        return $this->{'_'.$sName};
    }

    /**
     * Set private field value.
     *
     * @param string $sName  Field name
     * @param string $sValue Field value
     *
     * @return null
     */
    public function setVar( $sName, $sValue )
    {
        $this->{'_'.$sName} = $sValue;
    }
}

/**
 * Tests for Gui class
 */
class Unit_Admin_GuiTest extends OxidTestCase
{
    public $oGui;

    public $sGuiXml = '<?xml version="1.0" encoding="ISO-8859-15"?>
    <gui>
        <gif tpl="test.tpl.gif" file="test.gif" const="oxTestGif">
            <color color="0" const="oxGifColor1" />
            <color color="1" const="oxGifColor2" />
        </gif>
        <css tpl="test.tpl.css" file="test.css">
            <group title="GROUP1">
                <color const="oxCssColor1" color="1" title="CSS_COLOR1" />
                <color const="oxCssColor2" color="2" title="CSS_COLOR2" />
                <group title="GROUP2">
                    <color const="oxCssColor3" color="1" title="CSS_COLOR3" />
                    <color const="oxCssColor4" color="2" title="CSS_COLOR4" />
                </group>
            </group>
        </css>
    </gui>';

    public $sThemeXml = '<?xml version="1.0" encoding="ISO-8859-15"?>
    <themes>
        <theme id="ee" title="theme 1">
            <color index="0" color="#000"/>
            <color index="1" color="#111"/>
            <color index="2" color="#222"/>
            <color index="3" color="#333"/>
            <color index="4" color="#444"/>
        </theme>
        <theme id="pe" title="theme 2">
            <color index="0" color="#555"/>
            <color index="1" color="#666"/>
            <color index="2" color="#777"/>
            <color index="3" color="#888"/>
            <color index="4" color="#999"/>
        </theme>
        <theme id="ce" title="theme 3">
            <color index="0" color="#aaa"/>
            <color index="1" color="#bbb"/>
            <color index="2" color="#ccc"/>
            <color index="3" color="#ddd"/>
            <color index="4" color="#eee"/>
        </theme>
    </themes>';

    /**
     * Sets up test
     *
     * @return null
     */
    protected function setUp()
    {
        parent::setUp();

        $this->oGui = $this->getProxyClass('_Gui');

        $oGuiDom = new DomDocument();
        $oGuiDom->preserveWhiteSpace = false;

        $this->AssertTrue($oGuiDom->loadXML( $this->sGuiXml ));

        $oThemesDom = new DomDocument();
        $oThemesDom->preserveWhiteSpace = false;
        $this->AssertTrue($oThemesDom->loadXML( $this->sThemeXml ));

        $this->oGui->setVar('oGuiDom', $oGuiDom);
        $this->oGui->setVar('oThemesDom', $oThemesDom);
        $this->oGui->setVar('blLoaded', true);
    }


    /**
     * Gui::Init() test case
     *
     * @return null
     */
    public function testInit()
    {
        $oCfg = $this->getMock( "oxconfig", array( "getResourceDir" ));
        $oCfg->expects($this->once())->method('getResourceDir')->with($this->equalTo(false))->will($this->returnValue('shopdir/src/'));

        $oGui = $this->getMock('_Gui', array( "getConfig" ));
        $oGui->expects($this->any())->method('getConfig')->will($this->returnValue($oCfg));

        $oGui->init();

        $this->assertEquals('shopdir/src/', $oGui->getVar('sSrcDir'));
        $this->assertEquals('shopdir/src/gui/', $oGui->getVar('sGuiDir'));

    }

    /**
     * Gui::save() test case
     *
     * @return null
     */
    public function testSave()
    {
        $sTheme = 'ce';
        modConfig::setParameter('t', $sTheme);

        $sDir = tempnam('/tmp/', 'gui_');
        $sTplFile = 'test.tpl.css';
        touch($sDir.$sTplFile);

        $sCssFile = 'test.css';
        touch($sDir.$sCssFile);
        @chmod($sDir.$sCssFile, 0555);

        $sGifFile = 'test.gif';
        $sGifFile = str_replace('.gif', '_'.$sTheme.'_.gif', $sGifFile);

        touch($sDir.$sGifFile);
        @chmod($sDir.$sGifFile, 0555);

        oxTestModules::addFunction( 'oxUtils', 'setHeader', '{ $this->_sHeader = $aA[0]; }');
        oxTestModules::addFunction( 'oxUtils', 'getHeaders', '{ return $this->_sHeader; }');

        oxTestModules::addFunction( 'oxUtils', 'showMessageAndExit', '{ $this->_sMessage = $aA[0];}');
        oxTestModules::addFunction( 'oxUtils', 'getMessage', '{ return $this->_sMessage;}');

        $oGui = $this->getMock('_Gui', array( "Gif","saveUserSettings","getUserColors","getUserStyles"));
        $oGui->expects($this->any())->method('Gif');
        $oGui->expects($this->any())->method('saveUserSettings');
        $oGui->expects($this->any())->method('getUserColors')->will($this->returnValue(array()));
        $oGui->expects($this->any())->method('getUserStyles')->will($this->returnValue(array()));

        $oGuiDom = new DomDocument();
        $oGuiDom->preserveWhiteSpace = false;

        $oGuiDom->loadXML( $this->sGuiXml );

        $oThemesDom = new DomDocument();
        $oThemesDom->preserveWhiteSpace = false;
        $oThemesDom->loadXML( $this->sThemeXml );

        $oGui->setVar('oGuiDom', $oGuiDom);
        $oGui->setVar('oThemesDom', $oThemesDom);
        $oGui->setVar('blLoaded', true);
        $oGui->setVar('sSrcDir', $sDir);
        $oGui->setVar('sGuiDir', $sDir);

        $oGui->save();
        $this->assertEquals('', oxUtils::getInstance()->getMessage());

        // test write errors ...
        $sNoDir = tempnam('/tmp/', 'gui_non_existing_dir_').'/';
        $oGui->setVar('sSrcDir', $sNoDir);

        $oGui->save();
        $this->assertEquals('Could not write to : '.$sNoDir.$sGifFile."\n".'Could not write to : '.$sNoDir.$sCssFile, oxUtils::getInstance()->getMessage());

        unlink($sDir.$sTplFile);
        unlink($sDir.$sCssFile);
        unlink($sDir.$sGifFile);
    }

    /**
     * Gui::saveUserSettings() test case
     *
     * @return null
     */
    public function testSaveUserSetting()
    {
        $sDir = tempnam('/tmp/', 'gui_');
        $sFile = 'usergui.php';

        touch($sDir.$sFile);
        @chmod($sDir.$sFile, 0555);

        $sTheme  = "th";
        $aColors = array(1, 2, 3);
        $aStyles = array(4, 5, 6);

        $this->oGui->setVar('sSrcDir', $sDir);
        $this->oGui->saveUserSettings($sTheme, $aColors, $aStyles);

        $sCnt = "<?php \n";
        $sCnt.= "/* OXID look&feel generated file */\n\n";
        $sCnt.= '$sTheme  = "th";'."\n\n";
        $sCnt.= '$aColors = '.var_export( (array) array(1, 2, 3), true).";\n\n";
        $sCnt.= '$aStyles = '.var_export( (array) array(4, 5, 6), true).";\n\n";

        $this->assertEquals($sCnt, file_get_contents($sDir.$sFile));

        unlink($sDir.$sFile);
    }

    /**
     * Gui::loadUserSettings() test case
     *
     * @return null
     */
    public function testLoadUserSetting()
    {
        $sDir = tempnam('/tmp/', 'gui_');
        $sFile = 'usergui.php';

        $sCnt = "<?php \n";
        $sCnt.= "/* OXID look&feel generated file */\n\n";
        $sCnt.= '$sTheme  = "th";'."\n\n";
        $sCnt.= '$aColors = '.var_export( (array) array(1, 2, 3), true).";\n\n";
        $sCnt.= '$aStyles = '.var_export( (array) array(4, 5, 6), true).";\n\n";

        file_put_contents($sDir.$sFile, $sCnt);

        $this->oGui->setVar('sSrcDir', $sDir);
        $this->oGui->loadUserSettings(&$sTheme, &$aColors, &$aStyles);

        $this->assertEquals('th', $sTheme);
        $this->assertEquals(array(1, 2, 3), $aColors);
        $this->assertEquals(array(4, 5, 6), $aStyles);

        unlink($sDir.$sFile);
    }

    /**
     * Gui::_loadGuiFiles() test case
     *
     * @return null
     */
    public function testLoadGuiFiles()
    {
        $this->oGui->init();
        $this->oGui->UNITloadGuiFiles();

        $this->assertTrue($this->oGui->getVar('oGuiDom') instanceof DOMDocument);
        $this->assertTrue($this->oGui->getVar('oThemesDom') instanceof DOMDocument);
        $this->assertTrue($this->oGui->getVar('blLoaded'));
    }

    /**
     * Gui::Render() test case
     *
     * @return null
     */
    public function testRender()
    {
        $this->oGui->setVar('blLoaded', true);

        $this->assertEquals( 'gui.tpl', $this->oGui->render() );
    }

    /**
     * Gui::Render() test error case
     *
     * @return null
     */
    public function testRenderError()
    {
        $this->oGui->setVar('blLoaded', false);

        $this->assertEquals( 'gui_error.tpl', $this->oGui->render() );
    }

    /**
     * Gui::previewCss() test case
     *
     * @return null
     */
    public function testPreviewCss()
    {
        $sDir = tempnam('/tmp/', 'gui_');
        $sTplFile = 'test.tpl.css';
        touch($sDir.$sTplFile);

        oxTestModules::addFunction( 'oxUtils', 'setHeader', '{ $this->_sHeader = $aA[0]; }');
        oxTestModules::addFunction( 'oxUtils', 'getHeaders', '{ return $this->_sHeader; }');

        oxTestModules::addFunction( 'oxUtils', 'showMessageAndExit', '{ $this->_sMessage = $aA[0];}');
        oxTestModules::addFunction( 'oxUtils', 'getMessage', '{ return $this->_sMessage;}');

        modConfig::setParameter('gif', array('tpl'=>'bd.tpl.gif','const'=>'oxTestGif'));

        $this->oGui->setVar('sGuiDir',$sDir);

        //$this->oGui->init();
        $this->oGui->previewCss();

        $this->assertEquals('Content-type: text/css', oxUtils::getInstance()->getHeaders());
        $this->assertEquals('/* OXID GUI generated file css file */', oxUtils::getInstance()->getMessage());

        unlink($sDir.$sTplFile);
    }

    /**
     * Gui::previewGif() test case
     *
     * @return null
     */
    public function testPreviewGif()
    {
        modConfig::setParameter('gif', 'bd.tpl.gif');

        oxTestModules::addFunction( 'oxUtils', 'showMessageAndExit', '{}');

        $oGui = $this->getMock('_Gui', array( "Gif"));
        $oGui->expects($this->any())->method('Gif');

        $oGui->previewGif();
    }

    /**
     * Gui::Gif() test case
     *
     * @return null
     */
    public function testGif()
    {
        $sTpl = 'bd.tpl.gif';
        $aColors = array('#aaa', '#bbb');

        $sDir = '/tmp/';
        $sFile = basename(tempnam($sDir, 'gif_'));

        oxTestModules::addFunction( 'oxUtils', 'setHeader', '{ $this->_aHeaderData = $aA[0]; }');
        oxTestModules::addFunction( 'oxUtils', 'getHeaders', '{ return $this->_aHeaderData; }');

        $this->oGui->init();

        ob_start();
        $this->oGui->gif( $sTpl, $aColors );
        ob_end_clean();

        $this->assertEquals('Content-type: image/gif', oxUtils::getInstance()->getHeaders());

        $this->oGui->gif( $sTpl, $aColors, $sFile, $sDir );
        $this->assertTrue(is_readable($sDir.$sFile));

        unlink($sDir.$sFile);
    }

    /**
     * Gui::GetUserColors() test case
     *
     * @return null
     */
    public function testGetUserColors()
    {
        modConfig::setParameter('t', 'ce');
        modConfig::setParameter('c', array('#123', '#456'));

        $this->assertEquals(array('#123', '#456', '#aaa', '#bbb', '#ccc', '#ddd', '#eee'), $this->oGui->getUserColors());
    }

    /**
     * Gui::GetUserStyles() test case
     *
     * @return null
     */
    public function testGetUserStyles()
    {
        modConfig::setParameter('t', 'ce');
        modConfig::setParameter('s', array('oxCssColor1'=>'#aaa', 'oxCssColor2'=>'#bbb'));

        $this->assertEquals(array('oxCssColor1'=>'#aaa', 'oxCssColor2'=>'#bbb', 'oxCssColor3'=>1, 'oxCssColor4'=>2), $this->oGui->getUserStyles());
    }

    /**
     * Gui::FillColors() test case
     *
     * @return null
     */
    public function testFillColors()
    {
        // defining parameters
        $aStyles = array('const1' => 'index1', 'const2' => 'index2', 'const3' => 'index3', 'const4' => 'index4', 'const5' => '#fff');
        $aColors = array('index1' => 'color1', 'index2' => 'color2', 'index3' => 'color3', 'index4' => 'color4');

        $aFilled = array('const1' => 'color1', 'const2' => 'color2', 'const3' => 'color3', 'const4' => 'color4', 'const5' => '#fff');

        $this->assertEquals( $aFilled, $this->oGui->fillColors( $aStyles, $aColors) );
    }
    /**
     * Gui::GetThemes() test case
     *
     * @return null
     */
    public function testGetThemes()
    {
        $aThemes = $this->oGui->getThemes();

        $this->assertEquals( 3, count($aThemes) );
        $this->assertEquals( array('ee' => 'theme 1', 'pe' => 'theme 2', 'ce' => 'theme 3'), $aThemes);
    }

    /**
     * Gui::GetColors() test case
     *
     * @return null
     */
    public function testGetColors()
    {
        $aColors = $this->oGui->getColors('ee');

        $this->assertEquals( 5, count($aColors) );
        $this->assertEquals( array('#000', '#111', '#222', '#333', '#444'), $aColors );
    }

    /**
     * Gui::GetStyles() test case
     *
     * @return null
     */
    public function testGetStyles()
    {
        $aStyles = $this->oGui->getStyles();

        $this->assertEquals( 4, count($aStyles) );
        $this->assertEquals( array('oxCssColor1'=>1, 'oxCssColor2'=>2, 'oxCssColor3'=>1, 'oxCssColor4'=>2), $aStyles );
    }

    /**
     * Gui::GetRes() test case
     *
     * @return null
     */
    public function testGetRes()
    {
        $oRes = $this->oGui->getRes('gif');
        $this->assertTrue($oRes instanceof DOMNodeList);
        $this->assertEquals(1, $oRes->length);
    }

    /**
     * Gui::GetResColors() test case
     *
     * @return null
     */
    public function testGetResColors()
    {
        $aColors = $this->oGui->getResColors( 'gif', 'test.tpl.gif');

        $this->assertEquals( 2, count($aColors) );
        $this->assertEquals( array('oxGifColor1'=>0, 'oxGifColor2'=>1), $aColors );
    }

    /**
     * Gui::GetImageColors() test case
     *
     * @return null
     */
    public function testGetImageColors()
    {
        $aColors = $this->oGui->getImageColors('oxTestGif', array('oxGifColor1'=>'#111', 'oxGifColor2'=>'#222'));

        $this->assertEquals(2, count($aColors));
        $this->assertEquals(array('#111', '#222'), $aColors);
    }

    /**
     * Gui::GetStyleTree() test case
     *
     * @return null
     */
    public function testGetStyleTree()
    {
        $oStyleTree = $this->oGui->getStyleTree();
        $this->assertTrue($oStyleTree instanceof DOMNodeList);
        $this->assertEquals(1, $oStyleTree->length);
    }

    /**
     * Gui::Hex2rgb() test case
     *
     * @return null
     */
    public function testHex2rgb()
    {
        $this->assertEquals( array(0, 0, 0), $this->oGui->hex2rgb('#000000') );
        $this->assertEquals( array(255, 255, 255), $this->oGui->hex2rgb('#fff')    );
        $this->assertEquals( array(15, 80, 163), $this->oGui->hex2rgb('#0f50a3') );
        $this->assertEquals( array(0, 255, 85), $this->oGui->hex2rgb('#0f5')    );
        $this->assertEquals( array(15, 15, 163), $this->oGui->hex2rgb('#gfsfa3') );
    }
}