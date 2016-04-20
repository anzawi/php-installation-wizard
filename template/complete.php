<?php 
if(!isset($_SESSION['admin']))
{
	header('location:start');
}

$_SESSION['installed'] = true;
use Wizaraty\Classes\Config;
?>

<div class="complete_installation">
	<h4>Thank You</h4>

	<p>
		<?php __(Config::get('complete_message')) ?>
	</p>

	<input id="botton" type="button" name="login" class="form_button" value="<?php __("Go to Login") ?>">
</div>

