<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Ribbon Lite
 */
$ribbon_lite_single_breadcrumb_section = get_theme_mod('ribbon_lite_single_breadcrumb_section', '1');
$ribbon_lite_single_tags_section = get_theme_mod('ribbon_lite_single_tags_section', '1');
$ribbon_lite_authorbox_section = get_theme_mod('ribbon_lite_authorbox_section', '1');
$ribbon_lite_relatedposts_section = get_theme_mod('ribbon_lite_relatedposts_section', '1');

get_header(); ?>

<div id="page" class="single">
	<div class="content">
		<!-- Start Article -->
		<article class="article">		
			<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
				<div id="post-<?php the_ID(); ?>" <?php post_class('post'); ?>>
					<div class="single_post">
					    <div class="post-date-ribbon"><div class="corner"></div><?php the_time( get_option( 'date_format' ) ); ?></div>
					    <?php if($ribbon_lite_single_breadcrumb_section == '1') { ?>
							<div class="breadcrumb" xmlns:v="http://rdf.data-vocabulary.org/#"><?php ribbon_lite_the_breadcrumb(); ?></div>
						<?php } ?>
						<header>
							<!-- Start Title -->
							<h1 class="title single-title"><?php the_title(); ?></h1>
							<!-- End Title -->
							<!-- Start Post Meta -->
							<div class="post-info">
								<span class="theauthor"><span><i class="ribbon-icon icon-users"></i></span><?php _e('By','ribbon-lite'); ?>&nbsp;<?php the_author_posts_link(); ?></span>
								<span class="featured-cat"><span><i class="ribbon-icon icon-bookmark"></i></span><?php the_category(', '); ?></span>
								<span class="thecomment"><span><i class="ribbon-icon icon-comment"></i></span>&nbsp;<a href="<?php comments_link(); ?>"><?php comments_number(__('0 Comments','ribbon-lite'),__('1 Comment','ribbon-lite'),__('% Comments','ribbon-lite')); ?></a></span>
							</div>
							<!-- End Post Meta -->
						</header>
						<!-- Start Content -->
						<div id="content" class="post-single-content box mark-links">
							<?php the_content(); ?>
							<?php wp_link_pages(array('before' => '<div class="pagination">', 'after' => '</div>', 'link_before'  => '<span class="current"><span class="currenttext">', 'link_after' => '</span></span>', 'next_or_number' => 'next_and_number', 'nextpagelink' => __('Next', 'ribbon-lite' ), 'previouspagelink' => __('Previous', 'ribbon-lite' ), 'pagelink' => '%','echo' => 1 )); ?>
							<?php if($ribbon_lite_single_tags_section == '1') { ?>
								<!-- Start Tags -->
								<div class="tags"><?php the_tags('<span class="tagtext">'.__('Tags','ribbon-lite').':</span>',', ') ?></div>
								<!-- End Tags -->
							<?php } ?>
						</div><!-- End Content -->
						<?php if($ribbon_lite_relatedposts_section == '1') { ?>	
						    <!-- Start Related Posts -->
							<?php $categories = get_the_category($post->ID); 
							if ($categories) { $category_ids = array(); 
								foreach($categories as $individual_category) 
									$category_ids[] = $individual_category->term_id; 
								    $args=array( 'category__in' => $category_ids, 
								    'post__not_in' => array($post->ID), 
								    'ignore_sticky_posts' => 1, 
								    'showposts'=> 3,
								    'orderby' => 'rand' );
									$my_query = new wp_query( $args ); if( $my_query->have_posts() ) {
								echo '<div class="related-posts"><div class="postauthor-top"><h3>'.__('Related Posts', 'ribbon-lite').'</h3></div>';
								$pexcerpt=1; $j = 0; $counter = 0; 
								while( $my_query->have_posts() ) { 
								$my_query->the_post();?>
								<article class="post excerpt  <?php echo (++$j % 3== 0) ? 'last' : ''; ?>">
									<?php if ( has_post_thumbnail() ) { ?>
										<a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>" id="featured-thumbnail">
											<div class="featured-thumbnail">
												<?php the_post_thumbnail('ribbon-lite-related',array('title' => '')); ?>
												<?php if (function_exists('wp_review_show_total')) wp_review_show_total(true, 'latestPost-review-wrapper'); ?>
											</div>
											<header>
												<h4 class="title front-view-title"><?php the_title(); ?></h4>
											</header>
										</a>
									<?php } else { ?>
										<a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>" id="featured-thumbnail">
											<div class="featured-thumbnail">
												<img src="<?php echo get_template_directory_uri(); ?>/images/nothumb-related.png" class="attachment-featured wp-post-image" alt="<?php the_title_attribute(); ?>">
												<?php if (function_exists('wp_review_show_total')) wp_review_show_total(true, 'latestPost-review-wrapper'); ?>
											</div>
											<header>
												<h4 class="title front-view-title"><?php the_title(); ?></h4>
											</header>
										</a>
									<?php } ?>
								</article><!--.post.excerpt-->
								<?php $pexcerpt++;?>
								<?php } echo '</div>'; }} wp_reset_postdata(); ?>
							<!-- End Related Posts -->
						<?php }?>  
						<?php if($ribbon_lite_authorbox_section == '1') { ?>
							<!-- Start Author Box -->
							<div class="postauthor">
								<h4><?php _e('About Author', 'ribbon-lite'); ?></h4>
								<?php if(function_exists('get_avatar')) { echo get_avatar( get_the_author_meta('email'), '85' );  } ?>
								<h5><?php the_author_meta( 'nickname' ); ?></h5>
								<p><?php the_author_meta('description') ?></p>
							</div>
							<!-- End Author Box -->
						<?php }?>  
						<?php comments_template( '', true ); ?>
					</div>
				</div>
			<?php endwhile; ?>
		</article>
		<!-- End Article -->
		<!-- Start Sidebar -->
		<?php get_sidebar(); ?>
		<!-- End Sidebar -->
	</div>
</div>
<?php get_footer(); ?>
