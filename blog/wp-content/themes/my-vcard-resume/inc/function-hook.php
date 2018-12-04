<?php
/**
 * Filter Hook Functions which enhance the theme by hooking into WordPress 
 *
 * @package my_vcard_resume
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if( !function_exists('my_vcard_resume_excerpt_length') ):
	function my_vcard_resume_excerpt_length( $length ) {
		return 35;
	}
	add_filter( 'excerpt_length', 'my_vcard_resume_excerpt_length', 999 );
endif;



if( !function_exists('my_vcard_resume_excerpt_length') ):
// Remove gallery from content
add_filter('the_content', 'my_vcard_resume_strip_shortcode_gallery');
function my_vcard_resume_strip_shortcode_gallery( $content ) {
    preg_match_all( '/'. get_shortcode_regex() .'/s', $content, $matches, PREG_SET_ORDER );
    if ( ! empty( $matches ) ) {
        foreach ( $matches as $shortcode ) {
            if ( 'gallery' === $shortcode[2] ) {
                $pos = strpos( $content, $shortcode[0] );
                if ($pos !== false)
                    return substr_replace( $content, '', $pos, strlen($shortcode[0]) );
            }
			if ( 'audio' === $shortcode[2] ) {
                $pos = strpos( $content, $shortcode[0] );
                if ($pos !== false)
                    return substr_replace( $content, '', $pos, strlen($shortcode[0]) );
            }
        }
    }
    return $content;
}

endif;





if ( ! function_exists( 'my_vcard_resume_posted_on' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time.
	 */
	function my_vcard_resume_posted_on() {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';
		}

		$time_string = sprintf( $time_string,
			esc_attr( get_the_date( DATE_W3C ) ),
			esc_html( get_the_date() )
		);

		$posted_on = sprintf(
			/* translators: %s: post date. */
			esc_html_x( 'Posted on %s', 'post date', 'my-vcard-resume' ),
			'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
		);

		echo '<span class="posted-on">' . $posted_on . '</span>'; // WPCS: XSS OK.

	}
	add_action( 'my_vcard_resume_posted_on', 'my_vcard_resume_posted_on',10 );
endif;



if ( ! function_exists( 'my_vcard_resume_walker_comment' ) ) : 
	/**
	 * Implement Custom Comment template.
	 *
	 * @since 1.0.0
	 *
	 * @param $comment, $args, $depth
	 * @return $html
	 */
	  
	function my_vcard_resume_walker_comment($comment, $args, $depth) {
		?>
            <li>
                <?php if ( $args['avatar_size'] != 0 ) echo get_avatar( $comment, 60 ); ?>
                <div class="comment-info">
                    <div class="name">
                        <h6><?php comment_author( ); ?> <span><?php
							/* translators: 1: date, 2: time */
							printf( esc_html__('%1$s at %2$s', 'my-vcard-resume' ), get_comment_date(),  get_comment_time() );
							 ?></span></h6>
                        <?php 
					$args ['reply_text'] =  esc_html__( 'Reply', 'my-vcard-resume' );
                    comment_reply_link( array_merge( $args, array(  'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
                    </div>
                    <p>
                         <?php comment_text(); ?>
                    </p>
                </div>
            </li>
            
		<?php
	}
	
	
endif;


if ( ! function_exists( 'my_vcard_resume_page_formats_thumbnail' ) ) :

	/**
	 * Page formats thumbnail.
	 *
	 * @since 1.0.0
	 */
	function my_vcard_resume_page_formats_thumbnail() {
	?>
		<?php  
		$post_thumbnail_id = get_post_thumbnail_id( get_the_ID() );
		
		if( $post_thumbnail_id != "" ) :
		$post_thumbnail_url = wp_get_attachment_url( $post_thumbnail_id );
        ?>	
       		 <a href="<?php echo esc_url( $post_thumbnail_url );?>" class="image-popup">
        
        <?php endif;?>
        
        <?php if ( has_post_thumbnail() ) :
       		 $formats = get_post_format(get_the_ID());?>
       		 <i class="fa fa-plus <?php echo esc_attr( $formats );?>"></i>
        	<?php the_post_thumbnail('full');?>
        <?php endif;?> 
        
        </a>
      
	<?php
	}

endif;
add_action( 'my_vcard_resume_page_formats_thumbnail', 'my_vcard_resume_page_formats_thumbnail' );



if ( ! function_exists( 'my_vcard_resume_title_in_custom_header' ) ) :

	/**
	 * Add title in custom header.
	 *
	 * @since 1.0.0
	 */
	function my_vcard_resume_title_in_custom_header() {
		echo '<div class="page-entry-title-wrp">';
		if ( is_home() ) {
//				echo '<h2 class="entry-title">';
//				echo bloginfo( 'name' );
//				echo '</h2>';
//				echo '<div class="subtitle">';
//				echo esc_html(get_bloginfo( 'description', 'display' ));
//				echo '</div>';


		} elseif ( is_singular() ) {
			echo '<h2 class="entry-title">';
			echo single_post_title( '', false );
			echo '</h2>';
			if( is_single() ):
			?>
            <div class="blog-posted-date">
			   <?php
                /**
                * Hook - my_vcard_resume_posted_on.
                *
                * @hooked my_vcard_resume_posted_on - 10
                */
                //do_action('my_vcard_resume_posted_on');
                ?>
            </div>
            <?php
			endif;
			
		} elseif ( is_archive() ) {
//			the_archive_title( '<h1 class="display-1">', '</h1>' );
//			 the_archive_description( '<div class="archive-description">', '</div>' );
		} elseif ( is_search() ) {
//			echo '<h2 class="entry-title">';
//			printf( /* translators:straing */ esc_html__( 'Search Results for: %s', 'my-vcard-resume' ),  get_search_query() );
//			echo '</h2>';
		} elseif ( is_404() ) {
//			echo '<h2 class="entry-title">';
//			esc_html_e( '404 Error ! Oops! That page can&rsquo;t be found.', 'my-vcard-resume' );
//			echo '</h2>';
		}
		echo '</div>';

	}

endif;
add_action( 'my_vcard_resume_title_in_custom_header', 'my_vcard_resume_title_in_custom_header',10 );

