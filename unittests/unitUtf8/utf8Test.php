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
 * @version   SVN: $Id: $
 * $Id: index.php 18893 2009-05-08 11:25:32Z sarunas $
 */

require_once 'unit/OxidTestCase.php';
require_once 'unit/test_config.inc.php';

class UnitUtf8_utf8Test extends OxidTestCase
{


    /**
     * Sets up test
     *
     * @return null
     */
    protected function setUp()
    {
        parent::setUp();

        $this->_sOrigTheme = modConfig::getInstance()->getRealInstance()->getConfigParam('sTheme');
        modConfig::getInstance()->getRealInstance()->setConfigParam('sTheme', 'basic');
    }

    protected function tearDown()
    {
        modConfig::getInstance()->getRealInstance()->setConfigParam('sTheme', $this->_sOrigTheme);

        $this->cleanUpTable( 'oxarticles' );
        $this->cleanUpTable( 'oxaddress' );
        $this->cleanUpTable( 'oxcategories' );
        $this->cleanUpTable( 'oxartextends' );
        $this->cleanUpTable( 'oxattribute' );
        $this->cleanUpTable( 'oxactions' );
        $this->cleanUpTable( 'oxcontents' );
        $this->cleanUpTable( 'oxselectlist' );
        $this->cleanUpTable( 'oxobject2selectlist' );
        $this->cleanUpTable( 'oxobject2category' );
        $this->cleanUpTable( 'oxobject2attribute' );
        $this->cleanUpTable( 'oxobject2list' );
        $this->cleanUpTable( 'oxdelivery' );
        $this->cleanUpTable( 'oxdeliveryset' );
        $this->cleanUpTable( 'oxdiscount' );
        $this->cleanUpTable( 'oxgbentries' );
        $this->cleanUpTable( 'oxgroups' );
        $this->cleanUpTable( 'oxlinks' );
        $this->cleanUpTable( 'oxmanufacturers' );
        $this->cleanUpTable( 'oxnewssubscribed' );
        $this->cleanUpTable( 'oxorder' );
        $this->cleanUpTable( 'oxorderarticles' );
        $this->cleanUpTable( 'oxpayments' );
        $this->cleanUpTable( 'oxpricealarm' );
        $this->cleanUpTable( 'oxrecommlists' );
        $this->cleanUpTable( 'oxremark' );
        $this->cleanUpTable( 'oxreviews' );
        $this->cleanUpTable( 'oxshops' );
        $this->cleanUpTable( 'oxuser' );
        $this->cleanUpTable( 'oxuserbaskets' );
        $this->cleanUpTable( 'oxuserbasketitems' );
        $this->cleanUpTable( 'oxuserpayments' );
        $this->cleanUpTable( 'oxvendor' );
        $this->cleanUpTable( 'oxvouchers' );
        $this->cleanUpTable( 'oxvoucherseries' );
        $this->cleanUpTable( 'oxwrapping' );


            $this->cleanUpTable( 'oxstatistics' );
        $sQ = 'delete from oxshops where oxid > "1" ';
        oxDb::getDb()->Execute( $sQ );

        oxConfig::getInstance()->setActiveView( null );
        parent::tearDown();
    }

    public function testOxActionSaveAndLoad()
    {
        $sValue = 'Žiniasklaidai жителей Veröffentlicht';

        $oAction = new oxactions();
        $oAction->setId( '_testAction' );
        $oAction->oxactions__oxtitle = new oxField( $sValue );
        $oAction->save();

        $oAction = new oxactions();
        $oAction->load( '_testAction' );
        $this->assertEquals( $sValue, $oAction->oxactions__oxtitle->value );
    }

    public function testOxAddressSaveAndLoad()
    {
        $sValue = 'agentūЛитовfür';

        $aFields = array( 'oxaddress__oxcompany', 'oxaddress__oxfname', 'oxaddress__oxlname',
                          'oxaddress__oxstreet', 'oxaddress__oxstreetnr', 'oxaddress__oxaddinfo',
                          'oxaddress__oxcity', 'oxaddress__oxcountry', 'oxaddress__oxzip',
                          'oxaddress__oxfon', 'oxaddress__oxfax', 'oxaddress__oxsal' );

        $oAddress = new oxbase();
        $oAddress->init( 'oxaddress' );
        $oAddress->setId( '_testAddress' );
        foreach ( $aFields as $sFieldName ) {
            $oAddress->{$sFieldName} = new oxField( $sValue );
        }
        $oAddress->save();

        $oAddress = new oxbase();
        $oAddress->init( 'oxaddress' );
        $oAddress->load( '_testAddress' );

        foreach ( $aFields as $sFieldName ) {
            $this->assertTrue( strcmp( $oAddress->{$sFieldName}->value, $sValue ) === 0, "$sFieldName (".$oAddress->{$sFieldName}->value.")" );
        }
    }

    public function testOxArticleGetSelectList()
    {
        $myDB     = oxDb::getDB();
        $myConfig = oxConfig::getInstance();
        $oCurrency = $myConfig->getActShopCurrencyObject();

        $sShopId = $myConfig->getBaseShopId();
        $sVal = 'Опрос Žiniasklaidai Gästebuch!P!-5,99__Опрос Žiniasklaidai Gästebuch@@';

            $sQ = 'insert into oxselectlist (oxid, oxshopid, oxtitle, oxident, oxvaldesc) values ("_testSellisttest", "'.$sShopId.'", "Опрос Žiniasklaidai Gästebuch", "_testSellisttest", "'.$sVal.'")';
        $myDB->Execute( $sQ );

        $sQ = 'insert into oxobject2selectlist values ("_testSellisttest", "1651", "_testSellisttest", 1) ';
        $myDB->Execute( $sQ );

        modConfig::getInstance()->setConfigParam( 'bl_perfLoadSelectLists', true );
        modConfig::getInstance()->setConfigParam( 'bl_perfUseSelectlistPrice', true );

        $oObject = new OxstdClass();
        $oObject->price  = '-5.99';
        $oObject->fprice = '-5,99';
        $oObject->priceUnit = 'abs';
        $oObject->name  = 'Опрос Žiniasklaidai Gästebuch -5,99 '.$oCurrency->sign;
        $oObject->value = 'Опрос Žiniasklaidai Gästebuch';
        $aSelList[] = $oObject;
        $aShouldBe[0] = $aSelList;
        $aShouldBe[0]['name'] = 'Опрос Žiniasklaidai Gästebuch';

        $oArticle = new oxArticle();
        $oArticle->load('1651');
        //$oArticle->resetVar();
        $this->assertEquals( $aShouldBe, $oArticle->getSelectLists() );
    }

    public function testOxArticleSaveAndLoad()
    {
        $aData = array(
                       'oxarticles__oxtitle'       => 'Опрос жителей больших городов pergalių seriją Wertschöpfungskette gebündeltem',
                       'oxarticles__oxshortdesc'   => 'Žiniasklaidai vis dažniau užsimenant šičęвсе чаще сообщают Außergewöhnliche Performance, geringer Server-Ressourcen Verbrauch',
                       'oxarticles__oxurldesc'     => 'Miestiečiai - už protestus, bet prie Šiaurės ęčūпримет меры по предотвращению беспорядков Umfassende Möglichkeiten für funktionale und visuelle Anpassungen',
                       'oxarticles__oxstocktext'   => '85 tūkst. litų darbo дипломата РФ Datenverlust möglich',
                       'oxarticles__oxnostocktext' => 'moteris ččęimoje mažinti диалог с Китаем Dritt-Systeme verfügbar',
                       'oxarticles__oxsearchkeys'  => 'ministrų „žvalgybos создании Жемайтийской Zubehörprodukte',
                       'oxarticles__oxvarname'     => 'Žemkalniui звездой Gästebuch',
                       'oxarticles__oxvarselect'   => 'agentū безрабо. Veröffentlicht',
                      );
        $sLongDesc = 'Nekilnojamojo turto agentūrų verslo sėkme Литовские европарламентарии, срок полномочий которых в 2009 году подходит к концу Der Umstieg war für uns ein voller Erfolg. OXID eShop ist flexibel und benutzerfreundlich';

        $oArticle = new oxarticle();
        $oArticle->setId( '_testArticle' );

        foreach ( $aData as $sField => $sValue ) {
            $oArticle->$sField = new oxField( $sValue );
        }

        $oArticle->setArticleLongDesc( $sLongDesc );
        $oArticle->save();

        $oArticle = new oxarticle();
        $oArticle->load( '_testArticle' );

        foreach ( $aData as $sField => $sValue ) {
            $this->assertTrue( strcmp( $oArticle->{$sField}->value, $sValue ) === 0, $oArticle->{$sField}->value." != $sValue" );
        }
        $this->assertEquals( $sLongDesc, $oArticle->getArticleLongDesc()->value );
    }

    public function testOxArticleLongDescriptionSmartyProcess()
    {
        modConfig::getInstance()->setConfigParam( 'bl_perfParseLongDescinSmarty', 1 );

        $sValue  = '[{ $oViewConf->getImageUrl() }] Nekilnojamojo turto agentūrų verslo sėkme Литовские европарламентарии, срок полномочий которых в 2009 году подходит к концу Der Umstieg war für uns ein voller Erfolg. OXID eShop ist flexibel und benutzerfreundlich';
        $sResult = oxConfig::getInstance()->getImageUrl( false ).' Nekilnojamojo turto agentūrų verslo sėkme Литовские европарламентарии, срок полномочий которых в 2009 году подходит к концу Der Umstieg war für uns ein voller Erfolg. OXID eShop ist flexibel und benutzerfreundlich';

        $oArticle = new oxarticle();
        $oArticle->setId( '_testArticle' );
        $oArticle->setArticleLongDesc( $sValue );
        $oArticle->save();

        $oArticle = new oxarticle();
        $oArticle->load( '_testArticle' );
        $this->assertEquals( $sResult, $oArticle->getLongDesc() );
    }

    public function testOxArticleSetAndGetTags()
    {
        $sValue  = 'nekilnojamojo turto agentūrų verslo sėkme Литовские европарламентарии, срок полномочий которых в 2009 году подходит к концу Der Umstieg war für uns ein voller erfolg. OXID eShop ist flexibel und benutzerfreundlich';
        $sResult = 'nekilnojamojo turto agentūrų verslo sėkme литовские европарламентарии,срок полномочий которых в 2009 году подходит к концу der umstieg war für uns ein voller erfolg. oxid eshop ist flexibel und benutzerfreundlich,sėkme литовские für';

        $oArticle = new oxarticle();
        $oArticle->setId( '_testArticle' );
        $oArticle->setArticleLongDesc( $sValue );
        $oArticle->save();

        $oArticle->saveTags( $sValue );
        $oArticle->addTag( 'sėkme Литовские für' );
        $this->assertEquals( $sResult, $oArticle->getTags() );
    }

    public function testOxArticleGetPersParam()
    {
        $aPersParam = array ( '_testArticle' => 'sėkme Литовские für' );
        modSession::getInstance()->setVar( 'persparam', $aPersParam );

        $oArticle = new oxarticle();
        $oArticle->setId( '_testArticle' );
        $oArticle->UNITassignPersistentParam();
        $this->assertEquals( $aPersParam['_testArticle'], $oArticle->getPersParams() );
    }

    public function testOxArticleListLoadCategoryIds()
    {
        // choosing category id
        $sCatId = oxDb::getDb()->getOne( 'select oxid from oxcategories where oxactive = "1" ' );

        // creating test articles
        $oTestArticle1 = new oxArticle();
        $oTestArticle1->setId( '_testArticle1' );
        $oTestArticle1->save();

        $oTestArticle1->setId( '_testArticle2' );
        $oTestArticle1->save();

        $oTestArticle1->setId( '_testArticle3' );
        $oTestArticle1->save();

        // assigning articles to category
        $oA2C = new oxbase();
        $oA2C->init( 'oxobject2category' );
        $oA2C->oxobject2category__oxobjectid = new oxField( '_testArticle1' );
        $oA2C->oxobject2category__oxcatnid = new oxField( $sCatId );
        $oA2C->setId( '_testArticle1' );
        $oA2C->save();

        $oA2C->oxobject2category__oxobjectid = new oxField( '_testArticle2' );
        $oA2C->setId( '_testArticle2' );
        $oA2C->save();

        $oA2C->oxobject2category__oxobjectid = new oxField( '_testArticle3' );
        $oA2C->setId( '_testArticle3' );
        $oA2C->save();

        // creating attributes
        $oAttr = new oxattribute();
        $oAttr->setId( '_testAttribute1' );
        $oAttr->oxattribute__oxtitle = new oxField( 'Литовские' );
        $oAttr->save();

        $oAttr->setId( '_testAttribute2' );
        $oAttr->oxattribute__oxtitle = new oxField( 'agentūrų' );
        $oAttr->save();

        $oAttr->setId( '_testAttribute3' );
        $oAttr->oxattribute__oxtitle = new oxField( 'für' );
        $oAttr->save();

        // assigning attributes
        $oO2a = new oxbase();
        $oO2a->init( 'oxobject2attribute' );

        $oO2a->setId( '_testo2a1' );
        $oO2a->oxobject2attribute__oxobjectid = new oxField( '_testArticle1' );
        $oO2a->oxobject2attribute__oxattrid = new oxField( '_testAttribute1' );
        $oO2a->oxobject2attribute__oxvalue = new oxField( 'Литовские-' );
        $oO2a->save();

        $oO2a->setId( '_testo2a2' );
        $oO2a->oxobject2attribute__oxobjectid = new oxField( '_testArticle2' );
        $oO2a->oxobject2attribute__oxattrid = new oxField( '_testAttribute2' );
        $oO2a->oxobject2attribute__oxvalue = new oxField( 'agentūrų-' );
        $oO2a->save();

        $oO2a->setId( '_testo2a3' );
        $oO2a->oxobject2attribute__oxobjectid = new oxField( '_testArticle3' );
        $oO2a->oxobject2attribute__oxattrid = new oxField( '_testAttribute3' );
        $oO2a->oxobject2attribute__oxvalue = new oxField( 'für-' );
        $oO2a->save();

        $oO2a->setId( '_testo2a4' );
        $oO2a->oxobject2attribute__oxobjectid = new oxField( $sCatId );
        $oO2a->oxobject2attribute__oxattrid = new oxField( '_testAttribute1' );
        $oO2a->oxobject2attribute__oxvalue = new oxField();
        $oO2a->save();

        $oO2a->setId( '_testo2a5' );
        $oO2a->oxobject2attribute__oxobjectid = new oxField( $sCatId );
        $oO2a->oxobject2attribute__oxattrid = new oxField( '_testAttribute2' );
        $oO2a->oxobject2attribute__oxvalue = new oxField();
        $oO2a->save();

        $oO2a->setId( '_testo2a6' );
        $oO2a->oxobject2attribute__oxobjectid = new oxField( $sCatId );
        $oO2a->oxobject2attribute__oxattrid = new oxField( '_testAttribute3' );
        $oO2a->oxobject2attribute__oxvalue = new oxField();
        $oO2a->save();


        // finally testing
        $oArtList = new oxArticleList();
        $oArtList->loadCategoryIds( $sCatId, array( $sCatId => array( '0' => array ('_testAttribute1' => 'Литовские-' ) ) ) );
        $aKeys = $oArtList->arrayKeys();

        $this->assertTrue( in_array( '_testArticle1', $aKeys ) );
        $this->assertFalse( in_array( '_testArticle2', $aKeys ) );
        $this->assertFalse( in_array( '_testArticle3', $aKeys ) );

        $oArtList = new oxArticleList();
        $oArtList->loadCategoryIds( $sCatId, array( $sCatId => array( '0' => array ('_testAttribute2' => 'agentūrų-' ) ) ) );
        $aKeys = $oArtList->arrayKeys();

        $this->assertFalse( in_array( '_testArticle1', $aKeys ) );
        $this->assertTrue( in_array( '_testArticle2', $aKeys ) );
        $this->assertFalse( in_array( '_testArticle3', $aKeys ) );

        $oArtList = new oxArticleList();
        $oArtList->loadCategoryIds( $sCatId, array( $sCatId => array( '0' => array ('_testAttribute3' => 'für-' ) ) ) );
        $aKeys = $oArtList->arrayKeys();

        $this->assertFalse( in_array( '_testArticle1', $aKeys ) );
        $this->assertFalse( in_array( '_testArticle2', $aKeys ) );
        $this->assertTrue( in_array( '_testArticle3', $aKeys ) );
    }

    public function testOxArticleListLoadSearchIds()
    {
        $sValue  = 'nekilnojamojo turto agentūrų verslo sėkme Литовские европарламентарии, срок полномочий которых в 2009 году подходит к концу Der Umstieg war für uns ein voller Erfolg. OXID eShop ist flexibel und benutzerfreundlich';

        $oTestArticle1 = new oxArticle();
        $oTestArticle1->setId( '_testArticle1' );
        $oTestArticle1->oxarticles__oxtitle = new oxField( $sValue );
        $oTestArticle1->save();

        $oTestArticle2 = new oxArticle();
        $oTestArticle2->setId( '_testArticle2' );
        $oTestArticle2->oxarticles__oxtitle = new oxField( $sValue );
        $oTestArticle2->save();

        $oTestArticle3 = new oxArticle();
        $oTestArticle3->setId( '_testArticle3' );
        $oTestArticle3->oxarticles__oxtitle = new oxField( $sValue );
        $oTestArticle3->save();

        $oArtList = new oxArticleList();
        $oArtList->loadSearchIds( 'agentŪrų литовские für' );
        $aKeys = $oArtList->arrayKeys();

        $this->assertTrue( in_array( '_testArticle1', $aKeys ) );
        $this->assertTrue( in_array( '_testArticle2', $aKeys ) );
        $this->assertTrue( in_array( '_testArticle3', $aKeys ) );
    }

    public function testOxArticleListLoadSearchIdsWithSorting()
    {
        $oTestArticle1 = new oxArticle();
        $oTestArticle1->setId( '_testArticle1' );
        $oTestArticle1->oxarticles__oxtitle = new oxField( "testart_ä" );
        $oTestArticle1->save();

        $oTestArticle2 = new oxArticle();
        $oTestArticle2->setId( '_testArticle2' );
        $oTestArticle2->oxarticles__oxtitle = new oxField( "testart_o" );
        $oTestArticle2->save();

        $oTestArticle3 = new oxArticle();
        $oTestArticle3->setId( '_testArticle3' );
        $oTestArticle3->oxarticles__oxtitle = new oxField( "testart_a" );
        $oTestArticle3->save();

        $oArtList = new oxArticleList();
        $oArtList->setCustomSorting( getViewName('oxarticles').".oxtitle desc" );
        $oArtList->loadSearchIds( 'testart' );
        $aKeys = $oArtList->arrayKeys();

        $this->assertEquals( array( '_testArticle2', '_testArticle1', '_testArticle3' ), $aKeys );
    }

    public function testOxArticleListLoadTagArticles()
    {
        $oArticle = new oxarticle();
        $oArticle->setId( '_testArticle1' );
        $oArticle->save();
        $oArticle->saveTags( 'Литовские европарламентарии, срок полномочий которых в 2009 году подходит к концу' );

        $oArticle = new oxarticle();
        $oArticle->setId( '_testArticle2' );
        $oArticle->save();
        $oArticle->saveTags( 'nekilnojamojo turto agentūrų verslo sėkme' );

        $oArticle = new oxarticle();
        $oArticle->setId( '_testArticle3' );
        $oArticle->save();
        $oArticle->saveTags( 'Der Umstieg war fürrrrr uns ein voller Erfolg. OXID eShop ist flexibel und benutzerfreundlich' );

        $oArtList = new oxArticleList();

        $this->assertEquals( 1, $oArtList->loadTagArticles( 'agentūrų', $oArticle->getLanguage() ) );
        $this->assertTrue( in_array( '_testArticle2', $oArtList->arrayKeys() ) );

        $this->assertEquals( 1, $oArtList->loadTagArticles( 'Литовские', $oArticle->getLanguage() ) );
        $this->assertTrue( in_array( '_testArticle1', $oArtList->arrayKeys() ) );

        $this->assertEquals( 1, $oArtList->loadTagArticles( 'fürrrrr', $oArticle->getLanguage() ) );
        $this->assertTrue( in_array( '_testArticle3', $oArtList->arrayKeys() ) );
    }

    public function testOxArticleListGetTagArticleIds()
    {
        $oArticle = new oxarticle();
        $oArticle->setId( '_testArticle1' );
        $oArticle->save();
        $oArticle->saveTags( 'Литовские европарламентарии, срок полномочий которых в 2009 году подходит к концу' );

        $oArticle = new oxarticle();
        $oArticle->setId( '_testArticle2' );
        $oArticle->save();
        $oArticle->saveTags( 'nekilnojamojo turto agentūrų verslo sėkme' );

        $oArticle = new oxarticle();
        $oArticle->setId( '_testArticle3' );
        $oArticle->save();
        $oArticle->saveTags( 'Der Umstieg war fürrrrr uns ein voller Erfolg. OXID eShop ist flexibel und benutzerfreundlich' );

        $oArtList = new oxArticleList();

        $oArtList->getTagArticleIds( 'agentūrų', $oArticle->getLanguage() );
        $this->assertTrue( in_array( '_testArticle2', $oArtList->arrayKeys() ) );

        $oArtList->getTagArticleIds( 'Литовские', $oArticle->getLanguage() );
        $this->assertTrue( in_array( '_testArticle1', $oArtList->arrayKeys() ) );

        $oArtList->getTagArticleIds( 'fürrrrr', $oArticle->getLanguage() );
        $this->assertTrue( in_array( '_testArticle3', $oArtList->arrayKeys() ) );
    }

    public function testOxAttributeSaveAndLoad()
    {
        $sValue = 'agentūrų Литовские für';

        $oAttr = new oxattribute();
        $oAttr->setId( '_testAttribute1' );
        $oAttr->oxattribute__oxtitle = new oxField( $sValue );
        $oAttr->save();

        $oAttr = new oxattribute();
        $oAttr->load( '_testAttribute1' );

        $this->assertEquals( $sValue, $oAttr->oxattribute__oxtitle->value );
    }

    public function testOxBasketItemSetArticle()
    {
        $oArticle = new oxarticle();
        $oArticle->setId( '_testArticle' );
        $oArticle->oxarticles__oxtitle     = new oxField( "agentūrų Литовские" );
        $oArticle->oxarticles__oxvarselect = new oxField( "für" );
        $oArticle->save();

        $oBasketItem = new oxbasketitem();
        $oBasketItem->UNITsetArticle( '_testArticle' );

        $this->assertEquals( "agentūrų Литовские, für", $oBasketItem->getTitle() );
        $this->assertEquals( "für", $oBasketItem->getVarSelect() );
    }

    public function testOxCategorySaveAndLoad()
    {
        $sValue = 'agentūrų Литовские für';

        $oCat = new oxbase();
        $oCat->init( 'oxcategories' );
        $oCat->setId( '_testCat' );
        $oCat->oxcategories__oxtitle = new oxField( $sValue );
        $oCat->oxcategories__oxdesc = new oxField( $sValue );
        $oCat->oxcategories__oxlongdesc = new oxField( $sValue );
        $oCat->save();

        $oCat = new oxcategory();
        $oCat->load( '_testCat' );

        $this->assertEquals( $sValue, $oCat->oxcategories__oxtitle->value );
        $this->assertEquals( $sValue, $oCat->oxcategories__oxdesc->value );
        $this->assertEquals( $sValue, $oCat->oxcategories__oxlongdesc->value );
    }

    public function testOxCategoryLongDescriptionSmartyProcess()
    {
        modConfig::getInstance()->setConfigParam( 'bl_perfParseLongDescinSmarty', 1 );

        $sValue  = '[{ $oViewConf->getImageUrl() }] Nekilnojamojo turto agentūrų verslo sėkme Литовские европарламентарии, срок полномочий которых в 2009 году подходит к концу Der Umstieg war für uns ein voller Erfolg. OXID eShop ist flexibel und benutzerfreundlich';
        $sResult = oxConfig::getInstance()->getImageUrl( false ).' Nekilnojamojo turto agentūrų verslo sėkme Литовские европарламентарии, срок полномочий которых в 2009 году подходит к концу Der Umstieg war für uns ein voller Erfolg. OXID eShop ist flexibel und benutzerfreundlich';

        $oCat = new oxbase();
        $oCat->init( 'oxcategories' );
        $oCat->setId( '_testCat2' );
        $oCat->oxcategories__oxlongdesc = new oxField( $sValue );
        $oCat->save();

        $oCat = new oxcategory();
        $oCat->load( '_testCat2' );
        $this->assertEquals( $sResult, $oCat->getLongDesc() );
    }

    public function testOxCategoryLoadCategoryIds()
    {
        // choosing category id
        $sCatId = oxDb::getDb()->getOne( 'select oxid from oxcategories where oxactive = "1" ' );

        // creating test articles
        $oTestArticle1 = new oxArticle();
        $oTestArticle1->setId( '_testArticle1' );
        $oTestArticle1->save();

        // assigning articles to category
        $oA2C = new oxbase();
        $oA2C->init( 'oxobject2category' );
        $oA2C->oxobject2category__oxobjectid = new oxField( '_testArticle1' );
        $oA2C->oxobject2category__oxcatnid = new oxField( $sCatId );
        $oA2C->setId( '_testArticle1' );
        $oA2C->save();

        // creating attributes
        $oAttr = new oxattribute();
        $oAttr->setId( '_testAttribute1' );
        $oAttr->oxattribute__oxtitle = new oxField( 'für' );
        $oAttr->save();

        // assigning attributes
        $oO2a = new oxbase();
        $oO2a->init( 'oxobject2attribute' );
        $oO2a->setId( '_testo2a1' );
        $oO2a->oxobject2attribute__oxobjectid = new oxField( '_testArticle1' );
        $oO2a->oxobject2attribute__oxattrid = new oxField( '_testAttribute1' );
        $oO2a->oxobject2attribute__oxvalue = new oxField( 'für-' );
        $oO2a->save();

        $oO2a = new oxbase();
        $oO2a->init( 'oxcategory2attribute' );
        $oO2a->setId( '_testo2a4' );
        $oO2a->oxcategory2attribute__oxobjectid = new oxField( $sCatId );
        $oO2a->oxcategory2attribute__oxattrid = new oxField( '_testAttribute1' );
        $oO2a->save();

        // finally testing
        $oCat = new oxcategory();
        $oCat->load( $sCatId );
        $aAttr = $oCat->getAttributes();
        $oAttr = $aAttr->offsetGet('_testAttribute1');
        $this->assertTrue( $oAttr instanceof oxattribute );
        $this->assertEquals( 'für', $oAttr->getTitle());
    }

    public function testOxCategorylistSortSubCats()
    {
        $sActCat  = '8a142c3e44ea4e714.31136811';
        $sActRoot = '8a142c3e4143562a5.46426637';
        $oObj = $this->getProxyClass( "oxCategorylist" );
        $oObj->setNonPublicVar('sShopID', null);

        $oObj->buildTree($sActCat, 0, 0, 1);

        //Check root order
        $aCurRootOrder = array();
        foreach ($oObj as $sId => $oCat) {
            $aCurRootOrder[] = $oCat->oxcategories__oxsort->value;
        }
        $aExpRootOrder = $aCurRootOrder;
        asort($aExpRootOrder);
        $this->assertEquals(implode(',', $aExpRootOrder), implode(',', $aCurRootOrder));

        //Chect subcat order
        $aCurSubOrder = array();
        foreach ($oObj[$sActRoot]->getSubCats() as $sId => $oCat) {
            $aCurSubOrder[] = $oCat->oxcategories__oxsort->value;
        }
        $aExpSubOrder = $aCurSubOrder; asort($aExpSubOrder);
        $this->assertEquals(implode(',', $aExpSubOrder), implode(',', $aCurSubOrder));
    }

    public function testOxConfigCheckSpecialChars()
    {
        $sIn  = "a&g<e>n\"t'ūrų Л".chr(0)."итовские fü\\r";
        $sOut = "a&amp;g&lt;e&gt;n&quot;t&#039;ūrų Литовские fü&#092;r";

        $this->assertEquals( $sOut, oxConfig::checkSpecialChars( $sIn ) );
    }

    public function testOxConfigGetCurrencyArray()
    {
        $oCurr1 = new oxStdClass();
        $oCurr1->id = '0';
        $oCurr1->name = 'EUR';
        $oCurr1->rate = '1.00';
        $oCurr1->dec = ',';
        $oCurr1->thousand = '.';
        $oCurr1->sign = '€';
        $oCurr1->decimal = '2';
        $oCurr1->selected = '0';

        $oCurr2 = new oxStdClass();
        $oCurr2->id = '1';
        $oCurr2->name = 'GBP';
        $oCurr2->rate = '0.8565';
        $oCurr2->dec = '.';
        $oCurr2->thousand = '';
        $oCurr2->sign = '£';
        $oCurr2->decimal = '2';
        $oCurr2->selected = '0';

        $oCurr3 = new oxStdClass();
        $oCurr3->id = '2';
        $oCurr3->name = 'CHF';
        $oCurr3->rate = '1.4326';
        $oCurr3->dec = ',';
        $oCurr3->thousand = '.';
        $oCurr3->sign = '<small>CHF</small>';
        $oCurr3->decimal = '2';
        $oCurr3->selected = '0';

        $oCurr4 = new oxStdClass();
        $oCurr4->id = '3';
        $oCurr4->name = 'USD';
        $oCurr4->rate = '1.2994';
        $oCurr4->dec = '.';
        $oCurr4->thousand = '';
        $oCurr4->sign = '$';
        $oCurr4->decimal = '2';
        $oCurr4->selected = '0';

        $aCurrArray = array( $oCurr1, $oCurr2, $oCurr3, $oCurr4 );

        $this->assertEquals( $aCurrArray, oxConfig::getInstance()->getCurrencyArray() );
    }

    public function testOxContentSetAndGet()
    {
        $sValue  = 'sėkme Литовские für';

        $oContent = new oxcontent();
        $oContent->setId( '_testContent' );
        $oContent->oxcontents__oxloadid  = new oxField( "_testLoadId" );
        $oContent->oxcontents__oxtitle   = new oxField( $sValue );
        $oContent->oxcontents__oxcontent = new oxField( $sValue );
        $oContent->oxcontents__oxfolder  = new oxField( $sValue );
        $oContent->save();

        $oContent = new oxcontent();
        $oContent->load( '_testContent' );

        $this->assertEquals( $sValue, $oContent->oxcontents__oxtitle->value );
        $this->assertEquals( $sValue, $oContent->oxcontents__oxcontent->value );
        $this->assertEquals( $sValue, $oContent->oxcontents__oxfolder->value );
    }

    public function testOxCountrySetAndGet()
    {
        $sValue  = 'sėkme Литовские für';

        $oCountry = new oxcountry();
        $oCountry->setId( '_testCountry' );
        $oCountry->oxcountry__oxtitle     = new oxField( $sValue );
        $oCountry->oxcountry__oxisoalpha2 = new oxField( "ėЛ" );
        $oCountry->oxcountry__oxisoalpha3 = new oxField( "ėЛü" );
        $oCountry->oxcountry__oxunnum3    = new oxField( "ėЛü" );
        $oCountry->oxcountry__oxshortdesc = new oxField( $sValue );
        $oCountry->oxcountry__oxlongdesc  = new oxField( $sValue );
        $oCountry->save();

        $oCountry = new oxcountry();
        $oCountry->load( '_testCountry' );

        $this->assertEquals( $sValue, $oCountry->oxcountry__oxtitle->value );
        $this->assertEquals( "ėЛ", $oCountry->oxcountry__oxisoalpha2->value );
        $this->assertEquals( "ėЛü", $oCountry->oxcountry__oxisoalpha3->value );
        $this->assertEquals( "ėЛü", $oCountry->oxcountry__oxunnum3->value );
        $this->assertEquals( $sValue, $oCountry->oxcountry__oxshortdesc->value );
        $this->assertEquals( $sValue, $oCountry->oxcountry__oxlongdesc->value );
    }

    public function testOxCountryListLoad()
    {
        // inserting test country
        $oCountry = new oxcountry();
        $oCountry->setId( '_testCountry' );
        $oCountry->oxcountry__oxtitle  = new oxField( 'Ö_testCountry' );
        $oCountry->oxcountry__oxorder  = new oxField( 9999 );
        $oCountry->oxcountry__oxactive = new oxField( 1 );
        $oCountry->save();

        //
        $oCountryList = new oxcountrylist();
        $oCountryList->loadActiveCountries();
        $oCountryList->rewind();

        while ( $oCountry = $oCountryList->current() ) {
            if ( $oCountry->oxcountry__oxtitle->value == 'Österreich' ) {
                break;
            }
            $oCountryList->next();
        }

        $oCountryList->next();

        $oCountry = $oCountryList->current();
        $this->assertTrue( ( bool ) $oCountry );
        $this->assertEquals( "_testCountry", $oCountry->getId() );
    }

    public function testOxDeliverySaveAndLoad()
    {
        $sValue  = 'sėkme Литовские für';

        $oDelivery = new oxdelivery();
        $oDelivery->setId( '_testDelivery' );
        $oDelivery->oxdelivery__oxtitle = new oxField( $sValue );
        $oDelivery->save();

        $oDelivery = new oxdelivery();
        $oDelivery->load( '_testDelivery' );

        $this->assertEquals( $sValue, $oDelivery->oxdelivery__oxtitle->value );
    }

    public function testOxDeliverySetSaveAndLoad()
    {
        $sValue  = 'sėkme Литовские für';

        $oDeliverySet = new oxdeliveryset();
        $oDeliverySet->setId( '_testDelivery' );
        $oDeliverySet->oxdeliveryset__oxtitle = new oxField( $sValue );
        $oDeliverySet->save();

        $oDeliverySet = new oxdeliveryset();
        $oDeliverySet->load( '_testDelivery' );

        $this->assertEquals( $sValue, $oDeliverySet->oxdeliveryset__oxtitle->value );
    }

    public function testOxDiscountSetSaveAndLoad()
    {
        $sValue  = 'sėkme Литовские für';

        $oDeliverySet = new oxdiscount();
        $oDeliverySet->setId( '_testDiscount' );
        $oDeliverySet->oxdiscount__oxtitle = new oxField( $sValue );
        $oDeliverySet->save();

        $oDeliverySet = new oxdiscount();
        $oDeliverySet->load( '_testDiscount' );

        $this->assertEquals( $sValue, $oDeliverySet->oxdiscount__oxtitle->value );
    }

    public function testOxFieldConvertToPseudoHtml()
    {
        $oField = new oxField( "a&g<e>n\"t'ūrų Литовские für\r\n" );
        $oField->convertToPseudoHtml();

        $this->assertEquals( "a&amp;g&lt;e&gt;n&quot;t&#039;ūrų Литовские für<br />\n", $oField->getRawValue() );
    }

    public function testOxGbEntrySaveAndLoad()
    {
        $sValue  = 'sėkme Литовские für';

        $oEntry = new oxgbentry();
        $oEntry->setId( '_testGbentry' );
        $oEntry->oxgbentries__oxcontent = new oxField( $sValue );
        $oEntry->save();

        $oEntry = new oxgbentry();
        $oEntry->load( '_testGbentry' );
        $this->assertEquals( $sValue, $oEntry->oxgbentries__oxcontent->value );
    }

    public function testOxGroupsSaveAndLoad()
    {
        $sValue  = 'sėkme Литовские für';

        $oGroup = new oxgroups();
        $oGroup->setId( '_testGroup' );
        $oGroup->oxgroups__oxtitle = new oxField( $sValue );
        $oGroup->save();

        $oGroup = new oxgroups();
        $oGroup->load( '_testGroup' );
        $this->assertEquals( $sValue, $oGroup->oxgroups__oxtitle->value );
    }

    public function testOxLangTest()
    {
        $oLang = oxLang::getInstance();

        // testing some constants ..
        $this->assertEquals( 'Ihr Passwort wurde geändert.', $oLang->translateString( "ACCOUNT_PASSWORD_PASSWORDCHANGED", 0, false ) );
        $this->assertEquals( 'Karte wählen', $oLang->translateString( "WRAPPING_SELECTCARD", 0, false ) );
        $this->assertEquals( 'Abschließende Informationen', $oLang->translateString( "ORDER_NOTE", 0, false ) );
        $this->assertEquals( 'UTF-8', $oLang->translateString( "charset", 0, false ) );
        $this->assertEquals( '\/ß[]~ä#-', $oLang->translateString("\/ß[]~ä#-" ) );

        $this->assertEquals( 'Bitte Kategorien wählen', $oLang->translateString( "GENERAL_CATEGORYSELECT", 0, true ) );
        //$this->assertEquals( 'Gästebuch', $oLang->translateString( "GUI_GROUP_BODY_GUESTBOOK", 0, true ) );
        $this->assertEquals( 'Notiz anfügen', $oLang->translateString( "TOOLTIPS_NEWREMARK", 0, true ) );
        $this->assertEquals( 'UTF-8', $oLang->translateString( "charset", 0, true ) );
    }

    public function testReadTranslateStrFromTextFile()
    {
        $sTestFile = getTestsBasePath().'/unitUtf8/out/lang.txt';
        $oConfig = $this->getMock( 'oxConfig', array( 'getLanguagePath' ) );
        $oConfig->expects( $this->any() )->method( 'getLanguagePath')->will( $this->returnValue( $sTestFile ) );
        $oSubj = $this->getProxyClass("oxLang");
        $oSubj->setConfig( $oConfig );
        $sTrString = $oSubj->UNITreadTranslateStrFromTextFile("size", 1);
        $this->assertEquals("Grösse", $sTrString);
    }

    public function testOxLinksSaveAndLoad()
    {
        $sValue  = 'sėkme Литовские für';

        $oLink = new oxlinks();
        $oLink->setId( '_testLink' );
        $oLink->oxlinks__oxurldesc = new oxField( $sValue );
        $oLink->save();

        $oLink = new oxlinks();
        $oLink->load( '_testLink' );
        $this->assertEquals( $sValue, $oLink->oxlinks__oxurldesc->value );
    }

    public function testOxManufacturerSaveAndLoad()
    {
        $sValue  = 'sėkme Литовские für';

        $oMan = new oxmanufacturer();
        $oMan->setId( '_testMan' );
        $oMan->oxmanufacturers__oxtitle = new oxField( $sValue );
        $oMan->oxmanufacturers__oxshortdesc = new oxField( $sValue );
        $oMan->save();

        $oMan = new oxmanufacturer();
        $oMan->load( '_testMan' );
        $this->assertEquals( $sValue, $oMan->oxmanufacturers__oxtitle->value );
        $this->assertEquals( $sValue, $oMan->oxmanufacturers__oxshortdesc->value );
    }

    public function testOxMediaUrlSaveAndLoad()
    {
        $sValue  = 'sėkme Литовские für';

        $oMedia = new oxmediaurl();
        $oMedia->setId( '_testMan' );
        $oMedia->oxmediaurls__oxdesc = new oxField( $sValue );
        $oMedia->save();
        $oMedia->setId( '_testMan2' );
        $oMedia->oxmediaurls__oxdesc = new oxField( $sValue );
        $oMedia->oxmediaurls__oxurl = new oxField( "http://www.youtube.com/watch?v=ZN239G6aJZo" );
        $oMedia->save();

        $oMedia = new oxmediaurl();
        $oMedia->load( '_testMan' );
        $this->assertEquals( $sValue, $oMedia->oxmediaurls__oxdesc->value );
        $oMedia->load( '_testMan2' );
        $sExpt = $sValue.'<br><object type="application/x-shockwave-flash" data="http://www.youtube.com/v/ZN239G6aJZo" width="425" height="344"><param name="movie" value="http://www.youtube.com/v/ZN239G6aJZo"></object>';
        $this->assertEquals($sExpt, $oMedia->getHtml());
    }

    public function testOxNewsletterSetParamsPlusSaveLoadFor()
    {

        $oActView = oxNew( 'oxubase' );
        $oActView->addGlobalParams();
        oxConfig::getInstance()->setActiveView( $oActView );

        $sValue  = '[{ $oViewConf->getImageUrl() }] Nekilnojamojo turto agentūrų verslo sėkme Литовские европарламентарии, срок полномочий которых в 2009 году подходит к концу Der Umstieg war für uns ein voller Erfolg. OXID eShop ist flexibel und benutzerfreundlich';
        $sResult = oxConfig::getInstance()->getImageUrl( false ).' Nekilnojamojo turto agentūrų verslo sėkme Литовские европарламентарии, срок полномочий которых в 2009 году подходит к концу Der Umstieg war für uns ein voller Erfolg. OXID eShop ist flexibel und benutzerfreundlich';

        $oNewsletter = new oxnewsletter();
        $oNewsletter->oxnewsletter__oxtemplate = new oxField( $sValue, oxField::T_RAW );
        $oNewsletter->oxnewsletter__oxplaintemplate = new oxField( $sValue, oxField::T_RAW );
        $oNewsletter->prepare( 'oxdefaultadmin' );

        $this->assertTrue( strcmp( $oNewsletter->getHtmlText(), $sResult ) === 0, $oNewsletter->getHtmlText()." != $sResult" );
        $this->assertTrue( strcmp( $oNewsletter->getPlainText(), $sResult ) === 0, $oNewsletter->getPlainText()." != $sResult" );
    }

    public function testOxNewsSubscribedUpdateSubscription()
    {
        $sValue = 'agentūrų Литовские für';
        $oUser = new oxuser();
        $oUser->oxuser__oxusername = new oxField( $sValue );
        $oUser->oxuser__oxfname    = new oxField( $sValue );
        $oUser->oxuser__oxlname    = new oxField( $sValue );

        $oNewsSubs = oxNew( 'oxnewssubscribed' );
        $oNewsSubs->setId( '_testNewsSubs' );
        $oNewsSubs->save();

        $oNewsSubs = oxNew( 'oxnewssubscribed' );
        $oNewsSubs->load( '_testNewsSubs' );
        $oNewsSubs->updateSubscription( $oUser );

        $this->assertTrue( strcmp( $oNewsSubs->oxnewssubscribed__oxfname->value, $sValue ) === 0, $oNewsSubs->oxnewssubscribed__oxfname->value." != $sValue" );
        $this->assertTrue( strcmp( $oNewsSubs->oxnewssubscribed__oxlname->value, $sValue ) === 0, $oNewsSubs->oxnewssubscribed__oxlname->value." != $sValue" );
        $this->assertTrue( strcmp( $oNewsSubs->oxnewssubscribed__oxemail->value, $sValue ) === 0, $oNewsSubs->oxnewssubscribed__oxemail->value." != $sValue" );
    }

    public function testOxNewsSubscribedSaveAndLoad()
    {
        $sValue = 'agentūrų Литовские für';

        $oNewsSubs = oxNew( 'oxnewssubscribed' );
        $oNewsSubs->setId( '_testNewsSubs' );
        $oNewsSubs->oxnewssubscribed__oxsal   = new oxField( $sValue );
        $oNewsSubs->oxnewssubscribed__oxfname = new oxField( $sValue );
        $oNewsSubs->oxnewssubscribed__oxlname = new oxField( $sValue );
        $oNewsSubs->oxnewssubscribed__oxemail = new oxField( $sValue );
        $oNewsSubs->save();

        $oNewsSubs = oxNew( 'oxnewssubscribed' );
        $oNewsSubs->load( '_testNewsSubs' );

        $this->assertTrue( strcmp( $oNewsSubs->oxnewssubscribed__oxsal->value, $sValue ) === 0, $oNewsSubs->oxnewssubscribed__oxsal->value." != $sValue" );
        $this->assertTrue( strcmp( $oNewsSubs->oxnewssubscribed__oxfname->value, $sValue ) === 0, $oNewsSubs->oxnewssubscribed__oxfname->value." != $sValue" );
        $this->assertTrue( strcmp( $oNewsSubs->oxnewssubscribed__oxlname->value, $sValue ) === 0, $oNewsSubs->oxnewssubscribed__oxlname->value." != $sValue" );
        $this->assertTrue( strcmp( $oNewsSubs->oxnewssubscribed__oxemail->value, $sValue ) === 0, $oNewsSubs->oxnewssubscribed__oxemail->value." != $sValue" );
    }

    public function testOxOrderSaveAndLoad()
    {
        $sValue = 'agentūЛитовfür';

        $aFields = array( 'oxorder__oxbillcompany', 'oxorder__oxbillemail', 'oxorder__oxbillfname',
                          'oxorder__oxbilllname', 'oxorder__oxbillstreet', 'oxorder__oxbillstreetnr',
                          'oxorder__oxbilladdinfo', 'oxorder__oxbillustid', 'oxorder__oxbillcity',
                          'oxorder__oxbillzip', 'oxorder__oxbillfon',
                          'oxorder__oxbillfax', 'oxorder__oxbillsal', 'oxorder__oxdelcompany',
                          'oxorder__oxdelfname', 'oxorder__oxdellname', 'oxorder__oxdelstreet',
                          'oxorder__oxdelstreetnr', 'oxorder__oxdeladdinfo', 'oxorder__oxdelcity',
                          'oxorder__oxdelzip', 'oxorder__oxdelfon',
                          'oxorder__oxdelfax', 'oxorder__oxdelsal', 'oxorder__oxbillnr',
                          'oxorder__oxtrackcode', 'oxorder__oxremark', 'oxorder__oxcurrency',
                          'oxorder__oxtransid', 'oxorder__oxcardtext',
                          'oxorder__oxxid', 'oxorder__oxip', 'oxorder__oxtransstatus' );

        $oOrder = oxNew( 'oxorder' );
        $oOrder->setId( '_testOrder' );
        foreach ( $aFields as $sFieldName ) {
            $oOrder->{$sFieldName} = new oxField( $sValue );
        }
        $oOrder->save();

        $oOrder = oxNew( 'oxorder' );
        $oOrder->load( '_testOrder' );

        foreach ( $aFields as $sFieldName ) {
            $this->assertTrue( strcmp( $oOrder->{$sFieldName}->value, $sValue ) === 0, "$sFieldName (".$oOrder->{$sFieldName}->value.")" );
        }
    }

    public function testOxOrderSetPaymentWithDynValues()
    {
        $sValue = 'agentūrų Литовские für';
        $aDynVal = array("kktype" => "visa", "kknumber" => "12345", "kkmonth" => "11", "kkyear" => "2008", "kkname" => $sValue, "kkpruef" => "56789");
        oxSession::setVar( 'dynvalue', $aDynVal );

        $oOrder = $this->getProxyClass( "oxOrder" );
        $oOrder->oxorder__oxuserid = new oxField();

        $oUserpayment = $oOrder->UNITsetPayment( 'oxidcreditcard' );

        $sValue = "kktype__visa@@kknumber__12345@@kkmonth__11@@kkyear__2008@@kkname__".$sValue."@@kkpruef__56789@@";
        $this->assertEquals( $sValue, $oUserpayment->oxuserpayments__oxvalue->value );
        $this->assertEquals( 6, count($oUserpayment->aDynValues) );
    }

    public function testOxOrderArticleSetAndGetPersParams()
    {
        $sValue = 'agentūrų Литовские für';

        $oOrderArticle = new oxorderarticle();
        $oOrderArticle->setId( '_testOrderArticle' );
        $oOrderArticle->setPersParams( $sValue );
        $oOrderArticle->save();

        $oOrderArticle = new oxorderarticle();
        $oOrderArticle->load( '_testOrderArticle' );
        $this->assertEquals( $sValue, $oOrderArticle->getPersParams() );
    }

    public function testOxOrderArticleSaveAndLoad()
    {
        $sValue = 'agentūЛитовfür';

        $aFields = array( 'oxorderarticles__oxartnum', 'oxorderarticles__oxtitle', 'oxorderarticles__oxshortdesc',
                          'oxorderarticles__oxselvariant', 'oxorderarticles__oxpersparam', 'oxorderarticles__oxexturl',
                          'oxorderarticles__oxurldesc', 'oxorderarticles__oxurlimg', 'oxorderarticles__oxthumb',
                          'oxorderarticles__oxpic1', 'oxorderarticles__oxpic2',
                          'oxorderarticles__oxpic3', 'oxorderarticles__oxpic4', 'oxorderarticles__oxpic5',
                          'oxorderarticles__oxfile', 'oxorderarticles__oxsearchkeys', 'oxorderarticles__oxtemplate',
                          'oxorderarticles__oxquestionemail', 'oxorderarticles__oxfolder', 'oxorderarticles__oxsubclass' );


        $oOrderArticle = oxNew( 'oxorderarticle' );
        $oOrderArticle->setId( '_testOrder' );
        foreach ( $aFields as $sFieldName ) {
            $oOrderArticle->{$sFieldName} = new oxField( $sValue );
        }
        $oOrderArticle->save();

        $oOrderArticle = oxNew( 'oxorderarticle' );
        $oOrderArticle->load( '_testOrder' );

        foreach ( $aFields as $sFieldName ) {
            $this->assertTrue( strcmp( $oOrderArticle->{$sFieldName}->value, $sValue ) === 0, "$sFieldName (".$oOrderArticle->{$sFieldName}->value.")" );
        }
    }

    public function testOxOutputProcessWithEuroSign()
    {
        $oOutput = oxNew( 'oxOutput' );
        oxConfig::getInstance()->setConfigParam( 'blSkipEuroReplace', false );
        $this->assertEquals( '€someting', $oOutput->process( '€someting', 'something' ) );
    }

    public function testOxPaymentSaveAndLoad()
    {
        $sValue = 'agentūЛитовfür';

        $aFields = array( 'oxpayments__oxdesc', 'oxpayments__oxvaldesc' );

        $oPayment = oxNew( 'oxpayment' );
        $oPayment->setId( '_testPayment' );
        foreach ( $aFields as $sFieldName ) {
            $oPayment->{$sFieldName} = new oxField( $sValue );
        }
        $oPayment->save();

        $oPayment = oxNew( 'oxpayment' );
        $oPayment->load( '_testPayment' );

        foreach ( $aFields as $sFieldName ) {
            $this->assertTrue( strcmp( $oPayment->{$sFieldName}->value, $sValue ) === 0, "$sFieldName (".$oPayment->{$sFieldName}->value.")" );
        }
    }

    public function testOxPriceAlarmSaveAndLoad()
    {
        $sValue = 'agentūЛитовfür';

        $aFields = array( 'oxpricealarm__oxemail', 'oxpricealarm__oxcurrency' );

        $oPricealarm = oxNew( 'oxpricealarm' );
        $oPricealarm->setId( '_testPricealarm' );
        foreach ( $aFields as $sFieldName ) {
            $oPricealarm->{$sFieldName} = new oxField( $sValue );
        }
        $oPricealarm->save();

        $oPricealarm = oxNew( 'oxpricealarm' );
        $oPricealarm->load( '_testPricealarm' );

        foreach ( $aFields as $sFieldName ) {
            $this->assertTrue( strcmp( $oPricealarm->{$sFieldName}->value, $sValue ) === 0, "$sFieldName (".$oPricealarm->{$sFieldName}->value.")" );
        }
    }

    public function testOxRecommListsSaveAndLoad()
    {
        $sValue = 'agentūЛитовfür';

        $aFields = array( 'oxrecommlists__oxauthor', 'oxrecommlists__oxtitle', 'oxrecommlists__oxdesc' );

        $oRecList = oxNew( 'oxrecommlist' );
        $oRecList->setId( '_testRecommlist' );
        foreach ( $aFields as $sFieldName ) {
            $oRecList->{$sFieldName} = new oxField( $sValue );
        }
        $oRecList->save();

        $oRecList = oxNew( 'oxrecommlist' );
        $oRecList->load( '_testRecommlist' );

        foreach ( $aFields as $sFieldName ) {
            $this->assertTrue( strcmp( $oRecList->{$sFieldName}->value, $sValue ) === 0, "$sFieldName (".$oRecList->{$sFieldName}->value.")" );
        }
    }

    public function testOxRecommListsGetSearchRecommListCount()
    {
        $sValue = 'agentūЛитовfür';

        $aFields = array( 'oxrecommlists__oxauthor', 'oxrecommlists__oxtitle', 'oxrecommlists__oxdesc' );

        $oRecList = oxNew( 'oxrecommlist' );
        $oRecList->setId( '_testRecommlist' );
        foreach ( $aFields as $sFieldName ) {
            $oRecList->{$sFieldName} = new oxField( $sValue );
        }
        $oRecList->save();
        $oObj2List = new oxbase();
        $oObj2List->init("oxobject2list");
        $oObj2List->setId("_testRecom");
        $oObj2List->oxobject2list__oxobjectid = new oxField( "2000" );
        $oObj2List->oxobject2list__oxlistid = new oxField( '_testRecommlist' );
        $oObj2List->save();

        $oRecList = oxNew( 'oxrecommlist' );
        $this->assertEquals( 1, $oRecList->getSearchRecommListCount($sValue) );
    }

    public function testOxRemarkSaveAndLoad()
    {
        $sValue = 'agentūЛитовfür';

        $aFields = array( 'oxremark__oxtext' );

        $oRemark = oxNew( 'oxremark' );
        $oRemark->setId( '_testRemark' );
        foreach ( $aFields as $sFieldName ) {
            $oRemark->{$sFieldName} = new oxField( $sValue );
        }
        $oRemark->save();

        $oRemark = oxNew( 'oxremark' );
        $oRemark->load( '_testRemark' );

        foreach ( $aFields as $sFieldName ) {
            $this->assertTrue( strcmp( $oRemark->{$sFieldName}->value, $sValue ) === 0, "$sFieldName (".$oRemark->{$sFieldName}->value.")" );
        }
    }

    public function testOxReviewSaveAndLoad()
    {
        $sValue = 'agentūЛитовfür';

        $aFields = array( 'oxreviews__oxtext' );

        $oReview = oxNew( 'oxreview' );
        $oReview->setId( '_testReview' );
        foreach ( $aFields as $sFieldName ) {
            $oReview->{$sFieldName} = new oxField( $sValue );
        }
        $oReview->save();

        $oReview = oxNew( 'oxreview' );
        $oReview->load( '_testReview' );

        foreach ( $aFields as $sFieldName ) {
            $this->assertTrue( strcmp( $oReview->{$sFieldName}->value, $sValue ) === 0, "$sFieldName (".$oReview->{$sFieldName}->value.")" );
        }
    }


    public function testOxRssFeedGetArticleItems()
    {
        $sValue = 'agentūrų Литовские für';
        oxTestModules::addFunction('oxutilsurl', 'prepareUrlForNoSession', '{return $aA[0]."extra";}');
        modConfig::getInstance()->setConfigParam( "bl_perfParseLongDescinSmarty", false );
        $oCfg = $this->getMock( 'oxconfig', array( 'getActShopCurrencyObject' ) );

        $oActCur = new stdClass();
        $oActCur->decimal = 1;
        $oActCur->sign = 'EUR';
        $oCfg->expects($this->any())->method( 'getActShopCurrencyObject')->will( $this->returnValue( $oActCur ) );
        $oRss = oxNew('oxrssfeed');
        $oRss->setConfig($oCfg);

        $oLongDesc = new Oxstdclass();
        $oLongDesc->value = "";

        $oArt2 = $this->getMock('oxarticle', array( "getLink", 'getArticleLongDesc' ));
        $oArt2->expects($this->any())->method( 'getLink')->will( $this->returnValue( "artlink" ) );
        $oArt2->expects($this->any())->method( 'getArticleLongDesc')->will( $this->returnValue( $oLongDesc ) );
        $oArt2->oxarticles__oxtitle = new oxField('title2');
        $oArt2->oxarticles__oxprice = new oxField(10);
        $oArt2->oxarticles__oxshortdesc = new oxField($sValue);
        $oArr = new oxarticlelist();
        $oArr->assign( array( $oArt2 ) );

        $oSAr2 = new oxStdClass();
        $oSAr2->title = 'title2 10.0 EUR';
        $oSAr2->link  = 'artlinkextra';
        $oSAr2->guid  = 'artlinkextra';
        $oSAr2->isGuidPermalink = true;
        $oSAr2->description = "&lt;img src=&#039;".$oArt2->getIconUrl()."&#039; border=0 align=&#039;left&#039; hspace=5&gt;".$sValue;

        $this->assertEquals(array($oSAr2), $oRss->UNITgetArticleItems($oArr));

    }
    public function testOxRssFeedPrepareFeedName()
    {
        $sValue = 'agentūrų Литовские für';
        $oRss = oxNew('oxrssfeed');

        $oCfg = $this->getMock( 'oxconfig', array( 'getActiveShop' ) );
        $oShop = new oxStdClass();
        $oShop->oxshops__oxname = new oxField($sValue);
        $oShop->oxshops__oxversion = new oxField('oxversion');
        $oCfg->expects($this->any())->method( 'getActiveShop')->will( $this->returnValue( $oShop ) );

        $oRss->setConfig($oCfg);
        $this->assertEquals( $sValue.'/Test', $oRss->UNITprepareFeedName( 'Test' ) );
    }

    public function testOxRssFeedLoadSearchArticles()
    {
        $sValue = 'agentūЛитовfür';
        oxTestModules::addFunction('oxrssfeed', '_getSearchParamsUrl', '{ return "klnk"; }');
        $oCfg = $this->getMock( 'oxconfig', array( 'getActiveShop', 'getShopHomeUrl', 'getImageDir' ) );
        $oRss = oxNew('oxrssfeed');
        $oRss->setConfig($oCfg);
        $oCat = oxNew('oxcategory');

        modConfig::getInstance()->setConfigParam( 'iRssItemsCount', 50);
        oxTestModules::addFunction('oxLang', 'getBaseLanguage', '{return 1;}');
        oxTestModules::addFunction('oxLang', 'translateString', '{return $aA[0]."tr";}');

        oxTestModules::addFunction('oxrssfeed', '_loadData', '{ $this->_aChannel["data"] = $aA; }');
        oxTestModules::addFunction('oxrssfeed', 'getSearchArticlesUrl', '{ return "surl"; }');
        oxTestModules::addFunction('oxrssfeed', 'getSearchArticlesTitle', '{ return "dastitle"; }');

        oxTestModules::addFunction('oxsearch', 'getSearchArticles', '{
            $oArtList = new oxArticleList();
            $oArt = new oxArticle();
            $oArt->setId("loaded".$aA[0].$aA[1].$aA[2].$aA[3].$aA[4]);
            $oArtList->offsetSet(\'test_item\', $oArt);
            return $oArtList;
        }');
        oxTestModules::addFunction('oxrssfeed', '_getArticleItems', '{ return $aA[0]; }');
        oxTestModules::addFunction('oxrssfeed', '_getShopUrl', '{ return "shopurl?"; }');

        $oRss = oxNew('oxrssfeed');
        $oRss->loadSearchArticles( $sValue, "BB", "CC", "DD");

        $oArtList = new oxArticleList();
        $oArt = new oxArticle();
        $oArt->setId('loaded'.$sValue.'BBCCDD'.oxNew('oxarticle')->getViewName().'.oxtimestamp desc');
        $oArtList->offsetSet('test_item', $oArt);

        $aChannel = array(
            'data' => array (
                '0' => null,
                '1' => 'dastitle',
                '2' => 'RSS_SEARCHARTICLES_DESCRIPTIONtr',
                '3' => $oArtList,
                '4' => 'surl',
                '5' => 'shopurl?cl=search&amp;klnk'
            )
        );

        $this->assertEquals( $aChannel, $oRss->getChannel());

        $this->assertEquals(50, modConfig::getInstance()->getConfigParam('iNrofCatArticles'));
    }

    public function testOxRssFeedGetSearchArticlesTitle()
    {
        $sValue = 'agentūЛитовfür';

        oxTestModules::addFunction('oxrssfeed', '_getSearchParamsTranslation', '{return $aA[0].$aA[1].$aA[2].$aA[3].$aA[4];}');

        $oRss = oxNew('oxrssfeed');
        $oCfg = $this->getMock( 'oxconfig', array( 'getActiveShop' ) );
        $oShop = new oxStdClass();
        $oShop->oxshops__oxname = new oxField('Test Shop');
        $oCfg->expects($this->any())->method( 'getActiveShop')->will( $this->returnValue( $oShop ) );
        $oRss->setConfig( $oCfg );
        $this->assertEquals('Test Shop/RSS_SEARCHARTICLES_TITLEtssscat'.$sValue.'man', $oRss->getSearchArticlesTitle('tsss', 'cat', $sValue, 'man'));
    }

    public function testOxSearchGetWhereWithSearchIngLongDescSecondLanguage()
    {
        $sValue = 'ū';

        // forcing config
        modConfig::getInstance()->setConfigParam( 'aSearchCols', array( 'oxlongdesc' ) );

        $sQ = " and ( (  oxv_oxartextends_en.oxlongdesc like '%$sValue%' )  ) ";

        $oSearch = new oxSearch();

        // setting english language as base
        $oSearch->setLanguage( 1 );

        $sFix = $oSearch->UNITgetWhere( $sValue );

        $aSearch  = array( "/\s+/", "/\t+/", "/\r+/", "/\n+/" );
        $sQ = trim(strtolower( preg_replace( $aSearch, " ", $sQ ) ));
        $sFix = trim(strtolower( preg_replace( $aSearch, " ", $sFix ) ));

        $this->assertEquals( $sQ, $sFix );
    }
    public function testOxSelectListSaveAndLoad()
    {
        $sValue = 'agentūrų Литовские für';

        // assigning select list
        $oSelList = new oxselectlist();
        $oSelList->setId( '_testSelList' );
        $oSelList->oxselectlist__oxtitle   = new oxField( $sValue );
        $oSelList->oxselectlist__oxident   = new oxField( $sValue );
        $oSelList->oxselectlist__oxvaldesc = new oxField( "{$sValue}<br>1__@@{$sValue}<a>2__@@{$sValue}3__@@<table>", oxField::T_RAW );
        $oSelList->save();

        $oSelList = new oxselectlist();
        $oSelList->load( '_testSelList' );

        $this->assertTrue( strcmp( $oSelList->oxselectlist__oxtitle->value, $sValue ) === 0 );
        $this->assertTrue( strcmp( $oSelList->oxselectlist__oxident->value, $sValue ) === 0 );
        $this->assertTrue( strcmp( $oSelList->oxselectlist__oxvaldesc->getRawValue(), "{$sValue}<br>1__@@{$sValue}<a>2__@@{$sValue}3__@@<table>" ) === 0 );

        $oVal1 = new oxStdClass();
        $oVal1->name  = "{$sValue}&lt;br&gt;1";
        $oVal1->value = "";

        $oVal2 = clone $oVal1;
        $oVal2->name = "{$sValue}&lt;a&gt;2";

        $oVal3 = clone $oVal1;
        $oVal3->name = "{$sValue}3";

        $aList = array( $oVal1, $oVal2, $oVal3 );
        $this->assertEquals( $aList, $oSelList->getFieldList());
    }

    public function testOxSeoEncoderEncodeString()
    {
        $sIn  = "agentūлитовfür";
        $sOut = "agentūлитовfuer";

        $oSeoEncoder = new oxSeoEncoder();
        $this->assertEquals( $sOut, $oSeoEncoder->encodeString( $sIn ) );
    }

    public function testOxShopSaveAndLoad()
    {
        $sValue = 'agentūЛитовfür';

        $aFields = array( 'oxshops__oxdefcurrency', 'oxshops__oxname', 'oxshops__oxtitleprefix',
                          'oxshops__oxtitlesuffix', 'oxshops__oxstarttitle', 'oxshops__oxinfoemail',
                          'oxshops__oxorderemail', 'oxshops__oxowneremail', 'oxshops__oxordersubject',
                          'oxshops__oxregistersubject', 'oxshops__oxforgotpwdsubject', 'oxshops__oxsendednowsubject',
                          'oxshops__oxsmtp', 'oxshops__oxsmtpuser', 'oxshops__oxsmtppwd',
                          'oxshops__oxcompany', 'oxshops__oxstreet',
                          'oxshops__oxzip', 'oxshops__oxcity', 'oxshops__oxcountry',
                          'oxshops__oxbankname', 'oxshops__oxbanknumber', 'oxshops__oxbankcode',
                          'oxshops__oxvatnumber', 'oxshops__oxbiccode', 'oxshops__oxibannumber',
                          'oxshops__oxfname', 'oxshops__oxlname', 'oxshops__oxtelefon',
                          'oxshops__oxtelefax', 'oxshops__oxurl', 'oxshops__oxhrbnr',
                          'oxshops__oxcourt', 'oxshops__oxadbutlerid', 'oxshops__oxaffilinetid',
                          'oxshops__oxsuperclicksid', 'oxshops__oxaffiliweltid', 'oxshops__oxaffili24id',
                          'oxshops__oxversion' );


        $oShop = oxNew( 'oxshop' );
        $oShop->setId( '5' );
        foreach ( $aFields as $sFieldName ) {
            $oShop->{$sFieldName} = new oxField( $sValue );
        }
        $oShop->save();

        $oShop = oxNew( 'oxshop' );
        $oShop->load( '5' );

        foreach ( $aFields as $sFieldName ) {
            $this->assertTrue( strcmp( $oShop->{$sFieldName}->value, $sValue ) === 0, "$sFieldName (".$oShop->{$sFieldName}->value.")" );
        }
    }

    public function testOxStatisticsSaveAndLoad()
    {

        $sValue = 'agentūЛитовfür';

        $aFields = array( 'oxstatistics__oxtitle', 'oxstatistics__oxvalue' );

        $oStat = oxNew( 'oxstatistic' );
        $oStat->setId( '_testStat' );
        foreach ( $aFields as $sFieldName ) {
            $oStat->{$sFieldName} = new oxField( $sValue );
        }
        $oStat->save();

        $oStat = oxNew( 'oxstatistic' );
        $oStat->load( '_testStat' );

        foreach ( $aFields as $sFieldName ) {
            $this->assertTrue( strcmp( $oStat->{$sFieldName}->value, $sValue ) === 0, "$sFieldName (".$oStat->{$sFieldName}->value.")" );
        }
    }

    public function testOxTagCloudPrepareTags()
    {
        $sTagsToProcess = "ag,en,tū,Ли,то,вfür";
        $sTagsToReturn = "ag__,en__,tū__,ли__,то__,вfür";

        $oTagCloud = new oxTagCloud();
        $this->assertEquals( $sTagsToReturn, $oTagCloud->prepareTags( $sTagsToProcess ) );
    }

    public function testOxTagCloudTrimTags()
    {
        $sTagsToProcess = "ag__,en__,tū__,ли__,то__,вfür";
        $sTagsToReturn = "ag,en,tū,ли,то,вfür";

        $oTagCloud = new oxTagCloud();
        $this->assertEquals( $sTagsToReturn, $oTagCloud->trimTags( $sTagsToProcess ) );
    }

    public function testOxTagCloudGetTagsArticle()
    {
        $oTestArticle = new oxarticle();
        $oTestArticle->setId( '_testArticle' );
        $oTestArticle->oxarticles__oxactive = new oxField( 1 );
        $oTestArticle->save();
        $oTestArticle->saveTags('ändern,andern,ondern');
        $oTagCloud = new oxTagCloud();
        $aTags = $oTagCloud->getTags('_testArticle');

        $aTestTags = array('andern' => 1,'ändern' => 1,'ondern' => 1);
        $this->assertEquals( 3, count( $aTags ) );
        $this->assertEquals( $aTestTags, $aTags);
    }

    public function testOxUserSaveAndLoad()
    {
        $sValue = 'agentūЛитовfür';

        $aFields = array( 'oxuser__oxusername', 'oxuser__oxpassword',
                          'oxuser__oxustid', 'oxuser__oxcompany', 'oxuser__oxfname',
                          'oxuser__oxlname', 'oxuser__oxstreet', 'oxuser__oxstreetnr',
                          'oxuser__oxaddinfo', 'oxuser__oxcity', 'oxuser__oxzip',
                          'oxuser__oxfon', 'oxuser__oxfax', 'oxuser__oxsal',
                          'oxuser__oxprivfon', 'oxuser__oxmobfon', 'oxuser__oxurl',
                          'oxuser__oxupdatekey' );


        $oUser = oxNew( 'oxuser' );
        $oUser->setId( '_testUser' );
        foreach ( $aFields as $sFieldName ) {
            $oUser->{$sFieldName} = new oxField( $sValue );
        }
        $oUser->save();

        $oUser = oxNew( 'oxuser' );
        $oUser->load( '_testUser' );

        foreach ( $aFields as $sFieldName ) {
            $this->assertTrue( strcmp( $oUser->{$sFieldName}->value, $sValue ) === 0, "$sFieldName (".$oUser->{$sFieldName}->value.")" );
        }
    }

    public function testOxUserLogin()
    {
        $sValue = 'agentūЛитовfür';

        $oUser = oxNew( 'oxuser' );
        $oUser->setId( '_testUser' );
        $oUser->oxuser__oxusername = new oxField( $sValue );
        $oUser->setPassword( $sValue );
        $oUser->oxuser__oxactive   = new oxField( 1 );
        $oUser->save();

        $oUser = oxNew( 'oxuser' );
        $this->assertTrue( $oUser->login( $sValue, $sValue ) );
    }

    public function testOxUserCheckPassword()
    {
        oxTestModules::addFunction( "oxInputValidator", "checkPassword", "{ throw new oxInputException('EXCEPTION_INPUT_EMPTYPASS'); }");
        $sValue = 'ūЛü';

        $oUser = oxNew( 'oxuser' );
        try {
            $oUser->UNITcheckPassword( $sValue, $sValue, true );
        } catch ( oxInputException $oExcp ) {
            return;
        }
        $this->fail( 'Error in _checkPassword function' );
    }

    public function testOxInputValidatorCheckPassword()
    {
        $sValue = 'ūЛü';

        $oValidator = $this->getMock( 'oxInputValidator', array( "_addValidationError" ) );
        $oValidator->expects( $this->once() )->method( '_addValidationError')->with( $this->equalTo( "oxuser__oxpassword" ) );
        $oValidator->checkPassword( new oxUser(), $sValue, $sValue, true );
    }

    public function testOxUserBasketSaveAndLoad()
    {
        $sValue = 'agentūЛитовfür';

        $aFields = array( 'oxuserbaskets__oxtitle' );

        $oUBasket = oxNew( 'oxuserbasket' );
        $oUBasket->setId( '_testUBasket' );
        foreach ( $aFields as $sFieldName ) {
            $oUBasket->{$sFieldName} = new oxField( $sValue );
        }
        $oUBasket->save();

        $oUBasket = oxNew( 'oxuserbasket' );
        $oUBasket->load( '_testUBasket' );

        foreach ( $aFields as $sFieldName ) {
            $this->assertTrue( strcmp( $oUBasket->{$sFieldName}->value, $sValue ) === 0, "$sFieldName (".$oUBasket->{$sFieldName}->value.")" );
        }
    }

    public function testOxUserBasketItemSaveAndLoad()
    {
        $sValue = 'agentūЛитовfür';

        $oUBasketItem = new oxUserBasketItem();
        $oUBasketItem->setId( '_testUBasketItem' );
        $oUBasketItem->oxuserbasketitems__oxamount = new oxField( $sValue );
        $oUBasketItem->setSelList( array( $sValue ) );
        $oUBasketItem->save();

        $oUBasketItem = new oxUserBasketItem();
        $oUBasketItem->load( '_testUBasketItem' );

        $this->assertTrue( strcmp( $oUBasketItem->oxuserbasketitems__oxamount->value, $sValue ) === 0 );
        $aSelList = $oUBasketItem->getSelList();
        $this->assertTrue( strcmp( current( $aSelList ), $sValue ) === 0 );
    }

    public function testOxUserPaymentSaveAndLoad()
    {
        $sValue = 'agentūЛитовfür';

        $oUPayment = new oxUserPayment();
        $oUPayment->setId( '_testUPayment' );
        $oUPayment->oxuserpayments__oxvalue = new oxField( $sValue );
        $oUPayment->save();

        $oUPayment = new oxUserPayment();
        $oUPayment->load( '_testUPayment' );

        $this->assertTrue( strcmp( $oUPayment->oxuserpayments__oxvalue->value, $sValue ) === 0 );
    }

    public function testOxUtilsIsValidEmail()
    {
        $sEmail = 'info@�vyturys.lt';

        $oUtils = new oxUtils();
        $this->assertFalse( $oUtils->isValidEmail( $sEmail ) );
    }

    public function testOxUtilsOxFileCache()
    {
        $sValue = 'agentūЛитовfür';
        $sName  = time();

        $oUtils = new oxUtils();
        $oUtils->toFileCache( $sName, $sValue );

        //double check
        $this->assertEquals(  $oUtils->fromFileCache( $sName ), $sValue );
        $this->assertTrue( strcmp( $oUtils->fromFileCache( $sName ), $sValue ) === 0 );
    }

    public function testOxUtilsToFileCacheFromFileCache()
    {
        $sValue = 'agentūЛитовfür';
        $sName  = md5(time());

        $oUtils = new oxUtils();
        $oUtils->toFileCache( $sName, $sValue );

        //double check
        $this->assertEquals( $sValue, $oUtils->fromFileCache( $sName ));
        $this->assertTrue( strcmp( $oUtils->fromFileCache( $sName ), $sValue ) === 0 );
    }

    public function testOxUtilsIsValidAlpha()
    {
        $sValue = 'agentūЛитовfür';

        $oUtils = new oxUtils();
        // field names have no utf
        $this->assertFalse( $oUtils->isValidAlpha( $sValue ) );
    }

    public function testOxUtilsFillExplodeArray()
    {
        modConfig::getInstance()->setConfigParam( 'bl_perfLoadSelectLists', true );
        modConfig::getInstance()->setConfigParam( 'bl_perfUseSelectlistPrice', true );

        $sValue = 'agentūЛитовfür';
        $sParam = "{$sValue}1!P!10%__@@{$sValue}2!P!20abs__@@{$sValue}3!P!30%__@@";

        $oVal1 = new oxStdClass();
        $oVal1->price     = '10';
        $oVal1->priceUnit = '%';
        $oVal1->fprice    = '10%';
        $oVal1->name      = 'agentūЛитовfür1 +10%';
        $oVal1->value     = '';

        $oVal2 = new oxStdClass();
        $oVal2->price     = '20abs';
        $oVal2->priceUnit = 'abs';
        $oVal2->fprice    = '20,00';
        $oVal2->name      = 'agentūЛитовfür2 +20,00 €';
        $oVal2->value     = '';

        $oVal3 = new oxStdClass();
        $oVal3->price     = '30';
        $oVal3->priceUnit = '%';
        $oVal3->fprice    = '30%';
        $oVal3->name      = 'agentūЛитовfür3 +30%';
        $oVal3->value     = '';

        $aValue = array( $oVal1, $oVal2, $oVal3 );

        $oUtils = new oxUtils();
        $this->assertEquals( $aValue, $oUtils->assignValuesFromText( $sParam, 15 ) );
    }

    public function testOxUtilsFillExplodeArrayWithoutPrice()
    {
        modConfig::getInstance()->setConfigParam( 'bl_perfUseSelectlistPrice', false );

        $sValue = 'agentūЛитовfür';
        $sParam = "{$sValue}1!P!10%__@@{$sValue}2!P!20abs__@@{$sValue}3!P!30%__@@";

        $oVal1 = new oxStdClass();
        $oVal1->name      = 'agentūЛитовfür1';
        $oVal1->value     = '';

        $oVal2 = new oxStdClass();
        $oVal2->name      = 'agentūЛитовfür2';
        $oVal2->value     = '';

        $oVal3 = new oxStdClass();
        $oVal3->name      = 'agentūЛитовfür3';
        $oVal3->value     = '';

        $aValue = array( $oVal1, $oVal2, $oVal3 );

        $oUtils = new oxUtils();
        $this->assertEquals( $aValue, $oUtils->assignValuesFromText( $sParam, 15 ) );
    }

    public function testOxUtilsStringPrepareCSVField()
    {
        $sString = 'agentū "Литовfür"';
        $sExpected = '"agentū ""Литовfür"""';

        $oUtils = new oxUtilsString();
        $this->assertEquals( $sExpected, $oUtils->prepareCSVField( $sString ) );
    }

    public function testOxUtilsStringMinimizeTruncateString()
    {
        $sString = "agentūЛитов \t\n\rfüragentūЛитовfür";
        $sExpected = "agentūЛитов fü";

        $oUtils = new oxUtilsString();
        $this->assertEquals( $sExpected, $oUtils->minimizeTruncateString( $sString, 14 ) );
    }

    public function testOxUtilsStringPrepareStrForSearch()
    {
        $sString = 'agentūЛитовfür';
        $sExpected = 'agentūЛитовf&uuml;r';

        $oUtils = new oxUtilsString();
        $this->assertEquals( $sExpected, $oUtils->prepareStrForSearch( $sString ) );
    }

    public function testOxVendorSaveAndLoad()
    {
        $sValue = 'agentūЛитовfür';

        $aFields = array( 'oxvendor__oxicon', 'oxvendor__oxtitle', 'oxvendor__oxshortdesc' );

        $oVendor = oxNew( 'oxvendor' );
        $oVendor->setId( '_testVendor' );
        foreach ( $aFields as $sFieldName ) {
            $oVendor->{$sFieldName} = new oxField( $sValue );
        }
        $oVendor->save();

        $oVendor = oxNew( 'oxvendor' );
        $oVendor->load( '_testVendor' );

        foreach ( $aFields as $sFieldName ) {
            $this->assertTrue( strcmp( $oVendor->{$sFieldName}->value, $sValue ) === 0, "$sFieldName (".$oVendor->{$sFieldName}->value.")" );
        }
    }

    public function testOxVoucherSaveAndLoad()
    {
        $sValue = 'agentūЛитовfür';

        $oVoucher = oxNew( 'oxvoucher' );
        $oVoucher->setId( '_testVoucher' );
        $oVoucher->oxvouchers__oxvouchernr = new oxField( $sValue );
        $oVoucher->save();

        $oVoucher = oxNew( 'oxvoucher' );
        $oVoucher->load( '_testVoucher' );

        $this->assertTrue( strcmp( $oVoucher->oxvouchers__oxvouchernr->value, $sValue ) === 0, "$sFieldName (".$oVoucher->oxvouchers__oxvouchernr->value.")" );
    }

    public function testOxVoucherSerieSaveAndLoad()
    {
        $sValue = 'agentūЛитовfür';

        $oVoucherSerie = oxNew( 'oxvoucherserie' );
        $oVoucherSerie->setId( '_testVoucherSerie' );
        $oVoucherSerie->oxvoucherseries__oxserienr = new oxField( $sValue );
        $oVoucherSerie->oxvoucherseries__oxseriedescription = new oxField( $sValue );
        $oVoucherSerie->save();

        $oVoucherSerie = oxNew( 'oxvoucherserie' );
        $oVoucherSerie->load( '_testVoucherSerie' );

        $this->assertTrue( strcmp( $oVoucherSerie->oxvoucherseries__oxserienr->value, $sValue ) === 0, "$sFieldName (".$oVoucherSerie->oxvoucherseries__oxserienr->value.")" );
        $this->assertTrue( strcmp( $oVoucherSerie->oxvoucherseries__oxseriedescription->value, $sValue ) === 0, "$sFieldName (".$oVoucherSerie->oxvoucherseries__oxseriedescription->value.")" );
    }

    public function testOxWrappingSaveAndLoad()
    {
        $sValue = 'ūЛвf';

        $oWrap = oxNew( 'oxwrapping' );
        $oWrap->setId( '_testWrapping' );
        $oWrap->oxwrapping__oxtype = new oxField( $sValue );
        $oWrap->oxwrapping__oxname = new oxField( $sValue );
        $oWrap->oxwrapping__oxpic = new oxField( $sValue );
        $oWrap->save();

        $oWrap = oxNew( 'oxwrapping' );
        $oWrap->load( '_testWrapping' );

        $this->assertTrue( strcmp( $oWrap->oxwrapping__oxtype->value, $sValue ) === 0, "$sFieldName (".$oWrap->oxwrapping__oxtype->value.")" );
        $this->assertTrue( strcmp( $oWrap->oxwrapping__oxname->value, $sValue ) === 0, "$sFieldName (".$oWrap->oxwrapping__oxname->value.")" );
        $this->assertTrue( strcmp( $oWrap->oxwrapping__oxpic->value, $sValue ) === 0, "$sFieldName (".$oWrap->oxwrapping__oxpic->value.")" );
    }

    public function testaListGetCatPathString()
    {
        $sValue = 'agentūЛитовfür';
        $sResult = 'agentūлитовfür';

        $oCat = new oxCategory();
        $oCat->oxcategories__oxtitle = new oxField( $sValue );

        $oView = $this->getMock( 'alist', array( 'getCatTreePath' ) );
        $oView->expects( $this->once() )->method( 'getCatTreePath' )->will( $this->returnValue( array( $oCat ) ));

        $this->assertEquals( $sResult, $oView->UNITgetCatPathString() );
    }

    public function testaListCollectMetaDescription()
    {
        $sValue = "agentūЛитовfür \n \r \t \xc2\x95 \xc2\xa0";
        $oActCat = new oxcategory();
        $oActCat->oxcategories__oxlongdesc = $this->getMock( 'oxField', array( '__get' ) );
        $oActCat->oxcategories__oxlongdesc->expects( $this->once() )->method( '__get')->will( $this->returnValue( '' ) );

        $oArticle = new oxArticle();
        $oArticle->oxarticles__oxtitle = $this->getMock( 'oxField', array( '__get' ) );
        $oArticle->oxarticles__oxtitle->expects( $this->exactly( 2 ) )->method( '__get')->will( $this->returnValue( $sValue ) );

        $oArtList = new oxlist();
        $oArtList->offsetSet( 0, $oArticle );
        $oArtList->offsetSet( 1, $oArticle );

        $sCatPathString = 'sCatPathString';

        $oListView = $this->getMock( 'alist', array( 'getActCategory', 'getArticleList', '_getCatPathString' ) );
        $oListView->expects( $this->any() )->method( 'getActCategory')->will( $this->returnValue( $oActCat ) );
        $oListView->expects( $this->any() )->method( 'getArticleList')->will( $this->returnValue( $oArtList ) );
        $oListView->expects( $this->any() )->method( '_getCatPathString')->will( $this->returnValue( $sCatPathString ) );

        $sMeta = 'sCatPathString - '.$sValue;

        $oView = new oxubase();
        $this->assertEquals( $oView->UNITprepareMetaDescription( $sMeta . ", " . $sValue ), $oListView->UNITcollectMetaDescription( false ) );
    }

    public function testaListPrepareMetaDescription()
    {
        $sValue = "agentūЛитовfür\n\r\t\xc2\x95\xc2\xa0";
        $sDescription = oxLang::getInstance()->translateString( 'INC_HEADER_YOUAREHERE' );
        $oActCat = new oxcategory();
        $oActCat->oxcategories__oxtitle = $this->getMock( 'oxField', array( '__get' ) );
        $oActCat->oxcategories__oxtitle->expects( $this->once() )->method( '__get')->will( $this->returnValue( $sValue ) );

        $oListView = $this->getMock( 'alist', array( 'getActCategory' ) );
        $oListView->expects( $this->any() )->method( 'getActCategory')->will( $this->returnValue( $oActCat ) );

        $sDescription = $sDescription . " agentūЛитовfür     . " . oxConfig::getInstance()->getActiveShop()->oxshops__oxstarttitle->value;

        $oView = new oxubase();
        $this->assertEquals( $sDescription, $oListView->UNITprepareMetaDescription( false ) );
    }

    public function testaListPrepareMetaKeyword()
    {
        $aSubCats[0] = new oxcategory();
        $aSubCats[0]->oxcategories__oxtitle = new oxField( 'agentū Литовfür sub_category_1' );

        $aSubCats[1] = new oxcategory();
        $aSubCats[1]->oxcategories__oxtitle = new oxField( 'agentū Литовfür Nada fedia nada' );

        $oParentCategory = new oxcategory();
        $oParentCategory->oxcategories__oxtitle = new oxField( 'agentū Литовfür parent_category' );

        $oCategory = new oxcategory();
        $oCategory->oxcategories__oxtitle = new oxField( 'current_category' );
        $oCategory->oxcategories__oxparentid = new oxField( 'parentCategoryId' );

        $oCategory->setSubCats( $aSubCats );
        $oCategory->setParentCategory( $oParentCategory );

        $aCatTree[] = $oParentCategory;
        $aCatTree[] = $oCategory;

        $oCategoryTree = $this->getMock( 'oxcategorylist', array( 'getPath' ) );
        $oCategoryTree->expects( $this->any() )->method( 'getPath')->will( $this->returnValue( $aCatTree ) );

        $oListView = $this->getMock( 'alist', array( 'getActCategory', 'getCategoryTree' ) );
        $oListView->expects( $this->any() )->method( 'getActCategory')->will($this->returnValue( $oCategory ) );
        $oListView->expects( $this->any() )->method( 'getCategoryTree')->will( $this->returnValue( $oCategoryTree ) );

        $this->assertEquals( 'agentū, литовfür, parent_category, current_category, sub_category_1, nada, fedia', $oListView->UNITprepareMetaKeyword( null ) );
    }

    public function testaListCollectMetaKeyword()
    {
        $sValue  = 'agentū Литовfür test best nest fest';
        $sResult = 'agentū литовfür test best nest fest';

        $oArt = new oxArticle();
        $oArt->setArticleLongDesc( $sValue );
        $oArtList = new oxlist();
        $oArtList->offsetSet( 0, $oArt );
        $oView = $this->getMock( 'alist', array( 'getArticleList', '_prepareMetaDescription', '_getCatPathString' ) );
        $oView->expects( $this->once() )->method( 'getArticleList' )->will( $this->returnValue( $oArtList ) );
        $oView->expects( $this->once() )->method( '_getCatPathString' )->will( $this->returnValue( '' ) );
        $oView->expects( $this->once() )->method( '_prepareMetaDescription' )->with( $this->equalTo( $sResult), $this->equalTo(-1), $this->equalTo(false) )->will( $this->returnValue( $sResult ) );

        $this->assertEquals( 'agentū, литовfür, test, best, nest, fest', $oView->UNITcollectMetaKeyword( array() ) );
    }

    public function testDetailsSettingKeywordsAndDescriptionInRender()
    {
        $sValue = 'agentūЛитовfür test, best nest fest<br><br /><br/>';

        $oArt = new oxArticle();
        $oArt->oxarticles__oxtitle = new oxField( $sValue, oxField::T_RAW );
        $oArt->setArticleLongDesc( $sValue );
        $oArt->oxarticles__oxsearchkeys = new oxField( $sValue, oxField::T_RAW );

        $sMetaKeywParam = ( $oArt->oxarticles__oxsearchkeys->value ) ? $oArt->oxarticles__oxsearchkeys->value." ".$sMetaKeywParam:$sMetaKeywParam;
        $oView = $this->getMock( 'details', array( 'getProduct' ) );
        $oView->expects( $this->any() )->method( 'getProduct' )->will( $this->returnValue( $oArt ) );

        $this->assertEquals( 'agentūЛитовfür test, best nest fest - agentūЛитовfür test, best nest fest', $oView->getMetaDescription() );
        $this->assertEquals( 'agentūлитовfür, test, best, nest, fest', $oView->getMetaKeywords() );
    }

    public function testDetailsAddTags()
    {
        oxTestModules::addFunction("oxutilsserver", "getServerVar", "{ \$aArgs = func_get_args(); if ( \$aArgs[0] === 'HTTP_HOST' ) { return '".oxConfig::getInstance()->getShopUrl()."'; } elseif ( \$aArgs[0] === 'SCRIPT_NAME' ) { return ''; } else { return \$_SERVER[\$aArgs[0]]; } }");
        $sValue = 'agentūЛитовfür';

        modConfig::getInstance()->setParameter('newTags', '' );
        modConfig::getInstance()->setParameter('highTags', $sValue );
        $oArt = new oxArticle();
        $oArt->setId("_testArt");
        $oArt->save();

        $oView = $this->getMock( 'details', array( 'getProduct' ) );
        $oView->expects( $this->any() )->method( 'getProduct' )->will( $this->returnValue( $oArt ) );
        $oView->addTags();
        $this->assertEquals($oView->getTagCloudManager()->getCloudArray("_testArt"), array('agentūлитовfür' => 1));
    }

    /*
     * Test prepearing meta description - removing spec. chars
     */
    public function testuBasePrepareMetaDescriptionRemovesSpecChars()
    {
        $sDesc = "&nbsp; \" ".'\''." : ! ? \n \r \t \xc2\x95 \xc2\xa0 ;";

        $oView = new oxubase();
        $sResult = $oView->UNITprepareMetaDescription( $sDesc );

        $this->assertEquals( "&quot; &#039; : ! ?", $sResult);
    }

    public function testuBasePrepareMetaDescription()
    {
        $sValue  = 'agentū  Л  итовfür test best nest fest test<br><br /><br/>';
        $sResult = 'agentū Л итовfür test best nest fest test';

        $oView = new oxubase();
        $this->assertEquals( $sResult, $oView->UNITprepareMetaDescription( $sValue ) );
    }

    public function testuBasePrepareKeyword()
    {
        $sValue  = 'agentūЛитовfür test best nest fest test';
        $sResult = 'test, best, nest, fest';

        modConfig::getInstance()->setConfigParam( 'aSkipTags', array( 'agentūЛитовfür' ) );

        $oView = new oxubase();
        $this->assertEquals( $sResult, $oView->UNITprepareMetaKeyword( $sValue ) );
    }

    public function testuBaseRemoveDuplicatedWords()
    {
        $sValue = 'agentū Лито вfü r test best вfü nest fest test agentū лито';
        $sResult = 'agentū, лито, вfü, r, test, best, nest, fest';

        $oView = new oxubase();
        $this->assertEquals( $sResult, $oView->UNITremoveDuplicatedWords( $sValue ) );
    }

    public function testTagGetTitle()
    {
        $sValue = 'литов';
        $sResult = 'Литов';

        $oView = $this->getProxyClass( 'tag' );
        $oView->setNonPublicVar( "_sTag", $sValue );
        $this->assertEquals( $sResult, $oView->getTitle() );
    }

    public function testTagGetBreadCrumb()
    {
        $sValue = 'Литов';
        $sResult = 'Литов';

        $oView = $this->getProxyClass( 'tag' );
        $oView->setNonPublicVar( "_sTag", $sValue );

        $aPath = array(
            array('title'=>'Stichworte', 'link' => oxSeoEncoder::getInstance()->getStaticUrl( $oView->getViewConfig()->getSelfLink() . 'cl=tags' )),
            array('title'=>$sResult, 'link' => $oView->getCanonicalUrl())
        );

        $this->assertEquals( $aPath, $oView->getBreadCrumb());
    }

    public function testOxEmailIncludeImages()
    {
        oxTestModules::addFunction('oxUtilsObject', 'generateUID', '{ return "xxx"; }');

        $sBodyToReturn = "agentūлитовfür <img src=\"__imagedir__/stars.jpg\" alt=\"agentūлитовfür\">";
        $sBodyToSet = "agentūлитовfür <img src=\"cid:xxx\" alt=\"agentūлитовfür\">";

        $oEmail = $this->getMock( 'oxemail', array( 'getBody', 'setBody' ) );
        $oEmail->expects( $this->once() )->method( 'getBody' )->will( $this->returnValue( $sBodyToReturn ) );
        $oEmail->expects( $this->once() )->method( 'setBody' )->with( $this->equalTo( $sBodyToSet ) );
        $oEmail->UNITincludeImages( "__imagedir__", null, null, oxConfig::getInstance()->getImageDir() );
    }

    public function testOxEmailSetBody()
    {
        $sBodyToSet = "agentūлитовfür <a href=\"someurl.php?cl=comecl&amp;sid=somesid&amp;something=something\" title=\"agentūлитовfür\">";
        $sBodyWillGet = "agentūлитовfür <a href=\"someurl.php?cl=comecl&amp;sid=x&amp;shp=".oxConfig::getInstance()->getBaseShopId()."&amp;something=something\" title=\"agentūлитовfür\">";

        $oEmail = new oxEmail();
        $oEmail->setBody( $sBodyToSet );
        $this->assertEquals( $sBodyWillGet, $oEmail->getBody() );
    }

    public function testOxEmailSetAltBody()
    {
        $sBodyToSet = "agentūлитовfür <a href=\"someurl.php?cl=comecl&amp;sid=somesid&amp;something=something\" title=\"agentūлитовfür\">";
        $sBodyWillGet = "agentūлитовfür <a href=\"someurl.php?cl=comecl&sid=x&shp=".oxConfig::getInstance()->getBaseShopId()."&something=something\" title=\"agentūлитовfür\">";

        $oEmail = new oxEmail();
        $oEmail->setAltBody( $sBodyToSet );
        $this->assertEquals( $sBodyWillGet, $oEmail->getAltBody() );
    }

}
