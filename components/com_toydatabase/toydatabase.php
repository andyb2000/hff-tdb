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
//$controller = JControllerLegacy::getInstance('ToyDatabase');
 
// Perform the Request task
//$input = JFactory::getApplication()->input;
//$controller->execute($input->getCmd('task'));
 
// Redirect if set by the controller
//$controller->redirect();

$jinput = JFactory::getApplication()->input;
$act = $jinput->get('act', '', 'INT'); // action is just an integer 1 2 or 3
$ddid = $jinput->get('ddid', '', 'INT'); // ddid is the ID of a record to display  (others ALNUM WORD)

$db    = JFactory::getDBO();
$query = $db->getQuery(true);
//$query
//->select(array('a.*', 'b.category'))
//->from($db->quoteName('#__toydatabase_equipment', 'a'))
//->join('INNER', $db->quoteName('#__toydatabase_equipment_category', 'b') . ' ON (' . $db->quoteName('a.categoryid') . ' = ' . $db->quoteName('b.id') . ')')
//->where($db->quoteName('status') . ' = '. $db->quote('1'))
//->order($db->quoteNAme('a.name') . ' DESC');


echo "Database prefix is : " . $db->getPrefix()."<BR>";
echo "<BR>";
echo 'Joomla current URI is ' . JURI::current() . "\n";
echo "<BR>";
echo "Act input is: ".$act."<BR>\n";
echo "DDID input is: ".$ddid."<BR>\n";

switch ($act) {
	case "1":
		// retrieve the specific record
		$query
		->select('*')
		->from($db->quoteName('#__toydatabase_equipment'))
		->where($db->quoteName('id') . ' = '. $ddid);
		$db->setQuery((string) $query);
		$db->execute();
		$row = $db->loadAssoc();
?>
<table width=95% border=1 cellpadding=0 cellspacing=0>
<tr>
	<td><B>Toy Name :</B></td>
	<td><?=$row["name"]?></td>
</tr>
<tr>
	<td><B>Toy Image :</B></td>
	<td>xx</td>
</tr>
<tr>
	<td><B>Toy Description :</B></td>
	<td>xx</td>
</tr>
<tr>
	<td><B>Toy Location :</B></td>
	<td>xx</td>
</tr>
<tr>
	<td><B>Toy Status :</B></td>
	<td>xx</td>
</tr>
<tr>
	<td><B>Toy Category :</B></td>
	<td>xx</td>
</tr>
<tr>
	<td><B>Toy Loan state :</B></td>
	<td>xx</td>
</tr>
<tr>
	<td><B>Toy Return Date :</B></td>
	<td>xx</td>
</tr>
</table>
<?php
		break;
	default:
		// This displays the toy list
		$query
		->select('*')
		->from($db->quoteName('#__toydatabase_equipment'))
		//->join('INNER', $db->quoteName('#__toydatabase_equipment_category', 'b') . ' ON (' . $db->quoteName('a.categoryid') . ' = ' . $db->quoteName('b.id') . ')')
		//->where($db->quoteName('status') . ' = '. $db->quote('1'))
		->order($db->quoteName('name') . ' DESC');
		
		$db->setQuery((string) $query);
		$db->execute();
		$num_rows = $db->getNumRows();
		$row = $db->loadAssocList('id');
?>
<table width=85% border=1 cellpadding=0 cellspacing=0>
<tr><td><B>Toy name</B></td>
<td><B>Toy Photo (small)</B></td>
<td><B>Status</B></td></tr>
<?php 
if ($num_rows >0) {
	print_r($row);
	foreach ($row as $row_key=>$row_value) {
		echo "<tr onclick='self.location=\"".JURI::current()."?act=1&ddid=$row_key\"'>";
		echo "<td>".$row_value["name"]."</td>\n";
		echo "<td>".$row_value["picture"];
		// check the file exists to display the image
		if (file_exists("library_images/".$row_value["picture"])) {
			echo "<img src='' alt=''>";
		} else {
			echo "Sorry no image exists";
		};
		echo "</td>\n";
		echo "<td>".$row_value["status"]."</td>\n";
		echo "</tr>";
	};
} else {
	// no rows or toys in database found
	echo "<tr><td colspan=3 align=center><B>Sorry - No items found</B></td></tr>\n";
};
?>
</table>
<?php 
	// end of default: switch
	break;
}; // enc of switch selecting act
?>