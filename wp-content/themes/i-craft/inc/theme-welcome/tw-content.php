<?php

$review_pop = array (
	'title' => __( 'Help Us With Your Review', 'i-craft' ),
    'desc' => __( '<p class="nx-revpop-cont-1"><b>If you like i-craft</b>, share few words in your review, it helps the theme to spread. 
                   Few words of appriciation also motivates the designers and the developers.</p>
                   <p class="nx-revpop-cont-1">If you have not posted your review/feedback yet, we request you to post your review.</p>', 'i-craft' ),
	'link' => __( 'Post Your Review', 'i-craft' ),
	'conclusion' => __( '<p class="nx-revpop-end"><b>Thanks in Advance</b><br /><span style="font-size: 12px;"><i>Team TemplatesNext</i></span></p>', 'i-craft' ),
    
);

$tx_plugins = array (
	array(
            'name' => __( 'TemplatesNext ToolKit (<span class="nx-red">Highly Recommended</span>)', 'i-craft' ),
            'desc' => __( 'Required for page options, widgets and WooCommerce wishlist and compare. This plugin also adds all the custom post types like, portfolio, Team, Slider, Testimonials etc along with all the shortcodes.', 'i-craft' ),
			'pluginurl' => esc_url( 'https://wordpress.org/plugins/templatesnext-toolkit/' ),
			'tutorial' => esc_url( 'https://www.youtube.com/watch?v=vqTHQCN2ci4' ),
			'title' => 'TemplatesNext ToolKit',
			'slug' => 'templatesnext-toolkit',			
			'pluginfile' => 'tx-toolkit.php',
			'ocdi' => 1,
    ),
	array(
            'name' => __( 'Breadcrumb NavXT (<span class="nx-red">Recommended</span>)', 'i-craft' ),
            'desc' => __( 'This plugin adds the &quot;Breadcrumbs&quot; trail for your users to help them navigate and find their location in your site.', 'i-craft' ),
			'pluginurl' => esc_url( 'https://wordpress.org/plugins/breadcrumb-navxt/' ),
			'title' => 'Breadcrumb NavXT',			
			'slug' => 'breadcrumb-navxt',
			'pluginfile' => 'breadcrumb-navxt.php',	
			'ocdi' => 1,					
    ),
	array(
            'name' => __( 'Contact Form 7 (<span class="nx-red">Recommended</span>)', 'i-craft' ),
            'desc' => __( 'A form creating plugin to help you create your own contact form or other kinds of forms.', 'i-craft' ),
			'pluginurl' => esc_url( 'https://wordpress.org/plugins/contact-form-7/' ),
			'tutorial' => esc_url( 'https://www.youtube.com/watch?v=wy70WGCjMY4' ),
			'title' => 'Contact Form 7',			
			'slug' => 'contact-form-7',
			'pluginfile' => 'wp-contact-form-7.php',
			'ocdi' => 1,					
    ),
	array(
            'name' => __( 'One Click Demo Import (<span class="nx-red">Optional</span>)', 'i-craft' ),
            'desc' => __( 'This plugin is only required if you choose to import the predefined demo contents, Once you are done with your demo setup you can deactivate the plugin.', 'i-craft' ),
			'pluginurl' => esc_url( 'https://wordpress.org/plugins/one-click-demo-import/' ),
			'title' => 'One Click Demo Import',			
			'slug' => 'one-click-demo-import',
			'pluginfile' => 'one-click-demo-import.php',
			'ocdi' => 1,				
    ),
	array(
            'name' => __( 'Brizy Page Builder (<span class="nx-red">Optional</span>)', 'i-craft' ),
            'desc' => __( 'Drag and drop page builder with pre-built sections.', 'i-craft' ),
			'pluginurl' => esc_url( 'https://wordpress.org/plugins/brizy/' ),
			'tutorial' => esc_url( 'https://www.youtube.com/watch?v=3sRJ0-PAuXk' ),
			'title' => 'Brizy – Page Builder',			
			'slug' => 'brizy',
			'pluginfile' => 'brizy.php',
    ),
	array(
            'name' => __( 'Elementor Page Builder (<span class="nx-red">Optional</span>)', 'i-craft' ),
            'desc' => __( 'Drag and drop page builder with pre-built layouts.', 'i-craft' ),
			'pluginurl' => esc_url( 'https://wordpress.org/plugins/elementor/' ),
			'tutorial' => esc_url( 'https://www.youtube.com/watch?v=3B5HL11uhVE' ),
			'title' => 'Elementor Page Builder',			
			'slug' => 'elementor',
			'pluginfile' => 'elementor.php',
    ),	
	array(
            'name' => __( 'SiteOrigin PageBuilder (<span class="nx-red">Recommended</span>)', 'i-craft' ),
            'desc' => __( 'This drag and drop page builder plugin makes it easy to build responsive grid-based page content. Our themes supports and extends SiteOrigin PageBuilder functionalities.', 'i-craft' ),
			'pluginurl' => esc_url( 'https://wordpress.org/plugins/siteorigin-panels/' ),
			'tutorial' => esc_url( 'https://siteorigin.com/page-builder/documentation/' ),
			'title' => 'Page Builder by SiteOrigin',			
			'slug' => 'siteorigin-panels',
			'pluginfile' => 'siteorigin-panels.php',
			'ocdi' => 1,					
    ),
	array(
            'name' => __( 'SiteOrigin Widgets Bundle (<span class="nx-red">Optional</span>)', 'i-craft' ),
            'desc' => __( 'Additional useful widgets for pagebuilder such as Google map, Button, Image, Price table, etc.', 'i-craft' ),
			'pluginurl' => esc_url( 'https://wordpress.org/plugins/so-widgets-bundle/' ),
			'title' => 'SiteOrigin Widgets Bundle',			
			'slug' => 'so-widgets-bundle',
			'pluginfile' => 'so-widgets-bundle.php',
			'ocdi' => 1,			
    ),
	array(
            'name' => __( 'Contact Form 7 Honeypot (<span class="nx-red">Optional</span>)', 'i-craft' ),
            'desc' => __( 'Plugin to fool spammers with a dummy filed visible only to bots.', 'i-craft' ),
			'pluginurl' => esc_url( 'https://wordpress.org/plugins/contact-form-7-honeypot/' ),
			'title' => 'Contact Form 7 Honeypot',			
			'slug' => 'contact-form-7-honeypot',
			'pluginfile' => 'honeypot.php',
			'ocdi' => 1,			
    ),		
);

$tx_faqs = array (
	array(
            'question' => __( 'Demo Import failed.', 'i-craft' ),
            'answeer' => __( 'If demo data import fails with a simple error message like &quot;Import failed&quot; or &quot;Object, Object&quot; or.&quot;500 Internal Server Error&quot; or &quot;404 Page Not Found&quot;, 
				Please follow these steps:<br />
				1. Upgrade latest version of WordPress, PHP version 5.6 or higher.<br />
				2. Increase memory limits. Contact your server provider to help you increase following PHP limits:<br />
				max_execution_time 3000<br />
				memory_limit 256M<br />
				post_max_size 100M<br />
				upload_max_filesize 100M', 'i-craft' ),
    ),
	array(
            'question' => __( 'Thumbnail or Slider images are not visible.', 'i-craft' ),
            'answeer' => __( 'The most common reason is &quot;Photon&quot; services of plugin &quot;Jetpack&quot;, which stores your images on a remote server to save your space. Turn of the &quot;Photon&quot; services. This happens because the script we use to crop images on the fly do not support remote images for security reason.', 'i-craft' ),
    ),
	array(
            'question' => __( 'Demo contact forms are not working.', 'i-craft' ),
            'answeer' => __( 'If you are using one of our demo to start your website, make sure to change the email id of the forms, from menu "Contact" > "Contact Forms". By default the forms will send the submitted details to a demo email id.', 'i-craft' ),
    ),
	array(
            'question' => __( 'What is &quot;[honeypot honeypot ?', 'i-craft' ),
            'answeer' => __( 'If you are using one of our demo content, you are likely to see this around the forms. We use a plugin &quot;Contact Form 7 Honeypot&quot; to stop spammers abusing the form. Either you can install the plugin or remove the string from the form by going to menu &quot;contact&quot; > &quot;Contact Forms&quot;.', 'i-craft' ),
    ),
	array(
            'question' => __( 'How to hide the shopping cart from main navigation menu?', 'i-craft' ),
            'answeer' => __( 'Step 1. Go to menu "Appearance" > "Customize", <br />Step 2. Open section "WooCommerce", <br />Step 3. Turn off the "Hide Topnav Cart" toggle.', 'i-craft' ),
    ),	
	array(
            'question' => __( 'How to hide the "login" menu item from top navigation menu?', 'i-craft' ),
            'answeer' => __( 'Step 1. Go to menu "Appearance" > "Customize", <br />Step 2. Open section "WooCommerce", <br />Step 3. Turn off the "Hide Topnav Login" toggle.', 'i-craft' ),
    ),	
	array(
            'question' => __( 'How to turn on the normal search from products only search?', 'i-craft' ),
            'answeer' => __( 'Step 1. Go to menu "Appearance" > "Customize", <br />Step 2. Open section "WooCommerce", <br />Step 3. Turn on the "Turn On Normal Search" toggle.', 'i-craft' ),
    ),			
	array(
            'question' => __( 'I activated my new theme and it does not look like the demo. What is up with this?', 'i-craft' ),
            'answeer' => __( 'By default the Wordpress comes with only one sample post and a page. Once you activate a theme, it requres little bit of setup, like logo, color, social links, etc. 
				<br />We have added inbuilt options to import the demo contents and setup in one click to help you achieve a starting point for your website.', 'i-craft' ),
    ),

);