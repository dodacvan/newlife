<?php

function icraft_customizer_config() {
	

    $url  = get_stylesheet_directory_uri() . '/inc/kirki/';
	
    /**
     * If you need to include Kirki in your theme,
     * then you may want to consider adding the translations here
     * using your textdomain.
     * 
     * If you're using Kirki as a plugin then you can remove these.
     */

    $strings = array(
        'background-color' => __( 'Background Color', 'i-craft' ),
        'background-image' => __( 'Background Image', 'i-craft' ),
        'no-repeat' => __( 'No Repeat', 'i-craft' ),
        'repeat-all' => __( 'Repeat All', 'i-craft' ),
        'repeat-x' => __( 'Repeat Horizontally', 'i-craft' ),
        'repeat-y' => __( 'Repeat Vertically', 'i-craft' ),
        'inherit' => __( 'Inherit', 'i-craft' ),
        'background-repeat' => __( 'Background Repeat', 'i-craft' ),
        'cover' => __( 'Cover', 'i-craft' ),
        'contain' => __( 'Contain', 'i-craft' ),
        'background-size' => __( 'Background Size', 'i-craft' ),
        'fixed' => __( 'Fixed', 'i-craft' ),
        'scroll' => __( 'Scroll', 'i-craft' ),
        'background-attachment' => __( 'Background Attachment', 'i-craft' ),
        'left-top' => __( 'Left Top', 'i-craft' ),
        'left-center' => __( 'Left Center', 'i-craft' ),
        'left-bottom' => __( 'Left Bottom', 'i-craft' ),
        'right-top' => __( 'Right Top', 'i-craft' ),
        'right-center' => __( 'Right Center', 'i-craft' ),
        'right-bottom' => __( 'Right Bottom', 'i-craft' ),
        'center-top' => __( 'Center Top', 'i-craft' ),
        'center-center' => __( 'Center Center', 'i-craft' ),
        'center-bottom' => __( 'Center Bottom', 'i-craft' ),
        'background-position' => __( 'Background Position', 'i-craft' ),
        'background-opacity' => __( 'Background Opacity', 'i-craft' ),
        'ON' => __( 'ON', 'i-craft' ),
        'OFF' => __( 'OFF', 'i-craft' ),
        'all' => __( 'All', 'i-craft' ),
        'cyrillic' => __( 'Cyrillic', 'i-craft' ),
        'cyrillic-ext' => __( 'Cyrillic Extended', 'i-craft' ),
        'devanagari' => __( 'Devanagari', 'i-craft' ),
        'greek' => __( 'Greek', 'i-craft' ),
        'greek-ext' => __( 'Greek Extended', 'i-craft' ),
        'khmer' => __( 'Khmer', 'i-craft' ),
        'latin' => __( 'Latin', 'i-craft' ),
        'latin-ext' => __( 'Latin Extended', 'i-craft' ),
        'vietnamese' => __( 'Vietnamese', 'i-craft' ),
        'serif' => _x( 'Serif', 'font style', 'i-craft' ),
        'sans-serif' => _x( 'Sans Serif', 'font style', 'i-craft' ),
        'monospace' => _x( 'Monospace', 'font style', 'i-craft' ),
    );	

	$args = array(
  
        // Change the logo image. (URL) Point this to the path of the logo file in your theme directory
                // The developer recommends an image size of about 250 x 250
        'logo_image'   => get_template_directory_uri() . '/images/logo.png',
  
        // The color of active menu items, help bullets etc.
        //'color_active' => '#95c837',
		
		// Color used on slider controls and image selects
		//'color_accent' => '#e7e7e7',
		
		// The generic background color
		//'color_back' => '#f7f7f7',
	
        // Color used for secondary elements and desable/inactive controls
       // 'color_light'  => '#e7e7e7',
  
        // Color used for button-set controls and other elements
        //'color_select' => '#34495e',
		 
        
        // For the parameter here, use the handle of your stylesheet you use in wp_enqueue
        'stylesheet_id' => 'customize-styles', 
		
        // Only use this if you are bundling the plugin with your theme (see above)
        'url_path'     => get_template_directory_uri() . '/inc/kirki/',

        'textdomain'   => 'i-craft',
		
        'i18n'         => $strings,		
		
		
	);
	
	
	return $args;
}
add_filter( 'kirki/config', 'icraft_customizer_config' );


/**
 * Create the customizer panels and sections
 */
add_action( 'customize_register', 'icraft_add_panels_and_sections' ); 
function icraft_add_panels_and_sections( $wp_customize ) {
	
	/*
	* Add panels
	*/
	
	$wp_customize->add_panel( 'slider', array(
		'priority'    => 140,
		'title'       => __( 'Slider', 'i-craft' ),
		'description' => __( 'Slides details', 'i-craft' ),
	) );	
	
	$wp_customize->add_panel( 'rmenu', array(
		'priority'    => 140,
		'title'       => __( 'Responsive Menu', 'i-craft' ),
		'description' => __( 'Responsive Menu Options', 'i-craft' ),
	) );		

    /**
     * Add Sections
     */
    $wp_customize->add_section('basic', array(
        'title'    => __('Basic Settings', 'i-craft'),
        'description' => '',
        'priority' => 130,
    ));
	
    $wp_customize->add_section('layout', array(
        'title'    => __('Layout Options', 'i-craft'),
        'description' => '',
        'priority' => 130,
    ));
	
	$wp_customize->add_section('nxtopbar', array(
        'title'    => __('Topbar Options', 'i-craft'),
        'description' => '',
        'priority' => 130,
    ));
	
    $wp_customize->add_section('nxheader', array(
        'title'    => __('Header Options', 'i-craft'),
        'description' => '',
        'priority' => 130,
    ));	
	
    $wp_customize->add_section('nxfooter', array(
        'title'    => __('Footer Options', 'i-craft'),
        'description' => '',
        'priority' => 130,
    ));	
	
	
    $wp_customize->add_section('social', array(
        'title'    => __('Social Links', 'i-craft'),
        'description' => __('Insert full URL of your social link including http:// replacing #', 'i-craft'),
        'priority' => 130,
    ));		
	
    $wp_customize->add_section('blogpage', array(
        'title'    => __('Front Page Settings (blog/shop)', 'i-craft'),
        'description' => '',
        'priority' => 150,
    ));	
	
	// slider sections
	
	$wp_customize->add_section('slidersettings', array(
        'title'    => __('Slide Settings', 'i-craft'),
        'description' => '',
        'panel' => 'slider',		
        'priority' => 140,
    ));		
	
	$wp_customize->add_section('slide1', array(
        'title'    => __('Slide 1', 'i-craft'),
        'description' => '',
        'panel' => 'slider',		
        'priority' => 140,
    ));	
	$wp_customize->add_section('slide2', array(
        'title'    => __('Slide 2', 'i-craft'),
        'description' => '',
        'panel' => 'slider',		
        'priority' => 140,
    ));	
	$wp_customize->add_section('slide3', array(
        'title'    => __('Slide 3', 'i-craft'),
        'description' => '',
        'panel' => 'slider',		
        'priority' => 140,
    ));	
	$wp_customize->add_section('slide4', array(
        'title'    => __('Slide 4', 'i-craft'),
        'description' => '',
        'panel' => 'slider',		
        'priority' => 140,
    ));	
	
	// WooCommerce Settings
    $wp_customize->add_section('woocomm', array(
        'title'    => __('WooCommerce Theme Options', 'i-craft'),
        'description' => '',
        'priority' => 150,
    ));	
	
	//Typographu section
    $wp_customize->add_section('typography', array(
        'title'    => __('Fonts', 'i-craft'),
        'description' => '',
        'priority' => 151,
    ));			
	
	// promo sections
	
	$wp_customize->add_section('nxpromo', array(
        'title'    => __('More About i-craft', 'i-craft'),
        'description' => '',
        'priority' => 170,
    ));
	
    $wp_customize->add_section('mmode', array(
        'title'    => __('Coming Soon/Maintenance Mode', 'i-craft'),
        'description' => __('', 'i-craft'),
        'priority' => 180,
    ));	
	
	// Responsive Menu sections
	
	$wp_customize->add_section('rmgeneral', array(
        'title'    => __('General Options', 'i-craft'),
        'panel' => 'rmenu',		
        'description' => '',
        'priority' => 160,
    ));	
	
    $wp_customize->add_section('rmsettings', array(
        'title'    => __('Menu Appearance', 'i-craft'),
        'panel' => 'rmenu',
        'description' => '',
        'priority' => 161,
    ));						
	
}


function icraft_custom_setting( $controls ) {
	
    $controls[] = array(
        'type'     => 'text',
        'settings'  => 'top_phone',
        'label'    => __( 'Phone Number', 'i-craft' ),
        'section'  => 'nxtopbar',
        'default'  => '1-000-123-4567',		
        'priority' => 1,
		'description' => __( 'Phone number that appears on top bar.', 'i-craft' ),
    );
	
    $controls[] = array(
        'type'     => 'text',
        'settings'  => 'top_email',
        'label'    => __( 'Email Address', 'i-craft' ),
        'section'  => 'nxtopbar',
        'default'  => sanitize_email('email@i-create.com'),
        'priority' => 1,
		'description' => __( 'Email Id that appears on top bar.', 'i-craft' ),		
    );
	
	$controls[] = array(
		'type'        => 'upload',
		'settings'     => 'logo',
		'label'       => __( 'Site header logo', 'i-craft' ),
		'description' => __( 'Width 280px, height 72px max. Upload logo for header', 'i-craft' ),
        'section'  => 'title_tagline',
        'default'  => get_template_directory_uri() . '/images/logo-black-2.png',		
		'priority'    => 1,
	);	
	
	$controls[] = array(
		'type'        => 'upload',
		'settings'     => 'logo_trans',
		'label'       => __( 'Transparent Logo', 'i-craft' ),
		'description' => __( 'Optional transparent logo for transparent header', 'i-craft' ),
        'section'  => 'title_tagline',
        'default'  => get_template_directory_uri() . '/images/logo-white-2.png',
		'priority'    => 2,
	);		
	
	$controls[] = array(
		'type'        => 'color',
		'settings'     => 'primary_color',
		'label'       => __( 'Primary Color', 'i-craft' ),
		'description' => __( 'Choose your theme color', 'i-craft' ),
		'section'     => 'colors',
		'default'     => '#dd3333',
		'priority'    => 1,
	);	
	
	$controls[] = array(
		'type'        => 'switch',
		'settings'     => 'topbar_bg',
		'label'       => __( 'Primary Colored Topbar BG', 'i-craft' ),
		'description' => __( 'Turn off primary colored topbar background', 'i-craft' ),
		'section'     => 'nxtopbar',
		'default'     => 1,		
		'priority'    => 3,
	);
	
	$controls[] = array(  
		'type'        => 'switch',
		'settings'     => 'pre_loader',
		'label'       => __( 'Turn ON Page Preloader', 'i-craft' ),
		'description' => __( 'Turn ON/OFF loding animation before page load', 'i-craft' ),
		'section'     => 'layout',
		'default'     => 0,		
		'priority'    => 3,
	);

	$controls[] = array(
		'type'        => 'switch',
		'settings'     => 'nav_dropdown',
		'label'       => __( 'Primary Colored Dropdown Menu', 'i-craft' ),
		'description' => __( 'Turn off primary colored dropdown Menu', 'i-craft' ),
		'section'     => 'nxheader',
		'default'     => 1,		
		'priority'    => 3,
	);
	
	/* NX Header controls */
	$controls[] = array(
		'type'        => 'switch',
		'settings'     => 'show_search',
		'label'       => __( 'Show Site Search', 'i-craft' ),
		'description' => __( 'Turn the search ON/OFF on main navigation', 'i-craft' ),
		'section'     => 'nxheader',
		'default'     => 1,
		'priority'    => 4,
	);	
	
	$controls[] = array(
		'type'        => 'switch',
		'settings'     => 'boxed-icons',
		'label'       => __( 'Boxed Menu Icons', 'i-craft' ),
		'description' => __( 'The crat and search icons will appear as boxed', 'i-craft' ),
		'section'     => 'nxheader',
		'default'     => 0,			
		'priority'    => 4,
	);
	
	$controls[] = array(
		'type'        => 'switch',
		'settings'     => 'nav_upper',
		'label'       => __( 'Turn All Top Menu Item UPPERCASE', 'i-craft' ),
		'description' => __( 'Turns all top navigation manu item to UPPERCASE', 'i-craft' ),
		'section'     => 'nxheader',
		'default'  => 0,		
		'priority'    => 5,
	);
	
	$controls[] = array(
		'type'        => 'slider',
		'settings'     => 'nav_font_size',
		'label'       => __( 'Top Navigation Font size', 'i-craft' ),
		'section'     => 'nxheader',
		'priority'    => 6,
		'default'     => 14,
		'choices'     => array(
			'min'  => '12',
			'max'  => '18',
			'step' => '1',
		),		
		'output' => array(
			array(
				'element'  => '.nav-container li a',
				'property' => 'font-size',
				'units'	   => 'px',
			),
		),
		
	);	
	
	$controls[] = array(
		'type'        => 'slider',
		'settings'     => 'nav_font_weight',
		'label'       => __( 'Top Navigation Font Weight', 'i-craft' ),
		'section'     => 'nxheader',
		'priority'    => 6,
		'default'     => 400,
		'choices'     => array(
			'min'  => '200',
			'max'  => '800',
			'step' => '100',
		),		
		'output' => array(
			array(
				'element'  => '.nav-container li a',
				'property' => 'font-weight',
			),
		),
		
	);
	
	/* NXFooter controls */	
    $controls[] = array(
        'type'     => 'text',
        'settings'  => 'copyright_text',
        'label'    => __( 'Copyright Text', 'i-craft' ),
		'description' => __( 'Bottom footer copyright text', 'i-craft' ),		
        'section'  => 'nxfooter',
		'default'  => __( 'Copyright &copy; ', 'i-craft').get_bloginfo( 'name' ),		
        'priority' => 1,
    );		
	
	$controls[] = array(
		'type'        => 'color',
		'settings'     => 'footer_bg',
		'label'       => __( 'Footer Widget Area Background Color', 'i-craft' ),
		'section'     => 'nxfooter',
		'default'     => '#383838',
		'priority'    => 2,
		'output' => array(
			array(
				'element'  => '.footer-bg, .site-footer .sidebar-container',
				'property' => 'background-color',
			),
		),		
	);
	/**/
	$controls[] = array(
		'type'        => 'color',
		'settings'     => 'footer_title_color',
		'label'       => __( 'Footer Widgets Title Color', 'i-craft' ),
		'section'     => 'nxfooter',
		'default'     => '#FFFFFF',
		'priority'    => 3,
		'output' => array(
			array(
				'element'  => '.site-footer .widget-area .widget .widget-title',
				'property' => 'color',
			),
		),		
	);		
	$controls[] = array(
		'type'        => 'color',
		'settings'     => 'footer_text_color',
		'label'       => __( 'Footer Widgets Text Color', 'i-craft' ),
		'section'     => 'nxfooter',
		'default'     => '#bbbbbb',
		'priority'    => 4,
		'output' => array(
			array(
				'element'  => '.site-footer .widget-area .widget, .site-footer .widget-area .widget li',
				'property' => 'color',
			),
		),		
	);
	$controls[] = array(
		'type'        => 'color',
		'settings'     => 'footer_link_color',
		'label'       => __( 'Footer Widgets Link Color', 'i-craft' ),
		'section'     => 'nxfooter',
		'default'     => '#dddddd',
		'priority'    => 4,
		'output' => array(
			array(
				'element'  => '.site-footer .widget-area .widget a',
				'property' => 'color',
			),
		),		
	);
	
	$controls[] = array(
		'type'        => 'color',
		'settings'     => 'bottom_footer_bg',
		'label'       => __( 'Bottom Footer background Color', 'i-craft' ),
		'section'     => 'nxfooter',
		'default'     => '#272727',
		'priority'    => 4,
		'output' => array(
			array(
				'element'  => '.site-footer',
				'property' => 'background-color',
			),
		),		
	);
	$controls[] = array(
		'type'        => 'color',
		'settings'     => 'bottom_footer_text_color',
		'label'       => __( 'Bottom Footer Text Color', 'i-craft' ),
		'section'     => 'nxfooter',
		'default'     => '#777777',
		'priority'    => 4,
		'output' => array(
			array(
				'element'  => '.site-footer .site-info, .site-footer .site-info a',
				'property' => 'color',
			),
		),		
	);		
	
		
	$controls[] = array(
		'type'        => 'radio-image',
		'settings'     => 'blog_layout',
		'label'       => __( 'Blog Posts Layout', 'i-craft' ),
		'description' => __( '(Choose blog posts layout (one column/two column)', 'i-craft' ),
		'section'     => 'layout',
		'default'     => 'onecol',
		'priority'    => 2,
		'choices'     => array(
			'onecol' => get_template_directory_uri() . '/images/onecol.png',
			'twocol' => get_template_directory_uri() . '/images/twocol.png',
		),
	);
	
	$controls[] = array(
		'type'        => 'switch',
		'settings'     => 'full_content',
		'label'       => __( 'Show Full Content', 'i-craft' ),
		'description' => __( 'Show full content on blog pages', 'i-craft' ),
		'section'     => 'layout',
		'default'     => 0,		
		'priority'    => 3,
	);		
	
	$controls[] = array(
		'type'        => 'switch',
		'settings'     => 'wide_layout',
		'label'       => __( 'Wide layout', 'i-craft' ),
		'description' => __( 'Check to have wide layou', 'i-craft' ),
		'section'     => 'layout',
		'default'     => 1,			
		'priority'    => 4,
	);

	
	$controls[] = array(
		'type'        => 'switch',
		'settings'     => 'sidebar_side',
		'label'       => __( 'Main Sidebar on left (default sidebar appears on right)', 'i-craft' ),
		'description' => __( 'move the main sidebar position to left', 'i-craft' ),
		'section'     => 'layout',
		'default'     => 0,			
		'priority'    => 4,
	);	
	
	$controls[] = array(
		'type'        => 'textarea',
		'settings'     => 'itrans_extra_style',
		'label'       => __( 'Additional style', 'i-craft' ),
		'description' => __( 'add extra style(CSS) codes here', 'i-craft' ),
		'section'     => 'layout',
		'default'     => '',
		'priority'    => 10,
	);	
	
	/*
	$controls[] = array(
		'type'        => 'color',
		'settings'     => 'site_bg_color',
		'label'       => __( 'Background Color (Boxed Layout)', 'i-craft' ),
		'description' => __( 'Choose your background color', 'i-craft' ),
		'section'     => 'layout',
		'default'     => '#FFFFFF',
		'priority'    => 1,
	);
	*/	
	

	
	// social links
	
    $controls[] = array(
        'type'     => 'text',
        'settings'  => 'itrans_social_facebook',
        'label'    => __( 'Facebook', 'i-craft' ),
		'description' => __( 'Empty the field to remove the icon', 'i-craft' ),		
        'section'  => 'nxtopbar',
		'default'  => '#',		
        'priority' => 1,
    );	
	
    $controls[] = array(
        'type'     => 'text',
        'settings'  => 'itrans_social_twitter',
        'label'    => __( 'Twitter', 'i-craft' ),
		'description' => __( 'Empty the field to remove the icon', 'i-craft' ),			
        'section'  => 'nxtopbar',
		'default'  => '#',	
        'priority' => 1,
    );
	
    $controls[] = array(
        'type'     => 'text',
        'settings'  => 'itrans_social_flickr',
        'label'    => __( 'Flickr', 'i-craft' ),
		'description' => __( 'Empty the field to remove the icon', 'i-craft' ),			
        'section'  => 'nxtopbar',
		'default'  => '#',	
        'priority' => 1,
    );	
	
    $controls[] = array(
        'type'     => 'text',
        'settings'  => 'itrans_social_feed',
        'label'    => __( 'RSS', 'i-craft' ),
		'description' => __( 'Empty the field to remove the icon', 'i-craft' ),			
        'section'  => 'nxtopbar',
		'default'  => '#',	
        'priority' => 1,
    );	
	
    $controls[] = array(
        'type'     => 'text',
        'settings'  => 'itrans_social_instagram',
        'label'    => __( 'Instagram', 'i-craft' ),
		'description' => __( 'Empty the field to remove the icon', 'i-craft' ),			
        'section'  => 'nxtopbar',
		'default'  => '#',	
        'priority' => 1,
    );	
	
    $controls[] = array(
        'type'     => 'text',
        'settings'  => 'itrans_social_googleplus',
        'label'    => __( 'Google Plus', 'i-craft' ),
		'description' => __( 'Empty the field to remove the icon', 'i-craft' ),			
        'section'  => 'nxtopbar',
		'default'  => '#',	
        'priority' => 1,
    );	
	
    $controls[] = array(
        'type'     => 'text',
        'settings'  => 'itrans_social_youtube',
        'label'    => __( 'YouTube', 'i-craft' ),
		'description' => __( 'Empty the field to remove the icon', 'i-craft' ),			
        'section'  => 'nxtopbar',
		'default'  => '#',	
        'priority' => 1,
    );	
	
	// Slider

	$controls[] = array(
		'type'        => 'slider',
		'settings'     => 'itrans_sliderspeed',
		'label'       => __( 'Slide Duration', 'i-craft' ),
		'description' => __( 'Slide visibility in second', 'i-craft' ),
		'section'     => 'slidersettings',
		'default'     => 6,
		'priority'    => 1,
		'choices'     => array(
			'min'  => 1,
			'max'  => 30,
			'step' => 1
		),
	);
	
	$controls[] = array(
		'type'        => 'switch',
		'settings'     => 'itrans_sliderparallax',
		'label'       => __( 'Parallax Effect', 'i-craft' ),
		'description' => __( 'Turn ON/OFF Parallax Effect', 'i-craft' ),
		'section'     => 'slidersettings',
		'default'     => 1,			
		'priority'    => 4,
	);	
	
	$controls[] = array(
		//'type'        => 'radio-buttonset',
		'type'        => 'radio',
		'settings'    => 'itrans_overlay',
		'label'       => __( 'Text background', 'i-craft' ),
		'section'     => 'slidersettings',
		'default'     => 'nxs-max19',
		'priority'    => 10,
		'choices'     => array(
			'nxs-pattern'   => esc_attr__( 'Patterned Overlay', 'i-craft' ),
			'nxs-shadow' => esc_attr__( 'Shadowed Text', 'i-craft' ),
			'nxs-vinette'  => esc_attr__( 'Vignette Overlay', 'i-craft' ),
			'nxs-semitrans'  => esc_attr__( 'Semi-trans Text BG', 'i-craft' ),
			'nxs-semitrans2'  => esc_attr__( 'Semi-trans Overlay', 'i-craft' ),			
			'nxs-max19'  => esc_attr__( 'Craft 19', 'i-craft' ),						
		),
	);	
	
	
	$controls[] = array(
		'type'        => 'radio-buttonset',
		'settings'    => 'itrans_align',
		'label'       => __( 'Text Alignment', 'i-craft' ),
		'section'     => 'slidersettings',
		'default'     => 'nxs-left',
		'priority'    => 10,
		'choices'     => array(
			'nxs-left'   => esc_attr__( 'Left', 'i-craft' ),
			'nxs-center' => esc_attr__( 'Center', 'i-craft' ),
			'nxs-right'  => esc_attr__( 'Right', 'i-craft' ),
		),
	);		
	
	$controls[] = array(
		'type'        => 'slider',
		'settings'    => 'slider_height',
		'label'       => __( 'Slider Height (in %)', 'i-craft' ),
		'section'     => 'slidersettings',
		'default'     => 72,
		'choices'     => array(
			'min'  => '0',
			'max'  => '100',
			'step' => '1',
		),
	);
	
	$controls[] = array(
		'type'        => 'slider',
		'settings'    => 'slider_reduction',
		'label'       => __( 'Reduction In px', 'i-craft' ),
		'section'     => 'slidersettings',
		'description' => __( 'Amount of pixels to be reduced from % of slider height', 'i-craft' ),		
		'default'     => 60,
		'choices'     => array(
			'min'  => '0',
			'max'  => '320',
			'step' => '1',
		),
	);				
		
	
	// Slide1
    $controls[] = array(
        'type'     => 'text',
        'settings'  => 'itrans_slide1_title',
        'label'    => __( 'Slide1 Title', 'i-craft' ),
        'section'  => 'slide1',
		'default'  => esc_attr__('<span class="themecolor">Drag & Drop</span> Ready Layouts', 'i-craft'),			
        'priority' => 1,
    );
	$controls[] = array(
		'type'        	=> 'textarea',
		'settings'     	=> 'itrans_slide1_desc',
		'label'       	=> __( 'Slide1 Description', 'i-craft' ),
		'section'     	=> 'slide1',
		'default'  		=> esc_attr__( 'Perfect For Business And WooCommerce WordPress Sites', 'i-craft' ),
		'priority'    	=> 10,
	);
    $controls[] = array(
        'type'     => 'text',
        'settings'  => 'itrans_slide1_linktext',
        'label'    => __( 'Slide1 Link text', 'i-craft' ),
        'section'  => 'slide1',
		'default'  => __( 'Know More', 'i-craft' ),		
        'priority' => 1,
    );
    $controls[] = array(
        'type'     => 'text',
        'settings'  => 'itrans_slide1_linkurl',
        'label'    => __( 'Slide1 Link URL', 'i-craft' ),
        'section'  => 'slide1',
		'default'  => esc_url('http://templatesnext.org/icraft/'),		
        'priority' => 1,
    );
	$controls[] = array(
		'type'        	=> 'upload',
		'settings'     	=> 'itrans_slide1_image',
		'label'       	=> __( 'Slide1 Image', 'i-craft' ),
        'section'  	  	=> 'slide1',
		'default'  		=> esc_url( get_template_directory_uri() . '/images/slide1.jpg'),
		'priority'    	=> 1,
	);							
	
	
	// Slide2
    $controls[] = array(
        'type'     => 'text',
        'settings'  => 'itrans_slide2_title',
        'label'    => __( 'Slide2 Title', 'i-craft' ),
        'section'  => 'slide2',
		'default'  => esc_attr__( 'SiteOrigin Page Builder & Elementor', 'i-craft' ),		
        'priority' => 1,
    );
	$controls[] = array(
		'type'        => 'textarea',
		'settings'     => 'itrans_slide2_desc',
		'label'       => __( 'Slide2 Description', 'i-craft' ),
		'section'     => 'slide2',
		'default'  => esc_attr__( 'Design Your Pages With Most Popular Page Builders', 'i-craft' ),
		'priority'    => 10,
	);
    $controls[] = array(
        'type'     => 'text',
        'settings'  => 'itrans_slide2_linktext',
        'label'    => __( 'Slide2 Link text', 'i-craft' ),
        'section'  => 'slide2',
		'default'  => esc_attr__('Know More', 'i-craft'),		
        'priority' => 1,
    );
    $controls[] = array(
        'type'     => 'text',
        'settings'  => 'itrans_slide2_linkurl',
        'label'    => __( 'Slide2 Link URL', 'i-craft' ),
        'section'  => 'slide2',
		'default'  => esc_url('https://wordpress.org/'),		
        'priority' => 1,
    );
	$controls[] = array(
		'type'        	=> 'upload',
		'settings'     	=> 'itrans_slide2_image',
		'label'      	=> __( 'Slide2 Image', 'i-craft' ),
        'section'  	  	=> 'slide2',
		'default'  		=> esc_url( get_template_directory_uri() . '/images/slide2.jpg'),
		'priority'    	=> 1,
	);							
		
		
	// Slide3
    $controls[] = array(
        'type'     => 'text',
        'settings'  => 'itrans_slide3_title',
        'label'    => __( 'Slide3 Title', 'i-craft' ),
        'section'  => 'slide3',
		'default'  => esc_attr__( 'Portfolio, Testimonial, Services...', 'i-craft' ),	
        'priority' => 1,
    );
	$controls[] = array(
		'type'        => 'textarea',
		'settings'     => 'itrans_slide3_desc',
		'label'       => __( 'Slide3 Description', 'i-craft' ),
		'section'     => 'slide3',
		'default'  => esc_attr__( 'Use the [tx] button on your editor to create the columns, services, portfolios, testimonials and custom sliders.', 'i-craft' ),
		'priority'    => 10,
	);
    $controls[] = array(
        'type'     => 'text',
        'settings'  => 'itrans_slide3_linktext',
        'label'    => __( 'Slide3 Link text', 'i-craft' ),
        'section'  => 'slide3',
		'default'  => esc_attr__('Know More', 'i-craft'),			
        'priority' => 1,
    );
    $controls[] = array(
        'type'     => 'text',
        'settings'  => 'itrans_slide3_linkurl',
        'label'    => __( 'Slide3 Link URL', 'i-craft' ),
        'section'  => 'slide3',
		'default'  => esc_url('https://wordpress.org/'),		
        'priority' => 1,
    );
	$controls[] = array(
		'type'        => 'upload',
		'settings'     => 'itrans_slide3_image',
		'label'       => __( 'Slide3 Image', 'i-craft' ),
        'section'  	  => 'slide3',
		'default'  => esc_url(get_template_directory_uri() . '/images/slide3.jpg'),
		'priority'    => 1,
	);							
	
	
	// Slide4
    $controls[] = array(
        'type'     => 'text',
        'settings'  => 'itrans_slide4_title',
        'label'    => __( 'Slide4 Title', 'i-craft' ),
        'section'  => 'slide4',
		'default'  => esc_attr__( 'Exclusive <span class="themecolor">WooCommerce</span> Features', 'i-craft' ),
        'priority' => 1,
    );
	$controls[] = array(
		'type'        => 'textarea',
		'settings'     => 'itrans_slide4_desc',
		'label'       => __( 'Slide4 Description', 'i-craft' ),
		'section'     => 'slide4',
		'default'  => esc_attr__( 'Create Sections Using Pagebuilder Or TemplatesNext Shortcodes', 'i-craft' ),
		'priority'    => 10,
	);
    $controls[] = array(
        'type'     => 'text',
        'settings'  => 'itrans_slide4_linktext',
        'label'    => __( 'Slide4 Link text', 'i-craft' ),
        'section'  => 'slide4',
		'default'  => esc_attr__('Know More', 'i-craft'),		
        'priority' => 1,
    );
    $controls[] = array(
        'type'     => 'text',
        'settings'  => 'itrans_slide4_linkurl',
        'label'    => __( 'Slide4 Link URL', 'i-craft' ),
        'section'  => 'slide4',
		'default'  => esc_url('https://wordpress.org/'),		
        'priority' => 1,
    );
	$controls[] = array(
		'type'        	=> 'upload',
		'settings'     	=> 'itrans_slide4_image',
		'label'       	=> __( 'Slide4 Image', 'i-craft' ),
        'section'  	  	=> 'slide4',
		'default'  		=> esc_url(get_template_directory_uri() . '/images/slide4.jpg'),
		'priority'    	=> 1,
	);
	
	// Blog page setting
	
	$controls[] = array(
		'type'        => 'switch',
		'settings'     => 'slider_stat',
		'label'       => __( 'Hide i-craft Slider', 'i-craft' ),
		'description' => __( 'Turn Off or On to hide/show default i-craft slider', 'i-craft' ),
		'section'     => 'blogpage',
		'default'  => 0,		
		'priority'    => 1,
	);
	
    $controls[] = array(
        'type'     => 'text',
        'settings'  => 'other_front_slider',
        'label'    => __( 'Other Slider Shortcode', 'i-craft' ),
        'section'  => 'blogpage',
		'default'  => '',		
        'priority' => 1,
		'description' => __( 'Enter a 3rd party slider shortcode, ex. meta slider, smart slider 2, wow slider, etc.', 'i-craft' ),		
    );	
	
	
    $controls[] = array(
        'type'     => 'text',
        'settings'  => 'banner_text',
        'label'    => __( 'Banner Text', 'i-craft' ),
        'section'  => 'blogpage',
        'default'  => esc_attr__('Banner Text Here', 'i-craft'),
        'priority' => 1,
		'description' => __( 'if you are using a logo and want your site title or slogan to appear on the header banner', 'i-craft' ),		
    );		
	
	// WooCommerce Settings
	
	// Blog page setting
	
	$controls[] = array(
		'type'        	=> 'switch',
		'settings'     	=> 'hide_login',
		'label'      	=> __( 'Hide Topnav Login', 'i-craft' ),
		'description' 	=> __( 'Hide login menu item from top nav', 'i-craft' ),
		'section'     	=> 'woocomm',
		'default'  		=> '',		
		'priority'    	=> 1,
	);
	
	$controls[] = array(
		'type'        => 'switch',
		'settings'     => 'hide_cart',
		'label'       => __( 'Hide Topnav Cart', 'i-craft' ),
		'description' => __( 'Hide cart from top nav', 'i-craft' ),
		'section'     => 'woocomm',
		'default'  	  => 0,		
		'priority'    => 1,
	);
	
	$controls[] = array(
		'type'        => 'switch',
		'settings'     => 'normal_search',
		'label'       => __( 'Turn On Normal Search', 'i-craft' ),
		'description' => __( 'Product only search will be turned off.', 'i-craft' ),
		'section'     => 'woocomm',
		'default'     => 0,		
		'priority'    => 1,
	);
	
	$controls[] = array(
		'type'        => 'switch',
		'settings'     => 'infi_scroll',
		'label'       => __( 'Turn On Infinite Scroll', 'i-craft' ),
		'description' => __( 'Turn on infinite scroll on product listing and search result pages.', 'i-craft' ),
		'section'     => 'woocomm',
		'default'  	  => 0,		
		'priority'    => 1,
	);
	
	
	$controls[] = array(
		'type'        => 'switch',
		'settings'     => 'prod_popout',
		'label'       => __( 'Turn On Pop-Out Menu', 'i-craft' ),
		'description' => __( 'Turn on pop-out menu for the sidebar product category listing, while sidebar is at left.', 'i-craft' ),
		'section'     => 'woocomm',
		'default'  	  => 0,		
		'priority'    => 1,
	);		
				
	//rmgeneral
	//rmsettings

	$controls[] = array(
		'label' => __('Enable Mobile Navigation', 'i-craft'),
		'description' => __('Check if you want to activate mobile navigation.', 'i-craft'),
		'settings' => 'enabled',
		'default' => 1,
		'type' => 'checkbox',
        'section'  => 'rmgeneral',	
	);
	/*
	$controls[] = array(
		'label' => __('Elements to hide in mobile:', 'i-craft'),
		'description' => __('Enter the css class/ids for different elements you want to hide on mobile separeted by a comma(,). Example: .nav,#main-menu ', 'i-craft'),
		'settings' => 'hide',
		'default' => '',
		'type' => 'text',
        'section'  => 'rmgeneral',		
	);
	*/
	$controls[] = array(
		'label' => __('Enable Swipe', 'i-craft'),
		'description' => __('Enable swipe gesture to open/close menus, Only applicable for left/right menu.', 'i-craft'),
		'settings' => 'swipe',
		'default' => 'yes',
		'choices' => array('yes' => 'Yes','no' => 'No'),
		'type' => 'radio',
        'section'  => 'rmgeneral',		
	);
	
	$controls[] = array(
		'label' => __(' Search...', 'i-craft'),
		'description' => __(' Select the position of search box or simply hide the search box if you donot need it.', 'i-craft'),
		'settings' => 'search_box',
		'default' => 'below_menu',
		'choices' => array('above_menu' => 'Above Menu','below_menu' => 'Below Menu', 'hide'=> 'Hide search box' ),
		'type' => 'select',
        'section'  => 'rmgeneral',		
	);

	$controls[] = array(
		'label' => __(' Search Box Text', 'i-craft'),
		'description' => __('Enter the text that would be displayed on the search box placeholder.', 'i-craft'),
		'settings' => 'search_box_text',
		'default' => __('Search...', 'i-craft'),
		'type' => 'text',
        'section'  => 'rmgeneral',	
	);
		
	$controls[] = array(
		'label' => __('Allow zoom on mobile devices', 'i-craft'),
		'description' => __('', 'i-craft'),
		'settings' => 'zooming',
		'default' => 'yes',
		'choices' => array('yes' => 'Yes','no' => 'No'),
		'type' => 'radio',
        'section'  => 'rmgeneral',	
	);
		

	// Responsive Menu Settings
	$controls[] = array(
		'label' => __('Menu Symbol Position', 'i-craft'),
		'description' => __('Select menu icon position which will be displayed on the menu bar.', 'i-craft'),
		'settings' => 'menu_symbol_pos',
		'default' => 'left',
		'class' => 'mini',
		'choices' => array('left' => 'Left','right' => 'Right'),
		'type' => 'select',
        'section'  => 'rmsettings',	
	);

	$controls[] = array(
		'label' => __('Menu Text', 'i-craft'),
		'description' => __('Entet the text you would like to display on the menu bar.', 'i-craft'),
		'settings' => 'bar_title',
		'default' => __('MENU', 'i-craft'),
		'class' => 'mini',
		'type' => 'text',
        'section'  => 'rmsettings',			
	);

	$controls[] = array(
		'label' => __('Menu Open Direction', 'i-craft'),
		'description' => __('Select the direction from where menu will open.', 'i-craft'),
		'settings' => 'position',
		'default' => 'left',
		'class' => 'mini',
		'choices' => array('left' => 'Left','right' => 'Right', 'top' => 'Top' ),
		'type' => 'select',
        'section'  => 'rmsettings',			
	);

	$controls[] = array(
		'label' => __('Display menu from width (in px)', 'i-craft'),
		'description' => __(' Enter the width (in px) below which the responsive menu will be visible on screen', 'i-craft'),
		'settings' => 'from_width',
		'default' => 1069,
		'class' => 'mini',
		'type' => 'text',
        'section'  => 'rmsettings',			
	);

	$controls[] = array(
		'label' => __('Menu Width', 'i-craft'),
		'description' => __('Enter menu width in (%) only applicable for left and right menu.', 'i-craft'),
		'settings' => 'how_wide',
		'default' => '80',
		'class' => 'mini',
		'type' => 'text',
        'section'  => 'rmsettings',			
	);
	
	$controls[] = array(
		'label' => __('Menu bar background color', 'i-craft'),
		'description' => __('', 'i-craft'),
		'settings' => 'bar_bgd',
		'default' => '#2e2e2e',
		'type' => 'color',
        'section'  => 'rmsettings',			
	);
	
	$controls[] = array(
		'label' => __('Menu bar text color', 'i-craft'),
		'description' => __('', 'i-craft'),
		'settings' => 'bar_color',
		'default' => '#F2F2F2',
		'type' => 'color',
        'section'  => 'rmsettings',			
	);
	
	$controls[] = array(
		'label' => __('Menu background color', 'i-craft'),
		'description' => __('', 'i-craft'),
		'settings' => 'menu_bgd',
		'default' => '#2E2E2E',
		'type' => 'color',
        'section'  => 'rmsettings',			
	);
	
	$controls[] = array(
		'label' => __('Menu text color', 'i-craft'),
		'description' => __('', 'i-craft'),
		'settings' => 'menu_color',
		'default' => '#CFCFCF',
		'type' => 'color',
        'section'  => 'rmsettings',			
	);
	
	$controls[] = array(
		'label' => __('Menu mouse over text color', 'i-craft'),
		'description' => __('', 'i-craft'),
		'settings' => 'menu_color_hover',
		'default' => '#606060',
		'type' => 'color',
        'section'  => 'rmsettings',			
	);
	
	$controls[] = array(
		'label' => __('Menu icon color', 'i-craft'),
		'description' => __('', 'i-craft'),
		'settings' => 'menu_icon_color',
		'default' => '#FFFFFF',
		'type' => 'color',
        'section'  => 'rmsettings',			
	);
	
	$controls[] = array(
		'label' => __('Menu borders(top & left) color', 'i-craft'),
		'description' => __('', 'i-craft'),
		'settings' => 'menu_border_top',
		'default' => '#0D0D0D',
		'type' => 'color',
        'section'  => 'rmsettings',		
	);
	
	$controls[] = array(
		'label' => __('Menu borders(bottom) color', 'i-craft'),
		'description' => __('', 'i-craft'),
		'settings' => 'menu_border_bottom',
		'default' => '#131212',
		'type' => 'color',
        'section'  => 'rmsettings',		
	);
	
	$controls[] = array(
		'label' => __('Enable borders for menu items', 'i-craft'),
		'description' => __('', 'i-craft'),
		'settings' => 'menu_border_bottom_show',
		'default' => 'yes',
		'choices' => array('yes' => 'Yes','no' => 'No'),
		'type' => 'radio',
        'section'  => 'rmsettings',			
	);
	
	// i-design typography
	$controls[] = array(
		'type'        => 'typography',
		'settings'    => 'body_font',
		'label'       => __( 'Body Font Style', 'i-craft' ),
		'description' => __( 'Content font style (Variant and Subsets are not used). Default font "Roboto" Default font "Open Sans", size "14"', 'i-craft' ),
		'section'     => 'typography',
		'default'     => array(
			//'font-style'     => array( 'normal', 'bold', 'italic' ),
			'font-family'    => 'Open Sans',
			'font-size'      => '14',
			'color'          => '#575757',			
			'subsets'        => 'none',
		),
		'priority'    => 1,
		'choices' => array(
			'fonts' => array(
				'google'   => array( 'popularity', 50 ),
				'standard' => array(
					'Georgia,Times,"Times New Roman",serif',
					'Roboto, Oxygen-Sans, Ubuntu, Cantarell, "Helvetica Neue", sans-serif'
				),
			),
		),	
	);
	
	$controls[] = array(
		'type'        => 'typography',
		'settings'    => 'title_font',
		'label'       => __( 'Heading Font Style', 'i-craft' ),
		'description' => __( 'Title font style (Variant and Subsets are not used). Default font "Roboto"', 'i-craft' ),
		'section'     => 'typography',
		'default'     => array(
			//'font-style'     => array( 'normal', 'bold', 'italic' ),
			'font-family'    => 'Roboto',
			'subsets'        => 'none',
		),
		'priority'    => 1,
		'choices' => array(
			'fonts' => array(
				'google'   => array( 'popularity', 50 ),
				'standard' => array(
					'Georgia,Times,"Times New Roman",serif',
					'Roboto, Oxygen-Sans, Ubuntu, Cantarell, "Helvetica Neue", sans-serif'
				),
			),
		),	
	);

	/*
    $controls[] = array(
        'type'     => 'text',
        'settings'  => 'blogslide_scode',
        'label'    => __( 'Other Slider Shortcode', 'i-craft' ),
        'section'  => 'blogpage',
        'default'  => '',
		'description' => __( 'Enter a 3rd party slider shortcode, ex. meta slider, smart slider 2, wow slider, etc.', 'i-craft' ),
        'priority' => 2,
    );
	*/
	
	$controls[] = array(
		'type'        => 'switch',
		'settings'     => 'mmode_status',
		'label'       => __( 'Turn ON Maintenance Mode', 'i-craft' ),
		'description' => esc_attr__( 'Logged in admins will view a normal site.', 'i-craft' ),
		'section'     => 'mmode',
		'default'  	  => 0,		
		'priority'    => 1,
	);	

	$controls[] = array(
		'label' => esc_attr__( 'Title', 'i-craft'),
		'description' => __('Maintanance mode/coming soon title', 'i-craft'),
		'settings' => 'mmode_title',
		'default' => esc_attr__( 'Under Maintenance', 'i-craft' ),
		'class' => '',
		'type' => 'text',
        'section'  => 'mmode',
		'priority'    => 2,		
	);

	$controls[] = array(
		'label' => esc_attr__( 'Description', 'i-craft'),
		'description' => __('Maintanance mode/coming soon description', 'i-craft'),
		'settings' => 'mmode_desc',
		'default' => esc_attr__( 'We are currently in maintenance mode. Please check back shortly.', 'i-craft' ),
		'class' => '',
		'type' => 'textarea',
        'section'  => 'mmode',
		'priority'    => 3,					
	);
	
	$controls[] = array(
		'type'        => 'background',
		'settings'    => 'mmode_bg',
		'label'       => esc_attr__( 'Background', 'i-craft' ),
		'description' => esc_attr__( 'Background image and color', 'i-craft' ),
		'section'     => 'mmode',
		'default'     => array(
			'background-color'      => 'rgba(20,20,20,.8)',
			'background-image'      => get_template_directory_uri() . '/images/bg-7.jpg',
			'background-repeat'     => 'repeat',
			'background-position'   => 'center center',
			'background-size'       => 'cover',
			'background-attachment' => 'scroll',
		),
		'priority'    => 4,		
	);	
	
	$controls[] = array(
	  'type'        => 'date',
	  'settings'    => 'mmode_days',
	  'label'       => esc_html__( 'Date', 'i-craft' ),
	  'description' => __( 'Estimated maintanance until', 'i-craft' ),
	  'section'     => 'mmode',
	  /*
	  'default'     => 12,
	  
	  'choices'     => array(
		'min'  => '0',
		'max'  => '100',
		'step' => '1',
	  ),
	  */	  
	);
	$controls[] = array(
	  'type'        => 'slider',
	  'settings'    => 'mmode_hours',
	  'label'       => esc_html__( 'Hours', 'i-craft' ),
	  'description' => __( 'Estimated hours add to days', 'i-craft' ),
	  'section'     => 'mmode',
	  'default'     => 16,
	  'choices'     => array(
		'min'  => '0',
		'max'  => '24',
		'step' => '1',
	  ),	  
	);	
	
	// promos
	$controls[] = array(
		'type'        => 'custom',
		'settings'    => 'custom_demo',
		'label' => __( 'TemplatesNext Promo', 'i-craft' ),
		'section'     => 'nxpromo',
		'default'	  => '<div class="promo-box">
        <div class="promo-2">
        	<div class="promo-wrap">
                <a href="http://templatesnext.org/ispirit/landing/" target="_blank">Go Premium</a>  			
            	<a href="http://templatesnext.org/i-craft/" target="_blank">i-craft Demos</a>
                <a href="https://www.facebook.com/templatesnext" target="_blank">Facebook</a> 
                <a href="http://templatesnext.org/ispirit/landing/forums/" target="_blank">Support</a>                                 
                <!-- <a href="http://templatesnext.org/icraft/docs">Documentation</a> -->
                <a href="https://wordpress.org/support/view/theme-reviews/i-craft#postform" target="_blank">Rate i-craft</a>                
                <div class="donate">                
                    <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
                    <input type="hidden" name="cmd" value="_s-xclick">
                    <input type="hidden" name="hosted_button_id" value="M2HN47K2MQHAN">
                    <table>
                    <tr><td><input type="hidden" name="on0" value="If you like my work, you can buy me">If you like my work, you can buy me</td></tr><tr><td><select name="os0">
                        <option value="a cup of coffee">1 cup of coffee $10.00 USD</option>
                        <option value="2 cup of coffee">2 cup of coffee $20.00 USD</option>
                        <option value="3 cup of coffee">3 cup of coffee $30.00 USD</option>
                    </select></td></tr>
                    </table>
                    <input type="hidden" name="currency_code" value="USD">
                    <input type="image" src="https://www.paypalobjects.com/en_GB/i/btn/btn_buynowCC_LG.gif" border="0" name="submit" alt="PayPal – The safer, easier way to pay online.">
                    <img alt="" border="0" src="https://www.paypalobjects.com/en_GB/i/scr/pixel.gif" width="1" height="1">
                    </form>
                </div>                                                                          
            </div>
        </div>
		</div>',
		'priority' => 10,
	);	
	
    return $controls;
}
add_filter( 'kirki/controls', 'icraft_custom_setting' );







