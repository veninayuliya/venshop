<!DOCTYPE html>
<html>
<head>
	<title>Data Produk</title>
	<link rel="stylesheet" type="text/css" href="produk.css">
</head>
<body>
	<h2>Data Produk</h2>

	<table class="table" border="1" width="100%" height="100%">
		<thead align="center">
			<tr>
				<th>No</th>
				<th>Nama</th>
				<th>Harga</th>
				<th>Berat</th>
				<th>Foto</th>
				<th>Aksi</th>
			</tr>
		</thead>
		<tbody align="center">
			<?php $nomor=1;?>
			<?php $tampil = $koneksi->query("SELECT * FROM produk");?>
			<?php while($pecah = $tampil->fetch_assoc()){ ?>

			<tr>
				<td><?php echo $nomor; ?></td>
				<td><?php echo $pecah['nama_produk'];?></td>
				<td><?php echo $pecah['harga_produk'];?></td>
				<td><?php echo $pecah['berat'];?></td>
				<td>
					<img src="../foto_produk/<?php echo $pecah['foto_produk'];?>" width="100">
				</td>
				<td>
					<a href="index.php?halaman=hapusproduk&id=<?php echo $pecah['id_produk'];?>" class="danger">hapus</a><br>
					<a href="index.php?halaman=ubahproduk&id=<?php echo $pecah['id_produk'];?>" class="primary">ubah</a>
				</td>
			</tr>
			<?php $nomor++; ?>
			<?php } ?>

		</tbody>
	</table><br>
	<a href="index.php?halaman=tambahproduk" class="default">Tambah Data</a>
</body>
</html>