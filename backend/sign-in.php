 <!DOCTYPE html>
 <html lang="en">
 <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign in | Lectores</title>
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
    <div class="form-container">
    <form class="form" method="post" action="sign-in.php">
        <p class="form-title">Sign in to your account</p>
         <div class="input-container">
           <input type="email" placeholder="Enter email" name="email">
           <span>
           </span>
       </div>
       <div class="input-container">
           <input type="password" placeholder="Enter password" name="password">
         </div>
          <button type="submit" class="submit" name="submit">
         Sign in
       </button>
    
       <p class="signup-link">
         No account?
         <a href="sign-up.php" class="link">Sign up</a>
       </p>
    </form>
</div>
 </body>
 <script src="../scripts/prevent-right-click.js"></script>
 </html>

<?php
$host = 'localhost';
$user = 'root';
$password = '';
$dbname = 'USERDATA';

$conn = mysqli_connect($host, $user, $password, $dbname);




if(isset($_POST['submit'])){

  $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
  $password = $_POST['password'];

  if(!empty($email) && !empty($password)){
    $check = "SELECT * FROM users WHERE user_email = '$email'";
    $result = mysqli_query($conn, $check);

    if(mysqli_num_rows($result) > 0){
      $row = mysqli_fetch_assoc($result);
      $user_nickname = $row["user_nickname"];
      $user_password = $row["user_password"];
      if(password_verify($password, $user_password)){
       header("Location: home.php");
      }else{
        echo"<script> alert('Incorrect password');</script>";
      }
    }else {
      echo"<script> alert('User not found');</script>";
    }
  }
}

mysqli_close($conn);
?>