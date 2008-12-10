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
 * @package core
 * @copyright © OXID eSales AG 2003-2008
 * $Id: oxcss.php 13619 2008-10-24 09:40:23Z sarunas $
 */

/**
 *
 */
class oxcss
{
    protected $_aCss = array();

    /**
     *
     * @param string $sFileName file name
     * @param bool   $blAppend
     *
     * @return null
     */
    public function loadFromFile($sFileName, $blAppend = false)
    {
        $sCSS = file_get_contents($sFileName);

        $this->loadFromString($sCSS, $blAppend);
    }

    /**
     *
     * @param string $sCSS
     * @param bool   $blAppend
     *
     * @return null
     */
    public function loadFromString($sCSS,$blAppend = false)
    {
        //remove all coments
        $sCSS = ereg_replace('/\\*([^/\\*]+)\\*/', ' ', $sCSS);

        //remove all duplicated spaces, tabs and line breaks
        $sCSS = ereg_replace (" +", " ", $sCSS);
        $sCSS = ereg_replace("[\r\t\n]", "", $sCSS);

        $aAllClasses = explode("}", $sCSS);

        if ( !$blAppend && !is_array($this->_aCss) ) {
            $this->_aCss = array();
        }

        foreach ($aAllClasses as $sClass) {
            $aClass = split(",", substr( $sClass, 0, strpos($sClass, "{")));
            $aAttributes  = split(";", substr( $sClass, strpos($sClass, "{")+1, strlen($sClass)));

            foreach ( $aClass as $sClassName) {
                $sClassName = trim($sClassName);

                foreach ( $aAttributes as $sAttribute) {
                    $sAtributeName =  trim(substr( $sAttribute, 0, strpos($sAttribute, ":")));
                    $sAtributeValue =  trim(substr( $sAttribute, strpos($sAttribute, ":")+1, strlen($sAttribute)));

                    if ($sAtributeName && $sClassName) {
                        $this->_aCss[$sClassName][$sAtributeName]=$sAtributeValue;
                    }
                }
            }
        }
    }

    /**
     *
     * @param string $sClassName class name
     *
     * @return mixed
     */
    public function getClass($sClassName)
    {
        if (array_key_exists($sClassName, $this->_aCss)) {
            return $this->_aCss[$sClassName];
        }
        return false;
    }

    /**
     *
     * @param string $sClassName
     * @param array  $aAttributes
     *
     * @return null
     */
    public function setClass($sClassName, $aAttributes)
    {
        $this->_aCss[$sClassName]=$aAttributes;
    }

    /**
     *
     * @return string
     */
    public function generateFile()
    {
        $out = "";

        foreach ($this->_aCss as $class => $attributes) {
            $out .= "\n\n".$class."{";

            foreach ($attributes as $attribute=>$value) {
                $out .= "\n  ".$attribute.": ".$value.";";
            }

            $out .= "\n}";

        }

        return $out;
    }
}
