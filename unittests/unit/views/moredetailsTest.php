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
 * @version   SVN: $Id: moredetailsTest.php 26841 2010-03-25 13:58:15Z arvydas $
 */

require_once realpath( "." ).'/unit/OxidTestCase.php';
require_once realpath( "." ).'/unit/test_config.inc.php';

/**
 * Testing moredetails class
 */
class Unit_Views_moredetailsTest extends OxidTestCase
{
    /**
     * Initialize the fixture.
     *
     * @return null
     */
    protected function setUp()
    {
        parent::setUp();
        oxTestModules::addFunction('oxSeoEncoderManufacturer', '_saveToDb', '{return null;}');
    }

    /**
     * Test get product id's.
     *
     * @return null
     */
    public function testGetProductId()
    {
        $oMoreDetails = $this->getProxyClass( 'moredetails' );
        modConfig::setParameter( 'anid', '2000' );
        $oMoreDetails->init();

        $this->assertEquals( '2000', $oMoreDetails->getProductId() );
    }

    /**
     * Test get product.
     *
     * @return null
     */
    public function testGetProduct()
    {
        $oMoreDetails = $this->getProxyClass( 'moredetails' );
        modConfig::setParameter( 'anid', '2000' );
        $oMoreDetails->init();

        $this->assertEquals( '2000', $oMoreDetails->getProduct()->getId() );
    }

    /**
     * Test get active picture id.
     *
     * @return null
     */
    public function testGetActPictureId()
    {
        $oMoreDetails = $this->getProxyClass( 'moredetails' );
        modConfig::setParameter( 'anid', '1651' );
        $oMoreDetails->init();

        $this->assertEquals( '1', $oMoreDetails->getActPictureId() );
    }

    /**
     * Test get product zoom pictures.
     *
     * @return null
     */
    public function testGetArtZoomPics()
    {
        $oMoreDetails = $this->getProxyClass( 'moredetails' );
        modConfig::setParameter( 'anid', '1672' );
        $oMoreDetails->init();
        $aZoom = $oMoreDetails->getArtZoomPics();
        $this->assertEquals( '1672_z1.jpg', basename($aZoom[1]['file']) );
    }
}
