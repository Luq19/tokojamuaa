<?php 
session_start();
include 'koneksi.php'
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
      <!-- Fungsi search untuk mneampilkan produk dari database  -->
      <?php 
      include 'search.php'
       ?>
      <!-- HERO SECTION-->
      <div class="container">
        <section class="hero pb-3 bg-cover bg-center d-flex align-items-center" style="background: url(img/hero-banner-alt1.jpg)">
          <div class="container py-5">
            <div class="row px-4 px-lg-5">
              <div class="col-lg-4"></div>
              <div class="col-lg-4">
                <!-- <p class="text-muted small text-uppercase mb-2">2022</p> -->
                <h1 class="h2 text-uppercase mb-3">Beli Jamu Sekarang Bisa Online</h1>
                 <?php if (empty($_SESSION["pelanggan"])) : ?>
                <a class="btn btn-dark" href="register.php">Buat Akun disini</a>
                <?php endif ?>
              </div>
            </div>
          </div>
        </section> <br>
        <form method="get">
        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Tuliskan nama atau deskripsi produk yang ingin dicari" name="keyword">
          <button class="btn btn-outline-dark">Cari</button>
        </div>
        </form>
        <!-- TRENDING PRODUCTS-->
        <section class="py-5">
          <div class="row">

                <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                    <?php while($pecah = $ambil->fetch_assoc()) : ?>
                      <!-- PRODUCT-->
                     <div class="col-xl-3 col-lg-4 col-sm-6">
                        <div class="product text-center">
                          <div class="position-relative mb-3">
                            <div class="badge text-white badge-"></div><a class="d-block" href="detail.php?id=<?= $pecah['id_produk']; ?>"><img class="img-fluid w-100" src="admin/foto_produk/<?= $pecah['foto_produk']; ?>" alt="..."></a>
                            <div class="product-overlay">
                              <ul class="mb-0 list-inline">
                                <!-- <li class="list-inline-item m-0 p-0"><a class="btn btn-sm btn-outline-dark" href="#"><i class="far fa-heart"></i></a></li> -->
                                <li class="list-inline-item m-0 p-0"><a class="btn btn-sm btn-dark" href="add.php?id=<?= $pecah['id_produk']; ?>">Add to cart</a></li>
                                <!-- <li class="list-inline-item mr-0"><a class="btn btn-sm btn-outline-dark" href="#productView" data-toggle="modal"><i class="fas fa-expand"></i></a></li> -->
                              </ul>
                            </div>
                          </div>
                          <h6> <a class="reset-anchor" href="detail.php?id=<?= $pecah['id_produk']; ?>"><?= $pecah['nama_produk']; ?></a></h6>
                          <p class="small text-muted">Rp. <?= number_format($pecah['harga_produk']); ?></p>
                        </div>
                      </div>
                      <?php endwhile; ?> 
        </section>
      </div>
      <!-- footer -->
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