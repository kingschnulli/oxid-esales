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
 * @version   SVN: $Id: statisticmainTest.php 48094 2012-08-01 09:16:28Z vilma $
 */

require_once realpath( "." ).'/unit/OxidTestCase.php';
require_once realpath( "." ).'/unit/test_config.inc.php';

/**
 * Tests for Statistic_Main class
 */
class Unit_Admin_StatisticMainTest extends OxidTestCase
{
    /**
     * Statistic_Main::Render() test case
     *
     * @return null
     */
    public function testRender()
    {
        $this->setRequestParam( "oxid", "testId" );

        // testing..
        $oView = new Statistic_Main();
        $this->assertEquals( 'statistic_main.tpl', $oView->render() );

        $aViewData = $oView->getViewData();
        $this->assertTrue( isset( $aViewData['edit'] ) );
        $this->assertTrue( $aViewData['edit'] instanceof oxstatistic );

        $sAllReports = $this->getSessionParam("allstat_reports");
        $sReports    = $this->getSessionParam("stat_reports_testId");
        $this->assertEquals( array(), $sAllReports );
        $this->assertFalse( $sReports );
        $this->assertNull( $aViewData['ireports'] );
    }

    /**
     * Statistic_Main::Render() test case
     *
     * @return null
     */
    public function testRenderNoRealObjectId()
    {
        $this->setRequestParam( "oxid", "-1" );

        // testing..
        $oView = new Statistic_Main();
        $this->assertEquals( 'statistic_main.tpl', $oView->render() );
        $aViewData = $oView->getViewData();
        $this->assertTrue( isset( $aViewData['oxid'] ) );
        $this->assertEquals( "-1", $aViewData['oxid'] );
    }

    public function testRenderWithSomeReports()
    {
        // testing..
        $oView = new Statistic_Main();
        $this->setRequestParam("oxid", "testId");

        $oStatMock = $this->getMock("oxstatistic", array("load", "getReports"));
        $oStatMock->expects($this->once())->method("load")->with("testId");
        $oStatMock->expects($this->once())->method("getReports")->will($this->returnValue( array("testRes") ));
        oxTestModules::addModuleObject( 'oxstatistic', $oStatMock );

        $this->assertEquals( 'statistic_main.tpl', $oView->render() );

        $aViewData = $oView->getViewData();
        $this->assertTrue( isset( $aViewData['edit'] ) );
        $this->assertTrue( $aViewData['edit'] instanceof oxstatistic );

        $sAllReports = $this->getSessionParam("allstat_reports");
        $sReports    = $this->getSessionParam("stat_reports_testId");
        $this->assertEquals( array(), $sAllReports );
        $this->assertEquals( array("testRes"), $sReports );
        $this->assertEquals( 1, $aViewData['ireports'] );
    }
    /**
     * Statistic_Main::Render() test case
     *
     * @return null
     */
    public function testRenderPopup()
    {
        $this->setRequestParam( "aoc", true );

        $oStatMock = $this->getMock("statistic_main_ajax", array("getColumns"));
        $oStatMock->expects($this->once())->method("getColumns")->will($this->returnValue( "testRes" ));
        oxTestModules::addModuleObject( 'statistic_main_ajax', $oStatMock );

        // testing..
        $oView = new Statistic_Main();
        $this->assertEquals( 'popups/statistic_main.tpl', $oView->render() );

        $aViewData = $oView->getViewData();
        $this->assertTrue( isset( $aViewData['oxajax'] ) );
        $this->assertEquals( "testRes", $aViewData['oxajax'] );
    }

    /**
     * Statistic_Main::Save() test case
     *
     * @return null
     */
    public function testSave()
    {
        // testing..
        $oSubj = $this->getProxyClass("Statistic_Main");
        $this->setRequestParam("oxid", "testId");

        $aTestParams = array();
        $aTestParams["testParam"] = "testValue";

        $this->setRequestParam("editval", $aTestParams);

        $aTestParams["oxstatistics__oxshopid"] = $this->getConfig()->getBaseShopId();

        $oStatMock = $this->getMock("oxstatistic", array("load", "assign", "save"));
        $oStatMock->expects($this->once())->method("load")->with("testId");
        $oStatMock->expects($this->once())->method("assign")->with($aTestParams);
        $oStatMock->expects($this->once())->method("save");
        oxTestModules::addModuleObject( 'oxstatistic', $oStatMock );

        $oSubj->save();

        $aViewData = $oSubj->getNonPublicVar("_aViewData");
        $this->assertEquals($aViewData["updatelist"], 1);
    }

    /**
     * Statistic_Main::generate() test case
     *
     * @return null
     */
    public function testGenerate()
    {
        // testing..
        $this->markTestSkipped("incomplete");

        $oView = new Statistic_Main();
        $oView->generate();
    }

}
