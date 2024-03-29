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
 * @version   SVN: $Id: oxdisplayerrorTest.php 26841 2010-03-25 13:58:15Z arvydas $
 */

require_once realpath( "." ).'/unit/OxidTestCase.php';
require_once realpath( "." ).'/unit/test_config.inc.php';

class Unit_Core_oxdisplayerrorTest extends OxidTestCase
{
    private $_oDisplayError;

    /**
     * Initialize default display error object.
     *
     * @return null
     */
    protected function setUp()
    {
        parent::setUp();
        $this->_oDisplayError = oxNew( 'oxDisplayError' );
    }

    /**
     * Tests the set and getter for message
     */
    public function testGetOxMessage()
    {
        $this->_oDisplayError->setMessage("Test ");
        $this->assertEquals("Test ", $this->_oDisplayError->getOxMessage());
    }

    /**
     * Test if the error class is always null
     */
    public function testGetErrorClassType()
    {
        $this->assertNull($this->_oDisplayError->getErrorClassType());
    }
    /**
    *tests if the value is always empty
    */
    public function testGetValue()
    {
        $this->assertEquals($this->_oDisplayError->getValue("whatever"), "");
    }

}
