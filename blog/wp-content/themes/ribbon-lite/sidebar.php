<?php

echo "<style>
        .profile {
        position: initial;
        width: 100%;
        height: auto;
        border: 1px solid #364956;
        border-radius: 4px;
        margin-bottom: 20px;
    }
    .img-profile {
        display: block;
        position: initial;
        width: 24%;
        height: auto;
        margin-left: auto;
        margin-right: auto;
        margin-top: 22px;
    }
    
    .a-login-logout {
        display: inline-block;
        position: initial;
        text-align: center;
        font-weight: bold;
    }
    .username {
        font-size: 19px;
        position: initial;
        display: block;
        text-align: center;
        font-weight: bold;
        margin-top: 12px;
    }
    .email {
        font-size: 13px;
        position: initial;
        display: block;
        text-align: center;
        margin-top: -15px;
        font-weight: bold;
    }
    .fullname {
        font-size: 13px;
        position: initial;
        display: block;
        text-align: center;
        margin-top: -15px;
        font-weight: bold;
    }
    .login-logout {
        text-align: center;
        margin: 10px 10px 10px 10px !important;
    }
</style>";
/**
 * The sidebar containing the main widget area.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Ribbon Lite
 */

$sidebar = ribbon_lite_custom_sidebar(); ?>

<aside class="sidebar c-4-12">
    <div class="profile">
        <?php
            if (is_user_logged_in()) {
                $current_user = wp_get_current_user();
                echo '<img class="img-profile" src="' . get_site_url() . '/wp-content/themes/ribbon-lite/images/ic_user.png">';
                echo '<p class="username">'.$current_user->user_login.'</p>';
                //echo '<p class="fullname">Fullname: '.$current_user->user_lastname.' '.$current_user->first_name.'</p>';
                echo '<p class="email">'.$current_user->user_email.'</p>';
                echo '<p class="login-logout"><a href="'.get_site_url().'/wp-login.php?action=logout" class="a-login-logout">Thoát</a></p>';
            } else {

                echo '<p class="login-logout"><a href="'.get_site_url().'/login" class="a-login-logout">Đăng nhập</a> or <a href="'.get_site_url().'/register" class="a-login-logout">Đăng ký</a></p>';
            }
        ?>
    </div>
	<div id="sidebars" class="sidebar">
		<div class="sidebar_list">
			<?php if ( ! dynamic_sidebar( $sidebar )) : ?>
				<div id="sidebar-search" class="widget">
					<h3><?php _e('Search', 'ribbon-lite'); ?></h3>
					<div class="widget-wrap">
						<?php get_search_form(); ?>
					</div>
				</div>
				<div id="sidebar-archives" class="widget">
					<h3><?php _e('Archives', 'ribbon-lite') ?></h3>
					<div class="widget-wrap">
						<ul>
							<?php wp_get_archives( 'type=monthly' ); ?>
						</ul>
					</div>
				</div>
				<div id="sidebar-meta" class="widget">
					<h3><?php _e('Meta', 'ribbon-lite') ?></h3>
					<div class="widget-wrap">
						<ul>
							<?php wp_register(); ?>
							<li><?php wp_loginout(); ?></li>
							<?php wp_meta(); ?>
						</ul>
					</div>
				</div>
			<?php endif; ?>
		</div>
	</div><!--sidebars-->
</aside>