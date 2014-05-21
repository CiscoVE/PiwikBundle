<?php

namespace CiscoSystems\PiwikBundle\Module;

use CiscoSystems\PiwikBundle\Connection\Request;

abstract class AbstractModule
{
    protected $request;
    protected $name;
    protected $parameters;
    protected $query;

    public function __construct( Request $request, $name )
    {
        $this->request = $request;
        $this->name = $name;
        $this->parameters = array();
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName( $name )
    {
        $this->name = $name;
    }

    public function getRequest()
    {
        return $this->request;
    }

    public function setRequest( $request )
    {
        $this->request = $request;
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
        $this->query = $this->name . $query;
    }

    public function getQuery()
    {
        return $this->query;
    }

    public function execute()
    {
        return $this->request( $this->query, $this->parameters );
    }

    public function __toString()
    {
        return $this->name;
    }
}