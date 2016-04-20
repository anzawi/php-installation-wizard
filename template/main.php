<!DOCTYPE html>
<html dir="<?php echo (rtl(currentLang()) ? 'rtl' : 'ltr') ?>">
<head>
	<meta charset="UTF-8">
	<title>Install</title>
	<link rel="stylesheet" type="text/css" href="<?php echo $url->getassets() ?>css/style.css">
	<?php if(rtl(currentLang())) :  ?>
		<link rel="stylesheet" type="text/css" href="<?php echo $url->getassets() ?>css/rtl.css">
	<?php endif; ?>
	<script type="text/javascript" src="<?php echo $url->getassets() ?>js/jquery-1.11.3.min.js"></script>
</head>
<body>
	<div id="main">
		<div class="content">

			<div class="left-part">
				<ul class="left-menu">
					<li class="<?php echo ($url->segment(1)=='server_requirements' ? 'current':'') ?> <?php echo (isset($_SESSION['req'])? 'pass': '') ?>">
						<label><?php __("Server Requirements") ?></label>
					</li>
					<li class="<?php echo ($url->segment(1)=='db_settings' ? 'current':'') ?> <?php echo (isset($_SESSION['db'])? 'pass': '') ?>">
						<label><?php __("Database Settings") ?></label>
					</li>
					<li class="<?php echo ($url->segment(1)=='admin_account' ? 'current':'') ?> <?php echo (isset($_SESSION['admin'])? 'pass': '') ?>">
						<label><?php __("Administrator Account") ?></label>
					</li>
					<li class="<?php echo ($url->segment(1)=='ready_install' ? 'current':'') ?> <?php echo (isset($_SESSION['installed'])? 'pass': '') ?>">
						<label><?php __("Ready to Install") ?></label>
					</li>
					<li class="<?php echo ($url->segment(1)=='complete' ? 'current':'') ?>">
						<label><?php __("Completed") ?></label>
					</li>
				</ul>
			</div>

			<div class="central-part">
					<form id="main_form" action="<?php echo ($url->segment(1) ? $url->segment(1) : 'start' ) ?>" method="POST">
					<?php 
						if(file_exists(__DIR__ . '/' . $url->segment(1) . '.php')) {
							include_once(__DIR__ . '/' . $url->segment(1) . '.php');
						}
						else
						{
							session_destroy();
							include_once(__DIR__ . '/start.php');
						}
					 ?>
					</table>
					<input id="token" type="hidden" name="_token" value="<?php echo \Wizaraty\Classes\Token::generate() ?>">
				</form>
			</div>
		</div>
	</div>
</body>
</html>
