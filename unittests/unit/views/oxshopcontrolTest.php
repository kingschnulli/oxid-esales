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

        $oConfig = $this->getMock( "oxStdClass", array( "isMall", "getConfigParam", "getShopHomeUrl" ) );
        $oConfig->expects( $this->at( 0 ) )->method( 'isMall' )->will( $this->returnValue( true ));
        $oConfig->expects( $this->at( 1 ) )->method( 'getConfigParam' )->with( $this->equalTo( "sMallShopURL" ) )->will( $this->returnValue( false ) );
        $oConfig->expects( $this->at( 2 ) )->method( 'getConfigParam' )->with( $this->equalTo( "iMallMode" ) )->will( $this->returnValue( 1 ) );
        //$oConfig->expects( $this->never() )->method( 'getShopId' );
        $oConfig->expects( $this->never() )->method( 'getShopHomeUrl' );

        $oControl = $this->getMock( "oxShopControl", array( "getConfig", "_runOnce", "isAdmin", "_process" ), array(), '', false );
        $oControl->expects( $this->once() )->method( 'getConfig' )->will( $this->returnValue( $oConfig ));
        $oControl->expects( $this->once() )->method( '_runOnce' );
        $oControl->expects( $this->once() )->method( 'isAdmin' )->will( $this->returnValue( false ));
        $oControl->expects( $this->once() )->method( '_process' )->with( $this->equalTo( "mallstart" ), $this->equalTo( "testFnc" ) );
        $oControl->start();

        //$this->assertEquals( oxConfig::getInstance()->getBaseShopId(), modSession::getInstance()->getVar( "actshop" ) );
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

        $oConfig = $this->getMock( "oxStdClass", array( "getShopHomeUrl" ) );
        //$oConfig->expects( $this->never() )->method( 'getShopId' )->will( $this->returnValue( 999 ) );
        $oConfig->expects( $this->never() )->method( 'getShopHomeUrl' );

        $oControl = $this->getMock( "oxShopControl", array( "getConfig", "_runOnce", "isAdmin", "_process" ), array(), '', false );
        $oControl->expects( $this->once() )->method( 'getConfig' )->will( $this->returnValue( $oConfig ));
        $oControl->expects( $this->once() )->method( '_runOnce' );
        $oControl->expects( $this->once() )->method( 'isAdmin' )->will( $this->returnValue( true ));
        $oControl->expects( $this->once() )->method( '_process' )->with( $this->equalTo( "login" ), $this->equalTo( "testFnc" ) );
        $oControl->start();

        //$this->assertEquals( oxConfig::getInstance()->getBaseShopId(), modSession::getInstance()->getVar( "actshop" ) );
     }

    /**
     * Testing oxShopControl::start()
     *
     * @return null
     */
    public function testStartSystemComponentExceptionThrown1()
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

        $oControl = $this->getMock( "oxShopControl", array( "getConfig", "_runOnce", "isAdmin", "_process", "_isDebugMode" ), array(), '', false );
        $oControl->expects( $this->at(0) )->method( 'getConfig' )->will( $this->returnValue( $oConfig ));
        $oControl->expects( $this->at(1) )->method( '_runOnce' );
        $oControl->expects( $this->at(2) )->method( 'isAdmin' )->will( $this->returnValue( false ));
        $oControl->expects( $this->at(3) )->method( '_process' )->with( $this->equalTo( "start" ), $this->equalTo( "testFnc" ) )->will( $this->throwException( new oxSystemComponentException ));
        $oControl->expects( $this->at(4) )->method( '_isDebugMode' )->will( $this->returnValue( true ));
        $oControl->expects( $this->at(5) )->method( '_process' )->with( $this->equalTo( "exceptionError" ), $this->equalTo( "displayExceptionError" ) );

        try {
            $oControl->start();
        } catch ( Exception $oExcp ) {
            $this->assertEquals( "oxSystemComponentException", $oExcp->getMessage(), "Error while executing testStartSystemComponentExceptionThrown()" );
            return;
        }
        $this->fail( "Error while executing testStartSystemComponentExceptionThrown()" );
     }

    /**
     * Test unhandled exception with Debug ON
     *
     * @return null
     */
    public function testStartExceptionWithDebug()
    {
        $this->setExpectedException('Exception', 'log debug');

        modConfig::getInstance()->setParameter( 'cl', 'testClass' );
        modConfig::setParameter( 'fnc', 'testFnc' );

        $oUtilsView = $this->getMock('oxUtilsView', array('addErrorToDisplay'), array(), '', false);
        $oUtilsView->expects( $this->any() )->method( 'addErrorToDisplay' );

        $oMockEx = $this->getMock('oxException', array('debugOut'));
        $oMockEx->expects( $this->once() )->method( 'debugOut' )->will( $this->throwException( new Exception('log debug') ));

        $oControl = $this->getMock( "oxShopControl", array( "getConfig", "_runOnce", "isAdmin", "_process", "_isDebugMode" ), array(), '', false, false, true );
        $oControl->expects( $this->at(0) )->method( 'getConfig' );
        $oControl->expects( $this->at(1) )->method( '_runOnce' );
        $oControl->expects( $this->at(2) )->method( '_process' )->with( $this->equalTo( "testClass" ), $this->equalTo( "testFnc" ) )->will( $this->throwException( $oMockEx ));
        $oControl->expects( $this->at(3) )->method( '_isDebugMode' )->will( $this->returnValue( true ));
        $oControl->expects( $this->at(4) )->method( '_process' )->with( $this->equalTo( "exceptionError" ), $this->equalTo( "displayExceptionError" ));

        $oControl->start();
    }

    /**
     * Test unhandled exception with debug OFF
     *
     * @return null
     */
    public function testStartExceptionNoDebug()
    {
        $this->setExpectedException('Exception', 'log debug');

        modConfig::getInstance()->setParameter( 'cl', 'testClass' );
        modConfig::setParameter( 'fnc', 'testFnc' );

        $oMockEx = $this->getMock('oxException', array('debugOut'));
        $oMockEx->expects( $this->once() )->method( 'debugOut' )->will( $this->throwException( new Exception('log debug') ));

        $oControl = $this->getMock( "oxShopControl", array( "getConfig", "_runOnce", "_process", "_isDebugMode" ), array(), '', false, false, true );
        $oControl->expects( $this->at(0) )->method( 'getConfig' );
        $oControl->expects( $this->at(1) )->method( '_runOnce' );
        $oControl->expects( $this->once() )->method( '_process' )->with( $this->equalTo( "testClass" ), $this->equalTo( "testFnc" ) )->will( $this->throwException( $oMockEx ));
        $oControl->expects( $this->at(3) )->method( '_isDebugMode' )->will( $this->returnValue( false ));

        $oControl->start();
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

        $oControl = $this->getMock( "oxShopControl", array( "getConfig", "_runOnce", "isAdmin", "_process", "_isDebugMode" ), array(), '', false );
        $oControl->expects( $this->at(0) )->method( 'getConfig' )->will( $this->returnValue( $oConfig ));
        $oControl->expects( $this->at(1) )->method( '_runOnce' );
        $oControl->expects( $this->at(2) )->method( 'isAdmin' )->will( $this->returnValue( false ));
        $oControl->expects( $this->at(3) )->method( '_process' )->with( $this->equalTo( "start" ), $this->equalTo( "testFnc" ) )->will( $this->throwException( new oxSystemComponentException ));
        $oControl->expects( $this->at(4) )->method( '_isDebugMode' )->will( $this->returnValue( true ));

        try {
            $oControl->start();
        } catch ( Exception $oExcp ) {
            $this->assertEquals( "oxCookieException", $oExcp->getMessage(), "Error while executing testStartCookieExceptionThrown()" );
            return;
        }
        $this->fail( "Error while executing testStartCookieExceptionThrown()" );
     }

    /**
     * Testing oxShopControl::start()
     * oxUtilsView::addErrorToDispla() should not be called in not debug mode
     *
     * @return null
     */
    public function testStartSystemComponentExceptionThrown_onlyInDebugMode()
    {
        modConfig::setParameter( 'iDebug', -1 );
        modConfig::setParameter( 'cl', null );
        modConfig::setParameter( 'fnc', "testFnc" );
        oxTestModules::addFunction( 'oxUtilsView', 'addErrorToDisplay', '{ throw new Exception("oxAddErrorToDisplayException"); }' );
        oxTestModules::addFunction( 'oxUtils', 'redirect', '{ throw new Exception("oxSystemComponentException"); }' );

        $oControl = $this->getMock( "oxShopControl", array( "_runOnce", "isAdmin", "_process", "_isDebugMode" ), array(), '', false );
        $oControl->expects( $this->once() )->method( '_runOnce' );
        $oControl->expects( $this->once() )->method( 'isAdmin' )->will( $this->returnValue( false ));
        $oControl->expects( $this->once() )->method( '_process' )->with( $this->equalTo( "start" ), $this->equalTo( "testFnc" ) )->will( $this->throwException( new oxSystemComponentException ));
        $oControl->expects( $this->once() )->method( '_isDebugMode' )->will( $this->returnValue( false ));

        try {
            $oControl->start();
        } catch ( Exception $oExcp ) {
            $this->fail( "Error while executing testStartSystemComponentExceptionThrown_onlyInDebugMode()" );
        }
     }

    /**
     * Testing oxShopControl::start()
     * oxUtilsView::addErrorToDispla() should not be called in not debug mode
     *
     * @return null
     */
    public function testStartCookieExceptionThrown_onlyInDebugMode()
    {
        modConfig::setParameter( 'cl', null );
        modConfig::setParameter( 'fnc', "testFnc" );
        oxTestModules::addFunction( 'oxUtilsView', 'addErrorToDisplay', '{ throw new Exception("oxAddErrorToDisplayException"); }' );
        oxTestModules::addFunction( 'oxUtils', 'redirect', '{ throw new Exception("oxSystemComponentException"); }' );

        $oControl = $this->getMock( "oxShopControl", array( "_runOnce", "isAdmin", "_process", "_isDebugMode" ), array(), '', false );
        $oControl->expects( $this->once() )->method( '_runOnce' );
        $oControl->expects( $this->once() )->method( 'isAdmin' )->will( $this->returnValue( false ));
        $oControl->expects( $this->once() )->method( '_process' )->with( $this->equalTo( "start" ), $this->equalTo( "testFnc" ) )->will( $this->throwException( new oxCookieException ));
        $oControl->expects( $this->once() )->method( '_isDebugMode' )->will( $this->returnValue( false ));

        try {
            $oControl->start();
        } catch ( Exception $oExcp ) {
            $this->assertNotEquals( "oxAddErrorToDisplayException", $oExcp->getMessage() );
            return;
        }
        $this->fail( "Error while executing testStartCookieExceptionThrown_onlyInDebugMode()" );
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
        $oControl->expects( $this->exactly(3) )->method( 'getConfig' )->will( $this->returnValue( $oConfig ) );
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
        $sTplPath .= modConfig::getInstance()->getConfigParam( 'sTheme' )."/tpl/page/checkout/basket.tpl";

        $iAt = 0;
        $oConfig = $this->getMock( "oxStdClass", array( "setActiveView", "getTemplatePath", "getConfigParam", "pageClose" ) );
        $oConfig->expects( $this->at( $iAt++ ) )->method( 'getConfigParam' )->with( $this->equalTo( "blLogging" ))->will( $this->returnValue( true ) );
        $oConfig->expects( $this->at( $iAt++ ) )->method( 'setActiveView' );
        $oConfig->expects( $this->at( $iAt++ ) )->method( 'getTemplatePath' )->will( $this->returnValue( $sTplPath ) );
        $oConfig->expects( $this->at( $iAt++ ) )->method( 'pageClose' );

        $aTasks = array( "isAdmin", "_log", "_startMonitor", "getConfig", "_stopMonitor", '_getOutputManager' );

        $oOut = $this->getMock( "oxOutput", array('output', 'flushOutput', 'sendHeaders') );
        $oOut->expects( $this->once() )->method( 'output' )->with($this->equalTo('content'));
        $oOut->expects( $this->once() )->method( 'flushOutput' )->will( $this->returnValue( null ) );
        $oOut->expects( $this->once() )->method( 'sendHeaders' )->will( $this->returnValue( null ) );

        $oControl = $this->getMock( "oxShopControl", $aTasks, array(), '', false );
        $oControl->expects( $this->exactly(3) )->method( 'getConfig' )->will( $this->returnValue( $oConfig ) );
        $oControl->expects( $this->any() )->method( 'isAdmin' )->will( $this->returnValue( false ) );
        $oControl->expects( $this->any() )->method( '_getOutputManager' )->will( $this->returnValue( $oOut ) );

        $oControl->UNITprocess( "info", null );
    }

    public function testProcessJson()
    {
        oxTestModules::addFunction( 'oxUtils', 'isSearchEngine', '{ return false; }' );
        oxTestModules::addFunction( 'oxUtils', 'setHeader', '{}' );

        modConfig::setParameter('renderPartial', 'asd');

        $sTplPath  = modConfig::getInstance()->getConfigParam( 'sShopDir' )."/out/";
        $sTplPath .= modConfig::getInstance()->getConfigParam( 'sTheme' )."/tpl/page/checkout/basket.tpl";

        $iAt = 0;
        $oConfig = $this->getMock( "oxStdClass", array( "setActiveView", "getTemplatePath", "getConfigParam", "pageClose" ) );
        $oConfig->expects( $this->at( $iAt++ ) )->method( 'getConfigParam' )->with( $this->equalTo( "blLogging" ))->will( $this->returnValue( true ) );
        $oConfig->expects( $this->at( $iAt++ ) )->method( 'setActiveView' );
        $oConfig->expects( $this->at( $iAt++ ) )->method( 'getTemplatePath' )->will( $this->returnValue( $sTplPath ) );
        $oConfig->expects( $this->at( $iAt++ ) )->method( 'pageClose' );

        $aTasks = array( "isAdmin", "_log", "_startMonitor", "getConfig", "_stopMonitor", '_getOutputManager', '_getErrors' );

        $oOut = $this->getMock( "oxOutput", array('output', 'flushOutput', 'sendHeaders', 'setOutputFormat') );
        $oOut->expects( $this->at(0) )->method( 'setOutputFormat' )->with( $this->equalTo( oxOutput::OUTPUT_FORMAT_JSON ) );
        $oOut->expects( $this->at(1) )->method( 'sendHeaders' )->will( $this->returnValue( null ) );
        $oOut->expects( $this->at(3) )->method( 'output' )->with($this->equalTo('content'), $this->anything());
        $oOut->expects( $this->at(4) )->method( 'flushOutput' )->will( $this->returnValue( null ) );

        $oControl = $this->getMock( "oxShopControl", $aTasks, array(), '', false );
        $oControl->expects( $this->exactly(3) )->method( 'getConfig' )->will( $this->returnValue( $oConfig ) );
        $oControl->expects( $this->any() )->method( 'isAdmin' )->will( $this->returnValue( false ) );
        $oControl->expects( $this->any() )->method( '_getOutputManager' )->will( $this->returnValue( $oOut ) );
        $oControl->expects( $this->any() )->method( '_getErrors' )->will( $this->returnValue( array() ) );

        $oControl->UNITprocess( "info", null );
    }

    public function testProcessJsonWithErrors()
    {
        oxTestModules::addFunction( 'oxUtils', 'isSearchEngine', '{ return false; }' );
        oxTestModules::addFunction( 'oxUtils', 'setHeader', '{}' );

        modConfig::setParameter('renderPartial', 'asd');

        $sTplPath  = modConfig::getInstance()->getConfigParam( 'sShopDir' )."/out/";
        $sTplPath .= modConfig::getInstance()->getConfigParam( 'sTheme' )."/tpl/page/checkout/basket.tpl";

        $iAt = 0;
        $oConfig = $this->getMock( "oxStdClass", array( "setActiveView", "getTemplatePath", "getConfigParam", "pageClose" ) );
        $oConfig->expects( $this->at( $iAt++ ) )->method( 'getConfigParam' )->with( $this->equalTo( "blLogging" ))->will( $this->returnValue( true ) );
        $oConfig->expects( $this->at( $iAt++ ) )->method( 'setActiveView' );
        $oConfig->expects( $this->at( $iAt++ ) )->method( 'getTemplatePath' )->will( $this->returnValue( $sTplPath ) );
        $oConfig->expects( $this->at( $iAt++ ) )->method( 'pageClose' );

        $aTasks = array( "isAdmin", "_log", "_startMonitor", "getConfig", "_stopMonitor", '_getOutputManager', '_getErrors' );

        $oOut = $this->getMock( "oxOutput", array('output', 'flushOutput', 'sendHeaders', 'setOutputFormat') );
        $oOut->expects( $this->at(0) )->method( 'setOutputFormat' )->with( $this->equalTo( oxOutput::OUTPUT_FORMAT_JSON ) );
        $oOut->expects( $this->at(1) )->method( 'output' )->with($this->equalTo('errors'), $this->equalTo(
                array(
                    'other'=>array('test1', 'test3'),
                    'default'=>array('test2', 'test4'),
                )
                ));
        $oOut->expects( $this->at(2) )->method( 'sendHeaders' )->will( $this->returnValue( null ) );
        $oOut->expects( $this->at(3) )->method( 'output' )->with($this->equalTo('content'), $this->anything());
        $oOut->expects( $this->at(4) )->method( 'flushOutput' )->will( $this->returnValue( null ) );

        $oControl = $this->getMock( "oxShopControl", $aTasks, array(), '', false );
        $oControl->expects( $this->exactly(3) )->method( 'getConfig' )->will( $this->returnValue( $oConfig ) );
        $oControl->expects( $this->any() )->method( 'isAdmin' )->will( $this->returnValue( false ) );
        $oControl->expects( $this->any() )->method( '_getOutputManager' )->will( $this->returnValue( $oOut ) );
        $aErrors = array();
        $oDE = new oxDisplayError();
        $oDE->setMessage('test1');
        $aErrors['other'][]   = serialize($oDE);
        $oDE->setMessage('test2');
        $aErrors['default'][] = serialize($oDE);
        $oDE->setMessage('test3');
        $aErrors['other'][]   = serialize($oDE);
        $oDE->setMessage('test4');
        $aErrors['default'][] = serialize($oDE);

        $oControl->expects( $this->any() )->method( '_getErrors' )->will( $this->returnValue($aErrors));

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

        $oOut = $this->getMock( "oxOutput", array('output'));
        $oOut->expects( $this->never() )->method( 'output' );

        $oControl = $this->getMock( "oxShopControl", array( "isAdmin", '_getOutputManager' ), array(), '', false );
        $oControl->expects( $this->any() )->method( 'isAdmin' )->will( $this->returnValue( true ) );
        $oControl->expects( $this->any() )->method( '_getOutputManager' )->will( $this->returnValue( $oOut ) );
        $oControl->UNITstartMonitor();
        $oControl->UNITstopMonitor();

        $oOut = $this->getMock( "oxOutput", array('output'));
        $oOut->expects( $this->once() )->method( 'output' )->with($this->equalTo('debuginfo'));

        $oControl = $this->getMock( "oxShopControl", array( "isAdmin", '_getOutputManager' ), array(), '', false );
        $oControl->expects( $this->any() )->method( 'isAdmin' )->will( $this->returnValue( false ) );
        $oControl->expects( $this->any() )->method( '_getOutputManager' )->will( $this->returnValue( $oOut ) );
        $oControl->UNITstartMonitor();
        $oControl->UNITstopMonitor();
    }

    /**
     * Testing if shop is debug mode in frontend
     *
     * @return null
     */
    public function testIsDebugMode_notAdminMode()
    {

        $oControl = $this->getMock( "oxShopControl", array( "isAdmin" ), array(), '', false );
        $oControl->expects( $this->any() )->method( 'isAdmin' )->will( $this->returnValue( false ) );

        modConfig::getInstance()->setConfigParam( "iDebug", -1 );
        $this->assertTrue( $oControl->UNITisDebugMode() );

        modConfig::getInstance()->setConfigParam( "iDebug", 0 );
        $this->assertFalse( $oControl->UNITisDebugMode() );
    }

    /**
     * Testing if shop is debug mode in frontend
     *
     * @return null
     */
    public function testIsDebugMode_adminMode()
    {
        $oControl = $this->getMock( "oxShopControl", array( "isAdmin" ), array(), '', false );
        $oControl->expects( $this->any() )->method( 'isAdmin' )->will( $this->returnValue( true ) );

        modConfig::getInstance()->setConfigParam( "iDebug", -1 );
        $this->assertFalse( $oControl->UNITisDebugMode() );

        modConfig::getInstance()->setConfigParam( "iDebug", 0 );
        $this->assertFalse( $oControl->UNITisDebugMode() );
    }

    public function testGetErrors()
    {
        modSession::getInstance()->setVar('Errors', null);
        $oControl = new oxShopControl();
        $this->assertEquals(array(), $oControl->UNITgetErrors());
        $this->assertEquals(array(), modSession::getInstance()->getVar('Errors'));
        $this->assertEquals(array(), $oControl->UNITgetErrors());

        modSession::getInstance()->setVar('Errors', array());
        $oControl = new oxShopControl();
        $this->assertEquals(array(), $oControl->UNITgetErrors());
        $this->assertEquals(array(), modSession::getInstance()->getVar('Errors'));
        $this->assertEquals(array(), $oControl->UNITgetErrors());

        modSession::getInstance()->setVar('Errors', array('asd'=>'asd'));
        $oControl = new oxShopControl();
        $this->assertEquals(array('asd'=>'asd'), $oControl->UNITgetErrors());
        $this->assertEquals(array(), modSession::getInstance()->getVar('Errors'));
        $this->assertEquals(array('asd'=>'asd'), $oControl->UNITgetErrors());
    }

    public function testGetOutputManager()
    {
        $oControl = new oxShopControl();
        $oOut = $oControl->UNITgetOutputManager();
        $this->assertTrue($oOut instanceof oxOutput);
        $oOut1 = $oControl->UNITgetOutputManager();
        $this->assertSame($oOut, $oOut1);
   }


}
