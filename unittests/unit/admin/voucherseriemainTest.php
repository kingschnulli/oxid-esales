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
 * @version   SVN: $Id: voucherseriemainTest.php 26641 2010-03-18 09:10:17Z arvydas $
 */

require_once realpath( "." ).'/unit/OxidTestCase.php';
require_once realpath( "." ).'/unit/test_config.inc.php';

/**
 * Tests for VoucherSerie_Main class
 */
class Unit_Admin_VoucherSerieMainTest extends OxidTestCase
{
    /**
     * Cleanup
     *
     * @return
     */
    public function tearDown()
    {
        // cleanup
        $this->cleanUpTable( "oxvouchers" );

        parent::tearDown();
    }

    /**
     * VoucherSerie_Main::Render() test case
     *
     * @return null
     */
    public function testRender()
    {
        modConfig::setParameter( "oxid", "testId" );

        // testing..
        $oView = new VoucherSerie_Main();
        $this->assertEquals( 'voucherserie_main.tpl', $oView->render() );

        $aViewData = $oView->getViewData();
        $this->assertTrue( isset( $aViewData['edit'] ) );
        $this->assertTrue( $aViewData['edit'] instanceof oxvoucherserie );
        $this->assertEquals( array( "total" => 0, "used" => 0, "available" => 0 ), $aViewData['status'] );
    }

    /**
     * VoucherSerie_Main::Render() test case
     *
     * @return null
     */
    public function testRenderNoRealObjectId()
    {
        modConfig::setParameter( "oxid", "-1" );
        modConfig::setParameter( "saved_oxid", "-1" );

        // testing..
        $oView = new VoucherSerie_Main();
        $this->assertEquals( 'voucherserie_main.tpl', $oView->render() );

        $aViewData = $oView->getViewData();
        $this->assertFalse( isset( $aViewData['edit'] ) );
        $this->assertEquals( "-1", $aViewData['oxid'] );
        $this->assertEquals( "1", $aViewData['updatelist'] );
    }

    /**
     * VoucherSerie_Main::Save() test case
     *
     * @return null
     */
    public function testSave()
    {
        oxTestModules::addFunction( 'oxvoucherserie', 'save', '{ throw new Exception( "save" ); }');

        // testing..
        try {
            $oView = new VoucherSerie_Main();
            $oView->save();
        } catch ( Exception $oExcp ) {
            $this->assertEquals( "save", $oExcp->getMessage(), "error in Wrapping_Main::save()" );
            return;
        }
        $this->fail( "error in VoucherSerie_Main::save()" );
    }


    /**
     * VoucherSerie_Main::Save() test case
     *
     * @return null
     */
    public function testSaveNewSerie()
    {
        modConfig::setParameter( "oxid", "-1" );
        modConfig::setParameter( "voucherAmount", 1 );
        modSession::getInstance()->setVar( "randomVoucherNr", "randomVoucherNr" );
        modSession::getInstance()->setVar( "randomNr", "randomNr" );

        oxTestModules::addFunction( 'oxvoucherserie', 'save', '{ $this->oxvoucherseries__oxid = new oxField( "testvoucherserieid" ); return true; }');
        oxTestModules::addFunction( 'oxvoucherserie', 'getVoucherList', '{ $oVoucher = oxNew( "oxvoucher" ); return array( $oVoucher ); }');
        oxTestModules::addFunction( 'oxvoucher', 'save', '{ return true; }');

        // testing..
        $oView = new VoucherSerie_Main();
        $oView->save();

        $aViewData = $oView->getViewData();
        $this->assertTrue( isset( $aViewData['updatelist'] ) );
        $this->assertEquals( 1, $aViewData['updatelist'] );
        $this->assertNull( oxSession::getVar( "randomVoucherNr" ) );
        $this->assertNull( oxSession::getVar( "randomNr" ) );
        $this->assertEquals( "testvoucherserieid", oxSession::getVar( "saved_oxid" ) );
    }

    /**
     * VoucherSerie_Main::Export() test case
     *
     * @return null
     */
    public function testExport()
    {
        oxTestModules::addFunction( 'oxUtils', 'setHeader', '{ if ( !isset( $this->_aHeaderData ) ) { $this->_aHeaderData = array();} $this->_aHeaderData[] = $aA[0]; }');
        oxTestModules::addFunction( 'oxUtils', 'getHeaders', '{ return $this->_aHeaderData; }');
        oxTestModules::addFunction( 'oxUtils', 'showMessageAndExit', '{ $this->_aHeaderData[] = $aA[0]; }');
        oxTestModules::addFunction( 'oxvoucherserie', 'load', '{ $this->oxvoucherseries__oxid = new oxField( "testId" ); return true; }');

        // inserting demo record..
        $oVoucher = new oxBase();
        $oVoucher->init( "oxvouchers" );
        $oVoucher->setId( "_testVoucherId" );
        $oVoucher->oxvouchers__oxvoucherserieid = new oxField( "testId" );
        $oVoucher->oxvouchers__oxdiscount  = new oxField( 10 );
        $oVoucher->oxvouchers__oxvouchernr = new oxField( 10 );
        $oVoucher->oxvouchers__oxreserved  = new oxField( 0 );
        $oVoucher->oxvouchers__oxuserid    = new oxField( "oxdefaultadmin" );
        $oVoucher->save();

        // testing..
        $oView = new VoucherSerie_Main();
        $oView->export();

        $aHeaders = oxUtils::getInstance()->getHeaders();
        $this->assertEquals( "Pragma: public", $aHeaders[0] );
        $this->assertEquals( "Cache-Control: must-revalidate, post-check=0, pre-check=0", $aHeaders[1] );
        $this->assertEquals( "Expires: 0", $aHeaders[2] );
        $this->assertEquals( "Content-Disposition: attachment; filename=vouchers.csv", $aHeaders[3] );
        $this->assertEquals( "Content-Type: application/csv", $aHeaders[4] );
        $this->assertEquals( "Gutschein\n10\n", $aHeaders[5] );
    }
}
