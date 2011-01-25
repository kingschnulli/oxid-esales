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
 * @version   SVN: $Id: wishlistTest.php 25505 2010-02-02 02:12:13Z alfonsas $
 */

require_once realpath( "." ).'/unit/OxidTestCase.php';
require_once realpath( "." ).'/unit/test_config.inc.php';

class Unit_Views_oxShopControlTest extends OxidTestCase
{
    protected function tearDown()
    {
        parent::tearDown();

        oxDb::getDb()->execute( "delete from oxlogs" );
    }

    /**
     * Testing oxShopControl::start()
     *
     * @return null
     */
    public function testStart()
    {
        modConfig::setParameter( 'cl', null );
        modConfig::setParameter( 'fnc', "testFnc" );
        modSession::getInstance()->setVar( 'actshop', null );
        oxTestModules::addFunction( 'oxUtils', 'redirect', '{ throw new Exception("Error in testStart()"); }' );
        modDB::getInstance()->addClassFunction( 'getOne', create_function('$x', 'return 2;' ) );

        $oConfig = $this->getMock( "oxStdClass", array( "isMall", "getConfigParam", "getShopId", "getShopHomeUrl" ) );
        $oConfig->expects( $this->at( 0 ) )->method( 'isMall' )->will( $this->returnValue( true ));
        $oConfig->expects( $this->at( 1 ) )->method( 'getConfigParam' )->with( $this->equalTo( "sMallShopURL" ) )->will( $this->returnValue( false ) );
        $oConfig->expects( $this->at( 2 ) )->method( 'getConfigParam' )->with( $this->equalTo( "iMallMode" ) )->will( $this->returnValue( 1 ) );
        $oConfig->expects( $this->at( 3 ) )->method( 'getShopId' )->will( $this->returnValue( 999 ) );
        $oConfig->expects( $this->never() )->method( 'getShopHomeUrl' );

        $oControl = $this->getMock( "oxShopControl", array( "getConfig", "_runOnce", "isAdmin", "_process" ), array(), '', false );
        $oControl->expects( $this->once() )->method( 'getConfig' )->will( $this->returnValue( $oConfig ));
        $oControl->expects( $this->once() )->method( '_runOnce' );
        $oControl->expects( $this->once() )->method( 'isAdmin' )->will( $this->returnValue( false ));
        $oControl->expects( $this->once() )->method( '_process' )->with( $this->equalTo( "mallstart" ), $this->equalTo( "testFnc" ) );
        $oControl->start();

        $this->assertEquals( 999, modSession::getInstance()->getVar( "actshop" ) );
     }

    /**
     * Testing oxShopControl::start()
     *
     * @return null
     */
    public function testStartIsAdmin()
    {
        modConfig::setParameter( 'cl', null );
        modConfig::setParameter( 'fnc', "testFnc" );
        modSession::getInstance()->setVar( 'actshop', null );
        oxTestModules::addFunction( 'oxUtils', 'redirect', '{ throw new Exception("Error in testStart()"); }' );
        modDB::getInstance()->addClassFunction( 'getOne', create_function('$x', 'return 2;' ) );

        $oConfig = $this->getMock( "oxStdClass", array( "isMall", "getConfigParam", "getShopId", "getShopHomeUrl" ) );
        $oConfig->expects( $this->once() )->method( 'getShopId' )->will( $this->returnValue( 999 ) );
        $oConfig->expects( $this->never() )->method( 'getShopHomeUrl' );

        $oControl = $this->getMock( "oxShopControl", array( "getConfig", "_runOnce", "isAdmin", "_process" ), array(), '', false );
        $oControl->expects( $this->once() )->method( 'getConfig' )->will( $this->returnValue( $oConfig ));
        $oControl->expects( $this->once() )->method( '_runOnce' );
        $oControl->expects( $this->once() )->method( 'isAdmin' )->will( $this->returnValue( true ));
        $oControl->expects( $this->once() )->method( '_process' )->with( $this->equalTo( "login" ), $this->equalTo( "testFnc" ) );
        $oControl->start();

        $this->assertEquals( 999, modSession::getInstance()->getVar( "actshop" ) );
     }

    /**
     * Testing oxShopControl::start()
     *
     * @return null
     */
    public function testStartSystemComponentExceptionThrown()
    {
        modConfig::setParameter( 'cl', null );
        modConfig::setParameter( 'fnc', "testFnc" );
        modSession::getInstance()->setVar( 'actshop', null );
        oxTestModules::addFunction( 'oxUtilsView', 'addErrorToDisplay', '{}' );
        oxTestModules::addFunction( 'oxUtils', 'redirect', '{ throw new Exception("oxSystemComponentException"); }' );

        $oConfig = $this->getMock( "oxStdClass", array( "isMall", "getConfigParam", "getShopId", "getShopHomeUrl" ) );
        $oConfig->expects( $this->at( 0 ) )->method( 'isMall' )->will( $this->returnValue( true ));
        $oConfig->expects( $this->at( 1 ) )->method( 'getShopId' )->will( $this->returnValue( 999 ) );
        $oConfig->expects( $this->at( 2 ) )->method( 'getShopHomeUrl' );

        $oControl = $this->getMock( "oxShopControl", array( "getConfig", "_runOnce", "isAdmin", "_process" ), array(), '', false );
        $oControl->expects( $this->once() )->method( 'getConfig' )->will( $this->returnValue( $oConfig ));
        $oControl->expects( $this->once() )->method( '_runOnce' );
        $oControl->expects( $this->once() )->method( 'isAdmin' )->will( $this->returnValue( false ));
        $oControl->expects( $this->once() )->method( '_process' )->with( $this->equalTo( "start" ), $this->equalTo( "testFnc" ) )->will( $this->throwException( new oxSystemComponentException ));

        try {
            $oControl->start();
        } catch ( Exception $oExcp ) {
            $this->assertEquals( "oxSystemComponentException", $oExcp->getMessage(), "Error while executing testStartSystemComponentExceptionThrown()" );
            return;
        }
        $this->fail( "Error while executing testStartSystemComponentExceptionThrown()" );
     }

    /**
     * Testing oxShopControl::start()
     *
     * @return null
     */
    public function testStartCookieExceptionThrown()
    {
        modConfig::setParameter( 'cl', null );
        modConfig::setParameter( 'fnc', "testFnc" );
        modSession::getInstance()->setVar( 'actshop', null );
        oxTestModules::addFunction( 'oxUtilsView', 'addErrorToDisplay', '{}' );
        oxTestModules::addFunction( 'oxUtils', 'redirect', '{ throw new Exception("oxCookieException"); }' );

        $oConfig = $this->getMock( "oxStdClass", array( "isMall", "getConfigParam", "getShopId", "getShopHomeUrl" ) );
        $oConfig->expects( $this->at( 0 ) )->method( 'isMall' )->will( $this->returnValue( true ));
        $oConfig->expects( $this->at( 1 ) )->method( 'getShopId' )->will( $this->returnValue( 999 ) );
        $oConfig->expects( $this->at( 2 ) )->method( 'getShopHomeUrl' );

        $oControl = $this->getMock( "oxShopControl", array( "getConfig", "_runOnce", "isAdmin", "_process" ), array(), '', false );
        $oControl->expects( $this->once() )->method( 'getConfig' )->will( $this->returnValue( $oConfig ));
        $oControl->expects( $this->once() )->method( '_runOnce' );
        $oControl->expects( $this->once() )->method( 'isAdmin' )->will( $this->returnValue( false ));
        $oControl->expects( $this->once() )->method( '_process' )->with( $this->equalTo( "start" ), $this->equalTo( "testFnc" ) )->will( $this->throwException( new oxSystemComponentException ));

        try {
            $oControl->start();
        } catch ( Exception $oExcp ) {
            $this->assertEquals( "oxCookieException", $oExcp->getMessage(), "Error while executing testStartCookieExceptionThrown()" );
            return;
        }
        $this->fail( "Error while executing testStartCookieExceptionThrown()" );
     }


    /**
     * Testing oxShopControl::_log()
     *
     * @return null
     */
    public function testLog()
    {
        $oDb = oxDb::getDb();

        modSession::getInstance()->setVar( "actshop", "testshopid" );
        modSession::getInstance()->setVar( "usr", "testusr" );

        modConfig::setParameter( "cnid", "testcnid" );
        modConfig::setParameter( "aid", "testaid" );
        modConfig::setParameter( "tpl", "testtpl.tpl" );
        modConfig::setParameter( "searchparam", "testsearchparam" );

        $this->assertEquals( 0, $oDb->getOne( "select count(*) from oxlogs" ) );

        //
        $oControl = new oxShopControl();
        $oControl->UNITlog( 'info', 'testFnc1' );
        $oControl->UNITlog( 'search', 'testFnc2' );

        $this->assertEquals( 2, $oDb->getOne( "select count(*) from oxlogs" ) );
        $this->assertTrue( (bool) $oDb->getOne( "select 1 from oxlogs where oxclass='info' and oxparameter='testtpl'" ) );
        $this->assertTrue( (bool) $oDb->getOne( "select 1 from oxlogs where oxclass='search' and oxparameter='testsearchparam'") );
    }

    /**
     * Testing oxShopControl::_process()
     *
     * @return null
     */
    public function testProcessTemplateNotFound()
    {
        oxTestModules::addFunction( 'oxUtils', 'isSearchEngine', '{ return false; }' );

        $iAt = 0;
        $oConfig = $this->getMock( "oxStdClass", array( "setActiveView", "getTemplatePath", "getConfigParam" ) );
        $oConfig->expects( $this->at( $iAt++ ) )->method( 'getConfigParam' )->with( $this->equalTo( "blLogging" ))->will( $this->returnValue( true ) );
        $oConfig->expects( $this->at( $iAt++ ) )->method( 'setActiveView' );
        $oConfig->expects( $this->at( $iAt++ ) )->method( 'getTemplatePath' );

        $aTasks = array( "isAdmin", "_log", "_startMonitor", "getConfig", "_stopMonitor" );

        $oControl = $this->getMock( "oxShopControl", $aTasks, array(), '', false );
        $oControl->expects( $this->once() )->method( 'getConfig' )->will( $this->returnValue( $oConfig ) );
        $oControl->expects( $this->any() )->method( 'isAdmin' )->will( $this->returnValue( false ) );

        try {
            $oControl->UNITprocess( "info", null );
        } catch ( oxSystemComponentException $oExcp ) {
            return;
        }
        $this->fail( "Error while executing testProcessTemplateNotFound()" );
    }

    /**
     * Testing oxShopControl::_process()
     *
     * @return null
     */
    public function testProcess()
    {
        oxTestModules::addFunction( 'oxUtils', 'isSearchEngine', '{ return false; }' );
        oxTestModules::addFunction( 'oxUtils', 'setHeader', '{}' );

        $sTplPath  = modConfig::getInstance()->getConfigParam( 'sShopDir' )."/out/";
        $sTplPath .= modConfig::getInstance()->getConfigParam( 'sTheme' )."/tpl/help.tpl";

        $iAt = 0;
        $oConfig = $this->getMock( "oxStdClass", array( "setActiveView", "getTemplatePath", "getConfigParam", "pageClose" ) );
        $oConfig->expects( $this->at( $iAt++ ) )->method( 'getConfigParam' )->with( $this->equalTo( "blLogging" ))->will( $this->returnValue( true ) );
        $oConfig->expects( $this->at( $iAt++ ) )->method( 'setActiveView' );
        $oConfig->expects( $this->at( $iAt++ ) )->method( 'getTemplatePath' )->will( $this->returnValue( $sTplPath ) );
        $oConfig->expects( $this->at( $iAt++ ) )->method( 'pageClose' );

        $aTasks = array( "isAdmin", "_log", "_startMonitor", "getConfig", "_stopMonitor", "_output" );

        $oControl = $this->getMock( "oxShopControl", $aTasks, array(), '', false );
        $oControl->expects( $this->once() )->method( 'getConfig' )->will( $this->returnValue( $oConfig ) );
        $oControl->expects( $this->any() )->method( 'isAdmin' )->will( $this->returnValue( false ) );
        $oControl->expects( $this->once() )->method( '_output' );

        $oControl->UNITprocess( "info", null );
    }


    /**
     * Testing oxShopControl::_startMonitor() & oxShopControl::_stopMonitor()
     *
     * @return null
     */
    public function testStartMonitorStopMonitor()
    {
        modConfig::getInstance()->setConfigParam( "blUseContentCaching", true );
        modConfig::getInstance()->setConfigParam( "iDebug", 4 );

        $oControl = $this->getMock( "oxShopControl", array( "isAdmin", "_output" ), array(), '', false );
        $oControl->expects( $this->any() )->method( 'isAdmin' )->will( $this->returnValue( true ) );
        $oControl->expects( $this->never() )->method( '_output' );
        $oControl->UNITstartMonitor();
        $oControl->UNITstopMonitor();

        $oControl = $this->getMock( "oxShopControl", array( "isAdmin", "_output" ), array(), '', false );
        $oControl->expects( $this->any() )->method( 'isAdmin' )->will( $this->returnValue( false ) );
        $oControl->expects( $this->once() )->method( '_output' );
        $oControl->UNITstartMonitor();
        $oControl->UNITstopMonitor();
    }
}