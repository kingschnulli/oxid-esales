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
 * @version   SVN: $Id: oxvendorlistTest.php 26841 2010-03-25 13:58:15Z arvydas $
 */

require_once realpath( "." ).'/unit/OxidTestCase.php';
require_once realpath( "." ).'/unit/test_config.inc.php';

class modUtils_oxvendorlist extends oxutils
{
    public function seoIsActive($blReset = false, $sShopId = null, $iActLang = null)
    {
        return true;
    }
}

/**
 * Testing oxvendorlist class
 */
class Unit_Core_oxvendorlistTest extends OxidTestCase
{
    /**
     * Tear down the fixture.
     *
     * @return null
     */
    protected function tearDown()
    {
        oxTestModules::addFunction('oxVendor', 'cleanRootVendor', '{oxVendor::$_aRootVendor = array();}');
        oxNew('oxvendor')->cleanRootVendor();
        oxRemClassModule('modUtils_oxvendorlist');

        parent::tearDown();
    }

    /**
     * Test loading simple vendor list
     */
/*    public function test_loadVendorList() {
        $myUtils = oxUtils::getInstance();
        $myConfig= oxConfig::getInstance();
        $myDB    = oxDb::getDB();

        $oVendorlist = oxNew( 'oxvendorlist' );
        $oVendorlist->loadVendorList(true, true, true);

        $this->assertTrue((count($oVendorlist) > 0), "Vendors list not loaded");

        // checking if vendros are the same
        $sQ = 'select oxid from oxvendor where oxvendor.oxshopid = "'.$myConfig->getShopID().'"';
        $rs = $myDB->Execute( $sQ );


        if ( $rs != false && $rs->RecordCount() > 0 ) {
            while ( !$rs->EOF ) {
                if ( !isset( $oVendorlist[ $rs->fields[0] ] ) )
                    $this->fail('Not all vendors are loaded');
                $rs->MoveNext();
            }
        } else {
            $this->fail('No records found in vendors table');
        }

    }
*/
    /**
     * Test loading simple vendor list by selected language
     */
    public function test_loadVendorListByLanguage()
    {
        $myUtils = oxUtils::getInstance();
        $myConfig= modConfig::getInstance();
        $myDB    = oxDb::getDB();

        //modConfig::addClassVar("_iLanguageId","1"); //$oVendorlist->sLanguage = '1';
        //$myConfig->addClassFunction("getShopLanguage",create_function("","return 1;"));
        oxLang::getInstance()->setBaseLanguage( 1 );

        $oVendorlist = oxNew( 'oxvendorlist' );

        $oVendorlist->loadVendorList();

        $this->assertTrue((count($oVendorlist) > 0), "Vendors list not loaded");

        // checking if vendros are the same
        $sQ = 'select oxid, oxtitle_1, oxshortdesc_1 from oxvendor where oxvendor.oxshopid = "'.$myConfig->getShopID().'"';
        $rs = $myDB->Execute( $sQ );

        if ( $rs != false && $rs->RecordCount() > 0 ) {
            while ( !$rs->EOF ) {
                $this->assertEquals($rs->fields[1], $oVendorlist[$rs->fields[0]]->oxvendor__oxtitle->value);
                $this->assertEquals($rs->fields[2], $oVendorlist[$rs->fields[0]]->oxvendor__oxshortdesc->value);
                $rs->MoveNext();
            }
        } else {
            $this->fail('No records found in vendors table with lang id = 1');
        }
    }

    /**
     * Test loading simple vendor list and counting vendor articles
     */
    public function test_loadVendorListAndCountVendorArticles()
    {
        $myUtils = oxUtils::getInstance();

        modConfig::getInstance()->setConfigParam( 'bl_perfShowActionCatArticleCnt', true );

        $oVendorlist = oxNew( 'oxvendorlist' );
        $oVendorlist->setShowVendorArticleCnt( true );
        $oVendorlist->loadVendorList();

        foreach ($oVendorlist as $sVndId => $value) {
            $iArtCount = $oVendorlist[$sVndId]->oxvendor__oxnrofarticles->value;
            $this->assertTrue( ($iArtCount > 0), "Vendor articles were not counted" );
        }
    }

    /**
     * Test creating root for vendor tree, and adding category list fields for each vendor item
     */
    public function test_BuildVendorTree()
    {
        $myConfig= oxConfig::getInstance();
        $myDB    = oxDb::getDB();

        $oVendorlist = $this->getProxyClass("oxvendorList"); //oxNew('oxvendorlist', 'core');

        // get first vendor id
        $sQ = 'select oxid from oxvendor where oxvendor.oxshopid = "'.$myConfig->getShopID().' "';
        $sFirstVendorId = $myDB->getOne( $sQ );

        // build vendors and add first vendor to vendors tree path array
        $oVendorlist->buildVendorTree('vendorList', $sFirstVendorId, $myConfig->getShopHomeURL());

        //check if root for vendors tree was added
        $aPath = $oVendorlist->getPath();


        $this->assertNotNull( $oVendorlist->getClickVendor() );
        $this->assertEquals( $sFirstVendorId, $oVendorlist->getClickVendor()->getId() );
        $this->assertEquals( $aPath[0], $oVendorlist->getRootCat() );
        $this->assertEquals('root', $aPath[0]->getId(), 'Not added root for vendor tree'); //oxvendor__oxid->value

        //check if first vendor was added to vendors tree path array
        $this->assertEquals($sFirstVendorId, $aPath[1]->getId(), 'Vendor was not added to vendors tree path');

        //check if category list fields was added for each vendor item
        foreach ($oVendorlist as $sVndId => $value) {
           if (empty($oVendorlist[$sVndId]->oxcategories__oxid->value)) {
                   $this->fail('Category list fields was not added for each vendor');
           }
        }
    }

    /**
     * Test adding category specific fields to vendor object
     */
    public function test_addCategoryFields()
    {
        oxTestModules::addFunction("oxutils", "seoIsActive", "{return false;}");
        $myConfig = oxConfig::getInstance();

        $oVendorlist = new oxvendorlist();
        $oVendorlist->loadVendorList();
        $oVendor = $oVendorlist->current();

        $oVendorlist->UNITaddCategoryFields( $oVendor );

        // check if category specific fields was added to vendor object
        $this->assertEquals( "v_".$oVendor->getId(), $oVendor->oxcategories__oxid->value );
        $this->assertEquals( $oVendor->oxvendor__oxicon, $oVendor->oxcategories__oxicon );
        $this->assertEquals( $oVendor->oxvendor__oxtitle, $oVendor->oxcategories__oxtitle );
        $this->assertEquals( $oVendor->oxvendor__oxshortdesc, $oVendor->oxcategories__oxdesc );
        $this->assertEquals( $myConfig->getShopHomeURL()."cl=vendorlist&amp;cnid={$oVendor->oxcategories__oxid->value}", $oVendor->getLink() );

        $this->assertTrue( $oVendor->getIsVisible() );
        $this->assertFalse( $oVendor->hasVisibleSubCats );
    }

    /**
     * Test adding SEO links to vendor object
     */
    public function test_SEOsetVendorData()
    {
        oxAddClassModule('modUtils_oxvendorlist', 'oxutils');

        $oVendorlist = $this->getProxyClass("oxvendorlist");
        $oVendorlist->loadVendorList();

        $oVendorlist->UNITSeosetVendorData();

        //check if SEO link was added for each vendor item
        foreach ($oVendorlist as $sVndId => $value) {
            $sVendorLink = $oVendorlist[$sVndId]->link;
            if ( !$sVendorLink || strstr( $sVendorLink, 'index.php' ) !== false ) {
                $this->fail( "SEO link was not added to vendor object ({$sVendorLink})");
            }
        }

    }

    public function testGetHtmlPathRootVendorWithSeo()
    {
        oxTestModules::addFunction("oxutilsserver", "getServerVar", "{ \$aArgs = func_get_args(); if ( \$aArgs[0] === 'HTTP_HOST' ) { return '".oxConfig::getInstance()->getShopUrl()."'; } elseif ( \$aArgs[0] === 'SCRIPT_NAME' ) { return ''; } else { return \$_SERVER[\$aArgs[0]]; } }");
        oxTestModules::addFunction("oxutils", "seoIsActive", "{return true;}");

        $oVendorTree = new oxvendorlist();
        $oVendorTree->buildVendorTree( 'vendorlist', 'v_root', oxConfig::getInstance()->getShopHomeURL() );

        $sHtmlPath = $oVendorTree->getHtmlPath();
        $sShopUrl = oxConfig::getInstance()->getShopUrl();
        $sExpt = " <a href='".$sShopUrl."Nach-Lieferant/'>Nach Lieferant</a>";
        //substringing due to special chars in the link (should be fixed by seo)
        //anyway we check something else
        $this->assertEquals( $sExpt, $sHtmlPath);
    }

    public function testGetHtmlPathWithSeo()
    {
        oxTestModules::addFunction("oxutilsserver", "getServerVar", "{ \$aArgs = func_get_args(); if ( \$aArgs[0] === 'HTTP_HOST' ) { return '".oxConfig::getInstance()->getShopUrl()."'; } elseif ( \$aArgs[0] === 'SCRIPT_NAME' ) { return ''; } else { return \$_SERVER[\$aArgs[0]]; } }");
        oxTestModules::addFunction("oxutils", "seoIsActive", "{return true;}");

        $oVendorTree = new oxvendorlist();
        $sVendId = 'v_68342e2955d7401e6.18967838';
        $oVendorTree->buildVendorTree( 'vendorlist', $sVendId, oxConfig::getInstance()->getShopHomeURL() );

        $sHtmlPath = $oVendorTree->getHtmlPath();
        $sShopUrl = oxConfig::getInstance()->getShopUrl();

        $sExpt = " <a href='".$sShopUrl."Nach-Lieferant/'>Nach Lieferant</a> / <a href='".$sShopUrl."Nach-Lieferant/Hersteller-1/'>Hersteller 1</a>";
            $sExpt = " <a href='".$sShopUrl."Nach-Lieferant/'>Nach Lieferant</a> / <a href='".$sShopUrl."Nach-Lieferant/Haller-Stahlwaren/'>Haller Stahlwaren</a>";
        $this->assertEquals( $sExpt, $sHtmlPath);
    }

    public function testGetHtmlPath()
    {
        oxTestModules::addFunction("oxutils", "seoIsActive", "{return false;}");
        $oVendorTree = new oxvendorlist();
        $sVendId = 'v_68342e2955d7401e6.18967838';
        $oVendorTree->buildVendorTree( 'vendorlist', $sVendId, oxConfig::getInstance()->getShopHomeURL() );

        $sHtmlPath = $oVendorTree->getHtmlPath();
        $sShopUrl = oxConfig::getInstance()->getShopHomeUrl();

        $sExpt = " <a href='".$sShopUrl."cl=vendorlist&amp;cnid=v_root'>Nach Lieferant</a> / <a href='".$sShopUrl."cl=vendorlist&amp;cnid=".$sVendId."'>Hersteller 1</a>";
            $sExpt = " <a href='".$sShopUrl."cl=vendorlist&amp;cnid=v_root'>Nach Lieferant</a> / <a href='".$sShopUrl."cl=vendorlist&amp;cnid=".$sVendId."'>Haller Stahlwaren</a>";
        $this->assertEquals( $sExpt, $sHtmlPath);
    }

}
