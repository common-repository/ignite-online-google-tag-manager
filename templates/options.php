<?php

use IgniteOnline\Utils\GlobalSettings;

$setting = new GlobalSettings();
$currentTag = isset($_GET['tab']) ? $_GET['tab'] : 'gtm';
?>
<div class="container wrap">
    <h3>Ignite Tag Manager</h3>

    <h2 class="nav-tab-wrapper">
        <a href="<?= admin_url() . '?page=' . $setting->adminPageSlug ?>&tab=gtm"
           class="nav-tab <?= $currentTag == 'gtm' ? 'nav-tab-active' : '' ?>">Google Tag Manager</a>
        <a href="<?= admin_url() . '?page=' . $setting->adminPageSlug ?>&tab=hubspot"
           class="nav-tab <?= $currentTag == 'hubspot' ? 'nav-tab-active' : '' ?>">Hubspot</a>
        <a href="<?= admin_url() . '?page=' . $setting->adminPageSlug ?>&tab=hotjar"
           class="nav-tab <?= $currentTag == 'hotjar' ? 'nav-tab-active' : '' ?>">Hotjar</a>
        <a href="<?= admin_url() . '?page=' . $setting->adminPageSlug ?>&tab=facebook"
           class="nav-tab <?= $currentTag == 'facebook' ? 'nav-tab-active' : '' ?>">Facebook</a>
    </h2>
    <form action="" method="post">
        <table class="form-table">
            <tbody>
            <?php if ($currentTag == 'gtm') : ?>
                <?php include "google-tag-manager.php"; ?>
            <?php endif; ?>
            <?php if ($currentTag == 'hubspot') : ?>
                <?php include "hubspot.php"; ?>
            <?php endif; ?>
            <?php if ($currentTag == 'hotjar') : ?>
                <?php include "hotjar.php"; ?>
            <?php endif; ?>
            <?php if ($currentTag == 'facebook') : ?>
                <?php include "facebook.php"; ?>
            <?php endif; ?>
            <?php wp_nonce_field('ignite-tm-save', 'ignite-tm'); ?>
            <tr>
                <td>
                    <?php submit_button('Save Settings'); ?>
                </td>
            </tr>
            </tbody>
        </table>
    </form>
</div>