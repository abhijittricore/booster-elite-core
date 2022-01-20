<?php
/**
 * Booster Core for WooCommerce - Plus - Filters
 *
 *@version 1.0.0
 * @since  1.0.0
 * @author  Pluggabl LLC.
 */

if ( ! defined( 'ABSPATH' ) ) exit;

if ( ! class_exists( 'WCJ_Plus_Filters' ) ) :

class WCJ_Plus_Filters {

	/**
	 * Constructor.
	 *
	 *@version 1.0.0
	 * @since  1.0.0
	 */
	function __construct() {
		add_filter( 'booster_message', array( $this, 'booster_get_message' ), 101 );
		add_filter( 'booster_option',  array( $this, 'booster_get_option' ),  101, 2 );
	}

	/**
	 * booster_get_option.
	 *
	 *@version 1.0.0
	 * @since  1.0.0
	 */
	function booster_get_option( $value1, $value2 ) {
		return $value2;
	}

	/**
	 * booster_get_message.
	 *
	 *@version 1.0.0
	 * @since  1.0.0
	 */
	function booster_get_message() {
		return '';
	}
}

endif;

return new WCJ_Plus_Filters();
