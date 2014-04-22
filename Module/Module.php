<?php

namespace CiscoSystems\PiwikBundle\Module;

use CiscoSystems\PiwikBundle\Connection\Request;

abstract class Module
{
    protected $request;
    protected $name;
    protected $params;

    public function __construct( Request $request, $name )
    {
        $this->request = $request;
        $this->name = $name;
        $this->params = array( 'segment' => '' );
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
        return $this->params;
    }

    public function setParameters( $params )
    {
        $this->params = $params;
    }

    public function addParameter( $name, $value )
    {
        if( in_array( $name, $this->params ) )
        {
            return false;
        }

        $this->params[$name] = $value;
    }

    public function setParameter( $name, $value )
    {
        if( !in_array( $name, $this->params ) )
        {
            return false;
        }

        $this->params[$name] = $value;
    }

    abstract protected function getData( $query, $params = array() );

    public function __toString()
    {
        return $this->name;
    }
}