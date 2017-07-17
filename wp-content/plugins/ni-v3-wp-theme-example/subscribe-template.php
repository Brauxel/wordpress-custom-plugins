<?php
/*
Template Name: Subscribe Template
*/

get_header(); ?>

    		<div class="container">
    			<div class="row">
    				<div class="col-sm-12 mx-auto pt-5">
    					<div class="holder">
							<a href="#"><img class="img-fluid mb-5" src="<?php bloginfo('template_url'); ?>/assets/images/ni-black.svg" alt="Next Investors" title="Next Investors" width="220" /></a>
							<p>Hello,</p>
							<p>Please use the form below to update your preferences for which emails you would like to receive from the Next Investors Group.</p>
    					</div>
    				</div>
    				
    				<div class="col-sm-12 mt-3">
    					<div class="dark get-updates pl-5 pr-5">
    						<?= do_shortcode('[gravityform id="1" title="false" description="false"]'); ?>
						</div>
					</div>
    			</div>
			</div>

<?php get_footer(); ?>