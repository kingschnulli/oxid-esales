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
 * @version   SVN: $Id: suggestTest.php 26841 2010-03-25 13:58:15Z arvydas $
 */

require_once realpath( "." ).'/unit/OxidTestCase.php';
require_once realpath( "." ).'/unit/test_config.inc.php';

class Unit_Views_inviteTest extends OxidTestCase
{
    /**
     * Tear down the fixture.
     *
     * @return null
     */
    protected function tearDown()
    {
        $this->cleanUpTable( 'oxinvitations', 'oxuserid' );

        parent::tearDown();
    }

    /**
     * Testing method setInviteData()
     *
     * @return null
     */
    public function testSetInviteData()
    {
        $oView = $this->getProxyClass( "invite" );
        $oView->setInviteData( "testData" );

        $this->assertEquals( "testData", $oView->getNonPublicVar( "_aInviteData" ) );
    }

    /**
     * Testing method getInviteData()
     *
     * @return null
     */
    public function testGetInviteData()
    {
        $oView = $this->getProxyClass( "invite" );
        $oView->setNonPublicVar( "_aInviteData", "testData" );

        $this->assertEquals( "testData", $oView->getInviteData() );
    }

    /**
     * Testing method _updateStatistics()
     *
     * @return null
     */
    public function testUpdateStatistics()
    {
        $oView = $this->getProxyClass( 'invite' );
        
        $oUtilsDate = $this->getMock('oxUtilsDate', array('formatDBDate'));
        $oUtilsDate->expects($this->once())->method('formatDBDate')->will($this->returnValue("2015-10-11"));
        oxTestModules::addModuleObject('oxUtilsDate', $oUtilsDate);        

        $aRecEmails = array( "test1@oxid-esales.com", "test2@oxid-esales.com" );
        $sUserId = "_testUserId";

        $oView->UNITupdateStatistics( $sUserId, $aRecEmails );

        $aRec = oxDb::getDb( true )->getAll( "select * from oxinvitations order by oxemail");

        $this->assertEquals( $sUserId, $aRec[0]["OXUSERID"] );
        $this->assertEquals( "test1@oxid-esales.com", $aRec[0]["OXEMAIL"] );
        $this->assertEquals( "2015-10-11", $aRec[0]["OXDATE"] );
        $this->assertEquals( "1", $aRec[0]["OXPENDING"] );
        $this->assertEquals( "0", $aRec[0]["OXACCEPTED"] );
        $this->assertEquals( "1", $aRec[0]["OXTYPE"] );

        $this->assertEquals( $sUserId, $aRec[1]["OXUSERID"] );
        $this->assertEquals( "test2@oxid-esales.com", $aRec[1]["OXEMAIL"] );
        $this->assertEquals( "2015-10-11", $aRec[1]["OXDATE"] );
        $this->assertEquals( "1", $aRec[1]["OXPENDING"] );
        $this->assertEquals( "0", $aRec[1]["OXACCEPTED"] );
        $this->assertEquals( "1", $aRec[1]["OXTYPE"] );
    }

    /**
     * Testing method getCaptcha()
     *
     * @return null
     */
    public function testGetCaptcha()
    {
        $oView = $this->getProxyClass( 'invite' );
        $this->assertEquals( oxNew('oxCaptcha'), $oView->getCaptcha() );
    }

    /**
     * Testing method send() - no user input
     *
     * @return null
     */
    public function testSend_noUserInput()
    {
        modConfig::setParameter( 'editval', null );

        $oEmail = $this->getMock('oxEmail', array( 'sendInviteMail' ) );
        $oEmail->expects($this->never())->method('sendInviteMail');
        oxTestModules::addModuleObject( 'oxEmail', $oEmail );

        $oView = $this->getProxyClass( "invite" );
        $oView->send();

        $this->assertNull( $oView->getNonPublicVar( "_iMailStatus" ) );
    }

    /**
     * Testing method send() - no captcha text
     *
     * @return null
     */
    public function testSend_withoutCaptcha()
    {
        modConfig::setParameter( 'editval', array( 'rec_email' => 'testRecEmail@oxid-esales.com', 'send_name' => 'testSendName', 'send_email' => 'testSendEmail@oxid-esales.com', 'send_message' => 'testSendMessage', 'send_subject' => 'testSendSubject' ) );

        $oEmail = $this->getMock('oxEmail', array( 'sendInviteMail' ) );
        $oEmail->expects($this->never())->method('sendInviteMail');
        oxTestModules::addModuleObject( 'oxEmail', $oEmail );

        $oCaptcha = $this->getMock('oxCaptcha', array( 'pass' ) );
        $oCaptcha->expects($this->once())->method('pass')->will( $this->returnValue( false ) );
        oxTestModules::addModuleObject( 'oxCaptcha', $oCaptcha );

        $oView = $this->getProxyClass( "invite" );
        $oView->send();

        $this->assertNull( $oView->getNonPublicVar( "_iMailStatus" ) );
    }

    /**
     * Testing method send()
     *
     * @return null
     */
    public function testSend()
    {
        modConfig::setParameter( 'editval', array( 'rec_email' => array('testRecEmail@oxid-esales.com'), 'send_name' => 'testSendName', 'send_email' => 'testSendEmail@oxid-esales.com', 'send_message' => 'testSendMessage', 'send_subject' => 'testSendSubject' ) );

        $oEmail = $this->getMock('oxEmail', array( 'sendInviteMail' ) );
        $oEmail->expects($this->once())->method('sendInviteMail')->will( $this->returnValue( true ) );
        oxTestModules::addModuleObject( 'oxEmail', $oEmail );

        $oCaptcha = $this->getMock('oxCaptcha', array( 'pass' ) );
        $oCaptcha->expects($this->once())->method('pass')->will( $this->returnValue( true ) );
        oxTestModules::addModuleObject( 'oxCaptcha', $oCaptcha );

        $oView = $this->getProxyClass( "invite" );
        $oView->send();

        $this->assertEquals( "1", $oView->getNonPublicVar( "_iMailStatus" ) );
    }

    /**
     * Testing method send() - on success updated statistics
     *
     * @return null
     */
    public function testSend_updatesStatistics_noActiveUser()
    {
        modConfig::setParameter( 'editval', array( 'rec_email' => array('testRecEmail@oxid-esales.com'), 'send_name' => 'testSendName', 'send_email' => 'testSendEmail@oxid-esales.com', 'send_message' => 'testSendMessage', 'send_subject' => 'testSendSubject' ) );

        $oEmail = $this->getMock('oxEmail', array( 'sendInviteMail' ) );
        $oEmail->expects($this->once())->method('sendInviteMail')->will( $this->returnValue( true ) );
        oxTestModules::addModuleObject( 'oxEmail', $oEmail );

        $oCaptcha = $this->getMock('oxCaptcha', array( 'pass' ) );
        $oCaptcha->expects($this->once())->method('pass')->will( $this->returnValue( true ) );
        oxTestModules::addModuleObject( 'oxCaptcha', $oCaptcha );

        $oUser = new oxUser();

        $oView = $this->getMock('invite', array( '_updateStatistics', 'getUser' ) );
        $oView->expects($this->once())->method('getUser')->will( $this->returnValue( false ) );
        $oView->expects($this->never())->method('_updateStatistics');
        $oView->send();
    }

    /**
     * Testing method send() - on success updated statistics
     *
     * @return null
     */
    public function testSend_updatesStatistics()
    {
        modConfig::setParameter( 'editval', array( 'rec_email' => array('testRecEmail@oxid-esales.com'), 'send_name' => 'testSendName', 'send_email' => 'testSendEmail@oxid-esales.com', 'send_message' => 'testSendMessage', 'send_subject' => 'testSendSubject' ) );

        $oEmail = $this->getMock('oxEmail', array( 'sendInviteMail' ) );
        $oEmail->expects($this->once())->method('sendInviteMail')->will( $this->returnValue( true ) );
        oxTestModules::addModuleObject( 'oxEmail', $oEmail );

        $oCaptcha = $this->getMock('oxCaptcha', array( 'pass' ) );
        $oCaptcha->expects($this->once())->method('pass')->will( $this->returnValue( true ) );
        oxTestModules::addModuleObject( 'oxCaptcha', $oCaptcha );

        $oUser = new oxUser();

        $oView = $this->getMock('invite', array( '_updateStatistics', 'getUser' ) );
        $oView->expects($this->once())->method('getUser')->will( $this->returnValue( $oUser ) );
        $oView->expects($this->once())->method('_updateStatistics');
        $oView->send();
    }

    /**
     * Testing method render()
     *
     * @return null
     */
    public function testRender()
    {
        $oView = $this->getMock( "invite", array( "getCaptcha", 'getInviteData' ) );
        $oView->expects( $this->once() )->method( 'getCaptcha')->will($this->returnValue( 'testCaptcha' ) );
        $oView->expects( $this->once() )->method( 'getInviteData')->will($this->returnValue( 'testInviteData' ) );

        $this->assertEquals( 'invite.tpl', $oView->render() );

        $aViewData = $oView->getViewData();
        $this->assertEquals( 'testCaptcha', $aViewData['oCaptcha'] );
        $this->assertEquals( 'testInviteData', $aViewData['editval'] );
        $this->assertNull( $aViewData['success'] );
    }

    /**
     * Testing method render() - mail was sent status
     *
     * @return null
     */
    public function testRender_mailWasSent()
    {
        $oView = $this->getProxyClass( 'invite' );
        $oView->setNonPublicVar( "_iMailStatus", 1 );
        $oView->render();

        $aViewData = $oView->getViewData();
        $this->assertTrue( $aViewData['success'] );
    }

}
