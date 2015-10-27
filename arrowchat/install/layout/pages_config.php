						<script type="text/javascript">
						$(document).ready(function() {
							$(".int_button_label").click(function() {
								$(".int_button_li").css("border", "5px solid #fff");
								$(this).parent().css("border", "5px solid #017fd6");
								$(".step2").removeClass("disabled");
								$(".step2_input").removeAttr("disabled");
							});
							$(".int_button_label").mouseover(function() {
								if ( ! $(this).children("input[@type=radio]").is(":checked")) {
									$(this).parent().css("border", "5px solid #badef7");
								}
							});
							$(".int_button_label").mouseout(function() {
								if ( ! $(this).children("input[@type=radio]").is(":checked")) {
									$(this).parent().css("border", "5px solid #fff");
								} else {
									$(this).parent().css("border", "5px solid #017fd6");
								}
							});
							$(".int_button_label2").click(function() {
								if ($(".int_button_label").children("input[@type=radio]").is(":checked"))
								{
									$(".int_button_li2").css("border", "5px solid #fff");
									$(this).parent().css("border", "5px solid #017fd6");
									$(".step3").removeClass("disabled");
									$(".step3_input").removeAttr("disabled");
								}
							});
							$(".int_button_label2").mouseover(function() {
								if ($(".int_button_label").children("input[@type=radio]").is(":checked"))
								{
									if ( ! $(this).children("input[@type=radio]").is(":checked")) {
										$(this).parent().css("border", "5px solid #badef7");
									}
								}
							});
							$(".int_button_label2").mouseout(function() {
								if ($(".int_button_label").children("input[@type=radio]").is(":checked"))
								{
									if ( ! $(this).children("input[@type=radio]").is(":checked")) {
										$(this).parent().css("border", "5px solid #fff");
									} else {
										$(this).parent().css("border", "5px solid #017fd6");
									}
								}
							});
							$(".int_button_label3").mouseover(function() {
								if ($(".int_button_label2").children("input[@type=radio]").is(":checked"))
								{
									if ( ! $(this).children("input[@type=radio]").is(":checked")) {
										$(this).parent().css("border", "5px solid #badef7");
									}
								}
							});
							$(".int_button_label3").mouseout(function() {
								if ($(".int_button_label2").children("input[@type=radio]").is(":checked"))
								{
									if ( ! $(this).children("input[@type=radio]").is(":checked")) {
										$(this).parent().css("border", "5px solid #fff");
									} else {
										$(this).parent().css("border", "5px solid #017fd6");
									}
								}
							});
							$(".int_button_label3").click(function() {
								if ($(".int_button_label2").children("input[@type=radio]").is(":checked"))
								{
									$(".int_button_li3").css("border", "5px solid #fff");
									$(this).parent().css("border", "5px solid #017fd6");
									$(".step4").removeClass("disabled");
									$(".database_input").removeAttr("disabled");
								}
							});
							$("#no_friend_system").click(function() {
								$(".friends_table").css("display", "none");
							});
							$("#all_online").click(function() {
								$(".friends_table").css("display", "table-row");
							});
							$("#friends_only").click(function() {
								$(".friends_table").css("display", "table-row");
							});
						});
					</script>
		<?php
			if ($_SESSION['version'] != "standalone") 
			{
				echo '<style type="text/css">.standalone-info{display:none !important}</style>';
			}

			if ($_SESSION['db_type'] == 1)
			{
				$prefix_guess = "";
			}
			else
			{
				$result = $db->execute("
					SHOW TABLES 
					FROM " . $_SESSION['db_name'] . "
				");
				
				if ($result AND $db->count_select() > 0)
				{
					$prefixs = array();
					
					while ($row = $db->fetch_array($result)) 
					{
						if (strpos($row[0], "_") === false) 
						{
						} 
						else 
						{
							$end = strstr($row[0], "_");
							$prefix = str_replace($end, "_", $row[0]);
							
							if (array_key_exists($prefix, $prefixs)) 
							{
								$prefixs[$prefix]++;
							} 
							else 
							{
								$prefixs[$prefix] = 0;
							}
						}
					}	
					
					$old_val = 0;
					
					foreach ($prefixs as $key => $val) 
					{
						if ($val > $old_val) 
						{
							$old_val = $val;
							$key2 = $key;
						}
					}
					
					if ($old_val >= 10) 
					{
						$prefix_guess = $key2;
					} 
					else 
					{
						$prefix_guess = "";
					}
					
					if ($prefix_guess == "arrowchat_" OR $prefix_guess == "sys_" OR $prefix_guess == "video_" OR $prefix_guess == "core_" OR $prefix_guess == "skin_" OR $prefix_guess == "blog_" OR $prefix_guess == "cms_")
					{
						$prefix_guess = "";
					}
				}
			}
			
			if (!isset($_SESSION['db_prefix']))
				$prefix_val = $prefix_guess;
			else
				$prefix_val = $_SESSION['db_prefix'];
			?>
				<form method="post" id="config_form" action="<?php echo $_SERVER['PHP_SELF']; ?>?mode=config">
					Enter the configuration details for your ArrowChat installation below.  Make sure these details are correct or your installation will not work properly.
					<br /><br />
					
					<div class="step">
						<img src="./images/step1.png" alt="" /><strong> Choose your buddylist setup</strong>
					</div>
					
					<div class="buddy_list_setup">
						<ul>
							<li class="int_button_li"><label class="int_button_label"><input type="radio" name="buddylist" id="friends_only" value="friends_only" /><img src="./images/friends_only.png" alt="Friends Only" /><br /><div class="inside"><b>Friends Only</b><span>The buddylist will only display users who are friends with each other.</span></div></label></li>
							<li class="int_button_li"><label class="int_button_label"><input type="radio" name="buddylist" id="all_online" value="all_online" /><img src="./images/all_online.png" alt="All online users" /><br /><div class="inside"><b>All Online</b><span>The buddylist will display all online users regardless of friendship.</span></div></label></li>
							<li class="int_button_li"><label class="int_button_label"><input type="radio" name="buddylist" id="no_friend_system" value="no_friend_system" /><img src="./images/no_friend_system.png" alt="No friend system" /><br /><div class="inside"><b>No Friend System</b><span>Choose this option if users on your site cannot add friends (will show all online).</span></div></label></li>
						</ul>
					</div>
					
					<div class="clear"></div>
					<div class="step2 disabled">
					<div class="step">
						<img src="./images/step2.png" alt="" /><strong> Choose who can chat</strong>
					</div>
					
					<div class="buddy_list_setup">
						<ul>
							<li class="int_button_li2"><label class="int_button_label2"><input disabled="disabled" type="radio" class="step2_input" name="who_chat" id="guests_chat" value="guests_chat" /><img src="./images/guests_chat.png" alt="Friends Only" /><br /><div class="inside"><b>Guests and Users</b><span>Everyone visiting the site will be able to chat and use all features.</span></div></label></li>
							<li class="int_button_li2"><label class="int_button_label2"><input disabled="disabled" type="radio" class="step2_input" name="who_chat" id="display_message" value="display_message" /><img src="./images/display_message.png" alt="All online users" /><br /><div class="inside"><b>Display Message to Guests</b><span>This option will show guests a message that they must login to use chat.</span></div></label></li>
							<li class="int_button_li2"><label class="int_button_label2"><input disabled="disabled" type="radio" class="step2_input" name="who_chat" id="logged_in" value="logged_in" /><img src="./images/logged_in.png" alt="No friend system" /><br /><div class="inside"><b>Logged in Users Only</b><span>Only logged in users can see the chat bar. Guests will see nothing.</span></div></label></li>
						</ul>
					</div>
					
					</div>
					
					<div class="clear"></div>
					<div class="step3 disabled">
					<div class="step">
						<img src="./images/step3.png" alt="" /><strong> Choose where to retrieve information</strong>
					</div>
					
					<div class="buddy_list_setup">
						<ul>
							<li class="int_button_li3" id="smart_polling_click"><label class="int_button_label3"><input disabled="disabled" type="radio" class="step3_input" name="server_type" id="smart_polling" value="smart_polling" /><img src="./images/smart_polling.png" alt="Own Server" /><br /><div class="inside"><b>My Server</b><span>Your own server will retrieve messages using smart polling.</span></div></label></li>
							<li class="int_button_li3" style="width:463px;">
								<div style="float: right; padding-top:17px; width: 250px; text-align: left; line-height:2.3em;">
									<b>To enable a push server:</b><br />
									1. Create an account at http://www.arrowchat.com/push/ <br />
									2. Visit your license page<br />
									3. Enter the information on the push tab:
									<div style="float: left; text-align: right; width: 100px;">
										API Key 1:
									</div>
									<div style="float: left; width: 140px; padding-left: 10px; padding-top: 4px;">
										<input type="text" class="step3_input" disabled="disabled" name="publish_key" value="<?php echo $_SESSION['publish_key']; ?>" style="font-size: 11px; height: 15px; width: 120px; position:static; left:0" />
									</div>
									<br />
									<div style="float: left; text-align: right; width: 100px;">
										API Key 2:
									</div>
									<div style="float: left; width: 140px; padding-left: 10px; padding-top: 4px;">
										<input type="text" class="step3_input" disabled="disabled" name="subscribe_key" value="<?php echo $_SESSION['subscribe_key']; ?>" style="font-size: 11px; height: 15px; width: 120px; position:static; left:0" />
									</div>
								</div>
								<label class="int_button_label3" style="width:462px;">
										<input disabled="disabled" type="radio" class="step3_input" name="server_type" id="push_server" value="push_server" />
										<div style="width: 195px;">
											<img src="./images/push_server.png" alt="Push Server" />
										</div>
										<div class="inside" style="width: 195px;">
											<b>Push Server</b>
											<span>Use a push server in the cloud. This will greatly reduce the load on your server.</span>
										</div>
								</label>
							</li>
						</ul>
					</div>
					
					</div>
					
					<div class="clear"></div>
					<div class="step4 disabled">
					<div class="step">
						<img src="./images/step3.png" alt="" /><strong> Complete your configuration details</strong>
					</div>
					
					<table class="form-table2"> 
						<tr> 
							<th scope="row"><label for="phpver">ArrowChat Path</label></th> 
							<td class="col2"><span class="formwrap"><input class="database_input" disabled="disabled" type="text" name="config_path" value="<?php echo $config_path; ?>" /></span><span style="color:#FF0000">&nbsp;*</span></td> 
							<td class="col3">The path where your ArrowChat installation is located (relative to your public_html or www folder).  You probably don't need to change this.</td> 
						</tr> 
						<tr class="no-border"> 
							<th scope="row"><label for="configwrite">Database Prefix</label></th> 
							<td class="col2"><span class="formwrap"><input class="database_input" disabled="disabled" type="text" name="prefix" value="<?php echo $prefix_val; ?>" /></span><span style="color:#FF0000">&nbsp;*</span></td> 
							<td class="col3">We have automatically guessed your prefix to the left. If it is not correct, please enter your table's existing prefix. Sometimes the correct value is blank.</td> 
						</tr>
						<tr class="standalone-info">
							<td colspan="3" style="background-color:#fff;"><b>Database Details</b><br />In order for ArrowChat to connect with your existing database, we need some details about your database.  Consult the ArrowChat documentation if you need additional assistance with this.</td>
						</tr>
						<tr class="standalone-info"> 
							<th scope="row"><label for="configwrite">User Table</label></th> 
							<td class="col2"><span class="formwrap"><input class="database_input" disabled="disabled" type="text" name="config_table_user" value="<?php echo $config_table_user; ?>" /></span><span style="color:#FF0000">&nbsp;*</span></td> 
							<td class="col3">The name of the table where your usernames and IDs are located</td> 
						</tr>  
						<tr class="standalone-info"> 
							<th scope="row"><label for="configwrite">Username Field</label></th> 
							<td class="col2"><span class="formwrap"><input class="database_input" disabled="disabled" type="text" name="config_field_username" value="<?php echo $config_field_username; ?>" /></span><span style="color:#FF0000">&nbsp;*</span></td> 
							<td class="col3">...and the name of the username field in that table</td> 
						</tr>  
						<tr class="standalone-info"> 
							<th scope="row"><label for="configwrite">User ID Field</label></th> 
							<td class="col2"><span class="formwrap"><input class="database_input" disabled="disabled" type="text" name="config_field_userid" value="<?php echo $config_field_userid; ?>" /></span><span style="color:#FF0000">&nbsp;*</span></td> 
							<td class="col3">...and the name of the user ID field in that table</td> 
						</tr>  
						<tr class="standalone-info"> 
							<th scope="row"><label for="configwrite">User Avatar Field</label></th> 
							<td class="col2"><span class="formwrap"><input class="database_input" disabled="disabled" type="text" name="config_field_avatar" value="<?php echo $config_field_avatar; ?>" /></span><span style="color:#FF0000">&nbsp;*</span></td> 
							<td class="col3">...and the name of the avatar field in that table. Fill this in with the user id field if none exists. <b>Do not leave blank.</b></td> 
						</tr>  
						<tr class="friends_table standalone-info"> 
							<th scope="row"><label for="configwrite">Friends Table</label></th> 
							<td class="col2"><span class="formwrap"><input class="database_input" disabled="disabled" type="text" name="config_table_friends" value="<?php echo $config_table_friends; ?>" /></span></td> 
							<td class="col3">The name of the table where the friends data is located (Optional, if friend system exists)</td> 
						</tr>  
						<tr class="friends_table standalone-info"> 
							<th scope="row"><label for="configwrite">Friends User ID Field</label></th> 
							<td class="col2"><span class="formwrap"><input class="database_input" disabled="disabled" type="text" name="config_field_friend_userid" value="<?php echo $config_field_friend_userid; ?>" /></span></td> 
							<td class="col3">...and the name of the user ID field in that table (Optional, if friend system exists)</td> 
						</tr>  
						<tr class="friends_table standalone-info"> 
							<th scope="row"><label for="configwrite">Friends Friend ID Field</label></th> 
							<td class="col2"><span class="formwrap"><input class="database_input" disabled="disabled" type="text" name="config_field_friendid" value="<?php echo $config_field_friendid; ?>" /></span></td> 
							<td class="col3">...and the name of the friend ID in that table (Optional, if friend system exists)</td> 
						</tr>  
						<tr class="no-border friends_table standalone-info"> 
							<th scope="row"><label for="configwrite">Friends Check Field</label></th> 
							<td class="col2"><span class="formwrap"><input class="database_input" disabled="disabled" type="text" name="config_field_friend_check" value="<?php echo $config_field_friend_check; ?>" /></span></td> 
							<td class="col3">...and the name of the field that determines if the users are friends. (Optional, if friend system exists)</td> 
						</tr>  
					</table>
					</div>
				</form>
			<?php
				if (!empty($_SESSION['buddylist'])) {
					echo '	<script type="text/javascript">
								$(document).ready(function() {
									$(".step2").removeClass("disabled");
									$(".step2_input").removeAttr("disabled");
									$("#'.$_SESSION['buddylist'].'").attr("checked", "checked");
									$("#'.$_SESSION['buddylist'].'").parent().parent().css("border", "5px solid #017fd6");
									if ($("#no_friend_system").is(":checked")) {
										$(".friends_table").css("display", "none");
									}
								});
							</script>';
				}
				if (!empty($_SESSION['who_chat'])) {
				?>
							<script type="text/javascript">
								$(document).ready(function() {
									$(".step3").removeClass("disabled");
									$(".step3_input").removeAttr("disabled");
									$("#<?php echo $_SESSION['who_chat']; ?>").attr("checked", "checked");
									$("#<?php echo $_SESSION['who_chat']; ?>").parent().parent().css("border", "5px solid #017fd6");
								});
							</script>
				<?php
				}
				if (!empty($_SESSION['server_type'])) {
				?>
							<script type="text/javascript">
								$(document).ready(function() {
									$(".step4").removeClass("disabled");
									$(".database_input").removeAttr("disabled");
									$("#<?php echo $_SESSION['server_type']; ?>").attr("checked", "checked");
									$("#<?php echo $_SESSION['server_type']; ?>").parent().parent().css("border", "5px solid #017fd6");
								});
							</script>
				<?php
				}
?>