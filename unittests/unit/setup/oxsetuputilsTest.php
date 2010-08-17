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
 * @copyright (C) OXID eSales AG 2003-2010
 * @version OXID eShop CE
 * @version   SVN: $Id: $
 */

require_once realpath( "." ).'/unit/OxidTestCase.php';
require_once realpath( "." ).'/unit/test_config.inc.php';
require_once getShopBasePath().'/setup/oxsetup.php';

/**
 * oxSetupUtils tests
 */
class Unit_Setup_oxSetupUtilsTest extends OxidTestCase
{
    protected $_sPathTranslated = null;
    protected $_sScriptFilename = null;
    protected $_sHttpReferer = null;
    protected $_sHttpHost    = null;
    protected $_sScriptName  = null;

    /**
     * Test setup
     *
     * @return nul;
     */
    protected function setUp()
    {
        // backup..
        $this->_sPathTranslated = isset( $_SERVER['PATH_TRANSLATED']) ? $_SERVER['PATH_TRANSLATED'] : null;
        $this->_sScriptFilename = isset( $_SERVER['SCRIPT_FILENAME'] ) ? $_SERVER['SCRIPT_FILENAME'] : null;
        $this->_sHttpReferer = isset( $_SERVER['HTTP_REFERER'] ) ? $_SERVER['HTTP_REFERER'] : null;
        $this->_sHttpHost    = isset( $_SERVER['HTTP_HOST'] ) ? $_SERVER['HTTP_HOST'] : null;
        $this->_sScriptName  = isset( $_SERVER['SCRIPT_NAME'] ) ? $_SERVER['SCRIPT_NAME'] : null;

        parent::setUp();
    }

    /**
     * Test teardown
     *
     * @return null
     */
    protected function tearDown()
    {
        if ( isset( $_POST["testPostVarName"] ) ) {
            unset( $_POST["testPostVarName"] );
        }

        if ( isset( $_GET["testGetVarName"] ) ) {
            unset( $_GET["testGetVarName"] );
        }

        // restore
        $_SERVER['PATH_TRANSLATED'] = $this->_sPathTranslated;
        $_SERVER['SCRIPT_FILENAME'] = $this->_sScriptFilename;
        $_SERVER['HTTP_REFERER'] = $this->_sHttpReferer;
        $_SERVER['HTTP_HOST']    = $this->_sHttpHost;
        $_SERVER['SCRIPT_NAME']  = $this->_sScriptName;

        parent::tearDown();
    }

    /**
     * Testing oxSetupUtils::getBaseOutDir()
     *
     * @return null
     */
    public function testGetBaseOutDir()
    {
        $sBaseOut = 'out/pictures';

        $oUtils = new oxSetupUtils();
        $this->assertEquals( $sBaseOut, $oUtils->getBaseOutDir() );
    }

    /**
     * Testing oxSetupUtils::checkPaths()
     *
     * @return null
     */
    public function testCheckPaths()
    {
        $aParams = array( 'sShopDir' => 'sShopDir', 'sCompileDir' => 'sCompileDir' );

        $iAt = 0;
        $oUtils = $this->getMock( "oxSetupUtils", array( "getBaseOutDir", "checkFileOrDirectory" ) );
        $oUtils->expects( $this->at( $iAt++ ) )->method( "getBaseOutDir" )->will( $this->returnValue( 'sBaseOutDir' ) );
        $oUtils->expects( $this->at( $iAt++ ) )->method( "checkFileOrDirectory" )->with( $this->equalTo( 'sShopDir/config.inc.php' ) );
        $oUtils->expects( $this->at( $iAt++ ) )->method( "checkFileOrDirectory" )->with( $this->equalTo( 'sShopDir/sBaseOutDir/0' ) );
        $oUtils->expects( $this->at( $iAt++ ) )->method( "checkFileOrDirectory" )->with( $this->equalTo( 'sShopDir/sBaseOutDir/1' ) );
        $oUtils->expects( $this->at( $iAt++ ) )->method( "checkFileOrDirectory" )->with( $this->equalTo( 'sShopDir/sBaseOutDir/2' ) );
        $oUtils->expects( $this->at( $iAt++ ) )->method( "checkFileOrDirectory" )->with( $this->equalTo( 'sShopDir/sBaseOutDir/3' ) );
        $oUtils->expects( $this->at( $iAt++ ) )->method( "checkFileOrDirectory" )->with( $this->equalTo( 'sShopDir/sBaseOutDir/4' ) );
        $oUtils->expects( $this->at( $iAt++ ) )->method( "checkFileOrDirectory" )->with( $this->equalTo( 'sShopDir/sBaseOutDir/5' ) );
        $oUtils->expects( $this->at( $iAt++ ) )->method( "checkFileOrDirectory" )->with( $this->equalTo( 'sShopDir/sBaseOutDir/6' ) );
        $oUtils->expects( $this->at( $iAt++ ) )->method( "checkFileOrDirectory" )->with( $this->equalTo( 'sShopDir/sBaseOutDir/7' ) );
        $oUtils->expects( $this->at( $iAt++ ) )->method( "checkFileOrDirectory" )->with( $this->equalTo( 'sShopDir/sBaseOutDir/8' ) );
        $oUtils->expects( $this->at( $iAt++ ) )->method( "checkFileOrDirectory" )->with( $this->equalTo( 'sShopDir/sBaseOutDir/9' ) );
        $oUtils->expects( $this->at( $iAt++ ) )->method( "checkFileOrDirectory" )->with( $this->equalTo( 'sShopDir/sBaseOutDir/10' ) );
        $oUtils->expects( $this->at( $iAt++ ) )->method( "checkFileOrDirectory" )->with( $this->equalTo( 'sShopDir/sBaseOutDir/11' ) );
        $oUtils->expects( $this->at( $iAt++ ) )->method( "checkFileOrDirectory" )->with( $this->equalTo( 'sShopDir/sBaseOutDir/12' ) );
        $oUtils->expects( $this->at( $iAt++ ) )->method( "checkFileOrDirectory" )->with( $this->equalTo( 'sShopDir/sBaseOutDir/master/1' ) );
        $oUtils->expects( $this->at( $iAt++ ) )->method( "checkFileOrDirectory" )->with( $this->equalTo( 'sShopDir/sBaseOutDir/master/2' ) );
        $oUtils->expects( $this->at( $iAt++ ) )->method( "checkFileOrDirectory" )->with( $this->equalTo( 'sShopDir/sBaseOutDir/master/3' ) );
        $oUtils->expects( $this->at( $iAt++ ) )->method( "checkFileOrDirectory" )->with( $this->equalTo( 'sShopDir/sBaseOutDir/master/4' ) );
        $oUtils->expects( $this->at( $iAt++ ) )->method( "checkFileOrDirectory" )->with( $this->equalTo( 'sShopDir/sBaseOutDir/master/5' ) );
        $oUtils->expects( $this->at( $iAt++ ) )->method( "checkFileOrDirectory" )->with( $this->equalTo( 'sShopDir/sBaseOutDir/master/6' ) );
        $oUtils->expects( $this->at( $iAt++ ) )->method( "checkFileOrDirectory" )->with( $this->equalTo( 'sShopDir/sBaseOutDir/master/7' ) );
        $oUtils->expects( $this->at( $iAt++ ) )->method( "checkFileOrDirectory" )->with( $this->equalTo( 'sShopDir/sBaseOutDir/master/8' ) );
        $oUtils->expects( $this->at( $iAt++ ) )->method( "checkFileOrDirectory" )->with( $this->equalTo( 'sShopDir/sBaseOutDir/master/9' ) );
        $oUtils->expects( $this->at( $iAt++ ) )->method( "checkFileOrDirectory" )->with( $this->equalTo( 'sShopDir/sBaseOutDir/master/10' ) );
        $oUtils->expects( $this->at( $iAt++ ) )->method( "checkFileOrDirectory" )->with( $this->equalTo( 'sShopDir/sBaseOutDir/master/11' ) );
        $oUtils->expects( $this->at( $iAt++ ) )->method( "checkFileOrDirectory" )->with( $this->equalTo( 'sShopDir/sBaseOutDir/master/12' ) );
        $oUtils->expects( $this->at( $iAt++ ) )->method( "checkFileOrDirectory" )->with( $this->equalTo( 'sShopDir/sBaseOutDir/icon' ) );
        $oUtils->expects( $this->at( $iAt++ ) )->method( "checkFileOrDirectory" )->with( $this->equalTo( 'sShopDir/sBaseOutDir/z1' ) );
        $oUtils->expects( $this->at( $iAt++ ) )->method( "checkFileOrDirectory" )->with( $this->equalTo( 'sShopDir/sBaseOutDir/z2' ) );
        $oUtils->expects( $this->at( $iAt++ ) )->method( "checkFileOrDirectory" )->with( $this->equalTo( 'sShopDir/sBaseOutDir/z3' ) );
        $oUtils->expects( $this->at( $iAt++ ) )->method( "checkFileOrDirectory" )->with( $this->equalTo( 'sShopDir/sBaseOutDir/z4' ) );
        $oUtils->expects( $this->at( $iAt++ ) )->method( "checkFileOrDirectory" )->with( $this->equalTo( 'sShopDir/sBaseOutDir/z5' ) );
        $oUtils->expects( $this->at( $iAt++ ) )->method( "checkFileOrDirectory" )->with( $this->equalTo( 'sShopDir/sBaseOutDir/z6' ) );
        $oUtils->expects( $this->at( $iAt++ ) )->method( "checkFileOrDirectory" )->with( $this->equalTo( 'sShopDir/sBaseOutDir/z7' ) );
        $oUtils->expects( $this->at( $iAt++ ) )->method( "checkFileOrDirectory" )->with( $this->equalTo( 'sShopDir/sBaseOutDir/z8' ) );
        $oUtils->expects( $this->at( $iAt++ ) )->method( "checkFileOrDirectory" )->with( $this->equalTo( 'sShopDir/sBaseOutDir/z9' ) );
        $oUtils->expects( $this->at( $iAt++ ) )->method( "checkFileOrDirectory" )->with( $this->equalTo( 'sShopDir/sBaseOutDir/z10' ) );
        $oUtils->expects( $this->at( $iAt++ ) )->method( "checkFileOrDirectory" )->with( $this->equalTo( 'sShopDir/sBaseOutDir/z11' ) );
        $oUtils->expects( $this->at( $iAt++ ) )->method( "checkFileOrDirectory" )->with( $this->equalTo( 'sShopDir/sBaseOutDir/z12' ) );
        $oUtils->expects( $this->at( $iAt++ ) )->method( "checkFileOrDirectory" )->with( $this->equalTo( 'sShopDir/out/basic/src/bg' ) );
        $oUtils->expects( $this->at( $iAt++ ) )->method( "checkFileOrDirectory" )->with( $this->equalTo( 'sShopDir/out/basic/src' ) );
        $oUtils->expects( $this->at( $iAt++ ) )->method( "checkFileOrDirectory" )->with( $this->equalTo( 'sShopDir/log' ) );
        $oUtils->expects( $this->at( $iAt++ ) )->method( "checkFileOrDirectory" )->with( $this->equalTo( 'sCompileDir' ) );
        $oUtils->checkPaths( $aParams );
    }

    /**
     * Testing oxSetupUtils::getFileContents()
     *
     * @return null
     */
    public function testGetFileContents()
    {
        $sLicenseFile = "lizenz.txt";


        $sFilePath = getShopBasePath()."setup/en/{$sLicenseFile}";

        $oUtils = new oxSetupUtils();
        $this->assertEquals( file_get_contents( $sFilePath ), $oUtils->getFileContents( $sFilePath ) );
    }

    /**
     * Testing oxSetupUtils::getDefaultPathParams()
     *
     * @return null
     */
    public function testGetDefaultPathParams()
    {
        $_SERVER['PATH_TRANSLATED'] = null;
        $_SERVER['HTTP_REFERER']    = null;
        $_SERVER['SCRIPT_FILENAME'] = "/var/www/ee440setup/setup/index.php";
        $_SERVER['SCRIPT_NAME']     = "/ee440setup/setup/index.php";
        $_SERVER['HTTP_HOST']       = "127.0.0.1:1001";

        // paths
        $aParams['sShopDir'] = "/var/www/ee440setup/";
        $aParams['sCompileDir'] = $aParams['sShopDir'] . "tmp/";
        $aParams['sShopURL'] = "http://127.0.0.1:1001/ee440setup/";

        $oUtils = new oxSetupUtils();
        $this->assertEquals( $aParams, $oUtils->getDefaultPathParams() );
    }

    /**
     * test for bug #0002043: System requirements check for "Files/folders access rights" always fails
     *
     * @return null
     */
    public function testGetDefaultPathParamsIfPathTranslatedIsEmpty()
    {
        $_SERVER['PATH_TRANSLATED'] = '';
        $_SERVER['HTTP_REFERER']    = null;
        $_SERVER['SCRIPT_FILENAME'] = "/var/www/ee440setup/setup/index.php";
        $_SERVER['SCRIPT_NAME']     = "/ee440setup/setup/index.php";
        $_SERVER['HTTP_HOST']       = "127.0.0.1:1001";

        // paths
        $aParams['sShopDir'] = "/var/www/ee440setup/";
        $aParams['sCompileDir'] = $aParams['sShopDir'] . "tmp/";
        $aParams['sShopURL'] = "http://127.0.0.1:1001/ee440setup/";

        $oUtils = new oxSetupUtils();
        $this->assertEquals( $aParams, $oUtils->getDefaultPathParams() );
    }

    /**
     * Testing oxSetupUtils::getEnvVar()
     *
     * @return null
     */
    public function testGetEnvVar()
    {
        // ENV is not always filled in..
        if ( count( $_ENV ) ) {
             $sValue = current( $_ENV );
             $sName  = key( $_ENV );

             $oUtils = new oxSetupUtils();
             $this->assertEquals( $sValue, $oUtils->getEnvVar( $sName ) );
        }
    }

    /**
     * Testing oxSetupUtils::getRequestVar()
     *
     * @return null
     */
    public function testGetRequestVar()
    {
        $_POST["testPostVarName"] = "testPostVarValue";
        $_GET["testGetVarName"]   = "testGetVarValue";

        $oUtils = new oxSetupUtils();
        $this->assertEquals( "testPostVarValue", $oUtils->getRequestVar( "testPostVarName" ) );
        $this->assertEquals( "testGetVarValue", $oUtils->getRequestVar( "testGetVarName" ) );
    }

    /**
     * Testing oxSetupUtils::preparePath()
     *
     * @return null
     */
    public function testPreparePath()
    {
        $oUtils = new oxSetupUtils();
        $this->assertEquals( "c:/www/oxid", $oUtils->preparePath( 'c:\\www\\oxid\\' ) );
        $this->assertEquals( "/htdocs/eshop", $oUtils->preparePath( '/htdocs/eshop/' ) );
        $this->assertEquals( "/o/x/i/d", $oUtils->preparePath( '/o/x/i/d/' ) );
    }

    /**
     * Testing oxSetupUtils::extractBasePath()
     *
     * @return null
     */
    public function testExtractBasePath()
    {
        $oUtils = new oxSetupUtils();
        $this->assertEquals( "nothing", $oUtils->extractRewriteBase( "nothing" ) );
        $this->assertEquals( "/folder", $oUtils->extractRewriteBase( "http://www.shop.com/folder/" ) );
        $this->assertEquals( "www.shop.com/folder", $oUtils->extractRewriteBase( "www.shop.com/folder/" ) );
        $this->assertEquals( "/folder", $oUtils->extractRewriteBase( "http://www.shop.com/folder" ) );
        $this->assertEquals( "/folder", $oUtils->extractRewriteBase( "http://shop.com/folder" ) );
    }

    /**
     * Testing oxSetupUtils::isValidEmail()
     *
     * @return null
     */
    public function testIsValidEmail()
    {
        $oUtils = new oxSetupUtils();
        $this->assertFalse( $oUtils->isValidEmail( "admin" ) );
        $this->assertTrue( $oUtils->isValidEmail( "shop@admin.com" ) );
    }
}
