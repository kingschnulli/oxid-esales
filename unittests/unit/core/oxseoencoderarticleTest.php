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
 * @version   SVN: $Id: oxseoencoderarticleTest.php 26841 2010-03-25 13:58:15Z arvydas $
 */

require_once realpath( "." ).'/unit/OxidTestCase.php';
require_once realpath( "." ).'/unit/test_config.inc.php';

class modSeoEncoderArticle extends oxSeoEncoderArticle
{
    public function setProhibitedID($aProhibitedID)
    {
        $this->_aProhibitedID = $aProhibitedID;
    }
    public function getSeparator()
    {
        return $this->_sSeparator;
    }
    public function getSafePrefix()
    {
        return $this->_getSafePrefix();
    }
    public function setAltPrefix($sOXID)
    {
        $this->_sAltPrefix = $sOXID;
    }
    public function p_prepareTitle($a, $b=false)
    {
        return $this->_prepareTitle($a, $b);
    }
    /**
     * Only used for convenience in UNIT tests by doing so we avoid
     * writing extended classes for testing protected or private methods
     */
    public function __call( $method, $args)
    {
        if ( defined( 'OXID_PHP_UNIT' ) ) {
            if ( substr( $method, 0, 4) == "UNIT") {
                $method = str_replace( "UNIT", "_", $method);
            }
            if ( method_exists( $this, $method)) {
                return call_user_func_array( array( & $this, $method), $args );
            }
        }

        throw new Exception( "Function '$method' does not exist or is not accessable!".PHP_EOL);
    }
}

/**
 * Testing oxseoencoder class
 */
class Unit_Core_oxSeoEncoderArticleTest extends OxidTestCase
{
    /**
     * Initialize the fixture.
     *
     * @return null
     */
    protected function setUp()
    {
        parent::setUp();
        oxSeoEncoder::getInstance()->setPrefix('oxid');
        oxSeoEncoder::getInstance()->setSeparator();
        oxTestModules::addFunction("oxseoencodercategory", "resetInst", '{oxSeoEncoderCategory::$_instance = null;}');
        oxNew('oxseoencodercategory')->resetInst();
        oxTestModules::cleanUp();

        oxTestModules::addFunction("oxutils", "seoIsActive", "{return true;}");

        //echo $this->getName()."\n";
    }

    /**
     * Tear down the fixture.
     *
     * @return null
     */
    protected function tearDown()
    {
        modDB::getInstance()->cleanup();
        // deleting seo entries
        oxDb::getDb()->execute( 'delete from oxseo where oxtype != "static"' );
        oxDb::getDb()->execute( 'delete from oxseohistory' );

        $this->cleanUpTable( 'oxcategories' );
        $this->cleanUpTable( 'oxrecommlists' );

        oxDb::getDb()->execute( 'delete from oxarticles where oxid = "testart"' );
        oxDb::getDb()->execute( 'delete from oxobject2category where oxobjectid = "testart"' );

        oxConfig::getInstance()->setActiveView( null );

        parent::tearDown();
    }

    public function __SaveToDbCreatesGoodMd5Callback($sSQL)
    {
        $this->aSQL[] = $sSQL;
        if ($this->aRET && isset($this->aRET[count($this->aSQL)-1])) {
            return $this->aRET[count($this->aSQL)-1];
        }
    }

    /**
     * #0001472: / in article title
     *
     * @return null
     */
    public function testForBugEntry1472()
    {
        $oArticle = new oxArticle();
        $oArticle->setId( "testArticleId" );
        $oArticle->oxarticles__oxtitle = new oxField( "'DIN lang 1/3 A4 / A6' ? 'EIN Fach' ? '1/3 A4 Prospektst�nder BIO'", oxField::T_RAW );

        $sUrl = oxConfig::getInstance()->getConfigParam( "sShopURL" )."DIN-lang-1-3-A4-A6-EIN-Fach-1-3-A4-Prospektstaender-BIO.html";
        $this->assertEquals( $sUrl, $oArticle->getLink() );
    }

    public function testGetArticleUrlRecommType()
    {
        $oEncoder = $this->getMock( "oxSeoEncoderArticle", array( "_getArticleVendorUri", "_getArticleManufacturerUri",
                                                                  "_getArticleTagUri", "_getArticleRecommUri",
                                                                  "_getArticleUri", "_getArticleMainUri", "_getFullUrl" ) );

        $oEncoder->expects( $this->never() )->method( '_getArticleVendorUri' );
        $oEncoder->expects( $this->never() )->method( '_getArticleManufacturerUri' );
        $oEncoder->expects( $this->never() )->method( '_getArticleTagUri' );
        $oEncoder->expects( $this->never() )->method( '_getArticleUri' );
        $oEncoder->expects( $this->never() )->method( '_getArticleMainUri' );

        $oEncoder->expects( $this->once() )->method( '_getArticleRecommUri' )->will( $this->returnValue( "testRecommUrl" ) );
        $oEncoder->expects( $this->once() )->method( '_getFullUrl' )->will( $this->returnValue( "testFullRecommUrl" ) );

        $this->assertEquals( "testFullRecommUrl", $oEncoder->getArticleUrl( new oxArticle, 0, OXARTICLE_LINKTYPE_RECOMM ));
    }

    /**
     * Testing if recomm list is taken from view
     *
     * @return
     */
    public function testGetRecomm()
    {
        $oView = $this->getMock( "oxUBase", array( "getActiveRecommList" ) );
        $oView->expects( $this->once() )->method( 'getActiveRecommList' )->will( $this->returnValue( "testRecommList" ) );

        oxConfig::getInstance()->setActiveView( $oView );

        $oEncoder = new oxSeoEncoderArticle();
        $this->assertEquals( "testRecommList", $oEncoder->UNITgetRecomm( new oxarticle, 0 ) );
    }

    /**
     * Testing if tag is taken from view
     *
     * @return
     */
    public function testGetTag()
    {
        $oView = $this->getMock( "oxUBase", array( "getTag" ) );
        $oView->expects( $this->once() )->method( 'getTag' )->will( $this->returnValue( "testTag" ) );

        oxConfig::getInstance()->setActiveView( $oView );

        $oEncoder = new oxSeoEncoderArticle();
        $this->assertEquals( "testTag", $oEncoder->UNITgetTag( new oxarticle, 0 ) );
    }

    /**
     * article has no vendor defined
     *
     * @return null
     */
    public function testGetVendorArticleHasNoManufacturerDefined()
    {
        $oEncoder = new oxSeoEncoderArticle();
        $this->assertNull( $oEncoder->UNITgetVendor( new oxArticle(), 0 ) );
    }

    /**
     * article has no manufacturer defined
     *
     * @return null
     */
    public function testGetVendorUnknownViewClass()
    {
        $sVendorId = oxDb::getDb()->getOne( "select oxid from oxvendor" );

        $oArticle = new oxArticle();
        $oArticle->oxarticles__oxvendorid = new oxField( $sVendorId );

        oxConfig::getInstance()->setActiveView( new oxUbase );

        $oEncoder = new oxSeoEncoderArticle();
        $oVendor = $oEncoder->UNITgetVendor( $oArticle, 0 );
        $this->assertNotNull( $oVendor );
        $this->assertEquals( $sVendorId, $oVendor->getId() );
    }

    /**
     * unknown Vendor id
     *
     * @return null
     */
    public function testGetVendorUnknownManufacturerId()
    {
        $oArticle = new oxArticle();
        $oArticle->oxarticles__oxvendorid = new oxField( "xxx" );

        $oEncoder = new oxSeoEncoderArticle();
        $this->assertNull( $oEncoder->UNITgetVendor( $oArticle, 0 ) );
    }

    /**
     * current view Vendor matches product
     *
     * @return null
     */
    public function testGetVendorCurrentViewVendorMatchesProduct()
    {
        $sVendorId = oxDb::getDb()->getOne( "select oxid from oxvendor" );

        $oArticle = new oxArticle();
        $oArticle->oxarticles__oxvendorid = new oxField( $sVendorId );

        $oVendor = new oxVendor();
        $oVendor->load( $sVendorId );

        $oView = $this->getMock( "oxUBase", array( "getActVendor" ) );
        $oView->expects( $this->once() )->method( 'getActVendor' )->will( $this->returnValue( $oVendor ) );

        oxConfig::getInstance()->setActiveView( $oView );

        $oEncoder = new oxSeoEncoderArticle();
        $oManufacturer = $oEncoder->UNITgetVendor( $oArticle, 0 );
        $this->assertNotNull( $oVendor );
        $this->assertEquals( $sVendorId, $oVendor->getId() );
    }

    /**
     * language ids does not match
     *
     * @return null
     */
    public function testGetVendorLanguageIdsDoesNotMatch()
    {
        $sVendorId = oxDb::getDb()->getOne( "select oxid from oxvendor" );

        $oArticle = new oxArticle();
        $oArticle->oxarticles__oxvendorid = new oxField( $sVendorId );

        $oVendor = new oxVendor();
        $oVendor->load( $sVendorId );

        $oView = $this->getMock( "oxUBase", array( "getActVendor" ) );
        $oView->expects( $this->once() )->method( 'getActVendor' )->will( $this->returnValue( $oVendor ) );

        oxConfig::getInstance()->setActiveView( $oView );

        $oEncoder = new oxSeoEncoderArticle();
        $oVendor = $oEncoder->UNITgetVendor( $oArticle, 1 );
        $this->assertNotNull( $oVendor );
        $this->assertEquals( $sVendorId, $oVendor->getId() );

    }

    /**
     * view manufacturer does not match article
     *
     * @return null
     */
    public function testGetVendorViewVendorDoesNotMatchArticle()
    {
        $sVendorId = oxDb::getDb()->getOne( "select oxid from oxvendor" );

        $oArticle = new oxArticle();
        $oArticle->oxarticles__oxvendorid = new oxField( $sVendorId );

        $oVendor = new oxVendor();
        $oVendor->setId( "xxx" );

        $oView = $this->getMock( "oxUBase", array( "getActVendor" ) );
        $oView->expects( $this->once() )->method( 'getActVendor' )->will( $this->returnValue( $oVendor ) );

        oxConfig::getInstance()->setActiveView( $oView );

        $oEncoder = new oxSeoEncoderArticle();
        $oVendor = $oEncoder->UNITgetVendor( $oArticle, 0 );
        $this->assertNotNull( $oVendor );
        $this->assertEquals( $sVendorId, $oVendor->getId() );
    }

    /**
     * article has no manufacturer defined
     *
     * @return null
     */
    public function testGetManufacturerArticleHasNoManufacturerDefined()
    {
        $oEncoder = new oxSeoEncoderArticle();
        $this->assertNull( $oEncoder->UNITgetManufacturer( new oxArticle(), 0 ) );
    }

    /**
     * article has no manufacturer defined
     *
     * @return null
     */
    public function testGetManufacturerUnknownViewClass()
    {
        $sManufacturerId = oxDb::getDb()->getOne( "select oxid from oxmanufacturers" );

        $oArticle = new oxArticle();
        $oArticle->oxarticles__oxmanufacturerid = new oxField( $sManufacturerId );

        oxConfig::getInstance()->setActiveView( new oxUbase );

        $oEncoder = new oxSeoEncoderArticle();
        $oManufacturer = $oEncoder->UNITgetManufacturer( $oArticle, 0 );
        $this->assertNotNull( $oManufacturer );
        $this->assertEquals( $sManufacturerId, $oManufacturer->getId() );
    }

    /**
     * unknown Manufacturer id
     *
     * @return null
     */
    public function testGetManufacturerUnknownManufacturerId()
    {
        $oArticle = new oxArticle();
        $oArticle->oxarticles__oxmanufacturerid = new oxField( "xxx" );

        $oEncoder = new oxSeoEncoderArticle();
        $this->assertNull( $oEncoder->UNITgetManufacturer( $oArticle, 0 ) );
    }

    /**
     * current view manufacturer matches product
     *
     * @return null
     */
    public function testGetManufacturerCurrentViewManufacturerMatchesProduct()
    {
        $sManufacturerId = oxDb::getDb()->getOne( "select oxid from oxmanufacturers" );

        $oArticle = new oxArticle();
        $oArticle->oxarticles__oxmanufacturerid = new oxField( $sManufacturerId );

        $oManufacturer = new oxManufacturer();
        $oManufacturer->load( $sManufacturerId );

        $oView = $this->getMock( "oxUBase", array( "getActManufacturer" ) );
        $oView->expects( $this->once() )->method( 'getActManufacturer' )->will( $this->returnValue( $oManufacturer ) );

        oxConfig::getInstance()->setActiveView( $oView );

        $oEncoder = new oxSeoEncoderArticle();
        $oManufacturer = $oEncoder->UNITgetManufacturer( $oArticle, 0 );
        $this->assertNotNull( $oManufacturer );
        $this->assertEquals( $sManufacturerId, $oManufacturer->getId() );
    }

    /**
     * language ids does not match
     *
     * @return null
     */
    public function testGetManufacturerLanguageIdsDoesNotMatch()
    {
        $sManufacturerId = oxDb::getDb()->getOne( "select oxid from oxmanufacturers" );

        $oArticle = new oxArticle();
        $oArticle->oxarticles__oxmanufacturerid = new oxField( $sManufacturerId );

        $oManufacturer = new oxManufacturer();
        $oManufacturer->load( $sManufacturerId );

        $oView = $this->getMock( "oxUBase", array( "getActManufacturer" ) );
        $oView->expects( $this->once() )->method( 'getActManufacturer' )->will( $this->returnValue( $oManufacturer ) );

        oxConfig::getInstance()->setActiveView( $oView );

        $oEncoder = new oxSeoEncoderArticle();
        $oManufacturer = $oEncoder->UNITgetManufacturer( $oArticle, 1 );
        $this->assertNotNull( $oManufacturer );
        $this->assertEquals( $sManufacturerId, $oManufacturer->getId() );

    }

    /**
     * view manufacturer does not match article
     *
     * @return null
     */
    public function testGetManufacturerViewManufacturerDoesNotMatchArticle()
    {
        $sManufacturerId = oxDb::getDb()->getOne( "select oxid from oxmanufacturers" );

        $oArticle = new oxArticle();
        $oArticle->oxarticles__oxmanufacturerid = new oxField( $sManufacturerId );

        $oManufacturer = new oxManufacturer();
        $oManufacturer->setId( "xxx" );

        $oView = $this->getMock( "oxUBase", array( "getActManufacturer" ) );
        $oView->expects( $this->once() )->method( 'getActManufacturer' )->will( $this->returnValue( $oManufacturer ) );

        oxConfig::getInstance()->setActiveView( $oView );

        $oEncoder = new oxSeoEncoderArticle();
        $oManufacturer = $oEncoder->UNITgetManufacturer( $oArticle, 0 );
        $this->assertNotNull( $oManufacturer );
        $this->assertEquals( $sManufacturerId, $oManufacturer->getId() );
    }

    public function testGetArticleRecommUri()
    {
        $iLang = 0;

        $oArticle = new oxArticle();
        $oArticle->setId( "_testArticleId" );

        // creating test recomm list
        $oRecomm = new oxRecommList();
        $oRecomm->setId( "_testRecomm" );
        $oRecomm->oxrecommlists__oxshopid = new oxField( oxConfig::getInstance()->getBaseShopId() );
        $oRecomm->oxrecommlists__oxtitle  = new oxField( "testrecommtitle" );
        $oRecomm->save();

        $sRecommSeoUrl = oxSeoEncoderRecomm::getInstance()->getRecommUri( $oRecomm, $iLang );

        $oEncoder = $this->getMock( "oxSeoEncoderArticle", array( "_getRecomm",
                                                                  "_loadFromDb",
                                                                  "_getProductForLang",
                                                                  "_prepareArticleTitle",
                                                                  "_processSeoUrl",
                                                                  "_getListType" ) );
        $oEncoder->expects( $this->once() )->method( '_getRecomm' )->will( $this->returnValue( $oRecomm ) );
        $oEncoder->expects( $this->once() )->method( '_loadFromDb' )->will( $this->returnValue( false ) );
        $oEncoder->expects( $this->once() )->method( '_getProductForLang' )->will( $this->returnValue( $oArticle ) );
        $oEncoder->expects( $this->once() )->method( '_prepareArticleTitle' )->will( $this->returnValue( "testArticleTitle" ) );
        $oEncoder->expects( $this->once() )->method( '_processSeoUrl' )->with( $this->equalTo( $sRecommSeoUrl."testArticleTitle" ), $this->equalTo( $oArticle->getId() ), $this->equalTo( $iLang ) )->will( $this->returnValue( $sRecommSeoUrl."testArticleTitle/" ) );
        $oEncoder->expects( $this->once() )->method( '_getListType' )->will( $this->returnValue( "recommlist" ) );
        $this->assertEquals( $sRecommSeoUrl."testArticleTitle/", $oEncoder->UNITgetArticleRecommUri( $oArticle, $iLang ) );
    }

    public function testGetArticleMainUriDataInDbFound()
    {
        $oArticle = $this->getMock( "oxarticle", array( "getId", "getStdLink" ));
        $oArticle->expects( $this->atLeastOnce() )->method( 'getId' )->will( $this->returnValue( 'testId' ) );
        $oArticle->expects( $this->never() )->method( 'getStdLink' );

        $oEncoder = $this->getMock( "oxseoencoderarticle", array( "_loadFromDb", "_getProductForLang", "_createArticleCategoryUri",
                                                                  "_processSeoUrl", "_prepareArticleTitle", "_saveToDb") );

        $oEncoder->expects( $this->once() )->method( '_loadFromDb' )->with( $this->equalto( 'oxarticle' ), $this->equalto( 'testId' ), $this->equalto( 0 ), $this->equalto( null ), $this->equalto( '' ), $this->equalto( true ) )->will( $this->returnValue( 'testSeoUri' ) );
        $oEncoder->expects( $this->never() )->method( '_getProductForLang' );
        $oEncoder->expects( $this->never() )->method( '_createArticleCategoryUri' );
        $oEncoder->expects( $this->never() )->method( '_processSeoUrl' );
        $oEncoder->expects( $this->never() )->method( '_prepareArticleTitle' );
        $oEncoder->expects( $this->never() )->method( '_saveToDb' );

        $this->assertEquals( 'testSeoUri', $oEncoder->UNITgetArticleMainUri( $oArticle, 0 ) );
    }

    public function testGetArticleMainUriHasCategory()
    {
        $sMainCatId = oxDb::getDb()->getOne( "select oxcatnid from ".getViewName( "oxobject2category" )." where oxobjectid = '1126' order by oxtime" );

        $oCategory = oxNew( "oxcategory" );
        $oCategory->load( $sMainCatId );

        $oArticle = $this->getMock( "oxarticle", array( "getId", "getStdLink" ));
        $oArticle->expects( $this->atLeastOnce() )->method( 'getId' )->will( $this->returnValue( '1126' ) );
        $oArticle->expects( $this->never() )->method( 'getStdLink' );

        $oEncoder = $this->getMock( "oxseoencoderarticle", array( "_loadFromDb", "_getProductForLang", "_createArticleCategoryUri",
                                                                  "_processSeoUrl", "_prepareArticleTitle", "_saveToDb") );

        $oEncoder->expects( $this->once() )->method( '_loadFromDb' )->with( $this->equalTo( 'oxarticle'), $this->equalTo( '1126' ), $this->equalTo(0), $this->equalTo( null ), $this->equalTo( $sMainCatId ), $this->equalTo( true ) )->will( $this->returnValue( false ) );
        $oEncoder->expects( $this->once() )->method( '_createArticleCategoryUri' )->with( $this->equalTo( $oArticle ), $this->equalTo( $oCategory ), $this->equalTo( 0 ))->will( $this->returnValue( 'testSeoUri' ) );
        $oEncoder->expects( $this->never() )->method( '_getProductForLang' );
        $oEncoder->expects( $this->never() )->method( '_processSeoUrl' );
        $oEncoder->expects( $this->never() )->method( '_prepareArticleTitle' );
        $oEncoder->expects( $this->never() )->method( '_saveToDb' );

        $this->assertEquals( 'testSeoUri', $oEncoder->UNITgetArticleMainUri( $oArticle, 0 ) );
    }

    public function testGetArticleMainUriVariantHasCategory()
    {
        $sMainCatId = oxDb::getDb()->getOne( "select oxcatnid from ".getViewName( "oxobject2category" )." where oxobjectid = '1126' order by oxtime" );

        $oCategory = oxNew( "oxcategory" );
        $oCategory->load( $sMainCatId );

        $oArticle = $this->getMock( "oxarticle", array( "getId", "getStdLink" ));
        $oArticle->oxarticles__oxparentid = new oxField( '1126' );
        $oArticle->expects( $this->atLeastOnce() )->method( 'getId' )->will( $this->returnValue( 'testVarId' ) );
        $oArticle->expects( $this->never() )->method( 'getStdLink' );

        $oEncoder = $this->getMock( "oxseoencoderarticle", array( "_loadFromDb", "_getProductForLang", "_createArticleCategoryUri",
                                                                  "_processSeoUrl", "_prepareArticleTitle", "_saveToDb") );

        $oEncoder->expects( $this->once() )->method( '_loadFromDb' )->with( $this->equalTo( 'oxarticle'), $this->equalTo( 'testVarId' ), $this->equalTo(0), $this->equalTo( null ), $this->equalTo( $sMainCatId ), $this->equalTo( true ) )->will( $this->returnValue( false ) );
        $oEncoder->expects( $this->once() )->method( '_createArticleCategoryUri' )->with( $this->equalTo( $oArticle ), $this->equalTo( $oCategory ), $this->equalTo( 0 ))->will( $this->returnValue( 'testSeoUri' ) );
        $oEncoder->expects( $this->never() )->method( '_getProductForLang' );
        $oEncoder->expects( $this->never() )->method( '_processSeoUrl' );
        $oEncoder->expects( $this->never() )->method( '_prepareArticleTitle' );
        $oEncoder->expects( $this->never() )->method( '_saveToDb' );

        $this->assertEquals( 'testSeoUri', $oEncoder->UNITgetArticleMainUri( $oArticle, 0 ) );
    }

    public function testGetArticleMainUriHasNoCategory()
    {
        $oArticle = $this->getMock( "oxarticle", array( "getId", "getStdLink" ));
        $oArticle->expects( $this->atLeastOnce() )->method( 'getId' )->will( $this->returnValue( 'testId' ) );
        $oArticle->expects( $this->once() )->method( 'getStdLink' )->with( $this->equalTo( 0 ) )->will( $this->returnValue( 'testStdLink' ) );

        $oEncoder = $this->getMock( "oxseoencoderarticle", array( "_loadFromDb", "_getProductForLang", "_createArticleCategoryUri",
                                                                  "_processSeoUrl", "_prepareArticleTitle", "_saveToDb") );

        $oEncoder->expects( $this->once() )->method( '_loadFromDb' )->with( $this->equalTo( 'oxarticle'), $this->equalTo( 'testId' ), $this->equalTo(0), $this->equalTo( null ), $this->equalTo( '' ), $this->equalTo( true ) )->will( $this->returnValue( false ) );
        $oEncoder->expects( $this->once() )->method( '_getProductForLang' )->with( $this->equalTo( $oArticle ), $this->equalTo( 0 ))->will( $this->returnValue( $oArticle ) );
        $oEncoder->expects( $this->once() )->method( '_prepareArticleTitle' )->with( $this->equalTo( $oArticle ) )->will( $this->returnValue( 'testArticleTitle' ) );
        $oEncoder->expects( $this->once() )->method( '_processSeoUrl' )->with( $this->equalTo( 'testArticleTitle' ), $this->equalTo( 'testId' ), $this->equalTo( 0 ) )->will( $this->returnValue( 'testSeoUri' ) );
        $oEncoder->expects( $this->once() )->method( '_saveToDb' )->with( $this->equalTo( 'oxarticle' ), $this->equalTo( 'testId' ), $this->equalTo( 'testStdLink' ), $this->equalTo( 'testSeoUri' ), $this->equalTo( 0 ), $this->equalTo( null ), $this->equalTo( 0 ), $this->equalTo( false ), $this->equalTo( false ), $this->equalTo( '' ));

        $oEncoder->expects( $this->never() )->method( '_createArticleCategoryUri' );

        $this->assertEquals( 'testSeoUri', $oEncoder->UNITgetArticleMainUri( $oArticle, 0 ) );
    }

    public function testGetArticleTagUri()
    {
        $oArticle = new oxArticle();
        $oArticle->load( '1126' );

        $oSeoEncoderArticle = $this->getMock( "oxSeoEncoderArticle", array( "_getTag" ) );
        $oSeoEncoderArticle->expects( $this->any() )->method('_getTag')->will( $this->returnValue( 'sTag' ) );

        $this->assertEquals( 'tag/sTag/Bar-Set-ABSINTH.html', $oSeoEncoderArticle->UNITgetArticleTagUri( $oArticle, 0 ) );

        // chache works ?
        $this->assertEquals( 'tag/sTag/Bar-Set-ABSINTH.html', $oSeoEncoderArticle->UNITgetArticleTagUri( $oArticle, 0 ) );
    }

    public function testGetProductForLang()
    {
        $oArticle = $this->getMock( 'oxarticle', array( 'getLanguage', 'getId' ) );
        $oArticle->expects( $this->once() )->method('getLanguage')->will( $this->returnValue( 2 ) );
        $oArticle->expects( $this->once() )->method('getId')->will( $this->returnValue( '1126' ) );

        $oEncoder = new oxSeoEncoderArticle();
        $oArticle = $oEncoder->UNITgetProductForLang( $oArticle, 0 );
        $this->assertEquals( '1126', $oArticle->getId() );

        $oArticle = $this->getMock( 'oxarticle', array( 'getLanguage', 'getId' ) );
        $oArticle->expects( $this->once() )->method('getLanguage')->will( $this->returnValue( 0 ) );
        $oArticle->expects( $this->once() )->method('getId')->will( $this->returnValue( '1126' ) );

        $oEncoder = new oxSeoEncoderArticle();
        $oArticle = $oEncoder->UNITgetProductForLang( $oArticle, 0 );
        $this->assertEquals( '1126', $oArticle->getId() );

    }

    public function testCreateArticleSeoUrlWhenTitleContainsOnlyBadChars()
    {
        modConfig::getInstance()->setConfigParam( 'aSeoReplaceChars', array() );

        $oArticle = $this->getMock('oxArticle', array('getCategory'));
        $oArticle = new oxArticle();
        $oArticle->setId( '_testArtId' );
        $oArticle->oxarticles__oxtitle = new oxField( '�������' );

        $this->assertEquals( oxConfig::getInstance()->getConfigParam("sShopURL")."oxid.html", $oArticle->getLink() );
    }

    public function testGetArticleVendorUriArticleHasNoVendorAssigned()
    {
        $sVendorId = oxDb::getDb()->getOne( "select oxid from oxvendor" );
        $oVendor = new oxVendor();
        $oVendor->load( $sVendorId );

        $sSeoUri = "Nach-Lieferant/".str_replace( array(' ', '.', '+'), '-', $oVendor->oxvendor__oxtitle->value )."/oxid-test-article-title-oxid-test-article-var-select.html";

        $oArticle = new oxarticle();
        $oArticle->oxarticles__oxtitle     = new oxField( 'oxid test article title' );
        $oArticle->oxarticles__oxvarselect = new oxField( 'oxid test article var select' );
        $oArticle->oxarticles__oxvendorid  = new oxField( $sVendorId );

        $oEncoder = $this->getMock( "oxSeoEncoderArticle", array( "_getVendor" ) );
        $oEncoder->expects( $this->once() )->method('_getVendor')->will( $this->returnValue( $oVendor ) );
        $this->assertEquals( $sSeoUri, $oEncoder->UNITgetArticleVendorUri( $oArticle, 0 ) );
    }

    public function testGetArticleManufacturerUriArticleHasNoManufacturerAssigned()
    {
        $sManufacturerId = oxDb::getDb()->getOne( "select oxid from oxmanufacturers" );
        $oManufacturer = new oxManufacturer();
        $oManufacturer->load( $sManufacturerId );
        $sSeoUri = "Nach-Marke-Hersteller/".str_replace( array(' ', '.', '+'), '-', $oManufacturer->oxmanufacturers__oxtitle->value )."/oxid-test-article-title-oxid-test-article-var-select.html";

        $oArticle = new oxarticle();
        $oArticle->oxarticles__oxtitle     = new oxField( 'oxid test article title' );
        $oArticle->oxarticles__oxvarselect = new oxField( 'oxid test article var select' );
        $oArticle->oxarticles__oxmanufacturerid  = new oxField( $sManufacturerId );

        $oEncoder = $this->getMock( "oxSeoEncoderArticle", array( "_getManufacturer" ) );
        $oEncoder->expects( $this->once() )->method('_getManufacturer')->will( $this->returnValue( $oManufacturer ) );
        $this->assertEquals( $sSeoUri, $oEncoder->UNITgetArticleManufacturerUri( $oArticle, 0 ) );
    }

    public function testGetArticleVendorUriArticleArticleIsAssignedToVendor()
    {
        $sVendorId = oxDb::getDb()->getOne( "select oxid from oxvendor" );
        $oVendor = new oxVendor();
        $oVendor->load( $sVendorId );

        $sSeoUri = 'Nach-Lieferant/'.str_replace( array(' ', '.', '+'), '-', $oVendor->oxvendor__oxtitle->value ).'/oxid-test-article-title-oxid-test-article-var-select.html';

        $oArticle = new oxarticle();
        $oArticle->oxarticles__oxtitle     = new oxField( 'oxid test article title' );
        $oArticle->oxarticles__oxvarselect = new oxField( 'oxid test article var select' );
        $oArticle->oxarticles__oxvendorid  = new oxField( $sVendorId );

        $oEncoder = $this->getMock( "oxSeoEncoderArticle", array( "_getVendor" ) );
        $oEncoder->expects( $this->once() )->method('_getVendor')->will( $this->returnValue( $oVendor ) );
        $this->assertEquals( $sSeoUri, $oEncoder->UNITgetArticleVendorUri( $oArticle, 0 ) );
    }

    public function testGetArticleManufacturerUriArticleArticleIsAssignedToManufacturer()
    {
        $sManufacturerId = oxDb::getDb()->getOne( 'select oxid from oxmanufacturers' );
        $oManufacturer = new oxManufacturer();
        $oManufacturer->load( $sManufacturerId );

        $sSeoUri = 'Nach-Marke-Hersteller/'.str_replace( array(' ', '.', '+'), '-', $oManufacturer->oxmanufacturers__oxtitle->value ).'/oxid-test-article-title-oxid-test-article-var-select.html';

        $oArticle = new oxarticle();
        $oArticle->oxarticles__oxtitle     = new oxField( 'oxid test article title' );
        $oArticle->oxarticles__oxvarselect = new oxField( 'oxid test article var select' );
        $oArticle->oxarticles__oxmanufacturerid  = new oxField( $sManufacturerId );

        $oEncoder = $this->getMock( "oxSeoEncoderArticle", array( "_getManufacturer" ) );
        $oEncoder->expects( $this->once() )->method('_getManufacturer')->will( $this->returnValue( $oManufacturer ) );
        $this->assertEquals( $sSeoUri, $oEncoder->UNITgetArticleManufacturerUri( $oArticle, 0 ) );
    }

    public function testGetArticleVendorUriArticleArticleIsAssignedToVendorWithLangParam()
    {
        $sVendorId = oxDb::getDb()->getOne( 'select oxid from oxvendor' );
        $oVendor = new oxVendor();
        $oVendor->load( $sVendorId );

        $oArticle = new oxarticle();
        $oArticle->setLanguage(1);
            $sArtId = '1354';
            $oxtitle   = 'Wanduhr-SPIDER';

        $sSeoUri = 'Nach-Lieferant/'.str_replace( array(' ', '.', '+'), '-', $oVendor->oxvendor__oxtitle->value ).'/'.$oxtitle.'-oxid-test-article-var-select.html';

        $oArticle->setId($sArtId);
        $oArticle->oxarticles__oxtitle     = new oxField( $oxtitle );
        oxTestModules::addFunction('oxarticle', 'loadInLang', '{parent::loadInLang($aA[0], $aA[1]);$this->oxarticles__oxvarselect = new oxField( "oxid test article var select" );}');
        $oArticle->oxarticles__oxvarselect = new oxField( 'if this is here, object is not reloaded: bad :(' );
        $oArticle->oxarticles__oxvendorid  = new oxField( $sVendorId );

        $oEncoder = $this->getMock( "oxSeoEncoderArticle", array( "_getVendor" ) );
        $oEncoder->expects( $this->once() )->method('_getVendor')->will( $this->returnValue( $oVendor ) );
        $this->assertEquals( $sSeoUri, $oEncoder->UNITgetArticleVendorUri( $oArticle, 0 ) );
    }

    public function testGetArticleManufacturerUriArticleArticleIsAssignedToManufacturerWithLangParam()
    {
        $sManufacturerId = oxDb::getDb()->getOne( 'select oxid from oxmanufacturers' );
        $oManufacturer = new oxManufacturer();
        $oManufacturer->load( $sManufacturerId );

        $oArticle = new oxarticle();
        $oArticle->setLanguage(1);
            $sArtId = '1354';
            $oxtitle   = 'Wanduhr-SPIDER';

        $sSeoUri = 'Nach-Marke-Hersteller/'.str_replace( array(' ', '.', '+'), '-', $oManufacturer->oxmanufacturers__oxtitle->value ).'/'.$oxtitle.'-oxid-test-article-var-select.html';

        $oArticle->setId($sArtId);
        $oArticle->oxarticles__oxtitle     = new oxField( $oxtitle );
        oxTestModules::addFunction('oxarticle', 'loadInLang', '{parent::loadInLang($aA[0], $aA[1]);$this->oxarticles__oxvarselect = new oxField( "oxid test article var select" );}');
        $oArticle->oxarticles__oxvarselect = new oxField( 'if this is here, object is not reloaded: bad :(' );
        $oArticle->oxarticles__oxmanufacturerid  = new oxField( $sManufacturerId );

        $oEncoder = $this->getMock( "oxSeoEncoderArticle", array( "_getManufacturer" ) );
        $oEncoder->expects( $this->once() )->method('_getManufacturer')->will( $this->returnValue( $oManufacturer ) );
        $this->assertEquals( $sSeoUri, $oEncoder->UNITgetArticleManufacturerUri( $oArticle, 0 ) );
    }

    public function testGetArticleVendorUriArticleArticleIsAssignedToVendorEngWithLangParam()
    {
        $sVendorId = oxDb::getDb()->getOne( 'select oxid from oxvendor' );
        $oVendor = new oxVendor();
        $oVendor->loadInLang( 1, $sVendorId );

        $oArticle = new oxarticle();
        $oArticle->setLanguage(0);
            $sArtId = '1354';
            $oxtitle   = 'Wall-Clock-SPIDER';

        $sSeoUri = 'en/By-Distributor/'.str_replace( array(' ', '.', '+'), '-', $oVendor->oxvendor__oxtitle->value ).'/'.$oxtitle.'-oxid-test-article-var-select.html';

        $oArticle->setId($sArtId);
        $oArticle->oxarticles__oxtitle     = new oxField( $oxtitle );
        oxTestModules::addFunction('oxarticle', 'loadInLang', '{parent::loadInLang($aA[0], $aA[1]);$this->oxarticles__oxvarselect = new oxField( "oxid test article var select" );}');
        $oArticle->oxarticles__oxvarselect = new oxField( 'if this is here, object is not reloaded: bad :(' );
        $oArticle->oxarticles__oxvendorid  = new oxField( $sVendorId );

        $oEncoder = $this->getMock( "oxSeoEncoderArticle", array( "_getVendor" ) );
        $oEncoder->expects( $this->once() )->method('_getVendor')->will( $this->returnValue( $oVendor ) );
        $this->assertEquals( $sSeoUri, $oEncoder->UNITgetArticleVendorUri( $oArticle, 1 ) );
    }

    public function testGetArticleManufacturerUriArticleArticleIsAssignedToManufacturerEngWithLangParam()
    {
        $sManufacturerId = oxDb::getDb()->getOne( 'select oxid from oxmanufacturers' );
        $oManufacturer = new oxManufacturer();
        $oManufacturer->loadInLang( 1, $sManufacturerId );

        $oArticle = new oxarticle();
        $oArticle->setLanguage(0);
            $sArtId = '1354';
            $oxtitle   = 'Wall-Clock-SPIDER';

        $sSeoUri = 'en/By-Brand-Manufacturer/'.str_replace( array(' ', '.', '+'), '-', $oManufacturer->oxmanufacturers__oxtitle->value ).'/'.$oxtitle.'-oxid-test-article-var-select.html';

        $oArticle->setId($sArtId);
        $oArticle->oxarticles__oxtitle     = new oxField( $oxtitle );
        oxTestModules::addFunction('oxarticle', 'loadInLang', '{parent::loadInLang($aA[0], $aA[1]);$this->oxarticles__oxvarselect = new oxField( "oxid test article var select" );}');
        $oArticle->oxarticles__oxvarselect = new oxField( 'if this is here, object is not reloaded: bad :(' );
        $oArticle->oxarticles__oxmanufacturerid  = new oxField( $sManufacturerId );

        $oEncoder = $this->getMock( "oxSeoEncoderArticle", array( "_getManufacturer" ) );
        $oEncoder->expects( $this->once() )->method('_getManufacturer')->will( $this->returnValue( $oManufacturer ) );
        $this->assertEquals( $sSeoUri, $oEncoder->UNITgetArticleManufacturerUri( $oArticle, 1 ) );
    }

    public function testPrepareArticleTitle()
    {
        $oArticle = new oxarticle();
        $oArticle->oxarticles__oxtitle = new oxfield( 'test main title' );

        $oEncoder = new oxSeoEncoderArticle();
        $this->assertEquals( 'test-main-title.html', $oEncoder->UNITprepareArticleTitle( $oArticle ) );

        // no title just number
        $oArticle = new oxarticle();
        $oArticle->oxarticles__oxartnum = new oxfield( '123-321' );
        $this->assertEquals( '123-321.html', $oEncoder->UNITprepareArticleTitle( $oArticle ) );

        // varselect is set
        $oArticle = new oxarticle();
        $oArticle->oxarticles__oxvarselect = new oxfield( 'test var select' );
        $this->assertEquals( 'test-var-select.html', $oEncoder->UNITprepareArticleTitle( $oArticle ) );

        // no data is set
        $oArticle = new oxarticle();
        $this->assertEquals( 'oxid.html', $oEncoder->UNITprepareArticleTitle( $oArticle ) );

        // variant
        $sVarId = oxDb::getDb()->getOne( "select oxid from oxarticles where oxparentid !=''" );
        $oVariant = new oxArticle();
        $oVariant->load( $sVarId );

        $oParent = new oxArticle();
        $oParent->load( $oVariant->oxarticles__oxparentid->value );

        $oVariant->oxarticles__oxtitle = new oxField( "" );
        $oVariant->oxarticles__oxvarselect = new oxField( "varselect1" );
        $sTitle = str_replace( ".", "-varselect1.", $oEncoder->UNITprepareArticleTitle( $oParent ) );

        $this->assertEquals( $sTitle, $oEncoder->UNITprepareArticleTitle( $oVariant ));

        $oVariant->oxarticles__oxvarselect = new oxField( "varselect2" );
        $sTitle = str_replace( ".", "-varselect2.", $oEncoder->UNITprepareArticleTitle( $oParent ) );
        $this->assertEquals( $sTitle, $oEncoder->UNITprepareArticleTitle( $oVariant ));
    }

    public function testGetArticleUrl()
    {
        $oArticle = $this->getMock( 'oxarticle', array( 'getLanguage' ) );
        $oArticle->expects( $this->once() )->method('getLanguage')->will( $this->returnValue( 0 ) );

        $oEncoder = $this->getMock( 'oxSeoEncoderArticle', array( '_getFullUrl', '_getArticleUri', '_getArticleVendorUri', '_getArticleManufacturerUri', '_getArticleMainUri' ) );
        $oEncoder->expects( $this->once() )->method('_getArticleUri')->will( $this->returnValue( "seoArticleUri" ) );
        $oEncoder->expects( $this->never() )->method('_getArticleVendorUri');
        $oEncoder->expects( $this->never() )->method('_getArticleManufacturerUri');
        $oEncoder->expects( $this->never() )->method('_getArticleMainUri');
        $oEncoder->expects( $this->once() )->method('_getFullUrl')->will( $this->returnValue( 'seoarturl' ) );

        $this->assertEquals( 'seoarturl', $oEncoder->getArticleUrl( $oArticle ) );
    }

    public function testGetArticleUrlForVendor()
    {
        $oArticle = $this->getMock( 'oxarticle', array( 'getLanguage' ) );
        $oArticle->expects( $this->once() )->method('getLanguage')->will( $this->returnValue( 0 ) );

        $oEncoder = $this->getMock( 'oxSeoEncoderArticle', array( '_getFullUrl', '_getArticleUri', '_getArticleVendorUri', '_getArticleManufacturerUri', '_getArticleMainUri' ) );
        $oEncoder->expects( $this->once() )->method('_getFullUrl')->will( $this->returnValue( 'seoarturl' ) );
        $oEncoder->expects( $this->never() )->method('_getArticleUri');
        $oEncoder->expects( $this->once() )->method('_getArticleVendorUri')->will( $this->returnValue( 'seoarturl' ) );;
        $oEncoder->expects( $this->never() )->method('_getArticleManufacturerUri');
        $oEncoder->expects( $this->never() )->method('_getArticleMainUri');

        $this->assertEquals( 'seoarturl', $oEncoder->getArticleUrl( $oArticle, null, 1 ) );
    }

    public function testGetArticleUrlForManufacturer()
    {
        $oArticle = $this->getMock( 'oxarticle', array( 'getLanguage' ) );
        $oArticle->expects( $this->once() )->method('getLanguage')->will( $this->returnValue( 0 ) );

        $oEncoder = $this->getMock( 'oxSeoEncoderArticle', array( '_getFullUrl', '_getArticleUri', '_getArticleVendorUri', '_getArticleManufacturerUri', '_getArticleMainUri' ) );
        $oEncoder->expects( $this->once() )->method('_getFullUrl')->will( $this->returnValue( 'seoarturl' ) );
        $oEncoder->expects( $this->never() )->method('_getArticleUri');
        $oEncoder->expects( $this->never() )->method('_getArticleVendorUri');
        $oEncoder->expects( $this->once() )->method('_getArticleManufacturerUri')->will( $this->returnValue( 'seoarturl' ) );
        $oEncoder->expects( $this->never() )->method('_getArticleMainUri');

        $this->assertEquals( 'seoarturl', $oEncoder->getArticleUrl( $oArticle, null, 2 ) );
    }

    public function testGetArticleUrlForPriceCategory()
    {
        $oArticle = $this->getMock( 'oxarticle', array( 'getLanguage' ) );
        $oArticle->expects( $this->once() )->method('getLanguage')->will( $this->returnValue( 0 ) );

        $oEncoder = $this->getMock( 'oxSeoEncoderArticle', array( '_getFullUrl', '_getArticleUri', '_getArticleVendorUri', '_getArticleManufacturerUri', '_getArticleMainUri' ) );
        $oEncoder->expects( $this->once() )->method('_getFullUrl')->will( $this->returnValue( 'seoarturl' ) );
        $oEncoder->expects( $this->once() )->method('_getArticleUri')->will( $this->returnValue( 'seoarturl' ) );
        $oEncoder->expects( $this->never() )->method('_getArticleVendorUri');
        $oEncoder->expects( $this->never() )->method('_getArticleManufacturerUri');
        $oEncoder->expects( $this->never() )->method('_getArticleMainUri');

        $this->assertEquals( 'seoarturl', $oEncoder->getArticleUrl( $oArticle, null, 3 ) );
    }

    public function testGetArticleUrlForTag()
    {
        $oArticle = $this->getMock( 'oxarticle', array( 'getLanguage' ) );
        $oArticle->expects( $this->once() )->method('getLanguage')->will( $this->returnValue( 0 ) );

        $oEncoder = $this->getMock( 'oxSeoEncoderArticle', array( '_getFullUrl', '_getArticleTagUri', '_getArticlePriceCategoryUri', '_getArticleUri', '_getArticleVendorUri', '_getArticleManufacturerUri', '_getArticleMainUri' ) );
        $oEncoder->expects( $this->once() )->method('_getFullUrl')->will( $this->returnValue( 'seoarturl' ) );
        $oEncoder->expects( $this->once() )->method('_getArticleTagUri')->will( $this->returnValue( 'seoarturl' ) );
        $oEncoder->expects( $this->never() )->method('_getArticlePriceCategoryUri');
        $oEncoder->expects( $this->never() )->method('_getArticleUri');
        $oEncoder->expects( $this->never() )->method('_getArticleVendorUri');
        $oEncoder->expects( $this->never() )->method('_getArticleManufacturerUri');
        $oEncoder->expects( $this->never() )->method('_getArticleMainUri');

        $this->assertEquals( 'seoarturl', $oEncoder->getArticleUrl( $oArticle, null, 4 ) );
    }

    /**
     * Testing article uri getter
     */
    public function testGetArticleUri()
    {
        $oCategory = $this->getMock( "oxCategory", array( "isPriceCategory" ) );
        $oCategory->expects( $this->any() )->method( 'isPriceCategory' )->will( $this->returnValue( false ) );
        $oCategory->load( oxDb::getDb()->getOne( "select oxid from oxcategories where oxparentid = 'oxrootid'" ) );

        $oArticle = $this->getMock( "oxarticle", array( "inCategory" ) );
        $oArticle->expects( $this->once() )->method( 'inCategory' )->will( $this->returnValue( true ) );
        $oArticle->oxarticles__oxtitle     = new oxField( 'Messerblock VOODOO' );
        $oArticle->oxarticles__oxvarselect = new oxField( 'test var select' );
        $oArticle->oxarticles__oxartnum    = new oxField( '123' );
        $oArticle->oxarticles__oxprice     = new oxField( 100 );

        $sUrl = oxSeoEncoder::getInstance()->UNITprepareTitle($oCategory->oxcategories__oxtitle->value ).'/Messerblock-VOODOO-test-var-select.html';
        $oEncoder = $this->getMock( "oxSeoEncoderArticle", array( "_getCategory" ) );
        $oEncoder->expects( $this->once() )->method( '_getCategory' )->will( $this->returnValue( $oCategory ) );
        $this->assertEquals( $sUrl, $oEncoder->UNITgetArticleUri( $oArticle, 0 ) );
    }

    public function testGetArticleUriWithoutTitle()
    {
        $oCategory = $this->getMock( "oxCategory", array( "isPriceCategory" ) );
        $oCategory->expects( $this->any() )->method( 'isPriceCategory' )->will( $this->returnValue( true ) );
        $oCategory->load( oxDb::getDb()->getOne( "select oxid from oxcategories where oxparentid = 'oxrootid'" ) );

        $oArticle = $this->getMock( "oxarticle", array( "inCategory", "inPriceCategory" ) );
        $oArticle->expects( $this->never() )->method( 'inCategory' );
        $oArticle->expects( $this->once() )->method( 'inPriceCategory' )->will( $this->returnValue( true ) );
        $oArticle->oxarticles__oxtitle  = new oxField('');
        $oArticle->oxarticles__oxid     = new oxField('testtestnocat');
        $oArticle->oxarticles__oxartnum = new oxField('123');

        $oEncoder = $this->getMock( "oxSeoEncoderArticle", array( '_loadFromDb', "_getCategory" ) );
        $oEncoder->expects( $this->once() )->method( '_getCategory' )->will( $this->returnValue( $oCategory ) );
        $oEncoder->expects( $this->once() )->method( '_loadFromDb' )->will( $this->returnValue( false ) );

        $this->assertEquals( oxSeoEncoder::getInstance()->UNITprepareTitle($oCategory->oxcategories__oxtitle->value)."/123.html", $oEncoder->UNITgetArticleUri( $oArticle, 0 ) );
    }

    public function testGetArticleUriWithoutTitleInEnglish()
    {
        $oCategory = $this->getMock( "oxCategory", array( "isPriceCategory" ) );
        $oCategory->expects( $this->any() )->method( 'isPriceCategory' )->will( $this->returnValue( false ) );
        $oCategory->loadInLang( 1, oxDb::getDb()->getOne( "select oxid from oxcategories where oxparentid = 'oxrootid'" ) );

        $oArticle = $this->getMock( "oxarticle", array( "inCategory" ) );
        $oArticle->expects( $this->once() )->method( 'inCategory' )->will( $this->returnValue( true ) );
        $oArticle->setLanguage( 1 );
        $oArticle->oxarticles__oxtitle  = new oxField( '' );
        $oArticle->oxarticles__oxid     = new oxField( 'testtest' );
        $oArticle->oxarticles__oxartnum = new oxField( '123' );

        $oEncoder = $this->getMock('oxSeoEncoderArticle', array( '_loadFromDb', "_getCategory" ) );
        $oEncoder->expects( $this->once() )->method( '_getCategory' )->will( $this->returnValue( $oCategory ) );
        $oEncoder->expects( $this->once() )->method( '_loadFromDb' )->will( $this->returnValue( false ) );

        $this->assertEquals( "en/".oxSeoEncoder::getInstance()->UNITprepareTitle($oCategory->oxcategories__oxtitle->value)."/123.html", $oEncoder->UNITgetArticleUri( $oArticle, 1 ) );
    }

    public function testGetArticleUriVariantWithCategory()
    {
        $oCategory = $this->getMock( "oxCategory", array( "isPriceCategory" ) );
        $oCategory->expects( $this->any() )->method( 'isPriceCategory' )->will( $this->returnValue( false ) );
        $oCategory->load( oxDb::getDb()->getOne( "select oxid from oxcategories where oxparentid = 'oxrootid'" ) );

        $oArticle = $this->getMock( "oxarticle", array( "inCategory" ) );
        $oArticle->expects( $this->once() )->method( 'inCategory' )->will( $this->returnValue( true ) );
            $oArticle->load( '8a142c410f55ed579.98106125' );
            $sUrl = oxSeoEncoder::getInstance()->UNITprepareTitle($oCategory->oxcategories__oxtitle->value).'/Tischlampe-SPHERE-rot.html';

        $oEncoder = $this->getMock( 'oxSeoEncoderArticle', array( '_loadFromDb', "_getCategory" ) );
        $oEncoder->expects( $this->once() )->method( '_getCategory' )->will( $this->returnValue( $oCategory ) );
        $oEncoder->expects( $this->once() )->method( '_loadFromDb' )->will( $this->returnvalue( false ) );

        $sSeoUrl = $oEncoder->UNITgetArticleUri( $oArticle, 0 );
        $this->assertEquals( $sUrl, $sSeoUrl );
    }

    public function testEncodeArtUrlvariantWithCategoryInEnglish()
    {
        oxSeoEncoder::getInstance()->setSeparator( '+' );

        $oCategory = $this->getMock( "oxCategory", array( "isPriceCategory" ) );
        $oCategory->expects( $this->any() )->method( 'isPriceCategory' )->will( $this->returnValue( false ) );
        $oCategory->loadInLang( 1, oxDb::getDb()->getOne( "select oxid from oxcategories where oxparentid = 'oxrootid'" ) );

        $oArticle = $this->getMock( "oxarticle", array( "inCategory" ) );
        $oArticle->expects( $this->once() )->method( 'inCategory' )->will( $this->returnValue( true ) );

            $oArticle->loadInLang(1, '8a142c410f55ed579.98106125');
            $sUrl = "en/".oxSeoEncoder::getInstance()->UNITprepareTitle($oCategory->oxcategories__oxtitle->value)."/Tischlampe+SPHERE+red.html";

        $oEncoder = $this->getMock('modSeoEncoderArticle', array('_loadFromDb', "_getCategory" ));
        $oEncoder->expects( $this->once() )->method( '_getCategory' )->will( $this->returnValue( $oCategory ) );
        $oEncoder->expects($this->any())->method( '_loadFromDb' )->will( $this->returnvalue(false) );
        $oEncoder->setSeparator( '+' );

        oxTestModules::addFunction("oxSeoEncoderCategory", "resetInst", '{oxSeoEncoderCategory::$_instance = null;}');
        oxNew('oxSeoEncoderCategory')->resetInst();
        oxDb::getDb()->execute( 'delete from oxseo where oxtype != "static"' );
        oxDb::getDb()->execute( 'delete from oxseohistory' );

        $this->assertEquals( $sUrl, $oEncoder->UNITgetArticleUri( $oArticle, 1 ) );
    }

    public function testGetArticleUriVariantWithCategoryWithLangParam()
    {
        $oCategory = $this->getMock( "oxCategory", array( "isPriceCategory" ) );
        $oCategory->expects( $this->any() )->method( 'isPriceCategory' )->will( $this->returnValue( false ) );
        $oCategory->load( oxDb::getDb()->getOne( "select oxid from oxcategories where oxparentid = 'oxrootid'" ) );

        $oArticle = $this->getMock( "oxarticle", array( "inCategory" ) );
        $oArticle->expects( $this->once() )->method( 'inCategory' )->will( $this->returnValue( true ) );
            $oArticle->loadInLang(1, '8a142c410f55ed579.98106125' );
            $sUrl = oxSeoEncoder::getInstance()->UNITprepareTitle($oCategory->oxcategories__oxtitle->value).'/Tischlampe-SPHERE-rot.html';

        $oEncoder = $this->getMock( 'oxSeoEncoderArticle', array( '_loadFromDb', "_getCategory" ) );
        $oEncoder->expects( $this->once() )->method( '_getCategory' )->will( $this->returnValue( $oCategory ) );
        $oEncoder->expects( $this->any() )->method( '_loadFromDb' )->will( $this->returnvalue( false ) );

        $this->assertEquals( $sUrl, $oEncoder->UNITgetArticleUri( $oArticle, 0 ) );
    }

    public function testEncodeArtUrlvariantWithCategoryInEnglishWithLangParam()
    {
        oxSeoEncoder::getInstance()->setSeparator( '+' );
        $oCategory = $this->getMock( "oxCategory", array( "isPriceCategory" ) );
        $oCategory->expects( $this->any() )->method( 'isPriceCategory' )->will( $this->returnValue( false ) );
        $oCategory->loadInLang( 1, oxDb::getDb()->getOne( "select oxid from oxcategories where oxparentid = 'oxrootid'" ) );

        $oArticle = $this->getMock( "oxarticle", array( "inCategory" ) );
        $oArticle->expects( $this->once() )->method( 'inCategory' )->will( $this->returnValue( true ) );
            $oArticle->loadInLang(0, '8a142c410f55ed579.98106125');
            $sUrl = "en/".oxSeoEncoder::getInstance()->UNITprepareTitle($oCategory->oxcategories__oxtitle->value)."/Tischlampe+SPHERE+red.html";

        $oEncoder = $this->getMock('modSeoEncoderArticle', array('_loadFromDb', "_getCategory" ));
        $oEncoder->expects( $this->once() )->method( '_getCategory' )->will( $this->returnValue( $oCategory ) );
        $oEncoder->expects($this->any())->method( '_loadFromDb' )->will( $this->returnvalue(false) );
        $oEncoder->setSeparator( '+' );

        oxTestModules::addFunction("oxSeoEncoderCategory", "resetInst", '{oxSeoEncoderCategory::$_instance = null;}');
        oxNew('oxSeoEncoderCategory')->resetInst();
        oxDb::getDb()->execute( 'delete from oxseo where oxtype != "static"' );
        oxDb::getDb()->execute( 'delete from oxseohistory' );

        $this->assertEquals( $sUrl, $oEncoder->UNITgetArticleUri( $oArticle, 1 ) );
    }

    /**
     * Test case:
     * wrong article seo url preparation, must be
     *  Bierspiel-OANS-ZWOA-GSUFFA
     * but returns
     *  de/Spiele/Brettspiele/Bierspiel-OANS-ZWOA-GSUFFA-...
     */
    public function testGetArticleSeoLinkDe()
    {
        $oArticle = new oxarticle();

            $oArticle->loadInLang( 0, '1127' );
            $sExp = "Blinkende-Eiswuerfel-FLASH.html";

        $oEncoder = oxSeoEncoderArticle::getInstance();
        $oEncoder->setSeparator();
        $this->assertEquals( $sExp, $oEncoder->UNITprepareTitle( $oArticle->oxarticles__oxtitle->value.".html" ) );
    }


    /**
     * Test case:
     * article was saved, but title was left the same, testing if seo url is kept the same
     */
    public function testActicleIsSavedSeoUrlShouldStayTheSame()
    {
            $sArtId = '1131';

        $oArticle = new oxarticle();
        $oArticle->load( $sArtId );
        $oArticle->save();
        $sSeoUrl = $oArticle->getLink();

        $oArticle = new oxarticle();
        $oArticle->load( $sArtId );

        $this->assertEquals( $sSeoUrl, $oArticle->getLink(), "This test fails probably because of _getUniqueSeoUrl problems" );
    }

    /**
     * Test case:
     * new article with same title, seo url must contain "-oxid" prefix
     */
    public function testAddinNewArticleWithSameTitle()
    {
        $oArticle = new oxbase();
        $oArticle->init( 'oxarticles' );
        $oArticle->load( '2363' );
        $oArticle->oxarticles__oxtitle = new oxField(" testa");
        $oArticle->setId( 'testa' );
        $oArticle->save();

        $oArticle = new oxarticle();
        $oArticle->load( 'testa' );
        $sSeoUrl = $oArticle->getLink();

        $oArticle = new oxbase();
        $oArticle->init( 'oxarticles' );
        $oArticle->load( 'testa' );
        $oArticle->setId( 'testb' );
        $oArticle->save();

        $oArticle = new oxarticle();
        $oArticle->load( 'testb' );
        $sNewSeoUrl = $oArticle->getLink();

        $this->assertNotEquals( $sSeoUrl, $sNewSeoUrl );
    }


    public function testonDeleteArticle()
    {
        $art = new oxbase();
        $art->setId('article_id');

        $sSql = "delete from oxseo where oxobjectid = \'article_id\' and oxtype = \'oxarticle\'";
        modDB::getInstance()->addClassFunction('execute', create_function('$s', "if (\$s != '$sSql') {throw new Exception(\$s.\" \nis not equal \n\".'$sSql');}"));

        try {
            $o = new oxSeoEncoderArticle();
            $o->onDeleteArticle($art);
        } catch (Exception $e) {
            $this->fail($e->getMessage());
        }
    }

    public function testCreateArticleCategoryUri()
    {
        oxTestModules::addFunction('oxSeoEncoderCategory', 'getCategoryUri($c, $l)', '{return "caturl".$c->getId().$l;}');
        $oA   = $this->getMock('oxarticle', array('getLanguage', 'getId', 'getStdLink'));
        $oA->expects($this->never())->method('getLanguage');
        $oA->expects($this->any())->method('getId')->will($this->returnValue('articleId'));
        $oA->expects($this->any())->method('getStdLink')->with(
                $this->equalTo(1),
                $this->equalTo(array('cnid'=>'catId'))
            )->will($this->returnValue('articleStdLink'));

        $oC   = $this->getMock('oxcategory', array('getId'));
        $oC->expects($this->any())->method('getId')->will($this->returnValue('catId'));

        $oSEA = $this->getMock('oxSeoEncoderArticle', array('_getProductForLang', '_prepareArticleTitle', '_processSeoUrl', '_saveToDb'));
        $oSEA->expects($this->once())->method('_getProductForLang')->with($this->equalTo($oA), $this->equalTo(1))->will($this->returnValue($oA));
        $oSEA->expects($this->once())->method('_prepareArticleTitle')->with($this->equalTo($oA))->will($this->returnValue('articleTitle'));
        $oSEA->expects($this->once())->method('_processSeoUrl')->with(
                $this->equalTo("caturlcatId1articleTitle"),
                $this->equalTo('articleId'),
                $this->equalTo(1)
            )->will($this->returnValue('articleUrlReturned'));
        $oSEA->expects($this->once())->method('_saveToDb')->with(
                $this->equalTo("oxarticle"),
                $this->equalTo('articleId'),
                $this->equalTo("articleStdLink"),
                $this->equalTo('articleUrlReturned'),
                $this->equalTo(1),
                $this->equalTo(null),
                $this->equalTo(0),
                $this->equalTo(false),
                $this->equalTo(false),
                $this->equalTo('catId')
            )->will($this->returnValue(null));

        $this->assertEquals('articleUrlReturned', $oSEA->UNITcreateArticleCategoryUri( $oA, $oC, 1 ));
    }

    public function testGetArticleMainUrl()
    {
        $oA   = $this->getMock('oxarticle', array('getLanguage'));
        $oA->expects($this->any())->method('getLanguage')->will( $this->returnValue( 1 ));

        $oSEA = $this->getMock('oxSeoEncoderArticle', array('_getFullUrl', '_getArticleMainUri'));
        $oSEA->expects($this->once())->method('_getArticleMainUri')
            ->with(
                $this->equalTo($oA),
                $this->equalTo(1)
            )->will($this->returnValue('articleUri'));
        $oSEA->expects($this->once())->method('_getFullUrl')
            ->with(
                $this->equalTo('articleUri'),
                $this->equalTo(1)
            )->will($this->returnValue('articleUrlReturned'));

        $this->assertEquals('articleUrlReturned', $oSEA->getArticleMainUrl( $oA ));
    }
}