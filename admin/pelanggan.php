<!DOCTYPE html>
<html>
<head>
	<title>Data Pelanggan</title>
	<link rel="stylesheet" type="text/css" href="pelanggan.css">
</head>
<body>
	<h2>Data Pelanggan</h2>

	<table class="table" border="1" width="100%" height="100%">
		<thead align="center">
			<tr>
				<th>No</th>
				<th>Nama</th>
				<th>Email</th>
				<th>Telepon</th>
				<th>Aksi</th>
			</tr>
		</thead>
		<tbody align="center">
			<?php $nomor=1;?>
			<?php $tampil = $koneksi->query("SELECT * FROM pelanggan");?>
			<?php while($pecah = $tampil->fetch_assoc()){ ?>

			<tr>
				<td><?php echo $nomor; ?></td>
				<td><?php echo $pecah['nama_pelanggan'];?></td>
				<td><?php echo $pecah['email_pelanggan'];?></td>
				<td><?php echo $pecah['telepon_pelanggan'];?></td>
				<td>
					<a href="" class="danger">hapus</a>
				</td>
			</tr>
			<?php $nomor++; ?>
			<?php } ?>

		</tbody>
	</table>
</body>
</html>