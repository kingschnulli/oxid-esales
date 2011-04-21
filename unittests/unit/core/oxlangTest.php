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
 * @version   SVN: $Id: oxlangTest.php 34014 2011-03-25 14:06:07Z sarunas $
 */

require_once realpath( "." ).'/unit/OxidTestCase.php';
require_once realpath( "." ).'/unit/test_config.inc.php';

/*
class oxConfig_for_Unit_oxLangTest extends oxconfig
{
    public function __construct( $iLang )
    {
        $this->_iLang = $iLang;
    }
    public function getShopLanguage()
    {
        return $this->_iLang;
    }
}
*/

class Unit_Core_oxLangTest extends OxidTestCase
{

    /**
     * Initialize the fixture.
     *
     * @return null
     */
    protected function setUp()
    {
        parent::setUp();

        // cleanup
        oxUtils::getInstance()->oxResetFileCache();

        modConfig::getInstance();
        modSession::getInstance();
    }

    /**
     * Tear down the fixture.
     *
     * @return null
     */
    protected function tearDown()
    {
        // cleanup
        oxUtils::getInstance()->oxResetFileCache();

        modConfig::getInstance()->cleanup();
        modSession::getInstance()->cleanup();

        $sFileName = getShopBasePath()."/out/azure/de/my_lang.php";
        if ( file_exists( $sFileName ) ) {
            unlink ($sFileName);
        }

        parent::tearDown();
    }

    private function _getLangArray( $sLang, $sTema )
    {
        $sFileName = getShopBasePath()."out/".$sTema."/".$sLang."/cust_lang.php";
        include $sFileName;
        return $aLang;
    }

    /**
     * Tests oxLang::processUrl()
     *
     * @return null
     */
    public function testProcessUrl()
    {
        $myConfig = oxConfig::getInstance();

        $iDefL = $myConfig->getConfigParam( 'sDefaultLang' );
        $oLang = new oxLang();
        $this->assertEquals( "url", $oLang->processUrl( "url",  $iDefL) );
        $this->assertEquals( "url?lang=9&amp;", $oLang->processUrl( "url", 9 ) );
        $this->assertEquals( "url?lang=9&amp;", $oLang->processUrl( "url?", 9 ) );
        $this->assertEquals( "url?lang=$iDefL&amp;", $oLang->processUrl( "url?lang=15&amp;", $iDefL ) );
        $this->assertEquals( "url?lang=9", $oLang->processUrl( "url?lang=3", 9 ) );

        $this->assertEquals( "url?x&amp;lang=9&amp;", $oLang->processUrl( "url?x&amp;", 9 ) );
        $this->assertEquals( "url?x&amp;", $oLang->processUrl( "url?x&amp;", $iDefL ) );
        $this->assertEquals( "url?x&amp;lang=9", $oLang->processUrl( "url?x&amp;lang=3", 9 ) );
        $this->assertEquals( "url?x&amp;lang=$iDefL&amp;", $oLang->processUrl( "url?x&amp;lang=5&amp;", $iDefL ) );

    }

    /**
     * Tests oxLang::getName()
     *
     * @return null
     */
    public function testGetName()
    {
        $oLang = new oxLang();
        $this->assertEquals( "lang", $oLang->getName() );
    }

    /**
     * Tests oxLang::getFormLang()
     *
     * @return null
     */
    public function testGetFormLang()
    {
        $sFormLang = "<input type=\"hidden\" name=\"lang\" value=\"9\">";

        $oLang = $this->getMock( "oxLang", array( "getBaseLanguage" ));
        $oLang->expects( $this->any() )->method( 'getBaseLanguage' )->will( $this->returnValue( 9 ) );
        $this->assertEquals( $sFormLang, $oLang->getFormLang() );
    }

    /**
     * Tests oxLang::getUrlLang()
     *
     * @return null
     */
    public function testgetUrlLang()
    {
        $sUrlLang = "lang=9";

        $oLang = $this->getMock( "oxLang", array( "getBaseLanguage" ));
        $oLang->expects( $this->any() )->method( 'getBaseLanguage' )->will( $this->returnValue( 9 ) );
        $this->assertEquals( $sUrlLang, $oLang->getUrlLang() );
    }

    public function testGetLangFilesPathArrayCustom()
    {
        $sPath = oxConfig::getInstance()->getStdLanguagePath( "", false, 0 );
        $aPathArray = array( $sPath . "lang.php", $sPath . "cust_lang.php" );

        $oConfig = $this->getMock( "oxConfig", array( "getStdLanguagePath", "getLanguagePath" ) );
        $oConfig->expects( $this->any() )->method( 'getStdLanguagePath' )->will( $this->returnValue( false ) );
        $oConfig->expects( $this->any() )->method( 'getLanguagePath' )->will( $this->returnValue( $sPath ) );

        $oLang = $this->getMock( "oxLang", array( "getConfig") );
        $oLang->expects( $this->any() )->method( 'getConfig' )->will( $this->returnValue( $oConfig ) );
        $this->assertEquals( $aPathArray, $oLang->UNITgetLangFilesPathArray( false, 0 ) );
    }

    public function testGetLangFilesPathForModules()
    {
        $sMdir = realpath((dirname(__FILE__).'/../moduleTestBlock'));

        $sPath = oxConfig::getInstance()->getStdLanguagePath( "", false, 0 );
        $aPathArray = array( $sPath . "lang.php", $sPath . "cust_lang.php", "$sMdir/modules/test1/out/lang/de/test_lang.php" );

        $oConfig = $this->getMock( "oxConfig", array( "getStdLanguagePath", "getLanguagePath" ) );
        $oConfig->expects( $this->any() )->method( 'getStdLanguagePath' )->will( $this->returnValue( false ) );
        $oConfig->expects( $this->any() )->method( 'getLanguagePath' )->will( $this->returnValue( $sPath ) );

        $oLang = $this->getMock( "oxLang", array( "getConfig") );
        $oLang->expects( $this->any() )->method( 'getConfig' )->will( $this->returnValue( $oConfig ) );

        overrideGetShopBasePath($sMdir);

        $this->assertEquals( $aPathArray, $oLang->UNITgetLangFilesPathArray( false, 0 ) );
    }

    public function testGetLangFileCacheName()
    {
        $myConfig = oxConfig::getInstance();
        $sCacheName = "langcache_1_1_".$myConfig->getShopId()."_".$myConfig->getConfigParam( 'sTheme' ).'_default';

        $oLang = new oxLang();
        $this->assertEquals( $sCacheName, $oLang->UNITgetLangFileCacheName( true, 1 ) );

        $sCacheName = "langcache_1_1_".$myConfig->getShopId()."_".$myConfig->getConfigParam( 'sTheme' ).'_9fe20164bd4aeab975137aae7f30a1ce';
        $this->assertEquals( $sCacheName, $oLang->UNITgetLangFileCacheName( true, 1, array('asdasd', 'dasasd') ) );

    }

    public function testGetLanguageFileData()
    {
        oxTestModules::addFunction( "oxUtils", "getLangCache", "{}" );
        oxTestModules::addFunction( "oxUtils", "setLangCache", "{}" );

        $sFilePrefix = md5( uniqid( rand(), true ) );

        //writing a test lang file
        $sFilePath = oxConfig::getInstance()->getConfigParam( 'sCompileDir' );
        file_put_contents( $sFilePath . "/baselang$sFilePrefix.txt", '<?php $aLang = array( "charset" => "baseCharset", "TESTKEY" => "baseVal");' );
        file_put_contents( $sFilePath . "/testlang$sFilePrefix.txt", '<?php $aLang = array( "charset" => "testCharset", "TESTKEY" => "testVal");' );

        $aLangFilesPath = array( $sFilePath . "/baselang$sFilePrefix.txt", $sFilePath . "/testlang$sFilePrefix.txt" );

        $aResult = array( "charset" => "baseCharset", "TESTKEY" => "testVal" );

        $oLang = $this->getMock( "oxlang", array( "_getLangFilesPathArray", "_recodeLangArray" ) );
        $oLang->expects( $this->any() )->method( '_getLangFilesPathArray' )->will( $this->returnValue( $aLangFilesPath ) );
        $oLang->expects( $this->never() )->method( '_recodeLangArray' );
        $oLangFilesData = $oLang->UNITgetLanguageFileData( false, 0 );

        $this->assertEquals( $aResult, $oLangFilesData );
    }

    public function testGetLanguageFileDataUtf()
    {
        oxTestModules::addFunction( "oxUtils", "getLangCache", "{}" );
        oxTestModules::addFunction( "oxUtils", "setLangCache", "{}" );

        $sFilePrefix = md5( uniqid( rand(), true ) );

        //writing a test lang file
        $sFilePath = oxConfig::getInstance()->getConfigParam( 'sCompileDir' );
        file_put_contents( $sFilePath . "/baselang$sFilePrefix.txt", '<?php $aLang = array( "charset" => "baseCharset", "TESTKEY" => "baseVal");' );
        file_put_contents( $sFilePath . "/testlang$sFilePrefix.txt", '<?php $aLang = array( "charset" => "testCharset", "TESTKEY" => "testVal");' );

        $aLangFilesPath = array( $sFilePath . "/baselang$sFilePrefix.txt", $sFilePath . "/testlang$sFilePrefix.txt" );

        $aResult = array( "charset" => "UTF-8", "TESTKEY" => "testVal" );

        $oConfig = $this->getMock( "oxConfig", array( "isUtf" ) );
        $oConfig->expects( $this->any() )->method( 'isUtf' )->will( $this->returnValue( true ) );

        $oLang = $this->getMock( "oxlang", array( '_getLangFileCacheName', "_getLangFilesPathArray", "_recodeLangArray", "getConfig" ) );
        $oLang->expects( $this->any() )->method( '_getLangFileCacheName' )->will( $this->returnValue( false ) );
        $oLang->expects( $this->any() )->method( '_getLangFilesPathArray' )->will( $this->returnValue( $aLangFilesPath ) );
        $oLang->expects( $this->atLeastOnce() )->method( '_recodeLangArray' )->will( $this->returnValue( $aResult ) );
        $oLang->expects( $this->any() )->method( 'getConfig' )->will( $this->returnValue( $oConfig ) );
        $oLangFilesData = $oLang->UNITgetLanguageFileData( false, 0 );

        $this->assertEquals( $aResult, $oLangFilesData );
    }

    public function testRecodeLangArray()
    {
        $aLang['ACCOUNT_MAIN_BACKTOSHOP'] = "Zur�ck zum Shop";
        $aRecoded['ACCOUNT_MAIN_BACKTOSHOP'] = iconv( 'ISO-8859-15', 'UTF-8', $aLang['ACCOUNT_MAIN_BACKTOSHOP'] );

        $oLang = new oxLang();
        $aResult = $oLang->UNITrecodeLangArray( $aLang, 'ISO-8859-15' );
        $this->assertNotEquals( $aLang, $aResult );
        $this->assertEquals( $aRecoded, $aResult );
    }

    public function testTranslateStringWithGeneratedLangFile()
    {
        $oLang = new oxlang();

        $sVersionPrefix = 'ee';
            $sVersionPrefix = 'pe';

        $sVal = iconv( 'ISO-8859-15', 'UTF-8', "Zur�ck zum Shop" );
        $myConfig = oxConfig::getInstance();
        $sCacheName = "langcache_1_1_".$myConfig->getShopId()."_".$myConfig->getConfigParam( 'sTheme' ).'_default';

        //writing a test file
        $sFileName = oxConfig::getInstance()->getConfigParam( 'sCompileDir' ) . "/ox{$sVersionPrefix}c_{$sCacheName}.txt";
        $sFileContents = '<?php $aLangCache = array( "ACCOUNT_MAIN_BACKTOSHOP" => "'.$sVal.'");';
        file_put_contents( $sFileName, $sFileContents );

        $this->assertEquals( $sVal, $oLang->translateString( "ACCOUNT_MAIN_BACKTOSHOP", 1, 1 ) );
    }

    /**
     * test if loads aAdditionalLangFiles
     *
     * @return null
     */
    public function testTranslateStringWithAdditionalLangFiles()
    {
        $oLang = $this->getMock('oxlang', array('_getLangTranslationArray'));
        $oLang->registerAdditionalLangFile(__FILE__);
        $oLang->expects($this->at(0))->method('_getLangTranslationArray')
                ->with($this->equalTo(3), $this->equalTo(4))
                ->will($this->returnValue(array()));
        $oLang->expects($this->at(1))->method('_getLangTranslationArray')
                ->with($this->equalTo(3), $this->equalTo(4), $this->equalTo(array(__FILE__)))
                ->will($this->returnValue(array('asd'=>'ok')));
        $this->assertEquals('ok', $oLang->translateString('asd', 3, 4));
    }

    /**
     * Testing vat formatting functionality
     */
    public function testFormatVat()
    {
        $oCur = new oxstdclass();
        $oCur->decimal  = 2;
        $oCur->dec      = '.';
        $oCur->thousand = '';

        $oLang = oxLang::getInstance();
        $this->assertEquals( '18', $oLang->formatVat( 18.00 ) );
        $this->assertEquals( '21,5', $oLang->formatVat( 21.50 ) );
        $this->assertEquals( '1,5', $oLang->formatVat( 1.50 ) );
        $this->assertEquals( '21.5', $oLang->formatVat( 21.50, $oCur ) );
    }

    /**
     * Testing string translation function
     */
    // in admin mode
    public function testTranslateStringIsAdmin()
    {
        $oLang = $this->getMock( 'oxlang', array( 'isAdmin' ) );
        $oLang->expects( $this->any() )->method( 'isAdmin' )->will( $this->returnValue( true ) );

        $this->assertEquals( 'Aktiv', $oLang->translateString( "GENERAL_ACTIVE", 0 ) );
        $this->assertEquals( 'Active', $oLang->translateString( "GENERAL_ACTIVE", 1 ) );

        $this->assertEquals( 'Falsche E-Mail oder Passwort!', $oLang->translateString( "EXCEPTION_USER_NOVALIDLOGIN", 0 ) );
        $this->assertEquals( 'Wrong e-Mail or password!', $oLang->translateString( "EXCEPTION_USER_NOVALIDLOGIN", 1 ) );

        $this->assertEquals( 'blafoowashere123', $oLang->translateString( "blafoowashere123" ) );
        $this->assertEquals( '', $oLang->translateString( "" ) );
        $this->assertEquals( '\/�[]~�#-', $oLang->translateString("\/�[]~�#-" ) );
    }
    // in non amdin mode
    public function testTranslateStringIsNotAdmin()
    {
        $oLang = $this->getMock( 'oxlang', array( 'isAdmin' ) );
        $oLang->expects( $this->any() )->method( 'isAdmin' )->will( $this->returnValue( false ) );


        $this->assertEquals( 'blafoowashere123', $oLang->translateString( "blafoowashere123" ) );
        $this->assertEquals( '', $oLang->translateString( "" ) );
        $this->assertEquals( '\/�[]~�#-', $oLang->translateString("\/�[]~�#-" ) );
    }

    public function testFormatCurrency()
    {
        $oLang = new oxLang();

        // using default curr
        $sFormatted = $oLang->formatCurrency( 10322.324 );
        $this->assertEquals( $sFormatted, '10.322,32' );

        // using default curr by passing it
        $oActCur = oxConfig::getInstance()->getActShopCurrencyObject();
        $sFormatted = $oLang->formatCurrency( 10322.324, $oActCur );
        $this->assertEquals( $sFormatted, '10.322,32' );

        // using simulated curr
        $oActCur = new Oxstdclass();
        $oActCur->decimal  = 3;
        $oActCur->dec      = '~';
        $oActCur->thousand = '#';

        $sFormatted = $oLang->formatCurrency( 10322.326, $oActCur );
        $this->assertEquals( $sFormatted, "10#322~326" );
    }

    /**
     * Testing language tag getter
     */
    // emulated lang 1
    public function testGetLanguageTagEmulatedLang()
    {
        $oLang = $this->getMock( 'oxlang', array( 'getBaseLanguage' ) );
        $oLang->expects( $this->any() )->method( 'getBaseLanguage' )->will( $this->returnValue( 1 ) );

        $this->assertEquals( '_1', $oLang->getLanguageTag() );
    }
    // default lang 0
    public function testGetLanguageTagDefaultLang()
    {
        $oLang = $this->getMock( 'oxlang', array( 'getBaseLanguage' ) );
        $oLang->expects( $this->any() )->method( 'getBaseLanguage' )->will( $this->returnValue( 0 ) );

        $this->assertEquals( '', $oLang->getLanguageTag() );
    }
    // passing language ids
    public function testGetLanguageTagPassedLang()
    {
        $oLang = new oxLang();
        $this->assertEquals( '', $oLang->getLanguageTag( 0 ) );
        $this->assertEquals( '_1', $oLang->getLanguageTag( 1 ) );
    }
    public function testResetBaseLanguage()
    {
        modConfig::setParameter( 'lang', '1' );
        $oLang = new oxLang();

        $this->assertEquals( 1, $oLang->getBaseLanguage() );
        modConfig::setParameter( 'lang', '0' );
        $this->assertEquals( 1, $oLang->getBaseLanguage() );
        $oLang->resetBaseLanguage();
        $this->assertEquals( 0, $oLang->getBaseLanguage() );
        modConfig::setParameter( 'lang', '1' );
        $this->assertEquals( 0, $oLang->getBaseLanguage() );
        $oLang->resetBaseLanguage();
        $this->assertEquals( 1, $oLang->getBaseLanguage() );
    }

    /**
     * Testing getBaseLanguage() - testing if all request given parameters are used
     */
    public function testGetBaseLanguageTestingRequest()
    {
        modConfig::setParameter( 'changelang', 1 );

        $oLang = $this->getMock( 'oxLang', array( 'isAdmin' ) );
        $oLang->expects( $this->any() )->method( 'isAdmin')->will( $this->returnValue( true ) );

        $this->assertEquals( 1, $oLang->getBaseLanguage() );

        modConfig::setParameter( 'changelang', null );
        modConfig::setParameter( 'lang', 1 );
        $oLang = new oxLang();

        $this->assertEquals( 1, $oLang->getBaseLanguage() );

        modConfig::setParameter( 'changelang', null );
        modConfig::setParameter( 'lang', null );
        modConfig::setParameter( 'tpllanguage', null );
        modConfig::setParameter( 'language', 1 );
        $oLang = new oxLang();

        $this->assertEquals( 1, $oLang->getBaseLanguage() );

        modConfig::setParameter( 'changelang', null );
        modConfig::setParameter( 'lang', null );
        modConfig::setParameter( 'tpllanguage', null );
        modConfig::setParameter( 'language', null );
        $oLang = new oxLang();

        modConfig::getInstance()->setConfigParam( 'sDefaultLang', 1 );

        $this->assertEquals( 1, $oLang->getBaseLanguage() );
    }

    /**
     * Testing getBaseLanguage() - testing if bad language id is fixed
     */
    public function testGetBaseLanguagePassingNotExistingShouldBeFixed()
    {
        modConfig::setParameter( 'changelang', 'xxx' );
        $oLang = new oxLang();

        $this->assertEquals( 0, $oLang->getBaseLanguage() );
    }

    /**
     * Testing getBaseLanguage() - testing if getting base lang id ignores 'tpllanguage' param
     */
    public function testGetBaseLanguageIgnoresSettedTemplateLanguageParam()
    {
        modConfig::setParameter( 'changelang', 1 );

        $oLang = $this->getMock( 'oxLang', array( 'isAdmin' ) );
        $oLang->expects( $this->any() )->method( 'isAdmin')->will( $this->returnValue( false ) );

        modConfig::setParameter( 'changelang', null );
        modConfig::setParameter( 'lang', null );
        modConfig::setParameter( 'tpllanguage', 1 );

        $oLang = new oxLang();

        $this->assertEquals( 0, $oLang->getBaseLanguage() );
    }

    /**
     * Testing getBaseLanguage() - caches already setted language id
     */
    public function testGetBaseLanguageCaching()
    {
        modConfig::setParameter( 'language', 1 );

        $oLang = $this->getMock( 'oxLang', array( 'isAdmin' ) );
        $oLang->expects( $this->any() )->method( 'isAdmin')->will( $this->returnValue( false ) );

        $this->assertEquals( 1, $oLang->getBaseLanguage() );

        modConfig::setParameter( 'language', 0 );
        $this->assertEquals( 1, $oLang->getTplLanguage() );
    }

    /**
     * Testing getBaseLanguage() - getting language id using browser detect
     */
    public function testGetBaseLanguage_detectingByBrowser()
    {
        modConfig::setParameter( 'changelang', null );
        modConfig::setParameter( 'lang', null );
        modConfig::setParameter( 'tpllanguage', null );
        modConfig::setParameter( 'language', null );
        modConfig::setParameter( 'aLanguageURLs', null );

        $oLang = $this->getMock( 'oxlang', array( 'detectLanguageByBrowser', 'validateLanguage' ) );
        $oLang->expects( $this->any() )->method( 'validateLanguage')->with( $this->equalTo( 1 ) )->will( $this->returnValue( 1 ) );
        $oLang->expects( $this->once() )->method( 'detectLanguageByBrowser')->will( $this->returnValue( 1 ) );

        $this->assertEquals( 1, $oLang->getBaseLanguage() );
    }

    /**
     * Testing getBaseLanguage() - getting language id using browser detect when
     * search engine detected
     */
    public function testGetBaseLanguage_detectingByBrowser_searchEngineDetected()
    {
        modConfig::setParameter( 'changelang', null );
        modConfig::setParameter( 'lang', null );
        modConfig::setParameter( 'tpllanguage', null );
        modConfig::setParameter( 'language', null );
        modConfig::setParameter( 'aLanguageURLs', null );

        $oUtils = $this->getMock( 'oxUtils', array( 'isSearchEngine' ) );
        $oUtils->expects( $this->any() )->method( 'isSearchEngine')->will( $this->returnValue( true ) );

        modInstances::addMod( "oxUtils", $oUtils );

        $oLang = $this->getMock( 'oxlang', array( 'detectLanguageByBrowser', 'validateLanguage' ) );
        $oLang->expects( $this->any() )->method( 'validateLanguage')->with( $this->equalTo( 0 ) )->will( $this->returnValue( 0 ) );
        $oLang->expects( $this->never() )->method( 'detectLanguageByBrowser');

        $this->assertEquals( 0, $oLang->getBaseLanguage() );
    }

    /**
     * Testing getBaseLanguage() - getting language id using browser detect when
     * search engine detected
     */
    public function testGetBaseLanguage_detectingByBrowser_adminMode()
    {
        modConfig::setParameter( 'changelang', null );
        modConfig::setParameter( 'lang', null );
        modConfig::setParameter( 'tpllanguage', null );
        modConfig::setParameter( 'language', null );
        modConfig::setParameter( 'aLanguageURLs', null );

        $oLang = $this->getMock( 'oxlang', array( 'detectLanguageByBrowser', 'isAdmin', 'validateLanguage' ) );
        $oLang->expects( $this->any() )->method( 'isAdmin')->will( $this->returnValue( true ) );
        $oLang->expects( $this->any() )->method( 'validateLanguage')->with( $this->equalTo( 0 ) )->will( $this->returnValue( 0 ) );
        $oLang->expects( $this->never() )->method( 'detectLanguageByBrowser');

        $this->assertEquals( 0, $oLang->getBaseLanguage() );
    }

    /**
     * Testing getTplLanguage() - in non admin mode should return base language id
     */
    public function testGetTplLanguageInNonAdminMode()
    {
        modConfig::setParameter( 'tpllanguage', 1 );

        $oLang = $this->getMock( 'oxLang', array( 'isAdmin', 'getBaseLanguage' ) );
        $oLang->expects( $this->any() )->method( 'isAdmin')->will( $this->returnValue( false ) );
        $oLang->expects( $this->any() )->method( 'getBaseLanguage')->will( $this->returnValue( 0 ) );

        $this->assertEquals( 0, $oLang->getTplLanguage() );
    }

    /**
     * Testing getTplLanguage() - testind in admin mode
     */
    public function testGetTplLanguageInAdminMode()
    {
        //modConfig::setParameter( 'tpllanguage', 1 );
        modSession::getInstance()->setVar( 'tpllanguage', 1 );

        $oLang = $this->getMock( 'oxLang', array( 'isAdmin', 'getBaseLanguage' ) );
        $oLang->expects( $this->any() )->method( 'isAdmin')->will( $this->returnValue( true ) );
        $oLang->expects( $this->any() )->method( 'getBaseLanguage')->will( $this->returnValue( 0 ) );

        $this->assertEquals( 1, $oLang->getTplLanguage() );
    }

    /**
     * Testing getTplLanguage() - testing in admin mode, when no tpllanguage param exists
     */
    public function testGetTplLanguageInAdmin()
    {
        modSession::getInstance()->setVar( 'tpllanguage', 999 );

        $oLang = $this->getMock( 'oxLang', array( 'isAdmin', 'setTplLanguage', 'getBaseLanguage' ) );
        $oLang->expects( $this->once() )->method( 'isAdmin')->will( $this->returnValue( true ) );
        $oLang->expects( $this->once() )->method( 'setTplLanguage')->with( $this->equalTo( 999 ) )->will( $this->returnValue( 777 ) );
        $oLang->expects( $this->never() )->method( 'getBaseLanguage');

        $this->assertEquals( 777, $oLang->getTplLanguage() );
    }

    /**
     * Testing getTplLanguage() - testing in admin mode, when no tpllanguage param exists
     */
    public function testGetTplLanguageNonAdmin()
    {
        modSession::getInstance()->setVar( 'tpllanguage', 999 );

        $oLang = $this->getMock( 'oxLang', array( 'isAdmin', 'setTplLanguage', 'getBaseLanguage' ) );
        $oLang->expects( $this->once() )->method( 'isAdmin')->will( $this->returnValue( false ) );
        $oLang->expects( $this->never() )->method( 'setTplLanguage');
        $oLang->expects( $this->once() )->method( 'getBaseLanguage')->will( $this->returnValue( 555 ) );

        $this->assertEquals( 555, $oLang->getTplLanguage() );
    }

    /**
     * Testing getTplLanguage() - caches already setted language id
     */
    public function testGetTplLanguageCaching()
    {
        //modConfig::setParameter( 'tpllanguage', 1 );
        modSession::getInstance()->setVar( 'tpllanguage', 1 );

        $oLang = $this->getMock( 'oxLang', array( 'isAdmin', 'getBaseLanguage' ) );
        $oLang->expects( $this->any() )->method( 'isAdmin')->will( $this->returnValue( true ) );
        $oLang->expects( $this->any() )->method( 'getBaseLanguage')->will( $this->returnValue( 0 ) );

        $this->assertEquals( 1, $oLang->getTplLanguage() );

        modConfig::setParameter( 'tpllanguage', 0 );
        $this->assertEquals( 1, $oLang->getTplLanguage() );
    }

    /**
     * Testing getTplLanguage() - testing if bad language id is fixed
     */
    public function testGetTplLanguagePassingNotExistingShouldBeFixed()
    {
        modConfig::setParameter( 'tpllanguage', 'xxx' );

        $oLang = $this->getMock( 'oxLang', array( 'isAdmin', 'getBaseLanguage' ) );
        $oLang->expects( $this->any() )->method( 'isAdmin')->will( $this->returnValue( true ) );

        $this->assertEquals( 0, $oLang->getTplLanguage() );
    }

    /**
     * Testing getEditLanguage() - in admin mode
     */
    public function testGetEditLanguageInAdminMode()
    {
        modConfig::setParameter( 'editlanguage', 1 );

        $oLang = $this->getMock( 'oxLang', array( 'isAdmin', 'getBaseLanguage' ) );
        $oLang->expects( $this->any() )->method( 'isAdmin')->will( $this->returnValue( true ) );
        $oLang->expects( $this->any() )->method( 'getBaseLanguage')->will( $this->returnValue( 0 ) );

        $this->assertEquals( 1, $oLang->getEditLanguage() );
    }

    /**
     * Testing getEditLanguage() - in non admin mode
     */
    public function testGetEditLanguageinNonAdminMode()
    {
        modConfig::setParameter( 'editlanguage', 1 );

        $oLang = $this->getMock( 'oxLang', array( 'isAdmin', 'getBaseLanguage' ) );
        $oLang->expects( $this->any() )->method( 'isAdmin')->will( $this->returnValue( false ) );
        $oLang->expects( $this->any() )->method( 'getBaseLanguage')->will( $this->returnValue( 0 ) );

        $this->assertEquals( 0, $oLang->getEditLanguage() );
    }

    /**
     * Testing getEditLanguage() - when no editlanguage param exists
     */
    public function testGetEditLanguageWithoutEditLangParam()
    {
        modConfig::setParameter( 'editlanguage', null );

        $oLang = $this->getMock( 'oxLang', array( 'isAdmin', 'getBaseLanguage' ) );
        $oLang->expects( $this->any() )->method( 'isAdmin')->will( $this->returnValue( true ) );
        $oLang->expects( $this->any() )->method( 'getBaseLanguage')->will( $this->returnValue( 1 ) );

        $this->assertEquals( 1, $oLang->getEditLanguage() );
    }

    /**
     * Testing getEditLanguage() - new language param overides editlangparam
     * whene saveing to difference lang
     */
    public function testGetEditLanguageNewLangParamOveridesEditLangParam()
    {
        modConfig::setParameter( 'editlanguage', 0 );
        modConfig::setParameter( 'new_lang', 1 );

        $oView = new oxView();
        $oView->setFncName( 'saveinnlang' );

        $oConfig = $this->getMock( 'oxConfig', array( 'getActiveView' ) );
        $oConfig->expects( $this->any() )->method( 'getActiveView')->will( $this->returnValue( $oView ) );
        $oConfig->init();

        $oLang = $this->getMock( 'oxLang', array( 'isAdmin', 'getBaseLanguage', 'getConfig' ) );
        $oLang->expects( $this->any() )->method( 'isAdmin')->will( $this->returnValue( true ) );
        $oLang->expects( $this->any() )->method( 'getBaseLanguage')->will( $this->returnValue( 2 ) );
        $oLang->expects( $this->any() )->method( 'getConfig')->will( $this->returnValue( $oConfig ) );

        $this->assertEquals( 1, $oLang->getEditLanguage() );
    }

    /**
     * Testing getEditLanguage() - caches already setted language id
     */
    public function testGetEditLanguageCaching()
    {
        modConfig::setParameter( 'editlanguage', 1 );

        $oLang = $this->getMock( 'oxLang', array( 'isAdmin', 'getBaseLanguage' ) );
        $oLang->expects( $this->any() )->method( 'isAdmin')->will( $this->returnValue( true ) );
        $oLang->expects( $this->any() )->method( 'getBaseLanguage')->will( $this->returnValue( 2 ) );

        $this->assertEquals( 1, $oLang->getEditLanguage() );

        modConfig::setParameter( 'editlanguage', 0 );
        $this->assertEquals( 1, $oLang->getEditLanguage() );
    }

    /**
     * Testing getEditLanguage() - testing if bad language id is fixed
     */
    public function testGetEditLanguagePassingNotExistingShouldBeFixed()
    {
        modConfig::setParameter( 'editlanguage', 'xxx' );

        $oLang = $this->getMock( 'oxLang', array( 'isAdmin', 'getBaseLanguage' ) );
        $oLang->expects( $this->any() )->method( 'isAdmin')->will( $this->returnValue( true ) );

        $this->assertEquals( 0, $oLang->getEditLanguage() );
    }

    /**
     * Testing getBaseLanguage() - testing if url configuration sets language
     */
    public function testGetBaseLanguageLanguageURLs()
    {
        modConfig::setParameter( 'changelang', 1 );
        $oConfig = $this->getMock( 'oxConfig', array( 'isCurrentUrl' ) );
        $oConfig->expects( $this->any() )->method( 'isCurrentUrl')->will( $this->returnValue( true ) );
        $oConfig->init();

        $oConfig->setConfigParam( 'aLanguageURLs', array( 1 => 'xxx' ) );

        $oLang = $this->getMock( 'oxLang', array( 'isAdmin' ) );
        $oLang->expects( $this->any() )->method( 'isAdmin' )->will( $this->returnValue( false ) );

        $oLang->setConfig( $oConfig );


        $this->assertEquals( 1, $oLang->getBaseLanguage() );
    }

    /**
     * Testing language array getter
     */
    public function testGetLanguageArray()
    {
        // preparing fixture
        $oDe = new oxStdClass;
        $oDe->id = 0;
        $oDe->abbr = 'de';
        $oDe->oxid = 'de';
        $oDe->name = 'Deutsch';
        $oDe->active = '1';
        $oDe->sort = '1';
        $oDe->selected = 1;

        $oEng = clone $oDe;
        $oEng->id = 1;
        $oEng->abbr = 'en';
        $oEng->oxid = 'en';
        $oEng->name = 'English';
        $oEng->active = '1';
        $oEng->sort = '2';
        $oEng->selected = 0;

        $aLangArray = array( $oDe, $oEng );

        $oLang = new oxLang();
        $this->assertEquals( $aLangArray, $oLang->getLanguageArray( 0, true, true ) );
    }

    /**
     * #1290: impossible to switch languages in admin, if third language is created as default and only one active
     */
    public function testGetLanguageArrayWithNewLang()
    {
        $aLanguages = array( 'de' => 'Deutsch', 'ru' => 'Russian' );
        modConfig::getInstance()->setConfigParam( 'aLanguages', $aLanguages );
        $aLangParams['de']['baseId'] = 0;
        $aLangParams['de']['abbr'] = 'de';
        $aLangParams['de']['sort'] = '1';
        $aLangParams['de']['active'] = '1';
        $aLangParams['ru']['baseId'] = 2;
        $aLangParams['ru']['abbr'] = 'ru';
        $aLangParams['ru']['sort'] = '2';
        $aLangParams['ru']['active'] = '1';

        modConfig::getInstance()->setConfigParam( 'aLanguageParams', $aLangParams );

        // preparing fixture
        $oDe = new oxStdClass;
        $oDe->id = 0;
        $oDe->abbr = 'de';
        $oDe->oxid = 'de';
        $oDe->name = 'Deutsch';
        $oDe->active = '1';
        $oDe->sort = '1';
        $oDe->selected = 0;

        $oRus = clone $oDe;
        $oRus->id = 2;
        $oRus->abbr = 'ru';
        $oRus->oxid = 'ru';
        $oRus->name = 'Russian';
        $oRus->active = '1';
        $oRus->sort = '2';
        $oRus->selected = 1;

        $aLangArray = array( 0 => $oDe, 2 => $oRus );

        $oLang = new oxLang();

        $this->assertEquals( $aLangArray, $oLang->getLanguageArray( 2 ) );
    }

    /**
     * Testing language names getter when one language is inactive
     * (M:1027)
     */
    public function testGetLanguageArray_withIncacitiveLang()
    {
        // preparing fixture
        $oEng = new oxStdClass;
        $oEng->id = 1;
        $oEng->abbr = 'en';
        $oEng->oxid = 'en';
        $oEng->name = 'English';
        $oEng->active = '1';
        $oEng->sort = '2';
        $oEng->selected = 1;

        $aLangArray = array( 1 => $oEng );

        $oConfig = modConfig::getInstance();
        $aLangParams = $oConfig->getConfigParam( 'aLanguageParams' );
        $aLangParams["de"]["active"] = false;
        $aLangParams = $oConfig->setConfigParam( 'aLanguageParams', $aLangParams );

        $oLang = new oxLang();
        $aLanguages = $oLang->getLanguageArray( 1, true );
        $this->assertEquals( $aLangArray, $aLanguages );

        $this->assertEquals( 1, $aLanguages[1]->selected );
    }
    /**
     * Testing language name getter when language parameters array does not exist
     */
    public function testGetLanguageAbbrWhenLangParamsArrayDoesNotExists()
    {
        modConfig::getInstance()->setConfigParam( 'aLanguageParams', null );

        $oLang = $this->getProxyClass( "oxLang" );
        $oLang->setNonPublicVar( '_iBaseLanguageId', 0 );

        $this->assertEquals( 'de', $oLang->getLanguageAbbr( 0 ) );
        $this->assertEquals( 'en', $oLang->getLanguageAbbr( 1 ) );
        $this->assertEquals( 3, $oLang->getLanguageAbbr( 3 ) );
        $this->assertEquals( 'de', $oLang->getLanguageAbbr( null ) );
    }

    /**
     * Testing language name getter when language parameters array exist
     */
    public function testGetLanguageAbbrWhenLangParamsArrayExists()
    {
        $aLangParams['de']['baseId'] = 0;
        $aLangParams['de']['abbr'] = 'de';
        $aLangParams['ru']['baseId'] = 1;
        $aLangParams['ru']['abbr'] = 'ru';
        $aLangParams['en']['baseId'] = 3;
        $aLangParams['en']['abbr'] = 'ru';

        modConfig::getInstance()->setConfigParam( 'aLanguageParams', $aLangParams );

        $oLang = $this->getProxyClass( "oxLang" );
        $oLang->setNonPublicVar( '_iBaseLanguageId', 0 );

        $this->assertEquals( 'de', $oLang->getLanguageAbbr( 0 ) );
        $this->assertEquals( 'ru', $oLang->getLanguageAbbr( 1 ) );
        $this->assertEquals( 2, $oLang->getLanguageAbbr( 2 ) );
        $this->assertEquals( 'en', $oLang->getLanguageAbbr( 3 ) );
        $this->assertEquals( 'de', $oLang->getLanguageAbbr( null ) );
    }

    /**
     * Testing language name getter
     */
    public function testGetLanguageAbbr()
    {
        $oLang = $this->getProxyClass( "oxLang" );
        $oLang->setNonPublicVar( '_iBaseLanguageId', 0 );

        $this->assertEquals( 'de', $oLang->getLanguageAbbr( 0 ) );
        $this->assertEquals( 'en', $oLang->getLanguageAbbr( 1 ) );
        $this->assertEquals( 3, $oLang->getLanguageAbbr( 3 ) );
        $this->assertEquals( 'de', $oLang->getLanguageAbbr( null ) );
    }

    /**
     * Testing language name getter
     */
    public function testGetLanguageAbbrAdmin()
    {
        $oLang1 = new oxStdClass();
        $oLang1->abbr = 'test1';
        $oLang1->id = 0;
        $oLang2 = new oxStdClass();
        $oLang2->abbr = 'test2';
        $oLang2->id = 1;

        $oLang = $this->getMock( "oxLang", array( "isAdmin", "getAdminTplLanguageArray" ) );
        $oLang->expects( $this->atLeastOnce() )->method( 'isAdmin' )->will( $this->returnValue( true ) );
        $oLang->expects( $this->once() )->method( 'getAdminTplLanguageArray' )->will( $this->returnValue( array( $oLang1, $oLang2 ) ) );

        $this->assertEquals( 'test1', $oLang->getLanguageAbbr( 0 ) );
        $this->assertEquals( 'test2', $oLang->getLanguageAbbr( 1 ) );
        $this->assertEquals( 2, $oLang->getLanguageAbbr( 2 ) );
    }

    /**
     * Testing language array getter - if returns already setted base language id
     */
    public function testGetBaseLanguageReturnsAlreadySettedValue()
    {
        $oLang = $this->getProxyClass( "oxLang" );
        $oLang->setNonPublicVar( '_iBaseLanguageId', 2 );

        $this->assertEquals( 2, $oLang->getBaseLanguage() );
    }

    /**
     * Testing base language setter
     */
    public function testSetBaseLanguage()
    {
        $oLang =  new oxLang();
        $oLang->setBaseLanguage( 2 );

        $this->assertEquals( 2, $oLang->getBaseLanguage() );
        $this->assertEquals( 2, modSession::getInstance()->getVar( 'language' ) );
    }
    public function testSetBaseLanguageWithoutParams()
    {
        $oLang = $this->getMock( 'oxLang', array( 'getBaseLanguage' ) );
        $oLang->expects( $this->any() )->method( 'getBaseLanguage' )->will( $this->returnValue( 1 ) );
        $oLang->setBaseLanguage();

        $this->assertEquals( 1, modSession::getInstance()->getVar( 'language' ) );
    }

    /**
     * Testing template language setter
     */
    public function testSetTplLanguageIsAdmin()
    {
        $oLang = $this->getMock( 'oxLang', array( 'isAdmin', 'getBaseLanguage', 'getAdminTplLanguageArray' ) );
        $oLang->expects( $this->once() )->method( 'getBaseLanguage')->will( $this->returnValue( 777 ) );
        $oLang->expects( $this->once() )->method( 'isAdmin')->will( $this->returnValue( true ) );
        $oLang->expects( $this->once() )->method( 'getAdminTplLanguageArray')->will( $this->returnValue( array( 2 => 1 ) ) );
        $this->assertEquals( 2, $oLang->setTplLanguage() );
        $this->assertEquals( 2, modSession::getInstance()->getVar( 'tpllanguage' ) );
    }

    /**
     * Testing template language setter
     */
    public function testSetTplLanguageNonAdmin()
    {
        $oLang = $this->getMock( 'oxLang', array( 'isAdmin', 'getBaseLanguage', 'getAdminTplLanguageArray' ) );
        $oLang->expects( $this->once() )->method( 'getBaseLanguage')->will( $this->returnValue( 777 ) );
        $oLang->expects( $this->once() )->method( 'isAdmin')->will( $this->returnValue( false ) );
        $oLang->expects( $this->never() )->method( 'getAdminTplLanguageArray');
        $this->assertEquals( 777, $oLang->setTplLanguage() );
        $this->assertEquals( 777, modSession::getInstance()->getVar( 'tpllanguage' ) );
    }

    /**
     * Testing validating language id
     */
    public function testValidateLanguage()
    {
        $oLang = new oxLang();

        $this->assertEquals( 1, $oLang->validateLanguage( 1 ) );
        $this->assertEquals( 0, $oLang->validateLanguage( 2 ) );
        $this->assertEquals( 0, $oLang->validateLanguage( 'xxx' ) );
    }

    public function testGetLanguageNames()
    {
        $this->assertEquals(array(0=>'Deutsch',1=>'English'), oxLang::getInstance()->getLanguageNames());
    }

    //#1290: impossible to switch languages in admin, if third language is created as default and only one active
    public function testGetLanguageNamesWithNewLang()
    {
        $aLanguages = array( 'de' => 'Deutsch', 'ru' => 'Russian' );
        modConfig::getInstance()->setConfigParam( 'aLanguages', $aLanguages );
        $oLangIds = array( 0 => 'de', 2 => 'ru' );
        $oLang = $this->getMock( 'oxlang', array( 'getLanguageIds' ) );
        $oLang->expects( $this->any() )->method( 'getLanguageIds' )->will( $this->returnValue( $oLangIds ) );

        $this->assertEquals(array(0=>'Deutsch',2=>'Russian'), $oLang->getLanguageNames());
    }


    public function testGetLangTranslationArray()
    {
        $oSubj = $this->getProxyClass("oxLang");
        $aTrArray = $oSubj->UNITgetLangTranslationArray();
        $this->assertTrue(isset($aTrArray["DETAILS_QUESTIONS"]));
        $this->assertEquals($aTrArray["DETAILS_QUESTIONS"], "[?] Sie haben Fragen zu diesem Artikel?");
    }

    public function testGetLangTranslationArrayLang1()
    {
        $oSubj = $this->getProxyClass("oxLang");
        $aTrArray = $oSubj->UNITgetLangTranslationArray(1);
        $this->assertTrue(isset($aTrArray["DETAILS_QUESTIONS"]));
        $this->assertEquals($aTrArray["DETAILS_QUESTIONS"], "[?] Questions about this product?");
    }

    public function testGetLangTranslationArrayIsSetInCache()
    {
        $oSubj = $this->getProxyClass("oxLang");
        $oSubj->setNonPublicVar( '_aLangCache', array( 'langcache_0_1_'.oxConfig::getInstance()->getShopId().'_basic_default'=>array('1'=>array("ACCOUNT_LOGIN"=>"Login") ) ) );
        $aTrArray = $oSubj->UNITgetLangTranslationArray(1);
        $this->assertTrue(isset($aTrArray["DETAILS_QUESTIONS"]));
        $this->assertEquals($aTrArray["DETAILS_QUESTIONS"], "[?] Questions about this product?");
    }

    public function testGetLangTranslationArrayIfBaseLAngNotSet()
    {
        $oSubj = $this->getMock( 'oxLang', array( 'getBaseLanguage' ) );
        $oSubj->expects( $this->any() )->method( 'getBaseLanguage' )->will( $this->returnValue( null ) );
        $aTrArray = $oSubj->UNITgetLangTranslationArray();
        $this->assertTrue(isset($aTrArray["DETAILS_QUESTIONS"]));
        $this->assertEquals($aTrArray["DETAILS_QUESTIONS"], "[?] Sie haben Fragen zu diesem Artikel?");
    }

    public function testGetLangTranslationArrayModuleFile()
    {
        oxUtils::getInstance()->oxResetFileCache();

        //writing a test file
        $sFileContents = '<?php $aLang = array( "charset" => "testCharset", "TESTKEY" => "testVal");';
        $sFileName = getShopBasePath()."/out/azure/de/my_lang.php";
        $sShopId = modConfig::getInstance()->getShopId();
        $sCacheKey = "languagefiles__0_$sShopId";
        oxUtils::getInstance()->toFileCache($sCacheKey, null);

        file_put_contents($sFileName, $sFileContents);
        $oSubj = $this->getProxyClass("oxLang");
        $aTrArray = $oSubj->UNITgetLangTranslationArray();

        $this->assertTrue(isset($aTrArray["TESTKEY"]));

        $this->assertEquals("testVal", $aTrArray["TESTKEY"]);

        //cleaning up
        $this->assertTrue(file_exists($sFileName));
        unlink ($sFileName);
        $this->assertFalse(file_exists($sFileName));

        oxUtils::getInstance()->toFileCache($sCacheKey, null);

    }

    public function testGetLangTranslationArrayCustumFile()
    {
        oxUtils::getInstance()->oxResetFileCache();
        $oSubj = new oxLang();
        $aTrArray = $oSubj->UNITgetLangTranslationArray( 1, 1 );
        $this->assertTrue( isset( $aTrArray["EMAIL_PRICEALARM_CUSTOMER_HAVEPRICEALARM"] ) );
        $this->assertEquals( "we have a Price Alert in", $aTrArray["EMAIL_PRICEALARM_CUSTOMER_HAVEPRICEALARM"] );
    }

    public function testCheckCustumFile()
    {
        $aLang = $this->_getLangArray( 'de', 'admin');
        $this->assertTrue(isset($aLang["charset"]));
        $this->assertTrue(isset($aLang["EMAIL_PRICEALARM_CUSTOMER_HAVEPRICEALARM"]));
        $aLang = $this->_getLangArray( 'en', 'admin');
        $this->assertTrue(isset($aLang["charset"]));
        $this->assertEquals("we have a Price Alert in", $aLang["EMAIL_PRICEALARM_CUSTOMER_HAVEPRICEALARM"]);
        $aLang = $this->_getLangArray( 'de', 'basic');
        $this->assertTrue(isset($aLang["charset"]));
        $aLang = $this->_getLangArray( 'en', 'basic');
        $this->assertTrue(isset($aLang["charset"]));
    }

    /**
     * Testing getLanguageArray() - if returned array keys are languages base ID's,
     * not loop counter values
     */
    public function testGetLanguageArrayHasGoodKeysValues()
    {
        $aLanguages = array( 'de' => 'Deutch', 'en' => 'English', 'ru' => 'Russian' );
        modConfig::getInstance()->setConfigParam( 'aLanguages', $aLanguages );

        $aLangParams['de']['baseId'] = 0;
        $aLangParams['de']['abbr'] = 'de';
        $aLangParams['ru']['baseId'] = 1;
        $aLangParams['ru']['abbr'] = 'ru';
        $aLangParams['en']['baseId'] = 3;
        $aLangParams['en']['abbr'] = 'ru';

        modConfig::getInstance()->setConfigParam( 'aLanguageParams', $aLangParams );

        $oLang = oxNew ( "oxLang" );
        $aKeys = array( 0, 3, 1 );

        $this->assertEquals( $aKeys, array_keys($oLang->getLanguageArray()) );
    }


    public function testReadTranslateStrFromTextFile()
    {
        $sTestFile = getTestsBasePath().'/unit/out/test4/lang.txt';
        $oConfig = $this->getMock( 'oxConfig', array( 'getLanguagePath' ) );
        $oConfig->expects( $this->any() )->method( 'getLanguagePath')->will( $this->returnValue( $sTestFile ) );
        $oSubj = $this->getProxyClass("oxLang");
        $oSubj->setConfig( $oConfig );
        $sTrString = $oSubj->UNITreadTranslateStrFromTextFile("INC_HEADER_YOUAREHERE", 1);
        $this->assertEquals("You are here:", $sTrString);
    }

    public function testReadTranslateStrFromTextFileIFWrongFile()
    {
        $oSubj = $this->getMock( 'oxLang', array( 'getBaseLanguage' ) );
        $oSubj->expects( $this->any() )->method( 'getBaseLanguage' )->will( $this->returnValue( null ) );
        $sTrString = $oSubj->UNITreadTranslateStrFromTextFile("INC_HEADER_YOUAREHERE", 1);
        $this->assertEquals("INC_HEADER_YOUAREHERE", $sTrString);
    }

    /**
     * Testing getLanguageIds() - if returns correct languages abbervations array
     * when language params array exists
     */
    public function testGetLanguageIds()
    {
        $aLanguages = array( 'de' => 'Deutch', 'en' => 'English', 'ru' => 'Russian' );
        modConfig::getInstance()->setConfigParam( 'aLanguages', $aLanguages );

        $aLangParams['de']['baseId'] = 0;
        $aLangParams['de']['abbr'] = 'de';
        $aLangParams['ru']['baseId'] = 1;
        $aLangParams['ru']['abbr'] = 'ru';
        $aLangParams['en']['baseId'] = 3;
        $aLangParams['en']['abbr'] = 'ru';

        modConfig::getInstance()->setConfigParam( 'aLanguageParams', $aLangParams );

        $oLang = oxNew ( "oxLang" );
        $aLangIds = array( 0 => 'de', 1 => 'ru', 3 => 'en');

        $this->assertEquals( $aLangIds, $oLang->getLanguageIds() );
    }

    /**
     * Testing getLanguageIds() - if returns correct languages abbervations array
     * when language params array does not exists
     */
    public function testGetLanguageIdsWhenLangParamsNotExists()
    {
        $aLangIds = array( 0 => 'de', 1 => 'en');

        $oConfig = $this->getMock( "oxConfig", array( "getConfigParam" ) );
        $oConfig->expects( $this->at( 0 ) )->method( 'getConfigParam')->with( $this->equalTo( 'aLanguageParams' ) )->will( $this->returnValue( null ) );
        $oConfig->expects( $this->at( 1 ) )->method( 'getConfigParam')->with( $this->equalTo( 'aLanguages' ) )->will( $this->returnValue( $aLangIds ) );

        $oLang = $this->getMock( "oxLang", array( "getConfig" ) );
        $oLang->expects( $this->any() )->method( 'getConfig')->will( $this->returnValue( $oConfig ) );

        $this->assertEquals( array( 0, 1 ), $oLang->getLanguageIds() );
    }

    /**
     * Testing detecting language by browser
     */
    public function testDetectLanguageByBrowser()
    {
        // preparing fixture
        $oDe = new oxStdClass;
        $oDe->id = 0;
        $oDe->abbr = 'de';
        $oDe->active = '1';

        $oEng = clone $oDe;
        $oEng->id = 1;
        $oEng->abbr = 'en';
        $oEng->active = '1';

        $aLangArray = array( $oDe, $oEng );

        $oLang = $this->getMock( 'oxlang', array( 'getLanguageArray' ) );
        $oLang->expects( $this->any() )->method( 'getLanguageArray')->with( $this->equalTo(null), $this->equalTo(true) )->will( $this->returnValue($aLangArray) );

        $_SERVER['HTTP_ACCEPT_LANGUAGE'] = 'en-EN';
        $this->assertEquals( 1, $oLang->detectLanguageByBrowser() );

        $_SERVER['HTTP_ACCEPT_LANGUAGE'] = 'en';
        $this->assertEquals( 1, $oLang->detectLanguageByBrowser() );
    }

    /**
     * Testing detecting language by browser - no such language in shop
     */
    public function testDetectLanguageByBrowser_langNotInShop()
    {
        // preparing fixture
        $oDe = new oxStdClass;
        $oDe->id = 0;
        $oDe->abbr = 'de';

        $oEng = clone $oDe;
        $oEng->id = 1;
        $oEng->abbr = 'en';

        $aLangArray = array( $oDe, $oEng );

        $oLang = $this->getMock( 'oxlang', array( 'getLanguageArray' ) );
        $oLang->expects( $this->once() )->method( 'getLanguageArray')->with( $this->equalTo(null), $this->equalTo(true) )->will( $this->returnValue($aLangArray) );

        $_SERVER['HTTP_ACCEPT_LANGUAGE'] = 'es';
        $this->assertNull( $oLang->detectLanguageByBrowser() );
    }

    /**
     * Testing detecting language by browser - cant detect browser lang
     */
    public function testDetectLanguageByBrowser_cantDetectLanguage()
    {
        $oLang = $this->getMock( 'oxlang', array( 'getLanguageArray' ) );
        $oLang->expects( $this->never() )->method( 'getLanguageArray');

        $_SERVER['HTTP_ACCEPT_LANGUAGE'] = '';
        $this->assertNull( $oLang->detectLanguageByBrowser() );
    }

    /**
     * Testing detecting language - getting language from cookie
     */
    public function testBaseLanguage_getsFromCookie()
    {
        modConfig::setParameter( 'changelang', null );
        modConfig::setParameter( 'lang', null );
        modConfig::setParameter( 'tpllanguage', null );
        modConfig::setParameter( 'language', null );
        modConfig::setParameter( 'aLanguageURLs', null );

        $oUtilsServer = $this->getMock( 'oxUtilsServer', array( 'getOxCookie' ) );
        $oUtilsServer->expects( $this->exactly( 2 ) )->method( 'getOxCookie')->with( $this->equalTo( 'language' ) )->will( $this->returnValue( 1 ) );

        modInstances::addMod( "oxUtilsServer", $oUtilsServer );

        $oLang = $this->getMock( 'oxlang', array( 'detectLanguageByBrowser', 'validateLanguage' ) );
        $oLang->expects( $this->any() )->method( 'validateLanguage')->with( $this->equalTo( 1 ) )->will( $this->returnValue( 1 ) );
        $oLang->expects( $this->never( 'detectLanguageByBrowser') )->method( 'detectLanguageByBrowser');


        $this->assertEquals( 1, $oLang->getBaseLanguage() );
    }

    /**
     * Testing detecting language - setting cookie with language ID
     */
    public function testBaseLanguage_setsToCookie()
    {
        modConfig::setParameter( 'changelang', null );
        modConfig::setParameter( 'lang', 1 );
        modConfig::setParameter( 'tpllanguage', null );
        modConfig::setParameter( 'language', null );
        modConfig::setParameter( 'aLanguageURLs', null );

        $oUtilsServer = $this->getMock( 'oxUtilsServer', array( 'setOxCookie' ) );
        $oUtilsServer->expects( $this->once() )->method( 'setOxCookie')->with( $this->equalTo( 'language' ), $this->equalTo( 1 ) );

        modInstances::addMod( "oxUtilsServer", $oUtilsServer );

        $oLang = $this->getMock( 'oxlang', array( 'validateLanguage' ) );
        $oLang->expects( $this->any() )->method( 'validateLanguage')->with( $this->equalTo( 1 ) )->will( $this->returnValue( 1 ) );

        $this->assertEquals( 1, $oLang->getBaseLanguage() );
    }

    /**
     * Testing oxLang::getObjectTplLanguage()
     *
     * @return null
     */
    public function testGetObjectTplLanguage()
    {
        $oStdLang = new oxStdClass();
        $oStdLang->active = 0;

        $oLang = $this->getMock( 'oxlang', array( 'getTplLanguage', 'getAdminTplLanguageArray' ) );
        $oLang->expects( $this->once() )->method( 'getTplLanguage')->will( $this->returnValue( 555 ) );
        $oLang->expects( $this->once() )->method( 'getAdminTplLanguageArray')->will( $this->returnValue( array( 444 => $oStdLang, 555 => $oStdLang ) ) );

        $this->assertEquals( 444, $oLang->getObjectTplLanguage() );
    }

    /**
     * Testing oxLang::getAdminTplLanguageArray()
     *
     * @return null
     */
    public function testGetAdminTplLanguageArray()
    {
        $oLt = new oxStdClass();
        $oLt->name = 'Lithuanian';
        $oLt->abbr = 'lt';
        $oLt->sort = 0;
        $oLt->id   = 0;
        $oLt->selected = 0;
        $oLt->active   = 0;

        $oLv = new oxStdClass();
        $oLv->name = 'Latvian';
        $oLv->abbr = 'lv';
        $oLv->sort = 1;
        $oLv->id   = 1;
        $oLv->selected = 0;
        $oLv->active   = 0;

        $oDe = new oxStdClass();
        $oDe->name = 'Deutsch';
        $oDe->abbr = 'de';
        $oDe->sort = 2;
        $oDe->id   = 2;
        $oDe->selected = 0;
        $oDe->active   = 0;

        $oEn = new oxStdClass();
        $oEn->name = 'English';
        $oEn->abbr = 'en';
        $oEn->sort = 3;
        $oEn->id   = 3;
        $oEn->selected = 0;
        $oEn->active   = 0;

        $oLang = $this->getMock( 'oxlang', array( 'getLanguageIds', 'getLanguageArray' ) );
        $oLang->expects( $this->once() )->method( 'getLanguageIds')->will( $this->returnValue( array( "lt", "lv" ) ) );
        $oLang->expects( $this->once() )->method( 'getLanguageArray')->will( $this->returnValue( array( $oLt, $oLv ) ) );

        $this->assertEquals( array( $oLt, $oLv, $oDe, $oEn     ), $oLang->getAdminTplLanguageArray() );
    }

    /**
     * base test
     *
     * @return null
     */
    public function testRegisterAdditionalLangFile()
    {
        $cl = oxTestModules::addFunction('oxLang', '__getAdditionalLangFiles', '{return $this->_aAdditionalLangFiles;}');
        $o = new $cl;

        $this->assertEquals(array(), $o->__getAdditionalLangFiles());
        $o->registerAdditionalLangFile(__FILE__);
        $this->assertEquals(array(__FILE__), $o->__getAdditionalLangFiles());
        try {
            $o->registerAdditionalLangFile("something non existing");
            $this->fail('exception not thrown');
        }catch (oxFileException $e) {
            $this->assertEquals('EXCEPTION_FILENOTFOUND', $e->getMessage());
            $this->assertEquals('something non existing', $e->getFileName());
        }
    }
}


