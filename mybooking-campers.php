<?php

/**
 * MYBOOKING CAMPERS PLUGIN
 * ------------------------
 *
 * @wordpress-plugin
 * Plugin Name:       Mybooking Campers
 * Plugin URI:        https://mybooking.es
 * Description:       Simple plugin to create a Custom Post Type to show camper pages
 * Version:           1.0.6
 * Author:            Mybooking Team
 * Author URI:        https://mybooking.es
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       mybooking-campers
 * Domain Path:       /languages
 *
 * @link              https://mybooking.es
 * @since             1.0.0
 * @package           Mybooking Campers
 */


// Reject direct requests for this file
if ( ! defined( 'WPINC' ) ) { die; }


/**
 * Enqueue styles
 *
 * @since 1.0.0
 */
function mybooking_camper_styles( ) {
	wp_register_style(
		'mybooking-campers-styles',
		plugins_url( '/style.css', __FILE__ )
	);
	wp_enqueue_style(
	 'mybooking-campers-styles',
	 plugin_dir_url( __FILE__ ) . 'style.css'
	);
}
add_action( 'wp_enqueue_scripts', 'mybooking_camper_styles' );

/**
 * Enqueue gallery styles and scripts on single camper pages
 *
 * @since 1.0.7
 */
function mybooking_camper_gallery_frontend() {
	if ( is_singular( 'camper' ) ) {
		wp_enqueue_style(
			'mybooking-campers-gallery-css',
			plugin_dir_url( __FILE__ ) . 'includes/assets/css/mybooking-camper-gallery.css',
			array(),
			'1.0.0'
		);
		wp_enqueue_script(
			'mybooking-campers-gallery-js',
			plugin_dir_url( __FILE__ ) . 'includes/assets/js/mybooking-camper-gallery.js',
			array( 'jquery' ),
			'1.0.0',
			true
		);
	}
}
add_action( 'wp_enqueue_scripts', 'mybooking_camper_gallery_frontend' );

/**
 * Loads textdomain
 *
 * @since 1.0.0
 */
function load_mybooking_campers_textdomain() {
    load_plugin_textdomain( 'mybooking-campers', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
}
add_action( 'plugins_loaded', 'load_mybooking_campers_textdomain' );

/**
 * Includes camper post type
 *
 * @since 1.0.0
 */
include_once('includes/camper-post-type.php');


/**
 * Includes camper meta boxes
 *
 * @since 1.0.0
 */
include_once('includes/camper-metaboxes.php');


/**
 * Includes plugin breadcrumbs
 *
 * @since 1.0.0
 */
include_once('includes/plugin-breadcrumbs.php');


/**
 * Includes plugin shortcodes
 *
 * @since 1.0.3
 */
include_once('includes/plugin-shortcodes.php');


/**
 * Add class 'mybooking-product' to custom post type
 *
 * @since 1.0.1
 */
function mybooking_campers_body_class ( $classes ) {

    if ( 'camper' == get_post_type() ):
      $classes[] = 'mybooking-product';
      $classes[] = 'mybooking-contact-widget';
    endif;

    return $classes;

}
add_filter( 'body_class', 'mybooking_campers_body_class' );


/**
 * Load microtemplates
 *
 * @since 1.0.1
 */
function mybooking_campers_include_micro_templates ( $classes ) {

    if ( 'camper' == get_post_type() ):
      if ( function_exists('mybooking_engine_get_template') ):
        mybooking_engine_get_template('mybooking-plugin-product-widget-tmpl.php');
      endif;
    endif;

}
add_action( 'wp_footer',  'mybooking_campers_include_micro_templates' );


/**
 * Create sidebars for templates
 *
 * @since 1.0.2
 */
function mybooking_campers_sidebars() {
    register_sidebar( array(
        'name'          => __( 'Campers Archive Top', 'mybooking-campers' ),
        'id'            => 'sidebar-top',
        'description'   => __( 'Widgets in this area will be shown on campers archives page.', 'mybooking-campers' ),
        'before_widget' => '<div id="%1$s" class="mybooking-campers_widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h2 class="mybooking-campers_widget-title">',
        'after_title'   => '</h2>',
    ) );

		register_sidebar( array(
        'name'          => __( 'Campers Archive Bottom', 'mybooking-campers' ),
        'id'            => 'sidebar-bottom',
        'description'   => __( 'Widgets in this area will be shown on campers archives page.', 'mybooking-campers' ),
        'before_widget' => '<div id="%1$s" class="mybooking-campers_widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h2 class="mybooking-campers_widget-title">',
        'after_title'   => '</h2>',
    ) );

		register_sidebar( array(
        'name'          => __( 'Campers Post', 'mybooking-campers' ),
        'id'            => 'sidebar-post',
        'description'   => __( 'Widgets in this area will be shown on campers single page.', 'mybooking-campers' ),
        'before_widget' => '<div id="%1$s" class="mybooking-campers_widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h2 class="mybooking-campers_widget-title">',
        'after_title'   => '</h2>',
    ) );
}
add_action( 'widgets_init', 'mybooking_campers_sidebars' );
