<h2>Tambah Produk</h2>

<form method="post" enctype="multipart/form-data">
	<div class="form-group">
		<label>Nama Produk</label>
		<input type="text" class="form-control" name="nama">
	</div>
	<div class="form-group">
		<label>Harga (Rp)</label>
		<input type="number" class="form-control" name="harga">
	</div>
	<div class="form-group">
		<label>Berat (gr)</label>
		<input type="number" class="form-control" name="berat">
	</div>
	<div class="form-group">
		<label>Stok</label>
		<input type="number" class="form-control" name="stok" required="">
	</div>
	<div class="form-group">
		<label>Deskripsi</label>
		<textarea class="form-control" name="deskripsi" rows="10"></textarea>
	</div>
	<div class="form-group">
		<label>Foto</label>
		<input type="file" class="form-control" name="foto">
	</div>
	<button class="btn btn-primary" name="save">Simpan</button>
	<button class="btn btn-secondary"name="back">Batal</button>
</form>


<?php

if (isset($_POST['save'])) {
	if (isset($_POST['nama']) && ($_POST['harga']) && ($_POST['berat']) && ($_POST['deskripsi']) && ($_FILES)) {
		$nama = $_FILES['foto']['name'];
		$lokasi = $_FILES['foto']['tmp_name'];

		move_uploaded_file($lokasi, 'foto_produk/'.$nama);

		$koneksi->query("INSERT INTO produk
			(nama_produk,harga_produk,berat,foto_produk,deskripsi_produk,stok_produk)
			VALUES('$_POST[nama]','$_POST[harga]','$_POST[berat]','$nama','$_POST[deskripsi]','$_POST[stok]')");

		echo "<script>alert('Data Berhasil Ditambahkan');</script>";
		echo "<meta http-equiv='refresh' content='1;url=index.php?halaman=produk'>";
		die;
	}
	else{
		echo "<script>alert('Seluruh Data Harus Diisi!!!');</script>";
	}
}

elseif (isset($_POST['back'])) {
		echo "<script>location='index.php?halaman=produk';</script>";
	}

?>

