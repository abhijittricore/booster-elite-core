<?php
/**
 * Booster Core for WooCommerce - Settings Meta Box - General
 *
 * @version 1.0.0
 * @since  1.0.0
 * @author  Pluggabl LLC.
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

return array(
	array(
		'title'    => __( 'PayPal Email', 'woocommerce-jetpack' ),
		'name'     => 'wcj_paypal_per_product_email',
		'default'  => '',
		'type'     => 'text',
	),
);
