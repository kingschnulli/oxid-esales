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
 * @package   admin
 * @copyright (C) OXID eSales AG 2003-2010
 * @version OXID eShop CE
 * @version   SVN: $Id: genexport_do.php 28929 2010-07-23 07:06:06Z vilma $
 */

/**
 * Voucher Serie generator class
 *
 * @package admin
 */
class VoucherSerie_Generate extends VoucherSerie_Main
{
    /**
     * Export class name
     *
     * @var string
     */
    public $sClassDo = "voucherserie_generate";

    /**
     * Number of records to export per tick
     *
     * @var int
     */
    public $iExportPerTick = 100;

    /**
     * Current class template name
     *
     * @var string
     */
    protected $_sThisTemplate = "voucherserie_generate.tpl";

    /**
     * Voucher serie object
     *
     * @var oxvoucherserie
     */
    protected $_oVoucherSerie = null;

    /**
     * Generated vouchers count
     *
     * @var int
     */
    protected $_iGenerated = false;

    /**
     * Does Export line by line on position iCnt
     *
     * @param integer $iCnt export position
     *
     * @return bool
     */
    public function nextTick( $iCnt )
    {
        if ( $iGeneratedItems = $this->generateVoucher( $iCnt ) ) {
            return $iGeneratedItems;
        }

        return false;
    }

    /**
     * Writes voucher number information to export file and returns number of written records info
     *
     * @param int $iCnt exported records counter
     *
     * @return int
     */
    public function generateVoucher( $iCnt )
    {
        $iAmount  = abs( (int) oxConfig::getParameter( "voucherAmount" ) );

        // creating new vouchers
        if ( $iCnt < $iAmount && ( $oVoucherSerie = $this->_getVoucherSerie() ) ) {

            if ( !$this->_iGenerated ) {
                $this->_iGenerated = $iCnt;
            }

            $blRandomNr = ( bool ) oxConfig::getParameter( "randomVoucherNr" );
            $sVoucherNr = $blRandomNr ? oxUtilsObject::getInstance()->generateUID() : oxConfig::getParameter( "voucherNr" );

            $oNewVoucher = oxNew( "oxvoucher" );
            $oNewVoucher->oxvouchers__oxvoucherserieid = new oxField( $oVoucherSerie->getId() );
            $oNewVoucher->oxvouchers__oxvouchernr = new oxField( $sVoucherNr );
            $oNewVoucher->save();

            $this->_iGenerated++;
        }

        return $this->_iGenerated;
    }

    /**
     * Runs export
     *
     * @return null
     */
    public function run()
    {
        $blContinue = true;
        $iExportedItems = 0;

        // file is open
        $iStart = oxConfig::getParameter("iStart");

        for ( $i = $iStart; $i < $iStart + $this->iExportPerTick; $i++) {
            if ( ( $iExportedItems = $this->nextTick( $i ) ) === false ) {
                // end reached
                $this->stop( ERR_SUCCESS );
                $blContinue = false;
                break;
            }
        }

        if ( $blContinue) {
            // make ticker continue
            $this->_aViewData['refresh'] = 0;
            $this->_aViewData['iStart']  = $i;
            $this->_aViewData['iExpItems'] = $iExportedItems;
        }
    }
}