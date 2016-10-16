<?php
/* Template Name: My Portfolio Page */
?>
<?php get_header();?>
<div ng-app="wpAngularTheme" class="row portfolio" ui-view>
	<!-- <div class="col-xs-12" >
		<h1>{{post_title}}</h1>
	</div>
	<div class="col-xs-12">
		<div class="row" >
			<div class="col-sm-3">
				<h2>{{web.title.rendered}}</h2>
				<a ng-href="{{web.link}}">
					<img ng-src="{{web.acf.thumbnail.url}}"  class="img-responsive"/>
				</a>
			</div>
		</div>
	</div> -->
</div>
<?php get_footer();?>