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
 * @version   SVN: $Id: emosTest.php 26841 2010-03-25 13:58:15Z arvydas $
 */

require_once realpath( "." ).'/unit/OxidTestCase.php';
require_once realpath( "." ).'/unit/test_config.inc.php';
require_once getShopBasePath().'/core/smarty/plugins/emos.php';

/**
 * Testing emos class
 */
class Unit_Maintenance_emosTest extends OxidTestCase
{
    /**
     * Test decode special chars for php4.
     *
     * @return null
     */
    public function testHtmlSpecialCharsDecodePhp4()
    {
        $sStr = '<p>this -&gt; &quot;</p>';

        $oEmos = new EMOS;
        $this->assertEquals( htmlspecialchars_decode( $sStr ), $oEmos->htmlspecialchars_decode_php4( $sStr ) );
    }

    /**
     * Test constructor.
     *
     * @return null
     */
    public function testConstruct()
    {
        $oEmos = new EMOS( "xxx", "yyy" );

        $this->assertEquals( 'xxx', $oEmos->pathToFile );
        $this->assertEquals( 'yyy', $oEmos->scriptFileName );
        $this->assertEquals( "<script type=\"text/javascript\" src=\"xxxyyy\"></script>\n", $oEmos->inScript );
    }

    /**
     * Test item formating.
     *
     * @return null
     */
    public function testEmosItemFormat()
    {
        $oItem = new oxStdClass;
        $oItem->productID    = 'prodid';
        $oItem->productName  = 'prodname';
        $oItem->productGroup = 'prodgrp';
        $oItem->variant1 = 'var1';
        $oItem->variant2 = 'var2';
        $oItem->variant3 = 'var3';

        $oEmos = $this->getMock( 'EMos', array( 'emos_DataFormat' ) );
        $oEmos->expects( $this->at( 0 ) )->method( 'emos_DataFormat' )->with( $this->equalTo( 'prodid' ) )->will($this->returnValue( 'prodid' ) );
        $oEmos->expects( $this->at( 1 ) )->method( 'emos_DataFormat' )->with( $this->equalTo( 'prodname' ) )->will($this->returnValue( 'prodname' ) );
        $oEmos->expects( $this->at( 2 ) )->method( 'emos_DataFormat' )->with( $this->equalTo( 'prodgrp' ) )->will($this->returnValue( 'prodgrp' ) );
        $oEmos->expects( $this->at( 3 ) )->method( 'emos_DataFormat' )->with( $this->equalTo( 'var1' ) )->will($this->returnValue( 'var1' ) );
        $oEmos->expects( $this->at( 4 ) )->method( 'emos_DataFormat' )->with( $this->equalTo( 'var2' ) )->will($this->returnValue( 'var2' ) );
        $oEmos->expects( $this->at( 5 ) )->method( 'emos_DataFormat' )->with( $this->equalTo( 'var3' ) )->will($this->returnValue( 'var3' ) );

        $this->assertEquals( $oItem, $oEmos->emos_ItemFormat( $oItem ) );
    }

    /**
     * Test data formating.
     *
     * @return null
     */
    public function testEmosDataFormat()
    {
        $sStrPre = '%20%20&amp;&quot;&gt;<a href="">ggg</a>&nbsp;\'"%;   / /';
        $sStrPos = rawurlencode( '&>ggg//' );

        $oEmos = new EMOS;
        $this->assertEquals( $sStrPos, $oEmos->emos_DataFormat( $sStrPre ) );
    }

    /**
     * Test remove session id.
     *
     * @return null
     */
    public function testSetSidNoSidSet()
    {
        $oEmos = $this->getMock( 'EMos', array( 'appendPreScript' ) );
        $oEmos->expects( $this->never() )->method( 'appendPreScript' );
        $oEmos->setSid();

        $this->assertEquals( '', $oEmos->emsid );
    }

    /**
     * Test set session id.
     *
     * @return null
     */
    public function testSetSid()
    {
        $oEmos = $this->getMock( 'EMos', array( 'appendPreScript' ) );
        $oEmos->expects( $this->once() )->method( 'appendPreScript' )->with( $this->equalTo( "<a name=\"emos_sid\" title=\"xxx\"></a>\n" ) );
        $oEmos->setSid( 'xxx' );

        $this->assertEquals( 'xxx', $oEmos->emsid );
    }

    /**
     * Test remove version id.
     *
     * @return null
     */
    public function testSetVidNoSidSet()
    {
        $oEmos = $this->getMock( 'EMos', array( 'appendPreScript' ) );
        $oEmos->expects( $this->never() )->method( 'appendPreScript' );
        $oEmos->setVid();

        $this->assertEquals( '', $oEmos->emvid );
    }

    /**
     * Test set version id.
     *
     * @return null
     */
    public function testSetVid()
    {
        $oEmos = $this->getMock( 'EMos', array( 'appendPreScript' ) );
        $oEmos->expects( $this->once() )->method( 'appendPreScript' )->with( $this->equalTo( "<a name=\"emos_vid\" title=\"xxx\"></a>" ) );
        $oEmos->setVid( 'xxx' );

        $this->assertEquals( 'xxx', $oEmos->emvid );
    }

    /**
     * Test pretty print.
     *
     * @return null
     */
    public function testPrettyPrint()
    {
        $oEmos = new EMOS;
        $oEmos->prettyPrint();

        $this->assertEquals( "\n\n", $oEmos->br );
        $this->assertEquals( "\t\t", $oEmos->tab );
    }

    /**
     * Test append in script.
     *
     * @return null
     */
    public function testAppendInScript()
    {
        $oEmos = new EMOS( "xxx", "yyy" );
        $oEmos->appendInScript( 'xxx' );

        $this->assertEquals( "<script type=\"text/javascript\" src=\"xxxyyy\"></script>\nxxx", $oEmos->inScript );
    }

    /**
     * Test append pre script.
     *
     * @return null
     */
    public function testAppendPreScript()
    {
        $oEmos = new EMOS( "xxx", "yyy" );
        $oEmos->appendPreScript( 'xxx' );

        $this->assertEquals( "xxx", $oEmos->preScript );
    }

    /**
     * Test append post script.
     *
     * @return null
     */
    public function testAppendPostScript()
    {
        $oEmos = new EMOS( "xxx", "yyy" );
        $oEmos->appendPostScript( 'xxx' );

        $this->assertEquals( "xxx", $oEmos->postScript );
    }

    /**
     * Test prepare in script.
     *
     * @return null
     */
    public function testPrepareInScript()
    {
        $oEmos = new EMOS( "xxx", "yyy" );
        $oEmos->prepareInScript();

        $this->assertEquals( "<script type=\"text/javascript\" src=\"xxxyyy\"></script>\n<script type=\"text/javascript\" src=\"xxxyyy\"></script>\n", $oEmos->inScript );
    }

    /**
     * Test to string.
     *
     * @return null
     */
    public function testToString()
    {
        $oEmos = new EMOS( "xxx", "yyy" );
        $oEmos->appendPreScript( 'pre' );
        $oEmos->appendPostScript( 'post' );

        $this->assertEquals( "pre<script type=\"text/javascript\" src=\"xxxyyy\"></script>\npost", $oEmos->toString() );
    }

    /**
     * Test get anchor tag.
     *
     * @return null
     */
    public function testGetAnchorTag()
    {
        $oEmos = $this->getMock( 'EMos', array( 'emos_DataFormat' ) );
        $oEmos->expects( $this->at( 0 ) )->method( 'emos_DataFormat' )->with( $this->equalTo( "rel" ) )->will( $this->returnValue( "rel" ));
        $oEmos->expects( $this->at( 1 ) )->method( 'emos_DataFormat' )->with( $this->equalTo( "rev" ) )->will( $this->returnValue( "rev" ));

        $this->assertEquals( "<a name=\"emos_name\" title=\"title\" rel=\"rel\" rev=\"rev\"></a>\n", $oEmos->getAnchorTag( 'title', 'rel', 'rev' ) );
    }

    /**
     * Test add content.
     *
     * @return null
     */
    public function testAddContent()
    {
        $oEmos = $this->getMock( 'EMos', array( 'appendPreScript', 'getAnchorTag' ) );
        $oEmos->expects( $this->once() )->method( 'appendPreScript' )->with( $this->equalTo( "retvalue" ) );
        $oEmos->expects( $this->once() )->method( 'getAnchorTag' )->with( $this->equalTo( "content" ), $this->equalTo( "value" ) )->will( $this->returnValue( "retvalue" ));

        $oEmos->addContent( "value" );
    }

    /**
     * Test add order process.
     *
     * @return null
     */
    public function testAddOrderProcess()
    {
        $oEmos = $this->getMock( 'EMos', array( 'appendPreScript', 'getAnchorTag' ) );
        $oEmos->expects( $this->once() )->method( 'appendPreScript' )->with( $this->equalTo( "retvalue" ) );
        $oEmos->expects( $this->once() )->method( 'getAnchorTag' )->with( $this->equalTo( "orderProcess" ), $this->equalTo( "value" ) )->will( $this->returnValue( "retvalue" ));

        $oEmos->addOrderProcess( "value" );
    }

    /**
     * Test add site id.
     *
     * @return null
     */
    public function testAddSiteId()
    {
        $oEmos = $this->getMock( 'EMos', array( 'appendPreScript', 'getAnchorTag' ) );
        $oEmos->expects( $this->once() )->method( 'appendPreScript' )->with( $this->equalTo( "retvalue" ) );
        $oEmos->expects( $this->once() )->method( 'getAnchorTag' )->with( $this->equalTo( "siteid" ), $this->equalTo( "value" ) )->will( $this->returnValue( "retvalue" ));

        $oEmos->addSiteId( "value" );
    }

    /**
     * Test add language id.
     *
     * @return null
     */
    public function testAddLangId()
    {
        $oEmos = $this->getMock( 'EMos', array( 'appendPreScript', 'getAnchorTag' ) );
        $oEmos->expects( $this->once() )->method( 'appendPreScript' )->with( $this->equalTo( "retvalue" ) );
        $oEmos->expects( $this->once() )->method( 'getAnchorTag' )->with( $this->equalTo( "langid" ), $this->equalTo( "value" ) )->will( $this->returnValue( "retvalue" ));

        $oEmos->addLangId( "value" );
    }

    /**
     * Test add country id.
     *
     * @return null
     */
    public function testAddCountryId()
    {
        $oEmos = $this->getMock( 'EMos', array( 'appendPreScript', 'getAnchorTag' ) );
        $oEmos->expects( $this->once() )->method( 'appendPreScript' )->with( $this->equalTo( "retvalue" ) );
        $oEmos->expects( $this->once() )->method( 'getAnchorTag' )->with( $this->equalTo( "countryid" ), $this->equalTo( "value" ) )->will( $this->returnValue( "retvalue" ));

        $oEmos->addCountryId( "value" );
    }

    /**
     * Test add page id.
     *
     * @return null
     */
    public function testAddPageId()
    {
        $oEmos = $this->getMock( 'EMos', array( 'appendPreScript' ) );
        $oEmos->expects( $this->once() )->method( 'appendPreScript' )->with( $this->equalTo( "\n<script type=\"text/javascript\">\n window.emosPageId = 'value';\n</script>\n" ) );

        $oEmos->addPageId( "value" );
    }

    /**
     * Test add search.
     *
     * @return null
     */
    public function testAddSearch()
    {
        $oEmos = $this->getMock( 'EMos', array( 'appendPreScript', 'getAnchorTag' ) );
        $oEmos->expects( $this->once() )->method( 'appendPreScript' )->with( $this->equalTo( "retvalue" ) );
        $oEmos->expects( $this->once() )->method( 'getAnchorTag' )->with( $this->equalTo( "search" ), $this->equalTo( "value" ), $this->equalTo( "value2" ) )->will( $this->returnValue( "retvalue" ));

        $oEmos->addSearch( "value", "value2" );
    }

    /**
     * Test add register.
     *
     * @return null
     */
    public function testAddRegister()
    {
        $oEmos = $this->getMock( 'EMos', array( 'appendPreScript', 'getAnchorTag' ) );
        $oEmos->expects( $this->once() )->method( 'appendPreScript' )->with( $this->equalTo( "retvalue" ) );
        $oEmos->expects( $this->once() )->method( 'getAnchorTag' )->with( $this->equalTo( "register" ), $this->equalTo( md5( "value" ) ), $this->equalTo( "value2" ) )->will( $this->returnValue( "retvalue" ));

        $oEmos->addRegister( "value", "value2" );
    }

    /**
     * Test add login.
     *
     * @return null
     */
    public function testAddLogin()
    {
        $oEmos = $this->getMock( 'EMos', array( 'appendPreScript', 'getAnchorTag' ) );
        $oEmos->expects( $this->once() )->method( 'appendPreScript' )->with( $this->equalTo( "retvalue" ) );
        $oEmos->expects( $this->once() )->method( 'getAnchorTag' )->with( $this->equalTo( "login" ), $this->equalTo( md5( "value" ) ), $this->equalTo( "value2" ) )->will( $this->returnValue( "retvalue" ));

        $oEmos->addLogin( "value", "value2" );
    }

    /**
     * Test add contact.
     *
     * @return null
     */
    public function testAddContact()
    {
        $oEmos = $this->getMock( 'EMos', array( 'appendPreScript', 'getAnchorTag' ) );
        $oEmos->expects( $this->once() )->method( 'appendPreScript' )->with( $this->equalTo( "retvalue" ) );
        $oEmos->expects( $this->once() )->method( 'getAnchorTag' )->with( $this->equalTo( "scontact" ), $this->equalTo( "value" ) )->will( $this->returnValue( "retvalue" ));

        $oEmos->addContact( "value" );
    }

    /**
     * Test add download.
     *
     * @return null
     */
    public function testAddDownload()
    {
        $oEmos = $this->getMock( 'EMos', array( 'appendPreScript', 'getAnchorTag' ) );
        $oEmos->expects( $this->once() )->method( 'appendPreScript' )->with( $this->equalTo( "retvalue" ) );
        $oEmos->expects( $this->once() )->method( 'getAnchorTag' )->with( $this->equalTo( "download" ), $this->equalTo( "value" ) )->will( $this->returnValue( "retvalue" ));

        $oEmos->addDownload( "value" );
    }

    /**
     * Test get emos EC page array.
     *
     * @return null
     */
    public function testGetEmosECPageArray()
    {
        $oItem = new oxStdClass;
        $oItem->productID     = 'productID';
        $oItem->productName   = 'productName';
        $oItem->price         = 'price';
        $oItem->productGroup  = 'productGroup';
        $oItem->quantity = 'quantity';
        $oItem->variant1 = 'variant1';
        $oItem->variant2 = 'variant2';
        $oItem->variant3 = 'variant3';

        $sValue = "<script type=\"text/javascript\">\n" .
        "<!--\n" .
        "\t var emosECPageArray = new Array();\n" .
        "\t emosECPageArray['event'] = 'event';\n" .
        "\t emosECPageArray['id'] = 'productID';\n" .
        "\t emosECPageArray['name'] = 'productName';\n" .
        "\t emosECPageArray['preis'] = 'price';\n" .
        "\t emosECPageArray['group'] = 'productGroup';\n" .
        "\t emosECPageArray['anzahl'] = 'quantity';\n" .
        "\t emosECPageArray['var1'] = 'variant1';\n" .
        "\t emosECPageArray['var2'] = 'variant2';\n" .
        "\t emosECPageArray['var3'] = 'variant3';\n" .
        "// -->\n" .
        "</script>\n";

        $oEmos = $this->getMock( 'EMos', array( 'emos_ItemFormat' ) );
        $oEmos->expects( $this->once() )->method( 'emos_ItemFormat' )->with( $this->equalTo( $oItem ) )->will( $this->returnValue( $oItem ) );

        $this->assertEquals( $sValue, $oEmos->getEmosECPageArray( $oItem, 'event' ) );
    }

    /**
     * Test add emos billing page array.
     *
     * @return null
     */
    public function testAddEmosBillingPageArray()
    {
        $oEmos = $this->getMock( 'EMos', array( 'getEmosBillingArray', 'appendPreScript' ) );
        $oEmos->expects( $this->once() )->method( 'getEmosBillingArray' )->with( $this->equalTo( 'billingID' ), $this->equalTo( 'customerNumber' ), $this->equalTo( 'total' ), $this->equalTo( 'country'  ), $this->equalTo( 'cip'  ), $this->equalTo( 'city' ), $this->equalTo( "emosBillingPageArray" ) )->will( $this->returnValue( 'retval' ) );
        $oEmos->expects( $this->once() )->method( 'appendPreScript' )->with( $this->equalTo( 'retval' ) );

        $oEmos->addEmosBillingPageArray( 'billingID', 'customerNumber', 'total', 'country', 'cip', 'city' );
    }

    /**
     * Test get emos billing array.
     *
     * @return null
     */
    public function testGetEmosBillingArray()
    {
        $sValue = "<script type=\"text/javascript\">\n" .
        "<!--\n" .
        "\t var arrayName = new Array();\n" .
        "\t arrayName['0'] = 'billingID';\n" .
        "\t arrayName['1'] = '".md5('customerNumber')."';\n" .
        "\t arrayName['2'] = 'country/c/ci/city/cip';\n" .
        "\t arrayName['3'] = 'total';\n" .
        "// -->\n" .
        "</script>\n";

        $oEmos = $this->getMock( 'EMos', array( 'emos_DataFormat' ) );
        $oEmos->expects( $this->at( 0 ) )->method( 'emos_DataFormat' )->with( $this->equalTo( "country" ) )->will( $this->returnValue( "country" ));
        $oEmos->expects( $this->at( 1 ) )->method( 'emos_DataFormat' )->with( $this->equalTo( "cip" ) )->will( $this->returnValue( "cip" ));
        $oEmos->expects( $this->at( 2 ) )->method( 'emos_DataFormat' )->with( $this->equalTo( "city" ) )->will( $this->returnValue( "city" ));

        $this->assertEquals( $sValue, $oEmos->getEmosBillingArray( 'billingID', 'customerNumber', 'total', 'country', 'cip', 'city', 'arrayName' ) );
    }

    /**
     * Test add emos basket page array.
     *
     * @return null
     */
    public function testAddEmosBasketPageArray()
    {
        $oEmos = $this->getMock( 'EMos', array( 'getEmosBasketPageArray', 'appendPreScript' ) );
        $oEmos->expects( $this->once() )->method( 'getEmosBasketPageArray' )->with( $this->equalTo( 'value' ), $this->equalTo( 'emosBasketPageArray' ) )->will( $this->returnValue( 'retval' ) );
        $oEmos->expects( $this->once() )->method( 'appendPreScript' )->with( $this->equalTo( 'retval' ) );

        $oEmos->addEmosBasketPageArray( 'value' );
    }

    /**
     * Test add emos basket page array.
     *
     * @return null
     */
    public function testGetEmosBasketPageArray()
    {
        $sValue = "<script type=\"text/javascript\">\n".
        "<!--\n".
        "var arrayName = new Array();\n".
        "\n".
        "\t arrayName[0]=new Array();\n".
        "\t arrayName[0][0]='productID';\n".
        "\t arrayName[0][1]='productName';\n".
        "\t arrayName[0][2]='price';\n".
        "\t arrayName[0][3]='productGroup';\n".
        "\t arrayName[0][4]='quantity';\n".
        "\t arrayName[0][5]='variant1';\n".
        "\t arrayName[0][6]='variant2';\n".
        "\t arrayName[0][7]='variant3';\n".
        "\n".
        "\t arrayName[1]=new Array();\n".
        "\t arrayName[1][0]='productID';\n".
        "\t arrayName[1][1]='productName';\n".
        "\t arrayName[1][2]='price';\n".
        "\t arrayName[1][3]='productGroup';\n".
        "\t arrayName[1][4]='quantity';\n".
        "\t arrayName[1][5]='variant1';\n".
        "\t arrayName[1][6]='variant2';\n".
        "\t arrayName[1][7]='variant3';\n".
        "// -->\n" .
        "</script>\n";

        $oItem0 = new oxStdClass;
        $oItem0->productID = 'productID';
        $oItem0->productName = 'productName';
        $oItem0->price = 'price';
        $oItem0->productGroup = 'productGroup';
        $oItem0->quantity = 'quantity';
        $oItem0->variant1 = 'variant1';
        $oItem0->variant2 = 'variant2';
        $oItem0->variant3 = 'variant3';

        $oItem1 = new oxStdClass;
        $oItem1->productID = 'productID';
        $oItem1->productName = 'productName';
        $oItem1->price = 'price';
        $oItem1->productGroup = 'productGroup';
        $oItem1->quantity = 'quantity';
        $oItem1->variant1 = 'variant1';
        $oItem1->variant2 = 'variant2';
        $oItem1->variant3 = 'variant3';

        $oBasket = array( $oItem0, $oItem1 );

        $oEmos = $this->getMock( 'EMos', array( 'emos_ItemFormat' ) );
        $oEmos->expects( $this->at( 0 ) )->method( 'emos_ItemFormat' )->with( $this->equalTo( $oItem0 ) )->will( $this->returnValue( $oItem0 ) );
        $oEmos->expects( $this->at( 1 ) )->method( 'emos_ItemFormat' )->with( $this->equalTo( $oItem1 ) )->will( $this->returnValue( $oItem1 ) );

        $this->assertEquals( $sValue, $oEmos->getEmosBasketPageArray( $oBasket, 'arrayName' ) );
    }

    /**
     * Test add detail view.
     *
     * @return null
     */
    public function testAddDetailView()
    {
        $oEmos = $this->getMock( 'EMos', array( 'getEmosECPageArray', 'appendPreScript' ) );
        $oEmos->expects( $this->once() )->method( 'getEmosECPageArray' )->with( $this->equalTo( 'value' ), $this->equalTo( 'view' ) )->will( $this->returnValue( 'retval' ) );
        $oEmos->expects( $this->once() )->method( 'appendPreScript' )->with( $this->equalTo( 'retval' ) );

        $oEmos->addDetailView( 'value' );
    }

    /**
     * Test remove from basket.
     *
     * @return null
     */
    public function testRemoveFromBasket()
    {
        $oEmos = $this->getMock( 'EMos', array( 'getEmosECPageArray', 'appendPreScript' ) );
        $oEmos->expects( $this->once() )->method( 'getEmosECPageArray' )->with( $this->equalTo( 'value' ), $this->equalTo( 'c_rmv' ) )->will( $this->returnValue( 'retval' ) );
        $oEmos->expects( $this->once() )->method( 'appendPreScript' )->with( $this->equalTo( 'retval' ) );

        $oEmos->removeFromBasket( 'value' );
    }

    /**
     * Test add to basket.
     *
     * @return null
     */
    public function testAddToBasket()
    {
        $oEmos = $this->getMock( 'EMos', array( 'getEmosECPageArray', 'appendPreScript' ) );
        $oEmos->expects( $this->once() )->method( 'getEmosECPageArray' )->with( $this->equalTo( 'value' ), $this->equalTo( 'c_add' ) )->will( $this->returnValue( 'retval' ) );
        $oEmos->expects( $this->once() )->method( 'appendPreScript' )->with( $this->equalTo( 'retval' ) );

        $oEmos->addToBasket( 'value' );
    }

    /**
     * Test get emos custom page array.
     *
     * @return null
     */
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
    }

    /**
     * Test add emos custom page array.
     *
     * @return null
     */
    public function testAddEmosCustomPageArray()
    {
        $aValues = array( 0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13 );

        $oEmos = $this->getMock( 'EMos', array( 'getEmosCustomPageArray', 'appendPreScript' ) );
        $oEmos->expects( $this->once() )->method( 'getEmosCustomPageArray' )->with( $this->equalTo( $aValues ) )->will( $this->returnValue( 'retval' ) );
        $oEmos->expects( $this->once() )->method( 'appendPreScript' )->with( $this->equalTo( 'retval' ) );

        $oEmos->addEmosCustomPageArray( 0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13 );
    }

    /**
     * Test get emos EC event.
     *
     * @return null
     */
    public function testGetEmosECEvent()
    {
        $oItem = new oxStdClass;
        $oItem->productID = 'productID';
        $oItem->productName = 'productName';
        $oItem->price = 'price';
        $oItem->productGroup = 'productGroup';
        $oItem->quantity = 'quantity';
        $oItem->variant1 = 'variant1';
        $oItem->variant2 = 'variant2';
        $oItem->variant3 = 'variant3';

        $sValue = "emos_ecEvent('event'," .
        "'productID'," .
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
    }

    /**
     * Test get emos view event.
     *
     * @return null
     */
    public function testGetEmosViewEvent()
    {
        $oEmos = $this->getMock( 'EMos', array( 'getEmosECEvent' ) );
        $oEmos->expects( $this->once() )->method( 'getEmosECEvent' )->with( $this->equalTo( 'value' ) )->will( $this->returnValue( 'retval' ) );

        $this->assertEquals( 'retval', $oEmos->getEmosViewEvent( 'value' ) );
    }

    /**
     * Test get emos add to basket event.
     *
     * @return null
     */
    public function testGetEmosAddToBasketEvent()
    {
        $oEmos = $this->getMock( 'EMos', array( 'getEmosECEvent' ) );
        $oEmos->expects( $this->once() )->method( 'getEmosECEvent' )->with( $this->equalTo( 'value' ), $this->equalTo( 'c_add' ) )->will( $this->returnValue( 'retval' ) );

        $this->assertEquals( 'retval', $oEmos->getEmosAddToBasketEvent( 'value' ) );
    }

    /**
     * Test get remove from basket event.
     *
     * @return null
     */
    public function testGetRemoveFromBasketEvent()
    {
        $oEmos = $this->getMock( 'EMos', array( 'getEmosECEvent' ) );
        $oEmos->expects( $this->once() )->method( 'getEmosECEvent' )->with( $this->equalTo( 'value' ), $this->equalTo( 'c_rmv' ) )->will( $this->returnValue( 'retval' ) );

        $this->assertEquals( 'retval', $oEmos->getRemoveFromBasketEvent( 'value' ) );
    }

    /**
     * Test get emos billing event array.
     *
     * @return null
     */
    public function testGetEmosBillingEventArray()
    {
        $oEmos = $this->getMock( 'EMos', array( 'getEmosBillingArray' ) );
        $oEmos->expects( $this->once() )->method( 'getEmosBillingArray' )->with( $this->equalTo( 'billingID'), $this->equalTo( 'customerNumber'), $this->equalTo( 'total'), $this->equalTo( 'country'), $this->equalTo( 'cip'), $this->equalTo( 'city'), $this->equalTo( "emosBillingArray" ) )->will( $this->returnValue( 'retval' ) );

        $this->assertEquals( 'retval', $oEmos->getEmosBillingEventArray( 'billingID', 'customerNumber', 'total', 'country', 'cip', 'city' ) );
    }

    /**
     * Test get emos basket event array.
     *
     * @return null
     */
    public function testGetEMOSBasketEventArray()
    {
        $oEmos = $this->getMock( 'EMos', array( 'getEmosBasketArray' ) );
        $oEmos->expects( $this->once() )->method( 'getEmosBasketArray' )->with( $this->equalTo( 'value' ), $this->equalTo( "emosBasketArray"  ) )->will( $this->returnValue( 'retval' ) );

        $this->assertEquals( 'retval', $oEmos->getEMOSBasketEventArray( 'value' ) );
    }
}
