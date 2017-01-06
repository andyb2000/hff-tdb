<?php
/**
 * @package     toy_database
 * @subpackage  toy_database
 *
 * @copyright   Copyright (C) 2016/7 Andy Brown
 */
$debug=1;

// Cron scheduler for the toydatabase system

// revision 05/01/17 - to handle daily events call this script. Script needs to detect if its been
// ran and only do tasks once (db flag?)

define( '_JEXEC', 1 );
define('JPATH_BASE', dirname(__FILE__)."/../../.." );//this is when we are in the root,means path to Joomla installation
define( 'DS', DIRECTORY_SEPARATOR );

require_once ( JPATH_BASE .DS.'includes'.DS.'defines.php' );
require_once ( JPATH_BASE .DS.'includes'.DS.'framework.php' );

$app = JFactory::getApplication('site');
$app->initialise();
$db = JFactory::getDBO();// Joomla database object
$jinput = JFactory::getApplication()->input;
$config = JFactory::getConfig();

// Retrieve the toydatabase_permissions table values for config elements.
$query_toypermissions = $db->getQuery(true);
$query_toypermissions
->select('*')
->from($db->quoteName('#__toydatabase_permissions'));
$db->setQuery((string) $query_toypermissions);
// $db->execute();
$toydatabase_permissions = $db->loadAssocList('function');

if ($debug) {
	echo "toydatabase_cron.php<BR>\n";
	echo "<PRE>\n";
	print_r($toydatabase_permissions);
	echo "</PRE>\n";
	echo "So cron last run would be: ".$toydatabase_permissions["cron"]["permissions"]."<BR>\n";
	echo "<BR>\n";
};

$cron_run_now=0;
// check when cron last ran
if (!$toydatabase_permissions["cron"]["permissions"]) {
	// no cron entry table
	echo "NO CRON<BR>\n";
	$ins_request = $db->getQuery(true);
	$ins_columns = array('function','permissions');
	$ins_values = array($db->quote("cron"), "NOW()");
	$ins_request
	->insert($db->quoteName('#__toydatabase_permissions'))
	->columns($db->quoteName($ins_columns))
	->values(implode(',', $ins_values));
	try {
		$db->setQuery($ins_request);
		$db->execute();
	}
	catch (RuntimeException $e) {
		echo "FAILED to update database: ".$e->getMessage()."<BR>\n";
		return false;
	};
	$cron_run_now=1;
};

if ($cron_run_now == 1) {
	// update cron entry to now
	if ($debug) {echo "Updating cron NOW<BR>\n";};
	
	$upd_request = $db->getQuery(true);
	$upd_fields = array(
			$db->quoteName('permissions') . ' = NOW()'
	);
	$upd_request->update($db->quoteName('#__toydatabase_permissions'))->set($upd_fields)->where($db->quoteName('function') . ' = "cron"');
	try {
		$db->setQuery($upd_request);
		$db->execute();
	}
	catch (RuntimeException $e) {
		echo "FAILED to upd database: ".$e->getMessage();
		return false;
	};
};
?>