<?php

namespace CiscoSystems\PiwikBundle\Module;

use CiscoSystems\PiwikBundle\Model\Piwik;

abstract class AbstractModule
{
    protected $piwik;
    protected $name;
    protected $parameters;
    protected $query;

    public function __construct( Piwik $piwik, $name )
    {
        $this->piwik = $piwik;
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

    public function getPiwik()
    {
        return $this->piwik;
    }

    public function setRequest( $request )
    {
        $this->piwik = $request;
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
        return $this->piwik->request( $this->query, $this->parameters );
    }

    public function __toString()
    {
        return $this->name;
    }
}