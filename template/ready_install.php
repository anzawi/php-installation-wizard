<?php include_once(__DIR__ . '/../includes/ready_install.php'); ?>
			<h3>We are ready now to proceed with installation</h3>			
		
			<p>At this step setup wizard will attempt to create all required database tables and populate them with data. <br>If something goes wrong, go back to the Database Settings step and make sure every information you've entered is correct.</p>			

			
			<table width="100%" border="0" cellspacing="1" cellpadding="1">
			<tbody><tr><td nowrap="" height="10px" colspan="3"></td></tr>

			<tr><td colspan="2" nowrap="" height="20px">&nbsp;</td></tr>
			<tr>
				<td colspan="2">
					<a href="administrator_account.php" class="form_button"><?php __("Back") ?></a>
					&nbsp;&nbsp;&nbsp;&nbsp;
					<input type="submit" class="form_button" id="start_install" value="<?php __("Start Install") ?>">
				</td>
			</tr>                        
			</tbody></table>
			</form>

			<br><br>

			<table width="100%" border="0" cellspacing="1" cellpadding="1">
			<thead>
				<tr>
					<td><?php __("Procces Name") ?></td>
					<td><?php __("Action") ?></td>
				</tr>
			</thead>
			<tbody class="install_process">
				<tr>
					<td><?php __("Create Database Tables") ?></td>
					<td><span id='create_tables' class="pending"><?php __("Pending") ?></span></td>
				</tr>
				<tr>
					<td><?php __("Create Admin Account") ?></td>
					<td><span id='create_admin' class="pending"><?php __("Pending") ?></span></td>
				</tr>
				<tr>
					<td><?php __("Generate <strong>Config</strong> file") ?></td>
					<td><span id='create_config' class="pending"><?php __("Pending") ?></span></td>
				</tr>
			</tbody>
			</table>

<script type="text/javascript">

	
	$().ready(function() {
		$("#start_install").click(function () {
			$("#main_form").submit(function () {return false;});
			$(".form_button").fadeOut(400);
			$("#create_tables")
				.removeClass('pending')
				.addClass('processing')
				.html('<?php __("Processing ....") ?>');
			createDatabase();
		});

		function createDatabase()
		{
			$.ajax({
				url : 'includes/functions.php',
				type: "POST",
				data: {action: 'createDatabaseTables'},
				success: function (data) {
					createAdmin();
				},

				error: function ()
				{

				}
			});
		}

		function createAdmin()
		{
			$("#create_tables")
						.removeClass('processing')
						.addClass('complete')
						.html('finished');
			$("#create_admin")
				.removeClass('pending')
				.addClass('processing')
				.html('<?php __("Processing ....") ?>');

			$.ajax({
				url : 'includes/functions.php',
				type: "POST",
				data: {action: 'createAdminAccount'},
				success: function (data) {
					createConfig();
				},
			});
		}


		function createConfig()
		{
			$("#create_admin")
						.removeClass('processing')
						.addClass('complete')
						.html('finished');
			$("#create_config")
				.removeClass('pending')
				.addClass('processing')
				.html('<?php __("Processing ....") ?>');

			$.ajax({
				url : 'includes/functions.php',
				type: "POST",
				data: {action: 'createConfigFile'},
				success: function (data) {
					$("#create_config")
						.removeClass('processing')
						.addClass('complete')
						.html('<?php __("finished") ?>');

					window.location.href = "complete";
				},
			});
		}
	});
</script>