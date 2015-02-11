<?php
session_start();
if (isset($_POST['login'])) {
    $conn = mysql_connect($_SESSION['db']['host'], $_SESSION['db']['user'], $_SESSION['db']['pass']);
    mysql_select_db($_SESSION['db']['db']);

    $sql = "SELECT * FROM users WHERE {$_SESSION['db']['pr']}username = '{$_POST['username']}' AND pass = '{$_POST['password']}'";

    $query = mysql_query($sql);

    $result = mysql_fetch_array($query);

    if (mysql_num_rows($result) > 0) {

        $message = "You Now Enterd Admin Panel";
    } else {
        $message = "Sorry This User is Not Admin ... !";
    }

    session_destroy();
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Log in Form</title>
    </head>

    <body>
    <center><h3 style="color: red;"><?php echo isset($message) ? $message : '' ?></h3></center>
    <form action="" method="post">
        <input name="username" value="<?php echo $_SESSION['admin']['admin'] ?>">
        <input name="password" value="<?php echo $_SESSION['admin']['pass'] ?>">

        <input type="submit" value="Login" name="login">
    </form>
</body>

</html>

