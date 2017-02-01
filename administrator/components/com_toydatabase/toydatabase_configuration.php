<?php
	$in_groupmembership = $jinput->get('groupmembership', '', 'RAW');
	$in_admin_emails = $jinput->get('admin_emails', '', 'RAW');
	$front_html = $jinput->get('front_html', '', 'RAW');
	$email_signup = $jinput->get('email_signup', '', 'RAW');
	$email_signupapproval = $jinput->get('email_signupapproval', '', 'RAW');
	$email_signuprejected = $jinput->get('email_signuprejected', '', 'RAW');
	$email_booktoy_request = $jinput->get('email_booktoy_request', '', 'RAW');
	$email_booktoy_approve = $jinput->get('email_booktoy_approve', '', 'RAW');
	$email_booktoy_reject = $jinput->get('email_booktoy_reject', '', 'RAW');

	function toydatabase_updateconfiguration($param,$param_value) {
		global $db;
		
		if ($param) {
			// check there is an entry in db first
			$check_request = $db->getQuery(true);
			$query
			->select('*')
			->from($db->quoteName('#__toydatabase_permissions'))
			->where($db->quoteName('function') . ' = '. $param);
			$db->setQuery($query);
			$db->execute();
			
			if ($db->getNumRows() > 0) {
				// do the update
				$upd_request = $db->getQuery(true);
				$upd_fields = array($db->quoteName('groupname') . ' = ' . $db->quote($param_value));
				$upd_request->update($db->quoteName('#__toydatabase_permissions'))->set($upd_fields)->where($db->quoteName('function') . ' = "'.$param.'"');
				try {
					$db->setQuery($upd_request);
					$db->execute();
				}
				catch (RuntimeException $e) {
					JFactory::getApplication()->enqueueMessage($e->getMessage());
					echo "ERROR with $param update: ".$e->getMessage();
					return false;
				};
			} else {
				// didnt exist so add it as a new entry in the permissions table
				$ins_request = $db->getQuery(true);
				$ins_columns = array('function','groupname');
				$ins_values = array($db->quote($param),$db->quote($param_value));
				$ins_request
				->insert($db->quoteName('#__toydatabase_equipment_permissions'))
				->columns($db->quoteName($ins_columns))
				->values(implode(',', $ins_values));
				try {
					$db->setQuery($ins_request);
					$db->execute();
				}
				catch (RuntimeException $e) {
					JFactory::getApplication()->enqueueMessage("Error inserting config entry ".$e->getMessage());
					return false;
				};
			};
		};
	};
	
	if ($in_groupmembership) {
		// update
		$upd_request = $db->getQuery(true);
			$upd_fields = array(
					$db->quoteName('groupname') . ' = ' . $db->quote($in_groupmembership)
			);
			$upd_request->update($db->quoteName('#__toydatabase_permissions'))->set($upd_fields)->where($db->quoteName('function') . ' = "member"');
			try {
				$db->setQuery($upd_request);
				$db->execute();
			}
			catch (RuntimeException $e) {
				JFactory::getApplication()->enqueueMessage($e->getMessage());
				echo "ERROR with group membership update: ".$e->getMessage();
				return false;
			};
		$upd_request = $db->getQuery(true);
			$upd_fields = array(
					$db->quoteName('groupname') . ' = ' . $db->quote($in_admin_emails)
			);
			$upd_request->update($db->quoteName('#__toydatabase_permissions'))->set($upd_fields)->where($db->quoteName('function') . ' = "admin_emails"');
			try {
				$db->setQuery($upd_request);
				$db->execute();
			}
			catch (RuntimeException $e) {
				JFactory::getApplication()->enqueueMessage($e->getMessage());
				echo "ERROR with admin emails update: ".$e->getMessage();
				return false;
			};
	};
	if ($front_html) {
		$upd_request = $db->getQuery(true);
		$upd_fields = array(
				$db->quoteName('groupname') . ' = ' . $db->quote($front_html)
		);
		$upd_request->update($db->quoteName('#__toydatabase_permissions'))->set($upd_fields)->where($db->quoteName('function') . ' = "front_html"');
		try {
			$db->setQuery($upd_request);
			$db->execute();
		}
		catch (RuntimeException $e) {
			JFactory::getApplication()->enqueueMessage($e->getMessage());
			echo "ERROR with front_html update: ".$e->getMessage();
			return false;
		};
	};
	
	if ($email_signup) {
		toydatabase_updateconfiguration("email_signup",$email_signup);
	};
	if ($email_signupapproval) {
		toydatabase_updateconfiguration("email_signupapproval",$email_signupapproval);
	};
	if ($email_signuprejected) {
		toydatabase_updateconfiguration("email_signuprejected",$email_signuprejected);
	};
	if ($email_booktoy_request) {
		toydatabase_updateconfiguration("email_booktoy_request",$email_booktoy_request);
	};
	if ($email_booktoy_approve) {
		toydatabase_updateconfiguration("email_booktoy_approve",$email_booktoy_approve);
	};
	if ($email_booktoy_reject) {
		toydatabase_updateconfiguration("email_booktoy_reject",$email_booktoy_reject);
	};
	
	$query_permissions=$db->getQuery(true);
	$query_permissions
	->select("*")
	->from($db->quoteName('#__toydatabase_permissions'));
	$db->setQuery((string) $query_permissions);
	$db->execute();
	$permissions_rows = $db->loadAssocList("function");

?>
<form method=post name='configuration'>
<table width=95% border=1 cellpadding=0 cellspacing=0>
<tr><td><B>User group membership association:</B></td>
<td><select name='groupmembership'>
<option value=''></option>
<?php
$query_usergroups = $db->getQuery(true);
$query_usergroups
->select("*")
->from($db->quoteName('#__usergroups'));
$db->setQuery((string) $query_usergroups);
$db->execute();
$usergroups_rows = $db->loadAssocList();
foreach ($usergroups_rows as $usergroup_output) {
	echo "<option value='".$usergroup_output["id"]."' ";
	if (@$permissions_rows["member"]["groupname"] == $usergroup_output["id"]) {echo "selected";};
	echo ">".$usergroup_output["title"]."</option>\n";
};

$admin_emails=$permissions_rows["admin_emails"]["groupname"];
?>
</select></td></tr>
<tr><td colspan=2>Note: You must have already created a usergroup. If not, click <a href='index.php?option=com_users&view=groups'>HERE</a> to set one up first.</td></tr>
<tr><td colspan=2 align=center valign=top><hr width=99%></td></tr>
<tr><td valign=top><B>Admin emails (Comma separated):</B></td><td><input type=text name='admin_emails' id='admin_emails' value='<?=$admin_emails?>'></td></tr>
<tr><td colspan=2 valign=top align=center><hr width=99%></td></tr>
<tr><td colspan=2 valign=top align=center><hr width=99%></td></tr>
<tr><td valign=top><B>Front end website top welcome message:</B></td><td>
<?php
			echo $editor->display('front_html', $permissions_rows["front_html"]["groupname"], '100%', '100px', '10', '4',true);
?>
</td></tr>
<tr><td colspan=2 valign=top align=center><hr width=99%></td></tr>
<tr><td colspan=2 valign=top align=center>All emails may use the following 'variable' which are replaced automatically by the system:<BR>
<pre>
%%membername%% = The members full name
%%memberusername%% = The members username
%%toyname%% = The toy name
%%toyrequestdate%% = The toy booking requested date
%%toyreturndate%% = The toy booking return by date
</pre>
</td></tr>
<tr><td colspan=2 valign=top align=center><hr width=99%></td></tr>
<tr><td valign=top><B>Sign up to database email (to users):</B></td><td>
<?php
			echo $editor->display('email_signup', $permissions_rows[0]["email_signup"], '5%', '50px', '5', '2',true);
?>
</td></tr>
<tr><td valign=top><B>Sign up approval email (to users):</B></td><td>
<?php
			echo $editor->display('email_signupapproval', $permissions_rows[0]["email_signupapproval"], '5%', '50px', '5', '2',true);
?>
</td></tr>
<tr><td valign=top><B>Sign up rejected email (to users):</B></td><td>
<?php
			echo $editor->display('email_signuprejected', $permissions_rows[0]["email_signuprejected"], '5%', '50px', '5', '2',true);
?>
</td></tr>
<tr><td valign=top><B>Book a toy request (initial pending approval) email (to users):</B></td><td>
<?php
			echo $editor->display('email_booktoy_request', $permissions_rows[0]["email_booktoy_request"], '5%', '50px', '5', '2',true);
?>
</td></tr>
<tr><td valign=top><B>Toy booking has been approved email (to users):</B></td><td>
<?php
			echo $editor->display('email_booktoy_approve', $permissions_rows[0]["email_booktoy_approve"], '5%', '50px', '5', '2',true);
?>
</td></tr>
<tr><td valign=top><B>Toy booking has been rejected email (to users):</B></td><td>
<?php
			echo $editor->display('email_booktoy_reject', $permissions_rows[0]["email_booktoy_reject"], '5%', '50px', '5', '2',true);
?>
</td></tr>
<tr><td colspan=2 valign=top align=right><input type=submit name='Save changes'></td></tr>
</table>
</form>
