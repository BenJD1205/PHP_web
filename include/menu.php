<?php
		$sql_category = 'select * from category ORDER BY category_id DESC '; 
		$result = mysqli_query($conn,$sql_category);
	?>
	<div class="navbar-inner">
		<div class="container">
			<nav class="navbar navbar-expand-lg navbar-light bg-light">
				<div class="agileits-navi_search">
					<form action="#" method="post">
						<select id="agileinfo-nav_search" name="agileinfo_search" class="border" required="">
							<option value="">Danh mục sản phẩm</option>
							<?php
							while($row_category=mysqli_fetch_array($result)){
							?>
							<option value="<?php echo $row_category['category_id'] ?>"><?php echo $row_category['category_name'] ?></option>
							<?php
							} 
							?>
						</select>
					</form>
				</div>
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
				    aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
				<div class="collapse navbar-collapse" id="navbarSupportedContent">
					<ul class="navbar-nav ml-auto text-center mr-xl-5">
						<li class="nav-item active mr-lg-2 mb-lg-0 mb-2">
							<a class="nav-link" href="index.php">Trang chủ
								<span class="sr-only">(current)</span>
							</a>
						</li>
						<?php
							$sql_category = 'select * from category ORDER BY category_id DESC '; 
							$result = mysqli_query($conn,$sql_category);
							while($row_category=mysqli_fetch_array($result)){

						?>
						<li class="nav-item mr-lg-2 mb-lg-0 mb-2">
							<a class="nav-link" href="?quanli=danhmuc&id=<?php echo $row_category['category_id'] ?>">
								<?php echo $row_category['category_name'] ?>
							</a>
						</li>
						<?php
						} 
						?>
						<li class="nav-item mr-lg-2 mb-lg-0 mb-2">
							<a class="nav-link" href="about.html">Liên hệ</a>
						</li>
						<li class="nav-item dropdown mr-lg-2 mb-lg-0 mb-2">
							<?php
								$sql_danhmuc = mysqli_query($conn,"select * from danhmuctin ORDER BY 
									danhmuc_id DESC"); 
							?>
							<a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								Tin tức
							</a>
							<div class="dropdown-menu">
								<?php
									while($row_danhmuc = mysqli_fetch_array($sql_danhmuc)) {


								?>
								<a class="dropdown-item" href="?quanli=tintuc&id=<?php echo $row_danhmuc['danhmuc_id'] ?>"><?php echo $row_danhmuc[
									'tendanhmuc'] ?></a>
								<?php
									} 
								?>
							</div>
						</li>
						<li class="nav-item dropdown mr-lg-2 mb-lg-0 mb-2">
							<a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								Trang
							</a>
							<div class="dropdown-menu">
								<a class="dropdown-item" href="product.html">Sản phẩm</a>
								<div class="dropdown-divider"></div>
								<div class="dropdown-divider"></div>
								<a class="dropdown-item" href="checkout.html">Xem đơn hàng</a>
								<a class="dropdown-item" href="payment.html">Payment Page</a>
							</div>
						</li>
					</ul>
				</div>
			</nav>
		</div>
	</div>
	<!-- //navigation -->