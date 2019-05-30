<?php
/**
 * boat seller back compat functionality
 *
 * Prevents boat seller from running on WordPress versions prior to 4.4,
 * since this theme is not meant to be backward compatible beyond that and
 * relies on many newer functions and markup changes introduced in 4.4.
 *
 * @package boatseller
 * @subpackage Boat_seller
 * @since boat seller 1.0
 */
/**
 * Prevent switching to boat seller on old versions of WordPress.
 *
 * Switches to the default theme.
 *
 * @since boat seller 1.0
 */
function boatseller_switch_theme() {
	switch_theme( WP_DEFAULT_THEME, WP_DEFAULT_THEME );
	unset( $_GET['activated'] );
	add_action( 'admin_notices', 'boatseller_upgrade_notice' );
}
add_action( 'after_switch_theme', 'boatseller_switch_theme' );
/**
 * Adds a message for unsuccessful theme switch.
 *
 * Prints an update nag after an unsuccessful attempt to switch to
 * boat seller on WordPress versions prior to 4.4.
 *
 * @since boat seller 1.0
 *
 * @global string $wp_version WordPress version.
 */
function boatseller_upgrade_notice() {
    /* Translators: Just to check WordPress Version */
	$message = sprintf(   __('boat seller requires at least WordPress version 4.4. You are running version %s. Please upgrade and try again.', 'boatseller' ), $GLOBALS['wp_version'] );
	printf( '<div class="error"><p>%s</p></div>', $message );
}
/**
 * Prevents the Customizer from being loaded on WordPress versions prior to 4.4.
 *
 * @since boat seller 1.0
 *
 * @global string $wp_version WordPress version.
 */
function boatseller_customize() {
    /* Translators: Just to check WordPress Version */
	wp_die( sprintf(   __('boat seller requires at least WordPress version 4.4. You are running version %s. Please upgrade and try again.', 'boatseller' ), $GLOBALS['wp_version'] ), '', array(
		'back_link' => true,
	) );
}
add_action( 'load-customize.php', 'boatseller_customize' );
/**
 * Prevents the Theme Preview from being loaded on WordPress versions prior to 4.4.
 *
 * @since boat seller 1.0
 *
 * @global string $wp_version WordPress version.
 */
function boatseller_preview() {
    /* Translators: Just to check WordPress Version */
	if ( isset( $_GET['preview'] ) ) {
		wp_die( sprintf(   __('boat seller requires at least WordPress version 4.4. You are running version %s. Please upgrade and try again.', 'boatseller' ), $GLOBALS['wp_version'] ) );
	}
}
add_action( 'template_redirect', 'boatseller_preview' );