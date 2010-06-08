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
 * @version   SVN: $Id: oxbasketreservation.php 28089 2010-06-02 13:49:19Z sarunas $
 */

/**
 * Basket reservations handler class
 *
 * @package core
 */
class oxBasketReservation extends oxSuperCfg
{
    protected $_oReservations = null;
    protected $_aCurrentlyReserved = null;


    /**
     * return the ID of active resevations user basket
     *
     * @return string
     */
    protected function _getReservationsId()
    {
        $sId = $this->getSession()->getVar('basketReservationToken');
        if (!$sId) {
            $sId = oxUtilsObject::getInstance()->generateUID();
            $this->getSession()->setVar('basketReservationToken', $sId);
        }
        return $sId;
    }

    /**
     * load reservation or create new reservation oxuserbasket
     *
     * @param string $sBasketId basket id for this userbasket
     * 
     * @return oxuserbasket
     */
    protected function _loadReservations($sBasketId)
    {
        $oReservations = oxNew( 'oxuserbasket' );
        $aWhere = array( 'oxuserbaskets.oxuserid' => $sBasketId, 'oxuserbaskets.oxtitle' => 'reservations' );

        // creating if it does not exist
        if ( !$oReservations->assignRecord( $oReservations->buildSelectString( $aWhere ) ) ) {
            $oReservations->oxuserbaskets__oxtitle  = new oxField('reservations');
            $oReservations->oxuserbaskets__oxuserid = new oxField($sBasketId);
            // marking basket as new (it will not be saved in DB yet)
            $oReservations->setIsNewBasket();
        }
        return $oReservations;
    }

    /**
     * get reservations collection
     * 
     * @return oxUserBasket
     */
    public function getReservations()
    {
        if ($this->_oReservations) {
            return $this->_oReservations;
        }

        if (!$sBasketId = $this->_getReservationsId()) {
            return null;
        }

        $this->_oReservations = $this->_loadReservations($sBasketId);

        return $this->_oReservations;
    }

    /**
     * return currently reserved items in an array format array (artId => amount)
     *
     * @return array
     */
    protected function _getReservedItems()
    {
        if (isset($this->_aCurrentlyReserved)) {
            return $this->_aCurrentlyReserved;
        }

        $oReserved = $this->getReservations();
        if (!$oReserved) {
            return array();
        }

        $this->_aCurrentlyReserved = array();
        foreach ( $oReserved->getItems() as $oItem ) {
            if (!isset($this->_aCurrentlyReserved[$oItem->oxuserbasketitems__oxartid->value])) {
                $this->_aCurrentlyReserved[$oItem->oxuserbasketitems__oxartid->value] = 0;
            }
            $this->_aCurrentlyReserved[$oItem->oxuserbasketitems__oxartid->value] += $oItem->oxuserbasketitems__oxamount->value;
        }
        return $this->_aCurrentlyReserved;
    }

    /**
     * return currently reserved amount for an article
     *
     * @param string $sArticleId article id
     *
     * @return double
     */
    public function getReservedAmount($sArticleId)
    {
        $aCurrentlyReserved = $this->_getReservedItems();
        if (isset($aCurrentlyReserved[$sArticleId])) {
            return $aCurrentlyReserved[$sArticleId];
        }
        return 0;
    }

    /**
     * compute difference of reserved amounts vs basket items
     *
     * @param oxBasket $oBasket basket object
     *
     * @return array
     */
    protected function _basketDifference(oxBasket $oBasket)
    {
        $aDiff = $this->_getReservedItems();
        // refreshing history
        foreach ( $oBasket->getContents() as $oItem ) {
            $sProdId = $oItem->getProductId();
            if (!isset($aDiff[$sProdId])) {
                $aDiff[$sProdId] = -$oItem->getAmount();
            } else {
                $aDiff[$sProdId] -= $oItem->getAmount();
            }
        }
        return $aDiff;
    }

    /**
     * reserve articles given the basket difference array
     *
     * @param array $aBasketDiff basket difference array
     *
     * @see oxBasketReservation::_basketDifference
     * 
     * @return null
     */
    protected function _reserveArticles($aBasketDiff)
    {
        $blAllowNegativeStock = $this->getConfig()->getConfigParam( 'blAllowNegativeStock' );
        $oDb = oxDb::getDb();

        $oReserved = $this->getReservations();
        foreach ($aBasketDiff as $sId => $dAmount) {
            if ($dAmount != 0) {
                $oArticle = oxNew('oxarticle');
                if ($oArticle->load($sId)) {
                    $dReducedAmount = $oArticle->reduceStock(-$dAmount, $blAllowNegativeStock);
                    $oReserved->addItemToBasket( $sId, $dReducedAmount );
                }
            }
        }
        $this->_aCurrentlyReserved = null;
    }

    /**
     * reserve given basket items
     *
     * @param oxBasket $oBasket basket object
     *
     * @return null
     */
    public function reserveBasket(oxBasket $oBasket)
    {
        $this->_reserveArticles( $this->_basketDifference($oBasket) );
    }

    /**
     * commit reservation of given article amount
     * deletes this amount from active reservations userBasket,
     * update sold amount
     *
     * @param string $sArticleId article id
     * @param double $dAmount    amount to use
     *
     * @return null
     */
    public function commitArticleReservation($sArticleId, $dAmount)
    {
        $dReserved = $this->getReservedAmount($sArticleId);

        if ($dReserved < $dAmount) {
            $dAmount = $dReserved;
        }

        $oArticle = oxNew( 'oxarticle' );
        $oArticle->load( $sArticleId );

        $this->getReservations()->addItemToBasket($sArticleId, -$dAmount);
        $oArticle->beforeUpdate();
        $oArticle->updateSoldAmount( $dAmount );
        $this->_aCurrentlyReserved = null;
    }

    /**
     * discard one article reservation
     * return the reserved stock to article
     *
     * @param string $sArticleId article id
     *
     * @return null
     */
    public function discardArticleReservation($sArticleId)
    {
        $dReserved = $this->getReservedAmount($sArticleId);
        if ($dReserved) {
            $oArticle = oxNew('oxarticle');
            if ($oArticle->load($sArticleId)) {
                $oArticle->reduceStock(-$dReserved, true);
                $this->getReservations()->addItemToBasket($sArticleId, 0, null, true);
                $this->_aCurrentlyReserved = null;
            }
        }
    }

    /**
     * discard all reserved articles
     *
     * @return null
     */
    public function discardReservations()
    {
        foreach ( array_keys($this->_getReservedItems()) as $sArticleId) {
            $this->discardArticleReservation($sArticleId);
        }
    }

    /**
     * periodic cleanup: discards timed out reservations
     *
     * @param int $iTimeout timout in seconds
     *
     * @return null
     */
    public function discardUnusedReservations($iTimeout)
    {
//TODO
    }
}
