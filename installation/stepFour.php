<?php
// set step equal 4
Input::setSession('step', 4);

// to store errors if find
$error = array();

// create object from createDbAndOtherTransAction class
$db = new createDbAndOtherTransAction();

// include file has sql statements
include_once 'sql.php';

/*
 * if get param 'tables' from url create tables .
 * the $sql is var in sql.php file store tables structers
 * -------
 * in InitializedDatabase.js file i will be set target to this file and add parameter table or tran to create tables first and after that Performs input operations on those tables
 */
if (isset($_GET['tables'])) {
    if (!$db->create($sql))
        $error[] = 'Can\'t Creat Tables !!';
}
if (isset($_GET['tran'])) {
    if (!$db->transaction($insertAdminInformation))
        $error[] = 'Can\'t Insert Admin Information';
}
?>

<h2 class="page-header">STEP Four</h2>
<p class="text-left text-capitalize">
    <strong>Creating Database Tables</strong>

    <br>
    Please Wait When Initialized Database..  
</p>
</div>

<div class="col-lg-8 content">
    <!-- error section shown if any error happened  -->
    <?php if (count($error) > 0) { ?>
        <div style="width: 100%">
            <h3>Errors</h3> <small>pending</small>
            <div style="text-align: center;">
                <?php
                foreach ($error as $ero) {
                    ?>
                    <span class="alert alert-danger"><?php echo $ero ?></span> <br>

                    <?php }  ?>
                </div>
            </div>


        <?php } ?>





        <div style="width: 100%">
            <h3>Creating Tables</h3> <small id="tableser">pending.....</small>
            <div id="tablesDiv" style="text-align: center;">
                <img id="tables"  src="<?php echo SITE ?>installation/css/loader.gif">
            </div>
        </div>
        <div class="clearfix"></div>

        <div style="width: 100%">
            <h3>Process other database transaction</h3><small id="othersqler">pending.....</small>
            <div id="othersqlDiv" style="text-align: center;">
                <img id="othersql"  src="<?php echo SITE ?>installation/css/loader.gif">
            </div>
        </div>
    </div>

    <script type = "text/javascript" src="<?php echo SITE ?>installation/InitializedDatabase.js"></script>