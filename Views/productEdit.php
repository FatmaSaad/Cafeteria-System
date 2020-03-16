<?php
    require_once '..' . DIRECTORY_SEPARATOR . 'config.php'; 
    $pid =$_GET["id"];
    $result = mysqli_query($db,"select * from products where product_id ='{$pid}'");
    $objresult  = mysqli_fetch_object($result);
    echo json_encode($objresult);


?>