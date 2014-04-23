<?php

namespace CiscoSystems\PiwikBundle\Module;

use CiscoSystems\PiwikBundle\Connection\Request;
use CiscoSystems\PiwikBundle\Module\Module as Base;

/**
 * MODULE: IMAGE GRAPH
 * Generate png graphs
 */
class ImageGraph extends Base
{
    const GRAPH_EVOLUTION       = 'evolution';
    const GRAPH_VERTICAL_BAR    = 'verticalBar';
    const GRAPH_PIE             = 'pie';
    const GRAPH_PIE_3D          = '3dPie';

    public function __construct( Request $request )
    {
        parent::__construct( $request, 'ImageGraph' );
    }

    /**
     * Generate a png report
     *
     * @param string $apiModule Module
     * @param string $apiAction Action
     * @param string
     * 		GRAPH_EVOLUTION
     * 		GRAPH_VERTICAL_BAR
     * 		GRAPH_PIE
     * 		GRAPH_PIE_3D
     * @param int $outputType
     * @param string $columns
     * @param boolean $showMetricTitle
     * @param int $width
     * @param int $height
     * @param int $fontSize
     * @param boolean $aliasedGraph "by default, Graphs are "smooth" (anti-aliased). If you are generating hundreds of graphs and are concerned with performance, you can set aliasedGraph=0. This will disable anti aliasing and graphs will be generated faster, but look less pretty."
     * @param array $colors Use own colors instead of the default. The colors has to be in hexadecimal value without '#'
     */
    public function getImageGraph( $apiModule, $apiAction, $graphType = '', $outputType = '0', $columns = '', $labels = '', $showLegend = '1', $width = '', $height = '', $fontSize = '9', $legendFontSize = '', $aliasedGraph = '1', $idGoal = '', $colors = array() )
    {
        $this->setQuery( 'get' );
        $this->setParameters( array(
            'apiModule'         => $apiModule,
            'apiAction'         => $apiAction,
            'graphType'         => $graphType,
            'outputType'        => $outputType,
            'columns'           => $columns,
            'labels'            => $labels,
            'showLegend'        => $showLegend,
            'width'             => $width,
            'height'            => $height,
            'fontSize'          => $fontSize,
            'legendFontSize'    => $legendFontSize,
            'aliasedGraph'      => $aliasedGraph,
            'idGoal '           => $idGoal,
            'colors'            => $colors,
        ));

        return $this->execute();
    }
}