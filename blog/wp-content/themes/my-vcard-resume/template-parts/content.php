<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package my_vcard_resume
 */
$class = array('col','col-d-12','col-t-12','col-m-12');
?>
<article id="post-<?php the_ID(); ?>" <?php post_class( $class ); ?>>

    <div class="box-item">
    
    
<!--        <div class="image">-->
<!--			--><?php
//            /**
//            * Hook - my_vcard_resume_posts_blog_media.
//            *
//            * @hooked my_vcard_resume_posts_blog_media - 10
//            */
//            do_action('my_vcard_resume_posts_blog_media');
//            ?>
<!--        </div>-->
        
        <div class="desc">

            <?php the_title( '<h4 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h4>' ); ?>
            <ul class="category">
				<?php
                    $categories_list = get_the_category_list( esc_html__( '   /   ', 'my-vcard-resume' ) );
                    if ( $categories_list ) {
                        /* translators: 1: list of categories. */
                        printf( '<li class="cat-links">' . esc_html__( 'Posted in %1$s', 'my-vcard-resume' ) . '</li>', $categories_list ); // WPCS: XSS OK.
                    }
                ?>
            </ul>
            <?php the_excerpt();?>
            
            <div style="clear:both"></div>
        </div>
        
        
    </div>
    
</article>


