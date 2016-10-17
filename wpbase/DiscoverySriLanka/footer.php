<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package DiscoverySriLanka
 */

?>

</div>
<footer>
	<div class="container-fluid">
		<div class="row">
			<?php wp_nav_menu( array( 'theme_location' => 'footer-menu' ) ); ?>
		</div>
		<div class="row">
			<div class="col-sm-4 footer-tour-packages">
				<h4>Tour Packages</h4>
				<ul>
					<?php 
					$packages = getPackages();
					foreach ($packages as $key => $value) :
					?>
					<li><a href="<?php echo get_the_permalink($key); ?>" title="<?php echo $value;?>"><?php echo $value;?></a></li>
					<?php endforeach;?>
				</ul>
			</div>
			<div class="col-sm-4 footer-top-destination">
				<h4>Top Destinations</h4>
				<ul>
					<?php 
					$destinations = getDestinations();
					$count = count($destinations);
					$destinations = array_splice($destinations,0,6);
					foreach ($destinations as $key => $value) :?>
					<li><a href="<?php echo $value['url']; ?>" title="<?php echo $value['title'];?>"><?php echo $value['title'];?></a></li>
					<?php endforeach;?>
					<?php if ($count > 6):?>
					<a href="/desinations" title="View More">View More</a>
					<?php endif; ?>
				</ul>
			</div>
			<div class="col-sm-4 footer-logo-area">
				<?php $footerLogo =  getSiteData('site_footer_logo'); ?>
				<div class="row">
					<div class="col-xs-12">
						<a href="<?php echo site_url(); ?>" title="<?php echo get_bloginfo( 'name' ); ?>">
							<img src="<?php echo $footerLogo['url'];?>" class="img-responsive" alt="<?php echo get_bloginfo( 'name' ); ?>" title="<?php echo get_bloginfo( 'name' ); ?>">
						</a>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-8">&copy; <?php echo date('Y'); ?> <?php echo getSiteData('site_rights'); ?> </div>
			<div class="col-sm-4">Design and Develop by :</div>
		</div>

	</div>
</footer>

<?php wp_footer(); ?>

</body>
</html>
