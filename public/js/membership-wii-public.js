(function ($) {
	'use strict';

	/**
	 * All of the code for your public-facing JavaScript source
	 * should reside in this file.
	 *
	 * Note: It has been assumed you will write jQuery code here, so the
	 * $ function reference has been prepared for usage within the scope
	 * of this function.
	 *
	 * This enables you to define handlers, for when the DOM is ready:
	 *
	 * $(function() {
	 *
	 * });
	 *
	 * When the window is loaded:
	 *
	 * $( window ).load(function() {
	 *
	 * });
	 *
	 * ...and/or other possibilities.
	 *
	 * Ideally, it is not considered best practise to attach more than a
	 * single DOM-ready or window-load handler for a particular page.
	 * Although scripts in the WordPress core, Plugins and Themes may be
	 * practising this, we should strive to set a better example in our own work.
	 */
	// $(function () {
	// 	$('#membership-wii-ajax-form').submit(function (e) {
	// 		// prevent the default action.
	// 		e.preventDefault();
	// 		var myform = jQuery(this).serialize();
	// 		var admin_ajaxurl = jQuery('#ajax_admin_url').val();

	// 	});
	// });

	$(function () {
		$('#membership-wii-ajax-form').submit(function (e) {
			// prevent the default action.
			e.preventDefault();
			var formData = jQuery(this).serialize();
			var admin_ajaxurl = jQuery('#ajax_admin_url').val();

			jQuery.ajax({
				type: "GET",
				// action: "membership_wii_ajax_action", // Located on form data
				// Get the admin ajax url which we have passed through wp_localize_script().
				url: admin_ajaxurl,
				data: formData,
				success: function (data) {
					jQuery(".records").html(data);
				}
			});
		});
	});


})(jQuery);
