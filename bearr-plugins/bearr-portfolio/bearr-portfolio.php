<?php
/*
Plugin Name: BeaRR: portfolio
Plugin URI: http://themebear.co
Description: Adds testimonals functionality to ThemeBear Themes.
Author: Diego Pereira @ ThemeBear
Version: 1.0
Author URI: http://themebear.co
*/
/**
 * Advanced Custom Fields Configuration
 *
 *
 * @package bearr
 * 
 */

/*
 * Custom Post Types
 */
require ('portfolio_custom-post-types.php');
/*
 * Meta Fields
 */

$bearr_setup_portfolio_metabox = get_option( 'bearr_setup_portfolio_metabox' );
if ( $bearr_setup_portfolio_metabox != 'false') {
	require ('portfolio_meta-fields-cpt.php');
}
/*
 * Shortcodes
 */
$bearr_setup_portfolio_shortcode = get_option( 'bearr_setup_portfolio_shortcode' );
if ( $bearr_setup_portfolio_shortcode != 'false') {
	require ('portfolio_shortcodes.php');
}
/*
 * King Composer
 */
if ( $bearr_setup_portfolio_shortcode != 'false') {
	require ('portfolio_extend-king-composer.php');
}
/*
 * Active King Composer on portfolio pages
 */
function kcportfolio_init() {
	//Enable King COmposer on Portfolio
	global $kc;
	// add single content type
	$kc->add_content_type( array( 'portfolio' ) );
}

if ( is_plugin_active( 'kingcomposer/kingcomposer.php' ) ){
	add_action( 'init', 'kcportfolio_init' );
}


