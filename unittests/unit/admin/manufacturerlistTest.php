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
 * @version   SVN: $Id: manufacturermainTest.php 26318 2010-03-05 09:56:47Z arvydas $
 */

require_once realpath( "." ).'/unit/OxidTestCase.php';
require_once realpath( "." ).'/unit/test_config.inc.php';

/**
 * Tests for Manufacturer_List class
 */
class Unit_Admin_ManufacturerListTest extends OxidTestCase
{
    /**
     * Manufacturer_List::init() test case
     *
     * @return null
     */
    public function testInit()
    {
        // testing..
        $oView = $this->getMock( "Manufacturer_List", array( "_authorize" ) );
        $oView->expects( $this->once() )->method( '_authorize' )->will( $this->returnValue( true ) );
        $oView->init();
        $this->assertEquals( "manufacturer_list.tpl", $oView->render() );
        $this->assertEquals( array( 'oxmanufacturers' => array( "oxtitle" => "asc" )), $oView->getListSorting() );
    }
}
