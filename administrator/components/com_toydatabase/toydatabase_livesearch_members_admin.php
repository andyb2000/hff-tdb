<?php

// Admin edition

define( '_JEXEC', 1 );
define('JPATH_BASE', dirname(__FILE__)."/../../.." );//this is when we are in the root,means path to Joomla installation
define( 'DS', DIRECTORY_SEPARATOR );

// shush errors
error_reporting(E_ERROR);

require_once ( JPATH_BASE .DS.'includes'.DS.'defines.php' );
require_once ( JPATH_BASE .DS.'includes'.DS.'framework.php' );

$app = JFactory::getApplication('site');
$app->initialise();
$db = JFactory::getDBO();// Joomla database object

$q = urldecode($_REQUEST["q"]);
$pname = $_REQUEST["pname"];
$query_membername = $db->getQuery(true);
$hint="";

if (strlen($q)>2) {
	$hint = "";
	$query_membername
	->select(array('id','name'))
	->from($db->quoteName('#__toydatabase_membership'))
	->where($db->quoteName('name') . ' like "%'.$q.'%"');
	$db->setQuery((string) $query_membername);
	$db->execute();
	$toydatabase_toymember_num_rows = $db->getNumRows();	
	if ($toydatabase_toymember_num_rows > 0) {
		$toydatabase_toymember_return = $db->loadAssocList();
		foreach ($toydatabase_toymember_return as $toy_value) {
			if ($hint) {
				$hint=$hint."<BR/>";
			};
			if (strpos($pname, 'administrator/components') === false) {
				$hint=$hint."<a href='".$pname."?option=com_toydatabase&page=members&tab=member&act=1&member_act=1&ddid=".$toy_value["id"]."'>".$toy_value["name"]."</a>";
			} else {
				$hint=$hint."<a href='#' onclick='Javascript:window.parent.document.getElementById(\"in_membershipid\").value=\"".$toy_value["id"]."\";window.parent.SqueezeBox.close();'>".$toy_value["name"]."</a>";
			};
		};
	};
}

if ($hint == "") {
	$response = "No matches found";
}else {
	$response = $hint;
}
echo $response;
?>
