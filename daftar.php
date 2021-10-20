<?php
include 'koneksi.php';
?>


<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="styleDaftar.css">
	<title>Daftar</title>
</head>
<body>

	<div class="daftarbox">
			<h2>Daftar Pelanggan</h2>
			<form method="post">
				<p>Nama</p>
				<input type="text" class="" name="nama" placeholder="Masukkan nama" required>
				<p>Email</p>
				<input type="email" class="" name="email" placeholder="Masukkan email" required>
				<p>Password</p>
				<input type="text" class="" name="password" placeholder="Masukkan password" required>
				<p>Telepon/Hp</p>
				<input type="text" class="" name="telepon" placeholder="Masukkan no.telp" required>
				<br><br>
				<input type="submit" name="daftar" value="Daftar"><br>
			</form>
			<?php
			//jika daftar diklik
			if(isset($_POST["daftar"]))
			{
				//mengambil inputan
				$nama = $_POST["nama"];
				$email = $_POST["email"];
				$password = $_POST["password"];
				$telepon = $_POST["telepon"];

				//validasi
				$tampil = $koneksi->query("SELECT * FROM pelanggan WHERE email_pelanggan='$email'");
				$cocok = $tampil->num_rows;
				if($cocok==1)
				{
					echo "<script>alert('Pendaftaran GAGAL. Email sudah digunakan');</script>";
					echo "<script>location='daftar.php';</script>";
				}
				else
				{
					//insert ke tabel pelanggan
					$koneksi->query("INSERT INTO pelanggan(email_pelanggan, password_pelanggan, nama_pelanggan, telepon_pelanggan) VALUES ('$email','$password','$nama','$telepon')");
					echo "<script>alert('Pendaftaran SUKSES. Silahkan login');</script>";
					echo "<script>location='login.php';</script>";
				}

				


			}

			?>

		</div>

</body>
</html>