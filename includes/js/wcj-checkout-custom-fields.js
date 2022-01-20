/**
 * wcj-checkout-custom-fields.
 *
 * @version 1.0.0
 * @since  1.0.0
 */

jQuery(document).ready(function() {
	for (var i = 0, len = wcj_checkout_custom_fields.select2_fields.length; i < len; i++) {
		jQuery("#"+wcj_checkout_custom_fields.select2_fields[i].field_id).select2({
			minimumInputLength: wcj_checkout_custom_fields.select2_fields[i].minimumInputLength,
			maximumInputLength: wcj_checkout_custom_fields.select2_fields[i].maximumInputLength,
		});
	}
});
