<?php
require_once '../config.php';
if (isset($_SESSION['id'])) {
    $userId = $_SESSION['id'];
    $userName = $_SESSION['username'];
} else {
    header("Location:login.php");
}
if (isset($_POST['addOrder'])) {
    var_dump($_POST);
    $addOrder = new order();
    $addOrder->setUserId($userId);
    $addOrder->setRoomNumber($_POST['room_number']);
    $addOrder->setOrderNotes($_POST['order_notes']);
    $addOrder->setTotalPrice($_POST['to_Price']);
    $products = $_POST['ordersProducts'];
    $productsarr = explode(",", $products);
    $vals = array_count_values($productsarr);
    $OrderAmount = (array_values($vals));
    var_dump($OrderAmount);

    $prods = (array_keys($vals));
    // var_dump($prods);
    $OrderId = $addOrder->add_Order();
    for ($i = 0; $i < count($prods); $i++) {
        echo ("<br>");
        $addOrder->Order_Product($OrderId, $prods[$i], $OrderAmount[$i]);
        echo ("<br>");
    }
    header("Location:../Views/DisplayOrders.php");

} else 
    if (isset($_POST['addOrdermanually'])) {
    var_dump($_POST);
    $addOrder = new order();
    $addOrder->setUserId($_POST['user_id']);
    $addOrder->setRoomNumber($_POST['room_number']);
    $addOrder->setOrderNotes($_POST['order_notes']);
    $addOrder->setTotalPrice($_POST['to_Price']);
    $products = $_POST['ordersProducts'];
    $productsarr = explode(",", $products);
    $vals = array_count_values($productsarr);
    $OrderAmount = (array_values($vals));
    //var_dump($OrderAmount);

    $prods = (array_keys($vals));
    // var_dump($prods);
    echo ("<br>");

    $OrderId = $addOrder->add_Order();
    echo("<br>");

    for ($i = 0; $i < count($prods); $i++) {
        echo ("<br>");
        $addOrder->Order_Product($OrderId, $prods[$i], $OrderAmount[$i]);
        echo ("<br>");
    }
    header("Location:../Views/DisplayOrdersAdmin.php");

}
