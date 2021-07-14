<?php
	require_once('../db/connect.php'); 
?>
 <?php
	if(isset($_POST['themsanpham'])){
		$tensanpham = $_POST['tensanpham'];
		$hinhanh = $_FILES['hinhanh']['name'];
		$hinhanh_tpm = $_FILES['hinhanh']['tmp_name'];
		$soluong = $_POST['soluong'];
		$giasanpham = $_POST['giasanpham'];
		$giakhuyenmai = $_POST['giakhuyenmai'];
		$danhmuc = $_POST['danhmuc'];
		$chitiet = $_POST['chitiet'];
		$mota = $_POST['mota'];
		$path ='../uploads/';

		$sql_insert = mysqli_query($conn, "INSERT into sanpham(category_id,sanpham_name,sanpham_chitiet, sanpham_mota,price,discount,sanpham_sl,sanpham_image) values('$danhmuc','$tensanpham','$chitiet','$mota','$giasanpham','$giakhuyenmai','$soluong','$hinhanh')");
		move_uploaded_file($hinhanh_tpm,$path.$hinhanh);
	}
	elseif(isset($_POST['capnhatsanpham'])) {
		$id_update = $_POST['id_update'];
		$tensanpham = $_POST['tensanpham'];
		$hinhanh = $_FILES['hinhanh']['name'];
		$hinhanh_tpm = $_FILES['hinhanh']['tmp_name'];
		$soluong = $_POST['soluong'];
		$giasanpham = $_POST['giasanpham'];
		$giakhuyenmai = $_POST['giakhuyenmai'];
		$danhmuc = $_POST['danhmuc'];
		$chitiet = $_POST['chitiet'];
		$mota = $_POST['mota'];
		$path ='../uploads/';
		if($hinhanh=='' ){
			$sql_update_image = "UPDATE sanpham set category_id='$danhmuc',sanpham_name='$tensanpham',sanpham_chitiet='$chitiet',sanpham_mota='$mota',price='$giasanpham',discount='$giakhuyenmai',sanpham_sl='$soluong' where sanpham_id='$id_update'";
		}else{
			move_uploaded_file($hinhanh_tpm,$path.$hinhanh);
			$sql_update_image = "UPDATE sanpham set category_id='$danhmuc',sanpham_name='$tensanpham',sanpham_chitiet='$chitiet',sanpham_mota='$mota',price='$giasanpham',discount='$giakhuyenmai',sanpham_sl='$soluong',sanpham_image='$hinhanh' where sanpham_id='$id_update'";
		}
		mysqli_query($conn,$sql_update_image);
		header('Location: xulisanpham.php');
	}
	if(isset($_GET['xoa'])){
		$id=$_GET['xoa'];
		$sql_xoa = mysqli_query($conn,"DELETE from sanpham where sanpham_id = '$id'");
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
	<div class="container">
		<div class="row">
			<?php

				if(isset($_GET['quanli'])=='capnhat'){
					$id_capnhat = $_GET['id'];
					$sql_capnhat = mysqli_query($conn, "select * from sanpham where sanpham_id = '$id_capnhat'");
					$row_capnhat = mysqli_fetch_array($sql_capnhat);
					$id_category = $row_capnhat['category_id'];
			?> 
					<div class="col-md-4">
						<h4>Cập nhật sản phẩm</h4>
						<form action="" method="post" enctype="multipart/form-data">
							<label>Tên sản phẩm</label>
							<input type="text" class="form-control" name="tensanpham" value="<?php echo $row_capnhat['sanpham_name'] ?>" placeholder="Tên sản phẩm">
							<input type="hidden" class="form-control" name="id_update" value="<?php echo $row_capnhat['sanpham_id'] ?>">
							<label>Hình ảnh</label>
							<input type="file" class="form-control" name="hinhanh" ><br>
							<img width="100%" src="../uploads/<?php echo $row_capnhat['sanpham_image'] ?>" /><br>
							<label>Giá</label>
							<input type="text" class="form-control" name="giasanpham" value="<?php echo $row_capnhat['price'] ?>"  placeholder="Giá sản phẩm">
							<label>Giá khuyến mãi</label>
							<input type="text" class="form-control" name="giakhuyenmai" value="<?php echo $row_capnhat['discount'] ?>"  placeholder="Giá khuyến mãi">
							<label>Số lượng</label>
							<input type="number" class="form-control" name="soluong" value="<?php echo $row_capnhat['sanpham_sl'] ?>"  placeholder="Số lượng">
							<label>Mô tả</label>
							<textarea rows="10" class="form-control" name="mota">
								<?php echo $row_capnhat['sanpham_mota'] ?>
							</textarea>
							<label>Chi tiết</label>
							<textarea rows="10" class="form-control" name="chitiet"><?php echo $row_capnhat['sanpham_chitiet'] ?></textarea>
							<label>Danh mục</label>
							<?php
								$sql_danhmuc = mysqli_query($conn,"select * from category ORDER BY category_id DESC"); 
							?>
							<select class="form-control" name="danhmuc">
								<option value="">--->Chọn danh mục<---</option>
								<?php
									while ($row_danhmuc=mysqli_fetch_array($sql_danhmuc)) {
										if($id_category==$row_danhmuc['category_id']){

									     
								?>
								<option selected="" value="<?php echo $row_danhmuc['category_id'] ?>"><?php echo $row_danhmuc['category_name'] ?></option>
								<?php
									}else{
										 
								?>
									<option value="<?php echo $row_danhmuc['category_id'] ?>"><?php echo $row_danhmuc['category_name'] ?></option>
								<?php
										}
									}
								?>								
							</select>
							<input type="submit" name="capnhatsanpham" value="Cập nhật sản phẩm" style="margin:10px;" class="btn btn-success">

						</form>
					</div> 	
					<?php
						}else{
					?>
					<div class="col-md-4">
						<h4>Thêm sản phẩm</h4>
						<form action="" method="post" enctype="multipart/form-data">
							<label>Tên sản phẩm</label>
							<input type="text" class="form-control" name="tensanpham" placeholder="Tên sản phẩm">
							<label>Hình ảnh</label>
							<input type="file" class="form-control" name="hinhanh" >
							<label>Giá</label>
							<input type="text" class="form-control" name="giasanpham" placeholder="Giá sản phẩm">
							<label>Giá khuyến mãi</label>
							<input type="text" class="form-control" name="giakhuyenmai" placeholder="Giá khuyến mãi">
							<label>Số lượng</label>
							<input type="number" class="form-control" name="soluong" placeholder="Số lượng">
							<label>Mô tả</label>
							<textarea class="form-control" name="mota"></textarea>
							<label>Chi tiết</label>
							<textarea class="form-control" name="chitiet"></textarea>
							<label>Danh mục</label>
							<?php
								$sql_danhmuc = mysqli_query($conn,"select * from category ORDER BY category_id DESC"); 
							?>
							<select class="form-control" name="danhmuc">
								<option value="">--->Chọn danh mục<---</option>
								<?php
									while ($row_danhmuc=mysqli_fetch_array($sql_danhmuc)) {
									     
								?>
								<option value="<?php echo $row_danhmuc['category_id'] ?>"><?php echo $row_danhmuc['category_name'] ?></option>
								<?php
									}
								?>								
							</select>
							<input type="submit" name="themsanpham" value="Thêm sản phẩm" style="margin:10px;" class="btn btn-success">

						</form>
					</div> 	
				<?php
				} 
				?>	

			<div class="col-md-8">
				<h4>Liệt kê sản phẩm</h4>
				<?php 
					$sql_select_sanpham= mysqli_query($conn, "select * from sanpham,category where sanpham.category_id = category.category_id ORDER BY sanpham_id DESC");
				?>
				<table class="table table-bordered">
					<thead>
						<tr>
							<th>Thứ tự</th>
							<th>Tên	sản phẩm</th>
							<th>Hình ảnh</th>
							<th>Số lượng</th>
							<th>Danh mục</th>
							<th>Giá sản phẩm</th>
							<th>Giá khuyến mãi</th>
						</tr>
					</thead>
					<tbody>
						<?php
							$i=0;	
							while($row_sanpham= mysqli_fetch_array($sql_select_sanpham))
							{
								$i++;
									 
						?>
						<tr>
							<td><?php echo $i ?></td>
							<td><?php echo $row_sanpham['sanpham_name'] ?></td>
							<td><img src="../uploads/<?php echo $row_sanpham['sanpham_image'] ?>" height="80"></td>
							<td><?php echo $row_sanpham['sanpham_sl'] ?></td>
							<td><?php echo $row_sanpham['category_name'] ?></td>
							<td><?php echo number_format($row_sanpham['price']) ?></td>
							<td><?php echo number_format($row_sanpham['discount']) ?></td>
							<td><a href="?xoa=<?php echo $row_sanpham['sanpham_id'] ?>">Xóa</a> || <a href="xulisanpham.php?quanli=capnhat&id=<?php echo $row_sanpham['sanpham_id'] ?>">Cập nhật</a></td>
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