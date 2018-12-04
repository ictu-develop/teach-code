<?php
echo '<style>
#wpadminbar{
display: none;
}
</style>';

echo'<style>
.page{
top: 0px;
}
</style>';
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package my_vcard_resume
 */
 
get_header();

/**
* Hook - my_vcard_resume_theme_page_wrp_start.
*
* @hooked my_vcard_resume_theme_page_wrp_start - 10
*/
do_action( 'my_vcard_resume_theme_page_wrp_start' );

?>
	<div class="content blog-single">
		
        <?php
        /**
        * Hook - my_vcard_resume_title_in_custom_header.
        *
        * @hooked my_vcard_resume_title_in_custom_header - 10
        */
        do_action( 'my_vcard_resume_title_in_custom_header' );
        ?>
        
			<?php
            // Start the loop.
            while ( have_posts() ) : the_post();
    
                /*
                 * Include the post format-specific template for the content. If you want to
                 * use this in a child theme, then include a file called content-___.php
                 * (where ___ is the post format) and that will be used instead.
                 */
                get_template_part( 'template-parts/content', 'single' );
				
				/**
				* Hook - my_vcard_resume_single_post_navigation.
				*
				* @hooked my_vcard_resume_single_post_navigation - 20
				*/
				do_action('my_vcard_resume_single_post_navigation');
    
                // If comments are open or we have at least one comment, load up the comment template.
                if ( comments_open() || get_comments_number() ) :
                    comments_template();
                endif;
    
             
            // End the loop.
            endwhile;
            ?>
          

           

    </div>			

<?php
/**
* Hook - my_vcard_resume_theme_page_wrp_end.
*
* @hooked my_vcard_resume_theme_page_wrp_end - 10
*/
do_action( 'my_vcard_resume_theme_page_wrp_end' );

get_footer();
