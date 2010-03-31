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
 * @version   SVN: $Id: oxseoencodertagTest.php 26841 2010-03-25 13:58:15Z arvydas $
 */

require_once realpath( "." ).'/unit/OxidTestCase.php';
require_once realpath( "." ).'/unit/test_config.inc.php';

/**
 * Testing oxseoencodertag class
 */
class Unit_Core_oxSeoEncoderTagTest extends OxidTestCase
{
    /**
     * Initialize the fixture.
     *
     * @return null
     */
    protected function setUp()
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
        // deleting seo entries
        oxDb::getDb()->execute( 'delete from oxseo where oxtype != "static"' );
        oxDb::getDb()->execute( 'delete from oxseohistory' );

        parent::tearDown();
    }

    public function testGetInstance()
    {
        $oInst = oxSeoEncoderTag::getInstance();
        $this->assertTrue( $oInst instanceof oxSeoEncoderTag );
    }

    public function testGetTagUri()
    {
        $oEncoder = $this->getMock( 'oxSeoEncoderTag', array( '_getDynamicUri', 'getStdTagUri' ) );
        $oEncoder->expects( $this->once() )->method( 'getStdTagUri' )->will( $this->returnValue( 'stdTagUri' ) );
        $oEncoder->expects( $this->once() )->method( '_getDynamicUri' )->with( $this->equalTo( 'stdTagUri' ), "tag/sTag/", 999 )->will( $this->returnValue( 'seoTagUri' ) );

        $this->assertEquals( 'seoTagUri', $oEncoder->getTagUri( 'sTag', 999 ) );
    }

    public function testGetStdTagUri()
    {
        $oEncoder = new oxSeoEncoderTag();
        $this->assertEquals( "index.php?cl=tag&amp;searchtag=sTag", $oEncoder->getStdTagUri( 'sTag' ) );
    }

    public function testGetTagUrl()
    {
        $iLang = oxLang::getInstance()->getBaseLanguage();
        $sTag  = 'sTag';

        $oEncoder = $this->getMock( 'oxSeoEncoderTag', array( '_getFullUrl', 'getTagUri' ) );
        $oEncoder->expects( $this->once() )->method( 'getTagUri' )->with( $this->equalTo( $sTag ), $this->equalTo( $iLang ) )->will( $this->returnValue( 'seoTagUri' ) );
        $oEncoder->expects( $this->once() )->method( '_getFullUrl' )->with(  $this->equalTo( 'seoTagUri' ), $iLang  )->will( $this->returnValue( 'seoTagUrl' ) );

        $this->assertEquals( 'seoTagUrl', $oEncoder->getTagUrl( $sTag ) );
    }

    public function testGetTagPageUrl()
    {
        oxTestModules::addFunction("oxutilsserver", "getServerVar", "{ \$aArgs = func_get_args(); if ( \$aArgs[0] === 'HTTP_HOST' ) { return '".oxConfig::getInstance()->getShopUrl()."'; } elseif ( \$aArgs[0] === 'SCRIPT_NAME' ) { return ''; } else { return \$_SERVER[\$aArgs[0]]; } }");
        $sUrl = oxConfig::getInstance()->getShopUrl( oxLang::getInstance()->getBaseLanguage() );

        $oSeoEncoderTag = new oxSeoEncoderTag();
        $this->assertEquals( $sUrl.'tag/sSomeTag/16/', $oSeoEncoderTag->getTagPageUrl( 'sSomeTag', 15  ) );
        $this->assertEquals( $sUrl.'tag/sSomeTag/16/', $oSeoEncoderTag->getTagPageUrl( 'sSomeTag', 15  ) );

        $this->assertEquals( $sUrl.'tag/sSomeAlternativeTag/14/', $oSeoEncoderTag->getTagPageUrl( 'sSomeAlternativeTag', 13  ) );
    }
}
