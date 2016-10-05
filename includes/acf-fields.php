<?php
/**
 * ACF-5 (Pro) Fields
 *
 * Last Updated: 02-09-2016
 */

 // if(the_field('podcasts_channel_title', 'option')){
	//
 // 	$channel_title = get_field('podcasts_channel_title', 'option');

 // }

if( function_exists('acf_add_local_field_group') ):

acf_add_local_field_group( array (
	'key' => 'group_56ba10e3b4608',
	'title' => 'Podcast Episode',
	'fields' => array (
		array (
			'key' => 'field_56ba1122c5049',
			'label' => 'Episode Number',
			'name' => 'podcast_episode_number',
			'type' => 'number',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => 100,
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => '',
			'prepend' => '',
			'append' => '',
			'min' => 0,
			'max' => '',
			'step' => '',
			'readonly' => 0,
			'disabled' => 0,
		),
	),
	'location' => array (
		array (
			array (
				'param' => 'post_type',
				'operator' => '==',
				'value' => 'podcasts',
			),
		),
	),
	'menu_order' => 0,
	'position' => 'side',
	'style' => 'seamless',
	'label_placement' => 'top',
	'instruction_placement' => 'label',
	'hide_on_screen' => array (
	0 => 'the_content',
),
	'active' => 1,
	'description' => '',
));

/*
acf_add_local_field_group(array (
	'key' => 'group_56a66516decbd',
	'title' => 'JW Platform API',
	'fields' => array (
		array (
			'key' => 'field_56a66538e7b1d',
			'label' => 'Key',
			'name' => 'jw_platform_api_key',
			'type' => 'text',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => 50,
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => '',
			'prepend' => '',
			'append' => '',
			'maxlength' => '',
			'readonly' => 0,
			'disabled' => 0,
		),
		array (
			'key' => 'field_56a66561e7b1e',
			'label' => 'Secret',
			'name' => 'jw_platform_api_secret',
			'type' => 'text',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => 50,
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => '',
			'prepend' => '',
			'append' => '',
			'maxlength' => '',
			'readonly' => 0,
			'disabled' => 0,
		),
	),
	'location' => array (
		array (
			array (
				'param' => 'options_page',
				'operator' => '==',
				'value' => 'acf-options-podcast-settings',
			),
		),
	),
	'menu_order' => 1,
	'position' => 'normal',
	'style' => 'default',
	'label_placement' => 'top',
	'instruction_placement' => 'label',
	'hide_on_screen' => array (
	0 => 'the_content',
),
	'active' => 1,
	'description' => '',
));
*/

acf_add_local_field_group(array (
	'key' => 'group_56a1462b537dd',
	'title' => 'Podcast Information',
	'fields' => array (
		array (
			'key' => 'field_569d557483373',
			'label' => 'JW Player Key',
			'name' => 'segment_1_key',
			'type' => 'text',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => 25,
				'class' => '',
				'id' => 'acf-field-segment_1_key',
			),
			'default_value' => '',
			'placeholder' => 'R4wsa1fA',
			'prepend' => '',
			'append' => '',
			'maxlength' => 8,
			'readonly' => 0,
			'disabled' => 0,
		),
		array (
			'key' => 'field_569d562ab7ab2',
			'label' => 'Duration',
			'name' => 'segment_1_duration',
			'type' => 'text',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => 25,
				'class' => '',
				'id' => 'acf-field-segment_1_duration',
			),
			'default_value' => '',
			'placeholder' => '00:00:00',
			'prepend' => '',
			'append' => '',
			'maxlength' => 10,
			'readonly' => 1,
			'disabled' => 0,
		),
		array (
			'key' => 'field_56a15fd15cc62',
			'label' => 'Date',
			'name' => 'segment_1_date',
			'type' => 'text',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => 25,
				'class' => '',
				'id' => 'acf-field-segment_1_date',
			),
			'default_value' => '',
			'placeholder' => '',
			'prepend' => '',
			'append' => '',
			'maxlength' => '',
			'readonly' => 1,
			'disabled' => 0,
		),
		array (
			'key' => 'field_56b284a09b238',
			'label' => 'Size',
			'name' => 'segment_1_size',
			'type' => 'number',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => 25,
				'class' => '',
				'id' => 'acf-field-segment_1_size',
			),
			'default_value' => '',
			'placeholder' => '',
			'prepend' => '',
			'append' => '',
			'min' => 0,
			'max' => '',
			'step' => '',
			'readonly' => 1,
			'disabled' => 0,
		),
		array (
			'key' => 'field_569d52d01c270',
			'label' => 'Podcast Title',
			'name' => 'segment_1_title',
			'type' => 'text',
			'instructions' => 'RSS Feed automatically adds episode number.',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => 'acf-field-segment_1_title',
			),
			'default_value' => '',
			'placeholder' => '',
			'append' => '',
			'maxlength' => 240,
			'readonly' => 0,
			'disabled' => 0,
		),
		array (
		'key' => 'field_569d606c6a39b',
		'label' => 'Description',
		'name' => 'segment_1_description',
		'type' => 'wysiwyg',
		'instructions' => 'Note: 4000 character max.',
		'required' => 0,
		'conditional_logic' => 0,
		'wrapper' => array (
		'width' => '',
		'class' => '',
		'id' => 'segment_1_description',
		),
		'default_value' => '',
		'tabs' => 'all',
		'toolbar' => 'basic',
		'media_upload' => 0,
		),
	),
	'location' => array (
	array (
	array (
				'param' => 'post_type',
				'operator' => '==',
				'value' => 'podcasts',
			),
		),
	),
	'menu_order' => 1,
	'position' => 'normal',
	'style' => 'default',
	'label_placement' => 'top',
	'instruction_placement' => 'field',
	'hide_on_screen' => array (
		0 => 'the_content',
	),
	'active' => 1,
	'description' => '',
));


acf_add_local_field_group(array (
	'key' => 'group_56b375f0dee59',
	'title' => 'Podcast Channel Settings',
	'fields' => array (
		array (
			'key' => 'field_56b3768603937',
			'label' => 'Channel Title',
			'name' => 'podcasts_channel_title',
			'type' => 'text',
			'instructions' => '',
			'required' => 1,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => 'acf-field-podcasts_channel_title',
			),
			'default_value' => 'Northland Outdoors',
			'placeholder' => '',
			'prepend' => '',
			'append' => '',
			'maxlength' => 255,
			'readonly' => 0,
			'disabled' => 0,
		),
		array (
			'key' => 'field_56b3df92769c6',
			'label' => 'Channel Author',
			'name' => 'podcasts_channel_author',
			'type' => 'text',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => 'Forum Communications Company',
			'placeholder' => '',
			'prepend' => '',
			'append' => '',
			'maxlength' => 255,
			'readonly' => 0,
			'disabled' => 0,
		),
		array (
			'key' => 'field_56b3e0ea8991f',
			'label' => 'Channel Image',
			'name' => 'podcasts_channel_image',
			'type' => 'image',
			'instructions' => 'Cover art must be in the JPEG or PNG file formats and in the RGB color space with a minimum size of 1400 x 1400 pixels and a maximum size of 3000 x 3000 pixels. (Required)',
			'required' => 1,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'return_format' => 'url',
			'preview_size' => 'thumbnail',
			'library' => 'all',
			'min_width' => 1400,
			'min_height' => 1400,
			'min_size' => '',
			'max_width' => 3000,
			'max_height' => 3000,
			'max_size' => '',
			'mime_types' => 'png,jpeg',
		),
		array (
			'key' => 'field_56b3e00997d40',
			'label' => 'Channel Summary',
			'name' => 'podcasts_channel_summary',
			'type' => 'textarea',
			'instructions' => '',
			'required' => 1,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => 'This field can be up to 4000 characters.',
			'maxlength' => 4000,
			'rows' => 4,
			'new_lines' => '',
			'readonly' => 0,
			'disabled' => 0,
		),
		array (
			'key' => 'field_56b3dc08c4993',
			'label' => 'Channel Category',
			'name' => 'podcasts_channel_category',
			'type' => 'taxonomy',
			'instructions' => '',
			'required' => 1,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'taxonomy' => 'itunes_categories',
			'field_type' => 'select',
			'allow_null' => 0,
			'add_term' => 0,
			'save_terms' => 0,
			'load_terms' => 0,
			'return_format' => 'object',
			'multiple' => 0,
		),
		array (
			'key' => 'field_56ba1aae2ee8c',
			'label' => 'Channel Keywords',
			'name' => 'podcasts_channel_keywords',
			'type' => 'text',
			'instructions' => 'Enter relevant keywords, separated by a comma. ',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => 'keyword1,keyword2,keyword3',
			'prepend' => '',
			'append' => '',
			'maxlength' => 250,
			'readonly' => 0,
			'disabled' => 0,
		),
		array (
			'key' => 'field_56b3e4791e2b3',
			'label' => 'Channel Link',
			'name' => 'podcasts_channel_link',
			'type' => 'url',
			'instructions' => 'The website link that will appear under "podcast details".',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => 'http://127.0.0.1/areavoices/northlandoutdoors',
			'placeholder' => '',
		),
		array (
			'key' => 'field_56b3e2ce1384a',
			'label' => 'Channel Explicit',
			'name' => 'podcasts_channel_explicit',
			'type' => 'select',
			'instructions' => 'Indicate whether your podcast contains explicit material.',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'choices' => array (
				'clean' => 'No',
				'Yes' => 'Yes',
			),
			'default_value' => array (
				'clean' => 'No',
			),
			'allow_null' => 0,
			'multiple' => 0,
			'ui' => 0,
			'ajax' => 0,
			'placeholder' => '',
			'disabled' => 0,
			'readonly' => 0,
		),
		array (
			'key' => 'field_56ba1d02d1a9b',
			'label' => 'Channel E-mail',
			'name' => 'podcasts_channel_owner_e-mail',
			'type' => 'email',
			'instructions' => '',
			'required' => 1,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => 'bret.amundson@northlandoutdoors.com',
			'placeholder' => 'contactperson@forumcomm.com',
			'prepend' => '',
			'append' => '',
		),
	),
	'location' => array (
		array (
			array (
				'param' => 'options_page',
				'operator' => '==',
				'value' => 'acf-options-podcast-settings',
			),
		),
	),
	'menu_order' => 11,
	'position' => 'normal',
	'style' => 'default',
	'label_placement' => 'top',
	'instruction_placement' => 'label',
	'hide_on_screen' => array (
	0 => 'the_content',
),
	'active' => 1,
	'description' => '',
));

endif;
