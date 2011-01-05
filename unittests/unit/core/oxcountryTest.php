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
 * @version   SVN: $Id: oxcountryTest.php 26841 2010-03-25 13:58:15Z arvydas $
 */

require_once realpath( "." ).'/unit/OxidTestCase.php';
require_once realpath( "." ).'/unit/test_config.inc.php';

class Unit_Core_oxCountryTest extends OxidTestCase
{
    public $oObj = null;

    /**
     * Initialize the fixture.
     *
     * @return null
     */
    protected function setUp()
    {
        parent::setUp();
        $oObj = new oxbase();
        $oObj->init( 'oxcountry' );
        $oObj->oxcountry__oxtitle = new oxField('oxCountryTestDE', oxField::T_RAW);
        $oObj->oxcountry__oxtitle_1 = new oxField('oxCountryTestENG', oxField::T_RAW);
        $oObj->save();

        $this->oObj = new oxcountry();
        $this->oObj->load( $oObj->getId() );
    }

    /**
     * Tear down the fixture.
     *
     * @return null
     */
    protected function tearDown()
    {
        $this->oObj->delete();
        parent::tearDown();
    }

    /**
     *  Test loading country
     */
    // for default lang
    public function testLoadingCountryDefLanguage()
    {
        $oObj = new oxcountry();
        $oObj->load( $this->oObj->getId() );
        $this->assertEquals( 'oxCountryTestDE', $oObj->oxcountry__oxtitle->value );
    }
    // for second language
    public function testLoadingCountrySecondLanguage()
    {
        $oObj = new oxcountry();
        //$oObj->setLanguage( 1 );
        $oObj->loadInLang(1, $this->oObj->getId() );
        $this->assertEquals( 'oxCountryTestENG', $oObj->oxcountry__oxtitle->value );
    }

    /**
     *  Test loading not existing country
     */
    public function testLoadingNotExistingCountry()
    {
        $oObj = oxNew( "oxcountry" );
        $this->assertFalse( $oObj->load( 'noSuchCountry' ) );
    }

    public function testIsForeignCountry()
    {
        $oObj = new oxcountry();
        $aHome = oxConfig::getInstance()->getConfigParam( 'aHomeCountry' );
        $oObj->setId($aHome[0]);
        $this->assertFalse($oObj->isForeignCountry());

        $oObj->setId('country');
        $this->assertTrue($oObj->isForeignCountry());
    }

    public function testisInEU()
    {
            $oObj = new oxcountry();
            $oObj->setId('test');
            $oObj->oxcountry__oxvatstatus = new oxField(1, oxField::T_RAW);
            $this->assertTrue($oObj->isInEU());

            $oObj->oxcountry__oxvatstatus = new oxField(0, oxField::T_RAW);
            $this->assertFalse($oObj->isInEU());
    }


    /**
     * Tests state getter returned count
     *
     * @return null;
     */
    public function testGetStatesNumber()
    {
        $oSubj = new oxCountry();
        $oSubj->load('a7c40f631fc920687.20179984');
        $aStates = $oSubj->getStates();
        $this->assertEquals(16, count($aStates));
    }


    /**
     * Tests state getter
     *
     * @return null;
     */
    public function testGetStates()
    {
        $oSubj = new oxCountry();
        $oSubj->load('a7c40f631fc920687.20179984');
        $aStates = $oSubj->getStates();
        $this->assertEquals('Berlin', $aStates['BE']->oxstates__oxtitle->value);

    }
}
