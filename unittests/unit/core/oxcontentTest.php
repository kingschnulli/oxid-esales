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
 * @version   SVN: $Id: oxcontentTest.php 28277 2010-06-10 15:10:39Z arvydas $
 */

require_once realpath( "." ).'/unit/OxidTestCase.php';
require_once realpath( "." ).'/unit/test_config.inc.php';

class Unit_Core_oxcontentTest extends OxidTestCase
{
    protected $_oContent = null;
    protected $_sShopId = null;

    /**
     * Initialize the fixture.
     *
     * @return null
     */
    protected function setUp()
    {
        parent::setUp();
        $this->_oContent = new oxbase();
        $this->_oContent->init( 'oxcontents' );
        $this->_oContent->oxcontents__oxtitle = new oxField('test', oxField::T_RAW);
        $this->_sShopId = modConfig::getInstance()->getShopId();
        $this->_oContent->oxcontents__oxshopid = new oxField($this->_sShopId, oxField::T_RAW);
        $this->_oContent->oxcontents__oxloadid = new oxField('_testLoadId', oxField::T_RAW);
        $this->_oContent->oxcontents__oxcontent = new oxField("testcontentDE&, &, !@#$%^&*%$$&@'.,;p\"ss", oxField::T_RAW);
        $this->_oContent->oxcontents__oxcontent_1 = new oxField("testcontentENG&, &, !@#$%^&*%$$&@'.,;p\"ss", oxField::T_RAW);
        $this->_oContent->oxcontents__oxactive = new oxField('1', oxField::T_RAW);
        $this->_oContent->oxcontents__oxactive_1 = new oxField('1', oxField::T_RAW);
        $this->_oContent->save();

        $sOxid = $this->_oContent->getId();

        $this->_oContent = new oxcontent();
        $this->_oContent->load( $sOxid );
    }

    /**
     * Tear down the fixture.
     *
     * @return null
     */
    protected function tearDown()
    {
        modConfig::getInstance()->setShopId($this->_sShopId );
        $this->_oContent->delete();
        parent::tearDown();
    }

    /**
     * oxContent::save() test case
     *
     * @return null
     */
    public function testSaveAgb()
    {
        $sShopId  = oxConfig::getInstance()->getShopId();

        $oDb = oxDb::getDb();
        $oDb->execute( "insert into oxacceptedterms (`OXUSERID`, `OXSHOPID`, `OXTERMVERSION`) values ('testuser', '{$sShopId}', '0')" );
        $this->assertTrue( (bool)$oDb->getOne( "select 1 from oxacceptedterms" ) );

        $oContent = new oxContent();
        $oContent->loadByIdent( "oxagb" );
        $oContent->save();

        $this->assertFalse( (bool)$oDb->getOne( "select 1 from oxacceptedterms" ) );
    }

    /**
     * oxContent::getTermsVersion() test case
     *
     * @return null
     */
    public function testGetTermsVersion()
    {
        $oContent = $this->getMock( "oxContent", array( "loadByIdent" ) );
        $oContent->oxcontents__oxtermversion = new oxField( "testVersion" );
        $oContent->expects($this->once())->method( 'loadByIdent' )->with($this->equalTo( 'oxagb' ) )->will( $this->returnValue( true ));
        $this->assertEquals( "testVersion", $oContent->getTermsVersion() );
    }

    /**
     * Test assigning oxcontent values
     */
    public function testAssign()
    {
        $oObj = new oxcontent();
        $oObj->load( $this->_oContent->getId() );

        // testing special chars conversion
        $this->assertEquals( 'testcontentDE&, &, !@#$%^&*%$$&@\'.,;p"ss', $oObj->oxcontents__oxcontent->value );
    }


    /**
     * Test loading Content by using field oxloadid
     */
    // for default language
    public function testLoadByIdentDefaultLanguage()
    {
        $oObj = new oxcontent();
        $this->assertTrue( $oObj->loadByIdent( '_testLoadId' ), 'can not load oxcontent by ident' );
        $this->assertEquals( 'testcontentDE&, &, !@#$%^&*%$$&@\'.,;p"ss', $oObj->oxcontents__oxcontent->value );
    }

    // for second language
    public function testLoadByIdentSecondLanguage()
    {
        $oObj = new oxcontent();
        $oObj->setLanguage( 1 );
        $this->assertTrue( $oObj->loadByIdent( '_testLoadId' ), 'can not load oxcontent by ident' );
        $this->assertEquals( 'testcontentENG&, &, !@#$%^&*%$$&@\'.,;p"ss', $oObj->oxcontents__oxcontent->value );
    }

    /*
     * Test loading content by using not existing field oxloadid
     */
    public function testLoadByIdentWithNotExistingLoadId()
    {
        $oObj = new oxcontent();
        $this->assertFalse( $oObj->loadByIdent( 'noSuchLoadId' ) );
    }

    public function test_setFieldData()
    {
        $oObj = $this->getProxyClass('oxcontent');
        $oObj->disableLazyLoading();
        $oObj->UNITsetFieldData("oxid", "asd< as");
        $oObj->UNITsetFieldData("oxcOntent", "asd< as");
        $this->assertEquals( 'asd&lt; as', $oObj->oxcontents__oxid->value );
        $this->assertEquals( 'asd< as', $oObj->oxcontents__oxcontent->value );
    }

    public function testGetStdLink()
    {
        $sUrl = oxConfig::getInstance()->getShopHomeURL() . "cl=content&amp;oxcid=testts";

        $oContent = new oxcontent();
        $oContent->setId( 'testts' );
        $this->assertEquals( $sUrl, $oContent->getStdLink() );

        $oContent = new oxcontent();
        $oContent->setId( 'testts' );
        $oContent->oxcontents__oxcatid = new oxField( 'oxrootid' );
        $this->assertEquals( $sUrl, $oContent->getStdLink() );

            $oContent = new oxcontent();
            $oContent->setId( 'testts' );
            $oContent->oxcontents__oxcatid = new oxField( '8a142c3e44ea4e714.31136811' );
            $this->assertEquals( $sUrl.'&amp;cnid=8a142c3e4143562a5.46426637', $oContent->getStdLink());

    }

    public function testGetLink()
    {
        oxTestModules::addFunction("oxutils", "seoIsActive", "{return false;}");

        $oContent = $this->getMock( 'oxcontent', array( 'getStdLink' ) );
        $oContent->expects( $this->once() )->method('getStdLink')->will( $this->returnValue( 'stdlink' ) );

        $this->assertEquals( 'stdlink', $oContent->getLink() );
    }
    public function testGetLinkSeo()
    {
        oxTestModules::addFunction("oxutils", "seoIsActive", "{return true;}");
        oxTestModules::addFunction("oxseoencodercontent", "unsetInstance", "{oxSeoEncoderContent::\$_instance = null;}");
        oxTestModules::addFunction("oxseoencodercontent", "getContentUrl", '{$o = $aA[0]; return "seolink".$o->oxcontents__oxtitle->value;}');
        $oE = oxNew('oxseoencodercontent');
        $oE->unsetInstance();

        try {
            $o = new oxcontent();
            $o->setId('testts');
            $o->oxcontents__oxcatid = new oxField();
            $o->oxcontents__oxtitle = new oxField('aaFaa');

            $this->assertEquals( "seolinkaaFaa", $o->getLink() );
        } catch (Ecxeption $e) {
        }
        $oE->unsetInstance();
        if ($e) throw $e;
    }

    public function testGetStdLinkWithLangParam()
    {
        $sUrl = oxConfig::getInstance()->getShopHomeURL() . "cl=content&amp;oxcid=testts";
        $oContent = new oxcontent();
        $oContent->setId('testts');

        $this->assertEquals( $sUrl.'&amp;lang=1', $oContent->getStdLink(1));

        $oContent = new oxcontent();
        $oContent->setId('testts');
        $oContent->oxcontents__oxcatid = new oxField('oxrootid');
        $this->assertEquals( $sUrl, $oContent->getStdLink(0));

            $oContent = new oxcontent();
            $oContent->setId('testts');
            $oContent->oxcontents__oxcatid = new oxField('8a142c3e44ea4e714.31136811');
            $this->assertEquals( $sUrl.'&amp;cnid=8a142c3e4143562a5.46426637&amp;lang=1', $oContent->getStdLink(1));

    }

    public function testGetLinkWithDifLangParam()
    {
        oxTestModules::addFunction("oxutils", "seoIsActive", "{return false;}");

        $oContent = $this->getMock( 'oxcontent', array( 'getStdLink' ) );
        $oContent->expects( $this->once() )->method('getStdLink')->with($this->equalTo(1))->will( $this->returnValue( 'stdlink' ) );

        $this->assertEquals( 'stdlink', $oContent->getLink(1) );
    }
    public function testGetLinkWithLangParam()
    {
        oxTestModules::addFunction("oxutils", "seoIsActive", "{return false;}");

        $oContent = $this->getMock( 'oxcontent', array( 'getStdLink' ) );
        $oContent->expects( $this->once() )->method('getStdLink')->will( $this->returnValue( 'stdlink' ) );

        $this->assertEquals( 'stdlink', $oContent->getLink(0) );
    }
    public function testGetLinkSeoWithLangParam()
    {
        oxTestModules::addFunction("oxutils", "seoIsActive", "{return true;}");
        oxTestModules::addFunction("oxseoencodercontent", "unsetInstance", "{oxSeoEncoderContent::\$_instance = null;}");
        oxTestModules::addFunction("oxseoencodercontent", "getContentUrl", '{$o = $aA[0]; return "seolink".$o->oxcontents__oxtitle->value.$aA[1];}');
        $oE = oxNew('oxseoencodercontent');
        $oE->unsetInstance();

        try {
            $o = new oxcontent();
            $o->setId('testts');
            $o->oxcontents__oxcatid = new oxField();
            $o->oxcontents__oxtitle = new oxField('aaFaa');

            $this->assertEquals( "seolinkaaFaa1", $o->getLink(1) );
        } catch (Ecxeption $e) {
        }
        $oE->unsetInstance();
        if ($e) throw $e;
    }


    public function testExpandedStatusGetter()
    {
        modConfig::setParameter( 'oxcid', 'xxx' );

        $oContent = new oxContent();
        $oContent->setId( 'xxx' );
        $this->assertTrue( $oContent->getExpanded() );
        $this->assertTrue( $oContent->expanded );

        // testing cache
        modConfig::setParameter( 'oxcid', 'yyy' );
        $this->assertTrue( $oContent->getExpanded() );
        $this->assertTrue( $oContent->expanded );

        // testing if ids does not match
        $oContent = new oxContent();
        $oContent->setId( 'zzz' );
        $this->assertFalse( $oContent->getExpanded() );
        $this->assertFalse( $oContent->expanded );
    }


    public function testDelete()
    {
        oxTestModules::addFunction('oxSeoEncoderContent', 'onDeleteContent', '{$this->onDelete[] = $aA[0];}');
        oxTestModules::addFunction('oxSeoEncoderContent', 'resetInst', '{self::$_instance = $this;}');
        oxNew('oxSeoEncoderContent')->resetInst();
        oxSeoEncoderContent::getInstance()->onDelete = array();

        // parent is not deletable
        $sId = $this->_oContent->getId();
        $this->assertEquals(true, $this->_oContent->delete());
        $this->assertEquals(false, $this->_oContent->exists());
        $this->assertEquals(1, count(oxSeoEncoderContent::getInstance()->onDelete));
        $this->assertSame($sId, oxSeoEncoderContent::getInstance()->onDelete[0]);
    }

}
