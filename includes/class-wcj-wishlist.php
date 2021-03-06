<?php
/**
 * Booster Core for WooCommerce - Module - Wishlist
 *
 * @version 1.0.0
 * @author  Pluggabl LLC.
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! class_exists( 'WCJ_Wishlist' ) ) :

class WCJ_Wishlist extends WCJ_Module {

	/**
	 * Constructor.
	 *
	 * @version 1.0.0
	 */
	function __construct() {
		$this->id         = 'wishlist';
		$this->short_desc = __( 'Wishlist', 'woocommerce-jetpack' );
		$this->desc       = __( 'Wishlist', 'woocommerce-jetpack' );
		$this->link_slug  = 'woocommerce-wishlist';
		parent::__construct();

		if ( $this->is_enabled() ) {
			if ( wcj_is_frontend() ) {

				/*echo "cokkki - ".$_COOKIE['wcj_wishlist'];
 				exit;*/
 				add_shortcode( 'wcj_wishlist', array( $this, 'wcj_wishlist' ) );

				add_action( 'wp_enqueue_scripts', array( $this, 'wcj_wishlist_enqueue_scripts' ) );

				add_action( 'wp_ajax_wcj_ajax_add_to_wishlist', array( $this, 'wcj_ajax_add_to_wishlist' ) );
				add_action( 'wp_ajax_nopriv_wcj_ajax_add_to_wishlist', array( $this, 'wcj_ajax_add_to_wishlist' ) );

				add_action( 'wp_ajax_wcj_ajax_remove_from_wishlist', array( $this, 'wcj_ajax_remove_from_wishlist' ) );
				add_action( 'wp_ajax_nopriv_wcj_ajax_remove_from_wishlist', array( $this, 'wcj_ajax_remove_from_wishlist' ) );

				add_action( 'wp_ajax_wcj_ajax_add_to_cart_wishlist_pro', array( $this, 'wcj_ajax_add_to_cart_wishlist_pro' ) );
				add_action( 'wp_ajax_nopriv_wcj_ajax_add_to_cart_wishlist_pro', array( $this, 'wcj_ajax_add_to_cart_wishlist_pro' ) );

				add_action( 'wp_ajax_wcj_wishlist_table_products', array( $this, 'wcj_wishlist_table_products' ) );
				add_action( 'wp_ajax_nopriv_wcj_wishlist_table_products', array( $this, 'wcj_wishlist_table_products' ) );

				if ( get_option( 'wcj_wishlist_enabled_archive' ) === 'yes' ) {
					
					add_action(
						get_option( 'wcj_wishlist_hook_archive', 'woocommerce_after_shop_loop_item' ),
						array( $this, 'wcj_add_archive_wishlist_btn' ),
						get_option( 'wcj_wishlist_priority_archive', 15 )
					);

				}

				if ( get_option( 'wcj_wishlist_enabled_single' ) === 'yes' ) {
					add_action(
						get_option( 'wcj_wishlist_hook_single', 'woocommerce_after_add_to_cart_button' ),
						array( $this, 'wcj_add_single_wishlist_btn' ),
						get_option( 'wcj_wishlist_priority_single', 10 )
					);
				}

			}
		}

	}

	/**
	 * wcj_wishlist_enqueue_scripts.
	 *
	 * @version 1.0.0
	 */
	function wcj_wishlist_enqueue_scripts() {

		wp_enqueue_style( 'wcj-wishlist-style', wcj_plugin_url() . '/includes/css/wcj-wishlist-style.css', array(), WCJ()->version );
		wp_enqueue_script( 'wcj-wishlist-script', wcj_plugin_url() . '/includes/js/wcj-wishlist-script.js', array(), WCJ()->version, true );
		
		if (is_user_logged_in() ) {
			$logged_user_id = get_current_user_id();
		}
		else{
			$logged_user_id = 0;
		}
	      
		$wcj_wishlist_page_url = get_option( 'wcj_wishlist_page_url', '' );
		$wcj_added_to_wishlist_msg = __( 'Added to wishlist', 'woocommerce-jetpack' );
		$wcj_already_to_wishlist_msg = __( 'Already on wishlist', 'woocommerce-jetpack' );
		$wcj_wishlist_url = $wcj_wishlist_page_url;
		$wcj_wishlist_url_text = __( 'Browse wishlist', 'woocommerce-jetpack' );
		$wishlist_page_table_msg = __( 'No products added to the wishlist', 'woocommerce-jetpack' );

		wp_localize_script( 'wcj-wishlist-script', 'ajax_object', array(
			'ajax_url' => admin_url( 'admin-ajax.php' ),
			'logged_user_id' => $logged_user_id,
			'wcj_added_to_wishlist_msg' => $wcj_added_to_wishlist_msg,
			'wcj_already_to_wishlist_msg' => $wcj_already_to_wishlist_msg,
			'wcj_wishlist_url' => $wcj_wishlist_url,
			'wcj_wishlist_url_text' => $wcj_wishlist_url_text,
			'wishlist_page_table_msg' => $wishlist_page_table_msg,
		) );
	}

	/**
	 * wcj_add_archive_wishlist_btn.
	 *
	 * @version 1.0.0
	 */
	function wcj_add_archive_wishlist_btn() {
		global $product;
		$product_id  = $product->get_id();
		$wcj_wishlist_btn_style = get_option( 'wcj_wishlist_style_archive', 'text' );
		
		?>

		<div class="wcj_wishlist_btn wcj_wishlist_btn_archive">
			<?php
				if($wcj_wishlist_btn_style == "text"){
					?>
						<a href="#" data-product_id="<?php echo $product_id ?>" class="wcj_ajax_add_to_wishlist wcj_wishlist_general_loader">
							<span> <?php echo get_option( 'wcj_wishlist_title_archive', 'Add to wishlist' ); ?> </span>
						</a>
					<?php
				}
				else {
					?>
						<button data-product_id="<?php echo $product_id ?>" class="button wcj_ajax_add_to_wishlist wcj_wishlist_general_loader">
                            <span> <?php echo get_option( 'wcj_wishlist_title_archive', 'Add to wishlist' );  ?> </span>
                        </button>
					<?php
				}
			?>
		</div>
		<?php
	}

	/**
	 * wcj_add_single_wishlist_btn.
	 *
	 * @version 1.0.0
	 */
	function wcj_add_single_wishlist_btn() {
		global $product;
		$product_id  = $product->get_id();
		$wcj_wishlist_btn_style = get_option( 'wcj_wishlist_style_single', 'text' );
		?>
		<div class="wcj_wishlist_btn wcj_wishlist_btn_single">
			<?php
				if($wcj_wishlist_btn_style == "text"){
					?>
						<a href="#" data-product_id="<?php echo $product_id ?>" class="wcj_ajax_add_to_wishlist wcj_wishlist_general_loader">
							<span> <?php echo get_option( 'wcj_wishlist_title_single', 'Add to wishlist' );  ?> </span>
						</a>
					<?php
				}
				else {
					?>
						<button data-product_id="<?php echo $product_id ?>" class="button wcj_ajax_add_to_wishlist wcj_wishlist_general_loader">
                            <span> <?php echo get_option( 'wcj_wishlist_title_single', 'Add to wishlist' );  ?> </span>
                        </button>
					<?php
				}
			?>
		</div>
		<?php
	}

	/**
	 * wcj_ajax_add_to_wishlist.
	 *
	 * @version 1.0.0
	 */
	function wcj_ajax_add_to_wishlist() {
		$product_id = $_POST['product_id'];
		$added = 0;
		if (is_user_logged_in() ) {
			$current_user = wp_get_current_user();
        	$current_user_wishlist = get_user_meta( $current_user->ID, 'wcj_wishlist', true);

			if( $current_user_wishlist != "" ){
				$current_user_wishlist_arr = explode( ",", $current_user_wishlist);
				if ( !in_array($product_id, $current_user_wishlist_arr) ) {
					array_push($current_user_wishlist_arr, $product_id);
					$current_user_wishlist_str = implode(",", $current_user_wishlist_arr);
					update_user_meta( $current_user->ID, 'wcj_wishlist', $current_user_wishlist_str );	
					$added = 1;
				}
			}
			else{
				update_user_meta( $current_user->ID, 'wcj_wishlist', $product_id );
				$added = 1;
			}	
		}

		$wcj_wishlist_page_url = get_option( 'wcj_wishlist_page_url', '' );

		$response_data['success'] = 1;
		if( $added === 1 ){
			$response_data['messages'] = __( 'Added to wishlist', 'woocommerce-jetpack' );
			
		}
		else {
			$response_data['messages'] = __( 'Already on wishlist', 'woocommerce-jetpack' );
		}
		
		$response_data['wishlist_url'] = $wcj_wishlist_page_url;
		$response_data['url_text'] = __( 'Browse wishlist', 'woocommerce-jetpack' );

		echo json_encode( $response_data );
		die();
	}

	/**
	 * wcj_ajax_remove_from_wishlist.
	 *
	 * @version 1.0.0
	 */
	function wcj_ajax_remove_from_wishlist() {
		$product_id = $_POST['product_id'];
		$removed = $this->wcj_remove_from_wishlist($product_id);

		$response_data['success'] = 1;
		$response_data['removed'] = $removed;

		echo json_encode( $response_data );
		die();
	}

	/**
	 * wcj_remove_from_wishlist.
	 *
	 * @version 1.0.0
	 */
	function wcj_remove_from_wishlist( $product_id ){
 		$removed = 0;
 		if( $product_id == "" ){
 			return 0;
 		}

 		if (is_user_logged_in() ) {
			$current_user = wp_get_current_user();
        	$current_user_wishlist = get_user_meta( $current_user->ID, 'wcj_wishlist', true);

			if( $current_user_wishlist != "" ){
				$current_user_wishlist_arr = explode( ",", $current_user_wishlist);
				
				if (($key = array_search($product_id, $current_user_wishlist_arr)) !== false) {
				    unset($current_user_wishlist_arr[$key]);
				    $current_user_wishlist_str = implode(",", $current_user_wishlist_arr);
				    update_user_meta( $current_user->ID, 'wcj_wishlist', $current_user_wishlist_str );
				    $removed = 1;
				}
				else{
					$removed = 0;
				}			
			}
		}
		
		return $removed;
	}
 	
 	/**
	 * wcj_ajax_add_to_cart_wishlist_pro.
	 *
	 * @version 1.0.0
	 */
	function wcj_ajax_add_to_cart_wishlist_pro() {
		$product_id = $_POST['product_id'];
        $response_data       = array();
        $product_added_to_cart   = false;
		$product             = wc_get_product( $product_id );
		$add_to_cart_handler = apply_filters( 'woocommerce_add_to_cart_handler', $product->get_type(), $product );
		$wcj_product_title = $product->get_title();

		$quantity = 1;
		$removed = 0;

		if( $add_to_cart_handler == "simple" ){
			// Add to cart validation
			$passed_validation = apply_filters( 'woocommerce_add_to_cart_validation', true, $product_id, $quantity );

			if ( $passed_validation ) {
				// Add the product to the cart
				if ( WC()->cart->add_to_cart( $product_id, $quantity ) ) {
					wc_add_notice( $this->get_add_to_cart_message( $quantity, $product->get_title() ), 'success' );
					$product_added_to_cart = true;
					$removed = $this->wcj_remove_from_wishlist($product_id);
				}
			}

			WC()->cart->maybe_set_cart_cookies();

			ob_start();

			wc_print_notices();
			$response_data['messages'] = ob_get_clean();

		}

		if ( $passed_validation && $product_added_to_cart ) {
			$response_data['success'] = 1;
			$response_data['removed'] = $removed;
			do_action( 'woocommerce_ajax_added_to_cart', $product_id );

		} else {
			$response_data['success'] = 0;
		}

        echo json_encode( $response_data );
		die();
	}

	/**
	 * get_add_to_cart_message
	 *
	 * @version 1.0.0
	 * @since  1.0.0
	 */
	private function get_add_to_cart_message( $quantity, $product_title ) {

		$product_title = '&quot;' . $product_title;

		if ( $quantity > 1 ) {
			$product_title = $quantity . ' &times; ' . $product_title;
		}

		return sprintf( __( '%s&quot; product added to cart successfully.', 'woocommerce-jetpack' ), $product_title );
	}

	/**
	 * wcj_wishlist.
	 *
	 * @version 1.0.0
	 */
	function wcj_wishlist( $atts ) {
		$wcj_wishlist = '<div class="wcj_wishlist_page"><div class="wcj_wishlist_page_notice"></div>';
		$wcj_wishlist .= '<table class="wcj_wishlist_table">
            <tr>
            	<thead>
	            	<th class="wcj_wt_remove_product"></th>
	            	<th class="wcj_wt_product_img"></th>
	                <th class="wcj_wt_product_name">'.esc_html__("Name","woocommerce-jetpack").'</th>
	                <th class="wcj_wt_product_price">'.esc_html__("Price","woocommerce-jetpack").'</th>
	                <th class="wcj_wt_product_stock">'.esc_html__("Stock","woocommerce-jetpack").'</th>
	                <th class="wcj_wt_product_cart"></th>
	            </thead>
            </tr>';

            if (is_user_logged_in() ) {
				$current_user = wp_get_current_user();
				$current_user_wishlist = get_user_meta( $current_user->ID, 'wcj_wishlist', true);
				if( $current_user_wishlist != "" ){
					
					$current_user_wishlist_arr = explode(",", $current_user_wishlist);

					foreach ($current_user_wishlist_arr as $id) {
						$product = wc_get_product( $id );
						if($product){
							$product_type = $product->get_type();
							$id = $product->get_id();

							if ( !$product->managing_stock() && !$product->is_in_stock() ){
								$stock_status_lable = __( 'Out Of Stock', 'woocommerce-jetpack' );
								$stock_status = '<td style="color:red"> '.$stock_status_lable.'  </td>';
							}
							else{
								$stock_status_lable = __( 'In Stock', 'woocommerce-jetpack' );
								$stock_status = '<td style="color:green"> '.$stock_status_lable.'  </td>';
							}

							if( $product_type == "simple" ){
								$add_to_cart = __( 'Add to cart', 'woocommerce-jetpack' );
								$add_to_cart_link = '<a class="wcj_ajax_add_to_cart_wishlist_pro wcj_wishlist_general_loader" href="#" data-product_id="'.$id.'"> <span> '.$add_to_cart.' </span> </a>';
							}
							else{
								$add_to_cart = __( 'Select options', 'woocommerce-jetpack' );
								$add_to_cart_link = '<a class="" href="'.get_permalink($id).'" data-product_id="'.$id.'"> <span> '.$add_to_cart.' </span> </a>';
							}

							$product_img = wp_get_attachment_url( $product->get_image_id() );
							if( $product_img == "" ) {
								$product_img = wc_placeholder_img_src();
							}

							$wcj_wishlist .='<tr>
								<td> 
									<a href="#" class="wcj_ajax_remove_from_wishlist wcj_wishlist_general_loader" data-product_id="'.$id.'"> <span>x</span> 
									</a>
								</td>
								<td> <a href="'.get_permalink( $id ).'"> <img width="50" height="50" src="'.$product_img.'" /> </a> </td>
								<td> <a href="'.get_permalink( $id ).'" data-product_id="'.$id.'"> '.$product->get_title().' </a> </td>
								<td> '.$product->get_price_html().'  </td>
								'.$stock_status.'
								<td> '.$add_to_cart_link.' </td>
							</tr>';
						}
					}
				}
				else{
					$wcj_wishlist .='<tr><td colspan="6" style="text-align: center;">'.esc_html__("No products added to the wishlist","woocommerce-jetpack").'</td><tr>';
				}
			}
			else {
 				$wcj_wishlist .= '<tbody id="wcj_wishlist_table_products" class="wcj_wishlist_table_products"></<tbody>';
			}

        $wcj_wishlist .= '</table></div>';
		
		return $wcj_wishlist;
	}

	/**
	 * wcj_wishlist_table_products.
	 *
	 * @version 1.0.0
	 */

	function wcj_wishlist_table_products(){
		$wcj_guest_wishlist_str = $_POST['wcj_guest_wishlist_str'];
		$guest_wishlist_html = '';

		if( $wcj_guest_wishlist_str != '' ){
			$wcj_guest_wishlist_str_arr = explode(",", $wcj_guest_wishlist_str);
			foreach ($wcj_guest_wishlist_str_arr as $id) {
				$product = wc_get_product( $id );
				if($product){
					$product_type = $product->get_type();
					$id = $product->get_id();

					if ( !$product->managing_stock() && !$product->is_in_stock() ){
						$stock_status_lable = __( 'Out Of Stock', 'woocommerce-jetpack' );
						$stock_status = '<td style="color:red"> '.$stock_status_lable.'  </td>';
					}
					else{
						$stock_status_lable = __( 'In Stock', 'woocommerce-jetpack' );
						$stock_status = '<td style="color:green"> '.$stock_status_lable.'  </td>';
					}

					if( $product_type == "simple" ){
						$add_to_cart = __( 'Add to cart', 'woocommerce-jetpack' );
						$add_to_cart_link = '<a class="wcj_ajax_add_to_cart_wishlist_pro wcj_wishlist_general_loader" href="#" data-product_id="'.$id.'"> <span> '.$add_to_cart.' </span> </a>';
					}
					else{
						$add_to_cart = __( 'Select options', 'woocommerce-jetpack' );
						$add_to_cart_link = '<a class="" href="'.get_permalink($id).'" data-product_id="'.$id.'"> <span> '.$add_to_cart.' </span> </a>';
					}

					$product_img = wp_get_attachment_url( $product->get_image_id() );
					if( $product_img == "" ) {
						$product_img = wc_placeholder_img_src();
					}

					$guest_wishlist_html .='<tr>
						<td> 
							<a href="#" class="wcj_ajax_remove_from_wishlist wcj_wishlist_general_loader" data-product_id="'.$id.'"> <span>x</span> 
							</a>
						</td>
						<td> <a href="'.get_permalink( $id ).'"> <img width="50" height="50" src="'.$product_img.'" /> </a> </td>
						<td> <a href="'.get_permalink( $id ).'" data-product_id="'.$id.'"> '.$product->get_title().' </a> </td>
						<td> '.$product->get_price_html().'  </td>
						'.$stock_status.'
						<td> '.$add_to_cart_link.' </td>
					</tr>';
				}
			}
		}
		else{
			$guest_wishlist_html .='<tr><td colspan="6" style="text-align: center;">'.esc_html__("No products added to the wishlist
	","woocommerce-jetpack").'</td><tr>';
		}

		$response_data['guest_wishlist_html'] = $guest_wishlist_html;
		echo json_encode( $response_data );
		die();
	}

}

endif;

return new WCJ_Wishlist();