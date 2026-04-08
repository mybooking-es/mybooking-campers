        // Media uploader
        var media_uploader = null;

        /**
         * Remove single image
         */
        function remove_single_image(selectorImg, selectorHidden, selectorAddButton, selectorRemoveButton) {

          jQuery(selectorImg).hide();
          jQuery(selectorAddButton).show();
          jQuery(selectorRemoveButton).hide();
          // Prepare the hidden field to hold the ID
          jQuery(selectorHidden).val('');

        }

        /**
         * Single image uploader
         */
        function open_media_uploader_single_image(selectorImg, selectorHidden, selectorAddButton, selectorRemoveButton) {

          // Uploader
          media_uploader = wp.media({
            frame:    "post",
            state:    "insert",
            multiple: false
          });
          media_uploader.on("insert", function(){

            var length = media_uploader.state().get("selection").length;

            if (length == 1) {
              var image = media_uploader.state().get("selection").models[0];
              var image_id = image.attributes.id;
              var image_url = image.changed.url;
              jQuery(selectorImg).attr('src', image_url);
              jQuery(selectorImg).show();
              jQuery(selectorAddButton).hide();
              jQuery(selectorRemoveButton).show();
              // Prepare the hidden field to hold the ID
              jQuery(selectorHidden).val(image_id);
            }

          });
          media_uploader.open();

        }

        /**
         * Remove Image
         */
        function remove_img(value) {
          var parent=jQuery(value).parent().parent();
          parent.remove();
        }

        /**
         * Uploader image
         */
        function open_media_uploader_image(obj){
          // Upload image
          media_uploader = wp.media({
            frame:    "post",
            state:    "insert",
            multiple: false
          });
          media_uploader.on("insert", function(){
            var json = media_uploader.state().get("selection").first().toJSON();
            var image_url = json.url;
            var image_id = json.id;
            var html = '<img class="gallery_img_img" src="'+image_url+'" height="55" width="55" onclick="open_media_uploader_image_this(this)"/>';
            jQuery(obj).append(html);
            // Prepare the hidden field to hold the ID
            jQuery(obj).find('.meta_image_url').val(image_id);
          });
          media_uploader.open();
        }

        /**
         * Uploader image
         */
        function open_media_uploader_image_this(obj){
          // Change image
          media_uploader = wp.media({
            frame:    "post",
            state:    "insert",
            multiple: false
          });
          media_uploader.on("insert", function(){
            var json = media_uploader.state().get("selection").first().toJSON();
            var image_url = json.url;
            var image_id = json.id;
            jQuery(obj).attr('src',image_url);
            // Prepare the hidden field to hold the ID
            jQuery(obj).siblings('.meta_image_url').val(image_id);
          });
          media_uploader.open();
        }

        /**
         * Append image
         */
        function open_media_uploader_image_plus(){
          // Uploader
          media_uploader = wp.media({
            frame:    "post",
            state:    "insert",
            multiple: true
          });
          media_uploader.on("insert", function(){

            var length = media_uploader.state().get("selection").length;
            var images = media_uploader.state().get("selection").models;

            for(var i = 0; i < length; i++){
              var image_id = images[i].attributes.id;
              var image_url = images[i].changed.url;
              var box = jQuery('#master_box').html();
              jQuery(box).appendTo('#img_box_container');
              var element = jQuery('#img_box_container .gallery_single_row:last-child').find('.image_container');
              var html = '<img class="gallery_img_img" src="'+image_url+'" height="55" width="55" onclick="open_media_uploader_image_this(this)"/>';
              element.append(html);
              // Prepare the hidden field to hold the ID
              element.find('.meta_image_url').val(image_id);
            }
          });
          media_uploader.open();
        }
        jQuery(function() {
          jQuery("#img_box_container").sortable(); // Activate jQuery UI sortable feature
        });
