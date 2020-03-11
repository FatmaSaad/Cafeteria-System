<?php
$connect = mysqli_connect("localhost", "root", "", "cafeteria");

if ($connect) {
    $result = mysqli_query($connect, "
                select 
                `user_id`,
                `user_name`,
                `room_number`,
                `image`,
                `ext`,
                `deleted` 
                from `clients`
                ");
} else {
    echo "server can't connect to DB";
}
?>
<html>

<head>
    <!-- Bootstrap core CSS -->
    <link href="../Public/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="../Public/css/blog-home.css" rel="stylesheet">
    <style>
        img {
            width: 50px;
            height: 50px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h3>All Clients List</h3>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Room</th>
                    <th scope="col">Image</th>
                    <th scope="col">Ext</th>
                    <th scope="col">Delete</th>
                    <th scope="col">Edit</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 1;
                while ($row = mysqli_fetch_assoc($result)) {
                    if ($row['deleted'] == 0) {
                        echo "<tr>
                        <th scope='row'>{$i}</th>
                        <td>{$row['user_name']}</td>
                        <td>{$row['room_number']}</td>
                        <td><img src={$row['image']}></td>
                        <td>{$row['ext']}</td>
                        <td><a class='btn btn-danger' href='../Controller/userDelController.php?id={$row['user_id']}'>Delete</a></td>
                        <td><a href='./editUser.php?id={$row['user_id']}' class='btn btn-warning'>Edit</a></td>
                        </tr>";
                        $i += 1;
                    }
                }
                ?>
            </tbody>
        </table>
    </div>
</body>

</html>