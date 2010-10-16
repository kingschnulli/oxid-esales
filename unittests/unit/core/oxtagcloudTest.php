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
 * @version   SVN: $Id: oxtagcloudTest.php 30339 2010-10-15 12:32:54Z rimvydas.paskevicius $
 */

require_once realpath( "." ).'/unit/OxidTestCase.php';
require_once realpath( "." ).'/unit/test_config.inc.php';

class Unit_Core_oxTagCloudTest extends OxidTestCase
{
    public function testGetFontSizeCustom()
    {
        $aTestData = array( "sTestTag1" => 400,
                            "sTestTag2" => 300,
                            "sTestTag3" => 200,
                            "sTestTag4" => 300,
                            "sTestTag5" => 200,
                            "sTestTag6" => 100,
                            "sTestTag7" => 100 );

        $oTagCloud = $this->getMock( "oxTagCloud", array( "getCloudArray" ) );
        $oTagCloud->expects( $this->any() )->method( 'getCloudArray' )->will( $this->returnValue( array( "sTestTag1" => 20, "sTestTag2" => 17, "sTestTag3" => 13, "sTestTag4" => 15, "sTestTag5" => 12, "sTestTag6" => 1, "sTestTag7" => 5 ) ) );

        foreach ( $aTestData as $sTag => $iVal ) {
            $this->assertEquals( $iVal, $oTagCloud->getTagSize( $sTag ) );
        }
    }

    /**
     * oxTagCloud::setProductId() test case
     *
     * @return null
     */
    public function testSetProductId()
    {
        $oTagCloud = new oxTagCloud();
        $this->assertNull( $oTagCloud->getProductId() );

        $oTagCloud->setProductId( "testProductId" );
        $this->assertEquals( "testProductId", $oTagCloud->getProductId() );
    }

    /**
     * oxTagCloud::setLanguageId() test case
     *
     * @return null
     */
    public function testSetLanguageId()
    {
        $oTagCloud = new oxTagCloud();
        $this->assertEquals( oxLang::getInstance()->getBaseLanguage(), $oTagCloud->getLanguageId() );

        $oTagCloud->setLanguageId( "testLanguagaId" );
        $this->assertEquals( "testLanguagaId", $oTagCloud->getLanguageId() );
    }

    /**
     * oxTagCloud::setExtendedMode() test case
     *
     * @return null
     */
    public function testSetExtendedMode()
    {
        $oTagCloud = new oxTagCloud();
        $this->assertFalse( $oTagCloud->isExtended() );

        $oTagCloud->setExtendedMode( true );
        $this->assertTrue( $oTagCloud->isExtended() );
    }

    /**
     * oxTagCloud::getCloudArray() test case
     *
     * @return null
     */
    public function testGetCloudArray()
    {
        // disabling cache
        oxTestModules::addFunction( "oxUtils", "fromFileCache", "{return null;}" );
        oxTestModules::addFunction( "oxUtils", "toFileCache", "{return false;}" );

        $oTagCloud = $this->getMock( "oxTagCloud", array( "getLanguageId", "isExtended", "getProductId", "_getCacheKey", "getTags" ) );
        $oTagCloud->expects( $this->exactly( 2 ) )->method( 'getLanguageId' )->will( $this->returnValue( 0 ) );
        $oTagCloud->expects( $this->exactly( 2 ) )->method( 'isExtended' )->will( $this->returnValue( true ) );
        $oTagCloud->expects( $this->exactly( 2 ) )->method( 'getProductId' )->will( $this->returnValue( null ) );
        $oTagCloud->expects( $this->exactly( 2 ) )->method( '_getCacheKey' )->with( $this->equalTo( true ), $this->equalTo( 0 ) )->will( $this->returnValue( "testCacheId" ) );
        $oTagCloud->expects( $this->once() )->method( 'getTags' )->with( $this->equalTo( null ), $this->equalTo( true ), $this->equalTo( 0 ) )->will( $this->returnValue( array( "tag1", "tag2" ) ) );

        $this->assertEquals( array( "tag1", "tag2" ), $oTagCloud->getCloudArray() );
        $this->assertEquals( array( "tag1", "tag2" ), $oTagCloud->getCloudArray() );
    }

    /**
     * oxTagCloud::getTagLink() test case, SEO on
     *
     * @return null
     */
    public function testGetTagLinkSeoOn()
    {
        // seo on
        oxTestModules::addFunction( "oxUtils", "seoIsActive", "{return true;}" );

        $oTagCloud = new oxTagCloud();
        $this->assertEquals( oxConfig::getInstance()->getConfigParam("sShopURL")."tag/testTag/", $oTagCloud->getTagLink( "testTag" ) );

    }

    /**
     * oxTagCloud::getTagLink() test case, SEO off
     *
     * @return null
     */
    public function testGetTagLinkSeoOff()
    {
        // seo off
        oxTestModules::addFunction( "oxUtils", "seoIsActive", "{return false;}" );

        $oTagCloud = new oxTagCloud();
        $this->assertEquals( oxConfig::getInstance()->getConfigParam("sShopURL")."index.php?cl=tag&amp;searchtag=testTag&amp;lang=0", $oTagCloud->getTagLink( "testTag" ) );

    }

    /**
     * oxTagCloud::getTagTitle() test case
     *
     * @return null
     */
    public function testGetTagTitle()
    {
        $oTagCloud = new oxTagCloud();
        $this->assertEquals( "testTag", $oTagCloud->getTagTitle( "testTag" ) );
        $this->assertEquals( "test&amp;Tag", $oTagCloud->getTagTitle( "test&Tag" ) );
    }

    /**
     * oxTagCloud::getMaxHit() test case
     *
     * @return null
     */
    public function testGetMaxHit()
    {
        $oTagCloud = $this->getMock( "oxTagCloud", array( "getCloudArray" ) );
        $oTagCloud->expects( $this->once() )->method( 'getCloudArray' )->will( $this->returnValue( array( "tag1" => 999, "tag2" => 666 ) ) );
        $this->assertEquals( 999, $oTagCloud->UNITgetMaxHit() );
    }

    /**
     * oxTagCloud::getTagSize() test case
     *
     * @return null
     */
    public function testGetTagSize()
    {
        $oTagCloud = $this->getMock( "oxTagCloud", array( "getCloudArray", "_getFontSize" ) );
        $oTagCloud->expects( $this->exactly( 2 ) )->method( 'getCloudArray' )->will( $this->returnValue( array( "tag1" => 999, "tag2" => 666 ) ) );
        $oTagCloud->expects( $this->once() )->method( '_getFontSize' )->with( $this->equalTo( 666 ), $this->equalTo( 999 ) )->will( $this->returnValue( 400 ) );

        $this->assertEquals( 400, $oTagCloud->getTagSize( "tag2" ) );
    }

    public function testGetTagCloudFoundInCache()
    {
        $sCache = time();
        oxTestModules::addFunction( "oxUtils", "fromFileCache", "{return {$sCache};}" );

        $oTagCloud = new oxTagCloud();
        $this->assertEquals( $sCache, $oTagCloud->getTagCloud() );
    }

    public function testGetTagCloudNoTagsCachingEmptyValue()
    {
        $sCache = time();
        oxTestModules::addFunction( "oxUtils", "toFileCache", "{return {$sCache};}" );

        $oTagCloud = $this->getMock( 'oxTagCloud', array( 'getTags' ) );
        $oTagCloud->expects( $this->once() )->method( 'getTags' )->will( $this->returnValue( array() ) );

        $this->assertFalse( $oTagCloud->getTagCloud() );
    }

    public function testGetTagCloud()
    {
        oxTestModules::addFunction("oxutilsserver", "getServerVar", "{ \$aArgs = func_get_args(); if ( \$aArgs[0] === 'HTTP_HOST' ) { return '".oxConfig::getInstance()->getShopUrl()."'; } elseif ( \$aArgs[0] === 'SCRIPT_NAME' ) { return ''; } else { return \$_SERVER[\$aArgs[0]]; } }");
        $sUrl = oxConfig::getInstance()->getShopUrl();

            $sRes = "<a style='font-size:160%;' class='tagitem_160' href='{$sUrl}tag/wanduhr/'>wanduhr</a> ".
                    "<a style='font-size:220%;' class='tagitem_220' href='{$sUrl}tag/shirt/'>shirt</a> ".
                    "<a style='font-size:100%;' class='tagitem_100' href='{$sUrl}tag/schale/'>schale</a> ".
                    "<a style='font-size:220%;' class='tagitem_220' href='{$sUrl}tag/pima/'>pima</a> ".
                    "<a style='font-size:160%;' class='tagitem_160' href='{$sUrl}tag/material/'>material</a> ".
                    "<a style='font-size:160%;' class='tagitem_160' href='{$sUrl}tag/locker/'>locker</a> ".
                    "<a style='font-size:160%;' class='tagitem_160' href='{$sUrl}tag/laessig/'>l&auml;ssig</a> ".
                    "<a style='font-size:400%;' class='tagitem_400' href='{$sUrl}tag/kuyichi/'>kuyichi</a> ".
                    "<a style='font-size:280%;' class='tagitem_280' href='{$sUrl}tag/jeans/'>jeans</a> ".
                    "<a style='font-size:220%;' class='tagitem_220' href='{$sUrl}tag/hoehe/'>h&ouml;he</a> ".
                    "<a style='font-size:100%;' class='tagitem_100' href='{$sUrl}tag/holz/'>holz</a> ".
                    "<a style='font-size:100%;' class='tagitem_100' href='{$sUrl}tag/gefrierfach/'>gefrierfach</a> ".
                    "<a style='font-size:100%;' class='tagitem_100' href='{$sUrl}tag/einfach/'>einfach</a> ".
                    "<a style='font-size:160%;' class='tagitem_160' href='{$sUrl}tag/durchmesser/'>durchmesser</a> ".
                    "<a style='font-size:220%;' class='tagitem_220' href='{$sUrl}tag/dunkel/'>dunkel</a> ".
                    "<a style='font-size:100%;' class='tagitem_100' href='{$sUrl}tag/dolchkollektion/'>dolchkollektion</a> ".
                    "<a style='font-size:100%;' class='tagitem_100' href='{$sUrl}tag/designed/'>designed</a> ".
                    "<a style='font-size:160%;' class='tagitem_160' href='{$sUrl}tag/design/'>design</a> ".
                    "<a style='font-size:220%;' class='tagitem_220' href='{$sUrl}tag/cm/'>cm</a> ".
                    "<a style='font-size:100%;' class='tagitem_100' href='{$sUrl}tag/boris/'>boris</a> ";


        oxTestModules::addFunction( "oxutils", "seoIsActive", "{return true;}" );

        $oTagCloud = new oxTagCloud();

        $this->assertEquals( $sRes, $oTagCloud->getTagCloud() );
    }

    public function testGetTagCloudEn()
    {
        $oTagCloud = new oxTagCloud();
        $sUrl = oxConfig::getInstance()->getShopUrl();
            $sRes = "<a style='font-size:233%;' class='tagitem_233' href='{$sUrl}en/tag/wall-clock/'>wall-clock</a> ".
                    "<a style='font-size:167%;' class='tagitem_167' href='{$sUrl}en/tag/shirt/'>shirt</a> ".
                    "<a style='font-size:100%;' class='tagitem_100' href='{$sUrl}en/tag/popcorn/'>popcorn</a> ".
                    "<a style='font-size:100%;' class='tagitem_100' href='{$sUrl}en/tag/plate/'>plate</a> ".
                    "<a style='font-size:167%;' class='tagitem_167' href='{$sUrl}en/tag/pima/'>pima</a> ".
                    "<a style='font-size:233%;' class='tagitem_233' href='{$sUrl}en/tag/party/'>party</a> ".
                    "<a style='font-size:233%;' class='tagitem_233' href='{$sUrl}en/tag/living/'>living</a> ".
                    "<a style='font-size:267%;' class='tagitem_267' href='{$sUrl}en/tag/kuyichi/'>kuyichi</a> ".
                    "<a style='font-size:133%;' class='tagitem_133' href='{$sUrl}en/tag/kitchen/'>kitchen</a> ".
                    "<a style='font-size:200%;' class='tagitem_200' href='{$sUrl}en/tag/jeans/'>jeans</a> ".
                    "<a style='font-size:133%;' class='tagitem_133' href='{$sUrl}en/tag/ice-cubes/'>ice-cubes</a> ".
                    "<a style='font-size:400%;' class='tagitem_400' href='{$sUrl}en/tag/gift/'>gift</a> ".
                    "<a style='font-size:100%;' class='tagitem_100' href='{$sUrl}en/tag/design/'>design</a> ".
                    "<a style='font-size:167%;' class='tagitem_167' href='{$sUrl}en/tag/dark/'>dark</a> ".
                    "<a style='font-size:167%;' class='tagitem_167' href='{$sUrl}en/tag/dagger/'>dagger</a> ".
                    "<a style='font-size:133%;' class='tagitem_133' href='{$sUrl}en/tag/cool/'>cool</a> ".
                    "<a style='font-size:133%;' class='tagitem_133' href='{$sUrl}en/tag/cocktail/'>cocktail</a> ".
                    "<a style='font-size:100%;' class='tagitem_100' href='{$sUrl}en/tag/champagne/'>champagne</a> ".
                    "<a style='font-size:133%;' class='tagitem_133' href='{$sUrl}en/tag/casual/'>casual</a> ".
                    "<a style='font-size:267%;' class='tagitem_267' href='{$sUrl}en/tag/bar/'>bar</a> ";
        $this->assertEquals( $sRes, $oTagCloud->getTagCloud( null, false, 1 ) );
    }

    public function testGetTagExtended()
    {
        oxTestModules::addFunction("oxutilsserver", "getServerVar", "{ \$aArgs = func_get_args(); if ( \$aArgs[0] === 'HTTP_HOST' ) { return '".oxConfig::getInstance()->getShopUrl()."'; } elseif ( \$aArgs[0] === 'SCRIPT_NAME' ) { return ''; } else { return \$_SERVER[\$aArgs[0]]; } }");
        oxTestModules::addFunction( "oxutils", "seoIsActive", "{return true;}" );
        $oTagCloud = new oxTagCloud();
        $sTag = $oTagCloud->getTagCloud(null, true);

            $this->assertTrue(strpos($sTag, "tag/25wbezugshinweis/'>25wbezugshinweis</a>") > 0);

    }

    public function testGetTagExtendedEn()
    {
        $oTagCloud = new oxTagCloud();
        $sUrl = oxConfig::getInstance()->getShopUrl();
            $sRes = "<a style='font-size:233%;' class='tagitem_233' href='{$sUrl}en/tag/wall-clock/'>wall-clock</a> ".
                    "<a style='font-size:167%;' class='tagitem_167' href='{$sUrl}en/tag/shirt/'>shirt</a> ".
                    "<a style='font-size:100%;' class='tagitem_100' href='{$sUrl}en/tag/popcorn/'>popcorn</a> ".
                    "<a style='font-size:100%;' class='tagitem_100' href='{$sUrl}en/tag/plate/'>plate</a> ".
                    "<a style='font-size:167%;' class='tagitem_167' href='{$sUrl}en/tag/pima/'>pima</a> ".
                    "<a style='font-size:233%;' class='tagitem_233' href='{$sUrl}en/tag/party/'>party</a> ".
                    "<a style='font-size:233%;' class='tagitem_233' href='{$sUrl}en/tag/living/'>living</a> ".
                    "<a style='font-size:267%;' class='tagitem_267' href='{$sUrl}en/tag/kuyichi/'>kuyichi</a> ".
                    "<a style='font-size:133%;' class='tagitem_133' href='{$sUrl}en/tag/kitchen/'>kitchen</a> ".
                    "<a style='font-size:200%;' class='tagitem_200' href='{$sUrl}en/tag/jeans/'>jeans</a> ".
                    "<a style='font-size:133%;' class='tagitem_133' href='{$sUrl}en/tag/ice-cubes/'>ice-cubes</a> ".
                    "<a style='font-size:400%;' class='tagitem_400' href='{$sUrl}en/tag/gift/'>gift</a> ".
                    "<a style='font-size:100%;' class='tagitem_100' href='{$sUrl}en/tag/design/'>design</a> ".
                    "<a style='font-size:167%;' class='tagitem_167' href='{$sUrl}en/tag/dark/'>dark</a> ".
                    "<a style='font-size:167%;' class='tagitem_167' href='{$sUrl}en/tag/dagger/'>dagger</a> ".
                    "<a style='font-size:133%;' class='tagitem_133' href='{$sUrl}en/tag/cool/'>cool</a> ".
                    "<a style='font-size:133%;' class='tagitem_133' href='{$sUrl}en/tag/cocktail/'>cocktail</a> ".
                    "<a style='font-size:100%;' class='tagitem_100' href='{$sUrl}en/tag/champagne/'>champagne</a> ".
                    "<a style='font-size:133%;' class='tagitem_133' href='{$sUrl}en/tag/casual/'>casual</a> ".
                    "<a style='font-size:267%;' class='tagitem_267' href='{$sUrl}en/tag/bar/'>bar</a> ";
        $this->assertEquals( $sRes, $oTagCloud->getTagCloud( null, false, 1 ) );
    }

    //M68 - Problems when number is entered as tag
    public function testGetTagExtendedIfNumberAdded()
    {
        oxTestModules::addFunction("oxutilsserver", "getServerVar", "{ \$aArgs = func_get_args(); if ( \$aArgs[0] === 'HTTP_HOST' ) { return '".oxConfig::getInstance()->getShopUrl()."'; } elseif ( \$aArgs[0] === 'SCRIPT_NAME' ) { return ''; } else { return \$_SERVER[\$aArgs[0]]; } }");
        oxTestModules::addFunction( "oxutils", "seoIsActive", "{return true;}" );
        $oArticle = new oxArticle();
        $oArticle->load('2000');
        $sExisting = $oArticle->getTags();

        try {
            $sAddTag = "1";
            $oArticle->addTag($sAddTag);
            $oTagCloud = new oxTagCloud();
            $oTagCloud->resetTagCache();
            $sTag = $oTagCloud->getTagCloud('2000', true);
            $this->assertTrue(strpos($sTag, "tag/1/'>1</a>") !== false);
        } catch (Exception $e) {
        }
        $oArticle->saveTags($sExisting);
        $oTagCloud->resetTagCache();
        if ($e) {
            throw $e;
        }
    }

    public function testGetTagCloudIfSeoIsOff()
    {
        oxTestModules::addFunction( "oxutils", "seoIsActive", "{return false;}" );

        $oldTags = oxDb::getDb()->getOne('select OXTAGS from oxartextends where oxid="2000"');
        oxDb::getDb()->Execute('update oxartextends set OXTAGS = "a&addaa&#%<b>aa</b>_" where oxid="2000"');

        $e = null;
        try {
            $oTagCloud = new oxTagCloud();
            $sTag = $oTagCloud->getTagCloud('2000');
            $this->assertTrue(strpos($sTag, "index.php?cl=tag&amp;searchtag=a%26addaa%26%23%25%3Cb%3Eaa%3C%2Fb%3E&amp;lang=0'>a&amp;addaa&amp;#%&lt;b&gt;aa&lt;/b&gt;</a>") > 0);
        } catch(Exception $e) {
            // notihng for now
        }

        oxDb::getDb()->Execute("update oxartextends set OXTAGS = '".mysql_real_escape_string($oldTags)."' where oxid='2000'");

        if ($e) {
            throw $e;
        }
    }

    public function testGetTagCloudArticle()
    {
        oxTestModules::addFunction("oxutilsserver", "getServerVar", "{ \$aArgs = func_get_args(); if ( \$aArgs[0] === 'HTTP_HOST' ) { return '".oxConfig::getInstance()->getShopUrl()."'; } elseif ( \$aArgs[0] === 'SCRIPT_NAME' ) { return ''; } else { return \$_SERVER[\$aArgs[0]]; } }");
        oxTestModules::addFunction( "oxutils", "seoIsActive", "{return true;}" );
        $oTagCloud = new oxTagCloud();
        $sTag = $oTagCloud->getTagCloud('2000');
        $this->assertTrue(strpos($sTag, "tag/wanduhr/'>wanduhr</a>") > 0);
        $this->assertTrue(strpos($sTag, "tag/coolen/'>coolen</a>") > 0);
    }


    public function testGetTags()
    {
        $oTagCloud = new oxTagCloud();
        $aTags = $oTagCloud->getTags();
        $this->assertEquals(20, count($aTags));

            $this->assertFalse(isset($aTags['25wbezugshinweis']));
            $this->assertEquals(3, $aTags['wanduhr']);
    }

    public function testGetTagsEn()
    {
        $oTagCloud = new oxTagCloud();
            $iExpt = 20;
        $this->assertEquals($iExpt, count( $oTagCloud->getTags( null, null, 1 ) ) );
    }

    public function testGetTagsExtended()
    {
        $oTagCloud = new oxTagCloud();
        $aTags = $oTagCloud->getTags(null, true);
            $this->assertTrue(isset($aTags['25wbezugshinweis']));
            $this->assertEquals(200, count($aTags));
            $this->assertEquals(3, $aTags['wanduhr']);
    }

    public function testGetTagsExtendedEn()
    {
        $oTagCloud = new oxTagCloud();
            $iExpt = 81;
        $this->assertEquals( $iExpt, count( $oTagCloud->getTags( null, true, 1 ) ) );
    }

    public function testGetTagsArticle()
    {
        $oTagCloud = new oxTagCloud();
        $oTagCloud->resetTagCache();
        $aTags = $oTagCloud->getTags('2000');
        $this->assertTrue(isset($aTags['coolen']));

            $this->assertEquals(5, count($aTags));
    }

    public function testGetTagsArticleEn()
    {
        $oTagCloud = new oxTagCloud();
        $oTagCloud->resetTagCache();
            $iExpt = 1;
        $this->assertEquals( $iExpt, count( $oTagCloud->getTags( '2000', false, 1 ) ) );
    }

    public function testGetTagsArticleExtended()
    {
        $oTagCloud = new oxTagCloud();
        $oTagCloud->resetTagCache();
        $aTags = $oTagCloud->getTags('1126', true );

            $this->assertEquals(9, count($aTags));
            $this->assertTrue(isset($aTags['fee']));
    }

    public function testGetTagsArticleExtendedEn()
    {
        $oTagCloud = new oxTagCloud();
        $oTagCloud->resetTagCache();
            $iExpt = 2;

        $this->assertEquals( $iExpt, count( $oTagCloud->getTags('1126', true, 1 ) ) );
    }

    public function testGetTagsNotFound()
    {
        $oTagCloud = new oxTagCloud();
        $oTagCloud->resetTagCache();
        $aTags = $oTagCloud->getTags('test');
        $this->assertEquals(0, count($aTags));
    }

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
    }

    /*
    public function testAssignTagsFromSearchKeys()
    {
        $this->markTestIncomplete();
    }*/

    public function testPrepareTags()
    {
        $oTagCloud = new oxTagCloud();
        $this->assertEquals('tag1,tag2', $oTagCloud->prepareTags('tag1,tag2'));
        $this->assertEquals('tag1,tag2', $oTagCloud->prepareTags('tag1,tag2 '));
        $this->assertEquals('tag1,tag2', $oTagCloud->prepareTags('tag1,tag2,'));
        $this->assertEquals('tag1,tag2', $oTagCloud->prepareTags('tag1,, ,,tag2,'));
        $this->assertEquals('tag1 tag2', $oTagCloud->prepareTags('tag1 tag2 '));
        $this->assertEquals('tag1,tag2', $oTagCloud->prepareTags('tag1, tag2 '));
        $this->assertEquals('tag1,tag2', $oTagCloud->prepareTags('TAG1,tag2'));
        $this->assertEquals('ta__', $oTagCloud->prepareTags('ta'));
        $this->assertEquals('t___,t___', $oTagCloud->prepareTags('t,t'));
        $this->assertEquals('t t_', $oTagCloud->prepareTags('t t'));
        $this->assertEquals('', $oTagCloud->prepareTags(' '));
        $this->assertEquals('tag1,ta__,tag2,t___', $oTagCloud->prepareTags('tag1,,,,ta, tag2,t'));
        $this->assertEquals('bar_-set_', $oTagCloud->prepareTags('bar-set'));
        $this->assertEquals('bar_-sett', $oTagCloud->prepareTags('bar-sett'));
        $this->assertEquals('barr-sett', $oTagCloud->prepareTags('barr-sett'));
    }

    public function testTrimTags()
    {
        $oTagCloud = new oxTagCloud();
        $this->assertEquals('tag1,tag2', $oTagCloud->trimTags('tag1__,tag2 '));
        $this->assertEquals('tag1,tag2', $oTagCloud->trimTags('tag1__,,, ,tag2 '));
        $this->assertEquals('tag1__  tag2', $oTagCloud->trimTags('tag1__  tag2 '));
        $this->assertEquals('tag1_tag2', $oTagCloud->trimTags('tag1_tag2 '));
        $this->assertEquals('TAG1,tag2', $oTagCloud->trimTags('TAG1__,tag2'));
        $this->assertEquals('ta', $oTagCloud->trimTags('ta__'));
        $this->assertEquals('t,t', $oTagCloud->trimTags('t___,t____'));
        $this->assertEquals('____', $oTagCloud->trimTags('____'));
        $this->assertEquals('tag1,ta,tag2,t', $oTagCloud->trimTags('tag1, ta__,tag2 ,t___'));
        $this->assertEquals('tag1 ta__ tag2 t', $oTagCloud->trimTags('tag1 ta__ tag2 t___'));
        $this->assertEquals('bar-set', $oTagCloud->trimTags('bar_-set_'));
        $this->assertEquals('barr-set', $oTagCloud->trimTags('barr-set_'));
        $this->assertEquals('barr', $oTagCloud->trimTags(',barr,'));
    }

    public function testTagCache()
    {
        $oTagCloud = $this->getProxyClass('oxTagCloud');
        $sCacheKey1 = $oTagCloud->UNITgetCacheKey(true);//  "cloudtag_"."_".oxConfig::getInstance()->getShopID()."|".TRUE;
        $sCacheKey2 = $oTagCloud->UNITgetCacheKey(false);//"cloudtag_"."_".oxConfig::getInstance()->getShopID()."|".FALSE;

        //remove older files
        $oUtils = $this->getProxyClass("oxutils");
        $sFile1 = $oUtils->UNITgetCacheFilePath($sCacheKey1);
        $sFile2 = $oUtils->UNITgetCacheFilePath($sCacheKey2);
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
        $oTagCloud = $this->getProxyClass( 'oxTagCloud' );
            $this->assertEquals( 'tagcloud__oxbaseshop_1_1', $oTagCloud->UNITgetCacheKey( true, 1 ) );
            $this->assertEquals( 'tagcloud__oxbaseshop_1_', $oTagCloud->UNITgetCacheKey( false, 1 ) );
    }

    public function testGetCacheName()
    {
        $oTagCloud = $this->getProxyClass('oxTagCloud');
            $this->assertEquals('tagcloud__oxbaseshop_0_1', $oTagCloud->UNITgetCacheKey(true));
            $this->assertEquals('tagcloud__oxbaseshop_0_', $oTagCloud->UNITgetCacheKey(false));
    }

}
