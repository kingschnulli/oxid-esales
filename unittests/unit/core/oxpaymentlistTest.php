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
 * @version   SVN: $Id: oxpaymentlistTest.php 32008 2010-12-17 15:10:36Z sarunas $
 */

require_once realpath( "." ).'/unit/OxidTestCase.php';
require_once realpath( "." ).'/unit/test_config.inc.php';

class Unit_Core_oxpaymentlistTest extends OxidTestCase
{
    protected $_aPayList = array();
    protected $_oDefPaymentList = null;

    /**
     * Initialize the fixture.
     *
     * @return null
     */
    protected function setup()
    {
        parent::setUp();

        if ( $this->getName() == "testGetPaymentListWithSomeWrongData" ) {
            return;
        }

        $this->oUser = new oxuser();
        $this->oUser->load( 'oxdefaultadmin' );

        // disabling default payments
        $this->_oDefPaymentList = new oxpaymentlist();
        $this->_oDefPaymentList->selectString( 'select * from oxpayments where oxactive = 1' );
        foreach ( $this->_oDefPaymentList as $oPayment ) {
            $oPayment->oxpayments__oxactive = new oxField(0, oxField::T_RAW);
            $oPayment->save();
        }

        // creating few payments
        $this->_aPayList[0] = new oxpayment();
        $this->_aPayList[0]->oxpayments__oxdesc = new oxField('Payment for user', oxField::T_RAW);
        $this->_aPayList[0]->oxpayments__oxaddsum = new oxField(1, oxField::T_RAW);
        $this->_aPayList[0]->oxpayments__oxaddsumtype = new oxField('abs', oxField::T_RAW);
        $this->_aPayList[0]->oxpayments__oxfromamount = new oxField(0, oxField::T_RAW);
        $this->_aPayList[0]->oxpayments__oxtoamount = new oxField(999, oxField::T_RAW);
        $this->_aPayList[0]->oxpayments__oxsort = new oxField(10, oxField::T_RAW);
        $this->_aPayList[0]->save();

        $this->_aPayList[1] = new oxpayment();
        $this->_aPayList[1]->oxpayments__oxdesc = new oxField('Payment for group', oxField::T_RAW);
        $this->_aPayList[1]->oxpayments__oxaddsum = new oxField(2, oxField::T_RAW);
        $this->_aPayList[1]->oxpayments__oxaddsumtype = new oxField('abs', oxField::T_RAW);
        $this->_aPayList[1]->oxpayments__oxfromamount = new oxField(0, oxField::T_RAW);
        $this->_aPayList[1]->oxpayments__oxtoamount = new oxField(999, oxField::T_RAW);
        $this->_aPayList[1]->oxpayments__oxsort = new oxField(20, oxField::T_RAW);
        $this->_aPayList[1]->save();

        $this->_aPayList[2] = new oxpayment();
        $this->_aPayList[2]->oxpayments__oxdesc = new oxField('Payment for country', oxField::T_RAW);
        $this->_aPayList[2]->oxpayments__oxaddsum = new oxField(3, oxField::T_RAW);
        $this->_aPayList[2]->oxpayments__oxaddsumtype = new oxField('abs', oxField::T_RAW);
        $this->_aPayList[2]->oxpayments__oxfromamount = new oxField(0, oxField::T_RAW);
        $this->_aPayList[2]->oxpayments__oxtoamount = new oxField(999, oxField::T_RAW);
        $this->_aPayList[2]->oxpayments__oxsort = new oxField(30, oxField::T_RAW);
        $this->_aPayList[2]->save();

        $this->_aPayList[3] = new oxpayment();
        $this->_aPayList[3]->oxpayments__oxdesc = new oxField('Plain Payment', oxField::T_RAW);
        $this->_aPayList[3]->oxpayments__oxaddsum = new oxField(3, oxField::T_RAW);
        $this->_aPayList[3]->oxpayments__oxaddsumtype = new oxField('abs', oxField::T_RAW);
        $this->_aPayList[3]->oxpayments__oxfromamount = new oxField(0, oxField::T_RAW);
        $this->_aPayList[3]->oxpayments__oxtoamount = new oxField(999, oxField::T_RAW);
        $this->_aPayList[3]->oxpayments__oxsort = new oxField(40, oxField::T_RAW);
        $this->_aPayList[3]->save();

        // assigning payments
        // for groups
        $oO2Group = oxNew( "oxobject2group" );
        $oO2Group->setId('_'.oxUtilsObject::getInstance()->generateUId());
        $oO2Group->oxobject2group__oxobjectid = new oxField($this->_aPayList[0]->getId(), oxField::T_RAW);
        $oO2Group->oxobject2group__oxgroupsid = new oxField('oxidadmin', oxField::T_RAW);
        $oO2Group->save();

        $oO2Group = oxNew( "oxobject2group" );
        $oO2Group->setId('_'.oxUtilsObject::getInstance()->generateUId());
        $oO2Group->oxobject2group__oxobjectid = new oxField($this->_aPayList[1]->getId(), oxField::T_RAW);
        $oO2Group->oxobject2group__oxgroupsid = new oxField('oxidadmin', oxField::T_RAW);
        $oO2Group->save();

        // for country
        $oO2Pay = oxNew( 'oxbase' );
        $oO2Pay->Init( 'oxobject2payment' );
        $oO2Group->setId('_'.oxUtilsObject::getInstance()->generateUId());
        $oO2Pay->oxobject2payment__oxpaymentid = new oxField($this->_aPayList[2]->getId(), oxField::T_RAW);
        $oO2Pay->oxobject2payment__oxobjectid = new oxField($this->oUser->oxuser__oxcountryid->value, oxField::T_RAW);
        $oO2Pay->oxobject2payment__oxtype = new oxField('oxcountry', oxField::T_RAW);
        $oO2Pay->save();

        $oO2Group = oxNew( "oxobject2group" );
        $oO2Group->setId('_'.oxUtilsObject::getInstance()->generateUId());
        $oO2Group->oxobject2group__oxobjectid = new oxField($this->_aPayList[2]->getId(), oxField::T_RAW);
        $oO2Group->oxobject2group__oxgroupsid = new oxField('oxidadmin', oxField::T_RAW);
        $oO2Group->save();

        // delivery set
        $this->oDelSet = new oxdeliveryset();
        $this->oDelSet->setId('_'.oxUtilsObject::getInstance()->generateUId());
        $this->oDelSet->oxdeliveryset__oxshopid = new oxField(oxConfig::getInstance()->getShopId(), oxField::T_RAW);
        $this->oDelSet->oxdeliveryset__oxshopincl = new oxField(oxConfig::getInstance()->getShopId(), oxField::T_RAW);
        $this->oDelSet->oxdeliveryset__oxactive = new oxField(1, oxField::T_RAW);
        $this->oDelSet->oxdeliveryset__oxtitle = new oxField("Test delivery set", oxField::T_RAW);
        $this->oDelSet->save();

        $oO2Group = oxNew( "oxobject2group" );
        $oO2Group->setId('_'.oxUtilsObject::getInstance()->generateUId());
        $oO2Group->oxobject2group__oxobjectid = new oxField($this->_aPayList[3]->getId(), oxField::T_RAW);
        $oO2Group->oxobject2group__oxgroupsid = new oxField('oxidadmin', oxField::T_RAW);
        $oO2Group->save();

        // assigning payments
        // user
        $oObject = oxNew( 'oxbase' );
        $oObject->init( 'oxobject2payment' );
        $oObject->setId('_'.oxUtilsObject::getInstance()->generateUId());
        $oObject->oxobject2payment__oxpaymentid = new oxField($this->_aPayList[0]->getId(), oxField::T_RAW);
        $oObject->oxobject2payment__oxobjectid = new oxField($this->oDelSet->getId(), oxField::T_RAW);
        $oObject->oxobject2payment__oxtype = new oxField("oxdelset", oxField::T_RAW);
        $oObject->save();

        // group
        $oObject = oxNew( 'oxbase' );
        $oObject->init( 'oxobject2payment' );
        $oO2Group->setId('_'.oxUtilsObject::getInstance()->generateUId());
        $oObject->oxobject2payment__oxpaymentid = new oxField($this->_aPayList[1]->getId(), oxField::T_RAW);
        $oObject->oxobject2payment__oxobjectid = new oxField($this->oDelSet->getId(), oxField::T_RAW);
        $oObject->oxobject2payment__oxtype = new oxField("oxdelset", oxField::T_RAW);
        $oObject->save();

        // country
        $oObject = oxNew( 'oxbase' );
        $oObject->init( 'oxobject2payment' );
        $oO2Group->setId('_'.oxUtilsObject::getInstance()->generateUId());
        $oObject->oxobject2payment__oxpaymentid = new oxField($this->_aPayList[2]->getId(), oxField::T_RAW);
        $oObject->oxobject2payment__oxobjectid = new oxField($this->oDelSet->getId(), oxField::T_RAW);
        $oObject->oxobject2payment__oxtype = new oxField("oxdelset", oxField::T_RAW);
        $oObject->save();

        // default
        $oObject = oxNew( 'oxbase' );
        $oObject->init( 'oxobject2payment' );
        $oO2Group->setId('_'.oxUtilsObject::getInstance()->generateUId());
        $oObject->oxobject2payment__oxpaymentid = new oxField($this->_aPayList[3]->getId(), oxField::T_RAW);
        $oObject->oxobject2payment__oxobjectid = new oxField($this->oDelSet->getId(), oxField::T_RAW);
        $oObject->oxobject2payment__oxtype = new oxField("oxdelset", oxField::T_RAW);
        $oObject->save();
    }

    /**
     * Tear down the fixture.
     *
     * @return null
     */
    protected function tearDown()
    {
        if ( $this->getName() != "testGetPaymentListWithSomeWrongData" ) {
            // enabling default payments
            foreach ( $this->_oDefPaymentList as $oPayment ) {
                $oPayment->oxpayments__oxactive = new oxField(1, oxField::T_RAW);
                $oPayment->save();
            }

            // deleting demo payments
            foreach ( $this->_aPayList as $oPayment ) {
                $oPayment->delete();
            }
        }
        $this->cleanUpTable( 'oxobject2group', 'oxgroupsid' );
        $this->cleanUpTable( 'oxobject2payment' );
        $this->cleanUpTable( 'oxobject2group' );
        $this->cleanUpTable( 'oxdeliveryset' );
        $this->cleanUpTable( 'oxdel2delset' );
        $this->cleanUpTable( 'oxobject2delivery' );

        parent::tearDown();
    }

    /**
     * Testing if payment list will be build even some data is wrong
     */
    public function testGetPaymentListWithSomeWrongData()
    {
        $sShipSetId = "oxidstandard";

        $oUser = new oxUser();
        $oUser->load( "oxdefaultadmin" );

        $oPaymentList = new oxPaymentList();
        $oPaymentList->getPaymentList( $sShipSetId, 10, $oUser );
        $iListCOunt = $oPaymentList->count();

        // list must contain at least one item
        $this->assertTrue( $iListCOunt > 0 );

        $oPayment = $oPaymentList->current();

        // adding garbage
        $oGarbage = new oxbase();
        $oGarbage->init( "oxobject2payment" );
        $oGarbage->setId( "_testoxobject2payment1" );
        $oGarbage->oxobject2payment__oxpaymentid = new oxField( $oPayment->getId() );
        $oGarbage->oxobject2payment__oxobjectid  = new oxField( "yyy" );
        $oGarbage->oxobject2payment__oxtype      = new oxField( "oxcountry" );
        $oGarbage->save();

        $oGarbage = new oxbase();
        $oGarbage->init( "oxobject2group" );
        $oGarbage->setId( "_testoxobject2group" );
        $oGarbage->oxobject2payment__oxobjectid = new oxField( $oPayment->getId() );
        $oGarbage->oxobject2payment__oxgroupsid = new oxField( "yyy" );
        $oGarbage->oxobject2payment__oxshopid   = new oxField( oxConfig::getInstance()->getShopId() );
        $oGarbage->save();

        $oPaymentList = new oxPaymentList();
        $oPaymentList->getPaymentList( $sShipSetId, 10, $oUser );
        $iNewListCount = $oPaymentList->count( );

        // list must contain at least one item
        $this->assertTrue( $iNewListCount > 0 );
        $this->assertTrue( $iNewListCount === $iListCOunt );

        $blFound = false;
        foreach ( $oPaymentList as $oPay ) {
            if ( $oPayment->getId() == $oPay->getId() ) {
                $blFound = true;
                break;
            }
        }
        $this->assertTrue( $blFound, "Error, delivery set not found" );
    }


    // just SQL cleaner ..
    protected function cleanSQL( $sQ )
    {
        return preg_replace( array( '/[^\w\'\:\-\.\*\<\=]/' ), '', $sQ );
    }

    /**
     * Use case:
     *
     * PAYMENTS:
     * + payment Nachnahme:
     *     - price: 8.5 abs
     *     - purchase price: 0 - 1000000
     *     - sorting: 0
     *     - assigned user groups: all
     *     - assigned countries: all
     *     - OXID = oxidcashondel
     * + payment Nachnahme (COD):
     *     - price: 25 abs
     *     - purchase price: 0 - 1000000
     *     - sorting: 0
     *     - assigned user groups: all
     *     - assigned countries: all excl. Germany
     *     - OXID = dbf741c04bf63f17f5e998d41236d55e
     * + all other payments OFF
     *
     * DELIVERIES:
     * + all standard deliveries + customizations:
     *     - Versandkosten f�r Standard: Versandkostenfrei ab 80, - Germany only
     *     - Versandkosten f�r Standard: 3,90 Euro innerhalb Deutschland - Germany only
     *     - Versandkosten f�r Standard: 6,90 Rest EU - excluding Germany
     *     - Versandkosten f�r Beispiel Set1: UPS 48 Std.: 9,90. - all countries
     *     - Versandkosten f�r Beispiel Set2: UPS 24 Std. Express: 12,90. - all countries
     *
     * DELIVERY SETS:
     * + only custom;
     * + UPS Standard (CH):
     *     - sorting: 0;
     *     - countries: Schweiz only;
     *     - deliveries: Versandkosten f�r Beispiel Set1: UPS 48 Std.: 9,90.-;
     *     - payments: Nachnahme (COD), Rechnung, Vorauskasse 2% Skonto;
     *     - user groups/users assigned: none;
     *     - OXID = 1b842e732a23255b1.91207750
     * + deutschland_test:
     *     - sorting: 0
     *     - countries: Germany only;
     *     - deliveries: Versandkosten f�r Beispiel Set2: UPS 24 Std. Express: 12,90.-;
     *     - payments: all available;
     *     - user groups/users assigned: none;
     *     - OXID = 1b842e732a23255b1.91207751
     * + UPS Standard (Inland):
     *     - sorting: 1;
     *     - countries: Germany only;
     *     - deliveries: Versandkosten f�r Standard: 3,90 Euro innerhalb Deutschland, Versandkosten f�r Standard: Versandkostenfrei ab 80,-;
     *     - payments: Nachnahme, Rechnung, Vorauskasse 2% Skonto;
     *     - user groups/users assigned: none;
     *     - OXID = oxidstandard
     */
    public function testGetPaymentListforUseCase()
    {
        $oDb = oxDb::getDb();
        $iShopId = oxConfig::getInstance()->getShopId();

        $sGermanyId = "a7c40f631fc920687.20179984";
        $sSchweizId = "a7c40f6321c6f6109.43859248";

        // disabling payments
        $oDb->execute( 'update oxpayments set oxactive = 0' );

        // enabling and setupping Nachnahme payment
        $oPayment = new oxPayment();
        $oPayment->load( 'oxidcashondel' );
        $oPayment->oxpayments__oxactive = new oxField( 1 );
        $oPayment->oxpayments__oxaddsum = new oxField( 8.5 );
        $oPayment->oxpayments__oxaddsumtype = new oxField( "abs" );
        $oPayment->oxpayments__oxfromamount = new oxField( 0 );
        $oPayment->oxpayments__oxtoamount   = new oxField( 1000000 );
        $oPayment->oxpayments__oxsort       = new oxField( 0 );
        $oPayment->save();

        // assigning groups
        $oObjectToGroup = new oxbase();
        $oObjectToGroup->init( 'oxobject2group' );
        $oObjectToGroup->setId('_'.oxUtilsObject::getInstance()->generateUId());
        $oObjectToGroup->oxobject2group__oxshopid   = new oxField( $iShopId );
        $oObjectToGroup->oxobject2group__oxobjectid = new oxField( $oPayment->getId() );
        $oObjectToGroup->oxobject2group__oxgroupsid   = new oxField( 'oxidadmin' );
        $oObjectToGroup->save();

        // assigning coutries (Deutschland)
        $oObjectToPayment = new oxbase();
        $oObjectToPayment->init( 'oxobject2payment' );
        $oObjectToPayment->setId('_'.oxUtilsObject::getInstance()->generateUId());
        $oObjectToPayment->oxobject2payment__oxpaymentid = new oxField( $oPayment->getId() );
        $oObjectToPayment->oxobject2payment__oxobjectid  = new oxField( $sGermanyId );
        $oObjectToPayment->oxobject2payment__oxtype      = new oxField( 'oxcountry' );
        $oObjectToPayment->save();

        // enabling and setupping Nachnahme (COD) payment
        $oPayment = new oxPayment();
        $oPayment->setId( '_bf741c04bf63f17f5e998d41236d55e' );
        $oPayment->oxpayments__oxdesc   = new oxField( "Nachnahme (COD)" );
        $oPayment->oxpayments__oxactive = new oxField( 1 );
        $oPayment->oxpayments__oxaddsum = new oxField( 25 );
        $oPayment->oxpayments__oxaddsumtype = new oxField( "abs" );
        $oPayment->oxpayments__oxfromamount = new oxField( 0 );
        $oPayment->oxpayments__oxtoamount   = new oxField( 1000000 );
        $oPayment->oxpayments__oxsort       = new oxField( 0 );
        $oPayment->save();

        // assigning groups
        $oObjectToGroup = new oxbase();
        $oObjectToGroup->init( 'oxobject2group' );
        $oObjectToGroup->setId('_'.oxUtilsObject::getInstance()->generateUId());
        $oObjectToGroup->oxobject2group__oxshopid   = new oxField( $iShopId );
        $oObjectToGroup->oxobject2group__oxobjectid = new oxField( $oPayment->getId() );
        $oObjectToGroup->oxobject2group__oxgroupsid = new oxField( 'oxidadmin' );
        $oObjectToGroup->save();

        // assigning coutries (Schweiz)
        $oObjectToPayment = new oxbase();
        $oObjectToPayment->init( 'oxobject2payment' );
        $oObjectToPayment->setId('_'.oxUtilsObject::getInstance()->generateUId());
        $oObjectToPayment->oxobject2payment__oxpaymentid = new oxField( $oPayment->getId() );
        $oObjectToPayment->oxobject2payment__oxobjectid  = new oxField( $sSchweizId );
        $oObjectToPayment->oxobject2payment__oxtype      = new oxField( 'oxcountry' );
        $oObjectToPayment->save();

        // DELIVERIES:

        // Versandkosten f�r Standard: Versandkostenfrei ab 80, - Germany only
        $oDb->execute( "delete from oxobject2delivery where oxdeliveryid='1b842e734b62a4775.45738618'" );

        $oObjectToDelivery = new oxbase;
        $oObjectToDelivery->init( 'oxobject2delivery' );
        $oObjectToDelivery->setId('_'.oxUtilsObject::getInstance()->generateUId());
        $oObjectToDelivery->oxobject2delivery__oxdeliveryid = new oxField( "1b842e734b62a4775.45738618" );
        $oObjectToDelivery->oxobject2delivery__oxobjectid   = new oxField( $sGermanyId );
        $oObjectToDelivery->oxobject2delivery__oxtype       = new oxField( "oxcountry" );
        $oObjectToDelivery->save();

        // Versandkosten f�r Standard: 3,90 Euro innerhalb Deutschland - Germany only
        $oDb->execute( "delete from oxobject2delivery where oxdeliveryid='1b842e73470578914.54719298'" );

        $oObjectToDelivery = new oxbase;
        $oObjectToDelivery->init( 'oxobject2delivery' );
        $oObjectToDelivery->setId('_'.oxUtilsObject::getInstance()->generateUId());
        $oObjectToDelivery->oxobject2delivery__oxdeliveryid = new oxField( "1b842e73470578914.54719298" );
        $oObjectToDelivery->oxobject2delivery__oxobjectid   = new oxField( $sGermanyId );
        $oObjectToDelivery->oxobject2delivery__oxtype       = new oxField( "oxcountry" );
        $oObjectToDelivery->save();

        // Versandkosten f�r Standard: 6,90 Rest EU - excluding Germany
        $oDb->execute( "delete from oxobject2delivery where oxdeliveryid='1b842e7352422a708.01472527'" );

        $oObjectToDelivery = new oxbase;
        $oObjectToDelivery->init( 'oxobject2delivery' );
        $oObjectToDelivery->setId('_'.oxUtilsObject::getInstance()->generateUId());
        $oObjectToDelivery->oxobject2delivery__oxdeliveryid = new oxField( "1b842e7352422a708.01472527" );
        $oObjectToDelivery->oxobject2delivery__oxobjectid   = new oxField( $sSchweizId );
        $oObjectToDelivery->oxobject2delivery__oxtype       = new oxField( "oxcountry" );
        $oObjectToDelivery->save();

        // Versandkosten f�r Beispiel Set1: UPS 48 Std.: 9,90. - all countries
        $oDb->execute( "delete from oxobject2delivery where oxdeliveryid='1b842e738970d31e3.71258327'" );

        $oObjectToDelivery = new oxbase;
        $oObjectToDelivery->init( 'oxobject2delivery' );
        $oObjectToDelivery->setId('_'.oxUtilsObject::getInstance()->generateUId());
        $oObjectToDelivery->oxobject2delivery__oxdeliveryid = new oxField( "1b842e738970d31e3.71258327" );
        $oObjectToDelivery->oxobject2delivery__oxobjectid   = new oxField( $sGermanyId );
        $oObjectToDelivery->oxobject2delivery__oxtype       = new oxField( "oxcountry" );
        $oObjectToDelivery->save();

        $oObjectToDelivery = new oxbase;
        $oObjectToDelivery->init( 'oxobject2delivery' );
        $oObjectToDelivery->setId('_'.oxUtilsObject::getInstance()->generateUId());
        $oObjectToDelivery->oxobject2delivery__oxdeliveryid = new oxField( "1b842e738970d31e3.71258327" );
        $oObjectToDelivery->oxobject2delivery__oxobjectid   = new oxField( $sSchweizId );
        $oObjectToDelivery->oxobject2delivery__oxtype       = new oxField( "oxcountry" );
        $oObjectToDelivery->save();

        // Versandkosten f�r Beispiel Set2: UPS 24 Std. Express: 12,90. - all countries
        $oDb->execute( "delete from oxobject2delivery where oxdeliveryid='1b842e738970d31e3.71258328'" );

        $oObjectToDelivery = new oxbase;
        $oObjectToDelivery->init( 'oxobject2delivery' );
        $oObjectToDelivery->setId('_'.oxUtilsObject::getInstance()->generateUId());
        $oObjectToDelivery->oxobject2delivery__oxdeliveryid = new oxField( "1b842e738970d31e3.71258328" );
        $oObjectToDelivery->oxobject2delivery__oxobjectid   = new oxField( $sGermanyId );
        $oObjectToDelivery->oxobject2delivery__oxtype       = new oxField( "oxcountry" );
        $oObjectToDelivery->save();

        $oObjectToDelivery = new oxbase;
        $oObjectToDelivery->init( 'oxobject2delivery' );
        $oObjectToDelivery->setId('_'.oxUtilsObject::getInstance()->generateUId());
        $oObjectToDelivery->oxobject2delivery__oxdeliveryid = new oxField( "1b842e738970d31e3.71258328" );
        $oObjectToDelivery->oxobject2delivery__oxobjectid   = new oxField( $sSchweizId );
        $oObjectToDelivery->oxobject2delivery__oxtype       = new oxField( "oxcountry" );
        $oObjectToDelivery->save();

        // disabling default delivery sets
        $oDb->execute( 'update oxdeliveryset set oxactive = 0' );

        //
        $oDelSet = new oxDeliverySet;
        $oDelSet->setId('_'.md5(time()));
        $oDelSet->oxdeliveryset__oxshopid = new oxField( $iShopId );
        $oDelSet->oxdeliveryset__oxshopincl = new oxField( $iShopId );
        $oDelSet->oxdeliveryset__oxactive = new oxField( 1 );
        $oDelSet->oxdeliveryset__oxtitle  = new oxField( "UPS Standard (CH)" );
        $oDelSet->oxdeliveryset__oxpos    = new oxField( 0 );
        $oDelSet->setId( "1b842e732a23255b1.91207750" );
        $oDelSet->save();

        // - countries: Schweiz only;
        $oObject2Delivery = new oxbase();
        $oObject2Delivery->init( 'oxobject2delivery' );
        $oObject2Delivery->setId('_'.oxUtilsObject::getInstance()->generateUId());
        $oObject2Delivery->oxobject2delivery__oxdeliveryid = new oxField( $oDelSet->getId() );
        $oObject2Delivery->oxobject2delivery__oxobjectid   = new oxField( $sSchweizId );
        $oObject2Delivery->oxobject2delivery__oxtype       = new oxField( "oxdelset" );
        $oObject2Delivery->save();

        // - payments: Nachnahme (COD)
        $oObject = new oxbase();
        $oObject->init( 'oxobject2payment' );
        $oObject->setId('_'.oxUtilsObject::getInstance()->generateUId());
        $oObject->oxobject2payment__oxpaymentid = new oxField( "_bf741c04bf63f17f5e998d41236d55e" );
        $oObject->oxobject2payment__oxobjectid  = new oxField( $oDelSet->getId() );
        $oObject->oxobject2payment__oxtype      = new oxField( "oxdelset" );
        $oObject->save();

        // - deliveries: Versandkosten f�r Beispiel Set2: UPS 24 Std. Express: 12,90.-;
        $oDel2delset = new oxbase();
        $oDel2delset->init( 'oxdel2delset' );
        $oDel2delset->setId('_'.oxUtilsObject::getInstance()->generateUId());
        $oDel2delset->oxdel2delset__oxdelid    = new oxField( "1b842e738970d31e3.71258327" );
        $oDel2delset->oxdel2delset__oxdelsetid = new oxField( $oDelSet->getId() );
        $oDel2delset->save();


        //
        $oDelSet = new oxDeliverySet;
        $oDelSet->setId('_'.oxUtilsObject::getInstance()->generateUId());
        $oDelSet->oxdeliveryset__oxshopid = new oxField( $iShopId );
        $oDelSet->oxdeliveryset__oxshopincl = new oxField( $iShopId );
        $oDelSet->oxdeliveryset__oxactive = new oxField( 1 );
        $oDelSet->oxdeliveryset__oxtitle  = new oxField( "deutschland_test" );
        $oDelSet->oxdeliveryset__oxpos    = new oxField( 0 );
        $oDelSet->setId( "1b842e732a23255b1.91207751" );
        $oDelSet->save();

        // - countries: Germany only;
        $oObject2Delivery = new oxbase();
        $oObject2Delivery->init( 'oxobject2delivery' );
        $oObject2Delivery->setId('_'.oxUtilsObject::getInstance()->generateUId());
        $oObject2Delivery->oxobject2delivery__oxdeliveryid = new oxField( $oDelSet->getId() );
        $oObject2Delivery->oxobject2delivery__oxobjectid   = new oxField( $sGermanyId );
        $oObject2Delivery->oxobject2delivery__oxtype       = new oxField( "oxdelset" );
        $oObject2Delivery->save();

        // - payments: all available;
        $oObject = new oxbase();
        $oObject->init( 'oxobject2payment' );
        $oObject->setId('_'.oxUtilsObject::getInstance()->generateUId());
        $oObject->oxobject2payment__oxpaymentid = new oxField( 'dbf741c04bf63f17f5e998d41236d55e' );
        $oObject->oxobject2payment__oxobjectid  = new oxField( $oDelSet->getId() );
        $oObject->oxobject2payment__oxtype      = new oxField( "oxdelset" );
        $oObject->save();

        $oObject = new oxbase();
        $oObject->init( 'oxobject2payment' );
        $oObject->setId('_'.oxUtilsObject::getInstance()->generateUId());
        $oObject->oxobject2payment__oxpaymentid = new oxField( 'oxidcashondel' );
        $oObject->oxobject2payment__oxobjectid  = new oxField( $oDelSet->getId() );
        $oObject->oxobject2payment__oxtype      = new oxField( "oxdelset" );
        $oObject->save();

        // - deliveries: Versandkosten f�r Beispiel Set2: UPS 24 Std. Express: 12,90.-;
        $oDel2delset = new oxbase();
        $oDel2delset->init( 'oxdel2delset' );
        $oDel2delset->setId('_'.oxUtilsObject::getInstance()->generateUId());
        $oDel2delset->oxdel2delset__oxdelid    = new oxField( "1b842e738970d31e3.71258328" );
        $oDel2delset->oxdel2delset__oxdelsetid = new oxField( $oDelSet->getId() );
        $oDel2delset->save();


        //
        $oDelSet = new oxDeliverySet;
        $oDelSet->load( 'oxidstandard' );
        $oDelSet->oxdeliveryset__oxshopid = new oxField( $iShopId );
        $oDelSet->oxdeliveryset__oxshopincl = new oxField( $iShopId );
        $oDelSet->oxdeliveryset__oxactive = new oxField( 1 );
        $oDelSet->oxdeliveryset__oxtitle  = new oxField( "UPS Standard (Inland)" );
        $oDelSet->oxdeliveryset__oxpos    = new oxField( 1 );
        $oDelSet->save();

        // - countries: Germany only;
        $oObject2Delivery = new oxbase();
        $oObject2Delivery->init( 'oxobject2delivery' );
        $oObject2Delivery->setId('_'.oxUtilsObject::getInstance()->generateUId());
        $oObject2Delivery->oxobject2delivery__oxdeliveryid = new oxField( $oDelSet->getId() );
        $oObject2Delivery->oxobject2delivery__oxobjectid   = new oxField( $sGermanyId );
        $oObject2Delivery->oxobject2delivery__oxtype       = new oxField( "oxdelset" );
        $oObject2Delivery->save();

        // - payments: Nachnahme, Rechnung, Vorauskasse 2% Skonto;
        $oObject = new oxbase();
        $oObject->init( 'oxobject2payment' );
        $oObject->setId('_'.oxUtilsObject::getInstance()->generateUId());
        $oObject->oxobject2payment__oxpaymentid = new oxField( $oDelSet->getId() );
        $oObject->oxobject2payment__oxobjectid  = new oxField( 'oxidcashondel' );
        $oObject->oxobject2payment__oxtype      = new oxField( "oxdelset" );
        $oObject->save();

        // - deliveries: Versandkosten f�r Standard: Versandkostenfrei ab 80,-;
        $oDel2delset = new oxbase();
        $oDel2delset->init( 'oxdel2delset' );
        $oDel2delset->setId('_'.oxUtilsObject::getInstance()->generateUId());
        $oDel2delset->oxdel2delset__oxdelid    = new oxField( "1b842e73470578914.54719298" );
        $oDel2delset->oxdel2delset__oxdelsetid = new oxField( $oDelSet->getId() );
        $oDel2delset->save();

        $oDel2delset = new oxbase();
        $oDel2delset->init( 'oxdel2delset' );
        $oDel2delset->setId('_'.oxUtilsObject::getInstance()->generateUId());
        $oDel2delset->oxdel2delset__oxdelid    = new oxField( "1b842e734b62a4775.45738618" );
        $oDel2delset->oxdel2delset__oxdelsetid = new oxField( $oDelSet->getId() );
        $oDel2delset->save();

        // finally testing
        $oUser = new oxuser();
        $oUser->load( 'oxdefaultadmin' );

        $aPaymentList = oxPaymentList::getInstance()->getPaymentList( "1b842e732a23255b1.91207751", 2.5, $oUser );
        $this->assertEquals( 1, count( $aPaymentList ) );
        $oPayment = current( $aPaymentList );
        $this->assertEquals( "oxidcashondel", $oPayment->getId() );
    }

    /**
     * Testing SQL getter
     */
    // no user passed
    public function testGetFilterSelectNoUser()
    {
        $sTable = getViewName( 'oxpayments' );
        $sGroupTable   = getViewName( 'oxgroups' );
        $sCountryTable = getViewName( 'oxcountry' );
        $sPaymentsTable = getViewName( 'oxpayments' );

        $sTestQ  = "select $sTable.* from( select distinct $sTable.* from $sTable, oxobject2group, oxobject2payment ";
        $sTestQ .= "where $sTable.oxactive='1' and oxobject2group.oxobjectid = $sTable.oxid ";
        $sTestQ .= "and oxobject2payment.oxpaymentid = $sTable.oxid and oxobject2payment.oxobjectid = 'xxx' ";
        $sTestQ .= "and $sPaymentsTable.oxfromboni <= '0' and $sPaymentsTable.oxfromamount <= '666' and $sPaymentsTable.oxtoamount >= '666' ";
        $sTestQ .= " ) as $sTable where ( select if( exists( select 1 from oxobject2payment as ss1, $sCountryTable where $sCountryTable.oxid=ss1.oxobjectid and ss1.oxpaymentid=$sTable.OXID and ss1.oxtype='oxcountry' limit 1),
                    exists( select 1 from oxobject2payment as s1 where s1.oxpaymentid=$sTable.OXID and s1.oxtype='oxcountry' and s1.OXOBJECTID='a7c40f631fc920687.20179984' limit 1 ), 1) &&
                    if( exists( select 1 from oxobject2group as ss3, $sGroupTable where $sGroupTable.oxid=ss3.oxgroupsid and ss3.OXOBJECTID=$sTable.OXID limit 1), 0, 1) ) ) order by $sTable.oxsort asc ";

        $oList = new oxpaymentlist();
        $sQ = $oList->UNITgetFilterSelect( 'xxx', 666, null );

        $this->assertEquals( $this->cleanSQL( $sTestQ ), $this->cleanSQL( $sQ ) );
    }
    // passing admin user
    public function testGetFilterSelectAdminUser()
    {
        $this->oUser->addToGroup( '_testGroupId' );
        foreach ( $this->oUser->getUserGroups() as $oGroup ) {
            if ( $sGroupIds )
                $sGroupIds .= ', ';
            $sGroupIds .= "'".$oGroup->getId()."'";
        }

        $sTable = getViewName( 'oxpayments' );
        $sGroupTable   = getViewName( 'oxgroups' );
        $sCountryTable = getViewName( 'oxcountry' );

        $sTestQ  = "select $sTable.* from( select distinct $sTable.* from $sTable, oxobject2group, oxobject2payment ";
        $sTestQ .= "where $sTable.oxactive='1' and oxobject2group.oxobjectid = $sTable.oxid ";
        $sTestQ .= "and oxobject2payment.oxpaymentid = $sTable.oxid and oxobject2payment.oxobjectid = 'xxx' ";
        $sTestQ .= "and $sTable.oxfromboni <= '1000' and $sTable.oxfromamount <= '666' and $sTable.oxtoamount >= '666' ";
        $sTestQ .= ") as $sTable where ( select if( exists( select 1 from oxobject2payment as ss1, $sCountryTable where $sCountryTable.oxid=ss1.oxobjectid and ss1.oxpaymentid=$sTable.OXID and ss1.oxtype='oxcountry' limit 1),
                    exists( select 1 from oxobject2payment as s1 where s1.oxpaymentid=$sTable.OXID and s1.oxtype='oxcountry' and s1.OXOBJECTID='a7c40f631fc920687.20179984' limit 1), 1) &&
                    if( exists( select 1 from oxobject2group as ss3, $sGroupTable where $sGroupTable.oxid=ss3.oxgroupsid and ss3.OXOBJECTID=$sTable.OXID limit 1),
                    exists( select 1 from oxobject2group as s3 where s3.OXOBJECTID=$sTable.OXID and s3.OXGROUPSID in ( $sGroupIds ) limit 1), 1) ) ) order by $sTable.oxsort asc ";

        $oList = new oxpaymentlist();
        $sQ = $oList->UNITgetFilterSelect( 'xxx', 666, $this->oUser );

        $this->assertEquals( $this->cleanSQL( $sTestQ ), $this->cleanSQL( $sQ ) );
    }

    /**
     * Testing country id getter
     */
    // testing home country setter and getter
    public function testSetHomeCountryAndGetCountryId()
    {
        $oList = new oxpaymentlist();

        // testing default
        $this->assertEquals( 'a7c40f631fc920687.20179984', $oList->getCountryId( null ) );

        // now resetting country ids
        $oList->setHomeCountry( null );
        $this->assertNull( $oList->getCountryId( null ) );

        // now passing user and testing
        $oUser = $this->getMock( 'oxuser', array( 'getActiveCountry' ) );
        $oUser->expects( $this->once() )->method( 'getActiveCountry' )->will( $this->returnValue( 'xxx' ) );

        $this->assertEquals( 'xxx', $oList->getCountryId( $oUser ) );

        // setting array
        $oList->setHomeCountry( array('a', 'b') );
        $this->assertEquals( 'a', $oList->getCountryId( null ) );

        // setting string
        $oList->setHomeCountry( 'a' );
        $this->assertEquals( 'a', $oList->getCountryId( null ) );
    }

    /**
     * Testing payment list getter
     */
    // no valid delivery set - no payment in list
    public function testGetPaymentListNoValidDelSet()
    {
        $oList = new oxpaymentlist();
        $this->assertEquals( array(), $oList->getPaymentList( 'xxx', 55, $this->oUser ) );
    }
    // valid delivery set, but price is too high
    public function testGetPaymentListPriceIsTooHigh()
    {
        // making payments active
        foreach ( $this->_aPayList as $oPayment ) {
            $oPayment->oxpayments__oxactive = new oxField(1, oxField::T_RAW);
            $oPayment->save();
        }

        $oList = new oxpaymentlist();
        $this->assertEquals( array(), $oList->getPaymentList( $this->oDelSet->getId(), 666666, $this->oUser ) );
    }
    // all input is just fine + admin user
    public function testGetPaymentListAllIsFinePlusUserIsPassed()
    {
        // making payments active
        foreach ( $this->_aPayList as $oPayment ) {
            $oPayment->oxpayments__oxactive = new oxField(1, oxField::T_RAW);
            $oPayment->save();
        }

        $oList = new oxpaymentlist();
        $this->assertEquals( array( $this->_aPayList[0]->getId(), $this->_aPayList[1]->getId(), $this->_aPayList[2]->getId(), $this->_aPayList[3]->getId() ), array_keys( $oList->getPaymentList( $this->oDelSet->getId(), 55, $this->oUser ) ) );
    }
    // all input is just fine + no user, will be used default country id from config
    public function testGetPaymentListAllIsFinePlusNoUser()
    {
        // making payments active
        foreach ( $this->_aPayList as $oPayment ) {
            $oPayment->oxpayments__oxactive = new oxField(1, oxField::T_RAW);
            $oPayment->save();
        }

        $oList = new oxpaymentlist();
        $this->assertEquals( 0, count( $oList->getPaymentList( $this->oDelSet->getId(), 55 ) ) );
    }
    // buglist_332 sorting test
    public function testGetPaymentListAllIsFineInSpecSorting()
    {
        // making payments active
        $this->_aPayList[0]->oxpayments__oxactive = new oxField(1, oxField::T_RAW);
        $this->_aPayList[0]->oxpayments__oxsort   = new oxField(1, oxField::T_RAW);
        $this->_aPayList[0]->save();
        $this->_aPayList[1]->oxpayments__oxactive = new oxField(1, oxField::T_RAW);
        $this->_aPayList[1]->oxpayments__oxsort   = new oxField(4, oxField::T_RAW);
        $this->_aPayList[1]->save();
        $this->_aPayList[2]->oxpayments__oxactive = new oxField(1, oxField::T_RAW);
        $this->_aPayList[2]->oxpayments__oxsort   = new oxField(2, oxField::T_RAW);
        $this->_aPayList[2]->save();
        $this->_aPayList[3]->oxpayments__oxactive = new oxField(1, oxField::T_RAW);
        $this->_aPayList[3]->oxpayments__oxsort   = new oxField(3, oxField::T_RAW);
        $this->_aPayList[3]->save();

        $this->assertEquals( array( $this->_aPayList[0]->getId(), $this->_aPayList[2]->getId(), $this->_aPayList[3]->getId(), $this->_aPayList[1]->getId() ), array_keys( oxPaymentList::getInstance()->getPaymentList( $this->oDelSet->getId(), 55, $this->oUser ) ) );
    }
}
