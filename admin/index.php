<?php
session_start();
include 'koneksi.php';

if(!isset($_SESSION['admin']))
{
	echo "<script>alert('Anda harus login');</script>";
	echo "<script>location='login.php';</script>";
	header('location:login.php');
	exit();
}

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width">
	<title>VenShop</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<header>
		<div class="container">
			<div id="branding">
				<h1>VenShop</h1>
			</div>
			<nav>
				<ul>
					<li><a href="index.php">Home</a></li>
					<li><a href="index.php?halaman=produk">Produk</a></li>
					<li><a href="index.php?halaman=pembelian">Pembelian</a></li>
					<li><a href="index.php?halaman=pelanggan">Pelanggan</a></li>
					<li><a href="index.php?halaman=logout">Logout</a></li>
				</ul>
			</nav>
		</div>
	</header>

	<section id="outer">
		<div id="inner">
			<?php
			if (isset($_GET['halaman']))
			{
				if($_GET['halaman']=="produk")
				{
					include 'produk.php';
				}
				elseif ($_GET['halaman']=="pembelian") 
				{
					include 'pembelian.php';
				}
				elseif ($_GET['halaman']=="pelanggan") 
				{
					include 'pelanggan.php';
				}
				elseif ($_GET['halaman']=="detail") 
				{
					include 'detail.php';
				}
				elseif ($_GET['halaman']=="tambahproduk") 
				{
					include 'tambahproduk.php';
				}
				elseif ($_GET['halaman']=="hapusproduk") 
				{
					include 'hapusproduk.php';
				}
				elseif ($_GET['halaman']=="ubahproduk") 
				{
					include 'ubahproduk.php';
				}
				elseif ($_GET['halaman']=="logout") 
				{
					include 'logout.php';
				}
			}
			else
			{
				include 'home.php';
			}
			?>
		</div>
		
	</section>

	<footer>
		<p>
			VenShop, &copy; 2020. All right reserved
		</p>
	</footer>

</body>
</html>