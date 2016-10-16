<?php
/* Template Name: Site Home Page */
?>
<?php get_header();?>
<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri();?>/css/test.css">
<div class="container section-margin" ng-app="myApp">
	<div class="main" ng-view></div>

</div>
<?php get_footer();?>