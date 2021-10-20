<?php
session_start();
include 'koneksi.php';
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width">
	<title>Login Pelanggan</title>
	<link rel="stylesheet" type="text/css" href="styleLogin.css">
</head>
<body>
	
	<br>
	<div>
		
		<div class="loginbox">
			<img src="img/login.webp" class="avatar">
			<h2>Login</h2>
			<form method="post">
				<p>Email</p>
				<input type="email" class="" name="email" size="40" placeholder="Masukkan email">
				<p>Password</p>
				<input type="password" class="" name="password" size="40" placeholder="Masukkan password"><br><br>
				<input type="submit" name="login" value="Login"><br>
				<a href="daftar.php" class="daftar">Belum punya akun ?  Daftar</a>
			</form>

		</div>

		<?php
		//jika ada tombol login 
		if(isset($_POST["login"]))
		{

			$email = $_POST["email"];
			$password = $_POST["password"];
			//lakukan query mengecek akun di tabel pelanggan di db
			$tampil = $koneksi->query("SELECT * FROM pelanggan WHERE email_pelanggan='$email'
				AND password_pelanggan='$password'");


			//ngitung akun yg terambil
			$akunbenar = $tampil->num_rows;

			//jika 1 akun cocok maka login
			if($akunbenar==1)
			{
				//anda login
				$akun = $tampil->fetch_assoc();
				//simpan d session pelanggan
				$_SESSION["pelanggan"] = $akun;
				echo "<script>alert('Login berhasil')</script>";
				echo "<script>location='checkout.php';</script>";
			}
			else
			{
				//anda gagal login
				echo "<script>alert('Anda gagal login')</script>";
				echo "<script>location='login.php';</script>";
			}
		}
		?>

</body>
</html>