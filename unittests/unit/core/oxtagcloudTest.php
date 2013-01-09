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
 * @version   SVN: $Id: oxtagcloudTest.php 53484 2013-01-08 14:28:26Z aurimas.gladutis $
 */

require_once realpath( "." ).'/unit/OxidTestCase.php';
require_once realpath( "." ).'/unit/test_config.inc.php';

class Unit_Core_oxTagCloudTest extends OxidTestCase
{
    /**
     * Test getting font size for tag
     */
    public function testGetFontSizeCustom()
    {
        $aTestData = array(
            "sTestTag1" => new oxTag("sTestTag1"),
            "sTestTag2" => new oxTag("sTestTag2"),
            "sTestTag3" => new oxTag("sTestTag3"),
            "sTestTag4" => new oxTag("sTestTag4"),
            "sTestTag5" => new oxTag("sTestTag5"),
            "sTestTag6" => new oxTag("sTestTag6"),
            "sTestTag7" => new oxTag("sTestTag7")
        );
        $aTestData["sTestTag1"]->setHitCount(20);
        $aTestData["sTestTag2"]->setHitCount(17);
        $aTestData["sTestTag3"]->setHitCount(13);
        $aTestData["sTestTag4"]->setHitCount(15);
        $aTestData["sTestTag5"]->setHitCount(12);
        $aTestData["sTestTag6"]->setHitCount(1);
        $aTestData["sTestTag7"]->setHitCount(5);

        $aTestResults = array(
            "sTestTag1" => 400,
            "sTestTag2" => 300,
            "sTestTag3" => 200,
            "sTestTag4" => 300,
            "sTestTag5" => 200,
            "sTestTag6" => 100,
            "sTestTag7" => 100
        );
        $oTagCloud = new oxTagCloud();
        $oTagCloud->setCloudArray($aTestData);

        foreach ( $aTestResults as $sTag => $iVal ) {
            $this->assertEquals( $iVal, $oTagCloud->getTagSize( $sTag ) );
        }
    }

    /* Should be tested by testGetFontSizeCustom
    public function testGetFontSize()
    {
        $oTagCloud = $this->getProxyClass('oxTagCloud');
        $this->assertEquals(285, $oTagCloud->UNITgetFontSize(10, 15));
        $this->assertEquals(250, $oTagCloud->UNITgetFontSize(10, 18));
        $this->assertEquals(700, $oTagCloud->UNITgetFontSize(18, 10));
    }
    public function testGetFontSizeExceptionalCases()
    {
        $oTagCloud = $this->getProxyClass('oxTagCloud');
        $this->assertEquals(OXTAGCLOUD_MINFONT, $oTagCloud->UNITgetFontSize(15, 2));
        $this->assertEquals(OXTAGCLOUD_MINFONT, $oTagCloud->UNITgetFontSize(15, 0));
        $this->assertEquals(OXTAGCLOUD_MINFONT, $oTagCloud->UNITgetFontSize(15, 1));
        $this->assertEquals(OXTAGCLOUD_MINFONT, $oTagCloud->UNITgetFontSize(-1, 10));
    }*/

    /**
     * Test formation of tagCloud array
     *
     * @return null
     */
    public function testGetCloudArray()
    {
        $oTagSet = new oxTagSet();
        $oTagSet->set("tag1,tag2");

        $oTagList = $this->getMock('oxtaglist', array('getCacheId', 'loadList', 'get'));
        $oTagList->expects( $this->any() )->method( 'getCacheId' )->will( $this->returnValue( null ) );
        $oTagList->expects( $this->any() )->method( 'loadList' )->will( $this->returnValue( true ) );
        $oTagList->expects( $this->any() )->method( 'get' )->will( $this->returnValue( $oTagSet ) );

        $oTagCloud = new oxTagCloud();
        $oTagCloud->setTagList( $oTagList );

        $aTags = array(
            "tag1" => new oxTag("tag1"),
            "tag2" => new oxTag("tag2"),
        );

        $this->assertEquals( $aTags, $oTagCloud->getCloudArray() );
    }

    /**
     * Test setting of extended mode
     */
    public function testSettingExtendedMode()
    {
        $oTagCloud = new oxTagCloud();

        $oTagCloud->setExtendedMode(true);
        $this->assertTrue( $oTagCloud->isExtended() );

        $oTagCloud->setExtendedMode(false);
        $this->assertFalse( $oTagCloud->isExtended() );
    }

    /**
     * Test getting max articles amount
     */
    public function testGetMaxAmount()
    {
        $oTagCloud = new oxTagCloud();

        $oTagCloud->setExtendedMode(true);
        $this->assertEquals( OXTAGCLOUD_EXTENDEDCOUNT, $oTagCloud->GetMaxAmount() );

        $oTagCloud->setExtendedMode(false);
        $this->assertEquals( OXTAGCLOUD_STARTPAGECOUNT, $oTagCloud->GetMaxAmount() );
    }
    /*
    public function testAssignTagsFromSearchKeys()
    {
        $this->markTestIncomplete();
    }*/


    /**
     * Test caching of tagCloudArray
     */

    public function testTagCache()
    {
        $this->markTestSkipped("Needs to be refactored");
        $oTagCloud = $this->getProxyClass('oxTagCloud');
        $sCacheKey1 = $oTagCloud->UNITgetCacheKey(true);//  "cloudtag_"."_".oxConfig::getInstance()->getShopID()."|".TRUE;
        $sCacheKey2 = $oTagCloud->UNITgetCacheKey(false);//"cloudtag_"."_".oxConfig::getInstance()->getShopID()."|".FALSE;

        //remove older files
        $oUtils = $this->getProxyClass("oxutils");
        $sFile1 = $oUtils->getCacheFilePath($sCacheKey1);
        $sFile2 = $oUtils->getCacheFilePath($sCacheKey2);
        @unlink($sFile1);
        @unlink($sFile2);

        oxUtils::getInstance()->toFileCache($sCacheKey1, "testValue1");
        oxUtils::getInstance()->toFileCache($sCacheKey2, "testValue2");
        $this->assertEquals("testValue1", oxUtils::getInstance()->fromFileCache($sCacheKey1));
        $this->assertEquals("testValue2", oxUtils::getInstance()->fromFileCache($sCacheKey2));

        $oTagCloud->resetTagCache();

        $this->assertEquals(null, oxUtils::getInstance()->fromFileCache($sCacheKey1));
        $this->assertEquals(null, oxUtils::getInstance()->fromFileCache($sCacheKey2));
    }

    public function testGetCacheNameLang1()
    {
        $this->markTestSkipped("Needs to be refactored");
        $oTagCloud = $this->getProxyClass( 'oxTagCloud' );
            $this->assertEquals( 'tagcloud__oxbaseshop_1_1', $oTagCloud->UNITgetCacheKey( true, 1 ) );
            $this->assertEquals( 'tagcloud__oxbaseshop_1_0', $oTagCloud->UNITgetCacheKey( false, 1 ) );
    }

    public function testGetCacheName()
    {
        $this->markTestSkipped("Needs to be refactored");
        $oTagCloud = $this->getProxyClass('oxTagCloud');
            $this->assertEquals('tagcloud__oxbaseshop_0_1', $oTagCloud->UNITgetCacheKey(true));
            $this->assertEquals('tagcloud__oxbaseshop_0_0', $oTagCloud->UNITgetCacheKey(false));
    }

    public function testGetTagsExtended()
    {
        $this->markTestSkipped("Needs to be refactored");
        $oTagCloud = new oxTagCloud();
        $aTags = $oTagCloud->getTags(null, true);
            $this->assertTrue(isset($aTags['25wbezugshinweis']));
            $this->assertEquals(200, count($aTags));
            $this->assertEquals(3, $aTags['wanduhr']);
    }
}
