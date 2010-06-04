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
 * @version   SVN: $Id: oxactionsTest.php 28064 2010-06-02 08:59:37Z sarunas $
 */

require_once realpath( "." ).'/unit/OxidTestCase.php';
require_once realpath( "." ).'/unit/test_config.inc.php';

/**
 * Testing oxactions class.
 */
class Unit_Core_oxactionsTest extends OxidTestCase
{
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
            'oxtype' => 1,
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
        $this->_oAction->delete();
        $this->oPromo->delete();
        oxNew('oxStr')->setH(null);
        parent::tearDown();
    }

    /**
     * Testing action article adding.
     *
     * @return null
     */
    public function testAddArticle()
    {
        $sArtOxid = 'xxx';
        $this->_oAction->addArticle( $sArtOxid );

        $sCheckOxid = oxDb::getDb(true)->getOne( "select oxid from oxactions2article where oxactionid = '".$this->_oAction->getId()."' and oxartid = '$sArtOxid' ");
        if ( !$sCheckOxid ) {
            $this->fail( "fail adding article" );
        }
    }

    /**
     * Testing action article removal.
     *
     * @return null
     */
    public function testRemoveArticle()
    {
        $sArtOxid = 'xxx';
        $this->_oAction->addArticle( $sArtOxid );
        $this->assertTrue( $this->_oAction->removeArticle( $sArtOxid ) );

        $sCheckOxid = oxDb::getDb(true)->getOne( "select oxid from oxactions2article where oxactionid = '".$this->_oAction->getId()."' and oxartid = '$sArtOxid' ");
        if ( $sCheckOxid ) {
            $this->fail("fail removing article");
        }
    }

    /**
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
     * Testing action deletion
     *
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
     * Testing action deletion
     *
     * Deleting existing action, everything must go fine
     *
     * @return null
     */
    public function testDelete()
    {
        $sArtOxid = 'xxx';
        $this->_oAction->addArticle( $sArtOxid );
        $this->_oAction->delete();

        $sCheckOxid = oxDb::getDb(true)->GetOne( "select oxid from oxactions2article where oxactionid = '".$this->_oAction->getId()."'" );
        $oAction = oxNew("oxactions");
        if ( $sCheckOxid || $oAction->Load( $this->sOxId ) ) {
            $this->fail("fail deleting");
        }
    }






    public function testGetTimeLeft()
    {
        oxTestModules::addFunction('oxUtilsDate', 'getTime', '{return '.time().';}');
        $this->oPromo->oxactions__oxactiveto = new oxField(date( 'Y-m-d H:i:s', oxUtilsDate::getInstance()->getTime() + 10 ));
        $this->assertEquals(10, $this->oPromo->getTimeLeft());
    }

    public function testGetTimeUntilStart()
    {
        oxTestModules::addFunction('oxUtilsDate', 'getTime', '{return '.time().';}');
        $this->oPromo->oxactions__oxactivefrom = new oxField(date( 'Y-m-d H:i:s', oxUtilsDate::getInstance()->getTime() + 10 ));
        $this->assertEquals(10, $this->oPromo->getTimeUntilStart());
    }

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
        $this->assertTrue($this->oPromo->isRunning());

        $this->oPromo->oxactions__oxactive = new oxField(0);
        $this->assertFalse($this->oPromo->isRunning());
    }


    public function testGetLongDescNoTags()
    {
        $oUV =  $this->getMock('oxUtilsView', array('parseThroughSmarty'));
        $oUV->expects($this->never())->method('parseThroughSmarty');
        oxTestModules::addModuleObject('oxUtilsView', $oUV);

        $oStr = $this->getMock('oxStrRegular', array('strstr'));
        $oStr->expects($this->at(0))->method('strstr')->with($this->equalTo('longdesc'), $this->equalTo('[{'))->will($this->returnValue(false));
        $oStr->expects($this->at(1))->method('strstr')->with($this->equalTo('longdesc'), $this->equalTo('<?'))->will($this->returnValue(false));
        oxNew('oxStr')->setH($oStr);

        $this->assertEquals('longdesc', $this->oPromo->getLongDesc());
    }

    public function testGetLongDescTags()
    {
        $oUV =  $this->getMock('oxUtilsView', array('parseThroughSmarty'));
        $oUV->expects($this->once())->method('parseThroughSmarty')->with($this->equalTo('longdesc'))->will($this->returnValue('parsed'));
        oxTestModules::addModuleObject('oxUtilsView', $oUV);

        $oStr = $this->getMock('oxStrRegular', array('strstr'));
        $oStr->expects($this->at(0))->method('strstr')->with($this->equalTo('longdesc'), $this->equalTo('[{'))->will($this->returnValue(true));
        $oStr->expects($this->at(1))->method('strstr')->with($this->equalTo('longdesc'), $this->equalTo('<?'))->will($this->returnValue(false));
        oxNew('oxStr')->setH($oStr);

        $this->assertEquals('parsed', $this->oPromo->getLongDesc());
    }


}
