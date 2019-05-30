<?php
/**
 * The template for displaying the header
 *
 * Displays all of the head element and everything up until the "site-content" div.
 *
 * @package boatseller
 * @subpackage Boat Seller
 * @since boat seller 1.0
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php endif; ?>
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<div id="wrapper">
<div id="page" class="site">
<!-- Load the slider with "slider1" alias only on the homepage only -->
	<div class="site-inner">
        	<header id="masthead" class="site-header" role="banner">
			<div class="site-header-main">
              <div id="top_header" >
                     <div id="header_top_left" >
                        <?php 
                          $boatseller_icon_color = trim(sanitize_hex_color(get_theme_mod('boatseller_topinfo_color','gray')));
                          $boatseller_topinfo_color = sanitize_hex_color($boatseller_icon_color);
                          $boatseller_topinfo_email = trim(get_theme_mod('boatseller_topinfo_email',''));
                          $boatseller_topinfo_email = esc_html($boatseller_topinfo_email);
                          $boatseller_topinfo_phone = trim(get_theme_mod('boatseller_topinfo_phone',''));
                          $boatseller_topinfo_phone = esc_html($boatseller_topinfo_phone);
                          $boatseller_topinfo_hours = trim(get_theme_mod('boatseller_topinfo_hours',''));
                          $boatseller_topinfo_hours = esc_html($boatseller_topinfo_hours);
if(!empty($boatseller_topinfo_phone) or !empty($boatseller_topinfo_email) or !empty($boatseller_topinfo_hours)    )
{
                   if ( is_customize_preview() ) : ?>
                    <span class="customize-partial-edit-shortcut">
                    <button class="customizer-edit" data-control='{ "name":"boatseller_show_top_header" } '>
                       <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M13.89 3.39l2.71 2.72c.46.46.42 1.24.03 1.64l-8.01 8.02-5.56 1.16 1.16-5.58s7.6-7.63 7.99-8.03c.39-.39 1.22-.39 1.68.07zm-2.73 2.79l-5.59 5.61 1.11 1.11 5.54-5.65zm-2.97 8.23l5.58-5.6-1.07-1.08-5.59 5.6z"></path></svg>
                    </button>
                    </span>
                  <?php endif; 
}
                          if(!empty($boatseller_topinfo_phone))
                          {
                             echo '<span class="genericon genericon-phone" title=""></span>';
                             echo '<div id="boatseller_topinfo_text">'.$boatseller_topinfo_phone.'</div>';
                          }
                          if(!empty($boatseller_topinfo_email))
                          {
                                    echo '<span class="genericon genericon-mail" title=""></span>';
                                    echo '<div id="boatseller_topinfo_text">';
                                    echo '<a href="mailto:';
                                    echo $boatseller_topinfo_email;
                                    echo '">';
                                    echo $boatseller_topinfo_email;
                                    echo '</a>';
                                    echo '</div>';
                          }
                          if(!empty($boatseller_topinfo_hours))
                          {
                                      echo '<span class="genericon genericon-time"></span>';
                                      echo '<div id="boatseller_topinfo_text">'.$boatseller_topinfo_hours.'</div>';
                          }
                          ?>
            </div>   
                 <div id="header_top_right">
            			<?php if ( has_nav_menu( 'social' ) ) : ?>
							<nav id="social-navigation" class="social-navigation" role="navigation" aria-label="<?php esc_attr_e( 'Social Links Menu', 'boatseller' ); ?>">
								<?php
									wp_nav_menu( array(
										'theme_location' => 'social',
										'menu_class'     => 'top-social-links-menu',
										'depth'          => 1,
										'link_before'    => '<span class="screen-reader-text">',
										'link_after'     => '</span>',
									) );
								?>
							</nav><!-- .social-navigation -->
						<?php endif; ?>
                </div>             
           </div>    
             <div class="boatseller_my_shopping_cart"> 
             <?php global $woocommerce;
                if (isset($woocommerce)) {
                    if ( is_customize_preview() ) : ?>
                    <span class="customize-partial-edit-shortcut customize-partial-edit-shortcut-custom_logo">
                     <button class="customizer-edit" data-control='{ "name":"boatseller_header_cart_color" } ''>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M13.89 3.39l2.71 2.72c.46.46.42 1.24.03 1.64l-8.01 8.02-5.56 1.16 1.16-5.58s7.6-7.63 7.99-8.03c.39-.39 1.22-.39 1.68.07zm-2.73 2.79l-5.59 5.61 1.11 1.11 5.54-5.65zm-2.97 8.23l5.58-5.6-1.07-1.08-5.59 5.6z"></path></svg>
                     </button>
                     </span>
                    <?php endif; 
                    // get cart quantity
                    $qty = $woocommerce->cart->get_cart_contents_count();
                    // get cart total
                    $total = $woocommerce->cart->get_cart_total();
                    echo wp_kses_data($total);
                    // get cart url
                    $cart_url = wc_get_cart_url();
                    // http://genericons.com/
                    if ($qty > 0)
                        {
                            echo '<a href="' . esc_url($cart_url). '">';
                            echo '<span class="genericon genericon-cart" id="boatseller_shopicon" title='.esc_attr_e("genericon-cart", "boatseller").'></span>';
                            echo '</a>';
                        }
                    // if multiple products in cart
                    if ($qty > 1)
                        echo '<a href="' . esc_url($cart_url) . '">' . ' ' . esc_html($qty) . ' '. esc_html__( 'products', 'boatseller' ).'  |  ' . wp_kses_data($total) .
                            '</a>';
                    // if single product in cart
                    if ($qty == 1)
                        echo '<a href="' . esc_url($cart_url) . '">'. _e( '1 product', 'boatseller' ). '  |  ' . wp_kses_data($total) . '</a>';
                } ?> 
            </div> <!-- #boatseller_shopping_cart --> 
				<div class="site-branding">
					<?php boatseller_the_custom_logo(); ?>
                    <?php
                    $boatseller_header_text_bill = trim(get_theme_mod('header_text_bill','1'));
                    if ($boatseller_header_text_bill == '1')
                    {
    				    if ( is_front_page() && is_home() ) : ?>
    						<h1 class="site-title-text"><a class="site-title-text" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
    					<?php else : ?>
    						<p class="site-title-text"><a class="site-title-text" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
    					<?php endif;
    					$description = get_bloginfo( 'description', 'display' );
                        if ( $description || is_customize_preview() ) : ?>
    						<p class="site-description"><?php 
                              echo esc_html($description); 
                            ?></p>
                        <?php endif; 
                    }
                    ?>
				</div><!-- .site-branding -->
				<?php if ( has_nav_menu( 'primary' ) || has_nav_menu( 'social' ) ) : ?>
					<button id="menu-toggle" class="menu-toggle"><?php _e( 'Menu', 'boatseller' ); ?></button>
				<?php endif; ?>
                	<div id="site-header-menu" class="site-header-menu">
							<nav id="site-navigation" class="main-navigation" role="navigation" aria-label="<?php esc_attr_e( 'Primary Menu', 'boatseller' ); ?>">
								<?php
									wp_nav_menu( array(
										'theme_location' => 'primary',
                                        'fallback_cb'    => 'boatseller_fallback_menu',
										'menu_class'     => 'primary-menu',
									 ) );
								?>
							</nav><!-- .main-navigation -->
					</div><!-- .site-header-menu -->
                 <div id="boatseller_searchform">       
                  <?php get_search_form( ); ?>
                 </div>
			</div><!-- .site-header-main -->
		</header><!-- .site-header -->
		<div id="content" class="site-content">