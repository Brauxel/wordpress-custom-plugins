<?php
get_header();

// Get the current date to render VIP Club and Disclaimer
$date = get_the_time('U');
?>

    		<div class="jumbotron banner">
    			<div class="overlay">&nbsp;</div>
    			<section class="banner-content align-middle">
    				<div class="inner">
    					<div class="container">
    						<div class="row">
    							<div class="col-xl-5 mb-5">
    								<a href="<?php bloginfo('url'); ?>"><img src="<?= $logo; ?>" alt="" title="" height="55" /></a>
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
    					<div class="row blog-brief pt-5 pb-5">
							<article class="col-md-12 pt-4 pb-4">
								<h1 class="mb-4 mt-0"><?php echo single_cat_title('',false); ?></h1>
								
								<div class="row mb-5">
									<div class="col-md-10 date-holder">
										&nbsp;
									</div>

									<div class="text-size clearfix">
										<a href="#" class="float-left control minus">Minus</a>
										<span class="float-left pl-3 pr-3">Text Size</span>
										<a href="#" class="control float-left plus">Plus</a>
									</div>
								</div>
								
								<div class="clearfix"></div>
								
								<?php echo category_description(); ?>
								<div class="clear"></div>
							</article>
    					</div>
    					
    					<section class="latest-article article-list pb-5">
    						<div class="row">
								<div class="col-md-12">
									<h3 class="mb-5">Latest Article</h3>
								</div>
							</div>
							
							<article class="row">
								<div class="col-md-4 mb-3">
									<a class="image" href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'related_thumb' );?></a>
								</div>
								
								<?php
									// Add the ID to the array to avoid repetitions
									$repAvoider[] = get_the_ID();
								?>
								
								<div class="col-md-8">
									<h4 class="mt-0 mb-2"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
									<p class="date"><?php the_time('M j, Y'); ?></p>
									<?php the_excerpt(); ?>
									<a class="btn btn-outline-primary" href="<?php the_permalink(); ?>">Read Article</a>
								</div>
							</article>
						</section>
    					
						<?php
						$term_id = get_queried_object()->term_id;
						$post_id = 'company_'.$term_id;
						$myRelatedPosts = get_term_meta($term_id, 'ba_related_posts', true);
						if ( !empty($myRelatedPosts) ):
						?>
    					<section class="related-articles article-list pt-5">
    						<div class="row">
								<div class="col-md-12">
									<h3 class="mb-5">Related <?php echo single_cat_title('',false); ?> Articles</h3>
								</div>
							</div>
   						
    						<div class="row">
								<?php
								$args = array( 'post_type' => 'post', 'post__in' => $myRelatedPosts, 'post__not_in' => $GLOBALS[ 'repAvoider' ] );

								$the_query = new WP_Query( $args );
								while ( $the_query->have_posts() ):
									$the_query->the_post();
									// Add the ID to the array to avoid repetitions
									array_push( $repAvoider, get_the_ID() );
                				?>
    								<article class="col-md-4 mb-5">
    									<a class="image" href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'related_thumb' );?></a>
    									<h4 class="mt-4 mb-2"><a href="<?php the_permalink(); ?>"><?php print( truncateString(get_the_title(), 80, true) ); ?></a></h4>
										<p class="date"><?php the_time('M j, Y'); ?></p>
                    					<a class="btn btn-outline-primary" href="<?php the_permalink(); ?>">Read Article</a>
    								</article>
    							<?php endwhile; wp_reset_postdata(); ?>
    						</div>
    					</section>
    					<?php endif; ?>
    					
    					<section class="trending-articles article-list pt-5">
    						<div class="row">
								<div class="col-md-12">
									<h3 class="mb-5">Top Trending</h3>
								</div>
							</div>
   					
   							<div class="row">
   								<?php recent_posts(); ?>
   							</div>
    					</section>
    				</div>
    				
    				<?php get_sidebar(); ?>
    			</div>
    		</div>
    		
    		<div class="responsive-share-buttons">
				<div class="clearfix">
					<share-button id="general-share"></share-button>
				</div>
    		</div>
<?php get_footer(); ?>