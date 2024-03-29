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
 * @version   SVN: $Id: oxutilsTest.php 42762 2012-03-13 11:25:50Z linas.kukulskis $
 */

require_once realpath( "." ).'/unit/OxidTestCase.php';
require_once realpath( "." ).'/unit/test_config.inc.php';

class testOxUtils extends oxUtils
{
    public function setNonPublicVar($name,$value)
    {
        $this->$name = $value;
    }

    public function getNonPublicVar($name,$value)
    {
        $this->$name = $value;
    }

    public function __call( $sMethod, $aArgs)
    {
            if ( substr( $sMethod, 0, 4) == "UNIT") {
                $sMethod = str_replace( "UNIT", "_", $sMethod);
            }
            if ( method_exists( $this, $sMethod)) {
                return call_user_func_array( array( & $this, $sMethod), $aArgs );
            }

        throw new oxSystemComponentException( "Function '$sMethod' does not exist or is not accessible! (".__CLASS__.")".PHP_EOL);
    }
}

class Unit_Core_oxutilsTest extends OxidTestCase
{
    protected $_sTestLogFileName = null;

    /**
     * Tear down the fixture.
     *
     * @return null
     */
    protected function tearDown()
    {
        oxUtils::getInstance()->commitFileCache();

        clearstatcache();
        //removing test files from tmp dir
        $sFilePath = oxConfig::getInstance()->getConfigParam( 'sCompileDir' ) . "*testFileCache*.txt";
        $aPathes   = glob( $sFilePath);
        if ( is_array($aPathes) ) {
            foreach ( $aPathes as $sFilename ) {
                @unlink( $sFilename );
            }
        }

        if ( $this->_sTestLogFileName !== null ) {
            unlink( $this->_sTestLogFileName );
            $this->_sTestLogFileName = null;
        }
        if ( file_exists( 'tmp_testCacheName' ) ) {
            unlink('tmp_testCacheName');
        }

        $oUtils = oxUtils::getInstance();
        $sFileName = $oUtils->getCacheFilePath("testVal", false, 'php');
        if ( file_exists( $sFileName ) ) {
            unlink( $sFileName );
        }

        $sFileName = $oUtils->getCacheFilePath('testCache1');
        if ( file_exists( $sFileName ) ) {
            unlink( $sFileName );
        }

        parent::tearDown();
    }

    /**
     *
     * @return unknown_type
     */
    public function testExtractDomain()
    {
        $oUtils = new oxUtils();
        $this->assertEquals( "oxid-esales.com", $oUtils->extractDomain( "www.oxid-esales.com" ) );
        $this->assertEquals( "oxid-esales.com", $oUtils->extractDomain( "oxid-esales.com" ) );
        $this->assertEquals( "127.0.0.1", $oUtils->extractDomain( "127.0.0.1" ) );
        $this->assertEquals( "oxid-esales.com", $oUtils->extractDomain( "ssl.oxid-esales.com" ) );
        $this->assertEquals( "oxid-esales", $oUtils->extractDomain( "oxid-esales" ) );
    }

    public function testShowMessageAndExit()
    {
        $oSession = $this->getMock( "OxStdClass", array( "freeze" ) );
        $oSession->expects( $this->once() )->method( 'freeze');

        $oUtils = $this->getMock( "oxUtils", array( "getSession", "commitFileCache" ) );
        $oUtils->expects( $this->once() )->method( 'getSession')->will( $this->returnValue( $oSession ) );
        $oUtils->expects( $this->once() )->method( 'commitFileCache');

        $oUtils->showMessageAndExit( "" );
    }

    public function testWriteToLog()
    {
        $sLogMessage = $sLogFileName = md5( uniqid( rand(), true ) );

        $oUtils = new oxUtils();
        $oUtils->writeToLog( $sLogMessage, $sLogFileName );

        $this->_sTestLogFileName = oxConfig::getInstance()->getConfigParam( 'sShopDir' ).'log/'.$sLogFileName;

        clearstatcache();
        $this->assertTrue( file_exists( $this->_sTestLogFileName ) );
        $this->assertEquals( $sLogMessage, file_get_contents( $this->_sTestLogFileName ) );
    }

    public function testSetLangCache()
    {
        $aLangCache = array( "ggg" => "bbb" );
        $sCacheName = 'tmp_testCacheName';
        $sCache = "<?php\n\$aLangCache = ".var_export( $aLangCache, true ).";";

        $oUtils = $this->getMock( 'oxutils', array( 'getCacheFilePath' ) );
        $oUtils->expects( $this->once() )->method( 'getCacheFilePath')->with( $this->equalTo( $sCacheName ) )->will( $this->returnValue( "tmp_testCacheName" ) );
        $oUtils->setLangCache( $sCacheName, $aLangCache );
    }


    public function testgetLangCache()
    {
        $sCacheName = time();
        $aLangCache = array( "ggg" => "bbb" );

        $oUtils = new oxutils();
        $oUtils->setLangCache( $sCacheName, $aLangCache );

        $this->assertEquals( $aLangCache, $oUtils->getLangCache( $sCacheName ) );
    }

    /**
     * Seo mode checker
     */
    public function testSeoIsActive()
    {
        // as now SEO is on by default
        $oUtils = new oxutils();

        $oConfig = $oUtils->getConfig();
        $oConfig->setConfigParam( 'aSeoModes', array( 'testshop' => array( 2 => false, 3 => true ) ) );

        $this->assertTrue( $oUtils->seoIsActive() );

        // cache test
        $this->assertTrue( $oUtils->seoIsActive( false, 'testshop', 2 ) );
        $this->assertFalse( $oUtils->seoIsActive( true, 'testshop', 2 ) );

        // config test
        $this->assertTrue( $oUtils->seoIsActive( true, 'testshop', 3 ) );
    }

    public function testGetArrFldName()
    {
        $sTestString = ".S.o.me.. . Na.me.";
        $sShouldBeResult = "__S__o__me____ __ Na__me__";

        $this->assertEquals($sShouldBeResult, oxUtils::getInstance()->getArrFldName($sTestString));
    }

    /**
     * Check of full version processor
     */
    public function testAssignValuesFromTextFull()
    {
        $myConfig = oxConfig::getInstance();
        $oCurrency = $myConfig->getActShopCurrencyObject();

        modConfig::getInstance()->setConfigParam( 'bl_perfLoadSelectLists', true );
        modConfig::getInstance()->setConfigParam( 'bl_perfUseSelectlistPrice', true );

        $sTestString = "one!P!99.5%__oneValue@@two!P!12,41__twoValue@@three!P!-5,99__threeValue@@Lagerort__Lager 1@@";
        $aResult = oxUtils::getInstance()->assignValuesFromText( $sTestString );

        $aShouldBe = array();
        $oObject = new OxstdClass();
        $oObject->price = '99.5';
        $oObject->priceUnit = '%';
        $oObject->fprice = '99.5%';
        $oObject->name  = 'one +99.5%';
        $oObject->value = 'oneValue';
        $aShouldBe[] = $oObject;

        $oObject = new OxstdClass();
        $oObject->price  = '12.41';
        $oObject->fprice = '12,41';
        $oObject->priceUnit = 'abs';
        $oObject->name  = 'two +12,41 '.$oCurrency->sign;
        $oObject->value = 'twoValue';
        $aShouldBe[] = $oObject;

        $oObject = new OxstdClass();
        $oObject->price  = '-5.99';
        $oObject->fprice = '-5,99';
        $oObject->priceUnit = 'abs';
        $oObject->name  = 'three -5,99 '.$oCurrency->sign;
        $oObject->value = 'threeValue';
        $aShouldBe[] = $oObject;

        $oObject = new OxstdClass();
        $oObject->name  = 'Lagerort';
        $oObject->value = 'Lager 1';
        $aShouldBe[] = $oObject;

        $this->assertEquals( $aShouldBe, $aResult );
    }

    /**
     * Check of full version processor
     */
    public function testAssignValuesFromTextFullIfPriceIsZero()
    {
        $myConfig = oxConfig::getInstance();
        $oCurrency = $myConfig->getActShopCurrencyObject();

        modConfig::getInstance()->setConfigParam( 'bl_perfLoadSelectLists', true );
        modConfig::getInstance()->setConfigParam( 'bl_perfUseSelectlistPrice', true );

        $sTestString = "one__oneValue@@two!P!0.00__twoValue@@";
        $aResult = oxUtils::getInstance()->assignValuesFromText( $sTestString );

        $aShouldBe = array();
        $oObject = new OxstdClass();
        $oObject->name  = 'one';
        $oObject->value = 'oneValue';
        $aShouldBe[] = $oObject;

        $oObject = new OxstdClass();
        $oObject->price  = '0.00';
        $oObject->fprice = '0,00';
        $oObject->priceUnit = 'abs';
        $oObject->name  = 'two';
        $oObject->value = 'twoValue';
        $aShouldBe[] = $oObject;

        $this->assertEquals( $aShouldBe, $aResult );
    }

    /**
     * Check of full version processor (If NetPrice Is Entered)
     *  FS#2616
     */
    public function testAssignValuesFromTextFullWithVat()
    {
        $myConfig = oxConfig::getInstance();
        $oCurrency = $myConfig->getActShopCurrencyObject();

        modConfig::getInstance()->setConfigParam( 'bl_perfLoadSelectLists', true );
        modConfig::getInstance()->setConfigParam( 'bl_perfUseSelectlistPrice', true );
        modConfig::getInstance()->setConfigParam( 'blEnterNetPrice', true );

        $sTestString = "one!P!99.5%__oneValue@@two!P!12,41__twoValue@@";
        $aResult = oxUtils::getInstance()->assignValuesFromText( $sTestString, 19);

        $aShouldBe = array();
        $oObject = new OxstdClass();
        $oObject->price = '99.5';
        $oObject->priceUnit = '%';
        $oObject->fprice = '99.5%';
        $oObject->name  = 'one +99.5%';
        $oObject->value = 'oneValue';
        $aShouldBe[] = $oObject;

        $oObject = new OxstdClass();
        $oObject->price  = '12.41';
        $oObject->fprice = '12,41';
        $oObject->priceUnit = 'abs';
        $oObject->name  = 'two +14,77 '.$oCurrency->sign;
        $oObject->value = 'twoValue';
        $aShouldBe[] = $oObject;

        $this->assertEquals( $aShouldBe, $aResult );
    }

    /**
     * Check of simplified version processor
     */
    public function testAssignValuesFromTextLite()
    {
        $myConfig = oxConfig::getInstance();
        $oCurrency = $myConfig->getActShopCurrencyObject();

        modConfig::getInstance()->setConfigParam( 'bl_perfLoadSelectLists', false );
        modConfig::getInstance()->setConfigParam( 'bl_perfUseSelectlistPrice', false );

        $sTestString = "one!P!99.5%__oneValue@@two!P!12,41__twoValue@@three!P!-5,99__threeValue@@Lagerort__Lager 1@@";
        $aResult = oxUtils::getInstance()->assignValuesFromText( $sTestString );

        $aShouldBe = array();
        $oObject = new OxstdClass();
        $oObject->name  = 'one';
        $oObject->value = 'oneValue';
        $aShouldBe[] = $oObject;

        $oObject = new OxstdClass();
        $oObject->name  = 'two';
        $oObject->value = 'twoValue';
        $aShouldBe[] = $oObject;

        $oObject = new OxstdClass();
        $oObject->name  = 'three';
        $oObject->value = 'threeValue';
        $aShouldBe[] = $oObject;

        $oObject = new OxstdClass();
        $oObject->name  = 'Lagerort';
        $oObject->value = 'Lager 1';
        $aShouldBe[] = $oObject;

        $this->assertEquals( $aShouldBe, $aResult );
    }

    public function testAssignValuesToText()
    {

        $aTestArray = array('one' => 11, 'two' => 22, 'three' => 33, 'fourfour' => 44.44);
        $sResult = oxUtils::getInstance()->assignValuesToText($aTestArray);
        $sShouldBeResult = "one__11@@two__22@@three__33@@fourfour__44.44@@";
        $sShouldNotBeResult = "on__11@@two__22@@three__33@@fourfour__44.44@@";
        $this->assertEquals($sShouldBeResult, $sResult);
        $this->assertNotEquals($sShouldNotBeResult, $sResult);
    }

    public function testCurrency2Float()
    {
        $oActCur = oxConfig::getInstance()->getActShopCurrencyObject();
        $fFloat = oxUtils::getInstance()->currency2Float("10.322,32", $oActCur);
        $this->assertEquals($fFloat, 10322.32);
        $fFloat = oxUtils::getInstance()->currency2Float("10,322.32", $oActCur);
        $this->assertEquals($fFloat, (float)"10.322.32");
        $fFloat = oxUtils::getInstance()->currency2Float("10 322,32", $oActCur);
        $this->assertEquals($fFloat, (float)"10322.32");
        $fFloat = oxUtils::getInstance()->currency2Float("10 322.32", $oActCur);
        $this->assertEquals($fFloat, (float)"10322.32");
    }

    /**
     * SE check, non admin mode, will cache result
     */
    public function testIsSearchEngineNonAdminNonSE()
    {
        // cleaning ..
        $myConfig = oxConfig::getInstance();
        $myConfig->setGlobalParameter( 'blIsSearchEngine', null );

        modConfig::getInstance()->setConfigParam( 'iDebug', 1 );
        modConfig::getInstance()->setConfigParam( 'aRobots', array() );

        $oUtils = $this->getMock( 'oxUtils', array( 'isAdmin' ) );
        $oUtils->expects( $this->any() )->method( 'isAdmin')->will( $this->returnValue( false ) );

        $this->assertFalse( $oUtils->isSearchEngine( 'xxx' ) );
        $this->assertFalse( $oUtils->isSearchEngine( 'googlebot' ) );
    }

    public function testIsSearchEngineNonAdminSE()
    {
        // cleaning ..
        $myConfig = oxConfig::getInstance();
        $myConfig->setGlobalParameter( 'blIsSearchEngine', null );

        modConfig::getInstance()->setConfigParam( 'iDebug', 0 );
        modConfig::getInstance()->setConfigParam( 'aRobots', array('googlebot', 'xxx') );

        $oUtils = $this->getMock( 'oxUtils', array( 'isAdmin' ) );
        $oUtils->expects( $this->any() )->method( 'isAdmin')->will( $this->returnValue( false ) );

        $this->assertTrue( $oUtils->isSearchEngine( 'googlebot' ) );
        $this->assertTrue( $oUtils->isSearchEngine( 'xxx' ) );
    }

    public function testIsSearchEngineAdminAndDebugOn()
    {
        // cleaning ..
        $myConfig = oxConfig::getInstance();
        $myConfig->setGlobalParameter( 'blIsSearchEngine', null );

        modConfig::getInstance()->setConfigParam( 'iDebug', 1 );
        modConfig::getInstance()->setConfigParam( 'aRobots', array('googlebot', 'xxx') );

        $oUtils = $this->getMock( 'oxUtils', array( 'isAdmin' ) );
        $oUtils->expects( $this->any() )->method( 'isAdmin')->will( $this->returnValue( true ) );

        $this->assertFalse( $oUtils->isSearchEngine( 'xxx' ) );
        $this->assertFalse( $oUtils->isSearchEngine( 'googlebot' ) );
    }

    public function testIsSearchEngineAdminAndDebugOff()
    {
        // cleaning ..
        $myConfig = oxConfig::getInstance();
        $myConfig->setGlobalParameter( 'blIsSearchEngine', null );

        modConfig::getInstance()->setConfigParam( 'iDebug', 1 );
        modConfig::getInstance()->setConfigParam( 'aRobots', array('googlebot', 'xxx') );

        $oUtils = $this->getMock( 'oxUtils', array( 'isAdmin' ) );
        $oUtils->expects( $this->any() )->method( 'isAdmin')->will( $this->returnValue( true ) );

        $this->assertFalse( $oUtils->isSearchEngine( 'googlebot' ) );
        $this->assertFalse( $oUtils->isSearchEngine( 'xxx' ) );
    }

    public function testIsValidEmail()
    {
        $this->assertTrue( oxUtils::getInstance()->isValidEmail( 'mathias.krieck@oxid-esales.com' ) );
        $this->assertTrue( oxUtils::getInstance()->isValidEmail( 'mytest@com.org' ) );
        $this->assertFalse( oxUtils::getInstance()->isValidEmail( '�mathias.krieck@oxid-esales.com' ) );
        $this->assertFalse( oxUtils::getInstance()->isValidEmail( 'my/test@com.org' ) );
        $this->assertFalse( oxUtils::getInstance()->isValidEmail( '@com.org' ) );
        $this->assertFalse( oxUtils::getInstance()->isValidEmail( 'mytestcom.org' ) );
        $this->assertFalse( oxUtils::getInstance()->isValidEmail( 'mytest@com' ) );
    }

    public function testLoadAdminProfile()
    {

        $mySession = oxSession::getInstance();
        $myConfig = oxConfig::getInstance();


        $aProfiles = oxUtils::getInstance()->loadAdminProfile(array('640x480', '14'));
        $this->assertContains('640x480', $aProfiles[0]);

        $aProfiles = oxUtils::getInstance()->loadAdminProfile(v);
        $this->assertNull($aProfiles);

        $aProfiles = oxUtils::getInstance()->loadAdminProfile("teststring");
        $this->assertNull($aProfiles);
    }

    public function testFRound()
    {
        $myConfig = oxConfig::getInstance();

        $this->assertEquals('9.84', oxUtils::getInstance()->fRound('9.844'));
        $this->assertEquals('9.85', oxUtils::getInstance()->fRound('9.845'));
        $this->assertEquals('9.85', oxUtils::getInstance()->fRound('9.849'));
        $this->assertEquals('0', oxUtils::getInstance()->fRound('blafoo'));
        $this->assertEquals('9', oxUtils::getInstance()->fRound('9,849'));

        //negative
        $this->assertEquals('-9.84', oxUtils::getInstance()->fRound('-9.844'));
        $this->assertEquals('-9.85', oxUtils::getInstance()->fRound('-9.845'));
        $this->assertEquals('-9.85', oxUtils::getInstance()->fRound('-9.849'));
        $this->assertEquals('-9', oxUtils::getInstance()->fRound('-9,849'));


        $aCur = $myConfig->getCurrencyArray();
        $oCur = $aCur[1];
        $this->assertEquals('9.84', oxUtils::getInstance()->fRound('9.844', $oCur));
        $this->assertEquals('9.85', oxUtils::getInstance()->fRound('9.845', $oCur));
        $this->assertEquals('9.85', oxUtils::getInstance()->fRound('9.849', $oCur));
        $this->assertEquals('0', oxUtils::getInstance()->fRound('blafoo', $oCur));
        $this->assertEquals('9', oxUtils::getInstance()->fRound('9,849', $oCur));

        $this->assertEquals('-9.84', oxUtils::getInstance()->fRound('-9.844', $oCur));
        $this->assertEquals('-9.85', oxUtils::getInstance()->fRound('-9.845', $oCur));
        $this->assertEquals('-9.85', oxUtils::getInstance()->fRound('-9.849', $oCur));
        $this->assertEquals('-9', oxUtils::getInstance()->fRound('-9,849', $oCur));


    }

    public function testToFromStaticCache()
    {
        $oUtils = new oxutils();

        $sName    = "SomeName";
        $mContent = "SomeContent";
        $sKey     = "SomeKey";

        $oUtils->toStaticCache( $sName, $mContent );
        $this->assertEquals( $mContent, $oUtils->fromStaticCache( $sName ) );

        $sName    = "SomeOtherName";
        $mContent = "SomeOtherContent";
        $sKey     = "SomeOtherKey";

        $oUtils->toStaticCache( $sName, $mContent, $sKey );
        $aOut = $oUtils->fromStaticCache( $sName );
        $this->assertEquals( $mContent, $aOut[$sKey] );

        // testing non existing
        $this->assertNull( $oUtils->fromStaticCache( time() ) );
    }

    public function testCleanStaticCacheSpecific()
    {
        $oUtils = new oxutils();

        $sName1    = "SomeName";
        $mContent1 = "SomeContent";
        $sKey1     = "SomeKey";

        $sName2    = "SomeName2";
        $mContent2 = "SomeContent2";
        $sKey2     = "SomeKey2";

        $oUtils->toStaticCache( $sName1, $mContent1 );
        $oUtils->toStaticCache( $sName2, $mContent2 );
        $oUtils->cleanStaticCache($sName2);

        $this->assertEquals($mContent1, $oUtils->fromStaticCache($sName1));
        $this->assertEquals(null, $oUtils->fromStaticCache($mContent1));

    }

    public function testCleanStaticCacheFullClean()
    {

        $oUtils = new oxutils();

        $sName1    = "SomeName";
        $mContent1 = "SomeContent";
        $sKey1     = "SomeKey";

        $sName2    = "SomeName2";
        $mContent2 = "SomeContent2";
        $sKey2     = "SomeKey2";

        $oUtils->toStaticCache( $sName1, $mContent1 );
        $oUtils->toStaticCache( $sName2, $mContent2 );
        $oUtils->cleanStaticCache();

        $this->assertEquals(null, $oUtils->fromStaticCache($sName1));
        $this->assertEquals(null, $oUtils->fromStaticCache($sName2));
    }

    public function testToFileCacheFileCache()
    {
        $sName  = "testFileCache";
        $sInput = "test_test_test";

        $oUtils = new oxutils();
        $oUtils->toFileCache( $sName, $sInput);
        $this->assertEquals( $sInput, $oUtils->fromFileCache( $sName ) );
    }

    public function testToFileCacheFileCacheDoubleWrite1()
    {
        $sName1  = "testFileCache";
        $sName2  = "testFileCache2";
        $sInput1 = "test_test_test";
        $sInput2 = "test_test";

        $oUtils = new oxutils();
        $oUtils->toFileCache( $sName1, $sInput1);
        $oUtils->toFileCache( $sName2, $sInput2);
        $this->assertEquals( $sInput1, $oUtils->fromFileCache( $sName1 ) );
        $this->assertEquals( $sInput2, $oUtils->fromFileCache( $sName2 ) );
    }

    public function testToFileCacheFileCacheDoubleWrite2()
    {
        $sName1  = "testFileCache";
        $sName2  = "testFileCache2";
        $sInput1 = "test_test_test";
        $sInput2 = "test_test";

        $oUtils = new oxutils();
        $oUtils->toFileCache( $sName1, $sInput1);
        $this->assertEquals( $sInput1, $oUtils->fromFileCache( $sName1 ) );
        $oUtils->toFileCache( $sName2, $sInput2);
        $this->assertEquals( $sInput2, $oUtils->fromFileCache( $sName2 ) );
    }

    public function testToFileCacheFileCacheDoubleWrite3()
    {
        $sName1  = "testFileCache1";
        $sName2  = "testFileCache2";
        $sInput1 = "test_test_test";
        $sInput2 = "test_test";

        $oUtils = $this->getProxyClass('oxutils');
        $oUtils->toFileCache( $sName1, $sInput1);
        $oUtils->toFileCache( $sName2, $sInput2);
        $oUtils->commitFileCache();
        $this->assertEquals( $sInput1, $oUtils->fromFileCache( $sName1 ) );
        $this->assertEquals( $sInput2, $oUtils->fromFileCache( $sName2 ) );
    }


    public function testOxResetFileCache()
    {
        $myConfig = oxConfig::getInstance();
        $sName = "testFileCache";
        $sInput = "test_test_test";

        //getting cached files prefix
        $myUtilsTest = $this->getProxyClass("oxUtils");
        $sFilePath = $myUtilsTest->getCacheFilePath("test");
        $sCacheFilePrefix = preg_replace("/.*\/(ox[^_]*)_.*/", "$1", $sFilePath);

        $oUtils = oxUtils::getInstance();
        for ($iMax = 0; $iMax < 10; $iMax++) {
            $oUtils->toFileCache($sName."_".$iMax, $sInput."_".$iMax);
        }
        $oUtils->commitFileCache();

        //checking if test files were written to temp dir
        $sFilePath = $myConfig->getConfigParam( 'sCompileDir' ) . "/{$sCacheFilePrefix}_testFileCache*.txt";
        $aPathes   = glob( $sFilePath);
        $this->assertEquals( 10, count($aPathes), "Error writing test files to cache dir" );

        //actual test
        $this->assertNull( $oUtils->oxResetFileCache());

        $sFilePath = $myConfig->getConfigParam( 'sCompileDir' ) . "/{$sCacheFilePrefix}_testFileCache*.txt";
        $aPathes   = glob( $sFilePath);
        $this->assertTrue($aPathes == null);
    }

    public function testOxResetFileCacheSkipsTablesFieldNames()
    {
        $myConfig = oxConfig::getInstance();
        $sName = "testFileCache";
        $sInput = "test_test_test";

        //getting cached files prefix
        $myUtilsTest = $this->getProxyClass("oxUtils");
        $sFilePath = $myUtilsTest->getCacheFilePath("test");
        $sCacheFilePrefix = preg_replace("/.*\/(ox[^_]*)_.*/", "$1", $sFilePath);

        //this file must be skipped
        $oUtils = oxUtils::getInstance();
        $oUtils->toFileCache("fieldnames_testTest", "testCacheValue");
        $oUtils->commitFileCache();

        //checking if test file were written to temp dir
        $sFilePath = $myConfig->getConfigParam( 'sCompileDir' ) . "/{$sCacheFilePrefix}_fieldnames_testTest.txt";
        clearstatcache();
        $this->assertTrue( file_exists($sFilePath), "Error writing test files to cache dir" );

        for ($iMax = 0; $iMax < 10; $iMax++) {
            $oUtils->toFileCache($sName."_".$iMax, $sInput."_".$iMax);
        }
        $oUtils->commitFileCache();

        //checking if test files were written to temp dir
        $sFilePath = $myConfig->getConfigParam( 'sCompileDir' ) . "/{$sCacheFilePrefix}_testFileCache*.txt";
        $aPathes   = glob( $sFilePath);
        $this->assertEquals( 10, count($aPathes), "Error writing test files to cache dir: ".count($aPathes) );

        //actual test
        $this->assertNull( $oUtils->oxResetFileCache());

        $sFilePath = $myConfig->getConfigParam( 'sCompileDir' ) . "/{$sCacheFilePrefix}_fieldnames_testTest.txt";
        $aPathes   = glob( $sFilePath);

        @unlink( $aPathes[0] ); //deleting test cache file
        $this->assertEquals( 1, count($aPathes) );
    }

    public function testGetRemoteCachePath()
    {

        touch('misc/actions_main.inc.php', time(), time()) ;
        $this->assertEquals('misc/actions_main.inc.php', oxUtils::getInstance()->GetRemoteCachePath('http://www.blafoo.null', 'misc/actions_main.inc.php'));
        //ensure that file is older than 24h
        touch('misc/actions_main.inc.php', time() - 90000, time() - 90000) ;
        $this->assertEquals('misc/actions_main.inc.php', oxUtils::getInstance()->GetRemoteCachePath(oxConfig::getInstance()->getShopURL(), 'misc/actions_main.inc.php'));
        touch('misc/actions_main.inc.php', time() - 90000, time() - 90000) ;
        $this->assertEquals('misc/actions_main.inc.php', oxUtils::getInstance()->GetRemoteCachePath('http://www.blafoo.null', 'misc/actions_main.inc.php'));
        $this->assertEquals(false, oxUtils::getInstance()->GetRemoteCachePath('http://www.blafoo.null', 'misc/blafoo.test'));
    }

    public function testCheckAccessRights()
    {

        $mySession = oxSession::getInstance();
        $backUpAuth = $mySession->getVar( "auth");

        $mySession->setVar( "auth", "oxdefaultadmin");
        $this->assertEquals(true, oxUtils::getInstance()->checkAccessRights());

        //  self::$test_sql_used = null;
        modDB::getInstance()->addClassFunction('getOne', create_function('$sql', 'return 1;'));

        $mySession->setVar( "auth", "oxdefaultadmin");
        $this->assertEquals(true, oxUtils::getInstance()->checkAccessRights());
        $mySession->setVar( "auth", "blafooUser");


        //self::$test_sql_used = null;
        modDB::getInstance()->addClassFunction('getOne', create_function('$sql', 'return 0;'));

        $this->assertEquals(false, oxUtils::getInstance()->checkAccessRights());

        $mySession->setVar( "auth", $backUpAuth);
        modDB::getInstance()->cleanup();
    }

    public function testCheckAccessRightsChecksSubshopAdminShop()
    {

        $mySession = oxSession::getInstance();
        $backUpAuth = $mySession->getVar( "auth");

        $e = null;
        try {
            modDB::getInstance()->addClassFunction('getOne', create_function('$sql', 'return 1;'));
            $mySession->setVar( "auth", "blafooUser");
            $this->assertEquals(true, oxUtils::getInstance()->checkAccessRights());
            modConfig::setParameter('fnc', 'chshp');
            $this->assertEquals(false, oxUtils::getInstance()->checkAccessRights());
            modConfig::setParameter('fnc', null);
            $this->assertEquals(true, oxUtils::getInstance()->checkAccessRights());

            modConfig::setParameter('actshop', 1);
            $this->assertEquals(true, oxUtils::getInstance()->checkAccessRights());
            modConfig::setParameter('actshop', 2);
            $this->assertEquals(false, oxUtils::getInstance()->checkAccessRights());
            modConfig::setParameter('actshop', null);
            $this->assertEquals(true, oxUtils::getInstance()->checkAccessRights());

            modConfig::setParameter('shp', 1);
            $this->assertEquals(true, oxUtils::getInstance()->checkAccessRights());
            modConfig::setParameter('shp', 2);
            $this->assertEquals(false, oxUtils::getInstance()->checkAccessRights());
            modConfig::setParameter('shp', null);
            $this->assertEquals(true, oxUtils::getInstance()->checkAccessRights());

            modConfig::setParameter('currentadminshop', 1);
            $this->assertEquals(true, oxUtils::getInstance()->checkAccessRights());
            modConfig::setParameter('currentadminshop', 2);
            $this->assertEquals(false, oxUtils::getInstance()->checkAccessRights());
            modConfig::setParameter('currentadminshop', null);
            $this->assertEquals(true, oxUtils::getInstance()->checkAccessRights());
        } catch (Exception  $e) {

        }


        $mySession->setVar( "auth", $backUpAuth);
        modDB::getInstance()->cleanup();


        if ($e) {
            throw $e;
        }
    }

    public function testGetShopBit()
    {

        // create an array with corresponding test data (not all just a random mix)
        $aArray = array(   0 => '0',
                           1 => '1',
                           2 => '2',
                           3 => '4',
                           4 => '8',
                           5=> '16',
                           6 => '32',
                           7 => '64',
                           39 => '274877906944',
                           52 => '2251799813685248',
                           53 => '4503599627370496',
                           62 => '2305843009213693952',
                           63 => '4611686018427387904',
                           64 => '9223372036854775808',
                           65 => '0',
                           66 => '0',
                           100 => '0');

        foreach ($aArray as $key => $value) {
            //echo "\n".$key." => '".$value."', ";
            $this->assertEquals(oxUtils::getInstance()->getShopBit($key), $value);
        }
    }

    public function testBitwiseAnd()
    {

        for ($iCountA = 2147483645; $iCountA <= 2147483647; $iCountA++) {
            for ($iCountB = 2147483645; $iCountB <= 2147483647; $iCountB++) {
                $this->assertEquals(oxUtils::getInstance()->bitwiseAnd($iCountA, $iCountB), ($iCountA & $iCountB));
            }
        }
    }

    public function testBitwiseOr()
    {

        for ($iCountA = 2147483645; $iCountA <= 2147483647; $iCountA++) {
            for ($iCountB = 2147483645; $iCountB <= 2147483647; $iCountB++) {
                $this->assertEquals(oxUtils::getInstance()->bitwiseOr($iCountA, $iCountB), ($iCountA | $iCountB));
            }
        }
    }

    public function testIsValidAlpha()
    {

        $this->assertEquals(true, oxUtils::getInstance()->isValidAlpha('oxid'));
        $this->assertEquals(true, oxUtils::getInstance()->isValidAlpha('oxid1'));
        $this->assertEquals(false, oxUtils::getInstance()->isValidAlpha('oxid.'));
        $this->assertEquals(false, oxUtils::getInstance()->isValidAlpha('oxid{'));
        $this->assertEquals(true, oxUtils::getInstance()->isValidAlpha('oxi_d'));
        $this->assertEquals(false, oxUtils::getInstance()->isValidAlpha('ox\\id'));
    }

    public function testAddUrlParameters()
    {
        $oUtils = new oxUtils();

        $sURL = 'http://www.url.com';
        $aParams = array('string' => 'someString', 'bool1' => false, 'bool2' => true, 'int' => 1234, 'float' => 123.45, 'negfloat' => -123.45);

        $sReturnURL = "http://www.url.com?string=someString&bool1=&bool2=1&int=1234&float=123.45&negfloat=-123.45";
        $this->assertEquals( $sReturnURL, $oUtils->UNITaddUrlParameters( $sURL, $aParams ) );

        $sURL = 'http://www.url.com/index.php?cl=aaa';
        $sReturnURL = "http://www.url.com/index.php?cl=aaa&string=someString&bool1=&bool2=1&int=1234&float=123.45&negfloat=-123.45";
        $this->assertEquals( $sReturnURL, $oUtils->UNITaddUrlParameters( $sURL, $aParams ) );

    }

    public function testOxMimeContentType()
    {
        $oUtils = new oxUtils();
        $sFile = 'asdnasd/asdasd.asd.ad.ad.asd.gif';
        $this->assertEquals('image/gif', $oUtils->oxMimeContentType( $sFile ) );

        $sFile = 'asdnasd/asdasd.asd.ad.ad.asd.jpeg';
        $this->assertEquals('image/jpeg', $oUtils->oxMimeContentType( $sFile ) );

        $sFile = 'asdnasd/asdasd.asd.ad.ad.asd.jpg';
        $this->assertEquals('image/jpeg', $oUtils->oxMimeContentType( $sFile ) );

        $sFile = 'asdnasd/asdasd.asd.ad.ad.asd.png';
        $this->assertEquals('image/png', $oUtils->oxMimeContentType( $sFile ) );

        $sFile = 'asdnasd/asdasd.asd.ad.ad.asdjpeg';
        $this->assertEquals( false, $oUtils->oxMimeContentType( $sFile ) );
        $this->assertEquals( false, $oUtils->oxMimeContentType( '' ) );
    }

    public function testStripQuotes()
    {
        $myUtilsTest = $this->getProxyClass("oxUtils"); //new testOxUtils();

        $test = array('a\\\"a', "b\\b", 'cc');
        $r = $myUtilsTest->UNITstripQuotes($test);
        $this->assertEquals( 'a\"a', $r[0]);
        $this->assertEquals( "bb", $r[1]);
        $this->assertEquals( 'cc', $r[2]);
    }

    public function testStrManStrRem()
    {
        $sTests = "myblaaFooString!";
        $sKey = "oxid987654321";
        $oUtils = new oxUtils();

        $sCode = $oUtils->strMan( $sTests, $sKey );
        $this->assertNotEquals( $sTests, $sCode );

        $sCode = $oUtils->strRem( $sCode, $sKey );
        $this->assertEquals( $sCode, $sTests );

        $sCode = $oUtils->strMan( $sTests );
        $this->assertNotEquals( $sTests, $sCode );

        $sCode = $oUtils->strRem( $sCode );
        $this->assertEquals( $sTests, $sCode );
    }

    public function testStrRot13()
    {
        $sTests = "myblaaFooString!";
        $sCode = oxUtils::getInstance()->strRot13($sTests);
        $this->assertEquals($sCode, "zloynnSbbFgevat!");
    }

    public function testRedirect()
    {
        $oSession = $this->getMock( 'oxsession', array( 'freeze' ) );
        $oSession->expects( $this->once() )->method( 'freeze');

        $oUtils = $this->getMock( 'oxutils', array( '_simpleRedirect', 'getSession' ) );
        $oUtils->expects( $this->once() )->method( '_simpleRedirect')->with( $this->equalTo( 'url?redirected=1' ) );
        $oUtils->expects( $this->once() )->method( 'getSession')->will( $this->returnValue( $oSession ) );
        $oUtils->redirect( 'url' );
    }

    public function testRedirectCodes()
    {
        $oSession = $this->getMock( 'oxsession', array( 'freeze' ) );
        $oSession->expects( $this->any() )->method( 'freeze');

        $oUtils = $this->getMock( 'oxutils', array( '_simpleRedirect', 'getSession' ) );
        $oUtils->expects( $this->once() )->method( '_simpleRedirect')->with( $this->equalTo( 'url' ), $this->equalTo( 'HTTP/1.1 301 Moved Permanently' ) );
        $oUtils->expects( $this->once() )->method( 'getSession')->will( $this->returnValue( $oSession ) );
        $oUtils->redirect( 'url', false, 301 );

        $oUtils = $this->getMock( 'oxutils', array( '_simpleRedirect', 'getSession' ) );
        $oUtils->expects( $this->once() )->method( '_simpleRedirect')->with( $this->equalTo( 'url' ), $this->equalTo( 'HTTP/1.1 302 Found' ) );
        $oUtils->expects( $this->once() )->method( 'getSession')->will( $this->returnValue( $oSession ) );
        $oUtils->redirect( 'url', false, 302 );

        // test also any other to redirect only temporary
        $oUtils = $this->getMock( 'oxutils', array( '_simpleRedirect', 'getSession' ) );
        $oUtils->expects( $this->once() )->method( '_simpleRedirect')->with( $this->equalTo( 'url' ), $this->equalTo( 'HTTP/1.1 302 Found' ) );
        $oUtils->expects( $this->once() )->method( 'getSession')->will( $this->returnValue( $oSession ) );
        $oUtils->redirect( 'url', false, 302324 );

    }

    public function testReRedirect()
    {
        modConfig::setParameter( 'redirected', '1' );

        $oUtils = $this->getMock( 'oxutils', array( '_simpleRedirect', '_addUrlParameters', 'getSession' ) );
        $oUtils->expects( $this->never() )->method( '_simpleRedirect');
        $oUtils->expects( $this->never() )->method( '_addUrlParameters');
        $oUtils->expects( $this->never() )->method( 'getSession');
        $oUtils->redirect( 'url' );

    }

    public function testRedirectWithEncodedEntities()
    {
        $oUtils = $this->getMock( 'oxutils', array( '_simpleRedirect' ) );
        $oUtils->expects( $this->once() )->method( '_simpleRedirect')->with( $this->equalTo( 'url?param1=1&param2=2&param3=3&redirected=1' ) );
        $oUtils->redirect( 'url?param1=1&param2=2&amp;param3=3' );
    }

    public function testFromFileCacheEmpty()
    {
        $oUtils = new oxutils();
        $sCacheHit = $oUtils->fromFileCache( "notexistantkey");
        $this->assertFalse( $sCacheHit === false);
        $this->assertNull( $sCacheHit);
    }

    public function testCheckUrlEndingSlash()
    {
        $oUtils = new oxutils();
        $this->assertEquals( "http://www.site.de/", $oUtils->checkUrlEndingSlash("http://www.site.de/") );
        $this->assertEquals( "http://www.site.de/", $oUtils->checkUrlEndingSlash("http://www.site.de") );
    }

    public function testCacheRaceConditions0Size()
    {
        $oUtils = new oxutils();
        $sFileName = $oUtils->getCacheFilePath('testCache1');
        @unlink($sFileName);
        $oUtils->toFileCache('testCache1', 'teststs');
        $oUtils->commitFileCache();
        $this->assertEquals( serialize('teststs'), file_get_contents($sFileName) );
        unlink($sFileName);
    }

    public function testCacheRaceConditionsNon0Size()
    {
        $oUtils = new oxutils();
        $sFileName = $oUtils->getCacheFilePath('testCache2');
        @unlink($sFileName);
        $oUtils->toFileCache('testCache2', 'teststs');
        $oUtils->commitFileCache();
        $sFileContents = file_get_contents($sFileName);
        $this->assertEquals(serialize('teststs'), $sFileContents);
        unlink($sFileName);
    }

    public function testCacheRaceConditionsIgnoredBySisterProcess()
    {
        $oUtils1 = new oxutils();
        $oUtils2 = new oxutils();
        $sFileName = $oUtils1->getCacheFilePath('testCache3');
        @unlink($sFileName);
        $oUtils1->toFileCache('testCache3', 'instance1111');
        $oUtils2->toFileCache('testCache3', 'instance2222');
        $oUtils1->commitFileCache();
        $oUtils2->commitFileCache();
        $sFileContents = file_get_contents($sFileName);
        $this->assertEquals(serialize('instance1111'), $sFileContents);
        unlink($sFileName);
    }
    public function testCachingLockRelease()
    {
        clearstatcache();
        $oUtils1 = new oxutils();
        $sFileName = $oUtils1->getCacheFilePath('testCache3');
        @unlink($sFileName);
        $this->assertFalse(file_exists($sFileName));

        $oUtils1->toFileCache('testCache3', 'instance1111');
        clearstatcache();
        $this->assertTrue(file_exists($sFileName));
        $this->assertEquals(0, filesize($sFileName));

        $oUtils1->commitFileCache();
        clearstatcache();
        $this->assertEquals(serialize('instance1111'), file_get_contents($sFileName));
        $this->assertNotEquals(0, filesize($sFileName));

        $oUtils2 = new oxutils();
        $oUtils2->toFileCache('testCache3', 'instance2222');
        clearstatcache();
        $this->assertTrue(file_exists($sFileName));
        $this->assertEquals(0, filesize($sFileName));

        $oUtils2->commitFileCache();
        clearstatcache();
        $this->assertEquals(serialize('instance2222'), file_get_contents($sFileName));
        $this->assertNotEquals(0, filesize($sFileName));

        unlink($sFileName);
    }

    /**
     *
     */
    public function testCanPreview()
    {
        modConfig::setParameter( "preview", null );
        $oUtils = new oxUtils();
        $this->assertNull( $oUtils->canPreview() );

        modConfig::setParameter( "preview", "132" );
        oxTestModules::addFunction( 'oxUtilsServer', 'getOxCookie', '{ return "123"; }');
        $this->assertFalse( $oUtils->canPreview() );

        $oUser = new oxUser();
        $oUser->load( "oxdefaultadmin" );

        $oUtils = $this->getMock( "oxUtils", array( "getUser" ) );
        $oUtils->expects( $this->any() )->method("getUser")->will( $this->returnValue( $oUser ) );

        modConfig::setParameter( "preview", $oUtils->getPreviewId() );
        oxTestModules::addFunction( 'oxUtilsServer', 'getOxCookie', '{ return "123"; }');

        $this->assertTrue( $oUtils->canPreview() );
    }

    /**
     * oxUtils::getPreviewId() test case
     *
     * @return null
     */
    public function testGetPreviewId()
    {

        $sAdminSid = oxUtilsServer::getInstance()->getOxCookie( 'admin_sid' );
        $sCompare = md5( $sAdminSid . "testID" . "testPass" . "tesrRights" );

        $oUser = $this->getMock( "oxUser", array( "getId" ) );
        $oUser->expects( $this->once() )->method("getId")->will( $this->returnValue( "testID" ) );
        $oUser->oxuser__oxpassword = new oxField( "testPass" );
        $oUser->oxuser__oxrights   = new oxField( "tesrRights" );

        $oUtils = $this->getMock( "oxUtils", array( "getUser" ) );
        $oUtils->expects( $this->once() )->method("getUser")->will( $this->returnValue( $oUser ) );

        $this->assertEquals( $sCompare, $oUtils->getPreviewId() );
    }

    public function testHandlePageNotFoundError()
    {
        oxTestModules::addFunction('oxutils', 'showMessageAndExit', '{$this->showMessageAndExitCall[] = $aA; }');
        oxTestModules::addFunction('oxutils', 'setHeader', '{$this->setHeaderCall[] = $aA;}');
        oxTestModules::addFunction('oxUtilsView', 'getTemplateOutput', '{$this->getTemplateOutputCall[] = $aA; return "msg_".count($this->getTemplateOutputCall);}');

        oxUtils::getInstance()->handlePageNotFoundError();
        $this->assertEquals(1, count(oxUtils::getInstance()->setHeaderCall));
        $this->assertEquals(1, count(oxUtilsView::getInstance()->getTemplateOutputCall));
        $this->assertEquals(1, count(oxUtils::getInstance()->showMessageAndExitCall));
        $this->assertEquals("msg_1", oxUtils::getInstance()->showMessageAndExitCall[0][0]);
        $this->assertEquals("HTTP/1.0 404 Not Found", oxUtils::getInstance()->setHeaderCall[0][0]);

        oxUtils::getInstance()->handlePageNotFoundError("url aa");
        $this->assertEquals(2, count(oxUtils::getInstance()->setHeaderCall));
        $this->assertEquals(2, count(oxUtilsView::getInstance()->getTemplateOutputCall));
        $this->assertEquals(2, count(oxUtils::getInstance()->showMessageAndExitCall));
        $this->assertEquals("msg_2", oxUtils::getInstance()->showMessageAndExitCall[1][0]);
        $this->assertEquals("HTTP/1.0 404 Not Found", oxUtils::getInstance()->setHeaderCall[1][0]);

        oxTestModules::addFunction('oxUBase', 'render', '{throw new Exception();}');

        oxUtils::getInstance()->handlePageNotFoundError("url aa");
        $this->assertEquals(1, count(oxUtils::getInstance()->setHeaderCall));
        $this->assertEquals(0, count(oxUtilsView::getInstance()->getTemplateOutputCall));
        $this->assertEquals(1, count(oxUtils::getInstance()->showMessageAndExitCall));
        $this->assertEquals("Page not found.", oxUtils::getInstance()->showMessageAndExitCall[0][0]);
    }

    public function testToPhpFileCache()
    {
        $sTestArray = array("testVal1", "key1" => "testVal2");

        $oUtils = oxUtils::getInstance();
        $oUtils->toPhpFileCache("testVal", $sTestArray);
        $oUtils->commitFileCache();

        $sFileName = oxUtils::getInstance()->getCacheFilePath("testVal", false, 'php');

        include( $sFileName );

        $this->assertEquals($_aCacheContents, $sTestArray);
        unlink( $sFileName );
    }

    /**
     * Test for bug #1737
     *
     */
    public function testToPhpFileCacheException()
    {
        $oSubj = $this->getMock("oxUtils", array("getCacheFilePath"));
        $oSubj->expects($this->any())->method("getCacheFilePath")->will($this->returnValue(false));

        modInstances::addMod("oxUtils", $oSubj);

        $sTestArray = array("testVal1", "key1" => "testVal2");
        oxUtils::getInstance()->toPhpFileCache("testVal2", $sTestArray);
        $aCacheContents = oxUtils::getInstance()->fromPhpFileCache("testVal2");

        $this->assertNull($aCacheContents);


    }

    public function testFromPhpFileCache()
    {
        $sTestArray = array("testVal1", "key1" => "testVal2");

        $oUtils = oxUtils::getInstance();
        $oUtils->toPhpFileCache( "testVal", $sTestArray );
        $oUtils->commitFileCache();

        $this->assertEquals( $oUtils->fromPhpFileCache( "testVal" ), $sTestArray );
    }

    /**
     * oxUtils::getCacheMeta() & oxUtils::setCacheMeta() test case
     *
     * @return null
     */
    public function testGetCacheMetaSetCacheMeta()
    {
        $oUtils = new oxUtils();
        $oUtils->setCacheMeta( "xxx", "yyy" );

        $this->assertFalse( $oUtils->getCacheMeta( "yyy" ) );
        $this->assertEquals( "yyy", $oUtils->getCacheMeta( "xxx" ) );
    }

    /**
     * oxUtils::_readFile() test case
     *
     * @return null
     */
    public function testReadFile()
    {
        $sFilePath = oxUtils::getInstance()->getCacheFilePath("testVal", false, 'php');
        if ( ( $hFile = @fopen( $sFilePath, "w" ) ) !== false ) {
            fwrite( $hFile, serialize( "test" ) );
            fclose( $hFile );

            $oUtils = new oxUtils();
            $this->assertEquals( "test", $oUtils->UNITreadFile( $sFilePath ) );

            return;
        }

        $this->markTestSkipped( "Unable to create file {$sFilePath}" );
    }

    /**
     * oxUtils::_includeFile() test case
     *
     * @return null
     */
    public function testIncludeFile()
    {
        $sFilePath = oxUtils::getInstance()->getCacheFilePath("testVal", false, 'php');
        if ( ( $hFile = @fopen( $sFilePath, "w" ) ) !== false ) {
            fwrite( $hFile, '<?php $_aCacheContents = "test123";' );
            fclose( $hFile );

            $oUtils = new oxUtils();
            $this->assertEquals( "test123", $oUtils->UNITincludeFile( $sFilePath ) );

            return;
        }

        $this->markTestSkipped( "Unable to create file {$sFilePath}" );
    }

    /**
     * oxUtils::_processCache() test case
     *
     * @return null
     */
    public function testProcessCache()
    {
        $oUtils = $this->getMock( "oxutils", array( "getCacheMeta" ) );
        $oUtils->expects( $this->at( 0 ) )->method( 'getCacheMeta')->will( $this->returnValue( false ) );
        $oUtils->expects( $this->at( 1 ) )->method( 'getCacheMeta')->will( $this->returnValue( array( "serialize" => false ) ) );

        $this->assertEquals( serialize( 123 ), $oUtils->UNITprocessCache( 123, 123 ) );
        $this->assertNotEquals( serialize( 123 ), $oUtils->UNITprocessCache( 123, 123 ) );
    }
}
