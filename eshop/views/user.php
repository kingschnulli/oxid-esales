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
 * @package   views
 * @copyright (C) OXID eSales AG 2003-2011
 * @version OXID eShop CE
 * @version   SVN: $Id: user.php 33011 2011-02-07 16:35:45Z vilma $
 */

/**
 * User details.
 * Collects and arranges user object data (information, like shipping address, etc.).
 */
class User extends oxUBase
{
    /**
     * Current class template.
     * @var string
     */
    protected $_sThisTemplate = 'page/checkout/user.tpl';

    /**
     * Order step marker
     * @var bool
     */
    protected $_blIsOrderStep = true;

    /**
     * Revers of option blOrderDisWithoutReg
     * @var array
     */
    protected $_blShowNoRegOpt = null;

    /**
     * Selected Address
     * @var object
     */
    protected $_sSelectedAddress = null;

    /**
     * Login option
     * @var integer
     */
    protected $_iOption = null;

    /**
     * Country list
     * @var object
     */
    protected $_oCountryList = null;

    /**
     * Order remark
     * @var string
     */
    protected $_sOrderRemark = null;

    /**
     * Wishlist user id
     * @var string
     */
    protected $_sWishId = null;

    /**
     * Loads customer basket object form session (oxsession::getBasket()),
     * passes action article/basket/country list to template engine. If
     * available - loads user delivery address data (oxaddress). If user
     * is connected using Facebook connect calls user::_fillFormWithFacebookData to
     * prefill form data with data taken from user Facebook account. Returns
     * name template file to render user::_sThisTemplate.
     *
     * @return  string  $this->_sThisTemplate   current template file name
     */
    public function render()
    {
        $myConfig = $this->getConfig();

        if ( $this->getIsOrderStep() ) {
            if ($myConfig->getConfigParam( 'blPsBasketReservationEnabled' )) {
                $this->getSession()->getBasketReservations()->renewExpiration();
            }

            $oBasket = $this->getSession()->getBasket();
            if ( $this->_blIsOrderStep && $myConfig->getConfigParam( 'blPsBasketReservationEnabled' ) && (!$oBasket || ( $oBasket && !$oBasket->getProductsCount() )) ) {
                oxUtils::getInstance()->redirect( $myConfig->getShopHomeURL() .'cl=basket' );
            }
        }

        parent::render();

        if ( $myConfig->getConfigParam( "bl_showFbConnect" ) && !$this->getUser() ) {
             $this->_fillFormWithFacebookData();
        }

        return $this->_sThisTemplate;
    }

    /**
     * Checks if product from wishlist is added
     *
     * @return $sWishId
     */
    protected function _getWishListId()
    {
        $this->_sWishId = null;
        // check if we have to set it here
        $oBasket = $this->getSession()->getBasket();
        foreach ( $oBasket->getContents() as $oBasketItem ) {
            if ( $this->_sWishId = $oBasketItem->getWishId() ) {
                // stop on first found
                break;
            }
        }
        return $this->_sWishId;
    }

    /**
     * Template variable getter. Returns reverse option blOrderDisWithoutReg
     *
     * @return bool
     */
    public function getShowNoRegOption()
    {
        if ( $this->_blShowNoRegOpt === null ) {
            $this->_blShowNoRegOpt = !$this->getConfig()->getConfigParam( 'blOrderDisWithoutReg' );
        }
        return $this->_blShowNoRegOpt;
    }

    /**
     * Template variable getter. Returns user login option
     *
     * @return integer
     */
    public function getLoginOption()
    {
        if ( $this->_iOption === null ) {
            // passing user chosen option value to display correct content
            $iOption = oxConfig::getParameter( 'option' );
            // if user chosen "Option 2"" - we should show user details only if he is authorized
            if ( $iOption == 2 && !$this->getUser() ) {
                $iOption = 0;
            }
            $this->_iOption = $iOption;
        }
        return $this->_iOption;
    }

    /**
     * Template variable getter. Returns country list
     *
     * @return object
     */
    public function getCountryList()
    {
        if ( $this->_oCountryList === null ) {
            $this->_oCountryList = false;
            // passing country list
            $oCountryList = oxNew( 'oxcountrylist' );
            $oCountryList->loadActiveCountries();
            if ( $oCountryList->count() ) {
                $this->_oCountryList = $oCountryList;
            }
        }
        return $this->_oCountryList;
    }

    /**
     * Template variable getter. Returns order remark
     *
     * @return string
     */
    public function getOrderRemark()
    {
        if ( $this->_sOrderRemark === null ) {
            $this->_sOrderRemark = false;
            if ( $sOrderRemark = oxSession::getVar( 'ordrem' ) ) {
                $this->_sOrderRemark = oxConfig::checkSpecialChars( $sOrderRemark );
            } elseif ( $sOrderRemark = oxConfig::getParameter( 'order_remark' ) ) {
                $this->_sOrderRemark = $sOrderRemark;
            }
        }
        return $this->_sOrderRemark;
    }

    /**
     * Template variable getter. Returns if user subscribed for newsletter
     *
     * @return bool
     */
    public function isNewsSubscribed()
    {
        if ( $this->_blNewsSubscribed === null ) {
            $blNews = false;
            if ( ( $blNews = oxConfig::getParameter( 'blnewssubscribed' ) ) === null ) {
                $blNews = false;
            }
            if ( ( $oUser = $this->getUser() ) ) {
                $blNews = $oUser->getNewsSubscription()->getOptInStatus();
            }
            $this->_blNewsSubscribed = $blNews;
        }

        if (is_null($this->_blNewsSubscribed))
            $this->_blNewsSubscribed = false;

        return  $this->_blNewsSubscribed;
    }

    /**
     * Template variable getter. Checks to show or not shipping address entry form
     *
     * @return bool
     */
    public function showShipAddress()
    {
        return oxSession::getVar( 'blshowshipaddress' );
    }

    /**
     * Fills user form with date taken from Facebook
     *
     * @return null
     */
    protected function _fillFormWithFacebookData()
    {
        // Create our Application instance.
        $oFacebook = oxFb::getInstance();

        if ( $oFacebook->isConnected() ) {
            $aMe  = $oFacebook->api('/me');

            $aInvAdr = $this->getInvoiceAddress();
            $sCharset = oxLang::getInstance()->translateString( "charset" );

            // do not stop converting on error - just try to translit unknown symbols
            $sCharset .= '//TRANSLIT';

            if ( !$aInvAdr["oxuser__oxfname"] ) {
                $aInvAdr["oxuser__oxfname"] = iconv( 'UTF-8', $sCharset, $aMe["first_name"] );
            }

            if ( !$aInvAdr["oxuser__oxlname"] ) {
                $aInvAdr["oxuser__oxlname"] = iconv( 'UTF-8', $sCharset, $aMe["last_name"] );
            }

            $this->setInvoiceAddress( $aInvAdr );
        }
    }

    /**
     * Returns Bread Crumb - you are here page1/page2/page3...
     *
     * @return array
     */
    public function getBreadCrumb()
    {
        $aPaths = array();
        $aPath = array();

        $aPath['title'] = oxLang::getInstance()->translateString( 'PAGE_CHECKOUT_USER', oxLang::getInstance()->getBaseLanguage(), false );
        $aPaths[] = $aPath;

        return $aPaths;
    }
}
