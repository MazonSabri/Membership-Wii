<?php
/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://mostaql.com/u/mazonsabri
 * @since      1.0.0
 *
 * @package    Membership_Wii
 * @subpackage Membership_Wii/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Membership_Wii
 * @subpackage Membership_Wii/admin
 * @author     Mazen Sabri <mazonsabri@gmail.com>
 */
class Membership_Wii_Admin {

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
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
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

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/membership-wii-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
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

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/membership-wii-admin.js', array( 'jquery' ), $this->version, false );
		
		if ( isset( $_GET['page'] ) && ! empty( $_GET['page'] ) && 'membership-wii' === $_GET['page'] ) {
			wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/membership-wii-admin.js', array( 'jquery' ), $this->version, false );
		}
	}

	/*
	* Register the admin settings.
	*
	* @since    1.0.0
	*/
	public function membership_wii_settings_init(  ) { 
			register_setting(
				'membership_wii_settings', 
				'membership_wii_setting' 
			);
			    
			register_setting(
				'membership_wii_settings', 
				'membership_wii_settings_demo_logo', 
				'membership_wii_handle_logo_upload'
			); 


			add_settings_section(
				'membership_wii_display_setting_section', 
				__( 'Display Settings', 'membership-wii' ), 
				array( __CLASS__ ,'membership_wii_display_setting_callback'),
				'membership_wii_settings' 
			);

			add_settings_field(
				'membership_wii_display_logo',
				__( 'Your Logo', 'membership-wii' ),
				array( __CLASS__ ,'membership_wii_display_logo_callback'),
				'membership_wii_settings',
				'membership_wii_display_setting_section'
			);


			add_settings_field( 
				'membership_wii_display_heading_text', 
				__( 'Heading Text', 'membership-wii' ), 
				array( __CLASS__ ,'membership_wii_display_heading_text_callback'),
				'membership_wii_settings', 
				'membership_wii_display_setting_section' 
			);
			
			add_settings_field( 
				'membership_wii_display_description', 
				__( 'Description Text', 'membership-wii' ), 
				array( __CLASS__ ,'membership_wii_display_description_callback'),
				'membership_wii_settings', 
				'membership_wii_display_setting_section' 
			);
			
		}

	
	/*
	* Register the admin menu.
	*
	* @since    1.0.0
	*/
	function membership_wii_admin_menu() {
			add_menu_page(
				'Membership Wii', 
				esc_html__('Membership Wii', 'membership-wii' ),
				'manage_options', 
				'membership-wii-panel', 
				array( __CLASS__, 'membership_wii_admin_display_partial')
			);

			add_submenu_page(
				'membership-wii-panel', 
				esc_html__('Display Settings', 'membership-wii' ),
				esc_html__('Display', 'membership-wii' ),
				'manage_options',
				'membership-wii-panel'
			);

			add_submenu_page(
				'membership-wii-panel',
				esc_html__('Memberships Settings', 'membership-wii' ),
				esc_html__('Memberships', 'membership-wii' ),
				'manage_options',
				'membership-wii-members',
				array( __CLASS__, 'membership_wii_admin_members_partial')
			);
			
			add_submenu_page(
				'membership-wii-panel',
				esc_html__('Settings', 'membership-wii' ),
				esc_html__('Settings', 'membership-wii' ),
				'manage_options',
				'membership-wii-settings'
			);
  }

	public static function membership_wii_admin_display_partial() {
		if ( is_file( plugin_dir_path( dirname( __FILE__ ) ) . 'admin/partials/membership-wii-admin-display.php' ) ) {
				include_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/partials/membership-wii-admin-display.php';
		}	
	}
	
	public static function membership_wii_admin_members_partial() {
		global $wpdb;
		
		$table = $wpdb->prefix . "membership_wii";
		
		$query = "(SELECT * FROM wp_membership_wii)";
		$total_query = "SELECT COUNT(1) FROM (${query}) AS combined_table";
		
		$total = $wpdb->get_var( $total_query );
		$items_per_page = 20;
		$page = isset( $_GET['cpage'] ) ? abs( (int) $_GET['cpage'] ) : 1;
		$offset = ( $page * $items_per_page ) - $items_per_page;

		$members = $wpdb->get_results( $query . " ORDER BY created_at DESC LIMIT ${offset}, ${items_per_page}" );
		if ( is_file( plugin_dir_path( dirname( __FILE__ ) ) . 'admin/partials/membership-wii-admin-members.php' ) ) {
				include_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/partials/membership-wii-admin-members.php';
		}	
	}

	public static function membership_wii_handle_ajax_add_edit() {
		if ( !wp_verify_nonce( $_REQUEST['membership_wii_ref'], "membership_wii_nonce")) {
      exit("Uses not allowed");
   	}
		global $wpdb;
    $table = $wpdb->prefix . "membership_wii";
		
		$member_info = array(
			'name' => $_POST['name'], 
			'member_id' => $_POST['member_id'], 
			'started_at' => $_POST['started_at'], 
			'ending_period' => $_POST['ending_period'],
			'phone_number' => $_POST['phone_number']
		);
	
		$result = $wpdb->update($table, $member_info, array('member_id' => $member_info["member_id"]));

		if ($result === FALSE || $result < 1) {
				$wpdb->insert($table, $member_info);
				echo "Member Added Seccessfully.";
				die();
		} else {
				echo "Member Edited Seccessfully.";
				die();
		}
	}

	public function membership_wii_handle_ajax_delete() {
		$id = $_POST['id'];
		global $wpdb;
    $table = $wpdb->prefix . "membership_wii";
		if ($id) {
			$wpdb->delete( $table, array( 'member_id' => $id ) );
			echo 'Deleted post';
			die;
    } else {
			echo 'Nonce not verified';
			die;
    }

	}

	public function membership_wii_handle_logo_upload($option) {
		if(!empty($_FILES["membership_wii_settings_demo_logo"]["tmp_name"])){
			$urls = wp_handle_upload($_FILES["membership_wii_settings_demo_logo"], array('test_form' => FALSE));
			$temp = $urls["url"];
			return $temp;  
  	}
 
  	return $option;
	}
	
	/**
	 * Display a custom menu page
	 */
	public function membership_wii_display_setting_callback(  ) { 
			echo __( 'Membership Wii Front-end Display Texts', 'membership-wii' );
	}

	
	public function membership_wii_display_logo_callback() {?>
    <input type="file" name="membership_wii_settings_demo_logo" />
		<?php echo get_option('membership_wii_settings_demo_logo'); ?>
    <?php
	}

	
	public function membership_wii_display_heading_text_callback(  ) { 
		$options = get_option( 'membership_wii_setting' ); ?>
		<input type='text' name='membership_wii_setting[membership_wii_display_heading_text]' 
		value='<?php echo $options["membership_wii_display_heading_text"]; ?>'>
		<?php
	}

	public function membership_wii_display_description_callback(  ) { 
		$options = get_option( 'membership_wii_setting' );
		?>
		<input type='text' name='membership_wii_setting[membership_wii_display_description]' 
		value='<?php echo $options["membership_wii_display_description"]; ?>'>
		<?php
	}
 
	
}
