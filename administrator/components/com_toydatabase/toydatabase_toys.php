<?php
// tab=toys
switch($act) {
	case "5":
		if($tab == "toys") {
			// delete toy
			// need to remove all links to this toy first
			//   #__toydatabase_equipment
			//   #__toydatabase_categorylink

			// hmm, should we delete really?
			$del_query = $db->getQuery(true);
			$del_query->delete($db->quoteName('#__toydatabase_categorylink'));
			$del_query->where($db->quoteName('equipmentid') . ' = '. $ddid);
			$db->setQuery($del_query);
			$db->execute();

			$del2_query = $db->getQuery(true);
			$del2_query->delete($db->quoteName('#__toydatabase_equipment'));
			$del2_query->where($db->quoteName('id') . ' = '. $ddid);
			$db->setQuery($del2_query);
			$db->execute();

			JFactory::getApplication()->enqueueMessage("Toy entry has been deleted");
		}; // end if tab
		break;
	case "4":
		// new toy
		if($tab == "toys") {
			?>
                <form method=post name='update_toy'>
				<input type=hidden name='page' value='toys'>
                <input type=hidden name='act' value='2'>
                <input type=hidden name='ddid' value='0'>
                <input type=hidden name='tab' value='toys'>
                <table width=95% border=1 cellpadding=0 cellspacing=0 class="hoverTable">
                <tr>
                        <td valign=top><B>Toy Name :</B></td>
                        <td><input type=text size=30 name='in_toyname' value=''></td>
                </tr>
                <tr>
                        <td valign=top><B>Toy URN :</B></td>
                        <td><input type=text size=30 name='in_toyurn' value=''></td>
                </tr>
                <tr>
                        <td valign=top><B>Toy Image :</B></td>
			<td><input type=text size=30 id='in_toyimage' name='in_toyimage' value=''>
			<a href="#myImgModal" class="btn" data-toggle="modal">Click to select image</a>
			<?php
			$img_modal_params = array();
			$img_modal_params['title'] = 'Image selection';
			$img_modal_params['backdrop'] = "false";
			$img_modal_params['height'] = "400px";
			$img_modal_params['width'] = "570px";
			$img_modal_params['url'] = "index.php?option=com_media&amp;view=images&amp;tmpl=component&amp;e_name=in_toyimage&amp;fieldid=in_toyimage";
			echo JHTML::_('bootstrap.renderModal', 'myImgModal', $img_modal_params);
			?>
			</td>
                </tr>
                <tr>
                        <td valign=top><B>Toy Description :</B></td>
                        <td><?php 
                        echo $editor->display('in_toydescription', '', '100%', '100px', '10', '4',true);
                        ?>
                        </td>
                </tr>
                <tr>
                        <td valign=top><B>Toy Location :</B></td>
                        <td><input type=text size=30 name='in_toylocation' value=''></td>
                </tr>
                <tr>
                        <td valign=top><B>Toy Status :</B></td>
                        <td><select name='in_toystatus'>
                        <option value='3'>DAMAGED/NO LONGER AVAILABLE</option>
                        <option value='2'>AWAITING CLEANING/REPAIR</option>
                        <option value='1'>ON LOAN</option>
                        <option value='0'>AVAILABLE</option>
                        <option value='99'>UNKNOWN</option>
                        </select></td>
                </tr>
                <tr>
                        <td valign=top><B>Toy Category :</B></td>
                        <td><?php 
                        $query_toycategory = $db->getQuery(true);
                        $query_toycategory
                        ->select("*")
                        ->from($db->quoteName('#__toydatabase_equipment_category'));
                        $db->setQuery((string) $query_toycategory);
                        $db->execute();
                        $toycategory_rows = $db->loadAssocList();
                        foreach ($toycategory_rows as $toycategory_output) {
                                echo "<input type=checkbox name='toycat_arr[]' value='".$toycategory_output["category"]."' ";
                                echo ">".$toycategory_output["category"]."<BR>\n";
                        };
                        ?>
                        </td>
                </tr>
                <tr><td colspan=2 align=right><input type=submit value='Save changes'></td></tr>
                </table>
                </form>
<?php
		}; // end if toys
		break;
	case "3":
		// search
		if($tab == "toys") {
		}; // end if tab toys
		break;
	case "2":
		if($tab == "toys") {
		// submit changes or new entry
		// if the ddid=0 then its a new entry, otherwise its an update to the existing ddid(rowid of the toy)
		$frm_in_toyname = $jinput->get('in_toyname', '', 'RAW');
		$frm_in_toyurn = $jinput->get('in_toyurn', '', 'RAW');
		$frm_in_toyimage = $jinput->get('in_toyimage', '', 'RAW');
		$frm_in_toydescription = $jinput->get('in_toydescription', '', 'RAW');
		$frm_in_toylocation = $jinput->get('in_toylocation', '', 'RAW');
		$frm_in_toystatus = $jinput->get('in_toystatus', '', 'RAW');
		$frm_in_toycat_arr = $jinput->get('toycat_arr', array(), 'ARRAY');

		if ($ddid == 0) {
			// new toy entry
			// add the request to the database
				$ins_request = $db->getQuery(true);
				$ins_columns = array('urn', 'name', 'picture', 'description', 'storagelocation','status','active','creationdate','adminuser');
				$ins_values = array($db->quote($frm_in_toyurn),$db->quote($frm_in_toyname),$db->quote($frm_in_toyimage),$db->quote($frm_in_toydescription),$db->quote($frm_in_toylocation),$db->quote($frm_in_toystatus),'1','NOW()',$user->id);
                                        $ins_request
                                        ->insert($db->quoteName('#__toydatabase_equipment'))
                                        ->columns($db->quoteName($ins_columns))
                                        ->values(implode(',', $ins_values));
					try {
	                                        $db->setQuery($ins_request);
        	                                $db->execute();
        	                                // get the inserted ID
        	                                $newtoy_id = $db->insertid();
					}
					catch (RuntimeException $e) {
						JFactory::getApplication()->enqueueMessage($e->getMessage());
						return false;
					};
					if ($newtoy_id) {
						// set category query too
						if (is_array($frm_in_toycat_arr)) {
							foreach ($frm_in_toycat_arr as $toycat_human_val) {
								$ins_cat_request = $db->getQuery(true);
								$ins_cat_columns = array('equipmentid','categoryid');
								// convert toycat_human_val to the ID reference
								$query_catid = $db->getQuery(true);
								$query_catid->select('*')->from($db->quoteName('#__toydatabase_equipment_category'))->where($db->quoteName('category') . ' = "'. $toycat_human_val.'"');
								$db->setQuery((string) $query_catid);
								$db->execute();
								$row = $db->loadAssoc();
								$ins_cat_values = array($newtoy_id,$row['id']);
								$ins_cat_request
								->insert($db->quoteName('#__toydatabase_categorylink'))
								->columns($db->quoteName($ins_cat_columns))
								->values(implode(',', $ins_cat_values));
								$db->setQuery((string) $ins_cat_request);
								$db->execute();
							};
						};
					};
					JFactory::getApplication()->enqueueMessage("Toy (".$frm_in_toyname.") was saved correctly.");
					echo "<BR>\n<a href='".JURI::current()."?option=com_toydatabase&tab=toys'>Return to toy list</a><BR>\n";
		} else {
			// existing toy update
			$upd_request = $db->getQuery(true);
			$upd_fields = array(
					$db->quoteName('urn') . ' = ' . $db->quote($frm_in_toyurn),
					$db->quoteName('name') . ' = ' . $db->quote($frm_in_toyname),
					$db->quoteName('picture') . ' = ' . $db->quote($frm_in_toyimage),
					$db->quoteName('description') . ' = ' . $db->quote($frm_in_toydescription),
					$db->quoteName('storagelocation') . ' = ' . $db->quote($frm_in_toylocation),
					$db->quoteName('status') . ' = ' . $db->quote($frm_in_toystatus),
					$db->quoteName('adminuser') . ' = ' . $db->quote($user->id)
			);
			$upd_request->update($db->quoteName('#__toydatabase_equipment'))->set($upd_fields)->where($db->quoteName('id') . ' = '. $ddid);
			try {
				$db->setQuery($upd_request);
				$db->execute();
				}
				catch (RuntimeException $e) {
					JFactory::getApplication()->enqueueMessage($e->getMessage());
					return false;
				};
			// category updates is trickyer
			// delete all existing and then let it re-add them is simplest
			$del_cat_query = $db->getQuery(true);
			$del_conditions = array(
						$db->quoteName('equipmentid') . ' = '.$ddid
			);
			$del_cat_query->delete($db->quoteName('#__toydatabase_categorylink'));
			$del_cat_query->where($del_conditions);
			$db->setQuery($del_cat_query);
			$del_result = $db->execute();

				if (is_array($frm_in_toycat_arr)) {
					foreach ($frm_in_toycat_arr as $toycat_human_val) {
						$query_catid = $db->getQuery(true);
						$query_catid->select('*')->from($db->quoteName('#__toydatabase_equipment_category'))->where($db->quoteName('category') . ' = "'. $toycat_human_val.'"');
						$db->setQuery((string) $query_catid);
						$db->execute();
						$row = $db->loadAssoc();
						
						$check_cat_query = $db->getQuery(true);
						$check_cat_query
						->select('id')
						->from($db->quoteName('#__toydatabase_categorylink'))
						->where($db->quoteName('equipmentid') . ' = '. $ddid, 'AND')
						->where($db->quoteName('categoryid') . ' = "'. $row['id'] .'"');
						$db->setQuery((string) $check_cat_query);
						$db->execute();
						$row_count_check= $db->getNumRows();
						if ($row_count_check == 0) {
							//no exist, so add it
							$ins_cat_request = $db->getQuery(true);
							$ins_cat_columns = array('equipmentid','categoryid');
							$ins_cat_values = array($ddid,$row['id']);
							$ins_cat_request
							->insert($db->quoteName('#__toydatabase_categorylink'))
							->columns($db->quoteName($ins_cat_columns))
							->values(implode(',', $ins_cat_values));
							try {
								$db->setQuery((string) $ins_cat_request);
								$db->execute();
							}
							catch (RuntimeException $e) {
								JFactory::getApplication()->enqueueMessage("Error on equip_cat insert ".$e->getMessage());
								return false;
							};
						};
					};
				};
			JFactory::getApplication()->enqueueMessage("Updated toy entry");
			
		}; // end of if ddid
		}; // end of if tab toys
		break;
	case "1":
		// retrieve the specific record
		if($tab == "toys") {
		$query = $db->getQuery(true);
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
		->where($db->quoteName('equipmentid') . ' = '. $ddid, 'AND')
		->where($db->quoteName('status') . ' = '. '1');
		$db->setQuery((string) $query_loanlink);
		$db->execute();
		$loanlink_rows = $db->loadAssoc();
		
		?>
		<form method=post name='update_toy'>
		<input type=hidden name='page' value='toys'>
		<input type=hidden name='act' value='2'>
		<input type=hidden name='ddid' value='<?=$ddid?>'>
		<input type=hidden name='tab' value='toys'>
		<table width=95% border=1 cellpadding=0 cellspacing=0 class="hoverTable">
		<tr>
			<td valign=top><B>Toy Name :</B></td>
			<td><input type=text size=30 name='in_toyname' value='<?=$row["name"]?>'></td>
		</tr>
		<tr>
			<td valign=top><B>Toy URN :</B></td>
			<td><input type=text size=30 name='in_toyurn' value='<?=$row["urn"]?>'></td>
		</tr>
		<tr>
			<td valign=top><B>Toy Image :</B></td>
			<td><input type=text size=30 id='in_toyimage' name='in_toyimage' value='<?=$row["picture"]?>'>
<!-- 		<a class="modal-button" rel="{handler: 'iframe', size: {x: 570, y: 400}}" href="index.php?option=com_media&view=images&tmpl=component&e_name=in_toyimage" title="Image">Image</a> -->
			<a href="#myImgModal" class="btn" data-toggle="modal">Click to select image</a>
			<?php
			$img_modal_params = array();
			$img_modal_params['title'] = 'Image selection';
			$img_modal_params['backdrop'] = "false";
			$img_modal_params['height'] = "400px";
			$img_modal_params['width'] = "570px";
			$img_modal_params['url'] = "index.php?option=com_media&amp;view=images&amp;tmpl=component&amp;e_name=in_toyimage&amp;fieldid=in_toyimage";
			echo JHTML::_('bootstrap.renderModal', 'myImgModal', $img_modal_params);
			?> 
			</td>
		</tr>
		<tr>
			<td valign=top><B>Toy Description :</B></td>
			<td><?php 
			echo $editor->display('in_toydescription', $row["description"], '100%', '100px', '10', '4',true);			
			?>
			</td>
		</tr>
		<tr>
			<td valign=top><B>Toy Location :</B></td>
			<td><input type=text size=30 name='in_toylocation' value='<?=$row["storagelocation"]?>'></td>
		</tr>
		<tr>
			<td valign=top><B>Toy Status :</B></td>
			<td><select name='in_toystatus'>
			<option value='3' <?php if($row["status"] == 3) {echo "selected";}; ?>>DAMAGED/NO LONGER AVAILABLE</option>
			<option value='2' <?php if($row["status"] == 2) {echo "selected";}; ?>>AWAITING CLEANING/REPAIR</option>
			<option value='1' <?php if($row["status"] == 1) {echo "selected";}; ?>>ON LOAN</option>
			<option value='0' <?php if($row["status"] == 0) {echo "selected";}; ?>>AVAILABLE</option>
			<option value='99' <?php if($row["status"] == 99) {echo "selected";}; ?>>UNKNOWN</option>
			</select></td>
		</tr>
		<tr>
			<td valign=top><B>Toy Category :</B></td>
			<td><?php 
			$query_toycategory = $db->getQuery(true);
			$query_toycategory
			->select("*")
			->from($db->quoteName('#__toydatabase_equipment_category'));
			$db->setQuery((string) $query_toycategory);
			$db->execute();
			$toycategory_rows = $db->loadAssocList();
			$toycat_maxid=0;
			foreach ($toycategory_rows as $toycategory_output) {
				echo "<input type=checkbox name='toycat_arr[]' value='".$toycategory_output["category"]."' ";
//				if ($toycategory_output["id"] == $category_rows[0]["categoryid"]) {echo "checked";};
				if (array_search($toycategory_output["id"], array_column($category_rows, 'categoryid')) !== false) {echo "checked";};
				echo ">".$toycategory_output["category"]."<BR>\n";
			};
			?>
			</td>
		</tr>
		<tr>
			<td valign=top><B>Toy Loan state :<BR>(Non-edit, go to Approve/View requests tab)</B></td>
			<td><select name='in_toyloanstate' disabled>
			<option name='0' <?php if ($loanlink_rows["status"] == "0") {echo "selected";}; ?>>AVAILABLE</option>
			<option name='2' <?php if ($loanlink_rows["status"] == "2") {echo "selected";}; ?>>AWAITING LOAN REQUEST</option>
			<option name='1' <?php if ($loanlink_rows["status"] == "1") {echo "selected";}; ?>>ON LOAN</option>
			</select>
			</td>
		</tr>
		<tr>
			<td valign=top><B>Toy Due Return Date :</B></td>
			<td><?=JHTML::_('calendar', $loanlink_rows["returnbydate"], "in_toyreturndate" , "in_toyreturndate", '%Y-%m-%d'); ?></td>
		</tr>
		<tr><td colspan=2 align=right><input type=submit value='Save changes'></td></tr>
		<tr><td colspan=2 align=right><input type=button value='Delete Toy' onclick="Javascript:if(confirm('Are you sure, this is permenantly deleting this toy?')) {self.location='<?=JURI::current()?>?option=com_toydatabase&page=toys&tab=toys&act=5&ddid=<?=$ddid?>';};"></td></tr>
		</table>
		</form>
		<?php
		}; // end of if tab toys
		break;
	default:
		$query = $db->getQuery(true);
		$query
		->select('SQL_CALC_FOUND_ROWS *')
		->from($db->quoteName('#__toydatabase_equipment'))
		//->join('INNER', $db->quoteName('#__toydatabase_equipment_category', 'b') . ' ON (' . $db->quoteName('a.categoryid') . ' = ' . $db->quoteName('b.id') . ')')
		//->where($db->quoteName('status') . ' = '. $db->quote('1'))
		->order($db->quoteName('name') . ' ASC');
		
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
		<tr align=right><td align=right><input type=button name='printpage' id='printpage' value='Print Toys' onclick='window.open("<?=JURI::root()?>/administrator/components/com_toydatabase/pdf_output.php?disp=toys");'></td></tr>
		</table>
		</form>
		<!-- end print button -->
		
		<!-- Toy database search -->
		<form method=post name='toy_search' id='toy_search' onsubmit="return false">
		<input type=hidden name='page' value='toys'>
		<input type=hidden name='act' value='3'>
		<input type=hidden name='tab' value='toys'>
		<table width=100% border=0 cellpadding=0 cellspacing=0>
		<tr align=right><td align=right>Search toy library:</td><td width=230><input type=text size=20 onkeyup = "showResult(this.value)"><div id = "livesearch"></div></td></tr>
		</table>
		</form>
		<!-- END Toy database search -->

		<!-- New toy button -->
                <form method=post onsubmit="return false" name='toy_new' id='toy_new'>
				<input type=hidden name='page' value='toys'>        
                <input type=hidden name='act' value='4'>
                <table width=100% border=0 cellpadding=0 cellspacing=0>
                <tr align=right><td align=right><input type=button name='newtoy' id='newtoy' value='Add a new toy' onclick='self.location="<?=JURI::getInstance()->toString() ?>&tab=toys&act=4"'></td></tr>
                </table>
                </form>
		<!-- END new toy button -->
		
		<table width=85% border=1 cellpadding=0 cellspacing=0 class="hoverTable">
		<tr><td width=30%><B>Toy name</B></td>
		<td width=30%><B>Toy category</B></td>
		<td width=30%><B>Toy Photo (small)</B></td>
		<td width=10%><B>Status</B></td></tr>
		<?php 
		if (!empty($row)) {
			// print_r($row);
			foreach ($row as $row_key=>$row_value) {
				echo "<tr onclick='self.location=\"".JURI::getInstance()->toString()."&page=toys&tab=toys&act=1&ddid=$row_key\"'>";
				echo "<td>".$row_value["name"]."</td>\n";
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
				if (is_file(JPATH_BASE."/../".$row_value["picture"])) {
					// dynamically resize image using php
					echo "<img src='".JURI::root()."/components/com_toydatabase/toydatabase_thumbnailer.php?img=".$row_value["picture"]."' alt='".$row_value["picture"]."'>";
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
?>
		</table><form name="adminForm" id="adminForm">
		<input type=hidden name='option' value='com_toydatabase'>
		<input type=hidden name='page' value='toys'>
		<?php
			echo $pager->getListFooter();
			echo "Number of toys to display per page: ".$pager->getLimitBox()."<BR>\n";
			echo "</form>";
		} else {
			// no rows or toys in database found
			echo "<tr><td colspan=4 align=center><B>Sorry - No items found</B></td></tr>\n";
			echo "</table><BR>\n";
		};
			// end of default: switch
			break;
}; // enc of switch selecting act
?>
