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
 * @version   SVN: $Id: oxlinksTest.php 26841 2010-03-25 13:58:15Z arvydas $
 */

require_once realpath( "." ).'/unit/OxidTestCase.php';
require_once realpath( "." ).'/unit/test_config.inc.php';

class Unit_Core_oxfbTest extends OxidTestCase
{
    private $_oxLinks;

    /**
     * Initialize the fixture.
     *
     * @return null
     */
    protected function setUp()
    {
        parent::setUp();
    }

    /**
     * Tear down the fixture.
     *
     * @return null
     */
    protected function tearDown()
    {
        parent::tearDown();
    }

    /**
     * Testing method getInstance()
     *
     * @return null
     */
    public function testGetInstance()
    {
        $this->assertTrue( oxFb::getInstance() instanceof oxFb );
    }

   /**
    * Testing method isConnected() - FB connect is disabled
    */
    public function testIsConnected_FbConnectIsDisabled()
    {
        modConfig::getInstance()->setConfigParam( "bl_showFbConnect", false );

        $oFb = oxNew("oxFb" );
        $this->assertFalse( $oFb->isConnected() );
    }

   /**
    * Testing method isConnected() - FB connect is enabled
    *
    * @return null
    */
    public function testIsConnected_FbConnectIsEnabled()
    {
        modConfig::getInstance()->setConfigParam( "bl_showFbConnect", true );

        $oFb = $this->getMock( 'oxFb', array( 'getSession', 'getUser' ) );
        $oFb->expects( $this->once() )->method( 'getSession')->will( $this->returnValue( true ) );
        $oFb->expects( $this->once() )->method( 'getUser')->will( $this->returnValue( 1 ) );

        $this->assertTrue( $oFb->isConnected() );
    }

   /**
    * Testing method isConnected() - FB connect is enaabled but no FB session is active
    *
    * @return null
    */
    public function testIsConnected_noFbSession()
    {
        modConfig::getInstance()->setConfigParam( "bl_showFbConnect", true );

        $oFb = $this->getMock( 'oxFb', array( 'getSession', 'getUser' ) );
        $oFb->expects( $this->once() )->method( 'getSession')->will( $this->returnValue( false ) );
        $oFb->expects( $this->never() )->method( 'getUser');

        $this->assertFalse( $oFb->isConnected() );
    }

   /**
    * Testing method isConnected() - FB connect is enaabled but no FB user is active
    *
    * @return null
    */
    public function testIsConnected_noFbUser()
    {
        modConfig::getInstance()->setConfigParam( "bl_showFbConnect", true );

        $oFb = $this->getMock( 'oxFb', array( 'getSession', 'getUser' ) );
        $oFb->expects( $this->once() )->method( 'getSession')->will( $this->returnValue( true ) );
        $oFb->expects( $this->once() )->method( 'getUser')->will( $this->returnValue( null ) );

        $this->assertFalse( $oFb->isConnected() );
    }

}
