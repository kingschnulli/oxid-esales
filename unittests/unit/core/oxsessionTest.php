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
 * @version   SVN: $Id: oxsessionTest.php 27104 2010-04-09 09:13:43Z tomas $
 */

require_once realpath( "." ).'/unit/OxidTestCase.php';
require_once realpath( "." ).'/unit/test_config.inc.php';

class Unit_oxsessionTest_oxUtilsServer extends oxUtilsServer
{
    /**
     * $_COOKIE alternative for testing
     *
     * @var unknown_type
     */
    protected $_aCookieVars = array();

    public function setOxCookie( $sVar, $sVal = "", $iExpire = 0, $sPath = '/', $sDomain = null )
    {
        //unsetting cookie
        if (!isset($sVar) && !isset($sVal)) {
            $this->_aCookieVars = null;
            return;
        }

        $this->_aCookieVars[$sVar] = $sVal;
    }

    public function getOxCookie( $sVar = null )
    {
        if (!$sVar)
            return $this->_aCookieVars;

        if ($this->_aCookieVars[$sVar])
            return $this->_aCookieVars[$sVar];

        return null;
    }

    public function delOxCookie()
    {
        $this->_aCookieVars = null;
    }
}
class Unit_oxsessionTest_oxUtilsObject extends oxUtilsObject
{
    /**
     * Overriding original oxUtilsObject::generateUID()
     *
     * @return unknown
     */
    public function generateUid()
    {
        return "testsession";
    }
}

/**
 * oxSession child for testing
 */
class testSession extends oxSession
{
    /**
     * Keeps test session vars
     *
     * @var unknown_type
     */
    static protected  $_aSessionVars = array();

    /**
     * Set session var for testing
     *
     * @param string $sVar
     * @param string $sVal
     */
    static public function setVar($sVar, $sVal)
    {
        self::$_aSessionVars[$sVar] = $sVal;
        //parent::setVar($sVar, $sVal);
    }

    /**
     * Gets session var for testing
     *
     * @param string $sVar
     * @return unknown
     */
    static public function getVar($sVar)
    {
        if (isset( self::$_aSessionVars[$sVar]))
            return self::$_aSessionVars[$sVar];

        return parent::getVar($sVar);
    }

    /**
     * Deletes test var $sVar
     *
     * @param string $sVar
     */
    static public function deleteVar($sVar)
    {
        unset($this->_aSessionVars[$sVar]);
    }

    /**
     * Checks protected $this->_blNewSession var
     *
     * @return bool
     */
    public function isNewSession()
    {
        return $this->_blNewSession;
    }

    /**
     * Initialize session data (calls php::session_start())
     *
     * @return null
     */
    protected function _sessionStart()
    {
        //return @session_start();
    }
}



/**
 * Testing oxsession class
 */
class Unit_Core_oxsessionTest extends OxidTestCase
{

    /**
     * Set session save path value if session.save_path value in php.ini is empty
    */
    public $sDefaultSessSavePath = '';

    /**
     * Internal oxSession instance
     *
     */
    public $oSession = null;

    /**
     * Original oxConfig instance
     *
     * @var unknown_type
     */
    protected $_oOriginalConfig = null;

    /**
     * Initialize the fixture.
     *
     * @return null
     */
    protected function setUp()
    {
        parent::setUp();
        //creating new instance
        $this->oSession = new testSession();
    }

    /**
     * Tear down the fixture.
     *
     * @return null
     */
    protected function tearDown()
    {
        $oDB = oxDb::getDb();
        $sDelete = "DROP TABLE IF EXISTS oxsessions";
        $oDB->Execute( $sDelete);

        //removing oxUtils module
        oxRemClassModule('testUtils');
        oxRemClassModule('Unit_oxsessionTest_oxUtilsServer');
        oxRemClassModule('Unit_oxsessionTest_oxUtilsObject');

        $this->oSession->freeze();

        parent::tearDown();
    }

    /**
     * Test for oxSession::start()
     *
     * @return null
     */
    public function testStartWhenDebugisOnAndErrorMessageExpected()
    {
        modConfig::getInstance()->setConfigParam( 'iDebug', 1 );
        modConfig::setParameter( "sid", "testSid" );

        modSession::getInstance()->setVar('sessionagent', 'oldone');

        oxTestModules::addFunction( "oxUtils", "isSearchEngine", "{return false;}" );
        oxTestModules::addFunction( "oxUtilsServer", "isTrustedClientIp", "{return false;}" );
        oxTestModules::addFunction( "oxUtilsServer", "getServerVar", "{return 'none';}" );

        $oSession = $this->getMock( "oxSession", array( "_allowSessionStart", "initNewSession", "_setSessionId", "_sessionStart" ) );
        $oSession->expects( $this->any() )->method( '_allowSessionStart')->will( $this->returnValue( true ) );
        $oSession->expects( $this->any() )->method( 'initNewSession');
        $oSession->expects( $this->any() )->method( '_setSessionId');
        $oSession->expects( $this->any() )->method( '_sessionStart');
        $oSession->start();

        $aErrors = oxSession::getVar( 'Errors' );

        $this->assertTrue( is_array( $aErrors ) );
        $this->assertEquals( 1, count( $aErrors ) );

        $oExcp = unserialize( current( $aErrors['default'] ));
        $this->assertNotNull( $oExcp );
        $this->assertTrue( $oExcp instanceof oxExceptionToDisplay );
        $this->assertEquals( "Different browser (oldone, none), creating new SID...<br>", $oExcp->getOxMessage() );
    }

    public function testIsSidNeededPassingCustomUrl()
    {
        $sUrl = "someurl";

        $oConfig = $this->getMock( "oxconfig", array( "isCurrentUrl" ) );
        $oConfig->expects( $this->once() )->method( 'isCurrentUrl')->with( $this->equalTo( $sUrl ) )->will( $this->returnValue( false ) );

        $oSession = $this->getMock( "oxSession", array( "getConfig" ) );
        $oSession->expects( $this->once() )->method( 'getConfig')->will( $this->returnValue( $oConfig ) );
        $this->assertTrue( $oSession->isSidNeeded( $sUrl ) );
    }

    public function testAllowSessionStartWhenSearchEngine()
    {
        oxTestModules::addFunction( "oxUtils", "isSearchEngine", "{return true;}" );
        modConfig::setParameter( 'skipSession', 0 );

        $oSession = new oxSession();
        $this->assertFalse( $oSession->UNITallowSessionStart() );
    }

    public function testAllowSessionStartIsAdmin()
    {
        $oSession = $this->getMock( 'oxSession', array( 'isAdmin' ) );
        $oSession->expects( $this->atLeastOnce() )->method( 'isAdmin')->will( $this->returnValue( true ) );
        $this->assertTrue( $oSession->UNITallowSessionStart() );
    }

    public function testAllowSessionStartWhenSkipSessionParam()
    {
        oxTestModules::addFunction( "oxUtils", "isSearchEngine", "{return false;}" );
        modConfig::setParameter( 'skipSession', 1 );

        $oSession = new oxSession();
        $this->assertFalse( $oSession->UNITallowSessionStart() );
    }

    public function testAllowSessionStartSessionRequiredAction()
    {
        oxTestModules::addFunction( "oxUtils", "isSearchEngine", "{return false;}" );
        modConfig::setParameter( 'skipSession', 0 );

        $oSession = $this->getMock( 'oxSession', array( '_isSessionRequiredAction' ) );
        $oSession->expects( $this->atLeastOnce() )->method( '_isSessionRequiredAction')->will( $this->returnValue( true ) );
        $this->assertTrue( $oSession->UNITallowSessionStart() );
    }

    public function testAllowSessionStartCookieIsFoundMustStart()
    {
        oxTestModules::addFunction( "oxUtils", "isSearchEngine", "{return false;}" );
        oxTestModules::addFunction( "oxUtilsServer", "getOxCookie", "{return true;}" );
        modConfig::setParameter( 'skipSession', 0 );

        $oSession = $this->getMock( 'oxSession', array( '_isSessionRequiredAction' ) );
        $oSession->expects( $this->any() )->method( '_isSessionRequiredAction')->will( $this->returnValue( false ) );
        $this->assertTrue( $oSession->UNITallowSessionStart() );
    }

    public function testAllowSessionStartRequestContainsSidParameter()
    {
        oxTestModules::addFunction( "oxUtils", "isSearchEngine", "{return false;}" );
        oxTestModules::addFunction( "oxUtilsServer", "getOxCookie", "{return true;}" );
        modConfig::setParameter( 'skipSession', 0 );
        modConfig::setParameter( 'sid', 'xxx' );

        $oSession = $this->getMock( 'oxSession', array( '_isSessionRequiredAction' ) );
        $oSession->expects( $this->any() )->method( '_isSessionRequiredAction')->will( $this->returnValue( false ) );
        $this->assertTrue( $oSession->UNITallowSessionStart() );
    }

    public function testProcessUrlSidIsNotNeeded()
    {
        $oSession = $this->getMock( 'oxsession', array( 'isSidNeeded' ) );
        $oSession->expects( $this->once() )->method( 'isSidNeeded')->will( $this->returnValue( false ) );
        $this->assertEquals( 'sameurl', $oSession->processUrl( 'sameurl' ) );
    }

    public function testProcessUrlSidNeeded()
    {
        $oSession = $this->getMock( 'oxsession', array( 'isSidNeeded', 'sid' ) );
        $oSession->expects( $this->once() )->method( 'isSidNeeded')->will( $this->returnValue( true ) );
        $oSession->expects( $this->once() )->method( 'sid')->will( $this->returnValue( 'sid=xxx' ) );
        $this->assertEquals( 'sameurl?sid=xxx&amp;', $oSession->processUrl( 'sameurl' ) );
    }

    public function testProcessUrlSidNeededButNotEgzisting()
    {
        $oSession = $this->getMock( 'oxsession', array( 'isSidNeeded', 'sid' ) );
        $oSession->expects( $this->once() )->method( 'isSidNeeded')->will( $this->returnValue( true ) );
        $oSession->expects( $this->once() )->method( 'sid')->will( $this->returnValue( '' ) );
        $this->assertEquals( 'sameurl', $oSession->processUrl( 'sameurl' ) );
    }

    public function testIsSidNeededForceSessionStart()
    {
        oxTestModules::addFunction( "oxUtils", "isSearchEngine", "{return false;}" );
        oxTestModules::addFunction( "oxUtilsServer", "getOxCookie", "{return false;}" );

        $oSession = $this->getMock( 'oxsession', array( '_forceSessionStart' )  );
        $oSession->expects( $this->once() )->method( '_forceSessionStart')->will( $this->returnValue( true ) );
        $this->assertTrue( $oSession->isSidNeeded() );
    }

    public function testIsSidNeededWhenSearchEngine()
    {
        oxTestModules::addFunction( "oxUtils", "isSearchEngine", "{return true;}" );

        $oSession = new oxsession();
        $this->assertFalse( $oSession->isSidNeeded() );
    }

    public function testIsSidNeededCookieFound()
    {
        oxTestModules::addFunction( "oxUtils", "isSearchEngine", "{return false;}" );
        oxTestModules::addFunction( "oxUtilsServer", "getOxCookie", "{return true;}" );

        $oSession = new oxsession();
        $this->assertFalse( $oSession->isSidNeeded() );
    }

    public function testIsSidNeededWithSessionMarker()
    {
        oxTestModules::addFunction( "oxUtils", "isSearchEngine", "{return false;}" );
        oxTestModules::addFunction( "oxUtilsServer", "getOxCookie", "{return false;}" );

        modSession::getInstance()->setVar( 'blSidNeeded', true );

        $oSession = new oxsession();
        $this->assertTrue( $oSession->isSidNeeded() );
    }

    public function testIsSidNeededSpecialAction()
    {
        oxTestModules::addFunction( "oxUtils", "isSearchEngine", "{return false;}" );
        oxTestModules::addFunction( "oxUtilsServer", "getOxCookie", "{return false;}" );

        modSession::getInstance()->setVar( 'blSidNeeded', false );
        modConfig::setParameter( 'fnc', 'tobasket' );

        $oSession = new oxsession();
        $this->assertTrue( $oSession->isSidNeeded() );
        $this->assertTrue( oxSession::getVar( 'blSidNeeded' ) );
    }

    public function testIsSidNeededRegularPageViewNoSessionNeeded()
    {
        oxTestModules::addFunction( "oxUtils", "isSearchEngine", "{return false;}" );
        oxTestModules::addFunction( "oxUtilsServer", "getOxCookie", "{return false;}" );

        modSession::getInstance()->setVar( 'blSidNeeded', false );

        $oSession = new oxsession();
        $this->assertFalse( $oSession->isSidNeeded() );
    }

    public function testIsSessionRequiredActionNoSpecialAction()
    {
        modConfig::setParameter( 'fnc', 'nothingspecial' );

        $oSession = new oxsession();
        $this->assertFalse( $oSession->UNITisSessionRequiredAction() );
    }

    public function testIsSessionRequiredActionRequired()
    {
        modConfig::setParameter( 'fnc', 'tobasket' );

        $oSession = new oxsession();
        $this->assertTrue( $oSession->UNITisSessionRequiredAction() );
    }

    /**
     * oxSession::start() test for admin login
     *
     */
    public function testStartAdmin()
    {
        $this->oSession = $this->getMock( 'testSession', array( 'isAdmin' ) );
        $this->oSession->expects( $this->any() )->method( 'isAdmin')->will( $this->returnValue( true ) );
        $this->assertNull($this->oSession->getId());
        $this->assertEquals($this->oSession->getName(), 'sid');
        $this->oSession->start();
        $this->assertNotNull($this->oSession->getId());
        $this->assertEquals($this->oSession->getName(), 'admin_sid');
        //oxConfig::getInstance()->blAdmin = false;
    }

    /**
     * oxSession::start() test for non admin login
     *
     */
    public function testStartNonAdmin()
    {
        $this->oSession = $this->getMock( 'testSession', array( 'isAdmin', '_allowSessionStart' ) );
        $this->oSession->expects( $this->any() )->method( 'isAdmin')->will( $this->returnValue( false ) );
        $this->oSession->expects( $this->any() )->method( '_allowSessionStart')->will( $this->returnValue( true ) );
        $this->assertNull($this->oSession->getId());
        $this->assertEquals($this->oSession->getName(), 'sid');
        $this->oSession->start();
        $this->assertNotNull($this->oSession->getId());
        $this->assertEquals($this->oSession->getName(), 'sid');
    }

    /**
     * oxSession::start() test for non admin login
     *
     */
    public function testStartDoesNotGenerateSidIfNotNeeded()
    {
        $this->oSession = $this->getMock( 'testSession', array( '_allowSessionStart' ) );
        $this->oSession->expects( $this->any() )->method( '_allowSessionStart')->will( $this->returnValue( false ) );
        $this->assertNull($this->oSession->getId());
        $this->assertEquals($this->oSession->getName(), 'sid');
        $this->oSession->start();
        $this->assertNull($this->oSession->getId());
        $this->assertEquals($this->oSession->getName(), 'sid');
    }

    /**
     * oxSession::start() test forcing sid
     *
     */
    public function testStartSetsSidPriority()
    {
        oxAddClassModule('Unit_oxsessionTest_oxUtilsServer', 'oxUtilsServer');
        $this->oSession = $this->getMock( 'testSession', array( 'isAdmin' ) );
        $this->oSession->expects( $this->any() )->method( 'isAdmin')->will( $this->returnValue( false ) );
        //set parameter
        modConfig::setParameter('sid', 'testSid1');
        $this->oSession->start();
        $this->assertEquals($this->oSession->getId(), 'testSid1');

        //set cookie
        oxUtilsServer::getInstance()->setOxCookie('sid', 'testSid2');
        oxConfig::getInstance()->setConfigParam( 'blSessionUseCookies', true );
        $this->oSession->start();
        $this->assertEquals($this->oSession->getId(), 'testSid2');

        //forcing sid (ususally for SSL<->nonSSL transitions)
        modConfig::setParameter('force_sid', 'testSid3');
        $this->oSession->start();
        $this->assertEquals($this->oSession->getId(), 'testSid3');

        //reset params
        modConfig::setParameter('sid', null);
        oxUtilsServer::getInstance()->setOxCookie('sid', null);
        $this->oSession->setVar('force_sid', null);
    }

    /**
     * oxSession::start() test forcing sid
     *
     */
    public function testStartSetsNewSid()
    {
        oxAddClassModule('Unit_oxsessionTest_oxUtilsServer', 'oxUtilsServer');
        $this->oSession = $this->getMock( 'testSession', array( 'isAdmin', 'initNewSession' ) );
        $this->oSession->expects( $this->any() )->method( 'isAdmin')->will( $this->returnValue( true ) );
        $this->oSession->expects( $this->any() )->method( 'initNewSession');
        $this->oSession->setId('xxxx');
        $this->assertEquals('xxxx', $this->oSession->getId());
        $this->oSession->start();
        $this->assertNotEquals('xxxx', $this->oSession->getId());
    }

    /**
     * oxSession::start() cookies not available
     *
     */
    public function testStartCookiesNotAvailable()
    {
        oxAddClassModule('Unit_oxsessionTest_oxUtilsServer', 'oxUtilsServer');
        $this->oSession = $this->getMock( 'testSession', array( 'isAdmin', '_getCookieSid', '_isSwappedClient', '_allowSessionStart' ) );
        $this->oSession->expects( $this->any() )->method( 'isAdmin')->will( $this->returnValue( false ) );
        $this->oSession->expects( $this->any() )->method( '_getCookieSid')->will( $this->returnValue( false ) );
        $this->oSession->expects( $this->any() )->method( '_isSwappedClient')->will( $this->returnValue( true ) );
        $this->oSession->expects( $this->any() )->method( '_allowSessionStart')->will( $this->returnValue( true ) );
        modConfig::setParameter('force_sid', 'testSid3');
        $this->oSession->start();
        $this->assertNotEquals($this->oSession->getId(), 'testSid3');
    }

    /**
     * oxsession::allowSessionStart() test for normal case
     */
    function testAllowSessionStartNormal()
    {
        $this->assertFalse($this->oSession->UNITallowSessionStart());
    }

    function testAllowSessionStartNormalForced()
    {
        modConfig::getInstance()->setConfigParam( 'blForceSessionStart', 1 );
        $this->assertTrue($this->oSession->UNITallowSessionStart());
    }

    /**
     * oxsession::allowSessionStart() test for search engines
     */
    function testAllowSessionStartForSearchEngines()
    {
        oxConfig::getInstance()->setGlobalParameter( 'blIsSearchEngine', true );
        $this->assertFalse($this->oSession->UNITallowSessionStart());
        oxConfig::getInstance()->setGlobalParameter( 'blIsSearchEngine', false );
    }

    /**
     * oxsession::allowSessionStart() test forcing skip
     */
    function testAllowSessionStartForceSkip()
    {
        modConfig::setParameter('skipSession', true);
        $this->assertFalse($this->oSession->UNITallowSessionStart());
        modConfig::setParameter('skipSession', false);
    }

    /**
     * oxsession::isSwappedClient() normal calse
     */
    function testIsSwappedClientNormal()
    {
        $this->assertFalse($this->oSession->UNITisSwappedClient());
    }

    /**
     * oxsession::isSwappedClient() for search engines
     */
    function testIsSwappedClientForSearchEngines()
    {
        oxConfig::getInstance()->setGlobalParameter( 'blIsSearchEngine', true );
        $this->assertFalse($this->oSession->UNITisSwappedClient());
        oxConfig::getInstance()->setGlobalParameter( 'blIsSearchEngine', false );
    }

    /**
     * oxsession::isSwappedClient() as for differnet clients
     */
    function testIsSwappedClientAsDifferentUserAgent()
    {
        $oSubj = $this->getMock("oxSession", array('_checkUserAgent'));
        $oSubj->expects($this->any())->method('_checkUserAgent')->will($this->returnValue(true));
        $this->assertTrue( $oSubj->UNITisSwappedClient() );
    }

    /**
     * oxsession::isSwappedClient() as for differnet clients with correct token
     */
    function testIsSwappedClientAsDifferentUserAgentCorrectToken()
    {
        modConfig::getInstance()->setParameter('rtoken', 'test1');

        $oSubj = $this->getMock("oxSession", array('_checkUserAgent'));
        $oSubj->expects($this->any())->method('_checkUserAgent')->will($this->returnValue(true));
        $oSubj->setVar('_rtoken', 'test1');
        $this->assertFalse( $oSubj->UNITisSwappedClient() );
    }

    /**
     * oxsession::isSwappedClient() as for differnet clients
     */
    function testIsSwappedClientAsDifferentClientIfRemoteAccess()
    {
        $this->assertTrue($this->oSession->UNITcheckUserAgent( 'browser1', 'browser2' ));
    }

    /**
     * oxsession::isSwappedClient() as timeout for normal user
     */
     /*
    function testIsSwappedClientAsTimeoutForUser()
    {
        $this->oSession = $this->getMock( 'testSession', array( 'isAdmin' ) );
        $this->oSession->expects( $this->any() )->method( 'isAdmin')->will( $this->returnValue( false ) );
        oxAddClassModule( 'modOxUtilsDate', 'oxUtilsDate' );
        oxUtilsDate::getInstance()->UNITSetTime( 100 );
        modConfig::setConfigParam('iSessionTimeout', 10);
        $this->oSession->setVar( "sessiontimestamp", 10);
        $this->assertFalse($this->oSession->UNITcheckByTimeOut());

        //large delay
        oxUtilsDate::getInstance()->UNITSetTime( 1000 );
        $this->assertTrue($this->oSession->UNITcheckByTimeOut());
        modConfig::setConfigParam('iSessionTimeout', null);
    }*/

    /**
     * oxsession::isSwappedClient() as timeout for normal user
     * if session timeout is not set
     */
     /*
    function testIsSwappedClientAsTimeoutForUserIfSessTimeoutNotSet()
    {
        $this->oSession = $this->getMock( 'testSession', array( 'isAdmin' ) );
        $this->oSession->expects( $this->any() )->method( 'isAdmin')->will( $this->returnValue( false ) );
        oxAddClassModule( 'modOxUtilsDate', 'oxUtilsDate' );
        oxUtilsDate::getInstance()->UNITSetTime( 60 );
        $this->oSession->setVar( "sessiontimestamp", 10);
        $this->assertFalse($this->oSession->UNITcheckByTimeOut());

        //large delay
        oxUtilsDate::getInstance()->UNITSetTime( 4000 );
        $this->assertTrue($this->oSession->UNITcheckByTimeOut());
    }*/

    /**
     * oxsession::isSwappedClient() as timeout for admin
     */
     /*
    function testIsSwappedClientAsTimeoutForAdmin()
    {
        $this->oSession = $this->getMock( 'testSession', array( 'isAdmin' ) );
        $this->oSession->expects( $this->any() )->method( 'isAdmin')->will( $this->returnValue( true ) );
        oxAddClassModule( 'modOxUtilsDate', 'oxUtilsDate' );
        oxUtilsDate::getInstance()->UNITSetTime( 60 );
        $this->oSession->setVar( "sessiontimestamp", 10);
        modConfig::setConfigParam('iSessionTimeoutAdmin', 10);
        $this->assertFalse($this->oSession->UNITcheckByTimeOut());

        //large delay
        oxUtilsDate::getInstance()->UNITSetTime( 4000 );
        $this->assertTrue($this->oSession->UNITcheckByTimeOut());
    }*/

    /**
     * oxsession::isSwappedClient() cookie check test is performed
     */
    function testIsSwappedClientSidCheck()
    {
        $oDB = oxDb::getDb();
        $sInsert = "CREATE TABLE `oxsessions` (
                `ID` int( 11 ) NOT NULL AUTO_INCREMENT ,
                `SessionID` varchar( 64 ) default NULL ,
                `session_data` text,
                `expiry` int( 11 ) default NULL ,
                `expireref` varchar( 64 ) default NULL ,
                PRIMARY KEY ( `ID` ) ,
                KEY `SessionID` ( `SessionID` ) ,
                KEY `expiry` ( `expiry` )
                )";
        $oDB->Execute( $sInsert );
        $this->assertTrue($this->oSession->UNITcheckSid());

        $sInsert = "INSERT INTO `oxsessions` ( `SessionID` ) VALUES ( 'sessiontest' )";
        $oDB->Execute( $sInsert );

        $oSession = $this->getMock( 'testSession', array( 'getId' ) );
        $oSession->expects( $this->any() )->method( 'getId')->will( $this->returnValue( 'sessiontest' ) );
        $this->assertFalse($oSession->UNITcheckSid());
    }

    /**
     * oxsession::isSwappedClient() cookie check test is performed
     */
    function testIsSwappedClientCookieCheck()
    {
        $myConfig  = oxConfig::getInstance();
        oxAddClassModule('Unit_oxsessionTest_oxUtilsServer', 'oxUtilsServer');
        $this->assertFalse( $this->oSession->UNITcheckCookies( null, null) );
        $this->assertEquals( "oxid", oxUtilsServer::getInstance()->getOxCookie( 'sid_key' ) );
        $this->assertFalse( $this->oSession->UNITcheckCookies( "oxid", null) );
        $aSessCookSet = $this->oSession->getVar( "sessioncookieisset");
        $this->assertEquals( "ox_true", $aSessCookSet[$myConfig->getCurrentShopURL()] );
        $this->assertFalse( $this->oSession->UNITcheckCookies( "oxid", "ox_true" ) );
        $this->assertTrue( $this->oSession->UNITcheckCookies( null, "ox_true" ) );
        $this->assertEquals( "oxid", oxUtilsServer::getInstance()->getOxCookie( 'sid_key' ) );

        modConfig::getInstance()->setConfigParam('blSessionUseCookies', 1);
        $oSession = $this->getMock( 'testSession', array( '_checkCookies' ) );
        $oSession->expects( $this->once() )->method( '_checkCookies');
        $oSession->UNITisSwappedClient();

        modConfig::getInstance()->setConfigParam('blSessionUseCookies', 0);
        $oSession = $this->getMock( 'testSession', array( '_checkCookies' ) );
        $oSession->expects( $this->never() )->method( '_checkCookies');
        $oSession->UNITisSwappedClient();
    }

    /**
     * oxsession::intiNewSesssion() test
     */
    function testInitNewSession()
    {
        $myConfig  = oxConfig::getInstance();
       //init ID generator
        oxAddClassModule('Unit_oxsessionTest_oxUtilsObject', 'oxUtilsObject');
        $sMyHash = md5('testsession');

        $this->oSession->setVar('someVar1', true);
        $this->oSession->setVar('someVar2', 15);
        $this->oSession->setVar('actshop', 5);
        $this->oSession->setVar('lang', 3);
        $this->oSession->setVar('currency', 3);
        $this->oSession->setVar('language', 12);
        $this->oSession->setVar('tpllanguage', 12);

        $sOldSid = $this->oSession->getId();

        $this->oSession->InitNewSession();

        //most sense is to perform this check
        //if session id was changed
        $this->assertNotEquals($sOldSid, $this->oSession->getId());

        //checking if new id is correct (md5($newid))
        $this->assertEquals($this->oSession->getId(), $sMyHash);

        //$this->assertNotEquals($this->oSession->getVar('someVar1'), true);
        //$this->assertNotEquals($this->oSession->getVar('someVar2'), 15);
        $this->assertEquals($this->oSession->getVar('actshop'), 5);
        $this->assertEquals($this->oSession->getVar('lang'), 3);
        $this->assertEquals($this->oSession->getVar('currency'), 3);
        $this->assertEquals($this->oSession->getVar('language'), 12);
        $this->assertEquals($this->oSession->getVar('tpllanguage'), 12);

        $this->oSession->setVar('someVar1', null);
        $this->oSession->setVar('someVar2', null);
        $this->oSession->setVar('actshop', null);
        $this->oSession->setVar('lang', null);
        $this->oSession->setVar('currency', null);
        $this->oSession->setVar('language', $myConfig->sDefaultLang);
        $this->oSession->setVar('tpllanguage', null);
    }

    /**
     * oxsession::intiNewSesssion() test
     */
    function testInitNewSessionWithPersParams()
    {
        $myConfig  = oxConfig::getInstance();
       //init ID generator
        oxAddClassModule('Unit_oxsessionTest_oxUtilsObject', 'oxUtilsObject');
        $sMyHash = md5('testsession');

        $this->oSession->setVar('someVar1', true);
        $this->oSession->setVar('someVar2', 15);
        $this->oSession->setVar('actshop', 5);
        $this->oSession->setVar('lang', 3);
        $this->oSession->setVar('currency', 3);
        $this->oSession->setVar('language', 12);
        $this->oSession->setVar('tpllanguage', 12);

        $sOldSid = $this->oSession->getId();

        $this->oSession->InitNewSession();

        //most sense is to perform this check
        //if session id was changed
        $this->assertNotEquals($sOldSid, $this->oSession->getId());

        //checking if new id is correct (md5($newid))
        $this->assertEquals($this->oSession->getId(), $sMyHash);

        //$this->assertNotEquals($this->oSession->getVar('someVar1'), true);
        //$this->assertNotEquals($this->oSession->getVar('someVar2'), 15);
        $this->assertEquals($this->oSession->getVar('actshop'), 5);
        $this->assertEquals($this->oSession->getVar('lang'), 3);
        $this->assertEquals($this->oSession->getVar('currency'), 3);
        $this->assertEquals($this->oSession->getVar('language'), 12);
        $this->assertEquals($this->oSession->getVar('tpllanguage'), 12);

        $this->oSession->setVar('someVar1', null);
        $this->oSession->setVar('someVar2', null);
        $this->oSession->setVar('actshop', null);
        $this->oSession->setVar('lang', null);
        $this->oSession->setVar('currency', null);
        $this->oSession->setVar('language', $myConfig->sDefaultLang);
        $this->oSession->setVar('tpllanguage', null);
    }

    /**
     * oxsession::setSessionId() test. Normal case
     */
    function testSetSessionIdNormal()
    {
        oxTestModules::addFunction( "oxUtilsServer", "getOxCookie", "{return true;}" );
        modConfig::getInstance()->setConfigParam( 'blForceSessionStart', 0 );

        $this->assertFalse($this->oSession->isNewSession());

        $this->oSession->start();
        $this->assertEquals($this->oSession->getName(), 'sid');
        $this->oSession->UNITsetSessionId('testSid');

        $this->assertEquals( $this->oSession->getId(), 'testSid');
        $this->assertTrue( $this->oSession->isNewSession() );

        //reset session
        $this->oSession->initNewSession();
        $this->assertNotEquals( 'testSid', $this->oSession->getId() );
    }

    function testSetSessionIdSkipCookies()
    {
        oxTestModules::addFunction('oxUtilsServer', 'setOxCookie', '{throw new Exception("may not! (set cookies while they are turned off)");}');

        modConfig::getInstance()->setConfigParam('blSessionUseCookies', 0);
        $oSession = $this->getMock( 'testSession', array( '_allowSessionStart' ) );
        $oSession->expects( $this->once() )->method( '_allowSessionStart')->will($this->returnValue(false));
        $oSession->UNITsetSessionId('test');

        $oSession = $this->getMock( 'testSession', array( '_allowSessionStart' ) );
        $oSession->expects( $this->once() )->method( '_allowSessionStart')->will($this->returnValue(true));
        $oSession->UNITsetSessionId('test');
    }

    function testSetSessionIdForced()
    {
        oxAddClassModule('Unit_oxsessionTest_oxUtilsServer', 'oxUtilsServer');
        modConfig::getInstance()->setConfigParam( 'blForceSessionStart', 1 );

        $this->assertFalse($this->oSession->isNewSession());

        $this->oSession->start();
        $this->assertEquals($this->oSession->getName(), 'sid');
        $this->oSession->UNITsetSessionId('testSid');

        $this->assertEquals($this->oSession->getId(), 'testSid');
        $this->assertTrue($this->oSession->isNewSession());
        $this->assertEquals(oxUtilsServer::getInstance()->getOxCookie($this->oSession->getName()), 'testSid');

        //reset session
        $this->oSession->InitNewSession();
        $this->assertNotEquals( 'testSid', $this->oSession->getId() );
    }

    /**
     * oxsession::setSessionId() test. Admin
     */
    function testSetSessionIdAdmin()
    {
        oxTestModules::addFunction( "oxUtilsServer", "getOxCookie", "{return true;}" );

        $oSession = $this->getMock( 'testSession', array( 'isAdmin', '_sessionStart' ) );
        $oSession->expects( $this->any() )->method( 'isAdmin')->will( $this->returnValue( true ) );
        $oSession->expects( $this->any() )->method( '_sessionStart')->will( $this->returnValue( true ) );
        $this->assertFalse($oSession->isNewSession());

        $oSession->start();
        //session name is different..
        $this->assertEquals($oSession->getName(), 'admin_sid');
        $oSession->UNITsetSessionId('testSid');

        //..but still eveything is set
        $this->assertEquals($oSession->getId(), 'testSid');
        $this->assertTrue($oSession->isNewSession());
        $this->assertEquals(oxUtilsServer::getInstance()->getOxCookie($this->oSession->getName()), 'testSid');

        //reset session
        $oSession->InitNewSession();
        $this->assertNotEquals($oSession->getId(), 'testSid');
    }

    /**
     * oxsession::setSessionId() test. For search engines.
     */
    function testSetSessionIdSearchEngines()
    {
        oxAddClassModule('Unit_oxsessionTest_oxUtilsServer', 'oxUtilsServer');
        oxConfig::getInstance()->setGlobalParameter( 'blIsSearchEngine', true );

        $this->assertFalse($this->oSession->isNewSession());

        $this->oSession->start();
        $this->assertEquals($this->oSession->getName(), 'sid');
        $this->oSession->UNITsetSessionId('testSid');

        $this->assertEquals($this->oSession->getId(), 'testSid');
        $this->assertTrue($this->oSession->isNewSession());
        //have no cookie as search engine
        $this->assertEquals(oxUtilsServer::getInstance()->getOxCookie($this->oSession->getName()), null);

        //reset session
        $this->oSession->InitNewSession();
        $this->assertNotEquals($this->oSession->getId(), 'testSid');

        //teardown
        oxConfig::getInstance()->setGlobalParameter( 'blIsSearchEngine', false );
    }

    /**
     * oxsession::checkMandatoryCookieSupport() test. Normal case. not critical action.
     */
    /*function testCheckMandatoryCookieSupportNormal()
    {
        oxConfig::getInstance()->setConfigParam( 'blSessionEnforceCookies', false );
        $this->assertTrue($this->oSession->UNITcheckMandatoryCookieSupport( "account", "tobasket"));
    }*/

    /**
     * oxsession::checkMandatoryCookieSupport() test in critical action when cookies are supported
     */
    /*function testCheckMandatoryCookieSupportCookiesSupported()
    {
        oxConfig::getInstance()->setConfigParam( 'blSessionEnforceCookies', true );
        $this->assertFalse($this->oSession->UNITcheckMandatoryCookieSupport( 'register', '' ));
        $this->assertFalse($this->oSession->UNITcheckMandatoryCookieSupport( 'account', ''));
        $this->assertFalse($this->oSession->UNITcheckMandatoryCookieSupport( 'alist', 'tobasket'));
        $this->assertFalse($this->oSession->UNITcheckMandatoryCookieSupport( 'details', 'login_noredirect'));
    }*/

    /**
     * oxsession::freeze() test
     */
    function testFreeze()
    {
        //noting to test here as oxSession::freeze() includes only PHP session functionality
        //testing at least if this method exists by just calling it
        $testSession = new oxSession();
        $testSession->freeze();
    }

    /**
     * This functionality is not testable, as session data setter/getter is handled by modSession methods
     *
     * oxsession::destroy() test
     *
    function testDestroyAndHasVar()
    {

        //taking real session object
        /*
        $testSession = new oxSession();
        modConfig::setParameter( "remoteaccess", true);
        $testSession->start();
        $testSession->setVar('testVar', 'testVal');
        $this->assertTrue($testSession->hasVar('testVar'));
        $testSession->setVar('testVar2', null);
        $this->assertFalse($testSession->hasVar('testVar2'));
        $testSession->destroy();
        $this->assertFalse($testSession->hasVar('testVar'));
    }*/

    /**
     * oxsession::setVar() test
     */
    function testSetHasGetVar()
    {
        //taking real session object
        $testSession = new oxSession();
        $testSession->setVar('testVar', 'testVal');
        $this->assertTrue( $testSession->hasVar('testVar'));
        $this->assertEquals( 'testVal', $testSession->getVar('testVar'));
    }

    /**
     * This functionality is not testable, as session data setter/getter is handled by modSession methods
     *
     * oxsession::deletVar() test
     *
    function testDeleteVar()
    {
        //taking real session object
        $testSession = new oxSession();
        $testSession->setVar( 'testVar', 'testVal');
        $this->assertTrue( $testSession->hasVar('testVar'));
        $this->assertEquals( 'testVal', $testSession->hasVar('testVar'));
        oxSession::deleteVar( 'testVar');
        $this->assertFalse( $testSession->hasVar('testVar'));
        $this->assertNotEquals( 'testVal', $testSession->hasVar('testVar'));
    }
    */

    /**
     * oxsession::url() test Cookies supported
     */
    function testUrlWithCookieSupport()
    {
        oxConfig::getInstance()->setConfigParam( 'blSessionUseCookies', true );
        $this->oSession = $this->getMock( 'testSession', array( '_getCookieSid' ) );
        $this->oSession->expects( $this->any() )->method( '_getCookieSid')->will( $this->returnValue( 'sid' ) );
        $sUrl = "http://shop.com/";
        $sProcessedUrl = $this->oSession->url($sUrl);
        $this->assertEquals( $sUrl . "?", $sProcessedUrl);
    }

    /**
     * oxsession::url() test admin case
     */
    function testUrlAdmin()
    {
        oxConfig::getInstance()->setConfigParam( 'blSessionUseCookies', false );
        $oSession = $this->getMock( 'testSession', array( '_getCookieSid', 'isAdmin', 'getSessionChallengeToken' ) );
        $oSession->expects( $this->any() )->method( 'getSessionChallengeToken')->will( $this->returnValue( 'stok' ) );
        $oSession->expects( $this->any() )->method( '_getCookieSid')->will( $this->returnValue( 'admin_sid' ) );
        $oSession->expects( $this->any() )->method( 'isAdmin')->will( $this->returnValue( true ) );

        $sUrl = "http://shop.com/";
        $this->assertEquals( $sUrl . "?stoken=stok&amp;", $oSession->url($sUrl));
    }

    /**
     * oxsession::url() test no cookie support
     */
    function testUrlNoCookie()
    {
        //starting session
        $this->oSession->UNITsetSessionId('testSid');

        oxConfig::getInstance()->setConfigParam( 'blSessionUseCookies', true );

        $sUrl = "http://shop.com/";
        $sProcessedUrl = $this->oSession->url($sUrl);
        $this->assertEquals( $sUrl . "?sid=testSid&amp;", $sProcessedUrl);

        //checking correct separator
        $sUrl = "http://shop.com/?param1=val1";
        $sProcessedUrl = $this->oSession->url($sUrl);
        $this->assertEquals( $sUrl . "&amp;sid=testSid&amp;", $sProcessedUrl);
    }

    /**
     * oxsession::url() test for search engines
     */
    function testUrlForSearchengines()
    {
        oxConfig::getInstance()->setGlobalParameter( 'blIsSearchEngine', true );

        //starting session
        $this->oSession->UNITsetSessionId('testSid');

        $sUrl = "http://shop.com/";
        $sProcessedUrl = $this->oSession->url($sUrl);
        $this->assertEquals($sProcessedUrl, $sUrl . "?");
        modConfig::setParameter('lang', 5);
        $sProcessedUrl = $this->oSession->url($sUrl);
        $this->assertEquals($sUrl . "?lang=5&amp;", $sProcessedUrl);

        //changing default language
        oxConfig::getInstance()->setConfigParam( 'sDefaultLang', 5 );
        $sProcessedUrl = $this->oSession->url($sUrl);
        $this->assertEquals($sUrl . "?", $sProcessedUrl);


        $this->oSession->setVar('lang', null);
        oxConfig::getInstance()->setGlobalParameter( 'blIsSearchEngine', false );
    }

    /**
     * oxsession::url() test for forced sid
     */
    function testUrlForceSessionStart()
    {
        modConfig::getInstance()->setConfigParam( 'blSessionUseCookies', true );
        oxTestModules::addFunction( "oxUtilsServer", "getOxCookie", "{return true;}" );

        //starting session
        $this->oSession->start();
        $this->oSession->UNITsetSessionId('testSid');

        $sUrl = "http://shop.com/";
        $sSslUrl = "https://shop.com/";

        $sProcessedUrl = $this->oSession->url( $sUrl );
        $this->assertEquals( $sUrl . "?", $sProcessedUrl);

        $sProcessedUrl = $this->oSession->url($sSslUrl);
        $this->assertEquals( $sSslUrl . "?force_sid=testSid&amp;", $sProcessedUrl);
    }

    /**
     * oxsession::sid() test normal case
     */
    function testSidNormal()
    {
        oxConfig::getInstance()->setConfigParam( 'blSessionUseCookies', false );
        $oSession = $this->getMock( 'testSession', array( '_getCookieSid', 'isAdmin' ) );
        $oSession->expects( $this->any() )->method( '_getCookieSid')->will( $this->returnValue( 'admin_sid' ) );
        $oSession->expects( $this->any() )->method( 'isAdmin')->will( $this->returnValue( false ) );
        $oSession->UNITsetSessionId('testSid');
        $this->assertEquals('sid=testSid', $oSession->sid());

        oxConfig::getInstance()->setConfigParam( 'blSessionUseCookies', true );
        $oSession->UNITsetSessionId('testSid');
        $this->assertEquals('', $oSession->sid());
    }

    /**
     * oxsession::sid() test normal case
     */
    function testSidInAdmin()
    {
        $oSession = $this->getMock( 'testSession', array( '_getCookieSid', 'isAdmin', 'getSessionChallengeToken' ) );
        $oSession->expects( $this->any() )->method( 'getSessionChallengeToken')->will( $this->returnValue( 'stok' ) );
        $oSession->expects( $this->any() )->method( '_getCookieSid')->will( $this->returnValue( 'admin_sid' ) );
        $oSession->expects( $this->any() )->method( 'isAdmin')->will( $this->returnValue( true ) );
        $oSession->UNITsetSessionId('testSid');

        $this->assertEquals('stoken=stok', $oSession->sid());
    }

    /**
     * oxsession::sid() test normal case
     */
    function testSidIfIdNotSetButSearchEngine()
    {
        $oConfig = $this->getMock( 'oxConfig', array( 'getShopId' ) );
        $oConfig->expects( $this->any() )->method( 'getShopId')->will( $this->returnValue( '2' ) );
        $oConfig->expects( $this->any() )->method( 'getShopId')->will( $this->returnValue( '2' ) );
        $oConfig->setConfigParam( 'blSessionUseCookies', false );
        $oConfig->setConfigParam( 'aCacheViews', array() );
        oxTestModules::addFunction( "oxUtils", "isSearchEngine", "{return true;}" );
        $oSession = $this->getMock( 'testSession', array( '_getCookieSid', 'isAdmin', 'getConfig' ) );
        $oSession->expects( $this->any() )->method( '_getCookieSid')->will( $this->returnValue( 'admin_sid' ) );
        $oSession->expects( $this->any() )->method( 'isAdmin')->will( $this->returnValue( false ) );
        $oSession->expects( $this->any() )->method( 'getConfig')->will( $this->returnValue( $oConfig) );
        $oSession->UNITsetSessionId(null);
        $sSid = $oSession->sid();

        // update: shp adding functionality is also in oxUtilsUrl, where it belongs
        $this->assertEquals('', $sSid);
    }

    /**
     * oxsession::sid() test in amdin
     */
    function testSidIsSearchEngine()
    {
        $oConfig = $this->getMock( 'oxConfig', array( 'getShopId' ) );
        $oConfig->expects( $this->any() )->method( 'getShopId')->will( $this->returnValue( '2' ) );
        $oConfig->expects( $this->any() )->method( 'getShopId')->will( $this->returnValue( '2' ) );
        $oConfig->setConfigParam( 'blSessionUseCookies', false );
        $oConfig->setConfigParam( 'aCacheViews', array() );
        oxTestModules::addFunction( "oxUtils", "isSearchEngine", "{return true;}" );
        $oSession = $this->getMock( 'testSession', array( '_getCookieSid', 'isAdmin', 'getConfig' ) );
        $oSession->expects( $this->any() )->method( '_getCookieSid')->will( $this->returnValue( 'admin_sid' ) );
        $oSession->expects( $this->any() )->method( 'isAdmin')->will( $this->returnValue( false ) );
        $oSession->expects( $this->any() )->method( 'getConfig')->will( $this->returnValue( $oConfig) );
        $oSession->UNITsetSessionId('testSid');
        $sSid = $oSession->sid();

        // update: shp adding functionality is also in oxUtilsUrl, where it belongs
        $this->assertEquals('', $sSid);
    }

    /**
     * oxsession::hiddenSid() test
     */
    function testHiddenSidIsAdmin()
    {
        $oSession = $this->getMock( 'testSession', array( 'isAdmin', 'getSessionChallengeToken' ) );
        $oSession->expects( $this->any() )->method( 'getSessionChallengeToken')->will( $this->returnValue( 'stok' ) );
        $oSession->expects( $this->any() )->method( 'isAdmin')->will( $this->returnValue( true ) );
        $oSession->UNITsetSessionId('testSid');
        $sSid = $oSession->hiddenSid();
        $this->assertEquals('<input type="hidden" name="stoken" value="stok"><input type="hidden" name="force_sid" value="testSid">', $sSid);
    }

    /**
     * oxsession::hiddenSid() test
     */
    function testHiddenSidNotAdmin()
    {
        $oSession = $this->getMock( 'testSession', array( 'isAdmin', 'getSessionChallengeToken' ) );
        $oSession->expects( $this->any() )->method( 'getSessionChallengeToken')->will( $this->returnValue( 'stok' ) );
        $oSession->expects( $this->any() )->method( 'isAdmin')->will( $this->returnValue( false ) );
        $oSession->UNITsetSessionId('testSid');
        $sSid = $oSession->hiddenSid();
        $this->assertEquals('<input type="hidden" name="stoken" value="stok"><input type="hidden" name="force_sid" value="testSid">', $sSid);
    }

    /**
     * oxsession::getBasketName() test
     */
    function testGetBasketNameblMallSharedBasket()
    {
        $this->assertEquals($this->oSession->UNITgetBasketName(), oxConfig::getInstance()->getShopId() . '_basket');
    }

    /**
     * oxsession::getBasketName() test
     */
    function testGetBasketName()
    {
        oxConfig::getInstance()->setConfigParam( 'blMallSharedBasket', 1 );
        $this->assertEquals( 'basket', $this->oSession->UNITgetBasketName());
    }

    /**
     *  oxsession::setBasket() test
     */
    function testSetBasket_getBasket()
    {
        $oBasket = oxNew( 'oxbasket' );
        $this->assertNotNull($oBasket);
        $this->oSession->setBasket($oBasket);

        $oSessionBasket = $this->oSession->getBasket();
        $this->assertEquals($oBasket, $oSessionBasket);
    }

    /**
     * oxsession::delBasket() test
     */
    function testDelBasket()
    {
        $oSession = $this->getMock( 'oxsession', array( '_getBasketName' ) );
        $oSession->expects( $this->once() )->method( '_getBasketName')->will( $this->returnValue( 'xxx' ) );
        $oSession->delBasket();
    }

    /**
     * Test for bug #853
     */
    function testDbSessionHandlerExists()
    {
        $this->assertTrue(file_exists(_DB_SESSION_HANDLER), _DB_SESSION_HANDLER . " does not exist");
    }

    function testGetRequestChallengeToken()
    {
        $oSession = oxNew('oxsession');
        modConfig::setParameter('stoken', 'asd');
        $this->assertEquals('asd', $oSession->getRequestChallengeToken());
        modConfig::setParameter('stoken', 'asd#asd$$');
        $this->assertEquals('asdasd', $oSession->getRequestChallengeToken());
    }

    public function testGetSessionChallengeToken()
    {
        modSession::getInstance()->setVar('sess_stoken', '');
        $oSession = $this->getMock('oxSession', array('_initNewSessionChallenge'));
        $oSession->expects($this->once())->method('_initNewSessionChallenge')->will($this->evalFunction('{modSession::getInstance()->setVar("sess_stoken", "newtok");}'));
        $this->assertEquals('newtok', $oSession->getSessionChallengeToken());
        modSession::getInstance()->setVar('sess_stoken', 'asd541)$#sdf');
        $this->assertEquals('asd541sdf', $oSession->getSessionChallengeToken());
    }

    public function testCheckSessionChallenge()
    {
        $oSession = $this->getMock( 'oxsession', array( 'getSessionChallengeToken', 'getRequestChallengeToken' ) );
        $oSession->expects( $this->once() )->method( 'getSessionChallengeToken')->will( $this->returnValue( '' ) );
        $oSession->expects( $this->never() )->method( 'getRequestChallengeToken')->will( $this->returnValue( '' ) );
        $this->assertEquals(false, $oSession->checkSessionChallenge());

        $oSession = $this->getMock( 'oxsession', array( 'getSessionChallengeToken', 'getRequestChallengeToken' ) );
        $oSession->expects( $this->once() )->method( 'getSessionChallengeToken')->will( $this->returnValue( 'aa' ) );
        $oSession->expects( $this->once() )->method( 'getRequestChallengeToken')->will( $this->returnValue( 'aad' ) );
        $this->assertEquals(false, $oSession->checkSessionChallenge());

        $oSession = $this->getMock( 'oxsession', array( 'getSessionChallengeToken', 'getRequestChallengeToken' ) );
        $oSession->expects( $this->once() )->method( 'getSessionChallengeToken')->will( $this->returnValue( 'aa' ) );
        $oSession->expects( $this->once() )->method( 'getRequestChallengeToken')->will( $this->returnValue( 'aa' ) );
        $this->assertEquals(true, $oSession->checkSessionChallenge());
    }

    public function testInitNewSessionChallenge()
    {
        modSession::getInstance()->setVar('sess_stoken', '');
        $oSession = new oxSession();
        $this->assertEquals('', modSession::getInstance()->getVar('sess_stoken'));
        $this->assertEquals('', $oSession->getRequestChallengeToken());

        $oSession->UNITinitNewSessionChallenge();
        $s1 = modSession::getInstance()->getVar('sess_stoken');
        $this->assertNotEquals('', $s1);

        $oSession->UNITinitNewSessionChallenge();
        $s2 = modSession::getInstance()->getVar('sess_stoken');
        $this->assertNotEquals('', $s2);
        $this->assertNotEquals($s1, $s2);
    }

    public function testInitNewSessionRecreatesChallengeToken()
    {
        $oSession = $this->getMock( 'oxsession', array( '_initNewSessionChallenge' ) );
        $oSession->expects( $this->once() )->method( '_initNewSessionChallenge');
        $oSession->initNewSession();
    }

    /**
     * test _getRequireSessionWithParams if no config val exists
     */
    function testGetRequireSessionWithParamsNoConf()
    {
        $oCfg = $this->getMock('oxConfig', array('getConfigParam'));
        $oCfg->expects($this->once())->method('getConfigParam')
                    ->with($this->equalTo('aRequireSessionWithParams'))
                    ->will($this->returnValue(null));
        $oSess = $this->getMock('oxSession', array('getConfig'));
        $oSess->expects($this->once())->method('getConfig')
                    ->will($this->returnValue($oCfg));
        $this->assertEquals(
                    array (
                        'cl' =>
                            array (
                                'register' => true,
                                'account' => true,
                            ),
                      'fnc' =>
                            array (
                                'tobasket' => true,
                                'login_noredirect' => true,
                                'tocomparelist' => true,
                            ),
                       '_artperpage' => true,
                       'listorderby' => true,
                    )
                , $oSess->UNITgetRequireSessionWithParams()
        );
    }

    /**
     * test _getRequireSessionWithParams if config val exists
     */
    function testGetRequireSessionWithParamsWithConf()
    {
        $oCfg = $this->getMock('oxConfig', array('getConfigParam'));
        $oCfg->expects($this->once())->method('getConfigParam')
                    ->with($this->equalTo('aRequireSessionWithParams'))
                    ->will($this->returnValue(
                            array(
                                'cl' => array('xxx'=>1), // add new value inside param
                                'fnc' => 1,              // override param to allow all values
                                '_param' => true,        // add new params
                                '_ddd' => array('yyy'=>1),
                            )
                    )
        );
        $oSess = $this->getMock('oxSession', array('getConfig'));
        $oSess->expects($this->once())->method('getConfig')
                    ->will($this->returnValue($oCfg));
        $this->assertEquals(
                    array (
                      'cl' =>
                          array (
                            'xxx' => 1,
                            'register' => true,
                            'account' => true,
                          ),
                      'fnc' => 1,
                      '_param' => true,
                      '_ddd' => array('yyy'=>1),
                      '_artperpage' => true,
                      'listorderby' => true,
                    )
                , $oSess->UNITgetRequireSessionWithParams()
        );
    }

    /**
     * check config array handling
     */
    function testIsSessionRequiredAction()
    {
        $oSess = $this->getMock('oxSession', array('_getRequireSessionWithParams'));
        $oSess->expects($this->exactly(7))->method('_getRequireSessionWithParams')
                    ->will($this->returnValue(
                            array(
                                'clx' => true,
                                'fncx' => array('a1'=>true, 's3'=>1),
                            )
                    ));
        $this->assertEquals(false, $oSess->UNITisSessionRequiredAction());
        modConfig::setParameter('clx', '0');
        $this->assertEquals(true, $oSess->UNITisSessionRequiredAction());
        modConfig::setParameter('fncx', '0');
        $this->assertEquals(true, $oSess->UNITisSessionRequiredAction());
        modConfig::setParameter('clx', null);
        $this->assertEquals(false, $oSess->UNITisSessionRequiredAction());
        modConfig::setParameter('fncx', 'a1');
        $this->assertEquals(true, $oSess->UNITisSessionRequiredAction());
        modConfig::setParameter('fncx', 'a3');
        $this->assertEquals(false, $oSess->UNITisSessionRequiredAction());
        modConfig::setParameter('fncx', 's3');
        $this->assertEquals(true, $oSess->UNITisSessionRequiredAction());
    }
    /**
     * check if forces session on POST request
     */
    function testIsSessionRequiredActionOnPost()
    {
        $oSess = $this->getMock('oxSession', array('_getRequireSessionWithParams'));
        $oSess->expects($this->exactly(2))->method('_getRequireSessionWithParams')
                    ->will($this->returnValue(
                            array(
                            )
                    ));

        $sInitial = $_SERVER['REQUEST_METHOD'];
        try {
            $_SERVER['REQUEST_METHOD'] = 'GET';
            $this->assertEquals(false, $oSess->UNITisSessionRequiredAction());
            $_SERVER['REQUEST_METHOD'] = 'POST';
            $this->assertEquals(true, $oSess->UNITisSessionRequiredAction());
        } catch (Exception $e) {
        }
        $_SERVER['REQUEST_METHOD'] = $sInitial;
        if ($e) {
            throw $e;
        };
    }

    public function testGetRemoteAccessToken()
    {
        $oSubj = new oxSession();
        $sTestToken = $oSubj->getRemoteAccessToken();
        $this->assertEquals(8, strlen($sTestToken));
    }

    public function testGetRemoteAccessTokenNotGenerated()
    {
        $oSubj = new oxSession();
        $oSubj->deleteVar('_rtoken');
        $sTestToken = $oSubj->getRemoteAccessToken(false);

        $this->assertNull($sTestToken);
        //generating one
        $oSubj->getRemoteAccessToken();
        $sTestToken = $oSubj->getRemoteAccessToken(false);
        //expecting real tokent
        $this->assertEquals(8, strlen($sTestToken));
    }

    public function testGetRemoteAccessTokenTwice()
    {
        $oSubj = new oxSession();
        $oSubj->deleteVar('_rtoken');
        $sToken1 = $oSubj->getRemoteAccessToken();
        $sToken2 = $oSubj->getRemoteAccessToken();

        $this->assertEquals($sToken1, $sToken2);
        $this->assertEquals(8, strlen($sToken2));
    }

    public function testIsRemoteAccessTokenValid()
    {
        modConfig::setParameter('rtoken', 'test1');

        $oSubj = $this->getProxyClass('oxSession');
        $oSubj->setVar('_rtoken', 'test1');
        $this->assertTrue($oSubj->UNITisValidRemoteAccessToken());
    }

    public function testIsTokenValidNot()
    {
        modConfig::setParameter('stoken', 'test1');

        $oSubj = $this->getProxyClass('oxSession');
        $oSubj->setVar('_stoken', 'test2');
        $this->assertFalse($oSubj->UNITisValidRemoteAccessToken());
    }
}