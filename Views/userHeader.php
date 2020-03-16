<?php 
    require_once("../config.php"); 
    if (isset($_SESSION['role'])){
        if ($_SESSION['role'] != 'client')
        header("Location:./listProduct.php");
    }else{
        header("Location:./");
    }
?>

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<link rel="stylesheet" href="../Public/css/style.css">

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="DisplayOrders.php">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="addOrder.php">Order</a>
            </li>
        </ul>
        <form class="form-inline my-2 my-lg-0">
            <img src="../uploads/<?php echo $_SESSION['image'] ?>" alt="">
            <h3><?php echo $_SESSION['username'] ?></h3>
        </form>
        <a class="btn btn-danger ml-2" href="../Controller/logout.php"> Log Out </a>
    </div>
</nav>