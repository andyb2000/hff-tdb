<?php
	$in_groupmembership = $jinput->get('groupmembership', '', 'RAW');
	$in_admin_emails = $jinput->get('admin_emails', '', 'RAW');
	$front_html = $jinput->get('front_html', '', 'RAW');

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
	
	
	$query_permissions=$db->getQuery(true);
	$query_permissions
	->select("*")
	->from($db->quoteName('#__toydatabase_permissions'));
	$db->setQuery((string) $query_permissions);
	$db->execute();
	$permissions_rows = $db->loadAssocList();

	print_r($permissions_rows);
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
	if (@$permissions_rows[0]["groupname"] == $usergroup_output["id"]) {echo "selected";};
	echo ">".$usergroup_output["title"]."</option>\n";
};

$admin_emails=$permissions_rows[0]["admin_emails"];
?>
</select></td></tr>
<tr><td colspan=2>Note: You must have already created a usergroup. If not, click <a href='index.php?option=com_users&view=groups'>HERE</a> to set one up first.</td></tr>
<tr><td colspan=2 align=center><hr width=99%></td></tr>
<tr><td><B>Admin emails (Comma separated):</B></td><td><input type=text name='admin_emails' id='admin_emails' value='<?=$admin_emails?>'></td></tr>
<tr><td colspan=2 align=center><hr width=99%></td></tr>
<tr><td colspan=2 align=center><hr width=99%></td></tr>
<tr><td><B>Front end website top welcome message:</B></td><td>
<?php 
			echo $editor->display('front_html', $permissions_rows[0]["front_html"], '100%', '100px', '10', '4',true);
?>
</td></tr>
<tr><td colspan=2 align=right><input type=submit name='Save changes'></td></tr>
</table>
</form>
