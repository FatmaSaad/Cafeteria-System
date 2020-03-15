<!DOCTYPE html>
<html lang="en">

<head>
	<title>product list</title>
	<link href="../Public/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

	<style>
		.product-image {
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
		$Result = mysqli_query($db, "select * from products where deleted_product= 0");
	?>
		<div class="limiter">
			<div class="container-table100">
				<div class="wrap-table100">
					<div class="table100">
						<table class="table">
							<thead>
								<tr class="table100-head">
									<th scope="col">#</th>
									<th scope="col">Product</th>
									<th scope="col">category</th>
									<th scope="col">Price</th>
									<th scope="col">Image</th>
									<th scope="col">Action</th>
								</tr>
							</thead>

							<tbody>
								<?php
								while ($row = mysqli_fetch_assoc($Result)) {
									$pn = $row['product_name'];
									$imageURL = '../uploads/' . $row['image'];

								?>
									<tr>
										<td scope="col"><?php echo $row['product_id']; ?></td>
										<td scope="col"><?php echo $row['product_name']; ?></td>
										<td scope="col"><?php echo $row['category']; ?></td>
										<td scope="col"><?php echo $row['price']; ?></td>
										<td scope="col">
											<?php
											echo '
										<img class="product-image" src="' . $imageURL . '" alt="" />;
											
										</td>
										<td scope="col"><a class="btn btn-warning" data-toggle="modal" data-target="#myModal" href="#">Edit</a></td>
										<td scope="col"><a class="btn btn-danger" href="../Controller/productController.php?Did=' . $row['product_id'] . '">Delete</a></td>
											' ?>
									</tr>
							<?php
								}
							} ?>
							</tbody>
						</table>
						<!-- Modal -->
						<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
							<div class="modal-dialog modal-dialog-centered" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title" id="exampleModalLongTitle">Product Details</h5>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span>
										</button>
									</div>
									<div class="modal-body">
										<table>
											<tr>
												<th>Product Name</th>
												<th><?php echo $row['product_name']; ?></th>
											</tr>
											<tr>
												<th>Product Price</th>
												<th><?php echo $row['price']; ?></th>
											</tr>
											<tr>
												<th>Product Category</th>
												<th><?php echo $row['category']; ?></th>
											</tr>
											<tr>
												<th>Product Image</th>
												<th><?php echo $row['image']; ?></th>
											</tr>
										</table>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
										<button type="button" class="btn btn-success">Save changes</button>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<script src="../Public/js/jquery-3.2.1.js"></script>
		<!-- <script src="../Public/js/popupmodal-min.js"></script> -->
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
		<!-- <script src="https://code.jquery.com/jquery-3.4.1.js"integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="crossorigin="anonymous"></script> -->
		<!-- <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script> -->
</body>

</html>