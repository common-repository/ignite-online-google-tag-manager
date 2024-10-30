<?php

use IgniteOnline\Plugins\Hotjar;

class HotjarTest extends PHPUnit_Framework_TestCase
{
    public $options = [
        'XXXXXX',
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
        $hotjar = new Hotjar($this->options);
        $option = $hotjar->options('hotjarId');

        $this->assertEquals('XXXXXX', $option);
        $option = $hotjar->options('hook');
        $this->assertEquals('wp_footer', $option);

        $gtm = new Hotjar([
            'XXXXXX',
            'wp_head'
        ]);

        $option = $gtm->options('hook');
        $this->assertEquals('wp_head', $option);
    }

    /** @test */
    public function it_loads_the_script_snippet()
    {
        $hotjarId = 'XXXXXX';
        ob_start();
        ?>
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

        $code_snippet = ob_get_contents();
        ob_end_clean();
        $this->expectOutputString(trim($code_snippet));

        $hotjar = new Hotjar($this->options);
        ob_start();
        $hotjar->load_script();
        $snippet = ob_get_contents();
        ob_end_clean();
        echo trim($snippet);
    }
}
