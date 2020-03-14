<?php
require_once '..' . DIRECTORY_SEPARATOR . 'config.php'; 
 $errorArray = [];
 $statusMsg = [];
        if($db)
        {
            $productName = $_POST["productName"] ;
            $productPrice = $_POST["price"];
            $productCategory=$_POST["category"];
            $productPicture = $_POST["file"];
            if(!isset($_POST["productName"]) || empty($productName)){
                $errorArray[]="productName"; 
                echo "name not set";            
            }
            if(!isset($_POST["price"]) || empty($productPrice)){
                $errorArray[]="productPrice";  
                echo "price not set";            
            }
            if(!isset($_POST["category"]) || empty($productCategory)){
                $errorArray[]="productCategory";        
                echo"cat not set";      
            }
                // File upload path
                
                $targetDir = "../uploads/";
                $fileName = basename($_FILES['file']['name']);
                $targetFilePath = $targetDir.$fileName;
                $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
                if(isset($_POST["submit"]) && !empty($_FILES["file"]["name"]))
                {
                    // Allow certain file formats
                    $allowTypes = array('jpg','png','jpeg','gif','pdf');
                    if(in_array($fileType, $allowTypes))
                    {
                        // Upload file to server
                        if(move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)){                
                        }
                        else
                        {
                            $statusMsg []= "Sorry, there was an error uploading your file";
                       }
                    }
                    else
                    {
                        $statusMsg [] = "Sorry, only JPG, JPEG, PNG, GIF, & PDF files are allowed to upload";

                    }
                }
                else
                {
                    $statusMsg [] = "Please select a file to upload";
                    
                }   
            $pattern ="/^[a-z]/" ;
            if(!preg_match($pattern,$productName))
            {
                $errorArray []="productName" ;
            }
            if(count($errorArray)>0)
            {
                    var_dump(count($errorArray));
                    header("Location:../Views/addProduct.php?error=".implode(",",$errorArray));
            }else if(count($statusMsg)>0)
            {
                header("Location:../Views/addProduct.php?imgerror=".implode(",",$statusMsg));

            }
            else
            {          
                $productName = trim($_POST['productName']);
                    $product = new Product();  
                    $res = $product->addProduct($productName,$productPrice,$productCategory,$fileName);
                    if($res)
                    {
                        header("Location:../Views/addProduct.php");
                    }
                    else
                    {
                        echo "error";
                    }
            }
            if(isset($_GET['Did']))
            {
                $deletedId = $_GET['Did'];
                $delproduct = new product();
                $res = $delproduct->deleteProduct($deletedId);
                var_dump($delproduct->deleteProduct($deletedId));

            }
        }
?>