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
 * @version   SVN: $Id: oxoutputTest.php 32348 2011-01-04 08:44:43Z sarunas $
 */

require_once realpath( "." ).'/unit/OxidTestCase.php';
require_once realpath( "." ).'/unit/test_config.inc.php';

class oxUtils_Extended extends oxUtils
{
    public function checkForSearchEngines($blIsSEOverride = -1)
    {
        return true;
    }
}

class oxOutput_Extended extends oxOutput
{
    public function _SIDCallBack( $aMatches )
    {
        return parent::_SIDCallBack($aMatches );
    }
}

class oxConfigForUnit_oxoutputTest extends oxconfig
{
    public function getShopURL( $iLang = null, $blAdmin = null )
    {
        return 'www.test.com';
    }
}

class Unit_Core_oxoutputTest extends OxidTestCase
{

    /**
     * Initialize the fixture.
     *
     * @return null
     */
    protected function setUp()
    {
        parent::setUp();
        oxAddClassModule('oxUtils_Extended', 'oxUtils');
        oxAddClassModule('oxOutput_Extended', 'oxOutput');
    }

    /**
     * Tear down the fixture.
     *
     * @return null
     */
    public function tearDown()
    {
        oxRemClassModule('oxUtils_Extended');
        oxRemClassModule('oxOutput_Extended');

        parent::tearDown();
    }

    /**
     * Testing output processor
     */
    public function testProcess()
    {
        $oOutput = oxNew( 'oxOutput' );
        $this->assertEquals( 'someting', $oOutput->process( 'someting', 'something' ) );
    }

    /**
     * Testing output processor replaces euro sign in non utf mode
     */
    public function testProcessWithEuroSign()
    {
        $oOutput = oxNew( 'oxOutput' );
        oxConfig::getInstance()->setConfigParam( 'blSkipEuroReplace', false );
        modConfig::getInstance()->setConfigParam( 'iUtfMode', 0 );
        $this->assertEquals( '&euro;someting', $oOutput->process( '�someting', 'something' ) );
    }

    /**
     * Testing output processor replaces euro sign in utf mode
     */
    public function testProcessWithEuroSignInUtfMode()
    {
        $oOutput = oxNew( 'oxOutput' );
        oxConfig::getInstance()->setConfigParam( 'blSkipEuroReplace', false );
        modConfig::getInstance()->setConfigParam( 'iUtfMode', 1 );
        $this->assertEquals( '�someting', $oOutput->process( '�someting', 'something' ) );
    }

    /**
     * Testing output processor replaces euro sign when replacing disabled
     */
    public function testProcessWithEuroSignWithDisabledReplace()
    {
        $oOutput = oxNew( 'oxOutput' );
        oxConfig::getInstance()->setConfigParam( 'blSkipEuroReplace', true );
        oxConfig::getInstance()->setConfigParam( 'iUtfMode', 0 );

        $this->assertEquals( '�someting', $oOutput->process( '�someting', 'something' ) );
    }

    public function testAddVersionTags()
    {
        $myConfig = oxConfig::getInstance();
        $sVersion = $myConfig->getActiveShop()->oxshops__oxversion->value;
        $sVersion = $myConfig->getActiveShop()->oxshops__oxversion = new oxField("9.9", oxField::T_RAW);
        $sCurYear = date("Y");

        $sMajorVersion = '9';

        $oOutput = new oxOutput();
        $sTest = "<head>foo</head>bar";
        $sRes = $oOutput->addVersionTags( $sTest );
        //reset value
        $myConfig->getActiveShop()->oxshops__oxversion = new oxField($sVersion, oxField::T_RAW);

            $this->assertNotEquals($sTest, $sRes);
            $this->assertEquals( "<head>foo</head>\n  <!-- OXID eShop Community Edition, Version $sMajorVersion, Shopping Cart System (c) OXID eSales AG 2003 - $sCurYear - http://www.oxid-esales.com -->bar", $sRes );


    }

    /**
     * Bug #1800, fix test
     *
     */
    public function testAddVersionTagsUpperCase()
    {
        $myConfig = oxConfig::getInstance();
        $sVersion = $myConfig->getActiveShop()->oxshops__oxversion->value;
        $sVersion = $myConfig->getActiveShop()->oxshops__oxversion = new oxField("9.9", oxField::T_RAW);
        $sCurYear = date("Y");

        $sMajorVersion = '9';

        $oOutput = new oxOutput();
        $sTest = "<head>foo</Head>bar";
        $sRes = $oOutput->addVersionTags( $sTest );
        //reset value
        $myConfig->getActiveShop()->oxshops__oxversion = new oxField($sVersion, oxField::T_RAW);

            $this->assertNotEquals($sTest, $sRes);
            $this->assertEquals( "<head>foo</head>\n  <!-- OXID eShop Community Edition, Version $sMajorVersion, Shopping Cart System (c) OXID eSales AG 2003 - $sCurYear - http://www.oxid-esales.com -->bar", $sRes );



    }

    /**
     * Testing view processor
     */
    public function testProcessViewArray()
    {
        $oOutput = oxNew( 'oxOutput' );
        $this->assertEquals( array( 'something' ), $oOutput->processViewArray( array( 'something' ), 'something' ) );
    }

    /**
     * Testing email processor
     */
    public function testProcessEmail()
    {
        $oOutput = oxNew( 'oxOutput' );
        $oEmail = new Oxstdclass();
        $oEmail->email = 1;
        $oEmail2 = clone $oEmail;
        $oOutput->processEmail( $oEmail );
        $this->assertEquals( $oEmail2, $oEmail );
    }
}
