<?php
	if(isset($_POST['themgiohang'])){
		$tensanpham = $_POST['tensanpham'];
		$sanpham_id = $_POST['sanpham_id'];
		$hinhanh = $_POST['hinhanh'];
		$gia = $_POST['giasanpham'];
		$soluong = $_POST['soluong'];

		
		$sql_cart = mysqli_query($conn,"select * from giohang where sanpham_id='$sanpham_id'");
		$count = mysqli_num_rows($sql_cart);
		if($count>0){
			$row_sp=mysqli_fetch_array($sql_cart);
			$soluong = $row_sp['soluong']+1;
			$sql_giohang = "UPDATE giohang set soluong='$soluong' where sanpham_id='$sanpham_id'";
			
		}else{
			$soluong = $soluong;
			$sql_giohang =  "insert into giohang(tensanpham,sanpham_id,giasanpham,hinhanh,soluong) values('$tensanpham','$sanpham_id','$gia','$hinhanh','$soluong')";
		}
		$insert_row=mysqli_query($conn,$sql_giohang);
		if($insert_row==0){
			header('Location: index.php?quanli=chitiet&id='.$sanpham_id);
		}
	}elseif(isset($_POST['capnhatsoluong'])){
		for($i=0;$i<count($_POST['product_id']);$i++){
			$sanpham_id =$_POST['product_id'][$i];
			$soluong = $_POST['soluong'][$i];
			if($soluong<=0){
				$sql_delete = mysqli_query($conn, "DELETE from giohang where sanpham_id='$sanpham_id'");
			}else{
				$sql_update = mysqli_query($conn,"UPDATE giohang set soluong = '$soluong' where sanpham_id='$sanpham_id'");

			}
		}
	}elseif(isset($_GET['xoa'])){
		$id = $_GET['xoa'];
		$sql_delete = mysqli_query($conn,"DELETE from giohang where giohang_id	='$id'");
	}
	elseif(isset($_GET['dangxuat'])){
		$id = $_GET['dangxuat'];
		if($id==1){
			unset($_SESSION['dangnhap']);
		}	
	}
	elseif(isset($_POST['thanhtoan'])){
		$name= $_POST['name'];
		$phone= $_POST['phone'];
		$address= $_POST['address'];
		$email= $_POST['email'];
		$password = md5($_POST['password']);
		$note= $_POST['note'];
		$giaohang= $_POST['giaohang'];

		$sql_khachhang =  mysqli_query($conn,"insert into khachhang(name,phone,address,note,email,password,giaohang) values('$name','$phone','$address','$note','$email','$password','$giaohang')");

		if($sql_khachhang){
			$sql_select_khachhang = mysqli_query($conn,"SELECT * FROM khachhang ORDER BY khachhang_id DESC LIMIT 1");
	 		$mahang = rand(0,9999);
	 		$row_khachhang = mysqli_fetch_array($sql_select_khachhang);
	 		$khachhang_id = $row_khachhang['khachhang_id'];
	 		$_SESSION['dangnhap'] = $row_khachhang['name'];
	 		$_SESSION['khachhang_id'] = $khachhang_id;
	 		for($i=0;$i<count($_POST['thanhtoan_product_id']);$i++){
		 		$sanpham_id = $_POST['thanhtoan_product_id'][$i];
		 		$soluong = $_POST['thanhtoan_soluong'][$i];
		 		$sql_donhang = mysqli_query($conn,"INSERT INTO donhang(sanpham_id,soluong,mahang,khachhang_id) values ('$sanpham_id','$soluong','$mahang','$khachhang_id')");
		 		$sql_giaodich = mysqli_query($conn,"INSERT INTO giaodich(sanpham_id,soluong,magiaodich,khachhang_id) values ('$sanpham_id','$soluong','$mahang','$khachhang_id')");
		 		$sql_delete_thanhtoan = mysqli_query($conn,"DELETE FROM giohang WHERE sanpham_id='$sanpham_id'");
			}
		}
	}elseif(isset($_POST['thanhtoangiohang'])){

		$khachhang_id = $_SESSION['khachhang_id'];

 		$mahang = rand(0,9999);
 		for($i=0;$i<count($_POST['thanhtoan_product_id']);$i++){
	 		$sanpham_id = $_POST['thanhtoan_product_id'][$i];
	 		$soluong = $_POST['thanhtoan_soluong'][$i];
	 		$sql_donhang = mysqli_query($conn,"INSERT INTO donhang(sanpham_id,soluong,mahang,khachhang_id) values ('$sanpham_id','$soluong','$mahang','$khachhang_id')");
	 		$sql_giaodich = mysqli_query($conn,"INSERT INTO giaodich(sanpham_id,soluong,magiaodich,khachhang_id) values ('$sanpham_id','$soluong','$mahang','$khachhang_id')");
	 		$sql_delete_thanhtoan = mysqli_query($conn,"DELETE FROM giohang WHERE sanpham_id='$sanpham_id'");
		}
		
	}
?>
<!-- checkout page -->
	<div class="privacy py-sm-5 py-4">
		<div class="container py-xl-4 py-lg-2">
			<!-- tittle heading -->
			<h3 class="tittle-w3l text-center mb-lg-5 mb-sm-4 mb-3">
				Giỏ hàng của bạn
			</h3>
			<h4>
				<?php
					if(isset($_SESSION['dangnhap'])){
						echo '<p class="tenkhachhang" >Xin chào: '.$_SESSION['dangnhap'].'<a href="index.php?quanli=giohang&dangxuat=1">Đăng xuất</a></p>';
					}else{
						echo '';
					}
				?>
			</h4>
			<!-- //tittle heading -->
			<div class="checkout-right">
				<?php
					$sql_lay_giohang = mysqli_query($conn, "select * from giohang ORDER BY giohang_id DESC");
				?>
				
				<div class="table-responsive">
					<form action="" method="POST">
						<table class="timetable_sub">
							<thead>
								<tr>
									<th>SL No.</th>
									<th>Product</th>
									<th>Quality</th>
									<th>Product Name</th>

									<th>Price</th>
									<th>Total</th>
									<th>Remove</th>
								</tr>
							</thead>
							<tbody>
								<?php
									$i=0;
									$total = 0;
									while($row=mysqli_fetch_array($sql_lay_giohang)) {
										$subTotal = $row['soluong'] * $row['giasanpham'];
										$total += $subTotal; 
										$i++;
									     
								?>
								<tr class="rem1">
									<td class="invert"><?php echo $i?></td>
									<td class="invert-image">
										<a href="single.html">
											<img src="images/<?php echo $row['hinhanh'] ?>" alt=" " class="img-responsive">
										</a>
									</td>
									<td class="invert">
										<input type="number" min="0" name="soluong[]" value="<?php echo $row['soluong'] ?>">
										<input type="hidden" name="product_id[]" value="<?php echo $row['sanpham_id'] ?>">
									</td>
									<td class="invert"><?php echo $row['tensanpham'] ?></td>
									<td class="invert"><?php echo number_format($row['giasanpham']). 'vnđ '?></td>
									<td class="invert"><?php echo number_format($subTotal). 'vnđ '?></td>
									<td class="invert">
										<div class="rem">
											<a href="?quanli=giohang&xoa=<?php echo $row['giohang_id'] ?>">Xóa</a>
										</div>
									</td>
								</tr>
								<?php
									} 
								?>
								<tr >
									<td colspan="7">
										<?php echo number_format($total). 'vnđ ' ?>
									</td>
								</tr>
								<tr >
									<td colspan="7">
										<button type="submit" name="capnhatsoluong" class="btn btn-success">
											Cật nhật giỏ hàng
										</button>
										<?php
										$sql_giohang_select = mysqli_query($conn,"select * from giohang ");
										$count_giohang_select = mysqli_num_rows($sql_giohang_select);
										if(isset($_SESSION['dangnhap'])&& $count_giohang_select>0) {
											while($row_tt=mysqli_fetch_array($sql_giohang_select)){
									?>
									<input type="hidden" name="thanhtoan_product_id[]" value="<?php echo $row_tt['sanpham_id'] ?>">
									<input type="hidden" name="thanhtoan_soluong[]" value="<?php echo $row_tt['soluong'] ?>">
									<?php 
									}
									?>
									<button type="submit" name="thanhtoangiohang" class="btn btn-primary">
											Thanh toán giỏ hàng
										</button>
									<?php	
										} 
									?>
									</td>				
								</tr>
							</tbody>
						</table>
					</form>
				</div>
			</div>
			<?php
				if(!isset($_SESSION['dangnhap'])){

			?>
			<div class="checkout-left">
				<div class="address_form_agile mt-sm-5 mt-4">
					<h4 class="mb-sm-4 mb-3">Thêm địa chỉ giao hàng</h4>
					<form action="" method="post" class="creditly-card-form agileinfo_form">
						<div class="creditly-wrapper wthree, w3_agileits_wrapper">
							<div class="information-wrapper">
								<div class="first-row">
									<div class="controls form-group">
										<input class="billing-address-name form-control" type="text" name="name" placeholder="Full Name" required="">
									</div>
									<div class="w3_agileits_card_number_grids">
										<div class="w3_agileits_card_number_grid_left form-group">
											<div class="controls">
												<input type="text" class="form-control" placeholder="Mobile Number" name="phone" required="">
											</div>
										</div>
										<div class="w3_agileits_card_number_grid_right form-group">
											<div class="controls">
												<input type="text" class="form-control" placeholder="Address" name="address" required="">
											</div>
										</div>
									</div>
									<div class="controls form-group">
										<input type="email" class="form-control" placeholder="Email" name="email" required="">
									</div>
									<div class="controls form-group">
										<input type="password" class="form-control" placeholder="Password" name="password" required="">
									</div>
									<div class="controls form-group">
										<textarea style="resize: none;" placeholder="Ghi chú"
										name="note" class="form-control">
											
										</textarea>
									</div>
									<div class="controls form-group">
										<select class="option-w3ls" name="giaohang">
											<option>Chọn phương thức thanh toán</option>
											<option value="1">Thanh toán ATM</option>
											<option value="0">Tại nhà</option>
										</select>
									</div>
								</div>
								<?php
								$sql_lay_giohang = mysqli_query($conn,"SELECT * FROM giohang ORDER BY giohang_id DESC");
								while($row_thanhtoan = mysqli_fetch_array($sql_lay_giohang)){ 
								?>
									<input type="hidden" name="thanhtoan_product_id[]" value="<?php echo $row_thanhtoan['sanpham_id'] ?>">
									<input type="hidden" name="thanhtoan_soluong[]" value="<?php echo $row_thanhtoan['soluong'] ?>">
								<?php
								} 
								?>
								<input type="submit" name="thanhtoan" class="btn btn-success" value="Thanh toán">

							</div>
						</div>
					</form>
				</div>
			</div>
			<?php
				}
			?>
		</div>
	</div>
	<!-- //checkout page -->