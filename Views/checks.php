<?php include 'adminHeader.php' ?>

<div class="container">

    <div class="row mb-3">
        <div class="input-group my-3 col-sm-3">
            <div class="input-group-prepend">
                <span class="input-group-text">From</span>
            </div>
            <input id="dateFrom" type="date" class="form-control" placeholder="Recipient's username" aria-label="Recipient's username" aria-describedby="basic-addon2">
        </div>
        <div class="input-group my-3 col-sm-3">
            <div class="input-group-prepend">
                <span class="input-group-text">To</span>
            </div>
            <input id="dateTo" type="date" class="form-control" placeholder="Recipient's username" aria-label="Recipient's username" aria-describedby="basic-addon2">
        </div>
        <div class="input-group my-3 col-sm-3">
            <button id="filter" class="btn btn-info"> Filter </button>
        </div>
    </div>

    <div class="form-group col-md-3">
        <label for="exampleFormControlSelect1">User Name Filtration</label>
        <select class="form-control" onchange="filterUsers(this)">
            <option readonly> select ..</option>
            <?php
            require_once("../config.php");
            $admin = new Admin();
            $data = $admin->getOrders();
            $ordersData = [];
            while ($row = mysqli_fetch_assoc($data)) {
                array_push($ordersData, $row);
            }

            foreach ($ordersData as $row) { ?>
                <option id="<?php echo 'user' . $row['user_id'] ?>"> <?php echo $row['user_name'] ?> </option>
            <?php } ?>
        </select>
    </div>

    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">Expand</th>
                <th scope="col">Name</th>
                <th scope="col">Total $</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($ordersData as $row) { ?>
                <tr id="<?php echo 'filter-' . $row['user_id'] ?>">
                    <th scope="row">
                        <button type="button" class="btn border border-dark rounded-circle" data-toggle="modal" data-target="#Modal<?php echo $row['user_id'] ?>">
                            +
                        </button>
                    </th>
                    <td><?php echo $row['user_name'] ?></td>
                    <td><?php echo $row['total_price'] ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

    <?php
    foreach ($ordersData as $row) {
        $orderDetails = $admin->getOrderData($row['user_id']);
    ?>

        <div class="modal fade" id="Modal<?php echo $row['user_id'] ?>" tabindex="-1" role="dialog" aria-labelledby="ModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="ModalCenterTitle">Modal title</h5>
                        <button class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">Order Date</th>
                                    <th scope="col">Total $ Per Day</th>
                                </tr>
                            </thead>
                            <tbody id="accordion">
                                <?php
                                while ($order = mysqli_fetch_assoc($orderDetails)) {
                                ?>
                                    <tr>
                                        <th scope="row">
                                            <button type="button" data-toggle="collapse" data-target="#collapse<?php echo $order['order_id'] ?>" aria-expanded="true" aria-controls="collapseOne" class="btn border border-dark rounded-circle">
                                                +
                                            </button>
                                            <span class="date" data-id="<?php echo $row['user_id'] ?>">
                                                <?php echo $order['date'] ?>
                                            </span>

                                        </th>
                                        <td>
                                            <?php echo $order['total_price'] ?>
                                        </td>
                                    </tr>
                                    <tr id="collapse<?php echo $order['order_id'] ?>" class="collapse " aria-labelledby="headingOne" data-parent="#accordion">
                                        <td colspan="2">
                                            <div class="row">
                                                <?php
                                                $products = $admin->getOrderedProducts($order['order_id']);
                                                while ($product = mysqli_fetch_assoc($products)) { ?>
                                                    <div class="col-md-4 d-flex align-items-stretch">
                                                        <div class="card">

                                                            <img class="card-img-top" src="../uploads/<?php $product['image'] ?>" alt="Card image cap">
                                                            <div class="card-body">
                                                                <p class="card-text">
                                                                    <?php
                                                                    $price = (int) $product['price'] * (int) $product['product_amount'];
                                                                    echo $product['product_amount'] . ' ' . $product['product_name'] . ' for ' . $price . '$';
                                                                    ?>
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php } ?>
                                            </div>
                                        </td>
                                    </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
</div>

<?php include 'adminFooter.php' ?>