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
 * @version   SVN: $Id: $
 */

require_once realpath( "." ).'/unit/OxidTestCase.php';
require_once realpath( "." ).'/unit/test_config.inc.php';
require_once getShopBasePath().'/setup/oxsetup.php';

/**
 * oxSetupSession tests
 */
class Unit_Setup_oxSetupSessionTest extends OxidTestCase
{
    /**
     * Testing oxSetupSession::getSid()
     *
     * @return null
     */
    public function testGetSid()
    {
        $oSession = $this->getMock( "oxSetupSession", array( "getSessionData" ) );
        $oSession->expects( $this->once() )->method( "getSessionData" )->will( $this->returnValue( 'testSessionData' ) );
        $this->assertEquals( rawurlencode( base64_encode( serialize( 'testSessionData' ) ) ), $oSession->getSid() );
    }

    /**
     * Testing oxSetupSession::getSessionData()
     *
     * @return null
     */
    public function testGetSessionData()
    {
        $oUtils = $this->getMock( "oxStdClass", array( "getRequestVar" ) );
        $oUtils->expects( $this->at( 0 ) )->method( "getRequestVar" )->with( $this->equalTo( "sid" ) )->will( $this->returnValue( base64_encode( serialize( "test" ) ) ) );
        $oUtils->expects( $this->at( 1 ) )->method( "getRequestVar" )->with( $this->equalTo( "country_lang" ), $this->equalTo( "post" ) )->will( $this->returnValue( "testCountryLang" ) );
        $oUtils->expects( $this->at( 2 ) )->method( "getRequestVar" )->with( $this->equalTo( "use_dynamic_pages" ), $this->equalTo( "post" ) )->will( $this->returnValue( "testUseDynamicPages" ) );
        $oUtils->expects( $this->at( 3 ) )->method( "getRequestVar" )->with( $this->equalTo( "check_for_updates" ), $this->equalTo( "post" ) )->will( $this->returnValue( "testCheckForUpdates" ) );
        $oUtils->expects( $this->at( 4 ) )->method( "getRequestVar" )->with( $this->equalTo( "iEula" ), $this->equalTo( "post" ) )->will( $this->returnValue( "testEula" ) );

        $oSession = $this->getMock( "oxSetupSession", array( "getInstance", "setSessionParam" ) );
        $oSession->expects( $this->at( 0 ) )->method( "getInstance" )->with( $this->equalTo( "oxSetupUtils" ) )->will( $this->returnValue( $oUtils ) );
        $oSession->expects( $this->at( 1 ) )->method( "setSessionParam" )->with( $this->equalTo( "country_lang" ), $this->equalTo( "testCountryLang" )  );
        $oSession->expects( $this->at( 2 ) )->method( "setSessionParam" )->with( $this->equalTo( "use_dynamic_pages" ), $this->equalTo( "testUseDynamicPages" )  );
        $oSession->expects( $this->at( 3 ) )->method( "setSessionParam" )->with( $this->equalTo( "check_for_updates" ), $this->equalTo( "testCheckForUpdates" )  );
        $oSession->expects( $this->at( 4 ) )->method( "setSessionParam" )->with( $this->equalTo( "eula" ), $this->equalTo( "testEula" )  );
        $this->assertEquals( "test", $oSession->getSessionData() );
    }

    /**
     * Testing oxSetupSession::setSessionParam() and oxSetupSession::getSessionParam()
     *
     * @return null
     */
    public function testSetSessionParamAndGetSessionParam()
    {
        $oSession = new oxSetupSession();
        $oSession->setSessionParam( "testParamName", "testParamValue" );
        $this->assertEquals( "testParamValue", $oSession->getSessionParam( "testParamName" ) );
    }
}
