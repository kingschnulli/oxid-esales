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
 * @version   SVN: $Id: reviewTest.php 27254 2010-04-16 08:54:51Z tomas $
 */

require_once realpath( "." ).'/unit/OxidTestCase.php';
require_once realpath( "." ).'/unit/test_config.inc.php';

class Unit_Views_reviewTest extends OxidTestCase
{
    /**
     * Initialize the fixture.
     *
     * @return null
     */
    protected function setUp()
    {
        parent::setUp();
        oxTestModules::addFunction("oxutilsserver", "getServerVar", "{ \$aArgs = func_get_args(); if ( \$aArgs[0] === 'HTTP_HOST' ) { return '".oxConfig::getInstance()->getShopUrl()."'; } elseif ( \$aArgs[0] === 'SCRIPT_NAME' ) { return ''; } else { return \$_SERVER[\$aArgs[0]]; } }");
        $myDB = oxDb::getDB();
        $sShopId = oxConfig::getInstance()->getShopId();
        // adding article to recommendlist
        $sQ = 'insert into oxrecommlists ( oxid, oxuserid, oxtitle, oxdesc, oxshopid ) values ( "testlist", "oxdefaultadmin", "oxtest", "oxtest", "'.$sShopId.'" ) ';
        $myDB->Execute( $sQ );
        $sQ = 'insert into oxobject2list ( oxid, oxobjectid, oxlistid, oxdesc ) values ( "testlist", "2000", "testlist", "test" ) ';
        $myDB->Execute( $sQ );
    }

    /**
     * Tear down the fixture.
     *
     * @return null
     */
    protected function tearDown()
    {
        $myDB = oxDb::getDB();
        $sDelete = 'delete from oxrecommlists where oxid like "test%" ';
        $myDB->execute( $sDelete );

        $sDelete = 'delete from oxobject2list where oxlistid like "test%" ';
        $myDB->execute( $sDelete );

        $sDelete = 'delete from oxreviews where oxobjectid like "test%" ';
        $myDB->execute( $sDelete );

        $sDelete = 'delete from oxratings where oxobjectid like "test%" ';
        $myDB->execute( $sDelete );

        $this->cleanUpTable( 'oxreviews' );

        parent::tearDown();
    }

    public function testRender()
    {
        $oProduct = new oxArticle();
        $oProduct->load( "1126" );

        $oProd1 = new oxArticle();
        $oProd2 = new oxArticle();

        $oProducts = new oxArticleList();
        $oProducts->offsetSet( 0, $oProd1 );
        $oProducts->offsetSet( 1, $oProd2 );

        $oRecommList = $this->getMock( "oxRecommList", array( "getArtCount" ));
        $oRecommList->expects( $this->atLeastOnce() )->method( 'getArtCount')->will( $this->returnValue( 10 ) );

        $oReview = $this->getMock( "review", array( "_checkDirectReview", "getReviewUserId", "getReviews",
                                                    "getProduct", "getCrossSelling",
                                                    "getSimilarProducts", "getRecommList",
                                                    "getActiveRecommList", "getActiveRecommItems",
                                                    "getPageNavigation", "canRate", "getReviewSendStatus" ) );

        $oReview->expects( $this->once() )->method( '_checkDirectReview')->will( $this->returnValue( true ) );
        $oReview->expects( $this->once() )->method( 'getReviews');
        $oReview->expects( $this->once() )->method( 'getReviewUserId');
        $oReview->expects( $this->atLEastOnce() )->method( 'getProduct')->will( $this->returnValue( $oProduct ) );
        $oReview->expects( $this->once() )->method( 'getCrossSelling');
        $oReview->expects( $this->once() )->method( 'getSimilarProducts');
        $oReview->expects( $this->once() )->method( 'getRecommList');
        $oReview->expects( $this->once() )->method( 'getActiveRecommList')->will( $this->returnValue( $oRecommList ) );
        $oReview->expects( $this->once() )->method( 'getActiveRecommItems')->will( $this->returnValue( $oProducts ) );
        $oReview->expects( $this->once() )->method( 'getPageNavigation');
        $oReview->expects( $this->once() )->method( 'canRate');
        $oReview->expects( $this->once() )->method( 'getReviewSendStatus');
        $oReview->render();
    }

    public function testRenderReviewOff()
    {
        $oProduct = new oxArticle();
        $oProduct->load( "1126" );

        $oProd1 = new oxArticle();
        $oProd2 = new oxArticle();

        $oReview = $this->getMock( "review", array( "_checkDirectReview", "getReviewUserId", "getReviews",
                                                    "getProduct", "getCrossSelling",
                                                    "getSimilarProducts", "getRecommList",
                                                    "getActiveRecommList", "getActiveRecommItems",
                                                    "getPageNavigation", "canRate", "getReviewSendStatus" ) );

        $oReview->expects( $this->once() )->method( '_checkDirectReview')->will( $this->returnValue( false ) );
        $oReview->expects( $this->once() )->method( 'getReviewUserId');
        $oReview->expects( $this->never() )->method( 'getReviews');
        $oReview->expects( $this->atLEastOnce() )->method( 'getProduct')->will( $this->returnValue( $oProduct ) );
        $oReview->expects( $this->never() )->method( 'getCrossSelling');
        $oReview->expects( $this->never() )->method( 'getSimilarProducts');
        $oReview->expects( $this->never() )->method( 'getRecommList');
        $oReview->expects( $this->never() )->method( 'getActiveRecommList');
        $oReview->expects( $this->never() )->method( 'getActiveRecommItems');
        $oReview->expects( $this->never() )->method( 'getPageNavigation');
        $oReview->expects( $this->never() )->method( 'canRate');
        $oReview->expects( $this->never() )->method( 'getReviewSendStatus');
        $oReview->render();
    }

    public function testGetActiveRecommItemsNoRecommList()
    {
        $oReview = $this->getMock( "review", array( "getActiveRecommList", ) );
        $this->assertFalse( $oReview->getActiveRecommItems() );
    }

    public function testGetActiveRecommItems()
    {
        $oProd1 = new oxArticle();
        $oProd2 = new oxArticle();

        $oProd3 = new oxArticle();
        $oProd3->text = 'testArtDescription';
        $oProd4 = new oxArticle();
        $oProd4->text = 'testArtDescription';

        $oProducts = new oxArticleList();
        $oProducts->offsetSet( 0, $oProd1 );
        $oProducts->offsetSet( 1, $oProd2 );

        $oTestProducts = new oxArticleList();
        $oTestProducts->offsetSet( 0, $oProd3 );
        $oTestProducts->offsetSet( 1, $oProd4 );

        $oRecommList = $this->getMock( "oxRecommList", array( "getArticles", "getArtDescription" ));
        $oRecommList->expects( $this->atLeastOnce() )->method( 'getArticles')->will( $this->returnValue( $oProducts ) );
        $oRecommList->expects( $this->atLeastOnce() )->method( 'getArtDescription')->will( $this->returnValue( 'testArtDescription' ) );

        $oReview = $this->getMock( "review", array( "getActiveRecommList", ) );
        $oReview->expects( $this->atLeastOnce() )->method( 'getActiveRecommList')->will( $this->returnValue( $oRecommList ) );

        $this->assertEquals( 2, $oReview->getActiveRecommItems()->count() );
    }

    public function testGetReviewSendStatus()
    {
        $oReview = new review();
        $this->assertNull( $oReview->getReviewSendStatus() );
    }

    public function testGetActiveType()
    {
        $oReview = $this->getMock( 'review', array( 'getProduct' ) );
        $oReview->expects( $this->once() )->method( 'getProduct')->will( $this->returnValue( true ) );

        $this->assertEquals( 'oxarticle', $oReview->UNITgetActiveType() );

        $oReview = $this->getMock( 'review', array( 'getProduct', 'getActiveRecommList' ) );
        $oReview->expects( $this->once() )->method( 'getProduct')->will( $this->returnValue( false ) );
        $oReview->expects( $this->once() )->method( 'getActiveRecommList')->will( $this->returnValue( true ) );

        $this->assertEquals( 'oxrecommlist', $oReview->UNITgetActiveType() );
    }

    public function testAllowDirectReview()
    {
        $oReview = new Review();
        $this->assertTrue( $oReview->UNITallowDirectReview( "oxdefaultadmin" ) );
    }

    public function testCheckDirectReview()
    {
        $sReviewUserId = 'testReviewUserId';

        $oUser = new oxUser();
        $oUser->setId( $sReviewUserId );

        $oReview = $this->getMock( 'review', array( 'getUser' ) );
        $oReview->expects( $this->once() )->method( 'getUser')->will( $this->returnValue( $oUser ) );

        $this->assertTrue( $oReview->UNITcheckDirectReview( $sReviewUserId )  );
    }

    public function testCheckDirectReviewNoSessionUser()
    {
        $oReview = $this->getMock( 'review', array( 'getUser', '_allowDirectReview' ) );
        $oReview->expects( $this->once() )->method( 'getUser')->will( $this->returnValue( false ) );
        $oReview->expects( $this->once() )->method( '_allowDirectReview')->will( $this->returnValue( true ) );

        $this->assertTrue( $oReview->UNITcheckDirectReview( $sReviewUserId )  );
    }

    public function testGetViewId()
    {
        $oReview = new review();
        $oUbase = new oxUBase;

        $this->assertEquals( $oUbase->getViewId(), $oReview->getViewId() );
    }

    public function testInit()
    {
        oxTestModules::addFunction("oxutilsserver", "getServerVar", "{ \$aArgs = func_get_args(); if ( \$aArgs[0] === 'HTTP_HOST' ) { return '".oxConfig::getInstance()->getShopUrl()."'; } elseif ( \$aArgs[0] === 'SCRIPT_NAME' ) { return ''; } else { return \$_SERVER[\$aArgs[0]]; } }");
        modConfig::setParameter( 'recommid', 'testRecommId' );
        modConfig::setParameter( 'anid', '1126' );

        $oRecommList = new oxRecommList();
        $oRecommList->setId( 'testRecommId' );

        $oReview = $this->getMock( "review", array( "getActiveRecommList" ) );
        $oReview->expects( $this->any() )->method( 'getActiveRecommList')->will( $this->returnValue( $oRecommList ) );
        $oUbase = new oxUBase;

        $this->assertEquals( $oUbase->init(), $oReview->init() );
    }

    public function testInitNoRecommList()
    {
        modConfig::setParameter( 'recommid', 'testRecommId' );
        oxTestModules::addFunction( "oxUtils", "redirect", "{ throw new Exception( 'testInitNoRecommListException' ); }" );

        $oReview = $this->getMock( "review", array( "getActiveRecommList" ) );
        $oReview->expects( $this->once() )->method( 'getActiveRecommList')->will( $this->returnValue( false ) );

        try {
            $oReview->init();
        } catch ( Exception $oExcp ) {
            $this->assertEquals( 'testInitNoRecommListException', $oExcp->getMessage() );
            return;
        }
        $this->fail( "error in testInitNoRecommList" );
    }

    public function testSaveReview()
    {
        modConfig::setParameter( 'rvw_txt', 'review test' );
        modConfig::setParameter( 'artrating', '4' );
        modConfig::setParameter( 'anid', 'test' );

        $oProduct = $this->getMock( 'oxarticle', array( 'getId', 'addToRatingAverage' ) );
        $oProduct->expects( $this->any() )->method( 'getId')->will( $this->returnValue( 'test' ) );
        $oProduct->expects( $this->once() )->method( 'addToRatingAverage');

        $oReview = $this->getMock( 'review', array( 'getReviewUserId', '_getActiveObject', 'canAcceptFormData', "_checkDirectReview", "_getActiveType" ) );
        $oReview->expects( $this->once() )->method( 'getReviewUserId')->will( $this->returnValue( "oxdefaultadmin" ) );
        $oReview->expects( $this->once() )->method( 'canAcceptFormData')->will( $this->returnValue( true ) );
        $oReview->expects( $this->once() )->method( '_checkDirectReview')->will( $this->returnValue( true ) );
        $oReview->expects( $this->once() )->method( '_getActiveObject')->will( $this->returnValue( $oProduct ) );
        $oReview->expects( $this->once() )->method( '_getActiveType')->will( $this->returnValue( "oxarticle" ) );
        $oReview->saveReview();

        $this->assertEquals( "test", oxDb::getDB()->getOne('select oxobjectid from oxreviews where oxobjectid = "test"') );
        $this->assertEquals( "test", oxDb::getDB()->getOne('select oxobjectid from oxratings where oxobjectid = "test"') );
    }

    public function testSaveReviewIfUserNotSet()
    {
        $oReview = $this->getMock( 'review', array( 'getReviewUserId', '_getActiveObject', 'canAcceptFormData', "_checkDirectReview", "_getActiveType" ) );
        $oReview->expects( $this->once() )->method( 'getReviewUserId')->will( $this->returnValue( false ) );
        $oReview->expects( $this->never() )->method( 'canAcceptFormData');
        $oReview->expects( $this->never() )->method( '_checkDirectReview');
        $oReview->expects( $this->never() )->method( '_getActiveObject');
        $oReview->expects( $this->never() )->method( '_getActiveType');
        $oReview->saveReview();

        $this->assertFalse( oxDb::getDB()->getOne('select oxobjectid from oxreviews where oxobjectid = "test"') );
        $this->assertFalse( oxDb::getDB()->getOne('select oxobjectid from oxratings where oxobjectid = "test"') );
    }

    public function testSaveReviewIfOnlyReviewIsSet()
    {
        modConfig::setParameter( 'rvw_txt', 'review test' );
        modConfig::setParameter( 'artrating', null );
        modConfig::setParameter( 'anid', 'test' );

        $oProduct = $this->getMock( 'oxarticle', array( 'getId', 'addToRatingAverage' ) );
        $oProduct->expects( $this->any() )->method( 'getId')->will( $this->returnValue( 'test' ) );
        $oProduct->expects( $this->never() )->method( 'addToRatingAverage');

        $oReview = $this->getMock( 'review', array( 'getReviewUserId', '_getActiveObject', 'canAcceptFormData', "_checkDirectReview", "_getActiveType" ) );
        $oReview->expects( $this->once() )->method( 'getReviewUserId')->will( $this->returnValue( "oxdefaultadmin" ) );
        $oReview->expects( $this->once() )->method( 'canAcceptFormData')->will( $this->returnValue( true ) );
        $oReview->expects( $this->once() )->method( '_checkDirectReview')->will( $this->returnValue( true ) );
        $oReview->expects( $this->once() )->method( '_getActiveObject')->will( $this->returnValue( $oProduct ) );
        $oReview->expects( $this->once() )->method( '_getActiveType')->will( $this->returnValue( "oxarticle" ) );
        $oReview->saveReview();

        $this->assertEquals( "test", oxDb::getDB()->getOne('select oxobjectid from oxreviews where oxobjectid = "test"') );
        $this->assertFalse( oxDb::getDB()->getOne('select 1 from oxratings where oxobjectid = "test"') );
    }

    public function testSaveReviewIfWrongRating()
    {
        modConfig::setParameter( 'rvw_txt', 'review test' );
        modConfig::setParameter( 'artrating', 6 );
        modConfig::setParameter( 'anid', 'test' );

        $oProduct = $this->getMock( 'oxarticle', array( 'getId', 'addToRatingAverage' ) );
        $oProduct->expects( $this->any() )->method( 'getId')->will( $this->returnValue( 'test' ) );
        $oProduct->expects( $this->never() )->method( 'addToRatingAverage');

        $oReview = $this->getMock( 'review', array( 'getReviewUserId', '_getActiveObject', 'canAcceptFormData', "_checkDirectReview", "_getActiveType" ) );
        $oReview->expects( $this->once() )->method( 'getReviewUserId')->will( $this->returnValue( "oxdefaultadmin" ) );
        $oReview->expects( $this->once() )->method( 'canAcceptFormData')->will( $this->returnValue( true ) );
        $oReview->expects( $this->once() )->method( '_checkDirectReview')->will( $this->returnValue( true ) );
        $oReview->expects( $this->once() )->method( '_getActiveObject')->will( $this->returnValue( $oProduct ) );
        $oReview->expects( $this->once() )->method( '_getActiveType')->will( $this->returnValue( "oxarticle" ) );
        $oReview->saveReview();

        $this->assertEquals( "test", oxDb::getDB()->getOne('select oxobjectid from oxreviews where oxobjectid = "test"') );
        $this->assertFalse( oxDb::getDB()->getOne('select oxobjectid from oxratings where oxobjectid = "test"') );
    }

    public function testSaveReviewIfOnlyRatingIsSet()
    {
        modConfig::setParameter( 'rvw_txt', null );
        modConfig::setParameter( 'artrating', '4' );
        modConfig::setParameter( 'anid', 'test' );

        $oProduct = $this->getMock( 'oxarticle', array( 'getId', 'addToRatingAverage' ) );
        $oProduct->expects( $this->any() )->method( 'getId')->will( $this->returnValue( 'test' ) );
        $oProduct->expects( $this->once() )->method( 'addToRatingAverage');

        $oReview = $this->getMock( 'review', array( 'getReviewUserId', '_getActiveObject', 'canAcceptFormData', "_checkDirectReview", "_getActiveType" ) );
        $oReview->expects( $this->once() )->method( 'getReviewUserId')->will( $this->returnValue( "oxdefaultadmin" ) );
        $oReview->expects( $this->once() )->method( 'canAcceptFormData')->will( $this->returnValue( true ) );
        $oReview->expects( $this->once() )->method( '_checkDirectReview')->will( $this->returnValue( true ) );
        $oReview->expects( $this->once() )->method( '_getActiveObject')->will( $this->returnValue( $oProduct ) );
        $oReview->expects( $this->once() )->method( '_getActiveType')->will( $this->returnValue( "oxarticle" ) );
        $oReview->saveReview();

        $this->assertFalse( oxDb::getDB()->getOne('select oxobjectid from oxreviews where oxobjectid = "test"') );
        $this->assertEquals( "test", oxDb::getDB()->getOne('select oxobjectid from oxratings where oxobjectid = "test"') );
    }

    public function testGetDynUrlParams()
    {
        modConfig::setParameter( 'cnid', 'testcnid' );
        modConfig::setParameter( 'anid', 'testanid' );
        modConfig::setParameter( 'listtype', 'testlisttype' );
        modConfig::setParameter( 'recommid', 'testrecommid' );

        $oUbase = new oxUBase();
        $sDynParams  = $oUbase->getDynUrlParams();
        $sDynParams .="&amp;cnid=testcnid&amp;anid=testanid&amp;listtype=testlisttype&amp;recommid=testrecommid";

        $oReview = new review();
        $this->assertEquals( $sDynParams, $oReview->getDynUrlParams() );
    }

    /**
     * Testing how assign loads user info
     */
    public function testGetReviewUserId()
    {
        modConfig::setParameter( 'reviewuserid', 'usertest' );
        $oReview = new review();

        $this->assertNotEquals( 'usertest', $oReview->getReviewUserId() );
    }

    public function testGetReviewUserIdIfNotSetInConfig()
    {
        modConfig::setParameter( 'reviewuserid', null );
        $oUser = new oxUser();
        $oUser->load('oxdefaultadmin');
        $oReview = new review();
        $oReview->setUser( $oUser );

        $this->assertEquals( 'oxdefaultadmin', $oReview->getReviewUserId() );
    }

    public function testGetReviewUserIdIfSetInEmail()
    {
        $sReviewUser = oxDb::getDB()->getOne('select md5(concat("oxid", oxpassword, oxusername )) from oxuser where oxid = "oxdefaultadmin"');
        modConfig::setParameter( 'reviewuser', $sReviewUser );
        modConfig::setParameter( 'reviewuserid', 'usertest' );
        $oReview = new review();

        $this->assertEquals( 'oxdefaultadmin', $oReview->getReviewUserId() );
    }

    public function testCanRateForRecomm()
    {
        $oRecommtList = new oxRecommList();
        $oRecommtList->load('testlist');

        $oReview = $this->getMock( "review", array( "_getActiveObject", "getReviewUserId", "_getActiveType" ) );
        $oReview->expects( $this->any() )->method( '_getActiveObject' )->will($this->returnValue( $oRecommtList ) );
        $oReview->expects( $this->any() )->method( 'getReviewUserId' )->will($this->returnValue( 'oxdefaultadmin' ) );
        $oReview->expects( $this->any() )->method( '_getActiveType' )->will($this->returnValue( 'oxarticle' ) );

        $this->assertTrue( $oReview->canRate() );
    }

    public function testCanRateForArticle()
    {
        modSession::getInstance()->setVar( 'reviewuserid', 'oxdefaultadmin' );

        $oArticle = new oxArticle();
        $oArticle->load('2000');

        $oReview = $this->getMock( "review", array( "_getActiveObject", "getReviewUserId", "_getActiveType" ) );
        $oReview->expects( $this->any() )->method( '_getActiveObject' )->will($this->returnValue( $oArticle ) );
        $oReview->expects( $this->any() )->method( 'getReviewUserId' )->will($this->returnValue( 'oxdefaultadmin' ) );
        $oReview->expects( $this->any() )->method( '_getActiveType' )->will($this->returnValue( 'oxarticle' ) );


        $this->assertTrue( $oReview->canRate() );
    }

    public function testGetReviewsForRecomm()
    {
        $oRecommtList = $this->getMock( "oxRecommList", array( "getReviews" ) );
        $oRecommtList->expects( $this->any() )->method( 'getReviews' )->will($this->returnValue( "testReviews" ) );

        $oReview = $this->getMock( "review", array( "_getActiveObject" ) );
        $oReview->expects( $this->any() )->method( '_getActiveObject' )->will($this->returnValue( $oRecommtList ) );

        $this->assertEquals( "testReviews", $oReview->getReviews() );
    }

    public function testGetReviewsForArticle()
    {
        oxTestModules::addFunction('oxreview', 'loadList', '{$o=new oxlist();$o[0]="asd";$o->args=$aA;return $o;}');
        $oReview = $this->getProxyClass( "review" );
        $oArticle = new oxArticle();
        $oArticle->load('2000');
        $oReview->setNonPublicVar( "_oProduct", $oArticle );
        $oResult = $oReview->getReviews();
        $this->assertEquals( "oxarticle", $oResult->args[0]);
        $this->assertEquals( "2000", current($oResult->args[1]));
    }

    public function testGetProduct()
    {
        modConfig::setParameter( 'anid', '2000' );
        $oReview = new review();

        $this->assertEquals( '2000', $oReview->getProduct()->getId() );
    }

    public function testGetActiveObjectIfProduct()
    {
        $oReview = $this->getProxyClass( "review" );
        $oArticle = new oxArticle();
        $oArticle->load('2000');
        $oReview->setNonPublicVar( "_oProduct", $oArticle );

        $this->assertEquals( '2000', $oReview->UNITgetActiveObject()->getId() );
    }

    public function testGetActiveObjectIfRecommList()
    {
        $oRecommtList = new oxRecommList();
        $oRecommtList->setId('testid');

        $oReview = $this->getMock( "review", array( "getProduct", "getActiveRecommList") );
        $oReview->expects( $this->any() )->method( 'getActiveRecommList' )->will($this->returnValue( $oRecommtList ) );

        $this->assertEquals( 'testid', $oReview->UNITgetActiveObject()->getId() );
    }

    public function testGetCrossSelling()
    {
        $oReview = $this->getProxyClass( "review" );
        $oArticle = oxNew("oxarticle");
        $oArticle->load("1849");
        $oReview->setNonPublicVar( "_oProduct", $oArticle );
        $oList = $oReview->getCrossSelling();
        $this->assertTrue($oList instanceof oxList);
        $iCount = 3;
            $iCount = 2;
        $this->assertEquals( $iCount, $oList->count() );
    }

    public function testGetSimilarProducts()
    {
        $oReview = $this->getProxyClass( "review" );
        $oArticle = oxNew("oxarticle");
        $oArticle->load("2000");
        $oReview->setNonPublicVar( "_oProduct", $oArticle );
        $oList = $oReview->getSimilarProducts();
        $iCount = 4;
            $iCount = 5;
        $this->assertEquals( $iCount, count($oList) );
    }

    public function testGetRecommList()
    {
        modConfig::setParameter( 'recommid', 'testlist' );
        $oRevew = $this->getProxyClass( "review" );
        $oArticle = oxNew("oxarticle");
        $oArticle->load('2000');
        $oRevew->setNonPublicVar( "_oProduct", $oArticle );
        $aLists = $oRevew->getRecommList();
        $this->assertEquals( 1, $aLists->count() );
        $this->assertEquals( 'testlist', $aLists['testlist']->getId() );
        $this->assertTrue( in_array( $aLists['testlist']->getFirstArticle()->getId(), array('2000') ) );
    }

    public function testGetAdditionalParams()
    {
        modConfig::setParameter( 'searchparam', 'testsearchparam' );
        modConfig::setParameter( 'recommid', 'testlist' );
        modConfig::setParameter( 'reviewuserid', 'oxdefaultadmin' );

        $oUbase = new oxUBase();
        $sParams = $oUbase->getAdditionalParams();

        $oRecommList = new oxRecommList();
        $oRecommList->setId( "testlist" );

        $oReview = $this->getMock( 'review', array( 'getActiveRecommList' ));
        $oReview->expects( $this->any() )->method( 'getActiveRecommList' )->will($this->returnValue( $oRecommList ) );
        $this->assertEquals( $sParams.'&amp;recommid=testlist', $oReview->getAdditionalParams() );
    }

    public function testGetPageNavigation()
    {
        modConfig::setParameter( 'recommid', 'testlist' );
        modConfig::setParameter( 'reviewuserid', 'oxdefaultadmin' );
        $oReview = $this->getMock( 'review', array( 'generatePageNavigation' ));
        $oReview->expects( $this->any() )->method( 'generatePageNavigation')->will($this->returnValue( "aaa" ) );
        $oReview->getActiveRecommList();
        $this->assertEquals( 'aaa', $oReview->getPageNavigation() );
    }

    /**
     * Test oxViewConfig::getShowListmania() affection
     *
     * @return null
     */
    public function testGetActiveRecommListIfOff()
    {
        $oCfg = $this->getMock( "stdClass", array( "getShowListmania" ) );
        $oCfg->expects( $this->once() )->method( 'getShowListmania')->will($this->returnValue( false ) );

        $oRecomm = $this->getMock( "review", array( "getViewConfig" ) );
        $oRecomm->expects( $this->once() )->method( 'getViewConfig')->will($this->returnValue( $oCfg ) );

        $this->assertSame(false, $oRecomm->getActiveRecommList());
    }
}
