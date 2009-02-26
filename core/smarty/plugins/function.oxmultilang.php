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
 * $Id: function.oxmultilang.php 16303 2009-02-05 10:23:41Z rimvydas.paskevicius $
 */

/*
* Smarty function
* -------------------------------------------------------------
* Purpose: Output multilang string
* add [{ oxmultilang ident="..." }] where you want to display content
* -------------------------------------------------------------
*/
function smarty_function_oxmultilang( $params, &$smarty )
{
    $sIdent  = isset( $params['ident'] ) ? $params['ident'] : 'IDENT MISSING';
    $iLang   = null;
    $blAdmin = isAdmin();

    if ( $blAdmin ) {
        $iLang = oxLang::getInstance()->getTplLanguage();
        if ( !isset( $iLang ) ) {
            $iLang = 0;
        }
    }

    try {
        $sTranslation = oxLang::getInstance()->translateString( $sIdent, $iLang, $blAdmin );
    } catch ( oxLanguageException $oEx ) {
        // is thrown in debug mode and has to be caught here, as smarty hangs otherwise!
    }

    if ( $blAdmin && $sTranslation == $sIdent && !isset( $params['noerror'] ) ) {
    	$sTranslation = '<b>ERROR : Translation for '.$sIdent.' not found!</b>';
    }

    return $sTranslation;
}
