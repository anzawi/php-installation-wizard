<?php include_once(__DIR__ . '/../includes/db_settings.php'); ?>
<?php if(isset($_SESSION['help'])) : ?>
	<div class="alert alert-error"><h3><?php __("Help ...!") ?> </h3><p><?php echo $_SESSION['help'] ?></p></div>
	<?php unset($_SESSION['help']) ?>
<?php endif ?>
<table width="99%" border="0" cellspacing="1" cellpadding="1">
			<tbody><tr>
				<td colspan="3"><span class="star">*</span> <?php __("Items marked with an asterisk are required") ?></td>
			</tr>
			<tr><td nowrap="" height="10px" colspan="3"></td></tr>
			<tr>
				<td width="250px" nowrap="">&nbsp;<?php __("Database Host") ?> :<span class="star">*</span></td>
				<td>
					<input type="text" class="form_text" name="database_host" id="database_host" size="30" value="<?php echo (isset($_POST['database_host'])? $_POST['database_host'] : 'localhost') ?>"  onfocus="textboxOnFocus('notes_host')" onblur="textboxOnBlur('notes_host')">					
				</td>
				<td rowspan="7" valign="top">					
					<div id="notes_host" class="notes_container">
						<h4> <?php __("Database Host") ?></h4>
						<p><?php __("Hostname or IP-address of the database server. The database server can be in the form of a hostname (and/or port address), such as db1.myserver.com, or localhost:5432, or as an IP-address, such as 192.168.0.1") ?></p>
					</div>						
					<div id="notes_db_name" class="notes_container">
						<h4><?php __("Database Name") ?></h4>
						<p><?php __("Database Name. The database used to hold the data. An example of database name is 'testdb'.") ?></p>
					</div>
					<div id="notes_db_user" class="notes_container">
						<h4><?php __("Database Username") ?></h4>
						<p><?php __("Database username. The username used to connect to the database server. An example of username is 'test_123'.") ?></p>
					</div>
					<div id="notes_db_password" class="notes_container">
						<h4><?php __("Database Password") ?></h4>
						<p><?php __("Database password. The password is used together with the username, which forms the database user account.") ?></p>
					</div>
					<div id="notes_message" class="notes_container" style="display:none;"></div>					
				</td>
			</tr>
			<tr>
				<td nowrap="">&nbsp;<?php __("Database Name:") ?> <span class="star">*</span></td>
				<td>
					<input type="text" class="form_text" name="database_name" id="database_name" size="30" autocomplete="off" value="<?php echo (isset($_POST['database_name']) ? $_POST['database_name'] : '') ?>"  onfocus="textboxOnFocus('notes_db_name')" onblur="textboxOnBlur('notes_db_name')">					
				</td>
			</tr>
			<tr>
				<td nowrap="">&nbsp;<?php __("Database Username") ?> :<span class="star">*</span></td>
				<td>
					<input type="text" class="form_text" name="database_username" id="database_username" size="30" autocomplete="off" value="<?php echo (isset($_POST['database_username']) ? $_POST['database_username'] : '') ?>"  onfocus="textboxOnFocus('notes_db_user')" onblur="textboxOnBlur('notes_db_user')">
				</td>
			</tr>
			<tr>
				<td nowrap="">&nbsp;<?php __("Database Password") ?> :</td>
				<td>
					<input type="text" class="form_text" name="database_password" id="database_password" size="30" value="<?php echo (isset($_POST['database_password']) ? $_POST['database_password'] : '') ?>" autocomplete="off"  onfocus="textboxOnFocus('notes_db_password')" onblur="textboxOnBlur('notes_db_password')">
				</td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td>
					<input type="button" class="form_button" title="Test database connection" onclick="testDatabaseConnection()" value="<?php __("Test Connection") ?>">
				</td>
			</tr>
			<tr><td nowrap="" height="10px" colspan="3"></td></tr>
			<tr>
				<td colspan="2">
					<input id="submit" disabled="disabled" type="submit" name="db_info" class="form_button fail" value="<?php __("Continue") ?>">
					&nbsp;&nbsp;&nbsp;&nbsp;
					<input id="submit" type="submit" name="help" class="form_button" value="<?php __("Help") ?>">
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


		function testDatabaseConnection(){    
	
		$('#notes_message').attr("style", "display:none;");
		
		var database_host = $("#database_host").val();
		var database_name = $("#database_name").val();
		var database_username = $("#database_username").val();
		var database_password = $("#database_password").val();
		var _token = $("#token").val();
		
		$.ajax({
			url: "includes/functions.php",
			type: "POST",
			data: {
					db_host:database_host,
				    db_name:database_name,
					db_username:database_username,
					db_password:database_password,
					check_key : _token,
					action : 'testConnection'
				},

			success: function(data)
			{
				pushMessage('Success', 'a connection was successfully. <br> established with the server.', 'success');
				$("#submit").removeClass('fail');
				$("#submit").removeAttr('disabled');
			},

			error: function(x, y, e)
			{
				pushMessage('Error', '<?php  __("Cant Connect With database , plase check database information and try again") ?>', 'error');
			}

			});
}

function pushMessage(title, msg, type)
{
	$("#notes_message").html(
						'<h4 class="'+ type +'">' + title + '</h4>'+
						'<p>' + msg + '.</p>'
						);
	$("#notes_message").fadeIn(400);
}

</script>