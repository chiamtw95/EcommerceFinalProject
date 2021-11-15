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

//Validation tools
$name_pattern = "/^([a-zA-Z' ]+)$/";
$city_pattern = "/^([a-zA-Z ]+)$/";
//Sanitizing tools
function sanitize ($str){
    $str = addslashes($str);
    $str = htmlspecialchars($str);
    return $str;
}
