<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package my_vcard_resume
 */
$class = array('col','col-d-12','col-t-12','col-m-12','after-none');
?>
<div class="row">
<article id="post-<?php the_ID(); ?>" <?php post_class( $class ); ?>>
<div class="post-box box-item">
    
    <div class="image">
		<?php
        /**
        * Hook - my_vcard_resume_posts_blog_media.
        *
        * @hooked my_vcard_resume_posts_blog_media - 10
        */
        do_action('my_vcard_resume_posts_blog_media');
        ?>
    </div>
    <div class="blog-content entry-content">
		<?php
            the_content();
            
            wp_link_pages( array(
                'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'my-vcard-resume' ),
                'after'  => '</div>',
            ) );
        ?>
        <?php
        /**
        * Hook - my_vcard_resume_entry_footer.
        *
        * @hooked my_vcard_resume_entry_footer - 10
        */
        do_action('my_vcard_resume_entry_footer');
        ?>
        
    </div>
    
</div>    
</article>
</div>


