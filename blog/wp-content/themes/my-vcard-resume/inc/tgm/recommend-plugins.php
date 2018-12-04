<?php
add_action( 'tgmpa_register', 'my_vcard_resume_register_required_plugins' );

/**
 * Register the required plugins for this theme.
 *
 * In this example, we register five plugins:
 * - one included with the TGMPA library
 * - two from an external source, one from an arbitrary source, one from a GitHub repository
 * - two from the .org repo, where one demonstrates the use of the `is_callable` argument
 *
 * The variables passed to the `tgmpa()` function should be:
 * - an array of plugin arrays;
 * - optionally a configuration array.
 * If you are not changing anything in the configuration array, you can remove the array and remove the
 * variable from the function call: `tgmpa( $plugins );`.
 * In that case, the TGMPA default settings will be used.
 *
 * This function is hooked into `tgmpa_register`, which is fired on the WP `init` action on priority 10.
 */
function my_vcard_resume_register_required_plugins() {
	
	
	$plugins = array(
	
		array(
			'name'      => esc_html__('Kirki', 'my-vcard-resume'),
			'slug'      => 'kirki',
			'required'   => false,
		),
		array(
			'name'      => esc_html__('KingComposer', 'my-vcard-resume'),
			'slug'      => 'kingcomposer',
			'required'   => false,
		),
		array(
			'name'      => esc_html__('WP Subtitle', 'my-vcard-resume'),
			'slug'      => 'wp-subtitle',
			'required'  => false,
		),
		array(
			'name'      => esc_html__('Contact Form 7', 'my-vcard-resume'),
			'slug'      => 'contact-form-7',
			'required'  => false,
		),
		
	);


	/*
	 * Array of configuration settings. Amend each line as needed.
	 *
	 * TGMPA will start providing localized text strings soon. If you already have translations of our standard
	 * strings available, please help us make TGMPA even better by giving us access to these translations or by
	 * sending in a pull-request with .po file(s) with the translations.
	 *
	 * Only uncomment the strings in the config array if you want to customize the strings.
	 */
	$config = array(
		'id'           => 'my-vcard-resume',                 // Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path' => '',                      // Default absolute path to bundled plugins.
		'menu'         => 'tgmpa-install-plugins', // Menu slug.
		'has_notices'  => true,                    // Show admin notices or not.
		'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => false,                   // Automatically activate plugins after installation or not.
		'message'      => '',                      // Message to output right before the plugins table.

	);

	tgmpa( $plugins, $config );
}
