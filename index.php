<?php /**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @package boatseller
 * @subpackage Boat_seller
 * @since boat seller 1.0
 */
$boatseller_blog_style = trim(get_theme_mod('boatseller_blog_style', '3'));
$boatseller_blog_sidebar = trim(get_theme_mod('boatseller_blog_sidebar','1'));
get_header();
if($boatseller_blog_sidebar != '1')
  echo '<div id="primary" class="content-area-full-with">';
else
  echo '<div id="primary" class="content-area">';
if ($boatseller_blog_style == '2')
    echo '<div class="boatseller_list_view">';
?>
  	<main id="main" class="site-main" role="main">
<?php if (have_posts()): ?>
	<?php if (is_home() && !is_front_page()): ?>
				<header>
					<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
				</header>
	<?php endif;
    if ($boatseller_blog_style == '3')
        echo '<div class="row boatseller_blog_grid">';
    // Start the loop.
    while (have_posts()):
        the_post();
        /*
        * Include the Post-Format-specific template for the content.
        * If you want to override this in a child theme, then include a file
        * called content-___.php (where ___ is the Post Format name) and that will be used instead.
        */
        if ($boatseller_blog_style == '3')
            get_template_part('template-parts/content-masonry', get_post_format());
        elseif ($boatseller_blog_style == '2')
            get_template_part('template-parts/content-list', get_post_format());
        else
            get_template_part('template-parts/content', get_post_format());
        // End the loop.
    endwhile;
    if ($boatseller_blog_style == '3' or $boatseller_blog_style == '2')
        echo '</div>';
    // Previous/next page navigation.
    the_posts_pagination(array(
        'prev_text' =>  __('Previous page', 'boatseller'),
        'next_text' =>  __('Next page', 'boatseller'),
        'before_page_number' => '<span class="meta-nav screen-reader-text">' .  __('Page',
            'boatseller') . ' </span>',
        ));
// If no content, include the "No posts found" template.
else:
    get_template_part('template-parts/content', 'none');
endif; ?>
		</main><!-- .site-main -->
	</div><!-- .content-area -->
<?php     global $wp_query, $template;
    $post_id = $wp_query->get_queried_object_id();
    //
    $default_blog_page = get_option('page_for_posts');
    $boatseller_blog_sidebar = trim(get_theme_mod('boatseller_blog_sidebar', '1'));
if ($post_id == $default_blog_page) {
        if ($boatseller_blog_sidebar == '1')
            get_sidebar();
} else
        get_sidebar();
get_footer();
?>