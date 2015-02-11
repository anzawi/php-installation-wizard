<?php 
 // check if step not 4 or 5 die the page and show error message
if (Input::session('step') != 4 && Input::session('step') != 5) {
    die('you cant accsess to this page direct !!!');
}
// set step equal 5
Input::setSession('step', 5);
?>


<h2 class="page-header">STEP Five</h2>
<p class="text-left text-capitalize">
    <strong>delete Installation Files</strong> <br>
    choose <strong>Delete Now </strong> and files are deleted automatically. <small>(Recommended)</small> <br>

    Or 
    <br>
    choose <strong>manually </strong> to delete the files manually from the hosting <small>(Not Recommended)</small>
</p>
</div>
<div class="col-lg-8 content">
    <h3>
        Delete Installation Files 
    </h3>
    <small><strong>Note</strong> if installation files does not be deleted. your site doesn't work correctly</small>
    <hr>
    <div class="row">
        <div class="col-lg-6">
            <!-- this link to delete files automatically its redirect to uninstall.php file -->
            <a class="btn btn-primary pull-left" style="width:70%; height: 40px; font-size: 18px;" href="<?php echo SITE ?>uninstall.php?uninstall">Delete Now</a>
        </div>
        <div class="col-lg-6">
            <!-- this link if user want delete files manually its redirect to login form direct -->
            <a class="btn btn-default pull-left" href="<?php echo SITE ?>admin/login.php">Delete Manually</a>
        </div>
    </div>
</div>