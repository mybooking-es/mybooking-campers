<?php
/**
*		camperS LOOP PART
*  	---------------
*
* 	@version 0.0.1
*   @package WordPress
*   @subpackage Mybooking campers Plugin
*   @since 1.0.3
*
*   @see https://wordpress.stackexchange.com/a/232879
*/

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;


/**
 * Register shortcodes
 *
 */
function register_camper_shortcodes() {
  add_shortcode( 'mybooking_campers_loop', 'mybooking_campers_shortcode' );
}
add_action( 'init', 'register_camper_shortcodes' );


/**
 * campers shortcode callback
 *
 */
function mybooking_campers_shortcode() {

    ob_start();
    global $wp_query,
           $post;

    $campers_loop = new WP_Query( array(
        'posts_per_page'    => 6,
        'post_type'         => 'camper',
    ) );

    if( ! $campers_loop->have_posts() ) {
        return false;
    } ?>

    <div class="mb-shortcode mybooking-campers">
      <div class="mybooking-campers_grid">

        <?php while( $campers_loop->have_posts() ) {
            $campers_loop->the_post();
            include('templates/loop-part.php');
        } ?>

      </div>
    </div>

  <?php  wp_reset_postdata();
  return ob_get_clean();
}
