<?php

namespace CiscoSystems\PiwikBundle\Service;

use CiscoSystems\PiwikBundle\Connection\ConnectionInterface;
use CiscoSystems\PiwikBundle\Exception\Exception;

/**
 * Description of Client
 */
class Client
{
    protected $connection;
    protected $token;

    /**
     * Initialize Piwik client.
     *
     * @param ConnectionInterface $connection Piwik active connection
     * @param string              $token      auth token
     */
    public function __construct( ConnectionInterface $connection, $token = 'anonymous' )
    {
        $this->connection = $connection;
        $this->token = $token;
    }

    /**
     * Set Piwik API token.
     *
     * @param string $token auth token
     */
    public function setToken( $token )
    {
        $this->token = $token;
    }

    /**
     * Call specific method & return it's response.
     *
     * @param string $method method name
     * @param array  $params method parameters
     * @param string $format return format (php, json, xml, csv, tsv, html, rss)
     *
     * @return mixed
     */
    public function call( $method, $params = array(), $format = 'original' )
    {
        $params['method'] = $method;
        $params['token_auth'] = $this->token;
        $params['format'] = $format;

        $data = $this->getConnection()->send( $params );

        ladybug_dump_die( $data );

        if( 'php' === $format )
        {
            $object = unserialize( $data );
            if( isset( $object['result'] ) && 'error' === $object['result'] )
            {
                throw new Exception( $object['message'] );
            }

            return $object;
        }

        return $data;
    }

    /**
     * Return active connection.
     *
     * @return ConnectionInterface
     */
    public function getConnection()
    {
        return $this->connection;
    }
}