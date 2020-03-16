<?php
        require_once '..' . DIRECTORY_SEPARATOR . 'config.php'; 
        $data =$_REQUEST;   
        $pid = (int) $data["productId"];
        $targetDir = "../uploads/";
        $fileName = basename($_FILES['file']['name']);
        $targetFilePath = $targetDir.$fileName;
        $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
        $price = (int)$data["price"];
        echo $price;
        /*
                // if(isset($_POST["submit"]) && !empty($_FILES["file"]["name"]))
                // {
                //     // Allow certain file formats
                //     $allowTypes = array('jpg','png','jpeg','gif','pdf');
                //     if(in_array($fileType, $allowTypes))
                //     {
                //         // Upload file to server
                //         if(move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)){                
                //         }
                //         else
                //         {
                //             $statusMsg []= "Sorry, there was an error uploading your file";
                //        }
                //     }
                //     else
                //     {
                //         $statusMsg [] = "Sorry, only JPG, JPEG, PNG, GIF, & PDF files are allowed to upload";

                //     }
                // }
                // else
                // {
                //     $statusMsg [] = "Please select a file to upload";
                
                // }   
        */
        $result = mysqli_query($db,"update products set product_name='{$data["productName"]}' , 
        price ={$price} , category='{$data["category"]}' ,
        where products.product_id={$pid}");
        var_dump($result);