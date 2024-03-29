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
 * @version   SVN: $Id: loginTest.php 44480 2012-04-27 13:44:32Z mindaugas.rimgaila $
 */

require_once realpath( "." ).'/unit/OxidTestCase.php';
require_once realpath( "." ).'/unit/test_config.inc.php';

/**
 * Testing login class.
 */
class Unit_Admin_loginTest extends OxidTestCase
{
    public function setUp()
    {
        modConfig::getInstance()->setAdminMode( true );
        return parent::setUp();
    }

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
        $this->setExpectedException( 'oxException', 'LOGIN_ERROR' );

        $oConfig = oxConfig::getInstance();

        $oUser = oxNew( "oxUser" );
        $oUser->setId( "_testUserId" );
        $oUser->oxuser__oxactive = new oxField( "1" );
        $oUser->oxuser__oxusername = new oxField( "&\"\'\\<>adminname", oxField::T_RAW );
        $oUser->setPassword( "&\"\'\\<>adminpsw" );
        $oUser->save();

        oxTestModules::addFunction( 'oxUtilsView', 'addErrorToDisplay', '{ throw new oxException($aA[0]); }' );
        oxTestModules::addFunction( 'oxUtilsServer', 'getOxCookie', '{ return array(\'test\'); }' );

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
        oxTestModules::addFunction( 'oxUtilsServer', 'getOxCookie', '{ return null; }');

        $oLang = new oxStdClass();
        $oLang->id = 0;
        $oLang->oxid = "de";
        $oLang->abbr = "de";
        $oLang->name = "Deutsch";
        $oLang->active = 1;
        $oLang->sort = 1;
        $oLang->selected = 1;

        $aLanguages[] = $oLang;

        $oLang = new oxStdClass();
        $oLang->id = 1;
        $oLang->oxid = "en";
        $oLang->abbr = "en";
        $oLang->name = "English";
        $oLang->active = 1;
        $oLang->sort = 2;
        $oLang->selected = 0;

        $aLanguages[] = $oLang;

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
        $oLang = new oxStdClass();
        $oLang->id = 0;
        $oLang->oxid = "de";
        $oLang->abbr = "de";
        $oLang->name = "Deutsch";
        $oLang->active = 1;
        $oLang->sort = 1;
        $oLang->selected = 0;

        $aLanguages[] = $oLang;

        $oLang = new oxStdClass();
        $oLang->id = 1;
        $oLang->oxid = "en";
        $oLang->abbr = "en";
        $oLang->name = "English";
        $oLang->active = 1;
        $oLang->sort = 2;
        $oLang->selected = 1;

        $aLanguages[] = $oLang;

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
        $oLang = new oxStdClass();
        $oLang->id = 0;
        $oLang->oxid = "de";
        $oLang->abbr = "de";
        $oLang->name = "Deutsch";
        $oLang->active = 1;
        $oLang->sort = 1;
        $oLang->selected = 0;

        $aLanguages[] = $oLang;

        $oLang = new oxStdClass();
        $oLang->id = 1;
        $oLang->oxid = "en";
        $oLang->abbr = "en";
        $oLang->name = "English";
        $oLang->active = 1;
        $oLang->sort = 2;
        $oLang->selected = 1;

        $aLanguages[] = $oLang;

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

        modConfig::setParameter('user', '\'"<^%&*aaa>');
        modConfig::setParameter('pwd', '<^%&*aaa>\'"');
        modConfig::setParameter('profile', '<^%&*aaa>\'"');
        $oView = $this->getMock( "Login", array( "addTplParam" ) );
        $oView->expects( $this->at( 0 ) )->method( 'addTplParam' )->with( $this->equalTo( "user" ), $this->equalTo( '&#039;&quot;&lt;^%&amp;*aaa&gt;' ) );
        $oView->expects( $this->at( 1 ) )->method( 'addTplParam' )->with( $this->equalTo( "pwd" ), $this->equalTo( '&lt;^%&amp;*aaa&gt;&#039;&quot;' ) );
        $oView->expects( $this->at( 2 ) )->method( 'addTplParam' )->with( $this->equalTo( "profile" ), $this->equalTo( '&lt;^%&amp;*aaa&gt;&#039;&quot;' ) );
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

        modConfig::setParameter('user', '\'"<^%&*aaa>');
        modConfig::setParameter('pwd', '<^%&*aaa>\'"');
        modConfig::setParameter('profile', '<^%&*aaa>\'"');
        $oView = $this->getMock( "Login", array( "addTplParam" ) );
        $oView->expects( $this->at( 0 ) )->method( 'addTplParam' )->with( $this->equalTo( "user" ), $this->equalTo( '&#039;&quot;&lt;^%&amp;*aaa&gt;' ) );
        $oView->expects( $this->at( 1 ) )->method( 'addTplParam' )->with( $this->equalTo( "pwd" ), $this->equalTo( '&lt;^%&amp;*aaa&gt;&#039;&quot;' ) );
        $oView->expects( $this->at( 2 ) )->method( 'addTplParam' )->with( $this->equalTo( "profile" ), $this->equalTo( '&lt;^%&amp;*aaa&gt;&#039;&quot;' ) );
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
