<html>
    <head>
	<link href="../Public/css/bootstrap.min.css" rel="stylesheet" />
    <link href="../Public/css/font-awesome.css" rel="stylesheet" />
	<script src="../Public/vendor/jquery/jquery-3.2.1.min.js"></script>
	<script src="../Public/vendor/bootstrap/js/popper.min.js"></script>
    <script src="../Public/vendor/bootstrap/js/bootstrap.min.js"></script>
        <style>
            *{
                padding:0;
                margin: 0;
            }
           
            #container{
                width: 90%;
                height: 100%;
                box-shadow: lightgrey 10px 10px 120px inset; 
                margin: 15px auto;
                border-radius: 10%;
                display:-webkit-box;
                padding:20px;
                
            }
            #processing, #outFordelevery{
                width: 25%;
                height: 90%;
                margin: 20px ;
                -webkit-box-flex:1;
                /* display:-webkit-box; */
                text-align: center;
               
            }
            img:hover{
                transform: scale(2) rotate(360deg);

            }
            .header{
                width:90%;
                height:50px;
                border-radius: 20%;
                text-align:center;
                padding :10px ;
                font: 20px tahoma;
            }
            .order{
                width:90%;
                height:40px;
                border-radius: 20%;
                text-align:center;
                padding :10px ;
                font: 20px tahoma;
                margin:10px auto;
            }
        </style>
        
    </head>
    <body>
    <script>
        var state;
    </script>
    <?php
	require './adminHeader.php';
	require_once("../config.php"); 
	$order1=new order();
	$arr=array();
    $result=$order1->displayOrdersAdmin(date('Y-m-d')); 
    if($result){
        while($row=mysqli_fetch_assoc($result)){
        $arr[]=$row;}
        $orders = array();
        foreach ( $arr as $element )
        {
            $orders[$element['order_id']][] = $element;
            
        }
       			
        foreach ($orders as $key=>$order)
        {
            $status=$order[0]['state'];
               
        ?>
        <script>
        
                function updateStatus(id,status){ $.ajax({
                url:"../Controller/updateOrder.php",
                data: {
                        orderId: id,
                        state:status
                    },
                method:"get",
                dataType:"Text",
                success:function(result){ 
                    console.log("success");
                
                 }, error:function(error){console.log(error+"");}
                });}
            
        
				
            state="<?php echo $status ?>";
                function startdrag(e) {
                    e.dataTransfer.setData('myorder', e.target.id);
                }
                function enddrag(e)
                {
                    
                    
                }
                function dropped(e) {
                    e.preventDefault();
                    console.log(e.target);
                    
                    var data = e.dataTransfer.getData("myorder");
                    e.target.appendChild(document.getElementById(data));
                    e.target.appendChild(document.getElementsByName(data)[0]);
                    
                    if (e.target.id=="outFordelevery"){
                        updateStatus(<?php echo $order[0]['order_id']?>,"1");
                        state="1";
                        var children=e.target.children;
                        for(var i=0;i<children.length;i++){
                            if(children[i].classList[0]=="order"){
                                children[i].className="order bg-success"
                                console.log("alaaa");
                                 
                            }
                        }
                        
                       
                    }
                    else if(e.target.id=="processing"){
                        updateStatus(<?php echo $order[0]['order_id']?>,"0");
                        state="0";
                        var children=e.target.children;
                        for(var i=0;i<children.length;i++){
                            if(children[i].classList[0]=="order"){
                                children[i].className="order bg-danger" 
                            }
                        }
                    }   
                }
                
                function enterdrag(e) {
                    e.preventDefault();
                    outFordelevery.style.backgroundColor = 'maroon';
                }
                function overdrag(e) {
                    
                    e.preventDefault();
                }
        </script>
        <div id="container">
            <div ondrop="dropped(event)" ondragover="overdrag(event)" id="processing" class="accordion">
            <div class="table-dark header">Processing</div>
            </div>
            <div ondrop="dropped(event)" ondragover="overdrag(event)" id="outFordelevery" class="accordion">
            <div class="table-dark header">Out For Delevery</div>
            </div>
        <script>          
                var orderStructure=$(`<div id='<?php echo $key?>' draggable='true' scope='row' class='order' >
									<?php
									echo
									"<button type='button' data-toggle='collapse' data-target='#collapse{$key}' aria-expanded='true' aria-controls='#collapse{$key}' class='btn border border-dark rounded-circle'>
                                        +
                                    </button>";
									 echo $order[0]['user_name'];?>
                            </div >` )
									 
               
				var orderdetails=$(" <div name='<?php echo $key?>' id='collapse<?php echo $key?>' class=' collapse' aria-labelledby='heading<?php echo $key?>' data-parent='#accordion'>");
							  
					<?php 
						foreach($order as $product){?>
							orderdetails.html(` <div style='display:inline-block;'>
									   
									   <img src='../public/Images/<?php echo $product['image'];?>' width='150px' height='150px' />
   
									   <span class='badge badge-pill badge-warning'><?php echo $product["price"]?> EGP</span>
									   <figcaption><?php echo $product['product_name'];?><br/> quantity:<?php echo $product['product_amount'];?></figcaption>
								   </div>
									   
									   
									  `)
									   ;
						
                        <?php } 
                     }}?> 
        </script>
        <script>
            if(state=="0"){ 
                   orderStructure.appendTo("#processing");
                   orderdetails.appendTo("#processing");
                   $(".order").addClass("bg-danger");
            }
            else if(state=="1"){
                   orderStructure.appendTo("#outFordelevery");
                   orderdetails.appendTo("#outFordelevery");
                   $(".order").addClass("bg-success");
            }
        
            processingOrder = $('.order');
            
            for(var i = 0 ; i < processingOrder.length;i++)
                {
                    console.log(processingOrder[i]);
                    processingOrder[i].addEventListener('dragstart', startdrag);
                    processingOrder[i].addEventListener('dragend', enddrag);
                }

        </script>           
		</div>
  </body> 
</html> 