<?php
/*
Template Name: Internal Home
*/

get_header(); ?>
    		<div class="jumbotron banner">
    			<div class="overlay">&nbsp;</div>
    			<section class="banner-content align-middle">
    				<div class="inner">
    					<div class="container">
    						<div class="row">
    							<div class="col-xl-5 mb-5">
    								<h1 class="mb-0 mt-0"><img height="55" src="<?= $logo; ?>" alt="" title="" /><span><?php the_title(); ?></span></h1>
    							</div>
    							
    							<div class="col-xl-7 form-holder">
									<a href="#" class="btn btn-outline-primary show-form">Keep me informed</a>
									<?= do_shortcode('[gravityform id="'.$formID.'" name="New Articles Straight to Your Inbox" title="false" ajax="true" tabindex="9"]'); ?>
    							</div>
    						</div>
    					</div>
    				</div>
    			</section>
    		</div>
    		
    		<div class="container">
    			<div class="row">
    				<div class="col-lg-9">
					<?php
						// Setup paged value for pagination
						$paged = (get_query_var('page')) ? get_query_var('page') : 1;

						// Setup custom wp_query
						$args = array('post_type' => 'post', 'posts_per_page=10', 'paged' => $paged);
						$the_query = new WP_Query( $args );

						if ( $the_query->have_posts() ):
						?>
    					<div class="row">
    						<section class="col-lg-12 articles">
    						<?php while ( $the_query->have_posts() ): $the_query->the_post(); ?>
							
							<article class="row blog-brief pt-5 pb-5">
							<?php
							// Get the Company ID/Name of the post
							$termIDs = get_the_terms( get_the_ID(), 'company' );
							
							if( !empty($termIDs) ) {
								foreach( $termIDs as $termID ):
									$theTermID = $termID->term_id;
									$theTermName = $termID->term_name; 
								endforeach;
							}
							?>
								<div class="col-md-2">
									<a href="<?php the_permalink(); ?>"><img src="<?= z_taxonomy_image_url($theTermID); ?>" class="img-fluid" alt="<?= $theTermName; ?>" title="<?= $theTermName; ?>" /></a>
								</div>
								
								<div class="col-md-9 synopsis pt-4 pb-4">
									<h2><a href="<?php the_permalink(); ?>#articletitle"><?php the_title(); ?></a></h2>
									<p class="date"><?php the_time('M j, Y'); ?></p>
									<?php the_excerpt(); ?>
									<a href="<?php the_permalink(); ?>" class="btn btn-outline-primary float-right mt-5">Read Article</a>
								</div>
							</article>
								
							
  							<?php endwhile; wp_pagenavi( array( 'query' => $the_query ) ); ?>
  							</section>
  							
							<?php 
								// Get all the companies via the taxonomy
								$companies = get_terms( 'company', 'orderby=count&hide_empty=1' );

								if ( !empty($companies) ):
							?>
							<div class="col-md-12">
								<div class="current-stocks text-center pt-5 pb-5 mb-5 mt-4">
									<div class="col-md-12">
										<h3 class="mb-5">Current Stocks</h3>
									</div>
									
									<div class="row pb-5">
									<?php 
									$pos_collection = get_option( 'pos_collection' );
									if (  $pos_collection != NULL  ):
										foreach( $pos_collection as $pos ):
											$term = get_term_by( 'id', $pos, 'company');
											$exlude = get_field( 'exclude_company' , $term->taxonomy.'_'.$term->term_id );
											if ( !$exlude[0] ):
									?>
									
										<div class="col-md-2 mb-5">
											<a class="logo pb-3" href="<?php bloginfo( 'url' ); ?>/company/<?php echo $term->slug; ?>/">
												<img src="<?php echo z_taxonomy_image_url($term->term_id); ?>" class="img-fluid mb-2" alt="<?php echo $term->name; ?>" title="<?php echo $term->name; ?>">
												<p class="mb-0 pt-3"><?php the_field('code', $term->taxonomy.'_'.$term->term_id); ?></p>
											</a>
										</div>
									<?php endif; endforeach; ?>
									<?php 
									else:
										$terms = get_terms( array( 'taxonomy' => 'company', 'hide_empty' => false ) );
										foreach( $terms as $term ):
											$exlude = get_field( 'exclude_company' , $term->taxonomy.'_'.$term->term_id );
											if ( !$exlude[0] ):
									?>
										<div class="col-md-2 mb-5">
											<a class="logo pb-2" href="<?php bloginfo( 'url' ); ?>/company/<?php echo $term->slug; ?>/">
												<img src="<?php echo z_taxonomy_image_url($term->term_id); ?>" class="img-fluid mb-4" alt="<?php echo $term->name; ?>" title="<?php echo $term->name; ?>">
												<p class="mb-0"><?php the_field('code', $term->taxonomy.'_'.$term->term_id); ?></p>
											</a>
										</div>
									<?php endif; endforeach; endif; ?>
									</div>
									
								</div>
							</div>
 							
 							<?php endif; ?>
  							
							<?= do_shortcode('[gravityform id="'.$formID.'" name="New Articles Straight to Your Inbox" title="false" ajax="true" tabindex="9"]'); ?>
  						
   							<div class="col-md-12 raisebook-block pt-5 pb-5 text-center">
   								<div class="row">
   									<div class="col-lg-4">
   										<a href="https://raisebook.com/" target="_blank"><img src="<?php bloginfo('template_url'); ?>/assets/images/raisebook.svg" class="img-fluid" /></a>
									</div>
									
									<div class="col-lg-4 align-wrapper offset-xl-1">
										<p class="align-bottom" style="display: table-cell;">Are you a sophisticated investor?</p>
									</div>
									
									<div class="col-lg-3 align-wrapper link">
										<div class="align-bottom">
											<a href="https://raisebook.com/" target="_blank" class="btn btn-secondary border-0">Find out more</a>
										</div>
									</div>
								</div>
   							</div>
   						</div>
   						<?php else: ?>
   						<div class="row">
   							<section class="col-lg-12 articles">
   								<p>No Posts were found! Please do keep an eye out for future updates</p>
   							</section>
						</div>
   						<?php endif; ?>
   						</div>
   						
   						<?php get_sidebar(); ?>
					</div>
				</div>
			</div>
			
    		<div class="responsive-share-buttons">
				<div class="clearfix">
					<share-button id="general-share"></share-button>
				</div>
    		</div>
<?php get_footer(); ?>