<?php
/**
 * boat seller Customizer functionality
 *
 * @package boatseller
 * @subpackage Boat_seller
 * @since boat seller 1.0
 */
/**
 * Sets up the WordPress core custom background features.
 *
 * @since boat seller 1.0
 *
 */
function boatseller_custom_background() {
	$color_scheme             = boatseller_get_color_scheme();
	$default_background_color = trim( $color_scheme[0], '#' );
	$default_text_color       = trim( $color_scheme[3], '#' );
	/**
	 * Filter the arguments used when adding 'custom-background' support in boat seller.
	 *
	 * @since boat seller 1.0
	 *
	 * @param array $args {
	 *     An array of custom-background support arguments.
	 *
	 *     @type string $default-color Default color of the background.
	 * }
	 */
	add_theme_support( 'custom-background', apply_filters( 'boatseller_custom_background_args', array(
		'default-color' => $default_background_color,
	) ) );
}
add_action( 'after_setup_theme', 'boatseller_custom_background' );
if ( ! function_exists( 'boatseller_header_style' ) ) :
/**
 * Styles the header text displayed on the site.
 *
 * Create your own boatseller_header_style() function to override in a child theme.
 *
 * @since boat seller 1.0
 *
 * @see boatseller_custom_header_and_background().
 */
function boatseller_header_style() {
	// If the header text option is untouched, let's bail.
   // return;
	if ( display_header_text() ) {
		return;
	}
	// If the header text has been hidden.
	?>
	<style type="text/css" id="boatseller-header-css">
		.site-branding {
			margin: 0 auto 0 0;
		}
		.site-branding .site-title,
		.site-description {
			clip: rect(1px, 1px, 1px, 1px);
			position: absolute;
		}
	</style>
	<?php
}
endif; // boatseller_header_style
/**
 * Sets up the WordPress core custom header and custom background features.
 *
 * @since boat seller 1.0
 *
 * @see boatseller_header_style()
 */
function boatseller_custom_site($wp_customize) {
/*
$wp_customize->add_panel( 'settings', array(
    'title' => 'Settings',
    'description' => 'Settings Panel',
    'priority' => 20,
) ); 
*/
$wp_customize->add_panel( 'general', array(
    'title' => 'Theme Options',
    'description' =>  __('General Settings Panel', 'boatseller' ),
    'priority' => 10,
) );
// Margin-logo
  		$wp_customize->add_setting( 'boatseller_logo_margin_top', array(
         'sanitize_callback' =>'boatseller_sanitize_text',
         'default' => '20'
		) );
		$wp_customize->add_control( 'boatseller_logo_margin_top', array(
			'label'      =>   __('Branding Margin From Top','boatseller' ),
			'section'    => 'title_tagline',
            'type' => 'range',
            'description' =>   __('Choose from -20px to 100px', 'boatseller' ),
         	'priority' => 9,
            'input_attrs' => array(
            'min' => -20,
            'max' => 100,
            'step' => 10
          ),
		) ); 
$wp_customize->add_setting('header_text_bill', array(
     'sanitize_callback' =>'boatseller_sanitize_checkbox', 
     'default' => '1',
     ));
$wp_customize->add_control( 'header_text_bill', array(
				'label'    =>   __('Display Site Title and Tagline','boatseller' ),
				'section'  => 'title_tagline',
				'settings' => 'header_text_bill',
				'type'     => 'checkbox',
			) );
// Lay Out
    $wp_customize->add_section( 
    	'general_settings_section', 
    	array(
    		'title'       =>   __('Layout', 'boatseller' ),
    		'priority'    => 1,
    		'capability'  => 'edit_theme_options',
    		'description' =>  __('Change General options here.', 'boatseller'), 
            'panel'       => 'general',    	) 
    ); 
$wp_customize->add_setting('boatseller_entry_title', array(
     'sanitize_callback' =>'boatseller_sanitize_checkbox', 
     'default' => '1',
     ));
$wp_customize->add_control(
		'boatseller_entry_title',
		array(
			'settings'		=> 'boatseller_entry_title',
			'section'		=> 'general_settings_section',
			'type'			=> 'checkbox',
			'label'			=>   __('Show entry-title', 'boatseller' ),
			'description'	=> '',
		)
	);
     $wp_customize->add_setting('boatseller_layout_type', array(
     'sanitize_callback' =>'boatseller_sanitize_text',
     'default' => '2'
     ));
 	$wp_customize->add_control(
		'boatseller_layout_type',
		array(
			'settings'		=> 'boatseller_layout_type',
			'section'		=> 'general_settings_section',
			'type'			=> 'radio',
			'label'			=>   __('Website Layout', 'boatseller' ) ,
			'description'	=> '',
			'choices'		=> array(
   				'3' => __('Boxed Width 1200px', 'boatseller' ),
				'1' => __('Boxed Width 1000px', 'boatseller' ),
				'2' => __('Wide', 'boatseller' )
			)
		)
	); 
    $wp_customize->add_setting( 'boatseller_opacity',
        	array(
        		'default' => '10',
               'sanitize_callback' => 'boatseller_sanitize_number',        	)
        );
     $wp_customize->add_control( 'boatseller_opacity', array(
      'type' => 'range',
      'section' => 'general_settings_section',
      'label' =>   __('Background transparency (opacity)', 'boatseller' ),
      'description' =>   __('Choose from .6 to 1', 'boatseller' ),
      'sanitize_callback' => 'boatseller_sanitize_number',
      'input_attrs' => array(
        'min' => 6,
        'max' => 10,
        'step' => 1,
      ),
    ) );
// Top Header Settings
      $wp_customize->add_section( 
    	'top_header_settings_section', 
    	array(
    		'title'       =>   __('Top Header Settings', 'boatseller' ),
    		'priority'    => 81,
    		'capability'  => 'edit_theme_options',
    		'description' => '',
            'panel'       => 'general',    	 
    	) 
    );
     $wp_customize->add_setting('boatseller_show_top_header', array(
     'sanitize_callback' =>'boatseller_sanitize_text',
     'default' => '1'
     ));
	$wp_customize->add_control(
		'boatseller_show_top_header',
		array(
			'settings'		=> 'boatseller_show_top_header',
			'section'		=> 'top_header_settings_section',
			'type'			=> 'checkbox',
			'label'			=>   __('Show', 'boatseller' ),
			'description'	=>   __('Show Top Header Info (email, phone, hours) and Social Media Menu at top header.', 'boatseller' ),
            'sanitize_callback' => 'boatseller_sanitize_checkbox',            
		)
	); 
    $wp_customize->add_setting('boatseller_topinfo_phone', array(
      'sanitize_callback' =>'boatseller_sanitize_phone', 
      'default'        => '',
     ));
    $wp_customize->add_control('boatseller_topinfo_phone', array(
     'label'   =>   __('Top Info Phone', 'boatseller' ),
      'section' => 'top_header_settings_section',
	  'description' => __('Digite only numbers and . or - to separate them.', 'boatseller' ),
     'type'    => 'text',
    )); 
       $wp_customize->add_setting('boatseller_topinfo_email', array(
      'sanitize_callback' =>'boatseller_sanitize_email', 
      'default'        => '',
     ));
    $wp_customize->add_control('boatseller_topinfo_email', array(
     'label'   =>   __('Top Info eMail', 'boatseller' ),
      'section' => 'top_header_settings_section',
     'type'    => 'text',
    )); 
       $wp_customize->add_setting('boatseller_topinfo_hours', array(
      'sanitize_callback' =>'boatseller_sanitize_html', 
      'default'        => '',
     ));
    $wp_customize->add_control('boatseller_topinfo_hours', array(
     'label'   =>   __('Top Info Hours', 'boatseller' ),
      'section' => 'top_header_settings_section',
     'type'    => 'text',
    )); 
    $wp_customize->add_setting( 'boatseller_topinfo_color',
    	array(
    		'default' => '#808080',
	    	'sanitize_callback' => 'sanitize_hex_color',
    	)
    );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'boatseller_topinfo_color', array(
    			'label'    =>   __('Header Top Info Color', 'boatseller' ),
                'section' => 'top_header_settings_section', 
    	        'settings' => 'boatseller_topinfo_color',
           		'priority' => 60,
    		)
    	)
    );
// End Top Page Settings
// Header Settings
      $wp_customize->add_section( 
    	'header_settings_section', 
    	array(
    		'title'       =>   __('Header Settings', 'boatseller' ),
    		'priority'    => 100,
    		'capability'  => 'edit_theme_options',
    		'description' => __('Configure header transparency, bottom border and background color','boatseller'), 
            'panel'       => 'general', 
    	) 
    );
     $wp_customize->add_setting( 'boatseller_header_opacity',
        	array(
        		'default' => '9',
               'sanitize_callback' => 'boatseller_sanitize_number',        	)
        );
     $wp_customize->add_control( 'boatseller_header_opacity', array(
      'type' => 'range',
      'section' => 'header_settings_section',
      'label' =>   __('Background header transparency (opacity)', 'boatseller' ),
      'description' =>   __('Choose from .6 to 1', 'boatseller' ),
      'sanitize_callback' => 'boatseller_sanitize_number',
      'input_attrs' => array(
        'min' => 6,
        'max' => 10,
        'step' => 1)
     ));
    $wp_customize->add_setting( 'boatseller_header_style', array(
      'default' =>'1' ,
      'sanitize_callback' =>'boatseller_sanitize_text',
    ));
        $wp_customize->add_setting( 'boatseller_header_background_color',
    	array(
    		'default' => '#333333',
	    	'sanitize_callback' => 'sanitize_hex_color',
    	)
    );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'boatseller_copyright_color', array(
    			'label'    =>   __('Header Background Color', 'boatseller' ),
                'section' => 'header_settings_section', 
    	        'settings' => 'boatseller_header_background_color',
           		'priority' => 10,
    		)
    	)
    );
    $wp_customize->add_setting('boatseller_header_border', array(
      'sanitize_callback' =>'boatseller_sanitize_checkbox', 
      'default'        => '',
     ));
	$wp_customize->add_control(
		'boatseller_header_border',
		array(
			'settings'		=> 'boatseller_header_border',
			'section'		=> 'header_settings_section',
			'type'			=> 'checkbox',
			'label'			=>   __('Show 1px bottom header border', 'boatseller' ),
			'description'	=> '',
		)
	);    
    $wp_customize->add_setting( 'boatseller_header_border_color',
    	array(
    		'default' => '#f1f1f1',
	    	'sanitize_callback' => 'sanitize_hex_color',
    	)
    );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'boatseller_header_border_color', array(
    			'label'    =>   __('Header Bottom Border Color', 'boatseller' ),
                'section' => 'header_settings_section', 
    	        'settings' => 'boatseller_header_border_color',
           		'priority' => 20,
    		)
    	)
    );
        $wp_customize->add_setting( 'boatseller_header_background_color',
    	array(
    		'default' => '#444444',
	    	'sanitize_callback' => 'sanitize_hex_color',
    	)
    );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'boatseller_header_background_color', array(
    			'label'    =>   __('Header Background Color', 'boatseller' ),
                'section' => 'header_settings_section', 
    	        'settings' => 'boatseller_header_background_color',
           		'priority' => 20,
    		)
    	)
    );
// WooCommerce
$all_plugins = apply_filters('active_plugins', get_option('active_plugins'));
if (stripos(implode($all_plugins), 'woocommerce.php')) {
    $wp_customize->add_setting( 'boatseller_header_cart_color',
        	array(
        		'default' => '#ffffff',
    	    	'sanitize_callback' => 'boatseller_sanitize_text',
        	)
        );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'boatseller_header_cart_color', array(
        			'label'    =>   __('Shopping Cart Text Color', 'boatseller' ),
                    'section' => 'header_settings_section', 
        	        'settings' => 'boatseller_header_cart_color',
        			'description'	=> __('If you use WooCommerce plugin','boatseller'),
               		'priority' => 40,
        		)
        	)
    ); 
}
/* End Header  */
/////////// Navigation Details
    $wp_customize->add_section( 
    	'navigation_colors_section', 
    	array(
    		'title'       =>   __('Main Navigation Design', 'boatseller' ),
    		'priority'    => 101,
    		'capability'  => 'edit_theme_options',
            'panel'       => 'general',
    		'description' =>  __('Change Navigation detais here.', 'boatseller'), 
    	) 
    );
     $wp_customize->add_setting( 'boatseller_menu_margin_top',
        	array(
        		'default' => '30',
                'sanitize_callback' => 'sanitize_text_field',                
        	)
        );
     $wp_customize->add_control( 'boatseller_menu_margin_top', array(
      'type' => 'range',
      'section' => 'navigation_colors_section',
      'label' =>   __('Menu Margin Top', 'boatseller' ),
      'description' =>   __('Choose from -20 to 50 Pixels.', 'boatseller' ),
      'input_attrs' => array(
        'min' => -20,
        'max' => 50,
        'step' => 1,
      ),
    ) );
   $wp_customize->add_setting( 'boatseller_menu_margin_right',
        	array(
        		'default' => '0',
                'sanitize_callback' => 'sanitize_text_field',                
        	)
        );
     $wp_customize->add_control( 'boatseller_menu_margin_right', array(
      'type' => 'range',
      'section' => 'navigation_colors_section',
      'label' =>   __('Menu Margin Right', 'boatseller' ),
      'description' =>   __('Choose from -20 to 30 Pixels.', 'boatseller' ),
      'input_attrs' => array(
        'min' => -20,
        'max' => 30,
        'step' => 1,
      ),
    ) );   
    $wp_customize->add_setting( 'menu_font_size',
        	array(
        		'default' => '16',
               'sanitize_callback' => 'boatseller_sanitize_number',        	)
        );
     $wp_customize->add_control( 'menu_font_size', array(
      'type' => 'range',
      'section' => 'navigation_colors_section',
      'label' =>   __('Menu Font Size', 'boatseller' ),
      'description' =>   __('Choose from 12 to 20 Pixels.', 'boatseller' ),
      'sanitize_callback' => 'boatseller_sanitize_number',
      'input_attrs' => array(
        'min' => 12,
        'max' => 20,
        'step' => 1,
      ),
    ) );
    $wp_customize->add_setting( 'boatseller_navigation_background',
    	array(
    		'default' => '#444444',
            'sanitize_callback' => 'sanitize_hex_color',
    	)
    );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'boatseller_navigation_background', array(
    			'label'    =>  __('Background Navigation Color', 'boatseller' ),
                'section' => 'navigation_colors_section', 
    	        'settings' => 'boatseller_navigation_background',
           		'priority' => 10,
    		)
    	)
    );
     $wp_customize->add_setting( 'boatseller_menu_color',
    	array(
    		'default' => '#ffffff',
            'sanitize_callback' => 'sanitize_hex_color',
    	)
    );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'boatseller_menu_color', array(
    			'label'    =>  __('Menu Text Color', 'boatseller' ),
                'section' => 'navigation_colors_section', 
    	        'settings' => 'boatseller_menu_color',
           		'priority' => 10,
    		)
    	)
    ); 
   $wp_customize->add_setting( 'boatseller_menu_hover_color',
    	array(
    		'default' => '#ffffff',
            'sanitize_callback' => 'sanitize_hex_color',
    	)
    );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'boatseller_menu_hover_color', array(
    			'label'    =>  __('Menu Text Hover Color', 'boatseller' ),
                'section' => 'navigation_colors_section', 
    	        'settings' => 'boatseller_menu_hover_color',
           		'priority' => 10,
    		)
    	)
    );   
     $wp_customize->add_setting( 'boatseller_submenu_background',
    	array(
    		'default' => '#e65e23',
            'sanitize_callback' => 'sanitize_hex_color',
    	)
    );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'boatseller_submenu_background', array(
    			'label'    =>  __('Sub Menu Background', 'boatseller' ),
                'section' => 'navigation_colors_section', 
    	        'settings' => 'boatseller_submenu_background',
           		'priority' => 10,
    		)
    	)
    );     
      $wp_customize->add_setting( 'boatseller_submenu_color',
    	array(
    		'default' => '#ffffff',
            'sanitize_callback' => 'sanitize_hex_color',
    	)
    );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'boatseller_submenu_color', array(
    			'label'    =>  __('Sub Menu Text Color', 'boatseller' ),
                'section' => 'navigation_colors_section', 
    	        'settings' => 'boatseller_submenu_color',
           		'priority' => 10,
    		)
    	)
    ); 
    $wp_customize->add_setting( 'boatseller_submenu_hover_color',
    	array(
    		'default' => '#000000',
             'sanitize_callback' => 'sanitize_hex_color',           
    	)
    );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'boatseller_submenu_hover_color', array(
    			'label'    =>  __('Sub Menu Hover color', 'boatseller' ),
                'section' => 'navigation_colors_section', 
    	        'settings' => 'boatseller_submenu_hover_color',
           		'priority' => 10,
    		)
    	)
    );     
     $wp_customize->add_setting( 'boatseller_submenu_hover_background',
    	array(
    		'default' => '#d1d1d1',
            'sanitize_callback' => 'sanitize_hex_color',           
    	)
    );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'boatseller_submenu_hover_background', array(
    			'label'    =>  __('Sub Menu Hover Background', 'boatseller' ),
                'section' => 'navigation_colors_section', 
    	        'settings' => 'boatseller_submenu_hover_background',
           		'priority' => 10,
    		)
    	)
    );        
/////////// End Navigation Colors
/////////// Social Menu
    $wp_customize->add_section( 
    	'social_navigation_section', 
    	array(
    		'title'       =>   __('Social Navigation Design', 'boatseller' ),
    		'priority'    => 101,
    		'capability'  => 'edit_theme_options',
            'panel'       => 'general',
    		'description' => '',
    	) 
    );
    $wp_customize->add_setting( 'boatseller_social_menu', array(
      'default' =>'white' ,
      'sanitize_callback' =>'boatseller_sanitize_text',
    ));
	$wp_customize->add_control(
		'boatseller_social_menu',
		array(
			'settings'		=> 'boatseller_social_menu',
			'section'		=> 'social_navigation_section',
			'type'			=> 'radio',
			'label'			=>   __('Social Menu Color', 'boatseller' ),
			'description'	=> '',
			'choices'		=> array(
				'white' =>   __('White', 'boatseller' ),
				'lightgray' =>   __('Gray', 'boatseller' ),
			 	'darkgray' =>   __('Dark', 'boatseller' )
			)
		)
	);
// End Social
// Footer
      $wp_customize->add_section( 
    	'footer_settings_section', 
    	array(
    		'title'       =>   __('Footer Copyright', 'boatseller' ),
    		'priority'    => 100,
    		'capability'  => 'edit_theme_options',
    		'description' => '',
            'panel'       => 'general', 
    	) 
    );
    $wp_customize->add_setting('boatseller_footer_copyright', array(
      'sanitize_callback' =>'boatseller_sanitize_html', 
      'default'        => '',
     ));
    $wp_customize->add_control('boatseller_footer_copyright', array(
     'label'   =>   __('Copyright Footer Text Here', 'boatseller' ),
      'section' => 'footer_settings_section',
     'type'    => 'textarea',
    ));            
    $wp_customize->add_setting( 'boatseller_copyright_background',
    	array(
    		'default' => '#f1f1f1',
	    	'sanitize_callback' => 'sanitize_hex_color',
    	)
    );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'boatseller_copyright_background', array(
    			'label'    =>   __('Copyright Background Color', 'boatseller' ),
                'section' => 'footer_settings_section', 
    	        'settings' => 'boatseller_copyright_background',
           		'priority' => 50,
    		)
    	)
    );
        $wp_customize->add_setting( 'boatseller_copyright_color',
    	array(
    		'default' => '#333333',
	    	'sanitize_callback' => 'sanitize_hex_color',
    	)
    );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'boatseller_copyright_color', array(
    			'label'    =>   __('Copyright Text Color', 'boatseller' ),
                'section' => 'footer_settings_section', 
    	        'settings' => 'boatseller_copyright_color',
           		'priority' => 60,
    		)
    	)
    );
//First Footer Widget
//1-footer
function boatseller_is_sidebar_active($index) {
	global $wp_registered_sidebars;
	$widgetcolums = wp_get_sidebars_widgets();
    if (!isset($widgetcolums[$index]))
       return false;
	 if ($widgetcolums[$index])
		return true;
	return false;
}
if ( function_exists('boatseller_is_sidebar_active')) {
    if( boatseller_is_sidebar_active('1-footer')  or  boatseller_is_sidebar_active('2-footer') or  boatseller_is_sidebar_active('3-footer')  ) { 
    $wp_customize->add_section( 
    	'footer_background_section', 
    	array(
    		'title'       =>   __('Footer Background', 'boatseller' ),
    		'priority'    => 100,
    		'capability'  => 'edit_theme_options',
    		'description' => '',
            'panel'       => 'general', 
    	) 
    );
    $wp_customize->add_setting( 'boatseller_footer_background', array(
      'default' =>'White' ,
      'sanitize_callback' =>'boatseller_sanitize_text',
    ));
	$wp_customize->add_control(
		'boatseller_footer_background',
		array(
			'settings'		=> 'boatseller_footer_background',
			'section'		=> 'footer_background_section',
			'type'			=> 'radio',
			'label'			=>   __('Footer Background Color', 'boatseller' ),
			'description'	=> 'To see the footer, you need add some widget there.',
			'choices'		=> array(
				'white' =>   __('White', 'boatseller' ),
				'lightgray' =>   __('Gray', 'boatseller' ),
			 	'darkgray' =>   __('Dark', 'boatseller' )
			)
		)
	);   
  }    
}  
/* End Footer  */
// Blog Settings
      $wp_customize->add_section( 
    	'blog_settings_section', 
    	array(
    		'title'       =>   __('Blog Settings', 'boatseller' ),
    		'priority'    => 100,
    		'capability'  => 'edit_theme_options',
    		'description' => __('Configure Blog style.', 'boatseller' ),
            'panel'       => 'general', 
    	) 
    );
    $wp_customize->add_setting( 'boatseller_blog_style', array(
      'default' =>'3' ,
      'sanitize_callback' =>'boatseller_sanitize_text',
    ));
	$wp_customize->add_control(
		'boatseller_blog_style',
		array(
			'settings'		=> 'boatseller_blog_style',
			'section'		=> 'blog_settings_section',
			'type'			=> 'select',
			'label'			=>   __('Choose Blog Page Style', 'boatseller' ),
			'description'	=> __('Look the right panel (and go to blog page) to see the preview...', 'boatseller' ),
			'choices'		=> array(
				'1' => __('Blog Standard', 'boatseller' ),
				'2' => __('Blog List View', 'boatseller' ),
                '3' => __('Blog Masonry', 'boatseller' ), 
			)
		)
	);
$wp_customize->add_setting('boatseller_blog_post_meta', array(
     'sanitize_callback' =>'boatseller_sanitize_checkbox', 
     'default' => '1',
     ));
$wp_customize->add_control( 'boatseller_blog_post_meta', array(
				'label'    =>   __('Turn on to display post meta on blog single posts page','boatseller' ),
				'section'  => 'blog_settings_section',
				'settings' => 'boatseller_blog_post_meta',
				'type'     => 'checkbox',
			) );
$wp_customize->add_setting('boatseller_blog_post_author', array(
     'sanitize_callback' =>'boatseller_sanitize_checkbox', 
     'default' => '1',
     ));
$wp_customize->add_control( 'boatseller_blog_post_author', array(
				'label'    =>   __('Turn on to display post author on blog single posts page','boatseller' ),
				'section'  => 'blog_settings_section',
				'settings' => 'boatseller_blog_post_author',
				'type'     => 'checkbox',
			) );
$wp_customize->add_setting('boatseller_blog_post_categories', array(
     'sanitize_callback' =>'boatseller_sanitize_checkbox', 
     'default' => '1',
     ));
$wp_customize->add_control( 'boatseller_blog_post_categories', array(
				'label'    =>   __('Turn on to display categories on blog posts','boatseller' ),
				'section'  => 'blog_settings_section',
				'settings' => 'boatseller_blog_post_categories',
				'type'     => 'checkbox',
			) );
$wp_customize->add_setting('boatseller_blog_post_date', array(
     'sanitize_callback' =>'boatseller_sanitize_checkbox', 
     'default' => '1',
     ));
$wp_customize->add_control( 'boatseller_blog_post_date', array(
				'label'    =>   __('Turn on to display date on blog posts','boatseller' ),
				'section'  => 'blog_settings_section',
				'settings' => 'boatseller_blog_post_date',
				'type'     => 'checkbox',
			) );
// Sidebar
$wp_customize->add_setting('boatseller_blog_sidebar', array(
     'sanitize_callback' =>'boatseller_sanitize_checkbox', 
     'default' => '1',
     ));
$wp_customize->add_control( 'boatseller_blog_sidebar', array(
				'label'    =>   __('Turn on to display sidebar on posts page.','boatseller' ),
				'section'  => 'blog_settings_section',
				'settings' => 'boatseller_blog_sidebar',
				'type'     => 'checkbox',
			) );         
$wp_customize->add_setting('boatseller_show_sidebar_singlepage', array(
     'sanitize_callback' =>'boatseller_sanitize_checkbox',
     'default' => '1'
     ));
$wp_customize->add_control(
		'boatseller_show_sidebar_singlepage',
		array(
			'settings'		=> 'boatseller_show_sidebar_singlepage',
            'section' => 'blog_settings_section',
			'type'			=> 'checkbox',
			'label'			=>   __('Turn on to display sidebar at all blog single post pages.', 'boatseller' ),
			'description'	=> '',
            'sanitize_callback' => 'boatseller_sanitize_checkbox',            
		)
	);   
// End Sidebar 
/*    
// Post meta
// Turn on to display post meta on blog posts
Display Author
Display author on blog posts
Display Categories
Display categories on blog posts
*/
// End Blog
// miscellany
      $wp_customize->add_section( 
    	'theme_miscellany_section', 
    	array(
    		'title'       =>   __('Miscellany', 'boatseller' ),
    		'priority'    => 900,
    		'capability'  => 'edit_theme_options',
    		'description' => __('Configure Theme Preloader, Search Icon and Back to top. ','boatseller' ),
            'panel'       => 'general', 
    	) 
    );
$wp_customize->add_setting('boatseller_preloader', array(
     'sanitize_callback' =>'boatseller_sanitize_checkbox', 
     'default' => '1',
     ));
$wp_customize->add_control( 'boatseller_preloader', array(
				'label'    =>   __('Turn on the Preloader','boatseller' ),
				'section'  => 'theme_miscellany_section',
				'settings' => 'boatseller_preloader',
				'type'     => 'checkbox',
			) );
$wp_customize->add_setting('boatseller_search_icon', array(
     'sanitize_callback' =>'boatseller_sanitize_checkbox', 
     'default' => '1',
    /*  'transport'   => 'refresh', */
     'transport' => 'postMessage',
     ));
$wp_customize->add_control( 'boatseller_search_icon', array(
				'label'    =>   __('Turn on the Search Icon','boatseller' ),
				'section'  => 'theme_miscellany_section',
				'settings' => 'boatseller_search_icon',
				'type'     => 'checkbox',
			) );
$wp_customize->add_setting('boatseller_back_to_top', array(
     'sanitize_callback' =>'boatseller_sanitize_checkbox', 
     'default' => '1',
     ));
$wp_customize->add_control( 'boatseller_back_to_top', array(
				'label'    =>   __('Turn on the Back to Top Button','boatseller' ),
				'section'  => 'theme_miscellany_section',
				'settings' => 'boatseller_back_to_top',
				'type'     => 'checkbox',
			) );
// end miscellany
/* Sanitize with absint */
function boatseller_sanitize_phone ( $str ) {
        $str = sanitize_text_field( $str );   
        if(empty ($str))
           return "";
        $size = strlen($str);
        $r = '';
        for($i=0; $i < $size; $i++)
        {
           $w = substr($str, $i, 1);
           if($w != '.' and $w != '-')
             $w = absint($w);
           $r .= $w;
        }
        Return $r;
    }
    function boatseller_sanitize_html( $str ) {
    $allowed_html = array(
		'a' => array(
			'href' => true,
			'title' => true,
		),
		'abbr' => array(
			'title' => true,
		),
		'acronym' => array(
			'title' => true,
		),
		'b' => array(),
		'blockquote' => array(
			'cite' => true,
		),
		'cite' => array(),
		'code' => array(),
		'del' => array(
			'datetime' => true,
		),
		'em' => array(),
		'i' => array(),
		'q' => array(
			'cite' => true,
		),
		'strike' => array(),
		'strong' => array(),
	);
        wp_kses($str, $allowed_html); 
        return $str ;
    }    
    function boatseller_sanitize_url( $str ) {
        return esc_url( $str );
    } 
    function boatseller_sanitize_text( $str ) {
        return sanitize_text_field( $str );
    }
    function boatseller_sanitize_number( $str ) {
        return sanitize_text_field( $str );
    }  
    function boatseller_sanitize_email( $text ) {
        return sanitize_email( $text );
    } 
    function boatseller_sanitize_checkbox( $input ) {
       return absint($input);
    }
}
//add_action( 'after_setup_theme', 'boatseller_custom_site' );
add_action( 'customize_register', 'boatseller_custom_site', 11 );
if ( ! function_exists( 'boatseller_header_style' ) ) :
/**
 * Styles the header text displayed on the site.
 *
 * Create your own boatseller_header_style() function to override in a child theme.
 *
 * @since boat seller 1.0
 *
 * @see boatseller_custom_header_and_background().
 */
function boatseller_header_style() {
	// If the header text option is untouched, let's bail.
	if ( display_header_text() ) {
		 return;
	}
	// If the header text has been hidden.
	?>
	<style type="text/css" id="boatseller-header-css">
		.site-branding {
			margin: 0 auto 0 0;
		}
		.site-branding .site-title,
		.site-description {
			clip: rect(1px, 1px, 1px, 1px);
			position: absolute;
		}
	</style>
	<?php
}
endif; // boatseller_header_style
/**
 * Adds postMessage support for site title and description for the Customizer.
 *
 * @since boat seller 1.0
 *
 * @param WP_Customize_Manager $wp_customize The Customizer object.
 */
function boatseller_customize_register( $wp_customize ) {
	$color_scheme = boatseller_get_color_scheme();
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial( 'blogname', array(
			'selector' => '.site-title a',
			'container_inclusive' => false,
			'render_callback' => 'boatseller_customize_partial_blogname',
		) );
		$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
			'selector' => '.site-description',
			'container_inclusive' => false,
			'render_callback' => 'boatseller_customize_partial_blogdescription',
		) );
	}
	// Add color scheme setting and control.
	$wp_customize->add_setting( 'color_scheme', array(
		'default'           => 'default',
		'sanitize_callback' => 'boatseller_sanitize_color_scheme',
		'transport'         => 'postMessage',
	) );
	$wp_customize->add_control( 'color_scheme', array(
		'label'    =>   __('Base Color Scheme', 'boatseller' ),
		'section'  => 'colors',
		'type'     => 'select',
		'choices'  => boatseller_get_color_scheme_choices(),
		'priority' => 1,
	) );
	// Add page background color setting and control.
	$wp_customize->add_setting( 'page_background_color', array(
		'default'           => $color_scheme[1],
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'postMessage',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'page_background_color', array(
		'label'       =>   __('Page Background Color', 'boatseller' ),
		'section'     => 'colors',
	) ) );
	// Remove the core header textcolor control, as it shares the main text color.
	$wp_customize->remove_control( 'header_textcolor' );
	// Add link color setting and control.
	$wp_customize->add_setting( 'link_color', array(
		'default'           => $color_scheme[2],
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'postMessage',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'link_color', array(
		'label'       =>   __('Link Color', 'boatseller' ),
		'section'     => 'colors',
	) ) );
	// Add main text color setting and control.
	$wp_customize->add_setting( 'main_text_color', array(
		'default'           => $color_scheme[3],
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'postMessage',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'main_text_color', array(
		'label'       =>   __('Main Text Color', 'boatseller' ),
		'section'     => 'colors',
	) ) );
	// Add secondary text color setting and control.
	$wp_customize->add_setting( 'secondary_text_color', array(
		'default'           => $color_scheme[4],
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'postMessage',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'secondary_text_color', array(
		'label'       =>   __('Secondary Text Color', 'boatseller' ),
		'section'     => 'colors',
	) ) );
}
add_action( 'customize_register', 'boatseller_customize_register', 11 );
/**
 * Render the site title for the selective refresh partial.
 *
 * @since boat seller 1.2
 * @see boatseller_customize_register()
 *
 * @return void
 */
function boatseller_customize_partial_blogname() {
	bloginfo( 'name' );
}
/**
 * Render the site tagline for the selective refresh partial.
 *
 * @since boat seller 1.2
 * @see boatseller_customize_register()
 *
 * @return void
 */
function boatseller_customize_partial_blogdescription() {
	bloginfo( 'description' );
}
/**
 * Registers color schemes for boat seller.
 *
 * Can be filtered with {@see 'boatseller_color_schemes'}.
 *
 * The order of colors in a colors array:
 * 1. Main Background Color.
 * 2. Page Background Color.
 * 3. Link Color.
 * 4. Main Text Color.
 * 5. Secondary Text Color.
 * 6. Footer Color
 *
 * @since boat seller 1.0
 *
 * @return array An associative array of color scheme options.
 */
function boatseller_get_color_schemes() {
	/**
	 * Filter the color schemes registered for use with boat seller.
	 *
	 * The default schemes include 'default', 'dark', 'gray', 'red', and 'yellow'.
	 *
	 * @since boat seller 1.0
	 *
	 * @param array $schemes {
	 *     Associative array of color schemes data.
	 *
	 *     @type array $slug {
	 *         Associative array of information for setting up the color scheme.
	 *
	 *         @type string $label  Color scheme label.
	 *         @type array  $colors HEX codes for default colors prepended with a hash symbol ('#').
	 *                              Colors are defined in the following order: Main background, page
	 *                              background, link, main text, secondary text.
	 *     }
	 * }
	 */
	return apply_filters( 'boatseller_color_schemes', array(
		'default' => array(
			'label'  =>   __('Default', 'boatseller' ),
			'colors' => array(
				'#1a1a1a',
				'#ffffff',
				'#007acc',
				'#1a1a1a',
				'#686868',
                '#F1F0F0',
			),
		),
		'dark' => array(
			'label'  =>   __('Dark', 'boatseller' ),
			'colors' => array(
				'#262626',
				'#1a1a1a',
				'#9adffd',
				'#e5e5e5',
				'#c1c1c1',
                '#616a73',
			),
		),
		'gray' => array(
			'label'  =>   __('Gray', 'boatseller' ),
			'colors' => array(
				'#616a73',
				'#4d545c',
				'#c7c7c7',
				'#f2f2f2',
				'#f2f2f2',
                '#F1F0F0',
			),
		),
		'red' => array(
			'label'  =>   __('Orange', 'boatseller' ),
			'colors' => array(
				'#E65E23',
				'#ffffff',
				'#640c1f',
				'#402b30',
				'#402b30',
                '#F1F0F0',
			),
		),
		'yellow' => array(
			'label'  =>   __('Blue', 'boatseller' ),
			'colors' => array(
				'#005681',
				'#ffffff',
				'#774e24',
				'#3b3721',
				'#5b4d3e',
                '#F1F0F0',
			),
		),
	) );
}
if ( ! function_exists( 'boatseller_get_color_scheme' ) ) :
/**
 * Retrieves the current boat seller color scheme.
 *
 * Create your own boatseller_get_color_scheme() function to override in a child theme.
 *
 * @since boat seller 1.0
 *
 * @return array An associative array of either the current or default color scheme HEX values.
 */
function boatseller_get_color_scheme() {
	$color_scheme_option = esc_html(get_theme_mod( 'color_scheme', 'default' ));
	$color_schemes       = boatseller_get_color_schemes();
	if ( array_key_exists( $color_scheme_option, $color_schemes ) ) {
		return $color_schemes[ $color_scheme_option ]['colors'];
	}
	return $color_schemes['default']['colors'];
}
endif; // boatseller_get_color_scheme
if ( ! function_exists( 'boatseller_get_color_scheme_choices' ) ) :
/**
 * Retrieves an array of color scheme choices registered for boat seller.
 *
 * Create your own boatseller_get_color_scheme_choices() function to override
 * in a child theme.
 *
 * @since boat seller 1.0
 *
 * @return array Array of color schemes.
 */
function boatseller_get_color_scheme_choices() {
	$color_schemes                = boatseller_get_color_schemes();
	$color_scheme_control_options = array();
	foreach ( $color_schemes as $color_scheme => $value ) {
		$color_scheme_control_options[ $color_scheme ] = $value['label'];
	}
	return $color_scheme_control_options;
}
endif; // boatseller_get_color_scheme_choices
if ( ! function_exists( 'boatseller_sanitize_color_scheme' ) ) :
/**
 * Handles sanitization for boat seller color schemes.
 *
 * Create your own boatseller_sanitize_color_scheme() function to override
 * in a child theme.
 *
 * @since boat seller 1.0
 *
 * @param string $value Color scheme name value.
 * @return string Color scheme name.
 */
function boatseller_sanitize_color_scheme( $value ) {
	$color_schemes = boatseller_get_color_scheme_choices();
	if ( ! array_key_exists( $value, $color_schemes ) ) {
		return 'default';
	}
	return $value;
}
endif; // boatseller_sanitize_color_scheme
/**
 * Enqueues front-end CSS for color scheme.
 *
 * @since boat seller 1.0
 *
 * @see wp_add_inline_style()
 */
function boatseller_color_scheme_css() {
	$color_scheme_option = get_theme_mod( 'color_scheme', 'default' );
	// Don't do anything if the default color scheme is selected.
	if ( 'default' === $color_scheme_option ) {
		return;
	}
	$color_scheme = boatseller_get_color_scheme();
	// Convert main text hex color to rgba.
	$color_textcolor_rgb = boatseller_hex2rgb( $color_scheme[3] );
	// If the rgba values are empty return early.
	if ( empty( $color_textcolor_rgb ) ) {
		return;
	}
	// If we get this far, we have a custom color scheme.
	$colors = array(
		'background_color'      => $color_scheme[0],
		'page_background_color' => $color_scheme[1],
		'link_color'            => $color_scheme[2],
		'main_text_color'       => $color_scheme[3],
		'secondary_text_color'  => $color_scheme[4],
		'footer_color'          => $color_scheme[5],
    	'border_color'          => vsprintf( 'rgba( %1$s, %2$s, %3$s, 0.2)', $color_textcolor_rgb ),
	);
	$color_scheme_css = boatseller_get_color_scheme_css( $colors );
	wp_add_inline_style( 'boatseller-style', $color_scheme_css );
}
add_action( 'wp_enqueue_scripts', 'boatseller_color_scheme_css' );
/**
 * Binds the JS listener to make Customizer color_scheme control.
 *
 * Passes color scheme data as colorScheme global.
 *
 * @since boat seller 1.0
 */
function boatseller_customize_color_control_js() {
	wp_enqueue_script( 'color-scheme-control', get_template_directory_uri() . '/js/color-scheme-control.js', array( 'customize-controls', 'iris', 'underscore', 'wp-util' ), '20160816', true );
	wp_localize_script( 'color-scheme-control', 'colorScheme', boatseller_get_color_schemes() );
}
add_action( 'customize_controls_enqueue_scripts', 'boatseller_customize_color_control_js' );
/**
 * Binds JS handlers to make the Customizer preview reload changes asynchronously.
 *
 * @since boat seller 1.0
 */
function boatseller_customize_preview_js() {
	wp_enqueue_script( 'boatseller-customize-preview', get_template_directory_uri() . '/js/customize-preview.js', array( 'customize-preview' ), '20160816', true );
}
add_action( 'customize_preview_init', 'boatseller_customize_preview_js' );
/**
 * Returns CSS for the color schemes.
 *
 * @since boat seller 1.0
 *
 * @param array $colors Color scheme colors.
 * @return string Color scheme CSS.
 */
function boatseller_get_color_scheme_css( $colors ) {
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
		border-color: {$colors['border_color']};
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
/**
 * Outputs an Underscore template for generating CSS for the color scheme.
 *
 * The template generates the css dynamically for instant display in the
 * Customizer preview.
 *
 * @since boat seller 1.0
 */
function boatseller_color_scheme_css_template() {
	$colors = array(
		'background_color'      => '{{ data.background_color }}',
		'page_background_color' => '{{ data.page_background_color }}',
		'link_color'            => '{{ data.link_color }}',
		'main_text_color'       => '{{ data.main_text_color }}',
		'secondary_text_color'  => '{{ data.secondary_text_color }}',
		'border_color'          => '{{ data.border_color }}',
	);
	?>
	<script type="text/html" id="tmpl-boatseller-color-scheme">
		<?php echo boatseller_get_color_scheme_css( $colors ); ?>
	</script>
	<?php
}
add_action( 'customize_controls_print_footer_scripts', 'boatseller_color_scheme_css_template' );
/**
 * Enqueues front-end CSS for the page background color.
 *
 * @since boat seller 1.0
 *
 * @see wp_add_inline_style()
 */
function boatseller_page_background_color_css() {
	$color_scheme          = boatseller_get_color_scheme();
	$default_color         = $color_scheme[1];
	$page_background_color = get_theme_mod( 'page_background_color', $default_color );
	// Don't do anything if the current color is the default.
	if ( $page_background_color === $default_color ) {
		return;
	}
	$css = '
		/* Custom Page Background Color */
		.site {
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
		.page-links a:focus {
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
	wp_add_inline_style( 'boatseller-style', sprintf( $css, $page_background_color ) );
}
add_action( 'wp_enqueue_scripts', 'boatseller_page_background_color_css', 11 );
/**
 * Enqueues front-end CSS for the link color.
 *
 * @since boat seller 1.0
 *
 * @see wp_add_inline_style()
 */
function boatseller_link_color_css() {
	$color_scheme    = boatseller_get_color_scheme();
	$default_color   = $color_scheme[2];
	$link_color = sanitize_hex_color(get_theme_mod( 'link_color', $default_color ));
	// Don't do anything if the current color is the default.
	if ( $link_color === $default_color ) {
		return;
	}
	$css = '
		/* Custom Link Color */
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
			color: %1$s;
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
			background-color: %1$s;
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
			border-color: %1$s;
		}
		@media screen and (min-width: 56.875em) {
			.main-navigation li:hover > a,
			.main-navigation li.focus > a {
				color: %1$s;
			}
		}
	';
	wp_add_inline_style( 'boatseller-style', sprintf( $css, $link_color ) );
}
add_action( 'wp_enqueue_scripts', 'boatseller_link_color_css', 11 );
/**
 * Enqueues front-end CSS for the main text color.
 *
 * @since boat seller 1.0
 *
 * @see wp_add_inline_style()
 */
function boatseller_main_text_color_css() {
	$color_scheme    = boatseller_get_color_scheme();
	$default_color   = $color_scheme[3];
   // $main_text_color = get_theme_mod(get_theme_mod( 'main_text_color', $default_color ));
    $main_text_color = sanitize_hex_color(get_theme_mod( 'main_text_color', $default_color ));
	// Don't do anything if the current color is the default.
	if ( $main_text_color === $default_color ) {
		return;
	}
	// Convert main text hex color to rgba.
	$main_text_color_rgb = boatseller_hex2rgb( $main_text_color );
	// If the rgba values are empty return early.
	if ( empty( $main_text_color_rgb ) ) {
		return;
	}
	// If we get this far, we have a custom color scheme.
	$border_color = vsprintf( 'rgba( %1$s, %2$s, %3$s, 0.2)', $main_text_color_rgb );
	$css = '
		/* Custom Main Text Color */
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
			color: %1$s
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
			border-color: %1$s;
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
			background-color: %1$s;
		}
		/* Border Color */
		fieldset,
		pre,
		abbr,
		acronym,
		table,
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
			border-color: %1$s; /* Fallback for IE7 and IE8 */
			border-color: %2$s;
		}
		hr,
		code {
			background-color: %1$s; /* Fallback for IE7 and IE8 */
			background-color: %2$s;
		}
		@media screen and (min-width: 56.875em) {
			.main-navigation ul ul,
			.main-navigation ul ul li {
				border-color: %2$s;
			}
			.main-navigation ul ul:before {
				border-top-color: %2$s;
				border-bottom-color: %2$s;
			}
		}
	';
	wp_add_inline_style( 'boatseller-style', sprintf( $css, $main_text_color, $border_color ) );
}
add_action( 'wp_enqueue_scripts', 'boatseller_main_text_color_css', 11 );
/**
 * Enqueues front-end CSS for the secondary text color.
 *
 * @since boat seller 1.0
 *
 * @see wp_add_inline_style()
 */
function boatseller_secondary_text_color_css() {
	$color_scheme    = boatseller_get_color_scheme();
	$default_color   = $color_scheme[4];
	$secondary_text_color = sanitize_hex_color(get_theme_mod( 'secondary_text_color', $default_color ));
	// Don't do anything if the current color is the default.
	if ( $secondary_text_color === $default_color ) {
		return;
	}
	$css = '
		/* Custom Secondary Text Color */
		/**
		 * IE8 and earlier will drop any block with CSS3 selectors.
		 * Do not combine these styles with the next block.
		 */
		body:not(.search-results) .entry-summary {
			color: %1$s;
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
			color: %1$s;
		}
		.widget_calendar tbody a:hover,
		.widget_calendar tbody a:focus {
			background-color: %1$s;
		}
	';
	wp_add_inline_style( 'boatseller-style', sprintf( $css, $secondary_text_color ) );
}
add_action( 'wp_enqueue_scripts', 'boatseller_secondary_text_color_css', 11 );
add_action( 'wp_head' , 'boatseller_dynamic_css' );
function boatseller_dynamic_css() { ?>
 <style type='text/css'>
 <?php
    $boatseller_header_background_color = sanitize_hex_color(get_theme_mod('boatseller_header_background_color','#444444'));     
   $boatseller_header_border_color = sanitize_hex_color(get_theme_mod('boatseller_header_border_color','#d1d1d1'));     
   $boatseller_header_border = esc_html(get_theme_mod('boatseller_header_border','no'));     
   $boatseller_header_text_color = sanitize_hex_color(get_theme_mod('boatseller_header_text_color','#ffffff'));     
   $boatseller_header_cart_color = sanitize_hex_color(get_theme_mod('boatseller_header_cart_color','#ffffff'));     
   $boatseller_header_opacity = esc_html(get_theme_mod('boatseller_header_opacity','8'))/10;     
   // Bill 2018
    if (! is_customize_preview())
    {
        echo '.site-header {';
        echo 'background: '.$boatseller_header_background_color.';';
        echo 'opacity: '.$boatseller_header_opacity . '!important;';
        echo 'color: '.$boatseller_header_text_color. '!important;';
        echo '}';
    }
    echo '.site-header-main, .site-description, .site-title-text a {';
    echo 'background: '.$boatseller_header_background_color. '!important;';
    echo 'color: '.$boatseller_header_text_color. '!important;';
    echo 'opacity: '.$boatseller_header_opacity . '!important;';
    echo '}';
           echo '.site-header-main {';
           echo 'border-bottom: 1px solid '.$boatseller_header_border_color. '!important;';
           echo '}';
    ?>
    .entry-title
     { 
     <?php
     $boatseller_entry_title = esc_html(get_theme_mod('boatseller_entry_title',1)); 
     if($boatseller_entry_title == 1)
      {
        echo 'display:block;';
      } 
      else
      {
        echo 'display:none;';     
      }
      ?>    
    }
<?php 
 $boatseller_icon_color = trim(sanitize_hex_color(get_theme_mod('boatseller_topinfo_color','#808080')));
 $boatseller_topinfo_color = sanitize_hex_color($boatseller_icon_color);
 $boatseller_topinfo_email = trim(esc_html(get_theme_mod('boatseller_topinfo_email','')));
 $boatseller_topinfo_phone = trim(esc_html(get_theme_mod('boatseller_topinfo_phone','')));
 $boatseller_topinfo_hours = trim(esc_html(get_theme_mod('boatseller_topinfo_hours','')));
 $mycopyrightbackground = sanitize_hex_color(get_theme_mod('boatseller_copyright_background','#ffffff'));
 $mycopyrightcolor = sanitize_hex_color(get_theme_mod('boatseller_copyright_color','#7a7a7a'));
 $footerbkcolor = sanitize_hex_color(get_theme_mod('boatseller_footer_background','#ffffff'));
 $boatseller_logo_margin_top = esc_html(get_theme_mod('boatseller_logo_margin_top',0)); 
 $boatseller_opacity = esc_html(get_theme_mod('boatseller_opacity', 10)/10);
  $boatseller_layout_type = esc_html(get_theme_mod('boatseller_layout_type',2)); 
  $boatseller_show_top_header = esc_html(get_theme_mod('boatseller_show_top_header','1'));
    if($boatseller_layout_type == 1) { ?>
        #wrapper
        	{ 
            	 max-width:1000px !important;
                 opacity: <?php echo $boatseller_opacity;?> !important; 
             }
        .site-header {
               width: 1000px !important;
        }    
    <?php }
    elseif ($boatseller_layout_type == 2)  { ?>
         #wrapper
        	{ 
            	 max-width:100% !important;
                 opacity: <?php echo $boatseller_opacity;?> !important;
             }
         .site-header {
               width: 100% !important;
        }  
    <?php } 
    else { ?>
         #wrapper
        	{ 
       	         max-width:1200px !important;
                 opacity: <?php echo $boatseller_opacity;?> !important;
             }
          .site-header {
               width: 1200px !important;
         }  
    <?php } 
if( $boatseller_show_top_header != '1')
  { ?>
    #top_header 
       {
        /*   visibility: hidden !important; */
         display: none !important; 
       }
  <?php  
  }     
if( empty($boatseller_topinfo_email) and empty($boatseller_topinfo_phone) and empty($boatseller_topinfo_hours))
  { ?>
    #header_top_left 
       {
        /* //// display: none; */ 
       }
    #header_top_right 
       {
        margin-top: -0px; 
       }
  <?php  
  }
  if ( empty($boatseller_topinfo_email))
  { ?>
         #boatseller_iconemail
         {
           display: none !important; 
         }
  <?php }
  if ( empty($boatseller_topinfo_phone))
  { ?>
         #boatseller_iconphone
         {
           display: none !important; 
         }
  <?php }
  if ( empty($boatseller_topinfo_hours))
  { ?>
         #boatseller_iconhours
         {
           display: none !important; 
         }
  <?php }
?>
 .site-branding{
    margin-top: <?php echo $boatseller_logo_margin_top;?>px !important;
 }
.social-navigation a {
	color: <?php $boatseller_icon_color; ?>!important;
}
   #header_top_left, #boatseller_topinfo_text a 
   {
    color: <?php echo $boatseller_topinfo_color; ?> !important;   
   }
    .site-info,
    .site-info a {
        color: <?php echo $mycopyrightcolor;?> !important;
        background: <?php echo $mycopyrightbackground;?> !important;
    }
    .site-info a {
        color: <?php echo $mycopyrightcolor;?> !important;
        background: <?php $mycopyrightbackground;?> !important;
    }  
    .site-footer {
      background: <?php echo $footerbkcolor;?> !important;
    } 
    <?php 
    if($footerbkcolor == 'darkgray') // or $footerbkcolor == 'gray')
            {  
               echo '.site-footer {';
              /*  echo 'color: #E9E9E9;'; */
               echo '}';
               echo '.site-footer a {';
               echo 'color: white; '; // lightgray;'
               echo '}';
               echo '.site-footer a:hover {';
               echo 'color: white;';
               echo 'text-decoration: underline;'; 
               echo '}';           
            }
    ?>
    } 
	.main-navigation {
           <?php $mymenufontsize = esc_html(get_theme_mod('menu_font_size', '14')); ?> 
            font-size: <?php echo $mymenufontsize;?>px !important;
         <?php $boatseller_menu_margin_top = esc_html(get_theme_mod('boatseller_menu_margin_top', '30')); ?> 
        margin-top: <?php echo $boatseller_menu_margin_top;?>px !important;
	}
    .site-header-menu
    {
        <?php $boatseller_menu_margin_right = esc_html(get_theme_mod('boatseller_menu_margin_right', '0')); ?> 
        margin-right: <?php echo esc_html($boatseller_menu_margin_right);?>px !important;
	}       
    }
    .menu-toggle{
        margin-top: <?php echo $boatseller_menu_margin_top;?>px !important;
        display
    }
    .site-header-menu
    {
        <?php  
        // Bill Aqui ...
        $mymenubackground = sanitize_hex_color(get_theme_mod('boatseller_navigation_background', '#444444'));?> 
          background: <?php echo $mymenubackground;?> !important;
		  font-size: <?php echo $mymenufontsize;?>px !important; 
        <?php $boatseller_menu_margin_top = esc_html(get_theme_mod('boatseller_menu_margin_top', '30')); ?> 
        margin-top: <?php echo $boatseller_menu_margin_top;?>px !important;
    }
     <?php $mymenucolor = sanitize_hex_color(get_theme_mod('boatseller_menu_color', '#ffffff'));?> 
	.main-navigation a, .dropdown-toggle  {
    <?php
           if(! empty ($mymenucolor))
           {
       	       echo 'color:'. $mymenucolor.'!important;';
               echo 'border-bottom-color:'.$mymenucolor.'!important;';
           }
    ?>
    }     
 	.menu-toggle {
    <?php
           if(! empty ($mymenucolor))
           {
       	       echo 'color:'. $mymenucolor.'!important;';
               echo 'border-color:'.$mymenucolor.'!important;';
           }
    ?>   
   } 
    <?php 
    $mymenuhovercolor = sanitize_hex_color(get_theme_mod('boatseller_menu_hover_color','#FFFF00'));
    $mysubmenucolor = sanitize_hex_color(get_theme_mod('boatseller_submenu_color', '#ffffff'));
    ?> 
	.main-navigation a:hover, .menu-toggle a:hover {
    <?php
           if(! empty ($mymenucolor))
           {
       	       echo 'color:'. $mymenuhovercolor.'!important;';
           }
    ?>
   }  
    .main-navigation li:hover > a,
	.main-navigation li.focus > a {
        border-bottom:  0px solid <?php echo $mymenuhovercolor;?> !important; 
	}
    <?php 
    $mysubmenubackground = sanitize_hex_color(get_theme_mod('boatseller_submenu_background', '#e65e23')); 
    ?> 
    .main-navigation ul ul a 
     {
          <?php
	           if(! empty ($mysubmenubackground))
       	         echo 'background:'. $mysubmenubackground.'!important;';
               if(! empty ($mymenucolor))
               {
           	       echo 'color:'. $mysubmenucolor.'!important;';
                   echo 'border-bottom-color:'.$mysubmenucolor.'!important;';
               }
            ?> 
}
     <?php 
     $mysubmenuhovercolor = sanitize_hex_color(get_theme_mod('boatseller_submenu_hover_color','#000000'));     
     $mysubmenuhoverbackground = sanitize_hex_color(get_theme_mod('boatseller_submenu_hover_background', '#d1d1d1'));
     ?>
	.main-navigation ul ul a:hover,
	.main-navigation ul ul li.focus > a {
          <?php
	           if(! empty ($mysubmenuhoverbackground))
       	         echo 'background:'. $mysubmenuhoverbackground.'!important;';
          	   if(! empty ($mysubmenuhovercolor))
       	         echo 'color:'. $mysubmenuhovercolor.'!important;';       
            ?> 
} 
	.main-navigation ul ul li.focus > a:hover {
          <?php
	           if(! empty ($mysubmenuhoverbackground))
       	         echo 'background:'. $mysubmenuhoverbackground.'!important;';
          	   if(! empty ($mysubmenuhovercolor))
       	         echo 'color:'. $mysubmenuhovercolor.'!important;';       
            ?> 
}   
<?php
    $boatseller_social_menu = sanitize_hex_color(get_theme_mod('boatseller_social_menu','#ffffff'));     
    if($boatseller_social_menu == 'darkgray') 
            {  
               echo '.social-navigation li a';
               echo '{';
               echo 'background-color: #3D3D3D !important;'; // lightgray;'
               echo 'color: white;';
               echo '}';
            }
     if($boatseller_social_menu == 'lightgray') 
            {  
               echo '.social-navigation li a';
               echo '{';
               echo 'background-color: gray !important; '; // lightgray;
               echo 'color: white;';
               echo '}';
            }
    if($boatseller_social_menu == 'white') 
            {  
               echo '.social-navigation li a';
               echo '{';
               echo 'background-color: white !important; '; // lightgray;'
               echo 'color: darkgray;';
               echo '}';
            }           
    echo '.boatseller_my_shopping_cart a {';
    echo 'color: '.$boatseller_header_cart_color. '!important;';
    echo '}';   
   $boatseller_show_sidebar_singlepage = esc_html(get_theme_mod('boatseller_show_sidebar_singlepage','1'));     
   echo '.content-area  {';
   if($boatseller_show_sidebar_singlepage != '1' and is_home() )
   {
       echo 'margin-right: 0;';
       echo 'width: 100%;';
   } 
    echo '}';
   echo '.sidebar  {';
   if($boatseller_show_sidebar_singlepage != '1' and is_home())
   {
       echo 'display: none;';
   } 
    echo '}';
$boatseller_blog_post_meta = trim(get_theme_mod('boatseller_blog_post_meta','1'));
$boatseller_blog_post_meta = esc_html($boatseller_blog_post_meta);
$boatseller_blog_post_categories = trim(get_theme_mod('boatseller_blog_post_categories','1'));
$boatseller_blog_post_categories = esc_html($boatseller_blog_post_categories);
$boatseller_blog_post_date = trim(get_theme_mod('boatseller_blog_post_date','1'));
$boatseller_blog_post_date = esc_html($boatseller_blog_post_date);
$boatseller_blog_post_author = trim(get_theme_mod('boatseller_blog_post_author','1'));
$boatseller_blog_post_author = esc_html($boatseller_blog_post_author);
if($boatseller_blog_post_meta != '1')
{
       echo '.entry-content {
             width: 100% !important;
             }';
       echo '.entry-footer {
             display:none !important;
             }';
}
// author
if($boatseller_blog_post_categories != '1')
{
       echo '.cat-links {
             display:none !important;
             }';
}
if($boatseller_blog_post_date != '1')
{
       echo '.posted-on {
             display:none !important;
             }';
}
if($boatseller_blog_post_author <> '1')
{
        echo '.author {
             display: none;
             }';   
}
?>    
</style>
<?php /* end style */
}?>