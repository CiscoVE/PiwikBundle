<?php

namespace CiscoSystems\PiwikBundle\Module;

use CiscoSystems\PiwikBundle\Connection\Request;
use CiscoSystems\PiwikBundle\Module\AbstractModule as Base;

/**
 * MODULE: Referers
 *
 * @see http://developer.piwik.org/api-reference/reporting-api#toc-metric-definitions
 *
 * The Referrers API lets you access reports about Websites, Search engines,
 * Keywords, Campaigns used to access your website. For example, "getKeywords"
 * returns all search engine keywords (with general analytics metrics for each
 * keyword), "getWebsites" returns referrer websites (along with the full
 * Referrer URL if the parameter &expanded=1 is set). "getReferrerType" returns
 * the Referrer overview report. "getCampaigns" returns the list of all
 * campaigns (and all campaign keywords if the parameter &expanded=1 is set).
 * The methods "getKeywordsForPageUrl" and "getKeywordsForPageTitle" are used
 * to output the top keywords used to find a page. Check out the widget "Top
 * keywords used to find this page" that you can easily re-use on your website.
 */
class Referers extends Base
{
    public function __construct( Request $request )
    {
        parent::__construct( $request, 'Referers' );
    }

    /**
     * Get referer types
     *
     * @param string $segment
     * @param string $typeReferer
     */
    public function getRefererType( $idSite, $period, $date, $segment = '', $typeReferer = '', $idSubtable = '', $expanded = '' )
    {
        $this->setQuery( 'getRefererType' );
        $this->setParameters( array(
            'idSite'        => $idSite,
            'period'        => $period,
            'date'          => $date,
            'segment'       => $segment,
            'typeReferer'   => $typeReferer,
            'idSubtable'    => $idSubtable,
            'expanded'      => $expanded,
        ));

        return $this->execute();
    }

    public function getAll( $idSite, $period, $date, $segment = '', $expanded = '' )
    {
        $this->setQuery( 'getAll' );
        $this->setParameters( array(
            'idSite'    => $idSite,
            'period'    => $period,
            'date'      => $date,
            'segment'   => $segment,
            'expanded'  => $expanded,
        ));

        return $this->execute();
    }

    /**
     * Get referer keywords
     *
     * @param string $segment
     * @param string $expanded
     */
    public function getKeywords( $idSite, $period, $date, $segment = '', $expanded = '' )
    {
        $this->setQuery( 'getKeywords' );
        $this->setParameters( array(
            'idSite'    => $idSite,
            'period'    => $period,
            'date'      => $date,
            'segment'   => $segment,
            'expanded'  => $expanded,
        ));

        return $this->execute();
    }

    /**
     * Get keywords for an url
     *
     * @param string $url
     */
    public function getKeywordsForPageUrl( $idSite, $period, $date, $url )
    {
        $this->setQuery( 'getKeywordsForPageUrl' );
        $this->setParameters( array(
            'idSite'    => $idSite,
            'period'    => $period,
            'date'      => $date,
            'url'       => $url,
        ));

        return $this->execute();
    }

    /**
     * Get keywords for an page title
     *
     * @param string $title
     */
    public function getKeywordsForPageTitle( $idSite, $period, $date, $title )
    {
        $this->setQuery( 'getKeywordsForPageTitle' );
        $this->setParameters( array(
            'idSite'    => $idSite,
            'period'    => $period,
            'date'      => $date,
            'title'     => $title,
        ));

        return $this->execute();
    }

    /**
     * Get search engines by keyword
     *
     * @param int $idSubtable
     * @param string $segment
     */
    public function getSearchEnginesFromKeywordId( $idSite, $period, $date, $idSubtable, $segment = '' )
    {
        $this->setQuery( 'getSearchEnginesFromKeywordId' );
        $this->setParameters( array(
            'idSite'        => $idSite,
            'period'        => $period,
            'date'          => $date,
            'idSubtable'    => $idSubtable,
            'segment'       => $segment,
        ));

        return $this->execute();
    }

    /**
     * Get search engines
     *
     * @param string $segment
     * @param string $expanded
     */
    public function getSearchEngines( $idSite, $period, $date, $segment = '', $expanded = '' )
    {
        $this->setQuery( 'getSearchEngines' );
        $this->setParameters( array(
            'idSite'        => $idSite,
            'period'        => $period,
            'date'          => $date,
            'segment'       => $segment,
            'expanded'      => $expanded,
        ));

        return $this->execute();
    }

    /**
     * Get search engines by search engine ID
     *
     * @param int $idSubtable
     * @param string $segment
     */
    public function getKeywordsFromSearchEngineId( $idSite, $period, $date, $idSubtable, $segment = '' )
    {
        $this->setQuery( 'getKeywordsFromSearchEngineId' );
        $this->setParameters( array(
            'idSite'        => $idSite,
            'period'        => $period,
            'date'          => $date,
            'segment'       => $segment,
            'idSubtable'    => $idSubtable,
        ));

        return $this->execute();
    }

    /**
     * Get campaigns
     *
     * @param string $segment
     * @param string $expanded
     */
    public function getCampaigns( $segment = '', $expanded = '' )
    {
        $this->setQuery( 'getCampaigns' );
        $this->setParameters( array(
            'segment'       => $segment,
            'expanded'      => $expanded,
        ));

        return $this->execute();
    }

    /**
     * Get keywords by campaign ID
     *
     * @param int $idSubtable
     * @param string $segment
     */
    public function getKeywordsFromCampaignId( $idSubtable, $segment = '' )
    {
        $this->setQuery( 'getKeywordsFromCampaignId' );
        $this->setParameters( array(
            'segment'       => $segment,
            'idSubtable'    => $idSubtable,
        ));

        return $this->execute();
    }

    /**
     * Get website refererals
     *
     * @param string $segment
     * @param string $expanded
     */
    public function getWebsites( $segment = '', $expanded = '' )
    {
        $this->setQuery( 'getWebsites' );
        $this->setParameters( array(
            'segment'       => $segment,
            'expanded'      => $expanded,
        ));

        return $this->execute();
    }

    /**
     * Get urls by website ID
     *
     * @param int $idSubtable
     * @param string $segment
     */
    public function getUrlsFromWebsiteId( $idSubtable, $segment = '' )
    {
        $this->setQuery( 'getUrlsFromWebsiteId' );
        $this->setParameters( array(
            'segment'       => $segment,
            'idSubtable'    => $idSubtable,
        ));

        return $this->execute();
    }

    /**
     * Get the number of distinct search engines
     *
     * @param string $segment
     */
    public function getNumberOfSearchEngines( $segment = '' )
    {
        $this->setQuery( 'getNumberOfDistinctSearchEngines' );
        $this->setParameters( array(
            'segment'       => $segment,
        ));

        return $this->execute();
    }

    /**
     * Get the number of distinct keywords
     *
     * @param string $segment
     */
    public function getNumberOfKeywords( $segment = '' )
    {
        $this->setQuery( 'getNumberOfDistinctKeywords' );
        $this->setParameters( array(
            'segment'       => $segment,
        ));

        return $this->execute();
    }

    /**
     * Get the number of distinct campaigns
     *
     * @param string $segment
     */
    public function getNumberOfCampaigns( $segment = '' )
    {
        $this->setQuery( 'getNumberOfDistinctCampaigns' );
        $this->setParameters( array(
            'segment'       => $segment,
        ));

        return $this->execute();
    }

    /**
     * Get the number of distinct websites
     *
     * @param string $segment
     */
    public function getNumberOfWebsites( $segment = '' )
    {
        $this->setQuery( 'getNumberOfDistinctWebsites' );
        $this->setParameters( array(
            'segment'       => $segment,
        ));

        return $this->execute();
    }

    /**
     * Get the number of distinct websites urls
     *
     * @param string $segment
     */
    public function getNumberOfWebsitesUrls( $segment = '' )
    {
        $this->setQuery( 'getNumberOfDistinctWebsitesUrls' );
        $this->setParameters( array(
            'segment'       => $segment,
        ));

        return $this->execute();
    }
}