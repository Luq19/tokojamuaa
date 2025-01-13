<?php
session_start();
include 'koneksi.php'
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Login</title>
    <link rel="stylesheet" href="css/style.css">
  </head>
  <body>
    <div class="center">
      <h1>Login</h1>
      <form method="post">
        <div class="txt_field">
          <input type="text" name="user" required>
          <span></span>
          <label>Username</label>
        </div>
        <div class="txt_field">
          <input type="password" name="pass" required>
          <span></span>
          <label>Password</label>
        </div>
        <!-- <div class="pass">
          <input type="checkbox" class="custom-control-input" id="customCheck">
          <label class="custom-control-label" for="customCheck">Remember Me</label>
        </div> -->
        <!-- <div class="pass">Lupa Password?</div> -->
        <button name="login" class="btn">Login</button>
        <div class="signup_link">
          <!-- Tidak Punya Akun? <a href="#">Daftar Di sini</a> -->
        </div>
      </form>
      <?php

          if (isset($_POST['login'])) {
            $username = $_POST['user'];
            $password = $_POST['pass'];

            $sql = "SELECT * FROM admin WHERE username='$username' AND password='$password'";
            $result = mysqli_query($koneksi, $sql);
            if ($result->num_rows > 0) {
              $row = mysqli_fetch_assoc($result);
              $_SESSION['admin'] = $row;
              header("Location: index.php");
            } else {
              
              // <div class="alert alert-danger" role="alert">
              //   A simple danger alert—check it out!
              // </div>
              echo "<script>alert('Maaf! Username atau Password Salah.')</script>";
            }
          }
      ?>
    </div>

  </body>
</html>
