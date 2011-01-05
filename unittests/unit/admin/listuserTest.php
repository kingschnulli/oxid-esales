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
 * @version   SVN: $Id: listuserTest.php 25334 2010-01-22 07:14:37Z alfonsas $
 */

require_once realpath( "." ).'/unit/OxidTestCase.php';
require_once realpath( "." ).'/unit/test_config.inc.php';

/**
 * Tests for List_User class
 */
class Unit_Admin_ListUserTest extends OxidTestCase
{
    /**
     * List_User::GetViewListSize() test case
     *
     * @return null
     */
    public function testGetViewListSize()
    {
        // testing..
        $oView = $this->getMock( "List_User", array( "_getUserDefListSize" ) );
        $oView->expects( $this->once() )->method( '_getUserDefListSize' )->will( $this->returnValue( 999 ) );
        $this->assertEquals( 999, $oView->UNITgetViewListSize() );
    }

    /**
     * List_User::Init() test case
     *
     * @return null
     */
    public function testInit()
    {
        // testing..
        $oView = $this->getMock( "List_User", array( "buildWhere", "_authorize" ) );
        $oView->expects( $this->once() )->method( 'buildWhere' )->will( $this->throwException( new Exception( "buildWhere" ) ) );
        $oView->expects( $this->once() )->method( '_authorize' )->will( $this->returnValue( true ) );

        try {
            $oView->init();
        } catch ( Exception $oExcp ) {
            $this->assertEquals( "buildWhere", $oExcp->getMessage(), "Error in List_User::Init()" );
            return;
        }
        $this->fail( "Error in List_User::Init()" );
    }

    /**
     * List_User::Render() test case
     *
     * @return null
     */
    public function testRender()
    {
        $oNavTree = $this->getMock( "oxnavigationtree", array( "getDomXml" ) );
        $oNavTree->expects( $this->once() )->method( 'getDomXml' )->will( $this->returnValue( new DOMDocument ) );

        $oView = $this->getMock( "List_User", array( "getNavigation" ));
        $oView->expects( $this->at( $iCnt++ ) )->method( 'getNavigation' )->will( $this->returnValue( $oNavTree ) );
        $this->assertEquals( "list_user.tpl", $oView->render() );
    }

    /**
     * List_User::PrepareOrderByQuery() test case
     *
     * @return null
     */
    public function testPrepareOrderByQuery()
    {
        modConfig::setParameter( "sort", "testSort" );

        $oAdminList = new List_User();
        $this->assertEquals( " order by testSort ", $oAdminList->UNITprepareOrderByQuery( "" ) );
    }
}
