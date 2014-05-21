<?php

namespace CiscoSystems\PiwikBundle\Module;

use CiscoSystems\PiwikBundle\Connection\Request;
use CiscoSystems\PiwikBundle\Module\AbstractModule as Base;

/**
 * MODULE: API
 *
 * @see http://developer.piwik.org/api-reference/metadata
 *
 * This API is the Metadata API: it gives information about all other available
 * APIs methods, as well as providing human readable and more complete outputs
 * than normal API methods. Some of the information that is returned by the Metadata API:
 *
 *  the dynamically generated list of all API methods via "getReportMetadata";
 *  the list of metrics that will be returned by each method, along with their
 *      human readable name, via "getDefaultMetrics" and "getDefaultProcessedMetrics";
 *  the list of segments metadata supported by all functions that have a 'segment'
 *      parameter;
 *  the (truly magic) method "getProcessedReport" will return a human readable
 *      version of any other report, and include the processed metrics such as
 *      conversion rate, time on site, etc. which are not directly available
 *      in other methods;
 *  the method "getSuggestedValuesForSegment" returns top suggested values for
 *      a particular segment. It uses the Live.getLastVisitsDetails API to
 *      fetch the most recently used values, and will return the most often
 *      used values first;
 */
class API extends Base
{
    public function __construct( Request $request )
    {
        parent::__construct( $request, 'API' );
    }

    public function getPiwikVersion()
    {
        $this->setQuery( 'getPiwikVersion' );

        return $this->execute();
    }

    public function getSettings()
    {
        $this->setQuery( 'getSettings' );

        return $this->execute();
    }

    /**
     * Get default metric translations
     */
    public function getDefaultMetricTranslations()
    {
        $this->setQuery( 'getDefaultMetricTranslations' );

        return $this->execute();
    }

    /**
     * Get default metrics
     */
    public function getDefaultMetrics()
    {
        $this->setQuery( 'getDefaultMetrics' );

        return $this->execute();
    }

    /**
     * Get default processed metrics
     */
    public function getDefaultProcessedMetrics()
    {
        $this->setQuery( 'getDefaultProcessedMetrics' );

        return $this->execute();
    }

    /**
     * Get default metrics documentation
     */
    public function getDefaultMetricsDocumentation()
    {
        $this->setQuery( 'getDefaultMetricsDocumentation' );

        return $this->execute();
    }

    /**
     * Get default metric translations
     *
     * @param array $sites Array with the ID's of the sites
     */
    public function getSegmentsMetadata( $sites = array() )
    {
        $this->setQuery( 'getSegmentsMetadata' );
        $this->setParameters( array(
            'idSites' => $sites,
        ));

        return $this->execute();
    }

    /**
     * Get the url of the logo
     *
     * @param boolean $pathOnly Return the url (false) or the absolute path (true)
     */
    public function getLogoUrl( $pathOnly = false )
    {
        $this->setQuery( 'getLogoUrl' );
        $this->setParameters( array(
            'pathOnly' => $pathOnly,
        ));

        return $this->execute();
    }

    /**
     * Get the url of the header logo
     *
     * @param boolean $pathOnly Return the url (false) or the absolute path (true)
     */
    public function getHeaderLogoUrl( $pathOnly = false )
    {
        $this->setQuery( 'getHeaderLogoUrl' );
        $this->setParameters( array(
            'pathOnly' => $pathOnly,
        ));

        return $this->execute();
    }

    /**
     * Get metadata from the API
     *
     * @param string $apiModule Module
     * @param string $apiAction Action
     * @param array $apiParameters Parameters
     */
    public function getMetadata(
            $idSite,
            $apiModule,
            $apiAction,
            $apiParameters = array(),
            $language = '',
            $period = '',
            $date = '',
            $hideMetricsDoc = '',
            $showSubtableReports = ''
    )
    {
        $this->setQuery( 'getMetadata' );
        $this->setParameters( array(
            'idSite'                => $idSite,
            'apiModule'             => $apiModule,
            'apiAction'             => $apiAction,
            'apiParameters'         => $apiParameters,
            'language'              => $language,
            'period'                => $period,
            'date'                  => $date,
            'hideMetricsDoc'        => $hideMetricsDoc,
            'showSubtableReports'   => $showSubtableReports,
        ));

        return $this->execute();
    }

    /**
     * Get metadata from a report
     *
     * @param array $idSites Array with the ID's of the sites
     * @param string $hideMetricsDoc
     * @param string $showSubtableReports
     */
    public function getReportMetadata(
            $idSites = '',
            $period = '',
            $date = '',
            $hideMetricsDoc = '',
            $showSubtableReports = ''
    )
    {
        $this->setQuery( 'getReportMetadata' );
        $this->setParameters( array(
            'idSites'               => $idSites,
            'period'                => $period,
            'date'                  => $date,
            'hideMetricsDoc'        => $hideMetricsDoc,
            'showSubtableReports'   => $showSubtableReports,
        ));

        return $this->execute();
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
    public function getProcessedReport(
            $idSites,
            $period,
            $date,
            $apiModule,
            $apiAction,
            $segment = '',
            $apiParameters = array(),
            $idGoal = '',
            $language = '',
            $showTimer = '1',
            $hideMetricsDoc = '',
            $idSubtable = '',
            $showRawMetrics = ''
    )
    {
        $this->setQuery( 'getProcessedReport' );
        $this->setParameters( array(
            'idSites'           => $idSites,
            'period'            => $period,
            'date'              => $date,
            'apiModule'         => $apiModule,
            'apiAction'         => $apiAction,
            'segment'           => $segment,
            'apiParameters'     => $apiParameters,
            'idGoal'            => $idGoal,
            'language'          => $language,
            'showTimer'         => $showTimer,
            'hideMetricsDoc'    => $hideMetricsDoc,
            'idSubtable'        => $idSubtable,
            'showRawMetrics'    => $showRawMetrics,
        ));

        return $this->execute();
    }

    /**
     * Unknown
     *
     * @param string $segment
     * @param string $columns
     */
    public function getApi( $idSites, $period, $date, $segment = '', $columns = '' )
    {
        $this->setQuery( 'get' );
        $this->setParameters( array(
            'idSites' => $idSites,
            'period'  => $period,
            'date'    => $date,
            'segment' => $segment,
            'columns' => $columns,
        ));

        return $this->execute();
    }


    /**
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
    public function getRowEvolution(
            $idSites,
            $period,
            $date,
            $apiModule,
            $apiAction,
            $label = '',
            $segment = '',
            $column = '',
            $language = '',
            $idGoal = '',
            $legendAppendMetric = '1',
            $labelUseAbsoluteUrl = '1'
    )
    {
        $this->setQuery( 'getRowEvolution' );
        $this->setParameters( array(
            'idSites'               => $idSites,
            'period'                => $period,
            'date'                  => $date,
            'apiModule'             => $apiModule,
            'apiAction'             => $apiAction,
            'label'                 => $label,
            'segment'               => $segment,
            'column'                => $column,
            'idGoal'                => $idGoal,
            'language'              => $language,
            'legendAppendMetric'    => $legendAppendMetric,
            'labelUseAbsoluteUrl'   => $labelUseAbsoluteUrl,
        ));

        return $this->execute();
    }

    public function getLastDate( $date, $period )
    {
        $this->setQuery( 'getLastDate' );
        $this->setParameters( array(
            'date'      => $date,
            'period'    => $period,
        ));

        return $this->execute();
    }

    /**
     * Get the result of multiple requests bundled together
     *
     * @param array $urls
     */
    public function getBulkRequest( $urls )
    {
        $this->setQuery( 'getBulkRequest' );
        $this->setParameters( array(
            'urls' => $urls,
        ));

        return $this->execute();
    }

    public function getSuggestedValuesForSegment( $segmentName, $idSite )
    {
        $this->setQuery( 'getSuggestedValuesForSegment' );
        $this->setParameters( array(
            'segmentName'   => $segmentName,
            'idSite'        => $idSite,
        ));

        return $this->execute();
    }
}