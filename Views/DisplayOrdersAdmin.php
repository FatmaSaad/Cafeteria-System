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
            #Processing, #Orderd{
                width: 25%;
                height: 90%;
                margin: 20px ;
                -webkit-box-flex:1;
                text-align: center;
               
            }
            img:hover{
                transform: scale(2) rotate(360deg);

            }
            .header{
                width:90%;
                height:50px;
                border-radius: 20px;
                text-align:center;
                padding :10px ;
                font: 20px tahoma;
            }
            .order{
                width:90%;
                height:40px;
                border-radius: 20px;
                text-align:center;
                padding :10px ;
                font: 20px tahoma;
                margin-top:10px;
            }
        </style>
        
    </head>
    <body>
    
    
    <?php
	require './adminHeader.php';
    require_once("../config.php");
     
	$order1=new order();
    $arr=array();
    ?>
    <script>
        var state;
        orderid = 0;

        function updateStatus(id, status) {
            $.ajax({
                url: "../Controller/updateOrder.php",
                data: {
                    orderId: id,
                    state: status
                },
            method:"get",
            dataType:"Text",
            success:function(result){ 
                console.log("success");
                console.log(id,status);
            
            },
            error:function(error){console.log(error+"");}
            });
            }
            function startdrag(e) {
                orderid=e.target.id;
                e.dataTransfer.setData('myorder', e.target.id);
            }
            function enddrag(e) {  
                e.preventDefault();        
            }
            function dropped(e) {
                e.preventDefault();
                
                var data = e.dataTransfer.getData("myorder");
                e.target.appendChild(document.getElementById(data));
                e.target.appendChild(document.getElementsByName(data)[0]);
                
                if (e.target.id=="Processing"){
                    // send ajax call to update status as processing
                    updateStatus(orderid,"processing");
                    //color updated orders (green)
                    var children=e.target.children;
                    for(var i=0;i<children.length;i++){
                        if(children[i].classList[0]=="order"){
                            children[i].className="order bg-success"
                            
                        }
                    }
                }
                else if(e.target.id=="Orderd"){
                    //send ajax call to update status as orderded
                    updateStatus(orderid,"ordered");
                    // color updated orders (red)
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
            }

            function overdrag(e) {    
                e.preventDefault();
            }
        

        function enterdrag(e) {
            e.preventDefault();

        }

        function overdrag(e) {

            e.preventDefault();
        }
    </script>
    <div id="container">
        <div ondrop="dropped(event)" ondragover="overdrag(event)" id="Orderd" class="accordion">
            <div class="table-dark header">Orderd</div>
        </div>
        <div ondrop="dropped(event)" ondragover="overdrag(event)" id="Processing" class="accordion">
            <div class="table-dark header">Processing</div>
            </div>
    <?php
        
        $datetime = new DateTime('now', new DateTimeZone('Africa/Cairo'));
        $date=$datetime->format('Y-m-d ');
        //display orders that happend today
        $result=$order1->displayOrdersAdmin($date); 
        if($result) {
        
            while($row=mysqli_fetch_assoc($result)) {
                $arr[]=$row;
            }
            $orders = array();

            foreach ( $arr as $element ) {
                $orders[$element['order_id']][] = $element;        
            }
           
    ?> 
     <script>  
        <?php
        foreach ($orders as $key=>$order) {
            $status=$order[0]['state'];
        ?>      
            state="<?php echo $status ?>";  
            var orderStructure=$(
               `<div id='<?php echo $key;?>' draggable='true' on dragend='enddrag(e)' scope='row' class='order' >
                    <button type='button' data-toggle='collapse' data-target='#collapse<?php echo $key?>' aria-expanded='true' aria-controls='#collapse<?php echo $key?>' class='btn border border-dark rounded-circle'>
                        +
                    </button>
                    <?php echo $order[0]['user_name'];?>
                </div >` );
                                        
                var orderdetails=$(" <div name='<?php echo $key?>' id='collapse<?php echo $key?>' class=' collapse' aria-labelledby='heading<?php echo $key?>' data-parent='#accordion'>");
                
                if(state=="ordered") { 
                    orderStructure.appendTo("#Orderd");
                    orderdetails.appendTo("#Orderd");
                    $("#<?php echo $key;?>").addClass("bg-danger");
                }
                else if(state=="processing") {
                    orderStructure.appendTo("#Processing");
                    orderdetails.appendTo("#Processing");
                    $("#<?php echo $key;?>").addClass("bg-success");
                }                
                <?php 
                    foreach($order as $product){?>
                        productt=$(`
                            <div style='display:inline-block;'>         
                                <img src='../public/Images/<?php echo $product['image'];?>' width='150px' height='150px' />
                                <span class='badge badge-pill badge-warning'><?php echo $product["price"]?> EGP</span>
                                <figcaption><?php echo $product['product_name'];?><br/> quantity:<?php echo $product['product_amount'];?></figcaption>
                            </div>`)
                        orderdetails.append(productt);        
                    <?php
                    }?> 
                    allOrders = $('.order');
                    for(var i = 0 ; i < allOrders.length;i++) {
                        allOrders[i].addEventListener('dragstart', startdrag);
                        allOrders[i].addEventListener('dragend', enddrag);
                    }
        <?php 
            }
        }
        ?> 
    </script>           
	</div>
  </body> 
</html> 
