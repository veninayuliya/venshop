<?php
session_start();

include 'koneksi.php';


if(empty($_SESSION["keranjang"]) OR !isset($_SESSION["keranjang"]))
{
	echo "<script>alert('Keranjang kosong');</script>";
	echo "<script>location='belanja.php';</script>";

}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width">
	<title>Keranjang Belanja</title>
	<link rel="stylesheet" type="text/css" href="styleKeranjang.css">
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

		<section class="konten">
			<h2>Keranjang Belanja</h2>
			<table class="table" border="1" width="100%" height="100%">
				<thead align="center">
					<tr>
						<th>No</th>
						<th>Nama produk</th>
						<th>Harga</th>
						<th>Jumlah</th>
						<th>Sub harga</th>
						<th>Aksi</th>
					</tr>
				</thead>
				<tbody align="center">
					<?php $nomor=1; ?>
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
				<td>
					<a href="hapuskeranjang.php?id=<?php echo $id_produk ?>" class="danger">hapus</a>
				</td>
			</tr>
			<?php $nomor++; ?>
		<?php } ?>
	</tbody>
</table><br>
<a href="belanja.php" class="default">Lanjutkan Belanja</a><br>
<a href="checkout.php" class="primary">Checkout</a>
</section>

<footer>
	<p>
		VenShop, &copy; 2020. by Venina Yuliya
	</p>
</footer>

</body>
</html>