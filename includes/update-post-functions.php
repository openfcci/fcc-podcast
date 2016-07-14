<?php
/*--------------------------------------------------------------
 # POSTS: Generation & Save Hooks
 --------------------------------------------------------------*/

/**
 * Update Post Slug, Post Title & Episode Number
 *
 * Triggers on save, edit or update of published podcasts
 * Works in "Quick Edit", but not bulk edit.
 * @since 0.16.01.28
 * @version 1.16.07.14
 */
function fccpod_update_title_and_slug( $post_id, $post, $update ) {

	if ( 'podcasts' == $post->post_type && 'publish' == $post->post_status ) {

		$current_post = $post_id; // Update the Episode Number.
		$args = array(
			'post_type' => array( 'podcasts' ),
			'post_status' => array( 'publish' ),
			'posts_per_page' => ' -1 ',
			'order' => 'ASC', // Podcasts ordered oldest to newest.
		);
		$podcasts = get_posts( $args );

		$post_count = (int) wp_count_posts( 'podcasts' )->publish;

		for ( $i = 0; $i <= $post_count; $i++ ) {
			if ( $podcasts[ $i ]->ID == $current_post ) { // Find the index of the current post.
				$episode_number = ( $i + 1 ); // Set the episode number.
			}
		}
		update_post_meta( $post_id, 'podcast_episode_number', $episode_number );
	}

	if ( 'podcasts' == $post->post_type ) {
		# Update the Post Content
		$description = get_post_meta( $post_id, 'segment_1_description', true );
		$title = get_post_meta( $post_id, 'segment_1_title', true );
		$content = array(
			'ID' => $post_id,
			'post_title'   => $title,
			'post_content' => $description,
		);
		remove_action( 'save_post', 'fccpod_update_title_and_slug' );
		wp_update_post( $content );
		$category_id = get_term_by( 'name', 'Podcast', 'category' )->term_id;
		if ( ! $category_id ) {
			$category_id = wp_insert_term( 'Podcast', 'category', array( 'description' => '', 'slug' => 'podcast' ) );
			$category_id = get_term_by( 'name', 'Podcast', 'category' )->term_id;
		}
		wp_set_post_categories( $post_id, $category_id );
		add_action( 'save_post', 'fccpod_update_title_and_slug' );
	}

}
add_action( 'save_post', 'fccpod_update_title_and_slug', 10, 3 );


/**
 * Import an image from a URL.
 * fccpod_import_thumb( $url );
 * Example JW Thumb URL: https://assets-jpcust.jwpsrv.com/thumbs/w5IpUXct-720.jpg
 *
 */
function fccpod_import_thumb( $url ) {
	// Need to require these files
	if ( ! function_exists( 'media_handle_upload' ) ) {
		require_once( ABSPATH . 'wp-admin' . '/includes/image.php' );
		require_once( ABSPATH . 'wp-admin' . '/includes/file.php' );
		require_once( ABSPATH . 'wp-admin' . '/includes/media.php' );
	}

	$url = $url;
	$tmp = download_url( $url );
	if ( is_wp_error( $tmp ) ) {
		// download failed, handle error
	}
	$post_id = 1;
	$desc = '';
	$file_array = array();

	// Set variables for storage
	// fix file filename for query strings
	preg_match( '/[^\?]+\.(jpg|jpe|jpeg|gif|png)/i', $url, $matches );
	$file_array['name'] = basename( $matches[0] );
	$file_array['tmp_name'] = $tmp;

	// If error storing temporarily, unlink
	if ( is_wp_error( $tmp ) ) {
		@unlink( $file_array['tmp_name'] );
		$file_array['tmp_name'] = '';
	}

	// do the validation and storage stuff
	$id = media_handle_sideload( $file_array, $post_id, $desc );

	// If error storing permanently, unlink
	if ( is_wp_error( $id ) ) {
		@unlink( $file_array['tmp_name'] );
		return $id;
	}

	$attachment_id = $id;
	return $attachment_id;
}
