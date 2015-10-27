				Welcome to ArrowChat.  Before proceeding, we need to make sure that your server meets the minimum requirements for installation.
				<br /><br />

				<table class="form-table"> 
					<tr> 
						<td><img src="./images/reserve_tab_checked.png" alt="" /></td> 
						<th scope="row"><label for="phpver"><a href="javascript:;" class="vtip" title="Your PHP version must be greater than 4.3.3.">PHP version</a></label></th> 
						<td></td>
					</tr> 
					<!--<tr> 
						<td><?php if ($dbcheck) echo $pass_img; else echo $fail_img; ?></td> 
						<th scope="row"><label for="mysql"><a href="javascript:;" class="vtip" title="You must have mySQL installed on your server.">mySQL enabled</a></label></th> 
						<td></td>
					</tr>-->
					<tr> 
						<td><?php if ($configwrite) echo $pass_img; else echo $fail_img; ?></td> 
						<th scope="row"><label for="configwrite"><a href="javascript:;" class="vtip" title="The includes/config.new.php file must be writable.  CHMOD it to 777.">Includes/config.new.php file writable</a></label></th> 
						<td></td>
					</tr> 
					<tr> 
						<td><?php if ($cachewrite) echo $pass_img; else echo $fail_img; ?></td> 
						<th scope="row"><label for="cachewrite"><a href="javascript:;" class="vtip" title="The cache folder must be writable.  CHMOD it to 777.">Cache folder writable</a></label></th> 
						<td></td>
					</tr>   
					<tr> 
						<td><?php if ($includewrite) echo $pass_img; else echo $fail_img; ?></td> 
						<th scope="row"><label for="includewrite"><a href="javascript:;" class="vtip" title="The includes folder must be writable.  CHMOD it to 777.">Includes folder writable</a></label></th> 
						<td></td>
					</tr>  
					<tr class="no-border"> 
						<td><?php if ($functionswrite) echo $pass_img; else echo $fail_img; ?></td> 
						<th scope="row"><label for="functionswrite"><a href="javascript:;" class="vtip" title="The includes/functions/integrations/ folder must be writable.  CHMOD it to 777.">Includes/functions/integrations/ folder writable</a></label></th> 
						<td></td>
					</tr>  
				</table>