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
 * @version   SVN: $Id: adminlinkslistTest.php 27089 2010-04-07 14:28:32Z sarunas $
 */

require_once realpath( "." ).'/unit/OxidTestCase.php';
require_once realpath( "." ).'/unit/test_config.inc.php';

/**
 * Tests for Adminlinks_List class
 */
class Unit_Admin_AdminlinksListTest extends OxidTestCase
{
    /**
     * Adminlinks_List::Init() test case
     *
     * @return null
     */
    public function testInit()
    {
        oxTestModules::addFunction("oxUtilsServer", "getOxCookie", "{return array(1);}");
        oxTestModules::addFunction("oxUtils", "checkAccessRights", "{return true;}");

        $oSess = $this->getMock('oxsession', array('checkSessionChallenge'));
        $oSess->expects($this->once())->method('checkSessionChallenge')->will($this->returnValue(true));
     
        $oView = $this->getMock($this->getProxyClassName('Adminlinks_List'), array('getSession'));
        $oView->expects($this->any())->method('getSession')->will($this->returnValue($oSess));

        $oView->init();

        $this->assertTrue( $oView->getNonPublicVar( "_blDesc" ) );
    }

    /**
     * Adminlinks_List::Render() test case
     *
     * @return null
     */
    public function testRender()
    {
        // testing..
        $oView = new Adminlinks_List();
        $this->assertEquals( 'adminlinks_list.tpl', $oView->render() );
    }

}
