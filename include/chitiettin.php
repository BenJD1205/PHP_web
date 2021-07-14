<?php
	if(isset($_GET['id'])){
		$id_baiviet = $_GET['id'];
	}else{
		$id_baiviet = '';
	}
?>
<!-- page -->
	<div class="services-breadcrumb">
		<div class="agile_inner_breadcrumb">
			<div class="container">
				<ul class="w3_short">
					<li>
						<a href="index.php">Home</a>
						<i>|</i>
					</li>
					<?php
						$sql_tenbaiviet = mysqli_query($conn,"select * from baiviet where baiviet_id='$id_baiviet'");
						$row_bai=mysqli_fetch_array($sql_tenbaiviet);
					?>
					<li><?php echo $row_bai['tenbaiviet']; ?></li>
				</ul>
			</div>
		</div>
	</div>
	<!-- //page -->

	<!-- about -->
	<div class="welcome py-sm-5 py-4">
		<div class="container py-xl-4 py-lg-2">
			<!-- tittle heading -->
			<?php
				$sql_tenbaiviet1 = mysqli_query($conn,"select * from baiviet where baiviet_id='$id_baiviet'");
				$row_bai1=mysqli_fetch_array($sql_tenbaiviet1); 
			?>
			<h3 class="tittle-w3l text-center mb-lg-5 mb-sm-4 mb-3">
				<?php echo $row_bai1['tenbaiviet'] ?>
			<!-- //tittle heading -->
			<?php
				$sql_baiviet = mysqli_query($conn,"select * from baiviet where baiviet.baiviet_id='$id_baiviet'"); 
				$row_baiviet = mysqli_fetch_array($sql_baiviet);

			?>
			<div class="row">
				<div class="col-lg-12 welcome-left">
					<h5><a href="i.php?quanli=chitiettin&id=<?php echo $row_baiviet['baiviet_id'] ?>"><?php echo $row_baiviet['tenbaiviet'] ?></a></h5>
					<h4 class="my-sm-3 my-2"><?php echo $row_baiviet[
						'tomtat'] ?></h4>
					<p><?php echo $row_baiviet['noidung'] ?></p>
				</div>
			</div>
		</div>
	</div>
	<!-- //about -->

	<!-- testimonials -->
	<div class="testimonials py-sm-5 py-4">
		<div class="container py-xl-4 py-lg-2">
			<!-- tittle heading -->
			<h3 class="tittle-w3l text-center text-white mb-lg-5 mb-sm-4 mb-3">
				<span>O</span>ur
				<span>C</span>ustomers
				<span>S</span>ays</h3>
			<!-- tittle heading -->
			<div class="row gallery-index">
				<div class="col-sm-6 med-testi-grid">
					<div class="med-testi test-tooltip rounded p-4">
						<p>"sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation
								ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
					</div>
					<div class="row med-testi-left my-5">
						<div class="col-lg-2 col-3 w3ls-med-testi-img">
							<img src="images/user.jpg" alt=" " class="img-fluid rounded-circle" />
						</div>
						<div class="col-lg-10 col-9 med-testi-txt">
							<h4 class="font-weight-bold mb-lg-1 mb-2">Tyson</h4>
							<p>fames ac turpis</p>
						</div>
					</div>
				</div>
				<div class="col-sm-6 med-testi-grid">
					<div class="med-testi test-tooltip rounded p-4">
						<p>"sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation
							ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
					</div>
					<div class="row med-testi-left my-5">
						<div class="col-lg-2 col-3 w3ls-med-testi-img">
							<img src="images/user.jpg" alt=" " class="img-fluid rounded-circle" />
						</div>
						<div class="col-lg-10 col-9 med-testi-txt">
							<h4 class="font-weight-bold mb-lg-1 mb-2">Alejandra</h4>
							<p>fames ac turpis</p>
						</div>
					</div>
				</div>
				<div class="col-sm-6 med-testi-grid">
					<div class="med-testi test-tooltip rounded p-4">
						<p>"sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation
							ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
					</div>
					<div class="row med-testi-left mt-sm-5 my-5">
						<div class="col-lg-2 col-3 w3ls-med-testi-img">
							<img src="images/user.jpg" alt=" " class="img-fluid rounded-circle" />
						</div>
						<div class="col-lg-10 col-9 med-testi-txt">
							<h4 class="font-weight-bold mb-lg-1 mb-2">Charles</h4>
							<p>fames ac turpis</p>
						</div>
					</div>
				</div>
				<div class="col-sm-6 med-testi-grid">
					<div class="med-testi test-tooltip rounded p-4">
						<p>"sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation
							ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
					</div>
					<div class="row med-testi-left mt-5">
						<div class="col-lg-2 col-3 w3ls-med-testi-img">
							<img src="images/user.jpg" alt=" " class="img-fluid rounded-circle" />
						</div>
						<div class="col-lg-10 col-9 med-testi-txt">
							<h4 class="font-weight-bold mb-lg-1 mb-2">Jessie</h4>
							<p>fames ac turpis</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- //testimonials -->