<?php
// if user test connection set error to false to allow access this step...!!!
if (isset($_GET['test'])) {
    Input::setSession('error', false);
}

//echo Input::session('error');
// is error equal true redirect to step 1
if (Input::session('error') == 1) {
    Input::setSession('error', false);
    header('Location:' . SITE . 'install.php?step=1');
    die();
}

// set error equal true
Input::setSession('error', true);

// set step equal 2
Input::setSession('step', 2);

// if user test connection get the information and call function testConnection
if (isset($_GET['test'])) {
    if (testConnection($_GET['hostname'], $_GET['username'], $_GET['password'], $_GET['dbname'], $_GET['pref'])) {
        // if testConnection return true set testConnection session success message
        Input::setSession('testConnection', 'Success .. we Can Connect with Your Database :) ');
        Input::setSession('error', false);
        $connClass = 'label label-success';
    } else {
        Input::setSession('testConnection', 'Fail : Ooops .. we Can\'t See Or Connect with Database .. ) ');
        $connClass = 'label label-danger';
        Input::setSession('error', true);
    }
}
?>
<h2 class="page-header">STEP TOW</h2>
<p class="text-left text-capitalize">
    enter database and host information <br>
    enter correct information and click test connection <br>
    if success test go to next step if not check information !
</p>
</div>
<div class="col-lg-8 content">
    <form action="<?php SITE ?>install.php?step=3" method="POST">
        <table class="table">
            <tbody>
                <tr>
                    <td>Host Name </td>
                    <td><input class="input-sm" id="host" type="text" placeholder="eg: localhost" name="hostname" value="<?php echo Input::get('hostname'); ?>"></td>
                </tr>

                <tr>
                    <td>Database Name </td>
                    <td><input class="input-sm" id="dbname" type="text" placeholder="eg: my_database" name="dbname" value="<?php echo Input::get('dbname'); ?>"></td>
                </tr>

                <tr>
                    <td>Database Username </td>
                    <td><input class="input-sm" id="username" type="text" placeholder="eg: root" name="username" value="<?php echo Input::get('username'); ?>"></td>
                </tr>

                <tr>
                    <td>Database Password </td>
                    <td><input class="input-sm" id="pass" type="password" placeholder="eg: password" name="password" value="<?php echo Input::get('password'); ?>"></td>
                </tr>

                <tr>
                    <td>Tables Prefix </td>
                    <td><input class="input-sm" id="prefix" type="text" placeholder="eg: Mo_" name="pref" value="<?php echo Input::get('pref'); ?>"></td>
                </tr>
            </tbody>
        </table>
        <input class="btn btn-default <?php echo $connClass == 'label label-success' ? '' : 'disabled' ?>" type="submit" value="Next Step">
    </form>
    <button id="test" class="btn btn-info small" onclick="testConntection()">Test Connection</button> <br><br>
    <span class="alert <?php echo $connClass ?>"><?php echo Input::session('testConnection') ?></span>

</div>
<script type="text/javascript">
    function testConntection() {
        // disable test button
        document.getElementById('test').setAttribute('disabled', 'disabled');
        // write on test button
        document.getElementById('test').innerHTML = 'Test Connection Pleas Wait .... ';

        // get page url
        var url = document.URL;
        url = url.substring(0, url.indexOf('2') + 1);
        var host = '', username = '', pass = '', dbname = '', pref = '', action = '';

        // get database connection information
        host = document.getElementById('host').value;
        username = document.getElementById('username').value;
        pass = document.getElementById('pass').value;
        dbname = document.getElementById('dbname').value;
        pref = document.getElementById('prefix').value;

        // refresh page and pass database var's
        action = '&test&hostname=' + host + '&username=' + username + '&password=' + pass + '&dbname=' + dbname + '&pref=' + pref;
        window.location.href = url + action;
    }
</script>

<?php
Input::deleteSession('testConnection'); // delete message
?>