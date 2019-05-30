<?php
/**
 * The template part for displaying a message that posts cannot be found
 *
 * @package boatseller
 * @subpackage Boat_seller
 * @since boat seller 1.0
 */
?>
<section class="no-results not-found">
	<header class="page-header">
		<h1 class="page-title"><?php _e( 'Nothing Found', 'boatseller' ); ?></h1>
	</header><!-- .page-header -->
            <div class="content-none">
				<img src="<?php echo esc_url(get_template_directory_uri().'/images/search2.png')?>" alt="<?php esc_attr_e( 'Not Found', 'boatseller' ); ?>" />
			</div>
            <br /><br />
	<div class="page-content">
		<?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>
			<p><?php
            /* Translators: Just ask to create first post */
           //  printf(   __('Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'boatseller' ), esc_url( admin_url( 'post-new.php' ) ) ); 
           echo __('Ready to publish your first post?', 'boatseller');
           echo '<a href="';
           echo esc_url( admin_url( 'post-new.php' )); 
           echo '"> ';
           echo __('Get started here', 'boatseller');
           echo '</a>';
          ?></p>
		<?php elseif ( is_search() ) : ?>
			<p><?php 
            /* Translators: Just inform search results */
            _e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'boatseller' ); ?></p>
			<?php get_search_form(); ?>
		<?php else : ?>
			<p><?php 
            /* Translators: Just inform the search results and sugest new search */
            _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'boatseller' ); ?></p>
			<?php get_search_form(); ?>
		<?php endif; ?>
	</div><!-- .page-content -->
</section><!-- .no-results -->