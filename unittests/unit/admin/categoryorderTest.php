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
 * @version   SVN: $Id: categoryorderTest.php 26339 2010-03-05 14:13:54Z arvydas $
 */

require_once realpath( "." ).'/unit/OxidTestCase.php';
require_once realpath( "." ).'/unit/test_config.inc.php';

/**
 * Tests for Category_Order class
 */
class Unit_Admin_CategoryOrderTest extends OxidTestCase
{
    /**
     * Category_Order::Render() test case
     *
     * @return null
     */
    public function testRender()
    {
        oxTestModules::addFunction( "oxcategory", "isDerived", "{return true;}" );
        modConfig::setParameter( "oxid", "testId" );

        // testing..
        $oView = new Category_Order();
        $sTplName = $oView->render();

        // testing view data
        $aViewData = $oView->getViewData();
        $this->assertTrue( $aViewData["edit"] instanceof oxCategory );

        $this->assertEquals( 'category_order.tpl', $sTplName );
    }

}
