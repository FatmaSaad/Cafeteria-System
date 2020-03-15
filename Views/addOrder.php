<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../public/css/font-awesome.min.css" />
    <link rel="stylesheet" href="../public/css/bootstrap.min.css" />
    <link type="text/css" rel="stylesheet" media="screen" href="../Public/css/addProduct.css" />

    <link type="text/css" rel="stylesheet" media="screen" href="../public/css/styles.css" />
    <title>Home</title>



    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js">
    </script>

</head>

<body>
    <?php

    include 'userHeader.php';

    $errordata = [];
    if (isset($_GET["error"]))
        $errordata = explode(',', $_GET["error"]);
    ?>
    <main class="add-user">

        <div class="row" style="width: 100%;text-align:center;">

            <section class=" col-4" style="margin-left: 50px">
                <div style=" border: 1px black solid;">
                    <h1 style="text-align:center;">Order</h1>
                    <section style="height:300px; border:2px solid brown;margin:10px;text-align:center; ">
                        <div style="display: inline-block; margin: 10px;" class="product parent" id="parent2">
                        </div>
                    </section>


                    <hr class="divider">
                    <form id="order" action="../Controller/orderController.php" method="POST" class="form-horizontal text-info">
                        <!-- Clicked Orders Section -->
                        <div style="color: brown" id="SelectedOrdersContainers">
                            <div class="form-group row">
                                <label for="" class="offset-sm-1 col-sm-2 control-label">Room</label>
                                <div class="col-sm-6">
                                    <input class="form-control onRuntime" name="room_number" type="number" placeholder="Room" style="width: 100px;" />

                                </div>
                            </div>
                        </div>
                        <!-- Notes Section -->
                        <div style="color: brown" class="form-group row">
                            <label for="" class="offset-sm-1 col-sm-2 control-label">Notes</label>
                            <div class="col-sm-6">
                                <input class="form-control" name="order_notes" type="text" placeholder="Enter your notes" style="width: 300px; height: 100px;" />
                            </div>
                        </div>
                        <hr class="divider">
                        <div style="text-align:right;margin-right:20px;color: brown">
                            <!-- Total Price -->
                            <h3>EGP <input id="TotalPrice" class="col-2 btn btn-warning" type="text" value="0" readonly /> </h3>
                        </div>
                        <input type="hidden" name="products" />
                        <br />
                        <div class="form-group text-center">
                            <input class="btn btn-success" type="submit" name="addOrder" value="Order Now !!">
                        </div>
                    </form>
                </div>
            </section>

            <section id="right" class="offset-1 col-6" style="text-align: center; border: 1px black solid;">

                <div style="display: inline-block; margin: 10px;">
                    <?php
                    $product = new product();

                    $result = $product->listAllProducts();
                    while ($row = mysqli_fetch_assoc($result)) {; ?>

                        <div style="display: inline-block; margin: 10px;">
                            <?php $pro_id = 0;
                            ?>
                            <div onclick="GFG_Fun(<?php echo $row['product_id'] ?>,<?php echo $row['price'] ?>)" class="parent">
                                <div class="child" id='<?php echo $row['product_id'] ?>'>
                                    <div id="container" style="display: inline-block; margin: 10px;">
                                        <input type="hidden" name="Id" value="<?php echo $row['product_id'] ?>">

                                        <?php
                                        ?>
                                        <img src="../public/Images/<?php echo $row['image']; ?>" width="150px" height="150px" />
                                        <span class="badge badge-pill badge-warning"><?php echo $row['price']; ?> EGP</span>
                                        <figcaption><?php echo $row['product_name'] ?></figcaption>
                                    </div>
                                </div>

                            </div>
                        </div>
                    <?php } ?>
                    <script>
                        var arr = [];
                        var totalprice = 0;
                        var totalPrice;
                        var prod;
                        var prodinput;
                        
                        var nu=1;
                        amou = `<span id="amou" class="badge badge-pill badge-success">${nu}</span>`;

                        function GFG_Fun(id, price) {
                            if (arr.includes(id)) {
                                $('#' + id).append($(amou));
                                document.getElementById("amou").value = ++nu;
                            } else {
                                $('#' + id).clone().appendTo('#parent2');
                            }
                            arr.push(id);
                            console.log(arr);
                            prod = arr.toString();

                            totalprice += price;
                            totalPrice = `<input  type="hidden" name="to_Price" value="${totalprice}"/>`;
                            $('#order').append($(totalPrice));
                            document.getElementById("TotalPrice").value = totalprice;

                            prodinput = `<input type="hidden" name="ordersProducts" value="${prod}"/>`
                            $('#order').append($(prodinput));
                        }
                    </script>


                </div>

            </section>
        </div>
    </main>
    <footer class="footer-area section-gap">
    </footer>

    <script src="../public/js/jquery-3.3.1.js"></script>
    <script src="../public/js/bootstrap.bundle.min.js"></script>
    <script src="../public/js/popper.min.js"></script>
</body>

</html>