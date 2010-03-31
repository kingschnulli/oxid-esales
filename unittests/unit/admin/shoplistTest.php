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
 * @version   SVN: $Id: shoplistTest.php 25400 2010-01-27 22:42:50Z alfonsas $
 */

require_once realpath( "." ).'/unit/OxidTestCase.php';
require_once realpath( "." ).'/unit/test_config.inc.php';

/**
 * Tests for Shop_List class
 */
class Unit_Admin_ShopListTest extends OxidTestCase
{
    /**
     * Shop_List::Init() test case
     *
     * @return null
     */
    public function testInit()
    {
        // testing..
        oxTestModules::addFunction("oxUtilsServer", "getOxCookie", "{return array(1);}");
        oxTestModules::addFunction("oxUtils", "checkAccessRights", "{return true;}");

        // testing..
        $oView = $this->getProxyClass( "Shop_List" );
        $oView->init();

        $this->assertEquals( "oxshops.oxname", $oView->getNonPublicVar( "_sDefSort" ) );
    }

    /**
     * Shop_List::Render() test case
     *
     * @return null
     */
    public function testRender()
    {
        // testing..
        $oView = new Shop_List();
        $this->assertEquals( 'shop_list.tpl', $oView->render() );
    }

    /**
     * Shop_List::BuildWhere() test case
     *
     * @return null
     */
    public function testBuildWhere()
    {
        modSession::getInstance()->setVar( "malladmin", null );
        modSession::getInstance()->setVar( "actshop", "testShopId" );

        // testing..
        $oView = new Shop_List();
        $aWhere = $oView->buildWhere();
        $this->assertTrue( isset( $aWhere['oxshops.oxid'] ) );
        $this->assertEquals( "testShopId", $aWhere['oxshops.oxid'] );
    }

    /**
     * Shop_List::DeleteEntry() test case
     *
     * @return null
     */
    public function testDeleteEntry()
    {
        // testing..
        oxTestModules::addFunction("oxUtilsServer", "getOxCookie", "{return array(1);}");
        oxTestModules::addFunction("oxUtils", "checkAccessRights", "{return true;}");
        oxTestModules::addFunction( 'oxshop', 'load', '{ return true; }' );
        oxTestModules::addFunction( 'oxshop', 'delete', '{ return true; }' );

        $oView = new Shop_List();
        $oView->deleteEntry();
    }
}
