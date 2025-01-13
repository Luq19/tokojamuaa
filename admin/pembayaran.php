<h2>Data Pembayaran</h2>
<?php 
//mendapatkan id pembelian dari url

$id_pembelian = $_GET['id'];

//mengambil data pembayaran berdasarkan id pembelian
$ambil = $koneksi->query("SELECT * FROM pembayaran WHERE id_pembelian='$id_pembelian'");
$pecah = $ambil->fetch_assoc();

// echo "<pre>";
// print_r($pecah);
// echo "</pre>";
?>

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

		<form method="post">
			<div class="form-group">
				<label>Resi Pengiriman</label>
				<input type="text" class="form-control" name="resi">
			</div>
			<div class="form-group">
				<label>Status</label>
				<select class="form-control" name="status" required="">
					<option value="">Pilih Status</option>
					<option value="pembayaran sudah di konfirmasi">Pembayaran sudah di konfirmasi</option>
					<option value="barang dikirim">Barang Dikirim</option>
					<option value="bukti pembayaran tidak valid">Bukti pembayaran tidak valid</option>
					<option value="batal">Batal</option>
				</select>
			</div>
			<button class="btn btn-primary" name="proses">Proses</button>
			<button class="btn btn-secondary" name="batal">Batal</button>
		</form>

		<?php 
		if (isset($_POST["proses"])) {
			if (isset($_POST['resi'])) {
				$resi = $_POST['resi'];
				$status = $_POST['status'];
				$koneksi->query("UPDATE pembelian SET resi_pengiriman='$resi', status_pembelian='$status'
					WHERE id_pembelian='$id_pembelian'");
				echo "<script>alert('pembayaran sudah di update');</script>";
				echo "<script>location='index.php?halaman=pembelian';</script>";
				
			}
			else{
				$status = $_POST['status'];
				$koneksi->query("UPDATE pembelian SET status_pembelian='$status'
					WHERE id_pembelian='$id_pembelian'");
				echo "<script>alert('pembayaran sudah di update');</script>";
				echo "<script>location='index.php?halaman=pembelian';</script>";
				
			}	
		}
		elseif (isset($_POST['batal'])) {
		echo "<script>location='index.php?halaman=pembelian';</script>";
		}
		?>

	</div>
	<div class="col-md-6">
		<img src="../bukti_pembayaran/<?= $pecah['bukti']; ?>" height="30%">
	</div>
</div>
