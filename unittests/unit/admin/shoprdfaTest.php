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
 * @version   SVN: $Id: shopmainTest.php 38998 2011-10-03 14:55:28Z vilma $
 */

require_once realpath( "." ).'/unit/OxidTestCase.php';
require_once realpath( "." ).'/unit/test_config.inc.php';

/**
 * Tests for Shop_Main class
 */
class Unit_Admin_ShopRDFaTest extends OxidTestCase
{
    /**
     * Shop_RDFa::getContentList() test case
     *
     * @return null
     */
    public function testGetContentList()
    {
        modConfig::setParameter( "oxid", oxConfig::getInstance()->getShopId() );

        $oView = oxNew("Shop_RDFA");
        $this->assertEquals( 4, $oView->getContentList()->count() );
    }

    /**
     * Shop_RDFa::getCustomers() test case
     *
     * @return null
     */
    public function testGetCustomers()
    {
        $aCustomers = array( "Enduser" => 1,
                             "Reseller" => 1,
                             "Business" => 0,
                             "PublicInstitution" => 1);

        $oConf = modConfig::getInstance();
        $oConf->setConfigParam('aRDFaCustomers', array('Enduser', 'Reseller', 'PublicInstitution'));

        $oView = $this->getProxyClass('Shop_RDFA');
        $oView->setConfig($oConf);
        $this->assertEquals( $aCustomers, $oView->getCustomers() );
    }

    /**
     * Shop_RDFa::getCustomers() no params test case
     *
     * @return null
     */
    public function testGetCustomers_noparams()
    {
        $oConf = modConfig::getInstance();
        $oConf->setConfigParam('aRDFaCustomers', null);

        $oView = $this->getProxyClass('Shop_RDFA');
        $oView->setConfig($oConf);
        $this->assertEquals( array(), $oView->getCustomers() );
    }
}