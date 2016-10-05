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
