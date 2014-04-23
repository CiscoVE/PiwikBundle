<?php

namespace CiscoSystems\PiwikBundle\Module;

use CiscoSystems\PiwikBundle\Connection\Request;
use CiscoSystems\PiwikBundle\Module\AbstractModule as Base;

/**
 * MODULE: IMAGE GRAPH
 *
 * @see http://developer.piwik.org/api-reference/metadata#toc-static-image-graphs
 *
 * The ImageGraph.get API call lets you generate beautiful static PNG Graphs for
 * any existing Piwik report. Supported graph types are: line plot, 2D/3D pie
 * chart and vertical bar chart. A few notes about some of the parameters available:
 *  - $graphType defines the type of graph plotted, accepted values are:
 *      'evolution', 'verticalBar', 'pie' and '3dPie'
 *  - $colors accepts a comma delimited list of colors that will overwrite
 *      the default Piwik colors
 *  - you can also customize the width, height, font size, metric being plotted
 *      (in case the data contains multiple columns/metrics). See also How to
 *      embed static Image Graphs? for more information.
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
    public function getImageGraph(
        $idSite,
        $period,
        $date,
        $apiModule,
        $apiAction,
        $graphType = '',
        $outputType = '0',
        $columns = '',
        $labels = '',
        $showLegend = '1',
        $width = '',
        $height = '',
        $fontSize = '9',
        $legendFontSize = '',
        $aliasedGraph = '1',
        $idGoal = '',
        $colors = array(),
        $textColor = '222222',
        $backgroundColor = 'FFFFFF',
        $gridColor = 'CCCCCC',
        $idSubtable = '',
        $legendAppendMetric = '1',
        $segment = ''
    )
    {
        $this->setQuery( 'get' );
        $this->setParameters( array(
            'idSite'                => $idSite,
            'period'                => $period,
            'date'                  => $date,
            'apiModule'             => $apiModule,
            'apiAction'             => $apiAction,
            'graphType'             => $graphType,
            'outputType'            => $outputType,
            'columns'               => $columns,
            'labels'                => $labels,
            'showLegend'            => $showLegend,
            'width'                 => $width,
            'height'                => $height,
            'fontSize'              => $fontSize,
            'legendFontSize'        => $legendFontSize,
            'aliasedGraph'          => $aliasedGraph,
            'idGoal '               => $idGoal,
            'colors'                => $colors,
            'textColor'             => $textColor,
            'backgroundColor'       => $backgroundColor,
            'gridColor'             => $gridColor,
            'idSubtable'            => $idSubtable,
            'legendAppendMetric'    => $legendAppendMetric,
            'segment'               => $segment,
        ));

        return $this->execute();
    }
}