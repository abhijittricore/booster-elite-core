/**
 * wcj-cart-customization.
 *
 * @version 1.0.0
 * @since  1.0.0
 * @todo    (maybe) fix when cart is emptied (i.e. after products removed)
 */

jQuery(document).ready( function() {
	jQuery( "p.return-to-shop a.button.wc-backward" ).each( function() {
		jQuery(this).text( wcj_cart_customization.return_to_shop_button_text );
	} );
} );
