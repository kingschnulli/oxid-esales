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
 * @version   SVN: $Id: accountTest.php 25505 2010-02-02 02:12:13Z alfonsas $
 */

require_once realpath( "." ).'/unit/OxidTestCase.php';
require_once realpath( "." ).'/unit/test_config.inc.php';

/**
 * Tests for Account class
 */
class Unit_Views_accountWishlistTest extends OxidTestCase
{
    /**
     * Testing Account_Wishlist::render()
     *
     * @return null
     */
    public function testRenderNoUser()
    {
        $oView = $this->getMock( "Account_Wishlist", array( "getUser" ) );
        $oView->expects( $this->any() )->method( 'getUser')->will( $this->returnValue( false ) );
        $this->assertEquals( 'page/account/login.tpl', $oView->render() );
    }

    /**
     * Testing Account_Wishlist::render()
     *
     * @return null
     */
    public function testRender()
    {
        $oUser = new oxuser;
        $oUser->oxuser__oxpassword = new oxField( "testPassword" );

        $oView = $this->getMock( "Account_Wishlist", array( "getUser" ) );
        $oView->expects( $this->any() )->method( 'getUser')->will( $this->returnValue( $oUser ) );
        $this->assertEquals( 'page/account/wishlist.tpl', $oView->render() );
    }

    /**
     * Testing Account_Wishlist::showSuggest()
     *
     * @return null
     */
    public function testShowSuggest()
    {
        modConfig::setParameter( "blshowsuggest", 0 );

        $oView = new Account_Wishlist();
        $this->assertFalse( $oView->showSuggest() );

        modConfig::setParameter( "blshowsuggest", 1 );

        $oView = new Account_Wishlist();
        $this->assertTrue( $oView->showSuggest() );
    }

    /**
     * Testing Account_Wishlist::getWishList()
     *
     * @return null
     */
    public function testGetWishListNoUserNoWishlist()
    {
        $oView = $this->getMock( "Account_Wishlist", array( "getUser" ) );
        $oView->expects( $this->any() )->method( 'getUser')->will( $this->returnValue( false ) );
        $this->assertFalse( $oView->getWishList() );
    }


    /**
     * Testing Account_Wishlist::getWishList()
     *
     * @return null
     */
    public function testGetWishList()
    {
        $oBasket = $this->getMock( "oxStdClass", array( "isEmpty" ) );
        $oBasket->expects( $this->any() )->method( 'isEmpty')->will( $this->returnValue( false ) );

        $oUser = $this->getMock( "oxStdClass", array( "getBasket" ) );
        $oUser->expects( $this->any() )->method( 'getBasket')->with( $this->equalTo( "wishlist" ) )->will( $this->returnValue( $oBasket ) );

        $oView = $this->getMock( "Account_Wishlist", array( "getUser" ) );
        $oView->expects( $this->any() )->method( 'getUser')->will( $this->returnValue( $oUser ) );
        $this->assertSame( $oBasket, $oView->getWishList() );
    }


    /**
     * Testing Account_Wishlist::getWishList() when basket is empty
     *
     * @return null
     */
    public function testGetWishList_basketIsEmpty()
    {
        $oUserBasket = $this->getMock( "oxUserBasket", array( "isEmpty" ) );
        $oUserBasket->expects( $this->once() )->method( 'isEmpty')->will( $this->returnValue( true ) );
        $oUserBasket->setId( "testwishlist" );

        $oUser = $this->getMock( "oxStdClass", array( "getBasket" ) );
        $oUser->expects( $this->any() )->method( 'getBasket')->with( $this->equalTo( "wishlist" ) )->will( $this->returnValue( $oUserBasket ) );

        $oView = $this->getMock( "Account_Wishlist", array( "getUser" ) );
        $oView->expects( $this->any() )->method( 'getUser')->will( $this->returnValue( $oUser ) );

        $oWishList = $oView->getWishList();

        $this->assertFalse( $oWishList );
    }


    /**
     * Testing Account_Wishlist::getWishProductList()
     *
     * @return null
     */
    public function testGetWishProductListNoWishList()
    {
        $oView = $this->getMock( "Account_Wishlist", array( "getWishList" ) );
        $oView->expects( $this->any() )->method( 'getWishList')->will( $this->returnValue( false ) );
        $this->assertFalse( $oView->getWishProductList() );
    }

    /**
     * Testing Account_Wishlist::getWishProductList()
     *
     * @return null
     */
    public function testGetWishProductList()
    {
        $oWishList = $this->getMock( "oxStdClass", array( "getArticles" ) );
        $oWishList->expects( $this->any() )->method( 'getArticles')->will( $this->returnValue( "testArticles" ) );

        $oView = $this->getMock( "Account_Wishlist", array( "getWishList" ) );
        $oView->expects( $this->any() )->method( 'getWishList')->will( $this->returnValue( $oWishList ) );
        $this->assertEquals( "testArticles", $oView->getWishProductList() );
    }

    /**
     * Testing Account_Wishlist::getSimilarRecommLists()
     *
     * @return null
     */
    public function testGetSimilarRecommListsListManiaOff()
    {
        modconfig::getInstance()->setConfigParam( "bl_showListmania", false );

        $oView = new Account_Wishlist();
        $this->assertFalse( $oView->getSimilarRecommLists() );
    }

    /**
     * Testing Account_Wishlist::getSimilarRecommLists()
     *
     * @return null
     */
    public function testGetSimilarRecommLists()
    {
        modconfig::getInstance()->setConfigParam( "bl_showListmania", true );
        oxTestModules::addFunction('oxrecommlist', 'getRecommListsByIds', '{ return "testRecommListsByIds"; }' );

        $oProduct  = $this->getMock( "oxStdClass", array( "getId" ) );
        $oProduct->expects( $this->once() )->method( 'getId')->will( $this->returnValue( "testId" ) );

        $oView = $this->getMock( "Account_Wishlist", array( "getWishProductList" ) );
        $oView->expects( $this->any() )->method( 'getWishProductList')->will( $this->returnValue( array( $oProduct ) ) );
        $this->assertEquals( 'testRecommListsByIds', $oView->getSimilarRecommLists() );
    }

    /**
     * Testing Account_Wishlist::sendWishList()
     *
     * @return null
     */
    public function testSendWishListMissingParameters()
    {
        $aParams = array( "someVar1" => "someVal1", "someVar2" => "someVal2" );

        modConfig::setParameter( "editval", $aParams );
        oxTestModules::addFunction( 'oxUtilsView', 'addErrorToDisplay', '{ return "addErrorToDisplay"; }' );

        $oView = new Account_Wishlist();
        $this->assertEquals( "addErrorToDisplay", $oView->sendWishList() );
        $this->assertEquals( ( object ) $aParams, $oView->getEnteredData() );
    }

    /**
     * Testing Account_Wishlist::sendWishList()
     *
     * @return null
     */
    public function testSendWishList()
    {
        $aParams = array( "rec_name" => "someVal1", "rec_email" => "someVal2" );
        $oObj = ( object ) $aParams;
        //$oObj->send_email = "testName";
        //$oObj->send_name  = "testFName testLName";
        //$oObj->send_id    = "testId";

        modConfig::setParameter( "editval", $aParams );
        oxTestModules::addFunction( 'oxUtilsView', 'addErrorToDisplay', '{ return "addErrorToDisplay"; }' );
        oxTestModules::addFunction( 'oxemail', 'sendWishlistMail', '{ return false; }' );

        $oUser = $this->getMock( "oxStdClass", array( "getId" ) );
        $oUser->expects( $this->once() )->method( 'getId')->will( $this->returnValue( "testId" ) );
        $oUser->oxuser__oxusername = new oxField( "testName" );
        $oUser->oxuser__oxfname    = new oxField( "testFName" );
        $oUser->oxuser__oxlname    = new oxField( "testLName" );

        $oView = $this->getMock( "Account_Wishlist", array( "getUser" ) );
        $oView->expects( $this->any() )->method( 'getUser')->will( $this->returnValue( $oUser ) );
        $this->assertEquals( "addErrorToDisplay", $oView->sendWishList() );
        $this->assertEquals( $oObj, $oView->getEnteredData() );
        $this->assertFalse( $oView->isWishListEmailSent() );
    }

    /**
     * Testing Account_Wishlist::togglePublic()
     *
     * @return null
     */
    public function testTogglePublic()
    {
        modConfig::setParameter( "blpublic", 1 );

        $oBasket = $this->getMock( "oxStdClass", array( "save" ) );
        $oBasket->expects( $this->once() )->method( 'save');

        $oUser = $this->getMock( "oxStdClass", array( "getBasket" ) );
        $oUser->expects( $this->once() )->method( 'getBasket')->with( $this->equalTo( "wishlist" ) )->will( $this->returnValue( $oBasket ) );

        $oView = $this->getMock( "Account_Wishlist", array( "getUser" ) );
        $oView->expects( $this->once() )->method( 'getUser')->will( $this->returnValue( $oUser ) );
        $oView->togglePublic();
    }

    /**
     * Testing Account_Wishlist::searchForWishList()
     *
     * @return null
     */
    public function testSearchForWishList()
    {
        modConfig::setParameter( 'search', "searchParam" );
        oxTestModules::addFunction( 'oxuserlist', 'loadWishlistUsers', '{ $this->_aArray[0] = 1; }' );

        $oView = new Account_Wishlist();
        $oView->searchForWishList();

        $this->assertTrue( $oView->getWishListUsers() instanceof oxuserlist );
        $this->assertEquals( "searchParam", $oView->getWishListSearchParam() );
    }

	/**
     * Testing Account_RecommList::getBreadCrumb()
     *
     * @return null
     */
    public function testGetBreadCrumb()
    {
        $oAccWishList = new Account_Wishlist();

        $this->assertEquals(2, count($oAccWishList->getBreadCrumb()));
    }
}