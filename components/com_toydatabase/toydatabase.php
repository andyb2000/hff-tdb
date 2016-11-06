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
$user = JFactory::getUser();

echo "Database prefix is : " . $db->getPrefix()."<BR>";
echo "<BR>";
echo 'Joomla current URI is ' . JURI::current() . "\n";
echo "<BR>";
echo "Act input is: ".$act."<BR>\n";
echo "DDID input is: ".$ddid."<BR>\n";
echo "<p>Your name is {$user->name}, your email is {$user->email}, and your username is {$user->username}</p><BR>";
print_r($user->groups);
echo "<BR>";
echo "User block: ".$user->block."<BR>\n";
echo "Guest status: ".$user->guest."<BR>\n";

// Groups for toydatabase are in db t94us_toydatabase_permissions so retrieve if this user is in the right group
$query_toypermissions = $db->getQuery(true);
$query_toypermissions
->select('*')
->from($db->quoteName('#__toydatabase_permissions'))
->where($db->quoteName('function') . ' = "member"');
$db->setQuery((string) $query_toypermissions);
$db->execute();
$toydatabase_permissions_num_rows = $db->getNumRows();
$toydatabase_permissions = $db->loadAssoc();

if ($toydatabase_permissions_num_rows <1) {
	echo "<BR><h2>WARNING: Installation not complete, administrator please set permissions</h2><BR><BR>";
} else {
	echo "DB permissions group: ".$toydatabase_permissions["groupname"]."<BR>";;
};

if (in_array($user->groups,$toydatabase_permissions["groupname"])) {
	echo "Welcome back toydatabase membership user<BR>";
} else {
	echo "Why not join our toydatabase membership system?<BR>\n";
};
?>
<BR>
<style style="text/css">
  	.hoverTable{
		width:100%; 
		border-collapse:collapse; 
	}
	.hoverTable td{ 
		padding:7px; border:#4e95f4 1px solid;
	}
	/* Define the default color for all the table rows */
	.hoverTable tr{
		background: #b8d1f3;
	}
	/* Define the hover highlight color for the table row */
    .hoverTable tr:hover {
          background-color: #ffff99;
          cursor: pointer;
    }
</style>
<?php

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
		
		// Now retrieve the category (ies)
		$query_category = $db->getQuery(true);
		$query_category
		->select(array('a.*','b.category'))
		->from($db->quoteName('#__toydatabase_categorylink','a'))
		->join('INNER', $db->quoteName('#__toydatabase_equipment_category', 'b') . ' ON (' . $db->quoteName('a.categoryid') . ' = ' . $db->quoteName('b.id') . ')')
		->where($db->quoteName('a.equipmentid') . ' = '. $ddid);
		$db->setQuery((string) $query_category);
		$db->execute();
		$category_rows = $db->loadAssocList();
		
		// And retrieve the loan state _toydatabase_loanlink
		// If its on loan it will return a row and its status will be 1
		// when returned the status should be set to 0 or something other than 1 basically
		$query_loanlink = $db->getQuery(true);
		$query_loanlink
		->select('*')
		->from($db->quoteName('#__toydatabase_loanlink'))
		->where($db->quoteName('equipmentid') . ' = '. $ddid);
		$db->setQuery((string) $query_loanlink);
		$db->execute();
		$loanlink_rows = $db->loadAssoc();
		
?>
<table width=95% border=1 cellpadding=0 cellspacing=0 class="hoverTable">
<tr>
	<td><B>Toy Name :</B></td>
	<td><?=$row["name"]?></td>
</tr>
<tr>
	<td><B>Toy Image :</B></td>
	<td><?=$row["picture"]?></td>
</tr>
<tr>
	<td><B>Toy Description :</B></td>
	<td><?=$row["description"]?></td>
</tr>
<tr>
	<td><B>Toy Location :</B></td>
	<td><?=$row["storagelocation"]?></td>
</tr>
<tr>
	<td><B>Toy Status :</B></td>
	<td><?=$row["status"]?></td>
</tr>
<tr>
	<td><B>Toy Category :</B></td>
	<td><?php 
		foreach ($category_rows as $cat_display) {
			echo $cat_display["category"]."<BR>\n";
		};
	?>
	</td>
</tr>
<tr>
	<td><B>Toy Loan state :</B></td>
	<td><?php
		switch($loanlink_rows["status"]) {
			case "3":
				echo "DAMAGED/NO LONGER AVAILABLE";
				break;
			case "2":
				echo "AWAITING CLEANING/REPAIR";
				break;
			case "1":
				echo "ON LOAN";
				break;
			default:
				echo "AVAILABLE";
				break;
		};
	?></td>
</tr>
<tr>
	<td><B>Toy Due Return Date :</B></td>
	<td><?php
		if (!$loanlink_rows["returnbydate"] || $loanlink_rows["returnbydate"] == "0000-00-00 00:00:00") {
			// No return date!
			echo "Unknown";
		} else {
			$mysql_date=JFactory::getDate($loanlink_rows["returnbydate"]);
			echo JHtml::_('date', $loanlink_rows["returnbydate"], 'G:i j/M/Y');
		};
	?></td>
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

<table width=85% border=1 cellpadding=0 cellspacing=0 class="hoverTable">
<tr><td width=40%><B>Toy name</B></td>
<td width=40%><B>Toy Photo (small)</B></td>
<td width=20%><B>Status</B></td></tr>
<?php 
if ($num_rows >0) {
	print_r($row);
	foreach ($row as $row_key=>$row_value) {
		echo "<tr onclick='self.location=\"".JURI::current()."?act=1&ddid=$row_key\"'>";
		echo "<td>".$row_value["name"]."</td>\n";
		echo "<td>";
		// check the file exists to display the image
		if (file_exists("library_images/".$row_value["picture"])) {
			// dynamically resize image using php
			echo "<img src='toydatabase_thumbnailer.php?img=".$row_value["picture"]."' alt='".$row_value["picture"]."'>";
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
<BR>
<center>
<a href="<?=JURI::current()?>">Return to Toy listing</a>
</center>