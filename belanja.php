<?php
session_start();
include 'koneksi.php';
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width">
	<title>Belanja</title>
	<link rel="stylesheet" type="text/css" href="styleBelanja.css">
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

	<!--KONTEN-->
	<section class="konten">
		<div class="container">
			<h1>Produk</h1>
			<div class="grid">

				<!--MENGHUBUNGKAN KE DATABASE-->
				<?php $tampil = $koneksi->query("SELECT * FROM produk");?>
				<?php while($perproduk = $tampil->fetch_assoc()){?>
						<table>
							<tr>
								<td width="250" height="230"></td>
								<td><input type="image" src="img/<?php echo $perproduk['foto_produk']; ?>"  width="180" height="220" alt="submit">
								<p><strong><?php echo $perproduk['nama_produk']; ?></strong></p>
								<font>Rp. <?php echo number_format($perproduk['harga_produk']); ?></font> <br><br>
								<a href="beli.php?id=<?php echo $perproduk['id_produk']; ?>" class="beli">Beli</a>
								</td>
							</tr>
						</table>
				<?php } ?>
			</div>
		</div>
	</section>

	<footer>
		<p>
			VenShop, &copy; 2020. by Venina Yuliya
		</p>
	</footer>

</body>
</html>