(function ($) {
	'use strict';

	/**
	 * All of the code for your admin-facing JavaScript source
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

	$(function () {
		$(".member-add-edit").submit(function (e) {
			e.preventDefault();
			var memberData = jQuery(this).serialize();
			var admin_ajaxurl = jQuery('#ajax_admin_url').val();
			jQuery.ajax({
				type: "POST",
				// action: "membership_wii_ajax_action", // Located on form data
				// Get the admin ajax url which we have passed through wp_localize_script().
				url: admin_ajaxurl,
				data: memberData,
				success: function (data) {
					// jQuery(".records").html(data);
					alert(data);
					setTimeout(function () {
						location.reload();
					}, 1000)
					// $(".styled-table-members tbody").append("<tr data-name='" + data[0] + "'><td>" + name + "</td><td>" + email + "</td><td><button class='btn btn-info btn-xs btn-edit'>Edit</button><button class='btn btn-danger btn-xs btn-delete'>Delete</button></td></tr>");
				}
			});
		});
	});


	$(function () {
		$(".member-edit").on("click", function () {

			let $tr = $(this).closest('tr');

			var name = $tr.children("td:eq(0)").text();
			var memberId = $tr.children("td:eq(1)").text();
			var phoneNumber = $tr.children("td:eq(5)").text();
			var startedAt = $tr.children("td:eq(3)").text();
			// var endingAt = $tr.children("td:eq(4)").text();

			$("#name").val(name);
			$("#member_id").prop('readonly', true);
			$("#phone_number").val(phoneNumber);
			$("#started_at").val(startedAt);
			$("#ending_period").val($("#ending_period option:first").val());
			$("#member_id").val(memberId);
			$("#member-add-edit-submit").text('تعديل العضوية');
		});
	});

	$(function () {
		$(".member-delete").on("click", function () {
			var admin_ajaxurl = $('#ajax_admin_url').val();
			var $id = $(this).closest('td').attr('data-id');
			jQuery.ajax({
				type: "POST",
				url: admin_ajaxurl,
				data: { "action": "membership_wii_ajax_delete", "id": $id },
				success: function (data) {
					// jQuery(".records").html(data);
					alert(data);
					setTimeout(function () {
						location.reload();
					}, 1000)
					// $(".styled-table-members tbody").append("<tr data-name='" + data[0] + "'><td>" + name + "</td><td>" + email + "</td><td><button class='btn btn-info btn-xs btn-edit'>Edit</button><button class='btn btn-danger btn-xs btn-delete'>Delete</button></td></tr>");
				}
			});
		});
	});

})(jQuery);
