<?php
require '../config.php';
if(isset($_SESSION['id'])){
    $userId = $_SESSION['id'];
    $userName = $_SESSION['username'];
}
else{
    header("Location:login.php");
}
//error array 
$errorArray=[];
//-Connect To DB
$connect=mysqli_connect("localhost","root","","cafeteria");
 
//
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
//
if($connect){
    //echo "Data Base is connected";   
    //Query
    if(isset($_POST['register'])){
        //input validation before insert into database
        if(!isset($_POST['username']) || empty($_POST['username'])){
            $errorArray[]="username";
        }

        if(!isset($_POST['email']) || empty($_POST['email'])){
            $errorArray[]="email";
        }

        if(!isset($_POST['password']) || empty($_POST['password'])){
            $errorArray[]="password";
        }

        if(!isset($_POST['room_number']) || empty($_POST['room_number'])){
            $errorArray[]="room_number";
        }

        if(!isset($_POST['ext']) || empty($_POST['ext'])){
            $errorArray[]="ext";
        }
        $email = test_input($_POST["email"]);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errorArray[] = "Invalid";
        }
        if(count($errorArray)>0){
            // var_dump($errorArray);
            echo "not valid";
            header("Location:../Views/signUp.php?error=".implode(",",$errorArray));
                
        }
        
        else{
            $username=mysqli_escape_string($connect,$_POST['username']);
            $email=mysqli_escape_string($connect,$_POST['email']);
            $pass=mysqli_escape_string($connect,$_POST['password']);
            $password = password_hash($pass, PASSWORD_DEFAULT);
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
                $upfile = '../uploads/'.$_FILES['userfile']['name'] ; 
                if (is_uploaded_file($_FILES['userfile']['tmp_name'])){  
                    if (!move_uploaded_file ( $_FILES['userfile']['tmp_name'] , $upfile )){ 
                        echo 'Problem: Could not move file to destination directory'; 
                        exit; 
                    } 
                    else { 
                        //insert data
                        $result= mysqli_query($connect,"insert into clients set
                        user_name='$username',
                        email='$email',
                        password='$password',
                        room_number ='$room_number',
                        ext='$ext',
                        image='$upfile'
                        ");
                
                        var_dump($result);
                        
                        if($result){
                            // echo "insert succeded with image";
                            header("Location:../Views/signUp.php");
                        }
                        else{
                            header("Location:../Views/signUp.php?error=wrongEntry");
                        }
                    } 
                    
                }
            }
            else{
                //insert data without image
                $result= mysqli_query($connect,"insert into clients set
                user_name='$username',
                email='$email',
                password='$password',
                room_number ='$room_number',
                ext='$ext'
                ");
        
                var_dump($result);
                
                if($result){
                    // echo "insert succeded without image";
                    header("Location:../Views/signUp.php");
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
        $email = test_input($_POST["email"]);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errorArray[] = "Invalid";
        }
        if(count($errorArray)>0){
            header("Location:../Views/login.php?error=".implode(",",$errorArray));    
        }
        else{
            $email=mysqli_escape_string($connect,$_POST['email']);
            $password=mysqli_escape_string($connect,$_POST['password']);
            if($email == "admin@admin.com" && $password == '1234'){
                $_SESSION['id']=123;
                $_SESSION['username']='mahmoud';
                header("Location:../Views/adminHome.php");
                exit;
            }
            else{
                $result= mysqli_query($connect,"
                select * from clients where
                email='$email' && deleted=0
                ");
                if($result->num_rows > 0){
                    foreach($result as $row){
                        if (password_verify($password, $row['password'])){
                            $_SESSION['id']=$row['user_id'];
                            $_SESSION['username']=$row['user_name'];
                            header("Location:../Views/userHome.php");
                        }
                        else{
                            header("Location:../Views/login.php?error=wrongEntry");
                        }
                        
                    }
                }
                else{
                    header("Location:../Views/login.php?error=wrongEntry");
                }

            }
        }
        
    }
    else if(isset($_POST['logout'])){
        echo "session destroyed";
        session_destroy();
        header("Location:../Views/login.php");
    }
}
else{
    echo "server can't connect to DB";
}

?>