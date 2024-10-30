<?php
/*
Plugin Name:        Ignite Online - Google Tag Manager
Plugin URI:         https://igniteonline.com.au
Description:        Provides support for Google Tag Manager to your website. Inspired by Soil.
Version:            1.0.0
Author:             Ignite Online
License:            MIT License
License URI:        http://opensource.org/licenses/MIT
Requires PHP: 5.6
Tested Up To: 4.9.5
*/

namespace IgniteOnline\Plugins;

use IgniteOnline\Utils\Loader;

if (version_compare(PHP_VERSION, '5.6', '<')) {
    exit(sprintf('Google Tag Manager requires PHP 5.6 or higher. You’re still on %s.', PHP_VERSION));
}

require_once 'vendor/autoload.php';

add_action('after_setup_theme', function () {
    Loader::autoload();
}, 1);

function load_modules()
{
    global $_wp_theme_features;
    foreach (glob(__DIR__ . '/modules/*.php') as $file) {
        $feature = 'ignite-' . basename($file, '.php');
        if (isset($_wp_theme_features[$feature])) {
            $class_name = __NAMESPACE__ . '\\' . substr($feature, 7);
            new $class_name($_wp_theme_features[$feature]);
        }
    }
}

add_action('after_setup_theme', __NAMESPACE__ . '\\load_modules', 100);

add_action('admin_menu', function () {
    add_menu_page('Tag Manager', 'Tag Manager', 'manage_options', 'ignite-tag-manager', __NAMESPACE__ . '\\admin_page', 'data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCAyNC40OCA5MS44MiI+PHRpdGxlPkFzc2V0IDE8L3RpdGxlPjxnIGlkPSJMYXllcl8yIiBkYXRhLW5hbWU9IkxheWVyIDIiPjxnIGlkPSJMYXllcl8xLTIiIGRhdGEtbmFtZT0iTGF5ZXIgMSI+PHBvbHlnb24gcG9pbnRzPSIyNC40OCA0OC45IDI0LjI3IDQ4LjgyIDEuMTUgMCA3LjEyIDQyLjk5IDAgNDIuOTkgMjMuMTIgOTEuODIgMTcuMSA0OC45IDI0LjMxIDQ4LjkgMjQuNDggNDguOSIgZmlsbD0iIzBmOSIvPjwvZz48L2c+PC9zdmc+');
});

add_action('admin_init', function () {
    ?>
    <style>
        #toplevel_page_ignite-tag-manager .wp-menu-image {
            background-size: contain !important;
        }
    </style>
    <?php
});

function admin_page()
{
    include 'templates/options.php';
}
