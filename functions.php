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
	bridge_enqueue_block_styles();
}
add_action( 'after_setup_theme', 'bridge_theme_setup' );

function bridge_enqueue_block_styles() {
	$block_styles_dir = 'assets/css/dist/blocks';

	$block_styles = glob( trailingslashit( get_template_directory() ) . $block_styles_dir . '/*.css', GLOB_NOSORT );

	foreach( $block_styles as $block_style ) {
		$style_path = ltrim( str_replace( get_template_directory(), '', $block_style ), '/' );

		$block = explode( '.', str_replace( array( $block_styles_dir, '/', '.min', '.css' ), '', $style_path ), 2 );

		$block_vendor = $block[0];
		$block_name = $block[1];

		$args = array(
			'handle' => "bridge-$block_name",
			'src' => get_template_directory_uri( $style_path ),
			'path' => $block_style,
			'ver' => BRIDGE_THEME_VER
		);

		wp_enqueue_block_style( "$block_vendor/$block_name", $args );
	}
}
