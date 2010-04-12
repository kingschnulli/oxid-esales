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
 * @copyright (C) OXID eSales AG 2003-2010
 * @version OXID eShop CE
 * @version   SVN: $Id: oxorderarticle.php 26878 2010-03-26 12:44:47Z vilma $
 */

/**
 * Order article manager.
 * Performs copying of article.
 * @package core
 */
class oxOrderArticle extends oxBase implements oxIArticle
{
    /**
     * Current class name
     *
     * @var string
     */
    protected $_sClassName = 'oxorderarticle';

    /**
     * Persisten info
     *
     * @var array
     */
    protected $_aPersParam = null;

    /**
     * ERP status info
     *
     * @var array
     */
    protected $_aStatuses = null;

    /**
     * ERP status info
     *
     * @deprecated use $_aStatuses instead
     *
     * @var array
     */
    public $aStatuses = null;

    /**
     * Persisten info
     *
     * @deprecated use $_aPersParam instead
     *
     * @var array
     */
    public $aPersParam = null;

    /**
     * Total brutto price
     *
     * @deprecated
     *
     * @var string
     */
    public $ftotbrutprice = null;

    /**
     * Brutto price
     *
     * @deprecated
     *
     * @var string
     */
    public $fbrutprice = null;

    /**
     * Netto price
     *
     * @deprecated
     *
     * @var string
     */
    public $fnetprice = null;

    /**
     * Order article selection list
     *
     * @var array
     */
    protected $_aOrderArticleSelList = null;

    /**
     * Order article instance
     *
     * @var oxarticle
     */
    protected $_oOrderArticle = null;

    /**
     * New order article marker
     *
     * @var bool
     */
    protected $_blIsNewOrderItem = false;

    /**
     * Class constructor, initiates class constructor (parent::oxbase()).
     */
    public function __construct()
    {
        parent::__construct();
        $this->init( 'oxorderarticles' );
    }

    /**
     * Copies passed to method product into $this.
     *
     * @param object $oProduct product to copy
     *
     * @return null
     */
    public function copyThis( $oProduct )
    {
        $aObjectVars = get_object_vars( $oProduct );

        foreach ( $aObjectVars as $sName => $sValue ) {
            if ( isset( $oProduct->$sName->value ) ) {
                $sFieldName = preg_replace('/oxarticles__/', 'oxorderarticles__', $sName);
                $this->$sFieldName = $oProduct->$sName;
            }
        }

    }

    /**
     * Assigns DB field values to object fields.
     *
     * @param string $dbRecord DB record
     *
     * @return null
     */
    public function assign( $dbRecord )
    {
        parent::assign( $dbRecord );
        $this->_setDeprecatedValues();
        $this->_setArticleParams();
    }

    /**
     * Performs stock modification for current order article. Additionally
     * executes changeable article onChange/updateSoldAmount methods to
     * update chained data
     *
     * @param double $dAddAmount           amount which will be substracled from value in db
     * @param bool   $blAllowNegativeStock amount allow or not negative stock value
     *
     * @return null
     */
    public function updateArticleStock( $dAddAmount = null, $blAllowNegativeStock = null )
    {
        // decrement stock if there is any
        $oArticle = oxNew( 'oxarticle' );
        $oArticle->load( $this->oxorderarticles__oxartid->value );
        $oArticle->beforeUpdate();

        // get real article stock count
        $iStockCount = $this->_getArtStock( $dAddAmount, $blAllowNegativeStock );
        $oDb = oxDb::getDb();

        // #874A. added oxarticles.oxtimestamp = oxarticles.oxtimestamp to keep old timestamp value
        $oArticle->oxarticles__oxstock = new oxField($iStockCount);
        $oDb->execute( 'update oxarticles set oxarticles.oxstock = '.$oDb->quote( $iStockCount ).' where oxarticles.oxid = '.$oDb->quote( $this->oxorderarticles__oxartid->value ) );
        $oArticle->onChange( ACTION_UPDATE_STOCK );

        //update article sold amount
        $oArticle->updateSoldAmount( $dAddAmount * ( -1 ) );
    }

    /**
     * Adds or substracts defined amount passed by param from arcticle stock
     *
     * @param double $dAddAmount           amount which will be added/substracled from value in db
     * @param bool   $blAllowNegativeStock allow/disallow negative stock value
     *
     * @return double
     */
    protected function _getArtStock( $dAddAmount = null, $blAllowNegativeStock = null )
    {
        $oDb = oxDb::getDb();

        // #1592A. must take real value
        $sQ = 'select oxstock from oxarticles where oxid = '.$oDb->quote( $this->oxorderarticles__oxartid->value );
        $iStockCount  = ( float ) $oDb->getOne( $sQ );

        $iStockCount += $dAddAmount;

        // #1592A. calculating according new stock option
        if ( !$blAllowNegativeStock && $iStockCount < 0 ) {
            $iStockCount = 0;
        }

        return $iStockCount;
    }


    /**
     * Order persistent data getter
     *
     * @return array
     */
    public function getPersParams()
    {
        if ( $this->_aPersParam != null ) {
            return $this->_aPersParam;
        }

        if ( $this->oxorderarticles__oxpersparam->value ) {
            $this->_aPersParam = unserialize( $this->oxorderarticles__oxpersparam->value );
        }

        return $this->_aPersParam;
    }

    /**
     * Order persistent params setter
     *
     * @param array $aParams array of params
     *
     * @return null
     */
    public function setPersParams( $aParams )
    {
        $this->_aPersParam = $aParams;

        // serializing persisten info stored while ordering
        $this->oxorderarticles__oxpersparam = new oxField(serialize( $aParams ), oxField::T_RAW);
    }

    /**
     * Sets deprecate values
     *
     * @deprecated This method as well as all deprecated class variables is deprecated
     *
     * @return null
     */
    protected function _setDeprecatedValues()
    {

        $this->aPersParam = $this->getPersParams();

        if ( $this->oxorderarticles__oxstorno->value != 1 ) {
            $oLang = oxLang::getInstance();
            $this->ftotbrutprice = $oLang->formatCurrency( $this->oxorderarticles__oxbrutprice->value );
            $this->fbrutprice    = $oLang->formatCurrency( $this->oxorderarticles__oxbprice->value );
            $this->fnetprice     = $oLang->formatCurrency( $this->oxorderarticles__oxnprice->value );
        }
    }

    /**
     * Sets data field value
     *
     * @param string $sFieldName index OR name (eg. 'oxarticles__oxtitle') of a data field to set
     * @param string $sValue     value of data field
     * @param int    $iDataType  field type
     *
     * @return null
     */
    protected function _setFieldData( $sFieldName, $sValue, $iDataType = oxField::T_TEXT)
    {
        $sFieldName = strtolower($sFieldName);
        switch ( $sFieldName ) {
            case 'oxpersparam':
            case 'oxorderarticles__oxpersparam':
            case 'oxerpstatus':
            case 'oxorderarticles__oxerpstatus':
            case 'oxtitle':
            case 'oxorderarticles__oxtitle':
                $iDataType = oxField::T_RAW;
                break;
        }
        return parent::_setFieldData($sFieldName, $sValue, $iDataType);
    }

    /**
     * Executes oxOrderArticle::load() and returns its result
     *
     * @param int    $iLanguage language id
     * @param string $sOxid     order article id
     *
     * @return bool
     */
    public function loadInLang( $iLanguage, $sOxid )
    {
        return $this->load( $sOxid );
    }

    /**
     * Returns ordered article id, implements iBaseArticle interface getter method
     *
     * @return string
     */
    public function getProductId()
    {
        return $this->oxorderarticles__oxartid->value;
    }

    /**
     * Returns product parent id (oxparentid)
     *
     * @return string
     */
    public function getProductParentId()
    {
        // when this field will be introduced there will be no need to load from real article
        if ( isset( $this->oxorderarticles__oxartparentid ) && $this->oxorderarticles__oxartparentid->value !== false ) {
            return $this->oxorderarticles__oxartparentid->value;
        }

        $oDb = oxDb::getDb();
        $oArticle = oxNew( "oxarticle" );
        $sQ = "select oxparentid from " . $oArticle->getViewName() . " where oxid=" . $oDb->quote( $this->getProductId() );
        $this->oxarticles__oxparentid = new oxField( $oDb->getOne( $sQ ) );
        return $this->oxarticles__oxparentid->value;
    }

    /**
     * Sets article parameters to current object, so this object can be used for basket calculation
     *
     * @return null
     */
    protected function _setArticleParams()
    {
        // creating needed fields
        $this->oxarticles__oxstock  = $this->oxorderarticles__oxamount;
        $this->oxarticles__oxtitle  = $this->oxorderarticles__oxtitle;
        $this->oxarticles__oxwidth  = $this->oxorderarticles__oxwidth;
        $this->oxarticles__oxlength = $this->oxorderarticles__oxlength;
        $this->oxarticles__oxheight = $this->oxorderarticles__oxheight;
        $this->oxarticles__oxweight = $this->oxorderarticles__oxweight;
        $this->oxarticles__oxsubclass  = $this->oxorderarticles__oxsubclass;
        $this->oxarticles__oxartnum    = $this->oxorderarticles__oxartnum;
        $this->oxarticles__oxshortdesc = $this->oxorderarticles__oxshortdesc;

        $this->oxarticles__oxvat    = $this->oxorderarticles__oxvat;
        $this->oxarticles__oxprice  = $this->oxorderarticles__oxprice;
        $this->oxarticles__oxbprice = $this->oxorderarticles__oxbprice;

        $this->oxarticles__oxthumb = $this->oxorderarticles__oxthumb;
        $this->oxarticles__oxpic1  = $this->oxorderarticles__oxpic1;
        $this->oxarticles__oxpic2  = $this->oxorderarticles__oxpic2;
        $this->oxarticles__oxpic3  = $this->oxorderarticles__oxpic3;
        $this->oxarticles__oxpic4  = $this->oxorderarticles__oxpic4;
        $this->oxarticles__oxpic5  = $this->oxorderarticles__oxpic5;

        $this->oxarticles__oxfile     = $this->oxorderarticles__oxfile;
        $this->oxarticles__oxdelivery = $this->oxorderarticles__oxdelivery;
        $this->oxarticles__oxissearch = $this->oxorderarticles__oxissearch;
        $this->oxarticles__oxfolder   = $this->oxorderarticles__oxfolder;
        $this->oxarticles__oxtemplate = $this->oxorderarticles__oxtemplate;
        $this->oxarticles__oxexturl   = $this->oxorderarticles__oxexturl;
        $this->oxarticles__oxurlimg   = $this->oxorderarticles__oxurlimg;
        $this->oxarticles__oxurldesc  = $this->oxorderarticles__oxurldesc;
        $this->oxarticles__oxshopid   = $this->oxorderarticles__oxordershopid;
        $this->oxarticles__oxquestionemail = $this->oxorderarticles__oxquestionemail;
        $this->oxarticles__oxsearchkeys    = $this->oxorderarticles__oxsearchkeys;
    }

    /**
     * Returns true, implements iBaseArticle interface method
     *
     * @param double $dAmount         stock to check
     * @param double $dArtStockAmount stock amount
     *
     * @return bool
     */
    public function checkForStock( $dAmount, $dArtStockAmount = 0 )
    {
        return true;
    }

    /**
     * Loads, caches and returns real order article instance. If article is not
     * available (deleted from db or so) false is returned
     *
     * @param string $sArticleId article id (optional, is not passed oxorderarticles__oxartid will be used)
     *
     * @return oxarticle | false
     */
    protected function _getOrderArticle( $sArticleId = null )
    {
        if ( $this->_oOrderArticle === null ) {
            $this->_oOrderArticle = false;

            $sArticleId = $sArticleId ? $sArticleId : $this->getProductId();
            $oArticle = oxNew( "oxArticle" );
            if ( $oArticle->load( $sArticleId ) ) {
                $this->_oOrderArticle = $oArticle;
            }
        }
        return $this->_oOrderArticle;
    }

    /**
     * Returns article select lists, implements iBaseArticle interface method
     *
     * @param string $sKeyPrefix prefix (not used)
     *
     * @return array
     */
    public function getSelectLists( $sKeyPrefix = null )
    {
        $aSelLists = array();
        if ( $oArticle = $this->_getOrderArticle() ) {
            $aSelLists = $oArticle->getSelectLists();
        }
        return $aSelLists;
    }

    /**
     * Returns order article selection list array
     *
     * @param string $sArtId           ordered article id [optional]
     * @param string $sOrderArtSelList order article selection list [optional]
     *
     * @return array
     */
    public function getOrderArticleSelectList( $sArtId = null, $sOrderArtSelList = null )
    {
        if ( $this->_aOrderArticleSelList === null ) {

            $sOrderArtSelList = $sOrderArtSelList ? $sOrderArtSelList : $this->oxorderarticles__oxselvariant->value;

            $aList = array();
            $aRet  = array();

            if ( $oArticle = $this->_getOrderArticle( $sArtId ) ) {
                $aList = explode( ",", $sOrderArtSelList );
                $oStr = getStr();

                $aArticleSelList = $oArticle->getSelectLists();

                //formating temporary list array from string
                foreach ( $aList as $sList ) {
                    if ( $sList ) {

                        $aVal = explode( ":", $sList );
                        if ( isset($aVal[0]) && isset($aVal[1])) {
                            $sOrderArtListTitle = $oStr->strtolower( trim($aVal[0]) );
                            $sOrderArtSelValue  = $oStr->strtolower( trim($aVal[1]) );

                            //checking article list for matches with article list stored in oxorderitem
                            $iSelListNum = 0;
                            if ( count($aArticleSelList) > 0 ) {
                                foreach ( $aArticleSelList as $aSelect ) {
                                    //chek if selects titles are equal

                                    if ( $oStr->strtolower($aSelect['name']) == $sOrderArtListTitle ) {
                                        //try to find matching select items value
                                        $iSelValueNum = 0;
                                        foreach ( $aSelect as $oSel ) {
                                            if ( $oStr->strtolower($oSel->name) == $sOrderArtSelValue ) {
                                                // found, adding tu return array
                                                $aRet[$iSelListNum] = $iSelValueNum;
                                            }
                                            //next article list item
                                            $iSelValueNum++;
                                        }
                                    }
                                    //next article list
                                    $iSelListNum++;
                                }
                            }
                        }
                    }
                }
            }

            $this->_aOrderArticleSelList = $aRet;
        }

        return $this->_aOrderArticleSelList;
    }

    /**
     * Returns basket order article price
     *
     * @param double   $dAmount  basket item amount
     * @param array    $aSelList chosen selection list
     * @param oxbasket $oBasket  basket
     *
     * @return oxprice
     */
    public function getBasketPrice( $dAmount, $aSelList, $oBasket )
    {
        return $this->getPrice();
    }

    /**
     * Returns false, implements iBaseArticle interface method
     *
     * @return bool
     */
    public function skipDiscounts()
    {
        return false;
    }

    /**
     * Returns empty array, implements iBaseArticle interface getter method
     *
     * @param bool $blActCats   select categories if all parents are active
     * @param bool $blSkipCache force reload or not (default false - no reload)
     *
     * @return array
     */
    public function getCategoryIds( $blActCats = false, $blSkipCache = false )
    {
        $aCatIds = array();
        if ( $oOrderArticle = $this->_getOrderArticle() ) {
            $aCatIds = $oOrderArticle->getCategoryIds( $blActCats, $blSkipCache );
        }
        return $aCatIds;
    }

    /**
     * Returns current session language id
     *
     * @return int
     */
    public function getLanguage()
    {
        return oxLang::getInstance()->getBaseLanguage();
    }

    /**
     * Returns base article price from database
     *
     * @param double $dAmount article amount. Default is 1
     *
     * @return double
     */
    public function getBasePrice( $dAmount = 1 )
    {
        return $this->getPrice();
    }

    /**
     * Returns order article unit price
     *
     * @return oxprice
     */
    public function getPrice()
    {
        $oBasePrice = oxNew( 'oxPrice' );
        // prices in db are ONLY brutto
        $oBasePrice->setBruttoPriceMode();
        $oBasePrice->setVat( $this->oxorderarticles__oxvat->value );
        $oBasePrice->setPrice( $this->oxorderarticles__oxbprice->value );

        return $oBasePrice;
    }

    /**
     * Marks object as new order item (this marker useful when recalculating stocks after order recalculation)
     *
     * @param bool $blIsNew marker value - TRUE if this item is newy added to order
     *
     * @return null
     */
    public function setIsNewOrderItem( $blIsNew )
    {
        $this->_blIsNewOrderItem = $blIsNew;
    }

    /**
     * Returns TRUE if current order article is newly added to order
     *
     * @return bool
     */
    public function isNewOrderItem()
    {
        return $this->_blIsNewOrderItem;
    }

    /**
     * Ordered article stock setter. Before setting new stock value additionally checks for
     * original article stock value. Is stock values <= preferred, adjusts order stock according
     * to it
     *
     * @param int $iNewAmount new ordered items amount
     *
     * @return null
     */
    public function setNewAmount( $iNewAmount )
    {
        if ( $iNewAmount >= 0 ) {
            // to update stock we must first check if it is possible - article exists?
            $oArticle = oxNew( "oxarticle" );
            if ( $oArticle->load( $this->oxorderarticles__oxartid->value ) ) {

                // updating stock info
                $iStockChange = $iNewAmount - $this->oxorderarticles__oxamount->value;
                if ( $iStockChange > 0 && ( $iOnStock = $oArticle->checkForStock( $iStockChange ) ) !== false ) {
                    if ( $iOnStock !== true ) {
                        $iStockChange = $iOnStock;
                        $iNewAmount   = $this->oxorderarticles__oxamount->value + $iStockChange;
                    }
                }

                $this->updateArticleStock( $iStockChange * -1, $this->getConfig()->getConfigParam( 'blAllowNegativeStock' ) );

                // updating self
                $this->oxorderarticles__oxamount = new oxField ( $iNewAmount, oxField::T_RAW );
                $this->save();
            }
        }
    }

    /**
     * Returns true if object is derived from oxorderarticle class
     *
     * @return bool
     */
    public function isOrderArticle()
    {
        return true;
    }


   /**
    * Sets order article storno value to 1 and if stock control is on -
    * restores previous oxarticle stock state
    *
    * @return null
    */
   public function cancelOrderArticle()
   {
        if ( $this->oxorderarticles__oxstorno->value == 0 ) {
            $myConfig = $this->getConfig();
            $this->oxorderarticles__oxstorno->setValue( 1 );
            if ( $this->save() && $myConfig->getConfigParam( 'blUseStock' ) ) {
                $this->updateArticleStock( $this->oxorderarticles__oxamount->value, $myConfig->getConfigParam('blAllowNegativeStock') );
            }
        }
   }

    /**
     * Deletes order article object. If deletion succeded - updates
     * article stock information. Returns deletion status
     *
     * @param string $sOXID Article id
     *
     * @return bool
     */
   public function delete( $sOXID = null)
   {
       if ( $blDelete = parent::delete( $sOXID ) ) {
           $myConfig = $this->getConfig();
           if ( $myConfig->getConfigParam( 'blUseStock' ) && $this->oxorderarticles__oxstorno->value != 1 ) {
               $this->updateArticleStock( $this->oxorderarticles__oxamount->value, $myConfig->getConfigParam('blAllowNegativeStock') );
           }
       }
       return $blDelete;
   }

   /**
    * Saves order article object. If saving succeded - updates
    * article stock information if oxOrderArticle::isNewOrderItem()
    * returns TRUE. Returns saving status
    *
    * @return bool
    */
   public function save()
   {
       // ordered articles
       if ( ( $blSave = parent::save() ) && $this->isNewOrderItem() ) {
           $myConfig = $this->getConfig();
           if ( $myConfig->getConfigParam( 'blUseStock' ) ) {
               $this->updateArticleStock( $this->oxorderarticles__oxamount->value * (-1), $myConfig->getConfigParam( 'blAllowNegativeStock' ) );
           }
       }

       return $blSave;
   }

   /**
    * get used wrapping
    *
    * @return oxWrapping
    */
   public function getWrapping()
   {
       if ($this->oxorderarticles__oxwrapid->value) {
           $oWrapping = oxNew('oxwrapping');
           if ($oWrapping->load($this->oxorderarticles__oxwrapid->value)) {
               return $oWrapping;
           }
       }
       return null;
   }
}