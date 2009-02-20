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
 * @copyright � OXID eSales AG 2003-2009
 * $Id: oxerptype_crossselling.php 16000 2009-01-28 15:27:22Z rimvydas.paskevicius $
 */

require_once( 'oxerptype.php');

class oxERPType_Crossselling extends oxERPType
{
    public function __construct()
    {
        parent::__construct();

        $this->_sTableName = 'oxobject2article';

        $this->_aFieldList = array(
            'OXOBJECTID'	 => 'OXOBJECTID',
            'OXARTICLENID'	 => 'OXARTICLENID',
            'OXSORT'		 => 'OXSORT',
            'OXID'		     => 'OXID'
        );

        $this->_aKeyFieldList = array(
            'OXARTICLENID' => 'OXARTICLENID',
            'OXOBJECTID'   => 'OXOBJECTID'
        );
    }
}