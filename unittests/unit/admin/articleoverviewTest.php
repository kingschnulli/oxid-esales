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
 * @version   SVN: $Id: articleoverviewTest.php 32003 2010-12-17 15:10:01Z sarunas $
 */

require_once realpath( "." ).'/unit/OxidTestCase.php';
require_once realpath( "." ).'/unit/test_config.inc.php';

/**
 * Tests for Article_Overview class
 */
class Unit_Admin_ArticleOverviewTest extends OxidTestCase
{
    /**
     * Tear down
     *
     * @return null
     */
    protected function tearDown()
    {
        //
        $this->cleanUpTable( "oxorderarticles" );

        parent::tearDown();
    }

    /**
     * Article_Overview::Render() test case
     *
     * @return null
     */
    public function testRender()
    {
        oxTestModules::addFunction('oxarticle', 'isDerived', '{ return true; }');
        modConfig::setParameter( "oxid", "1126" );

        $oBase = new oxbase();
        $oBase->init( "oxorderarticles" );
        $oBase->setId( "_testOrderArticleId");
        $oBase->oxorderarticles__oxorderid = new oxField( "testOrderId" );
        $oBase->oxorderarticles__oxamount  = new oxField( 1 );
        $oBase->oxorderarticles__oxartid   = new oxField( "1126" );
        $oBase->oxorderarticles__oxordershopid = new oxField( oxConfig::getInstance()->getShopId() );
        $oBase->save();

        // testing..
        $oView = new Article_Overview();
        $sTplName = $oView->render();

        // testing view data
        $aViewData = $oView->getViewData();
        $this->assertTrue( $aViewData["edit"] instanceof oxArticle );
        $this->assertNull( $aViewData["afolder"] );
        $this->assertNull( $aViewData["aSubclass"] );

        $this->assertEquals( 'article_overview.tpl', $sTplName );
    }

    /**
     * Article_Overview::Render() test case
     *
     * @return null
     */
    public function testRenderPArentBuyable()
    {
        oxTestModules::addFunction('oxarticle', 'isDerived', '{ return true; }');
        modConfig::setParameter( "oxid", "1126" );
        modConfig::getInstance()->setConfigParam( "blVariantParentBuyable", true );

        // testing..
        $oView = new Article_Overview();
        $sTplName = $oView->render();

        // testing view data
        $aViewData = $oView->getViewData();
        $this->assertTrue( $aViewData["edit"] instanceof oxArticle );
        $this->assertNull( $aViewData["afolder"] );
        $this->assertNull( $aViewData["aSubclass"] );

        $this->assertEquals( 'article_overview.tpl', $sTplName );
    }

}
