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
 * @package   core
 * @copyright (C) OXID eSales AG 2003-2011
 * @version OXID eShop CE
 * @version   SVN: $Id: oxuserpayment.php 39209 2011-10-12 13:31:50Z arvydas.vapsva $
 */

/**
 * User payment manager.
 * Performs assigning, loading, inserting and updating functions for
 * user payment.
 * @package core
 */
class oxUserPayment extends oxBase
{

    // you can change this if you want more security
    // DO NOT !! CHANGE THIS FILE AND STORE CREDIT CARD INFORMATION
    // THIS IS MORE THAN LIKELY ILLEGAL !!
    // CHECK YOUR CREDIT CARD CONTRACT

    /**
     * Payment information encryption key
     *
     * @var string.
     */
    protected $_sPaymentKey = 'fq45QS09_fqyx09239QQ';

    /**
     * Name of current class
     *
     * @var string
     */
    protected $_sClassName = 'oxuserpayment';

    /**
     * Store credit card information in db or not
     *
     * @var bool
     */
    protected $_blStoreCreditCardInfo = null;

    /**
     * Payment info object
     *
     * @var oxpayment
     */
    protected $_oPayment = null;

    /**
     * current dyn values
     *
     * @var array
     */
    protected $_aDynValues = null;

    /**
     * Field name array of ignored fields when doing record update() (eg. oxarticles__oxtime)
     *
     * @var array
     */
    protected $_aSkipSaveFields = array( "oxid" );

    /**
     * Special getter for oxpayments__oxdesc field
     *
     * @param string $sName name of field
     *
     * @return string
     */
    public function __get( $sName )
    {
        //due to compatibility with templates
        if ( $sName == 'oxpayments__oxdesc' ) {
            if ( $this->_oPayment === null ) {
                $this->_oPayment = oxNew( 'oxpayment' );
                $this->_oPayment->load( $this->oxuserpayments__oxpaymentsid->value );
            }
            return $this->_oPayment->oxpayments__oxdesc;
        }

        if ( $sName == 'aDynValues' ) {
            if ( $this->_aDynValues === null ) {
                $this->_aDynValues = $this->getDynValues();
            }
            return $this->_aDynValues;
        }

        return parent::__get( $sName );
    }

    /**
     * Class constructor. Sets payment key for encoding sensitive data and
     */
    public function __construct()
    {
        parent::__construct();
        $this->init( 'oxuserpayments' );
        $this->_sPaymentKey = oxUtils::getInstance()->strRot13( $this->_sPaymentKey );
        $this->setStoreCreditCardInfo( $this->getConfig()->getConfigParam( 'blStoreCreditCardInfo' ) );
    }

    /**
     * Returns payment key used for DB value decription
     *
     * @return string
     */
    public function getPaymentKey()
    {
        return $this->_sPaymentKey;
    }

    /**
     * Loads user payment object
     *
     * @param string $sOxId oxuserpayment id
     *
     * @return mixed
     */
    public function load( $sOxId )
    {
        $sSelect = 'select oxid, oxuserid, oxpaymentsid, DECODE( oxvalue, "'.$this->getPaymentKey().'" ) as oxvalue
                    from oxuserpayments where oxid = '. oxDb::getDb()->quote( $sOxId );

        return $this->assignRecord( $sSelect );
    }


    /**
    * Inserts payment information to DB. Returns insert status.
    *
     * @return bool
     */
    protected function _insert()
    {
        // we do not store credit card information
        // check and in case skip it
        if ( !$this->getStoreCreditCardInfo() && $this->oxuserpayments__oxpaymentsid->value == 'oxidcreditcard' ) {
            return true;
        }

        //encode sensitive data
        if ( $sValue = $this->oxuserpayments__oxvalue->value ) {
            $oDb = oxDb::getDb();
            $sEncodedValue = $oDb->getOne( "select encode( " . $oDb->quote( $sValue ) . ", '" . $this->getPaymentKey() . "' )" );
            $this->oxuserpayments__oxvalue->setValue($sEncodedValue);
        }

        $blRet = parent::_insert();

        //restore, as encoding was needed only for saving
        if ( $sEncodedValue ) {
            $this->oxuserpayments__oxvalue->setValue( $sValue );
        }

        return $blRet;
    }

    /**
     * Updates payment record in DB. Returns update status.
     *
     * @return bool
     */
    protected function _update()
    {
        $oDb = oxDb::getDb();

        //encode sensitive data
        if ( $sValue = $this->oxuserpayments__oxvalue->value ) {
            $sEncodedValue = $oDb->getOne( "select encode( " . $oDb->quote( $sValue ) . ", '" . $this->getPaymentKey() . "' )" );
            $this->oxuserpayments__oxvalue->setValue($sEncodedValue);
        }

        // replace (not update) existing record
        //do not allow derived item update
        if ( !$this->allowDerivedUpdate() ) {
            return false;
        }


        $sUpdate =  "update {$this->_sCoreTable} set ".$this->_getUpdateFields()
                  . " where {$this->_sCoreTable}.oxuserid = " . $oDb->quote( $this->oxuserpayments__oxuserid->value )
                  . " and oxpaymentsid = " . $oDb->quote( $this->oxuserpayments__oxpaymentsid->value )
                  . " limit 1";

        //trigger event
        $this->beforeUpdate();

        $blRet = (bool) $oDb->execute( $sUpdate );
        $this->_rebuildCache();

        //restore, as encoding was needed only for saving
        if ( $sEncodedValue ) {
            $this->oxuserpayments__oxvalue->setValue( $sValue );
        }

        return $blRet;
    }

    /**
     * Checks if this object exists, returns true on success.
     *
     * @param string $sOXID Object ID(default null)
     *
     * @return bool
     */
    public function exists( $sOXID = null )
    {
        if ( !$this->oxuserpayments__oxpaymentsid->value || !$this->oxuserpayments__oxuserid->value ) {
            return false;
        }

        // generating new id..
        if ( !$this->getId() ) {
            $this->setId();
        }

        $oDB = oxDb::getDb( true );
        $sSelect  = "select 1 from oxuserpayments where oxuserid = " . $oDB->quote( $this->oxuserpayments__oxuserid->value );
        $sSelect .= " and oxpaymentsid = " . $oDB->quote( $this->oxuserpayments__oxpaymentsid->value );

        return ( bool ) $oDB->getOne( $sSelect );
    }

    /**
     * Delete this object from the database, returns true on success.
     *
     * @param string $sOXID Object ID(default null)
     *
     * @return bool
     */
    public function delete( $sOXID = null)
    {
        if ( !$sOXID ) {
            $sOXID = $this->getId();

            //do not allow derived deletion
            if ( !$this->allowDerivedDelete() ) {
                return false;
            }
        }

        if ( !$sOXID || !$this->oxuserpayments__oxpaymentsid->value || !$this->oxuserpayments__oxuserid->value  ) {
            return false;
        }


        $oDB = oxDb::getDb(true);
        $sDelete  = "delete from $this->_sCoreTable where oxuserid = " . $oDB->quote( $this->oxuserpayments__oxuserid->value );
        $sSelect .= " and oxpaymentsid = " . $oDB->quote( $this->oxuserpayments__oxpaymentsid->value );

        $rs = $oDB->execute( $sDelete );
        if ( $blDelete = ( bool ) $oDB->affected_Rows() ) {
            $this->onChange(ACTION_DELETE, $sOXID);
        }

        return $blDelete;
    }

    /**
     * Set store or not credit card information in db
     *
     * @param bool $blStoreCreditCardInfo store or not credit card info
     *
     * @return null
     */
    public function setStoreCreditCardInfo( $blStoreCreditCardInfo )
    {
        $this->_blStoreCreditCardInfo = $blStoreCreditCardInfo;
    }

    /**
     * Get store or not credit card information in db parameter
     *
     * @return bool
     */
    public function getStoreCreditCardInfo()
    {
        return $this->_blStoreCreditCardInfo;
    }

    /**
     * Get user payment by payment id
     *
     * @param oxUser $oUser        user object
     * @param string $sPaymentType payment type
     *
     * @return bool
     */
    public function getPaymentByPaymentType( $oUser = null, $sPaymentType = null )
    {
        $blGet = false;
        if ( $oUser && $sPaymentType != null ) {
            $oDb = oxDb::getDb();
            $sSelect  = 'select oxid from oxuserpayments where oxpaymentsid=' . $oDb->quote( $sPaymentType ) . ' and oxuserid=' . $oDb->quote( $oUser->getId() );
            if ( ( $sOxId = $oDb->getOne( $sSelect ) ) ) {
                $blGet = $this->load( $sOxId );
            }
        }

        return $blGet;
    }

    /**
     * Returns an array of dyn payment values
     *
     * @return array
     */
    public function getDynValues()
    {
        if ( !$this->getStoreCreditCardInfo() && $this->oxuserpayments__oxpaymentsid->value == 'oxidcreditcard' ) {
            return null;
        }

        if ( !$this->_aDynValues ) {

            $sRawDynValue = null;
            if ( is_object($this->oxuserpayments__oxvalue) ) {
                $sRawDynValue = $this->oxuserpayments__oxvalue->getRawValue();
            }

            $this->_aDynValues = oxUtils::getInstance()->assignValuesFromText( $sRawDynValue );
        }
        return $this->_aDynValues;
    }

    /**
     * sets the dyn values
     *
     * @param array $aDynValues the array of dy values
     *
     * @return null
     */
    public function setDynValues( $aDynValues )
    {
        $this->_aDynValues = $aDynValues;
    }

}
