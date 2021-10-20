<!DOCTYPE html>
<html>
<head>
	<title>Tambah Produk</title>
</head>
<body>
	<h2>Tambah Produk</h2>

	<form method="post" enctype="multipart/form-data">
		<div class="">
			<label>Nama</label><br>
			<input type="text" class="" name="nama">
		</div>
		<div class="">
			<label>Harga (Rp)</label><br>
			<input type="number" class="" name="harga">
		</div>
		<div class="">
			<label>Berat (gr)</label><br>
			<input type="number" class="" name="berat">
		</div>
		<div class="">
			<label>Deskripsi</label><br>
			<textarea class="" name="deskripsi" rows="10"></textarea>
		</div>
		<div class="">
			<label>Foto</label>
			<input type="file" class="" name="foto">
		</div><br>
		<button class="primary" name="save">Simpan</button>
		
	</form>
	<?php
	if(isset(($_POST['save'])))
	{
		$nama = $_FILES['foto']['name'];
		$lokasi = $_FILES['foto']['tmp_name'];
		move_uploaded_file($lokasi, "../foto_produk/".$nama);
		$koneksi->query("INSERT INTO produk (nama_produk,harga_produk,berat,foto_produk,deskripsi_produk) VALUES('$_POST[nama]','$_POST[harga]','$_POST[berat]','$nama','$_POST[deskripsi]')");

		echo "<script>alert('produk telah ditambahkan');</script>";
		echo "<meta http-equiv='refresh' content='1;url=index.php?halaman=produk'>";
	}
	?>

</body>
</html>