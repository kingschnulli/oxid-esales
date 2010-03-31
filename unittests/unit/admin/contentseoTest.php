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
 * @version   SVN: $Id: contentseoTest.php 25400 2010-01-27 22:42:50Z alfonsas $
 */

require_once realpath( "." ).'/unit/OxidTestCase.php';
require_once realpath( "." ).'/unit/test_config.inc.php';

/**
 * Tests for Content_Seo class
 */
class Unit_Admin_ContentSeoTest extends OxidTestCase
{
    /**
     * Sets up test
     *
     * @return null
     */
    protected function setUp()
    {
        parent::setUp();
        oxTestModules::addFunction( 'oxSeoEncoderContent', 'cleanup', '{ self::$_instance = null; }');
    }

    /**
     * Tear down the fixture.
     *
     * @return null
     */
    protected function tearDown()
    {
        oxSeoEncoderContent::getInstance()->cleanup();
        parent::tearDown();
    }

    /**
     * Content_Seo::GetSeoUrl() test case
     *
     * @return null
     */
    public function testGetSeoUrl()
    {
        oxTestModules::addFunction( 'oxSeoEncoderContent', 'getContentUrl', '{}');

        // defining parameters
        $oView = $this->getMock( "Content_Seo", array( "_getSeoUrlQuery" ) );
        $oView->expects( $this->once() )->method( '_getSeoUrlQuery' )->will( $this->returnValue( "select 1" ) );
        $this->assertEquals( "1", $oView->UNITgetSeoUrl( new oxContent ) );
    }

    /**
     * Content_Seo::GetType() test case
     *
     * @return null
     */
    public function testGetType()
    {
        // testing..
        $oView = new Content_Seo();
        $this->assertEquals( 'oxcontent', $oView->UNITgetType() );
    }

    /**
     * Content_Seo::Render() test case
     *
     * @return null
     */
    public function testRender()
    {
        // testing..
        $oView = new Content_Seo();
        $this->assertEquals( 'object_seo.tpl', $oView->render() );
    }
}
