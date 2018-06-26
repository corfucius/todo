<?php
    // require('../database.php');

    include'../classes.php';

    if ( isset($_POST['submit']) ) {
        $username = strip_tags(trim( $_POST['username']));
        $email = strip_tags(trim( $_POST['email']));
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];
        $users = new User();
        $check_fields = $users->check_for_login_errors($username, $email, $password);
        if($check_fields === TRUE) {
        $users->validate_create_form($username, $password, $email, $confirm_password);
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../css/styles.css">
    <title>Registration</title>
</head>
<?php include'../includes/header.php';?>
<body>
    <div class="register-container">
        <h2 class="headers">Fill out the form below to register</h2>
            <form action="register.php" method="post" class="registerForm">
                <label for="username">Username</label><br>
                <input type="text"  name="username" placeholder="Username"><br>
                <label for="userEmail" >Email</label><br>
                <input type="text" name="email" placeholder="Email"><br>
                <label for="userName" >Password</label><br>
                <input type="text" name="password" placeholder="Password"><br>
                <label for="userPassword" >Confirm Password</label><br>
                <input type="text" name="confirm_password" placeholder="Confirm Password"><br>
                <input type="submit" class="register submit" name="submit">
            </form>
    </div>
</body>
<?php include'../includes/footer.php';?>
</html>