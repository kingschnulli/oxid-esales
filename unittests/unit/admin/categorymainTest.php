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
 * @version   SVN: $Id: categorymainTest.php 33254 2011-02-15 07:50:24Z sarunas $
 */

require_once realpath( "." ).'/unit/OxidTestCase.php';
require_once realpath( "." ).'/unit/test_config.inc.php';

/**
 * Tests for Category_Main class
 */
class Unit_Admin_CategoryMainTest extends OxidTestCase
{
    /**
     * Category_Main::Render() test case
     *
     * @return null
     */
    public function testRender()
    {
        modConfig::setParameter( "oxid", "testId" );
        oxTestModules::addFunction( "oxcategory", "isDerived", "{return true;}" );

        // testing..
        $oView = new Category_Main();
        $this->assertEquals( 'category_main.tpl', $oView->render() );
        $aViewData = $oView->getViewData();
        $this->assertTrue( isset( $aViewData['edit'] ) );
        $this->assertTrue( $aViewData['edit'] instanceof oxcategory );
    }

    /**
     * Content_Main::Render() test case
     *
     * @return null
     */
    public function testRenderNoRealObjectId()
    {
        modConfig::setParameter( "oxid", "-1" );

        // testing..
        $oView = new Category_Main();
        $this->assertEquals( 'category_main.tpl', $oView->render() );
        $aViewData = $oView->getViewData();
        $this->assertTrue( isset( $aViewData['oxid'] ) );
        $this->assertEquals( "-1", $aViewData['oxid'] );
    }

    /**
     * Category_Main::Save() test case
     *
     * @return null
     */
    public function testSave()
    {
        oxTestModules::addFunction( 'oxcategory', 'save', '{ return true; }');
        modConfig::setParameter( "oxid", "testId" );

        // testing..
        $oView = new Category_Main();
        $oView->save();

        $this->assertEquals( "1", $oView->getViewDataElement( "updatelist" ) );
    }


    /**
     * Category_Main::Save() test case
     *
     * @return null
     */
    public function testSaveDefaultOxid()
    {
        oxTestModules::addFunction( 'oxcategory', 'save', '{ $this->oxcategories__oxid = new oxField( "testId" ); return true; }');
        modConfig::setParameter( "oxid", "-1" );

        // testing..
        $oView = new Category_Main();
        $oView->save();

        $this->assertEquals( "1", $oView->getViewDataElement( "updatelist" ) );
    }

    /**
     * Category_Main::Saveinnlang() test case
     *
     * @return null
     */
    public function testSaveinnlang()
    {
        modConfig::setParameter( "oxid", "testId" );
        oxTestModules::addFunction( 'oxcategory', 'save', '{ return true; }');

        // testing..
        $oView = new Category_Main();
        $oView->saveinnlang();

        $this->assertEquals( "1", $oView->getViewDataElement( "updatelist" ) );
    }


    /**
     * Category_Main::Saveinnlang() test case
     *
     * @return null
     */
    public function testSaveinnlangDefaultOxid()
    {
        modConfig::setParameter( "oxid", "-1" );
        oxTestModules::addFunction( 'oxcategory', 'save', '{ $this->oxcategories__oxid = new oxField( "testId" ); return true; }');

        // testing..
        $oView = new Category_Main();
        $oView->saveinnlang();

        $this->assertEquals( "1", $oView->getViewDataElement( "updatelist" ) );
    }
    
    /**
     * Test get sortable fields.
     *
     * @return null
     */
    public function testGetSortableFields()
    {
        $oCatMain = new Category_Main();

        $aFields = $oCatMain->getSortableFields();
        $this->assertTrue(in_array( 'OXTITLE', $aFields));
        $this->assertFalse(in_array( 'OXAMITEMID', $aFields));
    }
}
