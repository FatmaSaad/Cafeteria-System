<?php
	require_once("../config.php"); 
    $order1=new order();
    $order1->changeStatus($_GET['state'],$_GET['orderId']);?>
