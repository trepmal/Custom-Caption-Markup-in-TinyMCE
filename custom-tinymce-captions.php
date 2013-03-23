<?php
/*
Plugin Name: Custom Caption Markup in TinyMCE
Description: Use figure/figcation markup in TinyMCE instead of dl/dt/dd
Author: Kailey Lampert
Author URI: kaileylampert.com
*/

/**
 * The markup around captions that you see in TinyMCE/Visual editor
 * By default, we get something like:
 * div » dl.wp-caption alignnone » dt.wp-caption-dt » img.size-medium wp-image-999
 * is added by a WP TinyMCE plugin, wpEditImage
 *
 * To customize this, we must first turn off that plugin:
 */
add_filter('tiny_mce_plugins', 'ct_tiny_mce_plugins' );
function ct_tiny_mce_plugins( $plugins ) {
	if ( false !== ( $key = array_search('wpeditimage', $plugins ) ) )
		unset( $plugins[ $key ] );
	return $plugins;
}

/**
 * Next, we re-add our nearly identical version, but with our markup edits:
 * This version produces markup like:
 * div » figure.wp-caption alignnone » img.size-medium wp-image-999
 */
add_filter( 'mce_external_plugins', 'ct_mce_external_plugins', 11 );
function ct_mce_external_plugins( $plugin_array ) {
	$plugin_array[ 'wpeditimage2' ] =  plugins_url( 'editor_plugin_src.js', __FILE__ );
	return $plugin_array;
}

