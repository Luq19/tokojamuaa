<h2>Data Produk</h2>

<table class="table table-bordered">
	<thead>
		<tr>
			<th>No</th>
			<th>Nama</th>
			<th>Harga</th>
			<th>Berat</th>
			<th>Stok</th>
			<th>Foto</th>
			<th>Aksi</th>
		</tr>
	</thead>
	<tbody>
		<?php $nomor=1; ?>
		<?php $ambil=$koneksi->query("SELECT * FROM produk"); ?>
		<?php while($pecah = $ambil->fetch_assoc()) :?>
		<tr>
			<td><?= $nomor  ?></td>
			<td><?= $pecah["nama_produk"]; ?></td>
			<td><?= $pecah["harga_produk"]; ?></td>
			<td><?= $pecah["berat"]; ?></td>
			<td><?= $pecah["stok_produk"]; ?></td>
			<td>
				<img src="foto_produk/<?= $pecah['foto_produk']; ?>" width="100">
			</td>
			<td>
				<a href="index.php?halaman=hapusproduk&id=<?= $pecah['id_produk']; ?>" class="btn btn-danger" 
					onclick="return confirm('yakin?');">Hapus</a>
				<a href="index.php?halaman=ubahproduk&id=<?= $pecah['id_produk']; ?> " class="btn btn-warning">Ubah</a>
			</td>
		</tr>
		<?php $nomor++ ?>
	<?php endwhile;?>
	</tbody>
</table>
<a href="index.php?halaman=tambahproduk" class="btn btn-primary">Tambah Produk</a>