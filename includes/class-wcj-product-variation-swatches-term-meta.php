<?php
/**
 * Booster Core for WooCommerce - Module - Product Variation Swatches Term Meta
 *
 * @version 1.0.2
 * @author  Pluggabl LLC.
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! class_exists( 'WCJ_Product_Variation_Swatches_Tear_Meta' ) ) :

class WCJ_Product_Variation_Swatches_Tear_Meta  {

	private $taxonomy;
	private $post_type;
	private $fields = array();

	public function __construct( $taxonomy, $post_type, $fields = array() ) {

		$this->taxonomy  = $taxonomy;
		$this->post_type = $post_type;
		$this->fields    = $fields;

		add_action( 'delete_term', array( $this, 'delete_term' ), 10, 4 );

		add_action( "{$this->taxonomy}_add_form_fields", array( $this, 'add' ) );
		add_action( "{$this->taxonomy}_edit_form_fields", array( $this, 'edit' ), 10 );
		add_action( "created_term", array( $this, 'save' ), 10, 3 );
		add_action( "edit_term", array( $this, 'save' ), 10, 3 );
	}

	public function delete_term( $term_id, $tt_id, $taxonomy, $deleted_term ) {
		global $wpdb;

		$term_id = absint( $term_id );
		if ( $term_id and $taxonomy == $this->taxonomy ) {
			$wpdb->delete( $wpdb->termmeta, array( 'term_id' => $term_id ), array( '%d' ) );
		}
	}

	public function save( $term_id, $tt_id = '', $taxonomy = '' ) {

		if ( $taxonomy == $this->taxonomy ) {
			foreach ( $this->fields as $field ) {
				foreach ( $_POST as $post_key => $post_value ) {
					if ( $field['id'] == $post_key ) {
						switch ( $field['type'] ) {
							case 'wcj_color':
								$post_value = esc_html( $post_value );
								break;
							case 'wcj_image':
								$post_value = absint( $post_value );
								break;
							default:
								do_action( 'wcj_save_term_meta', $term_id, $field, $post_value, $taxonomy );
								break;
						}
						update_term_meta( $term_id, $field['id'], $post_value );
					}
				}
			}
		}
	}

	public function add() {
		$this->generate_fields();
	}

	private function generate_fields( $term = false ) {

		$screen = get_current_screen();

		if ( ( $screen->post_type == $this->post_type ) and ( $screen->taxonomy == $this->taxonomy ) ) {
			self::generate_form_fields( $this->fields, $term );
		}
	}

	public static function generate_form_fields( $fields, $term ) {

		if ( empty( $fields ) ) {
			return;
		}

		foreach ( $fields as $field ) {

			$field['id'] = esc_html( $field['id'] );

			if ( ! $term ) {
				$field['value'] = isset( $field['default'] ) ? $field['default'] : '';
			} else {
				$field['value'] = get_term_meta( $term->term_id, $field['id'], true );
			}
			$field['size']        = isset( $field['size'] ) ? $field['size'] : '40';

			self::field_start( $field, $term );
			switch ( $field['type'] ) {

				case 'wcj_color':
					ob_start();
					?>
					<input name="<?php echo $field['id'] ?>" id="<?php echo $field['id'] ?>" type="text" class="wcj-color-picker" value="<?php echo $field['value'] ?>" data-default-color="<?php echo $field['value'] ?>" size="<?php echo $field['size'] ?>">
					<?php
					echo ob_get_clean();
					break;
				case 'wcj_image':
					ob_start();
					?>
					<div class="meta-image-field-wrapper">
						<div id="wcj-image-preview" class="wcj-image-preview">
							<img data-placeholder="<?php echo esc_url( wc_placeholder_img_src() ); ?>" src="<?php echo esc_url( self::wcj_get_term_img( $field['value'] ) ); ?>" width="60px" height="60px" />
						</div>
						<div class="button-wrapper">
							<input type="hidden" id="<?php echo $field['id'] ?>" name="<?php echo $field['id'] ?>" value="<?php echo esc_attr( $field['value'] ) ?>" />
							<button type="button" id="wcj_upload_image_button" class="wcj_upload_image_button button button-primary button-small"><?php esc_html_e( 'Upload / Add image', 'woocommerce-jetpack' ); ?></button>
							<button type="button" id="wcj_remove_image_button" style="<?php echo( empty( $field['value'] ) ? 'display:none' : '' ) ?>" class="wcj_remove_image_button button button-danger button-small"><?php esc_html_e( 'Remove image', 'woocommerce-jetpack' ); ?></button>
						</div>
					</div>
					<?php
					echo ob_get_clean();
					break;
				default:
					do_action( 'wcj_term_meta_field', $field, $term );
					break;

			}
			self::field_end( $field, $term );

		}
	}

	private static function field_start( $field, $term ) {

		ob_start();
		if ( ! $term ) {
			?>
			<div class="form-field <?php echo esc_attr( $field['id'] ) ?> <?php echo empty( $field['required'] ) ? '' : 'form-required' ?>">
			<?php if ( $field['type'] !== 'checkbox' ) { ?>
				<label for="<?php echo esc_attr( $field['id'] ) ?>"><?php echo $field['label'] ?></label>
				<?php
			}
		} else {
			?>
			<tr class="form-field  <?php echo esc_attr( $field['id'] ) ?> <?php echo empty( $field['required'] ) ? '' : 'form-required' ?>">
			<th scope="row">
				<label for="<?php echo esc_attr( $field['id'] ) ?>"><?php echo $field['label'] ?></label>
			</th>
			<td>
			<?php
		}
		echo ob_get_clean();
	}

	private static function wcj_get_term_img( $thumbnail_id = false ) {
		if ( ! empty( $thumbnail_id ) ) {
			$image = wp_get_attachment_thumb_url( $thumbnail_id );
		} else {
			$image = wc_placeholder_img_src();
		}

		return $image;
	}

	private static function field_end( $field, $term ) {

		ob_start();
		if ( ! $term ) {
			?>
			<p><?php echo $field['desc'] ?></p>
			</div>
			<?php
		} else {
			?>
			<p class="description"><?php echo $field['desc'] ?></p></td>
			</tr>
			<?php
		}
		echo ob_get_clean();
	}

	public function edit( $term ) {
		$this->generate_fields( $term );
	}

	public function wcj_get_wc_attribute_taxonomy( $attribute_name ) {
		global $wpdb;
		$attribute_name = str_replace( 'pa_', '', wc_sanitize_taxonomy_name( $attribute_name ) );
		$attribute_taxonomy = $wpdb->get_row( "SELECT * FROM " . $wpdb->prefix . "woocommerce_attribute_taxonomies WHERE attribute_name='{$attribute_name}'" );
		return $attribute_taxonomy;
	}

}
endif;