<?php

class Admin{
    public function __construct()
    {
        echo '<h1>hello</h1>';
    }

    public function connect(){
        $conn = new mysqli("localhost", "root", "", "cafeteria");
        // Check connection
        if ($conn->connect_errno) {
            echo "Failed to connect to MySQL: " . $conn->connect_error;
            exit();
        };
        return $conn;
    }

    public function connection(){
        $conn = $this->connect();

        $selectQuery = 'select * from clients';
        $res = mysqli_query($conn, $selectQuery);

        while($row = mysqli_fetch_assoc($res)){
            var_dump($row);
            echo '</br>';
            echo '</br>';
        }
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