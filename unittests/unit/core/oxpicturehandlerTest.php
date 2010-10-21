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
 * @version   SVN: $Id: oxoutputTest.php 25404 2010-01-28 01:26:44Z alfonsas $
 */

require_once realpath( "." ).'/unit/OxidTestCase.php';
require_once realpath( "." ).'/unit/test_config.inc.php';

class Unit_Core_oxPictureHandlerTest extends OxidTestCase
{

    /**
     * Initialize the fixture.
     *
     * @return null
     */
    protected function setUp()
    {
        parent::setUp();
    }

    /**
     * Tear down the fixture.
     *
     * @return null
     */
    public function tearDown()
    {
        parent::tearDown();
    }

    /**
     * Testing master picture name getter
     */
    public function testGetArticleMasterPictureName()
    {
        $oArticle = new oxArticle();
        $oArticle->oxarticles__oxpic1 = new oxField( "testPic_p1.jpg" );

        $oPicHandler = $this->getMock( 'oxPictureHandler', array( '_getBaseMasterImageFileName' ) );
        $oPicHandler->expects( $this->once() )->method( '_getBaseMasterImageFileName' )->with( $this->equalTo( 'testPic_p1.jpg' ) )->will( $this->returnValue( "testPic.jpg" ) );

        $this->assertEquals( 'testPic.jpg', $oPicHandler->UNITgetArticleMasterPictureName( $oArticle, 1 ) );
    }

    /**
     * Testing icon name getter
     */
    public function testGetIconName()
    {
        $oPicHandler = $this->getProxyClass( 'oxPictureHandler' );

        $this->assertEquals( 'test_ico.jpg', $oPicHandler->getIconName( "test.jpg" ) );
        $this->assertEquals( 'test_p1_ico.jpg', $oPicHandler->getIconName( "test_p1.jpg" ) );
    }

    /**
     * Testing main icon name getter
     */
    public function testGetMainIconName()
    {
        $oPicHandler = $this->getMock( 'oxPictureHandler', array( '_getBaseMasterImageFileName' ) );
        $oPicHandler->expects( $this->once() )->method( '_getBaseMasterImageFileName' )->with( $this->equalTo( 'testPic_p1.jpg' ) )->will( $this->returnValue( "testPic.jpg" ) );

        $this->assertEquals( 'testPic_ico.jpg', $oPicHandler->getMainIconName( "testPic_p1.jpg" ) );
    }

    /**
     * Testing thumbnail name getter
     */
    public function testGetThumbName()
    {
        $oPicHandler = $this->getMock( 'oxPictureHandler', array( '_getBaseMasterImageFileName' ) );
        $oPicHandler->expects( $this->once() )->method( '_getBaseMasterImageFileName' )->with( $this->equalTo( 'testPic_p1.jpg' ) )->will( $this->returnValue( "testPic.jpg" ) );

        $this->assertEquals( 'testPic_th.jpg', $oPicHandler->getThumbName( "testPic_p1.jpg" ) );
    }

    /**
     * Testing zoom picture name getter
     */
    public function testGetZoomName()
    {
        $oPicHandler = $this->getMock( 'oxPictureHandler', array( '_getBaseMasterImageFileName' ) );
        $oPicHandler->expects( $this->once() )->method( '_getBaseMasterImageFileName' )->with( $this->equalTo( 'testPic_p1.jpg' ) )->will( $this->returnValue( "testPic.jpg" ) );

        $this->assertEquals( 'testPic_z1.jpg', $oPicHandler->getZoomName( "testPic_p1.jpg", 1 ) );
    }

    /**
     * Testing master image base name getter
     */
    public function testGetBaseMasterImageFileName()
    {
        $oPicHandler = $this->getProxyClass( 'oxPictureHandler' );

        $this->assertEquals( 'testPic.jpg', $oPicHandler->UNITgetBaseMasterImageFileName( "testPic_p1.jpg" ) );
        $this->assertEquals( 'testPic2.jpg', $oPicHandler->UNITgetBaseMasterImageFileName( "testPic2.jpg" ) );
        $this->assertEquals( 'testPic3.jpg', $oPicHandler->UNITgetBaseMasterImageFileName( "bla/testPic3.jpg" ) );
    }

    /**
     * Testing generating article pictures
     */
    public function testGenerateArticlePictures()
    {
        // fixtures for file uploading

        $sPictureDir = oxConfig::getInstance()->getPictureDir( false );
        $sMasterPicPath = $sPictureDir . "master/1/1126_p1.jpg";

        $aFiles1['myfile']['name']["P1@oxarticles__oxpic1"] = "testNewPic1.jpg";
        $aFiles1['myfile']['tmp_name']["P1@oxarticles__oxpic1"] = $sMasterPicPath;

        $aFiles1['myfile']['name']["Z1@oxarticles__oxzoom1"] = "testNewPic1.jpg";
        $aFiles1['myfile']['tmp_name']["Z1@oxarticles__oxzoom1"] = $sMasterPicPath;

        $aFiles2['myfile']['name']["TH@oxarticles__oxthumb"] = "testNewPic1.jpg";
        $aFiles2['myfile']['tmp_name']["TH@oxarticles__oxthumb"] = $sMasterPicPath;

        $aFiles2['myfile']['name']["ICO@oxarticles__oxicon"] = "testNewPic1.jpg";
        $aFiles2['myfile']['tmp_name']["ICO@oxarticles__oxicon"] = $sMasterPicPath;

        //test article
        $oArticle = $this->getMock( 'oxArticle', array( 'updateAmountOfGeneratedPictures' ) );
        $oArticle->expects( $this->once() )->method( 'updateAmountOfGeneratedPictures' )->with( $this->equalTo( 1 ) );

        $oArticle->oxarticles__oxpicsgenerated = new oxField( 0 );
        $oArticle->oxarticles__oxpic1 = new oxField( "1126_p1.jpg" );

        // testing functions calls
        $oUtilsFile = $this->getMock( 'oxUtilsFile', array( 'processFiles' ) );
        $oUtilsFile->expects( $this->at(0) )->method( 'processFiles' )->with( $this->isInstanceOf( 'oxArticle' ), $this->equalTo( $aFiles1 ), $this->equalTo( true ) );
        $oUtilsFile->expects( $this->at(1) )->method( 'processFiles' )->with( $this->equalTo( null ), $this->equalTo( $aFiles2 ), $this->equalTo( true ) );

        modInstances::addMod( "oxUtilsFile", $oUtilsFile );

        $oPicHandler = $this->getMock( 'oxPictureHandler', array( '_getArticleMasterPictureName' ) );
        $oPicHandler->expects( $this->once() )->method( '_getArticleMasterPictureName' )->will( $this->returnValue( "testNewPic1.jpg" ) );

        $oPicHandler->generateArticlePictures( $oArticle, 1 );
    }

    /**
     * Testing generating article pictures skips icon and thumbnail generation if pic
     * index is higher than 1
     */
    public function testGenerateArticlePictures_skipsIconAndThumbnail()
    {
        //test article
        $oArticle = $this->getMock( 'oxArticle', array( 'updateAmountOfGeneratedPictures' ) );
        $oArticle->expects( $this->once() )->method( 'updateAmountOfGeneratedPictures' )->with( $this->equalTo( 2 ) );

        $oArticle->oxarticles__oxpicsgenerated = new oxField( 1 );
        $oArticle->oxarticles__oxpic2 = new oxField( "1126_p2.jpg" );

        // testing functions calls
        $oUtilsFile = $this->getMock( 'oxUtilsFile', array( 'processFiles' ) );
        $oUtilsFile->expects( $this->once() )->method( 'processFiles' );

        modInstances::addMod( "oxUtilsFile", $oUtilsFile );

        $oPicHandler = $this->getMock( 'oxPictureHandler', array( '_getArticleMasterPictureName' ) );
        $oPicHandler->expects( $this->once() )->method( '_getArticleMasterPictureName' )->will( $this->returnValue( "testNewPic1.jpg" ) );

        $oPicHandler->generateArticlePictures( $oArticle, 2 );
    }

    /**
     * Testing generating article pictures skips pictures generation if
     * picture is already generated
     */
    public function testGenerateArticlePictures_alreadyGeneerated()
    {
        //test article
        $oArticle = $this->getMock( 'oxArticle', array( 'updateAmountOfGeneratedPictures' ) );
        $oArticle->expects( $this->never() )->method( 'updateAmountOfGeneratedPictures' );

        $oArticle->oxarticles__oxpicsgenerated = new oxField( 2 );
        $oArticle->oxarticles__oxpic2 = new oxField( "1126_p2.jpg" );

        // testing functions calls
        $oUtilsFile = $this->getMock( 'oxUtilsFile', array( 'processFiles' ) );
        $oUtilsFile->expects( $this->never() )->method( 'processFiles' );

        modInstances::addMod( "oxUtilsFile", $oUtilsFile );

        $oPicHandler = $this->getMock( 'oxPictureHandler', array( '_getArticleMasterPictureName' ) );
        $oPicHandler->expects( $this->never() )->method( '_getArticleMasterPictureName' );

        $oPicHandler->generateArticlePictures( $oArticle, 2 );
    }

    /**
     * Testing generating article pictures skips pictures generation if
     * picture does not exists
     */
    public function testGenerateArticlePictures_pictureDoesNotExists()
    {
        //test article
        $oArticle = $this->getMock( 'oxArticle', array( 'updateAmountOfGeneratedPictures' ) );
        $oArticle->expects( $this->never() )->method( 'updateAmountOfGeneratedPictures' );

        $oArticle->oxarticles__oxpicsgenerated = new oxField( 1 );
        $oArticle->oxarticles__oxpic2 = new oxField( "noSuchPic.jpg" );

        // testing functions calls
        $oUtilsFile = $this->getMock( 'oxUtilsFile', array( 'processFiles' ) );
        $oUtilsFile->expects( $this->never() )->method( 'processFiles' );

        modInstances::addMod( "oxUtilsFile", $oUtilsFile );

        $oPicHandler = $this->getMock( 'oxPictureHandler', array( '_getArticleMasterPictureName' ) );
        $oPicHandler->expects( $this->never() )->method( '_getArticleMasterPictureName' );

        $oPicHandler->generateArticlePictures( $oArticle, 2 );
    }

    /**
     * Testing deleting article master picture and all generated pictures
     */
    public function testDeleteArticleMasterPicture()
    {
        $sAbsImageDir = oxConfig::getInstance()->getAbsDynImageDir();

        $aDelPics[0] = array("sField"    => "oxpic1",
                            "sDir"      => "master/1/",
                            "sFileName" => "testPic1.jpg");

        $aDelPics[1] = array("sField"    => "oxpic1",
                            "sDir"      => "1/",
                            "sFileName" => "testPic1.jpg");

        $aDelPics[2] = array("sField"    => "oxpic1",
                            "sDir"      => "z1/",
                            "sFileName" => "testZoomPic1.jpg");

        $aDelPics[3] = array("sField"    => "oxpic1",
                            "sDir"      => "icon/",
                            "sFileName" => "testIco1.jpg");

        $aDelPics[4] = array("sField"    => "oxpic1",
                            "sDir"      => "0/",
                            "sFileName" => "testThumb1.jpg");

        //test article
        $oArticle = new oxArticle();
        $oArticle->oxarticles__oxpic1 = new oxField( "testPic1.jpg" );

        // testing functions calls
        $oUtilsPic = $this->getMock( 'oxUtilsPic', array( 'safePictureDelete' ) );
        $oUtilsPic->expects( $this->at( 0 ) )->method( 'safePictureDelete' )->with( $this->equalTo( $aDelPics[0]["sFileName"] ), $this->equalTo( $sAbsImageDir.$aDelPics[0]["sDir"] ), $this->equalTo( "oxarticles" ), $this->equalTo( $aDelPics[0]["sField"] ) );
        $oUtilsPic->expects( $this->at( 1 ) )->method( 'safePictureDelete' )->with( $this->equalTo( $aDelPics[1]["sFileName"] ), $this->equalTo( $sAbsImageDir.$aDelPics[1]["sDir"] ), $this->equalTo( "oxarticles" ), $this->equalTo( $aDelPics[1]["sField"] ) );
        $oUtilsPic->expects( $this->at( 2 ) )->method( 'safePictureDelete' )->with( $this->equalTo( $aDelPics[2]["sFileName"] ), $this->equalTo( $sAbsImageDir.$aDelPics[2]["sDir"] ), $this->equalTo( "oxarticles" ), $this->equalTo( $aDelPics[2]["sField"] ) );
        $oUtilsPic->expects( $this->at( 3 ) )->method( 'safePictureDelete' )->with( $this->equalTo( $aDelPics[3]["sFileName"] ), $this->equalTo( $sAbsImageDir.$aDelPics[3]["sDir"] ), $this->equalTo( "oxarticles" ), $this->equalTo( $aDelPics[3]["sField"] ) );
        $oUtilsPic->expects( $this->at( 4 ) )->method( 'safePictureDelete' )->with( $this->equalTo( $aDelPics[4]["sFileName"] ), $this->equalTo( $sAbsImageDir.$aDelPics[4]["sDir"] ), $this->equalTo( "oxarticles" ), $this->equalTo( $aDelPics[4]["sField"] ) );

        modInstances::addMod( "oxUtilsPic", $oUtilsPic );

        $oPicHandler = $this->getMock( 'oxPictureHandler', array( 'getZoomName', 'getMainIconName', 'getThumbName' ) );
        $oPicHandler->expects( $this->any() )->method( 'getZoomName' )->will( $this->returnValue( "testZoomPic1.jpg" ) );
        $oPicHandler->expects( $this->any() )->method( 'getMainIconName' )->will( $this->returnValue( "testIco1.jpg" ) );
        $oPicHandler->expects( $this->any() )->method( 'getThumbName' )->will( $this->returnValue( "testThumb1.jpg" ) );

        $oPicHandler->deleteArticleMasterPicture( $oArticle, 1, true );
    }

    /**
     * Testing deleting article master picture skips master picture
     */
    public function testDeleteArticleMasterPicture_skipsMasterPicture()
    {
        $sAbsImageDir = oxConfig::getInstance()->getAbsDynImageDir();

        $aDelPics[0] = array("sField"    => "oxpic1",
                            "sDir"      => "1/",
                            "sFileName" => "testPic1.jpg");

        $aDelPics[1] = array("sField"    => "oxpic1",
                            "sDir"      => "z1/",
                            "sFileName" => "testZoomPic1.jpg");

        $aDelPics[2] = array("sField"    => "oxpic1",
                            "sDir"      => "icon/",
                            "sFileName" => "testIco1.jpg");

        $aDelPics[3] = array("sField"    => "oxpic1",
                            "sDir"      => "0/",
                            "sFileName" => "testThumb1.jpg");

        //test article
        $oArticle = new oxArticle();
        $oArticle->oxarticles__oxpic1 = new oxField( "testPic1.jpg" );

        // testing functions calls
        $oUtilsPic = $this->getMock( 'oxUtilsPic', array( 'safePictureDelete' ) );
        $oUtilsPic->expects( $this->at( 0 ) )->method( 'safePictureDelete' )->with( $this->equalTo( $aDelPics[0]["sFileName"] ), $this->equalTo( $sAbsImageDir.$aDelPics[0]["sDir"] ), $this->equalTo( "oxarticles" ), $this->equalTo( $aDelPics[0]["sField"] ) );
        $oUtilsPic->expects( $this->at( 1 ) )->method( 'safePictureDelete' )->with( $this->equalTo( $aDelPics[1]["sFileName"] ), $this->equalTo( $sAbsImageDir.$aDelPics[1]["sDir"] ), $this->equalTo( "oxarticles" ), $this->equalTo( $aDelPics[1]["sField"] ) );
        $oUtilsPic->expects( $this->at( 2 ) )->method( 'safePictureDelete' )->with( $this->equalTo( $aDelPics[2]["sFileName"] ), $this->equalTo( $sAbsImageDir.$aDelPics[2]["sDir"] ), $this->equalTo( "oxarticles" ), $this->equalTo( $aDelPics[2]["sField"] ) );
        $oUtilsPic->expects( $this->at( 3 ) )->method( 'safePictureDelete' )->with( $this->equalTo( $aDelPics[3]["sFileName"] ), $this->equalTo( $sAbsImageDir.$aDelPics[3]["sDir"] ), $this->equalTo( "oxarticles" ), $this->equalTo( $aDelPics[3]["sField"] ) );

        modInstances::addMod( "oxUtilsPic", $oUtilsPic );

        $oPicHandler = $this->getMock( 'oxPictureHandler', array( 'getZoomName', 'getMainIconName', 'getThumbName' ) );
        $oPicHandler->expects( $this->any() )->method( 'getZoomName' )->will( $this->returnValue( "testZoomPic1.jpg" ) );
        $oPicHandler->expects( $this->any() )->method( 'getMainIconName' )->will( $this->returnValue( "testIco1.jpg" ) );
        $oPicHandler->expects( $this->any() )->method( 'getThumbName' )->will( $this->returnValue( "testThumb1.jpg" ) );

        $oPicHandler->deleteArticleMasterPicture( $oArticle, 1, false );
    }

    /**
     * Testing deleting article master picture skips thumbnail and main icon delete
     * if custom fields values are equal to generated values
     */
    public function testDeleteArticleMasterPicture_skipsIfDefinedCustomFields()
    {
        $sAbsImageDir = oxConfig::getInstance()->getAbsDynImageDir();

        $aDelPics[0] = array("sField"    => "oxpic1",
                            "sDir"      => "1/",
                            "sFileName" => "testPic1.jpg");

        $aDelPics[1] = array("sField"    => "oxpic1",
                            "sDir"      => "z1/",
                            "sFileName" => "testZoomPic1.jpg");

        //test article
        $oArticle = new oxArticle();
        $oArticle->oxarticles__oxpic1  = new oxField( "testPic1.jpg" );
        $oArticle->oxarticles__oxthumb = new oxField( "testThumb1.jpg" );
        $oArticle->oxarticles__oxicon  = new oxField( "testIco1.jpg" );

        // testing functions calls
        $oUtilsPic = $this->getMock( 'oxUtilsPic', array( 'safePictureDelete' ) );
        $oUtilsPic->expects( $this->exactly( 2 ) )->method( 'safePictureDelete' );
        $oUtilsPic->expects( $this->at( 0 ) )->method( 'safePictureDelete' )->with( $this->equalTo( $aDelPics[0]["sFileName"] ), $this->equalTo( $sAbsImageDir.$aDelPics[0]["sDir"] ), $this->equalTo( "oxarticles" ), $this->equalTo( $aDelPics[0]["sField"] ) );
        $oUtilsPic->expects( $this->at( 1 ) )->method( 'safePictureDelete' )->with( $this->equalTo( $aDelPics[1]["sFileName"] ), $this->equalTo( $sAbsImageDir.$aDelPics[1]["sDir"] ), $this->equalTo( "oxarticles" ), $this->equalTo( $aDelPics[1]["sField"] ) );

        modInstances::addMod( "oxUtilsPic", $oUtilsPic );

        $oPicHandler = $this->getMock( 'oxPictureHandler', array( 'getZoomName', 'getMainIconName', 'getThumbName' ) );
        $oPicHandler->expects( $this->any() )->method( 'getZoomName' )->will( $this->returnValue( "testZoomPic1.jpg" ) );
        $oPicHandler->expects( $this->any() )->method( 'getMainIconName' )->will( $this->returnValue( "testIco1.jpg" ) );
        $oPicHandler->expects( $this->any() )->method( 'getThumbName' )->will( $this->returnValue( "testThumb1.jpg" ) );

        $oPicHandler->deleteArticleMasterPicture( $oArticle, 1, false );
    }

    /**
     * Testing deleting article master picture - deletes custom oxzoom picture
     */
    public function testDeleteArticleMasterPicture_deletesCustomZoomPicture()
    {
        //test article
        $oArticle = new oxArticle();
        $oArticle->oxarticles__oxpic1  = new oxField( "testPic1.jpg" );
        $oArticle->oxarticles__oxzoom1 = new oxField( "testCustomZoom.jpg" );

        // testing functions calls
        $oUtilsPic = $this->getMock( 'oxUtilsPic', array( 'safePictureDelete' ) );
        $oUtilsPic->expects( $this->any() )->method( 'safePictureDelete' );

        modInstances::addMod( "oxUtilsPic", $oUtilsPic );

        $oPicHandler = $this->getMock( 'oxPictureHandler', array( 'deleteZoomPicture' ) );
        $oPicHandler->expects( $this->once() )->method( 'deleteZoomPicture' )->with( $this->isInstanceOf( "oxArticle" ), $this->equalTo( 1 ) );

        $oPicHandler->deleteArticleMasterPicture( $oArticle, 1, false );
    }

    /**
     * Testing deleting article master picture skips deleting if pic name is empty
     * or equal to 'nopic.jpg'
     */
    public function testDeleteArticleMasterPicture_emptyPic()
    {
        $sAbsImageDir = oxConfig::getInstance()->getAbsDynImageDir();

        //test article
        $oArticle = new oxArticle();
        $oArticle->oxarticles__oxpic1  = new oxField( "nopic.jpg" );

        // testing functions calls
        $oUtilsPic = $this->getMock( 'oxUtilsPic', array( 'safePictureDelete' ) );
        $oUtilsPic->expects( $this->never() )->method( 'safePictureDelete' );

        modInstances::addMod( "oxUtilsPic", $oUtilsPic );

        $oPicHandler = new oxPictureHandler();
        $oPicHandler->deleteArticleMasterPicture( $oArticle, 1, false );

        $oArticle->oxarticles__oxpic1  = new oxField( "" );
        $oPicHandler->deleteArticleMasterPicture( $oArticle, 1, false );
    }

    /**
     * Testing deleting article master picture uses basename of master picture filename
     */
    public function testDeleteArticleMasterPicture_usesBasename()
    {
        $sAbsImageDir = oxConfig::getInstance()->getAbsDynImageDir();

        $aDelPics[0] = array("sField"    => "oxpic1",
                            "sDir"      => "master/1/",
                            "sFileName" => "testPic1.jpg");

        //test article
        $oArticle = new oxArticle();
        $oArticle->oxarticles__oxpic1 = new oxField( "1/testPic1.jpg" );

        // testing functions calls
        $oUtilsPic = $this->getMock( 'oxUtilsPic', array( 'safePictureDelete' ) );
        $oUtilsPic->expects( $this->at( 0 ) )->method( 'safePictureDelete' )->with( $this->equalTo( $aDelPics[0]["sFileName"] ), $this->equalTo( $sAbsImageDir.$aDelPics[0]["sDir"] ), $this->equalTo( "oxarticles" ), $this->equalTo( $aDelPics[0]["sField"] ) );

        modInstances::addMod( "oxUtilsPic", $oUtilsPic );

        $oPicHandler = $this->getMock( 'oxPictureHandler', array( 'getZoomName', 'getMainIconName', 'getThumbName' ) );
        $oPicHandler->expects( $this->any() )->method( 'getZoomName' )->will( $this->returnValue( "testZoomPic1.jpg" ) );
        $oPicHandler->expects( $this->any() )->method( 'getMainIconName' )->will( $this->returnValue( "testIco1.jpg" ) );
        $oPicHandler->expects( $this->any() )->method( 'getThumbName' )->will( $this->returnValue( "testThumb1.jpg" ) );

        $oPicHandler->deleteArticleMasterPicture( $oArticle, 1, true );
    }


    /**
     * Testing deleting article main icon
     */
    public function testDeleteMainIcon()
    {
        $sAbsImageDir = oxConfig::getInstance()->getAbsDynImageDir();

        $aDelPics[0] = array("sField"    => "oxicon",
                            "sDir"      => "icon/",
                            "sFileName" => "testIcon.jpg");

        //test article
        $oArticle = new oxArticle();
        $oArticle->oxarticles__oxicon  = new oxField( "testIcon.jpg" );

        // testing functions calls
        $oUtilsPic = $this->getMock( 'oxUtilsPic', array( 'safePictureDelete' ) );
        $oUtilsPic->expects( $this->exactly( 1 ) )->method( 'safePictureDelete' );
        $oUtilsPic->expects( $this->at( 0 ) )->method( 'safePictureDelete' )->with( $this->equalTo( $aDelPics[0]["sFileName"] ), $this->equalTo( $sAbsImageDir.$aDelPics[0]["sDir"] ), $this->equalTo( "oxarticles" ), $this->equalTo( $aDelPics[0]["sField"] ) );

        modInstances::addMod( "oxUtilsPic", $oUtilsPic );

        $oPicHandler = new oxPictureHandler();

        $oPicHandler->deleteMainIcon( $oArticle );

    }

    /**
     * Testing deleting article main icon - empty icon value
     */
    public function testDeleteMainIcon_emptyValue()
    {
        //test article
        $oArticle = new oxArticle();
        $oArticle->oxarticles__oxicon  = new oxField( "" );

        // testing functions calls
        $oUtilsPic = $this->getMock( 'oxUtilsPic', array( 'safePictureDelete' ) );
        $oUtilsPic->expects( $this->never() )->method( 'safePictureDelete' );

        modInstances::addMod( "oxUtilsPic", $oUtilsPic );

        $oPicHandler = new oxPictureHandler();

        $oPicHandler->deleteMainIcon( $oArticle );

    }

    /**
     * Testing deleting article thumbnail
     */
    public function testDeleteThumbnail()
    {
        $sAbsImageDir = oxConfig::getInstance()->getAbsDynImageDir();

        $aDelPics[0] = array("sField"    => "oxthumb",
                            "sDir"      => "0/",
                            "sFileName" => "testThumb.jpg");

        //test article
        $oArticle = new oxArticle();
        $oArticle->oxarticles__oxthumb  = new oxField( "testThumb.jpg" );

        // testing functions calls
        $oUtilsPic = $this->getMock( 'oxUtilsPic', array( 'safePictureDelete' ) );
        $oUtilsPic->expects( $this->exactly( 1 ) )->method( 'safePictureDelete' );
        $oUtilsPic->expects( $this->at( 0 ) )->method( 'safePictureDelete' )->with( $this->equalTo( $aDelPics[0]["sFileName"] ), $this->equalTo( $sAbsImageDir.$aDelPics[0]["sDir"] ), $this->equalTo( "oxarticles" ), $this->equalTo( $aDelPics[0]["sField"] ) );

        modInstances::addMod( "oxUtilsPic", $oUtilsPic );

        $oPicHandler = new oxPictureHandler();

        $oPicHandler->deleteThumbnail( $oArticle );

    }

    /**
     * Testing deleting article thumbnail - empty icon value
     */
    public function testDeleteThumbnail_emptyValue()
    {
        //test article
        $oArticle = new oxArticle();
        $oArticle->oxarticles__oxthumb  = new oxField( "" );

        // testing functions calls
        $oUtilsPic = $this->getMock( 'oxUtilsPic', array( 'safePictureDelete' ) );
        $oUtilsPic->expects( $this->never() )->method( 'safePictureDelete' );

        modInstances::addMod( "oxUtilsPic", $oUtilsPic );

        $oPicHandler = new oxPictureHandler();

        $oPicHandler->deleteThumbnail( $oArticle );

    }

    /**
     * Testing deleting article zoom picture
     */
    public function testDeleteZoomPicture()
    {
        $sAbsImageDir = oxConfig::getInstance()->getAbsDynImageDir();
        oxTestModules::addFunction('oxDbMetaDataHandler', 'fieldExists', '{ return true; }');

        $aDelPics[0] = array("sField"    => "oxzoom2",
                             "sDir"      => "z2/",
                             "sFileName" => "testZoom2.jpg");

        //test article
        $oArticle = new oxArticle();
        $oArticle->oxarticles__oxzoom2 = new oxField( "testZoom2.jpg" );

        // testing functions calls
        $oUtilsPic = $this->getMock( 'oxUtilsPic', array( 'safePictureDelete' ) );
        $oUtilsPic->expects( $this->exactly( 1 ) )->method( 'safePictureDelete' );
        $oUtilsPic->expects( $this->at( 0 ) )->method( 'safePictureDelete' )->with( $this->equalTo( $aDelPics[0]["sFileName"] ), $this->equalTo( $sAbsImageDir.$aDelPics[0]["sDir"] ), $this->equalTo( "oxarticles" ), $this->equalTo( $aDelPics[0]["sField"] ) );

        modInstances::addMod( "oxUtilsPic", $oUtilsPic );

        $oPicHandler = new oxPictureHandler();

        $oPicHandler->deleteZoomPicture( $oArticle, 2 );
    }

    /**
     * Testing deleting article zoom picture - empty icon value
     */
    public function testDeleteZoomPicture_emptyValue()
    {
        oxTestModules::addFunction('oxDbMetaDataHandler', 'fieldExists', '{ return true; }');

        //test article
        $oArticle = new oxArticle();
        $oArticle->oxarticles__oxzoom1  = new oxField( "" );

        // testing functions calls
        $oUtilsPic = $this->getMock( 'oxUtilsPic', array( 'safePictureDelete' ) );
        $oUtilsPic->expects( $this->never() )->method( 'safePictureDelete' );

        modInstances::addMod( "oxUtilsPic", $oUtilsPic );

        $oPicHandler = new oxPictureHandler();

        $oPicHandler->deleteZoomPicture( $oArticle, 1 );
    }

}
