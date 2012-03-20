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
 * @version   SVN: $Id: infoTest.php 43015 2012-03-19 13:30:33Z mindaugas.rimgaila $
 */

require_once realpath( "." ).'/unit/OxidTestCase.php';
require_once realpath( "." ).'/unit/test_config.inc.php';

/**
 * Testing info class
 */
class Unit_Views_infoTest extends OxidTestCase
{
    /**
     * Test get template name.
     *
     * @return null
     */
    public function testGetTemplateName()
    {
        $oInfo = $this->getProxyClass( 'info' );
        $oInfo->info();
        $this->assertNull( $oInfo->getTemplateName() );
    }

    /**
     * Test get custom template name.
     *
     * @return null
     */
    public function testGetTemplateNameIfSet()
    {
        modConfig::setParameter( 'tpl', "test.tpl");
        $oInfo = $this->getProxyClass( 'info' );
        $oInfo->info();
        $this->assertSame( 'custom/test.tpl', $oInfo->getTemplateName() );
    }

    /**
     * Test get delivery list.
     *
     * @return null
     */
    public function testGetDeliveryList()
    {
        $oInfo = $this->getProxyClass( 'info' );

        $this->assertEquals( 5, $oInfo->getDeliveryList()->count() );
    }

    /**
     * Test get deliveryset list.
     *
     * @return null
     */
    public function testGetDeliverySetList()
    {
        $oInfo = $this->getProxyClass( 'info' );

        $this->assertEquals( 3, $oInfo->getDeliverySetList()->count() );
    }

    /**
     * Test if render returns custom tempalate name.
     *
     * @return null
     */
    public function testRenderIfTemplateNameIsSet()
    {
        modConfig::setParameter( 'tpl', "test.tpl");
        $oInfo = $this->getProxyClass( 'info' );
        $oInfo->info();
        $this->assertEquals( 'custom/test.tpl', $oInfo->render() );
    }

    /**
     * Test render content.tpl if custom template name is not set.
     *
     * @return null
     */
    public function testRenderIfTemplateNameIsNotSet()
    {
        $oInfo = $this->getProxyClass( 'info' );
        $oInfo->info();
        $this->assertEquals( 'page/info/content.tpl', $oInfo->render() );
    }

    /**
     * Test render load default 'impressum' content if custom template name is not set.
     *
     * @return null
     */
    public function testGetContentIfTemplateNameIsNotSetLoadsCorrectContent()
    {
        $oInfo = $this->getProxyClass( 'info' );
        $oInfo->info();
        $oContent = $oInfo->getContent();

        $sContentId = oxDb::getDb( oxDB::FETCH_MODE_ASSOC )->getOne( "SELECT oxid FROM oxcontents WHERE oxloadid = 'oximpressum' " );
        $oContent = oxNew( 'oxcontent' );
        $oContent->load( $sContentId );

        $this->assertEquals( 'oximpressum', $oContent->oxcontents__oxloadid->value );
    }
}
