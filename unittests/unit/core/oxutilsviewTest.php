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
 * @version   SVN: $Id: oxutilsviewTest.php 28223 2010-06-08 12:28:06Z sarunas $
 */

require_once realpath( "." ).'/unit/OxidTestCase.php';
require_once realpath( "." ).'/unit/test_config.inc.php';

class Unit_Core_oxUtilsViewTest extends OxidTestCase
{
    /**
     * oxUtilsView::getTemplateDirs() test case
     *
     * @return null
     */
    public function testGetTemplateDirs()
    {
        $myConfig = oxConfig::getInstance();
        $aDirs = array();
        $aDirs[] = $myConfig->getTemplateDir( false );
        $sDir = $myConfig->getOutDir( true ) . $myConfig->getConfigParam( 'sTheme' ) . "/tpl/";
        if ( !in_array( $sDir, $aDirs ) ) {
            $aDirs[] = $sDir;
        }

        $sDir = $myConfig->getOutDir( true ) . "basic/tpl/";
        if ( !in_array( $sDir, $aDirs ) ) {
            $aDirs[] = $sDir;
        }

        //
        $oUtilsView = $this->getMock( "oxUtilsView", array( "isAdmin" ) );
        $oUtilsView->expects( $this->any() )->method( 'isAdmin' )->will( $this->returnValue( false ) );
        $this->assertEquals( $aDirs, $oUtilsView->getTemplateDirs() );
    }

    /**
     * oxUtilsView::setTemplateDir() test case
     *
     * @return null
     */
    public function testSetTemplateDir()
    {
        $myConfig = oxConfig::getInstance();
        $aDirs[] = "testDir1";
        $aDirs[] = "testDir2";
        $aDirs[] = $myConfig->getTemplateDir( false );
        $sDir = $myConfig->getOutDir( true ) . $myConfig->getConfigParam( 'sTheme' ) . "/tpl/";
        if ( !in_array( $sDir, $aDirs ) ) {
            $aDirs[] = $sDir;
        }

        $sDir = $myConfig->getOutDir( true ) . "basic/tpl/";
        if ( !in_array( $sDir, $aDirs ) ) {
            $aDirs[] = $sDir;
        }

        //
        $oUtilsView = $this->getMock( "oxUtilsView", array( "isAdmin" ) );
        $oUtilsView->expects( $this->any() )->method( 'isAdmin' )->will( $this->returnValue( false ) );
        $oUtilsView->setTemplateDir( "testDir1" );
        $oUtilsView->setTemplateDir( "testDir2" );
        $oUtilsView->setTemplateDir( "testDir1" );

        $this->assertEquals( $aDirs, $oUtilsView->getTemplateDirs() );
    }

    /**
     * Testing smarty getter + its caching
     */
    public function testGetSmartyCacheCheck()
    {
        $oUtilsView = $this->getMock( 'oxutilsview', array( '_fillCommonSmartyProperties', '_smartyCompileCheck' ) ) ;
        $oUtilsView->expects( $this->once() )->method( '_fillCommonSmartyProperties' );
        $oUtilsView->expects( $this->once() )->method( '_smartyCompileCheck' );

        // on second call defined methods should not be executed again
        $oUtilsView->getSmarty( true );
        $oUtilsView->getSmarty();
    }

    /**
     * Testing template processign code + skipped debug output code
     */
    public function testGetTemplateOutput()
    {
        modConfig::getInstance()->setConfigParam( 'iDebug', 0 );
        $sPath = getTestsBasePath();
        $sTpl  = $sPath."/misc/testTempOut.tpl";

        $oView = new oxview();
        $oView->addTplParam( 'articletitle', 'xxx' );

        $oUtilsView = new oxutilsview();
        $oUtilsView->getSmarty( true );

        $this->assertEquals( 'xxx', $oUtilsView->getTemplateOutput( $sTpl, $oView ) );
    }

    public function testPassAllErrorsToView()
    {
        $aView = array();
        $aErrors[1][2] = serialize("foo");
        oxUtilsView::getInstance()->passAllErrorsToView($aView, $aErrors);
        $this->assertEquals($aView['Errors'][1][2], "foo");
    }

    public function testAddErrorToDisplayCustomDestinationFromParam()
    {
        oxUtilsView::getInstance()->addErrorToDisplay("testMessage", false, true, "myDest");
        $aErrors = oxSession::getVar('Errors');
        $oEx = unserialize($aErrors['myDest'][0]);
        $this->assertEquals("testMessage", $oEx->getOxMessage());
    }

    public function testAddErrorToDisplayCustomDestinationFromPost()
    {
        $myConfig = oxConfig::getInstance();
        modConfig::setParameter('CustomError', 'myDest');

        oxUtilsView::getInstance()->addErrorToDisplay("testMessage", false, true, "");
        $aErrors = oxSession::getVar('Errors');
        $oEx = unserialize($aErrors['myDest'][0]);
        $this->assertEquals("testMessage", $oEx->getOxMessage());
    }

    public function testAddErrorToDisplayDefaultDestination()
    {
        oxUtilsView::getInstance()->addErrorToDisplay("testMessage", false, true, "");
        $aErrors = oxSession::getVar('Errors');
        $oEx = unserialize($aErrors['default'][0]);
        $this->assertEquals("testMessage", $oEx->getOxMessage());
    }

    public function testAddErrorToDisplayUsingExeptionObject()
    {
        $aTest = array();
        $oTest = oxNew('oxException');
        $oTest->setMessage("testMessage");
        oxUtilsView::getInstance()->addErrorToDisplay($oTest, false, false, "");

        $aErrors = oxSession::getVar('Errors');
        $oEx = unserialize($aErrors['default'][0]);
        $this->assertEquals("testMessage", $oEx->getOxMessage());
    }

    public function testAddErrorToDisplayIfNotSet()
    {
        oxUtilsView::getInstance()->addErrorToDisplay(null, false, false, "");

        $aErrors = oxSession::getVar('Errors');
        //$oEx = unserialize($aErrors['default'][0]);
        //$this->assertEquals("", $oEx->getOxMessage());
        $this->assertFalse( isset( $aErrors['default'][0] ) );
    }

    /**
     * Testing smarty processor
     */
    public function testParseThroughSmarty()
    {
        $aData['shop'] = new oxstdclass();
        $aData['shop']->urlSeparator = '?';

        $oActView = $this->getMock( 'oxview', array( 'getViewData' ) );
        $oActView->expects( $this->once() )->method( 'getViewData' )->will( $this->returnValue( $aData ) );

        $oUtilsView = new oxutilsview();
        $this->assertEquals( '?', $oUtilsView->parseThroughSmarty( '[{$shop->urlSeparator}]', time(), $oActView ) );

        $oActView = $this->getMock( 'oxview', array( 'getViewData' ) );
        $oActView->expects( $this->once() )->method( 'getViewData' )->will( $this->returnValue( $aData ) );

        $oUtilsView = new oxutilsview();
        $this->assertEquals( array( '!' => '?' ), $oUtilsView->parseThroughSmarty( array( '!' => array( '%', '[{$shop->urlSeparator}]' ) ), time(), $oActView ) );
    }

    /**
     * Testing smarty config data setter
     */
    // demo mode
    public function testFillCommonSmartyPropertiesANDSmartyCompileCheckDemoShop()
    {
        modConfig::getInstance()->setConfigParam( 'iDebug', 1 );
        modConfig::getInstance()->setConfigParam( 'blDemoShop', 1 );

        $myConfig = oxConfig::getInstance();

        $sTplDir = $myConfig->getTemplateDir( $myConfig->isAdmin() );

        $aTemplatesDir = array();
        if ( $sTplDir ) {
            $aTemplatesDir[] = $sTplDir;
        }

        $sTplDir = $myConfig->getOutDir() . $myConfig->getConfigParam('sTheme') . "/tpl/";
        if ( $sTplDir && !in_array( $sTplDir, $aTemplatesDir ) ) {
            $aTemplatesDir[] = $sTplDir;
        }

        $aCheck = array( 'php_handling'    => 2,
                         'security'        => true,
                         'php_handling'    => SMARTY_PHP_REMOVE,
                         'left_delimiter'  => '[{',
                         'right_delimiter' => '}]',
                         'caching'         => false,
                         'compile_dir'     => $myConfig->getConfigParam( 'sCompileDir' ),
                         'cache_dir'       => $myConfig->getConfigParam( 'sCompileDir' ),
                         'template_dir'    => $aTemplatesDir,
                         'compile_id'      => md5($myConfig->getTemplateDir( false )),
                         'debugging'       => true,
                         'compile_check'   => true,
                         'security_settings' => array (
                                                  'PHP_HANDLING' => false,
                                                  'IF_FUNCS' =>
                                                  array (
                                                    0 => 'array',
                                                    1 => 'list',
                                                    2 => 'isset',
                                                    3 => 'empty',
                                                    4 => 'count',
                                                    5 => 'sizeof',
                                                    6 => 'in_array',
                                                    7 => 'is_array',
                                                    8 => 'true',
                                                    9 => 'false',
                                                    10 => 'null',
                                                    11 => 'XML_ELEMENT_NODE',
                                                  ),
                                                  'INCLUDE_ANY' => false,
                                                  'PHP_TAGS' => false,
                                                  'MODIFIER_FUNCS' =>
                                                  array (
                                                    0 => 'count',
                                                    1 => 'round',
                                                    2 => 'floor',
                                                    3 => 'trim',
                                                    4 => 'is_array',
                                                  ),
                                                  'ALLOW_CONSTANTS' => true,
                                                  'ALLOW_SUPER_GLOBALS' => true,
                                                )
                );


        $oSmarty = $this->getMock( 'smarty', array( 'register_resource' ) );
        $oSmarty->expects( $this->once() )->method( 'register_resource' );

        $oUtilsView = new oxutilsview();
        $oUtilsView->UNITfillCommonSmartyProperties( $oSmarty );
        $oUtilsView->UNITsmartyCompileCheck( $oSmarty );

        foreach ( $aCheck as $sVarName => $sVarValue ) {
            $this->assertTrue( isset( $oSmarty->$sVarName ) );
            $this->assertEquals( $oSmarty->$sVarName, $sVarValue, $sVarName );
        }
    }
    // non demo mode
    public function testFillCommonSmartyPropertiesANDSmartyCompileCheck()
    {
        modConfig::getInstance()->setConfigParam( 'iDebug', 1 );
        modConfig::getInstance()->setConfigParam( 'blDemoShop', 0 );

        $myConfig = oxConfig::getInstance();

        $sTplDir = $myConfig->getTemplateDir( $myConfig->isAdmin() );

        $aTemplatesDir = array();
        if ( $sTplDir ) {
            $aTemplatesDir[] = $sTplDir;
        }

        $sTplDir = $myConfig->getOutDir() . $myConfig->getConfigParam('sTheme') . "/tpl/";
        if ( $sTplDir && !in_array( $sTplDir, $aTemplatesDir ) ) {
            $aTemplatesDir[] = $sTplDir;
        }

        $aCheck = array( 'php_handling'    => 2,
                         'security'        => false,
                         'php_handling'    => (int) $myConfig->getConfigParam( 'iSmartyPhpHandling' ),
                         'left_delimiter'  => '[{',
                         'right_delimiter' => '}]',
                         'caching'         => false,
                         'compile_dir'     => $myConfig->getConfigParam( 'sCompileDir' ),
                         'cache_dir'       => $myConfig->getConfigParam( 'sCompileDir' ),
                         'template_dir'    => $aTemplatesDir,
                         'compile_id'      => md5($myConfig->getTemplateDir( false )),
                         'debugging'       => true,
                         'compile_check'   => true );


        $oSmarty = $this->getMock( 'smarty', array( 'register_resource' ) );
        $oSmarty->expects( $this->once() )->method( 'register_resource' );

        $oUtilsView = new oxutilsview();
        $oUtilsView->UNITfillCommonSmartyProperties( $oSmarty );
        $oUtilsView->UNITsmartyCompileCheck( $oSmarty );

        foreach ( $aCheck as $sVarName => $sVarValue ) {
            $this->assertTrue( isset( $oSmarty->$sVarName ) );
            $this->assertEquals( $oSmarty->$sVarName, $sVarValue, $sVarName );
        }
    }

    public function testParseThroughSmartyInDiffLang()
    {
        $smarty = oxUtilsView::getInstance()->getSmarty();
        $smarty->compile_check = false;
        $lang = oxLang::getInstance()->getTplLanguage( );

        oxLang::getInstance()->setTplLanguage( 0 );
        $text1 = oxUtilsView::getInstance()->parseThroughSmarty('aaa', 'aaa');
        oxLang::getInstance()->setTplLanguage( 1 );
        $text2 = oxUtilsView::getInstance()->parseThroughSmarty('bbb', 'aaa');

        $smarty->compile_check = true;
        oxLang::getInstance()->setTplLanguage( $lang );

        $this->assertEquals('aaa', $text1);
        $this->assertEquals('bbb', $text2);
    }

}
