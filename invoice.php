<?php 
session_start();
include'koneksi.php';
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
     <section class="content">
  <div class="container">
    <!-- disini -->
    <section class="py-5 bg-light">
          <div class="container">
            <div class="row px-4 px-lg-5 py-lg-4 align-items-center">
              <div class="col-lg-6">
                <h1 class="h2 text-uppercase mb-0">Nota Pembelian</h1>
              </div>
              <div class="col-lg-6 text-lg-right">
                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb justify-content-lg-end mb-0 px-0">
                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Invoice</li>
                  </ol>
                </nav>
              </div>
            </div>
          </div>
    </section>
    <?php
    $ambil = $koneksi->query("SELECT * FROM pembelian JOIN pelanggan ON pembelian.id_pelanggan=pelanggan.id_pelanggan
      WHERE pembelian.id_pembelian='$_GET[id]'");
    $detail = $ambil->fetch_assoc();
    ?>

    <!-- jika pelanggan yang login tidak sama dengan pelanggan yang beli -->
    <?php 
    // echo "<pre>";
    // print_r($detail);
    // echo "</pre>";
    // print_r($_SESSION["pelanggan"]);
    //mendapatkan id pembeli
    $idpembeli = $detail["id_pelanggan"];

    //mendapatkan idpelanggan yang login
    $idpelanggan = $_SESSION["pelanggan"]["id_pelanggan"];



    if ($idpembeli !== $idpelanggan) {
      echo "<script>alert('anda tidak memiliki invoice dengan nomor pembelian ini!');</script>";
      echo "<script>location='riwayat.php';</script>";
    }
    ?>
    <div class="row">
      <div class="col-md-4">
        <h3>Pembelian</h3>
        <strong>No. Pembelian : <?= $detail["id_pembelian"]; ?></strong> <br>
        <p>
          Tanggal : <?= $detail["tgl_pembelian"]; ?> <br>
          Total : Rp. <?= number_format($detail["total_pembelian"]); ?> 
        </p>
      </div>
      <div class="col-md-4">
        <h3>Pelanggan</h3>
        <strong><?= $detail["nama_pelanggan"]; ?></strong> <br>
        <p>
          <?= $detail["telepon_pelanggan"]; ?> <br>
          <?= $detail["email_pelanggan"]; ?>
        </p>
      </div>
      <div class="col-md-4">
        <h3>Pengiriman</h3>
        <strong><?= $detail['nama_kota']; ?></strong> <br>
        <p>
          <?= $detail["alamat"]; ?> <br>
          Ongkos Kirim : Rp. <?= number_format($detail['tarif']); ?>
        </p>
      </div>
    </div>

    <table class="table table-bordered">
      <thead>
        <tr>
          <th>No</th>
          <th>Nama Produk</th>
          <th>Harga</th>
          <th>Berat</th>
          <th>Jumlah</th>
          <th>Subberat</th>
          <th>Subtotal</th>

        </tr>
      </thead>
      <tbody>
        <?php $nomor=1; ?>
        <?php $ambil=$koneksi->query("SELECT * FROM pembelian_produk WHERE id_pembelian='$_GET[id]'"); ?>
        <?php while($pecah = $ambil->fetch_assoc()) :?>
        <tr>
          <td><?= $nomor; ?></td>
          <td><?= $pecah["nama"]; ?></td>
          <td>Rp. <?= number_format($pecah["harga"]); ?></td>
          <td><?= $pecah["berat"]; ?> gr.</td>
          <td><?= $pecah["jumlah"]; ?></td>
          <td><?= $pecah["subberat"]; ?> gr.</td>
          <td>
            Rp. <?= number_format($pecah["subharga"]); ?>
          </td>
        </tr>
        <?php $nomor++ ?>
      <?php endwhile;?>
      </tbody>
    </table>

    <div class="row">
      <div class="col-md-7">
        <div class="alert alert-info">
          <p>
            Silakan Melakukan Pembayaran Rp. <?= number_format($detail["total_pembelian"]); ?> Ke- <br>
            <strong>BANK BCA 3450285144 A/N.Luky Ramadhan</strong><br>
            <p3>Lalu Konfirmasi Pembayaran anda di 
              <?php if ($detail["status_pembelian"]=="pending"): ?>
              <a href="pembayaran.php?id=<?= $detail["id_pembelian"]; ?>">sini
                <?php else: 
                  echo "sini";?>
              <?php endif ?>
              </a>
                
            </p>
          </p>  
        </div>
      </div>
       <div class="col-md-7">
        <div class="alert alert-danger">
          <p>
            Jika terdapat kendala pada saat melakukan pembayaran dapat menghubungi kami melalui
            <strong>Whatsapp : 081319628447 | Luky Ramadhan</strong><br>
            </p>
        </div>
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