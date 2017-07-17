<?php
	if( get_current_blog_id() == 1 ) {
		$formID =  1;
		$footerFormsTitle = 'Follow Next Investors';
		$logo = get_bloginfo('template_url').'/assets/images/ni.svg';
	}

	if( get_current_blog_id() == 9 ) {
		$formID =  45;
		$sidebarFormId = 49;
		$logo = get_bloginfo('template_url').'/assets/images/nmb.svg';
		$footerFormsTitle = 'Follow Next Mining Boom';
	} 

	//Set options for Next Oil Rush
	if( get_current_blog_id() == 10 ) {
		$formID = 50;
		$sidebarFormId = 53;
		$logo = get_bloginfo('template_url').'/assets/images/nor.svg';
		$footerFormsTitle = 'Follow Next Oil Rush';
	}

	//Set options for Next Tech Stock
	if( get_current_blog_id() == 12 ) {
		$formID =  23;
		$sidebarFormId = 32;
		$logo = get_bloginfo('template_url').'/assets/images/nts.svg';
		$footerFormsTitle = 'Follow Next Tech Stock';
	}

	//Set options for Next Small Cap
	if( get_current_blog_id() == 13 ) {
		$formID =  58;
		$sidebarFormId = 63;
		$logo = get_bloginfo('template_url').'/assets/images/nsc.svg';
		$footerFormsTitle = 'Follow Next Small Cap';
	}

	//Set options for Next Biotech
	if( get_current_blog_id() == 15 ) {
		$formID =  7;
		$sidebarFormId = 10;
		$logo = get_bloginfo('template_url').'/assets/images/nbt.svg';
		$footerFormsTitle = 'Follow Next Biotech';
	}
?>