<?php
/**
 * Podcasts Post single.php - Featured Image
 *
 * Filters and replaced the Featured Image with the Podcast Video on the Post page.
 * @since 1.16.07.01
 * @version 1.16.10.05
 */
function jw_featured_image( $html, $post_id, $post_thumbnail_id, $size, $attr ) {
	if ( is_singular( 'podcasts' ) ) {
		$post_id = $GLOBALS['post']->ID;

		$segment_jw_key = get_post_meta( $post_id, 'segment_1_key', true );
		$featured_image = wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ), 'large' )[0];

		// Get Video Embed
		$jw_video_embed = '
		<script type="text/javascript" src="//content.jwplatform.com/libraries/XmRneLwC.js"></script>
		<div id="'. $segment_jw_key .'">Loading the player...</div>
		<script type="text/javascript">
		var playerInstance = jwplayer("'. $segment_jw_key .'");
		playerInstance.setup({
			file: "//content.jwplatform.com/videos/'. $segment_jw_key .'.mp4",
			image: "'. $featured_image .'",
			autostart: false
		});
		</script>';

		$html = $jw_video_embed . $html;
	}

	return $html;
}
add_filter( 'post_thumbnail_html', 'jw_featured_image', 200, 5 );

//image: "http://assets-jpcust.jwpsrv.com/thumbs/'. $segment_jw_key .'.jpg",

/*--------------------------------------------------------------
# Template Functions (currently deprecated/not used)
--------------------------------------------------------------*/

/*
 Template fallback:
 You can do this with the template_redirect hook.
 Here's my code to manually replace the template for a custom post type
 with one in the theme if there isn't one in the template folder.
 Put this in your plugin file and then put a folder underneath your plugin
 called themefiles with your default theme files.
*/

/**
 * Template Redirect
 *
 * Enable by default, option to disable in settings page.
 * @since 0.16.02.11
 * @version 1.16.05.26
 */
function fccpod_theme_redirect() {
	global $wp;
	$plugindir = plugin_dir_path( __FILE__ );
	# Radio Page
	if ( 'podcasts' == $wp->query_vars['pagename'] ) {
		$templatefilename = 'page-podcasts.php'; // $templatefilename = 'page-somepagename.php';
		if ( file_exists( TEMPLATEPATH . '/' . $templatefilename ) ) {
			$return_template = TEMPLATEPATH . '/' . $templatefilename;
		} else {
			$return_template = $plugindir . '/templates/' . $templatefilename;
		}
		do_theme_redirect( $return_template );
	}
}

if ( ! get_option( 'options_radio_page_toggle' ) ) {
	//add_action( 'template_redirect', 'fccpod_theme_redirect' );
}

function do_theme_redirect( $url ) {
	global $post, $wp_query;
	if ( have_posts() ) {
		include( $url );
		die();
	} else {
		$wp_query->is_404 = true;
	}
}

/**
 * Podcasts Post single.php - Content (currently deprecated/not used)
 *
 * Filters the content of single.php for podcasts posts.
 * @since 0.16.02.11
 * @version 1.16.06.28
 */
function jwplayer_before_content( $content ) {

	if ( is_singular( 'podcasts' ) ) {
		$id = $GLOBALS['post']->ID;
		//Get Segment Key
		$segment_jw_key = get_post_meta( $id, 'segment_1_key', true );
		//Get Video Embed
		$jw_video_embed = '
		<script type="text/javascript" src="//content.jwplatform.com/libraries/XmRneLwC.js"></script>
		<div id="'. $segment_jw_key .'">Loading the player...</div>
		<script type="text/javascript">
		var playerInstance = jwplayer("'. $segment_jw_key .'");
		playerInstance.setup({
			file: "//content.jwplatform.com/videos/'. $segment_jw_key .'.mp4",
			image: "http://assets-jpcust.jwpsrv.com/thumbs/'. $segment_jw_key .'.jpg",
			autostart: false
		});
		</script>';
		$content = $jw_video_embed . $content;
	}
	return $content;
}
//add_filter( 'the_content', 'jwplayer_before_content' );
