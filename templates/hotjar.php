<?php
$settings = $setting->retrieveCurrentOptions();
?>
<tr>
    <th scope="row">
        <label for="hotjar-id">hotjar Tracking ID</label>
    </th>
    <td>
        <input type="text" id="hotjar-id" class="regular-text" name="hotjar-id" value="<?= $settings['hotjar']['id'] ?>">
        <p class="description">This is the Hotjar ID.</p>
    </td>
</tr>
<tr>
    <th scope="row">
        <label for="hotjar-hook">Hook</label>
    </th>
    <td>
        <select name="hotjar-hook" id="hotjar-hook">
            <option value="" <?= $settings['hotjar']['hook'] == '' ? 'selected' : '' ?>> --- Select ---</option>
            <option value="wp_footer" <?= $settings['hotjar']['hook'] == 'wp_footer' ? 'selected' : '' ?>>Footer</option>
        </select>
        <p class="description">If none is selected, the script will be added to the head section of your website.</p>
    </td>
</tr>
