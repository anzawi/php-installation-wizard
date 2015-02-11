<?php
// check user information
if (isset($_GET['check'])) {
    Input::setSession('error', false);
    $error = array();
    if ($_POST['adminpassword'] != $_POST['repassword']) {
        $error['pass'] = 'password and repassword not matched !';
    }
    
    // check if email is correct
    if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $error['email'] = 'this email is not valid !';
    }

    // if no errors store admin information into session array called admin
    if (count($error) === 0) {
        Input::setSession('admin', array(
           'admin' => Input::get('adminusername'),
           'pass'  => Input::get('adminpassword'),
           'email' => Input::get('email')
        ));
        // redirect to next step
        header('Location:' . SITE . 'install.php?step=4');
        die();
    }
}

// check if error is true returned to previous step
if (Input::session('error') == 1) {
    // set error equal false
    Input::setSession('error', false);
    // redirect to previous step
    header('Location:' . SITE . 'install.php?step=2');
    die();
}

// set error equal true
Input::setSession('error', true);

// if step not 2 or 3 show error message and die the page
if (Input::session('step') != 2 && Input::session('step') != 3) {
    die('you cant accsess to this page direct !!!');
}

// set step to 3
Input::setSession('step', 3);
?>

<h2 class="page-header">STEP Three</h2>
<p class="text-left text-capitalize">
    enter Administrator Information <br>

    username and password for admin login..! <br>

    email to send password if forget or other messages.
</p>
</div>
<div class="col-lg-8 content">
    <form action="<?php SITE ?>install.php?step=3&check" method="POST">
        <table class="table">
            <tbody>
                <tr>
                    <td>Username </td>
                    <td><input class="input-sm" type="text" required="required" placeholder="Admin login Username" name="adminusername" value="<?php echo Input::get('adminusername'); ?>"></td>
                </tr>

                <tr>
                    <td>Password </td>
                    <td><input required="required" class="input-sm" id="dbname" type="password" placeholder="Admin password" name="adminpassword" value="<?php echo Input::get('adminpassword'); ?>"></td>
                </tr>

                <tr>
                    <td>Re Password </td>
                    <td>
                        <input required="required" class="input-sm" id="dbname" type="password" placeholder="re type Password" name="repassword" value="<?php echo Input::get('repassword'); ?>">
                        <span class="alert alert-danger error"><?php echo isset($error['pass']) ? $error['pass'] : '' ?></span>
                    </td>

                </tr>

                <tr>
                    <td>Admin Email </td>
                    <td>
                        <input required="required" class="input-sm" id="dbname" type="email" placeholder="Admin Email" name="email" value="<?php echo Input::get('email'); ?>">
                        <span class="alert alert-danger error"><?php echo isset($error['email']) ? $error['email'] : '' ?></span>
                    </td>
                </tr>
            </tbody>
        </table>

        <input class="btn btn-default" type="submit" value="Next Step">
    </form>
</div>