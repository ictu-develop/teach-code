<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package my_vcard_resume
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<!--Hamburger Sidebar Menu-->
<a id="sidebar-expander" href="javascript:void(0)"><i class="fa fa-bars"></i></a>
<div class="sidewrapper sidenav">
  	<?php get_sidebar(); ?>
</div>

<div class="page">
<div class="container opened" data-animation-in="fadeInLeft" data-animation-out="fadeOutLeft">
<?php
/**
* Hook - my_vcard_resume_theme_header.
*
* @hooked my_vcard_resume_theme_header - 10
*/
do_action( 'my_vcard_resume_theme_header' );
?>













