<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post - Packages
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
					<section>
						<?php the_content(); ?>
					</section>
					
				</div>
			</div>
			<div class="row">
				<div class="col-xs-12">
					<?php echo get_field('package_duration'); ?>
				</div>
				<div class="col-xs-12">
					<h4>Highlights</h4>
					<?php 
					$highlights = get_field('highlights'); 

					?>
					<ul class="highlights">
						<?php foreach ($highlights as $key => $value): ?>
							<li><?php echo $value['highlight']; ?></li>
						<?php endforeach ?>
					</ul>
				</div>
				<div class="col-xs-12">
					<h4>Rout</h4>
					<?php 
					$rout = get_field('rout'); 
					?>
					<ul class="rout">
						<?php foreach ($rout as $key => $value): ?>
							<li><?php echo (empty($value['icon'])) ? ' <i class="fa fa-long-arrow-right"></i>': $value['icon']; ?><?php echo $value['desination']; ?></li>
						<?php endforeach ?>
					</ul>
				</div>
				<div class="col-xs-12">
					<?php $day_plan = get_field('day_plan'); ?>
					<?php foreach ($day_plan as $key => $value): ?>
						<h4><?php echo $value['day']; ?> : <?php echo $value['plan']; ?></h4>
						<section>
						<?php echo $value['description']; ?>
						</section>
						
					<?php endforeach ?>
				</div>
			</div>
			<?php endwhile; // End of the loop. ?>
		</div>

	</div>
</div>
<?php
get_footer();
