<?php

namespace CiscoSystems\PiwikBundle\Module;

use CiscoSystems\PiwikBundle\Connection\Request;
use CiscoSystems\PiwikBundle\Module\Module as Base;

/**
 * MODULE: LIVE
 *
 * @see http://piwik.org/docs/real-time/
 *
 * The Live! API lets you access complete visit level information about your
 * visitors. Combined with the power of Segmentation, you will be able to request
 * visits filtered by any criteria. The method "getLastVisitsDetails" will
 * return extensive data for each visit, which includes: server time, visitId,
 * visitorId, visitorType (new or returning), number of pages, list of all pages
 * (and events, file downloaded and outlinks clicked), custom variables names
 * and values set to this visit, number of goal conversions (and list of all
 * Goal conversions for this visit, with time of conversion, revenue, URL, etc.),
 * but also other attributes such as: days since last visit, days since first
 * visit, country, continent, visitor IP, provider, referrer used (referrer name,
 * keyword if it was a search engine, full URL), campaign name and keyword,
 * operating system, browser, type of screen, resolution, supported browser
 * plugins (flash, java, silverlight, pdf, etc.), various dates & times format
 * to make it easier for API users... and more! With the parameter '&segment='
 * you can filter the returned visits by any criteria (visitor IP, visitor ID,
 * country, keyword used, time of day, etc.). The method "getCounters" is used
 * to return a simple counter: visits, number of actions, number of converted
 * visits, in the last N minutes. See also the documentation about Real time
 * widget and visitor level reports in Piwik.
 */
class Live extends Base
{
    public function __construct( Request $request )
    {
        parent::__construct( $request, 'Live' );
    }

    /**
     * Get a short information about the visit counts in the last minutes
     *
     * @param int $lastMinutes Default: 60
     * @param string $segment
     */
    public function getCounters( $idSite, $lastMinutes = 60, $segment = '' )
    {
        $this->setQuery( 'getCounters' );
        $this->setParameters( array(
            'idSite'        => $idSite,
            'lastMinutes'   => $lastMinutes,
            'segment'       => $segment,
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
    public function getLastVisitsDetails(
            $idSite,
            $period = '',
            $date = '',
            $segment = '',
            $countVisitorsToFetch = '',
            $minTimestamp = '',
            $flat = '',
            $doNotFechActions = ''
    )
    {
        $this->query( 'getLastVisitsDetails' );
        $this->setParameters( array(
            'idSite'                => $idSite,
            'period'                => $period,
            'date'                  => $date,
            'segment'               => $segment,
            'countVisitorsToFetch'  => $countVisitorsToFetch,
            'minTimestamp'          => $minTimestamp,
            'flat'                  => $flat,
            'doNotFetchActions'     => $doNotFechActions,

        ));

        return $this->execute();
    }

    public function getVisitorProfile( $idSite, $visitorId = '', $segment = '', $checkForLatLong = '' )
    {
        $this->query( 'getVisitorProfile' );
        $this->setParameters( array(
            'idSite'            => $idSite,
            'visitorId'         => $visitorId,
            'segment'           => $segment,
            'checkForLatLong'   => $checkForLatLong,
        ));

        return $this->execute();
    }

    public function getMostRecentVisitorId( $idSite, $segment = '' )
    {
        $this->query( 'getVisitorProfile' );
        $this->setParameters( array(
            'idSite'            => $idSite,
            'segment'           => $segment,
        ));

        return $this->execute();
    }
}