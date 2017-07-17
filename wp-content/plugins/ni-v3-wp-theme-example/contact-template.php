<?php
/*
Template Name: Contact Template
*/

get_header(); ?>

    		<div class="container">
    			<div class="row">
    				<div class="col-sm-10 mx-auto pt-5">
    					<a href="#"><img class="img-fluid mb-5" src="<?php bloginfo('template_url'); ?>/assets/images/ni-black.svg" alt="Next Investors" title="Next Investors" width="350" /></a>
						<p>Thanks for visiting Next Investors.</p>
						<p>If you would like to get in touch with us, please enter your details below and we will get back to within 2 business days.,</p>
    				</div>
    				
    				<div class="col-sm-12">
    					<div class="dark get-updates pl-5 pr-5">
    						<?= do_shortcode('[gravityform id=8 title="false" description="false" ajax="true" tabindex=49]'); ?>
						</div>
					</div>
    			</div>
			</div>

<?php get_footer(); ?>