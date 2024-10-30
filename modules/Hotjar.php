<?php

namespace IgniteOnline\Plugins;

class Hotjar
{
    public $options = [];
    public $feature = "ignite-Hotjar";

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
     * Hotjar Snippet
     *
     * You can enable/disable this feature in functions.php (or lib/setup.php if you're using Sage):
     * add_theme_support('ignite-Hotjar', 'XXXXXX', 'wp_footer');
     */
    function load_script()
    {
        $hotjarId = $this->options['hotjarId'];
        if (!$hotjarId) {
            return;
        }
        $loadHotjar = (!defined('WP_ENV') || \WP_ENV === 'production');
        $loadHotjar = apply_filters('igniteonline/loadHotjar', $loadHotjar);
        ?>
        <?php if ($loadHotjar): ?>
        <!-- Hotjar Tracking Code -->
        <script>
          (function (h, o, t, j, a, r) {
            h.hj = h.hj || function () {
              (h.hj.q = h.hj.q || []).push(arguments)
            };
            h._hjSettings = {hjid:<?= $hotjarId ?>, hjsv: 5};
            a = o.getElementsByTagName('head')[0];
            r = o.createElement('script');
            r.async = 1;
            r.src = t + h._hjSettings.hjid + j + h._hjSettings.hjsv;
            a.appendChild(r);
          })(window, document, '//static.hotjar.com/c/hotjar-', '.js?sv=');
        </script>
        <?php
    endif;
    }

    function options($option = null)
    {
        $options = $this->options + ['', 'wp_footer'];
        $this->options['hotjarId'] = $options[0];
        $this->options['hook'] = $options[1];

        return is_null($option) ? $this->options : $this->options[$option];
    }
}