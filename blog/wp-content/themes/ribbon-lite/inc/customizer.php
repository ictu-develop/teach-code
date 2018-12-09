<?php
/**
 * ribbon Theme Customizer.
 *
 * @package Ribbon Lite
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function ribbon_lite_customize_register( $wp_customize ) {

	/*---------------------
	* Theme Options
	----------------------*/
    $wp_customize->add_panel( 'panel_id', array(
        'priority'       => 121,
        'capability'     => 'edit_theme_options',
        'title'          => __('Theme Options', 'ribbon-lite'),
        'description'    => __('MyThemeShop Mission Control Center', 'ribbon-lite'),
    ) ); 

    /***************************************************/
    /*****                 Styling                 ****/
    /**************************************************/
    $wp_customize->add_section( 'ribbon_lite_styling_settings', array(
        'title'      => __('Styling Settings','ribbon-lite'),
        'priority'   => 122,
        'capability' => 'edit_theme_options',
        'panel'      => 'panel_id',
    ) );

    //Layout
    $wp_customize->add_setting('ribbon_lite_layout', array(
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_key',
        'default'           => 'cslayout',
    ));
    $wp_customize->add_control('ribbon_lite_layout', array(
        'settings' => 'ribbon_lite_layout',
        'label'    => __('Sidebar Position', 'ribbon-lite'),
        'section'  => 'ribbon_lite_styling_settings',
        'type'     => 'radio',
        'choices'  => array(
            'cslayout' => __('Right Sidebar','ribbon-lite'),
            'sclayout' => __('Left Sidebar','ribbon-lite'),
        ),
    ));

    //Color Scheme
    $wp_customize->add_setting( 'ribbon_lite_color_scheme', array(
        'default'           => '#EA141F',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ribbon_lite_color_scheme', array(
        'label'    => __('Primary Color Scheme','ribbon-lite'),
        'section'  => 'ribbon_lite_styling_settings',
        'settings' => 'ribbon_lite_color_scheme',
    )) );
    $wp_customize->add_setting( 'ribbon_lite_color_scheme2', array(
        'default'           => '#364956',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ribbon_lite_color_scheme2', array(
        'label'    => __('Secondary Color Scheme','ribbon-lite'),
        'section'  => 'ribbon_lite_styling_settings',
        'settings' => 'ribbon_lite_color_scheme2',
    )) );

    //Full posts
    $wp_customize->add_setting('ribbon_lite_full_posts', array(
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_key',
        'default'           => '0',
    ));
    $wp_customize->add_control('ribbon_lite_full_posts', array(
        'settings' => 'ribbon_lite_full_posts',
        'label'    => __('Posts on Homepage', 'ribbon-lite'),
        'section'  => 'ribbon_lite_styling_settings',
        'type'     => 'radio',
        'choices'  => array(
            '0' => __('Excerpts','ribbon-lite'),
            '1' => __('Full Posts','ribbon-lite'),
        ),
    ));

    /***************************************************/
    /*****               Header                ****/
    /**************************************************/
    $wp_customize->add_section( 'ribbon_lite_header_settings', array(
        'title'      => __('Header','ribbon-lite'),
        'priority'   => 122,
        'capability' => 'edit_theme_options',
        'panel'      => 'panel_id',
    ) );
  
   /***************************************************/
    /*****               pagination                ****/
    /**************************************************/
    $wp_customize->add_section( 'ribbon_lite_pagination_settings', array(
        'title'      => __('Pagination Type','ribbon-lite'),
        'priority'   => 122,
        'capability' => 'edit_theme_options',
        'panel'      => 'panel_id',
    ) );

    $wp_customize->add_setting( 'ribbon_lite_pagination_type', array(
        'default'           => '1',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_key',
    ));

    $wp_customize->add_control(
        new WP_Customize_Control(
            $wp_customize,
            'ribbon_lite_pagination_type',
            array(
                'label'     => __('Pagination Type', 'ribbon-lite'),
                'section'   => 'ribbon_lite_pagination_settings',
                'settings'  => 'ribbon_lite_pagination_type',
                'type'      => 'radio',
                'choices'  => array(
                    '0'   => __('Next/Previous', 'ribbon-lite'),
                    '1'  => __('Numbered', 'ribbon-lite'),
                ),
                'transport' => 'refresh',
            )
        )
    );

    /***************************************************/
    /*****               Footer                     ****/
    /**************************************************/
    $wp_customize->add_section( 'ribbon_lite_footer_settings', array(
        'title'      => __('Footer','ribbon-lite'),
        'priority'   => 122,
        'capability' => 'edit_theme_options',
        'panel'      => 'panel_id',
    ) );

    $wp_customize->add_setting('ribbon_lite_copyright_text', array(
        'default'           => 'Theme by <a href="http://mythemeshop.com/" rel="nofollow">MyThemeShop</a>.',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'wp_kses',
    )); 
    $wp_customize->add_control('ribbon_lite_copyright_text', array(
        'label'    => __('Copyrights Text', 'ribbon-lite'),
        'description' => __('You can change or remove our link from footer and use your own custom text.(You can also use your affiliate link to earn 70% of sales. Ex: https://mythemeshop.com/?ref=username)','ribbon-lite'),
        'section'  => 'ribbon_lite_footer_settings',
        'settings' => 'ribbon_lite_copyright_text',
        'type'     => 'textarea',
    ));

     //  =============================
    //  = Text Input                =
    //  =============================
    $wp_customize->add_section( 'ribbon_single_settings', array(
        'title'      => __('Single Post Settings','ribbon-lite'),
        'priority'   => 122,
        'capability' => 'edit_theme_options',
        'panel'      => 'panel_id',
    ) );

    //Breadcrumb
    $wp_customize->add_setting('ribbon_lite_single_breadcrumb_section', array(
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_key',
        'transport'         => 'refresh',
        'default'           => '1',
    ));
    $wp_customize->add_control('ribbon_lite_single_breadcrumb_section', array(
        'label'    => __('Breadcrumb Section', 'ribbon-lite'),
        'section'  => 'ribbon_single_settings',
        'settings' => 'ribbon_lite_single_breadcrumb_section',
        'type'     => 'radio',
        'choices'  => array(
            '0' => __('OFF', 'ribbon-lite'),
            '1' => __('ON', 'ribbon-lite'),
        ),
    ));

    //Tags
    $wp_customize->add_setting('ribbon_lite_single_tags_section', array(
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_key',
        'transport'         => 'refresh',
        'default'           => '1',
    ));
    $wp_customize->add_control('ribbon_lite_single_tags_section', array(
        'label'    => __('Tags Section', 'ribbon-lite'),
        'section'  => 'ribbon_single_settings',
        'settings' => 'ribbon_lite_single_tags_section',
        'type'     => 'radio',
        'choices'  => array(
            '0' => __('OFF', 'ribbon-lite'),
            '1' => __('ON', 'ribbon-lite'),
        ),
    ));

    //Related Posts
    $wp_customize->add_setting('ribbon_lite_relatedposts_section', array(
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_key',
        'transport'         => 'refresh',
        'default'           => '1',
    ));
    $wp_customize->add_control('ribbon_lite_relatedposts_section', array(
        'label'    => __('Related Posts Section', 'ribbon-lite'),
        'section'  => 'ribbon_single_settings',
        'settings' => 'ribbon_lite_relatedposts_section',
        'type'     => 'radio',
        'choices'  => array(
            '0' => __('OFF', 'ribbon-lite'),
            '1' => __('ON', 'ribbon-lite'),
        ),
    ));

    //Author Box
    $wp_customize->add_setting('ribbon_lite_authorbox_section', array(
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_key',
        'transport'         => 'refresh',
        'default'           => '1',
    ));
    $wp_customize->add_control('ribbon_lite_authorbox_section', array(
        'label'    => __('Author box Section', 'ribbon-lite'),
        'section'  => 'ribbon_single_settings',
        'settings' => 'ribbon_lite_authorbox_section',
        'type'     => 'radio',
        'choices'  => array(
            '0' => __('OFF', 'ribbon-lite'),
            '1' => __('ON', 'ribbon-lite'),
        ),
    ));

    $wp_customize->get_setting( 'blogname' )->transport                              = 'postMessage';
    $wp_customize->get_setting( 'blogdescription' )->transport                       = 'postMessage';
    $wp_customize->get_setting( 'header_textcolor' )->transport                      = 'postMessage';
}
add_action( 'customize_register', 'ribbon_lite_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function ribbon_lite_customize_preview_js() {
	wp_enqueue_script( 'ribbon_lite_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'ribbon_lite_customize_preview_js' );
