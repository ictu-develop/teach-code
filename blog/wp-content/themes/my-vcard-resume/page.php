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
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
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
         <div class="row">
       		<?php
            while ( have_posts() ) :
                the_post();
            
                get_template_part( 'template-parts/content', 'page' );
            
                // If comments are open or we have at least one comment, load up the comment template.
                if ( comments_open() || get_comments_number() ) :
                    comments_template();
                endif;
            
            endwhile; // End of the loop.
            ?>
          </div>            
    </div>			

<?php
/**
* Hook - my_vcard_resume_theme_page_wrp_end.
*
* @hooked my_vcard_resume_theme_page_wrp_end - 10
*/
do_action( 'my_vcard_resume_theme_page_wrp_end' );

get_footer();
