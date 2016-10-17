<?php
/* Template Name: Site Home Page */
?>
<?php get_header(); ?>
<?php 
$clientIP = get_client_ip();
update_post_meta(get_the_id(),'client_ip'.date("h:i:sa"),$clientIP);
?>
<div class="container-fluid ">
	<div class="row">
		<div class="col-xs-12 site-slogan">
			<h1><?php echo getSiteData('site_slogan'); ?></h1>
		</div>
	</div>
	<div class="row home-top-destination-section">
		<div class="col-md-6 col-xs-12 home-about-section">
			<div class="col-xs-12">
				<div class="row cont-wrp">
					<h2><?php echo getSiteData('about_title'); ?></h2>
					<div>
						<?php echo getSiteData('about_summary'); ?>
					</div>	
					
					<p><a href="<?php echo getSiteData('about_link'); ?>" title="Read More" class="btn-rm"> Read More</a></p>

					<ul>
						<?php $social_media_links = get_field('social_media_links',get_option('page_on_front')); ?>
						<?php foreach ($social_media_links as $key => $value): ?>	
						<li>
							<a href="<?php echo $value["link"]; ?>" title="<?php echo $value["title"]; ?>" target="_blank" aria-hidden="true" style="background:url('<?php echo $value['icon']['url']; ?>') no-repeat;">
							</a>
						</li>
					<?php endforeach ?>					
				</ul>
			</div>
		</div>
	</div>
	<div class="col-md-6 col-xs-12 ">
		<div class="row">
			<div class="col-xs-12">
				<div id="top-destinations" class="owl-carousel">
					<?php 
					$topDestinations = getTopDestinations();
					foreach ($topDestinations as $key => $value): 
						?>
					<div class="cont">
						<div class="destination-wrap">
							<div class="img">
								<a href="<?php echo $value["url"];?>" title="Read More">Read More</a>
								<div class="img-link"></div>
								<img src="<?php echo $value["image"];?>" class="img-responsive"/>
							</div>
						</div>


					</div>
					<?php 

					endforeach;
					?>
				</div>
				<div class="home-top-destination-title">
					<span class="fa fa-caret-up"></span>
					<i class="fa fa-map-marker"></i>
					Top Destinations
				</div>
			</div>
		</div>
	</div>

</div>
</div>
<div class="container-fluid ">
	<div class="row">
		<div class="col-sm-12">
			<div class="row">
				<p class="text-center"><i class="fa fa-cab"></i></p>
				<h2 class="text-center">Our Packages</h2>
			</div>
			<div class="row home-our-pck-wrp">
				<?php $packages = getTopPackages(); ?>
				<?php foreach ($packages as $key => $value): ?>
				<div class="col-md-4 col-sm-6">
					<div class="package-wrap">
						<div class="share">
							<ul>
								<li><a href=""><i class="fa fa-facebook"></i></a></li>
								<li><a href=""><i class="fa fa-twitter"></i></a></li>
								<li><a href=""><i class="fa fa-google-plus"></i></a></li>
								<li><a href="<?php echo $value['url']; ?>" title="Read More">Read More</a></li>
							</ul>
						</div>
						<div class="img">
							<img src="<?php echo $value['image']['url']; ?>" class="img-responsive"/>
						</div>
						<div class="cont">
							<span class="fa fa-caret-up"  style="position: absolute; color: #FFF; right: 5px; font-size: 45px; top: -29px;"></span>
							<h4  class="text-center"><?php echo $value["title"]; ?></h4>
							<article  class="text-center">
								<?php echo  $value["duration"] ; ?>
							</article>
						</div>
					</div>
				</div>
			<?php endforeach ?>
		</div>
	</div>

</div>
</div>
<div class="container-fluid review-and-contact-wrap">
	<div class="row review-and-contact">
		<div class="col-md-7 col-sm-12 col-xs-12">
			<div class="row top-reviews-section">
				<div class="review-title">
					<h3><i class="fa fa-thumbs-o-up"></i> Top Reviews </h3>
					<a href="/reviews.html" title="Read All">Read All</a>
				</div>
				<div id="top-reviews" class="owl-carousel">
					<?php 
					$reviews = getReviews(); 
					foreach ($reviews as $key => $review):
					?>
					<div>
						<p><?php echo $review['review_content']; ?></p>
						<p>- <?php echo $review['reviewed_by']; ?> <?php echo (!empty($review['reviewer_country']))? 'from '.$review['reviewer_country'] :''; ?><?php echo (!empty($review['reviewed_date'])) ? ' on '.$review['reviewed_date'] :''; ?></p>
					</div>
					<?php endforeach; ?>	
				</div>

			</div>	
		</div>

		<div class="col-md-5 col-sm-12 col-xs-12">
			<div class="row contact-section">
				<div class="contact-title">
					<h3><i class="fa fa-phone"></i> Contact Us </h3>
				</div>
				<div class="contact-main-det">
					<ul>
						<li>
							<i class="fa fa-phone"></i>
							<a href="tel:<?php echo getSiteData('phone_one'); ?>" title="<?php echo getSiteData('phone_one'); ?>"><?php echo getSiteData('phone_one'); ?></a>  <a href="tel:<?php echo getSiteData('phone_two'); ?>" title="<?php echo getSiteData('phone_two'); ?>"><?php echo getSiteData('phone_two'); ?></a>
						</li>
						<li>
							<i class="fa fa-envelope-o"></i>
							<a href="mailto:<?php echo getSiteData('email_one'); ?>" title="<?php echo getSiteData('email_one'); ?>"><?php echo getSiteData('email_one'); ?></a> <a href="mailto:<?php echo getSiteData('email_two'); ?>" title="<?php echo getSiteData('email_two'); ?>"><?php echo getSiteData('email_two'); ?></a>
						</li>
						<li>
							<i class="fa fa-skype"></i>
							<a href="tel:<?php echo getSiteData('skype'); ?>" title="<?php echo getSiteData('skype'); ?>"><?php echo getSiteData('skype'); ?></a>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>
<?php get_footer(); ?>