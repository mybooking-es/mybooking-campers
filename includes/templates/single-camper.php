<?php
/**
*		CAMPERS SINGLE
*  	------------
*
* 	@version 0.0.4
*   @package WordPress
*   @subpackage Mybooking Motorhomes Plugin
*   @since 1.0.0
*/

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header(); ?>

<!-- Gets custom fields data -->
<?php
 	$camper_details_gallery = get_post_meta( $post->ID, 'camper-details-gallery-data', true );
	if ( isset( $camper_details_gallery ) && !empty( $camper_details_gallery ) ) {
		$camper_details_photos_url_array = $camper_details_gallery['image_url'];
	}
	else {
		$camper_details_photos_url_array = [];
	}
	$camper_details_daily_distribution = get_post_meta( $post->ID, 'camper-details-daily-distribution', true );
	$camper_details_nightly_distribution = get_post_meta( $post->ID, 'camper-details-nightly-distribution', true );
	$camper_details_photos_count = sizeof($camper_details_photos_url_array);
	$camper_details_price = get_post_meta( $post->ID, 'camper-details-price', true );
	$camper_details_brand = get_post_meta( $post->ID, 'camper-details-brand', true );
	$camper_details_model = get_post_meta( $post->ID, 'camper-details-model', true );
	$camper_details_places = get_post_meta( $post->ID, 'camper-details-places', true );
	$camper_details_solar_panels = get_post_meta( $post->ID, 'camper-details-solar-panels', true );
	$camper_details_beds = get_post_meta( $post->ID, 'camper-details-beds', true );
	$camper_details_license = get_post_meta( $post->ID, 'camper-details-license', true );
	$camper_details_lenght = get_post_meta( $post->ID, 'camper-details-lenght', true );
	$camper_details_width = get_post_meta( $post->ID, 'camper-details-width', true );
	$camper_details_height = get_post_meta( $post->ID, 'camper-details-height', true );
	$camper_details_year = get_post_meta( $post->ID, 'camper-details-year', true );
	$camper_details_plate = get_post_meta( $post->ID, 'camper-details-plate', true );
	$camper_details_fuel = get_post_meta( $post->ID, 'camper-details-fuel', true );
	$camper_details_engine = get_post_meta( $post->ID, 'camper-details-engine', true );
	$camper_details_gear = get_post_meta( $post->ID, 'camper-details-gear', true );
	$camper_details_power = get_post_meta( $post->ID, 'camper-details-power', true );
	$camper_details_conditioned = get_post_meta( $post->ID, 'camper-details-conditioned', true );
	$camper_details_shower = get_post_meta( $post->ID, 'camper-details-shower', true );
	$camper_details_hob = get_post_meta( $post->ID, 'camper-details-hob', true );
	$camper_details_sink = get_post_meta( $post->ID, 'camper-details-sink', true );
	$camper_details_toilet = get_post_meta( $post->ID, 'camper-details-toilet', true );
	$camper_details_tv = get_post_meta( $post->ID, 'camper-details-tv', true );
	$camper_details_isofix = get_post_meta( $post->ID, 'camper-details-isofix', true );
	$camper_details_awning = get_post_meta( $post->ID, 'camper-details-awning', true );
	$camper_details_rear_camera = get_post_meta( $post->ID, 'camper-details-rear-camera', true );
	$camper_details_pets = get_post_meta( $post->ID, 'camper-details-pets', true );
	$camper_details_id = get_post_meta( $post->ID, 'camper-details-id', true );
	$camper_details_video = get_post_meta( $post->ID, 'camper-details-video', true );
?>

<div class="mybooking-campers_single-content">
	<?php while ( have_posts() ) : the_post(); ?>

    <article <?php post_class(); ?> id="post-<?php the_ID(); ?>">
    	<div class="post_content mybooking-campers mybooking-campers_post">
    		<div class="mb-container" tabindex="-1">

					<!-- The header -->

					<div class="mb-row">
						<div class="mb-col-md-12">
							<?php echo sea_rent_camper_breadcrumbs(); ?>
							<?php if ( empty( get_the_title() ) ) { ?>

								<!-- The product no name -->
								<h1 class="mybooking-campers_post-header untitled">
									<?php echo esc_html_x('Untitled', 'content_blog', 'mybooking'); ?>
								</h1>

							<?php } else { ?>

								<!-- The product name -->
								<h1 class="mybooking-campers_post-header">
									<?php the_title(); ?>

                  <!-- The price -->
                  <span>
                    <?php if ( $camper_details_price !='' ) {  ?>
                      <div class="mybooking-campers_price">
                        <?php echo esc_html( $camper_details_price ) ?> €
                      </div>
                    <?php } ?>
                  </span>
								</h1>
							<?php } ?>

							<div class="mybooking-campers_post-subheader">

								<!-- The characteristics -->
								<div class="mybooking-campers_details">
									<?php if ( $camper_details_places !='' ) {  ?>
										<span class="mybooking-campers_characteristic">
											<img class="mybooking-campers_characteristic-icon" src="<?php echo plugin_dir_url( dirname( __FILE__ ) ) . 'assets/icons/places.svg'; ?>">
											<?php echo esc_html( $camper_details_places ) ?> pax
										</span>
									<?php } ?>

									<?php if ( $camper_details_beds !='' ) {  ?>
										<span class="mybooking-campers_characteristic">
											<img class="mybooking-campers_characteristic-icon" src="<?php echo plugin_dir_url( dirname( __FILE__ ) ) . 'assets/icons/beds.svg'; ?>">
											<?php echo esc_html( $camper_details_beds ) ?> pax
										</span>
									<?php } ?>

                  <?php if ( $camper_details_toilet == 'yes' ) {  ?>
										<span class="mybooking-campers_characteristic">
											<img class="mybooking-campers_characteristic-icon" src="<?php echo plugin_dir_url( dirname( __FILE__ ) ) . 'assets/icons/wc.svg'; ?>">
											<?php echo esc_html_x( 'Yes', 'camper-single', 'mybooking-campers' ) ?>
										</span>
									<?php } ?>

                  <?php if ( $camper_details_shower == 'yes' ) {  ?>
                    <span class="mybooking-campers_characteristic">
                      <img class="mybooking-campers_characteristic-icon" src="<?php echo plugin_dir_url( dirname( __FILE__ ) ) . 'assets/icons/shower.svg'; ?>">
                      <?php echo esc_html_x( 'Interior', 'camper-single', 'mybooking-campers' ) ?>
                    </span>
                  <?php } ?>

                  <?php if ( $camper_details_license !='' ) {  ?>
        						<span class="mybooking-campers_characteristic">
        							<img class="mybooking-campers_characteristic-icon" src="<?php echo plugin_dir_url( dirname( __FILE__ ) ) . 'assets/icons/driving_license.svg'; ?>">
        							<?php echo esc_html( $camper_details_license ) ?>
        						</span>
        					<?php } ?>

                  <?php if ( $camper_details_solar_panels == 'yes' ) {  ?>
                    <span class="mybooking-campers_characteristic">
                      <img class="mybooking-campers_characteristic-icon" src="<?php echo plugin_dir_url( dirname( __FILE__ ) ) . 'assets/icons/solar-panels.svg'; ?>">
                      <?php echo esc_html_x( 'Yes', 'camper-single', 'mybooking-campers' ) ?>
                    </span>
                  <?php } ?>

        					<?php if ( $camper_details_pets == 'yes' ) {  ?>
        						<span class="mybooking-campers_characteristic">
        							<img class="mybooking-campers_characteristic-icon" src="<?php echo plugin_dir_url( dirname( __FILE__ ) ) . 'assets/icons/pets.svg'; ?>">
        							<?php echo esc_html_x( 'Yes', 'camper-single', 'mybooking-campers' ) ?>
        						</span>
        					<?php } ?>
        				</div>

                <!-- Category -->
                <div class="mybooking-campers_card-category">
                  <?php if ( get_post_type( get_the_ID() ) == 'camper' ) {
                    $camper_taxonomy = get_the_terms( get_the_ID(), 'campers' );
                    if ( isset( $camper_taxonomy ) && !empty( $camper_taxonomy ) ) {
                      foreach ( $camper_taxonomy as $camper_tax ) { ?>
                        <span class="mybooking-campers_card-category-item"><?php echo esc_html( $camper_tax->name ); ?></span>
                      <?php }
                    }
                  }?>
                </div>
							</div>
						</div>
					</div>
          <div class="mb-row">
						<!-- The body -->

						<div class="mb-col-md-8">

							<!-- The images -->
							<?php if( $camper_details_photos_count > 0 ) { ?>
								<div class="mybooking-campers_gallery-container">
									<!-- Main image -->
									<div class="mybooking-campers_main-image">
										<?php
											$camper_main_image = wp_get_attachment_image(
												$camper_details_photos_url_array[0],
												'full',
												false,
												['class' => 'mybooking-campers_carousel-img', 'alt' => get_the_title()]
											);
											echo wp_kses_post( $camper_main_image );
										?>
									</div>

									<!-- Thumbnails -->
									<?php if ( $camper_details_photos_count > 1 ) { ?>
										<div class="mybooking-campers_carousel">
											<?php for( $i=0; $i<$camper_details_photos_count; $i++ ) { ?>
												<div class="mybooking-campers_carousel-item">
													<?php
														$camper_thumbnail = wp_get_attachment_image(
															$camper_details_photos_url_array[$i],
															'medium',
															false,
															[
																'class' => 'mybooking-campers_carousel-thumbnail',
																'alt' => get_the_title(),
																'data-full-size' => wp_get_attachment_url( $camper_details_photos_url_array[$i] )
															]
														);
														echo wp_kses_post( $camper_thumbnail );
													?>
												</div>
											<?php } ?>
										</div>
									<?php } ?>
								</div>
							<?php } ?>

							<!-- The content -->
							<div class="mybooking-campers_entry-content entry-content">
								<?php the_content(); ?>
							</div>

              <!-- The video -->
              <?php if ( $camper_details_video !='' ) {  ?>
                <div class="mybooking-campers_video">
                  <?php echo wp_oembed_get( $camper_details_video ); ?>
                </div>
              <?php } ?>

              <!-- The distribution -->
              <div class="mb-col-md-12">
                <h2 class="mybooking-campers_section-title">
                  <?php echo esc_html_x( 'Distribution', 'camper-single', 'mybooking-campers' ) ?>
                </h2>

  							<div class="mb-col-md-6">
  								<?php if ( isset( $camper_details_daily_distribution ) ) { ?>
  									<?php
  											$camper_daily_distribution_photo = wp_get_attachment_image(
  												$camper_details_daily_distribution,
  												'full',
  												false,
  												['src', 'alt', 'class' => 'mybooking-campers_carousel-img']
  											);
  											echo wp_kses_post( $camper_daily_distribution_photo )
  										?>
  								<?php } ?>
  							</div>

  							<div class="mb-col-md-6">
  								<?php if ( isset( $camper_details_nightly_distribution ) ) { ?>
  									<?php
  											$camper_nightly_distribution_photo = wp_get_attachment_image(
  												$camper_details_nightly_distribution,
  												'full',
  												false,
  												['src', 'alt', 'class' => 'mybooking-campers_carousel-img']
  											);
  											echo wp_kses_post( $camper_nightly_distribution_photo )
  										?>
  								<?php } ?>
  							</div>

              </div>

							<!-- Extras -->
              <div class="mb-col-md-12">
                <h2 class="mybooking-campers_section-title">
                  <?php echo esc_html_x( 'Extras', 'camper-single', 'mybooking-campers' ) ?>
                </h2>

								<div class="mybooking-campers_details-list mb-list has-separator">
										<?php if ( $camper_details_conditioned == 'yes' ) {  ?>
											<span class="mb-list-item">
												<?php echo esc_html_x( 'Air conditioning', 'camper-single', 'mybooking-campers' ) ?>
												<?php if ( $camper_details_conditioned == 'yes' ) {  ?>
													<span class="dashicons dashicons-yes"></span>
												<?php } else { ?>
												  <span class="dashicons dashicons-no"></span>
												<?php } ?>
											</span>
										<?php } ?>

										<?php if ( $camper_details_shower == 'yes' ) {  ?>
											<span class="mb-list-item">
												<?php echo esc_html_x( 'Shower', 'camper-single', 'mybooking-campers' ) ?>
												<?php if ( $camper_details_shower == 'yes' ) {  ?>
													<span class="dashicons dashicons-yes"></span>
												<?php } else { ?>
												  <span class="dashicons dashicons-no"></span>
												<?php } ?>
											</span>
										<?php } ?>

										<?php if ( $camper_details_hob == 'yes' ) {  ?>
											<span class="mb-list-item">
												<?php echo esc_html_x( 'Hob', 'camper-single', 'mybooking-campers' ) ?>
												<?php if ( $camper_details_hob == 'yes' ) {  ?>
													<span class="dashicons dashicons-yes"></span>
												<?php } else { ?>
												  <span class="dashicons dashicons-no"></span>
												<?php } ?>
											</span>
										<?php } ?>

										<?php if ( $camper_details_sink == 'yes' ) {  ?>
											<span class="mb-list-item">
												<?php echo esc_html_x( 'Sink', 'camper-single', 'mybooking-campers' ) ?>
												<?php if ( $camper_details_sink == 'yes' ) {  ?>
													<span class="dashicons dashicons-yes"></span>
												<?php } else { ?>
												  <span class="dashicons dashicons-no"></span>
												<?php } ?>
											</span>
										<?php } ?>

										<?php if ( $camper_details_toilet == 'yes' ) {  ?>
											<span class="mb-list-item">
												<?php echo esc_html_x( 'Toilet', 'camper-single', 'mybooking-campers' ) ?>
												<?php if ( $camper_details_toilet == 'yes' ) {  ?>
													<span class="dashicons dashicons-yes"></span>
												<?php } else { ?>
												  <span class="dashicons dashicons-no"></span>
												<?php } ?>
											</span>
										<?php } ?>

										<?php if ( $camper_details_tv == 'yes' ) {  ?>
											<span class="mb-list-item">
												<?php echo esc_html_x( 'TV', 'camper-single', 'mybooking-campers' ) ?>
												<?php if ( $camper_details_tv == 'yes' ) {  ?>
													<span class="dashicons dashicons-yes"></span>
												<?php } else { ?>
												  <span class="dashicons dashicons-no"></span>
												<?php } ?>
											</span>
										<?php } ?>

										<?php if ( $camper_details_isofix == 'yes' ) {  ?>
											<span class="mb-list-item">
												<?php echo esc_html_x( 'ISOFIX', 'camper-single', 'mybooking-campers' ) ?>
												<?php if ( $camper_details_isofix == 'yes' ) {  ?>
													<span class="dashicons dashicons-yes"></span>
												<?php } else { ?>
												  <span class="dashicons dashicons-no"></span>
												<?php } ?>
											</span>
										<?php } ?>

										<?php if ( $camper_details_awning == 'yes' ) {  ?>
											<span class="mb-list-item">
												<?php echo esc_html_x( 'Awning', 'camper-single', 'mybooking-campers' ) ?>
												<?php if ( $camper_details_awning == 'yes' ) {  ?>
													<span class="dashicons dashicons-yes"></span>
												<?php } else { ?>
												  <span class="dashicons dashicons-no"></span>
												<?php } ?>
											</span>
										<?php } ?>

										<?php if ( $camper_details_rear_camera == 'yes' ) {  ?>
											<span class="mb-list-item">
												<?php echo esc_html_x( 'Rear camera', 'camper-single', 'mybooking-campers' ) ?>
												<?php if ( $camper_details_rear_camera == 'yes' ) {  ?>
													<span class="dashicons dashicons-yes"></span>
												<?php } else { ?>
												  <span class="dashicons dashicons-no"></span>
												<?php } ?>
											</span>
										<?php } ?>

								</div>
							</div>

							<!-- Details -->
							<div class="mb-col-md-12">
                <h2 class="mybooking-campers_section-title">
                  <?php echo esc_html_x( 'Details', 'camper-single', 'mybooking-campers' ) ?>
                </h2>

								<div class="mybooking-campers_details-list mb-list has-separator">
									<?php if ( $camper_details_lenght !='' ) {  ?>
										<span class="mb-list-item">
											<span><?php echo esc_html_x( 'Vehicle length', 'camper-single', 'mybooking-campers' ) ?></span>
											<?php echo esc_html( $camper_details_lenght ) ?>
										</span>
									<?php } ?>

									<?php if ( $camper_details_width !='' ) {  ?>
										<span class="mb-list-item">
											<span><?php echo esc_html_x( 'Vehicle width', 'camper-single', 'mybooking-campers' ) ?></span>
											<?php echo esc_html( $camper_details_width ) ?>
										</span>
									<?php } ?>

									<?php if ( $camper_details_height !='' ) {  ?>
					          <span class="mb-list-item">
					            <span><?php echo esc_html_x( 'Vehicle height', 'camper-single', 'mybooking-campers' ) ?></span>
					            <?php echo esc_html( $camper_details_height ) ?>
					          </span>
					        <?php } ?>

									<?php if ( $camper_details_year !='' ) {  ?>
										<span class="mb-list-item">
											<span><?php echo esc_html_x( 'Enrollement year', 'camper-single', 'mybooking-campers' ) ?></span>
											<?php echo esc_html( $camper_details_year ) ?>
										</span>
									<?php } ?>

									<?php if ( $camper_details_plate !='' ) {  ?>
										<span class="mb-list-item">
											<span><?php echo esc_html_x( 'Plate number', 'camper-single', 'mybooking-campers' ) ?></span>
											<?php echo esc_html( $camper_details_plate ) ?>
										</span>
									<?php } ?>

									<?php if ( $camper_details_fuel !='' ) {  ?>
										<span class="mb-list-item">
											<span><?php echo esc_html_x( 'Fuel type', 'camper-single', 'mybooking-campers' ) ?></span>
											<?php echo esc_html( $camper_details_fuel ) ?>
										</span>
									<?php } ?>

                  <?php if ( $camper_details_gear !='' ) {  ?>
										<span class="mb-list-item">
											<span><?php echo esc_html_x( 'Gear type', 'camper-single', 'mybooking-campers' ) ?></span>
											<?php echo esc_html( $camper_details_gear ) ?>
										</span>
									<?php } ?>

									<?php if ( $camper_details_engine !='' ) {  ?>
										<span class="mb-list-item">
											<span><?php echo esc_html_x( 'Engine power', 'camper-single', 'mybooking-campers' ) ?></span>
											<?php echo esc_html( $camper_details_engine ) ?>
										</span>
									<?php } ?>

									<?php if ( $camper_details_power !='' ) {  ?>
										<span class="mb-list-item">
											<span><?php echo esc_html_x( 'Power supply', 'camper-single', 'mybooking-campers' ) ?></span>
											<?php echo esc_html( $camper_details_power ) ?>
										</span>
									<?php } ?>
								</div>
							</div>
						</div>

						<!-- The sidebar -->

						<div class="mb-col-md-4">
							<div class="mybooking-campers_sidebar">

								<!-- Widgets -->
								<?php if ( is_active_sidebar( 'sidebar-post' ) ) { ?>
									<div class="mybooking-campers_single-widget-area">
										 <?php dynamic_sidebar( 'sidebar-post' ); ?>
									</div>
								<?php } ?>

                <h2 class="mybooking-campers_section-title">
                  <?php echo esc_html_x( 'Book online', 'camper-single', 'mybooking-campers' ) ?>
                </h2>

								<!-- Calendar or Form -->
								<?php if ( $camper_details_id !='' ) {  ?>
									<div class="mybooking-campers_product-form mb-card">
										<?php echo do_shortcode( '[mybooking_rent_engine_product code="' . $camper_details_id . '"]' ); ?>
									</div>
								<?php } ?>
								<!--
                <div class="mybooking-campers_product-calendar mb-sticky-container">
                  <h2 class="mybooking-campers_section-title">
                    <?php //echo esc_html_x( 'Contact', 'camper-single', 'mybooking-campers' ) ?>
                  </h2>
                  <?php //echo do_shortcode( '[mybooking_contact subject="'.esc_html(get_the_title()).'"]' ); ?>
                </div>-->
							</div>
						</div>
					</div>

    			<div class="mb-row">
    				<div class="mb-col-md-12">

							<!-- Link pages -->
          		<?php
          		wp_link_pages(
          			array(
          				'before' => '<div class="mybooking-entry-links">' . esc_html_x( 'Pages', 'pages_navigation', 'mybooking' ),
          				'after'  => '</div>',
          			)
          		);
          		?>

							<!-- Footer -->
    					<footer class="entry-footer">
    						<?php
    						   if (function_exists('mybooking_entry_footer') ):
    						     mybooking_entry_footer();
    						   endif;
    						?>
    					</footer>
    				</div>
    			</div>
    		</div>

    		<!-- Posts navigation -->
    		<?php
    		  if (function_exists('mybooking_post_nav') ):
    		     mybooking_post_nav();
    		  endif; ?>
    	</div>
    </article>

		<?php
		// If comments are open or we have at least one comment, load up the comment template.
		if ( comments_open() || get_comments_number() ) :
			comments_template();
		endif;
		?>

	<?php endwhile; ?>
</div>

<?php get_footer();
