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
$query->select('id,greeting');
$query->from('#__toydatabase');
$db->setQuery((string) $query);
$messages = $db->loadObjectList();
$options  = array();
?>
TESTING, try db here<BR>
