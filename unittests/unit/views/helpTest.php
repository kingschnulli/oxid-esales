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
 * @version   SVN: $Id: helpTest.php 28177 2010-06-07 11:35:27Z arvydas $
 */

require_once realpath( "." ).'/unit/OxidTestCase.php';
require_once realpath( "." ).'/unit/test_config.inc.php';

/**
 * Testing help class
 */
class Unit_Views_helpTest extends OxidTestCase
{
    /**
     * Help::render() test case
     *
     * @return null
     */
    public function testRender()
    {
        $oView = $this->getMock( "Help", array( "getHelpText" ) );
        $oView->expects( $this->once() )->method( 'getHelpText');
        $this->assertEquals( "help.tpl", $oView->render() );
    }

    /**
     * Test get help text.
     *
     * @return null
     */
    public function testGetHelpText()
    {
        modConfig::setParameter( 'tpl', 'start' );
        $oHelp = new help();

        $this->assertFalse( $oHelp->getHelpText() );
    }

    /**
     * Test get help text.
     *
     * @return null
     */
    public function testGetHelpTextDEfault()
    {
        modConfig::setParameter( 'tpl', null );
        $oHelp = new help();
        $this->assertFalse( $oHelp->getHelpText() );
    }
}
