<?php

namespace CiscoSystems\PiwikBundle\Connection;

use Buzz\Browser;
use Buzz\Client;
use Buzz\Message\Request;
use Buzz\Message\Response;

class Request
{
    protected $url;
    protected $request;
    protected $response;

    public function __construct( $url, Request $request )
    {
        $this->url = $url;
        $this->request = $request->setHost( $url );
        $this->response = new Response();
    }

    /**
     * Make API request
     *
     * @param string $method
     */
    public function request( $method, $params = array() )
    {
        $url = $this->parseUrl( $method, $params );
        // 	var_dump($url);
        $handle = curl_init();
        curl_setopt( $handle, CURLOPT_URL, $url );
        curl_setopt( $handle, CURLOPT_CONNECTTIMEOUT, 5 );
        curl_setopt( $handle, CURLOPT_RETURNTRANSFER, 1 );
        $buffer = curl_exec( $handle );
        curl_close( $handle );
        $request = ( !empty( $buffer ) ) ? $this->parseRequest( $buffer ) : false;

        return $this->finishRequest( $request, $method, $params );
    }

    /**
     * Validate request and return the values
     *
     * @param obj $request
     * @param string $method
     * @param array $params
     */
    public function finishRequest( $request, $method, $params )
    {
        $valid = $this->validRequest( $request );

        if( $valid === true )
        {
            return ( isset( $request->value ) ) ? $request->value : $request;
        }
        else
        {
            $request = $this->addError( $valid . ' (' . $this->parseUrl( $method, $params ) . ')' );
            return false;
        }
    }

    /**
     * Create request url with parameters
     *
     * @param string $method The request method
     * @param array $params Request params
     */
    public function parseUrl( $method, array $params = array() )
    {
        $params = array_merge( $params, array(
            'module'        => 'API',
            'method'        => $method,
            'token_auth'    => $this->token,
            'idSite'        => $this->siteId,
            'period'        => $this->period,
            'format'        => $this->format,
            'language'      => $this->language,
        ));

        $params['date'] = ( $this->period != self::PERIOD_RANGE ) ?
                $this->date :
                $this->rangeStart . ',' . $this->rangeEnd;

        $url = $this->site;

        $i = 0;
        foreach( $params as $key => $val )
        {
            if( !empty( $val ) )
            {
                $i++;
                $url .= ( $i > 1 ) ? '&' : '?';
                if( is_array( $val ) ) { $val = implode( ',', $val ); }
                $url .= $key . '=' . $val;
            }
        }

        return $url;
    }

    /**
     * Validate the request result
     *
     * @param obj $request
     */
    public function validRequest( $request )
    {
        if( ($request !== false) and ( !is_null( $request )) )
        {
            if( !isset( $request->result ) or ( $request->result != 'error') )
            {
                return true;
            }
            return $request->message;
        }

        return ( is_null( $request ) ) ?
                self::ERROR_EMPTY : self::ERROR_INVALID;
    }

    /**
     * Parse request result
     *
     * @param obj $request
     */
    public function parseRequest( $request )
    {
        switch( $this->format )
        {
            case self::FORMAT_JSON:
                if( strpos( $request, '{' ) != 0 ) return $request;
                return json_decode( $request );
            default:
                return $request;
        }
    }
}