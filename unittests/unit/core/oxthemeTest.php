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
 * @version   SVN: $Id: oxcaptchaTest.php 26841 2010-03-25 13:58:15Z arvydas $
 */

require_once realpath( "." ).'/unit/OxidTestCase.php';
require_once realpath( "." ).'/unit/test_config.inc.php';

class Unit_Core_oxthemeTest extends OxidTestCase
{

    protected $_oTheme = null;

    public function setup()
    {
        parent::setUp();

        $this->_oTheme = $this->getProxyClass('oxTheme');
    }

    public function testLoad()
    {
        $sTheme = 'basic';
        $aTheme = $this->_oTheme->load('basic');
        $aKeys = array('id','title','description','thumbnail','version','author');

        $this->assertEquals($aKeys, array_keys($aTheme));
        $this->assertEquals($sTheme, $aTheme['id']);
    }

    public function testGetList()
    {
        $iCount = 3;
        $aKeys = array('id','title','description','thumbnail','version','author','active');

        $aThemeList = $this->_oTheme->getList();

        $this->assertEquals($iCount, count($aThemeList));
        foreach ($aThemeList as $aTheme) {
            $this->assertEquals($aKeys, array_keys($aTheme));
        }
    }
}
