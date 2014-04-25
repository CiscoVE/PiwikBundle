<?php

namespace CiscoSystems\PiwikBundle\Connection;

/**
 * Description of Request
 *
 * @author tam
 */
class Request
{
    protected $method;

    public function __construct( $method )
    {
        $this->method = $method;
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

        if( !empty( $buffer ) ) $request = $this->parseRequest( $buffer );
        else $request = false;

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
            if( isset( $request->value ) ) return $request->value;
            else
            {
                return $request;
            }
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
                if( $i > 1 ) $url .= '&';
                else $url .= '?';

                if( is_array( $val ) ) $val = implode( ',', $val );
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

        if( is_null( $request ) )
        {
            return self::ERROR_EMPTY;
        }
        else
        {
            return self::ERROR_INVALID;
        }
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
                break;
            default:
                return $request;
        }
    }

    /**
     * Add error
     *
     * @param string $msg Error message
     */
    public function addError( $msg = '' )
    {
        $this->errors = $this->errors + array( $msg );
    }
}