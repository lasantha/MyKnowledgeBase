<?php
/* Template Name: Site Review Page */
?>
<?php get_header(); ?>
<div class="container-fluid inner-page-wrp">
	<!-- breadcrumb -->
	<div class="row main-row">
		<!-- <div class="col-sm-3 left-section"></div> -->
		<div class="col-sm-12 right-section">
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
			<div class="row">
				<div class="col-xs-12">
					<?php $reviews = get_field('reviews'); ?>
					<?php foreach ($reviews as $key => $review): ?>
					<div class="col-md-4 col-sm-6 col-xs-12 review-wrp">
						<div class="row review-row">
							<div class="col-xs-12">
								<i class="fa fa-thumb-tack"></i>
								<img src="<?php echo $review['review_image']['url']; ?>" title="" class="img-responsive" />
							</div>
							<div class="col-xs-12">
								<p>
									<?php echo $review['review_content'];?>
								</p>
							</div>
							<div class="col-xs-12">
							<?php echo $review['reviewed_by']; ?>	
							<?php echo $review['reviewer_country'];?>
							<?php echo $review['reviewed_date'];?>
							</div>
						</div>
					</div>
					
					
					
					<?php endforeach ?>
				</div>
			</div>
			<?php endwhile; // End of the loop. ?>
		</div>

	</div>
</div>
<?php get_footer(); ?>