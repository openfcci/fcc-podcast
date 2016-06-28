<?php

/**
* Add Options Page
* Documentation: http://www.advancedcustomfields.com/resources/options-page/
*/
if( function_exists('acf_add_options_page') ) {


  # Plugin Settings Page
  acf_add_options_sub_page(array(
    'page_title' 	=> 'Podcast Plugin Settings',
    'menu_title'	=> 'Podcast Plugin Settings',
    'parent_slug'	=> 'options-general.php',
  ));

}

#Validate the api key and secret. If it returns null, an admine notice will notify the user. Code is in admin-notices.php
function fccpod_set_validation_boolean(){
	$api_validation = fccpod_jw_account_verify_api_key_secret();

	if($api_validation){
		update_option( 'fccpod_jw_api_authorized', 1);
	}else{
		update_option( 'fccpod_jw_api_authorized', 0);
	}
}

add_action('acf/save_post', 'fccpod_set_validation_boolean', 20);
