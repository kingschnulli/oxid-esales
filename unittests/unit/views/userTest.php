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
 * @version   SVN: $Id: userTest.php 27763 2010-05-14 13:14:46Z vilma $
 */

require_once realpath( "." ).'/unit/OxidTestCase.php';
require_once realpath( "." ).'/unit/test_config.inc.php';

/**
 * Testing user class
 */
class Unit_Views_userTest extends OxidTestCase
{
    protected $_oUser = array();

    /**
     * Initialize the fixture.
     *
     * @return null
     */
    protected function setUp()
    {
        parent::setUp();

        // setting up user
        $this->setupUsers();
    }

    /**
     * Tear down the fixture.
     *
     * @return null
     */
    protected function tearDown()
    {
        if ($this->_oUser) {
            $this->_oUser->delete();
        }

        parent::tearDown();

    }
    /**
     * Setting up users
     */
    protected function setupUsers()
    {
        $myDB     = oxDb::getDB();
        $sTable   = getViewName( 'oxuser' );
        $iLastCustNr = ( int ) $myDB->getOne( 'select max( oxcustnr ) from '.$sTable ) + 1;
        $this->_oUser = oxNew( 'oxuser' );
        $this->_oUser->oxuser__oxshopid = new oxField(modConfig::getInstance()->getShopId(), oxField::T_RAW);
        $this->_oUser->oxuser__oxactive = new oxField(1, oxField::T_RAW);
        $this->_oUser->oxuser__oxrights = new oxField('user', oxField::T_RAW);
        $this->_oUser->oxuser__oxusername = new oxField('test@oxid-esales.com', oxField::T_RAW);
        $this->_oUser->oxuser__oxpassword = new oxField(crc32( 'Test@oxid-esales.com' ), oxField::T_RAW);
        $this->_oUser->oxuser__oxcustnr = new oxField($iLastCustNr+1, oxField::T_RAW);
        $this->_oUser->oxuser__oxcountryid = new oxField("testCountry", oxField::T_RAW);
        $this->_oUser->save();

        $sQ = 'insert into oxaddress ( oxid, oxuserid, oxaddressuserid, oxcountryid ) values ( "test_user", "'.$this->_oUser->getId().'", "'.$this->_oUser->getId().'", "testCountry" ) ';
        $myDB->Execute( $sQ );
    }

    public function testGetMustFillFields()
    {
         modConfig::getInstance()->setConfigParam( 'aMustFillFields', array( "bb" => "aa" ) );
         $oUserView = new user();
         $this->assertEquals( array( "aa" => "bb" ), $oUserView->getMustFillFields() );
    }

    public function testGetShowNoRegOption()
    {
         modConfig::getInstance()->setConfigParam( 'blOrderDisWithoutReg', true );
         $oUserView = new user();
         $this->assertFalse( $oUserView->getShowNoRegOption() );
    }

    public function testGetLoginOption()
    {
         modConfig::setParameter( 'option', 1 );
         $oUserView = new user();
         $this->assertEquals( 1, $oUserView->getLoginOption() );
    }

    public function testGetLoginOptionIfNotLogedIn()
    {
         modConfig::setParameter( 'option', 2 );
         $oUserView = new user();
         $this->assertEquals( 0, $oUserView->getLoginOption() );
    }

    public function testGetCountryList()
    {
         $oUserView = new user();
         $oCountryList = oxNew( 'oxcountrylist' );
         $oCountryList->loadActiveCountries();
         $this->assertEquals( $oCountryList, $oUserView->getCountryList() );
    }

    public function testGetOrderRemark()
    {
         modSession::getInstance()->setVar( 'ordrem', "test" );
         $oUserView = new user();
         $this->assertEquals( "test", $oUserView->getOrderRemark() );
    }

    public function testGetOrderRemarkIfNewUser()
    {
         modConfig::setParameter( 'order_remark', "test" );
         $oUserView = new user();
         $this->assertEquals( "test", $oUserView->getOrderRemark() );
    }

    public function testIsNewsSubscribed()
    {
         modConfig::setParameter( 'blnewssubscribed', null );
         $oUserView = new user();
         $this->assertFalse( $oUserView->isNewsSubscribed() );
    }

    public function testIsNewsSubscribedIfUserIsLogedIn()
    {
        $oNewsSubscribed = $this->getMock( 'oxNewsSubscribed', array( 'getOptInStatus' ) );
        $oNewsSubscribed->expects( $this->once() )->method( 'getOptInStatus')->will( $this->returnValue( true ) );
        $oUser = $this->getMock( 'oxuser', array( 'getNewsSubscription' ) );
        $oUser->expects( $this->once() )->method( 'getNewsSubscription')->will( $this->returnValue( $oNewsSubscribed ) );
        $oUserView = $this->getMock( 'user', array( 'getUser' ) );
        $oUserView->expects( $this->once() )->method( 'getUser')->will( $this->returnValue( $oUser ) );
        $this->assertTrue( $oUserView->isNewsSubscribed() );
    }

    public function testShowShipAddress()
    {
        modConfig::setParameter( 'blshowshipaddress', null );
        $oUserView = $this->getMock( 'user', array( '_getActiveUser', '_getWishListId' ) );
        /*$oUserView->expects( $this->once() )->method( '_getActiveUser')->will( $this->returnValue( $this->_oUser ) );*/
        //$oUserView->expects( $this->once() )->method( '_getWishListId')->will( $this->returnValue( 'wishId' ) );
        $oUserView->expects( $this->never() )->method( '_getWishListId')->will( $this->returnValue( 'wishId' ) );
        $this->assertFalse( $oUserView->showShipAddress() );
    }

    public function testShowShipAddressIfUseBillAddress()
    {
        modConfig::setParameter( 'blshowshipaddress', true );
        $oUserView = $this->getMock( 'user', array( /*'_getActiveUser',*/ '_getSelectedAddress' ) );
        //$oUserView->expects( $this->once() )->method( '_getActiveUser')->will( $this->returnValue( $this->_oUser ) );
        //$oUserView->expects( $this->once() )->method( '_getSelectedAddress')->will( $this->returnValue( '-2' ) );
        $oUserView->expects( $this->never() )->method( '_getSelectedAddress')->will( $this->returnValue( '-2' ) );
        $this->assertTrue( $oUserView->showShipAddress() );
    }

    // #0000743 bug test
    public function testShowShipAddressIfUserChosentoUseBillingAddress()
    {
        modConfig::setParameter( 'oxaddressid', '-2' );
        $this->getProxyClass("user");
        $oUserView = $this->getMock( 'userPROXY', array( 'getUser' ) );
        $oUserView->expects( $this->once() )->method( 'getUser')->will( $this->returnValue( false ) );
        $oUserView->setNonPublicVar("_blShowShipAddress", null);
        $this->assertFalse( $oUserView->showShipAddress() );
        $this->assertEquals( 0, oxSession::getVar( 'blshowshipaddress' ) );
    }

    // #217 bug test
    public function testShowShipAddressIfNoActiveUser()
    {
        modConfig::setParameter( 'blshowshipaddress', 1 );
        $oUserView = $this->getMock( 'user', array( 'getUser' ) );
        $oUserView->expects( $this->once() )->method( 'getUser')->will( $this->returnValue( false ) );
        $this->assertEquals( 1, $oUserView->showShipAddress() );
    }

    // tests ShowShipAddress if item is added to basket from wishlist
    public function testShowShipAddressForWishlist()
    {
        $oUserView = $this->getMock( 'user', array( 'getUser', '_getWishListId' ) );
        $oUserView->expects( $this->once() )->method( 'getUser')->will( $this->returnValue( true ) );
        $oUserView->expects( $this->once() )->method( '_getWishListId')->will( $this->returnValue( 'testwishid' ) );
        $this->assertTrue( $oUserView->showShipAddress() );
        $this->assertTrue( oxSession::getVar( 'blshowshipaddress' ) );
    }

    public function testGetDelAddress()
    {
        modConfig::setParameter( 'blshowshipaddress', 1 );
        $oUserView = $this->getMock( 'user', array( 'showShipAddress', '_getSelectedAddress' ) );
        $oUserView->expects( $this->once() )->method( 'showShipAddress')->will( $this->returnValue( true ) );
        $oUserView->expects( $this->once() )->method( '_getSelectedAddress')->will( $this->returnValue( 'test_user' ) );
        $this->assertEquals( 'test_user', $oUserView->getDelAddress()->getId() );
    }

    public function testGetSelectedAddress()
    {
        $oUser = $this->getMock( 'oxuser', array( 'getSelectedAddress' ) );
        $oUser->expects( $this->once() )->method( 'getSelectedAddress')->will( $this->returnValue( "testAddress" ) );
        $oUserView = $this->getMock( 'user', array( 'getUser' ) );
        $oUserView->expects( $this->once() )->method( 'getUser')->will( $this->returnValue( $oUser ) );
        $this->assertEquals( "testAddress", $oUserView->UNITgetSelectedAddress() );
    }

    public function testAddFakeAddress()
    {
        $oDefAddress = new oxStdClass();
        $oDefAddress->oxaddress__oxid = new oxStdClass();
        $oDefAddress->oxaddress__oxid->value    = -2;
        $oDefAddress->oxaddress__oxfname = new oxStdClass();
        $oDefAddress->oxaddress__oxfname->value = '-';
        $oDefAddress->oxaddress__oxlname = new oxStdClass();
        $oDefAddress->oxaddress__oxlname->value = '-';
        $oDefAddress->oxaddress__oxcity = new oxStdClass();
        $oDefAddress->oxaddress__oxcity->value  = '-';

        $oList = oxNew("oxlist");
        $oUserView = new user();
        $oUserView->UNITaddFakeAddress( $oList );
        $this->assertEquals( $oDefAddress, $oList->offsetGet(0) );
    }

    public function testGetWishListId()
    {
        $oBasketItem = $this->getMock( 'oxBasketItem', array( 'getWishId' ) );
        $oBasketItem->expects( $this->once() )->method( 'getWishId')->will( $this->returnValue( "testwishid" ) );
        $oBasket = $this->getMock( 'oxBasket', array( 'getContents' ) );
        $oBasket->expects( $this->once() )->method( 'getContents')->will( $this->returnValue( array($oBasketItem) ) );
        $oSession = $this->getMock( 'oxSession', array( 'getBasket' ) );
        $oSession->expects( $this->once() )->method( 'getBasket')->will( $this->returnValue( $oBasket ) );
        $oUserView = $this->getMock( 'user', array( 'getSession' ) );
        $oUserView->expects( $this->once() )->method( 'getSession')->will( $this->returnValue( $oSession ) );
        $this->assertEquals( "testwishid", $oUserView->UNITgetWishListId() );
    }

    /**
     * Test view render.
     *
     * @return null
     */
    public function testRender()
    {
        $oUserView = $this->getMock( 'user', array( 'showShipAddress', 'getUser', '_addFakeAddress',
                                                       'getDelAddress', 'isNewsSubscribed', 'getOrderRemark',
                                                       'getCountryList', 'getLoginOption', 'getShowNoRegOption',
                                                       'getMustFillFields' ) );
        $oUserView->expects( $this->atLeastOnce() )->method( 'showShipAddress' )->will( $this->returnValue( true ) );
        $oUserView->expects( $this->atLeastOnce() )->method( 'getUser' )->will( $this->returnValue( oxNew("oxuser") ) );
        $oUserView->expects( $this->once() )->method( '_addFakeAddress' );
        $oUserView->expects( $this->atLeastOnce() )->method( 'getDelAddress' );
        $oUserView->expects( $this->once() )->method( 'isNewsSubscribed' );
        $oUserView->expects( $this->once() )->method( 'getOrderRemark' );
        $oUserView->expects( $this->once() )->method( 'getCountryList' );
        $oUserView->expects( $this->once() )->method( 'getLoginOption' );
        $oUserView->expects( $this->once() )->method( 'getShowNoRegOption' );
        $oUserView->expects( $this->once() )->method( 'getMustFillFields' );
        $this->assertEquals( 'user.tpl', $oUserView->render() );
    }

}
