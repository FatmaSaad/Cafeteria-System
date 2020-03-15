<?php
    $errordata=[];
    if(isset($_GET["error"])){
        $errordata=explode(',',$_GET["error"]);
    }
    if(isset($_GET['id'])){
        $connect=mysqli_connect("localhost","root","","cafeteria");
        if($connect){
            $result=  mysqli_query($connect,"select * from clients where user_id='{$_GET['id']}'");
            if($result){
                $user=mysqli_fetch_assoc($result);
            }
        }
        else{
            echo "Error in delete";
        }
    }
?>

<!DOCTYPE html>
<html>
<head>
    <title>The Login Form</title>
    <style>
    *{
        margin:0;
        padding: 0;
        box-sizing: border-box;
    }
    html{
        height: 100%;
    }
    body{
        font-family: 'Segoe UI', sans-serif;;
        font-size: 1rem;
        line-height: 1.6;
        height: 100%;
    }
    span{
        color:red;
    }
    .wrap {
        width: 100%;
        height: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
        background: #fafafa;
    }
    .login-form{
        width: 350px;
        margin: 0 auto;
        border: 1px solid #ddd;
        padding: 2rem;
        background: #ffffff;
    }
    .form-input{
        background: #fafafa;
        border: 1px solid #eeeeee;
        padding: 12px;
        width: 100%;
    }
    .form-group{
        margin-bottom: 1rem;
    }
    .form-button{
        background: #69d2e7;
        border: 1px solid #ddd;
        color: #ffffff;
        padding: 10px;
        width: 100%;
        text-transform: uppercase;
    }
    .reset-button{
        background: #b68934;
        border: 1px solid #ddd;
        color: #ffffff;
        margin-top:5px;
        padding: 10px;
        width: 100%;
        text-transform: uppercase;
    }
    .form-button:hover{
        background: #69c8e7;
    }
    .form-header{
        text-align: center;
        margin-bottom : 2rem;
    }
    .form-footer{
        text-align: center;
    }
    </style>
</head>
<body>
    <?php
        include 'adminHeader.php';
    ?>
    <div class="wrap">
        <form class="login-form" action="../Controller/userEditController.php" method="POST" enctype="multipart/form-data">
            <div class="form-header">
                <h3>Edit Client</h3>
            </div>
            <!--user name Input-->
            <div class="form-group">
                <input type="text" class="form-input" placeholder="User Name" name="username" value=<?php echo $user['user_name'];?>>
                <span> <?php if(in_array("username",$errordata))echo "  *User Name is empty";?></span>
            </div>
            <!--Email Input-->
            <div class="form-group">
                <input disabled type="text" class="form-input" placeholder="email@example.com" name="email" value=<?php echo $user['email'];?>>
                <span> <?php if(in_array("email",$errordata))echo "  *Email is empty";?></span>
            </div>
            <!--Password Input-->
            <div class="form-group">
                <input type="password" class="form-input" placeholder="password" name="password" value=<?php echo $user['password'];?>>
                <span> <?php if(in_array("password",$errordata))echo "  *password is empty";?></span>
            </div>
            <!-- new part -->
            <!--Room No Input-->
            <div class="form-group">
                <input type="text" class="form-input" placeholder="Room Number" name="room_number" value=<?php echo $user['room_number'];?>>
                <span> <?php if(in_array("room_number",$errordata))echo "  *Room Number is empty";?></span>
            </div>
            <!-- Ext -->
            <div class="form-group">
                <input type="number" class="form-input" placeholder="Ext" name="ext" value=<?php echo $user['ext'];?>>
                <span> <?php if(in_array("ext",$errordata))echo "  *Ext is empty";?></span>
            </div>
            <div class="form-group">
                <input type="file" class="form-input" placeholder="Ext" name="userfile">
                <span> <?php if(in_array("file",$errordata))echo "  *upload ur image";?></span>
            </div>
            <!--Login Button-->
            <div class="form-group">
                <button class="form-button" type="submit" name="register">save</button>
                <input class="reset-button" type="reset">
            </div>
            <span>
            <?php
                if(isset($_GET["error"])){
                    echo "  Wrong Email or already taken";
                }
            ?>
            </span>
            <input hidden type="text" name="id" value="<?php echo $user['user_id']?>">
        </form>
    </div><!--/.wrap-->
</body>
</html>