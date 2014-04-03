<?php

namespace CiscoSystems\PiwikBundle\Connection;

/**
 * Piwik Stub Connector.
 */
class StubConnection implements ConnectionInterface
{
    protected $requests = array();
    protected $responses = array();

    /**
     * Return all maded requests.
     *
     * @return array
     */
    public function getRequests()
    {
        return $this->requests;
    }

    /**
     * Add response to queue.
     *
     * @param string $response stub response
     */
    public function addResponse( $response )
    {
        $this->responses[] = $response;
    }

    /**
     * {@inheritdoc}
     */
    public function send( array $params = array() )
    {
        $this->requests[] = $params;

        return array_pop( $this->responses );
    }
}