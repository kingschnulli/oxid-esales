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
 * @version   SVN: $Id: oxcmpUserTest.php 26841 2010-03-25 13:58:15Z arvydas $
 */

require_once realpath( "." ).'/unit/OxidTestCase.php';
require_once realpath( "." ).'/unit/test_config.inc.php';

class modcmp_user_parent
{
    public $sModDynUrlParams = '&amp;searchparam=a';

    public function getDynUrlParams()
    {
        return $this->sModDynUrlParams;
    }
}
class modcmp_user extends oxcmp_user
{
    protected $_oParent;

    public function getLogoutLink()
    {
        $this->_oParent = new modcmp_user_parent();

        return $this->_getLogoutLink();
    }

}
class Unit_Views_oxcmpUserTest extends OxidTestCase
{

    /**
     * Tear down the fixture.
     *
     * @return null
     */
    protected function tearDown()
    {
        // cleaning up
        $sQ = 'delete from oxuser where oxusername like "test%" ';
        oxDb::getDb()->execute( $sQ );
        $sQ = 'delete from oxaddress where oxid like "test%" ';
        oxDb::getDb()->execute( $sQ );

        parent::tearDown();
    }

    public function testSetAndGetLoginStatus()
    {
        $iStatus = 999;

        $oCmp = new oxcmp_user();
        $this->assertNull( $oCmp->getLoginStatus() );

        $oCmp->setLoginStatus( $iStatus );
        $this->assertEquals( $iStatus, $oCmp->getLoginStatus() );
    }

    public function testGetLogoutLink()
    {
        // note: modConfig mock fails for php 520
        $oConfig = $this->getMock( 'oxConfig', array( 'getShopSecureHomeUrl', 'isSsl' ) );
        $oConfig->expects( $this->any() )->method( 'getShopSecureHomeUrl' )->will( $this->returnValue( 'shopurl/?' ) );
        $oConfig->expects( $this->any() )->method( 'isSsl' )->will( $this->returnValue( false ) );

        $oView = $this->getMock( 'modcmp_user', array( 'getConfig' ) );
        $oView->expects( $this->any() )->method( 'getConfig' )->will( $this->returnValue( $oConfig ) );

        modConfig::setParameter('cl', 'testclass');
        modConfig::setParameter('cnid', 'catid');
        modConfig::setParameter('mnid', 'manId');
        modConfig::setParameter('anid', 'artid');
        modConfig::setParameter('tpl', 'test');
        $sLink = $oView->getLogoutLink();
        $sExpLink = "shopurl/?cl=testclass&amp;searchparam=a&amp;anid=artid&amp;cnid=catid&amp;mnid=manId" .
                    "&amp;tpl=test&amp;fnc=logout";

        $this->assertEquals( $sExpLink, $sLink );
    }

    public function testGetLogoutLinkIfSsl()
    {
        $oConfig = $this->getMock( 'oxConfig', array( 'getShopSecureHomeUrl', 'getShopHomeUrl', 'isSsl' ) );
        $oConfig->expects( $this->any() )->method( 'getShopSecureHomeUrl' )->will( $this->returnValue( 'shopurl' ) );
        $oConfig->expects( $this->any() )->method( 'getShopHomeUrl' )->will( $this->returnValue( 'sslshopurl/?' ) );
        $oConfig->expects( $this->any() )->method( 'isSsl' )->will( $this->returnValue( true ) );

        $oView = $this->getMock( 'modcmp_user', array( 'getConfig') );
        $oView->expects( $this->any() )->method( 'getConfig' )->will( $this->returnValue( $oConfig ) );
        modConfig::setParameter('cl', 'testclass');
        modConfig::setParameter('cnid', 'catid');
        modConfig::setParameter('mnid', 'manId');
        modConfig::setParameter('anid', 'artid');
        modConfig::setParameter('tpl', 'test');
        $sLink = $oView->getLogoutLink();
        $sExpLink = "sslshopurl/?cl=testclass&amp;searchparam=a&amp;anid=artid&amp;cnid=catid&amp;mnid=manId" .
                    "&amp;tpl=test&amp;fnc=logout";

        $this->assertEquals( $sExpLink, $sLink );
    }

    public function testChangeUserNoRedirectChecksSessionChallenge()
    {
        $oS = $this->getMock( 'oxSession', array( 'checkSessionChallenge' ) );
        $oS->expects( $this->once() )->method( 'checkSessionChallenge' )->will( $this->returnValue( false ) );
        $oCU = $this->getMock('oxcmp_user', array('getUser', 'getSession'));
        $oCU->expects( $this->never() )->method( 'getUser' )->will( $this->returnValue( false ) );
        $oCU->expects( $this->once() )->method( 'getSession' )->will( $this->returnValue( $oS ) );

        $this->assertSame(null, $oCU->UNITchangeUser_noRedirect());

        $oS = $this->getMock( 'oxSession', array( 'checkSessionChallenge' ) );
        $oS->expects( $this->once() )->method( 'checkSessionChallenge' )->will( $this->returnValue( true ) );
        $oCU = $this->getMock('oxcmp_user', array('getUser', 'getSession'));
        $oCU->expects( $this->once() )->method( 'getUser' )->will( $this->returnValue( false ) );
        $oCU->expects( $this->once() )->method( 'getSession' )->will( $this->returnValue( $oS ) );

        $this->assertSame(null, $oCU->UNITchangeUser_noRedirect());
    }

    // FS#1925
    public function testBlockedUser()
    {
        $myDB     = oxDb::getDB();
        $sTable   = getViewName( 'oxuser' );
        $iLastCustNr = ( int ) $myDB->getOne( 'select max( oxcustnr ) from '.$sTable ) + 1;
        $oUser = oxNew( 'oxuser' );
        $oUser->oxuser__oxshopid = new oxField(modConfig::getInstance()->getShopId(), oxField::T_RAW);
        $oUser->oxuser__oxactive = new oxField(1, oxField::T_RAW);
        $oUser->oxuser__oxrights = new oxField('user', oxField::T_RAW);
        $oUser->oxuser__oxusername = new oxField('test@oxid-esales.com', oxField::T_RAW);
        $oUser->oxuser__oxpassword = new oxField(crc32( 'Test@oxid-esales.com' ), oxField::T_RAW);
        $oUser->oxuser__oxcustnr    = new oxField($iLastCustNr+1, oxField::T_RAW);
        $oUser->oxuser__oxcountryid = new oxField("testCountry", oxField::T_RAW);
        $oUser->save();
        $sQ = 'insert into oxaddress ( oxid, oxuserid, oxaddressuserid, oxcountryid ) values ( "test_user", "'.$oUser->getId().'", "'.$oUser->getId().'", "testCountry" ) ';
        $myDB->Execute( $sQ );

        oxTestModules::addFunction( "oxUtils", "redirect", "{ throw new exception( 'testBlockedUser', 123 );}" );

        $oUser2 = new oxuser();
        $oUser2->load( $oUser->getId() );
        $oUser2->login('test@oxid-esales.com', crc32( 'Test@oxid-esales.com' ));

        $myDB     = oxDb::getDB();
        $sQ = 'insert into oxobject2group values ( "'.$oUser2->getId().'", "'.modConfig::getInstance()->getShopId().'", "'.$oUser2->getId().'", "oxidblocked" )';
        $myDB->Execute( $sQ );

        try {
            $oUserView = new oxcmp_user();
            $oUserView->init();
        } catch ( Exception $oE  ) {
            if ( $oE->getCode() === 123 ) {
                $oUser2->logout();
                return;
            }
        }
        $oUser->logout();
        $this->fail( 'first assert should throw an exception' );
    }

    /**
     * Test oxViewConfig::getShowOpenIdLogin() affection
     *
     * @return null
     */
    public function testLoginOidIfOpenIdDisabled()
    {
        $oCfg = $this->getMock( "stdClass", array( "getShowOpenIdLogin" ) );
        $oCfg->expects( $this->once() )->method( 'getShowOpenIdLogin')->will($this->returnValue( false ) );

        $oTg = $this->getMock( "oxcmp_user", array( "getViewConfig", 'setLoginStatus' ) );
        $oTg->expects( $this->once() )->method( 'getViewConfig')->will($this->returnValue( $oCfg ) );
        $oTg->expects( $this->never() )->method( 'setLoginStatus');

        $this->assertSame(null, $oTg->loginOid());
    }

    /**
     * Test view render.
     *
     * @return null
     */
    public function testRender()
    {
        modConfig::setParameter('dgr', 'testdgr');
        modConfig::setParameter('invadr', 'testadr');
        modConfig::setParameter('deladr', 'testdeladr');
        modConfig::setParameter('reloadaddress', false);
        modConfig::setParameter('lgn_usr', 'testuser');
        $oView = oxNew("oxview");
        $oUserView = $this->getMock( 'oxcmp_user', array( 'getParent', 'getUser' ) );
        $oUserView->expects( $this->once() )->method( 'getParent' )->will( $this->returnValue( $oView ) );
        $oUserView->expects( $this->atLeastOnce() )->method( 'getUser' )->will( $this->returnValue( "testUser" ) );
        $this->assertEquals( 'testUser', $oUserView->render() );
        $oViewData = $oView->getViewData();
        $this->assertEquals( 'testdgr', modSession::getInstance()->getVar( 'dgr' ) );
        $this->assertEquals( 'testadr', $oViewData['invadr'] );
        $this->assertEquals( 'testdeladr', $oViewData['deladr'] );
        $this->assertEquals( 'testuser', $oViewData['lgn_usr'] );
    }

    /**
     * Test view _loadSessionUser().
     *
     * @return null
     */
    public function testLoadSessionUser()
    {
        modConfig::setParameter('blPerfNoBasketSaving', true);
        $oBasket = $this->getMock( 'oxBasket', array( 'onUpdate' ) );
        $oBasket->expects( $this->once() )->method( 'onUpdate');
        $oSession = $this->getMock( 'oxSession', array( 'getBasket' ) );
        $oSession->expects( $this->once() )->method( 'getBasket')->will( $this->returnValue( $oBasket ) );
        $oUser = $this->getMock( 'oxcmp_user', array( 'inGroup', 'isLoadedFromCookie' ) );
        $oUser->expects( $this->once() )->method( 'inGroup' )->will( $this->returnValue( false ) );
        $oUser->expects( $this->once() )->method( 'isLoadedFromCookie' )->will( $this->returnValue( "testUser" ) );
        $oUserView = $this->getMock( 'oxcmp_user', array( 'getSession', 'getUser' ) );
        $oUserView->expects( $this->once() )->method( 'getSession' )->will( $this->returnValue( $oSession ) );
        $oUserView->expects( $this->once() )->method( 'getUser' )->will( $this->returnValue( $oUser ) );
        $oUserView->UNITloadSessionUser();
            $this->assertEquals( 1, modConfig::getInstance()->getGlobalParameter( 'blUserChanged' ) );
    }

    /**
     * Test view _loadSessionUser().
     *
     * @return null
     */
    public function testLoadSessionUserIfUserIsNotSet()
    {
        $oUserView = $this->getMock( 'oxcmp_user', array( 'getSession', 'getUser' ) );
        $oUserView->expects( $this->never() )->method( 'getSession' );
        $oUserView->expects( $this->once() )->method( 'getUser' )->will( $this->returnValue( false ) );
        $this->assertNull( $oUserView->UNITloadSessionUser());
    }

    /**
     * Test login.
     *
     * @return null
     */
    public function testLogin()
    {
        oxTestModules::addFunction( "oxUser", "login", "{ return true;}" );
        modConfig::setParameter('lgn_usr', 'test@oxid-esales.com');
        modConfig::setParameter('lgn_pwd', crc32( 'Test@oxid-esales.com' ));

        $oUserView = $this->getMock( 'oxcmp_user', array( '_afterLogin' ) );
        $oUserView->expects( $this->atLeastOnce() )->method( '_afterLogin' )->will( $this->returnValue( "nextStep" ) );
        $this->assertEquals( 'nextStep', $oUserView->login() );
    }

    /**
     * Test login.
     *
     * @return null
     */
    public function testLoginUserException()
    {
        oxTestModules::addFunction( "oxUser", "login", "{ throw new oxUserException( 'testWrongUser', 123 );}" );

        $oUserView = new oxcmp_user();
        $this->assertEquals( 'user', $oUserView->login() );
    }

    /**
     * Test login.
     *
     * @return null
     */
    public function testLoginCookieException()
    {
        oxTestModules::addFunction( "oxUser", "login", "{ throw new oxCookieException( 'testWrongUser', 123 );}" );

        $oUserView = new oxcmp_user();
        $this->assertEquals( 'user', $oUserView->login() );
    }

    /**
     * Test login.
     *
     * @return null
     */
    public function testLoginOpenId()
    {
        oxTestModules::addFunction( "oxOpenID", "authenticateOid", "{ return true;}" );
        modConfig::setParameter('lgn_openid', 'testuser');

        $oUserView = $this->getMock( 'oxcmp_user', array( '_afterLogin', '_getReturnUrl' ) );
        $oUserView->expects( $this->atLeastOnce() )->method( '_afterLogin' )->will( $this->returnValue( "nextStep" ) );
        $oUserView->expects( $this->atLeastOnce() )->method( '_getReturnUrl' )->will( $this->returnValue( "nextStep" ) );
        $this->assertEquals( 'nextStep', $oUserView->login() );
    }

    /**
     * Test _afterlogin().
     *
     * @return null
     */
    public function testAfterLogin()
    {
        modConfig::setParameter('blPerfNoBasketSaving', true);
        $oBasket = $this->getMock( 'oxBasket', array( 'onUpdate' ) );
        $oBasket->expects( $this->once() )->method( 'onUpdate');
        $oSession = $this->getMock( 'oxSession', array( 'getBasket' ) );
        $oSession->expects( $this->once() )->method( 'getBasket')->will( $this->returnValue( $oBasket ) );
        $oUser = $this->getMock( 'oxcmp_user', array( 'inGroup', 'addDynGroup' ) );
        $oUser->expects( $this->once() )->method( 'inGroup' )->will( $this->returnValue( false ) );
        $oUser->expects( $this->once() )->method( 'addDynGroup' );
            $aMockFnc = array( 'getSession' );
        $oUserView = $this->getMock( 'oxcmp_user', $aMockFnc );
        $oUserView->expects( $this->once() )->method( 'getSession' )->will( $this->returnValue( $oSession ) );
        $this->assertEquals( 'payment', $oUserView->UNITafterLogin( $oUser ) );
            $this->assertEquals( 1, modConfig::getInstance()->getGlobalParameter( 'blUserChanged' ) );
    }

    /**
     * Test _afterlogin().
     *
     * @return null
     */
    public function testAfterLoginIfBlockedUser()
    {
        oxTestModules::addFunction( "oxUtils", "redirect", "{ throw new exception( 'testBlockedUser', 123 );}" );
        $oUser = $this->getMock( 'oxcmp_user', array( 'inGroup' ) );
        $oUser->expects( $this->once() )->method( 'inGroup' )->will( $this->returnValue( true ) );

        try {
            $oUserView = new oxcmp_user();
            $oUserView->UNITafterLogin( $oUser );
        } catch ( Exception $oE  ) {
            if ( $oE->getCode() === 123 ) {
                return;
            }
        }
        $this->fail( 'first assert should throw an exception' );
    }

    /**
     * Test login.
     *
     * @return null
     */
    public function testLoginNoRedirect()
    {
        $oUserView = $this->getMock( 'oxcmp_user', array( 'login' ) );
        $oUserView->expects( $this->once() )->method( 'login' )->will( $this->returnValue( "nextStep" ) );
        $this->assertNull( $oUserView->login_noredirect() );
    }

    /**
     * Test view _afterLogout().
     *
     * @return null
     */
    public function testAfterLogout()
    {
        oxSession::setVar( 'paymentid', 'test' );
        oxSession::setVar( 'sShipSet', 'test' );
        oxSession::setVar( 'deladrid', 'test' );
        oxSession::setVar( 'dynvalue', 'test' );
        $oBasket = $this->getMock( 'oxBasket', array( 'onUpdate', 'resetUserInfo' ) );
        $oBasket->expects( $this->once() )->method( 'onUpdate');
        $oBasket->expects( $this->once() )->method( 'resetUserInfo');
        $oSession = $this->getMock( 'oxSession', array( 'getBasket' ) );
        $oSession->expects( $this->once() )->method( 'getBasket')->will( $this->returnValue( $oBasket ) );
        $oUserView = $this->getMock( 'oxcmp_user', array( 'getSession' ) );
        $oUserView->expects( $this->once() )->method( 'getSession' )->will( $this->returnValue( $oSession ) );
        $oUserView->UNITafterLogout();
        $this->assertNull( oxSession::getVar( 'paymentid' ) );
        $this->assertNull( oxSession::getVar( 'sShipSet' ) );
        $this->assertNull( oxSession::getVar( 'deladrid' ) );
        $this->assertNull( oxSession::getVar( 'dynvalue' ) );
    }

    /**
     * Test _afterlogin().
     *
     * @return null
     */
    public function testLogout()
    {
        oxTestModules::addFunction( "oxUtils", "redirect", "{ return true;}" );
        oxTestModules::addFunction( "oxUser", "logout", "{ return true;}" );
        modConfig::setParameter('redirect', true);
        $blParam = oxConfig::getInstance()->getConfigParam('sSSLShopURL');
        oxConfig::getInstance()->setConfigParam('sSSLShopURL', true);
            $aMockFnc = array( '_afterLogout', '_getLogoutLink' );
        $oUserView = $this->getMock( 'oxcmp_user', $aMockFnc );
        $oUserView->expects( $this->once() )->method( '_afterLogout' );
        $oUserView->expects( $this->once() )->method( '_getLogoutLink' )->will( $this->returnValue( "testurl" ) );
        $oUserView->logout();
        $this->assertEquals( 3, $oUserView->getLoginStatus() );
        oxConfig::getInstance()->setConfigParam('sSSLShopURL', $blParam);
    }

    /**
     * Test changeUser() if "open address area" button was clicked.
     *
     * @return null
     */
    public function testChangeUserIfAddedDelAddress()
    {
        $oUserView = $this->getMock( 'oxcmp_user', array( '_setupDelAddress' ) );
        $oUserView->expects( $this->once() )->method( '_setupDelAddress' )->will( $this->returnValue( true ) );
        $this->assertNull( $oUserView->changeUser() );
    }

    /**
     * Test changeUser().
     *
     * @return null
     */
    public function testChangeUser()
    {
        $oUserView = $this->getMock( 'oxcmp_user', array( '_setupDelAddress', '_changeUser_noRedirect' ) );
        $oUserView->expects( $this->once() )->method( '_setupDelAddress' )->will( $this->returnValue( false ) );
        $oUserView->expects( $this->once() )->method( '_changeUser_noRedirect' )->will( $this->returnValue( true ) );
        $this->assertEquals( 'payment', $oUserView->changeUser() );
    }

    /**
     * Test changeUser().
     *
     * @return null
     */
    public function testChangeUserIfNotRegisteredUser()
    {
        $oUserView = $this->getMock( 'oxcmp_user', array( '_setupDelAddress', '_changeUser_noRedirect' ) );
        $oUserView->expects( $this->once() )->method( '_setupDelAddress' )->will( $this->returnValue( false ) );
        $oUserView->expects( $this->once() )->method( '_changeUser_noRedirect' )->will( $this->returnValue( false ) );
        $this->assertFalse( $oUserView->changeUser() );
    }

    /**
     * Test changeUser().
     *
     * @return null
     */
    public function testChangeUserTestValues()
    {
        $oUserView = $this->getMock( 'oxcmp_user', array( '_changeUser_noRedirect' ) );
        $oUserView->expects( $this->once() )->method( '_changeUser_noRedirect' )->will( $this->returnValue( true ) );
        $this->assertNull( $oUserView->changeuser_testvalues() );
    }

    /**
     * Test createUser() if "open address area" button was clicked.
     *
     * @return null
     */
    public function testCreateUserIfAddedDelAddress()
    {
        $oUserView = $this->getMock( 'oxcmp_user', array( '_setupDelAddress' ) );
        $oUserView->expects( $this->once() )->method( '_setupDelAddress' )->will( $this->returnValue( true ) );
        $this->assertNull( $oUserView->createUser() );
    }

    /**
     * Test createUser().
     *
     * @return null
     */
    public function testCreateUser()
    {
        oxTestModules::addFunction( "oxemail", "sendRegisterEmail", "{ return true;}" );
        modConfig::setParameter('lgn_usr', 'test@oxid-esales.com');
        modConfig::setParameter('lgn_pwd', 'Test@oxid-esales.com');
        modConfig::setParameter('lgn_pwd2', 'Test@oxid-esales.com');
        modConfig::setParameter( 'order_remark', 'TestRemark' );
        modConfig::setParameter( 'option', 3 );
        $aRawVal = array('oxuser__oxfname' => 'fname',
                         'oxuser__oxlname' => 'lname',
                         'oxuser__oxstreetnr' => 'nr',
                         'oxuser__oxstreet' => 'street',
                         'oxuser__oxzip' => 'zip',
                         'oxuser__oxcity' => 'city',
                         'oxuser__oxcountryid' => 'a7c40f631fc920687.20179984');
        modConfig::setParameter('invadr', $aRawVal);

        $this->getProxyClass("oxcmp_user");
        $oUserView = $this->getMock( 'oxcmp_userPROXY', array( '_setupDelAddress', 'login' ) );
        $oUserView->expects( $this->once() )->method( '_setupDelAddress' )->will( $this->returnValue( false ) );
        $oUserView->expects( $this->once() )->method( 'login' )->will( $this->returnValue( 'payment' ) );
        $this->assertEquals( 'payment', $oUserView->createUser() );
        $this->assertEquals( 'TestRemark', oxSession::getVar( 'ordrem' ) );
        $this->assertTrue( $oUserView->getNonPublicVar( '_blIsNewUser' ) );
    }

    /**
     * Test createUser().
     *
     * @return null
     */
    public function testCreateUserWithoutPassword()
    {
        modConfig::setParameter('lgn_usr', 'test@oxid-esales.com');
        $aRawVal = array('oxuser__oxfname' => 'fname',
                         'oxuser__oxlname' => 'lname',
                         'oxuser__oxstreetnr' => 'nr',
                         'oxuser__oxstreet' => 'street',
                         'oxuser__oxzip' => 'zip',
                         'oxuser__oxcity' => 'city',
                         'oxuser__oxcountryid' => 'a7c40f631fc920687.20179984');
        modConfig::setParameter('invadr', $aRawVal);

        $this->getProxyClass("oxcmp_user");
        $oUserView = $this->getMock( 'oxcmp_userPROXY', array( '_setupDelAddress', '_afterLogin' ) );
        $oUserView->expects( $this->once() )->method( '_setupDelAddress' )->will( $this->returnValue( false ) );
        $oUserView->expects( $this->once() )->method( '_afterLogin' );
        $this->assertEquals( 'payment', $oUserView->createUser() );
        $this->assertTrue( $oUserView->getNonPublicVar( '_blIsNewUser' ) );
        $this->assertNotNull( oxSession::getVar( 'usr' ) );
    }

    /**
     * Test createUser().
     *
     * @return null
     */
    public function testCreateUserUserException()
    {
        oxTestModules::addFunction( "oxuser", "checkValues", "{ throw new oxUserException( 'testBlockedUser', 123 );}" );
        $oUserView = $this->getMock( 'oxcmp_user', array( '_setupDelAddress' ) );
        $oUserView->expects( $this->once() )->method( '_setupDelAddress' )->will( $this->returnValue( false ) );
        $this->assertFalse( $oUserView->createUser() );
    }

    /**
     * Test createUser().
     *
     * @return null
     */
    public function testCreateUseroxInputException()
    {
        oxTestModules::addFunction( "oxuser", "checkValues", "{ throw new oxInputException( 'testBlockedUser', 123 );}" );
        $oUserView = $this->getMock( 'oxcmp_user', array( '_setupDelAddress' ) );
        $oUserView->expects( $this->once() )->method( '_setupDelAddress' )->will( $this->returnValue( false ) );
        $this->assertFalse( $oUserView->createUser() );
    }

    /**
     * Test createUser().
     *
     * @return null
     */
    public function testCreateUserConnectionException()
    {
        oxTestModules::addFunction( "oxuser", "checkValues", "{ throw new oxConnectionException( 'testBlockedUser', 123 );}" );
        $oUserView = $this->getMock( 'oxcmp_user', array( '_setupDelAddress' ) );
        $oUserView->expects( $this->once() )->method( '_setupDelAddress' )->will( $this->returnValue( false ) );
        $this->assertFalse( $oUserView->createUser() );
    }

    /**
     * Test registerUser() if "open address area" button was clicked.
     *
     * @return null
     */
    public function testRegisterUserIfAddedDelAddress()
    {
        $oUserView = $this->getMock( 'oxcmp_user', array( '_setupDelAddress' ) );
        $oUserView->expects( $this->once() )->method( '_setupDelAddress' )->will( $this->returnValue( true ) );
        $this->assertNull( $oUserView->registerUser() );
    }

    /**
     * Test registerUser().
     *
     * @return null
     */
    public function testRegisterUserWithProblems()
    {
        $oUserView = $this->getMock( 'oxcmp_user', array( '_setupDelAddress', 'createuser', 'logout' ) );
        $oUserView->expects( $this->once() )->method( '_setupDelAddress' )->will( $this->returnValue( false ) );
        $oUserView->expects( $this->once() )->method( 'createuser' )->will( $this->returnValue( false ) );
        $oUserView->expects( $this->once() )->method( 'logout' )->will( $this->returnValue( false ) );
        $this->assertNull( $oUserView->registerUser() );
    }

    /**
     * Test registerUser().
     *
     * @return null
     */
    public function testRegisterUser()
    {
        $this->getProxyClass("oxcmp_user");
        $oUserView = $this->getMock( 'oxcmp_userPROXY', array( '_setupDelAddress', 'createuser', 'logout' ) );
        $oUserView->expects( $this->once() )->method( '_setupDelAddress' )->will( $this->returnValue( false ) );
        $oUserView->expects( $this->once() )->method( 'createuser' )->will( $this->returnValue( "payment" ) );
        $oUserView->setNonPublicVar( '_blIsNewUser', true );
        $this->assertEquals( 'register?success=1', $oUserView->registerUser() );
    }

    /**
     * Test registerUser().
     *
     * @return null
     */
    public function testRegisterUserWithNewsletterError()
    {
        $this->getProxyClass("oxcmp_user");
        $oUserView = $this->getMock( 'oxcmp_userPROXY', array( '_setupDelAddress', 'createuser', 'logout' ) );
        $oUserView->expects( $this->once() )->method( '_setupDelAddress' )->will( $this->returnValue( false ) );
        $oUserView->expects( $this->once() )->method( 'createuser' )->will( $this->returnValue( "payment" ) );
        $oUserView->setNonPublicVar( '_blIsNewUser', true );
        $oUserView->setNonPublicVar( '_blNewsSubscriptionStatus', false );
        $this->assertEquals( 'register?success=1&newslettererror=4', $oUserView->registerUser() );
    }

    /**
     * Test _changeUser_noRedirect()().
     *
     * @return null
     */
    public function testChangeUserNoRedirect()
    {
        modConfig::setParameter( 'order_remark', 'TestRemark' );
        modConfig::setParameter( 'blnewssubscribed', null );
        $aRawVal = array('oxuser__oxfname' => 'fname',
                         'oxuser__oxlname' => 'lname',
                         'oxuser__oxstreetnr' => 'nr',
                         'oxuser__oxstreet' => 'street',
                         'oxuser__oxzip' => 'zip',
                         'oxuser__oxcity' => 'city',
                         'oxuser__oxcountryid' => 'a7c40f631fc920687.20179984');
        modConfig::setParameter('invadr', $aRawVal);

        $this->getProxyClass("oxcmp_user");
        $oUser = $this->getMock( 'oxUser', array( 'changeUserData', 'getNewsSubscription', 'setNewsSubscription' ) );
        $oUser->expects( $this->once() )->method( 'changeUserData')->with( $this->equalTo( 'test@oxid-esales.com' ),
                                                                           $this->equalTo(crc32( 'Test@oxid-esales.com' ) ),
                                                                           $this->equalTo(crc32( 'Test@oxid-esales.com' ) ),
                                                                           $this->equalTo($aRawVal ),
                                                                           null );
        $oUser->expects( $this->once() )->method( 'getNewsSubscription')->will( $this->returnValue( oxNew( 'oxnewssubscribed' ) ) );
        $oUser->expects( $this->once() )->method( 'setNewsSubscription')->will( $this->returnValue( 1 ) );
        $oUser->oxuser__oxusername = new oxField('test@oxid-esales.com');
        $oUser->oxuser__oxpassword = new oxField(crc32( 'Test@oxid-esales.com' ));
        $oBasket = $this->getMock( 'oxBasket', array( 'onUpdate' ) );
        $oBasket->expects( $this->once() )->method( 'onUpdate');
        $oSession = $this->getMock( 'oxSession', array( 'getBasket', 'checkSessionChallenge' ) );
        $oSession->expects( $this->once() )->method( 'getBasket')->will( $this->returnValue( $oBasket ) );
        $oSession->expects( $this->once() )->method( 'checkSessionChallenge')->will( $this->returnValue( true ) );
            $aMockFnc = array( 'getSession', 'getUser', '_getDelAddressData' );
        $this->getProxyClass("oxcmp_user");
        $oUserView = $this->getMock( 'oxcmp_userPROXY', $aMockFnc );
        $oUserView->expects( $this->once() )->method( '_getDelAddressData' )->will( $this->returnValue( null ) );
        $oUserView->expects( $this->any() )->method( 'getSession' )->will( $this->returnValue( $oSession ) );
        $oUserView->expects( $this->once() )->method( 'getUser' )->will( $this->returnValue( $oUser ) );
        $this->assertTrue( $oUserView->UNITchangeUser_noRedirect() );
        $this->assertEquals( 'TestRemark', oxSession::getVar( 'ordrem' ) );
        $this->assertEquals( 1, $oUserView->getNonPublicVar( '_blNewsSubscriptionStatus' ) );
    }

    /**
     * Test _changeUser_noRedirect().
     *
     * @return null
     */
    public function testChangeUserNoRedirectConnectionException()
    {
        oxTestModules::addFunction( "oxuser", "changeUserData", "{ throw new oxConnectionException( 'testBlockedUser', 123 );}" );
        $oSession = $this->getMock( 'oxSession', array( 'checkSessionChallenge' ) );
        $oSession->expects( $this->once() )->method( 'checkSessionChallenge')->will( $this->returnValue( true ) );
        $oUserView = $this->getMock( 'oxcmp_user', array( 'getUser', '_getDelAddressData', 'getSession' ) );
        $oUserView->expects( $this->once() )->method( '_getDelAddressData' );
        $oUserView->expects( $this->once() )->method( 'getUser' )->will( $this->returnValue( new oxUser() ) );
        $oUserView->expects( $this->any() )->method( 'getSession' )->will( $this->returnValue( $oSession ) );
        $this->assertNull( $oUserView->UNITchangeUser_noRedirect() );
    }

    /**
     * Test _changeUser_noRedirect().
     *
     * @return null
     */
    public function testChangeUserNoRedirectInputException()
    {
        oxTestModules::addFunction( "oxuser", "changeUserData", "{ throw new oxInputException( 'testBlockedUser', 123 );}" );
        $oSession = $this->getMock( 'oxSession', array( 'checkSessionChallenge' ) );
        $oSession->expects( $this->once() )->method( 'checkSessionChallenge')->will( $this->returnValue( true ) );
        $oUserView = $this->getMock( 'oxcmp_user', array( 'getUser', '_getDelAddressData', 'getSession' ) );
        $oUserView->expects( $this->once() )->method( '_getDelAddressData' );
        $oUserView->expects( $this->once() )->method( 'getUser' )->will( $this->returnValue( new oxUser() ) );
        $oUserView->expects( $this->any() )->method( 'getSession' )->will( $this->returnValue( $oSession ) );
        $this->assertNull( $oUserView->UNITchangeUser_noRedirect() );
    }

    /**
     * Test _changeUser_noRedirect().
     *
     * @return null
     */
    public function testChangeUserNoRedirectUserException()
    {
        oxTestModules::addFunction( "oxuser", "changeUserData", "{ throw new oxUserException( 'testBlockedUser', 123 );}" );
        $oSession = $this->getMock( 'oxSession', array( 'checkSessionChallenge' ) );
        $oSession->expects( $this->once() )->method( 'checkSessionChallenge')->will( $this->returnValue( true ) );
        $oUserView = $this->getMock( 'oxcmp_user', array( 'getUser', '_getDelAddressData', 'getSession' ) );
        $oUserView->expects( $this->once() )->method( '_getDelAddressData' );
        $oUserView->expects( $this->once() )->method( 'getUser' )->will( $this->returnValue( new oxUser() ) );
        $oUserView->expects( $this->any() )->method( 'getSession' )->will( $this->returnValue( $oSession ) );
        $this->assertNull( $oUserView->UNITchangeUser_noRedirect() );
    }

    /**
     * Test _getDelAddressData().
     *
     * @return null
     */
    public function testGetDelAddressData()
    {
        $aRawVal = array('oxaddress__oxfname' => 'fname',
                 'oxaddress__oxlname' => 'lname',
                 'oxaddress__oxstreetnr' => 'nr',
                 'oxaddress__oxstreet' => 'street',
                 'oxaddress__oxzip' => 'zip',
                 'oxaddress__oxcity' => 'city',
                 'oxaddress__oxsal' => 'MSR',
                 'oxaddress__oxcountryid' => 'a7c40f631fc920687.20179984');
        modConfig::setParameter('deladr', $aRawVal);
        $oUserView = $this->getProxyClass("oxcmp_user");
        $this->assertEquals( $aRawVal, $oUserView->UNITgetDelAddressData() );
    }

    /**
     * Test _getDelAddressData().
     *
     * @return null
     */
    public function testGetDelAddressDataIfDataNotSet()
    {
        $aRawVal = array('oxaddress__oxsal' => 'MSR');
        modConfig::setParameter('deladr', $aRawVal);
        $oUserView = $this->getProxyClass("oxcmp_user");
        $this->assertEquals( array(), $oUserView->UNITgetDelAddressData() );
    }

    /**
     * Test _setupDelAddress().
     *
     * @return null
     */
    public function testSetupDelAddress()
    {
        modConfig::setParameter( 'blshowshipaddress', 1 );
        $oView = oxNew("oxview");
        $oUserView = $this->getMock( 'oxcmp_user', array( 'getParent' ) );
        $oUserView->expects( $this->any() )->method( 'getParent' )->will( $this->returnValue( $oView ) );
        $this->assertTrue( $oUserView->UNITsetupDelAddress() );
        $oViewData = $oView->getViewData();
        $this->assertEquals( 1, $oViewData['blshowshipaddress'] );
        $this->assertEquals( 1, oxSession::getVar( 'blshowshipaddress' ) );
    }

    /**
     * Test _setupDelAddress().
     *
     * @return null
     */
    public function testSetupDelAddressCloseDelAddress()
    {
        modConfig::setParameter( 'blhideshipaddress', 1 );
        oxSession::setVar( 'deladdrid', 'test' );
        $oView = oxNew("oxview");
        $oUserView = $this->getMock( 'oxcmp_user', array( 'getParent' ) );
        $oUserView->expects( $this->any() )->method( 'getParent' )->will( $this->returnValue( $oView ) );
        $this->assertTrue( $oUserView->UNITsetupDelAddress() );
        $oViewData = $oView->getViewData();
        $this->assertEquals( 0, $oViewData['blshowshipaddress'] );
        $this->assertEquals( 0, oxSession::getVar( 'blshowshipaddress' ) );
        $this->assertNull( oxSession::getVar( 'deladdrid' ) );
    }

    /**
     * Test _getUserTitle().
     *
     * @return null
     */
    public function testGetUserTitle()
    {
        $oUserView = $this->getProxyClass("oxcmp_user");
        $this->assertEquals( 'MRS', $oUserView->UNITgetUserTitle('F') );
        $this->assertEquals( 'MR', $oUserView->UNITgetUserTitle('M') );
    }

    /**
     * Test _getReturnUrl().
     *
     * @return null
     */
    public function testGetReturnUrl()
    {
        $oView = $this->getMock( 'oxview', array( 'setFncName', 'getLink' ) );
        $oView->expects( $this->any() )->method( 'setFncName' );
        $oView->expects( $this->any() )->method( 'getLink' )->will( $this->returnValue( 'testurl' ) );
        $oUserView = $this->getMock( 'oxcmp_user', array( 'getParent' ) );
        $oUserView->expects( $this->any() )->method( 'getParent' )->will( $this->returnValue( $oView ) );
        $this->assertEquals( 'testurl?fnc=loginOid', $oUserView->UNITgetReturnUrl() );
    }

    /**
     * Test _getReturnUrl().
     *
     * @return null
     */
    public function testGetReturnUrl2()
    {
        $oView = $this->getMock( 'oxview', array( 'setFncName', 'getLink' ) );
        $oView->expects( $this->any() )->method( 'setFncName' );
        $oView->expects( $this->any() )->method( 'getLink' )->will( $this->returnValue( 'testurl?cl=details' ) );
        $oUserView = $this->getMock( 'oxcmp_user', array( 'getParent' ) );
        $oUserView->expects( $this->any() )->method( 'getParent' )->will( $this->returnValue( $oView ) );
        $this->assertEquals( 'testurl?cl=details&fnc=loginOid', $oUserView->UNITgetReturnUrl() );
    }

    /**
     * Test init().
     *
     * @return null
     */
    public function testInit()
    {
        $oUserView = $this->getMock( 'oxcmp_user', array( '_loadSessionUser' ) );
        $oUserView->expects( $this->any() )->method( '_loadSessionUser' );
        $oUserView->init();
    }

    /**
     * Test login with open id.
     *
     * @return null
     */
    public function testLoginOid()
    {
        oxTestModules::addFunction( "oxUtils", "redirect", "{ return true;}" );
        oxTestModules::addFunction( "oxuser", "openIdLogin", "{ return true;}" );

        $aData = array('email' => 'test@oxid-esales.com',
                       'fullname' => 'fname lname',
                       'gender' => 'F',
                       'country' => 'DE',
                       'postcode' => '123');
        $oOpenId = $this->getMock( 'oxOpenID', array( 'getOidResponse' ) );
        $oOpenId->expects( $this->atLeastOnce() )->method( 'getOidResponse' )->will( $this->returnValue( $aData ) );
        $oView = $this->getMock( 'oxview', array( 'setFncName', 'getLink' ) );
        $oView->expects( $this->any() )->method( 'setFncName' );
        $oView->expects( $this->any() )->method( 'getLink' )->will( $this->returnValue( 'testurl' ) );
        $oUserView = $this->getMock( 'oxcmp_user', array( '_afterLogin', 'getOpenId', 'getParent', '_getReturnUrl' ) );
        $oUserView->expects( $this->atLeastOnce() )->method( '_afterLogin' );
        $oUserView->expects( $this->atLeastOnce() )->method( 'getOpenId' )->will( $this->returnValue( $oOpenId ) );
        $oUserView->expects( $this->any() )->method( 'getParent' )->will( $this->returnValue( $oView ) );
        $oUserView->expects( $this->any() )->method( '_getReturnUrl' )->will( $this->returnValue( "url" ) );
        $oUserView->loginOid();
        $myDB     = oxDb::getDB();
        $sQ = 'select oxisopenid from oxuser where oxusername = \'test@oxid-esales.com\'';
        $this->assertEquals( 1, $myDB->getOne( $sQ ) );
    }

    /**
     * Test login with open id.
     *
     * @return null
     */
    public function testLoginOidWrongOpenId()
    {
        oxTestModules::addFunction( "oxUtils", "redirect", "{ return true;}" );
        oxTestModules::addFunction( "oxOpenID", "getOidResponse", "{ throw new oxUserException( 'testLoginOidWrongOpenId', 21 );}" );

        $oUserView = $this->getMock( 'oxcmp_user', array( '_afterLogin', 'getOpenId', 'getParent', '_getReturnUrl' ) );
        $oUserView->expects( $this->never() )->method( '_afterLogin' );
        $oUserView->expects( $this->atLeastOnce() )->method( 'getOpenId' )->will( $this->returnValue( oxNew( "oxOpenID" ) ) );
        $oUserView->expects( $this->never() )->method( 'getParent' );
        $oUserView->expects( $this->any() )->method( '_getReturnUrl' )->will( $this->returnValue( "url" ) );
        $oUserView->loginOid();
        $this->assertEquals( 2, $oUserView->getLoginStatus() );
    }

    /**
     * Test login with open id.
     *
     * @return null
     */
    public function testLoginOidErrorOnLogin()
    {
        oxTestModules::addFunction( "oxUtils", "redirect", "{ return true;}" );
        oxTestModules::addFunction( "oxuser", "openIdLogin", "{ throw new oxUserException( 'testLoginOidErrorOnLogin', 22 );}" );

        $aData = array('email' => 'test@oxid-esales.com',
                       'fullname' => 'fname lname',
                       'gender' => 'F',
                       'country' => 'Deutschland',
                       'postcode' => '123');
        $oOpenId = $this->getMock( 'oxOpenID', array( 'getOidResponse' ) );
        $oOpenId->expects( $this->atLeastOnce() )->method( 'getOidResponse' )->will( $this->returnValue( $aData ) );
        $oView = $this->getMock( 'oxview', array( 'setFncName', 'getLink' ) );
        $oView->expects( $this->any() )->method( 'setFncName' );
        $oView->expects( $this->any() )->method( 'getLink' )->will( $this->returnValue( 'testurl' ) );
        $oUserView = $this->getMock( 'oxcmp_user', array( '_afterLogin', 'getOpenId', 'getParent', '_getReturnUrl' ) );
        $oUserView->expects( $this->atLeastOnce() )->method( '_afterLogin' );
        $oUserView->expects( $this->atLeastOnce() )->method( 'getOpenId' )->will( $this->returnValue( $oOpenId ) );
        $oUserView->expects( $this->any() )->method( 'getParent' )->will( $this->returnValue( $oView ) );
        $oUserView->expects( $this->any() )->method( '_getReturnUrl' )->will( $this->returnValue( "url" ) );
        $oUserView->loginOid();
        $this->assertEquals( 2, $oUserView->getLoginStatus() );
    }

    /**
     * Test login with open id.
     *
     * @return null
     */
    public function testLoginOidUserExists()
    {
        $myDB     = oxDb::getDB();
        $sTable   = getViewName( 'oxuser' );
        $iLastCustNr = ( int ) $myDB->getOne( 'select max( oxcustnr ) from '.$sTable ) + 1;
        $oUser = oxNew( 'oxuser' );
        $oUser->oxuser__oxshopid = new oxField(modConfig::getInstance()->getShopId(), oxField::T_RAW);
        $oUser->oxuser__oxactive = new oxField(1, oxField::T_RAW);
        $oUser->oxuser__oxrights = new oxField('user', oxField::T_RAW);
        $oUser->oxuser__oxusername = new oxField('test@oxid-esales.com', oxField::T_RAW);
        $oUser->oxuser__oxpassword = new oxField(crc32( 'Test@oxid-esales.com' ), oxField::T_RAW);
        $oUser->oxuser__oxcustnr    = new oxField($iLastCustNr+1, oxField::T_RAW);
        $oUser->oxuser__oxcountryid = new oxField("testCountry", oxField::T_RAW);
        $oUser->save();

        oxTestModules::addFunction( "oxUtils", "redirect", "{ return true;}" );
        oxTestModules::addFunction( "oxuser", "openIdLogin", "{ return true;}" );

        $aData = array('email' => 'test@oxid-esales.com',
                       'fullname' => 'fname lname',
                       'gender' => 'F',
                       'country' => 'Deutschland',
                       'postcode' => '123');
        $oOpenId = $this->getMock( 'oxOpenID', array( 'getOidResponse' ) );
        $oOpenId->expects( $this->atLeastOnce() )->method( 'getOidResponse' )->will( $this->returnValue( $aData ) );
        $oView = $this->getMock( 'oxview', array( 'setFncName', 'getLink' ) );
        $oView->expects( $this->any() )->method( 'setFncName' );
        $oView->expects( $this->any() )->method( 'getLink' )->will( $this->returnValue( 'testurl' ) );
        $oUserView = $this->getMock( 'oxcmp_user', array( '_afterLogin', 'getOpenId', 'getParent', '_getReturnUrl' ) );
        $oUserView->expects( $this->atLeastOnce() )->method( '_afterLogin' );
        $oUserView->expects( $this->atLeastOnce() )->method( 'getOpenId' )->will( $this->returnValue( $oOpenId ) );
        $oUserView->expects( $this->any() )->method( 'getParent' )->will( $this->returnValue( $oView ) );
        $oUserView->expects( $this->any() )->method( '_getReturnUrl' )->will( $this->returnValue( "url" ) );
        $oUserView->loginOid();
        $sQ = 'select oxisopenid from oxuser where oxusername = \'test@oxid-esales.com\'';
        $this->assertEquals( 2, $myDB->getOne( $sQ ) );
    }

    /**
     * Test login with open id.
     *
     * @return null
     */
    public function testLoginOidUserExistsWithoutPassword()
    {
        $myDB     = oxDb::getDB();
        $sTable   = getViewName( 'oxuser' );
        $iLastCustNr = ( int ) $myDB->getOne( 'select max( oxcustnr ) from '.$sTable ) + 1;
        $oUser = oxNew( 'oxuser' );
        $oUser->oxuser__oxshopid = new oxField(modConfig::getInstance()->getShopId(), oxField::T_RAW);
        $oUser->oxuser__oxactive = new oxField(1, oxField::T_RAW);
        $oUser->oxuser__oxrights = new oxField('user', oxField::T_RAW);
        $oUser->oxuser__oxusername = new oxField('test@oxid-esales.com', oxField::T_RAW);
        $oUser->oxuser__oxcustnr    = new oxField($iLastCustNr+1, oxField::T_RAW);
        $oUser->oxuser__oxcountryid = new oxField("testCountry", oxField::T_RAW);
        $oUser->save();

        oxTestModules::addFunction( "oxUtils", "redirect", "{ return true;}" );
        oxTestModules::addFunction( "oxuser", "openIdLogin", "{ return true;}" );

        $aData = array('email' => 'test@oxid-esales.com',
                       'fullname' => 'fname lname',
                       'gender' => 'F',
                       'country' => 'Deutschland',
                       'postcode' => '123');
        $oOpenId = $this->getMock( 'oxOpenID', array( 'getOidResponse' ) );
        $oOpenId->expects( $this->atLeastOnce() )->method( 'getOidResponse' )->will( $this->returnValue( $aData ) );
        $oView = $this->getMock( 'oxview', array( 'setFncName', 'getLink' ) );
        $oView->expects( $this->any() )->method( 'setFncName' );
        $oView->expects( $this->any() )->method( 'getLink' )->will( $this->returnValue( 'testurl' ) );
        $oUserView = $this->getMock( 'oxcmp_user', array( '_afterLogin', 'getOpenId', 'getParent', '_getReturnUrl' ) );
        $oUserView->expects( $this->atLeastOnce() )->method( '_afterLogin' );
        $oUserView->expects( $this->atLeastOnce() )->method( 'getOpenId' )->will( $this->returnValue( $oOpenId ) );
        $oUserView->expects( $this->any() )->method( 'getParent' )->will( $this->returnValue( $oView ) );
        $oUserView->expects( $this->any() )->method( '_getReturnUrl' )->will( $this->returnValue( "url" ) );
        $oUserView->loginOid();
        $sQ = 'select oxisopenid from oxuser where oxusername = \'test@oxid-esales.com\'';
        $this->assertEquals( 1, $myDB->getOne( $sQ ) );
    }

}

