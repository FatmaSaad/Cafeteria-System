<?php

if(isset($_GET['id'])){
    $connect=mysqli_connect("localhost","root","","cafeteria");
    if($connect){
        $result=  mysqli_query($connect,"update clients set
        deleted = 1 
        where user_id='{$_GET['id']}'");
        if($result){
            header("Location:../Views/usersList.php");
        }
    }
    else{
        echo "Error in delete";
    }
}

?>