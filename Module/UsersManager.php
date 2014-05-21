<?php

namespace CiscoSystems\PiwikBundle\Module;

use CiscoSystems\PiwikBundle\Connection\Request;
use CiscoSystems\PiwikBundle\Module\AbstractModule as Base;

/**
 * MODULE: USER MANAGER
 *
 * The UsersManager API lets you Manage Users and their permissions to access
 * specific websites. You can create users via "addUser", update existing users
 * via "updateUser" and delete users via "deleteUser". There are many ways to
 * list users based on their login "getUser" and "getUsers", their email
 * "getUserByEmail", or which users have permission (view or admin) to access
 * the specified websites "getUsersWithSiteAccess". Existing Permissions are
 * listed given a login via "getSitesAccessFromUser", or a website ID via
 * "getUsersAccessFromSite", or you can list all users and websites for a given
 * permission via "getUsersSitesFromAccess". Permissions are set and updated
 * via the method "setUserAccess". See also the documentation about Managing
 * Users in Piwik.
 */
class UsersManager extends Base
{
    public function __construct( Request $request )
    {
        parent::__construct( $request, 'UsersManager' );
    }

    public function setQuery( $query )
    {
        $this->query = $this->request->ParseUrl( $this->name . $query );
    }

    /**
     * Set user preference
     *
     * @param string $userLogin Username
     * @param string $preferenceName
     * @param string $preferenceValue
     */
    public function setUserPreference( $userLogin, $preferenceName, $preferenceValue )
    {
        $this->setQuery( 'setUserPreference' );
        $this->setParameters( array(
            'userLogin'         => $userLogin,
            'preferenceName'    => $preferenceName,
            'preferenceValue'   => $preferenceValue,
        ));

        return $this->execute();
    }

    /**
     * Get user preference
     *
     * @param string $userLogin Username
     * @param string $preferenceName
     */
    public function getUserPreference( $userLogin, $preferenceName )
    {
        $this->setQuery( 'getUserPreference' );
        $this->setParameters( array(
            'userLogin'         => $userLogin,
            'preferenceName'    => $preferenceName,
        ));

        return $this->execute();
    }

    /**
     * Get user by username
     *
     * @param array $userLogins Array with Usernames
     */
    public function getUsers( $userLogins = '' )
    {
        $this->setQuery( 'getUsers' );
        $this->setParameters( array(
            'userLogins' => $userLogins,
        ));

        return $this->execute();
    }

    /**
     * Get all user logins
     */
    public function getUsersLogin()
    {
        $this->setQuery( 'getUsersLogin' );

        return $this->execute();
    }

    /**
     * Get sites by user access
     *
     * @param string $access
     */
    public function getUsersSites( $access )
    {
        $this->setQuery( 'getUsersSitesFromAccess' );
        $this->setParameters( array(
            'access' => $access,
        ));

        return $this->execute();
    }

    /**
     * Get all users with access level from the current site
     */
    public function getUsersAccess()
    {
        $this->setQuery( 'getUsersAccessFromSite' );

        return $this->execute();
    }

    /**
     * Get all users with access $access to the current site
     *
     * @param string $access
     */
    public function getUsersWithSiteAccess( $access )
    {
        $this->setQuery( 'getUsersWithSiteAccess' );
        $this->setParameters( array(
            'access' => $access,
        ));

        return $this->execute();
    }

    /**
     * Get site access from the user $userLogin
     *
     * @param string $userLogin Username
     */
    public function getSitesAccessFromUser( $userLogin )
    {
        $this->setQuery( 'getSitesAccessFromUser' );
        $this->setParameters( array(
            'userLogin' => $userLogin,
        ));

        return $this->execute();
    }

    /**
     * Get user by login
     *
     * @param string $userLogin Username
     */
    public function getUser( $userLogin )
    {
        $this->setQuery( 'getUser' );
        $this->setParameters( array(
            'userLogin' => $userLogin,
        ));

        return $this->execute();
    }

    /**
     * Get user by email
     *
     * @param string $userEmail
     */
    public function getUserByEmail( $userEmail )
    {
        $this->setQuery( 'getUserByEmail' );
        $this->setParameters( array(
            'userEmail' => $userEmail,
        ));

        return $this->execute();
    }

    /**
     * Add a user
     *
     * @param string $userLogin Username
     * @param string $password Password in clear text
     * @param string $email
     * @param string $alias
     */
    public function addUser( $userLogin, $password, $email, $alias = '' )
    {
        $this->setQuery( 'addUser' );
        $this->setParameters( array(
            'userLogin' => $userLogin,
            'password'  => $password,
            'email'     => $email,
            'alias'     => $alias,
        ));

        return $this->execute();
    }

    public function setSuperUserAccess( $userLogin, $hasSuperUserAccess )
    {
        $this->setQuery( 'setSuperUserAccess' );
        $this->setParameters( array(
            'userLogin' => $userLogin,
            'hasSuperUserAccess' => $hasSuperUserAccess
        ));

        return $this->execute();
    }

    public function hasSuperUserAccess()
    {
        $this->setQuery( 'hasSuperUserAccess' );

        return $this->execute();
    }

    public function getUsersHavingSuperAccess( $userLogin, $hasSuperUserAccess )
    {
        $this->setQuery( 'getUsersHavingSuperAccess' );
        $this->setParameters( array(
            'userLogin' => $userLogin,
            'hasSuperUserAccess' => $hasSuperUserAccess
        ));

        return $this->execute();
    }

    /**
     * Update a user
     *
     * @param string $userLogin Username
     * @param string $password Password in clear text
     * @param string $email
     * @param string $alias
     */
    public function updateUser( $userLogin, $password = '', $email = '', $alias = '' )
    {
        $this->setQuery( 'updateUser' );
        $this->setParameters( array(
            'userLogin' => $userLogin,
            'password'  => $password,
            'email'     => $email,
            'alias'     => $alias,
        ));

        return $this->execute();
    }

    /**
     * Delete a user
     *
     * @param string $userLogin Username
     */
    public function deleteUser( $userLogin )
    {
        $this->setQuery( 'deleteUser' );
        $this->setParameters( array(
            'userLogin' => $userLogin,
        ));

        return $this->execute();
    }

    /**
     * Checks if a user exist
     *
     * @param string $userLogin
     */
    public function userExists( $userLogin )
    {
        $this->setQuery( 'userExists' );
        $this->setParameters( array(
            'userLogin' => $userLogin,
        ));

        return $this->execute();
    }

    /**
     * Checks if a user exist by email
     *
     * @param string $userEmail
     */
    public function userEmailExists( $userEmail )
    {
        $this->setQuery( 'userEmailExists' );
        $this->setParameters( array(
            'userEmail' => $userEmail,
        ));

        return $this->execute();
    }

    /**
     * Grant access to multiple sites
     *
     * @param string $userLogin Username
     * @param string $access
     * @param array $idSites
     */
    public function setUserAccess( $userLogin, $access, $idSites )
    {
        $this->setQuery( 'setUserAccess' );
        $this->setParameters( array(
            'userLogin'     => $userLogin,
            'access'        => $access,
            'idSites'       => $idSites,
        ));

        return $this->execute();
    }

    /**
     * Get the token for a user
     *
     * @param string $userLogin Username
     * @param string $md5Password Password in clear text
     */
    public function getTokenAuth( $userLogin, $md5Password )
    {
        $this->setQuery( 'getTokenAuth' );
        $this->setParameters( array(
            'userLogin' => $userLogin,
            'md5Password' => md5( $md5Password ),
        ));

        return $this->execute();
    }
}