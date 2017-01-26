<?php
/**
 * @package     toy_database
 * @subpackage  toy_database
 *
 * @copyright   Copyright (C) 2016/7 Andy Brown
 */
$debug=0;

// call this to trigger a PDF print/page display
// idea is this will be in a separate popup/browser window that user can then print
// or choose print to file/PDF it themselves

// This script needs to be able to take whatever query and display it formatted
// it will also be called without joomla components so init joomla first

// revision 05/01/17 - this wont really work. So go to plan B and take in the type to display, all
// sql and display code will be in this file (duplicate really of the display options in the individual
// admin files)

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

$disp = $jinput->get('disp', '', 'RAW'); // disp is the display type (categories,members,toys,requests)

$in_report_expiring_days = $jinput->get('report_expiring_days', '', 'RAW');
if ($in_report_expiring_days) {$report_expiring_days=$in_report_expiring_days;} else {$report_expiring_days="30";};
$in_report_past_members = $jinput->get('report_past_members', '', 'RAW'); // specific for members expiring report

// push out the headers, display, etc
?>
<HTML>
<HEAD>
<TITLE>Toy library database - printout view</TITLE>
<style>
    /**
    * Eric Meyer's Reset CSS v2.0 (http://meyerweb.com/eric/tools/css/reset/)
    * http://www.cssportal.com
    */

    /* HTML5 display-role reset for older browsers */
    article, aside, details, figcaption, figure,
    footer, header, hgroup, menu, nav, section {
    display: block;
    }
    body {
    line-height: 1;
    }
    ol, ul {
    list-style: none;
    }
    blockquote, q {
    quotes: none;
    }
    blockquote:before, blockquote:after,
    q:before, q:after {
    content: '';
    content: none;
    }
    table {
    border-collapse: collapse;
    border-spacing: 0;
    }
    

p {
    padding: 10px;
}

#wrapper {
    margin: 0 auto;
    width: 1000px;
}

#headerwrap {
    width: 1000px;
    float: left;
    margin: 0 auto;
}

#header {
    height: 100px;
    background: #B0DAFF;
    border-radius: 10px;
    border: 1px solid #9cc6eb;
    margin: 5px;
}

#contentwrap {
    width: 1000;
    float: left;
    margin: 0 auto;
}

#content {
    background: #FFFFFF;
    border-radius: 10px;
    border: 1px solid #ebebeb;
    margin: 5px;
}

#footerwrap {
    width: 1000px;
    float: left;
    margin: 0 auto;
    clear: both;
}

#footer {
    height: 40px;
    background: #B0DAFF;
    border-radius: 10px;
    border: 1px solid #9cc6eb;
    margin: 5px;
    font-size: 40%;
}
    
</style>
</HEAD>
<BODY>
<div id="wrapper">
<div id="headerwrap">
        <div id="header">
            <center><p>Toy library Database for <?=$config->get('sitename')?></p></center>
            <center><p>Output generated: <?php echo date("d/m/Y"); ?></p></center>
<?php 

switch($disp) {
	case "onhire":
		$report_query = $db->getQuery(true);
		$report_query
		->select(array('a.*', 'b.*', 'c.name as membername', 'c.urn as memberurn'))
		->from($db->quoteName('#__toydatabase_loanlink', 'a'))
		->join('INNER', $db->quoteName('#__toydatabase_equipment', 'b') . ' ON (' . $db->quoteName('a.equipmentid') . ' = ' . $db->quoteName('b.id') . ')')
		->join('INNER', $db->quoteName('#__toydatabase_membership', 'c') . ' ON (' . $db->quoteName('a.membershipid') . ' = ' . $db->quoteName('c.id') . ')')
		->where($db->quoteName('a.status') . ' = "1"', 'AND')
		->where($db->quoteName('a.returndate') . ' = "0000-00-00 00:00:00"')
		->order($db->quoteName('a.returnbydate') . ' ASC');

		$db->setQuery($report_query);
		$row = $db->loadAssocList('id');
		echo "<p><b>Toy On Hire items display</b></p>";
		echo "</div></div>";
		echo "<div id='contentwrap'><div id='content' align='center'>";
?>
		<table width=85% border=1 cellpadding=0 cellspacing=0>
						<tr><td width=5%><B>Equipment URN</B></td>
						<td width=30%><B>Equipment Name</B></td>
						<td width=5%><B>Member URN</B></td>
						<td width=20%><B>Member Name</B></td>
						<td width=20%><B>Loaned on</B></td>
						<td width=20%><B>Return by date</B></td>
						</tr>
						<?php
						if (!empty($row)) {
							// print_r($row);
							foreach ($row as $row_key=>$row_value) {
								$entry_loandate=JFactory::getDate($row_value["loandate"]);
								$entry_loandate_out=JHtml::_('date', $entry_loandate, 'd/m/Y');
								$entry_returnbydate=JFactory::getDate($row_value["returnbydate"]);
								$entry_returnbydate_out=JHtml::_('date', $entry_returnbydate, 'd/m/Y');
								
								echo "<tr>";
								echo "<td>".$row_value["urn"]."</td>";
								echo "<td>".$row_value["name"]."</td>";
								echo "<td>".$row_value["memberurn"]."</td>";
								echo "<td>".$row_value["membername"]."</td>";
								echo "<td>".$entry_loandate_out."</td>";
								echo "<td>".$entry_returnbydate_out."</td>";
								echo "</tr>\n";
								};
						} else {
									// no rows or toys in database found
									echo "<tr><td colspan=6 align=center><B>Sorry - No entries found</B></td></tr>\n";
						};
							?>
							</table>
<?php
		break;
	case "active_members":
		echo "<p><b>Toy Active Membership display</b></p>";
		echo "</div></div>";
		echo "<div id='contentwrap'><div id='content' align='center'>";
		
		$query = $db->getQuery(true);
		$query
		->select('*')
		->from($db->quoteName('#__toydatabase_membership'))
		->where($db->quoteName('active') . ' = "1"')
		->order($db->quoteName('name') . ' DESC');
		
		$db->setQuery($query);
		$row = $db->loadAssocList('id');
		?>
										<table width=85% border=1 cellpadding=0 cellspacing=0>
										<tr><td width=5%><B>Member joomla ID</B></td>
										<td width=10%><B>Member URN</B></td>
										<td width=20%><B>Member Name</B></td>
										<td width=20%><B>Company</B></td>
										<td width=10%><B>Postcode</B></td>
										<td width=10%><B>Member Category</B></td>
										<td width=10%><B>Join Date</B></td>
										<td width=10%><B>Renewal Date</B></td>
										<td width=5%><B>Status</B></td>
										</tr>
										<?php
										if (!empty($row)) {
											// print_r($row);
											foreach ($row as $row_key=>$row_value) {
												// convert memb_category
												// link to joomlaid
												// joindate to human date
												// renewaldate to human date
												
												$check_member_query = $db->getQuery(true);
												$check_member_query
												->select('*')
												->from($db->quoteName('#__toydatabase_membershiplink'))
												->where($db->quoteName('membershipid') . ' = '. $row_value["id"]);
												$db->setQuery((string) $check_member_query);
												$db->execute();
												$membership_row = $db->loadAssoc();
												
												// get member category
												$get_memb_cat = $db->getQuery(true);
												$get_memb_cat
												->select('*')
												->from($db->quoteName('#__toydatabase_membershiptypes'))
												->where($db->quoteName('id') . ' = '. $row_value["memb_category"]);
												$db->setQuery((string) $get_memb_cat);
												$db->execute();
												$memb_cat_data = $db->loadAssoc();
												
												if ($row_value["joindate"] != "0000-00-00 00:00:00") {
													$entry_joindate=JFactory::getDate($row_value["joindate"]);
													$entry_joindate_out=JHtml::_('date', $entry_joindate, 'd/m/Y');
												} else {
													$entry_joindate_out="N/A";
												};
												
												if ($row_value["renewaldate"] != "0000-00-00 00:00:00") {
													$entry_renewaldate=JFactory::getDate($row_value["renewaldate"]);
													$entry_renewaldate_out=JHtml::_('date', $entry_renewaldate, 'd/m/Y');
												} else {
													$entry_renewaldate_out="N/A";
												};
												if ($row_value["active"] == "1") {$entry_active="Active";};
												if ($row_value["active"] == "0") {$entry_active="Pending";};
												if ($row_value["active"] == "10") {$entry_active="Suspended";};
												if ($row_value["active"] == "99") {$entry_active="Deleted";};
												
												echo "<tr>";
												echo "<td>".$row_value["joomla_userid"]."</td>";
												echo "<td>".$row_value["urn"]."</td>";
												echo "<td>".$row_value["name"]."</td>";
												echo "<td>".$row_value["companyname"]."</td>";
												echo "<td>".$row_value["postcode"]."</td>";
												echo "<td>".$memb_cat_data["type"]."</td>";
												echo "<td>".$entry_joindate_out."</td>";
												echo "<td>".$entry_renewaldate_out."</td>";
												echo "<td>".$entry_active."</td>";
												echo "</tr>\n";
											};
										} else {
											// no rows or toys in database found
											echo "<tr><td colspan=8 align=center><B>Sorry - No members found</B></td></tr>\n";
										};
				?>
												</table>
		<?php
		break;
		case "expiring_members":
			echo "<p><b>Toy Expiring ";
			if ($in_report_past_members) {echo "(and expired) ";};
			echo "Membership display</b></p>";
			echo "</div></div>";
			echo "<div id='contentwrap'><div id='content' align='center'>";
		
			$query = $db->getQuery(true);
			$query
			->select('*')
			->from($db->quoteName('#__toydatabase_membership'))
			->where($db->quoteName('active') . ' = "1"', 'AND');
			if($in_report_past_members) {
				$query->where("(".$db->quoteName('renewaldate') . "> NOW() + INTERVAL $report_expiring_days DAY OR renewaldate < NOW())");
			} else {
				$query->where($db->quoteName('renewaldate') . "> NOW() + INTERVAL $report_expiring_days DAY");
			};
			$query->order($db->quoteName('name') . ' DESC');
		
			$db->setQuery($query);
			$row = $db->loadAssocList('id');
			?>
												<table width=85% border=1 cellpadding=0 cellspacing=0>
												<tr><td width=5%><B>Member joomla ID</B></td>
												<td width=10%><B>Member URN</B></td>
												<td width=20%><B>Member Name</B></td>
												<td width=20%><B>Company</B></td>
												<td width=10%><B>Postcode</B></td>
												<td width=10%><B>Member Category</B></td>
												<td width=10%><B>Join Date</B></td>
												<td width=10%><B>Renewal Date</B></td>
												<td width=5%><B>Status</B></td>
												</tr>
												<?php
												if (!empty($row)) {
													// print_r($row);
													foreach ($row as $row_key=>$row_value) {
														// convert memb_category
														// link to joomlaid
														// joindate to human date
														// renewaldate to human date
														
														$check_member_query = $db->getQuery(true);
														$check_member_query
														->select('*')
														->from($db->quoteName('#__toydatabase_membershiplink'))
														->where($db->quoteName('membershipid') . ' = '. $row_value["id"]);
														$db->setQuery((string) $check_member_query);
														$db->execute();
														$membership_row = $db->loadAssoc();
														
														// get member category
														$get_memb_cat = $db->getQuery(true);
														$get_memb_cat
														->select('*')
														->from($db->quoteName('#__toydatabase_membershiptypes'))
														->where($db->quoteName('id') . ' = '. $row_value["memb_category"]);
														$db->setQuery((string) $get_memb_cat);
														$db->execute();
														$memb_cat_data = $db->loadAssoc();
														
														if ($row_value["joindate"] != "0000-00-00 00:00:00") {
															$entry_joindate=JFactory::getDate($row_value["joindate"]);
															$entry_joindate_out=JHtml::_('date', $entry_joindate, 'd/m/Y');
														} else {
															$entry_joindate_out="N/A";
														};
														
														if ($row_value["renewaldate"] != "0000-00-00 00:00:00") {
															$entry_renewaldate=JFactory::getDate($row_value["renewaldate"]);
															$entry_renewaldate_out=JHtml::_('date', $entry_renewaldate, 'd/m/Y');
														} else {
															$entry_renewaldate_out="N/A";
														};
														if ($row_value["active"] == "1") {$entry_active="Active";};
														if ($row_value["active"] == "0") {$entry_active="Pending";};
														if ($row_value["active"] == "10") {$entry_active="Suspended";};
														if ($row_value["active"] == "99") {$entry_active="Deleted";};
														
														echo "<tr>";
														echo "<td>".$row_value["joomla_userid"]."</td>";
														echo "<td>".$row_value["urn"]."</td>";
														echo "<td>".$row_value["name"]."</td>";
														echo "<td>".$row_value["companyname"]."</td>";
														echo "<td>".$row_value["postcode"]."</td>";
														echo "<td>".$memb_cat_data["type"]."</td>";
														echo "<td>".$entry_joindate_out."</td>";
														echo "<td>".$entry_renewaldate_out."</td>";
														echo "<td>".$entry_active."</td>";
														echo "</tr>\n";
													};
												} else {
													// no rows or toys in database found
													echo "<tr><td colspan=8 align=center><B>Sorry - No members found</B></td></tr>\n";
												};
						?>
														</table>
				<?php
				break;
	case "categories":
		echo "<p><b>Toy Category display</b></p>";
		echo "</div></div>";
		echo "<div id='contentwrap'><div id='content' align='center'>";
		
		$query = $db->getQuery(true);
		$query
		->select('*')
		->from($db->quoteName('#__toydatabase_equipment_category'))
		->order($db->quoteName('category') . ' ASC');
		
		$db->setQuery($query);
		$row = $db->loadAssocList('id');
		?>
				
				<table width=85% border=1 cellpadding=0 cellspacing=0>
				<tr><th width=30%><B>Category name</B></th></tr>
				<?php
				if (!empty($row)) {
					// print_r($row);
					foreach ($row as $row_key=>$row_value) {
						echo "<tr>";
						echo "<td>".$row_value["category"]."</td></tr>\n";
					};
				} else {
					// no rows or toys in database found
					echo "<tr><td colspan=1 align=center><B>Sorry - No categories found</B></td></tr>\n";
				};
		?>
						</table>
<?php 
		break;
	case "members":
		echo "<p><b>Toy Membership display</b></p>";
		echo "</div></div>";
		echo "<div id='contentwrap'><div id='content' align='center'>";
		
		$query = $db->getQuery(true);
		$query
		->select('*')
		->from($db->quoteName('#__toydatabase_membership'))
		->order($db->quoteName('name') . ' DESC');
		
		$db->setQuery($query);
		$row = $db->loadAssocList('id');
		?>
								<table width=85% border=1 cellpadding=0 cellspacing=0>
								<tr><td width=5%><B>Member joomla ID</B></td>
								<td width=10%><B>Member URN</B></td>
								<td width=20%><B>Member Name</B></td>
								<td width=20%><B>Company</B></td>
								<td width=10%><B>Postcode</B></td>
								<td width=10%><B>Member Category</B></td>
								<td width=10%><B>Join Date</B></td>
								<td width=10%><B>Renewal Date</B></td>
								<td width=5%><B>Status</B></td>
								</tr>
								<?php
								if (!empty($row)) {
									// print_r($row);
									foreach ($row as $row_key=>$row_value) {
										// convert memb_category
										// link to joomlaid
										// joindate to human date
										// renewaldate to human date
										
										$check_member_query = $db->getQuery(true);
										$check_member_query
										->select('*')
										->from($db->quoteName('#__toydatabase_membershiplink'))
										->where($db->quoteName('membershipid') . ' = '. $row_value["id"]);
										$db->setQuery((string) $check_member_query);
										$db->execute();
										$membership_row = $db->loadAssoc();
										
										// get member category
										$get_memb_cat = $db->getQuery(true);
										$get_memb_cat
										->select('*')
										->from($db->quoteName('#__toydatabase_membershiptypes'))
										->where($db->quoteName('id') . ' = '. $row_value["memb_category"]);
										$db->setQuery((string) $get_memb_cat);
										$db->execute();
										$memb_cat_data = $db->loadAssoc();
										
										$entry_joindate=JFactory::getDate($row_value["joindate"]);
										$entry_joindate_out=JHtml::_('date', $entry_joindate, 'd/m/Y');
										
										if ($row_value["renewaldate"] != "0000-00-00 00:00:00") {
											$entry_renewaldate=JFactory::getDate($row_value["renewaldate"]);
											$entry_renewaldate_out=JHtml::_('date', $entry_renewaldate, 'd/m/Y');
										} else {
											$entry_renewaldate_out="N/A";
										};
										if ($row_value["active"] == "1") {$entry_active="Active";};
										if ($row_value["active"] == "0") {$entry_active="Pending";};
										if ($row_value["active"] == "10") {$entry_active="Suspended";};
										if ($row_value["active"] == "99") {$entry_active="Deleted";};
										
										echo "<tr>";
										echo "<td>".$row_value["joomla_userid"]."</td>";
										echo "<td>".$row_value["urn"]."</td>";
										echo "<td>".$row_value["name"]."</td>";
										echo "<td>".$row_value["companyname"]."</td>";
										echo "<td>".$row_value["postcode"]."</td>";
										echo "<td>".$memb_cat_data["type"]."</td>";
										echo "<td>".$entry_joindate_out."</td>";
										echo "<td>".$entry_renewaldate_out."</td>";
										echo "<td>".$entry_active."</td>";
										echo "</tr>\n";
									};
								} else {
									// no rows or toys in database found
									echo "<tr><td colspan=8 align=center><B>Sorry - No members found</B></td></tr>\n";
								};
		?>
										</table>
<?php
		break;
	case "toys":
		echo "<p><b>Toys catalogue display</b></p>";
		echo "</div></div>";
		echo "<div id='contentwrap'><div id='content' align='center'>";
		
		// new format 26-01-17
		// format is to sort by categories, display toys in category, blank page
		// then next category in a booklet styleeeeeee
		$cat_query = $db->getQuery(true);
		$cat_query
		->select('*')
		->from($db->quoteName('#__toydatabase_equipment_category'))
		->order($db->quoteName('category') . ' ASC');
		
		$db->setQuery($cat_query);
		$cat_row = $db->loadAssocList('id');
		
		if (!empty($cat_row)) {
			foreach ($cat_row as $cat_row_key=>$cat_row_value) {
				echo "<h2>".$cat_row_value["category"]."</h2><BR>";
		
		$query = $db->getQuery(true);
		$query
		->select('a.*', 'b.*')
		->from($db->quoteName('#__toydatabase_equipment', 'a'))
		->join('INNER', $db->quoteName('#__toydatabase_categorylink', 'b') . ' ON (' . $db->quoteName('a.id') . ' = ' . $db->quoteName('b.equipmentid') . ')')
		->where($db->quoteName('b.categoryid') . ' = '.$cat_row_value["id"])
		->order($db->quoteName('a.name') . ' ASC');
		
			echo "DEBUG:<PRE>\n";
			echo $db->replacePrefix((string) $query);
			echo "</PRE><BR>\n";
		
//		$db->setQuery($query);
//		$row = $db->loadAssocList('a.id');
		?>
		<table width=96% border=1 cellpadding=0 cellspacing=0>
		<tr valign=top aligh=left><td valign=top>photo</td><td valign=top>
			<table width=100% border=0 cellpadding=0 cellspacing=0>
				<tr valign=top><td width=100>Title</td></tr>
				<tr valign=top><td width=100>URN</td></tr>
				<tr valign=top><td width=100%>Description<BR>goes<br>here<br></td></tr>
			</table>
		</td></tr>
		</table>
				<table width=85% border=1 cellpadding=0 cellspacing=0>
				<tr><td width=30%><B>Toy name</B></td>
				<td width=30%><B>Toy category</B></td>
				<td width=30%><B>Toy Photo (small)</B></td>
				<td width=10%><B>Status</B></td></tr>
				<?php 
				if (!empty($row)) {
					// print_r($row);
					foreach ($row as $row_key=>$row_value) {
						echo "<tr>";
						echo "<td>".$row_value["a.name"]."</td>\n";
						echo "<td>";
						// Now retrieve the category (ies)
						$query_category = $db->getQuery(true);
						$query_category
						->select(array('a.*','b.category'))
						->from($db->quoteName('#__toydatabase_categorylink','a'))
						->join('INNER', $db->quoteName('#__toydatabase_equipment_category', 'b') . ' ON (' . $db->quoteName('a.categoryid') . ' = ' . $db->quoteName('b.id') . ')')
						->where($db->quoteName('a.equipmentid') . ' = '. $row_key);
						$db->setQuery((string) $query_category);
						$db->execute();
						$category_rows = $db->loadAssocList();
						foreach ($category_rows as $cat_display) {
							echo $cat_display["category"]."<BR>\n";
						};
						echo "</td>";
						echo "<td>";
						// check the file exists to display the image
						if (is_file(JPATH_BASE."/".$row_value["picture"])) {
							// dynamically resize image using php
							echo "<img src='".JURI::root()."/../../../../components/com_toydatabase/toydatabase_thumbnailer.php?img=".$row_value["picture"]."' alt='".$row_value["picture"]."'>";
						} else {
							echo "Sorry no image exists";
						};
						echo "</td>\n";
						echo "<td>";
						switch($row_value["status"]) {
							case "3":
								echo "Damaged/No longer available";
								break;
							case "2":
								echo "Awaiting cleaning/repair";
								break;
							case "1":
								echo "On Loan";
								break;
							case "0":
								echo "Available";
								break;
							default:
								echo "Unknown";
								break;
						};
						echo "</td>\n";
						echo "</tr>";
					};
				} else {
					// no rows or toys in database found
					echo "<tr><td colspan=4 align=center><B>Sorry - No items found</B></td></tr>\n";
				};
			};
		};
				?>
				</table>
<?php 
		break;
	case "requests":
		break;
	default:
		// nothing should get here so give blank
		echo "";
		break;
};
?>
</div>
        </div>
        <div id="footerwrap">
        <div id="footer">
            <center><p>Toy library database (C)<?=date("Y")?> Andy Brown www.broadcast-tech.co.uk software</p></center>
        </div>
        </div>
    </div>
</body>
</html>