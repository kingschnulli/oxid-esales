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
 * @package admin
 * @copyright (C) OXID eSales AG 2003-2009
 * @version OXID eShop CE
 * $Id: article_variant.php 23240 2009-10-14 11:20:27Z vilma $
 */

/**
 * Admin article variants manager.
 * Collects and updates article variants data.
 * Admin Menu: Manage Products -> Articles -> Variants.
 * @package admin
 */
class Article_Variant extends oxAdminDetails
{
    /**
     * Loads article variants data, passes it to Smarty engine and returns name of
     * template file "article_variant.tpl".
     *
     * @return string
     */
    public function render()
    {
        parent::render();

        $soxId = oxConfig::getParameter( "oxid");
        $sSLViewName = getViewName('oxselectlist');

        // all selectlists
        $oAllSel = oxNew( "oxlist");
        $oAllSel->init( "oxselectlist");
        $sQ = "select * from $sSLViewName";
        $oAllSel->selectString( $sQ);
        $this->_aViewData["allsel"] = $oAllSel;

        $oArticle = oxNew( "oxarticle");
        $this->_aViewData["edit"] =  $oArticle;

        if ( $soxId != "-1" && isset( $soxId)) {
            // load object
            $oArticle->loadInLang( $this->_iEditLang, $soxId );


            $_POST["language"] = $_GET["language"] = $this->_iEditLang;
            $oVariants = $oArticle->getAdminVariants( $this->_iEditLang);

            $this->_aViewData["mylist"] =  $oVariants;

            // load object in other languages
            $oOtherLang = $oArticle->getAvailableInLangs();
            if (!isset($oOtherLang[ $this->_iEditLang])) {
                // echo "language entry doesn't exist! using: ".key($oOtherLang);
                $oArticle->loadInLang( key($oOtherLang), $soxId );
            }

            foreach ( $oOtherLang as $id => $language) {
                $oLang= new oxStdClass();
                $oLang->sLangDesc = $language;
                $oLang->selected = ($id == $this->_iEditLang);
                $this->_aViewData["otherlang"][$id] =  clone $oLang;
            }

            if ( $oArticle->oxarticles__oxparentid->value) {
                $oParentArticle = oxNew( "oxarticle");
                $oParentArticle->load( $oArticle->oxarticles__oxparentid->value);
                $this->_aViewData["parentarticle"] =  $oParentArticle;
                $this->_aViewData["oxparentid"] =  $oArticle->oxarticles__oxparentid->value;
                $this->_aViewData["issubvariant"] = 1;
                // A. disable variant information editing for variant
                $this->_aViewData["readonly"] = 1;
            }
            $this->_aViewData["editlanguage"] = $this->_iEditLang;

            $aLang = array_diff (oxLang::getInstance()->getLanguageNames(), $oOtherLang);
            if ( count( $aLang))
                $this->_aViewData["posslang"] = $aLang;

            foreach ( $oOtherLang as $id => $language) {
                $oLang= new oxStdClass();
                $oLang->sLangDesc = $language;
                $oLang->selected = ($id == $this->_iEditLang);
                $this->_aViewData["otherlang"][$id] =  $oLang;
            }
        }

        return "article_variant.tpl";
    }

    /**
     * Saves article variant.
     *
     * @param string $soxId
     * @param array  $aParams
     *
     * @return null
     */
    public function savevariant($soxId = null, $aParams = null)
    {
        $myConfig  = $this->getConfig();

        //if (!oxConfig::getParameter( "editlanguage"))
        //    oxSession::setVar( "editlanguage", $this->_iEditLang);

        if (!isset($soxId) && !isset($aParams)) {
            $soxId      = oxConfig::getParameter( "voxid");
            $aParams    = oxConfig::getParameter( "editval");
        }

        // checkbox handling
        if ( !isset( $aParams['oxarticles__oxactive']))
            $aParams['oxarticles__oxactive'] = 0;

            // shopid
            $sShopID = oxSession::getVar( "actshop");
            $aParams['oxarticles__oxshopid'] = $sShopID;

        // varianthandling
        $soxparentId = oxConfig::getParameter( "oxid");
        if ( isset( $soxparentId) && $soxparentId && $soxparentId != "-1")
            $aParams['oxarticles__oxparentid'] = $soxparentId;
        else
            unset( $aParams['oxarticles__oxparentid']);

        $oArticle = oxNew( "oxarticle");

        /*
        //TODO: solve this from lazy loading point of view
        //acessing main fields for lazy loading mechnism to iniatialise them
        $oArticle->oxarticles__oxvarselect->value;
        $oArticle->oxarticles__oxartnum->value;
        $oArticle->oxarticles__oxprice->value;
        $oArticle->oxarticles__oxstock->value;
        $oArticle->oxarticles__oxshopid->value;
        $oArticle->oxarticles__oxshopincl->value;
        $oArticle->oxarticles__oxshopexcl->value;*/

        if ( $soxId != "-1") {
            $oArticle->loadInLang( $this->_iEditLang, $soxId );
        }


        $oArticle->setLanguage(0);
        $oArticle->assign( $aParams);
        $oArticle->setLanguage($this->_iEditLang);

            //echo $aParams['oxarticles__oxartnum']."---";
            $oArticle->save();

        $oArticle->setLanguage( $this->_iEditLang);
    }

    /**
     * Saves all article variants at once.
     *
     * @return null
     */
    public function savevariants()
    {
        $myConfig = $this->getConfig();


        $aParams = oxConfig::getParameter( "editval");

        if (is_array($aParams))
            foreach($aParams as $soxId => $aVarParams)
                $this->savevariant($soxId, $aVarParams);

    }

    /**
     * Deletes article variant.
     *
     * @return null
     */
    public function deleteVariant()
    {


        $soxId = oxConfig::getParameter( "voxid");
        $oDelete = oxNew( "oxarticle" );
        $oDelete->delete( $soxId);
    }

    /**
     * Changes name of variant.
     *
     * @return null
     */
    public function changename()
    {
        //if (!oxConfig::getParameter( "editlanguage"))
        //    oxSession::setVar( "editlanguage",$this->_iEditLang);

        $soxId   = oxConfig::getParameter( "oxid");
        $aParams = oxConfig::getParameter( "editval");



            // shopid
            $sShopID = oxSession::getVar( "actshop");
            $aParams['oxarticles__oxshopid'] = $sShopID;

        $oArticle = oxNew( "oxarticle");

        if ( $soxId != "-1")
            $oArticle->loadInLang( $this->_iEditLang, $soxId );

        //$aParams = $oArticle->ConvertNameArray2Idx( $aParams);

        $oArticle->setLanguage(0);
        $oArticle->assign( $aParams);
        $oArticle->setLanguage($this->_iEditLang);

        $oArticle->save();
        //$oArticle->SetLanguage(oxConfig::getParameter( "editlanguage"));
        $oArticle->setLanguage( $this->_iEditLang);
    }


    /**
     *
     * @return null
     */
    public function addsel()
    {
        $myConfig = $this->getConfig();

        $aSels = oxConfig::getParameter("allsel");
        $sParentID = oxConfig::getParameter("oxid");
        $oArticle = oxNew("oxarticle");
        $oArticle->load($sParentID);
        $oVariants = $oArticle->getAdminVariants();



        if ($aSels) {
            $myUtils = oxUtils::getInstance();
            $myLang  = oxLang::getInstance();
            $oDb = oxDb::getDb();
            foreach ($aSels as $sSelID) {

                $oSel = oxNew("oxbase");
                $oSel->init( 'oxselectlist' );
                $oSel->load( $sSelID);

                $aValues = $myUtils->assignValuesFromText($oSel->oxselectlist__oxvaldesc->value );
                //iterating through all select list values (eg. $oValue->name = S, M, X, XL)
                $iCounter = 0;
                foreach ($aValues as $oValue) {
                    $dPriceMod = $this->_getValuePrice( $oValue, $oArticle->oxarticles__oxprice->value);

                    if ($oVariants->count()>0) {
                        //if we have any existing variants then copying each variant with $oValue->name
                        foreach ($oVariants as $oSimpleVariant) {
                            if (!$iCounter) {
                                //we just update the first variant
                                $oVariant = oxNew("oxarticle");
                                $oVariant->load($oSimpleVariant->oxarticles__oxid->value);
                                $oVariant->oxarticles__oxprice->setValue($oVariant->oxarticles__oxprice->value + $dPriceMod);
                                $oVariant->oxarticles__oxvarselect->setValue($oVariant->oxarticles__oxvarselect->value." ".$oValue->name);
                                $oVariant->oxarticles__oxsort->setValue($oVariant->oxarticles__oxsort->value * 10);
                                $oVariant->save();
                                $sVarId = $oSimpleVariant->oxarticles__oxid->value;
                            } else {
                                //we create new variants
                                $aParams['oxarticles__oxvarselect'] = $oSimpleVariant->oxarticles__oxvarselect->value." ".$oValue->name;
                                $aParams['oxarticles__oxartnum'] = $oSimpleVariant->oxarticles__oxartnum->value . "-" . $iCounter;
                                $aParams['oxarticles__oxprice'] = $oSimpleVariant->oxarticles__oxprice->value + $dPriceMod;
                                $aParams['oxarticles__oxsort'] = $oSimpleVariant->oxarticles__oxsort->value*10 + 10*$iCounter;
                                $aParams['oxarticles__oxstock'] = 0;
                                $aParams['oxarticles__oxstockflag'] = $oSimpleVariant->oxarticles__oxstockflag->value;
                                $sVarId = $this->craeteNewVariant($sParentID, $aParams);
                            }
                        }
                        $iCounter++;

                    } else {
                        //in case we don't have any variants then we just create variant(s) with $oValue->name

                        //so yes here we create a new variant
                        $aParams['oxarticles__oxvarselect'] = $oValue->name;
                        $aParams['oxarticles__oxartnum'] = $oArticle->oxarticles__oxartnum->value;
                        $aParams['oxarticles__oxprice'] = $oArticle->oxarticles__oxprice->value + $dPriceMod;
                        $aParams['oxarticles__oxsort'] = 5000 + $iCounter++ * 1000;
                        $aParams['oxarticles__oxstock'] = 0;
                        $aParams['oxarticles__oxstockflag'] = $oArticle->oxarticles__oxstockflag->value;
                        $sVarId = $this->craeteNewVariant($sParentID, $aParams);
                    }
                    if ($myConfig->getConfigParam( 'blUseMultidimensionVariants' )) {
                        $oVariantHandler = oxNew("oxVariantHandler");
                        $oVariantHandler->assignVarToAttribute( $sVarId, $oSel->oxselectlist__oxtitle->value, $oValue->name );
                    }
                }
                $oArticle->oxarticles__oxvarname->setValue($oArticle->oxarticles__oxvarname->value." ".$oSel->oxselectlist__oxtitle->value);
                $oArticle->oxarticles__oxvarname->setValue(trim($oArticle->oxarticles__oxvarname->value));
                $oArticle->save();
            }
        }
    }

    /**
     * Generate variants from selection lists
     *
     * @param oxArticleList $oArticles Article list
     */
    protected function _getValuePrice( $oValue, $dParentPrice)
    {
        $myConfig = $this->getConfig();
        $dPriceMod = 0;
        if ( $myConfig->getConfigParam( 'bl_perfLoadSelectLists' ) && $myConfig->getConfigParam( 'bl_perfUseSelectlistPrice' ) ) {
            if ($oValue->priceUnit == 'abs') {
                $dPriceMod = $oValue->price;
            } elseif ($oValue->priceUnit == '%') {
                $dPriceModPerc = abs($oValue->price)*$dParentPrice/100.0;
                if (($oValue->price) >= 0.0) {
                    $dPriceMod = $dPriceModPerc;
                } else {
                    $dPriceMod = -$dPriceModPerc;
                }
            }
        }
        return $dPriceMod;
    }

    /**
     * Saves article variant.
     *
     * @param string $soxId
     * @param array  $aParams
     *
     * @return null
     */
    public function craeteNewVariant($sParentId = null, $aParams = null)
    {
        $myConfig  = $this->getConfig();

        // checkbox handling
        if ( !isset( $aParams['oxarticles__oxactive']))
            $aParams['oxarticles__oxactive'] = 0;

            // shopid
            $sShopID = oxSession::getVar( "actshop");
            $aParams['oxarticles__oxshopid'] = $sShopID;

        // varianthandling
        $aParams['oxarticles__oxparentid'] = $sParentId;

        $oArticle = oxNew( "oxarticle");
        $oArticle->assign( $aParams);

            //echo $aParams['oxarticles__oxartnum']."---";
            $oArticle->save();

        return $oArticle->getId();
    }

}
