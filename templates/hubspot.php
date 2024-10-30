<?php
$settings = $setting->retrieveCurrentOptions();
?>
<tr>
    <th scope="row">
        <label for="hubspot-id">Hubspot Tracking ID</label>
    </th>
    <td>
        <input type="text" id="hubspot-id" class="regular-text" name="hubspot-id"
               value="<?= $settings['hubspot']['id'] ?>">
        <p class="description">This is the Hubspot ID.</p>
    </td>
</tr>
<tr>
    <th scope="row">
        <label for="hubspot-hook">Hook</label>
    </th>
    <td>
        <select name="hubspot-hook" id="hubspot-hook">
            <option value="" <?= $settings['hubspot']['hook'] == '' ? 'selected' : '' ?>> --- Select ---</option>
            <option value="wp_footer" <?= $settings['hubspot']['hook'] == 'wp_footer' ? 'selected' : '' ?>>Footer
            </option>
        </select>
        <p class="description">If none is selected, the script will be added to the head section of your website.</p>
    </td>
</tr>
