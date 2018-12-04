<?php
/**
 * Functions which enhance the theme by hooking into WordPress kirki plugins
 *
 * @package my_vcard_resume
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}


if ( class_exists( 'Kirki' ) ) :
/**
 * Class my_vcard_resume_Kirki
 */
class my_vcard_resume_Kirki extends Kirki {
	
	/**
	* @var striang
	*/
	protected $panel;
	
	/**
	* @var striang
	*/
	protected $config_id;
	
	/**
	 * The single instance of the class
	 *
	 * @var ATA_WC_Variation_Swatches_Admin
	 */
	protected static $instance = null;

	/**
	 * Main instance
	 *
	 * @return ATA_WC_Variation_Swatches_Admin
	 */
	public static function instance() {
		if ( null == self::$instance ) {
			self::$instance = new self();
		}

		return self::$instance;
	}
	
	/**
	 * Class constructor.
	 */
	public function __construct() {
			$this->panel ='my_vcard_resume';
			$this->config_id ='my_vcard_resume_config_id';
			
			$this->my_vcard_resume_panel();
			$this->my_vcard_resume_social_media();
			$this->my_vcard_resume_download_cv();
	}
	
	public function my_vcard_resume_panel(){
		
			$this->add_panel( $this->panel, array(
				'priority'    => 30,
				'title'       => esc_attr__( 'Theme Options', 'my-vcard-resume' ),
			) );
			
	}
	public function my_vcard_resume_download_cv(){
			$this->add_section( 'download_cv', array(
				'title'          => esc_attr__( ' CV / vCard', 'my-vcard-resume' ),
				'panel'          => $this->panel,
				'priority'       => 170,
			) );
			$this->add_field( $this->config_id, array(
				'type'        => 'upload',
				'settings'    => 'downloadable_cv',
				'label'       => esc_attr__( 'Select Your CV', 'my-vcard-resume' ),
				'description' => esc_attr__( 'Choose Downloadable CV ( PDF, DOCX , DOC ETC) ', 'my-vcard-resume' ),
				'section'     => 'download_cv',
				'priority'    => 10,
			));
			
			$this->add_field( $this->config_id, array(
				'type'        => 'upload',
				'settings'    => 'downloadable_vcard',
				'label'       => esc_attr__( 'Select Your vCard', 'my-vcard-resume' ),
				'description' => __( 'You can generator from  <a href="http://vcardmaker.com" target="_blank">www.vcardmaker.com</a>', 'my-vcard-resume' ),
				'section'     => 'download_cv',
				'priority'    => 10,
			));
			
	}
	public function my_vcard_resume_social_media(){
			$this->add_section( 'social_media', array(
				'title'          => esc_attr__( 'Social Media', 'my-vcard-resume' ),
				'panel'          => $this->panel,
				'priority'       => 160,
			) );
			$this->add_field( $this->config_id, array(
				'type'        => 'text',
				'settings'    => 'facebook_link',
				'label'       => esc_attr__( 'Facebook', 'my-vcard-resume' ),
				'section'     => 'social_media',
				'default'     => '#',
				'priority'    => 10,
			));

			$this->add_field( $this->config_id, array(
				'type'        => 'text',
				'settings'    => 'twitter_link',
				'label'       => esc_attr__( 'Twitter', 'my-vcard-resume' ),
				'section'     => 'social_media',
				'default'     => '#',
				'priority'    => 10,
			));

			$this->add_field( $this->config_id, array(
				'type'        => 'text',
				'settings'    => 'pinterest_link',
				'label'       => esc_attr__( 'Pinterest', 'my-vcard-resume' ),
				'section'     => 'social_media',
				'default'     => '',
				'priority'    => 10,
			));

			$this->add_field( $this->config_id, array(
				'type'        => 'text',
				'settings'    => 'linkedin_link',
				'label'       => esc_attr__( 'LinkedIn', 'my-vcard-resume' ),
				'section'     => 'social_media',
				'default'     => '',
				'priority'    => 10,
			));

		
	}
	
	
	
	
}
my_vcard_resume_Kirki::instance();

endif;