<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Sign up | Lectores</title>
   <link rel="stylesheet" href="../styles/sign-in.css">
   <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Geologica:wght@100..900&display=swap" rel="stylesheet">
</head>
<body>
  <div class="logo">
    <img src="../assets/images/lectores-removebg-preview.png" alt="" width="186.25" height="103.75">
    <div class="nav">
      <a href="sign-in.php" class="login">Login</a>
      <a href="sign-up.php" class="start">Start Selling</a>
</div>
  </div>
   <div class="form-container">
   <form class="form" method="post" action="sign-up.php">
       <p class="form-title">Create a new account</p>
       <div class="input-container">
        <input type="text" placeholder="Name" name="username"> 
        <input type="email" placeholder="Enter email" name="email"> 
      </div>
        <div class="input-container">
            <input type="text" placeholder="Username" name="user-nickname">
            <input type="text" placeholder="Phone-No." name="user-number">
          </div>
        <div class="input-container">
          <input type="password" placeholder="Create a  password" name="password">
          <input type="password" placeholder="Confirm password" name="confirm-password">
        </div>
         <button type="submit" class="submit" name="submit">
        Sign up
      </button>
      <p class="signup-link">
        Already have an account?
        <a href="sign-in.php" class="link">Sign in</a>
      </p>
   </form>
</div>
</body>
<script src="../scripts/prevent-right-click.js"></script>
</html>


<?php
//database variables
$host = 'localhost';
$user = 'root';
$password = '';
$dbname = 'USERDATA';

//connect to database
$conn = mysqli_connect($host, $user, $password, $dbname);

//save user data into variables
 
// Set the default timezone (change it to match your server's timezone)
date_default_timezone_set('UTC');

// Get the current date and time from the server
$currentDateTime = date('Y-m-d H:i:s');

// Output the current date and time




 
 
 

//database query
if(isset($_POST['submit'])){
  $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_SPECIAL_CHARS);
  $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
  $user_nickname = filter_input(INPUT_POST, 'user-nickname', FILTER_SANITIZE_SPECIAL_CHARS);
  $user_number = filter_input(INPUT_POST, 'user-number', FILTER_SANITIZE_NUMBER_INT);
  $password = $_POST['password'];
  $confirm_password = $_POST['confirm-password'];

  if(!empty($username) && !empty($email) && !empty($user_nickname) && !empty($user_number) && !empty($password) && !empty($confirm_password)){
    if($password === $confirm_password){
      //check password length
      if(strlen($password) < 8){
        echo "Password too short";
      }else{
        $hash_password = password_hash($password, PASSWORD_DEFAULT);
      //check if user exists
      $check_1 = "SELECT * FROM users WHERE user_email = '$email'";
      $result_1 = mysqli_query($conn, $check_1);
      $check_2 = "SELECT * FROM users WHERE user_nickname = '$user_nickname'";
      $result_2 = mysqli_query($conn, $check_2);
      if(mysqli_num_rows($result_1) > 0){
        echo"<script> alert('User with the specified email-address already exists.');</script>";
      }else if(mysqli_num_rows($result_2) > 0){
        echo"<script> alert('User with the specified username already exists.');</script>";
      }else{
        $sql = "INSERT INTO users (user_name, user_email, user_nickname, user_number, user_password, subStatus, paidDate, dueDate) VALUES ('$username', '$email', '$user_nickname', '$user_number', '$hash_password', true, '2024-01-02 20:24:44', '2024-01-02 20:24:44')";
        $add = mysqli_query($conn, $sql);
        if($add){
          echo"<script> alert('Sign up sucessful');</script>";
          header("Location: ../confirmation.html");
        }
      }
      }
      
    }else{
      echo"Password does not match"; 
    }
  }
}

mysqli_close($conn);
?>