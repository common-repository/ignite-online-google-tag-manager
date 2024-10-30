<?php

use IgniteOnline\Plugins\GoogleTagManager;

class loadScript extends PHPUnit_Framework_TestCase
{

    public $options = [
        'GTM-XXXXXX',
    ];

    public function setUp()
    {
        WP_Mock::setUp();
    }

    public function tearDown()
    {
        WP_Mock::tearDown();
    }

    /** @test */
    public function it_returns_an_array_of_options()
    {
        $gtm = new GoogleTagManager($this->options);
        $option = $gtm->options('gtmID');

        $this->assertEquals('GTM-XXXXXX', $option);
        $option = $gtm->options('hook');
        $this->assertEquals('wp_footer', $option);

        $gtm = new GoogleTagManager([
            'GTM-XXXXXX',
            'wp_head'
        ]);

        $option = $gtm->options('hook');
        $this->assertEquals('wp_head', $option);
    }

    /** @test */
    public function it_loads_the_script_snippet()
    {
        $gtmID = 'GTM-XXXXXX';
        ob_start();
        ?>
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

        $code_snippet = ob_get_contents();
        ob_end_clean();
        $this->expectOutputString(trim($code_snippet));

        $gtm = new GoogleTagManager($this->options);
        ob_start();
        $gtm->load_script();
        $snippet = ob_get_contents();
        ob_end_clean();
        echo trim($snippet);
    }
}