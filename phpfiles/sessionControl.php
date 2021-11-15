<?php
    require_once("phpfiles/utilities.php");
    //session control
    session_start();

    $_SESSION['timestamp'] = time();
    //Case: user inactive after 10 minutes
    if(time() - $_SESSION['last_login_timestamp'] > 600) {
        header("Location: http://localhost/finalproject/logout.php");
    }
    //Case: renew timestamp
    else {
        $_SESSION['last_login_timestamp'] = time();
    }
?>