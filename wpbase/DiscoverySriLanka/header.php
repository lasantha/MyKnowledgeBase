<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package DiscoverySriLanka
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title><?php set_title(); ?></title>
	<meta name="description" content="<?php set_description(); ?>"/>
	<meta name="keywords" content="<?php set_keywords(); ?>"/>
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta name="SKYPE_TOOLBAR" content="SKYPE_TOOLBAR_PARSER_COMPATIBLE" />
	<link rel="shortcut icon" href="<?php echo get_template_directory_uri();?>/favicon.ico">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<header>
		<div class="header-nav-container">
			<div class="container-fluid">
				<div class="row">
					<div class="col-xs-12">
						<div class="row">
							<div class="col-md-2 col-sm-3 logo-wrap">
								<?php $logo = getSiteData('site_main_logo'); ?>
								<a href="<?php echo site_url(); ?>" title="<?php echo get_bloginfo( 'name' ); ?>">
									<img src="<?php echo $logo['url']; ?>" alt="<?php echo get_bloginfo( 'name' ); ?>" title="<?php echo get_bloginfo( 'name' ); ?>" class="img-responsive">
								</a>
							</div>
							<div class="col-md-10 col-sm-9 nav-wrap">
								<div class="row">
									
									<nav>
										<div class="mobile-menu-icon-wrp">
											<span>
												<i class="fa fa-reorder"></i>
											</span>
										</div>
										<?php  clean_custom_menu("primary"); ?>
									</nav>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class=" header-container container-fluid">
			
			<div class="row header-sliders-wrapper">
				<div class=" header-main-sliders">
					<?php $mainSlider = getSiteData('main_slider'); ?>
					<div class="carousel slide" id="carousel-main">
						<div class="carousel-inner">
							<?php 
							$i = 0;
							foreach ($mainSlider as $key => $value):
							?>
							<div class="item <?php echo ($i == 0)?'active':'';?>">
								<img alt="Carousel Bootstrap First" src="<?php echo $value['slider_image']['url']; ?>" alt="" title="" class="img-responsive"/>
							</div>	
							<?php $i++;endforeach ?>
						</div> 
						<div class="main-slider-controllers">
							<a class="left carousel-control" href="#carousel-main" data-slide="prev">
								<span class="glyphicon glyphicon-chevron-left"></span>
							</a> 
							<a class="right carousel-control" href="#carousel-main" data-slide="next">
								<span class="glyphicon glyphicon-chevron-right"></span>
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="container booking-container">
			<div class="title">
				Check Availability
			</div>
			<form methos="POST" action="">
			<div class="booking-wrp">
				<div class="col-sm-4 packages">
					<div class="inpt-wrp">
						<input type="text" name="packages" vlaue="" class="" readonly/>
						<i class="fa fa-angle-down"></i>
					</div>
					<label>Our Packages</label>
					<ul>
						<?php 
						$packages = getPackages();
						foreach ($packages as $key => $value) :
						?>
						<li><?php echo $value;?></li>
						<?php endforeach;?>
					</ul>
			</div>
			<div class="col-sm-4 destinations">
				<div class="inpt-wrp">
					<input type="text" name="destinations" vlaue="" class="" readonly />
					<i class="fa fa-angle-down"></i>
				</div>
				<label>Top Destinations</label>
				<ul>
					<?php 
					$destinations = getDestinations();
					foreach ($destinations as $key => $value) :
					?>
					<li><?php echo $value;?></li>
					<?php endforeach;?>
				</ul>
		</div>	
		<div class="col-sm-2 bkdate">
			<div class="inpt-wrp">
				<input type="text" name="bkdate" vlaue="" class="" />
				<i class="fa  fa-calendar"></i>
			</div>
			<label>Date</label>
		</div>
		<div class="col-sm-2 submit">
			<div class="inpt-wrp">
				<button type="submit" name="submit" vlaue="submit" class="btn btn-default">
					Submit<i class="fa  fa-hand-pointer-o"></i>
				</button>

			</div>
		</div>
	</div>
	</form>
</div>
</header>
<div class="content-wrap">

<?php 
// echo get_client_ip(); 
// echo get_client_ip_server();
?>