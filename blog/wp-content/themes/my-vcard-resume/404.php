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

/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
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
        	 <article class="col col-d-12 col-t-12 col-m-12 border-line-h after-none">
       			<div class="post-box box-item">
                
                        <h2><?php esc_html_e( '404 Not Found', 'my-vcard-resume' ); ?></h2>
                        <h4 class="hint"><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'my-vcard-resume' ); ?></h4>
                        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn btn-back-home"><i class="fa fa-long-arrow-left"></i><?php esc_html_e( 'Back to home', 'my-vcard-resume' ); ?></a>
                        
                 </div>       
             </article>
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
