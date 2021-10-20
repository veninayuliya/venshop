<!DOCTYPE html>
<html>
<head>
	<title>Data Pembelian</title>
	<link rel="stylesheet" type="text/css" href="pembelian.css">
</head>
<body>
	<h2>Data Pembelian</h2>

	<table class="table" border="1" width="100%" height="100%">
		<thead align="center">
			<tr>
				<th>No</th>
				<th>Nama Pelanggan</th>
				<th>Tanggal</th>
				<th>Total</th>
				<th>Aksi</th>
			</tr>
		</thead>
		<tbody align="center">
			<?php $nomor=1;?>
			<?php $tampil = $koneksi->query("SELECT * FROM pembelian JOIN pelanggan ON pembelian.id_pelanggan=pelanggan.id_pelanggan");?>
			<?php while($pecah = $tampil->fetch_assoc()){ ?>

			<tr>
				<td><?php echo $nomor; ?></td>
				<td><?php echo $pecah['nama_pelanggan'];?></td>
				<td><?php echo $pecah['tanggal_pembelian'];?></td>
				<td><?php echo $pecah['total_pembelian'];?></td>
				<td>
					<a href="index.php?halaman=detail&id=<?php echo $pecah['id_pembelian']; ?>" class="info">detail</a>
				</td>
			</tr>
			<?php $nomor++; ?>
			<?php } ?>

		</tbody>
	</table>
</body>
</html>