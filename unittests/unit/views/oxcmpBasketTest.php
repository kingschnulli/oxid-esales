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
 * @version   SVN: $Id: oxcmpBasketTest.php 28399 2010-06-17 08:30:18Z sarunas $
 */

require_once realpath( "." ).'/unit/OxidTestCase.php';
require_once realpath( "." ).'/unit/test_config.inc.php';

class Unit_Views_oxcmpBasketTest extends OxidTestCase
{
    public function testToBasketReturnsNull()
    {
        $o = $this->getMock('oxcmp_basket', array('_getItems'));
        $o->expects($this->once())->method('_getItems')->will($this->returnValue(false));

        oxTestModules::addFunction('oxUtils', 'isSearchEngine', '{return true;}');
        $this->assertSame(null, $o->tobasket());
        oxTestModules::addFunction('oxUtils', 'isSearchEngine', '{return false;}');
        $this->assertSame(null, $o->tobasket());
    }

    public function testToBasketAddProducts()
    {
        $aProducts = array(
            'sProductId' => array(
                'am' => 10,
                'sel' => null,
                'persparam' => null,
                'override'  => 0,
                'basketitemid' => ''
            )
        );

        $oBasket = $this->getMock('oxstdclass', array('getBasketSummary'));
        $oBasket->expects($this->once())->method('getBasketSummary')->will($this->returnValue('basketsummary'));
        $oSession = $this->getMock('oxstdclass', array('getBasket'));
        $oSession->expects($this->once())->method('getBasket')->will($this->returnValue($oBasket));
        $oBItem = $this->getMock('oxstdclass', array('getTitle', 'getProductId', 'getAmount', 'getdBundledAmount'));
        $oBItem->expects($this->once())->method('getTitle')->will($this->returnValue('ret:getTitle'));
        $oBItem->expects($this->once())->method('getProductId')->will($this->returnValue('ret:getProductId'));
        $oBItem->expects($this->once())->method('getAmount')->will($this->returnValue('ret:getAmount'));
        $oBItem->expects($this->once())->method('getdBundledAmount')->will($this->returnValue('ret:getdBundledAmount'));
        $oConfig = $this->getMock('oxstdclass', array('getConfigParam'));
        $oConfig->expects($this->at(0))->method('getConfigParam')->with($this->equalTo('iNewBasketItemMessage'))->will($this->returnValue('2'));
        $oConfig->expects($this->at(1))->method('getConfigParam')->with($this->equalTo('iNewBasketItemMessage'))->will($this->returnValue('2'));

        $o = $this->getMock('oxcmp_basket', array('_getItems', '_setLastCall', '_addItems', 'getSession', 'getConfig'));
        $o->expects($this->once())->method('_getItems')->will($this->returnValue($aProducts));
        $o->expects($this->once())->method('_setLastCall')
                ->with(
                        $this->equalTo('tobasket'),
                        $this->equalTo($aProducts),
                        $this->equalTo('basketsummary')
                )
                ->will($this->returnValue(null));
        $o->expects($this->once())->method('_addItems')->with($this->equalTo($aProducts))->will($this->returnValue($oBItem));
        $o->expects($this->once())->method('getSession')->will($this->returnValue($oSession));
        $o->expects($this->exactly(2))->method('getConfig')->will($this->returnValue($oConfig));

        $this->assertSame(null, $o->tobasket());

        $oNewItem = oxSession::getVar( '_newitem' );
        $this->assertTrue($oNewItem instanceof oxstdclass);
        $this->assertEquals('ret:getTitle', $oNewItem->sTitle);
        $this->assertEquals('ret:getProductId', $oNewItem->sId);
        $this->assertEquals('ret:getAmount', $oNewItem->dAmount);
        $this->assertEquals('ret:getdBundledAmount', $oNewItem->dBundledAmount);
    }

    public function testToBasketAddProductsNoBasketMsgAndRedirect()
    {
        $aProducts = array(
            'sProductId' => array(
                'am' => 10,
                'sel' => null,
                'persparam' => null,
                'override'  => 0,
                'basketitemid' => ''
            )
        );

        $oBasket = $this->getMock('oxstdclass', array('getBasketSummary'));
        $oBasket->expects($this->once())->method('getBasketSummary')->will($this->returnValue('basketsummary'));
        $oSession = $this->getMock('oxstdclass', array('getBasket'));
        $oSession->expects($this->once())->method('getBasket')->will($this->returnValue($oBasket));
        $oBItem = $this->getMock('oxstdclass', array('getTitle', 'getProductId', 'getAmount', 'getdBundledAmount'));
        $oBItem->expects($this->never())->method('getTitle')->will($this->returnValue('ret:getTitle'));
        $oBItem->expects($this->never())->method('getProductId')->will($this->returnValue('ret:getProductId'));
        $oBItem->expects($this->never())->method('getAmount')->will($this->returnValue('ret:getAmount'));
        $oBItem->expects($this->never())->method('getdBundledAmount')->will($this->returnValue('ret:getdBundledAmount'));
        $oConfig = $this->getMock('oxstdclass', array('getConfigParam'));
        $oConfig->expects($this->at(0))->method('getConfigParam')->with($this->equalTo('iNewBasketItemMessage'))->will($this->returnValue('0'));
        $oConfig->expects($this->at(1))->method('getConfigParam')->with($this->equalTo('iNewBasketItemMessage'))->will($this->returnValue('3'));

        $o = $this->getMock('oxcmp_basket', array('_getItems', '_setLastCall', '_addItems', 'getSession', 'getConfig', '_getRedirectUrl'));
        $o->expects($this->once())->method('_getItems')->will($this->returnValue($aProducts));
        $o->expects($this->once())->method('_setLastCall')
                ->with(
                        $this->equalTo('tobasket'),
                        $this->equalTo($aProducts),
                        $this->equalTo('basketsummary')
                )
                ->will($this->returnValue(null));
        $o->expects($this->once())->method('_addItems')->with($this->equalTo($aProducts))->will($this->returnValue($oBItem));
        $o->expects($this->once())->method('getSession')->will($this->returnValue($oSession));
        $o->expects($this->exactly(2))->method('getConfig')->will($this->returnValue($oConfig));
        $o->expects($this->once())->method('_getRedirectUrl')->will($this->returnValue('new url'));

        $this->assertEquals('new url', $o->tobasket());

        $oNewItem = oxSession::getVar( '_newitem' );
        $this->assertSame(null, $oNewItem);
    }

    public function testChangeBasketSearchEngine()
    {
        $oUtils = $this->getMock('oxUtils', array('isSearchEngine'));
        $oUtils->expects($this->once())->method('isSearchEngine')->will($this->returnValue(true));

        $o = $this->getMock('oxcmp_basket', array('_getItems'));
        $o->expects($this->never())->method('_getItems');

        modInstances::addMod('oxUtils', $oUtils);

        $this->assertSame(null, $o->changebasket());
    }

    public function testChangeBasketTakesParamsFromArgsGetItemsNull()
    {
        $o = $this->getMock('oxcmp_basket', array('_getItems', 'getSession'));
        $o->expects($this->once())->method('_getItems')
            ->with(
                    $this->equalTo('abc'),
                    $this->equalTo(10),
                    $this->equalTo('sel'),
                    $this->equalTo('persparam'),
                    $this->equalTo('override')
            )->will($this->returnValue(null));
        $o->expects($this->never())->method('getSession');

        $this->assertSame(null, $o->changebasket('abc', 10, 'sel', 'persparam', 'override'));
    }

    public function testChangeBasketTakesParamsFromArgs()
    {
        $aProducts = array(
            'sProductId' => array(
                'am' => 10,
                'sel' => null,
                'persparam' => null,
                'override'  => 0,
                'basketitemid' => ''
            )
        );
        $oBasket = $this->getMock('oxstdclass', array('getBasketSummary', 'onUpdate'));
        $oBasket->expects($this->once())->method('getBasketSummary')->will($this->returnValue('basketsummary'));
        $oBasket->expects($this->once())->method('onUpdate')->will($this->returnValue(null));
        $oSession = $this->getMock('oxstdclass', array('getBasket'));
        $oSession->expects($this->once())->method('getBasket')->will($this->returnValue($oBasket));
        $oBItem = $this->getMock('oxstdclass', array('getTitle', 'getProductId', 'getAmount', 'getdBundledAmount'));
        $oBItem->expects($this->never())->method('getTitle')->will($this->returnValue('ret:getTitle'));
        $oBItem->expects($this->never())->method('getProductId')->will($this->returnValue('ret:getProductId'));
        $oBItem->expects($this->never())->method('getAmount')->will($this->returnValue('ret:getAmount'));
        $oBItem->expects($this->never())->method('getdBundledAmount')->will($this->returnValue('ret:getdBundledAmount'));

        $o = $this->getMock('oxcmp_basket', array('_getItems', '_setLastCall', '_addItems', 'getSession', 'getConfig', '_getRedirectUrl'));
        $o->expects($this->once())->method('_getItems')
            ->with(
                    $this->equalTo('abc'),
                    $this->equalTo(11),
                    $this->equalTo('sel'),
                    $this->equalTo('persparam'),
                    $this->equalTo('override')
            )->will($this->returnValue($aProducts));
        $o->expects($this->once())->method('_setLastCall')
                ->with(
                        $this->equalTo('changebasket'),
                        $this->equalTo($aProducts),
                        $this->equalTo('basketsummary')
                )
                ->will($this->returnValue(null));
        $o->expects($this->once())->method('_addItems')->with($this->equalTo($aProducts))->will($this->returnValue($oBItem));
        $o->expects($this->once())->method('getSession')->will($this->returnValue($oSession));
        $o->expects($this->never())->method('getConfig')->will($this->returnValue($oConfig));
        $o->expects($this->never())->method('_getRedirectUrl')->will($this->returnValue(null));

        $this->assertSame(null, $o->changebasket('abc', 11, 'sel', 'persparam', 'override'));
    }

    public function testChangeBasketTakesParamsFromRequestArtByBindex()
    {
        $oArt = $this->getMock('oxstdclass', array('getProductId'));
        $oArt->expects($this->once())->method('getProductId')->will($this->returnValue('b:artid'));
        $oBasket = $this->getMock('oxstdclass', array('getContents'));
        $oBasket->expects($this->once())->method('getContents')->will($this->returnValue(array('b:bindex'=>$oArt)));
        $oSession = $this->getMock('oxstdclass', array('getBasket'));
        $oSession->expects($this->once())->method('getBasket')->will($this->returnValue($oBasket));

        $o = $this->getMock('oxcmp_basket', array('_getItems', 'getSession'));
        $o->expects($this->once())->method('_getItems')
            ->with(
                    $this->equalTo('b:artid'),
                    $this->equalTo('b:am'),
                    $this->equalTo('b:sel'),
                    $this->equalTo('b:persparam'),
                    $this->equalTo(true)
            )->will($this->returnValue(null));
        $o->expects($this->once())->method('getSession')->will($this->returnValue($oSession));

        modConfig::setParameter( 'bindex', 'b:bindex');
        modConfig::setParameter( 'am', 'b:am');
        modConfig::setParameter( 'sel', 'b:sel');
        modConfig::setParameter( 'persparam', 'b:persparam');
        $this->assertSame(null, $o->changebasket());
    }

    public function testChangeBasketTakesParamsFromRequestArtByAid()
    {
        $o = $this->getMock('oxcmp_basket', array('_getItems', 'getSession'));
        $o->expects($this->once())->method('_getItems')
            ->with(
                    $this->equalTo('b:artid'),
                    $this->equalTo('b:am'),
                    $this->equalTo('b:sel'),
                    $this->equalTo('b:persparam'),
                    $this->equalTo(true)
            )->will($this->returnValue(null));
        $o->expects($this->never())->method('getSession')->will($this->returnValue($oSession));

        modConfig::setParameter( 'aid', 'b:artid');
        modConfig::setParameter( 'am', 'b:am');
        modConfig::setParameter( 'sel', 'b:sel');
        modConfig::setParameter( 'persparam', 'b:persparam');
        $this->assertSame(null, $o->changebasket());
    }

    public function testWlToBasketSearchEngine()
    {
        $oUtils = $this->getMock('oxUtils', array('isSearchEngine'));
        $oUtils->expects($this->once())->method('isSearchEngine')->will($this->returnValue(true));

        $o = $this->getMock('oxcmp_basket', array('_getItems'));
        $o->expects($this->never())->method('_getItems');

        modInstances::addMod('oxUtils', $oUtils);

        $this->assertSame(null, $o->wl_tobasket());
    }

    public function testWlTobasketTakesParamsFromArgsGetItemsNull()
    {
        $o = $this->getMock('oxcmp_basket', array('_getItems', 'getSession', '_getRedirectUrl'));
        $o->expects($this->once())->method('_getItems')
            ->with(
                    $this->equalTo('abc'),
                    $this->equalTo(10),
                    $this->equalTo('sel'),
                    $this->equalTo('persparam'),
                    $this->equalTo('override')
            )->will($this->returnValue(null));
        $o->expects($this->never())->method('getSession');
        $o->expects($this->once())->method('_getRedirectUrl')->will($this->returnValue('retvalredirect'));

        $this->assertEquals('retvalredirect', $o->wl_tobasket('abc', 10, 'sel', 'persparam', 'override'));
    }
    public function testWlTobasketTakesParamsFromRequestGetItemsNull()
    {
        $o = $this->getMock('oxcmp_basket', array('_getItems', 'getSession', '_getRedirectUrl', '_addItems'));
        $o->expects($this->once())->method('_getItems')
            ->with(
                    $this->equalTo('b:artid'),
                    $this->equalTo('b:am'),
                    $this->equalTo('b:sel'),
                    $this->equalTo('b:persparam'),
                    $this->equalTo(false)
            )->will($this->returnValue(null));
        $o->expects($this->never())->method('getSession');
        $o->expects($this->never())->method('_addItems');
        $o->expects($this->once())->method('_getRedirectUrl')->will($this->returnValue('retvalredirect'));

        modConfig::setParameter( 'aid', 'b:artid');
        modConfig::setParameter( 'am', 'b:am');
        modConfig::setParameter( 'sel', 'b:sel');
        modConfig::setParameter( 'persparam', 'b:persparam');
        $this->assertEquals('retvalredirect', $o->wl_tobasket());
    }

    public function testWlTobasketTakesParamsFromRequestFailToLoadWishListUser()
    {
        $aProducts = array(
            'sProductId' => array(
                'am' => 10,
                'sel' => null,
                'persparam' => null,
                'override'  => 0,
                'basketitemid' => ''
            )
        );
        $oBasket = $this->getMock('oxstdclass', array('getBasketSummary'));
        $oBasket->expects($this->once())->method('getBasketSummary')->will($this->returnValue('basketsummary'));
        $oSession = $this->getMock('oxstdclass', array('getBasket'));
        $oSession->expects($this->once())->method('getBasket')->will($this->returnValue($oBasket));
        $oBItem = $this->getMock('oxstdclass', array('setWishId', 'setWishArticleId'));
        $oBItem->expects($this->never())->method('setWishId');
        $oBItem->expects($this->once())->method('setWishArticleId')->with($this->equalTo('b:artidn'));
        $oUser = $this->getMock('stdclass', array());


        $o = $this->getMock('oxcmp_basket', array('_getItems', '_setLastCall', '_addItems', 'getSession', '_getRedirectUrl', 'getUser'));
        $o->expects($this->once())->method('_getItems')
            ->with(
                    $this->equalTo('b:artid'),
                    $this->equalTo('b:am'),
                    $this->equalTo('b:sel'),
                    $this->equalTo('b:persparam'),
                    $this->equalTo(false)
            )->will($this->returnValue($aProducts));
        $o->expects($this->once())->method('getSession')->will($this->returnValue($oSession));
        $o->expects($this->once())->method('_addItems')->with($this->equalTo($aProducts))->will($this->returnValue($oBItem));
        $o->expects($this->once())->method('getUser')->will($this->returnValue($oUser));
        $o->expects($this->once())->method('_getRedirectUrl')->will($this->returnValue('retvalredirect'));
        $o->expects($this->once())->method('_setLastCall')
                ->with(
                        $this->equalTo('tobasket'),
                        $this->equalTo($aProducts),
                        $this->equalTo('basketsummary')
                )
                ->will($this->returnValue(null));

        modConfig::setParameter( 'aid', 'b:artid');
        modConfig::setParameter( 'anid', 'b:artidn');
        modConfig::setParameter( 'am', 'b:am');
        modConfig::setParameter( 'sel', 'b:sel');
        modConfig::setParameter( 'persparam', 'b:persparam');
        modConfig::setParameter( 'owishid', 'wluserid');

        $oWlUser = $this->getMock('stdclass', array('load'));
        $oWlUser->expects($this->once())->method('load')
                ->with(
                        $this->equalTo('wluserid')
                )
                ->will($this->returnValue(false));

        $oUtilsObj = $this->getMock('oxUtilsObject', array('oxNew'));
        $oUtilsObj->expects($this->once())->method('oxNew')->with($this->equalTo('oxuser'))->will($this->returnValue($oWlUser));
        modInstances::addMod('oxUtilsObject', $oUtilsObj);

        $this->assertEquals('retvalredirect', $o->wl_tobasket());
    }

    public function testWlTobasketTakesParamsFromRequest()
    {
        $aProducts = array(
            'sProductId' => array(
                'am' => 10,
                'sel' => null,
                'persparam' => null,
                'override'  => 0,
                'basketitemid' => ''
            )
        );
        $oBasket = $this->getMock('oxstdclass', array('getBasketSummary'));
        $oBasket->expects($this->once())->method('getBasketSummary')->will($this->returnValue('basketsummary'));
        $oSession = $this->getMock('oxstdclass', array('getBasket'));
        $oSession->expects($this->once())->method('getBasket')->will($this->returnValue($oBasket));
        $oBItem = $this->getMock('oxstdclass', array('setWishId', 'setWishArticleId'));
        $oBItem->expects($this->once())->method('setWishId')->with($this->equalTo('wluserid'));
        $oBItem->expects($this->once())->method('setWishArticleId')->with($this->equalTo('b:artidn'));
        $oWlUser = $this->getMock('stdclass', array('load'));
        $oWlUser->expects($this->once())->method('load')
                ->with(
                        $this->equalTo('wluserid')
                )
                ->will($this->returnValue(true));
        $oUser = $this->getMock('stdclass', array('addUserAddress'));
        $oUser->expects($this->once())->method('addUserAddress')->with($this->equalTo($oWlUser));


        $o = $this->getMock('oxcmp_basket', array('_getItems', '_setLastCall', '_addItems', 'getSession', '_getRedirectUrl', 'getUser'));
        $o->expects($this->once())->method('_getItems')
            ->with(
                    $this->equalTo('b:artid'),
                    $this->equalTo('b:am'),
                    $this->equalTo('b:sel'),
                    $this->equalTo('b:persparam'),
                    $this->equalTo(false)
            )->will($this->returnValue($aProducts));
        $o->expects($this->once())->method('getSession')->will($this->returnValue($oSession));
        $o->expects($this->once())->method('_addItems')->with($this->equalTo($aProducts))->will($this->returnValue($oBItem));
        $o->expects($this->once())->method('getUser')->will($this->returnValue($oUser));
        $o->expects($this->once())->method('_getRedirectUrl')->will($this->returnValue('retvalredirect'));
        $o->expects($this->once())->method('_setLastCall')
                ->with(
                        $this->equalTo('tobasket'),
                        $this->equalTo($aProducts),
                        $this->equalTo('basketsummary')
                )
                ->will($this->returnValue(null));

        modConfig::setParameter( 'aid', 'b:artid');
        modConfig::setParameter( 'anid', 'b:artidn');
        modConfig::setParameter( 'am', 'b:am');
        modConfig::setParameter( 'sel', 'b:sel');
        modConfig::setParameter( 'persparam', 'b:persparam');
        modConfig::setParameter( 'owishid', 'wluserid');

        $oUtilsObj = $this->getMock('oxUtilsObject', array('oxNew'));
        $oUtilsObj->expects($this->once())->method('oxNew')->with($this->equalTo('oxuser'))->will($this->returnValue($oWlUser));
        modInstances::addMod('oxUtilsObject', $oUtilsObj);

        $this->assertEquals('retvalredirect', $o->wl_tobasket());
    }


    public function testGetRedirectUrl()
    {
        foreach (array (
                                 'cnid',        // category id
                                 'mnid',        // manufacturer id
                                 'anid',        // active article id
                                 'tpl',         // spec. template
                                 'listtype',    // list type
                                 'searchcnid',  // search category
                                 'searchvendor',// search vendor
                                 'searchmanufacturer',// search manufacturer
                                 'searchtag',   // search tag
                                 'searchrecomm',// search recomendation
                                 'recommid'     // recomm. list id
            ) as $key) {
            modConfig::setParameter($key, 'value:'.$key.":v");
        }

        modConfig::setParameter('cl', 'cla');
        modConfig::setParameter('searchparam', 'search&&a');
        modConfig::setParameter('pgNr', 123);


        $oCfg = $this->getMock('stdclass', array('getConfigParam'));
        $oCfg->expects($this->at(0))->method('getConfigParam')->with($this->equalTo('iNewBasketItemMessage'))->will($this->returnValue(0));
        $oCfg->expects($this->at(1))->method('getConfigParam')->with($this->equalTo('iNewBasketItemMessage'))->will($this->returnValue(0));
        $oCfg->expects($this->at(2))->method('getConfigParam')->with($this->equalTo('iNewBasketItemMessage'))->will($this->returnValue(3));

        $o = $this->getMock('oxcmp_basket', array('getConfig'));
        $o->expects($this->exactly(3))->method('getConfig')->will($this->returnValue($oCfg));

        $this->assertEquals('cla?cnid=value:cnid:v&mnid=value:mnid:v&anid=value:anid:v&tpl=value:tpl:v&listtype=value:listtype:v&searchcnid=value:searchcnid:v&searchvendor=value:searchvendor:v&searchmanufacturer=value:searchmanufacturer:v&searchtag=value:searchtag:v&searchrecomm=value:searchrecomm:v&recommid=value:recommid:v&searchparam=search%26%26a&pgNr=123&', $o->UNITgetRedirectUrl());

        modConfig::setParameter('cl', null);
        modConfig::setParameter('pgNr', 'a123');
        $this->assertEquals('start?cnid=value:cnid:v&mnid=value:mnid:v&anid=value:anid:v&tpl=value:tpl:v&listtype=value:listtype:v&searchcnid=value:searchcnid:v&searchvendor=value:searchvendor:v&searchmanufacturer=value:searchmanufacturer:v&searchtag=value:searchtag:v&searchrecomm=value:searchrecomm:v&recommid=value:recommid:v&searchparam=search%26%26a&', $o->UNITgetRedirectUrl());

        $this->assertEquals(null, oxSession::getVar('_backtoshop'));

        modConfig::setParameter('pgNr', '0');
        $this->assertEquals('basket?cnid=value:cnid:v&mnid=value:mnid:v&anid=value:anid:v&tpl=value:tpl:v&listtype=value:listtype:v&searchcnid=value:searchcnid:v&searchvendor=value:searchvendor:v&searchmanufacturer=value:searchmanufacturer:v&searchtag=value:searchtag:v&searchrecomm=value:searchrecomm:v&recommid=value:recommid:v&searchparam=search%26%26a&', $o->UNITgetRedirectUrl());
        $this->assertEquals('start?cnid=value:cnid:v&mnid=value:mnid:v&anid=value:anid:v&tpl=value:tpl:v&listtype=value:listtype:v&searchcnid=value:searchcnid:v&searchvendor=value:searchvendor:v&searchmanufacturer=value:searchmanufacturer:v&searchtag=value:searchtag:v&searchrecomm=value:searchrecomm:v&recommid=value:recommid:v&searchparam=search%26%26a&', oxSession::getVar('_backtoshop'));
    }

    public function testGetItemsFromArgs()
    {
        $o =new oxcmp_basket();
        $this->assertEquals(array
            (
                'abc' => array
                    (
                        'am' => 10,
                        'sel' => 'sel',
                        'persparam' => 'persparam',
                        'override' => 'override',
                        'basketitemid' => '',
                    )

            ),
            $o->UNITgetItems('abc', 10, 'sel', 'persparam', 'override'));
    }

    public function testGetItemsFromArgsEmpty()
    {
        $o =new oxcmp_basket();
        $this->assertEquals(false, $o->UNITgetItems('', 10, 'sel', 'persparam', 'override'));
    }

    public function testGetItemsFromArgsRm()
    {
        modConfig::setParameter( 'aproducts', array(
                                                'abc' => array
                                                (
                                                    'am' => 10,
                                                    'sel' => 'sel',
                                                    'persparam' => 'persparam',
                                                    'override' => 'override',
                                                    'basketitemid' => '',
                                                    'remove' => 1,
                                                )
                                             )
                                );
        modConfig::setParameter( 'removeBtn', 1);
        $o =new oxcmp_basket();
        $this->assertEquals(array(
                                                'abc' => array
                                                (
                                                    'am' => 0,
                                                    'sel' => 'sel',
                                                    'persparam' => 'persparam',
                                                    'override' => 'override',
                                                    'basketitemid' => '',
                                                    'remove' => 1,
                                                )
                                             ),
                $o->UNITgetItems('', 10, 'sel', 'persparam', 'override'));
    }

    public function testGetItemsFromRequest()
    {
        modConfig::setParameter( 'aid', 'b:artid');
        modConfig::setParameter( 'anid', 'b:artidn');
        modConfig::setParameter( 'am', 'b:am');
        modConfig::setParameter( 'sel', 'b:sel');
        modConfig::setParameter( 'persparam', 'b:persparam');
        modConfig::setParameter( 'bindex', 'bindex');

        $o =new oxcmp_basket();
        $this->assertEquals(array
            (
                'b:artid' => array
                    (
                        'am' => 'b:am',
                        'sel' => 'b:sel',
                        'persparam' => 'b:persparam',
                        'override' => false,
                        'basketitemid' => 'bindex',
                    )

            ),
            $o->UNITgetItems());
    }


    public function testGetItemsFromRequestRemoveBtn()
    {
        modConfig::setParameter( 'removeBtn', '1');
        modConfig::setParameter( 'aid', 'b:artid');
        modConfig::setParameter( 'anid', 'b:artidn');
        modConfig::setParameter( 'am', 'b:am');
        modConfig::setParameter( 'sel', 'b:sel');
        modConfig::setParameter( 'persparam', 'b:persparam');
        modConfig::setParameter( 'bindex', 'bindex');

        $o =new oxcmp_basket();
        $this->assertEquals(array
            (
            ),
            $o->UNITgetItems());
    }

    public function testAddItems()
    {
        $oBasket = $this->getMock('oxstdclass', array('addToBasket'));
        $oBasket->expects($this->at(0))->method('addToBasket')
                ->with(
                    $this->equalTo('a_aid'),
                    $this->equalTo('a_am'),
                    $this->equalTo('a_sel'),
                    $this->equalTo('a_persparam'),
                    $this->equalTo('a_override'),
                    $this->equalTo('a_basketitemid')
                )->will($this->returnValue('aaa1'));
        $oBasket->expects($this->at(1))->method('addToBasket')
                ->with(
                    $this->equalTo('b_aid'),
                    $this->equalTo('b_am'),
                    $this->equalTo('b_sel'),
                    $this->equalTo('b_persparam'),
                    $this->equalTo('b_override'),
                    $this->equalTo('b_basketitemid')
                )->will($this->returnValue('aaa2'));
        $oSession = $this->getMock('oxstdclass', array('getBasket'));
        $oSession->expects($this->once())->method('getBasket')->will($this->returnValue($oBasket));

        $o = $this->getMock('oxcmp_basket', array('getSession'));
        $o->expects($this->once())->method('getSession')->will($this->returnValue($oSession));

        $this->assertEquals('aaa2', $o->UNITaddItems(
                array(
                    array(
                        'aid' => 'a_aid',
                        'am' => 'a_am',
                        'sel' => 'a_sel',
                        'persparam' => 'a_persparam',
                        'override' => 'a_override',
                        'bundle' => 'a_bundle',
                        'basketitemid' => 'a_basketitemid',
                    ),
                    array(
                        'aid' => 'b_aid',
                        'am' => 'b_am',
                        'sel' => 'b_sel',
                        'persparam' => 'b_persparam',
                        'override' => 'b_override',
                        'bundle' => 'b_bundle',
                        'basketitemid' => 'b_basketitemid',
                    ),
                )
            )
        );
    }


    public function testAddItemsOutOfStockException()
    {
        $oException = $this->getMock('oxOutOfStockException', array('setDestination'));
        $oException->expects($this->once())->method('setDestination')->with($this->equalTo('Errors:a'))->will($this->returnValue(null));

        $oUtilsView = $this->getMock('oxUtilsView', array('addErrorToDisplay'));
        $oUtilsView->expects($this->once())->method('addErrorToDisplay')
                ->with(
                    $this->equalTo($oException),
                    $this->equalTo(false),
                    $this->equalTo(true),
                    $this->equalTo('Errors:a')
                );
        modInstances::addMod('oxUtilsView', $oUtilsView);


        $oBasket = $this->getMock('oxstdclass', array('addToBasket'));
        $oBasket->expects($this->once())->method('addToBasket')
                ->will($this->throwException($oException));
        $oSession = $this->getMock('oxstdclass', array('getBasket'));
        $oSession->expects($this->once())->method('getBasket')->will($this->returnValue($oBasket));

        $oView = $this->getMock('oxstdclass', array('getErrorDestination'));
        $oView->expects($this->once())->method('getErrorDestination')->will($this->returnValue('Errors:a'));
        $oConfig = $this->getMock('oxstdclass', array('getActiveView', 'getConfigParam'));
        $oConfig->expects($this->once())->method('getActiveView')->will($this->returnValue($oView));
        $oConfig->expects($this->never())->method('getConfigParam');//->with($this->equalTo('iNewBasketItemMessage'))->will($this->returnValue(1));

        $o = $this->getMock('oxcmp_basket', array('getSession', 'getConfig'));
        $o->expects($this->once())->method('getSession')->will($this->returnValue($oSession));
        $o->expects($this->exactly(1))->method('getConfig')->will($this->returnValue($oConfig));

        $this->assertEquals(null, $o->UNITaddItems(
                array(
                    array(
                    ),
                )
            )
        );
    }

    public function testAddItemsOutOfStockExceptionNoErrorPlace()
    {
        $oException = $this->getMock('oxOutOfStockException', array('setDestination'));
        $oException->expects($this->once())->method('setDestination')->with($this->equalTo(''))->will($this->returnValue(null));

        $oUtilsView = $this->getMock('oxUtilsView', array('addErrorToDisplay'));
        $oUtilsView->expects($this->once())->method('addErrorToDisplay')
                ->with(
                    $this->equalTo($oException),
                    $this->equalTo(false),
                    $this->equalTo(true),
                    $this->equalTo('popup')
                );
        modInstances::addMod('oxUtilsView', $oUtilsView);


        $oBasket = $this->getMock('oxstdclass', array('addToBasket'));
        $oBasket->expects($this->once())->method('addToBasket')
                ->will($this->throwException($oException));
        $oSession = $this->getMock('oxstdclass', array('getBasket'));
        $oSession->expects($this->once())->method('getBasket')->will($this->returnValue($oBasket));

        $oView = $this->getMock('oxstdclass', array('getErrorDestination'));
        $oView->expects($this->once())->method('getErrorDestination')->will($this->returnValue(''));
        $oConfig = $this->getMock('oxstdclass', array('getActiveView', 'getConfigParam'));
        $oConfig->expects($this->once())->method('getActiveView')->will($this->returnValue($oView));
        $oConfig->expects($this->once())->method('getConfigParam')->with($this->equalTo('iNewBasketItemMessage'))->will($this->returnValue(2));

        $o = $this->getMock('oxcmp_basket', array('getSession', 'getConfig'));
        $o->expects($this->once())->method('getSession')->will($this->returnValue($oSession));
        $o->expects($this->exactly(2))->method('getConfig')->will($this->returnValue($oConfig));

        $this->assertEquals(null, $o->UNITaddItems(
                array(
                    array(
                    ),
                )
            )
        );
    }




    public function testAddItemsArticleInputException()
    {
        $oException = $this->getMock('oxArticleInputException', array('setDestination'));
        $oException->expects($this->once())->method('setDestination')->with($this->equalTo('Errors:a'))->will($this->returnValue(null));

        $oUtilsView = $this->getMock('oxUtilsView', array('addErrorToDisplay'));
        $oUtilsView->expects($this->once())->method('addErrorToDisplay')
                ->with(
                    $this->equalTo($oException),
                    $this->equalTo(false),
                    $this->equalTo(true),
                    $this->equalTo('Errors:a')
                );
        modInstances::addMod('oxUtilsView', $oUtilsView);


        $oBasket = $this->getMock('oxstdclass', array('addToBasket'));
        $oBasket->expects($this->once())->method('addToBasket')
                ->will($this->throwException($oException));
        $oSession = $this->getMock('oxstdclass', array('getBasket'));
        $oSession->expects($this->once())->method('getBasket')->will($this->returnValue($oBasket));

        $oView = $this->getMock('oxstdclass', array('getErrorDestination'));
        $oView->expects($this->once())->method('getErrorDestination')->will($this->returnValue('Errors:a'));
        $oConfig = $this->getMock('oxstdclass', array('getActiveView', 'getConfigParam'));
        $oConfig->expects($this->once())->method('getActiveView')->will($this->returnValue($oView));
        $oConfig->expects($this->never())->method('getConfigParam');//->with($this->equalTo('iNewBasketItemMessage'))->will($this->returnValue(1));

        $o = $this->getMock('oxcmp_basket', array('getSession', 'getConfig'));
        $o->expects($this->once())->method('getSession')->will($this->returnValue($oSession));
        $o->expects($this->exactly(1))->method('getConfig')->will($this->returnValue($oConfig));

        $this->assertEquals(null, $o->UNITaddItems(
                array(
                    array(
                    ),
                )
            )
        );
    }

    public function testAddItemsNoArticleException()
    {
        $oException = $this->getMock('oxNoArticleException', array('setDestination'));
        $oException->expects($this->never())->method('setDestination');

        $oBasket = $this->getMock('oxstdclass', array('addToBasket'));
        $oBasket->expects($this->once())->method('addToBasket')
                ->will($this->throwException($oException));
        $oSession = $this->getMock('oxstdclass', array('getBasket'));
        $oSession->expects($this->once())->method('getBasket')->will($this->returnValue($oBasket));

        $oView = $this->getMock('oxstdclass', array('getErrorDestination'));
        $oView->expects($this->once())->method('getErrorDestination')->will($this->returnValue('Errors:a'));
        $oConfig = $this->getMock('oxstdclass', array('getActiveView', 'getConfigParam'));
        $oConfig->expects($this->once())->method('getActiveView')->will($this->returnValue($oView));
        $oConfig->expects($this->never())->method('getConfigParam');//->with($this->equalTo('iNewBasketItemMessage'))->will($this->returnValue(1));

        $o = $this->getMock('oxcmp_basket', array('getSession', 'getConfig'));
        $o->expects($this->once())->method('getSession')->will($this->returnValue($oSession));
        $o->expects($this->exactly(1))->method('getConfig')->will($this->returnValue($oConfig));

        $this->assertEquals(null, $o->UNITaddItems(
                array(
                    array(
                    ),
                )
            )
        );
    }


    public function testRender()
    {
        $oBasket = $this->getMock('oxstdclass', array('calculateBasket'));
        $oBasket->expects($this->once())->method('calculateBasket')->with($this->equalTo(false))->will($this->returnValue(null));
        $oSession = $this->getMock('oxstdclass', array('getBasket'));
        $oSession->expects($this->once())->method('getBasket')->will($this->returnValue($oBasket));

        $o = $this->getMock('oxcmp_basket', array('getSession'));
        $o->expects($this->once())->method('getSession')->will($this->returnValue($oSession));

        $this->assertSame($oBasket, $o->render());
    }

    public function testSetLastCall()
    {
        $aProductInfo = array(
                    'a_aid' => array(
                        'aid' => 'a_aid',
                        'am' => 'a_am',
                        'sel' => 'a_sel',
                        'persparam' => 'a_persparam',
                        'override' => 'a_override',
                        'bundle' => 'a_bundle',
                        'basketitemid' => 'a_basketitemid',
                    ),
                    'b_aid' => array(
                        'aid' => 'b_aid',
                        'am' => 'b_am',
                        'sel' => 'b_sel',
                        'persparam' => 'b_persparam',
                        'override' => 'b_override',
                        'bundle' => 'b_bundle',
                        'basketitemid' => 'b_basketitemid',
                    ),
        );
        $aBasketInfo = (object)array(
            'aArticles' => array('b_aid' => 15)
        );
        $o = new oxcmp_basket();
        $this->assertSame(null, $o->UNITsetLastCall('sCallName', $aProductInfo, $aBasketInfo));
        $this->assertEquals(array('sCallName' =>
                array(
                    'a_aid' => array(
                        'aid' => 'a_aid',
                        'am' => 'a_am',
                        'sel' => 'a_sel',
                        'persparam' => 'a_persparam',
                        'override' => 'a_override',
                        'bundle' => 'a_bundle',
                        'basketitemid' => 'a_basketitemid',
                        'oldam' => 0,
                    ),
                    'b_aid' => array(
                        'aid' => 'b_aid',
                        'am' => 'b_am',
                        'sel' => 'b_sel',
                        'persparam' => 'b_persparam',
                        'override' => 'b_override',
                        'bundle' => 'b_bundle',
                        'basketitemid' => 'b_basketitemid',
                        'oldam' => 15,
                    ),
                )
            ),
            oxSession::getVar('aLastcall'));
    }


    /**
     * Testing oxcmp_categories::isRootCatChanged() test case used for bascet exclude
     *
     * @return null
     */
    public function testIsRootCatChanged_clean()
    {
        modConfig::getInstance()->setConfigParam( "blBasketExcludeEnabled", true );

        $oCmp = oxNew('oxcmp_basket');
        $this->assertFalse( $oCmp->isRootCatChanged() );
    }

    /**
     * Testing oxcmp_categories::isRootCatChanged() test case used for bascet exclude
     *
     * @return null
     */
    public function testIsRootCatChanged_unchanged_session()
    {
        modConfig::getInstance()->setConfigParam( "blBasketExcludeEnabled", true );

        $oCmp = oxNew('oxcmp_basket');
        $this->assertFalse( $oCmp->isRootCatChanged() );
    }

    
    public function testInitNormalShop()
    {
        modConfig::getInstance()->setConfigParam('blBasketReservationEnabled', false);

        $oS = $this->getMock('oxsession', array('getBasketReservations', 'getBasket'));
        $oS->expects($this->never())->method('getBasketReservations');
        $oS->expects($this->never())->method('getBasket');

        $oCB = $this->getMock('oxcmp_basket', array('getSession'));
        $oCB->expects($this->any())->method('getSession')->will($this->returnValue($oS));

        $oCB->init();
    }

    public function testInitReservationNotTimeouted()
    {
        modConfig::getInstance()->setConfigParam('blBasketReservationEnabled', true);
        modConfig::getInstance()->setConfigParam('iBasketReservationCleanPerRequest', 320);

        $oBR = $this->getMock('stdclass', array('getTimeLeft', 'discardUnusedReservations'));
        $oBR->expects($this->once())->method('getTimeLeft')->will($this->returnValue(2));
        $oBR->expects($this->once())->method('discardUnusedReservations')->with($this->equalTo(320));

        $oS = $this->getMock('oxsession', array('getBasketReservations', 'getBasket'));
        $oS->expects($this->once())->method('getBasketReservations')->will($this->returnValue($oBR));
        $oS->expects($this->never())->method('getBasket');

        $oCB = $this->getMock('oxcmp_basket', array('getSession'));
        $oCB->expects($this->any())->method('getSession')->will($this->returnValue($oS));

        $oCB->init();
    }


    public function testInitReservationTimeouted()
    {
        modConfig::getInstance()->setConfigParam('blBasketReservationEnabled', true);
        // also check the default (hardcoded) value is 200, if iBasketReservationCleanPerRequest is 0
        modConfig::getInstance()->setConfigParam('iBasketReservationCleanPerRequest', 0);

        $oB = $this->getMock('stdclass', array('deleteBasket'));
        $oB->expects($this->once())->method('deleteBasket')->will($this->returnValue(0));

        $oBR = $this->getMock('stdclass', array('getTimeLeft', 'discardUnusedReservations'));
        $oBR->expects($this->once())->method('getTimeLeft')->will($this->returnValue(0));
        $oBR->expects($this->once())->method('discardUnusedReservations')->with($this->equalTo(200));

        $oS = $this->getMock('oxsession', array('getBasketReservations', 'getBasket'));
        $oS->expects($this->once())->method('getBasketReservations')->will($this->returnValue($oBR));
        $oS->expects($this->once())->method('getBasket')->will($this->returnValue($oB));

        $oCB = $this->getMock('oxcmp_basket', array('getSession'));
        $oCB->expects($this->any())->method('getSession')->will($this->returnValue($oS));

        $oCB->init();
    }

}
