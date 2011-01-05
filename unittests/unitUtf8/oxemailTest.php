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
 * @version   SVN: $Id: $
 */

require_once 'unit/OxidTestCase.php';
require_once 'unit/test_config.inc.php';

// modOxEmail class overide some methods
// no actual send by smtp or mail() function
class modOxEmail extends oxEmail
{
    var $blSendReturnValue = true;
    var $blFailedMailErrorWasSent = false;
    public $Timeout = 2;

    /**
     * Class constructor.
     */
    function __construct()
    {
        parent::__construct();

        //all tests were written with this option enabed
        $this->setUseInlineImages(true);
    }

    /**
     * Only used for convenience in UNIT tests by doing so we avoid
     * writing extended classes for testing protected or private methods
     *
     * @param string $method Methods name
     * @param array  $args   Argument array
     *
     * @return string
     */
    public function __call( $method, $args)
    {
        if ( defined( 'OXID_PHP_UNIT' ) ) {
            if ( substr( $method, 0, 4) == "UNIT") {
                $method = str_replace( "UNIT", "_", $method);
            }
            if ( method_exists( $this, $method)) {
                return call_user_func_array( array( & $this, $method), $args );
            }
        }

        throw new Exception( "Function '$method' does not exist or is not accessable!");
    }

    protected function _sendMail()
    {
      return $this->blSendReturnValue;
    }

    protected function _sendMailErrorMsg()
    {
      // assuming mail was sent
      return $this->blFailedMailErrorWasSent = true;
    }

    public function getHost()
    {
      return $this->Host;
    }

    public function getUsername()
    {
      return $this->Username;
    }

    public function getPassword()
    {
      return $this->Password;
    }

    public function setShop( $oShop )
    {
      $this->_oShop = $oShop;
    }

    public function getShop()
    {
      return $this->_oShop;
    }

    public function setOrderOwnerSubjectTemplate( $sTplName = null )
    {
      $this->_sOrderOwnerSubjectTemplate = $sTplName;
    }

    protected function _getShop( $iLangId = null )
    {
        if ( $iLangId ) {
            $oShop = oxNew( "oxshop" );
            $oShop->load( oxConfig::getInstance()->getShopId() );
            $oShop->oxshops__oxorderemail = new oxField('orderemail@orderemail.nl', oxField::T_RAW);
            $oShop->oxshops__oxordersubject = new oxField('testOrderSubject_1', oxField::T_RAW);
            $oShop->oxshops__oxsendednowsubject = new oxField('testSendedNowSubject_1', oxField::T_RAW);
            $oShop->oxshops__oxname = new oxField('testShopName_1', oxField::T_RAW);
            $oShop->oxshops__oxowneremail = new oxField('shopOwner@shopOwnerEmail.nl', oxField::T_RAW);
            $oShop->oxshops__oxinfoemail = new oxField('shopInfoEmail@shopOwnerEmail.nl', oxField::T_RAW);
            //$this->_oShop->oxshops__oxsmtp = new oxField('localhost', oxField::T_RAW);
            $oShop->oxshops__oxsmtp = new oxField('127.0.0.1', oxField::T_RAW);
            $oShop->oxshops__oxsmtpuser = new oxField('testSmtpUser', oxField::T_RAW);
            $oShop->oxshops__oxsmtppwd = new oxField('testSmtpPassword', oxField::T_RAW);
            $oShop->oxshops__oxregistersubject = new oxField('testUserRegistrationSubject_1', oxField::T_RAW);
            $oShop->oxshops__oxforgotpwdsubject = new oxField('testUserFogotPwdSubject_1', oxField::T_RAW);
            $oView = oxConfig::getInstance()->getActiveView();
            $oShop = $oView->addGlobalParams( $oShop );
            return $oShop;
        }
        return parent::_getShop( $iLangId );
    }
}

class modOxOrderEmail extends oxOrder
{
    public function setBasket( $oBasket )
    {
        $this->_oBasket = $oBasket;
    }

    public function setUser( $oUser )
    {
        $this->_oUser = $oUser;
    }

    /*
    function setShop( $oShop ) {
        $this->oShop = $oShop;
    }
  */

    public function setArticles( $aItems )
    {
        $this->oArticles = new oxList();
        $this->oArticles->aList = $aItems;
    }

    public function setDeprecatedValues()
    {
        $this->fprice = 999;
        $this->fproductsprice  = 888;
        $this->fproductsnetprice = 777;
        $this->fdeliverycost = 666;
    }

    public function getPayment()
    {
        $oParentPayment = oxNew( "oxPayment" );
        $oParentPayment->load( "oxidcashondel" );
        return $oParentPayment;
    }
}

class modOxBasketItemEmail extends oxBasketItem
{

    public $dAmount;
    public $ftotalprice;

    public function __call( $method, $args)
    {
        if ( defined( 'OXID_PHP_UNIT' ) ) {
            if ( substr( $method, 0, 4) == "UNIT") {
                $method = str_replace( "UNIT", "_", $method);
            }
            if ( method_exists( $this, $method)) {
                return call_user_func_array( array( & $this, $method), $args );
            }
        }

        throw new Exception( "Function '$method' does not exist or is not accessable!");
    }

    public function setArticle( $sProductId )
    {
        parent::_setArticle( $sProductId );
    }

    public function setAmount( $dAmount, $blOverride = true, $sItemKey = null )
    {
        $this->dAmount = $dAmount;
    }

    public function setDeprecatedValues()
    {
        $this->ftotalprice = 256;
        $this->vatPercent = 19;
        $this->dAmount = 1;
    }
    public function getFTotalPrice()
    {
        return '256,00';
    }
    public function getFUnitPrice()
    {
        return '256,00';
    }

    public function getVatPercent()
    {
        return '19';
}
}
class modOxNewsletterEmail extends oxNewsletter
{
    public $sHtmlText;

    public function setHtmlText( $sHtmlText )
    {
        $this->sHtmlText = $sHtmlText;
    }
}

class modOxBasketEmail extends oxBasket
{

    public $dAmount;
    public $ftotalprice;
    public $aBasketArticles;
    public $aBasketContents;

    public function setDeprecatedValues()
    {
        $this->fprice = 999;
        $this->fproductsprice  = 888;
        $this->fproductsnetprice = 777;
        $this->fdeliverycost = 666;
        $this->aVATs = array('19'=>14.35, '5' => 0.38 );
    }
    public function getBasketArticles()
    {
        return $this->aBasketArticles;
    }

    public function getContents()
    {
        return $this->aBasketContents;
    }
}

class UnitUtf8_oxemailTest extends OxidTestCase
{

    protected $_oEmail = null;
    protected $_oUser  = null;
    protected $_oShop  = null;
    protected $_oArticle  = null;

    /**
     * Initialize the fixture.
     *
     * @return null
     */
    protected function setUp()
    {
        parent::setUp();

        oxConfig::getInstance()->sTheme = false;
        modConfig::getInstance()->sTheme = false;

        $this->_oEmail = oxNew( "modOxEmail");
        $this->cleanUpTable('oxuser');
        $this->cleanUpTable('oxorderarticles');

        //set default user
        $this->_oUser = oxNew( "oxuser" );
        $this->_oUser->setId('_testUserId');
        $this->_oUser->oxuser__oxactive = new oxField('1', oxField::T_RAW);
        $this->_oUser->oxuser__oxusername = new oxField('username@useremail.nl', oxField::T_RAW);
        $this->_oUser->oxuser__oxcustnr = new oxField('998', oxField::T_RAW);
        $this->_oUser->oxuser__oxfname = new oxField('testUserFName', oxField::T_RAW);
        $this->_oUser->oxuser__oxlname = new oxField('testUserLName', oxField::T_RAW);
        $this->_oUser->oxuser__oxpassword = new oxField('ox_BBpaRCslUU8u', oxField::T_RAW); //pass = admin
        $this->_oUser->oxuser__oxregister = new oxField(date("Y-m-d H:i:s"), oxField::T_RAW);
        $this->_oUser->save();

        // set shop params for testing
        $this->_oShop = oxNew( "oxshop" );
        $this->_oShop->load( oxConfig::getInstance()->getShopId() );
        $this->_oShop->oxshops__oxorderemail = new oxField('orderemail@orderemail.nl', oxField::T_RAW);
        $this->_oShop->oxshops__oxordersubject = new oxField('testOrderSubject', oxField::T_RAW);
        $this->_oShop->oxshops__oxsendednowsubject = new oxField('testSendedNowSubject', oxField::T_RAW);
        $this->_oShop->oxshops__oxname = new oxField('testShopName', oxField::T_RAW);
        $this->_oShop->oxshops__oxowneremail = new oxField('shopOwner@shopOwnerEmail.nl', oxField::T_RAW);
        $this->_oShop->oxshops__oxinfoemail = new oxField('shopInfoEmail@shopOwnerEmail.nl', oxField::T_RAW);
        //$this->_oShop->oxshops__oxsmtp = new oxField('localhost', oxField::T_RAW);
        $this->_oShop->oxshops__oxsmtp = new oxField('127.0.0.1', oxField::T_RAW);
        $this->_oShop->oxshops__oxsmtpuser = new oxField('testSmtpUser', oxField::T_RAW);
        $this->_oShop->oxshops__oxsmtppwd = new oxField('testSmtpPassword', oxField::T_RAW);
        $this->_oShop->oxshops__oxregistersubject = new oxField('testUserRegistrationSubject', oxField::T_RAW);
        $this->_oShop->oxshops__oxforgotpwdsubject = new oxField('testUserFogotPwdSubject', oxField::T_RAW);

        $oView = oxConfig::getInstance()->getActiveView();
        $this->_oShop = $oView->addGlobalParams( $this->_oShop );

        // replace default shop
        $this->_oEmail->setShop( $this->_oShop );


        // insert test article
        $this->_oArticle = oxNew( "oxarticle" );
        $this->_oArticle->setId('_testArticleId');
        $this->_oArticle->oxarticles__oxtitle = new oxField('testArticle', oxField::T_RAW);
        $this->_oArticle->oxarticles__oxtitle_1 = new oxField('testArticle_EN', oxField::T_RAW);
        $this->_oArticle->oxarticles__oxartnum = new oxField('123456789', oxField::T_RAW);
        $this->_oArticle->oxarticles__oxshopid = new oxField(oxConfig::getInstance()->getShopId(), oxField::T_RAW);
        //$this->_oArticle->oxarticles__oxamount = new oxField('12', oxField::T_RAW);
        $this->_oArticle->oxarticles__oxshortdesc = new oxField('testArticleDescription', oxField::T_RAW);
        $this->_oArticle->oxarticles__oxprice = new oxField('256', oxField::T_RAW);
        $this->_oArticle->oxarticles__oxremindactive = new oxField('1', oxField::T_RAW);
        $this->_oArticle->oxarticles__oxstock = new oxField('9', oxField::T_RAW);


        $this->_oArticle->save();

        oxDb::getDb()->Execute( "Insert into oxorderarticles (`oxid`, `oxartid`, `oxamount`, `oxtitle`, `oxartnum`)
                  values ('_testOrderArtId', '_testArticleId' , '7' , 'testArticleTitle', '5')" );

    }

    /**
     * Tear down the fixture.
     *
     * @return null
     */
    protected function tearDown()
    {

        $oActShop = oxConfig::getInstance()->getActiveShop();
        $oActShop->setLanguage(0);
        oxLang::getInstance()->setBaseLanguage(0);
        $this->cleanUpTable('oxuser');
        $this->cleanUpTable('oxorderarticles');
        $this->cleanUpTable('oxarticles');

        $this->cleanUpTable('oxremark', 'oxparentid');

        parent::tearDown();
    }

    protected function checkMailFields( $aFields = array() )
    {
        if ( $aFields['sRecipient'] ) {
            $aRecipient = $this->_oEmail->getRecipient();
            $this->assertEquals( $aFields['sRecipient'], $aRecipient[0][0], 'Incorect mail recipient' );
        }

        if ( $aFields['sRecipientName'] ) {
            $aRecipient = $this->_oEmail->getRecipient();
            $this->assertEquals( $aFields['sRecipientName'], $aRecipient[0][1], 'Incorect mail recipient name' );
        }

        if ( $aFields['sSubject'] ) {
            $this->assertEquals( $aFields['sSubject'], $this->_oEmail->getSubject(), 'Incorect mail subject' );
        }

        if ( $aFields['sFrom'] ) {
            $sFrom = $this->_oEmail->getFrom();
            $this->assertEquals( $aFields['sFrom'], $sFrom, 'Incorect mail from address' );
        }

        if ( $aFields['sFromName'] ) {
            $sFromName = $this->_oEmail->getFromName();
            $this->assertEquals( $aFields['sFromName'], $sFromName, 'Incorect mail from name' );
        }

        if ( $aFields['sReplyTo'] ) {
            $aReplyTo = $this->_oEmail->getReplyTo();
            $this->assertEquals( $aFields['sReplyTo'], $aReplyTo[0][0], 'Incorect mail reply to address' );
        }

        if ( $aFields['sReplyToName'] ) {
            $aReplyTo = $this->_oEmail->getReplyTo();
            $this->assertEquals( $aFields['sFromName'], $aReplyTo[0][1], 'Incorect mail reply to name' );
        }

        if ( $aFields['$sBody'] ) {
            $this->assertEquals( $aFields['$sBody'], $this->_oEmail->getBody(), 'Incorect mail body' );
        }

        return true;
    }

    protected function checkMailBody( $sFuncName, $sBody, $blWriteToTestFile = false )
    {

            $sVersion = 'pe';

        if ( oxConfig::getInstance()->isUtf() ) {
            $sVersion = $sVersion.'_utf8';
        }

        $sPath = 'unitUtf8/email_templates/'.$sFuncName.'_'.$sVersion.'.html';
        if ( !($sExpectedBody = file_get_contents($sPath)) ) {
            return false;
        }

        if ($blWriteToTestFile) {
            file_put_contents ('unitUtf8/email_templates/'.$sFuncName.'_testing.html', $sBody );
        }

        //remove <img src="cid:1192193298470f6d12383b8" ... from body, because it is everytime different
        $sExpectedBody = preg_replace("/cid:[0-9a-zA-Z]+\"/", "cid:\"", $sExpectedBody);
        $sBody = preg_replace("/cid:[0-9a-zA-Z]+\"/", "cid:\"", $sBody);

        // A. very special case for user password reminder
        if ( $sFuncName == 'testSendForgotPwdEmail' ) {
            $sExpectedBody = preg_replace("/uid=[0-9a-zA-Z]+\&/", "", $sExpectedBody);
            $sBody = preg_replace("/uid=[0-9a-zA-Z]+\&/", "", $sBody);
        }

        $sExpectedBody = preg_replace("/\s+/", " ", $sExpectedBody);
        $sBody = preg_replace("/\s+/", " ", $sBody);

        $sExpectedBody = str_replace("> <", "><", $sExpectedBody);
        $sBody = str_replace("> <", "><", $sBody);

        $sExpectedShopUrl = "http://localhost/oxideshop/eshop/source/";
        $sShopUrl = oxConfig::getInstance()->getConfigParam( 'sShopURL' );

        //remove shop url base path from links
        //$sExpectedBody = str_replace($sExpectedShopUrl, "", $sExpectedBody);
        $sBody = str_replace($sShopUrl, $sExpectedShopUrl, $sBody);

        $this->assertEquals( $sExpectedBody, $sBody, 'Incorect mail body' );

        return true;
    }

    /*-------------------------------------------------------------*/


    /**
     * When image is taken using getter, it is not included into email by native oxid code
     */
    public function testIncludeImagesErrorTestCase()
    {
        oxTestModules::addFunction( "oxUtilsObject", "generateUId", "{ return 'xxx'; }");
        $myConfig = oxConfig::getInstance();

        $oArticle = new oxarticle();
        $oArticle->load( '1351' );
        $sImgUrl  = $oArticle->getThumbnailUrl();
        $iImgFile = basename( $sImgUrl );
        $sTitle = $oArticle->oxarticles__oxtitle->value;

        $sBody  = '<img src="'.$myConfig->getImageDir().'stars.jpg" border="0" hspace="0" vspace="0" alt="stars" align="texttop">';
        $sBody .= '<img src="'.$myConfig->getNoSSLImageDir().'wishlist.jpg" border="0" hspace="0" vspace="0" alt="wishlist" align="texttop">';
        $sBody .= '<img src="'.$myConfig->getDynImageDir().'0/'.$iImgFile.'" border="0" hspace="0" vspace="0" alt="'.$sTitle.'" align="texttop">';

        $sGenBody  = '<img src="cid:xxx" border="0" hspace="0" vspace="0" alt="stars" align="texttop">';
        $sGenBody .= '<img src="cid:xxx" border="0" hspace="0" vspace="0" alt="wishlist" align="texttop">';
        $sGenBody .= '<img src="cid:xxx" border="0" hspace="0" vspace="0" alt="'.$sTitle.'" align="texttop">';

        $oEmail = $this->getMock( 'oxemail', array( 'getBody', 'addEmbeddedImage', 'setBody' ) );
        $oEmail->expects( $this->once() )->method( 'getBody' )->will($this->returnValue( $sBody ) );
        $oEmail->expects( $this->at( 1 ) )->method( 'addEmbeddedImage' )->with( $this->equalTo( $myConfig->getImageDir().'stars.jpg' ), $this->equalTo( 'xxx' ), $this->equalTo( "image" ), $this->equalTo( "base64"), $this->equalTo( 'image/jpeg' ) )->will( $this->returnValue( true ) );
        $oEmail->expects( $this->at( 2 ) )->method( 'addEmbeddedImage' )->with( $this->equalTo( $myConfig->getImageDir().'wishlist.jpg' ), $this->equalTo( 'xxx' ), $this->equalTo( "image" ), $this->equalTo( "base64"), $this->equalTo( 'image/jpeg' ) )->will( $this->returnValue( true ) );
        $oEmail->expects( $this->at( 3 ) )->method( 'addEmbeddedImage' )->with( $this->equalTo( $myConfig->getAbsDynImageDir().'0/'.$iImgFile ), $this->equalTo( 'xxx' ), $this->equalTo( "image" ), $this->equalTo( "base64"), $this->equalTo( 'image/jpeg' ) )->will( $this->returnValue( true ) );
        $oEmail->expects( $this->once() )->method( 'setBody' )->with( $this->equalTo( $sGenBody ) );

        $oEmail->UNITincludeImages( $myConfig->getImageDir(), $myConfig->getNoSSLImageDir( false ), $myConfig->getDynImageDir(),
                                    $myConfig->getAbsImageDir(), $myConfig->getAbsDynImageDir());
    }

    /*
     * Test sending message by smtp
     */
    public function testSendMailBySmtp()
    {
        $this->_oEmail->SMTP_PORT = '80';

        $this->_oEmail->setSmtp( $this->_oShop );
        $this->_oEmail->setRecipient( $this->_oShop->oxshops__oxorderemail->value, $this->_oShop->oxshops__oxname->value );
        $this->assertTrue( $this->_oEmail->send() );
        $this->assertEquals( 'smtp', $this->_oEmail->getMailer() );
    }

    /*
     * Test sending mail by mail()
     */
    public function testSendMailByPhpMailFunction()
    {
        $this->_oEmail->setMailer( 'mail' );
        $this->_oEmail->setRecipient( $this->_oShop->oxshops__oxorderemail->value, $this->_oShop->oxshops__oxname->value );
        $this->assertTrue( $this->_oEmail->send() );
        $this->assertEquals( 'mail', $this->_oEmail->getMailer() );
    }

    /*
     * Test sending mail by mail() function when sending by smtp fails
     */
    public function testSendMailByPhpMailWhenSmtpFails()
    {
        $this->_oEmail->setRecipient( $this->_oShop->oxshops__oxorderemail->value, $this->_oShop->oxshops__oxname->value );
        $this->_oEmail->blSendReturnValue = false;
        $this->_oEmail->setSmtp( $this->_oShop );
        $this->assertFalse( $this->_oEmail->send() );
        $this->assertEquals( 'mail', $this->_oEmail->getMailer() );
    }

    /*
     * Test sending error message to shop owner when mailing fails
     */
    public function testSendMailErrorMsgWhenMailingFails()
    {
        $this->_oEmail->setRecipient( $this->_oShop->oxshops__oxorderemail->value, $this->_oShop->oxshops__oxname->value );
        $this->_oEmail->blSendReturnValue = false;
        $this->_oEmail->send();
        $this->assertTrue( $this->_oEmail->blFailedMailErrorWasSent );
    }

    /*
     * Test set SMTP params
     */
    public function testSetSmtp()
    {
        // just forcing to connect to webserver..
        $this->_oEmail->SMTP_PORT = '80';

        $this->_oEmail->setSmtp( $this->_oShop );
        $this->assertEquals( 'smtp', $this->_oEmail->getMailer() );
        $this->assertEquals( '127.0.0.1', $this->_oEmail->getHost() );
        $this->assertEquals( 'testSmtpUser', $this->_oEmail->getUsername() );
        $this->assertEquals( 'testSmtpPassword', $this->_oEmail->getPassword() );
    }

    /*
     * Test set SMTP params when no smtp values is set
     */
    public function testSetSmtpWithNoSmtpValues()
    {
        $this->_oShop->oxshops__oxsmtp = new oxField(null, oxField::T_RAW);
        $this->_oEmail->setSmtp( $this->_oShop );
        $this->assertEquals( 'mail', $this->_oEmail->getMailer() );
    }

    /**
     * Test sending ordering mail to user
     */
    public function testSendOrderEmailToUser()
    {
        oxConfig::getInstance()->setConfigParam( 'blSkipEuroReplace', true );
        $oBasketItem = $this->getMock( 'oxbasketitem', array( 'getFUnitPrice', 'getFTotalPrice', 'getVatPercent') );
        $oBasketItem->expects( $this->any() )->method( 'getFUnitPrice' )->will($this->returnValue( '256,00' ) );
        $oBasketItem->expects( $this->any() )->method( 'getFTotalPrice' )->will($this->returnValue( 256 ) );
        $oBasketItem->expects( $this->any() )->method( 'getVatPercent' )->will($this->returnValue( 19 ) );
        $oBasketItem->dAmount = 1;

        $oBasket = oxNew( 'modOxBasketEmail' );
        $oBasket->aBasketContents[0] = $oBasketItem;
        $oBasket->aBasketArticles[0] = $this->_oArticle;
        $oBasket->setDeprecatedValues();

        $oOrder = oxNew( "modOxOrderEmail" );
        $oOrder->oxorder__oxordernr = new oxField('987654321', oxField::T_RAW);
        $oOrder->oxorder__oxbillcompany = new oxField( '' );
        $oOrder->oxorder__oxbillfname = new oxField( '' );
        $oOrder->oxorder__oxbilllname = new oxField( '' );
        $oOrder->oxorder__oxbilladdinfo = new oxField( '' );
        $oOrder->oxorder__oxbillstreet = new oxField( '' );
        $oOrder->oxorder__oxbillcity = new oxField( '' );
        $oOrder->oxorder__oxbillcountry = new oxField( '' );
        $oOrder->oxorder__oxdeltype = new oxField( "oxidstandard" );
        $oOrder->setUser($this->_oUser);
        $oOrder->setBasket($oBasket);

        $blRet = $this->_oEmail->sendOrderEmailToUser( $oOrder );
        $this->assertTrue( $blRet, 'Order email was not sent to customer');

        // check mail fields
        $aFields['sRecipient']     = 'username@useremail.nl';
        $aFields['sRecipientName'] = 'testUserFName testUserLName';
        $aFields['sSubject']       = 'testOrderSubject (#987654321)';
        $aFields['sFrom']          = 'orderemail@orderemail.nl';
        $aFields['sFromName']      = 'testShopName';
        $aFields['sReplyTo']       = 'orderemail@orderemail.nl';
        $aFields['sReplyToName']   = 'testShopName';

        if ( !$this->checkMailFields($aFields) )
            $this->fail('Incorect mail fields');

        //uncoment line to generate templet for checking mail body
        //file_put_contents ('unit/email_templates/'.__FUNCTION__.'.html', $this->_oEmail->getBody() );

        if ( !$this->checkMailBody('testSendOrderEmailToUser', $this->_oEmail->getBody()) )
            $this->fail('Incorect mail body');
    }

    /**
     * Test sending ordering mail to shop owner
     */
    public function testSendOrderEMailToOwner()
    {
        oxConfig::getInstance()->setConfigParam( 'blSkipEuroReplace', true );
        $oBasketItem = $this->getMock( 'oxbasketitem', array( 'getFUnitPrice', 'getFTotalPrice', 'getVatPercent') );
        $oBasketItem->expects( $this->any() )->method( 'getFUnitPrice' )->will($this->returnValue( '256,00' ) );
        $oBasketItem->expects( $this->any() )->method( 'getFTotalPrice' )->will($this->returnValue( 256 ) );
        $oBasketItem->expects( $this->any() )->method( 'getVatPercent' )->will($this->returnValue( 19 ) );
        $oBasketItem->dAmount = 1;

        $oBasket = oxNew( 'modOxBasketEmail' );
        $oBasket->aBasketContents[0] = $oBasketItem;
        $oBasket->aBasketArticles[0] = $this->_oArticle;
        $oBasket->setDeprecatedValues();

        $oOrder = oxNew( "modOxOrderEmail" );
        $oOrder->oxorder__oxordernr = new oxField('987654321', oxField::T_RAW);
        $oOrder->oxorder__oxbillcompany = new oxField( '' );
        $oOrder->oxorder__oxbillfname = new oxField( '' );
        $oOrder->oxorder__oxbilllname = new oxField( '' );
        $oOrder->oxorder__oxbilladdinfo = new oxField( '' );
        $oOrder->oxorder__oxbillstreet = new oxField( '' );
        $oOrder->oxorder__oxbillcity = new oxField( '' );
        $oOrder->oxorder__oxbillcountry = new oxField( '' );
        $oOrder->oxorder__oxdeltype = new oxField( "oxidstandard" );
        $oOrder->setUser($this->_oUser);
        $oOrder->setBasket($oBasket);
        //$oOrder->setShop($this->_oShop);

        // set order subject directly, not through template
        $this->_oEmail->setOrderOwnerSubjectTemplate( null );

        $blRet = $this->_oEmail->sendOrderEmailToOwner( $oOrder );
        $this->assertTrue( $blRet, 'Order email was not sent to shop owner' );

        // check mail fields
        $aFields['sRecipient']     = 'shopOwner@shopOwnerEmail.nl';
        $aFields['sRecipientName'] = 'order';
        $aFields['sSubject']       = 'testOrderSubject (#987654321)';
        $aFields['sFrom']          = 'username@useremail.nl';
        $aFields['sFromName']      = 'testUserFName testUserLName';
        $aFields['sReplyTo']       = 'username@useremail.nl';
        $aFields['sReplyToName']   = 'testUserFName testUserLName';

        if ( !$this->checkMailFields($aFields) )
            $this->fail('Incorect mail fields');

        //uncoment line to generate templet for checking mail body
        //file_put_contents ('unit/email_templates/'.__FUNCTION__.'.html', $this->_oEmail->getBody() );

        if ( !$this->checkMailBody('testSendOrderEMailToOwner', $this->_oEmail->getBody()) )
            $this->fail('Incorect mail body');
    }

    /**
     * Test sending ordering mail to shop owner when shop language is different from admin language.
     * Shop language must be same as admin language.
     */
    public function testSendOrderEMailToOwnerWhenShopLangIsDifferentFromAdminLang()
    {
        $myConfig = oxConfig::getInstance();
        oxLang::getInstance()->setTplLanguage( 1 );

        $oOrder = oxNew( "modOxOrderEmail" );
        $oOrder->oxorder__oxbillcompany = new oxField( '' );
        $oOrder->oxorder__oxbillfname = new oxField( '' );
        $oOrder->oxorder__oxbilllname = new oxField( '' );
        $oOrder->oxorder__oxbilladdinfo = new oxField( '' );
        $oOrder->oxorder__oxbillstreet = new oxField( '' );
        $oOrder->oxorder__oxbillcity = new oxField( '' );
        $oOrder->oxorder__oxbillcountry = new oxField( '' );
        $oOrder->oxorder__oxdeltype = new oxField( "oxidstandard" );
        //$oOrder->setShop($this->_oShop);
        $oOrder->setUser($this->_oUser);
        $oOrder->setBasket( new oxbasket() );

        // set order subject directly, not through template
        $this->_oEmail->setOrderOwnerSubjectTemplate( null );

        $blRet = $this->_oEmail->sendOrderEmailToOwner( $oOrder );
        $this->assertTrue( $blRet, 'Order email was not sent to shop owner' );

        // check mail fields
        $aFields['sRecipient']     = 'shopOwner@shopOwnerEmail.nl';
        $aFields['sRecipientName'] = 'order';
        $aFields['sSubject']       = 'testOrderSubject_1 (#)';
        $aFields['sFrom']          = 'username@useremail.nl';
        $aFields['sFromName']      = 'testUserFName testUserLName';
        $aFields['sReplyTo']       = 'username@useremail.nl';
        $aFields['sReplyToName']   = 'testUserFName testUserLName';

        if ( !$this->checkMailFields($aFields) ) {
            $this->fail('Incorect mail fields');
        }

    }


    /**
     * Test if sending ordering mail to shop owner adds history record into DB
     */
    public function testSendOrderEMailToOwnerAddsHistoryRecord()
    {
        $myConfig = oxConfig::getInstance();
        $myDb = oxDb::getDb();

        $oOrder = oxNew( "modOxOrderEmail" );
        $oOrder->oxorder__oxbillcompany = new oxField( '' );
        $oOrder->oxorder__oxbillfname = new oxField( '' );
        $oOrder->oxorder__oxbilllname = new oxField( '' );
        $oOrder->oxorder__oxbilladdinfo = new oxField( '' );
        $oOrder->oxorder__oxbillstreet = new oxField( '' );
        $oOrder->oxorder__oxbillcity = new oxField( '' );
        $oOrder->oxorder__oxbillcountry = new oxField( '' );
        $oOrder->oxorder__oxdeltype = new oxField( "oxidstandard" );
        //$oOrder->setShop($this->_oShop);
        $oOrder->setUser($this->_oUser);
        $oOrder->setBasket( new oxbasket() );

        // set order subject directly, not through template
        $this->_oEmail->setOrderOwnerSubjectTemplate( null );

        $blRet = $this->_oEmail->sendOrderEmailToOwner( $oOrder );
        $this->assertTrue( $blRet, 'Order email was not sent to shop owner' );

        $this->assertEquals( $this->_oEmail->getAltBody(), $myDb->getOne('SELECT oxtext FROM oxremark where oxparentid='.$myDb->quote($this->_oUser->getId())) );
    }

    /**
     * Test sending ordering mail to shop owner when shop language is different from admin language.
     * Shop language must be same as admin language.
     */
    /*public function testSendOrderEMailToOwnerWhenEmailAddressIsEmpty()
    {
        $myConfig = oxConfig::getInstance();
        $oShop = clone $this->_oShop;
        $oShop->oxshops__oxowneremail = new oxField('', oxField::T_RAW);
        $oEmail = clone $this->_oEmail;
        $oEmail->setShop( $oShop );

        $oOrder = oxNew( "modOxOrderEmail" );
        $oOrder->setUser($this->_oUser);
        $oOrder->setBasket( new oxbasket() );

        // set order subject directly, not through template
        $oEmail->setOrderOwnerSubjectTemplate( null );

        $blRet = $oEmail->sendOrderEmailToOwner( $oOrder );
        $this->assertFalse( $blRet );
    }*/

    /*
     * Test sending registration mail to user
     */
    public function testSendRegisterEMail()
    {
        $blRet = $this->_oEmail->SendRegisterEMail( $this->_oUser );
        $this->assertTrue( $blRet, 'Registration mail was not sent to user' );

        // check mail fields
        $aFields['sRecipient']     = 'username@useremail.nl';
        $aFields['sRecipientName'] = 'testUserFName testUserLName';
        $aFields['sSubject']       = 'testUserRegistrationSubject';
        $aFields['sFrom']          = 'orderemail@orderemail.nl';
        $aFields['sFromName']      = 'testShopName';
        $aFields['sReplyTo']       = 'orderemail@orderemail.nl';
        $aFields['sReplyToName']   = 'testShopName';

        // check mail fields
        if ( !$this->checkMailFields($aFields) )
            $this->fail('Incorect mail fields');

        //uncoment line to generate templet for checking mail body
        //file_put_contents ('unit/email_templates/__'.__FUNCTION__.'.html', $this->_oEmail->getBody() );

        if ( !$this->checkMailBody('testSendRegisterEMail', $this->_oEmail->getBody()) )
            $this->fail('Incorect mail body');
    }


    /*
     * Test sending forgot password to user
     */
    public function testSendForgotPwdEmail()
    {
        $myConfig = oxConfig::getInstance();

        /*
        $sPassword = $this->_oUser->oxuser__oxpassword->value;
        $sPassword = oxUtils::strRem( $sPassword, $myConfig->getShopConfVar('sConfigKey') );
    */

        $blRet = $this->_oEmail->sendForgotPwdEmail( 'username@useremail.nl' );
        $this->assertTrue( $blRet, 'Forgot password email was not sent' );

        // check mail fields
        $aFields['sRecipient']     = 'username@useremail.nl';
        $aFields['sRecipientName'] = 'testUserFName testUserLName';
        $aFields['sSubject']       = 'testUserFogotPwdSubject';
        $aFields['sFrom']          = 'orderemail@orderemail.nl';
        $aFields['sFromName']      = 'testShopName';
        $aFields['sReplyTo']       = 'orderemail@orderemail.nl';
        $aFields['sReplyToName']   = 'testShopName';

        // check mail fields
        if ( !$this->checkMailFields($aFields) )
            $this->fail('Incorect mail fields');

        //uncoment line to generate templet for checking mail body
        //file_put_contents ('unit/email_templates/'.__FUNCTION__.'.html', $this->_oEmail->getBody() );

        if ( !$this->checkMailBody('testSendForgotPwdEmail', $this->_oEmail->getBody()) )
            $this->fail('Incorect mail body');
    }

    /*
     * Test sending forgot password to not existing user
     */
    public function testSendForgotPwdEmailToNotExistingUser()
    {
        $myConfig = oxConfig::getInstance();

        $blRet = $this->_oEmail->SendForgotPwdEmail( 'nosuchuser@useremail.nl' );
        $this->assertFalse( $blRet, 'Mail was sent to not existing user' );
    }



    /*
     * Test sending contact info mail from user to shop owner
     */
    public function testSendContactMail()
    {
        $myConfig = oxConfig::getInstance();

        $sSubject   = 'testSubject';
        $sBody      = 'testBodyMessage';
        $sUserMail  = 'username@useremail.nl';

        $blRet = $this->_oEmail->sendContactMail( $sUserMail, $sSubject, $sBody );
        $this->assertTrue( $blRet, 'Contact user mail was not sent to shop owner' );

        // check mail fields
        $aFields['sRecipient']     = 'shopInfoEmail@shopOwnerEmail.nl';
        $aFields['sRecipientName'] = '';
        $aFields['sSubject']       = $sSubject;
        $aFields['sBody']          = $sBody;
        $aFields['sFrom']          = $sUserMail;
        $aFields['sFromName']      = '';
        $aFields['sReplyTo']       = $sUserMail;
        $aFields['sReplyToName']   = '';

        // check mail fields
        if ( !$this->checkMailFields($aFields) )
            $this->fail('Incorect mail fields');
    }

    /*
     * Test sending newsletter cofirmation mail to user
     */
    public function testSendNewsletterDBOptInMail()
    {
        modSession::getInstance()->setId('xsessx');
        $blRet = $this->_oEmail->sendNewsletterDbOptInMail( $this->_oUser );
        $this->assertTrue( $blRet, 'Newsletter confirmation mail was not sent to user' );

        // check mail fields
        $aFields['sRecipient']     = 'username@useremail.nl';
        $aFields['sRecipientName'] = 'testUserFName testUserLName';
        $aFields['sSubject']       = 'Newsletter testShopName';
        $aFields['sFrom']          = 'shopInfoEmail@shopOwnerEmail.nl';
        $aFields['sFromName']      = 'testShopName';
        $aFields['sReplyTo']       = 'shopInfoEmail@shopOwnerEmail.nl';
        $aFields['sReplyToName']   = 'testShopName';

        // check mail fields
        if ( !$this->checkMailFields($aFields) )
            $this->fail('Incorect mail fields');

        //uncoment line to generate templet for checking mail body
        //file_put_contents ('unit/email_templates/'.__FUNCTION__.'.html', $this->_oEmail->getBody() );

        if ( !$this->checkMailBody('testSendNewsletterDBOptInMail', $this->_oEmail->getBody()) )
            $this->fail('Incorect mail body');
    }

    /*
     * Test sending newsletter mail to user
     */
    public function testSendNewsletterMail()
    {

        $oNewsletter = oxNew( "modOxNewsletterEmail" );
        $oNewsletter->oxnewsletter__oxtitle = new oxField('testNewsletterTitle', oxField::T_RAW);
        $oNewsletter->setHtmlText( 'testNewsletterHtmlText' );

        $blRet = $this->_oEmail->sendNewsletterMail( $oNewsletter, $this->_oUser );
        $this->assertTrue( $blRet, 'Newsletter mail was not sent to user' );

        // check mail fields
        $aFields['sRecipient']     = 'username@useremail.nl';
        $aFields['sRecipientName'] = 'testUserFName testUserLName';
        $aFields['sSubject']       = 'testNewsletterTitle';
        $aFields['sBody']          = 'testNewsletterHtmlText';
        $aFields['sFrom']          = 'orderemail@orderemail.nl';
        $aFields['sFromName']      = 'testShopName';
        $aFields['sReplyTo']       = 'orderemail@orderemail.nl';
        $aFields['sReplyToName']   = 'testShopName';

        // check mail fields
        if ( !$this->checkMailFields($aFields) )
            $this->fail('Incorect mail fields');
    }

    /*
     * Test sending suggest email
     */
    public function testSendSuggestMail()
    {
        $oParams = new Oxstdclass();
        $oParams->rec_email    = 'username@useremail.nl';
        $oParams->rec_name     = 'testUserFName testUserLName';
        $oParams->send_subject = 'testSuggestSubject';
        $oParams->send_email   = 'orderemail@orderemail.nl';
        $oParams->send_name    = 'testShopName';

        $oProduct = oxNewArticle( '_testArticleId' );

        $blRet = $this->_oEmail->sendSuggestMail( $oParams, $oProduct );
        $this->assertTrue( $blRet, 'Suggest mail was not sent to user' );

        // check mail fields
        $aFields['sRecipient']     = $oParams->rec_email;
        $aFields['sRecipientName'] = $oParams->rec_name;
        $aFields['sSubject']       = $oParams->send_subject;
        $aFields['sFrom']          = $oParams->send_email;
        $aFields['sFromName']      = $oParams->send_name;
        $aFields['sReplyTo']       = $oParams->send_email;
        $aFields['sReplyToName']   = $oParams->send_name;

        // check mail fields
        if ( !$this->checkMailFields($aFields) )
            $this->fail('Incorect mail fields');

        //uncoment line to generate templet for checking mail body
        //file_put_contents ('unit/email_templates/'.__FUNCTION__.'.html', $this->_oEmail->getBody() );

        if ( !$this->checkMailBody('testSendSuggestMail', $this->_oEmail->getBody()) )
            $this->fail('Incorect mail body');
    }

    /*
     * Test sending order
     */
    public function testSendSendedNowMail()
    {
        $myConfig = oxConfig::getInstance();
        $myConfig->setConfigParam( 'blAdmin', true );
        //$myConfig->setAdminMode( true );

        $oOrderArticle = oxNew( "oxorderarticle" );
        $oOrderArticle->load('_testOrderArtId');
        $aOrderArticles[] = $oOrderArticle;

        $oOrder = oxNew( "modOxOrderEmail" );
        $oOrder->setArticles($aOrderArticles);
        $oOrder->setUser( $this->_oUser );
        $oOrder->oxorder__oxbillcompany = new oxField( '' );
        $oOrder->oxorder__oxbillfname = new oxField( '' );
        $oOrder->oxorder__oxbilllname = new oxField( '' );
        $oOrder->oxorder__oxbilladdinfo = new oxField( '' );
        $oOrder->oxorder__oxbillstreet = new oxField( '' );
        $oOrder->oxorder__oxbillcity = new oxField( '' );
        $oOrder->oxorder__oxbillcountry = new oxField( '' );
        $oOrder->oxorder__oxdeltype = new oxField( "oxidstandard" );

        $oOrder->oxorder__oxordernr = new oxField('123456789', oxField::T_RAW);
        $oOrder->oxorder__oxbillemail = new oxField('testOrderEmail@testuser.eu', oxField::T_RAW);
        $oOrder->oxorder__oxbillfname = new oxField('testOrderBillFName', oxField::T_RAW);
        $oOrder->oxorder__oxbilllname = new oxField('testOrderBillLName', oxField::T_RAW);
        $oOrder->oxorder__oxuserid = new oxField($this->_oUser->getId(), oxField::T_RAW);

        $blRet = $this->_oEmail->sendSendedNowMail( $oOrder );
        $this->assertTrue( $blRet, 'Suggest mail was not sent to user' );

        // check mail fields
        $aFields['sRecipient']     = 'testOrderEmail@testuser.eu';
        $aFields['sRecipientName'] = 'testOrderBillFName testOrderBillLName';
        $aFields['sSubject']       = 'testSendedNowSubject';
        $aFields['sFrom']          = 'orderemail@orderemail.nl';
        $aFields['sFromName']      = 'testShopName';
        $aFields['sReplyTo']       = 'orderemail@orderemail.nl';
        $aFields['sReplyToName']   = 'testShopName';

        if ( !$this->checkMailFields($aFields) )
            $this->fail('Incorect mail fields');

        //uncoment line to generate templet for checking mail body
        //file_put_contents ('unit/email_templates/'.__FUNCTION__.'.html', $this->_oEmail->getBody() );

        if ( !$this->checkMailBody('testSendSendedNowMail', $this->_oEmail->getBody()) ) {
            $this->fail('Incorect mail body');
    }
    }

    /*
     * Test sending backup mail to shop owner
     */
    public function testSendBackupMail()
    {
        $myConfig = oxConfig::getInstance();

        $aAttFiles    = array();
        $sAttPath     = null;
        $sEmailAddress = 'username@useremail.nl';
        $sSubject     = 'testBackupMailSubject';
        $sMessage     = 'testBackupMailMessage';
        $aStatus      = array();
        $aError       = array();

        $blRet = $this->_oEmail->sendBackupMail( $aAttFiles, $sAttPath, $sEmailAddress, $sSubject, $sMessage, $aStatus, $aError );
        $this->assertTrue( $blRet, 'Backup mail was not sent to shop owner' );

        // check mail fields
        $aFields['sRecipient']     = 'shopInfoEmail@shopOwnerEmail.nl';
        $aFields['sRecipientName'] = '';
        $aFields['sSubject']       = $sSubject;
        $aFields['sBody']          = $sMessage;
        $aFields['sFrom']          = $sEmailAddress;
        $aFields['sFromName']      = '';
        $aFields['sReplyTo']       = $sEmailAddress;
        $aFields['sReplyToName']   = '';

        if ( !$this->checkMailFields($aFields) )
            $this->fail('Incorect mail fields');

    }

    /*
     * Test sending backup mail to shop owner with attachment
     */
    public function testSendBackupMailWithAttachment()
    {
        $myConfig = oxConfig::getInstance();

        $aAttFiles[]  = basename(__FILE__);
        $sAttPath     = getTestsBasePath()."/unitUtf8/";
        $sEmailAdress = 'username@useremail.nl';
        $sSubject     = 'testBackupMailSubject';
        $sMessage     = 'testBackupMailMessage';
        $aStatus      = array();
        $aError       = array();

        $blRet = $this->_oEmail->sendBackupMail( $aAttFiles, $sAttPath, $sEmailAdress, $sSubject, $sMessage, $aStatus, $aError );
        $this->assertTrue( $blRet, 'Backup mail was not sent to shop owner' );
    }

    /*
     * Test sending backup mail to shop owner with attachment status code
     */
    public function testSendBackupMailWithAttachmentStatusCode()
    {
        $myConfig = oxConfig::getInstance();

        $aAttFiles[]  = basename(__FILE__);
        $sAttPath     = getTestsBasePath()."/unitUtf8/";
        $sEmailAdress = 'username@useremail.nl';
        $sSubject     = 'testBackupMailSubject';
        $sMessage     = 'testBackupMailMessage';
        $aStatus      = array();
        $aError       = array();

        $this->_oEmail->sendBackupMail( $aAttFiles, $sAttPath, $sEmailAdress, $sSubject, $sMessage, $aStatus, $aError );

        //check status code
        $this->assertEquals(3, $aStatus[0], "Attachment was not icluded im mail");
    }

    /*
     * Test sending backup mail to shop owner with wrong attachment
     * generates error codes
     */
    public function testSendBackupMailWithWrongAttachmentGeneratesErrorCodes()
    {
        $myConfig = oxConfig::getInstance();

        $aAttFiles[]  = basename(__FILE__);
        $sAttPath     = 'nosuchdir';
        $sEmailAdress = 'username@useremail.nl';
        $sSubject     = 'testBackupMailSubject';
        $sMessage     = 'testBackupMailMessage';
        $aStatus      = array();
        $aError       = array();

        $blRet = $this->_oEmail->sendBackupMail( $aAttFiles, $sAttPath, $sEmailAdress, $sSubject, $sMessage, $aStatus, $aError );
        $this->assertFalse( $blRet, 'Bad backup mail was not sent to shop owner' );

        // checking error codes
        // 4 - backup mail was not sent
        // 5 - file not found
        $this->assertTrue( (in_array(5, $aError[0])), "Wrong attachment was icluded in mail" );
        $this->assertTrue( (in_array(4, $aError[1])), "Wrong attachment was was sent" );
    }


    /*
     * Test sending mail
     */
    public function testSendEmail()
    {
        $sTo = 'username@useremail.nl';
        $sSubject = 'testSubject';
        $sBody = 'testBody';

        $blRet = $this->_oEmail->sendEmail( $sTo, $sSubject, $sBody );
        $this->assertTrue( $blRet, 'Mail was not sent' );

        // check mail fields
        $aFields['sRecipient']     = $sTo;
        $aFields['sBody']          = $sBody;
        $aFields['sSubject']       = $sSubject;
        $aFields['sFrom']          = 'orderemail@orderemail.nl';
        $aFields['sFromName']      = 'testShopName';

        if ( !$this->checkMailFields($aFields) )
            $this->fail('Incorect mail fields');
    }

    /*
     * Test sending mail with to multiple users
     */
    public function testSendEmailToMultipleUsers()
    {
        $aTo = array('username@useremail.nl', 'username2@useremail.nl');
        $sSubject = 'testSubject';
        $sBody = 'testBody';

        $blRet = $this->_oEmail->sendEmail( $aTo, $sSubject, $sBody );
        $this->assertTrue( $blRet, 'Mail was not sent' );

        $aRecipients = $this->_oEmail->getRecipient();
        $this->assertEquals( 2, count($aRecipients) );
        $this->assertEquals( 'username@useremail.nl', $aRecipients[0][0] );
        $this->assertEquals( 'username2@useremail.nl', $aRecipients[1][0] );
    }

    /*
     * Test sends reminder email to shop owner
     */
    public function testSendStockReminder()
    {
        //set params for stock reminder
        $this->_oArticle->oxarticles__oxstock = new oxField('9', oxField::T_RAW);
        $this->_oArticle->oxarticles__oxremindamount = new oxField('9', oxField::T_RAW);
        $this->_oArticle->save();

        $oBasketItem = oxNew( "modOxBasketItemEmail" );
        $oBasketItem->setArticle('_testArticleId');
        $aBasketContents[0] = $oBasketItem;

        $blRet = $this->_oEmail->sendStockReminder( $aBasketContents );
        $this->assertTrue( $blRet, 'Stock remind mail was not sent' );

        // check mail fields
        $aFields['sRecipient']     = 'shopOwner@shopOwnerEmail.nl';
        $aFields['sRecipientName'] = 'testShopName';
        $aFields['sSubject']       = oxLang::getInstance()->translateString('EMAIL_STOCKREMINDER_SUBJECT', 0 );
        $aFields['sFrom']          = 'shopOwner@shopOwnerEmail.nl';
        $aFields['sFromName']      = 'testShopName';

        if ( !$this->checkMailFields($aFields) )
            $this->fail('Incorect mail fields');

        //uncoment line to generate templet for checking mail body
        //file_put_contents ('unit/email_templates/'.__FUNCTION__.'.html', $this->_oEmail->getBody() );

        if ( !$this->checkMailBody('testSendStockReminder', $this->_oEmail->getBody()) )
            $this->fail('Incorect mail body');
    }

    /*
     * #1276: If product is "If out out stock, offline" and remaining stock is ordered, "Shp offline" error is shown in Order step 5
     */
    public function testSendStockReminderIfStockFlag2()
    {
        //set params for stock reminder
        $this->_oArticle->oxarticles__oxstock = new oxField('0', oxField::T_RAW);
        $this->_oArticle->oxarticles__oxstockflag = new oxField('2', oxField::T_RAW);
        $this->_oArticle->oxarticles__oxremindamount = new oxField('0', oxField::T_RAW);
        $this->_oArticle->save();

        $oBasketItem = $this->getProxyClass('oxbasketitem');
        $oBasketItem->setNonPublicVar( '_sProductId', '_testArticleId' );
        $aBasketContents[0] = $oBasketItem;

        $blRet = $this->_oEmail->sendStockReminder( $aBasketContents );
        $this->assertTrue( $blRet, 'Stock remind mail was not sent' );
    }

    /*
     * Test sends reminder email to shop owner when articles amount is more than
     * remind amount
     */
    public function testSendStockReminderWhenStockAmountIsGreaterThanRemindAmount()
    {
        //set params for stock reminder
        $this->_oArticle->oxarticles__oxstock = new oxField('10', oxField::T_RAW);
        $this->_oArticle->oxarticles__oxremindamount = new oxField('9', oxField::T_RAW);
        $this->_oArticle->save();

        $oBasketItem = oxNew( "modOxBasketItemEmail" );
        $oBasketItem->setArticle('_testArticleId');
        $aBasketContents[0] = $oBasketItem;

        $blRet = $this->_oEmail->sendStockReminder( $aBasketContents );
        $this->assertFalse( $blRet, 'No need to send stock remind mail' );
    }

    /*
     * Test sends reminder email to shop owner when remind is off
     */
    public function testSendStockReminderWhenRemindIsOff()
    {
        //set params for stock reminder
        $this->_oArticle->oxarticles__oxremindactive = new oxField('0', oxField::T_RAW);
        $this->_oArticle->oxarticles__oxstock = new oxField('9', oxField::T_RAW);
        $this->_oArticle->oxarticles__oxremindamount = new oxField('10', oxField::T_RAW);
        $this->_oArticle->save();

        $oBasketItem = oxNew( "modOxBasketItemEmail" );
        //$oBasketItem->init('_testArticleId', 9, true);
        $oBasketItem->setArticle('_testArticleId');
        $aBasketContents[0] = $oBasketItem;

        $blRet = $this->_oEmail->sendStockReminder( $aBasketContents );
        $this->assertFalse( $blRet, 'No need to send stock remind mail' );
    }


    /*
     * Test sending whishlist mail to user
     */
    public function testSendWishlistMail()
    {
        $oParams = new oxStdClass();

        $oParams->rec_email    = 'username@useremail.nl';
        $oParams->rec_name     = 'testUserFName testUserLName';
        $oParams->send_subject = 'testSuggestSubject';
        $oParams->send_email   = 'orderemail@orderemail.nl';
        $oParams->send_name    = 'testShopName';
        $oParams->send_id      = '123456789';

        $blRet = $this->_oEmail->sendWishlistMail( $oParams );
        $this->assertTrue( $blRet, 'Whishlist mail was not sent to user' );

        // check mail fields
        $aFields['sRecipient']     = $oParams->rec_email;
        $aFields['sRecipientName'] = $oParams->rec_name;
        $aFields['sSubject']       = $oParams->send_subject;
        $aFields['sFrom']          = $oParams->send_email;
        $aFields['sFromName']      = $oParams->send_name;
        $aFields['sReplyTo']       = $oParams->send_email;
        $aFields['sReplyToName']   = $oParams->send_name;

        // check mail fields
        if ( !$this->checkMailFields($aFields) )
            $this->fail('Incorect mail fields');

        //uncoment line to generate templet for checking mail body
        //file_put_contents ('unit/email_templates/'.__FUNCTION__.'.html', $this->_oEmail->getBody() );

        if ( !$this->checkMailBody('testSendWishlistMail', $this->_oEmail->getBody()) )
        $this->fail('Incorect mail body');
    }


    /*
     * Test sending a notification to the shop owner that pricealarm was subscribed
     */
    public function testSendPriceAlarmNotification()
    {
        $iErrorReporting = error_reporting( E_ALL ^ E_NOTICE );
        $e = null;
        try {

            $oParams = new Oxstdclass();

            $aParams['email'] = 'username@useremail.nl';
            $aParams['aid']   = '_testArticleId';

            $oAlarm = & oxNew( "oxpricealarm");
            $oAlarm->oxpricealarm__oxprice = new oxField('123', oxField::T_RAW);

            $blRet = $this->_oEmail->sendPriceAlarmNotification( $aParams, $oAlarm );
            $this->assertTrue( $blRet, 'Price alarm mail was not sent to user' );

            // check mail fields
            $aFields['sRecipient']     = 'orderemail@orderemail.nl';
            $aFields['sRecipientName'] = 'testShopName';
            $aFields['sSubject']       = oxLang::getInstance()->translateString('EMAIL_PRICEALARM_OWNER_SUBJECT', 0 ) . " testArticle";
            $aFields['sFrom']          = 'username@useremail.nl';
            $aFields['sReplyTo']       = 'username@useremail.nl';

            // check mail fields
            if ( !$this->checkMailFields($aFields) ) {
                $this->fail('Incorect mail fields');
            }

            //uncoment line to generate template for checking mail body
            //file_put_contents ('unit/email_templates/'.__FUNCTION__.'.html', $this->_oEmail->getBody() );

            if ( !$this->checkMailBody('testSendPriceAlarmNotification', $this->_oEmail->getBody()) ) {
                $this->fail('Incorect mail body');
            }
        }
        catch (Exception $e) {
        }

        error_reporting( $iErrorReporting );
        if ($e) {
            throw $e;
        }
    }

    /*
     * Test sending a notification to the shop owner that pricealarm was subscribed in other language
     */
    public function testSendPriceAlarmNotificationInEN()
    {
        $aParams['aid']   = '1126';
        $aParams['email'] = 'info@oxid-esales.com';

        $oShop = $this->getMock( 'oxShop', array( 'getNoSslImageDir' ) );
        $oShop->expects( $this->once() )->method( 'getNoSslImageDir' );
        $oShop->oxshops__oxorderemail = new oxField( 'order@oxid-esales.com' );
        $oShop->oxshops__oxname =  new oxField( 'test shop' );

        $oEmail = $this->getMock( 'oxemail', array( '_clearMailer', '_getShop', '_setMailParams',
                                                    'setRecipient', 'setSubject', 'setBody',
                                                    'setFrom', 'setReplyTo', 'send' ) );

        $oEmail->expects( $this->once() )->method( '_clearMailer' );
        $oEmail->expects( $this->once() )->method( '_getShop' )->will( $this->returnValue( $oShop ) );
        $oEmail->expects( $this->once() )->method( '_setMailParams' )->with( $this->equalTo( $oShop ) );
        $oEmail->expects( $this->once() )->method( 'setRecipient' )->with( $this->equalTo( $oShop->oxshops__oxorderemail->value ), $this->equalTo( $oShop->oxshops__oxname->value ) );
        $oEmail->expects( $this->once() )->method( 'setSubject' )->with( $this->equalTo( "Price alert for article Bar-Set ABSINTH" ) );
        $oEmail->expects( $this->once() )->method( 'setBody' )->with( $this->stringContains( 'info@oxid-esales.com bietet für Artikel Bar-Set ABSINTH, Artnum. 1126' ) );
        $oEmail->expects( $this->once() )->method( 'setFrom' )->with( $this->equalto( $aParams['email'] ), $this->equalto( '' ) );
        $oEmail->expects( $this->once() )->method( 'setReplyTo' )->with( $this->equalto( $aParams['email'] ), $this->equalto( '' ) );
        $oEmail->expects( $this->once() )->method( 'send' )->will( $this->returnValue( 'zzz' ) );

        $oAlarm = new oxStdClass();
        $oAlarm->oxpricealarm__oxprice = new oxField( '100' );
        $oAlarm->oxpricealarm__oxlang = new oxField( '1' );

        $this->assertEquals( 'zzz', $oEmail->sendPriceAlarmNotification( $aParams, $oAlarm ) );

    }

    /*
     * Test including images to mail
     */
    public function testIncludeImages()
    {
        $myConfig  = oxConfig::getInstance();
        $sImageDir = $myConfig->getImageDir();

        $this->_oEmail->setBody( "<img src='{$sImageDir}/barrcode.gif'> --- <img src='{$sImageDir}/cc.jpg'>" );

        $this->_oEmail->UNITincludeImages( $myConfig->getImageDir(), $myConfig->getNoSSLImageDir( isAdmin() ),
                                           $myConfig->getDynImageDir(), $myConfig->getAbsImageDir(),
                                           $myConfig->getAbsDynImageDir() );

        $aAttachments = $this->_oEmail->getAttachments();
        $this->assertEquals('barrcode.gif', $aAttachments[0][1]);
        $this->assertEquals('cc.jpg', $aAttachments[1][1]);
    }

    /*
     * Test setting/getting subject
     */
    public function testSetGetSubject()
    {
        $this->_oEmail->setSubject( 'testSubject' );
        $this->assertEquals( 'testSubject', $this->_oEmail->getSubject() );
    }

    /*
     * Test setting/getting body
     */
    public function testSetGetBody()
    {
        $this->_oEmail->setBody( 'testBody' );
        $this->assertEquals( 'testBody', $this->_oEmail->getBody() );
    }

    /*
     * Test clearing sid from body
     */
    public function testClearSidFromBody()
    {
            $sShopId = 'oxbaseshop';

        $this->_oEmail->setBody( 'testBody index.php?bonusid=111&sid=123456789 blabla', true );
        $this->assertEquals( 'testBody index.php?bonusid=111&sid=x&amp;shp='.$sShopId.' blabla', $this->_oEmail->getBody() );

        $this->_oEmail->setBody( 'testBody index.php?bonusid=111&force_sid=123456789 blabla', true );
        $this->assertEquals( 'testBody index.php?bonusid=111&force_sid=x&amp;shp='.$sShopId.' blabla', $this->_oEmail->getBody() );

        $this->_oEmail->setBody( 'testBody index.php?bonusid=111&admin_sid=123456789 blabla', true );
        $this->assertEquals( 'testBody index.php?bonusid=111&admin_sid=x&amp;shp='.$sShopId.' blabla', $this->_oEmail->getBody() );

        $this->_oEmail->setBody( 'testBody index.php?bonusid=111&force_admin_sid=123456789 blabla', true );
        $this->assertEquals( 'testBody index.php?bonusid=111&force_admin_sid=x&amp;shp='.$sShopId.' blabla', $this->_oEmail->getBody() );
    }

    /*
     * Test setting/getting alt body
     */
    public function testSetGetAltBody()
    {
        $this->_oEmail->setAltBody( 'testAltBody' );
        $this->assertEquals( 'testAltBody', $this->_oEmail->getAltBody() );
    }

    /*
     * Test clearing sid from alt body
     */
        public function testClearSidFromAltBody()
    {
            $sShopId = 'oxbaseshop';

        $this->_oEmail->setAltBody( 'testAltBody index.php?bonusid=111&sid=123456789 blabla', true );
        $this->assertEquals( 'testAltBody index.php?bonusid=111&sid=x&shp='.$sShopId.' blabla', $this->_oEmail->getAltBody() );

        $this->_oEmail->setAltBody( 'testAltBody index.php?bonusid=111&force_sid=123456789 blabla', true );
        $this->assertEquals( 'testAltBody index.php?bonusid=111&force_sid=x&shp='.$sShopId.' blabla', $this->_oEmail->getAltBody() );

        $this->_oEmail->setAltBody( 'testAltBody index.php?bonusid=111&admin_sid=123456789 blabla', true );
        $this->assertEquals( 'testAltBody index.php?bonusid=111&admin_sid=x&shp='.$sShopId.' blabla', $this->_oEmail->getAltBody() );

        $this->_oEmail->setAltBody( 'testAltBody index.php?bonusid=111&force_admin_sid=123456789 blabla', true );
        $this->assertEquals( 'testAltBody index.php?bonusid=111&force_admin_sid=x&shp='.$sShopId.' blabla', $this->_oEmail->getAltBody() );
    }

    /*
     * Test eliminate HTML entities from body
     */
    public function testClearHtmlEntitiesFromAltBody()
    {
        $this->_oEmail->setAltBody( 'testAltBody &amp; &quot; &#039; &lt; &gt;');
        $this->assertEquals( 'testAltBody & " \' < >', $this->_oEmail->getAltBody() );
    }

    /*
     * Test setting/getting mail recipient
     */
    public function testSetGetRecipient()
    {
        $aUser[0][0] =  'testuser@testuser.com';
        $aUser[0][1] =  'testUserName';

        $this->_oEmail->setRecipient( $aUser[0][0], $aUser[0][1] );
        $this->assertEquals( $aUser, $this->_oEmail->getRecipient() );
    }

    /*
     * Test setting recipient with empty email
     */
    public function testSetRecipient_emptyEmail()
    {
        $this->_oEmail->setRecipient( "", "" );
        $this->assertEquals( array(), $this->_oEmail->getRecipient() );
    }

    /*
     * Test setting recipient with empty user name
     */
    public function testSetRecipient_emptyName()
    {
        $this->_oEmail->setRecipient( "test@test.lt", "" );
        $this->assertEquals( array( array("test@test.lt", "" ) ), $this->_oEmail->getRecipient() );
    }

    /*
     * Test setting/getting reply to
     */
    public function testSetGetReplyTo()
    {
        $aUser[0][0] =  'testuser@testuser.com';
        $aUser[0][1] =  'testUserName';

        $this->_oEmail->setReplyTo( $aUser[0][0], $aUser[0][1] );
        $this->assertEquals( $aUser, $this->_oEmail->getReplyTo() );
    }

    /*
     * Test setting reply to with empty value. Should assign deffault reply to address
     */
    public function testSetReplyToWithNoParams()
    {
        $this->_oEmail->setReplyTo();
        $aReplyTo = $this->_oEmail->getReplyTo();
        $this->assertEquals( $this->_oShop->oxshops__oxorderemail->value, $aReplyTo[0][0] );
    }

    /*
     * Test setting/getting from field
     */
    public function testSetGetFrom()
    {
        $this->_oEmail->setFrom( 'testuser@testuser.com', 'testUserName' );
        $this->assertEquals( 'testuser@testuser.com', $this->_oEmail->getFrom() );
        $this->assertEquals( 'testUserName', $this->_oEmail->getFromName() );
    }

    /*
     * Test setting/getting charset
     */
    public function testSetCharSet()
    {
        $this->_oEmail->setCharSet( 'testCharset' );
        $this->assertEquals( 'testCharset', $this->_oEmail->getCharSet() );
    }

    /*
     * Test getting charset default charset
     */
    public function testSetDefaultCharSet()
    {
        $this->_oEmail->setCharSet();
        $this->assertEquals( oxLang::getInstance()->translateString("charset"), $this->_oEmail->getCharSet() );
    }

    /*
     * Test setting/getting mailer
     */
    public function testSetGetMailer()
    {
        $this->_oEmail->setMailer( 'smtp' );
        $this->assertEquals( 'smtp', $this->_oEmail->getMailer() );
    }

    /*
     * Test setting/getting host
     */
    public function testSetGetHost()
    {
        $this->_oEmail->setHost( 'localhost' );
        $this->assertEquals( 'localhost', $this->_oEmail->Host );
    }

    /*
     * Test getting error message
     */
    public function testGetErrorInfo()
    {
        $this->_oEmail->ErrorInfo = 'testErrorMessage';
        $this->assertEquals( 'testErrorMessage', $this->_oEmail->getErrorInfo() );
    }

    /*
     * Test setting mail word wrapping
     */
    public function testSetMailWordWrap()
    {
        $this->_oEmail->setMailWordWrap( '500' );
        $this->assertEquals( '500', $this->_oEmail->WordWrap );
    }


    /*
     * Test getting use inline images property from config
     */
    public function testGetUseInlineImagesFromConfig()
    {
        modConfig::getInstance()->setConfigParam( "blInlineImgEmail", true );
        $oEmail = oxNew("oxemail");
        $this->assertTrue( $oEmail->UNITgetUseInlineImages() );

        modConfig::getInstance()->setConfigParam( "blInlineImgEmail", false );
        $oEmail = oxNew("oxemail");
        $this->assertFalse( $oEmail->UNITgetUseInlineImages() );

        modConfig::getInstance()->setConfigParam( "blInlineImgEmail", true );
        $oEmail = oxNew("oxemail");
        $this->assertTrue( $oEmail->UNITgetUseInlineImages() );
    }

    /*
     * Test setting/getting use inline images
     */
    public function testSetGetUseInlineImages()
    {
        $this->_oEmail->setUseInlineImages( true );
        $this->assertTrue( $this->_oEmail->UNITgetUseInlineImages() );
    }

    /*
     * Test addding attachment to mail
     */
    public function testAddAttachment()
    {
        $myConfig  = oxConfig::getInstance();
        $sImageDir = $myConfig->getAbsImageDir() . '/';

        $this->_oEmail->AddAttachment( $sImageDir, 'barrcode.gif' );
        $aAttachment = $this->_oEmail->getAttachments();

        $this->assertEquals('barrcode.gif', $aAttachment[0][1]);
    }

    /*
     * Test clearing attachments from mail
     */
    public function testClearAttachments()
    {
        $myConfig  = oxConfig::getInstance();
        $sImageDir = $myConfig->getAbsImageDir() . '/';

        $this->_oEmail->AddAttachment( $sImageDir, 'barrcode.gif' );
        $aAttachment = $this->_oEmail->getAttachments();
        $this->assertEquals('barrcode.gif', $aAttachment[0][1]);

        $this->_oEmail->clearAttachments();
        $aAttachment = $this->_oEmail->getAttachments();
        $this->assertEquals(0, count($aAttachment));
    }

    /*
     * Test sending error message to shop owner when mailing by smtp and via mail() fails
     */
    public function testSendMailErrorMsg()
    {
        $this->_oEmail->setRecipient( $this->_oShop->oxshops__oxorderemail->value, $this->_oShop->oxshops__oxname->value );
        $this->_oEmail->blSendReturnValue = false;
        $this->_oEmail->send();

        $this->assertTrue( $this->_oEmail->blFailedMailErrorWasSent, 'Error message about failed mailing was not sent' );
    }

    /*
     * Test hook up method
     */
    public function testAddUserInfoOrderEmail()
    {
        $oOrder = oxNew( "oxorder" );
        //$this->assertEquals( $oOrder, $this->_oEmail->UNITaddUserInfoOrderEmail($oOrder) );
    }

    /*
     * Test hook up method
     */
    public function testAddUserRegisterEmail()
    {
        $this->assertEquals( $this->_oUser, $this->_oEmail->UNITaddUserRegisterEmail($this->_oUser) );
    }

    /*
     * Test hook up method
     */
    public function testAddForgotPwdEmail()
    {
        $this->assertEquals( $this->_oShop, $this->_oEmail->UNITaddForgotPwdEmail($this->_oShop) );
    }

    /*
     * Test hook up method
     */
    public function testAddNewsletterDBOptInMail()
    {
        $this->assertEquals( $this->_oUser, $this->_oEmail->UNITaddNewsletterDbOptInMail($this->_oUser) );
    }

    /*
     * Test clearing mail fields - recipient, reply to, error message
     */
    public function testClearMailer()
    {
        $this->_oEmail->setRecipient('testuser@testuser.com', 'testUser');
        $this->_oEmail->setReplyTo('testuser@testuser.com', 'testUser');
        $this->_oEmail->ErrorInfo = 'testErrorMessage';

        $this->_oEmail->UNITclearMailer();

        $this->assertEquals( array(), $this->_oEmail->getRecipient() );
        $this->assertEquals( array(), $this->_oEmail->getReplyTo() );
        $this->assertEquals( '', $this->_oEmail->getErrorInfo() );
    }

    /*
     * Test setting mail From, FromName, SMTP values with default shop
     */
    public function testSetMailParamsWithDefaultShop()
    {
        // no smtp connect
        $oEmail = $this->getMock( 'oxEmail', array( '_isValidSmtpHost', '_getShop' ) );
        $oEmail->expects( $this->any() )->method( '_isValidSmtpHost' )->will( $this->returnValue( false ) );
        $oEmail->expects( $this->any() )->method( '_getShop' )->will( $this->returnValue( $this->_oShop ) );

        //with no params must get default shop values
        $oEmail->UNITsetMailParams();

        $this->assertEquals( 'orderemail@orderemail.nl', $oEmail->getFrom() );
        $this->assertEquals( 'testShopName', $oEmail->getFromName() );
        $this->assertEquals( 'mail', $oEmail->getMailer() );
    }

    /*
     * Test setting mail From, FromName, SMTP values with shop param
     */
    public function testSetMailParamsWithSelectedShop()
    {
        // with smtp connect
        $oEmail = $this->getMock( 'oxEmail', array( '_isValidSmtpHost', '_getShop' ) );
        $oEmail->expects( $this->any() )->method( '_isValidSmtpHost' )->will( $this->returnValue( true ) );
        $oEmail->expects( $this->any() )->method( '_getShop' )->will( $this->returnValue( $this->_oShop ) );

        $oShop = oxNew( "oxshop" );
        $oShop->oxshops__oxorderemail = new oxField('orderemail2@orderemail2.nl', oxField::T_RAW);
        $oShop->oxshops__oxname = new oxField('testShopName2', oxField::T_RAW);
        $oShop->oxshops__oxsmtp = new oxField('127.0.0.1', oxField::T_RAW);
        $oShop->oxshops__oxsmtpuser = new oxField('testSmtpUser2', oxField::T_RAW);
        $oShop->oxshops__oxsmtppwd = new oxField('testSmtpPassword2', oxField::T_RAW);

        $oEmail->UNITsetMailParams( $oShop );

        $this->assertEquals( 'orderemail2@orderemail2.nl', $oEmail->getFrom() );
        $this->assertEquals( 'testShopName2', $oEmail->getFromName() );
        $this->assertEquals( 'smtp', $oEmail->getMailer() );
        $this->assertEquals( '127.0.0.1', $oEmail->Host );
        $this->assertEquals( 'testSmtpUser2', $oEmail->Username );
        $this->assertEquals( 'testSmtpPassword2', $oEmail->Password );
    }

    /*
     * Test getting active shop when shop already loaded
     */
    public function testGetShop()
    {
        $this->assertEquals( $this->_oShop, $this->_oEmail->UNITgetShop() );
    }

    /*
     * Test getting active shop when shop is not set
     */
    public function testGetShopWhenShopIsNotSet()
    {
        $this->_oEmail->setShop( null );
        $oShop = oxNew( "oxshop" );
        $oShop->load( oxConfig::getInstance()->getShopId() );
        $oView = oxConfig::getInstance()->getActiveView();
        $oShop = $oView->addGlobalParams( $oShop );
        $oRes = $this->_oEmail->UNITgetShop();

        $oShop->popupIdentRand = 'random_md5';
        $oRes->popupIdentRand = 'random_md5';

        $this->assertEquals( $oShop, $oRes);
    }

    /*
     * Test getting active shop in selected lang
     */
    /* oxshop object 'processed' by addBlobalParams is not oxshop object
    public function testGetShopWhenShopInSelectedLanguage()
    {
        $this->_oEmail->setShop( null );
        $oShop = $this->_oEmail->UNITgetShop( 1 );

        $this->assertEquals( 1, $oShop->getLanguage() );
    }*/

    /*
     * Test getting active shop in selected lang
     */
    /* oxshop object 'processed' by addBlobalParams is not oxshop object
    public function testGetShopInOtherLanguage()
    {
        $this->_oEmail->setShop( null );
        $oActShop = oxConfig::getInstance()->getActiveShop();
        $oActShop->setLanguage(1);
        $oShop = $this->_oEmail->UNITgetShop( null );

        $this->assertEquals( 1, $oShop->getLanguage() );
        $oActShop->setLanguage(0);
    }*/

    /*
     * Test setting smtp authentification information
     */
    public function testSetSmtpAuthInfo()
    {
        $this->_oEmail->UNITsetSmtpAuthInfo( 'testUserName', 'testPassword' );

        $this->assertEquals( 'testUserName', $this->_oEmail->Username );
        $this->assertEquals( 'testPassword', $this->_oEmail->Password );
    }

    /*
     * Test setting smtp debug
     */
    public function testSetSmtpDebug()
    {
        $this->_oEmail->UNITsetSmtpDebug( true );
        $this->assertTrue( $this->_oEmail->SMTPDebug );
    }

    /*
     * Test setting phpmailer plugin directory
     */
    public function testSetMailerPluginDir()
    {
        $this->_oEmail->UNITsetMailerPluginDir();
        $this->assertEquals( getShopBasePath()."core/phpmailer/", $this->_oEmail->PluginDir );
    }

    /*
     * Test passing mail body and alt body proccesing through oxoutput
     */
    public function testMakeOutputProcessing()
    {
        $this->_oEmail->setBody( 'testbody 55 �' );        //with euro sign
        $this->_oEmail->setAltBody( 'testaltbody 55 �' ); //with euro sign
        $this->_oEmail->UNITmakeOutputProcessing();

        $this->assertEquals( 'testbody 55 �', $this->_oEmail->getBody() );
        $this->assertEquals( 'testaltbody 55 �', $this->_oEmail->getAltBody() );
    }


    public function testHeaderLine()
    {
        $this->assertEquals("testName: testVar".PHP_EOL, $this->_oEmail->headerLine('testName', 'testVar'));
    }

    public function testHeaderLineXMailer()
    {
        $this->assertNull($this->_oEmail->headerLine('X-Mailer', 'testVal'));
        $this->assertNull($this->_oEmail->headerLine('x-Mailer', 'testVal'));
        $this->assertNull($this->_oEmail->headerLine('X-Priority', 'testVal'));
    }

    /*
     * Test sending mail when no recipient defined
     */
    public function testSend_noRecipient()
    {
        $oEmail = $this->getMock( 'oxemail', array( '_sendMail' ) );
        $oEmail->expects( $this->never() )->method( '_sendMail' );
        $oEmail->setRecipient( "" );
        $this->assertFalse( $this->_oEmail->send() );
    }

    public function testGetNewsSubsLink()
    {
        $sUrl = oxConfig::getInstance()->getShopHomeURL().'cl=newsletter&amp;fnc=addme&amp;uid=XXXX';
        $this->assertEquals($sUrl, $this->_oEmail->UNITgetNewsSubsLink('XXXX'));
        $oActShop = oxConfig::getInstance()->getActiveShop();
        $oActShop->setLanguage(1);
        $this->assertEquals($sUrl, $this->_oEmail->UNITgetNewsSubsLink('XXXX'));
    }

}

