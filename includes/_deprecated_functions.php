<?php

function fccpod_set_api_keys() {
	if ( is_multisite() ) {
		if ( $jw_api_key = get_site_option( 'jw_api_key' ) ) {
			update_option( 'options_jw_platform_api_key', $jw_api_key );
		}
		if ( $jw_api_secret = get_site_option( 'jw_api_secret' ) ) {
			update_option( 'options_jw_platform_api_secret', $jw_api_secret );
		}
	}
}


function fcc_podcast_feed_info() {
	# Podcasts Feed URL
	$feed_url = site_url().'/?feed=podcasts';
	echo '<a href="'.$feed_url.'" target="_blank">'.$feed_url.'</a>';

	/*$feed_url = site_url().'/?feed=podcasts';
	echo '<p><strong>Feed URL:  </strong><br><a href="'.$feed_url.'" target="_blank">'.$feed_url.'</a></p>';

	if ( $itunes_url = get_option( 'options_itunes_store_url' ) ) {
		echo '<p><strong>iTunes Store URL:</strong><br><a href="'.$itunes_url.'" target="_blank">'.$itunes_url.'</a></p>';
	}

	if ( $googleplay_url = get_option( 'options_google_play_url' ) ) {
		echo '<p><strong>Google Play URL:</strong><br><a href="'.$googleplay_url.'" target="_blank">'.$googleplay_url.'</a></p>';
	}*/

}
