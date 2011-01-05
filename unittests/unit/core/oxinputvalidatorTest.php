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
 * @version   SVN: $Id: oxinputvalidatorTest.php 26841 2010-03-25 13:58:15Z arvydas $
 */

require_once realpath( "." ).'/unit/OxidTestCase.php';
require_once realpath( "." ).'/unit/test_config.inc.php';

/**
 * Test input validation class (oxInputValidator)
 */
class Unit_Core_oxInputValidatorTest extends OxidTestCase
{
    private $_oValidator = null;

    /**
     * Initialize the fixture.
     *
     * @return null
     */
    protected function setUp()
    {
        parent::setUp();
        $this->_oValidator = oxNew('oxInputValidator', 'core');
    }

    /**
    * tests rounding of validator
    */
    public function testValidateBasketAmountnoUneven()
    {
        try {
            $this->assertEquals($this->_oValidator->validateBasketAmount('1,6'), 2);
            $this->assertEquals($this->_oValidator->validateBasketAmount('1.6'), 2);
            $this->assertEquals($this->_oValidator->validateBasketAmount('1.1'), 1);
        } catch ( oxArticleInputException $e ) {
            $this->fail( 'Error while executing test: testValidateBasketAmountnoUneven' );
        }
    }
    /**
    * tests uneven amount
    */
    public function testValidateBasketAmountallowUneven()
    {
        modConfig::getInstance()->setConfigParam( 'blAllowUnevenAmounts', true );
        $this->assertEquals($this->_oValidator->validateBasketAmount('1.6'), 1.6);
    }
    /**
    * tests unallowed input
    */
    public function testValidateBasketAmountBadInput()
    {
        $iStat = 0;
        modConfig::getInstance()->setConfigParam( 'blAllowUnevenAmounts', false );
        try {
            $this->_oValidator->validateBasketAmount( -1 );
        } catch ( oxArticleInputException $e ) {
            $iStat++;
        }

        //FS#1758
        try {
            $this->_oValidator->validateBasketAmount( 'Alpha' );
        } catch ( oxArticleInputException $e ) {
            $iStat++;
        }

        try {
            $this->_oValidator->validateBasketAmount( '0.000,0' );
        } catch ( oxArticleInputException $e ) {
            $iStat++;
        }

        if ( $iStat != 3 )
            $this->fail( 'Bad input passed' );
    }

    /**
     * Testing payment input data validation
     */
    // 1. unknown payment, which has no testing conditions
    public function testValidatePaymentInputDataUnknownPayment()
    {
        $aDynvalue = array();
        $oValidator = new oxinputvalidator();
        $this->assertTrue( $oValidator->validatePaymentInputData( 'xxx', $aDynvalue ) );
    }

    // 2. CC: missing input fields
    public function testValidatePaymentInputDataCCMissingFields()
    {
        $aDynvalue = array();
        $oValidator = new oxinputvalidator();
        $this->assertFalse( $oValidator->validatePaymentInputData( 'oxidcreditcard', $aDynvalue ) );
    }

    // 3. CC: wrong card type
    public function testValidatePaymentInputDataCCWrongCardType()
    {
        $aDynvalue = array( 'kktype'   => 'xxx',
                            'kknumber' => 'xxx',
                            'kkmonth'  => 'xxx',
                            'kkyear'   => 'xxx',
                            'kkname'   => 'xxx',
                            'kkpruef'  => 'xxx'
                          );
        $oValidator = new oxinputvalidator();
        $this->assertFalse( $oValidator->validatePaymentInputData( 'oxidcreditcard', $aDynvalue ) );
    }

    // 4. CC: all input is fine
    public function testValidatePaymentInputDataCCAllInputIsFine()
    {
        $aDynvalue = array( 'kktype'   => 'vis',
                            'kknumber' => '4111111111111111',
                            'kkmonth'  => '01',
                            'kkyear'   => date( 'Y' ) + 1,
                            'kkname'   => 'Hans Mustermann',
                            'kkpruef'  => '333'
                          );

        $oValidator = new oxinputvalidator();
        $this->assertTrue( $oValidator->validatePaymentInputData( 'oxidcreditcard', $aDynvalue ) );
    }


    // 5. DC: missing input fields
    public function testValidatePaymentInputDataDCMissingFields()
    {
        $aDynvalue = array();
        $oValidator = new oxinputvalidator();
        $this->assertFalse( $oValidator->validatePaymentInputData( 'oxiddebitnote', $aDynvalue ) );
    }

    // 6. DC: all input is fine
    public function testValidatePaymentInputDataDCAllInputIsFine()
    {
        $aDynvalue = array( 'lsbankname'   => 'Bank name',
                            'lsblz'        => '12345678',
                            'lsktonr'      => '123456789',
                            'lsktoinhaber' => 'Hans Mustermann'
                          );

        $oValidator = new oxinputvalidator();
        $this->assertTrue( $oValidator->validatePaymentInputData( 'oxiddebitnote', $aDynvalue ) );
    }


    /**
     * Test for bug #1150
     */
    public function test4CharLsblz()
    {
        $aDynvalue = array( 'lsbankname'   => 'Bank name',
                            'lsblz'        => '1234',
                            'lsktonr'      => '123456789',
                            'lsktoinhaber' => 'Hans Mustermann'
                          );


        $oValidator = new oxinputvalidator();
        $this->assertFalse( $oValidator->validatePaymentInputData( 'oxiddebitnote', $aDynvalue ) );
    }

    /**
     * Test for bug #1150
     */
    public function test5CharLsblz()
    {
        $aDynvalue = array( 'lsbankname'   => 'Bank name',
                            'lsblz'        => '12345',
                            'lsktonr'      => '123456789',
                            'lsktoinhaber' => 'Hans Mustermann'
                          );


        $oValidator = new oxinputvalidator();
        $this->assertTrue( $oValidator->validatePaymentInputData( 'oxiddebitnote', $aDynvalue ) );
    }

    /**
     * Test for bug #1150
     */
    public function test6CharLsblz()
    {
        $aDynvalue = array( 'lsbankname'   => 'Bank name',
                            'lsblz'        => '123456',
                            'lsktonr'      => '123456789',
                            'lsktoinhaber' => 'Hans Mustermann'
                          );


        $oValidator = new oxinputvalidator();
        $this->assertTrue( $oValidator->validatePaymentInputData( 'oxiddebitnote', $aDynvalue ) );
    }

    /**
     * Test for bug #1150
     */
    public function test8CharLsblz()
    {
        $aDynvalue = array( 'lsbankname'   => 'Bank name',
                            'lsblz'        => '12345678',
                            'lsktonr'      => '123456789',
                            'lsktoinhaber' => 'Hans Mustermann'
                          );


        $oValidator = new oxinputvalidator();
        $this->assertTrue( $oValidator->validatePaymentInputData( 'oxiddebitnote', $aDynvalue ) );
    }

    /**
     * Test for bug #1150
     */
    public function test9CharLsblz()
    {
        $aDynvalue = array( 'lsbankname'   => 'Bank name',
                            'lsblz'        => '123456789',
                            'lsktonr'      => '123456789',
                            'lsktoinhaber' => 'Hans Mustermann'
                          );


        $oValidator = new oxinputvalidator();
        $this->assertFalse( $oValidator->validatePaymentInputData( 'oxiddebitnote', $aDynvalue ) );
    }

}
