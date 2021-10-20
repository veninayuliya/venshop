<!DOCTYPE html>
<html>
<head>
	<title>Ubah Produk</title>
	<link rel="stylesheet" type="text/css" href="ubah.css">
</head>
<body>
	<h2>Ubah Produk</h2>
	<?php
	$tampil = $koneksi->query("SELECT * FROM produk WHERE id_produk='$_GET[id]'");
	$pecah = $tampil->fetch_assoc();

	//echo "<pre>";
	//print_r($pecah);
	//echo "</pre>";
	//?>

	<form method="post" enctype="multipart/form-data">
		<div class="">
			<label>Nama Produk</label><br>
			<input type="text" name="nama" value="<?php echo $pecah['nama_produk'];?>">
		</div>
		<div class="">
			<label>Harga Rp.</label><br>
			<input type="number" name="harga" value="<?php echo $pecah['harga_produk'];?>">
		</div>
		<div class="">
			<label>Berat (gr)</label><br>
			<input type="number" name="berat" value="<?php echo $pecah['berat'];?>">
		</div><br>
		<div class="">
			<img src="../foto_produk/<?php echo $pecah['foto_produk']?>" width="200">
		</div>
		<div class=""><br>
			<label>Ganti Foto</label><br>
			<input type="file" name="foto">
		</div>
		<div class="">
			<label>Deskripsi</label><br>
			<textarea name="deskripsi" rows="10">
				<?php echo $pecah['deskripsi_produk'];?>
			</textarea>
		</div>
		<button class="primary" name="ubah">Ubah</button>
	</form>
	<?php
	if(isset($_POST['ubah']))
	{
		$namafoto = $_FILES['foto']['name'];
		$lokasifoto = $_FILES['foto']['tmp_name'];
		//jika foto diubah
		if(!empty($lokasifoto))
		{
			move_uploaded_file($lokasifoto, "../foto_produk/$namafoto");

			$koneksi->query("UPDATE produk SET nama_produk='$_POST[nama]',harga_produk=
				'$_POST[harga]',berat='$_POST[berat]',foto_produk='$namafoto',deskripsi_produk='$_POST[deskripsi]' WHERE id_produk='$_GET[id]'");
		}
		else
		{
			$koneksi->query("UPDATE produk SET nama_produk='$_POST[nama]',harga_produk=
				'$_POST[harga]',berat='$_POST[berat]',deskripsi_produk='$_POST[deskripsi]' WHERE id_produk='$_GET[id]'");
		}
		echo "<script>alert('data produk telah diubah');</script>";
		echo "<script>location='index.php?halaman=produk';</script>";
	}
	?>

</body>
</html>