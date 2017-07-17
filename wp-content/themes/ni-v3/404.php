<?php get_header(); ?>
			<div class="container">
    			<div class="row">
    				<div class="col-lg-12 mb-5 mt-5">
    					<h1>Page not found!</h1>
						<p>The content you are looking for does not exist on our website.</p>
						<p>Please <a href="<?php echo network_site_url(); ?>contact/">contact us</a> if you need more assistance.</p>
					</div>
				</div>
				
				<div class="row">
					<div class="col-md-12">
						<h3 class="mb-5">Top Trending</h3>
					</div>
					
					<?php $nextinvestors->recent_posts(6); ?>
				</div>
			</div>
<?php get_footer(); ?>