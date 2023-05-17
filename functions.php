<?php

/**
 * Bridge theme functions file
 *
 * @package nek5t/bridge-theme
 * @since 1.0.0
 */

/**
 * Current theme version.
 */
define( 'BRIDGE_THEME_VER', wp_get_theme()->get( 'Version' ) );

function bridge_theme_setup() {
	add_theme_support( 'wp-block-styles' );
	$block_styles_dir = get_template_directory() . '/assets/css/dist/blocks';

	$core_block_styles = glob( $block_styles_dir . '/core-*.css', GLOB_NOSORT );

	foreach( $core_block_styles as $block_style ) {
		$block_name = str_replace( array( $block_styles_dir, '/core-', '.min', '.css' ), '',  $block_style );

		$args = array(
			'handle' => "bridge-$block_name",
			'src' => get_template_directory_uri( $block_style ),
			'path' => $block_style,
			'ver' => BRIDGE_THEME_VER
		);

		wp_enqueue_block_style( "core/$block_name", $args );
	}
}
add_action( 'after_setup_theme', 'bridge_theme_setup' );
