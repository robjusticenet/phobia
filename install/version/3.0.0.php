<?php
// This file is for performing an upgrade from Kliqqi 2.0.2 to 3.0.0

// Report all PHP errors
// error_reporting(E_ALL);

// Check for the current version within each upgrade file
$sql = "SELECT data FROM " . table_misc_data . " WHERE name = 'kliqqi_version'";
$kliqqi_version = $db->get_var($sql);

// Check if you need to run the one time upgrade to Kliqqi 2.0.1
if (version_compare($kliqqi_version, '2.0.2') <= 0) {

	echo '<li>Performing one-time Kliqqi 3.0.0 Upgrade<ul>';
	
	$sql = "UPDATE ".table_config." 
			SET `var_title` = 'Negative Votes Story Discard' 
			WHERE `var_name` = 'buries_to_spam';";
    $db->query($sql);	
	$sql = "UPDATE `" . table_config . "` 
			SET `var_desc` = 'If set to 1, stories with enough down votes will be discarded. The formula for determining what gets buried is stored in the database table table_formulas. It defaults to discarding stories with 3 times more downvotes than upvotes.'
			WHERE `var_name` = 'buries_to_spam';";
	$db->query($sql);
	$sql = "UPDATE ".table_config." 
			SET `var_optiontext` = '1 = on / 0 = off' 
			WHERE `var_name` = 'buries_to_spam';";
    $db->query($sql);	
	echo '<li>Updated the title and description for the "Negative Votes Story Discard" feature</li>';	
	
	// Update version number
	$sql = "UPDATE `" . table_misc_data . "` SET `data` = '3.0.0' WHERE `name` = 'kliqqi_version';";
	$db->query($sql);
	echo '<li>Updated version number to 3.0.0</li>';
	
	// Update version number
	$sql = "UPDATE `" . table_config . "` SET `var_desc` ='Require users to validate their email address?<br />If you set to true, then click on the link below to also set the email to be used for sending the message.<br /><a href=\"../module.php?module=admin_language\">Set the email</a>. Type @ in the filter box and click Filter to get the value to modify. Do not forget to click save.' where `var_name` = 'misc_validate';";
	$db->query($sql);
	echo '<li>Updated version number to 3.0.0</li>';
	// Finished 3.0.0 upgrade
	echo'</ul></li>';
}

	
?>