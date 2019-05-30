<?php

/**

 * The template for displaying search results pages

 *

 * @package boatseller

 * @subpackage Boat_seller

 * @since boat seller 1.0

 */

get_header(); ?>

	<section id="primary" class="content-area">

		<main id="main" class="site-main" role="main">

		<?php if ( have_posts() ) : ?>

			<header class="page-header">

            <div class="page-search">

				<img src="<?php echo esc_url(get_template_directory_uri().'/images/search2.png');?>" alt="<?php esc_attr_e( 'Not Found', 'boatseller' ); ?>" />

            </div>

                 

    			<h1 class="page-title"><?php

    			            /* Translators: Title for Results found... */

 printf(   __('Search Results for: %s', 'boatseller' ), '<span>' . esc_attr( get_search_query() ) . '</span>' ); ?></h1>

			</header><!-- .page-header -->

			<?php

			// Start the loop.

			while ( have_posts() ) : the_post();

				/**

				 * Run the loop for the search to output the results.

				 * If you want to overload this in a child theme then include a file

				 * called content-search.php and that will be used instead.

				 */

				get_template_part( 'template-parts/content', 'search' );

			// End the loop.

			endwhile;

			// Previous/next page navigation.

			the_posts_pagination( array(

				'prev_text'          =>   __('Previous page', 'boatseller' ),

				'next_text'          =>   __('Next page', 'boatseller' ),

				'before_page_number' => '<span class="meta-nav screen-reader-text">' .   __('Page', 'boatseller' ) . ' </span>',

			) );

		// If no content, include the "No posts found" template.

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif;

		?>

		</main><!-- .site-main -->

	</section><!-- .content-area -->

<?php get_sidebar(); ?>

<?php get_footer(); ?>