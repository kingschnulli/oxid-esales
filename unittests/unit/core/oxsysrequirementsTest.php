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
 * @version   SVN: $Id: oxsysrequirementsTest.php 26930 2010-03-29 13:30:53Z alfonsas $
 */

require_once realpath( "." ).'/unit/OxidTestCase.php';
require_once realpath( "." ).'/unit/test_config.inc.php';

class Unit_Core_oxSysRequirementsTest extends OxidTestCase
{
    public function testGetBytes()
    {
        $oSysReq = $this->getProxyClass('oxSysRequirements');
        $this->assertEquals( 33554432, $oSysReq->UNITgetBytes( '32M' ));
        $this->assertEquals( 32768, $oSysReq->UNITgetBytes( '32K' ));
        $this->assertEquals( 34359738368, $oSysReq->UNITgetBytes( '32G' ));
    }

    public function testGetRequiredModules()
    {
        $oSysReq = $this->getProxyClass('oxSysRequirements');
        $aRequiredModules = $oSysReq->getRequiredModules();
        $sCnt = 21;
            $sCnt = 20;
        if ( isAdmin() ) {
            $sCnt++;
        }
        $this->assertEquals( $sCnt, count($aRequiredModules));
    }

    public function testGetModuleInfo()
    {
        $oSysReq = $this->getMock( 'oxSysRequirements', array( 'checkMbString', 'checkModRewrite' ) );
        $oSysReq->expects( $this->once() )->method( 'checkMbString' );
        $oSysReq->expects( $this->never() )->method( 'checkModRewrite' );
        $oSysReq->getModuleInfo('mb_string');
    }

    public function testGetSystemInfo()
    {
        $oSysReq = $this->getProxyClass('oxSysRequirements');
        $aSysInfo = $oSysReq->getSystemInfo();
        $this->assertEquals( 3, count($aSysInfo));
        $sCnt = 10;
            $sCnt = 11;
        $this->assertEquals( $sCnt, count($aSysInfo['php_extennsions']));
        $this->assertEquals( 7, count($aSysInfo['php_config']));
        $sCnt = 4;
            $sCnt = 2;
        if ( isAdmin() ) {
            $sCnt++;
        }
        $this->assertEquals( $sCnt, count($aSysInfo['server_config']));
    }

    /**
     * Testing oxSysRequirements::checkServerPermissions()
     *
     * @return null
     */
    public function testCheckServerPermissions()
    {
        $oSysReq = new oxSysRequirements();
        $this->assertEquals( 2, $oSysReq->checkServerPermissions() );
    }

    /**
     * Testing oxSysRequirements::checkMysqlVersion()
     *
     * @return null
     */
    public function testCheckMysqlVersion()
    {
        $aRez = oxDb::getDb()->getAll( "SHOW VARIABLES LIKE 'version'" );
        foreach ( $aRez as $aRecord ) {
            $sVersion = $aRecord[1];
            break;
        }

        $iModStat = 0;
        if ( version_compare( $sVersion, '5', '>=' ) && version_compare( $sVersion, '5.0.37', '<>' ) ) {
            $iModStat = 2;
        }

        //
        $oSysReq = new oxSysRequirements();
        $this->assertEquals( $iModStat, $oSysReq->checkMysqlVersion() );
    }

    public function testCheckCollation()
    {
        $oSysReq = $this->getProxyClass('oxSysRequirements');
        $aCollations = $oSysReq->checkCollation();
        $this->assertEquals( 0, count($aCollations));
    }

    public function testGetSysReqStatus()
    {
        $oSysReq = $this->getMock( 'oxSysRequirements', array( 'getSystemInfo' ) );
        $oSysReq->expects( $this->once() )->method( 'getSystemInfo' );
        $this->assertTrue( $oSysReq->getSysReqStatus() );
    }

}
