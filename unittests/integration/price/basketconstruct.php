<?php
/**
 * Basket constructor
 *
 */
class BasketConstruct
{
    /**
     * Returns calculated basket
     * @param array $aArticles article data
     * @param array $aDiscounts discount data
     * @return oxBasket
     */
    public function calculateBasket( $aTestCase )
    {
        // getting config
        $oConfig = oxRegistry::getConfig();
        
        // gather data from test case
        $aExpected  = $aTestCase['expected'];
        $aArticles  = $aTestCase['articles'];
        $aDiscounts = $aTestCase['discounts'];
        $aCosts     = $aTestCase['costs'];
        $aOptions   = $aTestCase['options'];
        $aUser      = $aTestCase['user'];
        
        // set custom configs
        $this->setOptions( $aOptions );

        // categories preparation
        if ( $aTestCase['categories'] ) {
            $this->_createCats( $aTestCase['categories'] );
        }
        // article preparation, returns data required for adding to basket
        $aArtsForBasket = $this->_getArticles( $aArticles );

        // create & set discounts
        $this->_setDiscounts( $aDiscounts );

        // create & set wrappings
        $aWrap = $this->_setWrappings( $aCosts['wrapping'] );

        // create & set delivery costs
        $aDelivery = $this->_setDeliveryCosts( $aCosts['delivery'] );

        // create & set payment costs
        $aPayment = $this->_setPayments( $aCosts['payment'] );

        // create & set vouchers
        $aVoucherIDs = $this->_setVouchers( $aCosts['voucherserie'] );

        // basket preparation
        $oBasket = new oxBasket();

        // setup and login user for basket
        if ( empty( $aUser ) ) {
            $aUser = $this->_getDefaultUserData();
        } 
        $oUser = $this->_createUser( $aUser );
        
        $this->oUser = $oUser;
        $oBasket->setBasketUser( $oUser );

        // adding articles to basket
        foreach ( $aArtsForBasket as $aArt ) {
            $oItem = $oBasket->addToBasket( $aArt['id'], $aArt['amount'] );
            // adding wrapping if need
            if ( !empty( $aWrap ) ) {
                $oItem->setWrapping( $aWrap[ $aArt['id'] ] );
            }
        }
        
        // try to add card
        $aWrap['card'] ? $oBasket->setCardId( $aWrap['card'] ) : '';

        // try to add delivery
        if ( !empty( $aDelivery ) ) {
            $oBasket->setShipping( $aDelivery[0] );
        }

        // try to add payment
        if ( !empty( $aPayment ) ) {
            $oBasket->setPayment( $aPayment[0] );
        }

        // try to add vouchers
        $oBasket->setSkipVouchersChecking( true );
        if ( !empty( $aVoucherIDs ) ) {
            $iCount = count( $aVoucherIDs );
            for ( $i = 0; $i < $iCount; $i++ ) {
                $oBasket->addVoucher( $aVoucherIDs[$i] );
            }
        }

        // calculate basket
        $oBasket->calculateBasket();
        
        return $oBasket;
    }

    /**
     * Create user
     * @param array $aUser user data
     */
    protected function _createUser( $aUser )
    {
        $oUser = new oxUser();
        foreach ( $aUser as $sKey => $sValue ) {
            $sField = "oxuser__" . $sKey;
            $oUser->$sField = new oxField( $sValue );
        }
        $oUser->save();
        return $oUser;
    }
    
    /**
     * Create categories with assigning articles
     * @param array $aCategories category data
     */
    protected function _createCats( $aCategories )
    {
        foreach ( $aCategories as $iKey => $aCat ) {
            $oCat = new oxCategory();
            $oCat->setId( $aCat['oxid'] );
            foreach ( $aCat as $sKey => $sValue ) {
                if ( strstr( $sKey, "ox" ) ) {
                    $sField = "oxcategories__{$sKey}";
                    $oCat->$sField = new oxField( $aCat[$sKey] );
                }
            }
            $oCat->save();
            if ( !empty( $aCat['articles'] ) ) {
                $iCnt = count( $aCat['articles'] );
                for ( $i = 0; $i < $iCnt; $i++ ) {
                    $oBase = oxNew( 'oxbase' );
                    $oBase->init( 'oxprice2article' );
                    $oBase->oxprice2article__oxcatnid = new oxField( $oCat->getId() );
                    $oBase->oxprice2article__oxobjectid = new oxField( $aCat['articles'][$i] );
                    $oBase->save();
                }
            }
        }
    }
    
    /**
     * Creates articles
     * @param array $aArtDemoData
     *
     * @return array $aResult of id's and basket amounts of created articles
     */
    protected function _getArticles( $aArtDemoData )
    {
        if ( empty( $aArtDemoData ) ) {
            return false;
        }
        $aResult = array();
        foreach ( $aArtDemoData as $sOuterKey => $aArt ) {
            $oArt = new oxArticle();
            $oArt->setId( $aArt['oxid'] );
            foreach ( $aArt as $sKey => $sValue ) {
                if ( strstr( $sKey, "ox" ) ) {
                    $sField = "oxarticles__{$sKey}";
                    $oArt->$sField = new oxField( $aArt[$sKey] );
                }
            }
            $oArt->save();
            // detect scaleprices & create if must
            if ( $aArt['scaleprices'] ) {
                $this->_createScalePrices( $aArt['scaleprices'] );
            }
            $aResult[$sOuterKey]['id'] = $aArt['oxid'];
            $aResult[$sOuterKey]['amount'] = $aArt['amount'];
        }
        return $aResult;
    }

    /**
     * Creates price 2 article connection needed for scale prices
     * @param array $aScalePrices of scale prices needed db fields
     */
    protected function _createScalePrices( $aScalePrices ) {
        $oBase = oxNew( 'oxbase' );
        $sTable = "oxprice2article";
        $oBase->init( $sTable );
        foreach ( $aScalePrices as $sKey => $sValue ) {
                $sField = "{$sTable}__{$sKey}";
                $oBase->$sField = new oxField( $sValue );
        }
        $oBase->save();
    }

    /**
     * Creates discounts and assign them to according objects
     * @param array $aDiscounts discount data
     */
    protected function _setDiscounts( $aDiscounts )
    {
        if ( empty( $aDiscounts ) ) {
            return false;
        }
        foreach ( $aDiscounts as $iKey => $aDiscount ) {
            // add discounts
            $oDiscount = new oxDiscount();
            $oDiscount->setId( $aDiscount['oxid'] );
            foreach ( $aDiscount as $sKey => $mxValue ) {
                if ( !is_array( $mxValue ) ) {
                    $sField = "oxdiscount__" . $sKey;
                    $oDiscount->$sField = new oxField( "{$mxValue}" );
                } // if $sValue is not empty array then create oxobject2discount
                $oDiscount->save();
                if ( is_array( $mxValue ) && !empty( $mxValue ) ) {
                    foreach ( $mxValue as $iArtId ) {
                        $oObject2Discount = new oxBase();
                        $oObject2Discount->init( 'oxobject2discount' );
                        $oObject2Discount->setId( $oDiscount->getId() . "_" . $iArtId );
                        $oObject2Discount->oxobject2discount__oxdiscountid = new oxField( $oDiscount->getId() );
                        $oObject2Discount->oxobject2discount__oxobjectid = new oxField( $iArtId );
                        $oObject2Discount->oxobject2discount__oxtype = new oxField( $sKey );
                        $oObject2Discount->save();
                    }
                }
            }
        }
    }

    /**
     * Creates wrappings
     * @param array $aWrappings
     *
     * @return array of wrapping id's
     */
    protected function _setWrappings( $aWrappings )
    {
        if ( empty( $aWrappings ) ) {
            return false;
        }
        $aWrap = array();
        foreach ( $aWrappings as $aWrapping ) {
            $oCard = oxNew('oxbase' );
            $oCard->init('oxwrapping');
            foreach( $aWrapping as $sKey => $mxValue ) {
                if ( !is_array( $mxValue ) ) {
                    $sField = "oxwrapping__" . $sKey;
                    $oCard->$sField = new oxField( $mxValue, oxField::T_RAW);
                }
            }
            $oCard->save();
            if ( $aWrapping['oxarticles'] ) {
                foreach ( $aWrapping['oxarticles'] as $sArtId ) {
                    $aWrap[$sArtId] = $oCard->getId();
                }
            } else {
                $aWrap['card'] = $oCard->getId();
            }
        }
        return $aWrap;
    }

    /**
     * Creates deliveries
     * @param array $aDeliveryCosts
     *
     * @return array of delivery id's
     */
    protected function _setDeliveryCosts( $aDeliveryCosts )
    {
        if ( empty( $aDeliveryCosts ) ) {
            return false;
        }
        $aDel = array();
        
        $oDeliverySet = new oxBase();
        $oDeliverySet->init( 'oxdeliveryset' );
        $oDeliverySet->oxdeliveryset__oxactive = new oxField( 1, oxField::T_RAW );
        $oDeliverySet->save();
        
        foreach ( $aDeliveryCosts as $iKey => $aDelivery ) {
            $oDelivery = new oxDelivery();
            foreach ( $aDelivery as $sKey => $mxValue ) {
                if ( !is_array( $mxValue ) ) {
                    $sField = "oxdelivery__" . $sKey;
                    $oDelivery->$sField = new oxField( "{$mxValue}" );
                }
            }
            $oDelivery->save();
            $aDel[] = $oDelivery->getId();
            $oDel2Delset = oxNew( 'oxbase' );
            $oDel2Delset->init( 'oxdel2delset' );
            $oDel2Delset->oxdel2delset__oxdelid = new oxField( $oDelivery->getId(), oxField::T_RAW );
            $oDel2Delset->oxdel2delset__oxdelsetid = new oxField( $oDeliverySet->getId(), oxField::T_RAW );
            $oDel2Delset->save();
        }
        return $aDel;
    }

    /**
     * Creates payments
     * @param array $aPayments
     *
     * @return array of payment id's
     */
    protected function _setPayments( $aPayments )
    {
        if ( empty( $aPayments ) ) {
            return false;
        }
        $aPay = array();
        foreach ( $aPayments as $iKey => $aPayment ) {
            // add discounts
            $oPayment = new oxPayment();
            foreach ( $aPayment as $sKey => $mxValue ) {
                if ( !is_array( $mxValue ) ) {
                    $sField = "oxpayments__" . $sKey;
                    $oPayment->$sField = new oxField( "{$mxValue}" );
                }
            }
            $oPayment->save();
            $aPay[] = $oPayment->getId();
        }
        return $aPay;
    }

    /**
     * Creates voucherserie and it's vouchers
     * @param array $aVoucherSeries voucherserie and voucher data
     *
     * @return array of voucher id's
     */
    protected function _setVouchers( $aVoucherSeries )
    {
        if ( empty( $aVoucherSeries ) ) {
            return false;
        }
        $aVoucherIDs = array();
        foreach ( $aVoucherSeries as $aVoucherSerie ) {
            $oVoucherSerie = oxNew( 'oxbase' );
            $oVoucherSerie->init( 'oxvoucherseries' );
            foreach( $aVoucherSerie as $sKey => $mxValue ) {
                $sField = "oxvoucherseries__" . $sKey;
                $oVoucherSerie->$sField = new oxField( $mxValue, oxField::T_RAW);
            }
            $oVoucherSerie->save();
            // inserting vouchers
            for ( $i = 1; $i <= $aVoucherSerie['voucher_count']; $i++ ) {
                $oVoucher = oxNew( 'oxvoucher' );
                $oVoucher->oxvouchers__oxreserved = new oxField( 0, oxField::T_RAW );
                $oVoucher->oxvouchers__oxvouchernr = new oxField( md5( uniqid( rand(), true ) ), oxField::T_RAW );
                $oVoucher->oxvouchers__oxvoucherserieid = new oxField( $oVoucherSerie->getId(), oxField::T_RAW );
                $oVoucher->save();
                $aVoucherIDs[] = $oVoucher->getId();
            }
        }
        return $aVoucherIDs;
    }
    
    protected function _getDefaultUserData()
    {
        $aUser = array (
                'oxrights'       => 'malladmin',
                'oxactive'       => '1',
                'oxusername'     => 'admin',
                'oxpassword'     => 'f6fdffe48c908deb0f4c3bd36c032e72',
                'oxpasssalt'     => '61646D696E',
                'oxcompany'      => 'Your Company Name',
                'oxfname'        => 'John',
                'oxlname'        => 'Doe',
                'oxstreet'       => 'Maple Street',
                'oxstreetnr'     => '10',
                'oxcity'         => 'Any City',
                'oxcountryid'    => 'a7c40f631fc920687.20179984',
                'oxzip'          => '9041',
                'oxfon'          => '217-8918712',
                'oxfax'          => '217-8918713',
                'oxstateid'      => null,
                'oxaddinfo'      => null,
                'oxustid'        => null,
                'oxsal'          => 'MR',
                'oxustidstatus'  => '0'
        );
        return $aUser;
    }
    
    /**
     * Getting articles
     * @param array $aArts of article objects
     *
     * @return created articles id's 
     */
    public function getArticles( $aArts )
    {
        return $this->_getArticles( $aArts );    
    }
    
    /**
     * Set options
     * @param array $aOptions of config options
     */
    public function setOptions( $aOptions )
    {
        $oConfig = oxRegistry::getConfig();
        if ( !empty( $aOptions['config'] ) ) {
            foreach ( $aOptions['config'] as $sKey => $sValue ) {
                $oConfig->setConfigParam( $sKey, $sValue );
            }
        }
        if ( $aOptions['activeCurrencyRate'] ) {
            // load active currencies, change if set option
            $aCurrencies = $oConfig->getConfigParam( "aCurrencies" );
            $aCurrencies[0] =  "EUR@ " . $aOptions['activeCurrencyRate'] . "@ ,@ .@ €@ 2";
            $oConfig->setConfigParam( "aCurrencies", $aCurrencies );
            $aCurrencies = $oConfig->getConfigParam( "aCurrencies" );
        }
    }
    
    /**
     * Apply discounts
     * @param array $aDiscounts of discount data
     */
    public function setDiscounts( $aDiscounts )
    {
        $this->_setDiscounts( $aDiscounts );
    }
}