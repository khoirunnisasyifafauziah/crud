<?php
	session_start();
	include 'conn.php';
	//cek ada variabel post email dan password
	if(isset($_POST['nama']) and isset($_POST['email']) and isset($_POST['password'])){
		//masukan ke variabel
		$nama = $_POST['nama'];
		$email = $_POST['email'];
		$password = md5($_POST['password']);
		//cek ke tabel user
		$s = $koneksi->prepare('SELECT *FROM user WHERE email="'.$email.'"');
		$s->Execute();
		$data = $s->fetch(PDO::FETCH_ASSOC);

		// Jika data ada, tampilkan pesan email sudah terdaftar

		if(!empty($data)){
			?>
			<div style="width:100%;display:block;clear: both;
				background: red;color:white;margin: 20px;padding:10px;">
				E-mail sudah terdaftar
				</div>
			<?php
			$_SESSION['logged_in']=false; 
		// Jika data kosong input ke tabel user dan assign ke session
		// kemudian diarahkan ke halaman index
		}else{
			$_SESSION['logged_in'] = true;
			$_SESSION['nama'] = $nama;
			$_SESSION['email'] = $email;

			$new = $koneksi->prepare('INSERT INTO user(`nama`,`email`,`password`) VALUES ("'.$nama.'","'.$email.'","'.$password.'")');
			$new->Execute();

			$_SESSION['id'] = $koneksi->lastInsertId();	

			header("location:login.php");
		}
	}
	?>
<!DOCTYPE html>
<html>
<head>
	<title> SIGN UP</title>
	<link rel="stylesheet"
	type="text/css"
	href="assets/css/css.css">
</head>
<body>
	<div style="width:400px;margin:100px auto;
	border:5px solid #dd4814;padding: 20px;padding-right: 40px; background:#333;color:#fff;"">
	<h4 style="text-align: center">Sign Up</h4>
	<form method="POST" action="">
	<table>
		<tr>
			<td>E-mail</td>
			<td><input type="text" name="nama"></td>
		</tr>
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
				No Account? <a href="login.php"
				style="color:white;">Sign up here</a>
			</td>
		</tr>
		<tr>
			<td>
			</td>
			<td><button type="submit">Sign up</button></td>
		</tr>
	</table>
	</form>
</body>
</html>