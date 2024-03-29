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
class Unit_Views_accountNewsletterTest extends OxidTestCase
{
    /**
     * Testing Account_Newsletter::getSubscriptionStatus()
     *
     * @return null
     */
    public function testGetSubscriptionStatus()
    {
        $oView = $this->getProxyClass( "Account_Newsletter" );
        $oView->setNonPublicVar( "_iSubscriptionStatus", "testStatus" );
        $this->assertEquals( "testStatus", $oView->getSubscriptionStatus() );
    }

    /**
     * Testing Account_Newsletter::subscribe()
     *
     * @return null
     */
    public function testSubscribeNoSessionUser()
    {
        $oView = $this->getMock( "Account_Newsletter", array( "getUser" ) );
        $oView->expects( $this->once() )->method( 'getUser')->will( $this->returnValue( false ) );
        $this->assertFalse( $oView->subscribe() );
        $this->assertEquals( 0, $oView->getSubscriptionStatus() );
    }

    /**
     * Testing Account_Newsletter::subscribe()
     *
     * @return null
     */
    public function testSubscribeNoStatusDefined()
    {
        modConfig::setParameter( "status", false );

        $oSubscription = $this->getMock( "oxStdClass", array( "setOptInStatus" ) );
        $oSubscription->expects( $this->once() )->method( 'setOptInStatus')->with( $this->equalTo( 0 ) );

        $oUser = $this->getMock( "oxStdClass", array( "removeFromGroup", "getNewsSubscription" ) );
        $oUser->expects( $this->once() )->method( 'removeFromGroup')->with( $this->equalTo( 'oxidnewsletter' ) );
        $oUser->expects( $this->once() )->method( 'getNewsSubscription')->will( $this->returnValue( $oSubscription ) );

        $oView = $this->getMock( "Account_Newsletter", array( "getUser" ) );
        $oView->expects( $this->once() )->method( 'getUser')->will( $this->returnValue( $oUser ) );
        $this->assertNull( $oView->subscribe() );
        $this->assertEquals( -1, $oView->getSubscriptionStatus() );
    }

    /**
     * Testing Account_Newsletter::subscribe()
     *
     * @return null
     */
    public function testSubscribeCustomStatus()
    {
        modConfig::setParameter( "status", true );

        $oSubscription = $this->getMock( "oxStdClass", array( "setOptInStatus", "setOptInEmailStatus" ) );
        $oSubscription->expects( $this->once() )->method( 'setOptInStatus')->with( $this->equalTo( 1 ) );
        $oSubscription->expects( $this->once() )->method( 'setOptInEmailStatus')->with( $this->equalTo( 0 ) );

        $oUser = $this->getMock( "oxStdClass", array( "addToGroup", "getNewsSubscription" ) );
        $oUser->expects( $this->atLeastOnce() )->method( 'addToGroup')->with( $this->equalTo( 'oxidnewsletter' ) );
        $oUser->expects( $this->atLeastOnce() )->method( 'getNewsSubscription')->will( $this->returnValue( $oSubscription ) );

        $oView = $this->getMock( "Account_Newsletter", array( "getUser" ) );
        $oView->expects( $this->once() )->method( 'getUser')->will( $this->returnValue( $oUser ) );
        $this->assertNull( $oView->subscribe() );
        $this->assertEquals( 1, $oView->getSubscriptionStatus() );
    }

    /**
     * Testing Account_Newsletter::isNewsletter()
     *
     * @return null
     */
    public function testIsNewsletterNoSessionUser()
    {
        $oView = $this->getMock( "Account_Newsletter", array( "getUser" ) );
        $oView->expects( $this->once() )->method( 'getUser')->will( $this->returnValue( false ) );
        $this->assertFalse( $oView->isNewsletter() );
    }

    /**
     * Testing Account_Newsletter::isNewsletter()
     *
     * @return null
     */
    public function testIsNewsletter()
    {
        $oSubscription = $this->getMock( "oxStdClass", array( "getOptInStatus" ) );
        $oSubscription->expects( $this->once() )->method( 'getOptInStatus')->will( $this->returnValue( 1 ) );

        $oUser = $this->getMock( "oxStdClass", array( "inGroup", "getNewsSubscription" ) );
        $oUser->expects( $this->once() )->method( 'getNewsSubscription')->will( $this->returnValue( $oSubscription ) );
        $oUser->expects( $this->once() )->method( 'inGroup')->with( $this->equalTo( 'oxidnewsletter' ) )->will( $this->returnValue( true ) );

        $oView = $this->getMock( "Account_Newsletter", array( "getUser" ) );
        $oView->expects( $this->once() )->method( 'getUser')->will( $this->returnValue( $oUser ) );
        $this->assertTrue( $oView->isNewsletter() );
    }

    /**
     * Testing Account_Newsletter::render()
     *
     * @return null
     */
    public function testRenderNoUser()
    {
        $oView = $this->getMock( "Account_Newsletter", array( "getUser" ) );
        $oView->expects( $this->any() )->method( 'getUser')->will( $this->returnValue( false ) );
        $this->assertEquals( 'page/account/login.tpl', $oView->render() );
    }

    /**
     * Testing Account_Newsletter::render()
     *
     * @return null
     */
    public function testRender()
    {
        $oUser = new oxuser;
        $oUser->oxuser__oxpassword = new oxField( "testPassword" );

        $oView = $this->getMock( "Account_Newsletter", array( "getUser" ) );
        $oView->expects( $this->any() )->method( 'getUser')->will( $this->returnValue( $oUser ) );
        $this->assertEquals( 'page/account/newsletter.tpl', $oView->render() );
    }

    /**
     * Testing Account_Newsletter::getBreadCrumb()
     *
     * @return null
     */
    public function testGetBreadCrumb()
    {
        $oAccNewsletter = new Account_Newsletter();

        $this->assertEquals(2, count($oAccNewsletter->getBreadCrumb()));
    }
}