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
 * $Id: modifier.oxaddparams.php 17696 2009-03-31 12:38:49Z vilma $
 */

/*
* Smarty function
* -------------------------------------------------------------
* Purpose: add additional parameters to SEO url
* add |oxaddparams:"...." to link
* -------------------------------------------------------------
*/
function smarty_modifier_oxaddparams( $sUrl, $sDynParams )
{
    // removing empty parameters
    $sDynParams = $sDynParams?preg_replace( array( '/([\?&])[\w;]=&/', '/[\w;]+=$/', '/^[\w]+=$/', '/&(?!amp;)/' ), array( '{1}', '', '', '&amp;' ), $sDynParams ):false;
    $sDynParams = $sDynParams?preg_replace( array( '/^\?/', '/^\&(amp;)?$/' ), '', $sDynParams ):false;
    if ( $sDynParams ) {
        $sUrl .= ( ( strpos( $sUrl, '?' ) !== false ) ? "&amp;":"?" ) . $sDynParams;
    }
    /* not used yet, not required (getSimplifyUriParams is also commented out)
    if (oxUtils::getInstance()->seoIsActive()) {
        $sUrl = oxSeoEncoder::getInstance()->getSimplifyUriParams($sUrl);
    }
    */
    return $sUrl;
}
