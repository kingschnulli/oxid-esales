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
 * @version   SVN: $Id: oxvarianthandlerTest.php 32883 2011-02-03 11:45:58Z sarunas $
 */

require_once realpath( "." ).'/unit/OxidTestCase.php';
require_once realpath( "." ).'/unit/test_config.inc.php';

class Unit_Core_oxselectionTest extends OxidTestCase
{
    /**
     * Testing constructor and setters
     *
     * @return null
     */
    public function testConstructorAndSetters()
    {
        $oSelection = new oxSelection( "test", "test", true, true );

        //
        $this->assertEquals( "test", $oSelection->getValue() );
        $this->assertEquals( "test", $oSelection->getName() );
        $this->assertEquals( "#", $oSelection->getLink() );
        $this->assertTrue( $oSelection->isActive() );
        $this->assertTrue( $oSelection->isDisabled() );

        //
        $oSelection->setActiveState( false );
        $oSelection->setDisabled( false );
        $this->assertFalse( $oSelection->isActive() );
        $this->assertFalse( $oSelection->isDisabled() );
    }
}