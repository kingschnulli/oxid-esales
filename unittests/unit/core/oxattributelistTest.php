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
 * @version   SVN: $Id: oxattributelistTest.php 44373 2012-04-25 13:19:39Z linas.kukulskis $
 */

require_once realpath( "." ).'/unit/OxidTestCase.php';
require_once realpath( "." ).'/unit/test_config.inc.php';

/**
 * testing oxattributelist class.
 */
class Unit_Core_oxattributelistTest extends OxidTestCase
{
    /**
     * Tear down the fixture.
     *
     * @return null
     */
    protected function tearDown()
    {
        $myDB = oxDb::getDB();

        $myDB->Execute( 'delete from oxattribute where oxid = "test%" ');
        $myDB->Execute( 'delete from oxobject2attribute where oxid = "test%" ');

        parent::tearDown();
    }

    /**
     * Test load attributes by ids.
     *
     * @return null
     */
    public function testLoadAttributesByIds()
    {
        $oAttrList = new oxAttributelist();
        $aAttributes = $oAttrList->loadAttributesByIds( array('1672'));

        $sSelect = "select oxattrid, oxvalue from oxobject2attribute where oxobjectid = '1672'";
        $rs = oxDb::getDB()->execute($sSelect);
        $sSelect = "select oxtitle from oxattribute where oxid = '".$rs->fields[0]."'";
        $sTitle = oxDb::getDB()->getOne($sSelect);
        $this->assertEquals( $rs->fields[1], $aAttributes[$rs->fields[0]]->aProd['1672']->value);
        $this->assertEquals( $sTitle, $aAttributes[$rs->fields[0]]->title);
    }

    /**
     * Test load attributes by ids in other language.
     *
     * @return null
     */
    public function testLoadAttributesByIdsInOtherLang()
    {
        oxLang::getInstance()->setBaseLanguage(1);
        $oAttrList = new oxAttributelist();
        $aAttributes = $oAttrList->loadAttributesByIds( array('1672'));

        $sSelect = "select oxattrid, oxvalue_1 from oxobject2attribute where oxobjectid = '1672'";
        $rs = oxDb::getDB()->execute($sSelect);
        $sSelect = "select oxtitle_1 from oxattribute where oxid = '".$rs->fields[0]."'";
        $sTitle = oxDb::getDB()->getOne($sSelect);
        $this->assertEquals( $rs->fields[1], $aAttributes[$rs->fields[0]]->aProd['1672']->value);
        $this->assertEquals( $sTitle, $aAttributes[$rs->fields[0]]->title);
    }

    /**
     * Test load attributes by ids with empty array.
     *
     * @return null
     */
    public function testLoadAttributesByIdsNoIds()
    {
        $oAttrList = new oxAttributelist();
        $aAttributes = $oAttrList->loadAttributesByIds( null);

        $this->assertNull( $aAttributes);
    }

    /**
     * Test load attributes.
     *
     * @return null
     */
    public function testLoadAttributes()
    {
        $oAttrList = new oxAttributelist();
        $oAttrList->loadAttributes('1672');
        $sSelect = "select oxattrid from oxobject2attribute where oxobjectid = '$sArtID'";
        $sID = oxDb::getDB()->getOne($sSelect);
        $sSelect = "select oxvalue from oxobject2attribute where oxattrid = '$sID' and oxobjectid = '$sArtID'";
        $sExpectedValue = oxDb::getDB()->getOne($sSelect);
        $sAttribValue = $oAttrList[$sID]->oxobject2attribute__oxvalue->value;
        $this->assertEquals( $sExpectedValue, $sAttribValue);
    }

    /**
     * Test load attributes in other language.
     *
     * @return null
     */
    public function testLoadAttributesInOtherLang()
    {
        oxLang::getInstance()->setBaseLanguage(1);
        $oAttrList = new oxAttributelist();
        $oAttrList->loadAttributes('1672');
        $sSelect = "select oxattrid from oxobject2attribute where oxobjectid = '$sArtID'";
        $sID = oxDb::getDB()->getOne($sSelect);
        $sSelect = "select oxvalue_1 from oxobject2attribute where oxattrid = '$sID' and oxobjectid = '$sArtID'";
        $sExpectedValue = oxDb::getDB()->getOne($sSelect);
        $sAttribValue = $oAttrList[$sID]->oxobject2attribute__oxvalue->value;
        $this->assertEquals( $sExpectedValue, $sAttribValue);
    }

    /**
     * Test load attributes with sorting.
     *
     * @return null
     */
    public function testLoadAttributesWithSort()
    {
        oxLang::getInstance()->setBaseLanguage(0);
        $sSelect = "insert into oxattribute (oxid, oxshopid, oxshopincl, oxshopexcl, oxtitle, oxpos ) values ('test3', '1', '1', '0', 'test3', '3'), ('test1', '1', '1', '0', 'test1', '1'), ('test2', '1', '1', '0', 'test2', '2')";
            $sSelect = "insert into oxattribute (oxid, oxshopid, oxtitle, oxpos ) values ('test3', 'oxbaseshop', 'test3', '3'), ('test1', 'oxbaseshop', 'test1', '1'), ('test2', 'oxbaseshop', 'test2', '2')";
        $rs = oxDb::getDB()->execute($sSelect);
        $sArtId = 'testArt';
        $sSelect = "insert into oxobject2attribute (oxid, oxobjectid, oxattrid, oxvalue ) values ('test3', '$sArtId', 'test3', '3'), ('test1', '$sArtId', 'test1', '1'), ('test2', '$sArtId', 'test2', '2')";
        $rs = oxDb::getDB()->execute($sSelect);

        $oAttrList = new oxAttributelist();
        $oAttrList->loadAttributes($sArtId);
        $iCnt = 1;
        foreach ( $oAttrList as $sId => $aAttr ) {
            $this->assertEquals( 'test'.$iCnt, $sId);
            $this->assertEquals( (string)$iCnt, $aAttr->oxattribute__oxvalue->value);
            $iCnt++;
        }
    }

    /**
     * Test load attributes with empty article id.
     *
     * @return null
     */
    public function testLoadAttributesEmptyId()
    {
        $oAttrList = new oxAttributelist();
        $oAttrList->loadAttributes( null);

        $this->assertEquals( 0, count($oAttrList));
    }

    public function testGetCategoryAttributes()
    {
        $sCategoryId = '8a142c3e60a535f16.78077188';
        $sAttributeId = '8a142c3e9cd961518.80299776';

        $myDB = oxDb::getDb();
        $myDB->Execute('insert into oxcategory2attribute (oxid, oxobjectid, oxattrid, oxsort) values ("test3","'.$sCategoryId.'","'.$sAttributeId.'", "333")');


        $oAttrList = oxNew( "oxattributelist" );
        $oAttrList->getCategoryAttributes( $sCategoryId, 1);
        $oAttribute = $oAttrList->offsetGet($sAttributeId);


            $this->assertEquals( 1, $oAttrList->count() );
            $this->assertEquals( 6, count($oAttribute->getValues()));

    }

}
