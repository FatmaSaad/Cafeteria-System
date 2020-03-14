<?php
    class order{
        
        private $order_state;
        

        public function displayOrders($user_id){
            global $db;
            $result=mysqli_query($db,"SELECT orders.date ,orders.state,
            products.price,order_product.product_amount
            , orders.total_price ,orders.order_notes ,products.product_name,orders.order_id
            from orders INNER JOIN order_product on order_product.order_id=orders.order_id 
            INNER JOIN products on order_product.product_id=products.product_id 
            where orders.user_id={$user_id}");
            return $result;
            }
            

        public function displayOrdersAdmin($date){
            global $db;
            $result=mysqli_query($db,"SELECT orders.date ,orders.state,
            products.price,order_product.product_amount
            , orders.total_price ,orders.order_notes ,products.product_name,orders.order_id,clients.user_name
            from orders INNER JOIN order_product on order_product.order_id=orders.order_id 
            INNER JOIN products on order_product.product_id=products.product_id 
            INNER JOIN clients on orders.user_id =clients.user_id
            where  DATE(orders.date)='2020-03-10'
            ");
            return $result;
            }
        
        public function changeStatus ($status,$order_id){
            global $db;
            $result=mysqli_query($db,"UPDATE `orders` SET `state`={$status}  WHERE order_id={$order_id}");
            echo $status;
        }
        }
?>
