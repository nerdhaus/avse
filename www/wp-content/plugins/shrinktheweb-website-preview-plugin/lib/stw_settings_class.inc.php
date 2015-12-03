<?php


/**
 * Settings form for STW which includes account type validation
 * to ensure the user only sees the options that they can use
 * (to save confusion).
 */
class STWSettingsForm extends SettingsForm 
{
	
	
	
	/**
	 * Default constructor
	 */
	public function __construct ($paramList, $settingPrefix, $formID = false)
	{
		// Now create elements as usual
		parent::__construct($paramList, $settingPrefix, $formID);
		
		// Check if we have any defaults we can set. These are only set if the
		// settings are blank, so allows defaults to be defined when settings
		// have not yet been saved.
		$settings = TidySettings_getSettings($settingPrefix);
		$unsetDefaults = array();
		
		foreach ($paramList as $fieldName => $fieldDetails)
		{
			// If we have a default value defined, and the equivalent setting is blank
			// then add setting to list of settings to update.
			if (isset($fieldDetails['default']) && false == $settings[$fieldName]) {  	
				$unsetDefaults[$fieldName]	= $fieldDetails['default'];
				$settings[$fieldName]		= $fieldDetails['default'];
			}
		}
		
		// Defaults are saved to DB and set in the form, so that they get saved again
		// when the form is updated.
		if (count($unsetDefaults) > 0)
		{
			$this->formObj->setDefaultValues($unsetDefaults);
			TidySettings_saveSettings($settings, $settingPrefix);
		}
	}
	
	
	/**
	 * Handle processing the form when it's posted, such as saving and handling errors.
	 */
	protected function processPost()
	{
		// Process data as usual
		parent::processPost();
		
		// ### Now manipulate the interface

		// Get currently saved account details
		$settings = TidySettings_getSettings($this->settingPrefix);
				
		// Only do check if we have access ID and secret ID. Code will handle hiding pro features
		// automatically if we can't get the account details.
		$accountDetails = false;
		if (isset($settings['stwwt_access_id']) && isset($settings['stwwt_secret_id'])) {
			$accountDetails = $this->checkAccountType($settings['stwwt_access_id'], $settings['stwwt_secret_id']); 
		}
				
		// Check account level
		$accountLevel = 'invalid';
		if (isset($accountDetails['account_type'])) {
			$accountLevel = $accountDetails['account_type'];
		}
		
		// Save the account details to the database for use later.
		TidySettings_saveSettings($accountDetails, STWWT_SETTINGS_KEY_ACCOUNT);		
		
		
		// Set the account level in the interface
		if ($accountLevel == 'invalid') {
			$this->formObj->setElementHTML('stwwt_account_level', 
				sprintf('<span class="stwwt_account_invalid"><span class="stwwt_account_level">Invalid</span> - please provide valid account details.</span>'));
		} 
		// Valid account
		else 
		{ 
			$displayAcctName = ucwords($accountLevel);
			if ('Plus' == $displayAcctName) {
				$displayAcctName = 'PLUS';
			}
			
			$this->formObj->setElementHTML('stwwt_account_level', 
				sprintf('<span class="stwwt_account_level stwwt_account_%s">%s</span>', $accountLevel, $displayAcctName));
		}
		
		if (!empty($this->paramList))
		{
			// Look for any elements that have an account_level value. If that account level doesn't match the
			// desired account level, then that field doesn't get rendered. For all other fields, assume they 
			// have account.
			foreach ($this->paramList as $fieldName => $fieldDetails)
			{
				// ### Check 1 - Account level required
				if (isset($fieldDetails['account_level']) && $fieldDetails['account_level']) 
				{ 
					// Got a list of account levels? Copy them all over
					if (is_array($fieldDetails['account_level'])) 
					{
						if (!in_array($accountLevel, $fieldDetails['account_level'])) {
							$this->removeElementDueToAccountLevel($fieldName, $fieldDetails);
						}
					}
					
					// Just got a single entry, so just do a direct comparison. Remove element
					// if single entry doesn't match our specified account level.
					else {
						if ($fieldDetails['account_level'] != $accountLevel) {
							$this->removeElementDueToAccountLevel($fieldName, $fieldDetails);
						}
					}
					
				} // end if account level required
				
				
				// ### Check 2 - Check for account feature (independent of account level) 
				if (isset($fieldDetails['account_feature']) && $fieldDetails['account_feature']) 
				{					
					$featureName = $fieldDetails['account_feature'];
					if ((isset($accountDetails[$featureName]) && $accountDetails[$featureName] != 1) // Checks if feature is allowed 
						|| $accountLevel == 'invalid')	// Checks if account is invalid, if it is, then doesn't make sense to show pro features. 
					{ 
						$this->removeElementDueToAccountLevel($fieldName, $fieldDetails);
					}
				}
				
			} // end foreach 
		} // end if (!empty($paramList))								
	}
	
	
	/**
	 * Method called when settings form details are being saved.
	 * @param Array $formValues The list of settings being saved.
	 * @see wplib/SettingsForm::handleSave()
	 */
	protected function handleSave($formValues)
	{		
		// Do default saving
		parent::handleSave($formValues);
	}
	

	/**
	 * Method that automatically checks the user's account type and stores the information
	 * in the database, so that only the usable features can be used/displayed.
	 * 
	 * @param String $access_id The access ID to check.
	 * @param String $secret_key The secret key to check.
	 */
	private function checkAccountType($access_id, $secret_key)
	{
		$args['stwaccesskeyid'] = $access_id;
        $args['stwu'] 			= $secret_key;
		
		// Use WP method of fetch for compatibility
		
        // Get the details for this account
		$fetchURL = urldecode("http://images.shrinktheweb.com/account.php?".http_build_query($args));		
		$resp = wp_remote_get($fetchURL);	
		
		// Check there are no errors
		if (is_wp_error($resp) || 200 != $resp['response']['code'] ) 
		{	
			echo $this->showMessage('Error fetching account details.' . $resp->get_error_message(), true);	
			return false;
		}
		
		return $this->extractAccountDetails($resp['body']);
	}	
	
	
	/**
	 * Extracts the data from the raw XML into a useful Array that the plugin can use to
	 * check which features are enabled or disabled.
	 * 
	 * @param String $rawXML The raw XML from STW
	 * @return Array The account details as an array.
	 */
	private function extractAccountDetails($rawXML)
	{
		$accountDetails = array();
		
		$raw_Status 		= false;
		$raw_AccountLevel 	= false;
		
		// Use SimpleXML if we have it.
		if (!extension_loaded('simplexml')) 
		{
			// Load XML into DOM object
			$dom 		= new DOMDocument;
			$dom->loadXML($rawXML);
			$xml 		= simplexml_import_dom($dom);
	        $xmlLayout  = 'http://www.shrinktheweb.com/doc/stwacctresponse.xsd';			
			
			// Pull response codes from XML feed
			$raw_Status			= (string)$xml->children($xmlLayout)->Response->Status->StatusCode; 		// Request valid or not
			$raw_AccountLevel	= (string)$xml->children($xmlLayout)->Response->Account_Level->StatusCode; 	// Account level
		
			// Features
			$accountDetails['embedded_pro_inside'] 				= (string)$xml->children($xmlLayout)->Response->Inside_Pages->StatusCode; 		// Inside Pages 
			$accountDetails['embedded_pro_full_length'] 		= (string)$xml->children($xmlLayout)->Response->Full_Length->StatusCode; 		// Full Length
			$accountDetails['embedded_pro_custom_size'] 		= (string)$xml->children($xmlLayout)->Response->Custom_Size->StatusCode; 		// Custom Size
 			$accountDetails['embedded_pro_refresh_on_demand'] 	= (string)$xml->children($xmlLayout)->Response->Refresh_OnDemand->StatusCode; 	// Refresh On Demand
 			$accountDetails['embedded_pro_custom_delay'] 		= (string)$xml->children($xmlLayout)->Response->Custom_Delay->StatusCode; 		// Custom Delay
 			$accountDetails['embedded_pro_custom_quality'] 		= (string)$xml->children($xmlLayout)->Response->Custom_Quality->StatusCode; 	// Custom Quality
 			$accountDetails['embedded_pro_custom_messages'] 	= (string)$xml->children($xmlLayout)->Response->Custom_Messages->StatusCode; 	// Custom Quality
 			$accountDetails['embedded_pro_custom_resolution'] 	= (string)$xml->children($xmlLayout)->Response->Custom_Resolution->StatusCode; 	// Custom Resolution
		} 
		
		// Use XML parsing
		else 
		{
			$raw_Status 		= STWSettingsForm::xml_getLegacyResponse('Status', $rawXML);
			$raw_AccountLevel 	= STWSettingsForm::xml_getLegacyResponse('Account_Level', $rawXML);
			
			// Features
			$accountDetails['embedded_pro_inside'] 				= STWSettingsForm::xml_getLegacyResponse('Inside_Pages', $rawXML); 		// Inside Pages 
			$accountDetails['embedded_pro_full_length'] 		= STWSettingsForm::xml_getLegacyResponse('Full_Length', $rawXML); 		// Full Length
			$accountDetails['embedded_pro_custom_size'] 		= STWSettingsForm::xml_getLegacyResponse('Custom_Size', $rawXML); 		// Custom Size
 			$accountDetails['embedded_pro_refresh_on_demand'] 	= STWSettingsForm::xml_getLegacyResponse('Refresh_OnDemand', $rawXML); 	// Refresh On Demand
 			$accountDetails['embedded_pro_custom_delay'] 		= STWSettingsForm::xml_getLegacyResponse('Custom_Delay', $rawXML); 		// Custom Delay
 			$accountDetails['embedded_pro_custom_quality'] 		= STWSettingsForm::xml_getLegacyResponse('Custom_Quality', $rawXML); 	// Custom Quality
 			$accountDetails['embedded_pro_custom_messages'] 	= STWSettingsForm::xml_getLegacyResponse('Custom_Messages', $rawXML); 	// Custom Quality
 			$accountDetails['embedded_pro_custom_resolution'] 	= STWSettingsForm::xml_getLegacyResponse('Custom_Resolution', $rawXML); // Custom Resolution
		}
		
		
		// ### Convert all details into an actual validated array
		
		// Success or fail, plus account type.
		if ($raw_Status == 'Success')
		{
			// Convert account number to a string.
			switch ($raw_AccountLevel) 
			{ 
				case 1: $accountDetails['account_type'] = 'basic'; break;
				case 2: $accountDetails['account_type'] = 'plus'; break;

				default:
					$accountDetails['account_type'] = 'free';
					break;
			}
		} 
		// Just invalid
		else {
			$accountDetails['account_type'] = 'invalid';
		}
		
		
		// All done and standardised.
		return $accountDetails;
	}
	
	
	/**
	 * Function that extracts the value from an XML file using a regular expression rather than SimpleXML.
	 * 
	 * @param String $sSearch The string to search for.
	 * @param String $s The source string to search.
	 * 
	 * @return String The value from the XML file that matches the search string.
	 */
	static protected function xml_getLegacyResponse($sSearch, $s)
	{
	    $sRegex = '/<[^:]*:' . $sSearch . '[^>]*>[^<]*<[^:]*:StatusCode[^>]*>([^<]*)<\//';
	    if (preg_match($sRegex, $s, $sMatches)) {
	    	return $sMatches[1];
	    }
        return false;
    }
	
	
	/**
	 * Remove an element on the settings form, and replace it with a message because the user is not allowed
	 * to use that feature.
	 * 
	 * @param String $fieldName The name of the field that we're modifying.
	 * @param Array $fieldDetails The details of that field that contains the messages to use for showing the feature is disabled.
	 * 
	 */
	protected function removeElementDueToAccountLevel($fieldName, $fieldDetails)
	{
		if (isset($fieldDetails['account_denied_msg']) && $fieldDetails['account_denied_msg'])
		{
			$this->formObj->setElementCustomHTML($fieldName, $fieldDetails['account_denied_msg']);
			$this->formObj->setElementDescription($fieldName, false);
		} 
		
		// No custom message.
		else {
			$this->formObj->setElementCustomHTML($fieldName, 'Access Denied');
			$this->formObj->setElementDescription($fieldName, false);
		}
	}
		
}


?>
