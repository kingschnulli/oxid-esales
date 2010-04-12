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
 * @version   SVN: $Id: oxbasketTest.php 26841 2010-03-25 13:58:15Z arvydas $
 */

require_once realpath( "." ).'/unit/OxidTestCase.php';
require_once realpath( "." ).'/unit/test_config.inc.php';

class modForTestAddBundles extends oxbasket
{
    public function setBasket( $aBasket )
    {
        $this->_aBasketContents = $aBasket;
    }
    public function getVar( $sVarName )
    {
        return $this->{'_'.$sVarName};
    }
    public function setVar( $sName, $sValue )
    {
        $this->{'_'.$sName} = $sValue;
    }
}

class modForTestAddVouchers extends oxvoucher
{
    public static $blCheckWasPerformed = false;

    public function checkVoucherAvailability( $aVouchers, $dPrice )
    {
        self::$blCheckWasPerformed = true;
    }

    public function checkBasketVoucherAvailability( $aVouchers, $dPrice )
    {
        self::$blCheckWasPerformed = true;
    }

    public function checkUserAvailability( $oUser )
    {
        self::$blCheckWasPerformed = true;
    }

    public function markAsReserved(  )
    {
        self::$blCheckWasPerformed = true;
    }
}

class modOxDiscountList_oxbasket extends oxDiscountList
{
    public function getBasketDiscounts( $oBasket, $oUser = null )
    {
        $oDiscount2 = oxNew( "oxDiscount" );
        $oDiscount2->setId( '_testDiscountId2' );
        $oDiscount2->oxdiscount__oxtitle = new oxField('Test discount title 2', oxField::T_RAW);
        $oDiscount2->oxdiscount__oxaddsumtype = new oxField("%", oxField::T_RAW);
        $oDiscount2->oxdiscount__oxaddsum = new oxField(15, oxField::T_RAW);

        $aDiscounts[] = $oDiscount2;

        return $aDiscounts;
    }
}

class modOxArticle_oxbasket extends oxArticle
{
    public static function cleanSelList()
    {
        self::$_aSelList = array();
    }
}

class Unit_Core_oxbasketTest extends OxidTestCase
{
    public $oArticle = null;
    public $oSelList = null;
    public $aDiscounts = array();
    public $blPerfLoadSelectLists;

    /**
     * Initialize the fixture.
     *
     * @return null
     */
    protected function setUp()
    {
        parent::setUp();

        modConfig::getInstance()->setConfigParam( 'blPerfNoBasketSaving', true );

            $sId = '2077';
        $sNewId = oxUtilsObject::getInstance()->generateUId();

        oxTestModules::addFunction('oxarticle', 'getLink( $iLang = null, $blMain = false  )', '{return "htpp://link_for_article/".$this->getId();}');

        $this->oArticle = oxNew( 'oxarticle' );
        //$this->oArticle->disableLazyLoading();
        $this->oArticle->Load( $sId );

        // making copy
        $this->oArticle->setId( $sNewId );
        $this->oArticle->oxarticles__oxweight = new oxField(10, oxField::T_RAW);
        $this->oArticle->oxarticles__oxstock = new oxField(100, oxField::T_RAW);
        $this->oArticle->oxarticles__oxprice = new oxField(19, oxField::T_RAW);
        $this->oArticle->oxarticles__oxstockflag = new oxField(2, oxField::T_RAW);
        $this->oArticle->save();

        // making category
        $sCatId = oxUtilsObject::getInstance()->generateUId();
        $this->oCategory = oxNew( 'oxcategory' );
        $this->oCategory->setId( $sCatId );
        $this->oCategory->oxcategories__oxparentid = new oxField('oxrootid', oxField::T_RAW);
        $this->oCategory->oxcategories__oxrootid = new oxField($sCatId, oxField::T_RAW);
        $this->oCategory->oxcategories__oxactive = new oxField(1, oxField::T_RAW);
        $this->oCategory->oxcategories__oxshopid = new oxField(oxConfig::getInstance()->getShopId(), oxField::T_RAW);;
        $this->oCategory->oxcategories__oxtitle = new oxField('Test category 1', oxField::T_RAW);
        $this->oCategory->save();

        // assigning article to category
        $oArt2Cat = oxNew( "oxbase" );
        $oArt2Cat->init( "oxobject2category" );
        $oArt2Cat->oxobject2category__oxobjectid = new oxField($sNewId, oxField::T_RAW);
        $oArt2Cat->oxobject2category__oxcatnid = new oxField($sCatId, oxField::T_RAW);
        $oArt2Cat->save();

        // making select list
        $this->oSelList = oxNew( 'oxselectlist' );
        $this->oSelList->oxselectlist__oxshopid = new oxField(oxConfig::getInstance()->getShopId(), oxField::T_RAW);
        $this->oSelList->oxselectlist__oxshopincl = new oxField(oxConfig::getInstance()->getShopId(), oxField::T_RAW);
        $this->oSelList->oxselectlist__oxtitle = new oxField('Test title', oxField::T_RAW);
        $this->oSelList->oxselectlist__oxident = new oxField('Test ident', oxField::T_RAW);
        $this->oSelList->oxselectlist__oxvaldesc = new oxField('Test valdesc__@@', oxField::T_RAW);
        $this->oSelList->save();

        // assigning select list
        $oNewGroup = oxNew( "oxbase" );
        $oNewGroup->init( "oxobject2selectlist" );
        $oNewGroup->oxobject2selectlist__oxobjectid = new oxField($this->oArticle->getId(), oxField::T_RAW);
        $oNewGroup->oxobject2selectlist__oxselnid = new oxField($this->oSelList->getId(), oxField::T_RAW);
        $oNewGroup->oxobject2selectlist__oxsort = new oxField(0, oxField::T_RAW);
        $oNewGroup->save();

        // few discounts
        $this->aDiscounts[0] = oxNew( "oxbase" );
        $this->aDiscounts[0]->init( "oxdiscount" );
        $this->aDiscounts[0]->setId( 'testdiscount0' );
        $this->aDiscounts[0]->oxdiscount__oxshopid = new oxField(oxConfig::getInstance()->getShopId(), oxField::T_RAW);
        $this->aDiscounts[0]->oxdiscount__oxshopincl = new oxField(oxConfig::getInstance()->getShopId(), oxField::T_RAW);
        $this->aDiscounts[0]->oxdiscount__oxactive = new oxField(1, oxField::T_RAW);
        $this->aDiscounts[0]->oxdiscount__oxtitle = new oxField('Test discount 0', oxField::T_RAW);
        $this->aDiscounts[0]->oxdiscount__oxamount = new oxField(1, oxField::T_RAW);
        $this->aDiscounts[0]->oxdiscount__oxamountto = new oxField(99999, oxField::T_RAW);
        $this->aDiscounts[0]->oxdiscount__oxprice = new oxField(1, oxField::T_RAW);
        $this->aDiscounts[0]->oxdiscount__oxpriceto = new oxField(99999, oxField::T_RAW);
        $this->aDiscounts[0]->oxdiscount__oxaddsumtype = new oxField("itm", oxField::T_RAW);
        $this->aDiscounts[0]->oxdiscount__oxaddsum = new oxField(50, oxField::T_RAW);
        $this->aDiscounts[0]->oxdiscount__oxitmartid = new oxField('xxx', oxField::T_RAW);
        $this->aDiscounts[0]->oxdiscount__oxitmamount = new oxField(2, oxField::T_RAW);
        $this->aDiscounts[0]->oxdiscount__oxitmmultiple = new oxField(1, oxField::T_RAW);
        $this->aDiscounts[0]->save();

        $this->aDiscounts[1] = oxNew( "oxbase" );
        $this->aDiscounts[1]->init( "oxdiscount" );
        $this->aDiscounts[1]->setId( 'testdiscount1' );
        $this->aDiscounts[1]->oxdiscount__oxshopid = new oxField(oxConfig::getInstance()->getShopId(), oxField::T_RAW);
        $this->aDiscounts[1]->oxdiscount__oxshopincl = new oxField(oxConfig::getInstance()->getShopId(), oxField::T_RAW);
        $this->aDiscounts[1]->oxdiscount__oxactive = new oxField(1, oxField::T_RAW);
        $this->aDiscounts[1]->oxdiscount__oxtitle = new oxField('Test discount 1', oxField::T_RAW);
        $this->aDiscounts[1]->oxdiscount__oxamount = new oxField(1, oxField::T_RAW);
        $this->aDiscounts[1]->oxdiscount__oxamountto = new oxField(99999, oxField::T_RAW);
        $this->aDiscounts[1]->oxdiscount__oxprice = new oxField(1, oxField::T_RAW);
        $this->aDiscounts[1]->oxdiscount__oxpriceto = new oxField(99999, oxField::T_RAW);
        $this->aDiscounts[1]->oxdiscount__oxaddsumtype = new oxField("itm", oxField::T_RAW);
        $this->aDiscounts[1]->oxdiscount__oxaddsum = new oxField(50, oxField::T_RAW);
        $this->aDiscounts[1]->oxdiscount__oxitmartid = new oxField('xxx', oxField::T_RAW);
        $this->aDiscounts[1]->oxdiscount__oxitmamount = new oxField(2, oxField::T_RAW);
        $this->aDiscounts[1]->oxdiscount__oxitmmultiple = new oxField(1, oxField::T_RAW);
        $this->aDiscounts[1]->save();

        $this->aDiscounts[2] = oxNew( "oxbase" );
        $this->aDiscounts[2]->init( "oxdiscount" );
        $this->aDiscounts[2]->setId( 'testdiscount2' );
        $this->aDiscounts[2]->oxdiscount__oxshopid = new oxField(oxConfig::getInstance()->getShopId(), oxField::T_RAW);
        $this->aDiscounts[2]->oxdiscount__oxshopincl = new oxField(oxConfig::getInstance()->getShopId(), oxField::T_RAW);
        $this->aDiscounts[2]->oxdiscount__oxactive = new oxField(1, oxField::T_RAW);
        $this->aDiscounts[2]->oxdiscount__oxtitle = new oxField('Test discount 2', oxField::T_RAW);
        $this->aDiscounts[2]->oxdiscount__oxamount = new oxField(1, oxField::T_RAW);
        $this->aDiscounts[2]->oxdiscount__oxamountto = new oxField(99999, oxField::T_RAW);
        $this->aDiscounts[2]->oxdiscount__oxprice = new oxField(1, oxField::T_RAW);
        $this->aDiscounts[2]->oxdiscount__oxpriceto = new oxField(99999, oxField::T_RAW);
        $this->aDiscounts[2]->oxdiscount__oxaddsumtype = new oxField("itm", oxField::T_RAW);
        $this->aDiscounts[2]->oxdiscount__oxaddsum = new oxField(50, oxField::T_RAW);
        $this->aDiscounts[2]->oxdiscount__oxitmartid = new oxField('yyy', oxField::T_RAW);
        $this->aDiscounts[2]->oxdiscount__oxitmamount = new oxField(2, oxField::T_RAW);
        $this->aDiscounts[2]->oxdiscount__oxitmmultiple = new oxField(1, oxField::T_RAW);
        $this->aDiscounts[2]->save();

        // assigning discounts
        $oDisc2Art = oxNew( "oxbase" );
        $oDisc2Art->init( "oxobject2discount" );
        $oDisc2Art->setId("_dsci1");
        $oDisc2Art->oxobject2discount__oxdiscountid = new oxField($this->aDiscounts[0]->getId(), oxField::T_RAW);
        $oDisc2Art->oxobject2discount__oxobjectid = new oxField($sNewId, oxField::T_RAW);
        $oDisc2Art->oxobject2discount__oxtype = new oxField('oxarticles', oxField::T_RAW);
        $oDisc2Art->save();

        $oDisc2Art = oxNew( "oxbase" );
        $oDisc2Art->init( "oxobject2discount" );
        $oDisc2Art->setId("_dsci2");
        $oDisc2Art->oxobject2discount__oxdiscountid = new oxField($this->aDiscounts[1]->getId(), oxField::T_RAW);
        $oDisc2Art->oxobject2discount__oxobjectid = new oxField($sNewId, oxField::T_RAW);
        $oDisc2Art->oxobject2discount__oxtype = new oxField('oxarticles', oxField::T_RAW);
        $oDisc2Art->save();

        // adding variant for article
        $sNewVarId = oxUtilsObject::getInstance()->generateUId();
        $this->oVariant = oxNew( 'oxarticle' );
        $this->oVariant->disableLazyLoading();
        $this->oVariant->Load( $sNewId );
        $this->oVariant->setId( $sNewVarId );
        $this->oVariant->oxarticles__oxparentid = new oxField($sNewId, oxField::T_RAW);
        $this->oVariant->save();

        $this->oArticle = oxNew( 'oxarticle' );
        $this->oArticle->disableLazyLoading();
        $this->oArticle->Load( $sNewId );

        // inserting vouchers
        $this->oVoucherSerie = oxNew( 'oxvoucherserie' );
        $this->oVoucherSerie->oxvoucherseries__oxshopid = new oxField(oxConfig::getInstance()->getShopId(), oxField::T_RAW);
        $this->oVoucherSerie->oxvoucherseries__oxserienr = new oxField('_xxx', oxField::T_RAW);
        $this->oVoucherSerie->oxvoucherseries__oxdiscount = new oxField(10.00, oxField::T_RAW);
        $this->oVoucherSerie->oxvoucherseries__oxdiscounttype = new oxField('absolute', oxField::T_RAW);
        $this->oVoucherSerie->oxvoucherseries__oxallowsameseries = new oxField(1, oxField::T_RAW);
        $this->oVoucherSerie->oxvoucherseries__oxallowotherseries = new oxField(1, oxField::T_RAW);
        $this->oVoucherSerie->oxvoucherseries__oxallowuseanother = new oxField(1, oxField::T_RAW);
        $this->oVoucherSerie->oxvoucherseries__oxminimumvalue = new oxField(10.00, oxField::T_RAW);
        $this->oVoucherSerie->save();

        for ($i=0; $i<4; $i++) {
            $oVoucher = oxNew( 'oxvoucher' );
            $oVoucher->oxvouchers__oxreserved = new oxField(0, oxField::T_RAW);
            $oVoucher->oxvouchers__oxvouchernr = new oxField(md5( uniqid( rand(), true ) ), oxField::T_RAW);
            $oVoucher->oxvouchers__oxvoucherserieid = new oxField($this->oVoucherSerie->getId(), oxField::T_RAW);
            $oVoucher->save();
            $this->aVouchers[$oVoucher->oxvouchers__oxvouchernr->value] = $oVoucher;
        }

        // creating delivery address
        $this->oDelAdress = oxNew( 'oxbase' );
        $this->oDelAdress->Init( 'oxaddress' );
        $this->oDelAdress->oxaddress__oxcountryid = new oxField('_xxx', oxField::T_RAW);
        $this->oDelAdress->save();

        // creating card
        $this->oCard = oxNew( 'oxwrapping' );
        $this->oCard->oxwrapping__oxtype = new oxField("CARD", oxField::T_RAW);
        $this->oCard->oxwrapping__oxname = new oxField("Test card", oxField::T_RAW);
        $this->oCard->oxwrapping__oxprice = new oxField(10, oxField::T_RAW);
        $this->oCard->save();

        // creating wrap paper
        $this->oWrap = oxNew( 'oxwrapping' );
        $this->oWrap->oxwrapping__oxtype = new oxField("WRAP", oxField::T_RAW);
        $this->oWrap->oxwrapping__oxname = new oxField("Test card", oxField::T_RAW);
        $this->oWrap->oxwrapping__oxprice = new oxField(5, oxField::T_RAW);
        $this->oWrap->save();

        // enabling stock control
        modConfig::getInstance()->setConfigParam( 'blUseStock', true );
        modConfig::getInstance()->setConfigParam( 'blVariantParentBuyable', true );

        oxDiscountList::getInstance()->forceReload();

        $sName = $this->getName();
        if ( $sName == 'testBasketCalculationWithSpecUseCaseDescribedAbove' ||
             $sName == 'testBasketCalculationWithSpecUseCaseDescribedAboveJustDiscountIsAppliedByPrice' ||
             $sName == 'testUpdateBasketTwoProductsWithSameSelectionList' ) {
            $this->_prepareDataForTestBasketCalculationWithSpecUseCaseDescribedAbove();
        }

        $this->blPerfLoadSelectLists = oxConfig::getInstance()->getConfigParam( 'bl_perfLoadSelectLists' );
    }

    /**
     * Tear down the fixture.
     *
     * @return null
     */
    protected function tearDown()
    {
        oxRemClassModule( 'modOxDiscountList_oxbasket' );

        // deleting articles+variants
        if ($this->oArticle) {
            $this->oArticle->delete();
            $this->oArticle = null;
        }

        // deleting category
        if ($this->oCategory) {
            $this->oCategory->delete();
            $this->oCategory = null;
        }

        // deleting selection lists
        if ($this->oSelList) {
            $this->oSelList->delete();
            $this->oSelList = null;
        }

        // deleting delivery address info
        if ($this->oDelAdress) {
            $this->oDelAdress->delete();
            $this->oDelAdress = null;
        }

        // deleting demo wrapping
        if ($this->oCard) {
            $this->oCard->delete();
            $this->oCard = null;
        }

        if ($this->oWrap) {
            $this->oWrap->delete();
            $this->oWrap = null;
        }

        // deleting vouchers
        if ($this->aVouchers) {
            foreach ( $this->aVouchers as $oVoucher ) {
                $oVoucher->delete();
            }
            $this->aVouchers = null;
        }

        if ($this->oVoucherSerie) {
            $this->oVoucherSerie->delete();
            $this->oVoucherSerie = null;
        }

        // deleting discounts
        if ($this->aDiscounts) {
            foreach ( $this->aDiscounts as $oDiscount ) {
                $oDiscount->delete();
            }
            $this->aDiscounts = null;
        }

        $this->oVariant = null;

            oxDb::getDb()->execute( 'delete from oxuserbaskets' );
            oxDb::getDb()->execute( 'delete from oxuserbasketitems' );
        $sName = $this->getName();
        if ( $sName == 'testBasketCalculationWithSpecUseCaseDescribedAbove' ||
             $sName == 'testBasketCalculationWithSpecUseCaseDescribedAboveJustDiscountIsAppliedByPrice' ||
             $sName == 'testUpdateBasketTwoProductsWithSameSelectionList' ) {
            $this->_cleanupDataAfterTestBasketCalculationWithSpecUseCaseDescribedAbove();
        }

        $this->cleanUpTable( 'oxdiscount' );
        $this->cleanUpTable( 'oxarticles' );
        $this->cleanUpTable( 'oxartextends' );
        $this->cleanUpTable( 'oxseo', 'oxobjectid' );
        $this->cleanUpTable( 'oxprice2article' );
        $this->cleanUpTable( 'oxobject2discount' );

        modOxArticle_oxbasket::cleanSelList();
        oxConfig::getInstance()->setConfigParam( 'bl_perfLoadSelectLists', $this->blPerfLoadSelectLists );
        parent::tearDown();
    }

    protected function _prepareDataForTestBasketCalculationWithSpecUseCaseDescribedAbove()
    {
        $sArtId = '1126';
            $sCatId = '8a142c3e4143562a5.46426637';

        // creating select lists..
        $oSelList = new oxSelectlist;
        $oSelList->setId( '_testoxsellist' );
        $oSelList->oxselectlist__oxtitle   = new oxfield( 'testsel' );
        $oSelList->oxselectlist__oxvaldesc = new oxfield( 'Large__@@Medium__@@Small__@@' );
        $oSelList->save();

        // assigning sel list
        $oO2Sel = new oxbase;
        $oO2Sel->init( "oxobject2selectlist" );
        $oO2Sel->setId( '_testoxobject2selectlist' );
        $oO2Sel->oxobject2selectlist__oxobjectid = new oxfield( $sArtId );
        $oO2Sel->oxobject2selectlist__oxselnid   = new oxfield( $oSelList->getId() );
        $oO2Sel->save();

        // creating discount
        $oDiscount = new oxdiscount();
        $oDiscount->setId( '_testoxdiscount' );
        $oDiscount->oxdiscount__oxactive = new oxfield( 1 );
        $oDiscount->oxdiscount__oxtitle  = new oxfield( 'testdisc' );
        $oDiscount->oxdiscount__oxamount = new oxfield( 3 );
        $oDiscount->oxdiscount__oxamountto = new oxfield( 99999 );
        $oDiscount->oxdiscount__oxaddsumtype = new oxfield( '%' );
        $oDiscount->oxdiscount__oxaddsum = new oxfield( '50' );
        $oDiscount->save();

        // creating discount
        $oDiscount2 = new oxdiscount();
        $oDiscount2->setId( '_testoxdiscount2' );
        $oDiscount2->oxdiscount__oxactive = new oxfield( 0 );
        $oDiscount2->oxdiscount__oxtitle  = new oxfield( 'testdisc' );
        $oDiscount2->oxdiscount__oxprice = new oxfield( 69 );
        $oDiscount2->oxdiscount__oxpriceto = new oxfield( 99999 );
        $oDiscount2->oxdiscount__oxaddsumtype = new oxfield( '%' );
        $oDiscount2->oxdiscount__oxaddsum = new oxfield( '50' );
        $oDiscount2->save();

        // assigning to category..
        $oO2D = new oxbase;
        $oO2D->init( 'oxobject2discount' );
        $oO2D->setId( '_testoxobject2discount' );
        $oO2D->oxobject2discount__oxdiscountid = new oxfield( $oDiscount->getId() );
        $oO2D->oxobject2discount__oxobjectid   = new oxfield( $sCatId );
        $oO2D->oxobject2discount__oxtype       = new oxfield( 'oxcategories' );
        $oO2D->save();

        $oO2D = new oxbase;
        $oO2D->init( 'oxobject2discount' );
        $oO2D->setId( '_testoxobject2discount' );
        $oO2D->oxobject2discount__oxdiscountid = new oxfield( $oDiscount2->getId() );
        $oO2D->oxobject2discount__oxobjectid   = new oxfield( $sCatId );
        $oO2D->oxobject2discount__oxtype       = new oxfield( 'oxcategories' );
        $oO2D->save();

        // assigning article to category
        $oO2C = new oxbase;
        $oO2C->init( 'oxobject2category' );
        $oO2C->setId( '_testoxobject2category' );
        $oO2C->oxobject2category__oxobjectid = new oxfield( $sArtId );
        $oO2C->oxobject2category__oxcatnid   = new oxfield( $sCatId );
        $oO2C->save();
    }

    protected function _cleanupDataAfterTestBasketCalculationWithSpecUseCaseDescribedAbove()
    {
        $this->cleanUpTable( 'oxselectlist' );
        $this->cleanUpTable( 'oxobject2selectlist' );
        $this->cleanUpTable( 'oxdiscount' );
        $this->cleanUpTable( 'oxobject2discount' );
        $this->cleanUpTable( 'oxobject2category' );
    }

    /**
     * #0001456: Discount validity is wrong if article in basket has Scale Prices
     *
     * @return null
     */
    public function testForBugEntry1456()
    {
        // cleaning up
        $this->tearDown();

        $sShopId = oxConfig::getInstance()->getBaseShopId();

        // create new discount, set Purchase Price From 12 To 24.99 and Discount -3 abs
        $oDiscount = new oxDiscount();
        $oDiscount->setId( '_testDiscount' );
        $oDiscount->oxdiscount__oxshopid     = new oxField( $sShopId );
        $oDiscount->oxdiscount__oxactive     = new oxField( 1 );
        $oDiscount->oxdiscount__oxtitle      = new oxField( "new discount" );
        $oDiscount->oxdiscount__oxprice      = new oxField( 12 );
        $oDiscount->oxdiscount__oxpriceto    = new oxField( 24.99 );
        $oDiscount->oxdiscount__oxaddsumtype = new oxField( "abs" );
        $oDiscount->oxdiscount__oxaddsum     = new oxField( 3 );
        $oDiscount->save();

        // create testarticle with price 12.95
        $oProduct = new oxArticle();
        $oProduct->setId( '_testProduct' );
        $oProduct->oxarticles__oxshopid = new oxField( $sShopId );
        $oProduct->oxarticles__oxactive = new oxField( 1 );
        $oProduct->oxarticles__oxtitle  = new oxField( "testarticle" );
        $oProduct->oxarticles__oxprice  = new oxField( 12.95 );
        $oProduct->save();

        // assign scale price Amount 2-2 Price 11.95
        $oPrice2Prod = new oxBase();
        $oPrice2Prod->init( "oxprice2article" );
        $oPrice2Prod->setId( '_testPrice2article' );
        $oPrice2Prod->oxprice2article__oxshopid   = new oxField( $sShopId );
        $oPrice2Prod->oxprice2article__oxartid    = new oxField( $oProduct->getId() );
        $oPrice2Prod->oxprice2article__oxaddabs   = new oxField( 11.95 );
        $oPrice2Prod->oxprice2article__oxamount   = new oxField( 2 );
        $oPrice2Prod->oxprice2article__oxamountto = new oxField( 2 );
        $oPrice2Prod->save();

        // Add the created article with the amount of 1 to the basket and then open the basket. You will see the assinged discount.
        $oBasket = new oxBasket();
        /*$oBasket->addToBasket( $oProduct->getId(), 1 );
        $oBasket->calculateBasket();

        $aDiscounts = $oBasket->getDiscounts();
        $this->assertEquals( 1, count( $aDiscounts ) );

        $oDiscount = current( $aDiscounts );
        $this->assertNotNull( $oDiscount );
        $this->assertEquals( 3, $oDiscount->dDiscount );*/

        // Now change the amount of the Article to 2. The discount got invalid, but it should be valid, since 2 * 11.95 are not bigger than 24.99
        $oBasket->addToBasket( $oProduct->getId(), 1);//, null, null, true );
        $oBasket->calculateBasket();

        $aDiscounts = $oBasket->getDiscounts();
        $this->assertEquals( 1, count( $aDiscounts ) );

        $oDiscount = current( $aDiscounts );
        $this->assertNotNull( $oDiscount );
        $this->assertEquals( 3, $oDiscount->dDiscount );
    }

    public function testGetDiscountedProductsBruttoPrice()
    {
        $oProdPrice = new oxPrice( 1199 );
        $oProdPrice->setBruttoPriceMode();

        $oProdPriceList = new oxPriceList();
        $oProdPriceList->addToPriceList( $oProdPrice );

        $oTotalDiscount = new oxPrice( 100 );
        $oTotalDiscount->setBruttoPriceMode();

        $oVoucherDiscount = new oxPrice( 100 );
        $oVoucherDiscount->setBruttoPriceMode();

        $oBasket = $this->getMock( "oxbasket", array( "getDiscountProductsPrice", "getTotalDiscount", "getVoucherDiscount" ) );
        $oBasket->expects( $this->once() )->method( 'getDiscountProductsPrice')->will( $this->returnValue( $oProdPriceList ) );
        $oBasket->expects( $this->once() )->method( 'getTotalDiscount')->will( $this->returnValue( $oTotalDiscount ) );
        $oBasket->expects( $this->once() )->method( 'getVoucherDiscount')->will( $this->returnValue( $oVoucherDiscount ) );

        $this->assertEquals( 999, $oBasket->getDiscountedProductsBruttoPrice() );
    }

    public function testIsBelowMinOrderPriceEmptyBasket()
    {
        modConfig::getInstance()->setConfigParam( "iMinOrderPrice", 2 );

        $oBasket = $this->getMock( "oxbasket", array( "getProductsCount", "getDiscountedProductsBruttoPrice" ) );
        $oBasket->expects( $this->once() )->method( 'getProductsCount')->will( $this->returnValue( 0 ) );
        $oBasket->expects( $this->never() )->method( 'getDiscountedProductsBruttoPrice');

        $this->assertFalse( $oBasket->isBelowMinOrderPrice() );
    }

    public function testIsBelowMinOrderPrice()
    {
        modConfig::getInstance()->setConfigParam( "iMinOrderPrice", 2 );

        $oBasket = $this->getMock( "oxbasket", array( "getProductsCount", "getDiscountedProductsBruttoPrice" ) );
        $oBasket->expects( $this->once() )->method( 'getProductsCount')->will( $this->returnValue( 1 ) );
        $oBasket->expects( $this->once() )->method( 'getDiscountedProductsBruttoPrice')->will( $this->returnValue( 1 ) );

        $this->assertTrue( $oBasket->isBelowMinOrderPrice() );
    }

    public function testUpdateBasketTwoProductsWithSameSelectionList()
    {
        $sArtId = '1126';
        $oBasket = new oxBasket();

        // creating selection list
        $oSelList = new oxSelectlist;
        $oSelList->setId( '_testoxsellist' );
        $oSelList->oxselectlist__oxtitle   = new oxfield( 'testsel' );
        $oSelList->oxselectlist__oxvaldesc = new oxfield( 'Large__@@Medium__@@Small__@@' );
        $oSelList->save();

        // assigning sel list
        $oO2Sel = new oxbase;
        $oO2Sel->init( "oxobject2selectlist" );
        $oO2Sel->setId( '_testoxobject2selectlist' );
        $oO2Sel->oxobject2selectlist__oxobjectid = new oxfield( $sArtId );
        $oO2Sel->oxobject2selectlist__oxselnid   = new oxfield( $oSelList->getId() );
        $oO2Sel->save();

        // storing products to basket with diff sel list
        $oBasket->addToBasket( $sArtId, 1, array( 0 ) );
        $oBasket->calculateBasket();

        $oBasket->addToBasket( $sArtId, 1, array( 1 ) );
        $oBasket->calculateBasket();

        // checking amounts
        $aContents = $oBasket->getContents();
        $this->assertEquals( 2, count( $aContents ) );

        // checking counts
        $oBasketItem = reset( $aContents );
        $this->assertEquals( 1, $oBasketItem->getAmount() );

        next( $aContents );

        // updating last product selection list
        $oBasket->addToBasket( $sArtId, 1, array( 0 ), null, true, false, key( $aContents ) );
        $oBasket->calculateBasket();

        // checking final basket amount
        $aContents = $oBasket->getContents();
        $this->assertEquals( 1, count( $aContents ) );

        // checking counts
        $oBasketItem = reset( $aContents );
        $this->assertEquals( 2, $oBasketItem->getAmount() );
    }

    public function testSetDiscountCalcModeAndCanCalcDiscounts()
    {
        $oBasket = new oxbasket();
        $oBasket->setDiscountCalcMode( false ) ;
        $this->assertFalse( $oBasket->canCalcDiscounts() );

        $oBasket->setDiscountCalcMode( true ) ;
        $this->assertTrue( $oBasket->canCalcDiscounts() );
    }

    public function testSetVoucherDiscount()
    {
        $dDiscount = 9;
        $oDiscountPrice = oxNew( 'oxPrice' );
        $oDiscountPrice->setBruttoPriceMode();
        $oDiscountPrice->add( $dDiscount );

        $oBasket = new oxbasket();
        $oBasket->setVoucherDiscount( $dDiscount );

        $this->assertEquals( $oDiscountPrice, $oBasket->getVoucherDiscount());
    }

    public function testAddOrderArticleToBasketAmountIsZero()
    {
        $oOrderAtrticle = new oxOrderArticle();
        $oOrderAtrticle->oxorderarticles__oxamount = new oxField( 0 );

        $oBasket = new oxbasket();
        $this->assertNull( $oBasket->addOrderArticleToBasket( $oOrderArticle ) );
    }

    public function testAddOrderArticleToBasket()
    {
        $oOrderArticle = new oxOrderArticle();
        $oOrderArticle->setId( "sOrderArticleId" );
        $oOrderArticle->oxorderarticles__oxamount = new oxField( 10 );
        $oOrderArticle->oxorderarticles__oxwrapid = new oxField( "swrapid" );

        $oTestBasketItem = new oxBasketItem();
        $oTestBasketItem->initFromOrderArticle( $oOrderArticle );
        $oTestBasketItem->setWrapping( "swrapid" );

        $oBasket = $this->getProxyClass( "oxbasket" );
        $oBasketItem = $oBasket->addOrderArticleToBasket( $oOrderArticle );
        $aBasketContents = $oBasket->getNonPublicVar( "_aBasketContents" );

        $this->assertEquals( $oTestBasketItem, $oBasketItem );
        $this->assertTrue( isset( $aBasketContents["sOrderArticleId"] ) );
        $this->assertEquals( $oTestBasketItem, $aBasketContents["sOrderArticleId"] );
    }

    public function testSetTotalDiscount()
    {
        $oDiscount = oxNew( 'oxPrice' );
        $oDiscount->setBruttoPriceMode();
        $oDiscount->add( 999 );

        $oBasket = $this->getProxyClass( "oxbasket" );
        $oBasket->setTotalDiscount( 999 );

        $this->assertEquals( $oDiscount, $oBasket->getNonPublicVar( "_oTotalDiscount" ) );
    }

    /**
     * Test for use case:
     *  - shop has select list with 3 options assigned to one article X
     *  - shop has discount assigned to category Y with amount restrictions ( 3 < discount < 999 )
     *  - article X is assigned to category Y
     *  - article X is stored to basket 3 times with different selection lists
     */
    public function testBasketCalculationWithSpecUseCaseDescribedAbove()
    {
        modConfig::getInstance()->setConfigParam( 'bl_perfLoadSelectLists', true );

        $sArtId = '1126';
            $sCatId = '8a142c3e4143562a5.46426637';

        $oBasket = new oxBasket();
        $oBasket->addToBasket( $sArtId, 1, array( 0 ) );
        $oBasket->addToBasket( $sArtId, 1, array( 1 ) );
        $oBasket->calculateBasket();

        // now checking discount..
        $this->assertEquals( 68, $oBasket->getPrice()->getBruttoPrice() );

        // adding one more article
        $oBasket->addToBasket( $sArtId, 1, array( 2 ) );
        $oBasket->calculateBasket();

        $this->assertEquals( 51, $oBasket->getPrice()->getBruttoPrice() );
    }
    public function testBasketCalculationWithSpecUseCaseDescribedAboveJustDiscountIsAppliedByPrice()
    {
        modConfig::getInstance()->setConfigParam( 'bl_perfLoadSelectLists', true );

        // disabling amount, enabling price discounts
        $oDiscount = new oxdiscount();
        $oDiscount->load( '_testoxdiscount' );
        $oDiscount->oxdiscount__oxactive = new oxfield( 0 );
        $oDiscount->save();

        $oDiscount2 = new oxdiscount();
        $oDiscount2->load( '_testoxdiscount2' );
        $oDiscount2->oxdiscount__oxactive = new oxfield( 1 );
        $oDiscount2->save();

        $sArtId = '1126';
            $sCatId = '8a142c3e4143562a5.46426637';

        $oBasket = new oxBasket();
        $oBasket->addToBasket( $sArtId, 1, array( 0 ) );
        $oBasket->addToBasket( $sArtId, 1, array( 1 ) );
        $oBasket->calculateBasket();

        // now checking discount..
        $this->assertEquals( 68, $oBasket->getPrice()->getBruttoPrice() );

        // adding one more article
        $oBasket->addToBasket( $sArtId, 1, array( 2 ) );
        $oBasket->calculateBasket();

        $this->assertEquals( 51, $oBasket->getPrice()->getBruttoPrice() );
    }

    public function testCanMergeBasketPe()
    {

        modConfig::getInstance()->setConfigParam( 'blPerfNoBasketSaving', false );

        $oBasket = $this->getMock( 'oxbasket', array( 'isAdmin' ) );
        $oBasket->expects( $this->once() )->method( 'isAdmin')->will( $this->returnValue( true ) );
        $this->assertFalse( $oBasket->UNITcanMergeBasket() );

        $oBasket = $this->getMock( 'oxbasket', array( 'isAdmin' ) );
        $oBasket->expects( $this->once() )->method( 'isAdmin')->will( $this->returnValue( false ) );
        $this->assertTrue( $oBasket->UNITcanMergeBasket() );
    }

    public function testBasketMergingOnPe()
    {

        modConfig::getInstance()->setConfigParam( 'blPerfNoBasketSaving', false );

        $oUser = new oxuser();
        $oUser->load( 'oxdefaultadmin' );

        $oBasket = new oxbasket();
        $oBasket->setBasketUser( $oUser );
        $oBasket->addToBasket( '1964', 2 );
        $oBasket->calculateBasket( true );

        $oBasket = new oxbasket();
        $oBasket->setBasketUser( $oUser );
        $oBasket->addToBasket( '1849', 2 );
        $oBasket->calculateBasket( true );

        $aContents = $oBasket->getContents();
        $this->assertEquals( 2, count( $aContents ) );
        $oItem = current( $aContents );
        $this->assertEquals( '1849', $oItem->getArticle()->getId() );
        $this->assertEquals( 2, $oItem->getAmount() );

        $oItem = next( $aContents );
        $this->assertEquals( '1964', $oItem->getArticle()->getId() );
        $this->assertEquals( 2, $oItem->getAmount() );
    }

    public function testBasketRestoringMergedOnPe()
    {

        modConfig::getInstance()->setConfigParam( 'blPerfNoBasketSaving', false );

        $oUser = new oxuser();
        $oUser->load( 'oxdefaultadmin' );

        $oBasket = new oxbasket();
        $oBasket->setBasketUser( $oUser );
        $oBasket->addToBasket( '1964', 2 );
        $oBasket->calculateBasket( true );
        $oBasket->addToBasket( '1849', 2 );
        $oBasket->calculateBasket( true );

        $oBasket = new oxbasket();
        $oBasket->setBasketUser( $oUser );
        $oBasket->calculateBasket( true );

        $aContents = $oBasket->getContents();
        $this->assertEquals( 2, count( $aContents ) );
        $oItem = current( $aContents );
        $this->assertEquals( '1964', $oItem->getArticle()->getId() );
        $this->assertEquals( 2, $oItem->getAmount() );

        $oItem = next( $aContents );
        $this->assertEquals( '1849', $oItem->getArticle()->getId() );
        $this->assertEquals( 2, $oItem->getAmount() );

        $oBasket->addToBasket( '1964', 0, null, null, true );
        $oBasket->addToBasket( '1849', 0, null, null, true );
        $oBasket->calculateBasket( true );

        $aContents = $oBasket->getContents();
        $this->assertEquals( 0, count( $aContents ) );

        $oBasket = new oxbasket();
        $oBasket->setBasketUser( $oUser );
        $oBasket->calculateBasket( true );
        $aContents = $oBasket->getContents();
        $this->assertEquals( 0, count( $aContents ) );
    }

    public function testStockStatusGetterCheck()
    {
        $oBasket = $this->getMock( 'oxbasket', array( 'isEnabled', 'getStockCheckMode' ) );
        $oBasket->expects( $this->exactly( 2 ) )->method( 'isEnabled')->will( $this->returnValue( true ) );
        $oBasket->expects( $this->exactly( 2 ) )->method( 'getStockCheckMode');

        $oBasket->addToBasket( $this->oArticle->getId(), 10 );
        $oBasket->addToBasket( $this->oArticle->getId(), 10 );
    }

    public function testStockStatusSetterCheck()
    {
        $oBasket = new oxbasket();
        $oBasket->setStockCheckMode( false );
        $this->assertFalse( $oBasket->getStockCheckMode() );

        $oBasket->setStockCheckMode( true );
        $this->assertTrue( $oBasket->getStockCheckMode() );
    }

    /**
     * Testing basket articles getter
     */
    public function testGetBasketArticles()
    {
        modConfig::getInstance()->setConfigParam( 'bl_perfLoadSelectLists', true );

        $oBasket = new oxbasket();
        $oBasket->addToBasket( $this->oArticle->getId(), 10 );
        $oBasket->addToBasket( $this->oVariant->getId(), 10 );
        $aIds = array( $this->oArticle->getId(), $this->oVariant->getId() );

        $iSelArticleId = $this->oArticle->getId();
        $blSelFound = false;

        foreach ( $oBasket->getBasketArticles() as $oArticle ) {

            // selection list check
            if ( $iSelArticleId == $oArticle->getId() ) {
                $aSelectList = $oArticle->getDispSelList();
                $blSelFound = isset( $aSelectList );
            }

            $this->assertTrue( in_array( $oArticle->getId(), $aIds ) );
        }

        if ( !$blSelFound ) {
            $this->fail( 'missing selection list' );
        }
    }

    /**
     * #1115: Usability Problem during checkout with products without stock
     */
    public function testGetBasketArticlesIfArtIsOffline()
    {
        $oBasketItem = $this->getProxyClass( "oxbasketitem" );
        $oBasketItem->init( $this->oArticle->getId(), 1 );
        $oBasketItem->setNonPublicVar( "_oArticle", null );
        $oBasket = $this->getProxyClass( "oxbasket" );
        $oBasket->setNonPublicVar( "_aBasketContents", array($oBasketItem) );

        $this->oArticle->oxarticles__oxstock = new oxField(0, oxField::T_RAW);
        $this->oArticle->oxarticles__oxstockflag = new oxField(2, oxField::T_RAW);
        $this->oArticle->save();
        $this->assertEquals( 0, count($oBasket->getBasketArticles()));
    }

    /**
     * #1318: exception is thrown if product (not orderable if out of stock) goes out of stock during order process
     */
    public function testGetBasketArticlesIfArtIsNotBuyable()
    {
        $oBasketItem = $this->getProxyClass( "oxbasketitem" );
        $oBasketItem->init( $this->oArticle->getId(), 1 );
        $oBasketItem->setNonPublicVar( "_oArticle", null );
        $oBasket = $this->getProxyClass( "oxbasket" );
        $oBasket->setNonPublicVar( "_aBasketContents", array($oBasketItem) );

        $this->oArticle->oxarticles__oxstock = new oxField(0, oxField::T_RAW);
        $this->oArticle->oxarticles__oxstockflag = new oxField(3, oxField::T_RAW);
        $this->oArticle->save();
        $this->assertEquals( 0, count($oBasket->getBasketArticles()));
    }

    /**
     * Testing adding to basket process
     */
    // adding to basket is disabled, should return null after adding ...
    public function testAddToBasketDisabled()
    {
        $oBasket = $this->getMock( 'oxbasket', array( 'isEnabled' ) );
        $oBasket->expects( $this->once() )->method( 'isEnabled')->will( $this->returnValue( false ) );
        $this->assertNull( $oBasket->addToBasket( $this->oArticle->getId(), 10 ) );
    }
    // normally adding item to basket and testing if it was added
    public function testAddToBasketNormalArticle()
    {
        $oBasket = new oxbasket();
        $oBasketItem = $oBasket->addToBasket( $this->oArticle->getId(), 10 );
        $this->assertEquals( 10, $oBasketItem->getAmount() );
        $this->assertEquals( 100, $oBasketItem->getWeight() );
        $this->assertEquals( $this->oArticle->getId(), $oBasketItem->getProductId() );
    }

    // user wrote bad amount information
    public function testAddToBasketBadInput()
    {
        $oBasket = new oxbasket();
        try {
            $oBasket->addToBasket( $this->oArticle->getId(), 'xxx' );
        } catch ( oxArticleInputException $oExcp ) {
            return;
        }
        $this->fail( 'failed testing addToBasket' );
    }
    // user wrote bad amount information
    public function testAddToBasketOutOfStock()
    {
        $oBasket = new oxbasket();
        try {
            $oBasket->addToBasket( $this->oArticle->getId(), 666 );
        } catch ( oxOutOfStockException $oExcp ) {
            return;
        }
        $this->fail( 'failed testing addToBasket' );
    }
    // normally adding item to basket and testing if it was added
    public function testAddToBasketAddingTwiceAncCheckingAmounts()
    {
        $oBasket = new oxbasket();
        $oBasketItem = $oBasket->addToBasket( $this->oArticle->getId(), 10, null, null, false, true );
        $oBasketItem = $oBasket->addToBasket( $this->oArticle->getId(), 10, null, null, false, true );
        $this->assertEquals( 20, $oBasketItem->getAmount() );
        $this->assertEquals( 200, $oBasketItem->getWeight() );
        $this->assertEquals( $this->oArticle->getId(), $oBasketItem->getProductId() );
    }
    // normally adding item to basket and testing if it was added
    public function testAddToBasketAddingArticleWithSelectlist()
    {
        $oBasket = new oxbasket();
        $oBasketItem = $oBasket->addToBasket( $this->oArticle->getId(), 10, array('0'), null, false, true );
        $oBasketItem = $oBasket->addToBasket( $this->oArticle->getId(), 10, null, null, false, true );
        $this->assertEquals( 20, $oBasketItem->getAmount() );
        $this->assertEquals( 200, $oBasketItem->getWeight() );
        $this->assertEquals( $this->oArticle->getId(), $oBasketItem->getProductId() );
    }

    // removing item by setting amount 0
    public function testAddToBasketRemovingBySettingZero()
    {
        $oBasket = new oxbasket();
        $oBasket->addToBasket( $this->oArticle->getId(), 0, null, null );
        $this->assertEquals( 0, count( $oBasket->getBasketArticles() ) );
    }

    // PE. testing if item is stored in saved basket
    public function testAddToBasketSavingBasketHistory()
    {

        $oBasket = $this->getMock( 'oxbasket', array( '_addItemToSavedBasket' ) );
        $oBasket->expects( $this->once() )->method( '_addItemToSavedBasket');
        $oBasket->addToBasket( $this->oArticle->getId(), 10 );
    }

    /**
     * Testing item key generator
     */
    public function testGetItemKey()
    {
        $sKey = md5( '_xxx'.'|'.serialize( array( '_xxx' ) ).'|'.serialize( array( '_xxx' ) ).'|'.( int ) true . '|' . serialize( '_xxx' ));

        $oBasket = new oxbasket();
        $this->assertEquals( $sKey, $oBasket->getItemKey( '_xxx', array( '_xxx' ), array( '_xxx' ), true, '_xxx' ) );
    }

    /**
     * Testing item key generator if selectlist is null
     */
    public function testGetItemKeyIfSelListEmpty()
    {
        $sKey = md5( '_xxx'.'|'.serialize( array( '0' ) ).'|'.serialize( array( '_xxx' ) ).'|'.( int ) true . '|' . serialize( '_xxx' ));

        $oBasket = new oxbasket();
        $this->assertEquals( $sKey, $oBasket->getItemKey( '_xxx', null, array( '_xxx' ), true, '_xxx' ) );
    }

    /**
     * Testing if article removal from basket really works
     */
    public function testRemoveItem()
    {
        $oBasket = new oxbasket();
        $oItem = $oBasket->addToBasket( $this->oArticle->getId(), 10, null, null, false, true );
        $sKey  = key( $oBasket->getContents() );

        // testing if THIS item was added
        $this->assertEquals( $this->oArticle->getId(), $oItem->getProductId() );

        $oBasket->removeItem( $sKey );

        // testing if it was removed
        $this->assertEquals( array(), $oBasket->getContents() );
    }

    /**
     * Testing if bundle article removal from basket really works
     */
    public function testClearBundles()
    {
        $oBasket = new oxbasket();
        $oItem = $oBasket->addToBasket( $this->oArticle->getId(), 1 );
        $oBasket->addToBasket( $this->oArticle->getId(), 2, null, null, false, true );

        // first bundle is added separatelly
        $this->assertEquals( 2, count( $oBasket->getContents() ) );

        $oBasket->UNITclearBundles();

        // first bundle is added separatelly
        $oItem2 = $oBasket->getContents() ;
        $this->assertEquals( 1, count( $oItem2 ) );
        $this->assertEquals( $oItem, reset($oItem2) );
    }

    /**
     * Testing if article bundle information if collected fine (PE only)
     */
    // has no bundle article
    public function testGetArticleBundlesHasNoBundles()
    {

        $oBasket = new oxbasket();
        $oItem = $oBasket->addToBasket( $this->oArticle->getId(), 1, null, null, false, true );
        $this->assertEquals( array(), $oBasket->UNITgetArticleBundles( $oItem ) );
    }
    // has bundle article information (PE only)
    public function testGetArticleBundlesHasSomeBundle()
    {

        $this->oArticle->oxarticles__oxbundleid = new oxField('xxx', oxField::T_RAW);
        $this->oArticle->save();

        $oBasket = new oxbasket();
        $oItem = $oBasket->addToBasket( $this->oArticle->getId(), 1 );
        $this->assertEquals( array( 'xxx' => 1 ), $oBasket->UNITgetArticleBundles( $oItem ) );
    }

    /**
     * Testing how correctly bungle information is loaded
     */
    // basket item is bundle itself, so it does not load additional bundle information
    public function testGetItemBundlesItemIsBundle()
    {
        $oBasket = new oxbasket();
        $oItem = $oBasket->addToBasket( $this->oArticle->getId(), 1, null, null, false, true );
        $this->assertEquals( array(), $oBasket->UNITgetItemBundles( $oItem ) );
    }
    // basket item has no bundle assigned
    public function testGetItemBundlesItemHasNoBundles()
    {
        // deleting discounts
        foreach ( $this->aDiscounts as $oDiscount )
            $oDiscount->delete();

        $oBasket = new oxbasket();
        $oItem = $oBasket->addToBasket( $this->oArticle->getId(), 1 );
        $this->assertEquals( array(), $oBasket->UNITgetItemBundles( $oItem ) );
    }
    // basket item has some bundled items
    public function testGetItemBundlesItemHasBundles()
    {
        $aArray = array( 'xxx' => (double) 4 );

        $oBasket = new oxbasket();
        $oItem = $oBasket->addToBasket( $this->oArticle->getId(), 1 );
        $this->assertEquals( $aArray, $oBasket->UNITgetItemBundles( $oItem ) );
    }

    /**
     * Whole basket bundles
     */
    // has one bundle item
    public function testGetBasketBundlesHasBundledItem()
    {
        $aArray = array( 'yyy' => (double) 2 );

        $oBasket = new oxbasket();
        $oItem   = $oBasket->addToBasket( $this->oArticle->getId(), 1 );
        $this->assertEquals( $aArray, $oBasket->UNITgetBasketBundles( $oItem ) );
    }

    // has no bundle items
    public function testGetBasketBundlesHasNoBundledItem()
    {
        // deleting discounts
        foreach ( $this->aDiscounts as $oDiscount )
            $oDiscount->delete();

        $oBasket = new oxbasket();
        $oItem   = $oBasket->addToBasket( $this->oArticle->getId(), 1 );
        $this->assertEquals( array(), $oBasket->UNITgetBasketBundles( $oItem ) );
    }

    /**
     * Testing bundles adding method
     */
    public function testAddBundles()
    {

        // simulating basket contents
        $oBasketItem = new oxbasketitem();
        $oBasketItem->init( $this->oArticle->getId(), 1 );

        $oBasket = $this->getMock( 'modForTestAddBundles', array( '_getItemBundles',  'addToBasket', '_getBasketBundles' ) );
        $oBasket->expects( $this->once() )->method( '_getItemBundles' )->will( $this->returnValue( array( 'x' => 1 ) ) );
        $oBasket->expects( $this->exactly( 2 ) )->method( 'addToBasket' )->will( $this->returnValue( $oBasketItem ) );
        $oBasket->expects( $this->once() )->method( '_getBasketBundles' )->will( $this->returnValue( array( 'x' => 1 ) ) );

        // testing
        $oBasket->setBasket( array( $oBasketItem ) );
        modConfig::getInstance()->setConfigParam( 'blAllowUnevenAmounts', true );
        $oBasket->UNITaddBundles();
        $this->assertTrue($oBasketItem->isDiscountArticle() );
    }

    /**
     * #1115: Usability Problem during checkout with products without stock
     */
    public function testAddBundlesIfArtIsOffline()
    {
        // simulating basket contents
        $oBasketItem = $this->getMock( 'oxbasketitem', array( 'isBundle' ) );
        $oBasketItem->expects( $this->any() )->method( 'isBundle' )->will( $this->returnValue( true ) );
        $oBasketItem->init( $this->oArticle->getId(), 1 );

        $this->oArticle->oxarticles__oxstock = new oxField(0, oxField::T_RAW);
        $this->oArticle->oxarticles__oxstockflag = new oxField(2, oxField::T_RAW);
        $this->oArticle->save();
        $oBasket = $this->getMock( 'modForTestAddBundles', array( 'addToBasket' ) );
        $oBasket->expects( $this->never() )->method( 'addToBasket' )->will( $this->returnValue( $oBasketItem ) );

        // testing
        $oBasket->setBasket( array( $oBasketItem ) );
        modConfig::getInstance()->setConfigParam( 'blAllowUnevenAmounts', true );
        $oBasket->UNITaddBundles();
        $this->assertFalse($oBasketItem->isDiscountArticle() );
    }

    /**
     * #1318: exception is thrown if product (not orderable if out of stock) goes out of stock during order process
     */
    public function testAddBundlesIfArtIsNotBuyable()
    {
        // simulating basket contents
        $oBasketItem = $this->getMock( 'oxbasketitem', array( 'isBundle' ) );
        $oBasketItem->expects( $this->any() )->method( 'isBundle' )->will( $this->returnValue( true ) );
        $oBasketItem->init( $this->oArticle->getId(), 1 );

        $this->oArticle->oxarticles__oxstock = new oxField(0, oxField::T_RAW);
        $this->oArticle->oxarticles__oxstockflag = new oxField(3, oxField::T_RAW);
        $this->oArticle->save();
        $oBasket = $this->getMock( 'modForTestAddBundles', array( 'addToBasket' ) );
        $oBasket->expects( $this->never() )->method( 'addToBasket' )->will( $this->returnValue( $oBasketItem ) );

        // testing
        $oBasket->setBasket( array( $oBasketItem ) );
        modConfig::getInstance()->setConfigParam( 'blAllowUnevenAmounts', true );
        $oBasket->UNITaddBundles();
        $this->assertFalse($oBasketItem->isDiscountArticle() );
    }

    /**
     * Testing bundles adding method
     */
    public function testAddBundlesIfDiscountArticle()
    {
        // simulating basket contents
        $oBasketItem = $this->getMock( 'oxbasketitem', array( 'isDiscountArticle' ) );
        $oBasketItem->expects( $this->any() )->method( 'isDiscountArticle' )->will( $this->returnValue( true ) );
        $oBasketItem->init( $this->oArticle->getId(), 1 );

        $oBasket = $this->getMock( 'modForTestAddBundles', array( '_getItemBundles',  'addToBasket', '_getBasketBundles' ) );
        $oBasket->expects( $this->never() )->method( '_getItemBundles' );
        $oBasket->expects( $this->never() )->method( 'addToBasket' );
        $oBasket->expects( $this->once() )->method( '_getBasketBundles' );

        // testing
        $oBasket->setBasket( array( $oBasketItem ) );
        modConfig::getInstance()->setConfigParam( 'blAllowUnevenAmounts', true );
        $oBasket->UNITaddBundles();
    }

    /**
     * Testing item price calculator adding bundles
     */
    public function testCalcItemsPriceAddBundles()
    {
        $oBasket = new modForTestAddBundles();

        // simulating basket contents
        $oBasketItem = $this->getMock( 'oxbasketitem', array( 'isDiscountArticle', 'isBundle' ) );
        $oBasketItem->expects( $this->any() )->method( 'isDiscountArticle' )->will( $this->returnValue( true ) );
        $oBasketItem->expects( $this->any() )->method( 'isBundle' )->will( $this->returnValue( true ) );
        $oBasketItem->init( $this->oArticle->getId(), 1 );
        $oBasket->setBasket( array( $oBasketItem ) );
        $oBasket->UNITcalcItemsPrice();
        $aBasketContents = $oBasket->getVar( 'aBasketContents' );
        foreach ( $aBasketContents as $oBasketItem ) {
            $this->assertEquals( 0, $oBasketItem->getPrice()->getBruttoPrice() );
        }
    }

    /**
     * Testing item price calculator
     */
    public function testCalcItemsPrice()
    {
        // deleting discounts
        foreach ( $this->aDiscounts as $oDiscount )
            $oDiscount->delete();

        $oBasket = new modForTestAddBundles();
        $oBasket->addToBasket( $this->oArticle->getId(), 10 );
        $oBasket->UNITcalcItemsPrice();

        $this->assertEquals( 1, $oBasket->getVar( 'iProductsCnt' ) );
        $this->assertEquals( 10, $oBasket->getVar( 'dItemsCnt' ) );
        $this->assertEquals( 100, $oBasket->getVar( 'dWeight' ) );
    }

    /**
     * Testing baslet item price calculator also sets items discounts
     */
    public function testCalcItemsPriceSetsItemsDiscounts()
    {
        $this->aDiscounts[0]->oxdiscount__oxaddsumtype = new oxField("abs", oxField::T_RAW);
        $this->aDiscounts[0]->oxdiscount__oxaddsum = new oxField("5", oxField::T_RAW);
        $this->aDiscounts[0]->save();

        $this->aDiscounts[1]->oxdiscount__oxaddsumtype = new oxField("abs", oxField::T_RAW);
        $this->aDiscounts[1]->oxdiscount__oxaddsum = new oxField("7", oxField::T_RAW);
        $this->aDiscounts[1]->save();

        $oBasket = $this->getProxyClass( "oxBasket" );
        $oBasket->addToBasket( $this->oArticle->getId(), 1 );

        $oBasket->UNITcalcItemsPrice();

        $aDiscounts = $oBasket->getNonPublicVar( '_aItemDiscounts' );

        $this->assertEquals( 2, count($aDiscounts) );
        $this->assertEquals( 5, $aDiscounts['testdiscount0']->dDiscount );
        $this->assertEquals( 7, $aDiscounts['testdiscount1']->dDiscount );
    }

    /**
     * Testing baslet item price calculator also sets items discounts
     */
    public function testCalcItemsPriceSetsItemsDiscountsIfSkipDiscountIsOn()
    {
        $this->oArticle->oxarticles__oxskipdiscounts = new oxField(1, oxField::T_RAW);
        $this->oArticle->save();
        $this->aDiscounts[0]->oxdiscount__oxaddsumtype = new oxField("abs", oxField::T_RAW);
        $this->aDiscounts[0]->oxdiscount__oxaddsum = new oxField("5", oxField::T_RAW);
        $this->aDiscounts[0]->save();

        $this->aDiscounts[1]->oxdiscount__oxaddsumtype = new oxField("abs", oxField::T_RAW);
        $this->aDiscounts[1]->oxdiscount__oxaddsum = new oxField("7", oxField::T_RAW);
        $this->aDiscounts[1]->save();

        $oBasket = $this->getProxyClass( "oxBasket" );
        $oBasket->addToBasket( $this->oArticle->getId(), 1 );

        $oBasket->UNITcalcItemsPrice();

        $aDiscounts = $oBasket->getNonPublicVar( '_aItemDiscounts' );

        $this->assertEquals( 0, count($aDiscounts) );
        $this->assertTrue( $oBasket->hasSkipedDiscount() );
    }

    /**
     * Testing bascet item price calculation, if only two from three articles have discounts
     * #buglist_339
     */
    public function testCalculateBasketSetsItemsDiscounts()
    {
        $oDisc2Art = oxNew( "oxbase" );
        $oDisc2Art->init( "oxobject2discount" );
        $oDisc2Art->setId("_temp");
        $oDisc2Art->oxobject2discount__oxdiscountid = new oxField($this->aDiscounts[0]->getId(), oxField::T_RAW);
        $oDisc2Art->oxobject2discount__oxobjectid = new oxField('2000', oxField::T_RAW);
        $oDisc2Art->oxobject2discount__oxtype = new oxField('oxarticles', oxField::T_RAW);
        $oDisc2Art->save();

        $this->aDiscounts[0]->oxdiscount__oxaddsumtype = new oxField("abs", oxField::T_RAW);
        $this->aDiscounts[0]->oxdiscount__oxaddsum = new oxField("5", oxField::T_RAW);
        $this->aDiscounts[0]->save();
        $this->aDiscounts[1]->oxdiscount__oxactive = new oxField(0, oxField::T_RAW);
        $this->aDiscounts[1]->save();

        $this->oArticle->oxarticles__oxvat = new oxField(10, oxField::T_RAW);
        $this->oArticle->oxarticles__oxprice = new oxField(50, oxField::T_RAW);
        $this->oArticle->save();

        $oBasket = $this->getProxyClass( "oxBasket" );
        $oBasket->addToBasket( $this->oArticle->getId(), 2 );
        $oBasket->addToBasket( '2000', 1 );
        $oBasket->addToBasket( '1651', 1 );

        $oBasket->calculateBasket( false );

        $aVAT = $oBasket->getDiscountProductsPrice()->getVatInfo();
        $this->assertEquals(8.18, round($aVAT[10], 2));
            $this->assertEquals(8.46, round($aVAT[19], 2));
            $this->assertEquals(143, $oBasket->getDiscountProductsPrice()->getBruttoSum());
            $this->assertEquals(126.36, $oBasket->getDiscountedNettoPrice());
            $this->assertEquals(158, $oBasket->getProductsPrice()->getBruttoSum());

        $aItmList = $oBasket->getContents();
        foreach ($aItmList as $oItm) {
            $this->assertEquals($oItm->getArticle()->getPrice()->getBruttoPrice()*$oItm->getAmount(), $oItm->getPrice()->getBruttoPrice());
        }
    }

    /**
     * Testing basket item price calculation, if there is discount and bundles
     * #M320
     */
    public function testCalculateBasketSetDiscountsAndBundles()
    {
        $this->aDiscounts[0]->oxdiscount__oxaddsumtype = new oxField("abs", oxField::T_RAW);
        $this->aDiscounts[0]->oxdiscount__oxaddsum = new oxField("5", oxField::T_RAW);
        $this->aDiscounts[0]->save();
        $this->aDiscounts[1]->oxdiscount__oxitmartid = new oxField('2000', oxField::T_RAW);
        $this->aDiscounts[1]->save();

        $this->oArticle->oxarticles__oxvat = new oxField(10, oxField::T_RAW);
        $this->oArticle->oxarticles__oxprice = new oxField(60, oxField::T_RAW);
        $this->oArticle->save();

        $oBasket = $this->getProxyClass( "oxBasket" );
        $oBasket->addToBasket( $this->oArticle->getId(), 2 );

        $oBasket->calculateBasket( false );

        $aVAT = $oBasket->getDiscountProductsPrice()->getVatInfo();
        $this->assertEquals(10, round($aVAT[10], 2));
        $this->assertEquals(110, $oBasket->getDiscountProductsPrice()->getBruttoSum());
        $this->assertEquals(100, $oBasket->getDiscountedNettoPrice());
        $this->assertEquals(120, $oBasket->getProductsPrice()->getBruttoSum());

        $aItmList = $oBasket->getContents();
        $oArt1 = $aItmList[$oBasket->getItemKey($this->oArticle->getId())];
        $oArt2 = $aItmList[$oBasket->getItemKey('2000', null, null, true)];
        $this->assertEquals(120, $oArt1->getPrice()->getBruttoPrice());
        $this->assertEquals('120,00', $oArt1->getFTotalPrice());
        $this->assertEquals(0, $oArt2->getPrice()->getBruttoPrice());
        $this->assertEquals('0,00', $oArt2->getFTotalPrice());
    }

    public function testMergeDiscounts()
    {
        $oDiscount1 = new oxStdClass();
        $oDiscount1->dDiscount = 10;
        $oDiscount2 = new oxStdClass();
        $oDiscount2->dDiscount = 20;
        $oDiscount3 = new oxStdClass();
        $oDiscount3->dDiscount = 30;
        $oDiscount4 = new oxStdClass();
        $oDiscount4->dDiscount = 40;
        $aDiscounts = array();
        $aDiscounts['1'] = $oDiscount1;
        $aDiscounts['2'] = $oDiscount2;
        $aItemDiscounts['1'] = $oDiscount3;
        $oBasket = new oxbasket();
        $aReturn = $oBasket->UNITmergeDiscounts( $aDiscounts, $aItemDiscounts);
        $aDiscounts['1'] = $oDiscount4;
        $this->assertEquals( $aDiscounts, $aReturn);
    }

    /**
     * Testing delivery price calculation
     */
    // no user, blCalculateDelCostIfNotLoggedIn = false - no costs
    public function testCalcDeliveryCostNoUser()
    {
        modConfig::getInstance()->setConfigParam( 'blCalculateDelCostIfNotLoggedIn', false );

        $oBasket = new oxbasket();
        $oBasket->setBasketUser( false );
        $oBasket->addToBasket( $this->oArticle->getId(), 10 );
        $oPrice = $oBasket->UNITcalcDeliveryCost();

        $this->assertEquals( 0, $oPrice->getVat() );
        $this->assertEquals( 0, $oPrice->getBruttoPrice() );
        $this->assertEquals( 0, $oPrice->getNettoPrice() );
        $this->assertEquals( 0, $oPrice->getVatValue() );
        $this->assertEquals( 0, $oPrice->getVatValue() );
    }

    /**
     * Testing delivery price calculation
     */
    // for admin - should be some costs ...
    public function testCalcDeliveryCostAdminUser()
    {
        // deleting discounts to ignore bundle problems
        foreach ( $this->aDiscounts as $oDiscount )
            $oDiscount->delete();

        modConfig::getInstance()->setConfigParam( 'blCalculateDelCostIfNotLoggedIn', false );
        modConfig::getInstance()->setConfigParam( 'blCalcVATForDelivery', true );
        modConfig::getInstance()->setConfigParam( 'blEnterNetPrice', true );
        $oAdmin = new oxuser();
        $oAdmin->load( 'oxdefaultadmin' );

        $oBasket = new oxbasket();
        $oBasket->setBasketUser( $oAdmin );
        $oBasket->addToBasket( $this->oArticle->getId(), 1 );
        $oBasket->addToBasket( $this->oVariant->getId(), 2 );
        $oBasket->calculateBasket( false );


        $oPrice = $oBasket->getCosts( 'oxdelivery' );

        $this->assertEquals( 19, $oPrice->getVat() );
        $this->assertEquals( 3.9, $oPrice->getBruttoPrice() );
        $this->assertEquals( 3.9 / 1.19, $oPrice->getNettoPrice(), '', 0.0001 );
        $this->assertEquals( (3.9-3.9/1.19), $oPrice->getVatValue(), '', 0.0001 );
    }

    /**
     * Testing delivery price calculation
     */
    // if free shipped ...
    public function testCalcDeliveryCostFreeShipped()
    {
        // deleting discounts to ignore bundle problems
        foreach ( $this->aDiscounts as $oDiscount )
            $oDiscount->delete();

        modConfig::getInstance()->setConfigParam( 'blCalculateDelCostIfNotLoggedIn', false );
        modConfig::getInstance()->setConfigParam( 'blCalcVATForDelivery', true );
        modConfig::getInstance()->setConfigParam( 'blEnterNetPrice', true );

        $oAdmin = new oxuser();
        $oAdmin->load( 'oxdefaultadmin' );

        $oBasket = new oxbasket();
        $oBasket->setBasketUser( $oAdmin );
        $this->oArticle->oxarticles__oxfreeshipping = new oxField(true, oxField::T_RAW);
        $this->oArticle->save();
        $oBasket->addToBasket( $this->oArticle->getId(), 1 );
        $oBasket->calculateBasket( false );

        $oPrice = $oBasket->getCosts( 'oxdelivery' );

        $this->assertEquals( 0, $oPrice->getBruttoPrice() );
    }

    // if free shipped ...
    public function testSetAndCalcDeliveryCost()
    {
        // deleting discounts to ignore bundle problems
        foreach ( $this->aDiscounts as $oDiscount )
            $oDiscount->delete();

        modConfig::getInstance()->setConfigParam( 'blCalculateDelCostIfNotLoggedIn', false );
        modConfig::getInstance()->setConfigParam( 'blCalcVATForDelivery', true );
        modConfig::getInstance()->setConfigParam( 'blEnterNetPrice', true );

        $oSetPrice = oxNew( "oxprice" );
        $oSetPrice->setPrice(5);

        $oAdmin = new oxuser();
        $oAdmin->load( 'oxdefaultadmin' );

        $oBasket = new oxbasket();
        $oBasket->setBasketUser( $oAdmin );
        $this->oArticle->oxarticles__oxfreeshipping = new oxField(true, oxField::T_RAW);
        $this->oArticle->save();
        $oBasket->addToBasket( $this->oArticle->getId(), 1 );
        $oBasket->setDeliveryPrice($oSetPrice);
        $oBasket->calculateBasket( false );

        $oPrice = $oBasket->getCosts( 'oxdelivery' );

        $this->assertEquals( 5, $oPrice->getBruttoPrice() );
    }

    /**
     * Testing basket user setter/getter
     */
    public function testSetBasketUserAndGetBasketUserInOneTest()
    {
        $oUser = new Oxstdclass();
        $oUser->xxx = 'yyy';

        $oBasket = new oxbasket();
        $oBasket->setBasketUser( $oUser );

        $this->assertEquals( $oUser, $oBasket->getBasketUser() );
    }

    /**
     * Testing basket user setter/getter
     */
    public function testGetBasketUser()
    {
        $oUser = new Oxstdclass();
        $oUser->xxx = 'qqq';

        $oBasket = new oxbasket();
        $oBasket->setUser( $oUser );

        $this->assertEquals( $oUser, $oBasket->getBasketUser() );
    }


    public function testSetGetBasketUser()
    {
        $oSubj = new oxBasket();
        $oSubj->setBasketUser('testUser');
        $this->assertEquals('testUser', $oSubj->getBasketUser());
    }

    public function testGetBasketUserGlobal()
    {
        $oSubj = new oxBasket();
        $oSubj->setUser('testUser');
        $this->assertEquals('testUser', $oSubj->getBasketUser());
    }

    public function testGetBasketUserNonGlobal()
    {
        $oSubj = new oxBasket();
        $oSubj->setUser('testUser');
        $oSubj->setBasketUser('testLocalUser');
        $this->assertEquals('testLocalUser', $oSubj->getBasketUser());
    }

    /**
     * Testing most used VAT percent getter
     */
    public function testGetMostUsedVatPercent()
    {
        $oProductsPriceList = $this->getMock( 'oxpricelist', array( 'getMostUsedVatPercent' ) );
        $oProductsPriceList->expects( $this->once() )->method( 'getMostUsedVatPercent' );

        $oBasket = new modForTestAddBundles();
        $oBasket->setVar( 'oProductsPriceList', $oProductsPriceList );
        $oBasket->getMostUsedVatPercent();
    }

    /**
     * Testing total price calculator
     */
    // testing if all expected methods are executed
    public function testCalcTotalPrice()
    {
        $oDiscount = new oxdiscount();
        $oDiscount->dDiscount = 2;
        $aDiscount[] = $oDiscount;
        $oDiscount = new oxdiscount();
        $oDiscount->sType = 'itm';
        $oDiscount->dDiscount = 5;
        $aDiscount[] = $oDiscount;
        $oProductsPriceList = $this->getMock( 'oxpricelist', array( 'getBruttoSum' ) );
        $oProductsPriceList->expects( $this->once() )->method( 'getBruttoSum' )->will( $this->returnValue( 100 ) );

        $oPrice = $this->getMock( 'oxprice', array( 'setPrice', 'subtract', 'add' ) );
        $oPrice->expects( $this->once() )->method( 'setPrice' );
        $oPrice->expects( $this->exactly( 3 ) )->method( 'subtract' );
        $oPrice->expects( $this->exactly( 3 ) )->method( 'add' );

        $oBasket = new modForTestAddBundles();
        $oBasket->setVar( 'oProductsPriceList', $oProductsPriceList );
        $oBasket->setVar( 'oTotalDiscount', new oxprice );
        $oBasket->setVar( 'oVoucherDiscount', new oxprice );
        $oBasket->setVar( 'aItemDiscounts', $aDiscount );
        $oBasket->setVar( 'oPrice', $oPrice );
        $oBasket->setVar( 'aCosts', array( 'oxdelivery' => new oxprice, 'oxwrapping' => new oxprice, 'oxpayment' => new oxprice ) );

        $oBasket->UNITcalcTotalPrice();
    }

    /**
     * Testing total price calculator
     */
    // testing if all expected methods are executed
    public function testCalcTotalPriceIfArtPriceZero()
    {
        $oProductsPriceList = $this->getMock( 'oxpricelist', array( 'getBruttoSum' ) );
        $oProductsPriceList->expects( $this->once() )->method( 'getBruttoSum' )->will( $this->returnValue( 0 ) );

        $oPrice = $this->getMock( 'oxprice', array( 'setPrice', 'subtract', 'add' ) );
        $oPrice->expects( $this->once() )->method( 'setPrice' );
        $oPrice->expects( $this->never() )->method( 'subtract' );
        $oPrice->expects( $this->exactly( 3 ) )->method( 'add' );

        $oBasket = new modForTestAddBundles();
        $oBasket->setVar( 'oProductsPriceList', $oProductsPriceList );
        $oBasket->setVar( 'oTotalDiscount', new oxprice );
        $oBasket->setVar( 'oVoucherDiscount', new oxprice );
        $oBasket->setVar( 'oPrice', $oPrice );
        $oBasket->setVar( 'aCosts', array( 'oxdelivery' => new oxprice, 'oxwrapping' => new oxprice, 'oxpayment' => new oxprice ) );

        $oBasket->UNITcalcTotalPrice();
    }

    /**
     * Testing how voucher calculation works
     */
    public function testCalcVoucherDiscount()
    {
        $oPrice = oxNew( "oxPrice" );
        $oPrice->setPrice( 999 );
        $oPriceList = oxNew( "oxPriceList" );
        $oPriceList->addToPriceList( $oPrice );

        $oBasket = $this->getProxyClass( "oxBasket" );
        $oBasket->setNonPublicVar( '_oDiscountProductsPriceList', $oPriceList );
        $aV = array();
        foreach ($this->aVouchers as $oV) {
            $aV[$oV->getId()]  = $oV->getSimpleVoucher();
        }
        $oBasket->setNonPublicVar( '_aVouchers', $aV );
        $oBasket->setNonPublicVar( '_oTotalDiscount', new oxprice );
        $this->assertNull($oBasket->getVoucherDiscount());
        $oBasket->UNITcalcVoucherDiscount();
        $this->assertEquals(40, $oBasket->getVoucherDiscount()->getBruttoPrice());
    }

    /**
     * Testing how voucher calculation works
     */
    public function testCalcVoucherDiscountIfVoucherIsWrong()
    {
        $oStdVoucher = new oxStdClass();
        $oStdVoucher->sVoucherId = "aaa";

        $oProductsPriceList = $this->getMock( 'oxpricelist', array( 'getBruttoSum' ) );
        $oProductsPriceList->expects( $this->once() )->method( 'getBruttoSum' )->will( $this->returnValue( 9 ) );

        $oBasket = new modForTestAddBundles();
        $oBasket->setVar( 'oDiscountProductsPriceList', $oProductsPriceList );
        $oBasket->setVar( 'oTotalDiscount', new oxprice );
        $aV = array();
        foreach ($this->aVouchers as $oV) {
            $aV[$oV->getId()]  = $oV->getSimpleVoucher();
        }
        $oBasket->setVar( 'aVouchers', $aV );
        $aV = $oBasket->getVouchers();
        $this->assertEquals( 4, count($aV));

        $oBasket->UNITcalcVoucherDiscount();

        $aV = $oBasket->getVouchers();
        $this->assertEquals( 0, count($aV));
    }

    /*
     * test if vouhers availability checking was skipped if skip param is on
     */
    public function testCalcVoucherDiscountSkipChecking()
    {

        oxAddClassModule( 'modForTestAddVouchers', 'oxvoucher' );
        modForTestAddVouchers::$blCheckWasPerformed = false;

        $oPrice = oxNew( "oxPrice" );
        $oPrice->setPrice( 999 );
        $oPriceList = oxNew( "oxPriceList" );
        $oPriceList->addToPriceList( $oPrice );

        $oBasket = $this->getProxyClass( "oxBasket" );
        $oBasket->setNonPublicVar( '_oDiscountProductsPriceList', $oPriceList );
        $aV = array();
        foreach ($this->aVouchers as $oV) {
            $aV[$oV->getId()]  = $oV->getSimpleVoucher();
        }
        $oBasket->setNonPublicVar( '_aVouchers', $aV );
        $oBasket->setNonPublicVar( '_oTotalDiscount', new oxprice );
        $oBasket->setSkipVouchersChecking( true );
        $oBasket->UNITcalcVoucherDiscount();

        $this->assertFalse( modForTestAddVouchers::$blCheckWasPerformed );
    }

    /*
     * test apply discounts for netto price and VATs
     */
    public function testApplyDiscounts()
    {
        $aVATs = array( '7' => 12, '19' => 19);
        $oProductsPriceList = $this->getMock( 'oxpricelist', array( 'getBruttoSum', 'getVatInfo' ) );
        $oProductsPriceList->expects( $this->atLeastOnce() )->method( 'getBruttoSum' )->will( $this->returnValue( 100 ) );
        $oProductsPriceList->expects( $this->atLeastOnce() )->method( 'getVatInfo' )->will( $this->returnValue( $aVATs ) );

        $oPrice = oxNew( "oxPrice" );
        $oPrice->setPrice( 10 );

        $oBasket = $this->getMock( "modForTestAddBundles", array( "getDiscountProductsPrice", "getVoucherDiscount", "getTotalDiscount" ) );
        $oBasket->expects( $this->atLeastOnce() )->method( 'getDiscountProductsPrice' )->will( $this->returnValue( $oProductsPriceList ) );
        $oBasket->expects( $this->atLeastOnce() )->method( 'getVoucherDiscount' )->will( $this->returnValue( $oPrice ) );
        $oBasket->expects( $this->atLeastOnce() )->method( 'getTotalDiscount' )->will( $this->returnValue( $oPrice ) );
        $oBasket->setVar( 'oNotDiscountedProductsPriceList', oxNew( "oxpricelist" ) );

        $oBasket->UNITapplyDiscounts();

        $this->assertEquals( array( '7' => '9,60', '19' => '15,20'), $oBasket->getProductVats() );
        $this->assertEquals( 55.2, $oBasket->getDiscountedNettoPrice() );
    }

    /*
     * test apply discounts for netto price and VATs
     */
    public function testApplyDiscountsIfNonDiscountedArtIsAdded()
    {
        $aVATs = array( '7' => 12, '19' => 19);
        $oProductsPriceList = $this->getMock( 'oxpricelist', array( 'getBruttoSum', 'getVatInfo' ) );
        $oProductsPriceList->expects( $this->any() )->method( 'getBruttoSum' )->will( $this->returnValue( 100 ) );
        $oProductsPriceList->expects( $this->any() )->method( 'getVatInfo' )->will( $this->returnValue( $aVATs ) );

        $oProductsPriceList2 = $this->getMock( 'oxpricelist', array( 'getBruttoSum', 'getVatInfo' ) );
        $oProductsPriceList2->expects( $this->any() )->method( 'getBruttoSum' )->will( $this->returnValue( 100 ) );
        $oProductsPriceList2->expects( $this->any() )->method( 'getVatInfo' )->will( $this->returnValue( $aVATs ) );

        $oPrice = oxNew( "oxPrice" );
        $oPrice->setPrice( 10 );

        $oBasket = new modForTestAddBundles();
        $oBasket->setVar( 'oDiscountProductsPriceList', $oProductsPriceList );
        $oBasket->setVar( 'oNotDiscountedProductsPriceList', $oProductsPriceList2 );
        $oBasket->setVar( 'oTotalDiscount', $oPrice );
        $oBasket->setVar( 'oVoucherDiscount', $oPrice );

        $oBasket->UNITapplyDiscounts();

        $this->assertEquals( array( '7' => '21,60', '19' => '34,20'), $oBasket->getProductVats() );
        $this->assertEquals( 55.2, $oBasket->getDiscountedNettoPrice() );
    }

    public function testApplyDiscountsWithOneCentRoundingProblem()
    {
        $aVATs = array( 2.3809523809523809523809523809524, 9.1818181818181818181818181818182, 11.974789915966386554621848739496);
        $oProductsPriceList = $this->getMock( 'oxpricelist', array( 'getBruttoSum', 'getVatInfo' ) );
        $oProductsPriceList->expects( $this->atLeastOnce() )->method( 'getBruttoSum' )->will( $this->returnValue( 226 ) );
        $oProductsPriceList->expects( $this->atLeastOnce() )->method( 'getVatInfo' )->will( $this->returnValue( $aVATs ) );

        $oPrice = oxNew( "oxPrice" );
        $oPrice->setPrice( 0 );

        $oBasket = $this->getMock( "modForTestAddBundles", array( "getDiscountProductsPrice", "getVoucherDiscount", "getTotalDiscount" ) );
        $oBasket->expects( $this->atLeastOnce() )->method( 'getDiscountProductsPrice' )->will( $this->returnValue( $oProductsPriceList ) );
        $oBasket->expects( $this->atLeastOnce() )->method( 'getVoucherDiscount' )->will( $this->returnValue( $oPrice ) );
        $oBasket->expects( $this->atLeastOnce() )->method( 'getTotalDiscount' )->will( $this->returnValue( $oPrice ) );
        $oBasket->setVar( 'oNotDiscountedProductsPriceList', oxNew( "oxpricelist" ) );

        $oBasket->UNITapplyDiscounts();

        $this->assertEquals( 202.47, $oBasket->getDiscountedNettoPrice() );
    }

    public function testApplyDiscountsWithOneCentRoundingProblem2()
    {
        $aVATs = array( '19' => 2.71428571429);
        $oProductsPriceList = $this->getMock( 'oxpricelist', array( 'getBruttoSum', 'getVatInfo' ) );
        $oProductsPriceList->expects( $this->any() )->method( 'getBruttoSum' )->will( $this->returnValue( 17 ) );
        $oProductsPriceList->expects( $this->any() )->method( 'getVatInfo' )->will( $this->returnValue( $aVATs ) );

        $aVATs = array( '19' => 3.11344537815);
        $oProductsPriceList2 = $this->getMock( 'oxpricelist', array( 'getBruttoSum', 'getNettoSum', 'getVatInfo' ) );
        $oProductsPriceList2->expects( $this->any() )->method( 'getBruttoSum' )->will( $this->returnValue( 19.5 ) );
        $oProductsPriceList2->expects( $this->any() )->method( 'getNettoSum' )->will( $this->returnValue( 16.39 ) );
        $oProductsPriceList2->expects( $this->any() )->method( 'getVatInfo' )->will( $this->returnValue( $aVATs ) );

        $oPrice = oxNew( "oxPrice" );
        $oPrice->setPrice( 1.7 );

        $oBasket = new modForTestAddBundles();
        $oBasket->setVar( 'oDiscountProductsPriceList', $oProductsPriceList );
        $oBasket->setVar( 'oNotDiscountedProductsPriceList', $oProductsPriceList2 );
        $oBasket->setVar( 'oTotalDiscount', $oPrice );
        $oBasket->setVar( 'oVoucherDiscount', oxNew( "oxPrice" ) );

        $oBasket->UNITapplyDiscounts();

        $this->assertEquals( array( '19' => '5,55'), $oBasket->getProductVats() );
        $this->assertEquals( 29.25, $oBasket->getDiscountedNettoPrice() );
    }

    /**
     * Testinc wrapping calculation
     */
    public function testCalcBasketWrapping()
    {
        $sWrapId = $this->oWrap->getId();
        $sCardId = $this->oCard->getId();

        // forcing some config params for deeper execution
        modConfig::getInstance()->setConfigParam( 'blCalcVatForWrapping', true );
        modConfig::getInstance()->setConfigParam( 'blEnterNetPrice', true );

        // deleting discounts
        foreach ( $this->aDiscounts as $oDiscount ) {
            $oDiscount->delete();
        }

        $oBasket = new oxbasket();
        $oItem = $oBasket->addToBasket( $this->oArticle->getId(), 2 );
        $oItem->setWrapping( $sWrapId );

        $oItem = $oBasket->addToBasket( $this->oVariant->getId(), 3 );
        $oItem->setWrapping( $sWrapId );

        $oBasket->setCardId( $sCardId );
        $oBasket->calculateBasket( false );

        $oWrapPrice = $oBasket->UNITcalcBasketWrapping();

        $this->assertEquals( ( 5*5 + 10 ) * 1.19, $oWrapPrice->getBruttoPrice() );
        $this->assertEquals( ( 5*5 + 10 ), $oWrapPrice->getNettoPrice() );
        $this->assertEquals( 19, $oWrapPrice->getVat() );
    }

    /**
     * Testing payment costs calculation
     */
    public function testCalcPaymentCost()
    {
        modConfig::getInstance()->setConfigParam( 'blCalcVATForPayCharge', false );
        modConfig::getInstance()->setConfigParam( 'blEnterNetPrice', true );

        // deleting discounts
        foreach ( $this->aDiscounts as $oDiscount ) {
            $oDiscount->delete();
        }

        // choosing first payment which is active and has costs
        $oBasket = new oxbasket();
        $oBasket->addToBasket( $this->oArticle->getId(), 2 );
        $oBasket->addToBasket( $this->oVariant->getId(), 3 );
        $oBasket->calculateBasket( false );
        $oBasket->setPayment( 'oxidcashondel' );

        $oPayCost = $oBasket->UNITcalcPaymentCost( false, false );

        $this->assertEquals( 7.5, $oPayCost->getBruttoPrice() );
        $this->assertEquals( 7.5, $oPayCost->getNettoPrice() );
        $this->assertEquals( 0, $oPayCost->getVat() );
    }

    /**
     * Testing costs setter and getter
     */
    public function testSetCostAndGetCosts()
    {
        $oCost = new Oxstdclass();
        $oCost->xxx = 'yyy';

        $oBasket = new modForTestAddBundles();
        $oBasket->setCost( 'xxx', $oCost );
        $this->assertEquals( array( 'xxx' => $oCost ), $oBasket->getCosts() );
    }

    /**
     * Testing final basket calculator
     */
    public function testCalculateBasket()
    {
        modConfig::getInstance()->setConfigParam( 'blCalcVATForDelivery', false );
        modConfig::getInstance()->setConfigParam( 'blEnterNetPrice', true );
        modConfig::getInstance()->setConfigParam( 'blPerfNoBasketSaving', false );

        $aMethodsToTest = array( 'isEnabled',
                                 '_clearBundles',
                                 '_addBundles',
                                 '_calcItemsPrice',
                                 '_calcBasketDiscount',
                                 '_calcBasketTotalDiscount',
                                 '_calcVoucherDiscount',
                                 '_applyDiscounts',
                                 'setCost',
                                 '_calcTotalPrice',
                                 '_setDeprecatedValues',
                                 '_calcBasketWrapping',
                                 'afterUpdate' );
            $aMethodsToTest[] = '_mergeSavedBasket';

        //
        $oBasket = $this->getMock( 'oxbasket', $aMethodsToTest );

        $oBasket->expects( $this->once() )->method( 'isEnabled' )->will( $this->returnValue( true ) );
            $oBasket->expects( $this->once() )->method( '_mergeSavedBasket' );
        $oBasket->expects( $this->once() )->method( '_clearBundles' );
        $oBasket->expects( $this->once() )->method( '_addBundles' );
        $oBasket->expects( $this->once() )->method( '_calcItemsPrice' );
        $oBasket->expects( $this->once() )->method( '_calcBasketDiscount' );
        $oBasket->expects( $this->once() )->method( '_calcBasketTotalDiscount' );
        $oBasket->expects( $this->once() )->method( '_calcVoucherDiscount' );
        $oBasket->expects( $this->once() )->method( '_applyDiscounts' );
        $oBasket->expects( $this->exactly( 3 ) )->method( 'setCost' );
        $oBasket->expects( $this->once() )->method( '_calcTotalPrice' );
        $oBasket->expects( $this->once() )->method( '_setDeprecatedValues' );
        $oBasket->expects( $this->once() )->method( 'afterUpdate' );
        $oBasket->expects( $this->once() )->method( '_calcBasketWrapping' );

        $oBasket->calculateBasket( false );
    }

    /**
     * Testing update status markers onUpdate/afterUpdate
     */
    public function testOnUpdateAndAfterUpdate()
    {
        $oBasket = new modForTestAddBundles();
        $oBasket->onUpdate();
        $this->assertTrue( $oBasket->getVar( 'blUpdateNeeded' ) );
        $oBasket->afterUpdate();
        $this->assertFalse( $oBasket->getVar( 'blUpdateNeeded' ) );
    }

    /**
     * Testing how basket summary getter works
     */
    // 1. checks if this method returns empty basket summary object
    public function testGetBasketSummaryDisabledByConfig()
    {
        $oBasket = $this->getMock( 'oxbasket', array( 'isEnabled' ) );
        $oBasket->expects( $this->once() )->method( 'isEnabled' )->will( $this->returnValue( false ) );

        $oSummary = $oBasket->getBasketSummary();
        $this->assertEquals( array(), $oSummary->aArticles );
        $this->assertEquals( array(), $oSummary->aCategories );
        $this->assertEquals( 0, $oSummary->iArticleCount );
        $this->assertEquals( 0, $oSummary->dArticlePrice );
    }
    // 2. checks if price loading for article is disabled
    public function testGetBasketSummaryPriceDisabled()
    {
        modConfig::getInstance()->setConfigParam( 'bl_perfLoadPrice', false );
        // deleting discounts
        foreach ( $this->aDiscounts as $oDiscount )
            $oDiscount->delete();

        $oBasket = new oxbasket();
        $oBasket->addToBasket( $this->oVariant->getId(), 10 );
        $oBasket->addToBasket( $this->oArticle->getId(), 10 );

        $oSummary = $oBasket->getBasketSummary();
        $this->assertEquals( 2, count( $oSummary->aArticles ) );
        $this->assertTrue( isset( $oSummary->aArticles[$this->oArticle->getId()] ) );
        $this->assertTrue( isset( $oSummary->aArticles[$this->oVariant->getId()] ) );
        $this->assertEquals( 20, $oSummary->iArticleCount );
        $this->assertEquals( 0, $oSummary->dArticlePrice );
        $this->assertTrue( isset( $oSummary->aCategories[$this->oCategory->getId()] ) );
    }
    // 3. checks if this method returns filled basket summary
    public function testGetBasketSummaryRawCall()
    {
        // deleting discounts
        foreach ( $this->aDiscounts as $oDiscount )
            $oDiscount->delete();

        $oBasket = new oxbasket();
        $oBasket->addToBasket( $this->oVariant->getId(), 10 );
        $oBasket->addToBasket( $this->oArticle->getId(), 10 );

        $oSummary = $oBasket->getBasketSummary();
        $this->assertEquals( 2, count( $oSummary->aArticles ) );
        $this->assertTrue( isset( $oSummary->aArticles[$this->oArticle->getId()] ) );
        $this->assertTrue( isset( $oSummary->aArticles[$this->oVariant->getId()] ) );
        $this->assertEquals( 20, $oSummary->iArticleCount );
        $this->assertEquals( 20*19, $oSummary->dArticlePrice );
        $this->assertTrue( isset( $oSummary->aCategories[$this->oCategory->getId()] ) );
    }
    // #1115: Usability Problem during checkout with products without stock
    public function testGetBasketSummaryIfArtOffline()
    {
        // deleting discounts
        foreach ( $this->aDiscounts as $oDiscount )
            $oDiscount->delete();

        $oBasket = new oxbasket();
        $oBasket->addToBasket( $this->oVariant->getId(), 10 );
        $oBasket->addToBasket( $this->oArticle->getId(), 10 );
        $this->oArticle->oxarticles__oxstock = new oxField(0, oxField::T_RAW);
        $this->oArticle->oxarticles__oxstockflag = new oxField(2, oxField::T_RAW);
        $this->oArticle->save();
        $oSummary = $oBasket->getBasketSummary();
        $this->assertEquals( 2, count( $oSummary->aArticles ) );
        $this->assertTrue( isset( $oSummary->aArticles[$this->oArticle->getId()] ) );
        $this->assertTrue( isset( $oSummary->aArticles[$this->oVariant->getId()] ) );
        $this->assertEquals( 20, $oSummary->iArticleCount );
        $this->assertEquals( 20*19, $oSummary->dArticlePrice );
        $this->assertTrue( isset( $oSummary->aCategories[$this->oCategory->getId()] ) );
    }

    /**
     * Testing how voucher adding works
     */
    // adding non existing voucher and testing if exeption was thrown
    public function testAddVoucherNonExistingVoucher()
    {
        modConfig::getInstance()->setConfigParam( 'blEnterNetPrice', true );
        // deleting discounts
        foreach ( $this->aDiscounts as $oDiscount )
            $oDiscount->delete();

        $oBasket = new oxbasket();
        $oBasket->addToBasket( $this->oArticle->getId(), 10 );
        $oBasket->addToBasket( $this->oVariant->getId(), 10 );
        $oBasket->calculateBasket( false );
        $oBasket->addVoucher( '_xxx' );
        $this->assertEquals( 0, count( $oBasket->getVouchers() ) );
    }

    // adding existing voucher and testing if it is stored in voucher array
    public function testAddVoucherNormalVoucher()
    {

        modConfig::getInstance()->setConfigParam( 'blEnterNetPrice', true );
        $sVoucher = key( $this->aVouchers );
        $oVoucher = $this->aVouchers[$sVoucher];

        // deleting discounts
        foreach ( $this->aDiscounts as $oDiscount )
            $oDiscount->delete();

        $oBasket = new oxbasket();
        $oBasket->addToBasket( $this->oArticle->getId(), 10 );
        $oBasket->addToBasket( $this->oVariant->getId(), 10 );
        $oBasket->calculateBasket( false );

        $oBasket->addVoucher( $sVoucher );

        $aVouchers = $oBasket->getVouchers();

        $this->assertEquals( 1, count( $aVouchers ) );
        $this->assertTrue( isset( $aVouchers[$oVoucher->oxvouchers__oxid->value] ) );
    }

    // test if vouhers availability checking was skipped if skip param is on
    public function testAddVoucherSkipChecking()
    {

        oxAddClassModule( 'modForTestAddVouchers', 'oxvoucher' );
        modForTestAddVouchers::$blCheckWasPerformed = false;

        $sVoucher = key( $this->aVouchers );
        $oVoucher = $this->aVouchers[$sVoucher];

        $oPrice = oxNew( "oxPrice" );
        $oPrice->setPrice( 999 );
        $oPriceList = oxNew( "oxPriceList" );
        $oPriceList->addToPriceList( $oPrice );

        $oBasket = $this->getProxyClass( "oxBasket" );
        $oBasket->setNonPublicVar( '_oDiscountProductsPriceList', $oPriceList );

        $oBasket->setSkipVouchersChecking( true );
        $oBasket->addVoucher( $sVoucher );

        $this->assertFalse( modForTestAddVouchers::$blCheckWasPerformed );
    }

    /**
     * Testing how voucher removal works
     */
    // removing added voucher
    public function testRemoveVoucher()
    {
        $myDb = oxDb::getDb( true );

        $sVoucherNr = key( $this->aVouchers );
        $sVoucherId = $this->aVouchers[$sVoucherNr]->getId();
        $sSql = "update oxvouchers set oxreserved = '" . time() . "' where oxid = '" . $sVoucherId . "'";
        $myDb->execute( $sSql );

        $oBasket = new modForTestAddBundles();
        $oBasket->setVar( 'aVouchers', array( $sVoucherId => 1 ) );

        // testing if voucher is really removed
        $oBasket->removeVoucher( $sVoucherId );
        $this->assertEquals( array(), $oBasket->getVouchers() );

        $sSql = "select oxreserved from oxvouchers where oxid = '" . $sVoucherId . "'";
        $this->assertEquals( 0, $myDb->getOne($sSql) );
    }

    // removing added voucher calls onUpdatet() method
    public function testRemoveVoucherCallsOnUpdateCommand()
    {
        $sVoucherId = '_testVoucherId';

        $oBasket = $this->getMock( 'modForTestAddBundles', array( 'onUpdate' ) );
        $oBasket->expects( $this->once() )->method( 'onUpdate' );

        $oBasket->setVar( 'aVouchers', array( $sVoucherId => 1 ) );
        $oBasket->removeVoucher( $sVoucherId );
    }

    // removing not assigned voucher
    public function testRemoveVoucherWithNotAssignedVoucherId()
    {
        $oBasket = $this->getMock( 'modForTestAddBundles', array( 'onUpdate' ) );
        $oBasket->expects( $this->never() )->method( 'onUpdate' );

        $oBasket->setVar( 'aVouchers', array( '_xxx' => 1 ) );
        $oBasket->removeVoucher( '_zzz' );

        $this->assertEquals( array( '_xxx' => 1 ), $oBasket->getVouchers() );
    }

    /**
     *
     */
    public function testSetDeprecatedValues()
    {

        modConfig::getInstance()->setConfigParam( 'blEnterNetPrice', true );
        $aTestVals = array('dproductsprice', 'dproductsnetprice', 'dVAT', 'fproductsprice', 'fproductsnetprice',
                           'fVAT', 'ddeliverycost', 'ddeliverynetcost', 'dDelVAT', 'fDelVATPercent',
                           'fdeliverycost', 'fdeliverynetcost', 'fDelVAT', 'dWrappingPrice', 'dWrappingNetto',
                           'dWrappingVAT', 'fWrappingPrice', 'fWrappingNetto', 'fWrappingVAT', 'fWrappingVATPercent',
                           'dAddPaymentSum', 'dAddPaymentSumVAT', 'fAddPaymentSum', 'fAddPaymentSumVAT', 'fAddPaymentSumVATPercent',
                           'fAddPaymentNetSum', 'dprice', 'fprice', 'iCntProducts', 'dCntItems', 'aVATs', 'aBasketContents',
                           'giftmessage', 'chosencard', 'oCard', 'dDiscount', 'aDiscounts', 'dVoucherDiscount', 'fVoucherDiscount', 'dSkippedDiscount');

        // deleting discounts to ignore bundle problems
        foreach ( $this->aDiscounts as $oDiscount ) {
            $oDiscount->oxdiscount__oxaddsumtype = new oxField('%', oxField::T_RAW);
            $oDiscount->save();
        }

        $oBasket = new oxbasket();
        $oBasket->setPayment( 'oxidcashondel' );
        $oBasket->setCardId( $this->oCard->getId() );
        $oBasket->setCardMessage( 'message' );

        $oItem = $oBasket->addToBasket( $this->oArticle->getId(), 10 );
        $oItem->setWrapping( $this->oWrap->getId() );


        $oBasket->addToBasket( $this->oVariant->getId(), 10 );
        $oBasket->calculateBasket( false );

        foreach ( $aTestVals as $sName ) {
            $this->assertTrue( isset( $oBasket->{$sName} ), " $sName is not set ");
        }
    }

    /**
     * Testing basket merging functionality
     */
    // allready merged - functionality must be skipped (PE only)
    public function testMergeSavedBasketAllreadyMerged()
    {

        modConfig::getInstance()->setConfigParam( 'blPerfNoBasketSaving', false );

        $oBasket = $this->getMock( 'modForTestAddBundles', array( 'addToBasket', 'getBasketUser' ) );
        $oBasket->expects( $this->never() )->method( 'addToBasket' );
        $oBasket->expects( $this->never() )->method( 'getBasketUser' );
        $oBasket->setVar( 'blBasketMerged', true );

        modConfig::getInstance()->setConfigParam( 'blAllowUnevenAmounts', true );
        $oBasket->UNITmergeSavedBasket();
    }

    // no session user - functionality must be skipped (PE only)
    public function testMergeSavedBasketNoUser()
    {

        $oBasket = $this->getMock( 'oxbasket', array( 'addToBasket' ) );
        $oBasket->expects( $this->never() )->method( 'addToBasket' );
        $oBasket->setBasketUser( false );

        modConfig::getInstance()->setConfigParam( 'blAllowUnevenAmounts', true );
        $oBasket->UNITmergeSavedBasket();
    }

    // everything is fine (PE only)
    public function testMergeSavedBasketAllSetup()
    {

        $oUserBasketItem = $this->getMock( 'oxuserbasketitem', array( 'getSelList' ) );
        $oUserBasketItem->expects( $this->once() )->method( 'getSelList' );

        $oUserBasket = $this->getMock( 'oxuserbasket', array( 'addItemToBasket', 'getItems' ) );
        $oUserBasket->expects( $this->once() )->method( 'addItemToBasket' );
        $oUserBasket->expects( $this->once() )->method( 'getItems')->will( $this->returnValue( array( $oUserBasketItem ) ) );

        $oUser = $this->getMock( 'oxuser', array( 'getBasket' ) );
        $oUser->expects( $this->once() )->method( 'getBasket' )->will( $this->returnValue( $oUserBasket ) );

        $oBasket = $this->getMock( 'modForTestAddBundles', array( 'getBasketUser', 'addToBasket', '_canMergeBasket' ) );
        $oBasket->expects( $this->once() )->method( 'getBasketUser' )->will( $this->returnValue( $oUser ) );
        $oBasket->expects( $this->once() )->method( 'addToBasket' );
        $oBasket->expects( $this->once() )->method( '_canMergeBasket' )->will( $this->returnValue( true ) );
        $oBasket->setVar( 'aBasketContents', array( new oxbasketitem() ) );

        modConfig::getInstance()->setConfigParam( 'blAllowUnevenAmounts', true );
        $oBasket->UNITmergeSavedBasket();
    }

    /**
     * Testing item adding to saved basket (PE only)
     */
    public function testAddItemToSavedBasket()
    {

        $oUserBasket = $this->getMock( 'oxuserbasket', array( 'addItemToBasket' ) );
        $oUserBasket->expects( $this->once() )->method( 'addItemToBasket' );

        $oUser = $this->getMock( 'oxuser', array( 'getBasket' ) );
        $oUser->expects( $this->once() )->method( 'getBasket' )->will( $this->returnValue( $oUserBasket ) );

        $oBasket = $this->getMock( 'oxbasket', array( 'getBasketUser' ) );
        $oBasket->expects( $this->once() )->method( 'getBasketUser' )->will( $this->returnValue( $oUser ) );
        $oBasket->UNITaddItemToSavedBasket( 'xxx', 10, array() );
    }

    /**
     * Testing saved basket deletion (PE only)
     */
    // not disabled, will execute deletion
    public function testDeleteSavedBasket()
    {

        modConfig::getInstance()->setConfigParam( 'blPerfNoBasketSaving', false );

        $oUserBasket = $this->getMock( 'oxuserbasket', array( 'delete' ) );
        $oUserBasket->expects( $this->once() )->method( 'delete' );

        $oUser = $this->getMock( 'oxuser', array( 'getBasket' ) );
        $oUser->expects( $this->once() )->method( 'getBasket' )->will( $this->returnValue( $oUserBasket ) );

        $oBasket = $this->getMock( 'oxbasket', array( 'getBasketUser' ) );
        $oBasket->expects( $this->once() )->method( 'getBasketUser' )->will( $this->returnValue( $oUser ) );
        $oBasket->UNITdeleteSavedBasket();
    }

    /**
     * Testing how correctly delivery country getter works
     */
    // no user and no special config - must return null
    public function testFindDelivCountryNoUserAtAll()
    {
        modConfig::getInstance()->setConfigParam( 'aHomeCountry', null );

        $oBasket = new oxbasket();
        $oBasket->setBasketUser( false );
        $this->assertNull( $oBasket->UNITfindDelivCountry() );
    }
    // no user and special config for home country
    public function test_findDelivCountry_noUserIsHomeCountry()
    {
        modConfig::getInstance()->setConfigParam( 'aHomeCountry', array('_xxx') );
        modConfig::getInstance()->setConfigParam( 'blCalculateDelCostIfNotLoggedIn', true );

        $oBasket = new oxbasket();
        $oBasket->setBasketUser( false );
        $this->assertEquals( '_xxx', $oBasket->UNITfindDelivCountry() );
    }
    // user exists and returns his country ID
    public function testFindDelivCountryAdminUserCountryId()
    {
        $oUser = new oxuser();
        $oUser->load( 'oxdefaultadmin' );

        $oBasket = new oxbasket();
        $oBasket->setBasketUser( $oUser );
        $this->assertEquals( $oUser->oxuser__oxcountryid->value, $oBasket->UNITfindDelivCountry() );
    }
    //  user exists and returns delcountryid which usually is defined dy some method
    public function testFindDelivCountry_delcountryid()
    {
        $oUser = new oxuser();
        $oUser->load( 'oxdefaultadmin' );

        $oBasket = new oxbasket();
        $oBasket->setBasketUser( $oUser );

        oxConfig::getInstance()->setGlobalParameter( 'delcountryid', '_yyy' );
        $this->assertEquals( '_yyy', $oBasket->UNITfindDelivCountry() );
    }
    // user exists and returns country ID my user delivery address
    public function testFindDelivCountryDeladrId()
    {
        $oUser = new oxuser();
        $oUser->load( 'oxdefaultadmin' );

        $oBasket = new oxbasket();
        $oBasket->setBasketUser( $oUser );

        oxConfig::getInstance()->setGlobalParameter( 'delcountryid', null );
        modConfig::setParameter( 'deladrid', $this->oDelAdress->getId() );
        $this->assertEquals( '_xxx', $oBasket->UNITfindDelivCountry() );
    }

    /**
     * Testing if basket deletion really destroys session basket
     */
    public function testDeleteBasket()
    {
        $oBasket = oxSession::getInstance()->getBasket();
        $oBasket->setOrderId( 'xxx' );
            oxConfig::getInstance()->setGlobalParameter( 'blPerfNoBasketSaving', false );
        $oBasket->deleteBasket();

        // now loading and testing if its the same
        $oBasket = oxSession::getInstance()->getBasket();
        $this->assertNull( $oBasket->getOrderId() );
    }

    /**
     * Testing active payment id getter/setter
     */
    public function testSetPaymentAndGetPaymentId()
    {
        // testing if value is taken from request
        modConfig::setParameter( 'paymentid', 'xxx' );
        $oBasket = new oxbasket();
        $this->assertEquals( 'xxx', $oBasket->getPaymentId() );

        // testing if value is taken from setter
        $oBasket->setPayment( 'yyy' );
        $this->assertEquals( 'yyy', $oBasket->getPaymentId() );
    }

    /**
     * Testing shipping setter/getter
     */
    public function testSetShippingAndGetShippingId()
    {
        // testing if default value is set
        $oBasket = new oxbasket();
        $this->assertEquals( 'oxidstandard', $oBasket->getShippingId() );

        // testing if value is taken from request
        modConfig::setParameter( 'sShipSet', 'xxx' );
        $oBasket = new oxbasket();
        $this->assertEquals( 'xxx', $oBasket->getShippingId() );

        // testing if value is taken from setter
        $oBasket->setShipping( 'yyy' );
        $this->assertEquals( 'yyy', $oBasket->getShippingId() );
    }

    public function testGetShippingIdWhenPaymentIdIsOxEmpty()
    {
        modConfig::getInstance()->setParameter( "sShipSet", null );

        $oBasket = $this->getMock( "oxbasket", array( "getPaymentId" ) );
        $oBasket->expects( $this->once() )->method( 'getPaymentId' )->will( $this->returnValue( "oxempty" ) );
        $this->assertNull( $oBasket->getShippingId() );
    }

    // selection lists must be NOT set
    public function testGetBasketArticlesSelListsAreOff()
    {
        modConfig::getInstance()->setConfigParam( 'bl_perfLoadSelectLists', false );

        $oBasket = new oxbasket();
        $oBasket->addToBasket( $this->oArticle->getId(), 10 );
        $oBasket->addToBasket( $this->oVariant->getId(), 10 );
        $aIds = array( $this->oArticle->getId(), $this->oVariant->getId() );

        $blSelNotSet = true;

        foreach ( $oBasket->getBasketArticles() as $oArticle ) {

            // selection list check
            $blSelNotSet = $blSelNotSet & !isset( $oArticle->selectlist );

            $this->assertTrue( in_array( $oArticle->getId(), $aIds ) );
        }

        if ( !$blSelNotSet ) {
            $this->fail( 'selection list must be NOT set' );
        }
    }

    /**
     * Testing discount products price getter
     */
    public function testGetDiscountProductsPrice()
    {
        foreach ( $this->aDiscounts as $oDiscount )
            $oDiscount->delete();

        $oBasket = new oxbasket();
        $oBasket->addToBasket( $this->oArticle->getId(), 10 );
        $oBasket->addToBasket( $this->oVariant->getId(), 10 );
        $oBasket->calculateBasket( false );

        $oPrice = $oBasket->getDiscountProductsPrice();
        $this->assertEquals( 20 * 19, $oPrice->getBruttoSum() );
    }

    /**
     * Testing total products price getter
     */
    public function testGetProductsPrice()
    {
        // deleting discounts to ignore bundle problems
        foreach ( $this->aDiscounts as $oDiscount )
            $oDiscount->delete();

        $oBasket = new oxbasket();
        $oBasket->addToBasket( $this->oArticle->getId(), 10 );
        $oBasket->addToBasket( $this->oVariant->getId(), 10 );
        $oBasket->calculateBasket( false );

        $oProdPrice = $oBasket->getProductsPrice();
        $this->assertTrue( $oProdPrice instanceof oxpricelist );

        $this->assertEquals( 20*19, $oProdPrice->getBruttoSum());
        $this->assertEquals( 20*19/1.19, $oProdPrice->getNettoSum());
        $this->assertEquals( array( 19 => 20*19 - 20*19/1.19), $oProdPrice->getVatInfo());
        $this->assertEquals( array( 19 => 20*19 ), $oProdPrice->getPriceInfo());
        $this->assertEquals( 19, $oProdPrice->getMostUsedVatPercent());
    }

    /**
     * Testing total products price getter
     */
    public function testGetProductsPriceIfNotSet()
    {
        $oBasket = new oxbasket();
        $oProdPrice = $oBasket->getProductsPrice();
        $this->assertTrue( $oProdPrice instanceof oxpricelist );
    }

    /**
     * Testing total basket price getter
     */
    public function testGetPrice()
    {
        // deleting discounts to ignore bundle problems
        foreach ( $this->aDiscounts as $oDiscount )
            $oDiscount->delete();

        $oBasket = new oxbasket();
        $oBasket->addToBasket( $this->oArticle->getId(), 10 );
        $oBasket->addToBasket( $this->oVariant->getId(), 10 );
        $oBasket->calculateBasket( false );

        $oPrice = $oBasket->getPrice();
        $this->assertTrue( $oPrice instanceof oxprice );
        $this->assertEquals( 0, $oPrice->getVat() );
        $this->assertEquals( 19*20, $oPrice->getBruttoPrice() );
        $this->assertEquals( 19*20, $oPrice->getNettoPrice() );
        $this->assertEquals( 0, $oPrice->getVatValue() );
    }

    /**
     * Testing total basket price getter
     */
    public function testGetPriceIfNotSet()
    {
        $oBasket = new oxbasket();
        $oPrice = $oBasket->getPrice();
        $this->assertTrue( $oPrice instanceof oxprice );
    }

    /**
     * Testing order id setter/getter
     */
    public function testSetOrderIdAndGetOrderId()
    {
        $oBasket = new oxbasket();
        $oBasket->setOrderId( 'xxx' );
        $this->assertEquals( 'xxx', $oBasket->getOrderId() );
    }

    /**
     * Testing if costs getter returns all default costs
     */
    public function testGetCosts()
    {
        modConfig::getInstance()->setConfigParam( 'blEnterNetPrice', true );
        // deleting discounts to ignore bundle problems
        foreach ( $this->aDiscounts as $oDiscount )
            $oDiscount->delete();

        $oBasket = new oxbasket();
        $oBasket->addToBasket( $this->oArticle->getId(), 2 );
        $oBasket->addToBasket( $this->oVariant->getId(), 11 );
        $oBasket->calculateBasket( false );
        $this->assertEquals( array( 'oxdelivery', 'oxwrapping', 'oxpayment' ), array_keys( $oBasket->getCosts() ) );
    }

    /**
     * Testing voucher info getter
     */
    public function testGetVouchers()
    {
        foreach ( $this->aDiscounts as $oDiscount )
            $oDiscount->delete();

        $oBasket = new oxbasket();
        $oBasket->addToBasket( $this->oArticle->getId(), 10 );
        $oBasket->addToBasket( $this->oVariant->getId(), 10 );
        $oBasket->calculateBasket( false );

        foreach ( $this->aVouchers as $oVoucher )
            $oBasket->addVoucher( $oVoucher->oxvouchers__oxvouchernr->value );

        $aVouchers = $oBasket->getVouchers();

        // testing if they are the same
        $this->assertEquals( count( $this->aVouchers ), count( $aVouchers ) );
        foreach ( $aVouchers as $oStdVoucher ) {
            $this->assertTrue( isset( $this->aVouchers[$oStdVoucher->sVoucherNr] ) );
        }
    }

    /**
     * Testing basket products count getter
     */
    public function testGetProductsCount()
    {
        // deleting discounts to ignore bundle problems
        foreach ( $this->aDiscounts as $oDiscount )
            $oDiscount->delete();

        $oBasket = new oxbasket();
        $oBasket->addToBasket( $this->oArticle->getId(), 2 );
        $oBasket->addToBasket( $this->oVariant->getId(), 11 );
        $oBasket->calculateBasket( false );
        $this->assertEquals( 2, $oBasket->getProductsCount() );
    }

    /**
     * Testing item count getter
     */
    public function testGetItemsCount()
    {
        // deleting discounts to ignore bundle problems
        foreach ( $this->aDiscounts as $oDiscount )
            $oDiscount->delete();

        $oBasket = new oxbasket();
        $oBasket->addToBasket( $this->oArticle->getId(), 7 );
        $oBasket->addToBasket( $this->oVariant->getId(), 6 );
        $oBasket->calculateBasket( false );
        $this->assertEquals( 13, $oBasket->getItemsCount() );
    }

    /**
     * Testing basket total weight getter
     */
    public function testGetWeight()
    {
        // deleting discounts to ignore bundle problems
        foreach ( $this->aDiscounts as $oDiscount )
            $oDiscount->delete();

        $oBasket = new oxbasket();
        $oBasket->addToBasket( $this->oArticle->getId(), 10 );
        $oBasket->addToBasket( $this->oVariant->getId(), 10 );
        $oBasket->calculateBasket( false );
        $this->assertEquals( 200, $oBasket->getWeight() );
    }

    /**
     * Testing basket items array getter
     */
    public function testGetContents()
    {
        $oBasket = new oxbasket();
        $oBasket->addToBasket( $this->oArticle->getId(), 10 );
        $oBasket->addToBasket( $this->oVariant->getId(), 10 );
        $aIds = array( $this->oArticle->getId(), $this->oVariant->getId() );

        // testing
        foreach ( $oBasket->getContents() as $oBasketItem ) {
             $this->assertTrue( in_array( $oBasketItem->getProductId(), $aIds ) );
        }
    }

    /**
     * Testing products VAT getter
     */
    public function testGetProductVats()
    {
        // deleting discounts to ignore bundle problems
        foreach ( $this->aDiscounts as $oDiscount )
            $oDiscount->delete();

        // setting custom VAT for variant
        $this->oVariant->oxarticles__oxvat = new oxField(9, oxField::T_RAW);
        $this->oVariant->save();

        $oBasket = new oxbasket();
        $oBasket->addToBasket( $this->oArticle->getId(), 10 );
        $oBasket->addToBasket( $this->oVariant->getId(), 10 );
        $oBasket->calculateBasket( false );

        $aTestVats = array( 19 => oxLang::getInstance()->formatCurrency( ( 10*19 - 10*19/1.19 ) ),
                             9 => oxLang::getInstance()->formatCurrency( ( 10*19 - 10*19/1.09 ) )
                          );

        $this->assertEquals( $aTestVats, $oBasket->getProductVats());
    }

    /**
     * Testing products VAT getter
     */
    public function testGetProductVatsIfPriceNotSet()
    {
        $oBasket = new oxbasket();
        $this->assertEquals( 0, count($oBasket->getProductVats()));
    }

    /**
     * Testing products discounted net price getter
     */
    public function testDiscountedNettoPrice()
    {
        $oProductsPriceList = $this->getMock( 'oxpricelist', array( 'getNettoSum' ) );
        $oProductsPriceList->expects( $this->once() )->method( 'getNettoSum' )->will( $this->returnValue( 11 ) );

        $oBasket = $this->getProxyClass( "oxBasket" );
        $oBasket->setNonPublicVar( '_dDiscountedProductNettoPrice', 22 );
        $oBasket->setNonPublicVar( '_oNotDiscountedProductsPriceList', $oProductsPriceList );

        $this->assertEquals( 33, $oBasket->getDiscountedNettoPrice());
    }

    /**
     * Testing products discounted net price getter
     */
    public function testDiscountedNettoPriceIfNotSet()
    {
        $oBasket = $this->getProxyClass( "oxBasket" );
        $this->assertFalse( $oBasket->getDiscountedNettoPrice());
    }

    /**
     * Testing gift card message getter/setter
     */
    public function testSetCardMessageAndGetCardMessage()
    {
        $oBasket = new oxbasket();
        $oBasket->setCardMessage( 'xxx' );
        $this->assertEquals( 'xxx', $oBasket->getCardMessage() );
    }

    /**
     * Testing gift card setter and getter
     */
    public function testGetCard()
    {
        $oBasket = new oxbasket();
        $oBasket->setCardId( $this->oCard->getId() );

        // testing Id getter
        $this->assertEquals( $this->oCard->getId(), $oBasket->getCardId() );

        // testing card getter
        $oCard = $oBasket->getCard();
        $this->assertEquals( $this->oCard->getId(), $oCard->getId() );
        $this->assertTrue( $oCard instanceof oxwrapping );
    }

    /**
     * Testing discounts getter
     */
    public function testGetDiscounts()
    {
        $oDiscount1 = new OxstdClass();
        $oDiscount1->dDiscount = 5;

        $aDiscounts[] = $oDiscount1;
        $oDiscount2 = new OxstdClass();
        $oDiscount2->dDiscount = 10;

        $aDiscounts[] = $oDiscount2;

        $oBasket = $this->getProxyClass( "oxBasket" );
        $oBasket->setNonPublicVar( '_aItemDiscounts', array($oDiscount1) );
        $oBasket->setNonPublicVar( '_aDiscounts', array($oDiscount2) );
        $oBasket->UNITcalcBasketTotalDiscount();

        $this->assertEquals( $aDiscounts, $oBasket->getDiscounts() );
    }

    /**
     * Testing discounts getter
     */
    public function testGetDiscountsIfZeroDiscount()
    {
        $oDiscount2 = new OxstdClass();
        $oDiscount2->dDiscount = 0;

        $oBasket = $this->getProxyClass( "oxBasket" );
        $oBasket->setNonPublicVar( '_aItemDiscounts', array() );
        $oBasket->setNonPublicVar( '_aDiscounts', array($oDiscount2) );
        $oBasket->UNITcalcBasketTotalDiscount();

        $this->assertNull( $oBasket->getDiscounts() );
    }

    /**
     * Testing discounts getter
     */
    public function testGetDiscountsIfItemDiscount()
    {
        $oDiscount1 = new OxstdClass();
        $oDiscount1->dDiscount = 1;

        $aDiscounts[] = $oDiscount1;
        $oDiscount2 = new OxstdClass();
        $oDiscount2->dDiscount = 0;

        $oBasket = $this->getProxyClass( "oxBasket" );
        $oBasket->setNonPublicVar( '_aItemDiscounts', array($oDiscount1) );
        $oBasket->setNonPublicVar( '_aDiscounts', array() );
        $oBasket->UNITcalcBasketTotalDiscount();

        $this->assertEquals( $aDiscounts, $oBasket->getDiscounts() );
    }

    /**
     * Testing voucher discount getter
     */
    public function testGetVoucherDiscount()
    {
        $oBasket = new oxbasket();
        $oBasket->addToBasket( $this->oArticle->getId(), 10 );
        $oBasket->addToBasket( $this->oVariant->getId(), 10 );
        $oBasket->calculateBasket( false );

        foreach ( $this->aVouchers as $oVoucher )
            $oBasket->addVoucher( $oVoucher->oxvouchers__oxvouchernr->value );

        $oBasket->calculateBasket( false );

        $oPrice = $oBasket->getVoucherDiscount();
        $this->assertEquals( 40, $oPrice->getBruttoPrice() );
    }

    /**
     * Testing voucher discount getter - when voucher is value is percent.
     * Voucher discount value should be calculated after applying general discount
     */
    public function testGetVoucherDiscountWithPercentageVoucher()
    {
        $oDiscount = reset($this->aDiscounts);
        $oDiscount->oxdiscount__oxaddsumtype = new oxField('%', oxField::T_RAW);
        $oDiscount->oxdiscount__oxaddsum = new oxField(10, oxField::T_RAW);
        $oDiscount->save();

        $this->oVoucherSerie->oxvoucherseries__oxdiscounttype = new oxField('percent', oxField::T_RAW);
        $this->oVoucherSerie->save();

        $oBasket = new oxbasket();
        $oBasket->addToBasket( $this->oArticle->getId(), 10 );
        $oBasket->addToBasket( $this->oVariant->getId(), 10 );
        $oBasket->calculateBasket( false );

        $oVoucher = reset($this->aVouchers);
        $oBasket->addVoucher( $oVoucher->oxvouchers__oxvouchernr->value ); // 10 %

        $oBasket->calculateBasket( false );

        // basket price 380, total discount 10% (38), so voucher discount = (380 - 38) * 10% = 34.2
        $oPrice = $oBasket->getVoucherDiscount();
        $this->assertEquals( 34.2, $oPrice->getBruttoPrice() );
    }

    /**
     * Testing basket currency setter and getter
     */
    public function testSetAndGetBasketCurrency()
    {
        $oBasket = $this->getProxyClass( "oxBasket" );
        $oCur = new Oxstdclass();
        $oCur->name = 'testCurrencyName';
        $oCur->desc = 'testDescription';

        $oBasket->setBasketCurrency( $oCur );;

        $this->assertEquals( $oCur, $oBasket->getBasketCurrency() );
    }

    /**
     * Testing basket currency getter by default return active shop currency object
     */
    public function testGetBasketCurrencyByDefaultReturnsActiveShopCurrencyObject()
    {
        $oBasket = $this->getProxyClass( "oxBasket" );

        $oCur = oxConfig::getInstance()->getActShopCurrencyObject();
        $this->assertEquals( $oCur, $oBasket->getBasketCurrency() );
    }

    /**
     * Testing setter for skipping vouchers availability checking
     */
    public function testSetSkipVouchersChecking()
    {
        $oBasket = $this->getProxyClass( "oxBasket" );

        $oBasket->setSkipVouchersChecking( true );
        $this->assertTrue( $oBasket->getNonPublicVar( '_blSkipVouchersAvailabilityChecking' ));

        $oBasket->setSkipVouchersChecking( false );
        $this->assertFalse( $oBasket->getNonPublicVar( '_blSkipVouchersAvailabilityChecking' ));
    }

    /**
     * Testing basket discount calculation
     */
    public function testCalcBasketDiscount()
    {
        oxAddClassModule('modOxDiscountList_oxbasket', 'oxDiscountList');
        $oBasket = $this->getProxyClass( "oxBasket" );

        $oPrice = oxNew( "oxPrice" );
        $oPrice->setPrice( 20 );
        $oPriceList = oxNew( "oxPriceList" );
        $oPriceList->addToPriceList( $oPrice );

        $aDiscounts = $oBasket->setNonPublicVar( '_oDiscountProductsPriceList', $oPriceList );
        $oBasket->UNITcalcBasketDiscount();

        $aDiscounts = $oBasket->getNonPublicVar('_aDiscounts');

        $this->assertEquals( 1, count($aDiscounts) );

        //asserting second discount values
        $this->assertEquals( 'Test discount title 2', $aDiscounts['_testDiscountId2']->sDiscount );
        //checking 15 % discount (after first discount discountable items price = 20)
        $this->assertEquals( 3, $aDiscounts['_testDiscountId2']->dDiscount );
    }

    /**
     * Testing basket discount calculation FS#1675
     */
    public function testCalcBasketDiscountWithSpecialPrice()
    {
        oxAddClassModule('modOxDiscountList_oxbasket', 'oxDiscountList');
        $oBasket = $this->getProxyClass( "oxBasket" );

        $oPrice = oxNew( "oxPrice" );
        $oPrice->setPrice( 79.5 );
        $oPriceList = oxNew( "oxPriceList" );
        $oPriceList->addToPriceList( $oPrice );

        $aDiscounts = $oBasket->setNonPublicVar( '_oDiscountProductsPriceList', $oPriceList );
        $oBasket->UNITcalcBasketDiscount();

        $aDiscounts = $oBasket->getNonPublicVar('_aDiscounts');

        $this->assertEquals( 1, count($aDiscounts) );

        //asserting first discount values
        $this->assertEquals( 'Test discount title 2', $aDiscounts['_testDiscountId2']->sDiscount );
        //checking 15 % discount (discountable items price = 79.5)
        $this->assertEquals( 11.925, $aDiscounts['_testDiscountId2']->dDiscount, '', 0.0001 );
    }

    /**
     * Testing basket discount calculation when no discounts exists
     */
    public function testCalcBasketDiscountWithNoDiscounts()
    {
        $oBasket = $this->getProxyClass( "oxBasket" );

        $oPrice = oxNew( "oxPrice" );
        $oPrice->setPrice( 20 );
        $oPriceList = oxNew( "oxPriceList" );
        $oPriceList->addToPriceList( $oPrice );

        $aDiscounts = $oBasket->setNonPublicVar( '_oDiscountProductsPriceList', $oPriceList );
        $oBasket->UNITcalcBasketDiscount();

        $aDiscounts = $oBasket->getNonPublicVar('_aDiscounts');

        $this->assertEquals( 0, count($aDiscounts) );
    }

    /**
     * Testing total basket discount calculation
     */
    public function testCalcBasketTotalDiscount()
    {
        $oDiscount1 = new OxstdClass();
        $oDiscount1->dDiscount = 5;

        $oDiscount2 = new OxstdClass();
        $oDiscount2->dDiscount = 7;

        $oDiscount3 = new OxstdClass();
        $oDiscount3->dDiscount = 7;
        $oDiscount3->sType = 'itm';

        $aDiscounts[] = $oDiscount1;
        $aDiscounts[] = $oDiscount2;
        $aDiscounts[] = $oDiscount3;

        $oBasket = $this->getProxyClass( "oxBasket" );
        $oBasket->setNonPublicVar( '_aDiscounts', $aDiscounts );
        $oBasket->UNITcalcBasketTotalDiscount();

        $oTotalDiscount = $oBasket->getNonPublicVar( '_oTotalDiscount' );

        $this->assertEquals( 12, $oTotalDiscount->getBruttoPrice() );
    }

   /**
     * M#884 Testing total basket discount calculation before and after discount list update
     */
    public function testCalcBasketTotalDiscountAfterUpdate()
    {
        $oDiscount1 = new OxstdClass();
        $oDiscount1->dDiscount = 5;

        $oDiscount2 = new OxstdClass();
        $oDiscount2->dDiscount = 7;

        $aDiscounts[] = $oDiscount1;
        $aDiscounts[] = $oDiscount2;

        $oBasket = $this->getProxyClass( "oxBasket" );
        $oBasket->setNonPublicVar( '_aDiscounts', $aDiscounts );
        $oBasket->UNITcalcBasketTotalDiscount();

        $oTotalDiscount = $oBasket->getNonPublicVar( '_oTotalDiscount' );

        $this->assertEquals( 12, $oTotalDiscount->getBruttoPrice() );

        // remove one discount, and calculate again
        unset($aDiscounts[0]);

        $oBasket->setNonPublicVar( '_aDiscounts', $aDiscounts );
        $oBasket->UNITcalcBasketTotalDiscount();

        $oTotalDiscount = $oBasket->getNonPublicVar( '_oTotalDiscount' );

        $this->assertEquals( 7, $oTotalDiscount->getBruttoPrice() );
    }

   /**
     * M#884 Testing skipp of total basket discount calculation in Admin, after discount list was updated
     */
    public function testCalcBasketTotalDiscountAfterUpdateInAdminMode()
    {
        $oDiscount = new OxstdClass();
        $oDiscount->dDiscount = 50;

        $aDiscounts[] = $oDiscount;

        $oTotalDiscount = new oxPrice(100);

        $oBasket = $this->getProxyClass( "oxBasket" );
        $oBasket->setTotalDiscount( 100 );
        $oBasket->afterUpdate();

        $oBasket->setNonPublicVar( '_aDiscounts', $aDiscounts );
        $oBasket->UNITcalcBasketTotalDiscount();

        $oTotalDiscount = $oBasket->getNonPublicVar( '_oTotalDiscount' );

        $this->assertEquals( 100, $oTotalDiscount->getBruttoPrice() );
    }

    /**
     * Testing total basket discount calculation with no discount
     */
    public function testCalcBasketTotalDiscountWithNoDiscounts()
    {
        $aDiscounts = null;

        $oBasket = $this->getProxyClass( "oxBasket" );
        $oBasket->setNonPublicVar( '_aDiscounts', $aDiscounts );
        $oBasket->UNITcalcBasketTotalDiscount();

        $oTotalDiscount = $oBasket->getNonPublicVar( '_oTotalDiscount' );

        $this->assertEquals( 0, $oTotalDiscount->getBruttoPrice() );
    }


    public function testIfChangeBasketItemKeyCalledInAddToBasket()
    {
        $oBasket = $this->getMock( 'oxbasket', array( '_changeBasketItemKey' ) );
        $oBasket->expects( $this->never() )->method( '_changeBasketItemKey' );
        $oBasket->addToBasket($this->oArticle->getId(), 1, null, null, true, false);
        $oBasket->addToBasket($this->oArticle->getId(), 2, null, null, true, false);
        $oBasket = $this->getMock( 'oxbasket', array( '_changeBasketItemKey' ) );
        $oBasket->expects( $this->once() )->method( '_changeBasketItemKey' );
        $oBasket->addToBasket($this->oArticle->getId(), 1, null, null, true, false);
        $oBasket->addToBasket($this->oArticle->getId(), 1, null, null, true, false, $this->oArticle->getId());
        try {
            $oBasket->addToBasket('ra', 1, null, null, true, false, $this->oArticle->getId());
        }catch(oxNoArticleException $e) {//whatever.. we interested only before this func.
        }
    }
    public function testChangeBasketItemKey()
    {
        $oBasket = $this->getProxyClass( "oxBasket" );
        $arr1 = array('a' => 1, 'b' => 4, 'g' => 's', 'ds' => 'aaa');
        $arr2 = array('a' => 1, 'c' => 222, 'g' => 's', 'ds' => 'aaa');
        $oBasket->setNonPublicVar('_aBasketContents', $arr1);
        $oBasket->UNITchangeBasketItemKey('b', 'c', 222);
        $this->assertEquals($arr2, $oBasket->getNonPublicVar('_aBasketContents'));
        $arr2 = array('a' => 1, 'c' => 222, 'g' => 's', 'dsa' => null);
        $oBasket->UNITchangeBasketItemKey('ds', 'dsa');
        $this->assertEquals($arr2, $oBasket->getNonPublicVar('_aBasketContents'));
    }

    /**
     * Testing if reset functionality executes all dep. methods
     */
    public function testResetUserInfo()
    {
        $oBasket = $this->getMock( 'oxbasket', array( 'setPayment', 'setShipping' ) );
        $oBasket->expects( $this->once() )->method( 'setPayment' )->with( $this->equalTo( null ));
        $oBasket->expects( $this->once() )->method( 'setShipping' )->with( $this->equalTo( null ));
        $oBasket->resetUserInfo();
    }

    /**
     * Testing skip discounts marker setter/getter
     */
    public function testSetGetSkipDiscounts()
    {
        $oBasket = $this->getProxyClass( "oxBasket" );
        $oBasket->setSkipDiscounts( true );
        $this->assertTrue( $oBasket->hasSkipedDiscount() );
    }

    /**
     * Testing products net price getter
     */
    public function testGetProductsNetPrice()
    {
        $oBasket = $this->getMock( 'oxbasket', array( 'getDiscountedNettoPrice' ) );
        $oBasket->expects( $this->once() )->method( 'getDiscountedNettoPrice' )->will( $this->returnValue( 11.158 ) );
        $this->assertEquals( "11,16", $oBasket->getProductsNetPrice() );
    }

    /**
     * Testing formatted products price getter
     */
    public function testGetFProductsPrice()
    {
        $oPriceList = $this->getMock( 'oxpricelist', array( 'getBruttoSum' ) );
        $oPriceList->expects( $this->once() )->method( 'getBruttoSum' )->will( $this->returnValue( 11.158 ) );
        $oBasket = $this->getProxyClass( "oxBasket" );
        $oBasket->setNonPublicVar('_oProductsPriceList', $oPriceList);
        $this->assertEquals( "11,16", $oBasket->getFProductsPrice() );
    }

    /**
     * Testing formatted products price getter
     */
    public function testGetFProductsPriceIfPriceNotSet()
    {
        $oBasket = $this->getProxyClass( "oxBasket" );
        $this->assertNull( $oBasket->getFProductsPrice() );
    }

    /**
     * Testing delivery cost Vat getter
     */
    public function testGetDelCostVatPercent()
    {
        $oPrice = $this->getMock( 'oxprice', array( 'getVat' ) );
        $oPrice->expects( $this->once() )->method( 'getVat' )->will( $this->returnValue( 19 ) );
        $oBasket = $this->getProxyClass( "oxBasket" );
        $oBasket->setNonPublicVar('_aCosts', array ( "oxdelivery" => $oPrice ) );
        $this->assertEquals( 19, $oBasket->getDelCostVatPercent() );
    }

    /**
     * Testing formatted delivery vat value getter
     */
    public function testGetDelCostVat()
    {
        $oPrice = $this->getMock( 'oxprice', array( 'getVatValue' ) );
        $oPrice->expects( $this->once() )->method( 'getVatValue' )->will( $this->returnValue( 11.588 ) );
        $oBasket = $this->getProxyClass( "oxBasket" );
        $oBasket->setNonPublicVar('_aCosts', array ( "oxdelivery" => $oPrice ) );
        $this->assertEquals( "11,59", $oBasket->getDelCostVat() );
    }

    /**
     * Testing formatted delivery netto price getter
     */
    public function testGetDelCostNet()
    {
        $oPrice = $this->getMock( 'oxprice', array( 'getNettoPrice' ) );
        $oPrice->expects( $this->once() )->method( 'getNettoPrice' )->will( $this->returnValue( 11.588 ) );
        $oBasket = $this->getProxyClass( "oxBasket" );
        $oBasket->setNonPublicVar('_aCosts', array ( "oxdelivery" => $oPrice ) );
        $oBasket->setNonPublicVar('_oUser', true );
        $this->assertEquals( "11,59", $oBasket->getDelCostNet() );
    }

    /**
     * Testing formatted delivery netto price getter
     */
    public function testGetDelCostNetWithoutUser()
    {
        $oPrice = $this->getMock( 'oxprice', array( 'getNettoPrice' ) );
        $oPrice->expects( $this->any() )->method( 'getNettoPrice' )->will( $this->returnValue( 11.588 ) );
        $oBasket = $this->getProxyClass( "oxBasket" );
        $oBasket->setNonPublicVar('_aCosts', array ( "oxdelivery" => $oPrice ) );
        $oBasket->setNonPublicVar('_oUser', false );

        $this->assertFalse( $oBasket->getDelCostNet() );
    }

    /**
     * Testing formatted delivery netto price getter
     */
    public function testGetDelCostNetCalculateWithoutUser()
    {
        modConfig::getInstance()->setConfigParam( 'blCalculateDelCostIfNotLoggedIn', true );
        $oPrice = $this->getMock( 'oxprice', array( 'getNettoPrice' ) );
        $oPrice->expects( $this->once() )->method( 'getNettoPrice' )->will( $this->returnValue( 0 ) );
        $oBasket = $this->getProxyClass( "oxBasket" );
        $oBasket->setNonPublicVar('_aCosts', array ( "oxdelivery" => $oPrice ) );
        $oBasket->setNonPublicVar('_oUser', false );
        $this->assertEquals( "0,00", $oBasket->getDelCostNet() );
    }

    /**
     * Testing payment cost Vat getter
     */
    public function testGetPayCostVatPercent()
    {
        $oPrice = $this->getMock( 'oxprice', array( 'getVat' ) );
        $oPrice->expects( $this->once() )->method( 'getVat' )->will( $this->returnValue( 19 ) );
        $oBasket = $this->getProxyClass( "oxBasket" );
        $oBasket->setNonPublicVar('_aCosts', array ( "oxpayment" => $oPrice ) );
        $this->assertEquals( 19, $oBasket->getPayCostVatPercent() );
    }

    /**
     * Testing formatted payment vat value getter
     */
    public function testGetPayCostVat()
    {
        $oPrice = $this->getMock( 'oxprice', array( 'getVatValue' ) );
        $oPrice->expects( $this->once() )->method( 'getVatValue' )->will( $this->returnValue( 11.588 ) );
        $oBasket = $this->getProxyClass( "oxBasket" );
        $oBasket->setNonPublicVar('_aCosts', array ( "oxpayment" => $oPrice ) );
        $this->assertEquals( "11,59", $oBasket->getPayCostVat() );
    }

    /**
     * Testing formatted payment netto price getter
     */
    public function testGetPayCostNet()
    {
        $oPrice = $this->getMock( 'oxprice', array( 'getNettoPrice' ) );
        $oPrice->expects( $this->once() )->method( 'getNettoPrice' )->will( $this->returnValue( 11.588 ) );
        $oBasket = $this->getProxyClass( "oxBasket" );
        $oBasket->setNonPublicVar('_aCosts', array ( "oxpayment" => $oPrice ) );
        $this->assertEquals( "11,59", $oBasket->getPayCostNet() );
    }

    /**
     * Testing payment brutto price getter
     */
    public function testGetPaymentCosts()
    {
        $oPrice = $this->getMock( 'oxprice', array( 'getBruttoPrice' ) );
        $oPrice->expects( $this->once() )->method( 'getBruttoPrice' )->will( $this->returnValue( 11.588 ) );
        $oBasket = $this->getProxyClass( "oxBasket" );
        $oBasket->setNonPublicVar('_aCosts', array ( "oxpayment" => $oPrice ) );
        $this->assertEquals( 11.588, $oBasket->getPaymentCosts() );
    }

    /**
     * Testing voucher discount getter
     */
    public function testGetVoucherDiscValue()
    {
        $oPrice = $this->getMock( 'oxprice', array( 'getBruttoPrice' ) );
        $oPrice->expects( $this->once() )->method( 'getBruttoPrice' )->will( $this->returnValue( 11.588 ) );
        $oBasket = $this->getProxyClass( "oxBasket" );
        $oBasket->setNonPublicVar('_oVoucherDiscount', $oPrice );
        $this->assertEquals( 11.588, $oBasket->getVoucherDiscValue() );
    }

    /**
     * Testing voucher discount getter
     */
    public function testGetVoucherDiscValueIfNotSet()
    {
        $oBasket = $this->getProxyClass( "oxBasket" );
        $this->assertFalse( $oBasket->getVoucherDiscValue() );
    }

    /**
     * Testing wrapping cost Vat getter
     */
    public function testGetWrappCostVatPercent()
    {
        $oPrice = $this->getMock( 'oxprice', array( 'getVat' ) );
        $oPrice->expects( $this->once() )->method( 'getVat' )->will( $this->returnValue( 19 ) );
        $oBasket = $this->getProxyClass( "oxBasket" );
        $oBasket->setNonPublicVar('_aCosts', array ( "oxwrapping" => $oPrice ) );
        $this->assertEquals( 19, $oBasket->getWrappCostVatPercent() );
    }

    /**
     * Testing formatted wrapping vat value getter
     */
    public function testGetWrappCostVat()
    {
        $oPrice = $this->getMock( 'oxprice', array( 'getVatValue' ) );
        $oPrice->expects( $this->once() )->method( 'getVatValue' )->will( $this->returnValue( 11.588 ) );
        $oBasket = $this->getProxyClass( "oxBasket" );
        $oBasket->setNonPublicVar('_aCosts', array ( "oxwrapping" => $oPrice ) );
        $this->assertEquals( "11,59", $oBasket->getWrappCostVat() );
    }

    /**
     * Testing formatted wrapping netto price getter
     */
    public function testGetWrappCostNet()
    {
        $oPrice = $this->getMock( 'oxprice', array( 'getNettoPrice' ) );
        $oPrice->expects( $this->once() )->method( 'getNettoPrice' )->will( $this->returnValue( 11.588 ) );
        $oBasket = $this->getProxyClass( "oxBasket" );
        $oBasket->setNonPublicVar('_aCosts', array ( "oxwrapping" => $oPrice ) );
        $this->assertEquals( "11,59", $oBasket->getWrappCostNet() );
    }

    /**
     * Testing formatted basket total price
     */
    public function testGetFPrice()
    {
        $oPrice = $this->getMock( 'oxprice', array( 'getBruttoPrice' ) );
        $oPrice->expects( $this->once() )->method( 'getBruttoPrice' )->will( $this->returnValue( 11.588 ) );
        $oBasket = $this->getProxyClass( "oxBasket" );
        $oBasket->setNonPublicVar('_oPrice', $oPrice );
        $this->assertEquals( "11,59", $oBasket->getFPrice() );
    }

    /**
     * Testing formatted delivery price getter
     */
    public function testGetFDeliveryCosts()
    {
        $oPrice = $this->getMock( 'oxprice', array( 'getBruttoPrice' ) );
        $oPrice->expects( $this->any() )->method( 'getBruttoPrice' )->will( $this->returnValue( 11.588 ) );
        $oBasket = $this->getProxyClass( "oxBasket" );
        $oBasket->setNonPublicVar('_aCosts', array ( "oxdelivery" => $oPrice ) );
        $this->assertEquals( "11,59", $oBasket->getFDeliveryCosts() );
    }

    /**
     * Testing formatted delivery price getter
     */
    public function testGetFDeliveryCostsSetToZero()
    {
        $oPrice = $this->getMock( 'oxprice', array( 'getBruttoPrice' ) );
        $oPrice->expects( $this->any() )->method( 'getBruttoPrice' )->will( $this->returnValue( 0 ) );
        $oBasket = $this->getProxyClass( "oxBasket" );
        $oBasket->setNonPublicVar('_aCosts', array ( "oxdelivery" => $oPrice ) );
        $this->assertFalse( $oBasket->getFDeliveryCosts() );
    }

    /**
     * Testing formatted delivery price getter
     */
    public function testGetFDeliveryCostsIfNotSet()
    {
        $oBasket = $this->getProxyClass( "oxBasket" );
        $this->assertFalse( $oBasket->getFDeliveryCosts() );
    }

    /**
     * Testing delivery price getter
     */
    public function testGetDeliveryCosts()
    {
        $oPrice = $this->getMock( 'oxprice', array( 'getBruttoPrice' ) );
        $oPrice->expects( $this->once() )->method( 'getBruttoPrice' )->will( $this->returnValue( 11.588 ) );
        $oBasket = $this->getProxyClass( "oxBasket" );
        $oBasket->setNonPublicVar('_aCosts', array ( "oxdelivery" => $oPrice ) );
        $this->assertEquals( 11.588, $oBasket->getDeliveryCosts() );
    }
    public function testGetDeliveryCostsIfNotSet()
    {
        $oBasket = $this->getProxyClass( "oxBasket" );
        $this->assertFalse( $oBasket->getDeliveryCosts() );
    }

    /**
     * Testing total discount getter
     */
    public function testGetTotalDiscount()
    {
        $oPrice = $this->getMock( 'oxprice', array( 'getBruttoPrice' ) );
        $oPrice->expects( $this->once() )->method( 'getBruttoPrice' )->will( $this->returnValue( 11.588 ) );
        $oBasket = $this->getProxyClass( "oxBasket" );
        $oBasket->setNonPublicVar('_oTotalDiscount', $oPrice );
        $this->assertEquals( 11.588, $oBasket->getTotalDiscount()->getBruttoPrice() );
    }

    /**
     * Testing getting basket price for payment costs calculations
     * (M:1190, M:1145)
     */
    public function testGetPriceForPayment()
    {
        $oProductsPrice = $this->getMock( 'oxPriceList', array( 'getBruttoSum' ) );
        $oProductsPrice->expects( $this->once() )->method( 'getBruttoSum' )->will( $this->returnValue( 100 ) );

        $oVoucher = $this->getMock( 'oxPrice', array( 'getBruttoPrice' ) );
        $oVoucher->expects( $this->once() )->method( 'getBruttoPrice' )->will( $this->returnValue( 40 ) );

        $oBasket = $this->getMock( 'oxBasket', array( 'getDiscountProductsPrice', 'getVoucherDiscount' ) );
        $oBasket->expects( $this->once() )->method( 'getDiscountProductsPrice' )->will( $this->returnValue( $oProductsPrice ) );
        $oBasket->expects( $this->once() )->method( 'getVoucherDiscount' )->will( $this->returnValue( $oVoucher ) );

        $oBasket->setCost('oxpayment', new oxPrice( 30 ) );
        $oBasket->setCost('oxdelivery', new oxPrice( 25 ) );

        //final price  = products price - voucher + delivery cost (100 - 40 + 25)
        //payment costs should not be included
        $this->assertEquals( 85, $oBasket->getPriceForPayment() );
    }

    /**
     * Testing getting formatted payment cost
     */
    public function testGetFPaymentCosts()
    {
        $oPrice = $this->getMock( 'oxprice', array( 'getBruttoPrice' ) );
        $oPrice->expects( $this->any() )->method( 'getBruttoPrice' )->will( $this->returnValue( 10.992 ) );

        $oBasket = $this->getMock( 'oxbasket', array( 'getCosts' ) );
        $oBasket->expects( $this->once() )->method( 'getCosts' )->will( $this->returnValue( $oPrice ) );

        $this->assertEquals( "10,99", $oBasket->getFPaymentCosts() );
    }

    /**
     * Testing getting formatted payment cost when cost is not setted
     */
    public function testGetFPaymentCosts_noCost()
    {
        $oBasket = $this->getMock( 'oxbasket', array( 'getCosts' ) );
        $oBasket->expects( $this->once() )->method( 'getCosts' )->will( $this->returnValue( false ) );

        $this->assertFalse( $oBasket->getFPaymentCosts() );
    }

    /**
     * Testing getting formatted payment cost when cost = 0
     */
    public function testGetFPaymentCosts_zeroValue()
    {
        $oPrice = $this->getMock( 'oxprice', array( 'getBruttoPrice' ) );
        $oPrice->expects( $this->any() )->method( 'getBruttoPrice' )->will( $this->returnValue( 0 ) );

        $oBasket = $this->getMock( 'oxbasket', array( 'getCosts' ) );
        $oBasket->expects( $this->once() )->method( 'getCosts' )->will( $this->returnValue( $oPrice ) );

        $this->assertFalse( $oBasket->getFPaymentCosts() );
    }

    /**
     * Testing getting formatted wrapping cost
     */
    public function testGetFWrappingCosts()
    {
        $oPrice = $this->getMock( 'oxprice', array( 'getBruttoPrice' ) );
        $oPrice->expects( $this->any() )->method( 'getBruttoPrice' )->will( $this->returnValue( 10.992 ) );

        $oBasket = $this->getMock( 'oxbasket', array( 'getCosts' ) );
        $oBasket->expects( $this->once() )->method( 'getCosts' )->will( $this->returnValue( $oPrice ) );

        $this->assertEquals( "10,99", $oBasket->getFWrappingCosts() );
    }

    /**
     * Testing getting formatted wrapping cost when cost is not setted
     */
    public function testGetFWrappingCosts_noCost()
    {
        $oBasket = $this->getMock( 'oxbasket', array( 'getCosts' ) );
        $oBasket->expects( $this->once() )->method( 'getCosts' )->will( $this->returnValue( false ) );

        $this->assertFalse( $oBasket->getFWrappingCosts() );
    }

    /**
     * Testing getting formatted wrapping cost when cost = 0
     */
    public function testGetFWrappingCosts_zeroValue()
    {
        $oPrice = $this->getMock( 'oxprice', array( 'getBruttoPrice' ) );
        $oPrice->expects( $this->any() )->method( 'getBruttoPrice' )->will( $this->returnValue( 0 ) );

        $oBasket = $this->getMock( 'oxbasket', array( 'getCosts' ) );
        $oBasket->expects( $this->once() )->method( 'getCosts' )->will( $this->returnValue( $oPrice ) );

        $this->assertFalse( $oBasket->getFWrappingCosts() );
    }

    /**
     * Testing getting formatted wrapping cost
     */
    public function testGetArtStockInBasket()
    {
        // simulating basket contents
        $oBasketItem = new oxbasketitem();
        $oBasketItem->init( $this->oArticle->getId(), 1, null, null, true );
        $oBasketItem2 = new oxbasketitem();
        $oBasketItem2->init( $this->oArticle->getId(), 2 );

        $oBasket = $this->getProxyClass( "oxBasket" );
        $oBasket->setNonPublicVar( '_aBasketContents', array("_testItem" => $oBasketItem, "_testItem2" => $oBasketItem2) );

        $this->assertEquals( 3, $oBasket->getArtStockInBasket( $this->oArticle->getId()) );
        $this->assertEquals( 1, $oBasket->getArtStockInBasket( $this->oArticle->getId(), "_testItem2") );
    }
}