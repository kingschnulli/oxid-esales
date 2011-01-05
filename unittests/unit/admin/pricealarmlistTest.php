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
 * @version   SVN: $Id: pricealarmlistTest.php 26682 2010-03-19 15:36:24Z arvydas $
 */

require_once realpath( "." ).'/unit/OxidTestCase.php';
require_once realpath( "." ).'/unit/test_config.inc.php';

/**
 * Tests for PriceAlarm_List class
 */
class Unit_Admin_PriceAlarmListTest extends OxidTestCase
{
    /**
     * PriceAlarm_List::BuildSelectString() test case
     *
     * @return null
     */
    public function testBuildSelectString()
    {
        $sSql  = "select oxpricealarm.*, oxarticles.oxtitle AS articletitle, ";
        $sSql .= "oxuser.oxlname as userlname, oxuser.oxfname as userfname ";
        $sSql .= "from oxpricealarm ";
        $sSql .= "left join oxarticles on oxarticles.oxid = oxpricealarm.oxartid ";
        $sSql .= "left join oxuser on oxuser.oxid = oxpricealarm.oxuserid WHERE 1 ";

        // testing..
        $oView = new PriceAlarm_List();
        $this->assertEquals( $sSql, $oView->UNITbuildSelectString( new oxStdClass() ) );
    }

    /**
     * PriceAlarm_List::Render() test case
     *
     * @return null
     */
    public function testRender()
    {

        $oItem1 = new oxStdClass();
        $oItem1->oxpricealarm__oxartid      = new oxField( "1126" );
        $oItem1->oxpricealarm__oxcurrency   = new oxField( "NOCURR" );
        $oItem1->articletitle               = new oxField( "notitle" );
        $oItem1->oxpricealarm__oxprice      = new oxField( 999999 );
        $oItem1->oxpricealarm__oxsended     = new oxField( "1" );

        $oItem2 = new oxStdClass();
        $oItem2->oxpricealarm__oxartid      = new oxField( oxDb::getDb()->getOne( "select oxid from oxarticles where oxparentid !=''" ) );
        $oItem2->oxpricealarm__oxcurrency   = new oxField( "NOCURR" );
        $oItem2->articletitle               = new oxField( "notitle" );
        $oItem2->oxpricealarm__oxprice      = new oxField( 999999 );
        $oItem2->oxpricealarm__oxsended     = new oxField( "1" );

        // testing..
        $oView = $this->getProxyClass( "PriceAlarm_List" );
        $oView->setNonPublicVar( "_aViewData", array( "mylist" => array() ) );
        $oView->addTplParam( "mylist", array( $oItem1, $oItem2 ) );
        $this->assertEquals( 'pricealarm_list.tpl', $oView->render() );

        $aViewData = $oView->getViewData();
        $this->assertTrue( isset( $aViewData["mylist"] ) );
    }

    /**
     * PriceAlarm_List::BuildWhere() test case
     *
     * @return null
     */
    public function testBuildWhere()
    {
        modConfig::setParameter( 'where', array( "oxpricealarm.oxprice" => 15, "oxarticles.oxprice" => 15 ) );

        $aWhere['oxpricealarm.oxprice'] = '%15%';
        $aWhere['oxarticles.oxprice'] = '%15%';


        // testing..
        $oView = $this->getMock( "PriceAlarm_List", array( "_authorize" ) );
        $oView->expects( $this->any() )->method( '_authorize' )->will( $this->returnValue( true ) );
        $oView->init();
        $this->assertEquals( $aWhere, $oView->buildWhere() );
    }
}
