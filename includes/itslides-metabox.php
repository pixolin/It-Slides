<?php

class ItslidesMB {

	function metabox( $post_type ) {
		$post_types = array( 'itslider' );
		if ( in_array( $post_type, $post_types ) ) {
			add_meta_box(
				$id = 'itslider-meta',
				$title = __( 'Slide', 'itslides' ),
				$callback = array( $this, 'metabox_form' ),
				$post_type,
				$context = 'normal',
				$priority = 'high',
				$callback_args = null
			);
		}
	}

	function metabox_form() {
		// Add an nonce field so we can check for it later.
	 wp_nonce_field( 'itslider_slide_box', 'itslider_slide_box_nonce' );

	 // Use get_post_meta to retrieve an existing value from the database.
	 global $post;
	 $value = get_post_meta( $post->ID, '_itslide', true );

	 // Display the form, using the current value.
	 echo '<p>' . __( 'Here you can select the slides you want to display as slider', 'itslides') . '</p>';
	 ?>
	 <label for="itslide_new_field">
			 <?php _e( 'Name of the Slide:', 'itslides' ); ?>
	 </label>
	 <input type="text" id="itslide_new_field" name="itslide_new_field" value="<?php echo esc_attr( $value ); ?>" size="25" />
	 <?php
	}

	function save( $post_id ) {

        /*
         * We need to verify this came from the our screen and with proper authorization,
         * because save_post can be triggered at other times.
         */

        // Check if our nonce is set.
        if ( ! isset( $_POST['itslider_slide_box_nonce'] ) ) {
            return $post_id;
        }

        $nonce = $_POST['itslider_slide_box_nonce'];

        // Verify that the nonce is valid.
        if ( ! wp_verify_nonce( $nonce, 'itslider_slide_box' ) ) {
            return $post_id;
        }

        /*
         * If this is an autosave, our form has not been submitted,
         * so we don't want to do anything.
         */
        if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
            return $post_id;
        }

        // Check the user's permissions.
        if ( 'page' == $_POST['post_type'] ) {
            if ( ! current_user_can( 'edit_page', $post_id ) ) {
                return $post_id;
            }
        } else {
            if ( ! current_user_can( 'edit_post', $post_id ) ) {
                return $post_id;
            }
        }

        /* OK, it's safe for us to save the data now. */

        // Sanitize the user input.
        $mydata = sanitize_text_field( $_POST['itslide_new_field'] );

        // Update the meta field.
        update_post_meta( $post_id, '_itslide', $mydata );
    }

}
