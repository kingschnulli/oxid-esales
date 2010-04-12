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
 * @version   SVN: $Id: selectlistlistTest.php 25400 2010-01-27 22:42:50Z alfonsas $
 */

require_once realpath( "." ).'/unit/OxidTestCase.php';
require_once realpath( "." ).'/unit/test_config.inc.php';

/**
 * Tests for SelectList_List class
 */
class Unit_Admin_SelectListListTest extends OxidTestCase
{
    /**
     * SelectList_List::Init() test case
     *
     * @return null
     */
    public function testInit()
    {
        // testing..
        $oView = $this->getMock( "SelectList_List", array( "_authorize" ));
        $oView->expects( $this->any() )->method( '_authorize' )->will( $this->returnValue( true ) );
        $oView->init();
        $oView->render();
        $this->assertEquals( getViewName('oxselectlist').".oxtitle", $oView->getViewDataElement( 'sort' ) );
    }

    /**
     * SelectList_List::Render() test case
     *
     * @return null
     */
    public function testRender()
    {
        // testing..
        $oView = new SelectList_List();
        $this->assertEquals( 'selectlist_list.tpl', $oView->render() );
    }
}