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
 * @version   SVN: $Id: accountTest.php 44471 2012-04-27 12:06:58Z vaidas.matulevicius $
 */

require_once realpath( "." ).'/unit/OxidTestCase.php';
require_once realpath( "." ).'/unit/test_config.inc.php';

/**
 * Tests for Account class
 */
class Unit_Views_accountTest extends OxidTestCase
{
    /**
     * Test view render().
     *
     * @return null
     */
    public function testRenderConfirmTerms()
    {
        modConfig::getInstance()->setConfigParam( "blPsLoginEnabled", true );

        $oUserView = $this->getMock( 'account', array( 'confirmTerms', 'getUser' ) );
        $oUserView->expects( $this->any() )->method( 'confirmTerms' )->will( $this->returnValue( true ) );
        $oUserView->expects( $this->any() )->method( 'getUser' )->will( $this->returnValue( true ) );
        $this->assertEquals( 'page/privatesales/login.tpl', $oUserView->render());
    }

    /**
     * Test view render().
     *
     * @return null
     */
    public function testRenderNoTerms()
    {
        $oUser = new oxStdClass();
        $oUser->oxuser__oxpassword = new oxStdClass();
        $oUser->oxuser__oxpassword->value = "psw";
        $oUserView = $this->getMock( 'account', array( 'confirmTerms', 'getUser', 'getOrderCnt', "isEnabledPrivateSales" ) );
        $oUserView->expects( $this->any() )->method( 'confirmTerms' )->will( $this->returnValue( false ) );
        $oUserView->expects( $this->any() )->method( 'getUser' )->will( $this->returnValue( $oUser ) );
        $oUserView->expects( $this->any() )->method( 'getOrderCnt' );
        $oUserView->expects( $this->any() )->method( 'isEnabledPrivateSales' )->will( $this->returnValue( false ) );
        $this->assertEquals( 'page/account/dashboard.tpl', $oUserView->render());
    }

    /**
     * Test confirmTerms().
     *
     * @return null
     */
    public function testConfirmTerms()
    {
        $oView = oxNew('account');
        modConfig::setParameter('term', '2');
        $this->assertEquals( '2', $oView->confirmTerms());
    }
    
    /**
     * Test confirmTerms().
     *
     * @return null
     */
    public function testConfirmTermsForPrivateSales()
    {
        modConfig::setParameter('term', false);
        
        $oView = $this->getMock( "account", array( "isEnabledPrivateSales", "getUser" ) );
        $oUser = $this->getMock( "oxuser", array( "isTermsAccepted" ) );
        
        $oView->expects( $this->once() )->method( 'isEnabledPrivateSales' )->will( $this->returnValue( true ) );
        $oUser->expects( $this->once() )->method( "isTermsAccepted" )->will( $this->returnValue( false ) );
        $oView->expects( $this->once() )->method( "getUser" )->will( $this->returnValue( $oUser ) );
        
        $this->assertTrue( $oView->confirmTerms() );
    }

    /**
     * Test get list type.
     *
     * @return null
     */
    public function testGetListType()
    {
        modConfig::setParameter( 'listtype', 'testListType' );

        $oView = $this->getMock( "account", array( "getArticleId" ) );
        $oView->expects( $this->once() )->method( "getArticleId" )->will( $this->returnValue( false ) );
        $this->assertFalse( $oView->getListType() );

        $oView = $this->getMock( "account", array( "getArticleId" ) );
        $oView->expects( $this->once() )->method( "getArticleId" )->will( $this->returnValue( true ) );
        $this->assertEquals( 'testListType', $oView->getListType() );
    }

    /**
     * Test get search manufacturer.
     *
     * @return null
     */
    public function testGetSearchManufacturer()
    {
        modConfig::setParameter( 'searchmanufacturer', 'testmanufacturer' );

        $oView = $this->getMock( "account", array( "getArticleId" ) );
        $oView->expects( $this->once() )->method( "getArticleId" )->will( $this->returnValue( false ) );
        $this->assertFalse( $oView->getSearchManufacturer() );

        $oView = $this->getMock( "account", array( "getArticleId" ) );
        $oView->expects( $this->once() )->method( "getArticleId" )->will( $this->returnValue( true ) );
        $this->assertEquals( 'testmanufacturer', $oView->getSearchManufacturer() );
    }

    /**
     * Test get search vendor.
     *
     * @return null
     */
    public function testGetSearchVendor()
    {
        modConfig::setParameter( 'searchvendor', 'testvendor' );

        $oView = $this->getMock( "account", array( "getArticleId" ) );
        $oView->expects( $this->once() )->method( "getArticleId" )->will( $this->returnValue( false ) );
        $this->assertFalse( $oView->getSearchVendor() );

        $oView = $this->getMock( "account", array( "getArticleId" ) );
        $oView->expects( $this->once() )->method( "getArticleId" )->will( $this->returnValue( true ) );
        $this->assertEquals( 'testvendor', $oView->getSearchVendor() );
    }

    /**
     * Test get search category id.
     *
     * @return null
     */
    public function testGetSearchCatId()
    {
        modConfig::setParameter( 'searchcnid', 'testcnid' );

        $oView = $this->getMock( "account", array( "getArticleId" ) );
        $oView->expects( $this->once() )->method( "getArticleId" )->will( $this->returnValue( false ) );
        $this->assertFalse( $oView->getSearchCatId() );

        $oView = $this->getMock( "account", array( "getArticleId" ) );
        $oView->expects( $this->once() )->method( "getArticleId" )->will( $this->returnValue( true ) );
        $this->assertEquals( 'testcnid', $oView->getSearchCatId() );
    }

    /**
     * Test get search parameter.
     *
     * @return null
     */
    public function testGetSearchParam()
    {
        modConfig::setParameter( 'searchparam', 'testparam' );

        $oView = $this->getMock( "account", array( "getArticleId" ) );
        $oView->expects( $this->exactly(2) )->method( "getArticleId" )->will( $this->returnValue( false ) );
        $this->assertFalse( $oView->getSearchParam() );
        $this->assertFalse( $oView->getSearchParamForHtml() );

        $oView = $this->getMock( "account", array( "getArticleId" ) );
        $oView->expects( $this->exactly(2) )->method( "getArticleId" )->will( $this->returnValue( true ) );
        $this->assertEquals( 'testparam', $oView->getSearchParam() );
        $this->assertEquals( 'testparam', $oView->getSearchParamForHtml() );
    }

    /**
     * Test get article id.
     *
     * @return null
     */
    public function testGetArticleId()
    {
        modConfig::setParameter( 'aid', null );

        $oView = new account();
        $this->assertNull( $oView->getArticleId() );

        modConfig::setParameter( 'aid', 'testaid' );

        $oView = new account();
        $this->assertEquals( 'testaid', $oView->getArticleId() );
    }

    /**
     * Test get order count.
     *
     * @return null
     */
    public function testGetOrderCnt()
    {
        $oView = $this->getMock( "account", array( "getUser" ) );
        $oView->expects( $this->once() )->method( "getUser" )->will( $this->returnValue( false ) );
        $this->assertEquals( 0, $oView->getOrderCnt() );

        $oUser = $this->getMock( "oxuser", array( "getOrderCount" ) );
        $oUser->expects( $this->once() )->method( "getOrderCount" )->will( $this->returnValue( 999 ) );

        $oView = $this->getMock( "account", array( "getUser" ) );
        $oView->expects( $this->once() )->method( "getUser" )->will( $this->returnValue( $oUser ) );
        $this->assertEquals( 999, $oView->getOrderCnt() );
    }

    /**
     * Test redirect after login.
     *
     * @return null
     */
    public function testRedirectAfterLoginSouldNotRedirect()
    {
        modConfig::setParameter( 'sourcecl', null );

        $oCmp = $this->getMock( "oxcmp_user", array( "getLoginStatus" ) );
        $oCmp->expects( $this->never() )->method( "getLoginStatus" )->will( $this->returnValue( 1 ) );

        $oView = $this->getProxyClass( "Account" );
        $oView->setNonPublicVar( "_oaComponents", array( "oxcmp_user" => $oCmp ) );
        $this->assertNull( $oView->redirectAfterLogin() );
    }

    /**
     * Test redirect after login.
     *
     * @return null
     */
    public function testRedirectAfterLogin()
    {
        oxTestModules::addFunction('oxUtils', 'redirect', '{ return$aA[0];}');

        modConfig::setParameter( 'sourcecl', 'testsource' );
        modConfig::setParameter( 'anid', 'testanid' );

        $oCmp = $this->getMock( "oxcmp_user", array( "getLoginStatus" ) );
        $oCmp->expects( $this->once() )->method( "getLoginStatus" )->will( $this->returnValue( 1 ) );

        $oView = $this->getProxyClass( "Account" );
        $oView->setNonPublicVar( "_oaComponents", array( "oxcmp_user" => $oCmp ) );

        $sParams = '';
        // building redirect link
        foreach ( $oView->getNavigationParams() as $sName => $sValue ) {
            if ( $sValue && $sName != "sourcecl" ) {
                $sParams .= '&'.rawurlencode( $sName ) . "=" . rawurlencode( $sValue );
            }
        }
        $sUrl = oxConfig::getInstance()->getShopUrl().'index.php?cl=testsource'.$sParams;
        $this->assertEquals( $sUrl, $oView->redirectAfterLogin() );
    }

    /**
     * Test get navigation parameters.
     *
     * @return null
     */
    public function testGetNavigationParams()
    {
        modConfig::setParameter( 'sourcecl', 'testsource' );
        modConfig::setParameter( 'anid', 'testanid' );

        $oView = new Account();
        $aNavParams = $oView->getNavigationParams();

        $this->assertTrue( isset( $aNavParams['sourcecl'] ) );
        $this->assertTrue( isset( $aNavParams['anid'] ) );
    }

    /**
     * Test view render.
     *
     * @return null
     */
    public function testRender()
    {
        modConfig::setParameter( 'aid', 'testanid' );

        $oUser = new oxuser();
        $oUser->oxuser__oxpassword = new oxField( 1 );

        $oView = $this->getMock( "account", array( "redirectAfterLogin",
                                                   "getUser", "isEnabledPrivateSales" ) );

        $oView->expects( $this->once() )->method( "redirectAfterLogin" )->will( $this->returnValue( 1 ) );
        $oView->expects( $this->once() )->method( "getUser" )->will( $this->returnValue( $oUser ) );
        $oView->expects( $this->any() )->method( 'isEnabledPrivateSales' )->will( $this->returnValue( false ) );

        $this->assertEquals( 'page/account/dashboard.tpl', $oView->render() );
    }

    /**
     * Test view render.
     *
     * @return null
     */
    public function testRenderNoUser()
    {
        modConfig::setParameter( 'aid', 'testanid' );
        modConfig::getInstance()->setConfigParam( "blPsLoginEnabled", true );

        $oUser = new oxuser();
        $oUser->oxuser__oxpassword = new oxField( 1 );

        $oView = $this->getMock( "account", array( "redirectAfterLogin",
                                                   "getUser", 'isActive' ) );

        $oView->expects( $this->once() )->method( "redirectAfterLogin" )->will( $this->returnValue( 1 ) );
        $oView->expects( $this->once() )->method( "getUser" )->will( $this->returnValue( false ) );
        $oView->expects( $this->any() )->method( 'isActive' )->will( $this->returnValue( true ) );

        $this->assertEquals( 'page/privatesales/login.tpl', $oView->render() );
    }
    
    /**
     * Test Account::getBreadCrumb()
     *
     * @return null
     */
    public function testGetBreadCrumb()
    {   
        $sUsername = 'Username';
        $sLink = 'Link url';
        $oUser = new oxuser();
        $oUser->oxuser__oxusername = new oxField( $sUsername );
        
        $oView = $this->getMock( "account", array( 'getUser', 'getLink' ) );
        $oView->expects( $this->once() )->method( 'getUser' )->will( $this->returnValue( $oUser ) );
        $oView->expects( $this->once() )->method( 'getLink' )->will( $this->returnValue( $sLink ) );
        
        $aBreadCrumbs = $oView->getBreadCrumb();
        
        $this->assertTrue( is_array( $aBreadCrumbs ) );
        $this->assertEquals( 1, count( $aBreadCrumbs ) );
        $this->assertTrue( isset( $aBreadCrumbs[0]['title'] ) );
        $this->assertTrue( isset( $aBreadCrumbs[0]['link'] ) );
        $this->assertEquals( 'Mein Konto - '.$sUsername, $aBreadCrumbs[0]['title'] );
        $this->assertEquals( $sLink, $aBreadCrumbs[0]['link'] );        
    }
    
    /**
     * Test Account::getBreadCrumb()
     *
     * @return null
     */
    public function testGetBreadCrumbNoUser()
    {
        $oAcc = new account();
        $aBreadCrumbs = $oAcc->getBreadCrumb();
        
        $this->assertTrue( is_array( $aBreadCrumbs ) );
        $this->assertEquals( 1, count( $aBreadCrumbs ) );
        $this->assertTrue( isset( $aBreadCrumbs[0]['title'] ) );
        $this->assertTrue( isset( $aBreadCrumbs[0]['link'] ) );        
        $this->assertEquals( 'Anmeldung', $aBreadCrumbs[0]['title'] );
    }
}
