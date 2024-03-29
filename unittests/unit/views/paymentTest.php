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
 * @version   SVN: $Id: paymentTest.php 40613 2011-12-14 13:59:39Z mindaugas.rimgaila $
 */

require_once realpath( "." ).'/unit/OxidTestCase.php';
require_once realpath( "." ).'/unit/test_config.inc.php';

class modOxPayment_payment extends oxPayment
{
    public static $dBasketPrice = null;

    public function isValidPayment($aDynvalue, $sShopId, $oUser, $dBasketPrice, $sShipSetId)
    {
        self::$dBasketPrice = $dBasketPrice;

        return true;
    }
}


class Unit_Views_paymentTest extends OxidTestCase
{
    public function setUp()
    {
        parent::setUp();
        modOxPayment_payment::$dBasketPrice = null;
    }

    /**
     * Tear down the fixture.
     *
     * @return null
     */
    public function tearDown()
    {
        $sDelete = "Delete from oxuserpayments where oxuserid = '_testOxId'";
        oxDb::getDb()->Execute( $sDelete );

        unset($_REQUEST["dynvalue"]["kktype"]);
        unset($_REQUEST["dynvalue"]["kknumber"]);
        unset($_REQUEST["dynvalue"]["kkname"]);
        unset($_REQUEST["dynvalue"]["kkmonth"]);
        unset($_REQUEST["dynvalue"]["kkyear"]);
        unset($_REQUEST["dynvalue"]["kkpruef"]);

        unset($_POST["dynvalue"]["kktype"]);
        unset($_POST["dynvalue"]["kknumber"]);
        unset($_POST["dynvalue"]["kkname"]);
        unset($_POST["dynvalue"]["kkmonth"]);
        unset($_POST["dynvalue"]["kkyear"]);
        unset($_POST["dynvalue"]["kkpruef"]);

        unset($_GET["dynvalue"]["kktype"]);
        unset($_GET["dynvalue"]["kknumber"]);
        unset($_GET["dynvalue"]["kkname"]);
        unset($_GET["dynvalue"]["kkmonth"]);
        unset($_GET["dynvalue"]["kkyear"]);
        unset($_GET["dynvalue"]["kkpruef"]);

        $this->cleanUpTable( 'oxuserpayments' );
        $this->cleanUpTable( 'oxorder' );

        parent::tearDown();
    }

    /**
     * Test payment view getters and setters
     */
    public function testGetPaymentList()
    {
        oxTestModules::addFunction('oxarticle', 'getLink( $iLang = null, $blMain = false  )', '{return "htpp://link_for_article/".$this->getId();}');
        $mySession = oxSession::getInstance();
        modConfig::setParameter( 'sShipSet', 'oxidstandard' );
        modConfig::getInstance()->setConfigParam( "blVariantParentBuyable", 1 );
        /**
         * Preparing input
         */

        $oUser = new oxuser();
        $oUser->load( 'oxdefaultadmin' );
        modConfig::setParameter( 'deladrid', null );

        $oBasket = new oxBasket();
        $oBasket->setBasketUser( $oUser );
        modConfig::getInstance()->setConfigParam( 'blAllowUnevenAmounts', true );
        $oBasket->addToBasket( '1127', 1 );
        $oBasket->calculateBasket();

        //basket name in session will be "basket"
        oxConfig::getInstance()->setConfigParam( 'blMallSharedBasket', 1 );
        $mySession->setBasket( $oBasket );
        //oxSession::setVar( 'basket', $oBasket );

        $oPayment = new Payment();
        $oPayment->setUser($oUser);
        $oPaymentList = $oPayment->getPaymentList();

        $this->assertEquals( 4, count($oPaymentList) );
    }
   /**
     * Test payment view getters and setters
     */
    public function testGetPaymentCnt()
    {
        oxTestModules::addFunction('oxarticle', 'getLink( $iLang = null, $blMain = false  )', '{return "htpp://link_for_article/".$this->getId();}');
        modConfig::setParameter( 'sShipSet', 'oxidstandard' );
        modConfig::getInstance()->setConfigParam( "blVariantParentBuyable", 1 );
        $mySession = oxSession::getInstance();
        /**
         * Preparing input
         */

        $oUser = new oxuser();
        $oUser->load( 'oxdefaultadmin' );
        modConfig::setParameter( 'deladrid', null );

        $oBasket = new oxBasket();
        $oBasket->setBasketUser( $oUser );
        modConfig::getInstance()->setConfigParam( 'blAllowUnevenAmounts', true );
        $oBasket->addToBasket( '1127', 1 );
        $oBasket->calculateBasket();

        //basket name in session will be "basket"
        oxConfig::getInstance()->setConfigParam( 'blMallSharedBasket', 1 );
        //oxSession::setVar( 'basket', $oBasket );
        $mySession->setBasket( $oBasket );

        $oPayment = new Payment();
        $oPayment->setUser($oUser);
        $iCnt = $oPayment->getPaymentCnt();

        $this->assertEquals( 4, $iCnt );
    }

    public function testGetAllSets()
    {
        oxTestModules::addFunction('oxarticle', 'getLink( $iLang = null, $blMain = false  )', '{return "htpp://link_for_article/".$this->getId();}');
        modConfig::setParameter( 'sShipSet', 'oxidstandard' );
        modConfig::getInstance()->setConfigParam( "blVariantParentBuyable", 1 );
        $mySession = oxSession::getInstance();

        $oUser = new oxuser();
        $oUser->load( 'oxdefaultadmin' );
        modConfig::setParameter( 'deladrid', null );

        $oBasket = new oxBasket();
        $oBasket->setBasketUser( $oUser );
        modConfig::getInstance()->setConfigParam( 'blAllowUnevenAmounts', true );
        $oBasket->addToBasket( '1127', 1 );
        $oBasket->calculateBasket();

        //basket name in session will be "basket"
        oxConfig::getInstance()->setConfigParam( 'blMallSharedBasket', 1 );
        //oxSession::setVar( 'basket', $oBasket );
        $mySession->setBasket( $oBasket );

        $oPayment = new Payment();
        $oPayment->setUser($oUser);
        $aAllSets = $oPayment->getAllSets();
        $aSetsIds = array ( 0 => 'oxidstandard', 1 => '1b842e732a23255b1.91207750', 2 => '1b842e732a23255b1.91207751');

        $this->assertEquals( $aSetsIds, array_keys($aAllSets) );
    }

    public function testGetAllSetsCnt()
    {
        oxTestModules::addFunction('oxarticle', 'getLink( $iLang = null, $blMain = false  )', '{return "htpp://link_for_article/".$this->getId();}');
        modConfig::setParameter( 'sShipSet', 'oxidstandard' );
        modConfig::getInstance()->setConfigParam( "blVariantParentBuyable", 1 );
        $mySession = oxSession::getInstance();

        $oUser = new oxuser();
        $oUser->load( 'oxdefaultadmin' );
        modConfig::setParameter( 'deladrid', null );

        $oBasket = new oxBasket();
        $oBasket->setBasketUser( $oUser );
        modConfig::getInstance()->setConfigParam( 'blAllowUnevenAmounts', true );
        $oBasket->addToBasket( '1127', 1 );
        $oBasket->calculateBasket();

        //basket name in session will be "basket"
        oxConfig::getInstance()->setConfigParam( 'blMallSharedBasket', 1 );
        //oxSession::setVar( 'basket', $oBasket );
        $mySession->setBasket( $oBasket );

        $oPayment = new Payment();
        $oPayment->setUser($oUser);
        $iCnt = $oPayment->getAllSetsCnt();

        $this->assertEquals( 3, $iCnt );
    }

    public function testGetEmptyPayment()
    {
        //basket name in session will be "basket"
        oxConfig::getInstance()->setConfigParam( 'blOtherCountryOrder', true );

        $oPayment = new Payment();
        $oPayment->UNITsetDefaultEmptyPayment();
        $oEmptyPayment = $oPayment->getEmptyPayment();

        $this->assertEquals( 'oxempty', $oEmptyPayment->getId() );
    }

    public function testGetPaymentErrorWithoutOtherCountryOrder()
    {
        //basket name in session will be "basket"
        modConfig::getInstance()->setConfigParam( 'blOtherCountryOrder', false );

        $oPayment = new Payment();
        $oPayment->UNITsetDefaultEmptyPayment();

        $this->assertEquals( -2, $oPayment->getPaymentError() );
    }

    public function testGetPaymentErrorFromSession()
    {
        modSession::getInstance()->setVar('payerror', 'test');

        $oPayment = new Payment();
        $oPayment->UNITunsetPaymentErrors();
        $oEmptyPayment = $oPayment->getPaymentError();

        $this->assertEquals( 'test', $oPayment->getPaymentError() );
    }

    public function testGetPaymentErrorTextFromSession()
    {
        modSession::getInstance()->setVar('payerrortext', 'test');

        $oPayment = new Payment();
        $oPayment->UNITunsetPaymentErrors();
        $oEmptyPayment = $oPayment->getPaymentErrorText();

        $this->assertEquals( 'test', $oPayment->getPaymentErrorText() );
    }

    public function testGetPaymentErrorFromRequest()
    {
        modConfig::setParameter('payerror', 'test');

        $oPayment = new Payment();
        $oPayment->UNITunsetPaymentErrors();
        $oEmptyPayment = $oPayment->getPaymentError();

        $this->assertEquals( 'test', $oPayment->getPaymentError() );
    }

    public function testGetPaymentErrorTextFromRequest()
    {
        modConfig::setParameter('payerrortext', 'test');

        $oPayment = new Payment();
        $oPayment->UNITunsetPaymentErrors();
        $oEmptyPayment = $oPayment->getPaymentErrorText();

        $this->assertEquals( 'test', $oPayment->getPaymentErrorText() );
    }

    public function testGetDynValueSetInSession()
    {
        modSession::getInstance()->setVar('dynvalue', 'test');
        modConfig::setParameter('dynvalue', 'test2');

        $oPayment = new Payment();
        $this->assertEquals( 'test', $oPayment->getDynValue() );
    }

    public function testGetDynValueNotSetInSession()
    {
        modSession::getInstance()->setVar('dynvalue', null);
        modConfig::setParameter('dynvalue', 'test2');

        $oPayment = new Payment();
        $this->assertEquals( 'test2', $oPayment->getDynValue() );
    }

    /**
     * Inserting test orders
     */
    protected function _insertTestOrders( $aUserPaymentId, $sUserId )
    {
        $oDb = oxDb::getDb();

        $sQ = "INSERT INTO `oxorder`
                   (`OXID`, `OXSHOPID`, `OXUSERID`, `OXORDERDATE`, `OXORDERNR`, `OXBILLCOMPANY`, `OXBILLEMAIL`, `OXBILLFNAME`, `OXBILLLNAME`, `OXBILLSTREET`, `OXBILLSTREETNR`, `OXBILLADDINFO`, `OXBILLUSTID`, `OXBILLCITY`, `OXBILLCOUNTRYID`, `OXBILLSTATEID`, `OXBILLZIP`, `OXBILLFON`, `OXBILLFAX`, `OXBILLSAL`, `OXDELCOMPANY`, `OXDELFNAME`, `OXDELLNAME`, `OXDELSTREET`, `OXDELSTREETNR`, `OXDELADDINFO`, `OXDELCITY`, `OXDELCOUNTRYID`, `OXDELSTATEID`, `OXDELZIP`, `OXDELFON`, `OXDELFAX`, `OXDELSAL`, `OXPAYMENTID`, `OXPAYMENTTYPE`, `OXTOTALNETSUM`, `OXTOTALBRUTSUM`, `OXTOTALORDERSUM`, `OXARTVAT1`, `OXARTVATPRICE1`, `OXARTVAT2`, `OXARTVATPRICE2`, `OXDELCOST`, `OXDELVAT`, `OXPAYCOST`, `OXPAYVAT`, `OXWRAPCOST`, `OXWRAPVAT`, `OXCARDID`, `OXCARDTEXT`, `OXDISCOUNT`, `OXEXPORT`, `OXBILLNR`, `OXTRACKCODE`, `OXSENDDATE`, `OXREMARK`, `OXVOUCHERDISCOUNT`, `OXCURRENCY`, `OXCURRATE`, `OXFOLDER`, `OXTRANSID`, `OXPAYID`, `OXXID`, `OXPAID`, `OXSTORNO`, `OXIP`, `OXTRANSSTATUS`, `OXLANG`, `OXINVOICENR`, `OXDELTYPE`)
               VALUES
                   (?, ?, ?, ?, ?, '', 'info@oxid-esales.com', 'Marc', 'Muster', 'Hauptstr.', '13', '', '', 'Freiburg', 'a7c40f631fc920687.20179984', 'BW', '79098', '', '', 'MR', '', '', '', '', '', '', '', '', '', '', '', '', '', ?, 'oxiddebitnote', 1639.15, 2108.39, 1950.59, 19, 311.44, 0, 0, 0, 19, 0, 0, 0, 0, '', '', 157.8, 0, '', '', '0000-00-00 00:00:00', 'Hier k�nnen Sie uns noch etwas mitteilen.', 0, 'EUR', 1, 'ORDERFOLDER_NEW', '', '', '', '0000-00-00 00:00:00', 0, '', 'OK', 0, 0, 'oxidstandard')";

        $sShopId = oxConfig::getInstance()->GetBaseShopId();
        foreach ( $aUserPaymentId as $iCnt => $sUserPaymentId ) {

            $sOrderId = "_test" . ( time() + $iCnt );
            $sOrderDate = "2011-03-1{$iCnt} 10:55:13";

            $oDb->execute( $sQ, array( $sOrderId, $sShopId, $sUserId, $sOrderDate, $iCnt + 1, $sUserPaymentId ) );
        }
    }

    public function testGetDynValueIfDebitNoteIsSet()
    {
        $this->_insertTestOrders( array( '_testOxId3', '_testOxId2', '_testOxId' ), "oxdefaultadmin" );
        modSession::getInstance()->setVar('dynvalue', array('lsbankname'=>''));

        $oUser = new oxuser();
        $oUser->load( 'oxdefaultadmin' );

        $oUpay = oxNew( 'oxuserpayment' );
        $oUpay->setId( '_testOxId' );
        $oUpay->oxuserpayments__oxuserid = new oxField('oxdefaultadmin', oxField::T_RAW);
        $oUpay->oxuserpayments__oxvalue = new oxField('lsbankname__test@@', oxField::T_RAW);
        $oUpay->oxuserpayments__oxpaymentsid = new oxField('oxiddebitnote', oxField::T_RAW);
        $oUpay->save();

        $oPayment = $this->getMock( "payment", array( "getPaymentList" ) );
        $oPayment->expects( $this->once() )->method( 'getPaymentList')->will( $this->returnValue( array( 'oxiddebitnote' => true ) ) );
        $oPayment->setUser( $oUser );
        $this->assertEquals( array('lsbankname'=>'test'), $oPayment->getDynValue() );
    }

    public function testGetCheckedPaymentId()
    {
        modConfig::setParameter('paymentid', 'testId');

        $oPayment = $this->getProxyClass( "payment" );
        $oPaymentList = array();
        $oPaymentList['testId'] = true;
        $oPayment->setNonPublicVar( "_oPaymentList", $oPaymentList );

        $this->assertEquals( 'testId', $oPayment->getCheckedPaymentId() );
    }

    public function testGetCheckedPaymentIdSelectedPayment()
    {
        modConfig::setParameter('paymentid', null);
        modSession::getInstance()->setVar('_selected_paymentid', 'testId2');

        $oPayment = $this->getProxyClass( "payment" );
        $oPaymentList = array();
        $oPaymentList['testId2'] = true;
        $oPayment->setNonPublicVar( "_oPaymentList", $oPaymentList );

        $this->assertEquals( 'testId2', $oPayment->getCheckedPaymentId() );
    }

    public function testGetCheckedPaymentIdLastUserPaymentType()
    {
        modConfig::setParameter('paymentid', null);
        modSession::getInstance()->setVar('_selected_paymentid', null);

        $oUser = new oxuser();
        $oUser->load( 'oxdefaultadmin' );

        oxTestModules::addFunction('oxorder', 'getLastUserPaymentType', '{return "testId3";}');
        $oPayment = $this->getProxyClass( "payment" );
        $oPayment->setUser($oUser);
        $oPaymentList = array();
        $oPaymentList['testId3'] = true;
        $oPayment->setNonPublicVar( "_oPaymentList", $oPaymentList );

        $this->assertEquals( 'testId3', $oPayment->getCheckedPaymentId() );
    }

    public function testGetCheckedPaymentIdNotAllowed()
    {
        modConfig::setParameter('paymentid', null);
        modSession::getInstance()->setVar('_selected_paymentid', 'testId4');

        $oPayment = $this->getProxyClass( "payment" );
        $oPaymentList = array();
        $oPaymentList['testId3'] = true;
        $oPayment->setNonPublicVar( "_oPaymentList", $oPaymentList );

        $this->assertEquals( 'testId3', $oPayment->getCheckedPaymentId() );
    }

    public function testGetCheckedPaymentIdInDB()
    {
        modConfig::setParameter('paymentid', null);
        modSession::getInstance()->setVar('_selected_paymentid', null);
        $oPayment = $this->getProxyClass( "payment" );
        $oPaymentList = array();
        $oPaymentList['testId'] = true;
        $oPayment->setNonPublicVar( "_sCheckedId", 'testId' );
        $oPayment->setNonPublicVar( "_oPaymentList", $oPaymentList );

        $this->assertEquals( 'testId', $oPayment->getCheckedPaymentId() );
    }

    public function testGetCreditYears()
    {
        $oPayment = $this->getProxyClass( "payment" );

        $this->assertEquals( range( date('Y'), date('Y') + 10 ), $oPayment->getCreditYears() );
    }

    /*
     * Check if payment validation uses basket price getted from oxBasket::getPriceForPayment()
     * (M:1145)
     */
    public function testValidatePayment_userBasketPriceForPayment()
    {
        $oUser = new oxUser;
        $oUser->load( 'oxdefaultadmin' );

        oxAddClassModule('modOxPayment_payment', 'oxPayment');

        $oBasket = $this->getMock( 'oxBasket', array( 'getPriceForPayment' ) );
        $oBasket->expects( $this->once() )->method( 'getPriceForPayment')->will( $this->returnValue( 100 ) );

        $oSession = $this->getMock( 'oxSession', array( 'getBasket' ) );
        $oSession->expects( $this->once() )->method( 'getBasket')->will( $this->returnValue( $oBasket ) );

        $oPayment = $this->getMock( 'Payment', array( 'getUser', 'getSession' ) );
        $oPayment->expects( $this->once() )->method( 'getUser')->will( $this->returnValue( $oUser ) );
        $oPayment->expects( $this->once() )->method( 'getSession')->will( $this->returnValue( $oSession ) );
        modConfig::setParameter( "paymentid", 'testId' );

        $oPayment->validatePayment();

        $this->assertEquals( 100, modOxPayment_payment::$dBasketPrice );
    }

    /*
     * #M1432: Error message by shipping options - Frontend
     */
    public function testValidatePaymentDifferentShipping()
    {
        $oUser = new oxUser;
        $oUser->load( 'oxdefaultadmin' );

        oxAddClassModule('modOxPayment_payment', 'oxPayment');

        $oBasket = $this->getMock( 'oxBasket', array( 'getPriceForPayment' ) );
        $oBasket->expects( $this->once() )->method( 'getPriceForPayment')->will( $this->returnValue( 100 ) );
        $oBasket->setShipping('currentShipping');

        $oSession = $this->getMock( 'oxSession', array( 'getBasket' ) );
        $oSession->expects( $this->once() )->method( 'getBasket')->will( $this->returnValue( $oBasket ) );

        $oPayment = $this->getMock( 'Payment', array( 'getUser', 'getSession' ) );
        $oPayment->expects( $this->once() )->method( 'getUser')->will( $this->returnValue( $oUser ) );
        $oPayment->expects( $this->once() )->method( 'getSession')->will( $this->returnValue( $oSession ) );
        modConfig::setParameter( "paymentid", 'testId' );
        modConfig::setParameter( "sShipSet", 'newShipping' );

        $oPayment->validatePayment();

        $this->assertEquals( 'newShipping', $oBasket->getShippingId() );
    }

    public function testFilterDynDataNotFiltered()
    {
        $oSubj = $this->getProxyClass("payment");
        modConfig::getInstance()->setConfigParam("blStoreCreditCardInfo", 1);

        $sTNumber = "tstNumber";
        $sTName = "tstName";
        $sTMonth = "tstMonth";
        $sTYear = "tstYEar";
        $sTProof = "tstProof";
        $sTVal = "testVal";

        $aDynData = array("testKey" => "testVal",
                          "kknumber" => $sTNumber,
                          "kkname" => $sTName,
                          "kkmonth" => $sTMonth,
                          "kkyear" => $sTYear,
                          "kkpruef" => $sTProof
                            );

        modConfig::getInstance()->setParameter("dynvalue", $aDynData);


        $_REQUEST["dynvalue"]["testKey"] = $sTVal;
        $_REQUEST["dynvalue"]["kknumber"] = $sTNumber;
        $_REQUEST["dynvalue"]["kkname"] = $sTName;
        $_REQUEST["dynvalue"]["kkmonth"] = $sTMonth;
        $_REQUEST["dynvalue"]["kkyear"] = $sTYear;
        $_REQUEST["dynvalue"]["kkpruef"] = $sTProof;

        $_POST["dynvalue"]["testKey"] = $sTVal;
        $_POST["dynvalue"]["kknumber"] = $sTNumber;
        $_POST["dynvalue"]["kkname"] = $sTName;
        $_POST["dynvalue"]["kkmonth"] = $sTMonth;
        $_POST["dynvalue"]["kkyear"] = $sTYear;
        $_POST["dynvalue"]["kkpruef"] = $sTProof;

        $_GET["dynvalue"]["testKey"] = $sTVal;
        $_GET["dynvalue"]["kknumber"] = $sTNumber;
        $_GET["dynvalue"]["kkname"] = $sTName;
        $_GET["dynvalue"]["kkmonth"] = $sTMonth;
        $_GET["dynvalue"]["kkyear"] = $sTYear;
        $_GET["dynvalue"]["kkpruef"] = $sTProof;

        $oSubj->UNITfilterDynData();

        $aDynData = modConfig::getInstance()->getParameter("dynvalue");

        $this->assertEquals( $aDynData["kknumber"], $sTNumber);
        $this->assertEquals( $_REQUEST["dynvalue"]["kknumber"], $sTNumber);
        $this->assertEquals( $_POST["dynvalue"]["kknumber"], $sTNumber);
        $this->assertEquals( $_GET["dynvalue"]["kknumber"], $sTNumber);
    }

    public function testFilterDynDataFiltered()
    {
        $oSubj = $this->getProxyClass("payment");
        modConfig::getInstance()->setConfigParam("blStoreCreditCardInfo", 0);

        $sTNumber = "tstNumber";
        $sTName = "tstName";
        $sTMonth = "tstMonth";
        $sTYear = "tstYEar";
        $sTProof = "tstProof";
        $sTVal = "testVal";

        $aDynData = array("testKey" => $sTVal,
                          "kknumber" => $sTNumber,
                          "kkname" => $sTName,
                          "kkmonth" => $sTMonth,
                          "kkyear" => $sTYear,
                          "kkpruef" => $sTProof
                            );

        modConfig::getInstance()->setParameter("dynvalue", $aDynData);

        $_REQUEST["dynvalue"]["testKey"] = $sTVal;
        $_REQUEST["dynvalue"]["kknumber"] = $sTNumber;
        $_REQUEST["dynvalue"]["kkname"] = $sTName;
        $_REQUEST["dynvalue"]["kkmonth"] = $sTMonth;
        $_REQUEST["dynvalue"]["kkyear"] = $sTYear;
        $_REQUEST["dynvalue"]["kkpruef"] = $sTProof;

        $_POST["dynvalue"]["testKey"] = $sTVal;
        $_POST["dynvalue"]["kknumber"] = $sTNumber;
        $_POST["dynvalue"]["kkname"] = $sTName;
        $_POST["dynvalue"]["kkmonth"] = $sTMonth;
        $_POST["dynvalue"]["kkyear"] = $sTYear;
        $_POST["dynvalue"]["kkpruef"] = $sTProof;

        $_GET["dynvalue"]["testKey"] = $sTVal;
        $_GET["dynvalue"]["kknumber"] = $sTNumber;
        $_GET["dynvalue"]["kkname"] = $sTName;
        $_GET["dynvalue"]["kkmonth"] = $sTMonth;
        $_GET["dynvalue"]["kkyear"] = $sTYear;
        $_GET["dynvalue"]["kkpruef"] = $sTProof;

        $oSubj->UNITfilterDynData();

        $aDynData = modConfig::getInstance()->getParameter("dynvalue");

        //$this->assertEquals($aDynData["testKey"], $sTVal);
        //$this->assertNull($aDynData["kknumber"]);
        //$this->assertNull($aDynData["kkname"]);
        //$this->assertNull($aDynData["kkmonth"]);
        //$this->assertNull($aDynData["kkyear"]);
        //$this->assertNull($aDynData["kkpruef"]);

        $this->assertNull(modSession::getInstance()->getVar("kknumber"));
        $this->assertNull(modSession::getInstance()->getVar("kkname"));
        $this->assertNull(modSession::getInstance()->getVar("kkmonth"));
        $this->assertNull(modSession::getInstance()->getVar("kkyear"));
        $this->assertNull(modSession::getInstance()->getVar("kkpruef"));

        $this->assertFalse($this->_checkInArrayRecursive($sTNumber, $_REQUEST));
        $this->assertFalse($this->_checkInArrayRecursive($sTNumber, $_POST));
        $this->assertFalse($this->_checkInArrayRecursive($sTNumber, $_GET));
        if (is_array($_SERVER)) {
            $this->assertFalse($this->_checkInArrayRecursive($sTNumber, $_SERVER));
        }

        $this->assertNull( $_REQUEST["dynvalue[kknumber]"]);
        $this->assertNull( $_REQUEST["dynvalue[kkname]"]);
        $this->assertNull( $_REQUEST["dynvalue[kkmonth]"]);
        $this->assertNull( $_REQUEST["dynvalue[kkyear]"]);
        $this->assertNull( $_REQUEST["dynvalue[kkpruef]"]);

        $this->assertNull( $_POST["dynvalue[kknumber]"]);
        $this->assertNull( $_POST["dynvalue[kkname]"]);
        $this->assertNull( $_POST["dynvalue[kkmonth]"]);
        $this->assertNull( $_POST["dynvalue[kkyear]"]);
        $this->assertNull( $_POST["dynvalue[kkpruef]"]);

        $this->assertNull( $_GET["dynvalue[kknumber]"]);
        $this->assertNull( $_GET["dynvalue[kkname]"]);
        $this->assertNull( $_GET["dynvalue[kkmonth]"]);
        $this->assertNull( $_GET["dynvalue[kkyear]"]);
        $this->assertNull( $_GET["dynvalue[kkpruef]"]);

    }

    protected function _checkInArrayRecursive($needle, $haystack)
    {
        foreach ($haystack as $v) {
                if ($needle == $v) {
                    return true;
                } elseif (is_array($v)) {
                    return $this->_checkInArrayRecursive($needle, $v);
                }
        }
        return false;
    }

    public function testRenderDoesNotCleanReservationsIfOff()
    {
        oxTestModules::addFunction('oxUtils', 'redirect', '{throw new Exception("REDIRECT");}');
        modConfig::getInstance()->setConfigParam('blPsBasketReservationEnabled', false);

        $oS = $this->getMock('oxsession', array('getBasketReservations'));
        $oS->expects($this->never())->method('getBasketReservations');

        $oP = $this->getMock('payment', array('getSession'));
        $oP->expects($this->any())->method('getSession')->will($this->returnValue($oS));

        try {
            $oP->render();
        } catch (Exception $e) {
            $this->assertEquals("REDIRECT", $e->getMessage());
        }
    }
    public function testRenderDoesCleanReservationsIfOn()
    {
        oxTestModules::addFunction('oxUtils', 'redirect', '{throw new Exception("REDIRECT");}');
        modConfig::getInstance()->setConfigParam('blPsBasketReservationEnabled', true);

        $oR = $this->getMock('stdclass', array('renewExpiration'));
        $oR->expects($this->once())->method('renewExpiration')->will($this->returnValue(null));

        $oS = $this->getMock('oxsession', array('getBasketReservations'));
        $oS->expects($this->once())->method('getBasketReservations')->will($this->returnValue($oR));

        $oP = $this->getMock('payment', array('getSession'));
        $oP->expects($this->any())->method('getSession')->will($this->returnValue($oS));

        try {
            $oP->render();
        } catch (Exception $e) {
            $this->assertEquals("REDIRECT", $e->getMessage());
        }
    }
    public function testRenderReturnsToBasketIfReservationOnAndBasketEmpty()
    {
        oxTestModules::addFunction('oxUtils', 'redirect($url)', '{throw new Exception($url);}');
        modConfig::getInstance()->setConfigParam('blPsBasketReservationEnabled', true);
        modConfig::setParameter( 'sslredirect', 'forced' );

        $oR = $this->getMock('stdclass', array('renewExpiration'));
        $oR->expects($this->once())->method('renewExpiration')->will($this->returnValue(null));

        $oB = $this->getMock('oxbasket', array('getProductsCount'));
        $oB->expects($this->once())->method('getProductsCount')->will($this->returnValue(0));

        $oS = $this->getMock('oxsession', array('getBasketReservations', 'getBasket'));
        $oS->expects($this->once())->method('getBasketReservations')->will($this->returnValue($oR));
        $oS->expects($this->any())->method('getBasket')->will($this->returnValue($oB));

        $oO = $this->getMock('payment', array('getSession'));
        $oO->expects($this->any())->method('getSession')->will($this->returnValue($oS));

        try {
            $oO->render();
        } catch (Exception $e) {
            $this->assertEquals(oxConfig::getInstance()->getShopHomeURL().'cl=basket', $e->getMessage());
            return;
        }
        $this->fail("no Exception thrown in redirect");
    }

    public function testRenderNoUserWithBasket()
    {
        $sRedirUrl = oxConfig::getInstance()->getShopHomeURL().'cl=basket';
        $this->setExpectedException('Exception', $sRedirUrl);

        oxTestModules::addFunction('oxUtils', 'redirect($url)', '{throw new Exception($url);}');
        modConfig::getInstance()->setConfigParam('blPsBasketReservationEnabled', false);
        // skip redirect to SSL
        modConfig::setParameter( 'sslredirect', 'forced' );

        $oB = $this->getMock('oxbasket', array('getProductsCount'));
        $oB->expects($this->once())->method('getProductsCount')->will($this->returnValue(1));

        $oS = $this->getMock('oxsession', array('getBasketReservations', 'getBasket'));
        $oS->expects($this->any())->method('getBasket')->will($this->returnValue($oB));

        $oO = $this->getMock('payment', array('getSession', 'getUser'));
        $oO->expects($this->any())->method('getSession')->will($this->returnValue($oS));
        $oO->expects($this->any())->method('getUser')->will($this->returnValue(null));
        $oO->render();
    }

    public function testRenderNoUserEmptyBasket()
    {
        $sRedirUrl = oxConfig::getInstance()->getShopHomeURL().'cl=start';
        $this->setExpectedException('Exception', $sRedirUrl);

        oxTestModules::addFunction('oxUtils', 'redirect($url)', '{throw new Exception($url);}');
        modConfig::getInstance()->setConfigParam('blPsBasketReservationEnabled', false);
        // skip redirect to SSL
        modConfig::setParameter( 'sslredirect', 'forced' );

        $oB = $this->getMock('oxbasket', array('getProductsCount'));
        $oB->expects($this->once())->method('getProductsCount')->will($this->returnValue(0));

        $oS = $this->getMock('oxsession', array('getBasketReservations', 'getBasket'));
        $oS->expects($this->any())->method('getBasket')->will($this->returnValue($oB));

        $oO = $this->getMock('payment', array('getSession', 'getUser'));
        $oO->expects($this->any())->method('getSession')->will($this->returnValue($oS));
        $oO->expects($this->any())->method('getUser')->will($this->returnValue(null));
        $oO->render();
    }

    public function testGetTsProtections()
    {
        modConfig::getInstance()->setConfigParam( 'blEnterNetPrice', false );
        modConfig::getInstance()->setConfigParam( 'blCalcVATForPayCharge', true );
        $oP = $this->getMock('oxprice', array('getBruttoPrice'));
        $oP->expects($this->once())->method('getBruttoPrice')->will($this->returnValue(50));
        $oB = $this->getMock('oxbasket', array('getPrice'));
        $oB->expects($this->once())->method('getPrice')->will($this->returnValue($oP));
        $oS = $this->getMock('oxsession', array('getBasket'));
        $oS->expects($this->any())->method('getBasket')->will($this->returnValue($oB));
        $oPayment = $this->getMock('payment', array('getSession'));
        $oPayment->expects($this->any())->method('getSession')->will($this->returnValue($oS));

        $oProducts = $oPayment->getTsProtections();
        $oProduct = current($oProducts);

        $this->assertEquals( "0,98", $oProduct->getFPrice() );
        $this->assertEquals( 'TS080501_500_30_EUR', $oProduct->getTsId() );
        $this->assertEquals( 500, $oProduct->getAmount() );
    }

    public function testGetCheckedTsProductId()
    {
        modConfig::setParameter('stsprotection', 'testId');
        $oPayment = $this->getProxyClass( "payment" );

        $this->assertEquals( 'testId', $oPayment->getCheckedTsProductId() );
    }

    /**
     * Testing Payment::getBreadCrumb()
     *
     * @return null
     */
    public function testGetBreadCrumb()
    {
        $oPayment = new Payment();

        $this->assertEquals(1, count($oPayment->getBreadCrumb()));
    }

}
