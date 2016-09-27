<?php
/*--------------------------------------------------------------
# PODCASTS XML FEED TEMPLATE
--------------------------------------------------------------*/

/**
 * PODCASTS XML FEED
 *
 * @author Josh Slebodnik <josh.slebodnik@forumcomm.com>
 * @author Ryab Veitch <ryan.veitch@forumcomm.com>
 * @since 0.16.02.05
 * @version 0.16.05.25
 */

header( 'Content-type: text/xml; charset=UTF-8' );

# Adds cdata to an element
function add_cdata( $element, $cdata_text ) {
	$node = dom_import_simplexml( $element );
	$no = $node->ownerDocument; // snake_case format needed for this variable, do not change.
	$node->appendChild( $no->createCDATASection( $cdata_text ) );
}

/* Add rss tag */
$xml = new SimpleXMLElement( '<rss xmlns:itunes="http://www.itunes.com/dtds/podcast-1.0.dtd"/>' );
$xml->registerXPathNamespace( 'itunes', 'http://www.itunes.com/dtds/podcast-1.0.dtd' );
$xml->addAttribute( 'version', '2.0' );

/**** Channel META  *****/
$channel_title = htmlspecialchars( sanitize_text_field( get_option( 'options_podcasts_channel_title' ) ), ENT_QUOTES );
$channel_link = get_option( 'options_podcasts_channel_link' );
$channel_image = wp_get_attachment_url( get_option( 'options_podcasts_channel_image' ) );
$channel_keywords = get_option( 'options_podcasts_channel_keywords' );
$channel_language = 'en-us';
$channel_copyright = html_entity_decode( '&#xA9; ' ) . date( 'Y' ) . ' Forum Communications Company. All Rights Reserved.';
$channel_author = get_option( 'options_podcasts_channel_author' );
$channel_email = get_option( 'options_podcasts_channel_owner_e-mail' );
$channel_summary = sanitize_text_field( get_option( 'options_podcasts_channel_summary' ) );
$channel_explicit = get_option( 'options_podcasts_channel_explicit' );

# Get the Channel Category & Parent ( If Applicable )
$channel_category_id = get_term_by( 'id', get_option( 'options_podcasts_channel_category' ), 'itunes_categories' );
$channel_category_child = $channel_category_id->name;

if ( 0 != $channel_category_id->parent ) {
	$channel_category_parent = get_term_by( 'id', $channel_category_id->parent, 'itunes_categories' )->name;
} else {
	$channel_category_parent = null;
}

/* Add channel tag as a child to rss tag */
$channel_xml = $xml->addChild( 'channel' );

/* Channel XML array */
$channel_array = array(
	$channel_title => 'title',
	$channel_link => 'link',
	$channel_language => 'language',
	$channel_copyright => 'copyright',
	$channel_author => 'xlmns:itunes:author',
	$channel_explicit => 'xlmns:itunes:explicit',
	$channel_keywords => 'xlmns:itunes:keywords',
);

/* Add channel array tags as a child to rss tag */
array_walk_recursive( $channel_array, array( $channel_xml, 'addChild' ) );

$summary_xml = $channel_xml->addChild( 'xlmns:itunes:summary' );
add_cdata( $summary_xml, $channel_summary );

$summary_xml = $channel_xml->addChild( 'description' );
add_cdata( $summary_xml, $channel_summary );

$image_xml = $channel_xml->addChild( 'xlmns:itunes:image' );
$image_xml->addAttribute( 'href', $channel_image );

$category_parent = $channel_xml->addChild( 'xlmns:itunes:category' );
$category_parent->addAttribute( 'text', html_entity_decode( $channel_category_parent ) );

$category_child = $category_parent->addChild( 'xlmns:itunes:category' );
$category_child->addAttribute( 'text', html_entity_decode( $channel_category_child ) );

/* Add owner tag and childs */
$owner_xml = $channel_xml->addChild( 'xlmns:itunes:owner' );
$owner_xml->addChild( 'xlmns:itunes:name', $channel_author );
$owner_xml->addChild( 'xlmns:itunes:email', $channel_email );

/* Begin the Loop */
wp_reset_query( );

// WP_Query arguments
$args = array(
	'post_type'				=> 'podcasts',
	'posts_per_page'	=> '-1',
	'order'						=> 'ASC',
);

$the_query = new WP_Query( $args );
if ( $the_query->have_posts( )  ) {
	while ( $the_query->have_posts( ) ) {
		$the_query->the_post( );
		$id = (int) $post->ID;
		$post = get_post($id);

		# Get episode number
		$episode = get_post_meta( $id, 'podcast_episode_number', true );

		/***** ITEM META *****/
		# Item <title>
		$segment_title = htmlspecialchars( sanitize_text_field( get_post_meta( $id, 'segment_1_title', true ) ), ENT_QUOTES );
		$segment_title = 'Episode ' . $episode . ' - ' . $segment_title;

		# Item <itunes:subtitle>
		$segment_subtitle = sanitize_text_field( $post->post_content );
		$segment_subtitle = substr_replace( rtrim( substr( $segment_subtitle, 0, 252 ), ' ' ), '...', 252 );

		# Item <itunes:summary>
		$segment_summary = sanitize_text_field( $post->post_content );

		# Item <pubDate>
		$segment_pubdate = date( DATE_RFC2822, strtotime( get_post_meta( $id, 'segment_1_date', true ) ) );

		# Item <itunes:duration>
		$segment_duration = get_post_meta( $id, 'segment_1_duration', true );

		# Item <itunes:duration>
		$segment_length = get_post_meta( $id, 'segment_1_size', true );

		# Item JW Key
		$segment_key = get_post_meta( $id, 'segment_1_key', true );

		# Item Thumbnail
		$segment_thumb = wp_get_attachment_url( get_option( 'options_podcasts_channel_image' ) );

		/* Add Segment one xml */
		if ( $segment_key ) {

			/* Add item tag as a child to channel tag */
			$item_1 = $channel_xml->addChild( 'item' );

			/**** Set tags as a child to item tag ****/
			$item_1_title = $item_1->addChild( 'title', $segment_title );

			$item_1_subtitle = $item_1->addChild( 'xmlns:itunes:subtitle' );
			add_cdata( $item_1_subtitle, $segment_subtitle );

			$item_1_summary = $item_1->addChild( 'xmlns:itunes:summary' );
			add_cdata( $item_1_summary, $segment_summary );

			$item_1_enclosure = $item_1->addChild( 'enclosure' );
			$item_1_enclosure->addAttribute( 'url', 'http://content.jwplatform.com/videos/' . $segment_key . '.m4a' );
			$item_1_enclosure->addAttribute( 'length', $segment_length );
			$item_1_enclosure->addAttribute( 'type', 'audio/x-m4a' );

			$item_1_guid = $item_1->addChild( 'guid', 'http://content.jwplatform.com/videos/' . $segment_key . '.m4a' );

			$item_1_thumb = $item_1->addChild( 'xlmns:itunes:image' );
			$item_1_thumb->addAttribute( 'href', $segment_thumb );

			$item_1_date = $item_1->addChild( 'pubDate', $segment_pubdate );

			$item_1_duration = $item_1->addChild( 'xmlns:itunes:duration', $segment_duration );
		}
	} // end while;

	/* Restore original Post Data */
	wp_reset_postdata();
	wp_reset_query();
}
/* Print XML */
print $xml->asXML( );
