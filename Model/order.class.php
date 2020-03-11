<?php
    class order{
        
        private $order_state;
        

        public function displayOrders($user_id){
            global $db;
            $result=mysqli_query($db,"SELECT clients.user_name,orders.date ,orders.state,
            products.price,order_product.product_amount
            , orders.total_price ,orders.order_notes ,products.product_name,orders.order_id
            from orders inner join clients on clients.user_id=orders.user_id
            INNER JOIN order_product on order_product.order_id=orders.order_id 
            INNER JOIN products on order_product.product_id=products.product_id 
            where orders.user_id={$user_id}");
            return $result;
            }
        }
?>
