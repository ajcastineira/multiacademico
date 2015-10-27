			<form method="post" id="final_form" action="<?php echo $_SERVER['PHP_SELF']; ?>?mode=final">
					This final step will write all your information to the files and database. Please confirm that everything is correct before continuing. You can change these details be clicking the corresponding tab at the top.<br /><br />
				<div class="final-step">
					<ul class="clearfix">
						<li><b>Installation type</b></li>
						<li class="col2"><img src="./images/img-<?php echo $_SESSION['version']; ?>.png" alt="" /></li>
					</ul>
					<ul class="clearfix">
						<li><b>Database name</b></li>
						<li class="col2"><?php echo $_SESSION['db_name']; ?></li>
					</ul>
					<ul class="clearfix">
						<li><b>Admin username</b></li>
						<li class="col2"><?php echo $_SESSION['admin_username']; ?></li>
					</ul>
					<ul class="clearfix">
						<li><b>Admin email</b></li>
						<li class="col2"><?php echo $_SESSION['admin_email']; ?></li>
					</ul>
					<ul class="clearfix">
						<li><b>Buddylist setup</b></li>
						<li class="col2"><img width="32" height="32" src="./images/<?php echo $_SESSION['buddylist']; ?>.png" alt="" /> <span style="position: relative; top: -10px; left: 10px;"><?php echo $buddylist_text; ?></span></li>
					</ul>
					<ul class="clearfix">
						<li><b>Chat setup</b></li>
						<li class="col2"><img width="32" height="32" src="./images/<?php echo $_SESSION['who_chat']; ?>.png" alt="" /> <span style="position: relative; top: -10px; left: 10px;"><?php echo $who_chat_text; ?></span></li>
					</ul>
					<ul class="clearfix">
						<li><b>Server type</b></li>
						<li class="col2"><img width="32" height="32" src="./images/<?php echo $_SESSION['server_type']; ?>.png" alt="" /> <span style="position: relative; top: -10px; left: 10px;"><?php echo $server_type_text; ?></span></li>
					</ul>
					<ul class="clearfix">
						<li><b>ArrowChat path</b></li>
						<li class="col2"><?php echo $_SESSION['config_path']; ?></li>
					</ul>
					<ul class="clearfix no-border">
						<li><b>Database prefix</b></li>
						<li class="col2"><?php echo $_SESSION['db_prefix']; ?></li>
					</ul>
				</div>
				<input type="hidden" name="write_files" value="1" />
			</form>