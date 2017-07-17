<?php global $current_blog ?>
<form action="<?php echo esc_url( trailingslashit( $current_blog->path . global_site_search_get_search_base() ) ) ?>" class="navbar-form navbar-right search-form">
	<input placeholder="Search..." type="text" name="phrase" class="form-control" value="<?php echo esc_attr( stripslashes( global_site_search_get_phrase() ) ) ?>">
	<button class="search-icon" type="submit">Search</button>
</form>