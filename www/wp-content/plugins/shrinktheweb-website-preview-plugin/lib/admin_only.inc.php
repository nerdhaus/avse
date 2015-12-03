<?php

/**
 * Message shown when a feature requires an upgrade.
 */
define('STWWT_FEATURE_UPGRADE', '<span class="stwwt_account_upgrade">This is a PRO feature, and requires an <a href="http://www.shrinktheweb.com/auth/order-page" target="_blank">account upgrade</a>.</span>');

/**
 * Message shown when an account requires a Basic or PLUS account.
 */
define('STWWT_ACCOUNT_UPGRADE', '<span class="stwwt_account_upgrade">Requires <b>Basic</b> or <b>PLUS</b> account. <a href="http://www.shrinktheweb.com/auth/order-page" target="_blank">Upgrade your account.</a></span>');



/**
 * Shows the usage guide on the documentation page.
 */
function STWWT_showPage_Documentation()
{
	$page = new PageBuilder(false);
	$page->showPageHeader(__('Shrink The Web - How to use the plugin', 'stwwt'), '70%');
	
	?>
	
	<div class="stwwt_doc_wrap">
	<div class="stwwt_doc_title">
		<a name="embed"></a>	
		<h3>Embedded Screenshots - Shortcodes</h3>
	</div>
	<div id="stwwt_size_box">
		<p><b>Valid sizes for the size="xlg" option are:</b></p>
		<ul>
			<li><code>mcr</code> = Micro</li>
			<li><code>tny</code> = Tiny</li>
			<li><code>vsm</code> = Very Small</li>
			<li><code>sm</code> = Small</li>
			<li><code>lg</code> = Large</li>
			<li><code>xlg</code> = Extra Large</li>
		</ul>	
		</div>
		
		<p>The Shrink The Web embed code shows a thumbnail for any link you wrap in <code>[thumb][/thumb]</code> or <code>[stwthumb][/stwthumb]</code> tags. Any use of these tags is replaced
		with the thumbnail of the website included in the tags. </p>
		<p>The <code>link</code> attribute, which can be <code>true</code> (add a link) or <code>false</code> (don't add a link). The <code>size</code> attribute, which can <code>mcr</code>, <code>tny</code>, <code>vsm</code>, <code>sm</code>, <code>lg</code> or  <code>xlg</code>.</p>
		<dl class="stwwt_examples">
			<dt>1) [thumb]http://www.shrinktheweb.com[/thumb]</dt>
			<dd>Creates a thumbnail using the default thumbail size.</dd>
			
			<dt>2) [thumb link="true"]http://www.shrinktheweb.com[/thumb]</dt>
			<dd>Creates a thumbnail using the default thumbail size , and also adds a link to the http://www.shrinktheweb.com URL. If you have a free account, the link is always added.</dd>
			
			<dt>3) [thumb link="true" size="xlg"]http://www.shrinktheweb.com[/thumb]</dt>
			<dd>Creates an extra-large thumbnail <b>regardless</b> of the default thumbnail size. Also adds a link to the http://www.shrinktheweb.com URL. If you have a free account, the link is always added.</dd>
			
			<dt>4) [thumb size="sm"]http://www.shrinktheweb.com[/thumb]</dt>
			<dd>Creates a small thumbnail <b>regardless</b> of the default thumbnail size. </dd>
		</dl>
	</div>
	
	
	
	
	<div class="stwwt_doc_wrap">
	<div class="stwwt_doc_title">
		<a name="embed"></a>	
		<h3>Pro Feature - Full-Length Screenshots</h3>
	</div>
	
	<?php if (STWWT_account_featuredAllowed('embedded_pro_full_length')) : ?>
		
		<p>The full length capture feature uses the <code>full_length</code> attribute, which can be <code>true</code> or <code>false</code>. This attribute works with any of the other attributes on this page. Here are some examples:</p>  
		<dl class="stwwt_examples">
			<dt>1) [thumb full_length="true"]http://www.shrinktheweb.com[/thumb]</dt>
			<dd>Creates a thumbnail using the default thumbail size, but forces the display of a <b>full length</b> screenshot thumbnail even if the full-length setting is disabled globally.</dd>
			
			<dt>2) [thumb link="true" full_length="true"]http://www.shrinktheweb.com[/thumb]</dt>
			<dd>Creates a thumbnail using the default thumbail size, as a full length thumbnail, and also adds a link to the http://www.shrinktheweb.com URL.</dd>
			
			<dt>3) [thumb full_length="false"]http://www.shrinktheweb.com[/thumb]</dt>
			<dd>Creates a thumbnail using the default thumbail size, but forces the display of a <b>normal length</b> screenshot thumbnail even if the full-length setting is enabled globally.</dd>
			
			<dt>4) [thumb size="xlg" full_length="true"]http://www.shrinktheweb.com[/thumb]</dt>
			<dd>Creates an extra large width thumbnail and forces the display of a <b>full length</b> screenshot thumbnail even if the full-length setting is disabled globally.</dd>
		</dl>
		
	<?php else : ?>	
		<div class="stwwt_upgrade_required"><?php echo STWWT_FEATURE_UPGRADE; ?></div>
	<?php endif; ?>
	</div>
	
	
	
	
	<div class="stwwt_doc_wrap">
	<div class="stwwt_doc_title">
		<a name="embed"></a>	
		<h3>Pro Feature - Custom Size Screenshots</h3>
	</div>
	
	<?php if (STWWT_account_featuredAllowed('embedded_pro_custom_size')) : ?>		
		<p>The custom-size feature uses the <code>size</code> attribute, which can be  <code>mcr</code>,  <code>tny</code>,  <code>vsm</code>,  <code>sm</code>,  <code>lg</code>,  <code>xlg</code>, or a number e.g.  <code>500</code> or  <code>230</code>. This attribute works with any of the other attributes on this page. Here are some examples:</p>  
		<dl class="stwwt_examples">
			<dt>1) [thumb size="600" ]http://www.shrinktheweb.com[/thumb]</dt>
			<dd>Creates a thumbnail <b>600 pixels wide</b>, regardless of the global thumbnail size.</dd>
			
			<dt>2) [thumb size="340" ]http://www.shrinktheweb.com[/thumb]</dt>
			<dd>Creates a thumbnail <b>340 pixels wide</b>, regardless of the global thumbnail size.</dd>			
			
			<dt>3) [thumb]http://www.shrinktheweb.com[/thumb]</dt>
			<dd>Creates a thumbnail using the default thumbail size.</dd>
			
			<dt>4) [thumb size="lg"]http://www.shrinktheweb.com[/thumb]</dt>
			<dd>Creates a thumbnail using the large thumbail size, regardless of the global thumbnail size.</dd>
			
			<dt>5) [thumb size="340"  link="true"]http://www.shrinktheweb.com[/thumb]</dt>
			<dd>Creates a thumbnail <b>340 pixels wide</b> and also adds a link to the http://www.shrinktheweb.com URL.</dd>
		</dl>
		
	<?php else : ?>	
		<div class="stwwt_upgrade_required"><?php echo STWWT_FEATURE_UPGRADE; ?></div>
	<?php endif; ?>
	</div>

	
	<?php
	
	$page->showPageFooter();
}

/**
 * Shows information about the thumbnail cache.
 */
function STWWT_showPage_ThumbnailCache()
{
	$page = new PageBuilder(false);
	$page->showPageHeader(__('Shrink The Web - Website Thumbnails - Cache', 'stwwt'), '70%');
	
	?>
	<h3>Clear Thumbnail Cache</h3>
	<p>Generally speaking, you do not need to clear the thumbnail cache. The plugin automatically manages the thumbnail cache, updating thumbnails automatically. However, if you do need to clear the cache for any reason, you can use the button below to flush the cache.</p>
	<?php 
		
	$form = new FormBuilder('stwwt_cache_clear');
	$form->setSubmitLabel('Clear Thumbnail Cache');
	
	if ($form->formSubmitted() && $form->formValid()) 
	{
		STWWT_cache_emptyCache(false);
		$page->showMessage("Cache successfully emptied.");	
	}
	
	echo $form->toString();
	
		
	
	// #### Cache Path Information
	$cachePathDir = STWWT_plugin_getCacheDirectory();
	$cachePathURL = STWWT_plugin_getCacheURL();
	$pathIsWriteable = (file_exists($cachePathDir) && is_dir($cachePathDir) && is_writable($cachePathDir));
	
	?>
	<br/>
	<h3>Cache Path Information</h3>
	<p>Your server cache path is <b><?php echo $cachePathDir; ?></b>, which translates to a URL of <b><?php echo $cachePathURL; ?></b>.</p>
	<p>Your cache path is currently <?php echo ($pathIsWriteable ? '<span class="stwwt_cache_status stwwt_cache_ok">Writeable</span>. This is fine, so you do not need to do anything more.' : '<span class="stwwt_cache_status stwwt_cache_error">Not Writeable</span>. This needs fixing for the thumbnail cache to work.'); ?></p>
	<?php
	
	$page->showPageFooter();
}

/**
 * Shows the page where the caching settings and information is shown.
 */
function STWWT_showPage_ErrorLogs()
{
	// To add at some point - shows if the cache directory is writeable.
	//$cachePath = STWWT_plugin_getCacheDirectory(); 
	//echo $isWriteable = (file_exists($cachePath) && is_dir($cachePath) && is_writable($cachePath));

	global $wpdb;
	$wpdb->show_errors();
	$error_log = $wpdb->prefix . STWWT_TABLE_ERRORS;		
	
	$page = new PageBuilder(false);
	$page->showPageHeader(__('Shrink The Web - Website Thumbnails - Error Logs', 'stwwt'), '70%');
	
	
	// Check for clear of logs
	if (isset($_POST['stwwt-clear-logs']))
	{
		// Delete error thumbnails
		STWWT_cache_emptyCache(true);
		
		$SQL = "TRUNCATE $error_log";
		$wpdb->query($SQL);
		
		$page->showMessage("Debug logs have successfully been emptied.");
	}
	
	
	// Refresh and Clear Buttons
	?>
		<form class="stwwt-button-right" method="post" action="<?= str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>">
			<input type="submit" name="stwwt-refresh-logs" value="Refresh Logs" class="button-primary" />
			<input type="submit" name="stwwt-clear-logs" value="Clear Logs" class="button-secondary" />
			<div class="stwwt-clear"></div>
		</form>	
	<?php 
		
		$SQL = "SELECT *, UNIX_TIMESTAMP(request_date) AS request_date_ts
				FROM $error_log
				ORDER BY request_date DESC
				LIMIT 50
				";
		
		$wpdb->show_errors();
		$logMsgs = $wpdb->get_results($SQL, OBJECT);

		if ($logMsgs)
		{
			printf('<div id="stwwt_error_count">Showing a total of <b>%d</b> log messages.</div>', $wpdb->num_rows); 
			?>
			<p>All <b>errors are cached for 12 hours</b> so that your thumbnail allowance with STW does not get used up if you have persistent errors. 
			If you've <b>had errors</b>, and you've <b>now fixed them</b>, you can click on the '<b>Clear Logs</b>' button on the right 
			to <b>flush the error cache</b> and re-attempt to fetch a thumbnail.</p>
			<?php 
			
			$table = new TableBuilder();
			$table->attributes = array("id" => "stwwt_error_log");
	
			$column = new TableColumn("ID", "id");
			$column->cellClass = "stwwt_id";
			$table->addColumn($column);
			
			$column = new TableColumn("Result", "request_result");
			$column->cellClass = "stwwt_result";
			$table->addColumn($column);			
			
			$column = new TableColumn("Requested URL", "request_url");
			$column->cellClass = "stwwt_url";
			$table->addColumn($column);
			
			$column = new TableColumn("Type", "request_type");
			$column->cellClass = "stwwt_type";
			$table->addColumn($column);
			
			$column = new TableColumn("Request Date", "request_date");
			$column->cellClass = "stwwt_request-date";
			$table->addColumn($column);
			
			$column = new TableColumn("Detail", "request_detail");
			$column->cellClass = "stwwt_detail";
			$table->addColumn($column);

			
			foreach ($logMsgs as $logDetail)
			{
				$rowdata = array();
				$rowdata['id'] 				= $logDetail->logid;
				$rowdata['request_url'] 	= $logDetail->request_url;
				$rowdata['request_type'] 	= $logDetail->request_type;
				$rowdata['request_result'] 	= '<span>'.($logDetail->request_result == 1 ? 'Success' : 'Error').'</span>';
				$rowdata['request_date'] 	= $logDetail->request_date . '<br/>' . 'about '. human_time_diff($logDetail->request_date_ts) . ' ago';
				
				
				// Show arguments and details
				$rowdata['request_detail'] = sprintf('<span class="stwwt_debug_header">Error Message</span>
					  									   <span class="stwwt_debug_info">%s</span>', $logDetail->request_error_msg);
				
				$rowdata['request_detail'] .= sprintf('<span class="stwwt_debug_header">Request Arguments</span>
					  									   <span class="stwwt_debug_info">%s</span>', STWWT_debug_formatArray(unserialize($logDetail->request_args)));
				
				if ($logDetail->request_detail) {
					$rowdata['request_detail'] 	.= sprintf('<span class="stwwt_debug_header">Raw STW Response</span>
					  									   <textarea class="stwwt_debug_raw" readonly="readonly">%s</textarea>', htmlentities($logDetail->request_detail));
				}
				
				$table->addRow($rowdata, ($logDetail->request_result == 1 ? 'stwwt_success' : 'stwwt_error'));
			}
			
			// Finally show table
			echo $table->toString();
			echo "<br/>";
		}
		else {
			printf('<div class="stwwt_clear"></div>');
			$page->showMessage("There are currently no debug logs to show.", true);
		}
	
	 
	$page->showPageFooter();
}





/**
 * Function that shows the settings page.
 */
function STWWT_showPage_Settings()
{
	/**
 	 * Constant: Documentation on how the mouseover bubble works.
 	 */
	define('STWWT_DESC_MOUSEOVER',		'
		<p><img src="'.STWWT_plugin_getPluginPath().'img/stw_bubble_example.png" class="stwwt_settings_bubble_example"/> 
		The Shrink The Web mouseover bubble shows a thumbnail of the website when hovered over a link on your WordPress website. 
		This gives website visitors a preview of the link before they visit the website you link to.</p>
		<p>If the "<b>Automatic</b>" is selected below, all external links will show ShrinkTheWeb preview bubbles. Use <code>class="nopopup"</code> to disable popup bubble for a specific link.</p>
		<p>If the "<b>Manual</b>" method is selected below, then you choose which links get a preview bubble by adding <code>class="stwpopup"</code> to any link where you want to show them.</p>
		<div class="stwwt_clear"></div>
	');
	
	/**
 	 * Constant: Documentation on how the embedded code works.
 	 */	
	define('STWWT_DESC_EMBEDDED', '
		<p>The Shrink The Web embed code shows a thumbnail for any link you wrap in <code>[thumb][/thumb]</code> or <code>[stwthumb][/stwthumb]</code> tags. Any use of these tags is replaced with the thumbnail of the website included in the tags. <a href="admin.php?page=stwwt_documentation#embed">See some examples on the documentation page</a>.

	');
	
	
	/**
 	 * Constant: Documentation on how the pro features work.
 	 */	
	define('STWWT_DESC_EMBEDDED_PRO',		'
		<p>The following features <b>require an upgraded account</b>. You can find more details on the <a href="https://www.shrinktheweb.com/auth/order-page" target="_blank">Shrink The Web Upgrade Page</a>.</p>
		<p>These settings are <b>global</b>, so they apply to <b>all thumbnails</b> on your website. Some of these settings have a per-thumbnail override, so please read <a href="admin.php?page=stwwt_documentation">the documentation</a> on how to apply these settings to specific thumbnails.</p>
	');
	
	
	$page = new PageBuilder(true);
	$page->showPageHeader(__('Shrink The Web - Website Thumbnails - Settings', 'stwwt'), '70%');
	
	$page->openPane('stw_settings_main', 'Thumbnail Settings');
	
	
		
	$settingDetails = array(
	
		'stwwt_break_main' => array(
				'type'  				=> 'break',
				'html'  				=> STWWT_forms_createBreakHTML('Account Settings'),
			),
	
		'stwwt_access_id' => array(
				'label' 	=> 'Access Key Id',
				'type'  	=> 'text',
				'required'  => true,
				'cssclass'	=> 'stwwt_access_id',
				'desc'  	=> 'Your Shrink The Web <b>access</b> key. You can find this within your <a href="http://www.shrinktheweb.com/auth/stw-lobby" target="_blank">STW Account Details</a>.',
				'validate'	 	=> array(
					'type'		=> 'string',
					'regexp'	=> '/^[A-Za-z0-9]{12,20}$/',
					'error'		=> 'Your STW access key should only contain numbers and letters, and it\'s about 15 characters long.'
				)	
			),
			
		'stwwt_secret_id' => array(
				'label' 	=> 'Secret Key Id',
				'type'  	=> 'text',
				'required'  => true,
				'cssclass'	=> 'stwwt_access_id',
				'desc'  	=> 'Your Shrink The Web <b>secret</b> key. You can find this within your <a href="http://www.shrinktheweb.com/auth/stw-lobby" target="_blank">STW Account Details</a>.',
				'validate'	 	=> array(
					'type'		=> 'string',
					'regexp'	=> '/^[A-Za-z0-9]{5,10}$/',
					'error'		=> 'Your STW access key should only contain numbers and letters, and it\'s about 5 characters long.'
				)	
			),			
			
		'stwwt_account_level' => array(
				'label' 	=> 'Your STW Account Level',
				'type'  	=> 'custom',
				'html'		=> false,
				'desc'  	=> 'If you change any aspects of your Shrink The Web account (such as upgrades), click on the <b>Save All Settings</b> button below to re-load what features you can use.',	
			),							
				
			
		'stwwt_break_embedded' => array(
				'type'  				=> 'break',
				'html'  				=> STWWT_forms_createBreakHTML('Screenshot Settings', 'Save ALL Settings') .
							   '<div class="stwwt_description">'.STWWT_DESC_EMBEDDED.'</div>',
			),
			
		'stwwt_shortcode' => array(
				'label' 				=> 'Shortcode Syntax',
				'type'  				=> 'radio',
				'data'					=> array(
												'stwthumb'	=> '<b>[stwthumb]</b>',
												'thumb' 	=> '[thumb]',
											),
				'default'				=> 'thumb'
			),
			
		'stwwt_embedded_default_size' => array(
				'label' 				=> 'Default Screenshot Size',
				'type'  				=> 'select',				
				'data'					=> array(
												'mcr'	=> 'Micro (75x56)',
												'tny'	=> 'Tiny (90x68)',
												'vsm'	=> 'Very Small (100x75)',
												'sm'	=> 'Small (120x90)',
												'lg' 	=> 'Large (200x150)', 
												'xlg' 	=> 'Extra Large (320x200)'			
											),	
				'desc'  				=> 'The size of the thumbnail shown by the thumbnail shortcode.',
				'default'				=> 'lg'
			),

		'stwwt_embedded_cache_length' => array(
				'label' 				=> 'Cache Length in Days',
				'type'  				=> 'select',				
				'data'					=> array(
												'3'		=> '3 Days',
												'7'		=> '7 Days (recommended)',
												'10'	=> '10 Days',			 			
												'14'	=> '14 Days',
												'21'	=> '21 Days',
												'30'	=> '30 Days'			
											),	
				'desc'  				=> 'How long you want to cache the thumbnails for.',
				'account_level' 		=> array('basic', 'plus'),
				'account_denied_msg' 	=> STWWT_ACCOUNT_UPGRADE,
				'default'				=> 7
			),			
			
		'stwwt_break_embedded_pro' => array(
				'type'  				=> 'break',
				'html'  				=> STWWT_forms_createBreakHTML('PRO Feature Settings', 'Save ALL Settings') .
							   				'<div class="stwwt_description">'.STWWT_DESC_EMBEDDED_PRO.'</div>',
			),
			
		'stwwt_embedded_pro_inside' => array(
				'label' 				=> 'Inside Pages Capture',
				'type'  				=> 'radio',				
				'data'					=> array(
												'enable'	=> '<b>Enabled</b>',
												'disable' 	=> 'Disabled', 
											),	
				'account_feature' 		=> 'embedded_pro_inside',
				'account_denied_msg' 	=> STWWT_FEATURE_UPGRADE,		
				'default'				=> 'disable'						
			),	 

		'stwwt_embedded_pro_full_length' => array(
				'label' 				=> 'Full-length Page Captures',
				'type'  				=> 'radio',				
				'data'					=> array(
											'enable'	=> '<b>Enabled</b>',
											'disable' 	=> 'Disabled', 
										),	
				'account_feature' 		=> 'embedded_pro_full_length',
				'account_denied_msg' 	=> STWWT_FEATURE_UPGRADE,	
				'default'				=> 'disable'						
			),				

		'stwwt_embedded_pro_custom_quality' => array(
				'label' 				=> 'Custom Thumbnail Quality',
				'type'  				=> 'select',				
				'data'					=> STWWT_getQualityList(),	
				'desc'					=> 'If you want to customise the thumbnail image quality, then you can select a quality value between 1% and 100%. A value of <b>1% is the lowest quality</b>, and <b>100% is the best quality</b>.',
				'account_feature' 		=> 'embedded_pro_custom_quality',
				'account_denied_msg' 	=> STWWT_FEATURE_UPGRADE,			
			),
			
		'stwwt_break_bubble' => array(
				'type'  	=> 'break',
				'html'  	=> STWWT_forms_createBreakHTML('Mouseover Bubble Settings', 'Save ALL Settings') . 
								'<div class="stwwt_description">'.STWWT_DESC_MOUSEOVER.'</div>',
			),
			
		'stwwt_bubble_method' => array(
				'label' 	=> 'Preview Bubbles Show Method',
				'type'  	=> 'select',				
				'data'		=> array(
									'disable'	=> 'Disabled',
									'automatic' => 'Automatic', 
									'manual' 	=> 'Manual'
								),	 
				'default'	=> 'disable'
			),
			
		'stwwt_bubble_size' => array(
				'label' 	=> 'Preview Bubbles Thumbnail Size',
				'type'  	=> 'select',				
				'data'		=> array(
									'sm'	=> 'Small (120x90)',
									'lg' 	=> 'Large (200x150)', 
									'xlg' 	=> 'Extra Large (320x200)'
								),	
				'desc'  	=> 'The size of the thumbnail shown in the preview bubble when a website visitor hovers over a link.',
				'default'	=> 'lg'
			),				
		
	);
		
	// Show main settings form
	$settings = new STWSettingsForm($settingDetails, STWWT_SETTINGS_KEY, 'stwwt_settings');
	$settings->setSaveButtonLabel('Save ALL Settings');
	$settings->show();
	
	
	// #### Support section
	$page->showPageMiddle('27%');
	
	$yes = sprintf('<img src="%simg/icon_%s.png" />', STWWT_plugin_getPluginPath(),  'tick');
	$no  = sprintf('<img src="%simg/icon_%s.png" />', STWWT_plugin_getPluginPath(),  'cross');
	
	// Feature check
	$accountSettings = TidySettings_getSettings(STWWT_SETTINGS_KEY_ACCOUNT);
	if ($accountSettings) 
	{
		$page->openPane('stw_settings_support', 'Your Account Features');
			
		?>
			<table id="stwwt_feature_comp">
				<thead>
					<tr>
						<th>Feature</th>
						<th>Your Account</th>
					</tr>
				</thead>
				<tbody>										
					<?php
	
					// Now show the features
					unset($accountSettings['account_type']); // So we can just loop through settings.
					foreach ($accountSettings as $settingName => $enabled)
					{
						switch ($settingName)	
						{
							case 'embedded_pro_inside':
								printf('<tr><th>%s</th><td>%s</td></tr>', 'Inside Pages Capture', (1 == $enabled ? $yes : $no));
								break;
								
							case 'embedded_pro_full_length':
								printf('<tr><th>%s</th><td>%s</td></tr>', 'Full Length Capture', (1 == $enabled ? $yes : $no));
								break;
								
							case 'embedded_pro_custom_size':
								printf('<tr><th>%s</th><td>%s</td></tr>', 'Custom Sizes', (1 == $enabled ? $yes : $no));
								break;
								
							case 'embedded_pro_custom_quality':
								printf('<tr><th>%s</th><td>%s</td></tr>', 'Custom Quality', (1 == $enabled ? $yes : $no));
								break;							
															
	
							// Don't show feature
							default: 
								break;
						}
					}
					
					?>
					
				</tbody>
			</table>
	
		<?php 
		
		$page->closePane();
	} // end of your feature list
		
	$page->openPane('stw_settings_support', 'Get a STW Account...');	
	?>
	<div id="stwwt_signup">
			<a href="http://www.shrinktheweb.com/user/register" target="_blank">
				<img src="http://www.shrinktheweb.com/uploads/stw-banners/shrinktheweb-234x60.gif" alt="Website Thumbnail Provider" class="stwwt_settings_banner" width="234" height="60" alt="Register for a free account with Shrink The Web">
			</a>
			
			<div class="stwwt_settings_banner_text">
				<span>Need an account?</span>
				<a href="http://www.shrinktheweb.com/user/register" target="_blank" class="button-primary">Register for FREE</a>
			</div>
		</div>

	<?php 
	$page->closePane();
	
			
	
	// Support
	$page->openPane('stw_settings_support', 'Help &amp; Support');
	?>
	<p>If you've got a problem with the plugin, please follow the following steps.</p>
	<ol>
		<li>Check the <a href="http://wordpress.org/extend/plugins/shrinktheweb-website-preview-plugin/faq/" target="_blank">Frequently Asked Questions</a> on WordPress.org. Your issue might already be answered or resolved.</li>
		<li>Check the <a href="http://wordpress.org/tags/shrinktheweb-website-preview-plugin?forum_id=10" target="_blank">plugin support forum</a> on WordPress.org. Someone might have had the same issue, and fixed it already.</li>
		<li>If you think the problem is a <b>plugin problem</b>, please raise the problem in the <a href="http://wordpress.org/tags/shrinktheweb-website-preview-plugin?forum_id=10" target="_blank">plugin support forum</a> on WordPress.org, including <b>as much detail as possible</b>, including any <b>error messages</b>.</li>
		<li>If you think the problem is a <b>STW or STW account problem</b>, please raise the problem in the <a href="http://www.shrinktheweb.com/forum" target="_blank">STW support forum</a>, including <b>as much detail as possible</b>, including any <b>error messages</b>.</li>
	</ol>
	
	<br/>
	<div class="stwwt_title">A word about the plugin authors...</div>
	<p>This plugin and the <a href="http://www.shrinktheweb.com" target="_blank">Shrink The Web</a> service has been developed and is provided by <a href="http://www.neosys.net/profile.htm" target="_blank">Neosys Consulting, Inc.</a></p>
	<?php 
	$page->closePane();
	
	
	$page->showPageFooter();
}



/**
 * Create a break bar for the forms, with a save button too.
 * @param String $title The title for the section.
 * @param String $buttonText The text for the button on the break section.
 * @return String The HTML for the section break.
 */
function STWWT_forms_createBreakHTML($title, $buttonText = 'Save ALL Settings') 
{ 
	return sprintf('
		<div class="stwwt_form_break">
			<input type="submit" value="%s" name="Submit" class="button-primary">						
			<h3>%s</h3>
			<div class="stwwt_clear">&nbsp;</div>
		</div>
	', $buttonText, $title);
}



/**
 * Nicely formats an array for debug purposes.
 * @param Array $array The array to format.
 * @return String The formatted array.
 */
function STWWT_debug_formatArray($array)
{
	$html = false;
	if (!$array) {
		return false;
	}
	
	foreach ($array as $key => $value) 
	{
		$html .= sprintf('[%s] => %s<br/>', $key, urldecode($value));
	}
	
	return $html;
}