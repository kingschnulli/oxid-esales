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
 * @version   SVN: $Id: userarticleTest.php 26267 2010-03-04 08:28:32Z arvydas $
 */

require_once realpath( "." ).'/unit/OxidTestCase.php';
require_once realpath( "." ).'/unit/test_config.inc.php';

/**
 * Tests for User_Article class
 */
class Unit_Admin_UserArticleTest extends OxidTestCase
{
    /**
     * User_Article::Render() test case
     *
     * @return null
     */
    public function testRender()
    {
        modConfig::setParameter( "oxid", "oxdefaultadmin" );

        // testing..
        $oView = new User_Article();
        $this->assertEquals( 'user_article.tpl', $oView->render() );
        $aViewData = $oView->getViewData();
        $this->assertTrue( isset( $aViewData['oArticlelist'] ) );
        $this->assertTrue( $aViewData['oArticlelist'] instanceof oxorderarticlelist );
    }
}
