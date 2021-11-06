<?php
require_once("utilities.php");
$host = "localhost";
$username = "admin";
$password = "admin";
$db = "finalproject";
$handler = mysqli_connect($host, $username, $password, $db) or die("Connection failed <br>" . mysqli_connect_error() . "<br>");


//validation
if( isset($_POST['email'])){
    $email = $_POST['email'];
    $email_pattern = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/i";

    if(preg_match($email_pattern, $email)){
        $query = "INSERT into email_list VALUES ('$email')";
        $insert = mysqli_query($handler, $query);

        if ($insert) {
            echo "
                <script>
                    alert('Your email has been added to our mailing list.');
                </script>";
                redirect();
        } else {
            echo "
            <script>
                alert('You are already in our mailing list!');
            </script>";
            redirect();
        }
    }
    else{
        echo "
            <script>
                alert('Your email is invalid.') </script>
            </script>";
        redirect();
    }
}

mysqli_close($handler);
exit;
?>

