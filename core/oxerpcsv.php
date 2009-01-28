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
 * @copyright © OXID eSales AG 2003-2009
 * $Id: oxerpcsv.php 16000 2009-01-28 15:27:22Z rimvydas.paskevicius $
 */


$aNonDemoModules = array();

require_once( 'oxerpbase.php');

/**
 * Class handeling csv import and export
 *
 */
class oxErpCsv extends oxERPBase {

    public static $EXCEPTION_FILE_EXIST = "File does allready exist!";
    public static $EXCEPTION_FAIL_CREATE_FILE = "Unable to create file!";
    public static $EXCEPTION_FAIL_WRITE_FILE = "Failed writing data to file!";

    public static $ERROR_DURING_IMPORT = "ERROR during import";
    public static $ERROR_WRONG_VERSION = "ERROR: File Version mismatch or no Version information!";
    public static $ERROR_WRONG_FILE = "ERROR: no file";
    public static $IMPORT_DONE = "IMPORT DONE";

    protected $_aSupportedVersions = array("0.1", "1.0", "1.1", "2.0");
    protected $_aCsv2BaseVersionsMap = array("0.1" => "1", "1.0" => "1", "1.1"=>"1.1", "2.0" => "2");

    protected $_sErpVersion	= "1.0";

    //version of the file which is imported right now
    protected $_sCurrVersion = "";

    protected $_currFileId = "";

    protected $_sCurrImportType;
    protected $_blVersionSkip = false;

    protected $_aObjects = array	(
                                'A' => 'article',
                                'L' => 'article', //delete article, X is set in getimporttype (compatibility to 0.1)
                                'K' => 'category',
                                'H' => 'vendor',
                                'C' => 'crossselling',
                                'Z' => 'accessoire',
                                'T' => 'article2category',
                                'I' => 'article2action',
                                'S' => 'orderstatus',
                                'P' => 'scaleprice',
                                'U' => 'user',
                                'O' => 'order',
                                'R' => 'orderarticle',
                                'E' => 'articlestock',
                                'N' => 'country',
                                'D' => 'article2vendor',
                                'M' => 'mainarticle2categroy',
                                'Y' => 'artextends',
                            );


    protected $_aNewCommands = array(

    );

    protected $_aData = array();

    protected $_iRetryRows = 0;

    protected $_sReturn;

    protected $_sPath;

    //all export values are written in there and only in the end after successful export , buffer is written to file
    protected $_sBuffer;
    //number of records currently in the buffer
    protected $_iBufferRecCounter = 0;

    var $_aImportedActions2Article = array();
    var $_aImportedObject2Category = array();
    var $_aImportedAccessoire2Article = array();

    public function setFileId($sId)
    {
        $this->_currFileId = $sId;
    }

    /**
     * oxERPBase::loadSessionData()
     * load session for CSV interface, special handeling for V 0.1
     * @param string $sSessionID
     **/
    public function loadSessionData( $sSessionID )
    {
        $_COOKIE = array('admin_sid' => $sSessionID);
        // start session
        $myConfig = oxConfig::getInstance();
        $myConfig->setConfigParam( 'blAdmin', 1 );
        $myConfig->setAdminMode( true );
        $mySession = oxSession::getInstance();

        // change session if needed
        if ($sSessionID != session_id()) {
            if (session_id()) {
                session_write_close();
            }
            session_id($sSessionID);
            session_start();
        }

        $aSessionData = $_SESSION; // adodb_unserialize(ADODB_Session::read($sSessionID));

        if(!isset($aSessionData['auth']) || !$aSessionData['auth']) {
            throw new Exception( "ERROR: Session ID not valid!");
        }

        $this->_iLanguage   = $aSessionData['lang'];

        $this->_sUserID     = $aSessionData['auth'];

        oxConfig::getInstance()->setShopId($aSessionData['actshop']);
        // $mySession->setVar( "actshop", $aSessionData['actshop']);
        $this->_blInit      = true;

  /*      //workaround for method to work with admin gui (in the same way old version worked)
        $myConfig = oxConfig::getInstance();
        $myConfig->oUser = oxNew('oxUser', 'core');
        $myConfig->oUser->load($this->_sUserID);
*/
    }

    /**
     * Exports the given order into a single txt file named "ordernumber.txt"
     * V0.1
     *
     * @param oxOrder $oOrder ???
     *
     * @return bool
     */
    public function ERPWriteOrderFile( $oOrder)
    {
        $mySession = oxSession::getInstance();

        //use the current user
        try{
             $this->loadSessionData($mySession->getId());
        }catch(Exception $ex){
            return false;
        }
        $this->checkVersion();
        return $this->_exportFullOrder($oOrder);
    }

    /**
     * Main import method, whole import of all types via a given csv file is done here
     *
     * @param string $sPath full path of the CSV file.
     *
     * @return string
     *
     */
    public function DoImport($sPath = null, $sUserName = null, $sUserPassword = null, $sShopId = null, $sShopLanguage = null )
    {



        $myConfig = oxConfig::getInstance();
        $mySession = oxSession::getInstance();

        $this->_sReturn = "";
        $iMaxLineLength = 8192; //TODO change
        $blVersionLine = false;

        if(!$sPath){
            $myConfig = oxConfig::getInstance();
            $this->_sPath = $myConfig->aERPInfo['sPath'];
        } else {
            $this->_sPath = $sPath;
        }

        try{
            if (!$sUserName || !$sUserPassword) {
                //take it from session
                $this->loadSessionData($mySession->getId());
            } else {
                //init with given data
                $this->init($sUserName, $sUserPassword, $sShopId, $sShopLanguage);
            }
        }catch(Exception $ex){
            return self::$ERROR_USER_NO_RIGHTS;
        }


        $file = @fopen($this->_sPath,"r");

        if(isset($file) && $file){
            $iRow = 0;
            $aRow = array();
            while ( ($aRow = fgetcsv( $file, $iMaxLineLength, ";",'"')) !== FALSE) {
                //special handeling for first version row
                if($aRow[0] == "V" && $this->_checkAndSetVersion($aRow[1])){
                    $blVersionLine = true;
                } elseif($blVersionLine) {
                    $this->_aData[] = $aRow;
                } else {
                    //no or wrong version information
                    fclose($file);
                    return  self::$ERROR_WRONG_VERSION;
                }
            }
            try {
                $this->Import();
            } catch (Exception $ex) {
                $this->_sReturn .= self::$ERROR_DURING_IMPORT.PHP_EOL;
            }

        }else {
            return self::$ERROR_WRONG_FILE;
        }
        fclose($file);

        if(strlen($this->_sReturn)==0){
            $this->_sReturn .= self::$IMPORT_DONE;
        }
        return $this->_sReturn;
    }

    /**
     * Retruns true if the given version is compatible with the current version ($_sErpVersion)
     *
     * @param string $sVersion
     *
     * @return bool
     */
    protected function _checkAndSetVersion($sVersion)
    {

        if (!in_array($sVersion, $this->_aSupportedVersions)) {
            return false;
        }

        $this->_sCurrVersion = $sVersion;

        if (oxERPBase::getUsedDbFieldsVersion() != $this->_aCsv2BaseVersionsMap[$sVersion]) {
            oxERPBase::setVersion($this->_aCsv2BaseVersionsMap[$sVersion]);
        }

        return true;
    }

    /**
     * parses and replaces special chars
     *
     * @param string $sText input text
     * @param bool $blMode 	true = Text2CSV, false = CSV2Text
     *
     * @return string
     */
    protected function _csvTextConvert($sText, $blMode)
    {
        $aSearch  = array(chr(13), chr(10), '\'',    '"');
        $aReplace = array('&#13;', '&#10;', '&#39;', '&#34;');

        if( $blMode)
            $sText = str_replace( $aSearch, $aReplace ,$sText);
        else
            $sText = str_replace( $aReplace, $aSearch ,$sText);

        return $sText;
    }

    protected function checkVersion()
    {
        if (oxERPBase::getUsedDbFieldsVersion() != $this->_aCsv2BaseVersionsMap[$this->_sErpVersion]) {
            // use first version as default
            $aArr = array_flip($this->_aCsv2BaseVersionsMap);
            $this->_sErpVersion = $aArr[oxERPBase::getUsedDbFieldsVersion()];
        }
    }

    protected function _beforeExport($sType)
    {
        $this->checkVersion();
        if ((oxERPBase::getUsedDbFieldsVersion() == '1') && ($sType == 'oldOrder' || $sType == 'oldOrderArticle')) {
            //sepcial handeling for V0.1 export
            return ;
        }
        if (!$this->_blVersionSkip) {
            $this->_addVersionTag();
        }
    }
    protected function _afterExport($sType)
    {
    }

    public function Import()
    {
        $this->_beforeImport();

        do{
            while( $this->_importOne());
        }
        while ( !$this->_afterImport() );

    }

    protected function _beforeImport()
    {
        if(!$this->_iRetryRows){
            //convert all text
            foreach ($this->_aData as $key => $value) {
                $this->_aData[$key] = $this->_csvTextConvert($value, false);
            }
        }

    }
    protected function _afterImport()
    {
        //check if there have been no errors or failures
        $aStatistics = $this->getStatistics();
        $iRetryRows  = 0;

        foreach ($aStatistics as $key => $value) {
            if($value['r'] == false){
               $iRetryRows ++;
               $this->_sReturn.=  "File[".$this->_sPath."] - dataset number: $key - Error: ".$value['m']." ---<br> ".PHP_EOL;
            }
        }

        if($iRetryRows != $this->_iRetryRows && $iRetryRows>0){
            $this->_resetIdx();
            $this->_iRetryRows  = $iRetryRows;
            $this->_sReturn     = '';

            return false;
        }

        return true;
    }
    public function getImportData()
    {
        return $this->_aData[$this->_iIdx];
    }

    protected function _modifyData($aData, $oType)
    {
        //for deletion mode
        if ($this->_getImportMode($aData) == oxERPBase::$MODE_DELETE) {
            return $aData[1]; //the oxid is always in the first entry
        }

        //additions for V0.1 support
        if($this->_sCurrVersion == "0.1") {
            if ($oType->getFunctionSuffix() == "Article") {
                //remove the two fields OXRRVIEW and OXRRBUY, which are only in version 0.1 in article import not supported anyhow
                array_splice($aData, 104, 2,array());

            }

            if ($oType->getFunctionSuffix() == "Category") {
                //remove the two fields OXRRVIEW and OXRRBUY, which are only in version 0.1 in article import not supported anyhow
                array_splice($aData, 19, 2,array());
            }

        }

        array_shift ($aData);
        return $this->_mapFields($aData, $oType);
    }

    protected function _getImportType(& $aData)
    {
        $sType = $aData[0];
        if (strpos($sType, "X")===0)
        {
            $sType = substr($sType, 1);
        }

        //support of old V0.1
        if ($sType == "L" && $this->_sCurrVersion == "0.1") {
            $aData[0] = "XA";
        }

        if(strlen($sType) != 1 || !array_key_exists($sType, $this->_aObjects)){
            throw new Exception("Error unknown command: ".$sType);
        } else {
            return $this->_aObjects[$sType];
        }
    }

    protected function _getImportMode($aData)
    {
        if (strpos($aData[0], "X")===0)
        {
            return oxERPBase::$MODE_DELETE;
        } else {
            return oxERPBase::$MODE_IMPORT;
        }
    }

    /**
     * makes a export of a order and all its articles into a single file
     * method exists to be compatible to version 0.1
     *
     * @return bool
     *
     */
    protected function _exportFullOrder($oOrder)
    {
        $myConfig = oxConfig::getInstance();
        $this->_blVersionSkip = true;
        $sWhere = "where oxid = '" . $oOrder->getId() . "'";
        if (oxERPBase::getUsedDbFieldsVersion() == '1') {
            $old = $this->_sErpVersion;
            $this->_sErpVersion = "0.1"; //old style export, is 100% compatible
            $this->_addVersionTag();
            $this->exportType('oldOrder', $sWhere);
            $this->_sErpVersion = $old;
        } else {
            $this->_addVersionTag();
            $this->exportType('order', $sWhere);
        }

        //now the order is in _aResults

            if ($this->_iBufferRecCounter > 1) {
                //add additional fields only if there was at least one order exported (and not only the version line)

            //its neccessary to add 3 custom fields which are only part of Export V 0.1 - patch country and add iso3
            $aAddFields = array();
            $aAddFields[] = $this->_csvTextConvert(oxDb::getDb()->GetOne("select oxisoalpha3 from oxcountry where oxid = '".$oOrder->oUser->oxuser__oxcountryid->value."'"), true);
            // add payment description
            $aAddFields[] = $this->_csvTextConvert(oxDb::getDb()->GetOne("select oxdesc from oxpayments where oxid = '".$oOrder->oxorder__oxpaymenttype->value."'"), true);

            // load payment
            $oPayment = oxNew( "oxuserpayment", "core");
            $oPayment->Load( $oOrder->oxorder__oxpaymentid->value);
            if( isset( $oPayment->oxuserpayments__oxvalue->value) && $oPayment->oxuserpayments__oxvalue->value)
            {  	$oPayMethod = oxNew( "oxpayment", "core");
                $oPayMethod->Load( $oPayment->oxuserpayments__oxpaymentsid->value);
                $oOrder->aDynValues = AssignValuesFromText( $oPayment->oxuserpayments__oxvalue->value);

                // add user payment info
                $sUserPayment = "";
                $blSep = false;
                foreach( $oOrder->aDynValues as $oEntry)
                {	if( $blSep)
                        $sUserPayment .= "|";
                    $sUserPayment .= $oEntry->value;
                    $blSep = true;
                }
                $aAddFields[] = $this->_csvTextConvert($sUserPayment, true);
            }else{
                $aAddFields[] = "";
            }

            $this->_appendDsToBuffer($aAddFields);
        }

        //now add the articles
        $sWhere = "where oxorderid = '" . $oOrder->getId() . "'";

        if (oxERPBase::getUsedDbFieldsVersion() == '1') {
            $this->exportType('oldOrderArticle', $sWhere);
        } else {
            $this->exportType('orderarticle', $sWhere);
        }

        $this->_blVersionSkip = false;
        try{
            $file = $this->_createFile("", $oOrder->oxorder__oxordernr->value, $myConfig->aERPInfo['sExpPath']);
            $this->_flushBuffer($file);
        }catch(Exception $ex){
            return false;
        }

        return true;
    }

    /**
     * due to compatibility reasons, the field list of V0.1
     *
     * @return array
     */
    private function getOldOrderArticleFieldList()
    {
        $aFieldList = array(
            'OXID'          => 'OXID',
            'OXORDERID'     => 'OXORDERID',
            'OXAMOUNT'      => 'OXAMOUNT',
            'OXARTID'       => 'OXARTID',
            'OXARTNUM'      => 'OXARTNUM',
            'OXTITLE'       => 'OXTITLE',
            'OXSELVARIANT'  => 'OXSELVARIANT',
            'OXNETPRICE'    => 'OXNETPRICE',
            'OXBRUTPRICE'   => 'OXBRUTPRICE',
            'OXVAT'         => 'OXVAT',
            'OXPERSPARAM'   => 'OXPERSPARAM',
            'OXPRICE'       => 'OXPRICE',
            'OXBPRICE'      => 'OXBPRICE',
            'OXTPRICE'      => 'OXTPRICE',
            'OXWRAPID'      => 'OXWRAPID',
            'OXSTOCK'       =>  'OXSTOCK',
            'OXORDERSHOPID' => 'OXORDERSHOPID',
            'OXTOTALVAT'    => 'OXTOTALVAT'
        );

        return $aFieldList;
    }

    /**
     * due to compatibility reasons, the field list of V0.1
     *
     * @return array
     */
    private function getOldOrderFielsList()
    {
         $aFieldList = array(
            'OXID'		     => 'OXID',
            'OXSHOPID'		 => 'OXSHOPID',
            'OXUSERID'		 => 'OXUSERID',
            'OXORDERDATE'	 => 'OXORDERDATE',
            'OXORDERNR'		 => 'OXORDERNR',
            'OXBILLCOMPANY'	 => 'OXBILLCOMPANY',
            'OXBILLEMAIL'	 => 'OXBILLEMAIL',
            'OXBILLFNAME'	 => 'OXBILLFNAME',
            'OXBILLLNAME'	 => 'OXBILLLNAME',
            'OXBILLSTREET'	 => 'OXBILLSTREET',
            'OXBILLSTREETNR' => 'OXBILLSTREETNR',
            'OXBILLADDINFO'	 => 'OXBILLADDINFO',
            'OXBILLUSTID'	 => 'OXBILLUSTID',
            'OXBILLCITY'	 => 'OXBILLCITY',
            'OXBILLCOUNTRY'	 => 'OXBILLCOUNTRY',
            'OXBILLZIP'		 => 'OXBILLZIP',
            'OXBILLFON'		 => 'OXBILLFON',
            'OXBILLFAX'		 => 'OXBILLFAX',
            'OXBILLSAL'		 => 'OXBILLSAL',
            'OXDELCOMPANY'	 => 'OXDELCOMPANY',
            'OXDELFNAME'	 => 'OXDELFNAME',
            'OXDELLNAME'	 => 'OXDELLNAME',
            'OXDELSTREET'	 => 'OXDELSTREET',
            'OXDELSTREETNR'	 => 'OXDELSTREETNR',
            'OXDELADDINFO'	 => 'OXDELADDINFO',
            'OXDELCITY'		 => 'OXDELCITY',
            'OXDELCOUNTRY'	 => 'OXDELCOUNTRY',
            'OXDELZIP'		 => 'OXDELZIP',
            'OXDELFON'		 => 'OXDELFON',
            'OXDELFAX'		 => 'OXDELFAX',
            'OXDELSAL'		 => 'OXDELSAL',
            'OXDELCOST'		 => 'OXDELCOST',
            'OXDELVAT'		 => 'OXDELVAT',
            'OXPAYCOST'		 => 'OXPAYCOST',
            'OXPAYVAT'		 => 'OXPAYVAT',
            'OXWRAPCOST'	 => 'OXWRAPCOST',
            'OXWRAPVAT'		 => 'OXWRAPVAT',
            'OXCARDID'		 => 'OXCARDID',
            'OXCARDTEXT'	 => 'OXCARDTEXT',
            'OXDISCOUNT'	 => 'OXDISCOUNT',
            'OXBILLNR'		 => 'OXBILLNR',
            'OXREMARK'		 => 'OXREMARK',
            'OXVOUCHERDISCOUNT'		 => 'OXVOUCHERDISCOUNT',
            'OXCURRENCY'	 => 'OXCURRENCY',
            'OXCURRATE'		 => 'OXCURRATE',
            'OXTRANSID'		 => 'OXTRANSID',
            'OXPAID'		 => 'OXPAID',
            'OXIP'		     => 'OXIP',
            'OXTRANSSTATUS'	 => 'OXTRANSSTATUS',
            'OXLANG'		 => 'OXLANG',
            'OXDELTYPE'		 => 'OXDELTYPE'
            );

            return $aFieldList;
    }

    /**
     * creates a file of the given type and a given id,
     * retruns a file handler
     * if files exists returns null
     *
     * @param string $sType
     * @param string  $sId
     * @param string path optional default: $myConfig->aERPInfo['sExpPath'] . ShopId
     *
     * @throws Exception
     *
     * @return file handler
     */
    protected function _createFile($sType, $sId, $sPath = null)
    {
        $myConfig = oxConfig::getInstance();
        if(strlen($sType)>0){
            $sType .= "_";
        }
        $sFileName = $sType.$sId.".txt";
        if(!$sPath){
            $sPath = $myConfig->aERPInfo['sExpPath'].$myConfig->getShopId();
        }
        $sFullPath = $sPath .  DIRECTORY_SEPARATOR . $sFileName;
        if(file_exists($sFullPath)){
            throw new Exception(self::$EXCEPTION_FILE_EXIST, 0);
        }else{
            $file = @fopen( $sFullPath , "w");
            if($file){
                return $file;
            }else{
                throw new Exception (self::$EXCEPTION_FAIL_CREATE_FILE, 0);
            }
        }
    }

    protected function _addVersionTag()
    {
        $aDs = array();
        $aDs[] = $this->_sErpVersion;
        $this->_writeDsToBuffer("V", $aDs);
    }

    /**
     * writes a given dataset to the internal buffer in CSV format
     * "value1";"value2"; ... CR LF
     *
     * @param array $aDs
     * @param string $sSp the seperator, default ";"
     */
    protected function _writeDsToBuffer($sTag, $aDs,  $sSep = ";")
    {
        if(is_array($aDs) && count($aDs)>0){
            $this->_sBuffer .= '"'. $sTag .'"';
            $this->_iBufferRecCounter ++;
            foreach ($aDs as $value) {
                $value = $this->_csvTextConvert($value, true);
                $this->_sBuffer .= $sSep;
                $this->_sBuffer .='"'.$value.'"';
            }
           $this->_sBuffer .="\r\n";
        }
    }

    /**
     * Appends the given data to the last Ds in buffer, therefore the last linebreak is removed, data added and then a new line break added again
     *
     * @param unknown_type $aDs
     * @param unknown_type $sSep
     */
    protected function _appendDsToBuffer($aDs, $sSep = ";")
    {
        //remove the last line break from fileBuffer to be able to add the three additional fields
        $this->_sBuffer = substr($this->_sBuffer, 0, strlen($this->_sBuffer)-2);
        foreach ($aDs as $value) {
            $value = $this->_csvTextConvert($value, true);
            $this->_sBuffer .= $sSep;
            $this->_sBuffer .='"'.$value.'"';
        }
        $this->_sBuffer .="\r\n";
    }

    /**
     * writes the content of $this->_sBuffer to the given file
     *
     * @param file $file
     *
     * @throws Exception
     *
     * @return null
     */
    protected function _flushBuffer($file)
    {
        if(strlen($this->_sBuffer)>0){
           $res = fputs($file, $this->_sBuffer);
           if(!$res){
               throw new Exception(self::$EXCEPTION_FAIL_WRITE_FILE, 0);
           }
        }
    }

    public function getBuffer()
    {
        return $this->_sBuffer;
    }


    protected  function _checkIDField( $sID)
    {
        if( !isset( $sID) || !$sID)
            throw new Exception("ERROR: Articlenumber/ID missing!");
        elseif( strlen( $sID) > 32)
            throw new Exception( "ERROR: Articlenumber/ID longer then allowed (32 chars max.)!");
    }

    /**
     * method overridden to allow olf Order and OrderArticle types
     *
     * @param string $sType
     *
     * @return object
     */
    protected function _getInstanceOfType( $sType)
    {
        //due to backward compatibility
        if($sType == 'oldOrder'){
            $oType = parent::_getInstanceOfType('order');
            $oType->setFieldList($this->getOldOrderFielsList());
            $oType->setFunctionSuffix('OldOrder');
        }elseif($sType == 'oldOrderArticle'){
            $oType = parent::_getInstanceOfType('orderarticle');
            $oType->setFieldList($this->getOldOrderArticleFieldList());
            $oType->setFunctionSuffix('OldOrderArticle');
        }elseif($sType == 'article2vendor'){
            $oType = parent::_getInstanceOfType('article');
            $oType->setFieldList(array("OXID", "OXVENDORID"));
        }elseif($sType == 'mainarticle2categroy') {
            $oType = parent::_getInstanceOfType('article2category');
            $oType->setFieldList(array("OXOBJECTID", "OXCATNID", "OXTIME"));
            $oType->setFunctionSuffix('mainarticle2category');
        }
        else{
            $oType = parent::_getInstanceOfType($sType);
        }

        return $oType;
    }


    /**
     * Maps numeric array to assoc. Array
     *
     * @param array $aData numeric indices
     * @return array assoc. indices
     */
    protected function _mapFields($aData, $oType)
    {   $aRet = array();

        $iIdx = 0;
        foreach( $oType->getFieldList() as $sField) {
            //additional fields are possible as V1.0 is extended and still compatible to V0.1
            //if( !isset( $aData[$iIdx]))
            //    throw new Exception( "Field mismatch, aData not OK!");

            $aRet[$sField] = $aData[$iIdx];
            $iIdx++;
        }

        return $aRet;
    }


    // --------------------------------------------------------------------------
    //
    // Export Handler
    // List of all methods that are supported
    //
    // --------------------------------------------------------------------------
    protected function _ExportArticle( $aRow)
    {
        $this->_writeDsToBuffer("A", $aRow);
        return true;
    }

    protected function _ExportAccessoire( $aRow)
    {
        $this->_writeDsToBuffer("Z", $aRow);
        return true;
    }

    protected function _ExportArticle2Action( $aRow){
        $this->_writeDsToBuffer("I", $aRow);
        return true;
    }

    protected function _ExportArticle2Category( $aRow)
    {

    }

    protected function _ExportCategory( $aRow)
    {
        $this->_writeDsToBuffer("K", $aRow);
        return true;
    }

    protected function _ExportCrossselling( $aRow)
    {
        $this->_writeDsToBuffer("C", $aRow);
        return true;
    }

    protected function _ExportScaleprice( $aRow)
    {
        $this->_writeDsToBuffer("P", $aRow);
        return true;

    }

    protected function _ExportOldOrder( $aRow)
    {
        $this->_writeDsToBuffer("O", $aRow);
        return true;
    }

    protected function _ExportOrder( $aRow)
    {
        $this->_writeDsToBuffer("O", $aRow);
        return true;
    }

    protected function _ExportOldOrderArticle( $aRow)
    {
        $this->_writeDsToBuffer("A", $aRow);
        return true;
    }

    protected function _ExportOrderArticle( $aRow)
    {
        $this->_writeDsToBuffer("R", $aRow);
        return true;
    }

    protected function _ExportUser( $aRow)
    {
        $this->_writeDsToBuffer("U", $aRow);
        return true;
    }

    protected function _ExportVendor( $aRow)
    {
        $this->_writeDsToBuffer("H", $aRow);
        return true;
    }

    protected function _ExportArticleStock( $aRow){
        $this->_writeDsToBuffer("O", $aRow);
        return true;
    }

    protected function _ExportCountry( $aRow)
    {
        $this->_writeDsToBuffer("N", $aRow);
        return true;
    }

    protected function _ExportArtextends( $aRow) {
        if (oxERPBase::getRequestedVersion() < 2) {
            return false;
        }
        $this->_writeDsToBuffer("Y", $aRow);
        return true;
    }

    // --------------------------------------------------------------------------
    //
    // Import Handler
    // One _Import* method needed for each object defined in /objects/ folder, all these objects  can be imported
    //
    // --------------------------------------------------------------------------




    protected function _ImportArticle( oxERPType & $oType, $aRow)
    {

        if($this->_sCurrVersion == "0.1")
        {
            $myConfig = oxConfig::getInstance();
            //to allow different shopid without consequences (ignored fields)
            $myConfig->setConfigParam('blMallCustomPrice', false);
        }


        if(isset($aRow['OXID'])){
            $this->_checkIDField($aRow['OXID']);
        }else{
            $this->_checkIDField($aRow['OXARTNUM']);
            $aRow['OXID'] = $aRow['OXARTNUM'];
        }

        $sResult = $this->_Save( $oType, $aRow, $this->_sCurrVersion == "0.1"); // V0.1 allowes the shopid to be set no matter which login
        return (boolean) $sResult;
    }

    protected function _ImportAccessoire( oxERPType & $oType, $aRow) {

        // deleting old relations before import in V0.1
        if ( $this->_sCurrVersion == "0.1" && !isset($this->_aImportedAccessoire2Article[$aRow['OXARTICLENID']] ) ) {
            $myConfig = oxConfig::getInstance();
            $sDeleteSQL = "delete from oxaccessoire2article where oxarticlenid = '{$aRow['OXARTICLENID']}'";
            oxDb::getDb()->Execute( $sDeleteSQL );
            $this->_aImportedAccessoire2Article[$aRow['OXARTICLENID']] = 1;
        }

        $sResult = $this->_Save( $oType, $aRow);
        return (boolean) $sResult;
    }

    protected function _DeleteAccessoire (oxERPType & $oType, $sId)
    {

        $oType->checkForDeletion($sId);
        return $oType->delete($sId);
    }

    protected function _ImportArticle2Action( oxERPType & $oType, $aRow)
    {

        if ( $this->_sCurrVersion == "0.1" && !isset( $this->_aImportedActions2Article[$aRow['OXARTID']] ) ) { //only in V0.1 and only once per import/article


            $myConfig = oxConfig::getInstance();
            $sDeleteSQL = "delete from oxactions2article where oxartid = '{$aRow['OXARTID']}'";
            oxDb::getDb()->Execute( $sDeleteSQL );
            $this->_aImportedActions2Article[$aRow['OXARTID']] = 1;
        }

        $sResult = $this->_Save( $oType, $aRow, $this->_sCurrVersion == "0.1");
        return (boolean) $sResult;
    }

    protected function _DeleteArticle2Action (oxERPType & $oType, $sId)
    {
        $oType->checkForDeletion($sId);
        return $oType->delete($sId);
    }

    protected function _ImportArticle2Category( oxERPType & $oType, $aRow)
    {

        // deleting old relations before import in V0.1
        if ( $this->_sCurrVersion == "0.1" && !isset( $this->_aImportedObject2Category[$aRow['OXOBJECTID']] ) ) {
            $myConfig = oxConfig::getInstance();
            $sDeleteSQL = "delete from oxobject2category where oxobjectid = '{$aRow['OXOBJECTID']}'";
            oxDb::getDb()->Execute( $sDeleteSQL );
            $this->_aImportedObject2Category[$aRow['OXOBJECTID']] = 1;
        }

        $sResult = $this->_Save( $oType, $aRow);
        return (boolean) $sResult;
    }

    protected function _ImportMainArticle2Category( oxERPType & $oType, $aRow)
    {
        $aRow['OXTIME'] = 0;

        $myConfig = oxConfig::getInstance();
        $sSql = "select OXID from oxobject2category where oxobjectid = '".$aRow['OXOBJECTID']."' and OXCATNID = '".$aRow['OXCATNID']."'";
        $aRow['OXID'] = oxDb::getDb()->GetOne($sSql);

        $sResult = $this->_Save( $oType, $aRow);

        if ((boolean) $sResult) {

            $sSql = "Update oxobject2category set oxtime = oxtime+10 where oxobjectid = '" . $aRow['OXOBJECTID'] ."' and oxcatnid != '". $aRow['OXCATNID'] ."' and oxshopid = '".$myConfig->getShopId()."'";
            oxDb::getDb()->Execute($sSql);

        }

        return (boolean) $sResult;
    }

    protected function _DeleteArticle2Category(oxERPType & $oType, $sId)
    {

        $oType->checkForDeletion($sId);
        return $oType->delete($sId);
    }

    protected function _ImportCategory( oxERPType & $oType, $aRow)
    {

        $sResult = $this->_Save( $oType, $aRow, $this->_sCurrVersion == "0.1");
        return (boolean) $sResult;
    }

    protected function _DeleteCategory( oxERPType & $oType, $sId)
    {

        $oCategory = $oType->getObjectForDeletion($sId);

        if( $oCategory->oxcategories__oxright->value != $oCategory->oxcategories__oxleft->value+1) {
              throw new Exception( self::$ERROR_DELETE_NO_EMPTY_CATEGORY);
        }

        return $oType->deleteObject($oCategory, $sId);

    }

    protected function _ImportCrossselling( oxERPType & $oType, $aRow)
    {


        // deleting old relations before import in V0.1
        if ( $this->_sCurrVersion == "0.1" && !isset($this->_aImportedObject2Article[$aRow['OXARTICLENID']] ) ) {
            $myConfig = oxConfig::getInstance();
            $sDeleteSQL = "delete from oxobject2article where oxarticlenid = '{$aRow['OXARTICLENID']}'";
            oxDb::getDb()->Execute( $sDeleteSQL );
            $this->aImportedObject2Article[$aRow['OXARTICLENID']] = 1;
        }

        $sResult = $this->_Save( $oType, $aRow);
        return (boolean) $sResult;
    }

    protected function _DeleteCrossselling(oxERPType & $oType, $sId)
    {

        $oType->checkForDeletion($sId);
        return $oType->delete($sId);
    }


    protected function _ImportScaleprice( oxERPType & $oType, $aRow)
    {

        $sResult = $this->_Save( $oType, $aRow, $this->_sCurrVersion == "0.1");
        return (boolean) $sResult;
    }

    protected function _DeleteScalePrice(oxERPType & $oType, $sId)
    {

        $oType->checkForDeletion($sId);

        return $oType->delete($sId);
    }

    protected function _ImportOrder( oxERPType & $oType, $aRow)
    {

        $sResult = $this->_Save( $oType, $aRow);
        return true; //MAFI a unavoidable hack as oxorder->update() does always return null !!! a hotfix is needed
        //return (boolean) $sResult;
    }

    protected function _ImportOrderArticle( oxERPType & $oType, $aRow)
    {

        $sResult = $this->_Save( $oType, $aRow);
        return (boolean) $sResult;
    }

    protected function _DeleteOrderArticle( oxERPType & $oType, $sId)
    {

        $oOrderArticle = $oType->getObjectForDeletion($sId);

        return $oType->deleteObject($oOrderArticle, $sId);

    }

    protected function _DeleteOrder( oxERPType & $oType, $sId)
    {

        $oOrder = $oType->getObjectForDeletion($sId);

        return $oType->deleteObject($oOrder, $sId);

    }

    protected function _ImportOrderStatus( oxERPType & $oType, $aRow) {
        $oOrderArt = oxNew( "oxorderarticle", "core");
        $oOrderArt->Load( $aRow['OXID']);

        if( $oOrderArt->getId()) {

            try {
                if( $this->_sCurrVersion != "0.1")
                    $oType->checkWriteAccess($oOrderArt->getId());

                    // store status
                $aStatuses = unserialize( $oOrderArt->oxorderarticles__oxerpstatus->value );

                $oStatus = new stdClass();
                $oStatus->STATUS 		= $aRow['OXERPSTATUS_STATUS'];
                $oStatus->date 			= $aRow['OXERPSTATUS_TIME'];
                $oStatus->trackingid 	= $aRow['OXERPSTATUS_TRACKID'];

                $aStatuses[$aRow['OXERPSTATUS_TIME']] = $oStatus;
                $oOrderArt->oxorderarticles__oxerpstatus->value = serialize( $aStatuses);
                $oOrderArt->Save();
                return true;
            } catch (Exception $ex) {
                return false;
            }
        }

        return false;
    }

    protected function _DeleteArticle( oxERPType & $oType, $sId)
    {
        $oArt = $oType->getObjectForDeletion($sId);

        return $oType->deleteObject($oArt, $sId);

    }

    protected function _ImportUser( oxERPType & $oType, $aRow)
    {

        //Speciall check for user
        if(isset($aRow['OXUSERNAME']))
        {
            $sID = $aRow['OXID'];
            $sUserName = $aRow['OXUSERNAME'];

            $oUser = oxNew( "oxuser", "core");
            $oUser->oxuser__oxusername->value = $sUserName;

            //If user exists with and modifies OXID, throw an axception
            //throw new Exception( "USER {$sUserName} already exists!");
            if( $oUser->exists( $sID) && $sID != $oUser->getId() ) {
                throw new Exception( "USER $sUserName already exists!");
            }

        }

        $sResult  = $this->_Save( $oType, $aRow);
        return (boolean) $sResult;
    }

    protected function _DeleteUser( oxERPType & $oType, $sId) {

        $oUser = $oType->getObjectForDeletion($sId);

        return $oType->deleteObject($oUser, $sId);

    }

    protected function _ImportVendor( oxERPType & $oType, $aRow)
    {

        $sResult = $this->_Save( $oType, $aRow, $this->_sCurrVersion == "0.1");
        return (boolean) $sResult;
    }

    protected function _ImportArtextends( oxERPType & $oType, $aRow) {
        if (oxERPBase::getRequestedVersion() < 2) {
            return false;
        }
        $sResult = $this->_Save( $oType, $aRow);
        return (boolean) $sResult;
    }

    protected function _DeleteVendor( oxERPType & $oType, $sId)
    {

        $oVendor = $oType->getObjectForDeletion($sId);
        return $oType->deleteObject($oVendor, $sId);
    }

    protected function _ImportCountry( oxERPType & $oType, $aRow)
    {
        $sResult = $this->_Save( $oType, $aRow);
        return (boolean) $sResult;
    }

    protected function _DeleteCountry( oxERPType & $oType, $sId)
    {
        $oVendor = $oType->getObjectForDeletion($sId);
        return $oType->deleteObject($oVendor, $sId);
    }


    protected function _ImportArticleStock( oxERPType & $oType, $aRow) {
        $sResult = $this->_Save( $oType, $aRow);
        return (boolean) $sResult;
    }
}
