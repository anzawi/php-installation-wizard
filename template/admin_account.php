<?php include_once(__DIR__ . '/../includes/admin_account.php'); ?>
<?php if(isset($_SESSION['errors'])): ?>
<div class="alert alert-error"><?php echo implode('<br>', $_SESSION['errors']) ?></div>
<?php unset($_SESSION['errors']) ?>
<?php endif ?>
<table width="100%" border="0" cellspacing="1" cellpadding="1">
			<tbody><tr>
				<td colspan="3"><span class="star">*</span> <?php __("Items marked with an asterisk are required") ?></td>
			</tr>
			<tr><td nowrap="" height="10px" colspan="3"></td></tr>

						<tr>
				<td width="250px">&nbsp;<?php __("Admin Login") ?>&nbsp;<span class="star">*</span></td>
				<td><input name="admin_username" id="admin_username" class="form_text" size="28" maxlength="22" value="<?php echo (isset($_POST['admin_username']) ? $_POST['admin_username'] : '') ?>" onfocus="textboxOnFocus('notes_admin_username')" onblur="textboxOnBlur('notes_admin_username')" autocomplete="off" placeholder="demo: test"></td>
				<td rowspan="6" valign="top">					
					<div id="notes_admin_email" class="notes_container">
						<h4><?php __("Admin Email") ?></h4>
						<p><?php __("Admin Email that will be replaced in SQL dump with email placeholder (if defined).") ?></p>
					</div>
					<div id="notes_admin_username" class="notes_container" style="display:none;">
						<h4><?php __("Admin Login") ?></h4>
						<p><?php __("Your username must be at least 6 characters long and case-sensitive. Please do not enter accented characters.") ?></p>
					</div>
					<div id="notes_admin_password" class="notes_container">
						<h4><?php __("Admin Password") ?></h4>
						<p><?php __("We recommend that your password is not a word you can find in the dictionary, includes both capital and lower case letters, and contains at least one special character (1-9, !, *, _, etc.).") ?></p>
					</div>
					<div id="notes_message" class="notes_container" style="display:none;"></div>					
				</td>
			</tr>
			<tr>
				<td>&nbsp;<?php __("Admin Password") ?>&nbsp;<span class="star">*</span></td>
				<td><input name="admin_password" id="admin_password" class="form_text" type="text" size="28" maxlength="22" value="<?php echo (isset($_POST['admin_password']) ? $_POST['admin_password'] : '') ?>" onfocus="textboxOnFocus('notes_admin_password')" onblur="textboxOnBlur('notes_admin_password')" autocomplete="off" placeholder="demo: test"></td>
			</tr>
			<tr>
				<td>&nbsp;<?php __("Admin Email") ?>&nbsp;<span class="star">*</span></td>
				<td><input name="admin_email" id="admin_email" class="form_text" size="28" maxlength="125" value="<?php echo (isset($_POST['admin_email'])? $_POST['admin_email'] : '' ) ?>" onfocus="textboxOnFocus('notes_admin_email')" onblur="textboxOnBlur('notes_admin_email')" autocomplete="off"></td>
			</tr>						
			<tr>
				<td colspan="2" nowrap="" height="50px">&nbsp;</td>
			</tr>
			<tr>
				<td colspan="2">
					<a href="database_settings.php" class="form_button"><?php __("Back") ?></a>
					&nbsp;&nbsp;&nbsp;&nbsp;
					<input type="submit" class="form_button" name="admin" value="<?php __("Continue") ?>">
				</td>
			</tr>                        
			</tbody></table>

			<script type="text/javascript">
		function textboxOnFocus(key)
		{
		    $("#notes_message").attr("style", "display:none;");
		    $('#'+key).show();
			//$('#'+key).fadeIn('slow');
		}

		function textboxOnBlur(key)
		{
		    $("#"+key).attr("style", "display:none;");
		}

		function setFocus(key)
		{
			$("#"+key).focus();
		}
		</script>