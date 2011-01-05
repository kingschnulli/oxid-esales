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
 * @version   SVN: $Id: oxopenidTest.php 26841 2010-03-25 13:58:15Z arvydas $
 */

require_once realpath( "." ).'/unit/OxidTestCase.php';
require_once realpath( "." ).'/unit/test_config.inc.php';
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
class Response
{
    public $status = null;
    public function setStatus( $status )
    {
        $this->status = $status;
    }
}
/**
 * Testing oxopenid class
 */
class Unit_Core_oxopenidTest extends OxidTestCase
{
    public function testAuthenticateOid()
    {
         $iOldErrorReproting = error_reporting();
         error_reporting($iOldErrorReproting & ~E_STRICT);
         oxTestModules::addFunction( "oxUtils", "redirect", "{ return 'xxxx'; }");
         $oAuth = $this->getMock( 'Auth', array( 'addExtension', 'redirectURL' ) );
         $oAuth->expects( $this->any() )->method( 'addExtension')->will( $this->returnValue( true ) );
         $oAuth->expects( $this->any() )->method( 'redirectURL')->will( $this->returnValue( 'redirectUrl' ) );
         $oConsumer = $this->getMock( 'Consumer', array( 'begin' ) );
         $oConsumer->expects( $this->any() )->method( 'begin')->will( $this->returnValue( $oAuth ) );
         $oOpenId = $this->getMock( 'oxopenid', array( '_getConsumer' ) );
         $oOpenId->expects( $this->any() )->method( '_getConsumer')->will( $this->returnValue( $oConsumer ) );
         $oOpenId->authenticateOid( 'openid.myopenid.com', 'url' );
         error_reporting($iOldErrorReproting);

    }

    public function testAuthenticateOidNotValidId()
    {
         $iOldErrorReproting = error_reporting();
         error_reporting($iOldErrorReproting & ~E_STRICT);
         $oConsumer = $this->getMock( 'Consumer', array( 'begin' ) );
         $oConsumer->expects( $this->any() )->method( 'begin')->will( $this->returnValue( false ) );
         $oOpenId = $this->getMock( 'oxopenid', array( '_getConsumer' ) );
         $oOpenId->expects( $this->any() )->method( '_getConsumer')->will( $this->returnValue( $oConsumer ) );
         try {
            $oOpenId->authenticateOid( 'openid.myopenid.com', 'url' );
         } catch ( oxUserException $oEx ) {
            error_reporting($iOldErrorReproting);
            return;
         }
         error_reporting($iOldErrorReproting);
         $this->fail();
    }

    public function testGetOidResponse()
    {
         $iOldErrorReproting = error_reporting();
         error_reporting($iOldErrorReproting & ~E_STRICT);
         $oRet = $this->getMock( 'Ret', array( 'contents' ) );
         $oRet->expects( $this->any() )->method( 'contents')->will( $this->returnValue( array('email'=>'test') ) );
         $oSReg = $this->getMock( 'SReg', array( 'fromSuccessResponse' ) );
         $oSReg->expects( $this->any() )->method( 'fromSuccessResponse')->will( $this->returnValue( $oRet ) );
         $oResponse = new Response();
         $oResponse->setStatus(Auth_OpenID_SUCCESS);
         $oConsumer = $this->getMock( 'Consumer', array( 'complete' ) );
         $oConsumer->expects( $this->any() )->method( 'complete')->will( $this->returnValue( $oResponse ) );
         $oOpenId = $this->getMock( 'oxopenid', array( '_getConsumer', '_getResponse' ) );
         $oOpenId->expects( $this->any() )->method( '_getConsumer')->will( $this->returnValue( $oConsumer ) );
         $oOpenId->expects( $this->any() )->method( '_getResponse')->will( $this->returnValue( $oSReg ) );
         $aData = $oOpenId->getOidResponse( 'url' );
         $this->assertEquals( array('email'=>'test'), $aData);
         error_reporting($iOldErrorReproting);
    }

    public function testGetOidResponseIfFailed()
    {
         $iOldErrorReproting = error_reporting();
         error_reporting($iOldErrorReproting & ~E_STRICT);
         $oRet = $this->getMock( 'Ret', array( 'contents' ) );
         $oRet->expects( $this->any() )->method( 'contents')->will( $this->returnValue( array('email'=>'test') ) );
         $oSReg = $this->getMock( 'SReg', array( 'fromSuccessResponse' ) );
         $oSReg->expects( $this->any() )->method( 'fromSuccessResponse')->will( $this->returnValue( $oRet ) );
         $oResponse = new Response();
         $oResponse->setStatus(Auth_OpenID_FAIL);
         $oConsumer = $this->getMock( 'Consumer', array( 'complete' ) );
         $oConsumer->expects( $this->any() )->method( 'complete')->will( $this->returnValue( $oResponse ) );
         $oOpenId = $this->getMock( 'oxopenid', array( '_getConsumer', '_getResponse' ) );
         $oOpenId->expects( $this->any() )->method( '_getConsumer')->will( $this->returnValue( $oConsumer ) );
         $oOpenId->expects( $this->any() )->method( '_getResponse')->will( $this->returnValue( $oSReg ) );
         try {
            $aData = $oOpenId->getOidResponse( 'url' );
         } catch ( oxUserException $oEx ) {
            error_reporting($iOldErrorReproting);
            return;
         }
         error_reporting($iOldErrorReproting);
         $this->fail();
    }

    public function testGetOidResponseIfCanceled()
    {
         $iOldErrorReproting = error_reporting();
         error_reporting($iOldErrorReproting & ~E_STRICT);
         $oRet = $this->getMock( 'Ret', array( 'contents' ) );
         $oRet->expects( $this->any() )->method( 'contents')->will( $this->returnValue( array('email'=>'test') ) );
         $oSReg = $this->getMock( 'SReg', array( 'fromSuccessResponse' ) );
         $oSReg->expects( $this->any() )->method( 'fromSuccessResponse')->will( $this->returnValue( $oRet ) );
         $oResponse = new Response();
         $oResponse->setStatus(Auth_OpenID_CANCEL);
         $oConsumer = $this->getMock( 'Consumer', array( 'complete' ) );
         $oConsumer->expects( $this->any() )->method( 'complete')->will( $this->returnValue( $oResponse ) );
         $oOpenId = $this->getMock( 'oxopenid', array( '_getConsumer', '_getResponse' ) );
         $oOpenId->expects( $this->any() )->method( '_getConsumer')->will( $this->returnValue( $oConsumer ) );
         $oOpenId->expects( $this->any() )->method( '_getResponse')->will( $this->returnValue( $oSReg ) );
         try {
            $aData = $oOpenId->getOidResponse( 'url' );
         } catch ( oxUserException $oEx ) {
            error_reporting($iOldErrorReproting);
            return;
         }
         error_reporting($iOldErrorReproting);
         $this->fail();
    }
}
