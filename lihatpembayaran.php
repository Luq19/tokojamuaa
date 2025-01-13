<?php 
session_start();

// echo "<pre>";
// print_r($_SESSION['pelanggan']);
// echo "</pre>";

include'koneksi.php';

// if (!isset($_SESSION["pelanggan"]) OR empty($_SESSION["pelanggan"])) {
// 	echo "<script>alert('Silakan Login!');</script>";
// 	echo "<script>location='login.php';</script>";
// }

// mendapatkan id_pembelian dari url
$idpembelian = $_GET["id"];
$ambil = $koneksi->query("SELECT * FROM pembayaran 
	LEFT JOIN pembelian ON pembayaran.id_pembelian=pembelian.id_pembelian 
	WHERE pembelian.id_pembelian='$idpembelian'");

$pecah = $ambil->fetch_assoc();

// echo "<pre>";
// print_r($pecah);
// echo "</pre>";

//mendapatkan id pembeli
$idpembeli = $pecah["id_pelanggan"];

//mendapatkan id pelanggan yang login
$idpelanggan = $_SESSION["pelanggan"]["id_pelanggan"];

if (empty($pecah)) {
	echo "<script>alert('anda belum melakukan pembayaran untuk pembelian ini!');</script>";
	echo "<script>location='riwayat.php';</script>";
	exit();
}

//jk pelanggan membuka pembayaran milik pelanggan lain
if ($_SESSION['pelanggan']['id_pelanggan'] !== $pecah['id_pelanggan']) {
	echo "<script>alert('anda tidak berh pembelian ini!');</script>";
	echo "<script>location='riwayat.php';</script>";

}
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Toko Jamu AA</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all,follow">
    <!-- Bootstrap CSS-->
    <link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">
    <!-- Lightbox-->
    <link rel="stylesheet" href="vendor/lightbox2/css/lightbox.min.css">
    <!-- Range slider-->
    <link rel="stylesheet" href="vendor/nouislider/nouislider.min.css">
    <!-- Bootstrap select-->
    <link rel="stylesheet" href="vendor/bootstrap-select/css/bootstrap-select.min.css">
    <!-- Owl Carousel-->
    <link rel="stylesheet" href="vendor/owl.carousel2/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="vendor/owl.carousel2/assets/owl.theme.default.css">
    <!-- Google fonts-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Libre+Franklin:wght@300;400;700&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Martel+Sans:wght@300;400;800&amp;display=swap">
    <!-- theme stylesheet-->
    <link rel="stylesheet" href="css/style.default.css" id="theme-stylesheet">
    <!-- Custom stylesheet - for your changes-->
    <link rel="stylesheet" href="css/custom.css">
    <!-- Favicon-->
    <link rel="shortcut icon" href="img/favicon.png">
    <!-- Tweaks for older IEs--><!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
  </head>
  <body>
    <div class="page-holder">
      <!-- navbar-->
     <?php include 'navbar.php' ?>
     <!-- content -->
     <section class="content">
		<div class="container">
      <section class="py-5 bg-light">
          <div class="container">
            <div class="row px-4 px-lg-5 py-lg-4 align-items-center">
              <div class="col-lg-6">
                <h2 class="h2 text-uppercase mb-0">Lihat Pembayaran</h2>
              </div>
              <div class="col-lg-6 text-lg-right">
                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb justify-content-lg-end mb-0 px-0">
                    <li class="breadcrumb-item"><a href="invoice.php?id=<?= $pecah["id_pembelian"]; ?>">Invoice</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Pembayaran</li>
                  </ol>
                </nav>
              </div>
            </div>
          </div>
        </section><br>
    <h3>Detail Pembayaran</h3><br>
		<div class="row">
		<div class="col-md-6">
			<table class="table">
				<tr>
					<th>Nama Penyetor</th>
					<td><?= $pecah['nama']; ?></td>
				</tr>
				<tr>
					<th>Bank</th>
					<td><?= $pecah['bank']; ?></td>
				</tr>
				<tr>
					<th>Jumlah</th>
					<td>Rp. <?= number_format($pecah['jumlah']); ?></td>
				</tr>
				<tr>
					<th>Tanggal</th>
					<td><?= $pecah['tanggal']; ?></td>
				</tr>
			</table>		
		</div>
		<div class="col-md-6">
			<img src="bukti_pembayaran/<?= $pecah['bukti']; ?>" class="img-responsive"	height="30%">
		</div>
		</div>
		</div>
	</section>
     <?php include 'footer.php' ?>
      <!-- JavaScript files-->
      <script src="vendor/jquery/jquery.min.js"></script>
      <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
      <script src="vendor/lightbox2/js/lightbox.min.js"></script>
      <script src="vendor/nouislider/nouislider.min.js"></script>
      <script src="vendor/bootstrap-select/js/bootstrap-select.min.js"></script>
      <script src="vendor/owl.carousel2/owl.carousel.min.js"></script>
      <script src="vendor/owl.carousel2.thumbs/owl.carousel2.thumbs.min.js"></script>
      <script src="js/front.js"></script>
      <script>
        // ------------------------------------------------------- //
        //   Inject SVG Sprite - 
        //   see more here 
        //   https://css-tricks.com/ajaxing-svg-sprite/
        // ------------------------------------------------------ //
        function injectSvgSprite(path) {
        
            var ajax = new XMLHttpRequest();
            ajax.open("GET", path, true);
            ajax.send();
            ajax.onload = function(e) {
            var div = document.createElement("div");
            div.className = 'd-none';
            div.innerHTML = ajax.responseText;
            document.body.insertBefore(div, document.body.childNodes[0]);
            }
        }
        // this is set to BootstrapTemple website as you cannot 
        // inject local SVG sprite (using only 'icons/orion-svg-sprite.svg' path)
        // while using file:// protocol
        // pls don't forget to change to your domain :)
        injectSvgSprite('https://bootstraptemple.com/files/icons/orion-svg-sprite.svg'); 
        
      </script>
      <!-- FontAwesome CSS - loading as last, so it doesn't block rendering-->
      <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    </div>
  </body>
</html>