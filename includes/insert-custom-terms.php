<?php

/**
 * Insert the default iTunes Category Terms
 *
 * @since 0.16.02.19
 * @version 0.16.06.30
 */
if ( ! get_option( 'fccpod_itunes_terms' ) ) {
	add_action( 'wp_loaded', 'fccpod_insert_itunes_terms', 210 );
	wp_insert_term( 'Podcast', 'category', array( 'description' => '', 'slug' => 'podcast' ) );
}

function fccpod_insert_itunes_terms() {
	wp_insert_term( 'Arts', 'itunes_categories' );
	$parentname = 'Arts';
	wp_insert_term( 'Design', 'itunes_categories', array( 'parent' => fccpod_get_parent( $parentname ), 'itunes_categories' ) );
	wp_insert_term( 'Fashion &amp; Beauty', 'itunes_categories', array( 'parent' => fccpod_get_parent( $parentname ), 'itunes_categories' ) );
	wp_insert_term( 'Food', 'itunes_categories', array( 'parent' => fccpod_get_parent( $parentname ), 'itunes_categories' ) );
	wp_insert_term( 'Literature', 'itunes_categories', array( 'parent' => fccpod_get_parent( $parentname ), 'itunes_categories' ) );
	wp_insert_term( 'Performing Arts', 'itunes_categories', array( 'parent' => fccpod_get_parent( $parentname ), 'itunes_categories' ) );
	wp_insert_term( 'Visual Arts', 'itunes_categories', array( 'parent' => fccpod_get_parent( $parentname ), 'itunes_categories' ) );
	wp_insert_term( 'Business', 'itunes_categories' );
	$parentname = 'Business';
	wp_insert_term( 'Business News', 'itunes_categories', array( 'parent' => fccpod_get_parent( $parentname ), 'itunes_categories' ) );
	wp_insert_term( 'Careers', 'itunes_categories', array( 'parent' => fccpod_get_parent( $parentname ), 'itunes_categories' ) );
	wp_insert_term( 'Investing', 'itunes_categories', array( 'parent' => fccpod_get_parent( $parentname ), 'itunes_categories' ) );
	wp_insert_term( 'Management &amp; Marketing', 'itunes_categories', array( 'parent' => fccpod_get_parent( $parentname ), 'itunes_categories' ) );
	wp_insert_term( 'Shopping', 'itunes_categories', array( 'parent' => fccpod_get_parent( $parentname ), 'itunes_categories' ) );
	wp_insert_term( 'Comedy', 'itunes_categories' );
	$parentname = 'Comedy';
	wp_insert_term( 'Education', 'itunes_categories', array( 'parent' => fccpod_get_parent( $parentname ), 'itunes_categories' ) );
	wp_insert_term( 'Educational Technology', 'itunes_categories', array( 'parent' => fccpod_get_parent( $parentname ), 'itunes_categories' ) );
	wp_insert_term( 'Higher Education', 'itunes_categories', array( 'parent' => fccpod_get_parent( $parentname ), 'itunes_categories' ) );
	wp_insert_term( 'K-12', 'itunes_categories', array( 'parent' => fccpod_get_parent( $parentname ), 'itunes_categories' ) );
	wp_insert_term( 'Language Courses', 'itunes_categories', array( 'parent' => fccpod_get_parent( $parentname ), 'itunes_categories' ) );
	wp_insert_term( 'Training', 'itunes_categories', array( 'parent' => fccpod_get_parent( $parentname ), 'itunes_categories' ) );
	wp_insert_term( 'Games &amp; Hobbies', 'itunes_categories' );
		$parentname = 'Games &amp; Hobbies';
	wp_insert_term( 'Automotive', 'itunes_categories', array( 'parent' => fccpod_get_parent( $parentname ), 'itunes_categories' ) );
	wp_insert_term( 'Aviation', 'itunes_categories', array( 'parent' => fccpod_get_parent( $parentname ), 'itunes_categories' ) );
	wp_insert_term( 'Hobbies', 'itunes_categories', array( 'parent' => fccpod_get_parent( $parentname ), 'itunes_categories' ) );
	wp_insert_term( 'Other Games', 'itunes_categories', array( 'parent' => fccpod_get_parent( $parentname ), 'itunes_categories' ) );
	wp_insert_term( 'Video Games', 'itunes_categories', array( 'parent' => fccpod_get_parent( $parentname ), 'itunes_categories' ) );
	wp_insert_term( 'Government &amp; Organizations', 'itunes_categories' );
	$parentname = 'Government &amp; Organizations';
	wp_insert_term( 'Local', 'itunes_categories', array( 'parent' => fccpod_get_parent( $parentname ), 'itunes_categories' ) );
	wp_insert_term( 'National', 'itunes_categories', array( 'parent' => fccpod_get_parent( $parentname ), 'itunes_categories' ) );
	wp_insert_term( 'Non-Profit', 'itunes_categories', array( 'parent' => fccpod_get_parent( $parentname ), 'itunes_categories' ) );
	wp_insert_term( 'Regional', 'itunes_categories', array( 'parent' => fccpod_get_parent( $parentname ), 'itunes_categories' ) );
	wp_insert_term( 'Health', 'itunes_categories' );
	$parentname = 'Health';
	wp_insert_term( 'Alternative Health', 'itunes_categories', array( 'parent' => fccpod_get_parent( $parentname ), 'itunes_categories' ) );
	wp_insert_term( 'Fitness &amp; Nutrition', 'itunes_categories', array( 'parent' => fccpod_get_parent( $parentname ), 'itunes_categories' ) );
	wp_insert_term( 'Self-Help', 'itunes_categories', array( 'parent' => fccpod_get_parent( $parentname ), 'itunes_categories' ) );
	wp_insert_term( 'Sexuality', 'itunes_categories', array( 'parent' => fccpod_get_parent( $parentname ), 'itunes_categories' ) );
	wp_insert_term( 'Kids &amp; Family', 'itunes_categories' );
	wp_insert_term( 'Music', 'itunes_categories' );
	wp_insert_term( 'News &amp; Politics', 'itunes_categories' );
	wp_insert_term( 'Religion &amp; Spirituality', 'itunes_categories' );
	$parentname = 'Religion &amp; Spirituality';
	wp_insert_term( 'Buddhism', 'itunes_categories', array( 'parent' => fccpod_get_parent( $parentname ), 'itunes_categories' ) );
	wp_insert_term( 'Christianity', 'itunes_categories', array( 'parent' => fccpod_get_parent( $parentname ), 'itunes_categories' ) );
	wp_insert_term( 'Hinduism', 'itunes_categories', array( 'parent' => fccpod_get_parent( $parentname ), 'itunes_categories' ) );
	wp_insert_term( 'Islam', 'itunes_categories', array( 'parent' => fccpod_get_parent( $parentname ), 'itunes_categories' ) );
	wp_insert_term( 'Judaism', 'itunes_categories', array( 'parent' => fccpod_get_parent( $parentname ), 'itunes_categories' ) );
	wp_insert_term( 'Other', 'itunes_categories', array( 'parent' => fccpod_get_parent( $parentname ), 'itunes_categories' ) );
	wp_insert_term( 'Spirituality', 'itunes_categories', array( 'parent' => fccpod_get_parent( $parentname ), 'itunes_categories' ) );
	wp_insert_term( 'Science &amp; Medicine', 'itunes_categories' );
	$parentname = 'Science &amp; Medicine';
	wp_insert_term( 'Medicine', 'itunes_categories', array( 'parent' => fccpod_get_parent( $parentname ), 'itunes_categories' ) );
	wp_insert_term( 'Natural Sciences', 'itunes_categories', array( 'parent' => fccpod_get_parent( $parentname ), 'itunes_categories' ) );
	wp_insert_term( 'Social Sciences', 'itunes_categories', array( 'parent' => fccpod_get_parent( $parentname ), 'itunes_categories' ) );
	wp_insert_term( 'Society &amp; Culture', 'itunes_categories' );
	$parentname = 'Society &amp; Culture';
	wp_insert_term( 'History', 'itunes_categories', array( 'parent' => fccpod_get_parent( $parentname ), 'itunes_categories' ) );
	wp_insert_term( 'Personal Journals', 'itunes_categories', array( 'parent' => fccpod_get_parent( $parentname ), 'itunes_categories' ) );
	wp_insert_term( 'Philosophy', 'itunes_categories', array( 'parent' => fccpod_get_parent( $parentname ), 'itunes_categories' ) );
	wp_insert_term( 'Places &amp; Travel', 'itunes_categories', array( 'parent' => fccpod_get_parent( $parentname ), 'itunes_categories' ) );
	wp_insert_term( 'Sports &amp; Recreation', 'itunes_categories' );
	$parentname = 'Sports &amp; Recreation';
	wp_insert_term( 'Amateur', 'itunes_categories', array( 'parent' => fccpod_get_parent( $parentname ), 'itunes_categories' ) );
	wp_insert_term( 'College &amp; High School', 'itunes_categories', array( 'parent' => fccpod_get_parent( $parentname ), 'itunes_categories' ) );
	wp_insert_term( 'Outdoor', 'itunes_categories', array( 'parent' => fccpod_get_parent( $parentname ), 'itunes_categories' ) );
	wp_insert_term( 'Professional', 'itunes_categories', array( 'parent' => fccpod_get_parent( $parentname ), 'itunes_categories' ) );
	wp_insert_term( 'Technology', 'itunes_categories' );
	$parentname = 'Technology';
	wp_insert_term( 'Gadgets', 'itunes_categories', array( 'parent' => fccpod_get_parent( $parentname ), 'itunes_categories' ) );
	wp_insert_term( 'Tech News', 'itunes_categories', array( 'parent' => fccpod_get_parent( $parentname ), 'itunes_categories' ) );
	wp_insert_term( 'Podcasting', 'itunes_categories', array( 'parent' => fccpod_get_parent( $parentname ), 'itunes_categories' ) );
	wp_insert_term( 'Software How-To', 'itunes_categories', array( 'parent' => fccpod_get_parent( $parentname ), 'itunes_categories' ) );
	wp_insert_term( 'TV &amp; Film', 'itunes_categories' );

	# After update, set option to prevent recursion
	update_option( 'fccpod_itunes_terms', '1' );
}

/**
 * Return parent category ID from name
 *
 * @since 0.16.02.18
 */
function fccpod_get_parent( $parentname ) {
	$parent_term_id = get_term_by( 'name', $parentname, 'itunes_categories' )->term_id;
	return $parent_term_id;
}
