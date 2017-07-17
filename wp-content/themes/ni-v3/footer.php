<?php global $footerFormsTitle; ?>
		</main>
    	
    	<footer>
    		<div class="container">
    			<div class="row">
    				<div class="col-md-3 mt-5">
						<?php if(get_current_blog_id() == 1): ?>
 							<h4>Our Sites</h4>
  							<ul class="secondary-nav mt-4">
  								<li><a href="<?= get_site_url(9); ?>">Next Mining Boom</a></li>
  								<li><a href="<?= get_site_url(10); ?>">Next Oil Rush</a></li>
  								<li><a href="<?= get_site_url(12); ?>">Next Tech Stock</a></li>
  								<li><a href="<?= get_site_url(13); ?>">Next Small Cap</a></li>
  								<li><a href="<?= get_site_url(15); ?>">Next Biotech</a></li>
  							</ul>
  						<?php else: ?>
  							<?php $queried_object = get_queried_object(); ?>
							<h4>Follow Us</h4>
							<ul class="social-icons mt-4">
								<?php if(!empty(get_field('facebook', $queried_object->ID))): ?>
								<li>
									<a href="<?php the_field('facebook', $queried_object->ID); ?>" target="_blank">
										<svg class="icon icon-facebook-square">
											<use xlink:href="#icon-facebook-square">
										</svg>
									</a>
								</li>
								<?php endif; ?>

								<?php if(!empty(get_field('twitter', $queried_object->ID))): ?>
								<li>
									<a href="<?php the_field('twitter', $queried_object->ID); ?>" target="_blank">
										<svg class="icon icon-twitter-square">
											<use xlink:href="#icon-twitter-square">
										</svg>
									</a>
								</li>
								<?php endif; ?>

								<?php if(!empty(get_field('linkedin', $queried_object->ID))): ?>
								<li>
									<a href="<?php the_field('linkedin', $queried_object->ID); ?>" target="_blank">
										<svg class="icon icon-linkedin-square">
											<use xlink:href="#icon-linkedin-square">
										</svg>
									</a>
								</li>
								<?php endif; ?>

								<?php if(!empty(get_field('google_plus', $queried_object->ID))): ?>
								<li>
									<a href="<?php the_field('google_plus', $queried_object->ID); ?>" target="_blank">
										<svg class="icon icon-google-square">
											<use xlink:href="#icon-google-square">
										</svg>
									</a>
								</li>
								<?php endif; ?>
							</ul>
   						<?php endif; ?>
    				</div>
    				
    				<div class="col-md-3 mt-5">
    					<h4>Links</h4>
    					
        				<ul class="secondary-nav">
        					<li><a href="<?php echo network_site_url(); ?>contact/">Contact Us</a></li>
        					<li><a href="<?php echo network_site_url(); ?>customer-notice/">Customer Notice</a></li>
        					<li><a href="<?php echo network_site_url(); ?>disclosure-policy/">Disclosure Policy</a></li>
        					<li><a href="<?php echo network_site_url(); ?>financial-services-guide/">Financial Services Guide</a></li>
        					<li><a href="<?php echo network_site_url(); ?>privacy-policy/">Privacy Policy</a></li>
        				</ul>
    				</div>
    				
    				<div class="col-md-4 float-right mt-5 offset-md-2">
    					<h4><?= $footerFormsTitle; ?></h4>
    					<p>Interested in more investment opportunities?<br>To receive ALL our alerts fill out your details below.</p>
						<?= do_shortcode('[gravityform id="'.$formID.'" name="New Articles Straight to Your Inbox" title="false" description="false" ajax="true" tabindex="9"]'); ?>
    				</div>
    			</div>
    			
    			<div class="row sub-footer mt-5">
    				<div class="col-md-12 text-center mt-5">
    					<p>The information in this website is general information only. Any advice is general advice only. Your personal objectives, financial situation or needs have not been taken into consideration. Accordingly you should consider how appropriate the advice (if any) is to those objectives, financial situation and needs, before acting on the advice. S3 Consortium Pty Ltd (CAR No.433913) is a corporate authorised representative of Longhou Capital Markets Pty Ltd (AFSL No. 292464).</p><br><br>
						<p>©2017 S3 Consortium Pty Ltd</p>
    				</div>
    			</div>
    		</div>
    	</footer>
    	<?php wp_footer(); ?>
    </body>
</html>