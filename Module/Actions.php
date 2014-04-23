<?php

namespace CiscoSystems\PiwikBundle\Module;

use CiscoSystems\PiwikBundle\Connection\Request;
use CiscoSystems\PiwikBundle\Module\Module as Base;

/**
 * MODULE: ACTIONS
 *
 * @see http://developer.piwik.org/api-reference/reporting-api#toc-metric-definitions
 *
 * The Actions API lets you request reports for all your Visitor Actions:
 * Page URLs, Page titles (Piwik Events), File Downloads and Clicks on external
 * websites. For example, "getPageTitles" will return all your page titles along
 * with standard Actions metrics for each row. It is also possible to request
 * data for a specific Page Title with "getPageTitle" and setting the parameter
 * pageName to the page title you wish to request. Similarly, you can request
 * metrics for a given Page URL via "getPageUrl", a Download file via
 * "getDownload" and an outlink via "getOutlink". Note: pageName, pageUrl,
 * outlinkUrl, downloadUrl parameters must be URL encoded before you call the
 * API.
 */
class Actions extends Base
{
    public function __construct( Request $request )
    {
        parent::__construct( $request, 'Actions' );
    }

    /**
     * Get actions
     *
     * @param string $segment
     * @param string $columns
     */
    public function get( $idSite, $period, $date, $segment = '', $columns = '' )
    {
        $this->setQuery( 'get' );
        $this->setParameters( array(
            'idSite'    => $idSite,
            'period'    => $period,
            'date'      => $date,
            'segment'   => $segment,
            'columns'   => $columns,
        ));

        return $this->execute();
    }

    /**
     * Get page urls
     *
     * @param string $segment
     * @param string $expanded
     * @param int $idSubtable
     */
    public function getPageUrls( $idSite, $period, $date, $segment = '', $expanded = '', $idSubtable = '', $depth = '' )
    {
        $this->setQuery( 'getPageUrls' );
        $this->setParameters( array(
            'idSite'        => $idSite,
            'period'        => $period,
            'date'          => $date,
            'segment'       => $segment,
            'expanded'      => $expanded,
            'idSubtable'    => $idSubtable,
            'depth'         => $depth,
        ));

        return $this->execute();
    }

    /**
     * Get page URLs after a site search
     *
     * @param string $segment
     * @param string $expanded
     * @param int $idSubtable
     */
    public function getPageUrlsFollowingSiteSearch( $idSite, $period, $date, $segment = '', $expanded = '', $idSubtable = '' )
    {
        $this->setQuery( 'getPageUrlsFollowingSiteSearch' );
        $this->setParameters( array(
            'idSite'        => $idSite,
            'period'        => $period,
            'date'          => $date,
            'segment'       => $segment,
            'expanded'      => $expanded,
            'idSubtable'    => $idSubtable,
        ));

        return $this->execute();
    }

    /**
     * Get page titles after a site search
     *
     * @param string $segment
     * @param string $expanded
     * @param int $idSubtable
     */
    public function getPageTitlesFollowingSiteSearch( $idSite, $period, $date, $segment = '', $expanded = '', $idSubtable = '' )
    {
        $this->setQuery( 'getPageTitlesFollowingSiteSearch' );
        $this->setParameters( array(
            'idSite'        => $idSite,
            'period'        => $period,
            'date'          => $date,
            'segment'       => $segment,
            'expanded'      => $expanded,
            'idSubtable'    => $idSubtable,
        ));

        return $this->execute();
    }

    /**
     * Get entry page urls
     *
     * @param string $segment
     * @param string $expanded
     * @param int $idSubtable
     */
    public function getEntryPageUrls( $idSite, $period, $date, $segment = '', $expanded = '', $idSubtable = '' )
    {
        $this->setQuery( 'getEntryPageUrls' );
        $this->setParameters( array(
            'idSite'        => $idSite,
            'period'        => $period,
            'date'          => $date,
            'segment'       => $segment,
            'expanded'      => $expanded,
            'idSubtable'    => $idSubtable,
        ));

        return $this->execute();
    }

    /**
     * Get exit page urls
     *
     * @param string $segment
     * @param string $expanded
     * @param int $idSubtable
     */
    public function getExitPageUrls( $idSite, $period, $date, $segment = '', $expanded = '', $idSubtable = '' )
    {
        $this->setQuery( 'getExitPageUrls' );
        $this->setParameters( array(
            'idSite'        => $idSite,
            'period'        => $period,
            'date'          => $date,
            'segment'       => $segment,
            'expanded'      => $expanded,
            'idSubtable'    => $idSubtable,
        ));

        return $this->execute();
    }

    /**
     * Get page url information
     *
     * @param string $pageUrl The page url
     * @param string $segment
     * @param string $expanded
     * @param int $idSubtable
     */
    public function getPageUrl( $pageUrl, $idSite, $period, $date, $segment = '' )
    {
        $this->setQuery( 'getPageUrl' );
        $this->setParameters( array(
            'pageUrl'   => $pageUrl,
            'idSite'    => $idSite,
            'period'    => $period,
            'date'      => $date,
            'segment'   => $segment,
        ));

        return $this->execute();
    }

    /**
     * Get page titles
     *
     * @param string $segment
     * @param string $expanded
     * @param int $idSubtable
     */
    public function getPageTitles( $idSite, $period, $date, $segment = '', $expanded = '', $idSubtable = '' )
    {
        $this->setQuery( 'getPageTitles' );
        $this->setParameters( array(
            'idSite'        => $idSite,
            'period'        => $period,
            'date'          => $date,
            'segment'       => $segment,
            'expanded'      => $expanded,
            'idSubtable'    => $idSubtable,
        ));

        return $this->execute();
    }

    /**
     * Get entry page urls
     *
     * @param string $segment
     * @param string $expanded
     * @param int $idSubtable
     */
    public function getEntryPageTitles( $idSite, $period, $date, $segment = '', $expanded = '', $idSubtable = '' )
    {
        $this->setQuery( 'getEntryPageTitles' );
        $this->setParameters( array(
            'idSite'        => $idSite,
            'period'        => $period,
            'date'          => $date,
            'segment'       => $segment,
            'expanded'      => $expanded,
            'idSubtable'    => $idSubtable,
        ));

        return $this->execute();
    }

    /**
     * Get exit page urls
     *
     * @param string $segment
     * @param string $expanded
     * @param int $idSubtable
     */
    public function getExitPageTitles( $idSite, $period, $date, $segment = '', $expanded = '', $idSubtable = '' )
    {
        $this->setQuery( 'getExitPageTitles' );
        $this->setParameters( array(
            'idSite'        => $idSite,
            'period'        => $period,
            'date'          => $date,
            'segment'       => $segment,
            'expanded'      => $expanded,
            'idSubtable'    => $idSubtable,
        ));

        return $this->execute();
    }

    /**
     * Get page titles
     *
     * @param string $pageName The page name
     * @param string $segment
     * @param string $expanded
     * @param int $idSubtable
     */
    public function getPageTitle( $pageName, $idSite, $period, $date, $segment = '' )
    {
        $this->setQuery( 'getExitPageTitles' );
        $this->setParameters( array(
            'pageName'  => $pageName,
            'idSite'    => $idSite,
            'period'    => $period,
            'date'      => $date,
            'segment'   => $segment,
        ));

        return $this->execute();
    }

    /**
     * Get downloads
     *
     * @param string $segment
     * @param string $expanded
     * @param int $idSubtable
     */
    public function getDownloads( $idSite, $period, $date, $segment = '', $expanded = '', $idSubtable = '' )
    {
        $this->setQuery( 'getDownloads' );
        $this->setParameters( array(
            'idSite'        => $idSite,
            'period'        => $period,
            'date'          => $date,
            'segment'       => $segment,
            'expanded'      => $expanded,
            'idSubtable'    => $idSubtable,
        ));

        return $this->execute();
    }

    /**
     * Get download information
     *
     * @param string $downloadUrl URL of the download
     * @param string $segment
     * @param string $expanded
     * @param int $idSubtable
     */
    public function getDownload( $downloadUrl, $idSite, $period, $date, $segment = '' )
    {
        $this->setQuery( 'getDownloads' );
        $this->setParameters( array(
            'downloadUrl'   => $downloadUrl,
            'idSite'        => $idSite,
            'period'        => $period,
            'date'          => $date,
            'segment'       => $segment,
        ));

        return $this->execute();
    }

    /**
     * Get outlinks
     *
     * @param string $segment
     * @param string $expanded
     * @param int $idSubtable
     */
    public function getOutlinks( $idSite, $period, $date, $segment = '', $expanded = '', $idSubtable = '' )
    {
        $this->setQuery( 'getOutlinks' );
        $this->setParameters( array(
            'idSite'        => $idSite,
            'period'        => $period,
            'date'          => $date,
            'segment'       => $segment,
            'expanded'      => $expanded,
            'idSubtable'    => $idSubtable,
        ));

        return $this->execute();
    }

    /**
     * Get outlink information
     *
     * @param string $outlinkUrl URL of the outlink
     * @param string $segment
     * @param string $expanded
     * @param int $idSubtable
     */
    public function getOutlink( $outlinkUrl, $idSite, $period, $date, $segment = '' )
    {
        $this->setQuery( 'getOutlink' );
        $this->setParameters( array(
            'outlinkUrl'    => $outlinkUrl,
            'idSite'        => $idSite,
            'period'        => $period,
            'date'          => $date,
            'segment'       => $segment,
        ));

        return $this->execute();
    }

    /**
     * Get
     *
     * @param string $segment
     */
    public function getSiteSearchKeywords( $idSite, $period, $date, $segment = '' )
    {
        $this->setQuery( 'getSiteSearchKeywords' );
        $this->setParameters( array(
            'idSite'        => $idSite,
            'period'        => $period,
            'date'          => $date,
            'segment'       => $segment,
        ));

        return $this->execute();
    }

    /**
     * Get
     *
     * @param array $dataTable
     * @param string $columnToRead
     */
    public function addPagesPerSearchColumn( $dataTable = array(), $columnToRead = 'nb_hits' )
    {
        $this->setQuery( 'addPagesPerSearchColumn' );
        $this->setParameters( array(
            'dataTable'     => $dataTable,
            'columnToRead'  => $columnToRead,
        ));

        return $this->execute();
    }

    /**
     * Get
     *
     * @param string $segment
     */
    public function getSiteSearchNoResultKeywords( $idSite, $period, $date, $segment = '' )
    {
        $this->setQuery( 'getSiteSearchNoResultKeywords' );
        $this->setParameters( array(
            'idSite'        => $idSite,
            'period'        => $period,
            'date'          => $date,
            'segment'       => $segment,
        ));

        return $this->execute();
    }

    /**
     * Get
     *
     * @param string $segment
     */
    public function getSiteSearchCategories( $idSite, $period, $date, $segment = '' )
    {
        $this->setQuery( 'getSiteSearchCategories' );
        $this->setParameters( array(
            'idSite'        => $idSite,
            'period'        => $period,
            'date'          => $date,
            'segment'       => $segment,
        ));

        return $this->execute();
    }
}