<?php

	/*
	|| #################################################################### ||
	|| #                             ArrowChat                            # ||
	|| # ---------------------------------------------------------------- # ||
	|| #    Copyright ©2010-2012 ArrowSuites LLC. All Rights Reserved.    # ||
	|| # This file may not be redistributed in whole or significant part. # ||
	|| # ---------------- ARROWCHAT IS NOT FREE SOFTWARE ---------------- # ||
	|| #   http://www.arrowchat.com | http://www.arrowchat.com/license/   # ||
	|| #################################################################### ||
	*/

?>
				</div>
				<?php if ($page != "database" && $page != "config" && $page != "final") { ?>
				<div id="last_column">
					<?php if($page == "requirements") { ?><img src="./images/requirements.png" alt="" /><?php } ?>
					<?php if($page == "admin" && empty($success)) { ?><img src="./images/admin_bg.png" alt="" /><?php } ?>
				</div>
				<?php } ?>
				<div class="clear"></div>
			</div>
			<div class="button_container float">
				<div class="floatr">
					<a class="fwdbutton" <?php echo $next[1]; ?>>
						<span><?php echo $next[0]; ?></span>
					</a>
				</div>
			</div>
			<div class="clear"></div>
		</div>
		<div style="height: 130px;"></div>
	</div>
</div>
<div id="footer">
	<div class="holder">
		<div class="col-l">
			<ul>
				<li>Copyright ArrowChat 2010-2012</li>
			</ul>
			<p>Part of the ArrowSuites Software Company</p>
		</div>
	</div>
</div><!-- footer end -->
</body>
</html>