<?php /**
 * boat seller functions and definitions
 *
 * @link https://codex.wordpress.org/Theme_Development
 * @link https://codex.wordpress.org/Child_Themes
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are
 * instead attached to a filter or action hook.
 *
 * For more information on hooks, actions, and filters,
 * {@link https://codex.wordpress.org/Plugin_API}
 *
 * @package boatseller
 * @subpackage Boat_seller
 * @since boat seller 1.0
 */
/**
 * boat seller only works in WordPress 4.4 or later.
 */
if (version_compare($GLOBALS['wp_version'], '4.4-alpha', '<')) {
    require get_template_directory() . '/inc/back-compat.php';
}
function boatseller_fallback_menu()
{
    echo '
    <ul>                  
        <li><a href="' . admin_url('nav-menus.php') . '">', __('Set Up Your Menu',
        'boatseller') . '</a></li>
    </ul>';
}
define('boatsellerURL', get_template_directory_uri());
define('boatsellerimgURL', boatsellerURL . '/images/');
define('boatsellerPATH', get_template_directory());
$boatseller_theme = wp_get_theme();
define('boatsellerVERSION', $boatseller_theme->version);
define('SITEURL', esc_url(get_site_url()));
if (!function_exists('boatseller_setup')):
    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which
     * runs before the init hook. The init hook is too late for some features, such
     * as indicating support for post thumbnails.
     *
     * Create your own boatseller_setup() function to override in a child theme.
     *
     * @since boat seller 1.0
     */
    function boatseller_setup()
    {
        /*
        * Make theme available for translation.
        * Translations can be filed at WordPress.org. See: https://translate.wordpress.org/projects/wp-themes/boatseller
        * If you're building a theme based on boat seller, use a find and replace
        * to change 'boatseller' to the name of your theme in all the template files
        */
        load_theme_textdomain('boatseller');
        // Add default posts and comments RSS feed links to head.
        add_theme_support('automatic-feed-links');
        /*
        * Let WordPress manage the document title.
        * By adding theme support, we declare that this theme does not use a
        * hard-coded <title> tag in the document head, and expect WordPress to
        * provide it for us.
        */
        add_theme_support('title-tag');
        /*
        * Enable support for custom logo.
        *
        *  @since boat seller 1.2
        */
        add_theme_support('custom-logo', array(
            'height' => 240,
            'width' => 240,
            'flex-height' => true,
            ));
        /*
        * Enable support for Post Thumbnails on posts and pages.
        *
        * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
        */
        add_theme_support('post-thumbnails');
        set_post_thumbnail_size(1200, 9999);
        // This theme uses wp_nav_menu() in two locations.
        register_nav_menus(array(
            'primary' => __('Primary Menu', 'boatseller'),
            'social' => __('Social Links Menu', 'boatseller'),
            ));
        /*
        * Switch default core markup for search form, comment form, and comments
        * to output valid HTML5.
        */
        add_theme_support('html5', array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
            ));
        /*
        * Enable support for Post Formats.
        *
        * See: https://codex.wordpress.org/Post_Formats
        */
        add_theme_support('post-formats', array(
            'aside',
            'image',
            'video',
            'quote',
            'link',
            'gallery',
            'status',
            'audio',
            'chat',
            ));
        /*
        * This theme styles the visual editor to resemble the theme style,
        * specifically font, colors, icons, and column width.
        */
        add_editor_style(array('css/editor-style.css', boatseller_fonts_url()));
        // Indicate widget sidebars can use selective refresh in the Customizer.
        add_theme_support('customize-selective-refresh-widgets');
    }
endif; // boatseller_setup
add_action('after_setup_theme', 'boatseller_setup');
/**
 * Sets the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 *
 * @since boat seller 1.0
 */
function boatseller_content_width()
{
    $GLOBALS['content_width'] = apply_filters('boatseller_content_width', 840);
}
add_action('after_setup_theme', 'boatseller_content_width', 0);
/**
 * Registers a widget area.
 *
 * @link https://developer.wordpress.org/reference/functions/register_sidebar/
 *
 * @since boat seller 1.0
 */
function boatseller_widgets_init()
{
    register_sidebar(array(
        'name' => __('Sidebar', 'boatseller'),
        'id' => 'sidebar-1',
        'description' => __('Add widgets here to appear in your sidebar.',
            'boatseller'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h2 class="widget-title">',
        'after_title' => '</h2>',
        ));
    register_sidebar(array(
        'name' => __('First Footer Widget', 'boatseller'),
        'id' => '1-footer',
        'description' => __('Add widgets here to appear in your left footer.',
            'boatseller'),
        'before_widget' => '<div>',
        'after_widget' => '</div>',
        'before_title' => '<h2>',
        'after_title' => '</h2>',
        ));
    register_sidebar(array(
        'name' => __('Second Footer Widget', 'boatseller'),
        'id' => '2-footer',
        'description' => __('Add widgets here to appear in your center footer.',
            'boatseller'),
        'before_widget' => '<div>',
        'after_widget' => '</div>',
        'before_title' => '<h2>',
        'after_title' => '</h2>',
        ));
    register_sidebar(array(
        'name' => __('Third Footer Widget', 'boatseller'),
        'id' => '3-footer',
        'description' => __('Add widgets here to appear in your right footer.',
            'boatseller'),
        'before_widget' => '<div>',
        'after_widget' => '</div>',
        'before_title' => '<h2>',
        'after_title' => '</h2>',
        ));
}
add_action('widgets_init', 'boatseller_widgets_init');
if (!function_exists('boatseller_fonts_url')):
    /**
     * Register Google fonts for boat seller.
     *
     * Create your own boatseller_fonts_url() function to override in a child theme.
     *
     * @since boat seller 1.0
     *
     * @return string Google fonts URL for the theme.
     */
    function boatseller_fonts_url()
    {
        $fonts_url = '';
        $fonts = array();
        $subsets = 'latin,latin-ext';
        /* translators: If there are characters in your language that are not supported by Merriweather, translate this to 'off'. Do not translate into your own language. */
        if ('off' !== _x('on', 'Merriweather font: on or off', 'boatseller')) {
            $fonts[] = 'Merriweather:400,700,900,400italic,700italic,900italic';
        }
        /* translators: If there are characters in your language that are not supported by Montserrat, translate this to 'off'. Do not translate into your own language. */
        if ('off' !== _x('on', 'Montserrat font: on or off', 'boatseller')) {
            $fonts[] = 'Montserrat:400,700';
        }
        /* translators: If there are characters in your language that are not supported by Inconsolata, translate this to 'off'. Do not translate into your own language. */
        if ('off' !== _x('on', 'Inconsolata font: on or off', 'boatseller')) {
            $fonts[] = 'Inconsolata:400';
        }
        if ($fonts) {
            $fonts_url = add_query_arg(array(
                'family' => urlencode(implode('|', $fonts)),
                'subset' => urlencode($subsets),
                ), 'https://fonts.googleapis.com/css');
        }
        return $fonts_url;
    }
endif;
/**
 * Handles JavaScript detection.
 *
 * Adds a `js` class to the root `<html>` element when JavaScript is detected.
 *
 * @since boat seller 1.0
 */
function boatseller_javascript_detection()
{
    echo "<script>(function(html){html.className = html.className.replace(/\bno-js\b/,'js')})(document.documentElement);</script>\n";
}
add_action('wp_head', 'boatseller_javascript_detection', 0);
/**
 * Enqueues scripts and styles.
 *
 * @since boat seller 1.0
 */
function boatseller_scripts()
{
    // Add custom fonts, used in the main stylesheet.
    wp_enqueue_style('boatseller-fonts', boatseller_fonts_url(), array(),
        boatsellerVERSION);
    // Add Genericons, used in the main stylesheet.
    wp_enqueue_style('genericons', get_template_directory_uri() .
        '/genericons/genericons.css', array(), boatsellerVERSION);
    // Theme stylesheet.
    wp_enqueue_style('boatseller-style', get_stylesheet_uri(), array(),
        boatsellerVERSION);
    // Load the Internet Explorer specific stylesheet.
    wp_enqueue_style('boatseller-ie', get_template_directory_uri() . '/css/ie.css',
        array('boatseller-style'), boatsellerVERSION);
    wp_style_add_data('boatseller-ie', 'conditional', 'lt IE 10');
    // Load the Internet Explorer 8 specific stylesheet.
    wp_enqueue_style('boatseller-ie8', get_template_directory_uri() . '/css/ie8.css',
        array('boatseller-style'), boatsellerVERSION);
    wp_style_add_data('boatseller-ie8', 'conditional', 'lt IE 9');
    // Load the Internet Explorer 7 specific stylesheet.
    wp_enqueue_style('boatseller-ie7', get_template_directory_uri() . '/css/ie7.css',
        array('boatseller-style'), boatsellerVERSION);
    wp_style_add_data('boatseller-ie7', 'conditional', 'lt IE 8');
    // Load the html5 shiv.
    wp_enqueue_script('boatseller-html5', get_template_directory_uri() .
        '/js/html5.js', array(), boatsellerVERSION);
    wp_script_add_data('boatseller-html5', 'conditional', 'lt IE 9');
    wp_enqueue_script('boatseller-skip-link-focus-fix', get_template_directory_uri() .
        '/js/skip-link-focus-fix.js', array(), boatsellerVERSION, true);
    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
    if (is_singular() && wp_attachment_is_image()) {
        wp_enqueue_script('boatseller-keyboard-image-navigation',
            get_template_directory_uri() . '/js/keyboard-image-navigation.js', array('jquery'),
            boatsellerVERSION);
    }
    if (get_theme_mod('boatseller_preloader', '1') == '1') {
        wp_register_script('preloading', get_template_directory_uri() .
            '/js/preloader.js', boatsellerVERSION, false); // shows at the header scripts
        wp_enqueue_script('preloading');
    }
    wp_enqueue_script('boatseller-script', get_template_directory_uri() .
        '/js/functions.js', array('jquery'), boatsellerVERSION, true);
    $boatseller_search_icon = sanitize_text_field(get_theme_mod('boatseller_search_icon', '1'));
    $boatseller_search_icon = array('boatseller_search_icon' => $boatseller_search_icon);
    wp_localize_script('boatseller-customize-preview', 'boatseller_php_vars', $boatseller_search_icon);
    global $template;
    $boatseller_page_theme = wp_basename($template);
    $boatseller_pg_theme = array('boatseller_page_theme' => $boatseller_page_theme);
    wp_localize_script('boatseller-script', 'boatseller_php_vars', $boatseller_pg_theme);
    wp_enqueue_style('boatseller-header3', get_template_directory_uri() .
        '/css/header.css', array('boatseller-style'), boatsellerVERSION);
    wp_localize_script('boatseller-script', 'boatseller_screenReaderText', array(
        'expand' => __('expand child menu', 'boatseller'),
        'collapse' => __('collapse child menu', 'boatseller'),
        ));
    $boatseller_blog_style = trim(sanitize_text_field(get_theme_mod('boatseller_blog_style', '3')));
    if ($boatseller_blog_style == '3')
       wp_enqueue_script('jquery-masonry');
}
add_action('wp_enqueue_scripts', 'boatseller_scripts');
/**
 * Tiny MCE Extra Buttons
 *
 * @since boatseller 1.0
 *
 */
if (!function_exists('boatseller_wp_mce_buttons')) {
    function boatseller_wp_mce_buttons($buttons)
    {
        array_unshift($buttons, 'fontselect'); // Add Font Select
        array_unshift($buttons, 'fontsizeselect'); // Add Font Size Select
        array_unshift($buttons, 6, 0, 'backcolor');
        return $buttons;
    }
}
add_filter('mce_buttons_2', 'boatseller_wp_mce_buttons');
/**
 * Adds custom classes to the array of body classes.
 *
 * @since boat seller 1.0
 *
 * @param array $classes Classes for the body element.
 * @return array (Maybe) filtered body classes.
 */
function boatseller_body_classes($classes)
{
    // Adds a class of custom-background-image to sites with a custom background image.
    if (get_background_image()) {
        $classes[] = 'custom-background-image';
    }
    // Adds a class of group-blog to sites with more than 1 published author.
    if (is_multi_author()) {
        $classes[] = 'group-blog';
    }
    // Adds a class of no-sidebar to sites without active sidebar.
    if (!is_active_sidebar('sidebar-1')) {
        $classes[] = 'no-sidebar';
    }
    // Adds a class of hfeed to non-singular pages.
    if (!is_singular()) {
        $classes[] = 'hfeed';
    }
    return $classes;
}
add_filter('body_class', 'boatseller_body_classes');
/**
 * Converts a HEX value to RGB.
 *
 * @since boat seller 1.0
 *
 * @param string $color The original color, in 3- or 6-digit hexadecimal form.
 * @return array Array containing RGB (red, green, and blue) values for the given
 *               HEX code, empty array otherwise.
 */
function boatseller_hex2rgb($color)
{
    $color = trim($color, '#');
    if (strlen($color) === 3) {
        $r = hexdec(substr($color, 0, 1) . substr($color, 0, 1));
        $g = hexdec(substr($color, 1, 1) . substr($color, 1, 1));
        $b = hexdec(substr($color, 2, 1) . substr($color, 2, 1));
    } else
        if (strlen($color) === 6) {
            $r = hexdec(substr($color, 0, 2));
            $g = hexdec(substr($color, 2, 2));
            $b = hexdec(substr($color, 4, 2));
        } else {
            return array();
        }
        return array(
            'red' => $r,
            'green' => $g,
            'blue' => $b);
}
/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';
/**
 * Customizer additions.
 */
require_once get_template_directory() . '/inc/pinstaller.php';
require get_template_directory() . '/inc/customizer.php';
/**
 * Add custom image sizes attribute to enhance responsive image functionality
 * for content images
 *
 * @since boat seller 1.0
 *
 * @param string $sizes A source size value for use in a 'sizes' attribute.
 * @param array  $size  Image size. Accepts an array of width and height
 *                      values in pixels (in that order).
 * @return string A source size value for use in a content image 'sizes' attribute.
 */
function boatseller_content_image_sizes_attr($sizes, $size)
{
    $width = $size[0];
    840 <= $width && $sizes =
        '(max-width: 709px) 85vw, (max-width: 909px) 67vw, (max-width: 1362px) 62vw, 840px';
    if ('page' === get_post_type()) {
        840 > $width && $sizes = '(max-width: ' . $width . 'px) 85vw, ' . $width . 'px';
    } else {
        840 > $width && 600 <= $width && $sizes =
            '(max-width: 709px) 85vw, (max-width: 909px) 67vw, (max-width: 984px) 61vw, (max-width: 1362px) 45vw, 600px';
        600 > $width && $sizes = '(max-width: ' . $width . 'px) 85vw, ' . $width . 'px';
    }
    return $sizes;
}
add_filter('wp_calculate_image_sizes', 'boatseller_content_image_sizes_attr', 10,
    2);
/**
 * Add custom image sizes attribute to enhance responsive image functionality
 * for post thumbnails
 *
 * @since boat seller 1.0
 *
 * @param array $attr Attributes for the image markup.
 * @param int   $attachment Image attachment ID.
 * @param array $size Registered image size or flat array of height and width dimensions.
 * @return string A source size value for use in a post thumbnail 'sizes' attribute.
 */
function boatseller_post_thumbnail_sizes_attr($attr, $attachment, $size)
{
    if ('post-thumbnail' === $size) {
        is_active_sidebar('sidebar-1') && $attr['sizes'] =
            '(max-width: 709px) 85vw, (max-width: 909px) 67vw, (max-width: 984px) 60vw, (max-width: 1362px) 62vw, 840px';
        !is_active_sidebar('sidebar-1') && $attr['sizes'] =
            '(max-width: 709px) 85vw, (max-width: 909px) 67vw, (max-width: 1362px) 88vw, 1200px';
    }
    return $attr;
}
add_filter('wp_get_attachment_image_attributes',
    'boatseller_post_thumbnail_sizes_attr', 10, 3);
/**
 * Modifies tag cloud widget arguments to have all tags in the widget same font size.
 *
 * @since boat seller 1.1
 *
 * @param array $args Arguments for tag cloud widget.
 * @return array A new modified arguments.
 */
function boatseller_widget_tag_cloud_args($args)
{
    $args['largest'] = 1;
    $args['smallest'] = 1;
    $args['unit'] = 'em';
    return $args;
}
add_filter('widget_tag_cloud_args', 'boatseller_widget_tag_cloud_args');
function boatseller_sanitizehtml($str)
{
    $allowed_html = array(
        'a' => array(
            'href' => true,
            'title' => true,
            ),
        'abbr' => array('title' => true, ),
        'acronym' => array('title' => true, ),
        'b' => array(),
        'blockquote' => array('cite' => true, ),
        'cite' => array(),
        'code' => array(),
        'del' => array('datetime' => true, ),
        'em' => array(),
        'i' => array(),
        'q' => array('cite' => true, ),
        'strike' => array(),
        'strong' => array(),
        );
    wp_kses($str, $allowed_html);
    return trim($str);
}

if ( ! function_exists( 'boatseller_import_files' ) ) :
	function boatseller_import_files() {
	   $important_notice = 'Important Notes:
	   <br>
	   We recommend to run the Demo Import on a clean WordPress installation.
	   <br>
	   To reset your installation (if the import fails) we recommend <a href="https://wordpress.org/plugins/wordpress-reset/" target="_blank">Wordpress Reset Plugin</a>.
	   <br>
	   Do not run the Demo Import multiple times, it will result in duplicated content.
	   <br>
	   After you import this demo, you will have to setup the slider separately.';
	   return array(
		   array(
			   'import_file_name'           => 'Demo Import 1',
			   'import_file_url'            => 'http://www.boatsellertheme.com/demo/demo-content.xml',
			   'import_widget_file_url'     => 'http://www.boatsellertheme.com/demo/widgets.json',
			   'import_customizer_file_url' => 'http://www.boatsellertheme.com/demo/customizer.dat',
			   'import_notice'              => $important_notice,
		   ),
	   );
   }
   endif;
   add_filter( 'pt-ocdi/import_files', 'boatseller_import_files' );
   if ( ! function_exists( 'boatseller_after_import' ) ) :
   function boatseller_after_import( $selected_import ) {
			//Set Menu
			$social_menu = get_term_by('name', 'social menu', 'nav_menu');
			$main_menu = get_term_by('name', 'Main Menu', 'nav_menu');
		   set_theme_mod( 'nav_menu_locations' , array( 
				 'primary' => $main_menu->term_id,
				 'top-menu' => $main_menu->term_id,  
				 'social' => $social_menu->term_id 
				) 
		   );
		   // Assign front page and posts page (blog page).
		   $front_page_id = get_page_by_title( 'Home' );
		   $blog_page_id  = get_page_by_title( 'Blog' );
		   update_option( 'show_on_front', 'page' );
		   update_option( 'page_on_front', $front_page_id->ID );
		   update_option( 'page_for_posts', $blog_page_id->ID );
   }
   add_action( 'pt-ocdi/after_import', 'boatseller_after_import' );
   endif;


/**
 * Add support to WooCommerce
 *
 * @since boatseller 1.0
 *
 */
function boatseller_wrapper_start()
{
    echo '<section id="main">';
}
function boatseller_wrapper_end()
{
    echo '</section>';
}
remove_action('woocommerce_before_main_content',
    'woocommerce_output_content_wrapper', 10);
remove_action('woocommerce_after_main_content',
    'woocommerce_output_content_wrapper_end', 10);
add_action('woocommerce_before_main_content', 'boatseller_wrapper_start', 10);
add_action('woocommerce_after_main_content', 'boatseller_wrapper_end', 10);
add_action('woocommerce_before_main_content', 'boatseller_remove_sidebar');
function boatseller_remove_sidebar()
{
    if (is_shop()) {
        remove_action('woocommerce_sidebar', 'woocommerce_get_sidebar', 10);
    }
}
add_action('after_setup_theme', 'boatseller_woocommerce_support');
function boatseller_woocommerce_support()
{
    add_theme_support('woocommerce');
}
// End WooCommerce
function boatseller_customize_control_js()
{
    wp_enqueue_script('boatseller_customizer_control', boatsellerURL .
        '/js/customizer-control.js', array('customize-controls', 'jquery'),
        boatsellerVERSION, true);
}
add_action('customize_controls_enqueue_scripts',
    'boatseller_customize_control_js');
function boatseller_custom_active_item_classes($classes = array(), $menu_item = false)
{
    global $post;
    if (is_object($menu_item->url))
        $classes[] = ($menu_item->url == get_post_type_archive_link($post->post_type)) ?
            'current-menu-item' : '';
    return $classes;
}
add_filter('nav_menu_css_class', 'boatseller_custom_active_item_classes', 10, 2);
if (get_theme_mod('boatseller_search_icon', '1') == '1' or is_customize_preview
    ())
    add_filter('wp_nav_menu_items', 'boatseller_add_to_menu', 10, 2);
function boatseller_add_to_menu($items, $args)
{
    if ($args->theme_location == 'primary') {
        $loginlink = "#";
        $items .= '<li class="search-toggle"><a id="search-toggle" class="menu-item-search" href="#"><i class="fa fa-search search-toggle"></i></a></li>';
    }
    return $items;
}
function boatseller_isboatdealer(){
    if (!function_exists('get_plugins')) 
        require_once ABSPATH . 'wp-admin/includes/plugin.php';
        $all_plugins = get_plugins();
        if (count($all_plugins) > 0)
            {
            foreach ($all_plugins as $plugin_item) {
                $plugin_title = $plugin_item['Name'];
                if($plugin_title == 'BoatDealer' or $plugin_title == 'BoatDealerPro')
                  return true;
            }
         return false;
       }
}
function boatseller_activ_message()
{
        echo '<div class="updated"><p>';
        if(!boatseller_isboatdealer()) 
          $bd_msg = '<img src="'.boatsellerimgURL.'/alertx150.png" />';
        else
          $bd_msg = '<img src="'.boatsellerimgURL.'/oktick.png" />';
        $bd_msg .= '<h2>';
        $bd_msg .= esc_html__('BoatSeller theme was activated!', "boatseller");
        $bd_msg .= '</h2>';
        $bd_msg .= '<br>';
    //    $bd_msg .= esc_html__("To manage go to Dashboard => Appearance => Customize", "boatseller");
        
        
        $bd_msg .= '<h3>For details and help, take a look at our Help Page at your left menu';
        $bd_msg .= '<br />';
        $bd_msg .= 'Appearance => Boat Seller Help';
        $bd_msg .= '<br /><br />';
        $bd_msg .= '  <a <a class="button button-primary" target="blank" href="' .
            SITEURL . '/wp-admin/themes.php?page=boat_seller"> Help Page</a>';
        $bd_msg .= '&nbsp;&nbsp;&nbsp;';       
        
        
        
        
        
        $bd_msg .= '<br>';
        if(!boatseller_isboatdealer())
        {
            $bd_msg .= '<h3>';
            $bd_msg .= esc_html__('Suggestion: install and activate the free BOAT DEALER PLUGIN from WordPress plugins repository.', "boatseller");
        }         
        echo $bd_msg;
        echo "</p></h3></div>";
} 
function boatseller_activ_enqueue()
{ 
    add_action( 'admin_notices', 'boatseller_activ_message' );
} 
if(is_admin())
{
   add_action('after_switch_theme', 'boatseller_activ_enqueue');
   require_once boatsellerPATH . '/inc/help.php';
   require_once (boatsellerPATH . '/inc/health.php');

}
/**
* Add support for Gutenberg.
*
* @link https://wordpress.org/gutenberg/handbook/reference/theme-support/
*/
function boatseller_setup_theme_supported_features() {
		// Theme supports wide images, galleries and videos.
		add_theme_support( 'align-wide' );
		// Make specific theme colors available in the editor.
}
add_action( 'after_setup_theme', 'boatseller_setup_theme_supported_features' );
function memory_status()
{
    $ret = false;
    if (defined("WP_MEMORY_LIMIT")) {
        $wplimite = trim(WP_MEMORY_LIMIT);
        $wplimite = substr($wplimite, 0, strlen($wplimite) - 1);
        if ($wplimite >= 128)
            $ret = true;
    }
    return $ret;
}
 
/**
 * Enqueue editor styles for Gutenberg
 */
function boatseller_gutenberg_colors() {
    /* Background */
	$color_scheme          = boatseller_get_color_scheme();
	$default_color         = $color_scheme[1];
    $css = boatseller_page_background_color_css2();
    $page_background_color = $default_color;
    $page_background_color = sanitize_hex_color(get_theme_mod( 'page_background_color', $default_color ));
    return  wp_strip_all_tags(sprintf( $css, $page_background_color));
    /* End Background */
}
function boatseller_gutenberg_colors2() {
    /* Foreground */
	$color_scheme          = boatseller_get_color_scheme();
	$default_color         = $color_scheme[3];
	$main_text_color = sanitize_hex_color(get_theme_mod( 'main_text_color', $color_scheme[3] ));
	$color_textcolor_rgb = boatseller_hex2rgb( $main_text_color );
	// If the rgba values are empty return early.
	if ( empty( $color_textcolor_rgb ) ) {
	 	return;
	}
	// If we get this far, we have a custom color scheme.
	$colors = array(
		'background_color'      => $color_scheme[0],
		'page_background_color' => $color_scheme[1],
		'link_color'            => $color_scheme[2],
		'main_text_color'       => $main_text_color, 
		'secondary_text_color'  => $color_scheme[4],
		'footer_color'          => $color_scheme[5],
    	'border_color'          => vsprintf( 'rgba( %1$s, %2$s, %3$s, 0.2)', $color_textcolor_rgb ),
	);
	$color_scheme_css = boatseller_get_color_scheme_css2( $colors );
    return wp_strip_all_tags($color_scheme_css);
    /* End Foreground */
}
function boatseller_gutenberg_editor_styles() {
	wp_enqueue_style( 'boatseller_gutenberg-editor-style', get_template_directory_uri() . '/css/gutenberg-editor-style.css' );
	// Add custom colors to Gutenberg.
	wp_add_inline_style( 'boatseller_gutenberg-editor-style', boatseller_gutenberg_colors() );
	wp_add_inline_style( 'boatseller_gutenberg-editor-style', boatseller_gutenberg_colors2() );
}

if(is_admin())
  add_action( 'enqueue_block_editor_assets', 'boatseller_gutenberg_editor_styles' );

function boatseller_page_background_color_css2() {
    /* Custom Page Background Color */
	$css = '
 		.site, .edit-post-layout__content
        {
			background-color: %1$s;
		}
		mark,
		ins,
		button,
		button[disabled]:hover,
		button[disabled]:focus,
		input[type="button"],
		input[type="button"][disabled]:hover,
		input[type="button"][disabled]:focus,
		input[type="reset"],
		input[type="reset"][disabled]:hover,
		input[type="reset"][disabled]:focus,
		input[type="submit"],
		input[type="submit"][disabled]:hover,
		input[type="submit"][disabled]:focus,
		.menu-toggle.toggled-on,
		.menu-toggle.toggled-on:hover,
		.menu-toggle.toggled-on:focus,
		.pagination .prev,
		.pagination .next,
		.pagination .prev:hover,
		.pagination .prev:focus,
		.pagination .next:hover,
		.pagination .next:focus,
		.pagination .nav-links:before,
		.pagination .nav-links:after,
		.widget_calendar tbody a,
		.widget_calendar tbody a:hover,
		.widget_calendar tbody a:focus,
		.page-links a,
		.page-links a:hover,
		.page-links a:focus 
        {
			color: %1$s;
		}
		@media screen and (min-width: 56.875em) {
			.main-navigation ul ul li {
				background-color: %1$s;
			}
			.main-navigation ul ul:after {
				border-top-color: %1$s;
				border-bottom-color: %1$s;
			}
		}
	';
    return $css;
}
function boatseller_get_color_scheme_css2( $colors ) {
	$colors = wp_parse_args( $colors, array(
		'background_color'      => '',
		'page_background_color' => '',
		'link_color'            => '',
		'main_text_color'       => '',
		'secondary_text_color'  => '',
  		'footer_color'          => '',
  		'border_color'          => '',
	) );
	return <<<CSS
	/* Color Scheme */
	/* Background Color */
	body {
		background-color: {$colors['background_color']};
	}
	/* Page Background Color */
	.site {
		background-color: {$colors['page_background_color']};
	}
    
    
	.editor-post-title__block .editor-post-title__input,
    /*
    .editor-post-title__input,
    .components-button components-icon-button editor-inserter__toggle,
    .dashicon dashicons-insert,
    */
    
    .editor-block-list__empty-block-inserter .components-icon-button svg, .editor-default-block-appender .editor-inserter .components-icon-button svg, .editor-inserter-with-shortcuts .components-icon-button svg,
    
    /* .editor-writing-flow */
    
    .wp-block-image figcaption
    
    {
			color: {$colors['main_text_color']};
            background: white;
            
	}
	mark,
	ins,
	button,
	button[disabled]:hover,
	button[disabled]:focus,
	input[type="button"],
	input[type="button"][disabled]:hover,
	input[type="button"][disabled]:focus,
	input[type="reset"],
	input[type="reset"][disabled]:hover,
	input[type="reset"][disabled]:focus,
	input[type="submit"],
	input[type="submit"][disabled]:hover,
	input[type="submit"][disabled]:focus,
	.menu-toggle.toggled-on,
	.menu-toggle.toggled-on:hover,
	.menu-toggle.toggled-on:focus,
	.pagination .prev,
	.pagination .next,
	.pagination .prev:hover,
	.pagination .prev:focus,
	.pagination .next:hover,
	.pagination .next:focus,
	.pagination .nav-links:before,
	.pagination .nav-links:after,
	.widget_calendar tbody a,
	.widget_calendar tbody a:hover,
	.widget_calendar tbody a:focus,
	.page-links a,
	.page-links a:hover,
	.page-links a:focus {
		color: {$colors['page_background_color']};
	}
	/* Link Color */
	.menu-toggle:hover,
	.menu-toggle:focus,
	a,
	.main-navigation a:hover,
	.main-navigation a:focus,
	.dropdown-toggle:hover,
	.dropdown-toggle:focus,
	.social-navigation a:hover:before,
	.social-navigation a:focus:before,
	.post-navigation a:hover .post-title,
	.post-navigation a:focus .post-title,
	.tagcloud a:hover,
	.tagcloud a:focus,
	.site-branding .site-title a:hover,
	.site-branding .site-title a:focus,
	.entry-title a:hover,
	.entry-title a:focus,
	.entry-footer a:hover,
	.entry-footer a:focus,
	.comment-metadata a:hover,
	.comment-metadata a:focus,
	.pingback .comment-edit-link:hover,
	.pingback .comment-edit-link:focus,
	.comment-reply-link,
	.comment-reply-link:hover,
	.comment-reply-link:focus,
	.required,
	.site-info a:hover,
	.site-info a:focus {
		color: {$colors['link_color']};
	}
	mark,
	ins,
	button:hover,
	button:focus,
	input[type="button"]:hover,
	input[type="button"]:focus,
	input[type="reset"]:hover,
	input[type="reset"]:focus,
	input[type="submit"]:hover,
	input[type="submit"]:focus,
	.pagination .prev:hover,
	.pagination .prev:focus,
	.pagination .next:hover,
	.pagination .next:focus,
	.widget_calendar tbody a,
	.page-links a:hover,
	.page-links a:focus {
		background-color: {$colors['link_color']};
	}
	input[type="date"]:focus,
	input[type="time"]:focus,
	input[type="datetime-local"]:focus,
	input[type="week"]:focus,
	input[type="month"]:focus,
	input[type="text"]:focus,
	input[type="email"]:focus,
	input[type="url"]:focus,
	input[type="password"]:focus,
	input[type="search"]:focus,
	input[type="tel"]:focus,
	input[type="number"]:focus,
	textarea:focus,
	.tagcloud a:hover,
	.tagcloud a:focus,
	.menu-toggle:hover,
	.menu-toggle:focus {
		border-color: {$colors['link_color']};
	}
	/* Main Text Color */
    edit-post-layout__content,
    .editor-block-list__layout .editor-block-list__block, 
	body,
	blockquote cite,
	blockquote small,
	.main-navigation a,
	.menu-toggle,
	.dropdown-toggle,
	.social-navigation a,
	.post-navigation a,
	.pagination a:hover,
	.pagination a:focus,
	.widget-title a,
	.site-branding .site-title a,
	.entry-title a,
	.page-links > .page-links-title,
	.comment-author,
	.comment-reply-title small a:hover,
	.comment-reply-title small a:focus {
		color: {$colors['main_text_color']};
	}
	blockquote,
	.menu-toggle.toggled-on,
	.menu-toggle.toggled-on:hover,
	.menu-toggle.toggled-on:focus,
	.post-navigation,
	.post-navigation div + div,
	.pagination,
	.widget,
	.page-header,
	.page-links a,
	.comments-title,
	.comment-reply-title {
		border-color: {$colors['main_text_color']};
	}
	button,
	button[disabled]:hover,
	button[disabled]:focus,
	input[type="button"],
	input[type="button"][disabled]:hover,
	input[type="button"][disabled]:focus,
	input[type="reset"],
	input[type="reset"][disabled]:hover,
	input[type="reset"][disabled]:focus,
	input[type="submit"],
	input[type="submit"][disabled]:hover,
	input[type="submit"][disabled]:focus,
	.menu-toggle.toggled-on,
	.menu-toggle.toggled-on:hover,
	.menu-toggle.toggled-on:focus,
	.pagination:before,
	.pagination:after,
	.pagination .prev,
	.pagination .next,
	.page-links a {
		background-color: {$colors['main_text_color']};
	}
	/* Secondary Text Color */
	/**
	 * IE8 and earlier will drop any block with CSS3 selectors.
	 * Do not combine these styles with the next block.
	 */
	body:not(.search-results) .entry-summary {
		color: {$colors['secondary_text_color']};
	}
	blockquote,
	.post-password-form label,
	a:hover,
	a:focus,
	a:active,
	.post-navigation .meta-nav,
	.image-navigation,
	.comment-navigation,
	.widget_recent_entries .post-date,
	.widget_rss .rss-date,
	.widget_rss cite,
	.site-description,
	.author-bio,
	.entry-footer,
	.entry-footer a,
	.sticky-post,
	.taxonomy-description,
	.entry-caption,
	.comment-metadata,
	.pingback .edit-link,
	.comment-metadata a,
	.pingback .comment-edit-link,
	.comment-form label,
	.comment-notes,
	.comment-awaiting-moderation,
	.logged-in-as,
	.form-allowed-tags,
	.site-info,
	.site-info a,
	.wp-caption .wp-caption-text,
	.gallery-caption,
	.widecolumn label,
	.widecolumn .mu_register label {
		color: {$colors['secondary_text_color']};
	}
	.widget_calendar tbody a:hover,
	.widget_calendar tbody a:focus {
		background-color: {$colors['secondary_text_color']};
	}
	/* Border Color */
	fieldset,
	pre,
	abbr,
	acronym,
	table,
    .wp-block-table,
	th,
	td,
	input[type="date"],
	input[type="time"],
	input[type="datetime-local"],
	input[type="week"],
	input[type="month"],
	input[type="text"],
	input[type="email"],
	input[type="url"],
	input[type="password"],
	input[type="search"],
	input[type="tel"],
	input[type="number"],
	textarea,
	.main-navigation li,
	.main-navigation .primary-menu,
	.menu-toggle,
	.dropdown-toggle:after,
	.social-navigation a,
	.image-navigation,
	.comment-navigation,
	.tagcloud a,
	.entry-content,
	.entry-summary,
	.page-links a,
	.page-links > span,
	.comment-list article,
	.comment-list .pingback,
	.comment-list .trackback,
	.comment-reply-link,
	.no-comments,
	.widecolumn .mu_register .mu_alert {
		border-color: {$colors['main_text_color']}; /* Fallback for IE7 and IE8 */
		border-color: {$colors['border_color']} !important;
	}
	hr,
	code {
		background-color: {$colors['main_text_color']}; /* Fallback for IE7 and IE8 */
		background-color: {$colors['border_color']};
	}
    /*  Footer ///// */  
       .site-footer {
        background: {$colors['border_color']};
	}
	@media screen and (min-width: 56.875em) {
		.main-navigation li:hover > a,
		.main-navigation li.focus > a {
			color: {$colors['link_color']};
		}
		.main-navigation ul ul,
		.main-navigation ul ul li {
			border-color: {$colors['border_color']};
		}
		.main-navigation ul ul:before {
			border-top-color: {$colors['border_color']};
			border-bottom-color: {$colors['border_color']};
		}
		.main-navigation ul ul li {
			background-color: {$colors['page_background_color']};
		}
		.main-navigation ul ul:after {
			border-top-color: {$colors['page_background_color']};
			border-bottom-color: {$colors['page_background_color']};
		}
	}
CSS;
}
function boatseller_dashboard_help()
{
    echo '<div style="text-align: center">';
    echo '<img src="' . boatsellerURL .
        '/images/infox350.png" style="text-align:center; width:70%; margin: 0px 0 auto;"  />';
    echo '<a target="blank" href="http://boatsellertheme.com">';
    echo '<img id="boatseller-logo-dashboard" src="' . boatsellerURL .
        '/images/logo.png" style="max-width: 300px;" />';
    echo '</a>';
    $bd_msg = '<br /><br />';
    
    
    /*
    $bd_msg .= '<h3>'.esc_html__("For demo, details, support and help, visit our site.", "boatseller");
    $bd_msg .= '<br>';
    $bd_msg .= esc_html__("To manage go to Dashboard => Appearance => Customize", "boatseller");
    $bd_msg .= '</h3><br />';
    */
 
        $bd_msg .= '<h3>For details and help, take a look at our Help Page at your left menu';
        $bd_msg .= '<br />';
        $bd_msg .= 'Appearance => Boat Seller Help';
        $bd_msg .= '<br /><br />';
        $bd_msg .= '  <a <a class="button button-primary" target="blank" href="' .
            SITEURL . '/wp-admin/themes.php?page=boat_seller"> Help Page</a>';
        $bd_msg .= '&nbsp;&nbsp;&nbsp;';      
    
    
    $bd_msg .= '&nbsp;&nbsp;&nbsp;';
    $bd_url = '  <a class="button button-primary" target="blank" href="http://boatsellertheme.com">'.esc_attr__("Visit Our Site","boatseller").'</a>';
    $bd_msg .= $bd_url;
    $bd_msg .= '&nbsp;&nbsp;&nbsp;';
    $bd_url = '<a class="button button-primary" target="blank" href="http://boatsellertheme.com/help/index.html">'.esc_attr__("OnLine Guide","boatseller").'</a>';
    $bd_msg .= $bd_url;
    echo $bd_msg;
    echo "</p>";
    echo "</h3>";
    echo "</div>";
}
function boatseller_add_dashboard_widgets()
{
    add_meta_box('boatseller-dashboard', esc_html__('Boat Seller Theme Help and Support', 'boatseller'),
        'boatseller_dashboard_help', 'dashboard', 'normal', 'high');
}
add_action("wp_dashboard_setup", "boatseller_add_dashboard_widgets");    
