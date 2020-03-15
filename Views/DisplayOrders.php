<html>
<head>
	<link href="../Public/css/bootstrap.min.css" rel="stylesheet" />
    <link href="../Public/css/font-awesome.css" rel="stylesheet" />
	<script src="../Public/vendor/jquery/jquery-3.2.1.min.js"></script>
	<script src="../Public/vendor/bootstrap/js/popper.min.js"></script>
    <script src="../Public/vendor/bootstrap/js/bootstrap.min.js"></script>
</head>
<!------ Include the above in your HEAD tag ---------->
<?php
	require './userHeader.php';
	require_once("../config.php"); 
	$orders=new order();
	$arr=array();
	$result2=$orders->displayOrders($_SESSION['id']); 
	
echo "
<body>
	<div class='box'>
	<div class='container'>
	<form method='get' action='#'>
		<div class='row'>
		
		<div class='input-group my-3 col-sm-3'>
			<div class='input-group-prepend'>
				<span class='input-group-text' id='dateFrom'>From</span>
			</div>
			<input type='date' class='form-control' name='datefrom' />
			</div>
			<div class='input-group my-3 col-sm-3'>
				<div class='input-group-prepend'>
					<span class='input-group-text' id='dateTo'>To</span>
				</div>
			<input type='date' class='form-control' name='dateto'/>
			</div>	
		</div>
			<input type='submit' value='Filter' name='ok' class='btn btn-info mb-4 '/>		
		</form>
	";
			
		if($result2){
				while($row=mysqli_fetch_assoc($result2)){
				$arr[]=$row;}
				$orders = array();
				$datefrom=0;
				$dateto=0;
				foreach ( $arr as $element )
				{
					$orders[$element['order_id']][] = $element;
					
				} 
				// var_dump($orders);
				if(isset($_GET['ok'])&&!empty($_GET['ok'])){
					$datefrom=new DateTime($_GET['datefrom']);
					// var_dump($datefrom);
					$dateto=new DateTime($_GET['dateto']);
					if($datefrom && $dateto){
						$filteredorders=array_filter($orders,function($item) 
						{	 
							$orderdatetime=new DateTime($item[0]["date"]);
							$orderdate= new DateTime($orderdatetime->format('Y-m-d'));
							// var_dump($orderdate);
							if($orderdate>= $GLOBALS['datefrom'] && $orderdate<= $GLOBALS ['dateto']) 
							   return TRUE; 
							else 
							   return FALSE;  
						}
						);
				}}	
				
				else{
					$filteredorders=$orders;
					
				}?>
				<table class='table table-striped'>
					<thead>
							<tr>
								<th scope='col'>Order Date</th>
								<th scope='col'>Status</th>
								<th scope='col'>Amount </th>
								<th scope='col'>Action </th>
							</tr>
					</thead>
					<tbody id='accordion'>
				<?php			
				foreach ($filteredorders as $key=>$order){?>
							<tr>
							<th scope="row">
									<?php
									echo
									"<button type='button' data-toggle='collapse' data-target='#collapse{$key}' aria-expanded='true' aria-controls='collapse{$key}' class='btn border border-dark rounded-circle'>
                                        +
                                    </button>";
									 echo $order[0]['date'];?>
                            </th>
							<td> <?php echo $order[0]['state']; ?> 
							</td>
							<td> <?php echo $order[0]['total_price']; ?> 
							</td>
							<td><?php 
								if ($order[0]['state']==0) {
								echo "<a class='btn btn-danger' href='../Controller/cancel.php/?id={$order[0]['order_id']}'>Cancel</a>";
							}?></td>
                            </tr>
							<?php
							 echo " <tr  id='collapse{$key}' class='collapse' aria-labelledby='heading{$key}' data-parent='#accordion'>";?>
							  <td colspan="4">
									<?php 
									 
									 foreach($order as $product){
									   echo "<div style='display:inline-block;'>
									   
									   <img src='../public/Images/{$product['image']}' width='150px' height='150px' />
   
									   <span class='badge badge-pill badge-warning'>{$product['price']} EGP</span>
									   <figcaption>{$product['product_name'] }<br/> quantity:{$product['product_amount'] }</figcaption>
								   </div>"
									   ;
									   
									   echo "</div>";	
								   }?>
								</td>
							</tr>
						 <?php } ?>
						 
						 </tbody>
						 </table><?php }   
                                    ?>
					
			</div>		
		</div>
	</div>
	
</body>
</html>
