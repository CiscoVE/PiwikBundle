<?php

namespace CiscoSystems\PiwikBundle\Model;

use CiscoSystems\PiwikBundle\Model\Client;

class Module
{
    protected $client;
    protected $name;
    protected $query;

    public function __construct( Client $client, $name = '' )
    {
        $this->client = $client;
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName( $name )
    {
        $this->name = $name;

        return $this;
    }

    public function __call( $method, $arguments )
    {
        return $this->client->request( $this->name . '.' . $method, $arguments );
    }

    public function __toString()
    {
        return $this->name;
    }
}