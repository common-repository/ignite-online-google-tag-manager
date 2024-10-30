<?php
$settings = $setting->retrieveCurrentOptions();
?>
<tr>
    <th scope="row">
        <label for="facebook-id">Google Tag Manager ID</label>
    </th>
    <td>
        <input type="text" id="facebook-id" class="regular-text" name="facebook-id" value="<?= $settings['facebook']['id'] ?>">
        <p class="description">This is the Facebook Pixel ID created in Facebook.</p>
    </td>
</tr>
<tr>
    <th scope="row">
        <label for="facebook-hook">Hook</label>
    </th>
    <td>
        <select name="facebook-hook" id="facebook-hook">
            <option value="" <?= $settings['facebook']['hook'] == '' ? 'selected': '' ?>> --- Select ---</option>
            <option value="wp_footer" <?= $settings['facebook']['hook'] == 'wp_footer' ? 'selected' : '' ?>>Footer</option>
        </select>
        <p class="description">If none is selected, the script will be added to the head section of your website.</p>
    </td>
</tr>
