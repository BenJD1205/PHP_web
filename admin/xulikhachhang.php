<?php
	include('../db/connect.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Đơn hàng</title>
	<link href="../css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
</head>
<body>
	<nav class="navbar navbar-expand-lg navbar-light bg-light">
	  <div class="collapse navbar-collapse" id="navbarNav">
	    <ul class="navbar-nav">
	      <li class="nav-item active">
	        <a class="nav-link" href="xulydonhang.php">Đơn hàng <span class="sr-only">(current)</span></a>
	      </li>
	      <li class="nav-item">
	        <a class="nav-link" href="xulidanhmuc.php">Danh mục</a>
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
	         <a class="nav-link" href="xulikhachhang.php">Khách hàng</a>
	      </li>
	      
	    </ul>
	  </div>
	</nav><br><br>
	<div class="container-fluid">
		<div class="row">			
			<div class="col-md-12">
				<h4>Khách hàng</h4>
				<?php
				$sql_select = mysqli_query($conn,"select * from khachhang, giaodich where khachhang.khachhang_id=giaodich.khachhang_id ORDER BY khachhang.khachhang_id"); 
				?> 
				<table class="table table-bordered ">
					<tr>
						<th>Thứ tự</th>
						<th>Tên khách hàng</th>
						<th>Phone</th>
						<th>Address</th>
						<th>Email</th>
						<th>Ngày mua</th>
						<th>Quản lý</th>
					</tr>
					<?php
					$i = 0;
					while($row_khachhang = mysqli_fetch_array($sql_select)){ 
						$i++;
					?> 
					<tr>
						<td><?php echo $i; ?></td>
						
						<td><?php echo $row_khachhang['name']; ?></td>
						<td><?php echo $row_khachhang['phone']; ?></td>
						
						<td><?php echo $row_khachhang['address'] ?></td>
						<td><?php echo $row_khachhang['email'] ?></td>
						<td><?php echo $row_khachhang['ngaythang'] ?></td>
						<td><a href="?quanli=xemgiaodich&khachhang=<?php echo $row_khachhang['magiaodich'] ?>">Xem </a></td>
					</tr>
					 <?php
					} 
					?> 
				</table>
			</div>
		</div>
	</div>
	<div class="col-md-12">
		<h4>Liệt kê lịch sử đơn hàng</h4>
		<?php
		if(isset($_GET['khachhang'])){
			$magiaodich = $_GET['khachhang'];
		}else{
			$magiaodich = '';
		}
		$sql_select = mysqli_query($conn,"select * from giaodich,khachhang,sanpham where giaodich.sanpham_id=sanpham.sanpham_id and khachhang.khachhang_id = giaodich.khachhang_id and giaodich.magiaodich='$magiaodich' ORDER BY giaodich.giaodich_id DESC");  
		?> 
		<table class="table table-bordered ">
			<tr>
				<th>Thứ tự</th>
				<th>Mã giao dịch</th>
				<th>Tên sản phẩm</th>
				<th>Ngày đặt</th>
				<th>Ghi chú</th>
			</tr>
			<?php
			$i = 0;
			while($row_donhang = mysqli_fetch_array($sql_select)){ 
				$i++;
			?> 
			<tr>
				<td><?php echo $i; ?></td>
				
				<td><?php echo $row_donhang['magiaodich']; ?></td>
				<td><?php echo $row_donhang['sanpham_name']; ?></td>
				
				<td><?php echo $row_donhang['ngaythang'] ?></td>
				<td><?php echo $row_donhang['note'] ?></td>

				<!-- <td><a href="?xoadonhang=<?php echo $row_donhang['mahang'] ?>">Xóa</a> || <a href="?quanli=xemdonhang&mahang=<?php echo $row_donhang['mahang'] ?>">Xem </a></td> -->
			</tr>
			 <?php
			} 
			?> 
		</table>
	</div>
	
</body>
</html>