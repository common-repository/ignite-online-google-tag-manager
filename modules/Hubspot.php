<?php

namespace IgniteOnline\Plugins;

class Hubspot
{
    public $options = [];
    public $feature = "ignite-Hubspot";

    public function __construct($options)
    {
        $this->options = $options;
        $this->options = $this->options();
        $this->activate();
    }

    public function activate()
    {
        $hook = $this->options['hook'];
        add_action($hook, [$this, 'load_script'], 20);
    }

    /**
     * Hubspot Snippet
     *
     * You can enable/disable this feature in functions.php (or lib/setup.php if you're using Sage):
     * add_theme_support('ignite-Hubspot', 'XXXXXX', 'wp_footer');
     */
    function load_script()
    {
        $hubspotId = $this->options['hubspotId'];
        if (!$hubspotId) {
            return;
        }
        $loadHubspot = (!defined('WP_ENV') || \WP_ENV === 'production');
        $loadHubspot = apply_filters('igniteonline/loadHubspot', $loadHubspot);
        ?>
        <?php if ($loadHubspot): ?>
        <!-- Start of HubSpot Embed Code -->
        <script type="text/javascript" id="hs-script-loader" async defer src="//js.hs-scripts.com/<?= $hubspotId ?>.js"></script>
        <!-- End of HubSpot Embed Code -->
    <?php
    endif;
    }

    function options($option = null)
    {
        $options = $this->options + ['', 'wp_footer'];
        $this->options['hubspotId'] = $options[0];
        $this->options['hook'] = $options[1];

        return is_null($option) ? $this->options : $this->options[$option];
    }
}