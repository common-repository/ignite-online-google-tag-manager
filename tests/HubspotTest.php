<?php

use IgniteOnline\Plugins\Hubspot;

class HubspotTest extends PHPUnit_Framework_TestCase
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
        $hotjar = new Hubspot($this->options);
        $option = $hotjar->options('hubspotId');

        $this->assertEquals('XXXXXX', $option);
        $option = $hotjar->options('hook');
        $this->assertEquals('wp_footer', $option);

        $gtm = new Hubspot([
            'XXXXXX',
            'wp_head'
        ]);

        $option = $gtm->options('hook');
        $this->assertEquals('wp_head', $option);
    }

    /** @test */
    public function it_loads_the_script_snippet()
    {
        $hubspotId = 'XXXXXX';
        ob_start();
        ?>
        <!-- Start of HubSpot Embed Code -->
        <script type="text/javascript" id="hs-script-loader" async defer src="//js.hs-scripts.com/<?= $hubspotId ?>.js"></script>
        <!-- End of HubSpot Embed Code -->
        <?php

        $code_snippet = ob_get_contents();
        ob_end_clean();
        $this->expectOutputString(trim($code_snippet));

        $hotjar = new Hubspot($this->options);
        ob_start();
        $hotjar->load_script();
        $snippet = ob_get_contents();
        ob_end_clean();
        echo trim($snippet);
    }
}
