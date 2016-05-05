<?php
// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die('Damn it.! Dude you are looking for what?');
}
?>
<h3>Conditional Load Settings &hellip;</h3>
<?php $options = get_option( 'dcl_gnrl_options' ); ?>
<table class="form-table">
	<tbody>
			<tr valign="top">
				<th scope="row"><label>How to Load Disqus<br><span class="description thin">to improve performance</span></label></th>
					<td>
						<select id="dcl_type" class="select" typle="select" name="dcl_gnrl_options[dcl_type]" required>
							<option value="click" <?php selected( $options['dcl_type'], 'click' ); ?>>On Click</option>
							<option value="scroll" <?php selected( $options['dcl_type'], 'scroll' ); ?>>On Scroll</option>
							<option value="normal" <?php selected( $options['dcl_type'], 'normal' ); ?>>Normal (Disable Lazy Load)</option>
							<option value="" disabled>On Scroll Start (Pro Only)</option>
						</select><br/>
						<span class="description thin">This feature will let you prevent Disqus from automatically loading comments and scripts on pages, posts or whatever it is. If you choose "Normal" comments will be loaded normally and no lazy load effect will be there.</span>
					</td>
			</tr>

			<tr valign="top">
				<th scope="row"><label>Disqus Comments Width<br><span class="description thin">to match your theme</span></label></th>
					<td>
						<input placeholder="Default" type="number" name="dcl_gnrl_options[dcl_div_width]" value="<?php echo $options['dcl_div_width']; ?>" size="20">
						<input type="radio" name="dcl_gnrl_options[dcl_div_width_type]" <?php checked($options['dcl_div_width_type'], '%'); ?> value="%">%
						<input type="radio" name="dcl_gnrl_options[dcl_div_width_type]" <?php checked($options['dcl_div_width_type'], 'px'); ?> value="px">px<br/>
						<span class="description thin">If Disqus comments are not looking good because of the large or smaller width, you can adjust the width of comments division here. Just enter the width size. Leave empty if not required.</span>
					</td>
			</tr>

			<tr valign="top">
				<th scope="row"><label>Count Script<br><span class="description thin">only load if needed</span></label></th>
					<td>
						<select id="dcl_count_disable" class="select" typle="select" name="dcl_gnrl_options[dcl_count_disable]">
							<option value="1" <?php selected( $options['dcl_count_disable'], 1 ); ?>>Enable</option>
							<option value="0" <?php selected( $options['dcl_count_disable'], 0 ); ?>>Disable</option>
						</select><br/>
						<span class="description thin">By default Disqus may load a script (count.js) to get the comments count to show somewhere on your pages. Disabling this feature can improve page loading speed but may remove link to comments area.</span>
					</td>
			</tr>
		<div id="button_prop">
			<tr valign="top">
				<th scope="row"><label>Button Text<br><span class="description thin">to attract visitors</span></label></th>
					<td>
						<input placeholder="Load Comments" type="text" name="dcl_gnrl_options[dcl_btn_txt]" value="<?php echo $options['dcl_btn_txt']; ?>" size="20"><br/>
						<span class="description thin">If you are loading Disqus using On Click feature, then there will be a button to load comments. If you want to use custom text on the button, enter it here. By default it will be "Load Comments" (Works only with "On Click" option)</span>
					</td>
			</tr>
			<tr valign="top">
				<th scope="row"><label>Custom Button Class<br><span class="description thin">to customize the button</span></label></th>
					<td>
						<input type="text" name="dcl_gnrl_options[dcl_btn_class]" value="<?php echo $options['dcl_btn_class']; ?>" size="20"><br/>
						<span class="description thin">Here you can add any custom class to the button. By using custom class you can use your own style for comment button. Leave empty if you don't care. (Works only with "On Click" option)</span>
					</td>
			</tr>
			<tr valign="top">
				<th scope="row"><label>Loading Message<br><span class="description thin">to impress visitors</span></label></th>
					<td>
						<input placeholder="Loading.." type="text" name="dcl_gnrl_options[dcl_message]" value="<?php echo $options['dcl_message']; ?>" size="20"><br/>
						<span class="description thin">There may be few milliseconds delay before Disqus starts loading when visitors clicks on the button. Enter something here, and we will show that during that delay. By Default it will be "Loading..". You may use html tags like <code>&lt;p&gt; &lt;b&gt; &lt;h2&gt;</code>(Works only with "On Click" option)</span>
					</td>
			</tr>
			<tr valign="top">
				<th scope="row"><label>Disable on CPTs<br><span class="description thin">to skip custom post types</span></label></th>
					<td>
						<input placeholder="product" type="text" name="dcl_gnrl_options[dcl_cpt_exclude]" value="<?php echo $options['dcl_cpt_exclude']; ?>"><br/><br/>
						<span class="description thin">If Disqus adds its scripts on custom post types, and you dont like it, enter the custom post type here. Separate with comma.</span>
					</td>
			</tr>
                        <tr valign="top">
				<th scope="row"><label>Caching Support<br><span class="description thin">to work with caching plugins</span></label></th>
					<td>
						<select id="dcl_caching" class="select" name="dcl_gnrl_options[dcl_caching]">
							<option value="1" <?php selected( $options['dcl_caching'], 1 ); ?>>Enable</option>
							<option value="0" <?php selected( $options['dcl_caching'], 0 ); ?>>Disable</option>
						</select><br/>
						<span class="description thin">If you are having issues loading Disqus comments when caching is enabled, please enable this.</span>
					</td>
			</tr>
			<tr valign="top">
				<th scope="row"><label>Rocker Loader Support<br><span class="description thin">to ignore the Disqus script</span></label></th>
					<td>
						<select id="dcl_cfasync" class="select" name="dcl_gnrl_options[dcl_cfasync]">
							<option value="1" <?php selected( $options['dcl_cfasync'], 1 ); ?>>Enable</option>
							<option value="0" <?php selected( $options['dcl_cfasync'], 0 ); ?>>Disable</option>
						</select><br/>
						<span class="description thin">If you are using Cloudflare Rocker Loader, enable this to have <a href="https://support.cloudflare.com/hc/en-us/articles/200169436-How-can-I-have-Rocket-Loader-ignore-my-script-s-in-Automatic-Mode-" target="_blank">Rocket Loader ignore</a> the Disqus scripts by adding the <code>data-cfasync="false"</code> attribute to the script tag.</span>
					</td>
			</tr>
		</div>
	</tbody>
</table>