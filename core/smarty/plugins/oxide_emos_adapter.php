<?php
/*
Copyright (c) 2004, 2005 ECONDA GmbH Karlsruhe
All rights reserved.

ECONDA GmbH
Haid-und-Neu-Str. 7
76131 Karlsruhe
Tel. +49 (721) 6635726
Fax +49 (721) 66499070
info@econda.de
www.econda.de


Redistribution and use in source and binary forms, with or without modification,
are permitted provided that the following conditions are met:

* Redistributions of source code must retain the above copyright notice,
this list of conditions and the following disclaimer.
* Redistributions in binary form must reproduce the above copyright notice,
this list of conditions and the following disclaimer in the documentation
and/or other materials provided with the distribution.
* Neither the name of the ECONDA GmbH nor the names of its contributors may
be used to endorse or promote products derived from this software without
specific prior written permission.

THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" AND
ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED
WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE DISCLAIMED.
IN NO EVENT SHALL THE COPYRIGHT OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT,
INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING,
BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE,
DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF
LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT
(INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS
SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
*/

/** This Function is a reference implementation of a PHP Function to include
 *  ECONDA Trackiong into a Shop-System.
*
* The smarty tempaltes should include s tag like
* [{insert name="oxid_tracker" title=$template_title }]

*
* @param the smarty environment and aprams
* @return String the complete ECONDA tracking code
*/
function getEMOSOxideCode($params, &$smarty){

    /**
         * Returns path econda modules.
         * @return string
         */
    function getECONDA_Dir()
    {
        $myConfig = oxConfig::getInstance();
        $shopURL  = $myConfig->getConfigParam( 'sShopURL' );
        if( $myConfig->isSsl())
            $shopURL  = $myConfig->getConfigParam( 'sSSLShopURL' );

        $pathToECONDA = $shopURL."modules/econda/out/";

        return $pathToECONDA;
    }

    /**
     * from oxid/admin/dynexport.php
     *
     * Searches for deepest path to a categorie this article is assigned to
     */
    function GetDeepestCategoryPath( & $oArticle)
    {   $myConfig = oxConfig::getInstance();

        $iLanguage = oxLang::getInstance()->getBaseLanguage();
        //$iLanguage = ( isset( $iLanguage ) )?$iLanguage:oxSession::getVar( "language" );

        $suffix = ($iLanguage)?"_$iLanguage":"";
        $sCatView = getViewName('oxcategories');
        $sO2CView = getViewName('oxobject2category');

        $sSelect  = 'select '.$sCatView.'.oxtitle'.$suffix." from $sO2CView as oxobject2category left join ".$sCatView.' ';
        $sSelect .= 'on '.$sCatView.'.oxid=oxobject2category.oxcatnid where ';
        $sSelect .= 'oxobject2category.oxobjectid = "'.$oArticle->oxarticles__oxid->value.'" and ';
        $sSelect .= ' '.$sCatView.'.oxid is not null order by oxobject2category.oxtime';

        return oxDb::getDb()->GetOne( $sSelect);

        /* #1660A
        if( !isset( $myConfig->aCatLvlCache) || !count( $myConfig->aCatLvlCache))
                {       $myConfig->aCatLvlCache = array();

                        $sLang = $myConfig->getParameter("language");

                        // Load all root cat's == all trees
                        $sSQL = "select oxid from oxcategories where oxparentid = 'oxrootid'";
                $rs = $myConfig->oDB->Execute( $sSQL);
                if ($rs != false && $rs->RecordCount() > 0)
                {   while (!$rs->EOF)
                    {   // now load each tree
                        $sSQL = "SELECT s.oxid, s.oxtitle".(($sLang)?"_$sLang":"").", s.oxparentid, count( * ) AS LEVEL FROM oxcategories v, oxcategories s WHERE s.oxrootid = '".$rs->fields[0]."' and v.oxrootid='".$rs->fields[0]."' and s.oxleft BETWEEN v.oxleft AND v.oxright  AND s.oxhidden = '0' GROUP BY s.oxleft order by level";
                                $rs2 = $myConfig->oDB->Execute( $sSQL);
                                if ($rs2 != false && $rs2->RecordCount() > 0)
                                {   while (!$rs2->EOF)
                                    {   // store it
                                        $oCat = new stdClass();
                                        $oCat->_sOXID            = $rs2->fields[0];
                                        $oCat->oxtitle          = $rs2->fields[1];
                                        $oCat->oxparentid       = $rs2->fields[2];
                                        $oCat->ilevel           = $rs2->fields[3];
                                        $myConfig->aCatLvlCache[$oCat->_sOXID] = $oCat;

                                        $rs2->MoveNext();
                                    }
                                }
                        $rs->MoveNext();
                    }
                }
                }

                // find deepest
                $aIDs   = $oArticle->GetCategoryIds();
                if( isset( $aIDs) && count( $aIDs))
                {       $sIDMAX         = null;
                        $dMaxLvl        = 0;
                        foreach( $aIDs as $key => $sCatID)
                        {       if( $dMaxLvl < $myConfig->aCatLvlCache[$sCatID]->ilevel)
                                {       $dMaxLvl = $myConfig->aCatLvlCache[$sCatID]->ilevel;
                                        $sIDMAX = $sCatID;
                                }
                        }

                        // generate path
                        $sRet = $myConfig->aCatLvlCache[$sIDMAX]->oxtitle;
                        // endless
                        for( ;;)
                        {       $sIDMAX = @$myConfig->aCatLvlCache[$sIDMAX]->oxparentid;
                                if( !isset( $sIDMAX) || $sIDMAX == "oxrootid")
                                        break;
                                $sRet = $myConfig->aCatLvlCache[$sIDMAX]->oxtitle."/".$sRet;
                        }
                }

        return $sRet;
        */
    }

    //////////////////// functions /////////////////////////////////////////////
    /* Convert a oProduct to a EMOS_Item */
    function oProduct2EMOSItem($oProduct, $sCatPath="NULL", $quantity=1){
        $myConfig = oxConfig::getInstance();

        $item = new EMOS_Item();

        if(!($oProduct->oxarticles__oxartnum->value && $oProduct->oxarticles__oxartnum->value)){
            $item->productID = $oProduct->getId();
        }else{
            $item->productID = $oProduct->oxarticles__oxartnum->value;
        }
        $item->productName=$oProduct->oxarticles__oxtitle->value;

        // #810A
        $oCur = $myConfig->getActShopCurrencyObject();
        $item->price=$oProduct->getPrice()->getBruttoPrice() * ( 1/$oCur->rate);
        $item->productGroup = $sCatPath."/".$oProduct->oxarticles__oxtitle->value;
        $item->quantity = $quantity;
        return $item;
    }

    /* get Page Title */
    function getEMOSPageTitle($params){
        $sTitle     = $params['title'];
        return $sTitle;
    }

    /* get Purpose of this Page */
    function getEMOScl($myConfig){
        $cl = oxConfig::getParameter( "cl" );
        if ( !isset( $cl ) )
            $cl = "start";
        return $cl;
    }

    /* get the current catPath*/
    function getEMOSCatPath($smarty){
        $catPath="";
        $actCatPath = $smarty->_tpl_vars['actCatpath'];
        if($actCatPath){
            foreach($actCatPath as $key=>$value){
                if( $blSep)    $catPath .= "/";
                $catPath.=$value->oxcategories__oxtitle->value;
                $blSep = true;
            }
        }
        if($catPath=="") $catPath.="NULL";
        return $catPath;
    }
    //////////////////// init //////////////////////////////////////////////////

    $myConfig = oxConfig::getInstance();
    $mySession = oxSession::getInstance();

    $tpl = oxConfig::getParameter( 'tpl' );

   //require("emos.php");
   require($myConfig->getConfigParam( 'sCoreDir' )."smarty/plugins/emos.php");


    /* set globals for this function */
    if( isset( $params['product']) && $params['product']){
            $oProduct     = $params['product'];
    }
    $fnc = oxConfig::getParameter("fnc");
    $sCatPath = "".getEMOSCatPath($smarty);

    /* get the last Call for special handling function "tobasket", "changebasket"*/
    $sLastCall = oxSession::getVar( "sLastcall");
    if( isset( $sLastCall) && $sLastCall){
        oxSession::deleteVar( "sLastcall");
    }
    $oProduct    = null;
    if( isset( $params['product']) && $params['product']){
        $oProduct     = $params['product'];
    }
    //////////////////// Main //////////////////////////////////////////////////
    /* make a new emos instance for this call */
    $emos = new EMOS(getECONDA_Dir());
    /* make output more readable */
    $emos->prettyPrint();
    $emos->setSid($mySession->getId());

    /* set site ID
     * @todo
     */
    //    $siteid = $myConfig->getShopId();
    //    $emos->appendPreScript($emos->getAnchorTag("siteid",$siteid));

    /////////////////// test ///////////////////////////////////////////////////
    /*echo "\n<BR><BR><BR><BR><BR>***********************Vars*******************************<BR>\n";
    echo "Params:<bR><table border=0 >";

    foreach($params as $key=>$value)    {
        echo "<tr><td>".$key."</td><td>".$value."&nbsp</td></tr>\n";
    }
    echo "</table><br>";
    echo "<br>Smarty:<br><table border=0>";
    $vars = $smarty->_tpl_vars;
    foreach($vars as $key=>$value)    {
        echo "<tr><td>".$key."</td><td>".$value."</td></tr>\n";
    }

    echo"</table>";
    echo "<br>Smarty/Categorieren:<br><table border=0>";
    $actCatPath = $smarty->_tpl_vars['actCatpath'];

    if($actCatPath)
    foreach($actCatPath as $key=>$value)    {
        echo "<tr><td>".$key."</td><td>".$value->oxcategories__oxtitle->value."</td></tr>\n";
    }
    echo"</table>";
    echo "\n<BR>***********************Endvars*******************************<BR>\n";    */
    ////////////////////////////////////////////////////////////////////////////

    /* treat the different PageTypes */
        // #810A.
        $oCur = $myConfig->getActShopCurrencyObject();
    switch( getEMOScl($myConfig)){
        case "start":
            $emos->addContent("Start");
            break;
        case "basket":
            $emos->addContent("Shop/Kaufprozess/Warenkorb");
            $emos->addOrderProcess("1_Warenkorb");
            break;
        case "user":
            //ECONDA FIX track the OXID 3.x order process with the 3 different options plus default
            $sOption = oxConfig::getParameter( "option" );
            $sOption = ( isset( $sOption ) )?$sOption:oxSession::getVar( "option" );
            switch( $sOption )
            {
                case "1":
                    $emos->addContent("Shop/Kaufprozess/Kundendaten/OhneReg");
                    $emos->addOrderProcess("2_Kundendaten/OhneReg");
                    break;
                case "2":
                    $emos->addContent("Shop/Kaufprozess/Kundendaten/BereitsKunde");
                    $emos->addOrderProcess("2_Kundendaten/BereitsKunde");
                    break;
                case "3":
                    $emos->addContent("Shop/Kaufprozess/Kundendaten/NeuesKonto");
                    $emos->addOrderProcess("2_Kundendaten/NeuesKonto");
                    break;
                default:
                    $emos->addContent("Shop/Kaufprozess/Kundendaten");
                    $emos->addOrderProcess("2_Kundendaten");
                break;
            }
            break;
        case "payment":
            $emos->addContent("Shop/Kaufprozess/Zahlungsoptionen");
            $emos->addOrderProcess("3_Zahlungsoptionen");
            break;
        case "order":
            $emos->addContent("Shop/Kaufprozess/Bestelluebersicht");
            $emos->addOrderProcess("4_Bestelluebersicht");
            break;
        case "thankyou":
            $emos->addContent("Shop/Kaufprozess/Bestaetigung");
            $emos->addOrderProcess("5_Bestaetigung");
            /* get order Page Array */
            //ECONDA FIX use username (email address) instead of customer number
            $emos->addEmosBillingPageArray($smarty->_tpl_vars['order']->oxorder__oxordernr->value,
                            $smarty->_tpl_vars['oxcmp_user']->oxuser__oxusername->value,
                            $smarty->_tpl_vars['basket']->dprice * ( 1/$oCur->rate),
                            $smarty->_tpl_vars['order']->oxorder__oxbillcountry->value,
                            $smarty->_tpl_vars['order']->oxorder__oxbillzip->value,
                            $smarty->_tpl_vars['order']->oxorder__oxbillcity->value);

            /*get Basket Page Array*/
            $iCnt = 0;
            foreach( $smarty->_tpl_vars['basket']->getContents() as $oContent ){
                $oProduct = oxNew( "oxarticle");
                $oProduct->Load( $oContent->sProduct);
                $category =  GetDeepestCategoryPath( $oProduct);
                $item = oProduct2EMOSItem($oProduct,$category,$oContent->dAmount);
                $basket[$iCnt] = $item;
                $iCnt++;

            }
            $emos->addEmosBasketPageArray($basket);
            break;
        case "details":
            if( $oProduct)
                $emos->addContent("Shop/".$sCatPath."/".strip_tags( $oProduct->oxarticles__oxtitle->value));
                $category =  GetDeepestCategoryPath( $oProduct);
                $item = oProduct2EMOSItem($oProduct,$category,1);
                $emos->addDetailView($item);
            break;
        case "search":
            $emos->addContent("Shop/Suche");
                if($_SERVER['REQUEST_METHOD']=="POST"){ //ECONDA FIX only track first search page, not the following pages
                // #1184M - specialchar search
                $sSearchParamForLink = rawurlencode( oxConfig::getParameter( "searchparam", true ) );
                $sOutput .= $emos->addSearch($sSearchParamForLink,$smarty->_tpl_vars['pageNavigation']->iArtCnt);
            }
            break;
        case "alist":
            $emos->addContent("Shop/".$sCatPath);
            break;
        case "account_wishlist":
            $emos->addContent("Service/Wunschzettel");
            break;
        case "contact":
            if(!$smarty->_tpl_vars['success'] ){
                $emos->addContent("Service/Kontakt/Form");
            } else {
                $emos->addContent("Service/Kontakt/Success");
                $emos->addContact("Kontakt-Formular");
            }


            break;
        case "help":
            $emos->addContent("Service/Hilfe");
            break;
        case "newsletter":
            if(!$smarty->_tpl_vars['success'] ){
                $emos->addContent("Service/Newsletter/Form");
            }else{
                $emos->addContent("Service/Newsletter/Success");
            }
            break;
        case "guestbook":
            $emos->addContent("Service/Gaestebuch");
            break;
        case "links":
            $emos->addContent("Service/Links");
            break;
        case "info":

            switch( $tpl){
                case "impressum.tpl":
                $emos->addContent("Info/Impressum");
                break;
                case "agb.tpl":
                $emos->addContent("Info/AGB");
                break;
                case "order_info.tpl":
                $emos->addContent("Info/Bestellinfo");
                break;
                case "delivery_info.tpl":
                $emos->addContent("Info/Versandinfo");
                break;
                case "security_info.tpl":
                $emos->addContent("Info/Sicherheit");
                break;
            }
            break;
        case "account":
            if ( isset( $fnc) && $fnc){
                if($fnc != "logout"){
                    $emos->addContent("Login/Uebersicht");
                }else{
                    $emos->addContent("Login/Formular/Logout");
                }
            }else{
                $emos->addContent("Login/Formular/Login");
            }
            break;
        case "account_user":
            $emos->addContent("Login/Kundendaten");
            break;
        case "account_order":
            $emos->addContent("Login/Bestellungen");
            break;
        case "account_noticelist":
            $emos->addContent("Login/Merkzettel");
            break;
        case "account_newsletter":
            $emos->addContent("Login/Newsletter");
            break;
        case "account_whishlist":
            $emos->addContent("Login/Wunschzettel");
            break;
        case "forgotpassword":
            $emos->addContent("Login/PW vergessen");
            break;
        case "content":
            $emos->addContent("Content/".getEMOSPageTitle($params));
            break;
        case "register":

            $emos->addContent("Service/Register");
            if($smarty->_tpl_vars['usr_error'] < 0){
                if( isset( $smarty->_tpl_vars['oxcmp_user']->oxuser__oxid->value) && $smarty->_tpl_vars['oxcmp_user']->oxuser__oxid->value){
                    $user_name = $smarty->_tpl_vars['oxcmp_user']->oxuser__oxid->value;
                }else{
                    $user_name = "NULL";
                }
                $emos->addRegister($user_name , abs($smarty->_tpl_vars['usr_error']));
            }
            if($smarty->_tpl_vars['success'] > 0){
                if( isset( $smarty->_tpl_vars['oxcmp_user']->oxuser__oxid->value) && $smarty->_tpl_vars['oxcmp_user']->oxuser__oxid->value){
                    $emos->addRegister($smarty->_tpl_vars['oxcmp_user']->oxuser__oxid->value , 0);
                }
            }
            break;
        default:
            break;
    }


    /* ADD To Basket and Remove from Basket */
    if( isset( $sLastCall) && $sLastCall){
        $aCall = explode( "&", $sLastCall);

        switch( $aCall[0]){
            case "changebasket":
                $sProductID = oxConfig::getParameter( "aid");
                $dNewAmount = oxConfig::getParameter( "am");
                $dOldAmount    = $aCall[1];
                $dReduceby = $dOldAmount - $dNewAmount;

                $oProduct = oxNew( "oxarticle");
                $oProduct->Load( $sProductID);
                 $category =  GetDeepestCategoryPath( $oProduct); //ECONDA FIX always use the main category
                $item = oProduct2EMOSItem($oProduct,$category,$dReduceby);
                $emos->removeFromBasket($item);
                break;
            case "tobasket":
                $sProductID = oxConfig::getParameter( "anid");
                //ECONDA FIX if there is a "add to basket" in the artcle list view, we do not have a product ID here
                if($sProductID && $sProductID){
                    $oProduct = oxNew( "oxarticle");
                    $oProduct->Load( $sProductID);
                    $category =  GetDeepestCategoryPath( $oProduct); //ECONDA FIX always use the main category
                    $item = oProduct2EMOSItem($oProduct,$category ,1);
                    $emos->addToBasket($item);
                }
                break;
        }
    }

    /*track logins */
    if( isset( $fnc) && $fnc){
        switch( $fnc){
            case "login_noredirect":
                if( isset( $smarty->_tpl_vars['oxcmp_user']->oxuser__oxid->value) && $smarty->_tpl_vars['oxcmp_user']->oxuser__oxid->value)
                    $blSuccess = "0";//ECONDA FIX wenn Login erfolgreich, dann  0 uebermitteln
                else
                    $blSuccess = "1";
                $sUser  = oxConfig::getParameter( "lgn_usr");
                $emos->addLogin($sUser,$blSuccess);
                break;
        }
    }



    return "\n".$emos->toString();

}
?>
