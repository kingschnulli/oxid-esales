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
 * @version   SVN: $Id: oxdiscountTest.php 42984 2012-03-19 08:50:01Z linas.kukulskis $
 */

require_once realpath( "." ).'/unit/OxidTestCase.php';
require_once realpath( "." ).'/unit/test_config.inc.php';

class modoxprice extends oxprice
{
    protected $_dPrice = null;
    function getBruttoPrice()
    {
        return $this->_dPrice;
    }
    function setPrice($newPrice, $dVat = null)
    {
        $this->_dPrice = $newPrice;
    }
}

class oxBasket_Extended extends oxbasket
{
    public $oBasketSummaryCache = null;

    function getBasketSummary()
    {
        if ($this->oBasketSummaryCache) {
            return $this->oBasketSummaryCache;
        } else {
            return parent::getBasketSummary();
        }
    }
}

class oxArticle_Extended extends oxArticle
{
    public $aCategoryIdsCache=null;
    public $oBasketSummaryCache = null;
    public $dBasePriceCache = null;
    public $oPriceCache = null;

    function getCategoryIds( $blActCats = false, $blSkipCache = false )
    {
        if ($this->aCategoryIdsCache) {
            return $this->aCategoryIdsCache;
        } else {
            return parent::GetCategoryIds();
        }
    }

    function getBasketSummary()
    {
        if ($this->oBasketSummaryCache) {
            return $this->oBasketSummaryCache;
        } else {
            return parrent::getBasketSummary();
        }
    }

    function getBasePrice( $dAmount = 1 )
    {
        if ($this->dBasePriceCache) {
            return $this->dBasePriceCache;
        } else {
            return parent::getBasePrice();
        }
    }

    function getPrice()
    {
        if ($this->oPriceCache) {
            return $this->oPriceCache;
        } else {
            return parent::getPrice();
        }
    }

}

/**
 * OxDiscountList tester
 */
class Unit_Core_oxDiscountTest extends OxidTestCase
{

    /**
     * Tear down the fixture.
     *
     * @return null
     */
    protected function tearDown()
    {
        $this->_removeDiscounts();

        oxRemClassModule('oxArticle_Extended');
        oxRemClassModule('oxBasket_Extended');

        $this->cleanUpTable( 'oxdiscount' );
        $this->cleanUpTable( 'oxobject2discount' );
        parent::tearDown();
    }

    protected function _removeDiscounts()
    {
        $myDB = oxDb::getDb();

        $myDB->Execute( "delete from oxdiscount where oxid like 'test%' " );
        $myDB->Execute( "delete from oxobject2discount where oxid like 'test%' " );
        $myDB->Execute("delete from oxobject2discount where oxid='testIsForArticle'");
        $myDB->Execute("delete from oxobject2discount where oxid='testCheckForArticleNotSpecForItem'");
    }

    /**
     * Testing if deletion does not leave records in DB
     */
    public function testDelete()
    {
        $myDB    = oxDb::getDb();

        $oDiscount = oxNew('oxDiscount');
        $sId = 'testDelete';
        $oDiscount->setId($sId);
        $oDiscount->save();

        oxDb::getDb()->Execute("insert into oxobject2discount VALUE('testDeleteoxid','".$sId."','nothing','empty')");
        $oDiscount->load( $sId );

        // now deleting and checking for records in DB
        $oDiscount->delete();
        $this->assertEquals( 0, (int) $myDB->getOne( 'select count(*) from oxdiscount where oxid = "'.$sId.'"' ) );
        $this->assertEquals( 0, (int) $myDB->getOne( 'select count(*) from oxobject2discount where oxdiscountid = "'.$sId.'"' ) );
    }
    public function testDeleteIfIdSet()
    {
        $myDB    = oxDb::getDb();

        $oDiscount = oxNew('oxDiscount');
        $sId = 'testDelete';
        $oDiscount->setId($sId);
        $oDiscount->save();

        oxDb::getDb()->Execute("insert into oxobject2discount VALUE('testDeleteoxid','".$sId."','nothing','empty')");
        $oDiscount->load( $sId );

        // now deleting and checking for records in DB
        $oDiscount->delete($sId);
        $this->assertEquals( 0, (int) $myDB->getOne( 'select count(*) from oxdiscount where oxid = "'.$sId.'"' ) );
        $this->assertEquals( 0, (int) $myDB->getOne( 'select count(*) from oxobject2discount where oxdiscountid = "'.$sId.'"' ) );
    }
    public function testDeleteNotSetValue()
    {
        $oDiscount = oxNew('oxDiscount');

        $this->assertFalse( $oDiscount->delete() );
    }


    /**
     * Testing "for article" check
     */
    // main article
    public function testIsForArticleMainArticle()
    {
        $oDiscount = oxNew( 'oxDiscount' );
        $testDiscId = 'testdid';
        $oDiscount->setId( $testDiscId );
        $oDiscount->save();

        $oArticle = new oxArticle();

        //an item discount should return false
        $oDiscount->oxdiscount__oxaddsumtype = new oxField('itm', oxField::T_RAW);
        $this->assertFalse($oDiscount->isForArticle($oArticle));

        //an discount with amount or price should return false
        $oDiscount->oxdiscount__oxaddsumtype = new oxField('abs', oxField::T_RAW);
        $oDiscount->oxdiscount__oxprice = new oxField(null, oxField::T_RAW);
        $oDiscount->oxdiscount__oxamount = new oxField(1, oxField::T_RAW);
        $this->assertFalse( $oDiscount->isForArticle( $oArticle ) );

        $oDiscount->oxdiscount__oxprice = new oxField(1, oxField::T_RAW);
        $oDiscount->oxdiscount__oxamount = new oxField(null, oxField::T_RAW);
        $this->assertFalse( $oDiscount->isForArticle( $oArticle ) );

        //if there is a discount for the article return true
        $testAid = 'testaid';
        $oDiscount->oxdiscount__oxprice = new oxField(null, oxField::T_RAW);
        $oDiscount->oxdiscount__oxamount = new oxField(null, oxField::T_RAW);
        $oArticle->setId( $testAid );
        //$oArticle->save();

        oxDb::getDb()->Execute("insert into oxobject2discount VALUES( 'testIsForArticle', '".$testDiscId."','".$testAid."','oxarticles')");
        $this->assertTrue( $oDiscount->isForArticle( $oArticle ) );



        //global discount for all articles
        $oDiscount = oxNew( 'oxDiscount' );
        $testDiscId = 'testdid';
        $oDiscount->setId( $testDiscId );
        $oDiscount->save();
        oxDb::getDb()->Execute("delete from oxobject2discount where oxid='testIsForArticle'");
        $this->assertTrue($oDiscount->isForArticle($oArticle));

        //no article discount but fitting category
        $oDiscount = oxNew( 'oxDiscount' );
        $testDiscId = 'testdid';
        $oDiscount->setId( $testDiscId );
        $oDiscount->save();
        $oArticle = new oxArticle_Extended();
        $testCatId = 'testcatid';
        oxDb::getDb()->Execute("insert into oxobject2discount VALUES('testIsForArticle','".$testDiscId."','".$testCatId."','oxcategories')");
        $oArticle->aCategoryIdsCache = array( $testCatId );
        $this->assertTrue( $oDiscount->isForArticle( $oArticle ) );

        //no article discount for fitting category
        $oArticle = new oxArticle();
        $oArticle->setId( $testAid );
        $this->assertFalse( $oDiscount->isForArticle( $oArticle ) );
    }


    //no article discount for fitting category
    public function testIsForArticleFittingOnlyCat()
    {
        $oDiscount = new oxDiscount();
        $testDiscId = 'testdid';
        $oDiscount->setId( $testDiscId );
        $oDiscount->save();

        //an discount with amount or price should return false
        $oDiscount->oxdiscount__oxaddsumtype = new oxField('abs', oxField::T_RAW);
        $testAid = 'testaid';
        $oDiscount->oxdiscount__oxprice = new oxField(null, oxField::T_RAW);
        $oDiscount->oxdiscount__oxamount = new oxField(null, oxField::T_RAW);

        $testCatId = 'testcatid';
        oxDb::getDb()->Execute("insert into oxobject2discount VALUES('testIsForArticle','".$testDiscId."','".$testCatId."','oxcategories')");

        //no article discount for fitting category
        $oArticle = new oxArticle();
        $oArticle->setId( $testAid );
        $this->assertFalse( $oDiscount->isForArticle( $oArticle ) );
    }
    //no article discount
    public function testIsForArticleNoFittingDiscounts()
    {
        $oDiscount = new oxDiscount();
        $testDiscId = 'testdid';
        $oDiscount->setId( $testDiscId );
        $oDiscount->save();

        //an discount with amount or price should return false
        $oDiscount->oxdiscount__oxaddsumtype = new oxField('abs', oxField::T_RAW);
        $oDiscount->oxdiscount__oxprice = new oxField(null, oxField::T_RAW);
        $oDiscount->oxdiscount__oxamount = new oxField(null, oxField::T_RAW);

        //no article discount for fitting category
        $oArticle = new oxArticle_Extended();
        $testCatId = 'testcatid';
        oxDb::getDb()->Execute("insert into oxobject2discount VALUES('testIsForArticle','".$testDiscId."','".$testCatId."','oxcategories')");
        $oArticle->aCategoryIdsCache = array( 'testcatid2' );
        $this->assertFalse( $oDiscount->isForArticle( $oArticle ) );
    }
    // variant ( FS#2625 )
    public function testIsForArticleVariant()
    {
        $oDiscount = new oxDiscount();
        $testDiscId = 'testdid';
        $oDiscount->setId( $testDiscId );
        $oDiscount->save();

        $testAid = 'testaid';
        $oArticle = new oxArticle();
        $oArticle->oxarticles__oxparentid = new oxField($testAid, oxField::T_RAW);
        //$oArticle->save();

        oxDb::getDb()->Execute( "insert into oxobject2discount VALUES( 'testIsForArticle', '".$testDiscId."','".$testAid."','oxarticles')" );
        $this->assertTrue( $oDiscount->isForArticle( $oArticle ) );

        //global discount for all articles
        $oDiscount = new oxDiscount();
        $testDiscId = 'testdid';
        $oDiscount->setId( $testDiscId );
        $oDiscount->save();
        oxDb::getDb()->Execute( "delete from oxobject2discount where oxid='testIsForArticle'" );
        $this->assertTrue( $oDiscount->isForArticle( $oArticle ) );
    }
    //amount discount from 0 to n, price discount is off (M:792)
    public function testIsForArticleWithAmountFromZeroToN()
    {
        $oDiscount = new oxDiscount();
        $testDiscId = 'testdid';
        $oDiscount->setId( $testDiscId );
        $oDiscount->save();

        //an discount with amount or price should return false
        $oDiscount->oxdiscount__oxaddsumtype = new oxField('abs', oxField::T_RAW);
        $oDiscount->oxdiscount__oxprice = new oxField(0, oxField::T_RAW);
        $oDiscount->oxdiscount__oxpriceto = new oxField(0, oxField::T_RAW);
        $oDiscount->oxdiscount__oxamount = new oxField(0, oxField::T_RAW);
        $oDiscount->oxdiscount__oxamountto = new oxField(999, oxField::T_RAW);

        //no article discount for fitting category
        $oArticle = new oxArticle_Extended();
        $testCatId = 'testcatid';
        $oArticle->dBasePriceCache = 15;
        oxDb::getDb()->Execute("insert into oxobject2discount VALUES('testIsForArticle','".$testDiscId."','".$oArticle->getId()."','oxarticles')");
        $this->assertTrue( $oDiscount->isForArticle( $oArticle ) );
    }
    //amount discount is off, price discount from 0 to n
    public function testIsForArticleWithPriceDiscountFromZeroToN()
    {
        $oDiscount = new oxDiscount();
        $testDiscId = 'testdid';
        $oDiscount->setId( $testDiscId );
        $oDiscount->save();

        //an discount with amount or price should return false
        $oDiscount->oxdiscount__oxaddsumtype = new oxField('abs', oxField::T_RAW);
        $oDiscount->oxdiscount__oxprice = new oxField(0, oxField::T_RAW);
        $oDiscount->oxdiscount__oxpriceto = new oxField(999, oxField::T_RAW);
        $oDiscount->oxdiscount__oxamount = new oxField(0, oxField::T_RAW);
        $oDiscount->oxdiscount__oxamountto = new oxField(0, oxField::T_RAW);

        //no article discount for fitting category
        $oArticle = new oxArticle_Extended();
        $testCatId = 'testcatid';
        $oArticle->dBasePriceCache = 15;
        oxDb::getDb()->Execute("insert into oxobject2discount VALUES('testIsForArticle','".$testDiscId."','".$oArticle->getId()."','oxarticles')");
        $this->assertTrue( $oDiscount->isForArticle( $oArticle ) );
    }

    /**
     * Tests for basket item check
     */
    /**
     * Test case:
     * discount is setup for 3 products (amounts 3, 1, 2), amount
     * from 5 to 10
     */
    public function testIsForBasketItemForTestCase()
    {
        modConfig::getInstance()->setConfigParam( "blVariantParentBuyable", 1 );
        $sDiscountId = '_'.uniqid( rand() );

        // inserting test discount
            $sQ = "insert into oxdiscount ( oxid, oxshopid, oxactive, oxtitle, oxamount, oxamountto, oxpriceto, oxaddsumtype, oxaddsum )
                   values ( '{$sDiscountId}', '".oxConfig::getInstance()->getBaseShopId()."', '1', 'Test', '5', '10', '0', 'abs', '10' )";

        oxDb::getDb()->Execute( $sQ );

        // inserting test discount
        $sQ = "insert into oxobject2discount ( oxid, oxdiscountid, oxobjectid, oxtype )
               values
               ( '_test".uniqid(rand(), true ).".', '{$sDiscountId}', '1126', 'oxarticles' ),
               ( '_test".uniqid(rand(), true ).".', '{$sDiscountId}', '1127', 'oxarticles' ),
               ( '_test".uniqid(rand(), true ).".', '{$sDiscountId}', '1131', 'oxarticles' ) ";
        oxDb::getDb()->Execute( $sQ );

        $oBasket = new oxBasket();
        $oBasket->addToBasket( '1127', 1 );
        $oBasket->addToBasket( '1131', 4 );
        $oBasket->addToBasket( '1142', 6 );

        $oDiscount = new oxDiscount();
        $oDiscount->load( $sDiscountId );

        $oArticle = new oxArticle();
        $oArticle->load( '1127' );
        $this->assertTrue( $oDiscount->isForBasketItem( $oArticle ) && $oDiscount->isForBasketAmount( $oBasket ) );

        $oBasket->addToBasket( '1126', 6 );

        $oArticle = new oxArticle();
        $oArticle->load( '1127' );

        $this->assertTrue( $oDiscount->isForBasketItem( $oArticle ) );
        $this->assertFalse( $oDiscount->isForBasketAmount( $oBasket ) );
    }

    /**
     * Test case:
     * discount is setup for 3 products (amounts 3, 1, 2), price
     * from 500 to 1000
     */
    public function testIsForBasketItemForTestCase2()
    {
        modConfig::getInstance()->setConfigParam( "blVariantParentBuyable", 1 );
        $sDiscountId = '_'.uniqid( rand() );

        // inserting test discount
            $sQ = "insert into oxdiscount ( oxid, oxshopid, oxactive, oxtitle, oxamount, oxamountto, oxpriceto, oxprice, oxaddsumtype, oxaddsum )
                   values ( '{$sDiscountId}', '".oxConfig::getInstance()->getBaseShopId()."', '1', 'Test', '0', '0', '1000', '500', 'abs', '10' )";

        oxDb::getDb()->Execute( $sQ );

        // inserting test discount
        $sQ = "insert into oxobject2discount ( oxid, oxdiscountid, oxobjectid, oxtype )
               values
               ( '_test".uniqid(rand(), true ).".', '{$sDiscountId}', '1126', 'oxarticles' ),
               ( '_test".uniqid(rand(), true ).".', '{$sDiscountId}', '1127', 'oxarticles' ),
               ( '_test".uniqid(rand(), true ).".', '{$sDiscountId}', '1131', 'oxarticles' ) ";
        oxDb::getDb()->Execute( $sQ );

        $oBasket = new oxBasket();
        $oBasket->addToBasket( '1127', 10 ); // 80
        $oBasket->addToBasket( '1131', 10 ); // 230

        $oDiscount = new oxDiscount();
        $oDiscount->load( $sDiscountId );

        $oArticle = new oxArticle();
        $oArticle->load( '1127' );
        $this->assertTrue( $oDiscount->isForBasketItem( $oArticle ) );
        $this->assertFalse( $oDiscount->isForBasketAmount( $oBasket ) );

        $oBasket->addToBasket( '1126', 10 );

        $oArticle = new oxArticle();
        $oArticle->load( '1127' );

        $this->assertTrue( $oDiscount->isForBasketItem( $oArticle ) && $oDiscount->isForBasketAmount( $oBasket ) );
        $this->assertTrue( $oDiscount->isForBasketItem( $oArticle ) && $oDiscount->isForBasketAmount( $oBasket ) );
    }

    // testing discount params check
    public function testIsForBasketItem()
    {
        $oDiscount  = new oxDiscount();
        $testDiscId = 'testIsForBasketItem';
        $oDiscount->setId( $testDiscId );

        $oArticle = new oxArticle();
        $oBasket  = new oxBasket();

        //an discount with amount or price should return false
        $oDiscount->oxdiscount__oxaddsumtype = new oxField('abs', oxField::T_RAW);
        $oDiscount->oxdiscount__oxprice = new oxField(null, oxField::T_RAW);
        $oDiscount->oxdiscount__oxamount = new oxField(1, oxField::T_RAW);
        $this->assertFalse( $oDiscount->isForBasketItem( $oArticle, $oBasket ) );

        $oDiscount->oxdiscount__oxprice = new oxField(1, oxField::T_RAW);
        $oDiscount->oxdiscount__oxamount = new oxField(null, oxField::T_RAW);
        $this->assertFalse( $oDiscount->isForBasketItem( $oArticle, $oBasket ) );
    }
    // variant check
    public function testIsForBasketItemVariantCheck()
    {
        $testAid  = 'xxx';
        $oArticle = new oxarticle();
        $oArticle->oxarticles__oxparentid = new oxField( $testAid );

        oxDb::getDb()->Execute( "insert into oxobject2discount VALUES( 'testIsForArticle', 'testdid', '{$testAid}', 'oxarticles' )" );

        $oDiscount = $this->getMock( 'oxdiscount', array( '_checkForArticleCategories' ) );
        $oDiscount->expects( $this->never() )->method( '_checkForArticleCategories' );

        // setting up discount
        $oDiscount->oxdiscount__oxamount = new oxField( 1 );
        $oDiscount->oxdiscount__oxprice  = new oxField( 1 );
        $oDiscount->setId( 'testdid' );

        // testing
        $oDiscount->isForBasketItem( $oArticle );
    }
    // main article check
    public function testIsForBasketItemMainArticleCheck()
    {
        $testAid  = 'xxx';
        $oArticle = new oxarticle();
        $oArticle->setId( $testAid );

        oxDb::getDb()->Execute( "insert into oxobject2discount VALUES( 'testIsForArticle', 'testdid', '{$testAid}', 'oxarticles' )" );

        $oDiscount = $this->getMock( 'oxdiscount', array( '_checkForArticleCategories' ) );
        $oDiscount->expects( $this->never() )->method( '_checkForArticleCategories' );

        // setting up discount
        $oDiscount->oxdiscount__oxamount = new oxField( 1 );
        $oDiscount->oxdiscount__oxprice  = new oxField( 1 );
        $oDiscount->setId( 'testdid' );

        // testing
        $oDiscount->isForBasketItem( $oArticle );
    }
    //if general discount
    public function testIsForBasketItemIfGeneralDiscount()
    {
        $oDiscount  = new oxDiscount();
        $testDiscId = 'testIsForBasketItem';
        $oDiscount->setId( $testDiscId );

        $oArticle = new oxArticle();
        $oBasket  = new oxBasket();

        //an discount with amount or price should return false
        $oDiscount->oxdiscount__oxaddsumtype = new oxField('itm', oxField::T_RAW);
        $oDiscount->oxdiscount__oxprice = new oxField(0, oxField::T_RAW);
        $oDiscount->oxdiscount__oxamount = new oxField(0, oxField::T_RAW);
        $this->assertFalse( $oDiscount->isForBasketItem( $oArticle, $oBasket ) );
    }
    //if bundel discount
    public function testIsForBasketItemIfBundelDiscount()
    {
        $oDiscount  = new oxDiscount();
        $testDiscId = 'testIsForBasketItem';
        $oDiscount->setId( $testDiscId );

        $oArticle = new oxArticle();
        $oBasket  = new oxBasket();

        //an discount with amount or price should return false
        $oDiscount->oxdiscount__oxaddsumtype = new oxField('itm', oxField::T_RAW);
        $oDiscount->oxdiscount__oxprice = new oxField(1, oxField::T_RAW);
        $oDiscount->oxdiscount__oxamount = new oxField(1, oxField::T_RAW);
        $this->assertFalse( $oDiscount->isForBasketItem( $oArticle, $oBasket ) );
    }

    public function testIsForBasket()
    {
        $oDiscount = oxNew('oxDiscount');
        $testDiscId = 'testIsForBasketDisId';
        $oDiscount->setId($testDiscId);

        $oBasket = oxNew('oxBasket');

        //an discount with amount or price should return false
        $oDiscount->oxdiscount__oxaddsumtype = new oxField('abs', oxField::T_RAW);
        $oDiscount->oxdiscount__oxprice = new oxField(0, oxField::T_RAW);
        $oDiscount->oxdiscount__oxamount = new oxField(0, oxField::T_RAW);
        $this->assertFalse($oDiscount->isForBasket( $oBasket));


        $oDiscount->oxdiscount__oxamount = new oxField(0, oxField::T_RAW);
        $oDiscount->oxdiscount__oxamountto = new oxField(10, oxField::T_RAW);
        $oDiscount->oxdiscount__oxprice = new oxField(0, oxField::T_RAW);
        $oDiscount->oxdiscount__oxpriceto = new oxField(20, oxField::T_RAW);
        $oDiscount->oxdiscount__oxamount = new oxField(1, oxField::T_RAW);
        $this->assertFalse( $oDiscount->isForBasket( $oBasket ) );

        $oDiscount->oxdiscount__oxprice = new oxField(1, oxField::T_RAW);
        $oDiscount->oxdiscount__oxamount = new oxField(0, oxField::T_RAW);
        $this->assertFalse( $oDiscount->isForBasket( $oBasket ) );

        $oBasket = new oxBasket_Extended();
        $oBasket->oBasketSummaryCache = new oxStdClass();
        $oBasket->oBasketSummaryCache->iArticleCount = 5;
        $oBasket->oBasketSummaryCache->dArticleDiscountablePrice = 10;
        oxDb::getDb()->Execute( "insert into oxobject2discount VALUES('testIsForBasket','".$testDiscId."','nothing','oxarticles')" );

        $oDiscount->oxdiscount__oxamount = new oxField(1, oxField::T_RAW);
        $this->assertFalse($oDiscount->isForBasket( $oBasket ) );
        oxDb::getDb()->Execute("delete from oxobject2discount where oxid = 'testIsForBasket'");
        $this->assertTrue( $oDiscount->isForBasket( $oBasket ) );


        $oDiscount->oxdiscount__oxprice = new oxField(11, oxField::T_RAW);
        $this->assertFalse( $oDiscount->isForBasket( $oBasket ) );
        $oDiscount->oxdiscount__oxprice = new oxField(1, oxField::T_RAW);

        $oDiscount->oxdiscount__oxamount = new oxField(6, oxField::T_RAW);
        $this->assertFalse($oDiscount->isForBasket( $oBasket));
    }

    public function testIsForBasketItemPriceCurrencyChecks()
    {
        $oSummary = new oxStdClass();
        $oSummary->iArticleCount = 5;
        $oSummary->dArticleDiscountablePrice = 101;

        $oCurr = new stdclass;
        $oCurr->rate = 5;

        $oBasket = $this->getMock( "oxBasket", array( "getBasketSummary", "getBasketCurrency" ) );
        $oBasket->expects( $this->atLeastOnce() )->method( 'getBasketSummary' )->will( $this->returnValue( $oSummary ) );
        $oBasket->expects( $this->atLeastOnce() )->method( 'getBasketCurrency' )->will( $this->returnValue( $oCurr ) );

        $oDiscount = new oxdiscount();
        $oDiscount->oxdiscount__oxprice = new oxField( 100 );
        $oDiscount->oxdiscount__oxpriceto = new oxField( 150 );

        $this->assertFalse( $oDiscount->isForBasket( $oBasket ) );

        $oCurr = new stdclass;
        $oCurr->rate = 1;

        $oBasket = $this->getMock( "oxBasket", array( "getBasketSummary", "getBasketCurrency" ) );
        $oBasket->expects( $this->atLeastOnce() )->method( 'getBasketSummary' )->will( $this->returnValue( $oSummary ) );
        $oBasket->expects( $this->atLeastOnce() )->method( 'getBasketCurrency' )->will( $this->returnValue( $oCurr ) );

        $oDiscount = new oxdiscount();
        $oDiscount->oxdiscount__oxprice = new oxField( 100 );
        $oDiscount->oxdiscount__oxpriceto = new oxField( 150 );

        $this->assertTrue( $oDiscount->isForBasket( $oBasket ) );
    }

    /**
     * Testing bundle checker
     */
    public function testIsForBundleItem()
    {
        $oDiscount = oxNew('oxDiscount');
        $oDiscount->oxdiscount__oxaddsumtype = new oxField("test", oxField::T_RAW);
        $this->assertFalse($oDiscount->isForBundleItem(null, null));
    }
    /**
     * Testing with simulated data
     */
    public function testIsForBundleItemWithData()
    {
        $testAid  = 'xxx';
        $oArticle = new oxarticle();
        $oArticle->setId( $testAid );

        $oDiscount = $this->getMock( 'oxdiscount', array( '_checkForArticleCategories' ) );
        $oDiscount->expects( $this->once() )->method( '_checkForArticleCategories' )->with( $this->isInstanceOf( 'oxarticle' ) );
        $oDiscount->oxdiscount__oxaddsumtype = new oxField( 'itm' );
        $oDiscount->setId( 'testdid' );

        // testing
        $oDiscount->isForBundleItem( $oArticle );
    }

    /**
     * Testing basket bundle checker
     */
    // configuration check
    public function testIsForBundleBasket()
    {
        $oDiscount = new oxDiscount();
        $oDiscount->oxdiscount__oxaddsumtype = new oxField("test", oxField::T_RAW);
        $this->assertFalse( $oDiscount->isForBundleBasket( null ) );
    }
    // testing if further functionality is executed
    public function testIsForBundleBasketFncCheck()
    {
        $oBasket = new oxbasket();

        $oDiscount = $this->getMock( 'oxdiscount', array( 'isForBasket' ) );
        $oDiscount->expects( $this->once() )->method( 'isForBasket' )->with( $this->equalTo( $oBasket ) );
        $oDiscount->oxdiscount__oxaddsumtype = new oxField('itm', oxField::T_RAW);

        $oDiscount->isForBundleBasket( $oBasket );
    }

    public function testGetAbsValue_abs()
    {
        $oDiscount = oxNew( 'oxdiscount' );

        $oDiscount->oxdiscount__oxaddsumtype = new oxField('abs', oxField::T_RAW);
        $oDiscount->oxdiscount__oxaddsum = new oxField(50, oxField::T_RAW);

        $this->assertEquals( 50, $oDiscount->getAbsValue( 100 ) );
    }

    public function testGetAbsValueAbsForAmount()
    {
        $oDiscount = new oxDiscount();
        $oDiscount->oxdiscount__oxaddsumtype = new oxField('abs', oxField::T_RAW);
        $oDiscount->oxdiscount__oxaddsum = new oxField(5, oxField::T_RAW);
        $this->assertEquals( 10, $oDiscount->getAbsValue( 100, 2 ) );
    }

    public function testGetAbsValue_perc()
    {
        $oDiscount = oxNew( 'oxdiscount' );

        $oDiscount->oxdiscount__oxaddsumtype = new oxField('%', oxField::T_RAW);
        $oDiscount->oxdiscount__oxaddsum = new oxField(50, oxField::T_RAW);

        $this->assertEquals( 50, $oDiscount->getAbsValue( 100 ) );
    }

    public function testGetBundleAmount()
    {
        $oDiscount = oxNew('oxDiscount');
        $oDiscount->oxdiscount__oxitmamount = new oxField(10, oxField::T_RAW);
        $this->assertEquals($oDiscount->getBundleAmount(5), 10);

        $oDiscount->oxdiscount__oxitmmultiple = new oxField(3, oxField::T_RAW);
        $oDiscount->oxdiscount__oxamount = new oxField(4, oxField::T_RAW);
        $this->assertEquals($oDiscount->getBundleAmount(9), 20);
    }
/*
    public function testCheckForArticleSpecForItem()
    {
        $oDiscount = oxNew('oxDiscount');
        $oArticle = oxNew('oxArticle');

        $this->assertTrue($oDiscount->UNITcheckForArticle(null, true, null));

        $oAPrice = oxNew('oxPrice');
        $oAPrice->setPrice(10);
        $oArticle->setPrice($oAPrice);

        $oBasketInfo = new Oxstdclass();
        $oBasketInfo->aArticles=array($oArticle->getId() => 1);
        $oDiscount->oxdiscount__oxprice = new oxField(9, oxField::T_RAW);
        $oDiscount->oxdiscount__oxpriceto = new oxField(11, oxField::T_RAW);
        $this->assertTrue($oDiscount->UNITcheckForArticle($oArticle, true, $oBasketInfo));
        $oDiscount->oxdiscount__oxprice = new oxField(11, oxField::T_RAW);
        $this->assertFalse($oDiscount->UNITcheckForArticle($oArticle, true, $oBasketInfo));
        $oBasketInfo->aArticles=array($oArticle->getId() => 2);
        $this->assertFalse($oDiscount->UNITcheckForArticle($oArticle, true, $oBasketInfo));

        $oDiscount->oxdiscount__oxprice = new oxField(null, oxField::T_RAW);
        $oBasketInfo->aArticles=array($oArticle->getId() => 10);
        $oDiscount->oxdiscount__oxamount = new oxField(9, oxField::T_RAW);
        $this->assertFalse($oDiscount->UNITcheckForArticle($oArticle, true, $oBasketInfo));
    }
*/
/*
    public function testCheckForArticleNotSpecForItem()
    {

        $catId = "testCatIdCheckForArticle";

        $oDiscount = oxNew('oxDiscount');
        $oDiscount->setId('testIdCheckForArticle');
        $oArticle = new oxArticle_Extended();
        $oArticle->GetCategoryIds_return = null;
        $this->assertFalse($oDiscount->UNITcheckForArticle($oArticle,false,null));

        $oArticle->GetCategoryIds_return = array($catId);
        oxDb::getDb()->Execute("insert into oxobject2discount VALUES('testCheckForArticleNotSpecForItem','".$oDiscount->getId()."','".$catId."','oxcategories')");
        $this->assertTrue($oDiscount->UNITcheckForArticle($oArticle,false,null));

        $oDiscount->oxdiscount__oxprice = new oxField(10, oxField::T_RAW);
        $oBasketInfo = new Oxstdclass();
        //$oPrice = oxNew('oxPrice');
        $oBasketInfo->aCategories=array();
        $oBasketInfo->aCategories[$catId]->dPrice = 9;
        $this->assertFalse($oDiscount->UNITcheckForArticle($oArticle,false,$oBasketInfo));
        $oBasketInfo->aCategories[$catId]->dPrice = 11;
        $oDiscount->oxdiscount__oxpriceto = new oxField(1, oxField::T_RAW);
        $this->assertFalse($oDiscount->UNITcheckForArticle($oArticle,false,$oBasketInfo));
        $oDiscount->oxdiscount__oxpriceto = new oxField(11, oxField::T_RAW);
        $this->assertTrue($oDiscount->UNITcheckForArticle($oArticle,false,$oBasketInfo));

        $oDiscount->oxdiscount__oxprice = new oxField(null, oxField::T_RAW);
        $oDiscount->oxdiscount__oxamount = new oxField(5, oxField::T_RAW);
        $oBasketInfo->aCategories[$catId]->dAmount = 4;
        $this->assertFalse($oDiscount->UNITcheckForArticle($oArticle,false,$oBasketInfo));
        $oBasketInfo->aCategories[$catId]->dAmount = 6;
        $oDiscount->oxdiscount__oxamountto = new oxField(1, oxField::T_RAW);
        $this->assertFalse($oDiscount->UNITcheckForArticle($oArticle,false,$oBasketInfo));
        $oDiscount->oxdiscount__oxamountto = new oxField(11, oxField::T_RAW);
        $this->assertTrue($oDiscount->UNITcheckForArticle($oArticle,false,$oBasketInfo));

    }
*/
    /**
     * Testing simple voucher getter
     */
    public function testGetSimpleDiscount()
    {
        $myUtils = oxUtils::getInstance();
        $sShopId = oxConfig::getInstance()->getBaseShopId();
        $myDB    = oxDb::getDb();
        $sQ  = 'insert into oxdiscount ';
        $sQ .= '(oxid, oxshopid, oxactive, oxtitle, oxamount, oxamountto, oxprice, oxpriceto, oxaddsumtype, oxaddsum) values ';
        $sQ .= "('testdid', '$sShopId', '1', 'test for shop $sShopId', '0', '9999', '0', '9999', 'abs', '10') ";
        $myDB->Execute( $sQ );
        // EE version changes
        $oDiscount = oxNew( 'oxDiscount' );
        $oDiscount->load( 'testdid' );
        $oDiscount->oxdiscount__oxactive = new oxField( '1', oxField::T_RAW );

        $oSimpleDiscount = new OxstdClass();
        $oSimpleDiscount->sOXID     = $oDiscount->getId();
        $oSimpleDiscount->sDiscount = $oDiscount->oxdiscount__oxtitle->value;
        $oSimpleDiscount->sType     = $oDiscount->oxdiscount__oxaddsumtype->value;

        $this->assertEquals( $oSimpleDiscount, $oDiscount->getSimpleDiscount() );
    }

    public function testIsForBasketAmountIfnotisforbasket()
    {
        $oArticle = $this->getMock('oxarticle', array('getBasePrice', 'getId'));
        $oArticle->expects( $this->never() )->method( 'getId' )->will( $this->returnValue( 'asd' ) );
        $oArticle->expects( $this->never() )->method( 'getBasePrice' )->will( $this->returnValue( 2 ) );

        $oBasketItem = $this->getMock( 'oxbasketitem', array( 'getArticle' ) );
        $oBasketItem->expects( $this->once() )->method( 'getArticle' )->will( $this->returnValue( $oArticle ) );

        $oBasket = $this->getMock('oxbasket', array( 'getContents' ));
        $oBasket->expects( $this->once() )->method( 'getContents' )->will( $this->returnValue( array( $oBasketItem ) ) );

        $oDiscount = $this->getMock('oxdiscount', array( 'isForAmount', 'isForBasketItem', 'isForBundleItem' ) );
        $oDiscount->expects( $this->once() )->method( 'isForAmount' )->with( $this->equalTo( 0 ) )->will( $this->returnValue( true ) );
        $oDiscount->expects( $this->once() )->method( 'isForBasketItem' )->with($this->equalTo( $oArticle ))->will($this->returnValue( false ) );
        $oDiscount->expects( $this->never() )->method( 'isForBundleItem' );

        $this->assertTrue( $oDiscount->isForBasketAmount( $oBasket ) );

    }
    public function testIsForBasketAmountIfNotIsForBundle()
    {
        $oArticle = $this->getMock('oxarticle', array('getBasePrice', 'getId'));
        $oArticle->expects( $this->never() )->method( 'getId' )->will( $this->returnValue( 'asd' ) );
        $oArticle->expects( $this->never() )->method( 'getBasePrice' )->will( $this->returnValue( 2 ) );

        $oBasketItem = $this->getMock( 'oxbasketitem', array( 'getArticle' ) );
        $oBasketItem->expects( $this->once() )->method( 'getArticle' )->will( $this->returnValue( $oArticle ) );

        $oBasket = $this->getMock('oxbasket', array( 'getContents' ));
        $oBasket->expects( $this->once() )->method( 'getContents' )->will( $this->returnValue( array( $oBasketItem ) ) );

        $oDiscount = $this->getMock('oxdiscount', array( 'isForAmount', 'isForBundleItem', 'isForBasketItem' ) );
        $oDiscount->oxdiscount__oxaddsumtype = new oxField('itm', oxField::T_RAW);
        $oDiscount->expects( $this->once() )->method( 'isForAmount' )->with($this->equalTo( 0 )  )->will( $this->returnValue( true ) );
        $oDiscount->expects( $this->once() )->method( 'isForBundleItem' )->with($this->equalTo( $oArticle ))->will($this->returnValue( false ));
        $oDiscount->expects( $this->never() )->method( 'isForBasketItem' );

        $this->assertTrue( $oDiscount->isForBasketAmount( $oBasket ) );

    }
    public function testIsForBasketAmountForPricedDiscountIfBundleType()
    {
        $oArticle = $this->getMock( 'oxarticle', array( 'getPrice', 'getId' ) );
        $oArticle->expects( $this->once() )->method( 'getPrice' )->will( $this->returnValue( new oxprice( 10 ) ));

        $oBasketItem = $this->getMock( 'oxbasketitem', array( 'getArticle', 'getAmount' ) );
        $oBasketItem->expects( $this->once() )->method( 'getArticle' )->will( $this->returnValue( $oArticle ) );
        $oBasketItem->expects( $this->once() )->method( 'getAmount' )->will( $this->returnValue( 5 ) );

        $oBasket = $this->getMock('oxbasket', array('getContents', 'getBasketSummary'));
        $oBasket->expects( $this->once() )->method( 'getContents' )->will( $this->returnValue( array( $oBasketItem ) ) );

        $oDiscount = $this->getMock('oxdiscount', array( 'isForAmount', 'isForBundleItem', 'isForBasketItem' ) );

        $oDiscount->oxdiscount__oxaddsumtype = new oxField( 'itm', oxField::T_RAW );
        $oDiscount->oxdiscount__oxprice      = new oxField( 5, oxField::T_RAW );

        $oDiscount->expects( $this->once() )->method( 'isForAmount' )->with($this->equalTo( 50 )  )->will( $this->returnValue( true ) );
        $oDiscount->expects( $this->once() )->method( 'isForBundleItem' )->with($this->equalTo( $oArticle ))->will($this->returnValue( true ));
        $oDiscount->expects( $this->never() )->method( 'isForBasketItem' );

        $this->assertTrue( $oDiscount->isForBasketAmount( $oBasket ) );
    }
    public function testIsForBasketAmountForAmountDiscountIfSimpleDiscountType()
    {
        $oArticle = $this->getMock( 'oxarticle', array( 'getBasePrice', 'getId' ) );
        $oArticle->expects( $this->never() )->method( 'getPrice' );

        $oBasketItem = $this->getMock( 'oxbasketitem', array( 'getArticle', 'getAmount' ) );
        $oBasketItem->expects( $this->once() )->method( 'getArticle' )->will( $this->returnValue( $oArticle ) );
        $oBasketItem->expects( $this->once() )->method( 'getAmount' )->will( $this->returnValue( 5 ) );

        $oBasket = $this->getMock('oxbasket', array('getContents', 'getBasketSummary'));
        $oBasket->expects( $this->once() )->method( 'getContents' )->will( $this->returnValue( array('asd'=>$oBasketItem) ) );

        $oDiscount = $this->getMock('oxdiscount', array( 'isForAmount', 'isForBasketItem'));

        $oDiscount->oxdiscount__oxaddsumtype = new oxField('abs', oxField::T_RAW);
        $oDiscount->oxdiscount__oxamount     = new oxField(5, oxField::T_RAW);

        $oDiscount->expects( $this->once() )->method( 'isForAmount' )->with($this->equalTo( 5 ) )->will( $this->returnValue( true ) );
        $oDiscount->expects( $this->once() )->method( 'isForBasketItem' )->with($this->equalTo( $oArticle ))->will($this->returnValue( true ));

        $this->assertTrue( $oDiscount->isForBasketAmount( $oBasket ) );
    }

    /**
     * Tests #1571, case: discount should not be applied for different currency amount range
     *
     */
    public function testIsForBasketAmountForDifferentCurrency()
    {

        //setting default currency to another one
        modConfig::getInstance()->setActShopCurrency(1);

        //getting a real demo product becaues with mock it is not easy to make sure the price set is NOT in active currency
        $oArticle = new oxArticle();
        $oArticle->load('1126');
        //$oArticle = $this->getMock( 'oxarticle', array( 'getPrice', 'getId' ) );
        //$oArticle->expects( $this->any() )->method( 'getPrice' )->will( $this->returnValue( new oxprice( 150 ) ));

        $oBasketItem = $this->getMock( 'oxbasketitem', array( 'getArticle', 'getAmount') );
        $oBasketItem->expects( $this->once() )->method( 'getArticle' )->will( $this->returnValue( $oArticle ) );
        $oBasketItem->expects( $this->once() )->method( 'getAmount' )->will( $this->returnValue( 1 ) );

        $oBasket = $this->getMock('oxbasket', array('getContents', 'getBasketSummary'));
        $oBasket->expects( $this->once() )->method( 'getContents' )->will( $this->returnValue( array( $oBasketItem ) ) );

        $oDiscount = $this->getMock('oxdiscount', array( 'isForAmount', 'isForBasketItem' ) );
        $oDiscount->expects($this->once())->method( "isForBasketItem")->will($this->returnValue( true ));

        $oDiscount->oxdiscount__oxaddsumtype = new oxField( 'abs', oxField::T_RAW );
        $oDiscount->oxdiscount__oxprice      = new oxField( 5, oxField::T_RAW );

        $oDiscount->expects( $this->once() )->method( 'isForAmount' )->will( $this->returnValue( true ) );

        //making sure article price is calculated in pounds, and is not equal to eur34
        $this->assertEquals(29.12, $oArticle->getPrice()->getBruttoPrice());

        $oDiscount->isForBasketAmount( $oBasket );
    }

    public function testApplyDiscount()
    {
        $oDiscount  = new oxDiscount();
        $testDiscId = 'testIsForBasketItem';
        $oDiscount->setId( $testDiscId );

        $oPrice  = new oxPrice();
        $oPrice->setPrice(100);

        //an discount with amount or price should return false
        $oDiscount->oxdiscount__oxaddsumtype = new oxField('abs', oxField::T_RAW);
        $oDiscount->oxdiscount__oxaddsum = new oxField(10, oxField::T_RAW);
        $oDiscount->oxdiscount__oxamount = new oxField(1, oxField::T_RAW);
        $oDiscount->applyDiscount( $oPrice, 1 );
        $this->assertEquals( 90, $oPrice->getBruttoPrice() );

    }

    public function testApplyDiscountBigerThenPrice()
    {
        $oDiscount  = new oxDiscount();
        $testDiscId = 'testIsForItem';
        $oDiscount->setId( $testDiscId );

        $oPrice  = new oxPrice();
        $oPrice->setPrice(100);

        //an discount with amount or price should return false
        $oDiscount->oxdiscount__oxaddsumtype = new oxField('abs', oxField::T_RAW);
        $oDiscount->oxdiscount__oxaddsum = new oxField(200, oxField::T_RAW);
        $oDiscount->oxdiscount__oxamount = new oxField(0, oxField::T_RAW);
        $oDiscount->applyDiscount( $oPrice, 1 );
        $this->assertEquals( 0, $oPrice->getBruttoPrice() );

    }

    public function testApplyDiscountInPercent()
    {
        $oDiscount  = new oxDiscount();
        $testDiscId = 'testIsForBasketItem';
        $oDiscount->setId( $testDiscId );

        $oPrice  = new oxPrice();
        $oPrice->setPrice(100);

        //an discount with amount or price should return false
        $oDiscount->oxdiscount__oxaddsumtype = new oxField('%', oxField::T_RAW);
        $oDiscount->oxdiscount__oxaddsum = new oxField(20, oxField::T_RAW);
        $oDiscount->oxdiscount__oxamount = new oxField(1, oxField::T_RAW);
        $oDiscount->applyDiscount( $oPrice, 1 );
        $this->assertEquals( 80, $oPrice->getBruttoPrice() );
    }

    /**
     * Testing oxDiscount::_getProductCheckQuery()
     *
     * @return null
     */
    public function testGetProductCheckQuery()
    {
        $oProduct1 = $this->getMock( "oxStdClass", array( "getProductParentId", "getProductId" ) );
        $oProduct1->expects( $this->once() )->method( 'getProductParentId' )->will( $this->returnValue( "ProductParentId" ) );
        $oProduct1->expects( $this->once() )->method( 'getProductId' )->will( $this->returnValue( "ProductId" ) );

        $oProduct2 = $this->getMock( "oxStdClass", array( "getProductParentId", "getProductId" ) );
        $oProduct2->expects( $this->once() )->method( 'getProductParentId' )->will( $this->returnValue( false ) );
        $oProduct2->expects( $this->once() )->method( 'getProductId' )->will( $this->returnValue( "ProductId" ) );

        $sQ1 = " and ( oxobjectid = 'ProductId' or oxobjectid = 'ProductParentId' )";
        $sQ2 = " and oxobjectid = 'ProductId'";

        $oDiscount = new oxDiscount();
        $this->assertEquals( $sQ1, $oDiscount->UNITgetProductCheckQuery( $oProduct1 ) );
        $this->assertEquals( $sQ2, $oDiscount->UNITgetProductCheckQuery( $oProduct2 ) );
    }

    /**
     * Test case for #0002599: itm discount (product) is not given for variant-product
     *
     * When there is itm discount created, which is applied only for some particular
     * products, which have variants, the discount is not applied for Variant products,
     * when these are added to basket.
     * The problem is that only Parent-article is assigned to discount the variant-products
     * are not valuated in this case, and discount is applied strictly for Parent-product only.
     * This discount should be applied for Variant-products, when only Parent product is
     * assigned to discount.
     *
     * @return null
     */
    public function testForCase2599()
    {
        // creating test discount
        modConfig::getInstance()->setConfigParam( "blVariantParentBuyable", 1 );
        $sDiscountId = '_'.uniqid( rand() );

        // inserting test discount
            $sQ = "insert into oxdiscount ( oxid, oxshopid, oxactive, oxtitle, oxamount, oxamountto, oxpriceto, oxaddsumtype, oxaddsum )
                   values ( '{$sDiscountId}', '".oxConfig::getInstance()->getBaseShopId()."', '1', 'Test', '5', '10', '0', 'itm', '10' )";

        oxDb::getDb()->Execute( $sQ );

        // assigning test discount
        $sQ = "insert into oxobject2discount ( oxid, oxdiscountid, oxobjectid, oxtype )
               values
               ( '_test".uniqid( rand(), true ).".', '{$sDiscountId}', 'product1', 'oxarticles' ),
               ( '_test".uniqid( rand(), true ).".', '{$sDiscountId}', 'product2', 'oxarticles' ),
               ( '_test".uniqid( rand(), true ).".', '{$sDiscountId}', 'product3', 'oxarticles' ) ";
        oxDb::getDb()->Execute( $sQ );

        $oParentProduct = $this->getMock( "oxArticle", array( "getProductParentId", "getProductId" ) );
        $oParentProduct->expects( $this->once() )->method( 'getProductParentId' )->will( $this->returnValue( false ) );
        $oParentProduct->expects( $this->once() )->method( 'getProductId' )->will( $this->returnValue( "product1" ) );

        $oProduct = $this->getMock( "oxArticle", array( "getProductParentId", "getProductId" ) );
        $oProduct->expects( $this->once() )->method( 'getProductParentId' )->will( $this->returnValue( "product1" ) );
        $oProduct->expects( $this->once() )->method( 'getProductId' )->will( $this->returnValue( "product4" ) );

        $oUnrelatedProduct = $this->getMock( "oxArticle", array( "getProductParentId", "getProductId" ) );
        $oUnrelatedProduct->expects( $this->once() )->method( 'getProductParentId' )->will( $this->returnValue( false ) );
        $oUnrelatedProduct->expects( $this->once() )->method( 'getProductId' )->will( $this->returnValue( "UnrelatedProductId" ) );

        // testing
        $oDiscount = new oxDiscount();
        $oDiscount->load( $sDiscountId );
        $this->assertTrue( $oDiscount->isForBundleItem( $oParentProduct ) );
        $this->assertTrue( $oDiscount->isForBundleItem( $oProduct ) );
        $this->assertFalse( $oDiscount->isForBundleItem( $oUnrelatedProduct ) );
    }
}