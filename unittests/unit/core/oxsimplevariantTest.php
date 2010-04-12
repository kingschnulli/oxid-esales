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
 * @version   SVN: $Id: oxsimplevariantTest.php 26841 2010-03-25 13:58:15Z arvydas $
 */

require_once realpath( "." ).'/unit/OxidTestCase.php';
require_once realpath( "." ).'/unit/test_config.inc.php';

class Unit_Core_oxsimpleVariantTest extends OxidTestCase
{
    /**
     * Tear down the fixture.
     *
     * @return null
     */
    protected function tearDown()
    {
        $this->cleanUpTable( 'oxdiscount' );
        oxTestModules::cleanAllModules();
        oxDiscountList::getInstance()->forceReload();
        parent::tearDown();
    }

    public function testGetBaseSeoLink()
    {
        oxTestModules::addFunction("oxSeoEncoderArticle", "getArticleUrl", "{return 'sArticleUrl';}");

        $oVariant = new oxSimpleVariant();
        $this->assertEquals( "sArticleUrl", $oVariant->getBaseSeoLink( 0 ) );
    }

    public function testGetLinkSeoOff()
    {
        oxTestModules::addFunction( "oxUtils", "seoIsActive", "{return false;}" );

        $oVariant = $this->getMock( "oxSimpleVariant", array( "getStdLink" ) );
        $oVariant->expects( $this->once() )->method( 'getStdLink')->will( $this->returnValue( 'sArticleUrl' ) );
        $this->assertEquals( "sArticleUrl", $oVariant->getLink() );
    }

    public function testSelectListGetter()
    {
        $oSimpleVar = new oxSimpleVariant();
        $this->assertNull( $oSimpleVar->aSelectlist );
    }

    public function testGetSelectLists()
    {
        $oSubj = new oxSimpleVariant();
        $this->assertNull($oSubj->getSelectLists());
    }

    public function testSetPrice()
    {
        $sPrice = "someString";
        $oSubj = new oxSimpleVariant();
        $oSubj->setPrice($sPrice);
        $this->assertEquals($sPrice, $oSubj->getPrice());
    }

    public function testGetPrice()
    {
        $oSubj = $this->getMock( 'oxSimpleVariant', array( '_applyParentVat', '_applyCurrency' ) );
        $oSubj->expects( $this->once() )->method( '_applyParentVat')->will( $this->returnValue( null ) );
        $oSubj->expects( $this->once() )->method( '_applyCurrency')->will( $this->returnValue( null ) );
        $oPrice = $oSubj->getPrice();
        $this->assertTrue($oPrice instanceof oxPrice);
    }

    public function testApplyParentVatNoParent()
    {
        $oSubj = $this->getMock("oxSimpleVariant", array( 'getParent' ));
        $oSubj->expects( $this->once() )->method( 'getParent')->will( $this->returnValue( null ) );

        $oPrice = new oxPrice();
        $oSubj->UNITapplyParentVat($oPrice);
    }

    public function testApplyParentVat()
    {
        $oPrice = new oxPrice();

        $oParent = $this->getMock( 'oxArticle', array( 'applyVats' ) );
        $oParent->expects( $this->once() )->method( 'applyVats')->will( $this->returnValue( null ) )->with( $oPrice );

        $oSubj = $this->getMock("oxSimpleVariant", array( 'getParent' ));
        $oSubj->expects( $this->once() )->method( 'getParent')->will( $this->returnValue( $oParent ) );

        $oSubj->UNITapplyParentVat($oPrice);
    }

    public function testGetPriceExisting()
    {
        $oSubj = $this->getProxyClass("oxSimpleVariant");
        $oSubj->setNonPublicVar("_oPrice", 10);
        $this->assertEquals(10, $oSubj->getPrice());
        $this->assertFalse($oPrice instanceof oxPrice);
    }

    public function testGetFPrice()
    {
        $oSubj = new oxSimpleVariant();
        $oSubj->getPrice()->setPrice(10, 10);
        $this->assertEquals("10,00", $oSubj->getFPrice());
    }

    public function testGetPriceWithDiscount()
    {
        oxDiscountList::getInstance()->forceReload();
        $oDiscount = oxNew('oxDiscount');
        $oDiscount->setId("_testDiscount");
        $oDiscount->oxdiscount__oxactive = new oxField(1, oxField::T_RAW);
        $oDiscount->oxdiscount__oxaddsum = new oxField(10, oxField::T_RAW);
        $oDiscount->oxdiscount__oxprice = new oxField(0, oxField::T_RAW);
        $oDiscount->oxdiscount__oxpriceto = new oxField(999, oxField::T_RAW);
        $oDiscount->oxdiscount__oxamount = new oxField(0, oxField::T_RAW);
        $oDiscount->oxdiscount__oxamountto = new oxField(999, oxField::T_RAW);
        $oDiscount->save();
        $oSubj = new oxSimpleVariant();
        $oSubj->oxarticles__oxprice = new oxField(10);
        $oParent = new oxArticle();
        $oParent->oxarticles__oxprice = new oxField(10);
        $oSubj->setParent($oParent);
        $this->assertEquals(9, $oSubj->getPrice()->getBruttoPrice());
        $this->cleanUpTable( 'oxdiscount' );
    }

    public function testGetPriceFromParent()
    {
        oxTestModules::addFunction( "oxarticle", "skipDiscounts", "{return true;}" );
        $oSubj = new oxSimpleVariant();
        $oParent = new oxArticle();
        $oParent->oxarticles__oxprice = new oxField(10);
        $oSubj->setParent($oParent);
        $this->assertEquals(10, $oSubj->getPrice()->getBruttoPrice());
    }

    public function testIsLazyLoaded()
    {
        $oSubj = $this->getProxyClass("oxSimpleVariant");
        $this->assertTrue($oSubj->getNonPublicVar("_blUseLazyLoading"));
    }

    public function testSetParent()
    {
        $oSubj = $this->getProxyClass("oxSimpleVariant");
        $oSubj->setParent("testString");
        $this->assertEquals("testString", $oSubj->getNonPublicVar("_oParent"));
    }

    public function testGetParent()
    {
        $oSubj = new oxSimpleVariant();
        $oSubj->setParent(5);
        $this->assertEquals(5, $oSubj->getParent());
    }

    public function testGetParentPriceIsDerived()
    {
        $oSubj = $this->getProxyClass("oxSimpleVariant");
        $oParent = new oxArticle();
        $oParent->oxarticles__oxprice = new oxField(10);
        $oSubj->setParent($oParent);
        $this->assertEquals(10, $oSubj->UNITgetParentPrice());
    }

    public function testGetParentPriceIsZero()
    {
        $oSubj = $this->getProxyClass("oxSimpleVariant");
        $this->assertTrue(0 === $oSubj->UNITgetParentPrice());
    }

    public function testApplyCurrency()
    {
        $oSubj = $this->getProxyClass("oxSimpleVariant");
        $oCur = new StdClass;
        $oCur->rate = 2;
        oxConfig::getInstance()->setActShopCurrency(2);
        $oPrice = oxNew( 'oxPrice' );
        $oPrice->setPrice(100 );
        $oSubj->UNITapplyCurrency( $oPrice );
        $this->assertEquals( 147, $oPrice->getBruttoPrice());
        oxConfig::getInstance()->setActShopCurrency(0);
    }

    public function testApplyCurrencyIfObjSet()
    {
        $oSubj = $this->getProxyClass("oxSimpleVariant");
        $oCur = new StdClass;
        $oCur->rate = 0.68;
        $oPrice = oxNew( 'oxPrice' );
        $oPrice->setPrice(100 );
        $oSubj->UNITapplyCurrency( $oPrice, $oCur );
        $this->assertEquals( 68, $oPrice->getBruttoPrice());
    }

    public function testGetLinkType()
    {
        $oParent = $this->getMock( 'oxArticle', array( 'getLinkType' ) );
        $oParent->expects( $this->once() )->method( 'getLinkType')->will( $this->returnValue( 1 ) );

        $oSubj = $this->getProxyClass("oxSimpleVariant");
        $oSubj->setParent( $oParent );

        $this->assertEquals( 1, $oSubj->getLinkType() );
    }

    public function testInCategory()
    {
        $sCatId = "123";
        $oParent = $this->getMock( 'oxArticle', array( 'inCategory' ) );
        $oParent->expects( $this->once() )->method( 'inCategory' )->with( $this->equalTo($sCatId) )->will( $this->returnValue( true ) );

        $oSubj = $this->getProxyClass("oxSimpleVariant");
        $oSubj->setParent( $oParent );

        $this->assertTrue( $oSubj->inCategory( $sCatId ) );
    }

    public function testInPriceCategory()
    {
        $sCatId = "123";
        $oParent = $this->getMock( 'oxArticle', array( 'inPriceCategory' ) );
        $oParent->expects( $this->once() )->method( 'inPriceCategory' )->with( $this->equalTo($sCatId) )->will( $this->returnValue( true ) );

        $oSubj = $this->getProxyClass("oxSimpleVariant");
        $oSubj->setParent( $oParent );

        $this->assertTrue( $oSubj->inPriceCategory( $sCatId ) );
    }

  /*  public function testGetStdLink()
    {
        $oSubj = $this->getProxyClass("oxSimpleVariant");
        $oSubj->setId( "1126" );

        $this->assertEquals( oxConfig::getInstance()->getShopHomeURL()."cl=details&amp;anid=1126", $oSubj->getStdLink() );
    }

    public function testGetLinkType_withoutParent()
    {
        $oSubj = $this->getProxyClass("oxSimpleVariant");
        $oSubj->setParent( null );

        $this->assertEquals( 0, $oSubj->getLinkType() );
    }

    public function testGetLink()
    {
        $oSubj = $this->getProxyClass("oxSimpleVariant");
        $oSubj->setId( "1126" );

        $sLink = oxConfig::getInstance()->getShopUrl()."Geschenke/Bar-Equipment/Bar-Set-ABSINTH.html";


        $this->assertEquals( $sLink, $oSubj->getLink() );
    }

    public function testGetLink_inOtherLang()
    {
        $oSubj = $this->getProxyClass("oxSimpleVariant");
        $oSubj->setId( "1126" );

        $sLink = oxConfig::getInstance()->getShopUrl()."en/Gifts/Bar-Equipment/Bar-Set-ABSINTH.html";


        $this->assertEquals( $sLink, $oSubj->getLink(1) );
    }*/

}