<?php

namespace IgniteOnline\Plugins;

class FacebookPixel
{

    public $options = [];
    public $feature = "ignite-FacebookPixel";

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
        $pixelID = $this->options['pixelID'];
        if (!$pixelID) {
            return;
        }
        $loadFacebookPxiel = (!defined('WP_ENV') || \WP_ENV === 'production');
        $loadFacebookPxiel = apply_filters('igniteonline/loadFacebookPixel', $loadFacebookPxiel);
        ?>
        <?php if ($loadFacebookPxiel): ?>
        <!-- Facebook Pixel Code-->
        <noscript>
            <img height="1" width="1"
                 src="https://www.facebook.com/tr?id=<?= $pixelID ?>&ev=PageView&noscript=1"/>
        </noscript>
        <script defer="">
          !function (f, b, e, v, n, t, s) {
            if (f.fbq) return;
            n = f.fbq = function () {
              n.callMethod ?
                n.callMethod.apply(n, arguments) : n.queue.push(arguments)
            };
            if (!f._fbq) f._fbq = n;
            n.push = n;
            n.loaded = !0;
            n.version = '2.0';
            n.queue = [];
            t = b.createElement(e);
            t.async = !0;
            t.src = v;
            s = b.getElementsByTagName(e)[0];
            s.parentNode.insertBefore(t, s)
          }(window, document, 'script',
            'https://connect.facebook.net/en_US/fbevents.js');
          fbq('init', '<?= $pixelID ?>');
          fbq('track', 'PageView');
        </script>
        <!-- End Facebook Pixel Code -->
    <?php
    endif;
    }

    function options($option = null)
    {
        $options = $this->options + ['', 'wp_footer'];
        $this->options['pixelID'] = $options[0];
        $this->options['hook'] = $options[1];

        return is_null($option) ? $this->options : $this->options[$option];
    }

}