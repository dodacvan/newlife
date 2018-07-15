<?php
/*
Author: MagniGenie
Author URI: http://magnigenie.com
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/


// add required js/css files
add_action( 'wp_enqueue_scripts', 'icraft_enqueue_scripts' );

function icraft_enqueue_scripts() {
	wp_enqueue_style( 'responsive-menu', get_template_directory_uri() . '/inc/responsive-menu/css/wprmenu.css', array(), '1.01' );
	
	wp_enqueue_script('jquery.transit', get_template_directory_uri() . '/inc/responsive-menu/js/jquery.transit.min.js', array( 'jquery' ), '2017-03-16', true );
	
	//wp_enqueue_script('sidr', get_template_directory_uri() . '/inc/responsive-menu/js/waypoints.min.js', array( 'jquery' ), '2014-01-13', true );	
	wp_enqueue_script('sidr', get_template_directory_uri() . '/inc/responsive-menu/js/jquery.sidr.js', array( 'jquery' ), '2017-03-16', true );
	wp_enqueue_script('wprmenu.js', get_template_directory_uri() . '/inc/responsive-menu/js/wprmenu.js', array( 'jquery' ), '2017-03-16', true );	
	
	$wpr_options = array( 'zooming' => get_theme_mod('zooming', 'yes'),'from_width' => get_theme_mod('from_width', 1069),'swipe' => get_theme_mod('swipe', 'yes'));
	wp_localize_script( 'wprmenu.js', 'wprmenu', $wpr_options );
}

function tx_search_form() {
	
	$normal_search = 0;
	$normal_search = get_theme_mod('normal_search', 0);	
	$search_form = "";
	
	$search_form .= '<form role="search" method="get" class="wpr-search-form" action="' . site_url() . '">';
	$search_form .= '<label><input type="search" class="wpr-search-field" placeholder="' . get_theme_mod('search_box_text', __(' Search...', 'i-craft')) . '" value="" name="s" title="Search for:"></label>';

    if( $normal_search == 0 ) { 
    	$search_form .= '<input type="hidden" value="product" name="post_type" id="post_type" />';
    }
    
	$search_form .= '';
	$search_form .= '</form>';			
	return $search_form;
}

function icraft_add_cart() 
{
	global $woocommerce;
	$hide_cart = get_theme_mod('hide_cart', 0);
	$itemlink = '';
						
	if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) && empty($hide_cart) ) {
			$itemlink .= '<li class="wprmenu-cart"><a href="'.wc_get_cart_url().'" >';
			$itemlink .= '<span class="cart-lebel">'. __('Cart','i-craft').'</span>';
			$itemlink .= '<span class="genericon genericon-cart"></span>';
			$itemlink .= '<span class="cart-counts">'. sprintf(WC()->cart->cart_contents_count).'</span>';
			$itemlink .= '</a></li>';

			
	}
	return $itemlink;		
}

add_action('wp_footer', 'icraft_menu', 100);
function icraft_menu() {
	if( get_theme_mod('enabled', 1) ) :
		?>
		<div id="wprmenu_bar" class="wprmenu_bar">
        	<div class="wprmenu-inner">
                <div class="wprmenu_icon">
                    <span class="wprmenu_ic_1"></span>
                    <span class="wprmenu_ic_2"></span>
                    <span class="wprmenu_ic_3"></span>
                </div>
                <div class="menu_title">
                    <?php echo esc_attr(get_theme_mod('bar_title', __('MENU', 'i-craft'))); ?>
                </div>
            </div>    
		</div>

		<div id="wprmenu_menu" class="wprmenu_levels <?php echo esc_attr(get_theme_mod('position', 'left')); ?> wprmenu_custom_icons">
			<?php if( get_theme_mod('search_box', 'below_menu') == 'above_menu' ) { ?> 
			<div class="wpr_search">
				<?php echo tx_search_form(); ?>
			</div>
			<?php } ?>
			<ul id="wprmenu_menu_ul">
				<?php
					wp_nav_menu( array('theme_location'=>'primary','container'=>false,'items_wrap'=>'%3$s'));
					echo icraft_add_cart();
				?>
			</ul>
			<?php if( get_theme_mod('search_box', 'below_menu') == 'below_menu' ) { ?> 
			<div class="wpr_search">
				<?php echo tx_search_form(); ?>
			</div>
			<?php } ?>
		</div>
		<?php
	endif;
}


function icraft_header_styles() {
	if( get_theme_mod('enabled', 1) ) :
		?>
		<style id="wprmenu_css" type="text/css" >
			/* apply appearance settings */
			.menu-toggle {
				display: none!important;
			}
			@media (max-width: 1069px) {
				.menu-toggle,
				#navbar  {
					display: none!important;
				}				
			}
			#wprmenu_bar {
				background: <?php echo esc_attr(get_theme_mod("bar_bgd", "#2e2e2e")); ?>;
			}
			#wprmenu_bar .menu_title, #wprmenu_bar .wprmenu_icon_menu {
				color: <?php echo esc_attr(get_theme_mod("bar_color", "#F2F2F2"));?>;
			}
			#wprmenu_menu {
				background: <?php echo esc_attr(get_theme_mod("menu_bgd", "#2E2E2E")) ?>!important;
			}
			#wprmenu_menu.wprmenu_levels ul li {
				border-bottom:1px solid <?php echo esc_attr(get_theme_mod("menu_border_bottom", "#131212")); ?>;
				border-top:1px solid <?php echo esc_attr(get_theme_mod("menu_border_top", "#0D0D0D")); ?>;
			}
			#wprmenu_menu ul li a {
				color: <?php echo esc_attr(get_theme_mod("menu_color", "#CFCFCF")); ?>;
			}
			#wprmenu_menu ul li a:hover {
				color: <?php echo esc_attr(get_theme_mod("menu_color_hover", "#606060")); ?>;
			}
			#wprmenu_menu.wprmenu_levels a.wprmenu_parent_item {
				border-left:1px solid <?php echo esc_attr(get_theme_mod("menu_border_top", "#0D0D0D")); ?>;
			}
			#wprmenu_menu .wprmenu_icon_par {
				color: <?php echo esc_attr(get_theme_mod("menu_color", "#CFCFCF")); ?>;
			}
			#wprmenu_menu .wprmenu_icon_par:hover {
				color: <?php echo esc_attr(get_theme_mod("menu_color_hover", "#606060")); ?>;
			}
			#wprmenu_menu.wprmenu_levels ul li ul {
				border-top:1px solid <?php echo esc_attr(get_theme_mod("menu_border_bottom", "#131212")); ?>;
			}
			#wprmenu_bar .wprmenu_icon span {
				background: <?php echo esc_attr(get_theme_mod("menu_icon_color", "#FFFFFF")); ?>;
			}
			<?php
			//when option "hide bottom borders is on...
			if(get_theme_mod("menu_border_bottom_show", "yes") === 'no') { ?>
				#wprmenu_menu, #wprmenu_menu ul, #wprmenu_menu li {
					border-bottom:none!important;
				}
				#wprmenu_menu.wprmenu_levels > ul {
					border-bottom:1px solid <?php echo esc_attr(get_theme_mod("menu_border_top", "#0D0D0D")); ?>!important;
				}
				.wprmenu_no_border_bottom {
					border-bottom:none!important;
				}
				#wprmenu_menu.wprmenu_levels ul li ul {
					border-top:none!important;
				}
			<?php } ?>

			#wprmenu_menu.left {
				width:<?php echo esc_attr(get_theme_mod("how_wide", "80")); ?>%;
				left: -<?php echo esc_attr(get_theme_mod("how_wide", "80")); ?>%;
			    right: auto;
			}
			#wprmenu_menu.right {
				width:<?php echo esc_attr(get_theme_mod("how_wide", "80")); ?>%;
			    right: -<?php echo esc_attr(get_theme_mod("how_wide", "80")); ?>%;
			    left: auto;
			}


			<?php if( get_theme_mod("nesting_icon") ) : ?>
				#wprmenu_menu .wprmenu_icon:before {
					font-family: 'fontawesome'!important;
				}
			<?php endif; ?>

			<?php if(get_theme_mod("menu_symbol_pos", "left") == 'right') : ?>
				#wprmenu_bar .wprmenu_icon {
					float: <?php echo esc_attr(get_theme_mod("menu_symbol_pos", "left")); ?>!important;
					margin-right:0px!important;
				}
				#wprmenu_bar .bar_logo {
					pading-left: 0px;
				}
			<?php endif; ?>
			/* show the bar and hide othere navigation elements */
			@media only screen and (max-width: <?php echo esc_attr(get_theme_mod("from_width", 1069)); ?>px) {
				html { padding-top: 42px!important; }
				#wprmenu_bar { display: block!important; }
				div#wpadminbar { position: fixed; }
				<?php
				if( get_theme_mod('hide') != '' ) {
					echo esc_attr(get_theme_mod('hide'));
					echo ' { display:none!important; }';
				}
				?>
			}
		</style>
		<?php
	endif;
}
add_action('wp_head', 'icraft_header_styles');