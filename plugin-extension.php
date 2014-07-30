<?php
/**
 * Plugin Name: Plugin Extension Template
 * Plugin URI:  https://github.com/joshuadavidnelson/WP-Plugin-Template-Extension
 * Description: A template for extending another plugin's functionality
 * Version:     0.1
 * Author:      Joshua David Nelson
 * Author URI:  http://joshuadnelson.com
 *
 * Based upon: http://wordpress.org/plugins/google-authenticator-encourage-user-activation/
 */

if ( $_SERVER['SCRIPT_FILENAME'] == __FILE__ )
	die( 'Access denied.' );

define( 'PET_REQUIRED_PHP_VERSION', '5.4.4' );  // The requied PHP version
define( 'PET_REQUIRED_WP_VERSION',  '3.5' );    // the required WP Version

/**
 * Checks if the system requirements are met
 *
 * @return bool True if system requirements are met, false if not
 */
function pet_requirements_met() {
	global $wp_version;
	require_once( ABSPATH . '/wp-admin/includes/plugin.php' );

	if ( version_compare( PHP_VERSION, PET_REQUIRED_PHP_VERSION, '<' ) ) {
		return false;
	}

	if ( version_compare( $wp_version, PET_REQUIRED_WP_VERSION, '<' ) ) {
		return false;
	}
	
	if ( ! is_plugin_active( 'plugin_directory/plugin_to_be_extended.php' ) ) {
		return false;
	}

	return true;
}

/**
 * Prints an error that the system requirements weren't met.
 */
function pet_requirements_error() {
	global $wp_version;
	?>
	<div class="error">
	<p>Activation error: Your environment doesn't meet all of the system requirements listed below.</p>

	<ul class="ul-disc">
		<li><strong>PHP <?php echo PET_REQUIRED_PHP_VERSION; ?>+</strong>
			<em>(You're running version <?php echo PHP_VERSION; ?>)</em>
		</li>

		<li><strong>WordPress <?php echo PET_REQUIRED_WP_VERSION; ?>+</strong>
			<em>(You're running version <?php echo esc_html( $wp_version ); ?>)</em>
		</li>
		
		<li>The PLUGIN_NAME plugin must be installed and activated.</li>
	</ul>

	<p>If you need to upgrade your version of PHP you can ask your hosting company for assistance, and if you need help upgrading WordPress you can refer to <a href="http://codex.wordpress.org/Upgrading_WordPress">the Codex</a>.</p>
</div>
	<?php
}

/*
 * Check requirements and load plugin's class
 * The main program needs to be in a separate file that only gets loaded if the plugin requirements are met. 
 *    Otherwise older PHP installations could crash when trying to parse it.
 */
if ( pet_requirements_met() ) {

	// Do your plugin business here
	
} else {
	add_action( 'admin_notices', 'pet_requirements_error' );
}
