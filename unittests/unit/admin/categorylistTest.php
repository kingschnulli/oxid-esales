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
 * @version   SVN: $Id: categorylistTest.php 31986 2010-12-17 14:03:45Z sarunas $
 */

require_once realpath( "." ).'/unit/OxidTestCase.php';
require_once realpath( "." ).'/unit/test_config.inc.php';

/**
 * Tests for Category_List class
 */
class Unit_Admin_CategoryListTest extends OxidTestCase
{
    /**
     * Category_List::Init() test case
     *
     * @return null
     */
    public function testInit()
    {
        oxTestModules::addFunction("oxUtilsServer", "getOxCookie", "{return array(1);}");
        oxTestModules::addFunction("oxUtils", "checkAccessRights", "{return true;}");

        $oSess = $this->getMock('oxsession', array('checkSessionChallenge'));
        $oSess->expects($this->once())->method('checkSessionChallenge')->will($this->returnValue(true));

        $oView = $this->getMock($this->getProxyClassName('Category_List'), array('getSession'));
        $oView->expects($this->any())->method('getSession')->will($this->returnValue($oSess));

        $oView->init();
        $this->assertEquals( array( "oxcategories" => array( "oxrootid" => "desc", "oxleft" => "asc" ) ), $oView->getListSorting() );
    }

    /**
     * Category_List::Render() test case
     *
     * @return null
     */
    public function testRender()
    {
        // testing..
        $oView = new Category_List();
        $sTplName = $oView->render();

        // testing view data
        $aViewData = $oView->getViewData();
        $this->assertTrue( $aViewData["cattree"] instanceof oxCategoryList );

        $this->assertEquals( 'category_list.tpl', $sTplName );
    }

}
