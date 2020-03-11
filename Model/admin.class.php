<?php

class Admin
{
    public function __construct()
    {
        echo '<h1>hello</h1>';
    }

    public function connect()
    {
        $conn = new mysqli("localhost", "root", "", "cafeteria");
        // Check connection
        if ($conn->connect_errno) {
            echo "Failed to connect to MySQL: " . $conn->connect_error;
            exit();
        };
        return $conn;
    }

    public function selectAll()
    {
        $conn = $this->connect();

        $selectQuery = 'select * from clients';
        $res = mysqli_query($conn, $selectQuery);

        while ($row = mysqli_fetch_assoc($res)) {
            var_dump($row);
            echo '</br>';
            echo '</br>';
        }
    }

    public function selectChecks()
    {
        $conn = $this->connect();

        $selectQuery =
            'select * from orders join clients on orders.user_id = clients.user_id join order_product on order_product.order_id = orders.order_id join products on products.product_id = order_product.product_id';
        $res = mysqli_query($conn, $selectQuery);
    }
}

/* 
$conn = new mysqli("localhost", "root", "", "cafeteria");
// Check connection
if ($conn->connect_errno) {
    echo "Failed to connect to MySQL: " . $conn->connect_error;
    exit();
};

$selectQuery = 'select * from clients';
$res = mysqli_query($conn, $selectQuery);

while($row = mysqli_fetch_assoc($res)){
    var_dump($row);
    echo '</br>';
    echo '</br>';
}
*/
