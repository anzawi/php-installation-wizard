<?php 

if($_POST)
{
	if(in_array($_POST['lang'], \Wizaraty\Classes\Config::get("enabled_lang")))
		$_SESSION['lang'] = $_POST['lang'];
	else
		$_SESSION['lang'] = defualtLang();

	header('location:server_requirements');
}

?>
	<h2><?php __("Installation Language") ?></h2>
	<?php __("Select Installation Language : ") ?>
	<select name="lang">
	<?php foreach (\Wizaraty\Classes\Config::get("enabled_lang") as $lang):?>
		<option value="<?php echo $lang ?>">
			<?php echo languageName($lang) ?>
		</option>
	<?php endforeach;?>
	</select>
	<br>
	<h2><?php __("License :") ?></h2>
	<small><?php __("type any key !!") ?></small>
	<br>
	<?php __("Enter License Key :") ?><input value="1852 - 7418 - 9654 - 1025 - 9874" type="text" name="lic" class="input-lic">

<br>
	<input type="submit" value="&rarr;" class="cont form_button">
