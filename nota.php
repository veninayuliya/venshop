<?php
include 'koneksi.php';
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width">
	<title>Nota Belanja</title>
	<link rel="stylesheet" type="text/css" href="styleNota.css">
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

	<section class="content">


		<!---nota copas dari admin-->
		<h2>Detail Pembelian</h2>
	<?php
	$tampil=$koneksi->query("SELECT * FROM pembelian JOIN pelanggan ON pembelian.id_pelanggan=pelanggan.id_pelanggan WHERE pembelian.id_pembelian='$_GET[id]'");
	$detail = $tampil->fetch_assoc();
	?>
	<!--<pre><?php print_r($detail); ?></pre>-->

	<strong><?php echo $detail['nama_pelanggan']; ?></strong><br>
	<p>
		<?php echo $detail['telepon_pelanggan']; ?> <br>
		<?php echo $detail['email_pelanggan']; ?>
	</p>

	<p>
		Tanggal: <?php echo $detail['tanggal_pembelian']; ?><br>
		Total: Rp. <?php echo number_format($detail['total_pembelian']); ?>
	</p>

	<p>
		Tujuan Pengiriman : <?php echo $detail['nama_kota'];?><br>
		Ongkos Kirim : Rp. <?php echo number_format($detail['tarif']); ?><br>
		Alamat : <?php echo $detail['alamat']; ?>
	</p>

	<table class="table" border="1" width="100%" height="100%">
		<thead>
			<tr>
				<th>No</th>
				<th>Nama produk</th>
				<th>Harga</th>
				<th>Jumlah</th>
				<th>Subtotal</th>
			</tr>
		</thead>
		<tbody align="center">
			<?php $nomor=1; ?>
			<?php $tampil=$koneksi->query("SELECT * FROM pembelian_produk JOIN produk ON pembelian_produk.id_produk=produk.id_produk WHERE pembelian_produk.id_pembelian='$_GET[id]'"); ?>
			<?php while($pecah=$tampil->fetch_assoc()){?>
			<tr>
				<td><?php echo $nomor; ?></td>
				<td><?php echo $pecah['nama_produk']; ?></td>
				<td>Rp. <?php echo number_format($pecah['harga_produk']); ?></td>
				<td><?php echo $pecah['jumlah']; ?></td>
				<td>
					Rp. <?php echo number_format($pecah['harga_produk'] * $pecah['jumlah']); ?>
				</td>
			</tr>
			<?php $nomor++; ?>
		<?php } ?>
		</tbody>
	</table>

	<div class="nota">
		<p>
			Silahkan melakukan pembayaran ke
			<strong>137-001978-3452 AN. Venina Yuliya</strong><br>
			Sebesar <strong>Rp. <?php echo number_format($detail['total_pembelian']); ?></strong>
		</p>
	</div>
		
	</section>

	<footer>
		<p>
			VenShop, &copy; 2020. by Venina Yuliya
		</p>
	</footer>

</body>
</html>