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
 * @version   SVN: $Id: oxactionsTest.php 26841 2010-03-25 13:58:15Z arvydas $
 */

require_once realpath( "." ).'/unit/OxidTestCase.php';
require_once realpath( "." ).'/unit/test_config.inc.php';

/**
 * Testing oxactions class.
 */
class Unit_Core_oxactionsTest extends OxidTestCase
{
    protected $_oAction = null;

    /**
     * Initialize the fixture.
     *
     * @return null
     */
    protected function setUp()
    {
        parent::setUp();
        $this->_oAction = new oxactions();
        $this->_oAction->oxactions__oxtitle = new oxField("test", oxField::T_RAW);
        $this->_oAction->save();
    }

    /**
     * Tear down the fixture.
     *
     * @return null
     */
    protected function tearDown()
    {
        $this->_oAction->delete();
        parent::tearDown();
    }

    /**
     * Testing action article adding.
     *
     * @return null
     */
    public function testAddArticle()
    {
        $sArtOxid = 'xxx';
        $this->_oAction->addArticle( $sArtOxid );

        $sCheckOxid = oxDb::getDb(true)->getOne( "select oxid from oxactions2article where oxactionid = '".$this->_oAction->getId()."' and oxartid = '$sArtOxid' ");
        if ( !$sCheckOxid ) {
            $this->fail( "fail adding article" );
        }
    }

    /**
     * Testing action article removal.
     *
     * @return null
     */
    public function testRemoveArticle()
    {
        $sArtOxid = 'xxx';
        $this->_oAction->addArticle( $sArtOxid );
        $this->assertTrue( $this->_oAction->removeArticle( $sArtOxid ) );

        $sCheckOxid = oxDb::getDb(true)->getOne( "select oxid from oxactions2article where oxactionid = '".$this->_oAction->getId()."' and oxartid = '$sArtOxid' ");
        if ( $sCheckOxid ) {
            $this->fail("fail removing article");
        }
    }

    /**
     * Testing non existing action article removal.
     *
     * @return null
     */
    public function testRemoveArticleNotExisting()
    {
        $sArtOxid = 'xxx';
        $this->assertFalse( $this->_oAction->removeArticle( $sArtOxid ) );
    }

    /**
     * Testing action deletion
     *
     * Trying to delete not existing action, deletion must return false
     *
     * @return null
     */
    public function testDeleteNotExistingAction()
    {
        $sArtOxid = 'xxx';
        $oAction = new oxactions();
        $this->assertFalse( $oAction->delete() );
    }

    /**
     * Testing action deletion
     *
     * Deleting existing action, everything must go fine
     *
     * @return null
     */
    public function testDelete()
    {
        $sArtOxid = 'xxx';
        $this->_oAction->addArticle( $sArtOxid );
        $this->_oAction->delete();

        $sCheckOxid = oxDb::getDb(true)->GetOne( "select oxid from oxactions2article where oxactionid = '".$this->_oAction->getId()."'" );
        $oAction = oxNew("oxactions");
        if ( $sCheckOxid || $oAction->Load( $this->sOxId ) ) {
            $this->fail("fail deleting");
        }
    }

}
