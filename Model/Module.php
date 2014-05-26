<?php

namespace CiscoSystems\PiwikBundle\Model;

use CiscoSystems\PiwikBundle\Model\Connection;

/**
 * @see http://developer.piwik.org/api-reference/reporting-api
 *
 * This is a lightweight module system. Given the chance to choose between
 * a hard coded and this design, the hard coded version might seems to be a better
 * choice for the end user, but it has the major disadvantage to be at the merci
 * of API changes. Meaning that with every API change the related module entity
 * would need to be changed to reflect the API changes. The downside of this decision
 * is that end user need to check the module they want to load and which method
 * they want to query.
 */
class Module
{
    protected $connection;
    protected $name;

    public function __construct( Connection $connection, $name = '' )
    {
        $this->connection = $connection;
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
        return $this->connection->request( $this->name . '.' . $method, $arguments );
    }

    public function __toString()
    {
        return $this->name;
    }
}