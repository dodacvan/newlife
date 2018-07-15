<?php

include get_template_directory() . '/inc/theme-welcome/tw-functions.php';	
	
if (isset($_GET['activated']) && is_admin()) {
	set_transient( '_welcome_screen_activation_redirect', true, 30 );
}

add_action( 'admin_init', 'welcome_screen_do_activation_redirect' );
function welcome_screen_do_activation_redirect() {
  // Bail if no activation redirect
    if ( ! get_transient( '_welcome_screen_activation_redirect' ) ) {
    return;
  }

  // Delete the redirect transient
  delete_transient( '_welcome_screen_activation_redirect' );

  // Bail if activating from network, or bulk
  if ( is_network_admin() || isset( $_GET['activate-multi'] ) ) {
    return;
  }

  // Redirect to bbPress about page
  wp_safe_redirect( add_query_arg( array( 'page' => 'welcome-screen-about' ), admin_url( 'themes.php' ) ) );

}

add_action('admin_menu', 'welcome_screen_pages');

function welcome_screen_pages() {
	add_theme_page(
		'Welcome To Welcome i-craft',
		'About i-craft',
		'read',
		'welcome-screen-about',
		'welcome_screen_content',
		'dashicons-awards', 
		6 		
	);
}

function welcome_screen_content() {
	
	include get_template_directory() . '/inc/theme-welcome/tw-content.php';
	
	$logo_url = get_template_directory_uri() . '/inc/theme-welcome/i-craft-welcome.jpg';
	$img_url = get_template_directory_uri() . '/inc/theme-welcome/images/';
	$active_tab = 'icraft_about';
	
	/* Urls */
	$reviewURL = esc_url('//wordpress.org/support/theme/i-craft/reviews/?filter=5');
	$goPremiumURL = esc_url('//templatesnext.org/ispirit/landing/');
	$videoguide = esc_url('//www.templatesnext.org/i-craft-documentions/');
	$supportforum = esc_url('//templatesnext.org/ispirit/landing/forums/'); 
	$toolkit = esc_url('//www.templatesnext.org/icreate/templatesnext-toolkit/');
	$fb_page = esc_url('//www.facebook.com/templatesnext/');
	$pb_tutorial = esc_url('https://siteorigin.com/page-builder/documentation/');


	$ocdi_buttont = "";
	if ( class_exists('OCDI_Plugin') ) {
		$ocdi_buttont = "button-enabled";
	} else
	{
		$ocdi_buttont = "button-disabled";
	} 	
	$details_theme = wp_get_theme();
	$name_version = $details_theme->get( 'Name' ) . " - " . $details_theme->get( 'Version' );
  	?>
  	<div class="wrapp">
        <div class="nx-info-wrap-2 welcome-panel">
        	
        	<div class="nx-info-wrap">
            	
                <div class="nx-welcome"><?php _e( 'Welcome To ', 'i-craft' ); echo $name_version; ?></div>
                <div class="tx-wspace-24"></div>  
                <div class="nx-info-desc" style="width: 100%;">
                    <p>
						<?php _e( 'i-craft is a Flexible Multipurpose WordPress theme. <br>i-craft supports most of the popular page builders like SiteOrigin Page Builder, Elementor, Brizy, Visual Composer, etc.', 'i-craft' ); ?>
                    </p>
                    <a class="button button-primary button-hero" href="<?php echo $reviewURL; ?>">
                    <?php _e( 'Post Your Review', 'i-craft' ); ?>
                    </a>  
                    <a class="button button-primary button-hero" href="<?php echo $goPremiumURL; ?>">
                    	<?php _e( 'Go Premium', 'i-craft' ); ?>
                    </a>  
                </div>
                <div class="tx-wspace-12"></div>
                <div class="tx-wspace-24"></div>
                <div class="tx-wspace-24"></div>                  
                <div class="nx-admin-row">
                	<div class="one-four-col">
                    	<a href="<?php echo $videoguide; ?>" target="_blank">
                            <div class="nx-dash"><span class="dashicons dashicons-video-alt2"></span></div>
                            <h3 class="tx-admin-link"><?php _e( 'Documentation', 'i-craft' ); ?></h3>
                        </a>
                    </div>
                	<div class="one-four-col">
                    	<a href="<?php echo $supportforum; ?>" target="_blank">
                            <div class="nx-dash"><span class="dashicons dashicons-format-chat"></span></div>
                            <h3 class="tx-admin-link"><?php _e( 'Support Forum', 'i-craft' ); ?></h3>
                        </a>
                    </div>
                	<div class="one-four-col">
                    	<a href="<?php echo $toolkit; ?>" target="_blank">
                            <div class="nx-dash"><span class="dashicons dashicons-migrate"></span></div>
                            <h3 class="tx-admin-link"><?php _e( 'TemplatesNext Toolkit', 'i-craft' ); ?></h3>
                        </a>
                    </div>
                	<div class="one-four-col">
                    	<a href="<?php echo $fb_page; ?>" target="_blank">
                            <div class="nx-dash"><span class="dashicons dashicons-facebook-alt"></span></div>
                            <h3 class="tx-admin-link"><?php _e( 'Community', 'i-craft' ); ?></h3>
                        </a>
                    </div>                                                            
                </div>
                <div class="tx-wspace-24"></div>
                <?php
					if( isset( $_GET[ 'tab' ] ) ) {
						$active_tab = $_GET[ 'tab' ];
					}
				?>
                <h2 class="nav-tab-wrapper">
                    <a href="?page=welcome-screen-about&tab=icraft_about" class="nav-tab <?php echo $active_tab == 'icraft_about' ? 'nav-tab-active' : ''; ?>">
                   		<?php _e( 'Setting Up i-craft', 'i-craft' ); ?>
                    </a>
                    <a href="?page=welcome-screen-about&tab=icraft_ocdi" class="nav-tab <?php echo $active_tab == 'icraft_ocdi' ? 'nav-tab-active' : ''; ?>">
                   		<?php _e( 'One Click Demo Import', 'i-craft' ); ?>
                    </a>                    
                    <a href="?page=welcome-screen-about&tab=icraft_plugins" class="nav-tab <?php echo $active_tab == 'icraft_plugins' ? 'nav-tab-active' : ''; ?> nx-kick">
                    	<?php _e( 'Recommended Plugins', 'i-craft' ); ?>
                    </a>
                    <a href="?page=welcome-screen-about&tab=icraft_faq" class="nav-tab <?php echo $active_tab == 'icraft_faq' ? 'nav-tab-active' : ''; ?> nx-plug">
                    	<?php _e( 'FAQs/Support', 'i-craft' ); ?>
                    </a>
                </h2>
                
                <?php
					if( $active_tab == 'icraft_about' )
					{
				?> 
                	<div class="nx-tab-content">
                		<p>&nbsp;</p>
                        <ul class="nx-welcome">
  							<?php
									echo '<li>';
									echo '<h3>';
									printf( esc_html__( 'Upload Logos', 'i-craft' ));
									echo '</h3>';
									printf( esc_html__( 'Start with uploading your logos', 'i-craft' ) );
									echo '<div class="nx-customizer-link">';
									printf( __( '<a href="%scustomize.php?autofocus[section]=title_tagline" target="_blank">Customizer Option</a>', 'i-craft' ), admin_url() );
									echo '</div>';								
									echo '</li>';

									echo '<li>';
									echo '<h3>';
									printf( esc_html__( 'Set Theme Color', 'i-craft' ));
									echo '</h3>';
									printf( esc_html__( 'Change theme color', 'i-craft' ) );
									echo '<div class="nx-customizer-link">';
									printf( __( '<a href="%scustomize.php?autofocus[section]=colors" target="_blank">Customizer Option</a>', 'i-craft' ), admin_url() );
									echo '</div>';								
									echo '</li>';

									echo '<li>';
									echo '<h3>';
									printf( esc_html__( 'Topbar Customization', 'i-craft' ));
									echo '</h3>';
									printf( esc_html__( 'Add your phone, email and social links or empty the fields to remove them', 'i-craft' ) );
									echo '<div class="nx-customizer-link">';
									printf( __( '<a href="%scustomize.php?autofocus[section]=nxtopbar" target="_blank">Customizer Option</a>', 'i-craft' ), admin_url() );
									echo '</div>';								
									echo '</li>';

									echo '<li>';
									echo '<h3>';
									printf( esc_html__( 'Header Customization', 'i-craft' ));
									echo '</h3>';
									printf( esc_html__( 'Customize header, change font menu size, width, etc.', 'i-craft' ) );
									echo '<div class="nx-customizer-link">';
									printf( __( '<a href="%scustomize.php?autofocus[section]=nxheader" target="_blank">Customizer Option</a>', 'i-craft' ), admin_url() );
									echo '</div>';								
									echo '</li>';

									echo '<li>';
									echo '<h3>';
									printf( esc_html__( 'Turn ON/OFF Preloader', 'i-craft' ));
									echo '</h3>';
									printf( esc_html__( 'Turn on or off page preloader, by default it is on', 'i-craft' ) );
									echo '<div class="nx-customizer-link">';
									printf( __( '<a href="%scustomize.php?autofocus[section]=layout" target="_blank">Customizer Option</a>', 'i-craft' ), admin_url() );
									echo '</div>';								
									echo '</li>';
									
									echo '<li>';
									echo '<h3>';
									printf( esc_html__( 'Footer Customization', 'i-craft' ));
									echo '</h3>';
									printf( esc_html__( 'Customize footer background, text color, etc', 'i-craft' ) );
									echo '<div class="nx-customizer-link">';
									printf( __( '<a href="%scustomize.php?autofocus[section]=nxfooter" target="_blank">Customizer Option</a>', 'i-craft' ), admin_url() );
									echo '</div>';								
									echo '</li>';									

									echo '<li>';
									echo '<h3>';
									printf( esc_html__( 'Edit Theme Slider', 'i-craft' ));
									echo '</h3>';
									printf( esc_html__( 'Adjust slider settings, edit slides, etc.', 'i-craft' ) );
									echo '<div class="nx-customizer-link">';
									printf( __( '<a href="%scustomize.php?autofocus[panel]=slider" target="_blank">Customizer Option</a>', 'i-craft' ), admin_url() );
									echo '</div>';								
									echo '</li>';

									echo '<li>';
									echo '<h3>';
									printf( esc_html__( 'WooCommerce Customization', 'i-craft' ));
									echo '</h3>';
									printf( esc_html__( 'Adjust WooCommerce Settings', 'i-craft' ) );
									echo '<div class="nx-customizer-link">';
									printf( __( '<a href="%scustomize.php?autofocus[section]=woocomm" target="_blank">Customizer Option</a>', 'i-craft' ), admin_url() );
									echo '</div>';								
									echo '</li>';

									echo '<li>';
									echo '<h3>';
									printf( esc_html__( 'Set Fonts', 'i-craft' ));
									echo '</h3>';
									printf( esc_html__( 'Choose your fonts', 'i-craft' ) );
									echo '<div class="nx-customizer-link">';
									printf( __( '<a href="%scustomize.php?autofocus[section]=typography" target="_blank">Customizer Option</a>', 'i-craft' ), admin_url() );
									echo '</div>';								
									echo '</li>';
									
									echo '<li>';
									echo '<h3>';
									printf( esc_html__( 'Choose Your Plugins', 'i-craft' ));
									echo '</h3>';
									printf( esc_html__( 'I-ONE supports most of the popular plugins. We have listed some of the most popular plugins with high ratings. ', 'i-craft' ) );
									printf( esc_html__( 'It is not neccssery to install and activate all the plugins recommendded. ', 'i-craft' ) );
									printf( esc_html__( 'You need the correct set of plugins suiteable for your job.', 'i-craft' ) );																		
									echo '<div class="nx-customizer-link">';
									printf( __( '<a href="%sthemes.php?page=welcome-screen-about&tab=icraft_plugins" target="_blank">Install Plugins</a>', 'i-craft' ), admin_url() );
									echo '</div>';								
									echo '</li>';
									
									echo '<li>';
									echo '<h3>';
									printf( esc_html__( 'Activate Maintenance/Coming Soon  Mode', 'i-craft' ));
									echo '</h3>';
									printf( esc_html__( 'Maintenance mode for visitors. If you are logged in admin, use different browser to preview the maintenance mode.', 'i-craft' ) );
									printf( esc_html__( 'Logged in admins will view a normal site so that they can work on it.', 'i-craft' ) );										
									echo '<div class="nx-customizer-link">';
									printf( __( '<a href="%scustomize.php?autofocus[section]=mmode" target="_blank">Customizer Option</a>', 'i-craft' ), admin_url() );
									echo '</div>';								
									echo '</li>';																	
                            ?>                 
                        </ul>
        			</div>
				<?php		
					} elseif ( $active_tab == 'icraft_ocdi' ) {
				?>     
                	<div class="nx-tab-content"> 
                		<p>&nbsp;</p>
                        <p style="font-weight: 600; color: #272727;">
                            <?php _e( 'Following plugins were used while creating the &quot;One Click Demo&quot;s. <br>Once you are done with installing and activating the plugins go to', 'i-craft' ); ?>
                            <a class="" href="<?php echo admin_url(); ?>themes.php?page=pt-one-click-demo-import">
                            <?php _e( 'I-Craft Demo Setup', 'i-craft' ); ?>
                            </a>                             
                        </p>                       
                        <ol>
							<?php
			
								foreach ($tx_plugins as $plugin) {
									
									$pluginLocation = rawurlencode($plugin['slug'].'/'.$plugin['pluginfile']);
									$pluginLink = icraft_plugin_activation( $pluginLocation, $plugin['slug'], $plugin['pluginfile'] );
									$nonce_install = icraft_plugin_install($plugin['slug']);
															
									if (!empty($plugin['ocdi']))
									{
										echo '<li><b>'.$plugin['title'].'</b><br />';
										echo $plugin['desc'].'<br />';
										$pluginTitle = $plugin['title'];
										if ( is_plugin_active( $plugin['slug'].'/'.$plugin['pluginfile'] ) ) {
											echo '<a href="#" class="button disabled">' . __( 'Plugin installed and active', 'i-craft' ) . '</a>';  
										} elseif( icraft_is_plugin_installed($pluginTitle) == false )
										{
											echo '<a data-slug="' . $plugin['slug'] . '" data-active-lebel="' . __( 'Installing...', 'i-craft' ) . '" class="install-now button" href="' . esc_url( $nonce_install ) . '" data-name="' . $plugin['slug'] . '" aria-label="Install ' . $plugin['slug'] . '">' . __( 'Install and activate', 'i-craft' ) . '</a>';
										} else
										{
											echo '<a class="button activate-now button-primary" data-active-lebel="' . __( 'Activating...', 'i-craft' ) . '" data-slug="' . $plugin['slug'] . '" href="' . esc_url( $pluginLink ) . '" aria-label="Activate ' . $plugin['slug'] . '">Activate</a>';
										}
										echo '</li>';
									}
									
								}
                            ?>                    
                        </ol>
        			</div>       
                        
				<?php	
					} elseif ( $active_tab == 'icraft_plugins' ) {
				?>     
                	<div class="nx-tab-content"> 
                		<p>&nbsp;</p>
                        <ol>
							<?php
			
								foreach ($tx_plugins as $plugin) {
									
									$pluginLocation = rawurlencode($plugin['slug'].'/'.$plugin['pluginfile']);
									$pluginLink = icraft_plugin_activation( $pluginLocation, $plugin['slug'], $plugin['pluginfile'] );
									$nonce_install = icraft_plugin_install($plugin['slug']);
															
									
									echo '<li><b>'.$plugin['name'].'</b><br />';
									echo $plugin['desc'].'<br />';
									echo _e( 'Plugin URL : ', 'i-craft' ).'<a href="'.$plugin['pluginurl'].'" target="_blank">'.$plugin['pluginurl'].'</a><br />';
									if(!empty($plugin['tutorial']))
									{
										echo _e( 'Tutorial : ', 'i-craft' ).'<a href="'.$plugin['tutorial'].'" target="_blank">'.$plugin['tutorial'].'</a><br />';   
									}
									
									$pluginTitle = $plugin['title'];
									if ( is_plugin_active( $plugin['slug'].'/'.$plugin['pluginfile'] ) ) {
										echo '<a href="#" class="button disabled">' . __( 'Plugin installed and active', 'i-craft' ) . '</a>';  
									} elseif( icraft_is_plugin_installed($pluginTitle) == false )
									{
										echo '<a data-slug="' . $plugin['slug'] . '" data-active-lebel="' . __( 'Installing...', 'i-craft' ) . '" class="install-now button" href="' . esc_url( $nonce_install ) . '" data-name="' . $plugin['slug'] . '" aria-label="Install ' . $plugin['slug'] . '">' . __( 'Install and activate', 'i-craft' ) . '</a>';
									} else
									{
										echo '<a class="button activate-now button-primary" data-active-lebel="' . __( 'Activating...', 'i-craft' ) . '" data-slug="' . $plugin['slug'] . '" href="' . esc_url( $pluginLink ) . '" aria-label="Activate ' . $plugin['slug'] . '">Activate</a>';
									}
									
									echo '</li>';
									
								}
                            ?>                    
                        </ol>
        			</div>       
                        
				<?php	
					} elseif ( $active_tab == 'icraft_faq' ) {
				?>     
                	<div class="nx-tab-content"> 
                		<p>&nbsp;</p>
                        <?php
							foreach ($tx_faqs as $faq) {
								echo '<b>'._e( 'Q. ', 'i-craft' ).$faq['question'].'</b><br />';
								echo _e( 'A. ', 'i-craft' ).$faq['answeer'].'<br /><br />';									   
							}
                        ?>                    
                        
        			</div>      
                        
				<?php	
					}
				?>
  
                <div class="tx-wspace-24"></div><div class="tx-wspace-24"></div>    
 	
            </div>

                <div id="dashboard_right_now" class="postbox" style="display: block; float: right; width: 33%; max-width: 320px; margin: 16px;">
                    <h2 class="hndle nxw-title" style="padding: 12px 24px;"><span><?php echo $review_pop['title']; ?></span></h2>
                    <div class="inside">
                        <div class="main" style="padding: 24px;">
							<?php echo $review_pop['desc']; ?>
                    		<a class="button button-primary button-hero" target="_blank" href="<?php echo $reviewURL; ?>">
                            	<?php echo $review_pop['link']; ?>
                            </a> 
                            <?php echo $review_pop['conclusion']; ?>
                        </div>
                    </div>
                </div>   

            <div class="tx-wspace"></div>
        
            
            
        </div>
        
  	</div>
  
  	<?php
}

add_action( 'admin_head', 'welcome_screen_remove_menus' );
function welcome_screen_remove_menus() {
    remove_submenu_page( 'index.php', 'welcome-screen-about' );
}

// Add Stylesheet
add_action( 'admin_enqueue_scripts', 'icraft_welcome_scripts' );
function icraft_welcome_scripts() {
	wp_enqueue_style( 'nx-welcome-style', get_template_directory_uri() . '/inc/theme-welcome/css/nx-welcome.css', array(), '1.01' );
	wp_enqueue_script( 'nx-welcome-script', get_template_directory_uri() . '/inc/theme-welcome/js/nx-welcome.js' );
}
