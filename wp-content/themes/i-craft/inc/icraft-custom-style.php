<?php
	
	/*
	*
	*	nx Theme Functions
	*	------------------------------------------------
	*	nx Framework v 1.0
	*
	*	nx_custom_styles()
	*	nx_custom_script()
	*
	*/

 	/* CUSTOM CSS OUTPUT
 	================================================== */
 	if (!function_exists('nx_custom_styles')) { 
		function nx_custom_styles() {
			
			global  $icraft_data;
			$custom_css = "";
			$body_font_size = "13";
			$body_line_height = "24";
			$menu_font_size = "13";
			$primary_color = "#95C837";
			$topbar_bg = 1;

			$primary_color = esc_attr(get_theme_mod('primary_color', '#dd3333'));
			$topbar_bg = esc_attr(get_theme_mod('topbar_bg', 1));
			
			
			/* check */
			$tx_body_font = array();
			$tx_title_font = array();
			$tx_body_style = '';
			$tx_title_style = '';
			$tx_body_font['font-family'] = '"Open Sans", Helvetica, sans-serif';
			$tx_body_font['font-size'] = '14px';
			$tx_body_font['line-height']= 1.8;
			$tx_body_font['color'] = '#575757';
			$tx_body_font['variant'] = 400;
			
			$tx_title_font['font-family'] = 'Roboto, Georgia, serif';			

			global $post;	
			$custom_page_color = '';
			$topbar_bg_color = '';	
			
			if ( function_exists( 'rwmb_meta' ) ) {
				$custom_page_color = rwmb_meta('icraft_page_color', '');
				$topbar_bg_color = rwmb_meta('icraft_topbar_bg_color', '');
			}
			
			if( !empty($custom_page_color) )
			{
				$primary_color = $custom_page_color;
			}
			
			$tx_body_font = get_theme_mod( 'body_font', $tx_body_font );
			$tx_title_font = get_theme_mod( 'title_font', $tx_title_font );
			
			if ( isset( $tx_body_font['font-family'] ) ) {
				$tx_body_style .= 'font-family: '.$tx_body_font['font-family'].'; ';
			}
			if ( isset( $tx_body_font['font-size'] ) ) {
				$tx_body_style .= 'font-size: '.$tx_body_font['font-size'].'px; ';
			}
			if ( isset( $tx_body_font['line-height'] ) ) {
				$tx_body_style .= 'line-height: '.$tx_body_font['line-height'].'; ';
			}
			if ( isset( $tx_body_font['color'] ) ) {
				$tx_body_style .= 'color: '.$tx_body_font['color'].';';
			}
			/*
			if ( isset( $tx_body_font['variant'] ) ) {
				$tx_body_style .= 'font-weight: '.$tx_body_font['variant'].';';
			}
			*/
			
			if ( isset( $tx_title_font['font-family'] ) ) {
				$tx_title_style .= 'font-family: '.$tx_title_font['font-family'].'; ';
			}		
			
			/* check ends */
						
						

			echo '<style type="text/css">'. "\n";
			
			if ($topbar_bg == 1)
			{
				echo '.utilitybar {background-color: '.$primary_color.';}';
			}
			
			echo 'body {'.$tx_body_style.'}';
			echo 'h1,h2,h3,h4,h5,h6,.comment-reply-title,.widget .widget-title, .entry-header h1.entry-title {'.$tx_title_style.'}';			
			
			echo '.themecolor {color: '.$primary_color.';}';
			echo '.themebgcolor {background-color: '.$primary_color.';}';
			echo '.themebordercolor {border-color: '.$primary_color.';}';
			
			echo '.tx-slider .owl-pagination .owl-page > span { background: transparent; border-color: '.$primary_color.';  }';
			echo '.tx-slider .owl-pagination .owl-page.active > span { background-color: '.$primary_color.'; }';
			echo '.tx-slider .owl-controls .owl-buttons .owl-next, .tx-slider .owl-controls .owl-buttons .owl-prev { background-color: '.$primary_color.'; }';				
						
			echo 'a,a:visited,.blog-columns .comments-link a:hover {color: '.$primary_color.';}';

			echo 'input:focus,textarea:focus, .woocommerce #content div.product form.cart .button {border: 1px solid '.$primary_color.';}';
			
			echo 'button,input[type="submit"],input[type="button"],input[type="reset"],.nav-container .current_page_item > a > span,.nav-container .current_page_ancestor > a > span,.nav-container .current-menu-item > a span,.nav-container .current-menu-ancestor > a > span,.nav-container li a:hover span {background-color: '.$primary_color.';}';

			echo '.nav-container li:hover > a,.nav-container li a:hover {color: '.$primary_color.';}';

			echo '.nav-container .sub-menu,.nav-container .children,.header-icons.woocart .cartdrop.widget_shopping_cart.nx-animate {border-top: 2px solid '.$primary_color.';}';

			echo '.ibanner,.da-dots span.da-dots-current,.tx-cta a.cta-button,.header-iconwrap .header-icons.woocart > a .cart-counts {background-color: '.$primary_color.';}';

			echo '#ft-post .entry-thumbnail:hover > .comments-link,.tx-folio-img .folio-links .folio-linkico,.tx-folio-img .folio-links .folio-zoomico {background-color: '.$primary_color.';}';

			echo '.entry-header h1.entry-title a:hover,.entry-header > .entry-meta a:hover,.header-icons.woocart .cartdrop.widget_shopping_cart li a:hover {color: '.$primary_color.';}';

			echo '.featured-area div.entry-summary > p > a.moretag:hover {background-color: '.$primary_color.';}';

			echo '.site-content div.entry-thumbnail .stickyonimg,.site-content div.entry-thumbnail .dateonimg,.site-content div.entry-nothumb .stickyonimg,.site-content div.entry-nothumb .dateonimg {background-color: '.$primary_color.';}';

			echo '.entry-meta a,.entry-content a,.comment-content a,.entry-content a:visited {color: '.$primary_color.';}';

			echo '.format-status .entry-content .page-links a,.format-gallery .entry-content .page-links a,.format-chat .entry-content .page-links a,.format-quote .entry-content .page-links a,.page-links a {background: '.$primary_color.';border: 1px solid '.$primary_color.';color: #ffffff;}';

			echo '.format-gallery .entry-content .page-links a:hover,.format-audio .entry-content .page-links a:hover,.format-status .entry-content .page-links a:hover,.format-video .entry-content .page-links a:hover,.format-chat .entry-content .page-links a:hover,.format-quote .entry-content .page-links a:hover,.page-links a:hover {color: '.$primary_color.';}';

			echo '.iheader.front, .nx-preloader .nx-ispload, .site-footer .widget-area .widget .wpcf7 .wpcf7-submit {background-color: '.$primary_color.';}';

			echo '.navigation a,.tx-post-row .tx-folio-title a:hover,.tx-blog .tx-blog-item h3.tx-post-title a:hover {color: '.$primary_color.';}';

			echo '.paging-navigation div.navigation > ul > li a:hover,.paging-navigation div.navigation > ul > li.active > a {color: '.$primary_color.';	border-color: '.$primary_color.';}';

			echo '.comment-author .fn,.comment-author .url,.comment-reply-link,.comment-reply-login,.comment-body .reply a,.widget a:hover {color: '.$primary_color.';}';

			echo '.widget_calendar a:hover, #wprmenu_menu_ul li.wprmenu-cart span.cart-counts {	background-color: '.$primary_color.';	color: #ffffff;	}';

			echo '.widget_calendar td#next a:hover,.widget_calendar td#prev a:hover, .woocommerce #content div.product form.cart .button {	background-color: '.$primary_color.';color: #ffffff;}';

			echo '.site-footer div.widget-area .widget a:hover {color: '.$primary_color.';}';

			echo '.site-main div.widget-area .widget_calendar a:hover,.site-footer div.widget-area .widget_calendar a:hover {	background-color: '.$primary_color.';color: #ffffff;}';
						
			echo '.widget a:visited, .product a:hover { color: #373737;}';

			echo '.widget a:hover,.entry-header h1.entry-title a:hover,.error404 .page-title:before,.tx-service-icon span i {color: '.$primary_color.';}';

			echo '.da-dots > span > span,.tx-slider .tx-slide-button a, .tx-slider .tx-slide-button a:visited {background-color: '.$primary_color.';}';

			echo '.iheader,.format-status,.tx-service:hover .tx-service-icon span {background-color: '.$primary_color.';}';
			
			echo '.tx-cta {border-left: 6px solid '.$primary_color.';}';
			
			echo '.paging-navigation #posts-nav > span:hover, .paging-navigation #posts-nav > a:hover, .paging-navigation #posts-nav > span.current, .paging-navigation #posts-nav > a.current, .paging-navigation div.navigation > ul > li a:hover, .paging-navigation div.navigation > ul > li > span.current, .paging-navigation div.navigation > ul > li.active > a {border: 1px solid '.$primary_color.';color: '.$primary_color.';}';
			
			echo '.entry-title a { color: #141412;}';
			
			echo '.tx-service-icon span { border: 2px solid '.$primary_color.';}';
			
			echo '.ibanner .da-slider .owl-item .da-link, .sidebar.nx-prod-pop.nx-leftsidebar .widget ul.product-categories li:hover > a { background-color:'.$primary_color.'; color: #FFF; }';
			
			echo '.ibanner .da-slider .owl-item .da-link:hover { background-color: #373737; color: #FFF; }';
			
			echo '.ibanner .da-slider .owl-controls .owl-page span { border-color:'.$primary_color.'; }';
			
			echo '.ibanner .da-slider .owl-controls .owl-page.active span, .ibanner .da-slider .owl-controls.clickable .owl-page:hover span {  background-color: '.$primary_color.'; }';			
			
			echo '.ibanner .sldprev, .ibanner .da-slider .owl-prev, .ibanner .sldnext, .ibanner .da-slider .owl-next { 	background-color: '.$primary_color.'; }';			

			echo '.colored-drop .nav-container ul ul a, .colored-drop ul.nav-container ul a, .colored-drop ul.nav-container ul, .colored-drop .nav-container ul ul {background-color: '.$primary_color.';}';			
			
			echo '.sidebar.nx-prod-pop.nx-leftsidebar .widget ul.product-categories > li ul {border-bottom-color: '.$primary_color.';}';
			
			echo '.woocommerce #page ul.products li.product:hover .add_to_cart_button { background-color: '.$primary_color.'; border-color: 1px solid '.$primary_color.'; }';
			
			echo '.nx-nav-boxedicons .header-icons.woocart .cartdrop.widget_shopping_cart.nx-animate {border-bottom-color: '.$primary_color.'}';
			
			echo '.nx-nav-boxedicons .site-header .header-icons > a > span.genericon:before, ul.nav-menu > li.tx-heighlight:before, .woocommerce .nxowoo-box:hover a.button.add_to_cart_button {background-color: '.$primary_color.'}';
			
			if( !empty($topbar_bg_color) ) {
				echo '.site .utilitybar { background-color: '.$topbar_bg_color.'; color: #FFFFFF; border-bottom: 1px solid '.$topbar_bg_color.';}';
				echo '.site .utilitybar .ubarinnerwrap .topphone { color: #FFFFFF;}';	
				echo '.site .utilitybar .ubarinnerwrap .topbarico	{ color: #FFFFFF;}';
				echo '.site .utilitybar .ubarinnerwrap .socialicons ul.social li a i.genericon { background-color: rgba(255, 255, 255, 0.2); color: #FFF; }';	
				echo '.site .utilitybar .ubarinnerwrap .socialicons ul.social li a:hover i.genericon { background-color: rgba(255, 255, 255, 0.0); color: #FFF; }';								
			}	
			
			if ($custom_css) {
			echo "\n".'/* =============== user styling =============== */'."\n";
			echo $custom_css;
			}
			
			// CLOSE STYLE TAG
			echo "</style>". "\n";
		}
	
		add_action('wp_head', 'nx_custom_styles');
	}
	
	/* CUSTOM JS OUTPUT
	================================================== 
	function nx_custom_script() {
		
		global  $icraft_data;
		
		$custom_js = $icraft_data['custom_js'];
		
		if ($custom_js) {			
			echo "\n<script>\n".$custom_js."\n</script>\n";			
		}
	}
	
	add_action('wp_footer', 'nx_custom_script');
		
*/
?>