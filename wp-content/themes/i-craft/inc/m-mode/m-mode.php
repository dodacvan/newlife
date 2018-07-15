<?php

function icraft_mmode_enqueue_scripts() {
	
	if ( !current_user_can( 'edit_themes' ) || !is_user_logged_in() ) {	
	
	
			wp_enqueue_style( 'flipclock', get_template_directory_uri() . '/inc/m-mode/css/flipclock.css', array(), '1.0.1' );
			wp_enqueue_style( 'm-mode-style', get_template_directory_uri() . '/inc/m-mode/css/m-mode.css', array(), '1.0.1' );	
			
			wp_enqueue_script('flipclock', get_template_directory_uri() . '/inc/m-mode/js/flipclock.min.js', array( 'jquery' ), '2018-05-16', true );
			wp_enqueue_script('m-mode-script', get_template_directory_uri() . '/inc/m-mode/js/m-mode.script.js', array( 'jquery' ), '2018-05-16', true );
			
			$default_bg = array(
				'background-color'      => 'rgba(20,20,20,.8)',
				'background-image'      => get_template_directory_uri() . '/images/bg-7.jpg',
				'background-repeat'     => 'repeat',
				'background-position'   => 'center center',
				'background-size'       => 'cover',
				'background-attachment' => 'scroll',
			);
			
			$custom_css = '';
			$custom_css .= 'body{';
			
			$mmode_bg = get_theme_mod('mmode_bg', $default_bg);
		
			$mmode_date = get_theme_mod('mmode_days', '');
			$mmode_hours = get_theme_mod('mmode_hours', 8);				
			
			if( !empty($mmode_bg['background-color'])) {
				$custom_css .= 'background-color: '.$mmode_bg['background-color'].'!important;';
			}
			if( !empty($mmode_bg['background-image'])) {
				$custom_css .= 'background-image: url('.$mmode_bg['background-image'].')!important;';
			}
			
			if( !empty($mmode_bg['background-repeat'])) {
				$custom_css .= 'background-repeat: '.$mmode_bg['background-repeat'].'!important;';
			}
			if( !empty($mmode_bg['background-position'])) {
				$custom_css .= 'background-position: '.$mmode_bg['background-position'].'!important;';
			}
			if( !empty($mmode_bg['background-size'])) {
				$custom_css .= 'background-size: '.$mmode_bg['background-size'].'!important;';
			}
			if( !empty($mmode_bg['background-attachment'])) {
				$custom_css .= 'background-attachment: '.$mmode_bg['background-attachment'].'!important;';
			}									
			$custom_css .= '} ';
			
			wp_add_inline_style( 'm-mode-style', $custom_css );
			
			$mmode_options = array( 'mmode_date' => $mmode_date, 'mmode_hours' => $mmode_hours );
			wp_localize_script( 'm-mode-script', 'mmode', $mmode_options );
	}
}
add_action( 'wp_enqueue_scripts', 'icraft_mmode_enqueue_scripts' );

/*-----------------------------------------------------------------------------------*/	
/* maintanance mode */
/*-----------------------------------------------------------------------------------*/	
if ( ! function_exists( 'icraft_maintenance_mode' ) ) {
	function icraft_maintenance_mode( ) {
		
		$mmode_status = get_theme_mod('mmode_status', 0);
		$icraft_logo = get_theme_mod( 'logo_trans', '' );
		
		$mmode_date = get_theme_mod('mmode_days', '');
		$mmode_hours = get_theme_mod('mmode_hours', 16);		
		
		$maintenance_mode_logo = '';
		$maintenance_mode = 0;
		$maintenance_html = '';
		
		/*hrml starts */
		$maintenance_html .= '<div id="mmode" class="mmode-outerwrap"><div class="mmode-container">';
		$maintenance_html .= '<div class="mmode-inner">';
		
		if( $icraft_logo ) {
			$maintenance_mode_logo = '<div class="mm-logo-box"><img src="'.esc_url($icraft_logo).'" alt="'. esc_attr( get_bloginfo( 'name', 'display' ) ).'" style="max-width: 240px;" /></div>';
		} else {
			$maintenance_mode_logo .= '<div class="mm-logo-box"><h1>'.esc_attr( get_bloginfo( 'name', 'display' ) ).'</h1></div>';
			$maintenance_mode_logo .= '<div class="mm-logo-box"><h3>'.esc_attr( get_bloginfo( 'description', 'display' ) ).'</h3></div>';
		}

		$maintenance_html .= $maintenance_mode_logo;
		$maintenance_html .= '<h1>'.esc_html(get_theme_mod('mmode_title', esc_attr__( 'Under Maintenance', 'i-craft' ))).'</h1>';
		$maintenance_html .= '<p>'.esc_html(get_theme_mod('mmode_desc', esc_attr__( 'We are currently in maintenance mode. Please check back shortly.', 'i-craft' ))).'</p>';
		
		if( $mmode_date ) {
			$maintenance_html .= '<div class="mm-clock-wrap"><div class="mm-clock"></div></div>';
		}
		
		$maintenance_html .= '<div class="clear"></div>';
		$maintenance_html .= '</div></div></div>';
		/*hrml ends */
		
		if($mmode_status == 1) {
			if ( !current_user_can( 'edit_themes' ) || !is_user_logged_in() ) {				
				echo $maintenance_html;
			}			
		}
	}
	add_action('wp_footer', 'icraft_maintenance_mode');
}	


add_action('admin_notices', 'icraft_admin_notice_mmode');
function icraft_admin_notice_mmode() {

	$mmode_status = get_theme_mod('mmode_status', 0);
    
	if ( $mmode_status == 1 ) {
        echo '<div class="updated mmode-notice"><div style="line-height: 20px;">'; 
		echo esc_html__('Your site is in &quot;Maintanance Mode&quot;. To deactivate the maintanance go to menu &quot;Appearance&quot; &gt; &quot;Customize&quot; &gt; &quot;Coming Soon/Maintenance Mode&quot;.', 'i-craft');
        echo "</div></div>";
    }
}