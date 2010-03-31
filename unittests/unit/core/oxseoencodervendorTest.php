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
 * @version   SVN: $Id: oxseoencodervendorTest.php 26841 2010-03-25 13:58:15Z arvydas $
 */

require_once realpath( "." ).'/unit/OxidTestCase.php';
require_once realpath( "." ).'/unit/test_config.inc.php';

class modOxVendorForoxSeoEncoderVendorTest extends oxVendor
{
    public static function reSetRootVendor()
    {
        self::$_aRootVendor = array();
    }
}

/**
 * Testing oxseoencodervendor class
 */
class Unit_Core_oxSeoEncoderVendorTest extends OxidTestCase
{
    /**
     * Initialize the fixture.
     *
     * @return null
     */
    protected function setUp()
    {
        parent::setUp();

        oxTestModules::addFunction("oxutils", "seoIsActive", "{return true;}");
        //echo $this->getName()."\n";
    }

    /**
     * Tear down the fixture.
     *
     * @return null
     */
    protected function tearDown()
    {
        modDB::getInstance()->cleanup();
        // deleting seo entries
        oxDb::getDb()->execute( 'delete from oxseo where oxtype != "static"' );
        oxDb::getDb()->execute( 'delete from oxseohistory' );

        $this->cleanUpTable( 'oxcategories' );

        parent::tearDown();
    }

    public function __SaveToDbCreatesGoodMd5Callback($sSQL)
    {
        $this->aSQL[] = $sSQL;
        if ($this->aRET && isset($this->aRET[count($this->aSQL)-1])) {
            return $this->aRET[count($this->aSQL)-1];
        }
    }

    public function testGetInstance()
    {
        $this->assertTrue( oxSeoEncoderVendor::getInstance() instanceof oxSeoEncoderVendor );
    }

    public function testGetVendorUrlExistingVendor()
    {
        oxTestModules::addFunction("oxutilsserver", "getServerVar", "{ \$aArgs = func_get_args(); if ( \$aArgs[0] === 'HTTP_HOST' ) { return '".oxConfig::getInstance()->getShopUrl()."'; } elseif ( \$aArgs[0] === 'SCRIPT_NAME' ) { return ''; } else { return \$_SERVER[\$aArgs[0]]; } }");
            $sVndId = '77442e37fdf34ccd3.94620745';
            $sUrl   = oxConfig::getInstance()->getShopUrl().'Nach-Lieferant/Bush/';

        $oVendor = new oxVendor();
        $oVendor->load( $sVndId );

        $oEncoder = new oxSeoEncoderVendor();
        $this->assertEquals( $sUrl, $oEncoder->getVendorUrl( $oVendor ) );
    }
    public function testGetVendorUrlExistingVendorEng()
    {
        oxTestModules::addFunction("oxutilsserver", "getServerVar", "{ \$aArgs = func_get_args(); if ( \$aArgs[0] === 'HTTP_HOST' ) { return '".oxConfig::getInstance()->getShopUrl()."'; } elseif ( \$aArgs[0] === 'SCRIPT_NAME' ) { return ''; } else { return \$_SERVER[\$aArgs[0]]; } }");
        oxTestModules::addFunction('oxVendor', 'resetRootVendor', '{ self::$_aRootVendor = array() ; }');
        $oVendor = oxNew( 'oxVendor' );
        $oVendor->resetRootVendor();

            $sVndId = '77442e37fdf34ccd3.94620745';
            $sUrl   = oxConfig::getInstance()->getShopUrl().'en/By-Distributor/Bush/';

        $oVendor = new oxVendor();
        $oVendor->loadInLang( 1, $sVndId );

        $oEncoder = new oxSeoEncoderVendor();
        $this->assertEquals( $sUrl, $oEncoder->getVendorUrl( $oVendor ) );
    }
    public function testGetVendorUrlExistingVendorWithLangParam()
    {
        oxTestModules::addFunction("oxutilsserver", "getServerVar", "{ \$aArgs = func_get_args(); if ( \$aArgs[0] === 'HTTP_HOST' ) { return '".oxConfig::getInstance()->getShopUrl()."'; } elseif ( \$aArgs[0] === 'SCRIPT_NAME' ) { return ''; } else { return \$_SERVER[\$aArgs[0]]; } }");
            $sVndId = '77442e37fdf34ccd3.94620745';
            $sUrl   = oxConfig::getInstance()->getShopUrl().'Nach-Lieferant/Bush/';

        $oVendor = new oxVendor();
        $oVendor->loadInLang( 1, $sVndId );

        $oEncoder = new oxSeoEncoderVendor();
        $this->assertEquals( $sUrl, $oEncoder->getVendorUrl( $oVendor, 0 ) );
    }
    public function testGetVendorUrlExistingVendorEngWithLangParam()
    {
        oxTestModules::addFunction("oxutilsserver", "getServerVar", "{ \$aArgs = func_get_args(); if ( \$aArgs[0] === 'HTTP_HOST' ) { return '".oxConfig::getInstance()->getShopUrl()."'; } elseif ( \$aArgs[0] === 'SCRIPT_NAME' ) { return ''; } else { return \$_SERVER[\$aArgs[0]]; } }");
        oxTestModules::addFunction('oxVendor', 'resetRootVendor', '{ self::$_aRootVendor = array() ; }');
        $oVendor = oxNew( 'oxVendor' );
        $oVendor->resetRootVendor();

            $sVndId = '77442e37fdf34ccd3.94620745';
            $sUrl   = oxConfig::getInstance()->getShopUrl().'en/By-Distributor/Bush/';

        $oVendor = new oxVendor();
        $oVendor->loadInLang( 0, $sVndId );

        $oEncoder = new oxSeoEncoderVendor();
        $this->assertEquals( $sUrl, $oEncoder->getVendorUrl( $oVendor, 1 ) );
    }

    /**
     * Testing vendor uri getter
     */
    public function testGetVendorUriExistingVendor()
    {
        $oVendor = new oxVendor();
        $oVendor->setId( 'xxx' );

        $oEncoder = $this->getMock( 'oxSeoEncoderVendor', array( '_loadFromDb', '_prepareTitle' ) );
        $oEncoder->expects( $this->once() )->method('_loadFromDb')->with( $this->equalTo( 'oxvendor' ), $this->equalTo( 'xxx' ), $this->equalTo( $oVendor->getLanguage() ) )->will( $this->returnValue( 'seourl' ) );
        $oEncoder->expects( $this->never() )->method( '_prepareTitle' );
        $oEncoder->expects( $this->never() )->method( '_getUniqueSeoUrl' );
        $oEncoder->expects( $this->never() )->method( '_saveToDb' );

        $sUrl    = 'seourl';
        $sSeoUrl = $oEncoder->getVendorUri( $oVendor );
        $this->assertEquals( $sUrl, $sSeoUrl );
    }
    public function testGetVendorUriRootVendor()
    {
        $oVendor = new oxVendor();
        $oVendor->setId( 'root' );
        $oVendor->oxvendor__oxtitle = new oxField('root', oxField::T_RAW);

        $oEncoder = $this->getMock( 'oxSeoEncoderVendor', array( '_saveToDb' ) );
        $oEncoder->expects( $this->once() )->method('_saveToDb')->with( $this->equalTo( 'oxvendor' ), $this->equalTo( 'root' ), $this->equalTo( $oVendor->getStdLink() ), $this->equalTo( 'root/' ), $this->equalTo( $oVendor->getLanguage() ) );

        $sUrl    = 'root/';
        $sSeoUrl = $oEncoder->getVendorUri( $oVendor );
        $this->assertEquals( $sUrl, $sSeoUrl );
    }
    public function testGetVendorUriRootVendorSecondLanguage()
    {
        $oVendor = new oxVendor();
        $oVendor->setId( 'root' );
        $oVendor->setLanguage( 1 );
        $oVendor->oxvendor__oxtitle = new oxField('root', oxField::T_RAW);

        $oEncoder = $this->getMock( 'oxSeoEncoderVendor', array( '_saveToDb' ) );
        $oEncoder->expects( $this->once() )->method('_saveToDb')->with( $this->equalTo( 'oxvendor'), $this->equalTo( 'root' ), $this->equalTo( $oVendor->getStdLink() ), $this->equalTo( 'en/root/' ), $this->equalTo( $oVendor->getLanguage() ) );

        $sUrl    = 'en/root/';
        $sSeoUrl = $oEncoder->getVendorUri( $oVendor );
        $this->assertEquals( $sUrl, $sSeoUrl );
    }
    public function testGetVendorUriNewVendor()
    {
        modOxVendorForoxSeoEncoderVendorTest::reSetRootVendor();

        $oVendor = new oxVendor();
        $oVendor->setLanguage( 1 );
        $oVendor->setId( 'xxx' );
        $oVendor->oxvendor__oxtitle = new oxField('xxx', oxField::T_RAW);

        $oEncoder = $this->getMock( 'oxSeoEncoderVendor', array( '_loadFromDb', '_saveToDb' ) );
        $oEncoder->expects( $this->exactly( 2 ) )->method('_loadFromDb')->will( $this->returnValue( false ) );

        $sUrl    = 'en/By-Distributor/xxx/';
        $sSeoUrl = $oEncoder->getVendorUri( $oVendor );

        $this->assertEquals( $sUrl, $sSeoUrl );
    }

    /**
     * Testing object url getter
     */
    public function testGetVendorPageUrl()
    {
        oxTestModules::addFunction("oxutilsserver", "getServerVar", "{ \$aArgs = func_get_args(); if ( \$aArgs[0] === 'HTTP_HOST' ) { return '".oxConfig::getInstance()->getShopUrl()."'; } elseif ( \$aArgs[0] === 'SCRIPT_NAME' ) { return ''; } else { return \$_SERVER[\$aArgs[0]]; } }");
            $sUrl = oxConfig::getInstance()->getShopUrl() . 'en/By-Distributor/Bush/101/';
            $sVndId = '77442e37fdf34ccd3.94620745';

        $oVendor = new oxVendor();
        $oVendor->loadInLang( 1, $sVndId );

        $oEncoder = new oxSeoEncoderVendor();
        $this->assertEquals( $sUrl, $oEncoder->getVendorPageUrl( $oVendor, 100 ) );
    }
    public function testGetVendorPageUrlWithLangParam()
    {
        oxTestModules::addFunction("oxutilsserver", "getServerVar", "{ \$aArgs = func_get_args(); if ( \$aArgs[0] === 'HTTP_HOST' ) { return '".oxConfig::getInstance()->getShopUrl()."'; } elseif ( \$aArgs[0] === 'SCRIPT_NAME' ) { return ''; } else { return \$_SERVER[\$aArgs[0]]; } }");
            $sUrl = oxConfig::getInstance()->getShopUrl() . 'en/By-Distributor/Bush/101/';
            $sVndId = '77442e37fdf34ccd3.94620745';

        $oVendor = new oxVendor();
        $oVendor->loadInLang( 0, $sVndId );

        $oEncoder = new oxSeoEncoderVendor();
        $this->assertEquals( $sUrl, $oEncoder->getVendorPageUrl( $oVendor, 100, 1 ) );
    }
    public function testGetVendorUrl()
    {
        $oVendor = $this->getMock( 'oxcategory', array( 'getLanguage' ) );
        $oVendor->expects( $this->once() )->method('getLanguage')->will( $this->returnValue( 0 ) );

        $oEncoder = $this->getMock( 'oxSeoEncoderVendor', array( '_getFullUrl', 'getVendorUri' ) );
        $oEncoder->expects( $this->once() )->method('_getFullUrl')->will( $this->returnValue( 'seovndurl' ) );
        $oEncoder->expects( $this->once() )->method('getVendorUri');

        $this->assertEquals( 'seovndurl', $oEncoder->getVendorUrl( $oVendor ) );
    }

    public function testGetVendorUriExistingVendorWithLangParam()
    {
        $oVendor = new oxVendor();
        $oVendor->setLanguage(1);
        $oVendor->setId( 'xxx' );

        $oEncoder = $this->getMock( 'oxSeoEncoderVendor', array( '_loadFromDb', '_prepareTitle' ) );
        $oEncoder->expects( $this->once() )->method('_loadFromDb')->with( $this->equalTo( 'oxvendor' ), $this->equalTo( 'xxx' ), $this->equalTo( 0 ) )->will( $this->returnValue( 'seourl' ) );
        $oEncoder->expects( $this->never() )->method( '_prepareTitle' );
        $oEncoder->expects( $this->never() )->method( '_getUniqueSeoUrl' );
        $oEncoder->expects( $this->never() )->method( '_saveToDb' );

        $sUrl    = 'seourl';
        $sSeoUrl = $oEncoder->getVendorUri( $oVendor, 0 );
        $this->assertEquals( $sUrl, $sSeoUrl );
    }
    public function testGetVendorUriRootVendorWithLangParam()
    {
        $oVendor = new oxVendor();
        $oVendor->setId( 'root' );
        $oVendor->oxvendor__oxtitle = new oxField('root', oxField::T_RAW);

        $oEncoder = $this->getMock( 'oxSeoEncoderVendor', array( '_saveToDb' ) );
        $oEncoder->expects( $this->once() )->method('_saveToDb')->with( $this->equalTo( 'oxvendor' ), $this->equalTo( 'root' ), $this->equalTo( $oVendor->getStdLink(1) ), $this->equalTo( 'en/By-Distributor/' ), $this->equalTo( 1 ) );

        $sUrl    = 'en/By-Distributor/';
        $sSeoUrl = $oEncoder->getVendorUri( $oVendor, 1 );
        $this->assertEquals( $sUrl, $sSeoUrl );
    }

    public function testonDeleteVendor()
    {
        $obj = new oxbase();
        $obj->setId('oid');

        $sSql = "delete from oxseo where oxobjectid = \'oid\' and oxtype = \'oxvendor\'";
        modDB::getInstance()->addClassFunction('execute', create_function('$s', "if (\$s != '$sSql') {throw new Exception(\$s.\" \nis not equal \n\".'$sSql');}"));

        try {
            $o = new oxSeoEncoderVendor();
            $o->onDeleteVendor($obj);
        } catch (Exception $e) {
            $this->fail($e->getMessage());
        }
    }

}
