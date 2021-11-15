<?php
require_once("dbcontroller.php");
require_once("utilities.php");
session_start();
$db_handle = new DBController();
$res = $db_handle->runQuery("SELECT * FROM users WHERE email='" . $_SESSION["email"] . "'");
            $account_details = array(
                                    'email' => $res[0]["email"],
                                    'password' => $res[0]["password"],
                                    'fullname' => $res[0]["name"]
                                );


//Case: Name Change
if ($_POST['fullname'] != $account_details['fullname'] &&
    preg_match($name_pattern, $_POST['fullname'])) {

    $name = sanitize($_POST['fullname']);
    $query =$mysqli ->prepare("UPDATE users SET name = ? WHERE email = ?");
    $query ->bind_param("ss", $name, $account_details['email']);
    $status = $query -> execute();

    if($status)
        $_SESSION['update_success_name'] = true;
    else
        $_SESSION['update_success_name'] = false;
}

//Case: Password Change
//check for filled form first
if (isset($_POST['oldPassword']) &&
    isset($_POST['newPassword']) &&
    isset($_POST['repeatPassword'])
){
    //then check whether the correct old and new passwords are entered
    if(password_verify($_POST['oldPassword'], $account_details['password']) &&
        !password_verify($_POST['newPassword'], $account_details['password']) &&
        $_POST['newPassword'] == $_POST['repeatPassword']
    ){
        $password = password_hash($_POST['newPassword'],PASSWORD_DEFAULT);
        $query =$mysqli ->prepare("UPDATE users SET password = ? WHERE email = ?");
        $query ->bind_param("ss", $password, $account_details['email']);
        $status = $query -> execute();

        if($status)
            $_SESSION['update_success_password'] = true;
        else
            $_SESSION['update_success_password'] = false;
    }
    else
        $_SESSION['update_success_password'] = false;
}
//redirects to account page
header("Location: http://localhost/finalproject/myAccount.php");
$mysqli->close();
exit;
?>

