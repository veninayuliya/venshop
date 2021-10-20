<?php
session_start();
include 'koneksi.php';
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width">
	<title>VenShop</title>
	<link rel="stylesheet" type="text/css" href="styleHome.css">
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
						<li><a href="admin/index.php">admin</a></li>
					</ul>
				</nav>
			</div>
		</header>

		<section id="showcase">
			<div class="container">
				<h1>VenShop<br>Harga Pas, Barang Berkualitas</h1>
			</div>
		</section>

		<section id="welcome">
			<marquee loop="infinitive" hspace="15">
				Welcome to VenShop&nbsp;|&nbsp;Happy shopping&nbsp;&nbsp;&nbsp;---&nbsp;&nbsp;&nbsp;Welcome to VenShop&nbsp;|&nbsp;Happy shopping&nbsp;&nbsp;&nbsp;---&nbsp;&nbsp;&nbsp;Welcome to VenShop&nbsp;|&nbsp;Happy shopping&nbsp;&nbsp;&nbsp;---&nbsp;&nbsp;&nbsp;Welcome to VenShop&nbsp;|&nbsp;Happy shopping&nbsp;&nbsp;&nbsp;
			</marquee>
		</section>
		
		<section id="boxes">
			<div class="container">
				<div class="box">
					<img src="img/baju_anim.png">
					<h3>Pakaian</h3>
					<p>kemeja, blouse, jaket</p>
				</div>
				<div class="box">
					<img src="img/shoes.webp">
					<h3>Sepatu</h3>
					<p>sneakers, sandal, heels</p>
				</div>
				<div class="box">
					<img src="img/tas-animasi.png">
					<h3>Tas</h3>
					<p>hand bag, sling bag</p>
				</div>
				<div class="box">
					<img src="img/kcmt.png">
					<h3>Aksesoris</h3>
					<p>anting, jam tangan, kacamata</p>
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