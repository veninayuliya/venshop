<?php
session_start();
include 'koneksi.php';
?>

<!DOCTYPE html>
<html>
<head>
	<title>Login Admin</title>
	<link rel="stylesheet" type="text/css" href="login.css">
</head>
<body background="../img/bgputih.webp">
	<br>
	<div class="loginbox">
			<img src="../img/login.webp" class="avatar">
			<h2>Login Admin</h2>
			<form method="post">
				<p>Username</p>
				<input type="text" class="" name="user" size="40" placeholder="Masukkan username">
				<p>Password</p>
				<input type="password" class="" name="pass" size="40" placeholder="Masukkan password"><br><br>
				<input type="submit" name="login" value="Login">
			</form>
		</div>

		<?php
		if(isset($_POST['login']))
		{
			$tampil = $koneksi->query("SELECT * FROM admin WHERE username='$_POST[user]' AND password='$_POST[pass]'");
			$cocok = $tampil->num_rows;
			if($cocok==1)
			{
				$_SESSION['admin']=$tampil->fetch_assoc();
				echo "<script>alert('Login sukses');</script>";
				echo "<meta http-equiv='refresh' content='1;url=index.php'>";
			}
			else
			{
				echo "<script>alert('Login gagal');</script>";
				echo "<meta http-equiv='refresh' content='1;url=login.php'>";
			}
		}
		?>
	</div>


</body>
</html>