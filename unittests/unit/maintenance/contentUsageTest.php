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
 * @version   SVN: $Id: contentUsageTest.php 26841 2010-03-25 13:58:15Z arvydas $
 */

require_once realpath( "." ).'/unit/OxidTestCase.php';
require_once realpath( "." ).'/unit/test_config.inc.php';

/**
 * Test content usage in templates.
 */
class Unit_Maintenance_contentUsageTest extends OxidTestCase
{
    private $_aContents = array();
    private $_sDir      = "";

    /**
     * Initialize the fixture.
     *
     * @return null
     */
    protected function setUp()
    {
        parent::setUp();

        $this->_aContents = array();
        $rs = oxDb::getDb()->execute( "SELECT OXLOADID FROM `oxcontents` ");
        if ($rs != false && $rs->recordCount() > 0) {
            while (!$rs->EOF) {
                $this->_aContents[] = $rs->fields[0];
                $rs->moveNext();
            }
        }
        $this->_sDir = oxConfig::getInstance()->getConfigParam( 'sShopDir' );
    }

    /**
     * Test if all content used in templates and views really exist.
     *
     * @return null
     */
    public function testContentUsage()
    {
        $aConst = $this->_checkTemplates( $this->_sDir, $this->_aContents);
        $this->assertEquals( array(), $aConst);
    }

    /**
     * Checks template and view files for non existing but still used content.
     *
     * @param string $dir    base directory
     * @param array  $aConst not used constants array
     *
     * @return array
     */
    private function _checkTemplates( $dir, $aConst)
    {
        // regular templates
        foreach (glob($dir."/out/basic/tpl/*.tpl") as $tpl) {
            $aConst = $this->_getNotUsedInTemplates($tpl, $aConst, true);
        }
        // includable templates
        foreach (glob($dir."/out/basic/tpl/inc/*.tpl") as $tpl) {
            $aConst = $this->_getNotUsedInTemplates($tpl, $aConst, true);
        }
        foreach (glob($dir."/views/*.php") as $php) {
            $aConst = $this->_getNotUsedInTemplates($php, $aConst, false);
        }
        return $aConst;
    }

    /**
     * Returns array of non existing but used content.
     *
     * @param string $ftpl   file path
     * @param array  $aConst not used constants array
     * @param bool   $blTpl  is checked file a template
     *
     * @return array
     */
    private function _getNotUsedInTemplates( $ftpl, $aConst, $blTpl = false )
    {
        $aFormerCont = array( 'oxbargain' ); //used only for former tpl
        $subject = file_get_contents($ftpl);
        foreach ($aConst as $const => $value) {
            if ( in_array( $value, $aFormerCont ) ) {
                unset( $aConst[$const]);
            }
            if ( $blTpl ) {
                $pattern = '/ox(if)*content ident="'.$value.'"|getContentByIdent\("'.$value.'"\)/i';
            } else {
                $pattern = "/'".$value."'/";
            }
            if (preg_match($pattern, $subject, $matches)) {
                unset( $aConst[$const]);
            }
        }
        return $aConst;
    }
}
