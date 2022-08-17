<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://mostaql.com/u/mazonsabri
 * @since      1.0.0
 *
 * @package    Membership_Wii
 * @subpackage Membership_Wii/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Membership_Wii
 * @subpackage Membership_Wii/public
 * @author     Mazen Sabri <mazonsabri@gmail.com>
 */
class Membership_Wii_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Membership_Wii_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Membership_Wii_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/membership-wii-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Membership_Wii_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Membership_Wii_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/membership-wii-public.js', array( 'jquery' ), $this->version, false );

	}

	/**
	 * Handling AJAX Request form the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function membership_wii_handle_ajax_request(){
		if ( !wp_verify_nonce( $_REQUEST['membership_wii_ref'], "membership_wii_nonce")) {
      exit("Uses not allowed");
   	}
		global $wpdb;
    $table = $wpdb->prefix . "membership_wii";
    $memberId = $_REQUEST['name'];
		if (!empty($memberId)) {
			$result = $wpdb->get_row( "SELECT * FROM $table WHERE member_id = '$memberId'", OBJECT);
			if ( is_file( plugin_dir_path( dirname( __FILE__ ) ) . 'public/partials/membership-wii-public-display.php' ) ) {
				include_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/partials/membership-wii-public-display.php';
			}
		}
	}
	
	/**
	 * Register the shortcode form the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function register_shortcode() {
		$options = get_option( 'membership_wii_setting' );
		$logo = get_option('membership_wii_settings_demo_logo','','true');
    
		$form_title = $options["membership_wii_display_heading_text"];
		$form_desc = $options["membership_wii_display_description"];

		$form =		'<div id="membership-wii-form-wrapper">';
		// $form .=		'<img src='".$value."'>';
		$form .=		'<h2 class="header">'. $form_title .'</h2>';
		$form .=		'<h5 class="description">'. $form_desc .'</h5>';
		$form .=		'<div><form id="membership-wii-ajax-form">';
		$form .=		'<input name="membership_wii_ref" type="hidden" value="'.wp_create_nonce('membership_wii_nonce').'" />';
		$form .=		'<input id="ajax_admin_url" type="hidden" value="'.admin_url('admin-ajax.php').'" />';
		$form .=		'<input name="action" type="hidden" value="membership_wii_ajax_action" />';
		$form .= 		'<input name="name" type="text" placeholder="رقم العضوية"  />';
		$form .= 		'<input type="submit" value="بحث" id="membership-wii-form-submit">';
		$form .= 	'</form>';
		$form .= 	'<div class="records"></div>';
		$form .= 	'</div></div>';

    return $form;
	}

	private static function getSettings() {
			return get_option( 'membership_wii_setting' );
	}

	


}
