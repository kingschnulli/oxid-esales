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
 * @copyright (C) OXID eSales AG 2003-2012
 * @version OXID eShop CE
 * @version   SVN: $Id: oxcaptchaTest.php 26841 2010-03-25 13:58:15Z arvydas $
 */

require_once realpath( "." ).'/unit/OxidTestCase.php';
require_once realpath( "." ).'/unit/test_config.inc.php';

class Unit_Core_oxmoduleTest extends OxidTestCase
{
    /**
     * test setup
     *
     * @return null
     */
    public function setup()
    {
        parent::setUp();
    }

    /**
     * Tear down the fixture.
     *
     * @return null
     */
    protected function tearDown()
    {
        $this->cleanUpTable('oxconfig');
        $this->cleanUpTable('oxconfigdisplay');
        $this->cleanUpTable('oxtplblocks');

        parent::tearDown();
    }

    /**
     * oxmodule::load() test case
     *
     * @return null
     */
    public function testLoad()
    {
            $aModule = array(
                'id'           => 'invoicepdf',
                'title'        => 'Invoice PDF',
                'description'  => 'Module for making invoice PDF files.',
                'thumbnail'    => 'picture.png',
                'version'      => '1.0',
                'author'       => 'OXID eSales AG',
                'active'       => true,
                'extend'       => array ('oxorder' => 'invoicepdf/myorder')
            );

            $oModule = $this->getProxyClass( 'oxmodule' );
            $this->assertTrue( $oModule->load( 'invoicepdf' ) );

            $this->assertEquals( $oModule->getNonPublicVar( "_aModule" ), $aModule );
    }

    /**
     * oxmodule::load() test case, no extend
     *
     * @return null
     */
    public function testLoadNoExtend()
    {
            $aModule = array(
                'id'           => 'invoicepdf',
                'title'        => 'Invoice PDF',
                'description'  => 'Module for making invoice PDF files.',
                'thumbnail'    => 'picture.png',
                'version'      => '1.0',
                'author'       => 'OXID eSales AG',
                'active'       => true,
                'extend'       => array ()
            );

            $oModule = $this->getProxyClass( 'oxmodule' );
            $oModule->setNonPublicVar( "_aModule", $aModule );
            $this->assertFalse( $oModule->isActive() );
            $this->assertFalse( $oModule->isExtended() );
    }

    /**
     * oxmodule::load() test legacy modules loading from "aLegacyModules" config option
     *
     * @return null
     */
    public function testLoad_getInfoFromLegacyArray()
    {
            $aModule = array(
                'id'           => 'functions.php',
                'title'        => 'Test Module',
                'extend'       => array ('oxnews' => 'testModule/testModuleClass'),
                'active'       => false
            );

            $aLegacyModules["functions.php"] = array(
                'title'        => 'Test Module',
                'extend'       => array ('oxnews' => 'testModule/testModuleClass')
            );

            modConfig::getInstance()->setConfigParam("aLegacyModules", $aLegacyModules);

            $oModule = $this->getProxyClass( 'oxmodule' );
            $this->assertTrue( $oModule->load( 'functions.php' ) );
            $this->assertTrue( $oModule->isLegacy() );
            $this->assertTrue( $oModule->isRegistered() );

            $this->assertEquals( $oModule->getNonPublicVar( "_aModule" ), $aModule );
    }

    /**
     * oxmodule::load() test legacy modules load - module info is not in config
     *
     * @return null
     */
    public function testLoad_noInfoInLegacyArray()
    {
            $aModule = array(
                'id'           => 'functions.php',
                'title'        => 'functions.php',
                'extend'       => array(),
                'active'       => false
            );

            $oModule = $this->getProxyClass( 'oxmodule' );
            $this->assertTrue( $oModule->load( 'functions.php' ) );
            $this->assertTrue( $oModule->isLegacy() );
            $this->assertFalse( $oModule->isRegistered() );

            $this->assertEquals( $oModule->getNonPublicVar( "_aModule" ), $aModule );
    }

    /**
     * oxmodule::load() testing loading module from standalone file (not a directory)
     *
     * @return null
     */
    public function testLoad_standaloneFile()
    {
            $aModule = array(
                'id'           => 'functions.php',
                'title'        => 'functions.php',
                'extend'       => array(),
                'active'       => false
            );

            $oModule = $this->getProxyClass( 'oxmodule' );
            $this->assertTrue( $oModule->load( 'functions.php' ) );
            $this->assertTrue( $oModule->isFile() );
            $this->assertTrue( $oModule->isLegacy() );
            $this->assertFalse( $oModule->isRegistered() );

            $this->assertEquals( $oModule->getNonPublicVar( "_aModule" ), $aModule );
    }

    /**
     * oxmodule::getInfo() test case
     *
     * @return null
     */
    public function testGetInfo()
    {
        $aModule = array(
            'id'    => 'testModuleId',
            'title' => 'testModuleTitle'
        );

        $oModule = $this->getProxyClass( 'oxmodule' );
        $oModule->setNonPublicVar( "_aModule", $aModule );

        $this->assertEquals( "testModuleId", $oModule->getInfo( "id" ) );
        $this->assertEquals( "testModuleTitle", $oModule->getInfo( "title" ) );
    }


    /**
     * oxmodule::getInfo() test case - selecting multilanguage value
     *
     * @return null
     */
    public function testGetInfo_usingLanguage()
    {
        $aModule = array(
            'title' => 'testModuleTitle',
            'description' => array( "en" => "test EN value", "de" => "test DE value" )
        );

        $oModule = $this->getProxyClass( 'oxmodule' );
        $oModule->setNonPublicVar( "_aModule", $aModule );

        $this->assertEquals( 'testModuleTitle', $oModule->getInfo( "title" ) );
        $this->assertEquals( 'testModuleTitle', $oModule->getInfo( "title", 1 ) );

        $this->assertEquals( "test DE value", $oModule->getInfo( "description", 0 ) );
        $this->assertEquals( "test EN value", $oModule->getInfo( "description", 1 ) );
        $this->assertEquals( "test EN value", $oModule->getInfo( "description", 2 ) );
    }

    /**
     * oxmodule::isActive() test case, empty
     *
     * @return null
     */
    public function testIsActiveEmpty()
    {
        $aModules = array();
        modConfig::getInstance()->setConfigParam( "aModules", $aModules );

        $oModule = $this->getProxyClass('oxmodule');
        $aExtend = array('extend' => array());
        $oModule->setNonPublicVar( "_aModule", $aExtend );

        $this->assertFalse($oModule->isActive());
    }

    /**
     * oxmodule::isActive() test case, active
     *
     * @return null
     */
    public function testIsActiveActive()
    {
        $aModules = array('oxtest' => 'test/mytest');
        modConfig::getInstance()->setConfigParam( "aModules", $aModules );

        $oModule = $this->getProxyClass('oxmodule');
        $aExtend  = array('extend' => array('oxtest' => 'test/mytest'));
        $oModule->setNonPublicVar( "_aModule", $aExtend );

        $this->assertTrue($oModule->isActive());
    }

    /**
     * oxmodule::isActive() test case, active in chain
     *
     * @return null
     */
    public function testIsActiveActiveChain()
    {
        $aModules = array('oxtest' => 'test/mytest&test2/mytest2');
        modConfig::getInstance()->setConfigParam( "aModules", $aModules );

        $oModule = $this->getProxyClass('oxmodule');
        $aExtend  = array('extend' => array('oxtest' => 'test/mytest'));
        $oModule->setNonPublicVar( "_aModule", $aExtend );

        $this->assertTrue($oModule->isActive());
    }
    /**
     * oxmodule::isActive() test case, inactive
     *
     * @return null
     */
    public function testIsActiveInactive()
    {
        $aModules = array();
        modConfig::getInstance()->setConfigParam( "aModules", $aModules );

        $oModule = $this->getProxyClass('oxmodule');
        $aExtend  = array('extend' => array('oxtest' => 'test/mytest'));
        $oModule->setNonPublicVar( "_aModule", $aExtend );

        $this->assertFalse($oModule->isActive());
    }

    /**
     * oxmodule::isActive() test case, inactive in chain
     *
     * @return null
     */
    public function testIsActiveInactiveChain()
    {
        $aModules = array('oxtest' => 'test1/mytest1&test2/mytest2');
        modConfig::getInstance()->setConfigParam( "aModules", $aModules );

        $oModule = $this->getProxyClass('oxmodule');
        $aExtend  = array('extend' => array('oxtest' => 'test/mytest'));
        $oModule->setNonPublicVar( "_aModule", $aExtend );

        $this->assertFalse($oModule->isActive());
    }

    /**
     * oxmodule::isActive() test case, deactivated
     *
     * @return null
     */
    public function testIsActiveDeactivated()
    {
        $aModules = array('oxtest' => 'test/mytest');
        modConfig::getInstance()->setConfigParam( "aModules", $aModules );

        $aDisabledModules = array('oxtest' => 'test/mytest');
        modConfig::getInstance()->setConfigParam( "aDisabledModules", $aDisabledModules );

        $oModule = $this->getProxyClass('oxmodule');
        $aExtend  = array('extend' => array('oxtest' => 'test/mytest'));
        $oModule->setNonPublicVar( "_aModule", $aExtend );

        $this->assertFalse($oModule->isActive());
    }

    /**
     * oxmodule::isActive() test case, not deactivated in chain
     *
     * @return null
     */
    public function testIsActiveDeactivatedChain()
    {
        $aModules = array('oxtest' => 'test1/mytest1&test/mytest');
        modConfig::getInstance()->setConfigParam( "aModules", $aModules );

        $aDisabledModules = array('oxtest' => 'test1/mytest1&test/mytest&test2/mytest2');
        modConfig::getInstance()->setConfigParam( "aDisabledModules", $aDisabledModules );

        $oModule = $this->getProxyClass('oxmodule');
        $aExtend  = array('extend' => array('oxtest' => 'test/mytest'));
        $oModule->setNonPublicVar( "_aModule", $aExtend );

        $this->assertFalse($oModule->isActive());
    }

    /**
     * oxmodule::isActive() test case, partially activated
     *
     * @return null
     */
    public function testIsActivePartiallyActived()
    {
        $aModules = array('oxtest1' => 'test1/mytest1');
        modConfig::getInstance()->setConfigParam( "aModules", $aModules );

        $oModule = $this->getProxyClass('oxmodule');
        $aExtend  = array('extend' => array('oxtest1' => 'test1/mytest1','oxtest2' => 'test2/mytest2'));
        $oModule->setNonPublicVar( "_aModule", $aExtend );

        $this->assertFalse($oModule->isActive());
    }

    /**
     * oxmodule::isActive() test case, partially deactivated
     *
     * @return null
     */
    public function testIsActivepartiallyDeactivated()
    {
        $aModules = array('oxtest1' => 'test1/mytest1');
        modConfig::getInstance()->setConfigParam( "aModules", $aModules );

        $aDisabledModules = array('oxtest2' => 'test2/mytest2');
        modConfig::getInstance()->setConfigParam( "aDisabledModules", $aDisabledModules );

        $oModule = $this->getProxyClass('oxmodule');
        $aExtend  = array('extend' => array('oxtest1' => 'test1/mytest1','oxtest2' => 'test2/mytest2'));
        $oModule->setNonPublicVar( "_aModule", $aExtend );

        $this->assertFalse($oModule->isActive());
    }

    /**
     * oxmodule::isExtended() test case,
     *
     * @return null
     */
    public function testIsExtendedNot()
    {
        $oModule = $this->getProxyClass('oxmodule');
        $aExtend  = array('extend' => array());
        $oModule->setNonPublicVar( "_aModule", $aExtend );
        $oModule->setNonPublicVar( "_blMetadata", true );

        $this->assertFalse($oModule->isExtended());
    }

    /**
     * oxmodule::isExtended() test case,
     *
     * @return null
     */
    public function testIsExtendedYes()
    {
        $oModule = $this->getProxyClass('oxmodule');
        $aExtend  = array('extend' => array('oxtest1' => 'test1/mytest1',));
        $oModule->setNonPublicVar( "_aModule", $aExtend );
        $oModule->setNonPublicVar( "_blMetadata", true );

        $this->assertTrue($oModule->isExtended());
    }

    /**
     * oxmodule::isExtended() test case,no metadata
     *
     * @return null
     */
    public function testIsExtendedNotNoMeadata()
    {
        $oModule = $this->getProxyClass('oxmodule');
        $aExtend  = array('extend' => array());
        $oModule->setNonPublicVar( "_aModule", $aExtend );
        $oModule->setNonPublicVar( "_blMetadata", false );

        $this->assertFalse($oModule->isExtended());
    }

    /**
     * oxmodule::isExtended() test case, no metadata
     *
     * @return null
     */
    public function testIsExtendedYeNoMeadatas()
    {
        $oModule = $this->getProxyClass('oxmodule');
        $aExtend  = array('extend' => array('oxtest1' => 'test1/mytest1',));
        $oModule->setNonPublicVar( "_aModule", $aExtend );
        $oModule->setNonPublicVar( "_blMetadata", false );

        $this->assertFalse($oModule->isExtended());
    }

    /**
     * oxmodule::activate() test case, empty array
     *
     * @return null
     */
    public function testActivate()
    {
        $aModulesBefore = array();
        $aModulesAfter  = array('oxtest' => 'test/mytest');

        $oModule = $this->getProxyClass('oxmodule');
        $aExtend  = array('extend' => array('oxtest' => 'test/mytest'));
        $oModule->setNonPublicVar( "_aModule", $aExtend );

        modConfig::getInstance()->setConfigParam( "aModules", $aModulesBefore );
        $this->assertEquals($aModulesBefore, modConfig::getInstance()->getConfigParam("aModules") );

        $this->assertTrue($oModule->activate());
        $this->assertEquals($aModulesAfter, modConfig::getInstance()->getConfigParam("aModules") );
        $this->assertEquals($aModulesAfter, modConfig::getInstance()->getShopConfVar("aModules") );
    }

    /**
     * oxmodule::activate() test case, already activated
     *
     * @return null
     */
    public function testActivateActive()
    {
        $aModulesBefore = array('oxtest' => 'test/mytest');
        $aModulesAfter  = array('oxtest' => 'test/mytest');

        $oModule = $this->getProxyClass('oxmodule');
        $aExtend = array('extend' => array('oxtest' => 'test/mytest'));
        $oModule->setNonPublicVar( "_aModule", $aExtend );

        modConfig::getInstance()->setConfigParam( "aModules", $aModulesBefore );
        $this->assertEquals($aModulesBefore, modConfig::getInstance()->getConfigParam("aModules") );

        $this->assertTrue($oModule->activate());
        $this->assertEquals($aModulesAfter, modConfig::getInstance()->getConfigParam("aModules") );
        $this->assertEquals($aModulesAfter, modConfig::getInstance()->getShopConfVar("aModules") );
    }

    /**
     * oxmodule::activate() test case, append to chain
     *
     * @return null
     */
    public function testActivateChain()
    {
        $aModulesBefore = array('oxtest' => 'test/mytest');
        $aModulesAfter  = array('oxtest' => 'test/mytest&test1/mytest1');

        $oModule = $this->getProxyClass('oxmodule');
        $aExtend  = array('extend' => array('oxtest' => 'test1/mytest1'));
        $oModule->setNonPublicVar( "_aModule", $aExtend );

        modConfig::getInstance()->setConfigParam( "aModules", $aModulesBefore );
        $this->assertEquals($aModulesBefore, modConfig::getInstance()->getConfigParam("aModules") );

        $this->assertTrue($oModule->activate());
        $this->assertEquals($aModulesAfter, modConfig::getInstance()->getConfigParam("aModules") );
        $this->assertEquals($aModulesAfter, modConfig::getInstance()->getShopConfVar("aModules") );
    }

    /**
     * oxmodule::parseModuleChains() test case, empty
     *
     * @return null
     */
    public function testParseModuleChainsEmpty()
    {
        $oModule = $this->getProxyClass('oxmodule');

        $aModules = array();
        $aModulesArray  = array();
        $this->assertEquals($aModulesArray, $oModule->parseModuleChains($aModules));
    }

    /**
     * oxmodule::parseModuleChains() test case, single
     *
     * @return null
     */
    public function testParseModuleChainsSigle()
    {
        $oModule = $this->getProxyClass('oxmodule');
        $aModules = array('oxtest' => 'test/mytest');
        $aModulesArray  = array('oxtest' => array('test/mytest'));
        $this->assertEquals($aModulesArray, $oModule->parseModuleChains($aModules));
    }

    /**
     * oxmodule::parseModuleChains() test case
     *
     * @return null
     */
    public function testParseModuleChains()
    {
        $oModule = $this->getProxyClass('oxmodule');
        $aModules = array('oxtest' => 'test/mytest&test1/mytest1');
        $aModulesArray  = array('oxtest' => array('test/mytest','test1/mytest1'));
        $this->assertEquals($aModulesArray, $oModule->parseModuleChains($aModules));
    }

    /**
     * oxmodule::buildModuleChains() test case, empty
     *
     * @return null
     */
    public function testBuildModuleChainsEmpty()
    {
        $oModule = $this->getProxyClass('oxmodule');

        $aModules = array();
        $aModulesArray  = array();
        $this->assertEquals($aModules, $oModule->buildModuleChains($aModulesArray));
    }

    /**
     * oxmodule::buildModuleChains() test case, single
     *
     * @return null
     */
    public function testBuildModuleChainsSingle()
    {
        $oModule = $this->getProxyClass('oxmodule');

        $aModules = array('oxtest' => 'test/mytest');
        $aModulesArray  = array('oxtest' => array('test/mytest'));
        $this->assertEquals($aModules, $oModule->buildModuleChains($aModulesArray));
    }

    /**
     * oxmodule::buildModuleChains() test case
     *
     * @return null
     */
    public function testBuildModuleChains()
    {
        $oModule = $this->getProxyClass('oxmodule');

        $aModules = array('oxtest' => 'test/mytest&test1/mytest1');
        $aModulesArray  = array('oxtest' => array('test/mytest','test1/mytest1'));
        $this->assertEquals($aModules, $oModule->buildModuleChains($aModulesArray));
    }

    /**
     * oxmodule::mergeModuleArrays() test case, empty
     *
     * @return null
     */
    public function testMergeModuleArraysEmpty()
    {
        $oModule = $this->getProxyClass('oxmodule');

        $aAllModules = array();
        $aAddModules = array();
        $this->assertEquals($aAllModules, $oModule->mergeModuleArrays($aAllModules, $aAddModules));
    }

    /**
     * oxmodule::mergeModuleArrays() test case, add single
     *
     * @return null
     */
    public function testMergeModuleArraysAddSingle()
    {
        $oModule = $this->getProxyClass('oxmodule');
        $aAllModules = array();
        $aAddModules = array('oxtest' => 'test/mytest');
        $aMrgModules = array('oxtest' => array('test/mytest'));
        $this->assertEquals($aMrgModules, $oModule->mergeModuleArrays($aAllModules, $aAddModules));
    }

    /**
     * oxmodule::mergeModuleArrays() test case, add
     *
     * @return null
     */
    public function testMergeModuleArraysAdd()
    {
        $oModule = $this->getProxyClass('oxmodule');
        $aAllModules = array();
        $aAddModules = array('oxtest' => array('test/mytest'));
        $this->assertEquals($aAddModules, $oModule->mergeModuleArrays($aAllModules, $aAddModules));
    }

    /**
     * oxmodule::mergeModuleArrays() test case, existing
     *
     * @return null
     */
    public function testMergeModuleArraysExisting()
    {
        $oModule = $this->getProxyClass('oxmodule');
        $aAllModules = array('oxtest' => array('test/mytest'));
        $aAddModules = array('oxtest' => array('test/mytest'));
        $this->assertEquals($aAllModules, $oModule->mergeModuleArrays($aAllModules, $aAddModules));
    }

    /**
     * oxmodule::mergeModuleArrays() test case, appenf
     *
     * @return null
     */
    public function testMergeModuleArraysAppend()
    {
        $oModule = $this->getProxyClass('oxmodule');
        $aAllModules = array('oxtest' => array('test/mytest'));
        $aAddModules = array('oxtest' => array('test1/mytest1'));
        $aMrgModules = array('oxtest' => array('test/mytest','test1/mytest1'));
        $this->assertEquals($aMrgModules, $oModule->mergeModuleArrays($aAllModules, $aAddModules));
    }

    /**
     * oxmodule::mergeModuleArrays() test case, add and append
     *
     * @return null
     */
    public function testMergeModuleArraysAddAndAppend()
    {
        $oModule = $this->getProxyClass('oxmodule');
        $aAllModules = array('oxtest' => array('test/mytest'));
        $aAddModules = array('oxtest' => array('test1/mytest1'), 'oxtest2' => array('test2/mytest2'));
        $aMrgModules = array('oxtest' => array('test/mytest','test1/mytest1'), 'oxtest2' => array('test2/mytest2'));
        $this->assertEquals($aMrgModules, $oModule->mergeModuleArrays($aAllModules, $aAddModules));
    }

   /**
     * oxmodule::diffModuleArrays() test case, empty
     *
     * @return null
     */
    public function testDiffModuleArraysEmpty()
    {
        $oModule = $this->getProxyClass('oxmodule');

        $aAllModules = array();
        $aRemModules = array();
        $this->assertEquals($aAllModules, $oModule->diffModuleArrays($aAllModules, $aRemModules));
    }

    /**
     * oxmodule::diffModuleArrays() test case, remove single
     *
     * @return null
     */
    public function testMergeModuleArraysRemoveSingle()
    {
        $oModule = $this->getProxyClass('oxmodule');
        $aAllModules = array('oxtest' => array('test/mytest'));
        $aRemModules = array('oxtest' => 'test/mytest');
        $aMrgModules = array();
        $this->assertEquals($aMrgModules, $oModule->diffModuleArrays($aAllModules, $aRemModules));
    }

    /**
     * oxmodule::diffModuleArrays() test case, remove
     *
     * @return null
     */
    public function testDiffModuleArraysRemove()
    {
        $oModule = $this->getProxyClass('oxmodule');
        $aAllModules = array('oxtest' => array('test/mytest'));
        $aRemModules = array('oxtest' => array('test/mytest'));
        $aMrgModules = array();
        $this->assertEquals($aMrgModules, $oModule->diffModuleArrays($aAllModules, $aRemModules));
    }

    /**
     * oxmodule::diffModuleArrays() test case, remove from chain
     *
     * @return null
     */
    public function testDiffModuleArraysRemoveChain()
    {
        $oModule = $this->getProxyClass('oxmodule');
        $aAllModules = array('oxtest' => array('test/mytest','test1/mytest1'));
        $aRemModules = array('oxtest' => array('test1/mytest1'));
        $aMrgModules = array('oxtest' => array('test/mytest'));
        $this->assertEquals($aMrgModules, $oModule->diffModuleArrays($aAllModules, $aRemModules));
    }

    /**
     * oxmodule::diffModuleArrays() test case, remove from chain and unused key
     *
     * @return null
     */
    public function testDiffModuleArraysRemoveChainAndKey()
    {
        $oModule = $this->getProxyClass('oxmodule');
        $aAllModules = array('oxtest' => array('test/mytest','test1/mytest1'), 'oxtest2' => array('test2/mytest2'));
        $aRemModules = array('oxtest' => array('test/mytest'), 'oxtest2' => array('test2/mytest2'));
        $aMrgModules = array('oxtest' => array('test1/mytest1'));
        $this->assertEquals($aMrgModules, $oModule->diffModuleArrays($aAllModules, $aRemModules));
    }

    /**
     * oxmodule::filterModuleArrays() test case, empty
     *
     * @return null
     */
    public function testFilterModuleArrayEmpty()
    {
        $oModule = $this->getProxyClass('oxmodule');
        $aModules = array('oxtest' => array('test/mytest','test1/mytest1'));
        $aExtend  = array();
        $this->assertEquals($aExtend, $oModule->filterModuleArray($aModules, 'notRegisteredExtension'));
    }

    /**
     * oxmodule::filterModuleArrays() test case, single
     *
     * @return null
     */
    public function testFilterModuleArraySingle()
    {
        $oModule = $this->getProxyClass('oxmodule');
        $aModules = array('oxtest' => array('test/mytest','test1/mytest1'));
        $aExtend  = array('oxtest' => array('test/mytest'));
        $this->assertEquals($aExtend, $oModule->filterModuleArray($aModules, 'test'));
    }

    /**
     * oxmodule::getAllModules() test case
     *
     * @return null
     */
    public function testGetAllModules()
    {
        $aModules = array(
            'oxorder'  => 'testExt1/module1&testExt2/module1',
            'oxnews'   => 'testExt2/module2'
        );

        $aResult = array(
            'oxorder'  => array( 'testExt1/module1', 'testExt2/module1' ),
            'oxnews'   => array( 'testExt2/module2' )
        );

        $oModule = $this->getProxyClass('oxmodule');
        modConfig::getInstance()->setConfigParam( "aModules", $aModules );

        $this->assertEquals( $aResult, $oModule->getAllModules() );
    }

    /**
     * oxmodule::getActiveModules() test case
     *
     * @return null
     */
    public function testGetActiveModules()
    {
        $aModules = array(
            'oxorder'  => 'testExt1/module1&testExt2/module1',
            'oxnews'   => 'testExt2/module2'
        );

        $aResult = array(
            'oxorder'  => array( 'testExt1/module1' )
        );

        $aDisabledModules = array(
            'oxorder'  => 'testExt2/module1',
            'oxnews'   => 'testExt2/module2'
        );

        modConfig::getInstance()->setConfigParam( "aModules", $aModules );
        modConfig::getInstance()->setConfigParam( "aDisabledModules", $aDisabledModules );

        $oModule = $this->getProxyClass('oxmodule');

        $this->assertEquals( $aResult, $oModule->getActiveModules() );
    }

     /**
     * oxmodule::getLegacyModules() test case
     *
     * @return null
     */
    public function testGetLegacyModules()
    {
        $aLegacyModules["testModule"] = array(
            'title'        => 'Test Module',
            'extend'       => array ('oxnews' => 'testModule/testModuleClass')
        );

        modConfig::getInstance()->setConfigParam( "aLegacyModules", $aLegacyModules );

        $oModule = $this->getProxyClass('oxmodule');

        $this->assertEquals( $aLegacyModules, $oModule->getLegacyModules() );
    }

     /**
     * oxmodule::getDisabledModules() test case
     *
     * @return null
     */
    public function testGetDisabledModules()
    {
        $aDisabledModules = array(
            'oxorder'  => 'testExt2/module1',
            'oxnews'   => 'testExt2/module2'
        );

        $aDisabledModulesParsed = array(
            'oxorder'  => array( 'testExt2/module1' ),
            'oxnews'   => array( 'testExt2/module2' )
        );

        modConfig::getInstance()->setConfigParam( "aDisabledModules", $aDisabledModules );

        $oModule = $this->getProxyClass('oxmodule');

        $this->assertEquals( $aDisabledModulesParsed, $oModule->getDisabledModules() );
    }


     /**
     * oxmodule::getId() test case
     *
     * @return null
     */
    public function testGetId()
    {
        $aModule = array(
            'id'  => 'testModuleId'
        );

        $oModule = $this->getProxyClass('oxmodule');
        $oModule->setNonPublicVar( "_aModule", $aModule );

        $this->assertEquals( 'testModuleId', $oModule->getId() );
    }

     /**
     * oxmodule::hasMetadata() test case
     *
     * @return null
     */
    public function testHasMetadata()
    {
        $oModule = $this->getProxyClass('oxmodule');
        $oModule->setNonPublicVar( "_blMetadata", false );
        $this->assertFalse( $oModule->hasMetadata() );

        $oModule->setNonPublicVar( "_blMetadata", true );
        $this->assertTrue( $oModule->hasMetadata() );
    }

     /**
     * oxmodule::isFile() test case
     *
     * @return null
     */
    public function testIsFile()
    {
        $oModule = $this->getProxyClass('oxmodule');
        $oModule->setNonPublicVar( "_blFile", false );
        $this->assertFalse( $oModule->isFile() );

        $oModule->setNonPublicVar( "_blFile", true );
        $this->assertTrue( $oModule->isFile() );
    }

     /**
     * oxmodule::isLegacy() test case
     *
     * @return null
     */
    public function testIsLegacy()
    {
        $oModule = $this->getProxyClass('oxmodule');
        $oModule->setNonPublicVar( "_blLegacy", false );
        $this->assertFalse( $oModule->isLegacy() );

        $oModule->setNonPublicVar( "_blLegacy", true );
        $this->assertTrue( $oModule->isLegacy() );
    }


     /**
     * oxmodule::isRegistered() test case
     *
     * @return null
     */
    public function testIsRegistered()
    {
        $oModule = $this->getProxyClass('oxmodule');
        $oModule->setNonPublicVar( "_blRegistered", false );
        $this->assertFalse( $oModule->isRegistered() );

        $oModule->setNonPublicVar( "_blRegistered", true );
        $this->assertTrue( $oModule->isRegistered() );
    }


     /**
     * oxmodule::getTitle() test case
     *
     * @return null
     */
    public function testGetTitle()
    {
        $iLang = oxLang::getInstance()->getTplLanguage();
        $oModule = $this->getMock( 'oxModule', array('getInfo') );
        $oModule->expects($this->once())->method('getInfo')->with($this->equalTo("title"), $this->equalTo($iLang) )->will( $this->returnValue("testTitle") );

        $this->assertEquals( "testTitle", $oModule->getTitle() );
    }

     /**
     * oxmodule::getDescription() test case
     *
     * @return null
     */
    public function testGetDescription()
    {
        $iLang = oxLang::getInstance()->getTplLanguage();
        $oModule = $this->getMock( 'oxModule', array('getInfo') );
        $oModule->expects($this->once())->method('getInfo')->with($this->equalTo("description"), $this->equalTo($iLang) )->will( $this->returnValue("testDesc") );

        $this->assertEquals( "testDesc", $oModule->getDescription() );
    }

     /**
     * oxmodule::remove() test case
     *
     * @return null
     */
    public function testRemove()
    {
        $oModule = $this->getMock( 'oxModule', array('_removeFromModulesArray', '_removeFromDisabledModulesArray', '_removeFromLegacyModulesArray', '_removeFromDatabase') );
        $oModule->expects($this->once())->method('_removeFromModulesArray');
        $oModule->expects($this->once())->method('_removeFromDisabledModulesArray');
        $oModule->expects($this->once())->method('_removeFromLegacyModulesArray');
        $oModule->expects($this->once())->method('_removeFromDatabase');

        $oModule->remove();
    }

     /**
     * oxmodule::_removeFromModulesArray() test case
     *
     * @return null
     */
    public function testRemoveFromModulesArray()
    {
        $aModules = array(
            'oxorder'  => 'testExt1/module1',
            'oxnews'   => 'testExt2/module2'
        );

        $aDeletedExt = array(
            'oxnews'   => 'testExt2/module2'
        );

        $aResult = array(
            'oxorder'  => 'testExt1/module1'
        );

        $oConfig = $this->getMock( "oxConfig", array( "saveShopConfVar" ) );
        $oConfig->expects($this->once())->method('saveShopConfVar')->with( $this->equalTo( 'aarr' ), $this->equalTo( 'aModules' ), $this->equalTo( $aResult ) );

        $oModule = $this->getMock( 'oxModule', array('getConfig', 'getAllModules') );
        $oModule->expects($this->once())->method('getConfig')->will( $this->returnValue($oConfig) );
        $oModule->expects($this->once())->method('getAllModules')->will( $this->returnValue($aModules) );


        $oModule->_removeFromModulesArray( $aDeletedExt );
    }

     /**
     * oxmodule::_removeFromDisabledModulesArray() test case
     *
     * @return null
     */
    public function testRemoveFromDisabledModulesArray()
    {
        $aModules = array(
            'oxorder'  => 'testExt1/module1',
            'oxnews'   => 'testExt2/module2'
        );

        $aDeletedExt = array(
            'oxnews'   => 'testExt2/module2'
        );

        $aResult = array(
            'oxorder'  => 'testExt1/module1'
        );

        $oConfig = $this->getMock( "oxConfig", array( "saveShopConfVar" ) );
        $oConfig->expects($this->once())->method('saveShopConfVar')->with( $this->equalTo( 'aarr' ), $this->equalTo( 'aDisabledModules' ), $this->equalTo( $aResult ) );

        $oModule = $this->getMock( 'oxModule', array('getConfig', 'getDisabledModules') );
        $oModule->expects($this->once())->method('getConfig')->will( $this->returnValue($oConfig) );
        $oModule->expects($this->once())->method('getDisabledModules')->will( $this->returnValue($aModules) );


        $oModule->_removeFromDisabledModulesArray( $aDeletedExt );
    }

     /**
     * oxmodule::_removeFromLegacyModulesArray() test case
     *
     * @return null
     */
    public function testRemoveFromLegacyModulesArray()
    {
        $aLegacyExt = array(
            'myext1'  => array( "title" => "test title 1"),
            'myext2'  => array( "title" => "test title 2")
        );

        $aDeletedExtIds = array( "myext1" );

        $aResult = array(
            'myext2'  => array( "title" => "test title 2")
        );

        $oConfig = $this->getMock( "oxConfig", array( "saveShopConfVar" ) );
        $oConfig->expects($this->once())->method('saveShopConfVar')->with( $this->equalTo( 'aarr' ), $this->equalTo( 'aLegacyModules' ), $this->equalTo( $aResult ) );

        $oModule = $this->getMock( 'oxModule', array('getConfig', 'getLegacyModules') );
        $oModule->expects($this->once())->method('getConfig')->will( $this->returnValue($oConfig) );
        $oModule->expects($this->once())->method('getLegacyModules')->will( $this->returnValue($aLegacyExt) );


        $oModule->_removeFromLegacyModulesArray( $aDeletedExtIds );
    }

     /**
     * oxmodule::_removeFromDatabase() test case
     *
     * @return null
     */
    public function testRemoveFromDatabase()
    {
        $oDb = oxDb::getDb();
        $oConfig = new oxConfig();
        $sShopId = $oConfig->getBaseShopId();

        $sQ1 = "insert into oxconfig (oxid, oxshopid, oxvarname, oxvartype, oxvarvalue,  oxmodule) values
                                     ('_test1', '$sShopId', 'testVar1', 'int', 1, 'module:testext')";

        $sQ2 = "insert into oxconfigdisplay (oxid, oxcfgmodule, oxcfgvarname) values
                                     ('_test1', 'module:testext', 'testVarName1')";

        $sQ3 = "insert into oxtplblocks (oxid, oxshopid, oxblockname, oxmodule) values
                                     ('_test1', 'testVarName1', 'testBlockName1', 'testext')";

        $oDb->execute( $sQ1 );
        $oDb->execute( $sQ2 );
        $oDb->execute( $sQ3 );

        $aDeletedExtIds = array( "myext1" );

        $oModule = $this->getProxyClass('oxmodule');

        $oModule->_removeFromDatabase( $aDeletedExtIds );
    }
}
