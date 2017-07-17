<?php get_header(); ?>
			<div class="container">
    			<div class="row">
    				<div class="col-lg-12">
    				<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
    					<?php 
							// If we are on the Global Site Search page we don't display the title
							if(!is_page('site-search')): 
						?>
    						<h1><?php the_title(); ?></h1>
    					<?php endif; ?>
    					
    					<?php the_content(); ?>
    				<?php endwhile; else: ?>
						<p>It would appear this page currently has no content. Please click <a href="<?php bloginfo( 'url' ); ?>">here</a> to go home and do check back with us soon.</p>
    				<?php endif; ?>
					</div>
				</div>
			</div>
<?php get_footer(); ?>