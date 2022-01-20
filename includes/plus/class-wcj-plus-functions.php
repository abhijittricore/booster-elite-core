<?php
/**
 * Booster Core for WooCommerce - Plus - Functions
 *
 *@version 1.0.0
 * @since  1.0.0
 * @author  Pluggabl LLC.
 */

if ( ! defined( 'ABSPATH' ) ) exit;

if ( ! function_exists( 'wcj_plus_get_update_server' ) ) {
	/**
	 * wcj_plus_get_update_server.
	 *
	 *@version 1.0.0
	 * @since  1.0.0
	 */
	function wcj_plus_get_update_server() {
		return 'booster.io';
	}
}

if ( ! function_exists( 'wcj_plus_get_site_url' ) ) {
	/**
	 * wcj_plus_get_site_url.
	 *
	 *@version 1.0.0
	 * @since  1.0.0
	 */
	function wcj_plus_get_site_url() {
		return str_replace( array( 'http://', 'https://' ), '', site_url() );
	}
}
