<?php
/** Step 2 (from text above). */
add_action( 'admin_menu', 'bwfeed_menu' );
add_action( 'admin_init', 'register_mysettings' );

function register_mysettings() { // whitelist options
  register_setting( 'bwfeed_settings', 'bwfeed_url' );
}

/** Step 1. */
function bwfeed_menu() {
	add_options_page( 'BWFeed Options', 'BWFeed', 'manage_options', 'bwfeed_settings', 'bwfeed_options' );
}

/** Step 3. */
function bwfeed_options() {
	if ( !current_user_can( 'manage_options' ) )  {
		wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
	}


	echo '<div class="wrap">';
	echo '<h1>BWFeed Options</h1>';
	echo '<form method="post" action="options.php">';
	settings_fields( 'bwfeed_settings' );
	do_settings_sections( 'bwfeed_settings' );
	echo '<tr valign="top">';
	echo '<th scope="row">BWFeed URL</th>';
	echo '<td><input type="text" name="bwfeed_url" value="'.esc_attr( get_option('bwfeed_url') ).'" /></td></tr>';
	submit_button();
	echo '</form>';
	echo '</div>';
}

?>