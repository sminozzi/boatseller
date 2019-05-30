<?php
/**
 * The template part for displaying content
 *
 * @package boatseller
 * @subpackage Boat_seller
 * @since boat seller 1.0
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class("boatseller_article"); ?>>
  	<?php if ( ! post_password_required() && ! is_attachment() && has_post_thumbnail() ) { ?>
		<div class="entry-thumbnail">
			<div class="post-media post-thumb">
				<a href="<?php echo esc_url( get_permalink() ); ?>"><?php the_post_thumbnail(  array(450, 450) ); ?></a>
			</div>
          <?php  boatseller_entry_meta(); ?>
		</div>
	<?php } ?>
	<div class="entry-body">
		<div class="blog-entry-content">
            <?php 
   			the_title( sprintf( '<h1><a href="%s" rel="bookmark">',
				esc_url( get_permalink() ) ),
				'</a></h1><br>' );
                the_excerpt();
            ?>
		</div>
		<div class="entry-aux">
			<?php
			wp_link_pages( array(
				'before'      => '<div class="page-links"><span class="page-links-title">' . __('Pages:',
						'boatseller' ) . '</span>',
				'after'       => '</div>',
				'link_before' => '<span>',
				'link_after'  => '</span>',
				'pagelink'    => '<span class="screen-reader-text">' . __('Page', 'boatseller' ) . ' </span>%',
			) );
			?>
		</div>
	</div>
</article>