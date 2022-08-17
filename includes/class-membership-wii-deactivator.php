<?php

/**
 * Fired during plugin deactivation
 *
 * @link       https://mostaql.com/u/mazonsabri
 * @since      1.0.0
 *
 * @package    Membership_Wii
 * @subpackage Membership_Wii/includes
 */

/**
 * Fired during plugin deactivation.
 *
 * This class defines all code necessary to run during the plugin's deactivation.
 *
 * @since      1.0.0
 * @package    Membership_Wii
 * @subpackage Membership_Wii/includes
 * @author     Mazen Sabri <mazonsabri@gmail.com>
 */
class Membership_Wii_Deactivator {

	/**
	 *
	 * On deactivation delete the "Membership Wii" page.
	 * 
	 * Get the "Membership Wii" page id, check if it exists and delete the page that has that id.
	 *
	 * @since    1.0.0
	 */
	public static function deactivate() {
		// Get Saved page id.
		$saved_page_id = get_option( 'membership_wii_saved_page_id' );

		// Check if the saved page id exists.
		if ( $saved_page_id ) {

			// Delete saved page.
			wp_delete_post( $saved_page_id, true );

			// Delete saved page id record in the database.
			delete_option( 'membership_wii_saved_page_id' );

		}
	}

}
