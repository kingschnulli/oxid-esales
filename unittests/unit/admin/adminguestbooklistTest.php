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
 * @version   SVN: $Id: adminguestbooklistTest.php 31988 2010-12-17 14:04:27Z sarunas $
 */

require_once realpath( "." ).'/unit/OxidTestCase.php';
require_once realpath( "." ).'/unit/test_config.inc.php';

/**
 * Tests for AdminGuestbook_List class
 */
class Unit_Admin_AdminGuestbookListTest extends OxidTestCase
{
    /**
     * AdminGuestbook_List::Render() test case
     *
     * @return null
     */
    public function testRender()
    {
        $oEntry = new GuestbookEntry();
        $oEntry->oxgbentries__oxuserid = new oxField( "oxdefaultadmin" );

        $oList = new oxList();
        $oList->offsetSet( "testEntryId", $oEntry );

        // testing..
        $oView = $this->getMock( "AdminGuestbook_List", array( "getItemList" ) );
        $oView->expects( $this->any() )->method( 'getItemList' )->will( $this->returnValue( $oList ) );
        $sTplName = $oView->render();
        $this->assertEquals( 'adminguestbook_list.tpl', $sTplName );

        // testing view data
        $aViewData = $oView->getViewData();
        $this->assertTrue( $aViewData["mylist"] instanceof oxList );
        $this->assertEquals( 1, $aViewData["mylist"]->count() );

    }


}
