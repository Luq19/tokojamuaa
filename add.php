<?php 
session_start();

//mendapatkan id produk dari url index
$id_produk = $_GET['id'];

//jika sudah ada produk tsb di cart maka jumlahnya +1
if (isset($_SESSION['keranjang'][$id_produk])) {
	$_SESSION['keranjang'][$id_produk]+=1;
}
// selain itu, tambahkan produk itu dengan jumlah 1
else {
	$_SESSION['keranjang'][$id_produk]=1;
}

// echo "<pre>";
// print_r($_SESSION);
// echo "</pre>";

//larikan ke halaman keranjang
echo "<script>alert('produk telah masuk ke keranjang belanja');</script>";
echo "<script>location='index.php';</script>"
?>
<!-- <!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title></title>
</head>
<body>
<script type="text/javascript"></script>
</body>
</html> -->