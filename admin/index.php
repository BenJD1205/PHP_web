<?php
	session_start();
	require_once('../db/connect.php'); 
?>
<?php
	if(isset($_POST['dangnhap'])){
		$username = $_POST['username'];

		$password = md5($_POST['password']);

		if($username =='' || $password ==''){
			echo 'Xin nhập đủ';
		}else{
			$sql_select_admin= mysqli_query($conn,"select * from admin where email='$username' and password='$password' LIMIT 1");
			$count = mysqli_num_rows($sql_select_admin);
			$row_login = mysqli_fetch_array($sql_select_admin);
			if($count>0){
				$_SESSION['dangnhap'] = $row_login['admin'];
				$_SESSION['admin_id'] = $row_login['admin_id'];
				header('Location: dashboard.php');
			}else{
				echo '<p>Tài khoản hoặc mật khẩu sai</p>';
			}
			
		}
	}  
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Đăng nhập Admin</title>
	<link href="../css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
</head>
<body>
	<div class="container">
		<h1 align="center">Đăng nhập Admin</h1>
		<form action="" method="post">
			<div class="form-group">
				<label>Tài khoản</label>
				<input type="text" name="username" class="form-control">
			</div>
			<div class="form-group">
				<label>Mật khẩu</label>
				<input type="password" name="password" class="form-control">
			</div>
			<input type="submit" name="dangnhap" class="btn btn-success" value="Đăng nhập">
		</form>
	</div>
</body>
</html>