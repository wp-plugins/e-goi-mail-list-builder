	<?php $EgoiMailListBuilder = get_option('EgoiMailListBuilderObject'); ?>
	<div class='wrap'>
	<div id="icon-egoi-mail-list-builder-settings" class="icon32"></div>
	<h2>Settings</h2>
	<?php require('donate.php'); ?>
	<?php if($EgoiMailListBuilder->isAuthed())	{
		if(isset($_POST['egoi_mail_list_builder_settings_save'])) {
			$EgoiMailListBuilder->subscribe_enable = (isset($_POST['egoi_mail_list_builder_settings_comments'])) ? true : false;
			$EgoiMailListBuilder->subscribe_text = $_POST['egoi_mail_list_builder_settings_text'];
			$EgoiMailListBuilder->subscribe_list = $_POST['egoi_mail_list_builder_settings_list'];

			update_option('EgoiMailListBuilderObject',$EgoiMailListBuilder);
		}
		egoi_mail_list_builder_admin_notices();
	?>
	<h3>Comment Section</h3>
	<form name='egoi_mail_list_builder_settings_form' method='post' action='<?php echo $_SERVER['REQUEST_URI']; ?>'>
	<table class="form-table">
		<tr>
			<th>
				<label for="egoi_mail_list_builder_settings_comments">Subscribe in Comments Section</label>
			</th>
			<td>
				<input type='checkbox' size='60' name='egoi_mail_list_builder_settings_comments' <?php if($EgoiMailListBuilder->subscribe_enable) echo "checked";?>/>
			</td>
		</tr>
		<tr>
			<th>
				<label for="egoi_mail_list_builder_settings_text">Text to Display</label>
			</th>
			<td>
				<input type='text' size='60' name='egoi_mail_list_builder_settings_text'  value='<?php echo $EgoiMailListBuilder->subscribe_text; ?>'/>
			</td>
		</tr>
		<tr>
			<th>
				<label for="egoi_mail_list_builder_settings_list">List</label>
			</th>
			<td>
				<select name='egoi_mail_list_builder_settings_list'>
					<?php
					$result = $EgoiMailListBuilder->getLists();
					for($x = 0;$x < count($result); $x++) {	?>
						<option value='<?php echo $result[$x]['listnum']; ?>' <?php if($result[$x]['listnum'] == $EgoiMailListBuilder->subscribe_list){ echo "selected"; } ?>><?php echo $result[$x]['title']; ?></option>
					<?php }	?>
				</select>
			</td>
		</tr>
		<tr>
			<th>
				<input type="submit" class='button-primary' name="egoi_mail_list_builder_settings_save" id="egoi_mail_list_builder_settings_save" value="Save" />	
			</th>
		</tr>
	</table>
	</form>
	<?php }	?>