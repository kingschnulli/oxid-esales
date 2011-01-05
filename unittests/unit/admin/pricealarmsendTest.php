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
 * @version   SVN: $Id: pricealarmsendTest.php 25400 2010-01-27 22:42:50Z alfonsas $
 */

require_once realpath( "." ).'/unit/OxidTestCase.php';
require_once realpath( "." ).'/unit/test_config.inc.php';

/**
 * Tests for PriceAlarm_Send class
 */
class Unit_Admin_PriceAlarmSendTest extends OxidTestCase
{
    /**
     * PriceAlarm_Send::Render() test case
     *
     * @return null
     */
    public function testRender()
    {
        // testing..
        $oView = $this->getMock( "PriceAlarm_Send", array( "_setupNavigation" ) );
        $oView->expects( $this->once() )->method( '_setupNavigation' );
        $this->assertEquals( 'pricealarm_done.tpl', $oView->render() );
    }

    /**
     * PriceAlarm_Send::SetupNavigation() test case
     *
     * @return null
     */
    public function testSetupNavigation()
    {
        // testing..
        $sNode = "pricealarm_list";
        modConfig::setParameter( "menu", $sNode );
        modConfig::setParameter( 'actedit', 1 );

        $oNavigation = $this->getMock( "OxStdClass", array( "getTabs", "getActiveTab" ) );
        $oNavigation->expects( $this->any() )->method( 'getActiveTab' )->will( $this->returnValue( "testEdit" ) );
        $oNavigation->expects( $this->once() )->method( 'getTabs' )->with( $this->equalTo( $sNode ), $this->equalTo( 1 ) )->will( $this->returnValue( "editTabs" ) );

        $oView = $this->getMock( "PriceAlarm_Send", array( "getNavigation" ) );
        $oView->expects( $this->once() )->method( 'getNavigation' )->will( $this->returnValue( $oNavigation ) );

        $oView->UNITsetupNavigation( $sNode );
        $this->assertEquals( "editTabs", $oView->getViewDataElement( "editnavi" ) );
        $this->assertEquals( "testEdit", $oView->getViewDataElement( "actlocation" ) );
        $this->assertEquals( "testEdit", $oView->getViewDataElement( "default_edit" ) );
        $this->assertEquals( 1, $oView->getViewDataElement( "actedit" ) );
    }

    /**
     * PriceAlarm_Send::SendeMail() test case
     *
     * @return null
     */
    public function testSendeMail()
    {
        oxTestModules::addFunction( 'oxemail', 'send', '{ return true; }');
        oxTestModules::addFunction( 'oxemail', 'setBody', '{ return true; }');
        oxTestModules::addFunction( 'oxemail', 'setSubject', '{ return true; }');
        oxTestModules::addFunction( 'oxemail', 'addAddress', '{ return true; }');
        oxTestModules::addFunction( 'oxemail', 'addReplyTo', '{ return true; }');
        oxTestModules::addFunction( 'oxpricealarm', 'save', '{ throw new Exception( "save" ); }');
        oxTestModules::addFunction( 'oxpricealarm', 'load', '{ return true; }');

        // testing..
        try {
            $oView = new PriceAlarm_Send();
            $oView->sendeMail( "info@example.com", "", "", "" );
        } catch ( Exception $oExcp ) {
            $this->assertEquals( "save", $oExcp->getMessage(), "error in PriceAlarm_Send::sendeMail()" );
            return;
        }
        $this->fail( "error in PriceAlarm_Send::sendeMail()" );
    }
}
