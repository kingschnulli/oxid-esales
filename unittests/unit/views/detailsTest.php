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
 * @version   SVN: $Id: detailsTest.php 44354 2012-04-25 11:30:15Z mindaugas.rimgaila $
 */

require_once realpath( "." ).'/unit/OxidTestCase.php';
require_once realpath( "." ).'/unit/test_config.inc.php';

/**
 * Testing details class
 */
class Unit_Views_detailsTest extends OxidTestCase
{
    /**
     * Tear down the fixture.
     *
     * @return null
     */
    protected function tearDown()
    {
        $this->cleanUpTable( 'oxrecommlists' );
        $this->cleanUpTable( 'oxobject2list' );
        $this->cleanUpTable( 'oxmediaurls' );
        $this->cleanUpTable( 'oxarticles' );
        $this->cleanUpTable( 'oxartextends' );

        oxDb::getDB()->execute( 'delete from oxreviews where oxobjectid = "test"' );
        oxDb::getDB()->execute( 'delete from oxratings' );
        parent::tearDown();
    }

    /**
     * Test get canonical url with seo on.
     *
     * @return null
     */
    public function testGetCanonicalUrlSeoOn()
    {
        oxTestModules::addFunction( "oxUtils", "seoIsActive", "{ return true; }" );

        $oProduct = $this->getMock( "oxarticle", array( "getBaseSeoLink", "getBaseStdLink" ) );
        $oProduct->expects( $this->once() )->method( 'getBaseSeoLink')->will( $this->returnValue( "testSeoUrl" ) );
        $oProduct->expects( $this->never() )->method( 'getBaseStdLink')->will( $this->returnValue( "testStdUrl" ) );

        $oDetailsView = $this->getMock( "details", array( "getProduct" ) );
        $oDetailsView->expects( $this->once() )->method( 'getProduct' )->will( $this->returnValue( $oProduct ) );

        $this->assertEquals( "testSeoUrl", $oDetailsView->getCanonicalUrl() );
    }

    /**
     * Test get canonical url with seo off.
     *
     * @return null
     */
    public function testGetCanonicalUrlSeoOff()
    {
        oxTestModules::addFunction( "oxUtils", "seoIsActive", "{ return false; }" );

        $oProduct = $this->getMock( "oxarticle", array( "getBaseSeoLink", "getBaseStdLink" ) );
        $oProduct->expects( $this->never() )->method( 'getBaseSeoLink')->will( $this->returnValue( "testSeoUrl" ) );
        $oProduct->expects( $this->once() )->method( 'getBaseStdLink')->will( $this->returnValue( "testStdUrl" ) );

        $oDetailsView = $this->getMock( "details", array( "getProduct" ) );
        $oDetailsView->expects( $this->once() )->method( 'getProduct' )->will( $this->returnValue( $oProduct ) );

        $this->assertEquals( "testStdUrl", $oDetailsView->getCanonicalUrl() );
    }

    /**
     * Test draw parent url when active product is a variant and only one is buyable.
     *
     * @return null
     */
    public function testDrawParentUrlWhenActiveProductIsVariantAndOnlyOneIsBuyable()
    {
        $oParent = new oxArticle();
        $oParent->load( "1126" );
        $oParent->setId( "_testParent" );
        $oParent->save();

        $oVariant = new oxArticle();
        $oVariant->load( "1126" );
        $oVariant->setId( "_testVariant" );
        $oVariant->oxarticles__oxparentid = new oxField( $oParent->getId() );
        $oVariant->save();

        $oDetailsView = $this->getMock( "details", array( "getProduct" ) );
        $oDetailsView->expects( $this->any() )->method( 'getProduct')->will( $this->returnValue( $oVariant ) );
        $this->assertTrue( $oDetailsView->drawParentUrl() );
    }

    /**
     * Test get additionall url parameters.
     *
     * @return null
     */
    public function testGetAddUrlParams()
    {
        $oDetailsView = $this->getMock( "details", array( "getListType", "getDynUrlParams" ) );
        $oDetailsView->expects( $this->once() )->method( 'getListType')->will( $this->returnValue( "somelisttype" ) );
        $oDetailsView->expects( $this->never() )->method( 'getDynUrlParams');
        $this->assertNull( $oDetailsView->UNITgetAddUrlParams() );

        $oDetailsView = $this->getMock( "details", array( "getListType", "getDynUrlParams" ) );
        $oDetailsView->expects( $this->once() )->method( 'getListType')->will( $this->returnValue( "search" ) );
        $oDetailsView->expects( $this->once() )->method( 'getDynUrlParams')->will( $this->returnValue( "searchparams" ) );
        $this->assertEquals( "searchparams", $oDetailsView->UNITgetAddUrlParams() );
    }

    /**
     * Test process product urls.
     *
     * @return null
     */
    public function testProcessProduct()
    {
        $oProduct = $this->getMock( "oxarticle", array( "setLinkType", "appendLink" ) );
        $oProduct->expects( $this->once() )->method( 'setLinkType')->with( $this->equalTo( "search" ) );
        $oProduct->expects( $this->once() )->method( 'appendLink')->with( $this->equalTo( "searchparams" ) );

        $oDetailsView = $this->getMock( "details", array( "getLinkType", "_getAddUrlParams" ) );
        $oDetailsView->expects( $this->once() )->method( 'getLinkType')->will( $this->returnValue( "search" ) );
        $oDetailsView->expects( $this->once() )->method( '_getAddUrlParams')->will( $this->returnValue( "searchparams" ) );

        $oDetailsView->UNITprocessProduct( $oProduct );

    }

    /**
     * Test get active tag.
     *
     * @return null
     */
    public function testGetTag()
    {
        $oDetails = new Details();

        modConfig::setParameter( 'searchtag', null );
        $this->assertNull( $oDetails->getTag() );

        modConfig::setParameter( 'searchtag', 'sometag' );
        $this->assertEquals( 'sometag', $oDetails->getTag() );
    }

    /**
     * Test load variant information.
     *
     * @return null
     */
    public function testLoadVariantInformation()
    {
        modConfig::getInstance()->setConfigParam( 'blVariantParentBuyable', true );

        $this->getProxyClass( 'oxarticle' );
        $oProductParent = $this->getMock( 'oxarticlePROXY', array( 'getSelectLists', 'getId' ) );
        $oProductParent->expects( $this->once() )->method( 'getSelectLists');
        $oProductParent->expects( $this->atLeastOnce() )->method( 'getId')->will( $this->returnValue( '123' ) );
        $oProductParent->oxarticles__oxvarcount = new oxField( 10 );

        $oProduct = $this->getMock( 'oxarticle', array( 'getParentArticle', 'getVariants', 'getId' ) );
        $oProduct->expects( $this->never() )->method( 'getVariants');
        $oProduct->expects( $this->atLeastOnce() )->method( 'getId')->will( $this->returnValue( 'testArtId' ) );
        $oProduct->oxarticles__oxvarcount = new oxField( 10 );

        $oVar1 = new oxarticle();
        $oVar1->setId( 'var1' );

        $oVar2 = new oxarticle();
        $oVar2->setId( 'var2' );

        $oVar3 = new oxarticle();
        $oVar3->setId( 'var3' );

        $oVar4 = new oxarticle();
        $oVar4->setId( 'var4' );

        $oVarList = new oxlist();
        $oVarList->offsetSet( $oProduct->getId(), $oProduct );
        $oVarList->offsetSet( $oVar1->getId(), $oVar1 );
        $oVarList->offsetSet( $oVar2->getId(), $oVar2 );
        $oVarList->offsetSet( $oVar3->getId(), $oVar3 );
        $oVarList->offsetSet( $oVar4->getId(), $oVar4 );

        $oProductParent->setNonPublicVar( '_aVariantsWithNotOrderables', array( "full" => $oVarList ) );
        $oProductParent->setNonPublicVar( '_blNotBuyableParent', true );

        $oProduct->expects( $this->any() )->method( 'getParentArticle')->will( $this->returnValue( $oProductParent ) );

        $oDetailsView = $this->getMock( 'details', array( 'getProduct', 'getLinkType' ) );
        $oDetailsView->expects( $this->once() )->method( 'getProduct')->will( $this->returnValue( $oProduct ) );
        $oDetailsView->expects( $this->exactly( 6 ) )->method( 'getLinkType');
        $oDetailsView->loadVariantInformation();
    }

    /**
     * Test get link type.
     *
     * @return null
     */
    public function testGetLinkType()
    {
        modConfig::setParameter( 'listtype', 'vendor' );
        $oDetailsView = $this->getMock( "details", array( 'getActCategory' ) );
        $oDetailsView->expects( $this->never() )->method( 'getActCategory');
        $this->assertEquals( OXARTICLE_LINKTYPE_VENDOR, $oDetailsView->getLinkType() );

        modConfig::setParameter( 'listtype', 'manufacturer' );
        $oDetailsView = $this->getMock( "details", array( 'getActCategory' ) );
        $oDetailsView->expects( $this->never() )->method( 'getActCategory');
        $this->assertEquals( OXARTICLE_LINKTYPE_MANUFACTURER, $oDetailsView->getLinkType() );

        modConfig::setParameter( 'listtype', 'tag' );
        $oDetailsView = $this->getMock( "details", array( 'getActCategory' ) );
        $oDetailsView->expects( $this->never() )->method( 'getActCategory');
        $this->assertEquals( OXARTICLE_LINKTYPE_TAG, $oDetailsView->getLinkType() );

        modConfig::setParameter( 'listtype', null );
        $oDetailsView = $this->getMock( "details", array( 'getActCategory' ) );
        $oDetailsView->expects( $this->once() )->method( 'getActCategory')->will( $this->returnValue( null ) );
        $this->assertEquals( OXARTICLE_LINKTYPE_CATEGORY, $oDetailsView->getLinkType() );

        $oCategory = $this->getMock( "oxcategory", array( 'isPriceCategory' ) );
        $oCategory->expects( $this->once() )->method( 'isPriceCategory')->will( $this->returnValue( true ) );

        modConfig::setParameter( 'listtype', "recommlist" );
        $oDetailsView = $this->getMock( "details", array( 'getActCategory' ) );
        $oDetailsView->expects( $this->never() )->method( 'getActCategory')->will( $this->returnValue( $oCategory ) );
        $this->assertEquals( OXARTICLE_LINKTYPE_RECOMM, $oDetailsView->getLinkType() );

        modConfig::setParameter( 'listtype', null );
        $oDetailsView = $this->getMock( "details", array( 'getActCategory' ) );
        $oDetailsView->expects( $this->once() )->method( 'getActCategory')->will( $this->returnValue( $oCategory ) );
        $this->assertEquals( OXARTICLE_LINKTYPE_PRICECATEGORY, $oDetailsView->getLinkType() );
    }

    /**
     * Test get parent product.
     *
     * @return null
     */
    public function testGetParentProduct()
    {
        $oProduct = $this->getMock( "oxarticle", array( "isBuyable" ) );
        $oProduct->expects( $this->any() )->method( 'isBuyable')->will( $this->returnValue( true ) );

        $oDetailsView = $this->getMock( "details", array( "getProduct" ) );
        $oDetailsView->expects( $this->any() )->method( 'getProduct')->will( $this->returnValue( $oProduct ) );

        $oProduct = $oDetailsView->UNITgetParentProduct( '1126' );
        $this->assertTrue( $oProduct instanceof oxarticle );
        $this->assertEquals( '1126', $oProduct->getId() );
    }

    /**
     * Test get parent of non existing product.
     *
     * @return null
     */
    public function testGetProductNotExistingProduct()
    {
        modConfig::setParameter( 'anid', 'notexistingproductid' );
        oxTestModules::addFunction( "oxUtils", "redirect", "{ throw new Exception( \$aA[0] ); }" );

        try {
            $oDetailsView = new details();
            $oDetailsView->getProduct();
        } catch ( Exception $oExcp ) {
            $this->assertEquals( oxConfig::getInstance()->getShopHomeURL(), $oExcp->getMessage(), 'result does not match' );
            return;
        }
        $this->fail( 'product should not be returned' );
    }

    /**
     * Test case for #0002223: variant page works even if parent article is inactive
     *
     * @return null
     */
    public function testForBugEntry0002223()
    {
        $sQ = "select oxid from oxarticles where oxparentid!='' and oxactive = 1";
        modConfig::setParameter( 'anid', oxDb::getDb()->getOne( $sQ ) );
        oxTestModules::addFunction( "oxUtils", "redirect", "{ throw new Exception( \$aA[0] ); }" );

        $oParentProduct = $this->getMock( "oxStdClass", array( "isVisible" ) );
        $oParentProduct->expects( $this->once() )->method( 'isVisible')->will( $this->returnValue( false ) );

        try {
            $oDetailsView = $this->getMock( "details", array( "_getParentProduct" ) );
            $oDetailsView->expects( $this->once() )->method( '_getParentProduct')->will( $this->returnValue( $oParentProduct ) );
            $oDetailsView->getProduct();
        } catch ( Exception $oExcp ) {
            $this->assertEquals( oxConfig::getInstance()->getShopHomeURL(), $oExcp->getMessage(), 'result does not match' );
            return;
        }
        $this->fail( 'product should not be returned' );
    }

    /**
     * Test get invisible product.
     *
     * @return null
     */
    public function testGetProductInvisibleProduct()
    {
        $oProduct = $this->getMock( 'oxarticle', array( 'isVisible' ));
        $oProduct->expects( $this->once() )->method( 'isVisible')->will( $this->returnValue( false ) );

        modConfig::setParameter( 'anid', 'notexistingproductid' );
        oxTestModules::addFunction( "oxUtils", "redirect", "{ throw new Exception( \$aA[0] ); }" );

        try {
            $oDetailsView = $this->getProxyClass( 'details' );
            $oDetailsView->setNonPublicVar( '_oProduct', $oProduct );
            $oDetailsView->getProduct();
        } catch ( Exception $oExcp ) {
            $this->assertEquals( oxConfig::getInstance()->getShopHomeURL(), $oExcp->getMessage(), 'result does not match' );
            return;
        }
        $this->fail( 'product should not be returned' );
    }

    /**
     * Test noIndex property getter.
     *
     * @return null
     */
    public function testNoIndex()
    {
        modConfig::setParameter( 'listtype', 'vendor' );

        $oDetailsView = new details();
        $this->assertEquals( 2, $oDetailsView->noIndex() );
    }

    /**
     * Test noIndex property getter.
     *
     * @return null
     */
    public function testNoIndex_unknowntype()
    {
        modConfig::setParameter( 'listtype', 'unknown' );

        $oView = new Details();
        $this->assertSame( 0, $oView->noIndex() );
    }

    /**
     * Test get tags.
     *
     * @return null
     */
    public function testGetTags()
    {
        $oArt = new oxarticle();
        $oArt->load('2000');

        $oDetails = $this->getMock( 'details', array( 'getUser', 'getProduct' ) );
        $oDetails->expects( $this->once() )->method( 'getUser')->will( $this->returnValue( true ) );
        $oDetails->expects( $this->once() )->method( 'getProduct')->will( $this->returnValue( $oArt ) );
        $oDetails->editTags();

        $aTags = $oDetails->getTags();
        $this->assertTrue(isset($aTags['coolen']));
            $this->assertEquals(5, count($aTags));
    }

    /**
     * Test get tags for editing.
     *
     * @return null
     */
    public function testGetEditTags()
    {
        $oArt = new oxarticle();
        $oArt->load('2000');

        $oDetails = $this->getMock( 'details', array( 'getUser', 'getProduct' ) );
        $oDetails->expects( $this->once() )->method( 'getUser')->will( $this->returnValue( true ) );
        $oDetails->expects( $this->once() )->method( 'getProduct')->will( $this->returnValue( $oArt ) );

        $oDetails->editTags();
        $this->assertTrue($oDetails->getEditTags());
    }

    /**
     * Test get tag cloud after adding new tags.
     *
     * @return null
     */
    public function testGetTagCloudManagerAfterAddTags()
    {
        oxTestModules::addFunction('oxSeoEncoderTag', '_saveToDb', '{return null;}');
        oxTestModules::addFunction("oxutilsserver", "getServerVar", "{ \$aArgs = func_get_args(); if ( \$aArgs[0] === 'HTTP_HOST' ) { return '".oxConfig::getInstance()->getShopUrl()."'; } elseif ( \$aArgs[0] === 'SCRIPT_NAME' ) { return ''; } else { return \$_SERVER[\$aArgs[0]]; } }");
        oxTestModules::addFunction( "oxutils", "seoIsActive", "{return true;}" );
        modConfig::setParameter( 'newTags', "newTag" );
        $oArt = new oxarticle();
        $oArt->load('2000');
        $oArt->setId('_testArt');
        $oArt->save();

        $oArticle = new oxArticle();
        $oArticle->load('_testArt');

        $oDetails = $this->getProxyClass( 'details' );
        $oDetails->setNonPublicVar( "_oProduct", $oArticle );
        $oDetails->addTags();
        $this->assertTrue( $oDetails->getTagCloudManager() instanceof oxTagCloud );
    }

    /**
     * Test get Captcha.
     *
     * @return null
     */
    public function testGetCaptcha()
    {
        $oDetails = $this->getProxyClass( 'details' );
        $this->assertEquals(oxNew('oxCaptcha'), $oDetails->getCaptcha());
    }

    /**
     * Test get product.
     *
     * @return null
     */
    public function testGetProduct()
    {
        oxTestModules::addFunction( "oxutils", "seoIsActive", "{return false;}" );
        modConfig::setParameter( 'anid', '2000' );
        $oDetails = $this->getProxyClass( 'details' );
        $oDetails->init();
        $this->assertEquals('2000', $oDetails->getProduct()->getId());
    }

    /**
     * Test get product.
     *
     * @return null
     */
    public function testGetProductWithDirectVariant()
    {
        $oProduct = $this->getMock( 'oxarticle', array( 'load', 'getVariantSelections' ));
        $oProduct->expects( $this->once() )->method( 'load')
                ->with( $this->equalTo( 'anid__' ) )
                ->will($this->returnValue(1));
        $oProduct->expects( $this->once() )->method( 'getVariantSelections')
                ->with( $this->equalTo( 'varselid__' ) )
                ->will($this->returnValue(array('oActiveVariant'=>'actvar', 'blPerfectFit'=>true)));
        oxTestModules::addModuleObject('oxarticle', $oProduct);

        modConfig::setParameter( 'anid', 'anid__' );
        modConfig::setParameter( 'varselid', 'varselid__' );

        $oDetailsView = $this->getProxyClass( 'details' );
        $oDetailsView->setNonPublicVar( '_blIsInitialized', 1 );
        $this->assertEquals('actvar', $oDetailsView->getProduct());
    }

    /**
     * Test get product.
     *
     * @return null
     */
    public function testGetProductWithIndirectVariant()
    {
        $oProduct = $this->getMock( 'oxarticle', array( 'load', 'getVariantSelections' ));
        $oProduct->expects( $this->once() )->method( 'load')
                ->with( $this->equalTo( 'anid__' ) )
                ->will($this->returnValue(1));
        $oProduct->expects( $this->once() )->method( 'getVariantSelections')
                ->with( $this->equalTo( 'varselid__' ) )
                ->will($this->returnValue(array('oActiveVariant'=>'actvar', 'blPerfectFit'=>false)));
        oxTestModules::addModuleObject('oxarticle', $oProduct);

        modConfig::setParameter( 'anid', 'anid__' );
        modConfig::setParameter( 'varselid', 'varselid__' );

        $oDetailsView = $this->getProxyClass( 'details' );
        $oDetailsView->setNonPublicVar( '_blIsInitialized', 1 );
        $this->assertSame($oProduct, $oDetailsView->getProduct());
    }

    /**
     * Test get variant list.
     *
     * @return null
     */
    public function testGetVariantList()
    {
        modConfig::setParameter( 'anid', '2077' );

        $oDetails = $this->getProxyClass( 'details' );
        $this->assertEquals( 3, $oDetails->getVariantList()->count() );
    }

    /**
     * Test get variant list.
     *
     * @return null
     */
    public function testGetVariantListExceptCurrent()
    {
        $oProd = new oxBase();
        $oProd->setId('asdasd');

        $oKeep1 = new stdClass();
        $oKeep1->asd = 'asd';

        $oKeep2 = new stdClass();
        $oKeep2->asdd = 'asasdd';

        $oList = new oxlist();
        $oList->assign(array('asdasd' => $oKeep1, 'asd' => $oKeep2));

        $oDetails = $this->getMock('details', array('getVariantList', 'getProduct'));
        $oDetails->expects($this->once())->method('getVariantList')->will($this->returnValue($oList));
        $oDetails->expects($this->once())->method('getProduct')->will($this->returnValue($oProd));

        $aRet = $oDetails->getVariantListExceptCurrent();

        $this->assertEquals(1, count($aRet));

        $oExpect = new oxlist();
        $oExpect->assign(array('asd' => $oKeep2));
        $this->assertEquals($oExpect->getArray(), $aRet->getArray());

        // do not reload nor clone articles
        $this->assertSame($oKeep2, $aRet['asd']);

        // original unchanged
        $this->assertEquals(2, count($oList));
    }

    /**
     * Test get media files.
     *
     * @return null
     */
    public function testGetMediaFiles()
    {
        $sQ = "insert into oxmediaurls (oxid, oxobjectid, oxurl, oxdesc) values ('_test2', '2000', 'http://www.youtube.com/watch?v=ZN239G6aJZo', 'test2')";
        oxDb::getDb()->execute($sQ);

        $oArt = new oxArticle();
        $oArt->load('2000');
        $oDetails = $this->getProxyClass( 'details' );
        $oDetails->setNonPublicVar( "_oProduct", $oArt );
        $oMediaUrls = $oDetails->getMediaFiles();

        $this->assertEquals(1, count($oMediaUrls));
        $this->assertTrue(isset($oMediaUrls['_test2']));
        $this->assertEquals('test2', $oMediaUrls['_test2']->oxmediaurls__oxdesc->value);
    }

    /**
     * Test get last seen product list.
     *
     * @return null
     */
    public function testGetLastProducts()
    {
        modSession::getInstance()->addClassFunction('getId', create_function('', 'return "ok";'));
        modConfig::setParameter( 'anid', '1771' );
        $oDetails = $this->getProxyClass( 'details' );
        $oDetails->init();
        $oDetails->render();
        $oDetails->getLastProducts();

        modConfig::setParameter( 'anid', '2000' );
        $oDetails = $this->getProxyClass( 'details' );
        $oDetails->init();

        $this->assertEquals('1771', $oDetails->getLastProducts()->current()->getId());
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

        $oDetails = $this->getMock( 'details', array( 'getProduct' ) );
        $oDetails->expects( $this->once() )->method( 'getProduct')->will( $this->returnValue( $oArticle ) );

        $oExpVendor = new oxvendor();
        $oExpVendor->load($sVendId);
        $oVendor = $oDetails->getVendor();
        $this->assertEquals( $oExpVendor->oxvendors__oxtitle->value, $oVendor->oxvendors__oxtitle->value );
    }

    /**
     * Test get manufacturer.
     *
     * @return null
     */
    public function testGetManufacturer()
    {
        $sManId = '68342e2955d7401e6.18967838';
        $oArticle = $this->getMock( 'oxarticle', array( 'getManufacturerId' ) );
        $oArticle->expects( $this->any() )->method( 'getManufacturerId')->will( $this->returnValue( false ) );

        $oDetails = $this->getMock( 'details', array( 'getProduct' ) );
        $oDetails->expects( $this->any() )->method( 'getProduct')->will( $this->returnValue( $oArticle ) );

        $oExpVendor = new oxvendor();
        $oExpVendor->load($sManId);

        $oVendor = $oDetails->getManufacturer();
        $this->assertEquals( $oExpVendor->oxvendors__oxtitle->value, $oVendor->oxvendors__oxtitle->value );
    }

    /**
     * Test get category.
     *
     * @return null
     */
    public function testGetCategory()
    {
        $oArticle = new oxarticle();
        $oArticle->load( '1126' );
        $oDetails = $this->getProxyClass( 'details' );
        $oDetails->setNonPublicVar( "_oProduct", $oArticle );
        $oCategory = $oDetails->getCategory();

            $sCatId = "8a142c3e49b5a80c1.23676990";

        $this->assertNotNull( $oCategory );
        $this->assertEquals( $sCatId, $oCategory->getId() );
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
        $oDetails = $this->getProxyClass( 'details' );
        $oDetails->setNonPublicVar( "_oProduct", $oArticle );
        $sSelect = "select oxattrid from oxobject2attribute where oxobjectid = '$sArtID'";
        $sID = oxDb::getDB()->getOne($sSelect);
        $sSelect = "select oxvalue from oxobject2attribute where oxattrid = '$sID' and oxobjectid = '$sArtID'";
        $sExpectedValue = oxDb::getDB()->getOne($sSelect);
        $aAttrList = $oDetails->getAttributes();
        $sAttribValue = $aAttrList[$sID]->oxobject2attribute__oxvalue->value;
        $this->assertEquals( $sExpectedValue, $sAttribValue);
    }

    /**
     * Test draw parent url.
     *
     * @return null
     */
    public function testDrawParentUrl()
    {
        $oProduct = new oxarticle();
        $oProduct->oxarticles__oxparentid = new oxField( 'parent' );

        $oDetails = $this->getMock( 'details', array( 'getProduct' ) );
        $oDetails->expects( $this->any() )->method( 'getProduct')->will( $this->returnValue( $oProduct ) );

        $this->assertTrue( $oDetails->drawParentUrl() );
    }

    /**
     * Test get parent name.
     *
     * @return null
     */
    public function testGetParentName()
    {
        $oProduct = new oxarticle();
        $oProduct->load( '2000' );
        $oProduct->oxarticles__oxparentid = new oxField( 'parent' );

        $oDetails = $this->getMock( 'details', array( '_getParentProduct', 'getProduct', 'getVariantList' ) );
        $oDetails->expects( $this->any() )->method( 'getProduct')->will( $this->returnValue( $oProduct ) );
        $oDetails->expects( $this->any() )->method( '_getParentProduct')->will( $this->returnValue( $oProduct ) );

        $this->assertEquals( $oProduct->oxarticles__oxtitle->value, $oDetails->getParentName() );
    }

    /**
     * Test get parent url.
     *
     * @return null
     */
    public function testGetParentUrl()
    {
        $oProduct = new oxarticle();
        $oProduct->load( '2000' );
        $oProduct->oxarticles__oxparentid = new oxField( 'parent' );

        $oDetails = $this->getMock( 'details', array( '_getParentProduct', 'getProduct', 'getVariantList' ) );
        $oDetails->expects( $this->any() )->method( 'getProduct')->will( $this->returnValue( $oProduct ) );
        $oDetails->expects( $this->any() )->method( '_getParentProduct')->will( $this->returnValue( $oProduct ) );

        $this->assertEquals( $oProduct->getLink(), $oDetails->getParentUrl() );
    }

    /**
     * Test get picture galery.
     *
     * @return null
     */
    public function testGetPictureGallery()
    {
        $sArtID = "096a1b0849d5ffa4dd48cd388902420b";

        $oArticle = new oxarticle();
        $oArticle->load($sArtID);
        $sActPic =  oxConfig::getInstance()->getPictureUrl(null)."generated/product/1/380_340_75/".basename( $oArticle->oxarticles__oxpic1->value );

        $oDetails = $this->getMock( 'details', array( "getPicturesProduct" ) );
        $oDetails->expects( $this->once() )->method( 'getPicturesProduct')->will( $this->returnValue( $oArticle ) );
        $aPicGallery = $oDetails->getPictureGallery();

        $this->assertEquals($sActPic, $aPicGallery['ActPic']);
    }

    /**
     * Test get active picture id.
     *
     * @return null
     */
    public function testGetActPictureId()
    {
        $aPicGallery = array('ActPicID'=>'aaa');
        $oDetails = $this->getProxyClass( 'details' );
        $oDetails->setNonPublicVar( "_aPicGallery", $aPicGallery );
        $this->assertEquals('aaa', $oDetails->getActPictureId());
    }


    /**
     * Test get active picture.
     *
     * @return null
     */
    public function testGetActPicture()
    {
        $aPicGallery = array('ActPic'=>'aaa');
        $oDetails = $this->getProxyClass( 'details' );
        $oDetails->setNonPublicVar( "_aPicGallery", $aPicGallery );
        $this->assertEquals('aaa', $oDetails->getActPicture());
    }


    /**
     * Test get more pictures.
     *
     * @return null
     */
    public function testMorePics()
    {
        $aPicGallery = array('MorePics'=>true);
        $oDetails = $this->getProxyClass( 'details' );
        $oDetails->setNonPublicVar( "_aPicGallery", $aPicGallery );
        $this->assertTrue($oDetails->morePics());
    }


    /**
     * Test get pictures.
     *
     * @return null
     */
    public function testGetPictures()
    {
        $aPicGallery = array('Pics'=>'aaa');
        $oDetails = $this->getProxyClass( 'details' );
        $oDetails->setNonPublicVar( "_aPicGallery", $aPicGallery );
        $this->assertEquals('aaa', $oDetails->getPictures());
    }


    /**
     * Test get icons.
     *
     * @return null
     */
    public function testGetIcons()
    {
        $aPicGallery = array('Icons'=>'aaa');
        $oDetails = $this->getProxyClass( 'details' );
        $oDetails->setNonPublicVar( "_aPicGallery", $aPicGallery );
        $this->assertEquals('aaa', $oDetails->getIcons());
    }

    /**
     * Test show zoom pictures.
     *
     * @return null
     */
    public function testShowZoomPics()
    {
        $aPicGallery = array('ZoomPic'=>true);
        $oDetails = $this->getProxyClass( 'details' );
        $oDetails->setNonPublicVar( "_aPicGallery", $aPicGallery );
        $this->assertTrue($oDetails->showZoomPics());
    }

    /**
     * Test get zoom pictures.
     *
     * @return null
     */
    public function testGetZoomPics()
    {
        $aPicGallery = array('ZoomPics'=>'aaa');
        $oDetails = $this->getProxyClass( 'details' );
        $oDetails->setNonPublicVar( "_aPicGallery", $aPicGallery );
        $this->assertEquals('aaa', $oDetails->getZoomPics());
    }

    /**
     * Test get active zoom picture.
     *
     * @return null
     */
    public function testGetActZoomPic()
    {
        $oDetails = $this->getProxyClass( 'details' );
        $this->assertEquals(1, $oDetails->getActZoomPic());
    }

    /**
     * Test get select lists.
     *
     * @return null
     */
    public function testGetSelectLists()
    {
        modConfig::getInstance()->setConfigParam( 'bl_perfLoadSelectLists', true );
        $oArticle = $this->getMock( 'oxarticle', array( 'getSelectLists' ) );
        $oArticle->expects( $this->any() )->method( 'getSelectLists')->will( $this->returnValue( "aaa" ) );

        $oDetails = $this->getMock( 'details', array( 'getProduct' ) );
        $oDetails->expects( $this->once() )->method( 'getProduct')->will( $this->returnValue( $oArticle ) );

        $this->assertEquals('aaa', $oDetails->getSelectLists());
    }

    /**
     * Test get reviews.
     *
     * @return null
     */
    public function testGetReviews()
    {
        $oArticle = $this->getMock( 'oxarticle', array( 'getReviews' ) );
        $oArticle->expects( $this->any() )->method( 'getReviews')->will( $this->returnValue( "aaa" ) );

        $oDetails = $this->getMock( 'details', array( 'getProduct' ) );
        $oDetails->expects( $this->once() )->method( 'getProduct')->will( $this->returnValue( $oArticle ) );

        $this->assertEquals('aaa', $oDetails->getReviews());
    }

    /**
     * Test get similar products.
     *
     * @return null
     */
    public function testGetSimilarProducts()
    {
        $oDetails = $this->getProxyClass( 'details' );
        $oArticle = oxNew("oxarticle");
        $oArticle->load("2000");
        $oDetails->setNonPublicVar( "_oProduct", $oArticle );
        $oList = $oDetails->getSimilarProducts();
        $this->assertTrue( $oList instanceof oxarticlelist );
        $iCount = 4;
            $iCount = 5;
        $this->assertEquals( $iCount, count($oList) );
    }

    /**
     * Test get crossselling.
     *
     * @return null
     */
    public function testGetCrossSelling()
    {
        $oDetails = $this->getProxyClass( 'details' );
        $oArticle = oxNew("oxarticle");
        $oArticle->load("1849");
        $oDetails->setNonPublicVar( "_oProduct", $oArticle );
        $oList = $oDetails->getCrossSelling();
        $this->assertTrue( $oList instanceof oxarticlelist );

        $iCount = 3;
            $iCount = 2;
        $this->assertEquals( $iCount, $oList->count() );
    }

    /**
     * Test get similar recomendation lists.
     *
     * @return null
     */
    public function testGetSimilarRecommLists()
    {
        oxTestModules::addFunction('oxRecommList', 'getRecommListsByIds', '{ return "testRecomm"; }');

        $oDetails = $this->getProxyClass( 'details' );
        $oArticle = oxNew("oxarticle");
        $oArticle->load("1849");
        $oDetails->setNonPublicVar( "_oProduct", $oArticle );

        $this->assertEquals( "testRecomm", $oDetails->getSimilarRecommLists() );
    }

    /**
     * Test get accessories.
     *
     * @return null
     */
    public function testGetAccessoires()
    {
        $oArticle = $this->getMock( 'oxarticle', array( 'getAccessoires' ) );
        $oArticle->expects( $this->any() )->method( 'getAccessoires')->will( $this->returnValue( "aaa" ) );

        $oDetails = $this->getMock( 'details', array( 'getProduct' ) );
        $oDetails->expects( $this->once() )->method( 'getProduct')->will( $this->returnValue( $oArticle ) );

        $this->assertEquals( "aaa", $oDetails->getAccessoires() );
    }

    /**
     * Test get also bought these products.
     *
     * @return null
     */
    public function testGetAlsoBoughtTheseProducts()
    {
        $oArticle = $this->getMock( 'oxarticle', array( 'getCustomerAlsoBoughtThisProducts' ) );
        $oArticle->expects( $this->any() )->method( 'getCustomerAlsoBoughtThisProducts')->will( $this->returnValue( "aaa" ) );

        $oDetails = $this->getMock( 'details', array( 'getProduct' ) );
        $oDetails->expects( $this->once() )->method( 'getProduct')->will( $this->returnValue( $oArticle ) );

        $this->assertEquals( "aaa", $oDetails->getAlsoBoughtTheseProducts() );
    }

    /**
     * Test is product added to price allarm.
     *
     * @return null
     */
    public function testIsPriceAlarm()
    {
        $oArticle = new oxStdClass();
        $oArticle->oxarticles__oxblfixedprice = new oxField(1, oxField::T_RAW);

        $oView = $this->getMock( 'details', array( 'getProduct' ) );
        $oView->expects( $this->once() )->method( 'getProduct' )->will( $this->returnValue( $oArticle ) );

        $this->assertEquals( 0, $oView->isPriceAlarm() );
    }

    /**
     * Test is product added to price allarm - true test.
     *
     * @return null
     */
    public function testIsPriceAlarm_true()
    {
        $oArticle = new oxStdClass();
        $oArticle->oxarticles__oxblfixedprice = new oxField(0, oxField::T_RAW);

        $oView = $this->getMock( 'details', array( 'getProduct' ) );
        $oView->expects( $this->once() )->method( 'getProduct' )->will( $this->returnValue( $oArticle ) );

        $this->assertEquals( 1, $oView->isPriceAlarm() );
    }

    /**
     * Test meta keywords generation.
     *
     * @return null
     */
    public function testMetaKeywords()
    {
        $oProduct = oxNew("oxarticle");
        $oProduct->load("1849");
        $oProduct->oxarticles__oxsearchkeys->value = 'testValue1 testValue2   testValue3 <br> ';

        //building category tree for category "Bar-eqipment"
            $sCatId = '8a142c3e49b5a80c1.23676990';

        $oCategoryTree = oxNew( 'oxcategorylist' );
        $oCategoryTree->buildTree( $sCatId, false, false, false );

        $oDetails = $this->getMock( 'details', array( 'getProduct', 'getCategoryTree' ) );
        $oDetails->expects( $this->any() )->method( 'getProduct')->will( $this->returnValue( $oProduct ) );
        $oDetails->expects( $this->any() )->method( 'getCategoryTree')->will( $this->returnValue( $oCategoryTree ) );

        $sKeywords = $oProduct->oxarticles__oxtitle->value;

        //adding breadcrumb
            $sKeywords .= ", Geschenke, Bar-Equipment";

        $oView = new oxubase();
        $sTestKeywords = $oView->UNITprepareMetaKeyword( $sKeywords, true ) . ", testvalue1, testvalue2, testvalue3";

        $this->assertEquals( $sTestKeywords, $oDetails->UNITprepareMetaKeyword( null ) );
    }

    /**
     * Test meta keywords set to view data.
     *
     * @return null
     */
    public function testViewMetaKeywords()
    {
        oxTestModules::addFunction('oxSeoEncoderTag', '_saveToDb', '{return null;}');
        $oSubj = $this->getProxyClass('details');

        $oArticle = oxNew("oxarticle");
        $oArticle->load("1849");
        $oSubj->setNonPublicVar( "_oProduct", $oArticle );

        $oSubj->render();

        $this->assertTrue(strlen($oSubj->getMetaKeywords()) > 0);
    }

    /**
     * Test meta meta desctionio generation..
     *
     * @return null
     */
    public function testMetaDescription()
    {
        $oProduct = oxNew("oxarticle");
        $oProduct->load("1849");

        $oDetails = $this->getMock( 'details', array( 'getProduct' ) );
        $oDetails->expects( $this->once() )->method( 'getProduct')->will( $this->returnValue( $oProduct ) );

        $sMeta = $oProduct->oxarticles__oxtitle->value.' - '.$oProduct->oxarticles__oxlongdesc->value;

        $oView = new oxubase();
        $this->assertEquals( $oView->UNITprepareMetaDescription( $sMeta, 200, false ), $oDetails->UNITprepareMetaDescription( null ) );
    }

    /**
     * Test search title setter/getter.
     *
     * @return null
     */
    public function testSetGetSearchTitle()
    {
        $oDetails = $this->getProxyClass( 'details' );
        $oDetails->setSearchTitle( "tetsTitle" );

        $this->assertEquals( "tetsTitle", $oDetails->getSearchTitle() );
    }

    /**
     * Test category path setter/getter.
     *
     * @return null
     */
    public function testSetGetCatTreePath()
    {
        $oDetails = $this->getProxyClass( 'details' );
        $oDetails->setCatTreePath( "tetsPath" );

        $this->assertEquals( "tetsPath", $oDetails->getCatTreePath() );
    }

    /**
     * Test article picture getter.
     *
     * @return null
     */
    public function testGetArtPic()
    {
        $aPicGallery = array('Pics'=> array ( 1 => 'aaa') );
        $oDetails = $this->getProxyClass( 'details' );
        $oDetails->setNonPublicVar( "_aPicGallery", $aPicGallery );
        $this->assertEquals('aaa', $oDetails->getArtPic(1));
    }

    /**
     * Test base view class title getter.
     *
     * @return null
     */
    public function testGetTitle()
    {
        $this->_oProduct->oxarticles__oxtitle->value . ( $this->_oProduct->oxarticles__oxvarselect->value ? ' ' . $this->_oProduct->oxarticles__oxvarselect->value : '' );

        $oProduct = new oxarticle();
        $oProduct->oxarticles__oxtitle = new oxstdClass();
        $oProduct->oxarticles__oxtitle->value = 'product title';
        $oProduct->oxarticles__oxvarselect = new oxstdClass();
        $oProduct->oxarticles__oxvarselect->value = 'and varselect';

        $oDetails = $this->getMock( 'details', array( 'getProduct' ) );
        $oDetails->expects( $this->once() )->method( 'getProduct')->will( $this->returnValue( $oProduct ) );

        $this->assertEquals( 'product title and varselect', $oDetails->getTitle() );
    }

    /**
     * Test base view class title getter - no product.
     *
     * @return null
     */
    public function testGetTitle_noproduct()
    {
        $oView = $this->getMock( 'Details', array( 'getProduct' ) );
        $oView->expects( $this->once() )->method( 'getProduct' )->will( $this->returnValue( null ) );
        $this->assertNull( $oView->getTitle() );
    }

    /**
     * Test cannonical URL getter - no product.
     *
     * @return null
     */
    public function testGetCanonicalUrl_noproduct()
    {
        $oView = $this->getMock( 'Details', array( 'getProduct' ) );
        $oView->expects( $this->once() )->method( 'getProduct' )->will( $this->returnValue( null ) );
        $this->assertNull( $oView->getCanonicalUrl() );
    }

    /**
     * Test review saving.
     *
     * @return null
     */
    public function testSaveReview()
    {
        modConfig::setParameter( 'rvw_txt', 'review test' );
        modConfig::setParameter( 'artrating', '4' );
        modConfig::setParameter( 'anid', 'test' );
        modSession::getInstance()->setVar( 'usr', 'oxdefaultadmin' );
        $oProduct = $this->getMock( 'oxarticle', array( 'getId', 'addToRatingAverage' ) );
        $oProduct->expects( $this->any() )->method( 'getId')->will( $this->returnValue( 'test' ) );
        $oProduct->expects( $this->any() )->method( 'addToRatingAverage');

        $oDetails = $this->getMock( 'details', array( 'getProduct', 'canAcceptFormData' ) );
        $oDetails->expects( $this->any() )->method( 'getProduct')->will( $this->returnValue( $oProduct ) );
        $oDetails->expects( $this->any() )->method( 'canAcceptFormData')->will( $this->returnValue( true ) );
        $oDetails->saveReview();

        $this->assertEquals( "test", oxDb::getDB()->getOne('select oxobjectid from oxreviews where oxobjectid = "test"') );
        $this->assertEquals( "test", oxDb::getDB()->getOne('select oxobjectid from oxratings where oxobjectid = "test"') );
    }

    /**
     * Test review saving without user.
     *
     * @return null
     */
    public function testSaveReviewIfUserNotSet()
    {
        modConfig::setParameter( 'rvw_txt', 'review test' );
        modConfig::setParameter( 'artrating', '4' );
        modConfig::setParameter( 'anid', 'test' );
        modSession::getInstance()->setVar( 'usr', null );
        $oProduct = $this->getMock( 'oxarticle', array( 'getId', 'addToRatingAverage' ) );
        $oProduct->expects( $this->any() )->method( 'getId')->will( $this->returnValue( 'test' ) );
        $oProduct->expects( $this->any() )->method( 'addToRatingAverage');

        $oDetails = $this->getProxyClass( 'details' );
        $oDetails = $this->getMock( 'details', array( 'getProduct' ) );
        $oDetails->expects( $this->any() )->method( 'getProduct')->will( $this->returnValue( $oProduct ) );
        $oDetails->saveReview();

        $this->assertFalse( oxDb::getDB()->getOne('select oxobjectid from oxreviews where oxobjectid = "test"') );
        $this->assertFalse( oxDb::getDB()->getOne('select oxobjectid from oxratings where oxobjectid = "test"') );
    }

    /**
     * Test review saving without rating.
     *
     * @return null
     */
    public function testSaveReviewIfOnlyReviewIsSet()
    {
        modConfig::setParameter( 'rvw_txt', 'review test' );
        modConfig::setParameter( 'artrating', null );
        modConfig::setParameter( 'anid', 'test' );

        $oProduct = $this->getMock( 'oxarticle', array( 'getId', 'addToRatingAverage' ) );
        $oProduct->expects( $this->any() )->method( 'getId')->will( $this->returnValue( 'test' ) );
        $oProduct->expects( $this->any() )->method( 'addToRatingAverage');

        $oUser = new oxUser();
        $oUser->load( 'oxdefaultadmin' );

        $oDetails = $this->getProxyClass( 'details' );
        $oDetails = $this->getMock( 'details', array( 'getProduct', 'getUser', 'canAcceptFormData' ) );
        $oDetails->expects( $this->any() )->method( 'getProduct')->will( $this->returnValue( $oProduct ) );
        $oDetails->expects( $this->any() )->method( 'getUser')->will( $this->returnValue( $oUser ) );
        $oDetails->expects( $this->any() )->method( 'canAcceptFormData')->will( $this->returnValue( true ) );
        $oDetails->saveReview();

        $this->assertEquals( "test", oxDb::getDB()->getOne('select oxobjectid from oxreviews where oxobjectid = "test"') );
        $this->assertFalse( oxDb::getDB()->getOne('select 1 from oxratings where oxobjectid = "test"') );
    }

    /**
     * Test review saving with wrong rating.
     *
     * @return null
     */
    public function testSaveReviewIfWrongRating()
    {
        modConfig::setParameter( 'rvw_txt', 'review test' );
        modConfig::setParameter( 'artrating', 6 );
        modConfig::setParameter( 'anid', 'test' );

        $oProduct = $this->getMock( 'oxarticle', array( 'getId', 'addToRatingAverage' ) );
        $oProduct->expects( $this->any() )->method( 'getId')->will( $this->returnValue( 'test' ) );
        $oProduct->expects( $this->any() )->method( 'addToRatingAverage');

        $oUser = new oxUser();
        $oUser->load( 'oxdefaultadmin' );

        $oDetails = $this->getProxyClass( 'details' );
        $oDetails = $this->getMock( 'details', array( 'getProduct', 'getUser', 'canAcceptFormData' ) );
        $oDetails->expects( $this->any() )->method( 'getProduct')->will( $this->returnValue( $oProduct ) );
        $oDetails->expects( $this->any() )->method( 'getUser')->will( $this->returnValue( $oUser ) );
        $oDetails->expects( $this->any() )->method( 'canAcceptFormData')->will( $this->returnValue( true ) );
        $oDetails->saveReview();

        $this->assertEquals( "test", oxDb::getDB()->getOne('select oxobjectid from oxreviews where oxobjectid = "test"') );
        $this->assertFalse( oxDb::getDB()->getOne('select oxobjectid from oxratings where oxobjectid = "test"') );
    }

    /**
     * Test only review rating saving.
     *
     * @return null
     */
    public function testSaveReviewIfOnlyRatingIsSet()
    {
        modConfig::setParameter( 'rvw_txt', null );
        modConfig::setParameter( 'artrating', 3 );
        modConfig::setParameter( 'anid', 'test' );
        modSession::getInstance()->setVar( 'usr', 'oxdefaultadmin' );
        $oProduct = $this->getMock( 'oxarticle', array( 'getId', 'addToRatingAverage' ) );
        $oProduct->expects( $this->any() )->method( 'getId')->will( $this->returnValue( 'test' ) );
        $oProduct->expects( $this->any() )->method( 'addToRatingAverage');

        $oDetails = $this->getMock( 'details', array( 'getProduct', 'canAcceptFormData' ) );
        $oDetails->expects( $this->any() )->method( 'getProduct')->will( $this->returnValue( $oProduct ) );
        $oDetails->expects( $this->any() )->method( 'canAcceptFormData')->will( $this->returnValue( true ) );
        $oDetails->saveReview();

        $this->assertFalse( oxDb::getDB()->getOne('select oxobjectid from oxreviews where oxobjectid = "test"') );
        $this->assertEquals( "test", oxDb::getDB()->getOne('select oxobjectid from oxratings where oxobjectid = "test"') );
    }

    /**
     * Test is multidimensionall variants enabled.
     *
     * @return null
     */
    public function testIsMdVariantView()
    {
        modConfig::getInstance()->setConfigParam( 'blUseMultidimensionVariants', true );
        $oMdVariant = $this->getMock( 'oxMdVariant', array( 'getMaxDepth' ) );
        $oMdVariant->expects( $this->any() )->method( 'getMaxDepth')->will( $this->returnValue( 2 ) );
        $oProduct = $this->getMock( 'oxarticle', array( 'getMdVariants' ) );
        $oProduct->expects( $this->any() )->method( 'getMdVariants')->will( $this->returnValue( $oMdVariant ) );
        $oDetails = $this->getMock( 'details', array( 'getProduct' ) );
        $oDetails->expects( $this->any() )->method( 'getProduct')->will( $this->returnValue( $oProduct ) );

        $this->assertTrue( $oDetails->isMdVariantView() );
    }

    /**
     * Test is multidimensionall variants disabled.
     *
     * @return null
     */
    public function testIsMdVariantViewNotActive()
    {
        modConfig::getInstance()->setConfigParam( 'blUseMultidimensionVariants', false );
        $oDetails = $this->getProxyClass( 'details' );
        $this->assertFalse( $oDetails->isMdVariantView() );
    }

    /**
     * Test is persistent parameter.
     *
     * @return null
     */
    public function testIsPersParam()
    {
        $oArt = new oxArticle();
        $oArt->oxarticles__oxisconfigurable = new oxField(true);
        $oSubj = $this->getProxyClass("details");
        $oSubj->setNonPublicVar("_oProduct", $oArt);
        $oSubj->setNonPublicVar("_blIsInitialized", true);
        $this->assertTrue($oSubj->isPersParam());
    }

    /**
     * Test is persistent parameter navigative.
     *
     * @return null
     */
    public function testIsPersParamNegative()
    {
        $oArt = new oxArticle();
        $oArt->oxarticles__oxisconfigurable = new oxField(false);
        $oSubj = $this->getProxyClass("details");
        $oSubj->setNonPublicVar("_oProduct", $oArt);
        $oSubj->setNonPublicVar("_blIsInitialized", true);
        $this->assertFalse($oSubj->isPersParam());
    }

    /**
     * Test oxViewConfig::getShowListmania() affection
     *
     * @return null
     */
    public function testgetSimilarRecommListsIfOff()
    {
        $oCfg = $this->getMock( "stdClass", array( "getShowListmania" ) );
        $oCfg->expects( $this->once() )->method( 'getShowListmania')->will($this->returnValue( false ) );

        $oRecomm = $this->getMock( "details", array( "getViewConfig", 'getArticleList' ) );
        $oRecomm->expects( $this->once() )->method( 'getViewConfig')->will($this->returnValue( $oCfg ) );
        $oRecomm->expects( $this->never() )->method( 'getArticleList');

        $this->assertSame(false, $oRecomm->getSimilarRecommLists());
    }

    /**
     * Test oxViewConfig::getShowListmania() affection
     *
     * @return null
     */
    public function testAddToRecommIfOff()
    {
        $oCfg = $this->getMock( "stdClass", array( "getShowListmania" ) );
        $oCfg->expects( $this->once() )->method( 'getShowListmania')->will($this->returnValue( false ) );

        $oRecomm = $this->getMock( "details", array( "getViewConfig", 'getArticleList' ) );
        $oRecomm->expects( $this->once() )->method( 'getViewConfig')->will($this->returnValue( $oCfg ) );
        $oRecomm->expects( $this->never() )->method( 'getArticleList');

        modConfig::setParameter( 'anid' , 'asd');
        oxTestModules::addFunction('oxrecommlist', 'load', '{throw new Exception("should not come here");}');

        $this->assertSame(null, $oRecomm->addToRecomm());
    }

    /**
     * Test oxViewConfig::getShowListmania() affection
     *
     * @return null
     */
    public function testAddToRecommIfOn()
    {
        $oCfg = $this->getMock( "stdClass", array( "getShowListmania" ) );
        $oCfg->expects( $this->once() )->method( 'getShowListmania')->will($this->returnValue( true ) );

        $oProduct = $this->getMock( 'oxStdClass', array( 'getId' ) );
        $oProduct->expects( $this->once() )->method( 'getId' )->will( $this->returnValue( 'test_artid' ) );

        modConfig::setParameter( 'recomm', 'test_recomm' );
        modConfig::setParameter( 'recomm_txt', 'test_recommtext' );

        $oRecommList = $this->getMock( 'oxStdClass', array( 'load', 'addArticle' ) );
        $oRecommList->expects( $this->once() )->method( 'load' )->with( $this->equalTo('test_recomm') );
        $oRecommList->expects( $this->once() )->method( 'addArticle' )->with( $this->equalTo('test_artid'), $this->equalTo('test_recommtext') );

        $oRecomm = $this->getMock( "details", array( "getViewConfig", 'getProduct' ) );
        $oRecomm->expects( $this->once() )->method( 'getViewConfig' )->will( $this->returnValue( $oCfg ) );
        $oRecomm->expects( $this->once() )->method( 'getProduct' )->will( $this->returnValue( $oProduct ) );

        oxTestModules::addModuleObject('oxrecommlist', $oRecommList);

        $this->assertSame(null, $oRecomm->addToRecomm());
    }

    /**
     * Testing Details::getBreadCrumb()
     *
     * @return null
     */
    public function testGetBreadCrumb()
    {

        $oDetails = new Details();

        modConfig::setParameter( 'listtype', 'search' );
        $this->assertTrue( count($oDetails->getBreadCrumb()) >= 1 );

        modConfig::setParameter( 'listtype', 'tag' );
        $this->assertTrue( count($oDetails->getBreadCrumb()) >= 1 );

        modConfig::setParameter( 'listtype', 'recommlist' );
        $this->assertTrue( count($oDetails->getBreadCrumb()) >= 1 );

        modConfig::setParameter( 'listtype', 'aaa' );

        $oCat1 = $this->getMock( 'oxcategory', array( 'getLink' ));
        $oCat1->expects( $this->once() )->method( 'getLink')->will($this->returnValue( 'linkas1' ) );
        $oCat1->oxcategories__oxtitle = new oxField('title1');

        $oCat2 = $this->getMock( 'oxcategory', array( 'getLink' ));
        $oCat2->expects( $this->once() )->method( 'getLink')->will($this->returnValue( 'linkas2' ) );
        $oCat2->oxcategories__oxtitle = new oxField('title2');

        $oView = $this->getMock( "details", array( "getCatTreePath" ) );
        $oView->expects( $this->once() )->method( 'getCatTreePath')->will( $this->returnValue( array($oCat1, $oCat2 ) ) );

        $this->assertTrue( count($oView->getBreadCrumb()) >= 1 );

    }


    /**
     * details::getVariantSelections() test case
     *
     * @return null
     */
    public function testGetVariantSelections()
    {
        $oProduct = $this->getMock( "oxarticle", array( "getVariantSelections" ) );
        $oProduct->expects( $this->once() )->method( "getVariantSelections" )->will( $this->returnValue( "varselections" ) );
        //$oProduct->expects( $this->never() )->method( "getId" );

        // no parent
        $oView = $this->getMock( "details", array( "getProduct", "_getParentProduct" ) );
        $oView->expects( $this->once() )->method( 'getProduct')->will( $this->returnValue( $oProduct ) );
        $oView->expects( $this->once() )->method( '_getParentProduct')->will( $this->returnValue( false ) );

        $this->assertEquals( "varselections", $oView->getVariantSelections() );

        $oProduct = $this->getMock( "oxarticle", array( "getVariantSelections" ) );
        $oProduct->expects( $this->never() )->method( 'getVariantSelections')->will( $this->returnValue( "varselections" ) );
        //$oProduct->expects( $this->once() )->method( 'getId');

        $oParent = $this->getMock( "oxarticle", array( "getVariantSelections" ) );
        $oParent->expects( $this->once() )->method( 'getVariantSelections')->will( $this->returnValue( "parentselections" ) );

        // has parent
        $oView = $this->getMock( "details", array( "getProduct", "_getParentProduct" ) );
        $oView->expects( $this->once() )->method( 'getProduct')->will( $this->returnValue( $oProduct ) );
        $oView->expects( $this->once() )->method( '_getParentProduct')->will( $this->returnValue( $oParent ) );

        $this->assertEquals( "parentselections", $oView->getVariantSelections() );
    }

    /**
     * details::getPicturesProduct() test case
     *
     * @return null
     */
    public function testGetPicturesProductNoVariantInfo()
    {
        $oProduct = $this->getMock( "stdclass", array( "getId" ) );
        $oProduct->expects( $this->never() )->method( 'getId');

        // no picture product id
        $oView = $this->getMock( "details", array( "getProduct", 'getVariantSelections' ) );
        $oView->expects( $this->once() )->method( 'getProduct')->will( $this->returnValue( $oProduct ) );
        $oView->expects( $this->once() )->method( 'getVariantSelections')->will( $this->returnValue( false ) );
        $this->assertSame($oProduct, $oView->getPicturesProduct());
    }
    public function testGetPicturesProductWithNoPerfectFitVariant()
    {
        $oProduct = $this->getMock( "stdclass", array( "getId" ) );
        $oProduct->expects( $this->never() )->method( 'getId');

        $aInfo = array(
            'oActiveVariant' => $oProduct,
            'blPerfectFit' => false
        );
        // no picture product id
        $oView = $this->getMock( "details", array( "getProduct", 'getVariantSelections' ) );
        $oView->expects( $this->never() )->method( 'getProduct');
        $oView->expects( $this->once() )->method( 'getVariantSelections')->will( $this->returnValue( $aInfo ) );
        $this->assertSame($oProduct, $oView->getPicturesProduct());
    }
    public function testGetPicturesProductWithPerfectFitVariant()
    {
        $oProduct = $this->getMock( "stdclass", array( "getId" ) );
        $oProduct->expects( $this->never() )->method( 'getId');

        $aInfo = array(
            'oActiveVariant' => $oProduct,
            'blPerfectFit' => true
        );
        // no picture product id
        $oView = $this->getMock( "details", array( "getProduct", 'getVariantSelections' ) );
        $oView->expects( $this->once() )->method( 'getProduct')->will( $this->returnValue( 'prod' ) );
        $oView->expects( $this->once() )->method( 'getVariantSelections')->will( $this->returnValue( $aInfo ) );
        $this->assertEquals('prod', $oView->getPicturesProduct());
    }

    public function testGetSearchParamForHtml()
    {
        $oDetails = $this->getProxyClass( 'details' );
        modConfig::setParameter( 'searchparam', 'aaa' );

        $this->assertEquals( 'aaa', $oDetails->getSearchParamForHtml() );
    }

    public function testGetViewId_testcache()
    {
        $oView = $this->getProxyClass('Details');

        $oView->setNonPublicVar( '_sViewId', '_testViewId' );
        $this->assertSame( '_testViewId', $oView->getViewId() );
    }

    public function testGetViewId_testhash()
    {
        $oView = $this->getMock( $this->getProxyClassName('Details'), array( 'getTags' ) );
        $oView->expects( $this->any() )->method( 'getTags' )->will( $this->returnValue( 'test_tags' ) );

        $oBaseView = new oxUBase();
        $sBaseViewId = $oBaseView->getViewId();

        modConfig::setParameter( 'anid', 'test_anid' );
        modConfig::setParameter( 'cnid', 'test_cnid' );
        modConfig::setParameter( 'listtype', 'search' );
        modConfig::setParameter( 'searchparam', 'test_sparam' );
        modConfig::setParameter( 'renderPartial', 'test_render' );
        modConfig::setParameter( 'varselid', 'test_varselid' );
        $aFilters = array( 'test_cnid' => array( 0 => 'test_filters' ) );
        modSession::getInstance()->setVar( 'session_attrfilter', $aFilters );

            $sExpected = $sBaseViewId.'|test_anid|';


        $sResp = $oView->getViewId();
        $this->assertSame( $sExpected, $sResp );
        $this->assertSame( $sExpected, $oView->getNonPublicVar( '_sViewId' ) );
    }


    public function testCanChangeTags_nouser()
    {
        $oView = $this->getMock( 'Details', array( 'getUser' ) );
        $oView->expects( $this->once() )->method( 'getUser' );

        $this->assertFalse( $oView->canChangeTags() );
    }

    public function testCanChangeTags_withuser()
    {
        $oView = $this->getMock( 'Details', array( 'getUser' ) );
        $oView->expects( $this->once() )->method( 'getUser' )->will( $this->returnValue(true) );

        $this->assertTrue( $oView->canChangeTags() );
    }

    public function testCancelTags()
    {
        $oTagCloud = $this->getMock( 'oxStdClass', array( 'getTags' ) );
        $oTagCloud->expects( $this->once() )->method( 'getTags' )->with( $this->equalTo( 'test_artid' ) )->will( $this->returnValue( 'test_tags' ) );
        oxTestModules::addModuleObject('oxTagCloud', $oTagCloud);

        $oProduct = $this->getMock( 'oxStdClass', array( 'getId' ) );
        $oProduct->expects( $this->once() )->method( 'getId' )->will( $this->returnValue( 'test_artid' ) );

        $oConfig = $this->getMock( 'oxStdClass', array( 'getParameter' ) );
        $oConfig->expects( $this->once() )->method( 'getParameter' )->with( $this->equalTo( 'blAjax' ) )->will( $this->returnValue( false ) );

        $oView = $this->getMock( $this->getProxyClassName( 'Details' ), array( 'getConfig', 'getProduct' ) );
        $oView->expects( $this->once() )->method( 'getConfig' )->will( $this->returnValue( $oConfig ) );
        $oView->expects( $this->once() )->method( 'getProduct' )->will( $this->returnValue( $oProduct ) );
        $oView->cancelTags();

        $this->assertSame( 'test_tags', $oView->getNonPublicVar( '_aTags' ) );
        $this->assertSame( false, $oView->getNonPublicVar( '_blEditTags' ) );
    }

    public function testCancelTags_ajaxcall()
    {
        $oTagCloud = $this->getMock( 'oxStdClass', array( 'getTags' ) );
        $oTagCloud->expects( $this->once() )->method( 'getTags' )->with( $this->equalTo( 'test_artid' ) )->will( $this->returnValue( 'test_tags' ) );
        oxTestModules::addModuleObject('oxTagCloud', $oTagCloud);

        $oProduct = $this->getMock( 'oxStdClass', array( 'getId' ) );
        $oProduct->expects( $this->once() )->method( 'getId' )->will( $this->returnValue( 'test_artid' ) );

        $oConfig = $this->getMock( 'oxStdClass', array( 'getParameter' ) );
        $oConfig->expects( $this->once() )->method( 'getParameter' )->with( $this->equalTo( 'blAjax' ) )->will( $this->returnValue( true ) );

        $oUtils = $this->getMock( 'oxStdClass', array( 'setHeader', 'showMessageAndExit' ) );
        $oUtils->expects( $this->once() )->method( 'setHeader' );
        $oUtils->expects( $this->once() )->method( 'showMessageAndExit' );
        oxTestModules::addModuleObject( 'oxUtils', $oUtils );

        $oLang = $this->getMock( 'oxStdClass', array( 'translateString' ) );
        $oLang->expects( $this->once() )->method( 'translateString' );
        oxTestModules::addModuleObject( 'oxLang', $oLang );

        $oSmarty = $this->getMock( 'oxStdClass', array( 'assign', 'fetch' ) );
        $oSmarty->expects( $this->atLeastOnce() )->method( 'assign' );
        $oSmarty->expects( $this->once() )->method( 'fetch' )->with( $this->equalTo( 'page/details/inc/tags.tpl' ), $this->equalTo( 'test_viewId' ) );

        $oUtilsView = $this->getMock( 'oxStdClass', array( 'getSmarty' ) );
        $oUtilsView->expects( $this->once() )->method( 'getSmarty' )->will( $this->returnValue( $oSmarty ) );
        oxTestModules::addModuleObject( 'oxUtilsView', $oUtilsView );

        $oView = $this->getMock( $this->getProxyClassName( 'Details' ), array( 'getConfig', 'getProduct', 'getViewConfig', 'getViewId' ) );
        $oView->expects( $this->once() )->method( 'getConfig' )->will( $this->returnValue( $oConfig ) );
        $oView->expects( $this->once() )->method( 'getProduct' )->will( $this->returnValue( $oProduct ) );
        $oView->expects( $this->once() )->method( 'getViewConfig' );
        $oView->expects( $this->once() )->method( 'getViewId' )->will( $this->returnValue( 'test_viewId' ) );
        $oView->cancelTags();

        $this->assertSame( 'test_tags', $oView->getNonPublicVar( '_aTags' ) );
        $this->assertSame( false, $oView->getNonPublicVar( '_blEditTags' ) );
    }

    public function testEditTags_nouser()
    {
        $oView = $this->getMock( $this->getProxyClassName( 'Details' ), array( 'getConfig', 'getProduct', 'getViewConfig', 'getViewId', 'getUser' ) );
        $oView->expects( $this->never() )->method( 'getConfig' );
        $oView->expects( $this->never() )->method( 'getProduct' );
        $oView->expects( $this->never() )->method( 'getViewConfig' );
        $oView->expects( $this->never() )->method( 'getViewId' );
        $oView->expects( $this->once() )->method( 'getUser' )->will( $this->returnValue( false ) );
        $oView->editTags();
    }

    public function testEditTags_ajaxcall()
    {
        $oTagCloud = $this->getMock( 'oxStdClass', array( 'getTags' ) );
        $oTagCloud->expects( $this->once() )->method( 'getTags' )->with( $this->equalTo( 'test_artid' ) )->will( $this->returnValue( 'test_tags' ) );
        oxTestModules::addModuleObject('oxTagCloud', $oTagCloud);

        $oProduct = $this->getMock( 'oxStdClass', array( 'getId' ) );
        $oProduct->expects( $this->once() )->method( 'getId' )->will( $this->returnValue( 'test_artid' ) );

        $oConfig = $this->getMock( 'oxStdClass', array( 'getParameter' ) );
        $oConfig->expects( $this->once() )->method( 'getParameter' )->with( $this->equalTo( 'blAjax' ) )->will( $this->returnValue( true ) );

        $oUtils = $this->getMock( 'oxStdClass', array( 'setHeader', 'showMessageAndExit' ) );
        $oUtils->expects( $this->once() )->method( 'setHeader' );
        $oUtils->expects( $this->once() )->method( 'showMessageAndExit' );
        oxTestModules::addModuleObject( 'oxUtils', $oUtils );

        $oLang = $this->getMock( 'oxStdClass', array( 'translateString' ) );
        $oLang->expects( $this->once() )->method( 'translateString' );
        oxTestModules::addModuleObject( 'oxLang', $oLang );

        $oSmarty = $this->getMock( 'oxStdClass', array( 'assign', 'fetch' ) );
        $oSmarty->expects( $this->atLeastOnce() )->method( 'assign' );
        $oSmarty->expects( $this->once() )->method( 'fetch' )->with( $this->equalTo( 'page/details/inc/editTags.tpl' ), $this->equalTo( 'test_viewId' ) );

        $oUtilsView = $this->getMock( 'oxStdClass', array( 'getSmarty' ) );
        $oUtilsView->expects( $this->once() )->method( 'getSmarty' )->will( $this->returnValue( $oSmarty ) );
        oxTestModules::addModuleObject( 'oxUtilsView', $oUtilsView );

        $oView = $this->getMock( $this->getProxyClassName( 'Details' ), array( 'getConfig', 'getProduct', 'getViewConfig', 'getViewId', 'getUser' ) );
        $oView->expects( $this->once() )->method( 'getConfig' )->will( $this->returnValue( $oConfig ) );
        $oView->expects( $this->once() )->method( 'getProduct' )->will( $this->returnValue( $oProduct ) );
        $oView->expects( $this->once() )->method( 'getViewConfig' );
        $oView->expects( $this->once() )->method( 'getViewId' )->will( $this->returnValue( 'test_viewId' ) );
        $oView->expects( $this->once() )->method( 'getUser' )->will( $this->returnValue( true ) );
        $oView->editTags();

        $this->assertSame( 'test_tags', $oView->getNonPublicVar( '_aTags' ) );
        $this->assertSame( true, $oView->getNonPublicVar( '_blEditTags' ) );
    }


    public function testIsEditableTags()
    {
        $oView = $this->getMock( $this->getProxyClassName( 'Details' ), array( 'getProduct', 'getUser' ) );
        $oView->expects( $this->once() )->method( 'getProduct' )->will( $this->returnValue( true ) );
        $oView->expects( $this->once() )->method( 'getUser' )->will( $this->returnValue( true ) );

        $this->assertTrue( $oView->isEditableTags() );
        $this->assertTrue( $oView->getNonPublicVar( '_blCanEditTags' ) );
    }

    public function testGetTagSeparator()
    {
        $oConfig = $this->getMock( 'oxStdClass', array( 'getConfigParam' ) );
        $oConfig->expects( $this->once() )->method( 'getConfigParam' )->with( $this->equalTo( 'sTagSeparator' ) )->will( $this->returnValue( 'test_separator' ) );

        $oView = $this->getMock( 'Details', array( 'getConfig' ) );
        $oView->expects( $this->once() )->method( 'getConfig' )->will( $this->returnValue( $oConfig ) );

        $this->assertSame( 'test_separator', $oView->getTagSeparator() );
    }

    public function testGetRatingValue_active()
    {
        /**
        $oConfig = $this->getMock( 'oxStdClass', array( 'getConfigParam' ) );
        $oConfig->expects( $this->once() )->method( 'getConfigParam' )->with( $this->equalTo( 'blShowVariantReviews' ) )->will( $this->returnValue( true ) );
        **/

        $oProduct = $this->getMock( 'oxStdClass', array( 'getArticleRatingAverage' ) );
        $oProduct->expects( $this->once() )->method( 'getArticleRatingAverage' )->will( $this->returnValue( 123.855 ) );

        $oView = $this->getMock( $this->getProxyClassName( 'Details' ), array( 'getConfig', 'isReviewActive', 'getProduct' ) );
        //$oView->expects( $this->once() )->method( 'getConfig' )->will( $this->returnValue( $oConfig ) );
        $oView->expects( $this->once() )->method( 'isReviewActive' )->will( $this->returnValue( true ) );
        $oView->expects( $this->once() )->method( 'getProduct' )->will( $this->returnValue( $oProduct ) );

        $this->assertSame( 123.9, $oView->getRatingValue() );
        $this->assertSame( 123.9, $oView->getNonPublicVar( '_dRatingValue' ) );
    }

    public function testGetRatingValue_inactive()
    {
        $oView = $this->getMock( $this->getProxyClassName( 'Details' ), array( 'getConfig', 'isReviewActive', 'getProduct' ) );
        //$oView->expects( $this->never() )->method( 'getConfig' );
        $oView->expects( $this->once() )->method( 'isReviewActive' )->will( $this->returnValue( false ) );
        $oView->expects( $this->never() )->method( 'getProduct' );

        $this->assertSame( 0.0, $oView->getRatingValue() );
        $this->assertSame( 0.0, $oView->getNonPublicVar( '_dRatingValue' ) );
    }

    public function testIsReviewActive()
    {
        $oConfig = $this->getMock( 'oxStdClass', array( 'getConfigParam' ) );
        $oConfig->expects( $this->once() )->method( 'getConfigParam' )->with( $this->equalTo( 'bl_perfLoadReviews' ) )->will( $this->returnValue( 'test_isactive' ) );

        $oView = $this->getMock( 'Details', array( 'getConfig' ) );
        $oView->expects( $this->once() )->method( 'getConfig' )->will( $this->returnValue( $oConfig ) );

        $this->assertSame( 'test_isactive', $oView->isReviewActive() );
    }

     public function testGetRatingCount_active()
    {
        /**
        $oConfig = $this->getMock( 'oxStdClass', array( 'getConfigParam' ) );
        $oConfig->expects( $this->once() )->method( 'getConfigParam' )->with( $this->equalTo( 'blShowVariantReviews' ) )->will( $this->returnValue( true ) );
        **/

        $oProduct = $this->getMock( 'oxStdClass', array( 'getArticleRatingCount' ) );
        //$oProduct->expects( $this->once() )->method( 'getArticleRatingCount' )->will( $this->returnValue( 123 ) );
        $oProduct->oxarticles__oxratingcnt = new oxStdClass();
        $oProduct->oxarticles__oxratingcnt->value = 123;

        $oView = $this->getMock( $this->getProxyClassName( 'Details' ), array( 'getConfig', 'isReviewActive', 'getProduct' ) );
        //$oView->expects( $this->once() )->method( 'getConfig' )->will( $this->returnValue( $oConfig ) );
        $oView->expects( $this->once() )->method( 'isReviewActive' )->will( $this->returnValue( true ) );
        $oView->expects( $this->once() )->method( 'getProduct' )->will( $this->returnValue( $oProduct ) );

        $this->assertSame( 123, $oView->getRatingCount() );
        $this->assertSame( 123, $oView->getNonPublicVar( '_iRatingCnt' ) );
    }

    public function testGetRatingCount_inactive()
    {
        $oView = $this->getMock( $this->getProxyClassName( 'Details' ), array( 'getConfig', 'isReviewActive', 'getProduct' ) );
        //$oView->expects( $this->never() )->method( 'getConfig' );
        $oView->expects( $this->once() )->method( 'isReviewActive' )->will( $this->returnValue( false ) );
        $oView->expects( $this->never() )->method( 'getProduct' );

        $this->assertSame( false, $oView->getRatingCount() );
        $this->assertSame( false, $oView->getNonPublicVar( '_iRatingCnt' ) );
    }

    public function testAddme_invalidCaptcha()
    {
        $oCaptcha = $this->getMock( 'oxStdClass', array( 'pass' ) );
        $oCaptcha->expects( $this->once() )->method( 'pass' )->will( $this->returnValue( false ) );

        $oEmail = $this->getMock( 'oxStdClass', array( 'sendPricealarmNotification' ) );
        $oEmail->expects( $this->never() )->method( 'sendPricealarmNotification' );
        oxTestModules::addModuleObject( 'oxEmail', $oEmail );

        $oView = $this->getMock( $this->getProxyClassName( 'Details' ), array( 'getCaptcha' ) );
        $oView->expects( $this->once() )->method( 'getCaptcha' )->will( $this->returnValue( $oCaptcha ) );

        $oView->addme();
        $this->assertSame( 2, $oView->getNonPublicVar( '_iPriceAlarmStatus' ) );
    }

    public function testAddme_invalidEmail()
    {
        $oCaptcha = $this->getMock( 'oxStdClass', array( 'pass' ) );
        $oCaptcha->expects( $this->once() )->method( 'pass' )->will( $this->returnValue( true ) );

        $oEmail = $this->getMock( 'oxStdClass', array( 'sendPricealarmNotification' ) );
        $oEmail->expects( $this->never() )->method( 'sendPricealarmNotification' );
        oxTestModules::addModuleObject( 'oxEmail', $oEmail );

        $oUtils = $this->getMock( 'oxStdClass', array( 'isValidEmail' ) );
        $oUtils->expects( $this->once() )->method( 'isValidEmail' )->will( $this->returnValue( false ) );
        oxTestModules::addModuleObject( 'oxUtils', $oUtils );

        $oPriceAlarm = $this->getMock( 'oxStdClass', array( 'save' ) );
        $oPriceAlarm->expects( $this->never() )->method( 'save' );
        oxTestModules::addModuleObject( 'oxpricealarm', $oPriceAlarm );

        $oView = $this->getMock( $this->getProxyClassName( 'Details' ), array( 'getCaptcha' ) );
        $oView->expects( $this->once() )->method( 'getCaptcha' )->will( $this->returnValue( $oCaptcha ) );

        $aParams = array();
        $aParams['email'] = 'test_email';

        modConfig::setParameter( 'pa', $aParams );
        $oView->addme();
        $this->assertSame( 0, $oView->getNonPublicVar( '_iPriceAlarmStatus' ) );
    }

    public function testAddme_mailsent()
    {
        $oCaptcha = $this->getMock( 'oxStdClass', array( 'pass' ) );
        $oCaptcha->expects( $this->once() )->method( 'pass' )->will( $this->returnValue( true ) );

        $oEmail = $this->getMock( 'oxStdClass', array( 'sendPricealarmNotification' ) );
        $oEmail->expects( $this->once() )->method( 'sendPricealarmNotification' )->will( $this->returnValue( 123 ) );
        oxTestModules::addModuleObject( 'oxEmail', $oEmail );

        $oUtils = $this->getMock( 'oxUtils', array( 'isValidEmail' ) );
        $oUtils->expects( $this->once() )->method( 'isValidEmail' )->will( $this->returnValue( true ) );
        oxTestModules::addModuleObject( 'oxUtils', $oUtils );

        $oPriceAlarm = $this->getMock( 'oxStdClass', array( 'save' ) );
        $oPriceAlarm->expects( $this->once() )->method( 'save' );
        oxTestModules::addModuleObject( 'oxpricealarm', $oPriceAlarm );

        $oProduct = $this->getMock( 'oxStdClass', array( 'getId' ) );
        $oProduct->expects( $this->once() )->method( 'getId' )->will( $this->returnValue( 'test_artid' ) );

        $oView = $this->getMock( $this->getProxyClassName( 'Details' ), array( 'getCaptcha', 'getProduct' ) );
        $oView->expects( $this->once() )->method( 'getCaptcha' )->will( $this->returnValue( $oCaptcha ) );
        $oView->expects( $this->once() )->method( 'getProduct' )->will( $this->returnValue( $oProduct ) );

        $aParams = array();
        $aParams['email'] = 'test_email';
        modConfig::setParameter( 'pa', $aParams );

        $oView->addme();
        $this->assertSame( 123, $oView->getNonPublicVar( '_iPriceAlarmStatus' ) );
    }

    public function testGetPriceAlarmStatus()
    {
        $oView = $this->getProxyClass( 'Details' );
        $oView->setNonPublicVar( '_iPriceAlarmStatus', 514 );

        $this->assertSame( 514, $oView->getPriceAlarmStatus() );
    }

    public function testGetBidPrice()
    {
        $aParams = array();
        $aParams['price'] = '123.45';
        modConfig::setParameter( 'pa', $aParams );

        $oView = $this->getProxyClass( 'Details' );

        $this->assertSame( '123,45', $oView->getBidPrice() );
        $this->assertSame( '123,45', $oView->getNonPublicVar( '_sBidPrice' ) );
    }

    public function testIsMoreTagsVisible()
    {
        $oView = new Details();
        $this->assertTrue( $oView->isMoreTagsVisible() );
    }

    public function testRender_customArtTpl()
    {
        $oProduct = new oxStdClass();
        $oProduct->oxarticles__oxtemplate = new oxField( 'test_template.tpl' );

        $oView = $this->getMock( $this->getProxyClassName( 'Details' ), array( 'getProduct' ) );
        $oView->expects( $this->once() )->method( 'getProduct' )->will( $this->returnValue( $oProduct ) );

        $this->assertSame( 'test_template.tpl', $oView->render() );
        $this->assertSame( 'test_template.tpl', $oView->getNonPublicVar( '_sThisTemplate' ) );
    }

    public function testRender_customParamTpl()
    {
        $oProduct = new oxStdClass();
        $oProduct->oxarticles__oxtemplate = new oxField( 'test_template.tpl' );
        modConfig::setParameter( 'tpl', '../some/path/test_paramtpl.tpl' );

        $oView = $this->getMock( $this->getProxyClassName( 'Details' ), array( 'getProduct' ) );
        $oView->expects( $this->once() )->method( 'getProduct' )->will( $this->returnValue( $oProduct ) );

        //$sExpected = 'custom/test_paramtpl.tpl';
        $sExpected = 'test_paramtpl.tpl';
        $this->assertSame( $sExpected, $oView->render() );
        $this->assertSame( $sExpected, $oView->getNonPublicVar( '_sThisTemplate' ) );
    }

    public function testRender_partial_productinfo()
    {
        $oProduct = new oxStdClass();
        $oProduct->oxarticles__oxtemplate = new oxField( 'test_template.tpl' );
        modConfig::setParameter( 'tpl', '../some/path/test_paramtpl.tpl' );
        modConfig::setParameter( 'renderPartial', 'productInfo' );

        $oView = $this->getMock( $this->getProxyClassName( 'Details' ), array( 'getProduct' ) );
        $oView->expects( $this->once() )->method( 'getProduct' )->will( $this->returnValue( $oProduct ) );

        $this->assertSame( 'page/details/ajax/fullproductinfo.tpl', $oView->render() );
    }

    public function testRender_partial_detailsMain()
    {
        $oProduct = new oxStdClass();
        $oProduct->oxarticles__oxtemplate = new oxField( 'test_template.tpl' );
        modConfig::setParameter( 'tpl', '../some/path/test_paramtpl.tpl' );
        modConfig::setParameter( 'renderPartial', 'detailsMain' );

        $oView = $this->getMock( $this->getProxyClassName( 'Details' ), array( 'getProduct' ) );
        $oView->expects( $this->once() )->method( 'getProduct' )->will( $this->returnValue( $oProduct ) );

        $this->assertSame( 'page/details/ajax/productmain.tpl', $oView->render() );
    }
}
