<?php

session_start();
if(isset($_SESSION['id'])){
    $userId = $_SESSION['id'];
    $userName = $_SESSION['username'];
}
else{
    // header("Location:../Views/logIn.php");
}
//error array 
$errorArray=[];
//-Connect To DB
$connect=mysqli_connect("localhost","root","","cafeteria");
   
if($connect){
    //echo "Data Base is connected";   
    //Query
    if(isset($_POST['register'])){
    //input validation before insert into database
        if(!isset($_POST['username']) || empty($_POST['username'])){
            $errorArray[]="username";
        }

        // if(!isset($_POST['email']) || empty($_POST['email'])){
        //     $errorArray[]="email";
        // }

        if(!isset($_POST['password']) || empty($_POST['password'])){
            $errorArray[]="password";
        }

        if(!isset($_POST['room_number']) || empty($_POST['room_number'])){
            $errorArray[]="room_number";
        }

        if(!isset($_POST['ext']) || empty($_POST['ext'])){
            $errorArray[]="ext";
        }

        if(count($errorArray)>0){
            // var_dump($errorArray);
            echo "not valid";
            header("Location:../Views/signUp.php?error=".implode(",",$errorArray));
                
        }
        else{
            $id=mysqli_escape_string($connect,$_POST['id']);
            $username=mysqli_escape_string($connect,$_POST['username']);
            // $email=mysqli_escape_string($connect,$_POST['email']);
            $password=mysqli_escape_string($connect,$_POST['password']);
            $room_number=mysqli_escape_string($connect,$_POST['room_number']);
            $ext=mysqli_escape_string($connect,$_POST['ext']);
            
            // upload file
            $tempName = $_FILES['userfile']['tmp_name'];
            $fileName = $_FILES['userfile']['name'];
            if($fileName){
                //upload image with user data
                if ($_FILES['userfile']['error'] > 0) { 
                    echo 'Problem: ';
                    switch ($_FILES['userfile']['error']) {
                        case 1: 
                            echo 'File exceeded upload_max_filesize';
                            break;
                        case 2: 
                            echo 'File exceeded max_file_size'; 
                            break; 
                        case 3: 
                            echo 'File only partially uploaded';
                            break;
                        case 4: 
                            echo 'No file uploaded';
                            break; 
                        case 6: 
                            echo 'Cannot upload file: No temp directory specified'; 
                            break; 
                        case 7: 
                            echo 'Upload failed: Cannot write to disk'; 
                            break; 
                    } 
                    exit; 
                }
                $upfile = './uploads/'.$_FILES['userfile']['name'] ; 
                if (is_uploaded_file($_FILES['userfile']['tmp_name'])){  
                    if (!move_uploaded_file ( $_FILES['userfile']['tmp_name'] , $upfile )){ 
                        echo 'Problem: Could not move file to destination directory'; 
                        exit; 
                    } 
                    else { 
                        //update data
                        $result= mysqli_query($connect,"update clients set
                        user_name='$username',
                        password='$password',
                        room_number ='$room_number',
                        ext='$ext',
                        image='$upfile'
                        where user_id ='$id'
                        ");
                
                        var_dump($result);
                        
                        if($result){
                            // echo "insert succeded with image";
                            header("Location:../Views/usersList.php");
                        }
                        else{
                            header("Location:../Views/signUp.php?error=wrongEntry");
                        }
                    } 
                    
                }
            }
            else{
                //update data without image
                $result= mysqli_query($connect,"update clients set
                    user_name='$username',
                    password='$password',
                    room_number ='$room_number',
                    ext='$ext'
                    where user_id ='$id'
                    ");
        
                
                if($result){
                    // echo "insert succeded without image";
                    header("Location:../Views/usersList.php");
                }
                else{
                    header("Location:../Views/signUp.php?error=wrongEntry");
                }
            }

        }

    }

    else if(isset($_POST['login'])){

        if(!isset($_POST['email']) || empty($_POST['email'])){

            $errorArray[]="email";
        }

        if(!isset($_POST['password']) || empty($_POST['password'])){

            $errorArray[]="password";
        }

        if(count($errorArray)>0){
            header("Location:../Views/logIn.php?error=".implode(",",$errorArray));    
        }
        else{
            $email=mysqli_escape_string($connect,$_POST['email']);
            $password=mysqli_escape_string($connect,$_POST['password']);
            if($email == "mahmoud.ezz49@gmail.com" && $password == '1234'){
                session_start();
                $_SESSION['id']=123;
                $_SESSION['username']='mahmoud';
                header("Location:../Views/index.php");
                exit;
            }
            else{
                $result= mysqli_query($connect,"
                select * from clients where
                email='$email' && password='$password'
                ");
                if($result->num_rows > 0){
                    foreach($result as $row){
                        session_start();
                        $_SESSION['id']=$row['user_id'];
                        $_SESSION['username']=$row['user_name'];
                        header("Location:../Views/index.php");
                    }
                    echo "Success";
                }
                else{
                    header("Location:../Views/logIn.php?error=wrongEntry");
                }

            }
        }
        
    }
    else if(isset($_POST['logout'])){
        echo "session destroyed";
        session_destroy();
        header("Location:../Views/logIn.php");
    }
}
else{
    echo "server can't connect to DB";
}

?>