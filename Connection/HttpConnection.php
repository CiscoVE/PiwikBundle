<?php

namespace CiscoSystems\PiwikBundle\Connection;

use CiscoSystems\PiwikBundle\Exception\Exception as PiwikException;
use Buzz\Browser;
use Buzz\Client\Curl;

/**
 * Description of HttpConnection
 *
 * @author tam
 */
class HttpConnection
{
    protected $browser;
    protected $apiUrl;

    /**
     * Initialize client.
     *
     * @param string  $apiUrl  base API URL
     * @param Browser $browser Buzz Browser instance (optional)
     */
    public function __construct( $apiUrl, Browser $browser = null )
    {
        $this->browser = ( null === $browser ) ?
                new Browser(new Curl()) :
                $browser;

        $this->apiUrl = $apiUrl;
    }

    /**
     * {@inheritdoc}
     */
    public function send( array $params = array() )
    {
        $params['module'] = 'API';

        $url = $this->apiUrl . '?' . $this->convertParamsToQuery( $params );

        $response =  $this->browser->get( $url );
        if ( !$response->isSuccessful() )
        {
            throw new PiwikException( sprintf( '"%s" returned an invalid status code: "%s"', $url, $response->getStatusCode()) );
        }

        return $response->getContent();
    }
}