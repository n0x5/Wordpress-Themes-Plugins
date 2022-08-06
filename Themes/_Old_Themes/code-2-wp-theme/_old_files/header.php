<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section 
 *
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta name="viewport" content="initial-scale=1">
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<link href='http://fonts.googleapis.com/css?family=Special+Elite' rel='stylesheet' type='text/css'>	
        <link rel="shorcut icon" type="image/x-ico" href="<?php echo get_template_directory_uri(); ?>/images/favicon.ico" />	
        <link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	
	<?php wp_head(); ?>
</head>


<body <?php body_class(); ?>>


<?php get_sidebar(); ?>
<div id="page">
	<div id="header">
