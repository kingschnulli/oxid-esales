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
 * @version   SVN: $Id: contentTest.php 28048 2010-06-01 14:52:17Z arvydas $
 */

require_once realpath( "." ).'/unit/OxidTestCase.php';
require_once realpath( "." ).'/unit/test_config.inc.php';

/**
 * Tests for content class
 */
class Unit_Views_contentTest extends OxidTestCase
{
    protected $_oObj = null;

    /**
     * Initialize the fixture.
     *
     * @return null
     */
    protected function setUp()
    {
        parent::setUp();
        $this->_oObj = new oxbase();
        $this->_oObj->init( 'oxcontents' );
        $this->_oObj->oxcontents__oxtitle = new oxField('test', oxField::T_RAW);
        $sShopId = modConfig::getInstance()->getShopId();
        $this->_oObj->oxcontents__oxshopid = new oxField($sShopId, oxField::T_RAW);
        $this->_oObj->oxcontents__oxloadid = new oxField('_testLoadId', oxField::T_RAW);
        $this->_oObj->oxcontents__oxcontent = new oxField("testcontentDE&, &, !@#$%^&*%$$&@'.,;p\"ss", oxField::T_RAW);
        $this->_oObj->oxcontents__oxcontent_1 = new oxField("testcontentENG&, &, !@#$%^&*%$$&@'.,;p\"ss", oxField::T_RAW);
        $this->_oObj->oxcontents__oxactive = new oxField('1', oxField::T_RAW);
        $this->_oObj->oxcontents__oxactive_1 = new oxField('1', oxField::T_RAW);
        $this->_oObj->save();

        $sOxid = $this->_oObj->getId();

        $this->_oObj = new oxcontent();
        $this->_oObj->load( $sOxid );
    }

    /**
     * Tear down the fixture.
     *
     * @return null
     */
    protected function tearDown()
    {
        $this->_oObj->delete();
        parent::tearDown();
    }

    /**
     * Test active content id getter when content id passed with tpl param.
     *
     * @return null
     */
    public function testGetContentIdIfAgb()
    {
        $sContentId = oxDb::getDb( true )->getOne( "SELECT oxid FROM oxcontents WHERE oxloadid = 'oxagb' " );
        modConfig::setParameter( 'oxcid', $sContentId );

        $oView = $this->getMock( "content", array( "getUser", "isActive" ), array(), '', false );
        $oView->expects( $this->once() )->method( 'getUser' )->will( $this->returnValue( false ) );
        $oView->expects( $this->once() )->method( 'isActive' )->will( $this->returnValue( true ) );
        // testing special chars conversion
        $this->assertEquals( $oView->getContentId(), $sContentId );
    }

    /**
     * Test active content id getter
     *
     * @return null
     */
    public function testGetContentNoUser()
    {
        oxTestModules::addFunction( 'oxUtils', 'redirect', '{ throw new Exception($aA[0]); }');

        modConfig::setParameter( 'oxcid', $this->_oObj->getId() );
        $oConfig = $this->getMock( "oxConfig", array( "getShopHomeURL" ) );
        $oConfig->expects( $this->once() )->method( 'getShopHomeURL' )->will( $this->returnValue( "testUrl" ) );

        try {
            // testing..
            $oView = $this->getMock( "content", array( "getUser", "getConfig", 'isActive' ), array(), '', false );
            $oView->expects( $this->once() )->method( 'getUser' )->will( $this->returnValue( false ) );
            $oView->expects( $this->once() )->method( 'getConfig' )->will( $this->returnValue( $oConfig ) );
            $oView->expects( $this->once() )->method( 'isActive' )->will( $this->returnValue( true ) );
            $oView->getContentId();
        } catch ( Exception $oExcp ) {
            $this->assertEquals( "testUrlcl=account", $oExcp->getMessage(), "Error in oxsclogincontent::getContentId()" );
            return;
        }
        $this->fail( "Error in content::getContentId()" );
    }

    /**
     * Test get subject.
     *
     * @return null
     */
    public function testGetSubject()
    {
        $oContentView = $this->getMock( 'content', array( 'getContent' ) );
        $oContentView->expects( $this->once() )->method( 'getContent')->will( $this->returnValue( 'testsubject' ) );
        $this->assertEquals( 'testsubject', $oContentView->UNITgetSubject( oxLang::getInstance()->getBaseLanguage() ) );
    }

    /**
     * Test get object seo id.
     *
     * @return null
     */
    public function testGetSeoObjectId()
    {
        modConfig::setParameter( 'oxcid', 'testseoobjectid' );

        $oContentView = new content();
        $this->assertEquals( 'testseoobjectid', $oContentView->UNITgetSeoObjectId() );
    }

    /**
     * Test get view id.
     *
     * @return null
     */
    public function testGetViewId()
    {
        modConfig::setParameter( 'oxcid', 'testparam' );

        $oView = new oxubase();
        $oContentView = new content();
        $this->assertEquals( $oView->getViewId().'|testparam', $oContentView->getViewId() );
    }

    /**
     * Test view render.
     *
     * @return null
     */
    public function testRender()
    {
        $oContentView = $this->getMock( 'content', array( 'getContentId', 'getContent', 'showPlainTemplate' ) );
        $oContentView->expects( $this->atLeastOnce() )->method( 'getContentId' )->will( $this->returnValue( 'testVal' ) );
        $oContentView->expects( $this->atLeastOnce() )->method( 'getContent' );
        $oContentView->expects( $this->atLeastOnce() )->method( 'showPlainTemplate' )->will( $this->returnValue( 'true' ) );
        $this->assertEquals( 'content_plain.tpl', $oContentView->render() );
    }

    /**
     * Test prepare meta keywords.
     *
     * @return null
     */
    public function testPrepareMetaKeyword()
    {
        $oContent = new oxarticle();
        $oContent->oxcontents__oxtitle = $this->getMock( 'oxField', array( '__get' ) );
        $oContent->oxcontents__oxtitle->expects( $this->once() )->method( '__get')->will( $this->returnValue( 'testtitle' ) );

        $oContentView = $this->getMock( 'content', array( 'getContent' ) );
        $oContentView->expects( $this->once() )->method( 'getContent')->will( $this->returnValue( $oContent ) );

        $oView = new oxubase();
        $this->assertEquals( $oView->UNITprepareMetaKeyword( 'testtitle' ), $oContentView->UNITprepareMetaKeyword( null ) );
    }

    /**
     * Test prepare meta description.
     *
     * @return null
     */
    public function testPrepareMetaDescription()
    {
        $oContent = new oxarticle();
        $oContent->oxcontents__oxtitle = $this->getMock( 'oxField', array( '__get' ) );
        $oContent->oxcontents__oxtitle->expects( $this->once() )->method( '__get')->will( $this->returnValue( 'testtitle' ) );

        $oContentView = $this->getMock( 'content', array( 'getContent' ) );
        $oContentView->expects( $this->once() )->method( 'getContent')->will( $this->returnValue( $oContent ) );

        $oView = new oxubase();
        $this->assertEquals( $oView->UNITprepareMetaDescription( 'testtitle' ), $oContentView->UNITprepareMetaDescription( null ) );
    }

    /**
     * Test get content category without any assigned category.
     *
     * @return null
     */
    public function testGetContentCategoryNoCategoryAssigned()
    {
        $oView = $this->getMock( 'content', array( 'getContent' ) );
        $oView->expects( $this->once() )->method( 'getContent')->will( $this->returnValue( new oxcontent() ) );

        $this->assertFalse( $oView->getContentCategory() );
    }

    /**
     * Test get content category with assigned category.
     *
     * @return null
     */
    public function testGetContentCategorySomeCategoryAssigned()
    {
        $oContent = new oxcontent();
        $oContent->oxcontents__oxtype = new oxfield( 2 );

        $oView = $this->getMock( 'content', array( 'getContent' ) );
        $oView->expects( $this->once() )->method( 'getContent')->will( $this->returnValue( $oContent ) );

        $this->assertEquals( $oContent, $oView->getContentCategory() );
    }

    /**
     * Test show plain template.
     *
     * @return null
     */
    public function testShowPlainTemplate()
    {
        modConfig::setParameter( 'plain', 0 );
        $oView = new content();
        $this->assertFalse( $oView->showPlainTemplate() );

        modConfig::setParameter( 'plain', 1 );
        $oView = new content();
        $this->assertTrue( $oView->showPlainTemplate() );
    }

    /**
     * Test active content id getter when content id passed with tpl param.
     *
     * @return null
     */
    public function testGetContentIdWithTplParam()
    {
        modConfig::setParameter( 'tpl', $this->_oObj->getId() );
        oxTestModules::addFunction( 'oxUtils', 'redirect', '{ throw new Exception($aA[0]); }');

        $oObj = $this->getMock( "content", array( "isActive" ) );
        $oObj->expects( $this->once() )->method( 'isActive')->will( $this->returnValue( false ) );

        // testing special chars conversion
        $this->assertEquals( $oObj->getContentId(), $this->_oObj->getId() );
    }

    /**
     * Test active content id getter Test active content id getter when content id passed with oxcid param.
     *
     * @return null
     */
    public function testGetContentIdWithOxcidParam()
    {
        modConfig::setParameter( 'oxcid', $this->_oObj->getId() );
        oxTestModules::addFunction( 'oxUtils', 'redirect', '{ throw new Exception($aA[0]); }');

        $oObj = $this->getMock( "content", array( "isActive" ) );
        $oObj->expects( $this->once() )->method( 'isActive')->will( $this->returnValue( false ) );

        // testing special chars conversion
        $this->assertEquals( $oObj->getContentId(), $this->_oObj->getId() );
    }

    /**
     * Test active content id getter
     *
     * @return null
     */
    public function testGetContentIdIfNotActive()
    {
        $this->_oObj->oxcontents__oxactive = new oxField('0', oxField::T_RAW);
        $this->_oObj->save();
        modConfig::setParameter( 'tpl', $this->_oObj->getId() );

        $oObj = oxNew( "content" );

        // testing special chars conversion
        $this->assertFalse( $oObj->getContentId() );
    }

    /**
     * Test active content id getter.
     *
     * @return null
     */
    public function testGetContentIdWhenNoIdSpecified()
    {
        modConfig::setParameter( 'tpl', null );
        oxTestModules::addFunction( 'oxUtils', 'redirect', '{ throw new Exception($aA[0]); }');
        $sContentId = oxDb::getDb( true )->getOne( "SELECT oxid FROM oxcontents WHERE oxloadid = 'oximpressum' " );

        $oObj = $this->getMock( "content", array( "isActive" ) );
        $oObj->expects( $this->once() )->method( 'isActive')->will( $this->returnValue( false ) );

        $this->assertEquals( $sContentId, $oObj->getContentId() );
    }

    /**
     * Test active content getter.
     *
     * @return null
     */
    public function testGetContent()
    {
        modConfig::setParameter( 'tpl', $this->_oObj->getId() );
        oxTestModules::addFunction( 'oxUtils', 'redirect', '{ throw new Exception($aA[0]); }');

        $oObj = $this->getMock( "content", array( "isActive" ) );
        $oObj->expects( $this->once() )->method( 'isActive')->will( $this->returnValue( false ) );

        // testing special chars conversion
        $this->assertEquals( $oObj->getContent()->getId(), $this->_oObj->getId() );
    }

    /**
     * Test active content getter when content doesn't exist.
     *
     * @return null
     */
    public function testGetContentIfNotExists()
    {
       modConfig::setParameter( 'tpl', 'aaaa' );

        $oObj = oxNew( "content" );

        // testing special chars conversion
        $this->assertFalse( $oObj->getContent() );
    }

    /**
     * Test getting template name.
     *
     * @return null
     */
    public function testGetTplName()
    {
       modConfig::setParameter( 'tpl', 'test.tpl' );
       $oObj = $this->getProxyClass("content");
       $this->assertEquals( 'test.tpl', $oObj->UNITgetTplName() );
    }

    /**
     * Test if render returns setted template name.
     *
     * @return null
     */
    public function testRenderReturnSettedTemplateName()
    {
       oxTestModules::addFunction( 'oxUtils', 'redirect', '{ throw new Exception($aA[0]); }');

       $oView = $this->getMock( 'content', array( '_getTplName', "isActive" ) );
       $oView->expects( $this->once() )->method( '_getTplName')->will( $this->returnValue( 'test.tpl' ) );
       $oView->expects( $this->once() )->method( 'isActive')->will( $this->returnValue( false ) );

       $this->assertEquals( 'test.tpl', $oView->render() );
    }

    /**
     * Test getting template name when tpl param contains
     * not template name, but content id.
     *
     * @return null
     */
    public function testGetTplNameWhenTplParamIsContentId()
    {
       modConfig::setParameter( 'tpl', '2eb46767947d21851.22681675' );
       $oObj = $this->getProxyClass("content");
       $this->assertNull( $oObj->UNITgetTplName() );
    }

    public function testContentNotFound()
    {
       $oView = $this->getMock( 'content', array( '_getTplName', 'getContentId' ) );
       $oView->expects( $this->once() )->method( '_getTplName')->will( $this->returnValue( '' ) );
       $oView->expects( $this->any() )->method( 'getContentId')->will( $this->returnValue( false ) );

       $oUtils = $this->getMock( 'oxutils', array( 'handlePageNotFoundError' ) );
       $oUtils->expects( $this->once() )->method( 'handlePageNotFoundError')->will( $this->throwException( new Exception("404")) );
       oxTestModules::addModuleObject('oxutils', $oUtils);

       try {
        $oView->render();
       } catch (Exception $e) {
           $this->assertEquals('404', $e->getMessage());
           return;
       }
       $this->fail("no exception");
    }
}
