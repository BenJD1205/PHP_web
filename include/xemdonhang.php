<?php
	if(isset($_GET['huydon'])&& isset($_GET['magiaodich'])){
		$huydon = $_GET['huydon'];
		$magiaodich = $_GET['magiaodich'];
	}else{
		$huydon = '';
		$magiaodich = '';
	}
	$sql_update_donhang = mysqli_query($conn,"UPDATE donhang SET huydon='$huydon' WHERE mahang='$magiaodich'");
	$sql_update_giaodich = mysqli_query($conn,"UPDATE giaodich SET huydon='$huydon' WHERE magiaodich='$magiaodich'");
?>
<!-- top Products -->
	<div class="ads-grid py-sm-5 py-4">
		<div class="container py-xl-4 py-lg-2">
			<!-- tittle heading -->
			<h3 class="tittle-w3l text-center mb-lg-5 mb-sm-4 mb-3">
				Xem đơn hàng
			</h3>
			<!-- //tittle heading -->
			<div class="row">
				<?php
					if(isset($_SESSION['dangnhap'])){
						echo 'Đơn hàng:' .$_SESSION['dangnhap'];
					}
				?>
				<div class="col-md-12">
					<?php
					if(isset($_GET['khachhang'])){
						$id_khachhang= $_GET['khachhang'];
					}else{
						$id_khachhang= '';
					}
					$sql_select = mysqli_query($conn,"select * from giaodich where giaodich.khachhang_id='$id_khachhang' GROUP BY giaodich.magiaodich");  
					?> 
					<table class="table table-bordered ">
						<tr>
							<th>Thứ tự</th>
							<th>Mã giao dịch</th>
							<th>Ngày đặt</th>
							<th>Xem giao dịch</th>
							<th>Tình trạng</th>
							<th>Yêu cầu</th>
						</tr>
						<?php
						$i = 0;
						while($row_donhang = mysqli_fetch_array($sql_select)){ 
							$i++;
						?> 
						<tr>
							<td><?php echo $i; ?></td>
							
							<td><?php echo $row_donhang['magiaodich']; ?></td>
							
							<td><?php echo $row_donhang['ngaythang'] ?></td>
							<td><a href="index.php?quanli=xemdonhang&khachhang=<?php echo $_SESSION['khachhang_id'] ?>&magiaodich=<?php echo $row_donhang['magiaodich'] ?>">Xem </a></td>
							<td>
								<?php
									if($row_donhang['tinhtrang']==0){
										echo 'Đã đặt hàng';
									}else{
										echo 'Đã xử lí || Đang giao hàng';
									}
								?>
							</td>
							<td>
								<?php
								if($row_donhang['huydon']==0){
								?>
									<a href="index.php?quanli=xemdonhang&khachhang=<?php echo $_SESSION['khachhang_id'] ?>&magiaodich=<?php echo $row_donhang['magiaodich'] ?>&huydon=1">Hủy</a>
								<?php
									}elseif($row_donhang['huydon']==1){

								?>
									<p>Đang chờ hủy</p>
								<?php
									}else{
										echo 'Đã hủy';
								?>
								<?php
									} 
								?>
							</td>
						</tr>
						 <?php
						} 
						?> 
					</table>
				</div>
				<div class="col-md-12">
					<p>Chi tiết đơn hàng</p>
					<?php
					if(isset($_GET['magiaodich'])){
						$magiaodich = $_GET['magiaodich'];
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
							<th>Số lượng</th>
							<th>Ngày đặt</th>
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
							<td><?php echo $row_donhang['soluong'] ?></td>
							<td><?php echo $row_donhang['ngaythang'] ?></td>

							<!-- <td><a href="?xoadonhang=<?php echo $row_donhang['mahang'] ?>">Xóa</a> || <a href="?quanli=xemdonhang&mahang=<?php echo $row_donhang['mahang'] ?>">Xem </a></td> -->
						</tr>
						 <?php
						} 
						?> 
					</table>
				</div>
			</div>
		</div>
	</div>
	<!-- //top products -->