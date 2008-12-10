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
 * @package views
 * @copyright � OXID eSales AG 2003-2008
 * $Id: register.php 13614 2008-10-24 09:36:52Z sarunas $
 */

/**
 * User registration window.
 * Collects and arranges user object data (information, like shipping address, etc.).
 */
class Register extends user
{
    /**
     * Current class template.
     *
     * @var string
     */
    protected $_sThisTemplate = 'register.tpl';

    /**
     * Successful registration confirmation template
     *
     * @var string
     */
    protected $_sSuccessTemplate = 'register_success.tpl';

    /**
     * Array of fields which must be filled during registration
     *
     * @var array
     */
    protected $_aMustFillFields = null;

    /**
     * Current view search engine indexing state:
     *     0 - index without limitations
     *     1 - no index / no follow
     *     2 - no index / follow
     */
    protected $_iViewIndexState = 1;

    /**
     * Executes parent::render(), passes error code to template engine,
     * returns name of template to render register::_sThisTemplate.
     *
     * @return string   current template file name
     */
    public function render()
    {
        parent::render();

        // checking registration status
        if ( $this->getRegistrationStatus() ) {

            //for older templates
            $this->_aViewData['error']   = $this->getRegistrationError();
            $this->_aViewData['success'] = $this->getRegistrationStatus();

            return $this->_sSuccessTemplate;
        }

        $this->_aViewData['aMustFillFields'] = $this->getMustFillFields();

        return $this->_sThisTemplate;
    }

    /**
     * Returns registration error code (if it was set)
     *
     * @return int | null
     */
    public function getRegistrationError()
    {
        return oxConfig::getParameter( 'newslettererror' );
    }

    /**
     * Return registration status (if it was set)
     *
     * @return int | null
     */
    public function getRegistrationStatus()
    {
        return oxConfig::getParameter( 'success' );
    }

    /**
     * Returns array of fields which must be filled during registration
     *
     * @return array | bool
     */
    public function getMustFillFields()
    {
        if ( $this->_aMustFillFields === null ) {
            $this->_aMustFillFields = false;

            // passing must-be-filled-fields info
            $aMustFillFields = $this->getConfig()->getConfigParam( 'aMustFillFields' );
            if ( is_array( $aMustFillFields ) ) {
                $this->_aMustFillFields = array_flip( $aMustFillFields );
            }
        }
        return $this->_aMustFillFields;
    }
}