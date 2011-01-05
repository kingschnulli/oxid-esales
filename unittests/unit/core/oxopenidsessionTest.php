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
 * @version   SVN: $Id: oxopenidsessionTest.php 28201 2010-06-07 15:41:47Z michael.keiluweit $
 */

require_once realpath( "." ).'/unit/OxidTestCase.php';
require_once realpath( "." ).'/unit/test_config.inc.php';

/**
 * oxSession child for testing
 */
class modOpenidSession extends oxSession
{
    /**
     * Keeps test session vars
     *
     * @var array
     */
    static protected  $_aSessionVars = array();

    /**
     * Set session var for testing
     *
     * @param string $sVar
     * @param string $sVal
     */
    static public function setVar($sVar, $sVal)
    {
        self::$_aSessionVars[$sVar] = $sVal;
        //parent::setVar($sVar, $sVal);
    }

    /**
     * Gets session var for testing
     *
     * @param string $sVar
     *      
     * @return string
     */
    static public function getVar($sVar)
    {
        if (isset( self::$_aSessionVars[$sVar]))
            return self::$_aSessionVars[$sVar];

        return parent::getVar($sVar);
    }

    /**
     * Deletes test var $sVar
     *
     * @param string $sVar
     */
    static public function deleteVar($sVar)
    {
        unset($this->_aSessionVars[$sVar]);
    }

}



/**
 * Testing oxsession class
 */
class Unit_Core_oxopenidsessionTest extends OxidTestCase
{
    /**
     * Initialize the fixture.
     *
     * @return null
     */
    protected function setUp()
    {
        parent::setUp();
        oxAddClassModule('modOpenidSession', 'oxSession');
    }

    /**
     * Tear down the fixture.
     *
     * @return null
     */
    protected function tearDown()
    {
        //removing oxUtils module
        oxRemClassModule('modOpenidSession');

        parent::tearDown();
    }

    /**
     * oxsession::setVar() test
     */
    function testSetGetVar()
    {
        //taking real session object
        $testSession = new oxOpenIdSession();
        $testSession->set('testVar', 'testVal');
        $this->assertEquals( 'testVal', $testSession->get('testVar'));
    }

    /**
     * This functionality is not testable, as session data setter/getter is handled by modSession methods
     *
     * oxsession::deletVar() test
     */
    function testDeleteVar()
    {
        //taking real session object
        $testSession = new oxOpenIdSession();
        $testSession->set( 'testVar', 'testVal');
        $this->assertTrue( $testSession->hasVar('testVar'));
        $this->assertEquals( 'testVal', $testSession->get('testVar'));
        $testSession->del( 'testVar');
        $this->assertFalse( $testSession->hasVar('testVar'));
        $this->assertNotEquals( 'testVal', $testSession->get('testVar'));
    }

}
