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
										<img class="product-image" id="image"src="' . $imageURL . '" alt="" />;
											
										</td>'?>
										<td scope="col"><button class="btn btn-warning" data-toggle="modal" data-target="#myModal"
										onclick="getUpdateProduct(this);" 
										id ="<?php echo $row['product_id'];?>" >Edit</button></td>
										<td scope="col"><a class="btn btn-danger" href="../Controller/productController.php?Did=<?php echo $row['product_id'] ;?>">Delete</a></td>											
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
										<form action="../Controller/productUpdate.php" method="POST" id="updateProduct">
										<div class="form-group row">
												<label for="" class="offset-1 col-3 control-label">id</label>
												<div class="col-6">
													<input class="form-control" type="text" id="productId"name="productId" readonly/>
												</div>
										</div>
											<div class="form-group row">
												<label for="" class="offset-1 col-3 control-label">Product Name</label>
											
												<div class="col-6">
													<input class="form-control" type="text" id="productName"name="productName"/>
												</div>
											</div>
											<div class="form-group row">
												<label class="col-3 offset-1 control-label">Price</label>
												<div class="col-4">
													<input class="form-control " id="price" name="price" type="number" min="5.00" max="500.00" />
												</div>
											</div>
											<div class="form-group row">
												<label class="col-3 offset-1 control-label">Category</label>
												<div class="col-4">
													<select class="form-control " id ="category"name="category">
													<option id ="selected" selected disabled hidden></option>
														<option>Cold Drinks</option>
														<option>Hot Drinks</option>
														<option>Fresh Juice</option>
													</select>
												</div>
											</div>
											<div class="form-group row">
												
												<label class="control-label col-3 offset-1">Product Picture</label> 
												<img id = "pictureShow"></img>
												<input type="file" name="file"id="file" class="form-control-file col-6" />
											</div> 
											<div class="offset-4">
												<button type="submit" name="submit" value="Save Changes" class="btn btn-success">ADD</button>
												<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
											</div>
										</form>
										
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
		<script src="../Public/js/ajaxScript.js"></script>

</body>

</html>