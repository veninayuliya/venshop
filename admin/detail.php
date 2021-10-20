<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<h2>Detail Pembelian</h2>
	<?php
	$tampil=$koneksi->query("SELECT * FROM pembelian JOIN pelanggan ON pembelian.id_pelanggan=pelanggan.id_pelanggan WHERE pembelian.id_pembelian='$_GET[id]'");
	$detail = $tampil->fetch_assoc();
	?>
	<!--<pre><?php print_r($detail); ?></pre>-->

	<strong><?php echo $detail['nama_pelanggan']; ?></strong><br>
	<p>
		<?php echo $detail['telepon_pelanggan']; ?> <br>
		<?php echo $detail['email_pelanggan']; ?>
	</p>

	<p>
		Tanggal: <?php echo $detail['tanggal_pembelian']; ?><br>
		Total: <?php echo $detail['total_pembelian']; ?>
	</p>

	<table class="table" border="1" width="100%" height="100%">
		<thead>
			<tr>
				<th>No</th>
				<th>Nama produk</th>
				<th>Harga</th>
				<th>Jumlah</th>
				<th>Subtotal</th>
			</tr>
		</thead>
		<tbody align="center">
			<?php $nomor=1; ?>
			<?php $tampil=$koneksi->query("SELECT * FROM pembelian_produk JOIN produk ON pembelian_produk.id_produk=produk.id_produk WHERE pembelian_produk.id_pembelian_produk='$_GET[id]'"); ?>
			<?php while($pecah=$tampil->fetch_assoc()){?>
			<tr>
				<td><?php echo $nomor; ?></td>
				<td><?php echo $pecah['nama_produk']; ?></td>
				<td><?php echo $pecah['harga_produk']; ?></td>
				<td><?php echo $pecah['jumlah']; ?></td>
				<td>
					<?php echo $pecah['harga_produk'] * $pecah['jumlah']; ?>
				</td>
			</tr>
			<?php $nomor++; ?>
		<?php } ?>
		</tbody>
	</table>

</body>
</html>