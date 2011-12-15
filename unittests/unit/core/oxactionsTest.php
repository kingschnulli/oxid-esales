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
 * @version   SVN: $Id: oxactionsTest.php 40264 2011-11-24 14:04:45Z linas.kukulskis $
 */

require_once realpath( "." ).'/unit/OxidTestCase.php';
require_once realpath( "." ).'/unit/test_config.inc.php';

/**
 * Testing oxactions class.
 */
class Unit_Core_oxactionsTest extends OxidTestCase
{
    /**
     * Contains a object of oxactions()
     *
     * @var object
     */
    protected $_oAction = null;

    /**
     * Initialize the fixture.
     *
     * @return null
     */
    protected function setUp()
    {
        parent::setUp();
        $this->_oAction = new oxactions();
        $this->_oAction->oxactions__oxtitle = new oxField("test", oxField::T_RAW);
        $this->_oAction->save();


        $this->oPromo = new oxActions();
        $this->oPromo->assign(array(
            'oxtitle'    => 'title',
            'oxlongdesc' => 'longdesc',
            'oxtype' => 2,
            'oxsort' => 1,
            'oxactive' => 1,
        ));
        $this->oPromo->save();

        oxTestModules::addFunction('oxStr', 'setH($h)', '{oxStr::$_oHandler = $h;}');
    }

    /**
     * Tear down the fixture.
     *
     * @return null
     */
    protected function tearDown()
    {
        modDb::getInstance()->cleanup();
        $this->_oAction->delete();
        $this->oPromo->delete();
        oxNew('oxStr')->setH(null);

        parent::tearDown();
    }

    /**
     * oxActions::addArticle() test case
     * Testing action article adding.
     *
     * @return null
     */
    public function testAddArticle()
    {
        $sArtOxid = 'xxx';
        $this->_oAction->addArticle( $sArtOxid );

        $sCheckOxid = oxDb::getDb( oxDB::FETCH_MODE_ASSOC )->getOne( "select oxid from oxactions2article where oxactionid = '".$this->_oAction->getId()."' and oxartid = '$sArtOxid' ");
        if ( !$sCheckOxid ) {
            $this->fail( "fail adding article" );
        }
    }

    /**
     * oxActions::removeArticle() test case
     * Testing action article removal.
     *
     * @return null
     */
    public function testRemoveArticle()
    {
        $sArtOxid = 'xxx';
        $this->_oAction->addArticle( $sArtOxid );
        $this->assertTrue( $this->_oAction->removeArticle( $sArtOxid ) );

        $sCheckOxid = oxDb::getDb( oxDB::FETCH_MODE_ASSOC )->getOne( "select oxid from oxactions2article where oxactionid = '".$this->_oAction->getId()."' and oxartid = '$sArtOxid' ");
        if ( $sCheckOxid ) {
            $this->fail("fail removing article");
        }
    }

    /**
     * oxActions::removeArticle() test case
     * Testing non existing action article removal.
     *
     * @return null
     */
    public function testRemoveArticleNotExisting()
    {
        $sArtOxid = 'xxx';
        $this->assertFalse( $this->_oAction->removeArticle( $sArtOxid ) );
    }

    /**
     * oxActions::removeArticle() test case
     * Trying to delete not existing action, deletion must return false
     *
     * @return null
     */
    public function testDeleteNotExistingAction()
    {
        $sArtOxid = 'xxx';
        $oAction = new oxactions();
        $this->assertFalse( $oAction->delete() );
    }

    /**
     * oxActions::delete() test case
     * Deleting existing action, everything must go fine
     *
     * @return null
     */
    public function testDelete()
    {
        $sArtOxid = 'xxx';
        $this->_oAction->addArticle( $sArtOxid );
        $this->_oAction->delete();

        $sCheckOxid = oxDb::getDb( oxDB::FETCH_MODE_ASSOC )->GetOne( "select oxid from oxactions2article where oxactionid = '".$this->_oAction->getId()."'" );
        $oAction = oxNew("oxactions");
        if ( $sCheckOxid || $oAction->Load( $this->sOxId ) ) {
            $this->fail("fail deleting");
        }
    }


    /**
     * oxActions::getTimeLeft() test case
     * Test if the setted timeleft in database equals what we expect
     *
     * @return null
     */
    public function testGetTimeLeft()
    {
        oxTestModules::addFunction('oxUtilsDate', 'getTime', '{return '.time().';}');
        $this->oPromo->oxactions__oxactiveto = new oxField(date( 'Y-m-d H:i:s', oxUtilsDate::getInstance()->getTime() + 10 ));
        $this->assertEquals(10, $this->oPromo->getTimeLeft());
    }

    /**
     * oxActions::getTimeUntilStart() test case
     * Test if promo starts at the setted time we expect
     *
     * @return null
     */
    public function testGetTimeUntilStart()
    {
        oxTestModules::addFunction('oxUtilsDate', 'getTime', '{return '.time().';}');
        $this->oPromo->oxactions__oxactivefrom = new oxField(date( 'Y-m-d H:i:s', oxUtilsDate::getInstance()->getTime() + 10 ));
        $this->assertEquals(10, $this->oPromo->getTimeUntilStart());
    }

    /**
     * oxActions::start() test case
     * Create a new promo action and check if they are active until our setted date.
     * Save the date into the db and read it with the id of the promo out.
     *
     * @return null
     */
    public function testStart()
    {
        oxTestModules::addFunction('oxUtilsDate', 'getTime', '{return '.time().';}');
        $this->oPromo->oxactions__oxactiveto = new oxField( '' );
        $this->oPromo->oxactions__oxactivefrom = new oxField( '' );
        $this->oPromo->save();

        $id = $this->oPromo->getId();
        $this->oPromo = new oxActions();
        $this->oPromo->load($id);

        $this->assertEquals('0000-00-00 00:00:00', $this->oPromo->oxactions__oxactiveto->value);
        $this->assertEquals('0000-00-00 00:00:00', $this->oPromo->oxactions__oxactivefrom->value);

        $this->oPromo->start();
        $iNow  = strtotime(date( 'Y-m-d H:i:s', oxUtilsDate::getInstance()->getTime() ));

        $this->assertEquals(date( 'Y-m-d H:i:s', $iNow), $this->oPromo->oxactions__oxactivefrom->value);
        $this->assertEquals('0000-00-00 00:00:00', $this->oPromo->oxactions__oxactiveto->value);

        $id = $this->oPromo->getId();
        $this->oPromo = new oxActions();
        $this->oPromo->load($id);
        $this->assertEquals(date( 'Y-m-d H:i:s', $iNow), $this->oPromo->oxactions__oxactivefrom->value);
        $this->assertEquals('0000-00-00 00:00:00', $this->oPromo->oxactions__oxactiveto->value);


        $this->oPromo->oxactions__oxactiveto = new oxField(date( 'Y-m-d H:i:s', oxUtilsDate::getInstance()->getTime()+10 ));
        $sTo = $this->oPromo->oxactions__oxactiveto->value;
        $this->oPromo->save();
        $id = $this->oPromo->getId();
        $this->oPromo = new oxActions();
        $this->oPromo->load($id);
        $this->assertEquals($sTo, $this->oPromo->oxactions__oxactiveto->value);

        $this->oPromo->start();
        $id = $this->oPromo->getId();
        $this->oPromo = new oxActions();
        $this->oPromo->load($id);
        $this->assertEquals($sTo, $this->oPromo->oxactions__oxactiveto->value);
    }

    /**
     * oxActions::stop() test case
     * stops the current promo action and test if oxactiveto equals the current date.
     *
     * @return null
     */
    public function testStop()
    {
        oxTestModules::addFunction('oxUtilsDate', 'getTime', '{return '.time().';}');
        $this->oPromo->stop();
        $iNow  = strtotime(date( 'Y-m-d H:i:s', oxUtilsDate::getInstance()->getTime() ));

        $this->assertEquals(date( 'Y-m-d H:i:s', $iNow), $this->oPromo->oxactions__oxactiveto->value);

        $id = $this->oPromo->getId();
        $this->oPromo = new oxActions();
        $this->oPromo->load($id);

        $this->assertEquals(date( 'Y-m-d H:i:s', $iNow), $this->oPromo->oxactions__oxactiveto->value);
    }

    /**
     * oxActions::isRunning() test case
     * check if actions are active or not
     *
     * @return null
     */
    public function testIsTestRunning()
    {
        oxTestModules::addFunction('oxUtilsDate', 'getTime', '{return '.time().';}');
        $iNow  = strtotime(date( 'Y-m-d H:i:s', oxUtilsDate::getInstance()->getTime() ));
        $this->oPromo->oxactions__oxactivefrom = new oxField(date( 'Y-m-d H:i:s', $iNow-10));
        $this->oPromo->oxactions__oxactiveto = new oxField(date( 'Y-m-d H:i:s', $iNow+10));
        $this->assertTrue($this->oPromo->isRunning());

        $this->oPromo->oxactions__oxactiveto = new oxField(date( 'Y-m-d H:i:s', $iNow-1));
        $this->assertFalse($this->oPromo->isRunning());

        $this->oPromo->oxactions__oxactivefrom = new oxField(date( 'Y-m-d H:i:s', $iNow+1));
        $this->oPromo->oxactions__oxactiveto = new oxField(date( 'Y-m-d H:i:s', $iNow+10));
        $this->assertFalse($this->oPromo->isRunning());

        $this->oPromo->oxactions__oxactivefrom = new oxField(date( 'Y-m-d H:i:s', $iNow-10));
        $this->oPromo->oxactions__oxactiveto = new oxField(date( 'Y-m-d H:i:s', $iNow+10));
        $this->assertTrue($this->oPromo->isRunning());

        $this->oPromo->oxactions__oxactivefrom = new oxField('0000-00-00 00:00:00');
        $this->assertFalse($this->oPromo->isRunning());

        $this->oPromo->oxactions__oxactivefrom = new oxField(date( 'Y-m-d H:i:s', $iNow-10));
        $this->oPromo->oxactions__oxactiveto = new oxField(date( 'Y-m-d H:i:s', $iNow+10));
        $this->assertTrue($this->oPromo->isRunning());

        $this->oPromo->oxactions__oxtype = new oxField(0);
        $this->assertFalse($this->oPromo->isRunning());

        $this->oPromo->oxactions__oxtype = new oxField(1);
        $this->assertFalse($this->oPromo->isRunning());

        $this->oPromo->oxactions__oxtype = new oxField(2);
        $this->assertTrue($this->oPromo->isRunning());

        $this->oPromo->oxactions__oxactive = new oxField(0);
        $this->assertFalse($this->oPromo->isRunning());
    }

    /**
     * oxActions::getLongDesc() test case
     * test getted long description with smarty tags
     *
     * @return null
     */
    public function testGetLongDescTags()
    {
        $this->oPromo->oxactions__oxlongdesc = new oxField( "[{* *}]parsed" );
        $this->assertEquals('parsed', $this->oPromo->getLongDesc());
    }

    /**
     * test
     */
    public function testGetBannerArticle_notAssigned()
    {
        $oDb = $this->getMock('stdClass', array('getOne', 'quote'));

        $oDb->expects($this->once())->method('quote')
                ->with($this->equalTo('promoid'))
                ->will($this->returnValue("'promoid'"));

        $oDb->expects($this->once())->method('getOne')
                ->with($this->equalTo('select oxobjectid from oxobject2action where oxactionid=\'promoid\' and oxclass="oxarticle"'))
                ->will($this->returnValue(false));

        modDb::getInstance()->modAttach($oDb);

        $oArticle = $this->getMock('stdclass', array('load'));
        $oArticle->expects($this->never())->method('load');

        oxTestModules::addModuleObject('oxarticle', $oArticle);

        $oPromo = new oxactions();
        $oPromo->setId('promoid');
        $this->assertNull($oPromo->getBannerArticle());
    }

    /**
     * test
     */
    public function testGetBannerArticle_notExisting()
    {
        $oDb = $this->getMock('stdClass', array('getOne', 'quote'));

        $oDb->expects($this->once())->method('quote')
                ->with($this->equalTo('promoid'))
                ->will($this->returnValue("'promoid'"));

        $oDb->expects($this->once())->method('getOne')
                ->with($this->equalTo('select oxobjectid from oxobject2action where oxactionid=\'promoid\' and oxclass="oxarticle"'))
                ->will($this->returnValue('asdabsdbdsf'));

        modDb::getInstance()->modAttach($oDb);

        $oArticle = $this->getMock('stdclass', array('load'));
        $oArticle->expects($this->once())->method('load')
                ->with($this->equalTo('asdabsdbdsf'))
                ->will($this->returnValue(false));

        oxTestModules::addModuleObject('oxarticle', $oArticle);

        $oPromo = new oxactions();
        $oPromo->setId('promoid');
        $this->assertNull($oPromo->getBannerArticle());
    }

    /**
     * test
     */
    public function testGetBannerArticle_Existing()
    {
        $oDb = $this->getMock('stdClass', array('getOne', 'quote'));

        $oDb->expects($this->once())->method('quote')
                ->with($this->equalTo('promoid'))
                ->will($this->returnValue("'promoid'"));

        $oDb->expects($this->once())->method('getOne')
                ->with($this->equalTo('select oxobjectid from oxobject2action where oxactionid=\'promoid\' and oxclass="oxarticle"'))
                ->will($this->returnValue('2000'));

        modDb::getInstance()->modAttach($oDb);

        $oArticle = $this->getMock('stdclass', array('load'));
        $oArticle->expects($this->once())->method('load')
                ->with($this->equalTo('2000'))
                ->will($this->returnValue(true));

        oxTestModules::addModuleObject('oxarticle', $oArticle);

        $oPromo = new oxactions();
        $oPromo->setId('promoid');
        $oArt = $oPromo->getBannerArticle();
        $this->assertNotNull($oArt);
        $this->assertSame($oArticle, $oArt);
    }

    /**
     * test
     */
    public function testGetBannerPictureUrl()
    {
        $oPromo = new oxactions();
        $oPromo->oxactions__oxpic = new oxField( "current_de.jpg" );
        $oConfig = modConfig::getInstance();

        $this->assertEquals( $oConfig->getPictureUrl( "promo/" )."current_de.jpg", $oPromo->getBannerPictureUrl() );
    }

    /**
     * test
     */
    public function testGetBannerPictureUrl_noPicture()
    {
        $oPromo = new oxactions();
        $oConfig = modConfig::getInstance();

        $this->assertNull( $oPromo->getBannerPictureUrl() );
    }

    /**
     * test
     */
    public function testGetBannerPictureUrl_pictureNotUploaded()
    {
        $oPromo = new oxactions();
        $oPromo->oxactions__oxpic = new oxField( "noSuchPic.jpg" );
        $this->assertEquals( modConfig::getInstance()->getPictureUrl( "master/" )."nopic.jpg", $oPromo->getBannerPictureUrl() );
    }

    /**
     * test
     */
    public function testGetBannerLink()
    {
        $oUtilsUrl = $this->getMock('oxUtilsUrl', array('processUrl'));

        $oUtilsUrl->expects($this->once())->method('processUrl')
                  ->with( $this->equalTo("http://www.oxid-esales.com") )
                  ->will( $this->returnValue("http://www.oxid-esales.com/") );

        oxTestModules::addModuleObject( 'oxUtilsUrl', $oUtilsUrl );

        $oPromo = new oxactions();
        $oPromo->oxactions__oxlink = new oxField( "http://www.oxid-esales.com" );

        $this->assertEquals( "http://www.oxid-esales.com/", $oPromo->getBannerLink() );
    }

    /**
     * test
     */
    public function testGetBannerLink_noLink()
    {
        $oPromo = new oxactions();
        $oPromo->oxactions__oxlink = new oxField( null );

        $this->assertNull( $oPromo->getBannerLink() );
    }

    /**
     * test
     */
    public function testGetBannerLink_noLinkWithAssignedArticle()
    {
        $oArticle = $this->getMock('oxArticle', array('getLink'));
        $oArticle->expects($this->once())->method('getLink')
                 ->will( $this->returnValue("testLinkToArticle") );

        $oPromo = $this->getMock('oxActions', array('getBannerArticle'));
        $oPromo->expects($this->once())->method('getBannerArticle')
               ->will( $this->returnValue($oArticle) );

        $oPromo->oxactions__oxlink = new oxField( null );

        $this->assertEquals( "testLinkToArticle", $oPromo->getBannerLink() );
    }


}
