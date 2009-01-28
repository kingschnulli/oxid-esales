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
 * @link http://www.oxid-esales.com
 * @package core
 * @copyright © OXID eSales AG 2003-2009
 * $Id: oxutilsstring.php 15904 2009-01-27 07:08:10Z arvydas $
 */

/**
 * String manipulation class
 */
class oxUtilsString
{
    /**
     * oxUtils class instance.
     *
     * @var oxutils instance
     */
    private static $_instance = null;

    /**
     * Language specific characters (currently german; storen in octal form)
     *
     * @var array
     */
    protected $_aUmls = array( "\344", "\366", "\374", "\304", "\326", "\334", "\337" );

    /**
     * oxUtilsString::$_aUmls equivalent in entities form
     * @var array
     */
    protected $_aUmlEntities = array('&auml;', '&ouml;', '&uuml;', '&Auml;', '&Ouml;', '&Uuml;', '&szlig;' );

    /**
     * Returns string manipulation utility instance
     *
     * @return oxUtilsString
     */
    public static function getInstance()
    {
        // disable caching for test modules
        if ( defined( 'OXID_PHP_UNIT' ) ) {
            static $inst = array();
            self::$_instance = $inst[oxClassCacheKey()];
        }

        if ( !self::$_instance instanceof oxUtilsString ) {


            self::$_instance = oxNew( 'oxUtilsString' );

            if ( defined( 'OXID_PHP_UNIT' ) ) {
                $inst[oxClassCacheKey()] = self::$_instance;
            }
        }
        return self::$_instance;
    }


    /**
     * Prepares passed string for CSV format
     *
     * @param string $sInField String to prepare
     *
     * @return string
     */
    public function prepareCSVField($sInField)
    {
        if (strstr($sInField, '"')) {
            return '"'.str_replace('"', '""', $sInField).'"';
        } elseif (strstr($sInField, ';')) {
            return '"'.$sInField.'"';
        }
        return $sInField;
    }

     /**
     * shortens a string to a size $iLenght, whereby "," and multiple spaces are removed
     * "," is rerplaced with " " and leading and ending whitespaces are removed
     *
     * @param string $sString input string
     * @param int    $iLength maximum length of result string , -1 -> no truncation
     *
     * @return string a string of maximum length $iLength without multiple spaces and commas
     */
    public function minimizeTruncateString( $sString, $iLength )
    {
        $sString = str_replace( ",", " ", $sString );
        //leading and ending whitesapces
        $sString = ereg_replace( "^[ \t\n\r\v]+|[ \t\n\r\v]+$", "", $sString );
        //multiple whitespaces
        $sString = ereg_replace( "[ \t\n\r\v]+", " ", $sString );
        if ( strlen( $sString ) > $iLength && $iLength != -1 ) {
            $sString = substr( $sString, 0, $iLength );
        }
        return $sString;
    }

    /**
     * Prepares and returns string for search engines.
     *
     * @param string $sSearchStr String to prepare for search engines
     *
     * @return string
     */
    public function prepareStrForSearch($sSearchStr)
    {
        if ( preg_match( "/(".implode( "|", $this->_aUmls  )."|(&amp;))/", $sSearchStr ) ) {
            return $this->recodeEntities( $sSearchStr, true,
                                          $this->_aUmls + array( count( $this->_aUmls ) => '&amp;' ),
                                          $this->_aUmlEntities + array( count( $this->_aUmlEntities ) => '&' ) );
        }

        return '';
    }

    /**
     * Recodes and returns passed input:
     *     if $blToHtmlEntities == true  ä -> &auml;
     *     if $blToHtmlEntities == false &auml; -> ä
     *
     * @param string $sInput           text to recode
     * @param bool   $blToHtmlEntities recode direction
     * @param array  $aUmls            language specific characters
     * @param array  $aUmlEntities     language specific characters equivalents in entities form
     *
     * @return string
     */
    public function recodeEntities( $sInput, $blToHtmlEntities = false, $aUmls = array(), $aUmlEntities = array() )
    {
        $aUmls = $aUmls ? $aUmls : $this->_aUmls;
        $aUmlEntities = $aUmlEntities ? $aUmlEntities : $this->_aUmlEntities;
        return $blToHtmlEntities ? str_replace( $aUmls, $aUmlEntities, $sInput ) : str_replace( $aUmlEntities, $aUmls, $sInput );
    }
}