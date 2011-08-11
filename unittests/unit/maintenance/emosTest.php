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
 * @version   SVN: $Id: emosTest.php 38106 2011-08-10 14:21:54Z tomas $
 */

require_once realpath( "." ).'/unit/OxidTestCase.php';
require_once realpath( "." ).'/unit/test_config.inc.php';
require_once getShopBasePath().'/core/smarty/plugins/emos.php';

/**
 * Exposes protected methods for EMOS class
 *
 * @author Tomas Liubinas
 *
 */
class EmosTest extends EMOS
{
    /**
     * Returns protected property value
     *
     * @param mixed $mVar
     *
     * @return mixed
     */
    public function getProtected($mVar)
    {
        return $this->$mVar;
    }

    public function call_emos_ItemFormat($oItem)
    {
        return $this->_emos_ItemFormat($oItem);
    }

    public function call_emos_DataFormat( $sStrPre )
    {
        return $this->_emos_DataFormat( $sStrPre );
    }

    public function call_prepareScript()
    {
        return $this->_prepareScript();
    }

    public function call_setEmosECPageArray( $oItem, $sEvent )
    {
        return $this->_setEmosECPageArray( $oItem, $sEvent );
    }

    public function call_setEmosBillingArray( $sBillingId, $sCustomerNr, $iTotal, $sCountry, $sCipt, $sCity, $sArrayName)
    {
        return $this->_setEmosBillingArray( $sBillingId, $sCustomerNr, $iTotal, $sCountry, $sCipt, $sCity, $sArrayName );
    }
}

/**
 * Testing emos class
 */
class Unit_Maintenance_emosTest extends OxidTestCase
{
    /**
     * Test constructor.
     *
     * @return null
     */
    public function testConstruct()
    {
        $oEmos = new EmosTest( "xxx", "yyy" );

        $this->assertEquals( 'xxx', $oEmos->getProtected("_sPathToFile") );
        $this->assertEquals( 'yyy', $oEmos->getProtected("_sScriptFileName" ));
    }

    /**
     * Test item formating.
     *
     * @return null
     */
    public function testEmosItemFormat()
    {
        $oItem = new oxStdClass;
        $oItem->productId    = 'prodid';
        $oItem->productName  = 'prodname';
        $oItem->productGroup = 'prodgrp';
        $oItem->variant1 = 'var1';
        $oItem->variant2 = 'var2';
        $oItem->variant3 = 'var3';

        $oEmos = $this->getMock( 'EmosTest', array( '_emos_DataFormat' ) );
        $oEmos->expects( $this->at( 0 ) )->method( '_emos_DataFormat' )->with( $this->equalTo( 'prodid' ) )->will($this->returnValue( 'prodid' ) );
        $oEmos->expects( $this->at( 1 ) )->method( '_emos_DataFormat' )->with( $this->equalTo( 'prodname' ) )->will($this->returnValue( 'prodname' ) );
        $oEmos->expects( $this->at( 2 ) )->method( '_emos_DataFormat' )->with( $this->equalTo( 'prodgrp' ) )->will($this->returnValue( 'prodgrp' ) );
        $oEmos->expects( $this->at( 3 ) )->method( '_emos_DataFormat' )->with( $this->equalTo( 'var1' ) )->will($this->returnValue( 'var1' ) );
        $oEmos->expects( $this->at( 4 ) )->method( '_emos_DataFormat' )->with( $this->equalTo( 'var2' ) )->will($this->returnValue( 'var2' ) );
        $oEmos->expects( $this->at( 5 ) )->method( '_emos_DataFormat' )->with( $this->equalTo( 'var3' ) )->will($this->returnValue( 'var3' ) );

        $this->assertEquals( $oItem, $oEmos->call_emos_ItemFormat( $oItem ) );
    }

    /**
     * Test data formating.
     *
     * @return null
     */
    public function testEmosDataFormat()
    {
        $sStrPre = '  &amp;&quot;&gt;<a href="">ggg</a>&nbsp;\'"%;   / /';
        $sStrPos = '&>ggg//';

        $oEmos = new EmosTest;
        $this->assertEquals( $sStrPos, $oEmos->call_emos_DataFormat( $sStrPre ) );
    }

    /**
     * Test remove session id.
     *
     * @return null
     *//*
    public function testSetSidNoSidSet()
    {
        $oEmos = $this->getMock( 'EMos', array( 'appendPreScript' ) );
        $oEmos->expects( $this->never() )->method( 'appendPreScript' );
        $oEmos->setSid();

        $this->assertEquals( '', $oEmos->emsid );
    }*/

    /**
     * Test set session id.
     *
     * @return null
     *//*
    public function testSetSid()
    {
        $oEmos = $this->getMock( 'EMos', array( 'appendPreScript' ) );
        $oEmos->expects( $this->once() )->method( 'appendPreScript' )->with( $this->equalTo( "<a name=\"emos_sid\" title=\"xxx\"></a>\n" ) );
        $oEmos->setSid( 'xxx' );

        $this->assertEquals( 'xxx', $oEmos->emsid );
    }*/

    /**
     * Test remove version id.
     *
     * @return null
     *//*
    public function testSetVidNoSidSet()
    {
        $oEmos = $this->getMock( 'EMos', array( 'appendPreScript' ) );
        $oEmos->expects( $this->never() )->method( 'appendPreScript' );
        $oEmos->setVid();

        $this->assertEquals( '', $oEmos->emvid );
    }*/

    /**
     * Test set version id.
     *
     * @return null
     *//*
    public function testSetVid()
    {
        $oEmos = $this->getMock( 'EMos', array( 'appendPreScript' ) );
        $oEmos->expects( $this->once() )->method( 'appendPreScript' )->with( $this->equalTo( "<a name=\"emos_vid\" title=\"xxx\"></a>" ) );
        $oEmos->setVid( 'xxx' );

        $this->assertEquals( 'xxx', $oEmos->emvid );
    }*/

    /**
     * Test pretty print.
     *
     * @return null
     */
    public function testPrettyPrint()
    {
        $oEmos = new EmosTest();
        $this->assertEquals( "", $oEmos->getProtected("_br") );
        $this->assertEquals( "", $oEmos->getProtected("_tab") );
        $oEmos->prettyPrint();
        $this->assertEquals( "\n", $oEmos->getProtected("_br") );
        $this->assertEquals( "\t", $oEmos->getProtected("_tab") );
    }

    /**
     * Test append in script.
     *
     * @return null
     *//*
    public function testAppendInScript()
    {
        $oEmos = new EMOS( "xxx", "yyy" );
        $oEmos->appendInScript( 'xxx' );

        $this->assertEquals( "<script type=\"text/javascript\" src=\"xxxyyy\"></script>\nxxx", $oEmos->inScript );
    }*/

    /**
     * Test append pre script.
     *
     * @return null
     *//*
    public function testAppendPreScript()
    {
        $oEmos = new EMOS( "xxx", "yyy" );
        $oEmos->appendPreScript( 'xxx' );

        $this->assertEquals( "xxx", $oEmos->preScript );
    }*/

    /**
     * Test append post script.
     *
     * @return null
     *//*
    public function testAppendPostScript()
    {
        $oEmos = new EMOS( "xxx", "yyy" );
        $oEmos->appendPostScript( 'xxx' );

        $this->assertEquals( "xxx", $oEmos->postScript );
    }*/

    /**
     * Test EMOS::_prepareScript() method.
     *
     * @return null
     */
    public function testPrepareScript()
    {
        $oEmos = new EmosTest( "xxx", "yyy" );
        $oEmos->prettyPrint();
        $oEmos->call_prepareScript();

        $sRes = $oEmos->getProtected("_sIncScript");
        $sExpt = "<script type=\"text/javascript\" src=\"xxxyyy\"></script>\n";

        $this->assertEquals( $sExpt, $sRes);
    }

    /**
     * Test to string.
     *
     * @return null
     */
    public function testToString()
    {
        $oEmos = new EMOS( "xxx", "yyy" );
        //$oEmos->appendPreScript( 'pre' );
        //$oEmos->appendPostScript( 'post' );
        //$oEmos->jsFormatPrescript = "__JSPreScript__";
        //$oEmos->jsFormatScript = "__JSScript__";

        //$sExpt = "pre<script type=\"text/javascript\">window.emosTrackVersion = 2;</script>\n<script type=\"text/javascript\" src=\"xxxyyy\"></script>\n<script type=\"text/javascript\"><!--\n\tvar emospro = {};\n\twindow.emosPropertiesEvent(emospro);\n//-->\n</script>\npost";
        $sExpt = "<script type=\"text/javascript\">window.emosTrackVersion = 2;</script>\n<script type=\"text/javascript\" src=\"xxxyyy\"></script>\n<script type=\"text/javascript\"><!--\n\tvar emospro = {};\n\twindow.emosPropertiesEvent(emospro);\n//-->\n</script>\n";
        $oEmos->prettyPrint();
        $this->assertEquals( $sExpt, $oEmos->toString() );
    }

    /**
     * Test get anchor tag.
     *
     * @return null
     *//*
    public function testGetAnchorTag()
    {
        $oEmos = $this->getMock( 'EMos', array( 'emos_DataFormat' ) );
        $oEmos->expects( $this->at( 0 ) )->method( 'emos_DataFormat' )->with( $this->equalTo( "rel" ) )->will( $this->returnValue( "rel" ));
        $oEmos->expects( $this->at( 1 ) )->method( 'emos_DataFormat' )->with( $this->equalTo( "rev" ) )->will( $this->returnValue( "rev" ));

        $this->assertEquals( "<a name=\"emos_name\" title=\"title\" rel=\"rel\" rev=\"rev\"></a>\n", $oEmos->getAnchorTag( 'title', 'rel', 'rev' ) );
    }*/

    /**
     * Test add content.
     *
     * @return null
     */
    /*public function testAddContent()
    {
        $oEmos = $this->getMock( 'EMos', array( 'appendPreScript', 'getAnchorTag' ) );
        $oEmos->expects( $this->once() )->method( 'appendPreScript' )->with( $this->equalTo( "retvalue" ) );
        $oEmos->expects( $this->once() )->method( 'getAnchorTag' )->with( $this->equalTo( "content" ), $this->equalTo( "value" ) )->will( $this->returnValue( "retvalue" ));

        $oEmos->addContent( "value" );
    }*/

    /**
     * Test add order process.
     *
     * @return null
     */
    /*public function testAddOrderProcess()
    {
        $oEmos = $this->getMock( 'EMos', array( 'appendPreScript', 'getAnchorTag' ) );
        $oEmos->expects( $this->once() )->method( 'appendPreScript' )->with( $this->equalTo( "retvalue" ) );
        $oEmos->expects( $this->once() )->method( 'getAnchorTag' )->with( $this->equalTo( "orderProcess" ), $this->equalTo( "value" ) )->will( $this->returnValue( "retvalue" ));

        $oEmos->addOrderProcess( "value" );
    }*/

    /**
     * Test add site id.
     *
     * @return null
     *//*
    public function testAddSiteId()
    {
        $oEmos = $this->getMock( 'EMos', array( 'appendPreScript', 'getAnchorTag' ) );
        $oEmos->expects( $this->once() )->method( 'appendPreScript' )->with( $this->equalTo( "retvalue" ) );
        $oEmos->expects( $this->once() )->method( 'getAnchorTag' )->with( $this->equalTo( "siteid" ), $this->equalTo( "value" ) )->will( $this->returnValue( "retvalue" ));

        $oEmos->addSiteId( "value" );
    }*/

    /**
     * Test add language id.
     *
     * @return null
     *//*
    public function testAddLangId()
    {
        $oEmos = $this->getMock( 'EMos', array( 'appendPreScript', 'getAnchorTag' ) );
        $oEmos->expects( $this->once() )->method( 'appendPreScript' )->with( $this->equalTo( "retvalue" ) );
        $oEmos->expects( $this->once() )->method( 'getAnchorTag' )->with( $this->equalTo( "langid" ), $this->equalTo( "value" ) )->will( $this->returnValue( "retvalue" ));

        $oEmos->addLangId( "value" );
    }*/

    /**
     * Test add country id.
     *
     * @return null
     *//*
    public function testAddCountryId()
    {
        $oEmos = $this->getMock( 'EMos', array( 'appendPreScript', 'getAnchorTag' ) );
        $oEmos->expects( $this->once() )->method( 'appendPreScript' )->with( $this->equalTo( "retvalue" ) );
        $oEmos->expects( $this->once() )->method( 'getAnchorTag' )->with( $this->equalTo( "countryid" ), $this->equalTo( "value" ) )->will( $this->returnValue( "retvalue" ));

        $oEmos->addCountryId( "value" );
    }*/

    /**
     * Test add page id.
     *
     * @return null
     *//*
    public function testAddPageId()
    {
        $oEmos = $this->getMock( 'EMos', array( 'appendPreScript' ) );
        $oEmos->expects( $this->once() )->method( 'appendPreScript' )->with( $this->equalTo( "\n<script type=\"text/javascript\">\n window.emosPageId = 'value';\n</script>\n" ) );

        $oEmos->addPageId( "value" );
    }*/

    /**
     * Test add search.
     *
     * @return null
     *//*
    public function testAddSearch()
    {
        $oEmos = $this->getMock( 'EMos', array( 'appendPreScript', 'getAnchorTag' ) );
        $oEmos->expects( $this->once() )->method( 'appendPreScript' )->with( $this->equalTo( "retvalue" ) );
        $oEmos->expects( $this->once() )->method( 'getAnchorTag' )->with( $this->equalTo( "search" ), $this->equalTo( "value" ), $this->equalTo( "value2" ) )->will( $this->returnValue( "retvalue" ));

        $oEmos->addSearch( "value", "value2" );
    }*/

    /**
     * Test add register.
     *
     * @return null
     *//*
    public function testAddRegister()
    {
        $oEmos = $this->getMock( 'EMos', array( 'appendPreScript', 'getAnchorTag' ) );
        $oEmos->expects( $this->once() )->method( 'appendPreScript' )->with( $this->equalTo( "retvalue" ) );
        $oEmos->expects( $this->once() )->method( 'getAnchorTag' )->with( $this->equalTo( "register" ), $this->equalTo( md5( "value" ) ), $this->equalTo( "value2" ) )->will( $this->returnValue( "retvalue" ));

        $oEmos->addRegister( "value", "value2" );
    }*/

    /**
     * Test add download.
     *
     * @return null
     *//*
    public function testAddDownload()
    {
        $oEmos = $this->getMock( 'EMos', array( 'appendPreScript', 'getAnchorTag' ) );
        $oEmos->expects( $this->once() )->method( 'appendPreScript' )->with( $this->equalTo( "retvalue" ) );
        $oEmos->expects( $this->once() )->method( 'getAnchorTag' )->with( $this->equalTo( "download" ), $this->equalTo( "value" ) )->will( $this->returnValue( "retvalue" ));

        $oEmos->addDownload( "value" );
    }*/

    /**
     * Test get emos EC page array.
     *
     * @return null
     */
    public function testSetEmosECPageArray()
    {
        $oItem = new EMOS_Item();
        $oItem->productId     = 'productId';
        $oItem->productName   = 'product Name';
        $oItem->price         = 'price';
        $oItem->productGroup  = 'product\Group';
        $oItem->quantity = 'quantity';
        $oItem->variant1 = 'variant1';
        $oItem->variant2 = null;
        $oItem->variant3 = 'variant3';

        $oSubj = $this->getProxyClass("EMOS");
        $oSubj->UNITsetEmosECPageArray($oItem, "testEvent");
        $aExpt = array(array("testEvent", 'productId', 'product Name', 'price', 'product\Group', 'quantity', 'variant1', '', 'variant3'));
        $this->assertEquals( $aExpt, $oSubj->getNonPublicVar("_ecEvent"));
    }

    /**
     * Test add detail view.
     *
     * @return null
     *//*
    public function testAddDetailView()
    {
        $oEmos = $this->getMock( 'EMos', array( 'getEmosECPageArray', 'appendPreScript' ) );
        $oEmos->expects( $this->once() )->method( 'getEmosECPageArray' )->with( $this->equalTo( 'value' ), $this->equalTo( 'view' ) )->will( $this->returnValue( 'retval' ) );
        $oEmos->expects( $this->once() )->method( 'appendPreScript' )->with( $this->equalTo( 'retval' ) );

        $oEmos->addDetailView( 'value' );
    }*/

    /**
     * Test remove from basket.
     *
     * @return null
     *//*
    public function testRemoveFromBasket()
    {
        $oEmos = $this->getMock( 'EMos', array( 'getEmosECPageArray', 'appendPreScript' ) );
        $oEmos->expects( $this->once() )->method( 'getEmosECPageArray' )->with( $this->equalTo( 'value' ), $this->equalTo( 'c_rmv' ) )->will( $this->returnValue( 'retval' ) );
        $oEmos->expects( $this->once() )->method( 'appendPreScript' )->with( $this->equalTo( 'retval' ) );

        $oEmos->removeFromBasket( 'value' );
    }*/

    /**
     * Test add to basket.
     *
     * @return null
     *//*
    public function testAddToBasket()
    {
        $oEmos = $this->getMock( 'EMos', array( 'getEmosECPageArray', 'appendPreScript' ) );
        $oEmos->expects( $this->once() )->method( 'getEmosECPageArray' )->with( $this->equalTo( 'value' ), $this->equalTo( 'c_add' ) )->will( $this->returnValue( 'retval' ) );
        $oEmos->expects( $this->once() )->method( 'appendPreScript' )->with( $this->equalTo( 'retval' ) );

        $oEmos->addToBasket( 'value' );
    }*/

    /**
     * Test get emos custom page array.
     *
     * @return null
     *//*
    public function testGetEmosCustomPageArray()
    {
        $sValue = "<script type=\"text/javascript\">\n".
        "<!--\n".
        "\t var emosCustomPageArray = new Array();\n".
        "\t emosCustomPageArray[0] = 'value0';\n".
        "\t emosCustomPageArray[1] = 'value1';\n".
        "// -->\n" ."</script>\n";

        $aListOfValues = array( 'value0', 'value1' );

        $oEmos = $this->getMock( 'EMos', array( 'emos_DataFormat' ) );
        $oEmos->expects( $this->at( 0 ) )->method( 'emos_DataFormat' )->with( $this->equalTo( 'value0' ) )->will( $this->returnValue( 'value0' ) );
        $oEmos->expects( $this->at( 1 ) )->method( 'emos_DataFormat' )->with( $this->equalTo( 'value1' ) )->will( $this->returnValue( 'value1' ) );

        $this->assertEquals( $sValue, $oEmos->getEmosCustomPageArray( $aListOfValues ) );
    }*/

    /**
     * Test add emos custom page array.
     *
     * @return null
     *//*
    public function testAddEmosCustomPageArray()
    {
        $aValues = array( 0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13 );

        $oEmos = $this->getMock( 'EMos', array( 'getEmosCustomPageArray', 'appendPreScript' ) );
        $oEmos->expects( $this->once() )->method( 'getEmosCustomPageArray' )->with( $this->equalTo( $aValues ) )->will( $this->returnValue( 'retval' ) );
        $oEmos->expects( $this->once() )->method( 'appendPreScript' )->with( $this->equalTo( 'retval' ) );

        $oEmos->addEmosCustomPageArray( 0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13 );
    }*/

    /**
     * Test get emos EC event.
     *
     * @return null
     *//*
    public function testGetEmosECEvent()
    {
        $oItem = new oxStdClass;
        $oItem->productId = 'productId';
        $oItem->productName = 'productName';
        $oItem->price = 'price';
        $oItem->productGroup = 'productGroup';
        $oItem->quantity = 'quantity';
        $oItem->variant1 = 'variant1';
        $oItem->variant2 = 'variant2';
        $oItem->variant3 = 'variant3';

        $sValue = "emos_ecEvent('event'," .
        "'productId'," .
        "'productName'," .
        "'price'," .
        "'productGroup'," .
        "'quantity'," .
        "'variant1'" .
        "'variant2'" .
        "'variant3');";

        $oEmos = $this->getMock( 'EMos', array( 'emos_ItemFormat' ) );
        $oEmos->expects( $this->once() )->method( 'emos_ItemFormat' )->with( $this->equalTo( $oItem ) )->will( $this->returnValue( $oItem ) );

        $this->assertEquals( $sValue, $oEmos->getEmosECEvent( $oItem, 'event' ) );
    }*/

    /**
     * Test get emos view event.
     *
     * @return null
     *//*
    public function testGetEmosViewEvent()
    {
        $oEmos = $this->getMock( 'EMos', array( 'getEmosECEvent' ) );
        $oEmos->expects( $this->once() )->method( 'getEmosECEvent' )->with( $this->equalTo( 'value' ) )->will( $this->returnValue( 'retval' ) );

        $this->assertEquals( 'retval', $oEmos->getEmosViewEvent( 'value' ) );
    }*/

    /**
     * Test get emos add to basket event.
     *
     * @return null
     *//*
    public function testGetEmosAddToBasketEvent()
    {
        $oEmos = $this->getMock( 'EMos', array( 'getEmosECEvent' ) );
        $oEmos->expects( $this->once() )->method( 'getEmosECEvent' )->with( $this->equalTo( 'value' ), $this->equalTo( 'c_add' ) )->will( $this->returnValue( 'retval' ) );

        $this->assertEquals( 'retval', $oEmos->getEmosAddToBasketEvent( 'value' ) );
    }*/

    /**
     * Test get remove from basket event.
     *
     * @return null
     *//*
    public function testGetRemoveFromBasketEvent()
    {
        $oEmos = $this->getMock( 'EMos', array( 'getEmosECEvent' ) );
        $oEmos->expects( $this->once() )->method( 'getEmosECEvent' )->with( $this->equalTo( 'value' ), $this->equalTo( 'c_rmv' ) )->will( $this->returnValue( 'retval' ) );

        $this->assertEquals( 'retval', $oEmos->getRemoveFromBasketEvent( 'value' ) );
    }*/

    /**
     * Test get emos billing event array.
     *
     * @return null
     *//*
    public function testGetEmosBillingEventArray()
    {
        $oEmos = $this->getMock( 'EMos', array( 'getEmosBillingArray' ) );
        $oEmos->expects( $this->once() )->method( 'getEmosBillingArray' )->with( $this->equalTo( 'billingID'), $this->equalTo( 'customerNumber'), $this->equalTo( 'total'), $this->equalTo( 'country'), $this->equalTo( 'cip'), $this->equalTo( 'city'), $this->equalTo( "emosBillingArray" ) )->will( $this->returnValue( 'retval' ) );

        $this->assertEquals( 'retval', $oEmos->getEmosBillingEventArray( 'billingID', 'customerNumber', 'total', 'country', 'cip', 'city' ) );
    }*/

    /**
     * Test get emos basket event array.
     *
     * @return null
     *//*
    public function testGetEMOSBasketEventArray()
    {
        $oEmos = $this->getMock( 'EMos', array( 'getEmosBasketArray' ) );
        $oEmos->expects( $this->once() )->method( 'getEmosBasketArray' )->with( $this->equalTo( 'value' ), $this->equalTo( "emosBasketArray"  ) )->will( $this->returnValue( 'retval' ) );

        $this->assertEquals( 'retval', $oEmos->getEMOSBasketEventArray( 'value' ) );
    }*/

    /**
     * tests EMOS::prepareJsFormat() method. Sets internal params.
     *
     * @return null
     */
    public function testPrepareScriptExt()
    {
        $oEmos = $this->getProxyClass("EMOS");
        $oEmos->setNonPublicVar("_content", "testContents");
        $oEmos->UNITprepareScript();
        $sRes1 = $oEmos->getNonPublicVar("_sPrescript");
        $sRes2 = $oEmos->getNonPublicVar("_sPostscript");

        $this->assertContains("window.emosTrackVersion", $sRes1);
        $this->assertContains("window.emosPropertiesEvent(emospro)", $sRes2);
        $this->assertContains("var emospro = {};", $sRes2);
        $this->assertContains("content = \"testContents\"", $sRes2);
    }

    /**
     * tests EMOS::prepareJsFormat() method.
     *
     * @return null
     */
    public function testPrepareScriptNotContains()
    {
        $oEmos = $this->getProxyClass("EMOS");
        $oEmos->UNITprepareScript();
        $sRes1 = $oEmos->getNonPublicVar("_sPrescript");
        $sRes2 = $oEmos->getNonPublicVar("_sPostscript");

        $this->assertContains("window.emosTrackVersion", $sRes1);
        $this->assertContains("window.emosPropertiesEvent(emospro)", $sRes2);
        $this->assertContains("var emospro = {};", $sRes2);
        $this->assertNotContains("contents", $sRes2);
    }

    /**
     * Tests EMOS::_addJsFormat method.
     *
     * @return null
     */
    public function testAddJsFormat()
    {
       $oSubj = $this->getProxyClass("EMOS");
       $sRes = $oSubj->UNITaddJsFormat("contents", '111');
       $this->assertContains("emospro.contents = \"111\"", $sRes);

       $sRes = $oSubj->UNITaddJsFormat("contents", 111, true);
       $this->assertContains("emospro.contents = 111", $sRes);
    }

    /**
     * Tests EMOS::_addJsFormat method.
     *
     * @return null
     */
    public function testAddJsFormatArray()
    {
       $oSubj = $this->getProxyClass("EMOS");
       $sRes = $oSubj->UNITaddJsFormat("contents", array('111'));
       $this->assertContains("emospro.contents = [\"111\"]", $sRes);

       $sRes = $oSubj->UNITaddJsFormat("contents", array('111', '222'), true);
       $this->assertContains("emospro.contents = [\"111\",\"222\"]", $sRes);
    }

    /**
     * Tests EMOS::_addJsFormat method.
     *
     * @return null
     */
    public function testAddJsFormatNoQuotes()
    {
       $oSubj = $this->getProxyClass("EMOS");
       $sRes = $oSubj->UNITaddJsFormat("contents", 111);
       $this->assertContains("emospro.contents = 111", $sRes);

       $sRes = $oSubj->UNITaddJsFormat("contents", array(111, 222), true);
       $this->assertContains("emospro.contents = [111,222]", $sRes);
    }

    /**
     * Tests EMOS::_addJsFormat method.
     *
     * @return null
     */
    public function testAddJsFormatEmpty()
    {
       $oSubj = $this->getProxyClass("EMOS");
       $sRes = $oSubj->UNITaddJsFormat("contents", null);
       $this->assertNull($sRes);
    }


    /**
     * Tests EMOS::_addJsFormat method. Zero suplied
     *
     * @return null
     */
    public function testAddJsFormatZero()
    {
       $oSubj = $this->getProxyClass("EMOS");
       $sRes = $oSubj->UNITaddJsFormat("contents", '0');
       $this->assertContains("emospro.contents = \"0\"", $sRes);

       $sRes = $oSubj->UNITaddJsFormat("contents", 0);
       $this->assertContains("emospro.contents = 0", $sRes);
    }

    /**
     * Tests EMOS::_addJsFormat method. Special char test for bug #3105
     *
     * @return null
     */
    public function testAddJsSpaceChar()
    {
       $oSubj = $this->getProxyClass("EMOS");
       $sRes = $oSubj->UNITaddJsFormat("contents", '0 0');
       $this->assertContains("emospro.contents = \"0 0\"", $sRes);
    }

    /**
     * Tests EMOS::addContent() method. Checking refactored behaviour
     *
     * @return null
     */
    public function testAddContentRefactored()
    {
       $oSubj = new EMOS();

       $oSubj->addContent("Test test");
       $sRes = $oSubj->toString();

       $this->assertContains("emospro.content = \"Test test\";", $sRes);
    }

    /**
     * Tests EMOS::addContact() method. Checking refactored behaviour.
     *
     * @return null
     */
    public function testAddContactRefactored()
    {
       $oSubj = new EMOS();

       $oSubj->addContact("Test test");
       $sRes = $oSubj->toString();

       $this->assertContains("emospro.scontact = \"Test test\";", $sRes);
    }

    /**
     * Tests EMOS::addCountryId() method. Checking refactored behaviour.
     *
     * @return null
     */
    public function testAddCountryIdRefactored()
    {
       $oSubj = new EMOS();

       $oSubj->addCountryId(15);
       $sRes = $oSubj->toString();

       $this->assertContains("emospro.countryid = 15;", $sRes);
    }

    /**
     * Tests EMOS::addPageId() method. Checking refactored behaviour.
     *
     * @return null
     */
    public function testAddPageIdRefactored()
    {
       $oSubj = new EMOS();

       $oSubj->addPageId("123");
       $sRes = $oSubj->toString();

       $this->assertContains("emospro.pageid = \"123\";", $sRes);
    }

    /**
     * Tests EMOS::addRegister() method. Checking refactored behaviour.
     *
     * @return null
     */
    public function testAddRegisterRefactored()
    {
       $oSubj = new EMOS();

       $oSubj->addRegister("testUser", 1);
       $sRes = $oSubj->toString();
       $this->assertContains("emospro.register = [[\"33ef37db24f3a27fb520847dcd549e9f\",1]];", $sRes);
    }

    /**
     * Tests EMOS::addRegister() method. Checking refactored behaviour.
     *
     * @return null
     */
    public function testAddLoginRefactored()
    {
       $oSubj = new EMOS();

       $oSubj->addLogin("testUser", 1);
       $sRes = $oSubj->toString();
       $this->assertContains("emospro.login = [[\"33ef37db24f3a27fb520847dcd549e9f\",1]];", $sRes);
    }

    /**
     * Tests EMOS::addSearch() method. Checking refactored behaviour.
     *
     * @return null
     */
    public function testAddSearchRefactored()
    {
       $oSubj = new EMOS();

       $oSubj->addSearch("Test search", 15);
       $sRes = $oSubj->toString();
       $this->assertContains("emospro.search = [[\"Test search\",15]];", $sRes);
    }

    /**
     * Tests EMOS::addSiteId() method. Checking refactored behaviour
     *
     * @return null
     */
    public function testAddSiteIdRefactored()
    {
       $oSubj = new EMOS();

       $oSubj->addSiteId(1);
       $sRes = $oSubj->toString();

       $this->assertContains("emospro.siteid = 1;", $sRes);
    }

    /**
     * Tests EMOS::addDownload() method. Checking refactored behaviour
     *
     * @return null
     */
    public function testAddDownloadRefactored()
    {
       $oSubj = new EMOS();

       $oSubj->addDownload("testDownlod");
       $sRes = $oSubj->toString();

       $this->assertContains('emospro.download = "testDownlod";', $sRes);
    }

    /**
     * Tests EMOS::addToBasket() method. Checking refactored behaviour.
     *
     * @return null
     */
    public function testAddToBasketRefactored()
    {
       $oSubj = new EMOS();

       $oItem = new EMOS_Item();
       $oItem->productId = "123";
       $oItem->productName = "Test product";
       $oItem->price = 46.50;
       $oItem->productGroup = "Test/Category/";
       $oItem->quantity = 13;
       $oItem->variant1 = "var1";
       $oItem->variant2 = null;
       $oItem->variant3 = "var3";

       $oSubj->addToBasket($oItem);
       $sRes = $oSubj->toString();

       $sExpt = 'emospro.ec_Event = [["c_add","123","Test product",46.5,"Test\/Category\/",13,"var1",null,"var3"]];';
       $this->assertContains($sExpt, $sRes);
    }

    /**
     * Tests remove item from basket event.
     *
     * @return null
     */
    public function testRemoveFromBasketRefactored()
    {
       $oSubj = new EMOS();

       $oItem = new EMOS_Item();
       $oItem->productId = "123";
       $oItem->productName = "Test product";
       $oItem->price = 46.50;
       $oItem->productGroup = "Test/Category/";
       $oItem->quantity = 13;
       $oItem->variant1 = "var1";
       $oItem->variant2 = null;
       $oItem->variant3 = "var3";

       $oSubj->removeFromBasket($oItem);
       $sRes = $oSubj->toString();

       $sExpt = 'emospro.ec_Event = [["c_rmv","123","Test product",46.5,"Test\/Category\/",13,"var1",null,"var3"]];';
       $this->assertContains($sExpt, $sRes);
    }

    /**
     * Tests buy items event.
     *
     * @return null
     */
    public function testAddEmosBasketPageArrayRefactored()
    {
       $oSubj = new EMOS();

       $oItem1 = new EMOS_Item();
       $oItem1->productId = "1";
       $oItem1->productName = "Prod 1";
       $oItem1->price = 46.50;
       $oItem1->productGroup = "Test/Cat 1/";
       $oItem1->quantity = 13;
       $oItem1->variant1 = "var11";
       $oItem1->variant2 = null;
       $oItem1->variant3 = "var13";

       $oItem2 = new EMOS_Item();
       $oItem2->productId = "2";
       $oItem2->productName = "Prod 2";
       $oItem2->price = 46.51;
       $oItem2->productGroup = "Test/Cat 2/";
       $oItem2->quantity = 13;
       $oItem2->variant1 = null;
       $oItem2->variant2 = null;
       $oItem2->variant3 = "var3";

       $aBasket = array($oItem1, $oItem2);

       $oSubj->addEmosBasketPageArray($aBasket);
       $sRes = $oSubj->toString();

       $sExpt = 'emospro.ec_Event = [["buy","1","Prod 1",46.5,"Test\/Cat 1\/",13,"var11",null,"var13"],["buy","2","Prod 2",46.51,"Test\/Cat 2\/",13,null,null,"var3"]];';
       $this->assertContains($sExpt, $sRes);
    }

    /**
     * Tests EMOS::addDetailView() method. Checking refactored behaviour.
     *
     * @return null
     */
    public function testAddDetailViewRefactored()
    {
       $oSubj = new EMOS();

       $oItem = new EMOS_Item();
       $oItem->productId = "123";
       $oItem->productName = "Test product";
       $oItem->price = 46.50;
       $oItem->productGroup = "Test/Category/";
       $oItem->quantity = 13;
       $oItem->variant1 = "var1";
       $oItem->variant2 = null;
       $oItem->variant3 = "var3";

       $oSubj->addDetailView($oItem);
       $sRes = $oSubj->toString();
       $sExpt = 'emospro.ec_Event = [["view","123","Test product",46.5,"Test\/Category\/",13,"var1",null,"var3"]];';
       $this->assertContains($sExpt, $sRes);
    }

    /**
     * Tests EMOS::_jsEncode() method. For String.
     *
     * @return null
     */
    public function testJsEncodeString()
    {
       $oSubj = $this->getProxyClass("EMOS");

       $mInput = "Test";
       $sExpt = '"Test"';
       $sRes = $oSubj->UNITjsEncode($mInput);
       $this->assertEquals($sExpt, $sRes);
    }

    /**
     * Tests EMOS::_jsEncode() method.
     *
     * @return null
     */
    public function testJsEncodeStringSpecialChars()
    {
       $oSubj = $this->getProxyClass("EMOS");

       $mInput = "Test test";
       $sExpt = '"Test test"';
       $sRes = $oSubj->UNITjsEncode($mInput);
       $this->assertEquals($sExpt, $sRes);

       $mInput = "Test/test";
       $sExpt = '"Test\/test"';
       $sRes = $oSubj->UNITjsEncode($mInput);
       $this->assertEquals($sExpt, $sRes);

       $mInput = "Test\"test";
       $sExpt = '"Test\"test"';
       $sRes = $oSubj->UNITjsEncode($mInput);
       $this->assertEquals($sExpt, $sRes);

       $mInput = "Test'test";
       $sExpt = '"Test\'test"';
       $sRes = $oSubj->UNITjsEncode($mInput);
       $this->assertEquals($sExpt, $sRes);
    }

    /**
     * Tests EMOS::_jsEncode() method. For arrays.
     *
     * @return null
     */
    public function testJsEncodeArray()
    {
       $oSubj = $this->getProxyClass("EMOS");

       $mInput = array("one", 2, 3 => "four", );
       $sExpt = '{"0":"one","1":2,"3":"four"}';
       $sRes = $oSubj->UNITjsEncode($mInput);

       $this->assertEquals($sExpt, $sRes);
    }

    /**
     * Tests EMOS::_jsEncode() method. For associative arrays.
     *
     * @return null
     */
    public function testJsEncodeArrayAssoc()
    {
       $oSubj = $this->getProxyClass("EMOS");

       $mInput = array("a" => "one", 2, "three" => "four");
       $sExpt = '{"a":"one","0":2,"three":"four"}';
       $sRes = $oSubj->UNITjsEncode($mInput);

       $this->assertEquals($sExpt, $sRes);
    }

    /**
     * Tests EMOS::_jsEncode() method. Multidimensional arrays
     *
     * @return null
     */
    public function testJsEncodeArrayArray()
    {
       $oSubj = $this->getProxyClass("EMOS");

       $mInput = Array(array("one", 23), array("four five", 6), 7);
       $sExpt = '[["one",23],["four five",6],7]';
       $sRes = $oSubj->UNITjsEncode($mInput);

       $this->assertEquals($sExpt, $sRes);
    }

    /**
     * Tests EMOS::_jsEncode() method. Null case.
     *
     * @return null
     */
    public function testJsEncodeNull()
    {
       $oSubj = $this->getProxyClass("EMOS");

       $mInput = NULL;
       $sExpt = 'null';
       $sRes = $oSubj->UNITjsEncode($mInput);

       $this->assertEquals($sExpt, $sRes);
    }

    /**
     * Tests EMOS::addEmosBillingPageArray() method.
     *
     * @return null
     */
    public function testAddEmosBillingPageArray()
    {
        $oSubj = new EMOS();
        $oSubj->addEmosBillingPageArray("sBillingId", "sCustomerNumber", 0, "de", "cip", "Halle");

        $sRes = $oSubj->toString();
        $sExpt = 'emospro.billing = [["sBillingId","4b6f45defafe0ed53345cad1b77205bd","de\/c\/ci\/Halle\/cip",0]];';

        $this->assertContains($sExpt, $sRes);
    }
}
