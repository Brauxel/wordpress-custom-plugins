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
    				<?php if ( have_posts() ): ?>
    				<div class="row pt-5 pb-5">
    					<?php while( have_posts() ): the_post(); ?>
    					<article class="col-md-12 pt-4" id="articletitle">
    						<h1 class="mb-4 mt-0"><?php the_title(); ?></h1>
    						
							<div class="row mb-5">
								<div class="col-md-10 date-holder">
									<p class="date">PUBLISHED: <?php the_time('d-m-y'); ?></p>
								</div>

								<div class="text-size clearfix">
									<a href="#" class="float-left control minus">Minus</a>
									<span class="float-left pl-3 pr-3">Text Size</span>
									<a href="#" class="control float-left plus">Plus</a>
								</div>
							</div>
							
							<?php the_content(); ?>
		                    <?php $vipdate = strtotime('16-05-2016'); ?>
        		            <?php $rbrelation = strtotime('19-01-2017'); ?>
							
						</article>
    					<?php endwhile; ?>
    					
						<?php
						// Get the related posts for the current post
						$myRelatedPosts = get_post_meta( $post->ID, '_my_related_posts');
						if ( !empty( $myRelatedPosts ) && is_array($myRelatedPosts[0]) ):
						?>
    					<section class="col-md-12 related-articles article-list pt-5">
    						<div class="row">
								<div class="col-md-12">
									<h3 class="mb-5">Related Articles</h3>
								</div>
							</div>
   						
    						<div class="row">
							<?php
								foreach( $myRelatedPosts as $myRelatedPost ): // Begin foreach for first level of array
									foreach( $myRelatedPost as $aRelatedPost ): // Begin foreach for second level of array
										$theRelatedPost = get_post ($aRelatedPost);
										$newDate = date("M j, Y", strtotime($theRelatedPost->post_date)); // Change the format of the date
										$excluded = wp_get_post_terms( $theRelatedPost->ID, 'exclude', array("fields" => "all") );
										array_push( $repAvoider, $theRelatedPost->ID );
										//if ( !empty( $excluded ) ) { continue; }
							?>
								<article class="col-md-4 mb-5">
									<a class="image" href="<?php echo get_permalink($aRelatedPost); ?>"><?php echo get_the_post_thumbnail( $theRelatedPost->ID, 'related_thumb' ); ?></a>
									<h4 class="mt-4 mb-2"><a href="<?php echo get_permalink($aRelatedPost); ?>"><?php print( truncateString($theRelatedPost->post_title, 70, true) ); ?></a></h4>
									<p class="date"><?php echo $newDate; ?></p>
									<a class="btn btn-outline-primary" href="<?php echo get_permalink($aRelatedPost); ?>">Read Article</a>
								</article>
  							<?php endforeach; endforeach; ?>
    						</div>
						</section>
   						<?php endif; ?>
   						
						<section class="disclaimer col-md-12 pt-5 pb-5">
						<?php
						// Declare a date for the change point of the disclaimer
						$mydate = strtotime('15-02-2016');

						// Compare if post is created after the 15th of Feburary and display disclaimer accordingly
						if ($date > $mydate):
						?>
							<p><em>S3 Consortium Pty Ltd (CAR No.433913) is a corporate authorised representative of Longhou Capital Markets Pty Ltd (AFSL No. 292464). The information contained in this article is general information only. Any advice is general advice only. Neither your personal objectives, financial situation nor needs have been taken into consideration. Accordingly you should consider how appropriate the advice (if any) is to those objectives, financial situation and needs, before acting on the advice.</em></p>
							<p><em>Conflict of Interest Notice</em></p>
							<p><em>S3 Consortium Pty Ltd does and seeks to do business with companies featured in its articles. As a result, investors should be aware that the Firm may have a conflict of interest that could affect the objectivity of this article. Investors should consider this article as only a single factor in making any investment decision. The publishers of this article also wish to disclose that they may hold this stock in their portfolios and that any decision to purchase this stock should be done so after the purchaser has made their own inquires as to the validity of any information in this article.</em></p>
							<p><em>Publishers Notice</em></p>
							<p><em>The information contained in this article is current at the finalised date. The information contained in this article is based on sources reasonably considered to be reliable by S3 Consortium Pty Ltd, and available in the public domain. No “insider information” is ever sourced, disclosed or used by S3 Consortium.</em></p>
						<?php else: ?>
							<p><em>The information contained in this article is general information only. Any advice is general advice only. Neither your personal objectives, financial situation nor needs have been taken into consideration. Accordingly you should consider how appropriate the advice (if any) is to those objectives, financial situation and needs, before acting on the advice. S3 Consortium Pty Ltd (CAR No.433913) is a corporate authorised representative of Longhou Capital Markets Pty Ltd (AFSL No. 292464).</em></p>
							<p><em>Conflict of Interest Notice.</em></p>
							<p><em>S3 Consortium Pty Ltd does and seeks to do business with companies featured in its articles. As a result, investors should be aware that the Firm may have a conflict of interest that could affect the objectivity of this article. Investors should consider this article as only a single factor in making any investment decision. The publishers of this article also wish to disclose that they may hold this stock in their portfolios and that any decision to purchase this stock should be done so after the purchaser has made their own inquires as to the validity of any information in this article.</em></p>
						<?php endif; ?>
						<!-- section.disclaimer ENDS -->
						</section>
   						
    					
						<div class="col-md-12 raisebook-block pt-5 pb-5 text-center">
							<div class="row">
								<div class="col-lg-4">
									<a href="#"><img src="<?php bloginfo('template_url'); ?>/assets/images/raisebook.svg" class="img-fluid" /></a>
								</div>

								<div class="col-lg-4 align-wrapper offset-lg-1">
									<p class="align-bottom" style="display: table-cell;">Are you a sophisticated investor?</p>
								</div>

								<div class="col-lg-3 align-wrapper text-left">
									<div class="align-bottom">
										<a href="#" class="btn btn-secondary border-0">Find out more</a>
									</div>
								</div>
							</div>
						</div>
					</div>
    				<?php endif; ?>
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