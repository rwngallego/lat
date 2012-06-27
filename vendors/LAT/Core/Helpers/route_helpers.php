<?php
/**
 * LAT Framework
 *
 * This file is part of the LAT framework.
 *
 * (c) Rowinson Gallego Medina <rwn.gallego@gmail.com>
 *
 * This source file is subject to the New BSD license that is bundled
 * with this source code in the file LICENSE.txt
 *
 * @category LAT
 * @package Core
 * @subpackage Helpers
 * @license New BSD License
 * @author Rowinson Gallego Medina <rwn.gallego@gmail.com>
 */

/**
 * TODO: Implement these methods in each resource class as static methods
 * and make calls from here, instead of declaring them here
 */

/**
 * get the url of the given router_id
 *
 * @param string $route_id        	
 * @throws \Exception
 * @return string
 */
function get_url($route_id) {
	// TODO: Define the specific routes on top (index.php)
	$xml = new SimpleXMLElement ( "app/config/routes.xml", null, true );
	$results = $xml->xpath ( "//entry[@id='$route_id']" );
	$total = count ( $results );
	if (count ( $results ) > 1)
		throw new \Exception ( "The route_id $route_id has multiple registers. It is not unique." );
	else if (count ( $results ) != 1)
		throw new \Exception ( "The route_id $route_id was not found." );
		// FIXME: Is this trim ok?
	$uri = trim ( $results [0]->uri, "/" );
	$base = get_base_url ();
	return $base . '/' . $uri;
}

/**
 * echo the uri of the asset
 *
 * @param string $asset        	
 */
function asset($asset) {
	$base = get_base_url ();
	echo $base . '/web/' . $asset;
}

/**
 * get the base url
 *
 * @return string
 */
function get_base_url() {
	$base = preg_replace ( "/(\/\w+.php)/", "", $_SERVER ['SCRIPT_NAME'] );
	return $base;
}
/**
 * get the value of the parameter
 */
function lat_parameter($parameter) {
	$params = parse_ini_file ( "app/config/parameters.ini", false );
	if (isset ( $params [$parameter] ))
		return $params [$parameter];
	else
		throw new \Exception ( "The parameter $parameter was not found" );
}
