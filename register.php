<?php 

include 'koneksi.php';

error_reporting(0);

session_start();

if (isset($_SESSION['pelanggan'])) {
    header("Location: index.php");
}

if (isset($_POST['submit'])) {
	$email = strtolower(stripslashes($_POST['email']));
	$nama = $_POST['nama'];
	$notelp = $_POST['notelp'];
	$password = $_POST['pass'];
	$cpassword = $_POST['cpass'];

	if ($password == $cpassword) {
		$password = password_hash($password, PASSWORD_DEFAULT);
		//cek email
		$sql = "SELECT * FROM pelanggan WHERE email_pelanggan='$email'";
		$result = mysqli_query($koneksi, $sql);
		if ($result->num_rows === 0) {
				// code...
			$sql = "INSERT INTO pelanggan (email_pelanggan, password_pelanggan, nama_pelanggan, telepon_pelanggan)
						VALUES ('$email', '$password', '$nama', '$notelp')";
			$result = mysqli_query($koneksi, $sql);
				if ($result) {
					echo "<script>alert('Akun Berhasil Dibuat!.')</script>";
						$email = "";
						$nama = "";
						$notelp = "";
						$_POST['pass'] = "";
						$_POST['cpass'] = "";
						}
			} 
		else {
			echo "<script>alert('Maaf, Email sudah terdaftar dengan akun lain.')</script>";
		}
		
	} 
	else {
		echo "<script>alert('Password Tidak Sesuai.')</script>";
		}
	}

?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Register email</title>
    <link rel="stylesheet" href="admin/css/style.css">
    
  </head>
  <body>
    <div class="center">
      <h1>Daftar Akun Baru</h1>
      <form method="post">
        <div class="txt_field">
          <input type="text" name="nama" value="<?= $nama; ?>" required >
          <span></span>
          <label>Nama</label>
        </div>
        <div class="txt_field">
          <input type="text" name="email" value="<?= $email; ?>" required>
          <span></span>
          <label>Email</label>
        </div>
        <div class="txt_field">
          <input type="text" name="notelp" value="<?= $notelp; ?>" required>
          <span></span>
          <label>No.Telp</label>
        </div>
        <div class="txt_field">
          <input type="password" name="pass" value="<?= $_POST['pass']; ?>" required>
          <span></span>
          <label>Password</label>
        </div>
        <div class="txt_field">
          <input type="password" name="cpass" value="<?= $_POST['cpass']; ?>" required>
          <span></span>
          <label>Konfirmasi Password</label>
        </div>
        <button name="submit" class="btn">Daftar</button>
        <div class="signup_link">
          Klik <a href="login.php">di sini</a> untuk login
        </div>
      </form>
    </div>
<!-- Bootstrap core JS-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>
<!-- Core theme JS-->
<script src="js/scripts.js"></script>
  </body>
</html>