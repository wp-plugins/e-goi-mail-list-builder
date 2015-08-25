<?php/** * Admin functions**/add_action('admin_menu', 'egoi_mail_list_builder_auth',1);add_action('admin_menu', 'egoi_mail_list_builder_login_logout',3);add_action('admin_menu', 'egoi_mail_list_builder_admin_menu_setup',5);/** * Register menu items**/function egoi_mail_list_builder_admin_menu_setup() {	$page_title = 'E-goi Mail List Builder';	$menu_title = 'E-goi Mail List Builder';	$capability = 'manage_options';	$menu_slug = 'egoi-mail-list-builder-info';	$function = 'egoi_mail_list_builder_info';	add_menu_page($page_title, $menu_title, $capability, $menu_slug, $function);		$EgoiMailListBuilder = get_option('EgoiMailListBuilderObject');	if($EgoiMailListBuilder->isAuthed()) {		$page_title = 'Info';		$sub_menu_title = 'Info';		add_submenu_page($menu_slug, $page_title, $sub_menu_title, $capability, $menu_slug, $function);				$submenu_page_title = 'Lists';		$submenu_title = 'Lists';		$submenu_slug = 'egoi-mail-list-builder-lists';		$submenu_function = 'egoi_mail_list_builder_lists';		add_submenu_page($menu_slug, $submenu_page_title, $submenu_title, $capability, $submenu_slug, $submenu_function);		$submenu_page_title = 'Settings';		$submenu_title = 'Settings';		$submenu_slug = 'egoi-mail-list-builder-settings';		$submenu_function = 'egoi_mail_list_builder_settings';		add_submenu_page($menu_slug, $submenu_page_title, $submenu_title, $capability, $submenu_slug, $submenu_function);		$submenu_page_title = 'Widget Settings';		$submenu_title = 'Widget Settings';		$submenu_slug = 'egoi-mail-list-builder-widget-settings';		$submenu_function = 'egoi_mail_list_builder_widget_settings';		add_submenu_page($menu_slug, $submenu_page_title, $submenu_title, $capability, $submenu_slug, $submenu_function);	}} function egoi_mail_list_builder_info() {    if (!current_user_can('manage_options')) {        wp_die('You do not have sufficient permissions to access this page.');    }	else {		require(EGOI_MAIL_LIST_BUILDER_DIR.'includes/info.php');	}}function egoi_mail_list_builder_lists() {    if (!current_user_can('manage_options')) {        wp_die('You do not have sufficient permissions to access this page.');    }	else {		require(EGOI_MAIL_LIST_BUILDER_DIR.'includes/lists.php');	}}function egoi_mail_list_builder_settings() {    if (!current_user_can('manage_options')) {        wp_die('You do not have sufficient permissions to access this page.');    }	else {		require(EGOI_MAIL_LIST_BUILDER_DIR.'includes/settings.php');	}}function egoi_mail_list_builder_widget_settings() {    if (!current_user_can('manage_options')) {        wp_die('You do not have sufficient permissions to access this page.');    }	else {		require(EGOI_MAIL_LIST_BUILDER_DIR.'includes/widget_settings.php');	}}/** * Add Egoi Mail List Builder Class to Options**/function egoi_mail_list_builder_auth() {	if(!get_option('EgoiMailListBuilderObject')) {		$EgoiMailListBuilder = new EgoiMailListBuilder('');		add_option('EgoiMailListBuilderObject',$EgoiMailListBuilder);	}}/** * Check if user is logging in**/function egoi_mail_list_builder_login_logout() {	if(isset($_POST['egoi_mail_list_builder_logout']))	{		$EgoiMailListBuilder = get_option('EgoiMailListBuilderObject');		$EgoiMailListBuilder = new EgoiMailListBuilder('',true);		update_option('EgoiMailListBuilderObject',$EgoiMailListBuilder);	}	else if(isset($_POST['egoi_mail_list_builder_login']))	{		$EgoiMailListBuilder = get_option('EgoiMailListBuilderObject');		if(isset($_POST['egoi_mail_list_builder_apikey_text']) && !empty($_POST['egoi_mail_list_builder_apikey_text'])) {			$EgoiMailListBuilder = new EgoiMailListBuilder($_POST['egoi_mail_list_builder_apikey_text']);		}		update_option('EgoiMailListBuilderObject',$EgoiMailListBuilder);	}}function egoi_mail_list_builder_admin_notices() {	if(get_option('EgoiMailListBuilderObject')) {		$EgoiMailListBuilder = get_option('EgoiMailListBuilderObject');	 	$screen_id = get_current_screen()->id;	 	if ((	 		$screen_id == 'toplevel_page_egoi-mail-list-builder-info' || 	 		$screen_id == 'e-goi-mail-list-builder_page_egoi-mail-list-builder-lists' ||	 		$screen_id == 'e-goi-mail-list-builder_page_egoi-mail-list-builder-settings' ||	 		$screen_id == 'e-goi-mail-list-builder_page_egoi-mail-list-builder-widget-settings'	 		) 	 		&& $EgoiMailListBuilder->exists) {	 		if($EgoiMailListBuilder->error == "NO_USERNAME_AND_PASSWORD_AND_APIKEY"){	 			printf('<div class="updated"><p>'.$EgoiMailListBuilder->description.'</p></div>');	 		}	 		else{	    		printf('<div class="error"><p>'.$EgoiMailListBuilder->description.'</p></div>');	    	}	    	$EgoiMailListBuilder->exists = false;	    	$EgoiMailListBuilder->description = "";	    	$EgoiMailListBuilder->error = "";	    	update_option('EgoiMailListBuilderObject',$EgoiMailListBuilder);	 	} 	} 	// Notice about new update!! 	/*if ((	 		$screen_id == 'toplevel_page_egoi-mail-list-builder-info' || 	 		$screen_id == 'e-goi-mail-list-builder_page_egoi-mail-list-builder-lists' ||	 		$screen_id == 'e-goi-mail-list-builder_page_egoi-mail-list-builder-settings' ||	 		$screen_id == 'e-goi-mail-list-builder_page_egoi-mail-list-builder-widget-settings'	 		) && egoi_mail_list_builder_check_update_version()) {    	printf( '<div class="updated">     		<p> A <strong>new version</strong> has been released! Click <strong><a href="'.egoi_mail_list_builder_download_update_version().'">here</a></strong> to update!<br /> Feel free to support the development of this plugin! (hint: you can buy us a beer!) </p> </div>'); 	}*/}add_action( 'admin_notices', 'egoi_mail_list_builder_admin_notices' ); function egoi_mail_list_builder_check_update_version(){	$payload = array(	  'action' => 'plugin_information',	  'request' => serialize(	    (object)array(	        'slug' => 'egoi-mail-list-builder',	        'fields' => array('description' => true)	     )	   )	);	$body = wp_remote_post( 'http://api.wordpress.org/plugins/info/1.0/', array( 'body' => $payload) );	if (version_compare(EGOI_MAIL_LIST_BUILDER_VERSION, unserialize($body['body'])->version, '<')) {        return true;    }	return false;}function egoi_mail_list_builder_download_update_version(){	$payload = array(	  'action' => 'plugin_information',	  'request' => serialize(	    (object)array(	        'slug' => 'egoi-mail-list-builder',	        'fields' => array('description' => true)	     )	   )	);	$body = wp_remote_post( 'http://api.wordpress.org/plugins/info/1.0/', array( 'body' => $payload) );	return unserialize($body['body'])->download_link;}?>