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
 * @version   SVN: $Id: oxbasketreservationTest.php 28060 2010-06-02 08:38:33Z sarunas $
 */

require_once realpath( "." ).'/unit/OxidTestCase.php';
require_once realpath( "." ).'/unit/test_config.inc.php';


class Unit_Core_oxbasketreservationTest extends OxidTestCase
{
    /**
     * Initialize the fixtures.
     *
     * @return null
     */
    protected function setUp()
    {
        parent::setUp();
    }

    /**
     * Tear down the fixtures.
     *
     * @return null
     */
    protected function tearDown()
    {
        parent::tearDown();
    }
    
    public function testGetReservationsIdInitNew()
    {
        $oS = $this->getMock('stdClass', array('getVar', 'setVar'));
        $oS->expects($this->once())->method('getVar')->with($this->equalTo('basketReservationToken'))->will($this->returnValue(null));
        $oS->expects($this->once())->method('setVar')->with($this->equalTo('basketReservationToken'), $this->equalTo('newvarval'))->will($this->returnValue(null));

        $oUO = $this->getMock('oxUtilsObject', array('generateUID'));
        $oUO->expects($this->once())->method('generateUID')->will($this->returnValue('newvarval'));
        modInstances::addMod('oxUtilsObject', $oUO);

        $oR = $this->getMock('oxBasketReservation', array('getSession'));
        $oR->expects($this->exactly(2))->method('getSession')->will($this->returnValue($oS));

        $this->assertEquals('newvarval', $oR->UNITgetReservationsId());
    }

    public function testGetReservationsIdReturnInited()
    {
        $oS = $this->getMock('stdClass', array('getVar', 'setVar'));
        $oS->expects($this->once())->method('getVar')->with($this->equalTo('basketReservationToken'))->will($this->returnValue('oldvarval'));
        $oS->expects($this->never())->method('setVar');

        $oUO = $this->getMock('oxUtilsObject', array('generateUID'));
        $oUO->expects($this->never())->method('generateUID');
        modInstances::addMod('oxUtilsObject', $oUO);

        $oR = $this->getMock('oxBasketReservation', array('getSession'));
        $oR->expects($this->exactly(1))->method('getSession')->will($this->returnValue($oS));

        $this->assertEquals('oldvarval', $oR->UNITgetReservationsId());
    }

    public function testLoadReservations_load()
    {
        $oUO = $this->getMock('oxuserbasket', array('assignRecord', 'buildSelectString', 'setIsNewBasket'));
        $oUO->expects($this->once())->method('buildSelectString')
                ->with($this->equalTo( array( 'oxuserbaskets.oxuserid' => 'p:basketId', 'oxuserbaskets.oxtitle' => 'reservations' )))
                ->will($this->returnValue('selectString'));
        $oUO->expects($this->once())->method('assignRecord')
                ->with($this->equalTo( 'selectString' ))
                ->will($this->returnValue(true));
        $oUO->expects($this->never())->method('setIsNewBasket');

        oxTestModules::addModuleObject('oxuserbasket', $oUO);
        
        $oR = new oxBasketReservation();
        $this->assertSame($oUO, $oR->UNITloadReservations('p:basketId'));
    }

    public function testLoadReservations_create()
    {
        $oUO = $this->getMock('oxuserbasket', array('assignRecord', 'buildSelectString', 'setIsNewBasket'));
        $oUO->expects($this->once())->method('buildSelectString')
                ->with($this->equalTo( array( 'oxuserbaskets.oxuserid' => 'p:basketId', 'oxuserbaskets.oxtitle' => 'reservations' )))
                ->will($this->returnValue('selectString'));
        $oUO->expects($this->once())->method('assignRecord')
                ->with($this->equalTo( 'selectString' ))
                ->will($this->returnValue(false));
        $oUO->expects($this->once())->method('setIsNewBasket')->will($this->returnValue(null));

        oxTestModules::addModuleObject('oxuserbasket', $oUO);

        $oR = new oxBasketReservation();
        $this->assertSame($oUO, $oR->UNITloadReservations('p:basketId'));

        $this->assertEquals('reservations', $oUO->oxuserbaskets__oxtitle->value);
        $this->assertEquals('p:basketId', $oUO->oxuserbaskets__oxuserid->value);
    }

    public function testGetReservations_cache()
    {
        oxTestModules::addFunction('oxBasketReservation', 'setR($r)', '{$this->_oReservations = $r;}');

        $oR = oxNew('oxBasketReservation');
        $oR->setR('asdasd');

        $this->assertEquals('asdasd', $oR->getReservations());
    }

    public function testGetReservations_noId()
    {
        $oR = $this->getMock('oxBasketReservation', array('_getReservationsId'));
        $oR->expects($this->exactly(1))->method('_getReservationsId')->will($this->returnValue(''));

        $this->assertSame(null, $oR->getReservations());
    }

    public function testGetReservations_load()
    {
        $oR = $this->getMock('oxBasketReservation', array('_getReservationsId', '_loadReservations'));
        $oR->expects($this->exactly(1))->method('_getReservationsId')->will($this->returnValue('od'));
        $oR->expects($this->exactly(1))->method('_loadReservations')->with($this->equalTo('od'))->will($this->returnValue('ret'));

        $this->assertSame('ret', $oR->getReservations());
    }

    public function testGetReservedItems_cache()
    {
        oxTestModules::addFunction('oxBasketReservation', 'setR($r)', '{$this->_aCurrentlyReserved = $r;}');

        $oR = oxNew('oxBasketReservation');
        $oR->setR('asdasd');

        $this->assertEquals('asdasd', $oR->UNITgetReservedItems());
    }

    public function testGetReservedItems_loadnull()
    {
        $oR = $this->getMock('oxBasketReservation', array('getReservations'));
        $oR->expects($this->exactly(1))->method('getReservations')->will($this->returnValue(null));

        $this->assertEquals(array(), $oR->UNITgetReservedItems());
    }

    public function testGetReservedItems_load()
    {
        $oBasket = new oxUserBasket();
        $oBasket->setId( "testUserBasket" );
        $oBasket->save();

        $oBasketItem = new oxUserBasketItem();
        $oBasketItem->setId( 'testitem1' );
        $oBasketItem->oxuserbasketitems__oxbasketid = new oxField($oBasket->getId(), oxField::T_RAW);
        $oBasketItem->oxuserbasketitems__oxartid = new oxField('2000', oxField::T_RAW);
        $oBasketItem->oxuserbasketitems__oxamount = new oxField('1.5', oxField::T_RAW);
        $oBasketItem->save();

        $oBasketItem = new oxUserBasketItem();
        $oBasketItem->setId( 'testitem2' );
        $oBasketItem->oxuserbasketitems__oxbasketid = new oxField($oBasket->getId(), oxField::T_RAW);
        $oBasketItem->oxuserbasketitems__oxartid = new oxField('1126', oxField::T_RAW);
        $oBasketItem->oxuserbasketitems__oxamount = new oxField('3', oxField::T_RAW);
        $oBasketItem->save();

        $oBasketItem = new oxUserBasketItem();
        $oBasketItem->setId( 'testitem3' );
        $oBasketItem->oxuserbasketitems__oxbasketid = new oxField($oBasket->getId(), oxField::T_RAW);
        $oBasketItem->oxuserbasketitems__oxartid = new oxField('2000', oxField::T_RAW);
        $oBasketItem->oxuserbasketitems__oxsellist = new oxField(serialize(array('asd')), oxField::T_RAW);
        $oBasketItem->oxuserbasketitems__oxamount = new oxField('0.5', oxField::T_RAW);
        $oBasketItem->save();

        $oBasket = new oxUserBasket();
        $oBasket->load( "testUserBasket" );

        $oR = $this->getMock('oxBasketReservation', array('getReservations'));
        $oR->expects($this->exactly(1))->method('getReservations')->will($this->returnValue($oBasket));

        $this->assertEquals(array('2000'=>2, '1126'=>3), $oR->UNITgetReservedItems());
    }

    public function testGetReservedAmount()
    {
        $oR = $this->getMock('oxBasketReservation', array('_getReservedItems'));
        $oR->expects($this->exactly(2))->method('_getReservedItems')->will($this->returnValue(array('50'=>2)));

        $this->assertEquals(2, $oR->getReservedAmount('50'));
        $this->assertEquals(0, $oR->getReservedAmount('10'));
    }

    public function testBasketDifference()
    {
        $oBasketItem1 = $this->getProxyClass( "oxbasketitem" );
        $oBasketItem1->setStockCheckStatus(false);
        $oBasketItem1->init( '2000', 1 );
        $oBasketItem1->setNonPublicVar( "_oArticle", null );
        $oBasketItem2 = $this->getProxyClass( "oxbasketitem" );
        $oBasketItem2->setStockCheckStatus(false);
        $oBasketItem2->init( '1126', 1 );
        $oBasketItem2->setNonPublicVar( "_oArticle", null );
        $oBasket = $this->getProxyClass( "oxbasket" );
        $oBasket->setNonPublicVar( "_aBasketContents", array($oBasketItem1, $oBasketItem2) );

        $oR = $this->getMock('oxBasketReservation', array('_getReservedItems'));
        $oR->expects($this->exactly(1))->method('_getReservedItems')->will($this->returnValue(array('2000'=>5)));
        
        $this->assertEquals(array('2000'=>4, '1126'=>-1), $oR->UNITbasketDifference($oBasket));
    }

    public function testReserveArticles()
    {
        $oUB = $this->getMock('stdclass', array('addItemToBasket'));
        $oUB->expects($this->exactly(1))->method('addItemToBasket')->with($this->equalTo('2000'), $this->equalTo(5))->will($this->returnValue(null));

        $oR = $this->getMock('oxBasketReservation', array('getReservations'));
        $oR->expects($this->exactly(1))->method('getReservations')->will($this->returnValue($oUB));

        $oA = $this->getMock('oxarticle', array('reduceStock'));
        $oA->expects($this->exactly(1))->method('reduceStock')->with($this->equalTo(8), $this->equalTo(false))->will($this->returnValue(5));
        oxTestModules::addModuleObject('oxarticle', $oA);

        $oR->UNITreserveArticles(array('1126'=>0, '2000'=>-8));
    }

    public function testReserveBasket()
    {
        $oBasket = $this->getProxyClass( "oxbasket" );

        $oR = $this->getMock('oxBasketReservation', array('_basketDifference', '_reserveArticles'));
        $oR->expects($this->exactly(1))->method('_basketDifference')->with($this->equalTo($oBasket))->will($this->returnValue('asd'));
        $oR->expects($this->exactly(1))->method('_reserveArticles')->with($this->equalTo('asd'))->will($this->returnValue(null));

        $oR->reserveBasket($oBasket);
    }

    public function testCommitArticleReservation()
    {
        $oUB = $this->getMock('stdclass', array('addItemToBasket'));
        $oUB->expects($this->exactly(1))->method('addItemToBasket')->with($this->equalTo('2000'), $this->equalTo(-4))->will($this->returnValue(null));

        $oR = $this->getMock('oxBasketReservation', array('getReservations', 'getReservedAmount'));
        $oR->expects($this->exactly(1))->method('getReservations')->will($this->returnValue($oUB));
        $oR->expects($this->exactly(1))->method('getReservedAmount')->with($this->equalTo('2000'))->will($this->returnValue(4));

        $oA = $this->getMock('oxarticle', array('updateSoldAmount'));
        $oA->expects($this->exactly(1))->method('updateSoldAmount')->with($this->equalTo(4))->will($this->returnValue(null));
        oxTestModules::addModuleObject('oxarticle', $oA);

        $oR->commitArticleReservation(2000, 5);
    }

    public function testDiscardArticleReservation()
    {
        $oUB = $this->getMock('stdclass', array('addItemToBasket'));
        $oUB->expects($this->exactly(1))->method('addItemToBasket')->with($this->equalTo('2000'), $this->equalTo(0), $this->equalTo(null), $this->equalTo(true))->will($this->returnValue(null));

        $oR = $this->getMock('oxBasketReservation', array('getReservations', 'getReservedAmount'));
        $oR->expects($this->exactly(1))->method('getReservations')->will($this->returnValue($oUB));
        $oR->expects($this->exactly(1))->method('getReservedAmount')->with($this->equalTo('2000'))->will($this->returnValue(4));

        $oA = $this->getMock('oxarticle', array('reduceStock'));
        $oA->expects($this->exactly(1))->method('reduceStock')->with($this->equalTo(-4))->will($this->returnValue(null));
        oxTestModules::addModuleObject('oxarticle', $oA);

        $oR->discardArticleReservation(2000);
    }

    public function testDiscardReservations()
    {
        $oR = $this->getMock('oxBasketReservation', array('_getReservedItems', 'discardArticleReservation'));
        $oR->expects($this->at(0))->method('_getReservedItems')->will($this->returnValue(array('a1'=>3, 'a2'=>5)));
        $oR->expects($this->at(1))->method('discardArticleReservation')->with($this->equalTo('a1'))->will($this->returnValue(null));
        $oR->expects($this->at(2))->method('discardArticleReservation')->with($this->equalTo('a2'))->will($this->returnValue(null));
        $oR->discardReservations();
    }

    public function testDiscardUnusedReservations()
    {
        $this->markTestIncomplete();
    }
}
