<?php
/**
 * The template part for displaying content
 *
 * @package boatseller
 * @subpackage Boat_seller
 * @since boat seller 1.0
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
<div class="col-xs-4 boatseller_masonry_thumbnail"> 
  	<?php if ( ! post_password_required() && ! is_attachment() && has_post_thumbnail() ) { ?>
		<div class="entry-thumbnail2">
			<div class="post-media post-thumb">
				<a href="<?php echo esc_url( get_permalink() ); ?>"><?php the_post_thumbnail(  array(450, 450) ); ?></a>
			</div>
          <?php  // boatseller_entry_meta(); ?>
		</div>
	<?php } ?>
	<div class="entry-body2">
		<div class="blog-entry-content2">
			<?php 
   			the_title( sprintf( '<h1><a href="%s" rel="bookmark">',
				esc_url( get_permalink() ) ),
				'</a></h1><br>' ); 
                the_excerpt();
            ?>
		</div>
        <div id = "boatseller_blog_resumo">
        <?php   
          boatseller_entry_meta(); 
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
</div>     
</article>