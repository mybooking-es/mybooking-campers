<?php
/**
 * Register meta boxes for Motorhome Custom Post Type
 *
 * @since 1.0.1
 */

  /* Add metabox
  */
  function add_camper_metabox() {

    $screens = [ 'camper' ];
    foreach ( $screens as $screen ) {
      add_meta_box(
        'camper-details',                                                   // Unique ID
        _x( 'Motorhome Details', 'camper-metabox', 'mybooking-campers' ),   // Box title
        'camper_deatils_box',                                               // Content callback, must be of type callable
        $screen,                                                            // Post type
        'normal',                                                           // Position; normal, advanced or side (CHANGED to normal because advanced duplicates gallery fields)
        'core',                                                             // Priority
      );
    }

  }

  /* Fields editor
  */
  function camper_deatils_box( $camper_data ) {

      // Gallery data
      $camper_gallery_data = get_post_meta( $camper_data->ID, 'camper-details-gallery-data', true );
      ?>

      <table class="form-table">
        <tbody>
          <tr>
            <th scope="row">
              <label><?php echo esc_html_x( 'Image gallery', 'camper-single', 'mybooking-campers' ) ?></label>
            </th>
            <td style="width: 45%;">
              <div class="gallery_wrapper">
                <div id="img_box_container">
                  <?php
                    if ( isset( $camper_gallery_data['image_url'] ) ){
                      for( $i = 0; $i < count( $camper_gallery_data['image_url'] ); $i++ ){
                        $camper_gallery_item_src =  wp_get_attachment_image_src($camper_gallery_data['image_url'][$i],
                                                                                'medium'
                                                                                );
                        if (!empty($camper_gallery_item_src)) {
                      ?>
                        <div class="gallery_single_row dolu">
                          <div class="gallery_area image_container ">
                            <img class="gallery_img_img" src="<?php esc_html_e( $camper_gallery_item_src[0] ); ?>" height="55" width="55" onclick="open_media_uploader_image_this(this)"/>
                            <input type="hidden"
                                class="meta_image_url"
                                name="camper-details-gallery[image_url][]"
                                value="<?php esc_html_e( $camper_gallery_data['image_url'][$i] ); ?>"
                              />
                          </div>
                          <div class="gallery_area">
                            <span class="button remove" onclick="remove_img(this)" title="Remove"/><i class="dashicons dashicons-trash"></i></span>
                          </div>
                          <div class="clear">
                          </div>
                        </div>
                      <?php
                        }
                      }
                    }
                  ?>
                </div>
                <!-- Prepare new image -->
                <div style="display:none" id="master_box">
                  <div class="gallery_single_row">
                    <div class="gallery_area image_container" onclick="open_media_uploader_image(this)">
                      <input class="meta_image_url" value="" type="hidden" name="camper-details-gallery[image_url][]" />
                    </div>
                    <div class="gallery_area">
                      <span class="button remove" onclick="remove_img(this)" title="Remove"/><i class="dashicons dashicons-trash"></i></span>
                    </div>
                    <div class="clear"></div>
                  </div>
                </div>
                <div id="add_gallery_single_row">
                  <button class="button add" type="button" onclick="open_media_uploader_image_plus();" title="Add image"/>
                    +
                  </button>
                </div>
              </div>
            </td>
            <td style="width: 45%;">
              <p class="description"><?php echo esc_html_x( 'Add multiple images from your media library to create a carousel. Click and drag to change the order.', 'camper-single', 'mybooking-campers' ) ?></p>
            </td>
          </tr>
        </tbody>
      </table>


    <?php
       // Daily distribution
       $camper_daily_distribution = get_post_meta( $camper_data->ID, 'camper-details-daily-distribution', true );
       $camper_daily_distribution_src = null;
       if ( isset( $camper_daily_distribution ) ) {
        $camper_daily_distribution_src =  wp_get_attachment_image_src( $camper_daily_distribution,'medium' );
      }
    ?>
      <table class="form-table">
        <tbody>
          <tr>
            <th scope="row">
              <label for="camper-details-daily-distribution"><?php echo esc_html_x( 'Daily distribution image', 'camper-single', 'mybooking-campers' ) ?></label>
            </th>
            <td style="width: 45%;">
              <div class="gallery_wrapper">
                <div class="gallery_single_row dolu">
                  <div class="gallery_area image_container camper-image">
                    <img id="camper-details-daily-distribution-img"
                        class="gallery_img_img"
                          <?php if ( empty( $camper_daily_distribution_src ) ) { ?>
                            style="display: none"
                          <?php } else { ?>
                            src="<?php esc_html_e( $camper_daily_distribution_src[0] ); ?>"
                          <?php } ?>
                            height="120" width="120"
                            onclick="open_media_uploader_single_image('#camper-details-daily-distribution-img',
                                                                      '#camper-details-daily-distribution',
                                                                      '#camper-details-daily-distribution-button',
                                                                      '#camper-details-daily-distribution-remove-button' );"/>
                  </div>
                  <div class="gallery_area">
                    <span class="button remove" id="camper-details-daily-distribution-remove-button"
                          <?php if ( empty( $camper_daily_distribution_src ) ) { ?>
                            style="display: none"
                          <?php } ?>
                          title="Remove"
                          onclick="remove_single_image('#camper-details-daily-distribution-img', '#camper-details-daily-distribution', '#camper-details-daily-distribution-button', '#camper-details-daily-distribution-remove-button' );"/><i class="dashicons dashicons-trash"></i></span>
                  </div>
                  <div class="clear"></div>
                </div>
                <input
                    type="hidden"
                    name="camper-details-daily-distribution"
                    <?php if ( isset( $camper_daily_distribution ) ) { ?>
                      value="<?php echo esc_attr( $camper_daily_distribution ); ?>"
                    <?php } ?>
                    id="camper-details-daily-distribution"
                    class="components-text-control__input">

                <button type="button add"
                          class="button add"
                          id="camper-details-daily-distribution-button"
                          <?php if ( !empty( $camper_daily_distribution_src ) ) { ?>
                            style="display: none"
                          <?php } ?>
                          onclick="open_media_uploader_single_image('#camper-details-daily-distribution-img', 
                                                                    '#camper-details-daily-distribution', 
                                                                    '#camper-details-daily-distribution-button', 
                                                                    '#camper-details-daily-distribution-remove-button' );">+</button>
              </div>
            </td>
            <td style="width: 45%;">
              <p class="description"><?php echo esc_html_x( 'Set the daily distribution image.', 'camper-single', 'mybooking-campers' ) ?></p>
            </td>
          </tr>
        </tbody>
      </table>

    <?php
      // Nightly distribution
      $camper_nightly_distribution = get_post_meta( $camper_data->ID, 'camper-details-nightly-distribution', true );
      $camper_nightly_distribution_src = null;
      if ( isset( $camper_nightly_distribution ) ) {
        $camper_nightly_distribution_src =  wp_get_attachment_image_src( $camper_nightly_distribution,'medium' );
      }
    ?>
      <table class="form-table">
        <tbody>
          <tr>
            <th scope="row">
              <label for="camper-details-nightly-distribution"><?php echo esc_html_x( 'Nightly distribution image', 'camper-single', 'mybooking-campers' ) ?></label>
            </th>
            <td style="width: 45%;">
              <div class="gallery_wrapper">
                <div class="gallery_single_row">
                  <div class="gallery_area image_container camper-image">
                    <img id="camper-details-nightly-distribution-img"
                        class="gallery_img_img"
                          <?php if ( empty( $camper_nightly_distribution_src ) ) { ?>
                            style="display: none"
                          <?php } else { ?>
                            src="<?php esc_html_e( $camper_nightly_distribution_src[0] ); ?>"
                          <?php } ?>
                            height="120" width="120"
                            onclick="open_media_uploader_single_image('#camper-details-nightly-distribution-img',
                                                                      '#camper-details-nightly-distribution',
                                                                      '#camper-details-nightly-distribution-button',
                                                                      '#camper-details-nightly-distribution-remove-button' );"/>
                  </div>
                  <div class="gallery_area">
                    <span class="button remove" id="camper-details-nightly-distribution-remove-button"
                          <?php if ( empty( $camper_nightly_distribution_src ) ) { ?>
                            style="display: none"
                          <?php } ?>
                          onclick="remove_single_image('#camper-details-nightly-distribution-img', '#camper-details-nightly-distribution', '#camper-details-nightly-distribution-button', '#camper-details-nightly-distribution-remove-button' );"
                          title="Remove"/><i class="dashicons dashicons-trash"></i></span>
                  </div>
                  <div class="clear"></div>
                </div>
                <input
                    type="hidden"
                    name="camper-details-nightly-distribution"
                    <?php if ( isset( $camper_nightly_distribution ) ) { ?>
                      value="<?php echo esc_attr( $camper_nightly_distribution ); ?>"
                    <?php } ?>
                    id="camper-details-nightly-distribution"
                    class="components-text-control__input">
                <button type="button add"
                        class="button add"
                        <?php if ( !empty( $camper_nightly_distribution_src ) ) { ?>
                            style="display: none"
                        <?php } ?>
                        id="camper-details-nightly-distribution-button"
                        onclick="open_media_uploader_single_image('#camper-details-nightly-distribution-img', '#camper-details-nightly-distribution', '#camper-details-nightly-distribution-button', '#camper-details-nightly-distribution-remove-button' );">
                        +
                    </button>
              </div>
            </td>
            <td style="width: 45%;">
              <p class="description"><?php echo esc_html_x( 'Set the nightly distribution image.', 'camper-single', 'mybooking-campers' ) ?></p>
            </td>
          </tr>
        </tbody>
      </table>


    <?php
      // Price field
      $camper_details_price = get_post_meta( $camper_data->ID, 'camper-details-price', true );
      ?>
      <table class="form-table">
      <tbody>
        <tr>
          <th scope="row">
            <label for="camper-details-price"><?php echo esc_html_x( 'Renting or selling price', 'camper-single', 'mybooking-campers' ) ?></label>
          </th>
          <td style="width: 45%;">
            <input
              type="text"
              size="10"
              name="camper-details-price"
              value="<?php echo esc_attr( $camper_details_price ); ?>"
              id="camper-details-price"
              class="components-text-control__input">
          </td>
          <td style="width: 45%;">
            <p class="description"><?php echo esc_html_x( 'Set an ammount for selling or renting this item. Leave empty for no price.', 'camper-single', 'mybooking-campers' ) ?></p>
          </td>
        </tr>
      </table>
    <?php

    // Brand field
    $camper_details_brand = get_post_meta( $camper_data->ID, 'camper-details-brand', true );
    ?>
      <table class="form-table">
      <tbody>
        <tr>
          <th scope="row">
            <label for="camper-details-brand"><?php echo esc_html_x( 'Brand', 'camper-single', 'mybooking-campers' ) ?></label>
          </th>
          <td style="width: 45%;">
            <input
              type="text"
              size="25"
              name="camper-details-brand"
              value="<?php echo esc_attr( $camper_details_brand ); ?>"
              id="camper-details-brand"
              class="components-text-control__input">
          </td>
          <td style="width: 45%;"></td>
        </tr>
      </table>
    <?php

    // Model field
    $camper_details_model = get_post_meta( $camper_data->ID, 'camper-details-model', true );
    ?>
      <table class="form-table">
      <tbody>
        <tr>
          <th scope="row">
            <label for="camper-details-model"><?php echo esc_html_x( 'Model', 'camper-single', 'mybooking-campers' ) ?></label>
          </th>
          <td style="width: 45%;">
            <input
              type="text"
              size="25"
              name="camper-details-model"
              value="<?php echo esc_attr( $camper_details_model ); ?>"
              id="camper-details-model"
              class="components-text-control__input">
          </td>
          <td style="width: 45%;"></td>
        </tr>
      </table>
    <?php

    // Places field
    $camper_details_places = get_post_meta( $camper_data->ID, 'camper-details-places', true );
    ?>
      <table class="form-table">
      <tbody>
        <tr>
          <th scope="row">
            <label for="camper-details-places"><?php echo esc_html_x( 'Places', 'camper-single', 'mybooking-campers' ) ?></label>
          </th>
          <td style="width: 45%;">
            <input
              type="number"
              size="10"
              name="camper-details-places"
              value="<?php echo esc_attr( $camper_details_places ); ?>"
              id="camper-details-places"
              class="components-text-control__input">
          </td>
          <td style="width: 45%;">
            <p class="description"><?php echo esc_html_x( 'Number of sitting places.', 'camper-single', 'mybooking-campers' ) ?></p>
          </td>
        </tr>
      </table>
    <?php

    // Beds field
    $camper_details_beds = get_post_meta( $camper_data->ID, 'camper-details-beds', true );
    ?>
      <table class="form-table">
      <tbody>
        <tr>
          <th scope="row">
            <label for="camper-details-beds"><?php echo esc_html_x( 'Beds', 'camper-single', 'mybooking-campers' ) ?></label>
          </th>
          <td style="width: 45%;">
            <input
              type="number"
              size="10"
              name="camper-details-beds"
              value="<?php echo esc_attr( $camper_details_beds ); ?>"
              id="camper-details-beds"
              class="components-text-control__input">
          </td>
          <td style="width: 45%;">
            <p class="description"><?php echo esc_html_x( 'Number of sleeping places.', 'camper-single', 'mybooking-campers' ) ?></p>
          </td>
        </tr>
      </table>
    <?php

    // License field
    $camper_details_license = get_post_meta( $camper_data->ID, 'camper-details-license', true );
    ?>
      <table class="form-table">
      <tbody>
        <tr>
          <th scope="row">
            <label for="camper-details-license"><?php echo esc_html_x( 'License', 'camper-single', 'mybooking-campers' ) ?></label>
          </th>
          <td style="width: 45%;">
            <input
              type="text"
              size="25"
              name="camper-details-license"
              value="<?php echo esc_attr( $camper_details_license ); ?>"
              id="camper-details-license"
              class="components-text-control__input">
          </td>
          <td style="width: 45%;">
            <p class="description"><?php echo esc_html_x( 'Type of driving license required for this van.', 'camper-single', 'mybooking-campers' ) ?></p>
          </td>
        </tr>
      </table>
    <?php

    // Lenght field
    $camper_details_lenght = get_post_meta( $camper_data->ID, 'camper-details-lenght', true );
    ?>
      <table class="form-table">
      <tbody>
        <tr>
          <th scope="row">
            <label for="camper-details-lenght"><?php echo esc_html_x( 'Lenght', 'camper-single', 'mybooking-campers' ) ?></label>
          </th>
          <td style="width: 45%;">
            <input
              type="text"
              size="10"
              name="camper-details-lenght"
              value="<?php echo esc_attr( $camper_details_lenght ); ?>"
              id="camper-details-lenght"
              class="components-text-control__input"
              placeholder="Ex: 5,2 mts">
          </td>
          <td style="width: 45%;">
            <p class="description"><?php echo esc_html_x( 'Meassures front to rear in mts.', 'camper-single', 'mybooking-campers' ) ?></p>
          </td>
        </tr>
      </table>
    <?php

    // Width field
    $camper_details_width = get_post_meta( $camper_data->ID, 'camper-details-width', true );
    ?>
      <table class="form-table">
      <tbody>
        <tr>
          <th scope="row">
            <label for="camper-details-width"><?php echo esc_html_x( 'Width', 'camper-single', 'mybooking-campers' ) ?></label>
          </th>
          <td style="width: 45%;">
            <input
              type="text"
              size="10"
              name="camper-details-width"
              value="<?php echo esc_attr( $camper_details_width ); ?>"
              id="camper-details-width"
              class="components-text-control__input">
          </td>
          <td style="width: 45%;">
            <p class="description"><?php echo esc_html_x( 'Meassures side to side in mts.', 'camper-single', 'mybooking-campers' ) ?></p>
          </td>
        </tr>
      </table>
    <?php

    // Height field
    $camper_details_height = get_post_meta( $camper_data->ID, 'camper-details-height', true );
    ?>
      <table class="form-table">
      <tbody>
        <tr>
          <th scope="row">
            <label for="camper-details-height"><?php echo esc_html_x( 'Height', 'camper-single', 'mybooking-campers' ) ?></label>
          </th>
          <td style="width: 45%;">
            <input
              type="text"
              size="50"
              name="camper-details-height"
              value="<?php echo esc_attr( $camper_details_height ); ?>"
              id="camper-details-height"
              class="components-text-control__input">
          </td>
          <td style="width: 45%;">
            <p class="description"><?php echo esc_html_x( 'Meassures floor to top in mts.', 'camper-single', 'mybooking-campers' ) ?></p>
          </td>
        </tr>
      </table>
    <?php

    // Year field
    $camper_details_year = get_post_meta( $camper_data->ID, 'camper-details-year', true );
    ?>
      <table class="form-table">
      <tbody>
        <tr>
          <th scope="row">
            <label for="camper-details-year"><?php echo esc_html_x( 'Year', 'camper-single', 'mybooking-campers' ) ?></label>
          </th>
          <td style="width: 45%;">
            <input
              type="text"
              size="10"
              name="camper-details-year"
              value="<?php echo esc_attr( $camper_details_year ); ?>"
              id="camper-details-year"
              class="components-text-control__input">
              <td style="width: 45%;">
                <p class="description"><?php echo esc_html_x( 'Enrollement year of the vehicle.', 'camper-single', 'mybooking-campers' ) ?></p>
              </td>
          </td>
        </tr>
      </table>
    <?php

    // Plate field
    $camper_details_plate = get_post_meta( $camper_data->ID, 'camper-details-plate', true );
    ?>
      <table class="form-table">
      <tbody>
        <tr>
          <th scope="row">
            <label for="camper-details-plate"><?php echo esc_html_x( 'Plate', 'camper-single', 'mybooking-campers' ) ?></label>
          </th>
          <td style="width: 45%;">
            <input
              type="text"
              size="10"
              name="camper-details-plate"
              value="<?php echo esc_attr( $camper_details_plate ); ?>"
              id="camper-details-plate"
              class="components-text-control__input">
          </td>
          <td style="width: 45%;">
            <p class="description"><?php echo esc_html_x( 'Plate number, digits and letters.', 'camper-single', 'mybooking-campers' ) ?></p>
          </td>
        </tr>
      </table>
    <?php

    // Fuel type field
    $camper_details_fuel = get_post_meta( $camper_data->ID, 'camper-details-fuel', true );
    ?>
      <table class="form-table">
      <tbody>
        <tr>
          <th scope="row">
            <label for="camper-details-fuel"><?php echo esc_html_x( 'Fuel type', 'camper-single', 'mybooking-campers' ) ?></label>
          </th>
          <td style="width: 45%;">
            <input
              type="text"
              size="10"
              name="camper-details-fuel"
              value="<?php echo esc_attr( $camper_details_fuel ); ?>"
              id="camper-details-fuel"
              class="components-text-control__input">
          </td>
          <td style="width: 45%;">
            <p class="description"><?php echo esc_html_x( 'Could be Diesel / Benzine or Electric.', 'camper-single', 'mybooking-campers' ) ?></p>
          </td>
        </tr>
      </table>
    <?php

    // Engine field
    $camper_details_engine = get_post_meta( $camper_data->ID, 'camper-details-engine', true );
    ?>
      <table class="form-table">
      <tbody>
        <tr>
          <th scope="row">
            <label for="camper-details-engine"><?php echo esc_html_x( 'Engine', 'camper-single', 'mybooking-campers' ) ?></label>
          </th>
          <td style="width: 45%;">
            <input
              type="text"
              size="50"
              name="camper-details-engine"
              value="<?php echo esc_attr( $camper_details_engine ); ?>"
              id="camper-details-engine"
              class="components-text-control__input">
          </td>
          <td style="width: 45%;"></td>
        </tr>
      </table>
    <?php

    // Gear field
    $camper_details_gear = get_post_meta( $camper_data->ID, 'camper-details-gear', true );
    ?>
      <table class="form-table">
      <tbody>
        <tr>
          <th scope="row">
            <label for="camper-details-gear"><?php echo esc_html_x( 'Gear', 'camper-single', 'mybooking-campers' ) ?></label>
          </th>
          <td style="width: 45%;">
            <input
              type="text"
              size="50"
              name="camper-details-gear"
              value="<?php echo esc_attr( $camper_details_gear ); ?>"
              id="camper-details-gear"
              class="components-text-control__input">
          </td>
          <td style="width: 45%;"></td>
        </tr>
      </table>
    <?php

    // Power field
    $camper_details_power = get_post_meta( $camper_data->ID, 'camper-details-power', true );
    ?>
      <table class="form-table">
      <tbody>
        <tr>
          <th scope="row">
            <label for="camper-details-power"><?php echo esc_html_x( 'Power supply', 'camper-single', 'mybooking-campers' ) ?></label>
          </th>
          <td style="width: 45%;">
            <input
              type="text"
              size="50"
              name="camper-details-power"
              value="<?php echo esc_attr( $camper_details_power ); ?>"
              id="camper-details-power"
              class="components-text-control__input">
          </td>
          <td style="width: 45%;"></td>
        </tr>
      </table>

      <?php



      ?>
    <?php

    // Solar panels field
    $camper_details_solar_panels = get_post_meta( $camper_data->ID, 'camper-details-solar-panels', true );
    if( $camper_details_solar_panels == "yes") {
      $camper_details_solar_panels_checked = 'checked="checked"';
    } else {
      $camper_details_solar_panels_checked = '';
    }

    // Camper Extras
    $camper_details_pets = get_post_meta( $camper_data->ID, 'camper-details-pets', true );
    if( $camper_details_pets == "yes") {
      $camper_details_pets_checked = 'checked="checked"';
    } else {
      $camper_details_pets_checked = '';
    }

    $camper_details_conditioned = get_post_meta( $camper_data->ID, 'camper-details-conditioned', true );
    if( $camper_details_conditioned == "yes") {
      $camper_details_conditioned_checked = 'checked="checked"';
    } else {
      $camper_details_conditioned_checked = '';
    }

    $camper_details_shower = get_post_meta( $camper_data->ID, 'camper-details-shower', true );
    if( $camper_details_shower == true ) {
      $camper_details_shower_checked = 'checked="checked"';
    }
    else {
      $camper_details_shower_checked = '';
    }

    $camper_details_hob = get_post_meta( $camper_data->ID, 'camper-details-hob', true );
    if( $camper_details_hob == "yes") {
      $camper_details_hob_checked = 'checked="checked"';
    } else {
      $camper_details_hob_checked = '';
    }

    $camper_details_sink = get_post_meta( $camper_data->ID, 'camper-details-sink', true );
    if( $camper_details_sink == "yes") {
      $camper_details_sink_checked = 'checked="checked"';
    } else {
      $camper_details_sink_checked = '';
    }

    $camper_details_toilet = get_post_meta( $camper_data->ID, 'camper-details-toilet', true );
    if( $camper_details_toilet == "yes") {
      $camper_details_toilet_checked = 'checked="checked"';
    } else {
      $camper_details_toilet_checked = '';
    }

    $camper_details_tv = get_post_meta( $camper_data->ID, 'camper-details-tv', true );
    if( $camper_details_tv == "yes") {
      $camper_details_tv_checked = 'checked="checked"';
    } else {
      $camper_details_tv_checked = '';
    }

    $camper_details_isofix = get_post_meta( $camper_data->ID, 'camper-details-isofix', true );
    if( $camper_details_isofix == "yes") {
      $camper_details_isofix_checked = 'checked="checked"';
    } else {
      $camper_details_isofix_checked = '';
    }

    $camper_details_awning = get_post_meta( $camper_data->ID, 'camper-details-awning', true );
    if( $camper_details_awning == "yes") {
      $camper_details_awning_checked = 'checked="checked"';
    } else {
      $camper_details_awning_checked = '';
    }

    $camper_details_rear_camera = get_post_meta( $camper_data->ID, 'camper-details-rear-camera', true );
    if( $camper_details_rear_camera == "yes") {
      $camper_details_rear_camera_checked = 'checked="checked"';
    } else {
      $camper_details_rear_camera_checked = '';
    }

    ?>
      <table class="form-table">
      <tbody>
        <tr>
          <th scope="row">
            <label>Extras</label>
          </th>
          <td style="width: 90%;">
            <label style="margin-right: 20px;" for="camper-details-solar-panels">
            <input
              type="checkbox"
              name="camper-details-solar-panels"
              value="yes" <?php echo $camper_details_solar_panels_checked; ?>
              id="camper-details-solar-panels"
              class="components-text-control__input">
            <?php echo esc_html_x( 'Solar panels', 'camper-single', 'mybooking-campers' ) ?></label>
            <label style="margin-right: 20px;" for="camper-details-pets">
            <input
              type="checkbox"
              name="camper-details-pets"
              value="yes" <?php echo $camper_details_pets_checked; ?>
              id="camper-details-pets"
              class="components-text-control__input">
              <?php echo esc_html_x( 'Pets allowed', 'camper-single', 'mybooking-campers' ) ?></label>
            <label style="margin-right: 20px;" for="camper-details-pets">
            <input
              type="checkbox"
              name="camper-details-conditioned"
              value="yes" <?php echo $camper_details_conditioned_checked; ?>
              id="camper-details-conditioned"
              class="components-text-control__input">
              <?php echo esc_html_x( 'Air conditioning', 'camper-single', 'mybooking-campers' ) ?></label>

            <label style="margin-right: 20px;" for="camper-details-shower">
            <input
              type="checkbox"
              name="camper-details-shower"
              value="Shower" <?php echo $camper_details_shower_checked; ?>
              id="camper-details-shower"
              class="components-text-control__input">
              <?php echo esc_html_x( 'Shower', 'camper-single', 'mybooking-campers' ) ?></label>

            <label style="margin-right: 20px;" for="camper-details-hob">
            <input
              type="checkbox"
              name="camper-details-hob"
              value="Hob" <?php echo $camper_details_hob_checked; ?>
              id="camper-details-hob"
              class="components-text-control__input">
              <?php echo esc_html_x( 'Hob', 'camper-single', 'mybooking-campers' ) ?></label>

            <label style="margin-right: 20px;" for="camper-details-sink">
            <input
              type="checkbox"
              name="camper-details-sink"
              value="Sink" <?php echo $camper_details_sink_checked; ?>
              id="camper-details-sink"
              class="components-text-control__input">
              <?php echo esc_html_x( 'Sink', 'camper-single', 'mybooking-campers' ) ?></label>

            <label style="margin-right: 20px;" for="camper-details-toilet">
            <input
              type="checkbox"
              name="camper-details-toilet"
              value="Toilet" <?php echo $camper_details_toilet_checked; ?>
              id="camper-details-toilet"
              class="components-text-control__input">
              <?php echo esc_html_x( 'Toilet', 'camper-single', 'mybooking-campers' ) ?></label>

            <label style="margin-right: 20px;" for="camper-details-tv">
            <input
              type="checkbox"
              name="camper-details-tv"
              value="TV" <?php echo $camper_details_tv_checked; ?>
              id="camper-details-tv"
              class="components-text-control__input">
              <?php echo esc_html_x( 'TV', 'camper-single', 'mybooking-campers' ) ?></label>

            <label style="margin-right: 20px;" for="camper-details-isofix">
            <input
              type="checkbox"
              name="camper-details-isofix"
              value="yes" <?php echo $camper_details_isofix_checked; ?>
              id="camper-details-isofix"
              class="components-text-control__input">
              <?php echo esc_html_x( 'ISOFIX', 'camper-single', 'mybooking-campers' ) ?></label>

            <label style="margin-right: 20px;" for="camper-details-awning">
            <input
              type="checkbox"
              name="camper-details-awning"
              value="yes" <?php echo $camper_details_awning_checked; ?>
              id="camper-details-awning"
              class="components-text-control__input">
              <?php echo esc_html_x( 'Awning', 'camper-single', 'mybooking-campers' ) ?></label>

            <label style="margin-right: 20px;" for="camper-details-rear-camera">
            <input
              type="checkbox"
              name="camper-details-rear-camera"
              value="yes" <?php echo $camper_details_rear_camera_checked; ?>
              id="camper-details-rear-camera"
              class="components-text-control__input">
              <?php echo esc_html_x( 'Rear Camera', 'camper-single', 'mybooking-campers' ) ?></label>
          </td>
        </tr>
      </table>
    <?php

    // ID field
    $camper_details_id = get_post_meta( $camper_data->ID, 'camper-details-id', true );
    ?>
      <table class="form-table">
      <tbody>
        <tr>
          <th scope="row">
            <label for="camper-details-id"><?php echo esc_html_x( 'Camper ID', 'camper-single', 'mybooking-campers' ) ?></label>
          </th>
          <td style="width: 45%;">
            <input
              type="text"
              size="25"
              name="camper-details-id"
              value="<?php echo esc_attr( $camper_details_id ); ?>"
              id="camper-details-id"
              class="components-text-control__input">
          </td>
          <td style="width: 45%;">
            <p class="description"><?php echo _x( 'Paste here the ID of this camper if you want to show the booking calendar. Requires an active <a href="https://mybooking.es/registro/" title="Register your account" target="_blank">Mybooking account</a> and a properly set inventory.', 'camper-single', 'mybooking-campers' ) ?></p>
          </td>
        </tr>
      </table>
    <?php

    // Video URL
    $camper_details_video_url = get_post_meta( $camper_data->ID, 'camper-details-video', true );
    ?>
      <table class="form-table">
      <tbody>
        <tr>
          <th scope="row">
            <label for="camper-details-video"><?php echo esc_html_x( 'Youtube link', 'camper-single', 'mybooking-campers' ) ?></label>
          </th>
          <td style="width: 45%;">
            <input
              type="text"
              size="25"
              name="camper-details-video"
              value="<?php echo esc_attr( $camper_details_video_url ); ?>"
              id="camper-details-video"
              class="components-text-control__input">
          </td>
          <td style="width: 45%;">
            <p class="description"><?php echo _x( 'You can show any video on YouTube', 'camper-single', 'mybooking-campers' ) ?></p>
          </td>
        </tr>
      </table>
    <?php
  }


  /* Save data
  */
  function add_camper_metabox_data( $camper_data_id ) {

    // Gallery
    if ( !empty($_POST['camper-details-gallery']) ){

      // Build array for saving post meta
      $gallery_data = array();
      for ($i = 0; $i < count( $_POST['camper-details-gallery']['image_url'] ); $i++ ){
        if ( '' != $_POST['camper-details-gallery']['image_url'][$i]){
          $gallery_data['image_url'][] = $_POST['camper-details-gallery']['image_url'][ $i ];
        }
      }
      if ( isset( $gallery_data ) ) {
        update_post_meta( $camper_data_id, 'camper-details-gallery-data', $gallery_data );
      }
      else {
        delete_post_meta( $camper_data_id, 'camper-details-gallery-data' );
      }
    }
    // Nothing received, all fields are empty, delete option
    else {
      delete_post_meta( $camper_data_id, 'camper-details-gallery-data' );
    }

    // Distribution images
    if ( !empty($_POST['camper-details-daily-distribution']) ) {
      $camper_camper_daily_distribution = sanitize_text_field( $_POST['camper-details-daily-distribution'] );
      update_post_meta( $camper_data_id, 'camper-details-daily-distribution', $camper_camper_daily_distribution );
    }
    else {
      delete_post_meta( $camper_data_id, 'camper-details-daily-distribution' );
    }

    if ( !empty($_POST['camper-details-nightly-distribution']) ) {
      $camper_camper_nightly_distribution = sanitize_text_field( $_POST['camper-details-nightly-distribution'] );
      update_post_meta( $camper_data_id, 'camper-details-nightly-distribution', $camper_camper_nightly_distribution );
    }
    else {
      delete_post_meta( $camper_data_id, 'camper-details-nightly-distribution' );
    }


    // Price
    if (  array_key_exists( 'camper-details-price', $_POST )  ) {
      $camper_price = sanitize_text_field( $_POST['camper-details-price'] );
      update_post_meta(
        $camper_data_id,
        'camper-details-price',
        $camper_price
      );
    }

    // Brand
    if (  array_key_exists( 'camper-details-brand', $_POST )  ) {
      $camper_brand = sanitize_text_field( $_POST['camper-details-brand'] );
      update_post_meta(
        $camper_data_id,
        'camper-details-brand',
        $camper_brand
      );
    }

    // Model
    if (  array_key_exists( 'camper-details-model', $_POST )  ) {
      $camper_model = sanitize_text_field( $_POST['camper-details-model'] );
      update_post_meta(
        $camper_data_id,
        'camper-details-model',
        $camper_model
      );
    }

    // Solar panels
    if (  isset( $_POST[ 'camper-details-solar-panels' ] )  ) {
      update_post_meta(
        $camper_data_id,
        'camper-details-solar-panels',
        'yes'
      );
    }
    else {
      update_post_meta(
        $camper_data_id,
        'camper-details-solar-panels',
        ''
      );
    }



    // Places
    if (  array_key_exists( 'camper-details-places', $_POST )  ) {
      $camper_places = sanitize_text_field( $_POST['camper-details-places'] );
      update_post_meta(
        $camper_data_id,
        'camper-details-places',
        $camper_places
      );
    }

    // Beds
    if (  array_key_exists( 'camper-details-license', $_POST )  ) {
      $camper_license = sanitize_text_field( $_POST['camper-details-license'] );
      update_post_meta(
        $camper_data_id,
        'camper-details-license',
        $camper_license
      );
    }

    // Beds
    if (  array_key_exists( 'camper-details-beds', $_POST )  ) {
      $camper_beds = sanitize_text_field( $_POST['camper-details-beds'] );
      update_post_meta(
        $camper_data_id,
        'camper-details-beds',
        $camper_beds
      );
    }

    // Lenght
    if (  array_key_exists( 'camper-details-lenght', $_POST )  ) {
      $camper_lenght = sanitize_text_field( $_POST['camper-details-lenght'] );
      update_post_meta(
        $camper_data_id,
        'camper-details-lenght',
        $camper_lenght
      );
    }

    // Width
    if (  array_key_exists( 'camper-details-width', $_POST )  ) {
      $camper_width = sanitize_text_field( $_POST['camper-details-width'] );
      update_post_meta(
        $camper_data_id,
        'camper-details-width',
        $camper_width
      );
    }

    // Height
    if (  array_key_exists( 'camper-details-height', $_POST )  ) {
      $camper_height = sanitize_text_field( $_POST['camper-details-height'] );
      update_post_meta(
        $camper_data_id,
        'camper-details-height',
        $camper_height
      );
    }

    // Year
    if (  array_key_exists( 'camper-details-year', $_POST )  ) {
      $camper_year = sanitize_text_field( $_POST['camper-details-year'] );
      update_post_meta(
        $camper_data_id,
        'camper-details-year',
        $camper_year
      );
    }

    // Plate
    if (  array_key_exists( 'camper-details-plate', $_POST )  ) {
      $camper_plate = sanitize_text_field( $_POST['camper-details-plate'] );
      update_post_meta(
        $camper_data_id,
        'camper-details-plate',
        $camper_plate
      );
    }

    // Fuel
    if (  array_key_exists( 'camper-details-fuel', $_POST )  ) {
      $camper_fuel = sanitize_text_field( $_POST['camper-details-fuel'] );
      update_post_meta(
        $camper_data_id,
        'camper-details-fuel',
        $camper_fuel
      );
    }

    // Engine
    if (  array_key_exists( 'camper-details-engine', $_POST )  ) {
      $camper_engine = sanitize_text_field( $_POST['camper-details-engine'] );
      update_post_meta(
        $camper_data_id,
        'camper-details-engine',
        $camper_engine
      );
    }

    // Gear
    if (  array_key_exists( 'camper-details-gear', $_POST )  ) {
      $camper_gear = sanitize_text_field( $_POST['camper-details-gear'] );
      update_post_meta(
        $camper_data_id,
        'camper-details-gear',
        $camper_gear
      );
    }

    // Power
    if (  array_key_exists( 'camper-details-power', $_POST )  ) {
      $camper_power = sanitize_text_field( $_POST['camper-details-power'] );
      update_post_meta(
        $camper_data_id,
        'camper-details-power',
        $camper_power
      );
    }

    // -- Extras

    // Pets
    if (  isset( $_POST[ 'camper-details-pets' ] )  ) {
      update_post_meta(
        $camper_data_id,
        'camper-details-pets',
        'yes'
      );
    }
    else {
      update_post_meta(
        $camper_data_id,
        'camper-details-pets',
        ''
      );
    }

    // Air Conditioning
    if (  isset( $_POST[ 'camper-details-conditioned' ] )  ) {
      update_post_meta(
        $camper_data_id,
        'camper-details-conditioned',
        'yes'
      );
    }
    else {
      update_post_meta(
        $camper_data_id,
        'camper-details-conditioned',
        ''
      );
    }

    // Shower
    if (  isset( $_POST[ 'camper-details-shower' ] )  ) {
      update_post_meta(
        $camper_data_id,
        'camper-details-shower',
        'yes'
      );
    }
    else {
      update_post_meta(
        $camper_data_id,
        'camper-details-shower',
        ''
      );
    }

    // Hob
    if (  isset( $_POST[ 'camper-details-hob' ] )  ) {
      update_post_meta(
        $camper_data_id,
        'camper-details-hob',
        'yes'
      );
    }
    else {
      update_post_meta(
        $camper_data_id,
        'camper-details-hob',
        ''
      );
    }

    // Sink
    if (  isset( $_POST[ 'camper-details-sink' ] )  ) {
      update_post_meta(
        $camper_data_id,
        'camper-details-sink',
        'yes'
      );
    }
    else {
      update_post_meta(
        $camper_data_id,
        'camper-details-sink',
        ''
      );
    }

    // Toilet
    if (  isset( $_POST[ 'camper-details-toilet' ] )  ) {
      update_post_meta(
        $camper_data_id,
        'camper-details-toilet',
        'yes'
      );
    }
    else {
      update_post_meta(
        $camper_data_id,
        'camper-details-toilet',
        ''
      );
    }

    // TV
    if (  isset( $_POST[ 'camper-details-tv' ] )  ) {
      update_post_meta(
        $camper_data_id,
        'camper-details-tv',
        'yes'
      );
    }
    else {
      update_post_meta(
        $camper_data_id,
        'camper-details-tv',
        ''
      );
    }

    // ISOFIX
    if (  isset( $_POST[ 'camper-details-isofix' ] )  ) {
      update_post_meta(
        $camper_data_id,
        'camper-details-isofix',
        'yes'
      );
    }
    else {
      update_post_meta(
        $camper_data_id,
        'camper-details-isofix',
        ''
      );
    }

    // Anwing
    if (  isset( $_POST[ 'camper-details-awning' ] )  ) {
      update_post_meta(
        $camper_data_id,
        'camper-details-awning',
        'yes'
      );
    }
    else {
      update_post_meta(
        $camper_data_id,
        'camper-details-awning',
        ''
      );
    }

    // Rear camera
    if (  isset( $_POST[ 'camper-details-rear-camera' ] )  ) {
      update_post_meta(
        $camper_data_id,
        'camper-details-rear-camera',
        'yes'
      );
    }
    else {
      update_post_meta(
        $camper_data_id,
        'camper-details-rear-camera',
        ''
      );
    }

    // Camper ID
    if (  array_key_exists( 'camper-details-id', $_POST )  ) {
      $camper_id = sanitize_text_field( $_POST['camper-details-id'] );
      update_post_meta(
        $camper_data_id,
        'camper-details-id',
        $camper_id
      );
    }

    // Video URL
    if (  array_key_exists( 'camper-details-video', $_POST )  ) {
      $camper_video = sanitize_text_field( $_POST['camper-details-video'] );
      update_post_meta(
        $camper_data_id,
        'camper-details-video',
        $camper_video
      );
    }

  }


  /* Move metabox below editor
   */
  function mybooking_move_camper_metabox() {

    global $post, $wp_meta_boxes;

    do_meta_boxes(
      get_current_screen(),
      'advanced',
      $post
    );

    unset( $wp_meta_boxes['post']['advanced'] );
  }

  /* Camper Gallery scripts - enqueue external files
   */
  function mybooking_camper_gallery_styles_scripts( $hook ) {

    global $post;

    if ( !isset($post) || ( $hook !== 'post.php' && $hook !== 'post-new.php' ) ) {
      return;
    }

    if ( $post->post_type !== 'camper' ) {
      return;
    }

    // CSS
    wp_enqueue_style(
      'mybooking-camper-gallery-style',
      plugin_dir_url( __FILE__ ) . 'assets/css/mybooking-camper-metabox-gallery.css',
      array(),
      '1.0.0'
    );

    // JS
    wp_enqueue_script(
      'mybooking-camper-gallery-script',
      plugin_dir_url( __FILE__ ) . 'assets/js/mybooking-camper-metabox-gallery.js',
      array( 'jquery', 'jquery-ui-sortable' ),
      '1.0.0',
      true
    );

  }

  // Add metaboxes
  add_action( 'add_meta_boxes', 'add_camper_metabox' );
  // Save posts
  add_action( 'save_post', 'add_camper_metabox_data' );
  // Edit form after title
  add_action('edit_form_after_title', 'mybooking_move_camper_metabox');
  // Add Scripts
  add_action( 'admin_enqueue_scripts', 'mybooking_camper_gallery_styles_scripts' );
