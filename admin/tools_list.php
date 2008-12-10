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
 * @copyright � OXID eSales AG 2003-2008
 * $Id: tools_list.php 13619 2008-10-24 09:40:23Z sarunas $
 */

/**
 * Admin systeminfo manager.
 * Returns template, that arranges two other templates ("tools_list.tpl"
 * and "tools_main.tpl") to frame.
 * @package admin
 */
class Tools_list extends oxAdminList
{
    /**
     * Current class template name.
     * @var string
     */
    protected $_sThisTemplate = 'tools_list.tpl';

    /**
     * Method performs user passed SQL query
     *
     * @return null
     */
    public function performsql()
    {
        $oAuthUser = oxUser::getAdminUser();
        if ( $oAuthUser->oxuser__oxrights->value != "malladmin" )
            return;

        $sUpdateSQL = oxConfig::getParameter("updatesql");
        $sUpdateSQLFile = $this->_processFiles();

        if ( $sUpdateSQLFile && strlen( $sUpdateSQLFile)>0) {
            if ( isset( $sUpdateSQL) && strlen( $sUpdateSQL))
                $sUpdateSQL .= ";\r\n".$sUpdateSQLFile;
            else
                $sUpdateSQL  = $sUpdateSQLFile;
        }

        $sUpdateSQL = trim(stripslashes($sUpdateSQL));
        $iLen = strlen($sUpdateSQL);
        if ( $this->_prepareSQL(trim(stripslashes($sUpdateSQL)), $iLen)) {
            $aQueries = $this->aSQLs;
            $this->_aViewData["aQueries"] = array();
            $aPassedQueries  = array();
            $aQAffectedRows  = array();
            $aQErrorMessages = array();
            $aQErrorNumbers  = array();

            if ( count( $aQueries) > 0) {
                $oDB = oxDb::getDb();
                $iQueriesCounter = 0;
                for ($i=0;$i<count( $aQueries);$i++) {
                    $sUpdateSQL = $aQueries[$i];
                    $sUpdateSQL = trim( $sUpdateSQL);

                    if ( strlen( $sUpdateSQL)>0) {
                        $aPassedQueries[$iQueriesCounter] = nl2br( htmlentities($sUpdateSQL));
                        if ( strlen( $aPassedQueries[$iQueriesCounter]) > 200)
                            $aPassedQueries[$iQueriesCounter] = substr( $aPassedQueries[$iQueriesCounter], 0, 200)."...";

                        while ( $sUpdateSQL[ strlen( $sUpdateSQL)-1] == ";") {
                            $sUpdateSQL = substr( $sUpdateSQL, 0, ( strlen( $sUpdateSQL)-1));
                        }

                        $oDB->execute( $sUpdateSQL);

                        $aQAffectedRows [$iQueriesCounter] = null;
                        $aQErrorMessages[$iQueriesCounter] = null;
                        $aQErrorNumbers [$iQueriesCounter] = null;
                        if ( $iAffectedRows = $oDB->affected_Rows() !== false) {
                            $aQAffectedRows[$iQueriesCounter] =  $iAffectedRows;
                        } else {
                            $aQErrorMessages[$iQueriesCounter] = htmlentities($oDB->errorMsg());
                            $aQErrorNumbers[$iQueriesCounter]  = htmlentities($oDB->errorNo());
                        }
                        $iQueriesCounter++;
                    }
                }
            }
            $this->_aViewData["aQueries"]       = $aPassedQueries;
            $this->_aViewData["aAffectedRows"]  = $aQAffectedRows;
            $this->_aViewData["aErrorMessages"] = $aQErrorMessages;
            $this->_aViewData["aErrorNumbers"]  = $aQErrorNumbers;
        }
        $this->_iDefEdit = 1;
    }

    /**
     *
     * @return mixed
     */
    protected function _processFiles()
    {
        if ( isset( $_FILES['myfile']['name'])) {
            // process all files
            while (list($key, $value) = each($_FILES['myfile']['name'])) {
                $aSource = $_FILES['myfile']['tmp_name'];
                $sSource = $aSource[$key];
                $aFiletype = explode( "@", $key);
                $key    = $aFiletype[1];
                $sType  = $aFiletype[0];
                $value = strtolower( $value);
                // add type to name
                $aFilename = explode( ".", $value);

                //hack?

                $aBadFiles = array("php", "jsp", "cgi", "cmf", "exe");

                if (in_array($aFilename[1], $aBadFiles))
                    die("We don't play this game, go away");

                //reading SQL dump file
                if ( $sSource) {
                    $rHandle   = fopen( $sSource, "r");
                    $sContents = fread( $rHandle, filesize ( $sSource));
                    fclose( $rHandle);
                    //reading only one SQL dump file
                    return $sContents;
                }
                return;
            }
        }
        return;
    }

    /**
     * Performs data import.
     *
     * @return null
     */
    public function doimport()
    {
        $myConfig = $this->getConfig();
        $sFilepath = oxConfig::getParameter( "filepath");
        oxSession::setVar( "filepath", $sFilepath);

        $iStart = oxConfig::getParameter( "iStart");
        if ( !isset( $iStart))
            $iStart = 0;

        $oImex = oxNew( "oximex" );

        if ( !$oImex->import( $iStart, $myConfig->getConfigParam( 'iImportNrofLines' ), $sFilepath)) {
            oxSession::deleteVar( "imex_fnc");
            oxSession::deleteVar( "rStart");
            oxSession::deleteVar( "rparam");
            oxSession::deleteVar( "filepath");
            oxSession::deleteVar( "atables");
            oxSession::setVar( "finished", 2);
        } else {
             // continue
            $iStart += $myConfig->getConfigParam( 'iImportNrofLines' );
            oxSession::setVar( "rStart", $iStart);
            oxSession::setVar( "imex_fnc", "doimport");
        }
    }

    /**
     * Method parses givent SQL queries string and returns array on success
     *
     * @param string  $sSQL    SQL queries
     * @param integer $iSQLlen query lenght
     *
     * @return mixed
     */
    protected function _prepareSQL($sSQL, $iSQLlen)
    {
        $sChar = "";
        $sStrStart = "";
        $blString  = false;

        //removing "mysqldump" application comments
        while ( preg_match("/^\-\-.*\n/", $sSQL))
            $sSQL = trim(preg_replace("/^\-\-.*\n/", "", $sSQL));
        while ( preg_match("/\n\-\-.*\n/", $sSQL))
            $sSQL = trim(preg_replace("/\n\-\-.*\n/", "\n", $sSQL));

        for ( $iPos = 0; $iPos < $iSQLlen; ++$iPos) {
            $sChar = $sSQL[$iPos];
            if ( $blString) {
                while ( true) {
                    $iPos = strpos( $sSQL, $sStrStart, $iPos);
                    //we are at the end of string ?
                    if (!$iPos) {
                        $this->aSQLs[] = $sSQL;
                        return true;
                    } elseif ( $sStrStart == '`' || $sSQL[$iPos-1] != '\\') { //found some query separators
                        $blString  = false;
                        $sStrStart = "";
                        break;
                    } else {
                        $iNext = 2;
                        $blBackslash = false;
                        while ( $iPos-$iNext > 0 && $sSQL[$iPos-$iNext] == '\\') {
                            $blBackslash = !$blBackslash;
                            $iNext++;
                        }
                        if ( $blBackslash) {
                            $blString  = false;
                            $sStrStart = "";
                            break;
                        } else
                            $iPos++;
                    }
                }
            } elseif ( $sChar == ";") { // delimiter found, appending query array
                $this->aSQLs[] = substr( $sSQL, 0, $iPos);
                $sSQL = ltrim( substr( $sSQL, min( $iPos + 1, $iSQLlen)));
                $iSQLlen = strlen( $sSQL);
                if ( $iSQLlen)
                    $iPos      = -1;
                else
                    return true;
            } elseif ( ( $sChar == '"') || ( $sChar == '\'') || ( $sChar == '`')) {
                $blString  = true;
                $sStrStart = $sChar;
            } elseif ( $sChar == "#" || ( $sChar == ' ' && $iPos > 1 && $sSQL[$iPos-2] . $sSQL[$iPos-1] == '--')) {  // removing # commented query code
                $iCommStart = (( $sSQL[$iPos] == "#") ? $iPos : $iPos-2);
                $iCommEnd = (strpos(' ' . $sSQL, "\012", $iPos+2))
                           ? strpos(' ' . $sSQL, "\012", $iPos+2)
                           : strpos(' ' . $sSQL, "\015", $iPos+2);
                if ( !$iCommEnd) {
                    if ( $iCommStart > 0)
                        $this->aSQLs[] = trim(substr($sSQL, 0, $iCommStart));
                    return true;
                } else {
                    $sSQL = substr($sSQL, 0, $iCommStart).ltrim(substr($sSQL, $iCommEnd));
                    $iSQLlen = strlen($sSQL);
                    $iPos--;
                }
            } elseif ( 32358 < 32270 && ($sChar == '!' && $iPos > 1  && $sSQL[$iPos-2] . $sSQL[$iPos-1] == '/*'))  // removing comments like /**/
                $sSQL[$iPos] = ' ';
        }

        if (!empty($sSQL) && ereg("[^[:space:]]+", $sSQL)) {
            $this->aSQLs[] = $sSQL;
        }
        return true;
    }
}
