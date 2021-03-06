Membership is a <i>suppliment</i> to the joomla user management. Users should have a joomla account FIRST, then you can add additional information here for their toy database membership details.<BR>
<?php
switch($member_act) {
	case "2":
		// make changes to selected user
		if ($tab == "member") {
			$frm_in_joomla_userid = $jinput->get('in_joomla_userid', '', 'RAW');
			$frm_in_membername = $jinput->get('in_membername', '', 'RAW');
			$frm_in_urn = $jinput->get('in_urn', '', 'RAW');
			$frm_in_type = $jinput->get('in_type', '', 'RAW');
			$frm_in_companyname = $jinput->get('in_companyname', '', 'RAW');
			$frm_in_address1 = $jinput->get('in_address1', '', 'RAW');
			$frm_in_address2 = $jinput->get('in_address2', '', 'RAW');
			$frm_in_town = $jinput->get('in_town', '', 'RAW');
			$frm_in_postcode = $jinput->get('in_postcode', '', 'RAW');
			$frm_in_telephone = $jinput->get('in_telephone', '', 'RAW');
			$frm_in_mobile = $jinput->get('in_mobile', '', 'RAW');
			$frm_in_email = $jinput->get('in_email', '', 'RAW');
			$frm_in_memb_category = $jinput->get('in_memb_category', '', 'RAW');
			$frm_in_renewaldate = $jinput->get('in_renewaldate', '', 'RAW');
			if ($frm_in_renewaldate) {
				// renewaldate is d/m/Y so convert to mysql format
				$frm_renewaldate=JFactory::getDate($frm_in_renewaldate);
				$frm_renewaldate_out=JHtml::_('date', $frm_renewaldate, 'Y-m-d 00:00:00');
			} else {
				$frm_renewaldate_out="";
			};
			$frm_in_disabilities = $jinput->get('in_disabilities', '', 'RAW');
			$frm_in_children = $jinput->get('in_children', '', 'RAW');
			$frm_in_adminnotes = $jinput->get('in_adminnotes', '', 'RAW');
			$frm_in_active = $jinput->get('active', '', 'RAW');
			$frm_in_active_original_value = $jinput->get('active_original_value', '', 'RAW');
				
			// get the registered userid from joomla for activating and deactivating users
			$get_usergroup_joomla = $db->getQuery(true);
			$get_usergroup_joomla
			->select('*')
			->from($db->quoteName('#__usergroups'))
			->where($db->quoteName('title') . ' = "Registered"');
			$db->setQuery((string) $get_usergroup_joomla);
			$db->execute();
			$joomlagroup_row = $db->loadAssoc();
			$joomlagroup_registered = $joomlagroup_row["id"];
			
			// If ddid is empty/blank then it's adding a new user, so do the new add part instead
			if (!$ddid) {
				$ins_memb_request = $db->getQuery(true);
				$ins_memb_columns = array('joomla_userid','type','urn','name','companyname','address1','address2','town','postcode','telephone','mobile','email','memb_category','joindate','creationdate','renewaldate','disabilities','children','adminnotes','active','adminuser');
				$ins_memb_values = array($db->quote($frm_in_joomla_userid),$db->quote($frm_in_type),$db->quote($frm_in_urn),$db->quote($frm_in_membername),$db->quote($frm_in_companyname),$db->quote($frm_in_address1),$db->quote($frm_in_address2),$db->quote($frm_in_town),$db->quote($frm_in_postcode),$db->quote($frm_in_telephone),$db->quote($frm_in_mobile),$db->quote($frm_in_email),$db->quote($frm_in_memb_category),'NOW()','NOW()',$db->quote($frm_in_renewaldate),$db->quote($frm_in_disabilities),$db->quote($frm_in_children),$db->quote($frm_in_adminnotes),$db->quote($frm_in_active),$db->quote($user->id));
				$ins_memb_request
								->insert($db->quoteName('#__toydatabase_membership'))
								->columns($db->quoteName($ins_memb_columns))
								->values(implode(',', $ins_memb_values));
				try {
						$db->setQuery((string) $ins_memb_request);
						$db->execute();
						$ddid = $db->insertid();
						echo "OK, member added with id $ddid<BR>\n";
				}
					catch (RuntimeException $e) {
						echo "Error with inserting member mysql ".$e->getMessage()."<BR><BR>\n";
						JFactory::getApplication()->enqueueMessage($e->getMessage());
						return false;
					};
			};
				
			// get the joomlauserid from the membership database
			$get_memb_joomlaid = $db->getQuery(true);
			$get_memb_joomlaid
			->select('*')
			->from($db->quoteName('#__toydatabase_membership'))
			->where($db->quoteName('id') . ' = ' . $ddid);
			$db->setQuery((string) $get_memb_joomlaid);
			$db->execute();
			$memb_joomlaid = $db->loadAssoc();
			$joomla_userid = $memb_joomlaid["joomla_userid"];
				
			// if activated then set the user to registered in joomla too
			// we can only do this if joomla_userid is valid and not 0
			if ($joomla_userid && $joomla_userid != 0) {
			if ($frm_in_active == "1") {
				// active
				$get_curruser_joomla = $db->getQuery(true);
				$get_curruser_joomla
				->select('*')
				->from($db->quoteName('#__user_usergroup_map'))
				->where($db->quoteName('user_id') . ' = '. $joomla_userid, 'AND')
				->where($db->quoteName('group_id') . ' = '. $joomlagroup_registered);
				$db->setQuery((string) $get_curruser_joomla);
				$db->execute();
				if ($db->getNumRows() == 0) {
					// add as they arent in the registered column
					$ins_request = $db->getQuery(true);
					$ins_columns = array('user_id','group_id');
					$ins_values = array($db->quote($joomla_userid),$db->quote($joomlagroup_registered));
					$ins_request
					->insert($db->quoteName('#__user_usergroup_map'))
					->columns($db->quoteName($ins_columns))
					->values(implode(',', $ins_values));
					try {
						$db->setQuery($ins_request);
						$db->execute();
					}
					catch (RuntimeException $e) {
						JFactory::getApplication()->enqueueMessage($e->getMessage());
						return false;
					};
				};
			};
			if ($frm_in_active == "10") {
				// suspended so delete the registered state for this user
				$get_curruser_joomla = $db->getQuery(true);
				$get_curruser_joomla
				->select('*')
				->from($db->quoteName('#__user_usergroup_map'))
				->where($db->quoteName('user_id') . ' = '. $joomla_userid, 'AND')
				->where($db->quoteName('group_id') . ' = '. $joomlagroup_registered);
				$db->setQuery((string) $get_curruser_joomla);
				$db->execute();
				if ($db->getNumRows() > 0) {
					// delete as they are here
					$del_query = $db->getQuery(true);
					$del_query->delete($db->quoteName('#__user_usergroup_map'));
					$del_query->where($db->quoteName('user_id') . ' = '. $joomla_userid, 'AND')
					->where($db->quoteName('group_id') . ' = '. $joomlagroup_registered);
					$db->setQuery($del_query);
					$db->execute();
				};
			};
			if ($frm_in_active == "10") {
				// deleted so do the same as suspended
				$get_curruser_joomla = $db->getQuery(true);
				$get_curruser_joomla
				->select('*')
				->from($db->quoteName('#__user_usergroup_map'))
				->where($db->quoteName('user_id') . ' = '. $joomla_userid, 'AND')
				->where($db->quoteName('group_id') . ' = '. $joomlagroup_registered);
				$db->setQuery((string) $get_curruser_joomla);
				$db->execute();
				if ($db->getNumRows() > 0) {
					// delete as they are here
					$del_query = $db->getQuery(true);
					$del_query->delete($db->quoteName('#__user_usergroup_map'));
					$del_query->where($db->quoteName('user_id') . ' = '. $joomla_userid, 'AND')
					->where($db->quoteName('group_id') . ' = '. $joomlagroup_registered);
					$db->setQuery($del_query);
					$db->execute();
				};
			};
			}; // end checking joomlaid is valid
			// 03-04-17 fix by adding joomla_userid to update existing entries.
			$upd_request = $db->getQuery(true);
			$upd_fields = array(
                                        $db->quoteName('joomla_userid') . ' = ' . $db->quote($frm_in_joomla_userid),
					$db->quoteName('type') . ' = ' . $db->quote($frm_in_type),
					$db->quoteName('urn') . ' = ' . $db->quote($frm_in_urn),
					$db->quoteName('name') . ' = ' . $db->quote($frm_in_membername),
					$db->quoteName('companyname') . ' = ' . $db->quote($frm_in_companyname),
					$db->quoteName('address1') . ' = ' . $db->quote($frm_in_address1),
					$db->quoteName('address2') . ' = ' . $db->quote($frm_in_address2),
					$db->quoteName('town') . ' = ' . $db->quote($frm_in_town),
					$db->quoteName('postcode') . ' = ' . $db->quote($frm_in_postcode),
					$db->quoteName('telephone') . ' = ' . $db->quote($frm_in_telephone),
					$db->quoteName('mobile') . ' = ' . $db->quote($frm_in_mobile),
					$db->quoteName('email') . ' = ' . $db->quote($frm_in_email),
					$db->quoteName('memb_category') . ' = ' . $db->quote($frm_in_memb_category),
					$db->quoteName('renewaldate') . ' = ' . $db->quote($frm_renewaldate_out),
					$db->quoteName('disabilities') . ' = ' . $db->quote($frm_in_disabilities),
					$db->quoteName('children') . ' = ' . $db->quote($frm_in_children),
					$db->quoteName('adminnotes') . ' = ' . $db->quote($frm_in_adminnotes),
					$db->quoteName('active') . ' = ' . $db->quote($frm_in_active),
					$db->quoteName('adminuser') . ' = ' . $db->quote($user->id)
			);
			$upd_request->update($db->quoteName('#__toydatabase_membership'))->set($upd_fields)->where($db->quoteName('id') . ' = '. $ddid);
			try {
				$db->setQuery($upd_request);
				$db->execute();
			}
			catch (RuntimeException $e) {
				JFactory::getApplication()->enqueueMessage($e->getMessage());
				return false;
			};
			// now see if active was changed, if it has changed then do the relevant email contact
			if ($frm_in_active_original_value != $frm_in_active) {
				if ($frm_in_active == "1") {
					// now active so let them know
					$query_email1 = $db->getQuery(true);
					$query_email1->select('*')
						->from($db->quoteName('#__toydatabase_permissions'))
						->where($db->quoteName('function') . ' = "'. $db->quoteName('email_signupapproval').'"');
						$db->setQuery((string) $query_email1);
						$db->execute();
				if ($db->getNumRows() > 0) {
					$query_email1_rows = $db->loadAssocList("function");
					print_r($query_email1_rows);
					// do the replacement for variables we know
					$query_email1_rows = str_replace("%%membername%%", $frm_fullname, $query_email1_rows);
					$query_email1_rows = str_replace("%%memberusername%%", $frm_username, $query_email1_rows);
					$query_email1_rows = str_replace("%%toyname%%", $ddid, $query_email1_rows);
					$query_email1_rows = str_replace("%%toyrequestdate%%", $frm_requestedloandate, $query_email1_rows);
					$query_email1_rows = str_replace("%%toyreturndate%%", $frm_requestedloanreturndate, $query_email1_rows);
					$userid_mail=$query_email1_rows;
				} else {
					// show the built-in email text
						$userid_mail="Hi,
		Thank you for signing up to the Online Toy Library system ".$config->get('sitename')."
		The admin has now activated your account.
					
					
					Generated by ToyDatabase(C)2016 Andy Brown";
				};
				};
				if ($frm_in_active == "10") {
					$query_email1 = $db->getQuery(true);
					$query_email1->select('*')
						->from($db->quoteName('#__toydatabase_permissions'))
						->where($db->quoteName('function') . ' = "'. $db->quoteName('email_signuprejected').'"');
						$db->setQuery((string) $query_email1);
						$db->execute();
				if ($db->getNumRows() > 0) {
					$query_email1_rows = $db->loadAssocList("function");
					print_r($query_email1_rows);
					// do the replacement for variables we know
					$query_email1_rows = str_replace("%%membername%%", $frm_fullname, $query_email1_rows);
					$query_email1_rows = str_replace("%%memberusername%%", $frm_username, $query_email1_rows);
					$query_email1_rows = str_replace("%%toyname%%", $ddid, $query_email1_rows);
					$query_email1_rows = str_replace("%%toyrequestdate%%", $frm_requestedloandate, $query_email1_rows);
					$query_email1_rows = str_replace("%%toyreturndate%%", $frm_requestedloanreturndate, $query_email1_rows);
					$userid_mail=$query_email1_rows;
				} else {
					// show the built-in email text
						$userid_mail="Hi,
		Thank you for signing up to the Online Toy Library system ".$config->get('sitename')."
		Unfortunately the admin has deactivated your account. Please get in touch with us if you wish to proceed and use the database.
					
					
					Generated by ToyDatabase(C)2016 Andy Brown";
				};
				};
			}; // end change active if condition
			if ($userid_mail) { // send the email if it exists
					$user_mailer = JFactory::getMailer();
					$sender = array(
							$config->get( 'mailfrom' ),
							$config->get( 'fromname' )
					);
					$user_mailer->setSender($sender);
					$user_mailer->addRecipient($user->email);
					$user_mailer->setSubject($config->get('sitename').'::Toy Database user registration request');
					$user_mailer->setBody($userid_mail);
					$user_send = $user_mailer->Send();
					if ( $user_send !== true ) {
						echo 'Error sending email to the user. Error message: ' . $user_send->__toString(). '<BR><BR>';
					};

			};
			echo "<h2>Complete</h2> - Member has been updated<BR>\n";
		}; // if tab == member
		break;
	case "1":
		// display specific member
		if($tab == "member") {
			if ($ddid) {
				$query = $db->getQuery(true);
				$query
				->select('*')
				->from($db->quoteName('#__toydatabase_membership'))
				->where($db->quoteName('id') . ' = '. $ddid);
				$db->setQuery((string) $query);
				$db->execute();
				$row = $db->loadAssoc();
					
				// get member type lookup
				$query_membtype = $db->getQuery(true);
				$query_membtype
				->select('*')
				->from($db->quoteName('#__toydatabase_membershiplink'))
				->where($db->quoteName('membershipid') . ' = '. $ddid);
				$db->setQuery((string) $query_membtype);
				$db->execute();
				$memb_typerow = $db->loadAssoc();
				
				if ($row["renewaldate"] != "0000-00-00 00:00:00") {
					$entry_renewaldate=JFactory::getDate($row["renewaldate"]);
					$in_renewaldate=JHtml::_('date', $entry_renewaldate, 'd-m-Y');
				};
			};
			?>
					<form method=post name='update_member'>
					<input type=hidden name='member_act' value='2'>
					<input type=hidden name='ddid' value='<?=$ddid?>'>
					<input type=hidden name='tab' value='member'>
					<table width=95% border=1 cellpadding=0 cellspacing=0 class="hoverTable">
					<tr>
					<td valign=top><B>Joomla Userid link :</B></td>
					<td><input type=text size=5 name='in_joomla_userid' id='in_joomla_userid' value='<?=$row["joomla_userid"]?>'>&nbsp;<a href="<?=JURI::root()?>/administrator/components/com_toydatabase/toydatabase_popjoomlauser.php?curr_member=<?=$row["joomla_userid"]?>" class="modal" id='memberselector' name='memberselector' rel="{handler: 'iframe', size: {x: 600, y: 400}}">Joomla user selector</a></td>
					</tr>
					<tr>
					<td valign=top><B>Member Name :</B></td>
					<td><input type=text size=30 name='in_membername' value='<?=$row["name"]?>'></td>
					</tr>
					<tr>
					<td valign=top><B>URN :</B></td>
					<td><input type=text size=20 name='in_urn' value='<?=$row["urn"]?>'></td>
					</tr>
					<tr>
					<td valign=top><B>Type :</B></td>
					<td><select name='in_type'>
<option value=''></option>
<option value='1' <?php // added fix 03-04-17
if ($row["type"] == "1") {echo "selected";}; ?>>Individual</option>
<option value='2' <?php // added fix 03-04-17
if ($row["type"] == "2") {echo "selected";}; ?>>Organisation</option>
					</select></td>
					</tr>
					<tr>
					<td valign=top><B>Company Name :</B></td>
					<td><input type=text size=30 name='in_companyname' value='<?=$row["companyname"]?>'></td>
					</tr>
					<tr>
					<td valign=top><B>Address1 :</B></td>
					<td><input type=text size=50 name='in_address1' value='<?=$row["address1"]?>'></td>
					</tr>
					<tr>
					<td valign=top><B>Address2 :</B></td>
					<td><input type=text size=50 name='in_address2' value='<?=$row["address2"]?>'></td>
					</tr>
					<tr>
					<td valign=top><B>Town :</B></td>
					<td><input type=text size=50 name='in_town' value='<?=$row["town"]?>'></td>
					</tr>
					<tr>
					<td valign=top><B>Postcode :</B></td>
					<td><input type=text size=15 name='in_postcode' value='<?=$row["postcode"]?>'></td>
					</tr>
					<tr>
					<td valign=top><B>Telephone :</B></td>
					<td><input type=text size=50 name='in_telephone' value='<?=$row["telephone"]?>'></td>
					</tr>
					<tr>
					<td valign=top><B>Mobile :</B></td>
					<td><input type=text size=50 name='in_mobile' value='<?=$row["mobile"]?>'></td>
					</tr>
					<tr>
					<td valign=top><B>Email :</B></td>
					<td><input type=text size=60 name='in_email' value='<?=$row["email"]?>'></td>
					</tr>
					<tr>
					<td valign=top><B>Membership Category :</B></td>
					<td><select name='in_memb_category'/>
<option value=''></option>
<?php 
// get membershiptypes
$query_membtypes = $db->getQuery(true);
$query_membtypes
->select("*")
->from($db->quoteName('#__toydatabase_membershiptypes'));
$db->setQuery((string) $query_membtypes);
$db->execute();
$membershiptypes_rows= $db->loadAssocList();
foreach ($membershiptypes_rows as $membershiptypes_output) {
	echo "<option value='".$membershiptypes_output["id"]."' ";
	if ($row["memb_category"] == $membershiptypes_output["id"]) {echo "selected";};
	echo ">".$membershiptypes_output["type"]."</option>\n";
};
?>
</select>
					</td>
					</tr>
					<tr>
					<td valign=top><B>Renewal Date :</B></td>
					<td><?=JHTML::_('calendar', $in_renewaldate, "in_renewaldate" , "in_renewaldate", '%d-%m-%Y'); ?></td>
					</tr>
					<tr>
					<td valign=top><B>Join Date (locked) :</B></td>
					<td><input type=text size=50 name='in_joindate' disabled value='<?=$row["joindate"]?>'></td>
					</tr>
					<tr>
					<td valign=top><B>Creation Date (locked) :</B></td>
					<td><input type=text size=50 name='in_creationdate' disabled value='<?=$row["creationdate"]?>'></td>
					</tr>
					<tr>
					<td valign=top><B>Disabilities :</B></td>
					<td><textarea rows="3" cols="4" name='in_disabilities'><?=$row["disabilities"]?></textarea></td>
					</tr>
					<tr>
					<td valign=top><B>Children :</B></td>
					<td><input type=text size=5 name='in_children' value='<?=$row["children"]?>'></td>
					</tr>
					<tr>
					<td valign=top><B>Notes (Internal Only) :</B></td>
					<td><?php 
						echo $editor->display('in_adminnotes', $row["adminnotes"], '60%', '10px', '3', '5',true);
					?></td>
					</tr>
					<tr>
					<td valign=top><B>Status :</B></td>
					<td><input type=hidden name='active_original_value' value='<?=$row["active"]?>'>
						<select name='active'>
					<option value='0' <?php if ($row["active"] == "0") {echo "selected";}; ?>>Pending approval</option>
					<option value='1' <?php if ($row["active"] == "1") {echo "selected";}; ?>>Active</option>
					<option value='10' <?php if ($row["active"] == "10") {echo "selected";}; ?>>Suspended</option>
					<option value='99' <?php if ($row["active"] == "99") {echo "selected";}; ?>>Deleted</option>
					</select></td>
					</tr>
					<tr>
					<td valign=top><B>Created/Approved by (locked) :</B></td>
					<td><input type=text size=50 name='in_adminuser' disabled value='<?=$row["adminuser"]?>'></td>
					</tr>
					<tr><td colspan=2 align=right><input type=submit value='Save changes'></td></tr>
					</table>
					</form>
		<?php
		};
		break;
	default:
		// display member list
		$query = $db->getQuery(true);
		$query
		->select('SQL_CALC_FOUND_ROWS *')
		->from($db->quoteName('#__toydatabase_membership'))
//		->order($db->quoteName('name') . ' DESC');
// change 03-04-17 to make finding new members easier
                ->order($db->quoteName('active') . ' ASC');
		
		$app = JFactory::getApplication();
		$limit = $app->getUserStateFromRequest("$option.limit", 'limit', 25, 'int');
		$limitstart = JFactory::getApplication()->input->get('limitstart', 0, 'INT');
		
		$db->setQuery($query,$limitstart, $limit);
		$row = $db->loadAssocList('id');
		if(!empty($row)){
			$db->setQuery('SELECT FOUND_ROWS();');
			$num_rows=$db->loadResult();
			jimport('joomla.html.pagination');
			$pager=new JPagination($num_rows, $limitstart, $limit);
		};
		?>
				<!-- Print/PDF button -->
		<form method=post onsubmit="return false">
		<table width=100% border=0 cellpadding=0 cellspacing=0>
		<tr align=right><td align=right><input type=button name='printpage' id='printpage' value='Print Members' onclick='window.open("<?=JURI::root()?>/administrator/components/com_toydatabase/pdf_output.php?disp=members");'></td></tr>
		</table>
		</form>
		<!-- end print button -->
				<!-- Toy database search -->
		<form method=post name='member_search' id='member_search' onsubmit="return false">
		<input type=hidden name='page' value='members'>
		<input type=hidden name='act' value='1'>
		<input type=hidden name='tab' value='members'>
		<table width=100% border=0 cellpadding=0 cellspacing=0>
		<tr align=right><td align=right>Search members:</td><td width=230><input type=text size=20 onkeyup = "showResultMembers(this.value)"><div id = "livesearch_members"></div></td></tr>
		</table>
		</form>
		<!-- END Toy database search -->
		
						<!-- New member button -->
						<form method=post onsubmit="return false">
						<input type=hidden name='member_act' value='4'>
						<input type=hidden name='tab' value='member'>
						<table width=100% border=0 cellpadding=0 cellspacing=0>
						<tr align=right><td align=right><input type=button name='newmember' id='newmember' value='Add a new member link' onclick='self.location="<?=JURI::getInstance()->toString() ?>&tab=member&page=members&member_act=1"'></td></tr>
						</table>
						</form>
						<!-- END new member button -->
						
						<table width=85% border=1 cellpadding=0 cellspacing=0 class="hoverTable">
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
								
								echo "<tr onclick='self.location=\"".JURI::getInstance()->toString()."&tab=member&page=members&member_act=1&ddid=$row_key\"'>";
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
?>
								</table><form name="adminForm" id="adminForm">
		<input type=hidden name='option' value='com_toydatabase'>
		<input type=hidden name='page' value='members'>
<?php
						echo $pager->getListFooter();
						echo "Number of members to display per page: ".$pager->getLimitBox()."<BR>\n";
						echo "</form>";
						} else {
							// no rows or toys in database found
							echo "<tr><td colspan=8 align=center><B>Sorry - No members found</B></td></tr>\n";
							echo "</table>";
						};
			// end of default: switch
		break;
};
?>
