<?php

namespace CiscoSystems\PiwikBundle\Module;

use CiscoSystems\PiwikBundle\Connection\Request;
use CiscoSystems\PiwikBundle\Module\AbstractModule as Base;

/**
 * MODULE: ExampleAPI
 *
 * The ExampleAPI is useful to developers building a custom Piwik plugin.
 * Please see the source code in in the file plugins/ExampleAPI/API.php
 * for more documentation.
 */
class ExampleAPI extends Base
{
    public function __construct( Request $request )
    {
        parent::__construct( $request, 'ExampleAPI' );
    }

    /**
     * Get the piwik version
     */
	public function getPiwikVersion()
    {
        $this->setQuery( 'getPiwikVersion' );

        return $this->execute();
    }

    /**
     * @see http://en.wikipedia.org/wiki/Phrases_from_The_Hitchhiker%27s_Guide_to_the_Galaxy#The_number_42
     */
	public function getAnswerToLife()
    {
        $this->setQuery( 'getAnswerToLife' );

        return $this->execute();
    }

	public function getObject()
    {
        $this->setQuery( 'getObject' );

        return $this->execute();
    }

    /**
     * Get the sum of the parameters
     *
     * @param int $a
     * @param int $b
     */
	public function getSum( $a = '0', $b = '0' )
    {
        $this->setQuery( 'getSum' );
        $this->setParameters( array(
            'a' => $a,
            'b' => $b,
        ));

        return $this->execute();
    }

    /**
     * Returns nothing but the success of the request
     */
	public function getNull()
    {
        $this->setQuery( 'getNull' );

        return $this->execute();
    }

    /**
     * Get a short piwik description
     */
	public function getDescriptionArray()
    {
        $this->setQuery( 'getDescriptionArray' );

        return $this->execute();
    }
    /**
     * Get a short comparison with other analytic software
     */
	public function getCompetitionDatatable()
    {
        $this->setQuery( 'getCompetitionDatatable' );

        return $this->execute();
    }

    /**
     * Get information about 42
     * http://en.wikipedia.org/wiki/Phrases_from_The_Hitchhiker%27s_Guide_to_the_Galaxy#The_number_42
     */
	public function getMoreInformationAnswerToLife()
    {
        $this->setQuery( 'getMoreInformationAnswerToLife' );

        return $this->execute();
    }

    /**
     * Get a multidimensional array
     */
	public function getMultiArray()
    {
        $this->setQuery( 'getMultiArray' );

        return $this->execute();
    }
}