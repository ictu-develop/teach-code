<?php
/**
 * The template for displaying comments
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package my_vcard_resume
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>


<div id="comments" class="comments-area" style="clear:both;">

	<?php
	// You can start editing here -- including this comment!
	if ( have_comments() ) :
		?>
        <div class="page-entry-title-wrp">
		<h4 class="comments-title">
			<?php
			$my_vcard_resume_comment_count = get_comments_number();
			if ( '1' === $my_vcard_resume_comment_count ) {
				printf(
					/* translators: 1: title. */
					esc_html__( 'One thought on &ldquo;%1$s&rdquo;', 'my-vcard-resume' ),
					'<span>' . get_the_title() . '</span>'
				);
			} else {
				printf( // WPCS: XSS OK.
					/* translators: 1: comment count number, 2: title. */
					esc_html( _nx( '%1$s thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', $my_vcard_resume_comment_count, 'comments title', 'my-vcard-resume' ) ),
					number_format_i18n( $my_vcard_resume_comment_count ),
					'<span>' . get_the_title() . '</span>'
				);
			}
			?>
		</h4></div><!-- .comments-title -->


        <div class="row">
            <div class="col col-m-12 col-t-12 col-d-12">
                <div class="post-box">
                    <div class="col-md-12">
                    <?php the_comments_navigation(); ?>
                        <ul class="post-comments comment-list">
                        
								<?php
									wp_list_comments( array(
										'short_ping' => true,
										'callback' => 'my_vcard_resume_walker_comment',
									) );
                                ?>
                          
                        </ul><!-- .comment-list -->
                    </div>
                </div>
            </div>
        </div>  
        
        
		<?php
		the_comments_navigation();

		// If comments are closed and there are comments, let's leave a little note, shall we?
		if ( ! comments_open() ) :
			?>
			<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'my-vcard-resume' ); ?></p>
			<?php
		endif;

	endif; // Check for have_comments().

	
	?>


<div class="row" id="mycard-comment-from">
    <div class="col col-m-12 col-t-12 col-d-12">
        <div class="post-box row">
       
             <?php
			 
			 	$required_text = '<span class="required">*</span>';
				
				$args = array(
				'id_form'  => 'cform',
				'title_reply_before'	=> '<h4 class="comments-title comment-reply-title">',
				'title_reply_after'	=>	'</h4>',
				'comment_notes_before' => '<div class="col col-d-12 col-t-12 col-m-12">' .
				esc_html__( 'Your email address will not be published.','my-vcard-resume'  ) . ( $req ? $required_text : '' ) .
				'</div>',
				
				'must_log_in' => '<div class="col col-d-12 col-t-12 col-m-12">' .
				sprintf(
				/* translators: 1: title. */
				__( 'You must be <a href="%s">logged in</a> to post a comment.','my-vcard-resume' ),
				wp_login_url( apply_filters( 'the_permalink', get_permalink() ) )
				) . '</>>',
				
				'comment_notes_before' => '<div class="col col-d-12 col-t-12 col-m-12">' .
				__( 'Your email address will not be published.','my-vcard-resume' ) . ( $req ? $required_text : '' ) .
				'</div>',

				'logged_in_as' => '<div class="col col-d-12 col-t-12 col-m-12">' .
				sprintf(
				/* translators: 1: title. */
				__( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>','my-vcard-resume'),
				admin_url( 'profile.php' ),
				$user_identity,
				wp_logout_url( apply_filters( 'the_permalink', get_permalink( ) ) )
				) . '</div>',


				
				'fields' => apply_filters(
						'comment_form_default_fields', array(
							'author' =>'<div class="col col-d-12 col-t-12 col-m-12"> <div class="group-val">' . '<input id="author" placeholder="' . esc_attr__( 'Your Name', 'my-vcard-resume'  ) . '" name="author"  type="text" value="' .
								esc_attr( $commenter['comment_author'] ) . '" size="30" class="form-control" />'.
								( $req ? '<span class="required">*</span>' : '' )  .
								'</div></div>'
								,
							'email'  => '<div class="col col-d-12 col-t-12 col-m-12"> <div class="group-val">' . '<input id="email" placeholder="' . esc_attr__( 'Your Email', 'my-vcard-resume'  ) . '" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) .
								'" size="30" class="form-control"   />'  .
								( $req ? '<span class="required">*</span>' : '' ) 
								 .
								'</div></div>',
							'url'    => '<div class="col col-d-12 col-t-12 col-m-12"> <div class="group-val">' .
							 '<input id="url" name="url" placeholder="' . esc_attr__( 'Website', 'my-vcard-resume' ) . '" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" class="form-control"   /> ' .
							   '</div></div>',
							   
						)
					),
					 'comment_field' =>  ' <div class="col col-d-12 col-t-12 col-m-12"><div class="group-val"><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true"  placeholder="' . esc_attr__( 'Comment', 'my-vcard-resume' ) . '" class="form-control"  >' .
    '</textarea></div></div>',
					'class_submit'      => 'btn',
					'submit_button' => '<div class="col col-d-12 col-t-12 col-m-12"><div class="group-val comment-btn">
					<button name="%1$s" type="submit" id="%2$s" class="%3$s">%4$s<i class="fa fa-fw fa-long-arrow-right"></i></button>
					</div></div>'
				
				);
				
			   comment_form( $args );
			 ?>
 
           

        </div>
    </div>
</div>
</div><!-- #comments -->
