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
 * @version   SVN: $Id: shopmainTest.php 44031 2012-04-18 10:57:19Z vilma $
 */

require_once realpath( "." ).'/unit/OxidTestCase.php';
require_once realpath( "." ).'/unit/test_config.inc.php';

/**
 * Tests for Shop_Main class
 */
class Unit_Admin_ShopMainTest extends OxidTestCase
{
    /**
     * Shop_Main::Render() test case
     *
     * @return null
     */
    public function testRender()
    {
        // testing..
        $oView = new Shop_Main();

        modConfig::setParameter( "oxid", oxConfig::getInstance()->getBaseShopId() );
        $this->assertEquals( 'shop_main.tpl', $oView->render() );
    }

    /**
     * Shop_Main::Save() test case
     *
     * @return null
     */
    public function testSave()
    {
        // testing..
        oxTestModules::addFunction( 'oxshop', 'save', '{ throw new Exception( "save" ); }');

        // testing..
        try {
            $oView = new Shop_Main();
            $oView->save();
        } catch ( Exception $oExcp ) {
            $this->assertEquals( "save", $oExcp->getMessage(), "error in Shop_Main::save()" );
            return;
        }
        $this->fail( "error in Shop_Main::save()" );
    }

    /**
     * Shop_Main::GetShopIds() test case
     *
     * @return null
     */
    public function testGetShopIds()
    {
        $aShopIds = array();
        $sRs = oxDb::getDb()->execute( "select oxid, oxname from oxshops" );
        if ($sRs != false && $sRs->recordCount() > 0) {
            while ( !$sRs->EOF ) {
                $aShopIds[$sRs->fields[0]] = new oxStdClass();
                $aShopIds[$sRs->fields[0]]->oxid   = $sRs->fields[0];
                $aShopIds[$sRs->fields[0]]->oxname = $sRs->fields[1];
                $sRs->moveNext();
            }
        }

        // testing..
        $oView = new Shop_Main();
        $this->assertEquals( $aShopIds, $oView->UNITgetShopIds() );
    }

}
