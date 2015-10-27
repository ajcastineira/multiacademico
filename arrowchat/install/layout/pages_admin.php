				<form method="post" id="admin_form" action="<?php echo $_SERVER['PHP_SELF']; ?>?mode=admin">
					This information is what you'll use to login to the ArrowChat admin panel with. Make sure it's secure so that no one can change your settings.
					<br /><br />
					<table class="form-table3"> 
						<tr> 
							<th scope="row"><label for="phpver"><a href="javascript:;" class="vtip" title="The username you want to use to login to the admin panel with.">Admin username</a></label></th> 
							<td><span class="formwrap"><input type="text" name="admin_username" value="<?php echo $_SESSION['admin_username']; ?>" /></span></td> 
						</tr> 
						<tr> 
							<th scope="row"><label for="mysql"><a href="javascript:;" class="vtip" title="The password you want to use to login to the admin panel with.">Admin password</a></label></th> 
							<td><span class="formwrap"><input type="password" name="admin_password" value="<?php echo $_SESSION['admin_password']; ?>" /></span></td>  
						</tr> 
						<tr> 
							<th scope="row"><label for="configwrite"><a href="javascript:;" class="vtip" title="Type the same password you just typed.">Confirm password</a></label></th> 
							<td><span class="formwrap"><input type="password" name="admin_password_confirm" value="<?php echo $_SESSION['admin_password_confirm']; ?>" /></span></td> 
						</tr>  
						<tr> 
							<th scope="row"><label for="configwrite"><a href="javascript:;" class="vtip" title="The email you wish to use for administration reasons.">Admin email</a></label></th> 
							<td><span class="formwrap"><input type="text" name="admin_email" value="<?php echo $_SESSION['admin_email']; ?>" /></span></td> 
						</tr>  
						<tr class="no-border"> 
							<th scope="row"><label for="configwrite"><a href="javascript:;" class="vtip" title="Confirm the email you just typed.">Confirm email</a></label></th> 
							<td><span class="formwrap"><input type="text" name="admin_email_confirm" value="<?php echo $_SESSION['admin_email_confirm']; ?>" /></span></td> 
						</tr>  
					</table>
				</form>