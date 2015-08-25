<?php
/**
 * Egoi Mail List Builder Widget Class
**/
class EgoiMailListBuilderWidget extends WP_Widget {
	
	private $egoiMailListBuilderErrorCodes = array();

	private $egoiMailListBuilderID;

	function __construct() {
		require_once(EGOI_MAIL_LIST_BUILDER_DIR.'includes/error_codes.php');
		$this->egoiMailListBuilderErrorCodes = $errorCodes;

		$widget_ops = array(
			'classname' => 'EgoiMailListBuilderWidget',
			'description' => 'Egoi Mail List Builder Populator'
		);
		$this->WP_Widget(false, $name = 'Egoi Mail List Builder Widget', $widget_ops);
		wp_enqueue_script('jquery');
	}
	
	function widget($args, $instance) {
		$EgoiMailListBuilder = get_option('EgoiMailListBuilderObject');

		extract( $args );
		$widgetid = $args['widget_id'];
		$this->egoiMailListBuilderID = $widgetid;
		
		$title = apply_filters('widget_title', $instance['title']);
		$fname = $instance['fname'];
		$lname = $instance['lname'];
		$email = $instance['email'];
		$mobile = $instance['mobile'];
		$language = $instance['language'];
		$bdate = $instance['bdate'];
		$list = $instance['list'];
		
		echo $before_widget;
		
		if ( $title ) {
			echo $before_title . $title . $after_title;
		}
		?>
		<script type="text/javascript">
			jQuery(document).ready(function($){
				event.preventDefault();
				$("#egoi-mail-list-builder-submit-sub<?php echo $this->egoiMailListBuilderID; ?>").click(function() {  
					$(".error<?php echo $this->egoiMailListBuilderID; ?>").empty();
					$.ajax({
						type : "POST",
						url : "index.php",
						data : { egoi_mail_list_builder_subscribe      : "submited",
									widget_postfname : $("input#egoi-mail-list-builder-fname-sub<?php echo $this->egoiMailListBuilderID; ?>").val(),
									widget_postlname : $("input#egoi-mail-list-builder-lname-sub<?php echo $this->egoiMailListBuilderID; ?>").val(),
									widget_postemail : $("input#egoi-mail-list-builder-email-sub<?php echo $this->egoiMailListBuilderID; ?>").val(),
									widget_postmobile : $("input#egoi-mail-list-builder-mobile-sub<?php echo $this->egoiMailListBuilderID; ?>").val(),
									widget_postlanguage : $("select#egoi-mail-list-builder-language-sub<?php echo $this->egoiMailListBuilderID; ?>").val(),
									widget_postbdate : $("input#egoi-mail-list-builder-bdate-sub<?php echo $this->egoiMailListBuilderID; ?>").val(),
									widget_postlist : $("input#egoi-mail-list-builder-list-sub<?php echo $this->egoiMailListBuilderID; ?>").val(),
									widget_postid : $("input#egoi-mail-list-builder-id-sub<?php echo $this->egoiMailListBuilderID; ?>").val()
						},
						success : function(response) {
							// The server has finished executing PHP and has returned something,
							// so display it!
							$("#<?php echo $widgetid; ?>").append(response);
						}
					});
					return false;
				});
			});
		</script>
		<?php
		
		echo "<form name='egoi-mail-list-builder-widget-form".$this->egoiMailListBuilderID."' id='egoi-mail-list-builder-widget-form".$this->egoiMailListBuilderID."' action='' method='post'>";
		if ( $fname ) {
			echo "<label>".$EgoiMailListBuilder->FIRST_NAME."</label>";
			if($EgoiMailListBuilder->FIRST_NAME_F) echo "<label style='color:red;'>*</label>";
			echo "<div class='widget-text'><input type='text' name='egoi-mail-list-builder-fname-sub".$this->egoiMailListBuilderID."' id='egoi-mail-list-builder-fname-sub".$this->egoiMailListBuilderID."' /></div>";
		}
		if ( $lname ) {
			echo "<label>".$EgoiMailListBuilder->LAST_NAME."</label>";
			if($EgoiMailListBuilder->LAST_NAME_F) echo "<label style='color:red;'>*</label>";
			echo "<div class='widget-text'><input type='text' name='egoi-mail-list-builder-lname-sub".$this->egoiMailListBuilderID."' id='egoi-mail-list-builder-lname-sub".$this->egoiMailListBuilderID."' /></div>";
		}
		echo "<label>".$EgoiMailListBuilder->EMAIL."</label>";
		echo "<label style='color:red;'>*</label>";
		echo "<div class='widget-text'><input type='text' name='egoi-mail-list-builder-email-sub".$this->egoiMailListBuilderID."' id='egoi-mail-list-builder-email-sub".$this->egoiMailListBuilderID."' /></div>";
		if ( $mobile ) {
			echo "<label>".$EgoiMailListBuilder->MOBILE."</label>";
			if($EgoiMailListBuilder->MOBILE_F) echo "<label style='color:red;'>*</label>";
			echo "<div class='widget-text'><input type='text' name='egoi-mail-list-builder-mobile-sub".$this->egoiMailListBuilderID."' id='egoi-mail-list-builder-mobile-sub".$this->egoiMailListBuilderID."' /></div>";
		}
		if ( $language ) {
			echo "<label>".$EgoiMailListBuilder->LANGUAGE."</label>";
			if($EgoiMailListBuilder->LANGUAGE_F) echo "<label style='color:red;'>*</label>";
			echo "<div class='widget-text'>";
			echo "<select name='egoi-mail-list-builder-language-sub".$this->egoiMailListBuilderID."' id='egoi-mail-list-builder-language-sub".$this->egoiMailListBuilderID."'>";
			echo "<option value='en'>English</option>";
			echo "<option value='fr'>French</option>";
			echo "<option value='de'>German</option>";
			echo "<option value='pt'>Portuguese</option>";
			echo "<option value='br'>Portuguese (Brasil)</option>";
			echo "<option value='es'>Spanish</option>";
			echo "</select>";
			echo "</div>";
		}
		if ( $bdate ) {
			echo "<label>".$EgoiMailListBuilder->BIRTH_DATE."</label>";
			if($EgoiMailListBuilder->BIRTH_DATE_F) echo "<label style='color:red;'>*</label>";
			echo "<div class='widget-text'><input type='text' name='egoi-mail-list-builder-bdate-sub".$this->egoiMailListBuilderID."' id='egoi-mail-list-builder-bdate-sub".$this->egoiMailListBuilderID."' /></div>";
		}
		echo "<input type='hidden' name='egoi-mail-list-builder-list-sub".$this->egoiMailListBuilderID."' id='egoi-mail-list-builder-list-sub".$this->egoiMailListBuilderID."' value='".$list."' />";
		echo "<input type='hidden' name='egoi-mail-list-builder-id-sub".$this->egoiMailListBuilderID."' id='egoi-mail-list-builder-id-sub".$this->egoiMailListBuilderID."' value='".$this->egoiMailListBuilderID."' />";
		echo "<br /><input type='submit' name='egoi-mail-list-builder-submit-sub".$this->egoiMailListBuilderID."' id='egoi-mail-list-builder-submit-sub".$this->egoiMailListBuilderID."' value='".$EgoiMailListBuilder->SUBSCRIBE."' />";
		echo "</form>";
		
        echo $after_widget;
	}
	
	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['fname'] = strip_tags($new_instance['fname']);
		$instance['lname'] = strip_tags($new_instance['lname']);
		$instance['email'] = strip_tags($new_instance['email']);
		$instance['mobile'] = strip_tags($new_instance['mobile']);
		$instance['language'] = strip_tags($new_instance['language']);
		$instance['bdate'] = strip_tags($new_instance['bdate']);
		$instance['list'] = strip_tags($new_instance['list']);
		return $instance;
	}
	
	function form($instance) {
		 $instance = wp_parse_args( 
            (array)$instance, 
				array( 
					'title' => '', 
					'fname' => '',
					'lname' => '',
					'email' => '',
					'mobile' => '',
					'language' => '',
					'bdate' => '',
					'list' => ''
            )
        ); 
		
		$title = esc_attr($instance['title']);
		$fname = esc_attr($instance['fname']);
		$lname = esc_attr($instance['lname']);
		$email = esc_attr($instance['email']);
		$mobile = esc_attr($instance['mobile']);
		$language = esc_attr($instance['language']);
		$bdate = esc_attr($instance['bdate']);
		$list = esc_attr($instance['list']);
		
		$EgoiMailListBuilder = get_option('EgoiMailListBuilderObject');
		$result = $EgoiMailListBuilder->getLists();
		 ?>
		
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Widget Title'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
		</p>
		<p>
			<label>List: </label>
			<select class="widefat" id="<?php echo $this->get_field_id('list'); ?>" name="<?php echo $this->get_field_name('list'); ?>">
			<?php
			for($x = 0;$x < count($result); $x++) {
				?>
				<option <?php if ($list == $result[$x]['listnum']) echo 'selected'; ?> value='<?php echo $result[$x]['listnum']; ?>'><?php echo $result[$x]['title']; ?></option>
				<?php
			}
			?>
			</select>
		</p>
		<p>
			<input class="checkbox" id="<?php echo $this->get_field_id('fname'); ?>" name="<?php echo $this->get_field_name('fname'); ?>" type="checkbox" <?php if($fname){ echo 'checked="checked"';} ?> value="First Name" />
			<label for="<?php echo $this->get_field_name('fname'); ?>">First Name: </label>
			
		</p>
		<p>
			<input class="checkbox" id="<?php echo $this->get_field_id('lname'); ?>" name="<?php echo $this->get_field_name('lname'); ?>" type="checkbox" <?php if($lname){ echo 'checked="checked"';} ?> value="Last Name" />
			<label for="<?php echo $this->get_field_name('lname'); ?>">Last Name: </label>
		</p>
		<p>
			<input class="checkbox" id="<?php echo $this->get_field_id('email'); ?>" name="<?php echo $this->get_field_id('email'); ?>" type="checkbox" checked="checked" value="Email" disabled="disabled"/>
			<label for="<?php echo $this->get_field_id('email'); ?>">Email: </label>
		</p>
		<p>
			<input class="checkbox" id="<?php echo $this->get_field_id('mobile'); ?>" name="<?php echo $this->get_field_name('mobile'); ?>" type="checkbox" <?php if($mobile){ echo 'checked="checked"';} ?> value="Mobile" />
			<label for="<?php echo $this->get_field_name('mobile'); ?>">Mobile: </label>
		</p>
		<p>
			<input class="checkbox" id="<?php echo $this->get_field_id('language'); ?>" name="<?php echo $this->get_field_name('language'); ?>" type="checkbox" <?php if($language){ echo 'checked="checked"';} ?> value="Language" />
			<label for="<?php echo $this->get_field_name('language'); ?>">Language: </label>
		</p>
		<p>
			<input class="checkbox" id="<?php echo $this->get_field_id('bdate'); ?>" name="<?php echo $this->get_field_name('bdate'); ?>" type="checkbox" <?php if($bdate){ echo 'checked="checked"';} ?> value="Birth Date" />
			<label for="<?php echo $this->get_field_name('bdate'); ?>">Birth Date: </label>
		</p>
		<?php
		
	}
}

function egoi_mail_list_builder_request_handler() {
	if(isset($_POST['egoi_mail_list_builder_subscribe']) && ($_POST['egoi_mail_list_builder_subscribe'] == "submited")) {
		$id = $_POST['widget_postid'];

		$EgoiMailListBuilder = get_option('EgoiMailListBuilderObject');
		$errorDesc = "";
		if(isset($_POST['widget_postfname'])) {
			if($EgoiMailListBuilder->FIRST_NAME_F){
				if($_POST['widget_postfname'] != ''){
					$postfname = $_POST['widget_postfname'];	
				}
				else{
					echo "<div class='error".$id."'>".$EgoiMailListBuilder->FIRST_NAME_E."</div>";
					exit();
				}
			}
			else {
				$postfname = $_POST['widget_postfname'];
			}
		}
		else {
			echo "<div class='error".$id."'>".$EgoiMailListBuilder->FIRST_NAME_E."</div>";
			exit();
		}
		if(isset($_POST['widget_postlname'])) {
			if($EgoiMailListBuilder->LAST_NAME_F){
				if($_POST['widget_postlname'] != ''){
					$postlname = $_POST['widget_postlname'];
				}
				else{
					echo "<div class='error".$id."'>".$EgoiMailListBuilder->LAST_NAME_E."</div>";
					exit();
				}
			}
			else {
				$postlname = $_POST['widget_postlname'];
			}
		}
		else {
			echo "<div class='error".$id."'>".$EgoiMailListBuilder->LAST_NAME_E."</div>";
			exit();
		}
		if(isset($_POST['widget_postemail'])) {
			if($_POST['widget_postemail'] != '') {
				$postemail = $_POST['widget_postemail'];
			}
			else {
				echo "<div class='error".$id."'>".$EgoiMailListBuilder->EMAIL_E."</div>";
				exit();
			}
		}
		else {
			echo "<div class='error".$id."'>".$EgoiMailListBuilder->EMAIL_E."</div>";
			exit();
		}
		if(isset($_POST['widget_postmobile'])) {
			if($EgoiMailListBuilder->MOBILE_F){
				if($_POST['widget_postmobile'] != ''){
					$postmobile = $_POST['widget_postmobile'];
				}
				else{
					echo "<div class='error".$id."'>".$EgoiMailListBuilder->MOBILE_E."</div>";
					exit();
				}
			}
			else {
				$postmobile = $_POST['widget_postmobile'];
			}
		}
		else {
			echo "<div class='error".$id."'>".$EgoiMailListBuilder->MOBILE_E."</div>";
			exit();
		}
		if(isset($_POST['widget_postlanguage'])) {
			if($EgoiMailListBuilder->LANGUAGE_F){
				if($_POST['widget_postlanguage'] != ''){
					$postlanguage = $_POST['widget_postlanguage'];
				}
				else{
					echo "<div class='error".$id."'>".$EgoiMailListBuilder->LANGUAGE_E."</div>";
					exit();
				}
			}
			else {
				$postlanguage = $_POST['widget_postlanguage'];
			}
		}
		else {
			echo "<div class='error".$id."'>".$EgoiMailListBuilder->LANGUAGE_E."</div>";
			exit();
		}
		if(isset($_POST['widget_postbdate'])) {
			if($EgoiMailListBuilder->BIRTH_DATE_F){
				if($_POST['widget_postbdate'] != ''){
					$postbdate = $_POST['widget_postbdate'];
				}
				else{
					echo "<div class='error".$id."'>".$EgoiMailListBuilder->BIRTH_DATE_E."</div>";
					exit();
				}
			}
			else {
				$postbdate = $_POST['widget_postbdate'];
			}
		}
		else {
			echo "<div class='error".$id."'>".$EgoiMailListBuilder->BIRTH_DATE_E."</div>";
			exit();
		}
		if(isset($_POST['widget_postlist'])) {
			$postlist = $_POST['widget_postlist'];
		}
		else {
			echo "<div class='error".$id."'>".$EgoiMailListBuilder->LIST_E."</div>";
			exit();
		}

		$EgoiMailListBuilder = get_option('EgoiMailListBuilderObject');
		$result = $EgoiMailListBuilder->addSubscriber(
		$postlist,
		$postfname,
		$postlname,
		$postemail,
		$postmobile,
		$postlanguage,
		$postbdate
		);
		if($EgoiMailListBuilder->exists){
			echo "<div class='error".$id."'>".$EgoiMailListBuilder->description."</div>";
			$EgoiMailListBuilder->exists = false;
	    	$EgoiMailListBuilder->description = "";
	    	$EgoiMailListBuilder->error = "";
	    	update_option('EgoiMailListBuilderObject',$EgoiMailListBuilder);
	    	exit();
		}
		else{
			echo "<div class='error".$id."'>".$EgoiMailListBuilder->SUCCESS_E."</div>";
			exit();
		}
	}
}

/**
 * Initiate Egoi Mail List Builder Widget
**/
function egoi_mail_list_builder_widget_init() {
	register_widget('EgoiMailListBuilderWidget'); 
	add_action('init', 'egoi_mail_list_builder_request_handler');  
}

add_action('widgets_init', 'egoi_mail_list_builder_widget_init');
?>