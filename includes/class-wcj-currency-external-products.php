<?php
/**
 * Booster Core for WooCommerce - Module - Currency for External Products
 *
 * @version 1.0.0
 * @author  Pluggabl LLC.
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! class_exists( 'WCJ_Currency_External_Products' ) ) :

class WCJ_Currency_External_Products extends WCJ_Module {

	/**
	 * Constructor.
	 *
	 * @version 1.0.0
	 */
	function __construct() {

		$this->id         = 'currency_external_products';
		$this->short_desc = __( 'Currency for External Products', 'woocommerce-jetpack' );
		$this->desc       = __( 'Set different currency for external products.', 'woocommerce-jetpack' );
		$this->link_slug  = 'woocommerce-currency-for-external-products';
		parent::__construct();

		if ( $this->is_enabled() ) {
			if ( '' != wcj_get_option( 'wcj_currency_external_products_symbol', 'EUR' ) ) {
				add_filter( 'woocommerce_currency', array( $this, 'change_currency_code' ), PHP_INT_MAX, 1 );
			}
		}
	}

	/**
	 * change_currency_code.
	 *
	 * @version 1.0.0
	 * @since  1.0.0
	 */
	function change_currency_code( $currency ) {
		global $product;
		if ( is_object( $product ) && $product->is_type( 'external' ) ) {
			return wcj_get_option( 'wcj_currency_external_products_symbol', 'EUR' );
		}
		return $currency;
	}

}

endif;

return new WCJ_Currency_External_Products();
