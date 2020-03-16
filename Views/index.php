<?php

    require '../config.php';
    $errordata=[];
    if(isset($_GET["error"])){
        $errordata=explode(',',$_GET["error"]);
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
        background: #b68934;
        border: 1px solid #ddd;
        color: #ffffff;
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
    <div class="wrap">
        <form class="login-form" action="../Controller/authController.php" method="POST">
            <div class="form-header">
                <h3>ITI Cafetearia</h3>
                <p>Login to make your order</p>
            </div>
            
            <!--Email Input-->
            <div class="form-group">
                <input type="text" class="form-input" placeholder="email@example.com" name="email">
                <span> 
                    <?php 
                        if(in_array("email",$errordata))echo "  *Email is empty";
                        elseif(in_array("Invalid",$errordata))echo "  *Invalid Email";
                    ?>
                </span>
            </div>
            <!--Password Input-->
            <div class="form-group">
                <input type="password" class="form-input" placeholder="password" name="password">
                <span> <?php if(in_array("password",$errordata))echo "  *password is empty";?></span>

            </div>
            <!--Login Button-->
            <div class="form-group">
                <button class="form-button" type="submit" name="login">log in</button>
            </div>
            <span>
            <?php
                if(isset($_GET["error"])){
                    echo "  Wrong Email or password";
                }
            ?>
            </span>
            <!-- <div class="form-footer">
            Have an account? <a href="signUp.php">sign up</a>
            </div> -->
        </form>
    </div><!--/.wrap-->
</body>
</html>