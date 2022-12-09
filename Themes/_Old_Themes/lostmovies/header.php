<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head profile="http://gmpg.org/xfn/11">
   <title><?php bloginfo('name'); ?><?php wp_title(); ?></title>
   
   <meta http-equiv="Content-Type" content="text/html; charset=<?php bloginfo('charset'); ?>" />
   <meta name="generator" content="WordPress <?php bloginfo('version'); ?>" /> <!-- leave this for stats -->

   <style type="text/css" media="screen">
       @import url( <?php bloginfo('stylesheet_url'); ?> );
   </style>
   
   <link rel="stylesheet" type="text/css" media="print" href="<?php echo get_settings('siteurl'); ?>/print.css" />
<link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="<?php bloginfo('rss2_url'); ?>" />
   <link rel="alternate" type="text/xml" title="RSS .92" href="<?php bloginfo('rss_url'); ?>" />
   <link rel="alternate" type="application/atom+xml" title="Atom 0.3" href="<?php bloginfo('atom_url'); ?>" />
   <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
   <?php wp_get_archives('type=monthly&format=link'); ?>
    
   <?php wp_head(); ?>
</head>

<body>
<div id="rap"><!-- for the whole page -->
  <!-- put your logo here 
  <img src="/wordpress/wp-content/themes/anarchy/logo.gif" alt="logo" align="left" style="margin:3px 5px 0 60px;" />
   end of your logo -->
<h1 id="header"><a href="<?php bloginfo('url'); ?>"><?php bloginfo('name'); ?></a><br><div style="font-size:13px;"><?php bloginfo('description'); ?></div></h1>
	
	 

<div id="content">
	<?php block_template_part( 'header' ); ?>