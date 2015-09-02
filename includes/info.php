	<?php $EgoiMailListBuilder = get_option('EgoiMailListBuilderObject'); ?>
	<div class='wrap'>
		<div id="icon-egoi-mail-list-builder-info" class="icon32"></div>
		<h2>Info</h2>
		<?php require('donate.php'); ?>
		<?php if($EgoiMailListBuilder->isAuthed())	{
			$result = $EgoiMailListBuilder->getClient();
			update_option('EgoiMailListBuilderObject',$EgoiMailListBuilder);
			egoi_mail_list_builder_admin_notices();
		?>
		<h3>Connection successful!</h3><br>
        <h4>You're almost there! To add an E-goi form to your site, just go to the Wordpress "Appearance" menu. Then click "Widgets", drag the E-goi Mailing List Builder widget into "Main Sidebar" or one of the frontpage areas and save your changes. That's all there is to it!<br><br>Your E-goi account information follows below:</h4>
		<form name='egoi_mail_list_builder_apikey_form' method='post' action='<?php echo $_SERVER['REQUEST_URI']; ?>'>
		<table class="form-table">
		<tr>
			<th>
				<label for="egoi_mail_list_builder_apikey">Api Key</label>
			</th>
			<td>
				<?php echo $EgoiMailListBuilder->api_key; ?>
			</td>
		</tr>
		<tr>
			<th>
				<label for="egoi_mail_list_builder_clientid">Client ID</label>
			</th>
			<td>
				<?php echo $result['CLIENTE_ID']; ?>
			</td>
		</tr>
		<tr>
			<th>
				<label for="egoi_mail_list_builder_companyname">Company Name</label>
			</th>
			<td>
				<?php echo $result['COMPANY_NAME']; ?>
			</td>
		</tr>
		<tr>
			<th>
				<label for="egoi_mail_list_builder_companylegalname">Company Legal Name</label>
			</th>
			<td>
				<?php echo $result['COMPANY_LEGAL_NAME']; ?>
			</td>
		</tr>
		<tr>
			<th>
				<label for="egoi_mail_list_builder_companytype">Company Type</label>
			</th>
			<td>
				<?php echo $result['COMPANY_TYPE']; ?>
			</td>
		</tr>
		<tr>
			<th>
				<label for="egoi_mail_list_builder_businessactivitycode">Business Activity Code</label>
			</th>
			<td>
				<?php echo $result['BUSINESS_ACTIVITY_CODE']; ?>
			</td>
		</tr>
		<tr>
			<th>
				<label for="egoi_mail_list_builder_dateregistration">Date Registration</label>
			</th>
			<td>
				<?php echo $result['DATE_REGISTRATION']; ?>
			</td>
		</tr>
		<tr>
			<th>
				<label for="egoi_mail_list_builder_country">Country</label>
			</th>
			<td>
				<?php echo $result['COUNTRY']; ?>
			</td>
		</tr>
		<tr>
			<th>
				<label for="egoi_mail_list_builder_apikey">State</label>
			</th>
			<td>
				<?php echo $result['STATE']; ?>
			</td>
		</tr>
		<tr>
			<th>
				<label for="egoi_mail_list_builder_city">City</label>
			</th>
			<td>
				<?php echo $result['CITY']; ?>
			</td>
		</tr>
		<tr>
			<th>
				<label for="egoi_mail_list_builder_address">Address</label>
			</th>
			<td>
				<?php echo $result['ADDRESS']; ?>
			</td>
		</tr>
		<tr>
			<th>
				<label for="egoi_mail_list_builder_website">Website</label>
			</th>
			<td>
				<?php echo $result['WEBSITE']; ?>
			</td>
		</tr>
		<tr>
			<th>
				<label for="egoi_mail_list_builder_signupdate">Signup Date</label>
			</th>
			<td>
				<?php echo $result['SIGNUP_DATE']; ?>
			</td>
		</tr>
		<tr>
			<th>
				<label for="egoi_mail_list_builder_credits">Credits</label>
			</th>
			<td>
				<?php echo $result['CREDITS']; ?>
			</td>
		</tr>
		<tr>
			<th>
				<input type="submit" class='button-primary' name="egoi_mail_list_builder_logout" id="egoi_mail_list_builder_logout" value="Disconnect" />	
			</th>
		</tr>
		</table>
		</form>
	<?php 
		} 
	else {
	?>
		<h3>Enter the API key of your E-goi account</h3>
		<form name='egoi_mail_list_builder_apikey_form' method='post' action='<?php echo $_SERVER['REQUEST_URI']; ?>'>
		<table class="form-table">
		<tr>
			<th>
				<label for="egoi_mail_list_builder_apikey_text">Your API key</label>
			</th>
			<td>
				<input type='text' size='60' name='egoi_mail_list_builder_apikey_text' />
				<p>Don't forget when you activate your API Key to associate a List</p>
			</td>
		</tr>
		<tr>
			<th>
				<input type="submit" class='button-primary' name="egoi_mail_list_builder_login" id="egoi_mail_list_builder_login" value="Connect" />
			</th>
		</tr>
		</table>
		</form>
		<h4>Don't have an E-goi account? E-goi is an email marketing service which is free for up to 500 subscribed contacts! <a href="<?php echo EGOI_MAIL_LIST_BUILDER_AFFILIATE; ?>" target="_blank">Click here to create your account!</a> (takes less than 1 minute)</h4>
		<h4>To get your API key, <a href="http://bo.e-goi.com/?action=login" target="_blank">Login</a></h4>

<iframe width="600" height="400" src="https://www.youtube.com/embed/zJr_XshUHYY" frameborder="0" allowfullscreen></iframe>
	<?php } ?>
	</div>