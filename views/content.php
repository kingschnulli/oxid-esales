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
 * @copyright (C) OXID eSales AG 2003-2009
 * $Id: content.php 16306 2009-02-05 10:28:05Z rimvydas.paskevicius $
 */

/**
 * CMS - loads pages and displays it
 */
class Content extends oxUBase
{
    /**
     * Content id.
     * @var string
     */
    protected $_sContentId = null;

    /**
     * Content object
     * @var object
     */
    protected $_oContent = null;

    /**
     * Current view template
     * @var string
     */
    protected $_sThisTemplate = 'content.tpl';

    /**
     * Current view plain template
     * @var string
     */
    protected $_sThisPlainTemplate = 'content_plain.tpl';

    /**
     * Current view content category (if available)
     * @var oxcontent
     */
     protected $_oContentCat = null;

    /**
     * Unsets SEO category and call parent::init();
     *
     * @return null
     */
    public function init()
    {
        if ( oxUtils::getInstance()->seoIsActive() ) {
            // cleaning category id tracked by SEO
            $this->setSessionCategoryId( null );
        }

        parent::init();
    }

    /**
     * Returns prefix ID used by template engine.
     *
     * @return string    $this->_sViewId
     */
    public function getViewId()
    {
        if ( isset( $this->_sViewId ) ) {
            return $this->_sViewId;
        }
        return $this->_sViewId = parent::getViewId().'|'.oxConfig::getParameter( 'tpl' );
    }

    /**
     * Executes parent::render(), passes template variables to
     * template engine and generates content. Returns the name
     * of template to render content::_sThisTemplate
     *
     * Template variables:
     * <b>tpl</b>, <b>oContent</b>
     *
     * @return  string  $this->_sThisTemplate   current template file name
     */
    public function render()
    {
        parent::render();

        $this->_aViewData['tpl'] = $this->getContentId();
        $this->_aViewData['oContent'] = $this->getContent();

        // generating meta info
        $this->setMetaDescription( $this->getContent()->oxcontents__oxtitle->value, 200, true );
        $this->setMetaKeywords( $this->getContent()->oxcontents__oxtitle->value );

        // sometimes you need to display plain templates (e.g. when showing popups)
        if ( $this->showPlainTemplate() ) {
            $this->_sThisTemplate = $this->_sThisPlainTemplate;
        }
        return $this->_sThisTemplate;
    }

    /**
     * If current content is assigned to category returns its object
     *
     * @return oxcontent
     */
    public function getContentCategory()
    {
    	if ( $this->_oContentCat === null ) {
            // setting default status ..
            $this->_oContentCat = false;
            if ( ( $oContent = $this->getContent() ) && $oContent->oxcontents__oxtype->value == 2 ) {
                $this->_oContentCat = $oContent;
            }
        }
        return $this->_oContentCat;
    }

    /**
     * Returns true if user forces to display plain template
     *
     * @return bool
     */
    public function showPlainTemplate()
    {
    	return (bool) oxConfig::getParameter( 'plain' );
    }

    /**
     * Returns active content id to load its seo meta info
     *
     * @return string
     */
    protected function _getSeoObjectId()
    {
        return oxConfig::getParameter( 'tpl' );
    }

    /**
     * Template variable getter. Returns active content id
     *
     * @return object
     */
    public function getContentId()
    {
        if ( $this->_oContentId === null ) {
            $this->_oContentId = false;
            $sContentId = oxConfig::getParameter( 'tpl' );
            $oContent   = oxNew( 'oxcontent' );
            if ( $oContent->load( $sContentId ) && $oContent->oxcontents__oxactive->value ) {
                $this->_oContentId = $sContentId;
                $this->_oContent = $oContent;
            }
        }
        return $this->_oContentId;
    }

    /**
     * Template variable getter. Returns active content
     *
     * @return object
     */
    public function getContent()
    {
        if ( $this->_oContent === null ) {
            $this->_oContent = false;
            if ( $this->getContentId() ) {
                return $this->_oContent;
            }
        }
        return $this->_oContent;
    }

    /**
     * returns object, assosiated with current view.
     * (the object that is shown in frontend)
     *
     * @return object
     */
    protected function getSubject()
    {
        return $this->getContent();
    }
}