<?php
/**
*		camperS LOOP PART
*  	---------------
*
* 	@version 0.0.1
*   @package WordPress
*   @subpackage Mybooking campers Plugin
*   @since 1.0.3
*/

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
?>

<!-- Gets custom fields data -->
<?php
	$camper_details_brand = get_post_meta( $post->ID, 'camper-details-brand', true );
	$camper_details_model = get_post_meta( $post->ID, 'camper-details-model', true );
	$camper_details_price = get_post_meta( $post->ID, 'camper-details-price', true );
	$camper_details_places = get_post_meta( $post->ID, 'camper-details-places', true );
	$camper_details_beds = get_post_meta( $post->ID, 'camper-details-beds', true );
	$camper_details_license = get_post_meta( $post->ID, 'camper-details-license', true );
	$camper_details_shower = get_post_meta( $post->ID, 'camper-details-shower', true );
	$camper_details_pets = get_post_meta( $post->ID, 'camper-details-pets', true );
	$camper_details_toilet = get_post_meta( $post->ID, 'camper-details-toilet', true );
	$camper_details_solar_panels = get_post_meta( $post->ID, 'camper-details-solar-panels', true );
?>

<article class="mybooking-campers_grid-item" id="post-<?php the_ID(); ?>">
  <?php $mybooking_permalink = get_permalink(); ?>

  <!-- Card content -->
  <div class="mybooking-campers_card">

    <div class="mybooking-campers_card-image">
      <div class="mybooking-campers_card-image-container">
        <?php the_post_thumbnail(); ?>
      </div>
    </div>

    <div class="mybooking-campers_card-body">

      <!-- Categories -->

      <?php if ( get_post_type( get_the_ID() ) == 'camper' ) { ?>
        <?php $camper_taxonomy = get_the_terms( get_the_ID(), 'campers' ); ?>
        <?php if ( isset( $camper_taxonomy ) && !empty( $camper_taxonomy ) ) { ?>
          <div class="mybooking-campers_card-category">
            <?php foreach ( $camper_taxonomy as $camper_tax ) { ?>
              <span class="mybooking-campers_card-category-item"><?php echo esc_html( $camper_tax->name ); ?></span>
            <?php } ?>
          </div>
        <?php } ?>
      <?php }?>


      <?php if ( $camper_details_brand !='' || $camper_details_model !='' ) {  ?>
        <div class="mybooking-campers_card-title">
          <?php echo esc_html( $camper_details_brand ) ?> <?php echo esc_html( $camper_details_model ) ?>
        </div>
      <?php } ?>

      <?php if ( $camper_details_price !='' ) {  ?>
        <div class="mybooking-campers_card-price">
          <?php echo esc_html( $camper_details_price ) ?> €
        </div>
      <?php } ?>

      <!-- Details -->
      <div class="mybooking-campers_details">
        <?php if ( $camper_details_places !='' ) {  ?>
          <span class="mybooking-campers_characteristic">
            <img class="mybooking-campers_characteristic-icon" src="<?php echo plugin_dir_url( dirname( __FILE__ ) ) . 'assets/icons/places.svg'; ?>">
            <?php echo esc_html( $camper_details_places ) ?>
          </span>
        <?php } ?>

        <?php if ( $camper_details_beds !='' ) {  ?>
          <span class="mybooking-campers_characteristic">
            <img class="mybooking-campers_characteristic-icon" src="<?php echo plugin_dir_url( dirname( __FILE__ ) ) . 'assets/icons/beds.svg'; ?>">
            <?php echo esc_html( $camper_details_beds ) ?>
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

        <?php if ( $camper_details_pets == 'yes' ) {  ?>
          <span class="mybooking-campers_characteristic">
            <img class="mybooking-campers_characteristic-icon" src="<?php echo plugin_dir_url( dirname( __FILE__ ) ) . 'assets/icons/pets.svg'; ?>">
            <?php echo esc_html_x( 'Yes', 'camper-single', 'mybooking-campers' ) ?>
          </span>
        <?php } ?>

        <?php if ( $camper_details_solar_panels == 'yes' ) {  ?>
          <span class="mybooking-campers_characteristic">
            <img class="mybooking-campers_characteristic-icon" src="<?php echo plugin_dir_url( dirname( __FILE__ ) ) . 'assets/icons/solar-panels.svg'; ?>">
            <?php echo esc_html_x( 'Yes', 'camper-single', 'mybooking-campers' ) ?>
          </span>
        <?php } ?>
      </div>

      <!-- Read more -->
      <a class="button btn btn-choose-product mybooking-campers_btn-book" role="button" href="<?php the_permalink(); ?>"><?php echo esc_html_x('Details', 'renting_choose_product', 'mybooking-campers') ?></a>
    </div>
  </div>
</article>
