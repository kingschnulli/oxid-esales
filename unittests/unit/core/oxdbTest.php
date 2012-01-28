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
 * @link      http://www.oxid-esales.com
 * @package   tests
 * @copyright (C) OXID eSales AG 2003-2011
 * @version OXID eShop CE
 * @version   SVN: $Id: oxdbTest.php 28010 2010-05-28 09:23:10Z sarunas $
 */

require_once realpath( "." ).'/unit/OxidTestCase.php';
require_once realpath( "." ).'/unit/test_config.inc.php';

//P
/*
class Unit_oxdbTest_config
{
    public function getShopLanguage()
    {
        return 1;
    }

    public function getConfigParam( $sParam )
    {
        return oxConfig::getInstance()->getConfigParam( $sParam );
    }
}
*/

class Unit_oxdbTest_config_2
{
    public function getConfigParam( $sParam )
    {
        if ( $sParam == 'blUseStock' )
            return true;

        return oxConfig::getInstance()->getConfigParam( $sParam );
    }
}

class Unit_Core_oxdbTest extends OxidTestCase
{


    /**
     * Testing multilanguage field formatter
     */
    // for default lang
    public function testGetMultiLangFieldNameDefaultLang()
    {
        $oDb = new oxDb();
        $this->assertEquals( "fieldname", $oDb->getMultiLangFieldName( "fieldname" ) );
    }
    // for second lang
    public function testGetMultiLangFieldNameSecondLang()
    {
        oxLang::getInstance()->setBaseLanguage( 1 );
        $oDb = new oxDb();
        $this->assertEquals( "fieldname_1", $oDb->getMultiLangFieldName( "fieldname" ) );
    }

    public function testIsQuoteNeeded()
    {
        $oDb = new oxDb();

        $aNonQuoteTypes = array('int', 'decimal', 'float', 'tinyint', 'smallint', 'mediumint', 'bigint', 'double');
        // types "integer", "real", "numeric", "blob" missing ???
        foreach ( $aNonQuoteTypes as $sType ) {
            $this->assertFalse( $oDb->isQuoteNeeded( $sType ) );
        }

        $aQuoteTypes = array('date', 'datetime', 'timestamp', 'time', 'year', 'char', 'varchar', 'text', 'enum', 'set');
        foreach ( $aQuoteTypes as $sType ) {
            $this->assertTrue( $oDb->isQuoteNeeded( $sType ) );
        }
    }

    public function testQuoteArray()
    {
        $oDb = new oxDb();

        $aArray = array("asd'", 'pppp');
        $aRezArray = array("'asd\''", "'pppp'");
        $this->assertEquals( $aRezArray, $oDb->quoteArray( $aArray ) );
    }

    public function testGetTableDescription()
    {
        oxTestModules::addFunction('oxDb', 'cleanTblCache', '{oxDb::$_aTblDescCache = array();}');
        oxNew('oxDb')->cleanTblCache();

        $myConfig = oxConfig::getInstance();
        $rs = oxDb::getDb()->Execute( "show tables");
        $icount = 3;
        if ( $rs != false && $rs->RecordCount() > 0 ) {
            while ( !$rs->EOF && $icount-- ) {
                $sTable = $rs->fields[0];

                $amc = oxDb::getDb()->MetaColumns( $sTable );

                // db retr
                $rmc1 = oxDb::getInstance()->GetTableDescription( $sTable );

                // simple cache
                $rmc2 = oxDb::getInstance()->GetTableDescription( $sTable );

                $this->assertEquals( $amc, $rmc1, "not cached return is bad [shouldn't be] of $sTable.");
                $this->assertEquals( $amc, $rmc2, "cached [simple] return is bad of $sTable.");

                $rs->MoveNext();
            }
        }else $this->fail("no tables???");
    }

    /**
     * Testing date formatted
     */
    // few tests with insufficient input
    public function testConvertDBDateTimeDateNotFound()
    {
        $oObject = new Oxstdclass();
        $oObject = new oxField('xxx', oxField::T_RAW);

        $oDb = new oxDb();
        $sReturn = $oDb->convertDBDateTime( $oObject, false, false );

        $this->assertEquals( 'xxx', $sReturn );
    }
    public function testConvertDBDateTimeTimeNotFound()
    {
        $oObject = new Oxstdclass();
        $oObject = new oxField('2007-08-01', oxField::T_RAW);

        $oDb = new oxDb();
        $sReturn = $oDb->convertDBDateTime( $oObject, false, false );

        $this->assertEquals( '2007-08-01', $sReturn );
    }
    // bunch of tests ...
    public function testConvertDBDateTime()
    {
        $sZeroTimeStandard  = '0000-00-00 00:00:00';
        $sZeroTimeMySQL     = '0000-00-00 00:00:00';
        $sZeroFormattedDate = '0000-00-00';

        $sDateTime          = '2007-08-01 11:56:25';
        $sDateTimeStandard  = '2007-08-01 11:56:25';
        $sDateTimeMySQL     = '2007-08-01 11:56:25';
        $sDateFormattedDate = '2007-08-01';

        $sEURDateTime = '01.08.2007 11.56.25';

        $sUSADateTimeAM         = '08/01/2007 11:56:25 AM';
        $sUSADateTimeAMExpected = '2007-08-01 11:56:25';

        $sUSADateTimePM         = '08/01/2007 11:56:25 PM';
        $sUSADateTimePMStandard = '2007-08-01 23:56:25';
        $sUSADateTimePMMySQL    = '2007-08-01 23:56:25';

        // standard
        $this->assertTrue( $this->_ConvertDBDateTimeTest( "", $sZeroTimeStandard ) );

        // mySQL compatible
        $this->assertTrue( $this->_ConvertDBDateTimeTest( "", $sZeroTimeMySQL, true ) );

        // format date
        $this->assertTrue( $this->_ConvertDBDateTimeTest( "", $sZeroFormattedDate, true, true ) );
        $this->assertTrue( $this->_ConvertDBDateTimeTest( "", $sZeroFormattedDate, false, true ) );

        // ISO
        $this->assertTrue( $this->_ConvertDBDateTimeTest( $sDateTime, $sDateTimeStandard ) );
        $this->assertTrue( $this->_ConvertDBDateTimeTest( $sDateTime, $sDateTimeMySQL, true ) );
        $this->assertTrue( $this->_ConvertDBDateTimeTest( $sDateTime, $sDateFormattedDate, true, true ) );
        $this->assertTrue( $this->_ConvertDBDateTimeTest( $sDateTime, $sDateFormattedDate, false, true ) );

        // EUR
        $this->assertTrue( $this->_ConvertDBDateTimeTest( $sEURDateTime, $sDateTimeStandard ) );
        $this->assertTrue( $this->_ConvertDBDateTimeTest( $sEURDateTime, $sDateTimeMySQL, true ) );
        $this->assertTrue( $this->_ConvertDBDateTimeTest( $sEURDateTime, $sDateFormattedDate, true, true ) );
        $this->assertTrue( $this->_ConvertDBDateTimeTest( $sEURDateTime, $sDateFormattedDate, false, true ) );

        // USA pattern AM
        $this->assertTrue( $this->_ConvertDBDateTimeTest( $sUSADateTimeAM, $sDateTimeStandard ) );
        $this->assertTrue( $this->_ConvertDBDateTimeTest( $sUSADateTimeAM, $sDateTimeMySQL, true ) );
        $this->assertTrue( $this->_ConvertDBDateTimeTest( $sUSADateTimeAM, $sDateFormattedDate, true, true ) );
        $this->assertTrue( $this->_ConvertDBDateTimeTest( $sUSADateTimeAM, $sDateFormattedDate, false, true ) );

        // USA pattern PM
        $this->assertTrue( $this->_ConvertDBDateTimeTest( $sUSADateTimePM, $sUSADateTimePMStandard ) );
        $this->assertTrue( $this->_ConvertDBDateTimeTest( $sUSADateTimePM, $sUSADateTimePMMySQL, true ) );
        $this->assertTrue( $this->_ConvertDBDateTimeTest( $sUSADateTimePM, $sDateFormattedDate, true, true ) );
        $this->assertTrue( $this->_ConvertDBDateTimeTest( $sUSADateTimePM, $sDateFormattedDate, false, true ) );
    }

    /**
     * _ConvertDBDateTimeTest
     * @param   string  datetime to be converted
     * @param   string  datetime expected after conversion
     * @param   bool    format as mysql compatible
     * @param   bool    format to date only
     * @param   bool    skip
     */
    protected function _ConvertDBDateTimeTest($sInput = "", $sExpected = "", $blMysql = false, $blFormatDate = false )
    {
        $oConvObject = new oxField();
        if (!empty($sInput)) {
            $oConvObject = new oxField($sInput, oxField::T_RAW);
            $oConvObject->fldmax_length = strlen($sInput);
            $oConvObject->fldtype = "datetime";
        }
        $myConfig = oxConfig::getInstance();
        oxDb::getInstance()->convertDBDateTime( $oConvObject, $blMysql, $blFormatDate );
        //echo "\nReturned: ->".$oConvObject->value."<-\nExpected: ->".$sExpected.'<-';
        if ($oConvObject->value == $sExpected) {
            return true;
        }
        return false;
    }

     /**
     * Note:    ConvertDBTimestamp() uses mktime() which is known to have issues with dates
     *          before 1970-01-01 00:00:00
     *          Before this date, all timestamps are computed in a cyclic interval of (2038-1970) in seconds
     *          and stored in a big int.
     *          so use caution with dates before the magic unix date!!
     */
    public function test_ConvertDBTimestamp()
    {
        $sDateTimeStamp = '20070801115625';
        $sDateTime      = '2007-08-01 11:56:25';

        // input datetime expect timestamp
        $this->assertTrue( $this->_ConvertDBTimestampTest( $sDateTime, $sDateTimeStamp, true ) );
        // input timestamp expect datetime
        $this->assertTrue( $this->_ConvertDBTimestampTest( $sDateTimeStamp, $sDateTime ) );

        $sDateTimeStamp = '20070801115625';
        $sEURDateTime   = '01.08.2007 11.56.25';
        // input datetime expect timestamp
        $this->assertTrue( $this->_ConvertDBTimestampTest( $sEURDateTime, $sDateTimeStamp, true ) );
        // input timestamp expect datetime
        $this->assertTrue( $this->_ConvertDBTimestampTest( $sDateTimeStamp, $sDateTime ) );

        $sDateTimeStamp = '20070801115625';
        $sUSADateTime   = '08/01/2007 11:56:25 AM';
        // input datetime expect timestamp
        $this->assertTrue( $this->_ConvertDBTimestampTest( $sUSADateTime, $sDateTimeStamp, true ) );
        // input timestamp expect datetime
        $this->assertTrue( $this->_ConvertDBTimestampTest( $sDateTimeStamp, $sDateTime ) );

        $sDateTimeStamp = '20070801235625';
        $sUSADateTime   = '08/01/2007 11:56:25 PM';
        // input datetime expect timestamp
        $this->assertTrue( $this->_ConvertDBTimestampTest( $sUSADateTime, $sDateTimeStamp, true ) );
        // input timestamp expect datetime
        $sDateTime = '2007-08-01 23:56:25';
        $this->assertTrue( $this->_ConvertDBTimestampTest( $sDateTimeStamp, $sDateTime ) );

        $sZeroTimeStamp = '00000000000000';
        $sZeroDateTime  = '0000-00-00 00:00:00';
        // input datetime expect timestamp
        $this->assertTrue( $this->_ConvertDBTimestampTest( $sZeroDateTime, $sZeroTimeStamp, true ) );
        // input timestamp expect datetime
        $sZeroTimeStamp = '19700101000000';
        $sZeroDateTime  = '1970-01-01 00:00:00';
        $this->assertTrue( $this->_ConvertDBTimestampTest( $sZeroTimeStamp, $sZeroDateTime ) );

        // 20070801-AS - timestamps works only for dates including 19011213205513
        $sZeroTimeStamp = '19111213205513';
        $sZeroDateTime  = '1911-12-13 20:55:13';
        $this->assertTrue( $this->_ConvertDBTimestampTest( $sZeroTimeStamp, $sZeroDateTime ) );

        // 20070801-AS - timestamps earlier than 19011213205513 return 1970-01-01 01:00:00
        $sZeroTimeStamp = '19711213205512';
        $sZeroDateTime  = '1901-12-13 20:55:12';
        $this->assertFalse( $this->_ConvertDBTimestampTest( $sZeroTimeStamp, $sZeroDateTime ) );
        // 20070801-AS - timestamps earlier than 19011213205513 return 1970-01-01 01:00:00 or differnt (depends on GMT + and - )
        $sZeroTimeStamp = '18710130105512';
        if ( ( $iTimeStamp = mktime( 10, 55, 12, 1, 30, 1871 ) ) === false ) {
            $iTimeStamp = 0;
        }
        $sZeroDateTime  = date( "Y-m-d H:i:s", $iTimeStamp );
        $this->assertTrue( $this->_ConvertDBTimestampTest( $sZeroTimeStamp, $sZeroDateTime ) );
    }

    /**
     * _ConvertDBTimestampTest
     * @param   string  datetime/timestamp to be converted
     * @param   string  datetime/timestamp expected after conversion
     * @param   bool    if true convert to timestamp
     * @param   bool    skip
     */
    protected function _ConvertDBTimestampTest( $sInput = "", $sExpected = "", $blToTimeStamp = false, $blSkip = false )
    {
        $myConfig = oxConfig::getInstance();

        $oConvObject = new oxField();
        if ( !empty( $sInput ) ) {
            $oConvObject = new oxField($sInput, oxField::T_RAW);
        }

        oxDb::getInstance()->convertDBTimestamp( $oConvObject, $blToTimeStamp );
        if ( $oConvObject->value == $sExpected ) {
            return true;
        }

        return false;
    }

    public function testConvertDBDate()
    {
        $sDateTime = '2007-08-01 11:56:25';
        $sDate = '2007-08-01';
        $this->assertTrue($this->_ConvertDBDateTest($sDateTime, $sDate, false, false));
    }

    /**
     * _ConvertDBDateTest
     * @param   string  date/timestamp to be converted
     * @param   string  date/timestamp expected after conversion
     * @param   bool    if true convert to timestamp
     * @param   bool    skip
     */
    protected function _ConvertDBDateTest($sInput = "", $sExpected = "", $blToTimeStamp = false )
    {
        $myConfig = oxConfig::getInstance();

        $oConvObject = new oxField();
        if (!empty($sInput)) {
            $oConvObject = new oxField($sInput, oxField::T_RAW);
        }
        oxDb::getInstance()->convertDBDate($oConvObject, $blToTimeStamp);
        //echo "\nReturned: ->".$oConvObject->value."<-\nExpected: ->".$sExpected.'<-';
        if ($oConvObject->value == $sExpected) {
            return true;
        }
        return false;
    }

    public function testCreateSQLList()
    {
        $aAllArticels = array(array('Bla'),array('Foo'),array('Bar'));
        $aAllArticels2 = array('Bla',array('Foo'),array('Bar'));

        $this->assertEquals("", oxDb::getInstance()->createSQLList(array()));
        $this->assertEquals("", oxDb::getInstance()->createSQLList(array(array(''))));
        $this->assertEquals("'Bla','Foo','Bar'", oxDb::getInstance()->createSQLList($aAllArticels));
        $this->assertEquals("'B','Foo','Bar'", oxDb::getInstance()->createSQLList($aAllArticels2));
    }


    // just SQL cleaner ..
    protected function cleanSQL( $sQ )
    {
        return preg_replace( array( '/[^\w\'\:\-\.\*]/' ), '', $sQ );
    }


    public function testIsValidFieldName()
    {
        $oDb = new oxDb();
        $this->assertTrue( $oDb->isValidFieldName( 'oxid' ) );
        $this->assertTrue( $oDb->isValidFieldName( 'oxid_1' ) );
        $this->assertTrue( $oDb->isValidFieldName( 'oxid.1' ) );
        $this->assertFalse( $oDb->isValidFieldName( 'oxid{1' ) );
    }

    /**
     * Testing default time value setter
     */
    // bad input
    public function testSetDefaultFormatedValueBadInput()
    {
        $oObject = new Oxstdclass();
        $oObject = new oxField('xxx', oxField::T_RAW);
        $oObject->fldmax_length = 0;

        $oDb = new oxdb();
        $oDb->UNITsetDefaultFormatedValue( $oObject, 'xxx', 'ISO', 'ISO', false );
        $this->assertEquals( 'xxx', $oObject->value );
        $this->assertEquals( 0, $oObject->fldmax_length );
    }
    // only date
    public function testSetDefaultFormatedValueOnlyDate()
    {
        $oObject = new Oxstdclass();
        $oObject = new oxField('', oxField::T_RAW);
        $oObject->fldmax_length = 0;

        $oDb = new oxdb();
        $oDb->UNITsetDefaultFormatedValue( $oObject, 'xxx', 'ISO', 'ISO', true );
        $this->assertEquals( '0000-00-00', $oObject->value );
        $this->assertEquals( strlen('0000-00-00'), $oObject->fldmax_length );
    }
    // full date
    public function testSetDefaultFormatedValueFullDate()
    {
        $oObject = new Oxstdclass();
        $oObject = new oxField('', oxField::T_RAW);
        $oObject->fldmax_length = 0;

        $oDb = new oxdb();
        $oDb->UNITsetDefaultFormatedValue( $oObject, '0000-00-00 00:00:00', 'ISO', 'ISO', false );
        $this->assertEquals( '0000-00-00 00:00:00', $oObject->value );
        $this->assertEquals( strlen('0000-00-00 00:00:00'), $oObject->fldmax_length );
    }

    /**
     * Testing default date time value setter
     */
    public function testSetDefaultDateTimeValue()
    {
        $oObject = new Oxstdclass();

        $oDb = new oxDb();
        $oDb->UNITsetDefaultDateTimeValue( $oObject, "ISO", "ISO", false );

        $this->assertEquals( "0000-00-00 00:00:00", $oObject->value );
        $this->assertEquals( strlen( "0000-00-00 00:00:00" ), $oObject->fldmax_length );
    }

    /**
     * Testing date formatter
     */
    public function testSetDate()
    {
        $oObject = new Oxstdclass();

        $aDateMatches = array( 05, 14, 1981, );
        $aDFields     = array( 0, 1, 2 );

        $oDb = new oxDb();
        $oDb->UNITsetDate( $oObject, "Y-m-d", $aDFields, $aDateMatches );

        $this->assertEquals( "1981-05-14", $oObject->value );
        $this->assertEquals( strlen( "1981-05-14" ), $oObject->fldmax_length );
    }

    /**
     * Testing full date formatter
     */
    public function testFormatCorrectTimeValue()
    {
        $oObject = new Oxstdclass();

        $aDateMatches = array( 05, 14, 1981, );
        $aDFields     = array( 0, 1, 2 );

        $aTimeMatches = array( 12, 12, 12);
        $aTFields     = array( 0, 1, 2 );

        $oDb = new oxDb();
        $oDb->UNITformatCorrectTimeValue( $oObject, "Y-m-d", "H:i:s", $aDateMatches, $aTimeMatches, $aTFields, $aDFields);

        $this->assertEquals( "1981-05-14 12:12:12", $oObject->value );
        $this->assertEquals( strlen( "1981-05-14 12:12:12" ), $oObject->fldmax_length );
    }

    /**
     * Testing DB link identifier getter
     */
    public function testGetConnectionId()
    {
        $oDb = new oxDb();
        $this->assertNotNull( $oDb->UNITgetConnectionId() );
    }

    /**
     * Testing escaping string
     */
    public function testEscapeString()
    {
        $sString = "\x00 \n \r ' \, \" \x1a";
        $sEscapedChars = mysql_real_escape_string( $sString );

        $oDb = oxDb::getInstance();
        $this->assertEquals( bin2hex($sEscapedChars), bin2hex($oDb->escapeString( $sString )) );
    }

    public function testGetDb()
    {
        oxTestModules::addFunction("oxDb", "clearInstance", '{oxDb::$_oDB = null;}');
        oxNew("oxDb")->clearInstance();
        $oDb = oxNew("oxDb");

        $this->assertTrue($oDb instanceof oxDb);
        //test SQL
        $this->assertEquals('testRes', $oDb->getDb()->getOne("SELECT 'testRes'"));
    }

    public function testGetDbFetchMode()
    {
        $oDb = oxNew("oxDb");

        //unfortunately we should use globals in order to test this behaviour
        global $ADODB_FETCH_MODE;

        $aRes = $oDb->getDb();
        $this->assertEquals($ADODB_FETCH_MODE, ADODB_FETCH_NUM);

        $aRes = $oDb->getDb(true);
        $this->assertEquals($ADODB_FETCH_MODE, ADODB_FETCH_ASSOC);

        $aRes = $oDb->getDb(false);
        $this->assertEquals($ADODB_FETCH_MODE, ADODB_FETCH_NUM);
    }
}
