<?php

namespace CiscoSystems\PiwikBundle\Connection;

use CiscoSystems\PiwikBundle\Exception\Exception as PiwikException;
use Buzz\Browser;
use Buzz\Client\Curl;

/**
 * Piwik HTTP Connector.
 */
class HttpConnection extends PiwikConnection
{
    protected $browser;
    protected $url;

    /**
     * Initialize client.
     *
     * @param string  $url  base API URL
     * @param Browser $browser Buzz Browser instance (optional)
     */
    public function __construct( $url, Browser $browser = null )
    {
        $this->browser = ( null === $browser ) ?
                new Browser( new Curl() ) :
                $browser;

        $this->url = $url;
    }

    /**
     * {@inheritdoc}
     */
    public function send( array $params = array() )
    {
        $params['module'] = 'API';

        $url = $this->url . '?' . $this->convertParamsToQuery( $params );

//        ladybug_dump_die( $url );

        $response =  $this->browser->get( $url );
        if ( !$response->isSuccessful() )
        {
            throw new PiwikException( sprintf( '"%s" returned an invalid status code: "%s"', $url, $response->getStatusCode()) );
        }

        return $response->getContent();
    }
}