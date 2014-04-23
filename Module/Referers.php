<?php

namespace CiscoSystems\PiwikBundle\Module;

use CiscoSystems\PiwikBundle\Connection\Request;
use CiscoSystems\PiwikBundle\Module\AbstractModule as Base;

/**
 * MODULE: REFERERS
 * Get information about the referers
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
    public function getRefererType( $segment = '', $typeReferer = '' )
    {
        $this->setQuery( 'getRefererType' );
        $this->setParameters( array(
            'segment'       => $segment,
            'typeReferer'   => $typeReferer,
        ));

        return $this->execute();
    }

    /**
     * Get referer keywords
     *
     * @param string $segment
     * @param string $expanded
     */
    public function getKeywords( $segment = '', $expanded = '' )
    {
        $this->setQuery( 'getKeywords' );
        $this->setParameters( array(
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
    public function getKeywordsForPageUrl( $url )
    {
        $this->setQuery( 'getKeywordsForPageUrl' );
        $this->setParameters( array(
            'url' => $url,
        ));

        return $this->execute();
    }

    /**
     * Get keywords for an page title
     *
     * @param string $title
     */
    public function getKeywordsForPageTitle( $title )
    {
        $this->setQuery( 'getKeywordsForPageTitle' );
        $this->setParameters( array(
            'title' => $title,
        ));

        return $this->execute();
    }

    /**
     * Get search engines by keyword
     *
     * @param int $idSubtable
     * @param string $segment
     */
    public function getSearchEnginesFromKeywordId( $idSubtable, $segment = '' )
    {
        $this->setQuery( 'getSearchEnginesFromKeywordId' );
        $this->setParameters( array(
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
    public function getSearchEngines( $segment = '', $expanded = '' )
    {
        $this->setQuery( 'getSearchEngines' );
        $this->setParameters( array(
            'segment'   => $segment,
            'expanded'  => $expanded,
        ));

        return $this->execute();
    }

    /**
     * Get search engines by search engine ID
     *
     * @param int $idSubtable
     * @param string $segment
     */
    public function getKeywordsFromSearchEngineId( $idSubtable, $segment = '' )
    {
        $this->setQuery( 'getKeywordsFromSearchEngineId' );
        $this->setParameters( array(
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