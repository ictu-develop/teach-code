<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Ribbon Lite
 */

get_header(); ?>

<div id="page" class="single">
	<article id="content" class="article page single_post">
		<header>
			<h1 class="title"><?php _e('Error 404 Not Found', 'ribbon-lite' ); ?></h1>
		</header>
		<div class="post-content">
			<p><?php _e('Oops! We couldn\'t find this Page.', 'ribbon-lite' ); ?></p>
			<p><?php _e('Please check your URL or use the search form below.', 'ribbon-lite' ); ?></p>
			<?php get_search_form();?>
		</div><!--.post-content--><!--#error404 .post-->
	</article>
	<?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>