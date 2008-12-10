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
 * @package smartyPlugins
 * @copyright © OXID eSales AG 2003-2008
 * $Id: insert.oxid_tracker.php 13615 2008-10-24 09:37:42Z sarunas $
 */

/*
* Smarty plugin
* -------------------------------------------------------------
* File: insert.oxid_tracker.php
* Type: string, html
* Name: oxid_tracker
* Purpose: Output etracker code or Econda Code
* add [{ insert name="oxid_tracker" title="..." }] after Body Tag in Templates
* -------------------------------------------------------------
*/
function smarty_insert_oxid_tracker($params, &$smarty)
{
    $myConfig = oxConfig::getInstance();
    $mySession = oxSession::getInstance();

    $sOutput = "";

    // -----------------------------------
    // eTracker
    // -----------------------------------
    $iShopID_etracker = $myConfig->getConfigParam( 'iShopID_etracker' );
    if ($iShopID_etracker && strtolower( $iShopID_etracker ) != 'xxx' )
    {
        include( $myConfig->getConfigParam( 'sCoreDir' )."smarty/plugins/etracker.inc.php");

        if( isset( $params['product']) && $params['product'])
        {    $oProduct     = $params['product'];
            $sTitle       = " - ".strip_tags( $oProduct->oxarticles__oxtitle->value);
        }
        else
            $sTitle        = "";

        $sUid = oxSession::getVar("usr")?"1":"0";
        $sBasket = "";

        $cl     = oxConfig::getParameter("cl");
        $fnc     = oxConfig::getParameter("fnc");

        $areas = $cl;
        if( isset( $fnc))
            $areas .= ",".$fnc;
        $sTargets = "";
        $iTval = 0;
        $iTsale = 0;
        $sTonr = '';
        switch ($cl)
        {
            case "basket":
                $sTargets = "basket";
                break;
            case "user":
                $sTargets = "basket/user";
                break;
            case "payment":

                $sTargets = "basket/user/payment";
                break;
            case "order":
                $sTargets = "basket/user/payment/order";
                break;
            case "thankyou":
                {
                    $sTargets = "basket/user/payment/order/thankyou";
                    $iTsale = 1;
                    // generate basket:
                    $blFirst = true;
                    $oOrder = &$smarty->_tpl_vars['order'];
                    $sTonr = @$oOrder->oxorder__oxordernr->value;
                    $sCatView = getViewName('oxcategories');
                    $sReplFrom = array(',',"\n","\r", ';');
                    $sReplTo   = array('.', ' ',  '', '.');
                    if( isset($oOrder) && @isset( $oOrder->oArticles) && count($oOrder->oArticles))
                    {   foreach( $oOrder->oArticles as $oItem)
                        {
                            if (!$blFirst)
                                $sBasket .= ';';
                            else
                                $blFirst = false;

                            $sO2CView = getViewName('oxobject2category');

                            $sMainSelect  = "select $sCatView.oxtitle from $sO2CView as oxobject2category left join ".$sCatView.' on '.$sCatView.'.oxid=oxobject2category.oxcatnid ';
                            $sMainSelect .= 'where oxobject2category.oxobjectid = "'.$oItem->oxorderarticles__oxartid->value.'" and '.$sCatView.'.oxid is not null ';
                            $sMainSelect .= 'order by oxobject2category.oxtime';
                            $sMainCat = oxDb::getDb()->getOne($sMainSelect);

                            $sBasket .= str_replace($sReplFrom,$sReplTo,oxDecodeHtmlEntities($oItem->oxorderarticles__oxartid->value)).','
                                       .str_replace($sReplFrom,$sReplTo,oxDecodeHtmlEntities($oItem->oxorderarticles__oxtitle->value)).','
                                       .str_replace($sReplFrom,$sReplTo,oxDecodeHtmlEntities($sMainCat)).','
                                       .str_replace($sReplFrom,$sReplTo,oxDecodeHtmlEntities($oItem->oxorderarticles__oxamount->value)).','
                                       .number_format($oItem->oxorderarticles__oxprice->value, 2, '.', '');
                            $iTval += $oItem->oxorderarticles__oxnetprice->value*$oItem->oxorderarticles__oxamount->value;
                        }
                    }
                }
                break;
        }

        $sOutput = getCode(
                              $iShopID_etracker,   // crypted statistic id (secure code)
                              $easy             = false,      // easy code
                              $ssl                 = $myConfig->isSsl(),      // HTTPS SSL code
                              $pagename         = $params['title'].$sTitle,    // pagename
                              $areas             = $areas,       // comma delimited area names
                              $ilevel = 1,       // advanced services: level of interest
                              $sTargets,         // advanced services: comma delimited target names
                              $iTval,            // advanced services: target value
                              $iTsale,           // advanced services: target is sale (not a lead) [lead = 0; sale = 1; store = 2]
                              $sTonr,            // advanced services: target order number
                              $lpage = 0,        // advanced services: landing page id
                              $trigger = 0,      // advanced services: trigger id
                              $sUid,             // advanced services: status of customer [new - 0 or registered - 1]
                              $sBasket,          // advanced services: shopping cart ["ArtNr1,ArtName1,ArtGruppe,Anzahl,Preis;ArtNr2,ArtName2,ArtGruppe,Anzahl,Preis";]
                              $se = 1,           // advanced services: campaign id [check search engines keywords]
                              true               // include plugin-detection [detect browser plugs? [false or true]]
                              );
    }

    // -----------------------------------
    // Econda
    // -----------------------------------
    if($myConfig->getConfigParam( 'blEcondaActive' ) )
    {
        include( $myConfig->getConfigParam( 'sCoreDir' )."smarty/plugins/oxide_emos_adapter.php");
        $sOutput .= getEMOSOxideCode($params, $smarty);
    }

    if (strlen(trim($sOutput)))
        $sOutput = "<div style=\"display:none;\">".$sOutput."</div>";

   return $sOutput;
}
