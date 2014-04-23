<?php

namespace CiscoSystems\PiwikBundle\Module;

use CiscoSystems\PiwikBundle\Connection\Request;
use CiscoSystems\PiwikBundle\Module\AbstractModule as Base;

/**
 * MODULE: GOALS
 * Goals API lets you Manage existing goals, via "updateGoal" and "deleteGoal",
 * create new Goals via "addGoal", or list existing Goals for one or several
 * websites via "getGoals" If you are tracking Ecommerce orders and products on
 * your site, the functions "getItemsSku", "getItemsName" and "getItemsCategory"
 * will return the list of products purchased on your site, either grouped by
 * Product SKU, Product Name or Product Category. For each name, SKU or category,
 * the following metrics are returned: Total revenue, Total quantity, average
 * price, average quantity, number of orders (or abandoned carts) containing
 * this product, number of visits on the Product page, Conversion rate. By d
 * efault, these functions return the 'Products purchased'. These functions also
 * accept an optional parameter &abandonedCarts=1. If the parameter is set, it
 * will instead return the metrics for products that were left in an abandoned
 * cart therefore not purchased. The API also lets you request overall Goal
 * metrics via the method "get": Conversions, Visits with at least one conversion,
 * Conversion rate and Revenue. If you wish to request specific metrics about
 * Ecommerce goals, you can set the parameter &idGoal=ecommerceAbandonedCart to
 * get metrics about abandoned carts (including Lost revenue, and number of
 * items left in the cart) or &idGoal=ecommerceOrder to get metrics about
 * Ecommerce orders (number of orders, visits with an order, subtotal, tax,
 * shipping, discount, revenue, items ordered) See also the documentation about
 * Tracking Goals in Piwik.
 */
class Goals extends Base
{
    public function __construct( Request $request )
    {
        parent::__construct( $request, 'Goals' );
    }

    /**
     * Get all goals
     */
	public function getGoals( $idSite )
    {
        $this->setQuery( 'getGoals' );
        $this->setParameter( 'idSite', $idSite );

        return $this->execute();
    }

    /**
     * Add a goal
     *
     * @param string $name
     * @param string $matchAttribute
     * @param string $pattern
     * @param string $patternType
     * @param boolean $caseSensitive
     * @param float $revenue
     * @param boolean $allowMultipleConversionsPerVisit
     */
	public function addGoal(
        $idSite,
        $name,
        $matchAttribute,
        $pattern,
        $patternType,
        $caseSensitive = '',
        $revenue = '',
        $allowMultipleConversionsPerVisit = ''
    )
    {
        $this->setQuery( 'addGoal' );
        $this->setParameters( array(
            'idSite'                            => $idSite,
            'name'                              => $name,
            'matchAttribute'                    => $matchAttribute,
            'pattern'                           => $pattern,
            'patternType'                       => $patternType,
            'caseSensitive'                     => $caseSensitive,
            'revenue'                           => $revenue,
            'allowMultipleConversionsPerVisit'  => $allowMultipleConversionsPerVisit,
        ));

        return $this->execute();
    }

    /**
     * Update a goal
     *
     * @param int $idGoal
     * @param string $name
     * @param string $matchAttribute
     * @param string $pattern
     * @param string $patternType
     * @param boolean $caseSensitive
     * @param float $revenue
     * @param boolean $allowMultipleConversionsPerVisit
     */
	public function updateGoal(
        $idSite,
        $idGoal,
        $name,
        $matchAttribute,
        $pattern,
        $patternType,
        $caseSensitive = '',
        $revenue = '',
        $allowMultipleConversionsPerVisit = ''
    )
    {
        $this->setQuery( 'updateGoal' );
        $this->setParameters( array(
            'idSite'                            => $idSite,
            'idGoal'                            => $idGoal,
            'name'                              => $name,
            'matchAttribute'                    => $matchAttribute,
            'pattern'                           => $pattern,
            'patternType'                       => $patternType,
            'caseSensitive'                     => $caseSensitive,
            'revenue'                           => $revenue,
            'allowMultipleConversionsPerVisit'  => $allowMultipleConversionsPerVisit,
        ));

        return $this->execute();
    }

    /**
     * Delete a goal
     *
     * @param int $idGoal
     */
	public function deleteGoal( $idSite, $idGoal )
    {
        $this->setQuery( 'deleteGoal' );
        $this->setParameters( array(
            'idSite'    => $idSite,
            'idGoal'    => $idGoal,
        ));

        return $this->execute();
    }

    /**
     * Get the SKU of the items
     *
     * @param boolean abandonedCarts
     */
	public function getItemsSku( $idSite, $period, $date, $abandonedCarts = '', $segment = '' )
    {
        $this->setQuery( 'getItemsSku' );
        $this->setParameters( array(
            'idSite'            => $idSite,
            'period'            => $period,
            'date'              => $date,
            'abandonedCarts'    => $abandonedCarts,
            'segment'           => $segment,
        ));

        return $this->execute();
    }

    /**
     * Get the name of the items
     *
     * @param boolean abandonedCarts
     */
	public function getItemsName( $idSite, $period, $date, $abandonedCarts = '', $segment = '' )
    {
        $this->setQuery( 'getItemsName' );
        $this->setParameters( array(
            'idSite'            => $idSite,
            'period'            => $period,
            'date'              => $date,
            'abandonedCarts'    => $abandonedCarts,
            'segment'           => $segment,
        ));

        return $this->execute();
    }

    /**
     * Get the categories of the items
     *
     * @param boolean abandonedCarts
     */
	public function getItemsCategory( $idSite, $period, $date, $abandonedCarts = '', $segment = '' )
    {
        $this->setQuery( 'getItemsCategory' );
        $this->setParameters( array(
            'idSite'            => $idSite,
            'period'            => $period,
            'date'              => $date,
            'abandonedCarts'    => $abandonedCarts,
            'segment'           => $segment,
        ));

        return $this->execute();
    }

    /**
     * Get conversion rates from a goal
     *
     * @param string $segment
     * @param int $idGoal
     * @param array $columns
     */
	public function get( $idSite, $period, $date, $segment = '', $idGoal = '', $columns = array() )
    {
        $this->setQuery( 'get' );
        $this->setParameters( array(
            'idSite'        => $idSite,
            'period'        => $period,
            'date'          => $date,
            'segment'       => $segment,
            'idGoal'        => $idGoal,
            'columns'       => $columns,
        ));
        $this->setParameter( 'idSite', $idSite );

        return $this->execute();
    }

    /**
     * Get information about a time period and it's conversion rates
     *
     * @param string $segment
     * @param int $idGoal
     */
	public function getDaysToConversion($idSite, $period, $date, $segment = '', $idGoal = '')
    {
        $this->setQuery( 'getDaysToConversion' );
        $this->setParameters( array(
            'idSite'        => $idSite,
            'period'        => $period,
            'date'          => $date,
            'segment'       => $segment,
            'idGoal'        => $idGoal,
        ));

        return $this->execute();
    }

    /**
     * Get information about how many site visits create a conversion
     *
     * @param string $segment
     * @param int $idGoal
     */
	public function getVisitsUntilConversion($idSite, $period, $date, $segment = '', $idGoal = '')
    {
        $this->setQuery( 'getGoals' );
        $this->setParameters( array(
            'idSite'        => $idSite,
            'period'        => $period,
            'date'          => $date,
            'segment'       => $segment,
            'idGoal'        => $idGoal,
        ));

        return $this->execute();
    }
}
