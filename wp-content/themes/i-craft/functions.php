<?php
/**
 * i-craft functions and definitions
 *
 * Sets up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * When using a child theme (see http://codex.wordpress.org/Theme_Development
 * and http://codex.wordpress.org/Child_Themes), you can override certain
 * functions (those wrapped in a function_exists() call) by defining them first
 * in your child theme's functions.php file. The child theme's functions.php
 * file is included before the parent theme's file, so the child theme
 * functions would be used.
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are
 * instead attached to a filter or action hook.
 *
 * For more information on hooks, actions, and filters, @link http://codex.wordpress.org/Plugin_API
 *
 * @package i-craft
 * @since i-craft 1.0
 */

/*
 * Set up the content width value based on the theme's design.
 *
 * @see icraft_content_width() for template-specific adjustments.
 */
if ( ! isset( $content_width ) )
	$content_width = 604;


/**
 * i-craft only works in WordPress 3.6 or later.
 */

/**
 * i-craft setup.
 *
 * Sets up theme defaults and registers the various WordPress features that
 * i-craft supports.
 *
 * @uses load_theme_textdomain() For translation/localization support.  
 * @uses add_editor_style() To add Visual Editor stylesheets.
 * @uses add_theme_support() To add support for automatic feed links, post
 * formats, and post thumbnails.
 * @uses register_nav_menu() To add support for a navigation menu.
 * @uses set_post_thumbnail_size() To set a custom post thumbnail size.
 *
 * @since i-craft 1.0
 *
 * @return void
 */
function icraft_setup() {
	/*
	 * Makes i-craft available for translation.
	 *
	 * Translations can be added to the /languages/ directory.
	 * If you're building a theme based on i-craft, use a find and
	 * replace to change 'i-craft' to the name of your theme in all
	 * template files.
	 */
	load_theme_textdomain( 'i-craft', get_template_directory() . '/languages' );

	/*
	 * This theme styles the visual editor to resemble the theme style,
	 * specifically font, colors, icons, and column width.
	 */
	add_editor_style( array( 'css/editor-style.css', 'fonts/genericons.css', icraft_fonts_url() ) );

	// Adds RSS feed links to <head> for posts and comments.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Switches default core markup for search form, comment form,
	 * and comments to output valid HTML5.
	 */
	add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list' ) );

	/*
	 * This theme supports all available post formats by default.
	 * See http://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside', 'audio', 'chat', 'gallery', 'image', 'link', 'quote', 'status', 'video'
	) );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menu( 'primary', __( 'Navigation Menu', 'i-craft' ) );
	
	// add title tag support since WordPress 4.1 
	add_theme_support( 'title-tag' );	

	/*
	 * This theme uses a custom image size for featured images, displayed on
	 * "standard" posts and pages.
	 */
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 604, 270, true );

	/*
	 * additional Image sizes.
	 */
	add_image_size( 'icraft-slider-thumb', 1600, 900, true ); //(cropped)	
	add_image_size( 'icraft-single-thumb', 1200, 480, true ); //(cropped)
	
	
	$icraft_defaults_bg = array(
		'default-color'          => '#f3f1ed',
		'default-image'          => get_template_directory_uri() . '/images/bg7.jpg',
		'default-repeat'         => 'repeat',
		'default-position-x'     => 'center',
		'default-attachment'	 => 'fixed',
		'default-size'	 => 'cover'
	);		
	
	// Custom Background 
	add_theme_support( 'custom-background', $icraft_defaults_bg );
	
	// This theme uses its own gallery styles.
	add_filter( 'use_default_gallery_style', '__return_false' );
	
	// Add Support for woocommerce
	add_theme_support( 'woocommerce' );	
	
	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );	
}
add_action( 'after_setup_theme', 'icraft_setup' );

/**
 * Return the Google font stylesheet URL, if available.
 *
 * The use of Source Sans Pro and Bitter by default is localized. For languages
 * that use characters not supported by the font, the font can be disabled.
 *
 * @since i-craft 1.0
 *
 * @return string Font stylesheet or empty string if disabled.
 */
function icraft_fonts_url() {
	$fonts_url = '';

	/* Translators: If there are characters in your language that are not
	 * supported by Open Sans, translate this to 'off'. Do not translate
	 * into your own language.
	 */
	 //fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,400,300,600,700|Roboto:400,400italic,500italic,700italic'
	$open_sans = _x( 'on', 'Open Sans font: on or off', 'i-craft' );

	/* Translators: If there are characters in your language that are not
	 * supported by Roboto, translate this to 'off'. Do not translate into your
	 * own language.
	 */
	$roboto = _x( 'on', 'Roboto font: on or off', 'i-craft' );

	if ( 'off' !== $open_sans || 'off' !== $roboto ) {
		$font_families = array();

		if ( 'off' !== $open_sans )
			$font_families[] = 'Open Sans:300,400,700,300italic,400italic,700italic';

		if ( 'off' !== $roboto )
			$font_families[] = 'Roboto:300,400,700';

		$query_args = array(
			'family' => urlencode( implode( '|', $font_families ) ),
			'subset' => urlencode( 'latin,latin-ext' ),
		);
		$fonts_url = add_query_arg( $query_args, "//fonts.googleapis.com/css" );
	}

	return $fonts_url;
}

/**
 * Enqueue scripts and styles for the front end.
 *
 * @since i-craft 1.0
 *
 * @return void
 */
function icraft_scripts_styles() {
	/*
	 * Adds JavaScript to pages with the comment form to support
	 * sites with threaded comments (when in use).
	 */
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );
		
	// load masonry for footer and post layout
	wp_enqueue_script( 'jquery-masonry' );	

	// Loads JavaScript file with functionality specific to i-craft.
	wp_enqueue_script( 'modernizer-custom', get_template_directory_uri() . '/js/modernizr.custom.js', array( 'jquery' ), '2014-01-13', true );
	
	// Loads JavaScript file for scroll related functions and animations.
	wp_enqueue_script( 'icraft-waypoint', get_template_directory_uri() . '/js/waypoints.min.js', array( 'jquery' ), '2014-01-13', true );
	
	// Loads JavaScript file for small screen side menu.
	wp_enqueue_script( 'icraft-sidr', get_template_directory_uri() . '/js/jquery.sidr.min.js', array( 'jquery' ), '2014-01-13', true );
	
	// Loads JavaScript file for small screen side menu.
	wp_enqueue_script( 'owl-carousel', get_template_directory_uri() . '/js/owl.carousel.min.js', array( 'jquery' ), '2014-01-13', true );
	
	wp_enqueue_script( 'infinitescroll', get_template_directory_uri() . '/js/jquery.infinitescroll.min.js', array( 'jquery' ), '2017-01-16', true );	
	
	// Loads JavaScript file with functionality specific to i-craft.
	wp_enqueue_script( 'icraft-script', get_template_directory_uri() . '/js/functions.js', array( 'jquery' ), '2018-05-22', true );
	
	
	//blog_layout
	$blog_layout = get_theme_mod('blog_layout', 'onecol');

	// Add Source Sans Pro and Bitter fonts, used in the main stylesheet.
	wp_enqueue_style( 'icraft-fonts', icraft_fonts_url(), array(), null );

	// Add Genericons font, used in the main stylesheet.
	wp_enqueue_style( 'genericons', get_template_directory_uri() . '/fonts/genericons.css', array(), '2.09' );
	
	// Add Animate stle, used used for css animations.
	wp_enqueue_style( 'animate', get_template_directory_uri() . '/css/animate.min.css', array(), '2014-01-12' );
	
	// Add Animate stle, used used for side menu.
	wp_enqueue_style( 'side-menu', get_template_directory_uri() . '/css/jquery.sidr.dark.css', array(), '2014-01-12' );	
	
	// Add owl-carusel style
	wp_enqueue_style( 'owl-carousel', get_template_directory_uri() . '/css/owl.carousel.css', array(), '2014-01-12' );
	
	// Add owl-carusel theme
	wp_enqueue_style( 'owl-carousel-theme', get_template_directory_uri() . '/css/owl.theme.css', array(), '2014-01-12' );	
	
	// Add owl-carusel transition
	wp_enqueue_style( 'owl-carousel-transitions', get_template_directory_uri() . '/css/owl.transitions.css', array(), '2014-01-12' );				
	
	// Loads our main stylesheet.
	wp_enqueue_style( 'icraft-style', get_stylesheet_uri(), array(), '2016-07-18' );
	
	// blog posts layout style
	if ( $blog_layout == 'twocol' ) {
		wp_enqueue_style( 'itrans-blog-layout', get_template_directory_uri() . '/css/twocol-blog.css', array(), '2014-03-11' );	
	}

	// Loads the Internet Explorer specific stylesheet.
	wp_enqueue_style( 'icraft-ie', get_template_directory_uri() . '/css/ie.css', array( 'icraft-style' ), '2018-05-22' );
	wp_style_add_data( 'icraft-ie', 'conditional', 'lt IE 9' );
	
	
	wp_enqueue_style( 'itrans-extra-stylesheet', get_template_directory_uri() . '/css/extra-style.css', array(), '2014-03-11' );
	$custom_css = htmlspecialchars_decode( get_theme_mod('itrans_extra_style', ''));
	
	if ( $custom_css ) {
		wp_add_inline_style( 'itrans-extra-stylesheet', $custom_css );
	}
}
add_action( 'wp_enqueue_scripts', 'icraft_scripts_styles' );

/**
 * add body class for boxed layout.
 *
 * @since i-craft 1.0
 */
add_filter( 'body_class', 'icraft_layout_body_class' );
function icraft_layout_body_class( $classes ) {
	// add 'class-name' to the $classes array
	
	if ( get_theme_mod('wide_layout', 1) ) {
		$classes[] = 'nx-wide';		
	} else {
		$classes[] = 'nx-boxed';
	}
	
	if ( get_theme_mod('sidebar_side', 0) ) {
		$classes[] = 'nx-leftsidebar';		
	}
	
	// return the $classes array
	return $classes;
}


/**
 * Register two widget areas.
 *
 * @since i-craft 1.0
 *
 * @return void
 */
function icraft_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Main Bottom Widget Area', 'i-craft' ),
		'id'            => 'sidebar-1',
		'description'   => __( 'Appears in the footer section of the site.', 'i-craft' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Main Sidebar Widget Area', 'i-craft' ),
		'id'            => 'sidebar-2',
		'description'   => __( 'Appears on posts and pages in the sidebar.', 'i-craft' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
    
}
add_action( 'widgets_init', 'icraft_widgets_init' );

if ( ! function_exists( 'icraft_paging_nav' ) ) :
/**
 * Display navigation to next/previous set of posts when applicable.
 *
 * @since i-craft 1.0
 *
 * @return void
 */
function icraft_paging_nav() {
	
	global $wp_query;

	// Don't print empty markup if there's only one page.
	if ( $wp_query->max_num_pages < 2 )
		return;
	?>
    <?php
		$big = 999999999; // need an unlikely integer
		$args = array(
			'base' => str_replace( $big, '%#%', get_pagenum_link( $big ) ),
			'format' => '?paged=%#%',
			'current' => max( 1, get_query_var('paged') ),
			'total' => $wp_query->max_num_pages,
			'type' => 'list',
			'prev_text' => '<span class="text">&laquo; ' . __( 'Previous', 'i-craft' ) . '</span>',
			'next_text' => '<span class="text">' . __( 'Next', 'i-craft' ) . ' &raquo;</span>',
			'add_args' => false					
		);
	?>				    
	<nav class="navigation paging-navigation" role="navigation">
		<h1 class="screen-reader-text"><?php _e( 'Posts navigation', 'i-craft' ); ?></h1>
		<div class="nav-links">
            <div id="posts-nav" class="navigation">
				<?php echo paginate_links( $args ); ?>
            </div><!-- #posts-nav -->
		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}
endif;

if ( ! function_exists( 'icraft_post_nav' ) ) :
/**
 * Display navigation to next/previous post when applicable.
*
* @since i-craft 1.0
*
* @return void
*/
function icraft_post_nav() {
	global $post;

	// Don't print empty markup if there's nowhere to navigate.
	$previous = ( is_attachment() ) ? get_post( $post->post_parent ) : get_adjacent_post( false, '', true );
	$next     = get_adjacent_post( false, '', false );

	if ( ! $next && ! $previous )
		return;
	?>
	<nav class="navigation post-navigation" role="navigation">
		<h1 class="screen-reader-text"><?php _e( 'Post navigation', 'i-craft' ); ?></h1>
		<div class="nav-links">

			<?php previous_post_link( '%link', _x( '<span class="meta-nav">&larr;</span> %title', 'Previous post link', 'i-craft' ) ); ?>
			<?php next_post_link( '%link', _x( '%title <span class="meta-nav">&rarr;</span>', 'Next post link', 'i-craft' ) ); ?>

		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}
endif;


// Add specific CSS class by filter

add_filter( 'body_class', 'twocol_blog_body_class' );
function twocol_blog_body_class( $classes ) {

	$blog_layout = 'onecol';
	
	$blog_layout = get_theme_mod('blog_layout', 'onecol');
	
	if ( $blog_layout == 'twocol' ) {
		// add 'class-name' to the $classes array
		$classes[] = 'twocol-blog';
		// return the $classes array
	} else
	{
		$classes[] = 'onecol-blog';
	}
	return $classes;	
}


if ( ! function_exists( 'icraft_entry_meta' ) ) :
/**
 * Print HTML with meta information for current post: categories, tags, permalink, author, and date.
 *
 * Create your own icraft_entry_meta() to override in a child theme.
 *
 * @since i-craft 1.0
 *
 * @return void
 */
function icraft_entry_meta() {
	if ( is_sticky() && is_home() && ! is_paged() )
		echo '<span class="featured-post">' . __( 'Sticky', 'i-craft' ) . '</span>';

	if ( ! has_post_format( 'link' ) && 'post' == get_post_type() )
		icraft_entry_date();

	// Translators: used between list items, there is a space after the comma.
	$categories_list = get_the_category_list( __( ', ', 'i-craft' ) );
	if ( $categories_list ) {
		echo '<span class="categories-links">' . $categories_list . '</span>';
	}

	// Translators: used between list items, there is a space after the comma.
	$tag_list = get_the_tag_list( '', __( ', ', 'i-craft' ) );
	if ( $tag_list ) {
		echo '<span class="tags-links">' . $tag_list . '</span>';
	}

	// Post author
	if ( 'post' == get_post_type() ) {
		printf( '<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s" rel="author">%3$s</a></span>',
			esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
			esc_attr( sprintf( __( 'View all posts by %s', 'i-craft' ), get_the_author() ) ),
			get_the_author()
		);
	}
}
endif;

if ( ! function_exists( 'icraft_entry_date' ) ) :
/**
 * Print HTML with date information for current post.
 *
 * Create your own icraft_entry_date() to override in a child theme.
 *
 * @since i-craft 1.0
 *
 * @param boolean $echo (optional) Whether to echo the date. Default true.
 * @return string The HTML-formatted post date.
 */
function icraft_entry_date( $echo = true ) {
	if ( has_post_format( array( 'chat', 'status' ) ) )
		$format_prefix = _x( '%1$s on %2$s', '1: post format name. 2: date', 'i-craft' );
	else
		$format_prefix = '%2$s';

	$date = sprintf( '<span class="date"><a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s">%4$s</time></a></span>',
		esc_url( get_permalink() ),
		esc_attr( sprintf( __( 'Permalink to %s', 'i-craft' ), the_title_attribute( 'echo=0' ) ) ),
		esc_attr( get_the_date( 'c' ) ),
		esc_html( sprintf( $format_prefix, get_post_format_string( get_post_format() ), get_the_date() ) )
	);

	if ( $echo )
		echo $date;

	return $date;
}
endif;

if ( ! function_exists( 'icraft_the_attached_image' ) ) :
/**
 * Print the attached image with a link to the next attached image.
 *
 * @since i-craft 1.0
 *
 * @return void
 */
function icraft_the_attached_image() {
	/**
	 * Filter the image attachment size to use.
	 *
	 * @since i-craft 1.0
	 *
	 * @param array $size {
	 *     @type int The attachment height in pixels.
	 *     @type int The attachment width in pixels.
	 * }
	 */
	$attachment_size     = apply_filters( 'icraft_attachment_size', array( 724, 724 ) );
	$next_attachment_url = wp_get_attachment_url();
	$post                = get_post();

	/*
	 * Grab the IDs of all the image attachments in a gallery so we can get the URL
	 * of the next adjacent image in a gallery, or the first image (if we're
	 * looking at the last image in a gallery), or, in a gallery of one, just the
	 * link to that image file.
	 */
	$attachment_ids = get_posts( array(
		'post_parent'    => $post->post_parent,
		'fields'         => 'ids',
		'numberposts'    => -1,
		'post_status'    => 'inherit',
		'post_type'      => 'attachment',
		'post_mime_type' => 'image',
		'order'          => 'ASC',
		'orderby'        => 'menu_order ID'
	) );

	// If there is more than 1 attachment in a gallery...
	if ( count( $attachment_ids ) > 1 ) {
		foreach ( $attachment_ids as $attachment_id ) {
			if ( $attachment_id == $post->ID ) {
				$next_id = current( $attachment_ids );
				break;
			}
		}

		// get the URL of the next image attachment...
		if ( $next_id )
			$next_attachment_url = get_attachment_link( $next_id );

		// or get the URL of the first image attachment.
		else
			$next_attachment_url = get_attachment_link( array_shift( $attachment_ids ) );
	}

	printf( '<a href="%1$s" title="%2$s" rel="attachment">%3$s</a>',
		esc_url( $next_attachment_url ),
		the_title_attribute( array( 'echo' => false ) ),
		wp_get_attachment_image( $post->ID, $attachment_size )
	);
}
endif;

/**
 * Return the post URL.
 *
 * @uses get_url_in_content() to get the URL in the post meta (if it exists) or
 * the first link found in the post content.
 *
 * Falls back to the post permalink if no URL is found in the post.
 *
 * @since i-craft 1.0
 *
 * @return string The Link format URL.
 */
function icraft_get_link_url() {
	$content = get_the_content();
	$has_url = get_url_in_content( $content );

	return ( $has_url ) ? $has_url : apply_filters( 'the_permalink', get_permalink() );
}

/**
 * Extend the default WordPress body classes.
 *
 * Adds body classes to denote:
 * 1. Single or multiple authors.
 * 2. Active widgets in the sidebar to change the layout and spacing.
 * 3. When avatars are disabled in discussion settings.
 *
 * @since i-craft 1.0
 *
 * @param array $classes A list of existing body class values.
 * @return array The filtered body class list.
 */
function icraft_body_class( $classes ) {
	
	global $post; 
	
	$icraft_page_class = $icraft_page_nopad = $icraft_trans_header = $icraft_no_ubar = "";
	
	if ( function_exists( 'rwmb_meta' ) ) {
		$icraft_page_class = rwmb_meta('icraft_page_class');
		$icraft_page_nopad = rwmb_meta('icraft_page_nopad');
		$icraft_no_ubar = rwmb_meta('icraft_no_ubar');		
		$icraft_trans_header = rwmb_meta('icraft_trans_header');		
	}
		
	if ( ! is_multi_author() )
		$classes[] = 'single-author';

	if ( is_active_sidebar( 'sidebar-2' ) && ! is_attachment() && ! is_404() )
		$classes[] = 'sidebar';

	if ( ! get_option( 'show_avatars' ) )
		$classes[] = 'no-avatars';
		
	$infi_scroll = get_theme_mod('infi_scroll', 0);	
	if ( $infi_scroll == 1 )
	{
		$classes[] = 'woo-infiscroll';
	}
	
	if( ! empty($icraft_page_class) )
		$classes[] = esc_attr($icraft_page_class);
	
	if( $icraft_page_nopad == 1 )
		$classes[] = 'tx-nopad';

	if( $icraft_no_ubar == 1 )
		$classes[] = 'tx-noubar';		
		
	if( $icraft_trans_header == 1 )
		$classes[] = 'nx-fullscreen';		
		
	// Add PreLoader Class
	if( get_theme_mod('pre_loader', 0) == 1 )
		$classes[] = 'nx-preloader';
		
	// Add PreLoader Class
	if( get_theme_mod('prod_popout', 0) == 1 )
		$classes[] = 'nx-prod-pop';	
		
	// Boxed Navigation Icons
	if( get_theme_mod('boxed-icons', 0) == 1 )
		$classes[] = 'nx-nav-boxedicons';
		
	// Top Nav Menu Items to UPPERCASE
	if( get_theme_mod('nav_upper', 0) == 1 )
		$classes[] = 'nx-nav-uppercase';
		
	if ( is_page_template( 'page_full-width.php' ) ) {
		$classes[] = 'nx-full-width';
	}
	
	if ( get_theme_mod('show_search', 1) == 1 )	{
		$classes[] = 'nx-show-search';
	} else 	{
		$classes[] = 'nx-no-search';
	}					

	return $classes;
}
add_filter( 'body_class', 'icraft_body_class' );

/**
 * Adjust content_width value for video post formats and attachment templates.
 *
 * @since i-craft 1.0
 *
 * @return void
 */
function icraft_content_width() {
	global $content_width;

	if ( is_attachment() )
		$content_width = 724;
	elseif ( has_post_format( 'audio' ) )
		$content_width = 484;
}
add_action( 'template_redirect', 'icraft_content_width' );

/**
 * Add postMessage support for site title and description for the Customizer.
 *
 * @since i-craft 1.0
 *
 * @param WP_Customize_Manager $wp_customize Customizer object.
 * @return void
 */
function icraft_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
	
	
	$wp_customize->selective_refresh->add_partial( 'basic', array(
		'selector' => '.site-header .home-link',
		'settings' => array( 'logo' ),
		//'render_callback' => 'twentyfifteen_customize_partial_blogname',
	) );
	
	$wp_customize->selective_refresh->add_partial( 'cart-1', array(
		'selector' => '.header-iconwrap .woocart',
		'settings' => array( 'hide_cart' ),
		//'render_callback' => 'twentyfifteen_customize_partial_blogname',
	) );
	
	$wp_customize->selective_refresh->add_partial( 'basic-1', array(
		'selector' => '.ubarinnerwrap .topphone',
		'settings' => array( 'top_phone' ),
		//'render_callback' => 'twentyfifteen_customize_partial_blogname',
	) );
	
	$wp_customize->selective_refresh->add_partial( 'social-icons', array(
		'selector' => '.home .titlebar .entry-title',
		'settings' => array( 'banner_text' ),
		//'render_callback' => 'twentyfifteen_customize_partial_blogname',
	) );
	
	
	$wp_customize->selective_refresh->add_partial( 'entry-title', array(
		'selector' => '.socialicons',
		'settings' => array( 'itrans_social_facebook' ),
		//'render_callback' => 'twentyfifteen_customize_partial_blogname',
	) );					
	
}
add_action( 'customize_register', 'icraft_customize_register' );

/**
 * Enqueue Javascript postMessage handlers for the Customizer.
 *
 * Binds JavaScript handlers to make the Customizer preview
 * reload changes asynchronously.
 *
 * @since i-craft 1.0
 *
 * @return void
 */
 

function icraft_customize_preview_js() {
	wp_enqueue_script( 'icraft-customizer', get_template_directory_uri() . '/js/theme-customizer.js', array( 'customize-preview' ), '20130226', true );
}
add_action( 'customize_preview_init', 'icraft_customize_preview_js' );

function icraft_customizer_control() {
    wp_enqueue_script('customize_control_init', get_template_directory_uri() . '/js/theme-customizer-control.js', array( 'jquery' ), '1.0.2', true ); 
}
add_action( 'customize_controls_enqueue_scripts', 'icraft_customizer_control' );


/*-----------------------------------------------------------------------------------*/
/*	Metabox
/*-----------------------------------------------------------------------------------*/ 
/*
if ( !function_exists( 'rwmb_meta' ) ) {
	include( get_template_directory() . '/inc/meta-box/meta-box.php');
}
*/
if ( function_exists( 'rwmb_meta' ) ) {
	include( get_template_directory() . '/inc/tnext-meta.php' );
}


/*-----------------------------------------------------------------------------------*/
/*	Custom Functions
/*-----------------------------------------------------------------------------------*/ 

include get_template_directory() . '/inc/custom_functions.php';

include get_template_directory() . '/inc/icraft-custom-style.php';

include get_template_directory() . '/inc/woo-functions.php';

/*-----------------------------------------------------------------------------------*/
/*	Maintanance mode on
/*-----------------------------------------------------------------------------------*/ 
$mmode_status = get_theme_mod('mmode_status', 0);
if($mmode_status == 1) {
	include get_template_directory() . '/inc/m-mode/m-mode.php';
}

/*-----------------------------------------------------------------------------------*/
/*	changing default Excerpt length 
/*-----------------------------------------------------------------------------------*/ 

function icraft_excerpt_length($length) {
	return 32;
}
add_filter('excerpt_length', 'icraft_excerpt_length');


/*-----------------------------------------------------------------------------------*/
/*	changing changing default read more text 
/*-----------------------------------------------------------------------------------*/ 
function icraft_excerpt_more($more) {
       global $post;
	return '<a class="moretag" href="'. get_permalink($post->ID) . '">'. __( 'Read More...', 'i-craft' ). '</a>';
}
add_filter('excerpt_more', 'icraft_excerpt_more');



/*
 * Loads the Options Panel
 *
 * If you're loading from a child theme use stylesheet_directory
 * instead of template_directory
 */

define( 'OPTIONS_FRAMEWORK_DIRECTORY', get_template_directory_uri() . '/inc/' );
require_once dirname( __FILE__ ) . '/inc/options-framework.php';


/*-----------------------------------------------------------------------------------*/
/*	Adding customizer with kirki 
/*-----------------------------------------------------------------------------------*/ 
include_once( dirname( __FILE__ ) . '/nx-customizer.php' );
include_once( dirname( __FILE__ ) . '/inc/kirki/kirki.php' );

/*-----------------------------------------------------------------------------------*/
/*	Adding Responsive Menu
/*-----------------------------------------------------------------------------------*/ 
include get_template_directory() . '/inc/responsive-menu/responsive-menu.php';

// Remove WooCommerce Native Breadcrumb
add_action( 'init', 'icraft_remove_wc_breadcrumbs' );
function icraft_remove_wc_breadcrumbs() {
	remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );
}

/**
 * Add a stylesheet for admin panels
 * @since i-spirit 1.0
 */
add_action('admin_init', 'icraft_admin_css');
function icraft_admin_css() {
   wp_register_style( 'icraft-admin-css', get_template_directory_uri() . '/css/admin-style.css' );
   wp_enqueue_style( 'icraft-admin-css' );
}

add_action( 'admin_enqueue_scripts', 'icraft_admin_js' );
function icraft_admin_js() {
    wp_enqueue_script( 'icraft-admin-script', get_template_directory_uri() . '/js/admin-script.js' );
}

// Adding TGM Plugin activation
require_once dirname( __FILE__ ) . '/inc/class-tgm-plugin-activation.php';

add_action( 'tgmpa_register', 'icraft_register_required_plugins' );
function icraft_register_required_plugins() {

    /**
* Array of plugin arrays. Required keys are name and slug.
* If the source is NOT from the .org repo, then source is also required.
*/
    $plugins = array(
         // This is an example of how to include a plugin from a private repo in your theme.
        array(
            'name' => 'TemplatesNext ToolKit', // The plugin name.
            'slug' => 'templatesnext-toolkit', // The plugin slug (typically the folder name).
            'required' => false, // If false, the plugin is only 'recommended' instead of required.
        ),
    );

    /**
* Array of configuration settings. Amend each line as needed.
* If you want the default strings to be available under your own theme domain,
* leave the strings uncommented.
* Some of the strings are added into a sprintf, so see the comments at the
* end of each line for what each argument will be.
*/
    $config = array(
        'id' => 'tgmpa', // Unique ID for hashing notices for multiple instances of TGMPA.
        'default_path' => '', // Default absolute path to pre-packaged plugins.
        'menu' => 'tgmpa-install-plugins', // Menu slug.
		'parent_slug'  => 'themes.php',            // Parent menu slug.
		'capability'   => 'edit_theme_options',    // Capability needed to view plugin install page, should be a capability associated with the parent menu used.		
        'has_notices' => true, // Show admin notices or not.
        'dismissable' => true, // If false, a user cannot dismiss the nag message.
        'dismiss_msg' => '', // If 'dismissable' is false, this message will be output at top of nag.
        'is_automatic' => false, // Automatically activate plugins after installation or not.
        'message' => '', // Message to output right before the plugins table.
    );

    tgmpa( $plugins, $config );

}


add_action('admin_notices', 'icraft_admin_notice_006');
function icraft_admin_notice_006() {
    global $current_user ;
        $user_id = $current_user->ID;
		$support_url = esc_url('https://wordpress.org/support/theme/i-craft/');
		$notice_url = esc_url('https://wordpress.org/support/theme/i-craft/reviews/?filter=5');
    if ( ! get_user_meta($user_id, 'icraft_ignore_notice_006') ) {
        echo '<div class="updated"><p><div style="line-height: 20px;">'; 
		echo esc_html__('i-craft 3.0.2 receives major updates, New theme options and page options were added. Meta Box functionality (page options) were moved to accompanying plugin &quot;TemplatesNext ToolKit&quot; for more flexibility.', 'i-craft');
		echo '<br />';
		echo esc_html__('Use page template &quot;TX Full Width&quot; for inserting page builder pre-built layouts. ', 'i-craft');		
		printf(__('Use the  <a href="%1$s" target="_blank">support forum</a> to report an issue.', 'i-craft'), $support_url);
		//printf(__('<br>If you like our work please take couple of minutes to provide i-craft a review <a href="%1$s" target="_blank">here</a>, that helps us a lot.', 'i-craft'), $notice_url);
		printf(__('<br><a href="%1$s"><span class="dismiss-cross">X</span><span class="dismiss-text">Dismiss Tthis Notice</span></a><div class="clear"></div>', 'i-craft' ), '?icraft_notice_ignore_006=0');
        echo "</div></p></div>";
    }
}

add_action('admin_init', 'icraft_notice_ignore_006');
function icraft_notice_ignore_006() {
    global $current_user;
	$user_id = $current_user->ID;
	if ( isset($_GET['icraft_notice_ignore_006']) && '0' == $_GET['icraft_notice_ignore_006'] ) {
    	add_user_meta($user_id, 'icraft_ignore_notice_006', 'true', true);
    }
}
/**/