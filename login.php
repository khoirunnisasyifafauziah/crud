<?php
	session_start();
	include 'conn.php';
	//cek ada variabel post email dan password
	if(isset($_POST['email']) and isset($_POST['password'])){
		//masukan ke variabel
		$email = $_POST['email'];
		$password = md5($_POST['password']);
		//cek ke tabel user
		$s = $koneksi->prepare('SELECT *FROM user WHERE email="'.$email.'" AND PASSWORD="'.$password.'"');
		$s->Execute();
		$data = $s->fetch(PDO::FETCH_ASSOC);

		// Jika data kosong, tampilkan pesan email dan password salah

		if(empty($data)){
			?>
			<div style="width:100%;display:block;clear: both;
				background: red;color:white;margin: 20px;padding:10px;">
				E-mail Atau password tidak terdaftar
				</div>
			<?php
			$_SESSION['logged_in']=false; 
		// Jika data ada, masuk dengan email dan nama yang sudah terdaftar
		// kemudian diarahkan ke halaman index
		}else{
			$nama = $data['nama'];
			$_SESSION['logged_in'] = true;
			$_SESSION['nama'] = $nama;
			$_SESSION['id'] = $data['id'];
			$_SESSION['email'] = $email;
			header("location:index.php");
		}
	}
	?>
<!DOCTYPE html>
<html>
<head>
	<title> SIGN In</title>
	<link rel="stylesheet"
	type="text/css"
	href="assets/css/css.css">
</head>
<body>
	<div style="width:400px;margin:100px auto;
	border:5px solid #dd4814;padding: 20px;padding-right: 40px; background:#333;color:#fff;"">
	<h4 style="text-align: center">Sign In</h4>
	<form method="POST" action="">
	<table>
		<tr>
			<td>E-mail</td>
			<td><input type="email" name="email"></td>
		</tr>
		<tr>
			<td>Password</td>
			<td><input type="password" name="password"></td>
		</tr>
		<tr>
			<td colspan="2">
				No Account? <a href="register.php"
				style="color:white;">Register here</a>
			</td>
		</tr>
		<tr>
			<td>
			</td>
			<td><button type="submit">Sign In</button></td>
		</tr>
	</table>
	</form>
</body>
<?
</html>