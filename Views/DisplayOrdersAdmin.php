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
                box-shadow: maroon 10px 10px 120px inset; 
                margin: 15px auto;
                border-radius: 10%;
                display:-webkit-box;
                
            }
            #processing, #outFordelevery, #done{
                width: 25%;
                height: 90%;
                margin: 20px ;
                border-radius: 15px;
                box-shadow:gray 10px 10px 120px inset;
                -webkit-box-flex:1;
                /* display:-webkit-box; */
                text-align: center;
               
            }
            .image{
                width: 80%;
                height: 10%;
                margin: 5px ;
                padding: 5px;
                -webkit-box-flex:1;
                display:inline-block;
                text-align: center;
                transition: all 3s;
                
            }
            img:hover{
                transform: scale(2) rotate(360deg);

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
        echo date('Y-m-d');
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
                url:"../Controller/updateOrder.php/",
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
                    e.preventDefault();
                }
                function dropped(e) {
                    e.preventDefault();
                    var data = e.dataTransfer.getData("myorder");
                    e.target.appendChild(document.getElementById(data));
                    e.target.appendChild(document.getElementsByName(data)[0]);
                    
                    if (state==0){
                        updateStatus(<?php echo $order[0]['order_id']?>,"1");
                        
                    }
                    else if(state==1){
                        updateStatus(<?php echo $order[0]['order_id']?>,"0");
                        
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
            </div>
            <div ondrop="dropped(event)" ondragover="overdrag(event)" id="outFordelevery" class="accordion">
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
							orderdetails.html(`<div class='card-body'>
									<p><?php echo $product['product_name']?></p><br/>
									<p><?php echo $product['product_amount']?></p></div>`)
									   ;
						
                        <?php } 
                     }}?> 
        </script>
        <script>
            if(state=="0"){ 
                   orderStructure.appendTo("#processing");
                   orderdetails.appendTo("#processing");
                   $(".order").addClass("processingorder");
            }
            else if(state=="1"){
                   orderStructure.appendTo("#outFordelevery");
                   orderdetails.appendTo("#processing");
            }
        
            processingOrder = $('.processingorder');
            
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