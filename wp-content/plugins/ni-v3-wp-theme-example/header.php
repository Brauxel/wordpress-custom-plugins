<!doctype html>
<html class="no-js" lang="">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title><?php the_title(); ?></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/4.2.0/normalize.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js"></script>
        
        <?php include_once "frontend-modules/favicons.php"; ?>
        
        <?php wp_head(); ?>
		<!-- Google Tag Manager -->
		<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
		new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
		j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
		'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
		})(window,document,'script','dataLayer','GTM-T7FGH6');</script>
		<!-- End Google Tag Manager -->
        
		<!-- Begin Push WP variables to DataLayer --> 
		<script type="text/javascript">
		// URL toolbox - helps grabbing elements in the URL
		var _d = document;
		var _dl = _d.location;
		var _dlp = _dl.pathname;
		var _dls = _dl.search;
		var _dr = _d.referrer;

		// Check if data layer has been declared and start pushing variables from WordPress 
		window.dataLayer = window.dataLayer || [];
		dataLayer.push({
		<?php 
		if (is_404()){
		// 404 pages, handled with a /404/ prefix as well as the referrer ?>
		'GTM_WP_404': '<?php print is_404(); ?>',
		'GTM_WP_404_URL': '/404' + _dlp + '/'+ _dr,
		<?php } ?>
		<?php if(is_home()){
		// Home page is tagged manually here but can be done directly in GTM
		?>
		'GTM_WP_post_type': 'Home',
		'GTM_WP_Category': 'Home',
		<?php } ?>

		<?php if (is_single()||is_page()){
		/* Content pages: either a post or a page
		*  Query the WP API to retrieve post/page type, author, number of comments, tag, or even custom variables
		*/
		$gtm_cat = get_the_category();

		// Get Salesforce Custom Fields
		$gtm_forceaccount = get_post_meta( get_the_ID(), 'salesforce_account_field', TRUE );
		$gtm_forcecontent = get_post_meta( get_the_ID(), 'salesforce_content_item_field', TRUE );

		// post/page Tags being passed as one big string separated by spaces
		$posttags = get_the_tags();
		if ($posttags) {
		foreach($posttags as $tag) {
		$gtm_tags .= $tag->name . ' , ';
		}
		}

		// Populate the data layer with PHP variables
		?>
		'GTM_WP_authorname': '<?php the_author(); ?>',
		'GTM_WP_post_type': '<?php print get_post_type(); ?>',
		'GTM_WP_Number_Comments': '<?php print get_comments_number(); ?>',
		'GTM_WP_Category': '<?php print $gtm_cat[0]->cat_name; ?>',
		'GTM_WP_Tags': '<?php print trim($gtm_tags); ?>',
		<?php }
		// Done with WordPress page type/conditions, you can add more default dataLayer variables below ?>
		'GTM_WP_date': '<?php print the_date( $format, $before, $after, $echo ); ?>',
		'GTM_Salesforce_Account': '<?php print trim($gtm_forceaccount); ?>',
		'GTM_Salesforce_Content_Item' : '<?php print trim($gtm_forcecontent); ?>'
		});
		</script>
		<!-- End Push WP variables to DataLayer -->
    </head>
    <body <?php body_class(); ?>>
		<!-- Google Tag Manager (noscript) -->
		<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-T7FGH6"
		height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
		<!-- End Google Tag Manager (noscript) -->
    	<?= file_get_contents(get_bloginfo('template_url'). "/assets/images/social.svg"); ?>
    	<?= file_get_contents(get_bloginfo('template_url'). "/assets/images/ni-menu.svg"); ?>
    	<?= file_get_contents(get_bloginfo('template_url'). "/assets/images/search-icon.svg"); ?>
    	    	
    	<div class="overlay main-overlay">&nbsp;</div>

		<div class="alert-row">
			<div class="alert alert-warning alert-dismissible fade show w-100" role="alert">
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
			    <span aria-hidden="true">&times;</span>
			  </button>
			  You are currently viewing a preview version of the new Next Investors site. This site does not have the latest articles. <br>
			  Please take your time to look around and complete our short 2 minute survey - <a href="https://www.surveymonkey.com/r/78R7928" target="_blank">click here</a>
			</div>
		</div>    	

    	<header class="fixed-top w-100">
    		
    		<div class="container">
				<div class="row menu-row">
					<div class="col-sm-1 logo">
						<a href="<?php echo network_site_url(); ?>">
							<svg viewBox="0 0 40 40" preserveAspectRatio="xMaxYMax">
								<use xlink:href="#ni-menu">
							</svg>
							
							<img src="<?php bloginfo( 'template_url' ); ?>/assets/images/ni-menu_white.svg" alt="Next Investors" title="Next Investors" width="40" height="40" />
						</a>
					</div>
					
					<div class="col-sm-8">
						<nav class="align-wrapper">
							<div class="logo logo-res">
								<a href="<?php echo network_site_url(); ?>">
									<svg viewBox="0 0 40 40" preserveAspectRatio="xMaxYMax">
										<use xlink:href="#ni-menu">
									</svg>
								</a>
							</div>
							
							<div class="align-middle">
								<div class="navbar-res">
									<?php global_site_search_form() ?>
								</div>

								<?php wp_nav_menu( array('menu' => 'Main Menu', 'menu_class' => 'main-menu row text-left', 'walker' => new Walker_Nextinvestors_Menu()) ); ?>

								<a class="btn btn-outline-primary res-menu-subscribe" href="<?php echo network_site_url(); ?>#keep-me-informed">Receive latest updates</a>
							</div>
						</nav>
					</div>

					<div class="col-sm-3 toggler">
						<button class="nav-toggle float-right border-0" type="button" data-toggle="collapse" data-target="#navbarsExampleCenteredNav" aria-controls="navbarsExampleCenteredNav" aria-expanded="false" aria-label="Toggle navigation"><span aria-label="Mobile Menu Icon"></span></button>
					
						<?php global_site_search_form() ?>
					</div>
				</div>
			</div>
    	</header>
    	
    	<main<?php if(is_page('site-search')): ?> id="search-page"<?php endif; ?>>
    	<?php include 'email-a-friend.php';?>