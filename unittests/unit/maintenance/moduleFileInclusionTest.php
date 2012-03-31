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
 * test for situation:
 * module class is registered for oxnew but was not yet instantialized
 * module file inclusion makes autoload mod_parent by including the same module file
 * thus in the end module class is created twice resulting in php fatal error
 */
class Unit_Maintenance_moduleFileInclusionTest extends OxidTestCase
{
    /**
     * test main scenario
     */
    public function testModuleInclusion()
    {
        $oCfg = $this->getMock('oxConfig', array('getConfigParam'));
        $oCfg->expects($this->at(0))->method('getConfigParam')->with($this->equalTo('aModules'))->will($this->returnValue(array('oxarticle'=>'testmod')));
        $oCfg->expects($this->at(1))->method('getConfigParam')->with($this->equalTo('aDisabledModules'))->will($this->returnValue(array()));
        $oCfg->expects($this->at(2))->method('getConfigParam')->with($this->equalTo('aModulePaths'))->will($this->returnValue(array()));
        $oCfg->expects($this->at(3))->method('getConfigParam')->with($this->equalTo('sShopDir'))->will($this->returnValue(dirname(__FILE__)));

        $oUO = $this->getMock('oxUtilsObject', array('getConfig'));
        $oUO->expects($this->any())->method('getConfig')->will($this->returnValue($oCfg));

        modInstances::addMod('oxUtilsObject', $oUO);

        modConfig::getInstance()->setConfigParam('aModules', array('oxarticle'=>'testmod'));

        include_once dirname(__FILE__).'/modules/testmod.php';
    }
}
