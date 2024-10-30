<?php
$settings = $setting->retrieveCurrentOptions();
?>
<tr>
    <th scope="row">
        <label for="gtm-id">Google Tag Manager ID</label>
    </th>
    <td>
        <input type="text" id="gtm-id" class="regular-text" name="gtm-id" value="<?= $settings['gtm']['id'] ?>">
        <p class="description">This is the Tag Manager ID that you can find on the top right corner of the screen when
            creating a container.</p>
    </td>
</tr>
<tr>
    <th scope="row">
        <label for="gtm-hook">Hook</label>
    </th>
    <td>
        <select name="gtm-hook" id="gtm-hook">
            <option value="" <?= $settings['gtm']['hook'] == '' ? 'selected': '' ?>> --- Select ---</option>
            <option value="wp_footer" <?= $settings['gtm']['hook'] == 'wp_footer' ? 'selected' : '' ?>>Footer</option>
        </select>
        <p class="description">If none is selected, the script will be added to the head section of your website.</p>
    </td>
</tr>
