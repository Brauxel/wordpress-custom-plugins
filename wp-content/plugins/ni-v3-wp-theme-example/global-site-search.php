<?php global $current_site, $members_directory_base, $network_query, $network_post; ?>

<div class="row">
	<div class="col-md-6 mb-3">
		<h1 class="mb-0 mt-0"><?php the_title(); ?></h1>
	</div>
	
	<div class="col-md-6 results-search-form-holder">
		<?php global_site_search_form() ?>
	</div>
</div>

<div class="wp-pagenavi row pb-5 pt-5 mt-0"><?php echo global_site_search_get_pagination() ?></div>

<section class="articles">
<?php if ( network_have_posts() ) : ?>
	<?php while ( network_have_posts() ) : network_the_post(); switch_to_blog($network_post->BLOG_ID); ?>
	<article class="row pb-5 pt-5 pr-5 pl-5">
		<div class="col-sm-3">
		<?php
			$featured_image_id = get_post_thumbnail_id(network_get_the_ID());
			
			$featured_image_src = '';
			
			if ($featured_image_id) {
				$featured_image_src = array_shift(wp_get_attachment_image_src($featured_image_id, 'related_thumb'));
		    }
		?>
			<a href="<?php echo network_get_permalink() ?>"><img class="img-fluid" src="<?= $featured_image_src ?>" alt="" title="" /></a>
		</div>
		
		<div class="col-sm-9 mt-3">
		<?php
		$blog_id = get_current_blog_id();
		$blog_details = get_blog_details($blog_id);
		//$author_id = network_get_the_author_id();
		//$the_author = get_user_by( 'id', $author_id );
		//$post_author_display_name = $the_author ? $the_author->display_name : __( 'Unknown', 'globalsitesearch' );
		$the_content = preg_replace( "~(?:\[/?)[^/\]]+/?\]~s", '', network_get_the_content() );
		?>
			<h3><a href="<?= $blog_details->siteurl; ?>"><?= $blog_details->blogname; ?></a></h3>
			<h4 class="mb-3"><a href="<?php echo network_get_permalink() ?>"><?php network_the_title() ?></a></h4>
			<p><?php echo substr( strip_tags( $the_content ), 0, 450 ).'...' ?></p>
			<a class="btn btn-outline-primary float-right" href="<?php echo network_get_permalink() ?>"><?php _e( 'Read Article', 'globalsitesearch' ) ?></a>
		</div>
	</article>
	<?php restore_current_blog(); endwhile; ?>
<?php else : ?>
	<p style="text-align:center"><?php _e( 'Nothing found for your search.', 'globalsitesearch' ) ?></p>
<?php endif; ?>
</section>

<div class="wp-pagenavi row pb-5 pt-5 pr-5 pl-5 mt-0"><?php echo global_site_search_get_pagination() ?></div>
