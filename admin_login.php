<?php
session_start();
include "PHP/connection.php";
include "PHP/functions.php";
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $usernameErr = "SELECT username FROM admin_tbl WHERE username='$username'";
    $usernameErrResult = mysqli_query($con, $usernameErr);

    $passwordErr = "SELECT username FROM admin_tbl WHERE password='$password'";
    $passwordErrResult = mysqli_query($con, $usernameErr);

    $errors = [];

    if (empty($username)) {
        $errors['u'] = 'no username';
    }

    if (empty($password)) {
        $errors['p'] = 'no password';
    }

    if (count($errors) == 0) {
        $query = "SELECT * FROM admin_tbl where username = '$username' limit 1";
        $result = mysqli_query($con, $query);

        if ($result) {
            if ($result && mysqli_num_rows($result) > 0) {
                $user_data = mysqli_fetch_assoc($result);

                if ($user_data['password'] === $password) {
                    $_SESSION['admin_id'] = $user_data['admin_id'];
                    header("Location: admin_index.php");
                    die();
                }
            }
        }
        $errors['up'] = "wrong username or password";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script
      src="https://kit.fontawesome.com/64d58efce2.js"
      crossorigin="anonymous"
    ></script>
    <link rel="stylesheet" href="CSS/psignup.css" />
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->
    <title>Login</title>
    <style>
      .style{
				color: #000000;
				border-bottom: 2px solid #8f1b1c;
        background: #fadadb;
				padding: 10px;
      }
    </style>
  </head>
  <body>

<div class="wrapper fadeInDown">
<a href="index.php" class="back"><i class="fas fa-arrow-circle-left"></i></a>
  <div id="formContent">
    
    <!-- Icon -->
    <div class="fadeIn first">
      <img src="IMG/b2.png" id="icon" alt="User Icon" />
    </div>
    <h2>Admin Login</h2>
    <!-- Login Form -->
    <form action="#"  method="POST">
      <p style="color:red;"><?php if (isset($errors['up'])) {
          echo $errors['up'];
      } ?></p><br>
      <i class="fas fa-user"></i><input type="text" id="login" class="fadeIn second" name="username" placeholder="Username"/>
      <p style="color:red;"><?php if (isset($errors['u'])) {
          echo $errors['u'];
      } ?></p><br>
      <i class="fas fa-lock"></i><input type="password" id="password" class="fadeIn third" name="password" placeholder="Password"/>
      <p style="color:red;"><?php if (isset($errors['p'])) {
          echo $errors['p'];
      } ?></p><br>
      <input type="submit" class="fadeIn fourth" value="Log In">
    </form>

    <!-- Remind Passowrd -->
    <div id="formFooter">
    <a class="underlineHover" href="adminforgot.php">Forgot Password?</a><br>
    </div>

  </div>
</div>
  </body>
</html>