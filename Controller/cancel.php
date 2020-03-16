<?php
    require_once("../config.php"); 
    $order1=new order();
    $result=$order1->cancelOrder($_GET['id']);
    if($result){
        header("Location: /PHP project/Cafeteria-System/Views/DisplayOrders.php");
    }
    else{
        echo "Error";
    }

?>