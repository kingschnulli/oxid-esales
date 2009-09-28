<?php
/**
 * #PHPHEADER_OXID_LICENSE_INFORMATION#
 *
 * @link http://www.oxid-esales.com
 * @package core
 * @copyright (c) oxid eSales GmbH 2003-#OXID_VERSION_YEAR#
 * $Id: oxsupercfg.php 21460 2009-08-05 16:28:33Z tomas $
 */

/**
 * Super config class
 * @package core
 */
class oxZFSuperCfg extends Zend_Controller_Action
{
    /**
     * oxconfig instance
     *
     * @var oxconfig
     */
    protected static $_oConfig = null;

    /**
     * oxsession instance
     *
     * @var oxsession
     */
    protected static $_oSession = null;

    /**
     * oxrights instance
     *
     * @var oxrights
     */
    protected static $_oRights = null;

    /**
     * oxuser object
     *
     * @var oxuser
     */
    protected static $_oActUser = null;

    /**
     * Admin mode marker
     *
     * @var bool
     */
    protected static $_blIsAdmin = null;

    /**
     * Only used for convenience in UNIT tests by doing so we avoid
     * writing extended classes for testing protected or private methods
     *
     * @param string $sMethod Methods name
     * @param array  $aArgs   Argument array
     *
     * @throws oxSystemComponentException Throws an exception if the called method does not exist or is not accessable in current class
     *
     * @return string
     */
    public function __call( $sMethod, $aArgs )
    {
        if ( defined( 'OXID_PHP_UNIT' ) ) {
            if ( substr( $sMethod, 0, 4) == "UNIT" ) {
                $sMethod = str_replace( "UNIT", "_", $sMethod );
            }
            if ( method_exists( $this, $sMethod)) {
                return call_user_func_array( array( & $this, $sMethod ), $aArgs );
            }
        }

        throw new oxSystemComponentException( "Function '$sMethod' does not exist or is not accessible! (" . get_class($this) . ")".PHP_EOL);
    }

    /**
     * Class constructor. The constructor is defined in order to be possible to call parent::__construct() in modules.
     *
     * @return null;
     */
	public function __construct()
	{
	}

    /**
     * oxConfig instance getter
     *
     * @return oxconfig
     */
    public function getConfig()
    {
        if ( defined( 'OXID_PHP_UNIT' ) ) {
            if ( isset( $this->unitCustModConf ) ) {
                return $this->unitCustModConf;
            }
            return oxConfig::getInstance();
        }

        if ( self::$_oConfig == null ) {
            self::$_oConfig = oxConfig::getInstance();
        }

        return self::$_oConfig;
    }

    /**
     * oxConfig instance setter
     *
     * @param oxconfig $oConfig config object
     *
     * @return null
     */
    public function setConfig( $oConfig )
    {
        if ( defined( 'OXID_PHP_UNIT' ) ) {
            $this->unitCustModConf = $oConfig;
            return;
        }

        self::$_oConfig = $oConfig;
    }

    /**
     * oxSession instance getter
     *
     * @return oxsession
     */
    public function getSession()
    {
        if ( defined( 'OXID_PHP_UNIT' ) ) {
            if ( isset( $this->unitCustModSess ) ) {
                return $this->unitCustModSess;
            }
            return oxSession::getInstance();
        }

        if ( self::$_oSession == null ) {
            self::$_oSession = oxSession::getInstance();
        }

        return self::$_oSession;
    }

    /**
     * oxSession instance setter
     *
     * @param oxsession $oSession session object
     *
     * @return null
     */
    public function setSession( $oSession )
    {
        if ( defined( 'OXID_PHP_UNIT' ) ) {
            $this->unitCustModSess = $oSession;
            return;
        }

        self::$_oSession = $oSession;
    }

    /**
     * Active user getter
     *
     * @return oxuser
     */
    public function getUser()
    {
        if ( defined( 'OXID_PHP_UNIT' ) ) {
            if ( isset( $this->unitCustModUser ) ) {
                return $this->unitCustModUser;
            }
            $oUser = oxNew( 'oxuser' );
            if ( $oUser->loadActiveUser() ) {
                return $oUser;
            }
            return false;
        }

        if ( self::$_oActUser == null ) {
            $oUser = oxNew( 'oxuser' );
            if ( $oUser->loadActiveUser() ) {
                self::$_oActUser = $oUser;
            }
        }

        return self::$_oActUser;
    }

    /**
     * Active oxuser object setter
     *
     * @param oxuser $oUser user object
     *
     * @return null
     */
    public function setUser( $oUser )
    {
        if ( defined( 'OXID_PHP_UNIT' ) ) {
            $this->unitCustModUser = $oUser;
            return;
        }

        self::$_oActUser = $oUser;
    }

    /**
     * Admin mode status getter
     *
     * @return bool
     */
    public function isAdmin()
    {
        if ( self::$_blIsAdmin === null ) {
            self::$_blIsAdmin = isAdmin();
        }

        return self::$_blIsAdmin;
    }

    /**
     * Admin mode setter
     *
     * @param bool $blAdmin admin mode
     *
     * @return null
     */
    public function setAdminMode( $blAdmin )
    {
        if ( OXID_VERSION_EE ) :
            // resetting rights object
            self::$_oRights = null;
        endif;
        self::$_blIsAdmin = $blAdmin;
    }

    /* if ( OXID_VERSION_EE ) : */
    /**
     * Rights manager getter
     *
     * @return oxrights
     */
    public function getRights()
    {
        $iMode = (int) $this->getConfig()->getConfigParam( 'blUseRightsRoles' );
        if ( $iMode && self::$_oRights == null ) {
            if ( $this->isAdmin() && ( $iMode & 1 ) ) { // checking if back-end RR control is on
                self::$_oRights = oxNew ( 'oxadminrights' );
                self::$_oRights->load();
            } elseif (  !$this->isAdmin() && $iMode & 2 ) { // checking if front-end RR control is on
                self::$_oRights = oxNew ( 'oxrights' );
                self::$_oRights->load();
            }
        }

        return self::$_oRights;
    }

    /**
     * Rights manager setter
     *
     * @param oxrights $oRight rihts manager object
     *
     * @return null
     */
    public function setRights( $oRight )
    {
        self::$_oRights = $oRight;
    }
    /* endif; */
}