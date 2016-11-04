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

$db    = JFactory::getDBO();
$query = $db->getQuery(true);
//$query
//->select(array('a.*', 'b.category'))
//->from($db->quoteName('#__toydatabase_equipment', 'a'))
//->join('INNER', $db->quoteName('#__toydatabase_equipment_category', 'b') . ' ON (' . $db->quoteName('a.categoryid') . ' = ' . $db->quoteName('b.id') . ')')
//->where($db->quoteName('status') . ' = '. $db->quote('1'))
//->order($db->quoteNAme('a.name') . ' DESC');
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

echo "Database prefix is : " . $db->getPrefix()."<BR>";
echo "<BR>";
echo 'Joomla current URI is ' . JURI::current() . "\n";
echo "<BR>";

?>
<table width=85% border=1 cellpadding=0 cellspacing=0>
<tr><td><B>Toy name</B></td>
<td><B>Toy Photo (small)</B></td>
<td><B>Status</B></td></tr>
<?php 
if ($num_rows >0) {
	print_r($row);
	foreach ($row as $row_key=>$row_value) {
		echo "<tr onclick='self.location=\"".JURI::current()."?rowid=$row_key\"'>";
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