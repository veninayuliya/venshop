<?php
session_start();
//mendapatkan id produk
$id_produk = $_GET['id'];

//jika sudah ada produk di keranjang maka ditambah 1
if(isset($_SESSION['keranjang'][$id_produk]))
{
	$_SESSION['keranjang'][$id_produk]+=1;
}
//jika belum maka beli 1
else
{
	$_SESSION['keranjang'][$id_produk]=1;
}


//echo "<pre>";
//print_r($_SESSION);
//echo "</pre>";

//larikan ke halaman keranjang
echo "<script>alert('produk telah masuk ke keranjang');</script>";
echo "<script>location='keranjang.php';</script>";
?>