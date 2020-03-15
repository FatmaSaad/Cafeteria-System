<?php 
    require_once '../config.php';
    if(isset($_POST['addOrder']))
    {
    var_dump($_POST);
    $addOrder=new order();
    $addOrder->setUserId($_POST['userId']);
    $addOrder->setRoomNumber($_POST['room_number']);
    $addOrder->setOrderNotes($_POST['order_notes']);
    $addOrder->setOrderDate($_POST['order_date']);
    $addOrder->setTotalPrice($_POST['total_Price']);
    $addOrder->setOrderAmount($_POST['product_amount']);
    $products =$_POST['ordersProducts'];
    $productsarr=explode(",",$products);
    var_dump($productsarr);
    $OrderAmount =$_POST['product_amount'];
    echo("____________________");
    var_dump($addOrder);
    $OrderId = $addOrder->add_Order();

    echo($OrderId);
    echo("____________________");
//for(i=0;i<){}
    $addOrder->Order_Product($OrderId,$products,$OrderAmount);
    }
    // $result = $products->listAllProduct();
    // while ($row = mysqli_fetch_assoc($result)) {
    //     $productName = $row['prod_name'];
    //     if($productName == $_POST[$productName]
    //     {

    //     })
    // }
?>