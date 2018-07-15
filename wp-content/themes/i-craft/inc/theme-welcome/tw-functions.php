<?php

/**
 * Checks if a WordPress plugin is installed.
 *
 * @param  string  $pluginTitle The plugin title (e.g. "My Plugin")
 *
 * @return string/boolean       The plugin file/folder relative to the plugins folder path (e.g. "my-plugin/my-plugin.php") or false
 */
function icraft_is_plugin_installed($pluginTitle)
{
    // get all the plugins
    $installedPlugins = get_plugins();

    foreach ($installedPlugins as $installedPlugin => $data) {

        // check for the plugin title
        if ($data['Title'] == $pluginTitle) {

            // return the plugin folder/file
            return $data['Name'];
        }
    }

    return false;
}


/**
* Get activation or deactivation link of a plugin
*
* @author Nazmul Ahsan <mail@nazmulahsan.me>
* @param string $plugin plugin file name
* @param string $action action to perform. activate or deactivate
* @return string $url action url
*/

function icraft_plugin_install($plugin_slug)
{
	$nonce_install  = wp_nonce_url(
		add_query_arg(
			array(
				'action' => 'install-plugin',
				//'paged'         => '1',
				'plugin' => $plugin_slug,
			),
			network_admin_url( 'update.php' )
		),
		'install-plugin_' . $plugin_slug
	);
	
	return $nonce_install;
}

function icraft_plugin_activation( $plugin, $slug, $plugin_filename ) {
	if ( strpos( $plugin, '/' ) ) {
		$plugin = str_replace( '\/', '%2F', $plugin );
	}

	$tx_nonce = wp_create_nonce( 'activate-plugin_' . $slug .'/'. $plugin_filename );
	$url = admin_url( 'plugins.php?_wpnonce=' . $tx_nonce . '&action=activate&plugin='.$plugin);
	
	return $url;
}
