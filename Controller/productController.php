

<?php
// session_start();
// if(isset($_SESSION['adminName'])){
//     if($_SESSION['adminName'] == "Admin")
//     {
//         $connect = mysqli_connect("localhost","root","","cafeteria");
//         if($connect)
//         {
//             $productData = $_POST["productName"] ;
//             var_dump($productData) ; 
//             .
//             .
//             .

//         }

//     }
//     else
//         {
//         header("Location:login.html ");    
//         }
// }else
//     {
//     header("Location:login.html ");    
//     }
require_once '..' . DIRECTORY_SEPARATOR . 'config.php'; 

 $errorArray = [];
        if($db)
        {
            $productName = $_POST["productName"] ;
            $productPrice = $_POST["price"];
            $productCategory=$_POST["category"];
            // $productPicture = $_POST["file"];
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
            // if(!isset($_POST["file"]) || empty($productPicture)){
            //     $errorArray[]="picture";             
            // }
            // else
            // {  
                var_dump("hi");
                // File upload path
                $statusMsg = '';
                $targetDir = "../uploads/";
               
                $fileName = basename($_FILES['file']['name']);
                //  var_dump($_FILES);
                $targetFilePath = $targetDir.$fileName;
                $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
                
                if(isset($_POST["submit"]) && !empty($_FILES["file"]["name"])){
                    // Allow certain file formats
                    $allowTypes = array('jpg','png','jpeg','gif','pdf');
                    if(in_array($fileType, $allowTypes))
                    {
                        // Upload file to server
                        if(move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)){                
                        }
                        else
                        {
                            $statusMsg = "Sorry, there was an error uploading your file.";
                       }
                    }
                    else
                    {
                        $statusMsg = 'Sorry, only JPG, JPEG, PNG, GIF, & PDF files are allowed to upload.';
                    }
                }
                else
                {
                    $statusMsg = 'Please select a file to upload.';
                }
                
                // Display status message
                echo "status msg";
                echo $statusMsg;
            // }    
            if(count($errorArray)>0)
            {
                    var_dump(count($errorArray));
                    // var_dump("error array".$errorArray);
                    // header("Location:../Views/addProduct.php?error=".implode(",",$errorArray));
            }
            else
            {           
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

        }
?>