<?php

namespace CiscoSystems\PiwikBundle\Exception;

/**
 * Description of Exception
 */
class Exception extends \Exception
{
    public function __construct( $message )
    {
        $message = 'Piwik API error: ' . $message;

        parent::__construct( $message );
    }
}