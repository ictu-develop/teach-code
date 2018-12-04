<?php
/**
 * Layout Functions which enhance the theme by hooking into WordPress
 *
 * @package my_vcard_resume
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}


if( !function_exists( 'my_vcard_resume_theme_header_nav' ) ):

	function my_vcard_resume_theme_header_nav(){
	?>
        <header class="header">
        <div class="top-menu">
            <?php
                wp_nav_menu( array(
                    'theme_location'  => 'primary',
                    'depth'	          => 3, // 1 = no dropdowns, 2 = with dropdowns.
                    'container'       => 'div',
                    'container'		  => false,
                    'container_class' => 'collapse navbar-collapse',
                    'container_id'    => 'bs-example-navbar-collapse-1',
                    'menu_class'      => 'navbar-nav mr-auto',
                    'fallback_cb'     => 'WP_Bootstrap_Navwalker::fallback',
                    'walker'          => new WP_Bootstrap_Navwalker(),
                ) );
            ?>
        </div>
        </header>
     <?php
	}
	add_action( 'my_vcard_resume_theme_header', 'my_vcard_resume_theme_header_nav',10 );

endif;


if( !function_exists( 'my_vcard_resume_theme_vcard_profile' ) ):

	function my_vcard_resume_theme_vcard_profile(){
	?>
    <div class="card-started" id="home-card">
        <div class="slide" style="background-image: url(<?php echo esc_url( get_header_image() ); ?>);"></div>
    	<div class="image">
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
        <?php if( function_exists( 'the_custom_logo' ) && get_custom_logo() != "" ):
			the_custom_logo();
		else: ?>
        	<img src="<?php echo esc_url( get_theme_file_uri( '/assets/image/dummy-profile-pic-300x300.jpg' ) );?>" alt="" />
        <?php endif;?>
       	</a>

        </div>

        <!-- profile titles -->
        <div class="title">
            <?php
            if (is_user_logged_in()){
                echo '<p class="display-name">'.htmlspecialchars($_COOKIE['username']).'</p>';
                echo '<p class="a-login-logout"><a href="http://localhost/web-teach-code/blog/wp-login.php?action=logout">Thoát</a></p>';
            } else{
                echo '<style>
                        .a-login-logout {
                            font-size: 13px;
                            position: relative;
                            margin-top: -5px;
                        }
                        </style>';
               echo '<p class="a-login-logout"><a href="http://localhost/web-teach-code/blog/wp-login.php">Đăng nhập</a></p>';
            }
            ?></div>
        <?php //$description = get_bloginfo( 'description', 'display' );
        //if ( $description || is_customize_preview() ) : ?>
        <div class="subtitle"><?php //echo esc_html($description); ?></div>
        <?php //endif; ?>


        <!-- profile socials -->
        <div class="social">
        	<?php if( get_theme_mod( 'facebook_link' ) != "" ):?>
             	<a target="_blank" href="<?php echo esc_url( get_theme_mod( 'facebook_link' ) );?>"><i class="fa fa-facebook-square" aria-hidden="true"></i></a>
            <?php endif;?>
           <?php if( get_theme_mod( 'twitter_link' ) != "" ):?>
             	<a target="_blank" href="<?php echo esc_url( get_theme_mod( 'twitter_link' ) );?>"><i class="fa fa-twitter-square" aria-hidden="true"></i></a>
            <?php endif;?>
            <?php if( get_theme_mod( 'pinterest_link' ) != "" ):?>
             	<a target="_blank" href="<?php echo esc_url( get_theme_mod( 'pinterest_link' ) );?>"><i class="fa fa-pinterest-square" aria-hidden="true"></i></a>
            <?php endif;?>
            <?php if( get_theme_mod( 'linkedin_link' ) != "" ):?>
             	<a target="_blank" href="<?php echo esc_url( get_theme_mod( 'linkedin_link' ) );?>"><i class="fa fa-linkedin-square" aria-hidden="true"></i></a>
            <?php endif;?>



        </div>

		 <?php

            /**
            * Hook - my_vcard_resume_theme_credit.
            *
            * @hooked my_vcard_resume_theme_credit - 10
            */
            do_action( 'my_vcard_resume_theme_credit' );

        ?>


        <!-- profile buttons -->
        <div class="lnks">
       		<?php if( get_theme_mod( 'downloadable_cv' ) != "" ):?>
            <a href="<?php echo esc_url( get_theme_mod( 'downloadable_cv' ) );?>" class="lnk" target="_blank">
                <span class="text"><?php echo esc_html('Download CV','my-vcard-resume');?></span>
                <span class="ion ion-archive"></span>
            </a>
            <?php endif;?>
            <?php if( get_theme_mod( 'downloadable_vcard' ) != "" ):?>
            <a href="<?php echo esc_url( get_theme_mod( 'downloadable_vcard' ) );?>" class="lnk discover" target="_blank">
                <span class="text"><?php echo esc_html('Contact Me','my-vcard-resume');?></span>
                <span class="arrow"></span>
            </a>
            <?php endif;?>
        </div>

    </div>
     <?php
	}
	add_action( 'my_vcard_resume_theme_header', 'my_vcard_resume_theme_vcard_profile',20 );

endif;


if( !function_exists('my_vcard_resume_theme_page_wrp_start') ):

	function my_vcard_resume_theme_page_wrp_start(){
		echo '<div class="card-inner blog" id="blog-card">
				<div class="card-wrap">';
	}
	add_action( 'my_vcard_resume_theme_page_wrp_start', 'my_vcard_resume_theme_page_wrp_start',10 );

endif;

if( !function_exists('my_vcard_resume_theme_page_wrp_end') ):
	function my_vcard_resume_theme_page_wrp_end(){
		echo '</div>
			</div>';
	}
	add_action( 'my_vcard_resume_theme_page_wrp_end', 'my_vcard_resume_theme_page_wrp_end',30 );
endif;



/*-----------------------------------------
* FOOTER
*----------------------------------------*/


if( !function_exists('my_vcard_resume_theme_credit') ){
	/**
	*
	* @since 1.0.0
	*/
	function my_vcard_resume_theme_credit(){
	?>


    <div class="footer-copyright">

            <a href="<?php /* translators:straing */ //echo esc_url( esc_html__( 'https://wordpress.org/', 'my-vcard-resume' ) ); ?>"><?php /* translators:straing */ // printf( esc_html__( 'Proudly powered by %s .', 'my-vcard-resume' ), 'WordPress' ); ?></a>

            <?php
            //printf( /* translators:straing */  esc_html__( 'Theme: %1$s by %2$s.', 'my-vcard-resume' ), 'My vCard Resume', '<a href="' . esc_url( __( 'https://athemeart.com/', 'my-vcard-resume' ) ) . '" target="_blank">' . esc_html__( 'aThemeArt', 'my-vcard-resume' ) . '</a>' ); ?>
    </div>


    <?php
	}
}
add_action( 'my_vcard_resume_theme_credit', 'my_vcard_resume_theme_credit', 10 );