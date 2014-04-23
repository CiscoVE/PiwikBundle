<?php

namespace CiscoSystems\PiwikBundle\Module;

use CiscoSystems\PiwikBundle\Connection\Request;
use CiscoSystems\PiwikBundle\Module\Module as Base;

/**
 * MODULE: SITES MANAGER
 * Manage sites
 */
class SitesManager extends Base
{
    public function __construct( Request $request )
    {
        parent::__construct( $request, 'UsersManager' );
    }

    public function setQuery( $query )
    {
        $this->query = $this->name . $query;
    }

    /**
     * Get the JS tag of the current site
     *
     * @param string $piwikUrl
     */
    public function getJavascriptTag( $piwikUrl )
    {
        $this->setQuery( 'getJavascriptTag' );
        $this->setParameters( array(
            'piwikUrl' => $piwikUrl,
        ));

        return $this->execute();
    }

    /**
     * Get sites from a group
     *
     * @param string $group
     */
    public function getSitesFromGroup( $group )
    {
        $this->setQuery( 'getSitesFromGroup' );
        $this->setParameters( array(
            'group' => $group,
        ));

        return $this->execute();
    }

    /**
     * Get all site groups
     */
    public function getSitesGroups()
    {
        $this->setQuery( 'getSitesGroups' );

        return $this->execute();
    }

    /**
     * Get information about the current site
     */
    public function getSiteInformation()
    {
        $this->setQuery( 'getSiteFromId' );

        return $this->execute();
    }

    /**
     * Get urls from current site
     */
    public function getSiteUrls()
    {
        $this->setQuery( 'getSiteUrlsFromId' );

        return $this->execute();
    }

    /**
     * Get all sites
     */
    public function getAllSites()
    {
        $this->setQuery( 'getAllSites' );

        return $this->execute();
    }

    /**
     * Get all sites with ID
     */
    public function getAllSitesId()
    {
        $this->setQuery( 'getAllSitesId' );

        return $this->execute();
    }

    /**
     * Get all sites with the visit count since $timestamp
     *
     * @param string $timestamp
     */
    public function getSitesIdWithVisits( $timestamp )
    {
        $this->setQuery( 'getSitesIdWithVisits' );
        $this->setParameters( array(
            'timestamp' => $timestamp,
        ));

        return $this->execute();
    }

    /**
     * Get all sites where the current user has admin access
     */
    public function getSitesWithAdminAccess()
    {
        $this->setQuery( 'getSitesWithAdminAccess' );

        return $this->execute();
    }

    /**
     * Get all sites where the current user has view access
     */
    public function getSitesWithViewAccess()
    {
        $this->setQuery( 'getSitesWithViewAccess' );

        return $this->execute();
    }

    /**
     * Get all sites where the current user has a least view access
     *
     * @param int $limit
     */
    public function getSitesWithAtLeastViewAccess( $limit = '' )
    {
        $this->setQuery( 'getSitesWithAtLeastViewAccess' );
        $this->setParameters( array(
            'limit' => $limit,
        ));

        return $this->execute();
    }

    /**
     * Get all sites with ID where the current user has admin access
     */
    public function getSitesIdWithAdminAccess()
    {
        $this->setQuery( 'getSitesIdWithAdminAccess' );

        return $this->execute();
    }

    /**
     * Get all sites with ID where the current user has view access
     */
    public function getSitesIdWithViewAccess()
    {
        $this->setQuery( 'getSitesIdWithViewAccess' );

        return $this->execute();
    }

    /**
     * Get all sites with ID where the current user has at least view access
     */
    public function getSitesIdWithAtLeastViewAccess()
    {
        $this->setQuery( 'getSitesIdWithAtLeastViewAccess' );

        return $this->execute();
    }

    /**
     * Get a site by it's URL
     *
     * @param string $url
     */
    public function getSitesIdFromSiteUrl( $url )
    {
        $this->setQuery( 'getSitesIdFromSiteUrl' );
        $this->setParameters( array(
            'url' => $url,
        ));

        return $this->execute();
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
    public function addSite( $siteName, $urls, $ecommerce = '', $siteSearch = '', $searchKeywordParameters = '', $searchCategoryParameters = '', $excludeIps = '', $excludedQueryParameters = '', $timezone = '', $currency = '', $group = '', $startDate = '' )
    {
        $this->setQuery( 'addSite' );
        $this->setParameters( array(
            'siteName'                  => $siteName,
            'urls'                      => $urls,
            'ecommerce'                 => $ecommerce,
            'siteSearch'                => $siteSearch,
            'searchKeywordParameters'   => $searchKeywordParameters,
            'searchCategoryParameters'  => $searchCategoryParameters,
            'excludeIps'                => $excludeIps,
            'excludedQueryParameters'   => $excludedQueryParameters,
            'timezone'                  => $timezone,
            'currency'                  => $currency,
            'group'                     => $group,
            'startDate'                 => $startDate,
        ));

        return $this->execute();
    }

    /**
     * Delete current site
     */
    public function deleteSite()
    {
        $this->setQuery( 'deleteSite' );

        return $this->execute();
    }

    /**
     * Add alias urls to the current site
     *
     * @param array $urls
     */
    public function addSiteAliasUrls( $urls )
    {
        $this->setQuery( 'addSiteAliasUrls' );
        $this->setParameters( array(
            'urls' => $urls,
        ));

        return $this->execute();
    }

    /**
     * Get IP's for a specific range
     *
     * @param string $ipRange
     */
    public function getIpsForRange( $ipRange )
    {
        $this->setQuery( 'getIpsForRange' );
        $this->setParameters( array(
            'ipRange' => $ipRange,
        ));

        return $this->execute();
    }

    /**
     * Set the global excluded IP's
     *
     * @param array $excludedIps
     */
    public function setExcludedIps( $excludedIps )
    {
        $this->setQuery( 'setGlobalExcludedIps' );
        $this->setParameters( array(
            'excludedIps' => $excludedIps,
        ));

        return $this->execute();
    }
    /*     * *
     * Set global search parameters
     *
     * @param $searchKeywordParameters
     * @param $searchCategoryParameters
     * @return mixed
     */

    public function setGlobalSearchParameters( $searchKeywordParameters, $searchCategoryParameters )
    {
        $this->setQuery( 'setGlobalSearchParameters' );
        $this->setParameters( array(
            'searchKeywordParameters'   => $searchKeywordParameters,
            'searchCategoryParameters'  => $searchCategoryParameters,
        ));

        return $this->execute();
    }

    /**
     * Get search keywords
     */
    public function getSearchKeywordParametersGlobal()
    {
        $this->setQuery( 'getSearchKeywordParametersGlobal' );

        return $this->execute();
    }

    /**
     * Get search categories
     */
    public function getSearchCategoryParametersGlobal()
    {
        $this->setQuery( 'getSearchCategoryParametersGlobal' );

        return $this->execute();
    }

    /**
     * Get the global excluded query parameters
     */
    public function getExcludedParameters()
    {
        $this->setQuery( 'getExcludedQueryParametersGlobal' );

        return $this->execute();
    }

    /**
     * Set the global excluded query parameters
     *
     * @param array $excludedQueryParameters
     */
    public function setExcludedParameters( $excludedQueryParameters )
    {
        $this->setQuery( 'setGlobalExcludedQueryParameters' );
        $this->setParameters( array(
            'excludedQueryParameters' => $excludedQueryParameters,
        ));

        return $this->execute();
    }

    /**
     * Get the global excluded IP's
     */
    public function getExcludedIps()
    {
        $this->setQuery( 'getExcludedIpsGlobal' );

        return $this->execute();
    }

    /**
     * Get the default currency
     */
    public function getDefaultCurrency()
    {
        $this->setQuery( 'getDefaultCurrency' );

        return $this->execute();
    }

    /**
     * Set the default currency
     *
     * @param string $defaultCurrency
     */
    public function setDefaultCurrency( $defaultCurrency )
    {
        $this->setQuery( 'setDefaultCurrency' );
        $this->setParameters( array(
            'defaultCurrency' => $defaultCurrency,
        ));

        return $this->execute();
    }

    /**
     * Get the default timezone
     */
    public function getDefaultTimezone()
    {
        $this->setQuery( 'getDefaultTimezone' );

        return $this->execute();
    }

    /**
     * Set the default timezone
     *
     * @param string $defaultTimezone
     */
    public function setDefaultTimezone( $defaultTimezone )
    {
        $this->setQuery( 'setDefaultTimezone' );
        $this->setParameters( array(
                    'defaultTimezone' => $defaultTimezone,
        ));

        return $this->execute();
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
    public function updateSite( $siteName, $urls, $ecommerce = '', $siteSearch = '', $searchKeywordParameters = '', $searchCategoryParameters = '', $excludeIps = '', $excludedQueryParameters = '', $timezone = '', $currency = '', $group = '', $startDate = '' )
    {
        $this->setQuery( 'updateSite' );
        $this->setParameters( array(
            'siteName'                  => $siteName,
            'urls'                      => $urls,
            'ecommerce'                 => $ecommerce,
            'siteSearch'                => $siteSearch,
            'searchKeywordParameters'   => $searchKeywordParameters,
            'searchCategoryParameters'  => $searchCategoryParameters,
            'excludeIps'                => $excludeIps,
            'excludedQueryParameters'   => $excludedQueryParameters,
            'timezone'                  => $timezone,
            'currency'                  => $currency,
            'group'                     => $group,
            'startDate'                 => $startDate,
        ));

        return $this->execute();
    }

    /**
     * Get a list with all available currencies
     */
    public function getCurrencyList()
    {
        $this->setQuery( 'getCurrencyList' );

        return $this->execute();
    }

    /**
     * Get a list with all currency symbols
     */
    public function getCurrencySymbols()
    {
        $this->setQuery( 'getCurrencySymbols' );

        return $this->execute();
    }

    /**
     * Get a list with available timezones
     */
    public function getTimezonesList()
    {
        $this->setQuery( 'getTimezonesList' );

        return $this->execute();
    }

    /**
     * Unknown
     */
    public function getUniqueSiteTimezones()
    {
        $this->setQuery( 'getUniqueSiteTimezones' );

        return $this->execute();
    }

    /**
     * Get all sites which matches the pattern
     *
     * @param string $pattern
     */
    public function getPatternMatchSites( $pattern )
    {
        $this->setQuery( 'getPatternMatchSites' );
        $this->setParameters( array(
            'pattern' => $pattern,
        ));

        return $this->execute();
    }
}