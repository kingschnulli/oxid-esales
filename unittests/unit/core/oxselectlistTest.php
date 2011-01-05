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
 * @version   SVN: $Id: oxselectlistTest.php 27601 2010-05-06 12:53:09Z vilma $
 */

require_once realpath( "." ).'/unit/OxidTestCase.php';
require_once realpath( "." ).'/unit/test_config.inc.php';

/**
 * Testing oxselectlist class
 */
class Unit_Core_oxselectlistTest extends OxidTestCase
{
    /**
     * Initialize the fixture add some users.
     *
     * @return null
     */
    protected function setUp()
    {
        parent::setUp();
        $myDB     = oxDb::getDB();
        $myConfig = oxConfig::getInstance();

        $sShopId = $myConfig->getBaseShopId();
        $sVal = '&amp;&test1, 10!P!10__@@test2, 10!P!10__@@test3, 10!P!10__@@';

            $sQ = 'insert into oxselectlist (oxid, oxshopid, oxtitle, oxident, oxvaldesc) values ("oxsellisttest", "'.$sShopId.'", "oxsellisttest", "oxsellisttest", "'.$sVal.'")';
        $myDB->Execute( $sQ );

        $sQ = 'insert into oxobject2selectlist values ("oxsellisttest", "oxsellisttest", "oxsellisttest", 1) ';
        $myDB->Execute( $sQ );
    }

    /**
     * Tear down the fixture.
     *
     * @return null
     */
    protected function tearDown()
    {
        $myDB = oxDb::getDB();

        $sQ = 'delete from oxselectlist where oxid = "oxsellisttest" ';
        $myDB->Execute( $sQ );

        $sQ = 'delete from oxobject2selectlist where oxselnid = "oxsellisttest" ';
        $myDB->Execute( $sQ );

        parent::tearDown();
    }

    /**
     * Checking deletion and assign
     */
    public function testDelete()
    {
        $myDB = oxDb::getDB();

        $oSelList = new oxselectlist();
        $oSelList->load( 'oxsellisttest' );
        $oSelList->delete();

        $sQ = 'select count(*) from oxselectlist where oxid = "oxsellisttest" ';
        if ( $myDB->getOne( $sQ ) )
            $this->fail( 'records from oxselectlist are not deleted' );

        $sQ = 'select count(*) from oxobject2selectlist where oxselnid = "oxsellisttest" ';
        if ( $myDB->getOne( $sQ ) )
            $this->fail( 'records from oxobject2selectlist are not deleted' );
    }

    public function testGetFieldList()
    {
        $aSelList[0] = new Oxstdclass();
        $aSelList[0]->name  = '&amp;amp;&amp;test1, 10';
        $aSelList[0]->value = null;

        $aSelList[1] = new Oxstdclass();
        $aSelList[1]->name  = 'test2, 10';
        $aSelList[1]->value = null;

        $aSelList[2] = new Oxstdclass();
        $aSelList[2]->name  = 'test3, 10';
        $aSelList[2]->value = null;

        $oSelList = new oxselectlist();
        $oSelList->Load( 'oxsellisttest' );

        // checking loaded data
        $this->assertEquals( $aSelList, $oSelList->getFieldList() );
    }

    public function testAssignWithOtherLang()
    {
        $oSelectList = new oxselectlist();
        $oSelectList->setLanguage( 1 );
        $oSelectList->load( 'oxsellisttest' );

        $aParams['oxtitle']   = 'Test_selectlist';
        $aParams['oxvaldesc'] = 'Test_1';

        $oSelectList->assign( $aParams );
        $oSelectList->save();

        $this->assertEquals( $oSelectList->oxselectlist__oxvaldesc->value, 'Test_1' );
        $this->assertEquals( $oSelectList->oxselectlist__oxtitle->value, 'Test_selectlist' );
    }

    public function testDeleteNotExistingSelect()
    {
        $oSelectList = new oxselectlist();
        $this->assertFalse( $oSelectList->delete( "111111" ) );
    }

    /*
     * Check if getFieldList() stips tags from currency name
     */
    public function testGetFieldListStripsTagsFromCurrency()
    {
        modConfig::getInstance()->setParameter( 'cur', 2 );
        modConfig::getInstance()->setConfigParam( 'bl_perfLoadSelectLists', 1 );
        modConfig::getInstance()->setConfigParam( 'bl_perfUseSelectlistPrice', 1 );

        $oSelList = new oxselectlist();
        $oSelList->load( 'oxsellisttest' );
        $aSelList = $oSelList->getFieldList();

        // checking loaded data
        $this->assertEquals( "&amp;amp;&amp;test1, 10 +14,33 CHF", $aSelList[0]->name );
        $this->assertEquals( "test2, 10 +14,33 CHF", $aSelList[1]->name );
        $this->assertEquals( "test3, 10 +14,33 CHF", $aSelList[2]->name );
    }

}
