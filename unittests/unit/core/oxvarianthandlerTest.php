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
 * @version   SVN: $Id: oxvarianthandlerTest.php 26841 2010-03-25 13:58:15Z arvydas $
 */

require_once realpath( "." ).'/unit/OxidTestCase.php';
require_once realpath( "." ).'/unit/test_config.inc.php';

class Unit_Core_oxvarianthandlerTest extends OxidTestCase
{
    /**
     * Tear down the fixture.
     *
     * @return null
     */
    protected function tearDown()
    {
        $myDB = oxDb::getDB();

        $sQ = 'delete from oxselectlist where oxid = "_testSell" ';
        $myDB->Execute( $sQ );
        $sQ = 'delete from oxattribute where oxtitle = "_testAttr" ';
        $myDB->Execute( $sQ );
        $sQ = 'delete from oxarticles where oxparentid = "2000" ';
        $myDB->Execute( $sQ );
        $sQ = 'delete from oxobject2attribute where oxobjectid like "_testVar%" ';
        $myDB->Execute( $sQ );
        $this->cleanUpTable('oxarticles');

        parent::tearDown();
    }

    /**
     * oxVariantHandler::init() test case
     *
     * @return null
     */
    public function testInit()
    {
        $oHandler = $this->getProxyClass( "oxVariantHandler" );
        $this->assertNull( $oHandler->getNonPublicVar( "_oArticles" ) );
        $oHandler->init( "testData" );
        $this->assertEquals( "testData", $oHandler->getNonPublicVar( "_oArticles" ) );
    }

    public function testGetValuePrice()
    {
        oxConfig::getInstance()->setConfigParam( 'bl_perfUseSelectlistPrice', 1 );
        oxConfig::getInstance()->setConfigParam( 'bl_perfLoadSelectLists', 1 );
        $oValue = new oxStdClass();
        $oValue->price = '10';
        $oValue->fprice = '10,00';
        $oValue->priceUnit = 'abs';
        $oValue->name = 'red';
        $oValue->value = '';

        $oVariantHandler = oxNew("oxVariantHandler");
        $this->assertEquals( 10, $oVariantHandler->UNITgetValuePrice( $oValue, 10 ));
        $oValue->priceUnit = '%';
        $this->assertEquals( 1, $oVariantHandler->UNITgetValuePrice( $oValue, 10 ));

        $oValue = new oxStdClass();
        $oValue->price  = -10;
        $oValue->fprice = '10,00';
        $oValue->priceUnit = '%';
        $oValue->name  = 'red';
        $oValue->value = '';
        $this->assertEquals( -1, $oVariantHandler->UNITgetValuePrice( $oValue, 10 ) );
    }

    public function testAssignValues()
    {
        $myDB = oxDb::getDB();
        $oValue = new oxStdClass();
        $oValue->price = '10';
        $oValue->fprice = '10,00';
        $oValue->priceUnit = 'abs';
        $oValue->name = 'red';
        $oValue->value = '';
        $aValues[0] = $oValue;
        $oValue2 = new oxStdClass();
        $oValue2->price = '10';
        $oValue2->fprice = '10,00';
        $oValue2->priceUnit = 'abs';
        $oValue2->name = 'rot';
        $oValue2->value = '';
        $aValues[1] = $oValue2;
        $aValues = array($aValues);

        $oArticle = oxNew("oxarticle");
        $oArticle->load('2000');

        $oVariantHandler = oxNew("oxVariantHandler");
        $aVar = $oVariantHandler->UNITassignValues( $aValues, oxNew( 'oxarticlelist' ), $oArticle, array('en', 'de') );
        $oRez = $myDB->Execute( "select oxvarselect, oxvarselect_1 from oxarticles where oxparentid = '2000'" );
        while (!$oRez->EOF) {
            $oRez->fields = array_change_key_case($oRez->fields, CASE_LOWER);
            $this->assertEquals( 'red', $oRez->fields[0]);
            $this->assertEquals( 'rot', $oRez->fields[1]);
            $oRez->moveNext();
        }
    }

    public function testGenVariantFromSell()
    {
        oxConfig::getInstance()->setConfigParam( 'blUseMultidimensionVariants', 1 );
        $myDB     = oxDb::getDB();
        $sVal = 'red!P!10__@@blue!P!10__@@black!P!10__@@';

            $sQ = 'insert into oxselectlist (oxid, oxshopid, oxtitle, oxident, oxvaldesc) values ("_testSell", "oxbaseshop", "oxsellisttest", "oxsellisttest", "'.$sVal.'")';
        $myDB->Execute( $sQ );
        $oArticle = oxNew("oxarticle");
        $oArticle->load('2000');
        $oVariantHandler = oxNew("oxVariantHandler");
        $oVariantHandler->genVariantFromSell(array('_testSell'), $oArticle );
        $this->assertEquals( 3, $myDB->getOne( "select count(*) from oxarticles where oxparentid = '2000'" ));
        //twice
        $oVariantHandler->genVariantFromSell(array('_testSell'), $oArticle );
        $this->assertEquals( 9, $myDB->getOne( "select count(*) from oxarticles where oxparentid = '2000'" ));
        $this->assertTrue( (bool) strpos($myDB->getOne( "select oxvarselect from oxarticles where oxparentid = '2000' limit 1" ), "|"));
        $this->assertEquals( 18, $myDB->getOne( "select count(*) from oxobject2attribute where oxobjectid in ( select art.oxid from oxarticles as art where art.oxparentid = '2000')" ));
    }

    /**
     * test for bug#1447
     *
     */
    public function testGenVariantFromSellOxVarCountUpdated()
    {
        oxConfig::getInstance()->setConfigParam( 'blUseMultidimensionVariants', 1 );
        $myDB     = oxDb::getDB();
        $sVal = 'red!P!10__@@blue!P!10__@@black!P!10__@@';

            $sQ = 'insert into oxselectlist (oxid, oxshopid, oxtitle, oxident, oxvaldesc) values ("_testSell", "oxbaseshop", "oxsellisttest", "oxsellisttest", "'.$sVal.'")';
        $myDB->Execute( $sQ );
        $oArticle = oxNew("oxarticle");
        $oArticle->load('2000');
        $oVariantHandler = oxNew("oxVariantHandler");
        $oVariantHandler->genVariantFromSell(array('_testSell'), $oArticle );

        $oArticle2 = oxNew("oxarticle");
        $oArticle2->load('2000');
        $this->assertEquals(3, $oArticle->oxarticles__oxvarcount->value);

        /**
        $this->assertEquals( 3, $myDB->getOne( "select count(*) from oxarticles where oxparentid = '2000'" ));
        //twice
        $oVariantHandler->genVariantFromSell(array('_testSell'), $oArticle );
        $this->assertEquals( 9, $myDB->getOne( "select count(*) from oxarticles where oxparentid = '2000'" ));
        $this->assertTrue( (bool) strpos($myDB->getOne( "select oxvarselect from oxarticles where oxparentid = '2000' limit 1" ), "|"));
        $this->assertEquals( 18, $myDB->getOne( "select count(*) from oxobject2attribute where oxobjectid in ( select art.oxid from oxarticles as art where art.oxparentid = '2000')" ));
        */
    }

    public function testCreateNewVariant()
    {
        $aParams = array('oxarticles__oxvarselect'   => "_testVar",
                         'oxarticles__oxartnum'      => "123",
                         'oxarticles__oxprice'       => "10",
                         'oxarticles__oxvarselect_1' => "_testVar_1",
                         'oxarticles__oxid'          => "_testVar"
                         );
        $oVariantHandler = oxNew("oxVariantHandler");
        $sVariantId = $oVariantHandler->UNITcraeteNewVariant( $aParams, "_testArt" );
        $oVariant = oxNew("oxarticle");
        $oVariant->load($sVariantId);
        $this->assertEquals( "_testVar", $sVariantId);
        $this->assertEquals( "_testVar", $oVariant->oxarticles__oxvarselect->value);
        $this->assertEquals( "_testVar_1", $oVariant->oxarticles__oxvarselect_1->value);
        $this->assertEquals( "_testArt", $oVariant->oxarticles__oxparentid->value);
        $this->assertEquals( "123", $oVariant->oxarticles__oxartnum->value);
        $this->assertEquals( "10", $oVariant->oxarticles__oxprice->value);
    }

    /**
     * oxVariantHandler::isMdVariant() test case
     *
     * @return null
     */
    public function testIsMdVariant()
    {
        modConfig::getInstance()->setConfigParam( "blUseMultidimensionVariants", true );

        $oArticle = new oxStdClass();
        $oArticle->oxarticles__oxvarselect = new oxField( " value | value ");

        $oVariantHandler = oxNew("oxVariantHandler");
        $this->assertTrue( $oVariantHandler->isMdVariant( $oArticle ) );
    }

    /**
     * oxVariantHandler::buildMdVariants() test case
     *
     * @return null
     */
    public function testBuildMdVariants()
    {
        $oPrice = $this->getMock( "oxPrice", array( "getBruttoPrice" ) );
        $oPrice->expects( $this->exactly( 2 ) )->method( 'getBruttoPrice' )->will( $this->returnValue( 999 ) );

        $oVar1 = $this->getMock( "oxArticle", array( "getPrice", "getLink" ) );
        $oVar1->expects( $this->once() )->method( 'getPrice' )->will( $this->returnValue( $oPrice ) );
        $oVar1->expects( $this->once() )->method( 'getLink' )->will( $this->returnValue( "testLink" ) );
        $oVar1->oxarticles__oxvarselect = new oxField( "var1value1 | var1value2 | var1value3" );

        $oVar2 = $this->getMock( "oxArticle", array( "getPrice", "getLink" ) );
        $oVar2->expects( $this->once() )->method( 'getPrice' )->will( $this->returnValue( $oPrice ) );
        $oVar2->expects( $this->once() )->method( 'getLink' )->will( $this->returnValue( "testLink" ) );
        $oVar2->oxarticles__oxvarselect = new oxField( "var2value1 | var2value2 | var2value3" );

        $oVariants = new oxList();
        $oVariants->offsetSet( "var1", $oVar1 );
        $oVariants->offsetSet( "var2", $oVar2 );

        $oVariantHandler = oxNew("oxVariantHandler");
        $oVariantHandler->buildMdVariants( $oVariants, "testParentId" );
    }
}