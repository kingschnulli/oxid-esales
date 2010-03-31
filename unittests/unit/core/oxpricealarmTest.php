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
 * @version   SVN: $Id: oxpricealarmTest.php 26841 2010-03-25 13:58:15Z arvydas $
 */

require_once realpath( "." ).'/unit/OxidTestCase.php';
require_once realpath( "." ).'/unit/test_config.inc.php';

class Unit_Core_oxpricealarmTest extends OxidTestCase
{
    /**
     * Tear down the fixture.
     *
     * @return null
     */
    protected function tearDown()
    {
        $oAlarm = new oxpricealarm();
        $oAlarm->delete( 'testalarm' );

        parent::tearDown();
    }

    public function testInsert()
    {
        oxAddClassModule( 'modOxUtilsDate', 'oxUtilsDate' );
        oxUtilsDate::getInstance()->UNITSetTime( 100 );

        $oAlarm = new oxpricealarm();
        $oAlarm->setId( 'testalarm' );
        $oAlarm->save();

        $oAlarm = new oxpricealarm();
        $oAlarm->load( 'testalarm' );
        $this->assertEquals( '1970-01-01 00:00:00', $oAlarm->oxpricealarm__oxinsert->value );
    }
}
