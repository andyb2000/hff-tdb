<?php

switch($cat_act) {
	case "5":
		// delete record
		if($tab == "category") {
			// delete category
			// hmm, should we delete really?
			$del_query = $db->getQuery(true);
			$del_query->delete($db->quoteName('#__toydatabase_equipment_category'));
			$del_query->where($db->quoteName('id') . ' = '. $ddid);
			$db->setQuery($del_query);
			$db->execute();

			JFactory::getApplication()->enqueueMessage("Toy category has been deleted");
		}; // end if tab
		break;
	case "4":
		// new category
		if($tab == "category") {
			?>
		                <form method=post name='update_category'>
		                <input type=hidden name='cat_act' value='2'>
		                <input type=hidden name='ddid' value='0'>
		                <input type=hidden name='tab' value='category'>
		                <table width=95% border=1 cellpadding=0 cellspacing=0 class="hoverTable">
		                <tr>
		                        <td valign=top><B>Category Name :</B></td>
		                        <td><input type=text size=30 name='in_categoryname' value=''></td>
		                </tr>
		                <tr><td colspan=2 align=right><input type=submit value='Save changes'></td></tr>
		                </table>
		                </form>
<?php
		}; // end if category
		break;
	case "2":
		// update record
		if($tab == "category") {
			// submit changes or new entry
			// if the ddid=0 then its a new entry, otherwise its an update to the existing ddid(rowid of the toy)
			$frm_in_category = $jinput->get('in_categoryname', '', 'RAW');
	
			if ($ddid == 0) {
				// new category
				// add the request to the database
				$ins_request = $db->getQuery(true);
				$ins_columns = array('category');
				$ins_values = array($db->quote($frm_in_category));
				$ins_request
				->insert($db->quoteName('#__toydatabase_equipment_category'))
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
				JFactory::getApplication()->enqueueMessage("Category (".$frm_in_category.") was saved correctly.");
				echo "<BR>\n<a href='".JURI::current()."?option=com_toydatabase&tab=category'>Return to toy categories</a><BR>\n";
			} else {
				// existing toy update
				$upd_request = $db->getQuery(true);
				$upd_fields = array(
						$db->quoteName('category') . ' = ' . $db->quote($frm_in_category)
				);
				$upd_request->update($db->quoteName('#__toydatabase_equipment_category'))->set($upd_fields)->where($db->quoteName('id') . ' = '. $ddid);
				try {
					$db->setQuery($upd_request);
					$db->execute();
				}
				catch (RuntimeException $e) {
					JFactory::getApplication()->enqueueMessage($e->getMessage());
					return false;
				};
				JFactory::getApplication()->enqueueMessage("Updated category entry");
			}; // end of if ddid
		}; // end of if tab category
		break;
	case "1":
		// retrieve the specific record
		if($tab == "category") {
			$query = $db->getQuery(true);
			$query
			->select('*')
			->from($db->quoteName('#__toydatabase_equipment_category'))
			->where($db->quoteName('id') . ' = '. $ddid);
			$db->setQuery((string) $query);
			$db->execute();
			$row = $db->loadAssoc();
?>
			<form method=post name='update_category'>
			<input type=hidden name='cat_act' value='2'>
			<input type=hidden name='ddid' value='<?=$ddid?>'>
			<input type=hidden name='tab' value='category'>
			<table width=95% border=1 cellpadding=0 cellspacing=0 class="hoverTable">
			<tr>
			<td valign=top><B>Category Name :</B></td>
			<td><input type=text size=30 name='in_categoryname' value='<?=$row["category"]?>'></td>
			</tr>
			<tr><td colspan=2 align=right><input type=submit value='Save changes'></td></tr>
			<tr><td colspan=2 align=right><input type=button value='Delete Category' onclick="Javascript:if(confirm('Are you sure, this is permenantly deleting this category?')) {self.location='<?=JURI::current()?>?option=com_toydatabase&tab=category&cat_act=5&ddid=<?=$ddid?>';};"></td></tr>
			</table>
			</form>
<?php
		}; // end if tab category
		break;
	default:
		$query = $db->getQuery(true);
		$query
		->select('SQL_CALC_FOUND_ROWS *')
		->from($db->quoteName('#__toydatabase_equipment_category'))
		->order($db->quoteName('category') . ' ASC');
		
		$app = JFactory::getApplication();
		$category_limit = $app->getUserStateFromRequest("$option.category_limit", 'category_limit', 25, 'int');
		$category_limitstart = JFactory::getApplication()->input->get('category_limitstart', 0, 'INT');
		
		$db->setQuery($query,$limitstart, $limit);
		$row = $db->loadAssocList('id');
		if(!empty($row)){
			$db->setQuery('SELECT FOUND_ROWS();');
			$num_rows=$db->loadResult();
			jimport('joomla.html.pagination');
			$pager=new JPagination($num_rows, $category_limitstart, $category_limit);
		};
?>
		<!-- Print/PDF button -->
		<?php 
		echo JHTML::_('image.site',  'printButton.png', '/images/M_images/', NULL, NULL, JText::_( 'Print' ) );
		?>
		<!-- end print button -->
		
		<!-- New category button -->
		<form method=post onsubmit="return false">
		<input type=hidden name='cat_act' value='4'>
		<input type=hidden name='tab' value='category'>
		<table width=100% border=0 cellpadding=0 cellspacing=0>
		<tr align=right><td align=right><input type=button name='newcategory' id='newcategory' value='Add a new category' onclick='self.location="<?=JURI::getInstance()->toString() ?>&tab=category&cat_act=4"'></td></tr>
		</table>
		</form>
		<!-- END new category button -->
		
		<table width=85% border=1 cellpadding=0 cellspacing=0 class="hoverTable">
		<tr><td width=30%><B>Category name</B></td></tr>
		<?php
		if (!empty($row)) {
			// print_r($row);
			foreach ($row as $row_key=>$row_value) {
				echo "<tr onclick='self.location=\"".JURI::getInstance()->toString()."&tab=category&cat_act=1&ddid=$row_key\"'>";
				echo "<td>".$row_value["category"]."</td></tr>\n";
			};
		} else {
			// no rows or toys in database found
			echo "<tr><td colspan=1 align=center><B>Sorry - No categories found</B></td></tr>\n";
		};
?>
				</table><form name="adminForm" id="adminForm">
		<input type=hidden name='option' value='com_toydatabase'>
		<input type=hidden name='page' value='categories'>
<?php
		echo $pager->getListFooter();
		echo "Number of categories to display per page: ".$pager->getLimitBox()."<BR>\n";
		echo "</form>";
		// end of default: switch
		break;
};
?>