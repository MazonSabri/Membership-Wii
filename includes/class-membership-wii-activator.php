<?php

/**
 * Fired during plugin activation
 *
 * @link       https://mostaql.com/u/mazonsabri
 * @since      1.0.0
 *
 * @package    Membership_Wii
 * @subpackage Membership_Wii/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Membership_Wii
 * @subpackage Membership_Wii/includes
 * @author     Mazen Sabri <mazonsabri@gmail.com>
 */
class Membership_Wii_Activator {

	/**
	 * On activation create a page and remember it.
	 *
	 * Create a page named "Membership Wii", add a shortcode that will show the saved items
	 * and remember page id in our database.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {
		self::membership_wii_create_database_table();
		// Saved Page Arguments
		$saved_page_args = array(
			'post_title'   => __( 'Membership Wii', 'membership-wii' ),
			'post_content' => '[membership_wii_form]',
			'post_status'  => 'publish',
			'post_type'    => 'page'
		);
		// Insert the page and get its id.
		$saved_page_id = wp_insert_post( $saved_page_args );
		// Save page id to the database.
		add_option( 'membership_wii_saved_page_id', $saved_page_id );
	}

	/**
	* Create database table.
	*
	* @since     1.0.0
	* @return    string    database name.
	*/
	public function membership_wii_create_database_table(){
		global $wpdb;
		$membership_wii_db = $wpdb->prefix . "membership_wii";
		// $charset_collate = $wpdb->get_charset_collate();
		$charset_collate = 'utf8mb4_unicode_ci';
		$sql = "CREATE TABLE `$membership_wii_db` (
			`id` int(11) NOT NULL AUTO_INCREMENT,
			`name` varchar(40) NOT NULL,
			`phone_number` varchar(16) NOT NULL,
			`member_id` varchar(16) NOT NULL UNIQUE,
			`started_at` datetime NOT NULL,
			`ending_period` varchar(20) NOT NULL,
			`created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
			PRIMARY KEY(id)
			) $charset_collate; ";
		if ($wpdb->get_var("show tables like '$membership_wii_db'") != $membership_wii_db) {
			require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
			dbDelta($sql);
		}
	}
}
