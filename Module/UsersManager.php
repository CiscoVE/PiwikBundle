<?php

namespace CiscoSystems\PiwikBundle\Module;

use CiscoSystems\PiwikBundle\Connection\Request;
use CiscoSystems\PiwikBundle\Module\Module as Base;

/**
 * MODULE: USER MANAGER
 * Manage piwik users
 * Description of User
 *
 * @author tam
 */
class UsersManager extends Base
{
    const MODULE_NAME = 'UsersManager';

    public function __construct( Request $request, $name )
    {
        parent::__construct( $request, self::MODULE_NAME );
    }

    protected function getData( $query, $params = array() )
    {
        return $this->request( $this->parseUrl( self::MODULE_NAME . $query, $params ) );
    }
}