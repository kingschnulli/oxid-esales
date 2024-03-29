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
 * @version   SVN: $Id: oxratingTest.php 26841 2010-03-25 13:58:15Z arvydas $
 */

require_once realpath( "." ).'/unit/OxidTestCase.php';
require_once realpath( "." ).'/unit/test_config.inc.php';

class Unit_Core_oxratingTest extends OxidTestCase
{
    /**
     * Initialize the fixture.
     *
     * @return null
     */
    protected function setUp()
    {
        parent::setUp();
        $oDB = oxDb::getDb();
        $myConfig = oxConfig::getInstance();
        $sDate = date( 'Y-m-d', oxUtilsDate::getInstance()->getTime() - 5*24*60*60);
        $sInsert = "INSERT INTO `oxratings` (`OXID` ,`OXSHOPID` ,`OXUSERID` ,`OXOBJECTID` ,`OXRATING` ,`OXTIMESTAMP` ,
                    `OXTYPE`) VALUES ('test', '".$myConfig->getShopId()."', 'oxdefaultadmin', '1651', '5', '$sDate', 'oxarticle')";
        $oDB->Execute( $sInsert );
    }

    /**
     * Tear down the fixture.
     *
     * @return null
     */
    protected function tearDown()
    {
        $oDB = oxDb::getDb();
        $myConfig = oxConfig::getInstance();
        $sInsert = "DELETE from `oxratings` where OXID='test'";
        $oDB->Execute( $sInsert );

        parent::tearDown();
    }

    public function testInsert()
    {
        // cleanup before test ..
        oxDb::getDb()->execute( "delete from oxratings where oxid='test'" );

        $sTime = time();
        oxTestModules::addFunction( "oxUtilsDate", "getTime", "{return '$sTime';}" );

        $oRating = new oxrating();
        $oRating->setId( 'test' );
        $oRating->oxratings__oxshopid = new oxfield( oxConfig::getInstance()->getShopId() );
        $oRating->save();

        $oRating = new oxrating();
        $oRating->load( 'test' );
        $this->assertEquals( date( 'Y-m-d H:i:s', $sTime ), $oRating->oxratings__oxtimestamp->value );

    }

    public function testAllowRating()
    {
        $oRating = oxNew( 'oxrating' );
        modConfig::getInstance()->setConfigParam( 'iRatingLogsTimeout', 0);

        $this->assertFalse( $oRating->allowRating( 'oxdefaultadmin', 'oxarticle', '1651'));
        $this->assertTrue( $oRating->allowRating( 'test', 'oxarticle', '1651'));
    }

    public function testAllowRatingIfTimeout()
    {
        $oRating = oxNew( 'oxrating' );
        modConfig::getInstance()->setConfigParam( 'iRatingLogsTimeout', 1);
        $this->assertTrue( $oRating->allowRating( 'oxdefaultadmin', 'oxarticle', '1651'));
    }

}
