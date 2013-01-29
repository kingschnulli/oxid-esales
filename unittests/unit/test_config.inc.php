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
 * @package   tests
 * @copyright (C) OXID eSales AG 2003-2011
 * @version OXID eShop CE
 * @version   SVN: $Id: test_config.inc.php 42273 2012-02-15 08:37:18Z vilma $
 */

// DO NOT TOUCH THIS _ INSTEAD FIX NOTICES - DODGER
error_reporting( (E_ALL ^ E_NOTICE) | E_STRICT );
ini_set('display_errors', true);

define ('OXID_PHP_UNIT', true);

$_sOverridenShopBasePath = null;
function overrideGetShopBasePath($sPath)
{
    global $_sOverridenShopBasePath;
    $_sOverridenShopBasePath = $sPath;
}

function getShopBasePath()
{
    global $_sOverridenShopBasePath;
    if (isset($_sOverridenShopBasePath)) {
        return $_sOverridenShopBasePath;
    }
    return oxPATH;
}

function getTestsBasePath()
{
    return realpath(dirname(__FILE__).'/../');
}

require_once 'test_utils.php';

// Generic utility method file.
require_once getShopBasePath() . 'core/oxfunctions.php';

oxConfig::getInstance();

/**
 * Useful for defining custom time
 */
class modOxUtilsDate extends oxUtilsDate
{
    protected $_sTime = null;

    public function UNITSetTime($sTime)
    {
        $this->_sTime = $sTime;
    }

    public function getTime()
    {
        if (!is_null($this->_sTime))
            return $this->_sTime;

        return parent::getTime();
    }
}

// Utility class
require_once getShopBasePath() . 'core/oxutils.php';

// Standard class
require_once getShopBasePath() . 'core/oxstdclass.php';

// Database managing class.
require_once getShopBasePath() . 'core/adodblite/adodb.inc.php';

// Session managing class.
require_once getShopBasePath() . 'core/oxsession.php';

// Database session managing class.
// included in session file if needed - require_once( getShopBasePath() . 'core/adodb/session/adodb-session.php');

// DB managing class.
//require_once( getShopBasePath() . 'core/adodb/drivers/adodb-mysql.inc.php');
require_once getShopBasePath() . 'core/oxconfig.php';

function initDbDump()
{
    static $done = false;
    if ($done) {
        throw new Exception("init already done");
    }
    if (file_exists('unit/dbMaintenance.php')) {
        include_once 'unit/dbMaintenance.php';
    } else {
        include_once 'dbMaintenance.php';
    }
    $dbM = new dbMaintenance();
    $dbM->dumpDB();
    $done = true;
}
initDbDump();
