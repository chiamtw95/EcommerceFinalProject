<?php
//connection utils
$mysqli = new mysqli("localhost", "admin", "admin", "finalproject");

//Function to redirect to main page
function redirect(){
    echo "
        <script>
            window.location.href='http://localhost/finalproject';
        </script>";
}
//Function to alert
function alert($msg) {
    echo "<script type='text/javascript'>alert('$msg');</script>";
}

//
//Sanitizing tools
//
function sanitize ($str){
    $str = addslashes($str);
    $str = htmlspecialchars($str);
    return $str;
}
    