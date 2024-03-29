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
 * @version   SVN: $Id: oxutilspicTest.php 37095 2011-07-15 14:24:50Z arvydas.vapsva $
 */

require_once realpath( "." ).'/unit/OxidTestCase.php';
require_once realpath( "." ).'/unit/test_config.inc.php';

class Unit_Core_oxUtilsPicTest extends OxidTestCase
{
    /**
     * Initialize the fixture.
     *
     * @return null
     */
    protected function setUp()
    {
        parent::setUp();
        // preparing data for spec test
        switch ( $this->getName() ) {

            case "testDeletePictureExisting":

                $myConfig = oxConfig::getInstance();

                // setup-> create a copy of a picture and delete this one for successful test
                $sOrigTestPicFile   = "detail1_z3_ico_th.jpg";
                $sOrigTestIconFile  = "detail1_z3_ico_th.jpg"; // we simply fake an icon file by copying the same
                $sCloneTestPicFile  = "CCdetail1_z3_ico_th.jpg";
                $sCloneTestIconFile = "CCdetail1_z3_ico_th.jpg";

                $sDir  = $myConfig->getPictureDir(false)."master/product/thumb/";

                copy( $sDir.$sOrigTestPicFile, $sDir.$sCloneTestPicFile );
                copy( $sDir.$sOrigTestIconFile, $sDir.$sCloneTestIconFile );

                break;

        }
    }

    /**
     * Tear down the fixture.
     *
     * @return null
     */
    protected function tearDown()
    {
        // preparing data for spec test
        switch ( $this->getName() ) {

            case "testDeletePictureExisting":

                $myConfig = oxConfig::getInstance();

                // setup-> create a copy of a picture and delete this one for successful test
                $sCloneTestPicFile  = "CC1672_th.jpg";
                $sCloneTestIconFile = "CC1672_th_ico.jpg";

                $sDir  = $myConfig->getPictureDir(false)."/master/product/thumb/";

                @unlink( $sDir.$sCloneTestPicFile );
                @unlink( $sDir.$sCloneTestIconFile );

                break;
        }
        parent::tearDown();
    }

    public function testResizeImage()
    {
        $sTestImageFileJPG             = "test.jpg";
        $sTestImageFileJPGSmall        = "test_smaller.jpg";
        $sTestImageFileResizedJPG      = "test_resized.jpg";
        $sTestImageFileSmallResizedJPG = "test_smallresized.jpg";

        // actual test
        $this->assertTrue( $this->_resizeImageTest( $sTestImageFileJPG, $sTestImageFileResizedJPG ) );

        // do not resize smaller pics
        $this->assertFalse( $this->_resizeImageTest($sTestImageFileJPGSmall, $sTestImageFileSmallResizedJPG ) );

        $sTestImageFileGIF             = "test.gif";
        $sTestImageFileGIFSmall        = "test_smaller.gif";
        $sTestImageFileResizedGIF      = "test_resized.gif";
        $sTestImageFileSmallResizedGIF = "test_smallresized.gif";

        // actual test
        $this->assertTrue($this->_resizeImageTest( $sTestImageFileGIF, $sTestImageFileResizedGIF ) );

        // do not resize smaller pics
        $this->assertFalse($this->_resizeImageTest( $sTestImageFileGIFSmall, $sTestImageFileSmallResizedGIF ) );

        $sTestImageFilePNG             = "test.png";
        $sTestImageFilePNGSmall        = "test_smaller.png";
        $sTestImageFileResizedPNG      = "test_resized.png";
        $sTestImageFileSmallResizedPNG = "test_smallresized.png";

        // actual test
        $this->assertTrue( $this->_resizeImageTest( $sTestImageFilePNG, $sTestImageFileResizedPNG ) );

        // do not resize smaller pics
        $this->assertFalse( $this->_resizeImageTest( $sTestImageFilePNGSmall, $sTestImageFileSmallResizedPNG ) );

        // resizing according to height param
        $this->assertTrue( $this->_resizeImageTest( $sTestImageFilePNG, $sTestImageFileResizedPNG, 21, 10 ) );

        // checking if works with "gd 1"
        modConfig::getInstance()->setConfigParam( 'iUseGDVersion', 1 );
        $this->assertTrue( $this->_resizeImageTest( $sTestImageFilePNG, $sTestImageFileResizedPNG, 21, 10 ) );
    }

    protected function _resizeImageTest( $sTestImageFile, $sTestImageFileResized, $iWidth  = 100, $iHeight = 48 )
    {
        $sDir = "misc".DIRECTORY_SEPARATOR;
        if (!file_exists($sDir.$sTestImageFile)) {
            $sMsg = "Failed to find the image file: ".$sDir.$sTestImageFile;
            $this->fail($sMsg);
        }
        //actual test
        if ( !( oxUtilsPic::getInstance()->resizeImage( $sDir.$sTestImageFile, $sDir.$sTestImageFileResized, $iWidth, $iHeight, oxConfig::getInstance()->getConfigParam( 'iUseGDVersion' ), false ) ) ) {
            $this->fail("Failed to call resizeImage()");
        }

        if ( !is_file( $sDir.$sTestImageFileResized ) ) {
            $this->fail("Failed to find the resized image file.");
        }

        $aImageSizeResized = getImageSize($sDir.$sTestImageFileResized);
        $iImageResizedWidth = $aImageSizeResized[0];
        $iImageResizedHeight = $aImageSizeResized[1];
        if (($iImageResizedWidth == $iWidth ) && ($iImageResizedHeight == $iHeight)) {
            //echo "Width: $iImageResizedWidth - Height: $iImageResizedHeight";
            unlink( $sDir.$sTestImageFileResized );
            return true;
        }
        unlink($sDir.$sTestImageFileResized);
        return false;
    }

    /**
     * Testing image deletion code
     */
    // no deletion in demoshop is allowed
    public function testDeletePictureDemoshop()
    {
        //$oConfig = $this->getMock( 'oxconfig', array( 'hasModule' ) );
        $oConfig = $this->getMock( 'oxconfig' );

        $oUtilsPic = $this->getMock( 'oxutilspic', array( 'getConfig' ) );
        $oUtilsPic->expects( $this->once() )->method( 'getConfig')->will( $this->returnValue( $oConfig ) );

        $this->assertFalse( $oUtilsPic->UNITdeletePicture( 'xxx', 'yyy' ) );
    }
    // blank (nopic) images are not allowed to be deleted
    public function testDeletePictureBlankImages()
    {
        //$oConfig = $this->getMock( 'oxconfig', array( 'hasModule' ) );
        //$oConfig->expects( $this->exactly( 2 ) )->method( 'hasModule')->will( $this->returnValue( false ) );
        $oConfig = $this->getMock( 'oxconfig');

        $oUtilsPic = $this->getMock( 'oxutilspic', array( 'getConfig' ) );
        $oUtilsPic->expects( $this->exactly( 2 ) )->method( 'getConfig')->will( $this->returnValue( $oConfig ) );

        $this->assertFalse( $oUtilsPic->UNITdeletePicture( 'nopic.jpg', 'yyy' ) );
        $this->assertFalse( $oUtilsPic->UNITdeletePicture( 'nopic_ico.jpg', 'yyy' ) );
    }
    // deleting non existing
    public function testDeletePictureNonExisting()
    {
        //$oConfig = $this->getMock( 'oxconfig', array( 'hasModule' ) );
        //$oConfig->expects( $this->once() )->method( 'hasModule')->will( $this->returnValue( false ) );
        $oConfig = $this->getMock( 'oxconfig');

        $oUtilsPic = $this->getMock( 'oxutilspic', array( 'getConfig' ) );
        $oUtilsPic->expects( $this->once() )->method( 'getConfig')->will( $this->returnValue( $oConfig ) );

        $this->assertFalse( $oUtilsPic->UNITdeletePicture( time(), 'yyy' ) );
    }
    // deleting existing
    public function testDeletePictureExisting()
    {
        $oUtilsPic = new oxutilspic();
        $this->assertTrue( $oUtilsPic->UNITdeletePicture( 'CCdetail1_z3_ico_th.jpg', oxConfig::getInstance()->getPictureDir( false )."master/product/thumb/" ) );
    }

    public function testIsPicDeletable()
    {
        $myUtils =new oxUtilsPic();

        // testing
        modDB::getInstance()->addClassFunction( 'getOne', create_function( '$sql', 'return 1;' ) );
        $this->assertTrue( $myUtils->UNITisPicDeletable( "testOK.jpg", "test", "file" ) );

        modDB::getInstance()->addClassFunction('getOne', create_function('$sql', 'return 2;' ) );
        $this->assertFalse( $myUtils->UNITisPicDeletable( "testFail.jpg", "test", "file" ) );
        $this->assertFalse( $myUtils->UNITisPicDeletable( "nopic.jpg", "test", "file" ) );
    }

    /**
     * Testing OverwritePic logics
     */
    // bad input
    public function testOverwritePicBadInput()
    {
        $oUtilsPic = $this->getMock( 'oxutilspic', array( 'safePictureDelete' ) );
        $oUtilsPic->expects( $this->never() )->method( 'safePictureDelete');

        $blFalse = $oUtilsPic->overwritePic( new Oxstdclass(), 'xxx', 'xxx', '', '', '', '' );
        $this->assertFalse( $blFalse );
    }
    // params are not ok
    public function testOverwritePicBadParams()
    {
        $oUtilsPic = $this->getMock( 'oxutilspic', array( 'safePictureDelete' ) );
        $oUtilsPic->expects( $this->never() )->method( 'safePictureDelete');

        $oObject = new Oxstdclass();
        $oObject->oxtbl__oxpic = new oxField('yyy', oxField::T_RAW);

        $blFalse = $oUtilsPic->overwritePic( $oObject, 'oxtbl', 'oxpic', '', '', array( 'oxtbl__oxpic' => 'yyy' ), '' );
        $this->assertFalse( $blFalse );
    }
    // all is fine
    public function testOverwritePicGoodParams()
    {
        $oUtilsPic = $this->getMock( 'oxutilspic', array( 'safePictureDelete' ) );
        $oUtilsPic->expects( $this->once() )->method( 'safePictureDelete')->with( $this->equalTo( 'yyy' ), $this->equalTo( 'yyy' ), $this->equalTo( 'oxtbl' ), $this->equalTo( 'oxpic' ) )->will( $this->returnValue( true ) );

        $oObject = new Oxstdclass();
        $oObject->oxtbl__oxpic = new oxField('yyy', oxField::T_RAW);

        $blTrue = $oUtilsPic->overwritePic( $oObject, 'oxtbl', 'oxpic', '', '', array( 'oxtbl__oxpic' => 'xxx' ), 'yyy' );
        $this->assertTrue( $blTrue );
    }

    // Test if corect path to file is generated (M:1268)
    public function testOverwritePic_generatesCorectFilePath()
    {
        $oUtilsPic = $this->getMock( 'oxutilspic', array( 'safePictureDelete' ) );
        $oUtilsPic->expects( $this->once() )->method( 'safePictureDelete')->with( $this->equalTo( 'testPictureName' ), $this->equalTo( 'testAbsPath/testPath' ) );

        $oObject = new Oxstdclass();
        $oObject->oxtbl__oxpic = new oxField('testPictureName', oxField::T_RAW);

        $blTrue = $oUtilsPic->overwritePic( $oObject, 'oxtbl', 'oxpic', 'testType', 'testPath', array( 'oxtbl__oxpic' => 'xxx' ), 'testAbsPath/' );
    }

    /**
     * Testing safe deletion code
     */
    // deeper code must not allow deletion
    public function testSafePictureDeleteMustFailDeletion()
    {
        $oUtilsPic = $this->getMock( 'oxutilspic', array( '_isPicDeletable', '_deletePicture' ) );
        $oUtilsPic->expects( $this->once() )->method( '_isPicDeletable')->will( $this->returnValue( false ) );
        $oUtilsPic->expects( $this->never() )->method( '_deletePicture');

        $this->assertFalse( $oUtilsPic->safePictureDelete( '', '', '', '' ) );
    }
    //
    public function testSafePictureDeleteMustSucceed()
    {
        $oUtilsPic = $this->getMock( 'oxutilspic', array( '_isPicDeletable', '_deletePicture' ) );
        $oUtilsPic->expects( $this->once() )->method( '_isPicDeletable')->will( $this->returnValue( true ) );
        $oUtilsPic->expects( $this->once() )->method( '_deletePicture')->will( $this->returnValue( true ) );

        $this->assertTrue( $oUtilsPic->safePictureDelete( '', '', '', '' ) );
    }

    public function testResizeGif()
    {
        $sTestImageFileGIF = "test.gif";
        $sTestImageFileResizedGIF = "test_resized_ResizeGIF.gif";

        // actual test
        $this->assertTrue( $this->_resizeGIFTest( $sTestImageFileGIF, $sTestImageFileResizedGIF ) );

        // checking if works with "gd 1"
        $this->assertTrue( $this->_resizeGIFTest( $sTestImageFileGIF, $sTestImageFileResizedGIF, 1 ) );
    }

    protected function _resizeGIFTest($sTestImageFile, $sTestImageFileResized, $gdver = 2 )
    {

        $myUtils =new oxUtilsPic();
        $myConfig = oxConfig::getInstance();
        $sDir = "misc".DIRECTORY_SEPARATOR;
        $iWidth = 100;
        $iHeight = 48;
        if (!file_exists($sDir.$sTestImageFile)) {
            $sMsg = "Failed to find the GIF file: ".$sDir.$sTestImageFile;
            $this->fail($sMsg);
        }
        $aImageSizeOriginal = getImageSize($sDir.$sTestImageFile);
        $iImageOriginalWidth = $aImageSizeOriginal[0];
        $iImageOriginalHeight = $aImageSizeOriginal[1];
        //actual test
        if (!($myUtils->UNITresizeGif($sDir.$sTestImageFile, $sDir.$sTestImageFileResized, $iWidth, $iHeight, $iImageOriginalWidth, $iImageOriginalHeight, $gdver, false))) {
            $this->fail("Failed to call resizeGIF()");
        }
        if (!is_file($sDir.$sTestImageFileResized)) {
            $this->fail("Failed to find the resized image file.");
        }
        $aImageSizeResized = getImageSize($sDir.$sTestImageFileResized);
        $iImageResizedWidth = $aImageSizeResized[0];
        $iImageResizedHeight = $aImageSizeResized[1];
        if (($iImageResizedWidth == $iWidth ) && ($iImageResizedHeight == $iHeight)) {
            unlink($sDir.$sTestImageFileResized);
            return true;
        }
        unlink($sDir.$sTestImageFileResized);
        return false;
    }
}
