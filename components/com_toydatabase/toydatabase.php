<?php
/**
 * @package     toy_database
 * @subpackage  toy_database
 *
 * @copyright   Copyright (C) 2016 Andy Brown
 */
 
// No direct access to this file
defined('_JEXEC') or die('Restricted access');
 
// Get an instance of the controller prefixed by HelloWorld
$controller = JControllerLegacy::getInstance('ToyDatabase');
 
// Perform the Request task
$input = JFactory::getApplication()->input;
$controller->execute($input->getCmd('task'));
 
// Redirect if set by the controller
$controller->redirect();

$db    = JFactory::getDBO();
$query = $db->getQuery(true);
$query
->select(array('a.*', 'b.category'))
->from($db->quoteName('#__toydatabase_equipment', 'a'))
->join('INNER', $db->quoteName('#__toydatabase_equipment_category', 'b') . ' ON (' . $db->quoteName('a.categoryid') . ' = ' . $db->quoteName('b.id') . ')')
->where($db->quoteName('status') . ' = '. $db->quote('1'))
->order($db->quoteNAme('a.name') . ' DESC');


$db->setQuery((string) $query);
$db->execute();
$num_rows = $db->getNumRows();
print_r($num_rows);
$row = $db->loadAssocList('id');
print_r($row);

echo "Database prefix is : " . $db->getPrefix();
?>
TESTING, try db here<BR>
