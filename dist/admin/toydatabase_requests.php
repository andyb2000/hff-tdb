<?php
// approval system, theory is:
//  toydatabase_loanlink contains the loans in the system, historical and active
//  show them all sorted by which ones are active (then into history)
//  allow a manual addition for a member (or non-member)
switch($loan_act) {
	case "4":
		// add a manual loan request
		if($tab == "loan") {

			?>
									<form method=post name='loanrequest' id='loanrequest'>
									<input type=hidden name='loan_act' value='2'>
									<input type=hidden name='ddid' value='0'>
									<input type=hidden name='tab' value='loan'>
									<table width=95% border=1 cellpadding=0 cellspacing=0 class="hoverTable">
									<tr>
									<td valign=top><B>Toy id :</B></td>
									<td><input type=text size=5 name='in_equipmentid' id='in_equipmentid' value=''>&nbsp;
									<a href="<?=JURI::root()?>/administrator/components/com_toydatabase/toydatabase_poptoy.php?curr_toy=<?=$row["equipmentid"]?>" class="modal" id='toyselector' name='toyselector' rel="{handler: 'iframe', size: {x: 500, y: 400}}">Toy selector</a>
									</td>
									</tr>
									<tr>
									<td valign=top><B>Member id :</B></td>
									<td><input type=text size=5 name='in_membershipid' id='in_membershipid' value=''>&nbsp;
									<a href="<?=JURI::root()?>/administrator/components/com_toydatabase/toydatabase_popmember.php?curr_member=<?=$row["membershipid"]?>" class="modal" id='memberselector' name='memberselector' rel="{handler: 'iframe', size: {x: 500, y: 400}}">Member selector</a>
									</td>
									</tr>
									<tr>
									<td valign=top><B>Loan Requested Date :</B></td>
									<td><?=JHTML::_('calendar', date("%d-%m-%Y"), "in_loandate" , "in_loandate", '%d-%m-%Y'); ?></td>
									</tr>
									<tr>
									<td valign=top><B>Return By Date :</B></td>
									<td><?=JHTML::_('calendar', date("%d-%m-%Y"), "in_returnbydate" , "in_returnbydate", '%d-%m-%Y'); ?></td>
									</tr>
									<tr>
									<td valign=top><B>Returned Date :</B></td>
									<td><?=JHTML::_('calendar', "", "in_returndate" , "in_returndate", '%d-%m-%Y'); ?></td>
									</tr>
									<tr>
									<td valign=top><B>Status :</B></td>
									<td><select name='in_status'>
									<option value=''></option>
									<option value='1'>Approved</option>
									<option value='2'>Pending</option>
									<option value='3'>Rejected</option>
									<option value='3'>Returned</option>
									</select>
									</td>
									</tr>
									<tr><td colspan=2 align=right><input type=submit value='Create request'></td></tr>
									</table>
									</form>
						<?php
						};				
		break;
	case "2":
		// save changes to loan request
		if($tab == "loan") {
			$frm_in_equipmentid = $jinput->get('in_equipmentid', '', 'RAW');
			$frm_in_membershipid = $jinput->get('in_membershipid', '', 'RAW');
			$frm_in_requestdate = $jinput->get('in_requestdate', '', 'RAW');
			$frm_in_loandate = $jinput->get('in_loandate', '', 'RAW');
			$frm_loandate=JFactory::getDate($frm_in_loandate);
			$frm_loandate_out=JHtml::_('date', $frm_loandate, 'Y-m-d 00:00:00');
				
			$frm_in_returnbydate = $jinput->get('in_returnbydate', '', 'RAW');
			$frm_returnbydate=JFactory::getDate($frm_in_returnbydate);
			$frm_returnbydate_out=JHtml::_('date', $frm_returnbydate, 'Y-m-d 00:00:00');
				
			$frm_in_returndate = $jinput->get('in_returndate', '', 'RAW');
			if ($frm_in_returndate) {
				$frm_returndate=JFactory::getDate($frm_in_returndate);
				$frm_returndate_out=JHtml::_('date', $frm_returndate, 'Y-m-d 00:00:00');
			} else {
				$frm_returndate_out="";
			};
				
			$frm_in_status = $jinput->get('in_status', '', 'RAW');
			
			$upd_request = $db->getQuery(true);
			$upd_fields = array(
					$db->quoteName('equipmentid') . ' = ' . $db->quote($frm_in_equipmentid),
					$db->quoteName('membershipid') . ' = ' . $db->quote($frm_in_membershipid),
					$db->quoteName('loandate') . ' = ' . $db->quote($frm_loandate_out),
					$db->quoteName('returnbydate') . ' = ' . $db->quote($frm_returnbydate_out),
					$db->quoteName('returndate') . ' = ' . $db->quote($frm_returndate_out),
					$db->quoteName('status') . ' = ' . $db->quote($frm_in_status)
			);
			if ($ddid == "0") {
				// it's a new entry
				$ins_columns = array('equipmentid','membershipid', 'loandate', 'returnbydate', 'returndate', 'status');
				$ins_values = array($db->quote($frm_in_equipmentid),$db->quote($frm_in_membershipid),$db->quote($frm_loandate_out),$db->quote($frm_returnbydate_out),$db->quote($frm_returndate_out),$db->quote($frm_in_status));
				$ins_request = $db->getQuery(true);
				$ins_request
				->insert($db->quoteName('#__toydatabase_loanlink'))
				->columns($db->quoteName($ins_columns))
				->values(implode(',', $ins_values));
				try {
					$db->setQuery($ins_request);
					$db->execute();
					$newuser_id = $db->insertid();
				}
				catch (RuntimeException $e) {
					echo "Error with mysql ".$e->getMessage()."<BR><BR>\n";
					JFactory::getApplication()->enqueueMessage($e->getMessage());
					return false;
				};				
			} else {
				$upd_request->update($db->quoteName('#__toydatabase_loanlink'))->set($upd_fields)->where($db->quoteName('id') . ' = '. $ddid);
			try {
				$db->setQuery($upd_request);
				$db->execute();
			}
			catch (RuntimeException $e) {
				JFactory::getApplication()->enqueueMessage($e->getMessage());
				return false;
			};
			};
			echo "<h2>Complete</h2> - Request has been updated<BR>\n";
			// send update email to end user
			// get member type lookup
			$query_equiplookup = $db->getQuery(true);
			$query_equiplookup
			->select('*')
			->from($db->quoteName('#__toydatabase_equipment'))
			->where($db->quoteName('id') . ' = '. $frm_in_equipmentid);
			$db->setQuery((string) $query_equiplookup);
			$db->execute();
			$equip_lookup = $db->loadAssoc();
			
			$check_member_query = $db->getQuery(true);
			$check_member_query
			->select('*')
			->from($db->quoteName('#__toydatabase_membership'))
			->where($db->quoteName('joomla_userid') . ' = '. $frm_in_membershipid);
			$db->setQuery((string) $check_member_query);
			$db->execute();
			$membership_count_check= $db->getNumRows();
			$membership_row = $db->loadAssoc();
			
			$userid_mailer = JFactory::getMailer();
			$sender = array(
					$config->get( 'mailfrom' ),
					$config->get( 'fromname' )
			);
			$userid_mailer->setSender($sender);
			$userid_mailer->addRecipient($membership_row["email"]);
			$userid_mailer->setSubject($config->get('sitename').'::Toy Database - Toy request updated');
			$userid_mail="Hi,
		The administrator for the Toy Library system ".$config->get('sitename')."
		Has updated your request for the following loan:
			
		Toy request: ".$equip_lookup["name"]."
		Requested date: ".$frm_in_loandate."
		Return date: ".$frm_in_returnbydate."
		
		Your approval state: ";
		switch($frm_in_status) {
			case "4":
				$loan_status="Returned";
			case "3":
				$loan_status="Rejected";
			case "2":
				$loan_status="Pending";
				break;
			case "1":
				$loan_status="Approved";
				break;
			default:
				$loan_status="Unknown";
				break;
		};
		$userid_mail.="$loan_status
		
			
					Generated by ToyDatabase(C)2016 Andy Brown";
			$userid_mailer->setBody($userid_mail);
			$user_send = $userid_mailer->Send();
			if ( $user_send !== true ) {
				echo "Error sending email to email address (".$membership_row["email"].") Please check " . $user_send->__toString(). "<BR><BR>";
			} else {
				echo "Email has been sent to ".$membership_row["email"]." to update them on their request<BR>\n";
			};
		};
		break;
	case "1":
		// edit/view this entry
		if($tab == "loan") {
			$query = $db->getQuery(true);
			$query
			->select('*')
			->from($db->quoteName('#__toydatabase_loanlink'))
			->where($db->quoteName('id') . ' = '. $ddid);
			$db->setQuery((string) $query);
			$db->execute();
			$row = $db->loadAssoc();
				
			// get member type lookup
			$query_equiplookup = $db->getQuery(true);
			$query_equiplookup
			->select('*')
			->from($db->quoteName('#__toydatabase_equipment'))
			->where($db->quoteName('id') . ' = '. $row["equipmentid"]);
			$db->setQuery((string) $query_equiplookup);
			$db->execute();
			$equip_lookup = $db->loadAssoc();
			?>
							<form method=post name='loanrequest' id='loanrequest'>
							<input type=hidden name='loan_act' value='2'>
							<input type=hidden name='ddid' value='<?=$ddid?>'>
							<input type=hidden name='tab' value='loan'>
							<table width=95% border=1 cellpadding=0 cellspacing=0 class="hoverTable">
							<tr>
							<td valign=top><B>Toy id :</B></td>
							<td><input type=text size=5 name='in_equipmentid' id='in_equipmentid' value='<?=$row["equipmentid"]?>'>&nbsp;
							<a href="<?=JURI::root()?>/administrator/components/com_toydatabase/toydatabase_poptoy.php?curr_toy=<?=$row["equipmentid"]?>" class="modal" id='toyselector' name='toyselector' rel="{handler: 'iframe', size: {x: 500, y: 400}}">Toy selector</a>
							</td>
							</tr>
							<tr>
							<td valign=top><B>Member id :</B></td>
							<td><input type=text size=5 name='in_membershipid' id='in_membershipid' value='<?=$row["membershipid"]?>'>&nbsp;
							<a href="<?=JURI::root()?>/administrator/components/com_toydatabase/toydatabase_popmember.php?curr_member=<?=$row["membershipid"]?>" class="modal" id='memberselector' name='memberselector' rel="{handler: 'iframe', size: {x: 500, y: 400}}">Member selector</a>
							</td>
							</tr>
							<tr>
							<td valign=top><B>Request made Date :</B></td>
							<td><input type=text size=15 disabled name='in_requestdate' value='<?=$row["requestdate"]?>'></td>
							</tr>
							<tr>
							<td valign=top><B>Loan Requested Date :</B></td>
							<td><?=JHTML::_('calendar', $row["loandate"], "in_loandate" , "in_loandate", '%d-%m-%Y'); ?></td>
							</tr>
							<tr>
							<td valign=top><B>Return By Date :</B></td>
							<td><?=JHTML::_('calendar', $row["returnbydate"], "in_returnbydate" , "in_returnbydate", '%d-%m-%Y'); ?></td>
							</tr>
							<tr>
							<td valign=top><B>Returned Date :</B></td>
							<td><?=JHTML::_('calendar', $row["returndate"], "in_returndate" , "in_returndate", '%d-%m-%Y'); ?></td>
							</tr>
							<tr>
							<td valign=top><B>Status :</B></td>
							<td><select name='in_status'>
							<option value=''></option>
							<option value='1' <?php if ($row["status"] == "1") {echo "selected";}; ?>>Approved</option>
							<option value='2' <?php if ($row["status"] == "2") {echo "selected";}; ?>>Pending</option>
							<option value='3' <?php if ($row["status"] == "3") {echo "selected";}; ?>>Rejected</option>
							<option value='3' <?php if ($row["status"] == "4") {echo "selected";}; ?>>Returned</option>
							</select>
							</td>
							</tr>
							<tr><td colspan=2 align=right><input type=submit value='Save changes'></td></tr>
							</table>
							</form>
				<?php
				};				
		break;
	default:
		// default, display current loan database entries
		$query = $db->getQuery(true);
		$query
		->select('SQL_CALC_FOUND_ROWS *')
		->from($db->quoteName('#__toydatabase_loanlink'))
		->order($db->quoteName('returnbydate') . ' DESC');
		
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
				<!-- New loan button -->
				<form method=post onsubmit="return false">
				<input type=hidden name='loan_act' value='4'>
				<input type=hidden name='tab' value='loan'>
				<table width=100% border=0 cellpadding=0 cellspacing=0>
				<tr align=right><td align=right><input type=button name='newloan' id='newloan' value='Add a new request manually' onclick='self.location="<?=JURI::getInstance()->toString() ?>&tab=loan&loan_act=4"'></td></tr>
				</table>
				</form>
				<!-- END new loan button -->
				
				<table width=85% border=1 cellpadding=0 cellspacing=0 class="hoverTable">
				<tr><td width=10%><B>Loan status</B></td>
				<td width=30%><B>Member name</B></td>
				<td width=30%><B>Toy name</B></td>
				<td width=10%><B>Request loan date</B></td>
				<td width=10%><B>Return due date</B></td>
				<td width=10%><B>Returned date</B></td>
				</tr>
				<?php
				if (!empty($row)) {
					// print_r($row);
					foreach ($row as $row_key=>$row_value) {
						// convert membershipid to their name
						// convert equipmentid to the toy name
						// requestdate to human date
						// returnbydate to human date
						// returndate to human date
						
						// members are complicated. They are joomla users
						// but we also have separate additional info for them in the
						// toydatabase library
						
						$check_member_query = $db->getQuery(true);
						$check_member_query
						->select('*')
						->from($db->quoteName('#__toydatabase_membership'))
						->where($db->quoteName('joomla_userid') . ' = '. $row_value["membershipid"]);
						$db->setQuery((string) $check_member_query);
						$db->execute();
						$membership_count_check= $db->getNumRows();
						$membership_row = $db->loadAssoc();						
						if ($membership_count_check > 0) {
							$membername_val=$membership_row["name"];
						} else {
							$membername_val="ERROR - User not in toydatabase (Joomla only?)";
						};
						
						$check_toy_query = $db->getQuery(true);
						$check_toy_query
						->select('*')
						->from($db->quoteName('#__toydatabase_equipment'))
						->where($db->quoteName('id') . ' = '. $row_value["equipmentid"]);
						$db->setQuery((string) $check_toy_query);
						$db->execute();
						$toyentry_count_check= $db->getNumRows();
						$toyentry_row = $db->loadAssoc();
						if ($toyentry_count_check > 0) {
							$toyequipment_val=$toyentry_row["name"];
						} else {
							$toyequipment_val="ERROR - Toy not in database (deleted?)";
						};
						
						$entry_requestdate=JFactory::getDate($row_value["loandate"]);
						$entry_requestdate_out=JHtml::_('date', $entry_requestdate, 'd/m/Y');
						
						$entry_returnbydate=JFactory::getDate($row_value["returnbydate"]);
						$entry_returnbydate_out=JHtml::_('date', $entry_returnbydate, 'd/m/Y');
						
						if ($row_value["returndate"] == "0000-00-00 00:00:00") {
							$entry_returndate_out="(Not returned)";
						} else {
							$entry_returndate=JFactory::getDate($row_value["returndate"]);
							$entry_returndate_out=JHtml::_('date', $entry_returndate, 'd/m/Y');
						};
						
						// date diff to see if theyre overdue
						$curr_date=JFactory::getDate();
						$overdue_days=($entry_returnbydate->toUnix())-($curr_date->toUnix());
						$overdue_days_output=date("d",$overdue_days);
						if (($overdue_days_output < 0) && ($row_value["returndate"] == "0000-00-00 00:00:00")) {
							$overdue_html_text="(Overdue $overdue_days_output days)";
							$overdue_row_highlighter=1;
						} else {
							$overdue_html_text="";
							$overdue_row_highlighter=0;
						};
						switch($row_value["status"]) {
							case "4":
								$loan_status="Returned";
								$row_lighting="";
							case "3":
								$loan_status="Rejected";
								$row_lighting="blue";
							case "2":
								$loan_status="Pending";
								$row_lighting="yellow";
								break;
							case "1":
								$loan_status="Approved";
								$row_lighting="green";
								break;
							default:
								$loan_status="Unknown";
								$row_lighting="light blue";
								break;
						};
						echo "<tr style='background-color:$row_lighting' onclick='self.location=\"".JURI::getInstance()->toString()."&tab=loan&loan_act=1&ddid=$row_key\"'>";
						echo "<td>".$loan_status."</td>";
						echo "<td>".$membername_val."</td>";
						echo "<td>".$toyequipment_val."</td>";
						echo "<td>".$entry_requestdate_out."</td>";
						echo "<td ";
						if ($overdue_row_highlighter) {echo "bgcolor=red";};
						echo ">".$entry_returnbydate_out." ".$overdue_html_text." </td>";
						echo "<td>".$entry_returndate_out."</td>";
						echo "</tr>\n";
					};
				} else {
					// no rows or toys in database found
					echo "<tr><td colspan=6 align=center><B>Sorry - No loan requests found</B></td></tr>\n";
				};
?>
						</table><form name="adminForm" id="adminForm">
		<input type=hidden name='option' value='com_toydatabase'>
		<input type=hidden name='page' value='requests'>
<?php
				echo $pager->getListFooter();
				echo "Number of loan requests to display per page: ".$pager->getLimitBox()."<BR>\n";
				echo "</form>";
				// end of default: switch
		break;
};
?>