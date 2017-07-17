<?php
// Get the terms under company
$terms = get_the_terms( get_the_ID(), 'company' );
if( !empty($terms) ):
	foreach ($terms as $term):
		$t_id = $term->term_id;
		$t_name = $term->name;
		$t_slug = $term->slug;
	endforeach;
endif;
?>
    				<aside class="col-lg-2 sidebar pt-5 pb-2 offset-lg-1">
						<div class="sidebar-fixed-container">
						<?php if( is_single() ): ?>
							<div class="row text-center company-logo mb-5 pb-4 pt-4">
								<div class="col-xl-12">
									<a class="image" href="<?= bloginfo( 'url' ).'/company/'.$t_slug; ?>"><img src="<?= z_taxonomy_image_url($t_id); ?>" alt="<?= $t_name; ?>" title="<?= $t_name; ?>" class="img-fluid mb-4" /></a>
									<p class="mb-0"><a href="<?= bloginfo( 'url' ).'/company/'.$t_slug; ?>"><?= $t_name; ?></a></p>
								</div>
							</div>
						<?php endif; ?>
						
						<?php //the_field('subscribe_to_alerts'); ?>
						<div class="show-form-container">
							<a class="btn btn-outline-primary show-form" href="#">Keep me <br> informed</a>
							<?= do_shortcode('[gravityform id="'.$sidebarFormId.'" name="Stay Informed With The Latest Articles" title="true" description="false" ajax="true" tabindex="9"]'); ?>
						</div>

							<div class="row mt-5 text-center">
								<div class="col-lg-12">
									<a class="btn btn-outline-primary" href="<?php echo network_site_url(); ?>subscribe/">Manage<br> subscription</a>
								</div>
							</div>

							<div class="row mt-5 share-block">
								<div class="col-lg-12">
									<h6 style="text-transform: uppercase;" class="text-center mb-0">Share</h6>
								</div>

								<div class="col-lg-12 mt-3 pl-0 pr-0">
									<share-button id="general-share"></share-button>
									<div class="clearfix"></div>
								</div>
							</div>

							<!--<div class="row mt-5 raisebook-panel">
								<div class="col-lg-12">							
									<div class="text-center pt-5 pb-5">
										<div class="col-lg-12 rb-logo">
											<a href="https://raisebook.com/" target="_blank"><img src="<?php //bloginfo( 'template_url' ); ?>/assets/images/rb-side-logo.svg" alt="Raisebook" title="Raisebook" class="img-fluid" /></a>
										</div>

										<div class="col-lg-12 mt-5">
											<a href="https://raisebook.com/" class="btn btn-secondary border-0" target="_blank">Find out more</a>
										</div>
									</div>
								</div>
							</div>-->
						</div>
    				</aside>