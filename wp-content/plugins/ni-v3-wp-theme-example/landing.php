<?php
/*
Template Name: Landing Page
*/

// Fetch and store the $latest_posts via populate_latest() in functions.php
$latest_posts = populate_latest();

get_header(); ?>
			<div class="banner" id="video-banner-container">
				<div class="overlay">&nbsp;</div>
				<div id="video-banner" class="video-container">
					<video loop muted autoplay class="the-video" preload="auto">
						<source src="https://s3-ap-southeast-2.amazonaws.com/sdnewsdesk/nextinvestors_2.mp4" type="video/mp4">
					</video>
				<!--div#video-banner ENDS -->
				</div>
			
				<section class="banner-content">
           			<div class="wrap">
           				<div class="container">
           					<div class="row">
           						<div class="col-md-8 mx-auto">
           							<!--<a id="logo" href="#"><svg class="logo-svg"><use xlink:href="#ni-logo"></use></svg></a>-->
           							<h1><a class="logo mx-auto mb-5 pb-5" href="#"><img class="img-fluid" src="<?= $logo; ?>" alt="Next Investors" title="Next Investors" /><span>Next Investors</span></a></h1>
           							<p>The Next Investors group of websites are your window into the world of small cap stock investing. Focusing on speculative technology, mining, oil and gas and biotech stocks, Next Investors keeps you up to date with emerging companies and investment trends, and gives you the information to make more informed investment decisions.</p>
           						</div>
           					</div>
           					
           					<div class="row">
           						<div class="col-sm-12">
									<p class="space-top">Choose one of the categories below to get insight from a team of experienced industry professionals.</p>
           						</div>
           					</div>
           					
							<div class="row tiles">
								<div class="col-sm-2 tile offset-sm-1">
									<a href="<?= get_site_url(9); ?>"><img class="img-fluid tiled-logo" src="<?php bloginfo('template_url'); ?>/assets/images/mining.jpg" /></a>
									<a href="<?= get_site_url(9); ?>" class="title nmb-title"><img class="img-fluid" src="<?php bloginfo('template_url'); ?>/assets/images/nmb-title.png" /></a>
								</div>

								<div class="col-sm-2 make-relative tile">
									<a href="<?= get_site_url(10); ?>"><img class="img-fluid tiled-logo" src="<?php bloginfo('template_url'); ?>/assets/images/oil.jpg" /></a>
									<a href="<?= get_site_url(10); ?>" class="title"><img class="img-fluid" src="<?php bloginfo('template_url'); ?>/assets/images/nor-title.png" /></a>
								</div>

								<div class="col-sm-2 make-relative tile">
									<a href="<?= get_site_url(12); ?>"><img class="img-fluid tiled-logo" src="<?php bloginfo('template_url'); ?>/assets/images/techstock.jpg" /></a>
									<a href="<?= get_site_url(12); ?>" class="title"><img class="img-fluid" src="<?php bloginfo('template_url'); ?>/assets/images/nts-title.png" /></a>
								</div>

								<div class="col-sm-2 make-relative tile">
									<a href="<?= get_site_url(13); ?>"><img class="img-fluid tiled-logo" src="<?php bloginfo('template_url'); ?>/assets/images/small-cap.jpg" /></a>
									<a href="<?= get_site_url(13); ?>" class="title"><img class="img-fluid" src="<?php bloginfo('template_url'); ?>/assets/images/nsc-title.png" /></a>
								</div>

								<div class="col-sm-2 make-relative tile">
									<a href="<?= get_site_url(15); ?>"><img class="img-fluid tiled-logo" src="<?php bloginfo('template_url'); ?>/assets/images/biotech.jpg" /></a>
									<a href="<?= get_site_url(15); ?>" class="title"><img class="img-fluid" src="<?php bloginfo('template_url'); ?>/assets/images/nbt-title.png" /></a>
								</div>

								<!--<div class="col-sm-2 make-relative tile">
									<a href="https://raisebook.com/"><img class="img-fluid tiled-logo" src="<?php //bloginfo('template_url'); ?>/assets/images/raisebook.jpg" /></a>
									<a href="https://raisebook.com/" class="title"><img class="img-fluid" src="<?php //bloginfo('template_url'); ?>/assets/images/rb-title.png" /></a>
								</div>-->
							</div>           					
           				</div>
           			</div>
	           	</section>
			</div>
   	
			<div class="dark get-updates" id="keep-me-informed">
				<div class="container">
					<?= do_shortcode('[gravityform id="'.$formID.'" title="true" description="true"]'); ?>
				</div>
			</div>
   	
   			<div class="panel nmb-panel jumbotron">
   				<div class="overlay">&nbsp;</div>
   				<div class="container">
   					<div class="row">
   						<div class="col-lg-5 float-right offset-lg-7">
   							<img src="<?php bloginfo('template_url'); ?>/assets/images/nmb.svg" class="mb-5" alt="Next Mining Boom" title="Next Mining Boom" height="50" />
   							<h3 class="mt-4"><?= $latest_posts[0][0]['post_title']; ?></h3>
   							<a class="float-right clearfix btn btn-outline-primary mt-5" href="<?= get_blog_permalink(9, $latest_posts[0][0]['id']) ?>">Read Article</a>
   						</div>
   					</div>
   				</div>
   			</div>
   			
   			<div class="dark">
   				<div class="container">
   					<div class="row text-center">
   						<div class="col-lg-7 mx-auto">
   							<p>The Next Mining Boom is your comprehensive source of information for junior stocks in the mining sector. Find out the latest on gold and lithium stocks, and everything in between.</p>
   							<a class="btn btn-outline-primary mt-5" href="<?= get_site_url(9); ?>">View all articles</a>
   						</div>
   					</div>
   				</div>
			</div>
   	
   			<div class="panel nor-panel jumbotron">
   				<div class="overlay">&nbsp;</div>
   				<div class="container">
   					<div class="row">
   						<div class="col-lg-5">
   							<img src="<?php bloginfo('template_url'); ?>/assets/images/nor.svg" class="mb-5" alt="Next Oil Rush" title="Next Oil Rush" height="50" />
   							<h3 class="mt-4"><?= $latest_posts[1][0]['post_title']; ?></h3>
   							<a class="float-right clearfix btn btn-outline-primary mt-5" href="<?= get_blog_permalink(10, $latest_posts[1][0]['id']) ?>">Read Article</a>
   						</div>
   					</div>
   				</div>
   			</div>
   			
   			<div class="dark">
   				<div class="container">
   					<div class="row text-center">
   						<div class="col-lg-7 mx-auto">
   							<p>The Next Oil Rush drills down to the core of what makes a junior oil stock successful.<br>We offer investors insight into market sentiment and the oil and gas stocks to watch in Australia and overseas.</p>
   							<a class="btn btn-outline-primary mt-5" href="<?= get_site_url(10); ?>">View all articles</a>
   						</div>
   					</div>
   				</div>
			</div>
  			
   			<div class="panel nts-panel jumbotron">
   				<div class="overlay">&nbsp;</div>
   				<div class="container">
   					<div class="row">
   						<div class="col-lg-5 float-right offset-lg-7">
   							<img src="<?php bloginfo('template_url'); ?>/assets/images/nts.svg" class="mb-5" alt="Next Tech Stock" title="Next Tech Stock" height="50" />
   							<h3 class="mt-4"><?= $latest_posts[2][0]['post_title']; ?></h3>
   							<a class="float-right clearfix btn btn-outline-primary mt-5" href="<?= get_blog_permalink(12, $latest_posts[2][0]['id']) ?>">Read Article</a>
   						</div>
   					</div>
   				</div>
   			</div>
   			
   			<div class="dark">
   				<div class="container">
   					<div class="row text-center">
   						<div class="col-lg-7 mx-auto">
   							<p>We take you behind the scenes and help you engage with up and coming small cap tech stocks.</p>
   							<a class="btn btn-outline-primary mt-5" href="<?= get_site_url(12); ?>">View all articles</a>
   						</div>
   					</div>
   				</div>
			</div>
   	
   			<div class="panel nsc-panel jumbotron">
   				<div class="overlay">&nbsp;</div>
   				<div class="container">
   					<div class="row">
   						<div class="col-lg-5">
							<img src="<?php bloginfo('template_url'); ?>/assets/images/nsc.svg" class="mb-5" alt="Next Small Cap" title="Next Small Cap" height="50" />
   							<h3 class="mt-4"><?= $latest_posts[3][0]['post_title']; ?></h3>
   							<a class="float-right clearfix btn btn-outline-primary mt-5" href="<?= get_blog_permalink(13, $latest_posts[3][0]['id']); ?>">Read Article</a>
   						</div>
   					</div>
   				</div>
   			</div>
   			
   			<div class="dark">
   				<div class="container">
   					<div class="row text-center">
   						<div class="col-lg-7 mx-auto">
   							<p>The Next Small Cap puts you in the small cap investment information chain, offering small cap investment news for the investor who likes to stay informed.</p>
   							<a class="btn btn-outline-primary mt-5" href="<?= get_site_url(13); ?>">View all articles</a>
   						</div>
   					</div>
   				</div>
			</div>
   	
   			<div class="panel nbt-panel jumbotron">
   				<div class="overlay">&nbsp;</div>
   				<div class="container">
   					<div class="row">
   						<div class="col-lg-5 float-right offset-lg-7">
   							<img src="<?php bloginfo('template_url'); ?>/assets/images/nbt.svg" class="mb-5" alt="Next Biotech" title="Next Biotech" height="50" />
   							<h3 class="mt-4"><?= $latest_posts[4][0]['post_title']; ?></h3>
   							<a class="float-right clearfix btn btn-outline-primary mt-5" href="<?= get_blog_permalink(15, $latest_posts[4][0]['id']); ?>">Read Article</a>
   						</div>
   					</div>
   				</div>
   			</div>
   			
   			<div class="dark">
   				<div class="container">
   					<div class="row text-center">
   						<div class="col-lg-7 mx-auto">
   							<p>From technology to marvelous medical cures, The Next Biotech informs investors about up and coming biotech stocks and the good work they are doing in the medical innovation space.</p>
   							<a class="btn btn-outline-primary mt-5" href="<?= get_site_url(15); ?>">View all articles</a>
   						</div>
   					</div>
   				</div>
			</div>
   	
   			<!--<div class="panel raisebook-panel jumbotron">
   				<div class="overlay">&nbsp;</div>
   				<div class="container">
   					<div class="row">
   						<div class="col-lg-5 float-right offset-lg-7">
   							<img src="<?php //bloginfo('template_url'); ?>/assets/images/raisebook.svg" class="mb-5" alt="Raisebook" title="Raisebook" height="57" />
   							<h3 class="mb-5">Targeted Investments <br>for the Sophisticated Investor</h3>
   							<a class="clearfix btn btn-outline-primary mt-5" href="https://raisebook.com/" target="_blank">View Deals</a>
   						</div>
   					</div>
   				</div>
   			</div>-->
    
<?php get_footer(); ?>