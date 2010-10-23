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
 * @version   SVN: $Id: articlestockTest.php 30487 2010-10-22 12:17:49Z rimvydas.paskevicius $
 */

require_once realpath( "." ).'/unit/OxidTestCase.php';
require_once realpath( "." ).'/unit/test_config.inc.php';

/**
 * Tests for Article_Stock class
 */
class Unit_Admin_ArticleStockTest extends OxidTestCase
{
    /**
     * Tear down the fixture.
     *
     * @return null
     */
    protected function tearDown()
    {
        $this->cleanUpTable( 'oxprice2article' );
        parent::tearDown();
    }

    /**
     * Article_Stock::Render() test case
     *
     * @return null
     */
    public function testRender()
    {
        modConfig::setParameter( "oxid", oxDb::getDb()->getOne( 'select oxid from oxarticles where oxparentid != "" ' ) );

        // testing..
        $oView = new Article_Stock();
        $sTplName = $oView->render();

        // testing view data
        $aViewData = $oView->getViewData();
        $this->assertTrue( $aViewData["edit"] instanceof oxArticle );
        $this->assertEquals( 'article_stock.tpl', $sTplName );
    }

    /**
     * Article_Stock::Save() test case
     *
     * @return null
     */
    public function testSave()
    {
        oxTestModules::addFunction( 'oxarticle', 'save', '{ throw new Exception( "save" ); }');
        oxTestModules::addFunction( 'oxarticle', 'loadInLang', '{ return true; }');
        oxTestModules::addFunction( 'oxarticle', 'setLanguage', '{ return true; }');
        oxTestModules::addFunction( 'oxarticle', 'assign', '{ return true; }');

        modConfig::setParameter( "editval", array( "oxarticles__oxremindactive" => 1, "oxarticles__oxremindamount" => 1, "oxarticles__oxstock" => 2 ) );

        // testing..
        try {
            $oView = new Article_Stock();
            $oView->save();
        } catch ( Exception $oExcp ) {
            $this->assertEquals( "save", $oExcp->getMessage(), "error in Article_Stock::save()" );
            return;
        }
        $this->fail( "error in Article_Stock::save()" );
    }

    /**
     * Article_Stock::Addprice() test case
     *
     * @return null
     */
    public function testAddprice()
    {
        oxTestModules::addFunction( 'oxbase', 'save', '{ throw new Exception( "save" ); }');
        modConfig::setParameter( "editval", array( "oxprice2article__oxamountto" => 9,
                                                   "pricetype" => "oxaddabs",
                                                   "price" => 9 ) );

        // testing..
        try {
            $oView = new Article_Stock();
            $oView->addprice();
        } catch ( Exception $oExcp ) {
            $this->assertEquals( "save", $oExcp->getMessage(), "error in Article_Stock::addprice()" );
            return;
        }
        $this->fail( "error in Article_Stock::save()" );
    }

    /**
     * Article_Stock::Deleteprice() test case
     *
     * @return null
     */
    public function testDeleteprice()
    {
        $oDb = oxDb::getDb(); 
        $oDb->execute("insert into oxprice2article set oxid='_testId', oxartid='_testArtId' ");
        
            $oView = new Article_Stock();


        modConfig::setParameter('oxid', '_testArtId');
        $oView->deleteprice();
        $this->assertEquals( "1", $oDb->getOne("select 1 from oxprice2article where oxid='_testId'" ) );
        
        modConfig::setParameter('oxid', '');
        modConfig::setParameter('priceid', '_testId');
        $oView->deleteprice();
        $this->assertEquals( "1", $oDb->getOne("select 1 from oxprice2article where oxid='_testId'" ) );
        
        modConfig::setParameter('oxid', '_testArtId');
        modConfig::setParameter('priceid', '_testId');
        $oView->deleteprice();
        $this->assertFalse( $oDb->getOne("select 1 from oxprice2article where oxid='_testId'" ) );
    }

}
