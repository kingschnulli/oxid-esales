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
 * @version   SVN: $Id: newsletterTest.php 26923 2010-03-29 08:23:58Z arvydas $
 */

require_once realpath( "." ).'/unit/OxidTestCase.php';
require_once realpath( "." ).'/unit/test_config.inc.php';

/**
 * Testing newsletter class.
 */
class Unit_Views_newsletterTest extends OxidTestCase
{
    /**
     * Initialize the fixture.
     *
     * @return null
     */
    protected function setUp()
    {
        parent::setUp();

        modConfig::getInstance()->setConfigParam( 'blEnterNetPrice', false );

        $oUser = oxNew( 'oxuser' );
        $oUser->setId('test');
        $oUser->save();
    }

    /**
     * Tear down the fixture.
     *
     * @return null
     */
    protected function tearDown()
    {
        $oDB = oxDb::getDb();
        $sDelete = "delete from oxobject2group where oxobjectid='test'";
        $oDB->Execute( $sDelete);

        $sDelete = "delete from oxuser where oxid = 'test' or oxusername = 'test@test.de'";
        $oDB->Execute( $sDelete );

        $sDelete = "delete from oxnewssubscribed where oxfname = 'test' or oxuserid = 'test'";
        $oDB->Execute( $sDelete );

        $sDelete = "update oxnewssubscribed set oxunsubscribed='0000-00-00 00:00:00', oxdboptin = '1' where oxuserid = 'oxdefaultadmin'";
        $oDB->Execute( $sDelete );
        parent::tearDown();
    }

    /**
     * Test get top start article.
     *
     * @return null
     */
    public function testGetTopStartArticlePE()
    {
            $oTestNews = oxNew( "NewsLetter" );
            $oArticleList = $oTestNews->getTopStartArticle();

            $this->assertEquals('1849', $oArticleList->getId() );
    }

    /**
     * Test get top start action articles.
     *
     * @return null
     */
    public function testGetTopStartActionArticlesPE()
    {
            $oTestNews = oxNew( "NewsLetter" );
            $oArticleList = $oTestNews->getTopStartActionArticles();

            $this->assertEquals(1, count($oArticleList) );
            $this->assertEquals(89.9, $oArticleList[1849]->getPrice()->getBruttoPrice());
            $this->assertEquals("Bar Butler 6 BOTTLES", $oArticleList[1849]->oxarticles__oxtitle->value);
    }

    /**
     * Test get home country id.
     *
     * @return null
     */
    public function testGetHomeCountryId()
    {
        $oTestNews = oxNew( "NewsLetter" );
        modConfig::getInstance()->setConfigParam( 'aHomeCountry', array('testcountry', 'testcountry1') );
        $sCountryId = $oTestNews->getHomeCountryId();

        $this->assertEquals('testcountry', $sCountryId );
    }

    /**
     * Test get newsletter status after remove.
     *
     * @return null
     */
    public function testGetNewsletterStatusAfterRemoveme()
    {
        $oTestNews = oxNew( "NewsLetter" );
        modConfig::setParameter( 'uid', 'test' );
        $oTestNews->removeme();
        $iStatus = $oTestNews->getNewsletterStatus();

        $this->assertEquals(3, $iStatus );
    }

    /**
     * Test get newsletter status after add.
     *
     * @return null
     */
    public function testGetNewsletterStatusAfterAddme()
    {
        $oTestNews = oxNew( "NewsLetter" );
        modConfig::setParameter( 'uid', 'test' );
        $oTestNews->addme();
        $iStatus = $oTestNews->getNewsletterStatus();

        $this->assertEquals(2, $iStatus );
    }

    /**
     * Test get newsletter status after send.
     *
     * @return null
     */
    public function testGetNewsletterStatusAfterSend()
    {
        oxTestModules::addFunction( "oxemail", "send", "{return true;}" );
        oxTestModules::addFunction( "oxemail", "sendNewsletterDbOptInMail", "{return true;}" );

        $oTestNews = oxNew( "NewsLetter" );
        $aParams = array();
        $aParams['oxuser__oxusername'] = 'test@test.de';
        $aParams['oxuser__oxfname'] = 'test';
        $aParams['oxuser__oxlname'] = 'test';
        $aParams['oxuser__oxcountryid'] = 'test';
        modConfig::setParameter( 'editval', $aParams );
        modConfig::setParameter( 'subscribeStatus', 1 );
        $oTestNews->send();
        $iStatus = $oTestNews->getNewsletterStatus();

        $this->assertEquals(1, $iStatus );
    }

    /**
     * Test get newsletter status after send if user exists.
     *
     * (FS#2406)
     *
     * @return null
     */
    public function testGetNewsletterStatusAfterSendIfUserExist()
    {
        oxTestModules::addFunction( "oxemail", "send", "{return true;}" );
        oxTestModules::addFunction( "oxemail", "sendNewsletterDbOptInMail", "{return true;}" );

        $oTestNews = oxNew( "NewsLetter" );
        $aParams = array();
        $aParams['oxuser__oxusername'] = oxADMIN_LOGIN;
        $aParams['oxuser__oxfname'] = 'test';
        modConfig::setParameter( 'editval', $aParams );
        modConfig::setParameter( 'subscribeStatus', 1 );
        $oTestNews->send();
        $iStatus = $oTestNews->getNewsletterStatus();

        $this->assertEquals(1, $iStatus );
    }

    /**
     * Test if new user was created after subscribe.
     *
     * @return null
     */
    public function testNewUserWasCreatedAfterSubscribe()
    {
        oxTestModules::addFunction( "oxemail", "send", "{return true;}" );
        oxTestModules::addFunction( "oxemail", "sendNewsletterDbOptInMail", "{return true;}" );

        $oDB = oxDb::getDb();

        $oTestNews = oxNew( "NewsLetter" );
        $aParams = array();
        $aParams['oxuser__oxusername'] = 'test@test.de';
        $aParams['oxuser__oxfname'] = 'test';
        modConfig::setParameter( 'editval', $aParams );
        modConfig::setParameter( 'subscribeStatus', 1 );
        $oTestNews->send();

        $sSql = "select oxusername from oxuser where oxusername='test@test.de'";
        $sUserName = $oDB->getOne( $sSql );
        $this->assertEquals( 'test@test.de', $sUserName );
    }

    /**
     * Test if user was added to newsletter list.
     *
     * @return null
     */
    public function testUserWasAddedToNewsletterList()
    {
        oxTestModules::addFunction( "oxemail", "send", "{return true;}" );
        oxTestModules::addFunction( "oxemail", "sendNewsletterDbOptInMail", "{return true;}" );

        $oDB = oxDb::getDb();

        $oTestNews = oxNew( "NewsLetter" );
        $aParams = array();
        $aParams['oxuser__oxusername'] = 'test@test.de';
        $aParams['oxuser__oxfname'] = 'test';
        $aParams['oxuser__oxlname'] = 'test';
        modConfig::setParameter( 'editval', $aParams );
        modConfig::setParameter( 'subscribeStatus', 1 );
        $oTestNews->send();

        $sSql = "select oxdboptin from oxnewssubscribed where oxfname = 'test' AND oxlname = 'test'";
        $sStatus = $oDB->getOne( $sSql );
        $this->assertEquals( '2', $sStatus );
    }

    /**
     * Test if user unsubscribed list.
     *
     * @return null
     */
    public function testUserUnsubscribe()
    {
        oxTestModules::addFunction( "oxemail", "send", "{return true;}" );
        oxTestModules::addFunction( "oxemail", "sendNewsletterDbOptInMail", "{return true;}" );

        $oDB = oxDb::getDb( true );
        $sSql = "select oxusername from oxuser where oxusername='test@test.de'";
        $sUserName = $oDB->getOne( $sSql );
        $this->assertFalse( $sUserName );

        $oTestNews = oxNew( "NewsLetter" );
        $aParams = array();
        $aParams['oxuser__oxusername'] = 'test@test.de';
        $aParams['oxuser__oxfname'] = 'test';
        $aParams['oxuser__oxlname'] = 'test';
        modConfig::setParameter( 'subscribeStatus', 1 );
        modConfig::setParameter( 'editval', $aParams );
        $oTestNews->send();

        $sSql = "select oxdboptin from oxnewssubscribed where oxfname = 'test' AND oxlname = 'test'";
        $sStatus = $oDB->getOne( $sSql );
        $this->assertEquals( '2', $sStatus );

        //unsubscribing
        modConfig::setParameter( 'subscribeStatus', null );
        $oTestNews->send();

        $sSql = "select oxdboptin from oxnewssubscribed where oxfname = 'test' AND oxlname = 'test'";
        $sStatus = $oDB->getOne( $sSql );
        $this->assertEquals( '0', $sStatus );
    }

    /**
     * Test get filled registration paremeters.
     *
     * @return null
     */
    public function testGetRegParamsFill()
    {
        $oTestNews = oxNew( "NewsLetter" );
        $aParams = array();
        $aParams['oxuser__oxusername'] = 'test@test.de';
        $aParams['oxuser__oxfname'] = 'test';
        $aParams['oxuser__oxlname'] = 'test';
        $aParams['oxuser__oxcountryid'] = 'test';
        modConfig::setParameter( 'editval', $aParams );
        $oTestNews->fill();
        $aRegParams = $oTestNews->getRegParams();

        $this->assertEquals($aParams, $aRegParams );
    }

    /**
     * Test remove rom admin.
     *
     * FS#2525, FS#2522
     *
     * @return null
     */
    public function testRemovemeForAdmin()
    {
        $oTestNews = oxNew( "NewsLetter" );
        modConfig::setParameter( 'uid', 'oxdefaultadmin' );
        $oTestNews->removeme();
        $iStatus = $oTestNews->getNewsletterStatus();

        $this->assertEquals(3, $iStatus );
        $this->assertEquals('malladmin', oxDb::getDb()->getOne('select oxrights from oxuser where oxid="oxdefaultadmin"') );
    }

    /**
     * Testing view render method
     *
     * @return null
     */
    public function testRender()
    {
        $oTestNews = $this->getMock( 'NewsLetter', array( 'getTopStartArticle', 'getTopStartActionArticles', 'getHomeCountryId', 'getNewsletterStatus', 'getRegParams' ) );
        $oTestNews->expects( $this->once() )->method( 'getTopStartArticle' )->will( $this->returnValue(1) );
        $oTestNews->expects( $this->once() )->method( 'getTopStartActionArticles' )->will( $this->returnValue(2) );
        $oTestNews->expects( $this->once() )->method( 'getHomeCountryId' )->will( $this->returnValue(3) );
        $oTestNews->expects( $this->once() )->method( 'getNewsletterStatus' )->will( $this->returnValue(4) );
        $oTestNews->expects( $this->once() )->method( 'getRegParams' )->will( $this->returnValue(5) );

        $this->assertEquals( 'newsletter.tpl', $oTestNews->render() );

        $aViewData = $oTestNews->getViewData();
        $this->assertEquals( '1', $aViewData['toparticle'] );
        $this->assertEquals( '2', $aViewData['toparticlelist'] );
        $this->assertEquals( '3', $aViewData['homecountryid'] );
        $this->assertEquals( '4', $aViewData['success'] );
        $this->assertEquals( '5', $aViewData['aRegParams'] );
    }

    /**
     * Testing error messages on worng input
     *
     * @return null
     */
    public function testSubscribingWithWrongInputs()
    {
        oxLang::getInstance()->setBaseLanguage(1);
        $oTestNews = oxNew( "NewsLetter" );
        $aParams = array();

        // no email
        $aParams['oxuser__oxusername'] = '';
        modConfig::setParameter( 'editval', $aParams );

        $oTestNews->send();
        $aErrors = oxSession::getVar( 'Errors' );
        $oErr = unserialize( $aErrors['default'][0] );
        $this->assertEquals( oxLang::getInstance()->translateString('NEWSLETTER_COMPLETEALLFIELEDS'), $oErr->getOxMessage() ) ;

        //reseting errors
        oxSession::setVar( 'Errors', null );

        // wrong email
        $aParams['oxuser__oxusername'] = 'aaaaaa@';
        modConfig::setParameter( 'editval', $aParams );
        $oTestNews->send();

        $aErrors = oxSession::getVar( 'Errors' );
        $oErr = unserialize( $aErrors['default'][0] );
        $this->assertEquals( oxLang::getInstance()->translateString('NEWSLETTER_INVALIDEMAIL'), $oErr->getOxMessage() ) ;
    }

    /**
     * Testing error message when sending email about subscribtion fails
     *
     * @return null
     */
    public function testNewsletterErrorOnFailedEmailSending()
    {
        oxTestModules::addFunction( "oxemail", "send", "{return false;}" );
        oxTestModules::addFunction( "oxemail", "sendNewsletterDbOptInMail", "{return false;}" );

        oxLang::getInstance()->setBaseLanguage(1);
        $oTestNews = oxNew( "NewsLetter" );
        $aParams = array();

        $aParams['oxuser__oxusername'] = 'test@test.de';
        $aParams['oxuser__oxfname'] = 'test';
        modConfig::setParameter( 'subscribeStatus', 1 );
        modConfig::setParameter( 'editval', $aParams );
        $oTestNews->send();

        $aErrors = oxSession::getVar( 'Errors' );
        $oErr = unserialize( $aErrors['default'][0] );
        $this->assertEquals( oxLang::getInstance()->translateString('NEWSLETTER_NOTABLETOSENDEMAIL'), $oErr->getOxMessage() ) ;
    }
}
