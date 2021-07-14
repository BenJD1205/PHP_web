<?php
	require_once('../db/connect.php'); 
?>
 <?php
	if(isset($_POST['thembaiviet'])){
		$tenbaiviet = $_POST['tenbaiviet'];
		$hinhanh = $_FILES['hinhanh']['name'];
		$hinhanh_tpm = $_FILES['hinhanh']['tmp_name'];
		$danhmuc = $_POST['danhmuc'];
		$chitiet = $_POST['chitiet'];
		$mota = $_POST['mota'];
		$path ='../uploads/';

		$sql_insert = mysqli_query($conn, "INSERT into baiviet(danhmuc_id,tenbaiviet,tomtat, noidung,image) values('$danhmuc','$tenbaiviet','$mota','$chitiet','$hinhanh')");
		move_uploaded_file($hinhanh_tpm,$path.$hinhanh);
	}
	elseif(isset($_POST['capnhatbaiviet'])) {
		$id_update = $_POST['id_update'];
		$tenbaiviet = $_POST['tenbaiviet'];
		$hinhanh = $_FILES['hinhanh']['name'];
		$hinhanh_tpm = $_FILES['hinhanh']['tmp_name'];
		$danhmuc = $_POST['danhmuc'];
		$chitiet = $_POST['chitiet'];
		$mota = $_POST['mota'];
		$path ='../uploads/';
		if($hinhanh=='' ){
			$sql_update_image = "UPDATE baiviet set danhmuc_id='$danhmuc',tenbaiviet='$tenbaiviet',noidung='$chitiet',tomtat='$mota' where baiviet_id='$id_update'";
		}else{
			move_uploaded_file($hinhanh_tpm,$path.$hinhanh);
			$sql_update_image = "UPDATE baiviet set danhmuc_id='$danhmuc',tenbaiviet='$tenbaiviet',noidung='$chitiet',tomtat='$mota',image='$hinhanh' where baiviet_id='$id_update'";
		}
		mysqli_query($conn,$sql_update_image);
		header('Location: xulibaiviet.php');
	}
	if(isset($_GET['xoa'])){
		$id=$_GET['xoa'];
		$sql_xoa = mysqli_query($conn,"DELETE from baiviet where baiviet_id = '$id'");
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
					$sql_capnhat = mysqli_query($conn, "select * from baiviet where baiviet_id = '$id_capnhat'");
					$row_capnhat = mysqli_fetch_array($sql_capnhat);
					$id_category = $row_capnhat['danhmuc_id'];
			?> 
					<div class="col-md-4">
						<h4>Cập nhật bài viết</h4>
						<form action="" method="post" enctype="multipart/form-data">
							<label>Tên bài viết</label>
							<input type="text" class="form-control" name="tenbaiviet" value="<?php echo $row_capnhat['tenbaiviet'] ?>" placeholder="Tên bài viết">
							<input type="hidden" class="form-control" name="id_update" value="<?php echo $row_capnhat['baiviet_id'] ?>">
							<label>Hình ảnh</label>
							<input type="file" class="form-control" name="hinhanh" ><br>
							<img width="100%" src="../uploads/<?php echo $row_capnhat['image'] ?>" /><br>
							<label>Mô tả</label>
							<textarea rows="10" class="form-control" name="mota">
								<?php echo $row_capnhat['tomtat'] ?>
							</textarea>
							<label>Chi tiết</label>
							<textarea rows="10" class="form-control" name="chitiet"><?php echo $row_capnhat['noidung'] ?></textarea>
							<label>Danh mục</label>
							<?php
								$sql_danhmuc = mysqli_query($conn,"select * from danhmuctin ORDER BY danhmuc_id DESC"); 
							?>
							<select class="form-control" name="danhmuc">
								<option value="">--->Chọn danh mục<---</option>
								<?php
									while ($row_danhmuc=mysqli_fetch_array($sql_danhmuc)) {
										if($id_category==$row_danhmuc['danhmuc_id']){

									     
								?>
								<option selected="" value="<?php echo $row_danhmuc['danhmuc_id'] ?>"><?php echo $row_danhmuc['tendanhmuc'] ?></option>
								<?php
									}else{
										 
								?>
									<option value="<?php echo $row_danhmuc['danhmuc_id'] ?>"><?php echo $row_danhmuc['tendanhmuc'] ?></option>
								<?php
										}
									}
								?>								
							</select>
							<input type="submit" name="capnhatbaiviet" value="Cập nhật bài viết" style="margin:10px;" class="btn btn-success">

						</form>
					</div> 	
					<?php
						}else{
					?>
					<div class="col-md-4">
						<h4>Thêm bài viết</h4>
						<form action="" method="post" enctype="multipart/form-data">
							<label>Tên bài viết</label>
							<input type="text" class="form-control" name="tenbaiviet" placeholder="Tên bài viết">
							<label>Hình ảnh</label>
							<input type="file" class="form-control" name="hinhanh" >
							<label>Nội dung</label>
							<textarea class="form-control" name="mota"></textarea>
							<label>Tóm tắt</label>
							<textarea class="form-control" name="chitiet"></textarea>
							<label>Danh mục</label>
							<?php
								$sql_danhmuc = mysqli_query($conn,"select * from danhmuctin ORDER BY danhmuc_id DESC"); 
							?>
							<select class="form-control" name="danhmuc">
								<option value="">--->Chọn danh mục<---</option>
								<?php
									while ($row_danhmuc=mysqli_fetch_array($sql_danhmuc)) {
									     
								?>
								<option value="<?php echo $row_danhmuc['danhmuc_id'] ?>"><?php echo $row_danhmuc['tendanhmuc'] ?></option>
								<?php
									}
								?>								
							</select>
							<input type="submit" name="thembaiviet" value="Thêm bài viết" style="margin:10px;" class="btn btn-success">

						</form>
					</div> 	
				<?php
				} 
				?>	

			<div class="col-md-8">
				<h4>Liệt kê bài viết</h4>
				<?php 
					$sql_select_sanpham= mysqli_query($conn, "select * from baiviet,danhmuctin where baiviet.danhmuc_id = danhmuctin.danhmuc_id ORDER BY baiviet.baiviet_id DESC");
				?>
				<table class="table table-bordered">
					<thead>
						<tr>
							<th>Thứ tự</th>
							<th>Tên	sản phẩm</th>
							<th>Hình ảnh</th>
							<th>Danh mục</th>
							<th>Quản lí</th>
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
							<td><?php echo $row_sanpham['tenbaiviet'] ?></td>
							<td><img src="../uploads/<?php echo $row_sanpham['image'] ?>" height="80"></td>
							<td><?php echo $row_sanpham['tendanhmuc'] ?></td>
							<td><a href="?xoa=<?php echo $row_sanpham['baiviet_id'] ?>">Xóa</a> || <a href="xulibaiviet.php?quanli=capnhat&id=<?php echo $row_sanpham['baiviet_id'] ?>">Cập nhật</a></td>
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