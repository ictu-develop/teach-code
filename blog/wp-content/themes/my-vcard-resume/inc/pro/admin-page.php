<?php
/**
 * my_vcard_resume Admin Class.
 *
 * @author  aThemeArt
 * @package my_vcard_resume
 * @since   1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'my_vcard_resume_Admin' ) ) :

/**
 * my_vcard_resume_Admin Class.
 */
class my_vcard_resume_Admin {
	/**
	 * @var striang
	 */
	protected $prourl = null;

	/**
	 * Constructor.
	 */
	public function __construct() {
		add_action( 'admin_menu', array( $this, 'admin_menu' ) );
		add_action( 'wp_loaded', array( __CLASS__, 'hide_notices' ) );
		add_action( 'load-themes.php', array( $this, 'admin_notice' ) );
		$this->prourl = apply_filters( 'my_vcard_resume_pro_theme_url',esc_url( 'https://athemeart.com/downloads/my-v-card-resume/' ));
	}

	/**
	 * Add admin menu.
	 */
	public function admin_menu() {
		$theme = wp_get_theme( get_template() );

		$page = add_theme_page( esc_attr__( 'Getting Started My vCard Resume', 'my-vcard-resume' ) , 
		apply_filters( 'my_vcard_resume_getting_started', esc_attr__( 'Getting Started My vCard Resume', 'my-vcard-resume' )), 
		'activate_plugins', 
		'welcome', array( $this, 'welcome_screen' ) );
		
		add_action( 'admin_print_styles-' . $page, array( $this, 'enqueue_styles' ) );
	}

	/**
	 * Enqueue styles.
	 */
	public function enqueue_styles() {

		wp_enqueue_style( 'my_vcard_resume-welcome', get_template_directory_uri() . '/inc/pro/welcome.css', array(), '1.0' );
	}

	/**
	 * Add admin notice.
	 */
	public function admin_notice() {
		global $pagenow;

		wp_enqueue_style( 'my_vcard_resume-message', get_template_directory_uri() . '/inc/pro/message.css', array(), '1.0' );

		// Let's bail on theme activation.
		if ( 'themes.php' == $pagenow && isset( $_GET['activated'] ) ) {
			add_action( 'admin_notices', array( $this, 'welcome_notice' ) );
			update_option( 'my_vcard_resume_admin_notice_welcome', 1 );

		// No option? Let run the notice wizard again..
		} elseif( ! get_option( 'my_vcard_resume_admin_notice_welcome' ) ) {
			add_action( 'admin_notices', array( $this, 'welcome_notice' ) );
		}
	}

	/**
	 * Hide a notice if the GET variable is set.
	 */
	public static function hide_notices() {
		if ( isset( $_GET['my_vcard_resume-hide-notice'] ) && isset( $_GET['_my_vcard_resume_notice_nonce'] ) ) {
			if ( ! wp_verify_nonce( wp_unslash($_GET['_my_vcard_resume_notice_nonce']), 'my_vcard_resume_hide_notices_nonce' ) ) {
				/* translators: %s: plugin name. */
				wp_die( esc_html__( 'Action failed. Please refresh the page and retry.', 'my-vcard-resume' ) );
			}

			if ( ! current_user_can( 'manage_options' ) ) 
			/* translators: %s: plugin name. */{
				wp_die( esc_html__( 'Cheatin&#8217; huh?', 'my-vcard-resume' ) );
			}

			$hide_notice = sanitize_text_field( wp_unslash( $_GET['my_vcard_resume-hide-notice'] ) );
			update_option( 'my_vcard_resume_admin_notice_' . $hide_notice, 1 );
		}
	}

	/**
	 * Show welcome notice.
	 */
	public function welcome_notice() {
		?>
		<div id="message" class="updated cresta-message">
			<a class="cresta-message-close notice-dismiss" href="<?php echo esc_url( wp_nonce_url( remove_query_arg( array( 'activated' ), add_query_arg( 'my_vcard_resume-hide-notice', 'welcome' ) ), 'my_vcard_resume_hide_notices_nonce', '_my_vcard_resume_notice_nonce' ) ); ?>"><?php  /* translators: %s: plugin name. */ esc_html_e( 'Dismiss', 'my-vcard-resume' ); ?></a>
			<p><?php printf( /* translators: %s: plugin name. */  esc_html__( 'Welcome! Thank you for choosing My vCard Resume! To fully take advantage of the best our theme can offer please make sure you visit our %1$swelcome page%2$s.', 'my-vcard-resume' ), '<a href="' . esc_url( admin_url( 'themes.php?page=welcome' ) ) . '">', '</a>' ); ?></p>
			<p class="submit">
				<a class="button-secondary" href="<?php echo esc_url( admin_url( 'themes.php?page=welcome' ) ); ?>"><?php echo apply_filters( 'my_vcard_resume_getting_started', esc_html__( 'Getting Started My vCard Resume', 'my-vcard-resume' )); ?></a>
			</p>
		</div>
		<?php
	}

	/**
	 * Intro text/links shown to all about pages.
	 *
	 * @access private
	 */
	private function intro() {
		$theme = wp_get_theme( get_template() );
		
		?>
		<div class="cresta-theme-info">
				<h1>
					<?php esc_html_e('About', 'my-vcard-resume'); ?>
					<?php echo esc_html( $theme->get( 'Name' )) ." ". esc_html( $theme->get( 'Version' ) ); ?>
				</h1>

			<div class="welcome-description-wrap">
				<div class="about-text"><?php echo esc_html( $theme->display( 'Description' ) ); ?>
				<p class="cresta-actions">
					<a href="<?php echo esc_url( $this->prourl ); ?>" class="button button-secondary" target="_blank"><?php esc_html_e( 'Theme Info', 'my-vcard-resume' ); ?></a>

					<a href="<?php echo esc_url( apply_filters( 'my_vcard_resume_pro_demo_url', 'https://athemeart.com/demo/my-vcard-resume/' ) ); ?>" class="button button-secondary docs" target="_blank"><?php esc_html_e( 'View Demo', 'my-vcard-resume' ); ?></a>

					<a href="<?php echo esc_url( $this->prourl ); ?>" class="button button-primary docs" target="_blank"><?php esc_html_e( 'View PRO version Demo', 'my-vcard-resume' ); ?></a>

					<a href="<?php echo esc_url( 'http://wordpress.org/support/view/theme-reviews/my_vcard_resume?#postform' ); ?>" class="button button-secondary docs" target="_blank"><?php esc_html_e( 'Rate this theme', 'my-vcard-resume' ); ?></a>
				</p>
				</div>

				<div class="cresta-screenshot">
					<img src="<?php echo esc_url( get_template_directory_uri() ) . '/screenshot.png'; ?>" />
				</div>
			</div>
		</div>

		<h2 class="nav-tab-wrapper">
			
			<a class="nav-tab <?php if ( isset( $_GET['tab'] ) && $_GET['tab'] == 'free_vs_pro' ) echo 'nav-tab-active'; ?>" href="<?php echo esc_url( admin_url( add_query_arg( array( 'page' => 'welcome', 'tab' => 'free_vs_pro' ), 'themes.php' ) ) ); ?>">
				<?php esc_html_e( 'Free Vs PRO', 'my-vcard-resume' ); ?>
			</a>
			<a class="nav-tab <?php if ( isset( $_GET['tab'] ) && $_GET['tab'] == 'changelog' ) echo 'nav-tab-active'; ?>" href="<?php echo esc_url( admin_url( add_query_arg( array( 'page' => 'welcome', 'tab' => 'changelog' ), 'themes.php' ) ) ); ?>">
				<?php esc_html_e( 'Changelog', 'my-vcard-resume' ); ?>
			</a>
            
          
            
            
		</h2>
		<?php
	}

	/**
	 * Welcome screen page.
	 */
	public function welcome_screen() {
			
		$tabs_data = isset( $_GET['tab'] ) ? sanitize_title( wp_unslash($_GET['tab']) ) : '';
		$current_tab = empty( $tabs_data ) ? /* translators: About. */ esc_html('about','my-vcard-resume') : $tabs_data;

		// Look for a {$current_tab}_screen method.
		if ( is_callable( array( $this, $current_tab . '_screen' ) ) ) {
			return $this->{ $current_tab . '_screen' }();
		}

		// Fallback to about screen.
		return $this->about_screen();
	}

	/**
	 * Output the about screen.
	 */
	public function about_screen() {
		$theme = wp_get_theme( get_template() );
		?>
		<div class="wrap about-wrap">

			<?php $this->intro(); ?>

			<div class="changelog point-releases">
				<div class="under-the-hood two-col">
					<div class="col">
						<h4><?php esc_html_e( 'Theme Customizer', 'my-vcard-resume' ); ?></h4>
						<p><?php esc_html_e( 'All Theme Options are available via Customize screen.', 'my-vcard-resume' ) ?></p>
						<p><a href="<?php echo esc_url( admin_url( 'customize.php' ) ); ?>" class="button button-secondary"><?php /* translators: %s: plugin name. */ esc_html_e( 'Customize', 'my-vcard-resume' ); ?></a></p>
					</div>

					<div class="col">
						<h4><?php esc_html_e( 'Got theme support question?', 'my-vcard-resume' ); ?></h4>
						<p><?php esc_html_e( 'Please put it in our support forum.', 'my-vcard-resume' ) ?></p>
						<p><a target="_blank" href="<?php echo esc_url( 'https://athemeart.com/dwqa-questions/' ); ?>" class="button button-secondary"><?php esc_html_e( 'Support', 'my-vcard-resume' ); ?></a></p>
					</div>

					<div class="col">
						<h4><?php esc_html_e( 'Need more features?', 'my-vcard-resume' ); ?></h4>
						<p><?php esc_html_e( 'Upgrade to PRO version for more exciting features.', 'my-vcard-resume' ) ?></p>
						<p><a target="_blank" href="<?php echo esc_url( $this->prourl ); ?>" class="button button-secondary"><?php esc_html_e( 'Info about PRO version', 'my-vcard-resume' ); ?></a></p>
					</div>

					
				</div>
			</div>

			<div class="return-to-dashboard cresta">
				<?php if ( current_user_can( 'update_core' ) && isset( $_GET['updated'] ) ) : ?>
					<a href="<?php echo esc_url( self_admin_url( 'update-core.php' ) ); ?>">
						<?php is_multisite() ? esc_html_e( 'Return to Updates', 'my-vcard-resume' ) : esc_html_e( 'Return to Dashboard &rarr; Updates', 'my-vcard-resume' ); ?>
					</a> |
				<?php endif; ?>
				<a href="<?php echo esc_url( self_admin_url() ); ?>"><?php is_blog_admin() ? esc_html_e( 'Go to Dashboard &rarr; Home', 'my-vcard-resume' ) : esc_html_e( 'Go to Dashboard', 'my-vcard-resume' ); ?></a>
			</div>
		</div>
		<?php
	}

		/**
	 * Output the changelog screen.
	 */
	public function changelog_screen() {
		global $wp_filesystem;

		?>
		<div class="wrap about-wrap">

			<?php $this->intro(); ?>

			<p class="about-description"><?php esc_html_e( 'View changelog below:', 'my-vcard-resume' ); ?></p>

			<?php
				$changelog_file = apply_filters( 'my_vcard_resume_changelog_file', get_template_directory() . '/readme.txt' );

				// Check if the changelog file exists and is readable.
				if ( $changelog_file && is_readable( $changelog_file ) ) {
					WP_Filesystem();
					$changelog = $wp_filesystem->get_contents( $changelog_file );
					$changelog_list = $this->parse_changelog( $changelog );

					echo wp_kses_post( $changelog_list );
				}
			?>
		</div>
		<?php
	}

	/**
	 * Parse changelog from readme file.
	 * @param  string $content
	 * @return string
	 */
	private function parse_changelog( $content ) {
		$matches   = null;
		$regexp    = '~==\s*Changelog\s*==(.*)($)~Uis';
		$changelog = '';

		if ( preg_match( $regexp, $content, $matches ) ) {
			$changes = explode( '\r\n', trim( $matches[1] ) );

			$changelog .= '<pre class="changelog">';

			foreach ( $changes as $index => $line ) {
				$changelog .= wp_kses_post( preg_replace( '~(=\s*Version\s*(\d+(?:\.\d+)+)\s*=|$)~Uis', '<span class="title">${1}</span>', $line ) );
			}

			$changelog .= '</pre>';
		}

		return wp_kses_post( $changelog );
	}

	/**
	 * Output the free vs pro screen.
	 */
	public function free_vs_pro_screen() {
		?>
		<div class="wrap about-wrap">

			<?php $this->intro(); ?>

			<p class="about-description"><?php esc_html_e( 'Upgrade to PRO version for more exciting features.', 'my-vcard-resume' ); ?></p>

			<table>
				<thead>
					<tr>
						<th class="table-feature-title"><h4><?php esc_html_e('Features', 'my-vcard-resume'); ?></h4></th>
						<th width="25%"><h4><?php esc_html_e('My vCard Resume', 'my-vcard-resume'); ?></h4></th>
						<th width="25%"><h4><?php esc_html_e('My vCard Resume PRO', 'my-vcard-resume'); ?></h4></th>
					</tr>
				</thead>
				<tbody>
                	<tr>
						<td><h4><?php esc_html_e('24/7 Priority Support', 'my-vcard-resume'); ?></h4></td>
						<td><?php esc_html_e('WP forum ( 48 / 5 )', 'my-vcard-resume'); ?></td>
						<td><?php esc_html_e('Own Ticket, email , Skype & Teamviewer ( 24 / 7 )', 'my-vcard-resume'); ?></td>
					</tr>
                     <tr>
						<td><h4><?php esc_html_e(' Theme Customizer ', 'my-vcard-resume'); ?></h4></td>
						<td><?php esc_html_e('lite features Customizer', 'my-vcard-resume'); ?></td>
						<td><?php esc_html_e('Full features Customizer', 'my-vcard-resume'); ?></td>
					</tr>
                     <tr>
						<td><h4><?php esc_html_e('king composer toolkit Addons', 'my-vcard-resume'); ?></h4></td>
						<td><?php esc_html_e('Only KC plugins', 'my-vcard-resume'); ?></td>
						<td><?php esc_html_e('Theme Onw Addons', 'my-vcard-resume'); ?></td>
					</tr>
                  	 <tr>
						<td><h4><?php esc_html_e('unlimited Menu Icon', 'my-vcard-resume'); ?></h4></td>
						<td><span class="dashicons dashicons-no"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
                     <tr>
						<td><h4><?php esc_html_e('unlimited colors', 'my-vcard-resume'); ?></h4></td>
						<td><span class="dashicons dashicons-no"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
                    
                     <tr>
						<td><h4><?php esc_html_e('unlimited Fonts', 'my-vcard-resume'); ?></h4></td>
						<td><span class="dashicons dashicons-no"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
                    <tr>
						<td><h4><?php esc_html_e('Service KC Addons / Shortcode', 'my-vcard-resume'); ?></h4></td>
						<td><span class="dashicons dashicons-no"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
                    
                    <tr>
						<td><h4><?php esc_html_e('Service Section KC Addons / Shortcode', 'my-vcard-resume'); ?></h4></td>
						<td><span class="dashicons dashicons-no"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
                     <tr>
						<td><h4><?php esc_html_e('list styled KC Addons / Shortcode ', 'my-vcard-resume'); ?></h4></td>
						<td><span class="dashicons dashicons-no"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
                    
                    <tr>
						<td><h4><?php esc_html_e('Interests Section KC Addons / Shortcode', 'my-vcard-resume'); ?></h4></td>
						<td><span class="dashicons dashicons-no"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
                    
                    <tr>
						<td><h4><?php esc_html_e('Clients Section KC Addons / Shortcode', 'my-vcard-resume'); ?></h4></td>
						<td><span class="dashicons dashicons-no"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
                    
                    <tr>
						<td><h4><?php esc_html_e('Skills Section KC Addons / Shortcode', 'my-vcard-resume'); ?></h4></td>
						<td><span class="dashicons dashicons-no"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
                    
                    <tr>
						<td><h4><?php esc_html_e('Work Experience Section KC Addons / Shortcode', 'my-vcard-resume'); ?></h4></td>
						<td><span class="dashicons dashicons-no"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
                    
                     <tr>
						<td><h4><?php esc_html_e('Education Section KC Addons / Shortcode', 'my-vcard-resume'); ?></h4></td>
						<td><span class="dashicons dashicons-no"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
                    
                    <tr>
						<td><h4><?php esc_html_e('Works Profolio Section KC Addons / Shortcode', 'my-vcard-resume'); ?></h4></td>
						<td><span class="dashicons dashicons-no"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
                    
                    <tr>
						<td><h4><?php esc_html_e('Testimonials Section KC Addons / Shortcode', 'my-vcard-resume'); ?></h4></td>
						<td><span class="dashicons dashicons-no"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
                    <tr>
						<td><h4><?php esc_html_e('Sidebar Disable / Enable', 'my-vcard-resume'); ?></h4></td>
						<td><span class="dashicons dashicons-no"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
                    <tr>
						<td><h4><?php esc_html_e('Footer Carditis', 'my-vcard-resume'); ?></h4></td>
						<td><span class="dashicons dashicons-no"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
                    
                     <tr>
						<td><h4><?php esc_html_e('You can control overall everything without code', 'my-vcard-resume'); ?></h4></td>
						<td><span class="dashicons dashicons-no"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
                    
					<tr>
						<td></td>
						<td></td>
						<td class="btn-wrapper">
							
							<a href="<?php echo esc_url( $this->prourl ); ?>" class="button button-secondary" target="_blank"><?php esc_html_e( 'More Information', 'my-vcard-resume' ); ?></a>
						</td>
					</tr>
				</tbody>
			</table>

		</div>
		<?php
	}
	
	
	

}

endif;

return new my_vcard_resume_Admin();
