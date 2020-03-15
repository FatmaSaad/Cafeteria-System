<?php

// require '../config.php';

class Admin
{
    private $conn;

    public function __construct()
    {
        global $db;
        $this->conn = $db;
    }

    public function selectAll()
    {


        $selectQuery = 'select * from clients';
        $res = mysqli_query($this->conn, $selectQuery);
    }


    public function getOrders()
    {
        $selectQuery =
            "SELECT sum(total_price) as total_price,user_name,clients.user_id FROM orders JOIN clients on orders.user_id = clients.user_id GROUP BY user_id";
        $res = mysqli_query($this->conn, $selectQuery);
        return $res;
    }

    public function getOrderedProducts($order_id)
    {
        $selectQuery = 
            'SELECT products.product_name , products.image , products.price , order_product.product_amount from order_product join products on products.product_id = order_product.product_id where order_product.order_id ='.$order_id.'';
        $res = mysqli_query($this->conn, $selectQuery);
        return $res;
    }

    public function getOrderData($userId)
    {
        $selectQuery =
            'SELECT * FROM orders where user_id = ' . $userId . '';
        $res = mysqli_query($this->conn, $selectQuery);
        return $res;
    }
}
