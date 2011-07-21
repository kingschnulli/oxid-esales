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
 * @version   SVN: $Id: langFileIntegrityTest.php 37179 2011-07-20 10:38:49Z vilma $
 */

require_once realpath( "." ).'/unit/OxidTestCase.php';
require_once realpath( "." ).'/unit/test_config.inc.php';

/**
 * Tests language files and templates for missing constants.
 */
class Unit_Maintenance_langFileIntegrityTest extends OxidTestCase
{
    /**
     * Test if current template set language idents are the same.
     *
     * @return null
     */
    public function testCurrentTemplateSetIdentMatch()
    {
        $aLangIdentsDE = array_keys( $this->_getLanguageArray(null, 1, 'de') );
        $aLangIdentsEN = array_keys( $this->_getLanguageArray(null, 1, 'en') );

        $this->assertEquals( count($aLangIdentsDE), count($aLangIdentsEN), 'ident count does not match');
        $this->assertEquals( array(), array_diff($aLangIdentsDE, $aLangIdentsEN), 'ident does not match');
        $this->assertEquals( array(), array_diff($aLangIdentsEN, $aLangIdentsDE), 'ident does not match');
        //$this->assertEquals( $aLangIdentsDE, $aLangIdentsEN,'ident order match');
    }

    /**
     * Test if basic template set language idents are the same.
     *
     * @return null
     */
    public function testBasicTemplateSetIdentMatch()
    {
        $aLangIdentsDE = array_keys( $this->_getLanguageArray('basic', 1, 'de') );
        $aLangIdentsEN = array_keys( $this->_getLanguageArray('basic', 1, 'en') );

        $this->assertEquals( count($aLangIdentsDE), count($aLangIdentsEN), 'ident count does not match');
        $this->assertEquals( array(), array_diff($aLangIdentsDE, $aLangIdentsEN), 'ident does not match');
        $this->assertEquals( array(), array_diff($aLangIdentsEN, $aLangIdentsDE), 'ident does not match');
        //$this->assertEquals( $aLangIdentsDE, $aLangIdentsEN,'ident order match');
    }

    /**
     * Test if basic template set language idents are the same.
     *
     * @return null
     */
    public function testAzureTemplateSetIdentMatch()
    {
        $aLangIdentsDE = array_keys( $this->_getLanguageArray('azure', 1, 'de') );
        $aLangIdentsEN = array_keys( $this->_getLanguageArray('azure', 1, 'en') );

        $this->assertEquals( count($aLangIdentsDE), count($aLangIdentsEN), 'ident count does not match');
        $this->assertEquals( array(), array_diff($aLangIdentsDE, $aLangIdentsEN), 'ident does not match');
        $this->assertEquals( array(), array_diff($aLangIdentsEN, $aLangIdentsDE), 'ident does not match');
        //$this->assertEquals( $aLangIdentsDE, $aLangIdentsEN,'ident order match');
    }

    /**
     * Test if admin template set language idents are the same.
     *
     * @return null
     */
    public function testAdminIdentMatch()
    {
        $aLangIdentsDE = array_keys( $this->_getLanguageArray( 'admin', 1, 'de') );
        $aLangIdentsEN = array_keys( $this->_getLanguageArray( 'admin', 1, 'en') );

        $this->assertEquals( count($aLangIdentsDE), count($aLangIdentsEN), 'ident count does not match');
        $this->assertEquals( array(), array_diff($aLangIdentsDE, $aLangIdentsEN), 'ident does not match');
        $this->assertEquals( array(), array_diff($aLangIdentsEN, $aLangIdentsDE), 'ident does not match');
        //$this->assertEquals( $aLangIdentsDE, $aLangIdentsEN,'ident order match');
    }

    /**
     * Test if there are no duplicated language idents.
     *
     * @return null
     */
    public function testDublicateConstats()
    {
        $aLangIdentsDE = $this->_getLanguageConst( 'admin', 'de');
        $aLangIdentsEN = $this->_getLanguageConst( 'admin', 'en');
        $aFillIdentsDE = array_unique($aLangIdentsDE);
        $aFillIdentsEN = array_unique($aLangIdentsEN);
        $this->assertEquals( array(), array_diff_key($aLangIdentsDE, $aFillIdentsDE), 'ident does not match');
        $this->assertEquals( array(), array_diff_key($aLangIdentsEN, $aFillIdentsEN), 'ident does not match');

        $aLangIdentsDE = $this->_getLanguageConst( 'basic', 'de');
        $aLangIdentsEN = $this->_getLanguageConst( 'basic', 'en');
        $aFillIdentsDE = array_unique($aLangIdentsDE);
        $aFillIdentsEN = array_unique($aLangIdentsEN);
        $this->assertEquals( array(), array_diff_key($aLangIdentsDE, $aFillIdentsDE), 'ident does not match');
        $this->assertEquals( array(), array_diff_key($aLangIdentsEN, $aFillIdentsEN), 'ident does not match');

        $aLangIdentsDE = $this->_getLanguageConst( 'azure', 'de');
        $aLangIdentsEN = $this->_getLanguageConst( 'azure', 'en');
        $aFillIdentsDE = array_unique($aLangIdentsDE);
        $aFillIdentsEN = array_unique($aLangIdentsEN);
        $this->assertEquals( array(), array_diff_key($aLangIdentsDE, $aFillIdentsDE), 'ident does not match');
        $this->assertEquals( array(), array_diff_key($aLangIdentsEN, $aFillIdentsEN), 'ident does not match');
    }

    /**
     * Test if there are no missing constant language idents used in current templates.
     *
     * @return null
     */
    public function testMissingCurrentTemplateConstants()
    {
        $aTemplateLangIdents = $this->_getTemplateConstants(null, 1, 'de');
        $aConstantLangIdents = array_merge( array_keys( $this->_getLanguageArray(null, 1, 'de') ), array_keys( $this->_getLanguageArray( 'admin', 1, 'de') ) );

        $this->assertEquals( array(), array_diff($aTemplateLangIdents, $aConstantLangIdents), 'missing constants in templates');
    }

    /**
     * Test if there are no missing constant language idents used in basic templates.
     *
     * @return null
     */
    public function testMissingBasicTemplateConstants()
    {
        $aTemplateLangIdents = $this->_getTemplateConstants('basic', 1, 'de');
        $aConstantLangIdents = array_merge( array_keys( $this->_getLanguageArray('basic', 1, 'de') ), array_keys( $this->_getLanguageArray( 'admin', 1, 'de') ) );

        $this->assertEquals( array(), array_diff($aTemplateLangIdents, $aConstantLangIdents), 'missing constants in templates');
    }

    /**
     * Test if there are no missing constant language idents used in azure templates.
     *
     * @return null
     */
    public function testMissingAzureTemplateConstants()
    {
        $aTemplateLangIdents = $this->_getTemplateConstants('azure', 1, 'de');
        $aConstantLangIdents = array_merge( array_keys( $this->_getLanguageArray('azure', 1, 'de') ), array_keys( $this->_getLanguageArray( 'admin', 1, 'de') ) );

        $this->assertEquals( array(), array_diff($aTemplateLangIdents, $aConstantLangIdents), 'missing constants in templates');
    }

    /**
     * Test if there html entities are not used in basic templates.
     *
     * @return null
     */
    public function testNoFrontendHtmlEntitiesAllowed()
    {
        // Basic
        $aLangIdentsDE = $this->_getLanguageArray('basic', 1, 'de', '*.php'); // changed pattern to checkt theme_options.php
        foreach ( $aLangIdentsDE as $sIdent => $sValue ) {
            $sValue = str_replace( '&amp;', '(amp)', $sValue );
            $sDecodedValue = html_entity_decode( $sValue, ENT_QUOTES, 'UTF-8' );
            $this->assertEquals( $sDecodedValue, $sValue, "html entities found for ident $sIdent" );
        }

        $aLangIdentsEN = $this->_getLanguageArray('basic', 1, 'en', '*.php');
        foreach ( $aLangIdentsEN as $sIdent => $sValue ) {
            $sValue = str_replace( '&amp;', '(amp)', $sValue );
            $sDecodedValue = html_entity_decode( $sValue, ENT_QUOTES, 'UTF-8' );
            $this->assertEquals( $sDecodedValue, $sValue, "html entities found for ident $sIdent" );
        }

        // Azure
        $aLangIdentsDE = $this->_getLanguageArray('azure', 1, 'de', '*.php');
        foreach ( $aLangIdentsDE as $sIdent => $sValue ) {
            $sValue = str_replace( '&amp;', '(amp)', $sValue );
            $sDecodedValue = html_entity_decode( $sValue, ENT_QUOTES, 'UTF-8' );
            $this->assertEquals( $sDecodedValue, $sValue, "html entities found for ident $sIdent" );
        }

        $aLangIdentsEN = $this->_getLanguageArray('azure', 1, 'en', '*.php');
        foreach ( $aLangIdentsEN as $sIdent => $sValue ) {
            $sValue = str_replace( '&amp;', '(amp)', $sValue );
            $sDecodedValue = html_entity_decode( $sValue, ENT_QUOTES, 'UTF-8' );
            $this->assertEquals( $sDecodedValue, $sValue, "html entities found for ident $sIdent" );
        }
    }

    /**
     * Test if there html entities are not used in admin templates.
     *
     * @return null
     */
    public function testNoAdminHtmlEntitiesAllowed()
    {
        $aLangIdentsDE = $this->_getLanguageArray('admin', 1, 'de');

        foreach ( $aLangIdentsDE as $sIdent => $sValue ) {
            $sValue = str_replace( '&amp;', '(amp)', $sValue );
            $sDecodedValue = html_entity_decode( $sValue, ENT_QUOTES, 'UTF-8' );
            $this->assertEquals( $sDecodedValue, $sValue, "html entities found for ident $sIdent" );
        }


        $aLangIdentsEN = $this->_getLanguageArray('admin', 1, 'en');
        foreach ( $aLangIdentsEN as $sIdent => $sValue ) {
            $sValue = str_replace( '&amp;', '(amp)', $sValue );
            $sDecodedValue = html_entity_decode( $sValue, ENT_QUOTES, 'UTF-8' );
            $this->assertEquals( $sDecodedValue, $sValue, "html entities found for ident $sIdent" );
        }
    }

    /**
     * Get language array by given theme, shop and language.
     *
     * @param string $sTheme theme name
     * @param string $sShop  shom id
     * @param string $sLang  languge abbr
     *
     * @return array
     */
    private function _getLanguageArray( $sTheme, $sShop, $sLang, $sFilePattern = '*lang.php' )
    {
        if ( !$sTheme ) {
                $sTheme = 'pe_former';
        }

        $aLang    = array();
        $aAllLang = array();

        $aFile = array( 'out', $sTheme, $sLang, $sFilePattern );
        $sMask = oxConfig::getInstance()->getConfigParam( 'sShopDir' ).DIRECTORY_SEPARATOR.implode(DIRECTORY_SEPARATOR, array_diff($aFile, array(null, '')));

        foreach ( glob($sMask) as $sFile ) {
            if (is_readable($sFile)) {
                include $sFile;
                $aAllLang = array_merge($aAllLang, $aLang);
            } else {
                $aLang = array();
            }
        }

        $aFileGeneric = array( 'out', $sLang, 'lang.php' );
        $sGenericMask = oxConfig::getInstance()->getConfigParam( 'sShopDir' ).DIRECTORY_SEPARATOR.implode(DIRECTORY_SEPARATOR, array_diff($aFileGeneric, array(null, '')));

        foreach ( glob($sGenericMask) as $sFile ) {
            if (is_readable($sFile)) {
                include $sFile;
                $aAllLang = array_merge($aAllLang, $aLang);
            } else {
                $aLang = array();
            }
        }
        return $aAllLang;
    }

    /**
     * Get used language constants in given language file (parsing php file).
     *
     * @param string $sTheme theme name
     * @param string $sLang  languge abbr
     *
     * @return array
     */
    private function _getLanguageConst( $sTheme, $sLang )
    {
        $aSkip = array('SYSREQ_MEMORY_LIMIT');
        $aLang = array();
        $sFile = oxConfig::getInstance()->getConfigParam( 'sShopDir' )."out".DIRECTORY_SEPARATOR.$sTheme.DIRECTORY_SEPARATOR.$sLang.DIRECTORY_SEPARATOR."lang.php";
        $sArray =  file_get_contents($sFile);
        $sReg = "/'([A-Z\_0-9]+)' +/i";
        preg_match_all($sReg, $sArray, $aMatches);
        foreach ($aMatches[1] as $sConst) {
            if ( !in_array($sConst, $aSkip) ) {
                $aLang[] = trim($sConst);
            }
        }
        return $aLang;
    }

    /**
     * Get used language constants in given language file (parsing lang.php file).
     *
     * @param string $sTheme theme name
     * @param string $sLang  languge abbr
     *
     * @return array
     */
    /**
     * Get used language constants in given template set (parsing *.tpl files).
     *
     * @param string $sTheme theme name
     * @param string $sShop  shom id
     * @param string $sLang  languge abbr
     *
     * @return array
     */
    private function _getTemplateConstants( $sTheme, $sShop, $sLang)
    {
        $aLang = array();
        $aDir  = array('out', $sTheme, 'tpl' );
        $sDir  = oxConfig::getInstance()->getConfigParam( 'sShopDir' ).DIRECTORY_SEPARATOR.implode(DIRECTORY_SEPARATOR, array_diff($aDir, array(null, '')));

        if (is_dir($sDir)) {
           $aMatches = array();
           $aDirs    = array_merge( array($sDir), glob($sDir.DIRECTORY_SEPARATOR."*", GLOB_ONLYDIR) );
           foreach ($aDirs as $sTplDir) {
               foreach (glob($sTplDir.DIRECTORY_SEPARATOR."*.tpl") as $tpl) {
                   $sTpl =  file_get_contents($tpl);
                   $sReg = '/oxmultilang +ident="([A-Z\_0-9]+)"/i';
                   preg_match_all($sReg, $sTpl, $aMatches);

                   foreach ($aMatches[1] as $sConst) {
                       $aLang[] = $sConst;
                   }

                   $sReg = '/"([A-Z\_0-9]+)"\|oxmultilangassign/i';
                   preg_match_all($sReg, $sTpl, $aMatches);

                   foreach ($aMatches[1] as $sConst) {
                       $aLang[] = $sConst;
                   }
               }
           }
        }

        return array_unique($aLang);
    }

}
