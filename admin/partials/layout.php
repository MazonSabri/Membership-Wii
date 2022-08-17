<?php
/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://mostaql.com/u/mazonsabri
 * @since      1.0.0
 *
 * @package    Membership_Wii
 * @subpackage Membership_Wii/admin/partials
 */


require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/partials/membership-wii-add-user.php';

if (isset($_POST['gonder'])) {
    global $wpdb;
    $output  = esc_html_e( 'Admin Page Test', 'membership-wii' );
    $output .= '<form method="POST">
                    <br>
                    <label>Admin Name:</label>
                    <input type="text" name="name"><br><br>
                    <label>E-posta</label>
                    <input type="email" name="email"><br><br>
                    <label>Telefon</label>
                    <input type="number" name="telephone">
                    <input type="submit" name="gonder">
                </form>';
                
    $wpdb->insert( "testing_hook",
      array(
      "name" => $_POST['isim'],
      "mail" => $_POST['eposta'],
      "phone" => $_POST['telefon']
      )
    );
}
