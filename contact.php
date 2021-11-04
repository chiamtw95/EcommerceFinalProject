<!-- header -->
<?php include 'templates/header.php';?>

<!-- body -->
<main class="index">

    <div class="intro">
        <h1>Contact us!</h1>
        <p>If you have any enquiries, please fill in the form below and our team will get in touch with you. </p>
    </div>

    <div class="form-container">
        <form class="enquiry" action="phpfiles/enquiry_insert.php" method="POST">
            <div>
                <label for="fullname">Fullname: </label>
                <input type="text" name="fullname" id="fullname"><br>

                <label for="email">Email: </label>
                <input type="email" name="email" id="email"><br>

                <label for="msg">Your enquiry: </label>
                <textarea rows="20" name="msg" id="msg"></textarea> <br>

                <input type="submit" value="Submit enquiry">
            </div>
        </form>
    </div>

<!-- footer -->
<?php include 'templates/footer.php';?>