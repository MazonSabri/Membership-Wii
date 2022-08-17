<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://mostaql.com/u/mazonsabri
 * @since      1.0.0
 *
 * @package    Membership_Wii
 * @subpackage Membership_Wii/admin/partials
 */

?>
<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<form action='options.php' method='post'>
		<h2>Membership Wii</h2>
		<?php settings_errors(); ?>
		<?php
				settings_fields( 'membership_wii_settings' );
				do_settings_sections( 'membership_wii_settings' );
				submit_button();
				?>
</form>
<?php