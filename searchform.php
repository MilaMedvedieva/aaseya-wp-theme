<?php
/**
 * @package aaseya
 */
?>





<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label>
		<span class="screen-reader-text"><?php _ex( 'Search for:', 'label', 'blink', 'blink-child-new' ); ?></span>
		<input type="search" class="search-field" placeholder="<?php echo esc_attr_x( 'Search', 'search placeholder', 'blink' ); ?>" value="<?php the_search_query(); ?>" name="s" title="<?php echo esc_attr_x( 'Search for:', 'label', 'blink'); ?>">
	</label>
	<button type="submit" class="search-submit btn btn-primary">Search</button>
</form>

