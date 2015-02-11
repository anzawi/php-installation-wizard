<?php

// set step equal 1
Input::setSession('step', 1);

// create object from CheckRequired class
$req = new CheckRequired();

// by default pdo label class is badge-success
$pdoLabel = 'badge badge-success';
// by default pdo is installed
$pdoOk = true;
// if pdo not installed set  pdo label class badge-danger and $pdoOk to false
if (!$req->pdo()) {
    $pdoLabel = 'badge badge-danger';
    $pdoOk = false;
}
//  ...
$phpLabel = 'badge badge-success';
$phpOk = true;
$phpV = $req->whatePhpVirsion();
if (!$req->php()) {
    $phpLabel = 'badge badge-danger';
    $phpOk = false;
}
// .. 
$safeLabel = 'badge badge-success';
$safeOk = true;
if (!$req->safeMode()) {
    $safeLabel = 'badge badge-danger';
    $safeOk = false;
}

// if any error happened set error session equal true to deny access step 2
$error = $req->errors();
if ($error) {
    Input::setSession('error', true);
}
?>

<h2 class="page-header">STEP ONE</h2>
<p class="text-left text-capitalize">
    Check requirement , if any error Shown you must be contact with your host support to Fix it. <br>
</p>
</div>
<div class="col-lg-8 content">
    <div class="row">
        <div class="block-content collapse in">
            <div class="span12">
                <table class="table">
                    <thead>
                        <tr style="font-family: cursive;">
                            <th>Requirement</th>
                            <th class="th">Status</th>
                            <th class="th">Notes</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><label class="alert alert-info">   PDO Extention :  </label> </td>
                            <td> <span class="<?php echo $pdoLabel ?>"><?php echo $pdoOk ? 'Installed' : 'Not Installed' ?></span></td>
                            <td><p class="text-left text-capitalize"><?php echo $pdoOk ? 'No Errors' : 'Error <br> contact with your web hosting to enable PDO extention to your Site' ?></p></td>
                        </tr>
                        <tr>
                            <td><label class="alert alert-info">   PHP Version :  <?php echo $phpV ?></label> </td>
                            <td> <span class="<?php echo $phpLabel ?>"><?php echo $phpOk ? '> or =' : '<'; ?> 5.3 </span></td>
                            <td><p class="text-left text-capitalize"><?php echo $phpOk ? 'No Errors' : 'Error <br> contact with your web hosting to upgrade PHP version' ?></p></td>
                        </tr>
                        <tr>
                            <td><label class="alert alert-info">   Safe Mode :</label> </td>
                            <td> <span class="<?php echo $safeLabel ?>"><?php echo $safeOk ? 'OFF' : 'ON'; ?> </span></td>
                            <td><p class="text-left text-capitalize"><?php echo $safeOk ? 'No Errors' : 'Error <br> Turn Off Safe Mode and try again' ?></p></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <a class="btn btn-default glyphicon <?php echo $error ? 'disabled' : '' ?>" href="<?php echo $error ? '#' : '?step=2' ?>">Next Step</a>
