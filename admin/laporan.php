<?php 
$semuadata = array();
$tglm = "-";
$tgls = "-";
if (isset($_POST['kirim'])) {
	$tglm = $_POST['tglm'];
	$tgls = $_POST['tgls'];
	$ambil = $koneksi->query("SELECT * FROM pembelian pm LEFT JOIN pelanggan pl ON pm.id_pelanggan=pl.id_pelanggan
		WHERE tgl_pembelian BETWEEN '$tglm' AND '$tgls'");
	while($pecah = $ambil->fetch_assoc())
	{
		$semuadata[] = $pecah;
	}

	// echo "<pre>";
	// print_r($semuadata);
	// echo "</pre>";
}
?>


<h1>Laporan Pembelian</h1>
<hr>
<h2>Laporan Pembelian dari <?= $tglm ?> hingga <?= $tgls ?></h2>


<form method="post">
	<div class="row">
		<div class="col-md-5">
			<div class="form-group">
				<label>Tanggal Mulai</label>
				<input type="date" class="form-control" name="tglm" value="<?= $tglm ?>">
			</div>
		</div>
		<div class="col-md-5">
			<div class="form-group">
				<label>Tanggal Selesai</label>
				<input type="date" class="form-control" name="tgls" value="<?= $tgls ?>">
			</div>
		</div>
		<div class="col-md-2">
			<label>&nbsp;</label><br>
			<button class="btn btn-primary" name="kirim">Lihat</button>
		</div>
	</div>
</form>

<table class="table table-bordered">
	<thead>
		<tr>
			<th>No</th>
			<th>Pelanggan</th>
			<th>Tanggal</th>
			<th>Jumlah</th>
			<th>Status</th>
		</tr>
	</thead>
	<tbody>
		<?php $total =0; ?>
		<?php foreach ($semuadata as $key => $value): ?>
		<?php $total += $value["total_pembelian"]; ?>
		<tr>
			<td><?= $key+1; ?></td>
			<td><?= $value["nama_pelanggan"]; ?></td>
			<td><?= $value["tgl_pembelian"]; ?></td>
			<td>Rp. <?= number_format($value["total_pembelian"]); ?></td>
			<td><?= $value["status_pembelian"]; ?></td>
		</tr>
		<?php endforeach; ?>	
	</tbody>
	<tfoot>
		<tr>
			<th colspan="3">Total</th>
			<th>Rp. <?= number_format($total)  ?></th>
			<th></th>
		</tr>
	</tfoot>
</table>