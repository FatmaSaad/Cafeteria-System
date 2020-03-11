<!DOCTYPE html>
<html lang="en">

<head>
	<title>Table V01</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--===============================================================================================-->
	<link rel="icon" type="image/png" href="../Public/images/icons/favicon.ico" />
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../Public/vendor/bootstrap/css/bootstrap.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../Public/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../Public/vendor/animate/animate.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../Public/vendor/select2/select2.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../Public/vendor/perfect-scrollbar/perfect-scrollbar.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../Public/css/util.css">
	<link rel="stylesheet" type="text/css" href="../Public/css/main.css">
	<!--===============================================================================================-->
	
	<style>
		.product-image{
			width: 100px;
			height: 100px;
		}
	</style>

</head>

<body>


	<?php

	include 'adminHeader.php';

	require_once '..' . DIRECTORY_SEPARATOR . 'config.php';
	if ($db) {
		$Result = mysqli_query($db, "select * from products");
	?>
		<div class="limiter">
			<div class="container-table100">
				<div class="wrap-table100">
					<div class="table100">
						<table>
							<thead>
								<tr class="table100-head">
									<th class="column1">Product</th>
									<th class="column2">Price</th>
									<th class="column3">Image</th>
									<th class="column4">Action</th>
								</tr>
							</thead>

							<tbody>
								<?php
								while ($row = mysqli_fetch_assoc($Result)) {
									var_dump($row);
									$imageURL = '../uploads/' . $row['image'];
									var_dump("url");
									var_dump($imageURL);
								?>
									<tr>
										<td class="column1"><?php echo $row['product_name']; ?></td>
										<td class="column2"><?php echo $row['price']; ?></td>
										<td class="column3">
											<?php
											echo '
										<img class="product-image" src="' . $imageURL . '" alt="" />';
											?>
										</td>
										<td class="column4">
											<a href="#">Edit</a>
											<a href="#">Delete</a>

										</td>
									</tr>

							<?php
								}
							} ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>




		<!--===============================================================================================-->
		<script src="../Public/vendor/jquery/jquery-3.2.1.min.js"></script>
		<!--===============================================================================================-->
		<script src="../Public/vendor/bootstrap/js/popper.js"></script>
		<script src="../Public/vendor/bootstrap/js/bootstrap.min.js"></script>
		<!--===============================================================================================-->
		<script src="../Public/vendor/select2/select2.min.js"></script>
		<!--===============================================================================================-->
		<script src="../Public/js/main.js"></script>

</body>

</html>