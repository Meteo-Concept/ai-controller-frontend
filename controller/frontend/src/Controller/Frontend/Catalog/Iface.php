<?php

/**
 * @license LGPLv3, http://opensource.org/licenses/LGPL-3.0
 * @copyright Aimeos (aimeos.org), 2015-2020
 * @package Controller
 * @subpackage Frontend
 */


namespace Aimeos\Controller\Frontend\Catalog;


/**
 * Interface for catalog frontend controllers
 *
 * @package Controller
 * @subpackage Frontend
 */
interface Iface
{
	/**
	 * Adds generic condition for filtering attributes
	 *
	 * @param string $operator Comparison operator, e.g. "==", "!=", "<", "<=", ">=", ">", "=~", "~="
	 * @param string $key Search key defined by the catalog manager, e.g. "catalog.status"
	 * @param array|string $value Value or list of values to compare to
	 * @return \Aimeos\Controller\Frontend\Catalog\Iface Catalog controller for fluent interface
	 * @since 2019.04
	 */
	public function compare( string $operator, string $key, $value ) : Iface;

	/**
	 * Returns the category for the given catalog code
	 *
	 * @param string $code Unique catalog code
	 * @return \Aimeos\MShop\Catalog\Item\Iface Catalog item including the referenced domains items
	 * @since 2019.04
	 */
	public function find( string $code ) : \Aimeos\MShop\Catalog\Item\Iface;

	/**
	 * Creates a search function string for the given name and parameters
	 *
	 * @param string $name Name of the search function without parenthesis, e.g. "catalog:has"
	 * @param array $params List of parameters for the search function with numeric keys starting at 0
	 * @return string Search function string that can be used in compare()
	 */
	public function function( string $name, array $params ) : string;

	/**
	 * Returns the category for the given catalog ID
	 *
	 * @param string $id Unique catalog ID
	 * @return \Aimeos\MShop\Catalog\Item\Iface Catalog item including the referenced domains items
	 * @since 2019.04
	 */
	public function get( string $id ) : \Aimeos\MShop\Catalog\Item\Iface;

	/**
	 * Returns the list of categories up to the root node including the node given by its ID
	 *
	 * @param string $id Current category ID
	 * @return \Aimeos\MShop\Catalog\Item\Iface[] Associative list of categories
	 * @since 2017.03
	 */
	public function getPath( string $id );

	/**
	 * Returns the categories filtered by the previously assigned conditions
	 *
	 * @param int $level Constant from \Aimeos\MW\Tree\Manager\Base, e.g. LEVEL_ONE, LEVEL_LIST or LEVEL_TREE
	 * @return \Aimeos\MShop\Catalog\Item\Iface Category tree
	 * @since 2019.04
	 */
	public function getTree( int $level = \Aimeos\MW\Tree\Manager\Base::LEVEL_TREE ) : \Aimeos\MShop\Catalog\Item\Iface;

	/**
	 * Parses the given array and adds the conditions to the list of conditions
	 *
	 * @param array $conditions List of conditions, e.g. ['>' => ['catalog.status' => 0]]
	 * @return \Aimeos\Controller\Frontend\Catalog\Iface Catalog controller for fluent interface
	 * @since 2019.04
	 */
	public function parse( array $conditions ) : Iface;

	/**
	 * Sets the catalog ID of node that is used as root node
	 *
	 * @param string|null $id Catalog ID
	 * @return \Aimeos\Controller\Frontend\Catalog\Iface Catalog controller for fluent interface
	 * @since 2019.04
	 */
	public function root( string $id = null ) : Iface;

	/**
	 * Returns the categories filtered by the previously assigned conditions
	 *
	 * @param int &$total Parameter where the total number of found categories will be stored in
	 * @return \Aimeos\Map Ordered list of items implementing \Aimeos\MShop\Catalog\Item\Iface
	 * @since 2019.10
	 */
	public function search( int &$total = null ) : \Aimeos\Map;

	/**
	 * Sets the referenced domains that will be fetched too when retrieving items
	 *
	 * @param array $domains Domain names of the referenced items that should be fetched too
	 * @return \Aimeos\Controller\Frontend\Catalog\Iface Catalog controller for fluent interface
	 * @since 2019.04
	 */
	public function uses( array $domains ) : Iface;

	/**
	 * Limits categories returned to only visible ones depending on the given category IDs
	 *
	 * @param array $catIds List of category IDs
	 * @return \Aimeos\Controller\Frontend\Catalog\Iface Catalog controller for fluent interface
	 */
	public function visible( array $catIds ) : Iface;
}
