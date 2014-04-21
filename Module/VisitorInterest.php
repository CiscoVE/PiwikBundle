<?php

namespace CiscoSystems\PiwikBundle\Module;

/**
 * Description of VisitorInterest
 *
 * @author tam
 */
class VisitorInterest
{
    protected $segment;
    protected $numberOfVisitsPerVisitDuration;
    protected $numberOfVisitPerPage;
    protected $numberOfVistsByDaySinceLast;
    protected $numberOfVistsByVisitCount;
    protected $request;

    public function __construct( Request $request, $segment )
    {
        $this->request = $request;
        $this->segment = $segment;
    }

    public function getNumberOfVisitsPerDuration( $segment = '' )
    {
        return $this->request( 'VisitorInterest.getNumberOfVisitsPerVisitDuration', array(
                    'segment' => $segment,
        ));
    }

    /**
     * Get the number of visits per visited page
     *
     * @param string $segment
     */
    public function getNumberOfVisitsPerPage( $segment = '' )
    {
        return $this->request( 'VisitorInterest.getNumberOfVisitsPerPage', array(
                    'segment' => $segment,
        ));
    }

    /**
     * Get the number of days elapsed since the last visit
     *
     * @param string $segment
     */
    public function getNumberOfVisitsByDaySinceLast( $segment = '' )
    {
        return $this->request( 'VisitorInterest.getNumberOfVisitsByDaysSinceLast', array(
                    'segment' => $segment,
        ));
    }

    /**
     * Get the number of visits by visit count
     *
     * @param string $segment
     */
    public function getNumberOfVisitsByCount( $segment = '' )
    {
        return $this->request( 'VisitorInterest.getNumberOfVisitsByVisitCount', array(
                    'segment' => $segment,
        ));
    }
}