<?php
/**
 * Functions which enhance the Posts by hooking into WordPress 
 *
 * @package my_vcard_resume
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if( ! function_exists( 'my_vcard_resume_excerpt_more' ) ) :
	/**
	* Adds custom Read More Button to excerpt.
	*
	*/
	function my_vcard_resume_excerpt_more( $more ) {
		
//		$length = esc_html__( 'Continue Reading', 'my-vcard-resume' );
//
//		return sprintf( '<div><a class="btn btn-theme" href="%1$s">%2$s  <i class="fa fa-fw fa-long-arrow-right"></i></a></div>',
//			get_permalink( get_the_ID() ),
//			esc_html($length)
//		);
	}
	add_filter( 'excerpt_more', 'my_vcard_resume_excerpt_more' );
endif;



if ( ! function_exists( 'my_vcard_resume_posts_formats_thumbnail' ) ) :

	/**
	 * Post formats thumbnail.
	 *
	 * @since 1.0.0
	 */
	function my_vcard_resume_posts_formats_thumbnail() {
	?>
		<?php if ( is_single() ) :
		
			$post_thumbnail_id = get_post_thumbnail_id( get_the_ID() );
			if( $post_thumbnail_id != "" ) :
			
			$post_thumbnail_url = wp_get_attachment_url( $post_thumbnail_id );
		?>
        	<a href="<?php echo esc_url( $post_thumbnail_url );?>" class="image-popup entry-cover">
            <?php else:?>
            <a href="javascript:void(0)">
            <?php endif;?>
            
        <?php else: ?>
       		<a href="<?php echo esc_url( get_permalink() );?>" class="entry-cover">
        <?php endif;?>
        
			<?php if ( has_post_thumbnail() ) : ?>
                <i class="fa fa-plus"></i>
                <?php the_post_thumbnail('full');?>
                
            <?php else:?>
            
                 <i class="fa fa-plus "></i>
                 <img src="<?php echo esc_url( get_theme_file_uri( '/assets/image/default-blog.png' ) );?>" alt="<?php echo get_the_title();?>" />
                 
            <?php endif;?> 
            
              </a>
        	<?php if ( !is_single() ) : ?>
        	<span class="date"><strong><?php echo get_the_date('d'); ?></strong><?php echo get_the_date('M'); ?></span> 
            <?php endif;?>
            
      
	<?php
	}

endif;
add_action( 'my_vcard_resume_posts_formats_thumbnail', 'my_vcard_resume_posts_formats_thumbnail' );


if ( ! function_exists( 'my_vcard_resume_posts_formats_video' ) ) :

	/**
	 * Post Formats Video.
	 *
	 * @since 1.0.0
	 */
	function my_vcard_resume_posts_formats_video() {
	
		$content = apply_filters( 'the_content', get_the_content(get_the_ID()) );
		$video = false;
		// Only get video from the content if a playlist isn't present.
		if ( false === strpos( $content, 'wp-playlist-script' ) ) {
			$video = get_media_embedded_in_content( $content, array( 'video', 'object', 'embed', 'iframe' ) );
		}
		
		
			// If not a single post, highlight the video file.
			if ( ! empty( $video ) ) :
				foreach ( $video as $video_html ) {
					echo '<div class="entry-video embed-responsive embed-responsive-16by9">';
						echo $video_html;
					echo '</div>';
				}
				if ( !is_single() ) : ?>
				<span class="date"><strong><?php echo get_the_date('d'); ?></strong><?php echo get_the_date('M'); ?></span> 
				<?php endif;
			else: 
				do_action('my_vcard_resume_posts_formats_thumbnail');	
			endif;
		
		
	 }

endif;
add_action( 'my_vcard_resume_posts_formats_video', 'my_vcard_resume_posts_formats_video' ); 


if ( ! function_exists( 'my_vcard_resume_posts_formats_audio' ) ) :

	/**
	 * Post Formats audio.
	 *
	 * @since 1.0.0
	 */
	function my_vcard_resume_posts_formats_audio() {
		$content = apply_filters( 'the_content', get_the_content() );
		$audio = false;
	
		// Only get audio from the content if a playlist isn't present.
		if ( false === strpos( $content, 'wp-playlist-script' ) ) {
			$audio = get_media_embedded_in_content( $content, array( 'audio' ) );
		}
	
		
	
		// If not a single post, highlight the audio file.
		if ( ! empty( $audio ) ) :
			foreach ( $audio as $audio_html ) {
				echo $audio_html;
			}
		else: 
			do_action('my_vcard_resume_posts_formats_video');	
		endif;
	
		
	 }

endif;
add_action( 'my_vcard_resume_posts_formats_audio', 'my_vcard_resume_posts_formats_audio' ); 

if ( ! function_exists( 'my_vcard_resume_posts_formats_gallery' ) ) :

	/**
	 * Post Formats gallery.
	 *
	 * @since 1.0.0
	 */
	function my_vcard_resume_posts_formats_gallery() {
		global $post;
		if ( get_post_gallery() ) :
			echo '<div class="gallery-media owlGallery blog-media">';
			
				$gallery = get_post_gallery( $post, false );
				$ids = explode( ",", $gallery['ids'] );
				
				foreach( $ids as $id ) {
				
				   $link   = wp_get_attachment_url( $id );
				?>
				<?php if ( is_singular() ) :?>
                <a href="<?php echo esc_url( $post_thumbnail_url );?>" class="image-popup">
                <?php else: ?>
                <a href="<?php echo esc_url( get_permalink() );?>" class="entry-cover">
                <?php endif;?>
                 <i class="fa fa-plus"></i>
                <?php
				   echo '<img src="' . esc_url( $link ) . '"  class="img-responsive" alt="' .esc_attr( get_the_title() ). '" title="' .esc_attr( get_the_title() ). '"  /></a>';
				
				} 
				
			echo '</div>';
			if ( !is_single() ) : ?>
				<span class="date"><strong><?php echo get_the_date('d'); ?></strong><?php echo get_the_date('M'); ?></span> 
			<?php endif;

		else: 
			do_action('my_vcard_resume_posts_formats_thumbnail');	
		endif;	
	
	 }

endif;
add_action( 'my_vcard_resume_posts_formats_gallery', 'my_vcard_resume_posts_formats_gallery' ); 





if ( ! function_exists( 'my_vcard_resume_posts_formats_header' ) ) :

	/**
	 * Post my_vcard_resume_posts_blog_media
	 *
	 * @since 1.0.0
	 */
	function my_vcard_resume_posts_blog_media() {
		$formats = get_post_format(get_the_ID());
		
		switch ( $formats ) {
			default:
				do_action('my_vcard_resume_posts_formats_thumbnail');
			break;
			case 'gallery':
				do_action('my_vcard_resume_posts_formats_gallery');
			break;
			case 'audio':
				do_action('my_vcard_resume_posts_formats_audio');
			break;
			case 'video':
				do_action('my_vcard_resume_posts_formats_video');
			break;
		} 
		
	 }

endif;
add_action( 'my_vcard_resume_posts_blog_media', 'my_vcard_resume_posts_blog_media' ); 



if ( ! function_exists( 'my_vcard_resume_single_post_navigation' ) ) :

	/**
	 * Post Single Posts Navigation 
	 *
	 * @since 1.0.0
	 */
	function my_vcard_resume_single_post_navigation( ) {
		the_post_navigation();
	} 

endif;
add_action( 'my_vcard_resume_single_post_navigation', 'my_vcard_resume_single_post_navigation', 20 );



if ( ! function_exists( 'my_vcard_resume_entry_footer' ) ) :
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function my_vcard_resume_entry_footer() {
		// Hide category and tag text for pages.
		
	
		$tags_list = get_the_tag_list('<li>','</li><li>','</li>');
			
		if( $tags_list || is_admin() ):
		
		if ( 'post' === get_post_type() && $tags_list ) {
				echo '<div class="tags_wrp"><ul class="tag">';	
				/* translators: 1: list of tags. */
				printf( '<li><span><i class="fa fa-tags" aria-hidden="true"></i></span></li> %1$s', $tags_list ); // WPCS: XSS OK.
				echo '</div></div>';
		}
		
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
		
	  endif;
	}
endif;

add_action( 'my_vcard_resume_entry_footer', 'my_vcard_resume_entry_footer', 10 );