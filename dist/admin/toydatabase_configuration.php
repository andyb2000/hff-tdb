<form method=post name='configuration'>
<table width=95% border=1 cellpadding=0 cellspacing=0>
<tr><td><B>User group membership association:</B></td>
<td><select name='groupmembership'>
<option value=''></option>
<?php
$query_permissions=$db->getQuery(true);
$query_permissions
->select("*")
->from($db->quoteName('#__toydatabase_permissions'))
->where($db->quoteName('function') . ' = "member"');
$db->setQuery((string) $query_permissions);
$db->execute();
$permissions_rows = $db->loadAssocList();
//print_r($permissions_rows);
$query_usergroups = $db->getQuery(true);
$query_usergroups
->select("*")
->from($db->quoteName('#__usergroups'));
$db->setQuery((string) $query_usergroups);
$db->execute();
$usergroups_rows = $db->loadAssocList();
foreach ($usergroups_rows as $usergroup_output) {
	echo "<option value='".$usergroup_output["id"]."' ";
	if ($permissions_rows[0]["groupname"] == $usergroup_output["id"]) {echo "selected";};
	echo ">".$usergroup_output["title"]."</option>\n";
};

$admin_emails=$permissions_rows[0]["admin_emails"];
?>
</select></td></tr>
<tr><td colspan=2>Note: You must have already created a usergroup. If not, click <a href='index.php?option=com_users&view=groups'>HERE</a> to set one up first.</td></tr>
<tr><td colspan=2 align=center><hr width=99%></td></tr>
<tr><td><B>Admin emails (Comma separated):</B></td><td><input type=text name='admin_emails' id='admin_emails' value='<?=$admin_emails?>'></td></tr>
<tr><td colspan=2 align=center><hr width=99%></td></tr>
<tr><td colspan=2 align=right><input type=submit name='Save changes'></td></tr>
</table>
</form>