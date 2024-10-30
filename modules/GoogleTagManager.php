<?php

namespace IgniteOnline\Plugins;

class GoogleTagManager
{

    public $options = [];
    public $feature = "ignite-GoogleTagManager";

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
     * Google Tag Manager Snippet
     *
     * You can enable/disable this feature in functions.php (or lib/setup.php if you're using Sage):
     * add_theme_support('ignite-GoogleTagManager', 'GTM-XXXXXX', 'wp_footer');
     */
    function load_script()
    {
        $gtmID = $this->options['gtmID'];
        if (!$gtmID) {
            return;
        }
        $loadGTM = (!defined('WP_ENV') || \WP_ENV === 'production');
        $loadGTM = apply_filters('igniteonline/loadGTM', $loadGTM);
        ?>
        <?php if ($loadGTM): ?>
        <!-- Google Tag Manager -->
        <noscript>
            <iframe src="//www.googletagmanager.com/ns.html?id=<?= $gtmID ?>" height="0" width="0"
                    style="display:none;visibility:hidden"></iframe>
        </noscript>
        <script defer>(function (w, d, s, l, i) {
                w[l] = w[l] || [];
                w[l].push({'gtm.start': new Date().getTime(), event: 'gtm.js'});
                var f = d.getElementsByTagName(s)[0], j = d.createElement(s), dl = l != 'dataLayer' ? '&l=' + l : '';
                j.async = true;
                j.src = '//www.googletagmanager.com/gtm.js?id=' + i + dl;
                f.parentNode.insertBefore(j, f);
            })(window, document, 'script', 'dataLayer', '<?= $gtmID ?>');</script><!-- End Google Tag Manager -->
        <?php
    endif;
    }

    function options($option = null)
    {
        $options = $this->options + ['', 'wp_footer'];
        $this->options['gtmID'] = $options[0];
        $this->options['hook']  = $options[1];

        return is_null($option) ? $this->options : $this->options[$option];
    }

}