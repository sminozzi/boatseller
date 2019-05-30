<?php
/**
 * Template for displaying search forms in boat seller
 *
 * @package boatseller
 * @subpackage Boat_seller
 * @since boat seller 1.0
 */
?>
<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label>
		<span class="screen-reader-text"><?php echo esc_attr_x( 'Search for:', 'label', 'boatseller' ); ?></span>
		<input type="search" class="search-field" placeholder="<?php echo esc_attr_x( 'Search &hellip;', 'placeholder', 'boatseller' ); ?>" value="<?php echo get_search_query(); ?>" name="s" />
	</label>
	<button type="submit" class="search-submit"><span class="screen-reader-text"><?php echo esc_attr_x( 'Search', 'submit button', 'boatseller' ); ?></span></button>
</form>