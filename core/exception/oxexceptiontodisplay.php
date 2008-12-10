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
 * $Id: oxexceptiontodisplay.php, v 1.0 2007.8.9 17.47.16 developer_name Exp
 */

/**
 * simplified Exception classes for simply displaying errors
 * saves resources when exception functionality is not needed
 */
class oxExceptionToDisplay implements oxDisplayErrorInterface
{

    //language const of a Message
    private $sMessage;

    private $blDebug = false;
    //stack trace as a string
    private $sStackTrace;
    //additional values
    private $aValues;
    //typeof the exception (old class name)
    private $sType;

    public function setStackTrace($sStackTrace)
    {
        $this->sStackTrace = $sStackTrace;
    }

    public function getStackTrace()
    {
        return $this->sStackTrace;
    }

    public function setValues($aValues)
    {
        $this->aValues = $aValues;
    }

    public function addValue($sName,$sValue)
    {
        $this->aValues[$sName]=$sValue;
    }

    public function setExceptionType($sType)
    {
        $this->sType = $sType;
    }

    public function getErrorClassType()
    {
        return $this->sType;
    }

    public function getValue($sName)
    {
        return $this->aValues[$sName];
    }

    public function setDebug($bl)
    {
        $this->blDebug = $bl;
    }

    public function setMessage($sMessage)
    {
        $this->sMessage = $sMessage;
    }

    public function getOxMessage()
    {
        return $this->blDebug ? $this : oxLang::getInstance()->translateString($this->sMessage);
    }

   public function __toString()
   {
       $sRes = $this->getErrorClassType() . " (time: ". date('Y-m-d H:i:s') ."): {$this->message} \n Stack Trace: {$this->getStackTrace()}\n";
       foreach($this->aValues as $key => $value) {
           $sRes .= $key. " => ". $value . "\n";
       }
       return $sRes;
   }
}
