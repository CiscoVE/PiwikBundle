<?php

namespace CiscoSystems\PiwikBundle\Module;

class Module
{
    protected $request;
    protected $configuration;
    protected $name;
    protected $module;

    public function __construct( Request $request, $configuration )
    {
        $this->request = $request;
        $this->configuration = $configuration;
    }

    public function getModule( $name )
    {
        if( !array_key_exists( $name, $this->configuration ) )
        {
            $keys = array();
            foreach ( array_keys( $this->configuration ) as $k ) $keys[] = '`' . $k . '`';
            $msg = 'Specified key `' . $name . '` does not exist in piwik configuration: ' . join( ', ', $keys );
            throw new \InvalidArgumentException( $msg );
        }
        $this->name = $name;
        $this->module = $this->configuration[$name];
    }

    public function getFunction( $name )
    {
        if( !array_key_exists( $name, $this->module ) )
        {
            $keys = array();
            foreach ( array_keys( $this->module ) as $k ) $keys[] = '`' . $k . '`';
            $msg = 'Specified key `' . $name . '` does not exist in module ' . $this->module . ' configuration: ' . join( ', ', $keys );
            throw new \InvalidArgumentException( $msg );
        }
        $arguments = $this->module[$name];

        $this->__call( $name, $arguments );
    }

    public function __call( $name, $arguments )
    {
        $args = $arguments['arguments'];
        if( count( $args ) > 0 )
        {
            $parameters = array();
            foreach( $args as $arg => $argValue )
            {
                if( isset( $argValue['type'] ) && isset( $argValue['value'] ) )
                {
                    switch( $argValue['type'] )
                    {
                        case 'string':
                            $value = isset( $argValue['value'] ) ? $argValue['value'] : null ;
                            break;
                        case 'array':
                            $value = isset( $argValue['value'] ) ? $argValue['value'] : array();
                            break;
                    }
                }
                $parameters[] = array( $arg => $value );
            }
        }

        return $this->request( $this->name . $name, $parameters );
    }
}