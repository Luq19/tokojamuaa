<?php 
        if (isset($_POST['checkout'])) {
        $id_pelanggan = $_SESSION['pelanggan']['id_pelanggan'];
        $id_kota = $_POST['id_kota'];
        $tanggal_pembelian = date("Y-m-d");
        $alamat = $_POST['alamat'];

        $ambil = $koneksi->query("SELECT * FROM ongkir WHERE id_kota='$id_kota'");
        $arrayongkir = $ambil->fetch_assoc();
        $nama_kota = $arrayongkir['nama_kota'];
        $tarif = $arrayongkir['tarif'];

        $total_pembelian = $totalbelanja+$tarif;

        //1.menyimpan data ke table pembelian
        $koneksi->query("INSERT INTO pembelian
            (id_pelanggan,id_kota,tgl_pembelian,total_pembelian,alamat,nama_kota,tarif)
            VALUES('$id_pelanggan','$id_kota','$tanggal_pembelian','$total_pembelian','$alamat','$nama_kota','$tarif')");

        //mendapatkan id pembelian diatas
        $id_pembelian_baru = mysqli_insert_id($koneksi);
        // $id_pembelian_baru = $koneksi->insert_id;

        foreach ($_SESSION["keranjang"] as $id_produk => $jumlah)
        {
            //mendapatkan data produk berdasarkan id_produk
            $ambil = $koneksi->query("SELECT * FROM produk WHERE id_produk='$id_produk'");
            $perproduk = $ambil->fetch_assoc();

            $nama = $perproduk['nama_produk'];
            $harga = $perproduk['harga_produk'];
            $berat = $perproduk['berat'];

            $subberat = $perproduk['berat']*$jumlah;
            $subharga = $perproduk['harga_produk']*$jumlah;
            $koneksi->query("INSERT INTO pembelian_produk 
                (id_pembelian,id_produk,nama,harga,berat,subberat,subharga,jumlah)
                 VALUES('$id_pembelian_baru','$id_produk','$nama','$harga','$berat','$subberat','$subharga','$jumlah')");


        //update stok pda tabel produk
            $koneksi->query("UPDATE produk SET stok_produk=stok_produk-$jumlah WHERE id_produk='$id_produk'");
        }
        //mengosongkan session keranjang
        unset($_SESSION['keranjang']);

        //tampilan dialihkan ke halaman invoice baru
        echo "<script>alert('Pembelian Sukses');</script>";
        echo "<script>location='invoice.php?id=$id_pembelian_baru';</script>";
        }
        ?>