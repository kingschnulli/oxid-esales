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
 * @version   SVN: $Id: toolsTest.php 26271 2010-03-04 08:42:11Z arvydas $
 */

require_once realpath( "." ).'/unit/OxidTestCase.php';
require_once realpath( "." ).'/unit/test_config.inc.php';

/**
 * Tests for Tools class
 */
class Unit_Admin_ToolsTest extends OxidTestCase
{
    /**
     * Tools::Render() test case
     *
     * @return null
     */
    public function testRender()
    {
        // testing..
        $oView = new Tools();
        $this->assertEquals( 'tools.tpl', $oView->render() );
    }

    /**
     * Tools::Render() test case
     *
     * @return null
     */
    public function testRenderDemoshop()
    {
        oxTestModules::addFunction( 'oxUtils', 'showMessageAndExit', '{ return "Access denied !"; }');


        $oConfig = $this->getMock( "oxStdClass", array( "isDemoShop" ) );
        $oConfig->expects( $this->once() )->method( 'isDemoShop' )->will( $this->returnValue( true ) );

        // testing..
        $oView = $this->getMock( "Tools", array( "getConfig" ), array(), '', false );
        $oView->expects( $this->once() )->method( 'getConfig' )->will( $this->returnValue( $oConfig ) );
        $this->assertEquals( "Access denied !", $oView->render() );
    }
}
