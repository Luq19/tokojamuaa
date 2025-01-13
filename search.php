<!-- apabila user melakukan klik tombol search -->
                    <?php if (isset($_GET['keyword'])): ?>
                        <?php 
                        $keyword = $_GET['keyword'];
                        $ambil = $koneksi->query("SELECT * FROM produk WHERE nama_produk LIKE '%$keyword%' 
                                                        OR deskripsi_produk LIKE '%$keyword%'"); 
                        ?>
                        <!-- jika tidak maka mengambil semua data produk, secara default statement else yang akan dijalankan -->
                        <?php else : ?>
                        <?php $ambil = $koneksi->query("SELECT * FROM produk"); ?>

                    <?php endif; ?>