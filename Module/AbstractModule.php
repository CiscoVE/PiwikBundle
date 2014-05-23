<?php

namespace CiscoSystems\PiwikBundle\Module;

use CiscoSystems\PiwikBundle\Model\Client;

abstract class AbstractModule
{
    protected $client;
    protected $name;
    protected $parameters;
    protected $query;

    public function __construct( Client $client )
    {
        $this->client = $client;
        $this->name = join( '', array_slice( explode( '\\', get_class( $this )), -1 ));
        $this->parameters = array();
    }

    public function getName()
    {
        return $this->name;
    }

    public function getClient()
    {
        return $this->client;
    }

    public function setClient( $client )
    {
        $this->client = $client;
    }

    public function getParameters()
    {
        return $this->parameters;
    }

    public function setParameters( $parameters = array() )
    {
        $this->parameters = $parameters;
    }

    public function addParameter( $name, $value )
    {
        if( in_array( $name, $this->parameters ) )
        {
            return false;
        }

        $this->parameters[$name] = $value;
    }

    public function setParameter( $name, $value )
    {
        if( !in_array( $name, $this->parameters ) )
        {
            return false;
        }

        $this->parameters[$name] = $value;
    }

    public function setQuery( $query )
    {
        $this->query = $this->name . '.' . $query;
    }

    public function getQuery()
    {
        return $this->query;
    }

    public function execute()
    {
        return $this->client->request( $this->query, $this->parameters );
    }

    public function __toString()
    {
        return $this->name;
    }
}