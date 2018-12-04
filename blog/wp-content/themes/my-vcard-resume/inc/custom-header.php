<?php
/**
 * Sample implementation of the Custom Header feature
 *
 * You can add an optional custom header image to header.php like so ...
 *
	<?php the_header_image_tag(); ?>
 *
 * @link https://developer.wordpress.org/themes/functionality/custom-headers/
 *
 * @package my_vcard_resume
 */

/**
 * Set up the WordPress core custom header feature.
 *
 * @uses my_vcard_resume_header_style()
 */
function my_vcard_resume_custom_header_setup() {

	add_theme_support( 'custom-header', apply_filters( 'my_vcard_resume_custom_header_args', array(
		'default-image'			 => get_template_directory_uri() . '/assets/image/custom-header.jpg',
		'default-text-color'     => '000000',
		'width'                  => 1000,
		'height'                 => 250,
		'flex-height'            => true,
		'wp-head-callback'       => 'my_vcard_resume_header_style',
	) ) );

	register_default_headers( array(
		'default-image' => array(
		'url' => '%s/assets/image/custom-header.jpg',
		'thumbnail_url' => '%s/assets/image/custom-header.jpg',
		'description' => esc_html__( 'Default Header Image', 'my-vcard-resume' ),
		),
	));


}
add_action( 'after_setup_theme', 'my_vcard_resume_custom_header_setup' );

if ( ! function_exists( 'my_vcard_resume_header_style' ) ) :
	/**
	 * Styles the header image and text displayed on the blog.
	 *
	 * @see my_vcard_resume_custom_header_setup().
	 */
	function my_vcard_resume_header_style() {
		$header_text_color = get_header_textcolor();

		/*
		 * If no custom options for text are set, let's bail.
		 * get_header_textcolor() options: Any hex value, 'blank' to hide text. Default: add_theme_support( 'custom-header' ).
		 */
		if ( get_theme_support( 'custom-header', 'default-text-color' ) === $header_text_color ) {
			return;
		}

		// If we get this far, we have custom styles. Let's do this.
		?>
		<style type="text/css">
		<?php
		// Has the text been hidden?
		if ( ! display_header_text() ) :
			?>
			.card-started .profile .title,
			.card-started .profile .subtitle {
				position: absolute;
				clip: rect(1px, 1px, 1px, 1px);
			}
		<?php
		// If the user has set a custom color for the text use that.
		else :
			?>
			.card-started .profile .title,
			.card-started .profile .subtitle {
				color: #<?php echo esc_attr( $header_text_color ); ?>;
			}
		<?php endif; ?>
		</style>
		<?php
	}
endif;
