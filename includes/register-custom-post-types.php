<?php
# NOTE: CPT-UI may not correctly output the post type archive re-write string
# "rewrite" => array( "slug" => "radio/podcasts", "with_front" => true ),

/**
 * Register the Custom Post Types
 *
 * @since 12.30.2015
 */

/*--------------------------------------------------------------
 # PODCASTS CUSTOM POST TYPE  );
 --------------------------------------------------------------*/

add_action( 'init', 'cptui_register_my_cpts_podcasts' );
function cptui_register_my_cpts_podcasts() {
	$labels = array(
		"name" => "Podcasts",
		"singular_name" => "Podcast",
		"menu_name" => "Podcasts",
		"all_items" => "All Podcasts",
		"add_new" => "Add Podcast",
		"add_new_item" => "Add New Podcast",
		"edit" => "Edit",
		"edit_item" => "Edit Podcast",
		"new_item" => "New Podcast",
		"view" => "View",
		"view_item" => "View Podcast",
		"search_items" => "Search Podcast",
		"not_found" => "No Podcasts found",
		"not_found_in_trash" => "No Podcasts found in Trash",
		"parent" => "Parent Podcast",
		);

	$args = array(
		"labels" => $labels,
		"description" => "",
		"public" => true,
		"show_ui" => true,
		"show_in_rest" => true,
		"has_archive" => true,
		"show_in_menu" => true,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => true,
		//"rewrite" => array( "slug" => "podcasts", "with_front" => true ), // TODO (Fix)
    "rewrite" => false,
		"query_var" => true,
		"menu_icon" => "dashicons-microphone",
		"supports" => array( "title", "thumbnail", "editor" ),
		"taxonomies" => array( "category", "post_tag" ),
	);
	register_post_type( "podcasts", $args );

// End of cptui_register_my_cpts_podcasts()
}


/*--------------------------------------------------------------
# iTunes Categories Taxonomy
--------------------------------------------------------------*/

# /wp-admin/edit-tags.php?taxonomy=itunes_categories

add_action( 'init', 'cptui_register_my_taxes_itunes_categories' );
function cptui_register_my_taxes_itunes_categories() {

	$labels = array(
		"name" => "iTunes Categories",
		"label" => "iTunes Categories",
		"menu_name" => "iTunes Categories",
		"all_items" => "All iTunes Categories",
		"edit_item" => "Edit iTunes Category",
		"view_item" => "View iTunes Category",
		"update_item" => "Update iTunes Category",
		"add_new_item" => "Add New iTunes Category",
		"new_item_name" => "New iTunes Category Name",
		"parent_item" => "Parent iTunes Category",
		"parent_item_colon" => "Parent iTunes Category:",
		"search_items" => "Search iTunes Categories",
		"popular_items" => "Popular iTunes Categories",
		"separate_items_with_commas" => "Separate iTunes Categories with commas",
		"add_or_remove_items" => "Add or remove iTunes Categories",
		"choose_from_most_used" => "Choose from most used iTunes Categories",
		"not_found" => "No iTunes Categories found",
		);

	$args = array(
		"labels" => $labels,
		"hierarchical" => true,
		"label" => "iTunes Categories",
		"show_ui" => true,
		"query_var" => true,
		"rewrite" => array( 'slug' => 'itunes_categories', 'with_front' => true,  'hierarchical' => true ),
		"show_admin_column" => false,
	);
  register_taxonomy( "itunes_categories", '', $args );

// End cptui_register_my_taxes_itunes_categories()
}


// Show posts of 'post', and 'podcasts' post types on home page
function fccpod_add_podcasts_to_query( $query ) {
	if ( is_home() && $query->is_main_query() ) {
		$query->set( 'post_type', array( 'post', 'podcasts' ) );
		return $query;
	}
}
add_action( 'pre_get_posts', 'fccpod_add_podcasts_to_query' );
