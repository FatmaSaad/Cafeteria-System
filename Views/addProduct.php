<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="../Public/css/font-awesome.css" />
    <link rel="stylesheet" href="../Public/css/bootstrap.min.css" />
    <link type="text/css" rel="stylesheet" media="screen" href="../Public/css/addProduct.css"/>
    <title>Add Product</title>
</head>

<body>
    <?php

    include 'adminHeader.php';

    $errordata = [];
    if (isset($_GET["error"]))
        $errordata = explode(',', $_GET["error"]);
    ?>
    <div class="container">
        <div>
            <h4>Add Product</h4>
        </div>
        <form action="../Controller/productController.php" method="POST" enctype="multipart/form-data">
            <div class="form-group row">
                <label for="" class="offset-1 col-3 control-label">Product Name</label>
                <div class="col-6">
                    <input class="form-control" type="text" name="productName" placeholder="Enter Product Name" />
                    <span> <?php if (in_array("f_name", $errordata)) echo "Name is empty"; ?></span>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-3 offset-1 control-label">Price</label>
                <div class="col-2">
                    <input class="form-control " name="price" type="number" min="5.00" max="500.00" placeholder="0.0" />
                </div>
            </div>
            <div class="form-group row">
                <label class="col-3 offset-1 control-label">Category</label>
                <div class="col-4">
                    <select class="form-control " name="category">
                        <option>Cold Drinks</option>
                        <option>Hot Drinks</option>
                        <option>Fresh Juice</option>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label class="control-label col-3 offset-1">Product Picture</label>
                <input type="file" name="file" class="form-control-file col-6" />
            </div>
            <div class="offset-4">
                <button type="submit" name="submit" value="add" class="btn btn-success">ADD</button>
                <button type="reset" value="reset" class="  btn btn-info">Reset</button>
            </div>
        </form>
        <footer class="footer-area section-gap">

        </footer>
    </div>
</body>

</html>