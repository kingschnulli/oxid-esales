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
 * @version   SVN: $Id: wishlistTest.php 25505 2010-02-02 02:12:13Z alfonsas $
 */

require_once realpath( "." ).'/unit/OxidTestCase.php';
require_once realpath( "." ).'/unit/test_config.inc.php';

class Unit_Views_tagsTest extends OxidTestCase
{
    /**
     * Testing Tags::render()
     *
     * @return null
     */
    public function testRender()
    {
        $oView = $this->getMock( "Tags", array( "getTagCloud", "isMoreTagsVisible" ) );
        $oView->expects( $this->once() )->method( 'getTagCloud');
        $oView->expects( $this->once() )->method( 'isMoreTagsVisible');
        $this->assertEquals( 'tags.tpl', $oView->render() );
    }

    /**
     * Testing Tags::getTagCloud()
     *
     * @return null
     */
    public function testGetTagCloud()
    {
        oxTestModules::addFunction( 'oxTagCloud', 'getTagCloud', '{ return "getTagCloud"; }' );

        $oView = new Tags();
        $this->assertEquals( 'getTagCloud', $oView->getTagCloud() );
    }

    /**
     * Testing Tags::getTagCloudManager()
     *
     * @return null
     */
    public function testGetTagCloudManager()
    {
        $oView = new Tags();
        $this->assertTrue( $oView->getTagCloudManager() instanceof oxTagCloud );
    }

    /**
     * Testing Tags::isMoreTagsVisible()
     *
     * @return null
     */
    public function testIsMoreTagsVisible()
    {
        $oView = new Tags();
        $this->assertFalse( $oView->isMoreTagsVisible() );
    }

    /**
     * Testing Tags::getTitleSuffix()
     *
     * @return null
     */
    public function testGetTitleSuffix()
    {
        $oView = new Tags();
        $this->assertNull( $oView->getTitleSuffix() );
    }

    /**
     * Testing Tags::getTitlePageSuffix()
     *
     * @return null
     */
    public function testGetTitlePageSuffix()
    {
        $oView = $this->getMock( "Tags", array( "getActPage" ) );
        $oView->expects( $this->once() )->method( 'getActPage')->will( $this->returnValue( 1 ) );
        $this->assertEquals( oxLang::getInstance()->translateString( 'INC_HEADER_TITLEPAGE' ). 2, $oView->getTitlePageSuffix() );
    }
}