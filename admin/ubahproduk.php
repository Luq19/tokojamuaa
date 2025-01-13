<h2>Ubah Produk</h2>
<?php
$ambil = $koneksi->query("SELECT * FROM produk WHERE id_produk='$_GET[id]'");
$pecah = $ambil->fetch_assoc();

// echo "<pre>";
// print_r($pecah);
// echo"</pre>";
?>

<form method="post" enctype="multipart/form-data">
	<div class="form-group">
		<label>Nama Produk</label>
		<input type="text" class="form-control" name="nama" value="<?= $pecah['nama_produk']; ?>">
	</div>
	<div class="form-group">
		<label>Harga (Rp)</label>
		<input type="number" class="form-control" name="harga" value="<?= $pecah['harga_produk']; ?>">
	</div>
	<div class="form-group">
		<label>Berat (gr)</label>
		<input type="number" class="form-control" name="berat" value="<?= $pecah['berat']; ?>">
	</div>
	<div class="form-group">
		<label>Stok</label>
		<input type="number" class="form-control" name="stok" value="<?= $pecah['stok_produk']; ?>">
	</div>
	<div class="form-group">
		<img src="foto_produk/<?= $pecah['foto_produk']; ?>" width="200">
	</div>
	<div class="form-group">
		<label>Ganti Foto</label>
		<input type="file" class="form-control" name="foto">
	</div>
	<div class="form-group">
		<label>Deskripsi</label>
		<textarea class="form-control" name="deskripsi" rows="10"><?= $pecah['deskripsi_produk']; ?></textarea>
	</div>
	<button class="btn btn-primary" name="ubah">Ubah</button>
	<button class="btn btn-secondary"name="back">Batal</button>
</form>

<?php
if (isset($_POST['ubah']))
 {
	$namafoto = $_FILES['foto']['name'];
	$lokasifoto = $_FILES['foto']['tmp_name'];
	//jk foto diubah
	if (!empty($lokasifoto)) {
		move_uploaded_file($lokasifoto, 'foto_produk/'.$namafoto);

		$koneksi->query("UPDATE produk SET nama_produk='$_POST[nama]',
			harga_produk='$_POST[harga]',berat='$_POST[berat]',foto_produk='$namafoto',deskripsi_produk='$_POST[deskripsi]'
			,stok_produk='$_POST[stok]' 
			WHERE id_produk='$_GET[id]'");

	}
	//jika foto tidak diubah
	else{

		$koneksi->query("UPDATE produk SET nama_produk='$_POST[nama]',
			harga_produk='$_POST[harga]',berat='$_POST[berat]',deskripsi_produk='$_POST[deskripsi]',stok_produk='$_POST[stok]'
			WHERE id_produk='$_GET[id]'");
	}

	echo "<script>alert('Data Produk Telah Diubah');</script>";
	echo "<script>location='index.php?halaman=produk';</script>";
 }
 
elseif (isset($_POST['back'])) {
		echo "<script>location='index.php?halaman=produk';</script>";
}
?>