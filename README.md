
Setup:
======

Add and adapt to your need the following to the ```app/config/config.yml``` file:

``` YML
cisco_systems_piwik:
    url:            http://piwik.demo-site.com
    token:          anonymous
    site_id:        1
    format:         json
```
Usage:
=====

Call the service ```cisco.piwik.client```.

Assign the variable you would normally use if you were to query the API directly
(see [the reporting API] (http://developer.piwik.org/api-reference/reporting-api) ).

``` php
        $client = $this->container->get( 'cisco.piwik.client' );
        $client->setLanguage('en');
```

Then load the desired module:

``` php
        $visitsSummary = $client->getModule( 'VisitsSummary' );
```

Finally call the Method to get the data back:

``` php
        return $visitsSummary->getVisits();
```
