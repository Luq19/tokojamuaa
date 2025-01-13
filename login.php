<?php
session_start();
include 'koneksi.php'
?>
<!DOCTYPE html>
<!-- Coding By CodingNepal - youtube.com/codingnepal -->
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>User Login</title>
    <link rel="stylesheet" href="admin/css/style.css">
    <link rel="stylesheet" type="text/css" href="admin/css/sb-admin-2.css">
  </head>
  <body>
    <div class="center">
      <h1>Login</h1>
      <form method="post">
        <div class="txt_field">
          <input type="text" name="email" required>
          <span></span>
          <label>Email</label>
        </div>
        <div class="txt_field">
          <input type="password" name="pass" required>
          <span></span>
          <label>Password</label>
        </div>
        <!-- <div class="pass">Forgot Password?</div> -->
        <button name="login" class="btn">Login</button>
        <!-- <?php if(isset($error)) : ?>
        <div class="alert alert-danger" role="alert">
        A simple danger alert—check it out!
        </div>
        <?php endif; ?> -->
        <div class="signup_link">
          Belum punya akun? <a href="register.php">daftar di sini</a>
        </div>
      </form>
    </div>
<!-- Bootstrap core JS-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>
<!-- Core theme JS-->
<script src="js/scripts.js"></script>
  </body>
</html>

<?php

if (isset($_POST['login'])) {
$email = $_POST['email'];
$password = $_POST['pass'];

//cek email
$sql = "SELECT * FROM pelanggan WHERE email_pelanggan='$email'";
$result = mysqli_query($koneksi, $sql);
   // if ($result->num_rows > 0) {
   if (mysqli_num_rows($result) > 0 ) {
     $row = mysqli_fetch_assoc($result);
     //cek password
     if (password_verify($password, $row['password_pelanggan']) ){
   
      $_SESSION['pelanggan'] = $row;
        if (isset($_SESSION["keranjang"]) OR !empty($_SESSION["keranjang"])) {
          header("Location: checkout.php");
          exit;
        }
        else {
          header("Location: index.php");
          exit;
        } 
             // else {
              
             //   <div class="alert alert-danger" role="alert">
             //     A simple danger alert—check it out!
             //   </div>
             //   echo "<script>alert('Maaf! email atau Password Salah.')</script>";
             // }

     }
  
    }

  echo '<div class="alert alert-danger">email atau Password Salah !!!</div>';
  }
?>