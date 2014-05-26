<?php

namespace CiscoSystems\PiwikBundle\Model;

use Buzz\Browser;

/**
 * Description of Connection
 *
 * @author tam
 */
class Connection
{
    protected $url;

    public function __construct( $url )
    {
        $this->url = $url;
    }


    public function getHeader()
    {

    }
}