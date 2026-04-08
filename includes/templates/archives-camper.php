<?php
/**
*		CAMPERS ARCHIVE
*  	-------------
*
* 	@version 0.0.4
*   @package WordPress
*   @subpackage Mybooking Campers Plugin
*   @since 1.0.0
*/

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header(); ?>

<div class="page_content mybooking-campers">
	<div class="mb-container">

		<!-- Breadcrumb -->
		<?php echo sea_rent_camper_breadcrumbs(); ?>

		<!-- Widgets top -->

		<?php if ( is_active_sidebar( 'sidebar-top' ) ) { ?>
			<div class="mybooking-campers_widget-area">
				 <?php dynamic_sidebar('sidebar-top'); ?>
			</div>
		<?php } ?>

		<!-- campers loop -->
		<div class="mybooking-campers_grid">

		<?php if ( have_posts() ) : ?>
		  <?php while ( have_posts() ) : the_post(); ?>

		    <?php include('loop-part.php'); ?>

		  <?php endwhile; ?>

		<!-- No content -->
		<?php else : ?>
		  <h3><?php echo esc_html_x( 'No content found. Please publish at least one camper to show something at here', 'blog_message', 'mybooking' ); ?></h3>
		<?php endif; ?>

	</div>

	<!-- Widgets bottom -->

	<?php if ( is_active_sidebar( 'sidebar-bottom' ) ) { ?>
		<div class="mybooking-campers_widget-area">
			 <?php dynamic_sidebar('sidebar-bottom'); ?>
		</div>
	<?php } ?>

	<!-- Pagination -->

	<?php
		the_posts_pagination( array(
			'mid_size'  => 2,
			'prev_text' => '&laquo;',
			'next_text' => '&raquo;',
		) );
	?>

	</div>
</div>

<?php get_footer();
