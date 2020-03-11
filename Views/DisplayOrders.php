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
	require './adminHeader.php';
	require_once("../config.php"); 
	$orders=new order();
	$arr;
	$result2=$orders->displayOrders(1); 
	
echo "<body>
	<form method='get' action='#'>
	
		<input type='date' name='datefrom'/>
		<input type='date' name='dateto'/>
		<input type='submit' value='ok' name='ok'/>		
		</form>
	<div class='box'>
		<div class='container'>
			<div class='row'>";
			
			
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
					}	
				}
				else{
					$filteredorders=$orders;
					
				}
				echo "<div id='accordion' >";
				foreach ($filteredorders as $key=>$order){
					
							
							echo "<div class='card' class='col-sm-4'>
							  <div class='card-header' id='heading{$key}'>
								<h5 class='mb-0'>
								  <button class='btn btn-link' data-toggle='collapse' data-target='#collapse{$key}' aria-expanded='true' aria-controls='collapse{$key}'>
								  {$order[0]['date']}
								  </button>
								</h5>
							  </div>
							  <div id='collapse{$key}' class='collapse' aria-labelledby='heading{$key}' data-parent='#accordion'>";
							  foreach($order as $product){
								echo "<div class='card-body'>
								<p>{$product['product_name']}</p><br/>
								<p>{$product['product_amount']}</p>"
								;
								
								echo "</div>";	
							}
							echo "
							</div>
						  </div>";
						  
							  			
				}
				echo "</div>";
				?>
				
			
			
					
			</div>		
		</div>
	</div>
	
</body>
</html>
