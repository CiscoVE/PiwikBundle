<?php

namespace CiscoSystems\PiwikBundle\Tracker;

/**
 * Description of Request
 *
 * @author tam
 */
class Request
{
    /**
     * Make API request
     *
     * @param string $method
     */
    private function request( $method, $params = array() )
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
    private function finishRequest( $request, $method, $params )
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
    private function parseUrl( $method, array $params = array() )
    {
        $params = array(
            'module'        => 'API',
            'method'        => $method,
            'token_auth'    => $this->_token,
            'idSite'        => $this->_siteId,
            'period'        => $this->_period,
            'format'        => $this->_format,
            'language'      => $this->_language,
                ) + $params;

        if( $this->_period != self::PERIOD_RANGE )
        {
            $params = $params + array(
                'date' => $this->_date,
            );
        }
        else
        {
            $params = $params + array(
                'date' => $this->_rangeStart . ',' . $this->_rangeEnd,
            );
        }

        $url = $this->_site;

        $i = 0;
        foreach( $params as $param => $val )
        {
            if( !empty( $val ) )
            {
                $i++;
                if( $i > 1 ) $url .= '&';
                else $url .= '?';

                if( is_array( $val ) ) $val = implode( ',', $val );
                $url .= $param . '=' . $val;
            }
        }

        return $url;
    }

    /**
     * Validate the request result
     *
     * @param obj $request
     */
    private function validRequest( $request )
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
    private function parseRequest( $request )
    {
        switch( $this->_format )
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
    private function addError( $msg = '' )
    {
        $this->_errors = $this->_errors + array( $msg );
    }
}