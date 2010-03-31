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
 * @version   SVN: $Id: loginTest.php 26660 2010-03-18 17:09:03Z rimvydas.paskevicius $
 */

require_once realpath( "." ).'/unit/OxidTestCase.php';
require_once realpath( "." ).'/unit/test_config.inc.php';

/**
 * Testing login class.
 */
class Unit_Admin_loginTest extends OxidTestCase
{
    /**
     * Tear down the fixture.
     *
     * @return null
     */
    protected function tearDown()
    {
        $this->cleanUpTable( 'oxuser' );
        oxDb::getDb()->execute( "delete from oxremark where oxparentid = '_testUserId'" );
        oxDb::getDb()->execute( "delete from oxnewssubscribed where oxuserid = '_testUserId'" );
        parent::tearDown();
    }

    /**
     *  Check if login with special characters in login name and
     *  passworod works fine
     *
     *  M#1386
     *
     *  @return null
     */
    public function testLogin()
    {
        $oConfig = oxConfig::getInstance();

        $oUser = oxNew( "oxUser" );
        $oUser->setId( "_testUserId" );
        $oUser->oxuser__oxactive = new oxField( "1" );
        $oUser->oxuser__oxusername = new oxField( "&\"\'\\<>adminname" );
        $oUser->setPassword( "&\"\'\\<>adminpsw" );
        $oUser->save();

        $_SERVER['REQUEST_METHOD'] = "POST";
        $oConfig->setParameter( "user", "&\"\'\\<>adminname" );
        $oConfig->setParameter( "pwd", "&\"\'\\<>adminpsw" );

        $oLogin = $this->getProxyClass( 'login' );

        $this->assertEquals( "admin_start", $oLogin->checklogin() );
    }

    /**
     *  Check getting browser language abbervation
     *
     *  @return null
     */
    public function testGetBrowserLanguage()
    {
        $oLogin = $this->getProxyClass( 'login' );
        $_SERVER['HTTP_ACCEPT_LANGUAGE'] = "en-US,en;q=0.8,fr-ca;q=0.5,fr;q=0.3;";
        $this->assertEquals( "en", $oLogin->UNITgetBrowserLanguage() );
    }

    /**
     *  Check getting available admin interface languages
     *  when selected lang ID is not setted to cookie. Selected lang
     *  should be selected by detected lang in browser.
     *
     *  @return null
     */
    public function testGetAvailableLanguages_withoutCookies_DE()
    {
        $oLang = new stdClass();
        $oLang->sValue = "Deutsch";
        $oLang->sFile = "de";
        $oLang->blSelected = true;

        $aLanguages[0] = $oLang;

        $oLang = new stdClass();
        $oLang->sValue = "English";
        $oLang->sFile = "en";
        $oLang->blSelected = false;

        $aLanguages[1] = $oLang;

        $oLogin = $this->getMock( 'login', array( '_getBrowserLanguage' ) );
        $oLogin->expects( $this->once() )->method( '_getBrowserLanguage' )->will( $this->returnValue( 'de' ) );

        $this->assertEquals( $aLanguages, $oLogin->UNITgetAvailableLanguages() );
    }

    /**
     *  Check getting available admin interface languages
     *  when selected lang ID is not setted to cookie. Selected lang
     *  should be selected by detected lang in browser.
     *
     *  @return null
     */
    public function testGetAvailableLanguages_withoutCookies_EN()
    {
        $oLang = new stdClass();
        $oLang->sValue = "Deutsch";
        $oLang->sFile = "de";
        $oLang->blSelected = false;

        $aLanguages[0] = $oLang;

        $oLang = new stdClass();
        $oLang->sValue = "English";
        $oLang->sFile = "en";
        $oLang->blSelected = true;

        $aLanguages[1] = $oLang;

        $oLogin = $this->getMock( 'login', array( '_getBrowserLanguage' ) );
        $oLogin->expects( $this->once() )->method( '_getBrowserLanguage' )->will( $this->returnValue( 'en' ) );

        $this->assertEquals( $aLanguages, $oLogin->UNITgetAvailableLanguages() );
    }

    /**
     *  Check getting available admin interface languages
     *  when selected lang ID is setted to cookie. Selected lang
     *  should be selected by detected lang id in cookie.
     *
     *  @return null
     */
    public function testGetAvailableLanguages_withCookies_DE()
    {
        $oLang = new stdClass();
        $oLang->sValue = "Deutsch";
        $oLang->sFile = "de";
        $oLang->blSelected = true;

        $aLanguages[0] = $oLang;

        $oLang = new stdClass();
        $oLang->sValue = "English";
        $oLang->sFile = "en";
        $oLang->blSelected = false;

        $aLanguages[1] = $oLang;

        // browser lang does not affect selected lang when cookie is set
        $oLogin = $this->getMock( 'login', array( '_getBrowserLanguage' ) );
        $oLogin->expects( $this->once() )->method( '_getBrowserLanguage' )->will( $this->returnValue( 'en' ) );

        // DE lang id
        $_COOKIE["oxidadminlanguage"] = 0;
        $aLangs = $oLogin->UNITgetAvailableLanguages();
        $this->assertEquals( $aLanguages, $aLangs);
    }

    /**
     * Testing login::getViewId()
     *
     * @return null
     */
    public function testGetViewId()
    {
        $oView = new Login();
        $this->assertEquals( strtolower( "Login" ), $oView->getViewId() );
    }

    /**
     * Testing login::_authorize()
     *
     * @return null
     */
    public function testAuthorize()
    {
        $oView = new Login();
        $this->assertTrue( $oView->UNITauthorize() );
    }

    /**
     * Testing login::checklogin()
     *
     * @return null
     */
    public function testCheckloginSettingProfile()
    {
        oxTestModules::addFunction( 'oxuser', 'login', '{ throw new oxConnectionException(); }');
        oxTestModules::addFunction( 'oxUtils', 'logger', '{ return true; }');

        modConfig::setParameter( 'profile', "testProfile" );
        modSession::getInstance()->setVar( "aAdminProfiles", array( "testProfile" => array( "testValue" ) ) );

        $oView = new Login();
        $this->assertEquals( "admin_start", $oView->checklogin() );
        $this->assertEquals( array( "testValue" ), oxSession::getVar( "profile" ) );
    }

    /**
     * Testing login::checklogin()
     *
     * @return null
     */
    public function testCheckloginUserException()
    {
        oxTestModules::addFunction( 'oxuser', 'login', '{ throw new oxUserException(); }');

        $oView = $this->getMock( "Login", array( "addTplParam" ) );
        $oView->expects( $this->at( 0 ) )->method( 'addTplParam' )->with( $this->equalTo( "user" ) );
        $oView->expects( $this->at( 1 ) )->method( 'addTplParam' )->with( $this->equalTo( "pwd" ) );
        $oView->expects( $this->at( 2 ) )->method( 'addTplParam' )->with( $this->equalTo( "profile" ) );
        $this->assertNull( $oView->checklogin() );
    }

    /**
     * Testing login::checklogin()
     *
     * @return null
     */
    public function testCheckloginCookieException()
    {
        oxTestModules::addFunction( 'oxuser', 'login', '{ throw new oxCookieException(); }');

        $oView = $this->getMock( "Login", array( "addTplParam" ) );
        $oView->expects( $this->at( 0 ) )->method( 'addTplParam' )->with( $this->equalTo( "user" ) );
        $oView->expects( $this->at( 1 ) )->method( 'addTplParam' )->with( $this->equalTo( "pwd" ) );
        $oView->expects( $this->at( 2 ) )->method( 'addTplParam' )->with( $this->equalTo( "profile" ) );
        $this->assertNull( $oView->checklogin() );
    }

    /**
     * Testing login::render()
     *
     * @return null
     */
    public function testRender()
    {
        $oLang = new oxStdClass();
        $oLang->blSelected = true;

        $aLanguages = array( $oLang );

        $oViewConfig = $this->getMock( "oxViewConfig", array( "setViewConfigParam" ) );
        $oViewConfig->expects( $this->atLeastOnce() )->method( 'setViewConfigParam' );

        $oConfig = $this->getMock( "oxConfig", array( "isDemoShop" ) );
        $oConfig->expects( $this->atLeastOnce() )->method( 'isDemoShop' )->will( $this->returnValue( "true" ) );

        $oView = $this->getMock( "Login", array( "getConfig", "getViewConfig", "addTplParam", "_getAvailableLanguages" ), array(), '', false );
        $oView->expects( $this->atLeastOnce() )->method( 'getViewConfig' )->will( $this->returnValue( $oViewConfig ) );
        $oView->expects( $this->atLeastOnce() )->method( 'addTplParam' );
        $oView->expects( $this->atLeastOnce() )->method( 'getConfig' )->will( $this->returnValue( $oConfig ) );
        $oView->expects( $this->once() )->method( '_getAvailableLanguages' )->will( $this->returnValue( $aLanguages ) );

        $this->assertEquals( "login.tpl", $oView->render() );
    }
}
