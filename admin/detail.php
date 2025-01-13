<h2>Detail Pembelian</h2>
<?php
$ambil = $koneksi->query("SELECT * FROM pembelian JOIN pelanggan ON pembelian.id_pelanggan=pelanggan.id_pelanggan
	WHERE pembelian.id_pembelian='$_GET[id]'");
$detail = $ambil->fetch_assoc();
?>

<div class="row">
	<div class="col-md-4">
		<h3>Pembelian</h3>
		<strong>No. Pembelian : <?= $detail["id_pembelian"]; ?></strong> <br>
		<p>
			Tanggal : <?= $detail["tgl_pembelian"]; ?> <br>
			Total : <?= number_format($detail["total_pembelian"]); ?> <br>
			Status : <?= $detail["status_pembelian"]; ?>
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
			<th>Jumlah</th>
			<th>Subtotal</th>
		</tr>
	</thead>
	<tbody>
		<?php $nomor=1; ?>
		<?php $ambil=$koneksi->query("SELECT * FROM pembelian_produk JOIN produk 
			ON pembelian_produk.id_produk=produk.id_produk WHERE pembelian_produk.id_pembelian='$_GET[id]'"); ?>
		<?php while($pecah = $ambil->fetch_assoc()) :?>
		<tr>
			<td><?= $nomor  ?></td>
			<td><?= $pecah["nama_produk"]; ?></td>
			<td>Rp. <?= number_format($pecah["harga_produk"]); ?></td>
			<td><?= $pecah["jumlah"]; ?></td>
			<td>
				Rp. <?= number_format($pecah["harga_produk"]*$pecah["jumlah"]); ?>
			</td>
		</tr>
		<?php $nomor++ ?>
	<?php endwhile;?>
	</tbody>
</table>