<?php

namespace CiscoSystems\PiwikBundle\Module;

use CiscoSystems\PiwikBundle\Connection\Request;
use CiscoSystems\PiwikBundle\Module\Module as Base;

/**
 * MODULE : CustomAlerts
 */
class CustomAlerts extends Base
{
    public function __construct( Request $request )
    {
        parent::__construct( $request, 'CustomAlerts' );
    }

    public function getAlert( $idAlert )
    {
        $this->setQuery( 'getAlert' );
        $this->setParameter( 'idAlert', $idAlert );

        return $this->execute();
    }

    public function getValuesForAlertInPast( $idAlert, $subPeriodN )
    {
        $this->setQuery( 'getValuesForAlertInPast' );
        $this->setParameters( array(
            'idAlert'       => $idAlert,
            'subPeriodN'    => $subPeriodN,
        ));

        return $this->execute();
    }

    public function getAlerts( $idSites, $ifSuperUserReturnAllAlerts = '' )
    {
        $this->setQuery( 'getAlerts' );
        $this->setParameters( array(
            'idSites'                       => $idSites,
            'ifSuperUserReturnAllAlerts'    => $ifSuperUserReturnAllAlerts,
        ));

        return $this->execute();
    }

    public function addAlert(
            $name,
            $idSites,
            $period,
            $emailMe,
            $additionalEmails,
            $phoneNumbers,
            $metric,
            $metricCondition,
            $metricValue,
            $comparedTo,
            $reportUniqueId,
            $reportCondition = '',
            $reportValue = ''
    )
    {
        $this->setQuery( 'addAlert' );
        $this->setParameters( array(
            'name'              => $name,
            'idSites'           => $idSites,
            'period'            => $period,
            'emailMe'           => $emailMe,
            'additionalEmails'  => $additionalEmails,
            'phoneNumbers'      => $phoneNumbers,
            'metric'            => $metric,
            'metricCondition'   => $metricCondition,
            'metricValue'       => $metricValue,
            'comparedTo'        => $comparedTo,
            'reportUniqueId'    => $reportUniqueId,
            'reportCondition'   => $reportCondition,
            'reportValue'       => $reportValue,
        ));

        return $this->execute();
    }

    public function editAlert(
            $idAlert,
            $name,
            $idSites,
            $period,
            $emailMe,
            $additionalEmails,
            $phoneNumbers,
            $metric,
            $metricCondition,
            $metricValue,
            $comparedTo,
            $reportUniqueId,
            $reportCondition = '',
            $reportValue = ''
            )
    {
        $this->setQuery( 'editAlert' );
        $this->setParameters( array(
            'idAlert'           => $idAlert,
            'name'              => $name,
            'idSites'           => $idSites,
            'period'            => $period,
            'emailMe'           => $emailMe,
            'additionalEmails'  => $additionalEmails,
            'phoneNumbers'      => $phoneNumbers,
            'metric'            => $metric,
            'metricCondition'   => $metricCondition,
            'metricValue'       => $metricValue,
            'comparedTo'        => $comparedTo,
            'reportUniqueId'    => $reportUniqueId,
            'reportCondition'   => $reportCondition,
            'reportValue'       => $reportValue,
        ));

        return $this->execute();

    }

    public function deleteAlert( $idAlert )
    {
        $this->setQuery( 'deleteAlert' );
        $this->setParameters( array(
            'idAlert'   => $idAlert,
        ));

        return $this->execute();
    }

    public function getTriggeredAlerts( $idSites )
    {
        $this->setQuery( 'getTriggeredAlerts' );
        $this->setParameters( array(
            'idsites'   => $idSites,
        ));

        return $this->execute();
    }
}