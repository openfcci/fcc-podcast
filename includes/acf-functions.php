<?php
/*--------------------------------------------------------------
# ACF: Advanced Custom Fields Functions
--------------------------------------------------------------*/

/**
 * Read-Only Field Filter
 *
 * Filter Segments 1-3 Date and Duration field values to 'Read Only'.
 * @since 0.16.01.28
 * @link http://www.advancedcustomfields.com/resources/acfload_value/
 */
function fccpod_field_readonly_filter( $field ) {
	if ( 1 != $field['readonly'] ) {
		$field['readonly'] = 1;
	}
	return $field;
}
add_filter( 'acf/load_field/name=segment_1_duration', 'fccpod_field_readonly_filter' );
add_filter( 'acf/load_field/name=segment_1_date', 'fccpod_field_readonly_filter' );
add_filter( 'acf/load_field/name=segment_1_size', 'fccpod_field_readonly_filter' );
add_filter( 'acf/load_field/name=podcast_episode_number', 'fccpod_field_readonly_filter' );

/**
 * Enable/Disable Segment Image Thumbnail Fields
 *
 * Filters the load fields before rendering, use to "disable" fields by hiding.
 * @since 0.16.02.02
 * @link http://www.advancedcustomfields.com/resources/acfload_value/
 */
function fccpod_segment_thumbnail_load_field( $field ) {
	if ( ! get_option( 'options_segment_thumbnail_image_field' ) ) {
		$field['wrapper']['class'] = 'hidden-by-conditional-logic'; # Hide
	} else {
		$field['wrapper']['class'] = ''; # Show
	}
	return $field;
}
add_filter( 'acf/load_field/name=segment_thumbnail', 'fccpod_segment_thumbnail_load_field' );

/**
 * Set Default "Channel Title" Value
 *
 * @since 0.16.02.04
 * @link http://www.advancedcustomfields.com/resources/acfload_value/
 */
function fccpod_podcasts_channel_title_filter( $field ) {
	$field['default_value'] = get_bloginfo( 'name' );
	return $field;
}
add_filter( 'acf/load_field/name=podcasts_channel_title', 'fccpod_podcasts_channel_title_filter' );


function fccpod_podcasts_channel_summary_filter( $field ) {
	$field['default_value'] = get_bloginfo( 'description' );
	return $field;
}
//add_filter( 'acf/load_field/name=podcasts_channel_summary', 'fccpod_podcasts_channel_summary_filter' );

function fccpod_podcasts_channel_owner_email_filter( $field ) {
	$field['default_value'] = get_bloginfo( 'admin_email' );
	return $field;
}
add_filter( 'acf/load_field/name=podcasts_channel_owner_e-mail', 'fccpod_podcasts_channel_owner_email_filter' );

/**
 * Set Default "Channel Link" Value
 *
 * @since 0.16.02.04
 * @link http://www.advancedcustomfields.com/resources/acfload_value/
 */
function fccpod_podcasts_channel_link_filter( $field ) {
	$field['default_value'] = home_url();
	return $field;
}
add_filter( 'acf/load_field/name=podcasts_channel_link', 'fccpod_podcasts_channel_link_filter' );

/**
 * Order "All Podcasts" & "All Stations" Pages by Date
 *
 * @since 0.16.01.28
 * @version 0.16.06.30
 */
function fccpod_set_post_order_in_admin( $wp_query ) {
	if ( is_admin() ) {
		global $my_admin_page;
		$screen = get_current_screen();

		if ( ( 'edit-podcasts' == $screen->id || 'edit-stations' == $screen->id ) && ! isset( $_GET['orderby'] ) ) {
			$wp_query->set( 'orderby', 'date' );
			$wp_query->set( 'order', 'DSC' );
		}
	}
}
add_filter( 'pre_get_posts', 'fccpod_set_post_order_in_admin' );
