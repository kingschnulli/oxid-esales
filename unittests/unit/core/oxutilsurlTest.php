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
 * @version   SVN: $Id: oxutilsurlTest.php 26841 2010-03-25 13:58:15Z arvydas $
 */

require_once realpath( "." ).'/unit/OxidTestCase.php';
require_once realpath( "." ).'/unit/test_config.inc.php';

class Unit_Core_oxUtilsUrlTest extends OxidTestCase
{
    public function testGetInstance()
    {
        $this->assertTrue( oxUtilsUrl::getInstance() instanceof oxUtilsUrl );
    }


    public function testGetBaseAddUrlParamsPE()
    {

        $oUtils = new oxUtilsUrl();
        $this->assertEquals( array(), $oUtils->getBaseAddUrlParams() );
    }

    public function testGetAddUrlParams()
    {
        modConfig::setParameter( "currency", 1 );
        $aBaseUrlParams = array( "param1" => "value1", "param2" => "value2" );

        $oUtils = $this->getMock( "oxUtilsUrl", array( "getBaseAddUrlParams" ) );
        $oUtils->expects( $this->once() )->method( 'getBaseAddUrlParams' )->will( $this->returnValue( $aBaseUrlParams ) );

        $aBaseUrlParams['cur'] = 1;
        $this->assertEquals( $aBaseUrlParams, $oUtils->getAddUrlParams() );
    }

    public function testPrepareUrlForNoSession()
    {
        oxTestModules::addFunction('oxUtils', 'seoIsActive', '{return false;}');
        modConfig::getInstance()->addClassFunction('isMall', create_function('', 'return false;'));

        oxTestModules::addFunction('oxLang', 'getBaseLanguage', '{return 3;}');
        $this->assertEquals('sdf?lang=1', oxUtilsUrl::getInstance()->prepareUrlForNoSession('sdf?sid=111&lang=1'));
        $this->assertEquals('sdf?a&lang=1', oxUtilsUrl::getInstance()->prepareUrlForNoSession('sdf?sid=111&a&lang=1'));
        $this->assertEquals('sdf?a&amp;lang=1', oxUtilsUrl::getInstance()->prepareUrlForNoSession('sdf?sid=111&a&amp;lang=1'));
        $this->assertEquals('sdf?a&&amp;lang=3', oxUtils::getInstance()->prepareUrlForNoSession('sdf?sid=111&a&'));
        $this->assertEquals('sdf?lang=3', oxUtilsUrl::getInstance()->prepareUrlForNoSession('sdf'));

        modConfig::getInstance()->addClassFunction('isMall', create_function('', 'return true;'));
        modConfig::getInstance()->addClassFunction('getShopId', create_function('', 'return 5;'));

        $sShopId = '';

        $this->assertEquals('sdf?lang=3'.$sShopId, oxUtilsUrl::getInstance()->prepareUrlForNoSession('sdf?sid=asd'));
        $this->assertEquals('sdf?lang=2'.$sShopId, oxUtilsUrl::getInstance()->prepareUrlForNoSession('sdf?sid=das&lang=2'));
        $this->assertEquals('sdf?lang=2&shp=3', oxUtilsUrl::getInstance()->prepareUrlForNoSession('sdf?lang=2&sid=fs&amp;shp=3'));
        $this->assertEquals('sdf?shp=2&amp;lang=2', oxUtilsUrl::getInstance()->prepareUrlForNoSession('sdf?shp=2&amp;lang=2'));
        $this->assertEquals('sdf?shp=2&amp;lang=3', oxUtilsUrl::getInstance()->prepareUrlForNoSession('sdf?shp=2'));

        $this->assertEquals('sdf?lang=1'.$sShopId, oxUtilsUrl::getInstance()->prepareUrlForNoSession('sdf?force_sid=111&lang=1'));
        $this->assertEquals('sdf?a&lang=1'.$sShopId, oxUtilsUrl::getInstance()->prepareUrlForNoSession('sdf?force_sid=111&a&lang=1'));
        $this->assertEquals('sdf?a&amp;lang=1'.$sShopId, oxUtilsUrl::getInstance()->prepareUrlForNoSession('sdf?force_sid=111&a&amp;lang=1'));
        $this->assertEquals('sdf?a&&amp;lang=3'.$sShopId, oxUtilsUrl::getInstance()->prepareUrlForNoSession('sdf?force_sid=111&a&'));

        modConfig::getInstance()->setParameter('currency', 2);
        $this->assertEquals('sdf?lang=3&amp;cur=2'.$sShopId, oxUtilsUrl::getInstance()->prepareUrlForNoSession('sdf'));

        oxTestModules::addFunction('oxUtils', 'seoIsActive', '{return true;}');
        $this->assertEquals('sdf', oxUtilsUrl::getInstance()->prepareUrlForNoSession('sdf'));
    }

    public function testAppendUrl()
    {
        $sTestUrl = '';
        $aBaseUrlParams = array( "param1" => "value1", "param2" => "value2" );

        $oUtils = new oxUtilsUrl();
        $this->assertEquals( '?param1=value1&amp;param2=value2&amp;', $oUtils->UNITappendUrl( $sTestUrl, $aBaseUrlParams ) );
    }

    public function testProcessUrl()
    {
        $oUtils = $this->getMock( "oxUtilsUrl", array( "_appendUrl", "getBaseAddUrlParams" ) );
        $oUtils->expects( $this->once() )->method( 'getBaseAddUrlParams' );
        $oUtils->expects( $this->once() )->method( '_appendUrl' )->will( $this->returnValue( "appendedUrl" ) );

        $this->assertEquals( "appendedUrl", $oUtils->processUrl( "" ) );
    }

    public function testProcessSeoUrl()
    {
        $oUtils = $this->getMock( "oxUtilsUrl", array( "_appendUrl", "getAddUrlParams" ) );
        $oUtils->expects( $this->once() )->method( 'getAddUrlParams' );
        $oUtils->expects( $this->once() )->method( '_appendUrl' )->will( $this->returnValue( "appendedUrl" ) );

        $this->assertEquals( "appendedUrl", $oUtils->processSeoUrl( "" ) );
    }

    public function testProcessStdUrl()
    {
        oxTestModules::addFunction('oxUtils', 'seoIsActive', '{return false;}');
        $aBaseUrlParams = array( "param1" => "value1", "param2" => "value2" );
        $aAddParams = array( "param3" => "value3" );

        $oUtils = $this->getMock( "oxUtilsUrl", array( "_appendUrl", "getAddUrlParams" ) );
        $oUtils->expects( $this->once() )->method( 'getAddUrlParams' )->will( $this->returnValue( $aAddParams ) );
        $oUtils->expects( $this->once() )->method( '_appendUrl' )->with( $this->equalTo( "" ), $this->equalTo( array_merge( $aAddParams, $aBaseUrlParams ) ) )->will( $this->returnValue( "appendedUrl" ) );

        $this->assertEquals( "appendedUrl?lang=1", $oUtils->processStdUrl( "", $aBaseUrlParams, 1, true ) );
    }


    public function testAppendParamSeparator()
    {
        $oUtils = new oxUtilsUrl();
        $this->assertEquals( "asd?", $oUtils->appendParamSeparator("asd") );
        $this->assertEquals( "asd?", $oUtils->appendParamSeparator("asd?") );
        $this->assertEquals( "asd&", $oUtils->appendParamSeparator("asd&") );
        $this->assertEquals( "asd&amp;", $oUtils->appendParamSeparator("asd&amp;") );
        $this->assertEquals( "asd&amp;a?", $oUtils->appendParamSeparator("asd&amp;a") );
        $this->assertEquals( "asd?&amp;a&amp;", $oUtils->appendParamSeparator("asd?&amp;a") );
    }
}
