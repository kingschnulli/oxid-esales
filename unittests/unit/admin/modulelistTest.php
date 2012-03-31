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
 * @version   SVN: $Id$
 */

require_once realpath( "." ).'/unit/OxidTestCase.php';
require_once realpath( "." ).'/unit/test_config.inc.php';

/**
 * Tests for Shop_Config class
 */
class Unit_Admin_ModuleListTest extends OxidTestCase
{
    /**
     * Module_List::Render() test case
     *
     * @return null
     */
    public function testRender()
    {
        $oView = new Module_List();
        $this->assertEquals( 'module_list.tpl', $oView->render() );

            $aViewData = $oView->getViewData();
            $this->assertTrue( isset( $aViewData['mylist'] ) );
            $this->assertEquals( 1, count($aViewData['mylist']) );
    }

    /**
     * Module_List::_extendsClasses() test case
     *
     * @return null
     */
    public function testExtendsClasses()
    {
        $aModules = array(
            'oxarticle' => 'mod/testModule&mod2/testModule2/&mod3/dir3/testModule3',
            'oxorder'   => 'mod7/testModuleOrder&myext/myextclass',

        );

        modConfig::getInstance()->setConfigParam( "aModules", $aModules );

        $oModuleList = $this->getProxyClass( 'Module_List' );
        $oModuleList->setNonPublicVar( "_aModule", $aModules );

        $this->assertTrue( $oModuleList->_extendsClasses("mod3/dir3") );
        $this->assertTrue( $oModuleList->_extendsClasses("mod") );
        $this->assertTrue( $oModuleList->_extendsClasses("myext") );
        $this->assertFalse( $oModuleList->_extendsClasses("mo") );
        $this->assertFalse( $oModuleList->_extendsClasses("mod4") );
        $this->assertFalse( $oModuleList->_extendsClasses("mod3/dir") );
        $this->assertFalse( $oModuleList->_extendsClasses("od3/dir") );
        $this->assertFalse( $oModuleList->_extendsClasses("dir3/testModule3") );
    }
}
