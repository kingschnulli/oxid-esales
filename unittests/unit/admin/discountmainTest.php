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
 * @version   SVN: $Id: discountmainTest.php 26326 2010-03-05 13:21:28Z arvydas $
 */

require_once realpath( "." ).'/unit/OxidTestCase.php';
require_once realpath( "." ).'/unit/test_config.inc.php';

/**
 * Tests for Discount_Main class
 */
class Unit_Admin_DiscountMainTest extends OxidTestCase
{
    /**
     * Discount_Main::Render() test case
     *
     * @return null
     */
    public function testRender()
    {
        oxTestModules::addFunction( "oxdiscount", "isDerived", "{return true;}" );
        modConfig::setParameter( "oxid", "testId" );

        // testing..
        $oView = new Discount_Main();
        $this->assertEquals( 'discount_main.tpl', $oView->render() );
        $aViewData = $oView->getViewData();
        $this->assertTrue( isset( $aViewData['edit'] ) );
        $this->assertTrue( $aViewData['edit'] instanceof oxdiscount );
    }

    /**
     * Discount_Main::Render() test case
     *
     * @return null
     */
    public function testRenderNoRealObjectId()
    {
        modConfig::setParameter( "oxid", "-1" );
        modConfig::setParameter( "saved_oxid", "-1" );

        // testing..
        $oView = new Discount_Main();
        $this->assertEquals( 'discount_main.tpl', $oView->render() );
        $aViewData = $oView->getViewData();
        $this->assertTrue( isset( $aViewData['updatelist'] ) );
        $this->assertEquals( "1", $aViewData['updatelist'] );
        $this->assertTrue( isset( $aViewData['oxid'] ) );
        $this->assertEquals( "-1", $aViewData['oxid'] );
    }

    /**
     * Discount_Main::Save() test case
     *
     * @return null
     */
    public function testSave()
    {
        // testing..
        oxTestModules::addFunction( 'oxdiscount', 'save', '{ throw new Exception( "save" ); }');
        modConfig::getInstance()->setConfigParam( "blAllowSharedEdit", true );

        // testing..
        try {
            $oView = new Discount_Main();
            $oView->save();
        } catch ( Exception $oExcp ) {
            $this->assertEquals( "save", $oExcp->getMessage(), "error in Discount_Main::save()" );
            return;
        }
        $this->fail( "error in Discount_Main::save()" );
    }

    /**
     * Discount_Main::Saveinnlang() test case
     *
     * @return null
     */
    public function testSaveinnlang()
    {
        // testing..
        oxTestModules::addFunction( 'oxdiscount', 'save', '{ throw new Exception( "save" ); }');
        modConfig::getInstance()->setConfigParam( "blAllowSharedEdit", true );

        // testing..
        try {
            $oView = new Discount_Main();
            $oView->saveinnlang();
        } catch ( Exception $oExcp ) {
            $this->assertEquals( "save", $oExcp->getMessage(), "error in Discount_Main::save()" );
            return;
        }
        $this->fail( "error in Discount_Main::save()" );
    }

    /**
     * Discount_Main::LoadArticleList() test case
     *
     * @return null
     */
    public function testLoadArticleList()
    {
        $oDb = oxDb::getDb();

        $sO2CView = getViewName('oxobject2category');
        $sItmartid = null;
        $sITMChosenArtCat = null;

        // defining parameters
        $sQ = "select {$sO2CView}.oxobjectid, {$sO2CView}.oxcatnid from {$sO2CView}";

        $rs = $oDb->selectLimit( $sQ, 1, 0);
        if ($rs != false && $rs->recordCount() > 0) {
            $sItmartid = $rs->fields[0];
            $sITMChosenArtCat = $rs->fields[1];
        }

        $oView = new Discount_Main();
        $oList = $oView->UNITloadArticleList( $sItmartid, $sITMChosenArtCat);

        $blFoundInList = false;
        foreach ( $oList as $oArt ) {
            if ( $oArt->oxarticles__oxid->value == $sItmartid ) {
                $blFoundInList = true;
                break;
            }
        }

        $this->assertTrue( $blFoundInList, "Product was not found in list" );
    }

}
