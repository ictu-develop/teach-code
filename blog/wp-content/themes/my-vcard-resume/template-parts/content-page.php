<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package my_vcard_resume
 */


$class = array('col','col-d-12','col-t-12','col-m-12');
?>
<article id="post-<?php the_ID(); ?>" <?php post_class( $class ); ?>>
<div class="box-item">

<!--    <div class="image">-->
<!--        --><?php
//        /**
//        * Hook - my_vcard_resume_page_formats_thumbnail.
//        *
//        * @hooked my_vcard_resume_page_formats_thumbnail - 10
//        */
//        do_action('my_vcard_resume_page_formats_thumbnail');
//        ?>
<!--    </div>-->
    
    <div class="desc">
        <?php the_content();?>
        <div style="clear:both"></div>
    </div>    
    
	<?php if ( get_edit_post_link() ) : ?>
        <footer class="entry-footer">
            <?php
            edit_post_link(
                sprintf(
                    wp_kses(
                        /* translators: %s: Name of current post. Only visible to screen readers */
                        __( 'Edit <span class="screen-reader-text">%s</span>', 'my-vcard-resume' ),
                        array(
                            'span' => array(
                                'class' => array(),
                            ),
                        )
                    ),
                    get_the_title()
                ),
                '<span class="edit-link">',
                '</span>'
            );
            ?>
        </footer><!-- .entry-footer -->
    <?php endif; ?>

</div>   
</article><!-- #post-<?php the_ID(); ?> -->
