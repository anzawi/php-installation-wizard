<?php 
include_once(__DIR__ . '/../includes/server_requirements.php');
use Wizaraty\Classes\Config;
?>
<?php if(!$requerment->pass()) : ?>
	<div class="alert alert-error"><h3><?php __("Oops ...") ?> </h3><?php foreach($requerment->getErrors() as $error): ?><?php echo trim($error) ?>. <br><?php endforeach; ?></div>
<?php endif ?>
<table width="99%" cellspacing="2" cellpadding="0" border="0">

	<tbody>
	<tr>
		<td>Server Info  : <span class="found"><?php echo ucwords(str_replace('_', ' ', $requerment->getServerOS()))?></span></td>

		<td><span class="passed"><?php __("passed") ?></span></td>
		<?php unset($req['server_info']) ?>
	</tr>
		<?php foreach($req as $theRequerment => $pass): ?>
			<tr>
				<td><?php echo preg_replace('/(?<!\ )[A-Z]/', ' $0',$theRequerment) ?></td>

				<td><?php echo ($pass ? '<span class="passed">' . _x("passed") . '</span>': '<span class="fail">' . _x("Faild") . '</span>') ?>
				</td>
			</tr>
		<?php endforeach;?>
	</tbody>
<tr><td nowrap="nowrap" height="30px"></td></tr>
<tr>
	<td>
		<?php if($requerment->pass()) : ?>
			<input class="form_button" type="submit" value="Continue" name="req_is_pass">
		<?php else: ?>
			<input class="form_button fail" type="submit" disabled="disabled" value="<?php __("Continue") ?>" name="fail">
		<?php endif; ?>
	</td>
</tr>

</table>