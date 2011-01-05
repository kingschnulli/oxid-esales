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
 * @version   SVN: $Id: oxopeniddbTest.php 26841 2010-03-25 13:58:15Z arvydas $
 */

require_once realpath( "." ).'/unit/OxidTestCase.php';
require_once realpath( "." ).'/unit/test_config.inc.php';
require_once realpath( "." ).'/unit/OxidTestCase.php';
$iOldErrorReproting = error_reporting();
error_reporting($iOldErrorReproting & ~E_STRICT);
$sPathExtra = getShopBasePath()."core/openid";
$sPath = ini_get('include_path');
$sPath = $sPathExtra . ':' . $sPath;
ini_set('include_path', $sPath);

require_once "Auth/OpenID/Consumer.php";
require_once "Auth/OpenID/FileStore.php";
require_once "Auth/OpenID/SReg.php";

error_reporting($iOldErrorReproting);

/**
 * Testing oxsession class
 */
class Unit_Core_oxopeniddbTest extends OxidTestCase
{
    protected $_sServerUrl = null;
    protected $_sAssociationsTable = null;

    /**
     * Initialize the fixture.
     *
     * @return null
     */
    protected function setUp()
    {
        $this->iOldErrorReproting = error_reporting();
        error_reporting($this->iOldErrorReproting & ~E_STRICT);
        parent::setUp();
        $oDb = new oxOpenIdDb();
        $oDb->createTables();
        $this->_sAssociationsTable = "oxoidassociations";
        $this->_sNoncesTable       = "oxoidnonces";
        $this->_sServerUrl = 'http://www.myopenid.com/openid';
        $this->_sHandle = '{HMAC-SHA1}{498183e7}{iECRPQ==}';
        oxDb::getDb()->execute("DELETE FROM " . $this->_sAssociationsTable);
        $sSql = "INSERT INTO ".$this->_sAssociationsTable." (server_url, handle, secret, issued, lifetime, assoc_type) VALUES
        ('{$this->_sServerUrl}', '{$this->_sHandle}', 'QvKrWZUQqRGvkfWI0igmWVBkfFA=', ".strtotime("10 September 2000").", 1209600, 'HMAC-SHA1')";
        oxDb::getDb()->execute($sSql);
        $sSql = "INSERT INTO ".$this->_sNoncesTable." (server_url, timestamp, salt) VALUES
        ('{$this->_sServerUrl}', '".strtotime("10 September 2000")."', 'oxsalt')";
        oxDb::getDb()->execute($sSql);
    }

    /**
     * Tear down the fixture.
     *
     * @return null
     */
    protected function tearDown()
    {
        oxDb::getDb()->execute("DROP TABLE " . $this->_sAssociationsTable);
        oxDb::getDb()->execute("DROP TABLE " . $this->_sNoncesTable);
        error_reporting($this->iOldErrorReproting);
        parent::tearDown();
    }

    function testBlobDecode()
    {
        $oDb = new oxOpenIdDb();
        $this->assertEquals( 'xxx', $oDb->blobDecode(base64_encode('xxx')));
    }

    function testBlobEncode()
    {
        $oDb = new oxOpenIdDb();
        $this->assertEquals( base64_encode('xxx'), $oDb->blobEncode('xxx'));
    }

    function testStoreAssociation()
    {
        $oDb = new oxOpenIdDb();
        $oAssociation = new oxStdClass();
        $oAssociation->handle = $this->_sHandle;
        $oAssociation->secret = 'secrettest';
        $oAssociation->issued = 1233224679;
        $oAssociation->lifetime = 1209600;
        $oAssociation->assoc_type = 'HMAC-SHA1';
        $oDb->storeAssociation( $this->_sServerUrl, $oAssociation );
        $sSql  = "SELECT secret FROM ".$this->_sAssociationsTable;
        $sSql .= " WHERE server_url = '".$this->_sServerUrl."'";
        $sSecret = oxDb::getDb()->getOne($sSql);
        $this->assertEquals( base64_encode('secrettest'), $sSecret);
    }

    function testRemoveAssociation()
    {
        $oDb = new oxOpenIdDb();
        $oDb->removeAssociation( $this->_sServerUrl, $this->_sHandle );
        $sSql  = "SELECT secret FROM ".$this->_sAssociationsTable;
        $sSql .= " WHERE server_url = '".$this->_sServerUrl."'";
        $sSecret = oxDb::getDb()->getOne($sSql);
        $this->assertFalse($sSecret);
    }

    function testUseNonce()
    {
        $oDb = new oxOpenIdDb();
        $oDb->useNonce( $this->_sServerUrl, time(), 'test' );
        $sSql  = "SELECT salt FROM ".$this->_sNoncesTable;
        $sSql .= " WHERE server_url = '".$this->_sServerUrl."' and salt = 'test'";
        $sSalt = oxDb::getDb()->getOne($sSql);
        $this->assertEquals( 'test', $sSalt);
    }

    function testCleanupNonces()
    {
        $oDb = new oxOpenIdDb();
        $oDb->cleanupNonces();
        $sSql  = "SELECT salt FROM ".$this->_sNoncesTable;
        $sSql .= " WHERE server_url = '".$this->_sServerUrl."' and salt = 'oxsalt'";
        $this->assertFalse( oxDb::getDb()->getOne($sSql));
    }

    function testCleanupAssociations()
    {
        $oDb = new oxOpenIdDb();
        $oDb->cleanupAssociations();
        $sSql  = "SELECT secret FROM ".$this->_sAssociationsTable;
        $sSql .= " WHERE server_url = '".$this->_sServerUrl."'";
        $sSecret = oxDb::getDb()->getOne($sSql);
        $this->assertFalse($sSecret);
    }

    function testReset()
    {
        $oDb = new oxOpenIdDb();
        $oDb->reset();
        $sSql  = "SELECT salt FROM ".$this->_sNoncesTable;
        $sSql .= " WHERE server_url = '".$this->_sServerUrl."' and salt = 'oxsalt'";
        $this->assertFalse( oxDb::getDb()->getOne($sSql));
        $sSql  = "SELECT secret FROM ".$this->_sAssociationsTable;
        $sSql .= " WHERE server_url = '".$this->_sServerUrl."'";
        $sSecret = oxDb::getDb()->getOne($sSql);
        $this->assertFalse($sSecret);
    }

    function testGetAssocs()
    {
        $oDb = $this->getProxyClass( 'oxOpenIdDb' );
        $aRet = $oDb->UNITgetAssocs( $this->_sServerUrl );
        $this->assertEquals(1, count($aRet));
    }

    function testGetAssoc()
    {
        $oDb = $this->getProxyClass( 'oxOpenIdDb' );
        $aRet = $oDb->UNITgetAssoc( $this->_sServerUrl, $this->_sHandle );
        $this->assertEquals(1, count($aRet));
    }

    function testGetAssociationIfExpired()
    {
        $oDb = $this->getProxyClass( 'oxOpenIdDb' );
        $aRet = $oDb->getAssociation( $this->_sServerUrl, $this->_sHandle );
        $this->assertNull($aRet);
    }

    function testGetAssociation()
    {
        $sSql = "UPDATE ".$this->_sAssociationsTable." SET issued = ".time()."  WHERE server_url = '{$this->_sServerUrl}'";
        oxDb::getDb()->execute($sSql);
        $oDb = $this->getProxyClass( 'oxOpenIdDb' );
        $aRet = $oDb->getAssociation( $this->_sServerUrl, $this->_sHandle );
        $this->assertEquals(1, count($aRet));
    }

    function testGetAssociationNoAssocFound()
    {
        $oDb = $this->getProxyClass( 'oxOpenIdDb' );
        $aRet = $oDb->getAssociation( "aaaa", $this->_sHandle );
        $this->assertNull($aRet);
    }

    function testGetAssociationWithoutHandle()
    {
        $sSql = "UPDATE ".$this->_sAssociationsTable." SET issued = ".time()."  WHERE server_url = '{$this->_sServerUrl}'";
        oxDb::getDb()->execute($sSql);
        $oDb = $this->getProxyClass( 'oxOpenIdDb' );
        $aRet = $oDb->getAssociation( $this->_sServerUrl );
        $this->assertEquals(1, count($aRet));
    }

    function testGetAssociationWithoutHandleNoAssocFound()
    {
        $oDb = $this->getProxyClass( 'oxOpenIdDb' );
        $aRet = $oDb->getAssociation( "aaaa" );
        $this->assertNull($aRet);
    }

}
