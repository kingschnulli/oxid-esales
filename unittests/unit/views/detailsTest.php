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
 * @version   SVN: $Id: detailsTest.php 32617 2011-01-20 15:23:58Z sarunas $
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

        $oProduct = $this->getMock( 'oxarticle', array( 'getVariants', 'getId' ) );
        $oProduct->expects( $this->once() )->method( 'getVariants')->will( $this->returnValue( new oxlist() ) );
        $oProduct->expects( $this->atLeastOnce() )->method( 'getId')->will( $this->returnValue( 'testArtId' ) );

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

        $oProductParent = $this->getMock( 'oxarticle', array( 'getVariants', 'getSelectLists' ) );;
        $oProductParent->expects( $this->once() )->method( 'getVariants')->will( $this->returnValue( $oVarList ) );
        $oProductParent->expects( $this->once() )->method( 'getSelectLists');
        $oProductParent->blNotBuyableParent = true;

        $oDetailsView = $this->getMock( 'details', array( 'getProduct', '_getParentProduct', 'getLinkType' ) );
        $oDetailsView->expects( $this->once() )->method( 'getProduct')->will( $this->returnValue( $oProduct ) );
        $oDetailsView->expects( $this->once() )->method( '_getParentProduct')->will( $this->returnValue( $oProductParent ) );
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
     * Test get tags.
     *
     * @return null
     */
    public function testGetTags()
    {
        $oArt = new oxarticle();
        $oArt->load('2000');
        $oDetails = $this->getProxyClass( 'details' );
        $oDetails->setNonPublicVar( "_oProduct", $oArt );
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
        $oDetails = $this->getProxyClass( 'details' );
        $oDetails->setNonPublicVar( "_oProduct", $oArt );
        $oDetails->editTags();
        $this->assertTrue($oDetails->getEditTags());
    }

    /**
     * Test get tag cloud after adding new tags.
     *
     * @return null
     */
    public function testGetTagCloudAfterAddTags()
    {
        oxTestModules::addFunction('oxSeoEncoderTag', '_saveToDb', '{return null;}');
        oxTestModules::addFunction("oxutilsserver", "getServerVar", "{ \$aArgs = func_get_args(); if ( \$aArgs[0] === 'HTTP_HOST' ) { return '".oxConfig::getInstance()->getShopUrl()."'; } elseif ( \$aArgs[0] === 'SCRIPT_NAME' ) { return ''; } else { return \$_SERVER[\$aArgs[0]]; } }");
        oxTestModules::addFunction( "oxutils", "seoIsActive", "{return true;}" );
        modConfig::setParameter( 'newTags', "newTag" );
        $oArt = new oxarticle();
        $oArt->load('2000');
        $oArt->setId('_testArt');
        $oArt->save();
        $oDetails = $this->getProxyClass( 'details' );
        $oDetails->setNonPublicVar( "_oProduct", $oArt );
        $oDetails->addTags();
        $sTag = $oDetails->getTagCloud();
        $this->assertTrue(strpos($sTag, "tag/newtag/'>newtag</a>") > 0);
    }

    /**
     * Test get tag cloud.
     *
     * @return null
     */
    public function testGetTagCloud()
    {
        oxTestModules::addFunction('oxSeoEncoderTag', '_saveToDb', '{return null;}');
        oxTestModules::addFunction("oxutilsserver", "getServerVar", "{ \$aArgs = func_get_args(); if ( \$aArgs[0] === 'HTTP_HOST' ) { return '".oxConfig::getInstance()->getShopUrl()."'; } elseif ( \$aArgs[0] === 'SCRIPT_NAME' ) { return ''; } else { return \$_SERVER[\$aArgs[0]]; } }");
        oxTestModules::addFunction( "oxutils", "seoIsActive", "{return true;}" );
        $oArt = new oxarticle();
        $oArt->load('2000');
        $oDetails = $this->getProxyClass( 'details' );
        $oDetails->setNonPublicVar( "_oProduct", $oArt );
        $sTag = $oDetails->getTagCloud();
        $this->assertTrue(strpos($sTag, "tag/wanduhr/'>wanduhr</a>") > 0);
        $this->assertTrue(strpos($sTag, "tag/coolen/'>coolen</a>") > 0);
    }

    /**
     * Test get login form from anchor.
     *
     * @return null
     */
    public function testGetLoginFormAnchor()
    {
        modConfig::setParameter( 'anchor', 'review' );
        $oDetails = $this->getProxyClass( 'details' );
        $oDetails->showLogin();
        $this->assertEquals('review', $oDetails->getLoginFormAnchor());
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
        $this->assertEquals($oExpect, $aRet);

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

        $this->assertEquals( $oProduct->oxdetaillink, $oDetails->getParentUrl() );
    }

    /**
     * Test get picture galery.
     *
     * @return null
     */
    public function testGetPictureGallery()
    {
            $sArtID = "1126";

        $oArticle = new oxarticle();
        $oArticle->load($sArtID);
        $oDetails = $this->getProxyClass( 'details' );
        $oDetails->setNonPublicVar( "_oProduct", $oArticle );
        $aPicGallery = $oDetails->getPictureGallery();
        $sActPic =  oxConfig::getInstance()->getPictureUrl(null).$oArticle->oxarticles__oxpic1->value;
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

        // TODO: fix spelling error in getter
        $this->assertEquals( "aaa", $oDetails->getAlsoBoughtThiesProducts() );
        $this->assertEquals( "aaa", $oDetails->getAlsoBoughtTheseProducts() );
    }

    /**
     * Test is product added to price allarm.
     *
     * @return null
     */
    public function testIsPriceAlarm()
    {
        $oArticle = oxNew("oxarticle");
        $oArticle->load("1849");
        $oArticle->oxarticles__oxblfixedprice = new oxField(1, oxField::T_RAW);
        $oDetails = $this->getProxyClass( 'details' );
        $oDetails->setNonPublicVar( "_oProduct", $oArticle );

        $this->assertEquals( 0, $oDetails->isPriceAlarm() );
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
        $sTestKeywords = $oView->UNITprepareMetaKeyword( $sKeywords, true ) . ", testValue1 testValue2 testValue3";

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

        $aViewData = $oSubj->getNonPublicVar('_aViewData');
        $sViewMetaKeywords = $aViewData['meta_keywords'];
        $this->assertTrue(strlen($sViewMetaKeywords) > 0);
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

}
