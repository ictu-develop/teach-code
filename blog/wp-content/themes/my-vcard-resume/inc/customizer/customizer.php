<?php 

/**
 * my_vcard_resume Theme Customizer.
 *
 * @package my_vcard_resume
 */


/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function my_vcard_resume_customize_register( $wp_customize ) {

	// Load custom controls.
	require get_template_directory() . '/inc/customizer/core/control.php';

	

	
	// Register custom section types.
	$wp_customize->register_section_type( 'my_vcard_resume_Customize_Section_Upsell' );

	// Register sections.
	$wp_customize->add_section(
		new my_vcard_resume_Customize_Section_Upsell(
			$wp_customize,
			'theme_upsell',
			array(
				'title'    => esc_html__( 'My vCard Resume ', 'my-vcard-resume' ),
				'pro_text' => esc_html__( 'Upgrade To Pro', 'my-vcard-resume' ),
				'pro_url'  => 'https://athemeart.com/downloads/my-v-card-resume/',
				'priority'  => 1,
			)
		)
	);

}
add_action( 'customize_register', 'my_vcard_resume_customize_register' );


/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 *
 * @since 1.0.0
 */

function my_vcard_resume_customizer_css() {
	
	wp_enqueue_script( 'my_vcard_resume_customize_controls', get_template_directory_uri() . '/inc/customizer/assets/js/customizer-admin.js', array( 'customize-controls' ) );
	wp_enqueue_style( 'my_vcard_resume_customize_controls', get_template_directory_uri() . '/inc/customizer/assets/css/customizer-controll.css' );
	
}
add_action( 'customize_controls_enqueue_scripts', 'my_vcard_resume_customizer_css',0 );


