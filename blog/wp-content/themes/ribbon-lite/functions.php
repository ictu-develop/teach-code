<?php
/**
 * Ribbon Lite functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Ribbon Lite
 */

if ( ! function_exists( 'ribbon_lite_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function ribbon_lite_setup() {
	define( 'MTS_THEME_VERSION', '2.0.8' );
    /*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on ribbon, use a find and replace
	 * to change 'ribbon-lite' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'ribbon-lite', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 150, 150, true );
	add_image_size( 'ribbon-lite-featured', 150, 150, true ); //featured
	add_image_size( 'ribbon-lite-related', 200, 125, true ); //related

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary', 'ribbon-lite' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

    if ( ribbon_lite_is_wc_active() ) {
        add_theme_support( 'woocommerce' );
    }

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'ribbon_lite_custom_background_args', array(
		'default-color' => '#EBEBEB',
		'default-image' => '',
	) ) );
}
endif;
add_action( 'after_setup_theme', 'ribbon_lite_setup' );

function ribbon_lite_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'ribbon_lite_content_width', 678 );
}
add_action( 'after_setup_theme', 'ribbon_lite_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function ribbon_lite_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'ribbon-lite' ),
		'id'            => 'sidebar',
		'description'   => '',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	// Header Ad sidebar
    register_sidebar(array(
        'name' => __('Header Ad', 'ribbon-lite'),
        'description'   => __( '728x90 Ad Area', 'ribbon-lite' ),
        'id' => 'widget-header',
        'before_widget' => '<div id="%1$s" class="widget-header">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));
    
    // First Footer 
    register_sidebar( array(
		'name'          => __( 'Footer 1', 'ribbon-lite' ),
		'description'   => __( 'First footer column', 'ribbon-lite' ),
		'id'            => 'footer-first',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
	) );

	// Second Footer 
    register_sidebar( array(
		'name'          => __( 'Footer 2', 'ribbon-lite' ),
		'description'   => __( 'Second footer column', 'ribbon-lite' ),
		'id'            => 'footer-second',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
	) );

	// Third Footer 
    register_sidebar( array(
		'name'          => __( 'Footer 3', 'ribbon-lite' ),
		'description'   => __( 'Third footer column', 'ribbon-lite' ),
		'id'            => 'footer-third',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
	) );

    if ( ribbon_lite_is_wc_active() ) {
        // Register WooCommerce Shop and Single Product Sidebar
        register_sidebar( array(
            'name' => __('Shop Page Sidebar', 'ribbon-lite' ),
            'description'   => __( 'Appears on Shop main page and product archive pages.', 'ribbon-lite' ),
            'id' => 'shop-sidebar',
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<h3 class="widget-title">',
            'after_title' => '</h3>',
        ) );
        register_sidebar( array(
            'name' => __('Single Product Sidebar', 'ribbon-lite' ),
            'description'   => __( 'Appears on single product pages.', 'ribbon-lite' ),
            'id' => 'product-sidebar',
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<h3 class="widget-title">',
            'after_title' => '</h3>',
        ) );
    }
}
add_action( 'widgets_init', 'ribbon_lite_widgets_init' );

function ribbon_lite_custom_sidebar() {
    // Default sidebar.
    $sidebar = 'sidebar';

    // Woocommerce.
    if ( ribbon_lite_is_wc_active() ) {
        if ( is_shop() || is_product_category() ) {
            $sidebar = 'shop-sidebar';
        }
        if ( is_product() ) {
            $sidebar = 'product-sidebar';
        }
    }

    return $sidebar;
}

/**
 * Enqueue scripts and styles.
 */
function ribbon_lite_scripts() {
	wp_enqueue_style( 'ribbon-lite-style', get_stylesheet_uri() );
    wp_enqueue_script( 'jquery' );

	$handle = 'ribbon-lite-style';

    // WooCommerce
    if ( ribbon_lite_is_wc_active() ) {
        if ( is_woocommerce() || is_cart() || is_checkout() ) {
            wp_enqueue_style( 'woocommerce', get_template_directory_uri() . '/css/woocommerce2.css' );
            $handle = 'woocommerce';
        }
    }

	wp_enqueue_script( 'ribbon-lite-customscripts', get_template_directory_uri() . '/js/customscripts.js', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
	$ribbon_lite_color_scheme = get_theme_mod('ribbon_lite_color_scheme', '#EA141F');
	$ribbon_lite_color_scheme2 = get_theme_mod('ribbon_lite_color_scheme2', '#364956');
	$ribbon_lite_layout = get_theme_mod('ribbon_lite_layout', 'cslayout');
    $header_image = get_header_image();
	$custom_css = "
        #site-header { background-image: url('$header_image'); }
        #tabber .inside li .meta b,footer .widget li a:hover,.fn a,.reply a,#tabber .inside li div.info .entry-title a:hover, #navigation ul ul a:hover,.single_post a, a:hover, .sidebar.c-4-12 .textwidget a, #site-footer .textwidget a, #commentform a, #tabber .inside li a, .copyrights a:hover, a, .sidebar.c-4-12 a:hover, .top a:hover, footer .tagcloud a:hover { color: $ribbon_lite_color_scheme; }

        .nav-previous a:hover, .nav-next a:hover, #commentform input#submit, #searchform input[type='submit'], .home_menu_item, .primary-navigation a:hover, .post-date-ribbon, .currenttext, .pagination a:hover, .readMore a, .mts-subscribe input[type='submit'], .pagination .current, .woocommerce nav.woocommerce-pagination ul li a:focus, .woocommerce nav.woocommerce-pagination ul li a:hover, .woocommerce nav.woocommerce-pagination ul li span.current, .woocommerce-product-search input[type=\"submit\"], .woocommerce a.button, .woocommerce-page a.button, .woocommerce button.button, .woocommerce-page button.button, .woocommerce input.button, .woocommerce-page input.button, .woocommerce #respond input#submit, .woocommerce-page #respond input#submit, .woocommerce #content input.button, .woocommerce-page #content input.button { background-color: $ribbon_lite_color_scheme; }

        .woocommerce nav.woocommerce-pagination ul li span.current, .woocommerce-page nav.woocommerce-pagination ul li span.current, .woocommerce #content nav.woocommerce-pagination ul li span.current, .woocommerce-page #content nav.woocommerce-pagination ul li span.current, .woocommerce nav.woocommerce-pagination ul li a:hover, .woocommerce-page nav.woocommerce-pagination ul li a:hover, .woocommerce #content nav.woocommerce-pagination ul li a:hover, .woocommerce-page #content nav.woocommerce-pagination ul li a:hover, .woocommerce nav.woocommerce-pagination ul li a:focus, .woocommerce-page nav.woocommerce-pagination ul li a:focus, .woocommerce #content nav.woocommerce-pagination ul li a:focus, .woocommerce-page #content nav.woocommerce-pagination ul li a:focus, .pagination .current, .tagcloud a { border-color: $ribbon_lite_color_scheme; }
        .corner { border-color: transparent transparent $ribbon_lite_color_scheme transparent;}

        .primary-navigation, footer, .readMore a:hover, #commentform input#submit:hover, .featured-thumbnail .latestPost-review-wrapper { background-color: $ribbon_lite_color_scheme2; }
			";
	if(!empty($ribbon_lite_layout) && $ribbon_lite_layout == "sclayout") {
		$custom_css .= ".article { float: right; } .sidebar.c-4-12 { float: left; }";
	}
	wp_add_inline_style( $handle, $custom_css );
}
add_action( 'wp_enqueue_scripts', 'ribbon_lite_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * Add the Social buttons Widget.
 */
include_once( "functions/widget-social.php" );

/**
 * Copyrights
 */
if ( ! function_exists( 'ribbon_lite_copyrights_credit' ) ) {
    function ribbon_lite_copyrights_credit() { 
    global $mts_options
?>
<!--start copyrights-->
<div class="copyrights">
    <div class="container">
        <div class="row" id="copyright-note">
            <span><a href="<?php echo home_url(); ?>/" title="<?php bloginfo('description'); ?>"><?php bloginfo('name'); ?></a> <?php _e('Copyright','ribbon-lite'); ?> &copy; <?php echo date("Y") ?>.</span>
            <div class="top">
                <?php
                $ribbon_lite_copyright_text = get_theme_mod('ribbon_lite_copyright_text', 'Theme by <a href="http://mythemeshop.com/">MyThemeShop</a>.');
                    echo $ribbon_lite_copyright_text;
                ?>
                <a href="#top" class="toplink"><?php _e('Back to Top','ribbon-lite'); ?> &uarr;</a>
            </div>
        </div>
    </div>
</div>
<!--end copyrights-->
<?php }
}

/**
 * Custom Comments template
 */
if ( ! function_exists( 'ribbon_lite_comments' ) ) {
	function ribbon_lite_comment($comment, $args, $depth) {
		$GLOBALS['comment'] = $comment; ?>
		<li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
			<div id="comment-<?php comment_ID(); ?>" style="position:relative;" itemscope itemtype="http://schema.org/UserComments">
				<div class="comment-author vcard">
					<?php echo get_avatar( $comment->comment_author_email, 70 ); ?>
					<div class="comment-metadata">
                        <?php printf('<span class="fn" itemprop="creator" itemscope itemtype="http://schema.org/Person">%s</span>', get_comment_author_link()) ?>
    					<span class="comment-meta">
    						<?php edit_comment_link(__('(Edit)', 'ribbon-lite'),'  ','') ?>
    					</span>
					</div>
				</div>
				<?php if ($comment->comment_approved == '0') : ?>
					<em><?php _e('Your comment is awaiting moderation.', 'ribbon-lite') ?></em>
					<br />
				<?php endif; ?>
				<div class="commentmetadata" itemprop="commentText">
					<?php comment_text() ?>
                    <time><?php comment_date(get_option( 'date_format' )); ?></time>
                    <span class="reply">
                        <?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
                    </span>
				</div>
			</div>
		</li>
	<?php }
}

/*
 * Excerpt
 */
function ribbon_lite_excerpt($limit) {
  $excerpt = explode(' ', get_the_excerpt(), $limit);
  if (count($excerpt)>=$limit) {
    array_pop($excerpt);
    $excerpt = implode(" ",$excerpt);
  } else {
    $excerpt = implode(" ",$excerpt);
  }
  $excerpt = preg_replace('`[[^]]*]`','',$excerpt);
  return $excerpt;
}

/**
 * Shorthand function to check for more tag in post.
 *
 * @return bool|int
 */
function ribbon_lite_post_has_moretag() {
    return strpos( get_the_content(), '<!--more-->' );
}

if ( ! function_exists( 'ribbon_lite_readmore' ) ) {
    /**
     * Display a "read more" link.
     */
    function ribbon_lite_readmore() {
        ?>
        <div class="readMore">
            <a href="<?php echo esc_url( get_the_permalink() ); ?>" title="<?php the_title_attribute(); ?>">
                <?php _e( 'Read More', 'ribbon-lite' ); ?>
            </a>
        </div>
        <?php 
    }
}

/**
 * Breadcrumbs
 */
if (!function_exists('ribbon_lite_the_breadcrumb')) {
    function ribbon_lite_the_breadcrumb() {
        if ( is_front_page() ) {
            return;
        }
        echo '<span typeof="v:Breadcrumb" class="root"><a rel="v:url" property="v:title" href="';
        echo esc_url( home_url() );
        echo '">'.esc_html(sprintf( __( "Home", 'ribbon-lite' )));
        echo '</a></span><span><i class="ribbon-icon icon-angle-double-right"></i></span>';
        if (is_single()) {
            $categories = get_the_category();
            if ( $categories ) {
                $level = 0;
                $hierarchy_arr = array();
                foreach ( $categories as $cat ) {
                    $anc = get_ancestors( $cat->term_id, 'category' );
                    $count_anc = count( $anc );
                    if (  0 < $count_anc && $level < $count_anc ) {
                        $level = $count_anc;
                        $hierarchy_arr = array_reverse( $anc );
                        array_push( $hierarchy_arr, $cat->term_id );
                    }
                }
                if ( empty( $hierarchy_arr ) ) {
                    $category = $categories[0];
                    echo '<span typeof="v:Breadcrumb"><a href="'. esc_url( get_category_link( $category->term_id ) ).'" rel="v:url" property="v:title">'.esc_html( $category->name ).'</a></span><span><i class="ribbon-icon icon-angle-double-right"></i></span>';
                } else {
                    foreach ( $hierarchy_arr as $cat_id ) {
                        $category = get_term_by( 'id', $cat_id, 'category' );
                        echo '<span typeof="v:Breadcrumb"><a href="'. esc_url( get_category_link( $category->term_id ) ).'" rel="v:url" property="v:title">'.esc_html( $category->name ).'</a></span><span><i class="ribbon-icon icon-angle-double-right"></i></span>';
                    }
                }
            }
            echo "<span><span>";
            the_title();
            echo "</span></span>";
        } elseif (is_page()) {
            $parent_id  = wp_get_post_parent_id( get_the_ID() );
            if ( $parent_id ) {
                $breadcrumbs = array();
                while ( $parent_id ) {
                    $page = get_page( $parent_id );
                    $breadcrumbs[] = '<span typeof="v:Breadcrumb"><a href="'.esc_url( get_permalink( $page->ID ) ).'" rel="v:url" property="v:title">'.esc_html( get_the_title($page->ID) ). '</a></span><span><i class="ribbon-icon icon-angle-double-right"></i></span>';
                    $parent_id  = $page->post_parent;
                }
                $breadcrumbs = array_reverse( $breadcrumbs );
                foreach ( $breadcrumbs as $crumb ) { echo $crumb; }
            }
            echo "<span><span>";
            the_title();
            echo "</span></span>";
        } elseif (is_category()) {
            global $wp_query;
            $cat_obj = $wp_query->get_queried_object();
            $this_cat_id = $cat_obj->term_id;
            $hierarchy_arr = get_ancestors( $this_cat_id, 'category' );
            if ( $hierarchy_arr ) {
                $hierarchy_arr = array_reverse( $hierarchy_arr );
                foreach ( $hierarchy_arr as $cat_id ) {
                    $category = get_term_by( 'id', $cat_id, 'category' );
                    echo '<span typeof="v:Breadcrumb"><a href="'.esc_url( get_category_link( $category->term_id ) ).'" rel="v:url" property="v:title">'.esc_html( $category->name ).'</a></span><span><i class="ribbon-icon icon-angle-double-right"></i></span>';
                }
            }
            echo "<span><span>";
            single_cat_title();
            echo "</span></span>";
        } elseif (is_author()) {
            echo "<span><span>";
            if(get_query_var('author_name')) :
                $curauth = get_user_by('slug', get_query_var('author_name'));
            else :
                $curauth = get_userdata(get_query_var('author'));
            endif;
            echo esc_html( $curauth->nickname );
            echo "</span></span>";
        } elseif (is_search()) {
            echo "<span><span>";
            the_search_query();
            echo "</span></span>";
        } elseif (is_tag()) {
            echo "<span><span>";
            single_tag_title();
            echo "</span></span>";
        }
    }
}


/*
 * Google Fonts
 */
function ribbon_lite_fonts_url() {
    $fonts_url = '';
 
    /* Translators: If there are characters in your language that are not
    * supported by Monda, translate this to 'off'. Do not translate
    * into your own language.
    */
    $monda = _x( 'on', 'Monda font: on or off', 'ribbon-lite' );
 
    if ( 'off' !== $monda ) {
        $font_families = array();
 
        if ( 'off' !== $monda ) {
            $font_families[] = urldecode('Monda:400,700');
        }
 
        $query_args = array(
            'family' => urlencode( implode( '|', $font_families ) ),
            //'subset' => urlencode( 'latin,latin-ext' ),
        );
 
        $fonts_url = add_query_arg( $query_args, '//fonts.googleapis.com/css' );
    }
 
    return $fonts_url;
}

function ribbon_lite_scripts_styles() {
    wp_enqueue_style( 'theme-slug-fonts', ribbon_lite_fonts_url(), array(), null );
}
add_action( 'wp_enqueue_scripts', 'ribbon_lite_scripts_styles' );

/**
 * WP Mega Menu Plugin Support
 */
function ribbon_lite_megamenu_parent_element( $selector ) {
    return '.primary-navigation .container';
}
add_filter( 'wpmm_container_selector', 'ribbon_lite_megamenu_parent_element' );

/**
 * Determines whether the WooCommerce plugin is active or not.
 * @return bool
 */
function ribbon_lite_is_wc_active() {
    if ( is_multisite() ) {
        include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

        return is_plugin_active( 'woocommerce/woocommerce.php' );
    } else {
        return in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) );
    }
}

/**
 * WooCommerce
 */
if ( ribbon_lite_is_wc_active() ) {
    if ( !function_exists( 'mts_loop_columns' )) {
        /**
         * Change number or products per row to 3
         *
         * @return int
         */
        function mts_loop_columns() {
            return 3; // 3 products per row
        }
    }
    add_filter( 'loop_shop_columns', 'mts_loop_columns' );

    /**
     * Redefine woocommerce_output_related_products()
     */
    function woocommerce_output_related_products() {
        $args = array(
            'posts_per_page' => 3,
            'columns' => 3,
        );
        woocommerce_related_products($args); // Display 3 products in rows of 1
    }
    
    global $pagenow;
    if ( is_admin() && isset( $_GET['activated'] ) && $pagenow == 'themes.php' ) {
        /**
         * Define WooCommerce image sizes.
         */
        function ribbon_lite_woocommerce_image_dimensions() {
            $catalog = array(
                'width'     => '210',   // px
                'height'    => '155',   // px
                'crop'      => 1        // true
            );
            $single = array(
                'width'     => '326',   // px
                'height'    => '444',   // px
                'crop'      => 1        // true
            );
            $thumbnail = array(
                'width'     => '74',    // px
                'height'    => '74',   // px
                'crop'      => 0        // false
            );
            // Image sizes
            update_option( 'shop_catalog_image_size', $catalog );       // Product category thumbs
            update_option( 'shop_single_image_size', $single );         // Single product image
            update_option( 'shop_thumbnail_image_size', $thumbnail );   // Image gallery thumbs
        }
        add_action( 'init', 'ribbon_lite_woocommerce_image_dimensions', 1 );
    }


    /**
     * Change the number of product thumbnails to show per row to 4.
     *
     * @return int
     */
    function ribbon_lite_woocommerce_thumb_cols() {
     return 4; // .last class applied to every 4th thumbnail
    }
    add_filter( 'woocommerce_product_thumbnails_columns', 'ribbon_lite_woocommerce_thumb_cols' );


    /**
     * Ensure cart contents update when products are added to the cart via AJAX.
     *
     * @param $fragments
     *
     * @return mixed
     */
    function ribbon_lite_header_add_to_cart_fragment( $fragments ) {
        global $woocommerce;
        ob_start(); ?>
        
        <a class="cart-contents" href="<?php echo esc_url( $woocommerce->cart->get_cart_url() ); ?>" title="<?php _e( 'View your shopping cart', 'ribbon-lite' ); ?>"><?php echo sprintf( _n( '%d item', '%d items', $woocommerce->cart->cart_contents_count, 'ribbon-lite' ), $woocommerce->cart->cart_contents_count );?> - <?php echo $woocommerce->cart->get_cart_total(); ?></a>
        
        <?php $fragments['a.cart-contents'] = ob_get_clean();
        return $fragments;
    }
    add_filter( 'add_to_cart_fragments', 'ribbon_lite_header_add_to_cart_fragment' );

    /**
     * Optimize WooCommerce Scripts
     * Updated for WooCommerce 2.0+
     * Remove WooCommerce Generator tag, styles, and scripts from non WooCommerce pages.
     */
    function ribbon_lite_manage_woocommerce_styles() {
        //remove generator meta tag
        remove_action( 'wp_head', array( $GLOBALS['woocommerce'], 'generator' ) );
     
        //first check that woo exists to prevent fatal errors
        if ( function_exists( 'is_woocommerce' ) ) {
            //dequeue scripts and styles
            if ( ! is_woocommerce() && ! is_cart() && ! is_checkout() ) {
                wp_dequeue_style( 'woocommerce-layout' );
                wp_dequeue_style( 'woocommerce-smallscreen' );
                wp_dequeue_style( 'woocommerce-general' );
                wp_dequeue_style( 'wc-bto-styles' ); //Composites Styles
                wp_dequeue_script( 'wc-add-to-cart' );
                wp_dequeue_script( 'wc-cart-fragments' );
                wp_dequeue_script( 'woocommerce' );
                wp_dequeue_script( 'jquery-blockui' );
                wp_dequeue_script( 'jquery-placeholder' );
            }
        }
    }
    add_action( 'wp_enqueue_scripts', 'ribbon_lite_manage_woocommerce_styles', 99 );

    // Remove WooCommerce generator tag.
    remove_action('wp_head', 'wc_generator_tag');
}

/**
 * Post Layout for Archives
 */
if ( ! function_exists( 'ribbon_lite_archive_post' ) ) {
    /**
     * Display a post of specific layout.
     * 
     * @param string $layout
     */
    function ribbon_lite_archive_post( $layout = '' ) { 
        $ribbon_lite_full_posts = get_theme_mod('ribbon_lite_full_posts', '0'); ?>
        <article class="post excerpt">
            <div class="post-date-ribbon"><div class="corner"></div><?php the_time( get_option( 'date_format' ) ); ?></div>
            <header>                        
                <h2 class="title">
                    <a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>" rel="bookmark"><?php the_title(); ?></a>
                </h2>
                <div class="post-info">
                    <span class="theauthor"><span><i class="ribbon-icon icon-users"></i></span><?php _e('By','ribbon-lite'); ?>&nbsp;<?php the_author_posts_link(); ?></span>
                    <span class="featured-cat"><span><i class="ribbon-icon icon-bookmark"></i></span><?php the_category(', '); ?></span>
                    <span class="thecomment"><span><i class="ribbon-icon icon-comment"></i></span>&nbsp;<a href="<?php comments_link(); ?>"><?php comments_number(__('0 Comments','ribbon-lite'),__('1 Comment','ribbon-lite'),__('% Comments','ribbon-lite')); ?></a></span>
                </div>
            </header><!--.header-->
            <?php if ( empty($ribbon_lite_full_posts) ) : ?>
                <?php if ( has_post_thumbnail() ) { ?>
                    <a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>" id="featured-thumbnail">
                        <div class="featured-thumbnail">
                            <?php the_post_thumbnail('ribbon-lite-featured',array('title' => '')); ?>
                            <?php if (function_exists('wp_review_show_total')) wp_review_show_total(true, 'latestPost-review-wrapper'); ?>
                        </div>
                    </a>
                <?php } else { ?>
                    <a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>" id="featured-thumbnail">
                        <div class="featured-thumbnail">
                            <img src="<?php echo get_template_directory_uri(); ?>/images/nothumb-featured.png" class="attachment-featured wp-post-image" alt="<?php the_title_attribute(); ?>">
                            <?php if (function_exists('wp_review_show_total')) wp_review_show_total(true, 'latestPost-review-wrapper'); ?>
                        </div>
                    </a>
                <?php } ?>
                <div class="post-content">
                    <?php echo ribbon_lite_excerpt(56); ?>
                </div>
                <?php ribbon_lite_readmore(); ?>
            <?php else : ?>
                <div class="post-content full-post">
                    <?php the_content(); ?>
                </div>
                <?php if (ribbon_lite_post_has_moretag()) : ?>
                    <?php ribbon_lite_readmore(); ?>
                <?php endif; ?>
            <?php endif; ?>
        </article>
    <?php }
}
