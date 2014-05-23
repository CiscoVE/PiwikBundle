<?php

namespace CiscoSystems\PiwikBundle\Model;

/**

  Repository: https://github.com/VisualAppeal/Piwik-PHP-API
  Official api reference: http://piwik.org/docs/analytics-api/reference/

 */
class Piwik
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

    private $site       = '';
    private $token      = '';
    private $siteId     = 0;
    private $format     = self::FORMAT_PHP;
    protected $formats  = array(
        self::FORMAT_CSV,
        self::FORMAT_HTML,
        self::FORMAT_JSON,
        self::FORMAT_ORIGINAL,
        self::FORMAT_PHP,
        self::FORMAT_RSS,
        self::FORMAT_TSV,
        self::FORMAT_XML
    );
    private $language   = 'en';
    private $period     = self::PERIOD_DAY;
    private $periods    = array(
        self::PERIOD_DAY,
        self::PERIOD_MONTH,
        self::PERIOD_WEEK,
        self::PERIOD_YEAR
    );
    private $date       = '';
    private $rangeStart = self::DATE_YESTERDAY;
    private $rangeEnd   = null;
    private $limit      = '';
    private $errors     = array();

    /**
     * Create new instance
     *
     * @param string $site URL of the piwik installation
     * @param string $token API Access token
     * @param int $siteId ID of the site
     * @param string $format
     * @param string $period
     * @param string $date
     * @param string $rangeStart
     * @param string $rangeEnd
     */
    function __construct( $site, $token, $siteId, $format = self::FORMAT_JSON, $period = self::PERIOD_DAY, $date = self::DATE_YESTERDAY, $rangeStart = '', $rangeEnd = null )
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
    /**
     * Getter & Setter
     */

    /**
     * Get the url of the piwik installation
     *
     * @return string
     */
    public function getSite()
    {
        return $this->site;
    }

    /**
     * Set the URL of the piwik installation
     *
     * @param string $url
     */
    public function setSite( $url )
    {
        $this->site = $url;
    }

    /**
     * Get token
     *
     * @return string
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * Set token
     *
     * @param string $token
     */
    public function setToken( $token )
    {
        $this->token = $token;
    }

    /**
     * Get current site ID
     *
     * @return int
     */
    public function getSiteId()
    {
        return intval( $this->siteId );
    }

    /**
     * Set current site ID
     *
     * @param int $id
     */
    public function setSiteId( $id )
    {
        $this->siteId = $id;
    }

    /**
     * Get response format
     *
     * @return string
     */
    public function getFormat()
    {
        return $this->format;
    }

    /**
     * Set response format
     *
     * @param string $format
     * 		FORMAT_XML
     * 		FORMAT_JSON
     * 		FORMAT_CSV
     * 		FORMAT_TSV
     * 		FORMAT_HTML
     * 		FORMAT_RSS
     * 		FORMAT_PHP
     */
    public function setFormat( $format )
    {
        $this->format = $format;
    }

    /**
     * Get language
     *
     * @return string
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * Set language
     *
     * @param string $language
     */
    public function setLanguage( $language )
    {
        $this->language = $language;
    }

    /**
     * Get date
     *
     * @return string
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set date
     *
     * @param string $date
     * 		DATE_TODAY
     * 		DATE_YESTERDAY
     */
    public function setDate( $date )
    {
        $this->date = $date;
    }

    /**
     * Get  period
     *
     * @return string
     */
    public function getPeriod()
    {
        return $this->period;
    }

    /**
     * Set time period
     *
     * @param string $period
     * 		PERIOD_DAY
     * 		PERIOD_MONTH
     * 		PERIOD_WEEK
     * 		PERIOD_YEAR
     * 		PERIOD_RANGE
     */
    public function setPeriod( $period )
    {
        $this->period = $period;
    }

    /**
     * Get the date range comma seperated
     *
     * @return string
     */
    public function getRange()
    {
        return 'from ' . $this->rangeStart . ' until '
                . ( ( empty( $this->rangeEnd ) ) ? 'today' : $this->rangeEnd );
    }

    /**
     * Set date range
     *
     * @param string $rangeStart e.g. 2012-02-10 (YYYY-mm-dd) or last5(lastX), previous12(previousY)...
     * @param string $rangeEnd e.g. 2012-02-12. Leave this parameter empty to request all data from $rangeStart until now
     */
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

    /**
     * Get the limit of returned rows
     *
     * @return int
     */
    public function getLimit()
    {
        return intval( $this->limit );
    }

    /**
     * Set the limit of returned rows
     *
     * @param int $limit
     */
    public function setLimit( $limit )
    {
        $this->limit = $limit;
    }

    /**
     * Reset all default variables
     */
    public function reset()
    {
        $this->period = self::PERIOD_DAY;
        $this->date = '';
        $this->rangeStart = 'yesterday';
        $this->rangeEnd = null;

        $this->errors = array();
    }

    /**
     * Make API request
     *
     * @param string $method
     */
    public function request( $method, $params = array() )
    {

//        ladybug_dump_die( $method, $params );

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

    /**
     * Add error
     *
     * @param string $msg Error message
     */
    private function addError( $msg = '' )
    {
        $this->errors = $this->errors + array( $msg );
    }

    /**
     * Check for errors
     */
    public function hasError()
    {
        return (count( $this->errors ));
    }

    /**
     * Return all errors
     */
    public function getErrors()
    {
        return $this->errors;
    }

	/**
	 * MODULE: API
	 * API metadata
	 */

	/**
	 * Get default metric translations
	 */
	public function getDefaultMetricTranslations() {
		return $this->request('API.getDefaultMetricTranslations');
	}

	/**
	 * Get default metrics
	 */
	public function getDefaultMetrics() {
		return $this->request('API.getDefaultMetrics');
	}

	/**
	 * Get default processed metrics
	 */
	public function getDefaultProcessedMetrics() {
		return $this->request('API.getDefaultProcessedMetrics');
	}

	/**
	 * Get default metrics documentation
	 */
	public function getDefaultMetricsDocumentation() {
		return $this->request('API.getDefaultMetricsDocumentation');
	}

	/**
	 * Get default metric translations
	 *
	 * @param array $sites Array with the ID's of the sites
	 */
	public function getSegmentsMetadata($sites = array()) {
		return $this->request('API.getSegmentsMetadata', array(
			'idSites' => $sites));
	}

	/**
	 * Get the url of the logo
	 *
	 * @param boolean $pathOnly Return the url (false) or the absolute path (true)
	 */
	public function getLogoUrl($pathOnly = false) {
		return $this->request('API.getLogoUrl', array(
			'pathOnly' => $pathOnly));
	}

	/**
	 * Get the url of the header logo
	 *
	 * @param boolean $pathOnly Return the url (false) or the absolute path (true)
	 */
	public function getHeaderLogoUrl($pathOnly = false) {
		return $this->request('API.getHeaderLogoUrl', array(
			'pathOnly' => $pathOnly));
	}

	/**
	 * Get metadata from the API
	 *
	 * @param string $apiModule Module
	 * @param string $apiAction Action
	 * @param array $apiParameters Parameters
	 */
	public function getMetadata($apiModule, $apiAction, $apiParameters = array()) {
		return $this->request('API.getMetadata', array(
			'apiModule' => $apiModule,
			'apiAction' => $apiAction,
			'apiParameters' => $apiParameters,
		));
	}

	/**
	 * Get metadata from a report
	 *
	 * @param array $idSites Array with the ID's of the sites
	 * @param string $hideMetricsDoc
	 * @param string $showSubtableReports
	 */
	public function getReportMetadata($idSites = array(), $hideMetricsDoc = '', $showSubtableReports = '') {
		return $this->request('API.getReportMetadata', array(
			'idSites' => $idSites,
			'hideMetricsDoc' => $hideMetricsDoc,
			'showSubtableReports' => $showSubtableReports,
		));
	}

	/**
	 * Get processed report
	 *
	 * @param string $apiModule Module
	 * @param string $apiAction Action
	 * @param string $segment
	 * @param array $ApiParameters
	 * @param int $idGoal
	 * @param boolean $showTimer
	 * @param string $hideMetricsDoc
	 * @param string $idSubtable
	 */
	public function getProcessedReport($apiModule, $apiAction, $segment = '', $apiParameters = array(), $idGoal = '', $showTimer = '1', $hideMetricsDoc = '', $idSubtable = '') {
		return $this->request('API.getProcessedReport', array(
			'apiModule'         => $apiModule,
			'apiAction'         => $apiAction,
			'segment'           => $segment,
			'apiParameters'     => $apiParameters,
			'idGoal'            => $idGoal,
			'showTimer'         => $showTimer,
			'hideMetricsDoc'    => $hideMetricsDoc,
			'idSubtable'        => $idSubtable,
		));
	}

	/**
	 * Unknown
	 *
	 * @param string $segment
	 * @param string $columns
	 */
	public function getApi($segment = '', $columns = '') {
		return $this->request('API.get', array(
			'segment' => $segment,
			'columns' => $columns,
		));
	}


	/***
	 * Unknown
	 *
	 * @param $apiModule
	 * @param $apiAction
	 * @param string $segment
	 * @param $column
	 * @param string $idGoal
	 * @param string $legendAppendMetric
	 * @param string $labelUseAbsoluteUrl
	 * @return mixed
	 */
	public function getRowEvolution($apiModule, $apiAction, $segment = '', $column = '', $idGoal = '', $legendAppendMetric = '1', $labelUseAbsoluteUrl = '1') {
		return $this->request('API.getRowEvolution', array(
			'apiModule' => $apiModule,
			'apiAction' => $apiAction,
			'segment' => $segment,
			'column' => $column,
			'idGoal' => $idGoal,
			'legendAppendMetric ' => $legendAppendMetric,
			'labelUseAbsoluteUrl  ' => $labelUseAbsoluteUrl,
		));
	}

	/**
	 * Get the result of multiple requests bundled together
	 *
	 * @param array $urls
	 */
	public function getBulkRequest($urls = array()) {
		return $this->request('API.getBulkRequest', array(
			'urls' => $urls,
		));
	}

	/**
	 * MODULE: ACTIONS
	 * Reports for visitor actions
	 */

	/**
	 * Get actions
	 *
	 * @param string $segment
	 * @param string $columns
	 */
	public function getAction($segment = '', $columns = '') {
		return $this->request('Actions.get', array(
			'segment' => $segment,
			'columns' => $columns,
		));
	}

	/**
	 * Get page urls
	 *
	 * @param string $segment
	 * @param string $expanded
	 * @param int $idSubtable
	 */
	public function getPageUrls($segment = '', $expanded = '', $idSubtable = '') {
		return $this->request('Actions.getPageUrls', array(
			'segment' => $segment,
			'expanded' => $expanded,
			'idSubtable' => $idSubtable,
		));
	}

	/**
	 * Get page URLs after a site search
	 *
	 * @param string $segment
	 * @param string $expanded
	 * @param int $idSubtable
	 */
	public function getPageUrlsFollowingSiteSearch($segment = '', $expanded = '', $idSubtable = '') {
		return $this->request('Actions.getPageUrlsFollowingSiteSearch', array(
			'segment' => $segment,
			'expanded' => $expanded,
			'idSubtable' => $idSubtable,
		));
	}

	/**
	 * Get page titles after a site search
	 *
	 * @param string $segment
	 * @param string $expanded
	 * @param int $idSubtable
	 */
	public function getPageTitlesFollowingSiteSearch($segment = '', $expanded = '', $idSubtable = '') {
		return $this->request('Actions.getPageTitlesFollowingSiteSearch', array(
			'segment' => $segment,
			'expanded' => $expanded,
			'idSubtable' => $idSubtable,
		));
	}

	/**
	 * Get entry page urls
	 *
	 * @param string $segment
	 * @param string $expanded
	 * @param int $idSubtable
	 */
	public function getEntryPageUrls($segment = '', $expanded = '', $idSubtable = '') {
		return $this->request('Actions.getEntryPageUrls', array(
			'segment' => $segment,
			'expanded' => $expanded,
			'idSubtable' => $idSubtable,
		));
	}

	/**
	 * Get exit page urls
	 *
	 * @param string $segment
	 * @param string $expanded
	 * @param int $idSubtable
	 */
	public function getExitPageUrls($segment = '', $expanded = '', $idSubtable = '') {
		return $this->request('Actions.getExitPageUrls', array(
			'segment' => $segment,
			'expanded' => $expanded,
			'idSubtable' => $idSubtable,
		));
	}

	/**
	 * Get page url information
	 *
	 * @param string $pageUrl The page url
	 * @param string $segment
	 * @param string $expanded
	 * @param int $idSubtable
	 */
	public function getPageUrl($pageUrl, $segment = '') {
		return $this->request('Actions.getPageUrl', array(
			'pageUrl' => $pageUrl,
			'segment' => $segment,
		));
	}

	/**
	 * Get page titles
	 *
	 * @param string $segment
	 * @param string $expanded
	 * @param int $idSubtable
	 */
	public function getPageTitles($segment = '', $expanded = '', $idSubtable = '') {
		return $this->request('Actions.getPageTitles', array(
			'segment' => $segment,
			'expanded' => $expanded,
			'idSubtable' => $idSubtable,
		));
	}

	/**
	 * Get entry page urls
	 *
	 * @param string $segment
	 * @param string $expanded
	 * @param int $idSubtable
	 */
	public function getEntryPageTitles($segment = '', $expanded = '', $idSubtable = '') {
		return $this->request('Actions.getEntryPageTitles', array(
			'segment' => $segment,
			'expanded' => $expanded,
			'idSubtable' => $idSubtable,
		));
	}

	/**
	 * Get exit page urls
	 *
	 * @param string $segment
	 * @param string $expanded
	 * @param int $idSubtable
	 */
	public function getExitPageTitles($segment = '', $expanded = '', $idSubtable = '') {
		return $this->request('Actions.getExitPageTitles', array(
			'segment' => $segment,
			'expanded' => $expanded,
			'idSubtable' => $idSubtable,
		));
	}

	/**
	 * Get page titles
	 *
	 * @param string $pageName The page name
	 * @param string $segment
	 * @param string $expanded
	 * @param int $idSubtable
	 */
	public function getPageTitle($pageName, $segment = '') {
		return $this->request('Actions.getPageTitle', array(
			'pageName' => $pageName,
			'segment' => $segment,
		));
	}

	/**
	 * Get Device Type.
	 *
	 * It requires DevicesDetection to be enabled
	 *
	 * @see http://piwik.org/blog/2013/05/last-piwik-1-x-release-v1-12-new-features-api-improvements-screenshots/#toc-new-big-feature-device-detection-reports
	 *
	 * @param string $segment
	 * @param string $expanded
	 * @param int $idSubtable
	 */
	public function getDeviceType($segment = '', $expanded = '', $idSubtable = '') {
		return $this->request('DevicesDetection.getType', array(
			'segment' => $segment,
			'expanded' => $expanded,
		));
	}

	/**
	 * Get Device Brand.
	 *
	 * It requires DevicesDetection to be enabled
	 *
	 * @see http://piwik.org/blog/2013/05/last-piwik-1-x-release-v1-12-new-features-api-improvements-screenshots/#toc-new-big-feature-device-detection-reports
	 *
	 * @param string $segment
	 * @param string $expanded
	 * @param int $idSubtable
	 */
	public function getDeviceBrand($segment = '', $expanded = '', $idSubtable = '') {
		return $this->request('DevicesDetection.getBrand', array(
			'segment' => $segment,
			'expanded' => $expanded,
		));
	}

	/**
	 * Get Device Model.
	 *
	 * It requires DevicesDetection to be enabled
	 *
	 * @see http://piwik.org/blog/2013/05/last-piwik-1-x-release-v1-12-new-features-api-improvements-screenshots/#toc-new-big-feature-device-detection-reports
	 *
	 * @param string $segment
	 * @param string $expanded
	 * @param int $idSubtable
	 */
	public function getDeviceModel($segment = '', $expanded = '', $idSubtable = '') {
		return $this->request('DevicesDetection.getModel', array(
			'segment' => $segment,
			'expanded' => $expanded,
		));
	}
	/**
	 * Get downloads
	 *
	 * @param string $segment
	 * @param string $expanded
	 * @param int $idSubtable
	 */
	public function getDownloads($segment = '', $expanded = '', $idSubtable = '') {
		return $this->request('Actions.getDownloads', array(
			'segment' => $segment,
			'expanded' => $expanded,
			'idSubtable' => $idSubtable,
		));
	}

	/**
	 * Get download information
	 *
	 * @param string $downloadUrl URL of the download
	 * @param string $segment
	 * @param string $expanded
	 * @param int $idSubtable
	 */
	public function getDownload($downloadUrl, $segment = '') {
		return $this->request('Actions.getDownload', array(
			'downloadUrl' => $downloadUrl,
			'segment' => $segment,
		));
	}

	/**
	 * Get outlinks
	 *
	 * @param string $segment
	 * @param string $expanded
	 * @param int $idSubtable
	 */
	public function getOutlinks($segment = '', $expanded = '', $idSubtable = '') {
		return $this->request('Actions.getOutlinks', array(
			'segment' => $segment,
			'expanded' => $expanded,
			'idSubtable' => $idSubtable,
		));
	}

	/**
	 * Get outlink information
	 *
	 * @param string $outlinkUrl URL of the outlink
	 * @param string $segment
	 * @param string $expanded
	 * @param int $idSubtable
	 */
	public function getOutlink($outlinkUrl, $segment = '') {
		return $this->request('Actions.getOutlink', array(
			'outlinkUrl' => $outlinkUrl,
			'segment' => $segment,
		));
	}

	/**
	 * Get
	 *
	 * @param string $segment
	 */
	public function getSiteSearchKeywords($segment = '') {
		return $this->request('Actions.getSiteSearchKeywords', array(
			'segment' => $segment,
		));
	}

	/**
	 * Get
	 *
	 * @param array $dataTable
	 * @param string $columnToRead
	 */
	public function addPagesPerSearchColumn($dataTable = array(), $columnToRead = 'nb_hits') {
		return $this->request('Actions.addPagesPerSearchColumn', array(
			'dataTable' => $dataTable,
			'columnToRead' => $columnToRead,
		));
	}

	/**
	 * Get
	 *
	 * @param string $segment
	 */
	public function getSiteSearchNoResultKeywords($segment = '') {
		return $this->request('Actions.getSiteSearchNoResultKeywords', array(
			'segment' => $segment,
		));
	}

	/**
	 * Get
	 *
	 * @param string $segment
	 */
	public function getSiteSearchCategories($segment = '') {
		return $this->request('Actions.getSiteSearchCategories', array(
			'segment' => $segment,
		));
	}


	/**
	 * MODULE: CUSTOM VATIABLES
	 * Custom variable information
	 */

	/**
	 * Get custom variables
	 *
	 * @param string $segment
	 * @param string $expanded
	 */
	public function getCustomVariables($segment = '', $expanded = '') {
		return $this->request('CustomVariables.getCustomVariables', array(
			'segment' => $segment,
			'expanded' => $expanded,
		));
	}

	/**
	 * Get information about a custom variable
	 *
	 * @param int $idSubtable
	 * @param string $segment
	 */
	public function getCustomVariable($idSubtable, $segment = '') {
		return $this->request('CustomVariables.getCustomVariablesValuesFromNameId', array(
			'idSubtable' => $idSubtable,
			'segment' => $segment,
		));
	}

	/**
	 * MODULE: EXAMPLE API
	 * Get api and piwiki information
	 */

	/**
	 * Get the piwik version
	 */
	public function getPiwikiVersion() {
		return $this->request('ExampleAPI.getPiwikVersion');
	}

	/**
	 * http://en.wikipedia.org/wiki/Phrases_from_The_Hitchhiker%27s_Guide_to_the_Galaxy#The_number_42
	 */
	public function getAnswerToLife() {
		return $this->request('ExampleAPI.getAnswerToLife');
	}

	/**
	 *
	 */
	public function getObject() {
		return $this->request('ExampleAPI.getObject');
	}

	/**
	 * Get the sum of the parameters
	 *
	 * @param int $a
	 * @param int $b
	 */
	public function getSum($a = '0', $b = '0') {
		return $this->request('ExampleAPI.getSum', array(
			'a' => $a,
			'b' => $b,
		));
	}

	/**
	 * Returns nothing but the success of the request
	 */
	public function getNull() {
		return $this->request('ExampleAPI.getNull');
	}

	/**
	 * Get a short piwik description
	 */
	public function getDescriptionArray() {
		return $this->request('ExampleAPI.getDescriptionArray');
	}

	/**
	 * Get a short comparison with other analytic software
	 */
	public function getCompetitionDatatable() {
		return $this->request('ExampleAPI.getCompetitionDatatable');
	}

	/**
	 * Get information about 42
	 * http://en.wikipedia.org/wiki/Phrases_from_The_Hitchhiker%27s_Guide_to_the_Galaxy#The_number_42
	 */
	public function getMoreInformationAnswerToLife() {
		return $this->request('ExampleAPI.getMoreInformationAnswerToLife');
	}

	/**
	 * Get a multidimensional array
	 */
	public function getMultiArray() {
		return $this->request('ExampleAPI.getMultiArray');
	}

	/**
	 * MODULE: GOALS
	 * Handle goals
	 */

	/**
	 * Get all goals
	 */
	public function getGoals() {
		return $this->request('Goals.getGoals');
	}

	/**
	 * Add a goal
	 *
	 * @param string $name
	 * @param string $matchAttribute
	 * @param string $pattern
	 * @param string $patternType
	 * @param boolean $caseSensitive
	 * @param float $revenue
	 * @param boolean $allowMultipleConversionsPerVisit
	 */
	public function addGoal($name, $matchAttribute, $pattern, $patternType, $caseSensitive = '', $revenue = '', $allowMultipleConversionsPerVisit = '') {
		return $this->request('Goals.addGoal', array(
			'name' => $name,
			'matchAttribute' => $matchAttribute,
			'pattern' => $pattern,
			'patternType' => $patternType,
			'caseSensitive' => $caseSensitive,
			'revenue' => $revenue,
			'allowMultipleConversionsPerVisit' => $allowMultipleConversionsPerVisit,
		));
	}

	/**
	 * Update a goal
	 *
	 * @param int $idGoal
	 * @param string $name
	 * @param string $matchAttribute
	 * @param string $pattern
	 * @param string $patternType
	 * @param boolean $caseSensitive
	 * @param float $revenue
	 * @param boolean $allowMultipleConversionsPerVisit
	 */
	public function updateGoal($idGoal, $name, $matchAttribute, $pattern, $patternType, $caseSensitive = '', $revenue = '', $allowMultipleConversionsPerVisit = '') {
		return $this->request('Goals.updateGoal', array(
			'idGoal' => $idGoal,
			'name' => $name,
			'matchAttribute' => $matchAttribute,
			'pattern' => $pattern,
			'patternType' => $patternType,
			'caseSensitive' => $caseSensitive,
			'revenue' => $revenue,
			'allowMultipleConversionsPerVisit' => $allowMultipleConversionsPerVisit,
		));
	}

	/**
	 * Delete a goal
	 *
	 * @param int $idGoal
	 */
	public function deleteGoal($idGoal) {
		return $this->request('Goals.deleteGoal', array(
			'idGoal' => $idGoal,
		));
	}

	/**
	 * Get the SKU of the items
	 *
	 * @param boolean abandonedCarts
	 */
	public function getItemsSku($abandonedCarts) {
		return $this->request('Goals.getItemsSku', array(
			'abandonedCarts' => $abandonedCarts,
		));
	}

	/**
	 * Get the name of the items
	 *
	 * @param boolean abandonedCarts
	 */
	public function getItemsName($abandonedCarts) {
		return $this->request('Goals.getItemsName', array(
			'abandonedCarts' => $abandonedCarts,
		));
	}

	/**
	 * Get the categories of the items
	 *
	 * @param boolean abandonedCarts
	 */
	public function getItemsCategory($abandonedCarts) {
		return $this->request('Goals.getItemsCategory', array(
			'abandonedCarts' => $abandonedCarts,
		));
	}

	/**
	 * Get conversion rates from a goal
	 *
	 * @param string $segment
	 * @param int $idGoal
	 * @param array $columns
	 */
	public function getGoal($segment = '', $idGoal = '', $columns = array()) {
		return $this->request('Goals.get', array(
			'segment' => $segment,
			'idGoal' => $idGoal,
			'columns' => $columns,
		));
	}


	/**
	 * Get information about a time period and it's conversion rates
	 *
	 * @param string $segment
	 * @param int $idGoal
	 */
	public function getDaysToConversion($segment = '', $idGoal = '') {
		return $this->request('Goals.getDaysToConversion', array(
			'segment' => $segment,
			'idGoal' => $idGoal,
		));
	}

	/**
	 * Get information about how many site visits create a conversion
	 *
	 * @param string $segment
	 * @param int $idGoal
	 */
	public function getVisitsUntilConversion($segment = '', $idGoal = '') {
		return $this->request('Goals.getVisitsUntilConversion', array(
			'segment' => $segment,
			'idGoal' => $idGoal,
		));
	}

	/**
	 * MODULE: IMAGE GRAPH
	 * Generate png graphs
	 */

	const GRAPH_EVOLUTION = 'evolution';
	const GRAPH_VERTICAL_BAR = 'verticalBar';
	const GRAPH_PIE = 'pie';
	const GRAPH_PIE_3D = '3dPie';

	/**
	 * Generate a png report
	 *
	 * @param string $apiModule Module
	 * @param string $apiAction Action
	 * @param string
	 *		GRAPH_EVOLUTION
	 *		GRAPH_VERTICAL_BAR
	 *		GRAPH_PIE
	 *		GRAPH_PIE_3D
	 * @param int $outputType
	 * @param string $columns
	 * @param boolean $showMetricTitle
	 * @param int $width
	 * @param int $height
	 * @param int $fontSize
	 * @param boolean $aliasedGraph "by default, Graphs are "smooth" (anti-aliased). If you are generating hundreds of graphs and are concerned with performance, you can set aliasedGraph=0. This will disable anti aliasing and graphs will be generated faster, but look less pretty."
	 * @param array $colors Use own colors instead of the default. The colors has to be in hexadecimal value without '#'
	 */
	public function getImageGraph($apiModule, $apiAction, $graphType = '', $outputType = '0', $columns = '', $labels = '', $showLegend = '1', $width = '', $height = '', $fontSize = '9', $legendFontSize = '', $aliasedGraph = '1', $idGoal = '', $colors = array()) {
		return $this->request('ImageGraph.get', array(
			'apiModule' => $apiModule,
			'apiAction' => $apiAction,
			'graphType' => $graphType,
			'outputType' => $outputType,
			'columns' => $columns,
			'labels' => $labels,
			'showLegend' => $showLegend,
			'width' => $width,
			'height' => $height,
			'fontSize' => $fontSize,
			'legendFontSize' => $legendFontSize,
			'aliasedGraph' => $aliasedGraph,
			'idGoal ' => $idGoal,
			'colors' => $colors,
		));
	}

	/**
	 * MODULE: LANGUAGES MANAGER
	 * Manage languages
	 */

	/**
	 * Proofe if language is available
	 *
	 * @param string $languageCode
	 */
	public function getLanguageAvailable($languageCode) {
		return $this->request('LanguagesManager.isLanguageAvailable', array(
			'languageCode' => $languageCode,
		));
	}

	/**
	 * Get all available languages
	 */
	public function getAvailableLanguages() {
		return $this->request('LanguagesManager.getAvailableLanguages');
	}

	/**
	 * Get all available languages with information
	 */
	public function getAvailableLanguagesInfo() {
		return $this->request('LanguagesManager.getAvailableLanguagesInfo');
	}

	/**
	 * Get all available languages with their names
	 */
	public function getAvailableLanguageNames() {
		return $this->request('LanguagesManager.getAvailableLanguageNames');
	}

	/**
	 * Get translations for a language
	 *
	 * @param string $languageCode
	 */
	public function getTranslations($languageCode) {
		return $this->request('LanguagesManager.getTranslationsForLanguage', array(
			'languageCode' => $languageCode,
		));
	}

	/**
	 * Get the language for the user with the login $login
	 *
	 * @param string $login
	 */
	public function getLanguageForUser($login) {
		return $this->request('LanguagesManager.getLanguageForUser', array(
			'login' => $login,
		));
	}

	/**
	 * Set the language for the user with the login $login
	 *
	 * @param string $login
	 * @param string $languageCode
	 */
	public function setLanguageForUser($login, $languageCode) {
		return $this->request('LanguagesManager.setLanguageForUser', array(
			'login' => $login,
			'languageCode' => $languageCode,
		));
	}


	/**
	 * MODULE: LIVE
	 * Request live data
	 */

	/**
	 * Get a short information about the visit counts in the last minutes
	 *
	 * @param int $lastMinutes Default: 60
	 * @param string $segment
	 */
	public function getCounters($lastMinutes = 60, $segment = '') {
		return $this->request('Live.getCounters', array(
			'lastMinutes' => $lastMinutes,
			'segment' => $segment,
		));
	}

	/**
	 * Get information about the last visits
	 *
	 * @param string $segment
	 * @param int $filterLimit
	 * @param int $maxIdVisit
	 * @param string $minTimestamp
	 */
	public function getLastVisitsDetails($segment = '', $filter_limit = '', $maxIdVisit = '', $minTimestamp = '') {
		return $this->request('Live.getLastVisitsDetails', array(
			'segment' => $segment,
			'filter_limit' => $filter_limit,
			'maxIdVisit' => $maxIdVisit,
			'minTimestamp' => $minTimestamp,
		));
	}

	/**
	 * MODULE: MOBILEMESSAGING
	 * The MobileMessaging API lets you manage and access all the MobileMessaging plugin features including : - manage SMS API credential - activate phone numbers - check remaining credits - send SMS
	 */

	/**
	 * Checks if SMSAPI has been configured
	 *
	 * @return mixed
	 */
	public function areSMSAPICredentialProvided() {
		return $this->request('MobileMessaging.areSMSAPICredentialProvided');
	}

	/**
	 * Get
	 *
	 * @return mixed
	 */
	public function getSMSProvider() {
		return $this->request('MobileMessaging.getSMSProvider');
	}

	/**
	 * Set SMSAPI credentials
	 *
	 * @param string $provider
	 * @param string $apiKey
	 * @return mixed
	 */
	public function setSMSAPICredential($provider, $apiKey) {
		return $this->request('MobileMessaging.setSMSAPICredential', array(
			'provider' => $provider,
			'apiKey' => $apiKey,
		));
	}

	/**
	 * Add phone number
	 *
	 * @param string $phoneNumber
	 * @return mixed
	 */
	public function addPhoneNumber($phoneNumber) {
		return $this->request('MobileMessaging.addPhoneNumber', array(
			'phoneNumber' => $phoneNumber,
		));
	}

	/**
	 * Get credits left
	 *
	 * @return mixed
	 */
	public function getCreditLeft() {
		return $this->request('MobileMessaging.getCreditLeft');
	}

	/**
	 * Remove phone number
	 *
	 * @param string $phoneNumber
	 * @return mixed
	 */
	public function removePhoneNumber($phoneNumber) {
		return $this->request('MobileMessaging.removePhoneNumber', array(
			'phoneNumber' => $phoneNumber,
		));
	}

	/**
	 * Validate phone number
	 *
	 * @param string $phoneNumber
	 * @param string $verificationCode
	 * @return mixed
	 */
	public function validatePhoneNumber($phoneNumber, $verificationCode) {
		return $this->request('MobileMessaging.validatePhoneNumber', array(
			'phoneNumber' => $phoneNumber,
			'verificationCode' => $verificationCode,
		));
	}

	/**
	 * Delete SMSAPI credentials
	 *
	 * @return mixed
	 */
	public function deleteSMSAPICredential() {
		return $this->request('MobileMessaging.deleteSMSAPICredential');
	}

	/***
	 * Set unknown
	 *
	 * @param $delegatedManagement
	 * @return mixed
	 */
	public function setDelegatedManagement($delegatedManagement) {
		return $this->request('MobileMessaging.setDelegatedManagement', array(
			'delegatedManagement' => $delegatedManagement,
		));
	}

	/**
	 * Get unknown
	 *
	 * @return mixed
	 */
	public function getDelegatedManagement() {
		return $this->request('MobileMessaging.getDelegatedManagement');
	}


	/**
	 * MODULE: MULTI SITES
	 * Get information about multiple sites
	 */

	/**
	 * Get information about multiple sites
	 *
	 * @param string $segment
	 * @param string $enhanced
	 */
	public function getMultiSites($segment = '', $enhanced = '') {
		return $this->request('MultiSites.getAll', array(
			'segment' => $segment,
			'enhanced' => $enhanced,
		));
	}

	/**
	 * Get key metrics about one of the sites the user manages
	 *
	 * @param string $segment
	 * @param string $enhanced
	 */
	public function getOne($segment = '', $enhanced = '') {
		return $this->request('MultiSites.getOne', array(
			'segment' => $segment,
			'enhanced' => $enhanced,
		));
	}


	/**
	 * MODULE: PDF REPORST
	 * Manage pdf reports
	 */

	/**
	 * Add pdf report
	 *
	 * @param string $description
	 * @param string $reportType
	 * @param string $reportFormat
	 * @param string $reports
	 * @param array $parameters
	 */
	public function addReport($description, $reportType, $reportFormat, $reports, $parameters = array()) {
		return $this->request('PDFReports.addReport', array(
			'description' => $description,
			'reportType' => $reportType,
			'reportFormat' => $reportFormat,
			'reports' => $reports,
			'parameters' => $parameters,
		));
	}

	/**
	 * Update pdf report
	 *
	 * @param int $idReport ID of the report
	 * @param string $description
	 * @param string $reportType
	 * @param string $reportFormat
	 * @param string $reports
	 * @param array $parameters
	 */
	public function updateReport($idReport, $description, $reportType, $reportFormat, $reports, $parameters = array()) {
		return $this->request('PDFReports.updateReport', array(
			'idReport' => $idReport,
			'description' => $description,
			'reportType' => $reportType,
			'reportFormat' => $reportFormat,
			'reports' => $reports,
			'parameters' => $parameters,
		));
	}

	/**
	 * Delete report
	 *
	 * @param int $idReport ID of the report
	 */
	public function deleteReport($idReport) {
		return $this->request('PDFReports.deleteReport', array(
			'idReport' => $idReport,
		));
	}

	/**
	 * Get all reports
	 *
	 * @param int $idReport ID of the report
	 * @param boolean $iflevelReturnOnlylevelReports
	 */
	public function getReports($idReport = '', $iflevelReturnOnlylevelReports = '') {
		return $this->request('PDFReports.getReports', array(
			'idReport' => $idReport,
			'iflevelReturnOnlylevelReports' => $iflevelReturnOnlylevelReports,
		));
	}

	/**
	 * Generate report
	 *
	 * @param int $idReport ID of the report
	 * @param string $outputType
	 * @param string $reportFormat
	 * @param array $parameters
	 */
	public function generateReport($idReport, $outputType = '', $reportFormat = '', $parameters = array()) {
		return $this->request('PDFReports.generateReport', array(
			'idReport' => $idReport,
			'outputType' => $outputType,
			'reportFormat' => $reportFormat,
			'parameters' => $parameters,
		));
	}

	/**
	 * Send report via email
	 *
	 * @param int $idReport ID of the report
	 */
	public function sendReport($idReport) {
		return $this->request('PDFReports.sendReport', array(
			'idReport' => $idReport,
		));
	}

	/**
	 * MODULE: PROVIDER
	 * Get provider information
	 */

	/**
	 * Get information about visitors internet providers
	 *
	 * @param string $segment
	 */
	public function getProvider($segment = '') {
		return $this->request('Provider.getProvider', array(
			'segment' => $segment,
		));
	}

	/**
	 * MODULE: REFERERS
	 * Get information about the referers
	 */

	/**
	 * Get referer types
	 *
	 * @param string $segment
	 * @param string $typeReferer
	 */
	public function getRefererType($segment = '', $typeReferer = '') {
		return $this->request('Referers.getRefererType', array(
			'segment' => $segment,
			'typeReferer' => $typeReferer,
		));
	}

	/**
	 * Get referer keywords
	 *
	 * @param string $segment
	 * @param string $expanded
	 */
	public function getKeywords($segment = '', $expanded = '') {
		return $this->request('Referers.getKeywords', array(
			'segment' => $segment,
			'expanded' => $expanded,
		));
	}

	/**
	 * Get keywords for an url
	 *
	 * @param string $url
	 */
	public function getKeywordsForPageUrl($url) {
		return $this->request('Referers.getKeywordsForPageUrl', array(
			'url' => $url,
		));
	}

	/**
	 * Get keywords for an page title
	 *
	 * @param string $title
	 */
	public function getKeywordsForPageTitle($title) {
		return $this->request('Referers.getKeywordsForPageTitle', array(
			'title' => $title,
		));
	}

	/**
	 * Get search engines by keyword
	 *
 	 * @param int $idSubtable
	 * @param string $segment
	 */
	public function getSearchEnginesFromKeywordId($idSubtable, $segment = '') {
		return $this->request('Referers.getSearchEnginesFromKeywordId', array(
			'idSubtable' => $idSubtable,
			'segment' => $segment,
		));
	}

	/**
	 * Get search engines
	 *
	 * @param string $segment
	 * @param string $expanded
	 */
	public function getSearchEngines($segment = '', $expanded = '') {
		return $this->request('Referers.getSearchEngines', array(
			'segment' => $segment,
			'expanded' => $expanded,
		));
	}

	/**
	 * Get search engines by search engine ID
	 *
 	 * @param int $idSubtable
	 * @param string $segment
	 */
	public function getKeywordsFromSearchEngineId($idSubtable, $segment = '') {
		return $this->request('Referers.getKeywordsFromSearchEngineId', array(
			'idSubtable' => $idSubtable,
			'segment' => $segment,
		));
	}

	/**
	 * Get campaigns
	 *
	 * @param string $segment
	 * @param string $expanded
	 */
	public function getCampaigns($segment = '', $expanded = '') {
		return $this->request('Referers.getCampaigns', array(
			'segment' => $segment,
			'expanded' => $expanded,
		));
	}

	/**
	 * Get keywords by campaign ID
	 *
 	 * @param int $idSubtable
	 * @param string $segment
	 */
	public function getKeywordsFromCampaignId($idSubtable, $segment = '') {
		return $this->request('Referers.getKeywordsFromCampaignId', array(
			'idSubtable' => $idSubtable,
			'segment' => $segment,
		));
	}

	/**
	 * Get website refererals
	 *
	 * @param string $segment
	 * @param string $expanded
	 */
	public function getWebsites($segment = '', $expanded = '') {
		return $this->request('Referers.getWebsites', array(
			'segment' => $segment,
			'expanded' => $expanded,
		));
	}

	/**
	 * Get urls by website ID
	 *
 	 * @param int $idSubtable
	 * @param string $segment
	 */
	public function getUrlsFromWebsiteId($idSubtable, $segment = '') {
		return $this->request('Referers.getUrlsFromWebsiteId', array(
			'idSubtable' => $idSubtable,
			'segment' => $segment,
		));
	}

	/**
	 * Get the number of distinct search engines
	 *
	 * @param string $segment
	 */
	public function getNumberOfSearchEngines($segment = '') {
		return $this->request('Referers.getNumberOfDistinctSearchEngines', array(
			'segment' => $segment,
		));
	}

	/**
	 * Get the number of distinct keywords
	 *
	 * @param string $segment
	 */
	public function getNumberOfKeywords($segment = '') {
		return $this->request('Referers.getNumberOfDistinctKeywords', array(
			'segment' => $segment,
		));
	}

	/**
	 * Get the number of distinct campaigns
	 *
	 * @param string $segment
	 */
	public function getNumberOfCampaigns($segment = '') {
		return $this->request('Referers.getNumberOfDistinctCampaigns', array(
			'segment' => $segment,
		));
	}

	/**
	 * Get the number of distinct websites
	 *
	 * @param string $segment
	 */
	public function getNumberOfWebsites($segment = '') {
		return $this->request('Referers.getNumberOfDistinctWebsites', array(
			'segment' => $segment,
		));
	}

	/**
	 * Get the number of distinct websites urls
	 *
	 * @param string $segment
	 */
	public function getNumberOfWebsitesUrls($segment = '') {
		return $this->request('Referers.getNumberOfDistinctWebsitesUrls', array(
			'segment' => $segment,
		));
	}

	/**
	 * MODULE: SEO
	 * Get SEO information
	 */

	/**
	 * Get the SEO rank of an url
	 *
	 * @param string $url
	 */
	public function getSeoRank($url) {
		return $this->request('SEO.getRank', array(
			'url' => $url,
		));
	}

	/**
	 * MODULE: SITES MANAGER
	 * Manage sites
	 */

	/**
	 * Get the JS tag of the current site
	 *
	 * @param string $piwikUrl
	 */
	public function getJavascriptTag($piwikUrl) {
		return $this->request('SitesManager.getJavascriptTag', array(
			'piwikUrl' => $piwikUrl,
		));
	}

	/**
	 * Get sites from a group
	 *
	 * @param string $group
	 */
	public function getSitesFromGroup($group) {
		return $this->request('SitesManager.getSitesFromGroup', array(
			'group' => $group,
		));
	}

	/**
	 * Get all site groups
	 */
	public function getSitesGroups() {
		return $this->request('SitesManager.getSitesGroups');
	}

	/**
	 * Get information about the current site
	 */
	public function getSiteInformation() {
		return $this->request('SitesManager.getSiteFromId');
	}

	/**
	 * Get urls from current site
	 */
	public function getSiteUrls() {
		return $this->request('SitesManager.getSiteUrlsFromId');
	}

	/**
	 * Get all sites
	 */
	public function getAllSites() {
		return $this->request('SitesManager.getAllSites');
	}

	/**
	 * Get all sites with ID
	 */
	public function getAllSitesId() {
		return $this->request('SitesManager.getAllSitesId');
	}

	/**
	 * Get all sites with the visit count since $timestamp
	 *
	 * @param string $timestamp
	 */
	public function getSitesIdWithVisits($timestamp) {
		return $this->request('SitesManager.getSitesIdWithVisits', array(
			'timestamp' => $timestamp,
		));
	}

	/**
	 * Get all sites where the current user has admin access
	 */
	public function getSitesWithAdminAccess() {
		return $this->request('SitesManager.getSitesWithAdminAccess');
	}

	/**
	 * Get all sites where the current user has view access
	 */
	public function getSitesWithViewAccess() {
		return $this->request('SitesManager.getSitesWithViewAccess');
	}

	/**
	 * Get all sites where the current user has a least view access
	 *
	 * @param int $limit
	 */
	public function getSitesWithAtLeastViewAccess($limit = '') {
		return $this->request('SitesManager.getSitesWithAtLeastViewAccess', array(
			'limit' => $limit,
		));
	}

	/**
	 * Get all sites with ID where the current user has admin access
	 */
	public function getSitesIdWithAdminAccess() {
		return $this->request('SitesManager.getSitesIdWithAdminAccess');
	}

	/**
	 * Get all sites with ID where the current user has view access
	 */
	public function getSitesIdWithViewAccess() {
		return $this->request('SitesManager.getSitesIdWithViewAccess');
	}

	/**
	 * Get all sites with ID where the current user has at least view access
	 */
	public function getSitesIdWithAtLeastViewAccess() {
		return $this->request('SitesManager.getSitesIdWithAtLeastViewAccess');
	}

	/**
	 * Get a site by it's URL
	 *
	 * @param string $url
	 */
	public function getSitesIdFromSiteUrl($url) {
		return $this->request('SitesManager.getSitesIdFromSiteUrl', array(
			'url' => $url,
		));
	}

	/**
	 * Add a site
	 *
	 * @param string $siteName
	 * @param array $urls
	 * @param boolean $ecommerce
	 * @param boolean $siteSearch
	 * @param string $searchKeywordParameters
	 * @param string $searchCategoryParameters
	 * @param array $excludeIps
	 * @param array $excludedQueryParameters
	 * @param string $timezone
	 * @param string $currency
	 * @param string $group
	 * @param string $startDate
	 */
	public function addSite($siteName, $urls, $ecommerce = '', $siteSearch = '', $searchKeywordParameters = '', $searchCategoryParameters = '', $excludeIps = '', $excludedQueryParameters = '', $timezone = '', $currency = '', $group = '', $startDate = '') {
		return $this->request('SitesManager.addSite', array(
			'siteName' => $siteName,
			'urls' => $urls,
			'ecommerce' => $ecommerce,
			'siteSearch' => $siteSearch,
			'searchKeywordParameters' => $searchKeywordParameters,
			'searchCategoryParameters' => $searchCategoryParameters,
			'excludeIps' => $excludeIps,
			'excludedQueryParameters' => $excludedQueryParameters,
			'timezone' => $timezone,
			'currency' => $currency,
			'group' => $group,
			'startDate' => $startDate,
		));
	}


	/**
	 * Delete current site
	 */
	public function deleteSite() {
		return $this->request('SitesManager.deleteSite');
	}

	/**
	 * Add alias urls to the current site
	 *
	 * @param array $urls
	 */
	public function addSiteAliasUrls($urls) {
		return $this->request('SitesManager.addSiteAliasUrls', array(
			'urls' => $urls,
		));
	}

	/**
	 * Get IP's for a specific range
	 *
	 * @param string $ipRange
	 */
	public function getIpsForRange($ipRange) {
		return $this->request('SitesManager.getIpsForRange', array(
			'ipRange' => $ipRange,
		));
	}

	/**
	 * Set the global excluded IP's
	 *
	 * @param array $excludedIps
	 */
	public function setExcludedIps($excludedIps) {
		return $this->request('SitesManager.setGlobalExcludedIps', array(
			'excludedIps' => $excludedIps,
		));
	}

	/***
	 * Set global search parameters
	 *
	 * @param $searchKeywordParameters
	 * @param $searchCategoryParameters
	 * @return mixed
	 */
	public function setGlobalSearchParameters($searchKeywordParameters, $searchCategoryParameters) {
		return $this->request('SitesManager.setGlobalSearchParameters ', array(
			'searchKeywordParameters' => $searchKeywordParameters,
			'searchCategoryParameters' => $searchCategoryParameters,
		));
	}

	/**
	 * Get search keywords
	 */
	public function getSearchKeywordParametersGlobal() {
		return $this->request('SitesManager.getSearchKeywordParametersGlobal  ');
	}

	/**
	 * Get search categories
	 */
	public function getSearchCategoryParametersGlobal() {
		return $this->request('SitesManager.getSearchCategoryParametersGlobal ');
	}

	/**
	 * Get the global excluded query parameters
	 */
	public function getExcludedParameters() {
		return $this->request('SitesManager.getExcludedQueryParametersGlobal');
	}

	/**
	 * Set the global excluded query parameters
	 *
	 * @param array $excludedQueryParameters
	 */
	public function setExcludedParameters($excludedQueryParameters) {
		return $this->request('SitesManager.setGlobalExcludedQueryParameters', array(
			'excludedQueryParameters' => $excludedQueryParameters,
		));
	}

	/**
	 * Get the global excluded IP's
	 */
	public function getExcludedIps() {
		return $this->request('SitesManager.getExcludedIpsGlobal');
	}


	/**
	 * Get the default currency
	 */
	public function getDefaultCurrency() {
		return $this->request('SitesManager.getDefaultCurrency');
	}

	/**
	 * Set the default currency
	 *
	 * @param string $defaultCurrency
	 */
	public function setDefaultCurrency($defaultCurrency) {
		return $this->request('SitesManager.setDefaultCurrency', array(
			'defaultCurrency' => $defaultCurrency,
		));
	}


	/**
	 * Get the default timezone
	 */
	public function getDefaultTimezone() {
		return $this->request('SitesManager.getDefaultTimezone');
	}

	/**
	 * Set the default timezone
	 *
	 * @param string $defaultTimezone
	 */
	public function setDefaultTimezone($defaultTimezone) {
		return $this->request('SitesManager.setDefaultTimezone', array(
			'defaultTimezone' => $defaultTimezone,
		));
	}

	/**
	 * Update current site
	 *
	 * @param string $siteName
	 * @param array $urls
	 * @param boolean $ecommerce
	 * @param boolean $siteSearch
	 * @param string $searchKeywordParameters
	 * @param string $searchCategoryParameters
	 * @param array $excludeIps
	 * @param array $excludedQueryParameters
	 * @param string $timezone
	 * @param string $currency
	 * @param string $group
	 * @param string $startDate
	 */
	public function updateSite($siteName, $urls, $ecommerce = '', $siteSearch = '', $searchKeywordParameters = '', $searchCategoryParameters = '', $excludeIps = '', $excludedQueryParameters = '', $timezone = '', $currency = '', $group = '', $startDate = '') {
		return $this->request('SitesManager.updateSite', array(
			'siteName' => $siteName,
			'urls' => $urls,
			'ecommerce' => $ecommerce,
			'siteSearch' => $siteSearch,
			'searchKeywordParameters' => $searchKeywordParameters,
			'searchCategoryParameters' => $searchCategoryParameters,
			'excludeIps' => $excludeIps,
			'excludedQueryParameters' => $excludedQueryParameters,
			'timezone' => $timezone,
			'currency' => $currency,
			'group' => $group,
			'startDate' => $startDate,
		));
	}

	/**
	 * Get a list with all available currencies
	 */
	public function getCurrencyList() {
		return $this->request('SitesManager.getCurrencyList');
	}

	/**
	 * Get a list with all currency symbols
	 */
	public function getCurrencySymbols() {
		return $this->request('SitesManager.getCurrencySymbols');
	}

	/**
	 * Get a list with available timezones
	 */
	public function getTimezonesList() {
		return $this->request('SitesManager.getTimezonesList');
	}

	/**
	 * Unknown
	 */
	public function getUniqueSiteTimezones() {
		return $this->request('SitesManager.getUniqueSiteTimezones');
	}

	/**
	 * Get all sites which matches the pattern
	 *
	 * @param string $pattern
	 */
	public function getPatternMatchSites($pattern) {
		return $this->request('SitesManager.getPatternMatchSites', array(
			'pattern' => $pattern,
		));
	}


	/**
	 * MODULE: TRANSITIONS
	 * Get transitions for page URLs, titles and actions
	 */

	/***
	 * Get transitions for a page title
	 *
	 * @param $pageTitle
	 * @param string $segment
	 * @param string $limitBeforeGrouping
	 * @return mixed
	 */
	public function getTransitionsForPageTitle($pageTitle, $segment = '', $limitBeforeGrouping = '') {
		return $this->request('Transitions.getTransitionsForPageTitle', array(
			'pageTitle' => $pageTitle,
			'segment' => $segment,
			'limitBeforeGrouping' => $limitBeforeGrouping,
		));
	}

	/***
	 * Get transitions for a page URL
	 *
	 * @param $pageUrl
	 * @param string $segment
	 * @param string $limitBeforeGrouping
	 * @return mixed
	 */
	public function getTransitionsForPageUrl($pageUrl, $segment = '', $limitBeforeGrouping = '') {
		return $this->request('Transitions.getTransitionsForPageTitle', array(
			'pageUrl' => $pageUrl,
			'segment' => $segment,
			'limitBeforeGrouping' => $limitBeforeGrouping,
		));
	}

	/***
	 * Get transitions for a page URL
	 *
	 * @param $actionName
	 * @param $actionType
	 * @param string $segment
	 * @param string $limitBeforeGrouping
	 * @param string $parts
	 * @param bool $returnNormalizedUrls
	 * @return mixed
	 */
	public function getTransitionsForAction($actionName, $actionType, $segment = '', $limitBeforeGrouping = '', $parts = 'all', $returnNormalizedUrls = '') {
		return $this->request('Transitions.getTransitionsForAction', array(
			'actionName' => $actionName,
			'actionType' => $actionType,
			'segment' => $segment,
			'limitBeforeGrouping' => $limitBeforeGrouping,
			'parts' => $parts,
			'returnNormalizedUrls' => $returnNormalizedUrls,
		));
	}

	/**
	 * Get translations for the transitions
	 *
	 * @return mixed
	 */
	public function getTransitionsTranslations() {
		return $this->request('Transitions.getTranslations');
	}

	/**
	 * MODULE: USER COUNTRY
	 * Get visitors country information
	 */

	/**
	 * Get countries of all visitors
	 *
	 * @param string $segment
	 */
	public function getCountry($segment = '') {
		return $this->request('UserCountry.getCountry', array(
			'segment' => $segment,
		));
	}

	/**
	 * Get continents of all visitors
	 *
	 * @param string $segment
	 */
	public function getContinent($segment = '') {
		return $this->request('UserCountry.getContinent', array(
			'segment' => $segment,
		));
	}

	/**
	 * Get regions of all visitors
	 *
	 * @param string $segment
	 */
	public function getRegion($segment = '') {
		return $this->request('UserCountry.getRegion', array(
			'segment' => $segment,
		));
	}

	/**
	 * Get cities of all visitors
	 *
	 * @param string $segment
	 */
	public function getCity($segment = '') {
		return $this->request('UserCountry.getCity', array(
			'segment' => $segment,
		));
	}

	/**
	 * Get the number of disting countries
	 *
	 * @param string $segment
	 */
	public function getCountryNumber($segment = '') {
		return $this->request('UserCountry.getNumberOfDistinctCountries', array(
			'segment' => $segment,
		));
	}

	/**
	 * MODULE: USER SETTINGS
	 * Get the user settings
	 */

	/**
	 * Get resolution
	 *
	 * @param string $segment
	 */
	public function getResolution($segment = '') {
		return $this->request($this->parseUrl('UserSettings.getResolution'), array(
			'segment' => $segment,
		));
	}

	/**
	 * Get configuration
	 *
	 * @param string $segment
	 */
	public function getConfiguration($segment = '') {
		return $this->request($this->parseUrl('UserSettings.getConfiguration'), array(
			'segment' => $segment,
		));
	}

	/**
	 * Get operating system
	 *
	 * @param string $segment
	 * @param bool $addShortLabel
	 */
	public function getOs($segment = '', $addShortLabel = '1') {
		return $this->request($this->parseUrl('UserSettings.getOS'), array(
			'segment' => $segment,
			'addShortLabel' => $addShortLabel,
		));
	}

	/**
	 * Get operating system family
	 *
	 * @param string $segment
	 */
	public function getOSFamily($segment = '') {
		return $this->request($this->parseUrl('UserSettings.getOSFamily'), array(
			'segment' => $segment,
		));
	}

	/**
	 * Get Mobile vs Desktop
	 *
	 * @param string $segment
	 */
	public function getMobileVsDesktop($segment = '') {
		return $this->request($this->parseUrl('UserSettings.getMobileVsDesktop '), array(
			'segment' => $segment,
		));
	}

	/**
	 * Get browser version
	 *
	 * @param string $segment
	 */
	public function getBrowserVersion($segment = '') {
		return $this->request($this->parseUrl('UserSettings.getBrowserVersion'), array(
			'segment' => $segment,
		));
	}

	/**
	 * Get browser
	 *
	 * @param string $segment
	 */
	public function getBrowser($segment = '') {
		return $this->request($this->parseUrl('UserSettings.getBrowser'), array(
			'segment' => $segment,
		));
	}

	/**
	 * Get browser type
	 *
	 * @param string $segment
	 */
	public function getBrowserType($segment = '') {
		return $this->request($this->parseUrl('UserSettings.getBrowserType'), array(
			'segment' => $segment,
		));
	}

	/**
	 * Get wide screen information
	 *
	 * @param string $segment
	 */
	public function getWideScreen($segment = '') {
		return $this->request($this->parseUrl('UserSettings.getWideScreen'), array(
			'segment' => $segment,
		));
	}

	/**
	 * Get plugins
	 *
	 * @param string $segment
	 */
	public function getUserPlugin($segment = '') {
		return $this->request($this->parseUrl('UserSettings.getPlugin'), array(
			'segment' => $segment,
		));
	}

	/**
	 * MODULE: USER MANAGER
	 * Manage piwik users
	 */

	/**
	 * Set user preference
	 *
	 * @param string $userLogin Username
	 * @param string $preferenceName
	 * @param string $preferenceValue
	 */
	public function setUserPreference($userLogin, $preferenceName, $preferenceValue) {
		return $this->request($this->parseUrl('UsersManager.setUserPreference'), array(
			'userLogin' => $userLogin,
			'preferenceName' => $preferenceName,
			'preferenceValue' => $preferenceValue,
		));
	}

	/**
	 * Get user preference
	 *
	 * @param string $userLogin Username
	 * @param string $preferenceName
	 */
	public function getUserPreference($userLogin, $preferenceName) {
		return $this->request($this->parseUrl('UsersManager.getUserPreference'), array(
			'userLogin' => $userLogin,
			'preferenceName' => $preferenceName,
		));
	}

	/**
	 * Get user by username
	 *
	 * @param array $userLogins Array with Usernames
	 */
	public function getUsers($userLogins = '') {
		return $this->request($this->parseUrl('UsersManager.getUsers'), array(
			'userLogins' => $userLogins,
		));
	}

	/**
	 * Get all user logins
	 */
	public function getUsersLogin() {
		return $this->request($this->parseUrl('UsersManager.getUsersLogin'));
	}

	/**
	 * Get sites by user access
	 *
	 * @param string $access
	 */
	public function getUsersSitesFromAccess($access) {
		return $this->request($this->parseUrl('UsersManager.getUsersSitesFromAccess'), array(
			'access' => $access,
		));
	}

	/**
	 * Get all users with access level from the current site
	 */
	public function getUsersAccess() {
		return $this->request($this->parseUrl('UsersManager.getUsersAccessFromSite'));
	}

	/**
	 * Get all users with access $access to the current site
	 *
	 * @param string $access
	 */
	public function getUsersWithSiteAccess($access) {
		return $this->request($this->parseUrl('UsersManager.getUsersWithSiteAccess'), array(
			'access' => $access,
		));
	}

	/**
	 * Get site access from the user $userLogin
	 *
	 * @param string $userLogin Username
	 */
	public function getSitesAccessFromUser($userLogin) {
		return $this->request($this->parseUrl('UsersManager.getSitesAccessFromUser'), array(
			'userLogin' => $userLogin,
		));
	}

	/**
	 * Get user by login
	 *
	 * @param string $userLogin Username
	 */
	public function getUser($userLogin) {
		return $this->request($this->parseUrl('UsersManager.getUser'), array(
			'userLogin' => $userLogin,
		));
	}

	/**
	 * Get user by email
	 *
	 * @param string $userEmail
	 */
	public function getUserByEmail($userEmail) {
		return $this->request($this->parseUrl('UsersManager.getUserByEmail'), array(
			'userEmail' => $userEmail,
		));
	}

	/**
	 * Add a user
	 *
	 * @param string $userLogin Username
	 * @param string $password Password in clear text
	 * @param string $email
	 * @param string $alias
	 */
	public function addUser($userLogin, $password, $email, $alias = '') {
		return $this->request($this->parseUrl('UsersManager.addUser'), array(
			'userLogin' => $userLogin,
			'password' => $password,
			'email' => $email,
			'alias' => $alias,
		));
	}

	/**
	 * Update a user
	 *
	 * @param string $userLogin Username
	 * @param string $password Password in clear text
	 * @param string $email
	 * @param string $alias
	 */
	public function updateUser($userLogin, $password = '', $email = '', $alias = '') {
		return $this->request($this->parseUrl('UsersManager.updateUser'), array(
			'userLogin' => $userLogin,
			'password' => $password,
			'email' => $email,
			'alias' => $alias,
		));
	}

	/**
	 * Delete a user
	 *
	 * @param string $userLogin Username
	 */
	public function deleteUser($userLogin) {
		return $this->request($this->parseUrl('UsersManager.deleteUser'), array(
			'userLogin' => $userLogin,
		));
	}

	/**
	 * Checks if a user exist
	 *
	 * @param string $userLogin
	 */
	public function userExists($userLogin) {
		return $this->request($this->parseUrl('UsersManager.userExists'), array(
			'userLogin' => $userLogin,
		));
	}

	/**
	 * Checks if a user exist by email
	 *
	 * @param string $userEmail
	 */
	public function userEmailExists($userEmail) {
		return $this->request($this->parseUrl('UsersManager.userEmailExists'), array(
			'userEmail' => $userEmail,
		));
	}

	/**
	 * Grant access to multiple sites
	 *
	 * @param string $userLogin Username
	 * @param string $access
	 * @param array $idSites
	 */
	public function setUserAccess($userLogin, $access, $idSites) {
		return $this->request($this->parseUrl('UsersManager.setUserAccess'), array(
			'userLogin' => $userLogin,
			'access' => $access,
			'idSites' => $idSites,
		));
	}

	/**
	 * Get the token for a user
	 *
	 * @param string $userLogin Username
	 * @param string $md5Password Password in clear text
	 */
	public function getTokenAuth($userLogin, $md5Password) {
		return $this->request($this->parseUrl('UsersManager.getTokenAuth'), array(
			'userLogin' => $userLogin,
			'md5Password' => md5($md5Password),
		));
	}

	/**
	 * MODULE: VISIT FREQUENCY
	 * Get visit frequency
	 */

	/**
	 * Get the visit frequency
	 *
	 * @param string $segment
	 * @param string $columns
	 */
	public function getVisitFrequency($segment = '', $columns = '') {
		return $this->request('VisitFrequency.get', array(
			'segment' => $segment,
			'columns' => $columns,
		));
	}

	/**
	 * MODULE: VISIT TIME
	 * Get visit time
	 */

	/**
	 * Get the visit by local time
	 *
	 * @param string $segment
	 */
	public function getVisitLocalTime($segment = '') {
		return $this->request('VisitTime.getVisitInformationPerLocalTime', array(
			'segment' => $segment,
		));
	}

	/**
	 * Get the visit by server time
	 *
	 * @param string $segment
	 * @param boolean $hideFutureHoursWhenToday Hide the future hours when the report is created for today
	 */
	public function getVisitServerTime($segment = '', $hideFutureHoursWhenToday = '') {
		return $this->request('VisitTime.getVisitInformationPerServerTime', array(
			'segment' => $segment,
			'hideFutureHoursWhenToday' => $hideFutureHoursWhenToday,
		));
	}

	/**
	 * Get the visit by server time
	 *
	 * @param string $segment
	 */
	public function getByDayOfWeek($segment = '') {
		return $this->request('VisitTime.getByDayOfWeek', array(
			'segment' => $segment,
		));
	}

	/**
	 * MODULE: VISITOR INTEREST
	 * Get the interests of the visitor
	 */

	/**
	 * Get the number of visits per visit duration
	 *
	 * @param string $segment
	 */
	public function getNumberOfVisitsPerDuration($segment = '') {
		return $this->request('VisitorInterest.getNumberOfVisitsPerVisitDuration', array(
			'segment' => $segment,
		));
	}

	/**
	 * Get the number of visits per visited page
	 *
	 * @param string $segment
	 */
	public function getNumberOfVisitsPerPage($segment = '') {
		return $this->request('VisitorInterest.getNumberOfVisitsPerPage', array(
			'segment' => $segment,
		));
	}

	/**
	 * Get the number of days elapsed since the last visit
	 *
	 * @param string $segment
	 */
	public function getNumberOfVisitsByDaySinceLast($segment = '') {
		return $this->request('VisitorInterest.getNumberOfVisitsByDaysSinceLast', array(
			'segment' => $segment,
		));
	}

	/**
	 * Get the number of visits by visit count
	 *
	 * @param string $segment
	 */
	public function getNumberOfVisitsByCount($segment = '') {
		return $this->request('VisitorInterest.getNumberOfVisitsByVisitCount', array(
			'segment' => $segment,
		));
	}

	/**
	 * MODULE: VISITS SUMMARY
	 * Get visit summary information
	 */

	/**
	 * Get a visit summary
	 *
	 * @param string $segment
	 * @param string $columns
	 */
	public function getVisitsSummary($segment = '', $columns = '') {
		return $this->request('VisitsSummary.get', array(
			'segment' => $segment,
			'columns' => $columns,
		));
	}

	/**
	 * Get visits
	 *
	 * @param string $segment
	 */
	public function getVisits($segment = '') {
		return $this->request('VisitsSummary.getVisits', array(
			'segment' => $segment,
		));
	}

	/**
	 * Get unique visits
	 *
	 * @param string $segment
	 */
	public function getUniqueVisitors($segment = '') {
		return $this->request('VisitsSummary.getUniqueVisitors', array(
			'segment' => $segment,
		));
	}

	/**
	 * Get actions
	 *
	 * @param string $segment
	 */
	public function getActions($segment = '') {
		return $this->request('VisitsSummary.getActions', array(
			'segment' => $segment,
		));
	}

	/**
	 * Get max actions
	 *
	 * @param string $segment
	 */
	public function getMaxActions($segment = '') {
		return $this->request('VisitsSummary.getMaxActions', array(
			'segment' => $segment,
		));
	}

	/**
	 * Get bounce count
	 *
	 * @param string $segment
	 */
	public function getBounceCount($segment = '') {
		return $this->request('VisitsSummary.getBounceCount', array(
			'segment' => $segment,
		));
	}

	/**
	 * Get converted visits
	 *
	 * @param string $segment
	 */
	public function getVisitsConverted($segment = '') {
		return $this->request('VisitsSummary.getVisitsConverted', array(
			'segment' => $segment,
		));
	}

	/**
	 * Get the sum of all visit lengths
	 *
	 * @param string $segment
	 */
	public function getSumVisitsLength($segment = '') {
		return $this->request('VisitsSummary.getSumVisitsLength', array(
			'segment' => $segment,
		));
	}

	/**
	 * Get the sum of all visit lengths formated in the current language
	 *
	 * @param string $segment
	 */
	public function getSumVisitsLengthPretty($segment = '') {
		return $this->request('VisitsSummary.getSumVisitsLengthPretty', array(
			'segment' => $segment,
		));
	}
}