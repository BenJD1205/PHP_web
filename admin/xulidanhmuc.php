<?php
	require_once('../db/connect.php'); 
?>
<?php
	if(isset($_POST['themdanhmuc'])){
		$tendanhmuc = $_POST['danhmuc'];
		$sql_insert = mysqli_query($conn, "INSERT into category(category_name) values('$tendanhmuc')");
	}elseif(isset($_POST['capnhatdanhmuc'])) {
		$id_post = $_POST['id_danhmuc'];
		$tendanhmuc = $_POST['danhmuc'];
		$sql_update = mysqli_query($conn, "UPDATE category set category_name = '$tendanhmuc' where category_id='$id_post'");
		header('Location: xulidanhmuc.php');
	}
	if(isset($_GET['xoa'])){
		$id=$_GET['xoa'];
		$sql_xoa = mysqli_query($conn,"DELETE from category where category_id = '$id'");
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
	          <a class="nav-link" href="xulisanpham.php">Sản phẩm</a>
	        </li>
	        <li class="nav-item">
	        <a class="nav-link" href="xulidanhmucbaiviet.php">Danh mục Bài viết</a>
	       <li class="nav-item">
	          <a class="nav-link" href="xulibaiviet.php">Bài viết</a>
	        </li>
	        <li class="nav-item">
	          <a class="nav-link" href="#">Khách hàng</a>
	        </li>
	      </ul>
	    </div>
	  </div>
	</nav>
	<div class="container">
		<div class="row">
			<?php
				if(isset($_GET['quanli'])){
					$capnhat = $_GET['quanli'];
				}else{
					$capnhat = '';
				}

				if($capnhat=='capnhat'){
					$id_capnhat = $_GET['id'];
					$sql_capnhat = mysqli_query($conn, "select * from category where category_id = '$id_capnhat'");
					$row_capnhat = mysqli_fetch_array($sql_capnhat);
				?>
					<div class="col-md-4">
					<h4>Cập nhật danh mục</h4>
					<form action="" method="post">
						<label>Tên danh mục</label>
						<input type="text" class="form-control" name="danhmuc" value="<?php echo $row_capnhat['category_name'] ?>" >
						<input type="hidden" class="form-control" name="id_danhmuc" value="<?php echo $row_capnhat['category_id'] ?>" >
						<input type="submit" name="capnhatdanhmuc" value="Cập nhật danh mục" style="margin:10px;" class="btn btn-success">
					</form>
				</div>
				<?php
					}else{
				?>
					<div class="col-md-4">
						<h4>Thêm danh mục</h4>
						<form action="" method="post">
							<label>Tên danh mục</label>
							<input type="text" class="form-control" name="danhmuc" placeholder="Tên danh mục">
							<input type="submit" name="themdanhmuc" value="Thêm danh mục" style="margin:10px;" class="btn btn-success">
						</form>
					</div> 	
				<?php
				} 
				?>		

			<div class="col-md-8">
				<h4>Liệt kê danh mục</h4>
				<?php 
					$sql_select= mysqli_query($conn, "select * from category ORDER BY category_id DESC");
				?>
				<table class="table table-bordered">
					<thead>
						<tr>
							<th>Thứ tự</th>
							<th>Tên danh mục</th>
						</tr>
					</thead>
					<tbody>
						<?php
							$i=0;	
							while($row_category= mysqli_fetch_array($sql_select))
							{
								$i++;
									 
						?>
						<tr>
							<td><?php echo $i ?></td>
							<td><?php echo $row_category['category_name'] ?></td>
							<td><a href="?xoa=<?php echo $row_category['category_id'] ?>">Xóa</a> || <a href="?quanli=capnhat&id=<?php echo $row_category['category_id'] ?>">Cập nhật</a></td>
						</tr>
						<?php
							} 
						?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</body>
</html>