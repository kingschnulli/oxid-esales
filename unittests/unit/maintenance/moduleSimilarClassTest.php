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

class Unit_Maintenance_moduleSimilarClassTest extends OxidTestCase
{
    
    /**
     * test when overloading class in module with similar name as other module
     */
    public function testModuleSimilarName()
    {
        $sMdir = realpath((dirname(__FILE__).'/'));
        modConfig::getInstance()->setConfigParam( "sShopDir", $sMdir."/" );
        modConfig::getInstance()->setConfigParam('aModules', array(
            
            'oxbasketitem' => 'test/testbasketitem','oxbasket' => 'test/testbasket&test/testbasket2'
            ));
        
        $oBask = oxNew( 'testbasket' );
        
        $this->assertEquals( 'testbasket', get_class($oBask) );
    }
  
    /**
     * test catching exception when calling not existent similar module
     */
    public function testModuleSimilarName_ClassNotExist()
    {
        $this->setExpectedException('oxSystemComponentException');
        modConfig::getInstance()->setConfigParam('aModules', array(
            'oxbasketitem' => 'test/testbasket'));
        $oBask = oxNew('testbaske');
    }
 }
