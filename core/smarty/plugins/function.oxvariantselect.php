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
 * @copyright (C) OXID eSales AG 2003-2009
 * @version OXID eShop CE
 * $Id: function.oxgetseourl.php 16303 2009-02-05 10:23:41Z rimvydas.paskevicius $
 */


define("MDVARIANTS_SELECTION_JS", "

<script language=JavaScript><!--
  mdVariantSelectIds = Array();

  function showMdSelect(name)
  {
    if (document.getElementById(name)) {
      document.getElementById(mdVariantSelectIds[i]).style.display = 'inline';
    }
  }

  function hideAllMdSelect(level)
  {
    for (var i=level; i < mdVariantSelectIds.length; i++) {
      for (var j=0; j < mdVariantSelectIds[i].length; j++) {
      if (document.getElementById(mdVariantSelectIds[i][j])) {
        document.getElementById(mdVariantSelectIds[i]).style.display = 'none';
      }
    }
  }-->
</script>

");

/*
* Smarty function
* ----------------------------------------------------------------------
* Purpose: outputs HTML and JavaScript selectboxes for variant selection
* call example:
* [{oxvariantselect value=$product->getMdVariants() separator=" " artid=$product->getId() displayFunction="showVariant"}]
* ----------------------------------------------------------------------
*/
function smarty_function_oxvariantselect( $params, &$smarty )
{
    $sOutput = '';
    $oMdVariants = $params['value'];
    $sSeparator  = $params['separator'];
    $sCallMethod = $params['displayFunction'];
    //default selected art id
    $sArtId      = $params['artid'];

    if ($sArtId || !$oMdVariants->hasArticleId($sArtId)) {
        $sArtId = $oMdVariants->getArticleId();
    }

    $aSelectBoxes = array();

    if (count($oMdVariants->getMdSubvariants())) {
        $sOutput = MDVARIANTS_SELECTION_JS;
        $sOutput .= oxvariantselect_addSubvariants($oMdVariants->getMdSubvariants(), 0, $aSelectBoxes, $sSeparator, $sCallMethod, $sArtId);
        $sOutput .= oxvariantselect_formatJsArray($aSelectBoxes);
    }

    return $sOutput;
}

/**
 * Recursiovely adds selection box of for subvariants
 *
 * @param array[string]OxMdVariant $oMdVariants  Variant list
 * @param int                      $iLevel       Depth level
 * @param array[int][int]string    $aSelectBoxes Array of select boxes
 * @param string                   $sSeparator   Separator placed between select boxes
 * @param string                   $sCallMethod  Method to be called to display the variant
 * @param string                   $sArtId       Default selected article Id
 *
 * @return string
 */
function oxvariantselect_addSubvariants($oMdVariants, $iLevel, &$aSelectBoxes, $sSeparator, $sCallMethod, $sArtId)
{
    $sRes = '';
    $aOptions = array();
    if (count($oMdVariants)) {
        $blVisible = false;
        $sSelectedVariant = null;
        foreach($oMdVariants as $sKey => $oVariant) {
            $sSelectBoxName = "mdvariantselect_".(string)$iLevel."_".$oVariant->getId();
            $aSelectBoxes[$iLevel][] = $sSelectBoxName;
            $aOptions[$oVariant->getId()] = $oVariant->getName();
            if ($oVariant->hasArticleId($sArtId)) {
                $blVisible = true;
            }

            if ($oVariant->getArticleId() == $sArtId) {
                $sSelectedVariant = $oVariant->getId();
            }

        }

        $sRes .= oxvariantselect_formatSelectBox($sSelectBoxName, $aOptions, $iLevel, $blVisible, $sSelectedVariant) . "\n";
        $sRes .= $sSeparator;

        //add recursively
        foreach($oMdVariants as $oVariant) {
            $sRes .= oxvariantselect_addSubvariants($oVariant->getMdSubvariants(), $iLevel+1, &$aSelectBoxes, $sSeparator, $sCallMethod, $sArtId);
        }
    }

    return $sRes;
}

/**
 * Formats variant select box
 *
 * @param string              $sId       Select box id
 * @param array[string]string $aOptions  Select box options
 * @param int                 $iLevel    Level information (counted from 0)
 * @param bool                $blVisible Initial select list visibility
 * @param string              $sSelected Selected variant
 *
 * @return string
 */
function oxvariantselect_formatSelectBox($sId, $aOptions, $iLevel, $blVisible, $sSelected)
{
    $sStyle = $blVisible?"inline":"none";
    $sRes = "<select class='md_select_variant' id='$sId' style='display:$sStyle'>\n";
    foreach ($aOptions as $sVal => $sName) {
        $sSelText = ($sVal === $sSelected)?" selected":"";
        $sRes .= " <option value='$sVal'$sSelText>$sName</option>\n";
    }
    $sRes .= "</select>\n";

    return $sRes;
}

function oxvariantselect_formatJsArray($aSelectBoxes)
{
    $sRes = "<script language=JavaScript><!--\n";
    $iLevelCount = count($aSelectBoxes);
    $sRes .= "mdVariantSelectIds = Array($iLevelCount);\n";
    foreach ($aSelectBoxes as $iLevel => $aSelects) {
        $sSelectCount = count($aSelects);
        $sRes .= " mdVariantSelectIds[$iLevel] = Array($sSelectCount)\n";
        foreach ($aSelects as $iSelect => $sSelect) {
            $sRes .= " mdVariantSelectIds[$iLevel][$iSelect] = '$sSelect'\n";
        }
    }

    $sRes .= "--></script>";

    return $sRes;
}