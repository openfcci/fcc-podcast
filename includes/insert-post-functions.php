<?php
	/** --------------------------------------------------------------
	 # POSTS: Generation & Save Hooks
	 -------------------------------------------------------------- */

	/**
	 * Update Post Slug, Post Title & Episode Number
	 *
	 * Triggers on save, edit or update of published podcasts
	 * Works in "Quick Edit", but not bulk edit.

	 * @since 0.16.01.28
	 * @version 0.16.06.28
	 */
function fccpod_update_title_and_slug( $post_id, $post, $update ) {

	if ( 'podcasts' == $post->post_type && 'publish' == $post->post_status ) {

	     // Update the Episode Number.
	     $current_post = $post_id;

	     $args = array(
	       'post_type' => array( 'podcasts' ),
	       'post_status' => array( 'publish' ),
	       'posts_per_page' => ' -1 ',
	       'order' => 'ASC', // Podcasts ordered oldest to newest.
	       );
	     $podcasts = get_posts($args);

	     $post_count = (int) wp_count_posts( 'podcasts' )->publish;

	     for ( $i = 0; $i <= $post_count; $i++ ) {

				 		// Find the index of the current post.
			     	if ( $podcasts[$i]->ID == $current_post ) {

				         // Set the episode number.
				     		$episode_number = ($i + 1);
						}
	     	}

     	 update_post_meta( $post_id, 'podcast_episode_number', $episode_number );

   }
}
add_action( 'save_post', 'fccpod_update_title_and_slug', 10, 3 );
