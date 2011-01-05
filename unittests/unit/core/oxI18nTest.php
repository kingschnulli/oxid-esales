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
 * @version   SVN: $Id: oxI18nTest.php 26841 2010-03-25 13:58:15Z arvydas $
 */

require_once realpath( "." ).'/unit/OxidTestCase.php';
require_once realpath( "." ).'/unit/test_config.inc.php';

//require_once 'oxbaseTest.php';

class _oxI18n extends oxI18n
{

    public function getClassVar($sName)
    {
        return $this->$sName;
    }

    public function setClassVar($sName, $sVal)
    {
        return $this->$sName = $sVal;
    }

    public function enableLazyLoading()
    {
        $this->_blUseLazyLoading = true;
    }

}

class Unit_Core_oxi18ntest extends OxidTestCase
{

    protected  function setUp()
    {
        parent::setUp();
    }

    /**
     * Tear down the fixture.
     *
     * @return null
     */
    protected function tearDown()
    {
        if ( $this->getName() == 'testUpdateAndSeoIsOn' ) {
            $oDB = oxDb::getDb();
            $oDB->execute( "delete from oxseo where oxtype != 'static'" );
            $oDB->execute( "delete from oxarticles where oxid='testa'" );
            $oDB->execute( "delete from oxartextends where oxid='testa'" );
        }
        parent::tearDown();
    }

    public function testUpdateAndSeoIsOn()
    {
        oxTestModules::addFunction("oxutils", "seoIsActive", "{return true;}");

        $oArticle = new oxarticle();
        $oArticle->setId( 'testa' );
        $oArticle->save();
        $oArticle->getLink();

        $oArticle = new oxArticle();
        $oArticle->setAdminMode( true );
        $oArticle->load( 'testa' );
        $oArticle->save();

        $this->assertTrue( '1' == oxDb::getDb()->getOne( 'select oxexpired from oxseo where oxobjectid = "testa"' ) );
    }

    public function testSetLanguage()
    {
        $oObj = new _oxI18n();
        $oObj->setLanguage( 0 ); // defaults to 0 in demodata
        $this->assertEquals( 0, $oObj->getClassVar("_iLanguage"));
        $oObj->setLanguage( 1 );
        $this->assertEquals( 1, $oObj->getClassVar("_iLanguage"));
    }

    public function testSetEnableMultilang()
    {
        $oObj = new _oxI18n();
        $oObj->setEnableMultilang(false);
        $this->assertFalse($oObj->getClassVar("_blEmployMultilanguage"));
        $oObj->setEnableMultilang(true);
        $this->assertTrue($oObj->getClassVar("_blEmployMultilanguage"));
    }

    public function testSetEnableMultiLangReloadsAFieldNames()
    {
        $oi18 = new _oxI18n();
        $oi18->init("oxartextends");
        $this->assertEquals(array('oxid'=>0, 'oxlongdesc'=>1, 'oxtags'=>1), $oi18->getClassVar('_aFieldNames'));

        $oi18 = new _oxI18n();
        $oi18->init("oxartextends");
        $oi18->setEnableMultilang(false);
        $this->assertEquals(array('oxid'=>0, 'oxlongdesc'=>0, 'oxlongdesc_1'=>0, 'oxlongdesc_2'=>0, 'oxlongdesc_3'=>0, 'oxtags'=>0, 'oxtags_1'=>0, 'oxtags_2'=>0, 'oxtags_3'=>0), $oi18->getClassVar('_aFieldNames'));
    }

    public function testSetEnableMultilanguageCacheTest()
    {
        $oI18n = $this->getMock( 'oxI18n', array('modifyCacheKey' ));
        $oI18n->expects( $this->once() )->method( 'modifyCacheKey')->with("_nonml");
        $oI18n->setEnableMultilang(false);
    }

    public function testIsMultilingualField()
    {
        $oObj = new _oxI18n();
        $oObj->init("oxarticles");

        $this->assertTrue($oObj->IsMultilingualField( 'oxtitle'));
        $this->assertTrue($oObj->IsMultilingualField( 'oxvarselect'));
        $this->assertFalse($oObj->IsMultilingualField( 'oxid'));
        $this->assertFalse($oObj->IsMultilingualField( 'non existing'));
        $this->assertFalse($oObj->IsMultilingualField( 'oxtime'));
    }

    public function testIsMultilingualFieldLazyLoad()
    {
        $this->cleanTmpDir();
        $oObj = new _oxI18n();
        $oObj->enableLazyLoading();
        $oObj->init("oxarticles");

        $this->assertTrue($oObj->IsMultilingualField( 'oxtitle'));
    }

    public function testLoadInLang0()
    {
        $oObj = new _oxI18n();
        $oObj->init("oxarticles");
        $oObj->loadInLang(0, 1127);

        $this->assertEquals("Blinkende Eiswürfel FLASH", $oObj->oxarticles__oxtitle->value);
        $this->assertEquals(1127, $oObj->getId());
        $this->assertFalse(isset($oObj->oxarticles__oxtitle_1->value));
    }

    public function testLoadInLang1()
    {
        $oObj = new _oxI18n();
        $oObj->init("oxarticles");
        $oObj->loadInLang(1, 1127);
        $this->assertEquals("Ice Cubes FLASH", $oObj->oxarticles__oxtitle->value);
        $this->assertEquals(1127, $oObj->getId());
        $this->assertFalse(isset($oObj->oxarticles__oxtitle_1->value));
    }

    public function testLoadInLang0DisableMultilang()
    {
        $oObj = new _oxI18n();
        $oObj->setEnableMultilang(false);
        $oObj->init("oxarticles");
        $oObj->loadInLang(0, 1127);
        $this->assertEquals(1127, $oObj->getId());
        $this->assertEquals("Blinkende Eiswürfel FLASH", $oObj->oxarticles__oxtitle->value);
        $this->assertEquals("Ice Cubes FLASH", $oObj->oxarticles__oxtitle_1->value);
    }

    public function testLoadInLang1DisableMultilang()
    {
        $oObj = new _oxI18n();
        $oObj->setEnableMultilang(false);
        $oObj->init("oxarticles");
        $oObj->loadInLang(1, 1127);
        $this->assertEquals("Blinkende Eiswürfel FLASH", $oObj->oxarticles__oxtitle->value);
        $this->assertEquals("Ice Cubes FLASH", $oObj->oxarticles__oxtitle_1->value);
    }


    public function testLazyLoadInLang0()
    {
        $this->cleanTmpDir();
        oxLang::getInstance()->setBaseLanguage( 0 );

        $oBase = new _oxI18n();
        $oBase->enableLazyLoading();
        $oBase->init("oxarticles");
        $oBase->load("2000");
        $this->assertEquals("Wanduhr ROBOT", $oBase->oxarticles__oxtitle->value);
    }

    public function testLazyLoadInLang1()
    {
        $this->cleanTmpDir();
        oxLang::getInstance()->setBaseLanguage( 1 );

        $oBase = new _oxI18n();
        $oBase->enableLazyLoading();
        $oBase->init("oxarticles");
        $oBase->load("2000");
        $this->assertEquals("Wall Clock ROBOT", $oBase->oxarticles__oxtitle->value);
    }

    public function testLoad()
    {
        oxLang::getInstance()->setBaseLanguage( 1 );

        $oObj = new _oxI18n();
        $oObj->init("oxarticles");
        $oObj->load(1127);

        $this->assertEquals("Ice Cubes FLASH", $oObj->oxarticles__oxtitle->value);
    }

    public function testGetAvailableInLangs()
    {
        $aLang = array( 'de' => "Deutsch", 'en' => "English", 'lt' => "Lithuanian", 'zb' => "ZuluBumBum" );
        $aLangParams['de']['baseId'] = 0;
        $aLangParams['de']['abbr'] = 'de';
        $aLangParams['en']['baseId'] = 1;
        $aLangParams['en']['abbr'] = 'en';
        $aLangParams['lt']['baseId'] = 2;
        $aLangParams['lt']['abbr'] = 'lt';
        $aLangParams['zb']['baseId'] = 3;
        $aLangParams['zb']['abbr'] = 'zb';

        modConfig::getInstance()->setConfigParam( 'aLanguageParams', $aLangParams );
        modConfig::getInstance()->setConfigParam( 'aLanguages', $aLang );

        $oObj = new _oxI18n();
        $oObj->init("oxwrapping");
        $oObj->load('a6840cc0ec80b3991.74884864');

        $aRes = $oObj->getAvailableInLangs();
        $this->assertEquals( array(0 => "Deutsch", 1 => "English"), $aRes);
    }

    public function testGetAvailableInLangsWithNotLoadedObject()
    {
        $aLang = array( 0 => "Deutsch", 1 => "English", 2 => "Lithuanian", 3 => "ZuluBumBum" );
        modConfig::getInstance()->setConfigParam( 'aLanguages', $aLang );

        $oObj = new _oxI18n();
        $oObj->init("oxwrapping");

        $aRes = $oObj->getAvailableInLangs();
        $this->assertEquals( array(), $aRes);

        $oObj->setId('noSuchId');
        $aRes = $oObj->getAvailableInLangs();
        $this->assertEquals( array(), $aRes);
    }

    public function testGetAvailableInLangsObjectWithoutMultilangFields()
    {
        $aRezLang = array( 0 => "Deutsch", 1 => "English", 2 => "Lithuanian", 3 => "ZuluBumBum" );
        $aLang = array( 'de' => "Deutsch", 'en' => "English", 'lt' => "Lithuanian", 'zb' => "ZuluBumBum" );
        $aLangParams['de']['baseId'] = 0;
        $aLangParams['de']['abbr'] = 'de';
        $aLangParams['en']['baseId'] = 1;
        $aLangParams['en']['abbr'] = 'en';
        $aLangParams['lt']['baseId'] = 2;
        $aLangParams['lt']['abbr'] = 'lt';
        $aLangParams['zb']['baseId'] = 3;
        $aLangParams['zb']['abbr'] = 'zb';

        modConfig::getInstance()->setConfigParam( 'aLanguageParams', $aLangParams );
        modConfig::getInstance()->setConfigParam( 'aLanguages', $aLang );
        modConfig::getInstance()->setConfigParam( 'aLanguages', $aLang );

        $oObj = new _oxI18n();
        $oObj->init("oxvouchers");

        $aRes = $oObj->getAvailableInLangs();
        $this->assertEquals( $aRezLang, $aRes);
    }

    public function testGetSqlFieldName()
    {
        $oObj = new _oxI18n();
        $oObj->init("oxarticles");
        $oObj->setLanguage(1);
        $this->assertEquals("oxtitle_1", $oObj->getSqlFieldName( 'oxtitle'));
        $oObj->setLanguage(0);
        $this->assertEquals("oxtitle", $oObj->getSqlFieldName( 'oxtitle'));
    }

    public function testGetFieldLang()
    {
        $oObj = new _oxI18n();
        $this->assertEquals("12", $oObj->UNITgetFieldLang( 'oxtitle_12'));
        $this->assertEquals("1", $oObj->UNITgetFieldLang( 'oxtitle_1'));
        $this->assertEquals("0", $oObj->UNITgetFieldLang( 'oxtitle'));
        $this->assertEquals("0", $oObj->UNITgetFieldLang( 'oxtitle_555'));
    }

    public function testAddFieldNormal()
    {
        $oObj = new _oxI18n();
        $oObj->setClassVar("_sCoreTable", "oxtesttable");
        $oObj->UNITaddField('oxtestField', 1);

        $aFieldNames = $oObj->getClassVar("_aFieldNames");

        $this->assertEquals(array("oxid" => 0, "oxtestfield" => 1), $aFieldNames);
        $this->assertTrue(isset($oObj->oxtesttable__oxtestfield));
    }

    public function testAddFieldMulitlanguage()
    {
        $oObj = new _oxI18n();
        $oObj->setClassVar("_sCoreTable", "oxtesttable");
        $oObj->UNITaddField('oxtestField_1', 1);

        $aFieldNames = $oObj->getClassVar("_aFieldNames");

        //Tomas 2008-02-11
        //??? undecided public functionality yet
        //whether it should skip adding multilanguage fields
        $this->assertEquals(array('oxid' => 0, 'oxtestfield_1' => 1), $aFieldNames);
        $this->assertFalse(isset($oObj->oxtesttable__oxtestfield));
        //?? same here
        //$this->assertFalse(isset($oObj->testtable__testfield_1));
        $this->assertTrue(isset($oObj->oxtesttable__oxtestfield_1));
    }

    public function testAddFieldMulitlanguageDisableMultilang()
    {
        $oObj = new _oxI18n();
        $oObj->setClassVar("_sCoreTable", "oxtesttable");
        $oObj->setEnableMultilang(false);
        $oObj->UNITaddField('oxtestField_1', 1);

        $aFieldNames = $oObj->getClassVar("_aFieldNames");

        $this->assertEquals(array('oxid'=>0, 'oxtestfield_1' => 1), $aFieldNames);
        $this->assertFalse(isset($oObj->oxtesttable__oxtestfield));
        $this->assertTrue(isset($oObj->oxtesttable__oxtestfield_1));
    }

    //tests from oxBase public functions, but having different public functionality in oxi18n
    public function testGetUpdateFieldsLang0()
    {
        $oObj = new _oxI18n();
        $oObj->init('oxattribute');
        $oObj->setLanguage(0);


            $sExpRes = "oxid = '',oxshopid = '',oxtitle = '',oxpos = ''";

        $this->assertEquals($sExpRes, $oObj->UNITgetUpdateFields());

    }

    public function testGetSelectFieldsLang0()
    {
        $oObj = new _oxI18n();
        $oObj->init('oxattribute');
        $oObj->setLanguage(0);
        $sTable = $oObj->getViewName();


            $sExpRes = "$sTable.oxid, $sTable.oxshopid, $sTable.oxtitle, $sTable.oxpos";

        $this->assertEquals($sExpRes, $oObj->getSelectFields());
    }

    public function testGetUpdateFieldsLang1()
    {
        $oObj = new _oxI18n();
        $oObj->init('oxattribute');
        $oObj->setLanguage(1);


            $sExpRes = "oxid = '',oxshopid = '',oxtitle_1 = '',oxpos = ''";

        $this->assertEquals($sExpRes, $oObj->UNITgetUpdateFields());
    }

    public function testGetSelectFieldsLang1()
    {
        $oObj = new _oxI18n();
        $oObj->init('oxattribute');
        $oObj->setLanguage(1);
        $sTable = $oObj->getViewName();


            $sExpRes = "$sTable.oxid, $sTable.oxshopid, $sTable.oxtitle_1 as oxtitle, $sTable.oxpos";

        $this->assertEquals($sExpRes, $oObj->getSelectFields());
    }

    public function testGetUpdateFieldsLang1DisableMultilang()
    {
        $oObj = new _oxI18n();
        $oObj->setEnableMultilang(false);
        $oObj->init('oxattribute');
        $oObj->setLanguage(1);


            $sExpRes = "oxid = '',oxshopid = '',oxtitle = '',oxtitle_1 = '',oxtitle_2 = '',oxtitle_3 = '',oxpos = ''";

        $this->assertEquals($sExpRes, $oObj->UNITgetUpdateFields());
    }

    public function testGetSelectFieldsLang1DisableMultilang()
    {
        $oObj = new _oxI18n();
        $oObj->setEnableMultilang(false);
        $oObj->init('oxattribute');
        $oObj->setLanguage(1);
        $sTable = $oObj->getViewName();


            $sExpRes = "$sTable.oxid, $sTable.oxshopid, $sTable.oxtitle, $sTable.oxtitle_1, $sTable.oxtitle_2, $sTable.oxtitle_3, $sTable.oxpos";

        $this->assertEquals($sExpRes, $oObj->getSelectFields());
    }

    public function testGetSqlActiveSnippetForceCoreActiveMultilang()
    {
        $iCurrTime = time();
        oxTestModules::addFunction( "oxUtilsDate", "getTime", "{ return $iCurrTime; }");

        $oI18n = $this->getMock( 'oxI18n', array( 'getCoreTableName', 'getViewName', 'isMultilingualField', 'getLanguage' ) );
        $oI18n->expects( $this->once() )->method( 'getCoreTableName')->will( $this->returnValue( 'oxi18n' ) );
        $oI18n->expects( $this->never() )->method( 'getViewName');
        $oI18n->expects( $this->once() )->method( 'isMultilingualField')->will( $this->returnValue( true ) );
        $oI18n->expects( $this->once() )->method( 'getLanguage')->will( $this->returnValue( 1 ) );

        $oI18n->UNITaddField( 'oxactive', 0 );
        $oI18n->UNITaddField( 'oxactivefrom', 0 );
        $oI18n->UNITaddField( 'oxactiveto', 0 );


        $sDate  = date( 'Y-m-d H:i:s', $iCurrTime );
        $sTable = 'oxi18n';
        $sTemplate = "(   $sTable.oxactive_1 = 1  or  ( $sTable.oxactivefrom < '$sDate' and $sTable.oxactiveto > '$sDate' ) ) ";

        $sQ = $oI18n->getSqlActiveSnippet();
        $this->assertEquals( $sTemplate, $sQ );
    }

    public function testGetSqlActiveSnippet()
    {
        $iCurrTime = time();
        oxTestModules::addFunction( "oxUtilsDate", "getTime", "{ return $iCurrTime; }");

        $oI18n = $this->getMock( 'oxI18n', array( 'getCoreTableName', 'getViewName', 'isMultilingualField', 'getLanguage' ) );
            $oI18n->expects( $this->once() )->method( 'getCoreTableName')->will( $this->returnValue( 'oxi18n' ) );
            $oI18n->expects( $this->never() )->method( 'getViewName')->will( $this->returnValue( 'oxi18n' ) );
        $oI18n->expects( $this->once() )->method( 'isMultilingualField')->will( $this->returnValue( false ) );
        $oI18n->expects( $this->never() )->method( 'getLanguage');

        $oI18n->UNITaddField( 'oxactive', 0 );
        $oI18n->UNITaddField( 'oxactivefrom', 0 );
        $oI18n->UNITaddField( 'oxactiveto', 0 );


        $sDate  = date( 'Y-m-d H:i:s', $iCurrTime );
        $sTable = 'oxi18n';
        $sTemplate = "(   $sTable.oxactive = 1  or  ( $sTable.oxactivefrom < '$sDate' and $sTable.oxactiveto > '$sDate' ) ) ";

        $sQ = $oI18n->getSqlActiveSnippet();
        $this->assertEquals( $sTemplate, $sQ );
    }

    public function testAssignLang0()
    {
        $oObj = new _oxI18n();
        $oObj->init('oxattribute');
        $oObj->setLanguage(0);
        $oObj->assign(array("oxtitle" => "TestVal0", "oxtitle_1" => "TestVal1"));
        $this->assertEquals("TestVal0", $oObj->oxattribute__oxtitle->value);
        //$this->assertFalse(isset($oObj->oxattribute__oxtitle_1->value));
    }

    public function testAssignLang1()
    {
        $oObj = new _oxI18n();
        $oObj->init('oxattribute');
        $oObj->setLanguage(1);
        $oObj->assign(array("oxtitle" => "TestVal0", "oxtitle_1" => "TestVal1"));
        $this->assertEquals("TestVal1", $oObj->oxattribute__oxtitle->value);
        //$this->assertFalse(isset($oObj->oxattribute__oxtitle_1->value));
    }

    /*
     * Testing if object is treated as multilanguage
     */
    public function testIsMultilang()
    {
        $oObj = new oxi18n();
        $this->assertTrue( $oObj->isMultilang() );
    }

    /*
     * Testing cache hay modifier
     */
    public function testModifyCacheKey()
    {
        $oObj = $this->getProxyClass( 'oxi18n' );
        $oObj->modifyCacheKey( null );
        $this->assertNull( $oObj->getNonPublicVar("_sCacheKey") );
        $oObj->modifyCacheKey("_nonml" );
        $this->assertEquals( "_nonml", $oObj->getNonPublicVar("_sCacheKey") );
        $oObj->modifyCacheKey("_nonml" );
        $this->assertEquals( "_nonml_nonml", $oObj->getNonPublicVar("_sCacheKey") );
        $oObj->modifyCacheKey("_nonml", true );
        $this->assertEquals( "_nonml|i18n", $oObj->getNonPublicVar("_sCacheKey") );
    }

}
