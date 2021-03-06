<?php

/* Quit */
defined('ABSPATH') OR exit;

if (! class_exists( 'Itslides_MB' ) ) :
class Itslides_MB {

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
		global $post;
		$repeatable_fields = get_post_meta($post->ID, '_itslide', true);

		wp_nonce_field( 'itslider_slide_box', 'itslider_slide_box_nonce' );
		?>


		Describe what we are doing here.
		<table id="repeatable-fieldset-one" width="100%">
		<thead>
			<tr>
				<th width="5%"></th>
				<th width="40%">Image</th>
				<th width="40%"></th>
				<th width="10%"></th>
			</tr>
		</thead>
		<tbody>

		<?php
		if ( $repeatable_fields ) :
		foreach ( $repeatable_fields as $field ) {
		?>
		<tr class="sortable metafield">
			<td><span class="dashicons dashicons-menu"></span></td>
			<td><input type="text" id="" class="widefat meta-url" name="image[]" value="<?php if($field['image'] != '') echo esc_attr( $field['image'] ); ?>" /></td>
			<td><a class="image-button button"><?php _e( 'Choose or Upload an Image', 'itslides' ); ?></a></td>
			<td><a class="button remove-row" href="#"><?php _e( 'Remove', 'itslides'); ?></a></td>
		</tr>
		<?php
		}
		else :
		// show a blank one
		?>
		<tr class="sortable metafield">
			<td><span class="dashicons dashicons-menu"></span></td>
			<td><input type="text" id="" class="widefat meta-url" name="image[]" /></td>
			<td><a class="image-button button"><?php _e( 'Choose or Upload an Image', 'itslides' ); ?></a></td>
			<td><a class="button remove-row" href="#"><?php _e( 'Remove', 'itslides'); ?></a></td>
		</tr>
		<?php endif; ?>

		<!-- empty hidden one for jQuery -->
		<tr class="empty-row screen-reader-text metafield">
			<td><span class="dashicons dashicons-menu"></td>
			<td><input type="text" id="" class="widefat meta-url" name="image[]" /></td>
			<td><a class="image-button button"><?php _e( 'Choose or Upload an Image', 'itslides' ); ?></a></td>
			<td><a class="button remove-row" href="#"><?php _e( 'Remove', 'itslides'); ?></a></td>
		</tr>
		</tbody>
		</table>

		<p><a id="add-row" class="button" href="#"><?php _e( 'Add another image', 'itslides' ); ?></a></p>
		<?php
	}

	function save( $post_id ) {

		if ( ! isset( $_POST['itslider_slide_box_nonce'] ) ) {
			return $post_id;
		}

		$nonce = $_POST['itslider_slide_box_nonce'];

		// Verify that the nonce is valid.
		if ( ! wp_verify_nonce( $nonce, 'itslider_slide_box' ) ) {
			return $post_id;
		}

		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return $post_id;
		}

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
//$mydata = sanitize_text_field( $_POST['itslide_new_field'] );

		$old = get_post_meta($post_id, '_itslide', true);
		$new = array();

		$images = $_POST['image'];

		$count = count( $images );

		for ( $i = 0; $i < $count; $i++ ) {
			if ( $images[$i] != '' )
				$new[$i]['image'] = stripslashes( strip_tags( $images[$i] ) );
		}

		if ( !empty( $new ) && $new != $old )
			update_post_meta( $post_id, '_itslide', $new );
		elseif ( empty($new) && $old )
			delete_post_meta( $post_id, '_itslide', $old );

	}

}

endif; // End Check Class Exists
