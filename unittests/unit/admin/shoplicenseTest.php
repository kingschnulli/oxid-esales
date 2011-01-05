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
 * @version   SVN: $Id: shoplicenseTest.php 26275 2010-03-04 09:07:24Z arvydas $
 */

require_once realpath( "." ).'/unit/OxidTestCase.php';
require_once realpath( "." ).'/unit/test_config.inc.php';

/**
 * Tests for Shop_License class
 */
class Unit_Admin_ShopLicenseTest extends OxidTestCase
{

    /**
     * Shop_License::Render() test case
     *
     * @return null
     */
    public function testRenderDemoShop()
    {
        $oConfig = $this->getMock( "oxconfig", array( "isDemoShop" ) );
        $oConfig->expects( $this->once() )->method( 'isDemoShop' )->will( $this->returnValue( true ) );

        // testing..
        $oView = $this->getMock( "Shop_License", array( "getConfig" ), array(), '', false );
        $oView->expects( $this->once() )->method( 'getConfig' )->will( $this->returnValue( $oConfig ) );
        try {
            $oView->render();
        } catch ( oxSystemComponentException $oExcp ) {
            return;
        }
        $this->fail( "Error while executing Shop_License::Render()" );
    }

    /**
     * Shop_License::Render() test case
     *
     * @return null
     */
    public function testRender()
    {
        modConfig::setParameter( "oxid", oxDb::getDb()->getOne( "select oxid from oxshops" ) );

        // testing..
        $oView = new Shop_License();
        $this->assertEquals( 'shop_license.tpl', $oView->render() );
        $aViewData = $oView->getViewData();
        $this->assertTrue( isset( $aViewData['edit'] ) );
        $this->assertTrue( $aViewData['edit'] instanceof oxshop );
        $this->assertTrue( isset( $aViewData['version'] ) );
    }

    /**
     * UserGroup_Main::Render() test case
     *
     * @return null
     */
    public function testRenderNoRealObjectId()
    {
        modConfig::setParameter( "oxid", "-1" );
        modConfig::setParameter( "saved_oxid", "-1" );

        // testing..
        $oView = new Shop_License();
        $this->assertEquals( 'shop_license.tpl', $oView->render() );
        $aViewData = $oView->getViewData();
        $this->assertTrue( isset( $aViewData['oxid'] ) );
        $this->assertEquals( "-1", $aViewData['oxid'] );
        $this->assertTrue( isset( $aViewData['updatelist'] ) );
        $this->assertEquals( "1", $aViewData['updatelist'] );
    }


}