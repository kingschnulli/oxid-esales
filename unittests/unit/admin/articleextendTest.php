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
 * @version   SVN: $Id: articleextendTest.php 38538 2011-09-05 09:03:51Z linas.kukulskis $
 */

require_once realpath( "." ).'/unit/OxidTestCase.php';
require_once realpath( "." ).'/unit/test_config.inc.php';

/**
 * Tests for Article_Extend class
 */
class Unit_Admin_ArticleExtendTest extends OxidTestCase
{
    /**
     * Tear down the fixture.
     *
     * @return null
     */
    protected function tearDown()
    {
        oxDb::getDb()->execute( "delete from oxmediaurls" );
        parent::tearDown();
    }

    /**
     * Article_Extend::Render() test case
     *
     * @return null
     */
    public function testRender()
    {
        oxTestModules::addFunction('oxarticle', 'isDerived', '{ return true; }');
        modConfig::setParameter( "oxid", oxDb::getDb()->getOne( "select oxid from oxarticles where oxparentid !='' " ) );

        // testing..
        $oView = new Article_Extend();
        $sTplName = $oView->render();

        // testing view data
        $aViewData = $oView->getViewData();
        $this->assertTrue( $aViewData["edit"] instanceof oxArticle );
        $this->assertTrue( $aViewData["artcattree"] instanceof oxCategoryList );
        $this->assertTrue( $aViewData["aMediaUrls"] instanceof oxList );

        $this->assertEquals( 'article_extend.tpl', $sTplName );
    }

    /**
     * Article_Extend::Save() test case
     *
     * @return null
     */
    public function testSave()
    {
        // testing..
        oxTestModules::addFunction( 'oxarticle', 'save', '{ throw new Exception( "save" ); }');
        modConfig::setParameter( "editval", array( "oxarticles__oxtprice" => -1 ) );

        // testing..
        try {
            $oView = new Article_Extend();
            $oView->save();
        } catch ( Exception $oExcp ) {
            $this->assertEquals( "save", $oExcp->getMessage(), "error in Article_Extend::save()" );
            return;
        }
        $this->fail( "error in Article_Extend::save()" );
    }

    /**
     * Article_Extend::Save() test case
     *
     * @return null
     */
    public function testSaveMissingMediaDescription()
    {
        // testing..
        oxTestModules::addFunction( 'oxarticle', 'save', '{}');
        oxTestModules::addFunction( 'oxUtilsView', 'addErrorToDisplay', '{return "EXCEPTION_NODESCRIPTIONADDED";}');
        modConfig::setParameter( "mediaUrl", "testUrl" );
        modConfig::setParameter( "mediaDesc", null );

        // testing..
        $oView = new Article_Extend();
        $this->assertEquals( "EXCEPTION_NODESCRIPTIONADDED", $oView->save() );
    }

    /**
     * Article_Extend::Save() test case
     *
     * @return null
     */
    public function testSaveMissingMediaUrlAndFile()
    {
        // testing..
        oxTestModules::addFunction( 'oxarticle', 'save', '{}');
        oxTestModules::addFunction( 'oxUtilsView', 'addErrorToDisplay', '{return "EXCEPTION_NOMEDIAADDED";}');
        oxTestModules::addFunction( 'oxConfig', 'getUploadedFile', '{return array( "name" => false );}');

        modConfig::setParameter( "mediaUrl", null );
        modConfig::setParameter( "mediaDesc", "testDesc" );

        // testing..
        $oView = new Article_Extend();
        $this->assertEquals( "EXCEPTION_NOMEDIAADDED", $oView->save() );
    }

    /**
     * Article_Extend::Save() test case
     *
     * @return null
     */
    public function testSaveUnableToMoveUploadedFile()
    {
        // testing..
        oxTestModules::addFunction( 'oxarticle', 'save', '{}');
        oxTestModules::addFunction( 'oxUtilsView', 'addErrorToDisplay', '{ return $aA[0]; }');
        oxTestModules::addFunction( 'oxUtilsFile', 'processFile', '{ throw new Exception("handleUploadedFile"); }');

        modConfig::setParameter( "mediaUrl", "testUrl" );
        modConfig::setParameter( "mediaDesc", "testDesc" );

        $oConfig = $this->getMock( "oxStdClass", array( "getUploadedFile" ) );
        $oConfig->expects( $this->once() )->method( 'getUploadedFile' )->will( $this->returnValue( array( "name" => "testName" ) ) );

        // testing..
        $oView = $this->getMock( "Article_Extend", array( "getConfig", "resetContentCache" ), array(), '', false );
        $oView->expects( $this->once() )->method( 'getConfig' )->will( $this->returnValue( $oConfig ) );
        $oView->expects( $this->any() )->method( 'resetContentCache' );
        $this->assertEquals( "handleUploadedFile", $oView->save() );
    }

    /**
     * Article_Extend::Save() test case
     *
     * @return null
     */
    public function testSaveMediaFileUpload()
    {
        // testing..
        oxTestModules::addFunction( 'oxarticle', 'save', '{}');
        oxTestModules::addFunction( 'oxmediaurl', 'save', '{ throw new Exception( "oxmediaurl.save" ); }');
        oxTestModules::addFunction( 'oxUtilsFile', 'processFile', '{}');

        modConfig::setParameter( "mediaUrl", "testUrl" );
        modConfig::setParameter( "mediaDesc", "testDesc" );

        $oConfig = $this->getMock( "oxStdClass", array( "getUploadedFile" ) );
        $oConfig->expects( $this->once() )->method( 'getUploadedFile' )->will( $this->returnValue( array( "name" => "testName" ) ) );

        // testing..
        $oView = $this->getMock( "Article_Extend", array( "getConfig", "resetContentCache" ), array(), '', false );
        $oView->expects( $this->once() )->method( 'getConfig' )->will( $this->returnValue( $oConfig ) );
        $oView->expects( $this->any() )->method( 'resetContentCache' );


        // testing..
        try {
            $oView->save();
        } catch ( Exception $oExcp ) {
            $this->assertEquals( "oxmediaurl.save", $oExcp->getMessage(), "error in Article_Extend::save()" );
            return;
        }
        $this->fail( "error in Article_Extend::save()" );
    }

    /**
     * Article_Extend::Deletemedia() test case
     *
     * @return null
     */
    public function testDeletemedia()
    {
        $oMediaUrl = oxNew("oxMediaUrl");
        $oMediaUrl->setId( "testMediaId" );
        $oMediaUrl->save();

        $this->assertTrue( (bool) oxDb::getDb()->getOne( "select 1 from oxmediaurls where oxid = 'testMediaId'" ) );

        modConfig::setParameter( "oxid", "testId" );
        modConfig::setParameter( "mediaid", "testMediaId" );

        // testing..
        $oView = new Article_Extend();
        $oView->deletemedia();

        $this->assertFalse( oxDb::getDb()->getOne( "select 1 from oxmediaurls where oxid = 'testMediaId'" ) );
    }

    /**
     * Article_Extend::AddDefaultValues() test case
     *
     * @return null
     */
    public function testAddDefaultValues()
    {
        $aParams['oxarticles__oxexturl'] = "http://www.delfi.lt";
        $oView = new Article_Extend();
        $aParams = $oView->addDefaultValues( $aParams );

        $this->assertEquals( "www.delfi.lt", $aParams['oxarticles__oxexturl'] );
    }

    /**
     * Article_Extend::UpdateMedia() test case
     *
     * @return null
     */
    public function testUpdateMedia()
    {
        $oMediaUrl = oxNew("oxMediaUrl");
        $oMediaUrl->setId( "testMediaId" );
        $oMediaUrl->save();

        $aValue = array( "testMediaId" => array( "oxmediaurls__oxurl" => "testUrl", "oxmediaurls__oxdesc" => "testDesc" ) );
        modConfig::setParameter( "aMediaUrls", $aValue );

        $oView = new Article_Extend();
        $oView->updateMedia();

        $this->assertTrue( (bool) oxDb::getDb()->getOne( "select 1 from oxmediaurls where oxurl = 'testUrl' and oxdesc='testDesc' ") );
    }

}
