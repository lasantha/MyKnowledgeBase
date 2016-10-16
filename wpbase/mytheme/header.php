<?php
/**
* The header for our theme.
*
* This is the template that displays all of the <head> section and everything up until <div id="content">
*
* @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
*
* @package myweb
*/

$_title	= $post->post_title;
$_custom_title = get_post_meta($post->ID, "page_title", true);
$_custom_keywords = get_post_meta($post->ID, "key_words", true);
$_custom_description = get_post_meta($post->ID, "page_description", true);
if(empty($_custom_description)){
	$_custom_description = get_post_meta(get_option('page_on_front'), "page_description", true);
}
$_blogname = get_option('blogname');
if ($_custom_title!=""){
	$_title = $_blogname ." | ".$_custom_title;
}
else{
	$_title = $_blogname ." | ".$post->post_title;
}

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head >
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="description" content="<?php echo $_custom_description;?>"/>
	<meta name="keywords" content="<?php echo $_custom_keywords;?>"/>
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta name="SKYPE_TOOLBAR" content="SKYPE_TOOLBAR_PARSER_COMPATIBLE" />
	<!-- https://developers.google.com/site-verification/v1/getting_started#intro -->
	<!-- <meta name="google-site-verification" content="" /> -->
	<!--[if lt IE 9]> HTML5Shiv
        <script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <link rel="shortcut icon" href="<?php echo get_template_directory_uri();?>/favicon.ico">
    <title><?php echo is_404()? "Page Not Found":$_title;?></title>
    <?php wp_head(); ?>
     <!-- <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Calibri"> -->
</head>

<body <?php body_class(); ?>>
	<div id="page" class="container-fluid">
		<div id="content" class="site-content">		
			<header>
				<div class="row">
					<div class="col-sm-2 col-xs-12 logo-wrapper">
						<?php echo do_shortcode('[site-logo]'); ?>
					</div>
					<div class="col-sm-10 col-xs-12">
						
					</div>
				</div>
			</header>
