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
 * @version   SVN: $Id: oxvatselectorTest.php 39525 2011-10-25 14:23:53Z arvydas.vapsva $
 */

require_once realpath( "." ).'/unit/OxidTestCase.php';
require_once realpath( "." ).'/unit/test_config.inc.php';

/**
 * oxvatselector test
 */
class Unit_Core_oxVatSelectorTest extends OxidTestCase
{
    /**
     * Initialize the fixture.
     *
     * @return null
     */
    protected function setUp()
    {
        parent::setUp();
        // demo article
            $sId = '2077';
        $sNewId = oxUtilsObject::getInstance()->generateUId();

        $this->oArticle = oxNew( 'oxarticle' );
        $this->oArticle->disableLazyLoading();
        $this->oArticle->Load( $sId );

        // making copy
        $this->oArticle->setId( $sNewId );
        $this->oArticle->oxarticles__oxweight = new oxField(10, oxField::T_RAW);
        $this->oArticle->oxarticles__oxstock = new oxField(100, oxField::T_RAW);
        $this->oArticle->oxarticles__oxprice = new oxField(19, oxField::T_RAW);
        $this->oArticle->oxarticles__oxstockflag = new oxField(2, oxField::T_RAW);
        $this->oArticle->save();

        // demo category
            $sId = '8a142c3e4143562a5.46426637';

        $sNewId = oxUtilsObject::getInstance()->generateUId();

        $this->oCategory = oxNew( 'oxbase' );
        $this->oCategory->Init( 'oxcategories' );
        $this->oCategory->Load( $sId );

        // making copy
        $this->oCategory->setId( $sNewId );
        $this->oCategory->save();

        // assigning article to category
        $oO2Group = oxNew( 'oxbase' );
        $oO2Group->Init( 'oxobject2category' );
        $oO2Group->oxobject2category__oxshopid = new oxField(oxConfig::getInstance()->getShopId(), oxField::T_RAW);
        $oO2Group->oxobject2category__oxshopincl = new oxField(oxConfig::getInstance()->getShopId(), oxField::T_RAW);
        $oO2Group->oxobject2category__oxobjectid = new oxField($this->oArticle->getId(), oxField::T_RAW);
        $oO2Group->oxobject2category__oxcatnid = new oxField($this->oCategory->getId(), oxField::T_RAW);
        $oO2Group->save();

        $this->dDefaultVAT = oxConfig::getInstance()->getConfigParam( 'dDefaultVAT' );
        oxConfig::getInstance()->setConfigParam( 'dDefaultVAT', '99' );
    }

    /**
     * Tear down the fixture.
     *
     * @return null
     */
    protected function tearDown()
    {
        // deleting demo items
        $this->oArticle->delete();
        $this->oCategory->delete();

        oxTestModules::addFunction('oxVatSelector', 'clear', '{ oxVatSelector::$_aUserVatCache = array();}');
        oxNew('oxVatSelector')->clear();
        oxRemClassModule('oxVatSelector');

        parent::tearDown();
    }


    public function testGetInstance()
    {
        oxTestModules::addFunction('oxVatSelector', 'setInst', '{oxVatSelector::$_instance = $aA[0];}');
        oxNew('oxVatSelector')->setInst(null);
        oxTestModules::addFunction('oxVatSelector', 'ping', '{return "pong";}');
        $this->assertEquals('pong', oxVatSelector::getInstance()->ping());
        oxTestModules::addFunction('oxVatSelector', 'ping', '{return "another pong cached";}');
        $this->assertEquals('pong', oxVatSelector::getInstance()->ping());
        oxNew('oxVatSelector')->setInst(null);
    }

    /**
     * testing user VAT getter
     */

    public function testGetUserVat()
    {
        $oVatSelector = $this->getMock( 'oxVatSelector', array( '_getForeignCountryUserVat' ) );
        $oVatSelector->expects($this->once())->method( '_getForeignCountryUserVat' )->will( $this->returnValue(66) );

        $oUser = new oxuser();
        $oUser->oxuser__oxcountryid = new oxField(null, oxField::T_RAW);
        $this->assertFalse($oVatSelector->getUserVat($oUser, true));
        // check cache
        $oUser->oxuser__oxcountryid = new oxField('wtf?', oxField::T_RAW);
        $this->assertFalse($oVatSelector->getUserVat($oUser));
        try {
            $this->assertFalse($oVatSelector->getUserVat($oUser, true));
            $this->fail("how could it load this country ?");
        } catch (oxObjectException $e) {
            // expected here
        }

        $aHome = oxConfig::getInstance()->getConfigParam( 'aHomeCountry' );
        $oUser->oxuser__oxcountryid = new oxField($aHome[0], oxField::T_RAW);
        $this->assertFalse($oVatSelector->getUserVat($oUser, true));

        $oDb = oxDb::getDb();
        // foreigner
        $oUser->oxuser__oxcountryid = new oxField($oDb->getOne('select oxid from oxcountry where oxid not in ("'.implode('","', $aHome).'")'), oxField::T_RAW);
        $this->assertEquals(66, $oVatSelector->getUserVat($oUser, true));
    }

    public function testGetForeignCountryUserVat()
    {

        $oCountry1 = $this->getMock( 'oxCountry', array( 'isInEU' ) );
        $oCountry1->expects($this->once())->method( 'isInEU' )->will( $this->returnValue(false) );

        $oUser = new oxuser();
        $oVatSelector = $this->getProxyClass("oxVatSelector");

        $this->assertSame(0, $oVatSelector->UNITgetForeignCountryUserVat($oUser, $oCountry1));

        $oCountry2 = $this->getMock( 'oxCountry', array('isInEU' ) );
        $oCountry2->expects($this->exactly(2))->method( 'isInEU' )->will( $this->returnValue(true) );
        $oUser->oxuser__oxustid = new oxField(0, oxField::T_RAW);
        $this->assertSame(false, $oVatSelector->UNITgetForeignCountryUserVat($oUser, $oCountry2));
        $oUser->oxuser__oxustid = new oxField("LTsff", oxField::T_RAW);
        $oCountry2->oxcountry__oxisoalpha2 = new oxField('LT', oxField::T_RAW);
        $this->assertSame(0, $oVatSelector->UNITgetForeignCountryUserVat($oUser, $oCountry2));
    }

    /**
     * testing article VAT getter
     */
    // article has custom VAT stored in oxarticle
    public function testFindArticleVatArticleHasCustomVat()
    {
        $oVatSelector1 = $this->getMock( 'oxVatSelector', array( '_getVatForArticleCategory' ) );
        $oVatSelector1->expects($this->once())->method( '_getVatForArticleCategory' )->will( $this->returnValue(69) );

        $oArticle1 = $this->getMock( 'oxarticle', array( 'getCustomVAT' ) );
        $oArticle1->expects( $this->once() )->method( 'getCustomVAT' )->will( $this->returnValue( '66' ) );

        $this->assertEquals( 66, $oVatSelector1->getArticleVat( $oArticle1 ) );

        $oArticle2 = $this->getMock( 'oxarticle', array( 'getCustomVAT' ) );
        $oArticle2->expects( $this->exactly(2) )->method( 'getCustomVAT' )->will( $this->returnValue( null ) );

        $this->assertEquals( 69, $oVatSelector1->getArticleVat( $oArticle2 ) );

        $oVatSelector1 = $this->getMock( 'oxVatSelector', array( '_getVatForArticleCategory' ) );
        $oVatSelector1->expects($this->once())->method( '_getVatForArticleCategory' )->will( $this->returnValue(false) );

        $this->assertEquals( 99, $oVatSelector1->getArticleVat( $oArticle2 ) );


    }

    public function testGetVatForArticleCategory()
    {
        //make sure getCategories are never called
        $oArticle1 = $this->getMock( 'oxarticle', array( 'getCategoryIds' ) );
        $oArticle1->expects($this->never())->method( 'getCategoryIds' );

        $oVatSelector = new oxVatSelector();
        $this->assertFalse( $oVatSelector->UNITgetVatForArticleCategory( $oArticle1 ) );

        $this->oCategory->oxcategories__oxvat = new oxField( 69, oxField::T_RAW );
        $this->oCategory->save();

        $oVatSelector = new oxVatSelector();
        $this->assertEquals( 69, $oVatSelector->UNITgetVatForArticleCategory( $this->oArticle ) );

        $this->oCategory->oxcategories__oxvat = new oxField( null, oxField::T_RAW );
        $this->oCategory->save();

        $oVatSelector = new oxVatSelector();
        $this->assertFalse( $oVatSelector->UNITgetVatForArticleCategory( $this->oArticle ) );
    }

    public function testGetVatForArticleCategoryArtWithoutCat()
    {
        $oArticle1 = $this->getMock( 'oxarticle', array( 'getId' ) );
        //make sure getCategories are never called
        $oArticle1->expects($this->once())->method( 'getId' )->will( $this->returnValue( '666' ) );
        $oVatSelector = $this->getProxyClass("oxVatSelector");

        $this->oCategory->oxcategories__oxvat = new oxField(69, oxField::T_RAW);
        $this->oCategory->save();

        $this->assertFalse($oVatSelector->UNITgetVatForArticleCategory($oArticle1));
    }

    /**
     * Testing basket item VAT getter, which does same things as getArticleVat
     * FYI: method "getBasketItemVat" is good if someone needs some special
     * behaviour while calculatin basket price :)
     */
    public function testGetBasketItemVat()
    {
        $oVatSelector = $this->getMock( 'oxVatSelector', array( 'getArticleVat' ) );
        $oVatSelector->expects( $this->once() )->method( 'getArticleVat' )->will( $this->returnValue( 66 ) );

        $this->assertEquals( 66, $oVatSelector->getBasketItemVat( $this->oArticle, null ) );
    }

    /**
     * Testing article user VAT getter
     */
    public function testGetArticleUserVat()
    {
        $oVatSelector = $this->getMock( 'oxVatSelector', array( 'getUserVat' ) );
        $oVatSelector->expects( $this->once() )->method( 'getUserVat' )->will( $this->returnValue( 66 ) );
        $oArticle = $this->getMock( 'oxArticle', array( 'getArticleUser' ) );
        $oArticle->expects( $this->once() )->method( 'getArticleUser' )->will( $this->returnValue( new oxuser() ) );

        $this->assertEquals( 66, $oVatSelector->getArticleUserVat( $oArticle ) );
    }

    /**
     * Testing article user VAT getter
     */
    public function testGetArticleUserVatNoUser()
    {
        $oVatSelector = $this->getProxyClass("oxVatSelector");
        $oArticle = $this->getMock( 'oxArticle', array( 'getArticleUser' ) );
        $oArticle->expects( $this->once() )->method( 'getArticleUser' )->will( $this->returnValue( false ) );

        $this->assertFalse( $oVatSelector->getArticleUserVat( $oArticle ) );
    }

    /**
     * Tests oxVatSelector::_getVatCountry() method functionality.
     * Tests the case when for VAT consideration SHIPPING country is taken
     *
     */
    public function testGetVatCountryAsShippingCountry()
    {
        $sGermanyId = 'a7c40f631fc920687.20179984';
        $sSwitzerlandId = 'a7c40f6321c6f6109.43859248';

        //swiss address
        $oAddress = new oxAddress();
        $oAddress->setId('_testAddress');
        $oAddress->oxaddress__oxcountryid = new oxField($sSwitzerlandId);

        $oAddressList = new oxList();
        $oAddressList['_testAddress'] = $oAddress;

        $oUser = $this->getMock("oxuser", array("getUserAddresses", "getSelectedAddressId"));
        $oUser->oxuser__oxcountryid = new oxField($sGermanyId);
        $oUser->expects($this->exactly(1))->method("getUserAddresses")->will($this->returnValue($oAddressList) );
        $oUser->expects($this->exactly(1))->method("getSelectedAddressId")->will($this->returnValue('_testAddress'));

        //the option is ON
        modConfig::getInstance()->setConfigParam("blShippingCountryVat", true);

        $oVatSelector = $this->getProxyClass("oxVatSelector");
        $this->assertEquals($sSwitzerlandId, $oVatSelector->UNITgetVatCountry($oUser));
    }

    /**
     * Tests oxVatSelector::_getVatCountry() method functionality.
     * Tests the case when for VAT consideration SHIPPING country is taken
     *
     */
    public function testGetVatCountryAsShippingCountryShippingNOTSelected()
    {
        $sGermanyId = 'a7c40f631fc920687.20179984';
        $sSwitzerlandId = 'a7c40f6321c6f6109.43859248';

        //swiss address
        $oAddress = new oxAddress();
        $oAddress->setId('_testAddress');
        $oAddress->oxaddress__oxcountryid = new oxField($sSwitzerlandId);

        $oAddressList = new oxList();
        $oAddressList['_testAddress'] = $oAddress;

        $oUser = $this->getMock("oxuser", array("getUserAddresses", "getSelectedAddressId"));
        $oUser->oxuser__oxcountryid = new oxField($sGermanyId);
        $oUser->expects($this->exactly(1))->method("getUserAddresses")->will($this->returnValue($oAddressList) );
        $oUser->expects($this->exactly(1))->method("getSelectedAddressId")->will($this->returnValue(null));

        //the option is ON
        modConfig::getInstance()->setConfigParam("blShippingCountryVat", true);

        $oVatSelector = $this->getProxyClass("oxVatSelector");
        $this->assertEquals($sGermanyId, $oVatSelector->UNITgetVatCountry($oUser));
    }

    /**
     * Tests oxVatSelector::_getVatCountry() method functionality.
     * Tests the case when for VAT consideration BILLING country is taken
     *
     */
    public function testGetVatCountryAsBillingCountry()
    {
        $sGermanyId = 'a7c40f631fc920687.20179984';
        $sSwitzerlandId = 'a7c40f6321c6f6109.43859248';

        //swiss address
        $oAddress = new oxAddress();
        $oAddress->setId('_testAddress');
        $oAddress->oxaddress__oxcountryid = new oxField($sSwitzerlandId);

        $oAddressList = new oxList();
        $oAddressList['_testAddress'] = $oAddress;

        $oUser = $this->getMock("oxuser", array("getUserAddresses", "getSelectedAddressId"));
        $oUser->oxuser__oxcountryid = new oxField($sGermanyId);
        $oUser->expects($this->never())->method("getUserAddresses");
        $oUser->expects($this->never())->method("getSelectedAddressId");

        //the option is ON
        modConfig::getInstance()->setConfigParam("blShippingCountryVat", false);

        $oVatSelector = $this->getProxyClass("oxVatSelector");
        $this->assertEquals($sGermanyId, $oVatSelector->UNITgetVatCountry($oUser));
    }

    /**
     * Tests whether oxVatSelector::_getVatCountry() is correctly envoked
     *
     */
    public function testGetVatCountryIsCalled()
    {
        $sGermanyId = 'a7c40f631fc920687.20179984';
        $oUser = new oxUser();

        $oVatSelector = $this->getMock("oxVatSelector", array("_getVatCountry"));
        $oVatSelector->expects($this->once())->method("_getVatCountry")->with($oUser)->will($this->returnValue($sGermanyId));
        $oVatSelector->getUserVat($oUser, true);
    }

}
