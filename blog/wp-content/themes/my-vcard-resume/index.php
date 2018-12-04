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

echo '<style>
                .page-entry-title-wrp{
                    display: none;
                }
                .card-inner .card-wrap{
                    padding: 0px 30px 30px 60px;
                }
            </style>';
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package my_vcard_resume
 */

get_header();
?>

<?php
/**
* Hook - my_vcard_resume_theme_page_wrp_start.
*
* @hooked my_vcard_resume_theme_page_wrp_start - 10
*/
do_action( 'my_vcard_resume_theme_page_wrp_start' );
?>
	<div class="content blog">
		
		<?php
        /**
        * Hook - my_vcard_resume_title_in_custom_header.
        *
        * @hooked my_vcard_resume_title_in_custom_header - 10
        */
        do_action( 'my_vcard_resume_title_in_custom_header' );
        ?>

        <!-- content -->
        <div class="row">
			<?php if ( have_posts() ) : ?>
            <!-- blog item -->
            
			<?php
            /* Start the Loop */
            while ( have_posts() ) :
                the_post();
            
                /*
                 * Include the Post-Type-specific template for the content.
                 * If you want to override this in a child theme, then include a file
                 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
                 */
                get_template_part( 'template-parts/content', get_post_type() );
            
            endwhile;
            
          		  the_posts_navigation();
            
            else :
            
            get_template_part( 'template-parts/content', 'none' );
            
            endif;
            ?>
          

            <div class="clear"></div>
        </div>

    </div>			

<?php
/**
* Hook - my_vcard_resume_theme_page_wrp_end.
*
* @hooked my_vcard_resume_theme_page_wrp_end - 10
*/
do_action( 'my_vcard_resume_theme_page_wrp_end' );

?>

	
<?php

get_footer();
