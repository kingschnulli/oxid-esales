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
 * @version   SVN: $Id: oxviewconfigTest.php 28156 2010-06-04 11:33:10Z arvydas $
 */

require_once realpath( "." ).'/unit/OxidTestCase.php';
require_once realpath( "." ).'/unit/test_config.inc.php';

class Unit_Views_oxviewConfigTest extends OxidTestCase
{
    /**
     * Tear down the fixture.
     *
     * @return null
     */
    protected function tearDown()
    {

        parent::tearDown();
    }

    /**
     * oxViewConfig::getHelpPageLink() test case
     *
     * @return null
     */
    public function testGetHelpPageLink()
    {
        $sShopUrl = oxConfig::getInstance()->getConfigParam( "sShopURL" );

        $oViewConfig = $this->getMock( "oxviewconfig", array( "getActiveClassName" ) );
        $oViewConfig->expects( $this->once() )->method( "getActiveClassName" )->will( $this->returnValue( "start" ) );
        $this->assertEquals( $sShopUrl . "Hilfe-Die-Startseite/", $oViewConfig->getHelpPageLink() );

        $oViewConfig = $this->getMock( "oxviewconfig", array( "getActiveClassName" ) );
        $oViewConfig->expects( $this->once() )->method( "getActiveClassName" )->will( $this->returnValue( "alist" ) );
        $this->assertEquals( $sShopUrl . "Hilfe-Die-Produktliste/", $oViewConfig->getHelpPageLink() );

        $oViewConfig = $this->getMock( "oxviewconfig", array( "getActiveClassName" ) );
        $oViewConfig->expects( $this->once() )->method( "getActiveClassName" )->will( $this->returnValue( "details" ) );
        $this->assertEquals( $sShopUrl . "Hilfe-Main/", $oViewConfig->getHelpPageLink() );
    }

    /**
     * oxViewConfig::getHelpPageLink() test case
     *
     * @return null
     */
    public function testGetHelpPageLinkInactiveContents()
    {
        modDB::getInstance()->addClassFunction( 'getOne', create_function('$x', 'return false;' ) );

        $oViewConfig = $this->getMock( "oxviewconfig", array( "getActiveClassName", "getHelpLink" ) );
        $oViewConfig->expects( $this->once() )->method( "getActiveClassName" )->will( $this->returnValue( "start" ) );
        $oViewConfig->expects( $this->once() )->method( "getHelpLink" );
        $oViewConfig->getHelpPageLink();
    }

    public function testGetHomeLinkEng()
    {
        oxTestModules::addFunction("oxutilsserver", "getServerVar", "{ \$aArgs = func_get_args(); if ( \$aArgs[0] === 'HTTP_HOST' ) { return '".oxConfig::getInstance()->getShopUrl()."'; } elseif ( \$aArgs[0] === 'SCRIPT_NAME' ) { return ''; } else { return \$_SERVER[\$aArgs[0]]; } }");
        oxTestModules::addFunction( "oxLang", "getBaseLanguage", "{return 1;}" );

        $oViewConfig = new oxviewconfig();
        $this->assertEquals( oxConfig::getInstance()->getShopUrl().'en/home/', $oViewConfig->getHomeLink() );
    }

    public function testGetHomeLink_defaultLanguageEn()
    {
        oxTestModules::addFunction("oxutilsserver", "getServerVar", "{ \$aArgs = func_get_args(); if ( \$aArgs[0] === 'HTTP_HOST' ) { return '".oxConfig::getInstance()->getShopUrl()."'; } elseif ( \$aArgs[0] === 'SCRIPT_NAME' ) { return ''; } else { return \$_SERVER[\$aArgs[0]]; } }");
        oxTestModules::addFunction( "oxLang", "getBaseLanguage", "{return 1;}" );
        modConfig::getInstance()->setConfigParam( "sDefaultLang", 1 );

        $oViewConfig = new oxviewconfig();
        $this->assertEquals( oxConfig::getInstance()->getShopUrl(), $oViewConfig->getHomeLink() );
    }

    public function testGetHomeLinkPe()
    {

        oxTestModules::addFunction("oxutilsserver", "getServerVar", "{ \$aArgs = func_get_args(); if ( \$aArgs[0] === 'HTTP_HOST' ) { return '".oxConfig::getInstance()->getShopUrl()."'; } elseif ( \$aArgs[0] === 'SCRIPT_NAME' ) { return ''; } else { return \$_SERVER[\$aArgs[0]]; } }");
        $oViewConfig = new oxviewconfig();
        $this->assertEquals( oxConfig::getInstance()->getShopURL(), $oViewConfig->getHomeLink() );
    }



    // just testing if fields are present ..
    public function testIfAllDefaultDataIsSet()
    {
        modConfig::setParameter( 'listtype', null );

        $myConfig = oxConfig::getInstance();
        $myConfig->setActiveView(null);
        $aParams = array();
        $aParams['sid'] = oxSession::getInstance()->getId();
        $sLang = oxLang::getInstance()->getFormLang();
        $aParams['hiddensid']    = oxSession::getInstance()->hiddenSid().( ( $sLang ) ? "\n{$sLang}" : "" );
        $aParams['selflink']     = $myConfig->getShopHomeURL();
        $aParams['sslselflink']  = $myConfig->getShopSecureHomeURL();
        $aParams['basedir']      = $myConfig->getShopURL();
        $aParams['coreutilsdir'] = $myConfig->getCoreUtilsURL();
        $aParams['selfactionlink'] = $myConfig->getShopCurrentURL();
        $aParams['currenthomedir'] = $myConfig->getCurrentShopURL();
        $aParams['basketlink']     = $myConfig->getShopHomeURL() . 'cl=basket';
        $aParams['orderlink']      = $myConfig->getShopSecureHomeUrl() . 'cl=user';
        $aParams['paymentlink']    = $myConfig->getShopSecureHomeUrl() . 'cl=payment';
        $aParams['exeorderlink']   = $myConfig->getShopSecureHomeUrl() . 'cl=order&amp;fnc=execute';
        $aParams['orderconfirmlink'] = $myConfig->getShopSecureHomeUrl() . 'cl=order';
        $aParams['basetpldir']       = $myConfig->getBaseTemplateDir( false );
        $aParams['templatedir']      = $myConfig->getTemplateDir( false );
        $aParams['urltemplatedir'] = $myConfig->getTemplateUrl( false );
        $aParams['imagedir']       = $myConfig->getImageUrl();
        $aParams['nossl_imagedir'] = $aParams['nosslimagedir'] = $myConfig->getNoSSLImageDir( false );
        $aParams['dimagedir']      = $myConfig->getDynImageDir();
        $aParams['admindir']       = $myConfig->getConfigParam( 'sAdminDir' );
        $aParams['id']             = $myConfig->getShopId();
        $aParams['isssl']          = $myConfig->isSsl();
        $aParams['ip']             = oxUtilsServer::getInstance()->getRemoteAddress();
        $aParams['popupident']     = md5( $myConfig->getShopURL() );
        $aParams['artperpageform'] = $myConfig->getShopCurrentURL();
        $aParams['buyableparent']  = $aParams['isbuyableparent'] = $myConfig->getConfigParam( 'blVariantParentBuyable' );
        $aParams['blshowbirthdayfields'] = $myConfig->getConfigParam( 'blShowBirthdayFields' );
        $aParams['blshowfinalstep']   = $myConfig->getConfigParam( 'blShowFinalStep' );
        $aParams['anrofcatarticles']  = $myConfig->getConfigParam( 'aNrofCatArticles' );
        $aParams['blautosearchoncat'] = $myConfig->getConfigParam( 'blAutoSearchOnCat' );
        $aParams['cnid'] = $aParams['actcatid'] = null;
        $aParams['cl']   = oxConfig::getInstance()->getActiveView()->getClassName();
        $aParams['tpl']  = null;
        $aParams['lang'] = oxLang::getInstance()->getBaseLanguage();
        $aParams['helplink']   = $myConfig->getShopCurrentURL()."cl=help&amp;page=";
        $aParams['logoutlink'] = $myConfig->getShopHomeURL()."cl=".oxConfig::getInstance()->getActiveView()->getClassName()."&amp;&amp;fnc=logout&amp;redirect=1";
        $aParams['iartPerPage']   = '';
        $sListType = oxConfig::getInstance()->getGlobalParameter( 'listtype' );
        $aParams['navurlparams']  = $sListType ? "&amp;listtype=$sListType" : '';
        $aParams['navformparams'] = $sListType ? "<input type=\"hidden\" name=\"listtype\" value=\"$sListType\">\n" : '';
        $aParams['blstockondefaultmessage']  = oxConfig::getInstance()->getConfigParam( 'blStockOnDefaultMessage' );
        $aParams['blstockoffdefaultmessage'] = oxConfig::getInstance()->getConfigParam( 'blStockOffDefaultMessage' );
        $aParams['sShopVersion'] = '';
        $aParams['ajaxlink']     = '';
        $aParams['ismultishop']  = false;
        $aParams['sServiceUrl']  = '';


        $oViewConf = new oxViewConfig();
        foreach ( $aParams as $sVarName => $sVarValue ) {
            $sFncName = "get$sVarName";
            $sResult  = $oViewConf->$sFncName();
            $this->assertEquals( $sVarValue, $sResult, "'$sVarName' does not match ($sVarValue != $sResult)" );
        }
    }

    /**
     * check config params getter
     */
    public function testGetShowWishlist()
    {
        $oCfg = $this->getMock('oxconfig', array('getConfigParam'));
        $oCfg->expects($this->once())
             ->method('getConfigParam')
             ->with($this->equalTo('bl_showWishlist'))
             ->will($this->returnValue('lalala'));
        $oVC = $this->getMock('oxviewconfig', array('getConfig'));
        $oVC->expects($this->once())
             ->method('getConfig')
             ->will($this->returnValue($oCfg));
        $this->assertEquals('lalala', $oVC->getShowWishlist());
    }



    /**
     * check config params getter
     */
    public function testGetShowCompareList()
    {
        $oCfg = $this->getMock('oxconfig', array('getConfigParam'));
        $oCfg->expects($this->once())
             ->method('getConfigParam')
             ->with($this->equalTo('bl_showCompareList'))
             ->will($this->returnValue('lalala'));
        $oVC = $this->getMock('oxviewconfig', array('getConfig'));
        $oVC->expects($this->once())
             ->method('getConfig')
             ->will($this->returnValue($oCfg));
        $this->assertEquals('lalala', $oVC->getShowCompareList());
    }

    /**
     * check config params getter
     */
    public function testGetShowListmania()
    {
        $oCfg = $this->getMock('oxconfig', array('getConfigParam'));
        $oCfg->expects($this->once())
             ->method('getConfigParam')
             ->with($this->equalTo('bl_showListmania'))
             ->will($this->returnValue('lalala'));
        $oVC = $this->getMock('oxviewconfig', array('getConfig'));
        $oVC->expects($this->once())
             ->method('getConfig')
             ->will($this->returnValue($oCfg));
        $this->assertEquals('lalala', $oVC->getShowListmania());
    }
    /**
     * check config params getter
     */
    public function testGetShowVouchers()
    {
        $oCfg = $this->getMock('oxconfig', array('getConfigParam'));
        $oCfg->expects($this->once())
             ->method('getConfigParam')
             ->with($this->equalTo('bl_showVouchers'))
             ->will($this->returnValue('lalala'));
        $oVC = $this->getMock('oxviewconfig', array('getConfig'));
        $oVC->expects($this->once())
             ->method('getConfig')
             ->will($this->returnValue($oCfg));
        $this->assertEquals('lalala', $oVC->getShowVouchers());
    }

    /**
     * check config params getter
     */
    public function testGetShowGiftWrapping()
    {
        $oCfg = $this->getMock('oxconfig', array('getConfigParam'));
        $oCfg->expects($this->once())
             ->method('getConfigParam')
             ->with($this->equalTo('bl_showGiftWrapping'))
             ->will($this->returnValue('lalala'));
        $oVC = $this->getMock('oxviewconfig', array('getConfig'));
        $oVC->expects($this->once())
             ->method('getConfig')
             ->will($this->returnValue($oCfg));
        $this->assertEquals('lalala', $oVC->getShowGiftWrapping());
    }

    public function testGetRemoteAccessToken()
    {
        $oSubj = new oxViewConfig();
        $sTestToken1 = $oSubj->getRemoteAccessToken();
        $sTestToken2 = $oSubj->getRemoteAccessToken();

        $this->assertEquals($sTestToken1, $sTestToken2);
        $this->assertEquals(8, strlen($sTestToken1));
    }

    public function testGetLogoutLink()
    {
        $oCfg = $this->getMock('oxconfig', array('getShopHomeURL'));
        $oCfg->expects($this->once())
             ->method('getShopHomeURL')
             ->will($this->returnValue('shopHomeUrl/'));
        $oVC = $this->getMock('oxviewconfig', array('getConfig', 'getActionClassName', 'getActCatId', 'getActTplName'));
        $oVC->expects($this->once())
             ->method('getConfig')
             ->will($this->returnValue($oCfg));
        $oVC->expects($this->once())
             ->method('getActionClassName')
             ->will($this->returnValue('actionclass'));
        $oVC->expects($this->once())
             ->method('getActCatId')
             ->will($this->returnValue('catid'));
        $oVC->expects($this->once())
             ->method('getActTplName')
             ->will($this->returnValue('tpl'));

        $this->assertEquals('shopHomeUrl/cl=actionclass&amp;cnid=catid&amp;fnc=logout&amp;tpl=tpl&amp;redirect=1', $oVC->getLogoutLink());
    }

    /**
     * check config params getter
     */
    public function testGetActionClassName()
    {
        $oV = $this->getMock('oxview', array('getActionClassName'));
        $oV->expects($this->once())
             ->method('getActionClassName')
             ->will($this->returnValue('lalala'));
        $oCfg = $this->getMock('oxconfig', array('getActiveView'));
        $oCfg->expects($this->once())
             ->method('getActiveView')
             ->will($this->returnValue($oV));
        $oVC = $this->getMock('oxviewconfig', array('getConfig'));
        $oVC->expects($this->once())
             ->method('getConfig')
             ->will($this->returnValue($oCfg));
        $this->assertEquals('lalala', $oVC->getActionClassName());
    }
}
