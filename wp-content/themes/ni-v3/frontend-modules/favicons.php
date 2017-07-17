    <?php 
		// Set initial value foe favicons which will be overwritten based on the blog ID
		$favicon_path = "ni-favicons";
		$ie_fav = "next-investors";
	
		if ( get_current_blog_id() == 9 ) {
			$favicon_path = "nmb-favicons";
			$ie_fav = "next-mining-boom";
		}
	
		if ( get_current_blog_id() == 10 ) {
			$favicon_path = "nor-favicons";
			$ie_fav = "next-oil-rush";
		}
	
		if ( get_current_blog_id() == 12 ) {
			$favicon_path = "nts-favicons";
			$ie_fav = "next-tech-stock";
		}
	
		if ( get_current_blog_id() == 13 ) {
			$favicon_path = "nsc-favicons";
			$ie_fav = "next-small-cap";
		}
	
		if ( get_current_blog_id() == 15 ) {
			$favicon_path = "nbt-favicons";
			$ie_fav = "next-bio-tech";
		}
	?>
	
	<!-- Generate dynamic favicons based on the variables assigned earlier -->
	<link rel="apple-touch-icon" sizes="57x57" href="<?php bloginfo( 'template_url' ); ?>/<?php echo $favicon_path; ?>/apple-icon-57x57.png">
	<link rel="apple-touch-icon" sizes="60x60" href="<?php bloginfo( 'template_url' ); ?>/<?php echo $favicon_path; ?>/apple-icon-60x60.png">
	<link rel="apple-touch-icon" sizes="72x72" href="<?php bloginfo( 'template_url' ); ?>/<?php echo $favicon_path; ?>/apple-icon-72x72.png">
	<link rel="apple-touch-icon" sizes="76x76" href="<?php bloginfo( 'template_url' ); ?>/<?php echo $favicon_path; ?>/apple-icon-76x76.png">
	<link rel="apple-touch-icon" sizes="114x114" href="<?php bloginfo( 'template_url' ); ?>/<?php echo $favicon_path; ?>/apple-icon-114x114.png">
	<link rel="apple-touch-icon" sizes="120x120" href="<?php bloginfo( 'template_url' ); ?>/<?php echo $favicon_path; ?>/apple-icon-120x120.png">
	<link rel="apple-touch-icon" sizes="144x144" href="<?php bloginfo( 'template_url' ); ?>/<?php echo $favicon_path; ?>/apple-icon-144x144.png">
	<link rel="apple-touch-icon" sizes="152x152" href="<?php bloginfo( 'template_url' ); ?>/<?php echo $favicon_path; ?>/apple-icon-152x152.png">
	<link rel="apple-touch-icon" sizes="180x180" href="<?php bloginfo( 'template_url' ); ?>/<?php echo $favicon_path; ?>/apple-icon-180x180.png">
	<link rel="icon" type="image/png" sizes="192x192"  href="<?php bloginfo( 'template_url' ); ?>/<?php echo $favicon_path; ?>/android-icon-192x192.png">
	<link rel="icon" type="image/png" sizes="32x32" href="<?php bloginfo( 'template_url' ); ?>/<?php echo $favicon_path; ?>/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="96x96" href="<?php bloginfo( 'template_url' ); ?>/<?php echo $favicon_path; ?>/favicon-96x96.png">
	<link rel="icon" type="image/png" sizes="16x16" href="<?php bloginfo( 'template_url' ); ?>/<?php echo $favicon_path; ?>/favicon-16x16.png">
	<link rel="manifest" href="<?php bloginfo( 'template_url' ); ?>/<?php echo $favicon_path; ?>/manifest.json">
	<meta name="msapplication-TileColor" content="#ffffff">
	<meta name="msapplication-TileImage" content="<?php bloginfo( 'template_url' ); ?>/<?php echo $favicon_path; ?>/ms-icon-144x144.png">
	<meta name="theme-color" content="#ffffff">
	<!--[if IE]>
	<link rel="shortcut icon" type="image/x-icon" href="<?php bloginfo( 'template_url' ); ?>/<?php echo $favicon_path; ?>/favicon.ico">
	<![endif]-->