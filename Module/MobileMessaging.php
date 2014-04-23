<?php

namespace CiscoSystems\PiwikBundle\Module;

use CiscoSystems\PiwikBundle\Connection\Request;
use CiscoSystems\PiwikBundle\Module\AbstractModule as Base;

/**
 * MODULE: MobileMessaging
 *
 * The MobileMessaging API lets you manage and access all the MobileMessaging
 * plugin features including :
 *  - manage SMS API credential
 *  - activate phone numbers
 *  - check remaining credits
 *  - send SMS
 */
class MobileMessaging extends Base
{
    public function __construct( Request $request )
    {
        parent::__construct( $request, 'MobileMessaging' );
    }

    /**
     * Checks if SMSAPI has been configured
     *
     * @return mixed
     */
    public function areSMSAPICredentialProvided()
    {
        $this->setQuery( 'areSMSAPICredentialProvided' );

        return $this->execute();
    }

    /**
     * Get
     *
     * @return mixed
     */
    public function getSMSProvider()
    {
        $this->setQuery( 'getSMSProvider' );

        return $this->execute();
    }

    /**
     * Set SMSAPI credentials
     *
     * @param string $provider
     * @param string $apiKey
     * @return mixed
     */
    public function setSMSAPICredential( $provider, $apiKey )
    {
        $this->setQuery( 'setSMSAPICredential' );
        $this->setParameters( array(
            'provider'  => $provider,
            'apiKey'    => $apiKey,
        ));

        return $this->execute();
    }

    /**
     * Add phone number
     *
     * @param string $phoneNumber
     * @return mixed
     */
    public function addPhoneNumber( $phoneNumber )
    {
        $this->setQuery( 'addPhoneNumber' );
        $this->setParameters( array(
            'phoneNumber'   => $phoneNumber,
        ));

        return $this->execute();
    }

    /**
     * Get credits left
     *
     * @return mixed
     */
    public function getCreditLeft()
    {
        $this->setQuery( 'getCreditLeft' );

        return $this->execute();
    }

    /**
     * Remove phone number
     *
     * @param string $phoneNumber
     * @return mixed
     */
    public function removePhoneNumber( $phoneNumber )
    {
        $this->setQuery( 'removePhoneNumber' );
        $this->setParameters( array(
            'phoneNumber'   => $phoneNumber,
        ));

        return $this->execute();
    }

    /**
     * Validate phone number
     *
     * @param string $phoneNumber
     * @param string $verificationCode
     * @return mixed
     */
    public function validatePhoneNumber( $phoneNumber, $verificationCode )
    {
        $this->setQuery( 'validatePhoneNumber' );
        $this->setParameters( array(
            'phoneNumber'       => $phoneNumber,
            'verificationCode'  => $verificationCode,
        ));

        return $this->execute();
    }

    /**
     * Delete SMSAPI credentials
     *
     * @return mixed
     */
    public function deleteSMSAPICredential()
    {
        $this->setQuery( 'deleteSMSAPICredential' );

        return $this->execute();
    }
    /*     * *
     * Set unknown
     *
     * @param $delegatedManagement
     * @return mixed
     */

    public function setDelegatedManagement( $delegatedManagement )
    {
        $this->setQuery( 'setDelegatedManagement' );
        $this->setParameters( array(
            'delegatedManagement'   => $delegatedManagement,
        ));

        return $this->execute();
    }

    /**
     * Get unknown
     *
     * @return mixed
     */
    public function getDelegatedManagement()
    {
        $this->setQuery( 'getDelegatedManagement' );

        return $this->execute();
    }
}