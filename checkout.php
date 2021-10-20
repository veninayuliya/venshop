<?php
session_start();
include 'koneksi.php';



//jika blm login

if(!isset($_SESSION["pelanggan"]))
{
	echo "<script>alert('Silahkan login')</script>";
	echo "<script>location='login.php';</script>";
}
else
{
	if (!isset($_SESSION["keranjang"])) {
		echo "<script>alert('Silahkan belanja')</script>";
		echo "<script>location='belanja.php';</script>";
	}
}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width">
	<title>Checkout</title>
	<link rel="stylesheet" type="text/css" href="styleCheckout.css">
</head>
<body>
	<header>
		<div class="container">
			<div id="branding">
				<h1>VenShop</h1>
			</div>
			<nav>
				<ul>
					<li class="active"><a href="index.php">Home</a></li>
					<li><a href="belanja.php">Belanja</a></li>
					<li><a href="keranjang.php">Keranjang</a></li>

					<!--jika sudah login-->
					<?php if(isset($_SESSION["pelanggan"])): ?>
						<li><a href="logout.php">Logout</a></li>

						<!--jika belum login-->
						<?php else:?>
							<li><a href="login.php">Login</a></li>
						<?php endif ?>
						<li><a href="checkout.php">Checkout</a></li>
					</ul>
				</nav>
			</div>

		</header>

	<!--<pre>
		<?php print_r($_SESSION["pelanggan"]); ?>
	</pre>-->
	<section class="content">
		<h2>Keranjang Belanja</h2>
		<table class="table" border="1" width="100%" height="100%">
			<thead align="center">
				<tr>
					<th>No</th>
					<th>Nama produk</th>
					<th>Harga</th>
					<th>Jumlah</th>
					<th>Sub harga</th>
				</tr>
			</thead>
			<tbody align="center">
				<?php $nomor=1; ?>
				<?php $totalbelanja=0; ?>
				<?php foreach ($_SESSION["keranjang"] as $id_produk => $jumlah){ ?>
					<?php
					$tampil=$koneksi->query("SELECT * FROM produk WHERE id_produk='$id_produk'");
					$pecah=$tampil->fetch_assoc();
					$subharga=$pecah["harga_produk"]*$jumlah;
				/*echo "<pre>";
				print_r($pecah);
				echo "</pre>";*/
				?>
				<tr>
					<td><?php echo $nomor; ?></td>
					<td><?php echo $pecah["nama_produk"]; ?></td>
					<td>Rp. <?php echo number_format($pecah["harga_produk"]); ?></td>
					<td><?php echo $jumlah; ?></td>
					<td>Rp. <?php echo number_format($subharga); ?></td>
				</tr>
				<?php $nomor++; ?>
				<?php $totalbelanja+=$subharga; ?>
			<?php } ?>
		</tbody>
		<tfoot>
			<tr>
				<th>Total Belanja</th>
				<th colspan="4">Rp. <?php echo number_format($totalbelanja) ?></th>
			</tr>
		</tfoot>
	</table><br>
	<form method="post">
		<div class="box">
			<tr>
				<td><input type="text" readonly value="<?php echo $_SESSION["pelanggan"]["nama_pelanggan"] ?>" name="" size="60%"></td>
				<td><input type="text" readonly value="<?php echo $_SESSION["pelanggan"]["telepon_pelanggan"] ?>" name="" size="60%"></td>
				<td><select name="id_ongkir">
					<option value="">Pilih Ongkos Kirim</option>
					<?php 
					$tampil = $koneksi->query("SELECT * FROM ongkir");
					while($perongkir = $tampil->fetch_assoc()){
						?>
						<option value="<?php echo $perongkir["id_ongkir"] ?>">
							<?php echo $perongkir["nama_kota"] ?>
							Rp. <?php echo number_format($perongkir["tarif"]); ?>
						</option>
					<?php } ?>
				</select></td>
			</tr>
		</div>
		<br>
		<label>Alamat lengkap pengiriman</label><br>
		<textarea name="alamat" placeholder="Masukkan alamat lengkap pengiriman"></textarea>
		<br><br>
		<button class="kuning" name="checkout">Checkout</button>
	</form>

	<?php  
	if(isset($_POST["checkout"]))
	{
		$id_pelanggan = $_SESSION["pelanggan"]["id_pelanggan"];
		$id_ongkir = $_POST["id_ongkir"];
		$tanggal_pembelian = date("Y-m-d");
		$alamat = $_POST["alamat"];
		$tampil = $koneksi->query("SELECT * FROM ongkir WHERE id_ongkir='$id_ongkir'");
		$arrayongkir = $tampil->fetch_assoc();
		$nama_kota = $arrayongkir["nama_kota"];
		$tarif = $arrayongkir["tarif"];

		$total_pembelian = $totalbelanja + $tarif;
			//menyimpan data ke tabel pembelian
		$koneksi->query("INSERT INTO pembelian (id_pelanggan, id_ongkir, tanggal_pembelian, total_pembelian, nama_kota, tarif, alamat) VALUES ('$id_pelanggan', '$id_ongkir', '$tanggal_pembelian', '$total_pembelian','$nama_kota', '$tarif', '$alamat')");


			//mendapat id pembelian yang terakhir terjadi
		$id_pembelian_terakhir = $koneksi->insert_id;
		foreach ($_SESSION["keranjang"] as $id_produk => $jumlah) 
		{
			$koneksi->query("INSERT INTO pembelian_produk
				(id_pembelian, id_produk, jumlah)
				VALUES ('$id_pembelian_terakhir', '$id_produk', '$jumlah')");
		}


			//mengkosongkan keranjang
		unset($_SESSION["keranjang"]);

			//tampilan dialihkan ke halaman nota
		echo "<script>alert('pembelian sukses');</script>";
		echo "<script>location='nota.php?id=$id_pembelian_terakhir';</script>";
	}
	?>
	
	<!--<pre><?php print_r($_SESSION["pelanggan"]) ?></pre>
		<pre><?php print_r($_SESSION["keranjang"]) ?></pre>-->

	</section>
	<footer>
		<p>
			VenShop, &copy; 2020. by Venina Yuliya
		</p>
	</footer>


</body>
</html>