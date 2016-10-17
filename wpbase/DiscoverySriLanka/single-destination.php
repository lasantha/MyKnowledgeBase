<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post - destinations
 *
 * @package DiscoverySriLanka
 */

get_header(); ?>
<div class="container-fluid inner-page-wrp">
	<!-- breadcrumb -->
	<div class="row main-row">
		<div class="col-sm-3 left-section"></div>
		<div class="col-sm-9 right-section">
			<?php while ( have_posts() ) : the_post(); ?>
			<div class="row">
				<!-- breadcrumb area -->
				<div class="col-xs-12">
					<div class="breadcrumb"><?php get_breadcrumb(); ?></div>
				</div>
			</div>
			<div class="row">
				<!-- Page Title  -->
				<div class="col-xs-12">
					<h1><?php the_title();  ?></h1>
				</div>
			</div>
			<div class="row">
				<!-- main content area -->
				<div class="col-xs-12">
					<?php the_content(); ?>
				</div>
			</div>
			<?php endwhile; // End of the loop. ?>
		</div>

	</div>
</div>
<?php
get_footer();
