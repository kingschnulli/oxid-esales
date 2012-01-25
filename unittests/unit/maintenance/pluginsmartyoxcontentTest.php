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
 * @version   SVN: $Id: pluginsmartyoxcontentTest.php 41033 2012-01-09 13:10:57Z linas.kukulskis $
 */

require_once realpath( "." ).'/unit/OxidTestCase.php';
require_once realpath( "." ).'/unit/test_config.inc.php';
require_once oxConfig::getInstance()->getConfigParam( 'sShopDir' ).'core/smarty/plugins/function.oxcontent.php';

class Unit_Maintenance_pluginSmartyOxContentTest extends OxidTestCase
{
    public function testGetContentWhenShopIsNotProductiveAndContentDoesNotExist()
    {
        oxTestModules::addFunction( "oxconfig", "getActiveShop", "{ \$oShop = new oxStdClass(); \$oShop->oxshops__oxproductive = new oxField();  return \$oShop;}" );

        $aParams['ident'] = 'testident';
        $oSmarty = new oxStdClass();

        $sText = "<b>content not found ! check ident(".$aParams['ident'].") !</b>";

        $this->assertEquals( $sText, smarty_function_oxcontent( $aParams, $oSmarty ) );
        //$this->assertEquals( $sText, $oSmarty->oxidcache );
    }

    public function testGetContentNoParamsPassedShopIsProductive()
    {
        $this->assertEquals( "<b>content not found ! check ident() !</b>", smarty_function_oxcontent( array(), new oxStdClass() ) );
    }

    public function testGetContentLoadByIdent()
    {

            $sShopId = 'oxbaseshop';


        $aParams['ident'] = 'oxsecurityinfo';
        $oSmarty = $this->getMock( "smarty", array( "fetch" ) );
        $oSmarty->expects( $this->once() )->method( 'fetch')
            ->with( $this->equalTo( 'ox:oxsecurityinfooxcontent0'.$sShopId ) )
            ->will( $this->returnValue( 'testvalue' ) );

        $sText = "<b>content not found ! check ident(".$aParams['ident'].") !</b>";

        $this->assertEquals( 'testvalue', smarty_function_oxcontent( $aParams, $oSmarty ) );
    }

    public function testGetContentLoadByIdentLangChange()
    {
            $sShopId = 'oxbaseshop';

        $aParams['ident'] = 'oxsecurityinfo';
        $oSmarty = $this->getMock( "smarty", array( "fetch" ) );
        $oSmarty->expects( $this->once() )->method( 'fetch')
            ->with( $this->equalTo( 'ox:oxsecurityinfooxcontent1'.$sShopId ) )
            ->will( $this->returnValue( 'testvalue' ) );

        $sText = "<b>content not found ! check ident(".$aParams['ident'].") !</b>";

        oxTestModules::addFunction('oxLang', 'getBaseLanguage', '{return 1;}');

        $this->assertEquals( 'testvalue', smarty_function_oxcontent( $aParams, $oSmarty ) );
    }

    public function testGetContentLoadByOxId()
    {
            $sShopId = 'oxbaseshop';

        $sText = "<b>content not found ! check ident() !</b>";

        $aParams['oxid'] = 'f41427a099a603773.44301043';
        $aParams['assign'] = true;

        $oSmarty = $this->getMock( "smarty", array( "fetch", "assign" ) );
        $oSmarty->expects( $this->once() )->method( 'fetch')->with($this->equalTo('ox:f41427a099a603773.44301043oxcontent0'.$sShopId))->will( $this->returnValue( 'testvalue' ) );
        $oSmarty->expects( $this->once() )->method( 'assign')->with( $this->equalTo( $sText ) );

        smarty_function_oxcontent( $aParams, $oSmarty );
    }
}
