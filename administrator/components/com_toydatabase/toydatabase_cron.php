<?php
/**
 * @package     toy_database
 * @subpackage  toy_database
 *
 * @copyright   Copyright (C) 2016/7 Andy Brown
 */
$debug=0;

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
$db->execute();
$toydatabase_permissions = $db->loadAssoc();

print_r($toydatabase_permissions);
?>