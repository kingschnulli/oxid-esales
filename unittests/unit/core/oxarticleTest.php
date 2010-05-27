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
 * @version   SVN: $Id: oxarticleTest.php 27939 2010-05-26 11:53:19Z arvydas $
 */

require_once realpath( "." ).'/unit/OxidTestCase.php';
require_once realpath( "." ).'/unit/test_config.inc.php';

/**
 * Test oxUtils module
 */
class modUtils_oxarticlelist extends oxutils
{
    /**
     * Force isSearchEngine.
     *
     * @param string $sClient Client
     *
     * @return boolean
     */
    public function isSearchEngine( $sClient = null )
    {
        return true;
    }
}

/**
 * Test oxArticle module
 */
class _oxArticle extends oxArticle
{
    public $iMaxSimilarForCacheReset = 100;

    /**
     * Consuctor
     *
     * @param array $aParams Parameters
     *
     * @return null
     */
    public function __construct($aParams = null )
    {
        $this->resetVar();
        parent::__construct( $aParams );
    }

    /**
     * Get private field value.
     *
     * @param string $sName Field name
     *
     * @return mixed
     */
    public function getVar( $sName )
    {
        return $this->{'_'.$sName};
    }

    /**
     * Set private field value.
     *
     * @param string $sName  Field name
     * @param string $sValue Field value
     *
     * @return null
     */
    public function setVar( $sName, $sValue )
    {
        $this->{'_'.$sName} = $sValue;
    }

    /**
     * Clean private variable values.
     *
     * @return null
     */
    public function resetVar()
    {
        parent::$_aLoadedParents = null;
        parent::$_aSelList = null;
    }

    /**
     * Reset cached private variable values.
     *
     * @return null
     */
    public static function resetCache()
    {
        self::$_aArticleVendors = array();
        self::$_aArticleManufacturers = array();
    }
}

/**
 * Test oxUtilsObject module.
 */
class modUtilsObject_oxarticle extends oxUtilsObject
{
    /**
     * Allways geneates given uid.
     *
     * @return string
     */
    public function generateUID()
    {
        return 'test';
    }
}


/**
 * Testing oxArticle class.
 */
class Unit_Core_oxarticleTest extends OxidTestCase
{
    public $oArticle  = null;
    public $oArticle2 = null;

    /**
     * Initialize the fixture.
     *
     * @return null
     */
    protected function setUp()
    {
        parent::setUp();

        $this->cleanUpTable( 'oxobject2category' );

        $this->oArticle = $this->getProxyClass('oxarticle');
        $this->oArticle->setAdminMode( null );

        //$this->oArticle->disableLazyLoading();
        $this->oArticle->modifyCacheKey(null, false);
        $this->oArticle->load('_testArt');

        $this->oArticle->setId('_testArt');
        $this->oArticle->oxarticles__oxprice = new oxField(15.5, oxField::T_RAW);
        $this->oArticle->oxarticles__oxshopid = new oxField(oxConfig::getInstance()->getBaseShopId(), oxField::T_RAW);
        $this->oArticle->oxarticles__oxshopincl = new oxField(oxConfig::getInstance()->getBaseShopId(), oxField::T_RAW);
        $this->oArticle->oxarticles__oxtitle = new oxField("test", oxField::T_RAW);
        $this->oArticle->save();

        // reloading
        //$this->oArticle = $this->getProxyClass('oxarticle');
        //$this->oArticle->load('_testArt');


        $this->oArticle2 = $this->getProxyClass('oxarticle');
        $this->oArticle2->setAdminMode( null );
        //$this->oArticle2->disableLazyLoading();
        $this->oArticle2->modifyCacheKey(null, false);
        //$myDB->execute( "insert into oxarticles (oxid, oxprice, oxshopid, oxshopincl, oxparentid, oxtitle, oxtitle_1)
        //                                values ('_testVar', 12.2, 1, 1, '_testArt', 'test', 'testEng')  " );
        $this->oArticle2->load('_testVar');
        $this->oArticle2->setId('_testVar');
        $this->oArticle2->oxarticles__oxprice = new oxField(12.2, oxField::T_RAW);
        $this->oArticle2->oxarticles__oxshopid = new oxField(oxConfig::getInstance()->getBaseShopId(), oxField::T_RAW);
        $this->oArticle2->oxarticles__oxshopincl = new oxField(oxConfig::getInstance()->getBaseShopId(), oxField::T_RAW);
        $this->oArticle2->oxarticles__oxparentid = new oxField($this->oArticle->oxarticles__oxid->value, oxField::T_RAW);
        $this->oArticle2->oxarticles__oxtitle = new oxField("test", oxField::T_RAW);
        $this->oArticle2->oxarticles__oxtitle_1 = new oxField("testEng", oxField::T_RAW);

        $this->oArticle2->save();

        // reloading
        //$this->oArticle2 = $this->getProxyClass('oxarticle');
        //$this->oArticle2->load('_testVar');

        //$this->__oldRR = oxConfig::getInstance()->getConfigParam('blUseRightsRoles');
        modConfig::getInstance()->setConfigParam( 'blUseRightsRoles', 3 );
        modConfig::getInstance()->setConfigParam( 'blUseTimeCheck', true );
    }

    /**
     * Tear down the fixture.
     *
     * @return null
     */
    protected function tearDown()
    {
        modDb::getInstance()->cleanup();
        modConfig::getInstance();
        _oxArticle::resetCache();

        oxConfig::getInstance()->setGlobalParameter( 'listtype', null );

        oxRemClassModule( 'modCacheForArticleTest' );
        oxRemClassModule( 'modUtils_oxarticlelist' );
        oxRemClassModule( 'modUtilsObject_oxarticle' );
        $this->cleanUpTable('oxobject2attribute');

        // ensure modules detached
        oxTestModules::cleanAllModules();

        $myDB = oxDb::getDB();
        $myDB->execute( 'delete from oxaccessoire2article where oxarticlenid="_testArt" ' );

        if ( $this->oArticle ) {
            $this->oArticle->delete();
        }
        if ( $this->oArticle2 ) {
            $this->oArticle2->delete();
        }

        //$myDB->execute( 'delete from oxarticles where oxid="_testArt2" ' );
        //$myDB->execute( 'delete from oxcategories where oxid="_testCat" ' );
        //$myDB->execute( 'delete from oxorderarticles where oxid="_testId" or oxid="_testId2"' );

        $this->cleanUpTable('oxarticles');
        $this->cleanUpTable('oxartextends');
        $this->cleanUpTable('oxcategories');
        $this->cleanUpTable('oxorderarticles');
        $this->cleanUpTable('oxprice2article');

        $myDB->execute( 'delete from oxreviews where oxid like "test%" ' );
        $myDB->execute( 'delete from oxseo where oxtype != "static"' );
        $myDB->Execute( 'delete from oxselectlist where oxid = "oxsellisttest" ');
        $myDB->Execute( 'delete from oxobject2selectlist where oxselnid = "oxsellisttest" ');
        $myDB->Execute( 'delete from oxattribute where oxid like "test%" ');
        $myDB->Execute( 'delete from oxobject2attribute where oxid like "test%" or oxobjectid like "_test%" ');
        $this->cleanUpTable( 'oxobject2category' );

        $this->cleanUpTable('oxdiscount');

        parent::tearDown();
    }

    /**
     * Test case for bugtrack report #1782
     *
     * @return null
     */
    public function testForBugReport1782()
    {
        $sPrefix = '';

        $sIconUrl = oxConfig::getInstance()->getConfigParam( "sShopURL" )."out/pictures{$sPrefix}/icon/nopic_ico.jpg";
        $this->assertEquals( $sIconUrl, $this->oArticle->getIconUrl() );
    }

    /**
     * Test get price with given amount.
     *
     * @return null
     */
    public function testGetPriceWithGivenAmount()
    {
        // assign scale price Amount 2-2 Price 11.95
        $oPrice2Prod = new oxBase();
        $oPrice2Prod->init( 'oxprice2article' );
        $oPrice2Prod->setId( '_testPrice2article' );
        $oPrice2Prod->oxprice2article__oxshopid   = new oxField( oxConfig::getInstance()->getBaseShopId() );
        $oPrice2Prod->oxprice2article__oxartid    = new oxField( "1126" );
        $oPrice2Prod->oxprice2article__oxaddabs   = new oxField( 17 );
        $oPrice2Prod->oxprice2article__oxamount   = new oxField( 2 );
        $oPrice2Prod->oxprice2article__oxamountto = new oxField( 2 );
        $oPrice2Prod->save();

        $oProduct = new oxArticle();
        $oProduct->load( "1126" );

        $this->assertEquals( 34, $oProduct->getPrice()->getBruttoPrice() );
        $this->assertEquals( 17, $oProduct->getPrice( 2 )->getBruttoPrice() );
    }

    /**
     * Test set base seo and main links.
     *
     * @return null
     */
    public function testSetBaseSeoLinkMainLink()
    {
        oxTestModules::addFunction("oxSeoEncoderArticle", "getArticleUrl", "{return 'sArticleUrl';}");
        oxTestModules::addFunction("oxSeoEncoderArticle", "getArticleMainUrl", "{return 'sArticleMainUrl';}");

        $oProduct = new oxArticle();
        $this->assertEquals( "sArticleMainUrl", $oProduct->getBaseSeoLink( 0, true ) );
    }

    /**
     * Test set base seo link.
     *
     * @return null
     */
    public function testSetBaseSeoLink()
    {
        oxTestModules::addFunction("oxSeoEncoderArticle", "getArticleUrl", "{return 'sArticleUrl';}");
        oxTestModules::addFunction("oxSeoEncoderArticle", "getArticleMainUrl", "{return 'sArticleMainUrl';}");

        $oProduct = new oxArticle();
        $this->assertEquals( "sArticleUrl", $oProduct->getBaseSeoLink( 0 ) );
    }

    /**
     * Test get base standard link.
     *
     * @return null
     */
    public function testGetBaseStdLink()
    {
        $iLang = 0;

        $oProduct = new oxArticle();
        $oProduct->setId( "testProdId" );

        $sTestUrl = oxConfig::getInstance()->getShopHomeUrl( $iLang, false ) . "cl=details&amp;anid=".$oProduct->getId();
        $this->assertEquals( $sTestUrl, $oProduct->getBaseStdLink( $iLang ) );
    }

    /**
     * Test append standard link.
     *
     * @return null
     */
    public function testAppendStdLink()
    {
        $oArticle = new oxarticle();
        $oArticle->setId( "testArticleId" );

        $oArticle->appendStdLink( "param1=value1&amp;param2=value2" );
        $this->assertEquals( oxConfig::getInstance()->getShopHomeURL( 0, false ) . "cl=details&amp;anid=testArticleId&amp;param1=value1&amp;param2=value2", $oArticle->getStdLink() );
    }

    /**
     * Test get main link with seo on.
     *
     * @return null
     */
    public function testGetMainLinkSeoOn()
    {
        oxTestModules::addFunction("oxutils", "seoIsActive", "{return true;}");
        $sUrl = oxConfig::getInstance()->getShopUrl();

        $sMainLink = $sUrl."Geschenke/Bar-Equipment/Bar-Set-ABSINTH.html";

        $oArticle = new oxArticle();
        $oArticle->load( "1126" );
        $this->assertEquals( $sMainLink, $oArticle->getMainLink() );
    }

    /**
     * Test get main link with seo off.
     *
     * @return null
     */
    public function testGetMainLinkSeoOff()
    {
        oxTestModules::addFunction("oxutils", "seoIsActive", "{return false;}");
        $sUrl = oxConfig::getInstance()->getShopUrl();
        $sMainLink = $sUrl."index.php?cl=details&amp;anid=1126";

        $oArticle = new oxArticle();
        $oArticle->load( "1126" );
        $this->assertEquals( $sMainLink, $oArticle->getMainLink() );
    }

    /**
     * Test get table name for active snippet core table.
     *
     * @return null
     */
    public function testGetTableNameForActiveSnippetCoreTable()
    {
        $oArticle = new oxarticle();
        $this->assertEquals( "oxarticles", $oArticle->getTableNameForActiveSnippet( true ) );
    }


    /**
     * Test get active check query.
     *
     * @return null
     */
    public function testGetActiveCheckQuery()
    {
        modConfig::getInstance()->setConfigParam( 'blUseTimeCheck', true );
        oxTestModules::addFunction("oxUtilsDate", "getTime", "{return 0;}");
        $sDate = date( 'Y-m-d H:i:s', oxUtilsDate::getInstance()->getTime() );

        $oArticle = new oxarticle();
        $sTable = $oArticle->getViewName();

        $sQ = "(  $sTable.oxactive = 1  or ( $sTable.oxactivefrom < '$sDate' and $sTable.oxactiveto > '$sDate' ) ) ";
        $this->assertEquals( $sQ, $oArticle->getActiveCheckQuery() );
    }

    /**
     * Test get stock check query.
     *
     * @return null
     */
    public function testGetStockCheckQuery()
    {
        modConfig::getInstance()->setConfigParam( 'blUseStock', true );
        modConfig::getInstance()->setConfigParam( 'blVariantParentBuyable', false );
        modConfig::getInstance()->setConfigParam( 'blUseTimeCheck', true );
        oxTestModules::addFunction("oxUtilsDate", "getTime", "{return 0;}");
        $sDate = date( 'Y-m-d H:i:s', oxUtilsDate::getInstance()->getTime() );

        $oArticle = new oxarticle();
        $sTable = $oArticle->getViewName();

        $sTimeCheckQ = " or ( art.oxactivefrom < '$sDate' and art.oxactiveto > '$sDate' )";
        $sQ = " and ( $sTable.oxstockflag != 2 or ( $sTable.oxstock + $sTable.oxvarstock ) > 0  ) ";
        $sQ = " $sQ and IF( $sTable.oxvarcount = 0, 1, ( select 1 from $sTable as art where art.oxparentid=$sTable.oxid and ( art.oxactive = 1 $sTimeCheckQ ) and ( art.oxstockflag != 2 or art.oxstock > 0 ) limit 1 ) ) ";

        $this->assertEquals( $sQ, $oArticle->getStockCheckQuery() );
    }

    /**
     * Test get variants query with disabled stock usage
     *
     * @return null
     */
    public function testGetVariantsQueryNoStockUsage()
    {
        modConfig::getInstance()->setConfigParam( 'blUseStock', false );

        $oArticle = new oxarticle();
        $sTable = $oArticle->getViewName();

        $sQ  = " and $sTable.oxparentid = '".$oArticle->getId()."' ";
        $this->assertEquals( $sQ, $oArticle->getVariantsQuery( true ) );
    }

    /**
     * Test get variants query , hide non orderable.
     *
     * @return null
     */
    public function testGetVariantsQueryHideNonorderable()
    {
        modConfig::getInstance()->setConfigParam( 'blUseStock', true );

        $oArticle = new oxarticle();
        $sTable = $oArticle->getViewName();

        $sQ  = " and $sTable.oxparentid = '".$oArticle->getId()."' ";
        $sQ .= " and ( $sTable.oxstock > 0 or ( $sTable.oxstock <= 0 and $sTable.oxstockflag != 2  and $sTable.oxstockflag != 3  ) ) ";
        $this->assertEquals( $sQ, $oArticle->getVariantsQuery( true ) );
    }

    /**
     * Test get variants query, show non orderable.
     *
     * @return null
     */
    public function testGetVariantsQueryShowNonorderable()
    {
        modConfig::getInstance()->setConfigParam( 'blUseStock', true );

        $oArticle = new oxarticle();
        $sTable = $oArticle->getViewName();

        $sQ  = " and $sTable.oxparentid = '".$oArticle->getId()."' ";
        $sQ .= " and ( $sTable.oxstock > 0 or ( $sTable.oxstock <= 0 and $sTable.oxstockflag != 2  ) ) ";
        $this->assertEquals( $sQ, $oArticle->getVariantsQuery( false ) );
    }

    /**
     * Test if has any variant.
     *
     * @return null
     */
    public function testHasAnyVariant()
    {
        $this->assertTrue( $this->oArticle->UNIThasAnyVariant() );
        $this->assertFalse( $this->oArticle2->UNIThasAnyVariant() );
    }

    /**
     * Test get variants.
     *
     * The Parameter $blRemoveNotOrderables is ignored when the variant list is already cached in $_aVariants.
     *
     * @return null
     */
    public function testGetVariantsForUseCase()
    {
        modConfig::getInstance()->setConfigParam( 'blUseStock', 1 );

        $iShopId = oxConfig::getInstance()->getShopId();

        // parent
        $oParent = new oxarticle();
        $oParent->setId( "_testParentArticleId" );
        $oParent->oxarticles__oxshopid = new oxField( $iShopId );
        $oParent->oxarticles__oxactive = new oxField( 1 );
        $oParent->save();

        // non buyable due to low stock
        $oVar1 = new oxarticle();
        $oVar1->setId( "_testVar1" );
        $oVar1->oxarticles__oxparentid = new oxField( $oParent->getId() );
        $oVar1->oxarticles__oxshopid = new oxField( $iShopId );
        $oVar1->oxarticles__oxactive = new oxField( 1 );
        $oVar1->oxarticles__oxstock  = new oxField( 0 );
        $oVar1->oxarticles__oxstockflag  = new oxField( 3 );
        $oVar1->save();

        // buyable
        $oVar2 = new oxarticle();
        $oVar2->setId( "_testVar2" );
        $oVar2->oxarticles__oxparentid = new oxField( $oParent->getId() );
        $oVar2->oxarticles__oxshopid = new oxField( $iShopId );
        $oVar2->oxarticles__oxactive = new oxField( 1 );
        $oVar2->oxarticles__oxstock  = new oxField( 1 );
        $oVar2->save();

        $this->assertEquals( 1, count( $oParent->getVariants( true ) ) );
        $this->assertEquals( 2, count( $oParent->getVariants( false ) ) );
    }



    /**
     * Test get sql active snippet if parent will be loaded on special its variants setup.
     *
     * @return null
     */
    public function testGetSqlActiveSnippetIfParentWillBeLoadedOnSpecialItsVariantsSetup()
    {
        $sArticleId = '_testArticleId';
        $sShopId    = oxConfig::getInstance()->getShopId();

        $oArticle = new oxArticle();

            $sTable = $oArticle->getCoreTableName();

        $oDb = oxDb::getdb();

        modConfig::getInstance()->setConfigParam( "blUseTimeCheck", 0 );
        modConfig::getInstance()->setConfigParam( "blUseStock", 0 );
        modConfig::getInstance()->setConfigParam( "blVariantParentBuyable", 0 );

        // just some inactive article
        $oArticle = new oxArticle();
        $oArticle->setId( $sArticleId );
        $oArticle->oxarticles__oxshopid = new oxField( $sShopId );
        $oArticle->oxarticles__oxactive = new oxField( 0 );
        $oArticle->save();

        $sQ = "select 1 from ($sTable) where oxid='{$sArticleId}' and " . $oArticle->getSqlActiveSnippet();
        $this->assertFalse( $oDb->getOne( $sQ ) );

        // regular active product
        $oArticle->oxarticles__oxactive = new oxField( 1 );
        $oArticle->save();

        $sQ = "select 1 from ($sTable) where oxid='{$sArticleId}' and " . $oArticle->getSqlActiveSnippet();
        $this->assertEquals( "1", $oDb->getOne( $sQ ) );

        modConfig::getInstance()->setConfigParam( "blUseTimeCheck", 1 );
        modConfig::getInstance()->setConfigParam( "blUseStock", 0 );
        modConfig::getInstance()->setConfigParam( "blVariantParentBuyable", 0 );

        $iCurrTime = oxUtilsDate::getInstance()->getTime();

        // regular active product by time range
        $oArticle->oxarticles__oxactive = new oxField( 0 );
        $oArticle->oxarticles__oxactivefrom = new oxField( date( 'Y-m-d H:i:s', $iCurrTime - 3600 ) );
        $oArticle->oxarticles__oxactiveto   = new oxField( date( 'Y-m-d H:i:s', $iCurrTime + 3600 ) );
        $oArticle->save();

        $sQ = "select 1 from ($sTable) where oxid='{$sArticleId}' and " . $oArticle->getSqlActiveSnippet();
        $this->assertEquals( "1", $oDb->getOne( $sQ ) );

        // stock check is on
        modConfig::getInstance()->setConfigParam( "blUseTimeCheck", 1 );
        modConfig::getInstance()->setConfigParam( "blUseStock", 1 );
        modConfig::getInstance()->setConfigParam( "blVariantParentBuyable", 0 );

        // stock = 0, stock flag = 2
        $oArticle->oxarticles__oxstock = new oxField( 0 );
        $oArticle->oxarticles__oxstockflag = new oxField( 2 );
        $oArticle->save();

        $sQ = "select 1 from ($sTable) where oxid='{$sArticleId}' and " . $oArticle->getSqlActiveSnippet();
        $this->assertFalse( $oDb->getOne( $sQ ) );

        // stock > 0, stock flag = 2
        $oArticle->oxarticles__oxstock = new oxField( 1 );
        $oArticle->oxarticles__oxstockflag = new oxField( 2 );
        $oArticle->save();

        $sQ = "select 1 from ($sTable) where oxid='{$sArticleId}' and " . $oArticle->getSqlActiveSnippet();
        $this->assertEquals( "1", $oDb->getOne( $sQ ) );

        // has 2 active variants, but parent itself is not buyable
        $oVar1 = new oxarticle();
        $oVar1->setId( '_testVariant1' );
        $oVar1->oxarticles__oxshopid = new oxField( $sShopId );
        $oVar1->oxarticles__oxactive = new oxField( 1 );
        $oVar1->oxarticles__oxstock = new oxField( 1 );
        $oVar1->oxarticles__oxparentid = new oxField( $oArticle->getId() );
        $oVar1->save();

        $oVar2 = new oxarticle();
        $oVar2->setId( '_testVariant2' );
        $oVar2->oxarticles__oxshopid = new oxField( $sShopId );
        $oVar2->oxarticles__oxactive = new oxField( 1 );
        $oVar2->oxarticles__oxstock = new oxField( 1 );
        $oVar2->oxarticles__oxparentid = new oxField( $oArticle->getId() );
        $oVar2->save();

        $sQ = "select 1 from ($sTable) where oxid='{$sArticleId}' and " . $oArticle->getSqlActiveSnippet();
        $this->assertEquals( "1", $oDb->getOne( $sQ ) );

        // has no active variants (2 inactive)
        $oVar1->oxarticles__oxactive = new oxField( 0 );
        $oVar1->save();

        $oVar2->oxarticles__oxactive = new oxField( 0 );
        $oVar2->save();

        $sQ = "select 1 from ($sTable) where oxid='{$sArticleId}' and " . $oArticle->getSqlActiveSnippet();
        $this->assertFalse( $oDb->getOne( $sQ ) );

        // has 2 active variants and parent itself is buyable
        modConfig::getInstance()->setConfigParam( "blUseTimeCheck", 1 );
        modConfig::getInstance()->setConfigParam( "blUseStock", 1 );
        modConfig::getInstance()->setConfigParam( "blVariantParentBuyable", 1 );

        $oVar1->oxarticles__oxactive = new oxField( 1 );
        $oVar1->save();

        $oVar2->oxarticles__oxactive = new oxField( 1 );
        $oVar2->save();

        $sQ = "select 1 from ($sTable) where oxid='{$sArticleId}' and " . $oArticle->getSqlActiveSnippet();
        $this->assertEquals( "1", $oDb->getOne( $sQ ) );

        // has no active variants and parent itself is buyable
        $oVar1->oxarticles__oxactive = new oxField( 0 );
        $oVar1->save();

        $oVar2->oxarticles__oxactive = new oxField( 0 );
        $oVar2->save();

        $sQ = "select 1 from ($sTable) where oxid='{$sArticleId}' and " . $oArticle->getSqlActiveSnippet();
        $this->assertEquals( "1", $oDb->getOne( $sQ ) );
    }

    /**
     * Test get standard tag link.
     *
     * @return null
     */
    public function testGetStdTagLink()
    {
        $oArticle = new oxArticle();
        $oArticle->setId( "testArticle" );

        $sStdTagLink  = oxConfig::getInstance()->getShopHomeURL( $oArticle->getLanguage(), false );
        $sStdTagLink .= "cl=details&amp;anid=".$oArticle->getId()."&amp;listtype=tag&amp;searchtag=".rawurlencode( "testTag" );

        $this->assertEquals( $sStdTagLink, $oArticle->getStdTagLink( "testTag" ) );
    }

    /**
     * Test if Is variant.
     *
     * @return null
     */
    public function testIsVariant()
    {
        $oArticle = new oxArticle();
        $this->assertFalse( $oArticle->isVariant() );

        $oArticle->oxarticles__oxparentid = new oxField( null );
        $this->assertFalse( $oArticle->isVariant() );

        $oArticle->oxarticles__oxparentid = new oxField( 'xxx' );
        $this->assertTrue( $oArticle->isVariant() );
    }

    /**
     * Test get fprice for test case.
     *
     * 1. parent article is buyable
     * 2. "from" should not be included in fprice getter value
     *
     * @return null
     */
    public function testGetFPriceForTestCase()
    {
        modConfig::getInstance()->setConfigParam( "blVariantParentBuyable", true );

            $sArtId = '2077';
            $sFPrice = '19,00';

        $oArticle = new oxArticle();
        $oArticle->load( $sArtId );

        $this->assertEquals( $sFPrice, $oArticle->getFPrice() );
        $this->assertEquals( -1, $oArticle->getStockStatus() );
    }

    /**
     * Test if is order article.
     *
     * @return null
     */
    public function testIsOrderArticle()
    {
        $oArticle = new oxArticle();
        $this->assertFalse( $oArticle->isOrderArticle() );
    }

    /**
     * Test get product parent id.
     *
     * @return null
     */
    public function testGetProductParentId()
    {
        $oArticle = new oxArticle();
        $oArticle->oxarticles__oxparentid = new oxField( 'sTestParentId' );
        $this->assertEquals( 'sTestParentId', $oArticle->getProductParentId() );
    }

    /**
     * Test get product id.
     *
     * @return null
     */
    public function testGetProductId()
    {
        $oArticle = new oxArticle();
        $oArticle->setId( "someArticleId" );
        $this->assertEquals( "someArticleId", $oArticle->getProductId() );
    }

    /**
     * Test set long description.
     *
     * @return null
     */
    public function testsetOxLongDesc()
    {
        $oArticle = $this->getMock( 'oxarticle', array( '_addField' ) );
        $oArticle->expects( $this->once() )->method( '_addField' );
        $oArticle->oxarticles__oxid = 'addcalled';
        $oArticle->oxarticles__oxlongdesc = 'asd';
        $this->assertEquals( 'asd', $oArticle->oxarticles__oxlongdesc );
    }





    /**
     * Test set buyable state.
     *
     * @return null
     */
    public function testSetBuyableState()
    {
        $oArticle = $this->getProxyClass( 'oxarticle' );
        $oArticle->setBuyableState( false );
        $this->assertTrue( $oArticle->getNonPublicVar( '_blNotBuyable' ) );

        $oArticle->setBuyableState( true );
        $this->assertFalse( $oArticle->getNonPublicVar( '_blNotBuyable' ) );
    }

    /**
     * Test get article long desc smarty processing.
     *
     * Use case:
     * Shop is productive
     *
     * Changes in Article-Longdescription aren't shown in Frontend due to caching
     * if the Option "Process Description of Articles and Categories with Smarty" is enabled.
     *
     * @return null
     */
    public function testGetArticleLongDescSmartyProcessing()
    {
        modConfig::getInstance()->setConfigParam( 'blExport', 1 );
        modConfig::getInstance()->setConfigParam( 'blProductive', 1 );
        modConfig::getInstance()->setConfigParam( 'bl_perfParseLongDescinSmarty', 1 );

        $myConfig = oxConfig::getInstance();
        $sLink = $myConfig->getImageUrl( $myConfig->isAdmin() );
        $sRes1 = "test {$sLink} test";
        $sRes2 = "best {$sLink} best";

        $oArticle = new oxarticle();
        $oArticle->setId( '_currTestArticle' );
        $oArticle->oxarticles__oxlongdesc = new oxField( 'test [{ $oViewConf->getImageUrl() }] test' );
        $oArticle->save();

        $oArticle = new oxarticle();
        $oArticle->load( '_currTestArticle' );
        $this->assertEquals( trim( $sRes1 ), trim( $oArticle->getArticleLongDesc( '_currTestArticle' ) ) );
        $oArticle->oxarticles__oxlongdesc = new oxField( 'best [{ $oViewConf->getImageUrl() }] best' );
        $oArticle->save();

        oxUtils::getInstance()->oxResetFileCache();

        $oArticle = new oxarticle();
        $oArticle->load( '_currTestArticle' );
        $this->assertEquals( trim( $sRes2 ), trim( $oArticle->getArticleLongDesc( '_currTestArticle' ) ) );
    }

    /**
     * Test assign parent field value when field is not set in parent.
     *
     * @return null
     */
    public function testAssignParentFieldValueWhenFieldIsNotSetInParent()
    {
        $oParent = new oxarticle();

        $oVariant = $this->getMock( 'oxarticle', array( 'getParentArticle', '_isFieldEmpty' ) );
        $oVariant->expects( $this->once() )->method( 'getParentArticle' )->will($this->returnValue( $oParent ) );
        $oVariant->expects( $this->never() )->method( '_isFieldEmpty' );
        $this->assertNull( $oVariant->UNITassignParentFieldValue( 'xxx' ) );
    }

    /**
     * Test price after global discount applied.
     *
     * Test data:
     * Qty  : 0 - 999999
     * Price: 0 - 50
     *
     * Discount: 50%
     *
     * @return null
     */
    public function testPriceAfterGlobalDiscountApplied()
    {
        oxDiscountList::getInstance()->forceReload();

        // creating discount for test
        $oDiscount = new oxdiscount();
        $oDiscount->setId( '_testdiscount' );
        $oDiscount->oxdiscount__oxactive   = new oxField( 1 );
        $oDiscount->oxdiscount__oxtitle    = new oxField( 'Test discount' );
        $oDiscount->oxdiscount__oxamount   = new oxField( 0 );
        $oDiscount->oxdiscount__oxamountto = new oxField( 99999 );
        $oDiscount->oxdiscount__oxprice    = new oxField( 0 );
        $oDiscount->oxdiscount__oxpriceto  = new oxField( 10 );
        $oDiscount->oxdiscount__oxaddsumtype = new oxField( '%' );
        $oDiscount->oxdiscount__oxaddsum     = new oxField( 50 );
        $oDiscount->save();

        $oArticle1 = new oxarticle();
        $oArticle1->load( '1126' );

        $this->assertEquals( 34, $oArticle1->getPrice()->getBruttoPrice() );

        $oArticle2 = new oxarticle();
        $oArticle2->load( '1127' );

        $this->assertEquals( 4, $oArticle2->getPrice()->getBruttoPrice() );
    }

    /**
     * Test get picture gallery when no pictures are set.
     *
     * Bug: when article is created having no real pictures,
     * first picture path is not set
     *
     * @return null
     */
    public function testGetPictureGalleryWhenNoPicturesAreSet()
    {
        $oArticle = new oxarticle();
        $aGallery = $oArticle->getPictureGallery();

        $sUrl = oxConfig::getInstance()->getPictureUrl( '1/nopic.jpg' );
        $this->assertNotNull( $sUrl );
        $this->assertEquals( $sUrl, $aGallery['ActPic'] );
    }

    /**
     * Test set link type.
     *
     * @return null
     */
    public function testSetLinkType()
    {
        $oArticle = $this->getProxyClass( 'oxarticle' );
        $oArticle->setNonPublicVar( 'oxdetaillink', 'http://www.oxid-esales.com/' );
        $oArticle->setLinkType( 999 );

        // testing
        $this->assertEquals( 999, $oArticle->getNonPublicVar( '_iLinkType' ) );
        $this->assertNull( $oArticle->getNonPublicVar( '_sDetailLink' ) );
    }

    /**
     * Test Get Media if media object is loaded in same language as article
     *
     * @return null
     */
    public function testGetMediaUrlsLanguageTest()
    {
        $this->cleanUpTable('oxmediaurls');
        $sQ = "insert into oxmediaurls (oxid, oxobjectid, oxurl, oxdesc) values ('_test1', '1126', '/test.jpg', 'test1')";
        oxDb::getDb()->execute($sQ);

        $oArt = new oxArticle();
        $oArt->loadInLang( 1, '1126');

        $oMediaUrls = $oArt->getMediaUrls();

        $this->assertEquals( 1, $oMediaUrls->current()->getLanguage() );
        $this->cleanUpTable( 'oxmediaurls' );
    }

    /**
     * Testing article url modifier functionality.
     *
     * @return null
     */
    public function testAppendLink()
    {
        $sParams = 'param1=value1&amp;param2=value2';

        $oArticle = new oxArticle();
        $oArticle->load( '2000' );
        $oArticle->appendLink( $sParams );
        $this->assertTrue( (bool) strpos( $oArticle->getLink(), $sParams ) );
    }

    /**
     * Testing how amount price chooses correct price value.
     *
     * @return null
     */
    public function testGetAmountPriceWhenPassingLowerPrice()
    {
        $oArticle = $this->getProxyClass('_oxArticle');
        $oArticle->load( $this->oArticle->getId() );

        // some data for test
        $oP2A = new oxBase();
        $oP2A->init( 'oxprice2article' );
        $oP2A->oxprice2article__oxshopid   = new oxField( oxConfig::getInstance()->getBaseShopId() );
        $oP2A->oxprice2article__oxartid    = new oxField( $oArticle->getId() );
        $oP2A->oxprice2article__oxaddabs   = new oxField( 33 );
        $oP2A->oxprice2article__oxamount   = new oxField( 2 );
        $oP2A->oxprice2article__oxamountto = new oxField( 10 );
        $oP2A->save();

        $oP2A = new oxBase();
        $oP2A->init( 'oxprice2article' );
        $oP2A->oxprice2article__oxshopid   = new oxField( oxConfig::getInstance()->getBaseShopId() );
        $oP2A->oxprice2article__oxartid    = new oxField( $oArticle->getId() );
        $oP2A->oxprice2article__oxaddabs   = new oxField( 32 );
        $oP2A->oxprice2article__oxamount   = new oxField( 11 );
        $oP2A->oxprice2article__oxamountto = new oxField( 9999999 );
        $oP2A->save();

        $oArticle->setNonPublicVar("_oAmountPriceList", null);
        $oArticle->oxarticles__oxprice->value = 50;
        // testing article
        $this->assertEquals( $oArticle->oxarticles__oxprice->value, $oArticle->UNITgetAmountPrice( 1 ) );

        $oArticle->setNonPublicVar("_oAmountPriceList", null);
        // testing article
        $this->assertEquals( 33, $oArticle->UNITgetAmountPrice( 2 ) );

        $oArticle->setNonPublicVar("_oAmountPriceList", null);
        // testing article
        $dPrice = 35;
        $this->assertEquals( 32, $oArticle->UNITgetAmountPrice( 12 ) );

        $oArticle->setNonPublicVar("_oAmountPriceList", null);
        $oArticle->oxarticles__oxprice->value = 30;
        $this->assertEquals( 30, $oArticle->UNITgetAmountPrice( 12 ) );
    }

    /**
     * Testing amount price lists.
     *
     * @return null
     */
    public function testFillAmountPriceList()
    {
        $oArticle = new oxArticle();
        $oArticle->load( '1126' );
        $dArticlePrice = $oArticle->UNITgetGroupPrice();

        $oP2A = new oxbase();
        $oP2A->setId( '_test_1' );
        $oP2A->init( 'oxprice2article' );
        $oP2A->oxprice2article__oxaddabs  = new oxField( '5' );
        $oAmPriceList[$oP2A->getId()] = $oP2A;

        $oP2A = new oxbase();
        $oP2A->setId( '_test_2' );
        $oP2A->init( 'oxprice2article' );
        $oP2A->oxprice2article__oxaddperc = new oxField( '5' );
        $oAmPriceList[$oP2A->getId()] = $oP2A;

        $oArticle = new oxArticle();
        $oArticle->getConfig()->setConfigParam( 'bl_perfCalcVatOnlyForBasketOrder', 0 );
        $oArticle->load( '1126' );

        $oAmPriceList = $oArticle->UNITfillAmountPriceList( $oAmPriceList );

        $oP2A = reset( $oAmPriceList );
        $this->assertEquals( oxLang::getInstance()->formatCurrency( 5 ), $oP2A->oxprice2article__oxaddabs->value );
        $this->assertEquals( oxLang::getInstance()->formatCurrency( 5 / ( 1 + 19 / 100 ) ), $oP2A->fnetprice );
        $this->assertEquals( oxLang::getInstance()->formatCurrency( 5 ), $oP2A->fbrutprice );

        $oP2A = next( $oAmPriceList );
        $dPrice = oxUtils::getInstance()->fRound($dArticlePrice - $dArticlePrice / 100 * 5 );
        $this->assertEquals( oxLang::getInstance()->formatCurrency( $dPrice), $oP2A->oxprice2article__oxaddabs->value );
        $this->assertEquals( oxLang::getInstance()->formatCurrency( $dPrice / ( 1 + 19 / 100 ) ), $oP2A->fnetprice );
        $this->assertEquals( oxLang::getInstance()->formatCurrency( $dPrice ), $oP2A->fbrutprice );
    }

    /**
     * Testing amount price lists calls for apply vat.
     *
     * @return null
     */
    public function testFillAmountPriceListCalls_applyVAT()
    {
        $oArticle = $this->getMock( 'oxarticle', array( '_applyVAT' )/*, array(), '', false*/ );
        $oArticle->expects( $this->exactly(1) )->method( '_applyVAT' );
        $oArticle->load( '1126' );
        $dArticlePrice = $oArticle->UNITgetGroupPrice();

        $oP2A = new oxbase();
        $oP2A->setId( '_test_1' );
        $oP2A->init( 'oxprice2article' );
        $oP2A->oxprice2article__oxaddabs  = new oxField( '5' );
        $oAmPriceList[$oP2A->getId()] = $oP2A;

        $oP2A = new oxbase();
        $oP2A->setId( '_test_2' );
        $oP2A->init( 'oxprice2article' );
        $oP2A->oxprice2article__oxaddperc = new oxField( '5' );
        $oAmPriceList[$oP2A->getId()] = $oP2A;

        $oArticle = $this->getMock( 'oxarticle', array( '_applyVAT' )/*, array(), '', false*/ );
        // one for main, two for am prices
        $oArticle->expects( $this->exactly(3) )->method( '_applyVAT' );
        $oArticle->getConfig()->setConfigParam( 'bl_perfCalcVatOnlyForBasketOrder', 0 );
        $oArticle->load( '1126' );

        $oArticle->UNITfillAmountPriceList( $oAmPriceList );
    }

    /**
     * Test fill amount price list vat only for basket.
     *
     * @return null
     */
    public function testFillAmountPriceListVatOnlyForBasket()
    {
        $oArticle = new oxArticle();
        $oArticle->load( '1126' );
        $dArticlePrice = $oArticle->UNITgetGroupPrice();

        modConfig::getInstance()->setConfigParam( 'bl_perfCalcVatOnlyForBasketOrder', 1 );
        $oP2A = new oxbase();
        $oP2A->setId( '_test_1' );
        $oP2A->init( 'oxprice2article' );
        $oP2A->oxprice2article__oxaddabs  = new oxField( '5' );
        $oAmPriceList[$oP2A->getId()] = $oP2A;

        $oP2A = new oxbase();
        $oP2A->setId( '_test_2' );
        $oP2A->init( 'oxprice2article' );
        $oP2A->oxprice2article__oxaddperc = new oxField( '5' );
        $oAmPriceList[$oP2A->getId()] = $oP2A;

        $oArticle = new oxArticle();
        $oArticle->load( '1126' );

        $oAmPriceList = $oArticle->UNITfillAmountPriceList( $oAmPriceList );

        $oP2A = reset( $oAmPriceList );
        $this->assertEquals( oxLang::getInstance()->formatCurrency( 5 ), $oP2A->oxprice2article__oxaddabs->value );
        $this->assertEquals( oxLang::getInstance()->formatCurrency( 5 ), $oP2A->fnetprice );
        $this->assertEquals( oxLang::getInstance()->formatCurrency( 5 ), $oP2A->fbrutprice );

        $oP2A = next( $oAmPriceList );
        $this->assertEquals( oxLang::getInstance()->formatCurrency( $dArticlePrice - $dArticlePrice / 100 * 5 ), $oP2A->oxprice2article__oxaddabs->value );
        $this->assertEquals( oxLang::getInstance()->formatCurrency( $dArticlePrice - $dArticlePrice / 100 * 5 ), $oP2A->fnetprice );
        $this->assertEquals( oxLang::getInstance()->formatCurrency( $dArticlePrice - $dArticlePrice / 100 * 5 ), $oP2A->fbrutprice );
    }

    /**
     * Test fill amount price list first discount lower.
     *
     * @return null
     */
    public function testFillAmountPriceListFirstDiscountLower()
    {
        $oArticle = new oxArticle();
        $oArticle->load( '1126' );
        $dArticlePrice = $oArticle->UNITgetGroupPrice();

        modConfig::getInstance()->setConfigParam( 'bl_perfCalcVatOnlyForBasketOrder', 1 );
        $oP2A = new oxbase();
        $oP2A->setId( '_test_1' );
        $oP2A->init( 'oxprice2article' );
        $oP2A->oxprice2article__oxaddperc  = new oxField( '10' );
        $oP2A->oxprice2article__oxartid  = new oxField( '1126' );
        $oP2A->oxprice2article__oxamount   = new oxField( '1' );
        $oP2A->oxprice2article__oxamountto   = new oxField( '4' );
        $oP2A->save();
        $oAmPriceList[$oP2A->getId()] = $oP2A;

        $oP2A = new oxbase();
        $oP2A->setId( '_test_2' );
        $oP2A->init( 'oxprice2article' );
        $oP2A->oxprice2article__oxaddperc = new oxField( '5' );
        $oP2A->oxprice2article__oxartid  = new oxField( '1126' );
        $oP2A->oxprice2article__oxamount   = new oxField( '5' );
        $oP2A->oxprice2article__oxamountto   = new oxField( '40' );
        $oP2A->save();
        $oAmPriceList[$oP2A->getId()] = $oP2A;

        $oArticle = new oxArticle();
        $oArticle->load( '1126' );

        $oAmPriceList = $oArticle->UNITfillAmountPriceList( $oAmPriceList );

        $oP2A = reset( $oAmPriceList );
        $this->assertEquals( oxLang::getInstance()->formatCurrency( $dArticlePrice - $dArticlePrice / 100 * 10 ), $oP2A->oxprice2article__oxaddabs->value );
        $this->assertEquals( oxLang::getInstance()->formatCurrency( $dArticlePrice - $dArticlePrice / 100 * 10 ), $oP2A->fnetprice );
        $this->assertEquals( oxLang::getInstance()->formatCurrency( $dArticlePrice - $dArticlePrice / 100 * 10 ), $oP2A->fbrutprice );


        $oP2A = next( $oAmPriceList );
        $this->assertEquals( oxLang::getInstance()->formatCurrency( $dArticlePrice - $dArticlePrice / 100 * 5 ), $oP2A->oxprice2article__oxaddabs->value );
        $this->assertEquals( oxLang::getInstance()->formatCurrency( $dArticlePrice - $dArticlePrice / 100 * 5 ), $oP2A->fnetprice );
        $this->assertEquals( oxLang::getInstance()->formatCurrency( $dArticlePrice - $dArticlePrice / 100 * 5 ), $oP2A->fbrutprice );
    }

    /**
     * Test fill amount price list second discount lower.
     *
     * @return null
     */
    public function testFillAmountPriceListSecondDiscountLower()
    {
        $oArticle = new oxArticle();
        $oArticle->load( '1126' );
        $dArticlePrice = $oArticle->UNITgetGroupPrice();

        modConfig::getInstance()->setConfigParam( 'bl_perfCalcVatOnlyForBasketOrder', 1 );
        $oP2A = new oxbase();
        $oP2A->setId( '_test_1' );
        $oP2A->init( 'oxprice2article' );
        $oP2A->oxprice2article__oxaddperc = new oxField( '5' );
        $oP2A->oxprice2article__oxartid  = new oxField( '1126' );
        $oP2A->oxprice2article__oxamount   = new oxField( '1' );
        $oP2A->oxprice2article__oxamountto   = new oxField( '4' );
        $oP2A->save();
        $oAmPriceList[$oP2A->getId()] = $oP2A;

        $oP2A = new oxbase();
        $oP2A->setId( '_test_2' );
        $oP2A->init( 'oxprice2article' );
        $oP2A->oxprice2article__oxaddperc  = new oxField( '10' );
        $oP2A->oxprice2article__oxartid  = new oxField( '1126' );
        $oP2A->oxprice2article__oxamount   = new oxField( '5' );
        $oP2A->oxprice2article__oxamountto   = new oxField( '40' );
        $oP2A->save();
        $oAmPriceList[$oP2A->getId()] = $oP2A;

        $oArticle = new oxArticle();
        $oArticle->load( '1126' );

        $oAmPriceList = $oArticle->UNITfillAmountPriceList( $oAmPriceList );

        $oP2A = reset( $oAmPriceList );
        $this->assertEquals( oxLang::getInstance()->formatCurrency( $dArticlePrice - $dArticlePrice / 100 * 5 ), $oP2A->oxprice2article__oxaddabs->value );
        $this->assertEquals( oxLang::getInstance()->formatCurrency( $dArticlePrice - $dArticlePrice / 100 * 5 ), $oP2A->fnetprice );
        $this->assertEquals( oxLang::getInstance()->formatCurrency( $dArticlePrice - $dArticlePrice / 100 * 5 ), $oP2A->fbrutprice );

        $oP2A = next( $oAmPriceList );
        $this->assertEquals( oxLang::getInstance()->formatCurrency( $dArticlePrice - $dArticlePrice / 100 * 10 ), $oP2A->oxprice2article__oxaddabs->value );
        $this->assertEquals( oxLang::getInstance()->formatCurrency( $dArticlePrice - $dArticlePrice / 100 * 10 ), $oP2A->fnetprice );
        $this->assertEquals( oxLang::getInstance()->formatCurrency( $dArticlePrice - $dArticlePrice / 100 * 10 ), $oP2A->fbrutprice );
    }




    /**
     * Test set id.
     *
     * @return null
     */
    public function testSetId()
    {
        $oArticle = new oxarticle();
        $oArticle->setId("test_id");
        $this->assertEquals("test_id", $oArticle->oxarticles__oxid->value);
        $this->assertEquals("test_id", $oArticle->oxarticles__oxnid->value);
    }

    /**
     * Test disable price load.
     *
     * @return null
     */
    public function testDisablePriceLoad()
    {
        $oArticle = new oxarticle();
        $oArticle->disablePriceLoad( $oArticle );
        $this->assertNull( $oArticle->getBasePrice());
    }

    /**
     * Test set/get item key.
     *
     * @return null
     */
    public function testSetGetItemKey()
    {
        $oArticle = new oxarticle();
        $oArticle->setItemKey("test_key");
        $this->assertEquals("test_key", $oArticle->sItemKey);
        $this->assertEquals("test_key", $oArticle->getItemKey());
    }

    /**
     * Test set no variant loading.
     *
     * @return null
     */
    public function testSetNoVariantLoading()
    {
        $oArticle = new oxarticle();
        $oArticle->setNoVariantLoading( true );
        $this->assertEquals(array(), $oArticle->getVariants());
    }

    /**
     * Test if article is on comparison list.
     *
     * @return null
     */
    public function testIsOnComparisonList()
    {
        modConfig::setParameter('aFiltcompproducts', array('_testArt'=>'_testArt'));
        $this->oArticle->UNITassignComparisonListFlag();
        $this->assertTrue( $this->oArticle->isOnComparisonList());
    }

    /**
     * Test set on comparison list.
     *
     * @return null
     */
    public function testSetOnComparisonList()
    {
        modConfig::setParameter('aFiltcompproducts', array('_testArt'=>'_testArt'));
        $this->oArticle->UNITassignComparisonListFlag();
        $this->assertTrue( $this->oArticle->isOnComparisonList());
        $this->oArticle->setOnComparisonList( false );
        $this->assertFalse( $this->oArticle->isOnComparisonList());
    }

    /**
     * Test assign get persistent parameters.
     *
     * @return null
     */
    public function testAssignGetPersParams()
    {
        $aParam = array( '_testArt'=>'test1', '2001'=>'test2');
        oxSession::setVar( 'persparam', $aParam);
        $this->oArticle->UNITassignPersistentParam();
        $this->assertEquals('test1', $this->oArticle->getPersParams());
    }

    /**
     * Test get searchable fields.
     *
     * @return null
     */
    public function testGetSearchableFields()
    {
        $this->oArticle->UNITaddField("oxblfixedprice", 1);
        $this->oArticle->UNITaddField("oxtitle", 1);
        $aFields = $this->oArticle->getSearchableFields();
        $this->assertTrue(in_array( 'oxtitle', $aFields));
        $this->assertFalse(in_array( 'oxblfixedprice', $aFields));
    }

    /**
     * Test get admin variants.
     *
     * @return null
     */
    public function testGetAdminVariants()
    {
        $oVariants = $this->oArticle->getAdminVariants();
        $this->assertEquals( 1, count($oVariants));
        $oVariant = $oVariants->current();
        $this->assertEquals( '_testVar', $oVariant->oxarticles__oxid->value);
        $this->assertEquals( 'test', $oVariant->oxarticles__oxtitle->value);
    }

    /**
     * Test get admin variants in other language.
     *
     * @return null
     */
    public function testGetAdminVariantsInOtherLang()
    {
        $oVariants = $this->oArticle->getAdminVariants( 1);
        $this->assertEquals( 1, count($oVariants));
        $oVariant = $oVariants->current();
        $this->assertEquals( 'testEng', $oVariant->oxarticles__oxtitle->value);
    }

    /**
     * Test get admin variants not buyble parent.
     *
     * @return null
     */
    public function testGetAdminVariantsNotBuybleParent()
    {
        modConfig::getInstance()->setConfigParam( 'blVariantParentBuyable', false );
        $oVariants = $this->oArticle->getAdminVariants();
        $this->assertEquals( 1, count($oVariants));
        $this->assertTrue( $this->oArticle->blNotBuyableParent);
    }

    /**
     * Test article load.
     *
     * @return null
     */
    public function testLoad()
    {
        oxTestModules::addFunction('oxarticle', '_skipSaveFields', '{$this->_aSkipSaveFields=array();}');
        $oArticle = oxnew('oxarticle');
        $oArticle->load('_testArt');
        $oArticle->oxarticles__oxinsert = new oxField('2008/04/04');
        $oArticle->oxarticles__oxtimestamp = new oxField('2008/04/04');
        $oArticle->save();

        $oArticle = new oxarticle();
        $oArticle->load('_testArt');

        $sInsert = '04.04.2008';
        $sTimeStamp = '04.04.2008 00:00:00';
        if ( $oArticle->getLanguage() == 1 ) {
            $sInsert = '2008-04-04';
            $sTimeStamp = '2008-04-04 00:00:00';
        }

        $this->assertEquals( $sInsert, $oArticle->oxarticles__oxinsert->value);
        $this->assertEquals( $sTimeStamp, $oArticle->oxarticles__oxtimestamp->value);
    }

    /**
     * Test skip save fields.
     *
     * @return null
     */
    public function testSkipSaveFields()
    {
        modConfig::getInstance()->setConfigParam( 'aMultishopArticleFields', array("OXPRICE", "OXPRICEA", "OXPRICEB", "OXPRICEC", 'OXSHORTDESC'));
        $oArticle = $this->getProxyClass( "oxArticle" );
        $oArticle->load('_testArt');
        $oArticle->oxarticles__oxshopid = new oxField('2', oxField::T_RAW);
        $aSkipFields = array( 'oxtimestamp', 'oxlongdesc', 'oxinsert', 'oxparentid', 'oxprice', 'oxpricea', 'oxpriceb', 'oxpricec', 'oxshortdesc', 'oxshortdesc_1' );
            $aSkipFields = array( 'oxtimestamp', 'oxlongdesc', 'oxinsert', 'oxparentid' );
        $oArticle->UNITskipSaveFields();

        $this->assertEquals( $aSkipFields, $oArticle->getNonPublicVar('_aSkipSaveFields'));
    }

    /**
     * Test skip save fields for variant.
     *
     * @return null
     */
    public function testSkipSaveFieldsForVariant()
    {
        $aSkipFields = array( 'oxtimestamp', 'oxlongdesc', 'oxinsert' );
        $this->oArticle2->UNITskipSaveFields();
        $this->assertEquals( $aSkipFields, $this->oArticle2->getNonPublicVar('_aSkipSaveFields'));
    }

    /**
     * Test article insert.
     *
     * FS#1957
     *
     * @return null
     */
    public function testInsert()
    {
        $now = date( 'Y-m-d H:i:s', time());
        $oArticle = new oxarticle();
        $oArticle->setId( '_testArt2');
        $oArticle->oxarticles__oxshopid = new oxField(oxConfig::getInstance()->getBaseShopId(), oxField::T_RAW);
        $oArticle->oxarticles__oxshopincl = new oxField(oxConfig::getInstance()->getBaseShopId(), oxField::T_RAW);
        $oArticle->UNITinsert();
        $sOxid = oxDb::getDb()->getOne( "Select oxid from oxarticles where oxid = '_testArt2'");
        $this->assertEquals( '_testArt2', $sOxid);
        $this->assertTrue( $oArticle->oxarticles__oxinsert->value >= $now );
        $this->assertTrue( $oArticle->oxarticles__oxtimestamp->value >= $now );
        $this->assertEquals( 'oxarticle', $oArticle->oxarticles__oxsubclass->value);
    }


    /**
     * test Update.
     *
     * @return null
     */
    public function testUpdate()
    {
        $this->oArticle->oxarticles__oxtitle = new oxField('test2');
        $blRet = $this->oArticle->UNITupdate();
        $this->assertTrue($blRet);
        $this->assertEquals('test2', $this->oArticle->oxarticles__oxtitle->value);
    }

    /**
     * Test update not allowed.
     *
     * @return null
     */
    public function testUpdateNotAllowed()
    {
    }

    /**
     * Test assign simple article.
     *
     * @return null
     */
    public function testAssignSimpleArticle()
    {
        $sArtID = '_testArt';
        $oArticle = oxNew( "oxarticle" );
        $oArticle->load($sArtID);
        $oArticle->setSkipAssign(true);
        $oArticle->oxdetaillink = null;
        $this->assertNULL( $oArticle->assign(null));
        $this->assertNULL( $oArticle->oxdetaillink);
    }

    /**
     * Test assign.
     *
     * @return null
     */
    public function testAssign()
    {
        $sArtID = '_testArt';
        $oArticle = oxNew( "oxarticle" );
        $oArticle->load( $sArtID);
        $dbRecord = array();
        $dbRecord['oxarticles__oxlongdesc'] = 'LongDesc';
        $dbRecord['oxarticles__oxtitle']    = 'test2';
        $oArticle->assign( $dbRecord);
        $this->assertEquals( 'LongDesc', $oArticle->oxarticles__oxlongdesc->value);
        $this->assertEquals( $oArticle->oxarticles__oxid->value, $oArticle->oxarticles__oxnid->value);
        $this->assertEquals( 'test2', $oArticle->oxarticles__oxtitle->value);
    }



    /**
     * Test get variants ids.
     *
     * @return null
     */
    public function testGetVariantsIds()
    {
        $aIds = $this->oArticle->UNITgetVariantsIds();
        $this->assertEquals( '_testVar', $aIds[0]);
    }

    /**
     * Test add to rating average.
     *
     * @return null
     */
    public function testaddToRatingAverage()
    {
        $this->oArticle->oxarticles__oxrating = new oxField(3.5, oxField::T_RAW);
        $this->oArticle->oxarticles__oxratingcnt = new oxField(2, oxField::T_RAW);
        $this->oArticle->save();
        $this->oArticle->addToRatingAverage( 5);

        $this->assertEquals( 4, $this->oArticle->oxarticles__oxrating->value);
        $this->assertEquals( 3, $this->oArticle->oxarticles__oxratingcnt->value);
        $dRating = oxDb::getDB()->getOne("select oxrating from oxarticles where oxid='".$this->oArticle->getId()."'");
        $this->assertEquals( 4, $dRating);
    }

    /**
     * Test get article rating average.
     *
     * @return null
     */
    public function testGetArticleRatingAverage()
    {
        $this->oArticle->oxarticles__oxrating = new oxField(3.52345, oxField::T_RAW);

        $this->assertEquals( 3.5, $this->oArticle->getArticleRatingAverage());
    }

    /**
     * Test get reviews.
     *
     * @return null
     */
    public function testGetReviews()
    {
        $sArtID = '_testArt';
        $sExpectedText = 'Review \n Text';

        oxDb::getDB()->execute("insert into oxreviews (oxid, oxcreate, oxtype, oxobjectid, oxtext) values ('test1', '2008/04/04', 'oxarticle', '$sArtID', '$sExpectedText' )");

        $aReviews = $this->oArticle->getReviews();
        $this->assertTrue($aReviews instanceof oxList);
        $oReview = $aReviews->getArray();
        $this->assertEquals( 1, $aReviews->count());
        $this->assertEquals( "Review <br />\n Text", $oReview['test1']->oxreviews__oxtext->value);

        $sCreate = '04.04.2008 00:00:00';
        if ( $this->oArticle->getLanguage() == 1 ) {
            $sCreate = '2008-04-04 00:00:00';
        }

        $this->assertEquals( $sCreate, $oReview['test1']->oxreviews__oxcreate->value);
    }

    /**
     * Test get reviews with variants.
     *
     * @return null
     */
    public function testGetReviewsWithVariants()
    {
        $sExpectedText    = 'ReviewText';
        $sExpectedTextVar = 'ReviewTextVar';

        oxDb::getDB()->execute("insert into oxreviews (oxid, oxtype, oxobjectid, oxtext) values ('test1', 'oxarticle', '_testArt', '$sExpectedText' )");
        oxDb::getDB()->execute("insert into oxreviews (oxid, oxtype, oxobjectid, oxtext) values ('test2', 'oxarticle', '_testVar', '$sExpectedTextVar' )");

        modConfig::getInstance()->setConfigParam( 'blShowVariantReviews', true );
        $aReviews = $this->oArticle->getReviews();
        $this->assertTrue($aReviews instanceof oxList);
        $oReview = $aReviews->getArray();
        $this->assertEquals( 2, $aReviews->count());
        $this->assertEquals( $sExpectedText, $oReview['test1']->oxreviews__oxtext->value);
        $this->assertEquals( $sExpectedTextVar, $oReview['test2']->oxreviews__oxtext->value);
    }

    /**
     * Test get reviews with guestbook moderation.
     *
     * @return null
     */
    public function testGetReviewsWithGBModeration()
    {
        $sExpectedText = 'ReviewText';
        $oUser = new oxuser();
        $oUser->load('oxdefaultadmin');
        oxDb::getDB()->execute("insert into oxreviews (oxid, oxtype, oxobjectid, oxuserid, oxtext) values ('test1', 'oxarticle', '_testArt', 'oxdefaultadmin', '$sExpectedText' )");
        $oArticle = $this->getMock( 'oxarticle', array( 'getUser' ) );
        $oArticle->expects( $this->any() )->method( 'getUser')->will( $this->returnValue( $oUser ) );
        $oArticle->load( '_testArt');
        modConfig::getInstance()->setConfigParam( 'blGBModerate', true );
        $this->assertNull($oArticle->getReviews());
        oxDb::getDB()->execute("update oxreviews set oxactive =1 where oxobjectid='_testArt'");
        $aReviews = $this->oArticle->getReviews();
        $this->assertTrue($aReviews instanceof oxList);
        $oReview = $aReviews->getArray();
        $this->assertEquals( 1, $aReviews->count());
    }

    /**
     * Test get reviews with guestbook moderation and no user.
     *
     * @return null
     */
    public function testGetReviewsWithGBModerationNoUser()
    {
        $sExpectedText = 'ReviewText';
        $oUser = new oxuser();
        $oUser->load('oxdefaultadmin');
        oxDb::getDB()->execute("insert into oxreviews (oxid, oxtype, oxobjectid, oxtext) values ('test1', 'oxarticle', '_testArt', '$sExpectedText' )");
        modConfig::getInstance()->setConfigParam( 'blGBModerate', true );
        $this->assertNull( $this->oArticle->getReviews());
    }

    /**
     * Test get accessoires.
     *
     * @return null
     */
    public function testGetAccessoires()
    {
        $oNewGroup = oxNew( "oxbase" );
        $oNewGroup->init( "oxaccessoire2article" );
        $oNewGroup->oxaccessoire2article__oxobjectid = new oxField("1651", oxField::T_RAW);
        $oNewGroup->oxaccessoire2article__oxarticlenid = new oxField($this->oArticle->oxarticles__oxid->value, oxField::T_RAW);
        $oNewGroup->oxaccessoire2article__oxsort = new oxField(0, oxField::T_RAW);
        $oNewGroup->save();

        $this->oArticle->oxarticles__oxstock = new oxField(2, oxField::T_RAW);
        $this->oArticle->oxarticles__oxactive = new oxField(1, oxField::T_RAW);
        $this->oArticle->save();
        $aAccess = $this->oArticle->getAccessoires();

        $this->assertEquals( count($aAccess), 1 );
    }

    /**
     * Test get accessoires not allowed.
     *
     * @return null
     */
    public function testGetAccessoiresNotAllowed()
    {
        modConfig::getInstance()->setConfigParam( 'bl_perfLoadAccessoires', false );
        $this->assertNull($this->oArticle->getAccessoires());
    }

    /**
     * Test get accessoires empty.
     *
     * @return null
     */
    public function testGetAccessoiresEmpty()
    {
        $this->assertNull($this->oArticle->getAccessoires());
    }

    /**
     * Test get crossselling when loading is not allowed so empty list is returned.
     *
     * @return null
     */
    public function testGetCrossSellingLoadingIsNotAllowedSoEmptyListIsReturned()
    {
        modConfig::getInstance()->setConfigParam( 'bl_perfLoadCrossselling', false );
        $oArticle = oxNew( "oxarticle" );
        $oArticle->load( "1849" );
        $this->assertNull( $oArticle->getCrossSelling() );
    }

    /**
     * Test get crossselling should return empty list because of non existing article.
     *
     * @return null
     */
    public function testGetCrossSellingShouldReturnEmptyListBecauseOfNonExistingArticle()
    {
        $oArticle = oxNew("oxarticle");
        $oArticle->load('_testArt');
        $this->assertNull( $oArticle->getCrossSelling() );
    }

    /**
     * Test get crossselling.
     *
     * @return null
     */
    public function testGetCrossSelling()
    {
        $oArticle = oxNew("oxarticle");
        $oArticle->load("1849");
        $oList = $oArticle->getCrossSelling();
        $iCount = 3;
            $iCount = 2;
        $this->assertTrue($oList instanceof oxList);
        $this->assertEquals( $iCount, $oList->count() );
    }

    /**
     * Test get bidirectionall cross selling.
     *
     * In case of fault this test may fail only randomly
     * for more precise test check oxArticleList::getCrosselingArticles()
     *
     * @return null
     */
    public function testGetBiCrossSelling()
    {
        modConfig::getInstance()->setConfigParam( 'blBidirectCross', true );
        $oArticle = oxNew("oxarticle");
        $oArticle->load("1849");
        $aAccess = $oArticle->getCrossSelling();

        $this->assertEquals( 4, count($aAccess));
    }

    /**
     * Test get customer also bought this products.
     *
     * @return null
     */
    public function testGetCustomerAlsoBoughtThisProducts()
    {
        $sShopId = oxConfig::getInstance()->getShopId();
        $oOrderArticle = new oxorderarticle();
        $oOrderArticle->setId( '_testId' );
        $oOrderArticle->oxorderarticles__oxartid = new oxField('_testArt', oxField::T_RAW);
        $oOrderArticle->oxorderarticles__oxorderid = new oxField('51', oxField::T_RAW);
        $oOrderArticle->oxorderarticles__oxordershopid = new oxField($sShopId, oxField::T_RAW);
        $oOrderArticle->save();
        $oOrderArticle = new oxorderarticle();
        $oOrderArticle->setId( '_testId2' );
        $oOrderArticle->oxorderarticles__oxartid = new oxField('1651', oxField::T_RAW);
        $oOrderArticle->oxorderarticles__oxorderid = new oxField('51', oxField::T_RAW);
        $oOrderArticle->oxorderarticles__oxordershopid = new oxField($sShopId, oxField::T_RAW);
        $oOrderArticle->save();
        $aArticles = $this->oArticle->getCustomerAlsoBoughtThisProducts();

        $this->assertEquals( 1, count($aArticles) );
        $this->assertEquals( '1651', $aArticles['1651']->oxarticles__oxid->value );
    }

    /**
     * Test get customer also bought this products disabled.
     *
     * @return null
     */
    public function testGetCustomerAlsoBoughtThisProductsDisabled()
    {
        modConfig::getInstance()->setConfigParam( 'bl_perfLoadCustomerWhoBoughtThis', false );
        $aArticles = $this->oArticle->getCustomerAlsoBoughtThisProducts();

        $this->assertNull( $aArticles );
    }

    /**
     * Test generate search str for customer bought.
     *
     * @return null
     */
    public function testGenerateSearchStrForCustomerBought()
    {
        oxTestModules::addFunction("oxUtilsDate", "getTime", "{return 0;}");

        $oArticle = new oxarticle();
        $oArticle->load('_testArt');
        $sSelect = $oArticle->UNITgenerateSearchStrForCustomerBought();

        $sArtTable = $oArticle->UNITgetObjectViewName( 'oxarticles' );
        $sOrderArtTable = getViewName( 'oxorderarticles' );

        $sExpSelect = "select distinct {$sArtTable}.* from (
                   select d.oxorderid as suborderid from {$sOrderArtTable} as d use index ( oxartid ) where d.oxartid in ( '_testArt', '_testVar' ) limit 50
               ) as suborder
               left join {$sOrderArtTable} force index ( oxorderid ) on suborder.suborderid = {$sOrderArtTable}.oxorderid
               left join {$sArtTable} on {$sArtTable}.oxid = {$sOrderArtTable}.oxartid
               where {$sArtTable}.oxid not in ( '_testArt', '_testVar')
               and ( {$sArtTable}.oxissearch = 1 or {$sArtTable}.oxparentid <> '' ) and ".$oArticle->getSqlActiveSnippet();

        $sExpSelect = str_replace( array("\n","\r", "\t", " "), "", $sExpSelect );
        $sSelect    = str_replace( array("\n","\r", "\t", " "), "", $sSelect );

        $this->assertEquals( $sExpSelect, $sSelect );
    }

    /**
     * Test generate search str for customer bought for variants.
     *
     * @return null
     */
    public function testGenerateSearchStrForCustomerBoughtForVariants()
    {
        oxTestModules::addFunction("oxUtilsDate", "getTime", "{return 0;}");

        $oArticle = new oxarticle();
        $oArticle->load('_testVar');
        $sSelect = $oArticle->UNITgenerateSearchStrForCustomerBought();

        $sArtTable = $oArticle->UNITgetObjectViewName( 'oxarticles' );
        $sOrderArtTable = getViewName( 'oxorderarticles' );

        $sExpSelect = "select distinct {$sArtTable}.* from (
                   select d.oxorderid as suborderid from {$sOrderArtTable} as d use index ( oxartid ) where d.oxartid in ( '_testVar', '_testArt' )  limit 50
               ) as suborder
               left join {$sOrderArtTable} force index ( oxorderid ) on suborder.suborderid = {$sOrderArtTable}.oxorderid
               left join {$sArtTable} on {$sArtTable}.oxid = {$sOrderArtTable}.oxartid
               where {$sArtTable}.oxid not in ( '_testVar', '_testArt' )
               and ( {$sArtTable}.oxissearch = 1 or {$sArtTable}.oxparentid <> '' ) and ".$oArticle->getSqlActiveSnippet();

        $sExpSelect = str_replace( array("\n","\r", "\t", " "), "", $sExpSelect );
        $sSelect    = str_replace( array("\n","\r", "\t", " "), "", $sSelect );

        $this->assertEquals( $sExpSelect, $sSelect );
    }

    /**
     * Test generate search str for customer bought for variants 2.
     *
     * @return null
     */
    public function testGenerateSearchStrForCustomerBoughtForVariants2()
    {
        oxTestModules::addFunction("oxUtilsDate", "getTime", "{return 0;}");

        $oArticle2 = new oxarticle();
        $oArticle2->modifyCacheKey(null, false);
        $oArticle2->setId('_testArt2');
        $oArticle2->oxarticles__oxshopid = new oxField(oxConfig::getInstance()->getBaseShopId(), oxField::T_RAW);
        $oArticle2->oxarticles__oxshopincl = new oxField(oxConfig::getInstance()->getBaseShopId(), oxField::T_RAW);
        $oArticle2->oxarticles__oxparentid = new oxField($this->oArticle->oxarticles__oxid->value, oxField::T_RAW);
        $oArticle2->save();

        $oArticle = new oxarticle();
        $oArticle->load('_testVar');
        $sSelect = $oArticle->UNITgenerateSearchStrForCustomerBought();

        $sArtTable = $oArticle->UNITgetObjectViewName( 'oxarticles' );
        $sOrderArtTable = getViewName( 'oxorderarticles' );

        $sExpSelect = "select distinct {$sArtTable}.* from (
                   select d.oxorderid as suborderid from {$sOrderArtTable} as d use index ( oxartid ) where d.oxartid in ( '_testVar', '_testArt', '_testArt2' ) limit 50
               ) as suborder
               left join {$sOrderArtTable} force index ( oxorderid ) on suborder.suborderid = {$sOrderArtTable}.oxorderid
               left join {$sArtTable} on {$sArtTable}.oxid = {$sOrderArtTable}.oxartid
               where {$sArtTable}.oxid not in ( '_testVar', '_testArt' , '_testArt2' )
               and ( {$sArtTable}.oxissearch = 1 or {$sArtTable}.oxparentid <> '' ) and ".$oArticle->getSqlActiveSnippet();

        $sExpSelect = str_replace( array("\n","\r", "\t", " "), "", $sExpSelect );
        $sSelect    = str_replace( array("\n","\r", "\t", " "), "", $sSelect );

        $this->assertEquals( $sExpSelect, $sSelect );
    }

    /**
     * Test load amount price info.
     *
     * @return null
     */
    public function testLoadAmountPriceInfo()
    {
        modConfig::getInstance()->setConfigParam( 'staffelpreis', true );
        $oArticle = new _oxArticle();
        $oArticle->load('1651');
        $oArticle->setVar( 'blCalcPrice', true);
        $oAmPriceList = $oArticle->loadAmountPriceInfo();

            $this->assertEquals( 4, count($oAmPriceList) );
    }

    /**
     * Test load amount price info don't calc price.
     *
     * @return null
     */
    public function testLoadAmountPriceInfoDontCalcPrice()
    {
        modConfig::getInstance()->setConfigParam( 'staffelpreis', true );
        $oArticle = new _oxArticle();
        $oArticle->load('1651');
        $oArticle->setVar( 'blCalcPrice', false);
        $oAmPriceList = $oArticle->loadAmountPriceInfo();

        $this->assertEquals( 0, count($oAmPriceList) );
    }

    /**
     * Test load amount price info without amount price.
     *
     * @return null
     */
    public function testLoadAmountPriceInfoWithoutAmountPrice()
    {
        modConfig::getInstance()->setConfigParam( 'staffelpreis', true );
        $oArticle = new _oxArticle();
        $oArticle->load('2000');
        $oArticle->setVar( 'blCalcPrice', true);
        $oAmPriceList = $oArticle->loadAmountPriceInfo();

        $this->assertEquals( 0, count($oAmPriceList) );
    }

    /**
     * Test load amount price info for variant.
     *
     * @return null
     */
    public function testLoadAmountPriceInfoForVariant()
    {
        $sShopId = oxConfig::getInstance()->getShopId();
        $sSql  = "insert into oxprice2article (oxid, oxartid, oxshopid, oxaddperc, oxamount, oxamountto)";
        $sSql .= " values ('test1', '_testArt', '".$sShopId."', 10, 10, 99999999 )";
        oxDb::getDB()->execute($sSql);
        modConfig::getInstance()->setConfigParam( 'staffelpreis', true );
        modConfig::getInstance()->setConfigParam( 'blVariantInheritAmountPrice', true );
        $oArticle = new _oxArticle();
        $oArticle->load('_testVar');
        $oArticle->setVar( 'blCalcPrice', true);
        $oAmPriceList = $oArticle->loadAmountPriceInfo();

        $this->assertEquals( 1, count($oAmPriceList) );
    }

    /**
     * Test get sql active snippet.
     *
     * @return null
     */
    public function testGetSqlActiveSnippet()
    {
        modConfig::getInstance()->setConfigParam( 'blUseTimeCheck', false );

        $sTable = $this->oArticle->getViewName();
        $this->oArticle->setAdminMode( true );
        if ( !oxConfig::getInstance()->getConfigParam( 'blVariantParentBuyable' ) ) {
            $sInsert = " and IF( $sTable.oxvarcount = 0, 1, ( select 1 from $sTable as art where art.oxparentid=$sTable.oxid and ( art.oxactive = 1  ) and ( art.oxstockflag != 2 or art.oxstock > 0 ) limit 1 ) ) ";
        }
        $sExpSelect  = "(  $sTable.oxactive = 1   and ( $sTable.oxstockflag != 2 or ( $sTable.oxstock + $sTable.oxvarstock ) > 0  ) $sInsert ) ";
        $sSelect = $this->oArticle->getSqlActiveSnippet();
        $this->assertEquals( $sExpSelect, $sSelect);
    }

    /**
     * Test get sql active snippet dont use stock.
     *
     * @return null
     */
    public function testGetSqlActiveSnippetDontUseStock()
    {
        $iCurrTime = time();
        oxTestModules::addFunction( "oxUtilsDate", "getTime", "{ return $iCurrTime; }");

        modConfig::getInstance()->setConfigParam( 'blUseStock', false );
        $this->oArticle->setAdminMode( true );
        $sTable = $this->oArticle->getViewName();
        $sDate = date( 'Y-m-d H:i:s', $iCurrTime );
        $sExpSelect  = "( (  $sTable.oxactive = 1  or ( $sTable.oxactivefrom < '$sDate' and $sTable.oxactiveto > '$sDate' ) )  ) ";
        $sSelect = $this->oArticle->getSqlActiveSnippet();
        $this->assertEquals( $sExpSelect, $sSelect);
    }



    /**
     * Test get variants.
     *
     * @return null
     */
    public function testGetVariants()
    {
        modConfig::getInstance()->setConfigParam( 'blUseStock', false );
        $this->oArticle->oxarticles__oxvarcount = new oxField(1, oxField::T_RAW);
        $this->oArticle2->oxarticles__oxactive = new oxField(1, oxField::T_RAW);
        $this->oArticle2->save();
        $oVariants = $this->oArticle->getVariants();
        $this->assertEquals( 1, count($oVariants));
        $this->assertEquals( '_testVar', $oVariants['_testVar']->oxarticles__oxid->value);
        $this->assertEquals( 'test', $oVariants['_testVar']->oxarticles__oxtitle->value);
    }

    /**
     * Test get variants with stock.
     *
     * @return null
     */
    public function testGetVariantsWithStock()
    {
        modConfig::getInstance()->setConfigParam( 'blUseStock', true );
        $this->oArticle->oxarticles__oxvarcount = new oxField(1, oxField::T_RAW);
        $this->oArticle2->oxarticles__oxactive = new oxField(1, oxField::T_RAW);
        $this->oArticle2->oxarticles__oxstock = new oxField(0, oxField::T_RAW);
        $this->oArticle2->oxarticles__oxstockflag = new oxField(3, oxField::T_RAW);
        $this->oArticle2->save();
        $oA = new oxarticle();
        $oA->load($this->oArticle->getId());

        $oVariants = $oA->getVariants(false);
        $this->assertEquals( 1, count($oVariants));
        $this->assertEquals( '_testVar', $oVariants['_testVar']->oxarticles__oxid->value);
        $this->assertEquals( 'test', $oVariants['_testVar']->oxarticles__oxtitle->value);
        $oVariants = $oA->getVariants(true);
        $this->assertEquals( 0, count($oVariants));
    }

    /**
     * Test get variants cached.
     *
     * @return null
     */
    public function testGetVariantsCached()
    {
        $oSubj = $this->getProxyClass('oxarticle');
        $oSubj->setNonPublicVar("_aVariants", 'testval1');
        $oSubj->setNonPublicVar("_aVariantsWithNotOrderables", 'testval2');
        $this->assertEquals('testval2', $oSubj->getVariants(false));
        $this->assertEquals('testval1', $oSubj->getVariants(true));
        $this->assertEquals('testval1', $oSubj->getVariants());
    }

    /**
     * Test get variants in list.
     *
     * @return null
     */
    public function testGetVariantsInList()
    {
        $oSubj = $this->getProxyClass('oxarticle');
        $oSubj->setInList();
            $sArtId = "2077";

        $oSubj->load($sArtId);
        $oVariants = $oSubj->getVariants();

        $this->assertTrue(count($oVariants) > 0);
        foreach ($oVariants as $oVariant) {
            $this->assertTrue($oVariant instanceof oxSimpleVariant);
        }
    }

    /**
     * Test get variants not in list.
     *
     * @return null
     */
    public function testGetVariants_NOT_InList()
    {
        $oSubj = $this->getProxyClass('oxarticle');
            $sArtId = "2077";

        $oSubj->load($sArtId);
        $oVariants = $oSubj->getVariants();

        $this->assertTrue(count($oVariants) > 0);
        foreach ($oVariants as $oVariant) {
            $this->assertTrue($oVariant instanceof oxArticle);
        }
    }

    /**
     * Test get variants with disabled variant loading.
     *
     * @return null
     */
    public function testGetVariantsIfNoVariantLoading()
    {
        $this->oArticle->setNonPublicVar("_blLoadVariants", false);
        $this->assertEquals( 0, count($this->oArticle->getVariants()));
    }

    /**
     * Test get variants with empty varcount.
     *
     * @return null
     */
    public function testGetVariantsEmptyVarCount()
    {
        $this->oArticle->oxarticles__oxvarcount = new oxField(0, oxField::T_RAW);
        $this->assertEquals( 0, count($this->oArticle->getVariants()));
    }

    /**
     * Test get variants with selectlists enabled.
     *
     * @return null
     */
    public function testGetVariantsLoadSelectLists()
    {
        modConfig::getInstance()->setConfigParam( 'blUseStock', false );
        modConfig::getInstance()->setConfigParam( 'bl_perfLoadSelectLists', true );
        $this->oArticle->oxarticles__oxvarcount = new oxField(1, oxField::T_RAW);
        $this->oArticle2->oxarticles__oxactive = new oxField(1, oxField::T_RAW);
        $this->oArticle2->save();
        $oVariants = $this->oArticle->getVariants();
        $this->assertEquals( 1, count($oVariants));
        $this->assertEquals( '_testVar', $oVariants['_testVar']->oxarticles__oxid->value);
        $this->assertEquals( 'test', $oVariants['_testVar']->oxarticles__oxtitle->value);
    }

    /**
     * Test get variants when not active.
     *
     * @return null
     */
    public function testGetVariantsNotActive()
    {
        $this->oArticle->oxarticles__oxvarcount = new oxField(1, oxField::T_RAW);
        $oVariants = $this->oArticle->getVariants();
        $this->assertEquals( 1, count($oVariants));
    }

    /**
     * Test get variants with disabled variant loading and varcount.
     *
     * @return null
     */
    public function testGetVariantsDoNotLoad()
    {
        modConfig::getInstance()->setConfigParam( 'blLoadVariants', false );
        $this->oArticle->oxarticles__oxvarcount = new oxField(1, oxField::T_RAW);
        $oVariants = $this->oArticle->getVariants();
        $this->assertEquals( 0, count($oVariants));
    }

    /**
     * Test remove inactive variants when not no stock.
     *
     * @return null
     */
    public function testRemoveInactiveVariantsNoStock()
    {
        $oParent = new oxarticle();
        $oParent->load( $this->oArticle2->oxarticles__oxparentid->value );
        $this->assertEquals( 1, $oParent->getVariants( true )->count() );
        $this->assertEquals( 1, $oParent->getVariants( false )->count() );

        // article stockflag is marked as offline
        $this->oArticle2->oxarticles__oxstock = new oxField(0, oxField::T_RAW);
        $this->oArticle2->oxarticles__oxstockflag = new oxField(2, oxField::T_RAW);
        $this->oArticle2->save();

        // reloading - resetting cache
        $oParent = new oxarticle();
        $oParent->load( $this->oArticle2->oxarticles__oxparentid->value );
        $this->assertEquals( 0, $oParent->getVariants( true )->count() );
        $this->assertEquals( 0, $oParent->getVariants( false )->count() );

        // article stockflag is marked as noorder
        $this->oArticle2->oxarticles__oxstock = new oxField(0, oxField::T_RAW);
        $this->oArticle2->oxarticles__oxstockflag = new oxField(3, oxField::T_RAW);
        $this->oArticle2->save();
        // reloading - resetting cache
        $oParent = new oxarticle();
        $oParent->load( $this->oArticle2->oxarticles__oxparentid->value );
        $this->assertEquals( 0, $oParent->getVariants( true )->count() );
        $this->assertEquals( 1, $oParent->getVariants( false )->count() );

    }

    /**
     * Test remove inactive variants when not no stock and not orderable.
     *
     * M:508
     *
     * @return null
     */
    public function testRemoveInactiveVariantsNoStockAndNotOrderable()
    {
        $this->oArticle2->oxarticles__oxstock = new oxField( 0, oxField::T_RAW );
        $this->oArticle2->oxarticles__oxstockflag = new oxField( 3, oxField::T_RAW );
        $this->oArticle2->save();

        $oParent = new oxarticle();
        $oParent->load( $this->oArticle2->oxarticles__oxparentid->value );
        $oVarList = $oParent->getVariants( false );

        // list must contain one item
        $this->assertEquals( 1, $oVarList->count() );
        $this->assertEquals( $this->oArticle2->getId(), $oVarList[$this->oArticle2->getId()]->oxarticles__oxid->value );

        // list must contain NO items
        $oVarList = $oParent->getVariants( true );
        $this->assertEquals( 0, $oVarList->count() );
    }

    /**
     * Test remove inactive variants from oxlist.
     *
     * @return null
     */
    public function testRemoveInactiveVariantsForeachWorksForOxList()
    {
        $oParent = new oxarticle();
        $oParent->load( $this->oArticle2->oxarticles__oxparentid->value );
        $this->assertEquals( 1, $oParent->getVariants( false )->count() );
        $this->assertEquals( 1, $oParent->getVariants( true )->count() );

        modConfig::getInstance()->setConfigParam( 'blVariantParentBuyable', false );
        $this->oArticle2->oxarticles__oxactive = new oxField(0, oxField::T_RAW);
        $this->oArticle2->save();

        $oParent = new oxarticle();
        $oParent->load( $this->oArticle2->oxarticles__oxparentid->value );
        $this->assertEquals( 0, $oParent->getVariants( false )->count() );
        $this->assertEquals( 0, $oParent->getVariants( true )->count() );
    }

    /**
     * Test remove inactive variants when not active.
     *
     * @return null
     */
    public function testRemoveInactiveVariantsNotActive()
    {
        modConfig::getInstance()->setConfigParam( 'blVariantParentBuyable', false );
        $this->oArticle2->oxarticles__oxactive = new oxField(0, oxField::T_RAW);
        $this->oArticle2->save();

        $oParent = new oxarticle();
        $oParent->load( $this->oArticle2->oxarticles__oxparentid->value );
        $this->assertEquals( 0, $oParent->getVariants( false )->count() );
        $this->assertEquals( 0, $oParent->getVariants( true )->count() );
        $this->assertTrue( $oParent->isNotBuyable() );
    }

    /**
     * Test remove inactive variants ant check if it sets not buyable flag to parent.
     *
     * @return null
     */
    public function testRemoveInactiveVariantsSetsNotBuyableParentFlag()
    {
        modConfig::getInstance()->setConfigParam( 'blVariantParentBuyable', false );

        $this->oArticle2->oxarticles__oxactive = new oxField(0, oxField::T_RAW);
        $this->oArticle2->save();

        $oParent = new oxarticle();
        $oParent->load( $this->oArticle2->oxarticles__oxparentid->value );
        $this->assertEquals( 0, $oParent->getVariants( false )->count() );
        $this->assertTrue( $oParent->isParentNotBuyable() );

        $this->assertEquals( 0, $oParent->getVariants( true )->count() );
        $this->assertTrue( $oParent->isParentNotBuyable() );
    }

    /**
     * Test get vendor id.
     *
     * @return null
     */
    public function testGetVendorId()
    {
        $sVendId = '68342e2955d7401e6.18967838';
        $this->oArticle->oxarticles__oxvendorid = new oxField($sVendId, oxField::T_RAW);
        $this->assertEquals( $sVendId, $this->oArticle->getVendorId( true) );
        $this->assertEquals( $sVendId, $this->oArticle->getVendorId() );
    }

    /**
     * Test get vendor id when it is not set.
     *
     * @return null
     */
    public function testGetVendorIdNotSet()
    {
        $sVendorId = $this->oArticle->getVendorId( true);
        $this->assertFalse( $sVendorId );
    }

    /**
     * Test get vendor id for non existing vendor.
     *
     * @return null
     */
    public function testGetVendorIdNotExist()
    {
        $this->oArticle->oxarticles__oxvendorid = new oxField('_xxx', oxField::T_RAW);
        $this->oArticle->save();
        $sVendorId = $this->oArticle->getVendorId( true);
        $this->assertFalse( $sVendorId );
    }

    /**
     * Test get manufacturer id.
     *
     * @return null
     */
    public function testGetManufacturerId()
    {
        $sManId = 'fe07958b49de225bd1dbc7594fb9a6b0';

        $this->oArticle->oxarticles__oxmanufacturerid = new oxField( $sManId, oxField::T_RAW );
        $this->assertEquals( $sManId, $this->oArticle->getManufacturerId( true) );
        $this->assertEquals( $sManId, $this->oArticle->getManufacturerId() );
    }

    /**
     * Test get manufacturer id when it is not set.
     *
     * @return null
     */
    public function testGetManufacturerIdNotSet()
    {
        $sVendorId = $this->oArticle->getManufacturerId( true);
        $this->assertFalse( $sVendorId );
    }

    /**
     * Test get manufacturer id for non existing vendor.
     *
     * @return null
     */
    public function testGetManufacturerIdNotExist()
    {
        $this->oArticle->oxarticles__oxvendorid = new oxField('_xxx', oxField::T_RAW);
        $this->oArticle->save();
        $sVendorId = $this->oArticle->getManufacturerId( true);
        $this->assertFalse( $sVendorId );
    }

    /**
     * Test get vendor and id.
     *
     * @return null
     */
    public function testGetVendorAndId()
    {
        $sVendId = '68342e2955d7401e6.18967838';

        $this->oArticle->oxarticles__oxvendorid = new oxField( $sVendId );
        $this->oArticle->save();
        $oExpVendor = new oxvendor();
        $oExpVendor->load( $sVendId );

        $oVendor = $this->oArticle->getVendor();
        $this->assertEquals( $oExpVendor->oxvendor__oxtitle->value, $oVendor->oxvendor__oxtitle->value );
    }

    /**
     * Test get vendor.
     *
     * @return null
     */
    public function testGetVendor()
    {
        $sVendId = '68342e2955d7401e6.18967838';

        $oArticle = $this->getMock( 'oxarticle', array( 'getVendorId' ) );
        $oArticle->expects( $this->any() )->method( 'getVendorId')->will( $this->returnValue( false ) );
        $oArticle->oxarticles__oxvendorid = new oxField( $sVendId );

        $oExpVendor = new oxvendor();
        $oExpVendor->load( $sVendId );

        $oVendor = $oArticle->getVendor( false );
        $this->assertEquals( $oExpVendor->oxvendor__oxtitle->value, $oVendor->oxvendor__oxtitle->value );
    }

    /**
     * Test get vendor readonly.
     *
     * @return null
     */
    public function testGetVendorReadonly()
    {
        $sVendId = '68342e2955d7401e6.18967838';

        modConfig::getInstance()->setConfigParam( 'bl_perfLoadVendorTree', false );
        $oArticle = $this->getMock( 'oxarticle', array( 'getVendorId' ) );
        $oArticle->expects( $this->any() )->method( 'getVendorId')->will( $this->returnValue( false ) );
        $oArticle->oxarticles__oxvendorid = new oxField( $sVendId );

        $oVendor = $oArticle->getVendor( false );
        $this->assertTrue( $oVendor->isReadOnly() );
    }

    /**
     * Test get vendor when not set.
     *
     * @return null
     */
    public function testGetVendorNotSet()
    {
        $this->assertNull( $this->oArticle->getVendor());
    }

    /**
     * Test get manufacturer and id.
     *
     * @return null
     */
    public function testGetManufacturerAndId()
    {
        $sManId = 'fe07958b49de225bd1dbc7594fb9a6b0';
        $this->oArticle->oxarticles__oxmanufacturerid = new oxField($sManId, oxField::T_RAW);
        $oMan = $this->oArticle->getManufacturer();
        $oExpMan = new oxmanufacturer();
        $oExpMan->load( $sManId );
        $this->assertEquals( $oExpMan->oxmanufacturers__oxtitle->value, $oMan->oxmanufacturers__oxtitle->value );
    }

    /**
     * Test get manufacturer.
     *
     * @return null
     */
    public function testGetManufacturer()
    {
        $sManId = 'fe07958b49de225bd1dbc7594fb9a6b0';

        $oArticle = $this->getMock( 'oxarticle', array( 'getManufacturerId' ) );
        $oArticle->expects( $this->any() )->method( 'getManufacturerId')->will( $this->returnValue( false ) );
        $oArticle->oxarticles__oxmanufacturerid = new oxField($sManId, oxField::T_RAW);

        $oExpMan = new oxmanufacturer();
        $oExpMan->load($sManId);

        $oMan = $oArticle->getManufacturer( false );
        $this->assertEquals( $oExpMan->oxmanufacturers__oxtitle->value, $oMan->oxmanufacturers__oxtitle->value );
    }

    /**
     * Test get manufacturer when readonly.
     *
     * @return null
     */
    public function testGetManufacturerReadOnly()
    {
        $sManId = 'fe07958b49de225bd1dbc7594fb9a6b0';

        modConfig::getInstance()->setConfigParam( 'bl_perfLoadManufacturerTree', false );
        $oArticle = $this->getMock( 'oxarticle', array( 'getManufacturerId' ) );
        $oArticle->expects( $this->any() )->method( 'getManufacturerId')->will( $this->returnValue( false ) );
        $oArticle->oxarticles__oxmanufacturerid = new oxField($sManId, oxField::T_RAW);

        $oMan = $oArticle->getManufacturer( false );
        $this->assertTrue( $oMan->isReadOnly() );
    }

    /**
     * Test get manufacturer when not set.
     *
     * @return null
     */
    public function testGetManufacturerNotSet()
    {
        $this->assertNull( $this->oArticle->getManufacturer());
    }

    /**
     * Test get search string.
     *
     * @return null
     */
    public function testGenerateSearchStr()
    {
        $sCatView = getViewName('oxcategories');
        $sO2CView = getViewName('oxobject2category');

        $sAxpSelect  = "select $sCatView.* from $sO2CView as oxobject2category left join $sCatView on
                        $sCatView.oxid = oxobject2category.oxcatnid
                        where oxobject2category.oxobjectid='".$this->oArticle->getId()."' and $sCatView.oxid is not null ";

        $sSelect = $this->oArticle->UNITgenerateSearchStr($this->oArticle->getId());
        $this->assertEquals( preg_replace( '/\W/', '', $sAxpSelect ), preg_replace( '/\W/', '', $sSelect ) );
    }

    /**
     * Test get search string with price category.
     *
     * @return null
     */
    public function testGenerateSearchStrWithSearchPriceCat()
    {
        $sCatView = getViewName('oxcategories');
        $this->oArticle->oxarticles__oxprice = new oxField(5, oxField::T_RAW);

        $sAxpSelect = "select {$sCatView}.* from [$sCatView} where
                       '{$this->oArticle->oxarticles__oxprice->value}' >= {$sCatView}.oxpricefrom and
                       '{$this->oArticle->oxarticles__oxprice->value}' <= {$sCatView}.oxpriceto ";

        $sSelect = $this->oArticle->UNITgenerateSearchStr( $this->oArticle->getId(), true);
        $this->assertEquals( preg_replace( '/\W/', '', $sAxpSelect ), preg_replace( '/\W/', '', $sSelect ) );
    }

    /**
     * Test if get category ads sql limit.
     *
     * @return null
     */
    public function testgetCategoryAddsSqlLimit()
    {
        oxTestModules::addFunction('oxcategory', 'assignRecord($sql)', '{throw new Exception($sql);}');
        $oArticle = new oxarticle();
        try {
            $oArticle->getCategory();
        } catch (Exception $e) {
            $this->assertTrue((bool)preg_match('/limit 1$/s', rtrim($e->getMessage())), 'regexp /limit 1$/ failed for '.$e->getMessage());
            return;
        }
        $this->fail();
    }

    /**
     * Test get assigned article category.
     *
     * @return null
     */
    public function testGetCategoryAssignedToCategory()
    {
        $oArticle = new oxarticle();
        $oArticle->load( '1126' );
        $oCategory = $oArticle->getCategory();

            $sCatId = "8a142c3e49b5a80c1.23676990";

        $this->assertNotNull( $oCategory );
        $this->assertEquals( $sCatId, $oCategory->getId() );
    }

    /**
     * Test get category by price.
     *
     * buglist#329 price category test
     *
     * @return null
     */
    public function testGetCategoryByPrice()
    {
        // creating price category
        $oPriceCategory = new oxcategory();
        $oPriceCategory->setId( '_testcat' );
        $oPriceCategory->oxcategories__oxparentid = new oxField('oxrootid', oxField::T_RAW);
        $oPriceCategory->oxcategories__oxleft = new oxField('1', oxField::T_RAW);
        $oPriceCategory->oxcategories__oxright = new oxField('2', oxField::T_RAW);
        $oPriceCategory->oxcategories__oxrootid = new oxField('_testCat', oxField::T_RAW);
        $oPriceCategory->oxcategories__oxactive = new oxField(1, oxField::T_RAW);
        $oPriceCategory->oxcategories__oxhidden = new oxField(0, oxField::T_RAW);
        $oPriceCategory->oxcategories__oxpricefrom = new oxField(99, oxField::T_RAW);
        $oPriceCategory->oxcategories__oxpriceto = new oxField(101, oxField::T_RAW);
        $oPriceCategory->oxcategories__oxshopid = new oxField(oxConfig::getInstance()->getBaseShopId(), oxField::T_RAW);
        $oPriceCategory->oxcategories__oxshopincl = new oxField(oxConfig::getInstance()->getBaseShopId(), oxField::T_RAW);
        $oPriceCategory->save();


        // creating not assigned article
        $oArticle = new oxArticle();
        $oArticle->setId( '_testprod' );
        $oArticle->oxarticles__oxactive = new oxField(1, oxField::T_RAW);
        $oArticle->oxarticles__oxprice = new oxField(100, oxField::T_RAW);
        $oArticle->oxarticles__oxshopid = new oxField(oxConfig::getInstance()->getBaseShopId(), oxField::T_RAW);
        $oArticle->oxarticles__oxshopincl = new oxField(oxConfig::getInstance()->getBaseShopId(), oxField::T_RAW);
        $oArticle->oxarticles__oxtitle = new oxField("test", oxField::T_RAW);
        $oArticle->save();

        $oCategory = $oArticle->getCategory();

        $this->assertNotNull( $oCategory );
        $this->assertEquals( $oPriceCategory->getId(), $oCategory->getId() );
    }

    /**
     * Test get article category when first assigned is denied by rights&roles.
     *
     * @return null
     */
    public function testGetCategoryFirstAssignedIsDeniedByRR()
    {
            return; // ee only

        $sRRCatId = "30e44ab8593023055.23928895";
        $sCatId   = "30e44ab83fdee7564.23264141";


        $iAction = 1;

        // adding
        $aGroups = array( 1, 2, 3 );

        $aIndexes = array();
        foreach ($aGroups as $iRRIdx) {
            $iOffset = ( int ) ( $iRRIdx / 31 );
            $iBitMap = 1 << ( $iRRIdx % 31 );

            // summing indexes
            if ( !isset( $aIndexes[ $iOffset ] ) )
                $aIndexes[ $iOffset ] = $iBitMap;
            else
                $aIndexes[ $iOffset ] = $aIndexes [ $iOffset ] | $iBitMap;
        }

        // iterating through indexes and applying to (sub)categories R&R
        foreach ( $aIndexes as $iOffset => $sIdx ) {
            // processing category
            $sRRId = oxUtilsObject::getInstance()->generateUID();
            $sQ  = "insert into oxobjectrights (oxid, oxobjectid, oxgroupidx, oxoffset, oxaction) ";
            $sQ .= "values ('_".$sRRId."', '$sRRCatId', $sIdx, $iOffset,  $iAction ) on duplicate key update oxgroupidx = (oxgroupidx | $sIdx ) ";
            oxDb::getDb()->Execute( $sQ );
        }

        $oArticle = new oxarticle();
        $oArticle->load( '1127' );
        $oCategory = $oArticle->getCategory();

        $this->assertNotNull( $oCategory );
        $this->assertNotEquals( $sRRCatId, $oCategory->getId() );
        $this->assertEquals( $sCatId, $oCategory->getId() );
    }

    /**
     * Test get price category.
     *
     * @return null
     */
    public function testGetPriceCategory()
    {
        $oPriceCat = new oxcategory();
        $oPriceCat->setId('_testCat');
        $oPriceCat->oxcategories__oxparentid = new oxField('oxrootid', oxField::T_RAW);
        $oPriceCat->oxcategories__oxextlink = new oxField('extlink', oxField::T_RAW);
        $oPriceCat->oxcategories__oxtitle = new oxField('test', oxField::T_RAW);
        $oPriceCat->oxcategories__oxactive = new oxField(1, oxField::T_RAW);
        $oPriceCat->oxcategories__oxhidden = new oxField(0, oxField::T_RAW);
        $oPriceCat->oxcategories__oxleft = new oxField('1', oxField::T_RAW);
        $oPriceCat->oxcategories__oxright = new oxField('2', oxField::T_RAW);
        $oPriceCat->oxcategories__oxrootid = new oxField('_testCat', oxField::T_RAW);
        $oPriceCat->oxcategories__oxpricefrom = new oxField('10', oxField::T_RAW);
        $oPriceCat->oxcategories__oxpriceto = new oxField('50', oxField::T_RAW);
        $oPriceCat->save();
        $this->oArticle->oxarticles__oxprice = new oxField(25, oxField::T_RAW);
        $oCat = $this->oArticle->getCategory();
        $this->assertEquals( $oPriceCat->getId(), $oCat->getId() );
    }

    /**
     * Test get price category for variant.
     *
     * @return null
     */
    public function testGetPriceCategoryForVar()
    {
        $oPriceCat = new oxcategory();
        $oPriceCat->setId('_testCat');
        $oPriceCat->oxcategories__oxparentid = new oxField('oxrootid', oxField::T_RAW);
        $oPriceCat->oxcategories__oxextlink = new oxField('extlink', oxField::T_RAW);
        $oPriceCat->oxcategories__oxtitle = new oxField('test', oxField::T_RAW);
        $oPriceCat->oxcategories__oxactive = new oxField(1, oxField::T_RAW);
        $oPriceCat->oxcategories__oxhidden = new oxField(0, oxField::T_RAW);
        $oPriceCat->oxcategories__oxleft = new oxField('1', oxField::T_RAW);
        $oPriceCat->oxcategories__oxright = new oxField('2', oxField::T_RAW);
        $oPriceCat->oxcategories__oxrootid = new oxField('_testCat', oxField::T_RAW);
        $oPriceCat->oxcategories__oxpricefrom = new oxField('10', oxField::T_RAW);
        $oPriceCat->oxcategories__oxpriceto = new oxField('50', oxField::T_RAW);
        $oPriceCat->save();
        $this->oArticle->oxarticles__oxprice = new oxField(25, oxField::T_RAW);
        $this->oArticle->save();
        $this->oArticle2->oxarticles__oxprice = new oxField(75, oxField::T_RAW);
        $oCat = $this->oArticle->getCategory();
        $this->assertEquals( $oPriceCat->oxcategories__oxid->value, $oCat->oxcategories__oxid->value);
    }

    /**
     * Test if get category returns empty result.
     *
     * @return null
     */
    public function testGetCategoryEmpty()
    {
        $this->oArticle->oxarticles__oxprice = new oxField(75, oxField::T_RAW);
        $oCat = $this->oArticle->getCategory();
        $this->assertNull( $oCat);
    }

    /**
     * Test if article is in category.
     *
     * @return null
     */
    public function testInCategory()
    {
        $oArticle = $this->getMock( 'oxarticle', array( 'getCategoryIds' ) );
        $oArticle->expects( $this->any() )->method( 'getCategoryIds')->will( $this->returnValue( array('123', '234') ) );
        $this->assertTrue( $oArticle->inCategory('123'));
    }

    /**
     * Test method isassignedtocategory when is assigned.
     *
     * @return null
     */
    public function testIsAssignedToCategoryIsAssigned()
    {
        $sCat = "8a142c3e4143562a5.46426637";
        oxDb::getDB()->execute("insert into oxobject2category (oxid, oxobjectid, oxcatnid) values ('test', '_testArt', '$sCat' )");
        $this->assertTrue( $this->oArticle->isAssignedToCategory( $sCat));
    }

    /**
     * Test method isassignedtocategory when is assigned to price category.
     *
     * @return null
     */
    public function testIsAssignedToCategoryIsAssignedIfPriceCat()
    {
        $this->oArticle->oxarticles__oxprice = new oxField(25, oxField::T_RAW);
        $this->oArticle->save();
            oxDb::getDB()->execute("insert into oxcategories (oxid, oxparentid, oxtitle, oxactive, oxleft, oxright, oxrootid, oxpricefrom, oxpriceto, oxlongdesc, oxlongdesc_1, oxlongdesc_2, oxlongdesc_3) values ('_testCat', 'oxrootid', 'test', 1, '1', '2', '_testCat', '10', '50', '', '', '', '')");
        $this->assertTrue( $this->oArticle->isAssignedToCategory( '_testCat'));
    }

    /**
     * Test method isassignedtocategory when not assigned.
     *
     * @return null
     */
    public function testIsAssignedToCategoryIsNotAssigned()
    {
        $sCat = "8a142c3e4143562a5.46426637";
        $this->assertFalse( $this->oArticle->isAssignedToCategory( $sCat));
    }

    /**
     * Test method isassignedtocategory with price = 0.
     *
     * @return null
     */
    public function testIsAssignedToCategoryWithPriceZero()
    {
        $this->oArticle->oxarticles__oxprice = new oxField(0, oxField::T_RAW);
        $this->oArticle->save();
        $sCat = "8a142c3e4143562a5.46426637";
        $this->assertFalse( $this->oArticle->isAssignedToCategory( $sCat));
    }

    /**
     * Test method isassignedtocategory with variant.
     *
     * @return null
     */
    public function testIsAssignedToCategoryVariant()
    {
        $this->oArticle->oxarticles__oxprice = new oxField(0, oxField::T_RAW);
        $this->oArticle->save();
        $this->oArticle2->oxarticles__oxprice = new oxField(25, oxField::T_RAW);
        $this->oArticle2->save();
            oxDb::getDB()->execute("insert into oxcategories (oxid, oxparentid, oxtitle, oxactive, oxleft, oxright, oxrootid, oxpricefrom, oxpriceto, oxlongdesc, oxlongdesc_1, oxlongdesc_2, oxlongdesc_3) values ('_testCat', 'oxrootid', 'test', 1, '1', '2', '_testCat', '10', '50', '', '', '', '')");
        $this->assertTrue( $this->oArticle2->isAssignedToCategory( '_testCat'));
    }

    /**
     * Test get old price.
     *
     * @return null
     */
    public function testGetTPrice()
    {
        $this->oArticle->oxarticles__oxvat = new oxField(7, oxField::T_RAW);
        $this->oArticle->oxarticles__oxtprice = new oxField(25, oxField::T_RAW);
        $oTPrice = $this->oArticle->getTPrice();
        $this->assertEquals( 25, $oTPrice->getBruttoPrice());
        $this->assertEquals( 7, $oTPrice->getVat());
    }

    /**
     * Test get cached old price.
     *
     * @return null
     */
    public function testGetTPriceCached()
    {
        $this->oArticle->oxarticles__oxvat = new oxField(7, oxField::T_RAW);
        $this->oArticle->oxarticles__oxtprice = new oxField(25, oxField::T_RAW);
        $oTPrice = $this->oArticle->getTPrice();
        $this->oArticle->oxarticles__oxvat = new oxField(19, oxField::T_RAW);
        $this->oArticle->oxarticles__oxtprice = new oxField(30, oxField::T_RAW);
        $oTPrice = $this->oArticle->getTPrice();
        $this->assertEquals( 25, $oTPrice->getBruttoPrice());
        $this->assertEquals( 7, $oTPrice->getVat());
    }

    /**
     * Test skip discounts option.
     *
     * @return null
     */
    public function testSkipDiscounts()
    {
        // making category
        $oCategory = oxNew( 'oxcategory' );
        $oCategory->setId( '_testCat' );
        $oCategory->oxcategories__oxparentid = new oxField('oxrootid', oxField::T_RAW);
        $oCategory->oxcategories__oxrootid = new oxField('_testCat', oxField::T_RAW);
        $oCategory->oxcategories__oxactive = new oxField(1, oxField::T_RAW);
        $oCategory->oxcategories__oxshopid = new oxField(oxConfig::getInstance()->getShopId(), oxField::T_RAW);
        $oCategory->oxcategories__oxtitle = new oxField('Test category 1', oxField::T_RAW);
        $oCategory->oxcategories__oxskipdiscounts = new oxField('1', oxField::T_RAW);
        $oCategory->save();

        // assigning article to category
        $oArt2Cat = oxNew( "oxbase" );
        $oArt2Cat->init( "oxobject2category" );
        $oArt2Cat->oxobject2category__oxobjectid = new oxField($this->oArticle->oxarticles__oxid->value, oxField::T_RAW);
        $oArt2Cat->oxobject2category__oxcatnid = new oxField('_testCat', oxField::T_RAW);
        $oArt2Cat->save();

        $this->assertTrue( $this->oArticle->skipDiscounts());
    }

    /**
     * Test skip discounts getter.
     *
     * @return null
     */
    public function testSkipDiscountsForArt()
    {
        // making category
        $this->oArticle->oxarticles__oxskipdiscounts = new oxField(1, oxField::T_RAW);

        $this->assertTrue( $this->oArticle->skipDiscounts());
    }

    /**
     * Test cached skip discounts option.
     *
     * @return null
     */
    public function testSkipDiscountsCached()
    {
            // making category
            $oCategory = oxNew( 'oxcategory' );
            $oCategory->setId( '_testCat' );
            $oCategory->oxcategories__oxparentid = new oxField('oxrootid', oxField::T_RAW);
            $oCategory->oxcategories__oxrootid = new oxField('_testCat', oxField::T_RAW);
            $oCategory->oxcategories__oxactive = new oxField(1, oxField::T_RAW);
            $oCategory->oxcategories__oxshopid = new oxField(oxConfig::getInstance()->getShopId(), oxField::T_RAW);
            $oCategory->oxcategories__oxtitle = new oxField('Test category 1', oxField::T_RAW);
            $oCategory->oxcategories__oxskipdiscounts = new oxField('1', oxField::T_RAW);
            $oCategory->save();

            // assigning article to category
            $oArt2Cat = oxNew( "oxbase" );
            $oArt2Cat->init( "oxobject2category" );
            $oArt2Cat->oxobject2category__oxobjectid = new oxField($this->oArticle->oxarticles__oxid->value, oxField::T_RAW);
            $oArt2Cat->oxobject2category__oxcatnid = new oxField('_testCat', oxField::T_RAW);
            $oArt2Cat->save();
            $this->oArticle->skipDiscounts();
            $oCategory->oxcategories__oxskipdiscounts = new oxField('0', oxField::T_RAW);
            $oCategory->save();
            $this->assertTrue( $this->oArticle->skipDiscounts());
    }

    /**
     * Test price setter.
     *
     * @return null
     */
    public function testSetPrice()
    {
        $oPrice = oxNew( 'oxPrice' );
        $oPrice->setPrice(125);
        $this->oArticle->setPrice( $oPrice);
        $oTPrice = $this->oArticle->getPrice();
        $this->assertEquals( 125, $oTPrice->getBruttoPrice());
    }

    /**
     * Test price setter disabled performance option.
     *
     * @return null
     */
    public function testGetPricePerformance()
    {
        modConfig::getInstance()->setConfigParam( 'bl_perfLoadPrice', false );
        $this->assertNull( $this->oArticle->getPrice());
    }

    /**
     * Test price getter when parent buyable with disabled performance option.
     *
     * buglist#413 if bl_perfLoadPriceForAddList variant price shouldn't be loaded too
     *
     * @return null
     */
    public function testGetPricePerformanceIfVariantHasPrice()
    {
        modConfig::getInstance()->setConfigParam( 'blVariantParentBuyable', false );
        $this->oArticle->oxarticles__oxvarcount = new oxField(1, oxField::T_RAW);
        $this->oArticle->save();
        $this->oArticle2->oxarticles__oxactive = new oxField(1, oxField::T_RAW);
        $this->oArticle2->oxarticles__oxstock = new oxField(5, oxField::T_RAW);
        $this->oArticle2->save();
        $oArticle = new _oxArticle();
        $oArticle->disablePriceLoad( $oArticle );
        $oArticle->load($this->oArticle->getId());
        $this->assertNull( $oArticle->getPrice());
    }

    /**
     * Test price getter calls base price getter only with disabled calcprice option.
     *
     * @return null
     */
    public function testGetPriceCallsGetBasePriceOnlyInNoCalcPrice()
    {
        $oArticle = $this->getMock( '_oxArticle', array( 'getBasePrice', '_applyCurrency' ) );
        $oArticle->expects( $this->any() )->method( 'getBasePrice')->will( $this->returnValue( 123 ) );
        $oArticle->expects( $this->never() )->method( '_applyCurrency');

        $oArticle->setVar( 'blCalcPrice', false);
        $oTPrice = $oArticle->getPrice();
        $this->assertEquals( 123, $oTPrice->getBruttoPrice());

    }

    /**
     * Test price getter.
     *
     * @return null
     */
    public function testGetPrice()
    {
        $oArticle = $this->getMock( 'oxarticle', array( 'getBasePrice', 'skipDiscounts' ) );
        $oArticle->expects( $this->any() )->method( 'getBasePrice')->will( $this->returnValue( 123 ) );
        $oArticle->expects( $this->any() )->method( 'skipDiscounts')->will( $this->returnValue( false ) );
        $oTPrice = $oArticle->getPrice();
        $this->assertEquals( 123, $oTPrice->getBruttoPrice());
    }

    /**
     * Test base price getter disabled by performance option.
     *
     * @return null
     */
    public function testGetBasePricePerformance()
    {
        modConfig::getInstance()->setConfigParam( 'bl_perfLoadPrice', false );
        $this->assertNull( $this->oArticle->getBasePrice());
    }

    /**
     * Test base price getter.
     *
     * @return null
     */
    public function testGetBasePrice()
    {
        $this->oArticle->oxarticles__oxprice = new oxField(45, oxField::T_RAW);
        $this->assertEquals( 45, $this->oArticle->getBasePrice());
    }

    /**
     * Test article VAT getter.
     *
     * @return null
     */
    public function testGetArticleVat()
    {
        oxTestModules::addFunction('oxVatSelector', 'setInst', '{oxVatSelector::$_instance = $aA[0];}');
        oxTestModules::addFunction('oxVatSelector', 'getArticleVat', '{return 99;}');
        oxNew('oxVatSelector')->setInst(null);
        $oA = new oxArticle();
        $this->assertEquals(99, $oA->getArticleVat());
        oxTestModules::addFunction('oxVatSelector', 'getArticleVat', '{return 98;}');
        oxNew('oxVatSelector')->setInst(null);
        // cached value, do not recalculate
        $this->assertEquals(99, $oA->getArticleVat());
        // check for new article
        $oA = new oxArticle();
        $this->assertEquals(98, $oA->getArticleVat());
        oxNew('oxVatSelector')->setInst(null);
    }

    /**
     * Test apply VAT.
     *
     * @return null
     */
    public function testApplyVAT()
    {
        $oPrice = oxNew( 'oxPrice' );
        $oPrice->setPrice(125);
        $this->oArticle->UNITapplyVAT( $oPrice, 7);
        $this->assertEquals( 7, $oPrice->getVat());
    }

    /**
     * Test apply VAT's.
     *
     * @return null
     */
    public function testApplyVats()
    {
        $oPrice = oxNew( 'oxPrice' );
        $oPrice->setPrice(125);

        oxTestModules::addFunction('oxVatSelector', 'setInst', '{oxVatSelector::$_instance = $aA[0];}');
        oxTestModules::addFunction('oxVatSelector', 'getArticleVat', '{return 99;}');
        oxNew('oxVatSelector')->setInst(null);

        $oArticle = $this->getMock( 'oxArticle', array( '_applyVAT' ) );
        $oArticle->expects( $this->once() )->method( '_applyVAT')->will( $this->returnValue( null ) )->with( $oPrice, 99 );

        $oArticle->applyVats($oPrice);

        oxNew('oxVatSelector')->setInst(null);
    }

    /**
     * Test apply user VAT.
     *
     * @return null
     */
    public function testApplyUserVAT()
    {
        oxTestModules::addFunction('oxVatSelector', 'setInst', '{oxVatSelector::$_instance = $aA[0];}');
        oxTestModules::addFunction('oxVatSelector', 'getUserVat', '{return 19;}');
        oxNew('oxVatSelector')->setInst(null);

        $oPrice = oxNew( 'oxPrice' );
        $oPrice->setPrice(125);
        $oUser = new oxuser();
        $oUser->load( 'oxdefaultadmin');
        $oArticle = new oxarticle();
        $oArticle->setUser( $oUser);
        $oArticle->UNITapplyVAT( $oPrice, 7);
        $this->assertEquals( 19, $oPrice->getVat());

        oxNew('oxVatSelector')->setInst(null);
    }

    /**
     * Test apply discounts.
     *
     * @return null
     */
    public function testApplyDiscounts()
    {
        //$oDiscount = $this->getMock( 'oxdiscount', array( 'getAbsValue') );
        //$oDiscount->expects( $this->any() )->method( 'getAbsValue')->will( $this->returnValue( 13 ) );

        $oDiscount = new oxdiscount();
        $oDiscount->oxdiscount__oxaddsumtype = new oxField('abs', oxField::T_RAW);
        $oDiscount->oxdiscount__oxaddsum = new oxField(13, oxField::T_RAW);

        $aDiscounts = array($oDiscount);
        $oPrice = oxNew( 'oxPrice' );
        $oPrice->setPrice(123);
        $this->oArticle->UNITapplyDiscounts( $oPrice, $aDiscounts);
        $this->assertEquals( 110, $oPrice->getBruttoPrice());
    }

    /**
     * Test apply discounts for variant.
     *
     * @return null
     */
    public function testApplyDiscountsForVariant()
    {
        oxDiscountList::getInstance()->forceReload();

        $oDiscount = oxNew('oxDiscount');
        $oDiscount->setId("_testDiscount");
        $oDiscount->oxdiscount__oxactive = new oxField(1, oxField::T_RAW);
        $oDiscount->oxdiscount__oxaddsumtype = new oxField('abs', oxField::T_RAW);
        $oDiscount->oxdiscount__oxaddsum = new oxField(13, oxField::T_RAW);
        $oDiscount->oxdiscount__oxprice = new oxField(0, oxField::T_RAW);
        $oDiscount->oxdiscount__oxpriceto = new oxField(999, oxField::T_RAW);
        $oDiscount->oxdiscount__oxamount = new oxField(0, oxField::T_RAW);
        $oDiscount->oxdiscount__oxamountto = new oxField(999, oxField::T_RAW);
        $oDiscount->save();

        $oPrice = oxNew( 'oxPrice' );
        $oPrice->setPrice(123);
        $this->oArticle->applyDiscountsForVariant( $oPrice );
        $this->assertEquals( 110, $oPrice->getBruttoPrice());
    }

    /**
     * Test apply currency.
     *
     * @return null
     */
    public function testApplyCurrency()
    {
        modConfig::setParameter( 'currency', 2 );

        $oPrice = oxNew( 'oxPrice' );
        $oPrice->setPrice(100 );
        $this->oArticle->UNITapplyCurrency( $oPrice );
        $this->assertEquals( 143.26, $oPrice->getBruttoPrice());
        oxConfig::getInstance()->setActShopCurrency(0);
    }

    /**
     * Test apply currency with optional currency object.
     *
     * @return null
     */
    public function testApplyCurrencyIfObjSet()
    {
        $oCur = new StdClass;
        $oCur->rate = 0.68;
        $oPrice = oxNew( 'oxPrice' );
        $oPrice->setPrice(100 );
        $this->oArticle->UNITapplyCurrency( $oPrice, $oCur );
        $this->assertEquals( 68, $oPrice->getBruttoPrice());
    }

    /**
     * Test get basket price.
     *
     * @return null
     */
    public function testGetBasketPrice()
    {
        $oArticle = $this->getMock( 'oxarticle', array( 'getBasePrice', '_applyVAT', 'skipDiscounts' ) );
        $oArticle->expects( $this->any() )->method( 'getBasePrice')->will( $this->returnValue( 90 ) );
        $oArticle->expects( $this->any() )->method( '_applyVAT');
        $oArticle->expects( $this->any() )->method( 'skipDiscounts')->will( $this->returnValue( true ) );
        $oPrice = $oArticle->getBasketPrice( 2, array(), new oxbasket() );
        $this->assertEquals( 90, $oPrice->getBruttoPrice());
    }

    /**
     * Test if get basket price sets basket user.
     *
     * @return null
     */
    public function testGetBasketPriceSetsBasketUser()
    {
        $oArticle = $this->getMock( 'oxarticle', array( 'getBasePrice', '_applyVAT', 'skipDiscounts' ) );
        $oArticle->expects( $this->any() )->method( 'getBasePrice')->will( $this->returnValue( 90 ) );
        $oArticle->expects( $this->any() )->method( '_applyVAT');
        $oArticle->expects( $this->any() )->method( 'skipDiscounts')->will( $this->returnValue( true ) );

        $oUser = new oxUser;
        $oUser->iamtheone = 'test';
        $oBasket = $this->getMock( 'oxbasket', array( 'getBasketUser' ) );
        $oBasket->expects( $this->any() )->method( 'getBasketUser')->will( $this->returnValue( $oUser ) );
        $oPrice = $oArticle->getBasketPrice( 2, array(), $oBasket );
        $this->assertSame( $oUser, $oArticle->getArticleUser() );
    }

    /**
     * Test get basket price with discount.
     *
     * @return null
     */
    public function testGetBasketPriceWithDiscount()
    {
        oxDiscountList::getInstance()->forceReload();
        $oArticle = $this->getMock( 'oxarticle', array( 'getBasePrice', '_applyVAT', 'skipDiscounts' ) );
        $oArticle->expects( $this->any() )->method( 'getBasePrice')->will( $this->returnValue( 90 ) );
        $oArticle->expects( $this->any() )->method( '_applyVAT');
        $oArticle->expects( $this->any() )->method( 'skipDiscounts')->will( $this->returnValue( false ) );
        $oPrice = $oArticle->getBasketPrice( 2, array(), new oxbasket() );
        $this->assertEquals( 90, $oPrice->getBruttoPrice());
    }

    /**
     * Test get basket price with same discount.
     *
     * @return null
     */
    public function testGetBasketPriceWithTheSameDiscount()
    {
        oxDiscountList::getInstance()->forceReload();
        $oArticle = $this->getMock( 'oxarticle', array( 'getBasePrice', '_applyVAT', 'skipDiscounts' ) );
        $oArticle->expects( $this->any() )->method( 'getBasePrice')->will( $this->returnValue( 90 ) );
        $oArticle->expects( $this->any() )->method( '_applyVAT');
        $oArticle->expects( $this->any() )->method( 'skipDiscounts')->will( $this->returnValue( false ) );
        $oPrice = $oArticle->getBasketPrice( 2, array(), new oxbasket() );
        $this->assertEquals( 90, $oPrice->getBruttoPrice());
    }

    /**
     * Test article delete.
     *
     * @return null
     */
    public function testDelete()
    {
        oxTestModules::addFunction('oxSeoEncoderArticle', 'onDeleteArticle', '{$this->onDeleteArticleCnt++;}');
        oxTestModules::addFunction('oxSeoEncoderArticle', 'resetInst', '{self::$_instance = $this;}');
        oxNew('oxSeoEncoderArticle')->resetInst();
        oxSeoEncoderArticle::getInstance()->onDeleteArticleCnt = 0;
        $this->oArticle2->delete();
        $oArticle = new oxarticle();
        $this->assertFalse( $oArticle->load('_testVar'));
        $this->assertEquals(1, oxSeoEncoderArticle::getInstance()->onDeleteArticleCnt);
    }

    /**
     * Test article delete also deletes variants.
     *
     * @return null
     */
    public function testDeleteParentArt()
    {
        $this->oArticle->delete();
        $oArticle = new oxarticle();
        $this->assertFalse( $oArticle->load('_testArt'));
        $this->assertFalse( $oArticle->load('_testVar'));
    }

    /**
     * Test empty article delete.
     *
     * @return null
     */
    public function testDeleteEmptyArt()
    {
        $oArticle = new oxarticle();
        $this->assertFalse( $oArticle->delete());
    }

    /**
     * Test article delete with optionall id parameter.
     *
     * @return null
     */
    public function testDeleteWithId()
    {
        $oArticle = new oxarticle();
        $this->assertTrue( $oArticle->delete('_testArt'));
    }

    /**
     * Test delete article variant records.
     *
     * @return null
     */
    public function testDeleteVariantRecords()
    {
        $this->oArticle->UNITdeleteVariantRecords( $this->oArticle->oxarticles__oxid->value );
        $this->assertFalse( $this->oArticle2->load('_testVar') );
    }

    /**
     * Test delete records.
     *
     * @return null
     */
    public function testDeleteRecords()
    {
        oxDb::getDB()->execute("insert into oxobject2article (oxarticlenid, oxobjectid) values ('_testArt', 'test' )");
        oxDb::getDB()->execute("insert into oxobject2attribute (oxobjectid, oxattrid) values ('_testArt', 'test' )");
        oxDb::getDB()->execute("insert into oxobject2category (oxobjectid, oxcatnid) values ('_testArt', 'test' )");
        oxDb::getDB()->execute("insert into oxobject2selectlist (oxobjectid, oxselnid) values ('_testArt', 'test' )");
        oxDb::getDB()->execute("insert into oxprice2article (oxartid, oxaddabs) values ('_testArt', 25 )");
        oxDb::getDB()->execute("insert into oxreviews (oxtype, oxobjectid, oxtext) values ('oxarticle', '_testArt', 'test' )");
        oxDb::getDB()->execute("insert into oxaccessoire2article (oxobjectid, oxarticlenid) values ('_testArt', 'test' )");
        oxDb::getDB()->execute("insert into oxobject2delivery (oxobjectid, oxtype, oxdeliveryid) values ('_testArt', 'oxarticles', 'test' )");
        oxDb::getDB()->execute("update oxartextends set oxlongdesc = 'test' where oxid = '_testArt'");
        oxDb::getDB()->execute("insert into oxactions2article (oxartid, oxactionid) values ('_testArt', 'test' )");
        oxDb::getDB()->execute("insert into oxobject2list (oxobjectid, oxlistid) values ('_testArt', 'test' )");
        $this->oArticle->UNITdeleteRecords('_testArt');
        $this->assertFalse( oxDb::getDB()->getOne("select oxid from oxobject2article where oxarticlenid = '_testArt'") );
        $this->assertFalse( oxDb::getDB()->getOne("select oxid from oxobject2attribute where oxobjectid = '_testArt'") );
        $this->assertFalse( oxDb::getDB()->getOne("select oxid from oxobject2category where oxobjectid = '_testArt'") );
        $this->assertFalse( oxDb::getDB()->getOne("select oxid from oxobject2selectlist where oxobjectid = '_testArt'") );
        $this->assertFalse( oxDb::getDB()->getOne("select oxid from oxprice2article where oxartid = '_testArt'") );
        $this->assertFalse( oxDb::getDB()->getOne("select oxid from oxreviews where oxtype = 'oxarticle' and oxobjectid = '_testArt'") );
        $this->assertFalse( oxDb::getDB()->getOne("select oxid from oxaccessoire2article where oxobjectid = '_testArt'") );
        $this->assertFalse( oxDb::getDB()->getOne("select oxid from oxobject2delivery where oxobjectid = '_testArt'") );
        $this->assertFalse( oxDb::getDB()->getOne("select oxid from oxartextends where oxid = '_testArt'") );
        $this->assertFalse( oxDb::getDB()->getOne("select oxid from oxactions2article where oxartid = '_testArt'") );
        $this->assertFalse( oxDb::getDB()->getOne("select oxid from oxobject2list where oxobjectid = '_testArt'") );
    }

    /**
     * Test get A group price.
     *
     * @return null
     */
    public function testGetGroupPricePriceA()
    {
        $this->oArticle->oxarticles__oxpricea = new oxField(12, oxField::T_RAW);
        $this->oArticle->save();
        $oUser = $this->getMock( 'oxuser', array( 'inGroup' ) );
        $oUser->expects( $this->any() )->method( 'inGroup')->will( $this->returnValue( true ) );
        $oArticle = $this->getMock( 'oxarticle', array( 'getUser' ) );
        $oArticle->expects( $this->any() )->method( 'getUser')->will( $this->returnValue( $oUser ) );
        $oArticle->load('_testArt');
        $this->assertEquals( 12, $oArticle->UNITgetGroupPrice() );
    }

    /**
     * Test get B group price.
     *
     * @return null
     */
    public function testGetGroupPricePriceB()
    {
        $this->oArticle->oxarticles__oxpriceb = new oxField(12, oxField::T_RAW);
        $this->oArticle->save();
        $oUser = $this->getMock( 'oxuser', array( 'inGroup' ) );
        $oUser->expects( $this->any() )->method( 'inGroup' )->will($this->onConsecutiveCalls( $this->returnValue( false ), $this->returnValue( true ), $this->returnValue( false ) ) );
        $oArticle = new oxarticle();
        $oArticle->load('_testArt');
        $oArticle->setUser( $oUser );
        $this->assertEquals( 12, $oArticle->UNITgetGroupPrice() );
    }

    /**
     * Test get C group price.
     *
     * @return null
     */
    public function testGetGroupPricePriceC()
    {
        $this->oArticle->oxarticles__oxpricec = new oxField(12, oxField::T_RAW);
        $this->oArticle->save();
        $oUser = $this->getMock( 'oxuser', array( 'inGroup' ) );
        $oUser->expects( $this->any() )->method( 'inGroup' )->will($this->onConsecutiveCalls( $this->returnValue( false ), $this->returnValue( false ), $this->returnValue( true ) ) );
        $oArticle = new oxarticle();
        $oArticle->load('_testArt');
        $oArticle->setUser( $oUser );
        $oArticle->oxarticles__oxprice->value = 15;
        $this->assertEquals( 12, $oArticle->UNITgetGroupPrice() );
    }

    /**
     * Test if zero group prices are set generic price depending on config option.
     *
     * @return null
     */
    public function testModifyGroupPricePriceAZero()
    {
        $this->oArticle->oxarticles__oxprice = new oxField(15, oxField::T_RAW);
        $this->oArticle->oxarticles__oxpricea = new oxField(0, oxField::T_RAW);
        $this->oArticle->save();
        $oUser = $this->getMock( 'oxuser', array( 'inGroup' ) );
        $oUser->expects( $this->any() )->method( 'inGroup')->will( $this->returnValue( true ) );
        $oArticle = new oxarticle();
        $oArticle->load('_testArt');
        $oArticle->setUser($oUser);
        $oArticle->oxarticles__oxprice->value = 15;
        modConfig::getInstance()->setConfigParam( 'blOverrideZeroABCPrices', false );
        $dPrice = $oArticle->UNITgetGroupPrice();
        $this->assertEquals( 0, $dPrice );
        modConfig::getInstance()->setConfigParam( 'blOverrideZeroABCPrices', true );
        $oArticle->oxarticles__oxprice->value = 15;
        $this->assertEquals( 15, $oArticle->UNITgetGroupPrice() );
    }

    /**
     * Test get amount price without modification.
     *
     * @return null
     */
    public function testGetAmountPriceNoStaffelPrice()
    {
        $this->oArticle->oxarticles__oxprice->value = 15;
        $this->assertEquals( 15, $this->oArticle->UNITgetAmountPrice(2) );
    }

    /**
     * Test modify select list price.
     *
     * FS#1916
     *
     * @return null
     */
    public function testModifySelectListPrice()
    {
        $myDB     = oxDb::getDB();
        $myConfig = oxConfig::getInstance();
        $oCurrency = $myConfig->getActShopCurrencyObject();

        $sShopId = $myConfig->getBaseShopId();
        $sVal = 'three!P!-5,99__threeValue@@two!P!-2__twoValue@@';

            $sQ = 'insert into oxselectlist (oxid, oxshopid, oxtitle, oxident, oxvaldesc) values ("oxsellisttest", "'.$sShopId.'", "oxsellisttest", "oxsellisttest", "'.$sVal.'")';
        $myDB->Execute( $sQ );

        $sQ = 'insert into oxobject2selectlist values ("oxsellisttest", "1651", "oxsellisttest", 1) ';
        $myDB->Execute( $sQ );

        modConfig::getInstance()->setConfigParam( 'bl_perfLoadSelectLists', true );
        modConfig::getInstance()->setConfigParam( 'bl_perfUseSelectlistPrice', true );

        $oArticle = new _oxArticle();
        $oArticle->load('1651');
        $oArticle->resetVar();
        $this->assertEquals( 4.01, $oArticle->UNITmodifySelectListPrice(10, array(0=>0)) );
    }

    /**
     * Test amount price loading.
     *
     * @return null
     */
    public function testAmountPricesLoading()
    {
        $sShopId = oxConfig::getInstance()->getShopId();
        $sSql  = "insert into oxprice2article (oxid, oxartid, oxshopid, oxaddabs, oxamount, oxamountto)";
        $sSql .= " values ('test1', '_testArt', '".$sShopId."', 5.5, 10, 99999999 )";
        oxDb::getDB()->execute($sSql);
        $sSql  = "insert into oxprice2article (oxid, oxartid, oxshopid, oxaddabs, oxamount, oxamountto)";
        $sSql .= " values ('test2', '_testArt', '".$sShopId."', 6.5, 5, 10 )";
        oxDb::getDB()->execute($sSql);
        //$dPrice = 15;
        //$blPrice = $this->oArticle->UNITmodifyAmountPrice($dPrice, 12);
        //$this->assertTrue( $blPrice );
        //$this->assertEquals( 25, $dPrice );
        //calling getBasePrice() because can't test protected functions with passed by reference arguments
        $dBasePrice = $this->oArticle->getBasePrice(12);
        $this->assertEquals( 5.5, $dBasePrice );
    }

    /**
     * Test amount price loading without given amount.
     *
     * @return null
     */
    public function testAmountPricesLoadingNotSpecificAmount()
    {
        $sShopId = oxConfig::getInstance()->getShopId();
        $sSql  = "insert into oxprice2article (oxid, oxartid, oxshopid, oxaddabs, oxamount, oxamountto)";
        $sSql .= " values ('test1', '_testArt', '".$sShopId."', 5.5, 10, 12 )";
        oxDb::getDB()->execute($sSql);
        $sSql  = "insert into oxprice2article (oxid, oxartid, oxshopid, oxaddabs, oxamount, oxamountto)";
        $sSql .= " values ('test2', '_testArt', '".$sShopId."', 6.5, 5, 10 )";
        oxDb::getDB()->execute($sSql);
        //$dPrice = 15;
        //$blPrice = $this->oArticle->UNITmodifyAmountPrice($dPrice, 12);
        //$this->assertTrue( $blPrice );
        //$this->assertEquals( 25, $dPrice );
        //calling getBasePrice() because can't test protected functions with passed by reference arguments
        $dBasePrice = $this->oArticle->getBasePrice(13);
        $this->assertEquals( 15.5, $dBasePrice );
    }


    /**
     * Test amount price loading for variants.
     *
     * @return null
     */
    public function testAmountPricesLoadingForVariants()
    {
        modConfig::getInstance()->setConfigParam( 'blVariantInheritAmountPrice', true );
        $sShopId = oxConfig::getInstance()->getShopId();
        $sSql  = "insert into oxprice2article (oxid, oxartid, oxshopid, oxaddperc, oxamount, oxamountto)";
        $sSql .= " values ('test1', '_testArt', '".$sShopId."', 10, 11, 99999999 )";
        oxDb::getDB()->execute($sSql);
        $sSql  = "insert into oxprice2article (oxid, oxartid, oxshopid, oxaddperc, oxamount, oxamountto)";
        $sSql .= " values ('test2', '_testArt', '".$sShopId."', 9, 5, 10 )";
        oxDb::getDB()->execute($sSql);

        //$dPrice = 15;
        //$blPrice = $this->oArticle2->UNITmodifyAmountPrice($dPrice, 12);
        //$this->assertTrue( $blPrice );
        //$this->assertEquals( 13.5, $dPrice );

        //calling getBasePrice() because can't test protected functions with passed by reference arguments
        $dBasePrice = $this->oArticle2->getBasePrice(12);
        $this->assertEquals( 10.98, $dBasePrice );
    }

    /**
     * Test amount price loading for variants without given amount.
     *
     * @return null
     */
    public function testAmountPricesLoadingForVariantsNotSpecificAmount()
    {
        modConfig::getInstance()->setConfigParam( 'blVariantInheritAmountPrice', true );
        $sShopId = oxConfig::getInstance()->getShopId();
        $sSql  = "insert into oxprice2article (oxid, oxartid, oxshopid, oxaddperc, oxamount, oxamountto)";
        $sSql .= " values ('test1', '_testArt', '".$sShopId."', 10, 11, 13 )";
        oxDb::getDB()->execute($sSql);
        $sSql  = "insert into oxprice2article (oxid, oxartid, oxshopid, oxaddperc, oxamount, oxamountto)";
        $sSql .= " values ('test2', '_testArt', '".$sShopId."', 11, 5, 10 )";
        oxDb::getDB()->execute($sSql);

        //$dPrice = 15;
        //$blPrice = $this->oArticle2->UNITmodifyAmountPrice($dPrice, 12);
        //$this->assertTrue( $blPrice );
        //$this->assertEquals( 13.5, $dPrice );

        //calling getBasePrice() because can't test protected functions with passed by reference arguments
        $dBasePrice = $this->oArticle2->getBasePrice(15);
        $this->assertEquals( 12.2, $dBasePrice );
    }

    /**
     * Test update sold amount without given amount.
     *
     * @return null
     */
    public function testUpdateSoldAmountNotSet()
    {
        $blRet = $this->oArticle->updateSoldAmount(null);
        $this->assertNull( $blRet );
    }

    /**
     * Test update sold amount.
     *
     * @return null
     */
    public function testUpdateSoldAmount()
    {
        $oDB = oxDb::getDB();
        $oDB->getOne("update oxarticles set oxtimestamp = '2005-03-24 14:33:53' where oxid = '_testArt'");
        $sTimeStamp = $oDB->getOne("select oxtimestamp from oxarticles where oxid = '_testArt'");
        $rs = $this->oArticle->updateSoldAmount(1);
        $this->assertTrue( $rs->EOF );
        $this->assertEquals( 1, $oDB->getOne("select oxsoldamount from oxarticles where oxid = '_testArt'") );
        $this->assertNotEquals( $sTimeStamp, $oDB->getOne("select oxtimestamp from oxarticles where oxid = '_testArt'") );
    }

    /**
     * Test update sold amount for variant.
     *
     * @return null
     */
    public function testUpdateSoldAmountVariant()
    {
        $this->oArticle2->updateSoldAmount(2);
        $this->assertEquals( 0, oxDb::getDB()->getOne("select oxsoldamount from oxarticles where oxid = '_testVar'") );
        $this->assertEquals( 2, oxDb::getDB()->getOne("select oxsoldamount from oxarticles where oxid = '_testArt'") );
    }

    /**
     * Test disable reminder.
     *
     * @return null
     */
    public function testDisableReminder()
    {
        $rs = $this->oArticle->disableReminder(1);
        $this->assertTrue( $rs->EOF );
        $this->assertEquals( 2, oxDb::getDB()->getOne("select oxremindactive from oxarticles where oxid = '_testArt'") );
    }

    /**
     * Test set article long description.
     *
     * @return null
     */
    public function testSetArticleLongDesc()
    {
        $this->oArticle->oxarticles__oxlongdesc = new oxField("LongDesc", oxField::T_RAW);
        $this->oArticle->setArticleLongDesc();
        $this->assertEquals( "LongDesc", oxDb::getDB()->getOne("select oxlongdesc from oxartextends where oxid = '_testArt'") );
    }

    /**
     * Test save article.
     *
     * @return null
     */
    public function testSave()
    {
        $this->oArticle->oxarticles__oxtitle = new oxField("newTitle", oxField::T_RAW);
        $this->oArticle->save();
        $this->assertEquals( "newTitle", oxDb::getDB()->getOne("select oxtitle from oxarticles where oxid = '_testArt'") );
    }

    /**
     * Test save if picture folder is removed.
     *
     * FS#2580
     *
     * @return null
     */
    public function testSaveIfRemovedFoldersForPics()
    {
        $this->oArticle->oxarticles__oxpic1  = new oxField("http:/shopurl/p1/pic.jpg", oxField::T_RAW);
        $this->oArticle->save();
        $this->assertEquals( "pic.jpg", oxDb::getDB()->getOne("select oxpic1 from oxarticles where oxid = '_testArt'") );
    }

    /**
     * Test save updates timestamp.
     *
     * FS#1958
     *
     * @return null
     */
    public function testSaveAndUpdateTimeStamp()
    {
        oxDb::getDB()->execute("update oxarticles set oxtimestamp='2005-06-06 10:10:10' where oxid = '_testArt'");
        $this->oArticle->oxarticles__oxtitle = new oxField("newTitle", oxField::T_RAW);
        $this->oArticle->save();
        $this->assertNotEquals( '2005-06-06 10:10:10', oxDb::getDB()->getOne("select oxtimestamp from oxarticles where oxid = '_testArt'") );
    }

    /**
     * Test save custom price.
     *
     * @return null
     */
    public function testSaveCustomPrice()
    {
    }

    /**
     * Test get picture galery.
     *
     * @return null
     */
    public function testGetPictureGallery1()
    {
            $sArtID = "1126";

        $sRawPath = oxConfig::getInstance()->getPictureUrl(null);
        $oArticle = new oxarticle();
        $oArticle->load($sArtID);

        $aPicGallery = $oArticle->getPictureGallery();

        $sActPic = $sRawPath.$oArticle->oxarticles__oxpic1->value;
        $this->assertEquals($sActPic, $aPicGallery['ActPic']);
        $aPicGallery = $oArticle->getPictureGallery();

        modConfig::setParameter('actpicid', 2);
        $aPicGallery = $oArticle->getPictureGallery();
        $this->assertEquals(2, $aPicGallery['ActPicID']);
    }

    /**
     * Test onChange event does nothing for new article.
     *
     * @return null
     */
    public function testOnChangeNewArt()
    {
        $oArticle = new oxarticle();
        $this->assertNull($oArticle->onChange());
    }

    /**
     * Test onChange event updates stock.
     *
     * @return null
     */
    public function testOnChangeUpdateStock()
    {
        $this->oArticle2->oxarticles__oxstock = new oxField(2, oxField::T_RAW);
        $this->oArticle2->oxarticles__oxactive = new oxField(1, oxField::T_RAW);
        $this->oArticle2->save();
        $this->oArticle->UNITonChangeUpdateStock('_testArt');
        $this->assertEquals( 2, oxDb::getDB()->getOne("select oxvarstock from oxarticles where oxid = '_testArt'") );
    }

    /**
     * Test onChange event updates stock and resets related counters.
     *
     * @return null
     */
    public function testOnChangeUpdateStockResetCounts()
    {
            $this->oArticle2->oxarticles__oxstock = new oxField(2, oxField::T_RAW);
            $this->oArticle2->oxarticles__oxactive = new oxField(1, oxField::T_RAW);
            $this->oArticle2->oxarticles__oxvendorid = new oxField( 'oxvendorid' );
            $this->oArticle2->oxarticles__oxmanufacturerid = new oxField( 'oxmanufacturerid' );
            $this->oArticle2->save();
            $oArticle = $this->getMock( 'oxarticle', array( '_onChangeResetCounts' ) );
            $oArticle->expects( $this->any() )->method( '_onChangeResetCounts');
            $oArticle->load('_testArt');
            $oArticle->oxarticles__oxstockflag = new oxField(2, oxField::T_RAW);
            $oArticle->UNITonChangeUpdateStock('_testArt');
            $this->assertEquals( 2, oxDb::getDB()->getOne("select oxvarstock from oxarticles where oxid = '_testArt'") );
            $this->assertEquals( 1, oxDb::getDB()->getOne("select oxvarcount from oxarticles where oxid = '_testArt'") );
    }

    /**
     * Test onChange event updates stock and resets related counters.
     *
     * @return null
     */
    public function testOnChangeUpdateStockResetCounts2()
    {
            $this->oArticle2->delete();
            $oArticle = $this->getMock( 'oxarticle', array( '_onChangeResetCounts' ) );
            $oArticle->expects( $this->any() )->method( '_onChangeResetCounts' )->with( $this->equalTo( '_testArt' ), $this->equalTo( 'oxvendorid' ), $this->equalTo( 'oxmanufacturerid' ) );
            $oArticle->load('_testArt');
            $oArticle->oxarticles__oxstockflag = new oxField( 2 );
            $oArticle->oxarticles__oxstock = new oxField( 1 );
            $oArticle->oxarticles__oxvendorid = new oxField( 'oxvendorid' );
            $oArticle->oxarticles__oxmanufacturerid = new oxField( 'oxmanufacturerid' );
            $oArticle->save();
            $oArticle->oxarticles__oxstock = new oxField(1, oxField::T_RAW);

            $oArticle->UNITonChangeUpdateStock('_testArt');
            $this->assertEquals( 0, oxDb::getDB()->getOne( "select oxvarstock from oxarticles where oxid = '_testArt'" ) );
            $this->assertEquals( 0, oxDb::getDB()->getOne( "select oxvarcount from oxarticles where oxid = '_testArt'" ) );
    }

    /**
     * Test onChange event updates variant counts.
     *
     * FS#1819
     *
     * @return null
     */
    public function testOnChangeUpdateVarCount()
    {
        $this->oArticle2->oxarticles__oxstock = new oxField(2, oxField::T_RAW);
        $this->oArticle2->oxarticles__oxactive = new oxField(1, oxField::T_RAW);
        $this->oArticle2->save();
        $this->oArticle->UNITonChangeUpdateVarCount('_testArt');
        $this->assertEquals( 1, oxDb::getDB()->getOne("select oxvarcount from oxarticles where oxid = '_testArt'") );
    }

    /**
     * Test onChange event updates stock and resets related counters.
     *
     * FS#1819
     *
     * @return null
     */
    public function testOnChangeUpdateVarCountIfNoVars()
    {
        $this->oArticle2->delete();
        $this->oArticle->UNITonChangeUpdateVarCount('_testArt');
        $this->assertEquals( 0, oxDb::getDB()->getOne("select oxvarcount from oxarticles where oxid = '_testArt'") );
    }

    /**
     * Test onChange event updates minimal variant price.
     *
     * @return null
     */
    public function testOnChangeUpdateMinVarPrice()
    {
        $this->oArticle2->oxarticles__oxstock = new oxField(2, oxField::T_RAW);
        $this->oArticle2->oxarticles__oxactive = new oxField(1, oxField::T_RAW);
        $this->oArticle2->oxarticles__oxprice = new oxField(17.5, oxField::T_RAW);
        $this->oArticle2->save();
        $this->oArticle = $this->getMock('oxarticle', array( 'isParentNotBuyable' ) );
        $this->oArticle->expects( $this->any() )->method( 'isParentNotBuyable' )->will( $this->returnValue( true ) );
        $this->oArticle->oxarticles__oxvarcount = new oxField(1, oxField::T_RAW);
        $this->oArticle->UNITonChangeUpdateMinVarPrice('_testArt');
        $this->assertEquals( 17.5, oxDb::getDB()->getOne("select oxvarminprice from oxarticles where oxid = '_testArt'") );

    }

    /**
     * Test onChange event updates minimal variant price when parent is buyable.
     *
     * #M0000883
     * #M0000866
     *
     * @return null
     */
    public function testOnChangeUpdateMinVarPriceIfParentBuyable()
    {
        $this->oArticle2->oxarticles__oxstock = new oxField(2, oxField::T_RAW);
        $this->oArticle2->oxarticles__oxactive = new oxField(1, oxField::T_RAW);
        $this->oArticle2->oxarticles__oxprice = new oxField(17.5, oxField::T_RAW);
        $this->oArticle2->save();

        $cfg = $this->getMock('oxconfig', array( 'getConfigParam' ), array(), '', false );
        $cfg->expects( $this->once() )->method( 'getConfigParam' )->with( $this->equalTo('blVariantParentBuyable') )->will( $this->returnValue( true ) );

        $oArticle = $this->getMock('oxarticle', array( 'getSqlActiveSnippet' ));
        $oArticle->expects( $this->once() )->method( 'getSqlActiveSnippet' )->will( $this->returnValue( '1' ) );

        $oArticle->load('_testArt');
        $oArticle->setConfig($cfg);
        $oArticle->UNITonChangeUpdateMinVarPrice('_testArt');
        $this->assertEquals( 15.5, oxDb::getDB()->getOne("select oxvarminprice from oxarticles where oxid = '_testArt'") );

    }

    /**
     * Test onChange event updates minimal variant price checks if article is active.
     *
     * #M0000883
     *
     * @return null
     */
    public function testOnChangeUpdateMinVarPriceUsesActiveArticleChecking()
    {
        $this->oArticle2->oxarticles__oxstock = new oxField(2, oxField::T_RAW);
        $this->oArticle2->oxarticles__oxactive = new oxField(1, oxField::T_RAW);
        $this->oArticle2->oxarticles__oxprice = new oxField(10000.76, oxField::T_RAW);
        $this->oArticle2->save();

        $cfg = $this->getMock('oxconfig', array( 'getConfigParam' ), array(), '', false );
        $cfg->expects( $this->once() )->method( 'getConfigParam' )->with( $this->equalTo('blVariantParentBuyable') )->will( $this->returnValue( true ) );

        $oArticle = $this->getMock('oxarticle', array( 'getSqlActiveSnippet' ));
        $oArticle->expects( $this->once() )->method( 'getSqlActiveSnippet' )->will( $this->returnValue( ' oxid = "'.$this->oArticle2->getId().'"' ) );

        $oArticle->load('_testArt');
        $oArticle->setConfig($cfg);
        $oArticle->UNITonChangeUpdateMinVarPrice('_testArt');
        $this->assertEquals( 10000.76, oxDb::getDB()->getOne("select oxvarminprice from oxarticles where oxid = '_testArt'") );

    }

    /**
     * Test onChange event updates minimal variant price when no variants exist.
     *
     * #M378: Quicksorting after price in articlelist does not work correctly when parent article is not buyable
     *
     * @return null
     */
    public function testOnChangeUpdateMinVarPriceIfNoVariants()
    {
        $oArticle = $this->getProxyClass('oxarticle');
        $oArticle->setAdminMode( null );
        $oArticle->modifyCacheKey(null, false);
        $oArticle->load('_testArtnovar');
        $oArticle->setId('_testArtnovar');
        $oArticle->oxarticles__oxprice = new oxField(990.6, oxField::T_RAW);
        $oArticle->oxarticles__oxshopid = new oxField(oxConfig::getInstance()->getBaseShopId(), oxField::T_RAW);
        $oArticle->oxarticles__oxshopincl = new oxField(oxConfig::getInstance()->getBaseShopId(), oxField::T_RAW);
        $oArticle->oxarticles__oxtitle = new oxField("test", oxField::T_RAW);
        $oArticle->save();

        $cfg = $this->getMock('oxconfig', array( 'getConfigParam' ), array(), '', false );
        $cfg->expects( $this->once() )->method( 'getConfigParam' )->with( $this->equalTo('blVariantParentBuyable') )->will( $this->returnValue( true ) );

        $oArticle = $this->getMock('oxarticle', array( 'getSqlActiveSnippet' ));
        $oArticle->expects( $this->once() )->method( 'getSqlActiveSnippet' )->will( $this->returnValue( ' 1 ' ) );

        $oArticle->load('_testArtnovar');
        $oArticle->setConfig($cfg);
        $oArticle->UNITonChangeUpdateMinVarPrice('_testArtnovar');
        $this->assertEquals( 990.6, oxDb::getDB()->getOne("select oxvarminprice from oxarticles where oxid = '_testArtnovar'") );

        // same with blVariantParentBuyable == false
        $oArticle = $this->getProxyClass('oxarticle');
        $oArticle->load('_testArtnovar');
        $oArticle->setId('_testArtnovar');
        $oArticle->oxarticles__oxprice = new oxField(990.8, oxField::T_RAW);
        $oArticle->save();

        $cfg = $this->getMock('oxconfig', array( 'getConfigParam' ), array(), '', false );
        $cfg->expects( $this->once() )->method( 'getConfigParam' )->with( $this->equalTo('blVariantParentBuyable') )->will( $this->returnValue( false ) );

        $oArticle = $this->getMock('oxarticle', array( 'getSqlActiveSnippet' ));
        $oArticle->expects( $this->once() )->method( 'getSqlActiveSnippet' )->will( $this->returnValue( ' 1 ' ) );

        $oArticle->load('_testArtnovar');
        $oArticle->setConfig($cfg);
        $oArticle->UNITonChangeUpdateMinVarPrice('_testArtnovar');
        $this->assertEquals( 990.8, oxDb::getDB()->getOne("select oxvarminprice from oxarticles where oxid = '_testArtnovar'") );
    }

    /**
     * Test if on change resets counts.
     *
     * @return null
     */
    public function testOnChangeResetCounts()
    {
            $sCat = "8a142c3e4143562a5.46426637";
            $sVend = "68342e2955d7401e6.18967838";
            $sMan = "fe07958b49de225bd1dbc7594fb9a6b0";
            $sCatCnt = oxUtilsCount::getInstance()->getCatArticleCount( $sCat);
            $sVendCnt = oxUtilsCount::getInstance()->getVendorArticleCount( $sVend);
            oxDb::getDB()->execute("insert into oxobject2category (oxid, oxobjectid, oxcatnid) values ('test', '_testArt', '$sCat' )");
            $oArticle = new oxarticle();
            $oArticle->load('_testArt');
            $oArticle->oxarticles__oxvendorid = new oxField($sVend, oxField::T_RAW);
            $oArticle->oxarticles__oxmanufacturerid = new oxField($sMan, oxField::T_RAW);
            $oArticle->UNITonChangeResetCounts('_testArt', $sVend, $sMan );
    }

    /**
     * Test is visible for preview in admin.
     *
     * @return null
     */
    public function testIsVisiblePreview()
    {
            oxTestModules::addFunction( "oxUtilsServer", "getOxCookie", "{return 'testadmin_sid';}" );
            $this->oArticle->oxarticles__oxactive = new oxField( 0 );

            modConfig::setParameter( 'preview', md5( 'testadmin_sid' . 'oxdefaultadmin' . oxDb::getDb()->getOne('select oxpassword from oxuser where oxid = "oxdefaultadmin" ') . 'malladmin' ) );
            $this->assertTrue($this->oArticle->isVisible());
    }

    /**
     * Test is visible for inactive.
     *
     * @return null
     */
    public function testIsVisibleNotActive()
    {
            $this->oArticle->oxarticles__oxactive = new oxField(0, oxField::T_RAW);
            $this->assertFalse($this->oArticle->isVisible());
    }

    /**
     * Test is visible.
     *
     * @return null
     */
    public function testIsVisible()
    {
            $this->oArticle->oxarticles__oxactive = new oxField(1, oxField::T_RAW);
            $this->assertTrue($this->oArticle->isVisible());
    }

    /**
     * Test is visible when out of stock.
     *
     * @return null
     */
    public function testIsVisibleNoStock()
    {
            modConfig::getInstance()->setConfigParam( 'blUseStock', true );
            $this->oArticle->oxarticles__oxstock = new oxField(-1, oxField::T_RAW);
            $this->oArticle->oxarticles__oxstockflag = new oxField(2, oxField::T_RAW);
            $this->assertFalse($this->oArticle->isVisible());
    }

    /**
     * Test get custom VAT.
     *
     * @return null
     */
    public function testGetCustomVAT()
    {
        $this->oArticle->oxarticles__oxvat = new oxField(7, oxField::T_RAW);
        $this->assertEquals( $this->oArticle->oxarticles__oxvat->value, $this->oArticle->getCustomVAT());
    }

    /**
     * Test check for stock when stock checking is disabled.
     *
     * @return null
     */
    public function testCheckForStockNotActiveStock()
    {
        modConfig::getInstance()->setConfigParam( 'blUseStock', false );
        $this->assertTrue( $this->oArticle->checkForStock(4));
    }

    /**
     * Test check for stock when stock flag is 1.
     *
     * @return null
     */
    public function testCheckForStockWithStockFlag()
    {
        $this->oArticle->oxarticles__oxstock = new oxField(0, oxField::T_RAW);
        $this->oArticle->oxarticles__oxstockflag = new oxField(1, oxField::T_RAW);
        $this->oArticle->save();
        $this->assertTrue( $this->oArticle->checkForStock(4));
    }

    /**
     * Test check for stock when stock flag is 2.
     *
     * @return null
     */
    public function testCheckForStockZero()
    {
        $this->oArticle->oxarticles__oxstock = new oxField(0, oxField::T_RAW);
        $this->oArticle->oxarticles__oxstockflag = new oxField(2, oxField::T_RAW);
        $this->oArticle->save();
        $this->assertFalse( $this->oArticle->checkForStock(4));
        $blErr = oxSession::getVar( 'Errors');
        $this->assertTrue( isset($blErr) );
    }

    /**
     * Test check for stock with uneven amounts.
     *
     * @return null
     */
    public function testCheckForStockUnevenAmounts()
    {
        modConfig::getInstance()->setConfigParam( 'blAllowUnevenAmounts', false );
        $this->oArticle->oxarticles__oxstock = new oxField(4.5, oxField::T_RAW);
        $this->oArticle->oxarticles__oxstockflag = new oxField(2, oxField::T_RAW);
        $this->oArticle->save();
        $this->assertTrue( $this->oArticle->checkForStock(4));
    }

    /**
     * Test check for stock .
     *
     * @return null
     */
    public function testCheckForStock()
    {
        modConfig::getInstance()->setConfigParam( 'blAllowUnevenAmounts', false );
        $this->oArticle->oxarticles__oxstock = new oxField(2, oxField::T_RAW);
        $this->oArticle->oxarticles__oxstockflag = new oxField(2, oxField::T_RAW);
        $this->oArticle->save();
        $this->assertEquals( 2, $this->oArticle->checkForStock(4));
    }

    /**
     * Test check for vpe (packing units) .
     *
     * @return null
     */
    public function testCheckForVpe()
    {
    }


    /**
     * Test get article long description.
     *
     * @return null
     */
    public function testGetArticleLongDesc()
    {
        oxDb::getDB()->execute("update oxartextends set oxlongdesc = 'test &amp;' where oxid = '_testArt'");
        $this->assertEquals( 'test &', $this->oArticle->getArticleLongDesc()->value);
    }

    /**
     * Test get article long description in other language.
     *
     * @return null
     */
    public function testGetArticleLongDescInOtherLang()
    {
        oxDb::getDB()->execute("update oxartextends set oxlongdesc_1 = 'lang 1 test &amp;' where oxid = '_testArt'");
        $this->oArticle->setLanguage( 1 );
        $this->assertEquals( 'lang 1 test &', $this->oArticle->getArticleLongDesc()->value);
    }

    /**
     * Test get article long description and parse it in smarty.
     *
     * buglist#335
     *
     * @return null
     */
    public function testGetArticleLongDescWithSmartyTags()
    {
        modConfig::getInstance()->setConfigParam( 'bl_perfParseLongDescinSmarty', true );
        $sDesc = 'aa[{* smarty comment *}]zz';
        oxDb::getDB()->execute("update oxartextends set oxlongdesc = '$sDesc' where oxid = '_testArt'");
        $this->assertEquals( 'aazz', $this->oArticle->getArticleLongDesc()->value);
    }

    /**
     *  Test get cached article long description.
     *
     * @return null
     */
    public function testGetArticleLongDescCached()
    {
        $this->oArticle->oxarticles__oxlongdesc = new oxField('aaaad');
        $this->assertEquals( 'aaaad', $this->oArticle->getArticleLongDesc()->value);
        $this->assertEquals( '', $this->oArticle->getArticleLongDesc('asdasd')->value);
    }

    /**
     * Test get attributes.
     *
     * @return null
     */
    public function testGetAttributes()
    {
        $oArticle = new oxarticle();
        $oArticle->load('1672');
        $sSelect = "select oxattrid from oxobject2attribute where oxobjectid = '$sArtID'";
        $sID = oxDb::getDB()->getOne($sSelect);
        $sSelect = "select oxvalue from oxobject2attribute where oxattrid = '$sID' and oxobjectid = '$sArtID'";
        $sExpectedValue = oxDb::getDB()->getOne($sSelect);
        $aAttrList = $oArticle->getAttributes();
        $sAttribValue = $aAttrList[$sID]->oxobject2attribute__oxvalue->value;
        $this->assertEquals( $sExpectedValue, $sAttribValue);
    }

    /**
     * Test get attributes in other language.
     *
     * @return null
     */
    public function testGetAttributesInOtherLang()
    {
        $oArticle = $this->getMock('oxarticle', array( 'getLanguage' ) );
        $oArticle->expects( $this->any() )->method( 'getLanguage' )->will( $this->returnValue( 1) );
        $oArticle->load('1672');
        $sSelect = "select oxattrid from oxobject2attribute where oxobjectid = '$sArtID'";
        $sID = oxDb::getDB()->getOne($sSelect);
        $sSelect = "select oxvalue_1 from oxobject2attribute where oxattrid = '$sID' and oxobjectid = '$sArtID'";
        $sExpectedValue = oxDb::getDB()->getOne($sSelect);
        $aAttrList = $oArticle->getAttributes();
        $sAttribValue = $aAttrList[$sID]->oxobject2attribute__oxvalue->value;
        $this->assertEquals( $sExpectedValue, $sAttribValue);
    }

    /**
     * Test get sorted attributes.
     *
     * @return null
     */
    public function testGetAttributesWithSort()
    {
        $sSelect = "insert into oxattribute (oxid, oxshopid, oxshopincl, oxshopexcl, oxtitle, oxpos ) values ('test3', '1', '1', '0', 'test3', '3'), ('test1', '1', '1', '0', 'test1', '1'), ('test2', '1', '1', '0', 'test2', '2')";
            $sSelect = "insert into oxattribute (oxid, oxshopid, oxtitle, oxpos ) values ('test3', 'oxbaseshop', 'test3', '3'), ('test1', 'oxbaseshop', 'test1', '1'), ('test2', 'oxbaseshop', 'test2', '2')";
        $rs = oxDb::getDB()->execute($sSelect);
        $sArtId = $this->oArticle->getId();
        $sSelect = "insert into oxobject2attribute (oxid, oxobjectid, oxattrid, oxvalue ) values ('test3', '$sArtId', 'test3', '3'), ('test1', '$sArtId', 'test1', '1'), ('test2', '$sArtId', 'test2', '2')";
        $rs = oxDb::getDB()->execute($sSelect);

        $aAttrList = $this->oArticle->getAttributes();
        $iCnt = 1;
        foreach ( $aAttrList as $sId => $aAttr ) {
            $this->assertEquals( 'test'.$iCnt, $sId);
            $this->assertEquals( (string)$iCnt, $aAttr->oxattribute__oxvalue->value);
            $iCnt++;
        }
    }

    /**
     * Test teg pric "from" prefix.
     *
     * @return null
     */
    public function testGetPriceFromPrefix()
    {
        $oArticle = new _oxArticle();
        $this->assertEquals('', $oArticle->getPriceFromPrefix());

        $oArticle->setVar( 'blIsRangePrice', true);
        $sPricePrefics = oxLang::getInstance()->translateString('priceFrom').' ';
        $this->assertEquals($sPricePrefics, $oArticle->getPriceFromPrefix());
    }


    /**
     * Test assign parent field values.
     *
     * @return null
     */
    public function testAssignParentFieldValues1()
    {
        $this->oArticle->oxarticles__oxvat = new oxField(7, oxField::T_RAW);
        $this->oArticle->oxarticles__oxfreeshipping = new oxField(1, oxField::T_RAW);
        $this->oArticle->oxarticles__oxthumb = new oxField('test.jpg', oxField::T_RAW);
        $this->oArticle->save();

        $oArticle2 = new _oxArticle();
        $oArticle2->load('_testVar');
        $oArticle2->oxarticles__oxthumb = new oxField('nopic.jpg', oxField::T_RAW);
        $oArticle2->resetVar();
        $oArticle2->UNITassignParentFieldValues();
        $this->assertEquals( $this->oArticle->oxarticles__oxvat->value, $oArticle2->oxarticles__oxvat->value);
        //$this->assertEquals( $this->oArticle->oxarticles__oxthumb->value, "0/".$oArticle2->oxarticles__oxthumb->value);

        $this->assertEquals( "0/test.jpg", $oArticle2->oxarticles__oxthumb->value);
        $this->assertNotEquals( $this->oArticle->oxarticles__oxid->value, $oArticle2->oxarticles__oxid->value);
    }

    /**
     * Test assign parent field values (pictures).
     *
     * @return null
     */
    public function testAssignParentFieldValuesPics()
    {
        modConfig::getInstance()->setConfigParam( 'blAutoIcons', true);
        $this->oArticle->oxarticles__oxvat = new oxField(7, oxField::T_RAW);
        $this->oArticle->oxarticles__oxfreeshipping = new oxField(1, oxField::T_RAW);
        $this->oArticle->oxarticles__oxicon = new oxField('parent_ico.jpg', oxField::T_RAW);
        $this->oArticle->save();
        $oArticle2 = new _oxArticle();
        $oArticle2->load('_testVar');
        $oArticle2->oxarticles__oxicon = new oxField('variant_ico.jpg', oxField::T_RAW);
        $oArticle2->resetVar();
        $oArticle2->UNITassignParentFieldValues();
        $this->assertEquals( $this->oArticle->oxarticles__oxvat->value, $oArticle2->oxarticles__oxvat->value);
        $this->assertNotEquals( $this->oArticle->oxarticles__oxicon->value, $oArticle2->oxarticles__oxicon->value);
        $this->assertNotEquals( $this->oArticle->oxarticles__oxid->value, $oArticle2->oxarticles__oxid->value);
    }

    /**
     * Test assign parent field values (long desctiotions).
     *
     * @return null
     */
    public function testAssignParentFieldValuesLongdesc()
    {
        $oArticle = new oxArticle();
        $oArticle->load('_testArt');
        $oArticle->oxarticles__oxlongdesc->setValue('testLongDesc');
        $oArticle->save();
        $oArticle2 = new _oxArticle();
        $oArticle2->oxarticles__oxlongdesc->value;
        $oArticle2->load('_testVar');
        $oArticle2->UNITassignParentFieldValues();
        $this->assertEquals( $oArticle2->oxarticles__oxlongdesc->value, 'testLongDesc');
    }

    /**
     * Test assign not buyable parent flag.
     *
     * @return null
     */
    public function testAssignNotBuyableParent()
    {
        $this->oArticle->oxarticles__oxvarcount = new oxField(1, oxField::T_RAW);
        $this->oArticle->UNITassignNotBuyableParent();
        $this->assertTrue( $this->oArticle->_blNotBuyableParent );
    }

    /**
     * Test assign not buyable parent flag if no variants are found.
     *
     * @return null
     */
    public function testAssignNotBuyableParentIfNoVariants()
    {
        modConfig::getInstance()->setConfigParam( 'blVariantParentBuyable', true);
        $this->oArticle->oxarticles__oxvarcount = new oxField(0, oxField::T_RAW);
        $this->oArticle->oxarticles__oxvarstock = new oxField(0, oxField::T_RAW);
        $this->oArticle->UNITassignNotBuyableParent();
        $this->assertFalse( $this->oArticle->_blNotBuyableParent );
    }

    /**
     * Test assign picture values in admin mode. No additional pictures fields proccessing
     * should be done.
     *
     * @return null
     */
    public function testAssignPictureValues_AdminMode()
    {
        $oArticle = $this->getMock( 'oxarticle', array( 'isAdmin', '_getThumbnailName', '_getIconName', '_getPictureName', '_getZoomPictureName' ) );
        $oArticle->expects( $this->any() )->method( 'isAdmin')->will( $this->returnValue( true ) );
        $oArticle->expects( $this->never() )->method( '_getThumbnailName' );
        $oArticle->expects( $this->never() )->method( '_getIconName' );
        $oArticle->expects( $this->never() )->method( '_getPictureName' );
        $oArticle->expects( $this->never() )->method( '_getZoomPictureName' );

        $oArticle->UNITassignPictureValues( "oxthumb" );
    }

    /**
     * Test assign picture values when paremeter is not passed to function.
     * No additional pictures fields proccessing should be done.
     *
     * @return null
     */
    public function testAssignPictureValues_NoParameters()
    {
        $oArticle = $this->getMock( 'oxarticle', array( 'isAdmin', '_getThumbnailName', '_getIconName', '_getPictureName', '_getZoomPictureName' ) );
        $oArticle->expects( $this->any() )->method( 'isAdmin')->will( $this->returnValue( false ) );
        $oArticle->expects( $this->never() )->method( '_getThumbnailName' );
        $oArticle->expects( $this->never() )->method( '_getIconName' );
        $oArticle->expects( $this->never() )->method( '_getPictureName' );
        $oArticle->expects( $this->never() )->method( '_getZoomPictureName' );

        $oArticle->UNITassignPictureValues();
    }

    /**
     * Test assign picture values in non admin mode. Additional processing on pictures fields
     * should be done.
     *
     * @return null
     */
    public function testAssignPictureValues_NotAdminMode()
    {
        $oArticle = $this->getMock( 'oxarticle', array( 'isAdmin', '_getThumbnailName', '_getIconName', '_getPictureName', '_getZoomPictureName' ) );
        $oArticle->expects( $this->any() )->method( 'isAdmin')->will( $this->returnValue( false ) );
        // calling _getIconName() 2 times - one for main icon, one for picture icons
        $oArticle->expects( $this->exactly(2) )->method( '_getIconName' )->will( $this->returnValue( "testIcon.jpg" ) );
        $oArticle->expects( $this->once() )->method( '_getThumbnailName' )->will( $this->returnValue( "testThumb.jpg" ) );
        $oArticle->expects( $this->once() )->method( '_getPictureName' )->will( $this->returnValue( "testPic1.jpg" ) );
        $oArticle->expects( $this->once() )->method( '_getZoomPictureName' )->will( $this->returnValue( "testZoom1.jpg" ) );

        $oArticle->disableLazyLoading();

        $oArticle->UNITassignPictureValues( "oxarticles__oxicon" );
        $oArticle->UNITassignPictureValues( "oxarticles__oxthumb" );
        $oArticle->UNITassignPictureValues( "oxarticles__oxpic1" );
        $oArticle->UNITassignPictureValues( "oxarticles__oxzoom1" );

        $this->assertEquals( "icon/testIcon.jpg", $oArticle->oxarticles__oxicon->value );
        $this->assertEquals( "0/testThumb.jpg", $oArticle->oxarticles__oxthumb->value );
        $this->assertEquals( "1/testPic1.jpg", $oArticle->oxarticles__oxpic1->value );
        $this->assertEquals( "z1/testZoom1.jpg", $oArticle->oxarticles__oxzoom1->value );
    }

    /**
     * Test assign picture values not in admin mode.
     *
     * @return null
     */
    public function testAssignPictureValuesIfNotAdmin()
    {
        /*
        $this->cleanTmpDir();
        $iPicCount = modConfig::getInstance()->getConfigParam( 'iPicCount' );
        $iZoomPicCount = modConfig::getInstance()->getConfigParam( 'iZoomPicCount' );
        // TODO: works sometimes
        $oArticle = $this->getMock( 'oxarticle', array( 'isAdmin', '_hasGeneratedImage', '_hasMasterImage' ) );
        $oArticle->expects( $this->any() )->method( 'isAdmin')->will( $this->returnValue( false ) );
        $oArticle->expects( $this->any() )->method( '_hasGeneratedImage')->will( $this->returnValue( true ) );
        $oArticle->expects( $this->any() )->method( '_hasMasterImage')->will( $this->returnValue( true ) );
        $oArticle->load('_testArt');
        $oArticle->oxarticles__oxthumb = new oxField('test.jpg', oxField::T_RAW);
        $oArticle->oxarticles__oxicon = new oxField('tes_icon.jpg', oxField::T_RAW);
        for ( $i=1; $i<= $iPicCount; $i++ ) {
            $oArticle->{'oxarticles__oxpic'.$i} = new oxField("test$i.jpg", oxField::T_RAW);
        }
        for ( $i=1; $i<= $iZoomPicCount; $i++ ) {
            $oArticle->{'oxarticles__oxzoom'.$i} = new oxField("test$i.jpg", oxField::T_RAW);
        }

        $oArticle->UNITassignPictureValues();

        $this->assertEquals( '0/test.jpg', $oArticle->oxarticles__oxthumb->value );
        $this->assertEquals( 'icon/tes_icon.jpg', $oArticle->oxarticles__oxicon->value );
        for ( $i=1; $i<= $iPicCount; $i++ ) {
            $this->assertEquals( "$i/test$i.jpg", $oArticle->{'oxarticles__oxpic'.$i}->value );
            $this->assertEquals( "$i/test".$i."_ico.jpg", $oArticle->{'oxarticles__oxpic'.$i.'_ico'}->value );
        }
        for ( $i=1; $i<= $iZoomPicCount; $i++ ) {
            $this->assertEquals( "z$i/test$i.jpg", $oArticle->{'oxarticles__oxzoom'.$i}->value );
        }
        */
    }

    /**
     * Test assign all loaded picture values.
     *
     * @return null
     */
    public function testAssignAllPictureValues()
    {
        $myConfig = oxConfig::getInstance();
        $oArticle = new oxArticle();
        $oArticle->load( "1126" );

        $this->assertFalse( isset( $oArticle->oxarticles__oxicon ) );
        $this->assertFalse( isset( $oArticle->oxarticles__oxthumb ) );

        $iPicCount = $myConfig->getConfigParam( 'iPicCount' );
        for ( $i=1; $i<= $iPicCount; $i++ ) {
            $this->assertFalse( isset( $oArticle->{"oxarticles__oxpic.$i"} ) );
        }

        if ( $iZoomPicCount = $myConfig->getConfigParam( 'iZoomPicCount' ) ) {
            for ( $i=1; $i<= $iZoomPicCount; $i++ ) {
                $this->assertFalse( isset( $oArticle->{"oxarticles__oxzoom.$i"} ) );
            }
        }

        $oArticle->oxarticles__oxicon->value  = new oxField( "1126_ico.jpg" );
        $oArticle->oxarticles__oxthumb->value = new oxField( "1126_th.jpg" );
        $oArticle->oxarticles__oxpic1->value  = new oxField( "1126_p1.jpg" );
        $oArticle->oxarticles__oxpic2->value  = new oxField( "1126_p2.jpg" );
        $oArticle->oxarticles__oxpic3->value  = new oxField( "nopic.jpg" );

        $oArticle->UNITassignAllPictureValues();

        $this->assertEquals( "icon/1126_ico.jpg", $oArticle->oxarticles__oxicon->value );
        $this->assertEquals( "0/1126_th.jpg", $oArticle->oxarticles__oxthumb->value );
        $this->assertEquals( "1/1126_p1.jpg", $oArticle->oxarticles__oxpic1->value );
        $this->assertEquals( "2/1126_p2.jpg", $oArticle->oxarticles__oxpic2->value );
        $this->assertEquals( "3/nopic.jpg", $oArticle->oxarticles__oxpic3->value );
    }


    /**
     * Test assign stock if green.
     *
     * @return null
     */
    public function testAssignStockIfGreen()
    {
        $this->oArticle->oxarticles__oxstockflag = new oxField(4, oxField::T_RAW);
        $this->oArticle->UNITassignStock();
        $this->assertEquals( 0, $this->oArticle->getStockStatus());
        $this->assertNull( $this->_blNotBuyable );
    }

    /**
     * Test assign stock not allowing uneven amounts.
     *
     * @return null
     */
    public function testAssignStockDontAllowUnevenAmounts()
    {
        modConfig::getInstance()->setConfigParam( 'blAllowUnevenAmounts', false);
        modConfig::getInstance()->setConfigParam( 'blLoadVariants', false);
        modConfig::getInstance()->setConfigParam( 'blVariantParentBuyable', false);
        $this->oArticle->oxarticles__oxstock = new oxField(4.6, oxField::T_RAW);
        $this->oArticle->oxarticles__oxstockflag = new oxField(4, oxField::T_RAW);
        $this->oArticle->oxarticles__oxvarstock = new oxField(2, oxField::T_RAW);
        $this->oArticle->UNITassignStock();
        $this->assertEquals( 0, $this->oArticle->getStockStatus());
        $this->assertEquals( 4, $this->oArticle->oxarticles__oxstock->value);
        $this->assertTrue( $this->oArticle->_blNotBuyable);
    }

    /**
     * Test assign stock if orange.
     *
     * @return null
     */
    public function testAssignStockIfOrange()
    {
        modConfig::getInstance()->setConfigParam( 'blUseStock', true);
        modConfig::getInstance()->setConfigParam( 'sStockWarningLimit', 5);
        modConfig::getInstance()->setConfigParam( 'blVariantParentBuyable', false);
        $this->oArticle->oxarticles__oxstock = new oxField(6, oxField::T_RAW);
        $this->oArticle->oxarticles__oxstockflag = new oxField(2, oxField::T_RAW);
        $this->oArticle->oxarticles__oxvarstock = new oxField(4, oxField::T_RAW);
        $this->oArticle->UNITassignNotBuyableParent();
        $this->oArticle->UNITassignStock();
        $this->assertEquals( 1, $this->oArticle->getStockStatus());
    }

    /**
     * Test assign stock if red.
     *
     * @return null
     */
    public function testAssignStockIfRed()
    {
        modConfig::getInstance()->setConfigParam( 'blUseStock', true);
        modConfig::getInstance()->setConfigParam( 'sStockWarningLimit', 5);
        modConfig::getInstance()->setConfigParam( 'blVariantParentBuyable', false);
        $oArticle = new _oxArticle();
        $oArticle->load('_testArt');
        $oArticle->setVar( 'iVarStock', 1);
        $oArticle->oxarticles__oxstock = new oxField(0, oxField::T_RAW);
        $oArticle->oxarticles__oxstockflag = new oxField(2, oxField::T_RAW);
        $oArticle->UNITassignNotBuyableParent();
        $oArticle->UNITassignStock();
        $this->assertEquals( -1, $oArticle->getStockStatus());
        $this->assertFalse( $oArticle->_blNotBuyable);
        $this->assertTrue( $oArticle->_blNotBuyableParent);
    }

    /**
     * Test assign prices.
     *
     * @return null
     */
    public function testAssignPrices()
    {
        $oArticle = $this->getMock( 'oxarticle', array( 'getPrice', 'loadAmountPriceInfo', 'getBasePrice', '_applyRangePrice' ) );
        $oArticle->expects( $this->any() )->method( 'getPrice')->will( $this->returnValue( new oxPrice(10) ) );
        //do not call loadAmountPRiceInfo automatically from _assignPrices as this is used only in details
        $oArticle->expects( $this->never() )->method( 'getBasePrice')->will( $this->returnValue( 5 ) );
        $oArticle->expects( $this->any() )->method( '_applyRangePrice');
        $oArticle->UNITassignPrices();
        $this->assertEquals( 10, $oArticle->getPrice()->getBruttoPrice());
        $this->assertNull( $oArticle->loadAmountPriceInfo());
    }

    /**
     * Test assign prices when price calculation is disabled.
     *
     * @return null
     */
    public function testAssignPricesIfCalcPriceFalse()
    {
        $oArticle = $this->getMock( '_oxArticle', array( 'getPrice', 'loadAmountPriceInfo', '_applyRangePrice' ) );
        $oArticle->expects( $this->any() )->method( 'getPrice')->will( $this->returnValue( new oxPrice(5) ) );
        $oArticle->expects( $this->any() )->method( '_applyRangePrice');
        $oArticle->setVar( 'blCalcPrice', false);
        $oArticle->UNITassignPrices();
        $this->assertEquals( 5, $oArticle->getPrice()->getBruttoPrice());
        $this->assertNull( $oArticle->loadAmountPriceInfo());
    }

    /**
     * Test assign prices when unit quantity is disabled.
     *
     * @return null
     */
    public function testAssignPricesWithUnitQuantity()
    {
       $oArticle = $this->getMock( 'oxarticle', array( 'getPrice', 'loadAmountPriceInfo', '_applyRangePrice' ) );
        $oArticle->expects( $this->any() )->method( 'getPrice')->will( $this->returnValue( new oxprice(10) ) );
        //do nto call loadAmountPriceInfo automatically as this is used only in details
        $oArticle->expects( $this->never() )->method( 'loadAmountPriceInfo');
        $oArticle->expects( $this->any() )->method( '_applyRangePrice');
        $oArticle->load('_testArt');
        $oArticle->oxarticles__oxunitquantity = new oxField(5, oxField::T_RAW);
        $oArticle->oxarticles__oxunitname = new oxField('l', oxField::T_RAW);
        $oArticle->UNITassignPrices();
        $this->assertEquals( 10, $oArticle->getPrice()->getBruttoPrice());
        $this->assertEquals( '2,00', $oArticle->_fPricePerUnit);
    }

    /**
     * Test assign dyn (picture) directory.
     *
     * @return null
     */
    public function testAssignDynImageDir()
    {
        $myConfig = modConfig::getInstance();
        $this->oArticle->oxarticles__oxshopid = new oxField(1, oxField::T_RAW);
        $this->oArticle->UNITassignDynImageDir();
        $this->assertEquals( $myConfig->getDynImageDir( 1), $this->oArticle->dimagedir);
        $this->assertEquals( $myConfig->getAbsDynImageDir( 1), $this->oArticle->dabsimagedir);
        $this->assertEquals( $myConfig->getDynImageDir( 1, true), $this->oArticle->nossl_dimagedir);
        $this->assertEquals( $myConfig->getPictureUrl( null, false, true, null ), $this->oArticle->ssl_dimagedir);
    }

    /**
     * Test assign attributes.
     *
     * @return null
     */
    public function testAssignAttributes()
    {
        modConfig::getInstance()->setConfigParam( 'bl_perfLoadAttributes', true);
        $oArticle = $this->getMock( 'oxarticle', array( 'getAttributes') );
        $oArticle->expects( $this->once() )->method( 'getAttributes');
        $oArticle->UNITassignAttributes();
    }

    /**
     * Test assign attributes when loading is disabled in config.
     *
     * @return null
     */
    public function testAssignAttributesPerformance()
    {
        modConfig::getInstance()->setConfigParam( 'bl_perfLoadAttributes', false);
        $oArticle = $this->getMock( 'oxarticle', array( 'getAttributes') );
        $oArticle->expects( $this->never() )->method( 'getAttributes');
        $oArticle->UNITassignAttributes();
    }







    /**
     * Test apply range price.
     *
     * @return null
     */
    public function testApplyRangePrice()
    {
        $oArticle = new _oxArticle();
        $oArticle->load('_testArt');
        $oPrice = oxNew( 'oxPrice' );
        $oPrice->setPrice(20);
        $oArticle->setPrice( $oPrice);
        //$oArticle->setVar( '_blNotBuyableParent', true);
        $oArticle->UNITapplyRangePrice();
        $this->assertFalse( $oArticle->getVar('blIsRangePrice'));
        $this->assertEquals( 12.2, $oArticle->getPrice()->getBruttoPrice());
    }

    /**
     * Test apply range price with specified rages.
     *
     * Do not include amount prices in "from" price.
     *
     * @return null
     */
    public function testApplyRangePriceSetAmountPrices()
    {
        $oArticle = $this->getMock('_oxArticle', array('getVariants'));
        $oArticle->expects($this->any())->method('getVariants')->will($this->returnValue(null));
        $oArticle->load('_testArt');
        $oPrice = oxNew( 'oxPrice' );
        $oPrice->setPrice(10);
        $oArticle->setPrice( $oPrice);
        $oAmPriceList = new oxlist;;
        $oAmPriceList->init('oxbase', 'oxprice2article');
        $oAmPriceList->blDisableShopCheck = true;
        $oT = new stdClass();
        $oT->oxprice2article__oxaddabs = new oxField(8, oxField::T_RAW);
        $oAmPriceList[1] = $oT;
        $oT = new stdClass();
        $oT->oxprice2article__oxaddabs = new oxField(12, oxField::T_RAW);
        $oAmPriceList[2] = $oT;
        $oArticle->amountpricelist = $oAmPriceList;
        $oArticle->setVar( 'blNotBuyableParent', false);
        $oArticle->UNITapplyRangePrice();
        $this->assertEquals( 10, $oArticle->getPrice()->getBruttoPrice());
    }

    /**
     * Test apply range price with variants.
     *
     * @return null
     */
    public function testApplyRangePriceWithVariants()
    {
        $oPrice = oxNew( 'oxPrice' );
        $oPrice->setPrice(10);
        $this->oArticle2->setPrice( $oPrice);
        $this->oArticle2->save();

        $oArticle = $this->getMock('_oxArticle', array('getVariants'));
        $oArticle->expects($this->any())->method('getVariants')->will($this->returnValue(array($this->oArticle2)));
        $oArticle->load('_testArt');
        $oPrice = oxNew( 'oxPrice' );
        $oPrice->setPrice(10);
        $oArticle->setPrice( $oPrice);
        $oArticle->setVar( 'blNotBuyableParent', false);
        $oArticle->UNITapplyRangePrice();
        $this->assertFalse( $oArticle->_blIsRangePrice);
        $this->assertEquals( 10, $oArticle->getPrice()->getBruttoPrice());
    }

    /**
     * Test apply range price for not buyable parent.
     *
     * @return null
     */
    public function testApplyRangePriceForNotBuybleParent()
    {
        modConfig::getInstance()->setConfigParam( 'aMultishopArticleFields', array());
        modConfig::getInstance()->setConfigParam( 'blLoadVariants', true);
        $oPrice = oxNew( 'oxPrice' );
        $oPrice->setPrice(20);
        $this->oArticle2->setPrice( $oPrice);
        $this->oArticle2->save();

        $oArticle = $this->getMock('_oxArticle', array('getVariants'));
        $oArticle->expects($this->any())->method('getVariants')->will($this->returnValue(array($this->oArticle2)));
        $oArticle->load('_testArt');
        $oPrice = oxNew( 'oxPrice' );
        $oPrice->setPrice(10);
        $oArticle->setPrice( $oPrice);
        $oArticle->setVar( 'blNotBuyableParent', true);
        $oArticle->UNITapplyRangePrice();
        $this->assertFalse( $oArticle->_blIsRangePrice);
        $this->assertEquals( 20, $oArticle->getPrice()->getBruttoPrice());
    }

    /**
     * Test apply range price for not buyable parent without loaded variants.
     *
     * @return null
     */
    public function testApplyRangePriceForNotBuybleParentAndVariantsAreNotLoaded()
    {
        modConfig::getInstance()->setConfigParam( 'aMultishopArticleFields', array());
        modConfig::getInstance()->setConfigParam( 'blLoadVariants', false);
        $oPrice = oxNew( 'oxPrice' );
        $oPrice->setPrice(8);
        $this->oArticle2->setPrice( $oPrice);
        $this->oArticle2->save();
        $oArticle = new _oxArticle();
        $oArticle->load('_testArt');
        $oPrice = oxNew( 'oxPrice' );
        $oPrice->setPrice(10);
        $oArticle->setPrice( $oPrice);
        $oArticle->setVar( 'blNotBuyableParent', true);
        $oArticle->setVar( 'oVariantList', array($this->oArticle2));
        $oArticle->oxarticles__oxvarminprice = new oxField(9, oxField::T_RAW);
        $oArticle->UNITapplyRangePrice();
        $this->assertTrue( $oArticle->_blIsRangePrice);
        $this->assertEquals( 9, $oArticle->getPrice()->getBruttoPrice());
    }

    /**
     * Test apply range price for not buyable parent in different currency.
     *
     * @return null
     */
    public function testApplyRangePriceForNotBuybleParentInDifferentCurrency()
    {
        modConfig::getInstance()->setConfigParam( 'aMultishopArticleFields', array());
        modConfig::getInstance()->setConfigParam( 'blLoadVariants', false);
        modConfig::setParameter( 'cur', 1 );
        $oPrice = oxNew( 'oxPrice' );
        $oPrice->setPrice(8);
        $this->oArticle2->setPrice( $oPrice);
        $this->oArticle2->save();
        $oArticle = new _oxArticle();
        $oArticle->load('_testArt');
        $oPrice = oxNew( 'oxPrice' );
        $oPrice->setPrice(10);
        $oArticle->setPrice( $oPrice);
        $oArticle->setVar( 'blNotBuyableParent', true);
        $oArticle->setVar( 'oVariantList', array($this->oArticle2));
        $oArticle->oxarticles__oxvarminprice = new oxField(9, oxField::T_RAW);
        $oArticle->UNITapplyRangePrice();
        $this->assertTrue( $oArticle->_blIsRangePrice);
        $this->assertEquals( 7.71, $oArticle->getPrice()->getBruttoPrice());
    }


    /**
     * Testing apply basket discounts.
     *
     * @return null
     */
    public function testApplyBasketDiscounts()
    {
        $oDiscount = oxNew( 'oxDiscount' );
        $oDiscount->setId( '_testDiscountId' );
        $oDiscount->oxdiscount__oxtitle = new oxField('testDiscountTitle', oxField::T_RAW);
        $oDiscount->oxdiscount__oxaddsum = new oxField(5, oxField::T_RAW);
        $oDiscount->oxdiscount__oxaddsumtype = new oxField('abs', oxField::T_RAW);
        $aDiscounts[] = $oDiscount;

        $oPrice = oxNew( 'oxPrice' );
        $oPrice->setPrice( 25 );

        $oArticle = $this->getProxyClass( "oxArticle" );
        $aResult = $oArticle->applyBasketDiscounts( $oPrice, $aDiscounts );

        $oResDiscount = reset( $aResult );
        $aResDiscountKeys = array_keys( $aResult );

        $this->assertEquals( 1, count($oResDiscount) );
        $this->assertEquals( '_testDiscountId', $aResDiscountKeys[0] );
        $this->assertEquals( '_testDiscountId', $oResDiscount->sOXID );
        $this->assertEquals( 'testDiscountTitle', $oResDiscount->sDiscount );
        $this->assertEquals( 5, $oResDiscount->dDiscount );
        $this->assertEquals( 20, $oPrice->getBruttoPrice());
    }

    /**
     * Testing apply basket discounts.
     *
     * @return null
     */
    public function testApplyBasketDiscountsWithAmount()
    {
        $oDiscount = oxNew( 'oxDiscount' );
        $oDiscount->setId( '_testDiscountId' );
        $oDiscount->oxdiscount__oxtitle = new oxField('testDiscountTitle', oxField::T_RAW);
        $oDiscount->oxdiscount__oxaddsumtype = new oxField('%', oxField::T_RAW);
        $oDiscount->oxdiscount__oxaddsum = new oxField(5, oxField::T_RAW);
        $aDiscounts[] = $oDiscount;

        $oPrice = oxNew( 'oxPrice' );
        $oPrice->setPrice( 25 );

        $oArticle = $this->getProxyClass( "oxArticle" );
        $aResult = $oArticle->applyBasketDiscounts( $oPrice, $aDiscounts, 2 );

        $oResDiscount = reset( $aResult );
        $aResDiscountKeys = array_keys( $aResult );

        $this->assertEquals( 1, count($oResDiscount) );
        $this->assertEquals( '_testDiscountId', $aResDiscountKeys[0] );
        $this->assertEquals( '_testDiscountId', $oResDiscount->sOXID );
        $this->assertEquals( 'testDiscountTitle', $oResDiscount->sDiscount );
        $this->assertEquals( 2.5, $oResDiscount->dDiscount );
        $this->assertEquals( 23.75, $oPrice->getBruttoPrice());
    }

    /**
     * Testing applaying basket discounts does not affects price parameter.
     *
     * @return null
     */
    public function testApplyBasketDiscountsDoesNotAffectsPriceParam()
    {
        $oDiscount = oxNew( 'oxDiscount' );
        $oDiscount->setId( '_testDiscountId' );
        $oDiscount->oxdiscount__oxtitle = new oxField('testDiscountTitle', oxField::T_RAW);
        $oDiscount->oxdiscount__oxaddsumtype = new oxField('%', oxField::T_RAW);
        $oDiscount->oxdiscount__oxaddsum = new oxField(5, oxField::T_RAW);
        $aDiscounts[] = $oDiscount;

        $oPrice = oxNew( 'oxPrice' );
        $oPrice->setPrice( 25 );

        $oArticle = $this->getProxyClass( "oxArticle" );
        $oArticle->applyBasketDiscounts( $oPrice, $aDiscounts );

        $this->assertEquals( 23.75, $oPrice->getBruttoPrice() );
    }

    /**
     * Testing applaying basket discounts (abs with amount).
     *
     * @return null
     */
    public function testApplyBasketDiscountsAbsWithAmount()
    {
        $oPrice = new oxPrice();
        $oPrice->setPrice( 100 );

        $oDiscount = new oxDiscount();
        $oDiscount->setId( 'xxx' );
        $oDiscount->oxdiscount__oxaddsumtype = new oxField('abs', oxField::T_RAW);
        $oDiscount->oxdiscount__oxaddsum = new oxField(5, oxField::T_RAW);

        $oArticle = new oxArticle();
        $aUsedDiscounts = $oArticle->applyBasketDiscounts( $oPrice, array( $oDiscount ), 5 );

        $this->assertTrue( isset( $aUsedDiscounts['xxx'] ) );
        $this->assertEquals( 25, $aUsedDiscounts['xxx']->dDiscount );
        $this->assertEquals( 95, $oPrice->getBruttoPrice());
    }


















    /**
     * Test picture lazy loading.
     *
     * @return null
     */
    public function testLazyLoadPictures()
    {
        $oArticle = new _oxArticle();
        $oArticle->load("1126");

        $this->assertFalse(isset($oArticle->oxarticles__oxpic1));
        $this->assertFalse(isset($oArticle->oxarticles__oxzoom1));

        //first time access
        $sPic = $oArticle->oxarticles__oxpic1->value;
        $sZoomPic = $oArticle->oxarticles__oxzoom1->value;

        $this->assertTrue(isset($oArticle->oxarticles__oxpic1));
        $this->assertEquals("1/1126_p1.jpg", $oArticle->oxarticles__oxpic1->value);
        $this->assertEquals("z1/1126_z1.jpg", $oArticle->oxarticles__oxzoom1->value);
    }

    /**
     * Test thumbnail lazy loading.
     *
     * @return null
     */
    public function testLazyLoadPictureThumb()
    {
        $oArticle = new _oxArticle();
        $oArticle->load("2000");

        $this->assertFalse(isset($oArticle->oxarticles__oxthumb));

        //first time access
        $sPic = $oArticle->oxarticles__oxthumb->value;

        $this->assertTrue(isset($oArticle->oxarticles__oxthumb));
        $this->assertEquals("0/2000_th.jpg", $oArticle->oxarticles__oxthumb->value);
    }

    /**
     *  Test icon lazy loading.
     *
     * @return null
     */
    public function testLazyLoadPictureIcon()
    {
        $oArticle = new _oxArticle();
        $oArticle->load("2000");

        $this->assertFalse(isset($oArticle->oxarticles__oxicon));

        //first time access
        $sPic = $oArticle->oxarticles__oxicon->value;

        $this->assertTrue(isset($oArticle->oxarticles__oxicon));
        $this->assertEquals("icon/2000_ico.jpg", $oArticle->oxarticles__oxicon->value);
    }

    /**
     * Test is buyable getter.
     *
     * @return null
     */
    public function testIsBuyablePlain()
    {
        $oArticle = $this->getProxyClass('_oxArticle');
        $oArticle->setNonPublicVar("_blNotBuyable", false);
        $this->assertTrue($oArticle->isBuyable());
        $oArticle->setNonPublicVar("_blNotBuyable", true);
        $this->assertFalse($oArticle->isBuyable());
    }

    /**
     * Test is buyable with variants.
     *
     * @return null
     */
    public function testIsBuyableWithVariants1()
    {
            $sParentArticleId = 2077;

        modConfig::getInstance()->setConfigParam( 'blVariantParentBuyable', false );
        $oArticle = new _oxArticle();
        $oArticle->load($sParentArticleId);
        $this->assertFalse($oArticle->isBuyable());
    }

    /**
     * Test is buyable with variants.
     *
     * @return null
     */
    public function testIsBuyableWithVariants2()
    {
            $sParentArticleId = 2077;

        modConfig::getInstance()->setConfigParam( 'blVariantParentBuyable', true );
        $oArticle = new _oxArticle();
        $oArticle->load($sParentArticleId);
        $this->assertTrue($oArticle->isBuyable());
    }

    /**
     * Test is buyable when out of stock.
     *
     * @return null
     */
    public function testIsBuyableOutOfStock()
    {
        modConfig::getInstance()->setConfigParam( 'blUseStock', true );
        $oArticle = new _oxArticle();
        $oArticle->load('_testArt');
        $oArticle->oxarticles__oxstock = new oxField(0, oxField::T_RAW);
        $oArticle->oxarticles__oxstockflag = new oxField(3, oxField::T_RAW);
        $oArticle->save();
        $oArticle = new _oxArticle();
        $oArticle->load('_testArt');
        $this->assertFalse($oArticle->isBuyable());
    }

    /**
     * Test "from" price loading.
     *
     * Ddo not load "from" price for simple articles.
     *
     * @return null
     */
    public function testAbPriceLoadingNormal()
    {
        $oArticle = new _oxArticle();
        $oArticle->load(1849);
        $this->assertFalse(strpos($oArticle->fprice, "ab"));

    }

    /**
     * Test "from" price loading.
     *
     * DO NOT skip "from" price for parent articles
     *
     * @return null
     */
    public function testAbPriceLoadingNonBuayableParentDefault()
    {
        modConfig::getInstance()->setConfigParam( 'blVariantParentBuyable', false);

            $sParentArticleId = 2077;
            $sOxid = oxDb::getDb()->getOne("select oxid from oxarticles where oxparentid = '$sParentArticleId'");
            $oVariant = new oxarticle();
            $oVariant->load( $sOxid );
            $oVariant->oxarticles__oxprice = new oxField($oVariant->oxarticles__oxprice->value + 1, oxField::T_RAW);
            $oVariant->setId( '_testVariantFor'.$sParentArticleId );
            $oVariant->save();

        $oArticle = new _oxArticle();
        //$oArticle->setSkipAbPrice(true);
        $oArticle->load($sParentArticleId);
        $this->assertTrue((bool)strpos($oArticle->fprice, "ab"));
    }

    /**
     * Test "from" price loading.
     *
     * Still DO NOT skip "from" price for parent articles
     *
     * @return null
     */
    public function testAbPriceLoadingNonBuayableParentForceSkip()
    {
        modConfig::getInstance()->setConfigParam( 'blVariantParentBuyable', false);

            $sParentArticleId = 2077;
            $sOxid = oxDb::getDb()->getOne("select oxid from oxarticles where oxparentid = '$sParentArticleId'");
            $oVariant = new oxarticle();
            $oVariant->load( $sOxid );
            $oVariant->oxarticles__oxprice = new oxField($oVariant->oxarticles__oxprice->value + 1, oxField::T_RAW);
            $oVariant->setId( '_testVariantFor'.$sParentArticleId );
            $oVariant->save();

        $oArticle = new _oxArticle();
        $oArticle->setSkipAbPrice(false);
        $oArticle->load($sParentArticleId);
        $this->assertTrue((bool)strpos($oArticle->fprice, "ab"));
    }

    /**
     * Test "from" price loading.
     *
     * DO NOT skip "from" price for buayble parent articles.
     *
     * @return null
     */
    public function testAbPriceLoadingBuayableParentDefault()
    {
        modConfig::getInstance()->setConfigParam( 'blVariantParentBuyable', true);

            $sParentArticleId = 2077;
            $sOxid = oxDb::getDb()->getOne("select oxid from oxarticles where oxparentid = '$sParentArticleId'");
            $oVariant = new oxarticle();
            $oVariant->load( $sOxid );
            $oVariant->oxarticles__oxprice = new oxField($oVariant->oxarticles__oxprice->value + 1, oxField::T_RAW);
            $oVariant->setId( '_testVariantFor'.$sParentArticleId );
            $oVariant->save();

        $oArticle = new _oxArticle();
        $oArticle->load($sParentArticleId);
        $this->assertFalse( strpos( $oArticle->fprice, "ab" ) );
    }

    /**
     * Test "from" price loading.
     *
     * But DO skip "from" price for buayble parent articles when forced.
     *
     * @return null
     */
    public function testAbPriceLoadingBuayableParentForcedSkip()
    {
        modConfig::getInstance()->setConfigParam( 'blVariantParentBuyable', true);

            $sParentArticleId = 2077;

        $oArticle = new _oxArticle();
        $oArticle->setSkipAbPrice(true);
        $oArticle->load($sParentArticleId);
        $this->assertFalse((bool)strpos($oArticle->fprice, "ab"));
    }

    /**
     * Testing standard link getter
     *
     * @return null
     */
    public function testGetStdLinkshoudlReturnDefaultLink()
    {
        oxTestModules::addFunction("oxutils", "seoIsActive", "{return false;}");

        modConfig::setParameter( 'pgNr', 10 );
        modConfig::setParameter( 'cnid', 'yyy' );
        modConfig::setParameter( 'mnid', 'mmm' );
        modConfig::setParameter( 'listtype', 'search' );

        $sUrl = oxConfig::getInstance()->getShopHomeURL().'cl=details&amp;anid=xxx&amp;cnid=yyy&amp;pgNr=10&amp;mnid=mmm&amp;listtype=search';

        $oArticle = $this->getMock( 'oxarticle', array( 'getSession' ) );
        $oArticle->expects( $this->any() )->method( 'getSession' )->will( $this->returnValue( $oSession ) );
        $oArticle->setId( 'xxx' );

        $this->assertEquals( $sUrl, $oArticle->getStdLink( 0, array( 'cnid' => 'yyy', 'pgNr' => 10, 'mnid' => 'mmm', 'listtype' => 'search' ) ) );
    }

    /**
     * Testing link getter
     *
     * @return null
     */
    public function testGetLink()
    {
        modConfig::setParameter( 'pgNr', 10 );
        modConfig::setParameter( 'cnid', 'yyy' );

        oxTestModules::addFunction("oxutils", "seoIsActive", "{return false;}");

        $oArticle = new oxarticle();
        $oArticle->setId( 'xxx' );

        $this->assertEquals( oxConfig::getInstance()->getShopHomeURL().'cl=details&amp;anid=xxx', $oArticle->getLink() );
    }

    /**
     * Testing link getter in german.
     *
     * @return null
     */
    public function testGetLinkSeoDe()
    {
        oxTestModules::addFunction("oxutilsserver", "getServerVar", "{ \$aArgs = func_get_args(); if ( \$aArgs[0] === 'HTTP_HOST' ) { return '".oxConfig::getInstance()->getShopUrl()."'; } elseif ( \$aArgs[0] === 'SCRIPT_NAME' ) { return ''; } else { return \$_SERVER[\$aArgs[0]]; } }");
        oxTestModules::addFunction("oxutils", "seoIsActive", "{return true;}");

        $oArticle = new oxarticle();

            $oArticle->loadInLang( 0, '1126' );
            $sExp = "Geschenke/Bar-Equipment/Bar-Set-ABSINTH.html";

        $this->assertEquals( oxConfig::getInstance()->getShopUrl().$sExp, $oArticle->getLink() );
    }

    /**
     * Testing link getter in english.
     *
     * @return null
     */
    public function testGetLinkSeoEng()
    {
        oxTestModules::addFunction("oxutilsserver", "getServerVar", "{ \$aArgs = func_get_args(); if ( \$aArgs[0] === 'HTTP_HOST' ) { return '".oxConfig::getInstance()->getShopUrl()."'; } elseif ( \$aArgs[0] === 'SCRIPT_NAME' ) { return ''; } else { return \$_SERVER[\$aArgs[0]]; } }");
        oxTestModules::addFunction("oxutils", "seoIsActive", "{return true;}");

        $oArticle = new oxarticle();
        $oArticle->loadInLang( 1, '1951' );

            $sExp = "en/Gifts/Living/Clocks/Wall-Clock-BIKINI-GIRL.html";

        $this->assertEquals( oxConfig::getInstance()->getShopUrl().$sExp, $oArticle->getLink() );
    }

    /**
     * Test oxnid is never cached as field.
     *
     * @return null
     */
    public function testOxnidIsNeverCachedAsField()
    {
        $oArticle = new oxArticle();
        $this->cleanTmpDir();
        $oArticle->load(1126);
        //trying to access the field
        $sTestValue = $oArticle->oxarticles__oxnid->value;
        try {
            $oArticle->load(1126);
        }
        catch (Exception $e) {
            $this->fail("oxnid is registered");
        }
    }

    /**
     * Test formated price getter.
     *
     * @return null
     */
    public function testFPriceGetter()
    {
        $oArticle = new oxArticle();
        $oPrice = new oxPrice();
        $oArticle->setPrice( $oPrice );

        $this->assertEquals( '0,00', $oArticle->fprice );

        $oPrice->setPrice( 10 );
        $this->assertEquals( "10,00", $oArticle->fprice );
    }

    /**
     * Test if multilingual field.
     *
     * @return null
     */
    public function testIsMultilingualField()
    {
        $oArticle = new oxArticle();
        $this->assertTrue($oArticle->isMultilingualField('oxlongdesc'));
        $this->assertTrue($oArticle->isMultilingualField('oxtitle'));
        $this->assertFalse($oArticle->isMultilingualField('oxprice'));
        $this->assertFalse($oArticle->isMultilingualField('nonexistant'));

        $this->cleanTmpDir();
        //same only making sure is not cached
        $this->assertTrue($oArticle->isMultilingualField('oxlongdesc'));
        $this->assertTrue($oArticle->isMultilingualField('oxtitle'));
        $this->assertFalse($oArticle->isMultilingualField('oxprice'));
        $this->assertFalse($oArticle->isMultilingualField('nonexistant'));
    }

    /**
     * Test load images after save.
     *
     * @return null
     */
    public function testLoadImagesAfterSave()
    {
        $oArticle = new oxArticle();
        $oArticle->load('1651');
        $aPicGallery = $oArticle->getPictureGallery();
        $actpic   = $aPicGallery['ActPic'];
        $oArticle->save();
        $aPicGallery = $oArticle->getPictureGallery();
        $this->assertEquals( $actpic, $aPicGallery['ActPic']);
    }

    /**
     * Test get tags.
     *
     * @return null
     */
    public function testGetTags()
    {
        $oArticle = new oxArticle();
        $oArticle->load('1651');

        $sGotTags = $oArticle->getTags();
            $sExpt = "bier,getränkemarkt,zukunftnicht,mehr,mithalten";

        $this->assertEquals($sExpt, $sGotTags);
    }

    /**
     * Test save tags.
     *
     * @return null
     */
    public function testSaveTags()
    {
        $oArticle = new oxArticle();
        $oArticle->load('1651');
        $sBackup = $oArticle->getTags();

        $sTestTags = "tag1 tag2 ta tag3 t";
        $oArticle->saveTags($sTestTags);
        $sGotTags = $oArticle->getTags();

        $this->assertEquals($sTestTags, $sGotTags);

        $oArticle->saveTags($sBackup);
    }

    /**
     * Test get tags (raw test).
     *
     * @return null
     */
    public function testSaveTagsRawTest()
    {
        $oArticle = new oxArticle();
        $oArticle->load('1651');
        $sBackup = $oArticle->getTags();

        $sTestTags = "tag1,tag2,ta,tag3,t";
        $oArticle->saveTags($sTestTags);
        $sGotTags = oxDb::getDb()->getOne( "Select oxtags from oxartextends where oxid = '1651'");
        $sExp = "tag1,tag2,ta__,tag3,t___";;

        $this->assertEquals($sExp, $sGotTags);

        $oArticle->saveTags($sBackup);
    }

    /**
     * Test add tag.
     *
     * @return null
     */
    public function testAddTag()
    {
        $oArticle = new oxArticle();
        $oArticle->load('1651');
        $sExisting = $oArticle->getTags();

        $sAddTag = "tag3";
        $oArticle->addTag($sAddTag);
        $sGotTags = $oArticle->getTags();

        $sExpt = "$sExisting,tag3";

        $this->assertEquals($sExpt, $sGotTags);

        $oArticle->saveTags($sExisting);
    }

    /**
     * Test add tag for new article.
     *
     * Tf article has no extended data
     *
     * @return null
     */
    public function testAddTagForNewArt()
    {
        $sAddTag = "tag3";
        $this->oArticle->addTag($sAddTag);
        $sGotTags = $this->oArticle->getTags();

        $this->assertEquals($sAddTag, $sGotTags);

    }

    /**
     * Test get select list.
     *
     * @return null
     */
    public function testGetSelectList()
    {
        $myDB     = oxDb::getDB();
        $myConfig = oxConfig::getInstance();
        $oCurrency = $myConfig->getActShopCurrencyObject();

        $sShopId = $myConfig->getBaseShopId();
        $sVal = 'three!P!-5,99__threeValue@@';

            $sQ = 'insert into oxselectlist (oxid, oxshopid, oxtitle, oxident, oxvaldesc) values ("oxsellisttest", "'.$sShopId.'", "oxsellisttest", "oxsellisttest", "'.$sVal.'")';
        $myDB->Execute( $sQ );

        $sQ = 'insert into oxobject2selectlist values ("oxsellisttest", "1651", "oxsellisttest", 1) ';
        $myDB->Execute( $sQ );

        modConfig::getInstance()->setConfigParam( 'bl_perfLoadSelectLists', true );
        modConfig::getInstance()->setConfigParam( 'bl_perfUseSelectlistPrice', true );

        $oObject = new OxstdClass();
        $oObject->price  = '-5.99';
        $oObject->fprice = '-5,99';
        $oObject->priceUnit = 'abs';
        $oObject->name  = 'three -5,99 '.$oCurrency->sign;
        $oObject->value = 'threeValue';
        $aSelList[] = $oObject;
        $aShouldBe[0] = $aSelList;
        $aShouldBe[0]['name'] = 'oxsellisttest';

        $oArticle = new _oxArticle();
        $oArticle->load('1651');
        $oArticle->resetVar();
        $this->assertEquals( $aShouldBe, $oArticle->getSelectLists() );
    }

    /**
     * Test get media url's.
     *
     * @return null
     */
    public function testGetMediaUrls()
    {
        $this->cleanUpTable('oxmediaurls');
        $sQ = "insert into oxmediaurls (oxid, oxobjectid, oxurl, oxdesc) values ('_test1', '1126', '/test.jpg', 'test1')";
        oxDb::getDb()->execute($sQ);
        $sQ = "insert into oxmediaurls (oxid, oxobjectid, oxurl, oxdesc) values ('_test2', '1126', 'http://www.youtube.com/watch?v=ZN239G6aJZo', 'test2')";
        oxDb::getDb()->execute($sQ);
        $sQ = "insert into oxmediaurls (oxid, oxobjectid, oxurl, oxdesc) values ('_test3', '1126', 'test.jpg', 'test3')";
        oxDb::getDb()->execute($sQ);

        $oArt = new oxArticle();
        $oArt->load('1126');
        $oMediaUrls = $oArt->getMediaUrls();

        $this->assertEquals(3, count($oMediaUrls));
        $this->assertTrue(isset($oMediaUrls['_test1']));
        $this->assertTrue(isset($oMediaUrls['_test2']));
        $this->assertTrue(isset($oMediaUrls['_test3']));
        $this->assertEquals('test2', $oMediaUrls['_test2']->oxmediaurls__oxdesc->value);
        $this->assertEquals("<a href=\"test.jpg\" target=\"_blank\">test3</a>", $oMediaUrls['_test3']->getHtml());

        $this->cleanUpTable('oxmediaurls');
    }

    /**
     * Test if parent buyable is checked for varselect.
     *
     * FS#1748
     *
     * @return null
     */
    public function testIfParentBuyableCheckVarselect()
    {
        $this->oArticle->oxarticles__oxvarcount = new oxField(1, oxField::T_RAW);
        $this->oArticle2->oxarticles__oxactive = new oxField(1, oxField::T_RAW);
        $this->oArticle2->save();
        modConfig::getInstance()->setConfigParam( 'blVariantParentBuyable', true );
        $this->oArticle->save();
        $sOxid = oxDb::getDb()->getOne("select oxvarselect from oxarticles where oxid = '{$this->oArticle->getId()}'");
        $this->assertEquals( '', $sOxid);
    }

    /**
     * Test get parent article.
     *
     * @return null
     */
    public function testGetParentArticle()
    {
        oxTestModules::addFunction('oxarticle', 'clearParentCache', '{self::$_aLoadedParents = array();}');
        $oA = oxNew('oxarticle');
        $oA->clearParentCache();
        $oParent1 = $this->oArticle2->getParentArticle();
        $oParent2 = $this->oArticle2->getParentArticle();
        $this->assertEquals('_testArt', $oParent1->getId());
        $this->assertSame($oParent1, $oParent2);
        $this->assertNull($this->oArticle->getParentArticle());
    }

    /**
     * Test assign parent field value.
     *
     * @return null
     */
    public function testAssignParentFieldValue()
    {
        $this->oArticle->oxarticles__oxvat = new oxField(7, oxField::T_RAW);
        $this->oArticle->oxarticles__oxfreeshipping = new oxField(1, oxField::T_RAW);
        $this->oArticle->oxarticles__oxthumb = new oxField('test.jpg', oxField::T_RAW);
        $this->oArticle->save();
        $oArticle2 = new _oxArticle();
        $oArticle2->load('_testVar');
        $oArticle2->oxarticles__oxthumb = new oxField('nopic.jpg', oxField::T_RAW);
        $oArticle2->resetVar();
        $oArticle2->UNITassignParentFieldValue('oxarticles__oxthumb');
        //$this->assertEquals( $this->oArticle->oxarticles__oxthumb->value, "0/".$oArticle2->oxarticles__oxthumb->value);
        $this->assertEquals( "0/test.jpg", $oArticle2->oxarticles__oxthumb->value);
        $this->assertNotEquals( $this->oArticle->oxarticles__oxid->value, $oArticle2->oxarticles__oxid->value);
    }

    /**
     * Test assign parent field value with zero price.
     *
     * @return null
     */
    public function testAssignParentFieldValueIfPriceIsZero()
    {
        $oArticle2 = new _oxArticle();
        $oArticle2->load('_testVar');
        $oArticle2->oxarticles__oxprice = new oxField("0", oxField::T_RAW);
        $oArticle2->UNITassignParentFieldValue('oxarticles__oxprice');
        $this->assertEquals( 15.5, $oArticle2->oxarticles__oxprice->value);
    }

    /**
     * Test assign parent field value - when variant has his own thumbnail, icon
     * and zoom picture.
     *
     * @return null
     */
    public function testAssignParentFieldValue_variantHasOwnImages()
    {
        $oParentArticle = new oxArticle();
        $oParentArticle->oxarticles__oxicon  = new oxField('parent_ico.jpg', oxField::T_RAW);
        $oParentArticle->oxarticles__oxthumb = new oxField('parent_thumb.jpg', oxField::T_RAW);
        $oParentArticle->oxarticles__oxzoom1 = new oxField('parent_zoom1.jpg', oxField::T_RAW);

        $oVarArticle = $this->getMock('oxarticle', array( 'getParentArticle', '_hasMasterImage' ) );
        $oVarArticle->expects( $this->any() )->method( 'getParentArticle' )->will( $this->returnValue( $oParentArticle ) );
        $oVarArticle->expects( $this->any() )->method( '_hasMasterImage' )->will( $this->returnValue( true ) );

        $oVarArticle->oxarticles__oxicon  = new oxField('var_ico.jpg', oxField::T_RAW);
        $oVarArticle->oxarticles__oxthumb = new oxField('var_thumb.jpg', oxField::T_RAW);
        $oVarArticle->oxarticles__oxzoom1 = new oxField('var_zoom1.jpg', oxField::T_RAW);

        $oVarArticle->UNITassignParentFieldValue( "oxicon" );
        $this->assertEquals( "var_ico.jpg", $oVarArticle->oxarticles__oxicon->value);

        $oVarArticle->UNITassignParentFieldValue( "oxthumb" );
        $this->assertEquals( "var_thumb.jpg", $oVarArticle->oxarticles__oxthumb->value);

        $oVarArticle->UNITassignParentFieldValue( "oxzoom1" );
        $this->assertEquals( "var_zoom1.jpg", $oVarArticle->oxarticles__oxzoom1->value);
    }

    /**
     * Test assign parent field value - when variant does not his own thumbnail, icon
     * and zoom picture.
     *
     * @return null
     */
    public function testAssignParentFieldValue_variantDoesNotHasOwnImages()
    {
        $oParentArticle = new oxArticle();
        $oParentArticle->oxarticles__oxicon  = new oxField('parent_ico.jpg', oxField::T_RAW);
        $oParentArticle->oxarticles__oxthumb = new oxField('parent_thumb.jpg', oxField::T_RAW);
        $oParentArticle->oxarticles__oxzoom1 = new oxField('parent_zoom1.jpg', oxField::T_RAW);

        $oVarArticle = $this->getMock('oxarticle', array( 'getParentArticle', '_hasMasterImage' ) );
        $oVarArticle->expects( $this->any() )->method( 'getParentArticle' )->will( $this->returnValue( $oParentArticle ) );
        $oVarArticle->expects( $this->any() )->method( '_hasMasterImage' )->will( $this->returnValue( false ) );

        $oVarArticle->UNITassignParentFieldValue( "oxicon" );
        $this->assertEquals( "parent_ico.jpg", $oVarArticle->oxarticles__oxicon->value);

        $oVarArticle->UNITassignParentFieldValue( "oxthumb" );
        $this->assertEquals( "parent_thumb.jpg", $oVarArticle->oxarticles__oxthumb->value);

        $oVarArticle->UNITassignParentFieldValue( "oxzoom1" );
        $this->assertEquals( "parent_zoom1.jpg", $oVarArticle->oxarticles__oxzoom1->value);
    }

    /**
     * Test assign parent field value with non zero price.
     *
     * @return null
     */
    public function testAssignParentFieldValueIfPriceIsNotZero()
    {   $oArticle2 = new _oxArticle();
        $oArticle2->load('_testVar');
        $oArticle2->oxarticles__oxprice = new oxField(10, oxField::T_RAW);
        $oArticle2->UNITassignParentFieldValue('oxarticles__oxprice');
        $this->assertEquals( 10, $oArticle2->oxarticles__oxprice->value);
    }

    /**
     * Test assign parent field value with zero price as string.
     *
     * @return null
     */
    public function testAssignParentFieldValueStringZeroValue()
    {
        $oArticle2 = new _oxArticle();
        $oArticle2->load('_testVar');
        $oArticle2->oxarticles__oxtitle = new oxField("0", oxField::T_RAW);
        $oArticle2->UNITassignParentFieldValue('oxarticles__oxtitle');
        $this->assertEquals( "0", $oArticle2->oxarticles__oxtitle->value);
    }

    /**
     * Test get link with language.
     *
     * @return null
     */
    public function testGetLinkWithLanguage()
    {
        modConfig::setParameter( 'pgNr', 10 );
        modConfig::setParameter( 'cnid', 'yyy' );

        oxTestModules::addFunction("oxutils", "seoIsActive", "{return false;}");

        $oArticle = new oxarticle();
        $oArticle->setId( 'xxx' );

        $this->assertEquals( oxConfig::getInstance()->getShopHomeURL().'cl=details&amp;anid=xxx&amp;lang=2', $oArticle->getLink(2) );

        // next
        oxTestModules::addFunction("oxutilsserver", "getServerVar", "{ \$aArgs = func_get_args(); if ( \$aArgs[0] === 'HTTP_HOST' ) { return '".oxConfig::getInstance()->getShopUrl()."'; } elseif ( \$aArgs[0] === 'SCRIPT_NAME' ) { return ''; } else { return \$_SERVER[\$aArgs[0]]; } }");
        oxTestModules::addFunction("oxutils", "seoIsActive", "{return true;}");

        $oArticle = new oxarticle();

            $oArticle->loadInLang( 1, '1126' );
            $sExp = "Geschenke/Bar-Equipment/Bar-Set-ABSINTH.html";

        $this->assertEquals( oxConfig::getInstance()->getShopUrl().$sExp, $oArticle->getLink(0) );

        // next
        oxTestModules::addFunction("oxutils", "seoIsActive", "{return true;}");

        $oArticle = new oxarticle();
        $oArticle->loadInLang( 0, '1951' );

            $sExp = "en/Gifts/Living/Clocks/Wall-Clock-BIKINI-GIRL.html";

        $this->assertEquals( oxConfig::getInstance()->getShopUrl().$sExp, $oArticle->getLink(1) );

    }

    /**
     * Test get standard links.
     *
     * Should return default link with language parameter.
     *
     * @return null
     */
    public function testGetStdLinkshoudlReturnDefaultLinkWithLangParam()
    {
        oxTestModules::addFunction("oxutils", "seoIsActive", "{return false;}");

        modConfig::setParameter( 'pgNr', 10 );
        modConfig::setParameter( 'cnid', 'yyy' );
        modConfig::setParameter( 'mnid', 'mmm' );
        modConfig::setParameter( 'listtype', 'search' );

        $sUrl1 = oxConfig::getInstance()->getShopHomeURL().'cl=details&amp;anid=xxx&amp;cnid=yyy&amp;pgNr=10&amp;mnid=mmm&amp;listtype=search&amp;lang=1';
        $sUrl2 = oxConfig::getInstance()->getShopHomeURL().'cl=details&amp;anid=xxx&amp;cnid=yyy&amp;pgNr=10&amp;mnid=mmm&amp;listtype=search';

        $oArticle = $this->getMock( 'oxarticle', array( 'getSession' ) );
        $oArticle->expects( $this->any() )->method( 'getSession' )->will( $this->returnValue( $oSession ) );
        $oArticle->setId( 'xxx' );

        $this->assertEquals( $sUrl1, $oArticle->getStdLink( 1, array( "cnid" => "yyy", "pgNr" => 10, "mnid" => "mmm", "listtype" => "search" ) ) );
        $this->assertEquals( $sUrl2, $oArticle->getStdLink( 0, array( "cnid" => "yyy", "pgNr" => 10, "mnid" => "mmm", "listtype" => "search" ) ) );
    }

    /**
     * Test get dyn (picture) image dir.
     *
     * @return null
     */
    public function testGetDynImageDir()
    {
        $oArticle = new oxarticle();
        $oArticle->oxarticles__oxshopid = new oxField(1);
        $oArticle->UNITassignDynImageDir();
        $this->assertEquals( oxConfig::getInstance()->getDynImageDir(1), $oArticle->getDynImageDir() );
    }

    /**
     * Test get display select list.
     *
     * @return null
     */
    public function testGetDispSelList()
    {
        $oArticle = $this->getMock('oxarticle', array( 'getSelectLists' ) );
        $oArticle->expects( $this->once() )->method( 'getSelectLists' )->will($this->returnValue( 'aaa' ) );
        modConfig::getInstance()->setConfigParam( 'bl_perfLoadSelectLists', true );
        modConfig::getInstance()->setConfigParam( 'bl_perfLoadSelectListsInAList', true );
        $this->assertEquals( 'aaa', $oArticle->getDispSelList() );
    }

    /**
     * Test set display select list.
     *
     * @return null
     */
    public function testSetGetDispSelList()
    {
        $oArticle = new oxarticle();
        $oArticle->setSelectlist( 'aaa' );
        $this->assertEquals( 'aaa', $oArticle->getDispSelList() );
    }

    /**
     * Test get more details link.
     *
     * @return null
     */
    public function testGetMoreDetailLink()
    {
        $oArticle = $this->getProxyClass( "oxarticle" );
        $oArticle->setNonPublicVar( "_sMoreDetailLink", "testDetailsLink" );
        $this->assertEquals( "testDetailsLink", $oArticle->getMoreDetailLink() );
    }

    /**
     * Test get more details link with all request parameters.
     *
     * @return null
     */
    public function testGetMoreDetailLinkTestingIfAllRequestParamsAreSet()
    {
        oxTestModules::addFunction('oxUtilsUrl', 'processUrl($url, $final)', '{return "PROC".$url.(int)$final."CORP";}');

        modConfig::setParameter( 'cnid', 'yyy' );
        $oArticle = $this->getMock( "oxarticle", array( 'getId' ) );
        $oArticle->expects( $this->once() )->method( 'getId' )->will($this->returnValue( 'xxx' ) );

        $this->assertEquals( 'PROC'.oxConfig::getInstance()->getShopUrl().'index.php'.'0CORPcl=moredetails&amp;cnid=yyy&amp;anid=xxx', $oArticle->getMoreDetailLink() );
    }

    /**
     * test get to basket link.
     *
     * @return null
     */
    public function testGetToBasketLink()
    {
        $oArticle = $this->getProxyClass( "oxarticle" );
        $oArticle->setNonPublicVar( "_sToBasketLink", "testBasketLink" );
        $this->assertEquals( "testBasketLink", $oArticle->getToBasketLink() );
    }

    /**
     * Test get to basket link with all request parameters.
     *
     * @return null
     */
    public function testGetToBasketLinkTestingIfAllRequestParamsAreSet()
    {
        modConfig::setParameter( 'cnid', 'yyy' );
        modConfig::setParameter( 'cl', 'thankyou' );
        modConfig::setParameter( 'tpl', '/my/tpl/file.tpl' );

        oxTestModules::addFunction('oxUtilsUrl', 'processUrl($url, $final)', '{return "PROC".$url.(int)$final."CORP";}');

        $oArticle = $this->getMock( "oxarticle", array( 'getId' ) );
        $oArticle->expects( $this->exactly( 2 ) )->method( 'getId' )->will($this->returnValue( 'xxx' ) );

        $this->assertEquals( 'PROC'.oxConfig::getInstance()->getShopUrl().'index.php'.'0CORPcl=basket&amp;cnid=yyy&amp;fnc=tobasket&amp;aid=xxx&amp;anid=xxx&amp;tpl=file.tpl', $oArticle->getToBasketLink() );
    }

    /**
     * Test get to basket link for search engine.
     *
     * @return null
     */
    public function testGetToBasketLinkIsSearchEngine()
    {
        oxTestModules::addFunction("oxutilsserver", "getServerVar", "{ \$aArgs = func_get_args(); if ( \$aArgs[0] === 'HTTP_HOST' ) { return 'seolink'; } elseif ( \$aArgs[0] === 'SCRIPT_NAME' ) { return ''; } else { return \$_SERVER[\$aArgs[0]]; } }");
        oxTestModules::addFunction( "oxutils", "isSearchEngine", "{return true;}" );

        $oArticle = $this->getMock( "oxarticle", array( 'getLink' ) );
        $oArticle->expects( $this->once() )->method( 'getLink' )->will($this->returnValue( 'seolink' ) );

        $this->assertEquals( 'seolink', $oArticle->getToBasketLink() );
    }

    /**
     * Test get stock status.
     *
     * @return null
     */
    public function testGetStockStatus()
    {
        $oArticle = $this->getProxyClass( "oxarticle" );
        $oArticle->setNonPublicVar( "_iStockStatus", "testBasketLink" );
        $this->assertEquals( "testBasketLink", $oArticle->getStockStatus() );
    }

    /**
     * Test get delivery date.
     *
     * @return null
     */
    public function testGetDeliveryDate()
    {
        $this->oArticle->oxarticles__oxdelivery = new oxField('2008-01-01', oxField::T_RAW);
        $this->oArticle->save();

        $sDelDate = '01.01.2008';
        if ( $this->oArticle->getLanguage() == 1 ) {
            $sDelDate = '2008-01-01';
        }

        $this->assertEquals( $sDelDate, $this->oArticle->getDeliveryDate() );
    }

    /**
     * Test get delivery date when not set.
     *
     * @return null
     */
    public function testGetDeliveryDateIfNotSet()
    {
        $this->oArticle->oxarticles__oxdelivery = new oxField('0000-00-00', oxField::T_RAW);
        $this->oArticle->save();
        $this->assertFalse( $this->oArticle->getDeliveryDate() );
    }

    /**
     * Test get formated old price.
     *
     * @return null
     */
    public function testGetFTPrice()
    {
        $this->oArticle->oxarticles__oxtprice = new oxField( 12.1, oxField::T_RAW);
        $this->oArticle->save();
        $this->assertEquals( '12,10', $this->oArticle->getFTPrice() );
    }

    /**
     * Test get formated old price when not set.
     *
     * @return null
     */
    public function testGetFTPriceIfNotSet()
    {
        $this->assertNull( $this->oArticle->getFTPrice() );
    }

    /**
     * Test get formated price.
     *
     * @return null
     */
    public function testGetFPrice()
    {
        $this->assertEquals( '15,50', $this->oArticle->getFPrice() );
    }

    /**
     * Test get formated price when not set.
     *
     * @return null
     */
    public function testGetFPriceIfNotSet()
    {
        $oArticle = $this->getMock('oxarticle', array( 'getPrice' ) );
        $oArticle->expects( $this->once() )->method( 'getPrice' )->will($this->returnValue( null ) );
        $this->assertNull( $oArticle->getFPrice() );
    }

    /**
     * Test get price per unit.
     *
     * @return null
     */
    public function testGetPricePerUnit()
    {
        $oArticle = $this->getProxyClass( "oxarticle" );
        $oArticle->setNonPublicVar( "_fPricePerUnit", 12.12 );
        $this->assertEquals( 12.12, $oArticle->getPricePerUnit() );
    }

    /**
     * Test is parent not buyable.
     *
     * @return null
     */
    public function testIsParentNotBuyable()
    {
        $oArticle = $this->getProxyClass( "oxarticle" );
        $oArticle->setNonPublicVar( "_blNotBuyableParent", true );
        $this->assertTrue( $oArticle->isParentNotBuyable() );
    }

    /**
     * Test is not buyable.
     *
     * @return null
     */
    public function testIsNotBuyable()
    {
        $oArticle = $this->getProxyClass( "oxarticle" );
        $oArticle->setNonPublicVar( "_blNotBuyable", true );
        $this->assertTrue( $oArticle->isNotBuyable() );
    }

    /**
     * Test get variant list.
     *
     * @return null
     */
    public function testGetVariantList()
    {
        $oArticle = $this->getMock( "oxarticle", array('getVariants') );
        $oArticle->expects($this->once())->method('getVariants')->will($this->returnValue( 'variantlist'));
        $this->assertEquals( 'variantlist', $oArticle->getVariantList() );
    }

    /**
     * Test get picture url.
     *
     * @return null
     */
    public function testGetPictureUrl()
    {
        $oConfig = $this->getMock( 'oxConfig', array( 'getPictureUrl' ) );
        $oConfig->expects( $this->once() )->method( 'getPictureUrl' )->with('1/testPic1')->will( $this->returnValue( 'testPic1Url' ) );

        $oArticle = $this->getMock( 'oxarticle', array( '_hasGeneratedImage', '_getPictureName' ) );
        $oArticle->expects( $this->once() )->method( '_hasGeneratedImage' )->with('1')->will( $this->returnValue( true ) );
        $oArticle->expects( $this->once() )->method( '_getPictureName' )->with('1')->will( $this->returnValue( "testPic1" ) );

        $oArticle->setConfig( $oConfig );

        $this->assertEquals( 'testPic1Url', $oArticle->getPictureUrl( 1 ) );
    }

    /**
     * Test get picture url without image index.
     *
     * Check if method returns null when passed to method parameter is empty
     *
     * @return null
     */
    public function testGetPictureUrl_noIndex()
    {
        $oConfig = $this->getMock( 'oxConfig', array( 'getPictureUrl' ) );
        $oConfig->expects( $this->never() )->method( 'getPictureUrl' );

        $oArticle = $this->getProxyClass( "oxarticle" );
        $oArticle->setConfig($oConfig);

        $this->assertNull( $oArticle->getPictureUrl() );
    }

    /**
     * Test get main icon url.
     *
     * @return null
     */
    public function testGetIconUrl_mainIcon()
    {
        $oConfig = $this->getMock( 'oxConfig', array( 'getPictureUrl' ) );
        $oConfig->expects( $this->once() )->method( 'getPictureUrl' )->with('icon/testIcon')->will( $this->returnValue( 'testIconUrl' ) );

        $oArticle = $this->getMock( 'oxarticle', array( '_getIconName', '_isFieldEmpty', '_assignPictureValues' ) );
        $oArticle->expects( $this->any() )->method( '_isFieldEmpty' )->will( $this->returnValue( false ) );
        $oArticle->expects( $this->any() )->method( '_assignPictureValues' )->will( $this->returnValue( null ) );
        $oArticle->expects( $this->once() )->method( '_getIconName' )->with('')->will( $this->returnValue( "testIcon" ) );

        $oArticle->setConfig( $oConfig );
        $this->assertEquals( 'testIconUrl', $oArticle->getIconUrl() );
    }

    /**
     * Test get picture icon url.
     *
     * @return null
     */
    public function testGetIconUrl_pictureIcon()
    {
        $oConfig = $this->getMock( 'oxConfig', array( 'getPictureUrl' ) );
        $oConfig->expects( $this->once() )->method( 'getPictureUrl' )->with('1/testIcon1')->will( $this->returnValue( 'testIcon1Url' ) );

        $oArticle = $this->getMock( 'oxarticle', array( '_getIconName', '_isFieldEmpty', '_assignPictureValues' ) );
        $oArticle->expects( $this->any() )->method( '_isFieldEmpty' )->will( $this->returnValue( false ) );
        $oArticle->expects( $this->any() )->method( '_assignPictureValues' )->will( $this->returnValue( null ) );
        $oArticle->expects( $this->once() )->method( '_getIconName' )->with('1')->will( $this->returnValue( "testIcon1" ) );

        $oArticle->setConfig( $oConfig );
        $this->assertEquals( 'testIcon1Url', $oArticle->getIconUrl( 1 ) );
    }

    /**
     * Test get thumbnail url.
     *
     * @return null
     */
    public function testGetThumbnailUrl()
    {
        $oConfig = $this->getMock( 'oxConfig', array( 'getPictureUrl' ) );
        $oConfig->expects( $this->once() )->method( 'getPictureUrl' )->with('0/testThumb')->will( $this->returnValue( 'testThumbUrl' ) );

        $oArticle = $this->getMock( 'oxarticle', array( '_getThumbnailName', '_isFieldEmpty', '_assignPictureValues' ) );
        $oArticle->expects( $this->any() )->method( '_isFieldEmpty' )->will( $this->returnValue( false ) );
        $oArticle->expects( $this->any() )->method( '_assignPictureValues' )->will( $this->returnValue( null ) );
        $oArticle->expects( $this->once() )->method( '_getThumbnailName' )->will( $this->returnValue( "testThumb" ) );

        $oArticle->setConfig( $oConfig );
        $this->assertEquals( 'testThumbUrl', $oArticle->getThumbnailUrl() );
    }

    /**
     * Test get zoom picture url.
     *
     * @return null
     */
    public function testGetZoomPictureUrl()
    {
        $oConfig = $this->getMock( 'oxConfig', array( 'getPictureUrl' ) );
        $oConfig->expects( $this->once() )->method( 'getPictureUrl' )->with('z1/testZoom')->will( $this->returnValue( 'testZoomUrl' ) );

        $oArticle = $this->getMock( 'oxarticle', array( '_getZoomPictureName', '_isFieldEmpty', '_assignPictureValues' ) );
        $oArticle->expects( $this->any() )->method( '_isFieldEmpty' )->will( $this->returnValue( false ) );
        $oArticle->expects( $this->any() )->method( '_assignPictureValues' )->will( $this->returnValue( null ) );
        $oArticle->expects( $this->once() )->method( '_getZoomPictureName' )->with('1')->will( $this->returnValue( "testZoom" ) );

        $oArticle->setConfig( $oConfig );
        $this->assertEquals( 'testZoomUrl', $oArticle->getZoomPictureUrl( 1) );
    }

    /**
     * Test get zoom picture url withount index specified.
     *
     * Check if method returns null when passed to method parameter is empty
     *
     * @return null
     */
    public function testGetZoomPictureUrl_noIndex()
    {
        $oConfig = $this->getMock( 'oxConfig', array( 'getPictureUrl' ) );
        $oConfig->expects( $this->never() )->method( 'getPictureUrl' );

        $oArticle = $this->getProxyClass( "oxarticle" );
        $oArticle->setConfig($oConfig);

        $this->assertNull( $oArticle->getZoomPictureUrl() );
    }

    /**
     * Test set/get article user.
     *
     * @return null
     */
    public function testSetGetArticleUser()
    {
        $oSubj = new oxArticle();
        $oSubj->setArticleUser('testUser');
        $this->assertEquals('testUser', $oSubj->getArticleUser());
    }

    /**
     * Test get global article user.
     *
     * @return null
     */
    public function testGetArticleUserGlobal()
    {
        $oSubj = new oxArticle();
        $oSubj->setUser('testUser');
        $this->assertEquals('testUser', $oSubj->getArticleUser());
    }

    /**
     * Test get non global article user.
     *
     * @return null
     */
    public function testGetArticleUserNonGlobal()
    {
        $oSubj = new oxArticle();
        $oSubj->setUser('testUser');
        $oSubj->setArticleUser('testLocalUser');
        $this->assertEquals('testLocalUser', $oSubj->getArticleUser());
    }

    /**
     * Test is field empty positives.
     *
     * @return null
     */
    public function testIsFieldEmptyPositive()
    {
        //T2009-01-09
        //the tests are so trivial that I'll just do a buch of assert in one test
        $oSubj = $this->getProxyClass("oxarticle");

        $oSubj->oxanyfield = new stdClass();
        $oSubj->oxanyfield->value = "";
        $this->assertTrue($oSubj->UNITisFieldEmpty("oxanyfield", ""));

        $oSubj->oxanyfield = new stdClass();
        $oSubj->oxanyfield->value = "0000-00-00 00:00:00";
        $this->assertTrue($oSubj->UNITisFieldEmpty("oxanyfield"));

        $oSubj->oxanyfield = new stdClass();
        $oSubj->oxanyfield->value = "0000-00-00";
        $this->assertTrue($oSubj->UNITisFieldEmpty("oxanyfield"));

        $oSubj->oxarticles__oxanyfield = new stdClass();
        $oSubj->oxarticles__oxanyfield->value = null;
        $this->assertTrue($oSubj->UNITisFieldEmpty("oxarticles__oxanyfield"));

        $oSubj->oxarticles__oxpic1 = new stdClass();
        $oSubj->oxarticles__oxpic1->value = "nopic.jpg";
        $this->assertTrue($oSubj->UNITisFieldEmpty("oxarticles__oxpic1"));

        $oSubj->oxarticles__oxpic1 = new stdClass();
        $oSubj->oxarticles__oxpic1->value = "nopic.jpg";
        $this->assertTrue($oSubj->UNITisFieldEmpty("oxarticles__OXPIC1"));

        $oSubj->oxarticles__oxpic2 = new stdClass();
        $oSubj->oxarticles__oxpic2->value = "nopic.jpg";
        $this->assertTrue($oSubj->UNITisFieldEmpty("oxarticles__oxpic2"));

        $oSubj->oxarticles__oxpic12 = new stdClass();
        $oSubj->oxarticles__oxpic12->value = "nopic.jpg";
        $this->assertTrue($oSubj->UNITisFieldEmpty("oxarticles__oxpic12"));

        $oSubj->oxarticles__oxthumb = new stdClass();
        $oSubj->oxarticles__oxthumb->value = "nopic.jpg";
        $this->assertTrue($oSubj->UNITisFieldEmpty("oxarticles__oxthumb"));

        $oSubj->oxarticles__oxthumb = new stdClass();
        $oSubj->oxarticles__oxthumb->value = "nopic.jpg";
        $this->assertTrue($oSubj->UNITisFieldEmpty("OXTHUMB"));

        $oSubj->oxarticles__oxicon = new stdClass();
        $oSubj->oxarticles__oxicon->value = "nopic_ico.jpg";
        $this->assertTrue($oSubj->UNITisFieldEmpty("oxarticles__oxicon"));

        $oSubj->oxarticles__oxicon = new stdClass();
        $oSubj->oxarticles__oxicon->value = "nopic_ico.jpg";
        $this->assertTrue($oSubj->UNITisFieldEmpty("oxarticles__OXICON"));

        $oSubj->oxarticles__oxzoom1 = new stdClass();
        $oSubj->oxarticles__oxzoom1->value = "nopic.jpg";
        $this->assertTrue($oSubj->UNITisFieldEmpty("oxarticles__oxzoom1"));

        $oSubj->oxarticles__oxzoom2 = new stdClass();
        $oSubj->oxarticles__oxzoom2->value = "nopic.jpg";
        $this->assertTrue($oSubj->UNITisFieldEmpty("oxarticles__oxzoom2"));

        $oSubj->oxarticles__oxzoom1 = new stdClass();
        $oSubj->oxarticles__oxzoom1->value = "nopic.jpg";
        $this->assertTrue($oSubj->UNITisFieldEmpty("OXARTICLES__OXZOOM1"));
    }

    /**
     * Test is field empty negatives.
     *
     * @return null
     */
    public function testIsFieldEmptyNegative()
    {
        //T2009-01-09
        //the tests are so trivial that I'll just do a buch of assert in one test
        $oSubj = $this->getProxyClass("oxarticle");

        $oSubj->oxanyfield = new stdClass();
        $oSubj->oxanyfield->value = "anyValue";
        $this->assertFalse($oSubj->UNITisFieldEmpty("oxanyfield"));

        $oSubj->oxanyfield = new stdClass();
        $oSubj->oxanyfield->value = "0000-00-00 00:00:01";
        $this->assertFalse($oSubj->UNITisFieldEmpty("oxanyfield"));

        $oSubj->oxarticles__oxanyfield = new stdClass();
        $oSubj->oxarticles__oxanyfield->value = "nopic.jpg";
        $this->assertFalse($oSubj->UNITisFieldEmpty("oxarticles__oxanyfield"));

        $oSubj->oxarticles__oxicon = new stdClass();
        $oSubj->oxarticles__oxicon->value = "nopic.jpg";
        $this->assertFalse($oSubj->UNITisFieldEmpty("oxarticles__oxicon"));

        $oSubj->oxarticles__oxthumb = new stdClass();
        $oSubj->oxarticles__oxthumb->value = "nopic_ico.jpg";
        $this->assertFalse($oSubj->UNITisFieldEmpty("oxarticles__oxthumb"));

        $oSubj->oxarticles__oxpic = new stdClass();
        $oSubj->oxarticles__oxpic->value = "nopic_ico.jpg";
        $this->assertFalse($oSubj->UNITisFieldEmpty("oxarticles__oxpic"));
    }

    /**
     * TEst get file url.
     *
     * @return null
     */
    public function testGetFileUrl()
    {
        $oConfig = $this->getMock( 'oxConfig', array( 'getPictureUrl' ) );
        $oConfig->expects( $this->any() )->method( 'getPictureUrl' )->will( $this->returnValue( 'fileUrl' ) );

        $oArticle = $this->getProxyClass( "oxarticle" );
        $oArticle->setConfig($oConfig);

        $this->assertEquals( 'fileUrl', $oArticle->getFileUrl() );
    }

    /**
     * Test set load parent data.
     *
     * @return null
     */
    public function testSetLoadParentData()
    {
        $oArticle = $this->getProxyClass( "oxarticle" );
        $oArticle->setLoadParentData( true );

        $this->assertTrue( $oArticle->getNonPublicVar( "_blLoadParentData" ) );
    }

    /**
     * Test get similar products.
     *
     * @return null
     */
    public function testGetSimilarProducts()
    {
        $oArticle = oxNew("oxarticle");
        $oArticle->load("2000");
        $oList = $oArticle->getSimilarProducts();
        $iCount = 4;
            $iCount = 5;
        $this->assertEquals( $iCount, count($oList) );
    }

    /**
     * Test get similar products if no attributes exists.
     *
     * @return null
     */
    public function testGetSimilarProductsNoAttribDontLoadSimilar()
    {
        $oArticle = oxNew("oxarticle");
        $oArticle->load("_testArt");
        $this->assertNull( $oArticle->getSimilarProducts());
    }

    /**
     * Test get similar products when attribute loading is disabled in config.
     *
     * @return null
     */
    public function testGetSimilarProductsNoAttrib()
    {
        modConfig::getInstance()->setConfigParam( 'bl_perfLoadSimilar', false );
        $oArticle = oxNew("oxarticle");
        $oArticle->load("2000");
        $this->assertNull( $oArticle->getSimilarProducts());
    }

    /**
     * Test get similar products with 100% match.
     *
     * #0001137: iAttributesPercent = 100 doesnt work
     *
     * @return null
     */
    public function testGetSimilarProductsIf100Percent()
    {
        modConfig::getInstance()->setConfigParam( 'iAttributesPercent', 100 );
        $oArticle = oxNew("oxarticle");
        $oArticle->load("2000");
        $oList = $oArticle->getSimilarProducts();
        $iCount = 4;
        $this->assertEquals( $iCount, count($oList) );
    }




    /**
     * Test assign parent field values and set title.
     *
     * #1031: Lazy loading of field values does not load parent's oxtitle
     *
     * @return null
     */
    public function testAssignParentFieldValuesSetTitle()
    {
        $sVarId = '8a142c4100e0b2f57.59530204';
        $sParentId = '2077';
        $sTitle = 'Tischlampe SPHERE';
        $oArticle2 = new _oxArticle();
        $oArticle2->load($sVarId);
        $oArticle2->UNITassignParentFieldValues();
        $this->assertEquals( $sTitle, $oArticle2->oxarticles__oxtitle->value);
    }

    /**
     * Test get category id's select.
     *
     * @return null
     */
    public function testGetSelectCatIds()
    {
        $oArticle = oxNew( "oxArticle" );
        $sO2CView = $oArticle->UNITgetObjectViewName( 'oxobject2category' );
        $sCatView = $oArticle->UNITgetObjectViewName( 'oxcategories' );

        $sSelect1 =  "select oxobject2category.oxcatnid as oxcatnid from $sO2CView as oxobject2category left join $sCatView as oxcategories on oxcategories.oxid = oxobject2category.oxcatnid ";
        $sSelect1 .= "where oxobject2category.oxobjectid='test' and oxcategories.oxid is not null and oxcategories.oxactive".(($oArticle->getLanguage())?'_'.$oArticle->getLanguage():'')." = 1 ";
        $sSubSelect = "and oxcategories.oxhidden = 0 and (select count(cats.oxid) from $sCatView as cats where cats.oxrootid = oxcategories.oxrootid and cats.oxleft < oxcategories.oxleft and cats.oxright > oxcategories.oxright and ( cats.oxhidden = 1 or cats.oxactive".(($oArticle->getLanguage())?"_".$oArticle->getLanguage():"")." = 0 ) ) = 0 ";
        $sSelect2 = "order by oxobject2category.oxtime ";
        $this->assertEquals( $sSelect1.$sSelect2, $oArticle->UNITgetSelectCatIds( 'test', false ) );
        // #1306: selecting active categories will not be checked if parent categories are active
        $this->assertEquals( $sSelect1.$sSubSelect.$sSelect2, $oArticle->UNITgetSelectCatIds( 'test', true ) );
    }

    /**
     * Test get category id's.
     *
     * @return null
     */
    public function testGetCategoryIds()
    {
        $sQ = "insert into oxobject2category set oxid = '_testArt2Cat', oxcatnid = '_testCat2', oxobjectid = '_testArt'";
        oxDb::getDb()->execute($sQ);
        $oObj1 = oxNew( "oxCategory" );
        $oObj1->setId("_testCat1");
        $oObj1->oxcategories__oxparentid = new oxField("oxrootid", oxField::T_RAW);
        $oObj1->oxcategories__oxactive = new oxField("0", oxField::T_RAW);
        $oObj1->save();
        $oObj2 = oxNew( "oxCategory" );
        $oObj2->setId("_testCat2");
        $oObj2->oxcategories__oxparentid = new oxField($oObj1->getId(), oxField::T_RAW);
        $oObj2->oxcategories__oxactive = new oxField("1", oxField::T_RAW);
        $oObj2->save();
        $oArticle = oxNew("oxarticle");
        $oArticle->load('_testArt');
        $this->assertEquals(array("_testCat2"), $oArticle->getCategoryIds(false, true));
        // #1306: Selecting active categories will not be checked if parent categories are active
        $this->assertEquals(array(), $oArticle->getCategoryIds(true, true));
    }

    /**
     * Test get category id's - adding price categories to list.
     *
     * @return null
     */
    public function testGetCategoryIds_adsPriceCategoriesToList()
    {
        $sQ = "insert into oxobject2category set oxid = '_testArt1Cat', oxcatnid = '_testCat1', oxobjectid = '_testArt'";

        oxDb::getDb()->execute($sQ);
        $oObj1 = oxNew( "oxCategory" );
        $oObj1->setId("_testCat1");
        $oObj1->oxcategories__oxparentid = new oxField("oxrootid", oxField::T_RAW);
        $oObj1->oxcategories__oxactive = new oxField("1", oxField::T_RAW);
        $oObj1->save();

        $oObj2 = oxNew( "oxCategory" );
        $oObj2->setId("_testCat2");
        $oObj2->oxcategories__oxparentid = new oxField("oxrootid", oxField::T_RAW);
        $oObj2->oxcategories__oxactive = new oxField("1", oxField::T_RAW);
        $oObj2->oxcategories__oxpricefrom = new oxField( 100 );
        $oObj2->oxcategories__oxpriceto = new oxField( 200 );
        $oObj2->save();

        $oArticle = oxNew("oxarticle");
        $oArticle->load('_testArt');
        $oArticle->oxarticles__oxprice = new oxField( 99 );

        // price cat should be skipped
        $this->assertEquals( array( "_testCat1" ), $oArticle->getCategoryIds( false, true ) );

        // price cat should be inlcuded (M:1598)
        $oArticle->oxarticles__oxprice = new oxField( 101 );
        $this->assertEquals( array( "_testCat1", "_testCat2" ), $oArticle->getCategoryIds( false, true ) );
    }

    /**
     * Test get standard link with parameters.
     *
     * @return null
     */
    public function testGetStdLinkWithParams()
    {
        oxTestModules::addFunction("oxutils", "seoIsActive", "{return false;}");

        $oArticle = $this->getMock( 'oxarticle', array( 'getSession' ) );
        $oArticle->expects( $this->any() )->method( 'getSession' )->will( $this->returnValue( $oSession ) );
        $oArticle->setId( 'xxx' );

        $sUrl = oxConfig::getInstance()->getShopHomeURL().'cl=details&amp;anid=xxx&amp;cnid=cid&amp;lala=lili&amp;pgNr=10&amp;mnid=mmm&amp;listtype=search&amp;lang=1';

        $this->assertEquals( $sUrl, $oArticle->getStdLink(1, array('cnid'=>'cid', 'lala'=>'lili', 'pgNr' => 10, 'mnid' => 'mmm', 'listtype' => 'search' )) );
    }

    /**
     * Test get select for price categories.
     *
     * @return null
     */
    public function testGetSqlForPriceCategories()
    {
        $oA = new oxarticle();
        $oA->setId('_testx');
        $oA->oxarticles__oxprice = new oxField(95);
            $this->assertEquals("select oxid from oxcategories where oxpricefrom != 0 and oxpriceto != 0 and oxpricefrom <= '95' and oxpriceto >= '95' union select oxid from oxcategories where oxpricefrom != 0 and oxpriceto = 0 and oxpricefrom <= '95' union select oxid from oxcategories where oxpricefrom = 0 and oxpriceto != 0 and oxpriceto >= '95'", $oA->getSqlForPriceCategories());
            $this->assertEquals("select oxid, oxlalaa from oxcategories where oxpricefrom != 0 and oxpriceto != 0 and oxpricefrom <= '95' and oxpriceto >= '95' union select oxid, oxlalaa from oxcategories where oxpricefrom != 0 and oxpriceto = 0 and oxpricefrom <= '95' union select oxid, oxlalaa from oxcategories where oxpricefrom = 0 and oxpriceto != 0 and oxpriceto >= '95'", $oA->getSqlForPriceCategories('oxid, oxlalaa'));
    }

    /**
     * Tes in price category.
     *
     * @return null
     */
    public function testInPriceCategory( )
    {
        $oA = new oxarticle();
        $oA->setId('_testx');
        $oA->oxarticles__oxprice = new oxField(95);
        modDb::getInstance()->addClassFunction('getOne', create_function('$s', 'return 1;'));
        $this->assertTrue($oA->inPriceCategory( 'sCatNid' ));

        modDb::getInstance()->addClassFunction('getOne', create_function('$s', 'return 0;'));
        $this->assertFalse($oA->inPriceCategory( 'sCatNid' ));

        modDb::getInstance()->addClassFunction('getOne', create_function('$s', 'throw new Exception($s);'));
        try {
            $oA->inPriceCategory( 'sCatNid' );
        } catch (Exception $e) {
                $this->assertEquals("select 1 from oxcategories where oxid='sCatNid' and(   (oxpricefrom != 0 and oxpriceto != 0 and oxpricefrom <= '95' and oxpriceto >= '95') or (oxpricefrom != 0 and oxpriceto = 0 and oxpricefrom <= '95') or (oxpricefrom = 0 and oxpriceto != 0 and oxpriceto >= '95'))", $e->getMessage());
            return;
        }
        $this->fail('exception from oxdb not thrown');
    }

    /**
     * Check if method "onChange" calls method "_onChangeStockResetCount" when
     * updating article stock (action = ACTION_UPDATE_STOCK)
     *
     * @return null
     */
    public function testOnChange_callsCountResetOnStockChange()
    {

        $oArticle = $this->getMock( "oxarticle", array( "_onChangeStockResetCount" ) );
        $oArticle->expects( $this->once() )->method( '_onChangeStockResetCount' )->with( $this->equalTo( '_testArt' ) );
        $oArticle->onChange( ACTION_UPDATE_STOCK, '_testArt' );
    }

    /**
     * Check if method "onChange" does not calls method "_onChangeStockResetCount"
     * when not updating article stock (action != ACTION_UPDATE_STOCK)
     *
     * @return null
     */
    public function testOnChange_callsCountResetOnlyStockChange()
    {

        $oArticle = $this->getMock( "oxarticle", array( "_onChangeStockResetCount" ) );
        $oArticle->expects( $this->never() )->method( '_onChangeStockResetCount' );
        $oArticle->onChange( null, '_testArt' );
    }

    /**
     * Check if method calls method "_onChangeResetCounts" with
     * correct parameters when stock value is zero
     *
     * @return null
     */
    public function testOnChange_onChangeStockResetCount()
    {

        $oArticle = $this->getMock( "oxarticle", array( "_onChangeResetCounts" ) );
        $oArticle->expects( $this->once() )->method( '_onChangeResetCounts' )->with( $this->equalTo( '_testArt' ), $this->equalTo( '_testVendorId' ), $this->equalTo( '_testManufacturerId' ) );
        $oArticle->oxarticles__oxvendorid = new oxField( "_testVendorId" );
        $oArticle->oxarticles__oxmanufacturerid = new oxField( "_testManufacturerId" );

        $oArticle->oxarticles__oxstockflag = new oxField( 2 );
        $oArticle->oxarticles__oxstock = new oxField( 0 );

        $oArticle->UNITonChangeStockResetCount( "_testArt" );
    }

    /**
     * Test geting picture name.
     *
     * @return null
     */
    public function testGetPictureName()
    {
        $oArticle = $this->getProxyClass( "oxarticle" );
        $oArticle->oxarticles__oxpic1 = new oxField( "testPic1.jpg" );

        $this->assertEquals( "testPic1.jpg", $oArticle->UNITgetPictureName(1) );
    }

    /**
     * Test geting picture name, when oxpic field is empty.
     *
     * @return null
     */
    public function testGetPictureName_noValue()
    {
        $oArticle = $this->getProxyClass( "oxarticle" );

        $this->assertEquals( "nopic.jpg", $oArticle->UNITgetPictureName(1) );
    }

    /**
     * Test geting article main icon name when icon name is set to oxicon field.
     *
     * @return null
     */
    public function testGetIconName()
    {
        $oArticle = $this->getProxyClass( "oxarticle" );
        $oArticle->oxarticles__oxicon = new oxField( "testIcon.jpg" );

        $this->assertEquals( "testIcon.jpg", $oArticle->UNITgetIconName() );
    }

    /**
     * Test geting article main icon name when oxicon field is empty.
     *
     * @return null
     */
    public function testGetIconName_noValue()
    {
        $oArticle = $this->getProxyClass( "oxarticle" );

        $this->assertEquals( "nopic_ico.jpg", $oArticle->UNITgetIconName() );
    }

    /**
     * Test getting article main icon name generated from master picture.
     *
     * @return null
     */
    public function testGetIconName_usingMasterPicture()
    {
        $oArticle = $this->getMock( "oxarticle", array( "_hasGeneratedImage", "_hasMasterImage" ) );
        $oArticle->expects( $this->once() )->method( '_hasGeneratedImage' )->with( $this->equalTo( '1' ) )->will( $this->returnValue( true ) );
        $oArticle->expects( $this->once() )->method( '_hasMasterImage' )->with( $this->equalTo( '1' ) )->will( $this->returnValue( true ) );
        $oArticle->oxarticles__oxpic1 = new oxField( "testPic1.jpg" );
        $oArticle->disableLazyLoading();

        $this->assertEquals( "testPic1_ico.jpg", $oArticle->UNITgetIconName() );
    }

    /**
     * Test getting article main icon name when picture is not generated from master picture.
     *
     * @return null
     */
    public function testGetIconName_noGeneratedImage()
    {
        $oArticle = $this->getMock( "oxarticle", array( "_hasGeneratedImage", "_hasMasterImage" ) );
        $oArticle->expects( $this->once() )->method( '_hasGeneratedImage' )->with( $this->equalTo( '1' ) )->will( $this->returnValue( false ) );
        $oArticle->expects( $this->never() )->method( '_hasMasterImage' );
        $oArticle->oxarticles__oxpic1 = new oxField( "testPic1.jpg" );
        $oArticle->disableLazyLoading();

        $this->assertEquals( "nopic_ico.jpg", $oArticle->UNITgetIconName() );
    }

    /**
     * Test getting article main icon name when genereated images value is ok,
     * but no master picture is uploaded (compatibility with old versions).
     *
     * @return null
     */
    public function testGetIconName_noMasterImage()
    {
        $oArticle = $this->getMock( "oxarticle", array( "_hasGeneratedImage", "_hasMasterImage" ) );
        $oArticle->expects( $this->once() )->method( '_hasGeneratedImage' )->with( $this->equalTo( '1' ) )->will( $this->returnValue( true ) );
        $oArticle->expects( $this->once() )->method( '_hasMasterImage' )->with( $this->equalTo( '1' ) )->will( $this->returnValue( false ) );
        $oArticle->oxarticles__oxpic1 = new oxField( "testPic1.jpg" );
        $oArticle->disableLazyLoading();

        $this->assertEquals( "nopic_ico.jpg", $oArticle->UNITgetIconName() );
    }

    /**
     * Test getting picture icon name.
     *
     * @return null
     */
    public function testGetIconName_usingIndex()
    {
        $oArticle = $this->getMock( "oxarticle", array( "_hasGeneratedImage" ) );
        $oArticle->expects( $this->once() )->method( '_hasGeneratedImage' )->with( $this->equalTo( '2' ) )->will( $this->returnValue( true ) );
        $oArticle->oxarticles__oxpic2 = new oxField( "testPic2.jpg" );
        $oArticle->disableLazyLoading();

        $this->assertEquals( "testPic2_ico.jpg", $oArticle->UNITgetIconName(2) );
    }

    /**
     * Test getting picture icon name when picture is not generated from master picture
     *
     * @return null
     */
    public function testGetIconName_usingIndex_noGeneratedImage()
    {
        $oArticle = $this->getMock( "oxarticle", array( "_hasGeneratedImage" ) );
        $oArticle->expects( $this->once() )->method( '_hasGeneratedImage' )->with( $this->equalTo( '1' ) )->will( $this->returnValue( false ) );
        $oArticle->oxarticles__oxpic1 = new oxField( "testPic1.jpg" );
        $oArticle->disableLazyLoading();

        $this->assertEquals( "nopic_ico.jpg", $oArticle->UNITgetIconName(1) );
    }

    /**
     * Test getting picture thumbnail name using oxthumb field.
     *
     * @return null
     */
    public function testGetThumbnailName()
    {
        $oArticle = $this->getProxyClass( "oxarticle" );
        $oArticle->oxarticles__oxthumb = new oxField( "testThumb.jpg" );

        $this->assertEquals( "testThumb.jpg", $oArticle->UNITgetThumbnailName() );
    }

    /**
     * Test getting picture thumbnail name using master picture.
     *
     * @return null
     */
    public function testGetThumbnailName_usingMasterPic()
    {
        $oArticle = $this->getMock( "oxarticle", array( "_hasGeneratedImage", "_hasMasterImage" ) );
        $oArticle->expects( $this->once() )->method( '_hasGeneratedImage' )->with( $this->equalTo( '1' ) )->will( $this->returnValue( true ) );
        $oArticle->expects( $this->once() )->method( '_hasMasterImage' )->with( $this->equalTo( '1' ) )->will( $this->returnValue( true ) );
        $oArticle->oxarticles__oxpic1 = new oxField( "testPic1.jpg" );
        $oArticle->disableLazyLoading();

        $this->assertEquals( "testPic1_th.jpg", $oArticle->UNITgetThumbnailName() );
    }

    /**
     * Test getting picture thumbnail name when no thumb image was generated
     * from master picture.
     *
     * @return null
     */
    public function testGetThumbnailName_noGeneratedImage()
    {
        $oArticle = $this->getMock( "oxarticle", array( "_hasGeneratedImage", "_hasMasterImage" ) );
        $oArticle->expects( $this->once() )->method( '_hasGeneratedImage' )->with( $this->equalTo( '1' ) )->will( $this->returnValue( false ) );
        $oArticle->expects( $this->never() )->method( '_hasMasterImage' );
        $oArticle->oxarticles__oxpic1 = new oxField( "testPic1.jpg" );
        $oArticle->disableLazyLoading();

        $this->assertEquals( "nopic.jpg", $oArticle->UNITgetThumbnailName() );
    }

    /**
     * Test getting picture thumbnail name when genereated images value is ok,
     * but no master picture is uploaded (compatibility with old versions).
     *
     * @return null
     */
    public function testGetThumbnailName_noMasterImage()
    {
        $oArticle = $this->getMock( "oxarticle", array( "_hasGeneratedImage", "_hasMasterImage" ) );
        $oArticle->expects( $this->once() )->method( '_hasGeneratedImage' )->with( $this->equalTo( '1' ) )->will( $this->returnValue( true ) );
        $oArticle->expects( $this->once() )->method( '_hasMasterImage' )->with( $this->equalTo( '1' ) )->will( $this->returnValue( false ) );
        $oArticle->oxarticles__oxpic1 = new oxField( "testPic1.jpg" );
        $oArticle->disableLazyLoading();

        $this->assertEquals( "nopic.jpg", $oArticle->UNITgetThumbnailName() );
    }

    /**
     * Test getting zoom picture name using oxzoom field.
     *
     * @return null
     */
    public function testGetZoomPictureName()
    {
        $oArticle = $this->getProxyClass( "oxarticle" );
        $oArticle->oxarticles__oxzoom1 = new oxField( "testZoom1.jpg" );

        $this->assertEquals( "testZoom1.jpg", $oArticle->UNITgetZoomPictureName(1) );
    }

    /**
     * Test getting zoom picture name using master picture.
     *
     * @return null
     */
    public function testGetZoomPictureName_usingMasterPic()
    {
        $oArticle = $this->getMock( "oxarticle", array( "_hasGeneratedImage", "_hasMasterImage" ) );
        $oArticle->expects( $this->once() )->method( '_hasGeneratedImage' )->with( $this->equalTo( '1' ) )->will( $this->returnValue( true ) );
        $oArticle->expects( $this->once() )->method( '_hasMasterImage' )->with( $this->equalTo( '1' ) )->will( $this->returnValue( true ) );
        $oArticle->oxarticles__oxpic1 = new oxField( "testPic1.jpg" );
        $oArticle->disableLazyLoading();

        $this->assertEquals( "testPic1_z1.jpg", $oArticle->UNITgetZoomPictureName(1) );
    }

    /**
     * Test getting zoom picture name when no zoom image was generated
     * from master picture.
     *
     * @return null
     */
    public function testGetZoomPictureName_noGeneratedImage()
    {
        $oArticle = $this->getMock( "oxarticle", array( "_isFieldEmpty", "_hasGeneratedImage", "_hasMasterImage" ) );
        $oArticle->expects( $this->once() )->method( '_isFieldEmpty' )->will( $this->returnValue( true ) );
        $oArticle->expects( $this->once() )->method( '_hasGeneratedImage' )->with( $this->equalTo( '1' ) )->will( $this->returnValue( false ) );
        $oArticle->expects( $this->never() )->method( '_hasMasterImage' );
        $oArticle->oxarticles__oxpic1 = new oxField( "testPic1.jpg" );
        $oArticle->disableLazyLoading();

        $this->assertEquals( "nopic.jpg", $oArticle->UNITgetZoomPictureName(1) );
    }

    /**
     * Test getting zoom picture name using when genereated images value is ok,
     * but no master picture is uploaded (compatibility with old versions).
     *
     * @return null
     */
    public function testGetZoomPictureName_noMasterImage()
    {
        $oArticle = $this->getMock( "oxarticle", array( "_isFieldEmpty", "_hasGeneratedImage", "_hasMasterImage" ) );
        $oArticle->expects( $this->once() )->method( '_isFieldEmpty' )->will( $this->returnValue( true ) );
        $oArticle->expects( $this->once() )->method( '_hasGeneratedImage' )->with( $this->equalTo( '1' ) )->will( $this->returnValue( true ) );
        $oArticle->expects( $this->once() )->method( '_hasMasterImage' )->with( $this->equalTo( '1' ) )->will( $this->returnValue( false ) );
        $oArticle->oxarticles__oxpic1 = new oxField( "testPic1.jpg" );
        $oArticle->disableLazyLoading();

        $this->assertEquals( "nopic.jpg", $oArticle->UNITgetZoomPictureName(1) );
    }

    /**
     * Test images generation
     *
     * @return null
     */
    public function testGenerateImages()
    {
        $oPicHandler = $this->getMock( "oxPictureHandler", array( "generateArticlePictures" ) );
        $oPicHandler->expects( $this->once() )->method( 'generateArticlePictures' );

        modInstances::addMod( "oxPictureHandler", $oPicHandler );

        $oArticle = $this->getMock( "oxArticle", array( "_hasGeneratedImage", "_hasMasterImage", "_isFieldEmpty" ) );
        $oArticle->expects( $this->once() )->method( '_hasGeneratedImage' )->with( $this->equalTo( '1' ) )->will( $this->returnValue( false ) );
        $oArticle->expects( $this->once() )->method( '_hasMasterImage' )->with( $this->equalTo( '1' ) )->will( $this->returnValue( true ) );
        $oArticle->expects( $this->once() )->method( '_isFieldEmpty' )->with( $this->equalTo( 'oxarticles__oxpic1' ) )->will( $this->returnValue( false ) );

        $oArticle->oxarticles__oxpic1 = new oxField( "testPic" );
        $oArticle->UNITgenerateImages( 1 );
    }

    /**
     * Test images generation when article already has generated images
     *
     * @return null
     */
    public function testGenerateImages_noMasterImage()
    {
        $oPicHandler = $this->getMock( "oxPictureHandler", array( "generateArticlePictures" ) );
        $oPicHandler->expects( $this->never() )->method( 'generateArticlePictures' );

        modInstances::addMod( "oxPictureHandler", $oPicHandler );

        $oArticle = $this->getMock( "oxArticle", array( "_hasGeneratedImage", "_hasMasterImage" ) );
        $oArticle->expects( $this->once() )->method( '_hasGeneratedImage' )->will( $this->returnValue( true ) );
        $oArticle->expects( $this->never() )->method( '_hasMasterImage' );

        $oArticle->oxarticles__oxpic1 = new oxField( "testPic" );
        $oArticle->UNITgenerateImages( 1 );
    }

    /**
     * Test images generation when article hasn't generated images
     * and master image file does not exists
     *
     * @return null
     */
    public function testGenerateImages_imagesAlreadyGenerated()
    {
        $oPicHandler = $this->getMock( "oxPictureHandler", array( "generateArticlePictures" ) );
        $oPicHandler->expects( $this->never() )->method( 'generateArticlePictures' );

        modInstances::addMod( "oxPictureHandler", $oPicHandler );

        $oArticle = $this->getMock( "oxArticle", array( "_hasGeneratedImage", "_hasMasterImage" ) );
        $oArticle->expects( $this->once() )->method( '_hasGeneratedImage' )->will( $this->returnValue( false ) );
        $oArticle->expects( $this->once() )->method( '_hasMasterImage' )->will( $this->returnValue( false ) );

        $oArticle->oxarticles__oxpic1 = new oxField( "testPic" );
        $oArticle->UNITgenerateImages( 1 );
    }

    /**
     * Test images generation when pic value is empty
     *
     * @return null
     */
    public function testGenerateImages_picValueIsNotSetted()
    {
        $oPicHandler = $this->getMock( "oxPictureHandler", array( "generateArticlePictures" ) );
        $oPicHandler->expects( $this->never() )->method( 'generateArticlePictures' );

        modInstances::addMod( "oxPictureHandler", $oPicHandler );

        $oArticle = $this->getMock( "oxArticle", array( "_hasGeneratedImage", "_hasMasterImage" ) );
        $oArticle->expects( $this->never() )->method( '_hasGeneratedImage' );
        $oArticle->expects( $this->never() )->method( '_hasMasterImage' );

        $oArticle->UNITgenerateImages( 1 );
    }

    /**
     * Test images generation when pic value is set but is empty
     *
     * @return null
     */
    public function testGenerateImages_picValueIsEmpty()
    {
        $oPicHandler = $this->getMock( "oxPictureHandler", array( "generateArticlePictures" ) );
        $oPicHandler->expects( $this->never() )->method( 'generateArticlePictures' );

        modInstances::addMod( "oxPictureHandler", $oPicHandler );

        $oArticle = $this->getMock( "oxArticle", array( "_hasGeneratedImage", "_hasMasterImage", "_isFieldEmpty" ) );
        $oArticle->expects( $this->once() )->method( '_hasGeneratedImage' )->will( $this->returnValue( false ) );
        $oArticle->expects( $this->once() )->method( '_isFieldEmpty' )->with( $this->equalTo( 'oxarticles__oxpic1' ) )->will( $this->returnValue( true ) );
        $oArticle->expects( $this->never() )->method( '_hasMasterImage' );

        $oArticle->oxarticles__oxpic1 = new oxField( "nopic.jpg" );

        $oArticle->UNITgenerateImages( 1 );
    }

    /**
     * Test updating amount of generated images
     *
     * @return null
     */
    public function testUpdateAmountOfGeneratedPictures()
    {
        $this->oArticle->oxarticles__oxpicsgenerated = new oxField( 0 );
        $this->oArticle->updateAmountOfGeneratedPictures( 3 );

        $this->assertEquals( 3, $this->oArticle->oxarticles__oxpicsgenerated->value );

        $sQ = "SELECT oxpicsgenerated FROM oxarticles WHERE oxid = '".$this->oArticle->getId()."'";
        $this->assertEquals( 3, oxDb::getDb()->getOne($sQ) );
    }

    /**
     * Test checking if article has correct oxpicsgenerated field value
     *
     * @return null
     */
    public function testHasGeneratedImage()
    {
        $oArticle = $this->getProxyClass( "oxarticle" );
        $oArticle->oxarticles__oxpicsgenerated = new oxField( 2 );

        $this->assertTrue( $oArticle->UNIThasGeneratedImage( 2 ) );
        $this->assertFalse( $oArticle->UNIThasGeneratedImage( 3 ) );
    }

    /**
     * Test checking if article has upladed master picture
     *
     * @return null
     */
    public function testHasMasterImage_noImage()
    {
        $oConfig = $this->getMock( "oxconfig", array( "getMasterPicturePath" ) );
        $oConfig->expects( $this->any() )->method( 'getMasterPicturePath' )->with( $this->equalTo( '1/testPic1.jpg' ) )->will( $this->returnValue( false ) );

        $oArticle = $this->getProxyClass( "oxarticle" );
        $oArticle->setConfig( $oConfig );
        $oArticle->oxarticles__oxpic1 = new oxField( 'testPic1.jpg' );

        $this->assertFalse( $oArticle->UNIThasMasterImage( 1 ) );
    }

    /**
     * Test checking if article has upladed master picture when pic value is
     * "nopic.jpg"
     *
     * @return null
     */
    public function testHasMasterImage_withDefaultNoImageValue()
    {
        $oConfig = $this->getMock( "oxconfig", array( "getMasterPicturePath" ) );
        $oConfig->expects( $this->never() )->method( 'getMasterPicturePath' );

        $oArticle = $this->getProxyClass( "oxarticle" );
        $oArticle->setConfig( $oConfig );
        $oArticle->oxarticles__oxpic1 = new oxField( 'nopic.jpg' );

        $this->assertFalse( $oArticle->UNIThasMasterImage( 1 ) );
    }

    /**
     * Test checking if article has upladed master picture
     *
     * @return null
     */
    public function testHasMasterImage_hasImage()
    {
        $oConfig = $this->getMock( "oxconfig", array( "getMasterPicturePath" ) );
        $oConfig->expects( $this->at(0) )->method( 'getMasterPicturePath' )->with( $this->equalTo( '1/testPic1.jpg' ) )->will( $this->returnValue( true ) );
        $oConfig->expects( $this->at(1) )->method( 'getMasterPicturePath' )->with( $this->equalTo( '2/testPic2.jpg' ) )->will( $this->returnValue( true ) );

        $oArticle = $this->getProxyClass( "oxarticle" );
        $oArticle->setConfig( $oConfig );
        $oArticle->oxarticles__oxpic1 = new oxField( 'testPic1.jpg' );
        $oArticle->oxarticles__oxpic2 = new oxField( '2/testPic2.jpg' );

        $this->assertTrue( $oArticle->UNIThasMasterImage( 1 ) );
        $this->assertTrue( $oArticle->UNIThasMasterImage( 2 ) );
    }

    /**
     * Test getting article images file names
     *
     * @return null
     */
    public function testGetPictureFieldValue()
    {
        $oArticle = new oxArticle();
        $oArticle->oxarticles__oxpic1  = new oxField( 'testpic.jpg' );
        $oArticle->oxarticles__oxicon  = new oxField( 'testico.jpg' );
        $oArticle->oxarticles__thumb   = new oxField( 'testthumb.jpg' );
        $oArticle->oxarticles__oxzoom2 = new oxField( 'testzoom.jpg' );

        $this->assertEquals( 'testpic.jpg',   $oArticle->getPictureFieldValue( "oxpic", 1 ) );
        $this->assertEquals( 'testico.jpg',   $oArticle->getPictureFieldValue( "oxicon" ) );
        $this->assertEquals( 'testthumb.jpg', $oArticle->getPictureFieldValue( "thumb" ) );
        $this->assertEquals( 'testzoom.jpg',  $oArticle->getPictureFieldValue( "oxzoom", 2 ) );
    }
}
