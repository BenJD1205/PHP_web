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
	          <a class="nav-link active" aria-current="page" href="xulidonhang.php">????n h??ng</a>
	        </li>
	        <li class="nav-item">
	          <a class="nav-link" href="xulidanhmuc.php?quanli=danhmuc">Danh m???c</a>
	        </li>
	        <li class="nav-item">
	          <a class="nav-link" href="xulidanhmucbaiviet.php">Danh m???c b??i vi???t</a>
	        </li>
	        <li class="nav-item">
	          <a class="nav-link" href="xulibaiviet.php">B??i vi???t</a>
	        </li>
	        <li class="nav-item">
	          <a class="nav-link" href="xulisanpham.php">S???n ph???m</a>
	        </li>
	        <li class="nav-item">
	          <a class="nav-link" href="xulikhachhang.php">Kh??ch h??ng</a>
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
						<h4>C???p nh???t s???n ph???m</h4>
						<form action="" method="post" enctype="multipart/form-data">
							<label>T??n s???n ph???m</label>
							<input type="text" class="form-control" name="tensanpham" value="<?php echo $row_capnhat['sanpham_name'] ?>" placeholder="T??n s???n ph???m">
							<input type="hidden" class="form-control" name="id_update" value="<?php echo $row_capnhat['sanpham_id'] ?>">
							<label>H??nh ???nh</label>
							<input type="file" class="form-control" name="hinhanh" ><br>
							<img width="100%" src="../uploads/<?php echo $row_capnhat['sanpham_image'] ?>" /><br>
							<label>Gi??</label>
							<input type="text" class="form-control" name="giasanpham" value="<?php echo $row_capnhat['price'] ?>"  placeholder="Gi?? s???n ph???m">
							<label>Gi?? khuy???n m??i</label>
							<input type="text" class="form-control" name="giakhuyenmai" value="<?php echo $row_capnhat['discount'] ?>"  placeholder="Gi?? khuy???n m??i">
							<label>S??? l?????ng</label>
							<input type="number" class="form-control" name="soluong" value="<?php echo $row_capnhat['sanpham_sl'] ?>"  placeholder="S??? l?????ng">
							<label>M?? t???</label>
							<textarea rows="10" class="form-control" name="mota">
								<?php echo $row_capnhat['sanpham_mota'] ?>
							</textarea>
							<label>Chi ti???t</label>
							<textarea rows="10" class="form-control" name="chitiet"><?php echo $row_capnhat['sanpham_chitiet'] ?></textarea>
							<label>Danh m???c</label>
							<?php
								$sql_danhmuc = mysqli_query($conn,"select * from category ORDER BY category_id DESC"); 
							?>
							<select class="form-control" name="danhmuc">
								<option value="">--->Ch???n danh m???c<---</option>
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
							<input type="submit" name="capnhatsanpham" value="C???p nh???t s???n ph???m" style="margin:10px;" class="btn btn-success">

						</form>
					</div> 	
					<?php
						}else{
					?>
					<div class="col-md-4">
						<h4>Th??m s???n ph???m</h4>
						<form action="" method="post" enctype="multipart/form-data">
							<label>T??n s???n ph???m</label>
							<input type="text" class="form-control" name="tensanpham" placeholder="T??n s???n ph???m">
							<label>H??nh ???nh</label>
							<input type="file" class="form-control" name="hinhanh" >
							<label>Gi??</label>
							<input type="text" class="form-control" name="giasanpham" placeholder="Gi?? s???n ph???m">
							<label>Gi?? khuy???n m??i</label>
							<input type="text" class="form-control" name="giakhuyenmai" placeholder="Gi?? khuy???n m??i">
							<label>S??? l?????ng</label>
							<input type="number" class="form-control" name="soluong" placeholder="S??? l?????ng">
							<label>M?? t???</label>
							<textarea class="form-control" name="mota"></textarea>
							<label>Chi ti???t</label>
							<textarea class="form-control" name="chitiet"></textarea>
							<label>Danh m???c</label>
							<?php
								$sql_danhmuc = mysqli_query($conn,"select * from category ORDER BY category_id DESC"); 
							?>
							<select class="form-control" name="danhmuc">
								<option value="">--->Ch???n danh m???c<---</option>
								<?php
									while ($row_danhmuc=mysqli_fetch_array($sql_danhmuc)) {
									     
								?>
								<option value="<?php echo $row_danhmuc['category_id'] ?>"><?php echo $row_danhmuc['category_name'] ?></option>
								<?php
									}
								?>								
							</select>
							<input type="submit" name="themsanpham" value="Th??m s???n ph???m" style="margin:10px;" class="btn btn-success">

						</form>
					</div> 	
				<?php
				} 
				?>	

			<div class="col-md-8">
				<h4>Li???t k?? s???n ph???m</h4>
				<?php 
					$sql_select_sanpham= mysqli_query($conn, "select * from sanpham,category where sanpham.category_id = category.category_id ORDER BY sanpham_id DESC");
				?>
				<table class="table table-bordered">
					<thead>
						<tr>
							<th>Th??? t???</th>
							<th>T??n	s???n ph???m</th>
							<th>H??nh ???nh</th>
							<th>S??? l?????ng</th>
							<th>Danh m???c</th>
							<th>Gi?? s???n ph???m</th>
							<th>Gi?? khuy???n m??i</th>
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
							<td><a href="?xoa=<?php echo $row_sanpham['sanpham_id'] ?>">X??a</a> || <a href="xulisanpham.php?quanli=capnhat&id=<?php echo $row_sanpham['sanpham_id'] ?>">C???p nh???t</a></td>
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