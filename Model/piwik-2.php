<?php
/**
 * @throws Zend_Service_Piwik_Exception
 *
 * @method mixed Api
 * @method mixed Actions
 * @method mixed CustomVariables
 * @method mixed Goals
 * @method mixed LanguagesManager
 * @method mixed Live
 * @method mixed PDFReports
 * @method mixed Provider
 * @method mixed Referers
 * @method mixed SEO
 * @method mixed SitesManager
 * @method mixed UserCountry
 * @method mixed UserSettings
 * @method mixed UsersManager
 * @method mixed VisitFrequency
 * @method mixed VisitTime
 * @method mixed VisitorInterest
 * @method mixed VistsSummary
 */
class Zend_Service_Piwik extends Zend_Service_Abstract
{
    const FORMAT_XML        = 'xml';
    const FORMAT_JSON       = 'json';
    const FORMAT_CSV        = 'csv';
    const FORMAT_TSV        = 'tsv';
    const FORMAT_HTML       = 'html';
    const FORMAT_PHP        = 'php';
    const FORMAT_RSS        = 'rss';
    const FORMAT_ORIGINAL   = 'original';

    const PERIOD_DAY        = 'day';
    const PERIOD_WEEK       = 'week';
    const PERIOD_MONTH      = 'month';
    const PERIOD_YEAR       = 'year';

    protected $tokenAuth        = null;
    protected $idSite           = null;
    protected $host             = null;
    protected $useSsl           = false;
    protected $format           = self::FORMAT_ORIGINAL;
    protected $formats          = array(
        self::FORMAT_CSV,
        self::FORMAT_HTML,
        self::FORMAT_JSON,
        self::FORMAT_ORIGINAL,
        self::FORMAT_PHP,
        self::FORMAT_RSS,
        self::FORMAT_TSV,
        self::FORMAT_XML
    );
    protected $prettyDisplay    = false;
    protected $serialize        = true;
    protected $period           = self::PERIOD_DAY;
    protected $periods          = array(
        self::PERIOD_DAY,
        self::PERIOD_MONTH,
        self::PERIOD_WEEK,
        self::PERIOD_YEAR
    );
    protected $date             = 'today';
    protected $filters          = array();
    protected $jsoncallback     = null;

    /**
     * Constructor
     *
     * @param Zend_Config $config
     */
    public function __construct(Zend_Config $config = null)
    {
        if (null !== $config)
        {
            $this->setConfig($config);
        }
    }

    /**
     * Magic method
     * Call a API method, e.g.:
     *
     * <pre>
     * $piwik->API->getDefaultMetrics();
     * </pre>
     *
     * @param string $module
     * @param string $params
     *
     * @return Zend_Service_Piwik_MethodProxy
     */
    public function __call($module, $params)
    {
        return new Zend_Service_Piwik_MethodProxy($module, $this);
    }

    /**
     * Set configuration options
     *
     * @param Zend_Config $config
     *
     * @return Zend_Service_Piwik
     */
    public function setConfig(Zend_Config $config)
    {
        $config = $config->toArray();

        foreach ($config as $key => $value) {
            $option = str_replace('_', ' ', strtolower($key));
            $option = str_replace(' ', '', ucwords($option));
            $method = 'set' . $option;

            if (method_exists($this, $method)) {
                $this->$method($value);
            }
        }
    }

    /**
     * Query the Piwik API
     *
     * @param string $method
     * @param array  $params
     *
     * @throws Zend_Service_Piwik_Exception
     *
     * @return string
     */
    public function queryApi($method = null, $params = array())
    {
        $client = self::getHttpClient();

        // do we have the mandatory parameters?
        if (null === $this->tokenAuth
            || null === $this->idSite
            || null === $this->host
            || null === $method)
        {
            $msg = 'One mandatory setting (tokenAuth, idSite, Host or Method) is empty.';
            throw new Zend_Service_Piwik_Exception($msg);
        }

        $client->setUri($this->host)
               ->setMethod(Zend_Http_Client::GET)
               ->setParameterGet('module', 'API')
               ->setParameterGet('token_auth', $this->tokenAuth)
               ->setParameterGet('idSite', $this->idSite)
               ->setParameterGet('format', $this->format)
               ->setParameterGet('period', $this->period)
               ->setParameterGet('date', $this->date);

        // append filters
        foreach ($this->filters as $filter)
        {
            $filterValue = $filter->getFilterValue();
            if (null !== $filterValue)
            {
                $client->setParameterGet($filter->getFilter(), $filterValue);
            }
        }

        // append method
        $client->setParameterGet('method', $method);

        // append jsoncallback
        if (null !== $this->jsoncallback)
        {
            $client->setParameterGet('jsoncallback', $this->jsoncallback);
        }

        // special options when format = PHP
        if ($this->format = self::FORMAT_PHP)
        {
            if (false !== $this->prettyDisplay)
            {
                $client->setParameterGet('prettyDisplay', $this->prettyDisplay);
            }

            if (true !== $this->serialize)
            {
                $client->setParameterGet('serialize', $this->serialize);
            }
        }

        try
        {
            return $client->request()->getBody();
        }
        catch (Zend_Http_Client_Exception $e)
        {
            $msg = 'An error occured: ' . $e->getMessage();
            throw new Zend_Service_Piwik_Exception($msg);
        }
    }

    /**
     * Return auth token
     *
     * @return string
     */
    public function getTokenAuth()
    {
        return $this->tokenAuth;
    }

    /**
     * Set auth token
     *
     * @param string $token
     *
     * @return Zend_Service_Piwik
     */
    public function setTokenAuth($token)
    {
        $this->tokenAuth = $token;

        return $this;
    }

    /**
     * Return host
     *
     * @return string
     */
    public function getHost()
    {
        return $this->host;
    }

    /**
     * Set host
     *
     * @param string $host
     *
     * @return Zend_Service_Piwik
     */
    public function setHost($host)
    {
        $this->host = $host;

        return $this;
    }

    /**
     * Is this an SSL request?
     *
     * @return boolean
     */
    public function isSsl()
    {
        return $this->useSsl;
    }

    /**
     * Switch usage of SSL
     *
     * @param boolean $useSsl
     *
     * @return Zend_Service_Piwik
     */
    public function setUseSsl($useSsl = false)
    {
        $this->useSsl = $useSsl;

        return $this;
    }

    /**
     * Return site id
     *
     * @return integer
     */
    public function getIdSite()
    {
        return $this->idSite;
    }

    /**
     * Set site id
     *
     * @param integer $siteId
     *
     * @return Zend_Service_Piwik
     */
    public function setIdSite($idSite)
    {
        $this->idSite = (integer)$idSite;

        return $this;
    }

    /**
     * Return current set format of the response
     *
     * @return string
     */
    public function getFormat()
    {
        return $this->format;
    }

    /**
     * Set the format of the response
     *
     * @param string $format
     *
     * @return Zend_Service_Piwik
     */
    public function setFormat($format = self::FORMAT_ORIGINAL)
    {
        if (in_array($format, $this->formats))
        {
            $this->format = $format;
        }

        return $this;
    }

    /**
     * Return period
     *
     * @return string
     */
    public function getPeriod()
    {
        return $this->period;
    }

    /**
     * Set period
     *
     * @param string $period
     *
     * @return Zend_Service_Piwik
     */
    public function setPeriod($period = self::PERIOD_DAY)
    {
        if (in_array($period, $this->periods))
        {
            $this->period = $period;
        }

        return $this;
    }

    /**
     * Return set date
     *
     * @return string
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set the date in various flavors
     *
     * default:       YYYY-MM-DD
     * magic formats: today, yesterday (these are relative to the webservers timezone)
     * ranges:        lastX (where X is the number of days incl. today)
     *                previousX (where X is the number of days without today)
     *                YYYY-MM-DD,YYYY-MM-DD (in between the 2 dates)
     *
     * @param string $date
     *
     * @return Zend_Service_Piwik
     */
    public function setDate($date = '')
    {
        if (Zend_Date::isDate($date, 'YYYY-MM-DD'))
        {
            $this->date = $date;
        }
        else if (preg_match('#(last|previous)[0-9]+#si', $date))
        {
            $this->date = $date;
        }
        else if (in_array($date, array('today', 'yesterday')))
        {
            $this->date = $date;
        }
        else if (substr($date, 10, 1) == ',')
        {
            $dates = explode(',', $date);

            foreach ($dates as $d)
            {
                if (Zend_Date::isDate($d, 'YYYY-MM-DD'))
                {
                    continue;
                }
            }

            $date = implode(',', $dates);
        }

        return $this;
    }

    /**
     * Add filter to the service
     *
     * @param Zend_Service_Piwik_Filter_Interface $filter
     */
    public function addFilter(Zend_Service_Piwik_Filter_Interface $filter)
    {
        $this->filters[$filter->getFilter()] = $filter;
    }

    /**
     * Remove filter from filters by filtername
     *
     * @param string $filter
     */
    public function removeFilter($filter)
    {
        unset($this->filters[$filter]);
    }

    /**
     * Return JSON callback
     *
     * @return string
     */
    public function getJsonCallback()
    {
        return $this->jsoncallback;
    }

    /**
     * Set json callback
     *
     * @param string $callback
     *
     * @return Zend_Service_Piwik
     */
    public function setJsonCallback($callback = '')
    {
        $this->jsoncallback = $callback;

        return $this;
    }

    /**
     * Get the current setting for pretty display of PHP
     * content
     *
     * @return boolean
     */
    public function getPrettyDisplay()
    {
        return (boolean)$this->prettyDisplay;
    }

    /**
     * Set the state of prettyDisplay for PHP
     *
     * @param boolean $prettyDisplay
     *
     * @return Zend_Service_Piwik
     */
    public function setPrettyDisplay($prettyDisplay = false)
    {
        $this->prettyDisplay = (boolean)$prettyDisplay;

        return $this;
    }

    /**
     * Get the setting if the output should be serialized or not
     * when using format PHP
     *
     * @return boolean
     */
    public function getSerialize()
    {
        return (boolean)$this->serialize;
    }

    /**
     * Change the setting if the output should be serialized or not
     * when using format PHP
     *
     * @param boolean $serialize
     *
     * @return Zend_Service_Piwik
     */
    public function setSerialize($serialize = false)
    {
        $this->serialize = (boolean)$serialize;

        return $this;
    }
}