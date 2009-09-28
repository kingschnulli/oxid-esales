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
 * @version OXID eShop CE
 * $Id: start.php 20551 2009-06-30 12:04:07Z arvydas $
 */

/**
 * Starting shop page.
 * Shop starter, manages starting visible articles, etc.
 */
class IndexController  extends oxUBase
{
    /**
     * Current class template name.
     * @var string
     */
    protected $_sThisTemplate = 'start.tpl';

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
     * ZF index Action
     *
     */
    public function indexAction()
    {
        return $this->render();
    }

    /**
     * Executes parent::render(), loads action articles
     * (oxarticlelist::loadAktionArticles()). Returns name of
     * template file to render.
     *
     * Template variables:
     * <b>articlelist</b>, <b>firstarticle</b>, <b>toparticlelist</b>,
     * <b>articlebargainlist</b>
     *
     * @return  string  cuurent template file name
     */
    public function render()
    {

        startProfile('Simple ZF element');
        $figlet = new Zend_Text_Figlet();
        echo "<pre>";
        echo $figlet->render('oxZend');
        echo "</pre>";

        //class with required subclasses
        set_include_path(getShopBasePath(). "/core/");
        $form = new Zend_Form_Element('labas');
        //it's 0.05575s	3.56%
        stopProfile('Simple ZF element');

        parent::render();

        return $this->_sThisTemplate;
    }
}