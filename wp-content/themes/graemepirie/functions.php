<?php
/**
 * Functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package WordPress
 * @subpackage Graeme_Pirie
 * @since Graeme Pirie 1.0
 */

function gp_theme_setup() {
	register_nav_menus(
		array(
			'main_menu'      => 'Main Menu',
			'footer_menu'    => 'Footer Menu',
			'legal_menu'     => 'Legal Menu',
		)
	);

	// Theme Support.
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'custom-logo' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'colors' );
	add_theme_support( 'html5', [ 'search-form', 'gallery', 'caption' ] );
	add_theme_support( 'customize-selective-refresh-widgets' );
}
add_action( 'after_setup_theme', 'gp_theme_setup' );

add_action('graphql_register_types', function() {
	register_graphql_field('RootQuery', 'blockStyles', [
		'type' => 'String',
		'description' => __('Get the block styles', 'graemepirie'),
		'resolve' => function() {
			$css = file_get_contents(get_template_directory_uri() . '/wp-includes/css/dist/block-library/style.min.css');
			return $css ?: '';
		},
	]);
});
