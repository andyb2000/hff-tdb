<?php
/**
 * @package     toy_database
 * @subpackage  toy_database
 *
 * @copyright   Copyright (C) 2016 Andy Brown
 */
$debug=0;

// call this to trigger a PDF print/page display
// idea is this will be in a separate popup/browser window that user can then print
// or choose print to file/PDF it themselves

// This script needs to be able to take whatever query and display it formatted
// it will also be called without joomla components so init joomla first


define( '_JEXEC', 1 );
define('JPATH_BASE', dirname(__FILE__)."/../../.." );//this is when we are in the root,means path to Joomla installation
define( 'DS', DIRECTORY_SEPARATOR );

require_once ( JPATH_BASE .DS.'includes'.DS.'defines.php' );
require_once ( JPATH_BASE .DS.'includes'.DS.'framework.php' );

$app = JFactory::getApplication('site');
$app->initialise();
$db = JFactory::getDBO();// Joomla database object
$jinput = JFactory::getApplication()->input;

$db_table = $jinput->get('db_table', '', 'RAW'); // db_table is what we are querying (limit to valid options)
$db_where = $jinput->get('db_where', '', 'RAW'); // db_where is the entire where query
$displ_tc = $jinput->get('displ_tc', '', 'RAW'); // displ_tc is the table headers in csv format (Member name, Expiry, etc)

$query = $db->getQuery(true);

$query
	->select(array('*'))
	->from($db->quoteName($db_table));
//	->where($db_where);
	$db->setQuery((string) $query);
	$db->execute();
	$toydatabase_num_rows = $db->getNumRows();

	if ($toydatabase_num_rows > 0) {
		$toydatabase_return = $db->loadAssocList();
		foreach ($toydatabase_return as $toy_value) {
			print_r($toy_value);
		};
	} else {
		echo "No rows returned<BR>\n";
	}

?>