<?php

namespace CiscoSystems\PiwikBundle\Model;

use Buzz\Browser;
/**
 * derived from: https://github.com/VisualAppeal/Piwik-PHP-API
 */
class Client
{
    const ERROR_INVALID     = 10;
    const ERROR_EMPTY       = 11;

    const PERIOD_DAY        = 'day';
    const PERIOD_WEEK       = 'week';
    const PERIOD_MONTH      = 'month';
    const PERIOD_YEAR       = 'year';
    const PERIOD_RANGE      = 'range';

    const DATE_TODAY        = 'today';
    const DATE_YESTERDAY    = 'yesterday';

    const FORMAT_XML        = 'xml';
    const FORMAT_JSON       = 'json';
    const FORMAT_CSV        = 'csv';
    const FORMAT_TSV        = 'tsv';
    const FORMAT_HTML       = 'html';
    const FORMAT_PHP        = 'php';
    const FORMAT_RSS        = 'rss';
    const FORMAT_ORIGINAL   = 'original';

    protected $site         = '';
    protected $token        = '';
    protected $siteId       = 0;
    protected $format       = self::FORMAT_PHP;
    protected $formats      = array(
        self::FORMAT_CSV,
        self::FORMAT_HTML,
        self::FORMAT_JSON,
        self::FORMAT_ORIGINAL,
        self::FORMAT_PHP,
        self::FORMAT_RSS,
        self::FORMAT_TSV,
        self::FORMAT_XML
    );
    protected $language     = 'en';
    protected $period       = self::PERIOD_DAY;
    protected $periods      = array(
        self::PERIOD_DAY,
        self::PERIOD_MONTH,
        self::PERIOD_WEEK,
        self::PERIOD_YEAR
    );
    protected $date         = '';
    protected $rangeStart   = self::DATE_YESTERDAY;
    protected $rangeEnd     = null;
    protected $limit        = '';
    protected $errors       = array();
    protected $charset      = 'utf-8';
    protected $mimeType     = '';
    protected $mimeTypes    = array(
        'json'  => 'application/json',
        'xml'   => 'application/xml',
        'tsv'   => 'text/tab-separated-values'
    );

    function __construct(
            $site,
            $token,
            $siteId,
            $format = self::FORMAT_JSON,
            $period = self::PERIOD_DAY,
            $date = self::DATE_YESTERDAY,
            $rangeStart = '',
            $rangeEnd = null
    )
    {
        $this->site         = $site;
        $this->token        = $token;
        $this->siteId       = $siteId;
        $this->format       = $format;
        $this->period       = $period;
        $this->rangeStart   = $rangeStart;
        $this->rangeEnd     = $rangeEnd;

        !empty( $rangeStart ) ?
            $this->setRange( $rangeStart, $rangeEnd ) :
            $this->setDate( $date );
    }

    public function getSite()
    {
        return $this->site;
    }

    public function setSite( $url )
    {
        $this->site = $url;
    }

    public function getToken()
    {
        return $this->token;
    }

    public function setToken( $token )
    {
        $this->token = $token;
    }

    public function getSiteId()
    {
        return intval( $this->siteId );
    }

    public function setSiteId( $id )
    {
        $this->siteId = $id;
    }

    public function getFormat()
    {
        return $this->format;
    }

    public function setFormat( $format )
    {
        $this->format = $format;
    }

    public function getLanguage()
    {
        return $this->language;
    }

    public function setLanguage( $language )
    {
        $this->language = $language;
    }

    public function getDate()
    {
        return $this->date;
    }

    public function setDate( $date )
    {
        $this->date = $date;
    }

    public function getPeriod()
    {
        return $this->period;
    }

    public function setPeriod( $period )
    {
        $this->period = $period;
    }

    public function getRange()
    {
        return 'from ' . $this->rangeStart . ' until '
                . ( ( empty( $this->rangeEnd ) ) ? 'today' : $this->rangeEnd );
    }

    public function setRange( $rangeStart, $rangeEnd = null )
    {
        $this->date = '';
        $this->rangeStart = $rangeStart;
        $this->rangeEnd = $rangeEnd;

        if( is_null( $rangeEnd ) )
        {
            $this->date = $rangeStart;
        }
    }

    public function getLimit()
    {
        return intval( $this->limit );
    }

    public function setLimit( $limit )
    {
        $this->limit = $limit;
    }

    public function getCharset()
    {
        return $this->charset;
    }

    public function setCharset( $charset )
    {
        $this->charset = $charset;
    }

    public function getMimeType()
    {
        return $this->mimeType;
    }

    public function setMimeType( $mimeType )
    {
        $this->mimeType = $mimeType;
    }

    public function reset()
    {
        $this->period = self::PERIOD_DAY;
        $this->date = '';
        $this->rangeStart = 'yesterday';
        $this->rangeEnd = null;

        $this->errors = array();
    }

    public function getModule( $name )
    {
        return new Module( $this, $name );
    }

    public function request( $method, $params = array() )
    {
        $url = $this->parseUrl( $method, $params );

        $browser  = new Browser() ;
        $response = $browser->get( $url );

        $contentType = $response->getHeader( 'Content-Type' );

        ladybug_dump_die( explode( '; ', $contentType ) );

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

    public function parseUrl( $method, array $params = array() )
    {
        $params = count( $params ) > 0 ? $params[0] : $params;
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

    public function parseRequest( $request )
    {
        return ( $this->format === self::FORMAT_JSON ) ?
                json_decode( $request ) : $request;


//        switch( $this->format )
//        {
//            case self::FORMAT_JSON:
//                return ( strpos( $request, '{' ) != 0 ) ? $request : json_decode( $request );
//            default:
//                return $request;
//        }
    }

    private function addError( $msg = '' )
    {
        $this->errors = $this->errors + array( $msg );
    }

    public function hasError()
    {
        return ( count( $this->errors ));
    }

    public function getErrors()
    {
        return $this->errors;
    }
}