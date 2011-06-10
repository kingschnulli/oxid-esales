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
 * @package   core
 * @copyright (C) OXID eSales AG 2003-2011
 * @version OXID eShop CE
 * @version   SVN: $Id: oxcaptcha.php 36100 2011-06-09 07:03:18Z arvydas.vapsva $
 */

/**
 * Class handling CAPTCHA image
 * This class requires utility file utils/verificationimg.php as image generator
 *
 */
class oxCaptcha extends oxSuperCfg
{
    /**
     * CAPTCHA length
     *
     * @var int
     */
    protected $_iMacLength = 5;

    /**
     * Captcha text
     *
     * @var string
     */
    protected $_sText = null;

    /**
     * Possible CAPTCHA chars, no ambiguities
     *
     * @var string
     */
    private $_sMacChars  = 'abcdefghijkmnpqrstuvwxyz23456789';

    /**
     * Captcha timeout 60 * 5 = 5 minutes
     *
     * @var int
     */
    protected $_iTimeout = 300;

    /**
     * Returns text
     *
     * @return string
     */
    public function getText()
    {
        if ( !$this->_sText ) {
            $this->_sText = '';
            for ( $i=0; $i < $this->_iMacLength; $i++ ) {
                $this->_sText .= strtolower( $this->_sMacChars{ rand( 0, strlen( $this->_sMacChars ) - 1 ) } );
            }
        }

        return $this->_sText;
    }

    /**
     * Returns text hash
     *
     * @param string $sText User supplie text
     *
     * @return string
     */
    public function getHash($sText = null)
    {
        // inserting captcha record
        $iTime = time() + $this->_iTimeout;
        $sHash = $this->getTextHash( $sText );
        $sQ = "insert into oxcaptcha ( oxhash, oxtime ) values ( '{$sHash}', '{$iTime}' )";
        oxDb::getDb()->execute( $sQ );

        return oxDb::getDb()->getOne( "select LAST_INSERT_ID()" );
    }

    /**
     * Returns given string captcha hash
     *
     * @param string $sText string to hash
     *
     * @return string
     */
    public function getTextHash( $sText )
    {
        if (!$sText) {
            $sText = $this->getText();
        }

        $sText = strtolower($sText);
        return md5( "ox{$sText}" );
    }

    /**
     * Returns url to CAPTCHA image generator.
     *
     * @return string
     */
    public function getImageUrl()
    {
        $sUrl = $this->getConfig()->getCoreUtilsURL() . "verificationimg.php?e_mac=";
        $sUrl .= oxUtils::getInstance()->strMan( $this->getText() );

        return $sUrl;
    }

    /**
     * Checks if image could be generated
     *
     * @return bool
     */
    public function isImageVisible()
    {
        return ( ( function_exists( 'imagecreatetruecolor' ) || function_exists( 'imagecreate' ) ) && $this->getConfig()->getConfigParam( 'iUseGDVersion' ) > 1 );
    }

    /**
     * Verifies captcha input vs supplied hash. Returns true on success.
     *
     * @param string $sMac     User supplied text
     * @param string $sMacHash Generated hash
     *
     * @return bool
     */
    public function pass( $sMac, $sMacHash )
    {
        $oDb = oxDb::getDb();
        $iMacHash = (int) $sMacHash;
        $sHash = $this->getTextHash( $sMac );

        $sQ  = "select 1 from oxcaptcha where oxid = {$iMacHash} and oxhash = '{$sHash}'";
        if ( ( $blPass = $oDb->getOne( $sQ ) ) ) {
            // cleanup
            $sQ = "delete from oxcaptcha where oxid = {$iMacHash} and oxhash = '{$sHash}'";
            $oDb->execute( $sQ );
        }

        // garbage cleanup
        $sQ = "delete from oxcaptcha where oxtime < ". time();
        $oDb->execute( $sQ );

        return (bool) $blPass;
    }
}