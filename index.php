<?php
    include'database.php';
    include'classes.php';
    $conn = new mysqli("localhost", "root", "", "todolist");
    if (isset($_POST["submit"])) {
        $username = strip_tags(trim($_POST['username']));
        $email = strip_tags(trim($_POST['email']));
        $password = $_POST['password'];
        $password_encrypted = md5($password);
        //check fields for errors
        $users = new User();
        if($users->check_for_login_errors($username, $email, $password) == true) {
        $result = $conn->query("SELECT * FROM users WHERE username = '$username' AND password = '$password_encrypted'");
        ///create var for id and assign to session for later use
        $get_id = $conn->query("SELECT id FROM users WHERE username = '$username'");
        $ids = mysqli_fetch_assoc($get_id);
        if($result->num_rows > 0) {
            session_start();
            //assign session variable and create logged in var
            $_SESSION["username"] = $username;
            $_SESSION["email"] = $email;
            $_SESSION["password"] = $password;
            $_SESSION["logged_in"] = 1;
            $_SESSION['user_id'] = $ids['id'];
            $id = $_SESSION['user_id'];
            //if everything checks out, send them to their todolist
            header('location:pages/todo.php');
            exit(); 
        } else {
            echo 'The information provided does not match any users in our system, please register below.';
        }
      }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/styles.css">
    <title>Login Page</title>
</head>
<?php include'includes/header.php';?>
<body>
    <div class="home-container">
    <div class="homeLogin">
    <h1 class="headers">Login</h1>
    <form action="index.php" method="post" class="loginForm">
        <label for="name">Username</label><br>
        <input type="text" name="username" placeholder="Username"><br>
        <label for="email" >Email</label><br>
        <input type="text" name="email" placeholder="Email"><br>
        <label for="password" >Password</label><br>
        <input type="text" name="password" placeholder="Password"><br>
        <input name="submit" type="submit" class="login submit">
    </form>
    </div>
    <div class="register">
        <p>Need to get registered? Click below!</p>
        <h2 class="registerLink"><a href="pages/register.php"> Register </a></h2>
    </div>
    </div>
</body>
<?php include'includes/footer.php';?>
</html>