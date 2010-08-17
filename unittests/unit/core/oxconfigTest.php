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
 * @version   SVN: $Id: oxconfigTest.php 29355 2010-08-16 07:18:58Z arvydas $
 */

require_once realpath( "." ).'/unit/OxidTestCase.php';
require_once realpath( "." ).'/unit/test_config.inc.php';

class modForTestGetBaseTplDirExpectsDefault extends oxConfig
{
    public function getShopId()
    {
        return 'xxx';
    }
}

class modForTestInitNoConnection extends oxConfig
{
    public function _loadVarsFromDb($sShopID, $aOnlyVars = null)
    {
        $oEx = oxNew('oxConnectionException');
        throw $oEx;
    }
}
// P
/*
class modForTestGetTemplateDirExpectsDefault extends oxConfig
{
    public function getShopLanguage()
    {
        return 'xxx';
    }
}
*/

class modForTestGetBaseTemplateDirNonAdminNonSsl extends oxConfig
{
    public function isSsl()
    {
        return false;
    }
}

class modForTestGetBaseTemplateDirAdminSsl extends oxConfig
{
    public function getConfigParam( $sP )
    {
        $orig = parent::getConfigParam( $sP ) ;
        if ($sP == 'sSSLShopURL') {
            return $orig?$orig:'https://leuleuleu/';
        }
        return $orig;
    }
    public function isSsl()
    {
        return true;
    }
    public function getSslShopUrl( $iLang = null )
    {
        return $this->getConfigParam( 'sSSLShopURL' );
    }
}

// P
/*
class modForTestGetAbsDynImageDirForSecondLang extends oxConfig
{
    public function getShopLanguage()
    {
        return 1;
    }
}
*/

class modForTestGetImageDirNativeImagesIsSsl extends modForTestGetBaseTemplateDirAdminSsl
{
    public function isSsl()
    {
        return true;
    }
}

class modForGetShopHomeUrl extends oxConfig
{
    public function getShopUrl( $iLang = null, $blAdmin = null )
    {
        return 'http://www.example.com/';
    }
    public function getSslShopUrl( $iLang = null )
    {
        return 'https://www.example.com/';
    }
}

class modForTestGetDynImageDirIsSslSpecShopIdSpecLang extends modForTestGetBaseTemplateDirAdminSsl
{
    public function isSsl()
    {
        return true;
    }
    public function getShopLanguage()
    {
        return 1;
    }
}

/* P
class modFortestGetShopLanguageLanguageURLs extends oxConfig
{
    public function isCurrentUrl( $sURL )
    {
        return true;
    }
}
*/

class modFortestGetShopTakingFromRequestNoMall extends oxConfig
{
    public function isMall()
    {
        return false;
    }
}

class Unit_Core_oxconfigTest extends OxidTestCase
{
    protected $_iCurr = null;
    protected $_aShops = array();

    /**
     * Initialize the fixture.
     *
     * @return null
     */
    protected function setUp()
    {
        parent::setUp();
        oxConfig::getInstance()->sTheme = false;

        // copying
        $this->_iCurr = oxSession::getVar( 'currency' );

            return;

        for ( $i = 2; $i < 7; $i++ ) {
            $this->_aShops[$i] = oxNew( 'oxbase' );
            $this->_aShops[$i]->init( 'oxshops' );
            $this->_aShops[$i]->setId( $i );
            $this->_aShops[$i]->oxshop__oxactive = new oxField(1, oxField::T_RAW);
            $this->_aShops[$i]->oxshop__oxactive_1 = new oxField(1, oxField::T_RAW);
            $this->_aShops[$i]->oxshop__oxactive_2 = new oxField(1, oxField::T_RAW);
            $this->_aShops[$i]->oxshop__oxactive_3 = new oxField(1, oxField::T_RAW);
            $this->_aShops[$i]->save();
        }
    }

    /**
     * Tear down the fixture.
     *
     * @return null
     */
    protected function tearDown()
    {
        // cleaning up
        $sQ = 'delete from oxconfig where oxvarname = "xxx" ';
        oxDb::getDb()->execute( $sQ );

        foreach ( $this->_aShops as $oShop ) {
            $oShop->delete();
        }
        $this->_aShops = array();

        $sDir = oxConfig::getInstance()->getConfigParam( 'sShopDir' )."/out/2";
        if (is_dir(realpath($sDir))) {
            oxUtilsFile::getInstance()->deleteDir($sDir);
        }
        $sDir = oxConfig::getInstance()->getConfigParam( 'sShopDir' )."/out/en/tpl";
        if (is_dir(realpath($sDir))) {
            oxUtilsFile::getInstance()->deleteDir($sDir);
        }

        $this->cleanUpTable('oxconfig');
        parent::tearDown();
    }

    /**
     * oxConfig::getIconUrl() test case
     *
     * @return null
     */
    public function testGetIconUrl()
    {
        $oConfig = $this->getMock( 'oxconfig', array( "getPictureUrl" ) );
        $oConfig->expects( $this->once() )->method( 'getPictureUrl')->with( $this->equalTo( "someIconFile" ), $this->equalTo( false ), $this->equalTo( null ), $this->equalTo( null ), $this->equalTo( null ), $this->equalTo( "icon/nopic_ico.jpg" ) )->will( $this->returnValue( "testIconUrl" ) );
        $this->assertEquals( "testIconUrl", $oConfig->getIconUrl( "someIconFile" ) );
    }

    public function testGetStdLanguagePath()
    {
        $sFile = 'testFile';
        $iLang = 0;
        $sLang = oxLang::getInstance()->getLanguageAbbr( $iLang );
        $blAdmin = false;

        $oConfig = $this->getMock( 'oxconfig', array( "getDir", "getConfigParam" ) );
        $oConfig->expects( $this->once() )->method( 'getDir')->with( $this->equalTo( $sFile ), $this->equalTo( $sLang ), $this->equalTo( $blAdmin ), $this->equalTo( $iLang ), $this->equalTo( null ), $this->equalTo( "sTestTheme" ), $this->equalTo( true ), $this->equalTo( true ) );
        $oConfig->expects( $this->once() )->method( 'getConfigParam')->with( $this->equalTo( "sTheme" ) )->will( $this->returnValue( "sTestTheme" ) );

        $oConfig->getStdLanguagePath( $sFile, $blAdmin, $iLang );
    }

    public function testGetLogsDir()
    {
        $this->assertEquals( oxConfig::getInstance()->getConfigParam( 'sShopDir' ).'log/', oxConfig::getInstance()->getLogsDir() );
    }

    /*
     * Testing special ssl handling for profihost customers
     */
    public function testIsSsl_specialHandling()
    {
        oxTestModules::addFunction( "oxUtilsServer", "getServerVar", '{ if ( $aA[0] == "HTTPS" ) { return null; } else { return array( "HTTP_X_FORWARDED_SERVER" => "sslsites.de" ); } }' );

        $oConfig = $this->getMock( 'oxconfig', array( 'getConfigParam' ), array(), '', false );
        $oConfig->expects( $this->never() )->method( 'getConfigParam');
        $this->assertTrue( $oConfig->isSsl() );
    }

    /*
     * Testing method when shop is not in ssl mode
     */
    public function testIsSsl_notSslMode()
    {
        oxTestModules::addFunction( "oxUtilsServer", "getServerVar", '{ if ( $aA[0] == "HTTPS" ) { return null; } else { return array(); } }' );

        $oConfig = $this->getMock( 'oxconfig', array( 'getConfigParam' ) );
        $oConfig->expects( $this->never() )->method( 'getConfigParam');

        $this->assertFalse( $oConfig->isSsl() );
    }

    /*
     * Testing method when shop is in ssl mode but no ssl shop links exist
     */
    public function testIsSsl_SslMode_NoSslShopUrl()
    {
        oxTestModules::addFunction( "oxUtilsServer", "getServerVar", '{ if ( $aA[0] == "HTTPS" ) { return 1; } else { return array(); } }' );

        $oConfig = $this->getMock( 'oxconfig', array( 'getConfigParam' ) );
        $oConfig->expects( $this->at(0) )->method( 'getConfigParam')->with( $this->equalTo( 'sSSLShopURL' ) )->will( $this->returnValue( '' ) );
        $oConfig->expects( $this->at(1) )->method( 'getConfigParam')->with( $this->equalTo( 'sMallSSLShopURL' ) )->will( $this->returnValue( '' ) );

        $this->assertFalse( $oConfig->isSsl() );
    }

    /*
     * Testing method when shop is in ssl mode and ssl shop link exists
     */
    public function testIsSsl_SslMode_WithSslShopUrl()
    {
        oxTestModules::addFunction( "oxUtilsServer", "getServerVar", '{ if ( $aA[0] == "HTTPS" ) { return 1; } else { return array(); } }' );

        $oConfig = $this->getMock( 'oxconfig', array( 'getConfigParam' ) );
        $oConfig->expects( $this->once() )->method( 'getConfigParam')->with( $this->equalTo( 'sSSLShopURL' ) )->will( $this->returnValue( 'https://eshop/' ) );

        $this->assertTrue( $oConfig->isSsl() );
    }

    /*
     * Testing method when shop is in ssl mode and only subshop ssl link exists
     * (M:1271)
     */
    public function testIsSsl_SslMode_WithSslShopUrl_forSubshop()
    {
        oxTestModules::addFunction( "oxUtilsServer", "getServerVar", '{ if ( $aA[0] == "HTTPS" ) { return 1; } else { return array(); } }' );

        $oConfig = $this->getMock( 'oxconfig', array( 'getConfigParam' ) );
        $oConfig->expects( $this->at(0) )->method( 'getConfigParam')->with( $this->equalTo( 'sSSLShopURL' ) )->will( $this->returnValue( '' ) );
        $oConfig->expects( $this->at(1) )->method( 'getConfigParam')->with( $this->equalTo( 'sMallSSLShopURL' ) )->will( $this->returnValue( 'https://subshop/' ) );

        $this->assertTrue( $oConfig->isSsl() );
    }

    /*
     * Testing method when shop is in ssl mode with different params returnede
     * by HTTPS parameter
     * (M:1271)
     */
    public function testIsSsl_SslMode_WithDifferentParams()
    {
        oxTestModules::addFunction( "oxUtilsServer", "getServerVar", '{ if ( $aA[0] == "HTTPS" ) { return 1; } else { return array(); } }' );

        $oConfig = $this->getMock( 'oxconfig', array( 'getConfigParam' ) );
        $oConfig->expects( $this->at(0) )->method( 'getConfigParam')->with( $this->equalTo( 'sSSLShopURL' ) )->will( $this->returnValue( 'https://eshop' ) );
        $this->assertTrue( $oConfig->isSsl() );

        oxTestModules::cleanUp();
        oxTestModules::addFunction( "oxUtilsServer", "getServerVar", '{ if ( $aA[0] == "HTTPS" ) { return "on"; } else { return array(); } }' );
        $this->assertTrue( $oConfig->isSsl() );
    }

    /**
     * By default it should return false
     * @return
     */
    public function testIsUtf()
    {
        $oConfig = new oxConfig();
        $this->assertFalse( $oConfig->isUtf() );
    }

    private function _getOutPath( $oConfig, $sTheme =  null, $blAbsolute = true )
    {
        $sShop  = $blAbsolute?$oConfig->getConfigParam('sShopDir'):"";

        if (is_null($sTheme)) {
            $sTheme = $oConfig->getConfigParam('sTheme');
        }

        if ($sTheme) {
            $sTheme .= "/";
        }

        return $sShop.'out/'.$sTheme;
    }

    /**
     * Testing config parameters getter
     */
    public function testInitNoConnection()
    {
        $oConfig = new modForTestInitNoConnection();
        $this->assertFalse( $oConfig->init() );
    }

    /**
     * Testing config parameters getter
     */
    public function testGetConfigParamCheckingDbParam()
    {
        $oConfig = new oxConfig();
        $oConfig->init();
        $this->assertFalse( $oConfig->getConfigParam( 'blEnterNetPrice' ) );
    }

    public function testGetConfigParamCheckingNotExistingParam()
    {
        $oConfig = new oxConfig();
        $oConfig->init();
        $this->assertNull( $oConfig->getConfigParam( 'xxx' ) );
    }

    /**
     * Testing config parameters setter
     */
    public function testSetConfigParamOverridingLocalParam()
    {
        $oConfig = new oxConfig();
        $oConfig->init();
        $oConfig->setConfigParam( 'dbType', 'yyy' );
        $this->assertEquals( 'yyy', $oConfig->getConfigParam( 'dbType' ) );
    }
    public function testSetConfigParamOverridingCachedParam()
    {
        $oConfig = new oxConfig();
        $oConfig->init();
        $oConfig->setConfigParam( 'xxx', 'yyy' );
        $this->assertEquals( 'yyy', $oConfig->getConfigParam( 'xxx' ) );
    }

    /**
     * Testing config cache setter
     */
    public function testSetGlobalParameter()
    {
        $oConfig = new oxConfig();
        $oConfig->init();
        $oConfig->setGlobalParameter( 'xxx', 'yyy' );
        $this->assertEquals( 'yyy', $oConfig->getGlobalParameter( 'xxx' ) );
    }

    /**
     * Testing config cache getter
     */
    public function testGetGlobalParameterNoParameter()
    {
        $oConfig = new oxConfig();
        $oConfig->init();
        $this->assertNull( $oConfig->getGlobalParameter( 'xxx' ) );
    }


    /**
     * Testing active view getter
     */
    public function testGetActiveViewNoViewSetYet()
    {
        $oConfig = new oxConfig();
        $oConfig->init();
        $this->assertTrue( $oConfig->getActiveView() instanceof oxview );
    }
    public function testGetActiveViewFakeView()
    {
        $oConfig = new oxConfig();
        $oConfig->init();
        $oConfig->setActiveView( new oxview() );
        $this->assertTrue( $oConfig->getActiveView() instanceof oxview );
    }

    /**
     * Testing active view setter
     */
    public function testSetActiveView()
    {
        $oConfig = new oxConfig();
        $oConfig->init();
        $oConfig->setActiveView( new oxview() );
        $this->assertTrue( $oConfig->getActiveView() instanceof oxview );
    }

    /**
     * Testing base shop id getter
     */
    public function testGetBaseShopId()
    {
        $oConfig = new oxConfig();
        $oConfig->init();
            $this->assertEquals( 'oxbaseshop', $oConfig->getBaseShopId() );
    }

    /**
     * Testing mall mode getter
     */
    public function testIsMall()
    {
        $oConfig = new oxConfig();
        $oConfig->init();
            $this->assertFalse( $oConfig->isMall() );
    }


    /**
     * Testing productive mode check
     */
    public function testIsProductiveModeForEnterpise()
    {
        $oConfig = new oxConfig();
        $oConfig->init();

        $sQ = 'select oxproductive from oxshops where oxid = "'.$oConfig->getShopID().'"';
        $blProductive = ( bool ) oxDb::getDb()->getOne( $sQ );

        $this->assertEquals( $blProductive, $oConfig->isProductiveMode() );
    }

    /**
     * Testing config info loader method
     * (no need to test all ...)
     */
    // testing random boolean parameter
    public function testLoadVarsFromDbRandomBool()
    {
        $oConfig = new oxConfig();
        $oConfig->init();
        $sShopId = $oConfig->getBaseShopId();

        $sQ = 'select oxvarname from oxconfig where oxvartype="bool" and oxshopid="'.$sShopId.'" order by rand()';
        $sVar = oxDb::getDb()->getOne( $sQ );

        $sQ = 'select DECODE( oxvarvalue, "'.$oConfig->getConfigParam( 'sConfigKey' ).'") from oxconfig where oxshopid="'.$sShopId.'" and oxvarname="'.$sVar.'"';
        $sVal = oxDb::getDb()->getOne( $sQ );

        $oConfig->UNITloadVarsFromDB( $sShopId, array( $sVar ) );

        $this->assertEquals( ( $sVal == 'true' || $sVal == '1' ), $oConfig->getConfigParam( $sVar ) );
    }
    // testing random array parameter
    public function testLoadVarsFromDbRandomArray()
    {
        $oConfig = new oxConfig();
        $oConfig->init();
        $sShopId = $oConfig->getBaseShopId();

        $sQ = 'select oxvarname from oxconfig where oxvartype="arr" and oxshopid="'.$sShopId.'" order by rand()';
        $sVar = oxDb::getDb()->getOne( $sQ );

        $sQ = 'select DECODE( oxvarvalue, "'.$oConfig->getConfigParam( 'sConfigKey' ).'") from oxconfig where oxshopid="'.$sShopId.'" and oxvarname="'.$sVar.'"';
        $sVal = oxDb::getDb()->getOne( $sQ );

        $oConfig->UNITloadVarsFromDB( $sShopId, array( $sVar ) );

        $this->assertEquals( unserialize( $sVal ), $oConfig->getConfigParam( $sVar ) );
    }
    // testing random no bool, array/assoc array parameter
    public function testLoadVarsFromDbAnyOther()
    {
        $oConfig = new oxConfig();
        $oConfig->init();
        $sShopId = $oConfig->getBaseShopId();

        $sQ = 'select oxvarname from oxconfig where oxvartype not in ( "bool", "arr", "aarr" )  and oxshopid="'.$sShopId.'" order by rand()';
        $sVar = oxDb::getDb()->getOne( $sQ );

        $sQ = 'select DECODE( oxvarvalue, "'.$oConfig->getConfigParam( 'sConfigKey' ).'") from oxconfig where oxshopid="'.$sShopId.'" and oxvarname="'.$sVar.'"';
        $sVal = oxDb::getDb()->getOne( $sQ );

        $oConfig->UNITloadVarsFromDB( $sShopId, array( $sVar ) );

        $this->assertEquals( $sVal, $oConfig->getConfigParam( $sVar ) );
    }
    // not existing variable
    public function testLoadVarsFromDbNotExisting()
    {
        $oConfig = new oxConfig();
        $oConfig->init();
        $sShopId = $oConfig->getBaseShopId();

        $oConfig->UNITloadVarsFromDB( $sShopId, array( time() ) );

        $this->assertNull( $oConfig->getConfigParam( $sVar ) );
    }

    /**
     * testing close page
     */
    public function testPageClose()
    {
        $oStart = $this->getMock( 'oxStart', array( 'pageClose' ) );
        $oStart->expects( $this->once() )->method( 'pageClose');
        $oConfig = new oxConfig();
        $oConfig->init();
        $oConfig->setConfigParam( "_oStart", $oStart );

        $oConfig->pageClose();
    }

    /**
     * testing shops configuration param getter
     */
    public function testgetShopConfVar()
    {
        $oConfig = new oxConfig();
        $oConfig->init();
        $sShopId = $oConfig->getBaseShopId();

        $sQ = 'select oxvarname from oxconfig where oxvartype not in ( "bool", "arr", "aarr" )  and oxshopid="'.$sShopId.'" order by rand()';
        $sVar = oxDb::getDb()->getOne( $sQ );

        $sQ = 'select DECODE( oxvarvalue, "'.$oConfig->getConfigParam( 'sConfigKey' ).'") from oxconfig where oxshopid="'.$sShopId.'" and oxvarname="'.$sVar.'"';
        $sVal = oxDb::getDb()->getOne( $sQ );
        $this->assertEquals( $sVal, $oConfig->getShopConfVar( $sVar, $sShopId ) );
    }

    public function testgetShopConfVarCheckingDbParamWhenMoreThan1InDB()
    {
        $this->cleanUpTable('oxconfig');
        $oConfig = new oxConfig();
        $sShopId = $oConfig->getBaseShopId();

        $sQ1 = "insert into oxconfig (oxid, oxshopid, oxvarname, oxvartype, oxvarvalue) values
                                    ('_test1', '$sShopId', 'testVar1', 'int', 0x071d6980dc7afb6707bb)";
        $sQ2 = "insert into oxconfig (oxid, oxshopid, oxvarname, oxvartype, oxvarvalue) values
                                    ('_test2', '$sShopId', 'testVar1', 'int', 0x071d6980dc7afb6707bb)";

        oxDb::getDb()->execute( $sQ1 );
        oxDb::getDb()->execute( $sQ2 );

        $this->assertFalse($oConfig->getShopConfVar('testVar1') == null);

    }


    /**
     * Testing if shop var saver writes correct info into db
     */
    public function testsaveShopConfVar()
    {
        $sName = 'xxx';
        $sVal  = '123';

        $oConfig = new oxConfig();
        $oConfig->init();
        $sShopId = $oConfig->getShopId();
        $oConfig->saveShopConfVar( 'int', $sName, $sVal, $sShopId );
        $this->assertEquals( $sVal, $oConfig->getShopConfVar( $sName, $sShopId ) );
        $this->assertEquals( $sVal, $oConfig->getConfigParam( $sName ) );

    }

    /**
     * Testing if shop var saver writes correct info into db
     */
    public function testsaveShopConfVarSerialized()
    {
        $sVar = 'array';
        $aVal = array('a','b','c');

        $oConfig = new oxConfig();
        $oConfig->init();

        $oE = null;
        try {
            $oConfig->saveShopConfVar( 'arr', $sVar, $aVal );
            $this->assertEquals( $aVal, $oConfig->getShopConfVar( $sVar ) );
            $this->assertEquals( $aVal, $oConfig->getConfigParam( $sVar ) );

            // Deprecated behavior, with serialized values
            $oConfig->saveShopConfVar( 'arr', $sVar, serialize($aVal) );
            $this->assertEquals( $aVal, $oConfig->getShopConfVar( $sVar ) );
            $this->assertEquals( $aVal, $oConfig->getConfigParam( $sVar ) );
        } catch (Exception $oE) {
            // rethrow later
        }
        oxDb::getDb()->execute("delete from oxconfig where oxvarname='array'");
        if ($oE) {
            throw $oE;
        }
    }

    /**
     * Testing if shop var saver writes bool value to config correctly
     */
    public function testsaveShopConfVarBoolTrue1()
    {
        $oConfig = new oxConfig();
        $oConfig->init();

        $oE = null;
        try {
            $oConfig->saveShopConfVar( 'bool', "testVar", 1 );
            $this->assertTrue( $oConfig->getShopConfVar( "testVar" ) );
            $this->assertTrue( $oConfig->getConfigParam( "testVar" ) );
        } catch (Exception $oE) {
            // rethrow later
        }
        oxDb::getDb()->execute("delete from oxconfig where oxvarname='testVar'");
        if ($oE) {
            throw $oE;
        }
    }

    /**
     * Testing if shop var saver writes bool value to config correctly
     */
    public function testsaveShopConfVarBoolTrue2()
    {
        $oConfig = new oxConfig();
        $oConfig->init();

        $oE = null;
        try {
            $oConfig->saveShopConfVar( 'bool', "testVar", true );
            $this->assertTrue($oConfig->getShopConfVar( "testVar" ) );
            $this->assertTrue( $oConfig->getConfigParam( "testVar" ) );
        } catch (Exception $oE) {
            // rethrow later
        }
        oxDb::getDb()->execute("delete from oxconfig where oxvarname='testVar'");
        if ($oE) {
            throw $oE;
        }
    }

    /**
     * Testing if shop var saver writes bool value to config correctly
     */
    public function testsaveShopConfVarBoolTrue3()
    {
        $oConfig = new oxConfig();
        $oConfig->init();

        $oE = null;
        try {
            $oConfig->saveShopConfVar( 'bool', "testVar", "true" );
            $this->assertTrue(  $oConfig->getShopConfVar( "testVar" ) );
            $this->assertTrue(  $oConfig->getConfigParam( "testVar" ) );
        } catch (Exception $oE) {
            // rethrow later
        }
        oxDb::getDb()->execute("delete from oxconfig where oxvarname='testVar'");
        if ($oE) {
            throw $oE;
        }
    }

    /**
     * Testing if shop var saver writes bool value to config correctly
     */
    public function testsaveShopConfVarBoolFalse1()
    {
        $oConfig = new oxConfig();
        $oConfig->init();

        $oE = null;
        try {
            $oConfig->saveShopConfVar( 'bool', "testVar", false );
            $this->assertFalse(  $oConfig->getShopConfVar( "testVar" ) );
            $this->assertFalse(  $oConfig->getConfigParam( "testVar" ) );
        } catch (Exception $oE) {
            // rethrow later
        }
        oxDb::getDb()->execute("delete from oxconfig where oxvarname='testVar'");
        if ($oE) {
            throw $oE;
        }
    }

    /**
     * Testing if shop var saver writes bool value to config correctly
     */
    public function testsaveShopConfVarBoolFalse2()
    {
        $oConfig = new oxConfig();
        $oConfig->init();

        $oE = null;
        try {
            $oConfig->saveShopConfVar( 'bool', "testVar", 0 );
            $this->assertFalse( $oConfig->getShopConfVar( "testVar" ) );
            $this->assertFalse( $oConfig->getConfigParam( "testVar" ) );
        } catch (Exception $oE) {
            // rethrow later
        }
        oxDb::getDb()->execute("delete from oxconfig where oxvarname='testVar'");
        if ($oE) {
            throw $oE;
        }
    }

    /**
     * Testing if shop var saver writes bool value to config correctly
     */
    public function testsaveShopConfVarBoolFalse3()
    {
        $oConfig = new oxConfig();
        $oConfig->init();

        $oE = null;
        try {
            $oConfig->saveShopConfVar( 'bool', "testVar", "false" );
            $this->assertFalse( $oConfig->getShopConfVar( "testVar" ) );
            $this->assertFalse( $oConfig->getConfigParam( "testVar" ) );
        } catch (Exception $oE) {
            // rethrow later
        }
        oxDb::getDb()->execute("delete from oxconfig where oxvarname='testVar'");
        if ($oE) {
            throw $oE;
        }
    }

    /**
     * Testing serial number setter
     */
    public function testSetSerial()
    {
    }

    /**
     * Testing language array getter
     */
    /* P
    public function testGetLanguageArray()
    {
        // preparing fixture
        $oDe = new Oxstdclass;
        $oDe->id = 0;
        $oDe->name = 'Deutsch';
        $oDe->selected = 1;

        $oEng = clone $oDe;
        $oEng->id = 1;
        $oEng->name = 'English';
        $oEng->selected = 0;
        $aLangArray = array( $oDe, $oEng );

        $oConfig = new oxConfig();
        $oConfig->init();

        $this->assertEquals( $aLangArray, $oConfig->getLanguageArray( 0 ) );
    }
    */

    /**
     * Testing currency array getter
     */
    public function testGetCurrencyArray()
    {
        // preparing fixture
        $oEur = new Oxstdclass;
        $oEur->id = 0;
        $oEur->name = 'EUR';
        $oEur->rate = '1.00';
        $oEur->dec = ',';
        $oEur->thousand = '.';
        $oEur->sign = '�';
        $oEur->decimal = '2';
        $oEur->selected = 1;

        $oGbp = clone $oEur;
        $oGbp->id = 1;
        $oGbp->name = 'GBP';
        $oGbp->rate = '0.8565';
        $oGbp->dec = '.';
        $oGbp->thousand = '';
        $oGbp->sign = '�';
        $oGbp->decimal = '2';
        $oGbp->selected = 0;

        $oChf = clone $oEur;
        $oChf->id = 2;
        $oChf->name = 'CHF';
        $oChf->rate = '1.4326';
        $oChf->dec = ',';
        $oChf->thousand = '.';
        $oChf->sign = '<small>CHF</small>';
        $oChf->decimal = '2';
        $oChf->selected = 0;

        $oUsd = clone $oEur;
        $oUsd->id = 3;
        $oUsd->name = 'USD';
        $oUsd->rate = '1.2994';
        $oUsd->dec = '.';
        $oUsd->thousand = '';
        $oUsd->sign = '$';
        $oUsd->decimal = '2';
        $oUsd->selected = 0;
        $aCurrArray = array( $oEur, $oGbp, $oChf, $oUsd );

        $oConfig = new oxConfig();
        $oConfig->init();

        $this->assertEquals( $aCurrArray, $oConfig->getCurrencyArray( 0 ) );
    }

    /**
     * Testing currency getter
     */
    public function testGetCurrencyObjectNotExisting()
    {
        $oConfig = new oxConfig();
        $this->assertNull( $oConfig->getCurrencyObject( 'xxx' ) );
    }
    public function testGetCurrencyObjectExisting()
    {
        // preparing fixture
        $oEur = new Oxstdclass;
        $oEur->id = 0;
        $oEur->name = 'EUR';
        $oEur->rate = '1.00';
        $oEur->dec = ',';
        $oEur->thousand = '.';
        $oEur->sign = '�';
        $oEur->decimal = '2';
        $oEur->selected = 0;

        $oConfig = new oxConfig();
        $oConfig->init();

        $this->assertEquals( $oEur, $oConfig->getCurrencyObject( $oEur->name ) );
    }


    /**
     * Testing if serial getter
     */
    // if it really returns same object
    public function testGetSerialIsSameObject()
    {
    }


    /**
     * Testing active shop getter if it returns same object + if serial is set while loading shop
     */
    public function testGetActiveShop()
    {
        $oConfig = new oxConfig();
        $oConfig->init();


        // comparing serials
        $oShop = $oConfig->getActiveShop();


        // additionally checking caching
        $oShop->xxx = 'yyy';
        $this->assertEquals( 'yyy', $oConfig->getActiveShop()->xxx );

        // checking if different language forces reload
        $iCurrLang = oxLang::getInstance()->getBaseLanguage();
        oxLang::getInstance()->resetBaseLanguage();
        modConfig::setParameter( 'lang', $iCurrLang + 1 );

        $oShop = $oConfig->getActiveShop();
        $this->assertFalse( isset( $oShop->xxx ) );
    }


    /**
     * Testing base template dir getter
     */
    public function testGetBaseTplDirNonAdmin()
    {
        $oConfig = new oxConfig();
        $oConfig->init();

        $sDir = $oConfig->getConfigParam( 'sShopURL' ).$this->_getOutPath( $oConfig, null, false )."src/";
        $this->assertEquals( $sDir, $oConfig->getBaseTplDir() );
    }
    public function testGetBaseTplDirAdmin()
    {
        $oConfig = new oxConfig();
        $oConfig->init();
        $sDir = $oConfig->getConfigParam( 'sShopURL' ).$this->_getOutPath( $oConfig, 'admin', false )."src/";
        $this->assertEquals( $sDir, $oConfig->getBaseTplDir( true ) );
    }
    public function testGetBaseTplDirExpectsDefault()
    {
        $oConfig = new modForTestGetBaseTplDirExpectsDefault();
        $oConfig->init();
        $sDir = $oConfig->getConfigParam( 'sShopURL' ).$this->_getOutPath( $oConfig, 'admin', false )."src/";
        $this->assertEquals( $sDir, $oConfig->getBaseTplDir( true ) );
    }
    public function testGetBaseTplDirNonAdminExpectsDefault()
    {
        $oConfig = new modForTestGetBaseTplDirExpectsDefault();
        $oConfig->init();

        $sDir =$oConfig->getConfigParam( 'sShopURL' ). $this->_getOutPath( $oConfig, null, false )."src/";
        $this->assertEquals( $sDir, $oConfig->getBaseTplDir() );
    }

    /**
     * Testing current (language check included) template directory getter
     */
    public function testGetTemplateDirNonAdmin()
    {
        print_r(modConfig::getInstance()->params);

        $oConfig = new oxConfig();
        $oConfig->init();

        $sDir = $this->_getOutPath( $oConfig );
        if ($oConfig->getConfigParam('sTheme') != 'basic') {
                $sDir .= 'de/tpl/';
        } else {
            $sDir.= 'tpl/';
        }

        $this->assertEquals( $sDir, $oConfig->getTemplateDir() );
    }
    public function testGetTemplateDirExpectsDefault()
    {
        oxLang::getInstance()->setBaseLanguage( 999 );
        $oConfig = new oxConfig();
        $oConfig->init();
        $sDir = $this->_getOutPath( $oConfig, 'admin' ).'tpl/';
        $this->assertEquals( $sDir, $oConfig->getTemplateDir( true ) );
    }

    /**
     * Testing templates URL getter
     */
    public function testGetTemplateUrlNonAdmin()
    {
        $oConfig = new oxConfig();
        $oConfig->init();

        $sDir = $oConfig->getConfigParam( 'sShopURL' ).$this->_getOutPath( $oConfig, null, false );
            $sDir.= ( $oConfig->getConfigParam('sTheme') != 'basic')?'de/tpl/':'tpl/';

        $this->assertEquals( $sDir, $oConfig->getTemplateUrl() );
    }

    public function testGetTemplateUrlExpectsDefault()
    {
        $oConfig = new oxConfig();
        oxLang::getInstance()->setBaseLanguage( 999 );
        $oConfig->init();
        $sDir = $oConfig->getConfigParam( 'sShopURL' ).$this->_getOutPath( $oConfig, 'admin', false ).'tpl/';
        $this->assertEquals( $sDir, $oConfig->getTemplateUrl( null, true ) );
    }


    /**
     * Testing base template directory getter
     */
    public function testGetBaseTemplateDirNonAdminNonSsl()
    {
        $oConfig = new modForTestGetBaseTemplateDirNonAdminNonSsl();
        $oConfig->init();

        $sDir = $oConfig->getConfigParam( 'sShopURL' ).$this->_getOutPath( $oConfig, null, false ).'src/';
        $this->assertEquals( $sDir, $oConfig->getBaseTemplateDir() );
    }

    public function testGetBaseTemplateDirAdminSsl()
    {
        $oConfig = new modForTestGetBaseTemplateDirAdminSsl();
        $oConfig->init();
        $sDir = $oConfig->getConfigParam( 'sSSLShopURL' ).'out/admin/src/';
        $this->assertEquals( $sDir, $oConfig->getBaseTemplateDir( true )  );
    }

    /**
     * Testing template file location getter
     */
    public function testGetTemplateFileNonAdmin()
    {
        $oConfig = new oxConfig();
        $oConfig->init();

        $sDir = $this->_getOutPath( $oConfig );
            $sDir.= ( $oConfig->getConfigParam('sTheme') != 'basic')?'de/tpl/':'tpl/';
        $sDir.= 'start.tpl';

        $this->assertEquals( $sDir, $oConfig->getTemplateFile( 'start.tpl', false ) );
    }
    public function testGetTemplateFileAdmin()
    {
        $oConfig = new oxConfig();
        $oConfig->init();
        $sDir = $this->_getOutPath( $oConfig, 'admin' ).'tpl/start.tpl';
        $this->assertEquals( $sDir, $oConfig->getTemplateFile( 'start.tpl', true ) );
    }


    /**
     * Testing getAbsDynImageDir getter
     */
    public function testGetAbsDynImageDirForCustomShop()
    {
        $oConfig = new oxConfig();
        $oConfig->init();

        $sDir = $oConfig->getConfigParam( 'sShopDir' ).'out/pictures'.OXID_VERSION_SUFIX.'/';
        $this->assertEquals( $sDir, $oConfig->getAbsDynImageDir( 'xxx' ) );
    }
    public function testGetAbsDynImageDirForSecondLang()
    {
        oxLang::getInstance()->setBaseLanguage( 1 );

        $oConfig = new oxConfig();
        $oConfig->init();
        $oConfig->setConfigParam( 'blUseDifferentDynDirs', true );
        $sDir = $oConfig->getConfigParam( 'sShopDir' ).'out/pictures'.OXID_VERSION_SUFIX.'/';
        $this->assertEquals( $sDir, $oConfig->getAbsDynImageDir( 'xxx' ) );
    }


    /**
     * Testing getAbsImageDir getter
     */
    public function testGetAbsImageDir()
    {
        $oConfig = new oxConfig();

        $oConfig->init();

        $sDir = $this->_getOutPath( $oConfig ).'img/';
        $this->assertEquals( $sDir, $oConfig->getAbsImageDir() );
    }

    /**
     * Testing getAbsImageDir getter
     */
    public function testGetAbsImageDirMultiLangDirsExist()
    {
        $oConfig = new oxConfig();

        oxLang::getInstance()->setTplLanguage(4);

        $oConfig->init();
        $sLangDir   = $this->_getOutPath( $oConfig ).'img/';
        $sNoLangDir = $this->_getOutPath( $oConfig ).'img/';

        try {
            $this->assertEquals( $sLangDir, $oConfig->getAbsImageDir() );
            $this->assertEquals( $sNoLangDir, $oConfig->getAbsImageDir() );

        } catch (Exception $e) {
        }

        oxLang::getInstance()->setTplLanguage();
        /*
        if (is_dir(realpath($sLangDir))) {
            rmdir($sLangDir);
        }*/
        $sD = $this->_getOutPath( $oConfig ).'/4';
        if (is_dir(realpath($sD))) {
            rmdir($sD);
        }

        if ($e) throw $e;
    }


    /**
     * Testing getAbsAdminImageDir getter
     */
    public function testGetAbsAdminImageDirDefault()
    {
        oxLang::getInstance()->setBaseLanguage( 999 );
        $oConfig = new oxConfig();
        $oConfig->init();
        $sDir = $oConfig->getConfigParam( 'sShopDir' ).'out/admin/img/';
        $this->assertEquals( $sDir, $oConfig->getAbsAdminImageDir() );
    }
    public function testGetAbsAdminImageDirForActLang()
    {
        $oConfig = new oxConfig();
        $oConfig->init();
        $sDir = $oConfig->getConfigParam( 'sShopDir' ).'out/admin/img/';
        $this->assertEquals( $sDir, $oConfig->getAbsAdminImageDir() );
    }


    /**
     * Testing getCoreUtilsUrl getter
     */
    public function testGetCoreUtilsUrl()
    {
        $oConfig = $this->getMock( 'oxConfig', array( 'getCurrentShopUrl' ) );
        $oConfig->expects( $this->any() )->method( 'getCurrentShopUrl')->will( $this->returnValue( 'xxx/' ) );
        $this->assertEquals( 'xxx/core/utils/', $oConfig->getCoreUtilsUrl() );
    }

    public function testGetCoreUtilsUrlMall()
    {
        $oConfig = new oxConfig();
        $oConfig->init();
        $oConfig->setConfigParam( 'aLanguageSSLURLs', null );
        $oConfig->setConfigParam( 'sMallSSLShopURL', null );
        $oConfig->setConfigParam( 'sMallShopURL', 'http://www.example3.com/' );
        $this->assertEquals( 'http://www.example3.com/core/utils/', $oConfig->getCoreUtilsUrl() );
    }


    /**
     * Testing getCurrentShopURL getter
     */
    public function testGetCurrentShopUrlNoSsl()
    {
        $oConfig = new modForTestGetBaseTemplateDirNonAdminNonSsl();
        $oConfig->init();
        $this->assertEquals( $oConfig->getShopUrl(), $oConfig->getCurrentShopUrl() );
    }
    public function testGetCurrentShopUrlIsSsl()
    {
        $oConfig = new modForTestGetBaseTemplateDirAdminSsl();
        $oConfig->init();
        $this->assertEquals( $oConfig->getSslShopUrl(), $oConfig->getCurrentShopUrl() );
    }


    /**
     * Testing active currency id getter
     */
    public function testGetShopCurrency()
    {
        $oConfig = new oxConfig();
        $oConfig->init();
        // simple check if nothing was changed ...
        $this->assertEquals( (int) $oConfig->getParameter( 'currency' ), $oConfig->getShopCurrency() );
    }


    /**
     * Testing active shop currenty setter
     */
    public function testSetActShopCurrencySettingExisting()
    {
        $oConfig = new oxConfig();
        $oConfig->init();
        $this->assertEquals( 0, $oConfig->getShopCurrency() );
        $oConfig->setActShopCurrency( 1 );
        $this->assertEquals( 1, oxSession::getVar( 'currency' ) );
    }
    public function testSetActShopCurrencySettingNotExisting()
    {
        $oConfig = new oxConfig();
        $oConfig->init();
        $this->assertEquals( 0, $oConfig->getShopCurrency() );
        $oConfig->setActShopCurrency( 'xxx' );
        $this->assertEquals( 0, $oConfig->getShopCurrency() );
    }


    /**
     * Testing URL checker
     */
    // by passing empty URL it returns false
    public function testIsCurrentUrlNoUrl()
    {
        $oConfig = new oxConfig();
        $oConfig->init();
        $this->assertFalse( $oConfig->isCurrentUrl( '' ) );
    }
    public function testIsCurrentUrlRandomUrl()
    {
        $sUrl = 'http://www.example.com/example/example.php';
        $oConfig = new oxConfig();
        $oConfig->init();
        $this->assertFalse( $oConfig->isCurrentUrl( $sUrl ) );
    }
    public function testIsCurrentUrlPassingCurrent()
    {
        $oConfig = new oxConfig();
        $oConfig->init();
        $sUrl = $oConfig->getConfigParam( 'sShopURL' ).'/example.php';
        $this->assertFalse( $oConfig->isCurrentUrl( $sUrl ) );
    }


    /**
     * Testing getImageDir getter
     */
    public function testGetImageDirNativeImagesIsSsl()
    {
        $oConfig = $this->getMock( 'modForTestGetImageDirNativeImagesIsSsl', array( 'isAdmin' ) );
        $oConfig->expects( $this->any() )->method( 'isAdmin')->will( $this->returnValue( false ) );
        $oConfig->init();
        $oConfig->setConfigParam( 'blNativeImages', true );

        $sUrl  = $oConfig->getConfigParam( 'sSSLShopURL' )?$oConfig->getConfigParam( 'sSSLShopURL' ):$oConfig->getConfigParam( 'sShopURL' );
        $sUrl .= $this->_getOutPath( $oConfig, null, false ).'img/';
        $this->assertEquals( $sUrl, $oConfig->getImageUrl() );
    }
    public function testGetImageDirDefaultLanguage()
    {
        oxLang::getInstance()->setBaseLanguage( 999 );
        $oConfig = $this->getMock( 'oxConfig', array( 'isAdmin' ) );
        $oConfig->expects( $this->any() )->method( 'isAdmin')->will( $this->returnValue( false ) );
        $oConfig->init();

        $sUrl  = $oConfig->getConfigParam( 'sShopURL' );
        $sUrl .= $this->_getOutPath( $oConfig, null, false ).'img/';

        $this->assertEquals( $sUrl, $oConfig->getImageUrl() );
    }

    /**
     * Testing getImagePath getter
     */
    public function testGetImagePath()
    {
        $oConfig = new oxConfig();
        $oConfig->init();

        $sUrl  = $oConfig->getOutDir();
        $this->assertEquals( $sUrl . "admin/img/start.gif", $oConfig->getImagePath( "start.gif", true) );
    }


    /**
     * Testing getDynImageDir getter
     */
    // alternative path, no SSL
    public function testGetDynImageDirAltDirNoSsl()
    {
        oxUtils::getInstance()->cleanStaticCache();
        $oConfig = new oxConfig();
        $oConfig->init();
        $oConfig->setConfigParam( 'sAltImageDir', 'http://www.example.com' );
        $this->assertEquals( 'http://www.example.com', $oConfig->getDynImageDir() );
    }
    // alternative path, SSL mode
    public function testGetDynImageDirAltDirSsl()
    {
        oxUtils::getInstance()->cleanStaticCache();
        $oConfig = new modForTestGetBaseTemplateDirAdminSsl();
        $oConfig->init();
        $oConfig->setConfigParam( 'sAltImageDir', 'http://www.example.com' );
        $this->assertEquals( 'https://www.example.com', $oConfig->getDynImageDir() );
    }
    // alternative path, SSL mode
    public function testGetDynImageDirNativeImages()
    {
        oxUtils::getInstance()->cleanStaticCache();
        $oConfig = new modForTestGetBaseTemplateDirAdminSsl();
        $oConfig->init();
        $oConfig->setConfigParam( 'blNativeImages', true );
        $sDir = $oConfig->getConfigParam('sSSLShopURL').'out/pictures'.OXID_VERSION_SUFIX.'/';
        $this->assertEquals( $sDir, $oConfig->getDynImageDir( $oConfig->getShopId() ) );
    }
    // everything goes by default
    public function testGetDynImageDirDefaultDir()
    {
        //cleaning cache
        oxUtils::getInstance()->cleanStaticCache();

        $oConfig = new modForTestGetBaseTemplateDirNonAdminNonSsl();
        $oConfig->init();
        $sDir = $oConfig->getConfigParam('sShopURL').'out/pictures'.OXID_VERSION_SUFIX.'/';
        $this->assertEquals( $sDir, $oConfig->getDynImageDir() );
    }
    // ssl mode, specified shop id and language
    public function testGetDynImageDirIsSslSpecShopIdSpecLang()
    {
        oxUtils::getInstance()->cleanStaticCache();
        $oConfig = new modForTestGetDynImageDirIsSslSpecShopIdSpecLang();
        $oConfig->init();
        $sDir  = $oConfig->getConfigParam('sSSLShopURL')?$oConfig->getConfigParam('sSSLShopURL'):$oConfig->getConfigParam('sShopURL');
        $sDir .= 'out/pictures'.OXID_VERSION_SUFIX.'/';
        $this->assertEquals( $sDir, $oConfig->getDynImageDir( 2, false) );
    }

    /**
     * Testing getNoSslImageDir getter
     */
    public function testGetNoSslImageDirAdminModeSecondLanguage()
    {
        $oConfig = new oxConfig();
        $oConfig->init();
        $sDir = $oConfig->getConfigParam( 'sShopURL' ).'out/admin/img/';
        $this->assertEquals( $sDir, $oConfig->getNoSslImageDir( true ) );
    }

    public function testGetNoSslImageDirDefaults()
    {
        oxConfig::getInstance()->setConfigParam( 'aLanguages', array( 0 => 'DE', 1 => 'EN', 2 => 'LT') );
        oxLang::getInstance()->setBaseLanguage( 2 );

        $oConfig = new oxConfig();
        $oConfig->init();
        $sDir = $oConfig->getConfigParam('sShopURL').$this->_getOutPath( $oConfig, null, false ).'img/';

        $this->assertEquals( $sDir, $oConfig->getNoSslImageDir() );
    }


    /**
     * Testing getShopHomeUrl getter
     */
    public function testGetShopHomeUrl()
    {
        $oConfig = new modForGetShopHomeUrl();
        $oConfig->init();
        $sUrl = oxSession::getInstance()->url( 'http://www.example.com/index.php' );
        $this->assertEquals( $sUrl, $oConfig->getShopHomeUrl() );
    }

    /**
     * Testing getShopSecureHomeUrl getter
     */
    public function testGetShopSecureHomeUrl()
    {
        $oConfig = new modForGetShopHomeUrl();
        $oConfig->init();
        $sUrl = oxSession::getInstance()->url( 'https://www.example.com/index.php' );
        $this->assertEquals( $sUrl, $oConfig->getShopSecureHomeUrl() );
    }


    /**
     * Testing getSslShopUrl getter
     */
    public function testGetSslShopUrlLanguageUrl()
    {
        $oConfig = new oxConfig();
        $oConfig->init();
        $aLanguageSslUrls = array( 5 => 'https://www.example.com/' );
        $oConfig->setConfigParam( 'aLanguageSSLURLs', $aLanguageSslUrls );
        $this->assertEquals( $aLanguageSslUrls[5], $oConfig->getSslShopUrl( 5 ) );
    }
    public function testGetSslShopUrlByLanguageArrayAddsEndingSlash()
    {
        $oConfig = $this->getMock( 'oxConfig', array( 'isAdmin' ) ) ;
        $oConfig->expects( $this->any() )->method( 'isAdmin')->will( $this->returnValue( false ) );
        $oConfig->init();
        $oConfig->setConfigParam( 'aLanguageSSLURLs', array( 5 => 'http://www.example.com' ) );
        $this->assertEquals( 'http://www.example.com/', $oConfig->getSslShopUrl( 5 ) );
    }

    public function testGetSslShopUrlMallSslUrl()
    {
        $oConfig = new oxConfig();
        $oConfig->init();
        $oConfig->setConfigParam( 'aLanguageSSLURLs', null );
        $oConfig->setConfigParam( 'sMallSSLShopURL', 'https://www.example2.com/' );
        $this->assertEquals( 'https://www.example2.com/', $oConfig->getSslShopUrl() );
    }
    public function testGetSslShopUrlMallSslUrlAddsEndingSlash()
    {
        $oConfig = new oxConfig();
        $oConfig->init();
        $oConfig->setConfigParam( 'aLanguageSSLURLs', null );
        $oConfig->setConfigParam( 'sMallSSLShopURL', 'https://www.example2.com' );
        $this->assertEquals( 'https://www.example2.com/', $oConfig->getSslShopUrl() );
    }
    public function testGetSslShopUrlMallUrl()
    {
        $oConfig = new oxConfig();
        $oConfig->init();
        $oConfig->setConfigParam( 'aLanguageSSLURLs', null );
        $oConfig->setConfigParam( 'sMallSSLShopURL', null );
        $oConfig->setConfigParam( 'sMallShopURL', 'https://www.example3.com/' );
        $this->assertEquals( 'https://www.example3.com/', $oConfig->getSslShopUrl() );
    }
    public function testGetSslShopUrlSslUrl()
    {
        $oConfig = new oxConfig();
        $oConfig->init();
        $oConfig->setConfigParam( 'aLanguageSSLURLs', null );
        $oConfig->setConfigParam( 'sMallSSLShopURL', null );
        $oConfig->setConfigParam( 'sMallShopURL', null );
        $oConfig->setConfigParam( 'sSSLShopURL', 'https://www.example4.com' );
        $this->assertEquals( 'https://www.example4.com', $oConfig->getSslShopUrl() );
    }
    public function testGetSslShopUrlDefaultUrl()
    {
        $oConfig = new oxConfig();
        $oConfig->init();
        $oConfig->setConfigParam( 'aLanguageSSLURLs', null );
        $oConfig->setConfigParam( 'sMallSSLShopURL', null );
        $oConfig->setConfigParam( 'sMallShopURL', null );
        $oConfig->setConfigParam( 'sSSLShopURL', null );
        $this->assertEquals( $oConfig->getConfigParam( 'sShopURL' ), $oConfig->getSslShopUrl() );
    }
    public function testGetSslShopUrlConfigUrl()
    {
        $oConfig = new oxConfig();
        $oConfig->init();
        $oConfig->setConfigParam( 'sSSLShopURL', 'https://www.example4.com' );
        $this->assertEquals( 'https://www.example4.com', $oConfig->getSslShopUrl() );
    }

    /**
     * Testing getActShopCurrencyObject getter
     */
    public function testGetActShopCurrencyObjectCurrent()
    {
        $oGbp = new Oxstdclass;
        $oGbp->id = 1;
        $oGbp->name = 'GBP';
        $oGbp->rate = '0.8565';
        $oGbp->dec = '.';
        $oGbp->thousand = '';
        $oGbp->sign = '�';
        $oGbp->decimal = '2';
        $oGbp->selected = 0;

        modConfig::setParameter( 'cur', 1 );
        $oConfig = new oxConfig();
        $oConfig->init();
        $this->assertEquals( $oGbp, $oConfig->getActShopCurrencyObject() );

    }
    public function testGetActShopCurrencyObjectDefauls()
    {
        // preparing fixture
        $oEur = new Oxstdclass;
        $oEur->id = 0;
        $oEur->name = 'EUR';
        $oEur->rate = '1.00';
        $oEur->dec = ',';
        $oEur->thousand = '.';
        $oEur->sign = '�';
        $oEur->decimal = '2';
        $oEur->selected = 0;

        modConfig::setParameter( 'cur', 999 );
        $oConfig = new oxConfig();
        $oConfig->init();
        $this->assertEquals( $oEur, $oConfig->getActShopCurrencyObject() );
    }


    /**
     * Testing getShopCurrentUrl getter
     */
    public function testGetShopCurrentUrlIsSsl()
    {
        $oConfig = new modForTestGetBaseTemplateDirAdminSsl();
        $oConfig->init();
        $oConfig->setConfigParam( 'sSSLShopURL', 'https://www.example.com/' );
        $this->assertEquals( 'https://www.example.com/index.php?', $oConfig->getShopCurrentUrl() );
    }
    public function testGetShopCurrentUrlNoSsl()
    {
        $oConfig = new modForTestGetBaseTemplateDirNonAdminNonSsl();
        $oConfig->init();
        $oConfig->setConfigParam( 'sShopURL', 'http://www.example.com/' );
        $this->assertEquals( 'http://www.example.com/index.php?', $oConfig->getShopCurrentUrl() );

    }


    /**
     * Testing getShopUrl getter
     */
    public function testGetShopUrlIsAdmin()
    {
        $oConfig = $this->getMock( 'oxConfig', array( 'isAdmin' ) );
        $oConfig->expects( $this->any() )->method( 'isAdmin')->will( $this->returnValue( true ) );

        $oConfig->init();
        $this->assertEquals( $oConfig->getConfigParam( 'sShopURL' ), $oConfig->getShopUrl() );
    }
    public function testGetShopUrlByLanguageArray()
    {
        $oConfig = $this->getMock( 'oxConfig', array( 'isAdmin' ) ) ;
        $oConfig->expects( $this->any() )->method( 'isAdmin')->will( $this->returnValue( false ) );
        $oConfig->init();
        $oConfig->setConfigParam( 'aLanguageURLs', array( 5 => 'http://www.example.com/' ) );
        $this->assertEquals( 'http://www.example.com/', $oConfig->getShopUrl( 5 ) );
    }
    public function testGetShopUrlByLanguageArrayAddsEndingSlash()
    {
        $oConfig = $this->getMock( 'oxConfig', array( 'isAdmin' ) ) ;
        $oConfig->expects( $this->any() )->method( 'isAdmin')->will( $this->returnValue( false ) );
        $oConfig->init();
        $oConfig->setConfigParam( 'aLanguageURLs', array( 5 => 'http://www.example.com' ) );
        $this->assertEquals( 'http://www.example.com/', $oConfig->getShopUrl( 5 ) );
    }
    public function testGetShopUrlByMallUrl()
    {
        $oConfig = $this->getMock( 'oxConfig', array( 'isAdmin' ) ) ;
        $oConfig->expects( $this->any() )->method( 'isAdmin')->will( $this->returnValue( false ) );
        $oConfig->init();

        $oConfig->setConfigParam( 'aLanguageURLs', null );
        $oConfig->setConfigParam( 'sMallShopURL', 'http://www.example2.com/' );
        $this->assertEquals( 'http://www.example2.com/', $oConfig->getShopUrl() );
    }
    public function testGetShopUrlByMallUrlAddsEndingSlash()
    {
        $oConfig = $this->getMock( 'oxConfig', array( 'isAdmin' ) ) ;
        $oConfig->expects( $this->any() )->method( 'isAdmin')->will( $this->returnValue( false ) );
        $oConfig->init();

        $oConfig->setConfigParam( 'aLanguageURLs', null );
        $oConfig->setConfigParam( 'sMallShopURL', 'http://www.example2.com' );
        $this->assertEquals( 'http://www.example2.com/', $oConfig->getShopUrl() );
    }
    public function testGetShopUrlDefaultUrl()
    {
        $oConfig = $this->getMock( 'oxConfig', array( 'isAdmin' ) );
        $oConfig->expects( $this->any() )->method( 'isAdmin' )->will( $this->returnValue( false ) );
        $oConfig->init();
        $oConfig->setConfigParam( 'aLanguageURLs', null );
        $oConfig->setConfigParam( 'sMallShopURL', null );
        $this->assertEquals( $oConfig->getConfigParam( 'sShopURL' ), $oConfig->getShopUrl() );
    }

    /**
     * Testing getShopLanguage getter
     */
    // testing if all request given parameters are used
    /* P
    public function testGetShopLanguageTestingRequest()
    {
        modConfig::setParameter( 'changelang', 1 );
        $oConfig = $this->getMock( 'oxConfig', array( 'isAdmin' ) );
        $oConfig->expects( $this->any() )->method( 'isAdmin')->will( $this->returnValue( false ) );
        $oConfig->init();
        //$oConfig->setNonPublicVar( '_iLanguageId', null );
        $this->assertEquals( 1, $oConfig->getShopLanguage() );

        modConfig::setParameter( 'changelang', null );
        modConfig::setParameter( 'lang', 1 );
        $oConfig = new oxConfig();
        $oConfig->init();
        $this->assertEquals( 1, $oConfig->getShopLanguage() );

        modConfig::setParameter( 'changelang', null );
        modConfig::setParameter( 'lang',       null );
        modConfig::setParameter( 'tpllanguage', 1 );
        $oConfig = new oxConfig();
        $oConfig->init();
        $this->assertEquals( 1, $oConfig->getShopLanguage() );

        modConfig::setParameter( 'changelang',  null );
        modConfig::setParameter( 'lang',        null );
        modConfig::setParameter( 'tpllanguage', null );
        modConfig::setParameter( 'language', 1 );
        $oConfig = new oxConfig();
        $oConfig->init();
        $this->assertEquals( 1, $oConfig->getShopLanguage() );

        modConfig::setParameter( 'changelang',  null );
        modConfig::setParameter( 'lang',        null );
        modConfig::setParameter( 'tpllanguage', null );
        modConfig::setParameter( 'language',    null );
        $oConfig = new oxConfig();
        $oConfig->init();
        $oConfig->setConfigParam( 'sDefaultLang', 1 );
        $this->assertEquals( 1, $oConfig->getShopLanguage() );
    }
    // testing if bad language id is fixed
    public function testGetShopLanguagePassingNotExistingShouldBeFixed()
    {
        modConfig::setParameter( 'changelang', 'xxx' );
        $oConfig = new oxConfig();
        $oConfig->init();
        $this->assertEquals( 0, $oConfig->getShopLanguage() );
    }
    // testing if url configuration sets language
    public function testGetShopLanguageLanguageURLs()
    {
        $oConfig = $this->getMock( 'modFortestGetShopLanguageLanguageURLs', array( 'isAdmin' ) );
        $oConfig->expects( $this->any() )->method( 'isAdmin' )->will( $this->returnValue( false ) );
        $oConfig->init();
        $oConfig->setConfigParam( 'aLanguageURLs', array( 1 => 'xxx' ) );

        $this->assertEquals( 1, $oConfig->getShopLanguage() );
    }
    */

    /**
     * Merger them both - GetShopId and GetActiveShopId
     */
    // PE: always oxbaseshop
    public function testGetShopIdForPeAlwaysOxbaseshop()
    {

        $oConfig = new oxConfig();
        $oConfig->init();
        $this->assertEquals( 'oxbaseshop', $oConfig->getShopId() );
    }








    public function getShopFromLangUrls_isCurrentUrl15($url)
    {
        if (!in_array($url, array('asd', 'dsa', 'asda', 'dsad'))) {
            $this->fail("unknown url given");
        }
        return $url == 'dsad';
    }
    public function getShopFromLangUrls_isCurrentUrl14($url)
    {
        if (!in_array($url, array('asd', 'dsa', 'asda', 'dsad'))) {
            $this->fail("unknown url given");
        }
        return $url == 'asd';
    }



    /**
     * Testing input processor
     */
    // checking 3 cases - passing object, array, string
    public function testCheckSpecialChars()
    {
        $oVar = new OxstdClass();
        $oVar->xxx = 'yyy';
        $aVar = array( '&\\o<x>i"\'d'.chr(0) );
        $sVar = '&\\o<x>i"\'d'.chr(0);

        // object must came back the same
        $this->assertEquals( $oVar, oxConfig::checkSpecialChars( $oVar ) );

        // array items comes fixed
        $this->assertEquals( array( '&amp;&#092;o&lt;x&gt;i&quot;&#039;d' ), oxConfig::checkSpecialChars( $aVar ) );

        // string comes fixed
        $this->assertEquals( '&amp;&#092;o&lt;x&gt;i&quot;&#039;d', oxConfig::checkSpecialChars( $sVar ) );
    }

    // checking array, if few values must not be checked
    public function testCheckSpecialCharsForArray()
    {
        $aValues = array( 'first' => 'first char &', 'second' => 'second char &', 'third' => 'third char &' );
        $aRaw = array('first', 'third');
        // object must came back the same
        $aRet = oxConfig::checkSpecialChars( $aValues, $aRaw );
        $this->assertEquals($aValues['first'], $aRet['first']);
        $this->assertEquals('second char &amp;', $aRet['second']);
        $this->assertEquals($aValues['third'], $aRet['third']);
    }

    public function testGetUploadedFile()
    {
        $aBack = $_FILES;
        $_FILES['upload'] = 'testValue';

        $this->assertEquals('testValue', oxConfig::getInstance()->getUploadedFile('upload'));

        $_FILES = $aBack;
    }

    public function testGetParameterInNonAdminModeDoesNotGetAdminRights()
    {
        $oldBlIsAdmin = oxSession::getVar("blIsAdmin");
        $oldIsAdmin = oxConfig::getInstance()->isAdmin();
        $sReqMethod = $_SERVER['REQUEST_METHOD'];

        $e = null;
        try {
            modConfig::getInstance()->cleanup();
            $_SERVER['REQUEST_METHOD'] = 'GET';
            $_GET['testval'] = 'testval&\'"';

            // normal way of shop
            oxSession::setVar("blIsAdmin", false);
            oxConfig::getInstance()->setAdminMode(false);
            $this->assertEquals('testval&amp;&#039;&quot;', oxConfig::getParameter('testval'));

            // this admin mode can be faked
            oxConfig::getInstance()->setAdminMode(true);
            $this->assertEquals('testval&amp;&#039;&quot;', oxConfig::getParameter('testval'));

            // full admin mode
            oxSession::setVar("blIsAdmin", true);
            $this->assertEquals('testval&\'"', oxConfig::getParameter('testval'));

            // wrong admin mode.
            oxConfig::getInstance()->setAdminMode(false);
            $this->assertEquals('testval&amp;&#039;&quot;', oxConfig::getParameter('testval'));
        } catch (Exception $e) {
        }

        oxSession::setVar("blIsAdmin", $oldBlIsAdmin);
        oxConfig::getInstance()->setAdminMode($oldIsAdmin);
        $_GET['testval'] = null;
        unset($_GET['testval']);
        $_SERVER['REQUEST_METHOD'] = $sReqMethod;


        if ($e instanceof Exception) {
            throw $e;
        }
    }

    public function testCheckSpecialCharsAlsoFixesArrayKeys()
    {
        $test = array(
            array (
                'data'   => array('asd&' => 'a%&'),
                'result' => array('asd&amp;' => 'a%&amp;'),
            ),
            array (
                'data'   => 'asd&',
                'result' => 'asd&amp;',
            )
        );

        foreach ($test as $check) {
            $this->assertEquals($check['result'], oxConfig::checkSpecialChars($check['data']));
        }
    }

    public function testGetEdition()
    {
        $sShopId = modConfig::getInstance()->getShopId();
        $sEdition = oxDb::getDb()->getOne("select oxedition from oxshops where oxid = '$sShopId'");
        $this->assertEquals($sEdition, modConfig::getInstance()->getEdition());
    }

    public function testGetRevision()
    {
        $iRev = modConfig::getInstance()->getRevision();
        $this->assertTrue($iRev > 10000);
    }

    public function testGetEditionNotEmpty()
    {
        $this->assertNotEquals('', modConfig::getInstance()->getEdition());
    }

    public function testGetFullEdition()
    {
        $sFEdition = modConfig::getInstance()->getFullEdition();
            $this->assertEquals("Community Edition", $sFEdition);
        $oConfig = $this->getMock( 'oxConfig', array( 'getEdition' ) );
        $oConfig->expects( $this->any() )->method( 'getEdition' )->will( $this->returnValue( "Test Edition") );
        $this->assertEquals("Test Edition", $oConfig->getFullEdition());
    }

    public function testGetVersion()
    {
        $sShopId = modConfig::getInstance()->getShopId();
        $sVer = oxDb::getDb()->getOne("select oxversion from oxshops where oxid = '$sShopId'");
        $this->assertEquals($sVer, modConfig::getInstance()->getVersion());
    }

    public function testGetVersionNotEmpty()
    {
        $this->assertNotEquals('', modConfig::getInstance()->getVersion());
    }

    public function testCorrectVersion()
    {
        //at least version 4.0.0.0 (should assert corerctly for higher numbers as well)
        $this->assertTrue(version_compare(modConfig::getInstance()->getVersion(), '4.0.0.0') >= 0);
    }



    public function testGetDir_level5()
    {
        $sTestDir = getTestsBasePath().'/unit/';

        $oConfig = $this->getMock( 'oxConfig', array( 'getOutDir' ) );
        $oConfig->expects( $this->any() )->method( 'getOutDir' )->will( $this->returnValue( $sTestDir.'out/' ) );
        $oConfig->init();

        $sOutDir = $sTestDir.$this->_getOutPath( $oConfig, 'test4', false);

        $sDir = $oConfig->getDir('text.txt', 'test1', false, 0, 1, 'test4');
        $this->assertEquals($sOutDir.'1/de/test1/text.txt', $sDir);
    }

    public function testGetDir_delvel4()
    {
        $sTestDir = getTestsBasePath().'/unit/';

        $oConfig = $this->getMock( 'oxConfig', array( 'getOutDir' ) );
        $oConfig->expects( $this->any() )->method( 'getOutDir' )->will( $this->returnValue( $sTestDir.'out/' ) );
        $oConfig->init();

        $sOutDir = $sTestDir.$this->_getOutPath( $oConfig, 'test4', false);

        $sDir = $oConfig->getDir('text.txt', 'test2', false, 0, 1, 'test4');
        $this->assertEquals($sOutDir.'1/test2/text.txt', $sDir);
    }

    public function testGetDir_level3()
    {
        $sTestDir = getTestsBasePath().'/unit/';

        $oConfig = $this->getMock( 'oxConfig', array( 'getOutDir' ) );
        $oConfig->expects( $this->any() )->method( 'getOutDir' )->will( $this->returnValue( $sTestDir.'out/' ) );
        $oConfig->init();

        $sOutDir = $sTestDir.$this->_getOutPath( $oConfig, 'test4', false);

        $sDir = $oConfig->getDir('text.txt', 'test2a', false, 0, 1, 'test4');
        $this->assertEquals($sOutDir.'de/test2a/text.txt', $sDir);
    }

    public function testGetDir_delvel2()
    {
        $sTestDir = getTestsBasePath().'/unit/';

        $oConfig = $this->getMock( 'oxConfig', array( 'getOutDir' ) );
        $oConfig->expects( $this->any() )->method( 'getOutDir' )->will( $this->returnValue( $sTestDir.'out/' ) );
        $oConfig->init();

        $sOutDir = $sTestDir.$this->_getOutPath( $oConfig, 'test4', false);

        $sDir = $oConfig->getDir('text.txt', 'test3', false, 0, 1, 'test4');
        $this->assertEquals($sOutDir.'test3/text.txt', $sDir);
    }

    public function testGetDir_delvel1()
    {
        $sTestDir = getTestsBasePath().'/unit/';

        $oConfig = $this->getMock( 'oxConfig', array( 'getOutDir' ) );
        $oConfig->expects( $this->any() )->method( 'getOutDir' )->will( $this->returnValue( $sTestDir.'out/' ) );
        $oConfig->init();

        $sOutDir = $sTestDir.$this->_getOutPath( $oConfig, 'test4', false );

        $sDir = $oConfig->getDir('text.txt', 'test4', false, 0, 1, 'test4');
        $this->assertEquals($sOutDir.'text.txt', $sDir);
    }

    public function testGetDir_delvel0()
    {
        $sTestDir = getTestsBasePath().'/unit/';

        $oConfig = $this->getMock( 'oxConfig', array( 'getOutDir' ) );
        $oConfig->expects( $this->any() )->method( 'getOutDir' )->will( $this->returnValue( $sTestDir.'out/' ) );
        $oConfig->init();

        $sOutDir = $sTestDir."out/";

        $sDir = $oConfig->getDir('text.txt', 'test5', false, 0, 1, 'test4');
        $this->assertEquals($sOutDir.'de/test5/text.txt', $sDir);
    }





    public function testGetOutDir()
    {
        $oConfig = new oxConfig();
        $this->assertEquals( 'out/', $oConfig->getOutDir( false ));
        $oConfig->setConfigParam( 'sShopDir', 'test/');
        $this->assertEquals( 'test/out/', $oConfig->getOutDir());
    }

    public function testGetOutUrl()
    {
        $oConfig = $this->getMock( 'oxConfig', array( 'isAdmin', 'getShopUrl' ) );
        $oConfig->expects( $this->any() )->method( 'isAdmin' )->will( $this->returnValue( false ) );
        $oConfig->expects( $this->any() )->method( 'getShopUrl' )->will( $this->returnValue( 'testUrl/' ) );
        $oConfig->init();
        $this->assertEquals( 'testUrl/out/', $oConfig->getOutUrl(false, null, true));
    }

    public function testGetOutUrlSsl()
    {
        $oConfig = $this->getMock( 'oxConfig', array( 'isSsl', 'getSslShopUrl' ) );
        $oConfig->expects( $this->any() )->method( 'isSsl' )->will( $this->returnValue( true ) );
        $oConfig->expects( $this->any() )->method( 'getSslShopUrl' )->will( $this->returnValue( 'sslUrl/' ) );
        $oConfig->init();
        $this->assertEquals( 'sslUrl/out/', $oConfig->getOutUrl(null, false, true));
    }

    public function testGetOutUrlIsAdminFromParam()
    {
        $oConfig = new oxConfig();
        $oConfig->setConfigParam( 'sShopURL', 'testUrl/');
        $this->assertEquals( 'testUrl/out/', $oConfig->getOutUrl(false, true, true));
    }

    public function testGetOutUrlIsSslFromParam()
    {
        $oConfig = new oxConfig();
        $oConfig->setConfigParam( 'sSSLShopURL', 'testSslUrl/');
        $this->assertEquals( 'testSslUrl/out/', $oConfig->getOutUrl(true, false, false));
    }

    /**
     * Testing getPicturePath getter
     */
    public function testGetPicturePath()
    {
        $oConfig = new oxConfig();
        $oConfig->init();
        $sDir = $oConfig->getConfigParam( 'sShopDir' ).'out/pictures'.OXID_VERSION_SUFIX.'/';
        $this->assertEquals( $sDir, $oConfig->getPicturePath( null, false) );
    }

    /**
     * Testing getPictureUrl getter
     */
    public function testGetPictureUrl()
    {
        $oConfig = new oxConfig();
        $oConfig->init();

        $sMainURL = $oConfig->getConfigParam( 'sShopURL' );
        $sMallURL = 'http://www.example.com/';

        $sDir = 'out/pictures'.OXID_VERSION_SUFIX.'/';

        $oConfig->setConfigParam( 'sMallShopURL', $sMallURL);

        $oConfig->setConfigParam( 'blNativeImages', false );
        $this->assertEquals( $sMainURL.$sDir, $oConfig->getPictureUrl( null, false) );

        $oConfig->setConfigParam( 'blNativeImages', true );
        $this->assertEquals( $sMallURL.$sDir, $oConfig->getPictureUrl( null, false) );
    }
    public function testGetPictureUrlForAltImageDir()
    {
        $oConfig = new oxConfig();
        $oConfig->init();
        $oConfig->setConfigParam( 'sAltImageDir', 'http://www.example.com' );
        $sDir = 'http://www.example.com/test.gif';
        $this->assertEquals( $sDir, $oConfig->getPictureUrl( "/test.gif", false) );
    }
    public function testGetPictureUrlFormerTplSupport()
    {
        $oConfig = new oxConfig();
        $oConfig->init();
        $oConfig->setConfigParam( 'blFormerTplSupport', true );
        //$this->assertEquals( '', $oConfig->getPictureUrl( "test.gif", false) );
        $this->assertContains( 'nopic.jpg', $oConfig->getPictureUrl( "test.gif", false) );
    }

    public function testGetPictureUrlNeverEmptyString()
    {
        $oConfig = new oxConfig();
        $oConfig->init();
        $oConfig->setConfigParam( 'blFormerTplSupport', true );
        $this->assertNotEquals( '', $oConfig->getPictureUrl( "test.gif", false) );
        $this->assertContains( 'nopic.jpg', $oConfig->getPictureUrl( "test.gif", false) );
    }

    public function testgetPictureUrlForBugEntry0001557()
    {
        $myConfig = oxConfig::getInstance();

        $oConfig = new oxConfig();
        $oConfig->init();
        $oConfig->setConfigParam( "sAltImageDir", false );
        $oConfig->setConfigParam( "blFormerTplSupport", false );

        $this->assertEquals( $myConfig->getConfigParam( "sShopURL" )."out/pictures".OXID_VERSION_SUFIX."/0/nopic.jpg", $oConfig->getPictureUrl( "unknown.file", true ) );
    }

    public function testGetTemplateBase()
    {
        $oConfig = new oxConfig();
        $oConfig->init();
        $this->assertEquals( "out/admin/", $oConfig->getTemplateBase( true ) );
    }

    public function testGetResourcePath()
    {
        $oConfig = new oxConfig();
        $oConfig->init();
        $this->assertEquals( $oConfig->getConfigParam( 'sShopDir' )."out/admin/src/main.css", $oConfig->getResourcePath( "main.css", true ) );
    }

    public function testGetResourceDir()
    {
        $oConfig = new oxConfig();
        $oConfig->init();
        $this->assertEquals( $oConfig->getConfigParam( 'sShopDir' )."out/admin/src/", $oConfig->getResourceDir( true ) );
    }

    public function testGetResourceUrl()
    {
        $oConfig = new oxConfig();
        $oConfig->init();

        $sMainURL = $oConfig->getConfigParam( 'sShopURL' );
        $sMallURL = 'http://www.example.com/';

        $sDir = 'out/basic/src/';

        $oConfig->setConfigParam( 'sMallShopURL', $sMallURL);

        $oConfig->setConfigParam( 'blNativeImages', false );
        $this->assertEquals( $sMainURL.$sDir, $oConfig->getResourceUrl( null, false) );

        $oConfig->setConfigParam( 'blNativeImages', true );
        $this->assertEquals( $sMallURL.$sDir, $oConfig->getResourceUrl( null, false) );
    }

    public function testGetLanguagePath()
    {
        $oConfig = new oxConfig();
        $oConfig->init();
        $this->assertEquals( $oConfig->getConfigParam( 'sShopDir' )."out/admin/en/lang.php", $oConfig->getLanguagePath( "lang.php", 1, true ) );
    }

    public function testGetLanguageDir()
    {
        $oConfig = new oxConfig();
        $oConfig->init();
        $this->assertEquals( $oConfig->getConfigParam( 'sShopDir' )."out/admin/de//", $oConfig->getLanguageDir( true ) );
    }


    public function testIsDemoShop()
    {
        $oConfig = new oxConfig();
        $oConfig->init();
        $oConfig->setConfigParam('blDemoShop', true);
        $this->assertTrue( $oConfig->isDemoShop() );
    }





    public function testUtfModeIsSet()
    {
        //T2009-08-17
        //skipping this test. This config option is set only during setup process, but at the moment unit test db is set up from sql file.
        //any idea how ths could be tested
        $this->markTestSkipped();
        $sQ = "select count(*) from oxconfig where oxvarname = 'iSetUtfMode'";
        $iRes = oxDb::getDb()->getOne($sQ);
        $this->assertTrue($iRes >= 1);
    }
}
