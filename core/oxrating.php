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
 * @copyright � OXID eSales AG 2003-2008
 * $Id: oxrating.php 13617 2008-10-24 09:38:46Z sarunas $
 */

/**
 * Article rate manager.
 * Performs loading, updating, inserting of article rates.
 * @package core
 */
class oxRating extends oxbase
{
    /**
     * Shop control variable
     *
     * @var string
     */
    protected $_blDisableShopCheck = true;

    /**
     * Current class name
     *
     * @var string
     */
    protected $_sClassName = 'oxrating';

    /**
     * Class constructor, initiates parent constructor (parent::oxBase()).
     */
    public function __construct()
    {
        parent::__construct();
        $this->init( 'oxratings' );
    }

    /**
     * Inserts object data fiels in DB. Returns true on success.
     *
     * @return bool
     */
    protected function _insert()
    {
        // set oxcreate
        $this->oxratings__oxtimestamp= new oxField(date( 'Y-m-d H:i:s', oxUtilsDate::getInstance()->getTime() ));

        return parent::_insert();
    }
    /**
     * Inserts object data fiels in DB. Returns true on success.
     *
     * @param string $sUserId   user id
     * @param string $sType     object type
     * @param string $sObjectId object id
     *
     * @return bool
     */
    public function allowRating( $sUserId, $sType, $sObjectId)
    {
        $oDB = oxDb::getDb();
        $myConfig = oxConfig::getInstance();
        if ( $iRatingLogsTimeout = $myConfig->getConfigParam( 'iRatingLogsTimeout' ) ) {
            $sExpDate = date( 'Y-m-d H:i:s', oxUtilsDate::getInstance()->getTime() - $iRatingLogsTimeout*24*60*60);
            $oDB->execute( "delete from oxratings where oxtimestamp < '$sExpDate'" );
        }
        $sSelect = "select oxid from oxratings where oxuserid = '$sUserId' and oxtype='$sType' and oxobjectid = '$sObjectId'";
        if( $oDB->getOne( $sSelect ) ) {
            return false;
        }

        return true;
    }

}
