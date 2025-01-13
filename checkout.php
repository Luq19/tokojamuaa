<?php
session_start();
include 'koneksi.php';
//jk blm ada session atau blm login maka akan di arahkan ke halaman login
if (!isset($_SESSION["pelanggan"]) OR empty($_SESSION["pelanggan"])) {
    echo "<script>alert('Harap login, sebelum melakukan checkout!');</script>";
    echo "<script>location='login.php';</script>";
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
      <div class="container">
        <!-- HERO SECTION-->
        <section class="py-5 bg-light">
          <div class="container">
            <div class="row px-4 px-lg-5 py-lg-4 align-items-center">
              <div class="col-lg-6">
                <h1 class="h2 text-uppercase mb-0">Checkout</h1>
              </div>
              <div class="col-lg-6 text-lg-right">
                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb justify-content-lg-end mb-0 px-0">
                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                    <li class="breadcrumb-item"><a href="cart.php">Cart</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Checkout</li>
                  </ol>
                </nav>
              </div>
            </div>
          </div>
        </section>
        <section class="py-5">
          <!-- BILLING ADDRESS-->
          <h2 class="h5 text-uppercase mb-4">Detail Pembayaran</h2>
          <div class="row">
            <div class="col-lg-8">
              <form method="post">
                <div class="row">
                  <div class="col-lg-12 form-group">
                    <label class="text-small text-uppercase" for="Name">Nama</label>
                    <input class="form-control form-control-lg" id="Name" readonly value="<?= $_SESSION['pelanggan']['nama_pelanggan']; ?>" type="text">
                  </div>
                  <div class="col-lg-12 form-group">
                    <label class="text-small text-uppercase" for="email">Email</label>
                    <input class="form-control form-control-lg" id="email" readonly value="<?= $_SESSION['pelanggan']['email_pelanggan']; ?>" type="email">
                  </div>
                  <div class="col-lg-6 form-group">
                    <label class="text-small text-uppercase" for="phone">Nomor Telepon</label>
                    <input class="form-control form-control-lg" id="phone"readonly value="<?= $_SESSION['pelanggan']['telepon_pelanggan']; ?>" type="tel">
                  </div>
                  <div class="col-lg-6 form-group">
                    <label class="text-small text-uppercase" for="city">Kota</label>
                    <select class="form-control" name="id_kota" required="">
                            <option value="">Pilih Lokasi</option>
                            <?php
                            $ambil = $koneksi->query("SELECT * FROM ongkir");
                            while($perongkir = $ambil->fetch_assoc()) :
                            ?>
                            <option value="<?= $perongkir['id_kota'] ?>">
                                <?= $perongkir['nama_kota'] ?>
                                Rp. <?= number_format($perongkir['tarif']) ?>
                            </option>
                            <?php endwhile; ?>
                        </select>
                  </div>
                  <div class="col-lg-12 form-group">
                    <label class="text-small text-uppercase" for="address">Alamat Lengkap</label>
                    <textarea class="form-control form-control-lg" name="alamat" id="address" type="text" placeholder="Alamat lengkap pengiriman beserta kode pos ( isikan secara detail )" rows="5" required=""></textarea>
                  </div>
                  <div class="col-lg-12 form-group">
                    <button class="btn btn-dark" name="checkout">Checkout</button>
                  </div>
                </div>
              </form>
            </div>
            <!-- ORDER SUMMARY-->
            <div class="col-lg-4">
              <div class="card border-0 rounded-0 p-lg-4 bg-light">
                <div class="card-body">
                  <h5 class="text-uppercase mb-4">Pesanan Anda</h5>
                  <?php if (empty($_SESSION['keranjang'])): ?>
                    <?php echo '<div class="alert alert-danger">Tidak ada produk dalam keranjang!.</div>'; ?>
                  <?php else: ?>
                    <ul class="list-unstyled mb-0">
                      <?php $totalbelanja=0; ?>
                      <?php foreach ($_SESSION['keranjang'] as $id_produk => $jumlah) : ?>
                      <?php
                      $ambil = $koneksi->query("SELECT * FROM produk WHERE id_produk='$id_produk'");
                      $pecah = $ambil->fetch_assoc();
                      $subharga = $pecah['harga_produk']*$jumlah;
                      ?>
                      <li class="d-flex align-items-center justify-content-between">
                        <strong class="small font-weight-bold"><?= $pecah['nama_produk']; ?></strong><span class="text-muted small">Rp. <?= number_format($subharga); ?></span>
                      </li>
                     <!--  <li>
                        <strong class="small font-weight-bold">Biaya Pengiriman</strong><span class="text-muted small">Rp. <?= number_format($perongkir['tarif']) ?></span>
                      </li> -->
                      <!-- <li class="border-bottom my-2"></li>
                      <li class="d-flex align-items-center justify-content-between"><strong class="small font-weight-bold">Gray Nike running shoes</strong><span class="text-muted small">$351</span></li> -->
                      <li class="border-bottom my-2"></li>
                      <?php $totalbelanja += $subharga; ?>
                      <?php endforeach; ?>
                      <li class="d-flex align-items-center justify-content-between"><strong class="text-uppercase small font-weight-bold">Total</strong><span>Rp. <?= number_format($totalbelanja) ?></span></li>
                    </ul>
                  <?php endif ?> 
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>
      <?php include 'footer.php' ?>
      <?php include 'fungsicheckout.php';?>
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