<?php
/**
 * The template part for displaying single posts
 *
 * @package boatseller
 * @subpackage Boat_seller
 * @since boat seller 1.0
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
	</header><!-- .entry-header -->
	<?php boatseller_excerpt(); ?>
	<?php boatseller_post_thumbnail(); ?>
	<div class="entry-content">
		<?php
			the_content();
			wp_link_pages( array(
				'before'      => '<div class="page-links"><span class="page-links-title">' .   __('Pages:', 'boatseller' ) . '</span>',
				'after'       => '</div>',
				'link_before' => '<span>',
				'link_after'  => '</span>',
				'pagelink'    => '<span class="screen-reader-text">' .   __('Page', 'boatseller' ) . ' </span>%',
				'separator'   => '<span class="screen-reader-text">, </span>',
			) );
			if ( '' !== get_the_author_meta( 'description' ) ) {
				get_template_part( 'template-parts/biography' );
			}
		?>
	</div><!-- .entry-content -->
	<footer class="entry-footer">
		<?php boatseller_entry_meta(); ?>
		<?php
            edit_post_link(
				sprintf(
					/* translators: %s: Name of current post */
					  __('Edit', 'boatseller' ).'<span class="screen-reader-text"> "%s"</span>',
                    get_the_title()
				),
				'<span class="edit-link">',
				'</span>'
			);
		?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->