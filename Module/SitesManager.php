<?php

namespace CiscoSystems\PiwikBundle\Module;

use CiscoSystems\PiwikBundle\Connection\Request;
use CiscoSystems\PiwikBundle\Module\AbstractModule as Base;

/**
 * MODULE: SITES MANAGER
 *
 * The SitesManager API gives you full control on Websites in Piwik (create,
 * update and delete), and many methods to retrieve websites based on various
 * attributes. This API lets you create websites via "addSite", update existing
 * websites via "updateSite" and delete websites via "deleteSite". When creating
 * websites, it can be useful to access internal codes used by Piwik for
 * currencies via "getCurrencyList", or timezones via "getTimezonesList". There
 * are also many ways to request a list of websites: from the website ID via
 * "getSiteFromId" or the site URL via "getSitesIdFromSiteUrl". Often, the most
 * useful technique is to list all websites that are known to a current user,
 * based on the token_auth, via "getSitesWithAdminAccess",
 * "getSitesWithViewAccess" or "getSitesWithAtLeastViewAccess" (which returns
 * both). Some methods will affect all websites globally: "setGlobalExcludedIps"
 * will set the list of IPs to be excluded on all websites,
 * "setGlobalExcludedQueryParameters" will set the list of URL parameters to
 * remove from URLs for all websites. The existing values can be fetched via
 * "getExcludedIpsGlobal" and "getExcludedQueryParametersGlobal". See also the
 * documentation about Managing Websites in Piwik.
 */
class SitesManager extends Base
{
    public function __construct( Request $request )
    {
        parent::__construct( $request, 'UsersManager' );
    }

    /**
     * Get the JS tag of the current site
     *
     * @param string $piwikUrl
     */
    public function getJavascriptTag(
            $idSite,
            $piwikUrl = '',
            $mergeSubdomains = '',
            $groupPageTitlesByDomain = '',
            $mergeAliasUrls = '',
            $visitorCustomVariables = '',
            $pageCustomVariables = '',
            $customCampaignNameQueryParam = '',
            $customCampaignKeywordParam = '',
            $doNotTrack = ''
    )
    {
        $this->setQuery( 'getJavascriptTag' );
        $this->setParameters( array(
            'idSite'                        => $idSite,
            'piwikUrl'                      => $piwikUrl,
            'mergeSubdomains'               => $mergeSubdomains,
            'groupPageTitlesByDomain'       => $groupPageTitlesByDomain,
            'mergeAliasUrls'                => $mergeAliasUrls,
            'visitorCustomVariables'        => $visitorCustomVariables,
            'pageCustomVariables'           => $pageCustomVariables,
            'customCampaignNameQueryParam'  => $customCampaignNameQueryParam,
            'customCampaignKeywordParam'    => $customCampaignKeywordParam,
            'doNotTrack'                    => $doNotTrack
        ));

        return $this->execute();
    }

    public function getImageTrackingCode( $idSite, $piwikUrl = '', $actionName = '', $idGoal = '', $revenue = '' )
    {
        $this->setQuery( 'getImageTrackingCode' );
        $this->setParameters( array(
            'idSite'        => $idSite,
            'piwikUrl'      => $piwikUrl,
            'actionName'    => $actionName,
            'idGoal'        => $idGoal,
            'revenue'       => $revenue
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
    public function getSiteInformation( $idSite )
    {
        $this->setQuery( 'getSiteFromId' );
        $this->setParameters( array(
            'idSite' => $idSite,
        ));

        return $this->execute();
    }

    /**
     * Get urls from current site
     */
    public function getSiteUrls( $idSite )
    {
        $this->setQuery( 'getSiteUrlsFromId' );
        $this->setParameters( array(
            'idSite' => $idSite,
        ));

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
    public function addSite(
            $siteName,
            $urls,
            $ecommerce = '',
            $siteSearch = '',
            $searchKeywordParameters = '',
            $searchCategoryParameters = '',
            $excludeIps = '',
            $excludedQueryParameters = '',
            $timezone = '',
            $currency = '',
            $group = '',
            $startDate = '',
            $excludedAgents = '',
            $keepURLFragments = '',
            $type = ''
    )
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
            'excludedAgents'            => $excludedAgents,
            'keepURLFragments'          => $keepURLFragments,
            'type'                      => $type
        ));

        return $this->execute();
    }

    /**
     * Delete current site
     */
    public function deleteSite( $idSite )
    {
        $this->setQuery( 'deleteSite' );
        $this->setParameters( array(
            'idSite' => $idSite,
        ));

        return $this->execute();
    }

    /**
     * Add alias urls to the current site
     *
     * @param array $urls
     */
    public function addSiteAliasUrls( $idSite, $urls )
    {
        $this->setQuery( 'addSiteAliasUrls' );
        $this->setParameters( array(
            'idSite'    => $idSite,
            'urls'      => $urls,
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
    public function setGlobalExcludedIps( $excludedIps )
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
    public function getExcludedQueryParametersGlobal()
    {
        $this->setQuery( 'getExcludedQueryParametersGlobal' );

        return $this->execute();
    }

    public function setGlobalExcludedUserAgents( $excludedUserAgents )
    {
        $this->setQuery( 'setGlobalExcludedUserAgents' );
        $this->setParameters( array(
            'excludedUserAgents'   => $excludedUserAgents,
        ));

        return $this->execute();
    }

    public function isSiteSpecificUserAgentExcludeEnabled()
    {
        $this->setQuery( 'isSiteSpecificUserAgentExcludeEnabled' );

        return $this->execute();
    }

    public function setSiteSpecificUserAgentExcludeEnabled( $enabled )
    {
        $this->setQuery( 'setSiteSpecificUserAgentExcludeEnabled' );
        $this->setParameters( array(
            'enabled'   => $enabled,
        ));

        return $this->execute();
    }

    public function getKeepURLFragmentsGlobal()
    {
        $this->setQuery( 'getKeepURLFragmentsGlobal' );

        return $this->execute();
    }

    public function setKeepURLFragmentsGlobal( $enabled )
    {
        $this->setQuery( 'setKeepURLFragmentsGlobal' );
        $this->setParameters( array(
            'enabled'   => $enabled,
        ));

        return $this->execute();
    }

    /**
     * Set the global excluded query parameters
     *
     * @param array $excludedQueryParameters
     */
    public function setGlobalExcludedQueryParameters( $excludedQueryParameters )
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
    public function getExcludedIpsGlobal()
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
    public function updateSite(
            $idSite,
            $siteName,
            $urls,
            $ecommerce = '',
            $siteSearch = '',
            $searchKeywordParameters = '',
            $searchCategoryParameters = '',
            $excludeIps = '',
            $excludedQueryParameters = '',
            $timezone = '',
            $currency = '',
            $group = '',
            $startDate = '',
            $excludedAgents = '',
            $keepURLFragments = '',
            $type = ''
    )
    {
        $this->setQuery( 'updateSite' );
        $this->setParameters( array(
            'idSite'                    => $idSite,
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
            'excludedAgents'            => $excludedAgents,
            'keepURLFragments'          => $keepURLFragments,
            'type'                      => $type
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

    public function renameGroup( $oldGroupName, $newGroupName )
    {
        $this->setQuery( 'renameGroup' );
        $this->setParameters( array(
            'oldGroupName' => $oldGroupName,
            'newGroupName' => $newGroupName
        ));

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