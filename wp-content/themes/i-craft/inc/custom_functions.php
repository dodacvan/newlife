<?php 
/*-----------------------------------------------------------------------------------*/
/* Social icons																		*/
/*-----------------------------------------------------------------------------------*/
function icraft_social_icons () {
	
	$socio_list = '';
	$siciocount = 0;
    $services = array ('facebook','twitter','youtube','flickr','feed','instagram','googleplus');
    
		$socio_list .= '<ul class="social">';	
		foreach ( $services as $service ) :
			
			$active[$service] = esc_url( get_theme_mod('itrans_social_'.$service, '#') );
			
			if ($active[$service]) { 
				$socio_list .= '<li><a href="'.$active[$service].'" title="'.$service.'" target="_blank"><i class="genericon socico genericon-'.$service.'"></i></a></li>';
				$siciocount++;
			}
			
		endforeach;
		$socio_list .= '</ul>';
		
		if($siciocount>0)
		{	
			return $socio_list;
		} else
		{
			return;
		}
}

/*-----------------------------------------------------------------------------------*/
/* ibanner Slider																		*/
/*-----------------------------------------------------------------------------------*/
function icraft_ibanner_slider () {    
	$arrslidestxt = array();
	$template_dir = get_template_directory_uri();
	$banner_text = esc_attr(get_theme_mod('banner_text', ''));

	$text_alignment = esc_attr(get_theme_mod('itrans_align', 'nxs-left'));
	$banner_overlay = esc_attr(get_theme_mod('itrans_overlay', 'nxs-max19'));
	$itrans_sliderparallax = get_theme_mod('itrans_sliderparallax', 1);	
	$sliderscpeed = intval(esc_attr(get_theme_mod('itrans_sliderspeed', '6'))) * 1000 ;	
	
	if( $banner_overlay == 'nxs-max18' || $banner_overlay == 'nxs-max19' )	
	{
		$text_alignment = 'left';
	}
		
	$upload_dir = wp_upload_dir();
	$upload_base_dir = $upload_dir['basedir'];
	$upload_base_url = $upload_dir['baseurl'];	
	
	$slides_preset = array (
        array(
            'itrans_slide_title' => esc_attr__( '<span class="themecolor">Drag & Drop</span> Ready Layouts', 'i-craft' ),
            'itrans_slide_desc' => esc_attr__( 'Perfect For Business And WooCommerce WordPress Sites', 'i-craft' ),
            'itrans_slide_linktext' => esc_attr__( 'Know More', 'i-craft' ),
            'itrans_slide_linkurl' => esc_url('http://www.templatesnext.org/i-craft/'),
            'itrans_slide_image' => esc_url( get_template_directory_uri() . '/images/slide1.jpg' ),
        ),
        array(
            'itrans_slide_title' => esc_attr__( 'SiteOrigin Page Builder & Elementor', 'i-craft' ),
            'itrans_slide_desc' => esc_attr__( 'Design Your Pages With Most Popular Page Builders', 'i-craft' ),
            'itrans_slide_linktext' => esc_attr__( 'Know More', 'i-craft' ),
            'itrans_slide_linkurl' => '',
            'itrans_slide_image' => esc_url( get_template_directory_uri() . '/images/slide2.jpg' ),
        ),
        array(
            'itrans_slide_title' => esc_attr__( 'Exclusive <span class="themecolor">WooCommerce</span> Features', 'i-craft' ),
            'itrans_slide_desc' => esc_attr__( 'Create Sections Using Pagebuilder Or TemplatesNext Shortcodes', 'i-craft' ),
            'itrans_slide_linktext' => esc_attr__( 'Know More', 'i-craft' ),
            'itrans_slide_linkurl' => '',
            'itrans_slide_image' => esc_url( get_template_directory_uri() . '/images/slide3.jpg' ),
        ),
        array(
            'itrans_slide_title' => esc_attr__( 'Portfolio, Testimonial, Services...', 'i-craft' ),
            'itrans_slide_desc' => esc_attr__( 'Use the [tx] button on your editor to create the columns, services, portfolios, testimonials and custom sliders.', 'i-craft' ),
            'itrans_slide_linktext' => esc_attr__( 'Know More', 'i-craft' ),
            'itrans_slide_linkurl' => '',
            'itrans_slide_image' => esc_url( get_template_directory_uri() . '/images/slide4.jpg' ),
        ),

	);		
	
    for( $slideno = 0; $slideno < 4; $slideno++ ){
			$strret = '';
			$counter = $slideno+1;
			
			$slide_title = esc_attr(get_theme_mod('itrans_slide'.$counter.'_title', $slides_preset[$slideno]['itrans_slide_title'] ));
			$slide_desc = esc_attr(get_theme_mod('itrans_slide'.$counter.'_desc', $slides_preset[$slideno]['itrans_slide_desc'] ));
			$slide_linktext = esc_attr(get_theme_mod('itrans_slide'.$counter.'_linktext', $slides_preset[$slideno]['itrans_slide_linktext'] ));
			$slide_linkurl = esc_url(get_theme_mod('itrans_slide'.$counter.'_linkurl', $slides_preset[$slideno]['itrans_slide_linkurl'] ));
			$slide_image = esc_url(get_theme_mod('itrans_slide'.$counter.'_image', $slides_preset[$slideno]['itrans_slide_image'] ));
			
			$slider_height = esc_attr(get_theme_mod('slider_height', 72 ));
			$slider_reduct = esc_attr(get_theme_mod('slider_reduction', 60 ));						
			
			$slider_image_id = icraft_get_attachment_id_from_url( $slide_image );			
			$slider_resized_image = wp_get_attachment_image( $slider_image_id, "icraft-slider-thumb" );			
			
			if ( $slide_image ) {

				if( $slide_image!='' ){
					if( file_exists( str_replace($upload_base_url,$upload_base_dir,$slide_image) ) ){
						
						$slide_image_url = wp_get_attachment_image_src( $slider_image_id, 'icraft-slider-thumb' );
						$slide_image_url = $slide_image_url[0];						
						//$strret .= '<div class="da-img">' . $slider_resized_image .'</div>';
						$strret .= '<div class="da-img" style="background-image: url('.$slide_image_url.');"></div>';
					}
					else
					{
						$slide_image = $template_dir.'/images/slide'.$counter.'.jpg';
						//$strret .= '<div class="da-img noslide-image"><img src="'.$slide_image.'" alt="'.$slide_title.'" /></div>';
						$strret .= '<div class="da-img noslide-image" style="background-image: url('.$slide_image.');"></div>';
					}
				}
				else
				{					
					$slide_image = $template_dir.'/images/slide'.$counter.'.jpg';
					//$strret .= '<div class="da-img noslide-image"><img src="'.$slide_image.'" alt="'.$slide_title.'" /></div>';
					$strret .= '<div class="da-img noslide-image" style="background-image: url('.$slide_image.');"></div>';					
				}
				
				$strret .= '<div class="slider-content-wrap"><div class="nx-slider-container">';
				$strret .= '<h2>'.wp_specialchars_decode($slide_title, $quote_style = ENT_QUOTES).'</h2>';
				$strret .= '<p>'.$slide_desc.'</p>';
				$strret .= '<a href="'.$slide_linkurl.'" class="da-link">'.$slide_linktext.'</a>';
				$strret .= '</div></div>';
			}
			if ( $strret != '' ){
				$arrslidestxt[$slideno] = $strret;
			}
					
	}
	
	if( count( $arrslidestxt ) > 0 ){
		echo '<div class="ibanner '.$banner_overlay.' '.$text_alignment.'" data-edit-slides="Edit Slider">';
		echo '	<div id="da-slider" class="da-slider" role="banner" data-slider-speed="'.$sliderscpeed.'" data-slider-height="'.$slider_height.'" data-slider-reduct="'.$slider_reduct.'" data-slider-parallax="'.$itrans_sliderparallax.'">';
			
		foreach ( $arrslidestxt as $slidetxt ) :
			echo '<div class="nx-slider">';	
			echo	$slidetxt;
			echo '</div>';

		endforeach;
		echo '	</div>';
		echo '</div>';
	} else
	{
        echo '<div class="iheader front">';
        echo '    <div class="titlebar">';
        echo '        <h1>';
		
		if ($banner_text) {
			echo $banner_text;
		} 
        echo '        </h1>';
        echo '    </div>';
        echo '</div>';
	}
    
}


/*-----------------------------------------------------------------------------------*/
/* find attachment id from url																	*/
/*-----------------------------------------------------------------------------------*/
function icraft_get_attachment_id_from_url( $attachment_url = '' ) {

    global $wpdb;
    $attachment_id = false;

    // If there is no url, return.
    if ( '' == $attachment_url )
        return;

    // Get the upload directory paths
    $upload_dir_paths = wp_upload_dir();

    // Make sure the upload path base directory exists in the attachment URL, to verify that we're working with a media library image
    if ( false !== strpos( $attachment_url, $upload_dir_paths['baseurl'] ) ) {

        // If this is the URL of an auto-generated thumbnail, get the URL of the original image
        $attachment_url = preg_replace( '/-\d+x\d+(?=\.(jpg|jpeg|png|gif)$)/i', '', $attachment_url );

        // Remove the upload path base directory from the attachment URL
        $attachment_url = str_replace( $upload_dir_paths['baseurl'] . '/', '', $attachment_url );

        // Finally, run a custom database query to get the attachment ID from the modified attachment URL
        $attachment_id = $wpdb->get_var( $wpdb->prepare( "SELECT wposts.ID FROM $wpdb->posts wposts, $wpdb->postmeta wpostmeta WHERE wposts.ID = wpostmeta.post_id AND wpostmeta.meta_key = '_wp_attached_file' AND wpostmeta.meta_value = '%s' AND wposts.post_type = 'attachment'", $attachment_url ) );

    }

    return $attachment_id;
}


/* Demo import by One Click Demo Import */
// include get_template_directory() . '/inc/one-click-demo-import/one-click-demo-import.php';

function icraft_import_files() {
  return array(
  	/**/
    array(
      'import_file_name'             	=> 'i-craft Demo Craft-18',
      'import_file_url'            		=> 'https://raw.githubusercontent.com/TemplatesNext/i-craft-demo/master/i-craft.wordpress.2.xml',
      'import_widget_file_url'     		=> 'https://raw.githubusercontent.com/TemplatesNext/i-craft-demo/master/i-craft-widgets-2.wie',
      'import_customizer_file_url' 		=> 'https://raw.githubusercontent.com/TemplatesNext/i-craft-demo/master/i-craft-export-2.dat',
      'import_preview_image_url'     	=> 'https://raw.githubusercontent.com/TemplatesNext/i-craft-demo/master/i-craft-demo-3.jpg',
      'import_notice'                	=> __( 'Please make sure you have plugin "TemplatesNext ToolKit", "WooCommerce" and "Contact Form 7" installed and active before you start the import process. <br> This process involves transfer of data and media from server to server and might take some time.', 'i-craft' ),
	  'preview_url'                		=> 'http://templatesnext.org/icraft/?page_id=1053',
    ),
    array(
      'import_file_name'             	=> 'i-craft Demo Shop',
      'import_file_url'            		=> 'https://raw.githubusercontent.com/TemplatesNext/i-craft-demo/master/i-craft.wordpress-1.xml',
      'import_widget_file_url'     		=> 'https://raw.githubusercontent.com/TemplatesNext/i-craft-demo/master/i-craft-widgets.wie',
      'import_customizer_file_url' 		=> 'https://raw.githubusercontent.com/TemplatesNext/i-craft-demo/master/i-craft-export-1.dat',
      'import_preview_image_url'     	=> 'https://raw.githubusercontent.com/TemplatesNext/i-craft-demo/master/i-craft-demo-1.jpg',
      'import_notice'                	=> __( 'Please make sure you have plugin "TemplatesNext ToolKit", "WooCommerce" and "Contact Form 7" installed and active before you start the import process. <br> This process involves transfer of data and media from server to server and might take some time.', 'i-craft' ),
	  'preview_url'                		=> 'http://templatesnext.org/icraft/',
    ),
	
    array(
      'import_file_name'             	=> 'i-craft Demo Business',
      'import_file_url'            		=> 'https://raw.githubusercontent.com/TemplatesNext/i-craft-demo/master/i-craft.wordpress-1.xml',
      'import_widget_file_url'     		=> 'https://raw.githubusercontent.com/TemplatesNext/i-craft-demo/master/i-craft-widgets.wie',
      'import_customizer_file_url' 		=> 'https://raw.githubusercontent.com/TemplatesNext/i-craft-demo/master/i-craft-export-1.dat',
      'import_preview_image_url'     	=> 'https://raw.githubusercontent.com/TemplatesNext/i-craft-demo/master/i-craft-demo-2.jpg',
      'import_notice'                	=> __( 'Please make sure you have plugin "TemplatesNext ToolKit", "WooCommerce" and "Contact Form 7" installed and active before you start the import process. <br> This process involves transfer of data and media from server to server and might take some time.', 'i-craft' ),
	  'preview_url'                		=> 'http://templatesnext.org/icraft/?page_id=325',	  
    ),	
  );
}
add_filter( 'pt-ocdi/import_files', 'icraft_import_files' );

add_filter( 'pt-ocdi/disable_pt_branding', '__return_true' );

function icraft_after_import_setup($selected_import) {
		if ( 'i-craft Demo Shop' === $selected_import['import_file_name'] ) {

		// Assign menus to their locations.
		$main_menu = get_term_by( 'name', 'i-craft Main Nav', 'nav_menu' );
	
		set_theme_mod( 'nav_menu_locations', array(
				'primary' => $main_menu->term_id,
			)
		);
		
		$front_page_id = get_page_by_title( 'Front Page Shop' );
       	if ( isset( $front_page_id->ID ) ) {
			update_option( 'page_on_front', $front_page_id->ID );
        	update_option( 'show_on_front', 'page' );
       	}		
		
	} elseif ( 'i-craft Demo Business' === $selected_import['import_file_name'] ) {
	
		// Assign menus to their locations.
		$main_menu = get_term_by( 'name', 'i-craft Main Nav', 'nav_menu' );
		set_theme_mod( 'nav_menu_locations', array(
				'primary' => $main_menu->term_id,
			)
		);
		
		$front_page_id = get_page_by_title( 'Front Page' );
       	if ( isset( $front_page_id->ID ) ) {
			update_option( 'page_on_front', $front_page_id->ID );
        	update_option( 'show_on_front', 'page' );
       	}			
	
	} elseif ( 'i-craft Demo Craft-18' === $selected_import['import_file_name'] ) {
	
		// Assign menus to their locations.
		$main_menu = get_term_by( 'name', 'i-craft Main Nav', 'nav_menu' );
		set_theme_mod( 'nav_menu_locations', array(
				'primary' => $main_menu->term_id,
			)
		);
		
		$front_page_id = get_page_by_title( 'Craft-18' );
       	if ( isset( $front_page_id->ID ) ) {
			update_option( 'page_on_front', $front_page_id->ID );
        	update_option( 'show_on_front', 'page' );
       	}			
	
	}

}
add_action( 'pt-ocdi/after_import', 'icraft_after_import_setup' );

/* Delete The default Hello World Post before import */
/* Resetting default Widgets */
function icraft_before_content_import( $selected_import ) {
	wp_delete_post(1);
	update_option( 'sidebars_widgets', $null );
}
add_action( 'pt-ocdi/before_content_import', 'icraft_before_content_import' );

/* change title for page and menu */
function ocdi_plugin_page_setup( $default_settings ) {
    $default_settings['page_title']  = esc_html__( 'i-craft One Click Demo Set-up', 'i-craft' );
    $default_settings['menu_title']  = esc_html__( 'i-craft Demo Setup' ,'i-craft' );
    return $default_settings;
}
add_filter( 'pt-ocdi/plugin_page_setup', 'ocdi_plugin_page_setup' );


/* Calling Theme Welcome on activation */
require_once( get_template_directory() . '/inc/theme-welcome/theme-welcome.php' );

/* activating all site origin widgets bundle */
function icraft_filter_active_widgets($active){
    $active['features'] = true;
    $active['icon'] = true;
	
    $active['button'] = true;	
    $active['layout-slider'] = true;	
    $active['social-media-buttons'] = true;	
    $active['call-to-action'] = true;
    $active['google-maps'] = true;	
    //$active['image'] = true;	
    //$active['post-carousel'] = true;	
    //$active['taxonomy'] = true;
    $active['contact'] = true;	
    $active['headline'] = true;	
    $active['image-grid'] = true;	
    $active['price-table'] = true;	
    //$active['testimonial'] = true;	
    $active['editor'] = true;	
    $active['hero'] = true;	
    $active['image-slider'] = true;
    $active['simple-masonry'] = true;
    $active['video'] = true;		
	
    return $active;
}
add_filter('siteorigin_widgets_active_widgets', 'icraft_filter_active_widgets');