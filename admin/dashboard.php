<?php
	session_start();
	if(!isset($_SESSION['dangnhap'])){
		header('Location: index.php');
	}
	if(isset($_GET['login'])){
		$dangxuat = $_GET['login'];
	}else {
		$dangxuat = '';
	}
	if($dangxuat == 'dangxuat'){
		session_destroy();
		header('Location: index.php');
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Dashboard</title>
	<link href="../css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
</head>
<body>
	<h1>Welcome: <?php echo $_SESSION['dangnhap'] ?></h1>
	<a href="?login=dangxuat">Logout</a>
	<nav class="navbar navbar-expand-lg navbar-light bg-light">
	  <div class="container-fluid">
	    <a class="navbar-brand" href="#">Navbar</a>
	    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
	      <span class="navbar-toggler-icon"></span>
	    </button>
	    <div class="collapse navbar-collapse" id="navbarNav">
	      <ul class="navbar-nav">
	        <li class="nav-item">
	          <a class="nav-link active" aria-current="page" href="xulidonhang.php">Đơn hàng</a>
	        </li>
	        <li class="nav-item">
	          <a class="nav-link" href="xulidanhmuc.php?quanli=danhmuc">Danh mục</a>
	        </li>
	        <li class="nav-item">
	          <a class="nav-link" href="xulidanhmucbaiviet.php">Danh mục bài viết</a>
	        </li>
	        <li class="nav-item">
	          <a class="nav-link" href="xulibaiviet.php">Bài viết</a>
	        </li>
	        <li class="nav-item">
	          <a class="nav-link" href="xulisanpham.php">Sản phẩm</a>
	        </li>
	        <li class="nav-item">
	          <a class="nav-link" href="xulikhachhang.php">Khách hàng</a>
	        </li>
	      </ul>
	    </div>
	  </div>
	</nav>
</body>
</html>