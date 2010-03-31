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
 * @version   SVN: $Id: dyntrustedTest.php 25334 2010-01-22 07:14:37Z alfonsas $
 */

require_once realpath( "." ).'/unit/OxidTestCase.php';
require_once realpath( "." ).'/unit/test_config.inc.php';

/**
 * Tests for dyn_trusted class
 */
class Unit_Admin_dyntrustedTest extends OxidTestCase
{
    /**
     * dyn_trusted::Render() test case
     *
     * @return null
     */
    public function testRender()
    {
        // testing..
        $oView = new dyn_trusted();
        $this->assertEquals( 'dyn_trusted.tpl', $oView->render() );
    }

    /**
     * dyn_trusted::Save() test case
     *
     * @return null
     */
    public function testSaveNothingToSave()
    {
        modConfig::setParameter( "aShopID_TrustedShops", array( "testValue" ) );

        $oView = $this->getMock( "dyn_trusted", array( "getConfig" ), array(), '', false );
        $oView->expects( $this->never() )->method( 'getConfig' );

        $oView->save();
        $this->assertEquals( "1", $oView->getViewDataElement( "errorsaving" ) );
        $this->assertNull( $oView->getViewDataElement( "aShopID_TrustedShops" ) );
    }

    /**
     * dyn_trusted::Save() test case
     *
     * @return null
     */
    public function testSave()
    {
        modConfig::setParameter( "aShopID_TrustedShops", array() );

        $oConfig = $this->getMock( "oxStdClass", array( "getShopId", "saveShopConfVar" ) );
        $oConfig->expects( $this->once() )->method( 'getShopId' )->will( $this->returnValue( "shopid" ) );
        $oConfig->expects( $this->once() )->method( 'saveShopConfVar' )->with( $this->equalTo( "aarr" ), $this->equalTo( "iShopID_TrustedShops" ), $this->equalTo( array() ), $this->equalTo( "shopid" ) );

        $oView = $this->getMock( "dyn_trusted", array( "getConfig" ), array(), '', false );
        $oView->expects( $this->once() )->method( 'getConfig' )->will( $this->returnValue( $oConfig ) );

        $oView->save();
    }

    /**
     * dyn_trusted::GetViewId() test case
     *
     * @return null
     */
    public function testGetViewId()
    {
        $oView = new dyn_trusted();
        $this->assertEquals( 'dyn_interface', $oView->getViewId() );
    }
}
