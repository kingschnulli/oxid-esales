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
 * @version   SVN: $Id: oxorderarticleTest.php 26888 2010-03-26 14:25:32Z vilma $
 */

require_once realpath( "." ).'/unit/OxidTestCase.php';
require_once realpath( "." ).'/unit/test_config.inc.php';

class Unit_Core_oxorderarticleTest extends OxidTestCase
{
    protected $_oOrderArticle = null;

    /**
     * Initialize the fixture.
     *
     * @return null
     */
    protected function setup()
    {
        parent::setUp();
        $this->_oOrderArticle = new oxorderarticle();
        $this->_oOrderArticle->setId( '_testOrderArticleId' );
        $this->_oOrderArticle->oxorderarticles__oxartid = new oxField('_testArticleId', oxField::T_RAW);
        $this->_oOrderArticle->oxorderarticles__oxorderid = new oxField('51', oxField::T_RAW);
        $this->_oOrderArticle->save();

        $oArticle = new oxarticle();
        $oArticle->setId( '_testArticleId' );
        $oArticle->oxarticles__oxtitle = new oxField('testArticleTitle', oxField::T_RAW);
        $oArticle->oxarticles__oxactive = new oxField('1', oxField::T_RAW);
        $oArticle->oxarticles__oxstock = new oxField('10', oxField::T_RAW);
        $oArticle->oxarticles__oxshopid = new oxField(oxConfig::getInstance()->getShopId(), oxField::T_RAW);


        $oArticle->save();
    }

    /**
     * Tear down the fixture.
     *
     * @return null
     */
    protected function tearDown()
    {
        $this->cleanUpTable( 'oxorderarticles' );
        $this->cleanUpTable( 'oxarticles' );

        parent::tearDown();
    }

    public function testDelete()
    {
        modConfig::getInstance()->setConfigParam( "blUseStock", 1 );
        modConfig::getInstance()->setConfigParam( "blAllowNegativeStock", 'xxx' );

        $oOrderArticle = $this->getMock( "oxorderarticle", array( "updateArticleStock" ) );
        $oOrderArticle->expects( $this->once() )->method( 'updateArticleStock')->with( $this->equalTo( 999 ), 'xxx' );
        $oOrderArticle->oxorderarticles__oxstorno = new oxField( 0 );
        $oOrderArticle->oxorderarticles__oxamount = new oxField( 999 );
        $oOrderArticle->delete( '_testOrderArticleId' );
    }

    public function testSave()
    {
        modConfig::getInstance()->setConfigParam( "blUseStock", 1 );
        modConfig::getInstance()->setConfigParam( "blAllowNegativeStock", 'xxx' );

        $oOrderArticle = $this->getMock( "oxorderarticle", array( "updateArticleStock", "isNewOrderItem" ) );
        $oOrderArticle->expects( $this->once() )->method( 'updateArticleStock')->with( $this->equalTo( -999 ), 'xxx' );
        $oOrderArticle->expects( $this->once() )->method( 'isNewOrderItem')->will( $this->returnValue( true ) );
        $oOrderArticle->oxorderarticles__oxstorno = new oxField( 0 );
        $oOrderArticle->oxorderarticles__oxamount = new oxField( 999 );
        $oOrderArticle->save();
    }
    public function testCancelOrderArticleAllreadyCanceled()
    {
        $oOrderArticle = $this->getMock( "oxOrderArticle", array( "save" ) );
        $oOrderArticle->expects( $this->never() )->method( 'save');
        $oOrderArticle->oxorderarticles__oxstorno = new oxField( 1 );

        $oOrderArticle->cancelOrderArticle();
    }

    public function testCancelOrderArticle()
    {
        modConfig::getInstance()->setConfigParam( "blUseStock", 1 );
        modConfig::getInstance()->setConfigParam( "blAllowNegativeStock", 1 );

        $oOrderArticle = $this->getMock( "oxOrderArticle", array( "save", "updateArticleStock" ) );
        $oOrderArticle->expects( $this->once() )->method( 'save')->will( $this->returnValue( true ) );
        $oOrderArticle->expects( $this->once() )->method( 'updateArticleStock')->with( $this->equalTo( 999 ), $this->equalTo( 1 ) );
        $oOrderArticle->oxorderarticles__oxstorno = new oxField( 0 );
        $oOrderArticle->oxorderarticles__oxamount = new oxField( 999 );

        $oOrderArticle->cancelOrderArticle();
    }

    public function testIsOrderArticle()
    {
        $oOrderArticle = new oxOrderArticle();
        $this->assertTrue( $oOrderArticle->isOrderArticle() );
    }


    public function testGetProductParentId()
    {
        $oOrderArticle = new oxOrderArticle();
        $this->assertFalse( $oOrderArticle->getProductParentId() );

        $oOrderArticle = new oxOrderArticle();
        $oOrderArticle->oxorderarticles__oxartparentid = new oxField( "sParentId" );
        $this->assertEquals( "sParentId", $oOrderArticle->getProductParentId() );
    }

    public function testGetCategoryIds()
    {
        $oArticle = new oxArticle();
        $oArticle->load( "1126" );

        $oOrderArticle = new oxOrderArticle();
        $oOrderArticle->oxorderarticles__oxartid = new oxField( "1126" );

        $this->assertEquals( $oArticle->getCategoryIds( false, true ), $oOrderArticle->getCategoryIds( false, true ) );
    }

    public function testGetBasePrice()
    {
        $oPrice = "oBasePrice";
        $oOrderArticle = $this->getMock( "oxorderarticle", array( "getPrice" ) );
        $oOrderArticle->expects( $this->once() )->method( 'getPrice')->will( $this->returnValue( $oPrice ) );
        $this->assertEquals( $oPrice, $oOrderArticle->getBasePrice() );
    }


    public function testGetProductId()
    {
        $oOrderArticle = new oxOrderArticle();
        $oOrderArticle->oxorderarticles__oxartid = new oxField( 'testArticleId' );
        $this->assertEquals( 'testArticleId', $oOrderArticle->getProductId() );
    }

    public function testLoadInLang()
    {
        $oOrderArticle = $this->getMock( "oxOrderArticle", array( 'load' ) );
        $oOrderArticle->expects( $this->once() )->method( 'load')->with( $this->equalTo( "sOrderArticleId" ) );
        $oOrderArticle->loadInLang( 0, "sOrderArticleId" );
    }

    public function testCheckForStock()
    {
        $oOrderArticle = new oxOrderArticle();
        $this->assertTrue( $oOrderArticle->checkForStock( 999 ) );
    }

    public function testGetOrderArticle()
    {
        $oOrderArticle = new oxOrderArticle();
        $this->assertTrue( $oOrderArticle->UNITgetOrderArticle( "1126" ) instanceof oxarticle );
    }

    public function testGetSelectLists()
    {
        $oArticle = $this->getMock( "oxArticle", array( "getSelectLists" ) );
        $oArticle->expects( $this->once() )->method( 'getSelectLists')->will( $this->returnValue( "aSelectLists" ) );

        $oOrderArticle = $this->getMock( "oxOrderArticle", array( "_getOrderArticle" ) );
        $oOrderArticle->expects( $this->once() )->method( '_getOrderArticle')->will( $this->returnValue( $oArticle ) );

        $this->assertEquals( "aSelectLists", $oOrderArticle->getSelectLists() );
    }

    public function testSetIsNewOrderItemAndIsNewOrderItem()
    {
        $oOrderArticle = new oxOrderArticle();
        $this->assertFalse( $oOrderArticle->isNewOrderItem() );

        $oOrderArticle->setIsNewOrderItem( true );
        $this->assertTrue( $oOrderArticle->isNewOrderItem() );
    }

    public function testGetBasketPrice()
    {
        $oOrderArticle = $this->getMock( "oxOrderArticle", array( "getPrice" ) );
        $oOrderArticle->expects( $this->once() )->method( 'getPrice' )->will( $this->returnValue( 'oPrice' ) );

        $this->assertEquals( 'oPrice', $oOrderArticle->getBasketPrice( null, null, null ) );
    }

    public function testSkipDiscounts()
    {
        $oOrderArticle = new oxOrderArticle();
        $this->assertFalse( $oOrderArticle->skipDiscounts() );
    }

    public function testGetCategoryIdsNoArticleSet()
    {
        $oOrderArticle = new oxOrderArticle();
        $this->assertEquals( array(), $oOrderArticle->getCategoryIds( false, null ) );
    }

    public function getLanguage()
    {
        $oOrderArticle = new oxOrderArticle();
        $this->assertEquals( oxLang::getInstance()->getBaseLanguage(), $oOrderArticle->getLanguage() );
    }

   public function testGetPrice()
   {
       $oOrderArticle = new oxOrderArticle();
       $oOrderArticle->oxorderarticles__oxvat    = new oxField( 33 );
       $oOrderArticle->oxorderarticles__oxbprice = new oxField( 133 );

       $oPrice = new oxPrice();
       $oPrice->setBruttoPriceMode();
       $oPrice->setVat( 33 );
       $oPrice->setPrice( 133 );

       $this->assertEquals( $oPrice, $oOrderArticle->getPrice() );
   }

   public function testSetNewAmountNoArticleToLoad()
   {
       $oOrderArticle = $this->getMock( "oxOrderArticle", array( "updateArticleStock" ) );
       $oOrderArticle->expects( $this->never() )->method( 'updateArticleStock' );
       $oOrderArticle->oxorderarticles__oxamount = new oxField( 1 );

       $oOrderArticle->setNewAmount( 999 );

       $this->assertEquals( 1, $oOrderArticle->oxorderarticles__oxamount->value );
   }

   public function testSetNewAmount()
   {
       $oOrderArticle = $this->getMock( "oxOrderArticle", array( "updateArticleStock", "save" ) );
       $oOrderArticle->expects( $this->once() )->method( 'updateArticleStock' )->with( $this->equalTo( -989 ), false );
       $oOrderArticle->expects( $this->once() )->method( 'save' );
       $oOrderArticle->oxorderarticles__oxamount = new oxField( 10 );
       $oOrderArticle->oxorderarticles__oxartid  = new oxField( '_testArticleId' );

       $oOrderArticle->setNewAmount( 999 );

       $this->assertEquals( 999, $oOrderArticle->oxorderarticles__oxamount->value );
   }

   public function testSetNewAmountArticleStockControl()
   {
       modConfig::getInstance()->setConfigParam( 'blUseStock', true );

       // preparing test env.
       $oArticle = new oxArticle();
       $oArticle->load( '_testArticleId' );
       $oArticle->oxarticles__oxstockflag = new oxField( 3 );
       $oArticle->save();

       $oOrderArticle = $this->getMock( "oxOrderArticle", array( "updateArticleStock", "save" ) );
       $oOrderArticle->expects( $this->once() )->method( 'updateArticleStock' )->with( $this->equalTo( -10 ), false );
       $oOrderArticle->expects( $this->once() )->method( 'save' );
       $oOrderArticle->oxorderarticles__oxamount = new oxField( 10 );
       $oOrderArticle->oxorderarticles__oxartid  = new oxField( '_testArticleId' );

       $oOrderArticle->setNewAmount( 999 );

       $this->assertEquals( 20, $oOrderArticle->oxorderarticles__oxamount->value );
   }

   public function testSetNewAmountArticleStockControlDerceasingOrderAmount()
   {
       modConfig::getInstance()->setConfigParam( 'blUseStock', true );

       // preparing test env.
       $oArticle = new oxArticle();
       $oArticle->load( '_testArticleId' );
       $oArticle->oxarticles__oxstockflag = new oxField( 3 );
       $oArticle->save();

       $oOrderArticle = $this->getMock( "oxOrderArticle", array( "updateArticleStock", "save" ) );
       $oOrderArticle->expects( $this->once() )->method( 'updateArticleStock' )->with( $this->equalTo( 5 ), false );
       $oOrderArticle->expects( $this->once() )->method( 'save' );
       $oOrderArticle->oxorderarticles__oxamount = new oxField( 10 );
       $oOrderArticle->oxorderarticles__oxartid  = new oxField( '_testArticleId' );

       $oOrderArticle->setNewAmount( 5 );

       $this->assertEquals( 5, $oOrderArticle->oxorderarticles__oxamount->value );
   }

   public function testSetNewAmountArticleStockControlDerceasingOrderAmountToZero()
   {
       modConfig::getInstance()->setConfigParam( 'blUseStock', true );

       // preparing test env.
       $oArticle = new oxArticle();
       $oArticle->load( '_testArticleId' );
       $oArticle->oxarticles__oxstockflag = new oxField( 3 );
       $oArticle->save();

       $oOrderArticle = $this->getMock( "oxOrderArticle", array( "updateArticleStock", "save" ) );
       $oOrderArticle->expects( $this->once() )->method( 'updateArticleStock' )->with( $this->equalTo( 10 ), false );
       $oOrderArticle->expects( $this->once() )->method( 'save' );
       $oOrderArticle->oxorderarticles__oxamount = new oxField( 10 );
       $oOrderArticle->oxorderarticles__oxartid  = new oxField( '_testArticleId' );

       $oOrderArticle->setNewAmount( 0 );

       $this->assertEquals( 0, $oOrderArticle->oxorderarticles__oxamount->value );
   }

   public function testSetNewAmountArticleStockControlDerceasingOrderAmountToBelowZero()
   {
       modConfig::getInstance()->setConfigParam( 'blUseStock', true );

       // preparing test env.
       $oArticle = new oxArticle();
       $oArticle->load( '_testArticleId' );
       $oArticle->oxarticles__oxstockflag = new oxField( 3 );
       $oArticle->save();

       $oOrderArticle = $this->getMock( "oxOrderArticle", array( "updateArticleStock", "save" ) );
       $oOrderArticle->expects( $this->never() )->method( 'updateArticleStock' );
       $oOrderArticle->expects( $this->never() )->method( 'save' );
       $oOrderArticle->oxorderarticles__oxamount = new oxField( 10 );
       $oOrderArticle->oxorderarticles__oxartid  = new oxField( '_testArticleId' );

       $oOrderArticle->setNewAmount( -10 );

       $this->assertEquals( 10, $oOrderArticle->oxorderarticles__oxamount->value );
   }

    public function testMakeSelListArray()
    {
        $myDB = oxDb::getDb();

        modConfig::getInstance()->setConfigParam( 'bl_perfLoadSelectLists', true );

        $oSelList = oxNew( 'oxselectlist' );
        $oSelList->setId( '_testSelListId1' );
        $oSelList->oxselectlist__oxtitle = new oxField('Color', oxField::T_RAW);
        $oSelList->oxselectlist__oxvaldesc = new oxField('red!P!10__@@blue!P!10__@@green!P!10__@@', oxField::T_RAW);
        $oSelList->save();

        $oSelList->setId( '_testSelListId2' );
        $oSelList->oxselectlist__oxtitle = new oxField('Size', oxField::T_RAW);
        $oSelList->oxselectlist__oxvaldesc = new oxField('big!P!10__@@middle!P!10__@@small!P!10__@@', oxField::T_RAW);
        $oSelList->save();

        $sQ1 = 'insert into oxobject2selectlist values ("_testO2SlId1", "1126", "_testSelListId1", 1); ';
        $sQ2 = 'insert into oxobject2selectlist values ("_testO2SlId2", "1126", "_testSelListId2", 2); ';
        $myDB->Execute( $sQ1 );
        $myDB->Execute( $sQ2 );

        // test getting correct list and correct handling of letters case
        $sFields = "Color : BluE, size: small ";
        $oOrderArticle = new oxOrderArticle();
        $this->assertEquals( array(0=>1, 1=>2), $oOrderArticle->getOrderArticleSelectList('1126', $sFields) );

        // just one list must be returned
        $sFields = "Size : middle ";
        $oOrderArticle = new oxOrderArticle();
        $this->assertEquals( array(1=>1), $oOrderArticle->getOrderArticleSelectList('1126', $sFields) );

        // only existing list returned
        $sFields = "Color : red, Material : wood ";
        $oOrderArticle = new oxOrderArticle();
        $this->assertEquals( array(0=>0), $oOrderArticle->getOrderArticleSelectList('1126', $sFields) );
    }

    public function testMakeSelListArrayWithIncorectFieldInOrderArticle()
    {
        $myDB = oxDb::getDb();

        $oSelList = oxNew( 'oxselectlist' );
        $oSelList->setId( '_testSelListId3' );
        $oSelList->oxselectlist__oxtitle = new oxField('Color', oxField::T_RAW);
        $oSelList->oxselectlist__oxvaldesc = new oxField('red!P!10__@@blue!P!10__@@green!P!10__@@', oxField::T_RAW);
        $oSelList->save();

        $oSelList->setId( '_testSelListId4' );
        $oSelList->oxselectlist__oxtitle = new oxField('Size', oxField::T_RAW);
        $oSelList->oxselectlist__oxvaldesc = new oxField('big!P!10__@@middle!P!10__@@small!P!10__@@', oxField::T_RAW);
        $oSelList->save();

        $sQ1 = 'insert into oxobject2selectlist values ("_testO2SlId3", "1126", "_testSelListId3", 1); ';
        $sQ2 = 'insert into oxobject2selectlist values ("_testO2SlId4", "1126", "_testSelListId4", 2); ';
        $myDB->Execute( $sQ1 );
        $myDB->Execute( $sQ2 );

        $oOrderArticle = new oxOrderArticle();
        $sFields = "_______:::_______";
        $this->assertEquals( array(), $oOrderArticle->getOrderArticleSelectList('1126', $sFields) );
    }

    public function testMakeSelListArrayWithNoAssignedSelLists()
    {
        $oOrderArticle = new oxOrderArticle();
        $sFields = "Color : blue, Size : small ";

        $this->assertEquals( array(), $oOrderArticle->getOrderArticleSelectList('1127', $sFields) );
    }

    /*
     * Test loading order article
     */
    public function testLoadingOrderArticle()
    {
        $oOrderArticle = new oxorderarticle();
        $this->assertTrue( $oOrderArticle->load( '_testOrderArticleId' ) );

        $this->assertEquals("_testArticleId", $oOrderArticle->oxorderarticles__oxartid->value);
    }

    /*
     * test copying oxarticle fields to oxorderarticle fields
     */
    public function testCopyThis()
    {
        $oArticle = new oxarticle();
        $oArticle->load( '_testArticleId' );

        $oOrderArticle = oxNew( 'oxorderarticle' );
        $oOrderArticle->copyThis( $oArticle );

        $this->assertEquals( '_testArticleId', $oOrderArticle->oxorderarticles__oxid->value );

        $aObjectVars = get_object_vars( $oArticle );

        foreach ( $oArticle as $name => $value) {
            $sFieldName = preg_replace('/oxarticles__/', 'oxorderarticles__', $name);
            if ( isset( $oArticle->$name->value ) ) {
                  $this->assertEquals($oArticle->$name->value, $oOrderArticle->$sFieldName->value, 'oxArticle object was not coppied correctly');
            }
        }
    }

    /*
     * Testing if assign executes assign and persisten data setter
     */
    public function testAssignAddsPersistenInfo()
    {
        $oOrderArticle = $this->getMock( 'oxorderarticle', array( '_setDeprecatedValues') );
        $oOrderArticle->expects( $this->once() )->method( '_setDeprecatedValues');
        $oOrderArticle->load( '_testOrderArticleId' );
    }

    /*
     * Test updating article stock value
     */
    public function testUpdateArticleStock()
    {
        $oDB = oxDb::getDB();
        $oDB->getOne("update oxarticles set oxtimestamp = '2005-03-24 14:33:53' where oxid = '_testArticleId'");
        $this->_oOrderArticle->updateArticleStock( -3, false );

        $oArticle = oxNew( "oxarticle" );
        $oArticle->load( "_testArticleId" );

        $this->assertEquals( 7, $oArticle->oxarticles__oxstock->value );
        $this->assertNotEquals( '2005-03-24 14:33:53', $oDB->getOne("select oxtimestamp from oxarticles where oxid = '_testArticleId'") );
    }

    /*
     * Test updating article stock value when negative stock values is not allowed
     */
    public function testUpdateArticleStockWithNotAllowNegativeStockValue()
    {
        $this->_oOrderArticle->updateArticleStock( -15, false );

        $oArticle = oxNew( "oxarticle" );
        $oArticle->load( "_testArticleId");

        $this->assertEquals( 0, $oArticle->oxarticles__oxstock->value );
    }

    /*
     * Test updating article stock value when negative stock values is allowed
     */
    public function testUpdateArticleStockWithAllowNegativeStockValue()
    {
        $this->_oOrderArticle->updateArticleStock( -15, true );

        $oArticle = oxNew( "oxarticle" );
        $oArticle->load( "_testArticleId" );

        $this->assertEquals(-5, $oArticle->oxarticles__oxstock->value );
    }

    /*
     * Test updating arcticle stock updates arcticle sold amount
     */
    public function testUpdateArticleStockUpdatesArticleSoldAmount()
    {
        $this->_oOrderArticle->updateArticleStock( -3, false );

        $oArticle = oxNew( "oxarticle" );
        $oArticle->load( "_testArticleId" );

        $this->assertEquals( 3, $oArticle->oxarticles__oxsoldamount->value );
    }

    /*
     * Test getting article stock
     */
    public function testGetArtStock()
    {
        $this->assertEquals( 6, $this->_oOrderArticle->UNITgetArtStock(-4, false) );
        $this->assertEquals( 15, $this->_oOrderArticle->UNITgetArtStock(5, false) );
    }

    /*
     * Test getting article stock value when negative stock values is not allowed
     */
    public function testGetArtStockWithNotAllowNegativeValue()
    {
        $this->assertEquals( 0, $this->_oOrderArticle->UNITgetArtStock(-17, false) );
    }

    /*
     * Test getting article stock value when negative stock values is allowed
     */
    public function testGetArtStockWithAllowNegativeValue()
    {
        $this->assertEquals( -7, $this->_oOrderArticle->UNITgetArtStock(-17, true) );
    }


    /**
     * Testing persistent data getter
     */
    public function testGetPersParams()
    {
        $oOrderArticle = $this->getProxyClass( 'oxorderarticle' );
        $this->assertNull( $oOrderArticle->getPersParams() );
        $this->assertNull( $oOrderArticle->getNonPublicVar( '_aPersParam' ) );

        $aParams = array( "xxx", "yyy", "zzz" );
        $oOrderArticle->setPersParams( $aParams );
        $this->assertEquals( $aParams, $oOrderArticle->getPersParams() );
        $this->assertEquals( $aParams, $oOrderArticle->getNonPublicVar( '_aPersParam' ) );
    }

    /**
     * Testing persistent data setter
     */
    public function testSetPersParams()
    {
        $aParams = array( 'xxx', 'yyy', 'zzz' );

        $oOrderArticle = new oxorderarticle();
        $oOrderArticle->setPersParams( $aParams );

        $this->assertEquals( serialize( $aParams ), $oOrderArticle->oxorderarticles__oxpersparam->value );
    }

    /*
     * Test correct serializing and loading oxpersparam and oxerpstatus values
     */
    public function testSerializingValues()
    {
        $aTestArr = array("te\"st", "test2");
        $sParams = serialize( $aTestArr );

        $this->_oOrderArticle->oxorderarticles__oxpersparam = new oxField($sParams, oxField::T_RAW);
        $this->_oOrderArticle->oxorderarticles__oxerpstatus = new oxField($sParams, oxField::T_RAW);
        $this->_oOrderArticle->save();

        $oOrderArticle = new oxorderarticle();
        $oOrderArticle->load( '_testOrderArticleId' );


        $this->assertEquals( $aTestArr, $oOrderArticle->getPersParams() );
    }

    /*
     * Test setting deprecated values
     */
    public function testSetDeprecatedValues()
    {
        $aTestArr = array("test", "test2");
        $sParams = serialize( $aTestArr );

        $this->_oOrderArticle->oxorderarticles__oxpersparam = new oxField($sParams, oxField::T_RAW);
        $this->_oOrderArticle->oxorderarticles__oxerpstatus = new oxField($sParams, oxField::T_RAW);
        $this->_oOrderArticle->oxorderarticles__oxbrutprice = new oxField('123', oxField::T_RAW);
        $this->_oOrderArticle->oxorderarticles__oxbprice = new oxField('456', oxField::T_RAW);
        $this->_oOrderArticle->oxorderarticles__oxnprice = new oxField('789', oxField::T_RAW);
        $this->_oOrderArticle->save();

        $oOrderArticle = new oxorderarticle();
        $oOrderArticle->load( '_testOrderArticleId' );


        $this->assertEquals( $aTestArr, $oOrderArticle->aPersParam );
        $this->assertEquals( oxLang::getInstance()->formatCurrency('123'), $oOrderArticle->ftotbrutprice );
        $this->assertEquals( oxLang::getInstance()->formatCurrency('456'), $oOrderArticle->fbrutprice );
        $this->assertEquals( oxLang::getInstance()->formatCurrency('789'), $oOrderArticle->fnetprice );
    }

    /*
     * Test _setFieldData - correctly sets data type to T_RAW to oxpersparam and oxerpstatus fields
     * M #275
     */
    public function test_setFieldData()
    {
        $this->_oOrderArticle->oxorderarticles__oxpersparam = new oxField('" &', oxField::T_RAW);
        $this->_oOrderArticle->oxorderarticles__oxtitle     = new oxField('" &', oxField::T_RAW);

        $this->_oOrderArticle->save();

        $sSQL = "select * from oxorderarticles where oxid = '_testOrderArticleId' ";
        $rs = oxDb::getDb(true)->execute( $sSQL);

        $oOrderArticle = new oxorderarticle();
        $oOrderArticle->assign( $rs->fields ); // field names are in upercase

        $this->assertEquals( '" &', $oOrderArticle->oxorderarticles__oxpersparam->value );
        $this->assertEquals( '" &', $oOrderArticle->oxorderarticles__oxtitle->value );

    }

    function testGetWrapping()
    {
        oxTestModules::addFunction('oxwrapping', 'load($id)', '{if ($id=="a") return true; }');
        $o = new oxOrderArticle();

        $o->oxorderarticles__oxwrapid = new oxField('');
        $this->assertSame(null, $o->getWrapping());

        $o->oxorderarticles__oxwrapid = new oxField('not existing');
        $this->assertSame(null, $o->getWrapping());

        $o->oxorderarticles__oxwrapid = new oxField('a');
        $this->assertTrue($o->getWrapping() instanceof oxwrapping);
    }
}
