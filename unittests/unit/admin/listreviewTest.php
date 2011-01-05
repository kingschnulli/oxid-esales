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
 * @version   SVN: $Id: listreviewTest.php 26840 2010-03-25 13:28:50Z arvydas $
 */

require_once realpath( "." ).'/unit/OxidTestCase.php';
require_once realpath( "." ).'/unit/test_config.inc.php';

/**
 * Tests for List_Review class
 */
class Unit_Admin_ListReviewTest extends OxidTestCase
{
    /**
     * Tear down the fixture.
     *
     * @return null
     */
    protected function tearDown()
    {
        $this->cleanUpTable( 'oxlinks' );
        $this->cleanUpTable( 'oxorder' );
        $this->cleanUpTable( 'oxcontents' );
        $this->cleanUpTable( 'oxobject2category' );

        if ( isset( $_POST['oxid'] ) ) {
            unset( $_POST['oxid'] );
        }

        modSession::getInstance()->cleanup();

        //
        oxConfig::getInstance()->setGlobalParameter( 'ListCoreTable', null );

        parent::tearDown();
    }

    /**
     * List_Review::Render() test case
     *
     * @return null
     */
    public function testRender()
    {
        $oNavTree = $this->getMock( "oxnavigationtree", array( "getDomXml" ) );
        $oNavTree->expects( $this->once() )->method( 'getDomXml' )->will( $this->returnValue( new DOMDocument ) );

        $oView = $this->getMock( "List_Review", array( "getNavigation" ));
        $oView->expects( $this->at( $iCnt++ ) )->method( 'getNavigation' )->will( $this->returnValue( $oNavTree ) );
        $this->assertEquals( "list_review.tpl", $oView->render() );
    }

    /**
     * List_Review::_setFilterParams() test case
     *
     * @return null
     */
    public function testSetFilterParamsNonSet()
    {
        oxConfig::getInstance()->setGlobalParameter( 'ListCoreTable', null );
        modConfig::getInstance()->setParameter( 'where', null );

        $oAdminList = new List_Review;
        $oAdminList->UNITsetFilterParams();

        $aViewData = $oAdminList->getViewData();
        $this->assertFalse( isset( $aViewData['whereparam'] ) );
        $this->assertFalse( isset( $aViewData['where'] ) );
    }

    /**
     * List_Review::_setFilterParams() test case
     *
     * @return null
     */
    public function testSetFilterParams()
    {
        $sTable = getViewName( 'oxarticles' );
        $oWhere = new oxStdClass();
        $oWhere->{"oxarticles__oxtitle"} = 'testtitle';
        $oWhere->{"oxarticles__oxprice"} = 999;
        $oWhere->{"{$sTable}__oxtitle"} = 'testtitle';
        $oWhere->{"{$sTable}__oxprice"} = 999;

        $sWhereParam = '&amp;where['.$sTable.'.oxtitle]=testtitle&amp;where['.$sTable.'.oxprice]=999&amp;art_category=testcategory';

        oxConfig::getInstance()->setGlobalParameter( 'ListCoreTable', 'oxreviews' );
        modConfig::getInstance()->setParameter( 'art_category', 'testcategory' );
        modConfig::getInstance()->setParameter( 'where', array( $sTable.'.oxtitle' => 'testtitle', $sTable.'.oxprice' => 999 ) );

        $oAdminList = new List_Review;
        $oAdminList->UNITsetFilterParams();

        $aViewData = $oAdminList->getViewData();
        $this->assertEquals( $sWhereParam, $aViewData['whereparam'] );
        $this->assertEquals( $oWhere, $aViewData['where'] );
    }

    /**
     * Testing if methods removes parent id checking from sql
     *
     * @return null
     */
    public function testPrepareWhereQuery()
    {

        $oArtList = $this->getProxyClass( "Article_List" );
        $sSql = "select * from oxreview where 1";
        $sSql = $oArtList->UNITprepareWhereQuery( array(), $sSql );

        // checking if exists string oxarticle.oxparentid = ''
        $blCheckForParent = preg_match( "/\s+and\s+".getViewName( 'oxarticles' ).".oxparentid\s+=\s+''/", $sSql );
        $this->assertTrue( (bool)$blCheckForParent );

        $oList = $this->getProxyClass( 'List_Review' );
        $sSql = $oList->UNITprepareWhereQuery( array(), $sSql );

        // checking if not exists string oxarticle.oxparentid = ''
        $blCheckForParent = preg_match( "/\s+and\s+".getViewName( 'oxarticles' ).".oxparentid\s+=\s+''/", $sSql );
        $this->assertFalse( (bool)$blCheckForParent );
    }

    /**
     * Testing if methods removes parent id checking from sql
     *
     * @return null
     */
    public function testPrepareWhereQueryCase2()
    {
        $oArtList = $this->getProxyClass( "Article_List" );
        $sSql = "select * from oxreview where 1";
        $sSql = $oArtList->UNITprepareWhereQuery( array(), $sSql );

        // checking if exists string oxarticle.oxparentid = ''
        $blCheckForParent = preg_match( "/\s+and\s+".getViewName( 'oxarticles' ).".oxparentid\s+=\s+''/", $sSql );
        $this->assertTrue( (bool)$blCheckForParent );

        $oList = $this->getProxyClass( 'List_Review' );
        $sSql = $oList->UNITprepareWhereQuery( array(), $sSql );

        // checking if not exists string oxarticle.oxparentid = ''
        $blCheckForParent = preg_match( "/\s+and\s+".getViewName( 'oxarticles' ).".oxparentid\s+=\s+''/", $sSql );
        $this->assertFalse( (bool)$blCheckForParent );
    }

    /**
     * Testing if methods removes parent id checking from sql
     *
     * @return null
     */
    public function testPrepareOrderByQuery()
    {
        modConfig::setParameter( "sort", "testSort" );

        $oAdminList = new List_Review;
        $this->assertEquals( " order by testSort ", $oAdminList->UNITprepareOrderByQuery( "" ) );
    }
}
