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
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
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
 <div class="row <!--border-line-h-->">
   		<?php
		if ( have_posts() ) :
		/* Start the Loop */
		while ( have_posts() ) :
			the_post();
		
			/**
			 * Run the loop for the search to output the results.
			 * If you want to overload this in a child theme then include a file
			 * called content-search.php and that will be used instead.
			 */
			get_template_part( 'template-parts/content', 'search' );
		
		endwhile;
		the_posts_navigation();
		
		else :
		get_template_part( 'template-parts/content', 'none' );
		endif;
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
