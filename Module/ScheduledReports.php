<?php

namespace CiscoSystems\PiwikBundle\Module;

use CiscoSystems\PiwikBundle\Connection\Request;
use CiscoSystems\PiwikBundle\Module\AbstractModule as Base;

/**
 * MODULE: ScheduledReports
 *
 * The ScheduledReports API lets you manage Scheduled Email reports, as well as
 * generate, download or email any existing report. "generateReport" will
 * generate the requested report (for a specific date range, website and in the
 * requested language). "sendEmailReport" will send the report by email to the
 * recipients specified for this report. You can also get the list of all
 * existing reports via "getReports", create new reports via "addReport", or
 * manage existing reports with "updateReport" and "deleteReport". See also the
 * documentation about Scheduled Email reports in Piwik.
 */
class ScheduledReports extends Base
{
    public function __construct( Request $request )
    {
        parent::__construct( $request, 'ScheduledReports' );
    }

    public function addReport(
            $idSite,
            $description,
            $period,
            $hour,
            $reportType,
            $reportFormat,
            $reports,
            $parameters,
            $idSegment = ''
    )
    {
        $this->setQuery( 'addReport' );
        $this->setParameters( array(
            'idSite'        => $idSite,
            'description'   => $description,
            'period'        => $period,
            'hour'          => $hour,
            'reportType'    => $reportType,
            'reportFormat'  => $reportFormat,
            'reports'       => $reports,
            'parameters'    => $parameters,
            'idSegment'     => $idSegment
        ));

        return $this->execute();
    }

    public function updateReport(
            $idReport,
            $idSite,
            $description,
            $period,
            $hour,
            $reportType,
            $reportFormat,
            $reports,
            $parameters,
            $idSegment = ''
    )
    {
        $this->setQuery( 'updateReport' );
        $this->setParameters( array(
            'idreport'      => $idReport,
            'idSite'        => $idSite,
            'description'   => $description,
            'period'        => $period,
            'hour'          => $hour,
            'reportType'    => $reportType,
            'reportFormat'  => $reportFormat,
            'reports'        > $reports,
            'parameters'    => $parameters,
            'idSegment'     => $idSegment
        ));

        return $this->execute();
    }

    public function deleteReport( $idReport )
    {
        $this->setQuery( 'deleteReport' );
        $this->setParameters( array(
            'idreport'      => $idReport
        ));

        return $this->execute();
    }

    public function getReports(
            $idSite = '',
            $period = '',
            $idReport = '',
            $ifSuperUserReturnOnlySuperUserReports = '',
            $idSegment = ''
    )
    {
        $this->setQuery( 'getReports' );
        $this->setParameters( array(
            'idSite'        => $idSite,
            'period'        => $period,
            'idreport'      => $idReport,
            'ifSuperUserReturnOnlySuperUserReports' => $ifSuperUserReturnOnlySuperUserReports,
            'idSegment'     => $idSegment
        ));

        return $this->execute();
    }

    public function generateReport(
            $idReport,
            $date,
            $language = '',
            $outputType = '',
            $period = '',
            $reportFormat = '',
            $parameters = ''
    )
    {
        $this->setQuery( 'generateReport' );
        $this->setParameters( array(
            'idreport'      => $idReport,
            'date'          => $date,
            'language'      => $language,
            'outputType'    => $outputType,
            'period'        => $period,
            'reportFormat'  => $reportFormat,
            'parameters'    => $parameters,
        ));

        return $this->execute();
    }

    public function sendReport( $idReport, $period = '', $date = '' )
    {
        $this->setQuery( 'sendReport' );
        $this->setParameters( array(
            'idreport'      => $idReport,
            'period'        => $period,
            'date'          => $date,
        ));

        return $this->execute();
    }
}